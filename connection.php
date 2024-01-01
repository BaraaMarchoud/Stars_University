<?php  

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "baraa_project";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
	exit();
}