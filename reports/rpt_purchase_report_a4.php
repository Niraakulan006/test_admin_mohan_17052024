<?php
    include("../include_user_check_and_files.php");
    include("../include/number2words.php");

    $party_id = "";
    if(isset($_REQUEST['party_id'])) {
        $party_id = $_REQUEST['party_id'];
    }

    $from_date = "";
    if(isset($_REQUEST['from_date'])) {
        $from_date = $_REQUEST['from_date'];
    }
    
    $to_date = "";
    if(isset($_REQUEST['to_date'])) {
        $to_date = $_REQUEST['to_date'];
    }

    $bill_no = "";
    if(isset($_REQUEST['bill_no'])){
       $bill_no = $_REQUEST['bill_no'];
    }

    $from = "";
    if(isset($_REQUEST['from'])){
       $from = $_REQUEST['from'];
    }

    $cancel_bill_btn = "";
    if(isset($_REQUEST['cancel_bill_btn'])) {
        $cancel_bill_btn = $_REQUEST['cancel_bill_btn'];
    }
   $bill_company_id =$GLOBALS['bill_company_id']; $company_details =array();
    $bill_company_details = "";
    if (!empty($bill_company_id)) {
        $bill_company_details = $obj->BillCompanyDetails($bill_company_id, '');
        $bill_company_details = $obj->encode_decode('decrypt',$bill_company_details);
        $company_details = explode("$$$", $bill_company_details);
    }
    // print_r($company_details);

    $total_records_list = array();
    $total_records_list = $obj->getPurchaseReportList($from_date, $to_date, $bill_no, $party_id,$cancel_bill_btn);
  
    if(!empty($from_date)) {
        $from_date = date('d-m-Y',strtotime($from_date));
    }
    if(!empty($to_date)) {
        $to_date = date('d-m-Y',strtotime($to_date));
    }
    
    $pdf_download_name ="";
    $pdf_download_name = "Purchase Report PDF -"." (".$from_date ." to ".$to_date .").pdf";
    require_once('../fpdf/fpdf.php');
    $pdf = new FPDF('P','mm','A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $yaxis = $pdf->GetY();

    $file_name="Purchase Report";
    include("rpt_billing_header.php");
    
    $pdf->SetY($header_end);
           
    $pdf->SetFont('Arial','B',10);
    if(!empty($from_date) || !empty($to_date)) {
        $date_display = "( ";
        if(!empty($from_date)) {
            $date_display .= $from_date;
        }

        if(!empty($from_date) && !empty($to_date)) {
            $date_display .= ' - ';
        }

        if(!empty($to_date)) {
            $date_display .= $to_date;
        }
        $date_display .= " )";

        $pdf->Cell(0,8.5,"Purchase Report - " . $date_display,0,1,'C',0);
    } else {
        $pdf->Cell(0,8.5,'Purchase Report',0,1,'C',0);
    }

    $current_y = $pdf->GetY();
    $box_y = $pdf->GetY();

    $pdf->SetY($yaxis);
    $pdf->SetX(10);

    $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY($box_y);
    $pdf->SetX(10);
    $pdf->Cell(20,8,'S.No.',1,0,'C',0);
    $pdf->Cell(30,8,'Bill Number',1,0,'C',0);
    $pdf->Cell(30,8,'Date',1,0,'C',0);
    $pdf->Cell(80,8,'Party Name',1,0,'C',0);
    $pdf->Cell(30,8,'Amount',1,1,'C',0);
    $pdf->SetFont('Arial','',7);
    $content_start_y = $pdf->GetY();

    $index = 0;
    if(!empty($total_records_list)) {
        $product_count = 0; $quantity = ""; $grand_amount = 0;
        foreach($total_records_list as $key => $data) {
            if($pdf->GetY()>250){
                $closing_balance = $grand_amount;
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(160,8,'Closing Balance',1,0,'R',0);
                $pdf->Cell(30,8,$obj->numberFormat($closing_balance,2),1,1,'R',0);
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);
                $yaxis = $pdf->GetY();

                $file_name="Purchase Report";
                include("rpt_billing_header.php");
                $pdf->SetY($header_end);
                $pdf->SetFont('Arial','B',10);
                if(!empty($from_date) || !empty($to_date)){
                    $date_display = "(";
                    if(!empty($from_date)) {
                        $date_display = $from_date;
                    }

                    if(!empty($from_date) && !empty($to_date)) {
                        $date_display .= ' - ';
                    }

                    if(!empty($to_date)) {
                        $date_display .= $to_date;
                    }
                    $date_display .= ")";

                    $pdf->Cell(0,8.5,'Purchase Report -' . $date_display,0,1,'C',0);
                } else {
                    $pdf->Cell(0,8.5,'Purchase Report',0,1,'C',0);
                }

                $current_y = $pdf->GetY();
                $box_y = $pdf->GetY();
                $pdf->SetY($yaxis);
                $pdf->SetX(10);
                $pdf->Cell(190, ($current_y - $yaxis), '', 1, 1, 'L', 0);
                $pdf->SetFont('Arial','B',9);
                $pdf->SetX(10);
                $pdf->Cell(20,8,'S.No.',1,0,'C',0);
                $pdf->Cell(30,8,'Bill Number',1,0,'C',0);
                $pdf->Cell(30,8,'Date',1,0,'C',0);
                $pdf->Cell(80,8,'Party Name',1,0,'C',0);
                $pdf->Cell(30,8,'Amount',1,1,'C',0);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(160,8,'Opening Balance',1,0,'R',0);
                $pdf->Cell(30,8,$obj->numberFormat($closing_balance,2),1,1,'R',0);
                $pdf->SetFont('Arial','',8);
                $content_start_y = $pdf->GetY();
            }
            $pdf->SetFont('Arial','',8);
            $index = $key + 1;
            if(!empty($data['product_id'])) {
                $product_ids = explode(",", $data['product_id']);
                $product_count = count($product_ids);
            }
            if(!empty($data['quantity'])) {
                $quantity = explode(",", $data['quantity']);
            }
            if(!empty($data['unit_name'])) {
                $unit_names = explode(',',$data['unit_name']);
               $unit_names =array_reverse($unit_names);
            }
            if(!empty($data['product_name'])) {                                                          
                $product_names = explode(',',$data['product_name']);
                $product_names =array_reverse($product_names);
            }

            if(!empty($prefix)) { $index = $index + $prefix; }
            $start_y = $pdf->GetY();                

            $pdf->SetX(10);
            $pdf->Cell(20,8,$index,0,0,'C',0);
            $pdf->SetY($start_y);


            if($data['cancelled'] == '0'){
                if(!empty($data['purchase_entry_number'])) {
                    $pdf->SetX(30);
                    $pdf->MultiCell(30,8,$data['purchase_entry_number'],0,'C',0);
                } else {
                    $pdf->SetX(30);
                    $pdf->Cell(30,8,'',0,1,'C',0); 
                }
            } elseif (($data['cancelled']) == '1') {
                    if(!empty($data['purchase_entry_number'])) {
                    $pdf->SetX(30);
                    $pdf->MultiCell(30,4,$data['purchase_entry_number'],0,'C',0);
                } else {
                    
                    $pdf->SetX(30);
                    $pdf->Cell(30,4,'',0,1,'C',0); 
                }
                $pdf->SetTextColor(255,0,0);
                $pdf->SetX(30);
                $pdf->Cell(30,4,'Cancelled',0,1,'C',0);   
            } 
            $pdf->SetTextColor(0,0,0);

            $no_end = $pdf->GetY();

            $pdf->SetY($start_y);

            if(!empty($data['purchase_entry_date'])) {
                $pdf->SetX(60);
                $pdf->MultiCell(30,8,date('d-m-Y',strtotime($data['purchase_entry_date'])),0,'C',0);
            } else {
                $pdf->SetX(60);
                $pdf->Cell(30,8,'',0,1,'C',0); 
            }

            $date_end = $pdf->GetY();

            $pdf->SetY($start_y);   

            if(!empty($data['party_name_mobile_city'])) {
                $party_name = $obj->encode_decode('decrypt',$data['party_name_mobile_city']);
                $pdf->SetX(90);
                $pdf->MultiCell(80,8,($party_name),0,'C',0);
            }
            
            $qty_end = $pdf->GetY();
            $pdf->SetY($start_y); 

            if(!empty($data['total_amount'])) { 
                $pdf->SetX(150);
                $pdf->MultiCell(50,8,number_format($data['total_amount'], 2),0,'R',0);
                if($data['cancelled'] == '0'){
                    $grand_amount += $data['total_amount'];
                }
            }
            $amt_end =$pdf->GetY();

            $max_y = max(array($date_end,$amt_end,$qty_end,$no_end));
            $pdf->SetY($start_y);                            
            $pdf->SetX(10);
            $pdf->Cell(20,($max_y-$start_y),'',1,0,'C',0);
            $pdf->Cell(30,($max_y-$start_y),'',1,0,'C',0);
            $pdf->Cell(30,($max_y-$start_y),'',1,0,'C',0);
            $pdf->Cell(80,($max_y-$start_y),'',1,0,'C',0);
            $pdf->Cell(30,($max_y-$start_y),'',1,1,'C',0);
        }
        
        $pdf->Line(10, $content_start_y, 10, 270);
        $pdf->Line(30, $content_start_y, 30, 270);
        $pdf->Line(60, $content_start_y, 60, 270);
        $pdf->Line(90, $content_start_y, 90, 270);
        $pdf->Line(170, $content_start_y, 170, 270);
        $pdf->Line(200, $content_start_y, 200, 270);
        $pdf->SetY(270);
        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10);
        $pdf->Cell(160,10,'Total',1,0,'R',0);
        $pdf->Cell(30,10,number_format($grand_amount,2),1,1,'R',0);
    }

    $pdf->Output($from, $pdf_download_name);
?>