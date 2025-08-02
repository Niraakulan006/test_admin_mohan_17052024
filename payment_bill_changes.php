<?php
include("include_files.php");

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
        <td class="sno text-center">
            <?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>
        </td>
           <?php if(!empty($payment_tax_type)) { ?>
                <td>
                <?php 
                        /* if(!empty($payment_tax_type)) { ?>
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select name="payment_tax_type" class="select2 select2-danger smallfnt form-control" style="width:100% !important;">
                                        <option value="">Select Tax type</option>
                                        <option value="1" <?php if(!empty($payment_tax_type) && ($payment_tax_type == 1)) { ?> selected <?php } ?>>with tax</option>
                                        <option value="2" <?php if(!empty($payment_tax_type) && ($payment_tax_type == 2)) { ?> selected <?php } ?>>without tax</option>
                                    </select>
                                    <label>Tax Type <span class="text-danger">*</span></label>
                                </div>
                            </div>
                    <?php } */ 
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
            <input type="text" name="amount[]" style="width:75%!important;margin:auto!important;" class="form-control shadow-none px-1 text-center" value="<?php if(!empty($amount)) { echo $amount; } ?>" onfocus="Javascript:KeyboardControls(this,'number','','');" onkeyup="Javascript:PaymentTotal();InputBoxColor(this, 'text');">
        </td>
        
        <td class="text-center">
            <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('payment_row', '<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>');"><i class="fa fa-trash"></i></button>
        </td>
    </tr>
    <?php
}

if(isset($_REQUEST['selected_bank_payment_mode'])) {
	$selected_bank_payment_mode = "";
	$selected_bank_payment_mode = $_REQUEST['selected_bank_payment_mode'];
	
	if(!empty($selected_bank_payment_mode)) {
		$bank_list = array();
        $bank_list = $obj->getTableRecords($GLOBALS['bank_table'], 'bill_company_id', $GLOBALS['bill_company_id'],'');
        $filtered_banks = array();
        foreach($bank_list as $bank) {
            $payment_modes = explode(',', $bank['payment_mode_id']);
            if (in_array($selected_bank_payment_mode, $payment_modes)) {
                $filtered_banks[] = $bank;
            }
        }

		if(!empty($filtered_banks)){
		    ?>
                <option value="">Select Bank</option>
                <?php
                    foreach ($filtered_banks as $list){
                        ?>
                        <option value="<?php if(!empty($list['bank_id'])){echo $list['bank_id'];} ?>" <?php if(!empty($bank_id) && $list['bank_id'] == $bank_id){ ?>selected<?php } ?>> 
                        <?php
                            $account_name = "";
                            $account_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $list['bank_id'], 'bank_name');
                            if(!empty($account_name)) {
                                $account_name = $obj->encode_decode('decrypt', $account_name);
                                echo $account_name;
                            }
                            ?>
                        </option>
                        <?php
                    }
                ?>
			<?php
		}

    }
}

if(isset($_REQUEST['bill_type'])) {
    $type = $_REQUEST['bill_type'];

    $accbalance =$obj->OpeningAccBal($type);
    if(!empty($accbalance)){
        echo $accbalance;
    }else{
        echo "";
    }
    
}

if(isset($_REQUEST['bank_id'])) {
    $bank_id = $_REQUEST['bank_id'];
    $balance_type = $_REQUEST['type'];
    $accbalance = "";
    $accbalance =$obj->AccBal($bank_id,$balance_type);
    if(!empty($accbalance)){
        echo $accbalance;
    }else{
        echo "";
    }

} 

if(isset($_REQUEST['selected_tax_type'])) {
    $tax_type = $_REQUEST['selected_tax_type'];
    $payment_mode_id = $_REQUEST['selected_payment_mode'];
    $bank_id = $_REQUEST['selected_bank'];

    $available_balance = 0;
    $available_balance = $obj->checkAvailableBalance($GLOBALS['bill_company_id'], $tax_type, $payment_mode_id, $bank_id);

    echo $available_balance; 
}
if (isset($_REQUEST['get_payment_mode_id'])) {
    $payment_mode_id = trim($_REQUEST['get_payment_mode_id']);
    $bank_id = trim($_REQUEST['get_bank_id']);
    $payment_tax_type = trim($_REQUEST['get_payment_tax_type']);
    if(!empty($payment_tax_type) && !empty($payment_mode_id)){
        $total_amount = 0;
        $total_amount = $obj->GetPaymentAmount($payment_tax_type,$payment_mode_id, $bank_id, $login_branch_id);
        if(!empty($total_amount)){
             echo $total_amount;
        }else{
            echo "0";
        }           
    }                                                     
}

if(isset($_REQUEST['view_party_details'])) {
    $type_id = $_REQUEST['view_party_details'];
    $type_id = trim($type_id);
    $type = $_REQUEST['details_type'];
    $type = trim($type);
    $details_list = array();
    if(!empty($type)) {
        $details_list = $obj->getTableRecords($GLOBALS[$type.'_table'], $type.'_id', $type_id, '');
        

        if(!empty($details_list)) {
            foreach($details_list as $data) {
                if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                    $name = $obj->encode_decode('decrypt', $data['name']);
                }
                if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
                    $address = $obj->encode_decode('decrypt', $data['address']);
                }
                if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                    $city = $obj->encode_decode('decrypt', $data['city']);
                }
                if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
                    $district = $obj->encode_decode('decrypt', $data['district']);
                }
                if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
                    $state = $obj->encode_decode('decrypt', $data['state']);
                }
                if(!empty($data['pincode']) && $data['pincode'] != $GLOBALS['null_value']) {
                    $pincode = $obj->encode_decode('decrypt', $data['pincode']);
                }
                if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                    $mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
                }
                if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
                    $email = $obj->encode_decode('decrypt', $data['email']);
                }
                if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
                    $identification = $obj->encode_decode('decrypt', $data['identification']);
                }
            }	
        }

        ?>
        <?php if(!empty($name) && $name != $GLOBALS['null_value']){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Name </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($name)){ echo ": " .$name; }?> </div>
                </div>
            </div>
        <?php  } ?>
        <?php if(!empty($mobile_number) && $mobile_number != $GLOBALS['null_value']){ ?>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Phone Number </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($mobile_number)){ echo ": " .$mobile_number; }?> </div>
                </div>
            </div>
        <?php  } ?>
        <?php if(!empty($email) && ($email != 'NULL')){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Email </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($email)){ echo ": " .$email; }?> </div>
                </div>
            </div> <?php
        } ?>
        <?php if(!empty($address) && ($address != 'NULL')){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Address </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($address)){ echo ": " .$address; }?> </div>
                </div>
            </div> <?php
        } 
        if(!empty($city) && ($city != 'NULL')){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>City </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($city)){ echo ": " .$city; }?> </div>
                </div>
            </div> <?php
        } ?>
        <?php if(!empty($district) && ($district != 'NULL')){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>District </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($district)){ echo ": " .$district; }?> </div>
                </div>
            </div> <?php
        } ?>
        <?php if(!empty($state) && ($state != 'NULL')){ ?>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>State </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($state)){ echo ": " .$state; }?> </div>
                </div>
            </div>
             <?php
        } ?>
        <?php if(!empty($identification) && ($identification != 'NULL')){ ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 col-xl-12 d-flex">
                    <div class="col-lg-4 col-xl-4 col-sm-6"><b>Identification </b></div>
                    <div class="col-lg-8 col-xl-8 col-sm-6" style="margin: 0 -35px;"><?php if(!empty($identification)){ echo ": " .$identification; }?> </div>
                </div>
            </div> <?php
        }  
    
    }
}

if(isset($_REQUEST['party_id'])) {
    $party_id = $_REQUEST['party_id'];
    $party_id = trim($party_id);

    $party_type = $_REQUEST['type'];
    $party_type = trim($party_type);

    $list = array();
    $list = $obj->getPendingList($party_id);

    $party_name = ""; $opening_balance = 0; $opening_balance_type = "";
    if($party_type == 'party') {
        $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'name_mobile_city');
        $party_name = $obj->encode_decode('decrypt', $party_name);
        $opening_balance = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'opening_balance');
        $opening_balance_type = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'opening_balance_type');
    }
    $current_balance = 0; $current_type = "";
    ?>
    <div class="col-12">
        <table class="table table-bordered nowrap cursor text-center smallfnt" style="font-size:15px; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Bill No<br>Date</th>
                    <th>Bill Type</th>
                    <th>Particulars</th>
                    <th>Credit</th>
                    <th>Debit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total_credit = 0; $total_debit = 0;
                    if(!empty($opening_balance) && $opening_balance != $GLOBALS['null_value']) {
                        ?>
                            <?php /*

                        <tr>
                            <td colspan="4" class="text-end text-primary" style="font-weight:bold;">
                                Opening Balance
                            </td>
                            <td class="text-end text-success">
                                <?php
                                    if($opening_balance_type == 'Credit') {
                                        $total_credit += $opening_balance;
                                        echo $obj->numberFormat($opening_balance,2).'&nbsp';
                                    }
                                    else {
                                        echo '-';
                                    }
                                ?>
                            </td>
                        
                            <td class="text-end text-danger">
                                <?php
                                    if($opening_balance_type == 'Debit') {
                                        $total_debit += $opening_balance;
                                        echo $obj->numberFormat($opening_balance,2).'&nbsp';
                                    }
                                    else {
                                        echo '-';
                                    }
                                ?>
                            </td>
                        </tr>
                                */ ?>

                        <?php
                    }
                    
                    $s_no = 1;
                    if(!empty($list)){
                        $prev_bill_number = "";
                        foreach($list as $data){ ?>
                            <tr>
                                <td class="text-center px-2 py-2">
                                    <?php echo $s_no; ?>
                                </td>
                                <td class="text-center px-2 py-2">
                                    <?php
                                        if(!empty($data['bill_number']) && $data['bill_number'] != $GLOBALS['null_value']){
                                            $bill_number = $data['bill_number'];
                                            echo $bill_number;
                                            echo "<br>";

                                        } 
                                        // else {
                                        //     echo " - ";
                                        // }
                                        
                                        if(!empty($data['bill_date']) && $data['bill_type'] != 'Opening Balance'){
                                            echo date('d-m-Y', strtotime($data['bill_date']));
                                        }
                                        //  else {
                                        //     echo " - ";
                                        // }
                                        
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($data['bill_type'])){
                                            echo $data['bill_type'];
                                        } 
                                        //  else {
                                        //     echo " - ";
                                        // }
                                        if(!empty($data['payment_tax_type']) && $data['payment_tax_type'] != $GLOBALS['null_value']){

                                            echo "<br>";
                                            echo $data['payment_tax_type'] == '1' ? "(With Tax)" : "(Without Tax)";
                                        }
                                        //  else {
                                        //     echo " - ";
                                        // }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $detail = "";
                                        if (!empty($data['payment_mode_name']) && $data['payment_mode_name'] != $GLOBALS['null_value']) {
                                            $detail .= $obj->encode_decode('decrypt', $data['payment_mode_name']);
                                        }
                                        if (!empty($data['bank_name']) && $data['bank_name'] != 'NULL') {
                                            $detail .= " - (" . $obj->encode_decode('decrypt', $data['bank_name']) . ")";
                                        }

                                        echo $detail;
                                    ?>
                                </td>
                                <td class="text-end text-success">
                                    <?php
                                        if(!empty($data['credit']) && $data['credit'] != $GLOBALS['null_value']) {
                                            $total_credit += $data['credit'];
                                            echo $obj->numberFormat($data['credit'],2).'&nbsp';
                                        }
                                        else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                                <td class="text-end text-danger">
                                    <?php
                                        if(!empty($data['debit'] && $data['debit'] != $GLOBALS['null_value'])) {
                                            $total_debit += $data['debit'];
                                            echo $obj->numberFormat($data['debit'],2).'&nbsp';
                                        }
                                        else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            if($prev_bill_number != $data['bill_number']){
                                $s_no++;
                            }
                            
                            $prev_bill_number = $data['bill_number'];
                        }
                        
                    }
                    else { ?>
                        <tr>
                            <td colspan="6" class="text-center">Sorry! No records found</td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <?php
                            if($total_credit > $total_debit) {
                                $current_balance = $total_credit - $total_debit;
                                $current_type = " Cr";
                            }
                            else if($total_credit < $total_debit) {
                                $current_balance = $total_debit - $total_credit;
                                $current_type = " Dr";
                            }
                        ?>
                        <?php if(!empty($total_credit) || (!empty($total_debit))){ ?>
                            <td class="text-danger" colspan="6" style="font-weight:bold;">
                                Current Balance : 
                                <?php
                                    echo $obj->numberFormat($current_balance,2).$current_type;
                                ?>
                            </td>
                        <?php } ?>
                    </tr>
            </tbody>
        </table>
    </div>
    <?php
    echo "$$$".$party_name." <span class='text-center text-danger'>(Balance : ".($obj->numberFormat($current_balance,2).$current_type).")</span>"; 
}



if(isset($_REQUEST['lr_details_party_id'])) {
    $bill_type = ""; $party_id = ""; $party_type = "";
    $party_id = $_REQUEST['lr_details_party_id'];
    $party_id = trim($party_id);

    $party_type = $_REQUEST['party_type'];
    $party_type = trim($party_type);
    if(!empty($party_type)){
        if($party_type == 'consignor'){
            $bill_type = 'Paid';
        }else if($party_type == 'consignee'){
            $bill_type = 'ToPay';
        }else{
            $bill_type = 'Account Party';
        }
    }

    $lr_number_list = array();
    if(!empty($party_id) && !empty($party_type)){
        	$lr_number_list = $obj->GetLRNumberList($party_type, $party_id,$bill_type,$login_branch_id);
            ?>
            <option value="">Select</option>
            <?php
            if(!empty($lr_number_list)) {
                foreach($lr_number_list as $data) {
                    if(!empty($data['lr_id']) && $data['lr_id'] != $GLOBALS['null_value']) {
                        //     $lr_amount = 0; $receipt_amounts = array(); $receipt_amt = 0;

                        //    $lr_amount = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $data['lr_id'], 'total');
                        //     $receipt_amounts = $obj->getTableRecords($GLOBALS['receipt_table'], 'lr_id', $data['lr_id']);
                        //     if(!empty($receipt_amounts)){
                        //         foreach($receipt_amounts as $amt_list){
                        //             if(!empty($amt_list['total_amount'])){
                        //                 $receipt_amt += $amt_list['total_amount']; 
                        //             }
                        //         }
                                
                        //     }
                        //     echo $receipt_amt ."/".$lr_amount;
                        //     if($receipt_amt != $lr_amount) {
                                   $lr_number = "";
                                    $lr_number = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$data['lr_id'],'lr_number');
                                    ?>
                                    <option value="<?php if(!empty($data['lr_id'])){ echo $data['lr_id']; } ?>">
                                        <?php
                                            if(!empty($lr_number) && $lr_number != $GLOBALS['null_value']) {
                                                echo  $lr_number;
                                            }
                                        ?>
                                    </option>
                                    <?php
                            }
                    // }
                }
            }
       
        
    } else{ ?>
            <option value="">Select</option>

        <?php
    }
}




if(isset($_REQUEST['receipt_lr_id'])) {
    $lr_id = ""; $lr_amount = 0; $receipt_amounts = array(); $receipt_amt = 0;
    $lr_id = $_REQUEST['receipt_lr_id'];
    $lr_id = trim($lr_id);

    if(!empty($lr_id)){
        $lr_amount = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $lr_id, 'total');
        $receipt_amounts = $obj->getTableRecords($GLOBALS['receipt_table'], 'lr_id', $lr_id);
        // print_r($receipt_amounts);
        if(!empty($receipt_amounts)){
            foreach($receipt_amounts as $list){
                if(!empty($list['total_amount'])){
                    $receipt_amt += $list['total_amount']; 
                }
            }
            
        }
    }
    if(!empty($lr_amount)){
        echo "LR Amount : Rs. ".$lr_amount;
    } ?>
    $$$
    <?php
    if(!empty($receipt_amt)){
        echo "Paid Amount :Rs. ". $receipt_amt;
    }
}


if(isset($_REQUEST['listing_party_details_party_id'])) {
    $party_id = $_REQUEST['listing_party_details_party_id'];
    $party_id = trim($party_id);

    $party_type = $_REQUEST['type'];
    $party_type = trim($party_type);

    $list = array();
    $list = $obj->getPendingList($party_id);

    $party_name = ""; $opening_balance = 0; $opening_balance_type = ""; $mobile_number = "";
    if(!empty($party_type)) {
        $party_name = $obj->getTableColumnValue($GLOBALS[$party_type.'_table'], $party_type."_id", $party_id, 'name');
        $party_name = $obj->encode_decode('decrypt', $party_name);
          $mobile_number = $obj->getTableColumnValue($GLOBALS[$party_type.'_table'], $party_type."_id", $party_id, 'mobile_number');
        $mobile_number = $obj->encode_decode('decrypt', $mobile_number);
        if(!empty($mobile_number) && $mobile_number != $GLOBALS['null_value']){
            $party_name .= " - (".$mobile_number.")";
        }
        // $opening_balance = $obj->getTableColumnValue($GLOBALS[$party_type.'_table'], "'".$party_type."_id'", $party_id, 'opening_balance');
        // $opening_balance_type = $obj->getTableColumnValue($GLOBALS[$party_type.'_table'], "'".$party_type."_id'", $party_id, 'opening_balance_type');
    }
    $current_balance = 0; $current_type = "";
    ?>
    <div class="col-12">
        <table class="table table-bordered nowrap cursor text-center smallfnt" style="font-size:15px; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Bill No<br>Date</th>
                    <th>Bill Type</th>
                    <th>Particulars</th>
                    <th>Credit</th>
                    <th>Debit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total_credit = 0; $total_debit = 0;
                    if(!empty($opening_balance) && $opening_balance != $GLOBALS['null_value']) {
                       /* ?>
                        <tr>
                            <td colspan="4" class="text-end text-primary" style="font-weight:bold;">
                                Opening Balance
                            </td>
                            <td class="text-end text-success">
                                <?php
                                    if($opening_balance_type == 'Credit') {
                                        $total_credit += $opening_balance;
                                        echo $obj->numberFormat($opening_balance,2).'&nbsp';
                                    }
                                    else {
                                        echo '-';
                                    }
                                ?>
                            </td>
                            <td class="text-end text-danger">
                                <?php
                                    if($opening_balance_type == 'Debit') {
                                        $total_debit += $opening_balance;
                                        echo $obj->numberFormat($opening_balance,2).'&nbsp';
                                    }
                                    else {
                                        echo '-';
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php*/
                    } 
                    
                    $s_no = 1;
                    if(!empty($list)){
                        $prev_bill_number = "";
                        foreach($list as $data){ ?>
                            <tr>
                                <td class="text-center px-2 py-2">
                                    <?php echo $s_no; ?>
                                </td>
                                <td class="text-center px-2 py-2">
                                    <?php
                                        if(!empty($data['bill_number']) && $data['bill_number'] != $GLOBALS['null_value']){
                                            $bill_number = $data['bill_number'];
                                            echo $bill_number;
                                            echo "<br>";
                                        } 
                                        // else {
                                        //     echo " - ";
                                        // }
                                        
                                        if(!empty($data['bill_date']) && $data['bill_type'] != 'Opening Balance'){
                                            echo date('d-m-Y', strtotime($data['bill_date']));
                                        }
                                        //  else {
                                        //     echo " - ";
                                        // }
                                        
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($data['bill_type'])){
                                            echo $data['bill_type'];
                                        }  
                                        // else {
                                        //     echo " - ";
                                        // }
                                        if(!empty($data['payment_tax_type']) && $data['payment_tax_type'] != $GLOBALS['null_value']){

                                            echo "<br>";
                                            echo $data['payment_tax_type'] == '1' ? "(With Tax)" : "(Without Tax)";
                                            echo "<br>";

                                        } 
                                        // else {
                                        //     echo " - ";
                                        // }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $detail = "";
                                        if (!empty($data['payment_mode_name']) && $data['payment_mode_name'] != $GLOBALS['null_value']) {
                                            $detail .= $obj->encode_decode('decrypt', $data['payment_mode_name']);
                                        }
                                        if (!empty($data['bank_name']) && $data['bank_name'] != 'NULL') {
                                            $detail .= " - (" . $obj->encode_decode('decrypt', $data['bank_name']) . ")";
                                        }

                                        echo $detail;
                                    ?>
                                </td>
                                <td class="text-end text-success">
                                    <?php
                                        if(!empty($data['credit']) && $data['credit'] != $GLOBALS['null_value']) {
                                            $total_credit += $data['credit'];
                                            echo $obj->numberFormat($data['credit'],2).'&nbsp';
                                        }
                                        else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                                <td class="text-end text-danger">
                                    <?php
                                        if(!empty($data['debit'] && $data['debit'] != $GLOBALS['null_value'])) {
                                            $total_debit += $data['debit'];
                                            echo $obj->numberFormat($data['debit'],2).'&nbsp';
                                        }
                                        else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            if($prev_bill_number != $data['bill_number']){
                                $s_no++;
                            }
                            
                            $prev_bill_number = $data['bill_number'];
                        }
                        
                    }
                    else { ?>
                        <tr>
                            <td colspan="6" class="text-center">Sorry! No records found</td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <?php
                            if($total_credit > $total_debit) {
                                $current_balance = $total_credit - $total_debit;
                                $current_type = " Cr";
                            }
                            else if($total_credit < $total_debit) {
                                $current_balance = $total_debit - $total_credit;
                                $current_type = " Dr";
                            }
                        ?>
                        <?php if(!empty($total_credit) || (!empty($total_debit))){ ?>
                            <td class="text-danger" colspan="6" style="font-weight:bold;">
                                Current Balance : 
                                <?php
                                    echo $obj->numberFormat($current_balance,2).$current_type;
                                ?>
                            </td>
                        <?php } ?>
                    </tr>
            </tbody>
        </table>
    </div>
    <?php
    echo "$$$".$party_name." <span class='text-center text-danger'>(Balance : ".($obj->numberFormat($current_balance,2).$current_type).")</span>"; 
}

?>