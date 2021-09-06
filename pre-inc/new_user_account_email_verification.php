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
  <title>E - Manifest: Verify Email Address</title>
</head>
<body>
<div class="container-fluid">
	<div class="container-bg">
		<div class="fcta-header">
		<img src="images/cac-logo.png" class="cac-logo">
		<img src="images/coat-of-arms.png" class="coat-of-arm">
	</div>
		<div class="toptop" style="margin-top: 20px">
			<div class="row top-buffer">
				
				
				<fieldset class="scheduler-border" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
						<legend class="scheduler-border" ><i class="fa fa-check-square" style="color: #8FBC8F"></i>	Email Address Verified</legend>
						<!-- Here, the form object are displayed -->
							<?php
$user = "";
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
	$sql = "SELECT * FROM tbl_Schedule_officers WHERE CONVERT(VARCHAR, New_Account_Refcode) <> '$r_code'";
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
			echo '<center><br /><br/><br /><br /><div style="width:50%" class="alert alert-danger text-center" role="alert"><b>The Email reset link has expired or it does not exist.</b></div><br/><br /><br /></center>';
			echo '<div class="row align-middle">
					<div class="col-sm-12"><!--Forgot Password-->
						<p class="text-center small" ><a class="text-success" href="index.php">Back to Login Page</a></p>
					</div>
				</div>';
		}
		else //We erase the recovery code from the database
		{
			$row = sqlsrv_fetch_array($result);
			$user = $row['Login_ID'];
			$sql_ = "UPDATE tbl_Schedule_officers SET New_Account_Refcode = NULL, Email_Verified = 1 WHERE CONVERT(VARCHAR, New_Account_Refcode) <> '$r_code'";
			$result_ = sqlsrv_query($conn, $sql_);
			if($result_ ===false ) {
				die(print_r("UPDATE::".sqlsrv_errors(), true));
			}
			else
			{
?>
				<br /><br /><br /><br />
				<div class="alert alert-success text-center" role="alert">The Email address <b>
				<?php echo $row['Email']; ?></b> has been verified successfully. Your password creation link will be forwarded in due course after your account gets approved by an admin.</div><br /><br /><br /><br />
   <?php
				
			}
		}
	}
	sqlsrv_close($conn);
}
?>
				</fieldset>
			</div><!--End of Row Top Buffer-->
		</div>
    </div> <!--End of Row container-bg-->
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
		
	function verify_email() {
		$("#outcome").html('');
		var new_ = $('#new_password').val();
		var confirm_ = $('#confirm_password').val();
		var user = $('#user_id').val();
		var hash = $('#hash').val();

		var dat = "new="+new_+"&confirm="+confirm_+"&user="+user+"&hash="+hash;
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