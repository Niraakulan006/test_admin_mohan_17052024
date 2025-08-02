<?php

include("../include_user_check_and_files.php");
include("../include/number2words.php");

$view_luggagesheet_id = "";
if(isset($_REQUEST['view_luggagesheet_id'])) {
    $view_luggagesheet_id = $_REQUEST['view_luggagesheet_id'];
}
else {
    header("Location: ../luggagesheet.php");
    exit;
}

if(!empty($view_luggagesheet_id)) {
    $view_luggagesheet_id = $_REQUEST['view_luggagesheet_id'];

    $luggagesheet_date = date("d-m-Y"); $luggagesheet_type = "";  $luggagesheet_number = ""; $consignor_id = ""; $consignor_name = ""; $consignee_id = ""; $consignee_id = ""; $consignee_name = ""; $quantity = ""; $consignor_details = array(); $consignee_details = array(); $tax_value = "";
    $consignor_name = ""; $consignor_address = ""; $consignor_state = ""; $consignor_mobile_number = ""; $consignor_city = ""; $consignee_city =""; $organization_details = ""; $organization_name = ""; $organization_address = ""; $organization_state = ""; $organization_mobile_number = ""; $organization_city = ""; $consignee_city =""; $branch_id = ""; $vehicle_id = ""; $vehicle_name = "";$godown_id = ""; $godown_name = "";
    $branch_name = ""; $driver_name = ""; $helper_name = ""; $lr_ids =array(); $lr_ids = ""; if(!empty($view_luggagesheet_id)) {
        $luggagesheet_list = array();
        $luggagesheet_list = $obj->getTableRecords($GLOBALS['luggagesheet_table'], 'luggage_id', $view_luggagesheet_id);
        if(!empty($luggagesheet_list)) {
            $mode_display = ""; $account_name = array();
            foreach($luggagesheet_list as $data) {
                if(!empty($data['organization_details'])) { $organization_details =  $data['organization_details']; }
                if(!empty($data['luggage_date'])) { $luggagesheet_date =  $data['luggage_date']; }
                if(!empty($data['luggagesheet_number'])) { $luggagesheet_number =  $data['luggagesheet_number']; }
                if(!empty($data['vehicle_id'])) { $vehicle_id = $data['vehicle_id']; }
                if(!empty($data['godown_id'])) { $godown_id = $data['godown_id']; }
                if(!empty($data['driver_name'])) { $driver_name = $obj->encode_decode('decrypt',$data['driver_name']);}
                if(!empty($data['helper_name'])) { $helper_name = $obj->encode_decode('decrypt',$data['helper_name']); }
                if(!empty($data['lr_id'])) { $lr_id = $data['lr_id']; $lr_ids = explode(",",$data['lr_id']); }
                if(!empty($data['unit_id'])) { $unit_id = $data['unit_id']; $unit_id = explode(",",$data['unit_id']); }
                // if(!empty($data['quantity'])) { $quantity = $data['quantity']; $quantity = explode(",",$data['quantity']); }
                if(!empty($data['price_per_qty'])) { $price_per_qty = $data['price_per_qty']; $price_per_qty = explode(",",$data['price_per_qty']); }
            }
        }
    }
}
if(!empty($vehicle_id))
{
    $vehicle_number = $obj->getTableColumnValue($GLOBALS['vehicle_table'],'vehicle_id',$vehicle_id,'vehicle_number');
    if(!empty($vehicle_number)){ $vehicle_number = $obj->encode_decode("decrypt",$vehicle_number); }
}
    
if(!empty($godown_id)){
    $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'name');
    if(!empty($godown_name)){ $godown_name = $obj->encode_decode("decrypt",$godown_name); }
}

$organization_name = ""; $organization_address1 = ""; $organization_address2 = ""; $organization_city ="";$organization_pincode=""; $organization_state=""; $organization_gst_number= ""; $organization_mobile_number ="";
    if(!empty($organization_details))
    {
        if(!empty($organization_details))
        {
            $organization_details =$obj->encode_decode("decrypt",$organization_details);
        }
        $organization_details = explode("$$$",$organization_details);
        for($i=0;$i<count($organization_details);$i++)
        {
            if(!empty($organization_details[0]))
            {
                $organization_name = $organization_details[0];
            }
            if(!empty($organization_details[1]))
            {
                $organization_address1 = $organization_details[1];
            }
            if(!empty($organization_details[2]))
            {
                $organization_address2 = $organization_details[2];
            }
            if(!empty($organization_details[3]))
            {
                $organization_city = $organization_details[3];
            }
            if(!empty($organization_details[4]))
            {
                $organization_pincode = $organization_details[4];
            }
            if(!empty($organization_details[5]))
            {
                $organization_state = $organization_details[5];
            }

            if(!empty($organization_details[6]))
            {
                $organization_gst_number= $organization_details[6];
            }
            if(!empty($organization_details[7]))
            {
                $organization_mobile_number= $organization_details[7];
            }
        }
    }


    // $gst_number = "";
    // $gst_number = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'gst_number');
    // if(!empty($gst_number) && $gst_number != $GLOBALS['null_value']){ $gst_number = $obj->encode_decode('decrypt', $gst_number); }

    // $organization_mobile_number = "";
    // $organization_mobile_number = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'mobile_number');
    // if(!empty($organization_mobile_number) && $organization_mobile_number != $GLOBALS['null_value']){ $organization_mobile_number = $obj->encode_decode('decrypt', $organization_mobile_number); }

    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm','A4');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();
	$pdf->SetAutoPageBreak(false);
	$pdf->SetTitle('luggagesheet');
    $pdf->SetFont('Arial','B',9);

    $starty = $pdf->GetY();
    $pdf->Cell(0,1,'',0,1,'C',0);
    $pdf->SetX(15);
    $pdf->Cell(90,4,$organization_name,0,1,'C',0);
    $pdf->SetX(15);
    $pdf->MultiCell(90,4,$organization_address1." ".$organization_address2,0,'C',0);
    $pdf->SetX(15);
    $pdf->Cell(90,4,$organization_city." ".$organization_pincode." ".$organization_state,0,1,'C',0);
    $pdf->SetX(15);
    $pdf->Cell(90,4,'GSTIN : '.$organization_gst_number,0,1,'C',0);
    $pdf->SetX(15);
    $pdf->Cell(90,4,'Cell : '.$organization_mobile_number,0,0,'C',0);

    $pdf->SetY($starty);
    $pdf->Cell(0,2,'',0,1,'C',0);
    $pdf->SetX(110);
    $pdf->Cell(40,5,'luggagesheet NO.',0,1,'C',0);
    $pdf->SetX(110);
    $pdf->Cell(40,5,$luggagesheet_number,0,0,'C',0);

    $pdf->SetY($starty);
    $pdf->Cell(0,2,'',0,1,'C',0);
    $pdf->SetX(150);
    $pdf->Cell(20,5,'Vechile No.',0,0,'C',0);
    $pdf->SetX(170);
    $pdf->Cell(30,5,':'.$vehicle_number,0,1,'L',0);
    $pdf->SetX(150);
    $pdf->Cell(20,5,'Date.',0,0,'C',0);
    $pdf->SetX(170);
    $pdf->Cell(30,5,':'.date("d-m-Y", strtotime($data['luggage_date'])),0,1,'L',0);
    $pdf->SetX(150);
 
    // $pdf->Cell(20,5,'From ',0,0,'C',0);
    // $pdf->SetX(170);
    // $pdf->Cell(20,5,':'.$godown_name,0,1,'L',0);
    $pdf->SetX(150);
    $pdf->Cell(20,5,'Place : ',0,0,'C',0);
    $pdf->SetX(170);
    $pdf->MultiCell(20,4,': '.$organization_name,0,1,0);


    $pdf->SetY($starty);
    $pdf->SetX(10);
    $pdf->cell(100,30,'',1,0,'L',0);

    $pdf->SetX(110);
    $pdf->Cell(40,30,'',1,0,'L',0);

    $pdf->SetX(150);
    $pdf->Cell(50,30,'',1,1,'L',0);

    $top_y = $pdf->GetY();
    $pdf->SetX(10);
    $pdf->Cell(20,10,'Driver',0,0,'C',0);
    $pdf->SetX(30);
    $pdf->MultiCell(80,10,': '.$driver_name,0,'L',0);
    $pdf->SetY($top_y);
    $pdf->SetX(110);
    $pdf->Cell(20,10,'Helper',0,0,'C',0);
    $pdf->SetX(130);
    $pdf->MultiCell(80,10,': '.$helper_name,0,'L',0);
    $driver_y = $pdf->GetY();
    $helper_y = $pdf->GetY();
    $end_y = max(array($helper_y,$driver_y));
    
    $pdf->SetY($top_y);
    $pdf->SetX(10);
    $pdf->Cell(100,$end_y - $top_y,'',1,0,'C',0);
    $pdf->SetX(110);
    $pdf->Cell(90,$end_y - $top_y,'',1,1,'C',0);

    $head_y = $pdf->getY();
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(5,10,'#',1,0,'C',0);
    $pdf->SetX(15);
    $pdf->Cell(25,10,'L.R.No.',1,0,'C',0);
    $pdf->SetX(40);
    $pdf->Cell(25,10,'Date',1,0,'C',0);
    $pdf->SetX(65);
    $pdf->Cell(43,10,'Consignor',1,0,'C',0);
    $pdf->SetX(108);
    $pdf->Cell(43,10,'Consignee',1,0,'C',0);
    $pdf->SetX(151);
    $pdf->Cell(29,10,'QTY & UNIT',1,0,'C',0);
    $sy = $pdf->GetY();
    $pdf->SetY($sy);
    $pdf->SetX(180);
    $pdf->Cell(20,10,'Bill Type',1,1,'C',0);
    $pdf->SetFont('Arial','',8);

    $y_axis = $pdf->GetY();

    $lr_details = array(); $consignor_details = array(); $consignee_details = array(); $city  = ""; $lr_state = "";
    $consignor_name = ""; $consignor_address = ""; $consignor_state = ""; $consignor_mobile_number = ""; $consignor_city = ""; $consignee_city ="";  $consignee_details = array(); $consignee_details = array(); 
    $quantity_total = 0;
    $consignee_name = ""; $consignee_address = ""; $consignee_state = ""; $consignee_mobile_number = ""; $consignee_city = ""; $consignee_city =""; $unit_id = ""; $unit_name = array(); $freight_charges = ""; $nloading_charges = ""; $s_no = 1;
    if(!empty($lr_ids))
    {
        for($l=0; $l<count($lr_ids);$l++)
        {
            $unloading_charges_value = ""; $bill_type =""; $lr_date = "";
            $loading_charges_error = ""; $loading_charges_names = ""; $loading_charges = ""; $loading_charges_total = 0; $loading_charge = array(); $loading_charges_values = array(); $charges_value = ""; $total =""; $charges_names = "";
            $unloading_charges_error = ""; $unloading_charges_names = ""; $unloading_charges = ""; $unloading_charges_total = 0; $unloading_charges_values = array(); $unloading_charge = array(); $loading_charges_value = ""; $charges_total = 0;
            $lr_details = $obj->getTableRecords($GLOBALS['lr_table'],'lr_id',$lr_ids[$l]);
            foreach($lr_details as $data)
            {
                if(!empty($data['consignor_id'])){ $consignor_id = $data['consignor_id']; }
                if(!empty($data['consignee_id'])){ $consignee_id = $data['consignee_id']; }
                if(!empty($data['total'])){ $freight_total = $data['total']; }
                if(!empty($data['quantity'])){ $quantity = $data['quantity']; } if(!empty($quantity)){ $quantity = explode(",",$quantity); }
                // if(!empty($data['rate'])){ $rate = $data['rate']; }if(!empty($rate)){ $rate = explode(",",$rate);}
                if(!empty($data['amount'])){ $freight_amount = $data['amount']; }
                if(!empty($data['unit_name'])){ $unit_name = explode(",", $data['unit_name']); }
                if(!empty($data['lr_date'])){ $lr_date = date("d-m-Y",strtotime($data['lr_date']));}
                if(!empty($data['lr_state'])){ $lr_state = $obj->encode_decode("decrypt",$data['lr_state']);}
                if(!empty($data['consignor_details'])){ $consignor_details = $data['consignor_details']; $consignor_details = $obj->encode_decode("decrypt",$data['consignor_details']); }
                if(!empty($data['consignee_details'])){ $consignee_details = $data['consignee_details']; $consignee_details = $obj->encode_decode("decrypt",$data['consignee_details']);}
                if(!empty($data['price_per_qty'])){ $rate = explode(",", $data['price_per_qty']);}
                if(!empty($data['bill_type'])){ $bill_type = $data['bill_type'];}
                if(!empty($data['tax_value'])){ $tax_value = $data['tax_value']; }
                if(!empty($godown_id))
                {
                    $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'name');
                    if(!empty($godown_name)){ $godown_name = $obj->encode_decode("decrypt",$godown_name); }
                }
                if(!empty($data['organization_details'])){ $organization_details = $data['organization_details']; $organization_details = $obj->encode_decode("decrypt",$data['organization_details']); }
                if(!empty($data['charges_value']) && $data['charges_value'] != $GLOBALS['null_value']) {
                    $charges_values = $obj->encode_decode('decrypt', $data['charges_value']);
                    $charges_values = json_decode($charges_values);  
                    foreach($charges_values as $charges_key => $charges) {          
                        foreach($charges as $key => $cdata) {
                            if($key == "charges_name") { $charges_name = $cdata; }
                            if($key == "charges") { $charges_value = $cdata; }
                        }
                    }
                }
                if(!empty($data['unloading_charges_value']) && $data['unloading_charges_value'] != $GLOBALS['null_value']) {
                    $unloading_charges_values = $obj->encode_decode('decrypt', $data['unloading_charges_value']);
                    $unloading_charges_values = json_decode($unloading_charges_values);  
                    foreach($unloading_charges_values as $unloading_charges_key => $unloading_charges) {          
                        foreach($unloading_charges as $key => $cdata) {
                            if($key == "unloading_charges_name") { $unloading_charges_name = $cdata; }
                            if($key == "unloading_charges") { $unloading_charges = $cdata; }
                        }
                    }
                }
               
                $quantity[$l] = trim($quantity[$l]);
                $rate[$l] = trim($rate[$l]); $freight = array();
                for($i=0; $i<count($quantity); $i++) {
                    if(!empty($rate[$i]) && !empty($quantity[$i])){ $freight[$i] = $rate[$i] * $quantity[$i]; }
                }
                
                $total_amount = 0;
                $total_amount = array_sum($freight);
                if(!empty($charges_value)) {
                    $charge = "";
                    $charge = trim($charges_value);
                    if(!empty($charge)) {
                        $charges_names = trim($charges_names);
                            if(!empty($total_amount) && preg_match("/^[0-9]+(\\.[0-9]+)?$/", $total_amount)) {
                                $charges_value = 0;
                                if (strpos($charge, '%') !== false) {
                                    $charge = trim(str_replace("%", "", $charge));
                                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $charge)) {											
                                        $charges_value = ($total_amount * $charge) / 100;
                                        $charges_values[] = array('charges_name' => $charges_names, 'charges' => $charge."%");
                                    }
                                    else { $charges_error = "Invalid Charges"; }
                                }
                                else {
                                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $charge)) {
                                        $charges_value = $charge;
                                        $charges_values[] = array('charges_name' => $charges_names, 'charges' => $charge);
                                    }
                                    else { $charges_error = "Invalid Charges"; }
                                }
                                if(!empty($charges_value)) {
                                    $charges_value = number_format($charges_value, 2);
                                    $charges_value = str_replace(",", "", $charges_value);
                                    $charges_total = $charges_total + $charges_value;
                                    $total = $total_amount + $charges_total;
                                    $total_amount = $total_amount + $charges_total;
                                    $charges_values = json_encode($charges_values);
                                }
                            }
                    }
                }

                if(!empty($unloading_charges)) {
                    if(!empty($unloading_charges)) {
                        $unloading_charges_names = trim($unloading_charges_names);
                        if(!empty($total_amount) && preg_match("/^[0-9]+(\\.[0-9]+)?$/", $total_amount)) {
                            $unloading_charges_value = 0;
                            if (strpos($unloading_charges, '%') !== false) {
                                $unloading_charges = trim(str_replace("%", "", $unloading_charges));
                                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $unloading_charges)) {						
                                    $unloading_charges_value = ($total_amount * $unloading_charges) / 100;
                                    $unloading_charges_values[] = array('unloading_charges_name' => $unloading_charges_names, 'unloading_charges' => $unloading_charges."%");
                                }
                                else { $unloading_charges_error = "Invalid unloading_Charges"; }
                            }
                            else {
                                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $unloading_charges)) {
                                    $unloading_charges_value = $unloading_charges;
                                    $unloading_charges_values[] = array('unloading_charges_name' => $unloading_charges_names, 'unloading_charges' => $unloading_charge);
                                }
                                else { $unloading_charges_error = "Invalid unloading_Charges"; }
                            }
                            if(!empty($unloading_charges_value)) {
                                $unloading_charges_value = number_format($unloading_charges_value, 2);
                                $unloading_charges_value = str_replace(",", "", $unloading_charges_value);
                                $unloading_charges_total = $unloading_charges_total + $unloading_charges_value;
                                $total = $total_amount + $unloading_charges_total;
                                $total_amount = $total_amount + $unloading_charges_total;
                                $unloading_charges_values = json_encode($unloading_charges_values);
                            }
                        }
                    }
                }
            }
            if(!empty($total_amount) && ($tax_value)) {
                $tax_value = str_replace("%","",$tax_value);
                $total_amount = $total_amount + (($total_amount * $tax_value)/100);
            }
            if(!empty($consignor_details)){
                $consignor_details = explode("$$$",$consignor_details);
                for($i =0 ;$i<count($consignor_details);$i++){
                    if($consignor_details[0] != 'NULL' ){ $consignor_name = $consignor_details[0]; }
                    if($consignor_details[1] != 'NULL' ){ $consignor_address = $consignor_details[1]; }
                    if($consignor_details[2] != 'NULL' ){ $consignor_state = $consignor_details[2]; }
                    if($consignor_details[3] != 'NULL' ){ $consignor_city = $consignor_details[3]; }
                }
            }
            if(!empty($consignee_details)){
                $consignee_details = explode("$$$",$consignee_details);
                for($i =0 ;$i<count($consignee_details);$i++){
                    if($consignee_details[0] != 'NULL' ){ $consignee_name = $consignee_details[0]; }
                    if($consignee_details[1] != 'NULL' ){ $consignee_address = $consignee_details[1]; }
                    if($consignee_details[2] != 'NULL' ){ $consignee_state = $consignee_details[2]; }
                    if($consignee_details[3] != 'NULL' ){ $consignee_city = $consignee_details[3]; }
                    if($consignee_details[4] != 'NULL' ){ $consignee_mobile_number = $consignee_details[4]; }
                }
            }
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
                $pdf->SetTitle('luggagesheet');
                $pdf->SetFont('Arial','B',10);
        
                $starty = $pdf->GetY();
                $pdf->Cell(0,2,'',0,1,'C',0);
                $pdf->SetX(15);
                $pdf->Cell(90,4,$organization_name,0,1,'C',0);
                $pdf->SetX(15);
                $pdf->MultiCell(90,4,$organization_address1." ".$organization_address2,0,'C',0);
                $pdf->SetX(15);
                $pdf->Cell(90,4,$organization_city." ".$organization_pincode." ".$organization_state,0,1,'C',0);
                $pdf->SetX(15);
                $pdf->Cell(90,4,'GSTIN : '.$organization_gst_number,0,1,'C',0);
                $pdf->SetX(15);
                $pdf->Cell(90,4,'Cell : '.$organization_mobile_number,0,0,'C',0);

                $pdf->SetY($starty);
                $pdf->Cell(0,2,'',0,1,'C',0);
                $pdf->SetX(110);
                $pdf->Cell(40,5,'luggagesheet CHART NO.',0,0,'C',0);
                $pdf->SetX(110);
                $pdf->Cell(40,5,$luggagesheet_number,0,0,'C',0);

                $pdf->SetY($starty);
                $pdf->Cell(0,2,'',0,1,'C',0);
                $pdf->SetX(150);
                $pdf->Cell(20,5,'Vechile No.',0,0,'C',0);
                $pdf->SetX(170);
                $pdf->Cell(30,5,':'.$vehicle_number,0,1,'L',0);
                $pdf->SetX(150);
                $pdf->Cell(20,5,'Date.',0,0,'C',0);
                $pdf->SetX(170);
                $pdf->Cell(30,5,':'.date("d-m-Y", strtotime($data['luggagesheet_date'])),0,1,'L',0);
                $pdf->SetX(150);
                $pdf->Cell(20,5,'Place : ',0,0,'C',0);
                $pdf->SetX(170);
                $pdf->MultiCell(20,4,': '.$organization_name,0,1,0);

                $pdf->SetY($starty);
                $pdf->SetX(10);
                $pdf->cell(100,25,'',1,0,'L',0);

                $pdf->SetX(110);
                $pdf->Cell(40,25,'',1,0,'L',0);

                $pdf->SetX(150);
                $pdf->Cell(50,25,'',1,1,'L',0);

                $top_y = $pdf->GetY();
                $pdf->SetX(10);
                $pdf->Cell(20,10,'Driver',0,0,'C',0);
                $pdf->SetX(30);
                $pdf->MultiCell(80,10,': '.$driver_name,0,'L',0);
                $pdf->SetY($top_y);
                $pdf->SetX(110);
                $pdf->Cell(20,10,'Helper',0,0,'C',0);
                $pdf->SetX(130);
                $pdf->MultiCell(80,10,': '.$helper_name,0,'L',0);
                $driver_y = $pdf->GetY();
                $helper_y = $pdf->GetY();
                $end_y = max(array($helper_y,$driver_y));
                
                $pdf->SetY($top_y);
                $pdf->SetX(10);
                $pdf->Cell(100,10,'',1,0,'C',0);
                $pdf->SetX(110);
                $pdf->Cell(90,10,'',1,1,'C',0);

                $pdf->SetFont('Arial','B',9);
                $pdf->SetX(10);
                $pdf->SetX(10);
                $pdf->Cell(5,10,'#',1,0,'C',0);
                $pdf->SetX(15);
                $pdf->Cell(25,10,'L.R.No.',1,0,'C',0);
                $pdf->SetX(40);
                $pdf->Cell(25,10,'Date',1,0,'C',0);
                $pdf->SetX(65);
                $pdf->Cell(43,10,'Consignor',1,0,'C',0);
                $pdf->SetX(108);
                $pdf->Cell(43,10,'Consignee',1,0,'C',0);
                $pdf->SetX(151);
                $pdf->Cell(29,10,'QTY & UNIT',1,0,'C',0);
                $sy = $pdf->GetY();
                $pdf->SetY($sy);
                $pdf->SetX(180);
                $pdf->Cell(20,10,'Bill Type',1,1,'C',0);
                $pdf->SetFont('Arial','',8);
            
                $pdf->SetFont('Arial','',8);
            }
            $starty =$pdf->GetY();
            $pdf->SetFont('Arial','',9);
            $pdf->SetX(10);

            $pdf->Cell(5,5,$s_no,0,0,'C',0);
            $pdf->SetX(15);
            $lr_number = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_ids[$l],'lr_number');
            $pdf->Cell(25,5,$lr_number,0,0,'C',0);
            $pdf->SetX(40);
            $pdf->MultiCell(25,5,$lr_date,0,'C',0);
            $lr_state = $pdf->GetY();
            $pdf->SetY($starty);
            $pdf->SetX(65);
            $pdf->MultiCell(43,5,$consignor_name,0,'C',0);
            $consignor_y = $pdf->GetY();
            $pdf->SetY($starty);
            $pdf->SetX(108);
            $pdf->MultiCell(43,5,$consignee_name,0,'C',0);
            $consignee_y = $pdf->GetY();
            $pdf->SetY($starty);
            $pdf->SetX(151);
            for($i=0; $i<count($quantity); $i++) {
                if(!empty($unit_name[$i])){ $unit_name[$i] = $obj->encode_decode("decrypt",$unit_name[$i]); }
                $pdf->MultiCell(29,5,$quantity[$i]." ".$unit_name[$i],0,'C',0);
                $pdf->SetX(151);
            }
            $unit_y = $pdf->GetY();
            $sy = $pdf->GetY();
            $pdf->SetY($starty);
            $pdf->SetY($starty);
            $pdf->SetX(180);
            if(!empty($bill_type)){ 
                if($bill_type == '1'){ $bill_type = 'To Pay'; }
                if($bill_type == '2'){ $bill_type = 'Paid'; }
            }
            $pdf->Cell(25,5,$bill_type,0,1,'C',0);
            $pdf->SetY($sy);
            $end_y = max(array($consignee_y,$consignor_y,$unit_y,$city));

            $pdf->SetY($starty);
            $pdf->SetX(10);
            $pdf->Cell(5,$end_y - $starty,'',1,0,'C',0);
            $pdf->SetX(15);
            $pdf->Cell(25,$end_y - $starty,'',1,0,'C',0);
            $pdf->SetX(40);
            $pdf->Cell(25,$end_y - $starty,'',1,0,'C',0);
            $pdf->SetX(65);
            $pdf->Cell(43,$end_y - $starty,'',1,0,'C',0);
            $pdf->SetX(108);
            $pdf->Cell(43,$end_y - $starty,'',1,0,'C',0);
            $pdf->SetX(151);
            $pdf->Cell(29,$end_y - $starty,'',1,0,'C',0);
            $pdf->SetX(180);
            $pdf->Cell(20,$end_y - $starty,'',1,1,'C',0);
            $s_no++;
            $quantity_total += array_sum($quantity);
        }

    }

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(5,200,'',1,0,'C',0);
    $pdf->SetX(15);
    $pdf->Cell(25,200,'',1,0,'C',0);
    $pdf->SetX(40);
    $pdf->Cell(25,200,'',1,0,'C',0);
    $pdf->SetX(65);
    $pdf->Cell(43,200,'',1,0,'C',0);
    $pdf->SetX(108);
    $pdf->Cell(43,200,'',1,0,'C',0);
    $pdf->SetX(151);
    $pdf->Cell(29,200,'',1,0,'C',0);
    // $pdf->SetX(160);
    // $pdf->Cell(20,210,'',1,0,'C',0);
    $pdf->SetX(180);
    $pdf->Cell(20,200,'',1,1,'C',0);
   
    $pdf->SetX(10);
    $pdf->Cell(141,9,'Quantity Total',1,0,'L',0);
    $pdf->SetX(151);
    $pdf->Cell(49,9,$quantity_total,1,1,'C',0);
    $end_sy = $pdf->GetY();
    $pdf->Cell(60,9,'',0,1,'L',0);
    $pdf->SetX(10);
    $pdf->Cell(30,5,'Driver Signature',0,0,'L',0);
    $pdf->SetX(40);
    $pdf->Cell(45,5,':_________________________',0,1,'L',0);

    $pdf->SetY($end_sy);
    $pdf->Cell(30,10,'',0,1,'L',0);
    $pdf->SetX(95);
    $pdf->Cell(30,5,'Prepared by',0,0,'C',0);

    $pdf->SetY($end_sy);
    $pdf->Cell(70,10,'',0,1,'L',0);
    $pdf->SetX(125);
    $pdf->Cell(75,5,'Authority/ Signature',0,1,'C',0);

    $pdf->SetY($end_sy);
    $pdf->SetX(10);
    $pdf->cell(80,17,'',1,0,'L',0);

    $pdf->SetX(90);
    $pdf->Cell(30,17,'',1,0,'L',0);

    $pdf->SetX(120);
    $pdf->Cell(80,17,'',1,1,'L',0);
    
    $pdf->OutPut();

?>