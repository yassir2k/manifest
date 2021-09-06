<?php
session_start();
if ($_SESSION['user'] == null || $_SESSION['dept'] != "Trustees"){
	header("Location: ../index.php");
}
include ('../dbconnection.php');
$data = json_decode(stripslashes($_POST['data']));
$user= $_SESSION['user'];
$scode= $_SESSION['state_code'];
$count = count($data->serials);
$sql="";
for ($i = 0; $i < $count; $i++){
	$sql = "UPDATE tbl_Trustees SET IT_Manifest_Prepared_By = '".$_SESSION['user']."', IT_Despatch_Status = 'S-T-MR', ";
	$sql.= "IT_Manifest_Preparation_Date = GETDATE(), IT_Batch = '".$data->cert_batch[$i]."' ";
	$sql.=" WHERE Serial_No = '".$data->serials[$i]."'";
	$result = sqlsrv_query($conn, $sql);
	if($result === false) {
		die(print_r("UPDATE::".sqlsrv_errors(), true));
	} 
}
//Here, we update the batch table with details of this transaction
//We Can get the Batch Number to commit to the DB by extracting the last affix figure on a batch code.
$bc = $data->cert_batch[0]; //E.g. FCT-IT-15072020005344-PRE-B-1
$substring ='-';
$last_index= strripos($bc, $substring);
$index_no = substr($bc,$last_index+1);


$sql = "INSERT INTO tbl_Batches_History (Batch_Number, Batch_Code, Pre_Or_Post, Department_Unit, Date_Generated, Total_Records, ";
$sql.="Created_By, State_Code) VALUES ('$index_no','$bc', 'Pre', '".$_SESSION['dept']."',GETDATE(),'$count','$user','$scode')";
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
require "../ip.php";
$ip_addr = getIPAddress();
$event = "Forwarding of Manifest from Incorporated Trustees -> Mail Room";
//Insert Into DB
$sql = "INSERT INTO tbl_Log VALUES ('$event',GETDATE(),'$user','$ip_addr','$user_OS','$device','$browser','$bc','$scode')";
$result = sqlsrv_query($conn, $sql);
if($result === false) {
	die(print_r("LOG::".sqlsrv_errors(), true));
}
//-------------------------------------------------------End of Log-------------------------------------------------------------	

// Close the connection.
sqlsrv_close( $conn );
unset($data); //Free Array Memory
unset($details); //Free Array Memory
echo "Record(s) successfully forwarded to Mail Room.";
?>