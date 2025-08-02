<?php

    include("../include_user_check_and_files.php");
    
    $from = "";
    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }
    $payment_mode_list = array(); 
    $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], '', '', '');

    $bank_list = array(); 
    $bank_list = $obj->getTableRecords($GLOBALS['bank_table'], '','', '');

    $filter_party_id =""; 
    if(isset($_REQUEST['filter_party_id'])) {
        $filter_party_id = $_REQUEST['filter_party_id'];
    }
    
    $filter_bill_type="";
    if(isset($_REQUEST['filter_bill_type'])) {
        $filter_bill_type = $_REQUEST['filter_bill_type'];
    }

    $from_date = "";
    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }
    
    $to_date = "";
    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }

    $filter_payment_mode_id="";
    if(isset($_REQUEST['filter_payment_mode_id'])) {
        $filter_payment_mode_id = $_REQUEST['filter_payment_mode_id'];
    }

    $filter_bank_id="";
    if(isset($_REQUEST['filter_bank_id'])) {
        $filter_bank_id = $_REQUEST['filter_bank_id'];
    }

    $filter_category_id="";
    if(isset($_REQUEST['filter_category_id'])) {
        $filter_category_id = $_REQUEST['filter_category_id'];
    }

    $filter_expense_category_id = "";
    if(isset($_REQUEST['filter_expense_category_id'])) {
        $filter_expense_category_id = $_REQUEST['filter_expense_category_id'];
    }
    
    $party_list = array();
    $party_list = $obj->getPaymentPartyList($filter_bill_type); 

    $category_list = array();
    $category_list = $obj->getTableRecords($GLOBALS['expense_category_table'],'','','');

    $payment_list =array();
    $payment_list = $obj->getPaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_id,$filter_payment_mode_id,$filter_bank_id,$filter_category_id, $filter_expense_category_id);
   
    if(!empty($from_date)){
        $from_date = date('d-m-Y', strtotime($from_date));
    }
    if(!empty($to_date)){
        $to_date = date('d-m-Y', strtotime($to_date));
    }

    $date_display = "";
    if(!empty($from_date) && !empty($to_date)) {
        $date_display = "(";
    }
    if(!empty($from_date)) {
        $date_display = $from_date;
    }

    if(!empty($from_date) && !empty($to_date)) {
        $date_display .= ' - ';
    }

    if(!empty($to_date)) {
        $date_display .= $to_date;
    }
    if(!empty($from_date) && !empty($to_date)) {
        $date_display .= ")";
    }

    require_once('../fpdf/fpdf.php');

    $pdf = new FPDF('P','mm','A4');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();
	$pdf->SetAutoPageBreak(false);
	
    $file_name = "Payment Report";
    include("rpt_header.php");

    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(190,7,'Payment Report '.$date_display ,1,1,'C',0);
    
    $pdf->SetFont('Arial','B',7);
    $y = $pdf->GetY();

    $pdf->SetFillColor(101,114,122);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetX(10);
    $pdf->Cell(10,8,'#',1,0,'C',1);
    $pdf->Cell(27,4,'Date',0,1,'C',1);
    $pdf->SetX(20);
    $pdf->Cell(27,4,'Bill No',0,0,'C',1);
    $pdf->SetY($y);
    $pdf->SetX(47);
    $pdf->Cell(20,8,'Payment Type',1,0,'C',1);
    $pdf->Cell(43,8,'Party Name',1,0,'C',1);
    $pdf->Cell(40,8,'Payment Mode',1,0,'C',1);
    $pdf->Cell(25,8,'Credit (Rs.)',1,0,'C',1);
    $pdf->Cell(25,8,'Debit (Rs.)',1,1,'C',1);

    $pdf->SetTextColor(0,0,0);
    $start_y = $pdf->GetY();

    $pdf->SetFont('Arial','',7);
    $s_no = "1"; 
    
    if (!empty($payment_list)) {
        $index = 1;
        $total_credit = 0;
        $total_debit = 0;

        $grouped = [];

        foreach ($payment_list as $data) {
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
                    'party_name' => $data['party_name'],
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

        foreach ($grouped as $bill_number => $info) {
            if($pdf->GetY() > 250) {
                $pdf->SetFont('Arial','B',8);
                $pdf->SetX(10);

                $pdf->Cell(140,8,'Closing Balance ',1,0,'R',0);
                if($total_credit > $total_debit) {
                    $opening_balance_credit = $total_credit-$total_debit;
                    $pdf->SetX(150);
                    $pdf->Cell(25,8,$obj->numberFormat($total_credit-$total_debit,2),1,0,'R',0);
                    $pdf->SetX(175);
                    $pdf->Cell(25,8,' ',1,0,'R',0);
                } else {
                    $opening_balance_debit = $total_debit-$total_credit;
                    $pdf->SetX(150);
                    $pdf->Cell(25,8,' ',1,0,'R',0);
                    $pdf->SetX(175);
                    $pdf->Cell(25,8,$obj->numberFormat($total_debit-$total_credit,2),1,1,'R',0);
                }
    
                $pdf->SetFont('Arial','I',7);
                $pdf->SetY(277);
                $pdf->SetX(10);
                $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                $pdf->AddPage();

                $file_name = "Payment Report";
                include("rpt_header.php");

                $pdf->SetFont('Arial','B',9);
                $pdf->SetX(10);
                $pdf->Cell(190,7,'Payment Report '.$date_display ,1,1,'C',0);

                $pdf->SetFont('Arial','B',7);
                $y = $pdf->GetY();
                $pdf->SetFillColor(101,114,122);
                $pdf->SetTextColor(255,255,255);
                $pdf->SetX(10);
                $pdf->Cell(10,8,'#',1,0,'C',1);
                $pdf->Cell(27,4,'Date',0,1,'C',1);
                $pdf->SetX(20);
                $pdf->Cell(27,4,'Bill No',0,0,'C',1);
                $pdf->SetY($y);
                $pdf->SetX(47);
                $pdf->Cell(20,8,'Payment Type',1,0,'C',1);
                $pdf->Cell(43,8,'Party Name',1,0,'C',1);
                $pdf->Cell(40,8,'Payment Mode',1,0,'C',1);
                $pdf->Cell(25,8,'Credit (Rs.)',1,0,'C',1);
                $pdf->Cell(25,8,'Debit (Rs.)',1,1,'C',1);
                
                $pdf->SetTextColor(0,0,0);
                $pdf->SetFont('Arial','B',8);
                $pdf->SetX(10);
                $pdf->Cell(140,8,'Opening Balance',1,0,'R',0);
                if(!empty($opening_balance_credit)) {
                    $pdf->SetX(150);
                    $pdf->Cell(25,8,$obj->numberFormat($opening_balance_credit,2),1,0,'R',0);
                    $pdf->SetX(175);
                    $pdf->Cell(25,8,'  ',1,1,'R',0);
                } else {
                    $pdf->SetX(150);
                    $pdf->Cell(25,8,'  ',1,0,'R',0);
                    $pdf->SetX(175);
                    $pdf->Cell(25,8,$obj->numberFormat($opening_balance_debit,2),1,1,'R',0);
                }
    
                $pdf->SetFont('Arial','',8);
                $start_y = $pdf->GetY();
            }

            $pdf->SetFont('Arial','',8);
            $pdf->SetX(10);
            $pdf->Cell(10,5,$index,0,0,'C',0);

            if(!empty($info['bill_date']) && (!empty($bill_number))) {
                $bill_date = "";
                $bill_date = date('d-m-Y', strtotime($info['bill_date']));
                $combine_data = $bill_date."\n".$bill_number;
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                
                $pdf->MultiCell(27, 5, $combine_data, 0, 'C', 0);
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(20);
                $pdf->MultiCell(27, 5,'-', 0, 'C', 0);
            }

            $date_y = $pdf->GetY() - $start_y;
            $pdf->SetFont('Arial','',8);

            if(!empty($info['bill_type'])) {
                $bill_type = "";
                $bill_type = $info['bill_type'];
                $pdf->SetY($start_y);
                $pdf->SetX(47);
                $pdf->MultiCell(20, 5, $bill_type, 0, 'C', 0);
            } else {
                $pdf->SetY($start_y);
                $pdf->SetX(47);
                $pdf->MultiCell(20, 5,'-', 0, 'C', 0);
            }

            $bill_y = $pdf->GetY() - $start_y;


            $pdf->SetY($start_y);
            $pdf->SetX(67);

            $party_name = "";
            if($info['bill_type'] == "Expense") {
                $expense_name = "";
                $expense_name = $obj->getTableColumnValue($GLOBALS['expense_table'], 'expense_id', $info['bill_id'], 'expense_category_name');
                $expense_name = $obj->encode_decode('decrypt',$expense_name);
            
                $pdf->MultiCell(43, 5, $expense_name ?: ' - ', 0, 'C', 0);
            } 
            else{
                if(!empty($info['party_name']) && $info['party_name'] != $GLOBALS['null_value']) {
                    $party_name = $info['party_name'];
                    // $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $info['party_id'], 'name_mobile_city');
                    $party_name = html_entity_decode($obj->encode_decode('decrypt', $party_name)); 
                } 
                $pdf->MultiCell(43, 5, $party_name ?: ' - ', 0, 'C', 0);
            }

            $party_y = $pdf->GetY() - $start_y;

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

            $pdf->SetY($start_y);
            $pdf->SetX(110);
            $pdf->MultiCell(40, 5, $particulars ?: ' - ', 0, 'C', 0); 
            
            $payment_y = $pdf->GetY() - $start_y;

            $pdf->SetY($start_y);
            $pdf->SetTextColor(0,130,0);
            if(!empty($info['credit'])) {
                $pdf->SetX(150);
                $total_credit+=$info['credit'];
                $pdf->MultiCell(25, 5,$obj->numberFormat($info['credit'],2), 0, 'R', 0);
            } else {
                $pdf->SetX(150);
                $pdf->Cell(25, 5,'0.00', 0, 0,'R', 0);
            }
            $credit_y = $pdf->GetY() - $start_y;

            $pdf->SetY($start_y);
            $pdf->SetTextColor(255,0,0);
            if(!empty($info['debit'])) {
                $pdf->SetX(175);
                $total_debit+=$info['debit'];
                $pdf->MultiCell(25, 5,$obj->numberFormat($info['debit'],2), 0, 'R', 0);
            } else {
                $pdf->SetX(175);
                $pdf->Cell(25, 5,'0.00', 0, 1,'R', 0);
            }
            $pdf->SetTextColor(0,0,0);
            $debit_amount_y = $pdf->GetY() - $start_y;

            $y_array = array($date_y,$party_y,$payment_y,$credit_y,$bill_y,$debit_amount_y);
            $max_y = max($y_array);

            $pdf->SetY($start_y);
            $pdf->SetX(10);
            $pdf->Cell(10,$max_y,'',1,0,'C');
            $pdf->SetX(20);
            $pdf->Cell(27,$max_y,'',1,0,'C');
            $pdf->SetX(47);
            $pdf->Cell(20,$max_y,'',1,0,'C');
            $pdf->SetX(67);
            $pdf->Cell(43,$max_y,'',1,0,'C');
            $pdf->SetX(110);
            $pdf->Cell(40,$max_y,'',1,0,'C');
            $pdf->SetX(150);
            $pdf->Cell(25,$max_y,'',1,0,'C');
            $pdf->SetX(175);
            $pdf->Cell(25,$max_y,'',1,1,'C');

            $start_y += $max_y;
            $pdf->SetY($start_y);

            $index++;
        }
     
        $pdf->SetX(10);
        $pdf->Cell(10,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(20);
        $pdf->Cell(27,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(47);
        $pdf->Cell(20,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(67);
        $pdf->Cell(43,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(110);
        $pdf->Cell(40,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(150);
        $pdf->Cell(25,255-$pdf->GetY(),'',1,0,'C',0);
        $pdf->SetX(175);
        $pdf->Cell(25,255-$pdf->GetY(),'',1,1,'C',0);

        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10);
        $pdf->Cell(140,8,'Total',1,0,'R',0);
        if(!empty($total_credit)) {
            $pdf->SetX(150);
            $pdf->Cell(25,8,$obj->numberFormat($total_credit,2),1,0,'R',0);
        } else {
            $pdf->SetX(150);
            $pdf->Cell(25,8,' 0 ',1,0,'R',0);
        }
        if(!empty($total_debit)) {
            $pdf->SetX(175);
            $pdf->Cell(25,8,$obj->numberFormat($total_debit,2),1,1,'R',0);
        } else{
            $pdf->SetX(175);
            $pdf->Cell(25,8,' 0 ',1,1,'R',0);
        }

        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10);
        $pdf->Cell(140,8,'Current Balance',1,0,'R',0);
        if($total_credit > $total_debit) { 
            $pdf->SetX(150);
            $pdf->Cell(25,8,$obj->numberFormat($total_credit- $total_debit,2),1,0,'R',0);
        } else {
            $pdf->SetX(150);
            $pdf->Cell(25,8,' ',1,0,'R',0);
        }
        if($total_debit > $total_credit) { 
            $pdf->SetX(175);
            $pdf->Cell(25,8,$obj->numberFormat( $total_debit - $total_credit,2),1,1,'R',0);
        } else {
            $pdf->SetX(175);
            $pdf->Cell(25,8,'  ',1,1,'R',0);
        }   
    }

    $pdf->SetFont('Arial','I',7);
    $pdf->SetY(272);
    $pdf->SetX(10);
    $pdf->Cell(190,3,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

    $pdf_name = "Payment Report( ". $date_display." ).pdf";
    $pdf->Output($from, $pdf_name);
    
?>