<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['aid'] == 0)) {
  header('location:logout.php');
} else {

  if (isset($_GET['delid'])) {
    $uid = $_GET['delid'];
    $query = mysqli_query($con, "DELETE FROM tbluser WHERE tbluser.ID='$uid'");
    echo "<script>
            alert('Record Deleted successfully');
            window.location.href='user-detail.php';
          </script>";
    exit();
  }

?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>

    <title>RVU Gada: Admin || Registered Users</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include('includes/header.php'); ?>
    <?php include('includes/leftbar.php'); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
              Users
            </h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">Registered Users</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="content-body">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>S.no</th>
                <th>User ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Verified</th>
                <th>Action</th>
              </tr>
            </thead>
            <?php
            $ret = mysqli_query($con, "select * from tbluser");
            $cnt = 1;
            while ($row = mysqli_fetch_array($ret)) {
            ?>
              <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['FirstName']; ?></td>
                <td><?php echo $row['MiddleName']; ?></td>
                <td><?php echo $row['LastName']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td>
                  <?php if ($row['status'] == 'confirmed') {
                    echo "Yes";
                  } else {
                    echo "Not Confirmed";
                  } ?>
                </td>
                <td>
                  <?php if ($row['status'] == 'confirmed') {
                  } else { ?>
                    <a href="user-detail.php?delid=<?php echo $row['ID']; ?>" title="Delete user" onclick="return confirm('Are you sure you want to remove this user from the database?');" style="color:red">
                      Delete User
                    </a>
                  <?php } ?>
                </td>
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