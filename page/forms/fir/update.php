<?php
include "../../configs/config.php";

$number = $_GET['number'];
$type = $_GET['type'];
$value = $_GET['value'];
$q = mysql_query("UPDATE form_fir SET $type='$value' WHERE number='$number'");
if($q){
	echo "OK";
}
else{
	echo "ERROR";
}
?>