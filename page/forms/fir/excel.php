<?php
include "../../configs/config.php";
include "../../libs/phpexcel/phpexcel.php";

$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];
$final = $_GET['final'];

if($final != "ALL"){
	$finalx = "AND final = '$final'";
}
else{
	$finalx = "";
}

$now = date("Ymd");
$filename = "FIR_".$final."_FROM_".$startdate."_TO_".$enddate."_".date('YmdHis');

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Jakarta');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once '../../libs/phpexcel/phpexcel.php';

$objPHPExcel = new PHPExcel();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename .'.xlsx"');
header('Cache-Control: max-age=0');
$objPHPExcel->getProperties()->setCreator("Maulana Andani, S.Kom")
							 ->setLastModifiedBy("Maulana Andani, S.Kom")
							 ->setTitle("PHPExcel Document")
							 ->setSubject("PHPExcel Document")
							 ->setDescription("Document for PHPExcel, generated using PHP classes")
							 ->setKeywords("Office PHPExcel PHP")
							 ->setCategory("Result File");

// STYLE EXCEL
const BORDER_NONE = 'none';
const BORDER_DASHDOT = 'dashDot';
const BORDER_DASHDOTDOT = 'dashDotDot';
const BORDER_DASHED = 'dashed';
const BORDER_DOTTED = 'dotted';
const BORDER_DOUBLE = 'double';
const BORDER_HAIR = 'hair';
const BORDER_MEDIUM = 'medium';
const BORDER_MEDIUMDASHDOT = 'mediumDashDot';
const BORDER_MEDIUMDASHDOTDOT = 'mediumDashDotDot';
const BORDER_MEDIUMDASHED = 'mediumDashed';
const BORDER_SLANTDASHDOT = 'slantDashDot';
const BORDER_THICK = 'thick';
const BORDER_THIN = 'thin';

// SET INDEX 0 (SHEET 1) ////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(0);

// STYLE SHEET 1
$objPHPExcel->getActiveSheet()->setTitle("FIR_".$final);

$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(1);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
			->setCellValue('B1', 'Number')
			->setCellValue('C1', 'Datecreated')
			->setCellValue('D1', 'Customer Name')
			->setCellValue('E1', 'Part Number')
			->setCellValue('F1', 'Part Name')
			->setCellValue('G1', 'Check Code')
			->setCellValue('H1', 'Batch Number')
			->setCellValue('I1', 'Total LOT QTY')
			->setCellValue('J1', 'Standard QC')
			->setCellValue('K1', 'Last Known Issue')
			->setCellValue('L1', 'Issue From Production')
			->setCellValue('M1', 'Receipt From Production')
			->setCellValue('N1', 'Inventory Transfer')
			->setCellValue('O1', 'Final Decision')
			->setCellValue('P1', 'Remark')
			->setCellValue('Q1', 'Status Form');
			
//DETAIL
$no = 2;
$i = 1;
$sql = "
SELECT * 
FROM form_fir
WHERE 1=1
AND status<>'-1'
AND datecreated BETWEEN '$startdate' AND '$enddate'
$finalx
ORDER BY number DESC
";
$stmt = mysql_query($sql);
while($r = mysql_fetch_array($stmt)){
	
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
	if($standardqc == "TL3"){
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

	if($r['status'] == "-1"){
		$status = "Canceled";
	} 
	else if($r['status'] == "0"){
		$status = "Opened";
	}
	else if($r['status'] == "1"){
		$status = "Revised";
	}
	else if($r['status'] == "2"){
		$status = "Approved";
	}
	else if($r['status'] == "3"){
		$status = "Closed";
	}
	else{
		$status = "";
	}
	
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$no, $i);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$no, $number);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$no, $datecreated);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$no, $customername);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$no, $partnumber);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$no, $partname);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$no, $checkcode);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$no, $batchnumber);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$no, $totallotqty);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$no, $standardqc);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$no, $lastissue);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$no, $issueproduction);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$no, $receiptproduction);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$no, $inventorytransfer);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$no, $final);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$no, $remark);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$no, $status);

	$no++;
	$i++;
}

//FORMAT CENTER
$center = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
$objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($center);
$objPHPExcel->getActiveSheet()->getStyle('A2:C'.($no-1))->applyFromArray($center);
$objPHPExcel->getActiveSheet()->getStyle('J2:J'.($no-1))->applyFromArray($center);
$objPHPExcel->getActiveSheet()->getStyle('L2:O'.($no-1))->applyFromArray($center);
$objPHPExcel->getActiveSheet()->getStyle('Q2:Q'.($no-1))->applyFromArray($center);
//FORMAT BACKGROUND
$warna = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'BFBFBF')
        )
    );
$objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($warna);

$objPHPExcel->setActiveSheetIndex(0);
// END SET INDEX 0 (SHEET 1) ////////////////////////////////////////////////////////////////////////////////////////

// Save Excel 2007 file

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

// Save Excel 95 file
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//$objWriter->save(str_replace('.php', '.xls', __FILE__));
//$objWriter->save($bulan[0].'_'.$bulan[1].'.xls');
$objWriter->save('php://output');
?>