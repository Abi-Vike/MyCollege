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
  // extract out info from tbladmapplications and tblregistered
  $ret = mysqli_query($con, "SELECT * FROM tbladmapplications WHERE UserId = $uid");
  /*$ret2 = mysqli_query($con, "SELECT * FROM tblregistered WHERE Reg_User_ID = $uid");
  $row2 = mysqli_fetch_array($ret2);

  // ID card generator starts here
  if (mysqli_num_rows($ret2) > 0) {
    $html = "<div class='card' style='width:350px; padding:0;'>";
    $html .= "";
    while ($row = mysqli_fetch_array($ret)) {
      $name = $row["FirstName"] . " " . $row["MiddleName"] . " " . $row["LastName"];
      $id_no = $row2["Reg_ID"];
      $department = $row2['Reg_Course'];
      $id_issue = date('Y-m-d', strtotime($row2['Reg_date']));
      $id_issue_year = date('Y', strtotime($id_issue));
      $id_expire = date('Y-m-d', strtotime('+1 year', strtotime($id_issue)));
      $modality = $row['AdmissionType'];
      $image = $row['UserPic'];

      $html .= "
      <div class='container-0' style='text-align:left;' id='Student_ID'>
        <div class='header'>
        </div>
        
        <div class='container-2'>
        <div class='box-1'>
          <img src='userimages/$image'>
        </div>
          
          <div class='box-2'>
            <h2><b>$name</b></h2>
            <p style='font-size: 14px;'>Student</p>
          </div>
        </div>

        <div class='container-3'>
          <div class='info-1'>
            <div class='id'>
              <h4>ID Number</h4>
              <p><b>RVGDTR\\$id_no\\$id_issue_year</b></p>
            </div>
            <div class='department'>
              <h4>Department</h4>
              <p><b>$department</b></p>
            </div>
            <div class='modality'>
              <h4>Modality</h4>
              <p><b>$modality</b></p>
            </div>
          </div>
          
          <div class='info-2'>
            <div class='join-date'>
              <h4>ID Issue Date</h4>
              <p><b>$id_issue</b></p>
            </div>
            <div class='expire'>
              <h4>ID Expire Date</h4>
              <p><b>$id_expire</b></p>
            </div>
            <div class='campus'>
              <h4>Campus</h4>
              <p><b>Gada Campus</b></p>
            </div>
          </div>

          <div class='info-4'>
            <div class='sign'>
              <br>
              <p style='font-size:12px;'><em>Head of Registrar and Alumni's Signature Here</em></p>
            </div>
          </div>
        </div>
      </div>";
    }
  }*/
  // ID card generator ends here


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
        //$return_app_id = mysqli_query($con, "SELECT ID FROM tbladmapplications WHERE UserId = $uid");
        $id = mysqli_fetch_array($ret);
        $app_id = $id['ID'];

        $pay_receipt = $app_id . "_" . "receipt" . "_" . md5($payPic) . $extension_pic;
        move_uploaded_file($_FILES["pay_pic"]["tmp_name"], "userimages/payments/" . $pay_receipt);
        // now the system can push the data into tblpayments
        $query_pay = mysqli_query($con, "INSERT INTO tblpayments (Application_ID, Payer_ID, Payer_Name, Pay_Ref, Pay_Date, Pay_Receipt)
                  VALUES('$app_id', '$uid', '$name', '$payRef', '$payDate', '$pay_receipt')");
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
    <title>RVU-GADA : Student || Registration</title>
    <link rel="icon" type="image/png" href="../img/RVU-logo.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/custom_ID.css">
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
                            <h4 align="center">Registration Completed successfully <br> Click here for details</h4>
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
                <h3><b>An ID will be issued to you on reporting to the university</b></h3>
                <br><br><br>
                <div class="text-center">
                  <a href="dashboard.php"><button type="submit" name="submit" class="btn btn-primary mx-2" style="width: 300px;">Back to Dashboard</button></a>
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
    <?php //include('includes/footer.php'); 
    ?>

    <!--to handle the forwarding of values to pay-ver-parser.php -->
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <script src="app-assets/vendors/js/jquery-3.6.0.min.js"></script>
    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  </body>
<?php } ?>