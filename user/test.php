<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//require 'includes/PHPMailer/src/Exception.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';

use phpMailer\PHPMailer\PHPMailer;
use phpMailer\PHPMailer\SMTP;
//use phpMailer\PHPMailer\Exception;


$mail = new PHPMailer();
$emailHost = '{imap.gmail.com:993/ssl}';
$emailUsername = 'riftvalleyuniversity0@gmail.com';
$emailPassword = 'jneqfubiqenuzhsm';
//set_time_limit(180); // Adjust the value as needed



// connecting to the email server
$inbox = imap_open($emailHost, $emailUsername, $emailPassword);

if ($inbox) {
  // Search Criteria
  //$senderEmail = 'tom0abr@gmail.com';
  echo "you're connected to the email server\n";

  $subjectKeyword = 'Fwd: Transaction Alert - BoA';
  $contentKeyword = 'Transaction Reference: FT23012B89Q9';
  
  // retieve emails
  $emails = imap_search($inbox, 'SUBJECT "'.$subjectKeyword.'"');

  if ($emails) {
    echo "Emails found.<br>";

    foreach ($emails as $emailId) {
      $emailBody = imap_body($inbox, $emailId);

      if (strpos($emailBody, $contentKeyword) !== false) {
        echo "Email Body:<br>";
        echo $emailBody;
        echo "<br>";
        echo "Content keyword found in this email.<br>";
      }
      //echo "Email Body:<br>";
      //echo $emailBody;
      //echo "<br>";
    }
  } else {
      echo 'No emails found.<br>';
  }
  imap_close($inbox);
} else {
  echo 'Failed to connect to the email server.';
}
?>