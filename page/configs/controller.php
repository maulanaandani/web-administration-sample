<?php

	if(isset($_GET['p'])){
		$p = $_GET['p'];
		
		if ($p=="home"){
			include "home.php";
		}
		
		if ($p=="department"){
			include "settings/department.php";
		}
		if ($p=="user"){
			include "settings/user.php";
		}
		if ($p=="form"){
			include "settings/form.php";
		}
		
		if ($p=="fir_master_customer"){
			include "forms/fir/master_customer.php";
		}
		if ($p=="fir_master_part"){
			include "forms/fir/master_part.php";
		}
		if ($p=="fir_master_inspection"){
			include "forms/fir/master_inspection.php";
		}
		if ($p=="fir_master_checkpoint"){
			include "forms/fir/master_checkpoint.php";
		}
		if ($p=="fir_new"){
			include "forms/fir/new.php";
		}
		if ($p=="fir_view"){
			include "forms/fir/view.php";
		}

	}else{
		include "home.php";
	}

?>