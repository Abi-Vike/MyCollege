<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['uid']) == 0) {
  header('location:logout.php');
} else {
?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>RVU-GADA : Student || Registration</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    <?php include_once('includes/header.php'); ?>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include_once('includes/leftbar.php'); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
          <?php
          $uid = $_SESSION['uid'];
          //taking out only the date
          $sql = mysqli_query($con, "SELECT DATE(CourseApplieddate) AS date_part FROM tbladmapplications WHERE UserID='$uid'");
          $result = mysqli_fetch_array($sql);
          $application_date = $row['date_part'];

          $ret = mysqli_query($con, "SELECT * FROM tbladmapplications WHERE UserID='$uid'");
          $row = mysqli_fetch_array($ret);
          $fname = $row['FirstName'];
          ?>
          <h3>
            <font color="red">Welcome,</font>
            <?php echo $fname; ?>
          </h3>
          <hr>

          <?php
          $admission_status = $row['AdminStatus'];
          $application_ID = $row['ID'];
          $full_name = $row['FirstName'] . " " . $row['MiddleName'];
          $course_name = $row['CourseApplied'];
          $application_date = $row['CourseApplieddate'];
          $decision_date = $row['AdminRemarkDate'];

          if ($admission_status == "1") { ?>
            <h4><strong>Application reference number:</strong> <?php echo $application_ID ?> <br><br>
              <strong>Date:</strong> <?php echo date('d-M-Y', strtotime($decision_date))?> <br><br>
              Dear <?php echo $full_name ?>, <br><br>
              Re: Application for Bachelor of <b><?php echo $course_name ?></b>, September 2023, made on <?php echo date('D, d-M-Y', strtotime($application_date))?> <br><br>
              We are pleased to inform you that your application for admission to the bachelor's degree program in <?php echo $course_name ?>
              at our university has been thoroughly reviewed by our admissions committee. It is with great pleasure that we extend to
              you an offer of admission to join our esteemed institution for the upcoming academic year. <br><br>
              To secure your place in the program, please submit your acceptance and pay the required non-refundable registration fee
              of 150 ETB within 20 days of you getting this email. This payment is essential for the processing of your documents
              including the making of a student ID for the academic year.<br><br>
              Should you have any questions or require any further assistance, please do not hesitate to reach out to our
              admissions office at <a style="color:coral">rvu.admissions.sup@gmail.com</a><br><br>
              We eagerly anticipate your response and look forward to welcoming you to our campus for the start of the academic
              year. On behalf of the entire university community, the office of admissions extends warmest congratulations once again.<br><br>
              <strong>Kind regards,<br><br>
                Rift Valley University Admissions Office</strong>
            </h4>
            <div align="center">
              <button type="submit" id="submit_button" name="submit" class="btn btn-success mx-2" style="width: 300px;">Accept Offer</button>
              <button onclick="confirmDecline()" type="submit" id="submit_button" name="submit" class="btn btn-danger mx-2" style="width: 300px;">Decline Offer</button>
            </div>
          <?php
          } elseif ($admission_status == "2") { ?>
            <h4><strong>Application reference number:</strong> <?php echo $application_ID ?> <br><br>
              <strong>Date:</strong> <?php echo date('d-M-Y', strtotime($decision_date))?> <br><br>
              Dear <?php echo $full_name ?>, <br><br>
              Re: Application for Bachelor of <b><?php echo $course_name ?></b>, September 2023, made on <?php echo date('D, d-M-Y', strtotime($application_date))?> <br><br>
              We regret to inform you that after careful consideration of your application, we are unable to offer you a place on the above course. <br><br>
              This decision has been taken for the following reason: <br><br>
              From information supplied, unfortunately you do not meet our entry requirements. <br><br>
              Thank you for your interest in Rift Valley University. We hope you will be successful in obtaining a place to study at another institution of your choice.<br><br>
              <strong>Kind regards,<br><br>
                Rift Valley University Admissions Office</strong>
            </h4>
          <?php
          } elseif ($admission_status == "3") { ?>
            <h4><strong>Application reference number:</strong> <?php echo $application_ID ?> <br><br>
              <strong>Date:</strong> <?php echo date('d-M-Y', strtotime($decision_date))?> <br><br>
              Dear <?php echo $full_name ?>, <br><br>
              Re: Application for Bachelor of <b><?php echo $course_name ?></b>, September 2023, made on <?php echo date('D, d-M-Y', strtotime($application_date))?> <br><br>
              We hope this letter finds you well. On behalf of the admissions committee at Rift Valley University, we would like to
              express our appreciation for your application to the Program.<br><br>
              Every academic term, we receive more applications from candidates than we have capacity to accommodate. And unfortunately,
              your application was not selected for the program. We will keep your application in a waiting list and if an alternative
              opportunity becomes available, that you are qualified for, you will be contacted.<br><br>
              Should you have any questions or require any further assistance, please do not hesitate to reach out to our
              admissions office at <a style="color:coral">rvu.admissions.sup@gmail.com</a><br><br>
              We wish you the very best in all your academic endeavors..<br><br>
              <strong>Kind regards,<br><br>
                Rift Valley University Admissions Office</strong>
            </h4>
          <?php
          } else {
            echo "What the heck has happened here?";
          }

          ?><!--<?php /*
          $rtp =mysqli_query($con ,"SELECT ID from tbladmapplications where UserID='$uid'");
          $row=mysqli_fetch_array($rtp);
          if($row>0){
            $ret=mysqli_query($con,"select AdminStatus from tbladmapplications join tbldocument on tbldocument.UserID=tbladmapplications.UserID where tbldocument.UserID='$uid' and tbladmapplications.AdminStatus='1'");
            $num=mysqli_fetch_array($ret);
            
            if($num>0){ ?>
              <<div class="row" >
                <div class="col-12">
                  <div class="card pull-up">
                    <div class="card-content">
                      <a href="upload-doc.php">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h4 align="center">Your Application has been accepted and documents also uploaded successfully</h4>
                            </div>
                          </div>
      
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
            } else 
            {?>
              <div class="row" >
                <div class="col-xl-10 col-lg-12 col-12">
                  <div class="card pull-up">
                    <div class="card-content">
                      <a href="upload-doc.php">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h4 align="center">Upload your documents</h4>
                            </div>
                            <div>
                              <i class="icon-file success font-large-2 float-right"></i>
                            </div>
                          </div>
                          
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
            }  
          } */?>--><?php
          ?>


        </div>
      </div>
    </div>

    <?php include('includes/footer.php'); ?>
    <!-- BEGIN VENDOR JS-->
    <!-- General Javascript functions definitions -->
    <script>
      function confirmDecline() {
        var confirmMessage = "Are you sure you want to decline the admission offer? \nThis action cannot be undone.";

        if (confirm(confirmMessage)) {
          // Perform the action to decline the offer
          // You can add your own code here
          // For example: window.location.href = "decline-offer.php";
        }
      }
      </script>
    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js" type="text/javascript"></script>
    <script src="app-assets/data/jvector/visitor-data.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
    <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="app-assets/js/scripts/pages/dashboard-sales.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
  </body>

  </html>
<?php } ?>