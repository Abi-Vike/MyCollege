<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/emailer.php';

include('includes/dbconnection.php');
if (strlen($_SESSION['aid'] == 0)) {
  header('location:logout.php');
} else {

  if (isset($_POST['submit'])) {
    $cid = $_GET['aticid'];
    $admrmk = $_POST['AdminRemark'];
    $admsta = $_POST['status'];
    $toemail = $_POST['useremail'];

    // will need to extract application information first here
    $query_application_info = mysqli_query($con, "SELECT * FROM tbladmapplications WHERE tbladmapplications.UserId='$cid'");
    if ($info = mysqli_fetch_array($query_application_info)) {
      // we'll need those for the emailer function below
      $ID_i = $info['ID'];
      $CourseApplied_i = $info['CourseApplied'];
      $AdmissionType_i = $info['AdmissionType'];
      $FirstName_i = $info['FirstName'];
    } else {
      echo "<script>alert('info fetch failed!')</script>";
    }
    $query = mysqli_query($con, "UPDATE tbladmapplications SET AdminRemark='$admrmk', AdminStatus='$admsta' WHERE UserId='$cid'");

    if ($query) {
      if ($admsta == '1') {
        $query_admitted_check = mysqli_query($con, "SELECT Adm_App_ID FROM tbladmissions WHERE Adm_App_ID='$ID_i'");
        if (mysqli_fetch_row($query_admitted_check)) {
          // means user already accepted and is already inside admissions table
          // but wouldn't normally come inside this if unless there is a serious flaw
          header('location:error.php');
        } 
        else {
          // if application is a fresh admission
          // add application to tbladmissions
          $query_admitted = mysqli_query($con, "INSERT INTO tbladmissions (Adm_App_ID, Adm_Course) VALUES ('$ID_i', '$CourseApplied_i')");
          if ($query_admitted) {
            // call a function from emailer.php
            SendApplicationStatus($toemail, $ID_i, $FirstName_i, $CourseApplied_i, $AdmissionType_i);
          } else {
            echo "<script>alert('Unable to add application to admitted students list')</script>";
          }
        }
      }else{ // incases of rejection or put to waiting list
        $query_admitted_check = mysqli_query($con, "SELECT Adm_App_ID FROM tbladmissions WHERE Adm_App_ID='$ID_i'");
        if (mysqli_fetch_row($query_admitted_check)) {
          // means user is inside admissions table and needs to be removed now as he's no more admitted
          $query_remove_admission = mysqli_query($con, "DELETE FROM tbladmissions WHERE Adm_App_ID='$ID_i'");
        }
      }
    } else {
      echo "<script>alert('Sorry, query was unable to return value!')</script>";
    }
  }
?>

  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>Addmission Management System || Application Form</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/extended/form-extended.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
      .errorWrap {
        padding: 10px;
        margin: 20px 0 0px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
      }

      .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
      }
    </style>

  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include('includes/header.php'); ?>
    <?php include('includes/leftbar.php'); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
              View Application Form
            </h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="dashboard.php">Dashboard</a>
                  </li>

                  <li class="breadcrumb-item active">Application Form</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="content-body">
          <!-- Input Mask start -->

          <!-- Formatter start -->
          <?php
          $cid = $_GET['aticid'];
          $query_person = mysqli_query($con, "select tbladmapplications.*, tbluser.FirstName, tbluser.MiddleName, tbluser.LastName, tbluser.Email from tbladmapplications inner join tbluser on tbluser.ID=tbladmapplications.UserId where tbladmapplications.UserId='$cid'");
          $cnt = 1;
          while ($row = mysqli_fetch_array($query_person)) {
            $tom = $row['UserId'];
          ?>
            <!--<table border="1" class="table table-bordered mg-b-0">-->
            <!--<script>alert(<?php $cid ?>)</script>-->
            <table border="1" class="table mb-0">
              <tr>
                <th>Application made on</th>
                <td><?php echo $row['CourseApplieddate']; ?></td>
              </tr>
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
                <td><img src="../user/userimages/<?php echo $row['UserPic']; ?>" width="200" height="200"></td>
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
                <td><?php echo $row['Email']; ?></td>
              </tr>
              <tr>
                <th>Marital Status</th>
                <td><?php echo $row['MaritalStatus']; ?></td>
              </tr>
              <tr>
                <th>Emergency Contact</th>
                <td><?php echo $row['EmergencyName'] . ", " . $row['EmergencyPhone']; ?></td>
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
            $query_docs = mysqli_query($con, "select * from tbldocument where UserID=$tom");
            while ($rw = mysqli_fetch_array($query_docs)) {
            ?>
              <table class="table mb-0">
                <tr>
                  <th>National ID / Passport</th>
                  <td><a href="../user/userdocs/<?php echo $rw['Passport']; ?>" target="_blank">View File </a></td>
                </tr>
                <tr>
                  <th>High School Transcript</th>
                  <td><a href="../user/userdocs/<?php echo $rw['HighSchoolTranscript']; ?>" target="_blank">View File </a></td>
                </tr>
                <tr>
                  <th>10th Grade National Examination Report</th>
                  <td><a href="../user/userdocs/<?php echo $rw['TenthCertificate']; ?>" target="_blank">View File </a></td>
                </tr>
                <tr>
                  <th>12th Grade National Examination Report</th>
                  <td><a href="../user/userdocs/<?php echo $rw['TwelfthCertificate']; ?>" target="_blank">View File </a></td>
                </tr>
                <tr>
                  <th>Post Secondary Education Transcript</th>
                  <td>
                    <?php
                    if ($rw['PostSecondaryTranscript'] == "") { ?>
                      NA
                    <?php
                    } else { ?>
                      <a href="../user/userdocs/<?php echo $rw['PostSecondaryTranscript']; ?>" target="_blank">View File </a>
                    <?php
                    } ?>
                  </td>
                </tr>
                <tr>
                  <th>Post Secondary Education Certificate</th>
                  <td>
                    <?php
                    if ($rw['PostSecondaryCertificate'] == "") { ?>
                      NA
                    <?php
                    } else { ?>
                      <a href="../user/userdocs/<?php echo $rw['PostSecondaryCertificate']; ?>" target="_blank">View File </a>
                    <?php
                    } ?>
                  </td>
                </tr>
                <tr>
                  <th>Additional Documents</th>
                  <td>
                    <?php
                    if ($rw['AdditionalDocuments'] == "") { ?>
                      NA
                    <?php
                    } else { ?>
                      <a href="../user/userdocs/<?php echo $rw['PostSecondaryCertificate']; ?>" target="_blank">View File </a>
                    <?php
                    } ?>
                  </td>
                </tr>
              </table>
              <br>
            <?php
            }
            ?>

            <table class="table mb-0">
              <tr>
                <th colspan="2">
                  <font color="red">Declaration : </font>I hereby state that the information and documents I have submitted are true to the best of my knowledge and belief.<br />
                  {<?php echo $row['Signature']; ?>}
                </th>
              </tr>
              <?php if ($row['AdminRemark'] == "") { ?>
                <form name="submit" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="useremail" value="<?php echo $row['Email']; ?>">
                  <tr>
                    <th>Admission Committee's Remark :</th>
                    <td>
                      <textarea name="AdminRemark" placeholder="" rows="10" cols="14" class="form-control wd-450"></textarea>
                    </td>
                  </tr>

                  <tr>
                    <th>Application Status :</th>
                    <td>
                      <select id="mySelect" onchange="checkSelection()" name="status" class="form-control wd-450" required="true">
                        <option value=""> Decision not made </option>
                        <option value="1" <?php if ($row['AdminStatus'] == "1") {
                                            echo "selected";
                                          } ?>> Accepted</option>
                        <option value="2" <?php if ($row['AdminStatus'] == "2") {
                                            echo "selected";
                                          } ?>> Rejected</option>
                        <option value="3" <?php if ($row['AdminStatus'] == "3") {
                                            echo "selected";
                                          } ?>> Waiting List</option>
                      </select>
                    </td>
                  </tr>

                  <tr align="center">
                    <td colspan="2"><button type="submit" id="submit_button" name="submit" class="btn btn-primary disabled">Update</button></td>
                  </tr>
                </form>
              <?php } else { ?>
                <tr>
                  <th>Admin Remark</th>
                  <td><?php echo $row['AdminRemark']; ?></td>
                </tr>

                <tr>
                  <th>Admin Remark date</th>
                  <td><?php echo $row['AdminRemarkDate']; ?> </td>
                <tr>
                  <th>Admin Status</th>
                  <td><?php
                      if ($row['AdminStatus'] == "1") {
                        echo "Accepted";
                      }
                      if ($row['AdminStatus'] == "2") {
                        echo "Rejected";
                      }
                      if ($row['AdminStatus'] == "3") {
                        echo "Waiting List";
                      }; ?>
                  </td>
                </tr>
              <?php } ?>
            </table>
          <?php
          }
          ?>

          <div class="row" style="margin-top: 2%">
            <?php
            $myObj = $query_person;
            var_dump($myObj)
            ?>
            <div class="col-xl-6 col-lg-12">

            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include('includes/footer.php'); ?>
    <!-- BEGIN VENDOR JS-->
    <!-- task specific JS definitions -->
    <script>
      function checkSelection() {
        var selectElement = document.getElementById("mySelect");
        var submitButton = document.getElementById("submit_button");

        if (selectElement.value !== "") {
          submitButton.classList.remove("disabled");
          submitButton.disabled = false;
        } else {
          submitButton.disabled = true;
        }
      }
    </script>
    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

    <script src="app-assets/vendors/js/forms/extended/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/forms/extended/typeahead/bloodhound.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/forms/extended/typeahead/handlebars.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/forms/extended/formatter/formatter.min.js" type="text/javascript"></script>
    <script src="../../../app-assets/vendors/js/forms/extended/maxlength/bootstrap-maxlength.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/forms/extended/card/jquery.card.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
    <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
    <script src="app-assets/js/scripts/forms/extended/form-typeahead.js" type="text/javascript"></script>
    <script src="app-assets/js/scripts/forms/extended/form-inputmask.js" type="text/javascript"></script>
    <script src="app-assets/js/scripts/forms/extended/form-formatter.js" type="text/javascript"></script>
    <script src="app-assets/js/scripts/forms/extended/form-maxlength.js" type="text/javascript"></script>
    <script src="app-assets/js/scripts/forms/extended/form-card.js" type="text/javascript"></script>

  </body>

  </html>
<?php  } ?>