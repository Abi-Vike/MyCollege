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

// ID card generator starts here

//$id_no = $_POST['id_no'];
$sql = "Select * from cards where id_no='1005' ";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
  $html = "<div class='card' style='width:350px; padding:0;'>";
  $html .= "";
  while ($row = mysqli_fetch_assoc($result)) {

    $name = $row["name"];
    $id_no = $row["id_no"];
    $grade = $row['grade'];
    $dob = $row['dob'];
    $address = $row['address'];
    $email = $row['email'];
    $exp_date = $row['exp_date'];
    $phone = $row['phone'];
    $address = $row['address'];
    $image = $row['image'];
    $date = date('M d, Y', strtotime($row['date']));

    $html .= "
      <div class='container-0' style='text-align:left; border:2px dashed black;'>
        <div class='header'>
        </div>
        <div class='container-2'>
          <div class='box-1'>
            <img src='$image' />
          </div>
          <div class='box-2'>
            <h2>$name</h2>
            <p style='font-size: 14px;'>Student</p>
          </div>
          <div class='box-3'>
            <img src='../images/rvu-logo.png' alt=''>
          </div>
        </div>

        <div class='container-3'>
          <div class='info-1'>
            <div class='id'>
              <h4>ID Number</h4>
              <p>$id_no</p>
            </div>
            <div class='dob'>
              <h4>Phone</h4>
              <p>$phone</p>
            </div>
          </div>
          <div class='info-2'>
            <div class='join-date'>
              <h4>ID Issue Date</h4>
              <p>$date</p>
            </div>
            <div class='expire-date'>
              <h4>ID Expire Date</h4>
              <p>$exp_date</p>
            </div>
          </div>
          <div class='info-3'>
            <div class='email'>
              <h4>Address</h4>
              <p>$address this is the final long address</p>
            </div>
          </div>
          <div class='info-4'>
            <div class='sign'>
              <br>
              <p style='font-size:12px;'>Your Signature</p>
            </div>
          </div>
        </div>
      </div>";
  }
}
// ID card generator ends here

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
        //echo "Payment Verified!";
        $redirectUrl = "student.php?uid=" . urlencode($uid);
        header("Location: " . $redirectUrl);
        exit();
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

    <style>
      .lavkush img {
        border-radius: 8px;
        border: 2px solid blue;
      }

      span {
        font-family: 'Orbitron', sans-serif;
        font-size: 16px;
      }

      hr.new2 {
        border-top: 1px dashed black;
        width: 350px;
        text-align: left;
        align-items: left;
      }

      p {
        font-size: 13px;
        margin-top: -5px;
      }

      .container-0 {
        width: 80vh;
        height: 45vh;
        margin: auto;
        background-color: white;
        box-shadow: 0 1px 10px rgb(146 161 176 / 50%);
        overflow: hidden;
        border-radius: 10px;
      }

      .header {
        /* border: 2px solid black; */
        width: 73vh;
        height: 15vh;
        margin: 20px auto;
        background-color: white;
        /* box-shadow: 0 1px 10px rgb(146 161 176 / 50%); */
        /* border-radius: 10px; */
        background-image: url(../images/rvu-poster.png);
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
      }

      .header h1 {
        color: rgb(27, 27, 49);
        text-align: right;
        margin-right: 20px;
        margin-top: 15px;
      }

      .header p {
        color: rgb(157, 51, 0);
        text-align: right;
        margin-right: 22px;
        margin-top: -10px;
      }

      .container-2 {
        /* border: 2px solid red; */
        width: 73vh;
        height: 10vh;
        margin: 0px auto;
        margin-top: -20px;
        display: flex;
      }

      .box-1 {
        border: 4px solid black;
        width: 90px;
        height: 95px;
        margin: -40px 25px;
        border-radius: 3px;
      }

      .box-1 img {
        width: 82px;
        height: 87px;
      }

      .box-2 {
        /* border: 2px solid purple; */
        width: 33vh;
        height: 8vh;
        margin: 7px 0px;
        padding: 5px 7px 0px 0px;
        text-align: left;
        font-family: 'Poppins', sans-serif;
      }

      .box-2 h2 {
        font-size: 1.3rem;
        margin-top: -5px;
        color: rgb(27, 27, 49);
        ;
      }

      .box-2 p {
        font-size: 0.7rem;
        margin-top: -5px;
        color: rgb(179, 116, 0);
      }

      .box-3 {
        /* border: 2px solid rgb(21, 255, 0); */
        width: 8vh;
        height: 8vh;
        margin: 8px 0px 8px 30px;
      }

      .box-3 img {
        width: 8vh;
      }

      .container-3 {
        /* border: 2px solid rgb(111, 2, 161); */
        width: 73vh;
        height: 12vh;
        margin: 0px auto;
        margin-top: 10px;
        display: flex;
        font-family: 'Shippori Antique B1', sans-serif;
        font-size: 0.7rem;
      }

      .info-1 {
        /* border: 1px solid rgb(255, 38, 0); */
        width: 17vh;
        height: 12vh;
      }

      .id {
        /* border: 1px solid rgb(2, 92, 17); */
        width: 17vh;
        height: 5vh;
      }

      .id h4 {
        color: rgb(179, 116, 0);
        font-size: 15px;
      }

      .dob {
        /* border: 1px solid rgb(0, 46, 105); */
        width: 17vh;
        height: 5vh;
        margin: 8px 0px 0px 0px;
      }

      .dob h4 {
        color: rgb(179, 116, 0);
        font-size: 15px;
      }

      .info-2 {
        /* border: 1px solid rgb(4, 0, 59); */
        width: 17vh;
        height: 12vh;
      }

      .join-date {
        /* border: 1px solid rgb(2, 92, 17); */
        width: 17vh;
        height: 5vh;
      }

      .join-date h4 {
        color: rgb(179, 116, 0);
        font-size: 15px;
      }

      .expire-date {
        /* border: 1px solid rgb(0, 46, 105); */
        width: 17vh;
        height: 5vh;
        margin: 8px 0px 0px 0px;
      }

      .expire-date h4 {
        color: rgb(179, 116, 0);
        font-size: 15px;
      }

      .info-3 {
        /* border: 1px solid rgb(255, 38, 0); */
        width: 17vh;
        height: 12vh;
      }

      .email {
        /* border: 1px solid rgb(2, 92, 17); */
        width: 22vh;
        height: 5vh;
      }

      .email h4 {
        color: rgb(179, 116, 0);
        font-size: 15px;
      }

      .phone {
        /* border: 1px solid rgb(0, 46, 105); */
        width: 17vh;
        height: 5vh;
        margin: 8px 0px 0px 0px;
      }

      .info-4 {
        /* border: 2px solid rgb(255, 38, 0); */
        width: 22vh;
        height: 12vh;
        margin: 0px 0px 0px 0px;
        font-size: 15px;
      }

      .phone h4 {
        color: rgb(179, 116, 0);
        font-size: 15px;
      }

      .sign {
        /* border: 1px solid rgb(0, 46, 105); */
        width: 17vh;
        height: 5vh;
        margin: 41px 0px 0px 20px;
        text-align: center;
      }
    </style>
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
          <?php
          if ($pay_data['Pay_Confirmed'] === 'verified') {
            // fetch data from tblregistered
            $fetch_reg = mysqli_query($con, "SELECT * FROM tblregistered WHERE Reg_User_ID = '$uid'");
            $row = mysqli_fetch_array($fetch_reg);
            $R_ID = $row['Reg_ID'];
            $R_User = $row['Reg_User_ID'];
            $R_Course = $row['Reg_Course'];
            $R_Date = $row['Reg_date'];
          ?>
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-12">
                <div class="card pull-up">
                  <div class="card-content">
                    <a href="Pay-cond.php">
                      <div class="card-body">
                        <div class="media d-flex">
                          <div class="media-body text-left">
                            <h4 align="center">Registration Completed successfully</h4>
                          </div>
                          <div>
                            <i class="icon-file success font-large-2 float-right"></i>
                          </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                          <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <hr>
                <h3>Your ID:</h3>
                <div class="card-body" id="mycard">
                  <?php echo $html ?>
                </div>
              </div>
            </div>

          <?php
          } else { ?>
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