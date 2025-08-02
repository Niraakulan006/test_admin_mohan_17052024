<?php
	include("include_files.php");
    $login_staff_id = "";
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
			$login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			$permission_module = $GLOBALS['lr_module'];
		}
	}
	
	if(isset($_REQUEST['show_lr_id'])) { 
        $show_lr_id = $_REQUEST['show_lr_id'];
        $lr_date = "";
        $lr_date = $obj->getTableColumnValue($GLOBALS['organization_table'],'id','1','lr_starting_date');
        //$lr_date = date("Y-m-d");
        if(!empty($lr_date) && $lr_date == $GLOBALS['default_date']) {
            $lr_date = "";
        }
        $from_date = ""; $to_date = "";
		if(isset($_SESSION['billing_year_starting_date']) && !empty($_SESSION['billing_year_starting_date'])) {
			$from_date = $_SESSION['billing_year_starting_date'];
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
			}
		}
		if(isset($_SESSION['billing_year_ending_date']) && !empty($_SESSION['billing_year_ending_date'])) {
			$to_date = $_SESSION['billing_year_ending_date'];
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
			}
		}
        if(!empty($lr_date) && !empty($from_date) && !empty($to_date)) {
			if(strtotime($lr_date) >= strtotime($from_date) && strtotime($lr_date) <= strtotime($to_date)) {
			}
			else { $lr_date = ""; }
		}
        $lr_number = ""; $reference_number = ""; $organization_id = ""; $consignor_id = ""; $consignee_id = ""; $bill_type = "ToPay"; $from_branch_id = ""; $to_branch_id = "";
        $gst_option = ""; $country = "India"; $custom_consignee_state = "Tamil Nadu";
        $tax_value = ""; $account_party_id = ""; $godown_id = ""; $others_consignee_city ="";
        
        $unit_ids = array(); $unit_names = array(); $quantity_values = array(); $price_per_quantity = array(); $freight_values = array(); $kooli_per_unit = array(); $weight = array();
        $kooli_per_quantity = array(); $amount_values = array();
        $delivery_charges = ""; $unloading_charges = ""; $loading_charges = ""; 
        $consignor_name = ""; $custom_consignor_mobile_number = ""; $custom_consignor_identification = ""; $consignor_details = "";
        $consignee_name = ""; $custom_consignee_mobile_number = ""; $custom_consignee_identification = ""; $custom_consignee_city =""; $custom_consignee_district = "";
        $consignee_details = "";
        $account_party_name = ""; $custom_account_party_mobile_number = ""; $custom_account_party_identification = ""; $account_party_details = "";
        $organization_state = ""; $consignor_state = ""; $consignee_state = ""; $from_branch_state = "";
		$organization_state = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $GLOBALS['bill_company_id'], 'state');
        if(!empty($organization_state)) {
            $organization_state =$obj->encode_decode("decrypt",$organization_state);
        }
        
        if(!empty($show_lr_id)) {
            $lr_list = array();
			$lr_list = $obj->getTableRecords($GLOBALS['lr_table'], 'lr_id', $show_lr_id);
            if(!empty($lr_list)) {
                foreach($lr_list as $data) {
                    if(!empty($data['lr_number'])) {
                        $lr_number = $data['lr_number'];
					}
					if(!empty($data['lr_date']) && $data['lr_date'] != "0000-00-00") {
                        $lr_date =  $data['lr_date'];
					}
                    if(!empty($data['reference_number']) && $data['reference_number'] != $GLOBALS['null_value']) {
                        $reference_number = $obj->encode_decode('decrypt', $data['reference_number']);
                    }
                    if(!empty($data['organization_id']) && $data['organization_id'] != $GLOBALS['null_value']) {
                        $organization_id = $data['organization_id'];
					}
                    if(!empty($data['consignor_id']) && $data['consignor_id'] != $GLOBALS['null_value']) {
                        $consignor_id = $data['consignor_id'];
					}
                    if(!empty($data['consignee_id']) && $data['consignee_id'] != $GLOBALS['null_value']) {
                        $consignee_id = $data['consignee_id'];
					}
                    if(!empty($data['bill_type']) && $data['bill_type'] != $GLOBALS['null_value']) {
                        $bill_type = $data['bill_type'];
					}
                    if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                        $unit_ids = explode(",", $data['unit_id']);
                        $unit_ids = array_reverse($unit_ids);
					}
                    if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                        $quantity_values = explode(",", $data['quantity']);
                        $quantity_values = array_reverse($quantity_values);
					}
                    if(!empty($data['weight']) && $data['weight'] != $GLOBALS['null_value']) {
                        $weight = explode(",", $data['weight']);
                        $weight = array_reverse($weight);
					}
                    if(!empty($data['price_per_qty']) && $data['price_per_qty'] != $GLOBALS['null_value']) {
                        $price_per_quantity = explode(",", $data['price_per_qty']);
                        $price_per_quantity = array_reverse($price_per_quantity);
					}
                    if(!empty($data['freight']) && $data['freight'] != $GLOBALS['null_value']) {
                        $freight_values = explode(",", $data['freight']);
                        $freight_values = array_reverse($freight_values);
					}
                    if(!empty($data['kooli_per_unit']) && $data['kooli_per_unit'] != $GLOBALS['null_value']) {
                        $kooli_per_unit = explode(",", $data['kooli_per_unit']);
                        $kooli_per_unit = array_reverse($kooli_per_unit);
					}
                    if(!empty($data['kooli_per_qty']) && $data['kooli_per_qty'] != $GLOBALS['null_value']) {
                        $kooli_per_quantity = explode(",", $data['kooli_per_qty']);
                        $kooli_per_quantity = array_reverse($kooli_per_quantity);
					}
                    if(!empty($data['amount']) && $data['amount'] != $GLOBALS['null_value']) {
                        $amount_values = explode(",", $data['amount']);
                        $amount_values = array_reverse($amount_values);
					}
                    if(!empty($data['delivery_charges']) && $data['delivery_charges'] != $GLOBALS['null_value']) {
                        $delivery_charges = $data['delivery_charges'];
					}
                    if(!empty($data['unloading_charges']) && $data['unloading_charges'] != $GLOBALS['null_value']) {
                        $unloading_charges = $data['unloading_charges'];
					}
                    if(!empty($data['loading_charges']) && $data['loading_charges'] != $GLOBALS['null_value']) {
                        $loading_charges = $data['loading_charges'];
					}
                    if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) {
                        $from_branch_id = $data['from_branch_id'];
					}
                    if(!empty($data['to_branch_id']) && $data['to_branch_id'] != $GLOBALS['null_value']) {
                        $to_branch_id = $data['to_branch_id'];
					}
                    if(!empty($data['organization_state']) && $data['organization_state'] != $GLOBALS['null_value']) {
                        $organization_state = $obj->encode_decode("decrypt", $data['organization_state']);
					}
                    if(!empty($data['consignor_state']) && $data['consignor_state'] != $GLOBALS['null_value']) {
                        $consignor_state = $obj->encode_decode("decrypt", $data['consignor_state']);
					}
                    if(!empty($data['consignee_state']) && $data['consignee_state'] != $GLOBALS['null_value']) {
                        $consignee_state = $obj->encode_decode("decrypt", $data['consignee_state']);
					}
                    if(!empty($data['from_branch_state']) && $data['from_branch_state'] != $GLOBALS['null_value']) {
                        $from_branch_state = $obj->encode_decode("decrypt", $data['from_branch_state']);
					}
                    if(!empty($data['gst_option']) && $data['gst_option'] != $GLOBALS['null_value']) {
                        $gst_option = $data['gst_option'];
					}
                    if(!empty($data['tax_value']) && $data['tax_value'] != $GLOBALS['null_value']) {
                        $tax_value = $data['tax_value'];
                    }
                    if(!empty($data['account_party_id']) && $data['account_party_id'] != $GLOBALS['null_value']) {
                        $account_party_id = $data['account_party_id'];
                    }
                    if(!empty($data['godown_id'])) {
                        $godown_id = $data['godown_id'];
                    }
                    if(!empty($data['others_consignee_city']) && $data['loading_charges'] != $GLOBALS['null_value']) {
                        $others_consignee_city = $data['others_consignee_city'];
                    }
                    if(!empty($data['consignor_details']) && $data['consignor_details'] != $GLOBALS['null_value']) {
                        $consignor_details = $obj->encode_decode('decrypt', $data['consignor_details']);
                        $consignor_details = explode("$$$", $consignor_details);
                        if(!empty($consignor_details)) {
                            $temp = array();
                            for($i = 0; $i < count($consignor_details); $i++) {
                                if(!empty($consignor_details[$i]) && $consignor_details[$i] != $GLOBALS['null_value']) {
                                    $temp[] = $consignor_details[$i];
                                }
                            }
                            if(!empty($temp)) {
                                $consignor_details = implode("<br>", $temp);
                            }
                        }
                    }
                    if(!empty($data['consignee_details']) && $data['consignee_details'] != $GLOBALS['null_value']) {
                        $consignee_details = $obj->encode_decode('decrypt', $data['consignee_details']);
                        $consignee_details = explode("$$$", $consignee_details);
                        if(!empty($consignee_details)) {
                            $temp = array();
                            for($i = 0; $i < count($consignee_details); $i++) {
                                if(!empty($consignee_details[$i]) && $consignee_details[$i] != $GLOBALS['null_value']) {
                                    $temp[] = $consignee_details[$i];
                                }
                            }
                            if(!empty($temp)) {
                                $consignee_details = implode("<br>", $temp);
                            }
                        }
                    }
                    if(!empty($data['account_party_details']) && $data['account_party_details'] != $GLOBALS['null_value']) {
                        $account_party_details = $obj->encode_decode('decrypt', $data['account_party_details']);
                        $account_party_details = explode("$$$", $account_party_details);
                        if(!empty($account_party_details)) {
                            $temp = array();
                            for($i = 0; $i < count($account_party_details); $i++) {
                                if(!empty($account_party_details[$i]) && $account_party_details[$i] != $GLOBALS['null_value']) {
                                    $temp[] = $account_party_details[$i];
                                }
                            }
                            if(!empty($temp)) {
                                $account_party_details = implode("<br>", $temp);
                            }
                        }
                    }
                }
            }
		} 
        $consignor_list = array();
        if(!empty($consignor_id)) {
            $consignor_list = $obj->getTableRecords($GLOBALS['consignor_table'], 'consignor_id', $consignor_id);
        }
        if(!empty($consignor_list)) {
            foreach($consignor_list as $data) {
                if(!empty($data['name'])) {
                    $consignor_name = $obj->encode_decode('decrypt', $data['name']);
                }
                if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                    $custom_consignor_mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
                }
                if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
                    $custom_consignor_identification = $obj->encode_decode('decrypt', $data['identification']);
                }                            
            }
        }
        $consignee_list = array();
        if(!empty($consignee_id)) {
            $consignee_list = $obj->getTableRecords($GLOBALS['consignee_table'], 'consignee_id', $consignee_id);
        }
        if(!empty($consignee_list)) {
            foreach($consignee_list as $data) {
                if(!empty($data['name'])) {
                    $consignee_name = $obj->encode_decode('decrypt', $data['name']);
                }
                if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                    $custom_consignee_mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
                }
                if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
                    $custom_consignee_identification = $obj->encode_decode('decrypt', $data['identification']);
                }
                if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                    $custom_consignee_city = $obj->encode_decode('decrypt', $data['city']);
                }
                if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
                    $custom_consignee_district = $obj->encode_decode('decrypt', $data['district']);
                } 
                if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
                    $custom_consignee_state = $obj->encode_decode('decrypt', $data['state']);
                }                            
            }
        }
        $account_party_list = array();
        if(!empty($account_party_id)) {
            $account_party_list = $obj->getTableRecords($GLOBALS['account_party_table'], 'account_party_id', $account_party_id);
        }
        if(!empty($account_party_list)) {
            foreach($account_party_list as $data) {
                if(!empty($data['name'])) {
                    $account_party_name = $obj->encode_decode('decrypt', $data['name']);
                }
                if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                    $custom_account_party_mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
                }
                if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
                    $custom_account_party_identification = $obj->encode_decode('decrypt', $data['identification']);
                }                            
            }
        }
        
        $organization_list = array();
        $organization_list = $obj->getTableRecords($GLOBALS['organization_table'],'','');
        $consignor_list = array();
        $consignor_list = $obj->getTableRecords($GLOBALS['consignor_table'],'','');
        $consignee_list = array();
        $consignee_list = $obj->getTableRecords($GLOBALS['consignee_table'],'','');
        $account_party_list = array();
        $account_party_list = $obj->getTableRecords($GLOBALS['account_party_table'],'','');
        $branch_list = array();
        $branch_list = $obj->getTableRecords($GLOBALS['branch_table'],'','');
        $vehicle_list = array();
        $vehicle_list = $obj->getTableRecords($GLOBALS['vehicle_table'],'','');
        $unit_list = array();
        $unit_list = $obj->getTableRecords($GLOBALS['unit_table'],'','');
        $to_branch_list = array();
        if(!empty($from_branch_id)) {
            $to_branch_list = $obj->ToBranchList($from_branch_id);
        }
        
        $lr_count = 0;
        if(!empty($lr_number)) {
            $lr_count = $obj->LRLinkedCount($lr_number);
        }
        ?>
        <style>
            .focused {
                border: 2px solid rgb(64,153,255); /* Border style when focused */
            }
        </style>
        <form class="pd-20" name="lr_form" method="POST">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
                        <?php if(!empty($show_lr_id)) { ?>
                            <h5 class="text-white">Edit LR</h5>
                        <?php } else { ?>
                            <h5 class="text-white">Add LR</h5>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="Javascript:window.open('lr.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
			<div class="row mx-0 p-1">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_lr_id)) { echo $show_lr_id; } ?>">
                <input type="hidden" name="consignor_state" value="<?php if(!empty($consignor_state)) { echo $consignor_state; } ?>">
                <input type="hidden" name="consignee_state" value="<?php if(!empty($consignee_state)) { echo $consignee_state; } ?>">
                <input type="hidden" name="from_branch_state" value="<?php if(!empty($from_branch_state)) { echo $from_branch_state; } ?>">
                <div class="col-lg-2 col-md-4 col-6 py-2">
                    <?php if(!empty($show_lr_id)) { ?>
                        <div class="form-group">
                            <div class="form-label-group in-border">
                                <span style="color:Green; "><?php if(!empty($lr_number)){ echo "LR Number : ".$lr_number; }?></span>
                            </div> 
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" id="lr_date" name="lr_date" min="<?php if(!empty($from_date)) { echo $from_date; } ?>" max="<?php if(!empty($to_date)) { echo $to_date; } ?>" class="form-control shadow-none" placeholder="LR Date" value="<?php if(!empty($lr_date)){ echo $lr_date; }?>">
                            <label>Date <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="reference_number" class="form-control shadow-none" value="<?php if(!empty($reference_number)){ echo $reference_number; }?>">
                            <label>Ref.Number</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="form-control shadow-none text-center" name="bill_type" onchange="Javascript:getBillType();" <?php if(!empty($lr_count)){ ?> disabled <?php } ?>>
                                <option value="">Select</option>
                                <option value="ToPay" <?php if($bill_type == "ToPay"){ ?>selected<?php } ?>>ToPay</option>
                                <option value="Paid" <?php if($bill_type == "Paid"){ ?>selected<?php } ?>>Paid</option>
                                <option value="Account Party" <?php if($bill_type == "Account Party"){ ?>selected<?php } ?>>Account Party</option>
                            </select>
                            <label>Bill type <span class="text-danger">*</span></label>
                        </div> 
                    </div>
                       <?php if(!empty($lr_count) && !empty($show_lr_id)){ ?>
                            <input type="hidden" name="bill_type" value="<?php if(!empty($bill_type)){ echo $bill_type; } ?>">
                            <?php 
                        } ?>
                    <div class="form-group">
                        <div class="row mx-0">
                            <div class="col-8 pt-2 px-0 text-center">GST ON/OFF</div>
                            <div class="col-4 text-center px-0">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="gst_option" id="gst_option" <?php if($gst_option == 1) { ?>checked<?php } ?> value="<?php echo $gst_option; ?>" onchange="Javascript:ShowGST();" <?php if(!empty($show_lr_id)) { ?>disabled<?php } ?>>
                                    <label class="custom-control-label" onclick="Javascript:ShowGST();" for="gst_option" <?php if(!empty($show_lr_id)) { ?>disabled<?php } ?>></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        if(!empty($show_lr_id)) {
                            ?>
                            <input type="hidden" name="gst_option" value="<?php echo $gst_option; ?>">
                            <?php
                        }
                    ?>
                </div>
                <div class="col-lg-2 col-md-3 col-12 py-2">
                    <div class="form-group mb-0">
                        <div class="form-label-group in-border">
                            <input type="text" list='consignor_list' name="consignor_name" id="consignor_name" class="form-control shadow-none" placeholder="" value="<?php if(!empty($consignor_name)){ echo $consignor_name; }
                            ?>" style="margin: 0;">
                            <label>Consignor Name <span class="text-danger">*</span></label>
                            <input type="hidden" name="selected_consignor_id" id="consignor_id" value="<?php if(!empty($consignor_id)) { echo $consignor_id; }?>">
                        </div>
                    </div>
                    <div style="max-height: 150px;overflow-y: scroll;" class='consignor_search_list'>
                        <ul class="suggestion_box_1" id="show_consignor_list">
                            <?php
                                if(!empty($consignor_list)) {
                                    $i = 0;
                                    foreach($consignor_list as $data) { ?>
                                        <li style="display: none;"> 
                                            <a class="<?php echo 'consignor'.$i; ?>" href="Javascript:get_search_consignor('<?php echo 'consignor'.$i; ?>', '<?php echo $data['consignor_id']; ?>');">
                                                <?php 
                                                    $mobile_number = "";
                                                    if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                        $data['name'] = $obj->encode_decode('decrypt', $data['name']);
                                                        if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                                            $mobile_number = $obj->encode_decode("decrypt", $data['mobile_number']);
                                                        }
                                                        echo $data['name']." - ".$mobile_number;
                                                    } 
                                                ?>
                                            </a>
                                        </li>
                                        <?php
                                        $i++; 
                                    }
                                }
                            ?>
                        </ul>
                    </div> 
                    <div class="border">
                        <div class="px-2 consignor_details">
                            <div class="form-group py-1 mb-0">
                                <div class="form-label-group in-border">
                                    <input type="text" name="consignor_mobile_number" id="consignor_mobile_number" class="form-control shadow-none" placeholder="" value ="<?php if(!empty($custom_consignor_mobile_number)) { echo $custom_consignor_mobile_number; } ?>" style="margin: 0;">
                                    <label>Contact No <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 consignor_details">
                            <div class="form-group py-1 mb-0">
                                <input type="text" name="consignor_identification" id="consignor_identification" class="form-control tax_cover3 shadow-none" <?php if($gst_option != '1'){ ?>style="display:none;"<?php } ?> placeholder="Identification" value ="<?php if(!empty($custom_consignor_identification) && $custom_consignor_identification != $GLOBALS['null_value']) { echo $custom_consignor_identification; } ?>" style="margin: 0;">
                            </div>                      
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 py-2">
                    <div class="form-group mb-0">
                        <div class="form-label-group in-border">
                            <input type="text" list='consignee_list' name="consignee_name" id="consignee_name" class="form-control shadow-none" placeholder="" style="margin: 0;" value="<?php if(!empty($consignee_name)){ echo $consignee_name; }?>">
                            <label>Consignee Name <span class="text-danger">*</span></label>
                            <input type="hidden" name="selected_consignee_id" id="consignee_id" value="<?php if(!empty($consignee_id)){ echo $consignee_id; } ?>">
                        </div>
                    </div>
                    <div style="max-height: 150px;overflow-y: scroll;" class='search_list' style="position:initial;">
                        <ul class="suggestion_box_1" id="show_consignee_list">
                            <?php
                                if(!empty($consignee_list)) {
                                    $i = 0;
                                    foreach($consignee_list as $data) { ?>
                                        <li style="display: none;"> 
                                            <a class="<?php echo 'consignee'.$i; ?>" href="Javascript:get_search_consignee('<?php echo 'consignee'.$i; ?>', '<?php echo $data['consignee_id']; ?>');">
                                                <?php 
                                                    $mobile_number = "";
                                                    if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                        $data['name'] = $obj->encode_decode('decrypt', $data['name']);
                                                        if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                                            $mobile_number = $obj->encode_decode("decrypt",($data['mobile_number']));
                                                        }
                                                        echo $data['name']." - ".$mobile_number;
                                                    } 
                                                ?>
                                            </a>
                                        </li>
                                        <?php
                                        $i++; 
                                    }
                                }
                            ?>
                        </ul>
                    </div> 
                    <div class="border">
                        <div class="px-2 col-lg-12">
                            <div class="form-group py-1 mb-0">
                                <div class="form-label-group in-border">
                                    <input type="text" name="consignee_mobile_number" id="consignee_mobile_number" class="form-control" placeholder="" value="<?php if(!empty($custom_consignee_mobile_number)){ echo $custom_consignee_mobile_number; } ?>" style="margin: 0;">
                                    <label>Contact No <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 col-lg-12 consignee_state py-1">
                            <div class="w-100" style="display: none;">
								<select name="country" class="form-control">
									<option value="">Select</option>
								</select>
							</div>
                            <div class="form-group py-1 mb-0">
                                <div class="form-label-group in-border">
                                    <select name="state" class="form-control select2" id="state" onchange="Javascript:consigneeState(this.value);">
                                        <option value="">Select State</option>
                                    </select>
                                    <label>State <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 col-lg-12 py-1">
                            <div class="form-group mb-0">
                                <div class="form-label-group in-border">
                                    <select name="district" class="form-control" id="district" onchange="Javascript:getCities('lr', this.value, '');">
                                        <option value="">Select District</option>
                                    </select>
                                    <label>District</label>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 col-lg-12 py-1">
                            <div class="form-group mb-0">
                                <div class="form-label-group in-border">
                                    <select name="city" class="form-control" id="city" onchange="getOtherCity();">
                                        <option value="">Select City</option>
                                    </select>
                                    <label>City</label>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 col-lg-12 py-1" id="others_city">
                            <?php if($custom_consignee_city =='Others') { ?>
                                <input type="text" name="others_city" id="others_consignee_city" class="form-control" placeholder="Contact No (*)" value="<?php if(!empty($others_consignee_city)){ echo $others_consignee_city; }?>" style="margin: 0;">
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 py-2">
                    <div class="form-group mb-0">
                        <div class="form-label-group in-border">
                            <input type="text" list="account_party_list" name="account_party_name" id="account_party_name" class="form-control" placeholder="" style="margin: 0;" value="<?php if(!empty($account_party_name)){ echo $account_party_name; }?>">
                            <label>Account Party Name</label>
                            <input type="hidden" name="selected_account_party_id" id="account_party_id" value="<?php if(!empty($account_party_id)){ echo $account_party_id; } ?>">
                        </div>
                    </div>
                    <div style="max-height: 150px;overflow-y: scroll;" class='account_party_search_list' style="position:initial;">
                        <ul class="suggestion_box_1" id="show_account_party_list">
                            <?php
                                if(!empty($account_party_list)) {
                                    $i = 0;
                                    foreach($account_party_list as $data) { 
                                        ?>
                                        <li style="display: none;"> 
                                            <a class="<?php echo 'account_party'.$i; ?>" href="Javascript:get_search_account_party('<?php echo 'account_party'.$i; ?>', '<?php echo $data['account_party_id']; ?>');">
                                                <?php 
                                                    $mobile_number = "";
                                                    if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                        $data['name'] = $obj->encode_decode('decrypt', $data['name']);
                                                        if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                                            $mobile_number = $obj->encode_decode("decrypt",($data['mobile_number']));
                                                        }
                                                        echo $data['name']." - ".$mobile_number;
                                                    } 
                                                ?>
                                            </a>
                                        </li>
                                        <?php
                                        $i++; 
                                    }
                                }
                            ?>
                        </ul>
                    </div> 
                    <div class="border">
                        <div class="px-2 col-lg-12">
                            <div class="form-group py-1 mb-0">
                                <div class="form-label-group in-border">
                                    <input type="text" name="account_party_mobile_number" id="account_party_mobile_number" class="form-control" placeholder="" value="<?php if(!empty($custom_account_party_mobile_number)){ echo $custom_account_party_mobile_number; }?>" style="margin: 0;">
                                    <label>Contact No</label>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 col-lg-12">
                            <div class="form-group py-1 mb-0">
                                <input type="text" name="account_party_identification" id="account_party_identification" class="form-control tax_cover4" <?php if($gst_option != '1'){ ?> style="display:none;" <?php } ?>  placeholder="Identification" value="<?php if(!empty($custom_account_party_identification) && $custom_account_party_identification != $GLOBALS['null_value']){ echo $custom_account_party_identification; } ?>" style="margin: 0;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 mx-auto py-2">
                    <div class="form-group">
                        <div class="border">
                            <div class="p-2 consignor_details">
                                <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">Consignor Details</div>
                                <div class="smallfnt consignor_preview" style="min-height:30px!important;">
                                    <?php if(!empty($consignor_details)) { echo $consignor_details; } ?>
                                </div>
                                <div class="smallfnt d-none" name="consignor_name" id="consignor_name"><?php if(!empty($consignor_name)) { echo $consignor_name; } ?></div>
                                <div class="smallfnt d-none" name="consignor_mobile_number" id="consignor_mobile_number"><?php if(!empty($custom_consignor_mobile_number)) { echo $custom_consignor_mobile_number; }?></div>
                                <div class="smallfnt d-none tax_cover3" name="consignor_identification" id="consignor_identification" <?php if($gst_option != '1'){ ?> style="display:none;" <?php } ?>><?php if(!empty($custom_consignor_identification) && $custom_consignor_identification != $GLOBALS['null_value']) { echo $custom_consignor_identification; } ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="border">
                            <div class="p-2 consignee_details">
                                <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">Consignee Details</div>
                                <div class="smallfnt consignee_preview" style="min-height:30px!important;">
                                    <?php if(!empty($consignee_details)) { echo $consignee_details; } ?>
                                </div>
                                <div class="smallfnt d-none" name="consignee_mobile_number" id="consignee_mobile_number"><?php if(!empty($custom_consignee_mobile_number)){ echo $custom_consignee_mobile_number; }?></div>
                                <div class="smallfnt d-none tax_cover4" name="consignee_identification" id="consignee_identification" <?php if($gst_option != '1'){ ?> style="display:none;" <?php } ?>><?php if(!empty($custom_consignee_identification) && $custom_consignee_identification != 'NULL'){ echo $custom_consignee_identification; }?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="border">
                            <div class="p-2 account_party_details">
                                <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">Account Party Details</div>
                                <div class="smallfnt account_party_preview" style="min-height:30px!important;">
                                    <?php if(!empty($account_party_details)) { echo $account_party_details; } ?>
                                </div>
                                <div class="smallfnt d-none" name="account_party_mobile_number" id="account_party_mobile_number"><?php if(!empty($custom_account_party_mobile_number)){ echo $custom_account_party_mobile_number; }?></div>
                                <div class="smallfnt d-none tax_cover4" name="account_party_identification" id="account_party_identification" <?php if($gst_option != '1'){ ?> style="display:none;" <?php } ?>><?php if(!empty($custom_account_party_identification) && $custom_account_party_identification != $GLOBALS['null_value']){ echo $custom_account_party_identification; }?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-0 p-1">
                <div class="col-lg-2 col-md-4 col-6 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="from_branch_id" class="form-control shadow-none" onchange="Javascript:GetToBranch(this.value);">
                                <option value="">Select Branch</option>
                                <?php
                                    $branch_count = 0;
                                    if(!empty($branch_list)) {
                                        foreach($branch_list as $data) {
                                            if(!empty($login_branch_id)) {
                                                if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value'] && in_array($data['branch_id'], $login_branch_id)) {
                                                    $branch_count++;
                                                    ?>
                                                    <option value="<?php echo $data['branch_id']; ?>" <?php if((!empty($from_branch_id) && $from_branch_id == $data['branch_id']) || (count($login_branch_id) == '1')) { ?>selected<?php } ?>>
                                                        <?php
                                                            if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                                echo $obj->encode_decode('decrypt', $data['name']);
                                                            }
                                                        ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            else if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value']) {
                                                $branch_count++;
                                                ?>
                                                <option value="<?php echo $data['branch_id']; ?>" <?php if(!empty($from_branch_id) && $from_branch_id == $data['branch_id']) { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['name']);
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>From Branch <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    <?php if(empty($show_lr_id) && $branch_count == '1') { ?>
                        if(jQuery('select[name="from_branch_id"]').length > 0) {
                            jQuery('select[name="from_branch_id"]').trigger('change');
                        }
                    <?php } ?>
                </script>
                <div class="col-lg-2 col-md-4 col-6 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="to_branch_id" class="form-control shadow-none">
                                <option value="">Select Branch</option>
                                <?php
                                    if(!empty($to_branch_list)) {
                                        foreach($to_branch_list as $data) {
                                            if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['branch_id']; ?>" <?php if(!empty($to_branch_id) && $to_branch_id == $data['branch_id']) { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['name']);
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>To Branch <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-1 ml-auto" style="align-content:center!important;">
                    <div class="form-group mb-0">
						<div class="form-label-group in-border">
							<button type="button" class="btn btn-primary px-2 py-1" style="font-size:11px!important;" onclick="Javascript:addRow();">
                                Add New Row&nbsp;<i class="fa fa-plus-circle"></i>
                            </button>
						</div>
					</div>
                </div>
			</div>
            
            <div class="col-12 table-responsive">
                <input type="hidden" name="product_count" value="<?php if(!empty($product_row_index)) { echo $product_row_index; } else { echo "0"; } ?>">
                <style>
                    .table td, .table th { border-top: none; }
                    .input-group-append .btn, .input-group-prepend .btn { z-index: 0; }
                    .tax_cover .select2-container { width: 100px !important; }
                    .party_cover .select2-container { width: 80% !important; }
                </style>
                <table cellpadding="0" cellspacing="0" class="table table-bordered bill_products_table border-top" style="margin: auto;">
                    <thead>
                        <tr>
                            <th style="width: 100px; text-align: center;">S.No</th>
                            <th style="width: 150px;text-align: center;">Unit</th>
                            <th style="width: 100px; text-align: center;">Quantity</th>
                            <th style="width: 100px; text-align: center;">Weight</th>
                            <th style="width: 100px; text-align: center;">Price / Qty</th>
                            <th style="width: 150px; text-align: center;">Freight</th>
                            <th style="width: 100px; text-align: center;">Kooli / Unit</th>
                            <th style="width: 150px; text-align: center;">Kooli / Qty</th>
                            <th style="width: 150px; text-align: center;">Total Amount</th>
                            <th style="width: 100px; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $amount_total = 0; $i = 0;
                            if(!empty($show_lr_id) && !empty($unit_ids)) { 
                                for($p = 0; $p < count($unit_ids); $p++) { 
                                    $amount = 0; $freight = 0; $total_kooli = 0;
                                    if(!empty($quantity_values[$p]) && !empty($price_per_quantity[$p])) {
                                        $freight = $quantity_values[$p] * $price_per_quantity[$p];
                                        if(!empty($freight)) {
                                            $freight = number_format($freight, 2);
                                            $freight = str_replace(",", "", $freight);
                                        }
                                        if(!empty($kooli_per_unit[$p])) {
                                            $total_kooli = $quantity_values[$p] * $kooli_per_unit[$p];
                                            if(!empty($total_kooli)) {
                                                $total_kooli = number_format($total_kooli, 2);
                                                $total_kooli = str_replace(",", "", $total_kooli);
                                            }
                                        }
                                    }
                                    else if(!empty($weight[$p]) && !empty($price_per_quantity[$p])){
                                        $freight = $weight[$p] * $price_per_quantity[$p];
                                        if(!empty($freight)) {
                                            $freight = number_format($freight, 2);
                                            $freight = str_replace(",", "", $freight);
                                        }
                                        if(!empty($kooli_per_unit[$p])) {
                                            $total_kooli = $weight[$p] * $kooli_per_unit[$p];
                                            if(!empty($total_kooli)) {
                                                $total_kooli = number_format($total_kooli, 2);
                                                $total_kooli = str_replace(",", "", $total_kooli);
                                            }
                                        }
                                    }
                                    if(!empty($freight)) {
                                        $amount = $freight;
                                        if(!empty($total_kooli)) { $amount = $amount + $total_kooli; }
                                    } 
                                    ?>
                                    <tr class="product_row">
                                        <td class="text-center sno">
                                            <?php echo $p + 1; ?>
                                        </td>
                                        <td class="text-center">
                                            <select class="form-control" name="selected_unit_id[]">
                                                <option value="" selected class="smallfnt" >Choose Unit</option>
                                                <?php
                                                    if(!empty($unit_list)) {
                                                        foreach($unit_list as $data) { ?>
                                                            <option value="<?php if(!empty($data['unit_id'])) { echo $data['unit_id']; } ?>" <?php if(!empty($unit_ids[$p])){ if($data['unit_id'] == $unit_ids[$p]){ echo "selected"; } } ?>>
                                                                <?php
                                                                    if(!empty($data['unit_name'])) {
                                                                        $data['unit_name'] = $obj->encode_decode('decrypt', $data['unit_name']);
                                                                        echo $data['unit_name'];
                                                                    }
                                                                ?>
                                                            </option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="quantity[]" class="form-control w-100 text-center" onkeyup="Javascript:ProductRowCheck(this);" <?php if(empty($quantity_values[$p])) { ?>readonly<?php } ?> value="<?php if(!empty($quantity_values[$p])) { echo $quantity_values[$p]; } ?>">
                                        </td>
                                        <td class="text-center">
                                            <input type="text" id="weight" name="weight[]" class="form-control shadow-none" placeholder="" <?php if(empty($weight[$p])){ ?>readonly<?php } ?> value="<?php if(!empty($weight[$p])){echo $weight[$p];} ?>" onkeyup="Javascript:ProductRowCheck(this);">
                                        </td>
                                        <td class="text-center">
                                            <input type="text" id="price_per_qty" name="price_per_qty[]" class="form-control shadow-none" placeholder="" value="<?php if(!empty($price_per_quantity[$p])) { echo $price_per_quantity[$p]; } ?>" onKeyup="Javascript:ProductRowCheck(this);">
                                        </td>
                                        <td class="text-center freight"><?php if(!empty($freight)) { echo $freight; } ?></td> 
                                        <td class="text-center">
                                            <input type="text" id="price_per_kooli" name="price_per_kooli[]" class="form-control shadow-none" placeholder="" value="<?php if(!empty($kooli_per_unit[$p])) { echo $kooli_per_unit[$p]; } ?>" onKeyup="Javascript:ProductRowCheck(this);">
                                        </td> 
                                        <td class="text-center total_kooli"><?php if(!empty($total_kooli)) { echo $total_kooli; } ?></td>
                                        <td class="text-right amount">
                                            <?php if(!empty($amount)) { echo $amount; } ?>
                                        </td>                                        
                                        <td class="text-center">
                                            <?php /*if(empty($p)) { ?>
                                            <div class="add_button">
                                                <button class="btn btn-success " type="button" style="font-size: 11px;margin-top: 5px;margin-left: 5px;" onClick="Javascript:addRow();"><i class="fa fa-plus" ></i> ADD</button>
                                            </div>
                                            <div class="delete_button d-none">
                                                <button class="btn btn-danger" type="button" style="font-size: 11px;margin-top: 5px;margin-left: 5px;" onclick="Javascript:DeleteProductRow(this);"><i class="fa fa-trash"></i> Delete</button>
                                            </div>
                                            <?php } else {*/ ?>
                                            <div class="delete_button">
                                                <button class="btn btn-danger" type="button"  style="font-size: 11px;margin-top: 5px;margin-left: 5px;"onclick="Javascript:DeleteProductRow(this);"><i class="fa fa-trash"></i> Delete</button>
                                            </div>
                                            <?php //} ?>
                                        </td>    
                                    </tr>
                        <?php
                                } 
                            } 
                            /*else
                            { ?>
                                <tr class="product_row" id="product_row<?php if(!empty($add_row_index)) { echo $add_row_index; } ?>">
                                    <td class="text-center sno">1</td>
                                    <td class="text-center">
                                        <select class="form-control" name="selected_unit_id[]">
                                            <option value="" selected class="smallfnt" >Choose Unit</option>
                                            <?php
                                                if(!empty($unit_list)) {
                                                    foreach($unit_list as $data) { ?>
                                                        <option value="<?php if(!empty($data['unit_id'])) { echo $data['unit_id']; } ?>" <?php if(!empty($unit_id)){ if($data['unit_id'] == $unit_id){ echo "selected"; } } ?>>
                                                            <?php
                                                                if(!empty($data['unit_name'])) {
                                                                    $data['unit_name'] = $obj->encode_decode('decrypt', $data['unit_name']);
                                                                    echo $data['unit_name'];
                                                                }
                                                            ?>
                                                        </option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td> 
                                        <input type="text"  id="quantity" name="quantity[]" class="form-control shadow-none" placeholder="" onKeyup="Javascript:ProductRowCheck(this);">
                                    </td>
                                    <td class="text-center">
                                            <input type="text" id="weight" name="weight[]" class="form-control shadow-none" placeholder="" onkeyup="Javascript:ProductRowCheck(this);">
                                        </td>
                                    <td>
                                        <input type="text" id="price_per_qty" name="price_per_qty[]" class="form-control shadow-none" placeholder="" onKeyup="Javascript:ProductRowCheck(this);">
                                    </td>
                                    <td class="text-center freight"></td> 
                                    <td class="text-center">
                                        <input type="text" id="price_per_kooli" name="price_per_kooli[]" class="form-control shadow-none" placeholder="" value="" onKeyup="Javascript:ProductRowCheck(this);">
                                    </td> 
                                    <td class="text-center total_kooli"></td>
                                    <td class="text-right amount"></td>
                                    <td>
                                        <div class="add_button ">
                                            <button class="btn btn-success" type="button" style="font-size: 11px;margin-top: 5px;margin-left: 5px;" onClick="Javascript:addRow();"><i class="fa fa-plus" ></i> ADD</button>
                                        </div>
                                        <div class="delete_button d-none">
                                            <button class="btn btn-danger" type="button" style="font-size: 11px;margin-top: 5px;margin-left: 5px;" onclick="Javascript:DeleteProductRow(this);"><i class="fa fa-trash"></i> Delete</button>
                                        </div>
                                    </td>
                                </tr>
                               
                            <?php }*/
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8" class="text-right"> Total : </td>
                            <td class="text-right sub_total"></td>
                            <td class="text-center"></td>
                        </tr>
                        <tr >
                            <td colspan="6" class="text-right">Delivery charges</td>
                            <td colspan="2" class="text-right">
                                <input type="text" name="delivery_charges" class="form-control shadow-none extra_charges" onchange="Javascript:checkDeliveryCharges();"  value="<?php if(!empty($delivery_charges)) { echo $delivery_charges; } ?>" placeholder ="Extra charges">
                            </td>
                            <td class="text-right delivery_charges_value">
                            </td>
                            <td colspan="1" class="text-right"></td>
                        </tr>
                        <tr >
                            <td colspan="8" class="text-right ">Total :</td>
                            <td class="text-right delivery_charges_total">  
                            </td>
                            <td colspan="1" class="text-right"></td>
                        </tr>
                        <tr class="d-none">
                            <td colspan="5" class="text-right">Unloading Charges</td>
                            <td colspan="2" class="text-right">
                                <input type="text" name="unloading_charges" class="form-control shadow-none unload" onchange="Javascript:checkUnloadingCharges();"  value="<?php if(!empty($unloading_charges)) { echo $unloading_charges; } ?>" placeholder="Unloading charges">
                            </td>
                            <td class="text-right unloading_charges_value">
                            </td>
                            <td colspan="1" class="text-right"></td>
                        </tr>
                        <tr class="d-none">
                            <td colspan="7" class="text-right ">Total :</td>
                            <td class="text-right unloading_charges_total">  
                            </td>
                            <td colspan="1" class="text-right"></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right">Loading Charges</td>
                            <td colspan="2" class="text-right">
                                <input type="text" name="loading_charges" class="form-control shadow-none load" onchange="Javascript:checkLoadingCharges();"  value="<?php if(!empty($loading_charges)) { echo $loading_charges; } ?>" placeholder="Loading charges">
                            </td>
                            <td class="text-right loading_charges_value">
                            </td>
                            <td colspan="1" class="text-right"></td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-right ">Total :</td>
                            <td class="text-right loading_charges_total">  
                            </td>
                            <td colspan="1" class="text-right"></td>
                        </tr>
                        <tr class="cgst_row d-none">
                            <td colspan="8" class="text-right ">CGST <span class="cgst"></span> :</td>                        
                            <td class="text-right cgst_value"></td>
                            <td colspan="1" class="text-right"></td>
                        </tr>
                        <tr class="sgst_row d-none">
                            <td colspan="8" class="text-right ">SGST <span class="sgst"></span> :</td>                        
                            <td class="text-right sgst_value"></td>
                            <td colspan="1" class="text-right"></td>
                        </tr>
                        <tr class="igst_row d-none">
                            <td colspan="8" class="text-right ">IGST <span class="igst"></span> :</td>                        
                            <td class="text-right igst_value"></td>
                            <td colspan="1" class="text-right"></td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-right ">Round OFF :</td>
                            <td class="text-right round_off">  
                            </td>
                            <td colspan="1" class="text-right"></td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-right ">Total :
                            </td>
                            <td class="text-right overall_total">  
                            </td>
                            <td colspan="1" class="text-right"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-12 pt-3 text-center">
                <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent('lr_form', 'lr_changes.php', 'lr.php');">
                    Submit
                </button>
            </div>
            <?php /* ?>
            <button type="button" data-toggle="modal" data-target="#consignormodal" class="d-none consignor_modal_button"></button>
            <button type="button" data-toggle="modal" data-target="#consigneemodal" class="d-none consignee_modal_button"></button>
            <button type="button" data-toggle="modal" data-target="#unitmodal" class="d-none unit_modal_button"></button>
            <div class="modal fade" id="unitmodal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title h5">Unit Details</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="text" id="custom_unit_name" name="custom_unit_name" class="form-control shadow-none" placeholder="">
                                            <label>Unit Name(*)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success"  onClick="Javascript:SaveCustomUnit();">Save</button>
                            <button type="button" class="btn btn-danger"  onClick="Javascript:CancelCustomUnit();">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" data-toggle="modal" data-target="#vehiclemodal" class="d-none vehicle_modal_button"></button>
            <div class="modal fade" id="vehiclemodal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title h5">Vehicle Details</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12 text-center">
                                    <div class="form-group mb-1 ">
                                       <div class="form-label-group in-border pb-2">
                                            <input type="text" id="custom_vehicle_name" name="custom_vehicle_name" class="form-control shadow-none" placeholder="">
                                            <label>Vehicle Name(*)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group mb-1 ">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="text" id="custom_vehicle_number" name="custom_vehicle_number" class="form-control shadow-none" placeholder="">
                                            <label>Vehicle Number(*)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group mb-1 ">
                                       
                                        <div class="form-label-group in-border pb-2">
                                            <input type="text" id="custom_vehicle_contact_number" name="custom_vehicle_contact_number" class="form-control shadow-none" placeholder="">
                                            <label>Contact Number(*)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success"  onClick="Javascript:SaveCustomVehicle();">Save</button>
                            <button type="button" class="btn btn-danger"  onClick="Javascript:CancelCustomVehicle();">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php */ ?>
            <?php
                $current_date = date("d-m-Y");
                $prev_date = date('d-m-Y', strtotime(strtotime($current_date)))
            ?>
			<script type="text/javascript" src="include/js/bootstrap-datepicker.min.js"></script>
            <script src="include/select2/js/select2.min.js"></script>
			<script src="include/select2/js/select.js"></script>
            <script type="text/javascript">                
				jQuery(document).ready(function(){
					getCountries('lr','<?php if(!empty($country)) { echo $country; } ?>', '<?php if(!empty($custom_consignee_state)) { echo $custom_consignee_state; } ?>', '<?php if(!empty($custom_consignee_district)) { echo $custom_consignee_district; } ?>', '<?php if(!empty($custom_consignee_city)) { echo $custom_consignee_city; } ?>');
				});
			</script>
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    if(jQuery('.date_field').length > 0) {
                        jQuery('.date_field').datepicker({
                            format: "dd-mm-yyyy",
                            autoclose: true,
                            startDate: "<?php if(!empty($prev_date)) { echo $prev_date; } ?>",
                            endDate: "today"
                        });
                    }          
                });  
                $('input[type="text"]').focus(function() {
                    // $(this).parent().parent().addClass('focused');
                });
                // Add blur event handler
                $('input[type="text"]').blur(function() {
                    $(this).parent().removeClass('focused');
                }); 
                $('select').on('select2:open', function (e) {
                    // Add focus border to the currently focused Select2 dropdown
                    $(this).siblings('.select2-container').addClass('focused');
                });
                $('select').on('select2:close', function (e) {
                    // Remove focus border from all Select2 dropdowns when Select2 is closed
                    $('.select2-container').removeClass('focused');
                });
                // Add event listener for tabbing into the select2 box
                $(document).on('focus', '.select2-selection', function() {
                    $(this).parent().parent().addClass('focused');
                }).on('blur', '.select2-selection', function() {
                    $('.select2-container').removeClass('focused');
                });
                			
                $(document).on('click','body *',function(){
                    $("#show_consignor_list").hide();
                    //  $(this) = your current element that clicked.
                    // additional code
                });  
                $(document).on('click','body *',function(){
                    $("#show_consignee_list").hide();
                    //  $(this) = your current element that clicked.
                    // additional code
                });
                $(document).on('click','body *',function(){
                    $("#show_account_party_list").hide();
                    //  $(this) = your current element that clicked.
                    // additional code
                });
                // $(document).on('click','body *',function(){
                //     $("#show_city_list").hide();
                //     //  $(this) = your current element that clicked.
                //     // additional code
                // });
            </script>
            <script type ="text/javascript" src="include/js/lr.js"></script>
            <script type="text/javascript">   
                jQuery(document).ready(function(){
                    <?php if(!empty($show_lr_id)) { ?>
                        // if(jQuery('select[name = "organization_id"]').length > 0) {
                        //     jQuery('select[name = "organization_id"]').setAttribute("disabled", true);
                        // }
                        // if(jQuery('select[name = "branch_id"]').length > 0) {
                        //     jQuery('select[name = "branch_id"]').setAttribute("disabled", true);
                        // }
                    <?php } ?>
                    jQuery('input[name="consignor_name"]').on("keypress", function(e) {
						if (e.keyCode == 13) {
							//console.log('search enter');
							if(jQuery(".consignor_search_list li.active").length!=0) {
								var search_product_link = jQuery.trim(jQuery(".consignor_search_list li.active").find('a').attr('href'));
								// jQuery(".consignor_search_list li.active").css("display" , "none");
								window.location = search_product_link;
							}
                            else
                            {
                                jQuery('input[name="consignor_mobile_number"]').focus();
                            }
							return false;
						}
					});
                    jQuery('input[name="consignor_name"]').keyup(function(e) {
                        if(e.which != 13){
                            search_consignor_list('lr_form')
                        }
                        
                        if(e.which == 38){
                            var storeTarget = jQuery('.consignor_search_list').find("li.active");
                            do {
                                storeTarget = storeTarget.prev();
                            } while (storeTarget.length && storeTarget.is(':hidden'));
                            
                            jQuery(".consignor_search_list li.active").removeClass("active");
                            storeTarget.focus().addClass("active");
                            return false;
                        }
                        if(e.which == 40){
                            if(jQuery(".consignor_search_list li.active").length!=0) {
                                if(jQuery('.consignor_search_list').find("li.active").nextAll('li:visible').length > 0) {
                                    var storeTarget = jQuery('.consignor_search_list').find("li.active").nextAll('li:visible').first().focus();
                                    jQuery(".consignor_search_list li.active").removeClass("active");
                                    storeTarget.addClass("active");
                                }
                                else {
                                    jQuery(".consignor_search_list li.active").removeClass("active");
                                    jQuery('.consignor_search_list').find("li:visible").first().focus().addClass("active");
                                }
                            }
                            else {
                                jQuery('.consignor_search_list').find("li:visible").first().focus().addClass("active");
                            }
                            return false;
                        }
                    });
					jQuery('input[name="consignee_name"]').on("keypress", function(e) {
						if (e.keyCode == 13) {
							//console.log('search enter');
							if(jQuery(".search_list li.active").length!=0) {
								var search_product_link = jQuery.trim(jQuery(".search_list li.active").find('a').attr('href'));
								// jQuery(".search_list li.active").css("display" , "none");
								window.location = search_product_link;
							}
                            else
                            {
                                jQuery('input[name="consignee_mobile_number"]').focus();
                            }
							return false;
						}
					});
                    jQuery('input[name="consignee_name"]').keyup(function(e) {
                        if(e.which != 13){
                            search_consignee_list('lr_form')
                        }
                        if(e.which == 38){
                            var storeTarget = jQuery('.search_list').find("li.active");
                            do {
                                storeTarget = storeTarget.prev();
                            } while (storeTarget.length && storeTarget.is(':hidden'));
                            
                            jQuery(".search_list li.active").removeClass("active");
                            storeTarget.focus().addClass("active");
                            return false;
                        }
                        if(e.which == 40){
                            if(jQuery(".search_list li.active").length!=0) {
                                if(jQuery('.search_list').find("li.active").nextAll('li:visible').length > 0) {
                                    var storeTarget = jQuery('.search_list').find("li.active").nextAll('li:visible').first().focus();
                                    jQuery(".search_list li.active").removeClass("active");
                                    storeTarget.addClass("active");
                                }
                                else {
                                    jQuery(".search_list li.active").removeClass("active");
                                    jQuery('.search_list').find("li:visible").first().focus().addClass("active");
                                }
                            }
                            else {
                                jQuery('.search_list').find("li:visible").first().focus().addClass("active");
                            }
                            return false;
                        }
                    });
                    jQuery('input[name="consignor_name"]').on("keypress", function(e) {
						if (e.keyCode == 13) {
							//console.log('search enter');
							if(jQuery(".consignor_search_list li.active").length!=0) {
								var search_product_link = jQuery.trim(jQuery(".consignor_search_list li.active").find('a').attr('href'));
								// jQuery(".consignor_search_list li.active").css("display" , "none");
								window.location = search_product_link;
							}
							return false;
						}
					});
                    jQuery('input[name="account_party_name"]').keyup(function(e) {
                        if(e.which != 13){
                            search_account_party_list('lr_form')
                        }
                        
                        if(e.which == 38){
                            var storeTarget = jQuery('.account_party_search_list').find("li.active");
                            do {
                                storeTarget = storeTarget.prev();
                            } while (storeTarget.length && storeTarget.is(':hidden'));
                            
                            jQuery(".account_party_search_list li.active").removeClass("active");
                            storeTarget.focus().addClass("active");
                            return false;
                        }
                        
                        if(e.which == 40){
                            if(jQuery(".account_party_search_list li.active").length!=0) {
                                if(jQuery('.account_party_search_list').find("li.active").nextAll('li:visible').length > 0) {
                                    var storeTarget = jQuery('.account_party_search_list').find("li.active").nextAll('li:visible').first().focus();
                                    jQuery(".account_party_search_list li.active").removeClass("active");
                                    storeTarget.addClass("active");
                                }
                                else {
                                    jQuery(".account_party_search_list li.active").removeClass("active");
                                    jQuery('.account_party_search_list').find("li:visible").first().focus().addClass("active");
                                }
                            }
                            else {
                                jQuery('.account_party_search_list').find("li:visible").first().focus().addClass("active");
                            }
                            return false;
                        }
                    });
                    jQuery('input[name="account_party_name"]').on("keypress", function(e) {
						if (e.keyCode == 13) {
							//console.log('search enter');
							if(jQuery(".account_party_search_list li.active").length!=0) {
								var search_product_link = jQuery.trim(jQuery(".account_party_search_list li.active").find('a').attr('href'));
								// jQuery(".account_party_search_list li.active").css("display" , "none");
								window.location = search_product_link;
							}
                            else
                            {
                                jQuery('input[name="account_party_mobile_number"]').focus();
                            }
							return false;
						}
					});
                    jQuery('input[name="city"]').on("keypress", function(e) {
						if (e.keyCode == 13) {
							//console.log('search enter');
							if(jQuery(".city_search_list li.active").length!=0) {
								var search_product_link = jQuery.trim(jQuery(".city_search_list li.active").find('a').attr('href'));
								// jQuery(".consignor_search_list li.active").css("display" , "none");
								window.location = search_product_link;
							}
							return false;
						}
					});
                    jQuery('input[name="city"]').keyup(function(e) {
                        if(e.which != 13){
                            // search_city_list('lr_form')
                        }
                        
                        // if(e.which == 38){
                        //     var storeTarget = jQuery('.city_search_list').find("li.active");
                        //     do {
                        //         storeTarget = storeTarget.prev();
                        //     } while (storeTarget.length && storeTarget.is(':hidden'));
                            
                        //     jQuery(".city_search_list li.active").removeClass("active");
                        //     storeTarget.focus().addClass("active");
                        //     return false;
                        // }
                        // if(e.which == 40){
                        //     if(jQuery(".city_search_list li.active").length!=0) {
                        //         if(jQuery('.city_search_list').find("li.active").nextAll('li:visible').length > 0) {
                        //             var storeTarget = jQuery('.city_search_list').find("li.active").nextAll('li:visible').first().focus();
                        //             jQuery(".city_search_list li.active").removeClass("active");
                        //             storeTarget.addClass("active");
                        //         }
                        //         else {
                        //             jQuery(".city_search_list li.active").removeClass("active");
                        //             jQuery('.city_search_list').find("li:visible").first().focus().addClass("active");
                        //         }
                        //     }
                        //     else {
                        //         jQuery('.city_search_list').find("li:visible").first().focus().addClass("active");
                        //     }
                        //     return false;
                        // }
                    });
                    jQuery('input[name="consignor_city"]').on("keypress", function(e) {
						if (e.keyCode == 13) {
							//console.log('search enter');
                         
							if(jQuery(".consignor_city_search_list li.active").length!=0) {
                                var search_product_link = jQuery.trim(jQuery(".consignor_city_search_list li.active").find('a').attr('href'));
								// jQuery(".consignor_search_list li.active").css("display" , "none");
								window.location = search_product_link;
							}
							return false;
						}
                        console.log(e.keyCode+"hai")
					});
                    jQuery('input[name="consignor_city"]').keyup(function(e) {
                        if(e.which != 13){
                            search_consignor_city_list('lr_form')
                        }
                        
                        if(e.which == 38){
                            var storeTarget = jQuery('.consignor_city_search_list').find("li.active");
                            do {
                                storeTarget = storeTarget.prev();
                            } while (storeTarget.length && storeTarget.is(':hidden'));
                            
                            jQuery(".consignor_city_search_list li.active").removeClass("active");
                            storeTarget.focus().addClass("active");
                            return false;
                        }
                        if(e.which == 40){
                            if(jQuery(".consignor_city_search_list li.active").length!=0) {
                                if(jQuery('.consignor_city_search_list').find("li.active").nextAll('li:visible').length > 0) {
                                    var storeTarget = jQuery('.consignor_city_search_list').find("li.active").nextAll('li:visible').first().focus();
                                    jQuery(".consignor_city_search_list li.active").removeClass("active");
                                    storeTarget.addClass("active");
                                }
                                else {
                                    jQuery(".consignor_city_search_list li.active").removeClass("active");
                                    jQuery('.consignor_city_search_list').find("li:visible").first().focus().addClass("active");
                                }
                            }
                            else {
                                jQuery('.consignor_city_search_list').find("li:visible").first().focus().addClass("active");
                            }
                            return false;
                        }
                    });
                    
					 calTotal(); 
				});
            
            </script>
        </form>
		<?php
    } 
    if(isset($_POST['edit_id'])) {
        $organization_id = ""; $organization_details = ""; $lr_date = ""; $lr_date_error = ""; $reference_number = "";
        $reference_number_error = ""; $bill_type = ""; $bill_type_error = ""; $gst_option = ""; $gst_option_error = "";
        $other_city =""; $others_consignee_city =""; $others_city =""; $organization_state = "";

        $consignor_unique_id = ""; $consignor_id = ""; $consignor_id_error = ""; $consignor_name = ""; $consignor_name_error = ""; $consignor_mobile_number = ""; $consignor_mobile_number_error = ""; $consignor_identification = ""; 
        $consignor_identification_error = ""; $consignor_details = ""; $consignor_state = "";
        $consignee_unique_id = ""; $consignee_id = ""; $consignee_id_error = ""; $consignee_name = ""; $consignee_name_error = ""; $consignee_mobile_number = ""; $consignee_mobile_number_error = ""; $consignee_identification = ""; 
        $consignee_identification_error = ""; $consignee_city = ""; $consignee_city_error = ""; $consignee_district = ""; $consignee_district_error = ""; $consignee_state = ""; $consignee_state_error = ""; $consignee_details = "";
        $account_party_unique_id = ""; $account_party_id = ""; $account_party_id_error = ""; $account_party_name = ""; $account_party_name_error = ""; $account_party_mobile_number = ""; $account_party_mobile_number_error = ""; $account_party_identification = ""; $account_party_identification_error = ""; $account_party_details = "";
        $from_branch_id = ""; $from_branch_id_error = ""; $from_branch_state = ""; $to_branch_id = ""; $to_branch_id_error = "";
        $unit_ids = array(); $unit_names = array(); $quantity_values = array(); $price_per_quantity = array(); $freight_values = array(); $kooli_per_unit = array(); $weight = array();
        $kooli_per_quantity = array(); $amount_values = array(); $total_quantity = 0; $total_amount = 0;
        $delivery_charges = ""; $delivery_charges_value = ""; $unloading_charges = ""; $unloading_charges_value = ""; $loading_charges = ""; 
        $loading_charges_value = ""; $cgst = 0; $sgst = 0; $igst = 0; $total_tax = ""; $tax_value = 5;
        
        $vehicle_id = $GLOBALS['null_value']; $vehicle_details = $GLOBALS['null_value']; $bill_value = $GLOBALS['null_value']; 
        $bill_number = $GLOBALS['null_value']; $bill_date = "0000-00-00"; $tax_option = $GLOBALS['null_value']; $gst_value = $GLOBALS['null_value']; $invoice_number = $GLOBALS['null_value'];
        $invoice_date = "0000-00-00"; $is_cleared = 0; $is_luggage_entry = 0; $is_tripsheet_entry = 0; $city = $GLOBALS['null_value']; 
        $received_person = $GLOBALS['null_value']; $received_mobile_number = $GLOBALS['null_value']; $received_identification = $GLOBALS['null_value']; 
        $print_type = $GLOBALS['null_value']; $tripsheet_number = $GLOBALS['null_value']; $luggagesheet_number = $GLOBALS['null_value']; 
        $godown_id = $GLOBALS['null_value']; $godown_name = $GLOBALS['null_value'];
        $valid_lr = ""; $form_name = "lr_form"; $edit_id = ""; $company_state = ""; $party_state = "";

        if(isset($_SESSION['bill_company_id']) && !empty($_SESSION['bill_company_id'])) {
            $organization_id = $_SESSION['bill_company_id'];
            if(!empty($organization_id)) {
                $organization_state = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'state');
                $organization_details = $obj->organizationDetails($organization_id, $GLOBALS['organization_table']);
            }
        }
        if(empty($organization_state)) {
            $organization_state = $GLOBALS['null_value'];
        }
        if(isset($_POST['edit_id'])) {
            $edit_id = trim($_POST['edit_id']);
        }

        if(isset($_POST['lr_date'])) {
            $lr_date = trim($_POST['lr_date']);
            if(empty($lr_date)) {
                $lr_date_error = "Select the date";
            }
        }
        if(!empty($lr_date_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "lr_date", $lr_date_error, 'text');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "lr_date", $lr_date_error, 'text');
            }
        }

        if(isset($_POST['reference_number'])) {
            $reference_number = trim($_POST['reference_number']);
            if(!empty($reference_number)) {
                $reference_number_error = $valid->common_validation($reference_number, 'Ref No', 'text');
            }
        }
        if(!empty($reference_number_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "reference_number", $reference_number_error, 'text');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "reference_number", $reference_number_error, 'text');
            }
        }

        if(isset($_POST['bill_type'])) {
            $bill_type = trim($_POST['bill_type']);
            $bill_type_error = $valid->common_validation($bill_type, 'Bill Type', 'select');
        }
        if(!empty($bill_type_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "bill_type", $bill_type_error, 'select');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "bill_type", $bill_type_error, 'select');
            }
        }

        if(isset($_POST['gst_option'])) {
            $gst_option = trim($_POST['gst_option']);
        }

        if(isset($_POST['selected_consignor_id'])) {
            $consignor_id = trim($_POST['selected_consignor_id']);
        }
        if(!empty($consignor_id)) {
            $consignor_state = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_id, 'state');
            $consignor_unique_id = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_id, 'id');
        }
        if(isset($_POST['consignor_name'])) {
            $consignor_name = trim($_POST['consignor_name']);
            $consignor_name_error = $valid->common_validation($consignor_name, "Consignor Name", "text");
        }
        if(!empty($consignor_name_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "consignor_name", $consignor_name_error, 'text');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "consignor_name", $consignor_name_error, 'text');
            }
        }
        if(isset($_POST['consignor_mobile_number'])) {
            $consignor_mobile_number = trim($_POST['consignor_mobile_number']);
            $consignor_mobile_number_error = $valid->valid_mobile_number($consignor_mobile_number, "Contact No", "1");
        }
        if(!empty($consignor_mobile_number) && empty($consignor_mobile_number_error)) {
            $check_consignor_mobile_number = "";
            $check_consignor_mobile_number = $obj->encode_decode("encrypt", $consignor_mobile_number);
            $prev_consignor_id = "";
            if(!empty($check_consignor_mobile_number)) {
                $prev_consignor_id = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'mobile_number', $check_consignor_mobile_number, 'consignor_id');
                if(!empty($prev_consignor_id) && $prev_consignor_id != $consignor_id) {
                    $consignor_mobile_number_error = "This Number already exists";
                }
            }
        }
        if(!empty($consignor_mobile_number_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "consignor_mobile_number", $consignor_mobile_number_error, 'text');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "consignor_mobile_number", $consignor_mobile_number_error, 'text');
            }
        }
        if(isset($_POST['consignor_identification'])) {
            $consignor_identification = trim($_POST['consignor_identification']);
            if(!empty($consignor_identification)) {
                $consignor_identification_error = $valid->common_validation($consignor_identification, "Identification", "text");
            }
        }
        if(!empty($consignor_identification_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "consignor_identification", $consignor_identification_error, 'text');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "consignor_identification", $consignor_identification_error, 'text');
            }
        }

        if(isset($_POST['selected_consignee_id'])) {
            $consignee_id = trim($_POST['selected_consignee_id']);
        }
        if(!empty($consignee_id)) {
            $consignee_unique_id = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_id, 'id');
        }
        if(isset($_POST['consignee_name'])) {
            $consignee_name = trim($_POST['consignee_name']);
            // $consignee_name_error = $valid->valid_name($consignee_name, "Consignee Name", "1");
               $consignee_name_error = $valid->common_validation($consignee_name, "Consignee Name", "text");
        }
        if(!empty($consignee_name_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "consignee_name", $consignee_name_error, 'text');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "consignee_name", $consignee_name_error, 'text');
            }
        }
        if(isset($_POST['consignee_mobile_number'])) {
            $consignee_mobile_number = trim($_POST['consignee_mobile_number']);
            $consignee_mobile_number_error = $valid->valid_mobile_number($consignee_mobile_number, "Contact No", "1");
        }
        if(!empty($consignee_mobile_number) && empty($consignee_mobile_number_error)) {
            $check_consignee_mobile_number = "";
            $check_consignee_mobile_number = $obj->encode_decode("encrypt", $consignee_mobile_number);
            $prev_consignee_id = "";
            if(!empty($check_consignee_mobile_number)) {
                $prev_consignee_id = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'mobile_number', $check_consignee_mobile_number, 'consignee_id');
                if(!empty($prev_consignee_id) && $prev_consignee_id != $consignee_id) {
                    $consignee_mobile_number_error = "This Number already exists";
                }
            }
        }
        if(!empty($consignee_mobile_number_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "consignee_mobile_number", $consignee_mobile_number_error, 'text');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "consignee_mobile_number", $consignee_mobile_number_error, 'text');
            }
        }
        if(isset($_POST['consignee_identification'])) {
            $consignee_identification = trim($_POST['consignee_identification']);
            if(!empty($consignee_identification)) {
                $consignee_identification_error = $valid->common_validation($consignee_identification, "Identification", "text");
            }
        }
        if(!empty($consignee_identification_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "consignee_identification", $consignee_identification_error, 'text');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "consignee_identification", $consignee_identification_error, 'text');
            }
        }
        if(isset($_POST['city'])) {
            $consignee_city = trim($_POST['city']);
            if(!empty($consignee_city)) {
                $consignee_city_error = $valid->common_validation($consignee_city, 'City', 'select');
            }
        }
        if(!empty($consignee_city_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "city", $consignee_city_error, 'select');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "city", $consignee_city_error, 'select');
            }
        }
        if($consignee_city == 'Others' && empty($consignee_city_error)) {
            if(isset($_POST['others_city'])) {
                $others_consignee_city = trim($_POST['others_city']);
                $others_consignee_city_error = $valid->valid_name($others_consignee_city, 'City', '0');
            }
            if(!empty($others_consignee_city_error)) {
                if(!empty($valid_lr)) {
                    $valid_lr = $valid_lr." ".$valid->error_display($form_name, "others_city", $others_consignee_city_error, 'text');
                }
                else {
                    $valid_lr = $valid->error_display($form_name, "others_city", $others_consignee_city_error, 'text');
                }
            }
        }
        if(isset($_POST['district'])) {
            $consignee_district = trim($_POST['district']);
            if(!empty($consignee_district)) {
                $consignee_district_error = $valid->common_validation($consignee_district, 'District', 'select');
            }
        }
        if(!empty($consignee_district_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "district", $consignee_district_error, 'select');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "district", $consignee_district_error, 'select');
            }
        }
        if(isset($_POST['state'])) {
            $consignee_state = trim($_POST['state']);
            if(!empty($consignee_state)) {
                $consignee_state_error = $valid->common_validation($consignee_state, 'State', 'select');
            }
        }
        if(!empty($consignee_state_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "state", $consignee_state_error, 'select');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "state", $consignee_state_error, 'select');
            }
        }

        if(isset($_POST['selected_account_party_id'])) {
            $account_party_id = trim($_POST['selected_account_party_id']);
        }
        if(!empty($account_party_id)) {
            $account_party_unique_id = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'account_party_id', $account_party_id, 'id');
        }
        $acc_required = 0;
        if($bill_type == 'Account Party') {
            $acc_required = 1;
        }
        if(isset($_POST['account_party_name'])) {
            $account_party_name = trim($_POST['account_party_name']);
            // $account_party_name_error = $valid->valid_name($account_party_name, "Name", $acc_required);
            if($acc_required == 1){
                 $account_party_name_error = $valid->common_validation($account_party_name, " Name", "text");
            }else{
                if(!empty($account_party_name)){
                   $account_party_name_error = $valid->common_validation($account_party_name, " Name", "text");
                }
            }
          

        }
        if(!empty($account_party_name_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "account_party_name", $account_party_name_error, 'text');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "account_party_name", $account_party_name_error, 'text');
            }
        }
        $required = 0;
        if(!empty($account_party_name) && empty($account_party_name_error)) {
            $required = 1;
        }
        if(isset($_POST['account_party_mobile_number'])) {
            $account_party_mobile_number = trim($_POST['account_party_mobile_number']);
            $account_party_mobile_number_error = $valid->valid_mobile_number($account_party_mobile_number, "Contact No", $required);
        }
        if($required == '1') {
            if(!empty($account_party_mobile_number) && empty($account_party_mobile_number_error)) {
                $check_account_party_mobile_number = "";
                $check_account_party_mobile_number = $obj->encode_decode("encrypt", $account_party_mobile_number);
                $prev_account_party_id = "";
                if(!empty($check_account_party_mobile_number)) {
                    $prev_account_party_id = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'mobile_number', $check_account_party_mobile_number, 'account_party_id');
                    if(!empty($prev_account_party_id) && $prev_account_party_id != $account_party_id) {
                        $account_party_mobile_number_error = "This Number already exists";
                    }
                }
            }
            if(!empty($account_party_mobile_number_error)) {
                if(!empty($valid_lr)) {
                    $valid_lr = $valid_lr." ".$valid->error_display($form_name, "account_party_mobile_number", $account_party_mobile_number_error, 'text');
                }
                else {
                    $valid_lr = $valid->error_display($form_name, "account_party_mobile_number", $account_party_mobile_number_error, 'text');
                }
            }
            if(isset($_POST['account_party_identification'])) {
                $account_party_identification = trim($_POST['account_party_identification']);
                if(!empty($account_party_identification)) {
                    $account_party_identification_error = $valid->common_validation($account_party_identification, "Identification", "text");
                }
            }
            if(!empty($account_party_identification_error)) {
                if(!empty($valid_lr)) {
                    $valid_lr = $valid_lr." ".$valid->error_display($form_name, "account_party_identification", $account_party_identification_error, 'text');
                }
                else {
                    $valid_lr = $valid->error_display($form_name, "account_party_identification", $account_party_identification_error, 'text');
                }
            }
        }   

        if(isset($_POST['from_branch_id'])) {
            $from_branch_id = trim($_POST['from_branch_id']);
            $from_branch_id_error = $valid->common_validation($from_branch_id, 'From Branch', 'select');
        }
        if(empty($from_branch_id_error) && !empty($from_branch_id)) {
            $branch_unique_id = "";
            $branch_unique_id = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $from_branch_id, 'id');
            if(!preg_match("/^\d+$/", $branch_unique_id)) {
                $from_branch_id_error = "Invalid From branch";
            }
            else {
                $from_branch_state = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $from_branch_id, 'state');
            }
        }
        if(!empty($from_branch_id_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "from_branch_id", $from_branch_id_error, 'select');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "from_branch_id", $from_branch_id_error, 'select');
            }
        }

        if(isset($_POST['to_branch_id'])) {
            $to_branch_id = trim($_POST['to_branch_id']);
            $to_branch_id_error = $valid->common_validation($to_branch_id, 'To Branch', 'select');
        }
        if(empty($to_branch_id_error) && !empty($to_branch_id)) {
            $branch_unique_id = "";
            $branch_unique_id = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $to_branch_id, 'id');
            if(!preg_match("/^\d+$/", $branch_unique_id)) {
                $to_branch_id_error = "Invalid To branch";
            }
        }
        if(!empty($to_branch_id_error)) {
            if(!empty($valid_lr)) {
                $valid_lr = $valid_lr." ".$valid->error_display($form_name, "to_branch_id", $to_branch_id_error, 'select');
            }
            else {
                $valid_lr = $valid->error_display($form_name, "to_branch_id", $to_branch_id_error, 'select');
            }
        }
           
        if(isset($_POST['selected_unit_id'])) {
            $unit_ids = $_POST['selected_unit_id'];
            $unit_ids = array_reverse($unit_ids);
        }
        if(isset($_POST['quantity'])) {
            $quantity_values = $_POST['quantity'];
            $quantity_values = array_reverse($quantity_values);
        }
        if(isset($_POST['weight'])) {
            $weight = $_POST['weight'];
            $weight = array_reverse($weight);
        }
        if(isset($_POST['price_per_qty'])) {
            $price_per_quantity = $_POST['price_per_qty'];
            $price_per_quantity = array_reverse($price_per_quantity);
        }
        if(isset($_POST['price_per_kooli'])) {
            $kooli_per_unit = $_POST['price_per_kooli'];
            $kooli_per_unit = array_reverse($kooli_per_unit);
        }
        $unit_selected = 0; $products_error = ""; $submit_unit_ids = array();
        if(!empty($unit_ids)) {
            for($i = 0; $i < count($unit_ids); $i++) {
                $unit_ids[$i] = trim($unit_ids[$i]);
                if(!empty($unit_ids[$i])) {
                    $unit_unique_id = "";
                    $unit_unique_id = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'id');
                    if(preg_match("/^\d+$/", $unit_unique_id)) {
                        $unit_names[$i] = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
                        if(!in_array($unit_ids[$i], $submit_unit_ids)) {
                            $submit_unit_ids[] = $unit_ids[$i];
                            if(empty($quantity_values[$i])){
                                $quantity_values[$i] = 0;
                            }
                            if(empty($weight[$i])){
                                $weight[$i] = 0;
                            }
                            // if(($quantity_values != '') || ($weight != '')){
                                if($quantity_values[$i] != '') {
                                    $quantity_values[$i] = trim($quantity_values[$i]);
                                    if(preg_match("/^\d+$/", $quantity_values[$i]) && $quantity_values[$i] != '') {
                                        $total_quantity = $total_quantity + $quantity_values[$i];
                                        $price_per_quantity[$i] = trim($price_per_quantity[$i]);
                                        if($price_per_quantity[$i] !='') {
                                            if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $price_per_quantity[$i])) {
                                                $freight = 0;
                                                $freight = $quantity_values[$i] * $price_per_quantity[$i];
                                                if($freight != '') {
                                                    $freight = number_format($freight, 2);
                                                    $freight = str_replace(",", "", $freight);
                                                    $freight_values[$i] = $freight;
                                                    $kooli_error = ""; $total_kooli = 0;
                                                    $kooli_per_unit[$i] = trim($kooli_per_unit[$i]);
                                                    if(!empty($kooli_per_unit[$i])) {
                                                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $kooli_per_unit[$i])) {                                                        
                                                            $total_kooli = $quantity_values[$i] * $kooli_per_unit[$i];
                                                            if(!empty($total_kooli)) {
                                                                $total_kooli = number_format($total_kooli, 2);
                                                                $total_kooli = str_replace(",", "", $total_kooli);
                                                                $kooli_per_quantity[$i] = $total_kooli;
                                                            }
                                                        }
                                                        else {
                                                            $kooli_error = "Invalid kooli";
                                                        }
                                                    }
                                                    else {
                                                        $kooli_per_unit[$i] = "0";
                                                        $kooli_per_quantity[$i] = "0";
                                                        //$kooli_error = "Empty kooli";
                                                    }
                                                    if(empty($kooli_error)) {
                                                        $amount_values[$i] = $freight + $total_kooli;
                                                        $total_amount = $total_amount + $amount_values[$i];
                                                        $unit_selected = 1;
                                                    }
                                                    else {
                                                        $products_error = $kooli_error;
                                                    }
                                                }
                                                else{
                                                    $products_error = "Invalid Qty/Price";
                                                }
                                            }
                                            else {
                                                $products_error = "Invalid price";
                                            }
                                        }
                                        else {
                                            $price_per_quantity[$i] = '0';
                                            $freight_values[$i] = '0';
                                            //$products_error = "Empty price";
                                        }
                                    }
                                    else {
                                        $products_error = "Invalid quantity";
                                    }
                                }
                            
                                if(!empty($weight[$i])){
                                    $weight[$i] = trim($weight[$i]); 
                                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $weight[$i]) && $weight[$i] != 0) {
                                        $total_quantity = $total_quantity + $weight[$i];
                                        $price_per_quantity[$i] = trim($price_per_quantity[$i]);
                                        if(!empty($price_per_quantity[$i])) {
                                            if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $price_per_quantity[$i])) {
                                                $freight = 0;
                                                $freight = $weight[$i] * $price_per_quantity[$i];
                                                if(!empty($freight)) {
                                                    $freight = number_format($freight, 2);
                                                    $freight = str_replace(",", "", $freight);
                                                    $freight_values[$i] = $freight;
                                                    $kooli_error = ""; $total_kooli = 0;
                                                    $kooli_per_unit[$i] = trim($kooli_per_unit[$i]);
                                                    if(!empty($kooli_per_unit[$i])) {
                                                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $kooli_per_unit[$i])) {                                                        
                                                            $total_kooli = $weight[$i] * $kooli_per_unit[$i];
                                                            if(!empty($total_kooli)) {
                                                                $total_kooli = number_format($total_kooli, 2);
                                                                $total_kooli = str_replace(",", "", $total_kooli);
                                                                $kooli_per_quantity[$i] = $total_kooli;
                                                            }
                                                        }
                                                        else {
                                                            $kooli_error = "Invalid kooli";
                                                        }
                                                    }
                                                    else {
                                                        $kooli_per_unit[$i] = "0";
                                                        $kooli_per_quantity[$i] = "0";
                                                        //$kooli_error = "Empty kooli";
                                                    }
                                                    if(empty($kooli_error)) {
                                                        if(!empty($freight)) {
                                                            $amount_values[$i] = $freight + $total_kooli;
                                                            $total_amount = $total_amount + $amount_values[$i];
                                                        }
                                                        else {
                                                            $amount_values[$i] = "0";
                                                        }
                                                        $unit_selected = 1;
                                                    }
                                                    else {
                                                        $products_error = $kooli_error;
                                                    }
                                                }
                                                else {
                                                    $freight_values[$i] = "0";
                                                }
                                            }
                                            else {
                                                $products_error = "Invalid price";
                                            }
                                        }
                                        /*else {
                                            $products_error = "Empty price";
                                        }*/
                                    }
                                    else {
                                        $products_error = "Invalid weight";
                                    }
                                }
                                if($quantity_values[$i] < 0 && $weight[$i] < 0){
                                    $products_error = "Empty quantity / weight";
                                }
                            // }
                            // else {
                            //     $products_error = "Empty quantity / weight";
                            // }
                        }
                        else {
                            $products_error = "Repeated unit ".$obj->encode_decode("decrypt", $unit_names[$i]);
                        }
                    }
                    else {
                        $products_error = "Invalid unit";
                    }
                }
                else {
                    $products_error = "Empty unit";
                }
            }
        }
        else {
            $products_error = "Select the unit";
        }
        if(empty($organization_id) && empty($products_error)) {
            $products_error = "Empty organization";
        }
        if(isset($_POST['delivery_charges'])) {
            $delivery_charges = $_POST['delivery_charges'];
            $delivery_charges = trim($delivery_charges);
        }
        $delivery_charges_error = "";
        if(!empty($delivery_charges)) {
            $delivery_charges_error = $valid->valid_percentage($delivery_charges, "delivery charges", "1");
            if(!empty($delivery_charges_error)) {
                if(!empty($valid_lr)) {
                    $valid_lr = $valid_lr." ".$valid->error_display($form_name, "delivery_charges", $delivery_charges_error, 'text');
                }
                else {
                    $valid_lr = $valid->error_display($form_name, "delivery_charges", $delivery_charges_error, 'text');
                }
            }
            else {
                //if(!empty($total_amount)) {
                    if (strpos($delivery_charges, "%") !== false) {
                        $check_delivery_charges = "";
                        $check_delivery_charges = str_replace("%", "", $delivery_charges);
                        $check_delivery_charges = trim($check_delivery_charges);
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $check_delivery_charges)) {
                            $delivery_charges_value = ($total_amount * $check_delivery_charges) / 100;
                            if(!empty($delivery_charges_value)) {
                                $delivery_charges_value = number_format($delivery_charges_value, 2);
                                $delivery_charges_value = str_replace(",", "", $delivery_charges_value);                                
                            }
                        }
                    }
                    else {
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $delivery_charges)) {
                            $delivery_charges_value = $delivery_charges;
                        }
                    }
                    //echo "delivery_charges_value - ".$delivery_charges_value."<br>";
                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $delivery_charges_value)) {
                        $total_amount = $total_amount + $delivery_charges_value;
                    }
                //}    
            }
        }
        if(isset($_POST['unloading_charges'])) {
            $unloading_charges = $_POST['unloading_charges'];
            $unloading_charges = trim($unloading_charges);
        }
        $unloading_charges_error = "";
        if(!empty($unloading_charges)) {
            $unloading_charges_error = $valid->valid_percentage($unloading_charges, "unloading charges", "1");
            if(!empty($unloading_charges_error)) {
                if(!empty($valid_lr)) {
                    $valid_lr = $valid_lr." ".$valid->error_display($form_name, "unloading_charges", $unloading_charges_error, 'text');
                }
                else {
                    $valid_lr = $valid->error_display($form_name, "unloading_charges", $unloading_charges_error, 'text');
                }
            }
            else {
                //if(!empty($total_amount)) {
                    if (strpos($unloading_charges, "%") !== false) {
                        $check_unloading_charges = "";
                        $check_unloading_charges = str_replace("%", "", $unloading_charges);
                        $check_unloading_charges = trim($check_unloading_charges);
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $check_unloading_charges)) {
                            $unloading_charges_value = ($total_amount * $check_unloading_charges) / 100;
                            if(!empty($unloading_charges_value)) {
                                $unloading_charges_value = number_format($unloading_charges_value, 2);
                                $unloading_charges_value = str_replace(",", "", $unloading_charges_value);                                
                            }
                        }
                    }
                    else {
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $unloading_charges)) {
                            $unloading_charges_value = $unloading_charges;
                        }
                    }
                    //echo "unloading_charges_value - ".$unloading_charges_value."<br>";
                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $unloading_charges_value)) {
                        $total_amount = $total_amount + $unloading_charges_value;
                    }
                //}    
            }
        }
        //echo "total_amount - ".$total_amount."<br>";
        if(isset($_POST['loading_charges'])) {
            $loading_charges = $_POST['loading_charges'];
            $loading_charges = trim($loading_charges);
        }
        $loading_charges_error = "";
        if(!empty($loading_charges)) {
            $loading_charges_error = $valid->valid_percentage($loading_charges, "loading charges", "1");
            if(!empty($loading_charges_error)) {
                if(!empty($valid_lr)) {
                    $valid_lr = $valid_lr." ".$valid->error_display($form_name, "loading_charges", $loading_charges_error, 'text');
                }
                else {
                    $valid_lr = $valid->error_display($form_name, "loading_charges", $loading_charges_error, 'text');
                }
            }
            else {
                //if(!empty($total_amount)) {
                    if (strpos($loading_charges, "%") !== false) {
                        $check_loading_charges = "";
                        $check_loading_charges = str_replace("%", "", $loading_charges);
                        $check_loading_charges = trim($check_loading_charges);
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $check_loading_charges)) {
                            $loading_charges_value = ($total_amount * $check_loading_charges) / 100;
                            if(!empty($loading_charges_value)) {
                                $loading_charges_value = number_format($loading_charges_value, 2);
                                $loading_charges_value = str_replace(",", "", $loading_charges_value);                                
                            }
                        }
                    }
                    else {
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $loading_charges)) {
                            $loading_charges_value = $loading_charges;
                        }
                    }
                    //echo "loading_charges_value - ".$loading_charges_value."<br>";
                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $loading_charges_value)) {
                        $total_amount = $total_amount + $loading_charges_value;
                    }
                //}    
            }
        }
        if(empty($valid_lr) && empty($products_error)) {
            if(empty($consignor_state) || $consignor_state == $GLOBALS['null_value']) {
                $consignor_state = $from_branch_state;
            }
            if($bill_type == "Paid") {
                $company_state = $consignor_state;
                $party_state = $obj->encode_decode('encrypt', $consignee_state);
            }		
            else {
                $company_state = $from_branch_state;
                $party_state = $obj->encode_decode('encrypt', $consignee_state);
            }
            if(!empty($gst_option) && $gst_option == 1) {
                if(!empty($tax_value)) {
                    $check_tax_value = 5;
                    if(!empty($check_tax_value)) {
                        $total_tax = ($total_amount * $check_tax_value) / 100;
                        if(!empty($total_tax)) {
                            $total_tax = number_format($total_tax, 2);
                            $total_tax = str_replace(",", "", $total_tax);
                        }
                        if($company_state == $party_state) {
                            $cgst = $total_tax / 2;
                            $sgst = $total_tax / 2;
                        }
                        else {
                            $igst = $total_tax;
                        }
                        $total_amount = $total_amount + $cgst + $sgst + $igst;
                    }    
                }
            }
        }
        //echo "total_tax - ".$total_tax.", cgst - ".$cgst.", sgst - ".$sgst.", igst - ".$igst.", total_amount - ".$total_amount."<br>";
        $round_off = 0;
        if(!empty($total_amount)) {
            if (strpos( $total_amount, "." ) !== false) {
                $pos = strpos($total_amount, ".");
                $decimal = substr($total_amount, ($pos + 1), strlen($total_amount));
                if($decimal != "00") {
                    if(strlen($decimal) == 1) {
                        $decimal = $decimal."0";
                    }
                    if($decimal >= 50) {
                        $round_off = 100 - $decimal;
                        if(strlen($round_off) < 2) {
                            $round_off = '0.0'.$round_off;
                        }
                        else {
                            $round_off = '0.'.$round_off;
                        }
                        $total_amount = $total_amount + $round_off;
                    }
                    else {
                        $round_off = $decimal;
                        if(strlen($round_off) < 2) {
                            $round_off = '0.0'.$round_off;
                        }
                        else {
                            $round_off = '0.'.$round_off;
                        }
                        $total_amount = $total_amount - $round_off;
                        $round_off = "-".$round_off;
                    }                                       
                }
            }
        }
        $result = "";
        if(empty($valid_lr) && empty($products_error)) {
            $check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $null_value = $GLOBALS['null_value'];
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                if(!empty($lr_date) && $lr_date != "0000-00-00") {
                    $lr_date = date("Y-m-d", strtotime($lr_date));
                }
                if(!empty($reference_number)) {
                    $reference_number = $obj->encode_decode('encrypt', $reference_number);
                }
                else {
                    $reference_number = $GLOBALS['null_value'];
                }
                if(!empty($unit_ids)) { 
                    $unit_ids = implode(",", $unit_ids); 
                }
                else {
                    $unit_ids = $GLOBALS['null_value'];
                }
                if(!empty($unit_names)) { 
                    $unit_names = implode(",", $unit_names); 
                }
                else {
                    $unit_names = $GLOBALS['null_value'];
                }
                if(!empty($quantity_values)) { 
                    $quantity_values = implode(",", $quantity_values); 
                }
                else {
                    $quantity_values = $GLOBALS['null_value'];
                }
                if(!empty($weight)) { 
                    $weight = implode(",", $weight); 
                }
                else {
                    $weight = $GLOBALS['null_value'];
                }
                if(!empty($price_per_quantity)) { 
                    $price_per_quantity = implode(",", $price_per_quantity); 
                }
                else {
                    $price_per_quantity = $GLOBALS['null_value'];
                }
                if(!empty($freight_values)) { 
                    $freight_values = implode(",", $freight_values); 
                }
                else {
                    $freight_values = $GLOBALS['null_value'];
                }
                if(!empty($kooli_per_unit)) { 
                    $kooli_per_unit = implode(",", $kooli_per_unit); 
                }
                else { 
                    $kooli_per_unit = $GLOBALS['null_value'];
                }
                if(!empty($kooli_per_quantity)) { 
                    $kooli_per_quantity = implode(",", $kooli_per_quantity); 
                }
                else { 
                    $kooli_per_quantity = $GLOBALS['null_value']; 
                }
                if(!empty($amount_values)) { 
                    $amount_values = implode(",", $amount_values); 
                }
                else { 
                    $amount_values = $GLOBALS['null_value']; 
                }
                if(!empty($consignor_name)) {
                    $consignor_name = $obj->encode_decode('encrypt', $consignor_name);
                }
                else { 
                    $consignor_name = $GLOBALS['null_value']; 
                }
                if(!empty($consignor_mobile_number)) {
                    $consignor_mobile_number = $obj->encode_decode('encrypt', $consignor_mobile_number);
                }
                else { 
                    $consignor_mobile_number = $GLOBALS['null_value']; 
                }
                if(!empty($consignor_identification)) {
                    $consignor_identification = $obj->encode_decode('encrypt', $consignor_identification);
                }
                else {
                    $consignor_identification = $GLOBALS['null_value'];
                }
                if(!empty($consignor_unique_id)) {
                    $action = "";
                    if(!empty($consignor_name) && $consignor_name != $GLOBALS['null_value']) {
                        $action = "Consignor Updated. Name - ".$obj->encode_decode('decrypt', $consignor_name);
                    }
                    $columns = array(); $values = array();						
                    $columns = array('creator_name', 'name', 'mobile_number', 'identification');
                    $values = array("'".$creator_name."'", "'".$consignor_name."'", "'".$consignor_mobile_number."'", "'".$consignor_identification."'");                    
                    $party_update_id = $obj->UpdateSQL($GLOBALS['consignor_table'], $consignor_unique_id, $columns, $values, $action);
                }
                else {
                    $action = "";
                    if(!empty($consignor_name) && $consignor_name != $GLOBALS['null_value']) {
                        $action = "New Consignor Created. Name - ".$obj->encode_decode('decrypt', $consignor_name);
                    }
                    $columns = array('created_date_time', 'creator', 'creator_name', 'consignor_id', 'name', 'address', 'city', 'mobile_number', 'district', 'state', 'gst_number' ,'identification','deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$consignor_name."'", "'".$null_value."'", "'".$null_value."'", "'".$consignor_mobile_number."'", "'".$null_value."'", "'".$null_value."'", "'".$null_value."'","'".$consignor_identification."'","'0'");
                    $party_insert_id = $obj->InsertSQL($GLOBALS['consignor_table'], $columns, $values, $action);						
                    if(preg_match("/^\d+$/", $party_insert_id)) {
                        $consignor_id = "";
                        if($party_insert_id < 10) {
                            $consignor_id = "CONSIGNOR_".date("dmYhis")."_0".$party_insert_id;
                        }
                        else {
                            $consignor_id = "CONSIGNOR_".date("dmYhis")."_".$party_insert_id;
                        }
                        if(!empty($consignor_id)) {
                            $consignor_id = $obj->encode_decode('encrypt', $consignor_id);
                        }
                        $columns = array(); $values = array();						
                        $columns = array('consignor_id');
                        $values = array("'".$consignor_id."'");
                        $party_update_id = $obj->UpdateSQL($GLOBALS['consignor_table'], $party_insert_id, $columns, $values, '');
                    }
                }
                if(!empty($consignee_name)) {
                    $consignee_name = $obj->encode_decode('encrypt', $consignee_name);
                }
                else {
                    $consignee_name = $GLOBALS['null_value'];
                }
                if(!empty($consignee_mobile_number)) {
                    $consignee_mobile_number = $obj->encode_decode('encrypt', $consignee_mobile_number);
                }
                else {
                    $consignee_mobile_number = $GLOBALS['null_value'];
                }
                if(!empty($consignee_identification)) {
                    $consignee_identification = $obj->encode_decode('encrypt', $consignee_identification);
                }
                else {
                    $consignee_identification = $GLOBALS['null_value'];
                }
                if(!empty($consignee_city)) {
                    $consignee_city = $obj->encode_decode('encrypt', $consignee_city);
                }
                else {
                    $consignee_city = $GLOBALS['null_value'];
                }
                if(!empty($consignee_district)) {
                    $consignee_district = $obj->encode_decode('encrypt', $consignee_district);
                }
                else {
                    $consignee_district = $GLOBALS['null_value'];
                }
                if(!empty($consignee_state)) {
                    $consignee_state = $obj->encode_decode('encrypt', $consignee_state);
                }
                else {
                    $consignee_state = $GLOBALS['null_value'];
                }
                if(empty($others_consignee_city)) {
                    $others_consignee_city = $GLOBALS['null_value'];
                }
                if(!empty($consignee_unique_id)) {
                    $action = "";
                    if(!empty($consignee_name) && $consignee_name != $GLOBALS['null_value']) {
                        $action = "Consignee Updated. Name - ".$obj->encode_decode('decrypt', $consignee_name);
                    }
                    $columns = array(); $values = array();						
                    $columns = array('creator_name', 'name', 'city', 'mobile_number', 'district', 'state', 'identification','others_city');
                    $values = array("'".$creator_name."'", "'".$consignee_name."'", "'".$consignee_city."'", "'".$consignee_mobile_number."'", "'".$consignee_district."'", "'".$consignee_state."'", "'".$consignee_identification."'","'".$others_consignee_city."'");                    
                    $party_update_id = $obj->UpdateSQL($GLOBALS['consignee_table'], $consignee_unique_id, $columns, $values, $action);
                }
                else {
                    $action = "";
                    if(!empty($consignee_name) && $consignee_name != $GLOBALS['null_value']) {
                        $action = "New Consignee Created. Name - ".$obj->encode_decode('decrypt', $consignee_name);
                    }
                    $columns = array('created_date_time', 'creator', 'creator_name', 'consignee_id', 'name', 'address', 'city', 'mobile_number', 'district', 'state', 'gst_number' ,'others_city','identification','deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$consignee_name."'", "'".$null_value."'", "'".$consignee_city."'", "'".$consignee_mobile_number."'", "'".$consignee_district."'", "'".$consignee_state."'", "'".$null_value."'","'".$others_consignee_city."'","'".$consignee_identification."'","'0'");
                    $party_insert_id = $obj->InsertSQL($GLOBALS['consignee_table'], $columns, $values, $action);
                    if(preg_match("/^\d+$/", $party_insert_id)) {
                        $consignee_id = "";
                        if($party_insert_id < 10) {
                            $consignee_id = "CONSIGNEE_".date("dmYhis")."_0".$party_insert_id;
                        }
                        else {
                            $consignee_id = "CONSIGNEE_".date("dmYhis")."_".$party_insert_id;
                        }
                        if(!empty($consignee_id)) {
                            $consignee_id = $obj->encode_decode('encrypt', $consignee_id);
                        }
                        $columns = array(); $values = array();						
                        $columns = array('consignee_id');
                        $values = array("'".$consignee_id."'");
                        $party_update_id = $obj->UpdateSQL($GLOBALS['consignee_table'], $party_insert_id, $columns, $values, '');
                    }
                }
                if(!empty($account_party_name)) {
                    $account_party_name = $obj->encode_decode('encrypt', $account_party_name);
                }
                else {
                    $account_party_name = $GLOBALS['null_value'];
                }
                if(!empty($account_party_mobile_number)) {
                    $account_party_mobile_number = $obj->encode_decode('encrypt', $account_party_mobile_number);
                }
                else {
                    $account_party_mobile_number = $GLOBALS['null_value'];
                }
                if(!empty($account_party_identification)) {
                    $account_party_identification = $obj->encode_decode('encrypt', $account_party_identification);
                }
                else {
                    $account_party_identification = $GLOBALS['null_value'];
                }
                if(!empty($account_party_unique_id)) {
                    $action = "";
                    if(!empty($account_party_name) && $account_party_name != $GLOBALS['null_value']) {
                        $action = "Account Party Updated. Name - ".$obj->encode_decode('decrypt', $account_party_name);
                    }
                    $columns = array(); $values = array();						
                    $columns = array('creator_name', 'name', 'mobile_number', 'identification');
                    $values = array("'".$creator_name."'", "'".$account_party_name."'", "'".$account_party_mobile_number."'", "'".$account_party_identification."'");                    
                    $party_update_id = $obj->UpdateSQL($GLOBALS['account_party_table'], $account_party_unique_id, $columns, $values, $action);
                }
                else if(!empty($account_party_name) && $account_party_name != $GLOBALS['null_value']) {
                    $action = "New account_party Created. Name - ".$obj->encode_decode('decrypt', $account_party_name);
                    $columns = array('created_date_time', 'creator', 'creator_name', 'account_party_id', 'name', 'address', 'city', 'mobile_number', 'state', 'gst_number' ,'identification','deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$account_party_name."'", "'".$null_value."'", "'".$null_value."'", "'".$account_party_mobile_number."'", "'".$null_value."'", "'".$null_value."'","'".$account_party_identification."'","'0'");
                    $party_insert_id = $obj->InsertSQL($GLOBALS['account_party_table'], $columns, $values, $action);						
                    if(preg_match("/^\d+$/", $party_insert_id)) {
                        $account_party_id = "";
                        if($party_insert_id < 10) {
                            $account_party_id = "ACCPARTY_".date("dmYhis")."_0".$party_insert_id;
                        }
                        else {
                            $account_party_id = "ACCPARTY_".date("dmYhis")."_".$party_insert_id;
                        }
                        if(!empty($account_party_id)) {
                            $account_party_id = $obj->encode_decode('encrypt', $account_party_id);
                        }
            
                        $columns = array(); $values = array();						
                        $columns = array('account_party_id');
                        $values = array("'".$account_party_id."'");
                        $party_update_id = $obj->UpdateSQL($GLOBALS['account_party_table'], $party_insert_id, $columns, $values, '');
                    }
                }
                $consignor_name = ""; $consignee_name = ""; $account_party_name = "";
                if(!empty($consignor_id)) {
                    $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_id, 'name');
                    $consignor_details = $obj->consignorDetails($consignor_id, $GLOBALS['consignor_table']);
                }
                else {
                    $consignor_id = $GLOBALS['null_value'];
                    $consignor_name = $GLOBALS['null_value'];
                    $consignor_details = $GLOBALS['null_value'];
                }
                if(!empty($consignee_id)) {
                    $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_id, 'name');
                    $consignee_details = $obj->consigneeDetails($consignee_id, $GLOBALS['consignee_table']);
                }
                else {
                    $consignee_id = $GLOBALS['null_value'];
                    $consignee_name = $GLOBALS['null_value'];
                    $consignee_details = $GLOBALS['null_value'];
                }
                if(!empty($account_party_id)) {
                    $account_party_name = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'account_party_id', $account_party_id, 'name');
					$account_party_details = $obj->accountpartyDetails($account_party_id, $GLOBALS['account_party_table']);
				}
                else {
                    $account_party_id = $GLOBALS['null_value'];
                    $account_party_name = $GLOBALS['null_value'];
                    $account_party_details = $GLOBALS['null_value'];
                }
                if(empty($consignor_details)) {
                    $consignor_details = $GLOBALS['null_value'];
                }
                if(empty($consignee_details)) {
                    $consignee_details = $GLOBALS['null_value'];
                }
                if(empty($account_party_details)) {
                    $account_party_details = $GLOBALS['null_value'];
                }
                $prev_lr_error = "";
                if(!empty($edit_id)) {
                    $lr_number = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $edit_id, 'lr_number');
                }
                else if(!empty($from_branch_id)) {
                    $lr_number = $obj->automate_number($GLOBALS['lr_table'], 'lr_number', $gst_option, $from_branch_id);
                    if(empty($prev_lr_id)) {
                        $prev_lr_id = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_number', $lr_number, 'lr_id');
                    }
                }
                if(!empty($prev_lr_id) && $prev_lr_id != $GLOBALS['null_value'] && $prev_lr_id != $edit_id) {
                    $prev_lr_error = "LR number already exists";
                }
                $from_branch_name = ""; $to_branch_name = "";
                if(!empty($from_branch_id)) {
                    $from_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $from_branch_id, 'name');
                }
                else {
                    $from_branch_name = $GLOBALS['null_value'];
                }
                if(!empty($to_branch_id)) {
                    $to_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $to_branch_id, 'name');
                }
                else {
                    $to_branch_name = $GLOBALS['null_value'];
                }
                if(empty($delivery_charges)) {
                    $delivery_charges = $GLOBALS['null_value'];
                }
                if(empty($delivery_charges_value)) {
                    $delivery_charges_value = $GLOBALS['null_value'];
                }
                if(empty($unloading_charges)) {
                    $unloading_charges = $GLOBALS['null_value'];
                }
                if(empty($unloading_charges_value)) {
                    $unloading_charges_value = $GLOBALS['null_value'];
                }
                if(empty($loading_charges)) {
                    $loading_charges = $GLOBALS['null_value'];
                }
                if(empty($loading_charges_value)) {
                    $loading_charges_value = $GLOBALS['null_value'];
                }
                if(empty($gst_option)) {
                    $gst_option = 0;
                }
                if(empty($total_tax)) {
                    $total_tax = $GLOBALS['null_value'];
                }
                
                $send_lr_sms = 0; $balance = 0; $lr_id = "";
				
                if(empty($edit_id)) {
                    if(empty($prev_lr_id)) {
                        $action = "";
                        if(!empty($lr_number)) {
                            $action = "New LR Created. Name - ".$lr_number;
                        }
                        $columns = array('created_date_time', 'creator', 'creator_name', 'lr_id', 'lr_number', 'lr_date', 'reference_number', 'organization_id', 'consignor_id', 'consignee_id', 'consignor_name', 'consignee_name', 'bill_type', 'vehicle_id', 'bill_value', 'bill_number', 'bill_date', 'unit_id', 'quantity','weight', 'price_per_qty', 'freight', 'kooli_per_unit', 'kooli_per_qty', 'amount', 'delivery_charges', 'delivery_charges_value', 'unloading_charges', 'unloading_charges_value', 'loading_charges', 'loading_charges_value', 'gst_value', 'from_branch_id', 'from_branch_name', 'to_branch_id', 'to_branch_name', 'organization_state', 'consignor_state', 'consignee_state', 'from_branch_state', 'organization_details', 'consignor_details', 'consignee_details', 'vehicle_details', 'unit_name', 'round_off', 'total', 'deleted', 'cancelled', 'gst_option', 'tax_value', 'tax_option', 'cgst', 'sgst', 'igst', 'total_tax', 'invoice_status', 'invoice_number', 'invoice_date', 'is_cleared', 'is_luggage_entry', 'is_tripsheet_entry', 'city', 'consignee_city', 'received_person', 'received_mobile_number', 'received_identification', 'print_type', 'account_party_id', 'account_party_name', 'godown_id', 'tripsheet_number', 'luggagesheet_number', 'godown_name', 'account_party_details', 'total_qty','others_consignee_city');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'","'".$lr_number."'", "'".$lr_date."'", "'".$reference_number."'", "'".$organization_id."'", "'".$consignor_id."'", "'".$consignee_id."'", "'".$consignor_name."'", "'".$consignee_name."'", "'".$bill_type."'", "'".$vehicle_id."'", "'".$bill_value."'", "'".$bill_number."'", "'".$bill_date."'", "'".$unit_ids."'", "'".$quantity_values."'","'".$weight."'", "'".$price_per_quantity."'", "'".$freight_values."'", "'".$kooli_per_unit."'", "'".$kooli_per_quantity."'", "'".$amount_values."'", "'".$delivery_charges."'", "'".$delivery_charges_value."'", "'".$unloading_charges."'", "'".$unloading_charges_value."'", "'".$loading_charges."'", "'".$loading_charges_value."'", "'".$gst_value."'", "'".$from_branch_id."'", "'".$from_branch_name."'", "'".$to_branch_id."'", "'".$to_branch_name."'", "'".$organization_state."'", "'".$consignor_state."'", "'".$consignee_state."'", "'".$from_branch_state."'", "'".$organization_details."'", "'".$consignor_details."'", "'".$consignee_details."'", "'".$vehicle_details."'", "'".$unit_names."'", "'".$round_off."'", "'".$total_amount."'", "'0'", "'0'", "'".$gst_option."'", "'".$tax_value."'", "'".$tax_option."'", "'".$cgst."'", "'".$sgst."'", "'".$igst."'", "'".$total_tax."'", "'O'", "'".$invoice_number."'", "'".$invoice_date."'", "'".$is_cleared."'", "'".$is_luggage_entry."'", "'".$is_tripsheet_entry."'", "'".$city."'", "'".$consignee_city."'", "'".$received_person."'", "'".$received_mobile_number."'", "'".$received_identification."'", "'".$print_type."'", "'".$account_party_id."'", "'".$account_party_name."'", "'".$godown_id."'", "'".$tripsheet_number."'", "'".$luggagesheet_number."'", "'".$godown_name."'", "'".$account_party_details."'", "'".$total_quantity."'","'".$others_consignee_city."'");
                        $lr_insert_id = $obj->InsertSQL($GLOBALS['lr_table'], $columns, $values, $action);	
                        if(preg_match("/^\d+$/", $lr_insert_id)) {
                            if($lr_insert_id < 10) {
                                $lr_id = "lr_".date("dmYhis")."_0".$lr_insert_id;
                            }
                            else {
                                $lr_id = "lr_".date("dmYhis")."_".$lr_insert_id;
                            }
                            if(!empty($lr_id)) {
                                $lr_id = $obj->encode_decode('encrypt', $lr_id);
                            }
                            $columns = array(); $values = array();						
                            $columns = array('lr_id');
                            $values = array("'".$lr_id."'");
                            $lr_update_id = $obj->UpdateSQL($GLOBALS['lr_table'], $lr_insert_id, $columns, $values, '');
                            if(preg_match("/^\d+$/", $lr_update_id)) {		
                                $send_lr_sms = 1;
                                $balance = 1;
                                $result = array('number' => '1', 'msg' => 'LR Successfully Created','lr_id' => $lr_id);					
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $lr_update_id);
                            }
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $lr_insert_id);
                        }
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $prev_lr_error);
                    }
				}
				else {
					if(empty($prev_lr_id) || $prev_lr_id == $edit_id) {
						$getUniqueID = "";
						$getUniqueID = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $edit_id, 'id');
						if(preg_match("/^\d+$/", $getUniqueID)) {
							$action = "";
                            $action = "LR Updated.";
                            
							$columns = array(); $values = array();						
							$columns = array('creator_name', 'reference_number', 'organization_id', 'consignor_id', 'consignee_id',  'consignor_name', 'consignee_name', 'bill_type', 'unit_id', 'quantity','weight', 'price_per_qty', 'freight', 'kooli_per_unit', 'kooli_per_qty', 'amount', 'delivery_charges', 'delivery_charges_value', 'unloading_charges', 'unloading_charges_value', 'loading_charges', 'loading_charges_value', 'from_branch_id', 'from_branch_name', 'to_branch_id', 'to_branch_name', 'organization_state', 'consignor_state', 'consignee_state', 'from_branch_state', 'organization_details', 'consignor_details', 'consignee_details', 'unit_name', 'round_off', 'total', 'gst_option', 'tax_value', 'cgst', 'sgst', 'igst', 'total_tax', 'consignee_city', 'account_party_id', 'account_party_name', 'godown_id', 'godown_name', 'account_party_details', 'total_qty','others_consignee_city', 'lr_date');
                            $values = array("'".$creator_name."'", "'".$reference_number."'", "'".$organization_id."'", "'".$consignor_id."'", "'".$consignee_id."'", "'".$consignor_name."'", "'".$consignee_name."'", "'".$bill_type."'", "'".$unit_ids."'", "'".$quantity_values."'","'".$weight."'", "'".$price_per_quantity."'", "'".$freight_values."'", "'".$kooli_per_unit."'", "'".$kooli_per_quantity."'", "'".$amount_values."'", "'".$delivery_charges."'", "'".$delivery_charges_value."'", "'".$unloading_charges."'", "'".$unloading_charges_value."'", "'".$loading_charges."'", "'".$loading_charges_value."'", "'".$from_branch_id."'", "'".$from_branch_name."'", "'".$to_branch_id."'", "'".$to_branch_name."'", "'".$organization_state."'",  "'".$consignor_state."'", "'".$consignee_state."'", "'".$from_branch_state."'", "'".$organization_details."'", "'".$consignor_details."'", "'".$consignee_details."'", "'".$unit_names."'", "'".$round_off."'", "'".$total_amount."'", "'".$gst_option."'", "'".$tax_value."'", "'".$cgst."'", "'".$sgst."'", "'".$igst."'", "'".$total_tax."'", "'".$consignee_city."'", "'".$account_party_id."'", "'".$account_party_name."'", "'".$godown_id."'", "'".$godown_name."'", "'".$account_party_details."'", "'".$total_quantity."'","'".$others_consignee_city."'", "'".$lr_date."'");
							$lr_update_id = $obj->UpdateSQL($GLOBALS['lr_table'], $getUniqueID, $columns, $values, $action);
							if(preg_match("/^\d+$/", $lr_update_id)) {	
                                $send_lr_sms = 1; 
                                $balance = 1; $lr_id = $edit_id;
								$result = array('number' => '1', 'msg' => 'Updated Successfully', 'lr_id' => $edit_id);						
							}
							else {
								$result = array('number' => '2', 'msg' => $lr_update_id);
							}							
						}
					}
					else {
                        if(!empty($lr_error)) {
                            $result = array('number' => '2', 'msg' => $lr_error);
                        }
                        else if(!empty($prev_lr_error)) {
                            $result = array('number' => '2', 'msg' => $prev_lr_error);
                        }
					}
                }
                $party_name ="";
               if(!empty($balance) && $balance == 1 && !empty($lr_id)) { 
                    $branch_id = "";
                    if($bill_type == "ToPay") {
                        $branch_id = $to_branch_id;
                        $party_type = "Consignee";
                        $party_id = $consignee_id;
                        $party_name = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_id, 'name');
                    }
                    else if($bill_type == "Paid") {
                        $branch_id = $from_branch_id;
                        $party_type = "Consignor";
                        $party_id = $consignor_id;
                        $party_name = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_id, 'name');
                    }
                    else if($bill_type == "Account Party") {
                        $branch_id = $to_branch_id;
                        $party_type = "Account Party";
                        $party_id = $account_party_id;
                        $party_name = $obj->getTableColumnValue($GLOBALS['account_party_table'],'account_party_id',$account_party_id,'name');
                    }
                    $bill_company_id = $GLOBALS['bill_company_id']; $bill_id = $lr_id; $bill_date = $lr_date; $credit = 0; $debit = 0; $bill_type ="LR Entry"; $bill_number = $lr_number; $party_name =""; $payment_mode_id = $GLOBALS['null_value']; $payment_mode_name = $GLOBALS['null_value'];$bank_id = $GLOBALS['null_value'];$bank_name = $GLOBALS['null_value']; $open_balance_type = "Debit"; $payment_tax_type = $GLOBALS['null_value'];

                    $debit = $total_amount;
                    
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
                
                    $update_balance ="";
                    $update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type, $payment_tax_type, $branch_id);
                }
                if(!empty($send_lr_sms) && $send_lr_sms == 1) {
                    if(!empty($organization_id)) {
                        $send_sms = 2;
                        $send_sms = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $organization_id, 'send_sms');
                        if($send_sms != 1) {
                            $send_lr_sms = 0;
                        }
                    }
                }
                if(!empty($send_lr_sms) && $send_lr_sms == 1) {
                    if(!empty($lr_number) && !empty($consignee_name) && $consignee_name != $GLOBALS['null_value'] && !empty($consignee_city) && $consignee_city != $GLOBALS['null_value'] && !empty($consignor_name) && $consignor_name != $GLOBALS['null_value']) {
                        $details = $obj->encode_decode("decrypt",$consignee_name)." ".$obj->encode_decode("decrypt",$consignee_city)." TOTAL ITEMS ".$total_quantity.",";
                        //$lr_sms = $obj->encode_decode("decrypt",$consignor_name)."|".$details." LR NO".$lr_number;
                        $lr_sms = "MOHAN TRANSPORT - PARCEL HAS BEEN PICKED UP FROM ".$obj->encode_decode("decrypt",$consignor_name)." TO ".$details.", LR NO. ".$lr_number.". THANKS FOR YOUR SUPPORT. Track here : www.mohantransport.com";
                        //echo "lr_sms - ".$lr_sms."<br>"; exit;
                        if(!empty($lr_sms)) {
                            //echo "custom_consignor_mobile_number -  ".$custom_consignor_mobile_number.", custom_consignee_mobile_number - ".$custom_consignee_mobile_number;
                            if(!empty($consignor_mobile_number) && $consignor_mobile_number != $GLOBALS['null_value']) {
                                $consignor_mobile_number = $obj->encode_decode('decrypt',$consignor_mobile_number);
                                $sms_response = "";
                                $sms_response = $obj->send_mobile_details($consignor_mobile_number, '1607100000000317715', $lr_sms);                                
                                $columns = array('created_date_time', 'creator', 'creator_name','lr_number', 'mobile_number', 'type');
                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$lr_number."'", "'".$consignor_mobile_number."'", "'LR'");
                                $clr_sms_insert_id = $obj->InsertSQL($GLOBALS['sms_count_table'], $columns, $values, 'Consignor LR SMS send Successfully');
                            }
                            if(!empty($consignee_mobile_number) && $consignee_mobile_number != $GLOBALS['null_value']) {
                                $consignee_mobile_number = $obj->encode_decode('decrypt',$consignee_mobile_number);
                                $sms_response = "";
                                $sms_response = $obj->send_mobile_details($consignee_mobile_number, '1607100000000317715', $lr_sms);
                                $columns = array('created_date_time', 'creator', 'creator_name','lr_number', 'mobile_number', 'type');
                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$lr_number."'", "'".$consignee_mobile_number."'", "'LR'");
                                $clr_sms_insert_id = $obj->InsertSQL($GLOBALS['sms_count_table'], $columns, $values, 'Consignee LR SMS send Successfully');
                            }
                        }
                    }
                }
            }
            else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
        }
        else {
            if(!empty($valid_lr)) {
				$result = array('number' => '3', 'msg' => $valid_lr);
			}
            else if(!empty($products_error)) {
				$result = array('number' => '2', 'msg' => $products_error);
			}
        }
        if(!empty($result)) {
			$result = json_encode($result);
		}
        echo $result;
        exit;
    }
    if(isset($_POST['draw'])){
        $draw = trim($_POST['draw']);

        $search_text = ""; $from_date = ""; $to_date = ""; $from_branch_filter = ""; $to_branch_filter = ""; $bill_type = "";
        $consignor_id = ""; $consignee_id = ""; $show_bill = 0; $organization_id = $GLOBALS['bill_company_id']; $filter_gst_option = "";
        if(isset($_POST['start'])) {
            $row = trim($_POST['start']);
        }
        if(isset($_POST['length'])) {
            $rowperpage = trim($_POST['length']);
        }
        if(isset($_POST['search_text'])) {
            $search_text = trim($_POST['search_text']);
        }
        if(isset($_POST['from_date'])) {
            $from_date = trim($_POST['from_date']);
        }
        if(isset($_POST['to_date'])) {
            $to_date = trim($_POST['to_date']);
        }
        if(isset($_POST['from_branch_filter'])) {
            $from_branch_filter = trim($_POST['from_branch_filter']);
        }
        if(isset($_POST['to_branch_filter'])) {
            $to_branch_filter = trim($_POST['to_branch_filter']);
        }
        if(isset($_POST['bill_type'])) {
            $bill_type = trim($_POST['bill_type']);
        }
        if(isset($_POST['consignor_id'])) {
            $consignor_id = trim($_POST['consignor_id']);
        }
        if(isset($_POST['consignee_id'])) {
            $consignee_id = trim($_POST['consignee_id']);
        }
        if(isset($_POST['show_bill'])) {
            $show_bill = trim($_POST['show_bill']);
        }
        if(isset($_POST['filter_gst_option'])) {
            $filter_gst_option = trim($_POST['filter_gst_option']);
        }
        if(empty($from_branch_filter) && !empty($login_branch_id)) {
            $from_branch_filter = $login_branch_id;
        }
        $page_title = "LR";
        $order_column = "";
        $order_column_index = "";
        $order_direction = "";

        if(isset($_POST['order'][0]['column'])) {
            $order_column_index = intval($_POST['order'][0]['column']);
        }
        if(isset($_POST['order'][0]['dir'])) {
            $order_direction = $_POST['order'][0]['dir'] === 'desc' ? 'DESC' : 'ASC';
        }
        $columns = [
            0 => '',
            1 => 'lr_date',
            2 => 'lr_number',
            3 => 'consignor_name',
            4 => 'consignee_name',
            5 => 'from_branch_name',
            6 => 'to_branch_name',
            7 => 'total',
            8 => 'bill_type',
            9 => 'tripsheet_number',
            10 => '',
            11 => ''
        ];
        if(!empty($order_column_index) && isset($columns[$order_column_index])) {
            $order_column = $columns[$order_column_index];
        }
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        $totalRecords = 0; $filteredRecords = 0;
        if(empty($access_error)) {
            $totalRecords = count($obj->getLRListRecords($row, $rowperpage, $search_text, $organization_id, $from_date, $to_date, $from_branch_filter, $to_branch_filter, $consignee_id, $consignor_id, $bill_type, $show_bill, $order_column, $order_direction, $filter_gst_option));
            $filteredRecords = count($obj->getLRListRecords('', '', $search_text, $organization_id, $from_date, $to_date, $from_branch_filter, $to_branch_filter, $consignee_id, $consignor_id, $bill_type, $show_bill, $order_column, $order_direction,$filter_gst_option));
        }

        $data = [];
        $permission_module = $GLOBALS['lr_module'];

        $lr_list = $obj->getLRListRecords($row, $rowperpage, $search_text, $organization_id, $from_date, $to_date, $from_branch_filter, $to_branch_filter, $consignee_id, $consignor_id, $bill_type, $show_bill, $order_column, $order_direction, $filter_gst_option);
        $sno = $row + 1;
        
        if(empty($access_error)) {
            foreach ($lr_list as $val) {
                $lr_date = ""; $lr_number = ""; $consignor_name = ""; $consignee_name = ""; $from_branch_name = ""; $to_branch_name = ""; 
                $total = ""; $bill_type = ""; $tripsheet_number = "";

                if(!empty($val['lr_date']) && $val['lr_date'] != "0000-00-00") {
                    $lr_date = date('d-m-Y', strtotime($val['lr_date']));
                }
                if(!empty($val['lr_number']) && $val['lr_number'] != $GLOBALS['null_value']) {
                    $lr_number = $val['lr_number'];
                }
                if(!empty($val['consignor_name']) && $val['consignor_name'] != $GLOBALS['null_value']) {
                    $consignor_name = $obj->encode_decode('decrypt', $val['consignor_name']);
                }
                if(!empty($val['consignee_name']) && $val['consignee_name'] != $GLOBALS['null_value']) {
                    $consignee_name = $obj->encode_decode('decrypt', $val['consignee_name']);
                }
                if(!empty($val['from_branch_name']) && $val['from_branch_name'] != $GLOBALS['null_value']) {
                    $from_branch_name = $obj->encode_decode('decrypt', $val['from_branch_name']);
                }
                if(!empty($val['to_branch_name']) && $val['to_branch_name'] != $GLOBALS['null_value']) {
                    $to_branch_name = $obj->encode_decode('decrypt', $val['to_branch_name']);
                }
                if(!empty($val['total']) && $val['total'] != $GLOBALS['null_value']) {
                    $total = $val['total'];
                }
                if(!empty($val['bill_type']) && $val['bill_type'] != $GLOBALS['null_value']) {
                    $bill_type = $val['bill_type'];
                }
                if(!empty($val['tripsheet_number']) && $val['tripsheet_number'] != $GLOBALS['null_value']) {
                    $tripsheet_number = $val['tripsheet_number'];
                }
                $rpt_type = '<select name="rpt_type" id="rpt_type'.$val['lr_id'].'" class="form-control shadow-none"><option value="all">All</option><option value="1">Consignor Type</option><option value="2">Consignee Type</option><option value="3">Lorry Type</option></select>';

                $action = ""; $edit_option = ""; $delete_option = ""; $print_option = "";
                $print_option = '<a class="pr-2" href="Javascript:OpenPDF('.'\''.$val['lr_id'].'\''.');"><i class="fa fa-print"></i></a>';
                $access_error = "";
                if(!empty($login_staff_id)) {
                    $permission_action = $edit_action;
                    include('permission_action.php');
                }
                if(empty($access_error) && empty($val['cancelled']) && empty($val['is_tripsheet_entry'])) {
                    $edit_option = '<a class="pr-2" href="Javascript:ShowModalContent('.'\''.$page_title.'\''.', '.'\''.$val['lr_id'].'\''.');"><i class="fa fa-pencil"></i></a>';
                }
                $access_error = "";
                if(!empty($login_staff_id)) {
                    $permission_action = $delete_action;
                    include('permission_action.php');
                }
                if(empty($access_error) && empty($val['cancelled']) && empty($val['is_tripsheet_entry'])) {
                    $delete_option = '<a class="pr-2" href="Javascript:DeleteModalContent('.'\''.$page_title.'\''.', '.'\''.$val['lr_id'].'\''.');"><i class="fa fa-trash"></i></a>';
                }
                $action = $print_option.$edit_option.$delete_option;

                $data[] = [
                    "sno" => $sno++,
                    "lr_date" => $lr_date,
                    "lr_number" => $lr_number,
                    "consignor_name" => $consignor_name,
                    "consignee_name" => $consignee_name,
                    "from_branch_name" => $from_branch_name,
                    "to_branch_name" => $to_branch_name,
                    "total" => $total,
                    "bill_type" => $bill_type,
                    "tripsheet_number" => $tripsheet_number,
                    "rpt_type" => $rpt_type,
                    "action" => $action
                ];
            }
        }

        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ];

        echo json_encode($response);
    }
    if(isset($_REQUEST['delete_lr_id'])) {
		$delete_lr_id = $_REQUEST['delete_lr_id'];
		$msg = "";
		if(!empty($delete_lr_id)) {
			$lr_unique_id = "";
			$lr_unique_id = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $delete_lr_id, 'id');
			// $primary_consignee = "";
			// $primary_consignee = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $delete_consignee_id, 'primary_consignee');
			if(!empty($lr_unique_id)) {
				if(preg_match("/^\d+$/", $lr_unique_id)) {
					// $name = "";
					// $name = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $delete_lr_id, 'name');
				 
					$action = ""; $payment_unique_id = ""; $update = "";
					// if(!empty($name)) {
					// 	$action = "lr Deleted. Name - ".$obj->encode_decode('decrypt', $name);
					// }

                        $columns = array(); $values = array();						
                        $columns = array('cancelled');
                        $values = array("'1'");
                        $msg = $obj->UpdateSQL($GLOBALS['lr_table'], $lr_unique_id, $columns, $values, $action);

                    $payment_unique_id = $obj->getTableColumnValue($GLOBALS['payment_table'], 'bill_id', $delete_lr_id, 'id');
                    if(preg_match("/^\d+$/", $payment_unique_id)) {
                        $action = "Payment Deleted.";
                    
                        $columns = array(); $values = array();						
                        $columns = array('deleted');
                        $values = array("'1'");
                        $update = $obj->UpdateSQL($GLOBALS['payment_table'], $payment_unique_id, $columns, $values, $action);
                    }
                 
                
				}
			}
			else {
				$msg = "Unable to Delete";
			}
		}
		echo $msg;
		exit;	
	} 
    if(isset($_REQUEST['payment_status']))
    { 
        $select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE  is_tripsheet_entry='1' AND deleted='0' AND bill_type != 'Paid' ";
        $lr_numbers = $obj->getQueryRecords($GLOBALS['lr_table'],$select_query);      
        ?>
                    
        <form name="lr_form" method="post">
            <div class="row">
                <!-- <div class="form-group col-3 mx-5 ">
                    <div class="form-label-group in-border mb-0">
                        <label>Bill Type</label>
                    </div>
                </div> -->
                <div class="form-group col-3">
                    <div class="form-label-group in-border mb-0">
                         <select class="form-control"  name="payment_bill_type" id="bill_type" > 
                                <option value="paid">Paid</option>
                            </select>
                        <label>Bill Type</label>
                    </div>
                </div>
                <table class="table nowrap table-bordered lr_table">
                    <thead class="bg-pinterest">
                        <tr class="text-white">
                            <th><input type="checkbox" onClick="Javascript:SelectAllModuleLRActionToggle(this, 'selectAll')" name="selectAll" id="selectAll"></th>
                            <th>LR No</th>
                            <th>LR Date </th>
                            <th>Branch</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(!empty($lr_numbers))
                            {
                                foreach($lr_numbers as $data)
                                { 
                                    $check_box = 2;
                                    $branch_name = "";
                                    if(!empty($data['lr_date']))
                                    {
                                        $lr_date = $data['lr_date'];
                                    }
                                    if(!empty($data['lr_id']))
                                    {
                                        $lr_id = $data['lr_id'];
                                    }
                                    if(!empty($data['lr_number']))
                                    {
                                        $lr_number = $data['lr_number'];
                                    }
                                    if(!empty($data['branch_id']))
                                    {
                                        $branch_id = $data['branch_id'];
                                        $branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$branch_id,'name');
                                        if(!empty($branch_name))
                                        {
                                            $branch_name = $obj->encode_decode("decrypt",$branch_name);
                                        }
                                    }
                                        
                                    if(!empty($organization_id))
                                    {
                                        $organization_name = $obj->getTableColumnValue($GLOBALS['organization_table'],'organization_id',$organization_id,'name');
                                        if(!empty($organization_name))
                                        {
                                            $organization_name = $obj->encode_decode("decrypt",$organization_name);
                                        }
                                    } ?>
                                    <tr class="lr_row" id="lr_row<?php if(!empty($lr_row_index)) { echo $lr_row_index; } ?>">
                                    <input type="hidden" name="lr_id[]" value="<?php if(!empty($lr_id)){ echo $lr_id; }?>">
                                        <td class="text-center <?php echo $lr_id;?>paid_checkbox">
                                            <input type="checkbox" onClick="Javascript:CustomCheckboxLRToggle(this, '<?php if(!empty($lr_id)){ echo $lr_id; }?>paid_checkbox');" id="<?php if(!empty($lr_id)) { echo $lr_id; } ?>paid_checkbox" name="<?php if(!empty($lr_id)){ echo $lr_id; }?>paid_checkbox" value="<?php if(!empty($check_box)){ echo $check_box; }?>">
                                        </td> 
                                        <td>
                                            <?php echo date('d-m-Y',strtotime($lr_date)); ?>
                                        </td>
                                        <td>
                                            <?php echo $lr_number; ?>
                                            <input type="hidden" name="lr_numbers[]" value="<?php if(!empty($lr_number)){ echo $lr_number; }?>">
                                        </td>
                                        <td>
                                            <?php echo $branch_name; ?>
                                            
                                        </td>
                                        
                                    </tr>
                                <?php }
                            }
                        ?>
                    </tbody>
                </table>
                <button class="btn btn-dark btnwidth submit_button" type="button" onClick="Javascript:SaveModalContent('lr_form', 'lr_changes.php', 'lr.php');">Submit</button> 
            </div>
               
        
        </form>
        <?php
    }
    if(isset($_POST['payment_bill_type'])) {
		$lr_numbers = $_POST['lr_numbers'];
		$msg = ""; $paid_checkbox = array();
        $lr_ids = array(); $msg = "";
        if(isset($_POST['lr_id']))
        {
            $lr_ids = $_POST['lr_id'];
        } 
        $result = "";
        for($i=0;$i<count($lr_ids);$i++)
        {
            $is_checked = $lr_ids[$i].'paid_checkbox';
            if(isset($_POST[$is_checked]))
            {
                $check_box = 2;
                if($check_box != 1 && $check_box != 2) { $check_box = 2; }
                $check_box = $_POST[$is_checked];
                if($check_box == 1)
                {
                    // if(!empty($delete_lr_id)) {
                        $lr_unique_id = "";
                        $lr_unique_id = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $lr_ids[$i], 'id');
            
                        if(!empty($lr_unique_id)) {
                            if(preg_match("/^\d+$/", $lr_unique_id)) {
                                // $name = "";
                                // $name = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $delete_lr_id, 'name');
                            
                                $action = "";
                                // if(!empty($name)) {
                                // 	$action = "lr Deleted. Name - ".$obj->encode_decode('decrypt', $name);
                                // }
            
                                $columns = array(); $values = array();						
                                $columns = array('bill_type');
                                $values = array("'Paid'");
                                $msg = $obj->UpdateSQL($GLOBALS['lr_table'], $lr_unique_id, $columns, $values, $action);
                                if(preg_match("/^\d+$/", $msg)) {
                                    // $update_stock = 1;
                                    $result = array('number' => '1', 'msg' => 'Updated Successfully');
                                }
                    
                            }
                        }
                        else {
                            $result = "Unable to Delete";
                        }
                    // }
                }
            }
        }
		
		if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;
    
	} 
    
    if(isset($_REQUEST['others_city']))
    {
        $other_city = $_REQUEST['others_city'];
        if($other_city == '1') { ?>
            <div class="form-group mb-1">
                <div class="form-label-group in-border pb-2">
                    <input type="text" name="others_city" class="form-control shadow-none" style="margin: 0;">
                    <label>Others City</label>
                </div>
            </div>
        <?php }
    }
?>