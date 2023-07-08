<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['uid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $userid = $_SESSION['uid'];
    $cpassword = md5($_POST['currentpassword']);
    $newpassword = md5($_POST['newpassword']);
    $query = mysqli_query($con, "SELECT ID, Password FROM tbluser WHERE ID='$userid' AND Password='$cpassword'");
    $row = mysqli_fetch_array($query);

    if ($row > 0) {
      if ($row['Password'] != $newpassword) {
        $ret = mysqli_query($con, "update tbluser set Password='$newpassword' where ID='$userid'");
        echo '<script>alert("Your password has been changed successully!")</script>';
      } else {
        echo '<script>alert("Your old and new passwords are the same. Please try again!")</script>';
      }
    } else {
      echo '<script>alert("The current password you entered is not correct!")</script>';
    }
  }
?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>RVU - Gada: Student || Change Password</title>
    <link rel="icon" type="image/png" href="../img/RVU-logo.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include('includes/header.php'); ?>
    <?php include('includes/leftbar.php'); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
              Change Password
            </h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">Change Password</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="content-body">
          <form method="post" name="changepassword" onsubmit="return checkpass();">
            <section class="formatter" id="formatter">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-content">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-xl-6 col-lg-12">
                            <fieldset>
                              <h5>Current Password</h5>
                              <div class="form-group">
                                <input class="form-control white_bg" id="currentpassword" name="currentpassword" type="password" required="true">
                              </div>
                            </fieldset>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-xl-6 col-lg-12">
                            <fieldset>
                              <h5>New Password</h5>
                              <div class="form-group">
                                <input class="form-control white_bg" id="newpassword" type="password" name="newpassword" required="true">
                              </div>
                            </fieldset>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-xl-6 col-lg-12">
                            <fieldset>
                              <h5>Confirm Password</h5>
                              <div class="form-group">
                                <input class="form-control white_bg" id="confirmpassword" type="password" name="confirmpassword" required="true">
                              </div>
                            </fieldset>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-xl-6 col-lg-12">
                            <button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Change</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </form>
        </div>
      </div>
    </div>

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include('includes/footer.php'); ?>

    <!--scripts to control password properties-->
    <script type="text/javascript">
      function checkpass() {
        var password = document.changepassword.newpassword.value;
        var confirmpassword = document.changepassword.confirmpassword.value;

        if (password.length < 8) {
          alert('Password should be at least 8 characters long');
          document.changepassword.password.focus();
          return false;
        }

        if (password !== confirmpassword) {
          alert('New Password and Confirm New Password fields do not match');
          document.changepassword.confirmpassword.focus();
          return false;
        }
        return true;
      }
    </script>
    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  </body>
  </html>
<?php }  ?>