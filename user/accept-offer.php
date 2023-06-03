<?php
include('includes/dbconnection.php');

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    // need to extract out the application ID from tbladmapplications as I only have the userID here
    $ret = mysqli_query($con, "SELECT ID FROM tbladmapplications WHERE UserId='$uid'");
    $row = mysqli_fetch_array($ret);
    $app_id = $row['ID'];

    // Update Adm_status inside tbladmissions
    // Redirect to register page
    $query = mysqli_query($con, "UPDATE tbladmissions SET Adm_Status = 'accepted', Adm_Accept_Date = CURRENT_TIMESTAMP WHERE Adm_App_ID = '$app_id'");
    if ($query){
      header("Location: register.php");
      exit();
    }
} else {
    // Invalid request, redirect to an error page or appropriate action
    header("Location: error.php");
    exit();
}
?>
