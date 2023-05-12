<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login']))
  {
    $emailcon=$_POST['emailcont'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID from tbluser where Email='$emailcon' && Password='$password' AND status='confirmed'");
    $ret=mysqli_fetch_array($query);
    
    if($ret>0){
      $_SESSION['uid']=$ret['ID'];
      echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    }
    else{
      //$error = mysqli_error($con);
      //echo "Error: $error";
      echo "<script>alert('Invalid Credentials!');</script>";
    }
  }
  ?>


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>Login Portal
  </title>
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="../css/styles-merged.css">
  <link rel="stylesheet" href="../css/style.min.css">
  <link rel="stylesheet" href="../css/custom.css">
</head>
<body class="vertical-layout vertical-menu 1-column  bg-cyan bg-lighten-2 menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu" data-col="1-column">
  <!-- fixed-top-->
  
  <!-- 
  <nav>
            <a href="#" class="logo">
                <img src="../images/logo.png" class="image1" width="320px" />
                
                <img src="https://1.bp.blogspot.com/-zeWCdTyFgZ4/YMhnzVchAlI/AAAAAAAAFaA/aWBlSPn-kSEsRVVi-LmAqoDHIzsG7JoaQCLcBGAsYHQ/s0/logo.png" class="image2" width="60px" height="60px" />
            </a>
            <input class="menu-btn" type="checkbox" id="menu-btn"/>
            <label class="menu-icon" for="menu-btn">
                <span class="nav-icon"></span>
            </label>
            <ul class="menu" style="border-radius: 5px;">
                <li><a href="#">About</a></li>
                <li><a href="#">Notification</a></li>
                <li><a href="#">Results</a></li>
                <li><a href="#courses">Courses</a></li>
                <li><a class="active" href="signup.php" onclick="document.getElementById('id01').style.display='block'" style="width:auto; border-radius: 5px; cursor: pointer;">Sign Up</a></li>
                <li><a class="active" href="login.php" onclick="document.getElementById('id01').style.display='block'" style="width:auto; border-radius: 5px; cursor: pointer;">sign in</a></li>
            </ul>
  </nav> -->
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  

  <nav class="navbar navbar-default probootstrap-navbar">
        <div class="container">
          <div class="navbar-header">
            <div class="btn-more js-btn-more visible-xs">
              <a href="#"><i class="icon-dots-three-vertical "></i></a>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html" title="uiCookies:Enlight">Enlight</a>
          </div>

          <div id="navbar-collapse" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="index.html">Home</a></li>
              <li><a href="courses.html">Courses</a></li>
              <li><a href="teachers.html">Teachers</a></li>
              <li><a href="events.html">Events</a></li>
              <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Pages</a>
                <ul class="dropdown-menu">
                  <li><a href="about.html">About Us</a></li>
                  <li><a href="courses.html">Courses</a></li>
                  <li><a href="course-single.html">Course Single</a></li>
                  <li><a href="gallery.html">Gallery</a></li>
                  <li class="dropdown-submenu dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span>Sub Menu</span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Second Level Menu</a></li>
                      <li><a href="#">Second Level Menu</a></li>
                      <li><a href="#">Second Level Menu</a></li>
                      <li><a href="#">Second Level Menu</a></li>
                    </ul>
                  </li>
                  <li><a href="news.html">News</a></li>
                </ul>
              </li>
              <li><a href="contact.html">Contact</a></li>
              <li><a href="signup.php"><button class="btn btn-danger">Sign Up</button></a></li>
            </ul>
          </div>
        </div>
      </nav>



  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">

        <!--card row starts here-->
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-3 col-xs-2 box-shadow-2 p-0"></div>
            <div class="col-md-6 col-xs-8 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0 pb-0">
                  <div class="card-title text-center">
                    <h4 style="font-weight: bold"> Student's Login</h4>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    
                    <form class="form-horizontal" action="" name="login"  method="post">  
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" name="emailcont" id="email" class="form-control input-lg" placeholder="Email" tabindex="1" required="true" >
                        <div class="form-control-position">
                          <i class="ft-mail"></i>
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
                        <div class="col-6 col-sm-6 col-md-6" tabindex="4">
                          <p><a href="forget-password.php">Forgot password?</a></p>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-xs-2 box-shadow-2 p-0"></div>
            </div>
          </div>
        </section>
        <!--card row ends here-->

      </div>
    </div>
  </div>
  <footer class="footer fixed-bottom footer-dark navbar-border navbar-shadow text-center">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <p style="color:grey;">Copyright (C) - 2023 | Developed By <a href="">RVU Dev-Team </a> </p>
    </p>
  </footer>

  <script src="../js/scripts.min.js"></script>
  <script src="../js/main.min.js"></script>
  <script src="../js/custom.js"></script>
</body>
</html>