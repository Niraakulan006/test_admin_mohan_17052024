<?php
include("../include_user_check_and_files.php");
include("../include/number2words.php");

$suspense_receipt_id = "";
if(isset($_REQUEST['view_suspense_receipt_id'])) {
    $view_suspense_receipt_id = $_REQUEST['view_suspense_receipt_id'];
}
$from = "";
if(isset($_REQUEST['from'])) {
    $from = $_REQUEST['from'];
}

$suspense_receipt_list = array();
$suspense_receipt_list = $obj->getAllRecords($GLOBALS['suspense_receipt_table'], 'suspense_receipt_id', $view_suspense_receipt_id);

$suspense_receipt_number = ""; $suspense_receipt_date = ""; $suspense_party_id = ""; $suspense_party_name = "";$narration = ""; $amounts = array(); $payment_mode_ids = array(); $payment_mode_names = array(); $bank_ids = array(); 
$bank_names = array(); $total_amount = 0; $deleted = 0; $company_id = "";

if(!empty($suspense_receipt_list)) {
    foreach($suspense_receipt_list as $data) {
        if(!empty($data['bill_company_id']) && $data['bill_company_id'] != $GLOBALS['null_value']) {
            $company_id = $data['bill_company_id'];
        }
        if(!empty($data['suspense_receipt_number']) && $data['suspense_receipt_number'] != $GLOBALS['null_value']) {
            $suspense_receipt_number = $data['suspense_receipt_number'];
        }
        if(!empty($data['suspense_receipt_date']) && $data['suspense_receipt_date'] != "0000-00-00") {
            $suspense_receipt_date = date('d-m-Y', strtotime($data['suspense_receipt_date']));
        }
        if(!empty($data['suspense_party_id']) && $data['suspense_party_id'] != $GLOBALS['null_value']) {
            $suspense_party_id = $data['suspense_party_id'];
        }
        if(!empty($data['suspense_party_name']) && $data['suspense_party_name'] != $GLOBALS['null_value']) {
            $suspense_party_name = $obj->encode_decode('decrypt', $data['suspense_party_name']);
        }
        if(!empty($data['narration']) && $data['narration'] != $GLOBALS['null_value']) {
            $narration = $obj->encode_decode('decrypt', $data['narration']);
        }
        if(!empty($data['amount']) && $data['amount'] != $GLOBALS['null_value']) {
            $amounts = explode(',', $data['amount']);
            $amounts = array_reverse($amounts);
        }
        if(!empty($data['payment_tax_type']) && $data['payment_tax_type'] != $GLOBALS['null_value']) {
            $payment_tax_types = explode(',', $data['payment_tax_type']);
            $payment_tax_types = array_reverse($payment_tax_types);
        }
        if(!empty($data['payment_mode_id']) && $data['payment_mode_id'] != $GLOBALS['null_value']) {
            $payment_mode_ids = explode(',', $data['payment_mode_id']);
            $payment_mode_ids = array_reverse($payment_mode_ids);
        }
        if(!empty($data['payment_mode_name']) && $data['payment_mode_name'] != $GLOBALS['null_value']) {
            $payment_mode_names = explode(',', $data['payment_mode_name']);
            $payment_mode_names = array_reverse($payment_mode_names);
        }
        if(!empty($data['bank_id']) && $data['bank_id'] != $GLOBALS['null_value']) {
            $bank_ids = explode(',', $data['bank_id']);
            $bank_ids = array_reverse($bank_ids);
        }
        if(!empty($data['bank_name']) && $data['bank_name'] != $GLOBALS['null_value']) {
            $bank_names = explode(',', $data['bank_name']);
            $bank_names = array_reverse($bank_names);
        }
        if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
            $total_amount = $data['total_amount'];
        }
        if(!empty($data['deleted'])) {
            $deleted = $data['deleted'];
        }
    }
}

$company_list = array();
$company_list = $obj->getTableRecords($GLOBALS['organization_table'], 'organization_id', $company_id, '');

$company_name = ""; $company_city = ""; $company_district = ""; $company_state = "";$company_mobile_number = ""; $company_gst_number = "";

if(!empty($company_list)) {
    foreach($company_list as $data) {
        if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
            $company_name = html_entity_decode($obj->encode_decode('decrypt', $data['name']));
        }
        if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
            $company_city = $obj->encode_decode('decrypt', $data['city']);
        }
        if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
            $company_district = $obj->encode_decode('decrypt', $data['district']);
        }
        if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
            $company_state = $obj->encode_decode('decrypt', $data['state']);
        }
        if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
            $company_mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
        }
        if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']) {
            $company_gst_number = $obj->encode_decode('decrypt', $data['gst_number']);
        }
    }
}



$suspense_party_list = array();
$suspense_party_list = $obj->getTableRecords($GLOBALS['suspense_party_table'], 'suspense_party_id', $suspense_party_id, '');

$suspense_party_mobile_number = ""; $suspense_party_address = ""; $suspense_party_state = "";

if(!empty($suspense_party_list)) {
    foreach($suspense_party_list as $data) {
        if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
            $suspense_party_mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
        }
        if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
            $suspense_party_address = $obj->encode_decode('decrypt', $data['address']);
        }
        if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
            $suspense_party_state = $obj->encode_decode('decrypt', $data['state']);
        }
    }
}

require_once('../fpdf/AlphaPDF.php');
$pdf = new AlphaPDF('L','mm','A5');
$pdf->AliasNbPages(); 
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetTitle('Suspense Receipt');
$pdf->SetFont('Arial','B',10);
$pdf->SetY(5);
$pdf->Cell(0,5,'Suspense Receipt',0,1,'C');
$header_y = $pdf->GetY();
$pdf->SetY(10);
$pdf->Cell(190,128,'',1,0,'C');

if($deleted == '1') {
    if(file_exists('../include/images/cancelled.jpg')) {
        $pdf->SetAlpha(0.3);
        $pdf->Image('../include/images/cancelled.jpg',70,50,70,30);
        $pdf->SetAlpha(1);
    }
}

$pdf->SetFont('Arial','B',12);
$pdf->SetY($header_y);
$pdf->SetX(10);
$pdf->Cell(190,6,$company_name,0,1,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,3,$company_city.', '.$company_district.' (Dist.)',0,1,'C');
$pdf->Cell(190,3,$company_state,0,1,'C');
$pdf->Cell(190,3,'Contact : '.$company_mobile_number,0,1,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,4,'GST IN : '.$company_gst_number,0,1,'C');

$pdf->SetY($header_y);
$pdf->SetX(10);
$pdf->Cell(190,20,'',1,1,'C');
$header_end_y = $pdf->GetY();

$pdf->SetTextColor(0,130,0);
$pdf->SetFont('Arial','B',9);
$pdf->SetY($header_end_y);
$pdf->SetX(12);
$pdf->Cell(93,5,'To',0,1,'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',8);
$pdf->SetX(20);
if(!empty($suspense_party_name) && $suspense_party_name !=$GLOBALS['null_value']){
    $pdf->Cell(85,4,'Mr/Mrs. '.$suspense_party_name.',',0,1,'L');
    if(!empty($suspense_party_city)) {
        $pdf->SetX(20);
        $pdf->Cell(85,4,$suspense_party_city.',',0,1,'L');
    }
    if(!empty($suspense_party_address)){
        $pdf->SetX(20);
        $pdf->Cell(85,4,$suspense_party_address.'.',0,1,'L');
    }
    $pdf->SetX(20);
    $pdf->Cell(85,4,'Contact : '.$suspense_party_mobile_number,0,1,'L');
}
$suspense_party_y = $pdf->GetY();

$pdf->SetTextColor(0,130,0);
$pdf->SetFont('Arial','B',9);
$pdf->SetY($header_end_y+1);
$pdf->SetX(110);
$pdf->Cell(40,6,'Suspense Receipt No ',0,0,'L');
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3,6,':',0,0,'L');
$pdf->Cell(57,6,$suspense_receipt_number,0,1,'L');
$pdf->SetTextColor(0,130,0);
$pdf->SetX(110);
$pdf->Cell(40,6,'Suspense Receipt Date ',0,0,'L');
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3,6,':',0,0,'L');
$pdf->Cell(57,6,$suspense_receipt_date,0,1,'L');
$bill_y = $pdf->GetY();

$pdf->SetY($header_end_y);
$pdf->SetX(10);
$pdf->Cell(95,24,'',1,0,'C');
$pdf->Cell(95,24,'',1,1,'C');
$bill_end_y = $pdf->GetY();

$pdf->SetTextColor(0,130,0);
$pdf->SetFont('Arial','B',9);
$pdf->SetY($bill_end_y);
$pdf->SetX(12);
$pdf->Cell(30,5,'Remarks ',0,0,'L');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',8);
$pdf->SetX(42);
$pdf->Cell(3,5,' : ',0,0,'L');
$pdf->SetX(45);
$pdf->MultiCell(155,5,$narration,0,'L');
$remarks_y = $pdf->GetY();

$pdf->SetY($bill_end_y);
$pdf->SetX(10);
$pdf->Cell(190,10,'',1,1,'C');
$remarks_end_y = $pdf->GetY();
$end_remarks_y = $remarks_end_y;

$pdf->SetTextColor(0,130,0);
$pdf->SetFont('Arial','B',9);
$pdf->SetY($remarks_end_y);
$pdf->SetX(12);
$pdf->Cell(30,5,'Payment Mode ',0,0,'L');
$pdf->SetTextColor(0,0,0);
if(!empty($payment_mode_names)) {
    for($i=0; $i < count($payment_mode_names); $i++) {
        $colon = ""; $cell_size = 155; $x_value = 45;
        if($i == '0') {
            $colon = ' :  '; 
            $cell_size = 158; 
            $x_value = 42;
        }
        $pdf->SetFont('Arial','B',8);
        $pdf->SetY($remarks_end_y);
        $pdf->SetX($x_value);
        if(!empty($bank_names[$i])) {
            $pdf->Cell($cell_size,5,$colon.($obj->encode_decode('decrypt', $payment_mode_names[$i])).' ('.($obj->encode_decode('decrypt', $bank_names[$i])).') - '.($obj->numberFormat($amounts[$i],2)),0,1,'L');
        }
        else {
            $pdf->Cell($cell_size,5,$colon.($obj->encode_decode('decrypt', $payment_mode_names[$i])).' - '.($obj->numberFormat($amounts[$i],2)),0,1,'L');
        }
        $remarks_end_y += 5;
    }
}
$payment_end_y = $pdf->GetY();

$pdf->SetY($end_remarks_y);
$pdf->SetX(10);
$pdf->Cell(190,(87 - $end_remarks_y),'',1,1,'C');
$end_payment_y = $pdf->GetY();

$pdf->SetFont('Arial','B',9);
$pdf->SetY(89);
$pdf->SetX(12);
$pdf->Cell(30,5,'Total Amount ',0,0,'L');
$pdf->SetTextColor(0,130,0);
$pdf->Cell(158,5,' :  '.$obj->numberFormat($total_amount,2),0,1,'L');
$pdf->SetTextColor(0,0,0);

$pdf->SetY(87);
$pdf->SetX(10);
$pdf->Cell(190,9,'',1,1,'C');

$pdf->SetFont('Arial','B',9);
$pdf->SetY(98);
$pdf->SetX(12);
$pdf->Cell(30,5,'Amount in words ',0,0,'L');
$pdf->SetX(42);
$pdf->Cell(3,5,' : ',0,0,'L');
$pdf->SetTextColor(0,130,0);
$pdf->SetX(45);
$pdf->MultiCell(155,5,getIndianCurrency($total_amount),0,'L');
$pdf->SetTextColor(0,0,0);

$pdf->SetY(96);
$pdf->SetX(10);
$pdf->Cell(190,14,'',1,1,'C');

$pdf->SetFont('Arial','B',9);
$pdf->SetY(130);
$pdf->SetX(12);
$pdf->Cell(93,5,'(Verified)',0,0,'L');
$pdf->SetX(107);
$pdf->Cell(90,5,' Authorized Signature',0,1,'R');

$pdf->SetY(110);
$pdf->SetX(10);
$pdf->Cell(190,28,'',1,1,'C');

$pdf->Output($from, $suspense_receipt_number.'.pdf');
?>