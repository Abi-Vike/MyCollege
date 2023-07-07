<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid'] == 0)) {
  header('location:logout.php');
} else {

  // announcement removal
  if (isset($_GET['delnotid'])) {
    $rid = $_GET['delnotid'];
    $query = mysqli_query($con, "delete from tblnotice where ID='$rid'");
    echo "<script>alert('Announcement Deleted!');</script>";
  }
?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>Gada AMS || Announcements Management</title>
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
              Announcements Management
            </h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="dashboard.php">Dashboard</a>
                  <li class="breadcrumb-item active">Announcements</li>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="content-body">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>S.NO</th>
                <th>Title</th>
                <th>Details</th>
                <th></th>
              </tr>
            </thead>

            <?php
            $ret = mysqli_query($con, "select * from tblnotice");
            $cnt = 1;
            while ($row = mysqli_fetch_array($ret)) { ?>
              <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo $row['Title']; ?></td>
                <td>
                  <a href="edit-notice.php?notid=<?php echo $row['ID']; ?>" title="Edit Announcement">
                    View & Edit
                  </a>
                </td>
                <td>
                  <a class="text-danger" href="manage-notice.php?delnotid=<?php echo $row['ID']; ?>" title="Delete Announcement" onClick="return confirm('Are you sure you want to delete this announcement?');">
                    Delete
                  </a>
                </td>
              </tr>
            <?php
              $cnt = $cnt + 1;
            } ?>
          </table>
        </div>
        <div><br><br><br><br><br><br></div>
        <div class="text-center">
          <button type="submit" class="btn btn-info" onclick="window.location.href='add-notice.php'">Add Announcement</button>
        </div>
      </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  </body>

  </html>
<?php  } ?>