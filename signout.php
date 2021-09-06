<?php
$fail = 0;
session_start();
if ($_SESSION['user'] != null){ //Routed From Other Pages
// remove all session variables
session_unset();

// destroy the session
session_destroy();
}
else{
	//Check if this link is directly pasted on the url space in browser
	if(!(isset($_REQUEST['btn_submit']))){
	header("Location: index.php");
	}
	//Check if the signout page is used for re-login
	if(isset($_REQUEST['btn_submit'])){	
	
		include ("dbconnection.php"); 
		$user = $_POST['Username'];
		$pwd = $_POST['Password'];
		
		//For internal staff
		$query = "SELECT * FROM tbl_Schedule_officers WHERE (Login_ID = '$user' AND Login_Password = '$pwd') AND Role = 'Pre Incorporation'";
		$result = sqlsrv_query($conn, $query);
		
		//For internal staff Post_Incorporation
		$p_query = "SELECT * FROM tbl_Schedule_officers WHERE (Login_ID = '$user' AND Login_Password = '$pwd') AND Role = 'Post Incorporation'";
		$p_result = sqlsrv_query($conn, $query);
		
		//For Courier
		$c_query = "SELECT * FROM tbl_Courier_Companies WHERE (Initials = '$user' AND Login_Password = '$pwd')";
		$c_result = sqlsrv_query($conn, $c_query);
		
		if(sqlsrv_has_rows($result))
		{	
			$row = sqlsrv_fetch_array($result);
			if($row['Is_Active'] == '1')
			{
				$_SESSION['user'] = $row['Login_ID'];
				$_SESSION['fullname'] = $row['First_Name']." ".$row['Surname'];
				$_SESSION['dept'] = $row['Department'];
				$_SESSION['role'] = $row['Role'];
				$_SESSION['state_code'] = $row['State_Code'];
				if($_SESSION['dept'] == "RGs Office")
					header("Location: pre-inc/rgs_office_dashboard.php");
				if($_SESSION['dept'] == "Registry")
					header("Location: pre-inc/registry_dashboard.php");
				if($_SESSION['dept'] == "Trustees")
					header("Location: pre-inc/trustees_dashboard.php");
				if($_SESSION['dept'] == "Business Names")
					header("Location: pre-inc/bn_dashboard.php");
				if($_SESSION['dept'] == "Mail Room")
					header("Location: pre-inc/mail_room_dashboard.php");
				if($_SESSION['dept'] == "Mail Room")
					header("Location: pre-inc/mail_room_dashboard.php");
				if($_SESSION['dept'] == "Admin")
					header("Location: pre-inc/admin_dashboard.php");
			}
			else{
				$fail = 2;
			}
			
		}
		else if(sqlsrv_has_rows($p_result))
		{
			
		}
		else if(sqlsrv_has_rows($c_result))
		{
			$row = sqlsrv_fetch_array($c_result);
			if($row['Is_Active'] == '1')
			{
				$_SESSION['user'] = $row['Initials'];
				$_SESSION['user_type'] = "Courier";
				$_SESSION['courier'] = $row['Courier_Company_Name'];
				$_SESSION['address'] = $row['Courier_Address'];
				$_SESSION['personnel'] = $row['Contact_Person'];
				$_SESSION['state_code'] = $row['State_Code'];
				header("Location: courier_dashboard.php");
			}
			else
			{
				$fail = 2;
			}
		}
		else{
			$fail = 1;
		}
	}
}
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
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <title>E - Manifest: Signout</title>
</head>

<body style="background-color:#F5F5F5">
<div class="login-form">
<div class="row h-100">
	<div class="col-sm-3 my-auto"><!--Logo-->
		<img src="images/cac_logo.png"  class="rounded" alt="Rounded Image">
	</div>
	<div class="col-sm-9">
		<div class="row">
		<div class="col-sm-12" align="left"><!--Sign In-->
			<h2 class="text-center text-secondary"><strong>Manifest Portal</strong></h2>
		</div>
		</div>
		<div class="row">
			<div class="col-sm-12"><!--Sign In-->
				<h5 class="text-center" style="color: #8FBC8F"><strong>Sign In</strong></h5>
			</div>
		</div>
		
		<form action="index.php" method="post" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
			<div class="row">
				<div class="col-sm-12"><!--Username-->
				
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<span class="fa fa-user" style="color: #8FBC8F"></span>
								</span>                    
							</div>
							<input type="text" class="form-control" placeholder="Username" name="Username" required>
						</div>
					</div>
				
				</div><!--End Username-->
			</div>
			
			<div class="row">
				<div class="col-sm-12"><!--Password-->
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fa fa-lock" style="color: #8FBC8F"></i>
								</span>                    
							</div>
							<input type="password" class="form-control" placeholder="Password" name="Password" required>
						</div>
					</div>
				</div><!--End Password-->
			</div>
			
			<div class="row">
				<div class="col-sm-12"><!--Button-->
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-block" name="btn_submit">
							<span>Login</span>
							<i class="fa fa-sign-in" style="horizontal-align: right;" ></i>
						</button> 
					</div>
				</div><!--End Button-->
			</div>
			<div class="row">
				<div class="col-sm-12">
					<?php if ($fail === 0) { 
						echo "<div class='alert alert-success text-center' role='alert'><b>You've successfully logged out.</b></div>";
					}
					if ($fail === 1) { 
						echo "<div class='alert alert-danger text-center' role='alert'><b>Invalid Login Credentials.</b></div>";
					}
					if($fail === 2){
						echo "<div class='alert alert-danger text-center' role='alert'><b>This User's access has been revoked.</b></div>";
					}
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-5"><!--Forgot Password-->
					<p class="text-center small" ><a class="text-success" href="forgot_password.php">Forgot Password?</a></p>
				</div>
				<div class="col-sm-7"><!--Sign Up-->
					<p class="text-center small">Need an account? <a class="text-success" href="signup.php">Sign up here</a>.</p>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
</body>
</html>