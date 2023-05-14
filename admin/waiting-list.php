<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid']==0)) {    // was ==0
  header('location:logout.php');
} 
else{
  ?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">
  <head>

    <title>RVU-GADA Admission Management System - Pending Applications</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
    rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
    rel="stylesheet">
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
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      }
      .succWrap{
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      }
      table{
        width: 100%; 
        max-width: 100%; 
        overflow-x: auto; 
        white-space: nowrap;
      }
      td, th{
        padding: 15px;
      }
      @media only screen and (max-width: 600px) {
        table, tbody, thead, th, td, tr {
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

  <body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <?php include('includes/header.php');?>
    <?php include('includes/leftbar.php');?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
              Applications
            </h3>

            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">
                    Waiting List
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        
        <div class="content-body">
          <!-- Input Mask start -->

          <!-- Formatter start -->

          <table>
            <thead>
              <tr>
                <th>S.no</th>
                <th>Course</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Status</th>
              </tr>
            </thead>
            <?php
              $ret=mysqli_query($con,"select tbladmapplications.CourseApplied, tbldocument.ID as docid,  tbladmapplications.UserId as applicationID, tbladmapplications.PhoneNumber, tbladmapplications.AdminStatus, tbluser.FirstName, tbluser.MiddleName, tbluser.Email from tbladmapplications inner join tbluser on tbluser.ID=tbladmapplications.UserId left join tbldocument on tbldocument.UserID=tbladmapplications.UserId where tbladmapplications.AdminStatus='3'");
              $cnt=1;
              
              while ($row=mysqli_fetch_array($ret)) {
                ?>
                <tr>
                  <td><?php echo $cnt;?></td>
                  <td><?php echo $row['CourseApplied'];?></td>
                  <td><?php echo $row['FirstName'];?></td>
                  <td><?php echo $row['MiddleName'];?></td>
                  <td><?php echo $row['PhoneNumber'];?></td>
                  <td><?php echo $row['Email'];?></td>
                  <td>
                    <a href="view-appform.php?aticid=<?php echo $row['applicationID'];?>" target="_blank">View Application</a>
                  </td>
                </tr>
                <?php 
                $cnt=$cnt+1;
              }
            ?>
          </table>
        </div>
      </div>
    </div>

        
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include('includes/footer.php');?>
    <!-- BEGIN VENDOR JS-->
    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/forms/extended/typeahead/typeahead.bundle.min.js"
    type="text/javascript"></script>
    <script src="app-assets/vendors/js/forms/extended/typeahead/bloodhound.min.js"
    type="text/javascript"></script>
    <script src="app-assets/vendors/js/forms/extended/typeahead/handlebars.js"
    type="text/javascript"></script>
    <script src="app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js"
    type="text/javascript"></script>
    <script src="app-assets/vendors/js/forms/extended/formatter/formatter.min.js"
    type="text/javascript"></script>
    <script src="../../../app-assets/vendors/js/forms/extended/maxlength/bootstrap-maxlength.js"
    type="text/javascript"></script>
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
} 
?>
