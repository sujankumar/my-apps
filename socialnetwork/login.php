<?php
session_start();//session start
include'connection.php';
global $conn;
if(count($_POST)>0) {
$result = mysql_query("SELECT * FROM users WHERE user_name='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
$row  = mysql_fetch_array($result);//mysql query for selecting data from table
if(is_array($row)) {
$_SESSION["user_id"] = $row['user_id'];//session id creation
$_SESSION["user_name"] = $row['user_name'];//session username creation
} else {
echo "Invalid Username or Password!";
}
}
if(isset($_SESSION["user_id"])) {
header("Location:user.php");//redirecting page location
}
?>