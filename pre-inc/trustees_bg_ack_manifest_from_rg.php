<?php
session_start();
if ($_SESSION['user'] == null || $_SESSION['dept'] != "Trustees"){
	header("Location: ../index.php");
}
include ('../dbconnection.php');
$data = json_decode(stripslashes($_POST['data']));
$user = $_SESSION['user'];
$scode = $_SESSION['state_code'];
$count = count($data->serials);
$sql="";


for ($i = 0; $i < $count; $i++){
	$sql = "UPDATE tbl_RGs_office SET RGO_Despatch_Status = 'A-B-T', IT_Received_By = '$user' , ";
	$sql.=" IT_Receiving_Date = GETDATE() WHERE Serial_No = '".$data->serials[$i]."'";
	$result = sqlsrv_query($conn, $sql);
	if($result === false) {
		die(print_r(sqlsrv_errors(), true));
	} 
}
//Now Populate IT's Database
$sql = "INSERT INTO tbl_Trustees (Serial_No, RC_Number, Company_Name, Company_Type, Received_From_RGO_On, RGO_Batch, State_Code) ";
$sql.= "SELECT Serial_No, RC_Number, Company_Name, 'IT', IT_Receiving_Date, RGO_Batch, '".$_SESSION['state_code']."' FROM tbl_RGs_office ";
$sql.= "WHERE tbl_RGS_office.Serial_No ";
$sql.= " = ";
for($i = 0; $i < $count; $i++)
{
	if($i == $count-1)
		$sql.="'".$data->serials[$i]."'";
	else
		$sql.="'".$data->serials[$i]."' OR Serial_No = ";
}
$result = sqlsrv_query($conn, $sql);
	if($result === false) {
		die(print_r(sqlsrv_errors(), true));
	} 

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
	$event = "Acknowledgement of Manifest from RG -> Incorporated Trustees";
	//Insert Into DB
	$sql = "INSERT INTO tbl_Log VALUES ('$event',GETDATE(),'$user','$ip_addr','$user_OS','$device','$browser','$bc','$scode')";
	$result = sqlsrv_query($conn, $sql);
	if($result === false) {
		die(print_r(sqlsrv_errors(), true));
	}
	//-------------------------------------------------------End of Log-------------------------------------------------------------	
	
	// Close the connection.
	sqlsrv_close( $conn );
	unset($data); //Free Array Memory
	unset($details); //Free Array Memory
	echo "Records successfully acknowledged.";
?>