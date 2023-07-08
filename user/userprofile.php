<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['uid'] == 0)) {
  header('location:logout.php');
} else {
?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>RVU-GADA : Student || User Profile</title>
    <link rel="icon" type="image/png" href="../img/RVU-logo.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/custom.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include('includes/header.php'); ?>
    <?php include('includes/leftbar.php'); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
              Profile
            </h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="dashboard.php">Dashboard </a>
                  </li>
                  <li class="breadcrumb-item active">Profile </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="content-body">
          <!-- Input Mask start -->

          <!-- Formatter start -->

          <form name="submit" method="post" enctype="multipart/form-data">
            <?php
            $pid = $_SESSION['uid'];
            $ret = mysqli_query($con, "select * from tbluser where ID='$pid'");
            $cnt = 1;
            while ($row = mysqli_fetch_array($ret)) { ?>
              <section class="formatter" id="formatter">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">User Profile</h4>
                      </div>

                      <div class="card-content">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                                <h5>First Name</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="firstname" name="firstname" value="<?php echo $row['FirstName']; ?>" type="text" readonly='true'>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                                <h5>Middle Name</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="middlename" name="middlename" value="<?php echo $row['MiddleName']; ?>" type="text" readonly='true' >
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                                <h5>Last Name</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="lastname" name="lastname" value="<?php echo $row['LastName']; ?>" type="text" readonly='true'>
                                </div>
                              </fieldset>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xl-6 col-lg-12">
                              <fieldset>
                                <h5>Email</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="email" name="email" type="email" value="<?php echo $row['Email']; ?>" readonly='true'>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-6 col-lg-12">
                              <h5>Password</h5>
                              <button type="button" onclick='window.location.href = "change-password.php"' class="btn btn-info btn-min-width mr-1 mb-1">Change Your Password</button>
                            </div>
                          </div>
                        <?php
                      } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- Formatter end -->
          </form>
        </div>
      </div>
    </div>

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include('includes/footer.php'); ?>
    <!-- BEGIN VENDOR JS-->
    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  </body>

  </html>
<?php  } ?>