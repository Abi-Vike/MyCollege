<?php
session_start();
error_reporting(1);
include('includes/dbconnection.php');
if (strlen($_SESSION['uid']==0)) 
{
  header('location:logout.php');
} 
else
{
  // Coding for form Submission 	
  if(isset($_POST['review']))
  {
    $uid=$_SESSION['uid'];
    $coursename=$_POST['coursename'];
    $admissionType=$_POST['admissionType'];

    // personal info
    $firstname=$_POST['firstname'];
    $middlename=$_POST['middlename'];
    $lastname=$_POST['lastname'];
    $nationality=$_POST['nationality'];
  
    $dobGregorian=$_POST['dobGregorian'];
    $dobEthiopian=$_POST['dobEthiopian'];
    $gender=$_POST['gender'];
    $upic=$_FILES["userpic"]["name"];
    
    $cobirth=$_POST['cobirth'];
    $pobtown=$_POST['pobtown'];
    $pobworeda=$_POST['pobworeda'];
    $pobkebele=$_POST['pobkebele'];
    
    // father's info
    $ffirstname=$_POST['ffirstname'];
    $fmiddlename=$_POST['fmiddlename'];
    $flastname=$_POST['flastname'];
    
    // mother's info
    $mfirstname=$_POST['mfirstname'];
    $mmiddlename=$_POST['mmiddlename'];
    $mlastname=$_POST['mlastname'];
    
    // residence and contact
    $restown=$_POST['restown'];
    $resworeda=$_POST['resworeda'];
    $reskebele=$_POST['reskebele'];
    $reshouse=$_POST['reshouse'];

    $phone1=$_POST['phone1'];
    $phone2=$_POST['phone2'];
    $email=$_POST['email'];
    $marital=$_POST['marital'];
    
    $emename=$_POST['emename']; 
    $emephone=$_POST['emephone']; 
    $emetown=$_POST['emetown']; 
    $emerelation=$_POST['emerelation']; 

    // educational background
    $sch_name_1=$_POST['sch_name_1'];
    $sch_town_1=$_POST['sch_town_1'];
    $sch_year_1=$_POST['sch_year_1'];
    $sch_stream_1=$_POST['sch_stream_1'];

    $sch_name_2=$_POST['sch_name_2'];
    $sch_town_2=$_POST['sch_town_2'];
    $sch_year_2=$_POST['sch_year_2'];
    $sch_stream_2=$_POST['sch_stream_2'];

    $sch_name_3=$_POST['sch_name_3'];
    $sch_town_3=$_POST['sch_town_3'];
    $sch_year_3=$_POST['sch_year_3'];
    $sch_stream_3=$_POST['sch_stream_3'];

    $ins_name_1=$_POST['ins_name_1'];
    $ins_country_1=$_POST['ins_country_1'];
    $ins_year_1=$_POST['ins_year_1'];
    $ins_major_1=$_POST['ins_major_1'];

    $ins_name_2=$_POST['ins_name_1'];
    $ins_country_2=$_POST['ins_country_2'];
    $ins_year_2=$_POST['ins_year_2'];
    $ins_major_2=$_POST['ins_major_2'];

    $ins_name_3=$_POST['ins_name_3'];
    $ins_country_3=$_POST['ins_country_3'];
    $ins_year_3=$_POST['ins_year_3'];
    $ins_major_3=$_POST['ins_major_3'];

    // decleration and signature
    $dec=$_POST['declaration'];
    $sign=$_POST['signature'];

    $extension = substr($upic,strlen($upic)-4,strlen($upic));
    // allowed extensions
    $allowed_extensions = array(".jpg","jpeg",".png",".gif");
    // Validation for allowed extensions .in_array() function searches an array for a specific value.
    if(!in_array($extension,$allowed_extensions))
    {
      echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif formats are allowed');</script>";
    }
    else
    {
      // rename user pic
      $userpic=$firstname."_".md5($upic).$extension;
      
      if(isset($_POST['submit']))
      {
        move_uploaded_file($_FILES["userpic"]["tmp_name"],"userimages/".$userpic);
        $query=mysqli_query($con,"insert into tbladmapplications( 
            UserId, CourseApplied, AdmissionType, FirstName, MiddleName, LastName, Nationality, DobGregorian, 
            DobEthiopian, Gender, UserPic, CountryOfBirth, TownOfBirth, WoredaOfBirth,
            KebeleOfBirth, FatherFirstName, FatherMiddleName, FatherLastName, MotherFirstName, 
            MotherMiddleName, MotherLastName, ResidenceTown, ResidenceWoreda, ResidenceKebele, 
            ResidenceHouse, PhoneNumber,PhoneNumber2, Email, MaritalStatus, EmergencyName, 
            EmergencyPhone, EmergencyTown, EmergencyRelation, SchoolName1, SchoolTown1, 
            SchoolLastYear1, SchoolStream1, SchoolName2, SchoolTown2, SchoolLastYear2, 
            SchoolStream2, SchoolName3, SchoolTown3, SchoolLastYear3, SchoolStream3, InsName1, 
            InsCountry1, InsLastYear1, InsMajor1, InsName2, InsCountry2, InsLastYear2, InsMajor2, 
            InsName3, InsCountry3, InsLastYear3, InsMajor3, Signature) value('$uid', '$coursename', 
            '$admissionType', '$firstname', '$middlename', '$lastname', '$nationality', '$dobGregorian', 
            '$dobEthiopian', '$gender', '$userpic', '$cobirth', '$pobtown', '$pobworeda', '$pobkebele', 
            '$ffirstname', '$fmiddlename', '$flastname', '$mfirstname', '$mmiddlename', '$mlastname', 
            '$restown', '$resworeda', '$reskebele', '$reshouse', '$phone1', '$phone2', '$email', '$marital', 
            '$emename', '$emephone', '$emetown', '$emerelation', '$sch_name_1', '$sch_town_1', 
            '$sch_year_1', '$sch_stream_1', '$sch_name_2', '$sch_town_2', '$sch_year_2', '$sch_stream_2', 
            '$sch_name_3', '$sch_town_3', '$sch_year_3', '$sch_stream_3', '$ins_name_1', '$ins_country_1', 
            '$ins_year_1', '$ins_major_1', '$ins_name_2', '$ins_country_2', '$ins_year_2', '$ins_major_2', 
            '$ins_name_3', '$ins_country_3', '$ins_year_3', '$ins_major_3', '$sign')");
        
        if ($query) 
          {
            echo '<script>alert("Application submitted successfully.")</script>';
            echo "<script>window.location.href ='addmission-form.php'</script>";
          }
        else
          {
            echo '<script>alert("Something Went Wrong. Please try again.")</script>';
            echo "<script>window.location.href ='addmission-form.php'</script>";
          }
      }  
    }
    
    
  }
  
  ?>
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">

  <head>
    <title>Admission Form || RVU-GADA Admission Management System</title>
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
                            
    </style>
  </head>

  <body onbeforeunload="return myFunction()" class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
    data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <?php include('includes/header.php');?>
    <?php include('includes/leftbar.php');?>
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
          $stuid=$_SESSION['uid'];
          $query=mysqli_query($con,"select * from tbladmapplications where  UserId=$stuid");
          $rw=mysqli_num_rows($query);
          if($rw>0){
            while($row=mysqli_fetch_array($query)){ ?>
              <p style="font-size:16px; color:red" align="center">Your Application.</p>
              <table border="1" class="table mb-0">
                <tr>
                  <th>Course</th>
                  <td><?php echo $row['CourseApplied'];?></td>
                </tr>
                <tr>
                  <th>Admission Type</th>
                  <td><?php echo $row['AdmissionType'];?></td>
                </tr>
                <tr>
                  <th>Applicant's Photo</th>
                  <td><img src="userimages/<?php echo $row['UserPic'];?>" width="200" height="200"></td>
                </tr>
                <tr>
                  <th>Applicant's Full Name</th>
                  <td><?php echo $row['FirstName']," ",$row['MiddleName']," ", $row['LastName'];?></td>
                </tr>
                <tr>
                  <th>Date of Birth</th>
                  <td><?php echo $row['DobGregorian'];?></td>
                </tr>
                <tr>
                  <th>Date of Birth - Ethiopian</th>
                  <td><?php echo $row['DobEthiopian'];?></td>
                </tr>
                <tr>
                  <th>Gender</th>
                  <td><?php echo $row['Gender'];?></td>
                </tr>
                <tr>
                  <th>Nationality</th>
                  <td><?php echo $row['Nationality'];?></td>
                </tr>
                <tr>
                  <th>Place of Birth</th>
                  <td><?php echo $row['CountryOfBirth']. ", ". $row['TownOfBirth']. ", ". $row['WoredaOfBirth']. ", ". $row['KebeleOfBirth'];?></td>
                </tr>
                <tr>
                  <th>Father's Full Name</th>
                  <td><?php echo $row['FatherFirstName']." ".$row['FatherMiddleName']." ".$row['FatherLastName'];?></td>
                </tr>
                <tr>
                  <th>Mother's Full Name</th>
                  <td><?php echo $row['MotherFirstName']." ".$row['MotherMiddleName']." ".$row['MotherLastName'];?></td>
                </tr>
                <tr>
                  <th>Residence</th>
                  <td><?php echo $row['ResidenceTown'].", ". $row['ResidenceWoreda'].", ". $row['ResidenceKebele'].", ". $row['ResidenceHouse'];?></td>
                </tr>
                <tr>
                  <th>Primary Phone Number</th>
                  <td><?php echo $row['PhoneNumber'];?></td>
                </tr>
                <tr>
                  <th>Alternative Phone Number</th>
                  <td><?php echo $row['PhoneNumber2'];?></td>
                </tr>
                <tr>
                  <th>Email Address</th>
                  <td><?php echo $row['Email'];?></td>
                </tr>
                <tr>
                  <th>Marital Status</th>
                  <td><?php echo $row['MaritalStatus'];?></td>
                </tr>
                <tr>
                  <th>Emergency Contact</th>
                  <td><?php echo $row['EmergencyName'].", ". $row['EmergencyPhone'];?></td>
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
                  <td><?php echo $row['SchoolName1'];?></td>
                  <td><?php echo $row['SchoolTown1'];?></td>
                  <td><?php echo $row['SchoolLastYear1'];?></td>
                  <td><?php echo $row['SchoolStream1'];?></td>
                </tr>
                <tr>
                  <th>2</th>
                  <td><?php echo $row['SchoolName2'];?></td>
                  <td><?php echo $row['SchoolTown2'];?></td>
                  <td><?php echo $row['SchoolLastYear2'];?></td>
                  <td><?php echo $row['SchoolStream2'];?></td>
                </tr>
                <tr>
                  <th>3</th>
                  <td><?php echo $row['SchoolName3'];?></td>
                  <td><?php echo $row['SchoolTown3'];?></td>
                  <td><?php echo $row['SchoolLastYear3'];?></td>
                  <td><?php echo $row['SchoolStream3'];?></td>
                </tr>
              </table>

              <table class="table mb-0">
                <tr>
                  <th>#</th>
                  <th>Institute</th>
                  <th>Country</th>
                  <th>Last Year Attended</th>
                  <th>Study Major</th>
                </tr>
                <tr>
                  <th>1</th>
                  <td><?php echo $row['InsName1'];?></td>
                  <td><?php echo $row['InsCounty1'];?></td>
                  <td><?php echo $row['InsLastYear1'];?></td>
                  <td><?php echo $row['InsMajor1'];?></td>
                </tr>
                <tr>
                  <th>2</th>
                  <td><?php echo $row['InsName2'];?></td>
                  <td><?php echo $row['InsCountry2'];?></td>
                  <td><?php echo $row['InsLastYear2'];?></td>
                  <td><?php echo $row['InsMajor2'];?></td>
                </tr>
                <tr>
                  <th>3</th>
                  <td><?php echo $row['InsName3'];?></td>
                  <td><?php echo $row['InsCountry3'];?></td>
                  <td><?php echo $row['InsLastYear3'];?></td>
                  <td><?php echo $row['InsMajor3'];?></td>
                </tr>
              </table>
              

              <div class="row" style="margin-top: 2%">
                <div class="col-xl-12 col-lg-12">
                  <h5><b>I hereby state that the facts mentioned above are true to the best of my knowledge and belief.</b></h5>
                </div>
                
                <div class="col-xl-6 col-lg-12">
                  <button type="submit" onclick="return confirm('You will not be able to change or edit your application once submitted! Do you want to submit your application?')" 
                          name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Submit</button>
                </div>
              </div>


              <table class="table mb-0">
                <tr>
                  <th>Admin's Remark</th>
                  <td><?php echo $row['AdminRemark'];?></td>
                </tr>
                <tr>
                  <th>Application Status</th>
                  <td><?php 
                    if($row['AdminStatus']==""){
                      echo "admin remark is pending";
                    } 
                    
                    if($row['AdminStatus']=="1"){
                      echo "Accepted";
                    }
                    
                    if($row['AdminStatus']=="2"){
                      echo "Rejected";
                    }
                  ?></td>
                </tr>
                <tr>
                  <th>Admin's Remark Date</th>
                  <td><?php echo $row['AdminRemarkDate'];?></td>
                </tr>
                <tr>
                  <th colspan="2"><font color="red">Declaration : </font>I hereby state that the facts mentioned above are true to the best of my knowledge and belief.<br />
                    (<?php  echo $row['Signature'];?>)
                  </th>
                </tr>
              </table>
              <br>
              
              <?php 
              if ($row['AdminStatus']==""){
              ?>
                <p style="text-align: center;font-size: 20px;"><a href="edit-appform.php?editid=<?php echo $row['ID'];?>">Edit Details</a></p>
                <?php 
              }
            } 
          } 
          else 
          { ?>
            <form name="submit" method="post" enctype="multipart/form-data">      
              <!--start of section-->
              <section class="formatter" id="formatter">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">Undergraduate Admission Form</h4>

                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                        
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            
                          </ul>
                        </div>
                      </div>
                      <div class="card-content">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-12 background-color : warning">
                              <hr>
                              Note that all fields are required and have to be filled accordingly, unless marked as <em><b>optional</b></em> .
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
                                    <?php $query=mysqli_query($con,"select * from tblcourse");
                                      while($row=mysqli_fetch_array($query)){ ?>    
                                        <option value="<?php echo $row['CourseName'];?>">
                                        <?php echo $row['CourseName'];?></option>
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
                                    <option value="regular">  Regular </option>
                                    <option value="evening">  Evening </option>
                                    <option value="weekend">  Weekend </option>
                                    <option value="distance"> Distance</option>
                                  </select>
                                </div>
                              </fieldset>
                            </div>
                            
                          </div>


                          <div class="row" style="margin-top: 2% ">
                            <div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>Personal Information</b></h4>
                              <hr style="border-top: 1px solid" />
                            </div>
                          </div>


                          <!--second row-->
                          <div class="row">
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>First Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="firstname" name="firstname"  type="text" required>
                                </div>
                              </fieldset>               
                            </div>
                                
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Middle Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="middlename" name="middlename"  type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Last Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="lastname" name="lastname"  type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Nationality                </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="nationality" name="nationality"  type="text" required>
                                </div>
                              </fieldset>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Date of Birth (Gregorian)                  </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="dobGregorian" name="dobGregorian" type="date" required>
                                  <!--<small class="text-muted">Must be in format (dd/mm/yyyy)</small>-->
                                </div>
                              </fieldset>                  
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Date of Birth (Ethiopian)                   </h5>
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
                                  <select class="form-control white_bg" id="gender" name="gender"  required>
                                    <option value=""></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                  </select>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Applicant's Photo                   </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="userpic" name="userpic"  type="file" accept="image/*" required>
                                </div>
                                <div id="error-message"></div>
                              </fieldset>                  
                            </div>

                            <script>
                              const fileInput = document.querySelector('#userpic');
                              const errorMessage = document.querySelector('#error-message');

                              fileInput.addEventListener('change', function(event) {
                                const selectedFile = event.target.files[0];
                                const fileType = selectedFile.type;

                                if (!fileType.startsWith('image/')) {
                                  // Display error message and highlight the file input field
                                  errorMessage.textContent = 'Please select an image file';
                                  fileInput.classList.add('error');
                                  
                                  // Prevent form submission
                                  event.preventDefault();
                                } else {
                                  // Clear error message and remove highlight from file input field
                                  errorMessage.textContent = '';
                                  fileInput.classList.remove('error');
                                }
                              });
                            </script>

                            <style>
                              #error-message {
                                color: red;
                                margin-top: -20px;
                              }
                            </style>

                          </div>

                          <!--fourth row-->
                          <div class="row">
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Country of Birth                </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="cobirth" name="cobirth"  type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Place of Birth (Town)             </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="pobtown" name="pobtown"  type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Place of Birth (Woreda)             </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="pobworeda" name="pobworeda"  type="text" required>
                                </div>
                              </fieldset>
                            </div>
                            
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Place of Birth (Kebele)             </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="pobkebele" name="pobkebele"  type="text" required>
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
                                  <input class="form-control white_bg" id="ffirstname" name="ffirstname"  type="text" required>
                                </div>
                              </fieldset>               
                            </div>
                                
                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                                <h5><br></h5>
                                <h5>Middle Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="fmiddlename" name="fmiddlename"  type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                              <h5><br></h5>
                                <h5>Last Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="flastname" name="flastname"  type="text" required>
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
                                  <input class="form-control white_bg" id="mfirstname" name="mfirstname"  type="text" required>
                                </div>
                              </fieldset>               
                            </div>
                                
                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                                <h5><br></h5>
                                <h5>Middle Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="mmiddlename" name="mmiddlename"  type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                              <h5><br></h5>
                                <h5>Last Name </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="mlastname" name="mlastname"  type="text" required>
                                </div>
                              </fieldset>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <h4 style="margin-bottom: 1%" class="card-title">Applicant's Residence and Contact :</h4>
                            </div>
                          </div>

                          <!--fifth row-->
                          <div class="row">
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Town             </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="restown" name="restown"  type="text" required>
                                </div>
                              </fieldset>
                            </div>
                            
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Woreda             </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="resworeda" name="resworeda"  type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Kebele             </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="reskebele" name="reskebele"  type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>House Number (optional)        </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="reshouse" name="reshouse"  type="text">
                                </div>
                              </fieldset>
                            </div>
                          </div>

                          <!--fifth row-->
                          <div class="row">
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Phone Number             </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="phone1" name="phone1"  type="text" placeholder="09xxxxxxxx" required>
                                </div>
                              </fieldset>
                            </div>
                            
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Phone Number (optional)             </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="phone2" name="phone2"  type="text" placeholder="09xxxxxxxx">
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Email Address             </h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="email" name="email"  type="text" placeholder="Example@gmail.com" required>
                                  <span id="email-error" style="color:red;"></span>
                                </div>
                              </fieldset>

                              <script>
                              const emailInput = document.getElementById('email');
                              const emailError = document.getElementById('email-error');

                              emailInput.addEventListener('input', function() {
                                const email = emailInput.value;
                                const validEmailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                                if (email.match(validEmailRegex)) {
                                  emailError.textContent = '';
                                  emailInput.style.border = '1px solid green';
                                } else {
                                  emailError.textContent = 'Please enter a valid email address';
                                  emailInput.style.border = '1px solid red';
                                }
                              });
                              </script>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Marital Status               </h5>
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
                                  <input class="form-control white_bg" id="emename" name="emename"  type="text" required>
                                </div>
                              </fieldset>
                            </div>
                            
                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Phone Number</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="emephone" name="emephone" placeholder="09xxxxxxxx" type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Town</h5>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="emetown" name="emetown"  type="text" required>
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-xl-3 col-lg-12">
                              <fieldset>
                                <h5>Relationship With Applicant             </h5>
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
                                <h6>List the Three last Secondary schools you attended, if applicable, starting with the most recent.</h6>
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
                                  <td> 2 </td>
                                  <td> <input class="form-control white_bg" id="sch_name_2" name="sch_name_2" type="text" ></td>
                                  <td> <input class="form-control white_bg" id="sch_town_2" name="sch_town_2" type="text" ></td>
                                  <td> <input class="form-control white_bg" id="sch_year_2" name="sch_year_2" type="int" min="1950" max="2023" ></td>
                                  <td> <input class="form-control white_bg" id="sch_stream_2" name="sch_stream_2" type="text" ></td>
                                </tr>
                                
                                <tr>
                                  <td> 3 </td>
                                  <td> <input class="form-control white_bg" id="sch_name_3" name="sch_name_3" type="text" ></td>
                                  <td> <input class="form-control white_bg" id="sch_town_3" name="sch_town_3" type="text" ></td>
                                  <td> <input class="form-control white_bg" id="sch_year_3" name="sch_year_3" type="int" min="1950" max="2023" ></td>
                                  <td> <input class="form-control white_bg" id="sch_stream_3" name="sch_stream_3" type="text" ></td>
                                </tr>
                                
                              </table>
                            </div>
                          </div>
                          </hr>


                          <div class="row" style="margin-top: 2%">
                            <div class="col-xl-12 col-lg-12">                        
                                <h6>Have you ever enrolled in any Post Secondary educational institution(s) - University or College, in Ethiopia or Abroad?</h6>
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
                                <h6>List the Post Secondary Institution(s) you attended starting with the most recent.</h6>
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
                                  <td> <input class="form-control white_bg" id="ins_name_1" name="ins_name_1" type="text" ></td>
                                  <td> <input class="form-control white_bg" id="ins_country_1" name="ins_country_1" type="text" ></td>
                                  <td> <input class="form-control white_bg" id="ins_year_1" name="ins_year_1" type="int" min="1950" max="2023" ></td>
                                  <td> <input class="form-control white_bg" id="ins_major_1" name="ins_major_1" type="text" ></td>
                                </tr>
                                
                                <tr>
                                  <td> 2 </td>
                                  <td> <input class="form-control white_bg" id="ins_name_2" name="ins_name_2" type="text" ></td>
                                  <td> <input class="form-control white_bg" id="ins_country_2" name="ins_country_2" type="text" ></td>
                                  <td> <input class="form-control white_bg" id="ins_year_2" name="ins_year_2" type="int" min="1950" max="2023" ></td>
                                  <td> <input class="form-control white_bg" id="ins_major_1" name="ins_major_2" type="text" ></td>
                                </tr>
                                
                                <tr>
                                  <td> 3 </td>
                                  <td> <input class="form-control white_bg" id="ins_name_3" name="ins_name_3" type="text" ></td>
                                  <td> <input class="form-control white_bg" id="ins_country_3" name="ins_country_3" type="text" ></td>
                                  <td> <input class="form-control white_bg" id="ins_year_3" name="ins_year_3" type="int" min="1950" max="2023" ></td>
                                  <td> <input class="form-control white_bg" id="ins_major_3" name="ins_major_3" type="text" ></td>
                                </tr>
                                
                              </table>
                            </div>
                          </div>
                          <hr>


                          <!--ninth row-->
                          <div class="row" style="margin-top: 3%">
                            <div class="col-xl-12 col-lg-12">
                              <h4 class="card-title"><b>Declaration</b></h4> 
                              <hr style="border-top: 1px solid" />
                            </div>
                          </div>

                          <!--tenth row-->
                             
                                               
                          <!--eleventh row-->
                          <div class="row"> 
                            <div class="col-xl-4 col-lg-12">
                              <fieldset>
                                <input class="form-control white_bg" id="signature" name="signature" placeholder="Your Name for Signature"  type="text"> 
                              </fieldset>  
                            </div>
                          </div>

                          <!--twelfth row-->
                          <div class="row" style="margin-top: 2%">
                            <div class="col-xl-6 col-lg-12">
                              <button type="button" value="review" 
                                      name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Submit</button>
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


  <?php include('includes/footer.php');?>
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

    <script>
      $(document).ready(function(){
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
