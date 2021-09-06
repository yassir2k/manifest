<?php
	//Let us check for duplication of RRR Receipts
	
	if(!(isset($_POST['rrr'])))
	{
		return 0;
	}
	include ('../dbconnection.php');
	$rrr = $_POST['rrr'];
	$Sql = " SELECT * FROM tbl_RRR_History WHERE RRR_Number = '$rrr' ";
	$result = sqlsrv_query($conn, $Sql);
	if($result === false) {
		die(print_r("CHECKING RRR::".sqlsrv_errors(), true));
	} 
	$cnt = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
	if($cnt > 0) //It means a duplicate has been detected
	{
		echo "This RRR has been used by RC: ".$cnt['RC_Number'].", with amount: ".$cnt['Amount']." on ".$cnt['Date_Captured']->format('M d, Y')."";
	}
	else
	{
		echo "This RRR is free for use, subject to validation by F&A.";
	}
?>