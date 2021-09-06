	<?php
	session_start();
	//Check if user session does not exist or the user does not belong to the relevant dept, and role.
	if ($_SESSION['user'] == null 
	|| ( ($_SESSION['dept'] != "Mail Room") || ($_SESSION['role'] != "Pre Incorporation") ))
	{
		header("Location: ../index.php");
	}
	include ('../dbconnection.php');
	$scode = $_SESSION['state_code'];
	$data = json_decode(stripslashes($_POST['data']));
	$user= $_SESSION['user'];
	$count = count($data->bn_numbers);
	$sql="";
	for ($i = 0; $i < $count; $i++){
		$sql = "UPDATE tbl_Business_Names SET BN_Despatch_Status = 'A-B-MR', MR_Received_By = '".$_SESSION['user']."' , ";
		$sql.=" MR_Receiving_Date = GETDATE() WHERE BN_Number = '".$data->bn_numbers[$i]."'";
		$result = sqlsrv_query($conn, $sql);
		if($result === false) {
			die(print_r("UPDATE::".sqlsrv_errors(), true));
		} 
	}
	//Now Populate Mail Room's Database
	$sql = "INSERT INTO tbl_Mail_Room (Serial_No, RC_Number, Company_Name, Company_Type, BN_Batch, Received_From_BN_On, State_Code) ";
	$sql.= "SELECT  BN_Number, BN_Number, Business_Name, 'BN', BN_Batch, MR_Receiving_Date,'".$_SESSION['state_code']."' FROM tbl_Business_Names ";
	$sql.= "WHERE tbl_Business_Names.BN_Number ";
	$sql.= " = ";
	for($i = 0; $i < $count; $i++)
	{
	if($i == $count-1)
		$sql.="'".$data->bn_numbers[$i]."'";
	else
		$sql.="'".$data->bn_numbers[$i]."' OR BN_Number = ";
	}
	$result = sqlsrv_query($conn, $sql);
	if($result === false) {
		die(print_r("INSERT::".sqlsrv_errors(), true));
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
	$event = "Acknowledgement of Manifest from Business Names -> Mail Room";
	//Insert Into DB
	$sql = "INSERT INTO tbl_Log VALUES ('$event',GETDATE(),'$user','$ip_addr','$user_OS','$device','$browser','$bc','$scode')";
	$result = sqlsrv_query($conn, $sql);
	if($result === false) {
		die(print_r("LOG::".sqlsrv_errors(), true));
	}
	//-------------------------------------------------------End of Log-------------------------------------------------------------	
	
	// Close the connection.
	sqlsrv_close( $conn );
	echo "Records successfully acknowledged by Mail Room.";
	?>