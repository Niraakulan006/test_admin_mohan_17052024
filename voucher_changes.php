<?php
	include("include_files.php");
    
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['voucher_module'];
        }
    }
    
	if(isset($_REQUEST['show_voucher_id'])) {
        $show_voucher_id = $_REQUEST['show_voucher_id'];
        $voucher_date = date("Y-m-d"); 
        $selected_payment_mode = "";

        $payment_mode_list = array();
		// $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], '','','');
		$payment_mode_list = $obj->BankLinkedPaymentModes();

        
        $payment_mode_count = 0;
        $payment_mode_count = count($payment_mode_list);  

        $party_list = array();
        $party_list = $obj->getPartyList('Purchase');
        
        ?>
        <form class="poppins pd-20" name="voucher_form" method="POST">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
                        <?php if(!empty($show_voucher_id)) { ?>
    						<h5 class="text-white">Edit Voucher</h5>
                        <?php } else { ?>
                            <h5 class="text-white">Add Voucher</h5>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('voucher.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
			<div class="row p-3">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_voucher_id)) { echo $show_voucher_id; } ?>">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-md-3 col-12">
                            <div class="form-group pb-2">
                                <div class="form-label-group in-border">
                                <input type="date" class="form-control shadow-none" name="voucher_date" value="<?php if(!empty($voucher_date)) { echo $voucher_date; } ?>"  max="<?php if(!empty($voucher_date)) { echo $voucher_date; } ?>">
                                <label>Date(*)</label>
                                </div>
                            </div> 
                        </div>
                       
                        <div class="col-lg-3 col-md-3 col-12 party_display">
                            <div class="form-group pb-2">
                                <div class="form-label-group in-border mb-0">
                                    <select name="party_id" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2 select2-danger" onchange="Javascript:HideDetails('Party');">
                                        <option value="">Select</option>
                                        <?php
                                        if(!empty($party_list)) {
                                            foreach($party_list as $data) { ?>
                                                <option value="<?php if(!empty($data['party_id'])) { echo $data['party_id']; } ?>"> <?php
                                                    if(!empty($data['name_mobile_city'])) {
                                                        $data['name_mobile_city'] = html_entity_decode($obj->encode_decode('decrypt', $data['name_mobile_city']));
                                                        echo $data['name_mobile_city'];
                                                    } ?>
                                                </option> <?php
                                            }
                                        } ?>
                                    </select>
                                    <label>Party(*)</label> 
                                </div>
                                <a href="Javascript:ViewPartyDetails('party');" class="d-none details_element" style="font-size: 12px;font-weight: bold;">Click to view details</a><br>
                                <a href="Javascript:ViewPendingDetails('party');" class="d-none details_element" style="font-size: 12px;font-weight: bold;">Click to view Pending details</a>
                            </div>        
                            <!-- <div class="col-lg-12 col-md-4 col-12 py-2">
                                <div class="form-group">
                                    <div class="form-label-group in-border">
                                        <a href="Javascript:ViewPendingDetails('party');" class="d-none details_element" style="font-size: 12px;font-weight: bold;">Click to view Pending details</a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                            <div class="form-group pb-2">
                                <div class="form-label-group in-border">
                                <textarea class="form-control" id="narration" name="narration" placeholder="" onkeydown="Javascript:KeyboardControls(this,'',150,'');InputBoxColor(this,'text');return event.key !== 'Enter';"></textarea>
                                    <label>Narration(*)</label>
                                </div>
                                <div class="new_smallfnt">Max Char: 150(Except <>?{}!*^%$)</div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-md-2 col-12">
                            <div class="form-group">
                                <div class="form-label-group in-border mb-0" id="investment">
                                    <select name="selected_tax_type" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2 select2-danger" style="width: 100%;" onchange="javascript:GetPayment();">
                                        <option value="">Select</option>
                                        <option value="1">With Tax</option>
                                        <option value="2">Without Tax</option>
                                    </select>
                                    <label>Type(*)</label>  
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-2 col-md-2 col-6">
                            <div class="form-group pb-2">
                                <div class="form-label-group in-border mb-0">
                                    <select name="selected_payment_mode_id" class="select2 select2-danger smallfnt" style="width: 100%;" onchange="Javascript:getBankDetails(this.value);GetPayment();">
                                        <option value="">Select</option>
                                        <?php
                                            if(!empty($payment_mode_list)) {
                                                foreach($payment_mode_list as $data) { ?>
                                                    <option value="<?php if(!empty($data['payment_mode_id'])) { echo $data['payment_mode_id']; } ?>" <?php if(!empty($payment_mode_count) && $payment_mode_count == 1){ ?> selected <?php } ?>>
                                                        <?php
                                                            $selected_payment_mode = $data['payment_mode_id'];

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
                                    <label>Payment Mode</label>
                                </div>
                            </div>        
                        </div>
                        <div class="col-lg-2 col-md-2 col-12 d-none" id="bank_list">
                            <div class="form-group">
                                <div class="form-label-group in-border mt-0">
                                    <select name="selected_bank_id" class="select2 select2-danger smallfnt form-control" style="width:100% !important;" onchange="Javascript:GetPayment();">
                                        <option value="">Select Bank</option>
                                        <?php 
                                            if(!empty($bank_list)){
                                                foreach($bank_list as $col){
                                                    ?>
                                                    <option value="<?php if(!empty($col['bank_id'])){echo $col['bank_id'];} ?>" <?php if(!empty($bank_id) && $col['bank_id'] == $bank_id){ ?>selected<?php } ?>>
                                                        <?php 
                                                            if(!empty($col['bank_name'])){
                                                                echo $obj->encode_decode('decrypt',$col['bank_name'])." - ".$obj->encode_decode('decrypt',$col['account_number']);
                                                            }
                                                        ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    <label>Bank</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <div class="form-group pb-2">
                                <div class="form-label-group in-border">
                                <input type="text" name="selected_amount" class="form-control shadow-none" value="" placeholder="" onfocus="Javascript:KeyboardControls(this,'number','',1);" required>
                                <label>Amount</label>
                                </div>
                                <span class="payment text-danger fw-bold"></span>
                                <input type="hidden" name="available_balance" value="">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-12">
                            <button class="btn btn-danger add_payment_button" style="font-size:12px;" type="button" onclick="Javascript:AddPaymentRow();" name="append_button">
                                Add To Bill
                            </button>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center pt-3"> 
                        <div class="col-lg-8">
                            <div class="table-responsive text-center">
                            <input type="hidden" name="payment_row_count" value="0">
                                <table class="table nowrap cursor smallfnt w-100 table-bordered payment_row_table fw-bold">
                                    <thead class="bg-dark text-white smallfnt">
                                        <tr style="white-space:pre;">
                                            <th>#</th>
                                            <th style="width:200px;">Tax Type</th>
                                            <th style="width:400px;">Payment Mode</th>
                                            <th style="width:200px;">Bank Name</th>
                                            <th style="width:200px;">Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-end">Total Amount : </th>
                                            <th class="overall_total"></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 py-3 text-center">
                        <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent('voucher_form', 'voucher_changes.php', 'voucher.php');">
                            Submit
                        </button>
                    </div>
			</div>
            <script type="text/javascript">
                
                jQuery(document).ready(function() {
                    <?php 
                    if($payment_mode_count == 1){ ?>
                            getBankDetails('<?php if(!empty($selected_payment_mode)){ echo $selected_payment_mode; } ?>');
                    <?php } 

                    if(empty($show_voucher_id)){ ?>
                        GetPayment();
                        <?php 
                    } ?>
                    jQuery('.add_update_form_content').find('select').select2();
                    jQuery(".select2").on("select2:open", function () {
                        // Find the inner search field of the opened dropdown
                        var searchField = "";
                        searchField = document.querySelector(".select2-container--open .select2-search__field");
                        if (searchField) {
                            searchField.focus();
                        }
                    });

                    jQuery('input[name="selected_amount"]').on("keypress", function(e) {
                        if (e.keyCode == 13) {
                            if(jQuery('.add_payment_button').length > 0) {
                                jQuery('.add_payment_button').trigger('click');
                            }
                        }
                    });
                });
            </script>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script type="text/javascript" src="include/js/creation_modules.js"></script>
            <script type="text/javascript" src="include/js/payment.js"></script>
        </form>
	<?php
    } 

    if(isset($_POST['edit_id'])) {
        $voucher_date = ""; $voucher_date_error = "";$payment_tax_type="";$payment_tax_type_error=""; $party_id = ""; $party_id_error = "";$party_type = "";$payment_mode_ids = array(); $payment_tax_types = array(); $bank_ids = array(); $bank_names = array(); $payment_mode_names = array(); $amount = array(); $total_amount = 0; $payment_error = ""; $party_name = ""; $narration = ""; $narration_error = ""; $name_mobile_city = ""; $selected_payment_tax_type = "";  $selected_amount = ""; $selected_amount_error = ""; $selected_bank_id = ""; $selected_payment_mode_id = ""; $selected_payment_tax_type_error = ""; $selected_payment_mode_id_error = "";
        $form_name = "voucher_form"; $valid_voucher = "";  $voucher_number = "";

        $edit_id = "";
        if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
		}

        if(isset($_POST['voucher_date'])){
            $voucher_date = $_POST['voucher_date'];
            $voucher_date = trim($voucher_date);
            $voucher_date = date('d-m-Y', strtotime($voucher_date));
            $voucher_date_error = $valid->valid_date($voucher_date, 'Voucher Date', 1);
        }
        if(!empty($voucher_date_error)) {
            $valid_voucher = $valid->error_display($form_name, "voucher_date", $voucher_date_error, 'text');
        }

        // if(isset($_POST['payment_tax_type'])) {
		// 	$payment_tax_type = $_POST['payment_tax_type'];
        //     $payment_tax_type = trim($payment_tax_type);
        //     $payment_tax_type_error = $valid->common_validation($payment_tax_type, 'Investment Type', 'select');
		// }
        // if(!empty($payment_tax_type_error)){
        //     if(!empty($valid_voucher)) {
        //         $valid_voucher = $valid_voucher." ".$valid->error_display($form_name, "payment_tax_type", $payment_tax_type_error, 'select');
        //     }
        //     else {
        //         $valid_voucher = $valid->error_display($form_name, "payment_tax_type", $payment_tax_type_error, 'select');
        //     }
        // }

        if(isset($_POST['party_id'])) {
			$party_id = $_POST['party_id'];
            $party_id = trim($party_id);
            $party_id_error = $valid->common_validation($party_id, 'party', 'select');
		}
        if(!empty($party_id_error)){
            if(!empty($valid_voucher)) {
                $valid_voucher = $valid_voucher." ".$valid->error_display($form_name, "party_id", $party_id_error, 'select');
            }
            else {
                $valid_voucher = $valid->error_display($form_name, "party_id", $party_id_error, 'select');
            }
        }

        if(isset($_POST['selected_payment_mode_id'])){
            $selected_payment_mode_id = $_POST['selected_payment_mode_id'];
        }

        if(!empty($selected_payment_mode_id)){
            $payment_error = "Click Add Button to Append Payment";
        }

        if(isset($_POST['narration'])) {
            $narration = $_POST['narration'];
            $narration = trim($narration);
            
            if(empty($narration)) {
                $narration_error = "Enter Narration";
            }
        }
        if(!empty($narration_error)) {
            if(!empty($valid_voucher)) {
                $valid_voucher = $valid_voucher." ".$valid->error_display($form_name, "narration", $narration_error, 'textarea');
            }
            else {
                $valid_voucher = $valid->error_display($form_name, "narration", $narration_error, 'textarea');
            }
        }

        if(!empty($narration)) {
            $narration = htmlspecialchars($narration, ENT_QUOTES, 'UTF-8');
        }

        if(isset($_POST['selected_amount'])) {
            $selected_amount = $_POST['selected_amount'];
        }

        if(isset($_POST['selected_payment_mode_id'])) {
            $selected_payment_mode_id = $_POST['selected_payment_mode_id'];
        }

        if(isset($_POST['selected_bank_id'])) {
            $selected_bank_id = $_POST['selected_bank_id'];
        }

        if(isset($_POST['payment_tax_type'])) {
            $payment_tax_types = $_POST['payment_tax_type'];
            $payment_tax_types = array_reverse($payment_tax_types);
        }

        if(isset($_POST['payment_mode_id'])) {
            $payment_mode_ids = $_POST['payment_mode_id'];
            $payment_mode_ids = array_reverse($payment_mode_ids);
        }
        if(isset($_POST['bank_id'])) {
            $bank_ids = $_POST['bank_id'];
            $bank_ids = array_reverse($bank_ids);
        }
        if(isset($_POST['amount'])) {
            $amount = $_POST['amount'];
            $amount = array_reverse($amount);
        }
 

        if(!empty($payment_mode_ids)) {
            for($i=0; $i < count($payment_mode_ids); $i++) {
                $payment_mode_ids[$i] = trim($payment_mode_ids[$i]);
                $payment_tax_types[$i] = trim($payment_tax_types[$i]);
                $payment_mode_name = "";
                $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_ids[$i], 'payment_mode_name');
                $payment_mode_names[$i] = $payment_mode_name;
                
                $bank_ids[$i] = trim($bank_ids[$i]);
                if(!empty($bank_ids[$i])) {
                    $bank_name = "";
                    $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_ids[$i], 'bank_name');
                    if(!empty($bank_name) && $bank_name != $GLOBALS['null_value']) {
                        $bank_names[$i] = $bank_name;
                    }
                    else {
                        $bank_names[$i] = "";
                    }
                }
                else {
                    $bank_ids[$i] = "";
                    $bank_names[$i] = "";
                }
                $amount[$i] = trim($amount[$i]);
                if(isset($amount[$i])) {
                    $amount_error = "";
                    $amount_error = $valid->valid_price($amount[$i], 'Amount', '1', '');
                    if(!empty($amount_error)) {
                        if(!empty($valid_voucher)) {
                            $valid_voucher = $valid_voucher." ".$valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                        else {
                            $valid_voucher = $valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                    }
                    else {
                        $total_amount += $amount[$i];
                    }
                }

                $available_balance = 0; $type_display ="";
                $available_balance =$obj->GetPaymentAmount($payment_tax_types[$i],$payment_mode_ids[$i],$bank_ids[$i],$login_branch_id);

                if($payment_tax_types[$i] == '1'){
                    $type_display = "with tax";
                }else{
                    $type_display = "without tax";
                }

                if(!empty($amount[$i])){
                    // echo $amount[$i].'/'.$available_balance;
                    if($amount[$i] > $available_balance){
                        $payment_error = "Max Amount in Payment Mode -  ".$obj->encode_decode('decrypt',$payment_mode_names[$i]). " and  Bank - ".$obj->encode_decode('decrypt',$bank_names[$i]) . " ".$type_display ."  is Rs.".$available_balance;
                    }
                }

            }
        }
        else {
           if(count($payment_mode_ids) <= 0) {
                $selected_payment_mode_id_error = $valid->common_validation($selected_payment_mode_id, 'payment mode', 'select');
    
                if(!empty($valid_voucher)) {
                    $valid_voucher = $valid_voucher." ".$valid->error_display($form_name, "selected_payment_mode_id", $selected_payment_mode_id_error, 'select');
                }
                else {
                    $valid_voucher = $valid->error_display($form_name, "selected_payment_mode_id", $selected_payment_mode_id_error, 'select');
                }
            }
            if(count($payment_tax_types) <= 0) {
                $selected_payment_tax_type_error = $valid->common_validation($selected_payment_tax_type, 'Tax Type', 'select');
    
                if(!empty($valid_voucher)) {
                    $valid_voucher = $valid_voucher." ".$valid->error_display($form_name, "selected_tax_type", $selected_payment_tax_type_error, 'select');
                }
                else {
                    $valid_voucher = $valid->error_display($form_name, "selected_tax_type", $selected_payment_tax_type_error, 'select');
                }
            }

            if(count($amount) == 0) {
                $selected_amount_error = $valid->common_validation($selected_amount, 'Amount', 'text');
    
                if(!empty($valid_voucher)) {
                    $valid_voucher = $valid_voucher." ".$valid->error_display($form_name, "selected_amount", $selected_amount_error, 'text');
                }
                else {
                    $valid_voucher = $valid->error_display($form_name, "selected_amount", $selected_amount_error, 'text');
                }
            }
        }
        
        if(empty($valid_voucher) && empty($payment_error)) {
            $check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();
            $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
            $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
            $bill_company_id = $GLOBALS['bill_company_id']; 
            
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
				if(!empty($voucher_date)) {
					$voucher_date = date("Y-m-d", strtotime($voucher_date));
				}

                if(!empty($party_id)){
                    $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_name');
                    $name_mobile_city = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'name_mobile_city');
                    $party_type = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_type');
                } else {
                    $party_id = $GLOBALS['null_value'];
                    $party_name = $GLOBALS['null_value'];
                    $name_mobile_city = $GLOBALS['null_value'];
                    $party_type = $GLOBALS['null_value'];
                }

                if(!empty($payment_mode_ids)) {
                    $payment_mode_ids = array_reverse($payment_mode_ids);
                    $payment_mode_ids = implode(',', $payment_mode_ids);
                }
                else {
                    $payment_mode_ids = $GLOBALS['null_value'];
                }
                if(!empty($payment_tax_types)) {
                    $payment_tax_types = array_reverse($payment_tax_types);
                    $payment_tax_types = implode(',', $payment_tax_types);
                }
                else {
                    $payment_tax_types = $GLOBALS['null_value'];
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
                if(!empty($amount)) {
                    $amount = array_reverse($amount);
                    $amount = implode(',', $amount);
                }
                else {
                    $amount = $GLOBALS['null_value'];
                }
                if(!empty($narration)) {
                    $narration = $obj->encode_decode('encrypt', $narration);
                }
                else {
                    $narration = $GLOBALS['null_value'];
                }

                $balance = 0;	
                 
					$voucher_number = $obj->new_automate_number($GLOBALS['voucher_table'], 'voucher_number');
					//  $voucher_number = $obj->encode_decode('encrypt',$voucher_number);
                    if(empty($voucher_number)){
                        $voucher_number = $GLOBALS['null_value'];
                    }
                if(empty($edit_id)) {	
                    $action = "";
					if(!empty($party_name) && $party_name != $GLOBALS['null_value']) {
						$action = "New Voucher Created. Name - ".($obj->encode_decode('decrypt', $party_name));
					}
					$null_value = $GLOBALS['null_value'];
					$columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'voucher_id', 'voucher_number', 'voucher_date', 'party_id', 'party_name','party_type','payment_tax_type', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount', 'deleted','name_mobile_city');
					$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$voucher_number."'", "'".$voucher_date."'", "'".$party_id."'", "'".$party_name."'","'".$party_type."'", "'".$payment_tax_types."'", "'".$narration."'", "'".$amount."'", "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'", "'".$total_amount."'", "'0'","'".$name_mobile_city."'");

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
                            $result = array('number' => '1', 'msg' => 'voucher Successfully Created');					
                            $balance = 1;							
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $voucher_update_id);
                        }
                    }
                    // $voucher_insert_id = $obj->InsertSQL($GLOBALS['voucher_table'], $columns, $values, 'voucher_id', 'voucher_number', $action);	
                    // if(preg_match("/^\d+$/", $voucher_insert_id)) {
                    //     $balance = 1;							
                    //     $voucher_id = $obj->getTableColumnValue($GLOBALS['voucher_table'], 'id', $voucher_insert_id, 'voucher_id');
                    //     $voucher_number = $obj->getTableColumnValue($GLOBALS['voucher_table'], 'id', $voucher_insert_id, 'voucher_number');
                    //     $result = array('number' => '1', 'msg' => 'Voucher Successfully Created');						
                    // }
                    else {
                        $result = array('number' => '2', 'msg' => $voucher_insert_id);
                    }
                }
                
                
                if(!empty($balance) && $balance == 1) {
                    $credit  = 0; $debit = 0; $bill_type ="Voucher";
                    
                    if(!empty($payment_mode_ids)) {
                        $payment_mode_id = explode(',', $payment_mode_ids);
                        $payment_mode_id = array_reverse($payment_mode_id);
                    }
                    if(!empty($payment_tax_types)) {
                        $payment_tax_type = explode(',', $payment_tax_types);
                        $payment_tax_type = array_reverse($payment_tax_type);
                    }

                    if(!empty($bank_ids)) {
                        $bank_id = explode(',', $bank_ids);
                        $bank_id = array_reverse($bank_id);
                    }
                    if(!empty($payment_mode_names)) {
                        $payment_mode_name = explode(',', $payment_mode_names);
                        $payment_mode_name = array_reverse($payment_mode_name);
                    }
                    if(!empty($bank_names)) {
                        $bank_name = explode(',', $bank_names);
                        $bank_name = array_reverse($bank_name);
                    }
                    if(!empty($amount)) {
                        $amounts = explode(',', $amount);
                        $amounts = array_reverse($amounts);
                    }
                    $party_type = $party_type == '1' ? "Purchase Party" : "NULL";
                    $balance_type = 'Debit';

                    $bill_id = $voucher_id;
                    $bill_date = $voucher_date;
                    $bill_number = $voucher_number;
                    
                    if(!empty($payment_mode_id)){
                        for($i = 0; $i < count($payment_mode_id); $i++) {
                            $imploded_amount = $amounts[$i];
                    
                            $credit = 0;
                            $debit = $amounts[$i];

                            if(empty($bank_id[$i])){
                                $bank_id[$i] =$GLOBALS['null_value'];
                            }
                            if(empty($bank_name[$i])){
                                $bank_name[$i] =$GLOBALS['null_value'];
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
        }
        else {
            if(!empty($valid_voucher)) {
				$result = array('number' => '3', 'msg' => $valid_voucher);
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


    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title']; 
		$search_text = ""; $from_date = ""; $to_date = "";

		$filter_party_id = "";
		if(isset($_POST['filter_party_id'])) {
			$filter_party_id = $_POST['filter_party_id'];
            $filter_party_id = trim($filter_party_id);
		} 

		$search_text = "";
		if(isset($_POST['search_text'])) {
			$search_text = $_POST['search_text'];
            $search_text = trim($search_text);
		}

		$from_date = "";
		if(isset($_POST['from_date'])) {
			$from_date = $_POST['from_date'];
		}

		$to_date = "";
		if(isset($_POST['to_date'])) {
			$to_date = $_POST['to_date'];
		}

		$show_bill = 0;
		if(isset($_POST['show_bill'])){
			$show_bill = $_POST['show_bill'];
		}

		$total_records_list = array();
		$total_records_list = $obj->getVoucherList($from_date, $to_date, $show_bill, $filter_party_id);
		
        if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($total_records_list)) {
				foreach($total_records_list as $val) {
					if( (strpos(strtolower($val['voucher_number']), $search_text) !== false) ) {
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
        
        if($total_pages > $page_limit) { 
            ?>
			<div class="pagination_cover mt-3"> 
				<?php
					include("pagination.php");
				?> 
			</div> 
            <?php 
        } 
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if(empty($access_error)) { 
        ?>
		<table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Voucher No<br>Date</th>
                    <!-- <th>Investment Type</th> -->
                    <th>Party</th>
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
                                <td><?php echo $index; ?></td>
                                <td>
                                    <?php if(!empty($list['voucher_number'])) { echo $list['voucher_number']." <br>".date("d-m-Y",strtotime($list['voucher_date'])); } ?>
                                </td>
                                <!-- <td>
                                    <?php
                                        if(!empty($list['payment_tax_type'])) {
                                            $payment_tax_type = "";
                                            $payment_tax_type = $list['payment_tax_type'];
                                            if($payment_tax_type == "1"){
                                                $payment_tax_type = "Without Tax";
                                            } elseif ($payment_tax_type == '2'){
                                                $payment_tax_type = "With Tax";
                                            } 
                                            if(!empty($payment_tax_type)) { 
                                                echo $payment_tax_type;
                                            }
                                        }
                                        ?>
                                </td> -->
                                <td>
                                    <?php
                                        if(!empty($list['name_mobile_city'])) {
                                            $party_name = "";
                                            $party_name = $list['name_mobile_city'];
                                            if(!empty($party_name)) { 
                                                echo $obj->encode_decode("decrypt", $party_name);
                                            }
                                        } ?>
                                        <div class="w-100 py-2">
                                        <?php
                                            if(!empty($list['creator_name'])) {
                                                $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                                echo " Creator : ". $list['creator_name'];
                                            }
                                        ?>                                        
                                        </div>
                                        <?php if(!empty($list['deleted'] =='1')) { ?> <span style="color: red;">Cancelled</span><?php }	
                                    ?>
                                </td>
                                <td>
                                    <?php if(!empty($list['total_amount'])) { echo $obj->numberFormat($list['total_amount'], 2); } ?>
                                </td> 
                                <td class="text-center px-2 py-2">
                                    <?php
                                        $access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $delete_action;
                                            include('permission_action.php');
                                        }
                                    ?>

                                        <a target="_blank" href="reports/rpt_voucher_a5.php?view_voucher_id=<?php if(!empty($list['voucher_id'])) { echo $list['voucher_id']; } ?>&party_type=<?php if(!empty($list['party_type'])) { echo $list['party_type']; } ?>&from="><i class="fa fa-print"></i> &ensp;</a>
                                        <a target="_blank" href="reports/rpt_voucher_a5.php?view_voucher_id=<?php if(!empty($list['voucher_id'])) { echo $list['voucher_id']; } ?>&from=D"><i class="fa fa-download"></i> &ensp;</a>
                                        <?php if(empty($list['deleted'])){ 
                                            if(empty($access_error)) { ?>
                                            <a href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['voucher_id'])) { echo $list['voucher_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; </a>
                                            <?php }
                                        } ?>
                                        
                                    </div> 
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td colspan="5" class="text-center">Sorry! No records found</td>
                        </tr>
                        <?php 
                    } 
                ?>
            </tbody>
        </table>   
        <?php	
        }
	}
    
	if(isset($_REQUEST['delete_voucher_id'])) {
		$delete_voucher_id = $_REQUEST['delete_voucher_id'];
		$msg = ""; $delete_id = "";
		if(!empty($delete_voucher_id)) {	
            $delete_id = $obj->DeletePayment($delete_voucher_id);
			$voucher_unique_id = "";
			$voucher_unique_id = $obj->getTableColumnValue($GLOBALS['voucher_table'], 'voucher_id', $delete_voucher_id, 'id');
            $voucher_number= $obj->getTableColumnValue($GLOBALS['voucher_table'], 'voucher_id', $delete_voucher_id, 'voucher_number');
            $action = "";
            if(!empty($voucher_number)) {
                $action = "Voucher Deleted. Number - ".$voucher_number;
            }

            $columns = array(); $values = array();						
            $columns = array('deleted');
            $values = array("'1'");
            $msg = $obj->UpdateSQL($GLOBALS['voucher_table'], $voucher_unique_id, $columns, $values, $action); 
		}
		echo $msg;
		exit;
	}