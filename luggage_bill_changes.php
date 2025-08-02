<?php
    include("include_files.php");
	if(isset($_REQUEST['product_row_index'])) {
        $product_row_index = $_REQUEST['product_row_index'];
		$lr_id = $_REQUEST['lr_id'];

		// $getTable =  $obj->getTableRecords($GLOBALS['lr_table'],'lr_number',$lr_number);

		$lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'lr_id',$lr_id);

		$lr_date="";$lr_number = "";$consignee_id="";$consignor_id="";
		$quantity = "";$unit_id="";$price_per_qty="";$total="";$bill_type="";$weight = "";

		if(!empty($lr_list)){
			foreach($lr_list as $data){
				if(!empty($data['lr_id'])){
                    $lr_id =  $data['lr_id'];
                }

                if(!empty($data['lr_date'])){
                    $lr_date =  $data['lr_date'];
                }
				if(!empty($data['lr_number'])){
                    $lr_number =  $data['lr_number'];
                }
				if(!empty($data['consignor_id'])){
                    $consignor_id =  $data['consignor_id'];
                }
				if(!empty($data['consignee_id'])){
                    $consignee_id =  $data['consignee_id'];
                }
				if(!empty($data['branch_id'])){
					$branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$data['branch_id'],'name');
					if(!empty($branch_name)){
						$branch_name = $obj->encode_decode("decrypt",$branch_name);
					}
				}
				if(!empty($data['quantity'])){
                    $quantity =  $data['quantity'];
                }
				if(!empty($data['weight'])){
					$weight = $data['weight'];
				}
				if(!empty($data['unit_id'])){
                    $unit_id =  $data['unit_id'];
                }
				if(!empty($data['quantity'])){
                    $quantity =  $data['quantity'];
                }
				if(!empty($data['price_per_qty'])){
                    $price_per_qty =  $data['price_per_qty'];
                }
				if(!empty($data['total'])){
                    $total =  $data['total'];
                }
				if(!empty($data['bill_type'])){
                    $bill_type =  $data['bill_type'];
                }
			}
		}
		$check_admin = 0;
		if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['admin_user_type']) {
			if(!empty($GLOBALS['creator'])){
				$check_admin = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $GLOBALS['creator'], 'admin');
			}
		}

		// $stock_query = "SELECT outward_quantity FROM ".$GLOBALS['stock_table']." WHERE lr_id = '".$lr_id."'";
		// $stock_list = $obj->getQueryRecords($GLOBALS['stock_table'], $stock_query);
		// $sum = 0;
		// foreach ($stock_list as $item) {
		// 	$sum += $item['outward_quantity'];
		// }

		$quantity = explode(',',$quantity);
		$weight = explode(',',$weight);
		// $price_per_qty = explode(',',$price_per_qty);
		$unit_id = explode(',',$unit_id);
		// for($i=0;$i<count($unit_id);$i++){
			?>
			<tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
				<td class="text-center sno"><?php if(!empty($product_row_index)) { echo $product_row_index; } ?></td>
				<td class="text-center">
					<?php
					if(!empty($lr_date)){
						echo $lr_date;
					}
					?>
					<input type="hidden" value="<?php echo $lr_id;?>" name="lr_id[]">
				</td>
				<td class="text-center">
					<?php
					if(!empty($lr_number)){
						echo $lr_number;
					}
					?>
				</td>
				<td>
					<?php
					if(!empty($branch_name)){echo $branch_name;} ?>
				</td>
				<td class="text-center">
					<?php
					if(!empty($consignor_id)){
						$consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_id,'name');
						if(!empty($consignor_name)){
							$consignor_name = $obj->encode_decode("decrypt",$consignor_name);
							echo $consignor_name;
						}
					}
					?>
					<input type="hidden" name="consignor_id" value="<?php if(!empty($consignor_id)){ echo $consignee_id; }?>">
				</td>
				<td class="text-center">
					<?php
					if(!empty($consignee_id)){
						$consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_id,'name');
						if(!empty($consignee_name)){
							$consignee_name = $obj->encode_decode("decrypt",$consignee_name);
							echo $consignee_name;
						}
					}
					?>
				</td>
				<td class="text-center">
				<?php if(!empty($quantity)) {

						for($q = 0; $q < count($quantity); $q++) {
							if(!empty($unit_id)){
							
								$unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id[$q],'unit_name');
								$unit_name = $obj->encode_decode("decrypt", $unit_name);
							}
							if(!empty($quantity[$q]) && $quantity[$q] != 0){
							echo $quantity[$q]. " / ".$unit_name."<br>";} ?>
						<?php }
						}
						if(!empty($weight)){
							for($e=0;$e < count($weight);$e++){
								if(!empty($unit_id)){
							
									$unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id[$e],'unit_name');
									$unit_name = $obj->encode_decode("decrypt", $unit_name);
								}
								if(!empty($weight[$e]) && $weight[$e] != 0){
								echo $weight[$e]. " / ".$unit_name."<br>";} ?> 
								<?php
							}
						}

						?>
				</td>
				
				<td class="text-center">
					<input type="hidden" name="price_per_qty[]" class="mx-auto form-control text-center" style="width: 90px !important;" value="<?php if(!empty($price_per_qty)) { echo $price_per_qty; } ?>" onkeyup="Javascript:ProductRowCheck(this);">
					<?php
						if(!empty($price_per_qty)) { echo $price_per_qty; }
					?>
				</td>
				<td class="total_display">
					<?php
					if(!empty($total)){
						echo $total;
					}
					?>
				</td>
				<td>
					<?php
					if(!empty($bill_type)){
						if($bill_type == '1'){
							echo 'To paid';
						}
						else{
							echo 'Paid';
						}
					}
					?>
				</td>
				<td class="text-center">
					<button class="btn btn-danger align-self-center px-3 py-2" type="button" onclick="Javascript:DeleteProductRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
				</td>  
			</tr>
			<?php
		// }      
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

	if(isset($_REQUEST['product_row_index1'])) {
        $product_row_index = $_REQUEST['product_row_index1'];

		$lr_id_check = "";
		$lr_id_check = $_REQUEST['lr_id_check'];
		$lr_id_check = explode(',',$lr_id_check);

		if(!empty($lr_list)){
			$lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'lr_id',$lr_id);
			$lr_date="";$lr_number = "";$consignee_id="";$consignor_id="";
			$quantity = "";$unit_id="";$price_per_qty="";$total="";$bill_type="";
			if(!empty($lr_list)){
				foreach($lr_list as $data){
					if(!empty($data['lr_number'])){
						$lr_number =  $data['lr_number'];
					}
					if(!empty($data['lr_date'])){
						$lr_date =  $data['lr_date'];
					}
					if(!empty($data['lr_number'])){
						$lr_number =  $obj->encode_decode('decrypt',$data['lr_number']);
					}
					if(!empty($data['consignor_id'])){
						$consignor_id =  $data['consignor_id'];
					}
					if(!empty($data['consignee_id'])){
						$consignee_id =  $data['consignee_id'];
					}
					if(!empty($data['quantity'])){
						$quantity =  $data['quantity'];
					}
					if(!empty($data['unit_id'])){
						$unit_id =  $data['unit_id'];
					}
					if(!empty($data['quantity'])){
						$quantity =  $data['quantity'];
					}
					if(!empty($data['price_per_qty'])){
						$price_per_qty =  $data['price_per_qty'];
					}
					if(!empty($data['total'])){
						$total =  $data['total'];
					}
					if(!empty($data['bill_type'])){
						$bill_type =  $data['bill_type'];
					}
				}
			}
			$check_admin = 0;
			if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['admin_user_type']) {
				if(!empty($GLOBALS['creator'])){
					$check_admin = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $GLOBALS['creator'], 'admin');
				}
			} ?>
	
			<tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
				<td class="text-center sno"><?php if(!empty($product_row_index)) { echo $product_row_index; } ?></td>
	
				<td class="text-center">
					<?php
					if(!empty($lr_date)){
						echo $lr_date;
					}
					?>
					<input type="hidden" value="<?php echo $lr_id;?>" name="lr_id[]">
				</td>
				<td class="text-center">
					<?php
					if(!empty($lr_number)){
						echo $lr_number;
					}
					?>
				</td>
				<td class="text-center">
					<?php
					if(!empty($consignor_id)){
						$consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_id,'name');
						if(!empty($consignor_name)){
							$consignor_name = $obj->encode_decode("decrypt",$consignor_name);
							echo $consignor_name;
						}
					}
					?>
				</td>
				<td class="text-center">
					<?php
					if(!empty($consignee_id)){
						$consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_id,'name');
						if(!empty($consignee_name)){
							$consignee_name = $obj->encode_decode("decrypt",$consignee_name);
							echo $consignee_name;
						}
					}
					?>
				</td>
				<td class="text-center">
					<?php
					if(!empty($quantity)){
						echo $quantity;
					}
					?>
				</td>
				<td>
					<?php
					if(!empty($unit_id)){
						$unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id,'unit_name');
						if(!empty($unit_name)){
							$unit_name = $obj->encode_decode("decrypt",$unit_name);
							echo $unit_name;
						}
					}
					?>
				</td>
				<td class="text-center">
					<?php
					if(!empty($price_per_qty)){
						
						echo $price_per_qty;
					}
					?>
				</td>
				<td>
					<?php
					if(!empty($total)){
						echo $total;
					}
					?>
				</td>
				<td>
					<?php
					if(!empty($bill_type)){
						echo $bill_type;
					}
					?>
				</td>
				<td class="text-center">
					<button class="btn btn-danger align-self-center px-3 py-2" type="button" onclick="Javascript:DeleteProductRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
				</td>  
			</tr>
			<?php
		}
		
		$lr_id_check_list = array();
		foreach($lr_id_check as $lr_id){
			$lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'lr_id',$lr_id);

			if(!empty($lr_list)){
				foreach($lr_list as $data){
					if(!empty($data['lr_number'])){
						$lr_number =  $data['lr_number'];
					}
					if(!empty($data['lr_date'])){
						$lr_date =  $data['lr_date'];
					}
					if(!empty($data['lr_number'])){
						$lr_number =  $obj->encode_decode('decrypt',$data['lr_number']);
					}
					if(!empty($data['consignor_id'])){
						$consignor_id =  $data['consignor_id'];
					}
					if(!empty($data['consignee_id'])){
						$consignee_id =  $data['consignee_id'];
					}
					if(!empty($data['quantity'])){
						$quantity =  $data['quantity'];
					}
					if(!empty($data['unit_id'])){
						$unit_id =  $data['unit_id'];
					}
					if(!empty($data['quantity'])){
						$quantity =  $data['quantity'];
					}
					if(!empty($data['price_per_qty'])){
						$price_per_qty =  $data['price_per_qty'];
					}
					if(!empty($data['total'])){
						$total =  $data['total'];
					}
					if(!empty($data['bill_type'])){
						$bill_type =  $data['bill_type'];
					}
				}
			}
			$check_admin = 0;
			if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['admin_user_type']) {
				if(!empty($GLOBALS['creator'])){
					$check_admin = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $GLOBALS['creator'], 'admin');
				}
			} ?>
	
			<tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
				<td class="text-center sno"><?php if(!empty($product_row_index)) { echo $product_row_index; } ?></td>
	
				<td class="text-center">
					<?php
					if(!empty($lr_date)){
						echo $lr_date;
					}
					?>
					<input type="hidden" value="<?php echo $lr_id;?>" name="lr_id[]">
				</td>
				<td class="text-center">
					<?php
					if(!empty($lr_number)){
						echo $lr_number;
					}
					?>
				</td>
				<td class="text-center">
					<?php
					if(!empty($consignor_id)){
						$consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_id,'name');
						if(!empty($consignor_name)){
							$consignor_name = $obj->encode_decode("decrypt",$consignor_name);
							echo $consignor_name;
						}
					}
					?>
				</td>
				<td class="text-center">
					<?php
					if(!empty($consignee_id)){
						$consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_id,'name');
						if(!empty($consignee_name)){
							$consignee_name = $obj->encode_decode("decrypt",$consignee_name);
							echo $consignee_name;
						}
					}
					?>
				</td>
				<td class="text-center">
					<?php
					if(!empty($quantity)){
						
						echo $quantity;
					}
					?>
				</td>
				<td>
					<?php
					if(!empty($unit_id)){
						$unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id,'unit_name');
						if(!empty($unit_name)){
							$unit_name = $obj->encode_decode("decrypt",$unit_name);
							echo $unit_name;
						}
					}
					?>
				</td>
				<td class="text-center">
					<?php
					if(!empty($price_per_qty)){
						
						echo $price_per_qty;
					}
					?>
				</td>
				<td>
					<?php
					if(!empty($total)){
						echo $total;
					}
					?>
				</td>
				<td>
					<?php
					if(!empty($bill_type)){
						echo $bill_type;
					}
					?>
				</td>
				<td class="text-center">
					<button class="btn btn-danger align-self-center px-3 py-2" type="button" onclick="Javascript:DeleteProductRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
				</td>  
			</tr>
			<?php
		}

    }

	if(isset($_REQUEST['get_details_lr'])) {
		$lr_state = "";
		$lr_state = $_REQUEST['get_details_lr'];
		$organization_id = $_REQUEST['selected_organization_id'];
		$lr_state = $obj->encode_decode('encrypt',$lr_state);
		
		$luggage_date = "";
		$luggage_date = $_REQUEST['date'];

		$godown_id = "";
		$godown_id = $_REQUEST['godown_id'];
		
        if(!empty($lr_state)) {
			$lr_list = array();

			if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['admin_user_type']){
				$sql = "SELECT lr_id,lr_number FROM ".$GLOBALS['lr_table']." WHERE lr_date = '".$luggage_date."' AND godown_id = 0 AND deleted = '0' AND lr_state = '".$lr_state."' AND is_cleared = '0' AND organization_id = '".$organization_id."' ";
				$lr_list = $obj->getQueryRecords('', $sql);
            }else if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['godown_staff_user_type']){
				$sql = "SELECT lr_id,lr_number FROM ".$GLOBALS['lr_table']." WHERE lr_date = '".$luggage_date."' AND godown_id = '".$godown_id."' AND deleted = '0' AND lr_state = '".$lr_state."' AND is_cleared = '0' AND organization_id = '".$organization_id."'";
				$lr_list = $obj->getQueryRecords('', $sql);
			}
			
			?>
			<select name="selected_lr_id" class="form-control">
				<option value="">Select</option>
			<?php
			foreach($lr_list as $data){
				// foreach($lr_number as $data){
					?>
					<option value="<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>">
						<?php
							if(!empty($data['lr_number'])) {
								// $data = $obj->encode_decode('decrypt', $data);
								echo $data['lr_number'];
							}
						?>
					</option>
					<?php
				// }
			}
			?>
			</select>
			<div class="input-group-append">
				<button class="btn btn-danger" type="button"  onClick="Javascript:addDetails();"><i class="fa fa-plus"></i></button>
			</div>
			<?php
        }
	}

	if(isset($_REQUEST['get_details_lr_list'])){
		$luggage_id = "";
        $luggage_id = $_REQUEST['get_details_lr_list'];
        
		$lr_list = array();
		$lr_list = $obj->getTableColumnValue($GLOBALS['luggagesheet_table'],'luggage_id',$luggage_id,'lr_id');
		$lr_list = explode(',',$lr_list);
		$is_cleared = 0;
		?>
		<div class="dropdown">
			<button class="btn btn-light w-100 dropdown-toggle" style="background-color: #fff; padding: 5px 10px 10px 30px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Select LR
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		    	<div class="dropdown-item">
				<?php
				if(!empty($lr_list)){
					foreach($lr_list as $lr_id){
						$is_cleared = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_id,'is_cleared');
						if($is_cleared == '0'){
						?>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="lr_id_check[]" value="<?php if(!empty($lr_id)) { echo $lr_id; }?>" id="defaultCheck1">
							<label class="form-check-label smallfnt fw-400 checkbox" for="defaultCheck1">
								<?php
								if(!empty($lr_id)) {
									$lr_number = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_id,'lr_number');
									$lr_number = $obj->encode_decode('decrypt', $lr_number);
									echo $lr_number;
								}
								?>
							</label>
							</label>
						</div>
						<?php
						}
					}
					?>
				</div>
			</div>
			</div>
			<div class="input-group-append">
				<button class="btn btn-danger" type="button"  onClick="Javascript:addDetails1();"><i class="fa fa-plus"></i></button>
            </div>
			<?php
        }
	}
	if(isset($_REQUEST['organization_id']))
	{
		$organization_id = $_REQUEST['organization_id'];
		$luggagesheet_list = array();
        $luggagesheet_list = "SELECT * FROM ".$GLOBALS['luggagesheet_table']." WHERE deleted = 0 AND is_cleared = 0 AND organization_id='".$organization_id."' ";
        $luggagesheet_list = $obj->getQueryRecords('',$luggagesheet_list);
		?>
		<select name="luggage_id" class="form-control">
				<option value="">Select</option>
			<?php
			foreach($luggagesheet_list as $data){
				?>
				<option value="<?php if(!empty($data['luggage_id'])) { echo $data['luggage_id']; } ?>">
					<?php
						if(!empty($data['luggagesheet_number'])) {
							echo $data['luggagesheet_number'];
						}
					?>
				</option>
				<?php
			}
			?>
		</select>
		<div class="input-group-append">
			<button class="btn btn-danger" type="button"  onClick="Javascript:addDetailsLuggage();"><i class="fa fa-plus"></i></button>
		</div>
		$$$
		<?php
		$lr_list = array(); $select_query ="";
        $select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE godown_id = 0 AND is_luggage_entry = 0 AND deleted = 0 AND is_cleared = 0 AND organization_id ='".$organization_id."'";
		$lr_list = $obj->getQueryRecords('',$select_query);
		?>
		<select name="selected_lr_id" class="form-control">
				<option value="">Select</option>
			<?php
			foreach($lr_list as $data){
				?>
				<option value="<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>">
					<?php
						if(!empty($data['lr_number'])) {
							echo $data['lr_number'];
						}
					?>
				</option>
				<?php
			}
			?>
		</select>
		<div class="input-group-append">
			<button class="btn btn-danger" type="button"  onClick="Javascript:addDetailsLR();"><i class="fa fa-plus"></i></button>
		</div>
		$$$
		<script type="text/javascript">                
			jQuery(document).ready(function(){
				print_state('<?php if(!empty($consignee_state)) { echo $consignee_state; } ?>');
				jQuery('select[name="state"]').select2();
				print_state('<?php if(!empty($state)) { echo $state; } ?>');
				
				jQuery('.add_update_form_content').find('select').select2();
			});
		</script>
		<?php
	}

	if(isset($_REQUEST['product_row_index2'])) {
        $product_row_index = $_REQUEST['product_row_index2'];
		$luggage_id = $_REQUEST['luggage_id'];

		$get_lr_from_luggage = $obj->getTableColumnValue($GLOBALS['luggagesheet_table'],'luggage_id',$luggage_id,'lr_id');
		$get_lr_from_luggage = explode(',',$get_lr_from_luggage);
		if(!empty($get_lr_from_luggage)){
			foreach($get_lr_from_luggage as $lr_id){
				$lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'lr_id',$lr_id);
				$lr_date="";$lr_number = "";$consignee_id="";$consignor_id=""; $is_tripsheet_entry =0;
				$quantity = "";$unit_id="";$price_per_qty="";$total="";$bill_type="";$branch_name = "";
				if(!empty($lr_list)){
					foreach($lr_list as $data){
						if(!empty($data['lr_id'])){
							$lr_id =  $data['lr_id'];
						}
						if(!empty($data['lr_date'])){
							$lr_date =  $data['lr_date'];
						}
						if(!empty($data['lr_number'])){
							$lr_number =  $data['lr_number'];
						}
						if(!empty($data['consignor_id'])){
							$consignor_id =  $data['consignor_id'];
						}
						if(!empty($data['consignee_id'])){
							$consignee_id =  $data['consignee_id'];
						}
						if(!empty($data['branch_id'])){
							$branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$data['branch_id'],'name');
							if(!empty($branch_name)){
								$branch_name = $obj->encode_decode("decrypt",$branch_name);
							}
						}
						if(!empty($data['quantity'])){
							$quantity =  $data['quantity'];
						}
						if(!empty($data['unit_id'])){
							$unit_id =  $data['unit_id'];
						}
						if(!empty($data['quantity'])){
							$quantity =  $data['quantity'];
						}
						if(!empty($data['price_per_qty'])){
							$price_per_qty =  $data['price_per_qty'];
						}
						if(!empty($data['total'])){
							$total =  $data['total'];
						}
						if(!empty($data['bill_type'])){
							$bill_type =  $data['bill_type'];
						}
						if(!empty($data['is_tripsheet_entry']))
						{
							$is_tripsheet_entry = $data['is_tripsheet_entry'];
						}
					}
				}
				$check_admin = 0;
				if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['admin_user_type']) {
					if(!empty($GLOBALS['creator'])){
						$check_admin = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $GLOBALS['creator'], 'admin');
					}
				}
		
				// $stock_query = "SELECT outward_quantity FROM ".$GLOBALS['stock_table']." WHERE lr_id = '".$lr_id."'";
				// $stock_list = $obj->getQueryRecords($GLOBALS['stock_table'], $stock_query);
				// $sum = 0;
				// foreach ($stock_list as $item) {
				// 	$sum += $item['outward_quantity'];
				// }
		
				$quantity = explode(',',$quantity);
				// $price_per_qty = explode(',',$price_per_qty);
				$unit_id = explode(',',$unit_id);
				if($is_tripsheet_entry == '0'){
					?>
					<tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
						<td class="text-center sno">
							<?php if(!empty($product_row_index)) { echo $product_row_index; }?>
							<input type="hidden" name="luggage_clearance_id[]" value="<?php if(!empty($luggage_id)) { echo $luggage_id; } ?>">
						</td>
						<td class="text-center">
							<?php
								if(!empty($lr_date)){
									echo date('d-m-Y',strtotime($lr_date));
								}
							?>
							<input type="hidden" name="lr_date[]" value="<?php if(!empty($lr_date)) { echo $lr_date; } ?>">
							<input type="hidden" value="<?php echo $lr_id;?>" name="lr_id[]">
						</td>
						<td class="text-center">
							<?php
							if(!empty($lr_number)){
								echo $lr_number;
							}
							?>
							<input type="hidden" name="lr_number[]" value="<?php if(!empty($lr_number)) { echo $lr_number; } ?>">
						</td>
						<td class="text-center">
							<?php
								if(!empty($branch_name)){
									echo $branch_name;
								}
							?>
						</td>
						<td class="text-center">
							<?php
							if(!empty($consignor_id)){
								$consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_id,'name');
								if(!empty($consignor_name)){
									$consignor_name = $obj->encode_decode("decrypt",$consignor_name);
									echo $consignor_name;
								}
							}
							?>
							<input type="hidden" name="consignor_id" value="<?php if(!empty($consignor_id)){ echo $consignee_id; }?>">
						</td>
						<td class="text-center">
							<?php
							if(!empty($consignee_id)){
								$consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_id,'name');
								if(!empty($consignee_name)){
									$consignee_name = $obj->encode_decode("decrypt",$consignee_name);
									echo $consignee_name;
								}
							}
							?>
							<input type="hidden" name="consignee_id[]" value="<?php if(!empty($consignee_id)) { echo $consignee_id; } ?>">
						</td>
						<td class="text-center">
						<?php if(!empty($quantity)) 

								for($q = 0; $q < count($quantity); $q++) {
									if(!empty($unit_id)){
									
										$unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id[$q],'unit_name');
										$unit_name = $obj->encode_decode("decrypt", $unit_name);
									}

									echo $quantity[$q]. " / ".$unit_name; ?> <br>
								<?php }

								?>
						</td>
						<!-- <td>
							<?php
							if(!empty($unit_id[$i])){
								$unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id[$i],'unit_name');
								if(!empty($unit_name)){
									$unit_name = $obj->encode_decode("decrypt",$unit_name);
									echo $unit_name;
								}
							}
							?>
							<input type="hidden" name="unit_id[]" class="mx-auto form-control text-center" style="width: 90px !important;" value="<?php if(!empty($unit_id[$i])) { echo $unit_id[$i]; } ?>">
						</td> -->
						<td class="text-center">
							<input type="hidden" name="price_per_qty[]" class="mx-auto form-control text-center" style="width: 90px !important;" value="<?php if(!empty($price_per_qty)) { echo $price_per_qty; } ?>" onkeyup="Javascript:ProductRowCheck(this);">
							<?php
								if(!empty($price_per_qty)) { echo $price_per_qty; }
							?>
						</td>
						<td class="total_display">
							<?php
							if(!empty($total)){
								echo $total;
							}
							?>
							<input type="hidden" name="total[]" value="<?php if(!empty($total)) { echo $total; } ?>">
						</td>
						<td>
							<?php
							if(!empty($bill_type)){
								if($bill_type == '1'){
									echo 'To paid';
								}
								else{
									echo 'Paid';
								}
							}
							?>
							<input type="hidden" name="bill_type[]" value="<?php if(!empty($bill_type)) { echo $bill_type; } ?>">
						</td>
						<td class="text-center">
							<button class="btn btn-danger align-self-center px-3 py-2" type="button" onclick="Javascript:DeleteProductRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
						</td>  
					</tr>
					<?php
					$product_row_index++;
				}      
			} ?>		
			<script type="text/javascript">
				updateproductcount('<?php echo $product_row_index-1; ?>');
			</script> <?php
		}
    }

	if(isset($_REQUEST['product_row_index3'])) {
        $product_row_index = trim($_REQUEST['product_row_index3']);
		$lr_id = "";
		if(isset($_REQUEST['lr_id'])) {
			$lr_id = trim($_REQUEST['lr_id']);
		}
		$lr_list = array();
		$lr_list = $obj->getTableRecords($GLOBALS['lr_table'], 'lr_id', $lr_id);
		
		$lr_date = ""; $lr_number = ""; $from_branch_id = ""; $from_branch_name = ""; $to_branch_id = ""; $to_branch_name = "";
		$account_party_id = ""; $consignee_id = ""; $consignor_id = "";
		$quantity = array(); $unit_id = array(); $price_per_qty = ""; $total = 0; $bill_type = ""; $weight = array();
		if(!empty($lr_list)){
			foreach($lr_list as $data){
				if(!empty($data['lr_date']) && $data['lr_date'] != "0000-00-00"){
					$lr_date = date('d-m-Y', strtotime($data['lr_date']));
				}
				if(!empty($data['lr_number']) && $data['lr_number'] != $GLOBALS['null_value']){
					$lr_number = $data['lr_number'];
				}
				if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) {
					$from_branch_id = $data['from_branch_id'];
				}
				if(!empty($data['to_branch_id']) && $data['to_branch_id'] != $GLOBALS['null_value']) {
					$to_branch_id = $data['to_branch_id'];
				}
				if(!empty($data['consignor_id']) && $data['consignor_id'] != $GLOBALS['null_value']){
					$consignor_id = $data['consignor_id'];
				}
				if(!empty($data['consignee_id']) && $data['consignee_id'] != $GLOBALS['null_value']){
					$consignee_id = $data['consignee_id'];
				}
				if(!empty($data['account_party_id']) && $data['account_party_id'] != $GLOBALS['null_value']){
					$account_party_id = $data['account_party_id'];
				}
				if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']){
					$quantity = explode(',', $data['quantity']);
				}
				if(!empty($data['weight']) && $data['weight'] != $GLOBALS['null_value']){
					$weight = explode(',', $data['weight']);
				}
				if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']){
					$unit_id = explode(',', $data['unit_id']);
				}
				if(!empty($data['price_per_qty']) && $data['price_per_qty'] != $GLOBALS['null_value']){
					$price_per_qty = $data['price_per_qty'];
				}
				if(!empty($data['total']) && $data['total'] != $GLOBALS['null_value']){
					$total = $data['total'];
				}
				if(!empty($data['bill_type']) && $data['bill_type'] != $GLOBALS['null_value']){
					$bill_type = $data['bill_type'];
				}
			}
		}
		?>
		<tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
			<th class="text-center px-2 py-2 sno"><?php if(!empty($product_row_index)) { echo $product_row_index; } ?></th>
			<th class="text-center px-2 py-2">
				<?php
					if(!empty($lr_date)){
						echo date('d-m-Y', strtotime($lr_date));
					}
				?>
				<input type="hidden" name="lr_id[]" value="<?php echo $lr_id;?>">
			</th>
			<th class="text-center px-2 py-2">
				<?php
					if(!empty($lr_number)) {
						echo $lr_number;
					}
				?>
				  <input type="hidden" name="lr_number[]" value="<?php if(!empty($lr_number)) { echo $lr_number;  } ?>">
			</th>
			<th class="text-center px-2 py-2">
				<?php
					if(!empty($from_branch_id)) {
						$from_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $from_branch_id, 'name');
						if(!empty($from_branch_name) && $from_branch_name != $GLOBALS['null_value']) {
							echo $obj->encode_decode('decrypt', $from_branch_name);
						}
					}
				?>
			</th>
			<th class="text-center px-2 py-2">
				<?php
					if(!empty($to_branch_id)) {
						$to_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $to_branch_id, 'name');
						if(!empty($to_branch_name) && $to_branch_name != $GLOBALS['null_value']) {
							echo $obj->encode_decode('decrypt', $to_branch_name);
						}
					}
				?>
				    <input type="hidden" name="prev_to_branch_ids[]" value="<?php if(!empty($to_branch_id)) { echo $to_branch_id; } ?>">
			</th>
			<th class="text-center px-2 py-2">
				<?php
					if(!empty($consignor_id)) {
						$consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_id, 'name');
						if(!empty($consignor_name) && $consignor_name != $GLOBALS['null_value']) {
							echo $obj->encode_decode("decrypt", $consignor_name);
						}
					}
				?>
			</th>
			<th class="text-center px-2 py-2">
				<?php
					if(!empty($consignee_id)) {
						$consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_id, 'name');
						if(!empty($consignee_name) && $consignee_name != $GLOBALS['null_value']) {
							echo $obj->encode_decode("decrypt", $consignee_name);
						}
					}
					if(empty($consignee_id) && !empty($account_party_id)) {
						$account_party_name = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'account_party_id', $account_party_id, 'name');
						if(!empty($account_party_name) && $account_party_name != $GLOBALS['null_value']) {
							echo $obj->encode_decode("decrypt", $account_party_name);
						}
						echo $account_party_name."(Acc.Party)";
					}
				?>
			</th>
			<th class="text-center px-2 py-2">
				<?php 
					if(!empty($quantity)) {
						for($q = 0; $q < count($quantity); $q++) {
							$unit_name = "";
							if(!empty($unit_id[$q])) {
								$unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id[$q], 'unit_name');
								$unit_name = $obj->encode_decode("decrypt", $unit_name);
							}
							if($quantity[$q] >= 0 && !empty($quantity[$q])) {
								echo $quantity[$q]. " / ".$unit_name."<br>";
							} 
						}
					}
					if(!empty($weight)) {
						for($e = 0; $e < count($weight); $e++) {
							$unit_name = "";
							if(!empty($unit_id[$e])) {
								$unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id[$e], 'unit_name');
								$unit_name = $obj->encode_decode("decrypt", $unit_name);
							}
							if($weight[$e] >= 0 && !empty($weight[$e])) {
								echo $weight[$e]. " / ".$unit_name."<br>";
							}
						}
					}
				?>
			</th>
			<th class="text-center px-2 py-2">
				<?php
					if(!empty($price_per_qty)) { echo $price_per_qty; }
				?>
			</th>
			<th class="total_display text-center px-2 py-2">
				<?php
					echo $total;
				?>
			</th>
			<th class="text-center px-2 py-2">
				<?php
					if(!empty($bill_type)) {
						echo $bill_type;
					}
				?>
			</th>
			<th class="text-center px-2 py-2">
				<button class="btn btn-danger align-self-center px-3 py-2" type="button" onclick="Javascript:DeleteProductRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
			</th>  
		</tr>
		<?php
    }
	if(isset($_REQUEST['get_branch_lr']))
	{
		$get_branch_lr = $_REQUEST['get_branch_lr'];

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

		if(!empty($get_branch_lr))
		{
			if(strpos($get_branch_lr,",") != false){
				$get_branch_lr = explode(",",$get_branch_lr);
				$get_branch_list = array();
				for($m = 0;$m < count($get_branch_lr);$m++){
					if(!empty($from_date) && !empty($to_date)) {
						$get_branches = array();
						$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE branch_id = '".$get_branch_lr[$m]."' AND DATE(lr_date) >= '".$from_date."' 
										AND DATE(lr_date) <= '".$to_date."' AND is_cleared = '0' AND is_luggage_entry = '0' AND is_tripsheet_entry = '0' 
										AND cancelled = '0' ";
						$get_branches = $obj->getQueryRecords($GLOBALS['lr_table'],$select_query);
					}
					if(!empty($get_branches)){
						$get_branch_list = array_merge($get_branch_list,$get_branches);
					}
				}
			}
			else{
				if(!empty($from_date) && !empty($to_date)) {
					$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE branch_id = '".$get_branch_lr."' AND DATE(lr_date) >= '".$from_date."' 
										AND DATE(lr_date) <= '".$to_date."' AND is_cleared = '0' AND is_luggage_entry = '0' AND is_tripsheet_entry = '0' 
										AND cancelled = '0' ";
					$get_branch_list = $obj->getQueryRecords($GLOBALS['lr_table'],$select_query);
				}
			}
		}
?>
		<select class="form-control" name="selected_lr_id">
			<option value="">Select LR</option>
				<?php
					if(!empty($get_branch_list)) {
						foreach($get_branch_list as $data) { ?>
							<option value="<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>" <?php if(!empty($lr_id)){ if($data['lr_id'] == $lr_id ){ echo "selected"; } } ?>>
								<?php
									$branch_name = "";
									if(!empty($data['lr_number'])) {
										echo $data['lr_number'];
										if(!empty($data['branch_id'])){
											$branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$data['branch_id'],'name');
											if(!empty($branch_name)){
												$branch_name = $obj->encode_decode('decrypt',$branch_name);
												echo " - ".$branch_name;
											}
										}
									}
								?>
							</option>
							<?php
						}
					}
				?>
		</select>
		<div class="input-group-append">
			<button class="btn btn-danger" type="button"  onClick="Javascript:addDetailsLR();"><i class="fa fa-plus"></i> Add</button>
		</div>$$$
		<?php 
			$get_branch_lr = $_REQUEST['get_branch_lr'];
			if(!empty($get_branch_lr))
			{
				if(strpos($get_branch_lr,",") != false){
					$get_branch_lr = explode(",",$get_branch_lr);
					$get_branch_luggage_list = array();
					for($m = 0;$m < count($get_branch_lr);$m++){
						$get_branches_luggage = array();
						if(!empty($from_date) && !empty($to_date)) {
							$select_query = "SELECT l.*, lc.luggagesheet_number, lc.luggage_id FROM ".$GLOBALS['lr_table']." as l
											INNER JOIN ".$GLOBALS['luggagesheet_table']." as lc ON lc.luggagesheet_number = l.luggagesheet_number
											WHERE l.branch_id = '".$get_branch_lr[$m]."' AND DATE(l.lr_date) >= '".$from_date."' AND DATE(l.lr_date) <= '".$to_date."' 
											AND l.luggagesheet_number != '".$GLOBALS['null_value']."' AND l.is_cleared = '0' AND l.is_tripsheet_entry = '0' 
											AND l.cancelled = '0' GROUP BY l.luggagesheet_number";
							$get_branches_luggage = $obj->getQueryRecords($GLOBALS['luggagesheet_table'],$select_query);
						}
						$get_branch_luggage_list = array_merge($get_branch_luggage_list,$get_branches_luggage);
					}
				}
				else{
					if(!empty($from_date) && !empty($to_date)) {
						$select_query = "SELECT l.*, lc.luggagesheet_number, lc.luggage_id FROM ".$GLOBALS['lr_table']." as l
											INNER JOIN ".$GLOBALS['luggagesheet_table']." as lc ON lc.luggagesheet_number = l.luggagesheet_number
											WHERE l.branch_id = '".$get_branch_lr."' AND DATE(l.lr_date) >= '".$from_date."' AND DATE(l.lr_date) <= '".$to_date."' 
											AND l.luggagesheet_number != '".$GLOBALS['null_value']."' AND l.is_cleared = '0' AND l.is_tripsheet_entry = '0' 
											AND l.cancelled = '0' GROUP BY l.luggagesheet_number";
						$get_branch_luggage_list = $obj->getQueryRecords($GLOBALS['lr_table'],$select_query);
					}
				}
			}?>
			<select class="form-control" name="luggage_id">
				<option value="">Luggagesheet No</option>
					<?php
						if(!empty($get_branch_luggage_list)) {
							foreach($get_branch_luggage_list as $data) { ?>
								<option value="<?php if(!empty($data['luggage_id'])) { echo $data['luggage_id']; } ?>">
									<?php
										if(!empty($data['luggagesheet_number'])) {
											echo $data['luggagesheet_number'];
										}
									?>
								</option>
								<?php
							}
						}
					?>
			</select>
			<div class="input-group-append">
				<button class="btn btn-danger" type="button"  onClick="Javascript:addDetailsLuggage();"><i class="fa fa-plus"></i> Add</button>
			</div>
		<?php 
	}

	if(isset($_REQUEST['get_luggage_branch_lr']))
	{
		$get_branch_lr = $_REQUEST['get_luggage_branch_lr'];
		$get_branch_list = ""; 
		if(!empty($get_branch_lr))
		{
			$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE branch_id = '".$get_branch_lr."' AND is_cleared = '0' AND is_tripsheet_entry = '0' AND is_luggage_entry = '0' AND cancelled = '0' AND godown_id !='' ";
			$get_branch_list = $obj->getQueryRecords($GLOBALS['lr_table'],$select_query);
		}

		?>
		<select class="form-control" name="selected_lr_id" >
			<option value="">Select LR</option>
				<?php
					if(!empty($get_branch_list)) {
						foreach($get_branch_list as $data) { ?>
							<option value="<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>" <?php if(!empty($lr_id)){ if($data['lr_id'] == $lr_id ){ echo "selected"; } } ?>>
								<?php
									if(!empty($data['lr_number'])) {
										echo $data['lr_number'];
									}
								?>
							</option>
							<?php
						}
					}
				?>
		</select>
		<div class="input-group-append">
			<button class="btn btn-danger" type="button"  onClick="Javascript:addDetailsLR();"><i class="fa fa-plus"></i> Add</button>
		</div>
			<?php

	}
	if(isset($_REQUEST['get_driver_no'])){
		$get_driver_no = $_REQUEST['get_driver_no'];
		$driver_number = "";
		$driver_number = $obj->getTableColumnValue($GLOBALS['driver_table'],'driver_name',$get_driver_no,'driver_number');
		if(!empty($driver_number)){
			$driver_number = $obj->encode_decode('decrypt',$driver_number);
		}
		echo $driver_number;
	}


	
	if(isset($_REQUEST['change_lr_id'])) {
		$lr_ids = $_REQUEST['change_lr_id'];

		$lr_ids = explode(",", $lr_ids);
		$product_list = array(); $list = array();
		$from_branch_id = "";
 		$from_branch_id = trim($_REQUEST['from_branch_id']);

        $to_branch_ids = array();
        if(isset($_REQUEST['to_branch_id'])) {
            $to_branch_ids = trim($_REQUEST['to_branch_id']);
        }

        $lr_list = array();
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
        if(!empty($from_branch_id)) {
            $lr_list = $obj->GetLRListByBranch($from_date, $to_date, $from_branch_id, $to_branch_ids);
        }

		if(!empty($lr_list)) {
			foreach($lr_list as $data) {
				if(!empty($data['lr_id']) && $data['lr_id'] != $GLOBALS['null_value']) {
					if(!in_array($data['lr_id'],$lr_ids)) {
						$list[] = $data;
					}
				}
			}
		}
		?>
		<option value="">Select</option>
		<?php
		if(!empty($list)) {
			foreach($list as $data) {
				if(!empty($data['lr_id']) && $data['lr_id'] != $GLOBALS['null_value']) {
					?>
					<option value="<?php echo $data['lr_id']; ?>">
					 	<?php
                            if(!empty($data['lr_number']) && $data['lr_number'] != $GLOBALS['null_value']) {
                                echo $data['lr_number'];
                            }
                        ?>
					</option>
				<?php
				}
			}
		}
	}
	if(isset($_REQUEST['removed_to_branch_ids'])) {
		$to_branch_ids = array(); $list = array(); $removed_branches = ""; $removed_list = array();
		$to_branch_ids = trim($_REQUEST['removed_to_branch_ids']);
		$to_branch_ids = explode(',',$to_branch_ids);
		// print_r($to_branch_ids);

		$prev_to_branch_ids = array();
		$prev_to_branch_ids = trim($_REQUEST['prev_to_branch_ids']);
		$prev_to_branch_ids = explode(',',$prev_to_branch_ids);
		// print_r($prev_to_branch_ids);

// $list = array_diff($prev_to_branch_ids, $to_branch_ids);
// $removed_branches = implode(',', $list);
		if(!empty($prev_to_branch_ids)){
			for($i=0; $i<count($prev_to_branch_ids); $i++){
				if (!in_array($prev_to_branch_ids[$i], $to_branch_ids)) {
					// echo "fj";
					$list[] = $prev_to_branch_ids[$i];
				}
			}
		}
		if(!empty($list)){
			$removed_list = array_unique($list);
			$removed_branches = implode(',',$removed_list);
		}
		// print_r($list);
		echo $removed_branches;

	}
?>