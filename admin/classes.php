<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid'] == 0)) {
  header('location:logout.php');
} else {
?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>RVU Gada: Admin || Classes</title>
    <link rel="icon" type="image/png" href="../img/RVU-logo.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include_once('includes/header.php'); ?>
    <?php include_once('includes/leftbar.php'); ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
          <h3>
            Departments | Classes
          </h3>
          <hr />

          <div class="row">
            <?php
            $ret = mysqli_query($con, "SELECT * FROM tblcourse");
            while ($row = mysqli_fetch_array($ret)) {
              $course_name = $row['CourseName'];
            ?>
              <div class="col-lg-4 col-12">
                <div class="card pull-up">
                  <div class="card-content">
                    <a href="ready-class.php?course_name=<?php echo urlencode($course_name); ?>">
                      <div class="card-body" style="height:150px;">
                        <div class="media d-flex">
                          <div class="media-body text-center">
                            <?php
                            $std_cnt = 0;
                            $std = mysqli_query($con, "SELECT Reg_ID FROM tblregistered WHERE Reg_Course = '$course_name'");
                            while ($row = mysqli_fetch_array($std)) {
                              $std_cnt += 1;
                            }
                            ?>
                            <h4><?php echo $course_name; ?></h4>
                            <h5 class="info">Enrolled Students: <?php echo $std_cnt; ?></h5>
                          </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                          <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            <?php
            } ?>
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
<?php
} ?>