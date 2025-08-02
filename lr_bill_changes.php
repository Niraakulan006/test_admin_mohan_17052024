
<?php 
    include("include_files.php");
	
    if(isset($_REQUEST['get_details_consignor_id'])) {
		$get_details_consignor_id = "";
		$get_details_consignor_id = $_REQUEST['get_details_consignor_id'];

		$name = ""; $address = ""; $city = ""; $mobile_number = ""; $email = ""; $gst_number = ""; $district = ""; $state = ""; $identification = "";
        if(!empty($get_details_consignor_id)) {
            $consignor_list = array(); $consignor_details = "";
            $consignor_list = $obj->getTableRecords($GLOBALS['consignor_table'], 'consignor_id', $get_details_consignor_id);
            if(!empty($consignor_list)) {
				foreach($consignor_list as $data) {
					if(!empty($data['name'])) {
						$name = $obj->encode_decode('decrypt', $data['name']);
					}
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
						$mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
					}
					if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
						$identification = $obj->encode_decode('decrypt', $data['identification']);
					}
					if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
						$address = $obj->encode_decode('decrypt', $data['address']);
					}
					if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
						$city = $obj->encode_decode('decrypt', $data['city']);
					}
					if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
						$email = $obj->encode_decode('decrypt', $data['email']);
					}
					if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
						$district = $obj->encode_decode('decrypt', $data['district']);
					}
                    if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
						$state = $obj->encode_decode('decrypt', $data['state']);
					}
					if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']) {
						$gst_number = $obj->encode_decode('decrypt', $data['gst_number']);
					}
					
				}
				$consignor_details = array('name' => $name, 'mobile_number' => $mobile_number, 'email' => $email, 'address' => $address, 'city' => $city, 'district' => $district, 'state' => $state, 'gst_number' => $gst_number, 'identification' => $identification);
            }
        }
		if(!empty($consignor_details)) {
			$consignor_details = json_encode($consignor_details);
		}
		echo $consignor_details;
		exit;
	}
	if(isset($_REQUEST['get_details_account_party_id'])) {
		$get_details_account_party_id = "";
		$get_details_account_party_id = $_REQUEST['get_details_account_party_id'];

		$name = ""; $address = ""; $city = ""; $mobile_number = ""; $email = ""; $gst_number = ""; $state = ""; $identification = "";
        if(!empty($get_details_account_party_id)) {
            $account_party_list = array(); $account_party_details = "";
            $account_party_list = $obj->getTableRecords($GLOBALS['account_party_table'], 'account_party_id', $get_details_account_party_id);
            if(!empty($account_party_list)) {
				foreach($account_party_list as $data) {
					if(!empty($data['name'])) {
						$name = $obj->encode_decode('decrypt', $data['name']);
					}
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
						$mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
					}
                    if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
						$email = $obj->encode_decode('decrypt', $data['email']);
					}
					if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
						$address = $obj->encode_decode('decrypt', $data['address']);
					}
					if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
						$city = $obj->encode_decode('decrypt', $data['city']);
					}
                    if(!empty($data['state'])) {
						$state = $data['state'];
					}
					if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']) {
						$gst_number = $obj->encode_decode('decrypt', $data['gst_number']);
					}
					if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
						$identification = $obj->encode_decode('decrypt', $data['identification']);
					}
				}
				$account_party_details = array('name' => $name, 'mobile_number' => $mobile_number, 'email' => $email, 'address' => $address, 'city' => $city, 'state' => $state, 'gst_number' => $gst_number, 'identification' => $identification);
            }
        }
		if(!empty($account_party_details)) {
			$account_party_details = json_encode($account_party_details);
		}
		echo $account_party_details;
		exit;
	}

	if(isset($_REQUEST['add_row'])) {
        $add_row = $_REQUEST['add_row'];

		$check_admin = 0;
		if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['admin_user_type']) {
			if(!empty($GLOBALS['creator'])){
				$check_admin = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $GLOBALS['creator'], 'admin');
			}
		} 
		$unit_list = array();
        $unit_list = $obj->getTableRecords($GLOBALS['unit_table'],'',''); 
?>

        <tr class="product_row" id="product_row<?php if(!empty($add_row_index)) { echo $add_row_index; } ?>">
            <td class="text-center sno "></td>
			<td class="text-center">
				<select class="form-control" name="selected_unit_id[]" onchange="Javascript:selectUnit(this.value,this);">
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
				<input type="hidden" value="" name="unit_id[]">
				<script>jQuery('select[name="selected_unit_id[]"]').select2();</script>
			</td>
			<td> 
				<input type="text"  id="quantity" name="quantity[]" class="form-control shadow-none" placeholder="" onKeyup="Javascript:ProductRowCheck(this);" required>
			</td>
			<td> 
				<input type="text"  id="weight" name="weight[]" class="form-control shadow-none" placeholder="" onKeyup="Javascript:ProductRowCheck(this);" required>
			</td>
			<td>
				<input type="text" id="price_per_qty" name="price_per_qty[]" class="form-control shadow-none" placeholder="" onKeyup="Javascript:ProductRowCheck(this);" required>
			</td>
			<td class="text-center freight"></td> 
			<td class="text-center">
				<input type="text" id="price_per_kooli" name="price_per_kooli[]" class="form-control shadow-none" placeholder="" value="" onKeyup="Javascript:ProductRowCheck(this);" required>
			</td> 
			<td class="text-center total_kooli"></td>
			<td class="text-right amount"></td>
			<td class="text-center">
				<?php /* ?><div class="add_button ">
					<button class="btn btn-success" style="font-size:11px;margin-top: 5px;margin-left: 5px;" type="button" onClick="Javascript:addRow();"><i class="fa fa-plus" ></i> ADD</button>
				</div>  d-none <?php */ ?>
				<div class="delete_button">
					<button class="btn btn-danger" style="font-size:11px;margin-top: 5px;margin-left: 5px;" type="button" onclick="Javascript:DeleteProductRow(this);"><i class="fa fa-trash"></i> Delete</button>
				</div>
            </td>  

        </tr>
		<?php        
    }
	if(isset($_REQUEST['get_details_organization_id'])) {
		$get_details_organization_id = "";
		$get_details_organization_id = $_REQUEST['get_details_organization_id'];

		$name = ""; $address = ""; $city = ""; $mobile_number = ""; $email = ""; $gst_number = ""; $state = ""; $identification = "";
        if(!empty($get_details_organization_id)) {
            $organization_list = array(); $organization_details = "";
            $organization_list = $obj->getTableRecords($GLOBALS['organization_table'], 'organization_id', $get_details_organization_id);
            if(!empty($organization_list)) {
				foreach($organization_list as $data) {
					if(!empty($data['name'])) {
						$name = $obj->encode_decode('decrypt', $data['name']);
					}
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
						$mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
					}
                    if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
						$email = $obj->encode_decode('decrypt', $data['email']);
					}
					if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
						$address = $obj->encode_decode('decrypt', $data['address']);
					}
					if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
						$city = $obj->encode_decode('decrypt', $data['city']);
					}
                    if(!empty($data['state'])) {
						$state = $obj->encode_decode('decrypt', $data['state']);
					}
					if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']) {
						$gst_number = $obj->encode_decode('decrypt', $data['gst_number']);
					}
					if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
						$identification = $obj->encode_decode('decrypt', $data['identification']);
					}
					if(!empty($data['print_type']) && $data['print_type'] != $GLOBALS['null_value']) {
						$print_type =  $data['print_type'];
					}
				}
				$consignor_details = array('name' => $name, 'mobile_number' => $mobile_number, 'email' => $email, 'address' => $address, 'city' => $city, 'state' => $state, 'gst_number' => $gst_number, 'identification' => $identification,'print_type' =>$print_type);
            }
        }
		if(!empty($consignor_details)) {
			$consignor_details = json_encode($consignor_details);
		}
		echo $consignor_details;
		exit;
	}
	if(isset($_REQUEST['get_state_branch'])) {
		$state = trim($_REQUEST['get_state_branch']);
		if(!empty($state)) {
			$state = $obj->encode_decode("encrypt",$state);
		}
		$branch_list = array();
		$branch_list = $obj->getTableRecords($GLOBALS['branch_table'], 'state', $state);
		?>
		<option value="">Select Branch</option>
		<?php
		if(!empty($branch_list)) {
			foreach($branch_list as $data) {
				if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value']) {
					?>
					<option value="<?php echo $data['branch_id']; ?>">
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
	}
	
	if(isset($_REQUEST['get_consignee_id'])) {
		$get_consingee_id = "";
		$get_consingee_id = $_REQUEST['get_consignee_id'];
		if(!empty($get_consingee_id)) {
			$mobile_number = ""; $district = ""; $city = "";
			$mobile_number = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $get_consingee_id, 'mobile_number');
			$district = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $get_consingee_id, 'district');
			$city = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $get_consingee_id, 'city');
			$others_city = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $get_consingee_id, 'others_city');
			if(!empty($mobile_number))
			{
				$mobile_number = $obj->encode_decode("decrypt",$mobile_number);
			}
			$state = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $get_consingee_id, 'state');
			if(!empty($state))
			{
				$state = $obj->encode_decode("decrypt",$state);
			}
			if(!empty($district) && $district != 'NULL')
			{
				$district = $obj->encode_decode("decrypt",$district);
			}
			else { $district = ""; }
			if(!empty($city) && $city != 'NULL')
			{
				$city = $obj->encode_decode("decrypt",$city);
				if($city == 'Others')
				{
					
					$city = $others_city;
				}
			}
			else { $city = ""; }
			echo $mobile_number."$$$".$state."$$$".$city."$$$".$district;			
		}
	}
	if(isset($_REQUEST['state']))
	{
		$state = $_REQUEST['state'];
		if(!empty($state))
		{
			echo $state = $obj->encode_decode("encrypt",$state);
		}
	}
	if(isset($_REQUEST['get_consignor_id'])) {
		$get_consingee_id = "";
		$get_consingee_id = $_REQUEST['get_consignor_id'];
		if(!empty($get_consingee_id)) {
			$mobile_number = ""; $identification = ""; $city = "";
			$consignor_list = array();
			$consignor_list = $obj->getTableRecords($GLOBALS['consignor_table'], 'consignor_id', $get_consingee_id);
            if(!empty($consignor_list)) {
                foreach($consignor_list as $data) {
					if(!empty($data['mobile_number'])) {
                        $mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
					}
					if(!empty($data['city'])  && $data['city'] != 'NULL') {
                        $city = $obj->encode_decode('decrypt', $data['city']);
					}
                    if(!empty($data['identification'])  && $data['identification'] != 'NULL') {
                        $identification = $obj->encode_decode('decrypt', $data['identification']);
					}
					
                }
            }
			echo $mobile_number."$$$".$identification."$$$".$city;	
		}
	}
	if(isset($_REQUEST['get_account_party_id'])) {
		$get_consingee_id = "";
		$get_consingee_id = $_REQUEST['get_account_party_id'];
		if(!empty($get_consingee_id)) {
			$mobile_number = ""; $identification = ""; $city = "";
			$mobile_number = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'account_party_id', $get_consingee_id, 'mobile_number');
			$identification = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'account_party_id', $get_consingee_id, 'identification');
			$city = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'account_party_id', $get_consingee_id, 'city');
			if(!empty($mobile_number))
			{
				$mobile_number = $obj->encode_decode("decrypt",$mobile_number);
			}
			if(!empty($identification) && $identification != 'NULL')
			{
				$identification = $obj->encode_decode("decrypt",$identification);
			}
			if($identification =='NULL' )
			{
				$identification = "";
			}
			if(!empty($city) && $city != 'NULL')
			{
				$city = $obj->encode_decode("decrypt",$city);
			}
			echo $mobile_number."$$$".$identification."$$$".$city;	
		}
	}
    if(isset($_REQUEST['get_details_consignee_id'])) {
		$get_details_consignee_id = "";
		$get_details_consignee_id = $_REQUEST['get_details_consignee_id'];

		$name = ""; $address = ""; $city = ""; $mobile_number = ""; $email = ""; $gst_number = ""; $district = ""; $state = ""; $identification ="";
        if(!empty($get_details_consignee_id)) {
            $consignee_list = array(); $consignee_details = "";
            $consignee_list = $obj->getTableRecords($GLOBALS['consignee_table'], 'consignee_id', $get_details_consignee_id);
            if(!empty($consignee_list)) {
				foreach($consignee_list as $data) {
					if(!empty($data['name'])) {
						$name = $obj->encode_decode('decrypt', $data['name']);
					}
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
						$mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
					}
                    if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
						$email = $obj->encode_decode('decrypt', $data['email']);
					}
					if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
						$address = $obj->encode_decode('decrypt', $data['address']);
					}
					if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
						$city = $obj->encode_decode('decrypt', $data['city']);
						if($city == 'Others')
						{
							$city = $data['others_city'];
						}
					}
					if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
						$district = $obj->encode_decode('decrypt', $data['district']);
					}
                    if(!empty($data['state'])) {
						$state = $obj->encode_decode('decrypt', $data['state']);
					}
					if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']) {
						$gst_number = $obj->encode_decode('decrypt', $data['gst_number']);
					}
					if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
						$identification = $obj->encode_decode('decrypt', $data['identification']);
					}
				}
				$consignee_details = array('name' => $name, 'mobile_number' => $mobile_number, 'email' => $email, 'address' => $address, 'city' => $city, 'district' => $district, 'state' => $state, 'gst_number' => $gst_number, 'identification' => $identification);
            }
        }
		if(!empty($consignee_details)) {
			$consignee_details = json_encode($consignee_details);
		}
		echo $consignee_details;
		exit;
	}
    if(isset($_REQUEST['get_details_vehicle_id'])) {
		$get_details_vehicle_id = "";
		$get_details_vehicle_id = $_REQUEST['get_details_vehicle_id'];

		$name = ""; $address = ""; $city = ""; $mobile_number = ""; $vehicle_number = "";
        if(!empty($get_details_vehicle_id)) {
            $vehicle_list = array(); $vehicle_details = "";
            $vehicle_list = $obj->getTableRecords($GLOBALS['vehicle_table'], 'vehicle_id', $get_details_vehicle_id);
            if(!empty($vehicle_list)) {
				foreach($vehicle_list as $data) {
					if(!empty($data['name'])) {
						$name = $obj->encode_decode('decrypt', $data['name']);
					}
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
						$mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
					}
                    if(!empty($data['vehicle_number']) && $data['vehicle_number'] != $GLOBALS['null_value']) {
						$vehicle_number = $obj->encode_decode('decrypt', $data['vehicle_number']);
					}
                    
				}
				$vehicle_details = array('name' => $name, 'mobile_number' => $mobile_number,'vehicle_number' => $vehicle_number);
            }
        }
		if(!empty($vehicle_details)) {
			$vehicle_details = json_encode($vehicle_details);
		}
		echo $vehicle_details;
		exit;
	}
	if(isset($_REQUEST['get_details_unit_id'])) {
		$get_details_unit_id = "";
		$get_details_unit_id = $_REQUEST['get_details_unit_id'];

		$name = ""; $address = ""; $city = ""; $mobile_number = ""; $unit_number = "";
        if(!empty($get_details_unit_id)) {
            $unit_list = array(); $unit_details = "";
            $unit_list = $obj->getTableRecords($GLOBALS['unit_table'], 'unit_id', $get_details_unit_id);
            if(!empty($unit_list)) {
				foreach($unit_list as $data) {
					if(!empty($data['unit_name'])) {
						$name = $obj->encode_decode('decrypt', $data['unit_name']);
					}
                    
                   
				}
				$unit_details = array('name' => $name);
            }
        }
		if(!empty($unit_details)) {
			$unit_details = json_encode($unit_details);
		}
		echo $unit_details;
		exit;
	}
	if(isset($_REQUEST['organization_gst_option'])) {
		$organization_gst_option = "";
		$organaization_gst_option = $_REQUEST['organization_gst_option'];

		$name = ""; $address = ""; $city = ""; $mobile_number = ""; $unit_number = "";
        if(!empty($organaization_gst_option)) {
            $gst_option = 0; $unit_details = "";
            $gst_option = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id',$organaization_gst_option,'organization_gst_option');
			echo $gst_option;
           
        }
		
		exit;
	}
	if(isset($_REQUEST['get_to_branch_list'])) {
		$from_branch_id = trim($_REQUEST['get_to_branch_list']);

		$branch_list = array(); $from_branch_state = "";
		if(!empty($from_branch_id)) {
			$branch_list = $obj->ToBranchList($from_branch_id);
			$from_branch_state = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $from_branch_id, 'state');
		}
		if(!empty($from_branch_state)) {
			$from_branch_state = $obj->encode_decode('decrypt', $from_branch_state);
		}
		?>
		<option value="">Select Branch</option>
		<?php
		if(!empty($branch_list)) {
			foreach($branch_list as $data) {
				if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value']) {
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
		echo "$$$".$from_branch_state;
	}
	if(isset($_REQUEST['get_to_branch_filter'])) {
		$from_branch_id = trim($_REQUEST['get_to_branch_filter']);

		$branch_list = array();
		if(!empty($from_branch_id)) {
			$branch_list = $obj->ToBranchList($from_branch_id);
		}
		else {
			$branch_list = $obj->getTableRecords($GLOBALS['branch_table'], '', '');
		}
		?>
		<option value="">Select Branch</option>
		<?php
		if(!empty($branch_list)) {
			foreach($branch_list as $data) {
				if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value']) {
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
	}
	if(isset($_REQUEST['unit_price_id'])) {
		$unit_id = trim($_REQUEST['unit_price_id']);

		$party_id = "";
		if(isset($_REQUEST['unit_bill_id'])) {
			$party_id = trim($_REQUEST['unit_bill_id']);
		}

		$bill_type = "";
		if(isset($_REQUEST['unit_bill_type'])) {
			$bill_type = trim($_REQUEST['unit_bill_type']);
		}

		$price_value = 0;$cooly_value = 0;
		if(!empty($party_id) && !empty($unit_id)) {
			$price_value = $obj->getPriceValue($party_id, $unit_id);
			$cooly_value = $obj->getCoolyValue($party_id, $unit_id);
		}
		if(!empty($price_value)){
	 		echo $price_value;
		} ?>

		$$$
		<?php 
		if(!empty($cooly_value)){
	 		echo $cooly_value;
		} 
	}
	if(isset($_REQUEST['get_to_branch_report_filter'])) {
		$from_branch_id = trim($_REQUEST['get_to_branch_report_filter']);

		$branch_list = array();
		if(!empty($from_branch_id)) {
			$branch_list = $obj->ToBranchList($from_branch_id);
		}
		else {
			$branch_list = $obj->getTableRecords($GLOBALS['branch_table'], '', '');
		}
		?>
		<option value="">Select Branch</option>
		<?php
		if(!empty($branch_list)) {
			foreach($branch_list as $data) {
				if(!empty($login_branch_id)) {
					if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value'] && in_array($data['branch_id'], $login_branch_id)) {
						?>
						<option value="<?php echo $data['branch_id']; ?>">
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
					?>
					<option value="<?php echo $data['branch_id']; ?>">
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
	}
?>