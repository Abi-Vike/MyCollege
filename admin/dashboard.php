<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid']==0)) {    // was ==0
  header('location:logout.php');
  } else{
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>RVU-GADA : Admin Portal | Dashboard</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
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
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
   <?php include_once('includes/header.php');?>
 <?php include_once('includes/leftbar.php');?>
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
$sql =mysqli_query($con ,"SELECT ID from tblcourse");
$cntcourse=mysqli_num_rows($sql);

?>
 <h3 class="info"><?php echo $cntcourse;?></h3>
                      <h6>Listed Courses</h6>
                    </div>
                    <div>
         <i class="icon-file success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
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
$wer =mysqli_query($con ,"SELECT ID from tbluser");
$cntuser=mysqli_num_rows($wer);
 ?>
 <h3 class="warning"><?php echo $cntuser;?></h3>
                      <h6>Register Users</h6>
                    </div>
                    <div>
    <i class="icon-user-follow success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%"
                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
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
$ter =mysqli_query($con ,"SELECT ID from tbladmapplications");
$cntapp=mysqli_num_rows($ter);
?>

<h3 class="success"><?php echo $cntapp ;?></h3>
                      <h6>Total Applications</h6>
                    </div>
                    <div>
                      <i class="icon-user-follow success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>
          </div>
      <div class="row">
          <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                   <a href="pending-application.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
<?php 
$rtp =mysqli_query($con ,"SELECT ID from tbladmapplications where AdminStatus is null");
$penapp=mysqli_num_rows($rtp);
?>
 <h3 class="info"><?php echo $penapp;?></h3>
                      <h6>Pending Applications</h6>
                    </div>
                    <div>
         <i class="icon-file success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
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
$yui =mysqli_query($con ,"SELECT ID from tbladmapplications where AdminStatus='1'");
$selapp=mysqli_num_rows($yui);
 ?>
 <h3 class="warning"><?php echo $selapp;?></h3>
                      <h6>Selected Application</h6>
                    </div>
                    <div>
    <i class="icon-user-follow success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%"
                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
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
$poi =mysqli_query($con ,"SELECT ID from tbladmapplications where AdminStatus='2'");
$rejapp=mysqli_num_rows($poi);
?>
<h3 class="success"><?php echo $rejapp ;?></h3>
                      <h6>Rejected Application</h6>
                    </div>
                    <div>
                      <i class="icon-user-follow success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>
          </div>
        </div>
        </div></div></div>
       
<?php include('includes/footer.php');?>
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"
  type="text/javascript"></script>
  <script src="app-assets/data/jvector/visitor-data.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/pages/dashboard-sales.js" type="text/javascript"></script>
</body>
</html>
<?php } ?>