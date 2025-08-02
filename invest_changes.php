<?php
	include("include_files.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['invest_module'];
        }
    }
	
	if(isset($_REQUEST['show_invest_id'])) { 
        $show_invest_id = $_REQUEST['show_invest_id'];

        $invest_type = ""; $party_type = ""; $party_name = ""; $bank_name = ""; $cheque_number = "";  $invest_number = ""; $total_amount = 0; $invest_date = date("d-m-Y"); $payment_mode_ids = array(); $bank_ids = array();

        $product_row_index = 0;

		if(!empty($show_invest_id)) {
            $invest_list = array();
			$invest_list = $obj->getTableRecords($GLOBALS['invest_table'], 'invest_id', $show_invest_id);
            if(!empty($invest_list)) {
                foreach($invest_list as $data) {
                    if(!empty($data['party_name'])) {
                        $party_name = $obj->encode_decode('decrypt',$data['party_name']);
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
					if(!empty($data['invest_type'])) {
                        $invest_type = $data['invest_type'];
						$selected_mode_of_payment = explode(",", $invest_type);
					}
					if(!empty($data['other_details'])) {
                        $other_details = $data['other_details'];
						$other_details = explode(",", $other_details);
					}
					if(!empty($data['payment_mode_id'])) {
                        $payment_mode_ids = $data['payment_mode_id'];
						$payment_mode_ids = explode(",", $payment_mode_ids);
                        $product_row_index = count($payment_mode_ids);

					}
                    if(!empty($data['bank_id'])) {
                        $bank_ids = $data['bank_id'];
						$bank_ids = explode(",", $bank_ids);
					}
					if(!empty($data['narration'])) {
                        $narration = $obj->encode_decode('decrypt', $data['narration']);
                    }
					if(!empty($data['invest_date'])) {
                        $invest_date = date('d-m-Y',strtotime($data['invest_date']));
					}
					if(!empty($data['bank_name'])) {
                        $bank_name = $obj->encode_decode('decrypt', $data['bank_name']);
                    }
				
					if(!empty($data['invest_number'])) {
                        $invest_number = $data['invest_number'];
                    }
                }
            }
		}

        $payment_mode_list = array();
	    // $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], 'bill_company_id', $GLOBALS['bill_company_id']); 
		$payment_mode_list = $obj->BankLinkedPaymentModes();


		$invest_name = "";

		if(!empty($invest_type)) {
			$invest_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $invest_type, 'lower_case_name');
			$invest_name = $obj->encode_decode("decrypt", $invest_name);
		}
		?>
		<script type="text/javascript" src="include/js/creation_modules.js"></script>
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
                        <?php if(!empty($show_bank_id)){ ?>
                            <div class="text-white">Edit Invest</div>
                        <?php 
                        } else{ ?>
                            <div class="text-white">Add Invest</div>
                        <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('invest.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
        <form class="poppins pd-20" name="invest_form" method="POST">
			<div class="row p-3">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_invest_id)) { echo $show_invest_id; } ?>">
                <input type="hidden" name="invest_number" value="<?php if(!empty($invest_number)) { echo $invest_number; } ?>">
				<div class="col-lg-2 col-md-4 col-12">
					<div class="form-group">
						<div class="form-label-group in-border">
							<input type="text" name="invest_date" value="<?php if(!empty($invest_date)) { echo $invest_date; } ?>"class="form-control shadow-none date_field">
							<label>invest Date</label>
						</div>
					</div>
				</div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" onkeydown="Javascript:KeyboardControls(this,'text',50,'1')"  name="party_name" id="party_name"  value="<?php if(!empty($party_name)) { echo $party_name; } ?>" class="form-control shadow-none" placeholder="">
                            <label>Investor Name</label>                   
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
                            <select name="selected_tax_type" class="select2 select2-danger smallfnt form-control" style="width:100% !important;">
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
                            <select name="selected_payment_mode_id" class="select2 select2-danger smallfnt" style="width: 100%;" onchange="Javascript:getBankDetails(this.value);">
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
                            <select name="selected_bank_id" class="select2 select2-danger smallfnt form-control" style="width:100% !important;">
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
                    </div>
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
                    <table class="table nowrap cursor smallfnt w-100 border payment_row_table">
                           <input type="hidden" name="payment_count" value="<?php if(!empty($product_row_index)) { echo $product_row_index; } else { echo "0"; } ?>">
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
                         <tbody>
                                <?php if(!empty($payment_mode_ids)) {
                                    for($i = 0; $i < count($payment_mode_ids); $i++) { ?>
                                        <tr class="payment_row" id="payment_row<?php echo $product_row_index; ?>">
                                            <td class="sno text-center px-2 py-2"><?php echo $product_row_index; ?></td>

                                            <td class="text-center px-2 py-2">
                                                <?php
                                                  $payment_mode_name = "";
                                                    $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_ids[$i], 'payment_mode_name');
                                                    echo $obj->encode_decode('decrypt', $payment_mode_name);
                                                ?>
                                                <input type="hidden" name="payment_mode_id[]" value="<?php if(!empty($payment_mode_ids[$i])){ echo $payment_mode_ids[$i]; } ?>">
                                            
                                            </td>
                                           <td class="text-center">
                                                <?php
                                                    $bank_name = "";
                                                    $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_ids[$i], 'bank_name');
                                                    if(!empty($bank_name) && $bank_name != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $bank_name);
                                                    }
                                                    else {
                                                        echo '-';
                                                    }   
                                                ?>
                                                <input type="hidden" name="bank_id[]" value="<?php if(!empty($bank_ids[$i])) { echo $bank_ids[$i]; } ?>">
                                            </td>
                                           <td class="text-center">
                                                <input type="text" name="amount[]" style="width:75%!important;margin:auto!important;" class="form-control shadow-none px-1 text-center" value="<?php if(!empty($amount[$i])) { echo $amount[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number','','');" onkeyup="Javascript:PaymentTotal();InputBoxColor(this, 'text');">
                                            </td>
                                           <td class="text-center">

                                                    <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('<?php echo $product_row_index; ?>', 'payment_row');"><i class="fa fa-trash"></i></button>
                                                <?php /*  } else { ?>
                                                    <span class="text-danger" style="font-weight:bold!important;">Can't Delete</span>
                                                <?php } */ ?>
                                            </td>

                                        </tr>
                                    <?php }
                                } ?>
                            </tbody>
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
                <button class="btn btn-dark submit_button" type="button" onClick="Javascript:SaveModalContent('invest_form', 'invest_changes.php', 'invest.php');">
                    Submit
                </button>
            </div>
            <script type="text/javascript">     
                jQuery(document).ready(function(){
                 <?php
                    if(!empty($show_invest_id)) { ?>
                        PaymentTotal();
                  <?php  }
                    ?>
                });
            </script>
            <script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('form[name="invest_form"]').find('select').select2();
               
				});   
			</script>
        
        </form>
		<?php
    } 
    if(isset($_POST['edit_id'])) {
        $invest_date = ""; $invest_date_error = ""; $party_name = ""; $party_name_error = "";
        $payment_mode_ids = array(); $bank_ids = array(); $bank_names = array(); $payment_mode_names = array(); $amount = array(); $total_amount = 0; $payment_error = ""; $party_name = ""; $narration = ""; $narration_error = ""; 
        $form_name = "invest_form"; $valid_invest = ""; $current_date = date('d-m-Y'); $party_type = "";
        $selected_payment_mode_id = ""; $invest_number = "NULL"; $payment_tax_type = ""; $payment_tax_type_error = ""; $payment_tax_types = "";

        $edit_id = "";
        if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
		}

        // if(empty($edit_id)) {
        //     $invest_number = $obj->payment_automate_number($GLOBALS['invest_table'], 'invest_number');
        //     $invest_number = $obj->encode_decode("encrypt", $invest_number);
        // } else {
        //     $invest_number = $obj->getTableColumnValue($GLOBALS['invest_table'], 'invest_id', $edit_id, 'invest_number');
        // }

        if(isset($_POST['invest_date'])){
            $invest_date = $_POST['invest_date'];
            $invest_date = trim($invest_date);
            $invest_date_error = $valid->valid_date($invest_date, 'invest Date', 1);
            if(empty($invest_date_error)) {
                if($invest_date > $current_date) {
                    $invest_date_error = "Future Date not allowed";
                }
            }
        }
        if(!empty($invest_date_error)) {
            $valid_invest = $valid->error_display($form_name, "invest_date", $invest_date_error, 'text');
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
            if(!empty($valid_invest)) {
                $valid_invest = $valid_invest." ".$valid->error_display($form_name, "party_name", $party_name_error, 'text');
            }
            else {
                $valid_invest = $valid->error_display($form_name, "party_name", $party_name_error, 'text');
            }
        }

        if(isset($_POST['narration'])) {
            $narration = $_POST['narration'];
            $narration = trim($narration);
            $narration_error = $valid->valid_address($narration,'Narration','1','150');
        }
        if(!empty($narration_error)) {
            if(!empty($valid_invest)) {
                $valid_invest = $valid_invest." ".$valid->error_display($form_name, "narration", $narration_error, 'textarea');
            }
            else {
                $valid_invest = $valid->error_display($form_name, "narration", $narration_error, 'textarea');
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
                        if(!empty($valid_invest)) {
                            $valid_invest = $valid_invest." ".$valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                        else {
                            $valid_invest = $valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                    }
                    else {
                        $total_amount += $amount[$i];
                    }
                }
            }
        }
        else {
            $payment_error = "Add Payment";
        }
        
        if(empty($valid_invest) && empty($payment_error)) {
            $check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
            $bill_company_id = $GLOBALS['bill_company_id'];
            $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
            $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
            
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
				if(!empty($invest_date)) {
					$invest_date = date("Y-m-d", strtotime($invest_date));
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

                  
					$invest_number = $obj->new_automate_number($GLOBALS['invest_table'], 'invest_number');
					//  $invest_number = $obj->encode_decode('encrypt',$invest_number);
                    if(empty($invest_number)){
                        $invest_number = $GLOBALS['null_value'];
                    }
            
                if(empty($edit_id)) {
                    $action = "";
					if(!empty($party_name) && $party_name != $GLOBALS['null_value']) {
						$action = "New invest Created. Name - ".($obj->encode_decode('decrypt', $party_name));
					}
					$null_value = $GLOBALS['null_value'];
					$columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'invest_id', 'invest_number', 'invest_date', 'party_name', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount','payment_tax_type','deleted');
					$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$invest_number."'", "'".$invest_date."'", "'".$party_name."'", "'".$narration."'", "'".$amount."'", "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'", "'".$total_amount."'","'".$payment_tax_types."'", "'0'");
                    $invest_insert_id = $obj->InsertSQL($GLOBALS['invest_table'], $columns, $values, $action);
                    if(preg_match("/^\d+$/", $invest_insert_id)) {
                        $invest_id = "";
                        if($invest_insert_id < 10) {
                            $invest_id = "INVEST_".date("dmYhis")."_0".$invest_insert_id;
                        }
                        else {
                            $invest_id = "INVEST_".date("dmYhis")."_".$invest_insert_id;
                        }
                        if(!empty($invest_id)) {
                            $invest_id = $obj->encode_decode('encrypt', $invest_id);
                        }
                        $columns = array(); $values = array();						
                        $columns = array('invest_id');
                        $values = array("'".$invest_id."'");
                        $invest_update_id = $obj->UpdateSQL($GLOBALS['invest_table'], $invest_insert_id, $columns, $values, '');
                            if(preg_match("/^\d+$/", $invest_update_id)) {
                                $update_invest_id ="";	
                                $update_invest_id = $invest_id;	
                                $balance = 1; 

                                $result = array('number' => '1', 'msg' => 'Invest Successfully Created');					

                            }

                            else {

                                $result = array('number' => '2', 'msg' => $invest_update_id);

                            }       
                    
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $invest_insert_id);
                    }
                }else{
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['invest_table'], 'invest_id', $edit_id, 'id');
                        $invest_id = $edit_id;
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($party_name)) {
                                $action = "Invest Updated.";
                            }

                            $columns = array(); $values = array();			
                            $columns = array('creator_name', 'bill_company_id', 'invest_date', 'party_name', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount','payment_tax_type', 'deleted');
                            $values = array("'".$creator_name."'", "'".$bill_company_id."'", "'".$invest_date."'", "'".$party_name."'", "'".$narration."'", "'".$amount."'", "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'", "'".$total_amount."'","'".$payment_tax_types."'", "'0'");
                            $invest_update_id = $obj->UpdateSQL($GLOBALS['invest_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $invest_update_id)) {
                                $balance =1;
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');					
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $invest_update_id);
                            }							
                        }
                }

                if(!empty($balance) && $balance == 1) {
                    
                    $bill_company_id = $GLOBALS['bill_company_id']; $bill_id = $invest_id; $bill_date = $invest_date;
                    $credit  = 0; $debit = 0; $bill_type ="Invest";
                    $bill_number = $invest_number;

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

                            $credit = $amounts[$i];
                            $debit = 0;

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
            if(!empty($valid_invest)) {
				$result = array('number' => '3', 'msg' => $valid_invest);
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
            $total_records_list = $obj->getinvestList($GLOBALS['bill_company_id'], $from_date, $to_date,$show_bill);
            // $total_records_list = $obj->getTableRecords($GLOBALS['invest_table'],'bill_company_id', $GLOBALS['bill_company_id']);
		}
  
		if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($total_records_list)) {
				foreach($total_records_list as $val) {
					if( (strpos(strtolower($val['invest_number']), $search_text) !== false) ) { 
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
                    <th>Invest Number <br> Date</th>
                    <th>Party Name</th>
                    <th>Invest Amount</th>
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
                                       
                                         <?php if(!empty($data['invest_number']) && $data['invest_number'] != $GLOBALS['null_value']) { echo $data['invest_number']; } ?> <br>
                                          <?php if(!empty($data['invest_date'])) { echo date("d-m-Y",strtotime($data['invest_date'])); } ?> 
                                    </td>
                                    <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['invest_id'])) { echo $data['invest_id']; } ?>');">
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
                                            echo number_format($data['total_amount'],2);
                                        } 
                                        ?>
                                    </td>
                                    <td>
                                    <a target="_blank" href="reports/rpt_invest_a5.php?view_invest_id=<?php if(!empty($data['invest_id'])) { echo $data['invest_id']; } ?>&from="><i class="fa fa-print"></i> &ensp;</a>
                                      <a target="_blank" href="reports/rpt_invest_a5.php?view_invest_id=<?php if(!empty($data['invest_id'])) { echo $data['invest_id']; } ?>&from=D"><i class="fa fa-download"></i> &ensp;</a>
                                        <?php
                                            $access_error = "";
                                            if(!empty($login_staff_id)) {
                                                $permission_action = $delete_action;
                                                include('permission_action.php');
                                            } 
                                            if(empty($access_error) && empty($data['deleted'])) {
                                                ?>
                                                <a class="pr-2" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['invest_id'])) { echo $data['invest_id']; } ?>');"><i class="fa fa-trash"></i></a>
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
	if(isset($_REQUEST['delete_invest_id'])) {
		$delete_invest_id = $_REQUEST['delete_invest_id'];
		$msg = "";
		if(!empty($delete_invest_id)) {	
			$invest_unique_id = "";
			$invest_unique_id = $obj->getTableColumnValue($GLOBALS['invest_table'], 'invest_id', $delete_invest_id, 'id');
			if(preg_match("/^\d+$/", $invest_unique_id)) {
				$action = "Party invest Deleted.";
				
				// $party_invest_query = array();
				// $party_invest_query = $obj->getTableRecords($GLOBALS['party_invest_table'], 'invest_id', $delete_invest_id);

				// if(!empty($delete_invest_id)) {
				// 	foreach($party_invest_query as $invest){
				// 		if(!empty($invest['id'])){
				// 			$party_invest_unique_id = $invest['id'];

				// 			$columns = array(); $values = array();						
				// 			$columns = array('deleted');
				// 			$values = array("'1'");
				// 			$msg = $obj->UpdateSQL($GLOBALS['party_invest_table'], $party_invest_unique_id, $columns, $values, $action);
				// 		}
				// 	}
				// }
                    $update = 0;
                    $update = $obj->CheckBalanceForInvestRestriction($delete_invest_id);
                    if(empty($update)){
                        $delete_id = $obj->DeletePayment($delete_invest_id);
                        $columns = array(); $values = array();						
                        $columns = array('deleted');
                        $values = array("'1'");
                        $msg = $obj->UpdateSQL($GLOBALS['invest_table'], $invest_unique_id, $columns, $values, $action);
                    }else{
                        $msg = "Can't Delete";
                    }
			}
		}
		echo $msg;
		exit;	
	}	
	
	?>