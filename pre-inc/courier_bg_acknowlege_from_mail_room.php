<?php
session_start();
//Check if user session does not exist or the user does not belong to the relevant dept, and role.
if ($_SESSION['user'] == null 
|| ( ($_SESSION['user_type'] != "Courier") ))
{
	header("Location: ../index.php");
}
$user = $_SESSION['user'];
$MR_Batch = $_POST['mr-batch-code'];
include ('../dbconnection.php');
$scode = $_SESSION['state_code'];
$initials = $_SESSION['user'];
$sql = "UPDATE tbl_Despatch_Tracking SET Courier_Ack_Date = GETDATE() WHERE MR_Batch_Code = '$MR_Batch' AND Initials = '$initials' ";
$sql.= "AND Courier_Ack_Date IS NULL";
$result = sqlsrv_query($conn, $sql);
if($result === false) {
	die(print_r(sqlsrv_errors(), true));
}
else
{
	//Now Update Log
	//----------------------------------------------------------Log---------------------------------------------------------------
	//Below commits entry into log table of the database
	//Now we include the script for getting OS, device, and Browser Info
	$details = get_browser(null, true);
	$browser = $details['browser'];
	$user_OS = $details['platform'];
	$device = $details['device_type'];

	//Get IP address of the client
	$bc = "-";
	require "../ip.php";
	$ip_addr = getIPAddress();
	$event = "Acknowledgement of Manifest by Courier (".$user.") from Mail Room";
	//Insert Into DB
	$sql = "INSERT INTO tbl_Log VALUES ('$event',GETDATE(),'$user','$ip_addr','$user_OS','$device','$browser','$bc','$scode')";
	$result = sqlsrv_query($conn, $sql);
	if($result === false) {
		die(print_r(sqlsrv_errors(), true));
	}
	//-------------------------------------------------------End of Log-------------------------------------------------------------
	
	// Close the connection.
	sqlsrv_close( $conn );
	echo "Manifest from Mail Room Successfully Acknowledged.";
}
?>