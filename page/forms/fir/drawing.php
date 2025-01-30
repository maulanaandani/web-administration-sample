<?php
include "../../configs/config.php";

$partnumber = $_GET['partnumber'];
$q_part = mysql_query("SELECT * FROM part WHERE partnumber='$partnumber'");
$r_part = mysql_fetch_array($q_part);
$dir = "../assets/img/part/";
if($r_part['drawing'] != ""){
	if(file_exists("../../".$dir.$r_part['drawing'])){
		echo $dir.$r_part['drawing'];
	}
	else{
		echo "";
	}
}
else{
	echo "";
}
?>