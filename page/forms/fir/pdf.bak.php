<?php
include "../../configs/config.php";
include "../../libs/mpdf/mpdf.php";

$path = basename(dirname($_SERVER['PHP_SELF']));
$query_form = mysql_query("SELECT * FROM form WHERE formcode='$path'");
$cek_form = mysql_num_rows($query_form);
$data_form = mysql_fetch_array($query_form);
$formnumber = $data_form['formnumber'];

$number = $_GET['number'];
$dateformat = 126;
$font = 9.5;

$q = mysql_query("SELECT * FROM form_fir WHERE number='$_GET[number]'");
$r = mysql_fetch_array($q);
$number = $r['number'];
$datecreated = $r['datecreated'];
$name = $r['name'];
$department = $r['department'];

$customername = $r['customername'];
$partnumber = $r['partnumber'];
$partname = $r['partname'];
$checkcode = $r['checkcode'];
$batchnumber = $r['batchnumber'];
$totallotqty = $r['totallotqty'];
$standardqc = $r['standardqc'];
if($standardqc == "100%"){
	$standardqc = "100%";
}
else if($standardqc == "TL3"){
	$standardqc = "Tighten Level III";
}
else if($standardqc == "TL2"){
	$standardqc = "Tighten Level II";
}
else if($standardqc == "NL2"){
	$standardqc = "Normal Level II";
}
else{
	$standardqc = "";
}

$lastissue = $r['lastissue'];
$issueproduction = $r['issueproduction'];
$receiptproduction = $r['receiptproduction'];
$inventorytransfer = $r['inventorytransfer'];

$final = $r['final'];
$remark = $r['remark'];

$creator = $r['creator'];
$approval1_id = $r['approval1'];
$status1 = $r['status1'];
$date1 = $r['date1'];
$approval2_id = $r['approval2'];
$status2 = $r['status2'];
$date2 = $r['date2'];
$approval3_id = $r['approval3'];
$status3 = $r['status3'];
$date3 = $r['date3'];

$status = $r['status'];
$date = $r['date'];
$tag = $r['tag'];

$query_approval1 = mysql_query("SELECT * FROM user WHERE userid='$approval1_id'");
$cek_approval1 = mysql_num_rows($query_approval1);
$data_approval1 = mysql_fetch_array($query_approval1);
$approval1_name = $data_approval1['name'];
$query_approval2 = mysql_query("SELECT * FROM user WHERE userid='$approval2_id'");
$cek_approval2 = mysql_num_rows($query_approval2);
$data_approval2 = mysql_fetch_array($query_approval2);
$approval2_name = $data_approval2['name'];
$query_approval3 = mysql_query("SELECT * FROM user WHERE userid='$approval3_id'");
$cek_approval3 = mysql_num_rows($query_approval3);
$data_approval3 = mysql_fetch_array($query_approval3);
$approval3_name = $data_approval3['name'];

if($status1 == "-1"){
	$status1_label = "Canceled</span>";
}
else if($status1 == "0"){
	$status1_label = "Opened</span>";
}
else if($status1 == "1"){
	$status1_label = "Revised</span>";
}
else if($status1 == "2"){
	$status1_label = "Approved</span>";
}
else if($status1 == "3"){
	$status1_label = "<span class='badge badge-primary'>Closed</span>";
}
else{
	$status1_label = "";
}
if($status2 == "-1"){
	$status2_label = "Canceled</span>";
}
else if($status2 == "0"){
	$status2_label = "Opened</span>";
}
else if($status2 == "1"){
	$status2_label = "Revised</span>";
}
else if($status2 == "2"){
	$status2_label = "Approved</span>";
}
else if($status2 == "3"){
	$status2_label = "span class='badge badge-primary'>Closed</span>";
}
else{
	$status2_label = "";
}
if($status3 == "-1"){
	$status3_label = "Canceled</span>";
}
else if($status3 == "0"){
	$status3_label = "Opened</span>";
}
else if($status3 == "1"){
	$status3_label = "Revised</span>";
}
else if($status3 == "2"){
	$status3_label = "Approved</span>";
}
else if($status3 == "3"){
	$status3_label = "span class='badge badge-primary'>Closed</span>";
}
else{
	$status3_label = "";
}
if($status == "-1"){
	$status_label = "Canceled</span>";
}
else if($status == "0"){
	$status_label = "Opened</span>";
}
else if($status == "1"){
	$status_label = "Revised</span>";
}
else if($status == "2"){
	$status_label = "Approved</span>";
}
else if($status == "3"){
	$status_label = "<span class='badge badge-primary'>Closed</span>";
}
else{
	$status_label = "";
}

function convertToRoman($integer){
	$integer = intval($integer);
	$result = '';
	$lookup = array('M' => 1000,
		'CM' => 900,
		'D' => 500,
		'CD' => 400,
		'C' => 100,
		'XC' => 90,
		'L' => 50,
		'XL' => 40,
		'X' => 10,
		'IX' => 9,
		'V' => 5,
		'IV' => 4,
		'I' => 1);
	foreach ($lookup as $roman => $value) {
		$matches = intval($integer / $value);
		$result .= str_repeat($roman, $matches);
		$integer = $integer % $value;
	}
	return $result;
}

$mpdf=new mPDF('UTF-8','A4-L','','',5,5,5,5,5,5,'P'); 
//$mpdf->allow_charset_conversion=false;
//$mpdf->charset_in='UTF-8';
//$mpdf->useOnlyCoreFonts = true;    // false is default
//$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("$number");
$mpdf->SetAuthor("Maulana Andani, S.Kom");
$mpdf->SetSubject("Number: $number");
if($status > 1){
$mpdf->SetWatermarkText("$final");
}
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');
ob_start(); 
?>
<html>
<head>
	<META http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <style>
		html{
			-webkit-print-color-adjust: exact;
		}
        body {
            font-family: Arial;
			font-size: medium;
        }
        .yes {
            border-collapse: collapse;
        }
        .yes th, .yes td {
            border: 1px solid #000;
			font-family: Arial;
			font-size: <?php echo $font;?>pt;
			padding: 3px 5px 3px 5px;
        }
		.no {
            border-collapse: collapse;
			margin-bottom: -15px;
        }
        .no th, .no td {
            border: 0px solid #000;
			font-family: Arial;
			font-size: <?php echo $font;?>pt;
			padding: 3px 5px 3px 5px;
        }
		pre {
			font-family: Arial;
			font-size: <?php echo $font;?>pt;
		}
		.ok {
            border-collapse: collapse;
        }
        .ok th, .ok td {
            border-top: 1px solid #000;
			border-left: 1px solid #000;
			border-right: 1px solid #000;
			font-family: Arial;
			font-size: <?php echo $font;?>pt;
        }
		th{
			padding: 0px;
			vertical-align: middle;
		}
		td{
			padding-left: 5px;
			padding-right: 0px;
			vertical-align: top;
		}
		small{
			font-size: <?php echo ($font-1);?>pt;
		}
    </style>
	<!--<script>window.print();</script>-->
</head>
<body>	

	<table style="width:100%" class="yes">
        <thead>
			<tr>
                <th colspan="9" style="border-bottom:0px; width:100%; padding-top:7px;">
					<h3 style="margin-bottom:0px;">PT. SENTRAL BAHANA EKATAMA</h3>
				</th>
            </tr>
			<tr>
                <th colspan="9" style="border-top:0px; width:100%; padding-bottom:7px;">
					<center>
						<h2>FINAL INSPECTION REPORT (FIR)</h2>
					</center>
					<br/>
				</th>
            </tr>
        </thead>
		<tbody>
			<tr>
				<td style="width:15%" height="20px"><b>CUSTOMER NAME</b></td>
				<td style="width:35%"><?php echo $customername; ?></td>
				<td style="width:15%"><b>BATCH NUMBER</b></td>
				<td style="width:35%"><?php echo $batchnumber; ?></td>
			</tr>
			<tr>
				<td style="width:15%" height="20px"><b>PART NUMBER</b></td>
				<td style="width:35%"><?php echo $partnumber; ?></td>
				<td style="width:15%"><b>TOTAL LOT QTY</b></td>
				<td style="width:35%"><?php echo $totallotqty; ?></td>
			</tr>
			<tr>
				<td style="width:15%" height="20px"><b>PART NAME</b></td>
				<td style="width:35%"><?php echo $partname; ?></td>
				<td style="width:15%"><b>STANDARD QC</b></td>
				<td style="width:35%"><?php echo $standardqc; ?></td>
			</tr>
			<tr>
				<td style="width:15%" height="20px"><b>CHECK CODE</b></td>
				<td style="width:35%"><?php echo $checkcode; ?></td>
				<td style="width:15%"><b></b></td>
				<td style="width:35%"><?php echo ""; ?></td>
			</tr>
        </tbody>
    </table>
	<table style="width:100%" class="yes">
        <thead>
			<tr>
				<th rowspan="3" width="3%">No</th>
				<th rowspan="3" width="12%">Inspection Items</th>
				<th rowspan="2" colspan="2" width="14%">AQL<br/>(Accept Quality Limit)</th>
				<?php
				for($i=1;$i<=5;$i++){
				echo "<th colspan='3' width='16%'>".convertToRoman($i)."</th>";
				}
				?>
			</tr>
			<tr>
				<?php
				$q_prodqty = mysql_query("SELECT * FROM form_fir_inspection_prodqty ORDER BY id");
				while($r_prodqty = mysql_fetch_array($q_prodqty)){
					echo "<th colspan='3'>Prod. Qty: $r_prodqty[prodqty]</th>";
				}
				?>
			</tr>
			<tr>
				<th width="7%">Ac</th>
				<th width="7%">Re</th>
				<?php
				for($i=1;$i<=5;$i++){
				echo "
				<th>n</th>
				<th>a</th>
				<th>r</th>
				";
				}
				?>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			$q_inspection = mysql_query("SELECT * FROM form_fir_inspection WHERE number='$_GET[number]' ORDER BY id");
			while($r_inspection = mysql_fetch_array($q_inspection)){
				echo "
				<tr>
					<td align='center'>$i</td>
					<td>$r_inspection[item]</td>
					<td align='right'>$r_inspection[ac]</td>
					<td align='right'>$r_inspection[re]</td>
					<td align='right'>$r_inspection[n]</td>
					<td align='right'>$r_inspection[a]</td>
					<td align='right'>$r_inspection[r]</td>
					<td align='right'>$r_inspection[n2]</td>
					<td align='right'>$r_inspection[a2]</td>
					<td align='right'>$r_inspection[r2]</td>
					<td align='right'>$r_inspection[n3]</td>
					<td align='right'>$r_inspection[a3]</td>
					<td align='right'>$r_inspection[r3]</td>
					<td align='right'>$r_inspection[n4]</td>
					<td align='right'>$r_inspection[a4]</td>
					<td align='right'>$r_inspection[r4]</td>
					<td align='right'>$r_inspection[n5]</td>
					<td align='right'>$r_inspection[a5]</td>
					<td align='right'>$r_inspection[r5]</td>
				</tr>
				";
				$i++;
			}
			?>
			<tr>
				<th colspan="4">Judgement</th>
				<?php
				$i = 1;
				$q_prodqty_judgement = mysql_query("SELECT * FROM form_fir_inspection_prodqty WHERE number='$_GET[number]' ORDER BY id");
				while($r_prodqty_judgement = mysql_fetch_array($q_prodqty_judgement)){
					echo "<td colspan='3' align='center'>$r_prodqty_judgement[judgement]</td>";
					$i++;
				}
				?>
			</tr>
		</tbody>
    </table>
	<table style="width:100%" class="yes">
		<thead>
			<tr>
				<th rowspan="2" width="3%">No</th>
				<th rowspan="2" width="8%">Check Point</th>
				<th rowspan="2" width="13%">Specs</th>
				<th colspan="12" width="68%">Hasil Pengukuran</th>
				<th rowspan="2" width="8%">Judgement</th>
			</tr>
			<tr>
				<?php
				for($i=1;$i<=12;$i++){
				echo "<th>$i</th>";
				}
				?>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			$q_checkpoint = mysql_query("SELECT * FROM form_fir_checkpoint WHERE number='$_GET[number]' ORDER BY id");
			while($r_checkpoint = mysql_fetch_array($q_checkpoint)){
				echo "
				<tr>
					<td align='center'>$i</td>
					<td>$r_checkpoint[checkpoint]</td>
					<td>$r_checkpoint[tolerance]</td>
					<td align='right'>$r_checkpoint[val]</td>
					<td align='right'>$r_checkpoint[val2]</td>
					<td align='right'>$r_checkpoint[val3]</td>
					<td align='right'>$r_checkpoint[val4]</td>
					<td align='right'>$r_checkpoint[val5]</td>
					<td align='right'>$r_checkpoint[val6]</td>
					<td align='right'>$r_checkpoint[val7]</td>
					<td align='right'>$r_checkpoint[val8]</td>
					<td align='right'>$r_checkpoint[val9]</td>
					<td align='right'>$r_checkpoint[val10]</td>
					<td align='right'>$r_checkpoint[val11]</td>
					<td align='right'>$r_checkpoint[val12]</td>
					<td align='center'>$r_checkpoint[judgementcheck]</td>
				</tr>
				";
				$i++;
			}
			?>
		</tbody>
	</table>
	<table style="width:100%" class="yes">
		<tbody>
			<tr>
				<td width="50%" rowspan="3"><b>Last Known Issue:</b><br/><br/><pre><?php echo $lastissue; ?></pre></td>
				<td width="17%"><b>Issue From Production</b></td>
				<td width="33%"><?php echo $issueproduction; ?></td>
			</tr>
			<tr>
				<td><b>Receipt From Production</b></td>
				<td><?php echo $receiptproduction; ?></td>
			</tr>
			<tr>
				<td><b>Inventory Transfer</b></td>
				<td><?php echo $inventorytransfer; ?></td>
			</tr>
		</tbody>
	</table>
	<table style="width:100%" class="yes">
		<tbody>
			<tr>
				<td width="50%"><b>Final Decision:</b><br/><br/>
				<table class="no" width="100%">
				<tr>
				<td width="160px"><h1><?php if($final == "PASS"){echo "&#9745;";}else{echo "&#9744;";} ?> PASS</h1></td>
				<td width="200px"><h1><?php if($final == "REWORK"){echo "&#9745;";}else{echo "&#9744;";} ?> REWORK</h1></td>
				<td width="170px"><h1><?php if($final == "REJECT"){echo "&#9745;";}else{echo "&#9744;";} ?> REJECT</h1></td>
				</tr>
				</table>
				</td>
				<td width="50%"><b>Remark:</b><br/><br/><pre><?php echo $remark; ?></pre></td>
			</tr>
		</tbody>
	</table>
	<table style="width:100%" class="yes">
        <thead>
			<tr>
				<th colspan="1" width="30%" bgcolor="#cccccc" height="10px"></th>
				<th colspan="1" width="30%" bgcolor="#cccccc">NAMA</th>
				<th colspan="1" width="20%" bgcolor="#cccccc">STATUS</th>
				<th colspan="1" width="20%" bgcolor="#cccccc" align="center">TANGGAL</th>
			</tr>
        </thead>
		<tbody>
			<tr>
				<td colspan="1" height="20px">Inspected By</td>
				<td colspan="1"><?php echo $name; ?></td>
				<td colspan="1" align="center">Submitted</td>
				<td colspan="1" align="center"><?php echo $datecreated; ?></td>
			</tr>
			<tr>
				<td height="20px">Checked By</td>
				<td><?php echo $approval1_name; ?></td>
				<td align="center"><?php echo $status1_label; ?></td>
				<td align="center"><?php echo $date1; ?></td>
			</tr>
			<tr>
				<td height="20px">Approved By</td>
				<td><?php echo $approval2_name; ?></td>
				<td align="center"><?php echo $status2_label; ?></td>
				<td align="center"><?php echo $date2; ?></td>
			</tr>
		</tbody>
    </table>
	
	<?php
	echo "<small>$formnumber</small>";
	?>

</body>
</html>
<?php
//$mpdf->setHTMLFooter('<div align="right"><small>{PAGENO} / {nbpg}</small></div>') ;
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();

$nama_dokumen = "$number";
$mpdf->WriteHTML($html);
$mpdf->Output($nama_dokumen.".pdf" ,'I');

exit;
?>