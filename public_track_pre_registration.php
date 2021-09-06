<?php
ini_set('display_errors', 'on');
include ('dbconnection.php');
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

  <title>CAC Registration Tracker - Pre Incorporation</title>
</head>

<body>

<div class="container-fluid" aria-hidden="true">
<div class="container-bg">
  <div class="fcta-header">
		<img src="images/cac-logo.png" class="cac-logo">
		<img src="images/coat-of-arms.png" class="coat-of-arm">
	</div>
   <!-- ------------------------------------Beginning of Navigation---------------------------------------- -->
   <nav class="navbar  bg-success" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:10px"></nav>
   <!-- ---------------------------------------End of Navigation------------------------------------------- -->
   
	<div class="row top-buffer">
		<fieldset class="scheduler-border" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
			<legend class="scheduler-border" >Track Your Pre-Incorporation Registration</legend>
			<br />
			<center style="color: red">Labels with prefixed asterisk (*) denote mandatory fields.</center>
			<br />
			<form action="javascript:SaveEntry();" method="post">
				
					<div class="row"><!--Receiving Department-->
						<div class="col-sm-3  text-success" align="right">
							<strong>*Company Type</strong>
						</div>
						<div class="col-sm-6 ">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">
												<i class="fa fa-building-o" style="color: #8FBC8F"></i>
										</span>                    
									</div>
									<select id="department" name="department" data-show-content="true" class="form-control border" required>
										<option value="">Select User Dept/Unit...</option>
										<option value="Business Names">Business Names</option>
										<option value="Company">Company</option>
										<option value="Incorporated Trustees">Incorporated Trustees</option>
									</select>
								</div>
							</div>
						</div>
					</div><!--End Receiving Department-->
					
					<div class="row "><!--Company Details-->
						<div class="col-sm-3 align-middle text-success" align="right">
							<strong>*RC/IT/BN Number:</strong>
						</div>
						<div class="col-sm-6 ">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="fa fa-university" style="color: #8FBC8F"></i>
										</span>                    
									</div>
								<input type="number" class="form-control" placeholder="Enter RC, IT, or BN Number" id="rc_number" name="rc_number" required>
								</div>
							</div>
						</div>
					</div><!--End Company Details-->
					
					<div class="row "><!-- Submit-->
						<div class="col-sm-3 align-middle " align="right">
						</div>
						<div class="col-sm-6 ">
							<div class="form-group">
								<div class="input-group">
									<button type="submit" class="btn shadow-sm btn-success btn-block rounded-0" name="btn_submit">
										<span>Search</span>
										<i class="fa fa-search" style="horizontal-align: right;" ></i>
									</button> 
								</div>
							</div>
						</div>
					</div><!--End Submit-->
							
							
					<div class="row "><!-- Spinner and Outcome Display -->
						<div class="col-sm-12" align="center">
						<!-- This here spins when the submit button is hit-->
							<div id="spinner">
								<i class="fa fa-spinner fa-spin fa-4x fa-fw" style="color: #8FBC8F"></i>
							</div>
							<div class="outer" id="outcome" style="height:auto"><!-- Shows success or error messages here. -->
							</div>
						</div>
					</div><!-- End of Spinner and Outcome Display -->
				</form>
		</fieldset>
	</div>
       
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
	<script>
		$(document).ready(function(){
		  $("#spinner").hide();
		});
		
		function SaveEntry() {
		$("#outcome").html('');
		var dept = $('#department').val();
		var rc = $('#rc_number').val();
		var url_ = "";
		var dat = "rc-number=" + rc;
		if(dept == "Business Names")
		{
			url_ = "public_find_bn_pre_inc.php";
			dat = "bn-number=" + rc;
		}
		if(dept == "Company")
		{
			url_ = "public_find_comp_pre_inc.php";
		}
		if(dept == "Incorporated Trustees")
		{
			url_ = "public_find_it_pre_inc.php";
		}
		$("#spinner").show();
		$.ajax({  
				url:	url_,  
				method:"POST",  
				data:dat,
				success:function(data)  
					{  
							 $("#spinner").hide();
							 $("#outcome").html(data);
					} 
				});
	}
	</script>
</html>