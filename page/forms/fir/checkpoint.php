<?php
include "../../configs/config.php";

$partnumber = $_GET['partnumber'];

$q_cekmastercheckpoint = mysql_query("SELECT * FROM form_fir_master_checkpoint WHERE partnumber='$partnumber'");
$cekmastercheckpoint = mysql_num_rows($q_cekmastercheckpoint);
if($cekmastercheckpoint > 0){
	
	$i = 1;
	while($r_checkpoint = mysql_fetch_array($q_cekmastercheckpoint)){
	echo "
	<tr>
		<td>$i<input type='hidden' id='lowerlimit' name='lowerlimit[]' value='$r_checkpoint[lowerlimit]' /><input type='hidden' id='upperlimit' name='upperlimit[]' value='$r_checkpoint[upperlimit]' /></td>
		<td><input type='text' style='width:100px' name='checkpoint[]' value='$r_checkpoint[checkpoint]' readonly /></td>
		<td><input type='text' style='width:170px' name='tolerance[]' value='$r_checkpoint[tolerance]' readonly /></td>
		<td><input type='text' style='width:100px' name='specs[]' value='$r_checkpoint[lowerlimit]-$r_checkpoint[upperlimit]' readonly /></td>
		<td><input type='text' style='width:50px' class='val' name='val[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val2[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val3[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val4[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val5[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val6[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val7[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val8[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val9[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val10[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val11[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val12[]' data-id='' /></td>
		<td><input type='text' style='width:100px' id='judgementcheck' name='judgementcheck[]' readonly /></td>
	</tr>
	";
	$i++;
	}
	
}
else{
	for($i=1;$i<=10;$i++){
	echo "
	<tr>
		<td>$i<input type='hidden' id='lowerlimit' name='lowerlimit[]' value='' /><input type='hidden' id='upperlimit' name='upperlimit[]' value='' /></td>
		<td><input type='text' style='width:100px' name='checkpoint[]' readonly /></td>
		<td><input type='text' style='width:170px' name='tolerance[]' readonly /></td>
		<td><input type='text' style='width:100px' name='specs[]' readonly /></td>
		<td><input type='text' style='width:50px' class='val' name='val[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val2[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val3[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val4[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val5[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val6[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val7[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val8[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val9[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val10[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val11[]' data-id='' /></td>
		<td><input type='text' style='width:50px' class='val' name='val12[]' data-id='' /></td>
		<td><input type='text' style='width:100px' id='judgementcheck' name='judgementcheck[]' readonly /></td>
	</tr>
	";
	}
}
?>
<script>
$('.val').on('input', function(){
    var lowerlimit = $(this).parent().parent().find("td:first").find("#lowerlimit").val();
	var upperlimit = $(this).parent().parent().find("td:first").find("#upperlimit").val();
	var judgementcheck = $(this).parent().parent().find("td:last").find("#judgementcheck");
	if($(this).val() != "" && (lowerlimit != "" || upperlimit != "")){
		if(lowerlimit != "" && upperlimit != ""){
			if(parseFloat($(this).val()) >= parseFloat(lowerlimit) && parseFloat($(this).val()) <= parseFloat(upperlimit)){
				$(this).attr("data-id", "OK");
				//$(this).css("color", "var(--success)");
			}
			else{
				$(this).attr("data-id", "NG");
				//$(this).css("color", "var(--danger)");
			}
		}
		else if(lowerlimit != "" && upperlimit == ""){
			if(parseFloat($(this).val()) >= parseFloat(lowerlimit)){
				$(this).attr("data-id", "OK");
				//$(this).css("color", "var(--success)");
			}
			else{
				$(this).attr("data-id", "NG");
				//$(this).css("color", "var(--danger)");
			}
		}
		else if(lowerlimit == "" && upperlimit != ""){
			if(parseFloat($(this).val()) <= parseFloat(upperlimit)){
				$(this).attr("data-id", "OK");
				//$(this).css("color", "var(--success)");
			}
			else{
				$(this).attr("data-id", "NG");
				//$(this).css("color", "var(--danger)");
			}
		}
		var val1 = $(this).closest("tr").find("input[name='val[]']").attr("data-id");
		var val2 = $(this).closest("tr").find("input[name='val2[]']").attr("data-id");
		var val3 = $(this).closest("tr").find("input[name='val3[]']").attr("data-id");
		var val4 = $(this).closest("tr").find("input[name='val4[]']").attr("data-id");
		var val5 = $(this).closest("tr").find("input[name='val5[]']").attr("data-id");
		var val6 = $(this).closest("tr").find("input[name='val6[]']").attr("data-id");
		var val7 = $(this).closest("tr").find("input[name='val7[]']").attr("data-id");
		var val8 = $(this).closest("tr").find("input[name='val8[]']").attr("data-id");
		var val9 = $(this).closest("tr").find("input[name='val9[]']").attr("data-id");
		var val10 = $(this).closest("tr").find("input[name='val10[]']").attr("data-id");
		var val11 = $(this).closest("tr").find("input[name='val11[]']").attr("data-id");
		var val12 = $(this).closest("tr").find("input[name='val12[]']").attr("data-id");
		if(val1 == ""
		&& val2 == ""
		&& val3 == ""
		&& val4 == ""
		&& val5 == ""
		&& val6 == ""
		&& val7 == ""
		&& val8 == ""
		&& val9 == ""
		&& val10 == ""
		&& val11 == ""
		&& val12 == ""){
			judgementcheck.attr("data-id", "");
			judgementcheck.val("");
			//judgementcheck.css("color", "unset");
		}
		else if(val1 == "NG"
		|| val2 == "NG"
		|| val3 == "NG"
		|| val4 == "NG"
		|| val5 == "NG"
		|| val6 == "NG"
		|| val7 == "NG"
		|| val8 == "NG"
		|| val9 == "NG"
		|| val10 == "NG"
		|| val11 == "NG"
		|| val12 == "NG"){
			judgementcheck.attr("data-id", "NG");
			judgementcheck.val("NG");
			//judgementcheck.css("color", "var(--danger)");
		}
		else{
			judgementcheck.attr("data-id", "OK");
			judgementcheck.val("OK");
			//judgementcheck.css("color", "var(--success)");
		}
	}
	else if($(this).val() != "" && lowerlimit == "" && upperlimit == ""){
		if($(this).val() == "0"){
			$(this).attr("data-id", "OK");
			//$(this).css("color", "var(--success)");
		}
		else if($(this).val() == "1"){
			$(this).attr("data-id", "NG");
			//$(this).css("color", "var(--danger)");
		}
		else if($(this).val() == "2"){
			$(this).attr("data-id", "NG");
			//$(this).css("color", "var(--danger)");
		}
		else if($(this).val() >= "3"){
			$(this).attr("data-id", "NG");
			//$(this).css("color", "var(--danger)");
		}
		else{
			$(this).attr("data-id", "");
			//$(this).css("color", "unset");
		}
		var val1 = $(this).closest("tr").find("input[name='val[]']").attr("data-id");
		var val2 = $(this).closest("tr").find("input[name='val2[]']").attr("data-id");
		var val3 = $(this).closest("tr").find("input[name='val3[]']").attr("data-id");
		var val4 = $(this).closest("tr").find("input[name='val4[]']").attr("data-id");
		var val5 = $(this).closest("tr").find("input[name='val5[]']").attr("data-id");
		var val6 = $(this).closest("tr").find("input[name='val6[]']").attr("data-id");
		var val7 = $(this).closest("tr").find("input[name='val7[]']").attr("data-id");
		var val8 = $(this).closest("tr").find("input[name='val8[]']").attr("data-id");
		var val9 = $(this).closest("tr").find("input[name='val9[]']").attr("data-id");
		var val10 = $(this).closest("tr").find("input[name='val10[]']").attr("data-id");
		var val11 = $(this).closest("tr").find("input[name='val11[]']").attr("data-id");
		var val12 = $(this).closest("tr").find("input[name='val12[]']").attr("data-id");
		if(val1 == ""
		&& val2 == ""
		&& val3 == ""
		&& val4 == ""
		&& val5 == ""
		&& val6 == ""
		&& val7 == ""
		&& val8 == ""
		&& val9 == ""
		&& val10 == ""
		&& val11 == ""
		&& val12 == ""){
			judgementcheck.attr("data-id", "");
			judgementcheck.val("");
			//judgementcheck.css("color", "unset");
		}
		else if(val1 == "NG"
		|| val2 == "NG"
		|| val3 == "NG"
		|| val4 == "NG"
		|| val5 == "NG"
		|| val6 == "NG"
		|| val7 == "NG"
		|| val8 == "NG"
		|| val9 == "NG"
		|| val10 == "NG"
		|| val11 == "NG"
		|| val12 == "NG"){
			judgementcheck.attr("data-id", "NG");
			judgementcheck.val("NG");
			//judgementcheck.css("color", "var(--danger)");
		}
		else{
			judgementcheck.attr("data-id", "OK");
			judgementcheck.val("OK");
			//judgementcheck.css("color", "var(--success)");
		}
	}
	else{
		$(this).attr("data-id", "");
		//$(this).css("color", "unset");
		var val1 = $(this).closest("tr").find("input[name='val[]']").attr("data-id");
		var val2 = $(this).closest("tr").find("input[name='val2[]']").attr("data-id");
		var val3 = $(this).closest("tr").find("input[name='val3[]']").attr("data-id");
		var val4 = $(this).closest("tr").find("input[name='val4[]']").attr("data-id");
		var val5 = $(this).closest("tr").find("input[name='val5[]']").attr("data-id");
		var val6 = $(this).closest("tr").find("input[name='val6[]']").attr("data-id");
		var val7 = $(this).closest("tr").find("input[name='val7[]']").attr("data-id");
		var val8 = $(this).closest("tr").find("input[name='val8[]']").attr("data-id");
		var val9 = $(this).closest("tr").find("input[name='val9[]']").attr("data-id");
		var val10 = $(this).closest("tr").find("input[name='val10[]']").attr("data-id");
		var val11 = $(this).closest("tr").find("input[name='val11[]']").attr("data-id");
		var val12 = $(this).closest("tr").find("input[name='val12[]']").attr("data-id");
		if(val1 == ""
		&& val2 == ""
		&& val3 == ""
		&& val4 == ""
		&& val5 == ""
		&& val6 == ""
		&& val7 == ""
		&& val8 == ""
		&& val9 == ""
		&& val10 == ""
		&& val11 == ""
		&& val12 == ""){
			judgementcheck.attr("data-id", "");
			judgementcheck.val("");
			//judgementcheck.css("color", "unset");
		}
		else if(val1 == "NG"
		|| val2 == "NG"
		|| val3 == "NG"
		|| val4 == "NG"
		|| val5 == "NG"
		|| val6 == "NG"
		|| val7 == "NG"
		|| val8 == "NG"
		|| val9 == "NG"
		|| val10 == "NG"
		|| val11 == "NG"
		|| val12 == "NG"){
			judgementcheck.attr("data-id", "NG");
			judgementcheck.val("NG");
			//judgementcheck.css("color", "var(--danger)");
		}
		else{
			judgementcheck.attr("data-id", "OK");
			judgementcheck.val("OK");
			//judgementcheck.css("color", "var(--success)");
		}
	}
	
	var values_NG = [];
	var values_OK = [];
	var values_EMPTY = [];
	var fieldsc = document.getElementsByName("judgementcheck[]");
	for(var i = 0; i < fieldsc.length; i++) {
		if(fieldsc[i].value == "NG"){
			values_NG.push(fieldsc[i].value);
		}
		else if(fieldsc[i].value == "OK"){
			values_OK.push(fieldsc[i].value);
		}
		else{
			values_EMPTY.push(fieldsc[i].value);
		}
	}
	
	var fields = document.getElementsByName("judgement[]");
	for(var i = 0; i < fields.length; i++) {
		if(fields[i].value == "NG"){
			values_NG.push(fields[i].value);
		}
		else if(fields[i].value == "OK"){
			values_OK.push(fields[i].value);
		}
		else{
			values_EMPTY.push(fields[i].value);
		}
	}
	
	if(values_NG.length > values_OK.length){
		$("#final").val("REJECT");
	}
	else if((values_NG.length == values_OK.length) && (values_NG.length > 0 && values_OK.length > 0)){
		$("#final").val("REWORK");
	}
	else{
		$("#final").val("PASS");
	}
});
</script>