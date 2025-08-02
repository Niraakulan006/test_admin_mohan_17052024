<?php
	include("include_files.php");
   
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['suspense_party_module'];
        }
    }
	if(isset($_REQUEST['show_suspense_party_id'])) { 
        $show_suspense_party_id = $_REQUEST['show_suspense_party_id'];

        $add_custom_party = "";
		if(isset($_REQUEST['add_custom_party'])) {
			$add_custom_party = $_REQUEST['add_custom_party'];
			$add_custom_party = trim($add_custom_party);
		}

        $opening_balance = "";$opening_balance_type = "";
        $country = "India";$state = "";$district = "";$city = "";$party_name = "";$mobile_number = "";$address = "";$email = "";$pincode = "";$identification = "";
        if(!empty($show_suspense_party_id)){
            $party_list = array();
            $party_list = $obj->getTableRecords($GLOBALS['suspense_party_table'],'suspense_party_id',$show_suspense_party_id);
            if(!empty($party_list)){
                foreach($party_list as $data){
                   
                    if(!empty($data['suspense_party_name']) && $data['suspense_party_name'] != $GLOBALS['null_value']){
                        $party_name = $obj->encode_decode("decrypt",$data['suspense_party_name']);
                        $party_name = html_entity_decode($party_name);
                    }
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']){
                        $mobile_number = $obj->encode_decode("decrypt",$data['mobile_number']);
                    }
                    if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']){
                        $email = $obj->encode_decode("decrypt",$data['email']);
                    }
                    if(!empty($data['pincode']) && $data['pincode'] != $GLOBALS['null_value']){
                        $pincode = $obj->encode_decode("decrypt",$data['pincode']);
                    }
                    if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']){
                        $state = $obj->encode_decode("decrypt",$data['state']);
                    }
                    if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']){
                        $district = $obj->encode_decode("decrypt",$data['district']);
                    }
                    if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']){
                        $city = $obj->encode_decode("decrypt",$data['city']);
                    }
                  
                    if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']){
                        $address = $obj->encode_decode("decrypt",$data['address']);
                        $address = html_entity_decode($address);
                    }
                    if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']){
                        $identification = $obj->encode_decode("decrypt",$data['identification']);
                    }
                    if(!empty($data['opening_balance']) && $data['opening_balance'] != $GLOBALS['null_value']){
                        $opening_balance = $data['opening_balance'];
                    }
                    if(!empty($data['opening_balance_type']) && $data['opening_balance_type'] != $GLOBALS['null_value']){
                        $opening_balance_type = $data['opening_balance_type'];
                    }
                  
                }
            }
        }
   
          $linked_suspense_party = 0;
        // if(!empty($show_suspense_party_id)){
        //      $linked_suspense_party = $obj->PaymentlinkedParty($show_suspense_party_id);
        // }
        ?>
        <form class="poppins pd-20 redirection_form" name="suspense_party_form" method="POST">
        <?php if(empty($add_custom_party)) { ?>
			<div class="card-header">
				<div class="row">
				   <?php if(empty($show_suspense_party_id)){ ?>
                        <div class="col-lg-8 col-md-8 col-8">
                            <h5 class="text-white">Add Suspense Party</h5>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-8 col-md-8 col-8">
                            <h5 class="text-white">Edit Suspense Party</h5>
                        </div>
                    <?php } ?>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('suspense_party.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
        <?php } ?>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_suspense_party_id)) { echo $show_suspense_party_id; } ?>">   
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="party_name" class="form-control shadow-none" placeholder="" value="<?php if(!empty($party_name)){echo $party_name;} ?>"  onkeydown="Javascript:KeyboardControls(this,'text');">
                            <label>Suspense Party Name(*)</label>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &,.</div>
						
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="mobile_number" class="form-control shadow-none" placeholder="" value="<?php if(!empty($mobile_number)){echo $mobile_number;} ?>"  onfocus="Javascript:KeyboardControls(this,'mobile_number');">
                            <label>Mobile Number(*)</label>
                        </div>
                        <div class="new_smallfnt">Number only (only 10 digits)</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12 d-none">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="email" class="form-control shadow-none" placeholder="" value="<?php if(!empty($email)){echo $email;} ?>" onkeyup="Javascript:InputBoxColor(this,'text');ToLower(this);">
                            <label>Email</label>
                        </div>
                        <div class="new_smallfnt">email format</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" name="address" placeholder="Enter Address" rows="1" ><?php if(!empty($address)){echo $address;} ?></textarea>
                            <label>Address</label>
                        </div>
						<div class="new_smallfnt">Letters,Numbers & Symbols(@&_.'") (Up to 150 characters)</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="w-100" style="display:none;">
								<select class="form-control" name="country" id="country" onchange="Javascript:getCountries('party',this.value,'','','');">
									<option value="">Select</option>
								</select>
							</div>
                            <select name="state" class="select2 select2-danger" style="width: 100%;" onchange="Javascript:getStates('party',this.value, '', '');">
								
							</select>
							<label>State (*)</label>
                        </div> 
                    </div>
                </div>   
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="district" class="select2 select2-danger" placeholder="Select District" style="width: 100%;" onchange="Javascript:getDistricts('suspense_party', this.value, '');">
								
							</select>
							<label>District</label>
                        </div> 
                    </div>
                </div>   
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="city" class="select2 select2-danger" placeholder="Select City" style="width: 100%;" onchange="Javascript:getCities('suspense_party', '', this.value);">
								<option value="">Select</option>
							</select>
							<label>City</label>
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
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="pincode" class="form-control shadow-none" placeholder="" value="<?php if(!empty($pincode)){echo $pincode;} ?>"  onfocus="Javascript:KeyboardControls(this,'number');" maxlength="6">
                            <label>Pincode</label>
                        </div>
                        <div class="new_smallfnt">Numbers only (only 6 digits)</div>
						<!-- <div class="infos"><i class="fa fa-exclamation-circle"></i> Enter valid pincode</div> -->
                    </div>
                </div>  
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="identification" class="form-control shadow-none" placeholder="" value="<?php if(!empty($identification)){echo $identification;} ?>" >
                            <label>Identification</label>
                        </div>
                        <div class="new_smallfnt">Text & Numbers only (Up to 150 characters)</div>
						<!-- <div class="infos"><i class="fa fa-exclamation-circle"></i> Enter valid identification</div> -->
                    </div>
                </div>  
                <div class="col-lg-4 col-md-4 col-12 ">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                    <input type="text" id="opening_balance" name="opening_balance" class="form-control shadow-none" required  value="<?php if(!empty($opening_balance)){echo $opening_balance;} ?>" onfocus="Javascript:KeyboardControls(this,'number',15,1);" maxlength="15" style="width:30%" <?php if(!empty($linked_suspense_party)){ ?> readonly <?php } ?>>
                                    <label>Opening Balance</label>
                                <div class="input-group-append" style="width:40%!important;">
                                    <select name="opening_balance_type" class="select2 select2-danger" placeholder="Select Opening Balance Type" style="width: 100%!important;" onchange="Javascript:InputBoxColor(this,'select');"  <?php if(!empty($linked_suspense_party)){ ?> disabled <?php } ?>>
                                        <option value="0">Select</option>
                                        <option value="Credit" <?php if(!empty($opening_balance_type) && $opening_balance_type == "Credit"){ ?>selected<?php } ?>>Credit</option>
                                        <option value="Debit" <?php if(!empty($opening_balance_type) && $opening_balance_type == "Debit"){ ?>selected<?php } ?>>Debit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!empty($linked_suspense_party) && !empty($show_suspense_party_id)){ ?>
                    <input type="hidden" name="opening_balance_type" value="<?php if(!empty($opening_balance_type)){ echo $opening_balance_type; } ?>">
                    <?php 
                } ?>
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark submit_button" type="button" onClick="Javascript:SaveModalContent('suspense_party_form', 'suspense_party_changes.php', 'suspense_party.php');">
                        Submit
                    </button>
                </div>
            </div>
        </form>

        <script type="text/javascript">                
            jQuery(document).ready(function(){
                jQuery('.add_update_form_content').find('select').select2();
                jQuery('select[name="state"]').select2();
                jQuery('select[name="district"]').select2();
                jQuery('select[name="city"]').select2();
                getCountries('suspense_party','<?php if(!empty($country)) { echo $country; } ?>', '<?php if(!empty($state)) { echo $state; } ?>', '<?php if(!empty($district)) { echo $district; } ?>', '<?php if(!empty($city)) { echo $city; } ?>');
            });
        </script>
		<?php
    } 

    if(isset($_POST['party_name'])) {
     	
        $party_name = ""; $party_name_error = "";$opening_balance = "";$opening_balance_error = "";
		$mobile_number = ""; $mobile_number_error = "";
		$email = ""; $email_error = ""; 
		$address = ""; $address_error = "";  
		$identification = "";$identification_error = "";
		$state = ""; $state_error = ""; 
		$district = ""; $district_error = "";
		$city = ""; $city_error = "";
		$pincode_error = ""; $pincode = ""; 
        $others_city ="";$others_city_error = "";
		$valid_party = ""; $form_name = "suspense_party_form";
       

        if(isset($_POST['party_name'])){
            $party_name = $_POST['party_name'];
            if(strlen($party_name) > 60){
                $party_name_error = "Only 60 characters allowed";
            }
            else{
                $party_name_error = $valid->valid_name_text($party_name,'party name','1');
            }
            if(!empty($party_name_error)){
                if(!empty($valid_party)){
                    $valid_party = $valid_party." ".$valid->error_display($form_name,'party_name',$party_name_error,'text');
                }
                else{
                    $valid_party = $valid->error_display($form_name,'party_name',$party_name_error,'text');
                }
            }
        }

		if(isset($_POST['mobile_number'])){
			$mobile_number = $_POST['mobile_number'];
			$mobile_number_error = $valid->valid_mobile_number($mobile_number,'mobile number','1');
			
			if(!empty($mobile_number_error)) {
				if(!empty($valid_party)) {
					$valid_party = $valid_party." ".$valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
				}
				else {
					$valid_party = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
				}
			}
		}

		if(isset($_POST['email'])){
			$email = $_POST['email'];
			if(!empty($email)){
				if(strlen($email) > 40){
					$email_error = "Only 40 characters allowed";
				}
				else{
					$email_error = $valid->valid_email($email, "email", "0");
				}
				if(!empty($email_error)) {
					if(!empty($valid_party)) {
						$valid_party = $valid_party." ".$valid->error_display($form_name, "email", $email_error, 'text');
					}
					else {
						$valid_party = $valid->error_display($form_name, "email", $email_error, 'text');
					}
				}
			}
		}
       
		if(isset($_POST['identification'])){
			$identification = $_POST['identification'];
				if(strlen($identification) > 150) {
					$identification_error = "Identification - Max.Character upto 150";

                }else{
                    $identification_error = $valid->valid_text_number($identification, "identification", "0");

                }
		
				if(!empty($identification_error)) {
					if(!empty($valid_party)) {
						$valid_party = $valid_party." ".$valid->error_display($form_name, "identification", $identification_error, 'text');
					}
					else {
						$valid_party = $valid->error_display($form_name, "identification", $identification_error, 'text');
					}
				}
		}

		if(isset($_POST['address'])) {
			$address = $_POST['address'];
			$address = $valid->clean_value($address);
			if(!empty($address)){
				if(strlen($address) > 150){
					$address_error = "Only 150 characters allowed";
				}
				else{
					$address_error = $valid->valid_address($address,"address",'0','30');
				}
				if(!empty($address_error)){
					if(!empty($valid_party)) {
						$valid_party = $valid_party." ".$valid->error_display($form_name, "address", $address_error, 'textarea');
					}
					else {
						$valid_party = $valid->error_display($form_name, "address", $address_error, 'textarea');
					}
				}
			}
		}

		if(isset($_POST['state'])) {
			$state = $_POST['state'];
			$state = $valid->clean_value($state);
            if(empty($state)){
                $state_error = "Select State";
            }
            if(!empty($state_error)){
                if(!empty($valid_party)) {
                    $valid_party = $valid_party." ".$valid->error_display($form_name, "state", $state_error, 'select');
                }
                else {
                    $valid_party = $valid->error_display($form_name, "state", $state_error, 'select');
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
                    if(!empty($valid_party)) {
                        $valid_party = $valid_party." ".$valid->error_display($form_name, "opening_balance", $opening_balance_type_error, 'input_group');
                    }
                    else {
                        $valid_party = $valid->error_display($form_name, "opening_balance", $opening_balance_type_error, 'input_group');
                    }
                }
            }
        }

        if(!empty($opening_balance_type) && empty($opening_balance)){
            $opening_balance_error = "Enter opening balance as type is selected";
        }
        if(!empty($opening_balance_error)){
            if(!empty($valid_party)) {
                $valid_party = $valid_party." ".$valid->error_display($form_name, "opening_balance", $opening_balance_error, 'input_group');
            }
            else {
                $valid_party = $valid->error_display($form_name, "opening_balance", $opening_balance_error, 'input_group');
            }
        }
   

		if(isset($_POST['district'])) {
            $district = $_POST['district'];
            $district = $valid->clean_value($district);
        }
        if(isset($_POST['city'])){
            $city = $_POST['city'];
            $city = $valid->clean_value($city);
        }

        if(isset($_POST['others_city']))
		{
			$others_city = $_POST['others_city'];
            if($city == "Others"){
                $others_city_error = $valid->valid_text($others_city,'City','1');
                if(!empty($others_city_error)){
                    if(!empty($valid_party)) {
						$valid_party = $valid_party." ".$valid->error_display($form_name, "others_city", $others_city_error, 'text');
					}
					else {
						$valid_party = $valid->error_display($form_name, "others_city", $others_city_error, 'text');
					}
                }
                else{
                    $city = $others_city;
                    $city = $valid->clean_value($city);
                }
            }
		}
		

		if(isset($_POST['pincode'])){
			$pincode = $_POST['pincode'];
			if(!empty($pincode)) {
				$pincode_error = $valid->valid_pincode($pincode, "Pincode", "0");
				if(!empty($pincode_error)) {
					if(!empty($valid_party)) {
						$valid_party = $valid_party." ".$valid->error_display($form_name, "pincode", $pincode_error, 'text');
					}
					else {
						$valid_party = $valid->error_display($form_name, "pincode", $pincode_error, 'text');
					}
				}
			} 
		}

		if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
		}
        if(!empty($edit_id)) {
            if($city != "Others" && (empty($others_city))){
                $others_city = $city;
            }
		}
		$result = ""; $lower_case_name = "";$prev_suspense_party_id = ""; $party_error = "";	
		
		if(empty($valid_party)) {
			$check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
             $name_mobile_city = ""; $party_details = "";
                if(!empty($party_name)) {
					
                    $party_name = htmlentities($party_name, ENT_QUOTES);
                    $lower_case_name = strtolower($party_name);
                    $lower_case_name = htmlentities($lower_case_name, ENT_QUOTES);
					// $party_name = $obj->encode_decode('encrypt', $party_name); 
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                }

                if(!empty($party_name)) {
                    $name_mobile_city = $party_name;
                    $party_details = $party_name;
                    $party_name = $obj->encode_decode('encrypt', $party_name);
                }
				$bill_company_id = $GLOBALS['bill_company_id'];
				
				if(!empty($address)) {
					$address = htmlentities($address, ENT_QUOTES);
                    if(!empty($party_details)) {
                        $party_details = $party_details."$$$".$address;
                    }
                    $address = $obj->encode_decode('encrypt', $address);
                }
				else {
					$address = $GLOBALS['null_value'];
				}
	            if(!empty($district)) {
                     if(!empty($party_details)) {
                        $party_details = $party_details."$$$".$district;
                    }
                    $district = $obj->encode_decode('encrypt', $district);
                }
				else{
					$district = $GLOBALS['null_value'];
				}
          
                if(!empty($city)) {
                       if(!empty($party_details)) {
                        $party_details = $party_details."$$$".$city;
                    }
                }
			
				
				if(!empty($state)) {
                    if(!empty($party_details)) {
                        $party_details = $party_details."$$$".$state;
                    }
                    $state = $obj->encode_decode('encrypt', $state);
                }
				else{
					$state = $GLOBALS['null_value'];
				}

			

           
                if(!empty($pincode)) {
                    if(!empty($party_details)) {
                        $party_details = $party_details."$$$".$pincode;
                    }
                    $pincode = $obj->encode_decode('encrypt', $pincode);
                }
				else {
					$pincode = $GLOBALS['null_value'];
				}
                
                if(!empty($mobile_number)) {
                    if(!empty($party_details)) {
                        $party_details = $party_details."$$$".$mobile_number;
                    }
                    if(!empty($name_mobile_city)) {
                        $name_mobile_city = $name_mobile_city." (".$mobile_number.")";
                        if(!empty($city)) {
                            $name_mobile_city = $name_mobile_city." - ".$city;
                        }
                       
                    }
                    $mobile_number = $obj->encode_decode('encrypt', $mobile_number);
                }
            
                if(!empty($city)){
                    $city = $obj->encode_decode('encrypt', $city);
                }else{
					$city = $GLOBALS['null_value'];

                }

				$prev_mobile_id = "";$mobile_error = "";$error_mobile = "";
				if(!empty($mobile_number)){
					$prev_mobile_id = $obj->getTableColumnValue($GLOBALS['suspense_party_table'],'mobile_number',$mobile_number,'suspense_party_id');
					if(!empty($prev_mobile_id)){
						$error_mobile = $obj->getTableColumnValue($GLOBALS['suspense_party_table'],'suspense_party_id',$prev_mobile_id,'suspense_party_name');
						$error_mobile = $obj->encode_decode("decrypt",$error_mobile);
						$mobile_error = "This Mobile Number Already exists in ".$error_mobile;
					}
				}

				if(!empty($email)) {
                    $email = $obj->encode_decode('encrypt', $email);
                }
				else {
                    $email = $GLOBALS['null_value'];
                }

                if(!empty($name_mobile_city)){
                    $name_mobile_city = $obj->encode_decode('encrypt', $name_mobile_city);
                }else {
                    $name_mobile_city = $GLOBALS['null_value'];
                }

				if(!empty($identification)){
					$identification = $obj->encode_decode('encrypt',$identification);
				}
				else{
					$identification = $GLOBALS['null_value'];
				}
                
				if(!empty($party_details)){
					$party_details = $obj->encode_decode('encrypt',$party_details);
				}
				else{
					$party_details = $GLOBALS['null_value'];
				}
         
				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $update_payment = 0;
				if(empty($edit_id)) {
					if(empty($prev_suspense_party_id)) {
						if(empty($prev_mobile_id)){
							$action = "";
							if(!empty($party_name)) {
								$action = "New party Created - ".$obj->encode_decode("decrypt",$party_name);
							}

							$null_value = $GLOBALS['null_value'];
							$columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'suspense_party_id', 'suspense_party_name','lower_case_name', 'mobile_number','address','identification','state','district','city','others_city','pincode','opening_balance','opening_balance_type','name_mobile_city','suspense_party_details','deleted');
							$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$party_name."'", "'".$lower_case_name."'","'".$mobile_number."'","'".$address."'","'".$identification."'","'".$state."'","'".$district."'","'".$city."'","'".$others_city."'","'".$pincode."'","'".$opening_balance."'","'".$opening_balance_type."'","'".$name_mobile_city."'","'".$party_details."'","'0'");
							$party_insert_id = $obj->InsertSQL($GLOBALS['suspense_party_table'], $columns, $values, $action);				
							if(preg_match("/^\d+$/", $party_insert_id)) {
								$party_id = "";
								if($party_insert_id < 10) {
									$party_id = "SUSPENSE_PARTY_".date("dmYhis")."_0".$party_insert_id;
								}
								else {
									$party_id = "SUSPENSE_PARTY_".date("dmYhis")."_".$party_insert_id;
								}
								if(!empty($party_id)) {
									$party_id = $obj->encode_decode('encrypt', $party_id);
								}

								$columns = array(); $values = array();						
								$columns = array('suspense_party_id');
								$values = array("'".$party_id."'");
								$party_update_id = $obj->UpdateSQL($GLOBALS['suspense_party_table'], $party_insert_id, $columns, $values, '');
								if(preg_match("/^\d+$/", $party_update_id)) {
                                         $update_payment =1;
									$result = array('number' => '1', 'msg' => 'Suspense Party Successfully Created','party_id' => $party_id);
								}
								else {
									$result = array('number' => '2', 'msg' => $party_update_id);
								}
							}
							else {
								$result = array('number' => '2', 'msg' => $party_insert_id);
							}
						}
						else{
							$result = array('number' => '2', 'msg' => $mobile_error);
						}
					}
					else {
						$result = array('number' => '2', 'msg' => $party_error);
					}	
				}
				else {
					if(empty($prev_suspense_party_id) || $prev_suspense_party_id == $edit_id) {
						if(empty($prev_mobile_id) || $prev_mobile_id == $edit_id){
							$getUniqueID = "";
							$getUniqueID = $obj->getTableColumnValue($GLOBALS['suspense_party_table'], 'suspense_party_id', $edit_id, 'id');
                            $party_id = $edit_id;
							if(preg_match("/^\d+$/", $getUniqueID)) {
								$action = "";
								if(!empty($party_name)) {
									$action = "party Updated.";
								}

								$columns = array(); $values = array();			
								$columns = array('creator_name','suspense_party_name', 'lower_case_name', 'mobile_number','address','identification','state','district','city','others_city','pincode','opening_balance','opening_balance_type','name_mobile_city','suspense_party_details');
								$values = array( "'".$creator_name."'", "'".$party_name."'", "'".$lower_case_name."'","'".$mobile_number."'","'".$address."'","'".$identification."'","'".$state."'","'".$district."'","'".$city."'","'".$others_city."'","'".$pincode."'","'".$opening_balance."'","'".$opening_balance_type."'","'".$name_mobile_city."'","'".$party_details."'");
								$party_update_id = $obj->UpdateSQL($GLOBALS['suspense_party_table'], $getUniqueID, $columns, $values, $action);
								if(preg_match("/^\d+$/", $party_update_id)) {
                                         $update_payment =1;

									$result = array('number' => '1', 'msg' => 'Updated Successfully');					
								}
								else {
									$result = array('number' => '2', 'msg' => $party_update_id);
								}							
							}
						}
						else{
							$result = array('number' => '2', 'msg' => $mobile_error);
						}
					}
					else {
						$result = array('number' => '2', 'msg' => $party_error);
					}
                }	

                  
                if ($update_payment == 1) {
                    $bill_date = date("Y-m-d");
                    $bill_number = $GLOBALS['null_value'];
                    $bill_type = "Opening Balance";
                    $party_type = "Suspense Party";
                    $payment_mode_id = $GLOBALS['null_value'];
                    $payment_mode_name = $GLOBALS['null_value'];
                    $bank_id = $GLOBALS['null_value'];
                    $bank_name = $GLOBALS['null_value'];
                    $credit  = 0; $debit = 0; 
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
                    $update_balance = $obj->UpdateBalance($party_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit, $balance_type, $GLOBALS['null_value'],'');

                    }else{
                        $payment_unique_id = "";
                        $payment_unique_id = $obj->getPartyOpeningBalanceInPaymentExist($party_id,$bill_type);
                        if(preg_match("/^\d+$/", $payment_unique_id."")) {
                            $action = "Payment Deleted.";
                        
                            $columns = array(); $values = array();						
                            $columns = array('deleted');
                            $values = array("'1'");
                            $msg = $obj->UpdateSQL($GLOBALS['payment_table'], $payment_unique_id, $columns, $values, $action);
                        }
                    }
                }

			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_party)) {
				$result = array('number' => '3', 'msg' => $valid_party);
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
		if(!empty($GLOBALS['bill_company_id'])) {
			$total_records_list = $obj->getTableRecords($GLOBALS['suspense_party_table'],'','','');
		}

        if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($total_records_list)) {
				foreach($total_records_list as $val) {
					if( (strpos(strtolower(html_entity_decode($obj->encode_decode('decrypt', $val['suspense_party_name']))), $search_text) !== false) || (strpos($obj->encode_decode('decrypt', $val['mobile_number']), $search_text) !== false) ) {
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
		<table class="table nowrap cursor bg-white text-center">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Suspense Party Name</th>
                    <th>Identification</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    if(!empty($show_records_list)) {
                        foreach($show_records_list as $key => $list) {
                            $index = $key + 1;
                            if(!empty($prefix)) { $index = $index + $prefix; } ?>
                            <tr>

                                <td class="text-center" style="cursor:default;"><?php echo $index; ?></td>
                                <td class="text-center" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['suspense_party_id'])) { echo $list['suspense_party_id']; } ?>');">
                                    <?php
                                        if(!empty($list['name_mobile_city']) && $list['name_mobile_city'] != $GLOBALS['null_value']) {
                                            $list['name_mobile_city'] = $obj->encode_decode('decrypt', $list['name_mobile_city']);
                                            echo(html_entity_decode($list['name_mobile_city']));
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
                                <td class="text-center" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');">
                                    <?php
                                        if(!empty($list['identification']) && $list['identification'] != $GLOBALS['null_value']) {
                                            $list['identification'] = $obj->encode_decode('decrypt', $list['identification']);
                                            echo($list['identification']);
                                        }else{
                                            echo' - '; 
                                        }

                                    ?>
                                </td>
                                <td>
                                    <?php 
                                    $access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $edit_action;
                                        include('permission_action.php');
                                    }

                                    if(empty($access_error)) { ?>
                                        <a class="pr-2" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['suspense_party_id'])) { echo $list['suspense_party_id']; } ?>');" ><i class="fa fa-pencil" title="edit"></i></a>
                                        
                                    <?php }  
                                        
                                    $access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $delete_action;
                                        include('permission_action.php');
                                    }
                                    if(empty($access_error)){ ?>
                                        <?php
                                        $linked_count = 0;
                                        $linked_count = $obj->GetSuspensePartyLinkedCount($list['suspense_party_id']);

                                        if(!empty($linked_count)){
                                            ?>
                                                <span title="This Suspense Party can't be deleted">
                                                    <a class="pr-2" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['suspense_party_id'])) { echo $list['suspense_party_id']; } ?>');" <?php if(!empty($linked_count)){ ?>style="pointer-events: none; cursor: default;"<?php } ?> > <i class="fa fa-trash <?php if(!empty($linked_count)){ ?>text-secondary<?php }else{ ?>text-dark<?php } ?>"></i></a>
                                                </span>

                                            <?php
                                        }else{
                                            ?>
                                                <a class="pr-2" onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['suspense_party_id'])) { echo $list['suspense_party_id']; } ?>');"> <i class="fa fa-trash text-dark"></i></a>
                                            <?php
                                        }
                                     ?>
                                    <?php } ?>
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
                <?php }  ?>
            </tbody>
        </table>   
                      
		<?php	
        }
	}

    if(isset($_REQUEST['delete_suspense_party_id'])) {
        $delete_suspense_party_id = $_REQUEST['delete_suspense_party_id'];
        $msg = "";
        if(!empty($delete_suspense_party_id)) {	
            $party_unique_id = "";
            $party_unique_id = $obj->getTableColumnValue($GLOBALS['suspense_party_table'], 'suspense_party_id', $delete_suspense_party_id, 'id');
            if(preg_match("/^\d+$/", $party_unique_id)) {
               
                $action = "";
                if(!empty($party_name)) {
                    $action = "Suspense Party Deleted - ".$obj->encode_decode("decrypt",$party_name);
                }

                $delete = 0;

				$delete = $obj->GetSuspensePartyLinkedCount($delete_suspense_party_id);
            
                if($delete == 0 || empty($delete)){
                    $delete_id = $obj->DeletePayment($delete_suspense_party_id);	
					$columns = array(); $values = array();						
					$columns = array('deleted');
					$values = array("'1'");
					$msg = $obj->UpdateSQL($GLOBALS['suspense_party_table'], $party_unique_id, $columns, $values, $action);

                }
				else{

					$msg = "This party is linked in bill entry.So it can't be deleted";

				}
            }
        }
        echo $msg;
        exit;	
    }
    ?>