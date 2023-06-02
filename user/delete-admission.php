<?php
include('includes/dbconnection.php');

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    // need to extract out the application ID from tbladmapplications before the application gets deleted as I'll need the ID for application removal from tbladmissions
    $ret = mysqli_query($con, "SELECT ID FROM tbladmapplications WHERE UserId='$uid'");
    $row = mysqli_fetch_array($ret);
    $app_id = $row['ID'];

    // Delete application from tbladmissions, tbladmapplications, and tbldocument
    mysqli_query($con, "DELETE FROM tbladmapplications WHERE UserId='$uid'");
    mysqli_query($con, "DELETE FROM tbldocument WHERE UserID='$uid'");
    mysqli_query($con, "DELETE FROM tbladmissions WHERE Adm_App_ID='$app_id'");

    // Redirect to acknowledgement page
    header("Location: decline-acknowledgement.php");
    exit();
} else {
    // Invalid request, redirect to an error page or appropriate action
    header("Location: error.php");
    exit();
}
?>
