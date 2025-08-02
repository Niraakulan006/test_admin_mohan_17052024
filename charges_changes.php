<?php
    include("include_files.php");

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['charges_module'];
        }
    }

    if(isset($_REQUEST['show_charges_id'])) {
        $show_charges_id = "";
        $show_charges_id = $_REQUEST['show_charges_id'];

        $charges_name = "";
        if(!empty($show_charges_id)) {
            $charges_list = array();
            $charges_list = $obj->getTableRecords($GLOBALS['charges_table'], 'charges_id', $show_charges_id, '');
            if(!empty($charges_list)) {
                foreach ($charges_list as $data) {
                    if(!empty($data['charges_name'])) {
                        $charges_name = $obj->encode_decode('decrypt', $data['charges_name']);
                    }
                }
            }
        } 
        ?>
        <form class="poppins pd-20 redirection_form" name="charges_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8">
						<?php if(!empty($show_charges_id)){ ?>
                            <div class="text-white">Edit Charges</div>
                        <?php 
                        } else{ ?>
                            <div class="text-white">Add Charges</div>
                        <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-right" style="font-size:11px;" type="button" onclick="window.open('charges.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_charges_id)) {  echo $show_charges_id; } ?>">
                <div class="col-lg-8 col-md-10 col-10">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-8 col-12">
                            <div class="form-label-group in-border">
                                <div class="input-group mb-1">
                                    <input type="text" id="charges_name" name="charges_name" value="<?php if(!empty($charges_name)) { echo $charges_name; } ?>" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',50,'');" onkeyup="Javascript:InputBoxColor(this,'text');">
                                    <label>Charges Name <span class="text-danger">*</span></label>
                                    <?php if(empty($show_charges_id)) { ?>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" type="button" onclick="Javascript:addCreationDetails('charges', 50);"><i class="fa fa-plus"></i></button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="new_smallfnt">Text,Symbols,&'' Only (Character up to 50)</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center"> 
                <?php if(empty($show_charges_id)) { ?>
                <div class="col-lg-6">
                    <div class="table-responsive text-center">
                        <input type="hidden" name="charges_count" value="0">
                        <table class="table nowrap cursor smallfnt w-100 table-bordered added_charges_table">
                            <thead class="bg-secondary text-white smallfnt">
                                <tr style="white-space:pre;">
                                    <th>#</th>
                                    <th>Charges Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody> 
                        </table>
                    </div>
                </div>
                <?php } ?>
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-dark" type="button" onClick="Javascript:SaveModalContent('charges_form', 'charges_changes.php', 'charges.php');">
                        Submit
                    </button>
                </div>
            </div>
             <script>
                $(document).ready(function() {
                    jQuery('#charges_name').on("keypress", function(e) {
                        if(e.keyCode == 13) {
                            addCreationDetails('charges', 50);
                            return false;
                        }
                    });
                });
            </script>
            
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    }

    if(isset($_POST['edit_id'])) {
        $charges_name = array(); $charges_name_error = ""; $single_lower_case_name = "";
        $valid_charges = ""; $form_name = "charges_form"; $charges_error = "";
        $single_charges_name = ""; $prev_charges_id = ""; $lower_case_name = array();

        $edit_id = "";
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }
        if(!empty($edit_id)) {
            if(isset($_POST['charges_name'])) {
                $single_charges_name = $_POST['charges_name'];
                $single_charges_name = trim($single_charges_name);
                $charges_name_error = $valid->valid_product_name($single_charges_name, "Charges Name", "1", "50");
                // if(!preg_match("/^(?=.*[a-zA-Z])[^?!<>$+=`~_|?;^{}]*$/", $single_charges_name) || strlen($single_charges_name) > 50) {
                if(!empty($charges_name_error)){
                    $charges_name_error = "Invalid Charges name";
                }
                // }
            }
            if(!empty($charges_name_error)) {
                $valid_charges = $valid->error_display($form_name, "charges_name", $charges_name_error, 'text');
            }
            else {
                $single_lower_case_name = strtolower($single_charges_name);
                $single_charges_name = $obj->encode_decode("encrypt", $single_charges_name);
                $single_lower_case_name = $obj->encode_decode("encrypt", $single_lower_case_name);
                if(!empty($single_lower_case_name)) {
                    $prev_charges_id = $obj->CheckChargesAlreadyExists('', $single_lower_case_name);
                    if(!empty($prev_charges_id)) {
                        if($prev_charges_id != $edit_id) {
                            $charges_error = "This Charges name - " . $obj->encode_decode("decrypt", $single_lower_case_name) . " is already exist";
                        }
                    }
                }
            }
        }

        if(empty($edit_id)) {
            if(isset($_POST['charges_names'])) {
                $charges_name = $_POST['charges_names'];
            }
            $inputbox_charges_name = "";
            $inputbox_charges_name = $_POST['charges_name'];

            if(!empty($inputbox_charges_name) && empty($charges_name)) {
                $charges_add_error = "Click Add Button to Append Charges";
                if(!empty($charges_add_error)) {
                    $valid_charges = $valid->error_display($form_name, "charges_name", $charges_add_error, 'text');
                }
            } else if(empty($inputbox_charges_name) && empty($charges_name)) {
                $charges_add_error = "Enter Charges Name";
                if(!empty($charges_add_error)) {
                    $valid_charges = $valid->error_display($form_name, "charges_name", $charges_add_error, 'text');
                }
            } else if(!empty($inputbox_charges_name)) {
                $charges_add_error = "Click Add Button to Append Charges";
                if(!empty($charges_add_error)) {
                    $valid_charges = $valid->error_display($form_name, "charges_name", $charges_add_error, 'text');
                }
            }
            if(!empty($charges_name)) {
                for ($p = 0; $p < count($charges_name); $p++) {
                    // if(!preg_match("/^(?=.*[a-zA-Z])[^?!<>$+=`~_|?;^{}]*$/", $charges_name[$p]) || strlen($charges_name[$p]) > 50) {
                      $charges_name_error = $valid->valid_product_name($charges_name[$p], "Charges Name", "1", "50");
                    if(!empty($charges_name_error)){
                        $charges_name_error = "Invalid Charges name - " . $charges_name[$p];
                    }
                    else {
                        $lower_case_name[$p] = strtolower($charges_name[$p]);
                        $charges_name[$p] = $obj->encode_decode('encrypt', $charges_name[$p]);
                        $lower_case_name[$p] = $obj->encode_decode('encrypt', $lower_case_name[$p]);
                        
                    }

                    if(!empty($charges_name_error)) {
                        if(!empty($valid_charges)) {
                            $valid_charges = $valid_charges." ".$valid->error_display($form_name, "charges_name", $charges_name_error, 'text');
                        }
                        else {
                            $valid_charges = $valid->error_display($form_name, "charges_name", $charges_name_error, 'text');
                        }
                    }
                }
            }
        }

        $result = "";
        if(empty($valid_charges) && empty($charges_name_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();

            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $bill_company_id = $GLOBALS['bill_company_id'];
                for ($i = 0; $i < count($lower_case_name); $i++) {
                    if(!empty($lower_case_name[$i])) {
                        $prev_charges_id = $obj->CheckChargesAlreadyExists('', $lower_case_name[$i]);
                        if(!empty($prev_charges_id)) {
                            $charges_error = "This Charges name - " . $obj->encode_decode("decrypt", $lower_case_name[$i]) . " is already exist";
                        }
                    }
                }
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
            
                if(empty($charges_error)) {
                    if(empty($edit_id)) {
                        $action = array();
                        for ($p = 0; $p < count($charges_name); $p++) {
                            if(empty($prev_charges_id)) {
                                if(!empty($charges_name[$p])) {
                                    $action[$p] = "New Charges Created. Name - " . $obj->encode_decode('decrypt', $charges_name[$p]);
                                }
                            
                                $null_value = $GLOBALS['null_value'];
                                $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'charges_id', 'charges_name', 'lower_case_name', 'deleted');
                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'","'".$null_value."'", "'".$charges_name[$p]."'", "'".$lower_case_name[$p]."'", "'0'");

                                    $charges_insert_id = $obj->InsertSQL($GLOBALS['charges_table'], $columns, $values, $action[$p]);
                                    if(preg_match("/^\d+$/", $charges_insert_id)) {
                                        $charges_id = "";
                                        if($charges_insert_id < 10) {
                                            $charges_id = "CHARGES_".date("dmYhis")."_0".$charges_insert_id;
                                        }
                                        else {
                                            $charges_id = "CHARGES_".date("dmYhis")."_".$charges_insert_id;
                                        }
                                        if(!empty($charges_id)) {
                                            $charges_id = $obj->encode_decode('encrypt', $charges_id);
                                        }
                                        $columns = array(); $values = array();						
                                        $columns = array('charges_id');
                                        $values = array("'".$charges_id."'");
                                        $charges_update_id = $obj->UpdateSQL($GLOBALS['charges_table'], $charges_insert_id, $columns, $values, '');
                                        if(preg_match("/^\d+$/", $charges_update_id)) {	
                                            $update_charges_id = $charges_id;	
                                            $result = array('number' => '1', 'msg' => 'Charges Successfully Created');					
                                        }
                                        else {
                                            $result = array('number' => '2', 'msg' => $charges_update_id);
                                        }
                                    }
                                    else {
                                        $result = array('number' => '2', 'msg' => $charges_insert_id);
                                    }
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $charges_error);
                            }
                        }
                    } 
                    else if(!empty($edit_id)) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($single_charges_name)) {
                                $action = "Charges Updated. Name - " . $obj->encode_decode('decrypt', $single_charges_name);
                            }

                            $columns = array(); $values = array();
                            $columns = array('creator_name', 'charges_name', 'lower_case_name');
                            $values = array("'".$creator_name."'", "'".$single_charges_name."'", "'".$single_lower_case_name."'");
                            $charges_update_id = $obj->UpdateSQL($GLOBALS['charges_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $charges_update_id)) {
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');
                            } 
                            else {
                                $result = array('number' => '2', 'msg' => $charges_update_id);
                            }
                        }
                    }
                } 
                else {
                    $result = array('number' => '2', 'msg' => $charges_error);
                }
            } 
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_charges)) {
                $result = array('number' => '3', 'msg' => $valid_charges);
            }
        }

        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result;
        exit;
    }

    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title']; 
        
        $search_text = "";
        if(isset($_POST['search_text'])) {
            $search_text = $_POST['search_text'];
            $search_text = trim($search_text);
        }

        $total_records_list = array();
        $total_records_list = $obj->getTableRecords($GLOBALS['charges_table'], '', '','');

        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if((strpos(strtolower(html_entity_decode($obj->encode_decode('decrypt', $val['charges_name']))), $search_text) !== false)) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }

        $total_pages = 0;
        $total_pages = count($total_records_list);

        $page_start = 0;
        $page_end = 0;
        if(!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
            if($total_pages > $page_limit) {
                if($page_number) {
                    $page_start = ($page_number - 1) * $page_limit;
                    $page_end = $page_start + $page_limit;
                }
            } else {
                $page_start = 0;
                $page_end = $page_limit;
            }
        }

        $show_records_list = array();
        if(!empty($total_records_list)) {
            foreach ($total_records_list as $key => $val) {
                if($key >= $page_start && $key < $page_end) {
                    $show_records_list[] = $val;
                }
            }
        }

        $prefix = 0;
        if(!empty($page_number) && !empty($page_limit)) {
            $prefix = ($page_number * $page_limit) - $page_limit;
        }
        if($total_pages > $page_limit) { ?>
            <div class="pagination_cover mt-3">
                <?php
                include("pagination.php");
                ?>
            </div>
            <?php 
        } 
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        if(empty($access_error)) { ?>
            <table class="table nowrap cursor text-center smallfnt">
                <thead class="bg-light">
                    <tr>
                        <th>S.No</th>
                        <th>Charges</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(!empty($show_records_list)) {
                        $count_charges = 0;
                        foreach ($show_records_list as $key => $list) {
                            $index = $key + 1;
                            if(!empty($prefix)) {
                                $index = $index + $prefix;
                            } 
                            ?>
                            <tr style="cursor:default;">
                                <td><?php echo $index; ?></td>
                                <td class="text-center">
                                    <?php
                                        $charges_name = "";
                                        if(!empty($list['charges_name'])) {
                                            $charges_name = $list['charges_name'];
                                            $charges_name = $obj->encode_decode('decrypt', $charges_name);
                                            echo $charges_name;
                                        }
                                    ?>
                                    <div class="w-100 py-2">
                                        <?php
                                            if(!empty($list['creator_name'])) {
                                                $list['creator_name'] = $obj->encode_decode('decrypt', $list['creator_name']);
                                                echo "Creator : ". $list['creator_name'];
                                            }
                                        ?>                                        
                                    </div>
                                </td>
                                <?php 
                                $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_action = $edit_action;
                                    include('permission_action.php');
                                }
                                ?>
                                    <td>
                                      
                                        <?php
                                        if(empty($access_error)) { ?>
                                           <a href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['charges_id'])) { echo $list['charges_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp;</a>
                                            <?php 
                                        } 
                                        $access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $delete_action;
                                            include('permission_action.php');
                                        } 
                                        if(empty($access_error)) {
                                            $linked_count = 0;
                                            $linked_count = $obj->GetChargesLinkedCount($list['charges_id']);
                                            if(!empty($linked_count)) { ?>
                                                <span title="This Product can't be deleted">                           

                                                     <a style="cursor:pointer; color: #22223057 !important"><i class="fa fa-trash"></i> &ensp; </a>
                                                </span>
                                                <?php 
                                            }else{ ?>
                                               <a onclick="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title;} ?>', '<?php if(!empty($list['charges_id'])) { echo $list['charges_id']; } ?>');"><i class="fa fa-trash"></i> &ensp; </a>
                                                <?php 
                                            }
                                        } ?>
                                    </td>
                                   
                            </tr>
                            <?php
                        }
                    } 
                    else { ?>
                        <tr>
                            <td colspan="3" class="text-center">Sorry! No records found</td>
                        </tr>
                        <?php 
                    } ?>
                </tbody>
            </table>            
		    <?php	
	    }
    } 
    
    
    if(isset($_REQUEST['charges_row_index'])) {
        $charges_row_index = $_REQUEST['charges_row_index'];
        $selected_charges_name = $_REQUEST['selected_charges_name'];
        // $selected_charges_name = htmlentities($selected_charges_name, ENT_QUOTES);
        ?>
        <tr class="charges_row" id="charges_row<?php if(!empty($charges_row_index)) { echo $charges_row_index; } ?>">
            <td class="text-center sno"><?php if(!empty($charges_row_index)) { echo $charges_row_index; } ?></td>
            <td class="text-center">
                <?php
                    if(!empty($selected_charges_name)) {
                           $selected_charges_name = str_replace('^','"', $selected_charges_name);
                        $selected_charges_name = str_replace('$',"&", $selected_charges_name);
                        $selected_charges_name = str_replace("@@","'", $selected_charges_name);
                        $selected_charges_name = str_replace("**","+", $selected_charges_name);
                        $selected_charges_name = str_replace("!!","#", $selected_charges_name);
                         $selected_charges_name = htmlentities($selected_charges_name, ENT_QUOTES);
                        echo $selected_charges_name;
                    }    
                ?>
                <input type="hidden" name="charges_names[]" value="<?php if(!empty($selected_charges_name)) { echo $selected_charges_name; } ?>">
            </td>
            <td class="text-center product_pad">
                <button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteCreationRow('charges', '<?php if(!empty($charges_row_index)) { echo $charges_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
        <?php
    }

    if(isset($_REQUEST['delete_charges_id'])) {
        $delete_charges_id = $_REQUEST['delete_charges_id'];
        $msg = "";
        if(!empty($delete_charges_id)) {
            $charges_unique_id = "";
            $charges_unique_id = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $delete_charges_id, 'id');
            if(preg_match("/^\d+$/", $charges_unique_id)) {
                $charges_name = "";
                $charges_name = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $delete_charges_id, 'charges_name');

                $action = "";
                if(!empty($charges_name)) {
                    $action = "Charges Deleted. Name - " . $obj->encode_decode('decrypt', $charges_name);
                }
                $linked_count = 0;
                // $linked_count = $obj->GetChargesLinkedCount($delete_charges_id);
                if(empty($linked_count)) {
                    $columns = array();
                    $values = array();
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['charges_table'], $charges_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "This Charges is associated with other screens";
                }
            }
        }
        echo $msg;
        exit;
    }
?>