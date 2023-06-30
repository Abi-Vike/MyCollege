<?php
session_start();
error_reporting(0);

use phpMailer\PHPMailer\PHPMailer;
use phpMailer\PHPMailer\Exception;

require 'includes/PHPMailer/src/Exception.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';

include('includes/dbconnection.php');

// sent from emeil-confirm-reset
$email = $_GET['email'];
$token = $_GET['token'];

// when user clicks set password
if (isset($_POST['submit'])) {
  $newpassword = md5($_POST['password']);
  $c_newpassword = md5($_POST['repeatpassword']);

  $ret = mysqli_query($con, "SELECT FirstName, Email, Token FROM tbluser WHERE Email = '$email' AND Token='$token'");
  $result = mysqli_fetch_assoc($ret);

  if ($result > 0) {
    mysqli_query($con, "UPDATE tbluser SET Password='$newpassword' WHERE Email='$email'");
    echo '<script>alert("Your password has been reset successully!\\nUse your new password to login.")>window.close();</script>';
    exit();
  } else {
    echo '<script>alert("Unable to reset your password. Please try again!")</script>';
  }
}
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>

  <title>RVU-GADA : Student || Password Reset
  </title>
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="../css/styles-merged.css">
  <link rel="stylesheet" href="../css/style.min.css">
  <link rel="stylesheet" href="../css/custom.css">
</head>

<body class="vertical-layout vertical-menu 1-column  bg-cyan bg-lighten-2 menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="1-column">
  <nav class="navbar navbar-default probootstrap-navbar">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <img src="app-assets/images/RVU-logo.png" alt="rvulogo" class="img-sm-responsive img-rounded img-fluid" style="width: auto; height: 75px; margin-top:7px" href="index.php">
      </div>

      <div id="navbar-collapse" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../index.html"><b>Home</b></a></li>
          <li><a href="https://riftvalleyuniversity.org/blog/"><b>News</b></a></li>
          <li><a href="../index.html#gallery"><b>Gallery</b></a></li>
          <li><a href="../index.html#footer"><b>Contact</b></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="app-content content" style="margin-top : 25px">
    <div class="content-wrapper">
      <div class="content-header row"></div>
      <div class="content-body">
        <!--Card starts here-->
        <section class="flexbox-container">
          <div class="col-md-3 col-xs-2 box-shadow-2 p-0"></div>
          <div class="col-md-6 col-xs-8 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
              <div class="card-header border-0 pb-0">
                <div class="card-title text-center">
                  <h4 style="font-weight: bold">Reset Your Password</h4>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">

                  <form method="post" name="reset" onsubmit="return checkpass();">
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="password" name="password" id="password" class="form-control input-lg" placeholder="New Password" tabindex="1" required>
                      <div class="form-control-position">
                        <i class="la la-key"></i>
                      </div>
                      <div class="help-block font-small-3"></div>
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="password" name="repeatpassword" id="repeatpassword" class="form-control input-lg" placeholder="Confirm New Password" tabindex="2" data-validation-matches-match="password" required="true" data-validation-matches-message="Password & Confirm Password must be the same.">
                      <div class="form-control-position">
                        <i class="la la-key"></i>
                      </div>
                      <div class="help-block font-small-3"></div>
                    </fieldset>
                    <br>
                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-12" tabindex="3">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block"><i class="ft-user"></i>Set Password</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->

  <footer class="footer fixed-bottom footer-dark navbar-border navbar-shadow text-center">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2" style="margin-bottom : 20vh">
    <p style="color:grey;">Copyright (C) - 2023 | Developed By <a href="about-us.html" class="text-primary">RVU Dev-Team </a> </p>
    </p>
  </footer>

  <!--script to control password properties-->
  <script type="text/javascript">
    function checkpass() {
      var password = document.reset.password.value;
      var repeatpassword = document.reset.repeatpassword.value;

      if (password.length < 8) {
        alert('Password should be at least 8 characters long');
        document.reset.password.focus();
        return false;
      }

      if (password !== repeatpassword) {
        alert('New Password and Confirm New Password fields do not match');
        document.reset.repeatpassword.focus();
        return false;
      }
      return true;
    }
  </script>
  <script src="../js/scripts.min.js"></script>
  <script src="../js/main.min.js"></script>
  <script src="../js/custom.js"></script>
</body>

</html>