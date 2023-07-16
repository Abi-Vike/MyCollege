<?php
require_once 'includes/emailer.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $toemail = $_POST['toemail'];
  $ID_i = $_POST['ID_i'];
  $FirstName_i = $_POST['FirstName_i'];
  $CourseApplied_i = $_POST['CourseApplied_i'];
  $AdmissionType_i = $_POST['AdmissionType_i'];

  SendPayReminder($toemail, $ID_i, $FirstName_i, $CourseApplied_i, $AdmissionType_i);
}
?>
