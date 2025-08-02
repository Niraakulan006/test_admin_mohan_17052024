<?php
	include("include_files.php");
	$login_staff_id = "";
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
			$login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			$permission_module = $GLOBALS['vehicle_module'];
		}
	}
	
	if(isset($_REQUEST['show_vehicle_id'])) { 
        $show_vehicle_id = $_REQUEST['show_vehicle_id'];

         $current_date = date("Y-m-d"); 

        $name = ""; $username = ""; $password = ""; $mobile_number = ""; $type =''; $insurance_date = '';
         $insurance_date = date("Y-m-d"); 
         $fitness_date = date("Y-m-d"); 
         $np_tax_date = date("Y-m-d"); 
         $road_tax_date = date("Y-m-d"); 
         $permit_date = date("Y-m-d"); 
         $pollution_date = date("Y-m-d"); 


        if(!empty($show_vehicle_id)) {
            $vehicle_list = array();
			$vehicle_list = $obj->getTableRecords($GLOBALS['vehicle_table'], 'vehicle_id', $show_vehicle_id);
            if(!empty($vehicle_list)) {
                foreach($vehicle_list as $data) {
                    if(!empty($data['name'])) {
                        $name = $obj->encode_decode('decrypt', $data['name']);
						// $name = strtoupper($name);
					}
					if(!empty($data['vehicle_number'])) {
                        $vehicle_number = $obj->encode_decode('decrypt', $data['vehicle_number']);
						
					}
					if(!empty($data['mobile_number'])) {
                        $mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
					}
					if(!empty($data['vehicle_type'])) {
                        $type = $data['vehicle_type'];
					}
					if(!empty($data['insurance_date'])) {
                        $insurance_date = date('Y-m-d', strtotime($data['insurance_date']));
					}
					if(!empty($data['road_tax_date'])) {
                        $road_tax_date = date('Y-m-d', strtotime($data['road_tax_date']));
					}
					if(!empty($data['fitness_date'])) {
                        $fitness_date = date('Y-m-d', strtotime($data['fitness_date']));
					}
					if(!empty($data['pollution_date'])) {
                        $pollution_date = date('Y-m-d', strtotime($data['pollution_date']));
					}
					if(!empty($data['np_tax_date'])) {
                        $np_tax_date = date('Y-m-d', strtotime($data['np_tax_date']));
					}
					if(!empty($data['permit_date'])) {
                        $permit_date = date('Y-m-d', strtotime($data['permit_date']));
					}
                }
            }
		} ?>
        <form class="poppins pd-20" name="vehicle_form" method="POST">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
						<h5 class="text-white">Edit Vehicle</h5>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('vehicle.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
			<div class="row p-3">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_vehicle_id)) { echo $show_vehicle_id; } ?>">
				<div class="col-lg-4 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="name" name="name" class="form-control shadow-none" value="<?php if(!empty($name)){ echo $name; }?>" placeholder="Vehicle Name" required>
                            <label>Vehicle Name(*)</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="vehicle_number" name="vehicle_number" value="<?php if(!empty($vehicle_number)){ echo $vehicle_number; }?>" class="form-control shadow-none" placeholder="Vehicle Number" required>
                            <label>Vehicle Number(*)</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="contact_number" name="contact_number" value="<?php if(!empty($mobile_number)) { echo $mobile_number; }?>" class="form-control shadow-none" placeholder="Contact Number" required>
                            <label>Contact Number(*)</label>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
							<select name="type" class="select2 select2-danger smallfnt form-control" style="width:100% !important;">
								<option value="">Select Type</option>
								<option value="1" <?php if(!empty($type) && $type == '1') { echo "selected"; } ?>>Own Vehicle</option>
								<option value="2" <?php if(!empty($type) && $type == '2') { echo "selected"; } ?>>Rent Vehicle</option>
							</select>
                            <label>Type</label>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
							<input type="date" class="form-control shadow-none" name="insurance_date" value="<?php if(!empty($insurance_date)) { echo $insurance_date; } ?>"  min="<?php if(!empty($current_date)) { echo $current_date; } ?>" >

                            <label>Insurance Expiry Date</label>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
							<input type="date" class="form-control shadow-none" name="permit_date" value="<?php if(!empty($permit_date)) { echo $permit_date; } ?>"  min="<?php if(!empty($current_date)) { echo $current_date; } ?>">

                            <label>Permit Date</label>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
							<input type="date" class="form-control shadow-none" name="fitness_date" value="<?php if(!empty($fitness_date)) { echo $fitness_date; } ?>"  min="<?php if(!empty($current_date)) { echo $current_date; } ?>" >

                            <label>Fitness Date</label>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
							<input type="date" class="form-control shadow-none" name="pollution_date" value="<?php if(!empty($pollution_date)) { echo $pollution_date; } ?>"  min="<?php if(!empty($current_date)) { echo $current_date; } ?>" >

                            <label>PUCC (Polution) Date</label>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
							<input type="date" class="form-control shadow-none" name="np_tax_date" value="<?php if(!empty($np_tax_date)) { echo $np_tax_date; } ?>"  min="<?php if(!empty($current_date)) { echo $current_date; } ?>" >

                            <label> N/P Tax Date</label>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
							<input type="date" class="form-control shadow-none" name="road_tax_date" value="<?php if(!empty($road_tax_date)) { echo $road_tax_date; } ?>"  min="<?php if(!empty($current_date)) { echo $current_date; } ?>" >

                            <label> Road Tax Date</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent('vehicle_form', 'vehicle_changes.php', 'vehicle.php');">
                        Submit
                    </button>
                </div>
			</div>
            <script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('form[name="vehicle_form"]').find('select').select2();
				});   
			</script>
        </form>
		<?php
    } 
    if(isset($_POST['name'])) {	
		$name = ""; $name_error = "";  $username = ""; $username_error = "";
		$password = ""; $password_error = "";
		$valid_vehicle = ""; $form_name = "vehicle_form"; $access_pages = ""; $access_pages_error = ""; $mobile_number = ""; $mobile_number_error = ""; $permit_date = ""; $permit_date_error = ""; $road_tax_date_error = ""; $road_tax_date = "";
	
		$np_tax_date = ""; $np_tax_date_error = ""; $pollution_date_error = ""; $pollution_date = ""; $permit_date = ""; $permit_date_error = "";$fitness_date = ""; $fitness_date_error = "";

        $name = $_POST['name'];
        $name = $valid->clean_value($name);
		if(empty($name)) {
			$name_error = "Enter the name";
		}
		if(!empty($name_error)) {
			$valid_vehicle = $valid->error_display($form_name, "name", $name_error, 'text');			
		}

		$vehicle_number = $_POST['vehicle_number'];
        $vehicle_number = $valid->clean_value($vehicle_number);
		if(empty($vehicle_number)) {
			$vehicle_number_error = "Enter the vehicle Number";
			if(!empty($valid_vehicle)) {
				$valid_vehicle = $valid_vehicle." ".$valid->error_display($form_name, "vehicle_number", $vehicle_number_error, 'text');
			}
			else {
				$valid_vehicle = $valid->error_display($form_name, "vehicle_number", $vehicle_number_error, 'text');
			}
		}
		
		
		
		$mobile_number = $_POST['contact_number'];
        $mobile_number_error = $valid->valid_mobile_number($mobile_number, "Contact Number", "1");
		if(!empty($mobile_number_error)) {
			if(!empty($valid_vehicle)) {
				$valid_vehicle = $valid_vehicle." ".$valid->error_display($form_name, "contact_number", $mobile_number_error, 'text');
			}
			else {
				$valid_vehicle = $valid->error_display($form_name, "contact_number", $mobile_number_error, 'text');
			}
		}
		if(isset($_POST['insurance_date'])){
            $insurance_date = $_POST['insurance_date'];
            $insurance_date = trim($insurance_date);
			if(empty($insurance_date)){
				$insurance_date_error = "Select Insurance Date";
			}
        }
        if(!empty($insurance_date_error)) {
            $valid_vehicle = $valid->error_display($form_name, "insurance_date", $insurance_date_error, 'text');
			if(!empty($valid_vehicle)) {
            	$valid_vehicle = $valid_vehicle." ".$valid->error_display($form_name, "insurance_date", $insurance_date_error, 'text');
			}
			else {
            	$valid_vehicle = $valid->error_display($form_name, "insurance_date", $insurance_date_error, 'text');
			}
        }

		if(isset($_POST['permit_date'])){
            $permit_date = $_POST['permit_date'];
            $permit_date = trim($permit_date);
			if(empty($permit_date)){
				$permit_date_error = "Select Permit Date";
			}
        }
        if(!empty($permit_date_error)) {
            $valid_vehicle = $valid->error_display($form_name, "permit_date", $permit_date_error, 'text');
			if(!empty($valid_vehicle)) {
            	$valid_vehicle = $valid_vehicle." ".$valid->error_display($form_name, "permit_date", $permit_date_error, 'text');
			}
			else {
            	$valid_vehicle = $valid->error_display($form_name, "permit_date", $permit_date_error, 'text');
			}
        }	

		if(isset($_POST['fitness_date'])){
            $fitness_date = $_POST['fitness_date'];
            $fitness_date = trim($fitness_date);
			if(empty($fitness_date)){
				$fitness_date_error = "Select Fitness Date";
			}
        }
        if(!empty($fitness_date_error)) {
            $valid_vehicle = $valid->error_display($form_name, "fitness_date", $fitness_date_error, 'text');
			if(!empty($valid_vehicle)) {
            	$valid_vehicle = $valid_vehicle." ".$valid->error_display($form_name, "fitness_date", $fitness_date_error, 'text');
			}
			else {
            	$valid_vehicle = $valid->error_display($form_name, "fitness_date", $fitness_date_error, 'text');
			}
        }



		if(isset($_POST['pollution_date'])){
            $pollution_date = $_POST['pollution_date'];
            $pollution_date = trim($pollution_date);
			if(empty($pollution_date)){
				$pollution_date_error = "Select PUCC Date";
			}
        }
        if(!empty($pollution_date_error)) {
            $valid_vehicle = $valid->error_display($form_name, "pollution_date", $pollution_date_error, 'text');
			if(!empty($valid_vehicle)) {
            	$valid_vehicle = $valid_vehicle." ".$valid->error_display($form_name, "pollution_date", $pollution_date_error, 'text');
			}
			else {
            	$valid_vehicle = $valid->error_display($form_name, "pollution_date", $pollution_date_error, 'text');
			}
        }

		if(isset($_POST['np_tax_date'])){
            $np_tax_date = $_POST['np_tax_date'];
            $np_tax_date = trim($np_tax_date);
			if(empty($np_tax_date)){
				$np_tax_date_error = "Select N/P Tax Date";
			}
        }
        if(!empty($np_tax_date_error)) {
            $valid_vehicle = $valid->error_display($form_name, "np_tax_date", $np_tax_date_error, 'text');
			if(!empty($valid_vehicle)) {
            	$valid_vehicle = $valid_vehicle." ".$valid->error_display($form_name, "np_tax_date", $np_tax_date_error, 'text');
			}
			else {
            	$valid_vehicle = $valid->error_display($form_name, "np_tax_date", $np_tax_date_error, 'text');
			}
        }

		if(isset($_POST['road_tax_date'])){
            $road_tax_date = $_POST['road_tax_date'];
            $road_tax_date = trim($road_tax_date);
			if(empty($road_tax_date)){
				$road_tax_date_error = "Select Road Tax Date";
			}
        }
        if(!empty($road_tax_date_error)) {
            $valid_vehicle = $valid->error_display($form_name, "road_tax_date", $road_tax_date_error, 'text');
			if(!empty($valid_vehicle)) {
            	$valid_vehicle = $valid_vehicle." ".$valid->error_display($form_name, "road_tax_date", $road_tax_date_error, 'text');
			}
			else {
            	$valid_vehicle = $valid->error_display($form_name, "road_tax_date", $road_tax_date_error, 'text');
			}
        }
		if(isset($_POST['type'])) {
			$type = $_POST['type'];
            $type = trim($type);
			if(!empty($type)){
	            $type_error = $valid->common_validation($type, 'type', 'select');
			}
		}
        if(!empty($type_error)){
            if(!empty($valid_vehicle)) {
                $valid_vehicle = $valid_vehicle." ".$valid->error_display($form_name, "type", $type_error, 'select');
            }
            else {
                $valid_vehicle = $valid->error_display($form_name, "type", $type_error, 'select');
            }
        }

		
		if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
		}
		
		$result = "";
		
		if(empty($valid_vehicle)) {
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
					$name = $obj->encode_decode('encrypt', $name);
				}
				$lower_case_name = "";
				if(!empty($vehicle_number)) {
					$lower_case_name = strtolower($vehicle_number);
					$lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
				}
				$prev_vehicle_id = ""; $vehicle_error = ""; 
				$bill_company_id = $GLOBALS['bill_company_id'];
				if(!empty($lower_case_name)) {
					$prev_vehicle_id = $obj->checkVehicleNumberAlreadyExists($lower_case_name);
					if(!empty($prev_vehicle_id)) {
						$vehicle_error = "This vehicle Number is already exist";
					}
                }
				$update_vehicle_id = "";
				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
				if(!empty($insurance_date)) {
					$insurance_date = date('Y-m-d', strtotime($insurance_date));
				}
				if(!empty($username)) {
					$username = $obj->encode_decode('encrypt', $username);
				}
				if(!empty($vehicle_number)) {
					$vehicle_number = $obj->encode_decode('encrypt', $vehicle_number);
				}
				if(!empty($mobile_number)){
					$mobile_number = $obj->encode_decode('encrypt', $mobile_number);
				}
				if(empty($edit_id)) {
					if(empty($vehicle_error)){
						if(empty($prev_vehicle_id)) {						
							$action = "";
							if(!empty($name)) {
								$action = "New vehicle number Created. Name - ".$obj->encode_decode('decrypt', $name);
							}
	
							$null_value = $GLOBALS['null_value'];
							$columns = array('created_date_time', 'creator', 'creator_name', 'name', 'vehicle_number','lower_case_name', 'mobile_number','vehicle_type','insurance_date','pollution_date','permit_date','np_tax_date','road_tax_date','fitness_date');
							$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$name."'","'".$vehicle_number."'", "'".$lower_case_name."'", "'".$mobile_number."'", "'".$type."'", "'".$insurance_date."'", "'".$pollution_date."'","'".$permit_date."'", "'".$np_tax_date."'", "'".$road_tax_date."'", "'".$fitness_date."'");

							$vehicle_insert_id = $obj->InsertSQL($GLOBALS['vehicle_table'], $columns, $values, $action);						
							if(preg_match("/^\d+$/", $vehicle_insert_id)) {
								$vehicle_id = "";
								if($vehicle_insert_id < 10) {
									$vehicle_id = "vehicle_".date("dmYhis")."_0".$vehicle_insert_id;
								}
								else {
									$vehicle_id = "vehicle_".date("dmYhis")."_".$vehicle_insert_id;
								}
								if(!empty($vehicle_id)) {
									$vehicle_id = $obj->encode_decode('encrypt', $vehicle_id);
								}
								$columns = array(); $values = array();						
								$columns = array('vehicle_id');
								$values = array("'".$vehicle_id."'");
								$vehicle_update_id = $obj->UpdateSQL($GLOBALS['vehicle_table'], $vehicle_insert_id, $columns, $values, '');
								if(preg_match("/^\d+$/", $vehicle_update_id)) {		
									$result = array('number' => '1', 'msg' => 'vehicle Successfully Created');					
								}
								else {
									$result = array('number' => '2', 'msg' => $vehicle_update_id);
								}
							}
							else {
								$result = array('number' => '2', 'msg' => $vehicle_insert_id);
							}
						}
						else {
							$result = array('number' => '2', 'msg' => $vehicle_error);
						}
					}
					else{
						
						if(!empty($vehicle_error)){
							$result = array('number' => '2', 'msg' => $vehicle_error);
						}
					}
					}
					else {
						if(empty($prev_vehicle_id) || $prev_vehicle_id == $edit_id) {
							$getUniqueID = "";
							$getUniqueID = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'vehicle_id', $edit_id, 'id');
							if(preg_match("/^\d+$/", $getUniqueID)) {
								$action = "";
								if(!empty($name)) {
									$action = "vehicle Updated. Name - ".$obj->encode_decode('decrypt', $name);
								}
							
								$columns = array(); $values = array();
							
								$columns = array('created_date_time', 'creator', 'creator_name','bill_company_id','lower_case_name', 'name', 'vehicle_number', 'mobile_number','vehicle_type','insurance_date','pollution_date','permit_date','np_tax_date','road_tax_date','fitness_date');
								$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'","'".$lower_case_name."'", "'".$name."'", "'".$vehicle_number."'", "'".$mobile_number."'","'".$type."'", "'".$insurance_date."'", "'".$pollution_date."'","'".$permit_date."'", "'".$np_tax_date."'", "'".$road_tax_date."'", "'".$fitness_date."'");
								
								$vehicle_update_id = $obj->UpdateSQL($GLOBALS['vehicle_table'], $getUniqueID, $columns, $values, $action);
								if(preg_match("/^\d+$/", $vehicle_update_id)) {	
									$update_vehicle_id = $edit_id;
									$result = array('number' => '1', 'msg' => 'Updated Successfully');						
								}
								else {
									$result = array('number' => '2', 'msg' => $vehicle_update_id);
								}							
							}
						}
						else
						{
							$result = array('number' => '2', 'msg' => $vehicle_error);
						}
					}
				
			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_vehicle)) {
				$result = array('number' => '3', 'msg' => $valid_vehicle);
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
		$total_records_list = $obj->getTableRecords($GLOBALS['vehicle_table'], '', '');

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
        
		<table class="table nowrap cursor text-center bg-white">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Vehicle Name</th>
                    <th>Vehicle Number</th>
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
                            <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['vehicle_id'])) { echo $list['vehicle_id']; } ?>');"><?php echo $index; ?></td>
                            <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['vehicle_id'])) { echo $list['vehicle_id']; } ?>');">
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
										}
									?>
                            </td>
                            <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['vehicle_id'])) { echo $list['vehicle_id']; } ?>');">
                                <?php
                                    if(!empty($list['vehicle_number'])) {
                                        $list['vehicle_number'] = $obj->encode_decode('decrypt', $list['vehicle_number']);
                                        echo $list['vehicle_number'];
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
                                        <a class="pr-2" href="#" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['vehicle_id'])) { echo $list['vehicle_id']; } ?>');"><i class="fa fa-pencil"></i></a>
                                    <?php } ?>
									<?php
									$access_error = "";
									if(!empty($login_staff_id)) {
										$permission_action = $delete_action;
										include('permission_action.php');
									} 
									if(empty($access_error)) {
										  $check_linked = 0;
                                 	   $check_linked = $obj->getTableColumnValue($GLOBALS['tripsheet_table'],'vehicle_id',$list['vehicle_id'],'id');
									      if(!empty($check_linked)) { ?>
                                    <span title="This Driver can't be deleted">                           
                                            <a  class="text-secondary"  style="pointer-events: none; cursor: default;" > <i class="fa fa-trash" title="delete"></i> </a>
                                        </span>
                                    <?php }else{ ?>
                                        <a href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['vehicle_id'])) { echo $list['vehicle_id']; } ?>');"><i class="fa fa-trash"></i></a>
                                        <?php 
									}
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
                      
		<?php } ?>
<?php	
	}
	if(isset($_REQUEST['delete_vehicle_id'])) {
		$delete_vehicle_id = $_REQUEST['delete_vehicle_id'];
		$msg = "";
		if(!empty($delete_vehicle_id)) {
			$vehicle_unique_id = "";
			$vehicle_unique_id = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'vehicle_id', $delete_vehicle_id, 'id');

			// $primary_vehicle = "";
			// $primary_vehicle = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'vehicle_id', $delete_vehicle_id, 'primary_vehicle');
			if(!empty($vehicle_unique_id)) {
				if(preg_match("/^\d+$/", $vehicle_unique_id)) {
					$name = "";
					$name = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'vehicle_id', $delete_vehicle_id, 'name');
				
					$action = "";
					if(!empty($name)) {
						$action = "vehicle Deleted. Name - ".$obj->encode_decode('decrypt', $name);
					}

					$columns = array(); $values = array();						
					$columns = array('deleted');
					$values = array("'1'");
					$msg = $obj->UpdateSQL($GLOBALS['vehicle_table'], $vehicle_unique_id, $columns, $values, $action);
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