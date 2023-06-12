<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');

//require 'includes/PHPMailer/src/Exception.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';

use phpMailer\PHPMailer\PHPMailer;
use phpMailer\PHPMailer\SMTP;
//use phpMailer\PHPMailer\Exception;

if (isset($_GET['uid'])) {
  $uid = $_GET['uid'];
  // need to extract out the application ID from tbladmapplications as I only have the userID here
  $ret = mysqli_query($con, "SELECT ID FROM tbladmapplications WHERE UserId='$uid'");
  $row = mysqli_fetch_array($ret);
  $app_id = $row['ID'];

  if (isset($_POST['submit'])) {
    $check_pay = mysqli_query($con, "SELECT Payer_ID, Pay_Confirmed FROM tblpayments WHERE Payer_ID='$uid'");
    if ($row = mysqli_fetch_array($check_pay)) {
      // applicant has already submitted payment information.
      if ($row['Pay_Confirmed'] == 'verified') {
        // redirect to congratulations page and show generated ID.
        echo "Payment Verified!";
        //$redirectUrl = "student.php?uid=".urlencode($uid); 
        //header("Location: ". $redirectUrl);
        //exit();
      } else {
        // payment not yet verified
        //echo "You have submitted your payment details successfully. Please wait to hear from us!";
      }
    } else {
      $name = $_POST['pay_name'];
      $payRef = $_POST['pay_ref'];
      $payDate = $_POST['pay_date'];
      $payPic = $_FILES["pay_pic"]["name"];

      // image file validation
      $extension_pic = substr($payPic, strlen($payPic) - 4, strlen($payPic));
      $allowed_ext_pic = array(".jpg", ".png", ".jpeg", ".gif");
      if (!in_array($extension_pic, $allowed_ext_pic)) {
        echo "<script>alert('Invalid format. Only image files are allowed');</script>";
      } else {
        $pay_receipt = $name . "_" . md5($payPic) . $extension_pic;
        move_uploaded_file($_FILES["pay_pic"]["tmp_name"], "userimages/payments" . $pay_receipt);
        // now the system can push the data into tbllpayments
        $query_pay = mysqli_query($con, "INSERT INTO tblpayments (Application_ID, Payer_ID, Payer_Name, Pay_Ref, Pay_Date, Pay_Receipt)
                  VALUES('$app_id', '$uid', '$name', '$payRef', '$payDate', '$payPic')");
        $query_adm = mysqli_query($con, "UPDATE tbladmissions SET Adm_Payment_Status = 'paid', Adm_Pay_Date = CURRENT_TIMESTAMP WHERE Adm_App_ID = '$app_id'");

        if ($query_pay && $query_adm) {
          // Create a hidden form and submit it dynamically
          echo '<form id="hiddenForm" action="pay-ver-parser.php" method="post">';
          echo  '<input type="hidden" name="payRef" value="' . $payRef . '">';
          echo  '<input type="hidden" name="payDate" value="' . $payDate . '">';
          echo  '<input type="hidden" name="uid" value="' . $uid . '">';
          echo '</form>';
          echo '<script>document.getElementById("hiddenForm").submit();</script>';
        }
      }
    }
    //$query = mysqli_query($con, "");  
  }
?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>RVU-GADA : Student || Payment</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    <?php
    include_once('includes/header.php');
    include_once('includes/leftbar.php');
    // fetching payment data from tblpayments
    $check_pay = mysqli_query($con, "SELECT * FROM tblpayments WHERE Payer_ID='$uid'");
    $pay_data = mysqli_fetch_array($check_pay);
    ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
          <?php if ($pay_data['Pay_Confirmed'] === 'verified'){
            // fetch data from tblregistered
            $fetch_reg = mysqli_query($con, "SELECT * FROM tblregistered WHERE Reg_User_ID = '$uid'");
            $row = mysqli_fetch_array($fetch_reg);
            $R_ID = $row['Reg_ID'];
            $R_User = $row['Reg_User_ID'];
            $R_Course = $row['Reg_Course'];
            $R_Date = $row['Reg_date'];
          ?>
            
            <h4>
              <strong>Dear <?php echo $pay_data['Payer_Name'] ?>, <br><br></strong>
              <strong>Congratulations! Your payment has been verified.</strong> <br><br>
              <strong>Registration Date:</strong> <?php echo date('d-M-Y', strtotime($R_Date)) ?> <br><br>

              You are now officially registered for the September 2023 degree program in <?php echo $R_Course?>. <br>
              We are excited to have you as part of our esteemed institution, and we look forward to witnessing
              your growth and success as you pursue your Bachelors in <?php echo $R_Course?>.<br><br>
              Should you have any questions or require any assistance, please do not hesitate to our dedicated 
              support team at <a style="color:coral">rvu.admissions.sup@gmail.com</a><br><br>
              <strong>Sincerely,<br><br>
                Rift Valley University Admissions Office<br>
              </strong><br><br><br>
              <div align="center" class="mt-2 mb-2">
                <button type="submit" id="submit_button" name="submit" class="btn btn-success mx-2" style="width: 300px;">Continue to Student Portal</button>
              </div>
            </h4>
          <?php }else{ ?>
            <h4>
              <strong>Payment reference:</strong> <?php echo $pay_data['Pay_Ref'] ?> <br><br>
              <strong>Payment Date:</strong> <?php echo date('d-M-Y', strtotime($pay_data['Pay_Date'])) ?> <br><br>
              Dear <?php echo $pay_data['Payer_Name'] ?>, <br><br>
              We are pleased to learn that you have reached the last phase of your enrollement in our University.<br><br>
              We will process your payment as fast as possible and let you know of the outcome soon.<br><br>
              Should you require any further information or in case you have submitted wrong payment details,
              you can reach us at <a style="color:coral">rvu.admissions.sup@gmail.com</a><br><br>
              <strong>Kind regards,<br><br>
                Rift Valley University Admissions Office
              </strong>
            </h4>
          <?php } ?>
          
        </div>
      </div>
    </div>
    <?php include('includes/footer.php'); ?>

    <!--to handle the forwarding of values to pay-ver-parser.php -->
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <script src="app-assets/vendors/js/jquery-3.6.0.min.js"></script>
    <!--
    <script>
      $(document).ready(function() {
        $('form').submit(function(e) {
          e.preventDefault(); // Prevent form submission

          // Send AJAX request to pay-ver-parser.php
          $.ajax({
            url: 'pay-ver-parser.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
              if (response.success) {
                // Show success message to the user
                alert(response.message);
              } else {
                // Handle any errors if needed
                alert("You're here.. error");
              }
            },
            error: function(xhr, status, error) {
              // Handle AJAX errors if needed
              alert("You're here.. AJAX error");
            }
          });

          // Continue with form submission
          this.submit();
        });
      });
    </script>
    -->
    <!---->
    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  </body>
<?php } ?>