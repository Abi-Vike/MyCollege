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
}
  
?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>RVU-GADA : Student || Payment Verified</title>
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
          <?php if ($pay_data['Pay_Confirmed'] === 'verified') {
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
              Your payment has been verified and your registration completed on <?php echo date('d-M-Y', strtotime($R_Date)) ?> <br><br>

              You are now officially registered for the September 2023 degree program in <?php echo $R_Course ?>. <br>
              We are excited to have you as part of our esteemed institution, and we look forward to witnessing
              your growth and success as you pursue your Bachelors in <?php echo $R_Course ?>.<br><br>
              Should you have any questions or require any assistance, please do not hesitate to reach out to our dedicated
              support team at <a style="color:coral">rvu.admissions.sup@gmail.com</a><br><br>
              <strong>Sincerely,<br><br>
                Rift Valley University Admissions Office<br>
              </strong><br><br><br>
            </h4>
          </div>
      </div>
    </div>

    <?php include('includes/footer.php'); ?>
    <!---->
    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  </body>
<?php } ?>