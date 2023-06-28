<?php
include('includes/dbconnection.php');

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    // Delete application from tbladmapplications and tbldocument
    $del_application = mysqli_query($con, "DELETE FROM tbladmapplications WHERE UserId='$uid'");
    $del_documents = mysqli_query($con, "DELETE FROM tbldocument WHERE UserID='$uid'");

    if ($del_application && $del_documents) {
        echo "<script>
                alert('You have withdrawn your application successfully! \\nYou need to fill the form again incase you want to apply.');
                window.location.href = 'dashboard.php';
            </script>";
    } else {
        echo "<script>
                alert('Withdrawal Unsuccessful! \\nPlease try again or contact the office if the problem persists!');
                window.location.href = 'dashboard.php';
            </script>";
        echo "Withdrawal Unsuccessful!";
    }

} else {
    // Invalid request, redirect to an error page
    header("Location: error.php");
    exit();
}
