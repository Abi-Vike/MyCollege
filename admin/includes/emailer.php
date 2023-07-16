<?php
use phpMailer\PHPMailer\PHPMailer;
use phpMailer\PHPMailer\Exception;

require 'includes/PHPMailer/src/Exception.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail -> isSMTP();
$mail -> Host = 'smtp.gmail.com';
$mail -> SMTPAuth = true;
$mail -> Username = 'riftvalleyuniversity0@gmail.com';  // sender email
$mail -> Password = 'jneqfubiqenuzhsm';  // sender's gmail app password
$mail -> Port = 465;
$mail -> SMTPSecure = 'ssl';
$mail -> isHTML(true);

//email to tell users that

//email to tell users that their application's status has changed. 
function SendApplicationStatus($toemail, $ID_i, $FirstName_i, $CourseApplied_i, $AdmissionType_i ) {
    global $mail;
    //$mail -> setFrom($email, $name);
    $mail -> setFrom($toemail, "RVU Registrar office");
    $mail -> addAddress($toemail);  // receiver's email
    $mail -> Subject = "Response To Admission Application";
    $mail -> Body = "<html>
                        <body>
                            <div style='text-align:center;'>
                                <div style='display:inline-block; text-align:left'>
                                    <img src='https://live.staticflickr.com/65535/52913847707_b31b2fba91_c.jpg' style='display: inline-block; text-align: left; width: auto; height: auto; margin-top:7px' id='email_rvu_logo'>
                                    <div style='position:center; text-align:left; color:black'>
                                        <strong>Application ID: $ID_i <br><br>
                                        Dear $FirstName_i, <br><br>
                                        Re: Application to $CourseApplied_i, $AdmissionType_i program</strong><br><br>
                                        We’re writing to let you know that we’ve updated your $CourseApplied_i application. <br><br>
                                        You can review this update by logging on to your <a href='https://localhost/mycollege/user/login.php'>applicant portal</a>. <br><br>
                                        If you have any questions about your application or the admissions process, please don’t 
                                        hesitate to contact us at rvu.admissions.sup@gmail.com <br><br>
                                        <strong>Kind regards, <br><br>
                                        Rift Valley University Admissions Team</strong>
                                    </div>
                                </div>
                            </div>
                        </body>
                    </html>";
    $mail -> SMTPOptions = array(   // to bypass the unable to connect to SMTP server thing
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true )
    );

    if($mail -> send()){
    //header("Location: ./dashboard.php");
    echo "<script>alert('Application status updated & Email notification just sent to applicant!')>window.close();</script>";
    }else{
    echo "<script>alert(Something's wrong! Reach out to tech team ASAP!)</script>";
    }
}

//email to remind user who has't paid. 
function SendPayReminder($toemail, $ID_i, $FirstName_i, $CourseApplied_i, $AdmissionType_i) {
    global $mail;
    //$mail -> setFrom($email, $name);
    $mail -> setFrom($toemail, "RVU Registrar office");
    $mail -> addAddress($toemail);  // receiver's email
    $mail -> Subject = "Complete Registration Payment within 5 Working Days to Secure Admission";
    $mail -> Body = "<html>
                        <body>
                            <div style='text-align:center;'>
                                <div style='display:inline-block; text-align:left'>
                                    <img src='https://live.staticflickr.com/65535/52913847707_b31b2fba91_c.jpg' style='display: inline-block; text-align: left; width: auto; height: auto; margin-top:7px' id='email_rvu_logo'>
                                    <div style='position:center; text-align:left; color:black'>
                                        <strong>Application ID: $ID_i <br><br>
                                        Dear $FirstName_i, <br><br>
                                        Re: Application to $CourseApplied_i, $AdmissionType_i program</strong><br><br>
                                        As the Registrar's Office, we have been processing your application diligently, and we are pleased to inform you that you have been accepted for the upcoming academic year. 
                                        However, we have noticed that we have not yet received your registration payment, which is a crucial step to secure your admission. To ensure your place in the program, 
                                        it is vital that you complete the payment of 300 Birr within the next 5 working days.<br><br>
                                        Please note that failure to complete the registration payment within the given timeframe may result in the cancellation of your admission. We understand that unforeseen 
                                        circumstances can occur, so if you are facing any difficulties or have concerns about the payment process, we urge you to contact our office immediately via rvu.admissions.sup@gmail.com and 
                                        Our dedicated staff will be more than happy to assist you and provide any necessary guidance.
                                        <br><br> Complete your registration in the <a href='https://localhost/mycollege/user/login.php'>applicant portal</a>. <br><br>
                                        <strong>Kind regards, <br><br>
                                        Rift Valley University Admissions Team</strong>
                                    </div>
                                </div>
                            </div>
                        </body>
                    </html>";
    $mail -> SMTPOptions = array(   // to bypass the unable to connect to SMTP server thing
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true )
    );

    if($mail -> send()){
    //header("Location: ./dashboard.php");
    echo "<script>alert('Reminder Email just sent to applicant!')>window.close();</script>";
    }else{
    echo "<script>alert(Something's wrong! Reach out to tech team ASAP!)</script>";
    }
}

?>