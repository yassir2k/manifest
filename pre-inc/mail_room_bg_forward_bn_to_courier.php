<?php
	session_start();
	//Check if user session does not exist or the user does not belong to the relevant dept, and role.
	if ($_SESSION['user'] == null 
	|| ( ($_SESSION['dept'] != "Mail Room") || ($_SESSION['role'] != "Pre Incorporation") ))
	{
		header("Location: ../index.php");
	}
	$batch_code = $_POST['bn-batch-code'];
	$mr_code = $_POST['mr-batch-code'];
	$count = $_POST['total-records'];
	$user= $_SESSION['user'];
	$scode= $_SESSION['state_code'];
	$courier = "";
	$total = 0;
	$next_courier = "";
	//The next three lines deals with getting the Batch Number we populate the Batches History table with.
	$substring ='-';
	$last_index= strripos($mr_code, $substring);
	$index_no = substr($mr_code,$last_index+1);
	include ('../dbconnection.php');
	
	//We Check if a similar Batch-code exist on the Database. If the does, terminate the transaction
	$sql = "SELECT * FROM tbl_Despatch_Tracking WHERE Dept_Unit_Batch_Code = '$batch_code'";
	$result = sqlsrv_query($conn, $sql);
	if($result === false) {
		die(print_r(sqlsrv_errors(), true));
	}
	else
	{
		if(!(sqlsrv_has_rows($result)))
		{ //It means we can proceed with updating tbl_Mail_Room, then tbl_Despatch_Tracking. But first selecting the courier.
			
			//First, Get the despatching courier and its current total no. of rounds of despatch
			$sql = "SELECT Initials, Total_Rounds_of_Despatch FROM tbl_Courier_Companies ";
			$sql.= "WHERE Is_Active ! = 0 AND Task_Flag = 1";
			$result = sqlsrv_query($conn, $sql);
			if($result === false) 
			{
				die(print_r("First:: ".sqlsrv_errors(), true));
			}
			else
			{
				//Update $courier and $total, but if there is record.
				if(!(sqlsrv_has_rows($result)))//No Records
				{
					echo "No Record Exist for getting a despatcher. (Error Code: 1st)";
				}
				else
				{
					while($row = sqlsrv_fetch_array($result))
					{
						$courier = $row[0];
						$total = $row[1];
						$total++;
					}
					
					//Second step is getting the next courier
					$sql = "SELECT TOP 1 Initials FROM tbl_Courier_Companies WHERE Is_Active != 0 AND Task_Flag = 0 ";
					$sql.="ORDER By Total_Rounds_of_Despatch, Serial_No";
					$result = sqlsrv_query($conn, $sql);
					if($result === false) 
					{
						die(print_r("Second:: ".sqlsrv_errors(), true));
					}
					else
					{
						//Update $next_courier, but if there is record.
						if(!(sqlsrv_has_rows($result)))//No Records
						{
							echo "No Record Exist for getting the next despatcher. (Error Code: 2nd)";
						}
						while($row = sqlsrv_fetch_array($result))
						{
							$next_courier = $row[0];
						}
						
						//Thirdly, update the courier table by setting the current courier's flag to 0 and $counter++
						$sql = "UPDATE tbl_Courier_Companies SET Task_Flag = 0, Total_Rounds_of_Despatch = '$total' ";
						$sql.="WHERE Initials = '$courier'";
						$result = sqlsrv_query($conn, $sql);
						if($result === false) 
						{
							die(print_r("Third:: ".sqlsrv_errors(), true));
						}
						else
						{
							//Update is sucessful. Finally Set the Rotation Flag to the next courier
							$sql = "UPDATE tbl_Courier_Companies SET Task_Flag = 1 WHERE Initials = '$next_courier'";
							$result = sqlsrv_query($conn, $sql);
							if($result === false) 
							{
								die(print_r("Fourth:: ".sqlsrv_errors(), true));
							}
							else
							{
								//Now all set to start populating the operational tables
								//We start with updating Mail Room table
								
								$sql = "UPDATE tbl_Mail_Room SET Courier_Forwarded_to = '$courier', ";
								$sql.= "Courier_Forwarding_Date = GETDATE(), MR_Batch_Code = '$mr_code', Forwarded_By = '$user' ";
								$sql.= "WHERE BN_Batch = '$batch_code' ";
								$result = sqlsrv_query($conn, $sql);
								if($result === false) 
								{
									die(print_r("Mailroom:: ".sqlsrv_errors(), true));
								}
								else
								{
									//Mail Room Table Update is Successful
									//Now Insert into Despatch Tracking table
									
									$sql = "INSERT INTO tbl_Despatch_Tracking (Serial_No, RC_Number, Company_Name, Company_Type, ";
									$sql.= "Initials, MR_Despatched_By, MR_Despatched_Timestamp, Dept_Unit_Batch_Code, MR_Batch_Code,";
									$sql.= " State_Code) ";
									$sql.= "SELECT RC_Number, RC_Number, Company_Name, Company_Type,'$courier','$user',GETDATE(), ";
									$sql.= " '$batch_code','$mr_code','$scode' FROM tbl_Mail_Room WHERE BN_Batch = '$batch_code'";
									$result = sqlsrv_query($conn, $sql);
									if($result === false) 
									{
										die(print_r("Despatch Tracking:: ".sqlsrv_errors(), true));
									}
									else
									{
										//Insertion into Despatch Tracking is successful
										//Now Update batches history table and finally, the Log table
										//Save Records to Batches History
										$sql = "INSERT INTO tbl_Batches_History (Batch_Number, Batch_Code, Pre_Or_Post, Department_Unit, Date_Generated, Total_Records, ";
										$sql.="Created_By, State_Code) VALUES ('$index_no','$mr_code', 'Pre', '".$_SESSION['dept']."',GETDATE(),'$count','$user','$scode')";
										$result = sqlsrv_query($conn, $sql);
										if($result === false) {
											die(print_r("Batches History:: ".sqlsrv_errors(), true));
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
										$event = "New Manifest Despatch Mail Room -> Courier";
										//Insert Into DB
										$sql = "INSERT INTO tbl_Log VALUES ('$event',GETDATE(),'$user','$ip_addr','$user_OS','$device','$browser','$mr_code','$scode')";
										$result = sqlsrv_query($conn, $sql);
										if($result === false) {
											die(print_r("Log:: ".sqlsrv_errors(), true));
										}
										//-------------------------------------------------------End of Log-------------------------------------------------------------
										echo "Batch Successfully Forwarded to Courier (<b>$courier</b>). <br />REF: <strong>$mr_code</strong><br />";
										
									}
								}//End of Despatch Tracking
								
							}//End of Fourth
							
						}//End of Third
						
					}//End of Second
					
				}
				
			} //End of First
		}
		else //This means a Duplicate Batch-Code exist and the transaction terminates.
		{
			echo "Duplicate Batch code exist as this one.";
		}
	}
	sqlsrv_close($conn);
?>