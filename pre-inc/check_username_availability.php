<?php
require("../dbconnection.php");

if(!empty($_POST["username"])) {
	$uname = $_POST["username"];
	$query = "SELECT * FROM tbl_Schedule_officers WHERE Login_ID='$uname'";
	$result = sqlsrv_query($conn, $query);
	$count = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
	if($count > 0) {
      echo "Username Not Available";
	}else{
      echo "Username Available";
	}
	sqlsrv_close($conn);
}
?>