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
    <title>RVU-GADA : Student || Dashboard</title>
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

          if ($row > 0) {
            // hide the admission form link from left bar this point onwards
            $_SESSION['hideAdmissionFormLink'] = true;
          ?>
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-12">
                <div class="card pull-up">
                  <div class="card-content">
                    <?php
                    // application still under review
                    if ($adsts == "") { ?>
                      <a href="addmission-form.php">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h4 align="center">Your application has been submitted successfully and is under review !<br> Click here to see the summary of your application.</h4>
                            </div>
                          </div>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-purple" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </a>
                    <?php
                    }

                    // application accepted
                    elseif ($adsts == "1") { ?>
                      <a href="app-status.php">
                        <div class="card-body">
                          <?php
                          if ($offer_status == "offered") { ?>
                            <div class="media d-flex">
                              <div class="media-body text-left">
                                <h4 align="center">Decision has been made on your application. Click here for details</h4>
                              </div>
                            </div>
                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                              <div class="progress-bar bg-gradient-x-purple" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <?php
                          } elseif ($offer_status == "accepted") {
                            $reg = mysqli_query($con, "SELECT * from tblregistered where Reg_User_ID='$uid'");
                            if (mysqli_fetch_array($reg)) {
                              // payment verified
                            ?>
                              <a href="pay-cond.php">
                                <div class="media d-flex">
                                  <div class="media-body text-left">
                                    <h4 align="center">Registration Successful</h4>
                                  </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                  <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </a>
                            <?php
                            } else { ?>
                              <div class="media d-flex">
                                <div class="media-body text-left">
                                  <h4 align="center">Continue to Registration</h4>
                                </div>
                              </div>
                              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                <div class="progress-bar bg-gradient-x-purple" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                          <?php }
                          } ?>
                        </div>
                      </a>
                    <?php
                    }

                    // status updated by registrar 
                    else { ?>
                      <a href="app-status.php">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h4 align="center">Decision has been made on your application. Click here for details</h4>
                            </div>
                          </div>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-purple" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </a>
                    <?php
                    } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php
            if ($adsts == "") { ?>
              <div><br><br></div>
              <div class="text-center">
                <button type="submit" id="submit_button" name="submit" class="btn btn-warning" onclick="confirmWithdrawal()">Withdraw Application</button>
              </div>
            <?php
            } ?>

            <?php
            // only after applicant registered successfully
            $reg = mysqli_query($con, "SELECT * from tblregistered where Reg_User_ID='$uid'");
            if (mysqli_fetch_array($reg)) { ?>
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-12">
                  <div class="card pull-up">
                    <div class="card-content">
                      <a href="student-portal.php">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h4 align="center">Student Portal</h4>
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
                          <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php
          } ?>
        </div>
      </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <script>
      function confirmWithdrawal() {
        if (confirm("Are you sure you want to withdraw your admission application? \nThis action can't be Undone!")) {
          var uid = <?php echo json_encode($uid); ?>;
          window.location.href = 'application-withdrawal.php?uid=' + encodeURIComponent(uid);
        }
      }
    </script>
    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  </body>

  </html>
<?php } ?>