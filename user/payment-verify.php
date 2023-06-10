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
        echo "Payment Verified! Congratulations on your enrollement";
        //$redirectUrl = "student.php?uid=".urlencode($uid); 
        //header("Location: ". $redirectUrl);
        //exit();
      } else {
        // payment not yet verified
        echo "You have submitted your payment details successfully. Please wait to hear from us!";
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
        $query_pay = mysqli_query($con, "INSERT INTO tblpayments(
                  Application_ID, Payer_ID, Payer_Name, Pay_Ref, Pay_Date, Pay_Receipt)
                  VALUES('$app_id', '$uid', '$name', '$payRef', '$payDate', '$payPic')");

        if ($query_pay) {
          echo '<script>alert("Thank you! We will notify you once the payment has been verified.")</script>';
          //$redirectUrl = "student.php?uid=".urlencode($uid); 
          header("Location:dashboard.php");
          exit();
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
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    <?php 
    include_once('includes/header.php'); 
    include_once('includes/leftbar.php'); 
    // fetching payment data from tblpayments
    $check_pay = mysqli_query($con, "SELECT * FROM tblpayments WHERE Payer_ID='$uid'");
    $pay_data = mysqli_fetch_array($check_pay);
    $payer_name = $pay_data['Payer_Name'];
    $payer_name = $pay_data['Pay_Ref'];
    ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
          <h4><strong>Payment reference number:</strong> <?php echo $pay_data['Pay_Ref'] ?> <br><br>
            <strong>Payment Date:</strong> <?php echo date('d-M-Y', strtotime($pay_data['Pay_Date'])) ?> <br><br>
            Dear <?php echo $pay_data['Payer_Name'] ?>, <br><br>
            We are pleased to learn that you have reached the last phase of your enrollement in our University.<br><br>
            We will process your payment as fast as possible and let you know of the outcome soon.<br><br>
            Should you require any further information or in case you have submitted wrong payment details,
            please do let us know at <a style="color:coral">rvu.admissions.sup@gmail.com</a><br><br>
            <strong>Kind regards,<br><br>
              Rift Valley University Admissions Office
            </strong>
          </h4>
        </div>
      </div>
    </div>
    <?php include('includes/footer.php'); ?>

    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  </body>
<?php } ?>