<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="images/cac_icon.ico"/>
<?php
if(!(isset($_POST['rc-number'])))
{
	echo "Invalid Request.";
	return false;
}
$rc = $_POST['rc-number'];
include ("dbconnection.php"); 
?>
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
<center>
<br />
<!-- There are 6 Possibilities Here -->
<!-- Start with checking if it is in Tracking Table -->

<?php
$sql = "SELECT DT.Company_Name, DT.Courier_Ack_Date, DT.MR_Despatched_Timestamp, DT.MR_Batch_Code, CC.Courier_Company_Name, CC.Courier_Address, ";
$sql.= "CC.Contact_Person, CC.Phone_No, R.REG_Manifest_Preparation_Date, R.MR_Receiving_Date, RG.RGO_Cert_Despatch_Date, ";
$sql.= "RG.REG_Receiving_Date FROM tbl_Despatch_Tracking as DT INNER JOIN tbl_Courier_Companies as CC ";
$sql.= " ON ((DT.Initials = CC.Initials) AND (DT.RC_Number = '$rc' AND DT.Company_Type = 'LLC' AND DT.Courier_Ack_Date IS NOT NULL)) ";
$sql.= "INNER JOIN tbl_Registry as R ON (DT.RC_Number = R.RC_Number) INNER JOIN tbl_RGs_Office as RG ";
$sql.="ON (R.RC_Number = RG.RC_Number)";
$result = sqlsrv_query($conn, $sql);
if($result === false) {
		die(print_r("Beginning::".sqlsrv_errors(), true));
	}
else{
	if(sqlsrv_has_rows($result)) //Meaning application has reached the courier and had been acknowledged
	{
		$row = sqlsrv_fetch_array($result);
	?>
		<div style="height:350px">
			<div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:22px">
				<div class="col-sm-12 my-auto" align="left">
						<center><b>Company Name:</b> <?php echo $row['Company_Name']; ?></center>
				</div>
			</div>
			<br />
			<div class="row align-top"  style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:12px">
				
				<div class="col-sm-2 my-auto" align="center">
					<div class="row">
						<div class="col-sm-12 my-auto" align="center">
							<i class="fa fa-check-circle fa-2x" style="color: #009900"  data-toggle="tooltip" title="Certificate generated & forwarded to Registry Dept."></i>
						</div>
						<div class="col-sm-12 my-auto" align="center">
							RG's Office
						</div>
					</div>
				</div>
				
				<div class="col-sm-1 my-auto" align="center">
					<i class="fa fa-long-arrow-right fa-2x align-bottom" style="color:#444444" data-toggle="tooltip" title="Forwarded to Registry on <?php echo $row['RGO_Cert_Despatch_Date']->format('M d, Y h:i A');?>. Received by Registry on <?php echo $row['REG_Receiving_Date']->format('M d, Y h:i A');?> "></i>
					<hr class="separator" style="border: 1px solid #DDDDDD;" > 
				</div>
				
				<div class="col-sm-2 my-auto" align="center">
					<div class="row">
						<div class="col-sm-12 my-auto" align="center">
							<i class="fa fa-check-circle fa-2x" style="color: #009900" data-toggle="tooltip" title="Certificate and CTCs jacketed, and forwarded to Mail Room"></i>
						</div>
						<div class="col-sm-12 my-auto" align="center">
							Registry
						</div>
					</div>
				</div>
				
				<div class="col-sm-1 my-auto" align="center">
					<i class="fa fa-long-arrow-right fa-2x" style="color:  #444444" data-toggle="tooltip" title="Forwarded to Mail Room on <?php echo $row['REG_Manifest_Preparation_Date']->format('M d, Y h:i A');?>. Received by Mail Room on <?php echo $row['MR_Receiving_Date']->format('M d, Y h:i A');?> "></i>
					<hr class="separator" style="border: 1px solid #DDDDDD;" > 
				</div>
				
				<div class="col-sm-2 my-auto" align="center">                   
					<div class="row">
						<div class="col-sm-12 my-auto" align="center">
							<i class="fa fa-check-circle fa-2x" style="color: #009900" data-toggle="tooltip" title="Jacketed documents forwarded to Courier"></i>
						</div>
						<div class="col-sm-12 my-auto" align="center">
							Mail Room
						</div>
					</div>
				</div>
				
				<div class="col-sm-1 my-auto" align="center">
					<i class="fa fa-long-arrow-right fa-2x" style="color:  #444444" data-toggle="tooltip" title="Forwarded to Courier on <?php echo $row['MR_Despatched_Timestamp']->format('M d, Y h:i A');?> "></i>
					<hr class="separator" style="border: 1px solid #DDDDDD;" > 
				</div>
				
				<div class="col-sm-3 my-auto" align="left">
					<div class="row" style="position: absolute; margin-top: -22px; height:auto">
						<div class="col-sm-12" align="left" >
							<i class="fa fa-truck fa-flip-horizontal fa-2x" style="color: #8FBC8F" data-toggle="tooltip" title="Your documents are with the undermentioned Courier Company"></i>
						</div>
						<div class="col-sm-12" align="left">
							Delivered to Courier 
						</div>
						<br /><br />
						<div class="col-sm-12" align="left">
							<strong>Acknowledged by Courier On: </strong> <?php echo $row['Courier_Ack_Date']->format('M d, Y h:i A'); ?>
						</div>
						<br /><br />
						<div class="col-sm-12" align="left">
							<strong>Courier Company: </strong> <?php echo $row['Courier_Company_Name']; ?>
						</div>
						<br /><br />
						<div class="col-sm-12" align="left">
							<strong>Address: </strong> <?php echo $row['Courier_Address']; ?> 
						</div>
						<br />
						<br />
						<br />
						<div class="col-sm-12" align="left">
							<strong>Contact Person: </strong> <?php echo $row['Contact_Person']; ?> 
						</div>
						<br /><br />
						<div class="col-sm-12" align="left">
							<strong>Phone: </strong> <?php echo $row['Phone_No']; ?>  
						</div>
						<br /><br />
						<div class="col-sm-12" align="left">
							<strong>Reference Code: </strong> <?php echo $row['MR_Batch_Code']; ?> 
						</div>
					</div>            
				</div>		
			</div>
		</div>
	<?php
	} //End of application has reached the courier and had been acknowledged (1)
	else{
		//Beginning of application has reached the courier but yet to be acknowledged (2)
		$sql = "SELECT DT.Company_Name, DT.Courier_Ack_Date, DT.MR_Despatched_Timestamp, DT.MR_Batch_Code, CC.Courier_Company_Name, CC.Courier_Address, ";
		$sql.= "CC.Contact_Person, CC.Phone_No, R.REG_Manifest_Preparation_Date, R.MR_Receiving_Date, RG.RGO_Cert_Despatch_Date, ";
		$sql.= "RG.REG_Receiving_Date FROM tbl_Despatch_Tracking as DT INNER JOIN tbl_Courier_Companies as CC ";
		$sql.= " ON ((DT.Initials = CC.Initials) AND (DT.RC_Number = '$rc' AND DT.Company_Type = 'LLC' AND DT.Courier_Ack_Date IS NULL)) ";
		$sql.= "INNER JOIN tbl_Registry as R ON (DT.RC_Number = R.RC_Number) INNER JOIN tbl_RGs_Office as RG ";
		$sql.="ON (R.RC_Number = RG.RC_Number)";
		$result = sqlsrv_query($conn, $sql);
		if($result === false) {
			die(print_r("Second::".sqlsrv_errors(), true));
		}
		else
		{
			if(sqlsrv_has_rows($result)) //Meaning application has reached the courier but yet to be acknowledged
			{
				$row = sqlsrv_fetch_array($result);
				?>
				<div style="height:350px">
				<div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:22px">
					<div class="col-sm-12 my-auto" align="left">
							<center><b>Company Name:</b> <?php echo $row['Company_Name']; ?></center>
					</div>
				</div>
				<br />
				<div class="row align-top"  style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:12px">
					
					<div class="col-sm-2 my-auto" align="center">
						<div class="row">
							<div class="col-sm-12 my-auto" align="center">
								<i class="fa fa-check-circle fa-2x" style="color: #009900" data-toggle="tooltip" title="Certificate generated & forwarded to Registry Dept."></i>
							</div>
							<div class="col-sm-12 my-auto" align="center">
								RG's Office
							</div>
						</div>
					</div>
					
					<div class="col-sm-1 my-auto" align="center">
						<i class="fa fa-long-arrow-right fa-2x align-bottom" style="color:#444444" data-toggle="tooltip" title="Forwarded to Registry on <?php echo $row['RGO_Cert_Despatch_Date']->format('M d, Y h:i A');?>. Received by Registry on <?php echo $row['REG_Receiving_Date']->format('M d, Y h:i A');?> "></i>
						<hr class="separator" style="border: 1px solid #DDDDDD;" > 
					</div>
					
					<div class="col-sm-2 my-auto" align="center">
						<div class="row">
							<div class="col-sm-12 my-auto" align="center">
								<i class="fa fa-check-circle fa-2x" style="color: #009900" data-toggle="tooltip" title="Certificate and CTCs jacketed, and forwarded to Mail Room"></i>
							</div>
							<div class="col-sm-12 my-auto" align="center">
								Registry
							</div>
						</div>
					</div>
					
					<div class="col-sm-1 my-auto" align="center">
						<i class="fa fa-long-arrow-right fa-2x" style="color:  #444444" data-toggle="tooltip" title="Forwarded to Mail Room on <?php echo $row['REG_Manifest_Preparation_Date']->format('M d, Y h:i A');?>. Received by Mail Room on <?php echo $row['MR_Receiving_Date']->format('M d, Y h:i A');?> "></i>
						<hr class="separator" style="border: 1px solid #DDDDDD;" > 
					</div>
					
					<div class="col-sm-2 my-auto" align="center">                   
						<div class="row">
							<div class="col-sm-12 my-auto" align="center">
								<i class="fa fa-check-circle fa-2x" style="color: #009900" data-toggle="tooltip" title="Jacketed documents forwarded to Courier"></i>
							</div>
							<div class="col-sm-12 my-auto" align="center">
								Mail Room
							</div>
						</div>
					</div>
					
					<div class="col-sm-1 my-auto" align="center">
						<i class="fa fa-long-arrow-right fa-2x" style="color:  #444444" data-toggle="tooltip" title="Forwarded to Courier on <?php echo $row['MR_Despatched_Timestamp']->format('M d, Y h:i A');?> "></i>
						<hr class="separator" style="border: 1px solid #DDDDDD;" > 
					</div>
					
					<div class="col-sm-2 my-auto" align="left">
						<div class="row" style="position: absolute; margin-top: -22px; height:auto">
							<div class="col-sm-12" align="left" >
								<i class="fa fa-truck fa-flip-horizontal fa-2x" style="color: gold" data-toggle="tooltip" title="Awaiting Courier to acknowledge the receipt of your documents"></i>
							</div>
							<div class="col-sm-12" align="left">
								Courier
							</div>
							<div class="col-sm-12 my-auto" align="left">
								<i>(Documents on their way here)</i>
							</div>
						</div>            
					</div>		
				</div>
			</div>
				<?php
			}
			else
			{ //Beginning of Mail Room (With Ack but not send to courier)
				$sql = "SELECT M.Received_From_REG_on, R.REG_Manifest_Preparation_Date, R.Company_Name, R.Received_From_RGO_On, ";
				$sql.= "RG.RGO_Cert_Despatch_Date FROM tbl_Mail_Room as M INNER JOIN tbl_Registry as R ON ((M. RC_Number = R.RC_Number) AND R.RC_Number = '$rc'";
				$sql.= " AND R.REG_Despatch_Status = 'A-B-MR' AND R.MR_Receiving_Date IS NOT NULL) INNER JOIN tbl_RGs_office as RG ";
				$sql.= "ON R.RC_Number = RG.RC_Number";
				$result = sqlsrv_query($conn, $sql);
				if($result === false) {
					die(print_r("Second::".sqlsrv_errors(), true));
				}
				else
				{
					if(sqlsrv_has_rows($result)) //Meaning application has reached the courier but yet to be acknowledged
					{
						$row = sqlsrv_fetch_array($result);
						?>
						<div style="height:350px">
						<div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:22px">
							<div class="col-sm-12 my-auto" align="left">
									<center><b>Company Name:</b> <?php echo $row['Company_Name']; ?></center>
							</div>
						</div>
						<br />
						<div class="row align-top"  style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:12px">
							<div class="col-sm-1 my-auto" align="center"></div>
							<div class="col-sm-2 my-auto" align="center">
								<div class="row">
									<div class="col-sm-12 my-auto" align="center">
										<i class="fa fa-check-circle fa-2x" style="color: #009900" data-toggle="tooltip" title="Certificate generated & forwarded to Registry Dept."></i>
									</div>
									<div class="col-sm-12 my-auto" align="center">
										RG's Office
									</div>
								</div>
							</div>
							
							<div class="col-sm-1 my-auto" align="center">
								<i class="fa fa-long-arrow-right fa-2x align-bottom" style="color: #444444" data-toggle="tooltip" title="Forwarded to Registry on <?php echo $row['RGO_Cert_Despatch_Date']->format('M d, Y h:i A');?>. Received from RG's Office on <?php echo $row['Received_From_RGO_On']->format('M d, Y h:i A');?>"></i>
								<hr class="separator" style="border: 1px solid #DDDDDD;" > 
							</div>
							
							<div class="col-sm-2 my-auto" align="center">
								<div class="row">
									<div class="col-sm-12 my-auto" align="center">
										<i class="fa fa-check-circle fa-2x" style="color: #009900" data-toggle="tooltip" title="Certificate and CTCs jacketed, and forwarded to Mail Room"></i>
									</div>
									<div class="col-sm-12 my-auto" align="center">
										Registry
									</div>
								</div>
							</div>
							
							<div class="col-sm-1 my-auto" align="center">
								<i class="fa fa-long-arrow-right fa-2x" style="color: #444444" data-toggle="tooltip" title="Forwared to Mail Room on <?php echo $row['REG_Manifest_Preparation_Date']->format('M d, Y h:i A');?>. Received from Registry on <?php echo $row['Received_From_REG_on']->format('M d, Y h:i A');?>"></i>
								<hr class="separator" style="border: 1px solid #DDDDDD;" > 
							</div>
							
							<div class="col-sm-2 my-auto" align="center">                   
								<div class="row">
									<div class="col-sm-12 my-auto" align="center">
										<i class="fa fa-circle fa-2x" style="color: Gold" data-toggle="tooltip" title="Jacketed documents are being prepared for onward despatch to Courier"></i>
									</div>
									<div class="col-sm-12 my-auto" align="center">
										Mail Room
									</div>
									<div class="col-sm-12 my-auto" align="center">
										<i>(Your documents are here)</i>
									</div>
								</div>
							</div>
							
							<div class="col-sm-1 my-auto" align="center">
							<i class="fa fa-times fa-2x" style="color:  #444444"></i>
							<hr class="separator" style="border: 1px solid #DDDDDD;" > 
							</div>
							
							<div class="col-sm-2 my-auto" align="left">
								<div class="row" style="position: absolute; margin-top: -22px; height:auto">
									<div class="col-sm-12" align="left" >
										<i class="fa fa-truck fa-flip-horizontal fa-2x" style="color: #999999" data-toggle="tooltip" title="Process not initiated"></i>
									</div>
									<div class="col-sm-12" align="left">
										Courier
									</div>
								</div>            
							</div>		
						</div>
					</div>
						<?php
					}
					else
					{ 	//Beginning of Mail Room (Without Ack)
						$sql = "SELECT RG.RGO_Cert_Despatch_Date, R.Company_Name, R.Received_From_RGO_On, R.REG_Manifest_Preparation_Date ";
						$sql.= "FROM tbl_RGs_Office as RG INNER JOIN tbl_Registry as R ON ((RG. RC_Number = R.RC_Number) AND R.RC_Number = '$rc'";
						$sql.= " AND R.REG_Despatch_Status = 'S-T-MR' AND R.MR_Receiving_Date IS NULL)";
						$result = sqlsrv_query($conn, $sql);
						if($result === false) {
							die(print_r("Second::".sqlsrv_errors(), true));
						}
						else
						{
							if(sqlsrv_has_rows($result)) //Meaning application has reached the courier but yet to be acknowledged
							{
								$row = sqlsrv_fetch_array($result);
								?>
								<div style="height:350px">
								<div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:22px">
									<div class="col-sm-12 my-auto" align="left">
											<center><b>Company Name:</b> <?php echo $row['Company_Name']; ?></center>
									</div>
								</div>
								<br />
								<div class="row align-top"  style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:12px">
									<div class="col-sm-1 my-auto" align="center"></div>
									<div class="col-sm-2 my-auto" align="center">
										<div class="row">
											<div class="col-sm-12 my-auto" align="center">
												<i class="fa fa-check-circle fa-2x" style="color: #009900" data-toggle="tooltip" title="Certificate generated & forwarded to Registry Dept."></i>
											</div>
											<div class="col-sm-12 my-auto" align="center">
												RG's Office
											</div>
										</div>
									</div>
									
									<div class="col-sm-1 my-auto" align="center">
										<i class="fa fa-long-arrow-right fa-2x align-bottom" style="color: #444444" data-toggle="tooltip" title="Forwarded to Registry on <?php echo $row['RGO_Cert_Despatch_Date']->format('M d, Y h:i A');?>. Received from RG's Office on <?php echo $row['Received_From_RGO_On']->format('M d, Y h:i A');?>"></i>
										<hr class="separator" style="border: 1px solid #DDDDDD;" > 
									</div>
									
									<div class="col-sm-2 my-auto" align="center">
										<div class="row">
											<div class="col-sm-12 my-auto" align="center">
												<i class="fa fa-check-circle fa-2x" style="color: #009900" data-toggle="tooltip" title="Certificate and CTCs jacketed, and forwarded to Mail Room"></i>
											</div>
											<div class="col-sm-12 my-auto" align="center">
												Registry
											</div>
										</div>
									</div>
									
									<div class="col-sm-1 my-auto" align="center">
										<i class="fa fa-long-arrow-right fa-2x" style="color: #444444" data-toggle="tooltip" title="Forwared to Mail Room on <?php echo $row['REG_Manifest_Preparation_Date']->format('M d, Y h:i A');?>"></i>
										<hr class="separator" style="border: 1px solid #DDDDDD;" > 
									</div>
									
									<div class="col-sm-2 my-auto" align="center">                   
										<div class="row">
											<div class="col-sm-12 my-auto" align="center">
												<i class="fa fa-circle fa-2x" style="color: #ec2d01" data-toggle="tooltip" title="Awaiting acknowledgement of jacketed documents from Mail Room."></i>
											</div>
											<div class="col-sm-12 my-auto" align="center">
												Mail Room
											</div>
											<div class="col-sm-12 my-auto" align="center">
												<i>(Documents on their way here)</i>
											</div>
										</div>
									</div>
									
									<div class="col-sm-1 my-auto" align="center">
									<i class="fa fa-times fa-2x" style="color:  #444444"></i>
									<hr class="separator" style="border: 1px solid #DDDDDD;" > 
									</div>
									
									<div class="col-sm-2 my-auto" align="left">
										<div class="row" style="position: absolute; margin-top: -22px; height:auto">
											<div class="col-sm-12" align="left" >
												<i class="fa fa-truck fa-flip-horizontal fa-2x" style="color: #999999" data-toggle="tooltip" title="Process not initiated"></i>
											</div>
											<div class="col-sm-12" align="left">
												Courier
											</div>
										</div>            
									</div>		
								</div>
							</div>
								<?php
							}
							else
							{ //Beginning of Registry (With Ack)
								$sql = "SELECT RG.RGO_Cert_Despatch_Date, R.Company_Name, R.Received_From_RGO_On ";
								$sql.= "FROM tbl_RGs_Office as RG INNER JOIN tbl_Registry as R ON ((RG. RC_Number = R.RC_Number) AND R.RC_Number = '$rc'";
								$sql.= " AND R.REG_Despatch_Status IS NULL AND R.REG_Manifest_Preparation_Date IS NULL)";
								$result = sqlsrv_query($conn, $sql);
								if($result === false) {
									die(print_r("Second::".sqlsrv_errors(), true));
								}
								else
								{
									if(sqlsrv_has_rows($result)) //Meaning application has reached the courier but yet to be acknowledged
									{
										$row = sqlsrv_fetch_array($result);
										?>
										<div style="height:350px">
										<div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:22px">
											<div class="col-sm-12 my-auto" align="left">
													<center><b>Company Name:</b> <?php echo $row['Company_Name']; ?></center>
											</div>
										</div>
										<br />
										<div class="row align-top"  style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:12px">
											<div class="col-sm-1 my-auto" align="center"></div>
											<div class="col-sm-2 my-auto" align="center">
												<div class="row">
													<div class="col-sm-12 my-auto" align="center">
														<i class="fa fa-check-circle fa-2x" style="color: #009900" data-toggle="tooltip" title="Certificate generated & forwarded to Registry Dept."></i>
													</div>
													<div class="col-sm-12 my-auto" align="center">
														RG's Office
													</div>
												</div>
											</div>
											
											<div class="col-sm-1 my-auto" align="center">
												<i class="fa fa-long-arrow-right fa-2x align-bottom" style="color: #444444" data-toggle="tooltip" title="Forwarded to Registry on <?php echo $row['RGO_Cert_Despatch_Date']->format('M d, Y h:i A');?>. Received from RG's Office on <?php echo $row['Received_From_RGO_On']->format('M d, Y h:i A');?>"></i>
												<hr class="separator" style="border: 1px solid #DDDDDD;" > 
											</div>
											
											<div class="col-sm-2 my-auto" align="center">
												<div class="row">
													<div class="col-sm-12 my-auto" align="center">
														<i class="fa fa-circle fa-2x" style="color: Gold" data-toggle="tooltip" title="CTCs are being prepared for onward forwarding (with Certificate) to Mail Room."></i>
													</div>
													<div class="col-sm-12 my-auto" align="center">
														Registry
													</div>
													<div class="col-sm-12 my-auto" align="center">
														<i>(Your certificate is here)</i>
													</div>
												</div>
											</div>
											
											<div class="col-sm-1 my-auto" align="center">
												<i class="fa fa-times fa-2x" style="color: #444444" ></i>
												<hr class="separator" style="border: 1px solid #DDDDDD;" > 
											</div>
											
											<div class="col-sm-2 my-auto" align="center">                   
												<div class="row">
													<div class="col-sm-12 my-auto" align="center">
														<i class="fa fa-circle fa-2x" style="color: #999999" data-toggle="tooltip" title="Process not initiated."></i>
													</div>
													<div class="col-sm-12 my-auto" align="center">
														Mail Room
													</div>
												</div>
											</div>
											
											<div class="col-sm-1 my-auto" align="center">
											<i class="fa fa-times fa-2x" style="color:  #444444"></i>
											<hr class="separator" style="border: 1px solid #DDDDDD;" > 
											</div>
											
											<div class="col-sm-2 my-auto" align="left">
												<div class="row" style="position: absolute; margin-top: -22px; height:auto">
													<div class="col-sm-12" align="left" >
														<i class="fa fa-truck fa-flip-horizontal fa-2x" style="color: #999999" data-toggle="tooltip" title="Process not initiated"></i>
													</div>
													<div class="col-sm-12" align="left">
														Courier
													</div>
												</div>            
											</div>		
										</div>
									</div>
										<?php
									}
									else
									{ //Beginning of Registry (Without Ack)
										$sql = "SELECT RGO_Cert_Despatch_Date, Company_Name ";
										$sql.= "FROM tbl_RGs_Office WHERE RC_Number = '$rc'";
										$sql.= " AND RGO_Despatch_Status = 'S-T-R' AND REG_Receiving_Date IS NULL";
										$result = sqlsrv_query($conn, $sql);
										if($result === false) {
											die(print_r("Second::".sqlsrv_errors(), true));
										}
										else
										{
											if(sqlsrv_has_rows($result)) //Meaning application has reached the courier but yet to be acknowledged
											{
												$row = sqlsrv_fetch_array($result);
												?>
												<div style="height:350px">
												<div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:22px">
													<div class="col-sm-12 my-auto" align="left">
															<center><b>Company Name:</b> <?php echo $row['Company_Name']; ?></center>
													</div>
												</div>
												<br />
												<div class="row align-top"  style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:12px">
													<div class="col-sm-1 my-auto" align="center"></div>
													<div class="col-sm-2 my-auto" align="center">
														<div class="row">
															<div class="col-sm-12 my-auto" align="center">
																<i class="fa fa-check-circle fa-2x" style="color: #009900" data-toggle="tooltip" title="Certificate generated & forwarded to Registry Dept."></i>
															</div>
															<div class="col-sm-12 my-auto" align="center">
																RG's Office
															</div>
														</div>
													</div>
													
													<div class="col-sm-1 my-auto" align="center">
														<i class="fa fa-long-arrow-right fa-2x align-bottom" style="color: #444444" data-toggle="tooltip" title="Forwarded to Registry on <?php echo $row['RGO_Cert_Despatch_Date']->format('M d, Y h:i A');?>."></i>
														<hr class="separator" style="border: 1px solid #DDDDDD;" > 
													</div>
													
													<div class="col-sm-2 my-auto" align="center">
														<div class="row">
															<div class="col-sm-12 my-auto" align="center">
																<i class="fa fa-circle fa-2x" style="color: #ec2d01" data-toggle="tooltip" title="Awaiting acknowledgement of Certificate from Registry Dept."></i>
															</div>
															<div class="col-sm-12 my-auto" align="center">
																Registry
															</div>
															<div class="col-sm-12 my-auto" align="center">
																<i>(Certificate on its way here)</i>
															</div>
														</div>
													</div>
													
													<div class="col-sm-1 my-auto" align="center">
														<i class="fa fa-times fa-2x" style="color: #444444" ></i>
														<hr class="separator" style="border: 1px solid #DDDDDD;" > 
													</div>
													
													<div class="col-sm-2 my-auto" align="center">                   
														<div class="row">
															<div class="col-sm-12 my-auto" align="center">
																<i class="fa fa-circle fa-2x" style="color: #999999" data-toggle="tooltip" title="Process not initiated."></i>
															</div>
															<div class="col-sm-12 my-auto" align="center">
																Mail Room
															</div>
														</div>
													</div>
													
													<div class="col-sm-1 my-auto" align="center">
													<i class="fa fa-times fa-2x" style="color:  #444444"></i>
													<hr class="separator" style="border: 1px solid #DDDDDD;" > 
													</div>
													
													<div class="col-sm-2 my-auto" align="left">
														<div class="row" style="position: absolute; margin-top: -22px; height:auto">
															<div class="col-sm-12" align="left" >
																<i class="fa fa-truck fa-flip-horizontal fa-2x" style="color: #999999" data-toggle="tooltip" title="Process not initiated"></i>
															</div>
															<div class="col-sm-12" align="left">
																Courier
															</div>
														</div>            
													</div>		
												</div>
											</div>
												<?php
											}
											else
											{ //No records found for this RC in our Manifest
												?>
												<div id = "row">
													<div class="col-sm-3 ">
													</div>
													<div class="col-sm-7 ">
														<div class="alert alert-danger alert-dismissible fade show">
															<strong><i class="fa fa-exclamation-circle" ></i>  Notification:</strong> There is no manifest record found for the RC <b><?php echo $rc;?></b> on our system.<br /> It may be that the manifest is yet to be prepared.
															<button type="button" class="close" data-dismiss="alert">&times;</button>
														</div>
													</div>
												</div>
											<?php } //No records found for this RC in our Manifest
										}
									} //End of Registry (Without Ack)
								}
							} //End of Registry (With Ack)
						}
					} //End of Mail Room (Without Ack)
				}
			} //End of Mail Room (With Ack but not sent to courier)
		}
		
	}//End of application has reached the courier but yet to be acknowledged (2)
}
?>
</center>
</div>
</div>
</body>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</html>