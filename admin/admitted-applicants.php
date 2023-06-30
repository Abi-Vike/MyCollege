<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid'] == 0)) {
  header('location:logout.php');
} else {

?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>Gada AMS || Admitted Students</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/custom_css.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include('includes/header.php'); ?>
    <?php include('includes/leftbar.php'); ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
              View Application
            </h3>

            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="dashboard.php"> Dashboard </a>
                  </li>
                  <li class="breadcrumb-item active"> Application </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="content-body">
          <!-- Formatter start -->
          <table>
            <!--class="table mb-0"  default inside the table-->
            <thead>
              <tr>
                <th>S.NO</th>
                <th>Application ID</th>
                <th>Applicant ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>Program Type</th>
                <th>Registration Payment</th>
              </tr>
            </thead>
            <?php
            //$ret=mysqli_query($con,"SELECT * FROM tbladmissions, tbladmapplications.CourseApplied, tbladmapplications.ID, tbladmapplications.FirstName, tbladmapplications.MiddleName FROM tbladmissions INNER JOIN tbladmapplications on tbladmissions.Adm_App_ID=tbladmissions.Adm_App_ID");
            //$ret = mysqli_query($con, "SELECT * FROM tbladmissions Where Adm_App_ID = '63' AND Adm_Status='accepted'");
            $data = mysqli_query($con, "SELECT tbladmissions.*, tbladmapplications.UserID ,tbladmapplications.FirstName, tbladmapplications.MiddleName, tbladmapplications.CourseApplied, tbladmapplications.AdmissionType FROM tbladmissions INNER JOIN tbladmapplications ON tbladmissions.Adm_App_ID = tbladmapplications.ID WHERE tbladmissions.Adm_Status = 'accepted'");
            $cnt = 1;
            while ($row = mysqli_fetch_array($data)) {
              $pay = mysqli_fetch_array(mysqli_query($con, "SELECT Pay_Confirmed FROM tblpayments WHERE Application_ID = " . $row["Adm_App_ID"]));
            ?>
              <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo $row['Adm_App_ID']; ?></td>
                <td><?php echo $row['UserID']; ?></td>
                <td><?php echo $row['FirstName'] . ' ' . $row['MiddleName']; ?></td>
                <td><?php echo $row['CourseApplied']; ?></td>
                <td><?php echo $row['AdmissionType']; ?></td>
                <?php
                if ($pay['Pay_Confirmed'] == 'unverified') { ?>
                  <td>Paid - Unverified - <a href='verify-pay-man.php?app_id=<?php echo $row['Adm_App_ID']; ?>'><button class="btn btn-primary cust_but" name="verify-button">Verify Manually</button></a></td>
                <?php
                } else if ($pay['Pay_Confirmed'] == 'verified') { ?>
                  <td>Paid - <span class="success">Verified</span></td>
                <?php
                } else { ?>
                  <td>
                    <?php
                    $offer_acc_date = date('d-M', strtotime($row['Adm_Accept_Date']));
                    // need to make it send an email reminder to applicant
                    echo "Unpaid (Offer Accepted On $offer_acc_date) - <a href='#'><button class='btn btn-warning cust_but'>Remind</button></a>"; ?>
                  </td>
                <?php
                }
                ?>
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

    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>

  </body>

  </html>
<?php
} ?>