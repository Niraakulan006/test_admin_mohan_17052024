<?php

    include("../include_user_check_and_files.php");
    include("../include/number2words.php"); 


    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date("Y-m-d"); $filter_suspense_party_id = ""; $filter_consignor_id = ""; $filter_consignee_id = ""; $filter_account_party_id = "";
    if(isset($_REQUEST['filter_from_date'])) {
        $from_date = $_REQUEST['filter_from_date'];
        $from_date = trim($from_date);
        $from_date = date('Y-m-d', strtotime($from_date));
    }
    if(isset($_REQUEST['filter_to_date'])) {
        $to_date = $_REQUEST['filter_to_date'];
        $to_date = trim($to_date);
        $to_date = date('Y-m-d', strtotime($to_date));
    }
    if(isset($_REQUEST['filter_suspense_party_id'])) {
        $filter_suspense_party_id = $_REQUEST['filter_suspense_party_id'];
        $filter_suspense_party_id = trim($filter_suspense_party_id);
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
    $from = "";
    if(isset($_REQUEST['from'])) {
        $from = $_REQUEST['from'];
    }



    $total_records_list = array();
    if(!empty($filter_suspense_party_id)) {
        $total_records_list = $obj->GetSuspensePendingBalanceList($from_date, $to_date, $filter_suspense_party_id);
    }
    else {
        $total_records_list = $obj->GetSuspensePendingBalanceList('', '', '');
    }

    require_once('../fpdf/fpdf.php');
    $pdf = new FPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $pdf->SetTitle('Suspense Party Balance Report');
    $pdf->SetFont('Arial','B',10);
    
    if(!empty($filter_suspense_party_id)) { 
        
        $yaxis = $pdf->GetY();

        include("rpt_header.php");
        

        $sy = $pdf->GetY();
       
        $pdf->Cell(0,7,'Suspense Party Balance Report'.' ( ' .date('d-m-Y',strtotime($from_date )) ." to ". date('d-m-Y',strtotime($to_date )).  ' )',0,1,'C',0);
           
        
        $current_y = $pdf->GetY();
        $pdf->SetY($yaxis);
        $pdf->SetX(10);

        $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
        $party_name = "";
        $pdf->SetFont('Arial', 'B', 8);

        $party_name = "";
        if(!empty($filter_suspense_party_id)) {
            $party_name = $obj->getTableColumnValue($GLOBALS['suspense_party_table'], 'suspense_party_id', $filter_suspense_party_id, 'suspense_party_name');
        }

        if(!empty($party_name)) { 
            $party_name = $obj->encode_decode('decrypt', $party_name);
            $pdf->SetX(10);
            $pdf->Cell(0,7,'Name - '.html_entity_decode($party_name,ENT_QUOTES),1,1,'C',0); 
        }
        
        $pdf->SetFont('Arial','B',9);
        $pdf->SetFillColor(0, 123, 255);
        $pdf->SetTextColor(255,255,255);

        $pdf->SetX(10);
        $pdf->Cell(15,8,'S.No.',1,0,'C',1);
        $pdf->SetX(25);
        $pdf->Cell(35,8,'Date',1,0,'C',1);
        $pdf->SetX(60);
        $pdf->Cell(50,8,'Bill Number',1,0,'C',1);
        $pdf->SetX(110);
        $pdf->Cell(45,8,'Credit',1,0,'C',1);
        $pdf->SetX(155);
        $pdf->Cell(45,8,'Debit',1,1,'C',1);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',8);


        $index = 1; $total_credit = 0; $total_debit = 0;
        $balance_credit = 0; $balance_debit = 0;
        $opening_credit = 0; $opening_debit = 0;
        $opening_balance_list = array();
        $opening_balance_list = $obj->getSuspensePartyOpeningBalance($from_date, $to_date, $filter_suspense_party_id);
        if(!empty($opening_balance_list)) {
            foreach($opening_balance_list as $data) {
                if(!empty($data['opening_credit']) && $data['opening_credit'] != $GLOBALS['null_value']) {
                    $balance_credit = $data['opening_credit'];
                }
                if(!empty($data['opening_debit']) && $data['opening_debit'] != $GLOBALS['null_value']) {
                    $balance_debit = $data['opening_debit'];
                }
            }
            if(!empty($balance_credit) || !empty($balance_debit)) {
                if($balance_credit > $balance_debit) {
                    $opening_credit = $balance_credit - $balance_debit;
                }
                else {
                    $opening_debit = $balance_debit - $balance_credit;
                }
            }
        }

        if(!empty($opening_debit) || !empty($opening_credit)) {

            $pdf->Cell(100,8,'Opening Balance',1,0,'R',0);
            if(!empty($opening_credit)) {
                $pdf->SetTextColor(18, 224, 25);
                $pdf->Cell(45,8,$obj->numberFormat($opening_credit,2),1,0,'R',0); 
                $total_credit += $opening_credit; 
            } else {
                $pdf->SetTextColor(18, 224, 25);
                $pdf->Cell(45,8,'0.00',1,0,'R',0); 
            }
            if(!empty($opening_debit)){
                $pdf->SetTextColor(255,0,0);
                $pdf->Cell(45,8,$obj->numberFormat($opening_debit,2),1,1,'R',0);  
                $total_debit += $opening_debit;
            } else {
                $pdf->SetTextColor(255,0,0);
                $pdf->Cell(45,8,'0.00',1,1,'R',0);
            }
        }
        $pdf->SetTextColor(0,0,0);

        if(!empty($total_records_list)) {
            foreach($total_records_list as $val) {
                
                if($pdf->GetY()>265){
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(-15);
                    $pdf->SetX(10);
                    $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                    $pdf->AddPage();
                    
                    $yaxis = $pdf->GetY();

                    include("rpt_header.php");
        

                    $sy = $pdf->GetY();
                
                    $pdf->Cell(0,7,'Suspense Party Balance Report'.' ( ' .date('d-m-Y',strtotime($from_date )) ." to ". date('d-m-Y',strtotime($to_date )).  ' )',0,1,'C',0);
                    
                    
                    $current_y = $pdf->GetY();
                    $pdf->SetY($yaxis);
                    $pdf->SetX(10);

                    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
                    $party_name = "";
                    $pdf->SetFont('Arial', 'B', 8);

                    $party_name = "";
                    if(!empty($filter_suspense_party_id)) {
                        $party_name = $obj->getTableColumnValue($GLOBALS['suspense_party_table'], 'suspense_party_id', $filter_suspense_party_id, 'suspense_party_name');
                    }

                    if(!empty($party_name)) { 
                        $party_name = $obj->encode_decode('decrypt', $party_name);
                        $pdf->SetX(10);
                        $pdf->Cell(0,7,'Name - '.html_entity_decode($party_name,ENT_QUOTES),1,1,'C',0);
                    }
                    
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetFillColor(0, 123, 255);
                    $pdf->SetTextColor(255,255,255);

                    $pdf->SetX(10);
                    $pdf->Cell(15,8,'S.No.',1,0,'C',1);
                    $pdf->SetX(25);
                    $pdf->Cell(35,8,'Date',1,0,'C',1);
                    $pdf->SetX(60);
                    $pdf->Cell(50,8,'Bill Number',1,0,'C',1);
                    $pdf->SetX(110);
                    $pdf->Cell(45,8,'Credit',1,0,'C',1);
                    $pdf->SetX(155);
                    $pdf->Cell(45,8,'Debit',1,1,'C',1);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',8);
                    
                }

                $y = $pdf->GetY();
                $pdf->SetX(10);
                $pdf->Cell(15,8,$index,0,0,'C',0);

                $pdf->SetX(25);
                if(!empty($val['bill_date']))
                {
                    $pdf->SetX(25);
                    $pdf->Cell(35,8,date('d-m-Y',strtotime($val['bill_date'])),0,0,'C',0);
                }
                
                if(!empty($val['bill_number'])) {
                    $pdf->SetX(60);
                    $pdf->Cell(50,8,$val['bill_number'],0,0,'L',0);
                }

                if(!empty($val['credit'])){
                    $pdf->SetTextColor(18, 224, 25);
                    $total_credit+=$val['credit']; 
                    $pdf->SetX(110);
                    $pdf->Cell(45,8,$obj->numberFormat($val['credit'],2),0,0,'R',0);
                } else {
                    $pdf->SetTextColor(18, 224, 25);
                    $pdf->Cell(45,8,'0.00',0,0,'R',0); 
                }
                
                    
                if(!empty($val['debit'])){
                    $total_debit+=$val['debit']; 
                    $pdf->SetX(155);
                    $pdf->SetTextColor(255,0,0);
                    $pdf->Cell(45,8,$obj->numberFormat($val['debit'],2),0,1,'R',0);
                } else {
                    $pdf->SetTextColor(255,0,0);
                    $pdf->Cell(45,8,'0.00',0,1,'R',0);
                }
                $pdf->SetTextColor(0,0,0);
                
                $pdf->SetY($y);
                $pdf->SetX(10);
                $pdf->Cell(15,8,'',1,0,'C',0);
                $pdf->SetX(25);
                $pdf->Cell(35,8,'',1,0,'C',0);
                $pdf->SetX(60);
                $pdf->Cell(50,8,'',1,0,'C',0);
                $pdf->SetX(110);
                $pdf->Cell(45,8,'',1,0,'C',0);
                $pdf->SetX(155);
                $pdf->Cell(45,8,'',1,1,'C',0);
                $index++;
                            
                    
            }
        }

        $pdf->SetTextColor(0,0,0);
        if(!empty($opening_credit) || !empty($opening_debit) || !empty($total_records_list)) {
            $pdf->SetX(10);
            $pdf->Cell(100,8,'Total',1,0,'R',0);
            $pdf->SetX(110);
            $pdf->SetTextColor(18, 224, 25);
            $pdf->Cell(45,8,$obj->numberFormat($total_credit,2),1,0,'R',0);
        
            $pdf->SetX(155);
            $pdf->SetTextColor(255,0,0);
            $pdf->Cell(45,8,$obj->numberFormat($total_debit,2),1,1,'R',0);

            $pdf->SetX(10);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(100,8,'Current Balance',1,0,'R',0);
            $pdf->SetX(110);
            $pdf->SetTextColor(18, 224, 25);
            if($total_credit > $total_debit) {
                $total = $total_credit - $total_debit;
                $pdf->Cell(45,8,$obj->numberFormat($total,2),1,0,'R',0);
            } else{
                $pdf->Cell(45,8,'',1,0,'R',0);
            }
            
        
            $pdf->SetX(155);
            $pdf->SetTextColor(255,0,0);
            if($total_debit > $total_credit) {
                $total = $total_debit - $total_credit;
                $pdf->Cell(45,8,$obj->numberFormat($total,2),1,1,'R',0);
            } else{
                $pdf->Cell(45,8,'',1,1,'R',0);
            }
            $pdf->SetTextColor(0,0,0);
        }

        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(-15);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
        $pdf->SetTextColor(0,0,0);

    } else {
        $yaxis = $pdf->GetY();

        include("rpt_header.php");
        

        $sy = $pdf->GetY();
       
        $pdf->Cell(0,7,'Suspense Party Balance Report',0,1,'C',0);
           
        
        $current_y = $pdf->GetY();
        $pdf->SetY($yaxis);
        $pdf->SetX(10);

        $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);

        $pdf->SetFont('Arial','B',9);
        $pdf->SetFillColor(0, 123, 255);
        $pdf->SetTextColor(255,255,255);

        $pdf->SetX(10);
        $pdf->Cell(15,8,'S.No.',1,0,'C',1);
        $pdf->SetX(25);
        $pdf->Cell(85,8,'Party',1,0,'C',1);
        $pdf->SetX(110);
        $pdf->Cell(45,8,'Credit',1,0,'C',1);
        $pdf->SetX(155);
        $pdf->Cell(45,8,'Debit',1,1,'C',1);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',8);

        $index = 1; $total_credit = 0; $total_debit = 0; $grand_credit_total = 0; $grand_debit_total = 0;
        if(!empty($total_records_list)) {
            foreach($total_records_list as $key => $data) {
                $credit = 0; $debit = 0;
                if(!empty($data['credit']) && !empty($data['debit'])) {
                    if($data['credit'] > $data['debit']) {
                        $credit = $data['credit'] - $data['debit'];
                    }
                    else {
                        $debit = $data['debit'] - $data['credit'];
                    }
                }
                else if(!empty($data['credit'])) {
                    $credit = $data['credit'];
                }
                else if(!empty($data['debit'])) {
                    $debit = $data['debit'];
                }
               
                if($pdf->GetY()>265){
                    $pdf->SetFont('Arial','I',7);
                    $pdf->SetY(-15);
                    $pdf->SetX(10);
                    $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
                    $pdf->AddPage();
        
                    $yaxis = $pdf->GetY();

                    include("rpt_header.php");
                    

                    $sy = $pdf->GetY();
                
                    $pdf->Cell(0,7,'Suspense Party Balance Report',0,1,'C',0);
                    
                    
                    $current_y = $pdf->GetY();
                    $pdf->SetY($yaxis);
                    $pdf->SetX(10);

                    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);

                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetFillColor(0, 123, 255);
                    $pdf->SetTextColor(255,255,255);

                    $pdf->SetX(10);
                    $pdf->Cell(15,8,'S.No.',1,0,'C',1);
                    $pdf->SetX(25);
                    $pdf->Cell(85,8,'Party',1,0,'C',1);
                    $pdf->SetX(110);
                    $pdf->Cell(45,8,'Credit',1,0,'C',1);
                    $pdf->SetX(155);
                    $pdf->Cell(45,8,'Debit',1,1,'C',1);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',8);

                }
                $pdf->SetTextColor(0,0,0);
                $z = $pdf->GetY();
                $pdf->SetX(10);
                $pdf->Cell(15,6,$index,0,0,'C',0);

                $party_name = "";
                if(!empty($data['party_type']) && !empty($data['party_id'])) {
                    if($data['party_type'] == 'Suspense Party') {
                        $party_name = $obj->getTableColumnValue($GLOBALS['suspense_party_table'], 'suspense_party_id', $data['party_id'], 'suspense_party_name');
                    }
                    
                }
                if(!empty($party_name) && $party_name != $GLOBALS['null_value']) {
                    $pdf->SetX(25);
                    $pdf->Cell(85,6,html_entity_decode($obj->encode_decode('decrypt',$party_name),ENT_QUOTES),0,0,'C',0); 
                } else {
                    $pdf->SetX(25);
                    $pdf->Cell(85,6,' - ',0,0,'C',0); 
                }
                
                if(!empty($credit)) {
                    $pdf->SetX(110);
                    $pdf->Cell(45,8,$obj->numberFormat($credit,2),1,0,'R',0); 
                    $total_credit += $credit; 
                } else{
                    $pdf->SetX(110);
                    $pdf->Cell(45,8,'-',1,0,'R',0); 
                }

                if(!empty($debit)){
                    $pdf->SetX(155);
                    $pdf->Cell(45,8,$obj->numberFormat($debit,2),1,1,'R',0);  
                    $total_debit += $debit;
                } else{
                    $pdf->SetX(155);
                    $pdf->Cell(45,8,'-',1,1,'R',0); 
                }
                
                $pdf->SetY($z);
                $pdf->SetX(10);
                $pdf->Cell(15,8,'',1,0,'C',0);
                $pdf->SetX(25);
                $pdf->Cell(85,8,'',1,0,'C',0);
                $pdf->SetX(110);
                $pdf->Cell(45,8,'',1,0,'C',0);
                $pdf->SetX(155);
                $pdf->Cell(45,8,'',1,1,'C',0);
                $index++;
                
        
            }
            
            $pdf->SetFont('Arial','B',8);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetX(10);
            $pdf->Cell(100,8,'Total',1,0,'R',0);
            $pdf->SetX(110);
            $pdf->SetTextColor(18, 224, 25);
            $pdf->Cell(45,8,$obj->numberFormat($total_credit,2),1,0,'R',0);
            $pdf->SetX(155);
            $pdf->SetTextColor(255,0,0);
            $pdf->Cell(45,8,$obj->numberFormat($total_debit,2),1,1,'R',0);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetX(10);
            $pdf->Cell(100,8,'Current Balance',1,0,'R',0);

            if($total_credit < $total_debit){
                $grand_debit_total = $total_debit - $total_credit;
            }   
            else{
                $grand_credit_total = $total_credit - $total_debit;
            }

            $pdf->SetX(110);
            $pdf->SetTextColor(18, 224, 25);
            if(!empty($grand_credit_total)){
                $pdf->Cell(45,8,$obj->numberFormat($grand_credit_total,2),1,0,'R',0);
            } else{
                $pdf->Cell(45,8,'',1,0,'R',0);
            }
            
        
            $pdf->SetX(155);
            if(!empty($grand_debit_total)){
                $pdf->SetTextColor(255,0,0);
                $pdf->Cell(45,8,$obj->numberFormat($grand_debit_total,2),1,1,'R',0);
            } else {
                $pdf->Cell(45,8,'',1,1,'R',0);
            }
            $pdf->SetTextColor(0,0,0);
            
        }

        $pdf->SetFont('Arial','I',7);
        $pdf->SetY(-15);
        $pdf->SetX(10);
        $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    }


    $pdf_name = "Suspense Party Balance Report.pdf";
    $pdf->Output($from, $pdf_name);

?>

