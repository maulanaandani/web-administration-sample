<?php
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
$hostname = "localhost";
$user_db = "root";
$pass_db = "SBElampu5";
$db = "demo";
$con = mysql_connect($hostname, $user_db, $pass_db);
mysql_set_charset('utf8',$con);
mysql_select_db($db, $con);
?>