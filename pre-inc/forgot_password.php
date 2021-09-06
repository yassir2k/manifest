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
  <title>E - Manifest: Forgot Password</title>
</head>

<body>
<div class="container-fluid">
	<div class="container-bg">
		<div class="fcta-header">
			<img src="images/cac-logo.png" class = "img-responsive" height="100%" />
			<img src="images/coat-of-arms.png" align="right" class = "img-responsive" height="100%" />
		</div>
		<div class="toptop" style="margin-top: 20px">
			<div class="row top-buffer">
				
				
				<fieldset class="scheduler-border" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
						<legend class="scheduler-border" >Forgot Password Form</legend>

						<!-- Here, the form object are displayed -->
						<form action="javascript:recoverPassword();" method="post">
						<br />
						<br />
							<div class="row "><!--Sender's Email:-->
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
											<input type="text" class="form-control" placeholder="User ID" id="user_id" name="user_id" required >
										</div>
									</div>
								
								</div>
							</div><!--End Sender's Email:-->
							
							<div class="row "><!--Email Subject-->
								<div class="col-sm-3 align-middle text-success" align="right">
								<strong>*Email:</strong>
								</div>
								<div class="col-sm-6 ">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fa fa-envelope" style="color: #8FBC8F"></i>
												</span>                    
											</div>
											<input type="email" class="form-control" placeholder="Email Address" id="email" name="email" required >
										</div>
									</div>
								</div><!--End Email Subject-->
							</div>
							
							<div class="row "><!-- Submit-->
								<div class="col-sm-3 align-middle " align="right">
								</div>
								<div class="col-sm-6 ">
									<div class="form-group">
										<div class="input-group">
											<button type="submit" class="btn shadow btn-success btn-block rounded-0" id="btn_submit" name="btn_submit">
												<span>Send Password Reset Link</span>
												<i class="fa fa-external-link" style="horizontal-align: right;" ></i>
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
									<p class="text-center small" ><a class="text-success" href="index.php">Back to Login Page</a></p>
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
		
	function recoverPassword() {
		$("#outcome").html('');
		var user_id = $('#user_id').val();
		var email = $('#email').val();

		var dat = "user_id="+user_id+"&email="+email;
		$("#spinner").show();
		$.ajax({  
				url:"send_password_reset_link.php",  
				method:"POST",  
				data:dat,  
				success:function(data)  
					{  
						 if(data.includes("Password reset link successfully sent to your email."))
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