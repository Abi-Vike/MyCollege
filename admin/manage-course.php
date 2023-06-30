<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid'] == 0)) {    // was ==0
  header('location:logout.php');
} else {
  //code for deletion
  if (isset($_GET['delid'])) {
    $rowid = $_GET['delid'];
    $query = mysqli_query($con, "delete from tblcourse where ID='$rowid'");
    echo "<script>alert('Course Deleted successfully');</script>";
    echo "<script>window.location.href='manage-course.php'</script>";
  }
?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <title>Gada AMS || Courses</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/extended/form-extended.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include('includes/header.php'); ?>
    <?php include('includes/leftbar.php'); ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
              Manage Course
            </h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                  </li>
                  </li>
                  <li class="breadcrumb-item active">Manage Course
                  </li>
                </ol>
              </div>
            </div>
          </div>

        </div>
        <div class="content-body">
          <!-- Input Mask start -->

          <!-- Formatter start -->
          <table class="table mb-0">
            <thead>
              <tr>
                <th>S.NO</th>
                <th>Course Name</th>
                <th>Enrolled Students</th>
                <th>Action</th>
              </tr>
            </thead>
            <?php
            $ret = mysqli_query($con, "SELECT ID, CourseName FROM tblcourse");
            $cnt = 1;
            while ($row = mysqli_fetch_array($ret)) {
              $course_ID = $row['ID'];
              $course_name = $row['CourseName'];

              // number of students enrolled in each course
              $std_cnt = 0;
              $std = mysqli_query($con, "SELECT Reg_ID FROM tblregistered WHERE Reg_Course = '$course_name'");
              while ($row = mysqli_fetch_array($std)) {
                $std_cnt += 1;
              } ?>
              <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo $course_name; ?></td>
                <td><?php echo $std_cnt; ?></td>
                <td><a href="edit-course.php?editid=<?php echo $row['ID']; ?>">Edit-Name</a> |
                  <a href="manage-course.php?delid=<?php echo $row['ID']; ?>" style="color:red" onclick="return confirm('Do you really want to delete this course?');">Delete-Course</a>
              </tr>
            <?php
              $cnt = $cnt + 1;
            } ?>
          </table>
        </div>
        <div><br><br><br><br><br><br></div>
        <div class="text-center">
          <button type="submit" class="btn btn-info" onclick="window.location.href='add-course.php'">Add Course</button>
        </div>
      </div>
    </div>


    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include('includes/footer.php'); ?>

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