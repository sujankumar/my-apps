<?php
session_start();//session initialization
include 'connection.php';//including a file for a mysql connection
global $conn;//global variable decleration
$from=$_GET['to'];
$to=$_SESSION['user_name'];
$sql = "UPDATE requests SET status=1 WHERE from_request = '$from'AND to_request = '$to'";
$retval = mysql_query( $sql, $conn );//mysql query for update a table
if(! $retval )
{
die('could not accept request: ' . mysql_error());
}else
{
header("Location:/socialnetwork/friends.php");//redirecting page location
}
mysql_close($conn);
?>
