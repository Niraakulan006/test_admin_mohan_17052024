<?php

include("../include_user_check_and_files.php");
include("../include/number2words.php");

$view_tripsheet_id = "";
if(isset($_REQUEST['view_tripsheet_id'])) {
    $view_tripsheet_id = $_REQUEST['view_tripsheet_id'];
}
else {
    header("Location: ../tripsheet.php");
    exit;
}

if(!empty($view_tripsheet_id)) {
    $view_tripsheet_id = $_REQUEST['view_tripsheet_id'];

    $tripsheet_date = date("d-m-Y"); $tripsheet_type = "";  $tripsheet_number = ""; $consignor_id = ""; $consignor_name = ""; $consignee_id = ""; $consignee_id = ""; $consignee_name = ""; $consignor_details = array(); $consignee_details = array(); $tax_value = ""; $others_city =""; $from_branch_id =""; $to_branch_id ="";
    $consignor_name = ""; $consignor_address = ""; $consignor_state = ""; $consignor_mobile_number = ""; $consignor_city = ""; $consignee_city =""; $organization_details = ""; $organization_name = ""; $organization_address = ""; $organization_state = ""; $organization_mobile_number = ""; $organization_city = ""; $consignee_city =""; $vehicle_id = ""; $vehicle_name = "";$godown_id = ""; $godown_name = ""; $driver_number ="";
    $branch_name = ""; $driver_name = ""; $helper_name = "";$lr_ids = ""; 
    if(!empty($view_tripsheet_id)) {
        $tripsheet_list = array();
        $tripsheet_list = $obj->getTableRecords($GLOBALS['tripsheet_table'], 'tripsheet_id', $view_tripsheet_id);
        if(!empty($tripsheet_list)) {
            $mode_display = ""; $account_name = array();
            foreach($tripsheet_list as $data) {
                if(!empty($data['organization_details'])) { $organization_details =  $data['organization_details']; }
                if(!empty($data['tripsheet_date'])) { $tripsheet_date =  $data['tripsheet_date']; }
                if(!empty($data['from_branch_id'])) { $from_branch_id =  $data['from_branch_id']; }
                if(!empty($data['from_branch_name'])) { $from_branch_name =  $obj->encode_decode('decrypt', $data['from_branch_name']); }
                if(!empty($data['to_branch_id'])) { $to_branch_id =  $data['to_branch_id']; }
                if(!empty($data['tripsheet_number'])) { $tripsheet_number =  $data['tripsheet_number']; }
                if(!empty($data['vehicle_id'])) { $vehicle_id = $data['vehicle_id']; }
                if(!empty($data['godown_id'])) { $godown_id = $data['godown_id']; }
                if(!empty($data['driver_name'])) { $driver_name = $obj->encode_decode('decrypt',$data['driver_name']);}
                if(!empty($data['driver_number'])) { $driver_number = $obj->encode_decode('decrypt',$data['driver_number']);}
                if(!empty($data['helper_name'])) { $helper_name = $obj->encode_decode('decrypt',$data['helper_name']); }
                if(!empty($data['unit_id'])) { $unit_id = $data['unit_id']; $unit_id = explode(",",$data['unit_id']); }
                // if(!empty($data['quantity'])) { $quantity = $data['quantity']; $quantity = explode(",",$data['quantity']); }
                // if(!empty($data['price_per_qty'])) { $price_per_qty = $data['price_per_qty']; $price_per_qty = explode(",",$data['price_per_qty']); }
                
            }
        }
    }
}
$vehicle_number = "";
if(!empty($vehicle_id))
{
    $vehicle_number = $obj->getTableColumnValue($GLOBALS['vehicle_table'],'vehicle_id',$vehicle_id,'vehicle_number');
    if(!empty($vehicle_number)){ $vehicle_number = $obj->encode_decode("decrypt",$vehicle_number); }
}
    
// if(!empty($godown_id)){
//     $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'name');
//     if(!empty($godown_name)){ $godown_name = $obj->encode_decode("decrypt",$godown_name); }
// }

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

    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('L','mm','A4');
	$pdf->AliasNbPages(); 
	$pdf->AddPage();
	$pdf->SetAutoPageBreak(false);
	$pdf->SetTitle('Tripsheet');
    $pdf->SetFont('Arial','B',13);

    $starty = $pdf->GetY();
    $pdf->Cell(0,1,'',0,1,'C',0);
    $pdf->SetX(15);
    $pdf->Cell(270,5,$organization_name,0,1,'C',0);
    $pdf->SetX(15);
    $pdf->MultiCell(270,5,$organization_address1." ".$organization_address2,0,'C',0);
    $pdf->SetX(15);
    $pdf->Cell(270,5,$organization_city." ".$organization_pincode." ".$organization_state,0,1,'C',0);
    $pdf->SetX(15);
    $pdf->Cell(270,5,'GSTIN : '.$organization_gst_number,0,1,'C',0);
    //$pdf->SetX(15);
    //$pdf->Cell(270,5,'Cell : '.$organization_mobile_number,0,0,'C',0);

    $pdf->SetY($starty);
    $pdf->SetX(10);
    $pdf->cell(275,25,'',1,1,'L',0);

    // $pdf->SetY($starty);
    $pdf->SetFont('Arial','B',13);
    $challan_starty = $pdf->GetY();
    $pdf->Cell(0,2,'',0,1,'C',0);
    $pdf->SetX(10);
    $pdf->Cell(40,5,'CHALLAN NO.',0,0,'C',0);
    $pdf->SetX(50);
    $pdf->Cell(40,5,$tripsheet_number,0,0,'C',0);
    $pdf->SetX(210);
    $pdf->Cell(40,5,'CHALLAN DATE.',0,0,'C',0);
    $pdf->SetX(250);
    $pdf->Cell(30,5,':'.date("d-m-Y", strtotime($tripsheet_date)),0,1,'L',0);

    $pdf->SetY($challan_starty);
    $pdf->Cell(275,10,'',1,1,'C',0);

    $from_y = $pdf->GetY();
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(100,5,'FROM :-'."     ".$from_branch_name,0,1,'L',0);
    $pdf->Cell(100,4,'TRUCK OWNER :-'."    ".$organization_name,0,1,'L',0);
    $pdf->Cell(100,4,'DRIVER :-'."    ".$driver_name.", ".$driver_number,0,1,'L',0);
    $pdf->Cell(100,4,'Helper :-'."    ".$helper_name,0,1,'L',0);
    if($consignee_city =='Others')
    {
        $consignee_city = $others_city;
    }
    // $branch_ids = array();
    // if(!empty($branch_id))
    // {
    //     $branch_ids =explode(",",$branch_id);
    // }
    $branch_name= "";
    // if(!empty($branch_ids[0]))
    // {
    //     $branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$branch_ids[0],'name');
    //     if(!empty($branch_name))
    //     {
    //         $branch_name =$obj->encode_decode("decrypt",$branch_name);
    //     }
    // }
    $pdf->SetY($from_y);
    $pdf->SetX(200);
    $pdf->Cell(70,5,'TO :-'." ".$branch_name,0,1,'L',0);
    $pdf->SetX(200);
    $pdf->Cell(70,4,'VEHICLE NO:-'." ".$vehicle_number,0,1,'L',0);
    $pdf->SetX(200);
    $pdf->Cell(70,4,'LICENSE NO :-',0,1,'L',0);

    $pdf->SetY($from_y);
    $pdf->Cell(275,22,'',1,1,'C',0);

    $head_y = $pdf->getY();
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(8,10,'#',1,0,'C',0);
    $pdf->SetX(18);
    $pdf->Cell(17,10,'BILTY No',1,0,'C',0);
    $pdf->SetX(35);
    $pdf->Cell(45,10,'CONSIGNOR NAME',1,0,'C',0);
    $pdf->SetX(80);
    $pdf->Cell(45,10,'CONSIGNEE NAME',1,0,'C',0);
    /*$pdf->SetX(100);
    $pdf->Cell(25,10,'SOURCE',1,0,'C',0);*/
    $pdf->SetX(125);
    $pdf->Cell(25,10,'DESTINATION',1,0,'C',0);
    $pdf->SetX(150);
    $pdf->Cell(10,10,'QTY',1,0,'C',0);
    $pdf->SetX(160);
    $pdf->Cell(15,10,'WEIGHT',1,0,'C',0);
    $pdf->SetX(175);
    $pdf->Cell(15,10,'COOLY',1,0,'C',0);
    $pdf->SetX(190);
    $pdf->Cell(18,10,'TO PAY',1,0,'C',0);
    $pdf->SetX(208);
    $pdf->Cell(19,10,'ACCOUNT',1,0,'C',0);
    $pdf->SetX(227);
    $pdf->Cell(18,10,'PAID',1,0,'C',0);
    $pdf->SetX(245);
    $pdf->MultiCell(20,5,'Loading Charges',0,'C',0);
    $pdf->SetY($head_y);
    $pdf->SetX(265);
    $pdf->MultiCell(20,5,'Delivery Charges',1,'C',0);
    $pdf->SetFont('Arial','',8);

    $y_axis = $pdf->GetY();

    $lr_details = array(); $consignor_details = array(); $city  = ""; $lr_state = "";
    $consignor_name = ""; $consignor_address = ""; $consignor_state = ""; $consignor_mobile_number = ""; $consignor_city = ""; $consignee_city ="";  $consignee_details = array(); $branch_number ="";
    $consignee_name = ""; $consignee_address = ""; $consignee_state = ""; $consignee_mobile_number = ""; $consignee_city = ""; $consignee_city =""; $unit_id = ""; $unit_name = array(); $freight_charges = ""; $nloading_charges = ""; $s_no = 1;
    $quantity_total = 0;$str_branch_id = ""; $weight_total =0; $cooly_total=0;$topay_total =0;$account_total =0; $paid_total=0;
    $total_topay = 0; $total_account = 0; $total_paid = 0;
    $lr_details = $obj->getLRDetailsById($view_tripsheet_id);

    if(!empty($lr_details))
    {
        $arr = array();
        foreach ($lr_details as $key => $item) {
            $arr[$item['consignee_city']][$key] = $item;
        }
        ksort($arr, SORT_NUMERIC);

        $lr_details = $arr;

        foreach($lr_details as $lr_values) {
            foreach($lr_values as $data) {
                    $unloading_charges_value = ""; $bill_type =""; $freight_amount = "";
                $loading_charges_error = ""; $loading_charges_names = ""; $loading_charges = ""; $loading_charges_total = 0; $loading_charge = array(); $loading_charges_values = array(); $charges_value = ""; $total =""; $charges_names = "";$rate = array();$weight = array();$to_branch_id = "";$from_branch_id = "";$account_party_id = "";$account_party_name = "";
                $unloading_charges_error = ""; $unloading_charges_names = ""; $unloading_charges = ""; $unloading_charges_total = 0; $unloading_charges_values = array(); $unloading_charge = array(); $loading_charges_value = ""; $charges_total = 0;$lr_date = "";$weight = 0; $quantity = ""; $cooly =0; $others_consignee_city = "";
                $delivery_charges_value = "";
                    if(!empty($data['lr_id'])){$lr_ids = $data['lr_id'];}
                    if(!empty($data['consignor_id'])){ $consignor_id = $data['consignor_id']; }
                    if(!empty($data['consignee_id'])){ $consignee_id = $data['consignee_id']; }
                    if(!empty($consignee_id)){$consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$consignee_id,'name');}
                    if(!empty($consignee_name)){$consignee_name = $obj->encode_decode("decrypt",$consignee_name);}
                    if(!empty($data['account_party_id'])){$account_party_id = $data['account_party_id'];}
                    if(!empty($account_party_id)){$account_party_name = $obj->getTableColumnValue($GLOBALS['account_party_table'],'account_party_id',$account_party_id,'name');}
                    if(!empty($account_party_name)){$account_party_name = $obj->encode_decode("decrypt",$account_party_name);}
                    if(!empty($data['from_branch_id'])){$from_branch_id = $data['from_branch_id'];}
                    if(!empty($data['to_branch_id'])){$to_branch_id = $data['to_branch_id'];}
                    if(!empty($data['to_branch_name'])){$to_branch_name =$obj->encode_decode("decrypt", $data['to_branch_name']);}
                    if(!empty($data['total'])){ $freight_total = $data['total']; }
                    if(!empty($data['quantity'])){ $quantity = $data['quantity']; $quantity = explode(",",$quantity);}
                    if(!empty($data['weight'])){ $weight = $data['weight']; $weight = explode(",",$weight);}
                    if(!empty($data['freight'])){ $freight_amount = explode(",",$data['freight']); }
                    if(!empty($data['unit_name'])){ $unit_name = explode(",", $data['unit_name']); }
                    if(!empty($data['lr_date'])){ $lr_date = date("d-m-Y",strtotime($data['lr_date']));}
                    if(!empty($data['consignor_details'])){ $consignor_details = $data['consignor_details']; $consignor_details = $obj->encode_decode("decrypt",$data['consignor_details']); }
                    if(!empty($data['consignee_details'])){ $consignee_details = $data['consignee_details']; $consignee_details = $obj->encode_decode("decrypt",$data['consignee_details']);}
                    if(!empty($data['price_per_qty']) ){ $rate =  $data['price_per_qty'];}
                    if(!empty($data['consignee_city']) && $data['consignee_city'] !='NULL'){ $consignee_city =  $obj->encode_decode("decrypt",$data['consignee_city']);}
                    if(!empty($data['others_consignee_city']) && $data['others_consignee_city'] !='NULL'){ $others_consignee_city = $data['others_consignee_city'];}
                    if(!empty($data['bill_type'])){ $bill_type = $data['bill_type'];}
                    if(!empty($data['tax_value'])){ $tax_value = $data['tax_value']; }
                    if(!empty($data['loading_charges_value']) && $data['loading_charges_value'] != 'NULL') { $loading_charges_value = $data['loading_charges_value']; }
                    if(!empty($data['delivery_charges_value']) && $data['delivery_charges_value'] != 'NULL') { $delivery_charges_value = $data['delivery_charges_value']; }
                    //if(!empty($data['cooly'])){ $cooly = $data['cooly']; }
                    //echo "kooli_per_qty - ".$data['kooli_per_qty']."<br>";
                    $total_cooly = 0;
                    if(!empty($data['kooli_per_qty'])) {
                        $kooli_per_qty = "";
                        $kooli_per_qty = explode(",", $data['kooli_per_qty']);
                        //print_r($kooli_per_qty); echo "<br>";
                        if(!empty($kooli_per_qty)) {
                            $cooly = array_sum($kooli_per_qty);
                            $total_cooly = $cooly;
                        }
                    }
                    //echo "cooly - ".$cooly."<br>";
                    // if(!empty($godown_id))
                    // {
                    //     $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'name');
                    //     if(!empty($godown_name)){ $godown_name = $obj->encode_decode("decrypt",$godown_name); }
                    // }
                    if(!empty($data['organization_details'])){ $organization_details = $data['organization_details']; $organization_details = $obj->encode_decode("decrypt",$data['organization_details']); }
                    if(!empty($data['charges_value']) && $data['charges_value'] != $GLOBALS['null_value']) {
                        // $charges_values = $obj->encode_decode('decrypt', $data['charges_value']);
                        // $charges_values = json_decode($charges_values);  
                        // foreach($charges_values as $charges_key => $charges) {          
                        //     foreach($charges as $key => $cdata) {
                        //         if($key == "charges_name") { $charges_name = $cdata; }
                        //         if($key == "charges") { $charges_value = $cdata; }
                        //     }
                        // }
                    }
                    if(!empty($data['unloading_charges_value']) && $data['unloading_charges_value'] != $GLOBALS['null_value']) {
                        // $unloading_charges_values = $obj->encode_decode('decrypt', $data['unloading_charges_value']);
                        // $unloading_charges_values = json_decode($unloading_charges_values);  
                        // foreach($unloading_charges_values as $unloading_charges_key => $unloading_charges) {          
                        //     foreach($unloading_charges as $key => $cdata) {
                        //         if($key == "unloading_charges_name") { $unloading_charges_name = $cdata; }
                        //         if($key == "unloading_charges") { $unloading_charges = $cdata; }
                        //     }
                        // }
                    }

                    $total_amount = 0;
                    if(!empty($freight_amount)){
                        for($e=0;$e < count($freight_amount);$e++){
                            $total_amount += $freight_amount[$e];
                        }
                    }
                    if(!empty($loading_charges_value)) {
                        $total_amount = $total_amount + $loading_charges_value;
                    }
                    if(!empty($delivery_charges_value)) {
                        $total_amount = $total_amount + $delivery_charges_value;
                    }
                    
                    /*if(!empty($charges_value)) {
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
                    }*/
                
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
                        if($consignor_details[5] != 'NULL' ){ $consignor_city = $consignor_details[5]; }
                    }
                }
                if(!empty($consignee_details)){
                    // print_r($consignee_details);
                    $consignee_details = explode("$$$",$consignee_details);
                    for($i =0 ;$i<count($consignee_details);$i++){
                        if($consignee_details[0] != 'NULL' ){ $consignee_name = $consignee_details[0]; }
                        if($consignee_details[1] != 'NULL' ){ $consignee_address = $consignee_details[1]; }
                        if($consignee_details[2] != 'NULL' ){ $consignee_state = $consignee_details[2]; }
                        if($consignee_details[3] != 'NULL' ){ $consignee_city = $consignee_details[3]; } else { $consignee_city = $to_branch_name; }
                        if($consignee_details[4] != 'NULL' ){ $consignee_mobile_number = $consignee_details[4]; }
                    }
                }
                
                if($pdf->GetY() >= 190) {
                    $y = $pdf->GetY();
            
                    $pdf->SetX(10);
                    $pdf->SetFont('Arial','B',9);
                    $next_page = $pdf->PageNo()+1;
                    $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
            
                    $pdf->AddPage();
                    $pdf->SetTitle('Tripsheet');
                    $pdf->SetFont('Arial','B',10);
            
                    $starty = $pdf->GetY();
                    $pdf->Cell(0,1,'',0,1,'C',0);
                    $pdf->SetX(15);
                    $pdf->Cell(270,5,$organization_name,0,1,'C',0);
                
                    // $pdf->SetY($starty);
                    $pdf->SetFont('Arial','B',13);
                    $challan_starty = $pdf->GetY();
                    $pdf->Cell(0,2,'',0,1,'C',0);
                    $pdf->SetX(10);
                    $pdf->Cell(40,5,'CHALLAN NO.',0,0,'C',0);
                    $pdf->SetX(50);
                    $pdf->Cell(40,5,$tripsheet_number,0,0,'C',0);
                    $pdf->SetX(210);
                    $pdf->Cell(40,5,'CHALLAN DATE.',0,0,'C',0);
                    $pdf->SetX(250);
                    $pdf->Cell(30,5,':'.date("d-m-Y", strtotime($tripsheet_date)),0,1,'L',0);
                
                    $pdf->SetY($challan_starty);
                    $pdf->Cell(275,10,'',1,1,'C',0);
                
                    $head_y = $pdf->getY();
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetX(10);
                    $pdf->Cell(8,10,'#',1,0,'C',0);
                    $pdf->SetX(18);
                    $pdf->Cell(17,10,'BILTY No',1,0,'C',0);
                    $pdf->SetX(35);
                    $pdf->Cell(45,10,'CONSIGNOR NAME',1,0,'C',0);
                    $pdf->SetX(80);
                    $pdf->Cell(45,10,'CONSIGNEE NAME',1,0,'C',0);
                    /*$pdf->SetX(100);
                    $pdf->Cell(25,10,'SOURCE',1,0,'C',0);*/
                    $pdf->SetX(125);
                    $pdf->Cell(25,10,'DESTINATION',1,0,'C',0);
                    $pdf->SetX(150);
                    $pdf->Cell(10,10,'QTY',1,0,'C',0);
                    $pdf->SetX(160);
                    $pdf->Cell(15,10,'WEIGHT',1,0,'C',0);
                    $pdf->SetX(175);
                    $pdf->Cell(15,10,'COOLY',1,0,'C',0);
                    $pdf->SetX(190);
                    $pdf->Cell(18,10,'TO PAY',1,0,'C',0);
                    $pdf->SetX(208);
                    $pdf->Cell(19,10,'ACCOUNT',1,0,'C',0);
                    $pdf->SetX(227);
                    $pdf->Cell(18,10,'PAID',1,0,'C',0);
                    $pdf->SetX(245);
                    $pdf->MultiCell(20,5,'Loading Charges',0,'C',0);
                    $pdf->SetY($head_y);
                    $pdf->SetX(265);
                    $pdf->MultiCell(20,5,'Delivery Charges',1,'C',0);
                
                    $pdf->SetFont('Arial','',8);
                }
                    if(!empty($from_branch_id)){
                        $branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$from_branch_id,'name');
                        if(!empty($branch_name)){
                            $branch_name = $obj->encode_decode("decrypt",$branch_name);
                        }
                        $branch_number = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$from_branch_id,'branch_contact_number');
                        if(!empty($branch_number)){
                            $branch_number = $obj->encode_decode("decrypt",$branch_number);
                        }
                        
                    }
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetX(10);
                    // if($str_branch_id != $branch_id){
                    //     $pdf->Cell(190,8,$branch_name,1,1,'C');
                    // }
                    $starty = $pdf->GetY();
                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(10);
        
                    $pdf->Cell(8,5,$s_no,0,0,'C',0);
                    $pdf->SetX(18);
                    $lr_number = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_ids,'lr_number');
                    $pdf->Cell(17,5,$lr_number,0,0,'C',0);
                    $lr_state = $pdf->GetY();
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetY($starty);
                    $pdf->SetX(35);
                    $pdf->MultiCell(45,5,substr($consignor_name, 0, 20),0,'L',0);
                    $consignor_y = $pdf->GetY();
                    $pdf->SetY($starty);
                    $pdf->SetX(80);
                    if(empty($consignee_name) && !empty($account_party_name)){
                        $consignee_name = $account_party_name."(Acc.Party)";
                    }
                    if($consignee_city =='Others')
                    {
                        $consignee_city =$others_consignee_city;
                    }
                    $pdf->MultiCell(45,5,substr($consignee_name, 0, 20),0,'L',0);
                    $consignee_y = $pdf->GetY();
                    $pdf->SetY($starty);
                    /*$pdf->SetX(100);
                    $pdf->MultiCell(25,5,$organization_city,0,'C',0);*/
                    $pdf->SetFont('Arial','',9);
                    $pdf->SetY($starty);
                    $pdf->SetX(125);
                    $pdf->MultiCell(25,5,substr($consignee_city, 0, 10),0,'L',0);
                    $consignee_city_y = $pdf->GetY();
                    $total_quantity = 0;
                    if(!empty($quantity)){
                        for($w=0;$w < count($quantity);$w++){
                            if(!empty($quantity[$w]) && $quantity[$w] != 0){
                                $total_quantity += $quantity[$w];
                            }
                        }
                    }
                    $total_weight = 0;
                    if(!empty($weight)){
                        for($r=0;$r < count($weight);$r++){
                            if(!empty($weight[$r]) && $weight[$r] != 0){
                                $total_weight += $weight[$r];
                            }
                        }
                    }
                    $pdf->SetY($starty);
                    $pdf->SetX(150);
                    if(!empty($total_quantity) ){
                        $pdf->Cell(10,5,$total_quantity,0,0,'C',0);
                    }
                    $pdf->SetX(160);
                    if(!empty($total_weight)){
                        $pdf->Cell(15,5,$total_weight,0,0,'C',0);
                    }
                    // $pdf->SetX(200);
                    $unit_y = $pdf->GetY();
                    $sy = $pdf->GetY();
                    $pdf->SetY($starty);
                    $pdf->SetX(175);
                    $pdf->Cell(15,5,$cooly,0,0,'C',0);
                    // if(!empty($bill_type)){ 
                    //     if($bill_type == '1'){  }
                    //     if($bill_type == '2'){  }
                    // }
                    // echo $bill_type;
                    // $total_topay = 0; $total_account = 0; $total_paid = 0;
                    $pdf->SetX(190);
                    if($bill_type == 'ToPay')
                    {
                        $pdf->Cell(18,5,$total_amount,0,0,'C',0);
                        $total_topay =$total_amount;
                    }
                    else
                    {
                        $pdf->Cell(18,5,'0.00',0,0,'C',0);
                    }
                    $pdf->SetX(208);
                    if($bill_type =='Carrying')
                    {
                        $pdf->Cell(19,5,$total_amount,0,0,'C',0);
                        $total_account =$total_amount;
                    }
                    else
                    {
                        $pdf->Cell(19,5,'0.00',0,0,'C',0);
                    }
                
                    $pdf->SetX(227);
                    if($bill_type =='Paid')
                    {
                        $pdf->Cell(18,5,$total_amount,0,0,'C',0);
                        $total_paid =$total_amount;
                    }
                    else
                    {
                        $pdf->Cell(18,5,'0.00',0,0,'C',0);
                    }
                    $pdf->SetX(245);
                    $pdf->Cell(20,5,$loading_charges_value,1,0,'C',0);
                    $pdf->SetX(265);
                    $pdf->Cell(20,5,$delivery_charges_value,1,1,'C',0);
                    // $pdf->SetX()
                    $pdf->SetY($sy);
                    $end_y = max(array($consignee_y,$consignee_city_y,$consignor_y,$unit_y,$city));
                
                $pdf->SetY($starty);
                $pdf->SetX(10);
                $pdf->Cell(8,$end_y - $starty,'',1,0,'C',0);
                $pdf->SetX(18);
                $pdf->Cell(17,$end_y - $starty,'',1,0,'C',0);
                $pdf->SetX(35);
                $pdf->Cell(45,$end_y - $starty,'',1,0,'C',0);
                $pdf->SetX(80);
                $pdf->Cell(45,$end_y - $starty,'',1,0,'C',0);
                /*$pdf->SetX(100);
                $pdf->Cell(25,$end_y - $starty,'',1,0,'C',0);*/
                $pdf->SetX(125);
                $pdf->Cell(25,$end_y - $starty,'',1,0,'C',0);
                $pdf->SetX(150);
                $pdf->Cell(10,$end_y - $starty,'',1,0,'C',0);
                $pdf->SetX(160);
                $pdf->Cell(15,$end_y - $starty,'',1,0,'C',0);
                $pdf->SetX(175);
                $pdf->Cell(15,$end_y - $starty,'',1,0,'C',0);
                $pdf->SetX(190);
                $pdf->Cell(18,$end_y - $starty,'',1,0,'C',0);
                $pdf->SetX(208);
                $pdf->Cell(19,$end_y - $starty,'',1,0,'C',0);
                $pdf->SetX(227);
                $pdf->Cell(18,$end_y - $starty,'',1,0,'C',0);
                $pdf->SetX(245);
                $pdf->Cell(20,$end_y - $starty,'',1,0,'C',0);
                $pdf->SetX(265);
                $pdf->Cell(20,$end_y - $starty,'',1,1,'C',0);
                $s_no++;
                if(!empty($quantity)){
                    $quantity_total += ($total_quantity);
                }
                if(!empty($total_weight)){
                    $weight_total += ($total_weight);
                }
                if(!empty($total_cooly)){
                    $cooly_total += ($total_cooly);
                }
                if(!empty($total_topay)){
                    $topay_total += ($total_topay);
                }
                if(!empty($total_account)){
                    $account_total += ($total_account);
                }
                if(!empty($total_paid)){
                    $paid_total += ($total_paid);
                }
                $str_branch_id = $from_branch_id;
            } 
        }      
    }    

    $footer = ($pdf->GetY()) + 59;
    if($footer >= 190) {
        $pdf->SetX(10);
        $pdf->SetFont('Arial','B',9);
        $next_page = $pdf->PageNo()+1;
        $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
        $pdf->Addpage();
    }

    //$pdf->SetY($y_axis);
    /*$pdf->SetX(10);
    $pdf->Cell(8,50,'',1,0,'C',0);
    $pdf->SetX(18);
    $pdf->Cell(17,50,'',1,0,'C',0);
    $pdf->SetX(35);
    $pdf->Cell(45,50,'',1,0,'C',0);
    $pdf->SetX(80);
    $pdf->Cell(45,50,'',1,0,'C',0);
    //$pdf->SetX(100);
    //$pdf->Cell(25,9,'',1,0,'C',0);
    $pdf->SetX(125);
    $pdf->Cell(25,50,'',1,0,'C',0);
    $pdf->SetX(150);
    $pdf->Cell(10,50,'',1,0,'C',0);
    $pdf->SetX(160);
    $pdf->Cell(15,50,'',1,0,'C',0);
    $pdf->SetX(175);
    $pdf->Cell(15,50,'',1,0,'C',0);
    $pdf->SetX(190);
    $pdf->Cell(18,50,'',1,0,'C',0);
    $pdf->SetX(208);
    $pdf->Cell(19,50,'',1,0,'C',0);
    $pdf->SetX(227);
    $pdf->Cell(18,50,'',1,0,'C',0);
    $pdf->SetX(245);
    $pdf->Cell(20,50,'',1,0,'C',0);
    $pdf->SetX(265);
    $pdf->Cell(20,50,'',1,1,'C',0);*/ 
    
    $footer = ($pdf->GetY()) + 39;
    if($footer >= 190) {
        $pdf->SetX(10);
        $pdf->SetFont('Arial','B',9);
        $next_page = $pdf->PageNo()+1;
        $pdf->Cell(0,5,'Continued to Page Number '.$next_page,1,1,'R',0);
        $pdf->Addpage();
    }

    $y_axis1 = $pdf->GetY();
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(8,9,'',1,0,'C',0);
    $pdf->SetX(18);
    $pdf->Cell(17,9,'Total',1,0,'C',0);
    $pdf->SetX(35);
    $pdf->Cell(45,9,'',1,0,'C',0);
    $pdf->SetX(80);
    $pdf->Cell(45,9,'',1,0,'C',0);
    /*$pdf->SetX(100);
    $pdf->Cell(25,9,'',1,0,'C',0);*/
    $pdf->SetX(125);
    $pdf->Cell(25,9,'',1,0,'C',0);
    $pdf->SetX(150);
    $pdf->Cell(10,9,$quantity_total,1,0,'C',0);
    $pdf->SetX(160);
    $pdf->Cell(15,9,$weight_total,1,0,'C',0);
    $pdf->SetX(175);
    $pdf->Cell(15,9,$cooly_total,1,0,'C',0);
    $pdf->SetX(190);
    $pdf->Cell(18,9,$topay_total,1,0,'C',0);
    $pdf->SetX(208);
    //$pdf->Cell(19,9,$account_total,1,0,'C',0);
    $pdf->Cell(19,9,$total_account,1,0,'C',0);
    $pdf->SetX(227);
    //$pdf->Cell(18,9,$paid_total,1,0,'C',0);
    $pdf->Cell(18,9,$total_paid,1,0,'C',0);
    $pdf->SetX(245);
    $pdf->Cell(20,9,'',1,0,'C',0);
    $pdf->SetX(265);
    $pdf->Cell(20,9,'',1,1,'C',0);  
    
    $total_amt = 0;
    //$total_amt =$topay_total+$paid_total+$account_total;
    $total_amt =$topay_total+$total_account+$total_paid;
    $total = $cooly_total+$total_amt;

    $starty =$pdf->GetY();
    $pdf->SetX(10);
    $pdf->Cell(0,5,'Remarks',0,0,'L',0);
    $pdf->SetX(10);
    $pdf->Cell(235,15,'',1,1,'C',0);
    $remarks_starty = $pdf->GetY();
    $pdf->SetX(10);
    $pdf->Cell(0,4,'Branch Name :-  '.$branch_name,0,1,'L',0);
    $pdf->SetX(10);
    $pdf->Cell(0,4,'Mobile No  :-'.$branch_number,0,1,'L',0);
    $pdf->SetX(10);
    $pdf->Cell(0,4,'Debit To  A/c =  '.number_format($total,2),0,1,'L',0);
    $pdf->SetY($remarks_starty);
    $pdf->SetX(10);
    $pdf->Cell(235,12,'',1,1,'C',0);
    $branch_starty = $pdf->GetY();
    $pdf->MultiCell(135,5,'Note : We, Driver & Owner of above Truck have received the goods mentioned as above in good Condition and are reponsible to driver at destination in safe & sound condition',0,'L',0);
    $pdf->SetY($branch_starty);
    $pdf->Cell(235,10,'',1,1,'C',0);
    $sign_starty =$pdf->GetY();
    $pdf->Cell(235,10,'',0,1,'C',0);
    $pdf->SetX(30);
    $pdf->Cell(40,5,'DRIVER SIGNATURE',0,0,'C',0);
    $pdf->SetX(100);
    $pdf->Cell(100,5,'FOR '.$organization_name,0,0,'C',0);
    $pdf->SetY($sign_starty);
    $pdf->SetX(10);
    $pdf->Cell(275,15,'',1,0,'C',0);
   
    $pdf->SetY($starty);
    $pdf->SetX(245);
    $pdf->Cell(20,15,'Freight',1,0,'C',0);
    $pdf->SetX(265);
    $pdf->Cell(20,15,number_format($total_amt,2),1,1,'C',0);
    $pdf->SetX(245);
    $pdf->Cell(20,6,'Cooly ',0,1,'C',0);
    $pdf->SetX(245);
    $pdf->Cell(20,6,'charges',0,0,'C',0);
    $pdf->SetY($remarks_starty);
    $pdf->SetX(245);
    $pdf->Cell(20,12,'',1,0,'C',0);
    $pdf->SetX(265);
    $pdf->Cell(20,12,number_format($cooly_total,2),1,1,'C',0);
    $pdf->SetX(245);
    $pdf->Cell(20,10,'Total Amt',1,0,'C',0);
   
    $pdf->SetX(265);
    $pdf->Cell(20,10,number_format($total,2),1,1,'C',0);
    $pdf->OutPut();

?>