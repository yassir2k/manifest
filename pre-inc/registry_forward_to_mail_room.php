<?php
//This script will be used in obtaining index value for batches from the Database
session_start();
if ($_SESSION['user'] == null || $_SESSION['dept'] != "Registry"){
	header("Location: ../index.php");
}
date_default_timezone_set("Africa/Lagos");
$index = 0;
include ('../dbconnection.php');
$sql = "SELECT TOP 1 Batch_Number FROM tbl_Batches_History WHERE Department_Unit = 'Registry' ";
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
	
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody tr td input[type="checkbox"]');
	$('#selectAll').on('click', function(e, data) { 
    if(! ($(this).is(":checked")) )
	{
		checkbox.each(function(){
				$(this).bootstrapToggle('on');                    
			});
	}
	else
	{
		checkbox.each(function(){
			$(this).bootstrapToggle('off');			
		});
			
	}
});

});
</script>

  <title>E - Manifest: Forward Manifest From Registry to Customer Service</title>
</head>

<body>
	<input type="hidden" id="indexer" value="<?php echo $index; ?>" />
	<div class="container-fluid">
	<div class="container-bg">
	<div class="fcta-header">
		<img src="images/cac-logo.png" class="cac-logo">
		<img src="images/coat-of-arms.png" class="coat-of-arm">
	</div>
  <!--Add Menu Here-->
  <?php require('menus/menu_registry_forward_to_mail_room.php')?>
  <!--End of Menu-->
  <ol class="breadcrumb" style="background-color: #F5F5F5; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
				<li class="breadcrumb-item"><a class="text-success" href="registry_dashboard.php">Dashboard</a></li>
				<li class="breadcrumb-item active text-secondary">Forward Manifest</li>
				<li class="breadcrumb-item active text-secondary">To Mail Room</li>
  </ol>
   <div class="toptop" style="margin-top: 20px">
   <div class="row top-buffer">
        <div class="table-responsive">
			<div class="table-wrapper">
				<div style="padding-bottom: 15px; background: #777; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
					<div class="row">
						<div class="col-xs-6">
							<h2 style="margin: 5px 0 0; font-size: 24px">Registry's Manifest<b> To Mail Room</b></h2>
						</div>
						<div class="col-xs-6 ml-auto" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
							<input  type="checkbox" id="selectAll" data-toggle="toggle" data-on="All Forwarded" data-off="Forward all to Mail Room?" data-onstyle="success" data-offstyle="danger" data-width="250" data-height="40" onchange="forAll()">
							
							<button  id="showMailRoomModal" disabled="disabled" class="btn btn-info" data-toggle="modal"><i class="fa fa-check-circle"></i> <span>Confirm Forwarding</span></button>						
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
					<thead>
						<tr id="">
							<th>No.</th>
							<th>Name</th>
							<th>Serial Number</th>
							<th>RC Number</th>
							<th>Actions (Forward to Mail Room)</th>
						</tr>
					</thead>
					<?php
					//Now we read all forwarded manifest from RGs office to Registry
					include ("../dbconnection.php"); 
					$query = "SELECT Company_Name, Serial_No, RC_Number FROM tbl_Registry WHERE REG_Despatch_Status IS NULL";
					$result = sqlsrv_query($conn,$query);
					
					if(!(sqlsrv_has_rows($result)))
					{	
					?>
					<tbody>
						<tr>
							<td colspan="5">
								No new manifest yet from the RGs office.
							</td>
						</tr>
					</tbody>
					<?php
					}
					else
					{
						echo "<tbody>";
						$i = 0;
						while($row = sqlsrv_fetch_array($result))
						{
					?>
						<tr style="vertical-align:middle" class="<?php echo $row['Serial_No']; ?>">
							<td><?php echo $i+1; ?></td>
							<td><?php echo $row['Company_Name']; ?></td>
							<td class="serial"><?php echo $row['Serial_No']; ?></td>
							<td><?php echo $row['RC_Number']; ?></td>
							<td>
								<input id="checkbox1" type="checkbox"  data-toggle="toggle" data-on="Forwarded" data-off="Forward to Mail Room?" onchange="checkOnorOff()" data-onstyle="success" data-offstyle="danger" data-width="220" data-height="40">
							</td>
						</tr>
						<?php
						$i++;
						}
					}
						?>
					</tbody>
				</table>
				<div class="clearfix">
					<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
					<ul class="pagination">
						<li class="page-item disabled"><a href="#">Previous</a></li>
						<li class="page-item"><a href="#" class="page-link">1</a></li>
						<li class="page-item"><a href="#" class="page-link">2</a></li>
						<li class="page-item active"><a href="#" class="page-link">3</a></li>
						<li class="page-item"><a href="#" class="page-link">4</a></li>
						<li class="page-item"><a href="#" class="page-link">5</a></li>
						<li class="page-item"><a href="#" class="page-link">Next</a></li>
					</ul>
				</div>
			</div>
		</div>        
    </div>
	</div>
	<br />
	<br />

	<!-- Forward to Mail Room Modal (Prompt) -->
		<div id="forwardToMailRoomModal" class="modal fade" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif"> 
		<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">						
						<h4 class="modal-title">Forward to Mail Room</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body"> 		
						<p>Are you sure you want to forward this manifest to Mail Room?</p>
						<p>Total records prepared for forwarding: <div id="bc"></div></p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
						<div id="loader"></div>
					</div>
					<div class="modal-footer">
						<input id="cancelFwd" type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
						<button id="fwdToMailRoom" class="btn btn-success" >
						<span>Yes, Forward to Mail Room</span>
							<i class="fa fa-check" style="horizontal-align: right;" ></i>
						</button>
					</div>
			</div>
		</div>
        </div><!--End of Forward to Mail Room Modal -->
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
<script>
var check_counter = 0; //This is used in determining whether to enable the confirm button or not
var flag = 0;
//This shows Modal
$("#showMailRoomModal").click(function(){
	$("#bc").html('<label style="font-weight: bold; color: red">' + check_counter + '</label>');
	$("#forwardToMailRoomModal").modal("show");
});

//This handles event when modal is closed
$('#forwardToMailRoomModal').on('hidden.bs.modal', function () {

	if(flag == 1){
		setTimeout(() => { window.location.assign("registry_forward_to_mail_room.php"); });
	}
})

function checkOnorOff()
{
	check_counter = 0;
	var checkbox = $('table tbody tr td input[type="checkbox"]');
	checkbox.each(function(){
		if($(this).is(":checked"))//Here, we check each acknowledge item and extract its class
		{
			check_counter++;	
		}
		if(check_counter > 0)
			$("#showMailRoomModal").prop('disabled', false);
		else
			$("#showMailRoomModal").prop('disabled', true);

	});
}


$("#fwdToMailRoom").click(function(){
	$("#fwdToMailRoom").prop('disabled', true);
	$("#cancelFwd").prop('disabled', true);
	var serials = [];
	var cert_batch = [];
	var index = $("#indexer").val();
	var batch = "<?php echo $_SESSION['state_code'].'-REG-'.date('dmYHis').'-PRE-B-'; ?>";
	batch = batch.concat(index);
	var checkbox = $('table tbody tr td input[type="checkbox"]');
	checkbox.each(function(){
		if($(this).is(":checked"))//Here, we check each acknowledge item and extract its class
		{
			serials.push($(this).closest('tr').attr('class'));
			cert_batch.push(batch);
		}		
	});
	flag = 1;
	//Now prepare data for server
	var d = 'data={"serials":["' + serials.join('","') + '"], "cert_batch":["' + cert_batch.join('","') + '"]}';
	$('#loader').html('<center><i class="fa fa-spinner fa-spin fa-5x fa-fw" style="color: #8FBC8F"></i></center>');
	$.ajax({  
		url:"registry_bg_forwarded_to_mail_room.php",  
		method:"POST",  
		data:d,  
		success:function(data)  
		{  
			 if(data.includes("Record(s) successfully forwarded to Mail Room.")){
				 $("#loader").html('<center class="text-success">' + data + ' <br />Page will refresh after closing this modal.</center>');
			 }
			else{
				$("#loader").html('<center class="text-danger">'+ data +'</center>');
			}
		}  
   });	
});
</script>
</html>