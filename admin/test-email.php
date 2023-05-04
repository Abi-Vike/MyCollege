<?php

use phpMailer\PHPMailer\PHPMailer;
use phpMailer\PHPMailer\Exception;

require 'includes/PHPMailer/src/Exception.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';

if(isset($_POST['send'])){
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $subject = htmlentities($_POST['subject']);
    $message = htmlentities($_POST['message']);

    $mail = new PHPMailer(true);
    $mail -> isSMTP();
    $mail -> Host = 'smtp.gmail.com';
    $mail -> SMTPAuth = true;
    $mail -> Username = 'riftvalleyuniversity0@gmail.com';  // sender email
    $mail -> Password = 'jneqfubiqenuzhsm';  // sender's gmail app password
    $mail -> Port = 465;
    $mail -> SMTPSecure = 'ssl';
    $mail -> isHTML(true);
    $mail -> setFrom($email, $name);
    $mail -> addAddress($email);  // receiver's emails 
    $mail -> Subject = "$subject";
    $mail -> Body = $message;
    $mail -> SMTPOptions = array(   // to bypass the unable to connect to SMTP server thing
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    if($mail -> send()){
        header("Location: ./response.php");
    }

}

?>