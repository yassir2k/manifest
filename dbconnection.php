<?php
$serverName = "localhost"; //serverName\instanceName
$connectionInfo = array( "Database"=>"manifestDB", "UID"=>"manifestapp", "PWD"=>"passw0rd1");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( !($conn) ) {
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>