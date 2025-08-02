<?php
	include("include_files.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['purchase_entry_module'];
        }
    }

	if(isset($_REQUEST['show_purchase_entry_id'])) {
        $show_purchase_entry_id = $_REQUEST['show_purchase_entry_id'];
        $show_purchase_entry_id = trim($show_purchase_entry_id);

         $voucher_date = date("Y-m-d"); 
        $payment_mode_list = array(); 
		// $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], '','',''); 
		$payment_mode_list = $obj->BankLinkedPaymentModes();


        $purchase_entry_date = date('Y-m-d');$purchase_bill_date = date('Y-m-d'); $current_date = date('Y-m-d');$purchase_entry_number = "";$gst_option = 0; $tax_type = 0; $tax_option = 0; $overall_tax = "";$purchase_godown_ids = ""; $godown_type =""; $indv_godown_id =array(); $overall_godown_id =""; $vechicle_details =""; $subunit_need =array(); $discount_option =""; $discount =""; $discount_value=""; $charges_tax =array(); $charges_value=""; $amount =array(); $round_off =""; $round_off_type =""; $round_off_value =""; $subunit_needs =array();
        $godown_ids = array(); $product_ids = array(); $product_names = array();$cases = array();$piece_per_cases = array();$rate_per_piece = array();$rate_per_cases = array(); $product_amount = array();$discount = ""; $discount_value = "";$extra_charges = ""; $extra_charges_value = "";$hsn_codes=array(); $total_amount = ""; $is_discount ="";
        $purchase_entry_list = array();$purchase_godown_ids =""; $purchase_godown_names = "";$purchase_entry_id =""; $selected_rate =""; $selected_per =""; $per_type =array(); $unit_ids =array(); $unit_names=array(); $charges_id = array(); $charges_type = array(); $charges_value = array();  $product_tax =array(); $draft =0; $discount_name = ""; $payment_updation = 0;
        $charges_tax_array = array(); $terms_and_condition =""; $purchase_order_id ="";$round_off_type  =""; $voucher_data = array();

        $purchase_entry_list = $obj->getTableRecords($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $show_purchase_entry_id, '');   
        $voucher_data = $obj->getTableRecords($GLOBALS['voucher_table'], 'purchase_entry_id', $show_purchase_entry_id, '');
        if(!empty($purchase_entry_list)) {
            foreach($purchase_entry_list as $data) {
                if(!empty($data['purchase_entry_date'])) {
                    $purchase_entry_date = date('Y-m-d', strtotime($data['purchase_entry_date']));
                }
                if(!empty($data['purchase_bill_date'])) {
                    $purchase_bill_date = date('Y-m-d', strtotime($data['purchase_bill_date']));
                }
                if(!empty($data['purchase_entry_number']) && $data['purchase_entry_number'] != $GLOBALS['null_value']) {
                    $purchase_entry_number = $data['purchase_entry_number'];
                }
                if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                    $party_id = $data['party_id'];
                }
                if(!empty($data['gst_option']) && $data['gst_option'] != $GLOBALS['null_value']) {
                    $gst_option = $data['gst_option'];
                }
                if(!empty($data['tax_type']) && $data['tax_type'] != $GLOBALS['null_value']) {
                    $tax_type = $data['tax_type'];
                }
                if(!empty($data['payment_updation'])) {
                    $payment_updation = $data['payment_updation'];
                }   
                if(!empty($data['tax_option']) && $data['tax_option'] != $GLOBALS['null_value']) {
                    $tax_option = $data['tax_option'];
                }
                if(!empty($data['company_state']) && $data['company_state'] != $GLOBALS['null_value']) {
                    $company_state = $data['company_state'];
                }
                if(!empty($data['party_state']) && $data['party_state'] != $GLOBALS['null_value']) {
                    $party_state = $data['party_state'];
                }
         
                
                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                    $product_ids = $data['product_id'];
                    $product_ids = explode(",", $product_ids);
                    $product_count = count($product_ids);
                    $product_ids = array_reverse($product_ids);
                }
                if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                    $product_names = $data['product_name'];
                    $product_names = explode(",", $product_names);
                    $product_names = array_reverse($product_names);
                }
                if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                    $unit_ids = $data['unit_id'];
                    $unit_ids = explode(",", $unit_ids);
                    $unit_ids = array_reverse($unit_ids);
                }
                if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                    $unit_names = $data['unit_name'];
                    $unit_names = explode(",", $unit_names);
                    $unit_names = array_reverse($unit_names);
                }
               
                if(!empty($data['amount']) && $data['amount'] != $GLOBALS['null_value']) {
                    $amount = $data['amount'];
                    $amount = explode(",", $amount);
                    $amount = array_reverse($amount);
                }
                if(!empty($data['discount']) && $data['discount'] != $GLOBALS['null_value']) {
                    $discount = $data['discount'];
                }
                if(!empty($data['discount_value']) && $data['discount_value'] != $GLOBALS['null_value']) {
                    $discount_value = $data['discount_value'];
                }
                if(!empty($data['extra_charges']) && $data['extra_charges'] != $GLOBALS['null_value']) {
                    $extra_charges = $data['extra_charges'];
                }
                if(!empty($data['extra_charges_value']) && $data['extra_charges_value'] != $GLOBALS['null_value']) {
                    $extra_charges_value = $data['extra_charges_value'];
                }
                if(!empty($data['round_off']) && $data['round_off'] != $GLOBALS['null_value']) {
                    $round_off = $data['round_off'];
                }
                if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                    $total_amount = $data['total_amount'];
                }
                if(!empty($data['purchase_entry_id']) && $data['purchase_entry_id'] != $GLOBALS['null_value']) {
                    $purchase_entry_id = $data['purchase_entry_id'];
                }
                if(!empty($data['total_qty']) && $data['total_qty'] != $GLOBALS['null_value']) {
                    $total_qty = $data['total_qty'];
                    $total_qty = explode(",", $total_qty);
                    $total_qty = array_reverse($total_qty);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity = $data['quantity'];
                    $quantity = explode(",", $quantity);
                    $quantity = array_reverse($quantity);
                }
                if(!empty($data['charges_tax']) && $data['charges_tax'] != $GLOBALS['null_value']) {
                    $charges_tax = $data['charges_tax'];
                    $charges_tax = explode(",", $charges_tax);
                    $charges_tax = array_reverse($charges_tax);
                }
                if(!empty($data['rate']) && $data['rate'] != $GLOBALS['null_value']) {
                    $rates = $data['rate'];
                    $rates = explode(",", $rates);
                    $rates = array_reverse($rates);
                }
              
                if(!empty($data['final_rate']) && $data['final_rate'] != $GLOBALS['null_value']) {
                    $final_rate = $data['final_rate'];
                    $final_rate = explode(",", $final_rate);
                    $final_rate = array_reverse($final_rate);
                }
                if(!empty($data['product_amount']) && $data['product_amount'] != $GLOBALS['null_value']) {
                    $product_amount = $data['product_amount'];
                    $product_amount = explode(",", $product_amount);
                    $product_amount = array_reverse($product_amount);
                }
                if(!empty($data['product_tax']) && $data['product_tax'] != $GLOBALS['null_value']) {
                    $product_tax = $data['product_tax'];
                    $product_tax = explode(",", $product_tax);
                    $product_tax = array_reverse($product_tax);
                }
                if(!empty($data['discount_name']) && $data['discount_name'] != $GLOBALS['null_value']) {
                    $discount_name = $data['discount_name'];
                    $discount_name = $obj->encode_decode('decrypt', $discount_name);
                }
                if(!empty($data['discount']) && $data['discount'] != $GLOBALS['null_value']) {
                    $discount = $data['discount'];
                }
                if(!empty($data['charges_id']) && $data['charges_id'] != $GLOBALS['null_value']) {
                    $charges_id = $data['charges_id'];
                    $charges_id = explode(",", $charges_id);
                    $charges_count = count($charges_id);
                }
                if(!empty($data['charges_type']) && $data['charges_type'] != $GLOBALS['null_value']) {
                    $charges_type = $data['charges_type'];
                    $charges_type = explode(",", $charges_type);
                }
                if(!empty($data['charges_value']) && $data['charges_value'] != $GLOBALS['null_value']) {
                    $charges_value = $data['charges_value'];
                    $charges_value = explode(",", $charges_value);
                }
                if(!empty($data['overall_tax']) && $data['overall_tax'] != $GLOBALS['null_value'])
                {
                    $overall_tax =$data['overall_tax'];
                }
                if(!empty($data['round_off']))
                {
                    $round_off  = $data['round_off'];
                }
                if(!empty($data['round_off_type']))
                {
                    $round_off_type  = $data['round_off_type'];
                }
                if(!empty($data['round_off_value']))
                {
                    $round_off_value  = $data['round_off_value'];
                    $round_off_value = str_replace(".","",$round_off_value);
                }
                if($tax_type == '1')
                {
                    for($i=0;$i<count($product_tax);$i++)
                    {
                        $charges_tax_array[$i] = $product_tax[$i];
                    }
                }
                else
                {
                    for($i=0;$i<count($product_ids);$i++)
                    {
                        $charges_tax_array[]= $overall_tax;
                    }
                }
            }
        }
        $charges_tax_array = array_unique($charges_tax_array);
        
		$company_state = "";$country = "India"; $state = "";
		$company_state = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $GLOBALS['bill_company_id'], 'state');
        if(!empty($company_state)) {
			$company_state = $obj->encode_decode('decrypt', $company_state);
		}
        
        $party_list = array();
        $party_list = $obj->getTableRecords($GLOBALS['party_table'], 'party_type', '1');

        $unit_list = array();
        $unit_list = $obj->getTableRecords($GLOBALS['unit_table'], 'bill_company_id', $GLOBALS['bill_company_id']);

        $charges_list = array();
        $charges_list = $obj->getTableRecords($GLOBALS['charges_table'], 'bill_company_id', $GLOBALS['bill_company_id']);

        $product_list = array();
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'bill_company_id', $GLOBALS['bill_company_id']);

             $payment_mode_ids_edit = array();$payment_bank_id = array(); $edit_payment_amount = array();$voucher_id="";$payment_mode_name = array();$bank_name = array();$payment_amount = array();$payment_total_amount = ""; $payment_tax_type = array(); $voucher_count =0;
        if(!empty($voucher_data)){
            foreach($voucher_data as $data) {
                if(!empty($data['payment_mode_id'])) {
                    $payment_mode_ids_edit = $data['payment_mode_id'];
                    $payment_mode_ids_edit = explode(",", $payment_mode_ids_edit);
                    $payment_mode_ids_edit = array_reverse($payment_mode_ids_edit);   
                    
                }
                if(!empty($data['payment_tax_type'])) {
                    $payment_tax_type = $data['payment_tax_type'];
                    $payment_tax_type = explode(",", $payment_tax_type);
                    $payment_tax_type = array_reverse($payment_tax_type);
                }
                if(!empty($data['bank_id'])) {
                    $payment_bank_id = $data['bank_id'];
                    $payment_bank_id = explode(",", $payment_bank_id);
                    $payment_bank_id = array_reverse($payment_bank_id);
                }
                if(!empty($data['amount'])) {
                    $edit_payment_amount = $data['amount'];
                    $edit_payment_amount = explode(",", $edit_payment_amount);
                    $edit_payment_amount = array_reverse($edit_payment_amount);
                }
                if(!empty($data['voucher_id'])) {
                    $voucher_id = $data['voucher_id'];
                }
                if(!empty($data['payment_mode_name'])) {
                    $payment_mode_name = $data['payment_mode_name'];
                    $payment_mode_name = explode(",", $payment_mode_name);
                    $payment_mode_name = array_reverse($payment_mode_name);
                    $voucher_count = count($payment_mode_name);                                                         
                    
                }
                if(!empty($data['bank_name'])) {
                    $bank_name = $data['bank_name'];
                    $bank_name = explode(",", $bank_name);
                    $bank_name = array_reverse($bank_name);
                }
                if(!empty($data['amount'])) {
                    $payment_amount = $data['amount'];
                    $payment_amount = explode(",", $payment_amount);
                    $payment_amount = array_reverse($payment_amount);
                }            
                if(!empty($data['total_amount'])) {
                    $payment_total_amount = $data['total_amount'];
                }    
                  
            }
        }

        ?>
        <form class="poppins pd-20 redirection_form" name="purchase_entry_form" method="POST">
            <input type="hidden" name="edit_id" value="<?php if(!empty($show_purchase_entry_id)) { echo $show_purchase_entry_id; } ?>">
            <input type="hidden" name="payment_updation" value="<?php if(!empty($payment_updation)) { echo $payment_updation; } ?>" id="PaymentUpdation">

           
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
                        <?php if(!empty($show_purchase_entry_id)) {  ?>
						    <div class="text-white">Edit Purchase Entry</div>
                            <?php
                        }else{ ?>
						    <div class="text-white">Add Purchase Entry</div>
                        <?php

                        } ?>

					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-right" style="font-size:11px;" type="button" onclick="window.open('purchase_entry.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row p-3">
                <div class="col-lg-2 col-md-3 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="purchase_entry_date" class="form-control shadow-none" placeholder="" required="" value="<?php if(!empty($purchase_entry_date)) { echo $purchase_entry_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                            <label>Entry Date<span class="text-danger">*</span></label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-2 col-md-3 col-12 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" name="purchase_bill_date" class="form-control shadow-none" placeholder="" required="" value="<?php if(!empty($purchase_bill_date)) { echo $purchase_bill_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                            <label style="font-size:12px;">Purchase Bill Date<span class="text-danger">*</span></label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-2 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="purchase_entry_number" name="purchase_entry_number" class="form-control shadow-none" required value="<?php if(!empty($purchase_entry_number)) { echo $purchase_entry_number; } ?>">
                            <label>Bill No <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12 py-2 px-lg-1 party_div">
                    <div class="form-group">
                        <div class="form-label-group in-border chargesaction">
                            <div class="input-group">
                                <select class="select2 select2-danger" name="party_id" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:getPartyState(this.value);Javascript:HideDetails('party');">
                                    <option value="">Select</option>
                                    <?php
                                        if(!empty($party_list)) {
                                            foreach ($party_list as $data) {
                                                if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                    <option value="<?php echo $data['party_id']; ?>" <?php if(!empty($party_id) && $party_id == $data['party_id']) { ?>selected<?php } ?>>
                                                        <?php
                                                            if(!empty($data['name_mobile_city']) && $data['name_mobile_city'] != $GLOBALS['null_value']) {
                                                                echo $obj->encode_decode('decrypt', $data['name_mobile_city']);
                                                            }
                                                        ?>
                                                    </option>
                                                <?php
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <label>Party <span class="text-danger">*</span></label>
                                <div class="input-group-append">
                                    <span class="input-group-text add_category_button" style="background-color:#f06548!important; cursor:pointer; height:100%;" onClick="Javascript:CustomPartyModal(this);" ><i class="fa fa-plus text-white"></i></span>
                                </div>
                            </div>
                            <a href="Javascript:ViewPartyDetails('party');" class="<?php if(empty($show_purchase_entry_id)){?>d-none<?php }?> details_element" style="font-size: 12px;font-weight: bold;">Click to view details</a>
                        </div>
                    </div>      
                </div>
                    
                <div class="col-lg-3 col-md-3 col-sm-6 col-12 px-lg-1 py-2">
                    <div class="form-check form-switch d-flex align-items-center gap-2 mb-1">
                        <label for="gst_option" class="form-check-label text-muted smallfnt mb-0">GST / Non-GST</label>
                        <input class="form-check-input" type="checkbox" id="gst_option" name="gst_option"
                            onChange="Javascript:ShowGST(this,this.value);"
                            value="<?php echo $gst_option; ?>"
                            <?php if ($gst_option == '1') echo 'checked'; ?>>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6 py-2 tax_cover <?php if($gst_option !='1'){?>d-none<?php } ?>">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" name="tax_type" style="width: 100%;" onchange="Javascript:ShowGST(this,this.value);changeChargesTax();">
                                <option value="">Select</option>
                                <option value="1" <?php if($tax_type == '1'){ ?>selected<?php } ?>>Product</option>
                                <option value="2" <?php if($tax_type == '2'){ ?>selected<?php } ?>>Overall</option>
                            </select>
                            <label>Tax Type</label>
                        </div>
                    </div> 
                </div> 
                <div class="col-lg-2 col-md-3 col-12 py-2 <?php if($gst_option !='1'){?>d-none<?php } ?> tax_cover1" id="tax_option_div">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="tax_option" data-dropdown-css-class="select2-danger" style="width: 100%!important;" onchange="Javascript:getRateByTaxOption();" onchange="Javascript:ShowGST(this,this.value);">
                                <option value="">Select</option>
                                <option value="1" <?php if($tax_option == '1'){ ?>selected<?php } ?>>Exclusive Tax</option>
                                <option value="2" <?php if($tax_option == '2'){ ?>selected<?php } ?>>Inclusive Tax</option>
                            </select>
                            <label>Tax Option <span class="text-danger">*</span></label>
                        </div>
                    </div>  
                </div>  
                <div class="col-lg-2 col-md-3 col-6 py-2 <?php if($tax_type !='2'){ ?>d-none <?php } ?> tax_cover2">
                    <div class="form-group">
                        <div class="form-label-group in-border mb-0">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" name="overall_tax" style="width: 100%;" onchange="Javascript:ShowGST(this,this.value);getRateByTaxOption();">
                                <option value="">Select</option>
                                <option value="0%" <?php if($overall_tax == '0%'){ ?>selected<?php } ?>>0%</option>
                                <option value="5%" <?php if($overall_tax == '5%'){ ?>selected<?php } ?>>5%</option>
                                <option value="12%" <?php if($overall_tax == '12%'){ ?>selected<?php } ?>>12%</option>
                                <option value="18%" <?php if($overall_tax == '18%'){ ?>selected<?php } ?>>18%</option>
                                <option value="28%" <?php if($overall_tax == '28%'){ ?>selected<?php } ?>>28%</option>
                            </select>
                            <label>Tax</label>
                        </div>
                    </div> 
                </div>           
            </div>
            <div class="row justify-content-center p-2">
                <div class="col-lg-3 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border chargesaction">
                            <div class="input-group">
                                <select class="select2 select2-danger" name="selected_product_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getUnit(this.value);">
                                    <option value="">Select</option>
                                    <?php
                                        if(!empty($product_list)) {
                                            foreach ($product_list as $data) {
                                                if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                                                    ?>          
                                                    <option value="<?php echo $data['product_id']; ?>" <?php if(!empty($product_ids) && $product_ids == $data['product_id']) { ?>selected<?php } ?>>
                                                        <?php
                                                            if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                                                                echo $obj->encode_decode('decrypt', $data['product_name']);
                                                            }
                                                        ?>
                                                    </option>
                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <label>Product</label>
                                <div class="input-group-append">
                                    <span class="input-group-text add_category_button" style="background-color:#f06548!important; cursor:pointer; height:100%;" onClick="Javascript:CustomProductModal(this);" ><i class="fa fa-plus text-white"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
                <div class="col-lg-2 col-md-3 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="selected_unit_id"  id="selected_unit_id" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange=javascript:getTotalQuantity();getPurchaseRate();>
                                <option value="">Select</option>
                                <?php 
                                    if(!empty($unit_list)) {
                                        foreach($unit_list as $data) { ?>
                                            <option value="<?php if(!empty($data['unit_id'])) { echo $data['unit_id']; } ?>" <?php if(!empty($unit_id) && $data['unit_id'] == $unit_id) { ?> selected <?php } ?> >
                                                <?php
                                                    if(!empty($data['unit_name'])) {
                                                        $data['unit_name'] = $obj->encode_decode('decrypt', $data['unit_name']);
                                                        echo $data['unit_name'];
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    } ?>
                            </select>
                            <label>Unit</label>
                        </div>
                    </div>     
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="selected_quantity" onkeyup="javascript:getTotalQuantity();" class="form-control shadow-none" required="">
                            <label>QTY</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="selected_rate" class="form-control shadow-none" onkeyup="javascript:getTotalQuantity();" required="">
                            <label>Rate</label>
                        </div>
                    </div> 
                </div>   
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="number" name="selected_amount" id="selected_amount" class="form-control shadow-none" required="" readonly>
                            <label>Amount</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-2 col-4 py-2 px-lg-1 text-center">
                    <button class="btn btn-danger add_products_button w-100" style="font-size:12px;" type="button" onclick="Javascript:AddDetails();">
                        Add
                    </button>
                </div> 
            </div>                   
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <input type="hidden" name="company_state" value="<?php if(!empty($company_state)) { echo $company_state; } ?>">
                        <input type="hidden" name="party_state" value="<?php if(!empty($party_state)) { echo $party_state; } ?>">
                        <input type="hidden" name="product_count" value="<?php if(!empty($product_count)) { echo $product_count; } else { echo '0'; } ?>">
                        <table class="table nowrap cursor text-center table-bordered smallfnt w-100 purchase_entry_table">
                            <thead class="bg-secondary text-white">
                                <tr style="white-space:pre;">
                                    <th style="width: 20px;">#</th>
                                    <th style="width: 250px;">Product</th>
                                    <th style="width: 250px;">Unit</th>
                                    <th style="width: 80px;">QTY</th>
                                    <th style="width: 90px;">Rate</th>
                                    <th style="width: 10%;" class="<?php if($tax_type != '1'){ ?>d-none <?php }?> tax_element">Tax</th>
                                    <th style="width: 100px;">Amount</th>
                                    <th style="width: 70px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                if(!empty($product_ids)) {
                                    for($i=0; $i < count($product_ids); $i++) {    
                                        ?>
                                        <tr class="product_row" id="product_row<?php if(!empty($product_count)) { echo $product_count; } ?>">
                                            <th class="text-center px-2 py-2 sno"><?php if(!empty($product_count)) { echo $product_count; } ?></th>
                                            <th class="text-center px-2 py-2">
                                                <?php
                                                    if(!empty($product_ids[$i])) {
                                                        $product_name = "";
                                                        $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_ids[$i], 'product_name');
                                                        if(!empty($product_name) && $product_name != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $product_name);
                                                        }
                                                    }
                                                ?>
                                                <input type="hidden" name="product_id[]" value="<?php if(!empty($product_ids[$i])) { echo $product_ids[$i]; } ?>"><br>
                                            
                                            </th>
                                            <th class="text-center px-2 py-2">
                                            <?php 
                                            $unit_ids[$i] = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'unit_id');
                                            $unit_names[$i] = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_ids[$i],'unit_name');

                                            if(!empty($unit_names[$i]) && $unit_names[$i] !='NULL')
                                            {
                                                echo $unit_names[$i] = $obj->encode_decode("decrypt",$unit_names[$i]);
                                            }
                                            ?>
                                            <input type="hidden" name="unit_id[]" class="form-control shadow-none" value="<?php if(!empty($unit_ids[$i])) { echo $unit_ids[$i]; } ?>">
                                            <input type="hidden" name="unit_name[]" class="form-control shadow-none" value="<?php if(!empty($unit_names[$i])) { echo $unit_names[$i]; } ?>" >
                                                
                                            </th>
                                            <th class="text-center px-2 py-2">
                                                <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($quantity[$i])) { echo $quantity[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
                                            </th>
                                            
                                            <td>
                                                <div class="form-group mb-1">
                                                    <div class="form-label-group in-border">
                                                        <input type="text" id="name" name="rate[]" onkeyup="ProductRowCheck(this);" class="form-control shadow-none" style="width:65px;" value="<?php if(!empty($rates[$i])){ echo $rates[$i]; }?>" required>
                                                        <p class="tax_element text-success final_rate inclusiv_final_rate fw-bold"><?php if(!empty($final_rate[$i])){ echo "Final Rate : ".$final_rate[$i]; } ?></p>
                                                        <input type="hidden" name="final_rate[]" class="form-control shadow-none" value="<?php if(!empty($rates[$i])) { echo $rates[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" >
                                                    </div>
                                                </div> 
                                            </td>
                                            
                                            <td class="tax_element <?php if($tax_option != '1'){ ?> d-none  <?php }?>">
                                                <div class="form-group">
                                                    <div class="form-label-group in-border mb-0">
                                                        <select class="select2 select2-danger" name="product_tax[]" data-dropdown-css-class="select2-danger" style="width: 100%;"  onchange="ProductRowCheck(this);ShowGST();">
                                                            <option value="">Select</option>
                                                            <option value="0%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '0%'){ ?>selected<?php } } ?>>0%</option>
                                                            <option value="5%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '5%'){ ?>selected<?php } } ?>>5%</option>
                                                            <option value="12%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '12%'){ ?>selected<?php } } ?>>12%</option>
                                                            <option value="18%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '18%'){ ?>selected<?php } } ?>>18%</option>
                                                            <option value="28%" <?php if(isset($product_tax[$i])){ if($product_tax[$i] == '28%'){ ?>selected<?php } } ?>>28%</option>
                                                        </select>
                                                        <label>Tax</label>
                                                    </div>
                                                </div> 
                                            </td>
                                           
                                            <td>
                                                <p class="amount"><?php if(!empty($amount[$i])){ echo number_format($amount[$i],2); } ?></p>
                                                <input type="hidden" id="amount[]" name="amount[]" value="<?php if(!empty($amount[$i])){ echo $amount[$i]; }?>" class="form-control shadow-none">
                                            </td>
                                            <td class="text-center px-2 py-2">
                                               
                                                <button class="btn btn-danger" type="button" onclick="Javascript:DeletePurchaseRow('<?php if(!empty($product_count)) { echo $product_count; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
                                                    
                                            </td>
                                        </tr>
                                        <?php
                                        $product_count --;
                                    }
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right h6 subtotal_amount"> Total : </td>
                                    <td colspan="1" class="text-right h6 sub_total"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
             <div class="col-lg-5 border-end fw-bold p-3" style="border: 1px solid #dee2e6;">
                </div>
                <div class="col-lg-6 fw-bold p-3 " style="border: 1px solid #dee2e6;">
                    <div class="ps-lg-2 pl-4 pe-4 pt-3 pb-3" >
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-2">
                                <div class="form-group">
                                    <div class="form-label-group in-border">
                                        <input type="text" name="discount_name" class="form-control"
                                            value="<?php if (!empty($discount_name)) echo $discount_name; ?>" 
                                            placeholder="Discount Name">
                                        <label class="f-10">Enter Discount</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 mb-2">
                                <div class="form-group">
                                    <div class="form-label-group in-border">
                                        <input type="text" id="discount" name="discount" onkeyup="Javascript:checkDiscount();" 
                                            class="form-control shadow-none" 
                                            value="<?php if (!empty($discount)) echo $discount; ?>" 
                                            placeholder="Rupees / %" required>
                                        <label class="f-10">Rs / %</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 mb-2 d-flex align-items-center justify-content-end">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-currency-rupee me-1"></i>
                                    <p class="mb-0 discount_value"></p>
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="d-flex justify-content-between align-items-center border-top pt-2">
                                    <div class="font-weight-bold">Total Amount</div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-currency-rupee me-1"></i>
                                        <p class="mb-0 discounted_total"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                         <?php
                            if(!empty($charges_id) && !empty($show_purchase_entry_id)) {
                                for($i=0; $i < count($charges_id); $i++) {
                                    ?>
                                    <div class="row charges_row border-top my-2 div_charges">
                                        <div class="col-4 col-lg-4 pt-2">
                                            <div class="form-group">
                                                <div class="form-label-group in-border">
                                                    <select class="select2 select2-danger" name="charges_id[]"  data-dropdown-css-class="select2-danger" style="width: 100%;" >
                                                        <option value="">Select</option>
                                                        <?php
                                                            if(!empty($charges_list)) {
                                                                foreach ($charges_list as $data) {
                                                                    if(!empty($data['charges_id']) && $data['charges_id'] != $GLOBALS['null_value']) {
                                                                        ?>
                                                                        <option value="<?php echo $data['charges_id']; ?>" <?php if(!empty($charges_id[$i]) && $charges_id[$i] == $data['charges_id']) { ?>selected<?php } ?>>
                                                                            <?php
                                                                                if(!empty($data['charges_name']) && $data['charges_name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['charges_name']);
                                                                                }
                                                                            ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <label class="f-10">Charges </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 col-lg-5 pt-2">
                                            <div class="form-label-group in-border">
                                                <div class="input-group">
                                                    <input type='hidden' name='hidden_charges[]' id='hidden_charges' value="<?php if(!empty($charges_tax[$i])){ echo $charges_tax[$i]; } ?>">
                                                    <input type="text"  name="charges_value[]" onkeyup="Javascript:CheckCharges();" value="<?php if(!empty($charges_value[$i])) { echo $charges_value[$i]; } ?>" class="form-control shadow-none">
                                                    <div class="input-group-append charges_tax <?php if($gst_option == 0) { ?> d-none <?php } ?>" style="width:50%!important;">
                                                        <select name="charges_tax[]" onChange="Javascript:checkGST();" class="select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                                <option value="" data-select2-id="14">select tax</option>                    
                                                                <?php
                                                                    if(!empty($charges_tax_array)){
                                                                        for($c=0; $c < count($charges_tax_array); $c++) {
                                                                            if(!empty($charges_tax_array[$c]) && $charges_tax_array[$c] != $GLOBALS['null_value']) {
                                                                                ?>
                                                                                <option value="<?php echo $charges_tax_array[$c]; ?>" <?php if(isset($charges_tax[$i])){ if(!empty($charges_tax_array[$c]) && $charges_tax_array[$c] == $charges_tax[$i]) { ?>selected<?php } } ?>>
                                                                                    <?php
                                                                                        echo $charges_tax_array[$c];
                                                                                    ?>
                                                                                </option>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                ?>               
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-3 pt-3 pb-3">
                                            <div class="form-group">
                                                <div class="form-label-group in-border d-flex justify-content-end">
                                                    <!-- <input type="text" id="discounted_total" name="discounted_total" class="form-control shadow-none discounted_total" placeholder="" required> -->
                                                    <i class="bi bi-currency-rupee"></i><p class="charges_total"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1 align-self-center pt-2" onclick="Javascript:removeCharges(this);">
                                            <i class="bi bi-x-circle"></i>
                                        </div>
                                        <div class="col-lg-12 col-12 d-flex p-0">
                                            <div class="col-lg-8 col-8 font-weight-bold">
                                                Total Amount
                                            </div>
                                            <div class="col-lg-4 col-3 d-flex justify-content-end pb-2 text-right">
                                            <i class="bi bi-currency-rupee"></i><p class="charges_sub_total"></p>
                                        </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <div class="row charges_row border-top my-2 div_charges">
                                    <div class="col-4 col-lg-4 pt-2">
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <select class="select2 select2-danger" name="charges_id[]"  data-dropdown-css-class="select2-danger" style="width: 100%;" >
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($charges_list)) {
                                                            foreach ($charges_list as $data) {
                                                                if(!empty($data['charges_id']) && $data['charges_id'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['charges_id']; ?>" <?php if(!empty($charges_id) && $charges_id == $data['charges_id']) { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['charges_name']) && $data['charges_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['charges_name']);
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label class="f-10">Charges </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-5 pt-2">
                                        <div class="form-label-group in-border">
                                            <input type='hidden' name='hidden_charges[]' id='hidden_charges' value="">
                                            <div class="input-group">
                                                <input type="text"  name="charges_value[]" onkeyup="Javascript:CheckCharges();" value="" class="form-control shadow-none">
                                                <div class="input-group-append charges_tax <?php if($gst_option == 0) { ?> d-none <?php } ?>" style="width:50%!important;">
                                                     <select name="charges_tax[]"  class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" onChange="Javascript:checkGST();">
                                                            <option value="" >select tax</option>                                 
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-3 pt-3 pb-3">
                                        <div class="form-group">
                                            <div class="form-label-group in-border d-flex justify-content-end">
                                                <!-- <input type="text" id="discounted_total" name="discounted_total" class="form-control shadow-none discounted_total" placeholder="" required> -->
                                                <i class="bi bi-currency-rupee"></i><p class="charges_total"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 align-self-center pt-2" onclick="Javascript:removeCharges(this);">
                                        <i class="bi bi-x-circle"></i>
                                    </div>
                                    <div class="col-lg-12 col-12 d-flex p-0">
                                        <div class="col-lg-8 col-8 p-2 font-weight-bold">
                                            Total Amount
                                        </div>
                                        <div class="col-lg-4 col-3 d-flex justify-content-end pb-2 text-right">
                                            <i class="bi bi-currency-rupee"></i><p class="charges_sub_total"></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php
                            }
                        ?>
                        <div class="add_charges_row_display">
                        
                        <a href="javascript:void(0);" onclick="Javascript:showCharges(this);" style="color: #0c75b3;font-weight:bold;"><i class="bi bi-plus"></i> Add Another Charge</a>
                        </div>

                        <div class="sgst d-none">
                            <div class="col-lg-12 col-12 d-flex p-0">
                                <div class="col-lg-8 col-8 cgst_tax_value  font-weight-bold">
                                    CGST
                                </div>
                                <div class="col-lg-4 col-3 text-right d-flex justify-content-end p-0 d-flex">
                                    <i class="bi bi-currency-rupee"></i> <p class="sgst_value"> </p>
                                </div>
                            </div>
                        </div>
                        <div class="cgst d-none">
                            <div class="col-lg-12 col-12 d-flex p-0">
                                <div class="col-lg-8 col-8 sgst_tax_value  font-weight-bold">
                                    SGST
                                </div>
                                <div class="col-lg-4 col-3 text-right d-flex justify-content-end p-0 d-flex" >
                                    <i class="bi bi-currency-rupee"></i> <p class="cgst_value"> </p>
                                </div>
                            </div>
                        </div>
                        <div class="igst d-none">
                            <div class="col-lg-12 col-12 d-flex p-0">
                                <div class="col-lg-8 col-8 igst_tax_value  font-weight-bold">
                                    IGST
                                </div>
                                <div class="col-lg-4 col-3 text-right justify-content-end p-0 d-flex">
                                    <i class="bi bi-currency-rupee"></i> <p class="igst_value"> </p>
                                </div>
                            </div>
                        </div>
                        <div class="border-top my-2"></div>
                        <div class="total_tax d-none ">
                            <div class="col-lg-12 col-12 d-flex p-0">
                                <div class="col-lg-8 col-8  font-weight-bold">Total Tax  </div>
                                <div class="col-lg-4 col-3 text-right justify-content-end p-0 d-flex">
                                    <i class="bi bi-currency-rupee"></i><p class="total_tax_value"> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 d-flex p-0">
                            <div class="col-lg-6 col-8">
                                <div class="form-check">
                                    <input class="form-check-input" onclick="Javascript:CheckRoundOff(this)" name="round_off" type="checkbox" value="<?php if(!empty($round_off)){ echo $round_off; } ?>" id="flexCheckDefault1" <?php if($round_off == '1'){ ?>checked<?php } ?>>
                                    <label class="form-check-label" for="flexCheckDefault1">Auto Round Off</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-4 text-right" id="round_off_div">
                                <div class="form-group">
                                    <div class="form-label-group in-border">
                                        <div class="input-group">
                                            <div class="input-group-append" style="width:50%!important;">
                                                <select name="round_off_type" onchange="Javascript:CalRoundOff();" class="select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <option value="1" <?php if($round_off_type == '1'){ ?>selected<?php } ?>>Add</option>
                                                    <option value="2" <?php if($round_off_type == '2'){ ?>selected<?php } ?>>Subtract</option>
                                                </select>
                                            </div>
                                            <input type="text" id="" onKeyup="Javascript:CalRoundOff()" onfocus="Javascript:KeyboardControls(this,'number','2',1);" name="round_off_value" value="<?php if(!empty($round_off_type)){ echo $round_off_value; } ?>" class="form-control shadow-none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 d-flex p-0">
                            <div class="col-lg-8 col-8 p-2 font-weight-bold">
                                Total Amount
                            </div>
                            <div class="col-lg-4 col-3 d-flex justify-content-end p-0 text-right">
                                <i class="bi bi-currency-rupee"></i><p class="overall_total"></p>
                                <input type="hidden" name="overall_total" class="overall_totalround_off" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center">
                    <?php if(empty($show_purchase_entry_id)){  ?>
                        <button class="btn btn-dark submit_button" type="button" onClick="Javascript:SaveModalContent('purchase_entry_form', 'purchase_entry_changes.php', 'purchase_entry.php');SubmitWithOutPayment();"> Submit </button>
                        <button class="btn btn-dark submit_button" type="button" onClick="checkValidation();SubmitWithPayment();">Payment Submit </button>
                    <?php }else{
                        if(empty($payment_updation)){ ?>
                            <button class="btn btn-dark submit_button" type="button" onClick="Javascript:SaveModalContent('purchase_entry_form', 'purchase_entry_changes.php', 'purchase_entry.php');SubmitWithOutPayment();"> Submit </button>
                        <?php }else{ ?>
                          <button class="btn btn-dark submit_button" type="button" onClick="checkValidation();SubmitWithPayment();">Payment Submit </button>
                          <?php
                        }
                    } ?>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script>
                jQuery(document).ready(function(){
                    <?php 
                        if(!empty($show_purchase_entry_id)) { ?>
                        checkDiscount();
                        calTotal();
                        CheckRoundOff('<?php echo $round_off; ?>')
                        <?php }
                    ?>
                });
            </script>
            <script>
            function SubmitWithPayment() {
                $('#PaymentUpdation').val('1');
            }

            function SubmitWithOutPayment() {
                $('#PaymentUpdation').val('0');
            }
        </script>
            
            <div class="modal fade" id="PaymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Voucher</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="purchase_amount_display" style="font-size:16px;color:#4f71a5;padding:10px;font-weight:bold;"></div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border">
                                            <input type="date" class="form-control shadow-none" name="voucher_date" value="<?php if(!empty($voucher_date)) { echo $voucher_date; } ?>"  max="<?php if(!empty($voucher_date)) { echo $voucher_date; } ?>">
                                            <label>Date(*)</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border">
                                            <textarea class="form-control" id="narration" name="narration" placeholder="" onkeydown="Javascript:KeyboardControls(this,'',150,'');InputBoxColor(this,'text');"></textarea>
                                                <label>Narration(*)</label>
                                            </div>
                                            <div class="new_smallfnt">Max Char: 150(Except <>?{}!*^%$)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border mb-0" id="payment_tax_type">
                                                <select name="selected_tax_type" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2 select2-danger" style="width: 100%;" >
                                                    <option value="">Select</option>
                                                    <option value="1">With Tax</option>
                                                    <option value="2">Without Tax</option>
                                                </select>
                                                <label>Type(*)</label>  
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-6">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select name="selected_payment_mode_id" class="select2 select2-danger smallfnt" style="width: 100%;" onchange="Javascript:getBankDetails(this.value);GetPayment();">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($payment_mode_list)) {
                                                            foreach($payment_mode_list as $data) { ?>
                                                                <option value="<?php if(!empty($data['payment_mode_id'])) { echo $data['payment_mode_id']; } ?>">
                                                                    <?php
                                                                        if(!empty($data['payment_mode_name'])) {
                                                                            $data['payment_mode_name'] = $obj->encode_decode('decrypt', $data['payment_mode_name']);
                                                                            echo $data['payment_mode_name'];
                                                                        }
                                                                    ?>
                                                                </option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Select Payment Mode(*)</label>
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12 d-none" id="bank_list">
                                        <div class="form-group">
                                            <div class="form-label-group in-border mt-0">
                                                <select name="selected_bank_id" class="select2 select2-danger smallfnt form-control" style="width:100% !important;"  onchange="Javascript:GetPayment();">
                                                    <option value="">Select Bank</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border">
                                            <input type="text" name="selected_amt" class="form-control shadow-none" placeholder="" >
                                            <label>Amount</label>
                                            </div>
                                                <span class="payment text-danger fw-bold"></span>
                                                <input type="hidden" name="available_balance" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-3 col-12">
                                        <button class="btn btn-danger add_payment_button" style="font-size:12px;" type="button" onclick="Javascript:AddPurchasePaymentRow();" name="append_button">
                                            Add
                                        </button>
                                    </div> 
                                </div>
                                <div class="row justify-content-center pt-3"> 
                                    <div class="col-lg-8">
                                        <div class="table-responsive text-center">
                                            <input type="hidden" name="payment_row_count" value="0">
                                            <table class="table nowrap cursor smallfnt w-100 table-bordered payment_row_table">
                                                <thead class="bg-secondary text-white smallfnt">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Payment Tax Type</th>
                                                        <th>Payment Mode</th>
                                                        <th>Bank Name</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(!empty($payment_mode_ids_edit)){
                                                        for($j = 0; $j < count($payment_mode_ids_edit); $j++) {
                                                        ?>
                                                            <tr class="payment_row" id="payment_row<?php if(!empty($voucher_count)) { echo $voucher_count; } ?>">
                                                                <td class="payment_sno text-center">
                                                                    <?php if(!empty($voucher_count)) { echo $voucher_count; } ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                      if(!empty($payment_tax_type[$j])) {
                                                                            if($payment_tax_type[$j] == 1) {
                                                                                echo "With Tax"; 
                                                                            } else {
                                                                                echo "Without Tax";
                                                                            } 
                                                                    }  ?>
                                                                    <input type="hidden" name="payment_tax_type[]" value="<?php if(!empty($payment_tax_type[$j])) { echo $payment_tax_type[$j]; } ?>">
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                        if(!empty($payment_mode_name[$j]) && $payment_mode_name[$j] != $GLOBALS['null_value']) {                                                                                                                        
                                                                            echo $obj->encode_decode('decrypt', $payment_mode_name[$j]);
                                                                        }else{
                                                                            echo '-';
                                                                        }
                                                                    ?>
                                                                    <input type="hidden" name="payment_mode_id[]" value="<?php if(!empty($payment_mode_ids_edit[$j])) { echo $payment_mode_ids_edit[$j]; } ?>">
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                        if(!empty($bank_name[$j]) && $bank_name[$j] != $GLOBALS['null_value']) {                                                        
                                                                            echo $obj->encode_decode('decrypt', $bank_name[$j]);
                                                                        }
                                                                        else {
                                                                            echo '-';
                                                                        }   
                                                                    ?>
                                                                    <input type="hidden" name="bank_id[]" value="<?php if(!empty($payment_bank_id[$j])) { echo $payment_bank_id[$j]; } ?>">
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="text" name="voucher_amount[]" style="width:75%!important;margin:auto!important;" class="form-control shadow-none px-1 text-center" value="<?php if(!empty($payment_amount[$j])) { echo $payment_amount[$j]; } ?>" onfocus="Javascript:KeyboardControls(this,'number','8','');" onkeyup="Javascript:PaymentVoucherTotal();InputBoxColor(this, 'text');">
                                                                </td>
                                                                <?php
                                                                if(!empty($edit_id)){ ?>
                                                                <td class="text-center">
                                                                    <button class="btn btn-danger" type="button" onclick="Javascript:DeleteVoucherRow('payment_row', '<?php if(!empty($voucher_count)) { echo $voucher_count; } ?>');"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                                <?php
                                                                }

                                                                ?>
                                                            </tr>              
                                                        <?php
                                                        $voucher_count--;
                                                        }
                                                    }
                                                    ?>                                  
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="4" class="text-end">Total Amount : </th>
                                                        <th class="voucher_overall_total"><?php if(!empty($payment_total_amount)){ echo $payment_total_amount; } ?></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onClick="Javascript:SaveModalContent('purchase_entry_form', 'purchase_entry_changes.php', 'purchase_entry.php');">Save</button>
                            </div>
                    </div>
                </div>
            </div>  
        </form>
		<?php
    } 
    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title'];
        
        $from_date = ""; $to_date = ""; $search_text = ""; $party_id = "";
        $show_bill = 0;$show_draft_bill = 0;
        if(isset($_POST['from_date'])) {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date'])) {
            $to_date = $_POST['to_date'];
        }
        if(isset($_POST['show_bill'])) {
            $show_bill = $_POST['show_bill'];
        }
        if(isset($_POST['show_draft_bill'])) {
            $show_draft_bill = $_POST['show_draft_bill'];
        }
        if(isset($_POST['search_text'])) {
            $search_text = $_POST['search_text'];
        }

        if(isset($_POST['party_id']))
        {
               $party_id = $_POST['party_id'];
        }

        $total_records_list = array();
        $total_records_list = $obj->getPurchaseList($from_date, $to_date, $search_text,$show_bill,$party_id);
        
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if( (strpos(strtolower($val['purchase_entry_number']), $search_text) !== false) ) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }

        $total_pages = 0;	
		$total_pages = count($total_records_list);

        $page_start = 0; $page_end = 0;
		if(!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
			if($total_pages > $page_limit) {
				if($page_number) {
					$page_start = ($page_number - 1) * $page_limit;
					$page_end = $page_start + $page_limit;
				}
			}
			else {
				$page_start = 0;
				$page_end = $page_limit;
			}
		}

		$show_records_list = array();
        if(!empty($total_records_list)) {
            foreach($total_records_list as $key => $val) {
                if($key >= $page_start && $key < $page_end) {
                    $show_records_list[] = $val;
                }
            }
        }
		
		$prefix = 0;
		if(!empty($page_number) && !empty($page_limit)) {
			$prefix = ($page_number * $page_limit) - $page_limit;
		}
        ?> 
        <?php if($total_pages > $page_limit) { ?>
            <div class="pagination_cover mt-3"> 
                <?php include("pagination.php"); ?> 
            </div> 
        <?php } ?>
        <?php
   
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if(empty($access_error)) { ?>
            
            <table class="table nowrap cursor text-center smallfnt">
                <thead class="bg-light">
                    <tr>
                        <th>S.No</th>
                        <th> Bill Number <br>Bill Date </th>
                        <th>Party Name</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(!empty($show_records_list)) {
                        foreach($show_records_list as $key => $list) {
                            $index = $key + 1;
                            if(!empty($prefix)) { $index = $index + $prefix; }   
                            ?>
                            <tr>
                                <td class="ribbon-header" style="cursor:default;">
                                    <?php echo $index; ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['purchase_entry_number']) && $list['purchase_entry_number'] != $GLOBALS['null_value']) {
                                            echo $list['purchase_entry_number'];
                                        }
                                    ?>
                                    <br>
                                    <?php
                                        if(!empty($list['purchase_entry_date'])) {
                                            echo date('d-m-Y', strtotime($list['purchase_entry_date']));
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['party_name_mobile_city']) && $list['party_name_mobile_city'] != $GLOBALS['null_value']) {
                                            echo ($obj->encode_decode('decrypt', $list['party_name_mobile_city']));
                                        }
                                        else {
                                            echo '-';
                                        }
                                    
                                    if(!empty($list['cancelled'])) {
                                        ?>
                                                <br><span style="color: red;">Cancelled</span>
                                        <?php	
                                    }	 
                                    ?>
                                    <p style="padding-top:10px;font-size:10px;">
                                        <?php
                                        if(!empty($list['creator_name'])) {
                                            $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                            echo " Creator : ". $list['creator_name'];
                                        }
                                        ?>   
                                    </p>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($list['total_amount'])) {
                                            echo number_format($list['total_amount'],2);
                                        }
                                        else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                                <td>
                                    
                                    <a target="_blank" href="reports/rpt_purchase_entry_a4.php?view_purchase_entry_id=<?php if(!empty($list['purchase_entry_id'])) { echo $list['purchase_entry_id']; } ?>"><i class="fa fa-print" title="Print A4"></i> &ensp; </a>
                                    <?php 
                                    $access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $edit_action;
                                        include('permission_action.php');
                                    }
                                    if(empty($access_error) && empty($list['cancelled'])) {
                                    ?> 
                                        <a href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['purchase_entry_id'])) { echo $list['purchase_entry_id']; } ?>');"><i class="fa fa-pencil"></i>&nbsp;&nbsp;</a>
                                    <?php } ?>
                                    <?php 
                                    $access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $delete_action;
                                        include('permission_action.php');
                                    }
                                    if(empty($access_error) && empty($list['cancelled'])) {
                                    ?>  
                                        <a href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['purchase_entry_id'])) { echo $list['purchase_entry_id']; } ?>');"><i class="fa fa-trash"></i> &nbsp;</a>
                                    <?php }  ?>

                                </td>
                            </tr>
                        <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td colspan="7" class="text-center">Sorry! No records found</td>
                        </tr>
                    <?php 
                        } 
                    ?>
                </tbody>
            </table>                
            <?php	
        }
	}

    if(isset($_REQUEST['edit_id'])) 
    {
        $purchase_entry_date = ""; $purchase_entry_date_error = "";$purchase_bill_date = ""; $purchase_bill_date_error = ""; $purchase_entry_number = ""; $purchase_entry_number_error = "";$party_id = ""; $party_id_error = ""; $gst_option = ""; $gst_option_error = ""; $tax_type = ""; $tax_type_error = "";$tax_option = ""; $tax_option_error = ""; $overall_tax =""; $product_ids = array(); $quantity = array(); $types = array(); $unit_id =array(); $total_qty = array();$rates = array(); $per = array(); $per_type =array(); $final_rate =array(); $product_amount =array(); $brand_error = ""; $product_error = ""; $product_names = array(); $amount =array(); $cgst_value = 0; $sgst_value = 0; $igst_value = 0; $round_off = ""; $sub_total = 0; $total_amount = 0; $total_tax_value = 0; $overall_tax ="";$unit_id = "";$unit_ids = array(); $unit_id =""; $unit_id_error =""; $gst_option ="";  $product_tax =array(); $charges_tax =array(); $terms_and_condition =""; $subunit_need =array();
        $company_state = ""; $party_state = ""; $draft = 0; $payment_updation = 0;
        $conversion_id =""; $per_rate =array();$charges_id = array(); $charges_names = array();
        $charges_values = array(); $charges_type = array(); $charges_total = array();  $is_discount =""; $discount_name = "";
        $valid_purchase = ""; $form_name = "purchase_entry_form"; $edit_id = ""; $discount_value =""; $discounted_total =0;

        if(isset($_POST['payment_updation'])){
			 $payment_updation = $_POST['payment_updation'];
		}
        
        $voucher_date = ""; $voucher_date_error = ""; $valid_voucher = "";     $payment_tax_types = array();
        $payment_mode_ids = array(); $bank_ids = array(); $bank_names = array(); $payment_mode_names = array(); $amount = array(); $total_amount = 0; $payment_error = ""; $narration = ""; $narration_error = ""; $selected_payment_mode_id = "";


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
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'purchase_entry_date', $purchase_entry_date_error, 'text');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'purchase_entry_date', $purchase_entry_date_error, 'text');
            }
        }

        $purchase_bill_date = $_POST['purchase_bill_date'];
        $purchase_bill_date = trim($purchase_bill_date);
        $purchase_bill_date_error = $valid->common_validation($purchase_bill_date, 'Bill Date', '1');
        if(!empty($purchase_bill_date_error)) {
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'purchase_bill_date', $purchase_bill_date_error, 'text');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'purchase_bill_date', $purchase_bill_date_error, 'text');
            }
        }

        $purchase_entry_number = $_POST['purchase_entry_number'];
        $purchase_entry_number = trim($purchase_entry_number);
        $purchase_entry_number_error = $valid->valid_address($purchase_entry_number, 'Bill Number', '1','25');
        if(empty($purchase_entry_number_error) && strlen($purchase_entry_number) > 25) {
            $purchase_entry_number_error = "Only 25 characters allowed";
        }
        if(!empty($purchase_entry_number_error)) {
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'purchase_entry_number', $purchase_entry_number_error, 'text');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'purchase_entry_number', $purchase_entry_number_error, 'text');
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
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'party_id', $party_id_error, 'select');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'party_id', $party_id_error, 'select');
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
            if(!empty($valid_purchase)) {
                $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'gst_option', $gst_option_error, 'text');
            }
            else {
                $valid_purchase = $valid->error_display($form_name, 'gst_option', $gst_option_error, 'text');
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
                if(!empty($valid_purchase)) {
                    $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'tax_type', $tax_type_error, 'select');
                }
                else {
                    $valid_purchase = $valid->error_display($form_name, 'tax_type', $tax_type_error, 'select');
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
                if(!empty($valid_purchase)) {
                    $valid_purchase = $valid_purchase." ".$valid->error_display($form_name, 'tax_option', $tax_option_error, 'select');
                }
                else {
                    $valid_purchase = $valid->error_display($form_name, 'tax_option', $tax_option_error, 'select');
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

        // if(isset($_POST['godown_id'])) {
        //     $godown_id = $_POST['godown_id'];
        // }
       
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
        // print_r($_POST['charges_tax']);
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

        // $prd_amount = 0;

        if($gst_option == '1' && empty($product_error) && empty($valid_purchase)) {
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
                
                        // if(!empty($round_off_value)){
                        //     if($round_off_value < 10) {
                        //          $round_off_value = "0.".$round_off_value;
                        //     }
                        // }
                        // echo $round_off_value;
                        $round_off_calculation = 0; $final_round_off = 0;
                            if (!empty($round_off_value)) {
                                $round_off_calculation = $round_off_value;
                         
                                if($round_off_calculation != "00") {
                                    if(strlen($round_off_calculation) == 1) {
                                        $round_off_calculation = $round_off_calculation."0";
                                    }
                                    $final_round_off = "0.".$round_off_calculation;
                                }
                            }
                
              
                        if($round_off_type == '1')
                        {
                          
                            $total_amount = $total_amount+$final_round_off;
                    
                        }
                        else if($round_off_type == '2')
                        {
                    
                            $total_amount = $total_amount-$final_round_off;
                        }
            
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
         $voucher_total_amounts = 0;
        if(!empty($payment_updation) && $payment_updation == 1){
                if(isset($_POST['payment_mode_id'])) {
                    $payment_mode_ids = $_POST['payment_mode_id'];
                    $payment_mode_ids = array_reverse($payment_mode_ids);
                }
            
                if(isset($_POST['bank_id'])) {
                    $bank_ids = $_POST['bank_id'];
                    $bank_ids = array_reverse($bank_ids);
                }
                if(isset($_POST['voucher_amount'])) {
                    $voucher_amount = $_POST['voucher_amount'];
                    $voucher_amount = array_reverse($voucher_amount);
                }   
                if(isset($_POST['payment_tax_type'])) {
                    $payment_tax_types = $_POST['payment_tax_type'];
                    $payment_tax_types = array_reverse($payment_tax_types);
                }       
                // print_r($payment_tax_types);
                if(isset($_POST['voucher_date'])) {
                    $voucher_date = $_POST['voucher_date'];
                }
               
                $voucher_amount_error = ""; 
                if(!empty($payment_mode_ids)) {
                    for($i=0; $i < count($payment_mode_ids); $i++) {
                        $payment_mode_ids[$i] = trim($payment_mode_ids[$i]);
                        $payment_mode_name = "";
                        $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_ids[$i], 'payment_mode_name');
                        $payment_mode_names[$i] = $payment_mode_name;
                        
                        $bank_ids[$i] = trim($bank_ids[$i]); $decrypt_bank_name = "";
                        if(!empty($bank_ids[$i])) {
                            $bank_name = ""; 
                            $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_ids[$i], 'bank_name');
                            if(!empty($bank_name) && $bank_name != $GLOBALS['null_value']) {
                                $bank_names[$i] = $bank_name;
                                $decrypt_bank_name = 'Bank -'. $obj->encode_decode('decrypt',$bank_names[$i]); 
                            }
                            else {
                                $bank_names[$i] = "";
                            }
                        }
                        else {
                            $bank_ids[$i] = "";
                            $bank_names[$i] = "";
                        }
                        $voucher_amount[$i] = trim($voucher_amount[$i]);
                        if(isset($voucher_amount[$i])) {
                            $voucher_amount_error = "";
                            $voucher_amount_error = $valid->valid_price($voucher_amount[$i], 'Amount', '1', '');
                            if(!empty($voucher_amount_error)) {
                                if(!empty($valid_voucher)) {
                                    $valid_voucher = $valid_voucher." ".$valid->row_error_display($form_name, 'amount[]', $voucher_amount_error, 'text', 'payment_row', ($i+1));
                                }
                                else {
                                    $valid_voucher = $valid->row_error_display($form_name, 'amount[]', $voucher_amount_error, 'text', 'payment_row', ($i+1));
                                }
                            }
                            else {
                                $voucher_total_amounts += $voucher_amount[$i];
                            }
                        }
                        $get_voucher_id = "";
                        if(!empty($edit_id)){
                            $get_voucher_id = $obj->getTableColumnValue($GLOBALS['voucher_table'],'purchase_entry_id', $edit_id, 'voucher_id');
                        }
                        $available_balance = 0; $tax_type_display = "";
                        $available_balance =$obj->GetPaymentAmountForChecking($payment_tax_types[$i],$payment_mode_ids[$i],$bank_ids[$i],$get_voucher_id);
                        
                        if($payment_tax_types[$i] == 1){
                            $tax_type_display = "With Tax";
                        }else{
                            $tax_type_display = "Without Tax";
                        }

                            if($voucher_amount[$i] > $available_balance){
                                $payment_error = "Max Amount in Payment Mode -  ".$obj->encode_decode('decrypt',$payment_mode_names[$i]). $decrypt_bank_name. " ".$tax_type_display ."  is Rs.".$available_balance;
                            }
                        
                    }
                    //  echo  $grand_total ."/".$voucher_total_amounts;
                        // if(empty($payment_error)){

                            if($total_amount != $voucher_total_amounts){
                                $payment_error = "Amount Should be equal to Rs. ". $total_amount;
                                // $valid_voucher = $valid->error_display($form_name, "voucher_date", $payment_error, 'text');                                
                            }  
                        // }     


                }
                else {
                    $payment_error = "Add Payment";
                    // $valid_voucher = $valid->error_display($form_name, "voucher_date", $payment_error, 'text');                        
                } 
        }

        if(empty($valid_purchase) && empty($product_error) && empty($payment_error) && empty($purchase_entry_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $bill_company_id =$GLOBALS['bill_company_id'];
                $bill_company_details = "";
                if (!empty($bill_company_id)) {
                    $bill_company_details = $obj->BillCompanyDetails($bill_company_id, $GLOBALS['purchase_entry_table']);
                }
    
                if(!empty($purchase_entry_date)) {
                    $purchase_entry_date = date('Y-m-d', strtotime($purchase_entry_date));
                }
                if(!empty($purchase_bill_date)) {
                    $purchase_bill_date = date('Y-m-d', strtotime($purchase_bill_date));
                }
                if(empty($purchase_entry_number)) {
                    $purchase_entry_number = $GLOBALS['null_value'];
                }
                $party_name ="";
                if(!empty($party_id)) {
                    $party_name_mobile_city = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'name_mobile_city');
                    $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_name');
                    $party_details = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_details');
                }
                else {
                    $party_id = $GLOBALS['null_value'];
                    $party_name = $GLOBALS['null_value'];
                    $party_name_mobile_city = $GLOBALS['null_value'];
                    $party_details = $GLOBALS['null_value'];
                }
             
                if(!empty($product_ids)) {
                    $product_ids = array_reverse($product_ids);
                    $product_ids = implode(",", $product_ids);
                }else{
                    $product_ids = $GLOBALS['null_value'];
                }
               
                if(!empty($product_names)) {
                    $product_names = array_reverse($product_names);
                    $product_names = implode(",", $product_names);
                }else{
                    $product_names = $GLOBALS['null_value'];
                }
    
                if(!empty($unit_ids)) {
                    $unit_ids = array_reverse($unit_ids);
                    $unit_ids = implode(",", $unit_ids);
                }else{
                    $unit_ids = $GLOBALS['null_value'];
                }

                if(!empty($unit_names)) {
                    $unit_names = array_reverse($unit_names);
                    $unit_names = implode(",", $unit_names);
                }else{
                    $unit_names = $GLOBALS['null_value'];
                }
                
                if(!empty($quantity)) {
                    $quantity = array_reverse($quantity);
                    $quantity = implode(",", $quantity);
                }else{
                    $quantity = $GLOBALS['null_value'];
                }
                
                if(!empty($total_qty)) {
                    $total_qty = array_reverse($total_qty);
                    $total_qty = implode(",", $total_qty);
                }else{
                    $total_qty = $GLOBALS['null_value'];
                }
                
                if(!empty($rates)) {
                    $rates = array_reverse($rates);
                    $rates = implode(",", $rates);
                }else{
                    $rates = $GLOBALS['null_value'];
                }
                if(!empty($final_rate)) {
                    $final_rate = array_reverse($final_rate);
                    $final_rate = implode(",", $final_rate);
                }else{
                    $final_rate = $GLOBALS['null_value'];
                }
                
                if(!empty($product_amount)) {
                    $product_amount = array_reverse($product_amount);
                    $product_amount = implode(",", $product_amount);
                }else{
                    $product_amount = $GLOBALS['null_value'];
                }

                if(!empty($amount)) {
                    $amount = array_reverse($amount);
                    $amount = implode(",", $amount);
                }else{
                    $amount = $GLOBALS['null_value'];
                }

                if(!empty($product_tax)) {
                    $product_tax = array_reverse($product_tax);
                    $product_tax = implode(",", $product_tax);
                }else{
                    $product_tax = $GLOBALS['null_value'];
                }
                // print_r($charges_tax);
                if(!empty($charges_tax)) {
                    $charges_tax = array_reverse($charges_tax);
                    $charges_tax = implode(",", $charges_tax);
                }else{
                    $charges_tax = $GLOBALS['null_value'];
                }

                if(!empty(array_filter($charges_id, fn($value) => $value !== ""))) {
                    $charges_id = implode(",", $charges_id);
                }
                else {
                    $charges_id = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($charges_type, fn($value) => $value !== ""))) {
                    $charges_type = implode(",", $charges_type);
                }
                else {
                    $charges_type = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($charges_values, fn($value) => $value !== ""))) {
                    $charges_values = implode(",", $charges_values);
                }
                else {
                    $charges_values = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($charges_total, fn($value) => $value !== ""))) {
                    $charges_total = implode(",", $charges_total);
                }
                else {
                    $charges_total = $GLOBALS['null_value'];
                }

                if(!empty($charges_total_amounts)) {
                    $charges_total_amounts = implode(",", $charges_total_amounts);
                }else{
                    $charges_total_amounts = $GLOBALS['null_value'];
                }

                $purchase_entry_error = "";$check_bills ="";
                // if(!empty($purchase_entry_number) && !empty($bill_company_id)) {
                //     $prev_bill_id="";
                //     $prev_bill_id=$obj->PurchaseBillNumberAlreadyExists($bill_company_id,$purchase_entry_number);
                //     if(!empty($prev_bill_id) && $prev_bill_id != $edit_id) {
                //         $purchase_entry_error = "This bill number is already exist";
                //     }	
                // }
                if(!empty($party_id)){
                    $party_type = $obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$party_id,'party_type');
                }

                $purchase_entry_id = "";
                if(!empty($conversion_id)) {
                    $purchase_entry_id = $conversion_id;
                }
                else {
                    $purchase_entry_id = $GLOBALS['null_value'];
                }

                if(empty($discount_value))
                {
                    $discount_value = $GLOBALS['null_value'];
                }
                if(empty($discounted_total))
                {
                    $discounted_total = $GLOBALS['null_value'];
                }

                if(!empty($discount_name)){
                    $discount_name = $obj->encode_decode('encrypt', $discount_name);
                }
                $mobile_number =""; $city =""; $decrypted_party_name = ""; $decrypted_mbl ="";
  
                $bill_company_id = $GLOBALS['bill_company_id']; 
                   if(!empty($payment_updation) && $payment_updation == 1){
                    
                        if(!empty($party_id)){
                            $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_name');
                            if(!empty($party_name) && $party_name != $GLOBALS['null_value']){
                                $decrypted_party_name =  $obj->encode_decode('decrypt', $party_name);
                                $name_mobile_city = $decrypted_party_name;
                            }
                            $mobile_number = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'mobile_number');
                            if(!empty($mobile_number) && $mobile_number != $GLOBALS['null_value']){
                                $decrypted_mbl =  $obj->encode_decode('decrypt', $mobile_number);

                                $name_mobile_city .= ' - '.$decrypted_mbl;
                            }
                        
                            if(!empty($name_mobile_city) && $name_mobile_city != $GLOBALS['null_value']){
                                $name_mobile_city = $obj->encode_decode('encrypt', $name_mobile_city);
                            }
                        } else {
                            $party_id = $GLOBALS['null_value'];
                            $party_name = $GLOBALS['null_value'];
                            $name_mobile_city = $GLOBALS['null_value'];
                        }

                        if(!empty($lr_id)) {
                            $lr_number = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $lr_id, 'lr_number');
                        } else {
                            $lr_id = $GLOBALS['null_value'];
                            $lr_number = $GLOBALS['null_value'];
                        }

                        if(!empty($payment_mode_ids)) {
                            $payment_mode_ids = array_reverse($payment_mode_ids);
                            $payment_mode_ids = implode(',', $payment_mode_ids);
                        }
                        else {
                            $payment_mode_ids = $GLOBALS['null_value'];
                        }
                        if(!empty($payment_mode_names)) {
                            $payment_mode_names = array_reverse($payment_mode_names);
                            $payment_mode_names = implode(',', $payment_mode_names);
                        }
                        else {
                            $payment_mode_names = $GLOBALS['null_value'];
                        }
                        if(!empty($bank_ids)) {
                            $bank_ids = array_reverse($bank_ids);
                            $bank_ids = implode(',', $bank_ids);
                        }
                        else {
                            $bank_ids = $GLOBALS['null_value'];
                        }
                        if(!empty($bank_names)) {
                            $bank_names = array_reverse($bank_names);
                            $bank_names = implode(',', $bank_names);
                        }
                        else {
                            $bank_names = $GLOBALS['null_value'];
                        }

                        if(!empty($voucher_date)) {
                            $voucher_date = date("Y-m-d", strtotime($voucher_date));
                        }

                        if(!empty($payment_tax_types)) {
                            $payment_tax_types = array_reverse($payment_tax_types);
                            $payment_tax_types = implode(',', $payment_tax_types);
                        }
                        else {
                            $payment_tax_types = $GLOBALS['null_value'];
                        }
                        if(!empty($voucher_amount)) {
                            $voucher_amount = array_reverse($voucher_amount);
                            $voucher_amount = implode(',', $voucher_amount);
                        }
                        else {
                            $voucher_amount = $GLOBALS['null_value'];
                        }
                        if(!empty($narration)) {
                            $narration = $obj->encode_decode('encrypt', $narration);
                        }
                        else {
                            $narration = $GLOBALS['null_value'];
                        }
                        if(empty($party_type)){
                            $party_type = $GLOBALS['null_value'];
                        }
                        $voucher_number = $obj->new_automate_number($GLOBALS['voucher_table'], 'voucher_number');
                        if(empty($voucher_number)){
                            $voucher_number = $GLOBALS['null_value'];
                        }
                        $voucher_party_type = "Purchase Party";
                    }
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                 $balance =0;
                if(empty($edit_id)) {
                    // if(empty($prev_bill_id)) {
                        $action = "";
                        if(!empty($purchase_entry_number)) {
                            $action = "New Purchase Created. Bill No. - ".$purchase_entry_number;
                        }
                        $null_value = $GLOBALS['null_value'];
                        $columns = array(); $values = array();
                        $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'bill_company_details', 'purchase_entry_id', 'purchase_entry_number', 'purchase_entry_date','purchase_bill_date','party_id', 'party_name_mobile_city', 'party_details', 'gst_option', 'tax_type', 'tax_option', 'overall_tax', 'charges_tax', 'product_tax', 'company_state', 'party_state', 'product_id', 'product_name', 'quantity', 'unit_id' ,'unit_name' , 'total_qty', 'rate','final_rate', 'product_amount', 'amount', 'sub_total', 'discount', 'discount_value', 'discounted_total',  'charges_id',  'charges_value', 'charges_total', 'cgst_value', 'sgst_value', 'igst_value', 'total_tax_value', 'round_off', 'total_amount', 'round_off_type' , 'round_off_value','cancelled', 'discount_name','payment_updation',  'deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'",  "'".$null_value."'", "'".$purchase_entry_number."'", "'".$purchase_entry_date."'","'".$purchase_bill_date."'","'".$party_id."'", "'".$party_name_mobile_city."'", "'".$party_details."'", "'".$gst_option."'", "'".$tax_type."'", "'".$tax_option."'", "'".$overall_tax."'", "'".$charges_tax."'","'".$product_tax."'", "'".$company_state."'", "'".$party_state."'", "'".$product_ids."'", "'".$product_names."'","'".$quantity."'", "'".$unit_ids."'","'".$unit_names."'", "'".$total_qty."'","'".$rates."'","'".$final_rate."'", "'".$product_amount."'", "'".$amount."'","'".$sub_total."'", "'".$discount."'", "'".$discount_value."'" , "'".$discounted_total."'",   "'".$charges_id."'",  "'".$charges_values."'", "'".$charges_total."'", "'".$cgst_value."'", "'".$sgst_value."'", "'".$igst_value."'", "'".$total_tax_value."'", "'".$round_off."'", "'".$total_amount."'", "'".$round_off_type."'", "'".$round_off_value."'", "'0'", "'".$discount_name."'", "'".$payment_updation."'","'0'");

                        $purchase_insert_id = $obj->InsertSQL($GLOBALS['purchase_entry_table'], $columns, $values,$action);
           
                            if(preg_match("/^\d+$/", $purchase_insert_id)) {
								$purchase_entry_id = "";$purchase_balance =1;
								if($purchase_insert_id < 10) {
									$purchase_entry_id = "PURCHASE_".date("dmYhis")."_0".$purchase_insert_id;
								}
								else {
									$purchase_entry_id = "PURCHASE_".date("dmYhis")."_".$purchase_insert_id;
								}
								if(!empty($purchase_entry_id)) {
									$purchase_entry_id = $obj->encode_decode('encrypt', $purchase_entry_id);
								}
								$columns = array(); $values = array();						
								$columns = array('purchase_entry_id');
								$values = array("'".$purchase_entry_id."'");
								$purchase_entry_update_id = $obj->UpdateSQL($GLOBALS['purchase_entry_table'], $purchase_insert_id, $columns, $values, '');
								if(preg_match("/^\d+$/", $purchase_entry_update_id)) {	
									$update_purchase_entry_id = $purchase_entry_id;	
									$result = array('number' => '1', 'msg' => 'Purchase Entry Successfully Created','redirection_page' =>'purchase_entry.php');					
								}
								else {
									$result = array('number' => '2', 'msg' => $purchase_entry_update_id);
								}
							}
							else {
								$result = array('number' => '2', 'msg' => $purchase_insert_id);
							}
                        if(!empty($purchase_entry_id) && !empty($payment_updation) && $payment_updation == 1) {
                            $columns = array(); $values = array();

                            $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'voucher_id', 'voucher_number', 'voucher_date','party_id', 'party_name','party_type','payment_tax_type', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount', 'purchase_entry_id','deleted','name_mobile_city');
				        	$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$voucher_number."'", "'".$voucher_date."'", "'".$party_id."'", "'".$party_name."'","'".$voucher_party_type."'", "'".$payment_tax_types."'", "'".$narration."'", "'".$voucher_amount."'", "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'", "'".$total_amount."'", "'".$purchase_entry_id."'", "'0'","'".$name_mobile_city."'");
                            $voucher_insert_id = $obj->InsertSQL($GLOBALS['voucher_table'], $columns, $values, $action);						

                                    if(preg_match("/^\d+$/", $voucher_insert_id)) {
                                        $voucher_id = "";
                                        if($voucher_insert_id < 10) {
                                            $voucher_id = "voucher_".date("dmYhis")."_0".$voucher_insert_id;
                                        }
                                        else {
                                            $voucher_id = "voucher_".date("dmYhis")."_".$voucher_insert_id;
                                        }
                                        if(!empty($voucher_id)) {
                                            $voucher_id = $obj->encode_decode('encrypt', $voucher_id);
                                        }
                                        $columns = array(); $values = array();						
                                        $columns = array('voucher_id');
                                        $values = array("'".$voucher_id."'");
                                        $voucher_update_id = $obj->UpdateSQL($GLOBALS['voucher_table'], $voucher_insert_id, $columns, $values, '');
                                        if(preg_match("/^\d+$/", $voucher_update_id)) {		
                                            $result = array('number' => '1', 'msg' => 'Voucher Successfully Created');					
                                            $balance = 1;							
                                        }
                                        else {
                                            $result = array('number' => '2', 'msg' => $voucher_update_id);
                                        }
                                    }
                                $result = array('number' => '1', 'msg' => 'Purchase Entry Successfully Created','redirection_page' =>'purchase_entry.php','purchase_id' => $purchase_entry_id);
                        }
                }
                else
                {
                    // if((empty($prev_bill_id) || $prev_bill_id == $edit_id)) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($purchase_entry_number)) {
                                $action = "Purchase Entry Updated. Bill No. - ".$purchase_entry_number;
                            }

                            $columns = array(); $values = array();						
                            $columns = array('creator_name','bill_company_id', 'bill_company_details','purchase_entry_number', 'purchase_entry_date','purchase_bill_date','party_id', 'party_name_mobile_city', 'party_details', 'gst_option', 'tax_type', 'tax_option', 'overall_tax', 'product_tax', 'company_state', 'party_state','product_id', 'product_name', 'quantity', 'unit_id' ,'unit_name' ,'total_qty', 'rate','final_rate', 'product_amount', 'amount', 'sub_total', 'discount', 'discount_value', 'discounted_total',  'charges_id',  'charges_value', 'charges_total', 'cgst_value', 'sgst_value', 'igst_value', 'total_tax_value', 'round_off', 'total_amount', 'charges_tax', 'round_off_type', 'round_off_value', 'discount_name','payment_updation');
                            $values = array("'".$creator_name."'","'".$bill_company_id."'","'".$bill_company_details."'",  "'".$purchase_entry_number."'", "'".$purchase_entry_date."'","'".$purchase_bill_date."'","'".$party_id."'", "'".$party_name_mobile_city."'", "'".$party_details."'", "'".$gst_option."'", "'".$tax_type."'", "'".$tax_option."'", "'".$overall_tax."'","'".$product_tax."'", "'".$company_state."'", "'".$party_state."'", "'".$product_ids."'", "'".$product_names."'","'".$quantity."'", "'".$unit_ids."'","'".$unit_names."'", "'".$total_qty."'","'".$rates."'","'".$final_rate."'", "'".$product_amount."'", "'".$amount."'","'".$sub_total."'", "'".$discount."'", "'".$discount_value."'" , "'".$discounted_total."'",  "'".$charges_id."'",  "'".$charges_values."'", "'".$charges_total."'", "'".$cgst_value."'", "'".$sgst_value."'", "'".$igst_value."'", "'".$total_tax_value."'", "'".$round_off."'", "'".$total_amount."'", "'".$charges_tax."'","'".$round_off_type."'", "'".$round_off_value."'", "'".$discount_name."'","'".$payment_updation."'");
                            
                            $purchase_update_id = $obj->UpdateSQL($GLOBALS['purchase_entry_table'], $getUniqueID, $columns, $values, $action);

                            if(preg_match("/^\d+$/", $purchase_update_id)) {
                                $purchase_entry_id = $edit_id;
                                $purchase_entry_number = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $edit_id, 'purchase_entry_number');
                                if($draft !="1"){
                                    $result = array('number' => '1', 'msg' => 'Updated Successfully','redirection_page' =>'purchase_entry.php');
                                    $purchase_balance =1; 
                                    if(!empty($payment_updation) && $payment_updation == 1){
                                  
                                        $columns = array(); $values = array();
                                        $getVoucherUniqueID = "";
                                        $getVoucherUniqueID = $obj->getTableColumnValue($GLOBALS['voucher_table'], 'purchase_entry_id', $edit_id, 'id');
                                        $voucher_id = $obj->getTableColumnValue($GLOBALS['voucher_table'], 'purchase_entry_id', $edit_id, 'voucher_id');
                                        $columns = array('creator_name','bill_company_id', 'voucher_date','party_id', 'party_name','party_type','payment_tax_type', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount', 'purchase_entry_id','name_mobile_city');
                                        $values = array("'".$creator_name."'","'".$bill_company_id."'", "'".$voucher_date."'", "'".$party_id."'", "'".$party_name."'","'".$voucher_party_type."'", "'".$payment_tax_types."'", "'".$narration."'", "'".$voucher_amount."'", "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'", "'".$total_amount."'", "'".$purchase_entry_id."'", "'".$name_mobile_city."'");
                                        $voucher_update_id = $obj->UpdateSQL($GLOBALS['voucher_table'],$getVoucherUniqueID, $columns, $values, $action);	

                                        if(preg_match("/^\d+$/", $voucher_update_id)) {		
                                            // $result = array('number' => '1', 'msg' => 'Voucher Successfully Created');					
                                            $balance = 1;							
                                               $result = array('number' => '1', 'msg' => 'Updated Successfully','redirection_page' =>'purchase_entry.php','purchase_id' => $purchase_entry_id);
                                        }
                                        else {
                                            $result = array('number' => '2', 'msg' => $voucher_update_id);
                                        }
                                    }else{
                                        $result = array('number' => '1', 'msg' => 'Updated Successfully','redirection_page' =>'purchase_entry.php','purchase_id' => $purchase_entry_id);
                                    }
                                        // if(preg_match("/^\d+$/", $voucher_update_id)) {		
                                        //     $result = array('number' => '1', 'msg' => 'Voucher Successfully Created');					
                                        //     $balance = 1;							
                                        // }
                                        // else {
                                        //     $result = array('number' => '2', 'msg' => $voucher_update_id);
                                        // }
                                }else{
                                    $result = array('number' => '1', 'msg' => 'Saved in Draft');
                                }
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $purchase_update_id);
                            }							
                        }

                    
               
                }
                if(!empty($purchase_balance) && $purchase_balance == 1) {
                    // echo $purchase_entry_number;
                    $bill_company_id = $GLOBALS['bill_company_id']; $bill_id = $purchase_entry_id; $bill_date = $purchase_entry_date;$credit  = 0; $debit = 0; $bill_type ="Purchase Entry";$bill_number = $purchase_entry_number; $party_name =""; $party_type = "Purchase Party"; $payment_mode_id = $GLOBALS['null_value']; $payment_mode_name = $GLOBALS['null_value'];$bank_id =  $GLOBALS['null_value'];$bank_name =  $GLOBALS['null_value']; $open_balance_type = "Credit"; $payment_tax_type = $GLOBALS['null_value'];


                    $credit  = $total_amount; 
                    
                    if(empty($credit)){
                        $credit = 0;
                    }
                    if(empty($debit)){
                        $debit = 0;
                    }
                    if(empty($opening_balance)){
                        $opening_balance = 0;
                    }
                    if(empty($opening_balance_type)){
                        $opening_balance_type = $GLOBALS['null_value'];
                    }
                    if(!empty($party_id)){
                        $party_name = $obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$party_id,'party_name');
                    }
                    $update_balance ="";
                    $update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type, $payment_tax_type,'');

                }
                if(!empty($balance) && $balance == 1 && !empty($payment_updation) && $payment_updation == 1) {
                    $credit  = 0; $debit = 0; $bill_type ="Voucher"; $party_type = "Purchase Party"; $open_balance_type = "Debit"; $voucher_amounts = array();
                    
                    if(!empty($payment_mode_ids)) {
                        $payment_mode_id = explode(',', $payment_mode_ids);
                        $payment_mode_id = array_reverse($payment_mode_id);
                    }
                    if(!empty($payment_tax_types)) {
                        $payment_tax_type = explode(',', $payment_tax_types);
                        $payment_tax_type = array_reverse($payment_tax_type);
                    }

                    if(!empty($bank_ids)  && $bank_ids != $GLOBALS['null_value']) {
                        $bank_id = explode(',', $bank_ids);
                        $bank_id = array_reverse($bank_id);
                    }else{
                        $bank_id = array();
                    }
                    // print_r($bank_id);
                    if(!empty($payment_mode_names)) {
                        $payment_mode_name = explode(',', $payment_mode_names);
                        $payment_mode_name = array_reverse($payment_mode_name);
                    }
                    if(!empty($bank_names)  && $bank_names != $GLOBALS['null_value']) {
                        $bank_name = explode(',', $bank_names);
                        $bank_name = array_reverse($bank_name);
                    }else{
                        $bank_name = array();
                    }
                    if(!empty($voucher_amount)) {
                        $voucher_amounts = explode(',', $voucher_amount);
                        $voucher_amounts = array_reverse($voucher_amounts);
                    }
                    $balance_type = 'Debit';

                    $bill_id = $voucher_id;
                    $bill_date = $voucher_date;
                    $bill_number =  $voucher_number;
                    if(!empty($payment_mode_id)){
                        for($i = 0; $i < count($payment_mode_id); $i++) {

                            $imploded_amount = $voucher_amounts[$i];
                    
                            $debit = $voucher_amounts[$i];
                            $credit = 0;

                                if(empty($bank_id[$i])){
                                    $bank_id[$i] = $GLOBALS['null_value'];
                                }
                                if(empty($bank_name[$i])){
                                    $bank_name[$i] = $GLOBALS['null_value'];
                                }

                            $update_balance ="";
                            $update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$payment_mode_id[$i],$payment_mode_name[$i],$bank_id[$i],$bank_name[$i],$credit,$debit, $balance_type, $payment_tax_type[$i],'');

                        }
                    } 
                }
                
            
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }else {
            if(!empty($valid_purchase)) {
                $result = array('number' => '3', 'msg' => $valid_purchase);
            }
            else if(!empty($product_error)) {
                $result = array('number' => '2', 'msg' => $product_error);
            }
            else if(!empty($purchase_entry_error)) {
                $result = array('number' => '2', 'msg' => $purchase_entry_error);
            }
            else if(!empty($payment_error)) {
                $result = array('number' => '2', 'msg' => $payment_error);   
            }
            
        }
        
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;

    }

    if(isset($_REQUEST['product_row_index']))
    {
        $product_id = $_REQUEST['selected_product_id'];
        $selected_unit_type = $_REQUEST['selected_unit_id'];
        $selected_quantity = $_REQUEST['selected_quantity'];
        $total_quantity = $_REQUEST['total_qty'];
        $rate = $_REQUEST['selected_rate'];
        $amount = $_REQUEST['selected_amount'];
        $product_row_index = $_REQUEST['product_row_index'];
        $final_rate = $_REQUEST['final_rate'];
        $tax_option = $_REQUEST['tax_option'];
        $tax_type =$_REQUEST['tax_type'];

        $selected_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'unit_id');
        
        $product_tax = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$product_id,'tax_slab');

        if($tax_option == '2' && $tax_type == '1')
        {
            if(!empty($product_tax))
            {
                $tax = str_replace("%","",$product_tax);
                if($tax != "" && $tax != $GLOBALS['null_value']){
                    $final_rate =$final_rate -( ($final_rate * $tax)/(100+$tax));
                }
                
                // echo $final_rate;
            }
            
        }
        
        if(!empty($final_rate))
        {
            $final_rate = floor($final_rate * 100) / 100;
            
        }
        $amount =$final_rate * $selected_quantity;

        ?>
        <tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
            <th class="text-center px-2 py-2 sno"><?php if(!empty($product_row_index)) { echo $product_row_index; } ?></th>
            <th class="text-center px-2 py-2">
                <?php
                    if(!empty($product_id)) {
                        $product_name = "";
                        $product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $product_id, 'product_name');
                        if(!empty($product_name) && $product_name != $GLOBALS['null_value']) {
                            echo $obj->encode_decode('decrypt', $product_name);
                        }
                    }
                ?>
                <input type="hidden" name="product_id[]" value="<?php if(!empty($product_id)) { echo $product_id; } ?>"><br>
                
            </th>
            <th class="text-center px-2 py-2">
                <?php
                    if(!empty($selected_unit_id)) {
                        $unit_name = "";
                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $selected_unit_id, 'unit_name');
                        if(!empty($unit_name) && $unit_name != $GLOBALS['null_value']) {
                            echo $obj->encode_decode('decrypt', $unit_name);
                        }
                    }
                ?>

                <input type="hidden" name="unit_id[]" value="<?php if(!empty($selected_unit_id)) { echo $selected_unit_id; } ?>">
            </th>
            <th class="text-center px-2 py-2">
                <input type="text" name="quantity[]" class="form-control shadow-none" value="<?php if(!empty($selected_quantity)) { echo $selected_quantity; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
            </th>
            
            <th class="text-center px-2 py-2" style="width: 100px;">
                <input type="text" name="rate[]" class="form-control shadow-none" value="<?php if(!empty($rate)) { echo $rate; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" onkeyup="Javascript:ProductRowCheck(this);">
                <p class=" text-success inclusiv_final_rate final_rate"><?php if(!empty($final_rate)){ echo "Final Rate : ".$final_rate; }?></p>
                <input type="hidden" name="final_rate[]" class="form-control shadow-none" value="<?php if(!empty($rate)) { echo $rate; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" >
            </th>
            <th class="tax_element text-center px-2 py-2 d-none">
                <div class="form-group">
                    <div class="form-label-group in-border mb-0">
                        <select class="select2 select2-danger" name="product_tax[]" data-dropdown-css-class="select2-danger" style="width: 100%;"  onchange="ProductRowCheck(this);ShowGST();">
                            <option value="">Select</option>
                            <option value="0%" <?php if($product_tax == '0%'){ ?>selected<?php } ?>>0%</option>
                            <option value="5%" <?php if($product_tax == '5%'){ ?>selected<?php } ?>>5%</option>
                            <option value="12%" <?php if($product_tax == '12%'){ ?>selected<?php } ?>>12%</option>
                            <option value="18%" <?php if($product_tax == '18%'){ ?>selected<?php } ?>>18%</option>
                            <option value="28%" <?php if($product_tax == '28%'){ ?>selected<?php } ?>>28%</option>
                        </select>
                        <label>Tax</label>
                    </div>
                </div>
            </th>
            
            <th class="text-center px-2 py-2">
                <input type="text" name="amount[]" class="form-control shadow-none" value="<?php if(!empty($amount)) { echo $amount; } ?>" onfocus="Javascript:KeyboardControls(this,'number',8,'');" readonly>
            </th>
            <th class="text-center px-2 py-2">
                <button class="btn btn-danger" type="button" onclick="Javascript:DeletePurchaseRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>', 'product_row');"><i class="fa fa-trash"></i></button>
            </th>
        </tr>
        <script type="text/javascript">
            if(jQuery('tr#product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>').find('select').length > 0) {
                jQuery('tr#product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>').find('select').select2();
            }
        </script>
        <?php
    }

    if(isset($_REQUEST['delete_purchase_entry_id'])) {
        $delete_purchase_entry_id = $_REQUEST['delete_purchase_entry_id'];
        $delete_purchase_entry_id = trim($delete_purchase_entry_id);
        $msg = "";
        if(!empty($delete_purchase_entry_id)) {	
            $purchase_entry_unique_id = ""; $voucher_unique_id = ""; $voucher_id = "";
            $purchase_entry_unique_id = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $delete_purchase_entry_id, 'id');
            $voucher_id = $obj->getTableColumnValue($GLOBALS['voucher_table'], 'purchase_entry_id', $delete_purchase_entry_id, 'voucher_id');
            if(preg_match("/^\d+$/", $purchase_entry_unique_id)) {
                $bill_number = "";
                $bill_number = $obj->getTableColumnValue($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $delete_purchase_entry_id, 'purchase_entry_number');
            
                $action = "";
                $payment_delete = "";
                $payment_delete = $obj->DeletePurchaseEntryInVoucher($delete_purchase_entry_id);
                $delete_id = $obj->DeletePayment($delete_purchase_entry_id);

                    $payment_bill_list = array(); $payment_unique_id = "";

                    $payment_bill_list = $obj->getTableRecords($GLOBALS['payment_table'], 'bill_id', $voucher_id,'');
                    if(!empty($payment_bill_list)){
                        foreach($payment_bill_list as $value){
                            if(!empty($value['id'])){
                                $payment_unique_id = $value['id'];
                            }
                            if(preg_match("/^\d+$/", $payment_unique_id)) {
                                $action = "Payment Deleted.";
                            
                                $columns = array(); $values = array();						
                                $columns = array('deleted');
                                $values = array("'1'");
                                $msg = $obj->UpdateSQL($GLOBALS['payment_table'], $payment_unique_id, $columns, $values, $action);
                            }
                        }
                    }
                // if($payment_delete == '1') {
             

                    $columns = array(); $values = array();			
                    $columns = array('cancelled');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['purchase_entry_table'], $purchase_entry_unique_id, $columns, $values, $action);


                // }
                // else {
                //     $msg = "Can't Delete.";
                // }
            }
            else {
                $msg = "Invalid Purchase";
            }
        }
        else {
            $msg = "Empty Purchase";
        }
        echo $msg;
        exit;	
    } 
    ?>