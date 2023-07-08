<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include('includes/dbconnection.php');

if (isset($_GET['uid'])) {
  $uid = $_GET['uid'];
  // extract out info from tbladmapplications and tblregistered
  $ret = mysqli_query($con, "SELECT * FROM tbladmapplications WHERE UserId = $uid");
  $ret2 = mysqli_query($con, "SELECT * FROM tblregistered WHERE Reg_User_ID = $uid");
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
      <div class='container-0' id='Student_ID'>
        <div class='header'>
        </div>
        
        <div class='container-2'>
        <div class='box-1'>
          <img src='../user/userimages/$image'>
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
            <div class='sign' id='sign'>
              <br>
              <p style='font-size:12px;'><em>Head of Registrar and Alumni's Signature Here</em></p>
            </div>
          </div>
        </div>
      </div>";
    }
  }
  // ID card generator ends here
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <title>RVU-GADA : Admin || Student ID</title>
  <link rel="icon" type="image/png" href="../img/RVU-logo.png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/custom_ID.css">
</head>

<style>
  #print-button {
    top: 10px;
    padding: 10px;
    width: 100px;
    margin: 0 0 15px 35vw;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  @media print {
    body {
      padding: 0;
      margin: -25px -5vw 0 -5vw;
    }

    #header_part,
    #sidebar_part,
    #footer_part,
    #print-button,
    #sign,
    .breadcrumb-wrapper {
      display: none;
    }
  }
</style>

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
        <div class="card-body" id="mycard">
          <?php echo $html ?>
        </div>
        <div class="card-body" id="mycard">
          <button id="print-button" class="btn btn-warning" onclick="window.print()">Print</button>
        </div>
      </div>
    </div>
  </div>

  <!--to handle the forwarding of values to pay-ver-parser.php -->
  <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
  <script src="app-assets/vendors/js/jquery-3.6.0.min.js"></script>
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
</body>