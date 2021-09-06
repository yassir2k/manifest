<?php
ini_set('display_errors', 'off');
session_start();
//Check if user session does not exist or the user does not belong to the relevant dept, and role.
if ($_SESSION['user'] == null 
|| ( ($_SESSION['user_type'] != "Courier") ))
{
	header("Location: ../index.php");
}
include ('../dbconnection.php');
$scode = $_SESSION['state_code'];
$initials = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="images/cac_icon.ico"/>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/manifest-css.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap-toggle.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <title>E - Despatch: Courier's Dashboard</title>
</head>

<body>

<div class="container-fluid" aria-hidden="true">
<div class="container-bg">
  <div class="fcta-header">
		<img src="images/cac-logo.png" class="cac-logo">
		<img src="images/coat-of-arms.png" class="coat-of-arm">
	</div>
   <!-- ------------------------------------Beginning of Navigation---------------------------------------- -->
   <?php require 'menus/menu_courier_dashboard.php';?>
   <!-- ---------------------------------------End of Navigation------------------------------------------- -->
   
   <div class="row top-buffer">
   
        <div class="col-sm-8"> <!--Main Row Left-->
            <div class="row"><!--Manifest Statistics Mail Room-->
                <div class="col-sm-3" align="center">
                    <hr class="separator" >
                </div>
                <div class="col-sm-6" align="center">
                    <h6 class="text-success" align="center"><b>Total Batches Received Today (From Mail Room)</b></h6>
                </div>
                <div class="col-sm-3" align="center">
                    <hr class="separator">
                </div>
        	</div><!--End of Manifest Statistics Mail Room-->
			<?php 
				//Total Received From Mail Room
				$sql = "SELECT count(*) as Total FROM tbl_Despatch_Tracking where convert(varchar(10), ";
				$sql.= "MR_Despatched_Timestamp, 102) = convert(varchar(10), getdate(), 102) AND (Initials = '$initials' AND State_Code='$scode')";
				$result = sqlsrv_query($conn, $sql);
				if($result === false) {
					die(print_r("Total::".sqlsrv_errors(), true));
				}
				$total_reg = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC); 
				
				//Total Pending with Mail Room
				$sql = "SELECT count(*) as Total FROM tbl_Despatch_Tracking where convert(varchar(10), ";
				$sql.= "MR_Despatched_Timestamp, 102) = convert(varchar(10), getdate(), 102) AND (Courier_Ack_Date IS NULL) AND (Initials = '$initials' AND State_Code='$scode')";
				$result = sqlsrv_query($conn, $sql);
				if($result === false) {
					die(print_r(sqlsrv_errors(), true));
				}
				$pending_reg = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
				
				//Total Acknowledged by Mail Room
				$sql = "SELECT count(*) as Total FROM tbl_Despatch_Tracking where convert(varchar(10), ";
				$sql.= "MR_Despatched_Timestamp, 102) = convert(varchar(10), getdate(), 102) AND (Courier_Ack_Date IS NOT NULL) AND (Initials = '$initials' AND State_Code='$scode')";
				$result = sqlsrv_query($conn, $sql);
				if($result === false) {
					die(print_r(sqlsrv_errors(), true));
				}
				$ack_reg = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
				
			?>
			<div class="row"><!--Beginning of Putting Up Stats For Mail Room-->
                <div class="col-sm-4" align="center">
                    <div class="card bg-white mb-3 shadow-sm" style="width: 13rem;">
						<div class="card-body">
							<h1 class="card-title"><?php echo $total_reg['Total']; ?></h1>
							<hr class="separator">
							<p class="card-text"><b class="font-pref14">TOTAL RECEIVED</b></p>
						</div>
					</div>
                </div>
                <div class="col-sm-4" align="center">
                    <div class="card bg-white mb-3 shadow-sm" style="width: 13rem;">
						<div class="card-body">
							<h1 class="card-title"><?php echo $pending_reg['Total']; ?></h1>
							<hr class="separator">
							<p class="card-text"><b class="font-pref14">PENDING ACK.</b></p>
						</div>
					</div>
                </div>
                <div class="col-sm-4" align="center">
                    <div class="card bg-white mb-3 shadow-sm" style="width: 13rem;">
						<div class="card-body">
							<h1 class="card-title"><?php echo $ack_reg['Total']; ?></h1>
							<hr class="separator">
							<p class="card-text"><b class="font-pref14">ACKNOWLEDGED</b></p>
						</div>
					</div>
                </div>
        	</div><!--End of Putting Up Stats For Mail Room-->
			
				<?php 
				//Total Forwarded (Mail Room)
				$sql = "SELECT count(*) as Total FROM tbl_Despatch_Tracking where (Initials = '$initials' AND State_Code='$scode')";
				$result = sqlsrv_query($conn, $sql);
				if($result === false) {
					die(print_r(sqlsrv_errors(), true));
				}
				$total_it = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC); 
				
				//Total Pending with Mail Room
				$sql = "SELECT count(*) as Total FROM tbl_Despatch_Tracking where (Courier_Ack_Date IS NULL) AND (Initials = '$initials' AND State_Code='$scode')";
				$result = sqlsrv_query($conn, $sql);
				if($result === false) {
					die(print_r(sqlsrv_errors(), true));
				}
				$pending_it = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
				
				//Total Acknowledged by Mail Room
				$sql = "SELECT count(*) as Total FROM tbl_Despatch_Tracking where (Courier_Ack_Date IS NOT NULL) AND (Initials = '$initials' AND State_Code='$scode')";
				$result = sqlsrv_query($conn, $sql);
				if($result === false) {
					die(print_r(sqlsrv_errors(), true));
				}
				$ack_it = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
				
			?>
			
			<div class="row top-space20" ><!--Manifest Statistics IT-->
                <div class="col-sm-3" align="center">
                    <hr class="separator">
                </div>
                <div class="col-sm-6" align="center">
                    <h6 class="text-success" align="center"><b>Overall Total Batches Received(From Mail Room)</b></h6>
                </div>
                <div class="col-sm-3" align="center">
                    <hr class="separator">
                </div>
        	</div><!--End of Manifest Statistics IT-->
			
			<div class="row"><!--Beginning of Putting Up Stats For IT-->
                <div class="col-sm-4" align="center">
                    <div class="card bg-white mb-3 shadow-sm" style="width: 13rem;">
						<div class="card-body">
							<h1 class="card-title"><?php echo $total_it['Total']; ?></h1>
							<hr class="separator">
							<p class="card-text"><b class="font-pref14">TOTAL FORWARDED</b></p>
						</div>
					</div>
                </div>
                <div class="col-sm-4" align="center">
                    <div class="card bg-white mb-3 shadow-sm" style="width: 13rem;">
						<div class="card-body">
							<h1 class="card-title"><?php echo $pending_it['Total']; ?></h1>
							<hr class="separator">
							<p class="card-text"><b class="font-pref14">PENDING</b></p>
						</div>
					</div>
                </div>
                <div class="col-sm-4" align="center">
                    <div class="card bg-white mb-3 shadow-sm" style="width: 13rem;">
						<div class="card-body">
							<h1 class="card-title"><?php echo $ack_it['Total']; ?></h1>
							<hr class="separator">
							<p class="card-text"><b class="font-pref14">ACKNOWLEDGED</b></p>
						</div>
					</div>
                </div>
        	</div><!--End of Putting Up Stats-->
			
			
        </div>
        
		
        <div class="col-sm-4"> <!--Main Row Right-->
            <!--Nested rows within a column-->
            <div class="row">
                <div class="col-sm-12">
                       <div class="row">
							<div class="col-sm-3">
								<i class="fa fa-user-circle-o fa-5x " style="color: #8FBC8F"></i>
							</div>
							<div class="col-sm-9">
								<div class="row">
									<div class="col-sm-8">
										<span class="text-dark"><b>Courier:</b></span>
									</div>
								</div>
								<div class="row font-pref14">
									<div class="col-sm-8">
										<span class="text-secondary"><?php echo $_SESSION['courier']  ?></span>
									</div>
								</div>
							   <div class="row font-pref14">
									<div class="col-sm-8">
										<span class="text-secondary"><?php echo "(".$initials.")"; ?></span>
									</div>
							   </div>
							   <div class="row">
									<div class="col-sm-8">
										<span class="text-dark"><b>Address:</b></span>
									</div>
								</div>
								<div class="row font-pref14">
									<div class="col-sm-8">
										<span style="text-align: justify;" class="text-secondary"><?php echo $_SESSION['address'];?></span>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-8">
										<span class="text-dark"><b>Contact Person:</b></span>
									</div>
								</div>
								<div class="row font-pref14">
									<div class="col-sm-8">
										<span class="text-secondary"><?php echo $_SESSION['personnel'];?></span>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-8">
										<span class="text-dark"><b>Office/Location Code:</b></span>
									</div>
								</div>
								<div class="row font-pref14">
									<div class="col-sm-8">
										<span class="text-secondary"><?php echo $scode;?></span>
									</div>
								</div>
							   <div class="row font-pref14">
									<div class="col-sm-4">
										<span><a href="edit_user_profile.php" class="option">Edit User</a></span>
									</div>
									<div class="col-sm-8">
										<span><a href="change_password.php" class="option">Change Password</a></span>
									</div>
							   </div>
							</div>
					   </div>
					</div>
                </div>
            </div>
        </div><!--End of Row Top Buffer-->
    </div> <!--End of Row container-bg-->
    <!-- -----------------------------------------End of Main Content------------------------------------------ -->
	<!------------------------------------------------------Footer----------------------------------------- -->
	<!-- Footer -->
	<footer class="page-footer font-small bg-secondary">

	  <!-- Copyright -->
	  <div class="footer-copyright text-center text-white py-3 font-pref14">
		© 2020 Copyright - Corporate Affairs Commission (ICT Department)
	  </div>
	  <!-- Copyright -->

	</footer>
	<!-- Footer -->
</div><!--End of container-fluid-->
</body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="js/bootstrap4-toggle.js"></script>
</html>