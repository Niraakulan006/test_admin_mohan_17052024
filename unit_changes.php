<?php
	include("include_files.php");

	$login_staff_id = "";
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
			$login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			$permission_module = $GLOBALS['unit_module'];
		}
	}
	
	if(isset($_REQUEST['show_unit_id'])) { 
        $show_unit_id = $_REQUEST['show_unit_id'];


        $name = ""; $username = ""; $password = ""; $unit_contact_number = "";
        if(!empty($show_unit_id)) {
            $staff_list = array();
			$staff_list = $obj->getTableRecords($GLOBALS['unit_table'], 'unit_id', $show_unit_id);
            if(!empty($staff_list)) {
                foreach($staff_list as $data) {
                    if(!empty($data['unit_name'])) {
                        $name = $obj->encode_decode('decrypt', $data['unit_name']);
						// $name = strtoupper($name);
					}
                }
            }
		} ?>
        <form class="poppins pd-20" name="unit_form" method="POST">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
                        <?php if(!empty($show_bank_id)){ ?>
                            <div class="text-white">Edit LR Product</div>
                        <?php 
                        } else{ ?>
                            <div class="text-white">Add LR Product</div>
                        <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('unit.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
			<div class="row justify-content-center p-3">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_unit_id)) { echo $show_unit_id; } ?>">
                <div class="col-lg-8 col-md-8 col-10">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="form-label-group in-border pb-2">
                                <div class="input-group mb-1">
                                    <input type="text" id="unit_name" name="unit_name" class="form-control shadow-none" placeholder="LR Product" value="<?php if(!empty($name)){ echo $name; }?>" required>
                                    <label>LR Product</label>
									<?php if(empty($show_unit_id)) { ?>
										<div class="input-group-append">
											<button class="btn btn-danger" type="button" onClick="Javascript:addUnitDetails();"><i class="fa fa-plus"></i></button>
										</div>
									<?php } ?>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>     
                <?php if(empty($show_unit_id)) { ?>
					<div class="col-lg-6 col-md-6 col-12">
						<div class="table-responsive smallfnt text-center">
						<input type="hidden" name="unit_count" value="<?php if(!empty($unit_row_index)) { echo $unit_row_index; } else { echo "0"; } ?>">
							<table class="table nowrap cursor table-bordered text-center added_unit_table">
								<thead class="bg-pinterest">
									<tr class="text-white">
										<th>S.No</th>
										<th>LR Product</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($show_unit_id)) { ?>
										<tr class="unit_row" id="unit_row<?php if(!empty($unit_row_index)) { echo $unit_row_index; } ?>">
											<td class="text-center sno"><?php if(!empty($unit_row_index)) { echo $unit_row_index; } ?></td> 
											<td class="text_center">
												<?php
													if(!empty($selected_unit_name)) {
														$selected_unit_name = str_replace("$","&", $selected_unit_name);
														$selected_unit_name = str_replace("^",'"', $selected_unit_name);
														echo $selected_unit_name; 
														$selected_unit_name = str_replace('"',"^", $selected_unit_name);
														$selected_unit_name = str_replace("'","!!", $selected_unit_name); ?>
													
													<input type="hidden" name="unit_names[]" value="<?php if(!empty($selected_unit_name)) { echo $selected_unit_name; } ?>">
												<?php }	?>	
											</td>		
											<td class="text-center product_pad">
												<a class="pr-2" href="Javascript:DeleteUnitRow('<?php if(!empty($unit_row_index)) { echo $unit_row_index; } ?>');" data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>
											</td>    
										</tr>
									<?php } ?>
								</tbody>
							</table>    
						</div>
					</div>
				<?php } ?>
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent('unit_form', 'unit_changes.php', 'unit.php');">
                        Submit
                    </button>
                </div>  
			</div>
            <script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('form[name="unit_form"]').find('select').select2();
				});   
			</script>
        </form>
		<?php
    } 
    if(isset($_POST['unit_name'])) {	
		$unit_name = array(); $unit_name_error = ""; $edit_id = ""; $single_unit_name = ""; $single_lower_case_name = "";
        $valid_unit = ""; $form_unit_name = "unit_form";
	
		if(isset($_POST['unit_name']))
		{
			$single_unit_name = $_POST['unit_name'];
            $single_lower_case_name = strtolower($single_unit_name);
            $single_unit_name = $obj->encode_decode("encrypt", $single_unit_name);
            $single_lower_case_name = $obj->encode_decode("encrypt", $single_lower_case_name);
		}
		
		if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
		}
		if(empty($edit_id)) {
    
            if(isset($_POST['unit_names'])) {
                $unit_name = $_POST['unit_names'];
            }
            else {
                $unit_name_error = "Enter LR Product";
                
                if(!empty($unit_name_error)) {
                    $valid_unit = $valid->error_display($form_name, "unit_name", $unit_name_error, 'text');			
                }
            }
    
            if(!empty($unit_name)) {
    
                for($p = 0; $p < count($unit_name); $p++) {    
                    // echo $unit_name[0];
    
                    if(empty($unit_name[$p])){
                        $unit_name_error = "Enter Unit";
                    }
            
                    if(!empty($unit_name_error)) {
                        $valid_unit = $valid->error_display($form_name, "unit_name", $unit_name_error, 'text');			
                    }
                }
            }
        }
		
		$result = "";
		
		if(empty($valid_unit)) {
			$check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {

				$lower_case_name = array();
                    // print_r($unit_name);
                    for($p = 0; $p < count($unit_name); $p++) {
                        if(!empty($unit_name[$p])) {
                            // echo "unit-".$unit_name[$p];
                            
                            $lower_case_name[$p] = strtolower($unit_name[$p]);
                            // echo "lower-".$lower_case_name[$p];
                            $unit_name[$p] = $obj->encode_decode('encrypt', $unit_name[$p]);
                            $lower_case_name[$p] = $obj->encode_decode('encrypt', $lower_case_name[$p]);

                            // echo "unit-".$unit_name[$p];
                            // echo "lower-".$lower_case_name[$p];
                        }
                    }

                    // print_r($lower_case_name);
                        
                            $prev_unit_id = ""; $unit_error = "";
                        for($i = 0; $i< count($lower_case_name); $i++) {	
                            // echo count($lower_case_name)."/";
                            // echo $i."/";
                            if(!empty($lower_case_name[$i]) && !empty($bill_company_id)) {
                                // echo $lower_case_name[$i]."/";
                                $prev_unit_id = $obj->CheckUnitNameAlreadyExists($bill_company_id, $lower_case_name[$i]);
                                if(!empty($prev_unit_id)) {
                                    $unit_error = "This LR Product - ".$obj->encode_decode("decrypt", $lower_case_name[$i])." is already exist";
                                }
                            }
                        }
				
				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
				
				if(empty($edit_id)) {
					for($p= 0; $p < count($unit_name); $p++) {
						if(empty($prev_unit_id)) {						
							$action = "";
							if(!empty($unit_name[$p])) {
								$action = "New LR Product Created. Name - ".$obj->encode_decode('decrypt', $unit_name[$p]);
							}

							$null_value = $GLOBALS['null_value'];
							$columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'unit_id', 'unit_name', 'lower_case_name', 'deleted');
							$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$unit_name[$p]."'", "'".$lower_case_name[$p]."'", "'0'");
							$unit_insert_id = $obj->InsertSQL($GLOBALS['unit_table'], $columns, $values, $action);						
							if(preg_match("/^\d+$/", $unit_insert_id)) {
								$unit_id = "";
								if($unit_insert_id < 10) {
									$unit_id = "UNIT_".date("dmYhis")."_0".$unit_insert_id;
								}
								else {
									$unit_id = "UNIT_".date("dmYhis")."_".$unit_insert_id;
								}
								if(!empty($unit_id)) {
									$unit_id = $obj->encode_decode('encrypt', $unit_id);
								}
								$columns = array(); $values = array();						
								$columns = array('unit_id');
								$values = array("'".$unit_id."'");
								$unit_update_id = $obj->UpdateSQL($GLOBALS['unit_table'], $unit_insert_id, $columns, $values, '');
								if(preg_match("/^\d+$/", $unit_update_id)) {	
									$update_unit_id = $unit_id;	
									$result = array('number' => '1', 'msg' => 'LR Product Successfully Created');					
								}
								else {
									$result = array('number' => '2', 'msg' => $unit_update_id);
								}
							}
							else {
								$result = array('number' => '2', 'msg' => $unit_insert_id);
							}
						}
						else {
							$result = array('number' => '2', 'msg' => $unit_error);
						}
					}
				}
				else {
					if(empty($prev_unit_id) || $prev_unit_id == $edit_id) {
						$getUniqueID = "";
						$getUniqueID = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $edit_id, 'id');
						if(preg_match("/^\d+$/", $getUniqueID)) {
							$action = "";
							if(!empty($single_unit_name)) {
                                $action = "LR Product Updated. Name - ".$obj->encode_decode('decrypt', $single_unit_name);
                            }
						
							$columns = array(); $values = array();						
							$columns = array('creator_name', 'unit_name', 'lower_case_name');
							$values = array("'".$creator_name."'", "'".$single_unit_name."'", "'".$single_lower_case_name."'");
							$unit_update_id = $obj->UpdateSQL($GLOBALS['unit_table'], $getUniqueID, $columns, $values, $action);
							if(preg_match("/^\d+$/", $unit_update_id)) {
								$result = array('number' => '1', 'msg' => 'Updated Successfully');						
							}
							else {
								$result = array('number' => '2', 'msg' => $unit_update_id);
							}							
						}
					}
					else {
						$result = array('number' => '2', 'msg' => $unit_error);
					}
                }

			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_unit)) {
				$result = array('number' => '3', 'msg' => $valid_unit);
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
		
		$total_records_list = $obj->getTableRecords($GLOBALS['unit_table'], '', '');

		if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($total_records_list)) {
				foreach($total_records_list as $val) {
					if( (strpos(strtolower($obj->encode_decode('decrypt', $val['unit_name'])), $search_text) !== false) ) {
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
		}
?>
        
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
        
		<table class="table nowrap cursor text-center">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>LR Product</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
					if(!empty($show_records_list)) {
						// $edit_action = $obj->encode_decode('encrypt', 'edit_action');
						$delete = 1;
						foreach($show_records_list as $key => $data) {

							$index = $key + 1;
							if(!empty($prefix)) { $index = $index + $prefix; } ?>
                                <tr>
                                    <td><?php echo $index; ?></td>
                                    <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['unit_id'])) { echo $data['unit_id']; } ?>');">
                                        <div class="w-100">
                                            <?php
                                                if(!empty($data['unit_name'])) {
                                                    $data['unit_name'] = $obj->encode_decode('decrypt', $data['unit_name']);
                                                    echo $data['unit_name'];
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
                                    <td>
                                    <?php $access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $edit_action;
                                            include('permission_action.php');
                                        }
                                        if(empty($access_error)) { ?>
                                        <a class="pr-2" href="#"  onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['unit_id'])) { echo $data['unit_id']; } ?>');"><i class="fa fa-pencil"></i></a>
                                        <?php } ?>
                                        <?php
                                            $access_error = "";
                                            if(!empty($login_staff_id)) {
                                                $permission_action = $delete_action;
                                                include('permission_action.php');
                                            } 
                                            if(empty($access_error)) {
												   $linked_count = 0;
                                                    $linked_count = $obj->GetUnitLinkedCount($data['unit_id']); 

												  if($linked_count > 0) {
                                                        ?>                                        

                                                        <span title="This LR Product can't be deleted">                           
                                                            <a  class="text-secondary"  style="pointer-events: none; cursor: default;" > <i class="fa fa-trash" title="delete"></i>&ensp;</a>
                                                        </span>

                                                <?php }else{ ?>
                                                <a class="pr-2" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['unit_id'])) { echo $data['unit_id']; } ?>');"><i class="fa fa-trash"></i></a>
										<?php }
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
        <?php	
		}
	}
	if(isset($_REQUEST['unit_row_index'])) {
		$unit_row_index = $_REQUEST['unit_row_index'];
		$selected_unit_name = $_REQUEST['selected_unit_name'];
		?>
	
		<tr class="unit_row" id="unit_row<?php if(!empty($unit_row_index)) { echo $unit_row_index; } ?>">
			<td class="text-center sno"></td> 
			<td class="text_center">
				<?php
					if(!empty($selected_unit_name)) {
						$selected_unit_name = str_replace("$","&", $selected_unit_name);
						$selected_unit_name = str_replace("^",'"', $selected_unit_name);
						echo $selected_unit_name; 
						$selected_unit_name = str_replace('"',"^", $selected_unit_name);
						$selected_unit_name = str_replace("'","!!", $selected_unit_name); ?>
					
					<input type="hidden" name="unit_names[]" value="<?php if(!empty($selected_unit_name)) { echo $selected_unit_name; } ?>">
				<?php }	?>	
			</td>		
			<td class="text-center product_pad">
				<button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteUnitRow('<?php if(!empty($unit_row_index)) { echo $unit_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
			</td>    
		</tr>
		<script type="text/javascript">
			calTotal();
			jQuery('.add_update_form_content').find('select').select2();
		</script>  
		<?php        
	}
	if(isset($_REQUEST['delete_unit_id'])) {
		$delete_unit_id = $_REQUEST['delete_unit_id'];
		$msg = "";
		if(!empty($delete_unit_id)) {
			$unit_unique_id = "";
			$unit_unique_id = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $delete_unit_id, 'id');

			// $primary_unit = "";
			// $primary_unit = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $delete_unit_id, 'primary_unit');
			if(!empty($unit_unique_id)) {
				if(preg_match("/^\d+$/", $unit_unique_id)) {
					$name = "";
					$name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $delete_unit_id, 'unit_name');
				
					$action = "";
					if(!empty($name)) {
						$action = "LR Product Deleted. Name - ".$obj->encode_decode('decrypt', $name);
					}

					$columns = array(); $values = array();						
					$columns = array('deleted');
					$values = array("'1'");
					$msg = $obj->UpdateSQL($GLOBALS['unit_table'], $unit_unique_id, $columns, $values, $action);
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