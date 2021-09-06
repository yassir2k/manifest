<?php
	if(!(isset($_POST['user_id']))
	||!(isset($_POST['name']))
	||!(isset($_POST['surname']))
	||!(isset($_POST['email']))
	||!(isset($_POST['department']))
	||!(isset($_POST['role']))
	||!(isset($_POST['state'])))
	{
		echo "Variables undeclared.";
		return;
	}
	else
	{
		include ('../dbconnection.php');
		$user_id = $_POST['user_id'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$dept = $_POST['department'];
		$role = $_POST['role'];
		$state = $_POST['state'];
		$secure_code = random_strings(32);
		
		//Now we check for duplicate
		if(checkEmail($email) == 1)
		{
			echo "Email exist";
		}
		else if(checkUsername($user_id) == 1)
		{
			echo "Username exist";
		}
		else //Good to go...Commit to db
		{
			$query = "INSERT INTO tbl_Schedule_officers (Login_ID, First_Name, Surname, Email, Department, Role, State_Code, Date_Requested, Email_Verified, New_Account_Refcode) ";
			$query.= "VALUES ('$user_id','$name','$surname','$email','$dept','$role','$state', GETDATE(), 0, '$secure_code')";
			$result = sqlsrv_query($conn, $query);
			if($result === false) {
			die(print_r("INSERT::".sqlsrv_errors(), true));
			}
			else{
				//Now send verifiction link to email of the user
				$to = $email;
				$subject = "CAC E-Manifest Portal Password Recovery Details";
				$message = "
				<html>
				<head>
				<title>Password Recovery Details</title>
				</head>
				<body>
				<table>
				<tr>
					<td><p>Dear $name $surname, <br />Please click the link below to your email for CAC E - Manifest Portal: </p></td>
				</tr>
				<tr>
					<td><a href='http://localhost/manifest/pre-inc/new_user_account_email_verification.php?hash=$secure_code'>http://localhost/manifest/pre-inc/new_user_account_email_verification.php?hash=$secure_code</a></td>
				</tr>
				<tr>
					<td><p>Please, be reminded that this link can <b>ONLY</b> be used once.</p></td>
				</tr>
				<tr>
					<td><p>Kind Regards,<br />Yassir Yahaya<br />Administrator</p></td>
				</tr>
				</table>
				</body>
				</html>
				";

				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: <cacpassowrdrecovery@gmail.com>' . "\r\n"; 

				$success = mail($to,$subject,$message,$headers);
				if (!$success) {
					print_r(error_get_last()['message']);
				}
				else{
					echo "A verification link has been sent to the email address you provided.";
				}
			}
		}
	}
	
	
	function checkEmail($str)
	{
		include ('../dbconnection.php');
		$query = "SELECT * FROM tbl_Schedule_officers WHERE Email='$str'";
		$result = sqlsrv_query($conn, $query);
		$count = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
		if($count > 0) {
		  return 1;
		}else{
		  return 0;
		}
	}
	
	function checkUsername($str)
	{
		include ('../dbconnection.php');
		$query = "SELECT * FROM tbl_Schedule_officers WHERE Login_ID='$str'";
		$result = sqlsrv_query($conn, $query);
		$count = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
		if($count > 0) {
		  return 1;
		}else{
		  return 0;
		}
	}
	// This function will return a random string of specified length 
	function random_strings($length_of_string) {  
	// random_bytes returns number of bytes 
	// bin2hex converts them into hexadecimal format 
	return substr(bin2hex(random_bytes($length_of_string)), 0, $length_of_string); 
	}

?>