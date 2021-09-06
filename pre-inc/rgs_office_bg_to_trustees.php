<?php
session_start();
//Check if user session does not exist or the user does not belong to the relevant dept, and role.
if ($_SESSION['user'] == null 
|| ( ($_SESSION['dept'] != "RGs Office") || ($_SESSION['role'] != "Pre Incorporation") ))
{
	header("Location: ../index.php");
}
//This is used for getting browser info, and OS of the Client.
$user_agent = $_SERVER['HTTP_USER_AGENT'];

include ('../dbconnection.php');
$sql="";

//JSON Parsing taking place below
$data = json_decode(stripslashes($_POST['data']));
$user= $_SESSION['user'];
$scode= $_SESSION['state_code'];
$count = count($data->companies);

//First and Foremost, We need to check for duplicate entry (Serial No, Ec Number etc. in the Database)
for ($i = 0; $i < $count; $i++){
	$sql = "SELECT * FROM tbl_RGs_Office WHERE Serial_No = '".$data->serials[$i]."' OR RC_Number = '". $data->rc_numbers[$i]."' OR ";
	$sql.= "Company_Name = '".$data->companies[$i]."' ";
	$result = sqlsrv_query($conn, $sql);
	if($result === false) {
		die(print_r("Duplicate::".sqlsrv_errors(), true));
	} 
	else
	{
		if(sqlsrv_has_rows($result)) //It means duplicate exists, so terminate
		{
			echo "Duplicate entry detected. (Check Serial No: <b>".$data->serials[$i]."</b>, or RC Number: <b>". $data->rc_numbers[$i]."</b>, or the Company Name: <b>".$data->companies[$i]."</b> ) and make the necessary coorection(s).";
			unset($data);
			return;
		}
	}
}

//Here, We're committing the Manifest records from the RGs Office into the corresponding DB
for ($i = 0; $i < $count; $i++){
	$sql = "INSERT INTO tbl_RGs_Office (Serial_No, RC_Number, Company_Name, Company_Type, Pre_or_Post, RGO_Batch, RGO_Cert_Gen_Date, ";
	$sql.= "RGO_Cert_Despatch_Date, RGO_Despatch_Status, RGO_Cert_Despatched_By, State_Code) VALUES ";
	$sql.="(".$data->serials[$i].",". $data->rc_numbers[$i]."";
	$sql.=",'".$data->companies[$i]."','IT', 'PRE', '".$data->cert_batch[$i]."',convert(varchar(10), '".$data->cert_date[$i]."', 102), ";
	$sql.="GETDATE(),'S-T-T','$user', '$scode')";
	$result = sqlsrv_query($conn, $sql);
	if($result === false) {
		die(print_r("INSERT::".sqlsrv_errors(), true));
	} 
}

//Here, we update the batch table with details of this transaction
//We Can get the Batch Number to commit to the DB by extracting the last affix figure on a batch code.
$bc = $data->cert_batch[0]; //E.g. FCT-RGO-15072020005344-PRE-B-1
$substring ='-';
$last_index= strripos($bc, $substring);
$index_no = substr($bc,$last_index+1);

//Save Records to Batches History
$sql = "INSERT INTO tbl_Batches_History (Batch_Number, Batch_Code, Pre_Or_Post, Department_Unit, Date_Generated, Total_Records, ";
$sql.="Created_By, State_Code) VALUES ('$index_no','$bc', 'Pre', '".$_SESSION['dept']."',GETDATE(),'$count','$user','$scode')";
$result = sqlsrv_query($conn, $sql);
if($result === false) {
	die(print_r("BATCHES HISTORY::".sqlsrv_errors(), true));
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
$event = "New Pre Incorporation Manifest RG -> Incorporated Trustees";
//Insert Into DB
$sql = "INSERT INTO tbl_Log VALUES ('$event',GETDATE(),'$user','$ip_addr','$user_OS','$device','$browser','$bc','$scode')";
$result = sqlsrv_query($conn, $sql);
if($result === false) {
	die(print_r("LOG::".sqlsrv_errors(), true));
}
//-------------------------------------------------------End of Log-------------------------------------------------------------
// Close the connection.
sqlsrv_close( $conn );
echo "Certificates Successfully Forwarded to Incorporated Trustees. <br />Batch Code: <strong>$bc</strong><br />";


?>