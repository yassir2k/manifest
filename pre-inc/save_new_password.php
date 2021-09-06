<?php
if(	!(isset($_POST['new']))
	|| !(isset($_POST['confirm']))
	|| !(isset($_POST['user']))
	|| !(isset($_POST['scode']))
	|| !(isset($_POST['hash'])))
	{
		echo '<center><br /><br /><br /><br /><br /><br /><br /><br /><div style="width:50%" class="alert alert-danger text-center" role="alert"><b>Access Denied !!!</b></div></center>';
		return 0;
	}
else
{
	include ('../dbconnection.php');
	$new_password = str_replace ("'","''", $_POST['new']);
	$confirm_password = str_replace ("'","''", $_POST['confirm']);
	$user = $_POST['user'];
	$hash = $_POST['hash'];
	$scode = $_POST['scode'];
	if($new_password != $confirm_password)
	{
		echo "Your new password and retyped password do not match.";
		return 0;
	}
	else
	{
		$sql = "UPDATE tbl_Schedule_officers SET Login_Password = '$new_password' WHERE Login_ID = '$user'";
		$result = sqlsrv_query($conn, $sql);
		if($result === false) {
			die(print_r("UPDATE::".sqlsrv_errors(), true));
		}
		else{
			//Now populate log
			//Now we include the script for getting OS, device, and Browser Info
			$details = get_browser(null, true);
			$browser = $details['browser'];
			$user_OS = $details['platform'];
			$device = $details['device_type'];
			//Get IP address of the client
			$bc = "-";
			require "../ip.php";
			$ip_addr = getIPAddress();
			$event = "Password Reset Link Sent to -> ".$user."";
			//Insert Into DB
			$sql = "INSERT INTO tbl_Log VALUES ('$event',GETDATE(),'$user','$ip_addr','$user_OS','$device','$browser','$bc','$scode')";
			$result = sqlsrv_query($conn, $sql);
			if($result === false) {
				die(print_r("LOG::".sqlsrv_errors(), true));
			}
			echo 'Password Successfully Reset.';
		}
	}
}
?>