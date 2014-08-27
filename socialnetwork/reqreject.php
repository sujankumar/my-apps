<?php
session_start();
include 'connection.php';
global $conn;
$from=$_GET['to'];//store  friend name to a variable
$to=$_SESSION['user_name'];//store user name to a variable
$sql = "UPDATE requests SET status=0 WHERE from_request = '$from'AND to_request = '$to'";
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
