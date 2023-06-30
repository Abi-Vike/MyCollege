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
  echo '*temp-info* An ngrok session is running, ';
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
  echo '*temp-info* No ngrok session is running!';
}

// when user clicks register / signup
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $ret = mysqli_query($con, "SELECT FirstName, Email FROM tbluser WHERE Email = '$email'");
  $result = mysqli_fetch_array($ret);
  $fname = $result['FirstName'];

  if ($result > 0) {
    $token = bin2hex(random_bytes(16));
    $query = mysqli_query($con, "UPDATE tbluser SET Token = '$token' ");

    if ($query) {
      $public_ip = file_get_contents('https://api.ipify.org');
      //echo "<script>alert('You have been registered successfully');</script>";
      //header("Location: ./login.php");
      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'riftvalleyuniversity0@gmail.com';  // sender email
      $mail->Password = 'jneqfubiqenuzhsm';  // sender's gmail app password
      $mail->Port = 465;
      $mail->SMTPSecure = 'ssl';
      $mail->isHTML(true);
      //$mail -> setFrom($email, $name);
      $mail->setFrom($email, "RVU Registrar Office");
      $mail->addAddress($email);  // receiver's email
      $mail->Subject = "Request for account recovery";
    }

    if ($url) {
      // there is an active Ngrok session
      $mail->Body = "Dear $fname,<br><br>We've noticed that you requested for an account recovery. Please click this following link to reset your password. You can safely ignore this email if you didn't request it.<br>$url/mycollege/user/email-confirm-reset.php?email=$email&token=$token";
      $mail->SMTPOptions = array(  // to bypass the unable to connect to SMTP server thing
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );

      if ($mail->send()) {
?>
        <script>
          alert("A link has been sent to your email. Please check in the Spam-box if you couldn't find it in your inbox.")
          window.location.href = "login.php";
        </script>;
      <?php

      } else {
      ?>
        <script>
          alert('Error.<?php $mail->ErrorInfo ?>')
        </script>';
      <?php
      }
    } elseif (!$url) {
      // there is no active Ngrok session
      $mail->Body = "Dear $fname,<br><br>We've noticed that you requested for an account recovery. Please click this following link to reset your password. You can safely ignore this email if you didn't request it.<br>http://localhost/mycollege/user/email-confirm-reset.php?email=$email&token=$token";
      $mail->SMTPOptions = array(   // to bypass the unable to connect to SMTP server thing
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );

      if ($mail->send()) {
      ?>
        <script>
          alert("A link has been sent to your email. Please check in the Spam-box if you couldn't find it in your inbox.")
          window.location.href = "login.php";
        </script>';
      <?php

      } else {
      ?>
        <script>
          alert('Error.<?php $mail->ErrorInfo ?>')
        </script>';
<?php
      }
    }
  } else {
    echo "<script>alert('The email-address you provided is not recognized!');</script>";
  }
}
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>

  <title>RVU-GADA : Student || Recover Password
  </title>
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="../css/styles-merged.css">
  <link rel="stylesheet" href="../css/style.min.css">
  <link rel="stylesheet" href="../css/custom.css">

  <script type="text/javascript">
    function checkpass() {
      if (document.signup.password.value != document.signup.repeatpassword.value) {
        alert('Password and Repeat Password field do not match');
        document.signup.repeatpassword.focus();
        return false;
      }
      return true;
    }
  </script>
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
                  <h4 style="font-weight: bold">Password Recovery</h4>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">

                  <form method="post" name="signup" onSubmit="return checkpass();">
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4" required="true" required data-validation-required-message="Please enter email address.">
                      <div class="form-control-position">
                        <i class="ft-mail"></i>
                      </div>
                      <div class="help-block font-small-3"></div>
                    </fieldset>
                    <br>
                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-12" tabindex="1">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block"><i class="ft-user"></i>Find Account</button>
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

  <script src="../js/scripts.min.js"></script>
  <script src="../js/main.min.js"></script>
  <script src="../js/custom.js"></script>
</body>

</html>