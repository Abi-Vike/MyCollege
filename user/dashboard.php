<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['uid'])==0){
  header('location:logout.php');
} else {
  ?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <title>RVU-GADA : Student portal | Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
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
  
  <body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    <?php include_once('includes/header.php');?>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include_once('includes/leftbar.php');?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
          <!-- Revenue, Hit Rate & Deals -->
          <?php
          $uid=$_SESSION['uid'];
          $ret=mysqli_query($con,"select FirstName from tbluser where ID='$uid'");
          $row=mysqli_fetch_array($ret);
          $name=$row['FirstName'];
          ?>
          <h3><font color="red">Welcome</font> 
            <?php echo $name;?> 
          </h3>
          <hr />
          <?php 
          $uid=$_SESSION['uid'];
          $rtp =mysqli_query($con ,"SELECT AdminStatus from tbladmapplications where UserID='$uid'");
          $row=mysqli_fetch_array($rtp);
          $adsts=$row['AdminStatus'];
          
          if($row>0){ ?>
            <div class="row" >
              <div class="col-xl-10 col-lg-12 col-12">
                <div class="card pull-up">
                  <div class="card-content">
                    <a href="addmission-form.php">
                      <div class="card-body">
                        <div class="media d-flex">
                          <div class="media-body text-left"> <?php 
                            if($adsts==1) {?>
                              <h4 align="center">Your application status has been updated. Click here for details(1111)</h4>
                              <?php 
                            } ?> <?php 
                            
                            if($adsts==2) {?>
                              <h4 align="center">Your application status has been updated. Click here for details(2222)</h4>
                              <?php 
                            } ?> <?php 
                            
                            if($adsts=="3") {?>
                              <h4 align="center">Your application status has been updated. Click here for details(3333)</h4>
                              <?php 
                            } ?>
                          </div>
                          
                          <div>
                            <i class="icon-file success font-large-2 float-right"></i>
                          </div>
                        </div>
                        
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                          <?php 
                          if($adsts=="") {?>
                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div> 
                            <?php 
                          } ?> <?php 
                          
                          if($adsts=="2") {?>
                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div> 
                            <?php 
                          } ?> <?php 
                          
                          if($adsts=="1") {?>
                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div> 
                            <?php 
                          } ?>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <?php 
          } else{?>
            <div class="row" >
              <div class="col-xl-10 col-lg-12 col-12">
                <div class="card pull-up">
                  <div class="card-content">
                    <a href="addmission-form.php">
                      <div class="card-body">
                        <div class="media d-flex">
                          <div class="media-body text-left">
                            <h4 align="center">You have not yet applied for admission. Please fill the admission form.</h4>
                          </div>
                          <div>
                            <i class="icon-file success font-large-2 float-right"></i>
                          </div>
                        </div>
                  
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                          <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div> 
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <?php 
          } ?> <?php

          $rtp =mysqli_query($con ,"SELECT ID from tbladmapplications where UserID='$uid'");
          $row=mysqli_fetch_array($rtp);
          if($row>0){
            $ret=mysqli_query($con,"select AdminStatus from tbladmapplications join tbldocument on tbldocument.UserID=tbladmapplications.UserID where tbldocument.UserID='$stuid' and  tbladmapplications.AdminStatus='1'");
            $num=mysqli_fetch_array($ret);
            
            if($num>0){ ?>
              <div class="row" >
                <div class="col-xl-10 col-lg-12 col-12">
                  <div class="card pull-up">
                    <div class="card-content">
                      <a href="addmission-form.php">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h4 align="center">Your Application has been accepted and documents also uploaded successfully</h4>
                            </div>
    
                            <div>
                              <i class="icon-file success font-large-2 float-right"></i>
                            </div>
                          </div>
      
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
            } else 
            {?>
              <div class="row" >
                <div class="col-xl-10 col-lg-12 col-12">
                  <div class="card pull-up">
                    <div class="card-content">
                      <a href="upload-doc.php">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h4 align="center">Upload your documents</h4>
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
                </div>
              </div>
              <?php 
            }  
          }?>
        </div>
      </div>
    </div>
  <!--</div> I think this was just a mistake--> 
  
  <?php include('includes/footer.php');?>
  <!-- BEGIN VENDOR JS-->
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js" type="text/javascript"></script>
  <script src="app-assets/data/jvector/visitor-data.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="app-assets/js/scripts/pages/dashboard-sales.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>
<?php } ?>