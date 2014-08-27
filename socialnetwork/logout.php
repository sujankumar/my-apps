<?php
session_start();
unset($_SESSION["user_id"]);//session unset user_id
unset($_SESSION["user_name"]);// session unset user_name
header("Location:signin.html");//redirecting page location
?>