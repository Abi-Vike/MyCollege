<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['login'])) {
  $adminuser = $_POST['usernameAdmin'];
  $password = md5($_POST['password']);
  $query = mysqli_query($con, "select ID from tbladmin where (Email='$adminuser' && Password='$password') ");
  $ret = mysqli_fetch_array($query);

  if ($ret > 0) {
    $_SESSION['aid'] = $ret['ID'];
    echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
  } else {
    //$error = mysqli_error($con);
    //echo "Error: $error";
    echo "<script>alert('Invalid Credentials!');</script>";
    //echo "<script type='text/javascript'> document.location ='login.php'; </script>";
  }
}
?>


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>

  <title>RVU Gada: Admin || Admin Login</title>
  <link rel="icon" type="image/png" href="../img/RVU-logo.png">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="../css/styles-merged.css">
  <link rel="stylesheet" href="../css/style.min.css">
  <link rel="stylesheet" href="../css/custom.css">

</head>

<body class="vertical-layout vertical-menu 1-column  bg-cyan bg-lighten-2 menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="1-column">
  <nav class="navbar navbar-default probootstrap-navbar" style="height:90px">
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
    </div>
  </nav>


  <div class="app-content content" style="margin-top : 25px">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!--Card starts here-->
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-3 col-xs-2 box-shadow-2 p-0"></div>
            <div class="col-md-6 col-xs-8 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0 pb-0">
                  <div class="card-title text-center">
                    <h4 style="font-weight: bold">Registrar Office Login</h4>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body">

                    <form class="form-horizontal" action="" name="login" method="post">
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" name="usernameAdmin" id="username" class="form-control input-lg" placeholder="Admin's Username or Email" tabindex="1" required="true">
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                        <div class="help-block font-small-3"></div>
                      </fieldset>

                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="2" required>
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                        <div class="help-block font-small-3"></div>
                      </fieldset>

                      <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                          <button type="submit" name="login" class="btn btn-info btn-lg btn-block" tabindex="3"><i class="ft-user"></i> Login</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-2 box-shadow-2 p-0"></div>
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

  <script src="../js/scripts.min.js"></script>
  <script src="../js/main.min.js"></script>
  <script src="../js/custom.js"></script>
</body>

</html>