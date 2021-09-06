<?php
session_start();
$SESSION['ser']="";
$serial="";
$star="";
if(isset($_POST['serial']))
{
	$SESSION['ser'] = $_POST['serial'];
	$serial = $_POST['serial'];
	echo "<script>alert('Haba dai!');</script>";
	include ("../dbconnection.php"); 
	$query = "SELECT Company_Name FROM tbl_Customer_service WHERE Serial_No='$serial'";
	$result = sqlsrv_query($conn,$query);
	if(!(sqlsrv_has_rows($result)))
	{
		
	}
	else{
		while($rows = sqlsrv_fetch_array($result))
		{
			$star = $rows[0];
		}
	}
	return;
}
?>
<!DOCTYPE html>
<html lang="en">
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
var temp = "";

});
</script>

  <title>Manifest Acknowledgement - Registry</title>
</head>

<body>
	<div class="container-fluid">
	<div class="container-bg">
	<div class="fcta-header">
			<img src="images/cac-logo.png" class="cac-logo">
			<img src="images/coat-of-arms.png" class="coat-of-arm">
	</div>
  <!--Add Menu Here-->
  <?php require('menus/menu_mail_room_ack.php')?>
  <!--End of Menu-->
  <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item"><a class="text-success" href="#">Home</a></li>
            <li class="breadcrumb-item"><a class="text-success" href="#">Products</a></li>
            <li class="breadcrumb-item active">Accessories</li>
        </ol>
   <div class="toptop" style="margin-top: 20px">
   <div class="row top-buffer">
        <div class="table-responsive">
			<div class="table-wrapper">
				<div style="padding-bottom: 15px; background: #0FBC8F; color: #fff; padding: 16px 30px; margin: -20px -25px 10px; border-radius: 3px 3px 0 0;">
					<div class="row" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
						<div class="col-xs-6">
							<h2 style="margin: 5px 0 0; font-size: 28px"><b>Customer Service - </b>Approve Certificate Collection Request</h2>
						</div>
						<div class="col-xs-6 ml-auto align-self-center">
							<input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for RC Number..." title="Type in a RC Number" style="background-image: url(images/searchicon.png);  background-position: 8px 8px;  background-repeat: no-repeat;
  width: 350px;
  color: pink;
  font-size: 16px;
  padding: 6px 20px 6px 40px;
  border: 1px solid #ddd">						
						</div>
					</div>
				</div>
				<table id="myTable" class="table table-striped table-hover" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
					<thead>
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th>Serial Number</th>
							<th>RC Number</th>
							<th>Type</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<?php
					//Now we read all forwarded manifest from Registry to CS
					include ("../dbconnection.php"); 
					$query = "SELECT Company_Name, Serial_No, RC_Number, Company_Type, MR_Despatch_Status, Certificate_Collected_By FROM tbl_Mail_Room WHERE (MR_Despatch_Status = 'Ready For Collection')";
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
							<td><?php echo $row['Company_Type']; ?></td>
							<td><i class="fa fa-circle text-success fa-sm"></i>	<?php echo $row['CS_Despatch_Status']; ?></td>
							<td class="YY">
								<a href="#approveModal" data-toggle="modal" ><i class="fa fa-check-circle-o" style="color: #8FBC8F" data-toggle="tooltip" title="Approve Collection Request"></i></a>
								<?php if($row['Certificate_Collected_By'] == null){
								?>	<a href="#addModal"  data-toggle="modal"><i class="fa fa-pencil-square-o text-warning" data-toggle="tooltip" title="Add new Certificate Collection Request"></i></a>
								<?php } ?>
								
							</td>
						</tr>
						<?php
						$i++;
						}
					}	sqlsrv_close($conn);
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
	
<!-- Add Modal HTML -->
	<input id="serial" name="serial" type="hidden" value="">
	<div id="addModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Collection Request Form </h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input id="name" value = "" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input  type="text" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
    </div> <!--End of Row container-bg-->
    <!-- -----------------------------------------End of Main Content------------------------------------------ -->
   <!------------------------------------------------------Footer----------------------------------------- -->
	<!-- Footer -->
	<footer class="page-footer font-small bg-dark">

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
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

$("td").on('click', function(e) { 
temp = $(this).closest('tr').attr('class');

	//$("#serial").val(temp);
	//$("#name").val(temp);
	//alert(<?php echo "$serial"; ?>);
	$.post("cs_confirm_ack_cert_customers.php", {serial: temp}, function(data) {
    
  });
});
</script>
</html>