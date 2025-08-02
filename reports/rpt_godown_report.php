<?php

include("../include_user_check_and_files.php");
include("../include/number2words.php");

$branch_id =""; $from_date =""; $to_date =""; $bill_type =""; $consignee_id =""; $consignor_id= ""; $godown_id ="";
   
    if(isset($_REQUEST['from_date']))
    {
        $from_date = $_REQUEST['from_date'];
    }
    if(isset($_REQUEST['to_date']))
    {
        $to_date = $_REQUEST['to_date'];
    }
    if(isset($_REQUEST['godown_id']))
    {
        $godown_id = $_REQUEST['godown_id'];
    }
    $branch_id ="";
    if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['branch_staff_user_type']) {
        $branch_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_branch_id'];
    }
    
	
    $total_records_list = array();
    $total_records_list = $obj->getGodownReport($godown_id,$from_date,$to_date,$branch_id);
    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();
	$pdf->SetAutoPageBreak(false);
	$pdf->SetTitle('Godown Report');
    $pdf->SetFont('Arial','B',9);

    $starty = $pdf->GetY();
    $quantity_total = "";

    $head_y = $pdf->getY();
    $pdf->Cell(0,10,'Godown Report',1,1,'C',0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(30,10,'S.No',1,0,'C',0);
    $starty = $pdf->GetY();
    $pdf->SetX(40);
    $pdf->Cell(60,10,'Godown',1,0,'C',0);
    $pdf->SetX(100);
    $pdf->Cell(35,10,'Date',1,0,'C',0);
    $pdf->SetX(135);
    $pdf->Cell(35,10,'LR Number',1,0,'C',0);
    $pdf->SetX(170);
    $pdf->Cell(30,10,'Bill Type',1,1,'C',0);
    $pdf->SetFont('Arial','',8);

    $y_axis = $pdf->GetY();

    $lr_details = array(); $consignor_details = array(); $consignee_details = array(); $city  = ""; $lr_state = "";
    $consignor_name = ""; $consignor_address = ""; $consignor_state = ""; $consignor_mobile_number = ""; $consignor_city = ""; $consignee_city ="";  $consignee_details = array(); $consignee_details = array(); $grand_amount = 0;
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
            $pdf->SetTitle('Godown Report');
            $pdf->SetFont('Arial','B',9);

            $starty = $pdf->GetY();
            $quantity_total = "";

            $head_y = $pdf->getY();
            $pdf->Cell(0,10,'Godown Report',1,1,'C',0);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(10);
            $pdf->Cell(30,10,'S.No',1,0,'C',0);
            $starty = $pdf->GetY();
            $pdf->SetX(40);
            $pdf->Cell(60,10,'Godown',1,0,'C',0);
            $pdf->SetX(100);
            $pdf->Cell(35,10,'Date',1,0,'C',0);
            $pdf->SetX(135);
            $pdf->Cell(35,10,'LR Number',1,0,'C',0);
            $pdf->SetX(170);
            $pdf->Cell(30,10,'Bill Type',1,1,'C',0);
            $pdf->SetFont('Arial','',8);

            $pdf->SetFont('Arial','',8);
        
            $pdf->SetFont('Arial','',8);
        }
        $starty =$pdf->GetY();
        $pdf->SetFont('Arial','',9);
        $pdf->SetX(10);

        $pdf->Cell(40,5,$s_no,0,0,'C',0);
        $pdf->SetX(40);
        if(!empty($data['godown_id'])) { 
            $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$data['godown_id'],'name');
            $godown_name =  $obj->encode_decode('decrypt',$godown_name);
        }
        $pdf->MultiCell(60,5,$godown_name,0,'C',0);
        $date_y = $pdf->GetY();
        $pdf->SetY($starty);
        $pdf->SetX(135);
        $pdf->Cell(35,5,$data['lr_number'],0,0,'C',0);
        $pdf->SetX(100);
        $pdf->Cell(35,5,$data['lr_date'],0,0,'C',0);
        $pdf->SetX(170);
        $pdf->Cell(30,5,$data['total'],0,1,'C',0);
        $grand_amount+=$data['total']; 
        $end_y = max(array($date_y));

        $pdf->SetY($starty);
        $pdf->SetX(10);
        $pdf->Cell(30,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(40);
        $pdf->Cell(60,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(100);
        $pdf->Cell(35,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(135);
        $pdf->Cell(35,$end_y - $starty,'',1,0,'C',0);
        $pdf->SetX(170);
        $pdf->Cell(30,$end_y - $starty,'',1,1,'C',0);
       
        $s_no++;
        // $quantity_total = array_sum($quantity);
    }

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(30,220,'',1,0,'C',0);
    $pdf->SetX(40);
    $pdf->Cell(60,220,'',1,0,'C',0);
    $pdf->SetX(100);
    $pdf->Cell(35,220,'',1,0,'C',0);
    $pdf->SetX(135);
    $pdf->Cell(35,220,'',1,0,'C',0);
    $pdf->SetX(170);
    $pdf->Cell(30,220,'',1,1,'C',0);
    
   
    $pdf->SetX(10);
    $pdf->Cell(160,9,' Total',1,0,'L',0);
    $pdf->SetX(170);
    $pdf->Cell(30,9,number_format($grand_amount,2),1,0,'C',0);
    $end_sy = $pdf->GetY();
   
    
    $pdf->OutPut();

?>