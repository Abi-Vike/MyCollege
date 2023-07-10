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
    <title>RVU-GADA : Student || Student Portal</title>
    <link rel="icon" type="image/png" href="../img/RVU-logo.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include_once('includes/header.php'); ?>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include_once('includes/leftbar.php'); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
          <h3>
            <font color="red">Announcements</font>
          </h3>
          <hr>

          <?php
          $uid = $_SESSION['uid'];
          // fetching basic application and admission status info
          $app = mysqli_query($con, "SELECT * from tblnotice");
          $row = mysqli_fetch_array($app);
          $aid = $row['ID'];
          $adsts = $row['AdminStatus'];

          // now fetching some decision and payment related info
          $dec = mysqli_query($con, "SELECT Adm_Status from tbladmissions where Adm_App_ID='$aid'");
          $row2 = mysqli_fetch_array($dec);

          // use this to change info when offer accepted
          $offer_status = $row2['Adm_Status'];
          ?>
          <div class="content-body">
            <table class="table mb-0">
              <thead>
                <tr>
                  <th></th>
                  <th>Title</th>
                  <th></th>
                </tr>
              </thead>

              <?php
              $ret = mysqli_query($con, "select * from tblnotice");
              $cnt = 1;
              while ($row = mysqli_fetch_array($ret)) { ?>
                <tr>
                  <td><?php echo $cnt; ?></td>
                  <td><?php echo $row['Title']; ?></td>
                  <td><?php echo $row['Description']; ?></td>
                </tr>
              <?php
                $cnt = $cnt + 1;
              } ?>
            </table>
          </div>

          <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
          <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
          <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  </body>

  </html>
<?php } ?>