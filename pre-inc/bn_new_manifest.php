<?php
//This script will be used in obtaining index value for batches from the Database
session_start();
//Check if user session does not exist or the user does not belong to the relevant dept, and role.
if ($_SESSION['user'] == null 
|| ( ($_SESSION['dept'] != "Business Names") || ($_SESSION['role'] != "Pre Incorporation") ))
{
	header("Location: ../index.php");
}
date_default_timezone_set("Africa/Lagos");
$index = 0;
include ('../dbconnection.php');
$sql = "SELECT TOP 1 Batch_Number FROM tbl_Batches_History WHERE Department_Unit = 'Business Names' ";
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <title>E - Manifest: New Business Names Manifest</title>
</head>

<body>
	<input type="hidden" id="indexer" value="<?php echo $index; ?>" />
	<input type="hidden" id="certCount" value="" />
	<div class="container-fluid">
	<div class="container-bg">
	<div class="fcta-header">
		<img src="images/cac-logo.png" class="cac-logo">
		<img src="images/coat-of-arms.png" class="coat-of-arm">
	</div>
  <!--Add Menu Here-->
  <?php require('menus/menu_bn_new_manifest.php'); ?>
  <!--End of Menu-->
  <ol class="breadcrumb" style="background-color: #F5F5F5; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
				<li class="breadcrumb-item"><a class="text-success" href="bn_dashboard.php">Dashboard</a></li>
				<li class="breadcrumb-item active text-secondary">File a New Manifest</li>
				<li class="breadcrumb-item active text-secondary">Business Names</li>
  </ol>
<div class="toptop" >
   <div class="row top-buffer">
        <div class="table-responsive">
			<div class="table-wrapper">
				<div class="" style="padding-bottom: 15px; background: #777; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
					<div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
						<div class="col-xs-6">
							<h2 style="margin: 5px 0 0; font-size: 30px"><b>Manifest Entry For Business Names (Pre Incorporation)</b></h2>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
						<div class="col-sm-4" align="center">
							<p style=" border-bottom: 1px solid #F5F5F5;"> Toggle the Number of Rows/Entries</p>
						</div>
						<div class="col-sm-4" align="center">
							<p style=" border-bottom: 1px solid #F5F5F5;"> Select Date of Certificates Generation</p>
						</div>
						<div class="col-sm-4" align="center">
							<p style=" border-bottom: 1px solid #F5F5F5;"> Add/Remove Row</p>
						</div>
					</div>
					<div class="row" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
						<div class="col-sm-4" align="center">
						<div class="form-group">
						<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<span class="fa fa-table" style="color: #8FBC8F"></span>
									</span>                    
								</div>
								<input id="entryNO" style="height:38px;" class="form-control" placeholder="Enter the number of entries" required type="number" value="" min="0" max="25"/>
							</div>
							
						</div>
						</div>
						<div class="col-sm-4" align="center">
							<div class="input-group date" data-provide="datepicker">
							<div class="input-group-prepend">
									<span class="input-group-text">
										<span class="fa fa-calendar" style="color: #8FBC8F"></span>
									</span>                    
								</div>
								<input id="fDate" type="date" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-4" align="center">
							<div class="row">
								<div class="col-sm-6" align="right">
									<button disabled id="addSingleRow" class="btn bg-success text-white"><i class="fa fa-plus-circle"></i>	</button>
								</div>
								<div class="col-sm-6" align="left">
									<button disabled id="removeSingleRow" class="btn bg-danger text-white"><i class="fa fa-minus-circle"></i>	</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-12">
							<!-- This is where table is displayed. -->
							<div class="inner" id="tblS">
							</div>
						</div>
					</div>
				</div>
				<div class="row align-items-center">
					<div class="col-sm-3">
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<button disabled id="submitR" type="submit" class="btn btn-success btn-block"><i class="fa fa-send"></i>
								<span style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Forward to Mail Room</span>
							</button>
						</div>
					</div>
					<div class="col-sm-3">
					</div>
				</div>
				<br />

			</div>
		</div>        
    </div>
	</div>
	<br />
	<br />
<!-- Forward to Mail Room Modal (Prompt) -->
	<div id="toMailRoomModal" class="modal fade" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif"> 
		<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">						
						<h4 class="modal-title">Forward to Mail Room</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body"> 		
						<p>Are you sure you want to forward this manifest to Mail Room? </p>
						<p>Total records to be forwarded: <div id="bc"></div></p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
						<div id="loader"></div>
					</div>
					<div class="modal-footer">
						<input id="cancelFwd" type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
						<button id="confirmFwd" class="btn btn-success" >
						<span>Yes, Forward to Mail Room</span>
							<i class="fa fa-check" style="horizontal-align: right;" ></i>
						</button>
					</div>
			</div>
		</div>
        </div><!--End of Mail Room Modal-->
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
  <script src="js/bootstrap4-toggle.min.js"></script>
  <script src="js/mindmup-editabletable.js"></script>
  <script src="js/bootstrap-input-spinner.js"></script>
  <script>
  var flag = 0; //This is used in knowing whether yes in modal is clicked or not
  $("#spinner").hide();


  $('#entryNO')
  .change(function () {
	  $( "#tblS" ).empty() //Clear any previously generated table
	    var rows = this.value; //here's your number of rows and columns
		var table = $('<table  id="mainTable" width="100%" class="table-bordered table-sm" style="font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; font-size:16px"><thead style="background-color:#EEE"><tr><th style="width:5%">NO.</th><th style="width:55%">BUSINESS NAME</th><th style="width:20%">BN NUMBER</th></tr></thead><tbody>');
		
		for(var r = 0; r < rows; r++)
		{
			if(rows > 25)
			{
				alert("Number of Rows cannot exceed a maximum of 25.");
				return;
			}
			else
			{
				var tr = $('<tr tabindex="0">');
				if(r != 0)
					tr = $('<tr>');
				$('<th style="background-color:#EEE">'+(r+1)+'</th><td></td><td></td></tr>').appendTo(tr); //fill in your cells with something meaningful here
				tr.appendTo(table);
			}
		}
		var foot = $('</tbody></table>');
		foot.appendTo(table);
		if(rows > 0)
		{
			$("#submitR").prop("disabled", false);
			$("#addSingleRow").prop("disabled", false);
			$("#removeSingleRow").prop("disabled", false);
		}
		if(rows == 0)
		{
			$("#submitR").prop("disabled", true);
			$("#addSingleRow").prop("disabled", true);
			$("#removeSingleRow").prop("disabled", true);
		}
		table.appendTo($( "#tblS" ));
		
		//Main Plugin that turns the table to be editable
		$('#mainTable').editableTableWidget().find('tr[tabindex="0"] td:nth-child(2)').focus();
		$('#table').editableTableWidget({
		cloneProperties: ['background', 'border', 'outline']});
    
});

//This Shows Modal
$("#submitR").click(function(){
	var table = document.getElementById('mainTable');
	var cnt = table.rows.length -1;
	$("#bc").html('<label style="font-weight: bold; color: red">' + cnt + '</label>');
	$("#toMailRoomModal").modal("show");
});

//This handles event when modal is closed

$('#toMailRoomModal').on('hidden.bs.modal', function () {

	if(flag == 1){
		setTimeout(() => { window.location.assign("bn_new_manifest.php"); });
	}
})

//This activates when Yes Button of Modal is Clicked
$("#confirmFwd").click(function(){
	if(!$('#fDate')[0].checkValidity()) {
	  // If the form is invalid, submit it. The form won't actually submit;
	  // this will just cause the browser to display the native HTML5 error messages.
	  alert("Please select the date of certificate generation.");
	  $.post("bn_new_manifest.php");
	  return;
	}
  var table = document.getElementById('mainTable');
  var companies = [];
  var rc_numbers = [];
  var cert_batch = [];
  var cert_date = [];
  //Conversion of Datetime to format recognized by the server
  var today = $("#fDate").val();
  var index = $("#indexer").val();
   var batch = "<?php echo $_SESSION['state_code'].'-BN-'.date('dmYHis').'-PRE-B-'; ?>";
   batch = batch.concat(index);
  //First, We Check For Empty Fields and duplicate in all the spreadsheet cells.
  for (var r = 1; r <= table.rows.length - 1; r++) {        // EACH ROW IN THE TABLE Except the Header.
            for (c = 1; c <= table.rows[r].cells.length - 1; c++) {      // EACH CELL IN A ROW Except the leftmost ones.
                 if(table.rows[r].cells[c].innerHTML.replace(/^\s+|\s+$/g, "").length == 0)
				 {
					 alert("Empty Field(s) detected in the spreadsheet. Please complete missing field(s).");
					 return 0;
				 }
				 else{
					 if(c == 1)
					 {
						 if(!(companies.include(table.rows[r].cells[c].innerHTML))) //If not in array else flag it
						 {
							companies.push(table.rows[r].cells[c].innerHTML);	
						 }
						 else
						 {
							alert(table.rows[r].cells[c].innerHTML + " has been duplicated in this form. Make the necessary correction.");
							return false;
						 }							 
					 }
					 if(c == 2)
					 {
						 if(!(rc_numbers.include(table.rows[r].cells[c].innerHTML))) //If not in array else flag it
						 {
							rc_numbers.push(table.rows[r].cells[c].innerHTML);	
						 }
						 else
						 {
							alert(table.rows[r].cells[c].innerHTML + " has been duplicated in this form. Make the necessary correction.");
							return false;
						 }	
						 cert_date.push(today);
						 cert_batch.push(batch);
					 }
				 }
            }
  }
  //At this stage, we're sure there aren't any empty field(s). We can proceed with data capture
  //Diabled Modal Buttons
	flag = 1;
	$("#confirmFwd").prop('disabled', true);
	$("#cancelFwd").prop('disabled', true);
	//Now prepare data for server
	$("#loader").html('<center><i class="fa fa-cog fa-spin fa-2x fa-fw" style="color: #8FBC8F"></i></center>');
  //End of Disable Modal Buttons
  var d = 'data={"companies":["' + companies.join('","') + '"],"rc_numbers":["' + rc_numbers.join('","') + '"],"cert_date":["' + cert_date.join('","') + '"],"cert_batch":["' + cert_batch.join('","') + '"]}';
	$.ajax({  
                url:"bn_bg_to_mail_room.php",  
                method:"POST",  
                data:d,  
                success:function(data)  
                {  
					companies.splice(0, companies.length);
					rc_numbers.splice(0, rc_numbers.length);
					cert_batch.splice(0, cert_batch.length);
					cert_date.splice(0, cert_date.length);
					if(data.includes("-PRE-B")){
						 $("#loader").html('<center class="text-success">' + data + ' <br />Page will refresh after closing this modal.</center>');
					}
					else{
						$("#loader").html('<center class="text-danger">'+ data +'</center>');
					}
                }  
           });	
});

//Add Row
$("#addSingleRow").click(function(){
	var rowCount = $('#mainTable tr').length;
	if (rowCount > 25)
	{
		alert("Number of Rows cannot exceed a maximum of 25.");
		return;
	}
	else
	{
		var newrow = $('<tr><th style="background-color:#EEE">'+(rowCount)+'</th><td></td><td></td><td></td></tr>');
		$('#mainTable').append(newrow); //class="table-bordered table-sm"
		$('#mainTable').editableTableWidget();
		if($('#mainTable tr').length > 1)
		{
			$('#removeSingleRow').prop("disabled", false);
			$("#submitR").prop("disabled", false);
		}
	}
});

//Remove a Row
$("#removeSingleRow").click(function(){
	$('#mainTable tr:last').remove();
	if($('#mainTable tr').length == 1)
	{
		$(this).prop("disabled", true);
		$("#submitR").prop("disabled", true);
	}
});
</script>
</html>