<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <p>
        Message Sent!
    </p>

</body>

</html>

<?php
////////////// BETTER USE THIS LOGIC BELOW. IT'S MORE RELIABLE!
    /*
    if ($admsta == '1') {
      if ($AdmissionStatus_i == '1') {
        // means user has already got an offer
        echo "<script>alert('An admission offer already sent to the applicant!\n Your request will be ignored.')window.close();</script>";
      } elseif ($AdmissionStatus_i == '2') {
        // user had been rejected previously
        // might need admin confirmation here
        $query = mysqli_query($con, "UPDATE tbladmapplications SET AdminRemark='$admrmk', AdminStatus='$admsta' WHERE UserId='$uid'");
        if ($query) {
          $query_admitted = mysqli_query($con, "INSERT INTO tbladmissions (Adm_App_ID, Adm_Course) VALUES ('$ID_i', '$CourseApplied_i')");
          if ($query_admitted) {
            // call a function from emailer.php
            SendApplicationStatus($toemail, $ID_i, $FirstName_i, $CourseApplied_i, $AdmissionType_i);
          } else {
            echo "<script>alert('Unable to add application to admitted students list')</script>";
          }
        }else{
          echo "unable to change status in tbladmapplications";
        }
      } elseif ($AdmissionStatus_i == '3') {
        $query = mysqli_query($con, "UPDATE tbladmapplications SET AdminRemark='$admrmk', AdminStatus='$admsta' WHERE UserId='$uid'");
        if ($query) {
          $query_admitted = mysqli_query($con, "INSERT INTO tbladmissions (Adm_App_ID, Adm_Course) VALUES ('$ID_i', '$CourseApplied_i')");
          if ($query_admitted) {
            // call a function from emailer.php
            SendApplicationStatus($toemail, $ID_i, $FirstName_i, $CourseApplied_i, $AdmissionType_i);
          } else {
            echo "<script>alert('Unable to add application to admitted students list')</script>";
          }
        }else{
          echo "unable to change status in tbladmapplications";
        }
      } else {
        echo "Trust me, you're in a huge trouble if you've come here dude!";
      }
    } else if ($admsta == '2') {
      if ($AdmissionStatus_i == '1') {
      } elseif ($AdmissionStatus_i == '2') {
      } elseif ($AdmissionStatus_i == '3') {
      } else {
        echo "Trust me dude, you're in a big trouble if you've come here!";
      }
    } else if ($admsta == '3') {
      if ($AdmissionStatus_i == '1') {
      } elseif ($AdmissionStatus_i == '2') {
      } elseif ($AdmissionStatus_i == '3') {
      } else {
        echo "Wassup dude.. if you've come here, ur in a trap I guess :)";
      }
    } else {
      echo "wait, what?? How come it gets to this position?";
    }
    */
    ///////////////
?>