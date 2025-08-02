<?php
include("../include_user_check_and_files.php");
include("../include/number2words.php");

$view_lr_id = "";
if(isset($_REQUEST['view_lr_id'])) {
    $view_lr_id = $_REQUEST['view_lr_id'];
}
$rpt_type = ""; $display = ""; $copies = array();
    if(isset($_REQUEST['rpt_type'])){
        $rpt_type = $_REQUEST['rpt_type'];
    }
    if(!empty($rpt_type)){
        if($rpt_type == "all") {
            $copies = array('Consignor Copy', 'Consignee Copy', 'Lorry Copy');
        }
        else {
            if($rpt_type == "1"){
                $display = "Consignor Copy";
            }else if($rpt_type == "2"){
                $display = "Consignee Copy";
            }else if($rpt_type == "3"){
                $display = "Lorry Copy";
            }
            $copies[] = $display;
        }
    }

   

if(!empty($view_lr_id)) {
    $view_lr_id = $_REQUEST['view_lr_id'];

    $lr_date = date("d-m-Y"); $lr_type = "";  $lr_number = ""; $consignor_id = ""; $consignor_name = ""; $consignee_id = ""; $consignee_id = ""; $consignee_name = ""; $quantity = "";$weight = ""; $consignor_details = array(); $consignee_details = array();
    $consignor_name = ""; $consignor_address = ""; $consignor_state = ""; $consignor_mobile_number = ""; $consignor_city = ""; $consignee_city ="";$consignee_district=""; $consignee_address = ""; $consignor_state = ""; $consignee_mobile_number = ""; $rate = 0; $kooli_per_unit = array(); 
    $total_tax_value = "" ; $loading_charges_value = ""; $unloading_charges_value = "";$unloading_value = 0;
    $loading_value = 0;$kooli_per_qty = 0;
    $loading_charges_error = ""; $loading_charges_names = ""; $loading_charges = ""; $loading_charges_total = 0; $loading_charge = array(); $loading_charges_values = array(); $bill_type = ""; $unit_name = array(); $organization_state =""; $tax_plus_value = 0; $tax_value =0;$total_kooli = 0;
    $total_tax_value = "" ; $charges_value = ""; $total =""; $gst_option =0; $bill_value = ""; $bill_number = "";
    $unloading_charges_error = ""; $unloading_charges_names = ""; $unloading_charges = ""; $unloading_charges_total = 0; $unloading_charges_values = array(); $unloading_charge = array(); $city = ""; $consignee_identification = ""; $consignor_identification = ""; $organization_id = "";$delivery_value = 0;$total_tax_amnt = 0;$overall_total = 0;
    
    $total_tax_value = "" ; $organization_details = ""; $account_party_name = "";
    $charges_error = ""; $charges_names = ""; $charges = ""; $charges_total = 0; $charges_values = array(); $charge = array(); $reference_number = "";
    $from_branch_name = ""; $from_branch_id = ""; $branch_id = ""; $to_branch_name = "";
    $from_branch_state = ""; $from_company_state = "";$consignor_state = ""; $from_consignor_state = "";
    $sgst_value = ""; $cgst_value = ""; $igst_value = ""; $from_party_state = "";
    if(!empty($view_lr_id)) {
        $lr_list = array();
        $lr_list = $obj->getTableRecords($GLOBALS['lr_table'], 'lr_id', $view_lr_id);
        if(!empty($lr_list)) {
            $mode_display = ""; $account_name = array();
            foreach($lr_list as $data) {
                if(!empty($data['consignee_id'])) {
                    $consignee_id = $data['consignee_id'];
                }
                if(!empty($data['consignor_id'])) {
                    $consignor_id = $data['consignor_id'];
                }
                if(!empty($data['organization_id'])) {
                    $organization_id = $data['organization_id'];
                }
                if(!empty($data['consignee_id'])) {
                    $consignee_id = $data['consignee_id'];
                }
                if(!empty($data['lr_date'])) {
                    $lr_date = date("d-m-Y", strtotime($data['lr_date']));
                }
                if(!empty($data['lr_number'])) {
                    $lr_number = $data['lr_number'];
                }
                if(!empty($data['reference_number']) && $data['reference_number'] != $GLOBALS['null_value']) {
                    $reference_number = $obj->encode_decode("decrypt", $data['reference_number']);
                }
                if(!empty($data['city'])) {
                    $city = $data['city'];
                    // $city = $obj->encode_decode("decrypt",$city);
                }
                if(!empty($data['consignor_city'])) {
                    $bill_consignor_city = $data['consignor_city'];
                    $bill_consignor_city = $obj->encode_decode("decrypt",$bill_consignor_city);
                }
                if(!empty($data['consignor_details']))
                {
                    $consignor_details = $data['consignor_details'];
                    $consignor_details = $obj->encode_decode("decrypt",$data['consignor_details']);
                }
                if(!empty($data['organization_details']))
                {
                    $organization_details = $data['organization_details'];
                    $organization_details = $obj->encode_decode("decrypt",$data['organization_details']);
                }
                if(!empty($data['consignee_details']))
                {
                    $consignee_details = $data['consignee_details'];
                    $consignee_details = $obj->encode_decode("decrypt",$data['consignee_details']);
                }
                if(!empty($data['account_party_id'])){
                    $account_party_name = $obj->getTableColumnValue($GLOBALS['account_party_table'],'account_party_id',$data['account_party_id'],'name');
                    if(!empty($account_party_name)){
                        $account_party_name = $obj->encode_decode('decrypt',$account_party_name);
                    }
                }
                if(!empty($data['charges_total']))
                {
                    $charges_total = $data['charges_total'];
                    $charges_total = $obj->encode_decode("decrypt",$data['charges_total']);
                }
                if($data['quantity']!='')
                {
                    $quantity = $data['quantity'];
                    $quantity = explode(",",$quantity);
                }
                if($data['weight'] != ''){
                    $weight = $data['weight'];
                    $weight = explode(",",$weight);
                }
                if(!empty($data['bill_type']))
                {
                    $bill_type = $data['bill_type'];
                }
                if(!empty($data['bill_value']))
                {
                    $bill_value = $data['bill_value'];
                    // $bill_value = $obj->encode_decode("decrypt",$bill_value);
                }
                if(!empty($data['bill_date']))
                {
                    $bill_date = date("d-m-Y", strtotime($data['bill_date']));
                    // $bill_value = $obj->encode_decode("decrypt",$bill_value);
                }
                if(!empty($data['from_branch_id'])) {
                    $from_branch_id = $data['from_branch_id'];
                }
                if(!empty($data['from_branch_name'])) {
                    $from_branch_name = $obj->encode_decode('decrypt', $data['from_branch_name']);
                }
                if(!empty($data['to_branch_name'])) {
                    $to_branch_name = $obj->encode_decode('decrypt', $data['to_branch_name']);
                }
                if(!empty($data['bill_number']))
                {
                    $bill_number = $data['bill_number'];
                    // $bill_number = $obj->encode_decode("decrypt",$data['bill_number']);
                }
                if(!empty($data['unit_name']))
                {
                    $unit_name = explode(",",$data['unit_name']);
                    // $unit_name = $data['unit_name'];
                    // $unit_name = $obj->encode_decode("decrypt",$data['unit_name']);
                }
                if($data['price_per_qty'] != '')
                {
                    $rate = explode(",",$data['price_per_qty']);
                }
                // if(!empty($data['kooli_per_unit']) && $data['kooli_per_unit'] != $GLOBALS['null_value']){
                //     $kooli_per_unit = explode() 
                // }
                if(!empty($data['kooli_per_qty']) && $data['kooli_per_qty'] != $GLOBALS['null_value']){
                    $kooli_per_qty = explode(",",$data['kooli_per_qty']);
                }
                if(!empty($data['charges_value']) && $data['charges_value'] != $GLOBALS['null_value']) {
                    $charges_values = $obj->encode_decode('decrypt', $data['charges_value']);
                    $charges_values = json_decode($charges_values);  
                    foreach($charges_values as $charges_key => $charges) {          
                        foreach($charges as $key => $cdata) {
                            if($key == "charges_name") {
                                $charges_name = $cdata;
                            }
                            if($key == "charges") {
                                $charges_value = $cdata;
                            }
                        }
                    }
                }
                if(!empty($data['total_tax']) && $data['total_tax']!= $GLOBALS['null_value']){
                    $total_tax_amnt = $data['total_tax'];
                }
                if(!empty($data['total']) && $data['total'] != $GLOBALS['null_value']){
                    $overall_total = $data['total'];
                }
                if(!empty($data['delivery_charges_value']) && $data['delivery_charges_value'] != $GLOBALS['null_value']){
                    $delivery_value = $data['delivery_charges_value'];
                }
                if(!empty($data['unloading_charges_value']) && $data['unloading_charges_value'] != $GLOBALS['null_value']) {
                    // $unloading_charges_values = $obj->encode_decode('decrypt', $data['unloading_charges_value']);
                    // $unloading_charges_values = json_decode($unloading_charges_values);  
                    // foreach($unloading_charges_values as $unloading_charges_key => $unloading_charges) {          
                    //     foreach($unloading_charges as $key => $cdata) {
                    //         if($key == "unloading_charges_name") {
                    //             $unloading_charges_name = $cdata;
                    //         }
                    //         if($key == "unloading_charges") {
                    //             $unloading_charges = $cdata;
                    //         }
                    //     }
                    // }
                    $unloading_value = $data['unloading_charges_value'];
                }
                if(!empty($data['loading_charges_value']) && $data['loading_charges_value'] != $GLOBALS['null_value']) {
                    // $loading_charges_values = $obj->encode_decode('decrypt', $data['loading_charges_value']);
                    // $loading_charges_values = json_decode($loading_charges_values);  
                    // foreach($loading_charges_values as $loading_charges_key => $loading_charges) {          
                    //     foreach($loading_charges as $key => $cdata) {
                    //         if($key == "loading_charges_name") {
                    //             $loading_charges_name = $cdata;
                    //         }
                    //         if($key == "loading_charges") {
                    //             $loading_charges = $cdata;
                    //         }
                    //     }
                    // }
                    $loading_value = $data['loading_charges_value'];
                }
                if(!empty($data['gst_option'])) {
                    $gst_option = $data['gst_option'];
                }
                if(!empty($data['tax_option'])) {
                    $tax_option = $data['tax_option'];
                }
                if(!empty($data['tax_value'])) {
                    $tax_value = $data['tax_value'];
                }
                if(!empty($data['organization_state'])) {
                    $organization_state = $data['organization_state'];
                }
                if(!empty($data['state']) && $data['state'] != 'NULL') {
                    $consignee_state = $data['state'];
                }
                 if(!empty($data['from_branch_state'])) {
                    $from_branch_state = $data['from_branch_state'];
                }
                if(!empty($data['consignor_state'])) {
                    $from_consignor_state = $data['consignor_state'];
                }
              
                if(!empty($data['cgst'])) {
                    $cgst_value = $data['cgst'];
                }
                if(!empty($data['igst'])) {
                    $igst_value = $data['igst'];
                }
                if(!empty($data['sgst'])) {
                    $sgst_value = $data['sgst'];
                }
                if(!empty($data['consignee_state'])) {
                    $from_party_state = $data['consignee_state'];
                }
            }
        }
    }
}

if($bill_type == "Paid") {
    $from_company_state = $from_consignor_state;
}else{
    $from_company_state = $from_branch_state;
}
$organization_name = ""; $organization_address1 = ""; $organization_address2 =""; $organization_city =""; $organization_pincode="";$organization_state = ""; $organization_gst_number =""; $organization_mobile_number ="";
$consignee_gst_number = ""; $consignor_gst_number = ""; $others_consignee_city ="";
if(!empty($organization_details)){
    $organization_details = explode("$$$",$organization_details);
    for($i =0 ;$i<count($organization_details);$i++)
    {
        if($i == 0)
        {
            $organization_name = $organization_details[0];
        }
        else
        {
            if(!empty($organization_list))
            {
                $organization_list = $organization_list." ".$organization_details[$i];
            }
            else
            {
                $organization_list = $organization_details[$i];
            }
        }
        if($i==4)
        {
            $organization_city = $organization_details[3];
        }
        
    }
}

// $company_name = "";
// $company_name = $obj->encode_decode("encrypt", $organization_name);

$company_name = "";
$company_name = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'name');

$company_address_line1 = "";
$company_address_line1 = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'address_line1');

$company_address_line2 = "";
$company_address_line2 = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'address_line2');

$company_delivery_address = "";
// $company_delivery_address = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'delivery_address');

$company_mobile_no1 = "";
$company_mobile_no1 = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'mobile_number');

$company_mobile_no2 = "";
// $company_mobile_no2 = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'mobile_number2');

$company_state = "";
$company_state = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'state');

$company_city = "";
$company_city = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'city');


$company_pincode = "";
$company_pincode = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'pincode');


$company_gst_number = "";
$company_gst_number = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'gst_number');

if(!empty($company_gst_number) && ($company_gst_number != "NULL")) {
    $company_gst_number = $obj->encode_decode("decrypt", $company_gst_number);
}

if(!empty($company_name)) {
    $company_name = $obj->encode_decode("decrypt", $company_name);
}

if(!empty($company_address_line1)) {
    $company_address_line1 = $obj->encode_decode("decrypt", $company_address_line1);
}
if(!empty($company_address_line2)) {
    $company_address_line2 = $obj->encode_decode("decrypt", $company_address_line2);
}

if(!empty($company_delivery_address)) {
    $company_delivery_address = $obj->encode_decode("decrypt", $company_delivery_address);
}

if(!empty($company_mobile_no1)) {
    $company_mobile_no1 = $obj->encode_decode("decrypt", $company_mobile_no1);
}

if(!empty($company_mobile_no2)) {
    $company_mobile_no2 = $obj->encode_decode("decrypt", $company_mobile_no2);
}

if(!empty($company_city)) {
    $company_city = $obj->encode_decode("decrypt", $company_city);
}

if(!empty($company_pincode)) {
    $company_pincode = $obj->encode_decode("decrypt", $company_pincode);
}

if(!empty($company_state)) {
    $company_state = $obj->encode_decode("decrypt", $company_state);
}

    if(!empty($consignor_id))
    {
        $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'],'consignor_id',$consignor_id,'name');
        if(!empty($consignor_name)){
            $consignor_name = $obj->encode_decode('decrypt', $consignor_name);
        }

        $consignor_list = array();
        $consignor_list = $obj->getTableRecords($GLOBALS['consignor_table'], 'consignor_id', $consignor_id);

        if(!empty($consignor_list)){
            foreach($consignor_list as $list){
                if(!empty($list['address']) && $list['address'] != $GLOBALS['null_value']){
                    $consignor_address = $obj->encode_decode('decrypt', $list['address']);
                }
                if(!empty($list['city']) && $list['city'] != $GLOBALS['null_value']){
                    $consignor_city = $obj->encode_decode('decrypt', $list['city']) ;
                }
                if(!empty($list['mobile_number']) && $list['mobile_number'] != $GLOBALS['null_value']){
                    $consignor_mobile_number = $obj->encode_decode('decrypt', $list['mobile_number']) ;
                }
                if(!empty($list['state']) && $list['state'] != $GLOBALS['null_value']){
                    $consignor_state = $obj->encode_decode('decrypt', $list['state']);
                }
                if(!empty($list['gst_number']) && $list['gst_number'] != $GLOBALS['null_value']){
                    $consignor_gst_number = $obj->encode_decode('decrypt', $list['gst_number']);
                }
                if(!empty($list['identification']) && $list['identification'] != $GLOBALS['null_value']){
                    $consignor_identification = $obj->encode_decode('decrypt', $list['identification']);
                }
            }
        }
    }
    
    if(!empty($consignee_id))
    {
        $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$consignee_id,'name');
        if(!empty($consignee_name)){
            $consignee_name = $obj->encode_decode('decrypt', $consignee_name);
        }

        $consignee_list = array();
        $consignee_list = $obj->getTableRecords($GLOBALS['consignee_table'], 'consignee_id', $consignee_id);

        if(!empty($consignee_list)){
            foreach($consignee_list as $list){
                if(!empty($list['address']) && $list['address'] != $GLOBALS['null_value']){
                    $consignee_address = $obj->encode_decode('decrypt', $list['address']);
                }
                if(!empty($list['city']) && $list['city'] != $GLOBALS['null_value']){
                    $consignee_city = $obj->encode_decode('decrypt', $list['city']) ;
                }
                if(!empty($list['district']) && $list['district'] != $GLOBALS['null_value']){
                    $consignee_district = $obj->encode_decode('decrypt', $list['district']) ;
                }
                if(!empty($list['mobile_number']) && $list['mobile_number'] != $GLOBALS['null_value']){
                    $consignee_mobile_number = $obj->encode_decode('decrypt', $list['mobile_number']) ;
                }
                if(!empty($list['state']) && $list['state'] != $GLOBALS['null_value']){
                    $consignee_state = $obj->encode_decode('decrypt', $list['state']);
                }
                if(!empty($list['gst_number']) && $list['gst_number'] != $GLOBALS['null_value']){
                    $consignee_gst_number = $obj->encode_decode('decrypt', $list['gst_number']);
                }
                if(!empty($list['identification']) && $list['identification'] != $GLOBALS['null_value']){
                    $consignee_identification = $obj->encode_decode('decrypt', $list['identification']);
                }
                if(!empty($list['others_city']) && $list['others_city']!='NULL')
                {
                    $others_consignee_city = $list['others_city'];
                }
            }
        }
    }
    
    $freight =0; $total =0; $total_amount =0; $amount =array();
    for($i =0;$i<count($unit_name);$i++)
    {
        if($rate[$i] !='' && $quantity[$i] != '' && $quantity[$i] > 0)
        {
            $freight += $rate[$i] * $quantity[$i];
            $amount[$i] = $rate[$i] * $quantity[$i];
            
        }
        else if($rate[$i] != '' && $weight[$i] != '' && $weight[$i] > 0){
            $freight += $rate[$i] * $weight[$i];
            $amount[$i] = $rate[$i] * $weight[$i];
        }
        // $kooli_per_unit[$i] = trim($kooli_per_unit[$i]);
        // if(!empty($kooli_per_unit[$i])) {
        //     if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $kooli_per_unit[$i])) {                                                        
        //         $total_kooli = $quantity_values[$i] * $kooli_per_unit[$i];
        //         if(!empty($total_kooli)) {
        //             $total_kooli = number_format($total_kooli, 2);
        //             $total_kooli = str_replace(",", "", $total_kooli);
        //             $kooli_per_quantity[$i] = $total_kooli;
        //         }
        //     }
        // }
    }
    $total += $freight;
    $total_amount += $freight;
    
    /*
    if(!empty($charges_value)) {
        // for($c = 0; $c < count($charges_value); $c++) {
            $charge = "";
            $charge = trim($charges_value);
            if(!empty($charge)) {
                $charges_names = trim($charges_names);
                // if(!empty($charges_names[$c])) {
                    if(!empty($freight) && preg_match("/^[0-9]+(\\.[0-9]+)?$/", $freight)) {
                        $charges_value = 0;
                        if (strpos($charge, '%') !== false) {
                            $charge = trim(str_replace("%", "", $charge));
                            if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $charge)) {											
                               $charges_value = ($freight * $charge) / 100;
                                $charges_values[] = array('charges_name' => $charges_names, 'charges' => $charge."%");
                                // $charges_values[] = array('charges' => $charge."%");
                            }
                            else {
                                $charges_error = "Invalid Charges";
                            }
                        }
                        else {
                            if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $charge)) {
                                $charges_value = $charge;
                                $charges_values[] = array('charges_name' => $charges_names, 'charges' => $charge);
                                // $charges_values[] = array('charges' => $charge);
                            }
                            else {
                                $charges_error = "Invalid Charges";
                            }
                        }
                        if(!empty($charges_value)) {
                            $charges_value = number_format($charges_value, 2);
                            $charges_value = str_replace(",", "", $charges_value);
                            $charges_total = $charges_total + $charges_value;
                            $total = $freight + $charges_total;
                            $total_amount = $freight + $charges_total;
                            $charges_values = json_encode($charges_values);
                        }
                        // echo $charges_values."hI";
                    }
                // }
                // else {
                // 	$charges_error = "Charges name is empty";
                // }
            }
        // }
    }
    */
   
    /*
    if(!empty($unloading_charges)) {
        // for($c = 0; $c < count($unloading_charges); $c++) {
            // $unloading_charge = "";
            // $unloading_charge = trim($unloading_charges);
            if(!empty($unloading_charges)) {
                $unloading_charges_names = trim($unloading_charges_names);
                // if(!empty($unloading_charges_names[$c])) {
                    if(!empty($total_amount) && preg_match("/^[0-9]+(\\.[0-9]+)?$/", $total_amount)) {
                        $unloading_charges_value = 0;
                        if (strpos($unloading_charges, '%') !== false) {
                            $unloading_charges = trim(str_replace("%", "", $unloading_charges));
                            if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $unloading_charges)) {						
                                $unloading_charges_value = ($total_amount * $unloading_charges) / 100;
                                $unloading_charges_values[] = array('unloading_charges_name' => $unloading_charges_names, 'unloading_charges' => $unloading_charges."%");
                                // $unloading_charges_values[] = array('unloading_charges' => $unloading_charge."%");
                            }
                            else {
                                $unloading_charges_error = "Invalid unloading_Charges";
                            }
                        }
                        else {
                            if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $unloading_charges)) {
                                $unloading_charges_value = $unloading_charges;
                                $unloading_charges_values[] = array('unloading_charges_name' => $unloading_charges_names, 'unloading_charges' => $unloading_charges);
                                // $unloading_charges_values[] = array('unloading_charges' => $unloading_charge);
                            }
                            else {
                                $unloading_charges_error = "Invalid unloading_Charges";
                            }
                        }
                        if(!empty($unloading_charges_value)) {
                            $unloading_charges_value = number_format($unloading_charges_value, 2);
                            $unloading_charges_value = str_replace(",", "", $unloading_charges_value);
                            $unloading_charges_total = $unloading_charges_total + $unloading_charges_value;
                            $total = $total_amount + $unloading_charges_total;
                            $total_amount = $total_amount + $unloading_charges_total;
                            $unloading_charges_values = json_encode($unloading_charges_values);
                        }
                        // echo $charges_values."hI";
                    }
                // }
                // else {
                // 	$charges_error = "Charges name is empty";
                // }
            }
        // }
    }

    if(!empty($gst_option) && $gst_option == 1 ) {
        $total_tax_value=0;$total_product_amount = 0;
            $percentage = 100;
            $tax = trim(str_replace("%", "", $tax_value));
            $product_amount = 0;

            if($tax_option==1){
                $percentage = $tax + 100;
            }
            if($tax_value!='' && $tax_value!='%'){
                if($organization_state == $consignee_state) {
                    // $tax = $tax / 2;
                    $tax_plus_value = ($total_amount * $tax) / $percentage;
                    if(!empty($tax_plus_value)) {
                        $tax_plus_value = number_format($tax_plus_value, 2);
                        $tax_plus_value = str_replace(",", "", $tax_plus_value);
                    }
                }
                else {
                    $tax_plus_value = ($total_amount * $tax) / $percentage;
                    if(!empty($tax_plus_value)) {
                        $tax_plus_value = number_format($tax_plus_value, 2);
                        $tax_plus_value = str_replace(",", "", $tax_plus_value);
                    }
                }
                 $total_tax_value+=$tax_plus_value;
            }
        // }
        
        if(!empty($total_tax_value)) {
            if($tax_option == "2"){
                $total_amount = $total_amount + $total_tax_value;
                $total = $total_amount;
            }
            else{
                $total_amount = $total_amount ;
            }
        }
    }
    */

    $branch_name ="";
    /*
    if($branch_id)
    {
        $branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$branch_id,'name');
        if(!empty($branch_name))
        {
            $branch_name =$obj->encode_decode("decrypt",$branch_name);
        }
    }*/

    require_once('../fpdf/AlphaPDF.php');
    $pdf = new AlphaPDF('P','mm',array(105,148));
	$pdf->AliasNbPages(); 

    if(!empty($copies)) {
        for($x = 0; $x < count($copies); $x++) {
            if(!empty($copies[$x])) {
                $display = $copies[$x];

                $pdf->AddPage();
                $pdf->SetAutoPageBreak(false);
                // $pdf->SetDrawColor(223,36,67);
                // $pdf->SetTextColor(223,36,67);
                $pdf->SetTitle('Receipt');
                $pdf->SetFont('Arial','B',10);
                // if(file_exists('../images/topgodimage.png')){
                //     $pdf->Image('../images/topgodimage.png',45,10,120,7);
                // }
                
                if(file_exists('../include/images/mt.png')){
                    $pdf->Image('../include/images/mt.png',42,5,25,20);
                }
                if(file_exists('../include/images/mohan_transport.png')){
                    $pdf->Image('../include/images/mohan_transport.png',5,25,95,6);
                }
                $head_y = $pdf->GetY();
                if(file_exists('../include/images/murugan.png')){
                    $pdf->Image('../include/images/murugan.png',75,5,25,20);
                }
                if(file_exists('../include/images/pillayar.png')){
                    $pdf->Image('../include/images/pillayar.png',5,5,25,20);
                }
    
    if(!empty($organization_details)) {
        $pdf->SetY($head_y+21);
        $pdf->SetX(5);
        // $pdf->SetFont('Arial','B',23);
        // $pdf->Cell(0,10,'',0,1,'C',0);

        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10);
        $pdf->Multicell(85,4,$company_address_line1.",".$company_address_line2.",".$company_city."-".$company_pincode,0,'C');
        $pdf->SetX(10);
        $pdf->Cell(85,4,$company_state.".",0,1,'C');
        $pdf->SetX(10);
        if(!empty($company_gst_number)){
            $pdf->Cell(85,4,'GSTIN :'.$company_gst_number,0,1,'C');
        }
        else{
            $pdf->Cell(85,4,'',0,1,'C');
        }
       
        // print_r($organization_details);
        // for($i=0;$i < count($organization_details);$i++){
        //     $pdf->SetX(20);
        //     $pdf->MultiCell(65,4,$organization_details[$i],0,'C',0);
        // }
        // if(!empty($organization_list))
        // {
        //     $pdf->SetX(20);
        //     $pdf->MultiCell(65,4,$organization_list,0,'C',0);
        // }
    }
    $display_y = $pdf->GetY();
    $pdf->SetY($display_y);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(35);
    $pdf->Cell(30,4,$display,1,1,'C',0);
    $next_y = $pdf->GetY();
    $pdf->SetY(5);
    $pdf->SetX(5);
    $pdf->Cell(95,$next_y - 5,'',1,1,'C',0);
    
    $pdf->SetY($next_y);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(5);
    $pdf->Cell(15,4,'LR NO : ',0,0,'L',0);
    $pdf->SetX(20);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->Cell(15,4,$lr_number,0,0,'L',0);

    if(!empty($reference_number)) {
        $pdf->SetX(35);
        $pdf->Cell(13,4,'Ref.No : ',0,0,'L',0);
        $pdf->SetX(48);
        $pdf->SetFont('Arial','B',8.5);
        $pdf->Cell(22,4,$reference_number,0,0,'L',0);
    }
    else {
        $pdf->SetX(35);
        $pdf->Cell(13,4,'',0,0,'L',0);
        $pdf->SetX(48);
        $pdf->Cell(22,4,'',0,0,'L',0);
    }

    $pdf->SetX(70);
    $pdf->Cell(15,4,'DATE : ',0,0,'L',0);
    $pdf->SetX(85);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->Cell(15,4,$lr_date,0,0,'R',0);

    $pdf->SetX(5);
    $pdf->Cell(95,4,'',1,1,'C',0);

    $delivery_consignee = "";
    if($consignee_city == 'Others')
    {
        $consignee_city = $others_consignee_city;
    }
    if(!empty($consignee_city) && !empty($consignee_district)){
        $delivery_consignee = $consignee_city." , ".$consignee_district;
    }
    else if(!empty($consignee_city) && empty($consignee_district)){
        $delivery_consignee = $consignee_city;
    }
    else if(!empty($consignee_district) && empty($consignee_city)){
        $delivery_consignee = $consignee_district;
    }
    else {
        $delivery_consignee = $to_branch_name;
    }
    
    $pdf->SetX(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(0,4,'FROM : ',0,0,'L',0);
    $pdf->SetX(18);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->Cell(0,4,$from_branch_name,0,0,'L',0);
    $pdf->SetX(50);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(0,4,'To : ',0,0,'L',0);
    $pdf->SetX(60);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->Cell(0,4,$delivery_consignee,0,0,'R',0);
    $pdf->SetX(5);
    $pdf->Cell(95,4,'',1,1,'C',0);

    $start_y = $pdf->GetY();
    $pdf->SetX(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(30,4,"Consignor's Name: ",0,0,'L',0);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->Cell(0,4,$consignor_name,0,1,'L',0);
    $pdf->SetX(5);
    if(!empty($consignor_gst_number)){
        $pdf->Cell(0,4,'GSTIN :'.$consignor_gst_number,0,0,'L',0);
    }
    else{
        $pdf->Cell(0,4,'',0,0,'L',0);
    }
    $pdf->SetY($start_y);
    $pdf->SetX(5);
    $pdf->Cell(95,8,'',1,1,'C',0);

    if(empty($consignee_name) && !empty($account_party_name)){
        $consignee_name = $account_party_name." (Acc.Party)";
    }
    $start_y = $pdf->GetY();
    $pdf->SetX(5);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(30,4,"Consignee's Name: ",0,0,'L',0);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->Cell(45,4,$consignee_name,0,1,'L',0);
    $pdf->SetX(5);
    if(!empty($consignee_gst_number)){
        $pdf->Cell(0,4,'GSTIN :'.$consignee_gst_number,0,0,'L',0);
    }
    else{
        $pdf->Cell(0,4,'',0,0,'L',0);
    }
    $pdf->SetY($start_y);
    $pdf->SetX(5);
    $pdf->Cell(95,8,'',1,1,'C',0);

    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(5);
    $pdf->Cell(95,5,'PARTICULARS',1,1,'C',0);
    $pdf->SetX(5);
    $pdf->Cell(30,5,'ITEM',1,0,'C',0);
    $pdf->SetX(35);
    $pdf->Cell(10,5,'QTY',1,0,'C',0);
    $pdf->SetX(45);
    $pdf->Cell(12,5,'WEIGHT',1,0,'C',0);
    $pdf->SetX(57);
    $pdf->Cell(12,5,'RATE',1,0,'C',0);
    $pdf->SetX(69);
    $pdf->Cell(12,5,'COOLY',1,0,'C',0);
    $pdf->SetX(81);
    $pdf->Cell(19,5,'FREIGHT',1,1,'C',0);
    $pdf->SetFont('Arial','B',8.5);
    $total_qty =0; $total_kooli = 0;
    for($i=0;$i<count($unit_name);$i++)
    {
        if(!empty($unit_name[$i]) && empty($x))
        {
            $unit_name[$i] = $obj->encode_decode("decrypt",$unit_name[$i]);
        }
        $pdf->SetX(5);
        $pdf->Cell(30,4,$unit_name[$i],1,0,'C',0);
        $pdf->SetX(35);
        if(!empty($quantity)){
            $pdf->Cell(10,4,$quantity[$i],1,0,'C',0);
        }
        else{
            $pdf->Cell(10,4,'',1,0,'C',0);
        }
        $pdf->SetX(45);
        if(!empty($weight)){
            $pdf->Cell(12,4,$weight[$i],1,0,'C',0);
        }
        else{
            $pdf->Cell(12,4,'',1,0,'C',0);
        }
        $pdf->SetX(57);
        $pdf->Cell(12,4,$rate[$i],1,0,'C',0);
        if($quantity[$i]!=''){
            $total_qty += $quantity[$i];
        }
        $pdf->SetX(69);
        if(!empty($kooli_per_qty)){
            $pdf->Cell(12,4,round($kooli_per_qty[$i]),1,0,'C',0);
            $total_kooli += $kooli_per_qty[$i];
        }
        else{
            $pdf->Cell(12,4,'',1,0,'C',0);
        }
        $pdf->SetX(81);
        $pdf->Cell(19,4,$amount[$i],1,1,'C',0);
    }
    $pdf->SetX(5);
    $pdf->Cell(95,40,'',1,0,'C',0);
    $pdf->Cell(0,4,'',0,1,'C',0);
    $start_y = $pdf->GetY();
    $pdf->SetFont('Arial','B',0);
    $pdf->SetX(5);
    $pdf->Cell(30,4,'TOTAL QTY',1,0,'C',0);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->SetX(35);
    $pdf->Cell(20,4,$total_qty,1,1,'C',0);
    $pdf->SetFont('Arial','B',0);
    $pdf->SetX(5);
    $pdf->Cell(30,4,'TOTAL FREIGHT',1,0,'C',0);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->SetX(35);
    $pdf->Cell(20,4,$freight,1,1,'C',0);
    $pdf->SetFont('Arial','B',0);
    $pdf->SetX(5);
    $pdf->Cell(30,4,'TOTAL LOADING',1,0,'C',0);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->SetX(35);
    if(!empty($loading_value)){
        $loading_value = round($loading_value);
    }
    $pdf->Cell(20,4,$loading_value,1,1,'C',0);
    $pdf->SetFont('Arial','B',0);
    $pdf->SetX(5);
    $pdf->Cell(30,4,'TOTAL COOLY',1,0,'C',0);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->SetX(35);
    if(!empty($total_kooli)){
        $total_kooli = round($total_kooli);
    }
    $pdf->Cell(20,4,$total_kooli,1,1,'C',0);
    $charge_y = $pdf->GetY();
    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(5);
    $pdf->MultiCell(30,4,'DELIVERY CHARGE',0,'C');
    $charge_y1 = $pdf->GetY();
    $pdf->SetY($charge_y);
    $pdf->SetX(5);
    $pdf->Cell(30,$charge_y1-$charge_y,'',1,0);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->SetX(35);
    if(!empty($delivery_value) && strpos($delivery_value, "%") == false){
        $delivery_value = round($delivery_value);
    }
    $tax_value_per = ""; $tax_value_percentage = "";
    $pdf->Cell(20,$charge_y1-$charge_y,$delivery_value,1,1,'C',0);
    $pdf->SetFont('Arial','B',0);
        if(($gst_option == 1) && ($from_company_state == $from_party_state)){
                if(!empty($tax_value) && $tax_value != $GLOBALS['null_value']){
                    $tax_value_percentage = $tax_value/2;
                    $tax_value_per = ' ('.$tax_value_percentage.'%)';
                } 
            $pdf->SetX(5);
            $pdf->Cell(30,4,'SGST'.$tax_value_per,1,0,'C',0);
            $pdf->SetFont('Arial','B',8.5);
            $pdf->SetX(35);
           
            if(!empty($sgst_value)){
                $pdf->Cell(20,4,number_format($sgst_value,2),1,1,'C',0);
            }
            else{
                $pdf->Cell(20,4,'0.00',1,1,'C',0);
            }
            $pdf->SetX(5);
            $pdf->Cell(30,4,'CGST'.$tax_value_per,1,0,'C',0);
            $pdf->SetFont('Arial','B',8.5);
            $pdf->SetX(35);
            if(!empty($cgst_value)){
                $pdf->Cell(20,4,number_format($cgst_value,2),1,1,'C',0);
            }
            else{
                $pdf->Cell(20,4,'0.00',1,1,'C',0);
            }
        }else if( ($gst_option == 1) && ($from_company_state != $from_party_state)){
                if(!empty($tax_value) && $tax_value != $GLOBALS['null_value']){
                    $tax_value_per = ' ('.$tax_value.'%)';
                } 
            $pdf->SetX(5);
            $pdf->Cell(30,4,'IGST'. $tax_value_per,1,0,'C',0);
            $pdf->SetFont('Arial','B',8.5);
            $pdf->SetX(35);
            if(!empty($igst_value)){
                $pdf->Cell(20,4,number_format($igst_value,2),1,1,'C',0);
            }
            else{
                $pdf->Cell(20,4,'0.00',1,1,'C',0);
            }
        }else{
             $pdf->SetX(5);
            $pdf->Cell(30,4,'GST',1,0,'C',0);
            $pdf->SetFont('Arial','B',8.5);
            $pdf->SetX(35);
            if(!empty($total_tax_amnt)){
                $pdf->Cell(20,4,number_format($total_tax_amnt,2),1,1,'C',0);
            }
            else{
                $pdf->Cell(20,4,'0.00',1,1,'C',0);
            }
        }
    
    $pdf->SetFont('Arial','B',0);
    $pdf->SetX(5);
    $pdf->Cell(30,4,'TOTAL VALUE',1,0,'R',0);
    $pdf->SetFont('Arial','B',9.5);
    $pdf->SetX(35);
    if(!empty($overall_total)){
        if (strpos($overall_total, '.') !== false) {
            $overall_total = number_format($overall_total,2);
        }
    }
    $pdf->Cell(20,4,$overall_total,1,1,'C',0);
    $pdf->SetX(5);
    $pdf->Cell(50,4,'',0,1,'C',0);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(5);
    $pdf->Cell(30,4,'DELIVERY AT',1,0,'R',0);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->SetX(35);
    
    if(!empty($delivery_consignee)){
        $pdf->Cell(65,4,"  ".$delivery_consignee,1,1,'L',0);
    }
    else{
        $pdf->Cell(65,4,'',1,1,'C',0);
    }

    $pdf->SetY($start_y);
    $pdf->SetFont('Arial','B',0);
    $pdf->SetX(60);
    $pdf->Cell(20,4,'LR TYPE',1,0,'C',0);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->SetX(80);
    $pdf->Cell(20,4,$bill_type,1,1,'C',0);
    $pdf->SetX(60);
    $pdf->Cell(50,4,'',0,1,'C',0);
    $pdf->SetFont('Arial','B',0);
    $pdf->SetX(55);
    $pdf->Cell(45,4,'RECEIVED SIGNATURE',1,1,'C',0);
    $pdf->SetX(55);
    $pdf->Cell(45,20,'',1,0,'C',0);

            }
        }
    }
  
    $pdf->OutPut();

?>