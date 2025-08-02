<?php
	include("include_files.php");

	$login_staff_id = "";
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
			$login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			$permission_module = $GLOBALS['branch_module'];
		}
	}
	
	if(isset($_REQUEST['show_branch_id'])) { 
        $show_branch_id = $_REQUEST['show_branch_id'];


        $name = ""; $branch_contact_number = ""; $branch_address = ""; $branch_lr_prefix = ""; $city = ""; $branch_pincode = ""; $state = "Tamil Nadu";$district = ""; $opening_balance = ""; $opening_balance_type = 1; $tax_opening_balance = ""; $tax_opening_balance_type = 1;
		$country = "India"; 
        if(!empty($show_branch_id)) {
            $branch_list = array();
			$branch_list = $obj->getTableRecords($GLOBALS['branch_table'], 'branch_id', $show_branch_id);
            if(!empty($branch_list)) {
                foreach($branch_list as $data) {
                    if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                        $name = $obj->encode_decode('decrypt', $data['name']);
					}
					if(!empty($data['branch_contact_number']) && $data['branch_contact_number'] != $GLOBALS['null_value']) {
                        $branch_contact_number = $obj->encode_decode('decrypt', $data['branch_contact_number']);
					}
					if(!empty($data['branch_lr_prefix']) && $data['branch_lr_prefix'] != $GLOBALS['null_value']) {
                        $branch_lr_prefix = $obj->encode_decode('decrypt', $data['branch_lr_prefix']);
					}
					if(!empty($data['branch_address']) && $data['branch_address'] != $GLOBALS['null_value']) {
                        $branch_address = $obj->encode_decode('decrypt', $data['branch_address']);
					}
					if(!empty($data['branch_city'])  && $data['branch_city']  != $GLOBALS['null_value']) {
						$city = html_entity_decode($obj->encode_decode('decrypt', $data['branch_city']));
					}
					if(!empty($data['district'])  && $data['district']  != $GLOBALS['null_value']) {
						$district = html_entity_decode($obj->encode_decode('decrypt', $data['district']));
					}
					if(!empty($data['branch_pincode']) && $data['branch_pincode'] != $GLOBALS['null_value']) {
                        $branch_pincode = $obj->encode_decode('decrypt', $data['branch_pincode']);
					}
					if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
                        $state = $obj->encode_decode('decrypt', $data['state']);
					}
					if(!empty($data['tax_opening_balance']) && $data['tax_opening_balance'] != $GLOBALS['null_value']) {
						$tax_opening_balance = $data['tax_opening_balance'];
					}
					if(!empty($data['tax_opening_balance_type']) && $data['tax_opening_balance_type'] != $GLOBALS['null_value']) {
						$tax_opening_balance_type = $data['tax_opening_balance_type'];
					}
					if(!empty($data['opening_balance']) && $data['opening_balance'] != $GLOBALS['null_value']) {
						$opening_balance = $data['opening_balance'];
					}
					if(!empty($data['opening_balance_type']) && $data['opening_balance_type'] != $GLOBALS['null_value']) {
						$opening_balance_type = $data['opening_balance_type'];
					}
                }
            }
		} 

		$payment_count = 0;
		if(!empty($show_branch_id)){
			$payment_count = $obj->BranchOBusedinVoucherReturn();
		}

		?>
        <form class="poppins pd-20" name="branch_form" method="POST">
			<style>
				.input-group .select2-container .select2-selection--single {
					height: calc(2rem + 2px) !important;
				}
				.input-group .select2-container {
					width: 100% !important;
				}
			</style>
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
						<?php if(!empty($show_branch_id)) { ?>
							<h5 class="text-white">Edit Branch</h5>
						<?php } else { ?>
							<h5 class="text-white">Add Branch</h5>
						<?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('branch.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
			<div class="row mx-0 p-1">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_branch_id)) { echo $show_branch_id; } ?>">
                <div class="col-lg-3 col-md-4 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="branch_name" name="branch_name" class="form-control shadow-none" placeholder="" value="<?php if(!empty($name)){ echo $name; }?>" onkeyup="Javascript:InputBoxColor(this,'text');">
                            <label>Branch Name <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="branch_contact_number" name="branch_contact_number" class="form-control shadow-none" placeholder="" value="<?php if(!empty($branch_contact_number)){ echo $branch_contact_number; }?>" onkeyup="Javascript:InputBoxColor(this,'text');" onfocus="Javascript:SpaceControl(this);MobileNoControl(this);">
                            <label>Branch Contact Number <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="branch_lr_prefix" name="branch_lr_prefix" class="form-control shadow-none" placeholder="" value="<?php if(!empty($branch_lr_prefix)){ echo $branch_lr_prefix; }?>" onkeyup="Javascript:InputBoxColor(this,'text');ToUpper(this);" onfocus="Javascript:LRprefix(this);SpaceControl(this);">
                            <label>Branch LR Prefix <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control shadow-none" id="branch_address" name="branch_address" placeholder="" value="<?php if(!empty($branch_address)){ echo $branch_address; }?>" onkeyup="Javascript:InputBoxColor(this,'text');">
                            <label>Branch Address <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-4 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
							<div class="w-100" style="display: none;">
								<select name="country" class="form-control">
									<option value="">Select</option>
								</select>
							</div>
                            <select name="state" class="form-control shadow-none" onchange="Javascript:getStates('branch',this.value, '', '');">
                               <option value="">Select State</option>
                            </select>
                            <label>State <span class="text-danger">*</span></label>
                        </div> 
                    </div>
                </div>
				<div class="col-lg-3 col-md-4 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="district" class="form-control shadow-none" onchange="Javascript:getDistricts('branch', this.value, '');">
								<option value="">Select District</option>
                            </select>
                            <label>District <span class="text-danger">*</span></label>
                        </div> 
                    </div>
                </div>
				<div class="col-lg-3 col-md-4 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="city" class="form-control shadow-none" onchange="Javascript:getCities('branch', '', this.value);">
								<option value="">Select City</option>
                            </select>
                            <label>City <span class="text-danger">*</span></label>
                        </div> 
                    </div>
                </div>
				<div class="col-lg-4 col-md-6 col-12 mb-3 d-none" id="others_city_cover">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="others_city" name="others_city" class="form-control shadow-none"  placeholder="">
                            <label>Others city</label>
                        </div> 
                    </div>
                </div>
				<div class="col-lg-3 col-md-4 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control shadow-none" id="branch_pincode" name="branch_pincode" placeholder="" value="<?php if(!empty($branch_pincode)){ echo $branch_pincode; }?>" onkeyup="Javascript:InputBoxColor(this,'text');" onfocus="Javascript:SpaceControl(this);PincodeControl(this);">
                            <label>Branch pincode <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-4 col-12 py-1">
					<div class="form-group">
                        <div class="form-label-group in-border">
							<label class="font-weight-bold text-success">With Tax :</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group in-border">
							<div class="input-group">
								<input type="text" class="form-control shadow-none" id="tax_opening_balance" name="tax_opening_balance" placeholder="" value="<?php if(!empty($tax_opening_balance)){ echo $tax_opening_balance; }?>" onkeyup="Javascript:InputBoxColor(this,'text');" onfocus="Javascript:KeyboardControls(this,'number',8,'');" <?php if($payment_count > 0 ){ ?> readonly <?php } ?>>
								<label style="z-index:10;">Opening Balance</label>
								<div class="input-group-append d-none" style="width:40% !important;">
									<select name="tax_opening_balance_type" class="form-control shadow-none">
										<option value="Credit" <?php if(!empty($tax_opening_balance_type) && $tax_opening_balance_type == 'Credit') { ?>selected<?php } ?> selected>Credit</option>
										<!-- <option value="Debit" <?php if(!empty($tax_opening_balance_type) && $tax_opening_balance_type == 'Debit') { ?>selected<?php } ?>>Debit</option> -->
									</select>
								</div>
							</div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-4 col-12 py-1">
					<div class="form-group">
                        <div class="form-label-group in-border">
							<label class="font-weight-bold text-danger">Without Tax :</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group in-border">
							<div class="input-group">
								<input type="text" class="form-control shadow-none" id="opening_balance" name="opening_balance" placeholder="" value="<?php if(!empty($opening_balance)){ echo $opening_balance; }?>" onkeyup="Javascript:InputBoxColor(this,'text');" onfocus="Javascript:KeyboardControls(this,'number',8,'');" <?php if($payment_count > 0 ){ ?> readonly <?php } ?>>
								<label style="z-index:10;">Opening Balance</label>
								<div class="input-group-append d-none" style="width:40% !important;">
									<select name="opening_balance_type" class="form-control shadow-none">
										<option value="Credit" <?php if(!empty($opening_balance_type) && $opening_balance_type == 'Credit') { ?>selected<?php } ?> selected> Credit</option>
										<!-- <option value="Debit" <?php if(!empty($opening_balance_type) && $opening_balance_type == 'Debit') { ?>selected<?php } ?>>Debit</option> -->
									</select>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent('branch_form', 'branch_changes.php', 'branch.php');">
                        Submit
                    </button>
                </div>
			</div>
			<script src="include/select2/js/select2.min.js"></script>
			<script src="include/select2/js/select.js"></script>
			<script src="include/js/countries.js"></script>
			<script src="include/js/district.js"></script>
			<script src="include/js/cities.js"></script>
			<script type="text/javascript">                
				jQuery(document).ready(function(){
					getCountries('branch','<?php if(!empty($country)) { echo $country; } ?>', '<?php if(!empty($state)) { echo $state; } ?>', '<?php if(!empty($district)) { echo $district; } ?>', '<?php if(!empty($city)) { echo $city; } ?>');
				});
			</script>
        </form>
		<?php
    } 
    if(isset($_POST['edit_id'])) {	
		$name = ""; $branch_contact_number = ""; $branch_address = ""; $branch_lr_prefix = ""; $branch_city = ""; $branch_pincode = ""; $state = "";
		$name_error = ""; $branch_contact_number_error = ""; $branch_address_error = ""; $branch_lr_prefix_error = ""; $branch_city_error = ""; $branch_pincode_error = ""; $state_error = ""; $district = "";$district_error = "";
		$opening_balance = ""; $opening_balance_error = ""; $opening_balance_type = ""; $tax_opening_balance = ""; $tax_opening_balance_error = ""; $tax_opening_balance_type = "";
		$valid_branch = ""; $form_name = "branch_form"; $others_city ="";$others_city_error = "";

		if(isset($_POST['edit_id'])) {
			$edit_id = trim($_POST['edit_id']);
		}

		// Name
		if(isset($_POST['branch_name'])){
			$name = trim($_POST['branch_name']);
			$name_error = $valid->valid_name($name,'branch name',"1");
			// if(empty($name)) {
			// 	$name_error = "Enter the name";
			// }
			if(!empty($name_error)) {
				$valid_branch = $valid->error_display($form_name, "branch_name", $name_error, 'text');			
			}
		}

		// Contact Number
		if(isset($_POST['branch_contact_number'])){
			$branch_contact_number = trim($_POST['branch_contact_number']);
			$branch_contact_number_error = $valid->valid_mobile_number($branch_contact_number, "Branch Contact Number", "1");
			if(!empty($branch_contact_number_error)) {
				if(!empty($valid_branch)) {
					$valid_branch = $valid_branch." ".$valid->error_display($form_name, "branch_contact_number", $branch_contact_number_error, 'text');
				}
				else {
					$valid_branch = $valid->error_display($form_name, "branch_contact_number", $branch_contact_number_error, 'text');
				}
			}
		}

		// LR prefix
		if(isset($_POST['branch_lr_prefix'])){
			$branch_lr_prefix = trim($_POST['branch_lr_prefix']);
			$branch_lr_prefix_error = $valid->valid_lr_prefix($branch_lr_prefix,"Branch LR prefix","1");
			if(!empty($branch_lr_prefix_error)) {
				if(!empty($valid_branch)) {
					$valid_branch = $valid_branch." ".$valid->error_display($form_name, "branch_lr_prefix", $branch_lr_prefix_error, 'text');
				}
				else {
					$valid_branch = $valid->error_display($form_name, "branch_lr_prefix", $branch_lr_prefix_error, 'text');
				}
			}
		}
		
		// Branch Address
		if(isset($_POST['branch_address'])){
			$branch_address = trim($_POST['branch_address']);
			$branch_address_error = $valid->valid_product_name($branch_address, 'Address', '1', '');
			if(!empty($branch_address_error)) {
				if(!empty($valid_branch)) {
					$valid_branch = $valid_branch." ".$valid->error_display($form_name, "branch_address", $branch_address_error, 'text');
				}
				else {
					$valid_branch = $valid->error_display($form_name, "branch_address", $branch_address_error, 'text');
				}
			}
		}

		// Branch Pincode
		if(isset($_POST['branch_pincode'])){
			$branch_pincode = trim($_POST['branch_pincode']);
			$branch_pincode_error = $valid->valid_pincode($branch_pincode,'branch pincode','1');
			if(!empty($branch_pincode_error)){
				if(!empty($valid_branch)) {
					$valid_branch = $valid_branch." ".$valid->error_display($form_name, "branch_pincode", $branch_pincode_error, 'text');
				}
				else {
					$valid_branch = $valid->error_display($form_name, "branch_pincode", $branch_pincode_error, 'text');
				}
			}
		}

		// State
		if(isset($_POST['state'])) {
			$state = trim($_POST['state']);
			$state_error = $valid->common_validation($state, 'State', 'select');
			if(!empty($state_error)) {
				if(!empty($valid_branch)) {
					$valid_branch = $valid_branch." ".$valid->error_display($form_name, "state", $state_error, 'select');
				}
				else {
					$valid_branch = $valid->error_display($form_name, "state", $state_error, 'select');
				}
			}
		}

		// District
        if(isset($_POST['district'])){
            $district = trim($_POST['district']);
			$district_error = $valid->common_validation($district, 'District', 'select');
			if(!empty($district_error)){
				if(!empty($valid_branch)){
					$valid_branch = $valid_branch." ".$valid->error_display($form_name,'district',$district_error,'select');
				}
				else{
					$valid_branch = $valid->error_display($form_name,'district',$district_error,'select');
				}
			}
        }

		// City
        if(isset($_POST['city'])){
            $branch_city = trim($_POST['city']);
			$branch_city_error = $valid->common_validation($branch_city, 'City', 'select');
			if(!empty($branch_city_error)){
				if(!empty($valid_branch)){
					$valid_branch = $valid_branch." ".$valid->error_display($form_name,'city',$branch_city_error,'select');
				}
				else{
					$valid_branch = $valid->error_display($form_name,'city',$branch_city_error,'select');
				}
			}
        }

		if(isset($_POST['tax_opening_balance'])) {
			$tax_opening_balance = trim($_POST['tax_opening_balance']);
			$tax_opening_balance_error = $valid->valid_price($tax_opening_balance, 'Opening Balance', '0');
			if(!empty($tax_opening_balance_error)){
				if(!empty($valid_branch)) {
					$valid_branch = $valid_branch." ".$valid->error_display($form_name, 'tax_opening_balance', $tax_opening_balance_error, 'text');
				}
				else {
					$valid_branch = $valid->error_display($form_name, 'tax_opening_balance', $tax_opening_balance_error, 'text');
				}
			}
		}

		if(isset($_POST['tax_opening_balance_type'])) {
			$tax_opening_balance_type = trim($_POST['tax_opening_balance_type']);
			$tax_opening_balance_type_error = $valid->common_validation($tax_opening_balance_type, 'Opening Balance Type', 'select');
			if(!empty($tax_opening_balance_type_error)){
				if(!empty($valid_branch)) {
					$valid_branch = $valid_branch." ".$valid->error_display($form_name, 'tax_opening_balance_type', $tax_opening_balance_type_error, 'select');
				}
				else {
					$valid_branch = $valid->error_display($form_name, 'tax_opening_balance_type', $tax_opening_balance_type_error, 'select');
				}
			}
		}

		if(isset($_POST['opening_balance'])) {
			$opening_balance = trim($_POST['opening_balance']);
			$opening_balance_error = $valid->valid_price($opening_balance, 'Opening Balance', '0');
			if(!empty($opening_balance_error)){
				if(!empty($valid_branch)) {
					$valid_branch = $valid_branch." ".$valid->error_display($form_name, 'opening_balance', $opening_balance_error, 'text');
				}
				else {
					$valid_branch = $valid->error_display($form_name, 'opening_balance', $opening_balance_error, 'text');
				}
			}
		}

		if(isset($_POST['opening_balance_type'])) {
			$opening_balance_type = trim($_POST['opening_balance_type']);
			$opening_balance_type_error = $valid->common_validation($opening_balance_type, 'Opening Balance Type', 'select');
			if(!empty($opening_balance_type_error)){
				if(!empty($valid_branch)) {
					$valid_branch = $valid_branch." ".$valid->error_display($form_name, 'opening_balance_type', $opening_balance_type_error, 'select');
				}
				else {
					$valid_branch = $valid->error_display($form_name, 'opening_balance_type', $opening_balance_type_error, 'select');
				}
			}
		}
		
        if(isset($_POST['others_city']))
		{
			$others_city = $_POST['others_city'];
            if($branch_city == "Others"){
                $others_city_error = $valid->valid_text($others_city,'City','1');
                if(!empty($others_city_error)){
                    if(!empty($valid_branch)) {
						$valid_branch = $valid_branch." ".$valid->error_display($form_name, "others_city", $others_city_error, 'text');
					}
					else {
						$valid_branch = $valid->error_display($form_name, "others_city", $others_city_error, 'text');
					}
                }
                else{
                    $branch_city = $others_city;
                    $branch_city = $valid->clean_value($branch_city);
                }
            }
		}
		
		$result = "";
		$bill_company_id = $GLOBALS['bill_company_id'];

		if(empty($valid_branch)) {
			$check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
				if(!empty($name)) {
					$name_array = "";
					$name_array = explode(" ", $name);
					if(is_array($name_array)) {
						for($n = 0; $n < count($name_array); $n++) {
							if(!empty($name_array[$n])) {
								$name_array[$n] = trim($name_array[$n]);
								$name_array[$n] = strtolower($name_array[$n]);
								$name_array[$n] = ucfirst($name_array[$n]);
							}
							else {
								unset($name_array[$n]);
							}
						}
						$name = implode(" ", $name_array);
					}    
				}
				
				$lower_case_name = "";
				if(!empty($name)) {
					$lower_case_name = strtolower($name);
					$name = $obj->encode_decode('encrypt', $name);
					$lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
				}
				$lower_case_city = "";
				if(!empty($branch_city)){
					$lower_case_city = strtolower($branch_city);
					$branch_city = $obj->encode_decode('encrypt', $branch_city);
					$lower_case_city = $obj->encode_decode('encrypt',$lower_case_city);
				}

				// Branch name and city name checking...If same name and city exists, show error //
				$prev_branch_name_id = ""; $prev_name_error = ""; $prev_branch_name = ""; $prev_branch_city1 = "";		
				if(!empty($lower_case_name) && !empty($lower_case_city)) {
					$prev_branch_name_id = $obj->CheckBranchNameAlreadyExists($lower_case_name,$lower_case_city);
					if(!empty($prev_branch_name_id)) {
						$prev_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$prev_branch_name_id,'name');
						$prev_branch_city1 = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$prev_branch_name_id,'branch_city');
						$prev_name_error = "This Branch name and city is already exist in ".($obj->encode_decode('decrypt',$prev_branch_name))." - ".($obj->encode_decode('decrypt',$prev_branch_city1));
					}
                }

				// Branch LR checking
				$prev_branch_prefix_id = ""; $prev_lr_error = ""; $prev_branch_prefix = "";$prev_branch_city2 = "";
				if(!empty($branch_lr_prefix)) {
					$branch_lr_prefix = $obj->encode_decode('encrypt', $branch_lr_prefix);
					$prev_branch_prefix_id = $obj->CheckBranchLrAlreadyExists($branch_lr_prefix);
					if(!empty($prev_branch_prefix_id)){
						$prev_branch_prefix = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$prev_branch_prefix_id,'name');
						$prev_branch_city2 = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$prev_branch_prefix_id,'branch_city');
						$prev_lr_error = "This LR prefix is already exists in ".($obj->encode_decode('decrypt',$prev_branch_prefix))." - ".($obj->encode_decode('decrypt',$prev_branch_city2));
					}
				}

				// Branch Mobile no. Checking
				$prev_branch_mobile_id = ""; $prev_mobile_error = ""; $prev_branch_mobile = "";$prev_branch_city3 = "";
				if(!empty($branch_contact_number)){
					$branch_contact_number = $obj->encode_decode('encrypt', $branch_contact_number);
					$prev_branch_mobile_id = $obj->CheckBranchMobileAlreadyExists($branch_contact_number);
					if(!empty($prev_branch_mobile_id)){
						$prev_branch_mobile = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$prev_branch_mobile_id,'name');
						$prev_branch_city3 = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$prev_branch_mobile_id,'branch_city');
						$prev_mobile_error = "This Mobile Number already exists in ".($obj->encode_decode('decrypt',$prev_branch_mobile))." - ".($obj->encode_decode('decrypt',$prev_branch_city3));
					}
				}

				$update_branch_id = "";
				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);

				
				if(!empty($branch_address)){
					$branch_address = $obj->encode_decode('encrypt', $branch_address);
				}
				if(!empty($branch_pincode)){
					$branch_pincode = $obj->encode_decode('encrypt', $branch_pincode);
				}
				if(!empty($state)){
					$state = $obj->encode_decode('encrypt',$state);
				}
				if(!empty($district)) {
                    $district = $obj->encode_decode('encrypt', $district);
                }
				else {
                    $district = $GLOBALS['null_value'];
                }
				if(empty($tax_opening_balance)) {
					$tax_opening_balance = $GLOBALS['null_value'];
					$tax_opening_balance_type = $GLOBALS['null_value'];
				}
				if(empty($opening_balance)) {
					$opening_balance = $GLOBALS['null_value'];
					$opening_balance_type = $GLOBALS['null_value'];
				}
				$balance = 0; $branch_id = "";
				if(empty($edit_id)) {
					if(empty($prev_name_error)){
						if(empty($prev_lr_error)) {		
							if(empty($prev_mobile_error)){				
								$action = "";
								if(!empty($name)) {
									$action = "New branch Created. Name - ".$obj->encode_decode('decrypt', $name);
								}
		
								$null_value = $GLOBALS['null_value'];
								$columns = array('created_date_time', 'creator', 'creator_name','bill_company_id','branch_id', 'name', 'branch_lr_prefix', 'branch_contact_number','lower_case_name','branch_address','branch_city','lower_case_city','district','branch_pincode','state','tax_opening_balance','tax_opening_balance_type','opening_balance','opening_balance_type', 'others_city','deleted');
								$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$name."'", "'".$branch_lr_prefix."'", "'".$branch_contact_number."'","'".$lower_case_name."'","'".$branch_address."'","'".$branch_city."'","'".$lower_case_city."'","'".$district."'","'".$branch_pincode."'","'".$state."'","'".$tax_opening_balance."'","'".$tax_opening_balance_type."'","'".$opening_balance."'","'".$opening_balance_type."'", "'".$others_city."'","'0'");

								$branch_insert_id = $obj->InsertSQL($GLOBALS['branch_table'], $columns, $values, $action);						
								if(preg_match("/^\d+$/", $branch_insert_id)) {
									if($branch_insert_id < 10) {
										$branch_id = "BRANCH_".date("dmYhis")."_0".$branch_insert_id;
									}
									else {
										$branch_id = "BRANCH_".date("dmYhis")."_".$branch_insert_id;
									}
									if(!empty($branch_id)) {
										$branch_id = $obj->encode_decode('encrypt', $branch_id);
									}
									$columns = array(); $values = array();						
									$columns = array('branch_id');
									$values = array("'".$branch_id."'");
									$branch_update_id = $obj->UpdateSQL($GLOBALS['branch_table'], $branch_insert_id, $columns, $values, '');
									if(preg_match("/^\d+$/", $branch_update_id)) {		
										$balance = 1;
										$result = array('number' => '1', 'msg' => 'Branch Successfully Created');					
									}
									else {
										$result = array('number' => '2', 'msg' => $branch_update_id);
									}
								}
								else {
									$result = array('number' => '2', 'msg' => $branch_insert_id);
								}	
							}
							else if (!empty($prev_mobile_error)){
								$result = array('number' => '2', 'msg' => $prev_mobile_error);
							}
						}
						else if (!empty($prev_lr_error)){
							$result = array('number' => '2', 'msg' => $prev_lr_error);
						}
					}
					else if (!empty($prev_name_error)){
						$result = array('number' => '2', 'msg' => $prev_name_error);
					}
				}
				else {
					if(empty($prev_branch_name_id) || $prev_branch_name_id == $edit_id) {
						if(empty($prev_branch_prefix_id) || $prev_branch_prefix_id == $edit_id) {
							if(empty($prev_branch_mobile_id) || $prev_branch_mobile_id == $edit_id) {
								$getUniqueID = "";
								$getUniqueID = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $edit_id, 'id');
								if(preg_match("/^\d+$/", $getUniqueID)) {
									$action = "";
									if(!empty($name)) {
										$action = "Branch Updated. Name - ".$obj->encode_decode('decrypt', $name);
									}
								
									$columns = array(); $values = array();
									$columns = array('creator_name','name', 'branch_lr_prefix', 'branch_contact_number','lower_case_name','branch_address','branch_city','lower_case_city','district','branch_pincode','state','tax_opening_balance','tax_opening_balance_type','opening_balance','opening_balance_type','others_city');
									$values = array("'".$creator_name."'", "'".$name."'", "'".$branch_lr_prefix."'", "'".$branch_contact_number."'","'".$lower_case_name."'","'".$branch_address."'","'".$branch_city."'","'".$lower_case_city."'","'".$district."'","'".$branch_pincode."'","'".$state."'","'".$tax_opening_balance."'","'".$tax_opening_balance_type."'","'".$opening_balance."'","'".$opening_balance_type."'", "'".$others_city."'");
									
									$branch_update_id = $obj->UpdateSQL($GLOBALS['branch_table'], $getUniqueID, $columns, $values, $action);
									if(preg_match("/^\d+$/", $branch_update_id)) {	
										$update_branch_id = $edit_id;
										$balance = 1; 
										$branch_id = $edit_id;
										$result = array('number' => '1', 'msg' => 'Updated Successfully');				
									}
									else {
										$result = array('number' => '2', 'msg' => $branch_update_id);
									}							
								}
							}
							else if (!empty($prev_mobile_error)){
								$result = array('number' => '2', 'msg' => $prev_mobile_error);
							}
						}
						else if (!empty($prev_lr_error)){
							$result = array('number' => '2', 'msg' => $prev_lr_error);
						}
					}
					else if (!empty($prev_name_error)){
						$result = array('number' => '2', 'msg' => $prev_name_error);
					}
				}
				if(!empty($tax_opening_balance) && $tax_opening_balance != $GLOBALS['null_value'] && !empty($balance) && $balance == 1 && !empty($branch_id)) {
					$bill_company_id = $GLOBALS['bill_company_id']; $bill_id = $branch_id; $bill_date = "0000-00-00"; $credit = 0; $debit = 0; $bill_type ="Branch Tax Opening"; $bill_number = $GLOBALS['null_value']; $payment_mode_id = $GLOBALS['null_value']; $payment_mode_name = $GLOBALS['null_value'];$bank_id = $GLOBALS['null_value'];$bank_name = $GLOBALS['null_value']; $payment_tax_type = 1;
					$party_id = $branch_id; $party_type = "Branch"; $party_name = $name;

					$open_balance_type = $tax_opening_balance_type;
					$tax_opening_balance_type = "Credit";

					if($tax_opening_balance_type == "Credit") {
						$credit = $tax_opening_balance;
					}
					else if($tax_opening_balance_type == "Debit") {
						$debit = $tax_opening_balance;
					}
					
					if(empty($credit)){
						$credit = 0;
					}
					if(empty($debit)){
						$debit = 0;
					}
					
					$update_balance ="";
					$update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type, $payment_tax_type, $branch_id);
				}
				else {
					$update_balance = $obj->DeleteBranchPayment($branch_id, $branch_id, '1');
				}
				if(!empty($opening_balance) && $opening_balance != $GLOBALS['null_value'] && !empty($balance) && $balance == 1 && !empty($branch_id)) {
					$bill_company_id = $GLOBALS['bill_company_id']; $bill_id = $branch_id; $bill_date = "0000-00-00"; $credit = 0; $debit = 0; $bill_type ="Branch Opening Balance"; $bill_number = $GLOBALS['null_value']; $payment_mode_id = $GLOBALS['null_value']; $payment_mode_name = $GLOBALS['null_value'];$bank_id = $GLOBALS['null_value'];$bank_name = $GLOBALS['null_value']; $payment_tax_type = 2;
					$party_id = $branch_id; $party_type = "Branch"; $party_name = $name;

					$open_balance_type = $opening_balance_type;

					$opening_balance_type = "Credit";

					if($opening_balance_type == "Credit") {
						$credit = $opening_balance;
					}
					else if($opening_balance_type == "Debit") {
						$debit = $opening_balance;
					}
					if(empty($credit)){
						$credit = 0;
					}
					if(empty($debit)){
						$debit = 0;
					}
					
					$update_balance ="";
					$update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type, $payment_tax_type, $branch_id);
				}
				else {
					$update_balance = $obj->DeleteBranchPayment($branch_id, $branch_id, '2');
				}
			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_branch)) {
				$result = array('number' => '3', 'msg' => $valid_branch);
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
		$total_records_list = $obj->getTableRecords($GLOBALS['branch_table'], '', '');

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
					i
					.col-lgnclude("pagination.php");
				?> 
			</div> 
		<?php } 
		$access_error = "";
		if(!empty($login_staff_id)) {
			$permission_action = $view_action;
			include('permission_action.php');
		}
		if(empty($access_error)) {  ?>
        
		<table class="table nowrap cursor bg-white text-center">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Prefix</th>
                    <th>Branch Name</th>
                    <th>Contact Number</th>
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
                                <?php
                                    if(!empty($list['branch_lr_prefix']) && $list['branch_lr_prefix'] != $GLOBALS['null_value']) {
                                        echo $obj->encode_decode('decrypt', $list['branch_lr_prefix']);
                                    }
                                ?>
                            </td>
                            <td>
                                <div class="w-100">
                                    <?php
                                        if(!empty($list['name'])) {
                                            $list['name'] = $obj->encode_decode('decrypt', $list['name']);
											if(!empty($list['branch_city'])){
												$list['branch_city'] = $obj->encode_decode('decrypt',$list['branch_city']);
											}
											echo $list['name']." - ".$list['branch_city'];
                                        }
                                    ?>
                                </div>
                                                
                                <?php
                                    if(!empty($list['creator_name'])) {
                                        $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                ?>
                                        <small><?php echo "Last Opened : ".$list['creator_name']; ?></small>
                                <?php		
                                    }
                                ?>
                            </td>
							<td>
                                <?php
                                    if(!empty($list['branch_contact_number'])) {
                                        $list['branch_contact_number'] = $obj->encode_decode('decrypt', $list['branch_contact_number']);
                                        echo $list['branch_contact_number'];
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
                                        <a class="pr-2" href="#" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['branch_id'])) { echo $list['branch_id']; } ?>');"><i class="fa fa-pencil"></i></a>
                                <?php } ?>
                                <?php

									 $linked_count = 0;
									$linked_count = $obj->GetBranchLinkedCount($list['branch_id']); 
                                    $access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $delete_action;
										include('permission_action.php');
                                    }  
                                    if(empty($access_error)) {
										
									if($linked_count > 0) {
										?>                                        

										<span title="This Branch can't be deleted">                           
											<a  class="text-secondary"  style="pointer-events: none; cursor: default;" > <i class="fa fa-trash" title="delete"></i>&ensp;</a>
										</span>

								<?php }else{ ?>
                                        <a class="pr-2" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['branch_id'])) { echo $list['branch_id']; } ?>');"><i class="fa fa-trash"></i></a>
                                <?php 
										}
                                    } 
                                ?>
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
	if(isset($_REQUEST['delete_branch_id'])) {
		$delete_branch_id = $_REQUEST['delete_branch_id'];
		$msg = "";
		if(!empty($delete_branch_id)) {
			$branch_unique_id = "";
			$branch_unique_id = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $delete_branch_id, 'id');
			// $primary_branch = "";
			// $primary_branch = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $delete_branch_id, 'primary_branch');
			if(!empty($branch_unique_id)) {
				if(preg_match("/^\d+$/", $branch_unique_id)) {
					$name = "";
					$name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $delete_branch_id, 'name');
				
					$action = "";
					if(!empty($name)) {
						$action = "Branch Deleted. Name - ".$obj->encode_decode('decrypt', $name);
					}
					$update_tax_balance = $obj->DeleteBranchPayment($delete_branch_id, $delete_branch_id, '1');
					$update_balance = $obj->DeleteBranchPayment($delete_branch_id, $delete_branch_id, '2');
					$columns = array(); $values = array();						
					$columns = array('deleted');
					$values = array("'1'");
					$msg = $obj->UpdateSQL($GLOBALS['branch_table'], $branch_unique_id, $columns, $values, $action);
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