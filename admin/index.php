<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['aid'])==0) {    // was ==0
header('location:logout.php');
}
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Redirecting.. to Dashboard</title>
    </head>
    <body>
        <?php 
            $true = true;
            if($true){
                header('location: dashboard.php');
            }
        ?>
    </body>
</html>