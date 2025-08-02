<?php
	include("include_files.php");

    $login_staff_id = "";
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
			$login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			$permission_module = $GLOBALS['driver_module'];
		}
	}
         $expiry_date = date("Y-m-d"); 
         $current_date = date("Y-m-d"); 

	
	if(isset($_REQUEST['show_driver_id'])) { 
        $show_driver_id = $_REQUEST['show_driver_id'];
        $driver_name = ""; $driver_number = ""; $license_type = $expiry_date = $license_number = "";
        if(!empty($show_driver_id)) {
            $driver_list = array();
			$driver_list = $obj->getTableRecords($GLOBALS['driver_table'], 'driver_id', $show_driver_id);
            if(!empty($driver_list)) {
                foreach($driver_list as $data) {
                    if(!empty($data['driver_name']) && $data['driver_name'] != "NULL") {
                        $driver_name = $obj->encode_decode('decrypt', $data['driver_name']);
					}
					if(!empty($data['driver_number']) && $data['driver_number'] != "NULL") {
                        $driver_number = $obj->encode_decode('decrypt', $data['driver_number']);
					}
                    if(!empty($data['license_type'])) {
                        $license_type = $data['license_type'];
					}
					if(!empty($data['expiry_date'])) {
                        $expiry_date = date('Y-m-d', strtotime($data['expiry_date']));
					}
                    if(!empty($data['license_number']) && $data['license_number'] != $GLOBALS['null_value']) {
                        $license_number = $obj->encode_decode('decrypt',$data['license_number']);
					}
                }
            }
		} ?>
        <form class="poppins pd-20 redirection_form" name="driver_form" method="POST">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
                        <?php if(empty($show_driver_id)) { ?>
						    <h5 class="text-white">Add Driver</h5>
                        <?php } else { ?>
						    <h5 class="text-white">Edit Driver</h5>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('driver.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
			<div class="row justify-content-center p-3">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_driver_id)) { echo $show_driver_id; } ?>">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="driver_name" name="driver_name" class="form-control shadow-none" placeholder="" value="<?php if(!empty($driver_name)){ echo $driver_name; }?>">
                            <label>Driver Name <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="driver_number" name="driver_number" class="form-control shadow-none" placeholder="" value="<?php if(!empty($driver_number)){ echo $driver_number; }?>">
                            <label>Driver Number <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>

                 <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="license_number" name="license_number" class="form-control shadow-none" placeholder="" value="<?php if(!empty($license_number) && $license_number != $GLOBALS['null_value']){ echo $license_number; }?>">
                            <label>Driver License Number </label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
							<input type="date" class="form-control shadow-none" name="expiry_date" min="<?php if(!empty($current_date)) { echo $current_date; } ?>" value="<?php if(!empty($expiry_date)) { echo date('Y-m-d', strtotime($expiry_date)); } ?>">
                            <label>License Expiry Date <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
							<select name="license_type" class="select2 select2-danger smallfnt form-control" style="width:100% !important;">
								<option value="">Select License Type</option>
								<option value="1" <?php if(!empty($license_type) && $license_type == '1') { echo "selected"; } ?>>Transport</option>
								<option value="2" <?php if(!empty($license_type) && $license_type == '2') { echo "selected"; } ?>>Non-Transport</option>
							</select>
                            <label>License Type</label>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent('driver_form', 'driver_changes.php', 'driver.php');">
                        Submit
                    </button>
                </div>
			</div>
        </form>
		<?php
    } 
    if(isset($_POST['driver_name'])) {	
		$driver_name = ""; $driver_number = ""; $driver_name_error = ""; $driver_number_error = "";
        $expiry_date = ''; $expiry_date_error = ''; $license_type = ''; $license_type_error = '';
        $valid_driver = ""; $form_name = "driver_form";

        $driver_name = $_POST['driver_name'];
        $driver_name_error = $valid->valid_text($driver_name,'driver_name','1');
        if(!empty($driver_name_error)){
            if(!empty($valid_driver)){
                $valid_driver = $valid_driver." ".$valid->error_display($form_name,'driver_name',$driver_name_error,'text');
            }
            else{
                $valid_driver = $valid->error_display($form_name,'driver_name',$driver_name_error,'text');
            }
        }

        if(isset($_POST['driver_number'])){
            $driver_number = $_POST['driver_number'];
            $driver_number_error = $valid->valid_mobile_number($driver_number,'driver_number','1');
            if(!empty($driver_number_error)){
                if(!empty($valid_driver)){
                    $valid_driver = $valid_driver." ".$valid->error_display($form_name,'driver_number',$driver_number_error,'text');
                }
                else{
                    $valid_driver = $valid->error_display($form_name,'driver_number',$driver_number_error,'text');
                }
            }
        }

          if(isset($_POST['expiry_date'])){
            $expiry_date = $_POST['expiry_date'];
            $expiry_date = trim($expiry_date);
            // $expiry_date = date('d-m-Y', strtotime($expiry_date));
            // $expiry_date_error = $valid->valid_date($expiry_date, 'Expiry Date', 0);
            if(empty($expiry_date)){
				$expiry_date_error = "Select License Expiry Date";
			}
            if(!empty($expiry_date_error)) {
                // $valid_driver = $valid->error_display($form_name, "expiry_date", $expiry_date_error, 'text');
                if(!empty($valid_driver)) {
                    $valid_driver = $valid_driver." ".$valid->error_display($form_name, "expiry_date", $expiry_date_error, 'text');
                }
                else {
                    $valid_driver = $valid->error_display($form_name, "expiry_date", $expiry_date_error, 'text');
                }
            }
        }
        if(isset($_POST['license_number'])){
            $license_number = $_POST['license_number'];
            if(!empty($license_number)){
                $license_number_error = $valid->common_validation($license_number,'license_number','0');
            }
            if(!empty($license_number_error)){
                if(!empty($valid_driver)){
                    $valid_driver = $valid_driver." ".$valid->error_display($form_name,'license_number',$license_number_error,'text');
                }
                else{
                    $valid_driver = $valid->error_display($form_name,'license_number',$license_number_error,'text');
                }
            }
        }
      
   
        if(isset($_POST['license_type'])) {
			$license_type = $_POST['license_type'];
            $license_type = trim($license_type);
			if(!empty($license_type)){
	            $license_type_error = $valid->common_validation($license_type, 'license_type', 'select');
			}
		}
        if(!empty($license_type_error)){
            if(!empty($valid_driver)) {
                $valid_driver = $valid_driver." ".$valid->error_display($form_name, "license_type", $license_type_error, 'select');
            }
            else {
                $valid_driver = $valid->error_display($form_name, "license_type", $license_type_error, 'select');
            }
        }
        if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
		}
		
		$result = "";$prev_driver_id = "";$driver_error = "";
		$bill_company_id = $GLOBALS['bill_company_id'];
		if(empty($valid_driver)) {
			$check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {

				if(!empty($driver_name)) {
					$name_array = "";
					$name_array = explode(" ", $driver_name);
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
						$driver_name = implode(" ", $name_array);
					}    
				}
				
				$lower_case_name = "";
				if(!empty($driver_name)) {
					$lower_case_name = strtolower($driver_name);
					$driver_name = $obj->encode_decode('encrypt', $driver_name);
					$lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
				}
                if(!empty($driver_number)){
                    $driver_number = $obj->encode_decode('encrypt',$driver_number);
                }
                
				if(!empty($lower_case_name) && !empty($driver_number)){
                    $prev_driver_id = $obj->CheckDriverAlreadyExists($lower_case_name,$driver_number);
                    if(!empty($prev_driver_id)){
                        $driver_error = "This Driver Name & Number Already Exists";
                    }
                }

                if(!empty($license_number)) {
                    $license_number = $obj->encode_decode('encrypt', $license_number);
                } else {
                    $license_number = $GLOBALS['null_value'];
                }
                if(!empty($expiry_date)) {
                    $expiry_date = date('Y-m-d', strtotime($expiry_date));
                }

				$update_driver_id = "";
				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
				
				if(empty($edit_id)) {
					if(empty($prev_driver_id)){					
                        $action = "";
                        if(!empty($driver_name)) {
                            $action = "New Driver Created. Name - ".$obj->encode_decode('decrypt', $driver_name);
                        }

                        $null_value = $GLOBALS['null_value'];
                        $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id','driver_id', 'driver_name', 'driver_number','lower_case_name','license_number','license_type','expiry_date','deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$driver_name."'", "'".$driver_number."'","'".$lower_case_name."'","'".$license_number."'","'".$license_type."'","'".$expiry_date."'","'0'");

                        $driver_insert_id = $obj->InsertSQL($GLOBALS['driver_table'], $columns, $values, $action);						
                        if(preg_match("/^\d+$/", $driver_insert_id)) {
                            $driver_id = "";
                            if($driver_insert_id < 10) {
                                $driver_id = "DRIVER_".date("dmYhis")."_0".$driver_insert_id;
                            }
                            else {
                                $driver_id = "DRIVER_".date("dmYhis")."_".$driver_insert_id;
                            }
                            if(!empty($driver_id)) {
                                $driver_id = $obj->encode_decode('encrypt', $driver_id);
                            }
                            $columns = array(); $values = array();						
                            $columns = array('driver_id');
                            $values = array("'".$driver_id."'");
                            $driver_update_id = $obj->UpdateSQL($GLOBALS['driver_table'], $driver_insert_id, $columns, $values, '');
                            if(preg_match("/^\d+$/", $driver_update_id)) {		
                                $result = array('number' => '1', 'msg' => 'Driver Successfully Created');					
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $driver_update_id);
                            }
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $driver_insert_id);
                        }	
					}
					else {
                        if (!empty($driver_error)){
                            $result = array('number' => '2', 'msg' => $driver_error);
                        }
					}
				}
				else {
                    if(empty($prev_driver_id) || $prev_driver_id == $edit_id) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['driver_table'], 'driver_id',$edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($driver_name)) {
                                $action = "Driver Updated. Name - ".$obj->encode_decode('decrypt', $driver_name);
                            }
                        
                            $columns = array(); $values = array();
                        
                            $columns = array('creator_name','driver_name', 'driver_number','lower_case_name','license_number','license_type','expiry_date');
                            $values = array("'".$creator_name."'","'".$driver_name."'", "'".$driver_number."'","'".$lower_case_name."'","'".$license_number."'","'".$license_type."'","'".$expiry_date."'");
                            
                            $driver_update_id = $obj->UpdateSQL($GLOBALS['driver_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $driver_update_id)) {	
                                $update_driver_id = $edit_id;
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');						
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $driver_update_id);
                            }							
                        }
                    }
                    else {
                        if(!empty($driver_error)){
                            $result = array('number' => '2', 'msg' => $driver_error);
                        }
                    }
				}
				
			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_driver)) {
				$result = array('number' => '3', 'msg' => $valid_driver);
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
        $total_records_list = $obj->getTableRecords($GLOBALS['driver_table'], '', '');
				
		if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($total_records_list)) {
				foreach($total_records_list as $val) {
					if( (strpos(strtolower($obj->encode_decode('decrypt', $val['driver_name'])), $search_text) !== false) ) {
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
        
		<table class="table nowrap cursor bg-white text-center">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Driver Name</th>
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
                                <div class="w-100">
                                    <?php
                                    $driver_name ="";
                                        if(!empty($list['driver_name'])) {
                                            $driver_name = $obj->encode_decode('decrypt', $list['driver_name']);
                                            echo $driver_name;
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
                                    if(!empty($list['driver_number'])) {
                                        $list['driver_number'] = $obj->encode_decode('decrypt', $list['driver_number']);
                                        echo $list['driver_number'];
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
                                        <a class="pr-2" href="#" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['driver_id'])) { echo $list['driver_id']; } ?>');"><i class="fa fa-pencil"></i></a>
                                <?php } ?>
                                <?php
                                    $access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_action = $delete_action;
                                        include('permission_action.php');
                                    }  
                                    if(empty($access_error)) {

                                    $check_linked = 0;
                                    $check_linked = $obj->getTableColumnValue($GLOBALS['tripsheet_table'],'driver_name',$list['driver_name'],'id');
                                        // echo $check_linked ."kl";
                                     if(!empty($check_linked)) { ?>
                                    <span title="This Driver can't be deleted">                           
                                            <a  class="p-2 text-secondary"  style="pointer-events: none; cursor: default;" > <i class="fa fa-trash" title="delete"></i> </a>
                                        </span>
                                    <?php }else{ ?>
                                        <a class="pr-2" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['driver_id'])) { echo $list['driver_id']; } ?>');"><i class="fa fa-trash"></i></a>
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
                        <td colspan="4" class="text-center">Sorry! No records found</td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>
                      
		<?php	
		}
	}
	if(isset($_REQUEST['delete_driver_id'])) {
		$delete_driver_id = $_REQUEST['delete_driver_id'];
		$msg = "";
		if(!empty($delete_driver_id)) {
			$driver_unique_id = "";
			$driver_unique_id = $obj->getTableColumnValue($GLOBALS['driver_table'], 'driver_id', $delete_driver_id, 'id');
			
			if(!empty($driver_unique_id)) {
				if(preg_match("/^\d+$/", $driver_unique_id)) {
					$driver_name = "";
					$driver_name = $obj->getTableColumnValue($GLOBALS['driver_table'], 'driver_id', $delete_driver_id, 'driver_name');
				
					$action = "";
					if(!empty($driver_name)) {
						$action = "Driver Deleted. Name - ".$obj->encode_decode('decrypt', $driver_name);
					}

					$columns = array(); $values = array();						
					$columns = array('deleted');
					$values = array("'1'");
					$msg = $obj->UpdateSQL($GLOBALS['driver_table'], $driver_unique_id, $columns, $values, $action);
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