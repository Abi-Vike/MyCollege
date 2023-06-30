<?php
include('includes/dbconnection.php');

// Get the email and token from the URL query string
$email = $_GET['email'];
$token = $_GET['token'];
//$ip_address = gethostbyname(gethostname());

// Check if the email and token match a user in the database
$result = mysqli_query($con, "SELECT * FROM tbluser WHERE Email='$email' AND Token='$token'");

if ($result->num_rows == 1) {
    // Redirect users to password-reset with their email and token
    $redirectUrl = "password-reset.php?email=$email&token=$token";
    header("Location: " . $redirectUrl);
    exit;
} else {
    // Display an error message
?>
    <script>
        alert('Sorry, something went wrong. Please try again.')
    </script>';
<?php
}
?>