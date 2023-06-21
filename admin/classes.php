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
    <title>Gada AMS || Classes</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include_once('includes/header.php'); ?>
    <?php include_once('includes/leftbar.php'); ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
          <h3>
            <font color="blue">Classes - Undergraduate</font>
          </h3>
          <hr />

          <div class="row">
            <div class="col-lg-4 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="manage-course.php">
                    <div class="card-body" style="height:200px;">
                      <div class="media d-flex">
                        <div class="media-body text-center">
                          <?php
                          $sql_course = mysqli_query($con, "SELECT ID from tblcourse");
                          $cntcourse = mysqli_num_rows($sql_course);
                          ?>
                          <h1 class="info">Computer Science</h1>
                          <h5 class="danger">Enrolled Students: <?php echo $cntcourse; ?></h5>
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

            <div class="col-lg-4 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="manage-course.php">
                    <div class="card-body" style="height:200px;">
                      <div class="media d-flex">
                        <div class="media-body text-center">
                          <?php
                          $sql_course = mysqli_query($con, "SELECT ID from tblcourse");
                          $cntcourse = mysqli_num_rows($sql_course);
                          ?>
                          <h1 class="info">Nursing</h1>
                          <h5 class="danger">Enrolled Students: <?php echo $cntcourse; ?></h5>
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

            <div class="col-lg-4 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="manage-course.php">
                    <div class="card-body" style="height:200px;">
                      <div class="media d-flex">
                        <div class="media-body text-center">
                          <?php
                          $sql_course = mysqli_query($con, "SELECT ID from tblcourse");
                          $cntcourse = mysqli_num_rows($sql_course);
                          ?>
                          <h1 class="info">Pharmacy</h1>
                          <h5 class="danger">Enrolled Students: <?php echo $cntcourse; ?></h5>
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
          </div>

          <div class="row">
            <div class="col-lg-4 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="manage-course.php">
                    <div class="card-body" style="height:200px;">
                      <div class="media d-flex">
                        <div class="media-body text-center">
                          <?php
                          $sql_course = mysqli_query($con, "SELECT ID from tblcourse");
                          $cntcourse = mysqli_num_rows($sql_course);
                          ?>
                          <h1 class="info">Marketing Management</h1>
                          <h5 class="danger">Enrolled Students: <?php echo $cntcourse; ?></h5>
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

            <div class="col-lg-4 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="manage-course.php">
                    <div class="card-body" style="height:200px;">
                      <div class="media d-flex">
                        <div class="media-body text-center">
                          <?php
                          $sql_course = mysqli_query($con, "SELECT ID from tblcourse");
                          $cntcourse = mysqli_num_rows($sql_course);
                          ?>
                          <h1 class="info">Business Administration</h1>
                          <h5 class="danger">Enrolled Students: <?php echo $cntcourse; ?></h5>
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

            <div class="col-lg-4 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="manage-course.php">
                    <div class="card-body" style="height:200px;">
                      <div class="media d-flex">
                        <div class="media-body text-center">
                          <?php
                          $sql_course = mysqli_query($con, "SELECT ID from tblcourse");
                          $cntcourse = mysqli_num_rows($sql_course);
                          ?>
                          <h1 class="info">Accounting and Finance</h1>
                          <h5 class="danger">Enrolled Students: <?php echo $cntcourse; ?></h5>
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