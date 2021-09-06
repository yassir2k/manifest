<?php
if(	!(isset($_POST['user_id']))
	|| !(isset($_POST['email'])))
	{
		echo '<center><br /><br /><br /><br /><br /><br /><br /><br /><div style="width:50%" class="alert alert-danger text-center" role="alert"><b>Access Denied !!!</b></div></center>';
		return 0;
	}
else
{
	include ('../dbconnection.php');
	$user_id = str_replace ("'","''", $_POST['user_id']);
	$email = str_replace ("'","''", $_POST['email']);
	$sql = "SELECT * FROM tbl_Schedule_officers WHERE Login_ID = '$user_id' AND Email = '$email'";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$result = sqlsrv_query($conn, $sql,  $params, $options );
	if($result === false) {
		die(print_r(sqlsrv_errors(), true));
	}
	else{
		$row_count = sqlsrv_num_rows( $result );  
		if ($row_count == 0)
		{
		   echo "This user account does not exist.";
		   die(print_r(sqlsrv_errors(), true));
		}
		else
		{ 
			//Meaning record is is available, Now generate random bytes
			$row = sqlsrv_fetch_array($result);
			$name = $row['First_Name'];
			$surname = $row['Surname'];
			$secure_code = random_strings(32);
			$scode = $row['State_Code'];
			$sql_ = "UPDATE tbl_Schedule_officers SET Password_Recovery_Code = '$secure_code' WHERE Login_ID = '$user_id'";
			$result_ = sqlsrv_query($conn, $sql_);
			if($result_ === false) {
				die(print_r("SELECT::".sqlsrv_errors(), true));
			} 
			else //Forward Email
			{
				$to = $email;
				$subject = "CAC E - Manifest Portal Password Recovery Details";
				$message = "
				<html>
				<head>
				<title>Password Recovery Details</title>
				</head>
				<body>
				<table>
				<tr>
					<td><p>Dear $name $surname, <br />Please click the link below to reset your password for CAC E-Reg Portal: </p></td>
				</tr>
				<tr>
					<td><a href='http://localhost/manifest/pre-inc/password_recovery.php?hash=$secure_code'>http://localhost/manifest/pre-inc/password_recovery.php?hash=$secure_code</a></td>
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
				else
				{
					//Now we include the script for getting OS, device, and Browser Info
					$details = get_browser(null, true);
					$browser = $details['browser'];
					$user_OS = $details['platform'];
					$device = $details['device_type'];

					//Get IP address of the client
					$bc = "-";
					require "../ip.php";
					$ip_addr = getIPAddress();
					$event = "Password Reset Link Sent to -> ".$email."";
					//Insert Into DB
					$sql = "INSERT INTO tbl_Log VALUES ('$event',GETDATE(),'$user_id','$ip_addr','$user_OS','$device','$browser','$bc','$scode')";
					$result = sqlsrv_query($conn, $sql);
					if($result === false) {
						die(print_r("LOG::".sqlsrv_errors(), true));
					}
					echo "Password reset link successfully sent to your email.";
				}
			}
			
		}
	}
}


// This function will return 
// A random string of specified length 
function random_strings($length_of_string) {  
// random_bytes returns number of bytes 
// bin2hex converts them into hexadecimal format 
return substr(bin2hex(random_bytes($length_of_string)), 0, $length_of_string); 
}
?>