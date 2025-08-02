<?php
	include("include_files.php");
	if(isset($_REQUEST['show_organization_id'])) {
        $show_organization_id = $_REQUEST['show_organization_id'];

        $name = ""; $logo = ""; $address_line1 = "";$address_line2 = ""; $state = "Tamil Nadu"; $mobile_number = "";
		$gst_number = ""; $pincode = "";$city = "";$country = "India"; $district = ""; $lr_starting_date = ""; $send_sms = 2; $payment_tax_type = ""; $payment_row_index = 0;
		$payment_tax_type = array(); $total_amount = 0; $payment_mode_ids =array(); $bank_ids = array(); $amount = array();
        if(!empty($show_organization_id)) {
            $organization_list = array();
            $organization_list = $obj->getTableRecords($GLOBALS['organization_table'], 'organization_id', $show_organization_id);

			if(!empty($organization_list)) {
				foreach($organization_list as $data) {
					if(!empty($data['name'])) {
						$name = $obj->encode_decode('decrypt', $data['name']);
					}
					if(!empty($data['address_line1']) &&  $data['address_line1'] != 'NULL') {
						$address_line1 = $obj->encode_decode('decrypt', $data['address_line1']);
						$address_line1 = html_entity_decode($address_line1);
						$address_line1 = strtoupper($address_line1);
					}
					if(!empty($data['address_line2']) &&  $data['address_line2'] != 'NULL') {
						$address_line2 = $obj->encode_decode('decrypt', $data['address_line2']);
						$address_line2 = html_entity_decode($address_line2);
						$address_line2 = strtoupper($address_line2);
					}
					if(!empty($data['state'])) {
						$state = $obj->encode_decode('decrypt', $data['state']);
					}
					if(!empty($data['city'])  && $data['city']  != 'NULL') {
						$city = html_entity_decode($obj->encode_decode('decrypt', $data['city']));
					}
					if(!empty($data['district'])  && $data['district']  != 'NULL') {
						$district = html_entity_decode($obj->encode_decode('decrypt', $data['district']));
					}
					if(!empty($data['pincode'])  && $data['pincode']  != 'NULL') {
						$pincode = $obj->encode_decode('decrypt', $data['pincode']);
					}
					
					if(!empty($data['mobile_number']) && $data['mobile_number'] != 'NULL') {
						$mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
					}
					if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']) {
						$gst_number = $obj->encode_decode('decrypt', $data['gst_number']);
					}
                    /*if(!empty($data['logo']) && $data['logo'] != $GLOBALS['null_value']) {
						$logo = $data['logo'];
					}*/
					if(!empty($data['lr_starting_date']) && $data['lr_starting_date'] != $GLOBALS['default_date']) {
						$lr_starting_date = $data['lr_starting_date'];
					}
					if(!empty($data['send_sms'])) {
						$send_sms = $data['send_sms'];
					}
				
					if(!empty($data['payment_mode_id']) && $data['payment_mode_id'] != 'NULL') {
						$payment_mode_ids = explode(",", $data['payment_mode_id']);
						$payment_row_index = count($payment_mode_ids);
					}
                    if(!empty($data['bank_id']) && $data['bank_id'] != 'NULL') {
						$bank_ids = explode(",", $data['bank_id']);
					}
                    if(!empty($data['amount'])  && $data['amount'] != 'NULL') {
						$amount = explode(",", $data['amount']);
					}
					if(!empty($data['payment_tax_type'])  && $data['payment_tax_type'] != 'NULL') {
						$payment_tax_type = explode(",", $data['payment_tax_type']);
					}
				}
            }

        }
		$target_dir = $obj->image_directory();

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

		if(!empty($lr_starting_date) && !empty($from_date) && !empty($to_date)) {
			if(strtotime($lr_starting_date) >= strtotime($from_date) && strtotime($lr_starting_date) <= strtotime($to_date)) {

			}
			else { $lr_starting_date = ""; }
		}

        $payment_mode_list = array();
		// $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], '','','');
		$payment_mode_list = $obj->BankLinkedPaymentModes();

        ?>
        <form class="poppins pd-20 redirection_form" name="organization_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8">
						<h5 class="text-white">Edit Organization</h5>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<!-- <button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('organization.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button> -->
					</div>
				</div>
			</div>
            <div class="row p-3">
                <style>
					.table td, .table th { border-top: none; }
					.input-group-append .btn, .input-group-prepend .btn { z-index: 0; }
					.tax_cover .select2-container { width: 100px !important; }
					.sales_party_cover .select2-container { width: 80% !important; }
				</style>
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_organization_id)) { echo $show_organization_id; } ?>">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="name" name="name" class="form-control shadow-none" placeholder="Organization Name" value="<?php if(!empty($name)) { echo $name; } ?>" required>
                            <label>Organization Name(<span class="text-danger">*</span>)</label>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" class="form-control shadow-none" id="address_line1" name="address_line1" placeholder="Enter Your Address" value="<?php if(!empty($address_line1)) { echo $address_line1; } ?>">
                            <label>Address Line 1</label>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" class="form-control shadow-none" id="address_line2" name="address_line2" placeholder="Enter Your Address" value="<?php if(!empty($address_line2)) { echo $address_line2; } ?>">
                            <label>Address Line 2</label>
                        </div>
                    </div>
                </div>
				
				<div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
							<div class="w-100" style="display: none;">
								<select name="country" class="form-control">
									<option value="">Select</option>
								</select>
							</div>
                            <select name="state" class="form-control shadow-none" id="state" onchange="Javascript:getStates('organization',this.value, '', '');">
								<option value="">Select State</option>
                            </select>
                            <label>State (<span class="text-danger">*</span>)</label>
                        </div> 
                    </div>
                </div>
				<div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <select name="district" class="form-control shadow-none" id="district" onchange="Javascript:getDistricts('organization', this.value, '');">
								<option value="">Select District</option>
                            </select>
                            <label>District</label>
                        </div> 
                    </div>
                </div>
				<div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <select name="city" class="form-control shadow-none" id="city"  onchange="Javascript:getCities('organization', '', this.value);">
								<option value="">Select City</option>
                            </select>
                            <label>City</label>
                        </div> 
                    </div>
                </div>
				<div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="pincode" name="pincode" class="form-control shadow-none" placeholder="Pincode" value="<?php if(!empty($pincode)){ echo $pincode; }?>" onkeyup="Javascript:PincodeControl('pincode');">
                            <label>Pincode</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="gst_number" name="gst_number" class="form-control shadow-none" placeholder="GST Number" value="<?php if(!empty($gst_number)) { echo $gst_number; } ?>">
                            <label>GST Number</label>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control shadow-none" placeholder="Mobile Number" value="<?php if(!empty($mobile_number)) { echo $mobile_number; } ?>" onkeyup="Javascript:MobileNoControl('mobile_number');" required>
                            <label>Mobile Number(<span class="text-danger">*</span>)</label>
                        </div>
                    </div>
                </div>
				<div class="col-sm-4 col-md-3 col-6 mb-3">
					<div class="form-group mb-1">
						<div class="form-label-group in-border pb-2">
							<input type="date" id="lr_starting_date" min="<?php if(!empty($from_date)) { echo $from_date; } ?>" max="<?php if(!empty($to_date)) { echo $to_date; } ?>" name="lr_starting_date" class="form-control shadow-none" placeholder="LR Date" value = "<?php if(!empty($lr_starting_date)){ echo $lr_starting_date; }?>" required>
							<label>LR Starting Date</label>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-3 col-6 mb-3">
					<div class="form-group mb-1">
						<div class="form-check">
							<label class="form-check-label" onClick="Javascript:CustomCheckboxToggle(this, 'send_sms');">
								<input class="form-check-input" type="checkbox" name="send_sms" id="send_sms" value="<?php if(!empty($send_sms)) { echo $send_sms; } ?>" <?php if(!empty($send_sms) && $send_sms == 1) { ?>checked="checked"<?php } ?>>
								Send SMS
							</label>
						</div>
					</div>
				</div>
            </div>
			<div class="row justify-content-center">
				<div class="col-lg-2 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <select name="selected_tax_type" class="form-control shadow-none" id="payment_tax_type" >
								<option value="">Select Tax Type</option>
								<option value="1" > With Tax</option>
								<option value="2"> Without Tax</option>

                            </select>
                            <label> Tax Type</label>
                        </div> 
                    </div>
                </div>
				<div class="col-lg-2 col-md-3 col-6">
					<div class="form-group pb-2">
						<div class="form-label-group in-border mb-0">
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
							<label>Select Payment Mode</label>
						</div>
					</div>        
				</div>
				<div class="col-lg-2 col-md-3 col-12 d-none" id="bank_list">
					<div class="form-group">
						<div class="form-label-group in-border mt-0">
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
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-3 col-12">
					<div class="form-group pb-2">
						<div class="form-label-group in-border">
						<input type="text" name="selected_amount" class="form-control shadow-none" placeholder="" onfocus="Javascript:KeyboardControls(this,'number','',1);" required>
						<label>Amount</label>
						</div>
					</div>
				</div>
				<div class="col-lg-1 col-md-2 col-5 text-center px-lg-1 py-2">
					<button class="btn btn-danger add_products_button w-100" style="font-size:12px;" type="button" onclick="Javascript:AddPaymentRow();">
						Add
					</button>
				</div> 
			</div>
			 <div class="row justify-content-center"> 
                    <div class="col-lg-10">
                        <div class="table-responsive text-center">
                            <table class="table nowrap cursor smallfnt table-bordered payment_row_table">
                                <thead class="bg-secondary text-white smallfnt">
                                    <tr style="white-space:pre;">
                                        <th>#</th>
                                        <th>Tax Type</th>
                                        <th>Payment Mode</th>
                                        <th>Account</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(!empty($payment_mode_ids)){
                                            for($i = 0; $i < count($payment_mode_ids); $i++){
                                                ?>
                                                <tr class="payment_row" id="payment_row<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>">
                                                    <td class="sno text-center">
                                                        <?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                            $payment_tax_type_name = "";
															if(!empty($payment_tax_type[$i])){
																if($payment_tax_type[$i] == "1"){
																	$payment_tax_type_name = "With Tax";
																}
																else if($payment_tax_type[$i] == "2"){
																	$payment_tax_type_name = "Without Tax";
																}
																echo $payment_tax_type_name;
															}
                                                        ?>
                                                        <input type="hidden" name="payment_tax_type[]" value="<?php if(!empty($payment_tax_type[$i])) { echo $payment_tax_type[$i]; } ?>">
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                            $payment_mode_name = "";
                                                            $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_ids[$i], 'payment_mode_name');
                                                            echo $obj->encode_decode('decrypt', $payment_mode_name);
                                                        ?>
                                                        <input type="hidden" name="payment_mode_id[]" value="<?php if(!empty($payment_mode_ids[$i])) { echo $payment_mode_ids[$i]; } ?>">
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if(isset($bank_ids[$i])){
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
                                                            <?php
                                                        }
                                                        else{
															echo " - "; 
															$bank_ids[$i] = "";
                                                            ?>
                                                            <input type="hidden" name="bank_id[]" value="">
                                                            <?php 
                                                        } ?>
                                                        
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" name="amount[]" style="width:75%!important;margin:auto!important;" class="form-control shadow-none px-1 text-center" value="<?php if(!empty($amount[$i])) { echo $amount[$i]; } ?>" onfocus="Javascript:KeyboardControls(this,'number','','');" onkeyup="Javascript:PaymentTotal();InputBoxColor(this, 'text');">
                                                    </td>
                                                    <td class="text-center">
														<?php 
														$payment_record = 0; 
														$payment_record = $obj->DeleteCompanyOpeningBalance($show_organization_id,$payment_mode_ids[$i], $bank_ids[$i], $payment_tax_type[$i]); 
														if(empty($payment_record)){
															?>
															<button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('payment_row', '<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>');"><i class="fa fa-trash"></i></button>
														<?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
												$payment_row_index--;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark submit_button" type="button" onClick="Javascript:SaveModalContent('organization_form', 'organization_changes.php', 'organization_changes.php');">
                        Submit
                    </button>
                </div>
				<script src="include/js/countries.js"></script>
				<script src="include/js/district.js"></script>
				<script src="include/js/cities.js"></script>
                <script type="text/javascript">                
					jQuery(document).ready(function(){
						jQuery('select[name="state"]').select2();
						jQuery('select[name="district"]').select2();
						jQuery('select[name="city"]').select2();
						jQuery('.add_update_form_content').find('select').select2();
						getCountries('organization','<?php if(!empty($country)) { echo $country; } ?>', '<?php if(!empty($state)) { echo $state; } ?>', '<?php if(!empty($district)) { echo $district; } ?>', '<?php if(!empty($city)) { echo $city; } ?>');
					});
				</script>

			
        </form>
		<?php
    } 
    if(isset($_POST['name'])) {
		$name = ""; $logo = ""; $address_line1 = "";$address_line2 = ""; $state = ""; $mobile_number = "";
		$gst_number = ""; $pincode = "";$city = ""; $line1 =""; $line2= "";$total_amount = 0; 
		$name_error = ""; $logo_error = ""; $address_line1_error = "";$address_line2_error = ""; $state_error = ""; $mobile_number_error = "";$district = ""; $payment_error = "";
		$gst_number_error = ""; $pincode_error = "";$city_error = ""; $lr_starting_date = ""; $lr_starting_date_error = ""; $send_sms = 2;
		$payment_tax_type = array(); $payment_tax_type_error = ""; $payment_mode_ids = array(); $bank_ids = array(); $amount = array();
		$logo_name = array();  $payment_unique_ids = array();
		$valid_organization = ""; $form_name = "organization_form";
        
		if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
		}

		if(isset($_POST['lr_starting_date'])) {
			$lr_starting_date = $_POST['lr_starting_date'];
			$lr_starting_date = trim($lr_starting_date);
		}

		// Name
		if(isset($_POST['name'])){
			$name = $_POST['name'];
			$name_error = $valid->valid_name($name,'name','1');
			if(!empty($name_error)) {
				$valid_organization = $valid->error_display($form_name, "name", $name_error, 'text');
			}
		}

		// Address Line 1
		if(isset($_POST['address_line1'])) {
			$address_line1 = $_POST['address_line1'];
		}
		if(!empty($address_line1)){
			$address_line1 = $valid->clean_value($address_line1);
			$address_line1_error = $valid->common_validation($address_line1,'address_line1','0');
			if(!empty($valid_organization)) {
				$valid_organization = $valid_organization." ".$valid->error_display($form_name, "address_line1", $address_line1, 'text');
			}
			else {
				$valid_organization = $valid->error_display($form_name, "address_line1", $address_line1_error, 'text');
			}
            if(empty($address_line1_error))
            {
                $address_line1 = htmlentities($address_line1,ENT_QUOTES);
            }
		}

		// Address Line 2
		if(isset($_POST['address_line2'])) {
			$address_line2 = $_POST['address_line2'];
		}
		if(!empty($address_line2)){
			$address_line2 = $valid->clean_value($address_line2);
			$address_line2_error = $valid->common_validation($address_line2,'address_line2','0');
			if(!empty($valid_organization)) {
				$valid_organization = $valid_organization." ".$valid->error_display($form_name, "address_line2", $address_line2, 'text');
			}
			else {
				$valid_organization = $valid->error_display($form_name, "address_line2", $address_line2_error, 'text');
			}
            if(empty($address_line2_error))
            {
                $address_line2 = htmlentities($address_line2,ENT_QUOTES);
            }
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
		

		// Pincode
		if(isset($_POST['pincode'])){
			$pincode = $_POST['pincode'];
		}
		if(!empty($pincode)){
			$pincode_error = $valid->valid_pincode($pincode,'pincode','0');
			if(!empty($valid_organization)) {
				$valid_organization = $valid_organization." ".$valid->error_display($form_name, "pincode", $pincode_error, 'text');
			}
			else {
				$valid_organization = $valid->error_display($form_name, "pincode", $pincode_error, 'text');
			}
		}

		// State
		if(isset($_POST['state'])) {
			$state = $_POST['state'];
			$state = $valid->clean_value($state);
		}
		if(empty($state)) {
			$state_error = "Select the state";
			if(!empty($valid_organization)) {
				$valid_organization = $valid_organization." ".$valid->error_display($form_name, "state", $state_error, 'select');
			}
			else {
				$valid_organization = $valid->error_display($form_name, "state", $state_error, 'select');
			}
		}

		// GST number
		if(isset($_POST['gst_number'])){
			$gst_number = $_POST['gst_number'];
		}
		if(!empty($gst_number)) {
			$gst_number = $valid->clean_value($gst_number);
			$gst_number_error = $valid->valid_gst_number($gst_number, "GST Number", "0");
			if(!empty($gst_number_error)) {
				if(!empty($valid_organization)) {
					$valid_organization = $valid_organization." ".$valid->error_display($form_name, "gst_number", $gst_number_error, 'text');
				}
				else {
					$valid_organization = $valid->error_display($form_name, "gst_number", $gst_number_error, 'text');
				}
			}
		}

		// Mobile Number
		if(isset($_POST['mobile_number'])){
            $mobile_number = $_POST['mobile_number'];
			$mobile_number = $valid->clean_value($mobile_number);
			$mobile_number_error = $valid->valid_mobile_number($mobile_number, "Mobile Number", "1");
			if(!empty($mobile_number_error)){
				if(!empty($valid_organization)) {
					$valid_organization = $valid_organization." ".$valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
				}
				else {
					$valid_organization = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
				}
			}
        }

		if(isset($_POST['send_sms'])) {
			$send_sms = $_POST['send_sms'];
			$send_sms = trim($send_sms);
		}
		if(!empty($send_sms)) {
			if($send_sms != 1 && $send_sms != 2) {
				$send_sms = 2;
			}
		}

		if(isset($_POST['logo_name'])) {
            $logo_name = $_POST['logo_name'];
        }

		if(isset($_POST['payment_tax_type'])) {
            $payment_tax_type = $_POST['payment_tax_type'];
            $payment_tax_type = array_reverse($payment_tax_type);
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
		$organization_list = array(); $organization_count = 0;
        $organization_list = $obj->getTableRecords($GLOBALS['organization_table'], '', '');
        if(!empty($organization_list)) {
            $organization_count = count($organization_list);
            if(!empty($organization_count) && $organization_count == $GLOBALS['max_company_count']) {
                $organization_error = "Max.Organization Count : ".$GLOBALS['max_company_count'];
            }
        }

		// if(!empty($payment_mode_ids)) {
            for($i=0; $i < count($payment_mode_ids); $i++) {
                $payment_mode_ids[$i] = trim($payment_mode_ids[$i]);
                $payment_mode_name = "";
                $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_ids[$i], 'payment_mode_name');
                $payment_mode_names[$i] = $payment_mode_name;

				   if(!empty($edit_id)) {
						$payment_unique_ids[] = $obj->getPaymentUniqueID($edit_id, $payment_mode_ids[$i], $bank_ids[$i], $payment_tax_type[$i]);
					}
                
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
                        if(!empty($valid_organization)) {
                            $valid_organization = $valid_organization." ".$valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                        else {
                            $valid_organization = $valid->row_error_display($form_name, 'amount[]', $amount_error, 'text', 'payment_row', ($i+1));
                        }
                    }
                    else {
                        $total_amount += $amount[$i];
                    }
                }
            }
        // }
        // else {
        //     $payment_error = "Add Payment";
        // }

		if(!empty($edit_id) && empty($payment_error) && empty($valid_organization)) {
            $prev_payment_list = array();
            $prev_payment_list = $obj->PrevPaymentList($edit_id);
            if(!empty($prev_payment_list)) {
                foreach($prev_payment_list as $data) {
                    $payment_id = ""; 
                    if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $payment_id = $data['id'];
                    }
                    if(!in_array($payment_id, $payment_unique_ids)) {
                        $columns = array(); $values = array();
                        $columns = array('deleted');
                        $values = array('"1"');
                        $stock_update_id = $obj->UpdateSQL($GLOBALS['payment_table'], $payment_id, $columns, $values, '');
                    }
                }
            }
        }
        
		$result = "";
		if(empty($valid_organization) && empty($payment_error)) {
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
								// $name_array[$n] = strtolower($name_array[$n]);
								// $name_array[$n] = ucfirst($name_array[$n]);
							}
							else {
								unset($name_array[$n]);
							}
						}
						$name = implode(" ", $name_array);
					}          
					$name = $obj->encode_decode('encrypt', $name);
                }

				if(!empty($logo_name) && is_array($logo_name)) {
                    $logo = implode("$$$", $logo_name);
                }
                else {
                    $logo = $GLOBALS['null_value'];
                }

				if(!empty($address_line1)) {
                    $address_line1 = $obj->encode_decode('encrypt', $address_line1);
                }
				else {
                    $address_line1 = $GLOBALS['null_value'];
                }
				if(!empty($address_line2)) {
                    $address_line2 = $obj->encode_decode('encrypt', $address_line2);
                }
				else {
                    $address_line2 = $GLOBALS['null_value'];
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
				if(!empty($pincode)) {
                    $pincode = $obj->encode_decode('encrypt', $pincode);
                }
				else {
                    $pincode = $GLOBALS['null_value'];
                }
				if(!empty($state)) {
                    $state = $obj->encode_decode('encrypt', $state);
                }
				if(!empty($mobile_number)) {
                    $mobile_number = $obj->encode_decode('encrypt', $mobile_number);
                }
				else {
                    $mobile_number = $GLOBALS['null_value'];
                }
				if(!empty($gst_number)) {
                    $gst_number = $obj->encode_decode('encrypt', $gst_number);
                }
				else {
                    $gst_number = $GLOBALS['null_value'];
                }
				if(!empty($payment_tax_type)) {
                    $payment_tax_type = array_reverse($payment_tax_type);
                    $payment_tax_type = implode(',', $payment_tax_type);
                }
                else {
                    $payment_tax_type = $GLOBALS['null_value'];
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
                if(!empty($amount)) {
                    $amount = array_reverse($amount);
                    $amount = implode(',', $amount);
                }
                else {
                    $amount = $GLOBALS['null_value'];
                }
				$target_dir = $obj->image_directory(); $temp_dir = $obj->temp_image_directory();

                if(!empty($edit_id)) {
                    $organization_list = array(); $prev_logo = "";
                    $organization_list = $obj->getTableRecords($GLOBALS['organization_table'], 'organization_id', $edit_id);
                    if(!empty($organization_list)) {
                        foreach($organization_list as $data) {
                            if(!empty($data['logo'])) {
                                $prev_logo = $data['logo'];
                            }
                        }
                    }
					if(!empty($logo) && $logo != $GLOBALS['null_value']) {
						if(!empty($prev_logo) && $prev_logo != $GLOBALS['null_value']) {
							if(!empty($logo) && file_exists($temp_dir.$logo)) {  
								if(file_exists($target_dir.$prev_logo)) {   
									unlink($target_dir.$prev_logo);
								}
							}
						}
					}
                }

				$prev_organization_id = ""; $columns = array(); $values = array(); $check_organizations = array(); $organization_error = "";			
				if(!empty($name)) {
					$prev_organization_id = $obj->getTableColumnValue($GLOBALS['organization_table'], 'name', $name, 'organization_id');
					if(!empty($prev_organization_id)) {
						$organization_error = "This organization name is already exist";
					}
                }	

				$image_copy = 0;
				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
				
				if(!empty($lr_starting_date) && $lr_starting_date != "0000-00-00") {
                    $lr_starting_date = date("Y-m-d", strtotime($lr_starting_date));
                }
				else {
					$lr_starting_date = $GLOBALS['default_date'];
				}
				$balance = 0;
				if(empty($edit_id)) {
					if(empty($prev_organization_id)) {
						$action = "";
						if(!empty($name)) {
							$action = "New organization Created. Name - ".$obj->encode_decode('decrypt', $name);
						}

						$check_companies = array(); $organization_count = 0;
						$check_companies = $obj->getTableRecords($GLOBALS['organization_table'], '', '');
						if(!empty($check_companies)) {
							$organization_count = count($check_companies);
						}

						$null_value = $GLOBALS['null_value'];
						$columns = array('created_date_time', 'creator', 'creator_name', 'organization_id', 'name', 'address_line1', 'address_line2', 'city','district', 'pincode', 'state', 'gst_number', 'mobile_number', 'lr_starting_date', 'send_sms', 'payment_tax_type', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','amount','total_amount','deleted');
						$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$name."'", "'".$address_line1."'", "'".$address_line2."'", "'".$city."'","'".$district."'", "'".$pincode."'", "'".$state."'", "'".$gst_number."'", "'".$mobile_number."'", "'".$lr_starting_date."'", "'".$send_sms."'", "'".$payment_tax_type."'", "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'","'".$amount."'", "'".$total_amount."'", "'0'");
						$organization_insert_id = $obj->InsertSQL($GLOBALS['organization_table'], $columns, $values, $action);						
						if(preg_match("/^\d+$/", $organization_insert_id)) {
							$organization_id = "";
							if($organization_insert_id < 10) {
								$organization_id = "ORGANIZATION_".date("dmYhis")."_0".$organization_insert_id;
							}
							else {
								$organization_id = "ORGANIZATION_".date("dmYhis")."_".$organization_insert_id;
							}
							if(!empty($organization_id)) {
								$organization_id = $obj->encode_decode('encrypt', $organization_id);
							}
							$columns = array(); $values = array();						
							$columns = array('organization_id');
							$values = array("'".$organization_id."'");
							$organization_update_id = $obj->UpdateSQL($GLOBALS['organization_table'], $organization_insert_id, $columns, $values, '');
							if(preg_match("/^\d+$/", $organization_update_id)) {

								$image_copy = 1;$balance = 1;
								$result = array('number' => '1', 'msg' => 'organization Successfully Created');
							}
							else {
								$result = array('number' => '2', 'msg' => $organization_update_id);
							}
						}
						else {
							$result = array('number' => '2', 'msg' => $organization_insert_id);
						}
					}
					else {
						$result = array('number' => '2', 'msg' => $organization_error);
					}	
				}
				else {
					if(empty($prev_organization_id) || $prev_organization_id == $edit_id) {
						$getUniqueID = "";
						 $getUniqueID = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $edit_id, 'id');
						if(preg_match("/^\d+$/", $getUniqueID)) {
							$action = "";
							if(!empty($name)) {
								$action = "Organization Updated. Name - ".$obj->encode_decode('decrypt', $name);
							}

							$columns = array(); $values = array();						
							$columns = array('creator_name', 'name', 'address_line1', 'address_line2', 'city','district', 'pincode', 'state', 'gst_number', 'mobile_number', 'lr_starting_date', 'send_sms', 'payment_tax_type', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name', 'amount','total_amount');
							$values = array("'".$creator_name."'", "'".$name."'", "'".$address_line1."'", "'".$address_line2."'", "'".$city."'","'".$district."'", "'".$pincode."'", "'".$state."'", "'".$gst_number."'", "'".$mobile_number."'", "'".$lr_starting_date."'", "'".$send_sms."'", "'".$payment_tax_type."'" , "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'", "'".$amount."'","'".$total_amount."'");
							$organization_update_id = $obj->UpdateSQL($GLOBALS['organization_table'], $getUniqueID, $columns, $values, $action);
							if(preg_match("/^\d+$/", $organization_update_id)) {

								$image_copy = 1; $balance = 1;
								$result = array('number' => '1', 'msg' => 'Updated Successfully');					
							}
							else {
								$result = array('number' => '2', 'msg' => $organization_update_id);
							}							
						}
					}
					else {
						$result = array('number' => '2', 'msg' => $organization_error);
					}
                }
						
				       	$bill_id =  $GLOBALS['bill_company_id'];
                        $bill_date = date("d-m-Y");
                        $bill_number = $GLOBALS['null_value'];
                        $bill_type = "Company";
						$open_balance_type = "Credit";
    
                    if(!empty($payment_tax_type)) {
                        $payment_tax_type = explode(',', $payment_tax_type);
                        $payment_tax_type = array_reverse($payment_tax_type);
                    }

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
                    if(!empty($bank_names)) {
                        $bank_name = explode(',', $bank_names);
                        $bank_name = array_reverse($bank_name);
                    }
        
                    if(!empty($amount)) {
                        $amounts = explode(',', $amount);
                        $amounts = array_reverse($amounts);
                    }

				if(!empty($balance) && $balance == 1){
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
                         
							$update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$GLOBALS['null_value'],$GLOBALS['null_value'],$GLOBALS['null_value'],$payment_mode_id[$i],$payment_mode_name[$i],$bank_id[$i],$bank_name[$i],$credit,$debit,$open_balance_type, $payment_tax_type[$i],'');
						
                        }
                    } 
				}
				// if(!empty($organization_id)){
				// 	$_SESSION['bill_company_id'] = $organization_id;
				// }
				if(!empty($image_copy) && $image_copy == 1) {

					if(!empty($logo) && file_exists($temp_dir.$logo)) {  
						copy($temp_dir.$logo, $target_dir.$logo);
						$obj->clear_temp_image_directory();
					}					
				}

			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_organization)) {
				$result = array('number' => '3', 'msg' => $valid_organization);
			}else if(!empty($payment_error)) {
				$result = array('number' => '3', 'msg' => $payment_error);
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
		$page_title = $_POST['page_title']; $search_text = "";
		if(isset($_POST['search_text'])) {
			$search_text = $_POST['search_text'];
		}

		$login_staff_id = "";
		if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
			$login_staff_id =  $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
		}
		
		$total_records_list = array();
		$total_records_list = $obj->getTableRecords($GLOBALS['organization_table'], '', '');
		
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
		<?php } ?>
		<table class="table nowrap bg-white text-center">
			<thead class="bg-light">
				<tr>
					<th>S.No</th>
					<th>Organization Name</th>
					<th>City</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(!empty($show_records_list)) {
						foreach($show_records_list as $key => $list) { ?>
							<tr>
								<td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['organization_id'])) { echo $list['organization_id']; } ?>');"><?php echo $key + 1; ?></td>
								<td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['organization_id'])) { echo $list['organization_id']; } ?>');">
									<div class="w-100">
										<?php
											if(!empty($list['name'])) {
												$list['name'] = $obj->encode_decode('decrypt', $list['name']);
												echo $list['name'];
											}
										?>
									</div>
									
									<?php
										if(!empty($list['creator_name'])) {
											$list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
									?>
											<small><?php echo "Last Opened : ".$list['creator_name']; ?></small>
									<?php		
										} ?>
								</td>
								<td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['organization_id'])) { echo $list['organization_id']; } ?>');">
									<?php
										if(!empty($list['city']) && $list['city'] != "NULL") {
											$list['city'] = $obj->encode_decode('decrypt', $list['city']);
											echo $list['city'];
										}
									?>
								</td>
								<td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['organization_id'])) { echo $list['organization_id']; } ?>');">
									<a class="pr-2  cursor" href="#" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['organization_id'])) { echo $list['organization_id']; } ?>');"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
							<?php }
				}
				else {
			?>
					<tr>
						<td colspan="3" class="text-center">Sorry! No records found</td>
					</tr>
			<?php } ?>
			</tbody>
		</table>   
        <?php 
	} 
?>