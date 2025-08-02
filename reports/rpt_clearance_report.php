<?php

include("../include_user_check_and_files.php");
include("../include/number2words.php");

$from_branch_id = ""; $to_branch_id = ""; $from_date =""; $to_date =""; $bill_type =""; $consignee_id =""; $consignor_id= ""; $page_number = ""; $page_limit = ""; $total_lr_count = 0;
    if(isset($_REQUEST['from_branch_id'])) {
        $from_branch_id = $_REQUEST['from_branch_id'];
    }
    if(isset($_REQUEST['to_branch_id'])) {
        $to_branch_id = $_REQUEST['to_branch_id'];
    }
    if(isset($_REQUEST['from_date']))
    {
        $from_date = $_REQUEST['from_date'];
    }
    if(isset($_REQUEST['to_date']))
    {
        $to_date = $_REQUEST['to_date'];
    }
    if(isset($_REQUEST['bill_type']))
    {
        $bill_type = $_REQUEST['bill_type'];
    }
	if(isset($_REQUEST['consignee_id']))
    {
        $consignee_id = $_REQUEST['consignee_id'];
    }
    if(isset($_REQUEST['consignor_id']))
    {
        $consignor_id = $_REQUEST['consignor_id'];
    }

    if(isset($_REQUEST['page_number'])) {
        $page_number = $_REQUEST['page_number'];
    }
    if(isset($_REQUEST['page_limit'])) {
        $page_limit = $_REQUEST['page_limit'];
    }
    if(isset($_REQUEST['total_lr_count'])) {
        $total_lr_count = $_REQUEST['total_lr_count'];
    }

    $total_records_list = array();
    $total_records_list = $obj->getClearanceReportList('','', $from_branch_id, $to_branch_id,$consignee_id, $consignor_id,$bill_type, '',$from_date, $to_date,'', '', $page_number, $page_limit, $total_lr_count);
    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();
	$pdf->SetAutoPageBreak(false);
	$pdf->SetTitle('clearance Report');
    $pdf->SetFont('Arial','B',9);

    $starty = $pdf->GetY();
    $quantity_total = 0;$quantity = array();$weight = array();

    $head_y = $pdf->getY();
    $pdf->Cell(0,10,'Clearance Report',1,1,'C',0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(5,5,'#',0,0,'C',0);
    $starty = $pdf->GetY();
    $pdf->SetX(15);
    $pdf->Cell(25,5,'L.R.No.',0,1,'C',0);
    $pdf->SetX(15);
    $pdf->Cell(25,5,'Date',0,0,'C',0);
    /*$pdf->SetY($starty);
    $pdf->SetX(15);
    $pdf->Cell(25,10,'',1,0,'C',0);*/
    $pdf->SetY($starty);
    $pdf->SetX(40);
    $pdf->Cell(20,5,'Consignor',0,0,'C',0);
    $pdf->SetX(60);
    $pdf->Cell(20,5,'Consignee',0,0,'C',0);
    $pdf->SetX(80);
    $pdf->Cell(20,5,'Branch',0,0,'C',0);
    $pdf->SetX(100);
    $pdf->MultiCell(15,5,'QTY / Weight',0,'C',0);
    $a1 = $pdf->GetY();
    $pdf->SetY($starty);
    $pdf->SetX(115);
    $pdf->Cell(20,5,'Amount',0,0,'C',0);
    $pdf->SetX(135);
    $pdf->MultiCell(15,5,'Bill Type',0,'C',0);
    $a2 = $pdf->GetY();
    $pdf->SetY($starty);
    $pdf->SetX(150);
    $pdf->MultiCell(20,5,'Received Person',0,'C',0);
    $a3 = $pdf->GetY();
    $pdf->SetY($starty);
    $pdf->SetX(170);
    $pdf->MultiCell(15,5,'Received Mobile.No',0,'C',0);
    $a4 = $pdf->GetY();
    $pdf->SetY($starty);
    $pdf->SetX(185);
    $pdf->MultiCell(15,5,'Received Identity',0,'C',0);
    $a5 = $pdf->GetY();
    $pdf->SetFont('Arial','',8);

    $y2 = max(array($a1,$a2,$a3,$a4,$a5)) - $starty;

    $pdf->SetY($starty);
    $pdf->SetX(10);
    $pdf->Cell(5,$y2,'',1,0,'C',0);
    $pdf->SetX(15);
    $pdf->Cell(25,$y2,'',1,0,'C',0);
    $pdf->SetX(40);
    $pdf->Cell(20,$y2,'',1,0,'C',0);
    $pdf->SetX(60);
    $pdf->Cell(20,$y2,'',1,0,'C',0);
    $pdf->SetX(80);
    $pdf->Cell(20,$y2,'',1,0,'C',0);
    $pdf->SetX(100);
    $pdf->Cell(15,$y2,'',1,0,'C',0);
    $pdf->SetX(115);
    $pdf->Cell(20,$y2,'',1,0,'C',0);
    $pdf->SetX(135);
    $pdf->Cell(15,$y2,'',1,0,'C',0);
    $pdf->SetX(150);
    $pdf->Cell(20,$y2,'',1,0,'C',0);
    $pdf->SetX(170);
    $pdf->Cell(15,$y2,'',1,0,'C',0);
    $pdf->SetX(185);
    $pdf->Cell(15,$y2,'',1,1,'C',0);

    $y_axis = $pdf->GetY();

    $lr_details = array(); $consignor_details = array(); $consignee_details = array(); $city  = ""; $lr_state = "";
    $consignor_name = ""; $consignor_address = ""; $consignor_state = ""; $consignor_mobile_number = ""; $consignor_city = ""; $consignee_city ="";  $consignee_details = array(); $consignee_details = array();
    $consignee_name = ""; $consignee_address = ""; $consignee_state = ""; $consignee_mobile_number = ""; $consignee_city = ""; $consignee_city =""; $unit_id = ""; $unit_name = array(); $freight_charges = ""; $nloading_charges = ""; $s_no = 1;
   
    foreach($total_records_list as $key => $data) {
        
        if($pdf->GetY() >= 235){
            $y = $pdf->GetY();
            $pdf->SetX(10);
            // $pdf->Cell(10,240-$y_axis,'',1,0,'C',0);
            $pdf->SetX(20);
            // $pdf->Cell(25,240-$y_axis,'',1,0,'C',0);
            $pdf->SetX(45);
            // $pdf->Cell(20,240-$y_axis,'',1,0,'C',0);
            $pdf->SetX(65);
            // $pdf->Cell(30,240-$y_axis,'',1,0,'C',0);
            $pdf->SetX(95);
            // $pdf->Cell(30,240-$y_axis,'',1,0,'C',0);
            $pdf->SetX(125);
            // $pdf->Cell(25,240-$y_axis,'',1,0,'C',0);
            $pdf->SetX(150);
            // $pdf->Cell(25,240-$y_axis,'',1,0,'C',0);
            $pdf->SetX(175);
            // $pdf->Cell(25,240-$y_axis,'',1,1,'C',0);
    
            $pdf->SetX(10);
            $pdf->SetFont('Arial','B',9);
            $next_page = $pdf->PageNo()+1;
            $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
    
            $pdf->AddPage();
            $pdf->SetTitle('clearance Report');
            $pdf->SetFont('Arial','B',9);

            $starty = $pdf->GetY();
            $head_y = $pdf->getY();
            $pdf->Cell(0,10,'Clearance Report',1,1,'C',0);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(10);
            $pdf->Cell(5,5,'#',0,0,'C',0);
            $starty = $pdf->GetY();
            $pdf->SetX(15);
            $pdf->Cell(25,5,'L.R.No.',0,1,'C',0);
            $pdf->SetX(15);
            $pdf->Cell(25,5,'Date',0,0,'C',0);
            /*$pdf->SetY($starty);
            $pdf->SetX(15);
            $pdf->Cell(25,10,'',1,0,'C',0);*/
            $pdf->SetY($starty);
            $pdf->SetX(40);
            $pdf->Cell(20,5,'Consignor',0,0,'C',0);
            $pdf->SetX(60);
            $pdf->Cell(20,5,'Consignee',0,0,'C',0);
            $pdf->SetX(80);
            $pdf->Cell(20,5,'Branch',0,0,'C',0);
            $pdf->SetX(100);
            $pdf->MultiCell(15,5,'QTY / Weight',0,'C',0);
            $a1 = $pdf->GetY();
            $pdf->SetY($starty);
            $pdf->SetX(115);
            $pdf->Cell(20,5,'Amount',0,0,'C',0);
            $pdf->SetX(135);
            $pdf->MultiCell(15,5,'Bill Type',0,'C',0);
            $a2 = $pdf->GetY();
            $pdf->SetY($starty);
            $pdf->SetX(150);
            $pdf->MultiCell(20,5,'Received Person',0,'C',0);
            $a3 = $pdf->GetY();
            $pdf->SetY($starty);
            $pdf->SetX(170);
            $pdf->MultiCell(15,5,'Received Mobile.No',0,'C',0);
            $a4 = $pdf->GetY();
            $pdf->SetY($starty);
            $pdf->SetX(185);
            $pdf->MultiCell(15,5,'Received Identity',0,'C',0);
            $a5 = $pdf->GetY();
            $pdf->SetFont('Arial','',8);

            $y2 = max(array($a1,$a2,$a3,$a4,$a5)) - $starty;

            $pdf->SetY($starty);
            $pdf->SetX(10);
            $pdf->Cell(5,$y2,'',1,0,'C',0);
            $pdf->SetX(15);
            $pdf->Cell(25,$y2,'',1,0,'C',0);
            $pdf->SetX(40);
            $pdf->Cell(20,$y2,'',1,0,'C',0);
            $pdf->SetX(60);
            $pdf->Cell(20,$y2,'',1,0,'C',0);
            $pdf->SetX(80);
            $pdf->Cell(20,$y2,'',1,0,'C',0);
            $pdf->SetX(100);
            $pdf->Cell(15,$y2,'',1,0,'C',0);
            $pdf->SetX(115);
            $pdf->Cell(20,$y2,'',1,0,'C',0);
            $pdf->SetX(135);
            $pdf->Cell(15,$y2,'',1,0,'C',0);
            $pdf->SetX(150);
            $pdf->Cell(20,$y2,'',1,0,'C',0);
            $pdf->SetX(170);
            $pdf->Cell(15,$y2,'',1,0,'C',0);
            $pdf->SetX(185);
            $pdf->Cell(15,$y2,'',1,1,'C',0);

            $y_axis = $pdf->GetY();
        }
        $starty =$pdf->GetY();
        $pdf->SetFont('Arial','',9);
        $pdf->SetX(10);

        $pdf->Cell(5,5,$s_no,0,0,'C',0);
        $pdf->SetX(15);
        $pdf->Cell(25,5,$data['lr_number'],0,1,'C',0);
        $pdf->SetX(15);
        $pdf->MultiCell(25,5,$data['lr_date'],0,'C',0);
        $date_y = $pdf->GetY();
        $lr_state = $pdf->GetY();
        $pdf->SetY($starty);
        if(!empty($data['consignor_id']))
        {
            $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'],'consignor_id',$data['consignor_id'],'name');
            if(!empty($consignor_name))
            {
                $consignor_name = $obj->encode_decode("decrypt",$consignor_name);
            }
        }
        $pdf->SetY($starty);
        $pdf->SetX(40);
        $pdf->MultiCell(20,5,$consignor_name,0,'C',0);
        $consignor_y = $pdf->GetY();
        $account_party_name = "";
        if(!empty($data['account_party_id'])){
            $account_party_name =$obj->getTableColumnValue($GLOBALS['account_party_table'],'account_party_id',$data['account_party_id'],'name');
            if(!empty($account_party_name)){
                $account_party_name = $obj->encode_decode("decrypt",$account_party_name);
            }
        }
        if(!empty($data['consignee_id']))
        {
            $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$data['consignee_id'],'name');
            if(!empty($consignee_name))
            {
                $consignee_name = $obj->encode_decode("decrypt",$consignee_name);
            }
        }
        if(empty($consignee_name) && !empty($account_party_name)){
            $consignee_name = $account_party_name."(Acc.Party)";
        }
        $pdf->SetY($starty);
        $pdf->SetX(60);
        $pdf->MultiCell(20,5,$consignee_name,0,'C',0);
        $consignee_y = $pdf->GetY();
        $pdf->SetY($starty);
        $from_branch_name = ""; $to_branch_name = "";
        if(!empty($data['from_branch_id'])) {
            $branch_name = "";
            $branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$data['from_branch_id'],'name');
            if(!empty($branch_name) && $branch_name != $GLOBALS['null_value']) {
                $from_branch_name = $obj->encode_decode('decrypt', $branch_name);
            }
        }
        if(!empty($data['to_branch_id'])) {
            $branch_name = "";
            $branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$data['to_branch_id'],'name');
            if(!empty($branch_name) && $branch_name != $GLOBALS['null_value']) {
                $to_branch_name = $obj->encode_decode('decrypt', $branch_name);
            }
        }
        $pdf->SetX(80);
        $pdf->MultiCell(20,5,"From : ".$from_branch_name."\n"."To : ".$to_branch_name,0,'C',0);
        $branch_y = $pdf->GetY();
        $pdf->SetY($starty);
        $pdf->SetX(100);
        $total_quantity = 0;$total_weight = 0;
        if(!empty($data['quantity'])){ 
            $quantity = explode(",",$data['quantity']);
            $total_quantity = array_sum($quantity);
            // echo $total_quantity; 
        } 
        if(!empty($data['weight'])){
            $weight = explode(",",$data['weight']);
            $total_weight = array_sum($weight);
        }
        if(!empty($total_quantity) && !empty($total_weight)){
            $total_quantity = $total_quantity.",".$total_weight;
        }
        else if(!empty($total_quantity) && empty($total_weight)){
            $total_quantity = $total_quantity;
        }
        else if(empty($total_quantity) && !empty($total_weight)){
            $total_quantity = $total_weight;
        }
        if(!empty($total_quantity)){
            $pdf->MultiCell(15,5,$total_quantity,0,'C',0);
        }
        $pdf->SetY($starty);
        $pdf->SetX(115);
        $pdf->Cell(20,5,$data['total'],0,0,'C',0);
        /*$pdf->SetX(135);
        if(!empty($data['bill_type'])){ 
            $pdf->MultiCell(15,5,$data['bill_type'],0,'C',0);
            // echo $total_quantity; 
        }*/ 
      
        $unit_y = $pdf->GetY();
        $sy = $pdf->GetY();
        $pdf->SetY($starty);
        $pdf->SetY($starty);
        $pdf->SetX(135);
        if(!empty($bill_type)){ 
            if($bill_type == '1'){ $bill_type = 'To Pay'; }
            if($bill_type == '2'){ $bill_type = 'Paid'; }
        }
        $pdf->Cell(15,5,$bill_type,0,0,'C',0);

        $received_person = ""; $received_mobile_number = ""; $received_identification = "";
        if(!empty($data['received_person']) && $data['received_person'] != $GLOBALS['null_value']) {
            $received_person = $obj->encode_decode('decrypt', $data['received_person']);
        }
        if(!empty($data['received_mobile_number']) && $data['received_mobile_number'] != $GLOBALS['null_value']) {
            $received_mobile_number = $obj->encode_decode('decrypt', $data['received_mobile_number']);
        }
        if(!empty($data['received_identification']) && $data['received_identification'] != $GLOBALS['null_value']) {
            $received_identification = $obj->encode_decode('decrypt', $data['received_identification']);
        }

        $pdf->SetY($starty); 
        $pdf->SetX(150);
        $pdf->MultiCell(20,5,$received_person,0,'C',0);
        $r1_y = $pdf->GetY();

        $pdf->SetY($starty); 
        $pdf->SetX(170);
        $pdf->MultiCell(15,5,$received_mobile_number,0,'C',0);
        $r2_y = $pdf->GetY();

        $pdf->SetY($starty); 
        $pdf->SetX(185);
        $pdf->MultiCell(15,5,$received_identification,0,'C',0);
        $r3_y = $pdf->GetY();

        $pdf->SetY($sy);
        $end_y = max(array($consignee_y,$branch_y,$consignor_y,$unit_y,$city,$date_y,$r1_y,$r2_y,$r3_y));

        $pdf->SetY($starty);
        $pdf->SetX(10);
        $pdf->Cell(5,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(15);
        $pdf->Cell(25,$end_y - $starty,'',1,0,'C',0);

        $pdf->SetX(40);
        $pdf->Cell(20,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(60);
        $pdf->Cell(20,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(80);
        $pdf->Cell(20,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(100);
        $pdf->Cell(15,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(115);
        $pdf->Cell(20,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(135);
        $pdf->Cell(15,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(150);
        $pdf->Cell(20,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(170);
        $pdf->Cell(15,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(185);
        $pdf->Cell(15,$end_y - $starty,'',1,1,'C',0);

        $s_no++;
        if(!empty($quantity)){
            $quantity_total += array_sum($quantity);
        }
        if(!empty($total_weight)){
            $quantity_total += array_sum($weight);
        }
    }

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(5,240,'',1,0,'C',0);
    $pdf->SetX(15);
    $pdf->Cell(25,240,'',1,0,'C',0);

    $pdf->SetX(40);
    $pdf->Cell(20,240,'',1,0,'C',0);
    $pdf->SetX(60);
    $pdf->Cell(20,240,'',1,0,'C',0);
    $pdf->SetX(80);
    $pdf->Cell(20,240,'',1,0,'C',0);
    $pdf->SetX(100);
    $pdf->Cell(15,240,'',1,0,'C',0);
    $pdf->SetX(115);
    $pdf->Cell(20,240,'',1,0,'C',0);
    $pdf->SetX(135);
    $pdf->Cell(15,240,'',1,0,'C',0);
    $pdf->SetX(150);
    $pdf->Cell(20,240,'',1,0,'C',0);
    $pdf->SetX(170);
    $pdf->Cell(15,240,'',1,0,'C',0);
    $pdf->SetX(185);
    $pdf->Cell(15,240,'',1,1,'C',0);

    /*$pdf->SetX(40);
    $pdf->Cell(35,220,'',1,0,'C',0);
    $pdf->SetX(75);
    $pdf->Cell(35,220,'',1,0,'C',0);
    $pdf->SetX(110);
    $pdf->Cell(35,220,'',1,0,'C',0);
    $pdf->SetX(145);
    $pdf->Cell(20,220,'',1,0,'C',0);
    $pdf->SetX(165);
    $pdf->Cell(20,220,'',1,0,'C',0);
    $pdf->SetX(185);
    $pdf->Cell(15,220,'',1,1,'C',0);*/
   
    /*$pdf->SetX(10);
    $pdf->Cell(135,9,'Quantity Total',1,0,'L',0);
    $pdf->SetX(145);
    $pdf->Cell(20,9,$quantity_total,1,0,'C',0);
    $pdf->SetX(165);
    $pdf->Cell(35,9,'',1,1,'C',0);
    $end_sy = $pdf->GetY();
    $pdf->Cell(60,9,'',0,1,'L',0);*/
    // $pdf->SetX(10);
    // $pdf->Cell(30,5,'Driver Signature',0,0,'L',0);
    // $pdf->SetX(40);
    // $pdf->Cell(45,5,':_________________________',0,1,'L',0);

    // $pdf->SetY($end_sy);
    // $pdf->Cell(30,10,'',0,1,'L',0);
    // $pdf->SetX(95);
    // $pdf->Cell(30,5,'Prepared by',0,0,'C',0);

    // $pdf->SetY($end_sy);
    // $pdf->Cell(70,10,'',0,1,'L',0);
    // $pdf->SetX(125);
    // $pdf->Cell(75,5,'Authority/ Signature',0,1,'C',0);

    // $pdf->SetY($end_sy);
    // $pdf->SetX(10);
    // $pdf->cell(80,17,'',1,0,'L',0);

    // $pdf->SetX(90);
    // $pdf->Cell(30,17,'',1,0,'L',0);

    // $pdf->SetX(120);
    // $pdf->Cell(80,17,'',1,1,'L',0);
    
    $pdf->OutPut();

?>