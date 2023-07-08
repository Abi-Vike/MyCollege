<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid'] == 0)) {
  header('location:logout.php');
} else {

  if (isset($_POST['submit'])) {
    // input needs sanitization before injection into table
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $dec = mysqli_real_escape_string($con, $_POST['description']);
    $Announcementid = $_GET['notid'];

    $query = mysqli_query($con, "UPDATE tblAnnouncement SET Title = '$title', Description = '$dec' WHERE ID = '$Announcementid'");
    if ($query) {
      echo '<script>
              alert("Announcement has been Updated.");
              window.location.href="manage-Announcement.php";
            </script>';
    } else {
      echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }
  }
?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>RVU Gada: Admin || Announcement Update</title>
    <link rel="icon" type="image/png" href="../img/RVU-logo.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include('includes/header.php'); ?>
    <?php include('includes/leftbar.php'); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
              Update Announcement
            </h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="dashboard.php">Dashboard</a>
                    <li class="breadcrumb-item active">Update Announcement</li>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="content-body">
          <form name="course" method="post">
            <section class="formatter" id="formatter">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-content">
                      <?php
                      $noticeid = $_GET['notid'];
                      $ret = mysqli_query($con, "select * from tblnotice where ID='$noticeid'");
                      $cnt = 1;
                      while ($row = mysqli_fetch_array($ret)) {
                      ?> <div class="card-body">
                          <div class="row">
                            <div class="col-xl-6 col-lg-12">
                              <fieldset>
                                <h5>Title</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="title" type="text" name="title" required value="<?php echo $row['Title']; ?>">
                                </div>
                              </fieldset>

                              <fieldset>
                                <h5>Description</h5>
                                <div class="form-group">
                                  <textarea name="description" rows="20" class="form-control" cols="19" required="true"><?php echo $row['Description']; ?></textarea>
                                </div>
                              </fieldset>
                            </div>
                          </div>
                        <?php } ?>
                        <div class="row">
                          <div class="col-xl-6 col-lg-12">
                            <button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Update</button>
                          </div>
                        </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </form>
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
<?php }  ?>