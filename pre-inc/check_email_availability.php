<?php
require("../dbconnection.php");

if(!empty($_POST["email"])) {
	$email = $_POST["email"];
	$query = "SELECT * FROM tbl_Schedule_officers WHERE Email='$email'";
	$result = sqlsrv_query($conn, $query);
	$count = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
	if($count > 0) {
      echo "This email has been used already by a different account";
	}else{
      echo "This email is available for use";
	}
	sqlsrv_close($conn);
}
?>