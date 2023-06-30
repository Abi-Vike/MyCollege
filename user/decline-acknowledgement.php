<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['uid']) == 0) {
  header('location:logout.php');
} else {
?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>RVU-GADA : Student || Offer Decline Acknowledgement</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    <?php include_once('includes/header.php'); ?>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include_once('includes/leftbar.php'); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
          <?php
          $uid = $_SESSION['uid'];
          //will need the name from tbluser as it has been deleted from tbladmapplications
          $ret = mysqli_query($con, "SELECT FirstName FROM tbluser WHERE ID='$uid'");
          $row = mysqli_fetch_array($ret);
          $fname = $row['FirstName'];

          ?>
          <h4>
            Dear <?php echo $fname ?>, <br><br>

            We have received your decision on our admission offer and We want to take a moment to acknowledge and appreciate your decision.
            We genuinely value your interest in our institution and the time and effort you invested in your application. Your application
            was thoroughly reviewed, and we are grateful for your consideration of our university for your academic pursuits. <br><br>
            Please be informed that we have noted your decision to decline our admission offer. Consequently, your application will be withdrawn
            from further consideration in our admission process. <br><br>
            Once again, We wish you the utmost success in your future endeavors and in finding a university that aligns perfectly with your
            aspirations and goals. <br><br>
            <strong>
              Best regards,<br><br>
              Rift Valley University Admissions Office
            </strong>
          </h4>
          <div align="center">
            <button onclick="window.location.href = 'dashboard.php';" type="submit" id="submit_button" name="submit" class="btn btn-success mx-2 mt-5" style="width: 300px;">Back to home</button>
          </div>
        </div>
      </div>
    </div>

    <?php include('includes/footer.php'); ?>
    
    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  </body>
  </html>
<?php } ?>