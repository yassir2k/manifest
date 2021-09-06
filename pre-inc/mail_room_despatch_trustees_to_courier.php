<?php
ini_set('display_errors', 'off');
session_start();
//Check if user session does not exist or the user does not belong to the relevant dept, and role.
if ($_SESSION['user'] == null 
|| ( ($_SESSION['dept'] != "Mail Room") || ($_SESSION['role'] != "Pre Incorporation") ))
{
	header("Location: ../index.php");
}
include ('../dbconnection.php');
$scode = $_SESSION['state_code'];
$index = 0;
$count = 0;
$sql = "SELECT TOP 1 Batch_Number FROM tbl_Batches_History WHERE Department_Unit = 'Mail Room' ";
$sql.=" AND (convert(varchar,Date_Generated, 23) = convert(varchar, getdate(), 23))";
$sql.=" AND (State_Code = '$scode') ORDER BY Batch_Number DESC ";
$result = sqlsrv_query($conn, $sql);
if($result === false) {
		die(print_r("TOP::".sqlsrv_errors(), true));
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
  <link rel="stylesheet" href="css/manifest-css-mailroom.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap4-toggle.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="js/bootstrap4-toggle.min.js"></script>

  <title>E- Despatch: Despatch to Courier</title>
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
  <?php require('menus/menu_mail_room_despatch_to_courier.php')?>
  <!--End of Menu-->
  <ol class="breadcrumb" style="background-color: #F5F5F5; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
				<li class="breadcrumb-item"><a class="text-success" href="mail_room_dashboard.php">Dashboard</a></li>
				<li class="breadcrumb-item active text-secondary">Despatch to Courier</li>
				<li class="breadcrumb-item active text-secondary">Companies Certificates & CTCs</li>
  </ol>
   <div class="toptop" style="margin-top: 20px">
   <div class="row top-buffer">
        <div class="table-responsive">
			<div class="table-wrapper">
				<div style="padding-bottom: 15px; background: #666; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
					<div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
						<div class="col-xs-6">
							<h2 style="margin: 5px 0 0; font-size: 28px"><b>Mail Room Despatch</b> (Forward IT Batch to Courier)</h2>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
					<thead>
						<tr id="">
							<th>More</th>
							<th>No.</th>
							<th>Batch Code</th>
							<th>Date/Time Sent</th>
							<th>Total Records</th>
							<th>Action</th>
						</tr>
					</thead>
					<?php
					include ('../dbconnection.php');
					//Now we read all forwarded manifest from Incorporated Trustees to Mail Room
					$query = "SELECT DISTINCT B.Batch_Code, B.Date_Generated, B.Total_Records, B.State_Code ";
					$query.="FROM tbl_Trustees as R INNER JOIN tbl_Batches_History as B ";
					$query.="ON ((R.IT_Batch = B.Batch_Code and R.MR_Receiving_Date IS NOT NULL) ";
					$query.=" AND R.IT_Despatch_Status = 'A-B-MR') INNER JOIN tbl_Mail_Room as M ON ";
					$query.= "(R.IT_Batch = M.IT_Batch AND M.Forwarded_By IS NULL) ORDER  BY Date_Generated";
					$result = sqlsrv_query($conn,$query);
					
					if(!(sqlsrv_has_rows($result)))
					{	
					?>
					<tbody>
						<tr>
							<td colspan="6">
								No new manifest yet from the Incorporated Trustees Department.
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
						{ if($i == 0)
							//Assign count to $count
							$count = $row['Total_Records'];
					?>
						<tr style="vertical-align:middle">
							<!-- Toggle (Show only for Job at the top -->
							<td>
							<?php //if(($i+1) == 1) { ?>
								<a data-toggle="collapse" data-target="#accordion<?php echo $i+1;?>" >
									<i value="<?php echo $i+1; ?>" id="<?php echo $row['Batch_Code']; ?>" class="fa fa-plus-circle" style="color: #8FBC8F" data-toggle="tooltip" title="View Detailed Information"></i>
								</a>
							<?php //} ?>
							</td>
							<!-- End of Toggle -->
							<td><?php echo $i+1; ?></td>
							<td><?php echo $row['Batch_Code']; ?></td>
							<td><?php echo $row['Date_Generated']->format('M d, Y h:i A'); ?></td>
							<td><?php echo $row['Total_Records']; ?></td>
							<td>
								<input id="checkbox<?php echo $i+1; ?>" type="checkbox" <?php if(($i+1) != 1) echo 'disabled'; ?> 
								onchange="myFunction('<?php echo $row['Batch_Code'] ?>')"  data-toggle="toggle" data-on="Forwarded to Courier" data-off="Forward to Courier?" data-onstyle="success" data-offstyle="danger" data-width="220" data-height="40">
							</td>
						</tr>
						<tr >
							<td colspan="6" class="hiddenRow; all: unset" >
								<div id="accordion<?php echo $i+1; ?>" class="collapse" ></div>
								</td>
						</tr>
						<?php
						$i++;
						} ?> 
						<!-- Captures Total records for posting to the next page -->
						<input type="hidden" value="<?php echo $count; ?>" id="totalRecords" />
						<?php
					}
					sqlsrv_close($conn);
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
	
	<!-- Forward to Courier Modal (Prompt) -->
	<div id="toCourierModal" class="modal fade" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif"> 
		<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">						
						<h4 class="modal-title">Forward to Courier</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body"> 		
						<p>Are you sure you want to send the batch <div id="bc"></div> and all its records to Courier?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
						<div id="loader"></div>
					</div>
					<div class="modal-footer">
						<input id="cancelFwd" type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
						<button id="confirmFwd" class="btn btn-success" >
						<span>Yes, Forward to Courier</span>
							<i class="fa fa-check" style="horizontal-align: right;" ></i>
						</button>
					</div>
			</div>
		</div>
        </div><!--End of Courier Modal-->
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
	var flag = 0;
	var Global_Batch = "";
	function myFunction(y)
	{
		//Update Global Batch with value of Batch to be forwarded to courier
		Global_Batch = y;
		//reset flag to 0
		flag = 0;
		//BC Holds the div that contains batch code on the modal
		$("#bc").html('<label style="font-weight: bold; color: red">' + y + '</label>'); 
		//$("#toCourierModal").modal("show"); //here we display the prompt modal
		
	}
	
	
	$(document).ready(function(){
		var status="off";
		$('[data-toggle="tooltip"]').tooltip();
		//This Script handles the manipulation of expand and collapse (+) and (-)
			$('.fa').on('click',function(event)
			{

				var batch = $(this).attr('id');
				var i = $(this).attr('value');
				var dat = "batchcode=" +  batch;
				$(this).toggleClass("fa fa-minus-circle").toggleClass("fa fa-plus-circle");
				$('#accordion' + i).html('<center><i class="fa fa-spinner fa-spin fa-5x fa-fw" style="color: #8FBC8F"></i></center>');
				$.ajax({  
				url:"mail_room_bg_load_manifest_content_it_pre_inc.php",  
				method:"POST",  
				data:dat,  
				success:function(data)  
					{  
						 $('#accordion'+i).html("<div>" + data + "</div>");
						 if(status == "off")
						 {
							 status = "on";
						 }
						 else
						 {
							 status = "off";
							 $('#accordion'+i).html('');
						 }
					} 
				});

			})
	//End of expand and collapse script

	//Yes Button for Modal
	$("#confirmFwd").click(function(){
		flag = 1;
		$("#confirmFwd").prop('disabled', true);
		$("#cancelFwd").prop('disabled', true);
		//Now prepare data for server
		$("#loader").html('<center><i class="fa fa-cog fa-spin fa-2x fa-fw" style="color: #8FBC8F"></i></center>');
		var index = $("#indexer").val();
		var batch = "<?php echo $_SESSION['state_code'].'-MR-'.date('dmYHis').'-PRE-B-'; ?>";
		batch = batch.concat(index);
		var count = $('#totalRecords').val();
		var d = "it-batch-code=" + Global_Batch + "&mr-batch-code=" + batch + "&total-records=" + count;
		$.ajax({  
			url:"mail_room_bg_forward_it_to_courier.php",  
			method:"POST",  
			data:d,  
			success:function(data)  
			{  
				 if(data.includes("-MR-")){
					$("#loader").html('<center class="text-success">' + data + ' Page will refresh after closing this modal.</center>');
				 }
				else{
					$("#loader").html('<center class="text-danger">' + data + '</center>');
				}
			}  
	   });	
	});
	
	//Event Handler for Modal Closure
	$('#toCourierModal').on('hidden.bs.modal', function () {
		if(flag == 0)
		{
			$('#checkbox1').bootstrapToggle('off') ;
		}
		else{
			setTimeout(() => { window.location.assign("mail_room_despatch_trustees_to_courier.php"); });
		}
	})
	
	$('#checkbox1').change(function() {
		if($('#checkbox1').prop("checked") == true)
		{
			flag = 1;
			$("#toCourierModal").modal("show");
			if(flag == 0)
			{
				alert("Flag has been turned off.");
			}
		}
    })
});
</script>
</html>