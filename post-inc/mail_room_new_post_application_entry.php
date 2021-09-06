<?php
//This script will be used in obtaining index value for batches from the Database
session_start();
//Check if user session does not exist or the user does not belong to the relevant dept, and role.
if ($_SESSION['user'] == null 
|| ( ($_SESSION['dept'] != "Mail Room") || ($_SESSION['role'] != "Post Incorporation") ))
{
	header("Location: ../index.php");
}
date_default_timezone_set("Africa/Lagos");
$index = 0;
include ('../dbconnection.php');
$sql = "SELECT TOP 1 Batch_Number FROM tbl_Batches_History WHERE Pre_or_Post = 'Post' AND Department_Unit = 'Mail Room' ";
$sql.=" AND (convert(varchar,Date_Generated, 23) = convert(varchar, getdate(), 23))";
$sql.=" AND (State_Code = '".$_SESSION['state_code']."') ORDER BY Batch_Number DESC";
$result = sqlsrv_query($conn, $sql);
if($result === false) {
		die(print_r(sqlsrv_errors(), true));
	}
else
{
    if (sqlsrv_has_rows( $result ))
	{
		$row = sqlsrv_fetch_array($result);
		$index = $row[0] + 1;
	}
	else
	{
		$index = 1;
	}
}
sqlsrv_close($conn);
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
  <link rel="stylesheet" href="css/bootstrap4-toggle.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="js/bootstrap4-toggle.min.js"></script>
  <script>
	$(document).ready(function(){
		// Activate tooltip
		$('[data-toggle="tooltip"]').tooltip();
	});
  </script>
  <title>E - Manifest: New Post Incorporation Application</title>
</head>
<body>
<input type="hidden" id="indexer" value="<?php echo $index; ?>" />
<div class="container-fluid">
	<div class="container-bg">
		<div class="fcta-header">
			<img src="images/cac-logo.png" class="cac-logo">
			<img src="images/coat-of-arms.png" class="coat-of-arm">
		</div>
		<!-- ------------------------------------ Beginning of Navigation-------------------------------------- -->
		<?php require("menus/pmenu_mail_room_new_post_entry.php");?>
		<!-- ---------------------------------------End of Navigation------------------------------------------- -->
		<ol class="breadcrumb" style="border-bottom: 1px ridge #ffffff; background-color: #F5F5F5; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
				<li class="breadcrumb-item"><a class="text-success" href="post_mail_room_dashboard.php">Dashboard</a></li>
				<li class="breadcrumb-item active text-secondary">Prepare New Manifest</li>
		</ol>
  
		<div class="toptop" style="margin-top: 20px">
			<div class="row top-buffer">
				
				
				<fieldset class="scheduler-border" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
						<legend class="scheduler-border" ><i class="fa fa-pencil-square-o" style="color: #8FBC8F"></i>	New Post Application Entry</legend>
						<br />
						<br />
							<form action="javascript:addEntry();" method="post">
								<!---------------------------------------- Beginning of 1st Row ----------------------------------------->
								<div class="row">
									<div class="col-4">
										<div class = "row">
											<div class="col-12 align-right text-success">
												<strong>RC Number:</strong>
											</div>
										</div>
										<div class = "row">
											<div class="col-12 align-left">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<span class="fa fa-id-badge" style="color: #8FBC8F"></span>
															</span>                    
														</div>
														<input type="text" class="form-control" placeholder="RC Number" id="rc" name="rc" required >
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-4">
										<div class = "row">
											<div class="col-12 align-left text-success">
												<strong>Company Type:</strong>
											</div>
										</div>
										<div class = "row">
											<div class="col-12 align-left">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																	<i class="fa fa-building" style="color: #8FBC8F"></i>
															</span>                    
														</div>
														<select id="comptype" name="comptype" data-show-content="true" class="form-control border" required>
															<option value="">Select Company Type</option>
															<option value="Limited Liability Company">Limited Liability Company</option>
															<option value="Business Names">Business Names</option>
															<option value="Incorporated Trustees">Incorporated Trustees</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									

									<div class="col-4">
										<div class = "row">
											<div class="col-12 align-left text-success">
												<strong>Company Name:</strong>
											</div>
										</div>
										<div class = "row">
											<div class="col-12 align-left">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<span class="fa fa-id-badge" style="color: #8FBC8F"></span>
															</span>                    
														</div>
														<input type="text" class="form-control" placeholder="Company Name" id="compname" name="compname" required >
													</div>
												</div>
											</div>
										</div>
									</div>
									
								</div>
								<!------------------------------------------- End of 1st Row -------------------------------------------->
								<br />					
								<!---------------------------------------- Beginning of 2nd Row ----------------------------------------->
								<div class="row">
									<div class="col-4">
										<div class = "row">
											<div class="col-12 align-right text-success">
												<strong>Date Received:</strong>
											</div>
										</div>
										<div class = "row">
											<div class="col-12 align-left">
												<div class="form-group">
													<div class="input-group date" data-provide="datepicker">
														<div class="input-group-prepend">
																<span class="input-group-text">
																	<span class="fa fa-calendar" style="color: #8FBC8F"></span>
																</span>                    
															</div>
															<input id="date_recv" name="date_recv" type="date" class="form-control" required>
														</div>
													</div>
											</div>
										</div>
									</div>
									
									<div class="col-4">
										<div class = "row">
											<div class="col-12 align-left text-success">
												<strong>Courier (Incoming):</strong>
											</div>
										</div>
										<div class = "row">
											<div class="col-12 align-left">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																	<i class="fa fa-building" style="color: #8FBC8F"></i>
															</span>                    
														</div>
														<select id="c_incoming" name="c_incoming" data-show-content="true" class="form-control border" required>
															<option value="">Select Courier (Incoming)</option>
															<?php
																include ('../dbconnection.php');
																$query1 = "SELECT Initials, Courier_Company_Name FROM tbl_Courier_Companies ORDER BY Initials";
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
																<option value="<?php echo $row1['Initials']; ?>"><?php echo $row1['Courier_Company_Name']; ?></option>
																		<?php
																		}
																}}
																sqlsrv_close($conn);
															?>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									

									<div class="col-4">
										<div class = "row">
											<div class="col-12 align-left text-success">
												<strong>Courier (Outgoing):</strong>
											</div>
										</div>
										<div class = "row">
											<div class="col-12 align-left">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																	<i class="fa fa-building" style="color: #8FBC8F"></i>
															</span>                    
														</div>
														<select id="c_outgoing" name="c_outgoing" data-show-content="true" class="form-control border" required>
															<option value="">Select Courier (Outgoing)</option>
															<?php
																include ('../dbconnection.php');
																$query1 = "SELECT Initials, Courier_Company_Name FROM tbl_Courier_Companies ORDER BY Initials";
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
																<option value="<?php echo $row1['Initials']; ?>"><?php echo $row1['Courier_Company_Name']; ?></option>
																		<?php
																		}
																}}
																sqlsrv_close($conn);
															?>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									
								</div>
								<!------------------------------------------- End of 2nd Row -------------------------------------------->
								<br />
								<!---------------------------------------- Beginning of 3rd Row ----------------------------------------->
								<div class="row">
									<div class="col-4">
										<div class = "row">
											<div class="col-12 align-right text-success">
												<strong>Presenter's Name:</strong>
											</div>
										</div>
										<div class = "row">
											<div class="col-12 align-left">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<span class="fa fa-id-badge" style="color: #8FBC8F"></span>
															</span>                    
														</div>
														<input type="text"  class="form-control" placeholder="Presenter's Name" id="p_name" name="p_name" required >
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-4">
										<div class = "row">
											<div class="col-12 align-left text-success">
												<strong>Presenter's Email:</strong>
											</div>
										</div>
										<div class = "row">
											<div class="col-12 align-left">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<span class="fa fa-id-badge" style="color: #8FBC8F"></span>
															</span>                    
														</div>
														<input type="text"  class="form-control" placeholder="Presenter's Email" id="p_email" name="p_email" required >
													</div>
												</div>
											</div>
										</div>
									</div>
									

									<div class="col-4">
										<div class = "row">
											<div class="col-12 align-left text-success">
												<strong>Presenter's Mobile No.:</strong>
											</div>
										</div>
										<div class = "row">
											<div class="col-12 align-left">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<span class="fa fa-id-badge" style="color: #8FBC8F"></span>
															</span>                    
														</div>
														<input type="text" class="form-control" placeholder="Presenter's Phone No." id="p_phone" name="p_phone" required >
													</div>
												</div>
											</div>
										</div>
									</div>
									
								</div>
								<!------------------------------------------- End of 3rd Row -------------------------------------------->
								<br />
								<!----------------------------------------------- 3rd Row 2---------------------------------------------->
								<div class="row">
									<div class="col-10 align-left text-success" valign="bottom" >
										<strong style="font-size:20px">RRR Receipts</strong>
									</div>
									<div class="col-2 align-right">
										<div class="row">
											<div class="col-12" align="right">
												<button type="button"  id="addSingleRow" class="btn bg-success text-white" data-toggle='tooltip' title="Add New RRR Receipt Row" ><i class="fa fa-plus-circle"></i>	Add</button>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-12" align="center" >
										<hr class="separator" >
									</div>
								</div>
								
								<div class="rrrAmount">
								
									<div class="row">
										<div class="col-2">
											<div class = "row">
												<div class="col-12 text-success">
												&nbsp;
												</div>
											</div>
											<div class = "row">
												<div class="col-12 align-bottom my-auto">
													1.
												</div>
											</div>
										</div>
										
										<div class="col-4 align-left text-success">
											<div class = "row">
												<div class="col-12 align-right text-success">
													<strong>RRR Number:</strong>
												</div>
											</div>
											<div class = "row">
												<div class="col-12 align-left">
													<div class="form-group">
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<span class="fa fa-id-badge" style="color: #8FBC8F"></span>
																</span>                    
															</div>
															<input type="number" class="form-control" placeholder="RRR Number" onBlur="checkRRR(this)" id="rrr1" name="Q"  required >
														</div>
													</div>
												</div>
											</div>
											<div class = "row">
												<div id="rrr_hint_1">
													
												</div>
											</div>
										</div>
										
										<div class="col-4 align-left text-success">
											<div class = "row">
												<div class="col-12 align-right text-success">
													<strong>Amount:</strong>
												</div>
											</div>
											<div class = "row">
												<div class="col-12 align-left">
													<div class="form-group">
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<span class="fa fa-money" style="color: #8FBC8F"></span>
																</span>                    
															</div>
															<input type="number" class="form-control" placeholder="Amount" id="amount1" name="amount1" required >
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-2">
											<div class = "row">
												<div class="col-12 text-success">
												&nbsp;
												</div>
											</div>
											<div class = "row">
												<div class="col-12" align="right">
													&nbsp;	
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12" align="center" >
										<hr class="separator" >
									</div>
								</div>
								<!------------------------------------------- End of 3rd Row 2 ------------------------------------------>
								<!---------------------------------------- Beginning of 4th Row ----------------------------------------->
								<div class="row">							
									<div class="col-6">
										<div class = "row">
											<div class="col-12 align-left text-success">
												<strong>Number of Copies (if any):</strong>
											</div>
										</div>
										<div class = "row">
											<div class="col-12 align-left">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																	<i class="fa fa-building" style="color: #8FBC8F"></i>
															</span>                    
														</div>
														<select id="copies" name="copies" data-show-content="true" class="form-control border" required>
															<option value="">Select Number of Copies</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									

									<div class="col-6">
										<div class = "row">
											<div class="col-12 align-left text-success">
												<strong>Destinating Department:</strong>
											</div>
										</div>
										<div class = "row">
											<div class="col-12 align-left">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<span class="fa fa-id-badge" style="color: #8FBC8F"></span>
															</span>                    
														</div>
														<select id="dest_dept" name="dest_dept" data-show-content="true" class="form-control border" required>
															<option value="">Destinating Department</option>
															<option value="Business Names">Business Names</option>
															<option value="Compliance">Compliance</option>
															<option value="Customer Service">Customer Service</option>
															<option value="Incorporated Trustees">Incorporated Trustees</option>
															<option value="RGs Office">Registrar General's Office</option>
															<option value="Registry">Registry</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									
								</div>
								<!------------------------------------------- End of 4th Row -------------------------------------------->
								<br />
								<!-------------------------------------------Beginning of 5th Row ---------------------------------------->
								<div id="row">
									<div class="col-12 align-left">
										<div class = "row">
											<div class="col-12 align-left text-success">
												<strong>Additional Details:</strong>
											</div>
										</div>
										<div class = "row">
											<div class="col-12 align-left">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<i class="fa fa-pencil" style="color: #8FBC8F; margin-top: -50px"></i>
															</span>                    
														</div>
														<textarea  class="form-control _textarea" id="details" name="details" 
														 maxlength="1500" placeholder="Type in details (if any)..." rows="3"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-------------------------------------------End of 5th Row ---------------------------------------->
								<br />
								<fieldset class="scheduler-border">      
									<legend class="scheduler-border">Nature of Application</legend>
									<br />
									
									<div id = "forLLC" style="pointer-events: none;" hidden><!-- For LLC -->
									<!-- Credit to https://bootsnipp.com/snippets/nN5ZZ -->
										<div class="chiller_cb form-check-inline">
											<input id="annualreturns" type="checkbox" name="nature" value="Annual Returns">
											<label for="annualreturns">Annual Returns</label>
											<span></span>
										</div>
										<div class="chiller_cb form-check-inline">
											<input id="appoint_sec" type="checkbox" name="nature" value="Appointment/Change of Company Secretary">
											<label for="appoint_sec">Appointment/Change of Company Secretary</label>
											<span></span>
										</div>
										<div class="chiller_cb form-check-inline">
											<input id="changeAddr" type="checkbox" name="nature" value="Change of Address">
											<label for="changeAddr">Change of Address</label>
											<span></span>
										</div>
										<div class="chiller_cb form-check-inline">
											<input id="debenture" type="checkbox" name="nature" value="Debenture">
											<label for="debenture">Debenture</label>
											<span></span>
										</div>
										<div class="chiller_cb form-check-inline">
											<input id="filingctc" type="checkbox" name="nature" value="Filing and CTC">
											<label for="filingctc">Filing and CTC</label>
											<span></span>
										</div>
										<div class="chiller_cb form-check-inline">
											<input id="increase" type="checkbox" name="nature" value="Increase">
											<label for="increase">Increase</label>
											<span></span>
										</div>
										<div class="chiller_cb form-check-inline">
											<input id="miscellaneous" type="checkbox" name="nature" value="Miscellaneous">
											<label for="miscellaneous">Miscellaneous</label>
											<span></span>
										</div>
										<div class="chiller_cb form-check-inline">
											<input id="mortgage" type="checkbox" name="nature" value="Mortgage">
											<label for="mortgage">Mortgage</label>
											<span></span>
										</div>
									</div> <!-- End of for LLC -->
									
									<div id="forIT" style="pointer-events: none;" hidden><!-- For IT -->
										<div class="chiller_cb form-check-inline">
											<input id="changeTrusteeName" type="checkbox" name="nature" value="Change of Incorporated Trustees Name">
											<label for="changeTrusteeName">Change of Incorporated Trustees Name</label>
											<span></span>
										</div>
										<div class="chiller_cb form-check-inline">
											<input id="chngTrustees" type="checkbox" name="nature" value="Change of Trustees">
											<label for="chngTrustees">Change of Trustees</label>
											<span></span>
										</div>
										<div class="chiller_cb form-check-inline">
											<input id="annualReturnsIT" type="checkbox" name="nature" value="Annual Returns">
											<label for="annualReturnsIT">Annual Returns</label>
											<span></span>
										</div>
									</div> <!-- End of for IT -->
									
									<div id="forBN" style="pointer-events: none;" hidden><!-- For BN -->
									<!-- Credit to https://bootsnipp.com/snippets/nN5ZZ -->
										<div class="chiller_cb form-check-inline">
											<input id="changeBN" type="checkbox" name="nature" value="Notice of Change in Business Names">
											<label for="changeBN">Notice of Change in Business Names</label>
											<span></span>
										</div>
										<div class="chiller_cb form-check-inline">
											<input id="cessationBN" type="checkbox" name="nature" value="Notice of Cessation of Business">
											<label for="cessationBN">Notice of Cessation of Business</label>
											<span></span>
										</div>
										<div class="chiller_cb form-check-inline">
											<input id="annualReturnsBN" type="checkbox" name="nature" value="Annual Returns">
											<label for="annualReturnsBN">Annual Returns</label>
											<span></span>
										</div>
									</div> <!-- End of for BN -->
								</fieldset>	
								<!---------------------------------------- Beginning of 4th Row ----------------------------------------->
								<div class="row">
									<div class="col-4">
									</div>
									
									<div class="col-4">
										<div class="form-group">
											<div class="input-group">
												<button type="submit" class="btn shadow btn-success btn-block rounded-0" id="btn_submit">
													<span>Add to Batch Table</span>
													<i class="fa fa-plus-circle" style="horizontal-align: right;" ></i>
												</button> 
											</div>
										</div>
									</div>
									

									<div class="col-4">
									</div>
									
								</div>		
							</form>
						<!-- Here, the form object are displayed -->
				</fieldset>
				<!-- Now The Table that holds entries -->
				<fieldset class="scheduler-border" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
						<legend class="scheduler-border" ><i class="fa fa-table" style="color: #8FBC8F"></i>	Entries Made</legend>
						<br />
						<br />
						<table id="recs" cellpadding="2" cellspacing="2" class="minitable" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
						<thead>
							<tr>
								<th align = "left" width = "150">RC/IT/BN Number</th>
								<th align = "left" width = "300">Company Name</th>
								<th align = "left" width = "200">Nature of Business</th>
								<th align = "left" width = "150">RRR Number</th>
								<th align = "left" width = "150">Destinating Dept</th>
								<th align = "left" width = "150">Actions</th>
							</tr>
							<tr><td colspan='6' align='center' style='background-color: #FFFFFF'>No Entry made.</td></tr>
						</thead>
						<tbody>
						</tbody>
						</table>
						<br />
						<div class="row">
							<div class="col-4">
							</div>
							
							<div class="col-4">
								<div class="form-group">
									<div class="input-group">
										<button type="submit" class="btn shadow btn-info btn-block rounded-0" id="fwd_to_finance" disabled="disabled">
											<span>Forward to Finance & Account</span>
											<i class="fa fa-sign-in" style="horizontal-align: right;" ></i>
										</button> 
									</div>
								</div>
							</div>

							<div class="col-4">
							</div>
						</div>
				</fieldset>
			</div><!--End of Row Top Buffer-->
		</div>
    </div> <!--End of Row container-bg-->
	
	<!-- Forward to Registry Modal (Prompt) -->
	<div id="toFinanceModal" class="modal fade" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif"> 
		<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">						
						<h4 class="modal-title">Forward to Finance & Account</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body"> 		
						<p>Are you sure you want to forward these records to Finance & Account? </p>
						<p>Total records to be forwarded: <div id="bc"></div></p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
						<div id="loader"></div>
					</div>
					<div class="modal-footer">
						<input id="cancelFwd" type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel" >
						<button id="confirmFwd" class="btn btn-success" >
						<span>Yes, Forward to Finance & Account</span>
							<i class="fa fa-check" style="horizontal-align: right;" ></i>
						</button>
					</div>
			</div>
		</div>
        </div><!--End of Registry Modal-->
	
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
<script>
	var myRecords = [];
	var index = 0;
	var flag = 0;
	var btn_flag = []; //For activating and decativating green button when RRR duplicate has been detected.
	var rrr_counter = 1;
	var index_no = $("#indexer").val();
	class Records {
	  constructor(rc_, comp_, comptype_, nature_, date_recv_, c_incoming_, c_outgoing_, p_name_, p_email_, p_mobile_, rrr_, amount_, copies_, dest_, details_) 
	  {
		this.batch = "<?php echo $_SESSION['state_code'].'-MR-'.date('dmYHis').'-POST-B-'; ?>".concat(index_no);
		this.rc = rc_;
		this.comp = comp_;
		this.comptype = comptype_;
		this.nature = [...nature_];
		this.date_recv = date_recv_;
		this.c_incoming = c_incoming_;
		this.c_outgoing = c_outgoing_;
		this.p_name = p_name_;
		this.p_email = p_email_;
		this.p_mobile = p_mobile_;
		this.rrr = [...rrr_];
		this.amount = [...amount_];
		this.copies = copies_;
		this.dest = dest_;
		this.details = details_;
	  }
	}
	function removeFromArray(x)
	{
		var ty = "";
		//We find the index of the concerned RC using loop
		for( var i = 0; i < myRecords.length; i++)
		{
			if ( myRecords[i].rc == x)
			{ 
				//Remove it from the array
				if(myRecords[i].comptype == "Limited Liability Company")	ty = "LLC" + x.toString();
				if(myRecords[i].comptype == "Incorporated Trustees")	ty = "IT" + x.toString();
				if(myRecords[i].comptype == "Business Names")	ty = "BN" + x.toString();
				myRecords.splice(i, 1);
			}
		}
		//Remove the tr with class
		$('.'+ ty +'').remove();
		if(myRecords.length == 0)
		{
			var empty_row = "<tr><td colspan='6' align='center' style='background-color: #FFFFFF'>No Entry made.</td></tr>";
			$("table tbody").append(empty_row);
			$("#fwd_to_finance").attr('disabled',true);
		}
	}
	
	//This gets triggered when the button 'Add Batch to Table gets Clicked'
	function addEntry() {
		var cbx_group = $("input:checkbox[name='nature']");
		if(cbx_group.is(":checked"))
		{
			var rc = $("#rc").val();
			var comp = $("#compname").val();
			var ctype = $("#comptype").val();
			for( var i = 0; i < myRecords.length; i++)
			{
				if ( (myRecords[i].rc == rc) && (myRecords[i].comptype == ctype))
				{ 
					//Remove it from the array
					alert("Sorry, but you cannot enter the same RC Number for the same type of Company again.");
					return 0;
				}
			}
			var nature_array = [];
			var cbox = $("input[name='nature']:checked");
			cbox.each(function(){
				nature_array.push($(this).val());
			});
			var nature = nature_array.join(", ");
			var daterecv = $("#date_recv").val();
			var incoming = $("#c_incoming").val();
			var outgoing = $("#c_outgoing").val();
			var name = $("#p_name").val();
			var phone = $("#p_phone").val();
			var email = $("#p_email").val();
			var rrr = [];
			var amount = [];
			for(var i = 1; i <= rrr_counter; i++)
			{
				rrr.push($("#rrr"+i).val());
				amount.push($("#amount"+i).val());
			}
			var no_copies = $("#copies").val();
			var dDept = $("#dest_dept").val();
			var details = $("#details").val();
			if(myRecords.length == 0 && index == 0)
			{
				$("table tr:nth-child(2)").remove();
				$("#fwd_to_finance").attr('disabled',false);
			}
			if(myRecords.length == 0 && index > 0)
			{
				$("table tbody tr:first-child").remove();
				$("#fwd_to_finance").attr('disabled',false);
			}
			myRecords.push(new Records(rc, comp, ctype, nature_array, daterecv, incoming, outgoing, name, email, phone, rrr, amount, no_copies, dDept, details));
			index++;
			var ini = "";
			if(ctype == "Business Names")
				ini = "BN" + rc;
			else if(ctype == "Limited Liability Company")
				ini = "LLC" + rc;
			else
				ini = "IT" + rc;
			//Here, we add to the table below the main form
			var row_data = "<tr class='"+ini+"'><td>" + rc + "</td><td>" + comp + "</td><td>" + nature + "</td><td>"+ rrr.join(", ") +"</td><td>"+ dDept +"</td><td><a  class='text-danger' onclick='removeFromArray("+ rc +")'><i class='fa fa-trash fa-lg' data-toggle='tooltip' title='Delete "+comp+"'></i></a></td></tr>";
			$("table tbody").append(row_data);
		}
		else{
			alert("Select at least, 1 Nature of Application.");
		}
	}
	
	//This handles nature of business contents when Company Type gets changed
	$('#comptype').on('change', function() {
			if(this.value.localeCompare("Limited Liability Company") == 0)
			{
				var cbox = $("input:checkbox[name='nature']");
				cbox.each(function(){
					$(this).prop('checked', false);
				});
				$('#forIT').css({pointerEvents: "none"});
				$('#forIT').attr('hidden','');
				$('#forLLC').css({pointerEvents: ""});
				$('#forLLC').removeAttr('hidden');
				$('#forBN').css({pointerEvents: "none"});
				$('#forBN').attr('hidden','');
				$("input:checkbox[name='nature']").removeAttr('checked');
			}
			if(this.value.localeCompare("Incorporated Trustees") == 0)
			{
				var cbox = $("input:checkbox[name='nature']");
				cbox.each(function(){
					$(this).prop('checked', false);
				});
				$('#forIT').css({pointerEvents: ""});
				$('#forIT').removeAttr('hidden');
				$('#forLLC').css({pointerEvents: "none"});
				$('#forLLC').attr('hidden','');
				$('#forBN').css({pointerEvents: "none"});
				$('#forBN').attr('hidden','');
			}
			if(this.value.localeCompare("Business Names") == 0)
			{
				var cbox = $("input:checkbox[name='nature']");
				cbox.each(function(){
					$(this).prop('checked', false);
				});
				$('#forIT').css({pointerEvents: "none"});
				$('#forIT').attr('hidden','');
				$('#forLLC').css({pointerEvents: "none"});
				$('#forLLC').attr('hidden','');
				$('#forBN').css({pointerEvents: ""});
				$('#forBN').removeAttr('hidden');
				$("input:checkbox[name='nature']").removeAttr('checked');
			}
	});
	
	//This trigers the modal that prompt to confirm forwarding to finance and account
	$("#fwd_to_finance").click(function(){
		$("#bc").html('<label style="font-weight: bold; color: red">' + myRecords.length + '</label>');
		$("#toFinanceModal").modal("show");
	});
	
	//This gets triggered when the 'Yes' button on the modal gets clicked
	$("#confirmFwd").click(function(){
		$("#confirmFwd").prop('disabled', true);
		$("#cancelFwd").prop('disabled', true);
		//Assign Automated Batch Code for the first entry (it will suffice)
		//myRecords[0].batch = "Batch A";
		$("#loader").html('<center><i class="fa fa-cog fa-spin fa-2x fa-fw" style="color: #8FBC8F"></i></center>');
		var dat = 'data=' + JSON.stringify(myRecords);
		$.ajax({  
                url:"bg_to_finance_and_account.php",  
                method:"POST",  
                data:dat,  
                success:function(data)  
                {  
					 if(data.includes("Records Successfully Captured")){
						 $("#loader").html('<center class="text-success">' + data + ' <br />Page will refresh after closing this modal.</center>');
						 flag = 1;
					 }
					else{
						$("#loader").html('<center class="text-danger">'+ data +'</center>');
						flag = 0;
						$("#confirmFwd").prop('disabled', false);
						$("#cancelFwd").prop('disabled', false);
					}
                }  
           });
		
	});
	
	$('#toFinanceModal').on('hidden.bs.modal', function () {

		if(flag == 1){
			setTimeout(() => { window.location.assign("mail_room_new_post_application_entry.php"); });
		}
		$("#loader").html('');
	})
	
	//This here is for adding fields for additional RRR Number and Amount
	$("#addSingleRow").click( function(e) {
          e.preventDefault();
		  rrr_counter++;
        $(".rrrAmount").append('<div class="r'+ rrr_counter +' row">\
		<div class="col-2">\
			<div class = "row">\
				<div class="col-12 text-success">\
				&nbsp;\
				</div>\
			</div>\
			<div class = "row">\
				<div class="col-12 align-bottom my-auto">\
					'+ rrr_counter +'.\
				</div>\
			</div>\
		</div>\
		<div class="col-4 align-left text-success">\
			<div class = "row">\
				<div class="col-12 align-right text-success">\
					<strong>RRR Number:</strong>\
				</div>\
			</div>\
			<div class = "row">\
				<div class="col-12 align-left">\
					<div class="form-group">\
						<div class="input-group">\
							<div class="input-group-prepend">\
								<span class="input-group-text">\
									<span class="fa fa-id-badge" style="color: #8FBC8F"></span>\
								</span>                    \
							</div>\
							<input type="number" class="form-control" placeholder="RRR Number" onBlur="checkRRR(this)" id="rrr'+ rrr_counter +'" name="Q" required >\
						</div>\
					</div>\
				</div>\
			</div>\
			<div class = "row">\
				<div id="rrr_hint_'+ rrr_counter +'">\
				\
				</div>\
			</div>\
		</div>\
	\
		<div class="col-4 align-left text-success">\
			<div class = "row">\
				<div class="col-12 align-right text-success">\
					<strong>Amount:</strong>\
				</div>\
			</div>\
			<div class = "row">\
				<div class="col-12 align-left">\
					<div class="form-group">\
						<div class="input-group">\
							<div class="input-group-prepend">\
								<span class="input-group-text">\
									<span class="fa fa-money" style="color: #8FBC8F"></span>\
								</span>\
							</div>\
							<input type="number" class="form-control" placeholder="Amount" id="amount'+ rrr_counter +'" name="amount" required>\
						</div>\
					</div>\
				</div>\
			</div>\
		</div>\
	\
		<div class="col-2">\
			<div class = "row">\
				<div class="col-12 text-success">\
				&nbsp;\
				</div>\
			</div>\
			<div class = "row">\
				<div class="col-12" align="right">\
					<button type="button" onClick="removeItems(this.id)"  id="'+rrr_counter+'" class="remove_this btn btn-danger" data-toggle="tooltip" title="Remove RRR Receipt Row" ><i class="fa fa-minus-circle"></i>	Remove</button>\
\
				</div>\
			</div>\
		</div>\
	</div>\
');
return false;
	});
	
	  function removeItems(clicked_id)
	  {
		  var cls = "r"+clicked_id;
		  $('.r' + rrr_counter + '').remove();
		  rrr_counter--;
	  }
	  
	  function checkRRR(x) {
		var xt = (x.id).slice(-1); //Index
		$("#rrr_hint_"+xt).html('');  
		var val = $('#' + x.id + '').val();
		var name = $('#' + x.id + '').attr("name");
		if(val.length > 0)
		{		
			var dat = 'rrr=' + val;
			$("#rrr_hint_"+xt).html('<i class="fa fa-spinner fa-spin fa-fw" style="color: #8FBC8F"></i>');
			$.ajax({
			url: "check_rrr.php",
			method: "POST",
			data: dat,
			success:function(data){ 
					if(data === "This RRR is free for use, subject to validation by F&A." )
					{
						$("#rrr_hint_"+xt).html('<label style="font-size: 10px; font-weight: bold; color: #090"> &#9'+data+'</label>');
						for( var i = 0; i < btn_flag.length; i++)
						{
							if ( btn_flag[i] == xt)
							{
								btn_flag.splice(i, 1);
								break;
							}
						}
						if(btn_flag.length == 0)
							$("#btn_submit").attr('disabled',false);					
					}
					else
					{
						$("#rrr_hint_"+xt).html('<label style="font-size: 10px; font-weight: bold; color: red">'+data+'</label>');
						$("#btn_submit").attr('disabled',true);
						btn_flag.push(xt);
						//$('#' + x.id + '').attr('name', 'err');
					}
				}
			});
		}
	}

</script>
</html>