<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid'] == 0)) {    // was ==0
  header('location:logout.php');
} else {
  // retreive the encoded course_name 
  $course_name = $_GET['course_name'];
?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>RVU Gada: Admin || Ready Class</title>
    <link rel="icon" type="image/png" href="../img/RVU-logo.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/extended/form-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/custom_css.css">


    <style>
      table {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        white-space: nowrap;
      }

      #print-button {
        top: 10px;
        padding: 10px;
        width: 100px;
        margin: 0 0 15px 35vw;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

      td,
      th {
        padding: 15px;
      }

      @media print {
        body {
          padding: 0;
          margin: -25px -5vw 0 -5vw;
        }

        #header_part,
        #sidebar_part,
        #footer_part,
        #last_col,
        #print-button,
        .breadcrumb-wrapper {
          display: none;
        }
      }

      @media only screen and (max-width: 600px) {

        table,
        tbody,
        thead,
        th,
        td,
        tr {
          display: block;
          width: 100%;
        }

        td {
          border: none;
          position: relative;
          padding-left: 50%;
        }

        td::before {
          content: attr(data-label);
          position: absolute;
          left: 0;
          width: 50%;
          padding-left: 8px;
          font-weight: bold;
        }
      }
    </style>
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include('includes/header.php'); ?>
    <?php include('includes/leftbar.php'); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
              <?php echo $course_name; ?>
            </h3>

            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="classes.php">Departments</a>
                  </li>

                  <li class="breadcrumb-item active">
                    <?php echo $course_name; ?>
                  </li>
                </ol>
              </div>
            </div>

          </div>
        </div>
        <div class="row">
          <button id="print-button" class="btn btn-info" onclick="window.print()">Print</button>
        </div>

        <div class="content-body">
          <!-- Input Mask start -->

          <!-- Formatter start -->
          <table class="table mb-0">
            <thead>
              <tr>
                <th>S.no</th>
                <th>Student ID</th>
                <th>Full Name</th>
                <th>Contact Number</th>
                <th>Program Type</th>
                <th id='last_col'></th>
              </tr>
            </thead>
            <?php
            $ret_std = mysqli_query($con, "SELECT * FROM tblregistered WHERE Reg_Course = '$course_name'");
            $cnt = 1;

            while ($row = mysqli_fetch_array($ret_std)) {
              // retreive the registered user's user-ID
              $reg_user_id = $row['Reg_User_ID'];

              $ret_std_info = mysqli_query($con, "SELECT * FROM tbladmapplications WHERE UserId = '$reg_user_id'");
              $row2 = mysqli_fetch_array($ret_std_info);
            ?>
              <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo 'RVGDTR\\' . $row['Reg_ID'] . '\\' . date('Y', strtotime($row['Reg_date'])); ?></td>
                <td><?php echo $row2['FirstName'] . ' - ' . $row2['MiddleName'] . ' - ' . $row2['LastName']; ?></td>
                <td><?php echo $row2['PhoneNumber']; ?></td>
                <td><?php echo $row2['AdmissionType']; ?></td>
                <td id='last_col'><a href='student_ID.php?uid=<?php echo $reg_user_id; ?>'><button class="btn btn-primary cust_but" name="verify-button">View ID</button></a></td>
              </tr>
            <?php
              $cnt = $cnt + 1;
            } ?>
          </table>
        </div>
      </div>
    </div>


    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include('includes/footer.php'); ?>
    <!-- BEGIN VENDOR JS-->
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
<?php
} ?>