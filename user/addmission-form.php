<?php
session_start();
error_reporting(1);
include('includes/dbconnection.php');
if (strlen($_SESSION['uid'] == 0)) {
  header('location:logout.php');
} else {
  // Coding for form Submission 	
  if (isset($_POST['submit'])) {
    $uid = $_SESSION['uid'];
    $coursename = $_POST['coursename'];
    $admissionType = $_POST['admissionType'];

    // personal information
    // sanitizing user inputs for errors and basic sql injection prevention
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $nationality = mysqli_real_escape_string($con, $_POST['nationality']);
    
    $dobGregorian = $_POST['dobGregorian'];
    $dobEthiopian = $_POST['dobEthiopian'];
    $gender = $_POST['gender'];
    $upic = $_FILES["userpic"]["name"];

    $cobirth = mysqli_real_escape_string($con, $_POST['cobirth']);
    $pobtown = mysqli_real_escape_string($con, $_POST['pobtown']);
    $pobworeda = mysqli_real_escape_string($con, $_POST['pobworeda']);
    $pobkebele = mysqli_real_escape_string($con, $_POST['pobkebele']);

    // father's information
    $ffirstname = mysqli_real_escape_string($con, $_POST['ffirstname']);
    $fmiddlename = mysqli_real_escape_string($con, $_POST['fmiddlename']);
    $flastname = mysqli_real_escape_string($con, $_POST['flastname']);

    // mother's information
    $mfirstname = mysqli_real_escape_string($con, $_POST['mfirstname']);
    $mmiddlename = mysqli_real_escape_string($con, $_POST['mmiddlename']);
    $mlastname = mysqli_real_escape_string($con, $_POST['mlastname']);

    // residence and contact
    $restown = mysqli_real_escape_string($con, $_POST['restown']);
    $resworeda = mysqli_real_escape_string($con, $_POST['resworeda']);
    $reskebele = mysqli_real_escape_string($con, $_POST['reskebele']);
    $reshouse = mysqli_real_escape_string($con, $_POST['reshouse']);

    $phone1 = mysqli_real_escape_string($con, $_POST['phone1']);
    $phone2 = mysqli_real_escape_string($con, $_POST['phone2']);
    $marital = $_POST['marital'];

    $emename = mysqli_real_escape_string($con, $_POST['emename']);
    $emephone = mysqli_real_escape_string($con, $_POST['emephone']);
    $emetown = mysqli_real_escape_string($con, $_POST['emetown']);
    $emerelation = $_POST['emerelation'];

    // educational background
    $sch_name_1 = mysqli_real_escape_string($con, $_POST['sch_name_1']);
    $sch_town_1 = mysqli_real_escape_string($con, $_POST['sch_town_1']);
    $sch_year_1 = mysqli_real_escape_string($con, $_POST['sch_year_1']);
    $sch_stream_1 = mysqli_real_escape_string($con, $_POST['sch_stream_1']);
    
    $sch_name_2 = mysqli_real_escape_string($con, $_POST['sch_name_2']);
    $sch_town_2 = mysqli_real_escape_string($con, $_POST['sch_town_2']);
    $sch_year_2 = mysqli_real_escape_string($con, $_POST['sch_year_2']);
    $sch_stream_2 = mysqli_real_escape_string($con, $_POST['sch_stream_2']);
    
    $sch_name_3 = mysqli_real_escape_string($con, $_POST['sch_name_3']);
    $sch_town_3 = mysqli_real_escape_string($con, $_POST['sch_town_3']);
    $sch_year_3 = mysqli_real_escape_string($con, $_POST['sch_year_3']);
    $sch_stream_3 = mysqli_real_escape_string($con, $_POST['sch_stream_3']);

    $ins_name_1 = mysqli_real_escape_string($con, $_POST['ins_name_1']);
    $ins_country_1 = mysqli_real_escape_string($con, $_POST['ins_country_1']);
    $ins_year_1 = mysqli_real_escape_string($con, $_POST['ins_year_1']);
    $ins_major_1 = mysqli_real_escape_string($con, $_POST['ins_major_1']);

    $ins_name_2 = mysqli_real_escape_string($con, $_POST['ins_name_1']);
    $ins_country_2 = mysqli_real_escape_string($con, $_POST['ins_country_2']);
    $ins_year_2 = mysqli_real_escape_string($con, $_POST['ins_year_2']);
    $ins_major_2 = mysqli_real_escape_string($con, $_POST['ins_major_2']);

    $ins_name_3 = mysqli_real_escape_string($con, $_POST['ins_name_3']);
    $ins_country_3 = mysqli_real_escape_string($con, $_POST['ins_country_3']);
    $ins_year_3 = mysqli_real_escape_string($con, $_POST['ins_year_3']);
    $ins_major_3 = mysqli_real_escape_string($con, $_POST['ins_major_3']);

    $passport = $_FILES["passport"]["name"];
    $highSchool_transcript = $_FILES["highSchool_trans"]["name"];
    $tenth_certificate = $_FILES["tenth_cert"]["name"];
    $twelfth_certificate = $_FILES["twelfth_cert"]["name"];
    $post_sec_transcript = $_FILES["post_sec_trans"]["name"];
    $post_sec_certificate = $_FILES["post_sec_cert"]["name"];
    $additional_documents = $_FILES["additional_docs"]["name"];

    $extension_pic = substr($upic, strlen($upic) - 4, strlen($upic));
    $extension_passport = substr($passport, strlen($passport) - 4, strlen($passport));
    $extension_highSchool_transcript = substr($highSchool_transcript, strlen($highSchool_transcript) - 4, strlen($highSchool_transcript));
    $extension_tenth_certificate = substr($tenth_certificate, strlen($tenth_certificate) - 4, strlen($tenth_certificate));
    $extension_twelfth_certificate = substr($twelfth_certificate, strlen($twelfth_certificate) - 4, strlen($twelfth_certificate));
    $extension_post_sec_transcript = substr($post_sec_transcript, strlen($post_sec_transcript) - 4, strlen($post_sec_transcript));
    $extension_post_sec_certificate = substr($post_sec_certificate, strlen($post_sec_certificate) - 4, strlen($post_sec_certificate));
    $extension_additional_documents = substr($additional_documents, strlen($additional_documents) - 4, strlen($additional_documents));

    $dec = $_POST['declaration'];
    $sign = mysqli_real_escape_string($con, $_POST['signature']);

    // allowed extensions for docs and applicant pic
    $allowed_extensions_pic = array(".jpg", ".png", ".jpeg", ".gif");
    $allowed_extensions_doc = array(".pdf", ".PDF");  // or maybe change it to application/pdf
    // Validation for allowed extensions .in_array() function searches an array for a specific value.

    if (!in_array($extension_pic, $allowed_extensions_pic)) {
      echo "<script>alert('Invalid format. Only image files are allowed');</script>";
    } elseif (!in_array($extension_passport, $allowed_extensions_doc)) {
      echo "<script>alert('Invalid format. Only PDF formats are allowed');</script>";
    } elseif (!in_array($extension_highSchool_transcript, $allowed_extensions_doc)) {
      echo "<script>alert('Invalid format. Only PDF formats are allowed');</script>";
    } elseif (!in_array($extension_tenth_certificate, $allowed_extensions_doc)) {
      echo "<script>alert('Invalid format. Only PDF formats are allowed');</script>";
    } elseif (!in_array($extension_twelfth_certificate, $allowed_extensions_doc)) {
      echo "<script>alert('Invalid format. Only PDF formats are allowed');</script>";
    } else {
      // Applicant's photo query writing starts here
      // rename user pic
      $userpic = $firstname . "_" . md5($upic) . $extension_pic;
      move_uploaded_file($_FILES["userpic"]["tmp_name"], "userimages/" . $userpic);
      // Only now should it upload to the database
      $query1 = mysqli_query($con, "insert into tbladmapplications( 
            UserId, CourseApplied, AdmissionType, FirstName, MiddleName, LastName, Nationality, DobGregorian, 
            DobEthiopian, Gender, UserPic, CountryOfBirth, TownOfBirth, WoredaOfBirth,
            KebeleOfBirth, FatherFirstName, FatherMiddleName, FatherLastName, MotherFirstName, 
            MotherMiddleName, MotherLastName, ResidenceTown, ResidenceWoreda, ResidenceKebele, 
            ResidenceHouse, PhoneNumber,PhoneNumber2, MaritalStatus, EmergencyName, 
            EmergencyPhone, EmergencyTown, EmergencyRelation, SchoolName1, SchoolTown1, 
            SchoolLastYear1, SchoolStream1, SchoolName2, SchoolTown2, SchoolLastYear2, 
            SchoolStream2, SchoolName3, SchoolTown3, SchoolLastYear3, SchoolStream3, InsName1, 
            InsCountry1, InsLastYear1, InsMajor1, InsName2, InsCountry2, InsLastYear2, InsMajor2, 
            InsName3, InsCountry3, InsLastYear3, InsMajor3, Signature) value('$uid', '$coursename', 
            '$admissionType', '$firstname', '$middlename', '$lastname', '$nationality', '$dobGregorian', 
            '$dobEthiopian', '$gender', '$userpic', '$cobirth', '$pobtown', '$pobworeda', '$pobkebele', 
            '$ffirstname', '$fmiddlename', '$flastname', '$mfirstname', '$mmiddlename', '$mlastname', 
            '$restown', '$resworeda', '$reskebele', '$reshouse', '$phone1', '$phone2', '$marital', 
            '$emename', '$emephone', '$emetown', '$emerelation', '$sch_name_1', '$sch_town_1', 
            '$sch_year_1', '$sch_stream_1', '$sch_name_2', '$sch_town_2', '$sch_year_2', '$sch_stream_2', 
            '$sch_name_3', '$sch_town_3', '$sch_year_3', '$sch_stream_3', '$ins_name_1', '$ins_country_1', 
            '$ins_year_1', '$ins_major_1', '$ins_name_2', '$ins_country_2', '$ins_year_2', '$ins_major_2', 
            '$ins_name_3', '$ins_country_3', '$ins_year_3', '$ins_major_3', '$sign')");

      // Applicant's photo query writing ends here


      // docs query writing starts here
      //rename upload file
      $pass = $firstname . "_" . md5($passport) . $extension_passport;
      $highSchool_T = $firstname . "_" . md5($highSchool_transcript) . $extension_highSchool_transcript;
      $tenth_C = $firstname . "_" . md5($tenth_certificate) . $extension_tenth_certificate;
      $twelfth_C = $firstname . "_" . md5($twelfth_certificate) . $extension_twelfth_certificate;

      if ($post_sec_transcript != "") {
        if (!in_array($extension_post_sec_transcript, $allowed_extensions_doc)) {
          echo "<script>alert('Invalid format. Only PDF formats are allowed');</script>";
        } else {
          $post_sec_T = $firstname . "_" . md5($post_sec_transcript) . $extension_post_sec_transcript;
        }
      } else {
        $post_sec_T = "";
      }

      if ($post_sec_certificate != "") {
        if (!in_array($extension_post_sec_certificate, $allowed_extensions_doc)) {
          echo "<script>alert('Invalid format. Only PDF formats are allowed');</script>";
        } else {
          $post_sec_C = $firstname . "_" . md5($post_sec_certificate) . $extension_post_sec_certificate;
        }
      } else {
        $post_sec_C = "";
      }

      if ($additional_documents != "") {
        if (!in_array($extension_additional_documents, $allowed_extensions_doc)) {
          echo "<script>alert('Invalid format. Only PDF formats are allowed');</script>";
        } else {
          $additionals = $firstname . "_" . md5($post_sec_certificate) . $extension_additional_documents;
        }
      } else {
        $additionals = "";
      }
      move_uploaded_file($_FILES["passport"]["tmp_name"], "userdocs/" . $pass);
      move_uploaded_file($_FILES["highSchool_trans"]["tmp_name"], "userdocs/" . $highSchool_T);
      move_uploaded_file($_FILES["tenth_cert"]["tmp_name"], "userdocs/" . $tenth_C);
      move_uploaded_file($_FILES["twelfth_cert"]["tmp_name"], "userdocs/" . $twelfth_C);
      move_uploaded_file($_FILES["post_sec_trans"]["tmp_name"], "userdocs/" . $post_sec_T);
      move_uploaded_file($_FILES["post_sec_cert"]["tmp_name"], "userdocs/" . $post_sec_C);
      move_uploaded_file($_FILES["additional_docs"]["tmp_name"], "userdocs/" . $additionals);

      $query2 = mysqli_query($con, "insert into tbldocument(UserID, Passport, HighSchoolTranscript, TenthCertificate, TwelfthCertificate, 
                          PostSecondaryTranscript, PostSecondaryCertificate, AdditionalDocuments) 
                          value('$uid','$pass','$highSchool_T','$tenth_C','$twelfth_C','$post_sec_T', '$post_sec_C', '$additionals')");

      // docs query writing ends here


      if ($query1 && $query2) {
        echo '<script>alert("Your application has been submitted successfully.")</script>';
        echo "<script>window.location.href ='addmission-form.php'</script>";
      } else {
        echo '<script>alert("Something Went Wrong. Please try again.")</script>';
        echo "<script>window.location.href ='addmission-form.php'</script>";
      }
    }
  }
?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>RVU Gada: Student || Admission Form</title>
    <link rel="icon" type="image/png" href="../img/RVU-logo.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css//custom2.css">
  </head>

  <body onbeforeunload="return myFunction()" class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <?php include('includes/header.php'); ?>
    <?php include('includes/leftbar.php'); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
              Admission Application Form
            </h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">Application</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="content-body">
          <?php
          $stuid = $_SESSION['uid'];
          $query = mysqli_query($con, "select * from tbladmapplications where UserId=$stuid");
          $rw = mysqli_num_rows($query);

          $query_email = mysqli_query($con, "select Email from tbluser where Id=$stuid");
          $res_email = mysqli_fetch_assoc($query_email);


          if ($rw > 0) {
            $query_docs = mysqli_query($con, "select * from tbldocument where  UserID=$stuid");

            while ($row = mysqli_fetch_array($query)) { ?>
              <button id="print-button" class="btn btn-primary" onclick="window.print()">Print</button>
              <p style="font-size:16px; color:red" align="center">Your Application Summary</p>
              <table border="1" class="table mb-0">
                <tr>
                  <th>Course</th>
                  <td><?php echo $row['CourseApplied']; ?></td>
                </tr>
                <tr>
                  <th>Admission Type</th>
                  <td><?php echo $row['AdmissionType']; ?></td>
                </tr>
                <tr>
                  <th>Applicant's Photo</th>
                  <td><img src="userimages/<?php echo $row['UserPic']; ?>" width="200" height="200"></td>
                </tr>
                <tr>
                  <th>Applicant's Full Name</th>
                  <td><?php echo $row['FirstName'], " ", $row['MiddleName'], " ", $row['LastName']; ?></td>
                </tr>
                <tr>
                  <th>Date of Birth</th>
                  <td><?php echo $row['DobGregorian']; ?></td>
                </tr>
                <tr>
                  <th>Date of Birth - Ethiopian</th>
                  <td><?php echo $row['DobEthiopian']; ?></td>
                </tr>
                <tr>
                  <th>Gender</th>
                  <td><?php echo $row['Gender']; ?></td>
                </tr>
                <tr>
                  <th>Nationality</th>
                  <td><?php echo $row['Nationality']; ?></td>
                </tr>
                <tr>
                  <th>Place of Birth</th>
                  <td><?php echo $row['CountryOfBirth'] . ", " . $row['TownOfBirth'] . ", " . $row['WoredaOfBirth'] . ", " . $row['KebeleOfBirth']; ?></td>
                </tr>
                <tr>
                  <th>Father's Full Name</th>
                  <td><?php echo $row['FatherFirstName'] . " " . $row['FatherMiddleName'] . " " . $row['FatherLastName']; ?></td>
                </tr>
                <tr>
                  <th>Mother's Full Name</th>
                  <td><?php echo $row['MotherFirstName'] . " " . $row['MotherMiddleName'] . " " . $row['MotherLastName']; ?></td>
                </tr>
                <tr>
                  <th>Residence</th>
                  <td><?php echo $row['ResidenceTown'] . ", " . $row['ResidenceWoreda'] . ", " . $row['ResidenceKebele'] . ", " . $row['ResidenceHouse']; ?></td>
                </tr>
                <tr>
                  <th>Primary Phone Number</th>
                  <td><?php echo $row['PhoneNumber']; ?></td>
                </tr>
                <tr>
                  <th>Alternative Phone Number</th>
                  <td>
                    <?php
                    if ($row['PhoneNumber2'] == "") { ?>
                      N/A
                    <?php
                    } else { ?>
                    <?php echo $row['PhoneNumber2'];
                    } ?>
                  </td>
                </tr>
                <tr>
                  <th>Email Address</th>
                  <td><?php echo $res_email["Email"] ?></td>
                </tr>
                <tr>
                  <th>Marital Status</th>
                  <td><?php echo $row['MaritalStatus']; ?></td>
                </tr>
                <tr>
                  <th>Emergency Contact</th>
                  <td><?php echo $row['EmergencyName'] . ", " . $row['EmergencyPhone'] . ", " . $row['EmergencyTown']; ?></td>
                </tr>
              </table>

              <table class="table mb-0">
                <tr>
                  <th>#</th>
                  <th>Secondary School</th>
                  <th>Town</th>
                  <th>Last Year Attended</th>
                  <th>Stream</th>
                </tr>
                <tr>
                  <th>1</th>
                  <td><?php echo $row['SchoolName1']; ?></td>
                  <td><?php echo $row['SchoolTown1']; ?></td>
                  <td><?php echo $row['SchoolLastYear1']; ?></td>
                  <td><?php echo $row['SchoolStream1']; ?></td>
                </tr>
                <?php
                if (!empty($row['SchoolName2'])) { ?>
                  <tr>
                    <th>2</th>
                    <td><?php echo $row['SchoolName2']; ?></td>
                    <td><?php echo $row['SchoolTown2']; ?></td>
                    <td><?php echo $row['SchoolLastYear2']; ?></td>
                    <td><?php echo $row['SchoolStream2']; ?></td>
                  </tr>
                  <?php
                  if (!empty($row['SchoolName3'])) { ?>
                    <tr>
                      <th>3</th>
                      <td><?php echo $row['SchoolName3']; ?></td>
                      <td><?php echo $row['SchoolTown3']; ?></td>
                      <td><?php echo $row['SchoolLastYear3']; ?></td>
                      <td><?php echo $row['SchoolStream3']; ?></td>
                    </tr>
                <?php
                  }
                } ?>
              </table>

              <?php
              if (!empty($row['InsName1'])) { ?>
                <table class="table mb-0">
                  <tr>
                    <th>#</th>
                    <th>Post Secondary School</th>
                    <th>Country</th>
                    <th>Last Year Attended</th>
                    <th>Study Major</th>
                  </tr>
                  <tr>
                    <th>1</th>
                    <td><?php echo $row['InsName1']; ?></td>
                    <td><?php echo $row['InsCounty1']; ?></td>
                    <td><?php echo $row['InsLastYear1']; ?></td>
                    <td><?php echo $row['InsMajor1']; ?></td>
                  </tr>
                  <?php
                  if (!empty($row['InsName2'])) { ?>
                    <tr>
                      <th>2</th>
                      <td><?php echo $row['InsName2']; ?></td>
                      <td><?php echo $row['InsCountry2']; ?></td>
                      <td><?php echo $row['InsLastYear2']; ?></td>
                      <td><?php echo $row['InsMajor2']; ?></td>
                    </tr>
                    <?php
                    if (!empty($row['InsName3'])) { ?>
                      <tr>
                        <th>3</th>
                        <td><?php echo $row['InsName3']; ?></td>
                        <td><?php echo $row['InsCountry3']; ?></td>
                        <td><?php echo $row['InsLastYear3']; ?></td>
                        <td><?php echo $row['InsMajor3']; ?></td>
                      </tr>
                  <?php
                    }
                  } ?>
                </table>
              <?php
              }
            }
            while ($row_d = mysqli_fetch_array($query_docs)) { ?>
              <table class="table mb-0">
                <tr>
                  <th>National ID / Passport</th>
                  <td><a href="userdocs/<?php echo $row_d['Passport']; ?>" target="_blank">View File </a></td>
                </tr>
                <tr>
                  <th>High School Transcript</th>
                  <td><a href="userdocs/<?php echo $row_d['HighSchoolTranscript']; ?>" target="_blank">View File </a></td>
                </tr>
                <tr>
                  <th>10th Grade National Examination Report</th>
                  <td><a href="userdocs/<?php echo $row_d['TenthCertificate']; ?>" target="_blank">View File </a></td>
                </tr>
                <tr>
                  <th>12th Grade National Examination Report</th>
                  <td><a href="userdocs/<?php echo $row_d['TwelfthCertificate']; ?>" target="_blank">View File </a></td>
                </tr>
                <tr>
                  <th>Post Secondary Education Transcript</th>
                  <td>
                    <?php
                    if ($row_d['PostSecondaryTranscript'] == "") { ?>
                      N/A
                    <?php
                    } else { ?>
                      <a href="userdocs/<?php echo $row_d['PostSecondaryTranscript']; ?>" target="_blank">View File </a>
                    <?php
                    } ?>
                  </td>
                </tr>
                <tr>
                  <th>Post Secondary Education Certificate</th>
                  <td>
                    <?php
                    if ($row_d['PostSecondaryCertificate'] == "") { ?>
                      N/A
                    <?php
                    } else { ?>
                      <a href="userdocs/<?php echo $row_d['PostSecondaryCertificate']; ?>" target="_blank">View File </a>
                    <?php
                    } ?>
                  </td>
                </tr>
                <tr>
                  <th>Additional Documents</th>
                  <td>
                    <?php
                    if ($row_d['AdditionalDocuments'] == "") { ?>
                      N/A
                    <?php
                    } else { ?>
                      <a href="userdocs/<?php echo $row_d['PostSecondaryCertificate']; ?>" target="_blank">View File </a>
                    <?php
                    } ?>
                  </td>
                </tr>
              </table>
              <br>
              <?php
              $query = mysqli_query($con, "select * from tbladmapplications where UserId=$stuid");
              $row_s = mysqli_fetch_array($query);
              ?>
              <table class="table mb-0">
                <tr>
                  <th>Application Status</th>
                  <td><?php
                      if ($row_s['AdminStatus'] == '') {
                        echo "Your application is under review.";
                      }

                      if ($row_s['AdminStatus'] == '1') {
                        echo "Congratulations! You have been offered admission to the progam.";
                      }

                      if ($row_s['AdminStatus'] == '2') {
                        echo "Unfortunately, Your application has been Rejected.";
                      }

                      if ($row_s['AdminStatus'] == '3') {
                        echo "Your application has been put to waiting list.";
                      }
                      ?></td>
                </tr>
                <tr>
                  <th>Admission Committee's Decision Date</th>
                  <td><?php echo $row_s['AdminRemarkDate']; ?></td>
                  <!-- would be better but has some issues when the value in DB is Null
                    <td><?php //echo date('D, d-M-Y', strtotime($row_s['AdminRemarkDate'])); 
                        ?></td>
                  -->
                </tr>
              </table>
            <?php
            }
          } else { ?>
            <form name="submit" method="post" enctype="multipart/form-data">
              <!--start of section-->
              <section class="formatter" id="formatter">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h4 class="card-title">Undergraduate Admission Form</h4>
                      </div>
                      <div class="card-content">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-12 h5 background-color : primary">
                              <hr>
                              <b>Note that all fields are required and have to be filled accordingly, unless marked as optional !</b>
                              <hr>
                            </div>
                          </div>

                          <!--first row-->
                          <div class="row">
                            <div class="col-6">
                              <fieldset>
                                <h5>Degree Program You Are Applying To</h5>
                                <div class="form-group">
                                  <select name='coursename' id="coursename" class="form-control white_bg" required="true">
                                    <option value=""></option>
                                    <?php $query = mysqli_query($con, "select * from tblcourse");
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                      <option value="<?php echo $row['CourseName']; ?>">
                                        <?php echo $row['CourseName']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-6">
                              <fieldset>
                                <h5>Admission Type</h5>
                                <div class="form-group">
                                  <select name='admissionType' id="admissionType" class="form-control white_bg" required="true">
                                    <option value=""></option>
                                    <option value="regular"> Regular </option>
                                    <option value="evening"> Evening </option>
                                    <option value="weekend"> Weekend </option>
                                    <option value="distance"> Distance </option>
                                  </select>
                                </div>
                              </fieldset>
                            </div>
                          </div>

                          <div class="row" style="margin-top: 2% ">
                            <div class="col-xl-12 col-lg-12">
                              <h4 class="card-title"><b>Personal Information</b></h4>
                              <hr style="border-top: 1px solid" />
                            </div>
                          </div>

                          <!--second row-->
                          <div class="row">
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>First Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="firstname" name="firstname" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Middle Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="middlename" name="middlename" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Last Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="lastname" name="lastname" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Nationality </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="nationality" name="nationality" type="text" required>
                                </div>
                              </fieldset>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Date of Birth (Gregorian) </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="dobGregorian" name="dobGregorian" type="date" required>
                                  <!--<small class="text-muted">Must be in format (dd/mm/yyyy)</small>-->
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Date of Birth (Ethiopian) </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="dobEthiopian" name="dobEthiopian" type="date" required>
                                  <!--<small class="text-muted">Must be in format (dd/mm/yyyy)</small>-->
                                </div>
                              </fieldset>
                            </div>
                            <!-- this is some bullshit JS code right below
                            <script>
                              function gregorianToEthiopian(dobGregorian) {
                                const gregorianYear = dobGregorian.getFullYear();
                                const gregorianMonth = dobGregorian.getMonth() + 1;
                                const gregorianDay = dobGregorian.getDate();

                                const geezYear = gregorianYear + 8; // Ethiopia is 8 years behind the Gregorian calendar
                                const geezMonth = gregorianMonth + 2 > 12 ? (gregorianMonth + 2) - 12 : gregorianMonth + 2; // the Ethiopian calendar has 12 months, so if the Gregorian month + 2 is greater than 12, subtract 12
                                const geezDay = gregorianDay + 10; // there is a 10-day difference between the Gregorian and Ethiopian calendars

                                return `${geezYear}/${geezMonth}/${geezDay}`;
                              }

                              function ethiopianToGregorian(ethiopianYear, ethiopianMonth, ethiopianDay) {
                                const gregorianYear = ethiopianYear + 8; // Ethiopia is 8 years behind the Gregorian calendar
                                const gregorianMonth = ethiopianMonth - 2 < 1 ? ethiopianMonth + 10 : ethiopianMonth - 2; // if the Ethiopian month - 2 is less than 1, add 10
                                const gregorianDay = ethiopianDay - 10; // there is a 10-day difference between the Gregorian and Ethiopian calendars

                                return new Date(gregorianYear, gregorianMonth - 1, gregorianDay).toDateString();
                              }

                              const gregorianInput = document.getElementById('dobGregorian');
                              const ethiopianOutput = document.getElementById('dobEthiopian');
                              const ethiopianInput = document.getElementById('dobEthiopian');
                              const gregorianOutput = document.getElementById('dobGregorian');

                              gregorianInput.addEventListener('change', function() {
                                const dobGregorian = new Date(gregorianInput.value);
                                const dobEthiopian = gregorianToEthiopian(dobGregorian);
                                ethiopianOutput.value = dobEthiopian;
                              });

                              ethiopianInput.addEventListener('change', function() {
                                const [ethiopianYear, ethiopianMonth, ethiopianDay] = ethiopianInput.value.split('/');
                                const dobGregorian = ethiopianToGregorian(Number(ethiopianYear), Number(ethiopianMonth), Number(ethiopianDay));
                                gregorianOutput.value = dobGregorian;
                              });

                            </script>
                            -->
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Gender</h5>
                                <div class="form-group">
                                  <select class="form-control white_bg" id="gender" name="gender" required>
                                    <option value=""></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                  </select>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Applicant's Photo </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="userpic" name="userpic" type="file" accept="image/*" required>
                                </div>
                                <div id="error-message"></div>
                              </fieldset>
                            </div>
                          </div>

                          <!--fourth row-->
                          <div class="row">
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Country of Birth </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="cobirth" name="cobirth" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Place of Birth (Town) </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="pobtown" name="pobtown" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Place of Birth (Woreda) </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="pobworeda" name="pobworeda" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Place of Birth (Kebele) </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="pobkebele" name="pobkebele" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <script>
                              const checkbox = document.getElementById('cobirth');
                              const pobWoreda = document.getElementById('pobworeda');
                              const pobKebele = document.getElementById('pobkebele');

                              checkbox.addEventListener('change', function() {
                                if (this.value.toLowerCase() != "ethiopia") {
                                  pobWoreda.disabled = true;
                                  pobKebele.disabled = true;
                                } else {
                                  pobWoreda.disabled = false;
                                  pobKebele.disabled = false;
                                }
                              });
                            </script>
                          </div>

                          <!--second row-->
                          <div class="row">
                            <div class="col-xl-4 col-lg-12">
                              <h5>Father's :</h5>
                              <fieldset>
                                <h5>First Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="ffirstname" name="ffirstname" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                                <h5><br></h5>
                                <h5>Middle Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="fmiddlename" name="fmiddlename" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                                <h5><br></h5>
                                <h5>Last Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="flastname" name="flastname" type="text" required>
                                </div>
                              </fieldset>
                            </div>
                          </div>

                          <!--second row-->
                          <div class="row">
                            <div class="col-xl-4 col-lg-12">
                              <h5>Mother's :</h5>
                              <fieldset>
                                <h5>First Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="mfirstname" name="mfirstname" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                                <h5><br></h5>
                                <h5>Middle Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="mmiddlename" name="mmiddlename" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                                <h5><br></h5>
                                <h5>Last Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="mlastname" name="mlastname" type="text" required>
                                </div>
                              </fieldset>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xl-12 col-lg-12">
                              <h4 style="margin-bottom: 1%" class="card-title">Applicant's Current Residence and Contact :</h4>
                            </div>
                          </div>

                          <!--fifth row-->
                          <div class="row">
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Town </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="restown" name="restown" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Woreda </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="resworeda" name="resworeda" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Kebele </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="reskebele" name="reskebele" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>House Number <span class="background-color: primary">(optional)</span> </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="reshouse" name="reshouse" type="text">
                                </div>
                              </fieldset>
                            </div>
                          </div>

                          <!--fifth row-->
                          <div class="row">
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Phone Number </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="phone1" name="phone1" type="text" placeholder="09xxxxxxxx / +2519xxxxxxxx" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Phone Number <span class="background-color: primary">(optional)</span> </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="phone2" name="phone2" type="text" placeholder="09xxxxxxxx / +2519xxxxxxxx">
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Marital Status </h5>
                                <div class="form-group">
                                  <select class="form-control white_bg" id="marital" name="marital" required>
                                    <option value=""></option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Other">Other</option>
                                  </select>
                                </div>
                              </fieldset>
                            </div>
                          </div>

                          <!--fifth row-->
                          <div class="row">
                            <div class="col-xl-12 col-lg-12">
                              <h4 style="margin-bottom: 1%" class="card-title">Emergency Contact :</h4>
                            </div>
                          </div>

                          <!--fifth row-->
                          <div class="row">
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Full Name</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="emename" name="emename" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Phone Number</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="emephone" name="emephone" placeholder="09xxxxxxxx / +2519xxxxxxxx" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Town</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="emetown" name="emetown" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Relationship With Applicant </h5>
                                <div class="form-group">
                                  <select class="form-control white_bg" id="emerelation" name="emerelation" required>
                                    <option value=""></option>
                                    <option value="family">Parent or Sibling</option>
                                    <option value="relative">Relative</option>
                                    <option value="friend">Friend</option>
                                    <option value="co-Worker">Co-worker</option>
                                    <option value="other">Other</option>
                                  </select>
                                </div>
                              </fieldset>
                            </div>
                          </div>

                          <!--seventh row-->
                          <div class="row" style="margin-top: 2%">
                            <div class="col-xl-12 col-lg-12">
                              <h4 class="card-title">
                                <b>Educational Background</b>
                              </h4>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                              <h5>List the Three last Secondary schools you attended, if applicable, starting with the most recent.</h5>
                            </div>
                          </div>


                          <!--eighth row-->
                          <div class="row">
                            <div class="col-12">
                              <table class="table mb-0">

                                <tr>
                                  <th class="col-1"></th>
                                  <th class="col-4">School Name</th>
                                  <th class="col-2">Town / City</th>
                                  <th class="col-2">Last Year</th>
                                  <th class="col-3">Stream</th>
                                </tr>

                                <tr>
                                  <td> 1</td>
                                  <td> <input class="form-control white_bg" id="sch_name_1" name="sch_name_1" type="text" required></td>
                                  <td> <input class="form-control white_bg" id="sch_town_1" name="sch_town_1" type="text" required></td>
                                  <td> <input class="form-control white_bg" id="sch_year_1" name="sch_year_1" type="int" min="1950" max="2023" required></td>
                                  <td> <input class="form-control white_bg" id="sch_stream_1" name="sch_stream_1" type="text" required></td>
                                </tr>

                                <tr>
                                  <td> 2 <span class="background-color: primary">(optional)</span></td>
                                  <td> <input class="form-control white_bg" id="sch_name_2" name="sch_name_2" type="text"></td>
                                  <td> <input class="form-control white_bg" id="sch_town_2" name="sch_town_2" type="text"></td>
                                  <td> <input class="form-control white_bg" id="sch_year_2" name="sch_year_2" type="int" min="1950" max="2023"></td>
                                  <td> <input class="form-control white_bg" id="sch_stream_2" name="sch_stream_2" type="text"></td>
                                </tr>

                                <tr>
                                  <td> 3 <span class="background-color: primary">(optional)</span></td>
                                  <td> <input class="form-control white_bg" id="sch_name_3" name="sch_name_3" type="text"></td>
                                  <td> <input class="form-control white_bg" id="sch_town_3" name="sch_town_3" type="text"></td>
                                  <td> <input class="form-control white_bg" id="sch_year_3" name="sch_year_3" type="int" min="1950" max="2023"></td>
                                  <td> <input class="form-control white_bg" id="sch_stream_3" name="sch_stream_3" type="text"></td>
                                </tr>

                              </table>
                            </div>
                          </div>
                          </hr>

                          <div class="row" style="margin-top: 2%">
                            <div class="col-xl-12 col-lg-12">
                              <h5>Have you ever enrolled in any Post Secondary educational institution(s) - University or College, in Ethiopia or Abroad?</h5>
                              <form>
                                <div class="form-group">
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="show-table" value="yes" id="yes-radio">
                                    <label class="form-check-label" for="yes-radio">Yes</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="show-table" value="no" id="no-radio">
                                    <label class="form-check-label" for="no-radio">No</label>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-12" id="my-table">
                              <div>
                                <h5>List the Post Secondary Institution(s) you attended starting with the most recent.</h5>
                              </div>
                              <table class="table mb-0">
                                <tr>
                                  <th class="col-1"></th>
                                  <th class="col-4">Institution's Name</th>
                                  <th class="col-2">Country</th>
                                  <th class="col-2">Last Year</th>
                                  <th class="col-3">Major</th>
                                </tr>

                                <tr>
                                  <td> 1</td>
                                  <td> <input class="form-control white_bg" id="ins_name_1" name="ins_name_1" type="text"></td>
                                  <td> <input class="form-control white_bg" id="ins_country_1" name="ins_country_1" type="text"></td>
                                  <td> <input class="form-control white_bg" id="ins_year_1" name="ins_year_1" type="int" min="1950" max="2023"></td>
                                  <td> <input class="form-control white_bg" id="ins_major_1" name="ins_major_1" type="text"></td>
                                </tr>

                                <tr>
                                  <td> 2 </td>
                                  <td> <input class="form-control white_bg" id="ins_name_2" name="ins_name_2" type="text"></td>
                                  <td> <input class="form-control white_bg" id="ins_country_2" name="ins_country_2" type="text"></td>
                                  <td> <input class="form-control white_bg" id="ins_year_2" name="ins_year_2" type="int" min="1950" max="2023"></td>
                                  <td> <input class="form-control white_bg" id="ins_major_1" name="ins_major_2" type="text"></td>
                                </tr>

                                <tr>
                                  <td> 3 </td>
                                  <td> <input class="form-control white_bg" id="ins_name_3" name="ins_name_3" type="text"></td>
                                  <td> <input class="form-control white_bg" id="ins_country_3" name="ins_country_3" type="text"></td>
                                  <td> <input class="form-control white_bg" id="ins_year_3" name="ins_year_3" type="int" min="1950" max="2023"></td>
                                  <td> <input class="form-control white_bg" id="ins_major_3" name="ins_major_3" type="text"></td>
                                </tr>

                              </table>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-12 h5 background-color : primary">
                              <hr>
                              <b>Upload the following files. Note that all are <span class="background-color : danger">required</span> unless marked otherwise !</b>
                              <hr>
                              <b>You can upload any additional documents you want to show as in case your situation is different, in the "Additional Documents" section.</b>
                              <hr>
                            </div>
                          </div>

                          <div class="row mb-2">
                            <div class="col-xl-6 col-lg-12">
                              <fieldset>
                                <h5>National ID / Passport</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="passport" name="passport" type="file" accept="application/pdf" required>
                                </div>
                                <div id="error_message_doc1"></div>
                              </fieldset>
                            </div>
                            <div class="col-xl-6 col-lg-12">
                              <fieldset>
                                <h5>High School Transcript</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="highSchool_trans" name="highSchool_trans" type="file" accept="application/pdf" required>
                                </div>
                                <div id="error_message_doc2"></div>
                              </fieldset>
                            </div>
                          </div>

                          <div class="row mb-2">
                            <div class="col-xl-6 col-lg-12">
                              <fieldset>
                                <h5>10th Grade National Examination Certificate</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="tenth_cert" name="tenth_cert" type="file" accept="application/pdf" required>
                                </div>
                                <div id="error_message_doc3"></div>
                              </fieldset>
                            </div>
                            <div class="col-xl-6 col-lg-12">
                              <fieldset>
                                <h5>12th Grade National Examination Certificate</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="twelfth_cert" name="twelfth_cert" type="file" accept="application/pdf" required>
                                </div>
                                <div id="error_message_doc4"></div>
                              </fieldset>
                            </div>
                          </div>

                          <div class="row mb-2">
                            <div class="col-xl-6 col-lg-12">
                              <fieldset>
                                <h5>Post Secondary School Transcript <span class="background-color: primary">(if applicable)</span></h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="post_sec_trans" name="post_sec_trans" type="file" accept="application/pdf">
                                </div>
                                <div id="error_message_doc5"></div>
                              </fieldset>
                            </div>
                            <div class="col-xl-6 col-lg-12">
                              <fieldset>
                                <h5>Post Secondary School Graduation Certificate <span class="background-color: primary">(if applicable)</span></h5>
                                <div class="form-group custom_class">
                                  <input class="form-control white_bg" id="post_sec_cert" name="post_sec_cert" type="file" accept="application/pdf">
                                </div>
                                <div id="error_message_doc6"></div>
                              </fieldset>
                            </div>
                          </div>

                          <div class="row mb-2">
                            <div class="col-xl-6 col-lg-12">
                              <fieldset>
                                <h5>Additional Documents <span class="background-color: primary">(Optional)</span></h5>
                                <div class="form-group custom_class">
                                  <input class="form-control white_bg" id="additional_docs" name="additional_docs" type="file" accept="application/pdf">
                                </div>
                                <div id="error_message_doc7"></div>
                              </fieldset>
                            </div>
                          </div>

                          <!--Uploaded documents validator scripts-->
                          <script>
                            const fileInputDoc1 = document.querySelector('#passport');
                            const fileInputDoc2 = document.querySelector('#highSchool_trans');
                            const fileInputDoc3 = document.querySelector('#tenth_cert');
                            const fileInputDoc4 = document.querySelector('#twelfth_cert');
                            const fileInputDoc5 = document.querySelector('#post_sec_trans');
                            const fileInputDoc6 = document.querySelector('#post_sec_cert');
                            const fileInputDoc7 = document.querySelector('#additional_docs');

                            const errorMessageDoc1 = document.querySelector('#error_message_doc1');
                            const errorMessageDoc2 = document.querySelector('#error_message_doc2');
                            const errorMessageDoc3 = document.querySelector('#error_message_doc3');
                            const errorMessageDoc4 = document.querySelector('#error_message_doc4');
                            const errorMessageDoc5 = document.querySelector('#error_message_doc5');
                            const errorMessageDoc6 = document.querySelector('#error_message_doc6');
                            const errorMessageDoc7 = document.querySelector('#error_message_doc7');


                            fileInputDoc1.addEventListener('change', function(event) {
                              const selectedFile = event.target.files[0];
                              const fileTypeDoc = selectedFile.type;

                              if (!fileTypeDoc.startsWith('application/pdf')) {
                                // Display error message and highlight the file input field's border
                                errorMessageDoc1.textContent = 'You can upload only a PDF file';
                                fileInputDoc1.classList.add('error');
                                fileInputDoc1.style.border = '1px solid red';

                                // Prevent form submission
                                event.preventDefault();
                              } else {
                                // Clear error message and remove highlight from file input field
                                errorMessageDoc1.textContent = '';
                                fileInputDoc1.classList.remove('error');
                                fileInputDoc1.style.border = '';
                              }
                            });

                            fileInputDoc2.addEventListener('change', function(event) {
                              const selectedFile = event.target.files[0];
                              const fileTypeDoc = selectedFile.type;

                              if (!fileTypeDoc.startsWith('application/pdf')) {
                                // Display error message and highlight the file input field's border
                                errorMessageDoc2.textContent = 'You can upload only a PDF file';
                                fileInputDoc2.classList.add('error');
                                fileInputDoc2.style.border = '1px solid red';

                                // Prevent form submission
                                event.preventDefault();
                              } else {
                                // Clear error message and remove highlight from file input field
                                errorMessageDoc2.textContent = '';
                                fileInputDoc2.classList.remove('error');
                                fileInputDoc2.style.border = '';
                              }
                            });

                            fileInputDoc3.addEventListener('change', function(event) {
                              const selectedFile = event.target.files[0];
                              const fileTypeDoc = selectedFile.type;

                              if (!fileTypeDoc.startsWith('application/pdf')) {
                                // Display error message and highlight the file input field's border
                                errorMessageDoc3.textContent = 'You can upload only a PDF file';
                                fileInputDoc3.classList.add('error');
                                fileInputDoc3.style.border = '1px solid red';

                                // Prevent form submission
                                event.preventDefault();
                              } else {
                                // Clear error message and remove highlight from file input field
                                errorMessageDoc3.textContent = '';
                                fileInputDoc3.classList.remove('error');
                                fileInputDoc3.style.border = '';
                              }
                            });

                            fileInputDoc4.addEventListener('change', function(event) {
                              const selectedFile = event.target.files[0];
                              const fileTypeDoc = selectedFile.type;

                              if (!fileTypeDoc.startsWith('application/pdf')) {
                                // Display error message and highlight the file input field's border
                                errorMessageDoc4.textContent = 'You can upload only a PDF file';
                                fileInputDoc4.classList.add('error');
                                fileInputDoc4.style.border = '1px solid red';

                                // Prevent form submission
                                event.preventDefault();
                              } else {
                                // Clear error message and remove highlight from file input field
                                errorMessageDoc4.textContent = '';
                                fileInputDoc4.classList.remove('error');
                                fileInputDoc4.style.border = '';
                              }
                            });

                            fileInputDoc5.addEventListener('change', function(event) {
                              const selectedFile = event.target.files[0];
                              const fileTypeDoc = selectedFile.type;

                              if (!fileTypeDoc.startsWith('application/pdf')) {
                                // Display error message and highlight the file input field's border
                                errorMessageDoc5.textContent = 'You can upload only a PDF file';
                                fileInputDoc5.classList.add('error');
                                fileInputDoc5.style.border = '1px solid red';

                                // Prevent form submission
                                event.preventDefault();
                              } else {
                                // Clear error message and remove highlight from file input field
                                errorMessageDoc5.textContent = '';
                                fileInputDoc5.classList.remove('error');
                                fileInputDoc5.style.border = '';
                              }
                            });

                            fileInputDoc6.addEventListener('change', function(event) {
                              const selectedFile = event.target.files[0];
                              const fileTypeDoc = selectedFile.type;

                              if (!fileTypeDoc.startsWith('application/pdf')) {
                                // Display error message and highlight the file input field's border
                                errorMessageDoc6.textContent = 'You can upload only a PDF file';
                                fileInputDoc6.classList.add('error');
                                fileInputDoc6.style.border = '1px solid red';

                                // Prevent form submission
                                event.preventDefault();
                              } else {
                                // Clear error message and remove highlight from file input field
                                errorMessageDoc6.textContent = '';
                                fileInputDoc6.classList.remove('error');
                                fileInputDoc6.style.border = '';
                              }
                            });

                            fileInputDoc7.addEventListener('change', function(event) {
                              const selectedFile = event.target.files[0];
                              const fileTypeDoc = selectedFile.type;

                              if (!fileTypeDoc.startsWith('application/pdf')) {
                                // Display error message and highlight the file input field's border
                                errorMessageDoc7.textContent = 'You can upload only a PDF file';
                                fileInputDoc7.classList.add('error');
                                fileInputDoc7.style.border = '1px solid red';

                                // Prevent form submission
                                event.preventDefault();
                              } else {
                                // Clear error message and remove highlight from file input field
                                errorMessageDoc7.textContent = '';
                                fileInputDoc7.classList.remove('error');
                                fileInputDoc7.style.border = '';
                              }
                            });
                          </script>



                          <!--ninth row-->
                          <div class="row" style="margin-top: 3%">
                            <div class="col-xl-12 col-lg-12">
                              <h4 class="card-title"><b>Declaration</b></h4>
                              <hr style="border-top: 1px solid" />
                            </div>
                          </div>

                          <!--tenth row-->
                          <div class="row">
                            <div class="col-xl-12 col-lg-12">
                              <h5><b>I hereby state that the facts mentioned above are true to the best of my knowledge and belief.</b></h5>
                            </div>
                          </div>

                          <!--eleventh row-->
                          <div class="row">
                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                                <input class="form-control white_bg" id="signature" name="signature" placeholder="Your Name for Signature" type="text">
                              </fieldset>
                            </div>
                          </div>

                          <!--twelfth row-->
                          <div class="row" style="margin-top: 2%">
                            <div class="col-xl-6 col-lg-12">
                              <button type="submit" onclick="return confirm('You will not be able to change or edit your application once submitted! Do you want to submit your application?')" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Submit</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!--section end-->
            <?php } ?>
            <!-- Formatter end -->
            </form>
        </div>
      </div>
    </div>
    <?php include('includes/footer.php'); ?>

    <!--Purpose Specific Scripts-->
    <!--applicant image input validator-->
    <script>
      const fileInput = document.querySelector('#userpic');
      const errorMessage = document.querySelector('#error-message');

      fileInput.addEventListener('change', function(event) {
        const selectedFile = event.target.files[0];
        const fileTypePic = selectedFile.type;

        if (!fileTypePic.startsWith('image/')) {
          // Display error message and highlight the file input field
          errorMessage.textContent = 'Please select an image file';
          fileInput.classList.add('error');
          fileInput.style.border = '1px solid red';

          // Prevent form submission
          event.preventDefault();
        } else {
          // Clear error message and remove highlight from file input field
          errorMessage.textContent = '';
          fileInput.classList.remove('error');
          fileInput.style.border = '';
        }
      });
    </script>

    <script>
      $(document).ready(function() {
        // Hide the table by default
        $('#my-table').hide();

        // Show/hide the table based on the user's selection
        $('input[type=radio][name=show-table]').change(function() {
          if (this.value == 'yes') {
            $('#my-table').show();
          } else if (this.value == 'no') {
            $('#my-table').hide();
          }
        });
      });
    </script>

    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>


    <script>
      // onbeforeunload function to warn the user if they try to refresh or leave the page. 
      //function myFunction() {
      //  return "You have unsaved changes! ";
      //}
    </script>

  </body>

  </html>
<?php
} ?>