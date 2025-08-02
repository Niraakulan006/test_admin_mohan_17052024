<?php
	include("include_files.php");

	$permission_page = $GLOBALS['godown_module'];

	$sidebar_admin_user =  0;
	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
		if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['admin_user_type']) {
			$sidebar_admin_user = 1;
		}
	}
	
	if(isset($_REQUEST['show_godown_id'])) { 
        $show_godown_id = $_REQUEST['show_godown_id'];

		$site_modules = $GLOBALS['site_modules'];

        $name = ""; $godown_contact_number = ""; $mobile_number ="";
        if(!empty($show_godown_id)) {
            $godown_list = array();
			$godown_list = $obj->getTableRecords($GLOBALS['godown_table'], 'id', $show_godown_id);
            if(!empty($godown_list)) {
                foreach($godown_list as $data) {
                    if(!empty($data['name']) && $data['name'] != "NULL") {
                        $name = $obj->encode_decode('decrypt', $data['name']);
					}
					if(!empty($data['mobile_number']) && $data['mobile_number'] != "NULL") {
                        $mobile_number = $data['mobile_number'];
					}
					
					if(!empty($data['lower_case_name']) && $data['lower_case_name'] != "NULL") {
                        $lower_case_name = $obj->encode_decode('decrypt', $data['lower_case_name']);
					}
                }
            }
		} ?>
        <form class="poppins pd-20" name="godown_form" method="POST">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
						<h5 class="text-white">Edit godown</h5>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('godown.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
			<div class="row p-3">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_godown_id)) { echo $show_godown_id; } ?>">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2" >
                            <input type="text" id="godown_name" name="godown_name" class="form-control shadow-none" placeholder="godown Name" value="<?php if(!empty($name)){ echo $name; }?>" onkeyup="Javascript:InputBoxColor(this,'text');" required>
                            <label>godown Name(<span class="text-danger">*</span>)</label>
                        </div>
                    </div>
					
                </div>
				<div class="col-lg-4 col-md-6 col-12 mb-3">
					<div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2" >
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control shadow-none" placeholder="mobile number" value="<?php if(!empty($mobile_number)){ echo $mobile_number; }?>" onkeyup="Javascript:InputBoxColor(this,'text');" required>
                            <label>Mobile Number(<span class="text-danger">*</span>)</label>
                        </div>
                    </div>
				</div>
			</div>
			<div class="col-md-12  text-center">
				<div class="form-group in-border pb-2">
					<button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent('godown_form', 'godown_changes.php', 'godown.php');">
						Submit
					</button>
				</div>
			</div>
            <script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('form[name="godown_form"]').find('select').select2();
				});   
				jQuery(document).ready(function(){
					jQuery('select[name="state"]').select2();
                    print_state('<?php if(!empty($state)) { echo $state; } ?>');
					
					jQuery('.add_update_form_content').find('select').select2();
				});
			</script>
        </form>
		<?php
    } 
    if(isset($_POST['godown_name'])) {	
		$name = ""; $lower_case_name ="";
		$name_error = ""; $mobile_number ="";
		$valid_godown = ""; $form_name = "godown_form"; 

		if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
		}

		// Name
		if(isset($_POST['godown_name'])){
			$name = $_POST['godown_name'];
			$name = $valid->clean_value($name);
			if(empty($name)) {
				$name_error = "Enter the name";
			}
			if(!empty($name_error)) {
				$valid_godown = $valid->error_display($form_name, "godown_name", $name_error, 'text');			
			}
		}

		if(isset($_POST['mobile_number'])){
			$mobile_number = $_POST['mobile_number'];
			$mobile_number_error = $valid->valid_mobile_number($mobile_number,'mobile number','1');

			if(!empty($mobile_number_error)) {
				$valid_godown = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');			
			}
		}

		// Contact Number
		
		
		$result = "";
		$bill_company_id = $GLOBALS['bill_company_id'];
		if(empty($valid_godown)) {
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
				if(!empty($godown_city)){
					$lower_case_city = strtolower($godown_city);
					$godown_city = $obj->encode_decode('encrypt', $godown_city);
					$lower_case_city = $obj->encode_decode('encrypt',$lower_case_city);
				}

				// godown name and city name checking...If same name and city exists, show error //
				$prev_godown_name_id = ""; $prev_name_error = ""; $prev_godown_name = ""; $prev_godown_city1 = "";		
				if(!empty($lower_case_name) && !empty($lower_case_city)) {
					$prev_godown_name_id = $obj->CheckgodownNameAlreadyExists($lower_case_name,$lower_case_city);
					if(!empty($prev_godown_name_id)) {
						$prev_godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'id',$prev_godown_name_id,'name');
						$prev_godown_city1 = $obj->getTableColumnValue($GLOBALS['godown_table'],'id',$prev_godown_name_id,'godown_city');
						$prev_name_error = "This godown name and city is already exist in ".($obj->encode_decode('decrypt',$prev_godown_name))." - ".($obj->encode_decode('decrypt',$prev_godown_city1));
					}
                }

				

				$update_godown_id = "";
				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);

				
				
				
				if(empty($edit_id)) {
					if(empty($prev_name_error)){
						if(empty($prev_lr_error)) {		
							if(empty($prev_mobile_error)){				
								$action = "";
								if(!empty($name)) {
									$action = "New godown Created. Name - ".$obj->encode_decode('decrypt', $name);
								}
		
								$null_value = $GLOBALS['null_value'];
								$columns = array('created_date_time', 'creator', 'creator_name','bill_company_id','godown_id', 'name','mobile_number','lower_case_name','deleted');
								$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$name."'","'".$mobile_number."'", "'".$lower_case_name."'","'0'");

								$godown_insert_id = $obj->InsertSQL($GLOBALS['godown_table'], $columns, $values, $action);						
								if(preg_match("/^\d+$/", $godown_insert_id)) {
									$godown_id = "";
									if($godown_insert_id < 10) {
										$godown_id = "GODOWN_".date("dmYhis")."_0".$godown_insert_id;
									}
									else {
										$godown_id = "GODOWN".date("dmYhis")."_".$godown_insert_id;
									}
									if(!empty($godown_id)) {
										$godown_id = $obj->encode_decode('encrypt', $godown_id);
									}
									$columns = array(); $values = array();						
									$columns = array('godown_id');
									$values = array("'".$godown_id."'");
									$godown_update_id = $obj->UpdateSQL($GLOBALS['godown_table'], $godown_insert_id, $columns, $values, '');
									if(preg_match("/^\d+$/", $godown_update_id)) {		
										$result = array('number' => '1', 'msg' => 'godown Successfully Created');					
									}
									else {
										$result = array('number' => '2', 'msg' => $godown_update_id);
									}
								}
								else {
									$result = array('number' => '2', 'msg' => $godown_insert_id);
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
					if(empty($prev_godown_name_id) || $prev_godown_name_id == $edit_id) {
						if(empty($prev_godown_prefix_id) || $prev_godown_prefix_id == $edit_id) {
							if(empty($prev_godown_mobile_id) || $prev_godown_mobile_id == $edit_id) {
								$getUniqueID = "";
								$getUniqueID = $edit_id;
								if(preg_match("/^\d+$/", $getUniqueID)) {
									$action = "";
									if(!empty($name)) {
										$action = "godown Updated. Name - ".$obj->encode_decode('decrypt', $name);
									}
								
									$columns = array(); $values = array();
								
									$columns = array('created_date_time', 'creator', 'creator_name','name','mobile_number', 'lower_case_name');
									$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$name."'","'".$mobile_number."'","'".$lower_case_name."'");
									
									$godown_update_id = $obj->UpdateSQL($GLOBALS['godown_table'], $getUniqueID, $columns, $values, $action);
									if(preg_match("/^\d+$/", $godown_update_id)) {	
										$update_godown_id = $edit_id;
										$result = array('number' => '1', 'msg' => 'Updated Successfully');						
									}
									else {
										$result = array('number' => '2', 'msg' => $godown_update_id);
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
				
			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_godown)) {
				$result = array('number' => '3', 'msg' => $valid_godown);
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
		if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['godown_staff_user_type']) {
			$login_staff_id =  $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
		}
		
		$search_text = "";
		if(isset($_POST['search_text'])) {
			$search_text = $_POST['search_text'];
		}
		$total_records_list = array();
		if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
			// if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
			// 	if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['godown_staff_user_type']) {					
			// 		$total_records_list = $obj->getTableRecords($GLOBALS['godown_table'], 'godown_id', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']);
			// 	}
			// 	else {
					$total_records_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '');
			// 	}
			// }
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
            $permission_module = $GLOBALS['godown_module'];
            $permission_action = $view_action;
            include('user_permission_action.php');
        }
		if(empty($access_error)) { ?>
        
		<table class="table nowrap cursor bg-white text-center">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>godown Name</th>
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
                            <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['id'])) { echo $list['id']; } ?>');"><?php echo $index; ?></td>
                            <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['id'])) { echo $list['id']; } ?>');">
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
							
                            <td>
                                <?php $access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_module = $GLOBALS['godown_module'];
                                        $permission_action = $edit_action;
                                        include('user_permission_action.php');

                                    }
                                    if(empty($access_error)) { ?>
                                        <a class="pr-2" href="#" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['id'])) { echo $list['id']; } ?>');"><i class="fa fa-pencil"></i></a>
                                <?php } ?>
                                <?php
                                    $access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_module = $GLOBALS['godown_module'];
                                        $permission_action = $delete_action;
                                        include('user_permission_action.php');

                                    }  
                                    if(empty($access_error)) {
                                        $hide_delete = 1;
                                        if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['admin_user_type']) {
                                            $hide_delete = 0;
                                        }
                                        if(empty($hide_delete) && empty($godown_receipt_id) && empty($godown_invoice_id)) {
                                    ?>
                                        <!-- <a class="pr-2" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['godown_id'])) { echo $list['godown_id']; } ?>');"><i class="fa fa-trash"></i></a> -->
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
	if(isset($_REQUEST['delete_godown_id'])) {
		$delete_godown_id = $_REQUEST['delete_godown_id'];
		$msg = "";
		if(!empty($delete_godown_id)) {
			$godown_unique_id = "";
			$godown_unique_id = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $delete_godown_id, 'id');
			// $primary_godown = "";
			// $primary_godown = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $delete_godown_id, 'primary_godown');
			if(!empty($godown_unique_id)) {
				if(preg_match("/^\d+$/", $godown_unique_id)) {
					$name = "";
					$name = $obj->getTableColumnValue($GLOBALS['godown_table'], 'godown_id', $delete_godown_id, 'name');
				
					$action = "";
					if(!empty($name)) {
						$action = "godown Deleted. Name - ".$obj->encode_decode('decrypt', $name);
					}

					$columns = array(); $values = array();						
					$columns = array('deleted');
					$values = array("'1'");
					$msg = $obj->UpdateSQL($GLOBALS['godown_table'], $godown_unique_id, $columns, $values, $action);
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