<?php
global $conn ;//global variable decleration
$conn= mysql_connect('localhost', 'root', 'password');//host name mysql username and password   

if (!$conn){
    die("Database Connection or Selection Failed" . mysql_error());
}
$select_db = mysql_select_db('sample_social_network');//selecting Database
if (!$select_db){
    die("Database Selection Failed" . mysql_error());
}
?>


