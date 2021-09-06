<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="images/cac_icon.ico"/>
<head>
<noscript>
  <meta http-equiv="refresh" content="0; URL=error.php">
</noscript>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/manifest-css.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap-toggle.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <title>E - Manifest: Sign Up</title>
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
						<legend class="scheduler-border" ><i class="fa fa-user-plus" style="color: #8FBC8F"></i>	New User Account Request Form</legend>

						<!-- Here, the form object are displayed -->
						<form action="javascript:signUp();" method="post">
						<br />
						<br />
							<div class="row "><!--User ID:-->
								<div class="col-sm-3 align-middle text-success" align="right">
								<strong>User ID:</strong>
								</div>
								<div class="col-sm-5 ">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<span class="fa fa-id-badge" style="color: #8FBC8F"></span>
												</span>                    
											</div>
											<input type="text" onBlur="checkUsername()" class="form-control" placeholder="User ID" id="user_id" name="user_id" required >
										</div>
									</div>
								
								</div>
								<div class="col-sm-4 my-auto">
									<span id="user-availability-status"></span> 
								</div>
							</div><!--End of User ID:-->
							
							<div class="row "><!--First Name:-->
								<div class="col-sm-3 align-middle text-success" align="right">
								<strong>First Name:</strong>
								</div>
								<div class="col-sm-5 ">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<span class="fa fa-user-circle-o" style="color: #8FBC8F"></span>
												</span>                    
											</div>
											<input type="text" class="form-control" placeholder="First Name" id="name" name="name" required >
										</div>
									</div>
								
								</div>
							</div><!--End of First Name:-->
							
							<div class="row "><!--Surname:-->
								<div class="col-sm-3 align-middle text-success" align="right">
								<strong>Surname:</strong>
								</div>
								<div class="col-sm-5 ">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<span class="fa fa-user-circle" style="color: #8FBC8F"></span>
												</span>                    
											</div>
											<input type="text" class="form-control" placeholder="Surname" id="surname" name="surname" required >
										</div>
									</div>
								
								</div>
							</div><!--End of Surname:-->
							
							<div class="row "><!--Email -->
								<div class="col-sm-3 align-middle text-success" align="right">
								<strong>*Email:</strong>
								</div>
								<div class="col-sm-5 ">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fa fa-envelope" style="color: #8FBC8F"></i>
												</span>                    
											</div>
											<input type="email" onBlur="checkEmail()" class="form-control" placeholder="Email Address" id="email" name="email" required >
										</div>
									</div>
								</div>
								<div class="col-sm-4 my-auto">
									<span id="email-availability-status"></span> 
								</div>
							</div><!--End Email -->
							
							<div class="row"><!--Department-->
								<div class="col-sm-3  text-success" align="right">
									<strong>*Department</strong>
								</div>
								<div class="col-sm-5 ">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
														<i class="fa fa-building" style="color: #8FBC8F"></i>
												</span>                    
											</div>
											<select id="department" name="department" data-show-content="true" class="form-control border" required>
												<option value="">Select User Dept/Unit...</option>
												<option value="RGs Office">Registrar General's Office</option>
												<option value="Registry">Registry</option>
												<option value="Business Names">Business Names</option>
												<option value="Trustees">Incorporated Trustees</option>
												<option value="Mail Room">Mail Room</option>
												<option value="Compliance">Compliance</option>
												<option value="Customer Service">Customer Service</option>
											</select>
										</div>
									</div>
								</div>
							</div><!--End of Department-->
							
							<div class="row"><!--Role-->
								<div class="col-sm-3  text-success" align="right">
									<strong>*Role</strong>
								</div>
								<div class="col-sm-5 ">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
														<i class="fa fa-building-o" style="color: #8FBC8F"></i>
												</span>                    
											</div>
											<select id="role" name="role" data-show-content="true" class="form-control border" required>
												<option value="">Select User Role...</option>
												<option value="Pre Incorporation">Pre Incorporation</option>
												<option value="Post Incorporation">Post Incorporation</option>
												<option value="HOD">Head of Department</option>
											</select>
										</div>
									</div>
								</div>
							</div><!--End Role-->
							
							<div class="row"><!--State-->
								<div class="col-sm-3 align-middle text-success" align="right">
								<strong>*State Office:</strong>
								</div>
								<div class="col-sm-5 ">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fa fa-globe" style="color: #8FBC8F"></i>
												</span>                    
											</div>
											<select id="state" name="state" data-show-content="true" class="form-control border" required>
												<option value="">Select Office Location</option>
												<?php
												include ('dbconnection.php');
												$query1 = "SELECT * FROM tbl_States ORDER BY State_Name";
												$result1 = sqlsrv_query($conn, $query1);
												if($result1 === false) {
														die(print_r(sqlsrv_errors(), true));
													}
												else
												{
													if (sqlsrv_has_rows( $result1 ))
													{
														while($row1 = sqlsrv_fetch_array($result1))
														{ ?>
												<option value="<?php echo $row1['State_Code']; ?>"><?php echo $row1['State_Name']; ?></option>
														<?php
														}
												}}
												sqlsrv_close($conn);
														?>
											</select>
										</div>
									</div>
								</div><!--End State-->
							</div>
							
							<div class="row "><!-- Submit-->
								<div class="col-sm-3 align-middle " align="right">
								</div>
								<div class="col-sm-5 ">
									<div class="form-group">
										<div class="input-group">
											<button type="submit" class="btn shadow btn-success btn-block rounded-0" id="btn_submit" name="btn_submit" disabled="disabled">
												<span>Submit Account Request</span>
												<i class="fa fa-share-square-o" style="horizontal-align: right;" ></i>
											</button> 
										</div>
									</div>
								</div><!--End Submit-->
							</div>
							
							
							<!-- Spinner and Outcome Display -->
							<div class="row ">
								<div class="col-sm-11" align="center">
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
								<div class="col-sm-5"><!--Forgot Password-->
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
	var button_flag = 0;
	//Checks Username availability
	function checkUsername() {
		var dat = 'username=' + $('#user_id').val();
		$("#user-availability-status").html('<i class="fa fa-spinner fa-spin fa-fw" style="color: #8FBC8F"></i>');
		$.ajax({
		url: "check_username_availability.php",
		method: "POST",
		data: dat,
		success:function(data){
				if(data.includes("Username Available"))
				{
					$("#user-availability-status").html('<label style="font-size: 12px; font-weight: bold; color: #090">'+data+'</label>');
					//This is for controling submit button, to be enabled or otherwise
					if(button_flag < 2)button_flag ++;
					if(button_flag == 2) $('#btn_submit').prop('disabled',false);
				}
				else
				{
					$("#user-availability-status").html('<label style="font-size: 12px; font-weight: bold; color: red">'+data+'</label>');
					if(button_flag != 0)	button_flag --;
					$('#btn_submit').prop('disabled',true);
				}
			}
		});
	}
	
	//Checks Email availability
	function checkEmail() {
		var dat = 'email=' + $('#email').val();
		$("#email-availability-status").html('<i class="fa fa-spinner fa-spin fa-fw" style="color: #8FBC8F"></i>');
		$.ajax({
		url: "check_email_availability.php",
		method: "POST",
		data: dat,
		success:function(data){
				if(data.includes("This email is available for use"))
				{
					$("#email-availability-status").html('<label style="font-size: 12px; font-weight: bold; color: #090">'+data+'</label>');
					//This is for controling submit button, to be enabled or otherwise
					if(button_flag < 2)	button_flag ++;
					if(button_flag == 2) $('#btn_submit').prop('disabled',false);
				}
				else
				{
					$("#email-availability-status").html('<label style="font-size: 12px; font-weight: bold; color: red">'+data+'</label>');
					if(button_flag != 0)button_flag --;
					$('#btn_submit').prop('disabled',true);
				}
			}
		});
	}
		
	function signUp() {
		$("#outcome").html('');
		var user_id = $('#user_id').val();
		var name = $('#name').val();
		var surname = $('#surname').val();
		var email = $('#email').val();
		var department = $('#department').val();
		var role = $('#role').val();
		var state = $('#state').val();

		var dat = "user_id="+user_id+"&name="+name+"&surname="+surname+"&email="+email+"&department="+department+"&role="+role;
		dat+= "&state="+state;
		$("#spinner").show();
		$.ajax({  
				url:"send_new_acc_req_to_admin.php",  
				method:"POST",  
				data:dat,  
				success:function(data)  
					{  
						 if(data.includes("A verification link has been sent to the email address you provided."))
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