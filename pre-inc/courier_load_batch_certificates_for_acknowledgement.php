<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/manifest-mini-css.css">
  </head>
<?php
	//This script will be used in obtaining index value for batches from the Database
	session_start();
	if ($_SESSION['user'] == null 
	|| ( ($_SESSION['user_type'] != "Courier") ))
	{
		header("Location: ../index.php");
	}
	if(	!(isset($_POST['mr-batchcode'])))
	{
		echo "Missing Field(s)";
		return 0;
	}
	date_default_timezone_set("Africa/Lagos");
	$batchcode = $_POST['mr-batchcode'];
?>
	<table cellpadding="2" cellspacing="2" class="minitable" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif">
						<thead style="background-color: #f00">
							<tr>
								<th align = "left" width = "50">No.</th>
								<th align = "left" width = "100">Serial No</th>
								<th align = "left" width = "100">RC Number</th>
								<th align = "left" width = "300">Company Name</th>
								<th align = "left" width = "250">Received From MR On</th>
								<th align = "left" width = "150">Mail Room Staff</th>
							</tr>
						</thead>
<?php
	include ('../dbconnection.php');
	$sql = "SELECT Serial_No, RC_Number, Company_Name, MR_Despatched_Timestamp, MR_Despatched_By FROM tbl_Despatch_Tracking ";
	$sql.="WHERE MR_Batch_Code = '$batchcode' ";
	$result = sqlsrv_query($conn, $sql);
	if($result === false) {
			die(print_r(sqlsrv_errors(), true));
		}
	else
	{
		if (sqlsrv_has_rows( $result ))
		{
			$i = 0;
			while($row = sqlsrv_fetch_array($result))
			{
				?>
					<tr >
						<td><?php echo $i+1; ?></td>
						<td><?php echo $row['Serial_No'];?></td>
						<td><?php echo $row['RC_Number'];?></td>
						<td><?php echo $row['Company_Name'];?></td>
						<td><?php echo $row['MR_Despatched_Timestamp']->format('M d, Y h:i A');?></td>
						<td><?php echo $row['MR_Despatched_By'];?></td>
					</tr>
				<?php
				$i++;
			}
		}
		else
		{
			?>
				<tr>
					<td colspan = "6">Record does not exist for this manifest (Rare though in this case).</td>
				</tr>
			<?php
		}
		?></table><?php
		sqlsrv_close($conn);
	}
?>
</html>