<?php
    include("include_files.php");

if(isset($_REQUEST['checkvalidation'])){

  $purchase_entry_date = ""; $purchase_entry_date_error = "";$purchase_bill_date = ""; $purchase_bill_date_error = ""; $purchase_entry_number = ""; $purchase_entry_number_error = "";$party_id = ""; $party_id_error = ""; $gst_option = ""; $gst_option_error = ""; $tax_type = ""; $tax_type_error = "";$tax_option = ""; $tax_option_error = ""; $overall_tax =""; $product_ids = array(); $quantity = array(); $types = array(); $unit_id =array(); $total_qty = array();$rates = array(); $per = array(); $per_type =array(); $final_rate =array(); $product_amount =array(); $brand_error = ""; $product_error = ""; $product_names = array(); $amount =array(); $cgst_value = 0; $sgst_value = 0; $igst_value = 0; $round_off = ""; $sub_total = 0; $total_amount = 0; $total_tax_value = 0; $overall_tax ="";$unit_id = "";$unit_ids = array(); $unit_id =""; $unit_id_error =""; $gst_option ="";  $product_tax =array(); $charges_tax =array(); $terms_and_condition =""; $subunit_need =array();
        $company_state = ""; $party_state = ""; $draft = 0;
        $conversion_id =""; $per_rate =array();$charges_id = array(); $charges_names = array();
        $charges_values = array(); $charges_type = array(); $charges_total = array();  $is_discount =""; $discount_name = "";
        $valid_form = ""; $form_name = "purchase_entry_form"; $edit_id = ""; $discount_value =""; $discounted_total =0;

        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }

        if(isset($_POST['conversion_id'])) {
            $conversion_id = $_POST['conversion_id'];
            $conversion_id = trim($conversion_id);
        }

        $purchase_entry_date = $_POST['purchase_entry_date'];
        $purchase_entry_date = trim($purchase_entry_date);
        $purchase_entry_date_error = $valid->common_validation($purchase_entry_date, 'Entry Date', '1');
        if(!empty($purchase_entry_date_error)) {
            if(!empty($valid_form)) {
                $valid_form = $valid_form." ".$valid->error_display($form_name, 'purchase_entry_date', $purchase_entry_date_error, 'text');
            }
            else {
                $valid_form = $valid->error_display($form_name, 'purchase_entry_date', $purchase_entry_date_error, 'text');
            }
        }

        $purchase_bill_date = $_POST['purchase_bill_date'];
        $purchase_bill_date = trim($purchase_bill_date);
        $purchase_bill_date_error = $valid->common_validation($purchase_bill_date, 'Bill Date', '1');
        if(!empty($purchase_bill_date_error)) {
            if(!empty($valid_form)) {
                $valid_form = $valid_form." ".$valid->error_display($form_name, 'purchase_bill_date', $purchase_bill_date_error, 'text');
            }
            else {
                $valid_form = $valid->error_display($form_name, 'purchase_bill_date', $purchase_bill_date_error, 'text');
            }
        }

        $purchase_entry_number = $_POST['purchase_entry_number'];
        $purchase_entry_number = trim($purchase_entry_number);
        $purchase_entry_number_error = $valid->valid_address($purchase_entry_number, 'Bill Number', '1','25');
        if(empty($purchase_entry_number_error) && strlen($purchase_entry_number) > 25) {
            $purchase_entry_number_error = "Only 25 characters allowed";
        }
        if(!empty($purchase_entry_number_error)) {
            if(!empty($valid_form)) {
                $valid_form = $valid_form." ".$valid->error_display($form_name, 'purchase_entry_number', $purchase_entry_number_error, 'text');
            }
            else {
                $valid_form = $valid->error_display($form_name, 'purchase_entry_number', $purchase_entry_number_error, 'text');
            }
        }
    
        if(isset($_POST['party_id']))
        {
            $party_id = $_POST['party_id'];
            $party_id = trim($party_id);
            if(!empty($party_id)) {
                $party_unique_id = "";
                $party_unique_id = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'id');
                if(!preg_match("/^\d+$/", $party_unique_id)) {
                    $party_id_error = "Invalid Party";
                }
            }
            else
            {
                $party_id_error ="Select the party ";
            }   
        }
        
        if(!empty($party_id_error)) {
            if(!empty($valid_form)) {
                $valid_form = $valid_form." ".$valid->error_display($form_name, 'party_id', $party_id_error, 'select');
            }
            else {
                $valid_form = $valid->error_display($form_name, 'party_id', $party_id_error, 'select');
            }
        }

        if(isset($_POST['gst_option']))
        {
            $gst_option = $_POST['gst_option'];
            $gst_option = trim($gst_option);
            $gst_option_error = $valid->common_validation($gst_option, 'GST option', 'select');
            if(empty($gst_option_error)) {
                if($gst_option != '1' && $gst_option != '2') {
                    $gst_option_error = "Invalid GST option";
                }
            }
        }
        
        if(!empty($gst_option_error)) {
            if(!empty($valid_form)) {
                $valid_form = $valid_form." ".$valid->error_display($form_name, 'gst_option', $gst_option_error, 'text');
            }
            else {
                $valid_form = $valid->error_display($form_name, 'gst_option', $gst_option_error, 'text');
            }
        }

        if($gst_option == '1') {
            $tax_type = $_POST['tax_type'];
            $tax_type = trim($tax_type);
            $tax_type_error = $valid->common_validation($tax_type, 'Tax Type', 'select');
            if(empty($tax_type_error)) {
                if($tax_type != '1' && $tax_type != '2') {
                    $tax_type_error = "Invalid Tax Type";
                }
            }
            if(!empty($tax_type_error)) {
                if(!empty($valid_form)) {
                    $valid_form = $valid_form." ".$valid->error_display($form_name, 'tax_type', $tax_type_error, 'select');
                }
                else {
                    $valid_form = $valid->error_display($form_name, 'tax_type', $tax_type_error, 'select');
                }
            }

            $tax_option = $_POST['tax_option'];
            $tax_option = trim($tax_option);
            $tax_option_error = $valid->common_validation($tax_option, 'Tax Option', 'select');
            if(empty($tax_option_error)) {
                if($tax_option != '1' && $tax_option != '2') {
                    $tax_option_error = "Invalid Tax Option";
                }
            }
            if(!empty($tax_option_error)) {
                if(!empty($valid_form)) {
                    $valid_form = $valid_form." ".$valid->error_display($form_name, 'tax_option', $tax_option_error, 'select');
                }
                else {
                    $valid_form = $valid->error_display($form_name, 'tax_option', $tax_option_error, 'select');
                }
            }

            if($tax_type == '2') {
                if(isset($_POST['overall_tax'])) {
                    $overall_tax = $_POST['overall_tax'];
                    $overall_tax = trim($overall_tax);
                }
            }
        }else{
            $overall_tax = $GLOBALS['null_value']; 
        }

        if(isset($_POST['company_state'])) {
            $company_state = $_POST['company_state'];
            $company_state = trim($company_state);
        }
        if(isset($_POST['party_state'])) {
            $party_state = $_POST['party_state'];
            $party_state = trim($party_state);
        }
       
        if(isset($_POST['product_id'])) {
            $product_ids = $_POST['product_id'];
        }
        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
        }
        if(isset($_POST['total_qty'])) {
            $total_qty = $_POST['total_qty'];
        }
        if(isset($_POST['rate']))
        {
            $rates = $_POST['rate'];
        }
      
        if(isset($_POST['product_tax']))
        {
            $product_tax = $_POST['product_tax'];
        }
        if(isset($_POST['charges_tax']))
        {
            $charges_tax = $_POST['charges_tax'];
        }
        
        if(isset($_POST['unit_id']))
        {
            $unit_ids = $_POST['unit_id'];
        }
        if(isset($_POST['final_rate']))
        {
            $final_rate = $_POST['final_rate'];
        }
      
        $final_rate =array(); $rate_per_unit =array();
        if(!empty($product_ids)) {
            for($i=0; $i < count($product_ids); $i++) {

                $product_ids[$i] = trim($product_ids[$i]);
                $product_unique_id = "";
                $product_unique_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'id');
                if(preg_match("/^\d+$/", $product_unique_id)) {
                    $product_name = "";
                    $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');
                    $product_names[$i] = $product_name;
                    $unit_ids[$i] = trim($unit_ids[$i]);
                    $unit_name = "";
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
                    $unit_names[$i] = $unit_name; 
                    
             
                    $quantity[$i] = trim($quantity[$i]);
                    if(!empty($quantity[$i])) {
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $quantity[$i]) && $quantity[$i] <= 99999) 
                        {
                            $total_qty[$i] = $quantity[$i]; 
                            $rates[$i] = trim($rates[$i]);

                                   
                            if(!empty($rates[$i])) {
                                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $rates[$i]) && $rates[$i] <= 99999) 
                                {  
                                    $final_rate[$i] = $rates[$i];
                                    if($gst_option == '1')
                                    {
                                        if($tax_option == '2')
                                        {
                                            $tax ="";
                                            if($tax_type == '1')
                                            {
                                                $tax= $product_tax[$i];
                                            }
                                            else
                                            {
                                                $tax = $overall_tax;
                                            }
                                            $tax = trim(str_replace("%", "",$tax));
                                            $final_rate[$i] = $final_rate[$i]-($final_rate[$i] * $tax)/($tax + 100);
                                            $final_rate[$i] = round($final_rate[$i], 2);
                                            
                                        }
                                    }
                                    if(!empty($final_rate[$i]))
                                    {
                                        $final_rate[$i] = floor($final_rate[$i] * 100) / 100;
                                        
                                    }
                                    // echo $final_rate[$i];
                                    // if(!empty($final_rate[$i]) && !empty($quantity[$i]))
                                    // {
                                    //     $rate_per_unit[$i] = $final_rate[$i];
                                    //     $product_amount[$i] = $final_rate[$i] * $quantity[$i];
                                    //     $amount[$i] = $product_amount[$i];
                                    // }
                                    // $sub_total += $product_amount[$i];
                                    if(!empty($final_rate[$i]) && !empty($quantity[$i]))
                                    {
                                        $final_rate[$i] = number_format($final_rate[$i],2);
                                        $final_rate[$i] = str_replace(",","",$final_rate[$i]);
                                        // echo $final_rate[$i]." * ".$quantity[$i]."=";
                                        $rate_per_unit[$i] = $final_rate[$i];
                                        $product_amount[$i] = $final_rate[$i] * $quantity[$i];
                                        $amount[$i] = $product_amount[$i];
                                    }
                                    // echo $product_amount[$i]."<br>";
                                    $sub_total += $product_amount[$i];
                                    
                                }
                                else {
                                    $product_error = "Invalid rate in Product - ".($obj->encode_decode('decrypt', $product_name));
                                }
                            }
                            else {
                                $product_error = "Empty Rate in Product - ".($obj->encode_decode('decrypt', $product_name));
                            } 
                        }
                        else {
                            $product_error = "Invalid quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                        }
                    }
                    else {
                        $product_error = "Empty quantity in Product - ".($obj->encode_decode('decrypt', $product_name));
                    }  
                }
                else {
                    $product_error = "Invalid Product";
                }
            }
        }
        else {
            $product_error = "Add Products";
        }

        $total_amount = $sub_total;

        if(empty($product_error) && empty($total_amount)) {
            $product_error = "Bill value cannot be 0";
        }
        if(isset($_POST['charges_id'])) {
            $charges_id = $_POST['charges_id'];
        }
      
        if(isset($_POST['charges_value'])) {
            $charges_values = $_POST['charges_value'];
        }

        $discount_option =""; $discount_option_error ="";  $discount =""; $discount_error ="";  

        if(isset($_POST['discount_name'])) {
            $discount_name = $_POST['discount_name'];
        }
        if(isset($_POST['charges_value'])) {
            $charges_values = $_POST['charges_value'];
        }
        
        if(isset($_POST['discount'])) {
            $discount = $_POST['discount'];
            $discount = trim($discount);
        }
        
        if(!empty($discount) && empty($product_error)) {
            if(empty($discount_name)){
                $product_error = "Enter Discount Name";
            }
            else{
                if(empty($discount)){
                    $product_error = "Enter Discount Value";
                }
                if(strpos($discount, '%') !== false) {
                    $discount_percent = str_replace('%', '', $discount);
                    $discount_percent = trim($discount_percent);
                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $discount_percent) && ($discount_percent > 0) && ($discount_percent < 100)){
                        $discount_value = ($discount_percent * $sub_total) / 100;
                    }
                    else {
                        $product_error = "Invalid Discount";
                    }
                }
                else {
                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $discount) && ($discount > 0) && ($discount <= $sub_total)){
                        $discount_value = $discount;
                    }
                    else {
                        $product_error = "Invalid Discount";
                    }
                }
                if(!empty($discount_value)) {
                    $discount_value = number_format($discount_value, 2);
                    $discount_value = str_replace(",", "", $discount_value);
                    $total_amount = $total_amount - $discount_value;
                }
            } 
                
            
            
        }
        $discounted_total = $total_amount;   
        
        $charges_total_amounts = array();
        if(!empty($charges_id) && empty($product_error)) {
            for($i=0; $i < count($charges_id); $i++) {
                $charges_id[$i] = trim($charges_id[$i]);
                if(!empty($charges_id[$i])) {
                    $charges_name = ""; $charges_value = 0;
                    $charges_name = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $charges_id[$i], 'charges_name');
                    $charges_names[$i] = $charges_name;
                    $charges_values[$i] = trim($charges_values[$i]);
                    if(isset($charges_values[$i])) {
                        $charges_error = "";
                        if(strpos($charges_values[$i], '%') !== false) {
                            $charges_value = str_replace('%', '', $charges_values[$i]);
                            $charges_value = trim($charges_value);
                        }
                        else {
                            $charges_value = $charges_values[$i];
                        }
                        $charges_error = $valid->valid_price($charges_value, ($obj->encode_decode('decrypt', $charges_name)), 1, '');
                        if(!empty($charges_error)) {
                            if(!empty($purchase_entry_error)) {
                                $purchase_entry_error = $purchase_entry_error."<br>".$charges_error;
                            }
                            else {
                                $purchase_entry_error = $charges_error;
                            }
                        }
                        else {
                            if(strpos($charges_values[$i], '%') !== false) {
                                $charges_value = ($charges_value * $total_amount) / 100;
                                $charges_value = number_format($charges_value, 2);
                                $charges_value = str_replace(",", "", $charges_value);
                            }
                        }
                    }
                    if(empty($purchase_entry_error)) {
                        $charges_total[$i] = $charges_value;
                        
                        $total_amount += $charges_value;

                        if($gst_option == '1')
                        {
                            if(!empty($charges_tax[$i])) {
                                $chrg_tax[$i] = str_replace('%', '', $charges_tax[$i]);
                                $charges_tax_value[$i] = ($charges_value * $chrg_tax[$i]) / 100;
                                if(!empty($charges_tax_value[$i])) {
                                    $total_tax_value += $charges_tax_value[$i];
                                    $total_tax_value = round($total_tax_value, 2);
                                }
                            }
                            else
                            {
                                $purchase_entry_error = "Select Charges tax";
                            }
                            
                        }
                        
                    }
                    $charges_total_amounts[] = $total_amount;
                }
                else{
                    if(!empty($charges_values[$i]))
                        {
                            $purchase_entry_error = "Select Charges";
                        }
                        $charges_values[$i] = "";
                }
                if(empty($purchase_entry_error)) {
                    for($j=$i+1; $j < count($charges_id); $j++) {
                        if($charges_id[$i] == $charges_id[$j]) {
                            $purchase_entry_error = "Same Charges Repeatedly Exists";
                            break;
                        }
                    }
                }
            }
        }


        if($gst_option == '1' && empty($product_error) && empty($valid_form)) {
            $percentage = 100;
            if($tax_type == '1')
            {
                if(!empty($discount))
                {
                    if (strpos($discount, '%') !== false) {
                        $final_discount = str_replace("%",'',$discount);
                    }
                    else
                    {
                        $final_discount = ($discount/$sub_total) * 100;
                    }
                    
                }

                for ($a = 0; $a < count($product_ids); $a++) {
                    $indv_discount = 0;
                    if(!empty($final_discount))
                    {
                        // echo $final_rate[$a].'hlo'.$final_discount.'hlohlo   ';
                        $indv_discount = ($final_rate[$a] * $final_discount) / 100;
                        // $indv_discount = round($indv_discount, 2);
                        $prd_rate[$a] = $final_rate[$a]- $indv_discount;
                        // $prd_rate[$a] = number_format($prd_rate[$a],2);
                        // echo $prd_rate[$a].'hello'.$quantity[$a]."<br>";
                        $prd_amount[$a] = $prd_rate[$a]*$quantity[$a];
                    }
                    else
                    {
                        $prd_amount[$a] = $final_rate[$a]*$quantity[$a];
                    }
                    // echo $prd_amount[$a].'test';
                    $prd_amount[$a] = number_format($prd_amount[$a], 2, '.', '');
                    $tax = trim(str_replace("%", "",$product_tax[$a]));
                    if ($product_tax[$a] != '' && $tax != '%') {
                        // echo $prd_amount[$a].'string'.$tax.' hlo';
                        $tax_plus_value = ($prd_amount[$a] * $tax) / 100;
                        $tax_plus_value = round($tax_plus_value, 2);
                        // echo $tax_plus_value.'hai';
                        $total_tax_value += $tax_plus_value;
                        
                        $total_tax_amount = $total_tax_value;
                    } else {
                        $tax_error = "Select tax";
                    }
                    if (!empty($tax_error)) {
                        if (!empty($purchase_entry_error)) {
                            $purchase_entry_error = $purchase_entry_error . "<br>" . $tax_error;
                        } else {
                            $purchase_entry_error = $tax_error;
                        }
                    }
                }
            }
            elseif($tax_type == '2') {
                $tax = "";
                $tax = str_replace("%", "", $overall_tax);
                $tax = trim($tax);
                if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $tax)) {
                    $total_tax_value = ($tax * $total_amount) / $percentage;
                }
                else {
                    $product_error = "Invalid Overall tax";
                }
            }
            if(!empty($total_tax_value)) {
                $total_tax_value = number_format($total_tax_value, 2);
                $total_tax_value = str_replace(",", "", $total_tax_value);
                if($company_state == $party_state) {
                    $cgst_value = $total_tax_value / 2;
                    $cgst_value = number_format($cgst_value, 2);
                    $cgst_value = str_replace(",", "", $cgst_value);
                    $sgst_value = $total_tax_value / 2;
                    $sgst_value = number_format($sgst_value, 2);
                    $sgst_value = str_replace(",", "", $sgst_value);
                }
                else {
                    $igst_value = $total_tax_value;
                    $igst_value = number_format($igst_value, 2);
                    $igst_value = str_replace(",", "", $igst_value);
                }
                $total_amount = $total_amount + $total_tax_value;
            }
        }

        // echo "<br>".$total_tax_value."iorioe";
     
        $round_off =0;  $round_off_type =""; $round_off_value ="";
        if(!empty($total_amount)) {	
            // echo $_POST['round_off'];
            if(isset($_POST['round_off']))
            {
                $round_off = $_POST['round_off'];
            }
            else
            {
                $round_off ="2";
            }
            if(isset($_POST['round_off_type']))
            {
                $round_off_type = $_POST['round_off_type'];
            }
            if(isset($_POST['round_off_value']))
            {
                $round_off_value = $_POST['round_off_value'];
            }
            if($round_off == '2')
            {
                
                /*  25062025 changed lines */

                        // if($round_off_value < 10) {
                        //     $round_off_value = ".0".$round_off_value;
                        // }
                        // else {
                        if(!empty($round_off_value)){
                            $round_off_value = "0.".$round_off_value;
                        }
                        // }

                        // echo $round_off_value."hai";
                        if($round_off_type == '1')
                        {
                            // $round_off_value = ".".$round_off_value;
                            $total_amount = $total_amount+$round_off_value;
                            // echo $total_amount;
                        }
                        else if($round_off_type == '2')
                        {
                            // $round_off_value = ".".$round_off_value;
                            $total_amount = $total_amount-$round_off_value;
                        }
                    /*  ---  */
            }
            else
            {
                
                if(!empty($total_amount)) {	
                    if (strpos( $total_amount, "." ) !== false) {
                        $pos = strpos($total_amount, ".");
                        $decimal = substr($total_amount, ($pos + 1), strlen($total_amount));
                        if($decimal != "00") {
                            if(strlen($decimal) == 1) {
                                $decimal = $decimal."0";
                            }
                            if($decimal >= 50) {				
                                $rnd_off = 100 - $decimal;
                                if($rnd_off < 10) {
                                    $rnd_off = "0.0".$rnd_off;
                                }
                                else {
                                    $rnd_off = "0.".$rnd_off;
                                }
                                $round_off_type = 1;
                                $round_off_value = $rnd_off;
                                $total_amount = $total_amount + $rnd_off;
                            }
                            else {
                                $decimal = "0.".$decimal;
                                $rnd_off = "-".$decimal;
                                $round_off_type = 2;
                                $round_off_value = $decimal;
                                $total_amount = $total_amount - $decimal;
                            }
                        }
                    }
                }
            }
        }

        $grand_total = $total_amount;
        // echo $grand_total;
        $result = "";

        
        for($i=0;$i<count($product_ids);$i++)
        {
            for($j=$i+1;$j<count($product_ids);$j++)
            {
				if(!empty($product_ids[$i]) && !empty($product_ids[$j])) {
					if($product_ids[$i] == $product_ids[$j])
					{
                        $product = ""; $brand = "";
						$product = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$j],'product_name');
						
						if(!empty($product))
						{
							$product = $obj->encode_decode("decrypt",$product);
						}
                        
                        $product_error ="Product :".$product."&nbsp;&nbsp;  >   &nbsp;&nbsp; already exist";
					}
				}
            }
        }

      $result = "";
        if(empty($valid_form) && empty($product_error)) {
            $result = array('number' => '1', 'msg' => 'Purchase Entry Successfully Created','redirection_page' =>'purchase_entry.php','purchase_entry_id' => '');
        }         
        else{
            if(!empty($valid_form)) {
                $result = array('number' => '3', 'msg' => $valid_form);            
            }else if(!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);            
            }
        }
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;   
        
    }

if(isset($_REQUEST['payment_row_index'])) {
    $payment_row_index = $_REQUEST['payment_row_index'];

    $payment_mode_id = $_REQUEST['selected_payment_mode_id'];
    $payment_mode_id = trim($payment_mode_id);

    $bank_id = $_REQUEST['selected_bank_id'];
    $bank_id = trim($bank_id);

    $amount = $_REQUEST['selected_amount'];
    $amount = trim($amount);
    $payment_tax_type = $_REQUEST['payment_tax_type'];
    $payment_tax_type = trim($payment_tax_type);
    ?>
    <tr class="payment_row" id="payment_row<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>">
        <td class="payment_sno text-center">
            <?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>
        </td>
           <?php if(!empty($payment_tax_type)) { ?>
                <td>
                <?php 
                  
                    if(!empty($payment_tax_type)) {
                            if($payment_tax_type == 1) {
                                echo "With Tax"; 
                            } else {
                                echo "Without Tax";
                            } 
                    }  ?>
                    <input type="hidden" name="payment_tax_type[]" value="<?php if(!empty($payment_tax_type)) { echo $payment_tax_type; } ?>">
                </td>
        <?php } ?>
        <td class="text-center">
            <?php
                $payment_mode_name = "";
                $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_id, 'payment_mode_name');
                echo $obj->encode_decode('decrypt', $payment_mode_name);
            ?>
            <input type="hidden" name="payment_mode_id[]" value="<?php if(!empty($payment_mode_id)) { echo $payment_mode_id; } ?>">
        </td>
        <td class="text-center">
            <?php
                $bank_name = "";
                $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id, 'bank_name');
                if(!empty($bank_name) && $bank_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $bank_name);
                }
                else {
                    echo '-';
                }   
            ?>
            <input type="hidden" name="bank_id[]" value="<?php if(!empty($bank_id)) { echo $bank_id; } ?>">
        </td>
        <td class="text-center">
            <input type="text" name="voucher_amount[]" style="width:75%!important;margin:auto!important;" class="form-control shadow-none px-1 text-center" value="<?php if(!empty($amount)) { echo $amount; } ?>" onfocus="Javascript:KeyboardControls(this,'number','','');" onkeyup="Javascript:PaymentVoucherTotal();InputBoxColor(this, 'text');">
        </td>
        
        <td class="text-center">
            <button class="btn btn-danger" type="button" onclick="Javascript:DeleteVoucherRow('payment_row', '<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>');"><i class="fa fa-trash"></i></button>
        </td>
    </tr>
    <?php
}
?>