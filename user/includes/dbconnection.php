<?php
  //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  $con=mysqli_connect("localhost", "root", "", "student_data");
  if(mysqli_connect_errno()){
    echo "Connection Fail".mysqli_connect_error();
  }
?>