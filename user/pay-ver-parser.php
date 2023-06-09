<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
error_reporting(0);
include('includes/dbconnection.php');

require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';

use phpMailer\PHPMailer\PHPMailer;
use phpMailer\PHPMailer\SMTP;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the payRef and payDate values are present in the $_POST array from payment-verify.php
  if (isset($_POST['uid']) && isset($_POST['payRef']) && isset($_POST['payDate'])) {
    // Retrieve the values
    $uid = $_POST['uid'];
    $payRef = $_POST['payRef'];
    $payDate = $_POST['payDate'];
    // date needes to be formatted from Y-m-d to d/m/y for search convenience 
    $formattedPayDate = date('d/m/Y', strtotime($payDate));

    echo $payRef . "<br>";
    echo $formattedPayDate . "<br>";

    $mail = new PHPMailer();
    $emailHost = '{imap.gmail.com:993/ssl}';
    $emailUsername = 'riftvalleyuniversity0@gmail.com';
    $emailPassword = 'jneqfubiqenuzhsm';
    //set_time_limit(180); 

    // connecting to the email server
    $inbox = imap_open($emailHost, $emailUsername, $emailPassword);

    if ($inbox) {
      // Search Criteria
      $subjectKeyword = 'Fwd: Transaction Alert - BoA';
      $receiptCode = $payRef;
      $receiptDate = $formattedPayDate;
      $receiptAmount = 'Amount: ETB 300.00';

      // retrieve specific emails
      $emails = imap_search($inbox, 'SUBJECT "' . $subjectKeyword . '"');
      if ($emails) {
        $count = 0; //just need to be one or more to verify payment N.B:- assuming that reference codes are uniqe 
        echo "emails from BOA found.<br>";
        // relevant emails found;
        foreach ($emails as $emailId) {
          $emailBody = imap_body($inbox, $emailId);
          // using stripos for case-insensitive search and applying strict comparison
          if (stripos($emailBody, 'Transaction reference: ' . $receiptCode) !== false && stripos($emailBody, $receiptDate) !== false && (stripos($emailBody, $receiptAmount)) !== false) {
              $count += 1;
          } 
        }
        if ($count != 0) {
          // send email notifcation to user
          // add to tbl registered
          $query_course = mysqli_query($con, "SELECT CourseApplied FROM tbladmapplications WHERE UserId = '$uid'");
          $course = mysqli_fetch_array($query_course)['CourseApplied'];

          $query_pay = mysqli_query($con, "UPDATE tblpayments SET Pay_Confirmed = 'verified' WHERE Payer_ID = '$uid'");
          $query_reg = mysqli_query($con, "INSERT INTO tblregistered (Reg_User_ID, Reg_Course) VALUES ('$uid', '$course')");

          if ($query_pay && $query_reg) {
            header("Location: ". "app-status.php");
            //echo "Eureka - done<br>";
            exit();
          } else {
            header("Location: ". "app-status.php");
            //echo "query failed<br>";
            exit();
          }
        } else {
          // either report hasn't been mailed in or applicant hasn't paid
          header("Location: ". "app-status.php");
          //echo "count not greater zan 0<br>";
          //exit();
        }
      } else {
        header("Location: ". "error.php");
        //echo "emails with the subject not found<br>";
        exit();
      }
      //imap_close($inbox);
    } else {
      // system unable to connect to email server
      header("Location: " . "error.php");
      exit();
    }
  } else {
    // Missing payRef or payDate values
    header("Location: " . "app-status.php");
    exit();
  }
} else {
  header("Location: " . "error.php");
  exit();
}

//$payRef = $_POST['pay_ref'];
//$payDate = $_POST['pay_date'];
