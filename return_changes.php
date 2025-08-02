<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['return_module'];
        }
    }
	
	if(isset($_REQUEST['show_return_id'])) { 
        $show_return_id = $_REQUEST['show_return_id'];

        $return_type = ""; $party_type = ""; $party_name = ""; $bank_name = ""; $cheque_number = "";  $return_number = ""; $total_amount = 0; $return_date = date("d-m-Y");

	

		if(!empty($show_return_id)) {
            $return_list = array();
			$return_list = $obj->getTableRecords($GLOBALS['return_table'], 'return_id', $show_return_id);
            if(!empty($return_list)) {
                foreach($return_list as $data) {
                    if(!empty($data['party_name'])) {
                        $party_name = $data['party_name'];
					}
					if(!empty($data['creator'])){
						$creator = $data['creator'];
					}
					if(!empty($data['amount'])) {
                        $amount = $data['amount'];
						$selected_amount = explode(",",$data['amount']);
					}
					if(!empty($data['total_amount'])) {
                        $total_amount = $data['total_amount'];
					}
					if(!empty($data['return_type'])) {
                        $return_type = $data['return_type'];
						$selected_mode_of_payment = explode(",", $return_type);
					}
					if(!empty($data['other_details'])) {
                        $other_details = $data['other_details'];
						$other_details = explode(",", $other_details);
					}
					
					if(!empty($data['narration'])) {
                        $narration = $obj->encode_decode('decrypt', $data['narration']);
                    }
					if(!empty($data['return_date'])) {
                        $return_date = date('d-m-Y',strtotime($data['return_date']));
					}
					if(!empty($data['bank_name'])) {
                        $bank_name = $obj->encode_decode('decrypt', $data['bank_name']);
                    }
					// if(!empty($data['cheque_number'])) {
                    //     // $cheque_number = $obj->encode_decode('decrypt', $data['cheque_number']);
                    // }
					if(!empty($data['return_number'])) {
                        $return_number = $data['return_number'];
                    }
                }
            }
		}

        $payment_mode_list = array();
	    // $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], 'bill_company_id', $GLOBALS['bill_company_id']); 
		$payment_mode_list = $obj->BankLinkedPaymentModes();


		$return_name = "";

		if(!empty($return_type)) {
			$return_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $return_type, 'lower_case_name');
			$return_name = $obj->encode_decode("decrypt", $return_name);
		}
		?>
		<script type="text/javascript" src="include/js/creation_modules.js"></script>
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
                        <?php if(!empty($show_bank_id)){ ?>
                            <div class="text-white">Edit Return</div>
                        <?php 
                        } else{ ?>
                            <div class="text-white">Add Return</div>
                        <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('return.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
        <form class="poppins pd-20" name="return_form" method="POST">
			<div class="row p-3">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_return_id)) { echo $show_return_id; } ?>">
                <input type="hidden" name="return_number" value="<?php if(!empty($return_number)) { echo $return_number; } ?>">
				<div class="col-lg-2 col-md-4 col-12">
					<div class="form-group">
						<div class="form-label-group in-border">
							<input type="text" name="return_date" value="<?php if(!empty($return_date)) { echo $return_date; } ?>"class="form-control shadow-none date_field">
							<label>return Date</label>
						</div>
					</div>
				</div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" onkeydown="Javascript:KeyboardControls(this,'text',50,'1')"  name="party_name" id="party_name"  value="<?php if(!empty($party_name)) { echo $party_name; } ?>" class="form-control shadow-none" placeholder="">
                            <label>Party Name</label>                   
                        </div>
                    </div>
                </div>               
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" id="narration" name="narration" onkeydown="Javascript:KeyboardControls(this,'',150,'');InputBoxColor(this,'text');"></textarea>
                            <label>Narration <span class="text-danger">*</span></label>
                        </div>
                        <div class="new_smallfnt">Max Char: 150(Except <>?{}!*^%$)</div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center px-3">
                <div class="col-lg-2 col-md-3 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="selected_tax_type" onchange="GetPayment();" class="select2 select2-danger smallfnt form-control" style="width:100% !important;">
                                <option value="">Select Tax type</option>
                                <option value="1">with tax</option>
                                <option value="2">without tax</option>
                            </select>
                            <label>Tax Type <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
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
                            <label>Payment Mode <span class="text-danger">*</span></label>   
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 py-2 d-none" id="bank_list">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="selected_bank_id" onchange="GetPayment()" class="select2 select2-danger smallfnt form-control" style="width:100% !important;">
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
                            <label>Bank <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="selected_amount" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number','',1);">
                            <label>Amount <span class="text-danger">*</span></label>
                        </div>
                          <span class="payment text-danger fw-bold"></span>
                                <input type="hidden" name="available_balance" value="">
                    </div>
                    <!-- <span id="AccBal" class="text-danger"></span>
                    <input type="hidden" class="AccBal"> -->
                </div>
                <div class="col-lg-2 col-md-3 col-12 py-2">
                    <button class="btn btn-success add_payment_button" style="font-size:12px;" type="button" onclick="Javascript:AddPaymentRow();">
                        Add To Bill
                    </button>
                </div>
            </div>
            <div class="row mx-0">
                <div class="col-lg-8 col-md-10 col-12 py-2 mx-auto table-responsive text-center">
                    <input type="hidden" name="payment_row_count" value="0">
                    <table class="table table-bordered cursor smallfnt w-100 border payment_row_table">
                        <thead class="bg-secondary smallfnt text-white">
                            <tr>
                                <th class="text-center">S.No</th>
                                <th class="text-center">Payment Tax Type</th>                                
                                <th class="text-center">Payment Mode</th>
                                <th class="text-center">Bank Name</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total Amount : </th>
                                <th class="overall_total"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>  
            
            <div class="col-md-12 py-3 text-center">
                <button class="btn btn-dark submit_button" type="button" onClick="Javascript:SaveModalContent('return_form', 'return_changes.php', 'return.php');">
                    Submit
                </button>
            </div>
            <script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('form[name="return_form"]').find('select').select2();
				});   
			</script>
        </form>
		<?php
    } 
    if(isset($_POST['edit_id'])) {
        $return_date = ""; $return_date_error = ""; $party_name = ""; $party_name_error = "";
        $payment_mode_ids = array(); $bank_ids = array(); $bank_names = array(); $payment_mode_names = array(); $amount = array(); $total_amount = 0; $payment_error = ""; $party_name = ""; $narration = ""; $narration_error = ""; 
        $form_name = "return_form"; $valid_return = ""; $current_date = date('d-m-Y'); $party_type = "";
        $selected_payment_mode_id = ""; $return_number = "NULL"; $payment_tax_type = array(); $payment_tax_type_error = ""; $payment_tax_types = "";  $available_balance = 0; 
        $return_number = "";
        $edit_id = "";
        if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
		}

        // if(empty($edit_id)) {
        //     $return_number = $obj->payment_automate_number($GLOBALS['return_table'], 'return_number');
        //     $return_number = $obj->encode_decode("encrypt", $return_number);
        // } else {
        //     $return_number = $obj->getTableColumnValue($GLOBALS['return_table'], 'return_id', $edit_id, 'return_number');
        // }

        if(isset($_POST['return_date'])){
            $return_date = $_POST['return_date'];
            $return_date = trim($return_date);
            $return_date_error = $valid->valid_date($return_date, 'return Date', 1);
            if(empty($return_date_error)) {
                if($return_date > $current_date) {
                    $return_date_error = "Future Date not allowed";
                }
            }
        }
        if(!empty($return_date_error)) {
            $valid_return = $valid->error_display($form_name, "return_date", $return_date_error, 'text');
        }

        if(isset($_POST['selected_payment_mode_id'])){
            $selected_payment_mode_id = $_POST['selected_payment_mode_id'];
        }

        if(!empty($selected_payment_mode_id)){
            $payment_error = "Click Add Button to Append Payment";
        }

        if(isset($_POST['party_name'])) {
			$party_name = $_POST['party_name'];
            $party_name = trim($party_name);
            $party_name_error = $valid->valid_text($party_name, 'Party', '1');
		}
        if(!empty($party_name_error)){
            if(!empty($valid_return)) {
                $valid_return = $valid_return." ".$valid->error_display($form_name, "party_name", $party_name_error, 'text');
            }
            else {
                $valid_return = $valid->error_display($form_name, "party_name", $party_name_error, 'text');
            }
        }

        if(isset($_POST['narration'])) {
            $narration = $_POST['narration'];
            $narration = trim($narration);
            $narration_error = $valid->valid_address($narration,'Narration','1','150');
        }
        if(!empty($narration_error)) {
            if(!empty($valid_return)) {
                $valid_return = $valid_return." ".$valid->error_display($form_name, "narration", $narration_error, 'textarea');
            }
            else {
                $valid_return = $valid->error_display($form_name, "narration", $narration_error, 'textarea');
            }
        }

        if(isset($_POST['payment_mode_id'])) {
            $payment_mode_ids = $_POST['payment_mode_id'];
            $payment_mode_ids = array_reverse($payment_mode_ids);
        }
        if(isset($_POST['bank_id'])) {
            $bank_ids = $_POST['bank_id'];
            $bank_ids = array_reverse($bank_ids);
        }
        if(isset($_POST['payment_tax_type'])) {
            $payment_tax_types = $_POST['payment_tax_type'];
            $payment_tax_types = array_reverse($payment_tax_types);
        }
        if(isset($_POST['amount'])) {
            $amount = $_POST['amount'];
            $amount = array_reverse($amount);
        }

        
        if(!empty($payment_mode_ids)) {
            for($i=0; $i < count($payment_mode_ids); $i++) {
                $payment_mode_ids[$i] = trim($payment_mode_ids[$i]);
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
                        if(!empty($valid_return)) {
                            $valid_return = $valid_return." ".$valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                        else {
                            $valid_return = $valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                    }
                    else {
                        $total_amount += $amount[$i];
                    }
                }
                 
                    $available_balance =$obj->GetPaymentAmount($payment_tax_types[$i],$payment_mode_ids[$i],$bank_ids[$i],$login_branch_id);
                    if(!empty($amount[$i])){
                        if($amount[$i] > $available_balance){
                            $payment_error = "Max Amount in Payment ".$obj->encode_decode('decrypt',$payment_mode_names[$i]). " and  Bank ".$obj->encode_decode('decrypt',$bank_names[$i]) ." is Rs.".$available_balance;
                        }
                    }
            }
        }
        else {
            $payment_error = "Add Payment";
        }
        // echo $payment_error .= "do";
        
        if(empty($valid_return) && empty($payment_error)) {
            $check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
            $bill_company_id = $GLOBALS['bill_company_id'];
            $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
            $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
            
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
				if(!empty($return_date)) {
					$return_date = date("Y-m-d", strtotime($return_date));
				}
                if(!empty($party_name)) {
                    $party_name = $obj->encode_decode("encrypt", $party_name);                   
                } else {
                    $party_name = $GLOBALS['null_value']; 
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

                	$return_number = $obj->new_automate_number($GLOBALS['return_table'], 'return_number');
					//  $return_number = $obj->encode_decode('encrypt',$return_number);
                    if(empty($return_number)){
                        $return_number = $GLOBALS['null_value'];
                    }
            
                if(empty($edit_id)) {
                    $action = "";
					if(!empty($party_name) && $party_name != $GLOBALS['null_value']) {
						$action = "New return Created. Name - ".($obj->encode_decode('decrypt', $party_name));
					}
					$null_value = $GLOBALS['null_value'];
					$columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'return_id', 'return_number', 'return_date', 'party_name', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount', 'deleted', 'payment_tax_type');
					$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$return_number."'", "'".$return_date."'", "'".$party_name."'", "'".$narration."'", "'".$amount."'", "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'", "'".$total_amount."'", "'0'", "'".$payment_tax_types."'");
                    $return_insert_id = $obj->InsertSQL($GLOBALS['return_table'], $columns, $values, $action);
                    if(preg_match("/^\d+$/", $return_insert_id)) {
                        $return_id = "";
                        if($return_insert_id < 10) {
                            $return_id = "return_".date("dmYhis")."_0".$return_insert_id;
                        }
                        else {
                            $return_id = "return_".date("dmYhis")."_".$return_insert_id;
                        }
                        if(!empty($return_id)) {
                            $return_id = $obj->encode_decode('encrypt', $return_id);
                        }
                        $columns = array(); $values = array();						
                        $columns = array('return_id');
                        $values = array("'".$return_id."'");
                        $return_update_id = $obj->UpdateSQL($GLOBALS['return_table'], $return_insert_id, $columns, $values, '');
                            if(preg_match("/^\d+$/", $return_update_id)) {
                                $update_return_id ="";	
                                $update_return_id = $return_id;	
                                $balance = 1; 

                                $result = array('number' => '1', 'msg' => 'Return Successfully Created');					

                            }

                            else {

                                $result = array('number' => '2', 'msg' => $return_update_id);

                            }       
                    
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $return_insert_id);
                    }
                }

                if(!empty($balance) && $balance == 1) {
                    
                    $bill_company_id = $GLOBALS['bill_company_id']; $bill_id = $return_id; $bill_date = $return_date;
                    $credit  = 0; $debit = 0; $bill_type ="Return";
                    $bill_number = $return_number;

                    if(!empty($payment_mode_ids)) {
                        $payment_mode_id = explode(',', $payment_mode_ids);
                        $payment_mode_id = array_reverse($payment_mode_id);
                    }

                    if(!empty($bank_ids)) {
                        $bank_id = explode(',', $bank_ids);
                        $bank_id = array_reverse($bank_id);
                    }

                    if(!empty($payment_mode_names)) {
                        $payment_mode_name = explode(',', $payment_mode_names);
                        $payment_mode_name = array_reverse($payment_mode_name);
                    }
                    if(!empty($payment_tax_types)) {
                        $payment_tax_type = explode(',', $payment_tax_types);
                        $payment_tax_type = array_reverse($payment_tax_type);
                    }
                    if(!empty($bank_names)) {
                        $bank_name = explode(',', $bank_names);
                        $bank_name = array_reverse($bank_name);
                    }
           
                    if(!empty($amount)) {
                        $amounts = explode(',', $amount);
                        $amounts = array_reverse($amounts);
                    }

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
                            
                            $update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$party_name,$party_name,"NULL",$payment_mode_id[$i],$payment_mode_name[$i],$bank_id[$i],$bank_name[$i],$credit,$debit, "NULL", $payment_tax_type[$i],'');
                        }
                    }
                    
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_return)) {
				$result = array('number' => '3', 'msg' => $valid_return);
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

        $filter_party_name = "";$search_text="";

        if(isset($_POST['search_text'])) {
          $search_text = $_POST['search_text'];
        }
		
		if(isset($_POST['filter_party_name'])) {
			$filter_party_name = $_POST['filter_party_name'];
		}

		$from_date = "";
		if(isset($_POST['from_date'])) {
			$from_date = $_POST['from_date'];
		}
		$to_date = "";
		if(isset($_POST['to_date'])) {
			$to_date = $_POST['to_date'];
		}

		$show_bill = "";
		if(isset($_POST['show_bill'])) {
			$show_bill = $_POST['show_bill'];
		}

		$total_records_list = array();
		if(!empty($GLOBALS['bill_company_id'])) {
            $total_records_list = $obj->getReturnList($GLOBALS['bill_company_id'], $from_date, $to_date,$show_bill);
            // $total_records_list = $obj->getTableRecords($GLOBALS['return_table'],'bill_company_id', $GLOBALS['bill_company_id']);
		}
  
		if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($total_records_list)) {
				foreach($total_records_list as $val) {
					if( (strpos(strtolower($val['return_number']), $search_text) !== false) ) { 
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
		} ?>
        
		<?php if($total_pages > $page_limit) { ?>
			<div class="pagination_cover mt-3"> 
				<?php
					include("pagination.php");
				?> 
			</div> 
			<?php } 
			$access_error = "";
			if(!empty($login_staff_id)) {
				$permission_action = $view_action;
				include('permission_action.php');
			} 
			if(empty($access_error)) {
				?>
        
		<table class="table nowrap cursor text-center">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Return Number <br> Date</th>
                    <th>Party Name</th>
                    <th>Return Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
			<tbody>
                <?php
					if(!empty($show_records_list)) {
						foreach($show_records_list as $key => $data) {
							$index = $key + 1;
							if(!empty($prefix)) { $index = $index + $prefix; } ?>
                                <tr>
                                    <td><?php echo $index; ?></td>
                                    <td>
                                       
                                         <?php if(!empty($data['return_number']) && $data['return_number'] != $GLOBALS['null_value']) { echo $data['return_number']; } ?> <br>
                                          <?php if(!empty($data['return_date'])) { echo date("d-m-Y",strtotime($data['return_date'])); } ?> 
                                    </td>
                                    <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['return_id'])) { echo $data['return_id']; } ?>');">
                                        <div class="w-100">
                                            <?php
                                                if(!empty($data['party_name'])) {
                                                    $data['party_name'] = $obj->encode_decode('decrypt', $data['party_name']);
                                                    echo $data['party_name'];
                                                }
                                            ?>
                                        </div>
                                        
                                        <?php
                                            if(!empty($data['creator_name'])) {
                                                $data['creator_name'] = $obj->encode_decode('decrypt', $data['creator_name']);
                                        ?>
                                                <small><?php echo "Last Opened : ".$data['creator_name']; ?></small>
                                        <?php		
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if(!empty($data['total_amount'])) {
                                            echo number_format($data['total_amount']);
                                        } 
                                        ?>
                                    </td>
                                    <td>
                                          <a target="_blank" href="reports/rpt_return_a5.php?view_return_id=<?php if(!empty($data['return_id'])) { echo $data['return_id']; } ?>&from="><i class="fa fa-print"></i> &ensp;</a>
                                      <a target="_blank" href="reports/rpt_return_a5.php?view_return_id=<?php if(!empty($data['return_id'])) { echo $data['return_id']; } ?>&from=D"><i class="fa fa-download"></i> &ensp;</a>
                                        <?php
                                            $access_error = "";
                                            if(!empty($login_staff_id)) {
                                                $permission_action = $delete_action;
                                                include('permission_action.php');
                                            } 
                                            if(empty($access_error)  && empty($data['deleted'])) { ?>
                                                <a class="pr-2" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['return_id'])) { echo $data['return_id']; } ?>');"><i class="fa fa-trash"></i></a>
											<?php 
									    } ?>
                                    </td>
                                </tr>
                                <?php
						}
					}
					else {
				?>
						<tr>
							<td colspan="6" class="text-center">Sorry! No records found</td>
						</tr>
				<?php } ?>
            </tbody>
        </table>
        <?php	
		}
	}
	if(isset($_REQUEST['delete_return_id'])) {
		$delete_return_id = $_REQUEST['delete_return_id'];
		$msg = "";
		if(!empty($delete_return_id)) {	
			$return_unique_id = "";
			$return_unique_id = $obj->getTableColumnValue($GLOBALS['return_table'], 'return_id', $delete_return_id, 'id');
			if(preg_match("/^\d+$/", $return_unique_id)) {
				$action = "Party return Deleted.";
				
                $delete_id =
                $delete_id = $obj->DeletePayment($delete_return_id);
			
				$columns = array(); $values = array();						
				$columns = array('deleted');
				$values = array("'1'");
				$msg = $obj->UpdateSQL($GLOBALS['return_table'], $return_unique_id, $columns, $values, $action);
			}
		}
		echo $msg;
		exit;	
	}	
	
	?>