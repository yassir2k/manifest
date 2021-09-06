<?php
	session_start();
	//Check if user session does not exist or the user does not belong to the relevant dept, and role.
	if ($_SESSION['user'] == null 
	|| ( ($_SESSION['dept'] != "Mail Room") 
	|| ($_SESSION['role'] != "Post Incorporation") ))
	{
		header("Location: ../index.php");
	}
	if(!(isset($_POST['data'])))
	{
		return 0;
	}
	else
	{
		$data = json_decode(stripslashes($_POST['data']), true);
		$user = $_SESSION['user'];
		$scode = $_SESSION['state_code'];
		
		$counter = sizeof($data);
		include ('../dbconnection.php');
		$forward_to = "";
		$Sql = "";
		
		
		for($i = 0; $i < $counter; $i++)
		{
			$rrr_ref = "R-".strtoupper(random_strings(14));
			$nature_ref = "N-".strtoupper(random_strings(14));
			$trans_id = strtoupper(random_strings(20));
			
			$details = str_replace ("'","''", $data[$i]["details"]);
			$Sql = "INSERT INTO tbl_Receive_Post_Applications	(MR_Batch_Ref,	Company_Name,	RC_Number,	Company_Type,	Nature_Reference, ";
			$Sql.= "Presenter_Name,	Presenter_Phone,	Presenter_Email,	Courier_Incoming,	Date_Received,	Destinating_Dept,	";
			$Sql.= "Forwarding_Date,	Forwarded_By,	Courier_Outgoing,	Payment_Reference,	No_of_Copies,	Details,	Confirmed_By_FinAcc,	";
			$Sql.= "Audited,	Task_Status,	Transaction_ID,	State_Code) ";
			$Sql.= "VALUES ('".$data[0]["batch"]."',	'".$data[$i]["comp"]."', '".$data[$i]["rc"]."',	'".$data[$i]["comptype"]."', '$nature_ref',	";
			$Sql.= " '".$data[$i]["p_name"]."',	'".$data[$i]["p_mobile"]."',	'".$data[$i]["p_email"]."',	'".$data[$i]["c_incoming"]."', ";
			$Sql.= " convert(varchar(10), '".$data[$i]["date_recv"]."', 102), '".$data[$i]["dest"]."',	GETDATE(),	'$user',	";
			$Sql.= " '".$data[$i]["c_outgoing"]."',	'$rrr_ref',	'".$data[$i]["copies"]."',	'$details', 0, 0, 0, '$trans_id', '$scode')";
			$result = sqlsrv_query($conn, $Sql);
			if($result === false) {
				die(print_r("INSERT::[$i]".sqlsrv_errors(), true));
			} 
			
			//Now we populate the RRR Table with RRR Details
			for ($j = 0; $j < count($data[$i]["rrr"]); $j++)
			{
				$Sql = "INSERT INTO tbl_RRR_History VALUES ('".$data[$i]["rrr"][$j]."', '".$data[$i]["amount"][$j]."', '".$data[$i]["rc"]."'";
				$Sql.= ", GETDATE(), '$rrr_ref', '$trans_id', '$scode')";
				$result = sqlsrv_query($conn, $Sql);
				if($result === false) {
					die(print_r("INSERT RRR::[$i]".sqlsrv_errors(), true));
				} 
			}
			
			//Now Insert Nature of Application
			for ($j = 0; $j < count($data[$i]["rrr"]); $j++)
			{
				$Sql = "INSERT INTO tbl_Nature_of_Application VALUES ('".$data[$i]["rc"]."', '".$data[$i]["comp"]."', '".$data[$i]["comptype"]."', ";
				$Sql.= " '$rrr_ref', '".$data[$i]["nature"][$j]."', '$nature_ref', '$trans_id', '$scode')";
				$result = sqlsrv_query($conn, $Sql);
				if($result === false) {
					die(print_r("INSERT NATURE::[$i]".sqlsrv_errors(), true));
				} 
			}
						
		}
		
		
		//Here, we update the batch table with details of this transaction
		//We Can get the Batch Number to commit to the DB by extracting the last affix figure on a batch code.
		$bc = $data[0]["batch"]; //E.g. FCT-15072020005344-MR-POST-BATCH-1
		$substring ='-';
		$last_index= strripos($bc, $substring);
		$index_no = substr($bc,$last_index+1);

		//Save Records to Batches History
		$sql = "INSERT INTO tbl_Batches_History (Batch_Number, Batch_Code, Pre_Or_Post, Department_Unit, Date_Generated, Total_Records, ";
		$sql.="Created_By, State_Code) VALUES ('$index_no','$bc', 'Post', '".$_SESSION['dept']."',GETDATE(),'$counter','$user','$scode')";
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
		require "../ip.php";
		$ip_addr = getIPAddress();
		$event = "New Post Incorporation Manifest MR -> Finance & Account";
		//Insert Into DB
		$sql = "INSERT INTO tbl_Log VALUES ('$event',GETDATE(),'$user','$ip_addr','$user_OS','$device','$browser','$bc','$scode')";
		$result = sqlsrv_query($conn, $sql);
		if($result === false) {
			die(print_r(sqlsrv_errors(), true));
		}
		//-------------------------------------------------------End of Log-------------------------------------------------------------
		echo "Records Successfully Captured, and Forwarded to Finance & Account for Verification.";
		sqlsrv_close( $conn );
	}
	
	
	
	function random_strings($length_of_string) {  
		return substr(bin2hex(random_bytes($length_of_string)), 0, $length_of_string); 
	}
?>