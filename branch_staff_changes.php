<?php
	include("include_files.php");
    $permission_page = $GLOBALS['branch_staff_module'];
	// include("permission_check.php");

	$sidebar_admin_user =  0;
	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
		if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['admin_user_type']) {
			$sidebar_admin_user = 1;
		}
	}
	$branch_list = array();
	$branch_list = $obj->getTableRecords($GLOBALS['branch_table'],'','');
	if(isset($_REQUEST['show_branch_staff_id'])) { 
        $show_branch_staff_id = $_REQUEST['show_branch_staff_id'];

		$site_modules = $GLOBALS['site_modules'];

        $name = ""; $username = ""; $password = ""; $branch_staff_contact_number = ""; $mobile_number = ""; $user_name = ""; $access_pages = ""; $access_page_actions = "";  $branch_id = ""; 
        if(!empty($show_branch_staff_id)) {
            $staff_list = array();
			$staff_list = $obj->getTableRecords($GLOBALS['branch_staff_table'], 'staff_id', $show_branch_staff_id);
            if(!empty($staff_list)) {
                foreach($staff_list as $data) {
                    if(!empty($data['name'])) {
                        $name = $obj->encode_decode('decrypt', $data['name']);
						// $name = strtoupper($name);
					}
					if(!empty($data['branch_staff_lr_prefix'])) {
                        $branch_staff_lr_prefix = $obj->encode_decode('decrypt', $data['branch_staff_lr_prefix']);
						
					}
					if(!empty($data['mobile_number'])) {
                        $mobile_number = $data['mobile_number'];
					}
					if(!empty($data['branch_id'])) {
                        $branch_id = $data['branch_id'];
					}
					if(!empty($data['staff_number'])) {
                        $staff_number = $obj->encode_decode('decrypt', $data['staff_number']);
					}
					if(!empty($data['password'])) {
						$password = $obj->encode_decode('decrypt', $data['password']);
					}
					if(!empty($data['username'])) {
						$user_name = $obj->encode_decode('decrypt', $data['username']);
					}
					if(!empty($data['access_pages']))
					{
						$access_pages = explode(",",$data['access_pages']);
					}
					if(!empty($data['access_page_actions']))
					{
						$access_page_actions = explode(",",$data['access_page_actions']);
					}
                }
				
            }
			
			$access_pages_list = $GLOBALS['staff_access_pages_list'];
		} ?>
        <form class="poppins pd-20" name="branch_staff_form" method="POST">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
						<h5 class="text-white">Edit Branch Staff</h5>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('branch_staff.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
			<div class="row p-3">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_branch_staff_id)) { echo $show_branch_staff_id; } ?>">
				<div class="col-lg-3 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="staff_name" name="staff_name" class="form-control shadow-none" placeholder="Staff Name" value="<?php if(!empty($name)){ echo $name; } ?>">
                            <label>Staff Name(*)</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="staff_number" name="staff_number" class="form-control shadow-none" value="<?php if(!empty($mobile_number)){ echo $mobile_number; } ?>" placeholder="Staff Number">
                            <label>Staff Number(*)</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="user_name" name="user_name" class="form-control shadow-none" placeholder="User Name" value="<?php if(!empty($user_name)){ echo $user_name; }?>">
                            <label>User Name(*)</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <select name="branch_id" class="form-control" placeholder="Select">
								<option value="">Select</option>
								<?php
									if(!empty($branch_list)) {
                                        foreach($branch_list as $data) { ?>
											<option value="<?php if(!empty($data['branch_id'])) { echo $data['branch_id']; } ?>" <?php if(!empty($branch_id) && $data['branch_id'] == $branch_id){ ?>selected<?php } ?>>
												<?php
													if(!empty($data['name'])) {
														$data['name'] = $obj->encode_decode('decrypt', $data['name']);
														echo $data['name'];
													}
												?>
											</option>
											<?php
										}
									}
								?>
                            </select>
                            <label>Branch(*)</label>
                        </div> 
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="password" class="form-control shadow-none"  id="password" name="password" onkeyup="Javascript:CheckPassword('password');" value="<?php if(!empty($password)){ echo $password;  }?>" placeholder="Password">
                                <label for="password" style="z-index:9999;">Password</label>
                                <div style="position: inherit; top: 0px;" class="input-group-append" data-toggle="tooltip" data-placement="right" title="Show Password">
                                    <button class="btn btn-danger" type="button" id="passwordBtn" data-toggle="button" aria-pressed="false"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
						<div id="password_cover">  
							<div class="smallfnt p-gray">Password must include:</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="length_check" value="" id="defaultCheck1">
								<label class="form-check-label smallfnt fw-400 checkbox" for="defaultCheck1">
									8 - 20 characters
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="letter_check" value="" id="defaultCheck1">
								<label class="form-check-label smallfnt fw-400 checkbox" for="defaultCheck1">
									Atleast one upper case and lower case letter
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="number_symbol_check" value="" id="defaultCheck1">
								<label class="form-check-label smallfnt fw-400 checkbox" for="defaultCheck1">
									Atleast one number and one symbol
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="space_check" value="" id="defaultCheck1">
								<label class="form-check-label smallfnt fw-400 checkbox" for="defaultCheck1">
									No space
								</label>
							</div>
						</div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="table-responsive poppins">
                        <table class="table nowrap table-bordered smallfnt">
                            <thead class="bg-pinterest">
                                <tr class="text-white">
                                    <th>Module</th>
                                    <th>Permission</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php	
                                    if(!empty($access_pages_list)) {
                                        foreach($access_pages_list as $module) {
                                            if(!empty($module)) {
                                                $module_encrypted = "";
                                                $module_encrypted = $obj->encode_decode('encrypt', $module);
                                                $view_checkbox_value = 2; $add_checkbox_value = 2; $edit_checkbox_value = 2; $delete_checkbox_value = 2;
                                                $select_all_checkbox_value = 2;

                                                $module_selected = 0; $module_action = array();
                                                if(!empty($access_pages) && !empty($access_page_actions)) {
                                                    for($i = 0; $i < count($access_pages); $i++) {
                                                        if(!empty($access_pages[$i]) && $module_encrypted == $access_pages[$i]) {
                                                            if(!empty($access_page_actions[$i])) {
                                                                $module_action = explode("$$$", $access_page_actions[$i]);
                                                            }														
                                                        }
                                                    }
                                                    if(!empty($module_action)) {
                                                        if(in_array($view_action, $module_action)) {
                                                            $view_checkbox_value = 1;
                                                            $module_selected++;
                                                        }
                                                        if(in_array($add_action, $module_action)) {
                                                            $add_checkbox_value = 1;
                                                            $module_selected++;
                                                        }
                                                        
                                                        if($module_selected == 4) {
                                                            $select_all_checkbox_value = 1;
                                                        }
                                                    }
                                                }
													?>
												<tr>
													<td><?php if(!empty($module)) { echo $module; } ?></td>
													<td>
														<div class="d-flex">
															<?php if($module == $GLOBALS['invoice_acknowledgement_module'] || $module ==  $GLOBALS['unclearance_entry_module']){ ?>
															<div class="form-check pr-3">
																<label class="form-check-label" onClick="Javascript:SelectAllModuleActionToggle(this, '<?php if(!empty($module_encrypted)) { echo $module_encrypted."_select_all"; } ?>');">
																		<input type="checkbox" name="<?php if(!empty($module_encrypted)) { echo $module_encrypted."_select_all"; } ?>" id="<?php if(!empty($module_encrypted)) { echo $module_encrypted."_select_all"; } ?>" class="form-check-input" value="<?php if(!empty($select_all_checkbox_value)) { echo $select_all_checkbox_value; } ?>" <?php if(!empty($select_all_checkbox_value) && $select_all_checkbox_value == 1) { ?>checked="checked"<?php } ?> >
																		Select All
																	</label>
															</div>
															<?php } ?>
															<div class="form-check pr-3" >
																<label class="form-check-label" onClick="Javascript:CustomCheckboxToggle(this, '<?php if(!empty($module_encrypted)) { echo $module_encrypted."_view"; } ?>');">
																	<input type="checkbox" name="<?php if(!empty($module_encrypted)) { echo $module_encrypted."_view"; } ?>" id="<?php if(!empty($module_encrypted)) { echo $module_encrypted."_view"; } ?>" class="form-check-input" value="<?php if(!empty($view_checkbox_value)) { echo $view_checkbox_value; } ?>" <?php if(!empty($view_checkbox_value) && $view_checkbox_value == 1) { ?>checked="checked"<?php } ?> >
																	View
																</label>
															</div>
															<?php
															if($module == $GLOBALS['invoice_acknowledgement_module'] || $module ==  $GLOBALS['unclearance_entry_module']){
																?> 
															<div class="form-check pr-3">
																<label class="form-check-label" onClick="Javascript:CustomCheckboxToggle(this, '<?php if(!empty($module_encrypted)) { echo $module_encrypted."_add"; } ?>');">
																	<input type="checkbox" name="<?php if(!empty($module_encrypted)) { echo $module_encrypted."_add"; } ?>" id="<?php if(!empty($module_encrypted)) { echo $module_encrypted."_add"; } ?>" class="form-check-input" value="<?php if(!empty($add_checkbox_value)) { echo $add_checkbox_value; } ?>" <?php if(!empty($add_checkbox_value) && $add_checkbox_value == 1) { ?>checked="checked"<?php } ?> >
																	Add
																</label>
															</div>
															<?php } ?>
															<!-- <div class="form-check pr-3">
																<input class="form-check-input" type="checkbox" name="length_check" value="" id="defaultCheck1">
																<label class="form-check-label checkbox" for="defaultCheck1">
																	Edit
																</label>
															</div>
															<div class="form-check pr-3">
																<input class="form-check-input" type="checkbox" name="length_check" value="" id="defaultCheck1">
																<label class="form-check-label checkbox" for="defaultCheck1">
																	Delete
																</label>
															</div> -->
														</div>
													</td>
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
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent('branch_staff_form', 'branch_staff_changes.php', 'branch_staff.php');">
                        Submit
                    </button>
                </div>
			</div>
            <script src="include/select2/js/select2.min.js"></script>
        	<script src="include/select2/js/select.js"></script>
            <script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('form[name="staff_form"]').find('select').select2();
				});   
			</script>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					const passBtn = $("#passwordBtn");
					passBtn.click(togglePassword);

					function togglePassword() {
						const passInput = $("#password");
						if (passInput.attr("type") === "password") {
							passInput.attr("type", "text");
						} 
						else {
							passInput.attr("type", "password");
						}
					}
				});
			</script>
        </form>
		<?php
    } 
    if(isset($_POST['staff_name'])) {
		
		$name = ""; $name_error = "";  $username = ""; $username_error = "";
		$password = ""; $password_error = ""; $branch_staff_contact_number = ""; $branch_staff_contact_number_error = ""; $branch_staff_lr_prefix = ""; $staff_number = ""; $staff_number_error = ""; $branch_id = ""; $branch_id_error = ""; $username = ""; $password = ""; $password_error = ""; $access_pages = array(); $access_page_actions = array(); $access_error = "";

		$valid_branch_staff = ""; $form_name = "branch_staff_form"; $access_pages_error = ""; $branch_staff_contact_number = ""; $branch_staff_contact_number_error = "";
	
        $name = $_POST['staff_name'];
        $name = $valid->clean_value($name);
		if(empty($name)) {
			$name_error = "Enter the name";
		}
		if(!empty($name_error)) {
			$valid_branch_staff = $valid->error_display($form_name, "staff_name", $name_error, 'text');			
		}
		
		$staff_number = $_POST['staff_number'];
        $staff_number_error = $valid->valid_mobile_number($staff_number, "Branch staff  Number", "1");
		if(!empty($staff_number_error)) {
			if(!empty($valid_branch_staff)) {
				$valid_branch_staff = $valid_branch_staff." ".$valid->error_display($form_name, "staff_number", $staff_number_error, 'text');
			}
			else {
				$valid_branch_staff = $valid->error_display($form_name, "staff_number", $staff_number_error, 'text');
			}
		}
        
		$user_name = $_POST['user_name'];
        $user_name = $valid->clean_value($user_name);
		if(empty($user_name)) {
			$user_name_error = "Enter the user name";
		}
		if(!empty($user_name_error)) {
			if(!empty($valid_branch_staff)) {
				$valid_branch_staff = $valid_branch_staff." ".$valid->error_display($form_name, "user_name", $user_name_error, 'text');
			}
			else {
				$valid_branch_staff = $valid->error_display($form_name, "user_name", $user_name_error, 'text');
			}		
		}
		if(!empty($_POST['branch_id']))
		{
			$branch_id = $_POST['branch_id'];
		}
		if(empty($branch_id))
		{
			$branch_id_error = "Select the branch";
		}
		if(!empty($branch_id_error))
		{
			if(!empty($valid_branch_staff)) {
				$valid_branch_staff = $valid_branch_staff." ".$valid->error_display($form_name, "branch_id", $branch_id_error, 'select');
			}
			else {
				$valid_branch_staff = $valid->error_display($form_name, "branch_id", $branch_id_error, 'select');
			}
		}
		$password = $_POST['password'];
        $password_error = $valid->valid_password($password, "Password", "1");
		if(!empty($password_error)) {
			if(!empty($valid_branch_staff)) {
				$valid_branch_staff = $valid_branch_staff." ".$valid->error_display($form_name, "password", $password_error, 'input_group');
			}
			else {
				$valid_branch_staff = $valid->error_display($form_name, "password", $password_error, 'input_group');
			}
		}

		$access_pages_list = $GLOBALS['staff_access_pages_list']; $module_selected = 0;
		if(!empty($access_pages_list)) {
			foreach($access_pages_list as $module) {
				if(!empty($module)) {
					$module_encrypted = "";
					$module_encrypted = $obj->encode_decode('encrypt', $module);
					$module_action = array(); 
					$view_checkbox_value = 2; $add_checkbox_value = 2; $edit_checkbox_value = 2; $delete_checkbox_value = 2;
					$view_field = $module_encrypted."_view"; $add_field = $module_encrypted."_add"; $edit_field = $module_encrypted."_edit"; 
					$delete_field = $module_encrypted."_delete";

					if(isset($_POST[$view_field])) {
						$view_checkbox_value = $_POST[$view_field];
						$view_checkbox_value = trim($view_checkbox_value);
					}
					if($view_checkbox_value != 1 && $view_checkbox_value != 2) { $view_checkbox_value = 2; }
					if($view_checkbox_value == 1) { 
						$module_action[] = $view_action;
					}

					if(isset($_POST[$add_field])) {
						$add_checkbox_value = $_POST[$add_field];
						$add_checkbox_value = trim($add_checkbox_value);
					}
					if($add_checkbox_value != 1 && $add_checkbox_value != 2) { $add_checkbox_value = 2; }
					if($add_checkbox_value == 1) { 
						$module_action[] = $add_action;
					}
					
					if(!empty($module_action) && count($module_action) > 0) {
						$access_pages[] = $module_encrypted;
						$access_page_actions[] = implode("$$$", $module_action);
						$module_selected = 1;
					}


				}
			}
		}
		$access_permission_error = "";
		if(empty($module_selected) && empty($valid_branch_staff)) {
			$access_permission_error = "Select the access permission";
		}

		
		if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
		}
		$result = "";
		if(empty($valid_branch_staff) && empty($access_permission_error)) {
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
				

				

				$lower_case_name = strtolower($user_name);
                $lower_case_name = $obj->encode_decode("encrypt",$lower_case_name);	
				$prev_user_id =$obj->checkUserAlreadyExist($lower_case_name,$edit_id);
				if(!empty($prev_user_id)) {
					$staff_error = "This User id is already exist";
				}
				if(empty($prev_user_id)){
					$prev_staff_id = ""; $columns = array(); $values = array(); $check_staffs = array(); $staff_error = ""; $duplication_error = "";	
					if(!empty($staff_number)) {
						$prev_staff_id = $obj->getTableColumnValue($GLOBALS['branch_staff_table'], 'mobile_number',$staff_number,'staff_id');
						if(!empty($prev_staff_id) && $prev_staff_id != $edit_id) {
							$staff_error = "This branch staff Number is already exist";
						}
					}
				}
				if(!empty($access_pages)) {
					$access_pages = implode(",", $access_pages);
				}

				if(!empty($access_page_actions)) {
					$access_page_actions = implode(",", $access_page_actions);
				}

				$update_staff_id = "";
				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);

				if(!empty($user_name)) {
					$user_name = $obj->encode_decode('encrypt', $user_name);
				}
				// if(!empty($branch_staff_lr_prefix)) {
				// 	$branch_staff_lr_prefix = $obj->encode_decode('encrypt', $branch_staff_lr_prefix);
				// }
				if(!empty($branch_staff_number)){
					$branch_staff_number = $obj->encode_decode('encrypt', $branch_staff_number);
				}
				// if(!empty($mobile_number)) {
				// 	$mobile_number = $obj->encode_decode('encrypt', $mobile_number);
				// }
				
				if(!empty($password)) {
					$password = $obj->encode_decode('encrypt', $password);
				}
				if(empty($edit_id)) {
					if(empty($staff_error)){
						if(empty($prev_staff_id)) {						
							$action = "";
							if(!empty($name)) {
								$action = "New branch_staff number Created. Name - ".$obj->encode_decode('decrypt', $name);
							}
	
							$null_value = $GLOBALS['null_value'];
							$columns = array('created_date_time', 'creator', 'creator_name', 'staff_id', 'name', 'mobile_number', 'username','lower_case_name', 'password', 'deleted', 'access_pages','branch_id','access_page_actions');
							$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$null_value."'", "'".$name."'", "'".$staff_number."'", "'".$user_name."'","'".$lower_case_name."'","'".$password."'",'0', "'".$access_pages."'","'".$branch_id."'", "'".$access_page_actions."'");

							$staff_insert_id = $obj->InsertSQL($GLOBALS['branch_staff_table'], $columns, $values, $action);						
							if(preg_match("/^\d+$/", $staff_insert_id)) {
								$staff_id = "";
								if($staff_insert_id < 10) {
									$staff_id = "BRANCH_STAFF_".date("dmYhis")."_0".$staff_insert_id;
								}
								else {
									$staff_id = "BRANCH_STAFF_".date("dmYhis")."_".$staff_insert_id;
								}
								if(!empty($staff_id)) {
									$staff_id = $obj->encode_decode('encrypt', $staff_id);
								}
								$columns = array(); $values = array();						
								$columns = array('staff_id');
								$values = array("'".$staff_id."'");
								$staff_update_id = $obj->UpdateSQL($GLOBALS['branch_staff_table'], $staff_insert_id, $columns, $values, '');
								if(preg_match("/^\d+$/", $staff_update_id)) {		
									$result = array('number' => '1', 'msg' => 'staff Successfully Created');					
								}
								else {
									$result = array('number' => '2', 'msg' => $staff_update_id);
								}
								$result = array('number' => '1', 'msg' => 'New staff staff Details inserted');
							}
							else {
								$result = array('number' => '2', 'msg' => $staff_insert_id);
							}
						}
						else {
							$result = array('number' => '2', 'msg' => $staff_error);
						}
					}
					else{
						
						if(!empty($staff_error)){
							$result = array('number' => '2', 'msg' => $staff_error);
						}
					}
				}
				else {
					if(empty($staff_error))
					{
						$getUniqueID = "";
						$getUniqueID = $obj->getTableColumnValue($GLOBALS['branch_staff_table'],'staff_id',$edit_id,'id');
						if(preg_match("/^\d+$/", $getUniqueID)) {
							$action = "";
							if(!empty($name)) {
								$action = "Staff Updated. Name - ".$obj->encode_decode('decrypt', $name);
							}
						
							$columns = array(); $values = array();
						
							$columns = array('created_date_time', 'creator', 'creator_name', 'name', 'mobile_number','lower_case_name', 'username', 'password', 'deleted', 'access_pages', 'access_page_actions','branch_id');
							$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$name."'", "'".$staff_number."'","'".$lower_case_name."'", "'".$user_name."'","'".$password."'",'0', "'".$access_pages."'", "'".$access_page_actions."'","'".$branch_id."'");
							
							$staff_update_id = $obj->UpdateSQL($GLOBALS['branch_staff_table'], $getUniqueID, $columns, $values, $action);
							if(preg_match("/^\d+$/", $staff_update_id)) {	
								$update_staff_id = $edit_id;
								$result = array('number' => '1', 'msg' => 'Updated Successfully');						
							}
							else {
								$result = array('number' => '2', 'msg' => $staff_update_id);
							}							
						}	
					}
					else
					{
						$result=array('number' => '2','msg'=>$staff_error);
					}
					
				}
				
			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_branch_staff)) {
				$result = array('number' => '3', 'msg' => $valid_branch_staff);
			}
			if(!empty($access_permission_error)) {
				$result = array('number' => '2', 'msg' => $access_permission_error);
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
        $login_staff_id = "";
		if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
			$login_staff_id =  $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
		}
		
		$search_text = "";
		if(isset($_POST['search_text'])) {
			$search_text = $_POST['search_text'];
		}
		$total_records_list = array();
		if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
			if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
				if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['branch_staff_user_type']) {					
					$total_records_list = $obj->getTableRecords($GLOBALS['branch_staff_table'], 'staff_id', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']);
				}
				else {
					$total_records_list = $obj->getTableRecords($GLOBALS['branch_staff_table'], '', '');
				}
			}
		}

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
            $permission_module = $GLOBALS['branch_staff_module'];
            $permission_action = $view_action;
        }
		if(empty($access_error)) { ?>
        
		<table class="table nowrap cursor text-center bg-white">
            <thead class="bg-light">
            <tr>
                <th>S.No</th>
                <th>Branch Staff Name</th>
                <th>Branch Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($show_records_list)) {
                    // $edit_action = $obj->encode_decode('encrypt', 'edit_action');
                    foreach($show_records_list as $key => $list) {
                        $index = $key + 1; $branch_name = "";
                        if(!empty($prefix)) { $index = $index + $prefix; }

                        $strbranch_name = "";
                        if(!empty($list['branch_id']))
                        {
							$branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$list['branch_id'],'name');
							if(!empty($branch_name))
							{
								$strbranch_name = $obj->encode_decode("decrypt",$branch_name);
							}           
                        }
                        ?>
                <tr>
                    <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['staff_id'])) { echo $list['staff_id']; } ?>');"><?php echo $index; ?></td>
                    <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['staff_id'])) { echo $list['staff_id']; } ?>');">
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
                    <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['staff_id'])) { echo $list['staff_id']; } ?>');">
                        <?php
                            if(!empty($strbranch_name)) {
                                echo $strbranch_name;
                            }
                        ?>
                    </td>
                    <td>
                        <?php $access_error = "";
                            if(!empty($login_staff_id)) {
                                $permission_module = $GLOBALS['branch_staff_module'];
                                $permission_action = $edit_action;

                            }
                            if(empty($access_error)) { ?>
                            <a class="pr-2" href="#" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['staff_id'])) { echo $list['staff_id']; } ?>');"><i class="fa fa-pencil"></i></a>
                        <?php } ?>
                        <?php
                            $access_error = "";
                            if(!empty($login_staff_id)) {
                                $permission_module = $GLOBALS['branch_staff_module'];
                                $permission_action = $delete_action;
                            } 
                            if(empty($access_error)) {
                                $hide_delete = 1;
                                if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['admin_user_type']) {
                                    $hide_delete = 0;
                                }
                                if(empty($hide_delete) ) {
                            ?>
                                <a class="pr-2" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['staff_id'])) { echo $list['staff_id']; } ?>');" ><i class="fa fa-trash"></i></a>
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
	if(isset($_REQUEST['delete_branch_staff_id'])) {
		$delete_branch_staff_id = $_REQUEST['delete_branch_staff_id'];
		$msg = "";
		if(!empty($delete_branch_staff_id)) {
			$branch_staff_unique_id = "";
			$branch_staff_unique_id = $obj->getTableColumnValue($GLOBALS['branch_staff_table'], 'staff_id', $delete_branch_staff_id, 'id');
			if(!empty($branch_staff_unique_id)) {
				if(preg_match("/^\d+$/", $branch_staff_unique_id)) {
					$name = "";
					$name = $obj->getTableColumnValue($GLOBALS['branch_staff_table'], 'staff_id', $delete_branch_staff_id, 'name');
				
					$action = "";
					if(!empty($name)) {
						$action = "branch_staff Deleted. Name - ".$obj->encode_decode('decrypt', $name);
					}

					$columns = array(); $values = array();						
					$columns = array('deleted');
					$values = array("'1'");
					$msg = $obj->UpdateSQL($GLOBALS['branch_staff_table'], $branch_staff_unique_id, $columns, $values, $action);
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