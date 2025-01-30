<?php
include "../configs/config.php";

$type = $_GET['type'];
$formid = $_GET['formid'];
$userid = $_GET['userid'];
$value = $_GET['value'];

$q_cekuser =  mysql_query("SELECT * FROM form_user WHERE formid='$formid' AND userid='$userid'");
$cekuser = mysql_num_rows($q_cekuser);
if($cekuser > 0){
	$q = mysql_query("UPDATE form_user SET $type='$value' WHERE formid='$formid' AND userid='$userid'");
}
else{
	$q = mysql_query("INSERT INTO form_user (formid,userid,$type) VALUES('$formid','$userid','$value')");
}
if($q){
	echo "ok";
}
?>