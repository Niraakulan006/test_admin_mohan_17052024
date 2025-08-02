<?php
	include("include_files.php");
	$login_staff_id = "";
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
			$login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			$permission_module = $GLOBALS['account_party_module'];
		}
	}
	if(isset($_REQUEST['show_account_party_id'])) { 
        $show_account_party_id = $_REQUEST['show_account_party_id'];
		 $cooly_values = array();
        $name = ""; $mobile_number = ""; $account_party_name = ""; $password = ""; $address = ""; $city = ""; $state = ""; $gst_number = ""; $identification = "";$country = "India"; $district = ""; $unit_count = 0; $unit_ids = array(); $unit_names = array(); $price_values = array();
        if(!empty($show_account_party_id)) {
            $account_party_list = array();
			$account_party_list = $obj->getTableRecords($GLOBALS['account_party_table'], 'account_party_id', $show_account_party_id);
            if(!empty($account_party_list)) {
                foreach($account_party_list as $data) {
                    if(!empty($data['name'])) {
                        $name = $obj->encode_decode('decrypt', $data['name']);
					}
					if(!empty($data['mobile_number'])) {
                        $mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
					}
                    if(!empty($data['address']) && $data['address'] != "NULL") {
                        $address = html_entity_decode($obj->encode_decode('decrypt', $data['address']));
					}
					if(!empty($data['city']) && $data['city'] != "NULL") {
                        $city = html_entity_decode($obj->encode_decode('decrypt', $data['city']));
					}
					if(!empty($data['district']) && $data['district'] != "NULL") {
                        $district = html_entity_decode($obj->encode_decode('decrypt', $data['district']));
					}
                    if(!empty($data['gst_number'])  && $data['gst_number'] != "NULL") {
                        $gst_number = $obj->encode_decode('decrypt', $data['gst_number']);
					}
                    if(!empty($data['state']) && $data['state'] != "NULL") {
                        $state = $obj->encode_decode('decrypt', $data['state']);
					}
                    if(!empty($data['identification']) && $data['identification'] != "NULL") {
                        $identification = $obj->encode_decode('decrypt', $data['identification']);
					}	
					if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
						$unit_ids = explode(",", $data['unit_id']);
						$unit_count = count($unit_ids);
					}
					if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
						$unit_names = explode(",", $data['unit_name']);
					}
					if(!empty($data['price_value']) && $data['price_value'] != $GLOBALS['null_value']) {
						$price_values = explode(",", $data['price_value']);
					}
					if(!empty($data['opening_balance']) && $data['opening_balance'] != $GLOBALS['null_value']){
                        $opening_balance = $data['opening_balance'];
                    }
                    if(!empty($data['opening_balance_type']) && $data['opening_balance_type'] != $GLOBALS['null_value']){
                        $opening_balance_type = $data['opening_balance_type'];
                    }
					if(!empty($data['cooly_value']) && $data['cooly_value'] != $GLOBALS['null_value']) {
						$cooly_values = explode(",", $data['cooly_value']);
					}
                }
            }
		}
		$unit_list = array();
		$unit_list = $obj->getTableRecords($GLOBALS['unit_table'], '', '');
 
		?>
        <form class="pd-20" name="account_party_form" method="POST">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
						<h5 class="text-white">Edit Account Party</h5>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('account_party.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
			<div class="row p-3">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_account_party_id)) { echo $show_account_party_id; } ?>">
				<div class="col-lg-3 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="name" name="name" class="form-control shadow-none"  value="<?php if(!empty($name)){ echo $name; } ?>" placeholder="Account Party Name">
                            <label>Account Party Name <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control shadow-none" value="<?php if(!empty($mobile_number)){ echo $mobile_number; } ?>"  onfocus="Javascript:KeyboardControls(this,'mobile_number');" placeholder="Account Party Number">
                            <label>Account Party Number <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="identification" name="identification" class="form-control shadow-none" value="<?php if(!empty($identification)){ echo $identification; } ?>" placeholder="Account Party Identification">
                            <label>Account Party Identification</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address"><?php if(!empty($address)){ echo $address; } ?></textarea>
                            <label>Account Party Address</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
							<div class="w-100" style="display: none;">
								<select name="country" class="form-control">
									<option value="">Select</option>
								</select>
							</div>
                            <select name="state" class="form-control shadow-none" id="state" onchange="Javascript:getStates('account_party',this.value, '', '');">
								<option value="">Select State</option>
                            </select>
                            <label>State <span class="text-danger">*</span></label>
                        </div> 
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <select name="district" class="form-control shadow-none" id="district" onchange="Javascript:getDistricts('account_party', this.value, '');">
								<option value="">Select District</option>
                            </select>
                            <label>District</label>
                        </div> 
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <select name="city" class="form-control shadow-none" id="city" onchange="Javascript:getCities('account_party', '', this.value);">
								<option value="">Select City</option>
                            </select>
                            <label>City</label>
                        </div> 
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 col-12 mb-3 d-none" id="others_city_cover">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="others_city" name="others_city" class="form-control shadow-none"  placeholder="">
                            <label>Others city</label>
                        </div> 
                    </div>
                </div>
				<div class="col-lg-4 col-md-4 col-12 ">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" id="opening_balance" name="opening_balance" class="form-control shadow-none" required  value="<?php if(!empty($opening_balance)){echo $opening_balance;} ?>" onfocus="Javascript:KeyboardControls(this,'number',15,1);" maxlength="15">
                                <label>Opening Balance</label>
                                <div class="input-group-append" style="width:40%!important;">
                                  <select name="opening_balance_type" class="select2 select2-danger" placeholder="Select Opening Balance Type" style="width: 100%;" onchange="Javascript:InputBoxColor(this,'select');">
                                    <option value="0">Select</option>
                                    <option value="Credit" <?php if(!empty($opening_balance_type) && $opening_balance_type == "Credit"){ ?>selected<?php } ?>>Credit</option>
                                    <option value="Debit" <?php if(!empty($opening_balance_type) && $opening_balance_type == "Debit"){ ?>selected<?php } ?>>Debit</option>
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			
			<div class="row p-3 justify-content-center">
				<div class="col-lg-6 col-md-10 col-12">
					<div class="form-group mb-1 text-right">
						<div class="form-label-group in-border pb-2">
							<button type="button" class="btn btn-primary px-2 py-1" style="font-size:11px!important;" onclick="Javascript:AddUnitPriceRow();">
                                Add New Row&nbsp;<i class="fa fa-plus-circle"></i>
                            </button>
						</div>
					</div>
					<div class="table-responsive tableheight">
						<input type="hidden" name="unit_count" value="<?php echo $unit_count; ?>">
						<table class="table table-nowrap table-bordered border nowrap smallfnt cursor text-center w-100 unit_price_table">
							<thead class="bg-dark text-white" style="position:sticky; top:0; left:0; z-index:10!important;">
								<tr>
									<th class="text-center px-2 py-2" style="width:50px!important;">S.No</th>
									<th class="text-center px-2 py-2" style="width:100px!important;">Unit</th>
									<th class="text-center px-2 py-2" style="width:100px!important;">Price</th>
									<th class="text-center px-2 py-2" style="width:100px!important;">Cooly</th>
									<th class="text-center px-2 py-2" style="width:50px!important;">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(empty($show_account_party_id) || empty($unit_ids)) {
										?>
										<tr class="no_data_row">
											<th class="text-center px-2 py-2" colspan="4">No Data Found!</th>
										</tr>
										<?php
									}
									else {
										if(!empty($unit_ids) && !empty($price_values)) {
											for($i=0; $i < count($unit_ids); $i++) {
												?>
												<tr class="product_row" id="product_row<?php echo $i+1; ?>">
													<th class="text-center px-2 py-2 sno"><?php echo $i+1; ?></th>
													<th class="text-center px-2 py-2">
														<div class="form-group">
															<div class="form-label-group in-border" style="min-width:80px!important;">
																<select name="unit_id[]" class="form-control shadow-none" style="width:100%!important;">
																	<option value="">Select</option>
																	<?php
																		if(!empty($unit_list)) {
																			foreach($unit_list as $data) {
																				if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
																					?>
																					<option value="<?php echo $data['unit_id']; ?>" <?php if(!empty($unit_ids[$i]) && $unit_ids[$i] == $data['unit_id']) { ?>selected<?php } ?>>
																						<?php
																							if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
																								echo $obj->encode_decode('decrypt', $data['unit_name']);
																							}
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
													</th>
													<th class="text-center px-2 py-2">
														<div class="form-group">
															<div class="form-label-group in-border">
																<input type="text" name="price_value[]" class="form-control shadow-none mx-auto" style="min-width:80px!important;" onfocus="Javascript:KeyboardControls(this,'number','','');" onkeyup="Javascript:InputBoxColor(this, 'text');" value="<?php if(!empty($price_values[$i])) { echo $price_values[$i]; } ?>">
															</div>
														</div>
													</th>
													<th class="text-center px-2 py-2">
														<div class="form-group">
															<div class="form-label-group in-border">
																<input type="text" name="cooly_value[]" class="form-control shadow-none mx-auto" style="min-width:80px!important;" onfocus="Javascript:KeyboardControls(this,'number','','');" onkeyup="Javascript:InputBoxColor(this, 'text');" value="<?php if(!empty($cooly_values[$i])) { echo $cooly_values[$i]; } ?>">
															</div>
														</div>
													</th>
													<th class="text-center px-2 py-2">
														<button class="btn btn-danger px-2 py-1" type="button" style="font-size:10px!important;" onclick="Javascript:DeleteUnitPriceRow('product_row', '<?php echo $i+1; ?>');"><i class="fa fa-trash"></i></button>
													</th>
												</tr>
												<?php
											}
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-12 pt-3 text-center">
				<button class="btn btn-dark" type="button"  onClick="Javascript:SaveModalContent('account_party_form', 'account_party_changes.php', 'account_party.php');">
					Submit
				</button>
			</div>
			<script src="include/js/countries.js"></script>
			<script src="include/js/district.js"></script>
			<script src="include/js/cities.js"></script>
			<script src="include/select2/js/select2.min.js"></script>
			<script src="include/select2/js/select.js"></script>
			<script type="text/javascript">                
				jQuery(document).ready(function(){
					getCountries('account_party','<?php if(!empty($country)) { echo $country; } ?>', '<?php if(!empty($state)) { echo $state; } ?>', '<?php if(!empty($district)) { echo $district; } ?>', '<?php if(!empty($city)) { echo $city; } ?>');
				});
			</script>
        </form>
		<?php
    } 
    if(isset($_POST['name'])) {	
        $name = ""; $name_error = ""; $address = ""; $address_error = ""; $city = ""; $city_error = ""; $mobile_number = ""; $mobile_number_error = ""; $state = ""; $state_error = ""; $gst_number = ""; $gst_number_error = ""; 
        $valid_account_party = ""; $form_name = "account_party_form"; $others_city ="";$others_city_error = "";
		$unit_ids = array(); $unit_names = array(); $price_values = array(); $unit_price_ids = array();
		 $opening_balance_type = ""; $opening_balance_type_error = "";$cooly_values = array();
		if(isset($_POST['identification']))
		{
			$identification = $_POST['identification'];
		}

		
        if(isset($_POST['name']))
		{
			$name = $_POST['name'];
		}
       if(empty($name)){
			$name_error = "Enter account party Name";
		}

		if(!empty($name_error)) {
			$valid_account_party = $valid->error_display($form_name, "name", $name_error, 'text');
        }

		if(isset($_POST['mobile_number']))
		{
			$mobile_number = $_POST['mobile_number'];
		}
        $mobile_number_error = $valid->valid_mobile_number($mobile_number, "Mobile Number", "1");
		if(!empty($mobile_number_error)) {
			if(!empty($valid_account_party)) {
				$valid_account_party = $valid_account_party." ".$valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
			}
			else {
				$valid_account_party = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
			}
		}

		if(isset($_POST['address'])) {
			$address = htmlentities($_POST['address'],ENT_QUOTES);
		}
		

		// City
        if(isset($_POST['city'])){
            $city = $_POST['city'];
        }
		if(!empty($city))
		{
			$city = htmlentities($city,ENT_QUOTES);
		}

		// District
        if(isset($_POST['district'])){
            $district = $_POST['district'];
        }
		if(!empty($district))
		{
			$district = htmlentities($district,ENT_QUOTES);
		}
		

        if(isset($_POST['state'])) {
			$state = $_POST['state'];
			$state = $valid->clean_value($state);
		}
		if(empty($state)) {
			$state_error = "Select the state";
			if(!empty($valid_account_party)) {
				$valid_account_party = $valid_account_party." ".$valid->error_display($form_name, "state", $state_error, 'select');
			}
			else {
				$valid_account_party = $valid->error_display($form_name, "state", $state_error, 'select');
			}
		}

		if(isset($_POST['identification'])){
			$identification = $_POST['identification'];
		}
		
		if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
		}

        if(isset($_POST['others_city']))
		{
			$others_city = $_POST['others_city'];
            if($city == "Others"){
                $others_city_error = $valid->valid_text($others_city,'City','1');
                if(!empty($others_city_error)){
                    if(!empty($valid_account_party)) {
						$valid_account_party = $valid_account_party." ".$valid->error_display($form_name, "others_city", $others_city_error, 'text');
					}
					else {
						$valid_account_party = $valid->error_display($form_name, "others_city", $others_city_error, 'text');
					}
                }
                else{
                    $city = $others_city;
                    $city = $valid->clean_value($city);
                }
            }
		}
		 if(isset($_POST['opening_balance'])){
            $opening_balance = $_POST['opening_balance'];
            if(!empty($opening_balance)){
            
                // if($opening_balance > 99999999){
                //     $opening_balance_error = "Only 8 digits allowed";
                // }
                // else{
                    $opening_balance_error = $valid->valid_price($opening_balance,"opening balance",'0','');
                // }
            }
        }

        if(isset($_POST['opening_balance_type'])){
            $opening_balance_type = $_POST['opening_balance_type'];
            if(!empty($opening_balance) && empty($opening_balance_error)){
                if(empty($opening_balance_type)){
                    $opening_balance_type_error = "Select opening balance type";
                }
                if(!empty($opening_balance_type_error)){
                    if(!empty($valid_account_party)) {
                        $valid_account_party = $valid_account_party." ".$valid->error_display($form_name, "opening_balance", $opening_balance_type_error, 'input_group');
                    }
                    else {
                        $valid_account_party = $valid->error_display($form_name, "opening_balance", $opening_balance_type_error, 'input_group');
                    }
                }
            }
        }

        if(!empty($opening_balance_type) && empty($opening_balance)){
            $opening_balance_error = "Enter opening balance as type is selected";
        }
        if(!empty($opening_balance_error)){
            if(!empty($valid_account_party)) {
                $valid_account_party = $valid_account_party." ".$valid->error_display($form_name, "opening_balance", $opening_balance_error, 'input_group');
            }
            else {
                $valid_account_party = $valid->error_display($form_name, "opening_balance", $opening_balance_error, 'input_group');
            }
        }
		// if(empty($gst_number) && empty($identification)){
		// 	$account_party_error = "Enter GST or Identification";
		// }
		if(isset($_POST['unit_id'])) {
			$unit_ids = $_POST['unit_id'];
		}
		if(isset($_POST['price_value'])) {
			$price_values = $_POST['price_value'];
		}
		if(isset($_POST['cooly_value'])) {
			$cooly_values = $_POST['cooly_value'];
		}
		if(!empty($unit_ids)) {
			for($i=0; $i < count($unit_ids); $i++) {
				$unit_ids[$i] = trim($unit_ids[$i]);
				if(isset($unit_ids[$i])) {
					$unit_id_error = "";
					$unit_id_error = $valid->common_validation($unit_ids[$i], 'Unit', 'select');
					if(!empty($unit_id_error)) {
                        if(!empty($valid_account_party)) {
                            $valid_account_party = $valid_account_party." ".$valid->row_error_display($form_name, 'unit_id[]', $unit_id_error, 'select', 'product_row', ($i+1));
                        }
                        else {
                            $valid_account_party = $valid->row_error_display($form_name, 'unit_id[]', $unit_id_error, 'select', 'product_row', ($i+1));
                        }
                    }
				}
				$price_values[$i] = trim($price_values[$i]);
				if(isset($price_values[$i])) {
					$price_value_error = "";
					$price_value_error = $valid->valid_price($price_values[$i], 'Price', 1);
					if(!empty($price_value_error)) {
                        if(!empty($valid_account_party)) {
                            $valid_account_party = $valid_account_party." ".$valid->row_error_display($form_name, 'price_value[]', $price_value_error, 'text', 'product_row', ($i+1));
                        }
                        else {
                            $valid_account_party = $valid->row_error_display($form_name, 'price_value[]', $price_value_error, 'text', 'product_row', ($i+1));
                        }
                    }
				}
				$cooly_values[$i] = trim($cooly_values[$i]);
				if(isset($cooly_values[$i])) {
					$cooly_value_error = "";
					$cooly_value_error = $valid->valid_price($cooly_values[$i], 'Cooly', 1);
					if(!empty($cooly_value_error)) {
                        if(!empty($valid_account_party)) {
                            $valid_account_party = $valid_account_party." ".$valid->row_error_display($form_name, 'cooly_value[]', $cooly_value_error, 'text', 'product_row', ($i+1));
                        }
                        else {
                            $valid_account_party = $valid->row_error_display($form_name, 'cooly_value[]', $cooly_value_error, 'text', 'product_row', ($i+1));
                        }
                    }
				}
				if(empty($valid_account_party)) {
					for($j=0; $j < count($unit_ids); $j++) {
						if($unit_ids[$i] == $unit_ids[$j]) {
							$already_exists_error = "This unit already exists above";
							if(!empty($already_exists_error) && $j > $i) {
								if(!empty($valid_account_party)) {
									$valid_account_party = $valid_account_party." ".$valid->row_error_display($form_name, 'unit_id[]', $already_exists_error, 'select', 'product_row', ($j+1));
								}
								else {
									$valid_account_party = $valid->row_error_display($form_name, 'unit_id[]', $already_exists_error, 'select', 'product_row', ($j+1));
								}
							}
						}
					}
					if(empty($valid_account_party)) {
						$unit_name = "";
						$unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_ids[$i], 'unit_name');
						$unit_names[$i] = $unit_name;
						$unit_price_ids[] = $obj->getUnitPriceUniqueID('Account Party', $edit_id, $unit_ids[$i]);
					}
				}
			}
		}
		$result = "";
		
		if(empty($valid_account_party) && empty($account_party_error)) {
			$check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
				if(!empty($edit_id)) {
					$prev_unit_list = $obj->getTableRecords($GLOBALS['unit_price_table'], 'party_id', $edit_id);
					if(!empty($prev_unit_list)) {
						foreach($prev_unit_list as $data) {
							if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value'] && !in_array($data['id'], $unit_price_ids)) {
								$action = "Unit Price Deleted";
								$columns = array(); $values = array();
								$columns = array('deleted');
								$values = array("'1'");
								$unit_price_update_id = $obj->UpdateSQL($GLOBALS['unit_price_table'], $data['id'], $columns, $values, $action);
							}
						}
					}
				}
                if(!empty($name)) {
					$name = $obj->encode_decode('encrypt', $name);
                }

				if(!empty($address)) {
                    $address = $obj->encode_decode('encrypt', $address);
                }
				else {
					$address = $GLOBALS['null_value'];
				}

				if(!empty($city)) {
                    $city = $obj->encode_decode('encrypt', $city);
                }
				else {
                    $city = $GLOBALS['null_value'];
                }
				if(!empty($district)) {
                    $district = $obj->encode_decode('encrypt', $district);
                }
				else {
                    $district = $GLOBALS['null_value'];
                }

                if(!empty($mobile_number)) {
                    $mobile_number = $obj->encode_decode('encrypt', $mobile_number);
                }

                if(!empty($state)) {
                    $state = $obj->encode_decode('encrypt', $state);
                }

				if(!empty($gst_number)){
					$gst_number = $obj->encode_decode('encrypt', $gst_number);
				}

				if(!empty($identification)){
					$identification = $obj->encode_decode('encrypt', $identification);
				}
				if(!empty(array_filter($unit_ids, fn($value) => $value !== ""))) {
                    $unit_ids = implode(",", $unit_ids);
                }
                else {
                    $unit_ids = $GLOBALS['null_value'];
                }
				if(!empty(array_filter($unit_names, fn($value) => $value !== ""))) {
                    $unit_names = implode(",", $unit_names);
                }
                else {
                    $unit_names = $GLOBALS['null_value'];
                }
				if(!empty(array_filter($price_values, fn($value) => $value !== ""))) {
                    $price_values = implode(",", $price_values);
                }
                else {
                    $price_values = $GLOBALS['null_value'];
                }
				if(!empty(array_filter($cooly_values, fn($value) => $value !== ""))) {
                    $cooly_values = implode(",", $cooly_values);
                }
                else {
                    $cooly_values = $GLOBALS['null_value'];
                }
				$prev_account_party_id = ""; $columns = array(); $values = array(); $check_partys = array(); $party_error = "";			
				// if(!empty($gst_number)) {
				// 	$check_partys = $obj->getTableRecords($GLOBALS['account_party_table'], '', '');
				// 	if(!empty($check_partys)) {
				// 		foreach($check_partys as $data) {
				// 			if(!empty($data['gst_number']) && $data['gst_number'] == $gst_number) {
				// 				$prev_account_party_id = $data['account_party_id'];
				// 			}
				// 			if(!empty($prev_account_party_id)) {
                //                 $party_error = "This GST number is already exist";
				// 				break;
				// 			}
				// 		}
				// 	}
                // }
				if(!empty($mobile_number)) {
					$check_partys = $obj->getTableRecords($GLOBALS['account_party_table'], '', '');
					if(!empty($check_partys)) {
						foreach($check_partys as $data) {
							if(!empty($data['mobile_number']) && $data['mobile_number'] == $mobile_number) {
								$prev_account_party_id = $data['account_party_id'];
							}
							if(!empty($prev_account_party_id)) {
                                $party_error = "This mobile number is already exist";
								break;
							}
						}
					}
                }

				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
				$account_party_id = ""; $update = 0;
				if(empty($edit_id)) {
					if(empty($prev_account_party_id)) {
						$action = "";
						if(!empty($name)) {
							$action = "New Party Created. Name - ".$obj->encode_decode('decrypt', $name);
						}

						$null_value = $GLOBALS['null_value'];
						$columns = array('created_date_time', 'creator', 'creator_name', 'account_party_id', 'name', 'address', 'city','district', 'mobile_number', 'state', 'gst_number' ,'identification','unit_id','unit_name','price_value','cooly_value','opening_balance','opening_balance_type','deleted');
						$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$name."'", "'".$address."'", "'".$city."'","'".$district."'", "'".$mobile_number."'", "'".$state."'", "'".$gst_number."'","'".$identification."'","'".$unit_ids."'","'".$unit_names."'","'".$price_values."'","'".$cooly_values."'","'".$opening_balance."'","'".$opening_balance_type."'","'0'");
						$party_insert_id = $obj->InsertSQL($GLOBALS['account_party_table'], $columns, $values, $action);						
						if(preg_match("/^\d+$/", $party_insert_id)) {
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
							if(preg_match("/^\d+$/", $party_update_id)) {	
								$update = 1;
								$result = array('number' => '1', 'msg' => 'Party Successfully Created');					
							}
							else {
								$result = array('number' => '2', 'msg' => $party_update_id);
							}
						}
						else {
							$result = array('number' => '2', 'msg' => $party_insert_id);
						}
					}
					else {
						$result = array('number' => '2', 'msg' => $party_error);
					}	
				}
				else {
					if(empty($prev_account_party_id) || $prev_account_party_id == $edit_id) {
						$getUniqueID = "";
						$getUniqueID = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'account_party_id', $edit_id, 'id');
						if(preg_match("/^\d+$/", $getUniqueID)) {
							$action = "";
							if(!empty($name)) {
								$action = "Party Updated. Name - ".$obj->encode_decode('decrypt', $name);
							}

							$columns = array(); $values = array();						
							$columns = array('creator_name', 'name', 'address', 'city','district', 'mobile_number', 'state', 'gst_number', 'identification','unit_id','unit_name','price_value','cooly_value','opening_balance','opening_balance_type');
							$values = array("'".$creator_name."'", "'".$name."'", "'".$address."'", "'".$city."'","'".$district."'", "'".$mobile_number."'", "'".$state."'", "'".$gst_number."'", "'".$identification."'","'".$unit_ids."'","'".$unit_names."'","'".$price_values."'","'".$cooly_values."'","'".$opening_balance."'","'".$opening_balance_type."'");
							
							$party_update_id = $obj->UpdateSQL($GLOBALS['account_party_table'], $getUniqueID, $columns, $values, $action);
							if(preg_match("/^\d+$/", $party_update_id)) {	
								$update = 1;
								$account_party_id = $edit_id;
								$result = array('number' => '1', 'msg' => 'Updated Successfully');						
							}
							else {
								$result = array('number' => '2', 'msg' => $party_update_id);
							}							
						}
					}
					else {
						$result = array('number' => '2', 'msg' => $party_error);
					}
                }
				if ($update == 1) {
                    $bill_date = date("Y-m-d");
                    $bill_number = $GLOBALS['null_value'];
                    $bill_type = "Opening Balance";
                    $party_type = "Account Party";
                    $payment_mode_id = $GLOBALS['null_value'];
                    $payment_mode_name = $GLOBALS['null_value'];
                    $bank_id = $GLOBALS['null_value'];
                    $bank_name = $GLOBALS['null_value'];
                    $credit  = 0; $debit = 0; 
					$party_name = $name;

                    $balance_type = $GLOBALS['null_value'];
                    if($opening_balance_type =='Credit'){
                        $credit  = $opening_balance; 
                        $balance_type = 'Credit';
                    }else if($opening_balance_type =='Debit'){
                        $debit  = $opening_balance; 
                        $balance_type = 'Debit';
                    }
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
                    if(!empty($opening_balance) && $opening_balance != $GLOBALS['null_value'] && !empty($opening_balance_type) && $opening_balance_type != $GLOBALS['null_value']){

                        $update_balance ="";
                        $update_balance = $obj->UpdateBalance($account_party_id,$bill_number,$bill_date,$bill_type,$account_party_id,$party_name,$party_type,$payment_mode_id, $payment_mode_name, $bank_id, $bank_name, $credit,$debit,$balance_type,'NULL','');
                    }else{
                        $payment_unique_id = "";
                        $payment_unique_id = $obj->getPartyOpeningBalanceInPaymentExist($account_party_id,$bill_type);
                        if(preg_match("/^\d+$/", $payment_unique_id)) {
                            $action = "Payment Deleted.";
                        
                            $columns = array(); $values = array();						
                            $columns = array('deleted');
                            $values = array("'1'");
                            $msg = $obj->UpdateSQL($GLOBALS['payment_table'], $payment_unique_id, $columns, $values, $action);
                        }
                    }
                }
				if(!empty($update) && $update == '1' && !empty($account_party_id)) {
					if(!empty($unit_ids) && $unit_ids != $GLOBALS['null_value'] && !empty($price_values) && $price_values != $GLOBALS['null_value'] && !empty($cooly_values) && $cooly_values != $GLOBALS['null_value']) {
						$unit_ids = explode(',', $unit_ids);
						$price_values = explode(',', $price_values);
							$cooly_values = explode(',', $cooly_values);

						for($i=0; $i < count($unit_ids); $i++) {
							if(!empty($unit_ids[$i]) && !empty($price_values[$i])) {
								$unit_price_update = $obj->UpdateUnitPrice('Account Party', $account_party_id, $name, $unit_ids[$i], $price_values[$i], $cooly_values[$i]);
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
			if(!empty($valid_account_party)) {
				$result = array('number' => '3', 'msg' => $valid_account_party);
			}
			else if(!empty($account_party_error)) {
				$result = array('number' => '2', 'msg' => $account_party_error);
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
        $search_text = "";
		if(isset($_POST['search_text'])) {
			$search_text = $_POST['search_text'];
		}

		$total_records_list = array();
		$total_records_list = $obj->getTableRecords($GLOBALS['account_party_table'], '', '');

		if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($total_records_list)) {
				foreach($total_records_list as $val) {
					if( (strpos(strtolower($obj->encode_decode('decrypt', $val['name'])), $search_text) !== false) ) {
						$list[] = $val;
					}
				}
			}
			$total_records_list = $list;
		}
		
		$total_pages = 0;	
		if(!empty($total_records_list) && is_array($total_records_list)) { 
			$total_pages = count($total_records_list);
		}
		
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
		if(empty($access_error)) { ?>
        
		<table class="table nowrap cursor bg-white text-center">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Party Name</th>
                    <th>City</th>
                    <th>Contact Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($show_records_list)) {
                        foreach($show_records_list as $key => $data) { 

                            $account_party_id = '';
                            $account_party_id = $obj->getTableRecords($GLOBALS['account_party_table'], 'account_party_id', $data['account_party_id'], 'id');

                            ?>
                            <tr>
                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['account_party_id'])) { echo $data['account_party_id']; } ?>');"><?php echo $key + 1; ?></td>
                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['account_party_id'])) { echo $data['account_party_id']; } ?>');">
                                    <div class="w-100">
                                        <?php
                                            if(!empty($data['name'])) {
                                                $data['name'] = $obj->encode_decode('decrypt', $data['name']);
                                                echo $data['name'];
                                                if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                                    $data['city'] = $obj->encode_decode('decrypt', $data['city']);
                                                    // echo " - ".strtoupper(($data['city']));
                                                }
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
                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['account_party_id'])) { echo $data['account_party_id']; } ?>');">
                                    <?php
                                        if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                            // $data['city'] = $obj->encode_decode('decrypt', $data['city']);
                                            echo $data['city'];
                                        }
                                    ?>
                                </td>
                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['account_party_id'])) { echo $data['account_party_id']; } ?>');">
                                    <?php
                                        if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                            $data['mobile_number'] = $obj->encode_decode('decrypt', $data['mobile_number']);
                                            echo $data['mobile_number'];
                                        }
                                    ?>
                                </td>
                                <td>
                                <?php $access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $edit_action;
                                        include('permission_action.php');
                                    }
                                    if(empty($access_error)) { ?>
                                        <a class="pr-2" href="#"onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['account_party_id'])) { echo $data['account_party_id']; } ?>');"><i class="fa fa-pencil"></i></a>
                                    <?php } ?>
                                    <?php
                                    $access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $delete_action;
                                        include('permission_action.php');
                                    } 
                                    if(empty($access_error)) { 
									   $linked_count = 0;
										$linked_count = $obj->GetAccountPartyLinkedCount($data['account_party_id']); 

										if($linked_count > 0) { ?>

											<span title="This Party can't be deleted">                           
												<a  class="text-secondary"  style="pointer-events: none; cursor: default;" > <i class="fa fa-trash" title="delete"></i>&ensp;</a>
											</span>

									<?php }else{ ?>
                                        <a class="pr-2" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['account_party_id'])) { echo $data['account_party_id']; } ?>');"><i class="fa fa-trash"></i></a>
                                    <?php } 
									}?>
                                </td>
                            </tr>
                            <?php
							}
						}
						else {
					?>
							<tr>
								<td colspan="4" class="text-center">Sorry! No records found</td>
							</tr>
					<?php } ?>
            </tbody>
        </table>
                      
		<?php	
	}
}
if(isset($_REQUEST['delete_account_party_id'])) {
    $delete_account_party_id = $_REQUEST['delete_account_party_id'];
    $msg = "";
    if(!empty($delete_account_party_id)) {
        $account_party_unique_id = "";
        $account_party_unique_id = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'account_party_id', $delete_account_party_id, 'id');

        // $primary_account_party = "";
        // $primary_account_party = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'account_party_id', $delete_account_party_id, 'primary_account_party');
        if(!empty($account_party_unique_id)) {
            if(preg_match("/^\d+$/", $account_party_unique_id)) {
                $name = "";
                $name = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'account_party_id', $delete_account_party_id, 'name');
            
                $action = "";
                if(!empty($name)) {
                    $action = "account_party Deleted. Name - ".$obj->encode_decode('decrypt', $name);
                }
  				$delete_id = $obj->DeletePayment($delete_account_party_id);	

                $columns = array(); $values = array();						
                $columns = array('deleted');
                $values = array("'1'");
                $msg = $obj->UpdateSQL($GLOBALS['account_party_table'], $account_party_unique_id, $columns, $values, $action);
            }
        }
        else {
            $msg = "Unable to Delete";
        }
    }
    echo $msg;
    exit;	
} 
?>