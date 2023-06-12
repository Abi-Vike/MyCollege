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

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    <?php include_once('includes/header.php'); ?>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include_once('includes/leftbar.php'); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">         
          <h3>
            <font color="red">Information Panel</font>
          </h3>
          <hr />
          
          <?php
          $uid = $_SESSION['uid'];
          // fetching basic application and admission status info
          $app = mysqli_query($con, "SELECT ID, AdminStatus from tbladmapplications where UserId='$uid'");
          $row = mysqli_fetch_array($app);
          $aid = $row['ID'];
          $adsts = $row['AdminStatus'];

          // now fetching some decision and payment related info
          $dec = mysqli_query($con, "SELECT Adm_Status from tbladmissions where Adm_App_ID='$aid'");
          $row2 = mysqli_fetch_array($dec);

          // use this to change info when offer accepted
          $offer_status = $row2['Adm_Status'];

          if ($row > 0) { ?>
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-12">
                <div class="card pull-up">
                  <div class="card-content"> <?php

                    // application still under review
                    if ($adsts == "") { ?>
                      <a href="addmission-form.php">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                                <h4 align="center">Your application has been submitted successfully and is under review !<br> Click here to see the summary of your application.</h4>
                            </div>
                            <div>
                              <i class="icon-file success font-large-2 float-right"></i>
                            </div>
                          </div>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </a><?php 
                    }

                    // application accepted
                    elseif ($adsts == "1") {?>
                      <a href="app-status.php">
                        <div class="card-body">
                        <?php 
                        if ($offer_status == "offered") {?>
                          <div class="media d-flex">
                            <div class="media-body text-left">
                                <h4 align="center">Decision has been made on your application. Click here for details</h4>
                            </div>
                            <div>
                              <i class="icon-file success font-large-2 float-right"></i>
                            </div>
                          </div>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-primary" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        <?php 
                        }elseif ($offer_status == "accepted") {
                          $reg = mysqli_query($con, "SELECT * from tblregistered where Reg_User_ID='$uid'");
                          if (mysqli_fetch_array($reg)){
                            // payment verified
                            ?>
                            <div class="media d-flex">
                              <div class="media-body text-left">
                                <h4 align="center">Continue to Student Portal</h4>
                              </div>
                              <div>
                                <i class="icon-file success font-large-2 float-right"></i>
                              </div>
                            </div>
                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                              <div class="progress-bar bg-gradient-x-cyan" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          <?php 
                          }else { ?>
                            <div class="media d-flex">
                              <div class="media-body text-left">
                                <h4 align="center">Continue to Registration</h4>
                              </div>
                              <div>
                                <i class="icon-file success font-large-2 float-right"></i>
                              </div>
                            </div>
                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                              <div class="progress-bar bg-gradient-x-purple" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          <?php }
                        } ?>
                        </div>
                      </a><?php 
                    } 

                    // status updated by registrar 
                    else {?>
                      <a href="app-status.php">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                                <h4 align="center">Decision has been made on your application. Click here for details</h4>
                            </div>
                            <div>
                              <i class="icon-file success font-large-2 float-right"></i>
                            </div>
                          </div>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-primary" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </a><?php 
                    } ?>

                  </div>
                </div>
              </div>
            </div>
          <?php
          } else { ?>
            <div class="row">
              <div class="col-12">
                <div class="card pull-up">
                  <div class="card-content">
                    <a href="addmission-form.php">
                      <div class="card-body">
                        <div class="media d-flex">
                          <div class="media-body text-left">
                            <h4 align="center">Click here to fill an admission application form.</h4>
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
          } ?>


          <?php
          /*
          $rtp =mysqli_query($con ,"SELECT ID from tbladmapplications where UserID='$uid'");
          $row=mysqli_fetch_array($rtp);
          if($row>0){
            $ret=mysqli_query($con,"select AdminStatus from tbladmapplications join tbldocument on tbldocument.UserID=tbladmapplications.UserID where tbldocument.UserID='$uid' and tbladmapplications.AdminStatus='1'");
            $num=mysqli_fetch_array($ret);
            
            if($num>0){ ?>
              <<div class="row" >
                <div class="col-12">
                  <div class="card pull-up">
                    <div class="card-content">
                      <a href="upload-doc.php">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h4 align="center">Your Application has been accepted and documents also uploaded successfully</h4>
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
          } */
          ?>


        </div>
      </div>
    </div>

    <?php include('includes/footer.php'); ?>
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