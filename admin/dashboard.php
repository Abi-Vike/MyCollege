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
    <title>Gada AMS || Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/custom.css">
    </style>
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include_once('includes/header.php'); ?>
    <?php //include_once('../user/includes/header.php')
    ?>
    <?php include_once('includes/leftbar.php'); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
          <div class="row">
            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="manage-course.php">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <?php
                          $sql_course = mysqli_query($con, "SELECT ID from tblcourse");
                          $cntcourse = mysqli_num_rows($sql_course);
                          ?>
                          <h3 class="success"><?php echo $cntcourse; ?></h3>
                          <h4>Available Courses</h4>
                          <!--associated with manage-course.php-->
                        </div>
                        <div>
                          <i class="icon-book-open font-large-2 float-right mute-icon"></i>
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

            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="user-detail.php">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <?php
                          $sql_user = mysqli_query($con, "SELECT ID from tbluser");
                          $cntuser = mysqli_num_rows($sql_user);
                          ?>
                          <h3 class="success"><?php echo $cntuser; ?></h3>
                          <h4>Registered Users</h4>
                          <!--associated with user-detail.php-->
                        </div>
                        <div>
                          <i class="icon-users font-large-2 float-right mute-icon"></i>
                        </div>
                      </div>

                      <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="classes.php">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <?php
                          $sql_adm = mysqli_query($con, "SELECT CourseName FROM tblcourse");
                          $adms = mysqli_num_rows($sql_adm);
                          ?>
                          <h3 class="success"><?php echo $adms; ?></h3>
                          <h4>Departments and Classes</h4>
                        </div>
                        <div>
                          <i class="icon-flag font-large-2 float-right mute-icon"></i>
                        </div>
                      </div>

                      <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="all-application.php">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <?php
                          $sql_apps = mysqli_query($con, "SELECT ID from tbladmapplications");
                          $cntapp = mysqli_num_rows($sql_apps);
                          ?>
                          <h3 class="success"><?php echo $cntapp; ?></h3>
                          <h4>All Applications</h4>
                          <!--associated with all-application.php-->
                        </div>
                        <div>
                          <i class="icon-docs font-large-2 float-right mute-icon"></i>
                        </div>
                      </div>
                      <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="pending-application.php">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <?php
                          $sql_pen = mysqli_query($con, "SELECT ID from tbladmapplications where AdminStatus is null");
                          $penapp = mysqli_num_rows($sql_pen);
                          ?>
                          <h3 class="success"><?php echo $penapp; ?></h3>
                          <h4>Pending For Review</h4>
                          <!--associated with pending-application.php-->
                        </div>
                        <div>
                          <i class="icon-hourglass font-large-2 float-right mute-icon"></i>
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

            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="selected-application.php">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <?php
                          $sql_acc = mysqli_query($con, "SELECT ID from tbladmapplications where AdminStatus='1'");
                          $selapp = mysqli_num_rows($sql_acc);
                          ?>
                          <h3 class="success"><?php echo $selapp; ?></h3>
                          <h4>Accepted Applications</h4>
                          <!--associated with selected-application.php-->
                        </div>
                        <div>
                          <i class="icon-check font-large-2 float-right mute-icon"></i>
                        </div>
                      </div>

                      <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="rejected-application.php">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <?php
                          $sql_rej = mysqli_query($con, "SELECT ID from tbladmapplications where AdminStatus='2'");
                          $rejapp = mysqli_num_rows($sql_rej);
                          ?>
                          <h3 class="success"><?php echo $rejapp; ?></h3>
                          <h4>Rejected Applications</h4>
                          <!--associated with rejected-application.php-->
                        </div>
                        <div>
                          <i class="icon-trash font-large-2 float-right mute-icon"></i>
                        </div>
                      </div>

                      <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="waiting-list.php">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <?php
                          $sql_wai = mysqli_query($con, "SELECT ID from tbladmapplications where AdminStatus='3'");
                          $wailis = mysqli_num_rows($sql_wai);
                          ?>
                          <h3 class="success"><?php echo $wailis; ?></h3>
                          <h4>Waiting List</h4>
                          <!--associated with waiting-list.php-->
                        </div>
                        <div>
                          <i class="icon-clock font-large-2 float-right mute-icon"></i>
                        </div>
                      </div>

                      <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="admitted-applicants.php">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <?php
                          $sql_adm = mysqli_query($con, "SELECT Adm_App_ID FROM tbladmissions WHERE Adm_Status = 'accepted'");
                          $adms = mysqli_num_rows($sql_adm);
                          ?>
                          <h3 class="success"><?php echo $adms; ?></h3>
                          <h4>Admissions & Registrations</h4>
                          <!--associated with admitted-applicants.php-->
                        </div>
                        <div>
                          <i class="icon-pencil font-large-2 float-right mute-icon"></i>
                        </div>
                      </div>

                      <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <a href="manage-notice.php">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <?php
                          $sql_adm = mysqli_query($con, "SELECT ID FROM tblnotice");
                          $adms = mysqli_num_rows($sql_adm);
                          ?>
                          <h3 class="success"><?php echo $adms; ?></h3>
                          <h4>Public Announcements</h4>
                          <!--associated with admitted-applicants.php-->
                        </div>
                        <div>
                          <i class="icon-info font-large-2 float-right mute-icon"></i>
                        </div>
                      </div>

                      <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
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