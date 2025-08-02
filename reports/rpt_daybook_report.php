<?php

    include("../include_user_check_and_files.php");

    $from_date = date("Y-m-d"); $to_date = date("Y-m-d"); $filter_purchase_party_id = ""; $filter_consignor_id = ""; $filter_consignee_id = ""; $filter_account_party_id = ""; $filter_bill_type = ""; $filter_payment_mode_id = ""; $filter_bank_id = ""; $filter_suspense_party_id = "";

    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
        $from_date = trim($from_date);
        $from_date = date('Y-m-d', strtotime($from_date));
    }
    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
        $to_date = trim($to_date);
        $to_date = date('Y-m-d', strtotime($to_date));
    }
    if(isset($_REQUEST['filter_purchase_party_id'])) {
        $filter_purchase_party_id = $_REQUEST['filter_purchase_party_id'];
        $filter_purchase_party_id = trim($filter_purchase_party_id);
    }
    if(isset($_REQUEST['filter_consignor_id'])) {
        $filter_consignor_id = $_REQUEST['filter_consignor_id'];
        $filter_consignor_id = trim($filter_consignor_id);
    }
    if(isset($_REQUEST['filter_consignee_id'])) {
        $filter_consignee_id = $_REQUEST['filter_consignee_id'];
        $filter_consignee_id = trim($filter_consignee_id);
    }
    if(isset($_REQUEST['filter_account_party_id'])) {
        $filter_account_party_id = $_REQUEST['filter_account_party_id'];
        $filter_account_party_id = trim($filter_account_party_id);
    }
    if(isset($_REQUEST['filter_bill_type'])) {
        $filter_bill_type = $_REQUEST['filter_bill_type'];
        $filter_bill_type = trim($filter_bill_type);
    }
    if(isset($_REQUEST['filter_payment_mode_id'])) {
        $filter_payment_mode_id = $_REQUEST['filter_payment_mode_id'];
        $filter_payment_mode_id = trim($filter_payment_mode_id);
    }
    if(isset($_REQUEST['filter_bank_id'])) {
        $filter_bank_id = $_REQUEST['filter_bank_id'];
        $filter_bank_id = trim($filter_bank_id);
    }
    if(isset($_REQUEST['filter_suspense_party_id'])) {
        $filter_suspense_party_id = $_REQUEST['filter_suspense_party_id'];
        $filter_suspense_party_id = trim($filter_suspense_party_id);
    }
    $from = "";
    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }


    $sales_party_id="";
    $sales_type="";

	$total_records_list = array();
    $total_records_list = $obj->getDaybookReportList($from_date, $to_date, $filter_purchase_party_id, $filter_consignor_id, $filter_consignee_id, $filter_account_party_id, $filter_bill_type, $filter_payment_mode_id, $filter_bank_id, $filter_suspense_party_id);

    $date_display = "";
    if($from_date == $to_date){
        $date_display = '('.date('d-m-Y', strtotime($from_date)).')';
    }
    else{
        $date_display = '('.date('d-m-Y', strtotime($from_date)).' to '.date('d-m-Y', strtotime($to_date)).')';
    }




    require_once('../fpdf/fpdf.php');
    $pdf = new FPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $pdf->SetTitle('DayBook Report');
            
    $box_y = $pdf->GetY();

    $yaxis = $pdf->GetY();
    include("rpt_header.php");
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(190,8,'Daybook Report'. $date_display,1,1,'C',0);

    $current_y = $pdf->GetY();
    $pdf->SetY($yaxis);
    $pdf->SetX(10);
    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
        
    $pdf->SetFillColor(0, 123, 255);
    $pdf->SetTextColor(255,255,255);

    $pdf->SetFont('Arial','B',8);
    $y = $pdf->GetY();
    $pdf->SetX(10);
    $pdf->Cell(10,10,'S.No.',1,0,'C',1);
    $pdf->MultiCell(20,5,'Bill Number & Date',1,'C',1);
    $pdf->SetY($y);
    $pdf->SetX(40);
    $pdf->MultiCell(20,5,'Payment Type',1,'C',1);
    $pdf->SetY($y);
    $pdf->SetX(60);
    $pdf->Cell(20,10,'Party Type',1,0,'C',1);
    $pdf->Cell(50,10,'Particular',1,0,'C',1);
    $pdf->Cell(30,10,'Payment Mode',1,0,'C',1);
    $pdf->Cell(20,10,'Credit',1,0,'C',1);
    $pdf->Cell(20,10,'Debit',1,1,'C',1);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',7);
    $starty = $pdf->GetY();
    $index = 1; $total_credit = 0; $total_debit = 0; $str_bill_no = "";
    $credit_amount = 0; $debit_amount = 0; $balance = 0; $balance_str = "";
 
    if (!empty($total_records_list)) {
        $grouped = [];
        foreach ($total_records_list as $key => $data) {

            $bill_number = ""; $payment_mode = ""; $bank_mode = "";
            if(!empty($data['bill_number']) && $data['bill_number'] != $GLOBALS['null_value']) {
                $bill_number = $data['bill_number'];
            }
            if ($bill_number == '') continue; 

            if(!empty($data['payment_mode_id']) && $data['payment_mode_id'] != $GLOBALS['null_value']) {
                $payment_mode = $data['payment_mode_id'];
            }
            if(!empty($data['bank_id']) && $data['bank_id'] != $GLOBALS['null_value']) {
                $bank_mode = $data['bank_id'];
            }

            if (!isset($grouped[$bill_number])) {
                $grouped[$bill_number] = [
                    'bill_date' => $data['bill_date'],
                    'bill_type' => $data['bill_type'],
                    'bill_id' => $data['bill_id'],
                    'party_type' => $data['party_type'],
                    'party_id' => $data['party_id'],
                    'payment_modes' => [],
                    'bank_modes' => [],
                    'credit' => 0,
                    'debit' => 0
                ];
            }

            if (!in_array($payment_mode, $grouped[$bill_number]['payment_modes'])) {
                if((empty($filter_payment_mode_id) || (!empty($filter_payment_mode_id) && $filter_payment_mode_id == $payment_mode)) && (empty($filter_bank_id) || (!empty($filter_bank_id) && $filter_bank_id == $bank_mode))) {
                    $grouped[$bill_number]['payment_modes'][] = $payment_mode;
                    $grouped[$bill_number]['bank_modes'][] = $bank_mode;
                    if(!empty($data['credit'])) {
                        $grouped[$bill_number]['credit'] += $data['credit'];
                    }
                    if(!empty($data['debit'])) {
                        $grouped[$bill_number]['debit'] += $data['debit'];
                    }
                }
            }
        }

        $index = 1;
        foreach ($grouped as $bill_number => $info) {
            
            if ($pdf->GetY() > 265) {
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(285);
                $pdf->SetX(10);
                $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();
                $box_y = $pdf->GetY();

                $yaxis = $pdf->GetY();
                include("rpt_header.php");
                $pdf->SetFont('Arial','B',9);
                $pdf->SetX(10);
                $pdf->Cell(190,8,'Daybook Report'. $date_display,1,1,'C',0);

                $current_y = $pdf->GetY();
                $pdf->SetY($yaxis);
                $pdf->SetX(10);
                $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
                    
                $pdf->SetFillColor(0, 123, 255);
                $pdf->SetTextColor(255,255,255);   
                $pdf->SetFont('Arial','B',8);
                $y = $pdf->GetY();
                $pdf->SetX(10);
                $pdf->Cell(10,10,'S.No.',1,0,'C',1);
                $pdf->MultiCell(20,5,'Bill Number & Date',1,'C',1);
                $pdf->SetY($y);
                $pdf->SetX(40);
                $pdf->MultiCell(20,5,'Payment Type',1,'C',1);
                $pdf->SetY($y);
                $pdf->SetX(60);
                $pdf->Cell(20,10,'Party Type',1,0,'C',1);
                $pdf->Cell(50,10,'Particular',1,0,'C',1);
                $pdf->Cell(30,10,'Payment Mode',1,0,'C',1);
                $pdf->Cell(20,10,'Credit',1,0,'C',1);
                $pdf->Cell(20,10,'Debit',1,1,'C',1);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetFont('Arial','',7);
            }

            $pdf->SetFont('Arial','',8);
            $starty = $pdf->GetY();
            $pdf->SetX(10);
            $pdf->Cell(10, 4, $index, 0, 0, 'C', 0);

            // if(!empty($info['bill_number'])){
            //     $bill_number = $info['bill_number'];
            // }

            if(!empty($info['bill_date'])){
                $bill_date = date('d-m-Y', strtotime($info['bill_date']));
            }

            $combined_data = "";
            $combined_data = $bill_number."\n". $bill_date;

            
            $pdf->SetX(20);
            $pdf->MultiCell(20, 4, $combined_data ?? '', 0, 'C', 0);
            $bill_date_y = $pdf->GetY();

            // Bill Type
            $pdf->SetY($starty);
            $pdf->SetX(40);
            $pdf->MultiCell(20, 4, $info['bill_type'] ?? '', 0,'C', 0);
            $bill_type_y = $pdf->GetY();

            $pdf->SetY($starty);
            $pdf->SetX(60);
            $pdf->MultiCell(20, 4, $info['party_type'] ?? '', 0,'C', 0);
            $party_type_y = $pdf->GetY();

            // Party Name
            $pdf->SetY($starty);
            $pdf->SetX(80);
            if($info['bill_type'] == "Expense") {
                $expense_name = "";
                $expense_name = $obj->getTableColumnValue($GLOBALS['expense_table'], 'expense_id', $info['bill_id'], 'expense_category_name');
                $expense_name = $obj->encode_decode('decrypt',$expense_name);
                $pdf->MultiCell(50, 8, $expense_name ?: ' - ', 0, 'C', 0);
            } 
            else{
                if (!empty($info['party_type']) && !empty($info['party_id'])) {
                    if ($info['party_type'] == 'Purchase Party') {
                        $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $info['party_id'], 'name_mobile_city');
                    } 
                    elseif ($info['party_type'] == 'Consignor') {
                        $party_name = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $info['party_id'], 'name');
                    } 
                    elseif ($info['party_type'] == 'Consignee') {
                        $party_name = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $info['party_id'], 'name');
                    } 
                    elseif ($info['party_type'] == 'Account Party') {
                        $party_name = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'account_party_id', $info['party_id'], 'name');
                    }

                    $party_name = $obj->encode_decode('decrypt',$party_name);
                } 
                $pdf->MultiCell(50, 4, $party_name ?: ' - ', 0, 'C', 0);
            }

            $name_y = $pdf->GetY();

            $payment_mode_ids = array();
            $payment_mode_ids = $info['payment_modes'];
            $bank_ids = array(); $particulars = "";
            $bank_ids = $info['bank_modes'];
            if(!empty($payment_mode_ids)) {
                for($i=0; $i < count($payment_mode_ids); $i++) {
                    $payment_mode_name = "";
                    $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_ids[$i], 'payment_mode_name');
                    $bank_name = "";
                    $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_ids[$i], 'bank_name');
                    if(!empty($payment_mode_name) && $payment_mode_name != $GLOBALS['null_value']) {
                        $particulars .= $obj->encode_decode('decrypt', $payment_mode_name);
                    }
                    if(!empty($bank_name) && $bank_name != $GLOBALS['null_value']) {
                        $particulars .=  ' - '.$obj->encode_decode('decrypt', $bank_name);
                    }
                    if($i != (count($payment_mode_ids) - 1)) {
                        $particulars .= "\n";
                    }
                }
            }

            $pdf->SetY($starty);
            $pdf->SetX(130);
            $pdf->MultiCell(30, 4, $particulars ?: ' - ', 0, 'C', 0);

            $particulars_y = $pdf->GetY();

            $pdf->SetY($starty);
            $pdf->SetX(160);
            $pdf->SetTextColor(18, 224, 25);
            $pdf->MultiCell(20, 4, $obj->numberFormat($info['credit'], 2), 0, 'R', 0);
            
            $total_credit += $info['credit'];
            $credit_y = $pdf->GetY();

            $pdf->SetY($starty);
            $pdf->SetX(180);
            $pdf->SetTextColor(255,0,0);
            $pdf->MultiCell(20, 4, $obj->numberFormat($info['debit'], 2), 0, 'R', 0);
            
            $total_debit += $info['debit'];
            $debit_y = $pdf->GetY();

            // Border Drawing
            $pdf->SetTextColor(0,0,0);

            $final_end_y = max($bill_date_y, $bill_type_y, $party_type_y, $name_y, $particulars_y, $credit_y, $debit_y);
            $pdf->SetY($starty);
            $pdf->Cell(10, $final_end_y - $starty, '', 1, 0, 'C', 0);
            $pdf->Cell(20, $final_end_y - $starty, '', 1, 0, 'C', 0);
            $pdf->Cell(20, $final_end_y - $starty, '', 1, 0, 'C', 0);
            $pdf->Cell(20, $final_end_y - $starty, '', 1, 0, 'C', 0);
            $pdf->Cell(50, $final_end_y - $starty, '', 1, 0, 'C', 0);
            $pdf->Cell(30, $final_end_y - $starty, '', 1, 0, 'C', 0);
            $pdf->Cell(20, $final_end_y - $starty, '', 1, 0, 'C', 0);
            $pdf->Cell(20, $final_end_y - $starty, '', 1, 1, 'C', 0);
            $index++;
        }
    }

    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetX(10);
    $pdf->Cell(150, 8, 'Total', 1, 0, 'R', 0);
    $pdf->SetTextColor(18, 224, 25);
    if(strlen($obj->numberFormat($total_credit,2)) <= 15) {
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(20, 8, $obj->numberFormat($total_credit,2), 1, 0, 'R', 0);
    }
    else {
        $pdf->SetFont('Arial', '', 5);
        $pdf->Cell(20, 8, $obj->numberFormat($total_credit,2), 1, 0, 'R', 0);
    }
    $pdf->SetTextColor(255,0,0);
    if(strlen($obj->numberFormat($total_debit,2)) <= 15) {
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(20, 8, $obj->numberFormat($total_debit,2), 1, 1, 'R', 0);
    }
    else {
        $pdf->SetFont('Arial', '', 5);
        $pdf->Cell(20, 8, $obj->numberFormat($total_debit,2), 1, 1, 'R', 0);
    }
    $pdf->SetTextColor(0,0,0);
    $pdf->SetX(10);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(150, 8, 'Current Balance', 1, 0, 'R', 0);
        

    $balance = $total_credit - $total_debit;

    $balance_str = $obj->numberFormat(abs($balance), 2);
    $font_size = (strlen($balance_str) <= 15) ? 7 : 5;
    $pdf->SetFont('Arial', '', $font_size);

    if ($total_credit > $total_debit) {
        $pdf->SetTextColor(18, 224, 25);
        $pdf->Cell(20, 8, $balance_str, 1, 0, 'R', 0); 
        $pdf->Cell(20, 8, '', 1, 1, 'R', 0);           
    } elseif ($total_debit > $total_credit) {
        $pdf->SetTextColor(255,0,0);
        $pdf->Cell(20, 8, '', 1, 0, 'R', 0);           
        $pdf->Cell(20, 8, $balance_str, 1, 1, 'R', 0); 
    } else {
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(20, 8, '', 1, 0, 'R', 0);
        $pdf->Cell(20, 8, '', 1, 1, 'R', 0);
    }
    $pdf->SetTextColor(0,0,0);
        
    $pdf->SetFont('Arial','I',7);
    $pdf->SetY(285);
    $pdf->SetX(10);
    $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    $pdf->SetTextColor(0,0,0);
    
    $pdf_name = "Daybook Report".$date_display.".pdf";
    $pdf->Output($from, $pdf_name);
?> 
       