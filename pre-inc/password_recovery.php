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
  <title>E - Manifest: Password Recovery</title>
</head>
<?php
$user = "";
$scode = "";
if(	!(isset($_REQUEST['hash'])))
	{
		echo '<center><br /><br/><br /><br /><br /><br/><br /><br /><div style="width:50%" class="alert alert-danger text-center" role="alert"><b>Access Denied !!!</b></div></center>';
		echo '<div class="row align-middle">
								<div class="col-sm-12"><!--Forgot Password-->
									<p class="text-center small" ><a class="text-success" href="index.php">Back to Login Page</a></p>
								</div>
							</div>';
		return 0;
	}
else
{
	include ('../dbconnection.php');
	$hash = $_REQUEST['hash'];
	$r_code = str_replace ("'","''", $_REQUEST['hash']);
	$sql = "SELECT * FROM tbl_Schedule_officers WHERE CONVERT(VARCHAR, Password_Recovery_Code) <> '$r_code'";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$result = sqlsrv_query($conn, $sql,  $params, $options );
	if($result ===false ) {
		die(print_r("SELECT::".sqlsrv_errors(), true));
	}
	else{
		$row_count = sqlsrv_num_rows( $result );  
		if ($row_count == 0)
		{
			echo '<center><br /><br/><br /><br /><br /><br/><br /><br /><div style="width:50%" class="alert alert-danger text-center" role="alert"><b>The Password link has expired or does not exist.</b></div></center>';
			echo '<div class="row align-middle">
								<div class="col-sm-12"><!--Forgot Password-->
									<p class="text-center small" ><a class="text-success" href="index.php">Back to Login Page</a></p>
								</div>
							</div>';
			return 0;
		}
		else //We erase the recovery code from the database
		{
			$row = sqlsrv_fetch_array($result);
			$user = $row['Login_ID'];
			$scode = $row['State_Code'];
			$sql_ = "UPDATE tbl_Schedule_officers SET Password_Recovery_Code = NULL WHERE CONVERT(VARCHAR, Password_Recovery_Code) <> '$r_code'";
			$result_ = sqlsrv_query($conn, $sql_);
			if($result_ ===false ) {
				die(print_r("FAILED UPDATE::".sqlsrv_errors(), true));
			}
			sqlsrv_close($conn);
		}
	}
}
?>


<body>
<input type="hidden" id="hash" value="<?php echo $hash; ?>" />
<input type="hidden" id="sc" value= "<?php echo $scode; ?>" />
<div class="container-fluid">
	<div class="container-bg">
		<div class="fcta-header">
			<img src="images/cac-logo.png" class = "img-responsive" height="100%" />
			<img src="images/coat-of-arms.png" align="right" class = "img-responsive" height="100%" />
		</div>
		<div class="toptop" style="margin-top: 20px">
			<div class="row top-buffer">
				
				<fieldset class="scheduler-border" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
						<legend class="scheduler-border" >Reset Password Form</legend>

						<!-- Here, the form object are displayed -->
						<form action="javascript:resetPassword();" method="post">
						<br />
						<br />
						<div class="row "><!-- User ID-->
								
								<div class="col-sm-3 align-middle text-success" align="right">
								<strong>User ID:</strong>
								</div>
								<div class="col-sm-6 ">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<span class="fa fa-id-card-o" style="color: #8FBC8F"></span>
												</span>                    
											</div>
											<input type="text" class="form-control" placeholder="User ID" id="user_id" name="user_id" required disabled value="<?php echo $user; ?>">
										</div>
									</div>
								
								</div>
							</div><!--End User ID:-->
						
							<div class="row "><!-- New Password -->
								<div class="col-sm-3 align-middle text-success" align="right">
								<strong>New Password:</strong>
								</div>
								<div class="col-sm-6 ">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<span class="fa fa-lock" style="color: #8FBC8F"></span>
												</span>                    
											</div>
											<input type="password" class="form-control" placeholder="New Password" id="new_password" name="new_password" required >
										</div>
									</div>
								
								</div>
							</div><!--End New Password -->
							
							
							<div class="row "><!-- Confirm New Password -->
								
								<div class="col-sm-3 align-middle text-success" align="right">
								<strong>Confirm Password:</strong>
								</div>
								<div class="col-sm-6 ">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<span class="fa fa-lock" style="color: #8FBC8F"></span>
												</span>                    
											</div>
											<input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" name="confirm_password" required >
										</div>
									</div>
								
								</div>
							</div><!--End Confirm New Password -->
							
							<div class="row "><!-- Submit-->
								<div class="col-sm-3 align-middle " align="right">
								</div>
								<div class="col-sm-6 ">
									<div class="form-group">
										<div class="input-group">
											<button type="submit" class="btn shadow btn-success btn-block rounded-0" id="btn_submit" name="btn_submit">
												<span>Reset Password</span>
												<i class="fa fa-check-square" style="horizontal-align: right;" ></i>
											</button> 
										</div>
									</div>
								</div><!--End Submit-->
							</div>
							
							
							<!-- Spinner and Outcome Display -->
							<div class="row ">
								
								<div class="col-sm-3 align-middle" align="right">
								</div>
								<div class="col-sm-6" align="center">
								<!-- This here spins when the submit button is hit-->
									<div id="spinner">
										<i class="fa fa-spinner fa-spin fa-4x fa-fw" style="color: #8FBC8F"></i>
									</div>
									
									<div class="outer" id="outcome"><!-- Shows success or error messages here. -->

									</div>
								</div>
							</div>
							<div class="row align-middle">
								<div class="col-sm-3 align-middle" align="right">
								</div>
								<div class="col-sm-6"><!--Forgot Password-->
									<p class="text-center small" ><a class="text-success" href="../index.php">Back to Login Page</a></p>
								</div>
							</div>
							</form>
						</fieldset>
			</div><!--End of Row Top Buffer-->
		</div>
    </div> <!--End of Row container-bg-->
    <!-- -----------------------------------------End of Main Content------------------------------------------ -->
   <!------------------------------------------------------Footer----------------------------------------- -->
	<!-- Footer -->
	<footer class="page-footer font-small" style="background-color:#666; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">

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
  <script src="js/bootstrap4-toggle.min.js"></script>
  <script src="js/mindmup-editabletable.js"></script>
  <script src="js/bootstrap-input-spinner.js"></script>
<script>
$(document).ready(function(){
  $("#spinner").hide();
  
});
		
	function resetPassword() {
		$("#outcome").html('');
		var new_ = $('#new_password').val();
		var confirm_ = $('#confirm_password').val();
		var user = $('#user_id').val();
		var hash = $('#hash').val();
		var scode = $('#sc').val();
		var dat = "new="+new_+"&confirm="+confirm_+"&user="+user+"&hash="+hash+"&scode="+scode;
		$("#spinner").show();
		$.ajax({  
				url:"save_new_password.php",  
				method:"POST",  
				data:dat,  
				success:function(data)  
					{  
						 if(data.includes("Password Successfully Reset."))
						 {
							 $("#spinner").hide();
							 $("#outcome").show();
							 $("#outcome").html('<div class="alert alert-success text-center" role="alert"><b>'+data+'</b></div>');
							 $("#outcome").delay(4000).hide(500);
						 }
						else{
							$("#spinner").hide();
							$("#outcome").html('<div class="alert alert-danger text-center" role="alert"><b>'+data+'</b></div>');
						}
					} 
				});
	}

</script>
</html>