<?php
include('includes/dbconnection.php');

// Get the email and token from the URL query string
$email = $_GET['email'];
$token = $_GET['token'];
//$ip_address = gethostbyname(gethostname());

// Check if the email and token match a user in the database
$result = mysqli_query($con, "SELECT * FROM tbluser WHERE Email='$email' AND Token='$token'");

if ($result->num_rows == 1) {
    // Update the user's status to "confirmed"
    $con->query("UPDATE tbluser SET status='confirmed' WHERE Email='$email'");
    ?>
    <script>
        alert('Your account has been confirmed successfully.\n You can now login to your account!')
        window.location.href = "login.php";
    </script>;
    <?php
    // Redirect the user to the login page
    exit;
} else {
    // Display an error message
    ?>
    <script>alert('Sorry, something went wrong. Please try again.')</script>';
    <?php
}
?>