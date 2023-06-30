<?php
session_start();
error_reporting(1);
include('includes/dbconnection.php');

if (strlen($_SESSION['aid'] == 0)) {
  header('location:logout.php');
} 
else {
  $app_id = $_GET['app_id'];
  $action = $_GET['action'];

  if ($action === 'accept') {
    // Accept payment
    $sql = mysqli_query($con, "SELECT UserId, CourseApplied FROM tbladmapplications WHERE ID = $app_id");
    $return = mysqli_fetch_array($sql);
    $user_id = $return['UserId'];
    $course = $return['CourseApplied'];

    //echo "Payment for application ID $app_id has been accepted.";
    $query_pay = mysqli_query($con, "UPDATE tblpayments SET Pay_Confirmed = 'verified' WHERE Application_ID = $app_id");
    $query_reg = mysqli_query($con, "INSERT INTO tblregistered (Reg_User_ID, Reg_Course) VALUES ('$user_id', '$course')");
    if ($query_pay && $query_reg){
      header("Location: ". "dashboard.php");
      exit();
    }else{
      //echo "Something happened when updating the database";
      header("Location: ". "error.php");
      exit();
    }

  } elseif ($action === 'decline') {
    // Decline payment
    $query_decline = mysqli_query($con, "DELETE FROM tblpayments WHERE Application_ID = $app_id");
    $query_adm = mysqli_query($con, "UPDATE tbladmissions SET Adm_Payment_Status = 'unpaid', Adm_Pay_Date = NULL WHERE Adm_App_ID = '$app_id'");
    if ($query_decline && $query_adm){
      // add email sender function here to update user about the situation.
      header("Location: ". "dashboard.php");
      exit();
    }else{
      //echo "Something happened when deleting the record from database";
      header("Location: ". "error.php");
      exit();
    }

  } else {
    // unprecedented error
    header("Location: ". "error.php");
  }
}
