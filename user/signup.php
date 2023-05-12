<?php 
session_start();
error_reporting(0);

use phpMailer\PHPMailer\PHPMailer;
use phpMailer\PHPMailer\Exception;

require 'includes/PHPMailer/src/Exception.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';
include('includes/dbconnection.php');

// assuming "ngrok http 80" has been executed in server machine's terminal
// Making sure that ngrok is running and also that a valid url has been generated


// code that checks if there is an active ngrok session running
// Define the command to check for ngrok processes
$command = 'tasklist /FI "IMAGENAME eq ngrok.exe"';
// Execute the command and capture its output
$output = exec($command);

// Check if ngrok is running
if (strpos($output, 'ngrok.exe') !== false) {
    echo '* temporarily Info * An ngrok session is running ';
    // code to extract the ngrok generated url if exists
    // Define the ngrok API endpoint
    $apiEndpoint = 'http://localhost:4040/api/tunnels';
    
    // Get the JSON response from the API endpoint
    $json = file_get_contents($apiEndpoint);
    
    // Decode the JSON response into a PHP associative array
    $data = json_decode($json, true);
    
    // Get the first tunnel from the list of active tunnels
    $tunnel = $data['tunnels'][0];
    
    // Get the public URL of the tunnel
    $url = $tunnel['public_url'];
    echo 'URL: ', $url;
} else {
    echo 'No ngrok session is running';
    
}


if(isset($_POST['submit']))
  {
    $fname=$_POST['firstname'];
    $mname=$_POST['middlename'];
    $lname=$_POST['lastname'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $ret=mysqli_query($con, "select Email from tbluser where Email='$email'");
    $result=mysqli_fetch_array($ret);
    if($result>0){
      echo "<script>alert('This email-address is associated with another user');</script>";
    }
    else{
      $token = bin2hex(random_bytes(16));
      $query = mysqli_query($con, "insert into tbluser(FirstName, MiddleName, LastName, Email, Password, Token) value('$fname', '$mname', '$lname', '$email', '$password', '$token' )");
      if ($query) {
        $public_ip = file_get_contents('https://api.ipify.org');
        //echo "<script>alert('You have been registered successfully');</script>";
        //header("Location: ./login.php");
        $mail = new PHPMailer(true);
        $mail -> isSMTP();
        $mail -> Host = 'smtp.gmail.com';
        $mail -> SMTPAuth = true;
        $mail -> Username = 'riftvalleyuniversity0@gmail.com';  // sender email
        $mail -> Password = 'jneqfubiqenuzhsm';  // sender's gmail app password
        $mail -> Port = 465;
        $mail -> SMTPSecure = 'ssl';
        $mail -> isHTML(true);
        //$mail -> setFrom($email, $name);
        $mail -> setFrom($email, "RVU Registrar office");
        $mail -> addAddress($email);  // receiver's email
        $mail -> Subject = "Please confirm your email address";
        //$mail -> Body = "Hi $fname,\n\nPlease click the following link to confirm your email address:\n\nhttp://localhost/mycollege/user/email-confirmation.php?email=$email&token=$token";
        $mail -> Body = "Hi $fname,\n\nPlease click the following link to confirm your email address:\n\n$url/mycollege/user/email-confirmation.php?email=$email&token=$token";

        $mail -> SMTPOptions = array(   // to bypass the unable to connect to SMTP server thing
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
          )
        );

        if($mail -> send()){
          ?>
          <script>
            alert("Confirmation link has been sent to your email. Please check Spam box if you couldn't find it in the inbox.")
            window.location.href = "login.php";
          </script>';
          <?php

        }else{
          ?>
            <script>alert('Error.<?php $mail->ErrorInfo ?>')</script>';
          <?php
        }
      }
      else
      {
        ?>
            <script>alert('Something Went Wrong. Please try again.')</script>';
        <?php
      }
    }
  }
 ?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <title>College Admission Management System|| User Signup
  </title>
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="../css/styles-merged.css">
  <link rel="stylesheet" href="../css/style.min.css">
  <link rel="stylesheet" href="../css/custom.css">

<script type="text/javascript">
function checkpass(){
  if(document.signup.password.value!=document.signup.repeatpassword.value)
  {
    alert('Password and Repeat Password field do not match');
    document.signup.repeatpassword.focus();
    return false;
  }
  return true;
} 

</script>

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
        </nav>
-->
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
              <li><a href="login.php"><button class="btn btn-primary">Login</button></a></li>
            </ul>
          </div>
        </div>
      </nav>
  <!-- ////////////////////////////////////////////////////////////////////////////-->

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row"></div>
      <div class="content-body">
        <section class="flexbox-container">

          <div class="col-md-3 col-xs-2 box-shadow-2 p-0"></div>
          <div class="col-md-6 col-xs-8 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
              <div class="card-header border-0 pb-0">
                <div class="card-title text-center">
                  <h4 style="font-weight: bold"> Student's Signup</h4>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form  method="post" name="signup" onSubmit="return checkpass();">
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="text" name="firstname" id="firstname" required="true" class="form-control input-lg" placeholder="First Name" tabindex="1">
                      <div class="form-control-position">
                        <i class="ft-user"></i>
                      </div>
                    </fieldset>

                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="text" name="middlename" id="middlename" required="true" class="form-control input-lg" placeholder="Middle Name" tabindex="2">
                      <div class="form-control-position">
                        <i class="ft-user"></i>
                      </div>
                    </fieldset>
                    
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="text" name="lastname" id="lastname" required="true" class="form-control input-lg" placeholder="Last Name" tabindex="3">
                      <div class="form-control-position">
                        <i class="ft-user"></i>
                      </div>
                    </fieldset>
                      
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4" required="true" required data-validation-required-message="Please enter email address.">
                      <div class="form-control-position">
                        <i class="ft-mail"></i>
                      </div>
                      <div class="help-block font-small-3"></div>
                    </fieldset>

                    <div class="row">
                      <div class="col-12 col-sm-6 col-md-6">
                        <fieldset class="form-group position-relative has-icon-left">
                          <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5" required>
                          <div class="form-control-position">
                            <i class="la la-key"></i>
                          </div>
                          <div class="help-block font-small-3"></div>
                        </fieldset>
                      </div>
                      <div class="col-12 col-sm-6 col-md-6">
                        <fieldset class="form-group position-relative has-icon-left">
                          <input type="password" name="repeatpassword" id="repeatpassword" class="form-control input-lg"
                            placeholder="Repeat Password" tabindex="6" data-validation-matches-match="password" required="true" 
                            data-validation-matches-message="Password & Confirm Password must be the same.">
                          <div class="form-control-position">
                            <i class="la la-key"></i>
                          </div>
                          <div class="help-block font-small-3"></div>
                        </fieldset>
                      </div>
                    </div>
                
                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-12">
                        <button type="submit" name="submit" class="btn btn-info btn-lg btn-block"><i class="ft-user"></i> Register</button>

                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                      <p><a href="forget-password.php">Forgot password?</a></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-xs-2 box-shadow-2 p-0"></div>

        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  
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