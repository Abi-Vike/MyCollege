<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['aid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_GET['app_id'])) {
    $adm_app_ID = $_GET['app_id'];

    //logic for manual payment verification goes down here
    $ret = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tblpayments WHERE Application_ID = " . $adm_app_ID));
    $name = $ret["Payer_Name"];
    $ref = $ret["Pay_Ref"];
    $date = date('d-M-Y', strtotime($ret["Pay_Date"]));
    $receipt = $ret["Pay_Receipt"];
?>
    <!DOCTYPE html>
    <html class="loading" lang="en" data-textdirection="ltr">

    <head>
      <title>RVU Gada: Admin || Manual Payment Verification</title>
      <link rel="icon" type="image/png" href="../img/RVU-logo.png">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
      <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
      <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
      <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
      <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
      <link rel="stylesheet" type="text/css" href="app-assets/css//custom2.css">
    </head>

    <body>

      <div class="app-content content">
        <div class="content-wrapper">
          <div class="content-body">
            <p style="font-size:20px; color:darkblue" align="center">Applicant's Payment Claim</p>
            <table border="3" class="table mb-0">
              <tr>
                <th>Name</th>
                <td><b><?php echo $name; ?></b></td>
              </tr>
              <tr>
                <th>Payment Reference</th>
                <td><b><?php echo $ref; ?></b></td>
              </tr>
              <tr>
                <th>Payment Date</th>
                <td><b><?php echo $date; ?></b></td>
              </tr>
              <tr>
                <th>Receipt</th>
                <td><img src="../user/userimages/payments/<?php echo $receipt ?>" height=430></td>
              </tr>
            </table>

            <div align="center" class="mt-1 mb-2">
              <button onclick="acceptPayment()" type="submit" id="submit_button" name="submit" class="btn btn-success mx-2" style="width: 300px;">Confirm payment</button>
              <button onclick="declinePayment()" type="submit" id="submit_button" name="submit" class="btn btn-danger mx-2" style="width: 300px;">Decline Payment Claim</button>
            </div>
          </div>
        </div>
      </div>

      <!-- General Javascript functions definitions -->
      <script>
        // accepting an offer
        function acceptPayment() {
          var confirmMessage = "Are you sure you want to accept this payment and update applicant's payment status?";
          if (confirm(confirmMessage)) {
            window.location.href = "pay-status.php?app_id=<?php echo $adm_app_ID; ?>&action=accept";
          }
        }

        // declining an offer
        function declinePayment() {
          var confirmMessage = "Are you sure you want to decline the payment claim and clear all payment records related to this applicant?";
          if (confirm(confirmMessage)) {
            window.location.href = "pay-status.php?app_id=<?php echo $adm_app_ID; ?>&action=decline";
          }
        }

        // to prevent accidental triggering of the decline-offer when the user clicks the "go back" button. 
        // this snippet prevents the user from going back using the browser's history, maintaining the current page URL.
        if (window.history && window.history.pushState) {
          window.history.pushState(null, null, window.location.href);
          window.onpopstate = function() {
            window.history.pushState(null, null, window.location.href);
          };
        }
      </script>
      <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
      <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
      <script src="app-assets/js/core/app.js" type="text/javascript"></script>
    </body>
<?php
  } else {
    header('location:error.php');
  }
}
