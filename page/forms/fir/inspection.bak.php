<?php
include "../../configs/config.php";

$standardqc = $_GET['standardqc'];
$totallotqty = $_GET['totallotqty'];
$prodqty1 = $_GET['prodqty1']; 
$prodqty2 = $_GET['prodqty2']; 
$prodqty3 = $_GET['prodqty3']; 
$prodqty4 = $_GET['prodqty4']; 
$prodqty5 = $_GET['prodqty5']; 

if($standardqc == "100%"){
	$sql_stdqc = "";
}
else{
	$sql_stdqc = "AND CONVERT(lowerlimit, UNSIGNED) <= '$totallotqty' AND CONVERT(upperlimit, UNSIGNED) >= '$totallotqty'";
}
$q_cekmasterinspection = mysql_query("SELECT * FROM form_fir_master_inspection WHERE standardqc='$standardqc' $sql_stdqc");
$cekmasterinspection = mysql_num_rows($q_cekmasterinspection);
if($cekmasterinspection > 0){
	
	$r_identity = mysql_fetch_array(mysql_query("SELECT * FROM form_fir_master_inspection WHERE standardqc='$standardqc' $sql_stdqc AND inspectionitem='Identity'"));
	$r_packaging = mysql_fetch_array(mysql_query("SELECT * FROM form_fir_master_inspection WHERE standardqc='$standardqc' $sql_stdqc AND inspectionitem='Packaging'"));
	$r_quantity = mysql_fetch_array(mysql_query("SELECT * FROM form_fir_master_inspection WHERE standardqc='$standardqc' $sql_stdqc AND inspectionitem='Quantity'"));
	$r_appearance = mysql_fetch_array(mysql_query("SELECT * FROM form_fir_master_inspection WHERE standardqc='$standardqc' $sql_stdqc AND inspectionitem='Appearance'"));
	
	
	
	if(strpos($r_identity['ac'], '%') !== false){$r_identity_ac = ($totallotqty * $r_identity['ac'])/100;}else{$r_identity_ac = $r_identity['ac'];}
	if(strpos($r_identity['re'], '%') !== false){$r_identity_re = ($totallotqty * $r_identity['re'])/100;}else{$r_identity_re = $r_identity['re'];}
	if(strpos($r_identity['n'], '%') !== false){$r_identity_n = (/* $totallotqty */ $prodqty1 * $r_identity['n'])/100;}else{$r_identity_n = $r_identity['n'];}
	if(strpos($r_identity['n'], '%') !== false){$r_identity_n2 = (/* $totallotqty */ $prodqty2 * $r_identity['n'])/100;}else{$r_identity_n2 = $r_identity['n'];}
	if(strpos($r_identity['n'], '%') !== false){$r_identity_n3 = (/* $totallotqty */ $prodqty3 * $r_identity['n'])/100;}else{$r_identity_n3 = $r_identity['n'];}
	if(strpos($r_identity['n'], '%') !== false){$r_identity_n4 = (/* $totallotqty */ $prodqty4 * $r_identity['n'])/100;}else{$r_identity_n4 = $r_identity['n'];}
	if(strpos($r_identity['n'], '%') !== false){$r_identity_n5 = (/* $totallotqty */ $prodqty5 * $r_identity['n'])/100;}else{$r_identity_n5 = $r_identity['n'];}
	
	if(strpos($r_packaging['ac'], '%') !== false){$r_packaging_ac = ($totallotqty * $r_packaging['ac'])/100;}else{$r_packaging_ac = $r_packaging['ac'];}
	if(strpos($r_packaging['re'], '%') !== false){$r_packaging_re = ($totallotqty * $r_packaging['re'])/100;}else{$r_packaging_re = $r_packaging['re'];}
	if(strpos($r_packaging['n'], '%') !== false){$r_packaging_n = (/* $totallotqty */ $prodqty1 * $r_packaging['n'])/100;}else{$r_packaging_n = $r_packaging['n'];}
	if(strpos($r_packaging['n'], '%') !== false){$r_packaging_n2 = (/* $totallotqty */ $prodqty2 * $r_packaging['n'])/100;}else{$r_packaging_n2 = $r_packaging['n'];}
	if(strpos($r_packaging['n'], '%') !== false){$r_packaging_n3 = (/* $totallotqty */ $prodqty3 * $r_packaging['n'])/100;}else{$r_packaging_n3 = $r_packaging['n'];}
	if(strpos($r_packaging['n'], '%') !== false){$r_packaging_n4 = (/* $totallotqty */ $prodqty4 * $r_packaging['n'])/100;}else{$r_packaging_n4 = $r_packaging['n'];}
	if(strpos($r_packaging['n'], '%') !== false){$r_packaging_n5 = (/* $totallotqty */ $prodqty5 * $r_packaging['n'])/100;}else{$r_packaging_n5 = $r_packaging['n'];}
	
	if(strpos($r_quantity['ac'], '%') !== false){$r_quantity_ac = ($totallotqty * $r_quantity['ac'])/100;}else{$r_quantity_ac = $r_quantity['ac'];}
	if(strpos($r_quantity['re'], '%') !== false){$r_quantity_re = ($totallotqty * $r_quantity['re'])/100;}else{$r_quantity_re = $r_quantity['re'];}
	if(strpos($r_quantity['n'], '%') !== false){$r_quantity_n = (/* $totallotqty */ $prodqty1 * $r_quantity['n'])/100;}else{$r_quantity_n = $r_quantity['n'];}
	if(strpos($r_quantity['n'], '%') !== false){$r_quantity_n2 = (/* $totallotqty */ $prodqty2 * $r_quantity['n'])/100;}else{$r_quantity_n2 = $r_quantity['n'];}
	if(strpos($r_quantity['n'], '%') !== false){$r_quantity_n3 = (/* $totallotqty */ $prodqty3 * $r_quantity['n'])/100;}else{$r_quantity_n3 = $r_quantity['n'];}
	if(strpos($r_quantity['n'], '%') !== false){$r_quantity_n4 = (/* $totallotqty */ $prodqty4 * $r_quantity['n'])/100;}else{$r_quantity_n4 = $r_quantity['n'];}
	if(strpos($r_quantity['n'], '%') !== false){$r_quantity_n5 = (/* $totallotqty */ $prodqty5 * $r_quantity['n'])/100;}else{$r_quantity_n5 = $r_quantity['n'];}
	
	if(strpos($r_appearance['ac'], '%') !== false){$r_appearance_ac = ($totallotqty * $r_appearance['ac'])/100;}else{$r_appearance_ac = $r_appearance['ac'];}
	if(strpos($r_appearance['re'], '%') !== false){$r_appearance_re = ($totallotqty * $r_appearance['re'])/100;}else{$r_appearance_re = $r_appearance['re'];}
	if(strpos($r_appearance['n'], '%') !== false){$r_appearance_n = (/* $totallotqty */ $prodqty1 * $r_appearance['n'])/100;}else{$r_appearance_n = $r_appearance['n'];}
	if(strpos($r_appearance['n'], '%') !== false){$r_appearance_n2 = (/* $totallotqty */ $prodqty2 * $r_appearance['n'])/100;}else{$r_appearance_n2 = $r_appearance['n'];}
	if(strpos($r_appearance['n'], '%') !== false){$r_appearance_n3 = (/* $totallotqty */ $prodqty3 * $r_appearance['n'])/100;}else{$r_appearance_n3 = $r_appearance['n'];}
	if(strpos($r_appearance['n'], '%') !== false){$r_appearance_n4 = (/* $totallotqty */ $prodqty4 * $r_appearance['n'])/100;}else{$r_appearance_n4 = $r_appearance['n'];}
	if(strpos($r_appearance['n'], '%') !== false){$r_appearance_n5 = (/* $totallotqty */ $prodqty5 * $r_appearance['n'])/100;}else{$r_appearance_n5 = $r_appearance['n'];}
	
	if($prodqty1 == ""
	AND $prodqty2 == ""
	AND $prodqty3 == ""
	AND $prodqty4 == ""
	AND $prodqty5 == ""){
		$r_identity_ac = "";
		$r_identity_re = "";
		
		$r_packaging_ac = "";
		$r_packaging_re = "";
		
		$r_quantity_ac = "";
		$r_quantity_re = "";
		
		$r_appearance_ac = "";
		$r_appearance_re = "";
	}
	
	$r_identity_n = round($r_identity_n);
	$r_identity_n2 = round($r_identity_n2);
	$r_identity_n3 = round($r_identity_n3);
	$r_identity_n4 = round($r_identity_n4);
	$r_identity_n5 = round($r_identity_n5);
	
	$r_packaging_n = round($r_packaging_n);
	$r_packaging_n2 = round($r_packaging_n2);
	$r_packaging_n3 = round($r_packaging_n3);
	$r_packaging_n4 = round($r_packaging_n4);
	$r_packaging_n5 = round($r_packaging_n5);
	
	$r_quantity_n = round($r_quantity_n);
	$r_quantity_n2 = round($r_quantity_n2);
	$r_quantity_n3 = round($r_quantity_n3);
	$r_quantity_n4 = round($r_quantity_n4);
	$r_quantity_n5 = round($r_quantity_n5);
	
	$r_appearance_n = round($r_appearance_n);
	$r_appearance_n2 = round($r_appearance_n2);
	$r_appearance_n3 = round($r_appearance_n3);
	$r_appearance_n4 = round($r_appearance_n4);
	$r_appearance_n5 = round($r_appearance_n5);
	
	if($prodqty1 == ""){$r_identity_n = "";}
	if($prodqty2 == ""){$r_identity_n2 = "";}
	if($prodqty3 == ""){$r_identity_n3 = "";}
	if($prodqty4 == ""){$r_identity_n4 = "";}
	if($prodqty5 == ""){$r_identity_n5 = "";}
	
	if($prodqty1 == ""){$r_packaging_n = "";}
	if($prodqty2 == ""){$r_packaging_n2 = "";}
	if($prodqty3 == ""){$r_packaging_n3 = "";}
	if($prodqty4 == ""){$r_packaging_n4 = "";}
	if($prodqty5 == ""){$r_packaging_n5 = "";}
	
	if($prodqty1 == ""){$r_quantity_n = "";}
	if($prodqty2 == ""){$r_quantity_n2 = "";}
	if($prodqty3 == ""){$r_quantity_n3 = "";}
	if($prodqty4 == ""){$r_quantity_n4 = "";}
	if($prodqty5 == ""){$r_quantity_n5 = "";}
	
	if($prodqty1 == ""){$r_appearance_n = "";}
	if($prodqty2 == ""){$r_appearance_n2 = "";}
	if($prodqty3 == ""){$r_appearance_n3 = "";}
	if($prodqty4 == ""){$r_appearance_n4 = "";}
	if($prodqty5 == ""){$r_appearance_n5 = "";}
	
	echo "
	<tr>
		<td>1</td>
		<td>Identity<input type='hidden' class='' style='width:50px' name='item[]' value='Identity' /></td>
		<td><input type='text' class='' style='width:50px' name='ac[]' value='$r_identity_ac' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='re[]' value='$r_identity_re' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n[]' value='$r_identity_n' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n2[]' value='$r_identity_n2' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a2[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r2[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n3[]' value='$r_identity_n3' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a3[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r3[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n4[]' value='$r_identity_n4' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a4[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r4[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n5[]' value='$r_identity_n5' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a5[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r5[]' readonly /></td>
	</tr>
	<tr>
		<td>2</td>
		<td>Packaging<input type='hidden' class='' style='width:50px' name='item[]' value='Packaging' /></td>
		<td><input type='text' class='' style='width:50px' name='ac[]' value='$r_packaging_ac' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='re[]' value='$r_packaging_re' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n[]' value='$r_packaging_n' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n2[]' value='$r_packaging_n2' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a2[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r2[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n3[]' value='$r_packaging_n3' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a3[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r3[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n4[]' value='$r_packaging_n4' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a4[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r4[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n5[]' value='$r_packaging_n5' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a5[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r5[]' readonly /></td>
	</tr>
	<tr>
		<td>3</td>
		<td>Quantity<input type='hidden' class='' style='width:50px' name='item[]' value='Quantity' /></td>
		<td><input type='text' class='' style='width:50px' name='ac[]' value='$r_quantity_ac' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='re[]' value='$r_quantity_re' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n[]' value='$r_quantity_n' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n2[]' value='$r_quantity_n2' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a2[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r2[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n3[]' value='$r_quantity_n3' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a3[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r3[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n4[]' value='$r_quantity_n4' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a4[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r4[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n5[]' value='$r_quantity_n5' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a5[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r5[]' readonly /></td>
	</tr>
	<tr>
		<td>4</td>
		<td>Appearance<input type='hidden' class='' style='width:50px' name='item[]' value='Appearance' /></td>
		<td><input type='text' class='' style='width:50px' name='ac[]' value='$r_appearance_ac' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='re[]' value='$r_appearance_re' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n[]' value='$r_appearance_n' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n2[]' value='$r_appearance_n2' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a2[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r2[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n3[]' value='$r_appearance_n3' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a3[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r3[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n4[]' value='$r_appearance_n4' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a4[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r4[]' readonly /></td>
		<td><input type='text' class='' style='width:50px' name='n5[]' value='$r_appearance_n5' readonly /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a5[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r5[]' readonly /></td>
	</tr>
	<tr>
		<td>5</td>
		<td>Aplication<input type='hidden' class='' style='width:50px' name='item[]' value='Aplication' /></td>
		<td><input type='text' class='' style='width:50px' name='ac[]' /></td>
		<td><input type='text' class='' style='width:50px' name='re[]' /></td>
		<td><input type='text' class='' style='width:50px' name='n[]' /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r[]' /></td>
		<td><input type='text' class='' style='width:50px' name='n2[]' /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a2[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r2[]' /></td>
		<td><input type='text' class='' style='width:50px' name='n3[]' /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a3[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r3[]' /></td>
		<td><input type='text' class='' style='width:50px' name='n4[]' /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a4[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r4[]' /></td>
		<td><input type='text' class='' style='width:50px' name='n5[]' /></td>
		<td><input type='text' class='qty_a' style='width:50px' name='a5[]' /></td>
		<td><input type='text' class='' style='width:50px' name='r5[]' /></td>
	</tr>
	<tr>
		<th colspan='4'>Judgement</th>
		<td colspan='3'><input type='text' id='judgement' style='width:180px' name='judgement[]' readonly /></td>
		<td colspan='3'><input type='text' id='judgement2' style='width:180px' name='judgement2[]' readonly /></td>
		<td colspan='3'><input type='text' id='judgement3' style='width:180px' name='judgement3[]' readonly /></td>
		<td colspan='3'><input type='text' id='judgement4' style='width:180px' name='judgement4[]' readonly /></td>
		<td colspan='3'><input type='text' id='judgement5' style='width:180px' name='judgement5[]' readonly /></td>
	</tr>
	";
}
else{
	echo "";
}
?>
<script>
$('.qty_a').on('input', function(){
	var n = $(this).parent().prev().children();
	var r = $(this).parent().next().children();
	var h = Math.round(parseFloat(n.val())-parseFloat($(this).val()));
	
	if(isNaN(h)){
		r.val("");
	}
	else{
		r.val(h);
	}
	
	if($(this).closest("td").is(':nth-child(6)')){
		var qty_r = $(this).closest("tr").parent().find("tr:nth-child(1)").find("input[name='r[]']").val();
		var qty_rr = $(this).closest("tr").parent().find("tr:nth-child(2)").find("input[name='r[]']").val();
		var qty_rrr = $(this).closest("tr").parent().find("tr:nth-child(3)").find("input[name='r[]']").val();
		var qty_rrrr = $(this).closest("tr").parent().find("tr:nth-child(4)").find("input[name='r[]']").val();
		var qty_rrrrr = $(this).closest("tr").parent().find("tr:nth-child(5)").find("input[name='r[]']").val();
		var judgement = $(this).parent().parent().parent().find("tr:last").find("#judgement");
	}
	else if($(this).closest("td").is(':nth-child(9)')){
		var qty_r = $(this).closest("tr").parent().find("tr:nth-child(1)").find("input[name='r2[]']").val();
		var qty_rr = $(this).closest("tr").parent().find("tr:nth-child(2)").find("input[name='r2[]']").val();
		var qty_rrr = $(this).closest("tr").parent().find("tr:nth-child(3)").find("input[name='r2[]']").val();
		var qty_rrrr = $(this).closest("tr").parent().find("tr:nth-child(4)").find("input[name='r2[]']").val();
		var qty_rrrrr = $(this).closest("tr").parent().find("tr:nth-child(5)").find("input[name='r2[]']").val();
		var judgement = $(this).parent().parent().parent().find("tr:last").find("#judgement2");
	}
	else if($(this).closest("td").is(':nth-child(12)')){
		var qty_r = $(this).closest("tr").parent().find("tr:nth-child(1)").find("input[name='r3[]']").val();
		var qty_rr = $(this).closest("tr").parent().find("tr:nth-child(2)").find("input[name='r3[]']").val();
		var qty_rrr = $(this).closest("tr").parent().find("tr:nth-child(3)").find("input[name='r3[]']").val();
		var qty_rrrr = $(this).closest("tr").parent().find("tr:nth-child(4)").find("input[name='r3[]']").val();
		var qty_rrrrr = $(this).closest("tr").parent().find("tr:nth-child(5)").find("input[name='r3[]']").val();
		var judgement = $(this).parent().parent().parent().find("tr:last").find("#judgement3");
	}
	else if($(this).closest("td").is(':nth-child(15)')){
		var qty_r = $(this).closest("tr").parent().find("tr:nth-child(1)").find("input[name='r4[]']").val();
		var qty_rr = $(this).closest("tr").parent().find("tr:nth-child(2)").find("input[name='r4[]']").val();
		var qty_rrr = $(this).closest("tr").parent().find("tr:nth-child(3)").find("input[name='r4[]']").val();
		var qty_rrrr = $(this).closest("tr").parent().find("tr:nth-child(4)").find("input[name='r4[]']").val();
		var qty_rrrrr = $(this).closest("tr").parent().find("tr:nth-child(5)").find("input[name='r4[]']").val();
		var judgement = $(this).parent().parent().parent().find("tr:last").find("#judgement4");
	}
	else if($(this).closest("td").is(':nth-child(18)')){
		var qty_r = $(this).closest("tr").parent().find("tr:nth-child(1)").find("input[name='r5[]']").val();
		var qty_rr = $(this).closest("tr").parent().find("tr:nth-child(2)").find("input[name='r5[]']").val();
		var qty_rrr = $(this).closest("tr").parent().find("tr:nth-child(3)").find("input[name='r5[]']").val();
		var qty_rrrr = $(this).closest("tr").parent().find("tr:nth-child(4)").find("input[name='r5[]']").val();
		var qty_rrrrr = $(this).closest("tr").parent().find("tr:nth-child(5)").find("input[name='r5[]']").val();
		var judgement = $(this).parent().parent().parent().find("tr:last").find("#judgement5");
	}
	
	if(qty_r == ""
	&& qty_rr == ""
	&& qty_rrr == ""
	&& qty_rrrr == ""
	&& qty_rrrrr == ""){
		judgement.val("");
	}
	else if(qty_r > 0
	|| qty_rr > 0
	|| qty_rrr > 0
	|| qty_rrrr > 0
	|| qty_rrrrr > 0){
		judgement.val("NG");
	}
	else{
		judgement.val("OK");
	}
});
</script>