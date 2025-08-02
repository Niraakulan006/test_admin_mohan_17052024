<?php
	include("include_files.php");
	
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['expense_category_module'];
        }
    }
    
    if(isset($_REQUEST['show_expense_category_id'])) { 
        $show_expense_category_id = "";
        $show_expense_category_id = $_REQUEST['show_expense_category_id'];

        $expense_category_name = "";
        $expense_category_id = "";
        if (!empty($show_expense_category_id)) {
            $expense_category_list = array();
            $expense_category_list = $obj->getTableRecords($GLOBALS['expense_category_table'], 'expense_category_id', $show_expense_category_id, '');
            if (!empty($expense_category_list)) {
                foreach ($expense_category_list as $data) {
                    if (!empty($data['expense_category_name'])) {
                        $expense_category_name = $obj->encode_decode('decrypt', $data['expense_category_name']);
                    }
                    if (!empty($data['expense_category_id'])) {
                        $expense_category_id = $obj->encode_decode('decrypt', $data['expense_category_id']);
                    }
                }
            }
        } ?>

        <form class="poppins pd-20 redirection_form" name="expense_category_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center text-white">  <?php 
                        if(!empty($show_expense_category_id)){ ?>
                            <div class="h5">Edit Expense Category</div> <?php 
                        } 
                        else { ?>
                            <div class="h5">Add Expense Category</div> <?php
                        } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('expense_category.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_expense_category_id)) { echo $show_expense_category_id; } ?>">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control shadow-none" id="expense_category_name" name="expense_category_name" value="<?php if (!empty($expense_category_name)) { echo $expense_category_name;} ?>" maxlength="50">
                                <label>Expense Category</label> <?php 
                                if (empty($show_expense_category_id)) { ?>
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" type="button" onClick="Javascript:addExpenseCategoryDetails();"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div> <?php 
                                } ?>
                            </div>
                        </div>
                        <div class="new_smallfnt">Contains Text, Symbols &amp;, -,',.</div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center"> <?php 
                if (empty($show_expense_category_id)) { ?>
                    <div class="col-lg-6">
                        <div class="table-responsive text-center">
                            <input type="hidden" name="expense_category_count" value="<?php if (!empty($expense_category_row_index)) {  echo $expense_category_row_index; } else { echo "0";  } ?>">
                            <table class="table nowrap cursor smallfnt w-100 table-bordered added_expense_category_table fw-bold">
                                <thead class="bg-dark text-white">
                                    <tr style="white-space:pre;">
                                        <th>#</th>
                                        <th>Expense Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div> <?php
                } ?>

                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-danger" type="button" onClick="Javascript:SaveModalContent('expense_category_form', 'expense_category_changes.php', 'expense_category.php');">
                        Submit
                    </button>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    jQuery('#expense_category_name').on("keypress", function(e) {
                        if (e.keyCode == 13) {
                            addExpenseCategoryDetails();
                            return false; // prevent the button click from happening
                        }
                    });
                });
            </script>

        </form>
		<?php
    } 
    
    if (isset($_POST['expense_category_name'])) {
        $expense_category_name = array();
        $expense_category_name_error = "";
        $edit_id = "";
        $single_lower_case_name = "";
        $valid_expense_category = "";
        $form_name = "expense_category_form";
        $expense_category_error = "";
        $single_expense_category_name = "";
        $bill_company_id = "";

        if (isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
        }
        
        if (!empty($edit_id)) {
            if (isset($_POST['expense_category_name'])) {
                $single_expense_category_name = $_POST['expense_category_name'];
    
                if (strlen($single_expense_category_name) > 50) {
                    $expense_category_name_err = "Only 50 characters allowed";
                    if (!empty($expense_category_name_err)) {
                        $valid_expense_category = $valid->error_display($form_name, "expense_category_name", $expense_category_name_err, 'text');
                    }
                }
    
                // echo ($single_expense_category_name);
                if (!empty($single_expense_category_name)) {
                    $expense_category_error = $valid->valid_name_text($single_expense_category_name, "Expense Category Name", "1",'50');
                    if (!empty($expense_category_error)) {
                        $valid_expense_category = $valid->error_display($form_name, "expense_category_name", $expense_category_error, 'text');
                    }
                } else {
                    $expense_category_name_error = "Enter Expense Category Name";
                    if (!empty($expense_category_name_error)) {
                        $valid_expense_category = $valid->error_display($form_name, "expense_category_name", $expense_category_name_error, 'text');
                    }
                }
                $single_lower_case_name = strtolower($single_expense_category_name);
                $single_lower_case_name = trim($single_lower_case_name);
                $single_expense_category_name = $obj->encode_decode("encrypt", $single_expense_category_name);
                $single_lower_case_name = $obj->encode_decode("encrypt", $single_lower_case_name);
                if (!empty($single_lower_case_name)) {
                    $prev_expense_category_id = $obj->CheckExpenseCategoryAlreadyExists($bill_company_id,$single_lower_case_name);
    
                    if (!empty($prev_expense_category_id)) {
                        if ($prev_expense_category_id != $edit_id) {
                            $expense_category_error = "This Expense Category name - " . $obj->encode_decode("decrypt", $single_lower_case_name) . " is already exist";
                        }
                    }
                }
            }
        }
    
    
        if (empty($edit_id)) {
    
            if (isset($_POST['expense_category_names'])) {
                $expense_category_name = $_POST['expense_category_names'];
            }
            $inputbox_expense_category_name = "";
            $inputbox_expense_category_name = $_POST['expense_category_name'];
    
            if (!empty($inputbox_expense_category_name) && empty($expense_category_name)) {
                $expense_category_add_error = "Click Add Button to Append Expense Category";
                if (!empty($expense_category_add_error)) {
                    $valid_expense_category = $valid->error_display($form_name, "expense_category_name", $expense_category_add_error, 'text');
                }
            } else if (empty($inputbox_expense_category_name) && empty($expense_category_name)) {
                $expense_category_add_error = "Enter Expense Category Name";
                if (!empty($expense_category_add_error)) {
                    $valid_expense_category = $valid->error_display($form_name, "expense_category_name", $expense_category_add_error, 'text');
                }
            } else if (!empty($inputbox_expense_category_name)) {
                $expense_category_add_error = "Click Add Button to Append Expense Category";
                if (!empty($expense_category_add_error)) {
                    $valid_expense_category = $valid->error_display($form_name, "expense_category_name", $expense_category_add_error, 'text');
                }
            }
            if (!empty($expense_category_name)) {
                for ($p = 0; $p < count($expense_category_name); $p++) {
                    $expense_category_error = $valid->valid_name_text($expense_category_name[$p], "Expense Category Name", "1",'20');

                    if (!empty($expense_category_error)) {
                        $valid_expense_category = $valid->error_display($form_name, "expense_category_name", $expense_category_error, 'text');
                    }
                }
            }
        }
    
        for ($p = 0; $p < count($expense_category_name); $p++) {
            $expense_category_name[$p] = trim($expense_category_name[$p]);
    
            if (!empty($expense_category_name[$p])) {
                if (strlen($expense_category_name[$p]) > 20) {
                    $expense_category_name_error = "Invalid Expense Category Name  " . " " . $expense_category_name[$p] . " " . " - Only 20 Characters allowed.";
                }
                $expense_category_name_error = $valid->valid_name_text($expense_category_name[$p], "Expense Category Name", "1",'30');
                if (!empty($expense_category_name_error)) {
                    $valid_expense_category = $valid->error_display($form_name, "expense_category_name", $expense_category_name_error, 'text');
                }
            }
        }
    
        $result = "";
        if (empty($valid_expense_category) && empty($expense_category_name_error)) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();
            if (preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $created_date_time = $GLOBALS['create_date_time_label'];
                $creator = $GLOBALS['creator'];
                $bill_company_id = $GLOBALS['bill_company_id'];
                $lower_case_name = array();
                for ($p = 0; $p < count($expense_category_name); $p++) {
                    if (!empty($expense_category_name[$p])) {
                        $lower_case_name[$p] = strtolower($expense_category_name[$p]);
                        $lower_case_name[$p] = trim($lower_case_name[$p]);

                        $expense_category_name[$p] = $obj->encode_decode('encrypt', $expense_category_name[$p]);
                        $lower_case_name[$p] = $obj->encode_decode('encrypt', $lower_case_name[$p]);
                    }
                }
                $prev_expense_category_id = "";
                for ($i = 0; $i < count($lower_case_name); $i++) {
                    if (!empty($lower_case_name[$i])) {
                        $prev_expense_category_id = $obj->CheckExpenseCategoryAlreadyExists($bill_company_id,$lower_case_name[$i]);
                        if (!empty($prev_expense_category_id)) {
                            $expense_category_error = "This Expense Category name - " . $obj->encode_decode("decrypt", $lower_case_name[$i]) . " is already exist";
                        }
                    }
                }
                

                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                if (empty($edit_id)) {
                    for ($p = 0; $p < count($expense_category_name); $p++) {
                        if (empty($prev_expense_category_id) && (empty($expense_category_error))) {
                            $action = array();
                            if (!empty($expense_category_name[$p])) {
                                $action = "New Expense Category Created. Name - " . $obj->encode_decode('decrypt', $expense_category_name[$p]);
                            }
    
                            $null_value = $GLOBALS['null_value'];
                            $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id','expense_category_id', 'expense_category_name', 'lower_case_name', 'deleted');
                            $values = array("'" . $created_date_time . "'", "'" . $creator . "'", "'" . $creator_name . "'", "'" . $bill_company_id . "'", "'" . $null_value . "'", "'" . $expense_category_name[$p] . "'", "'" . $lower_case_name[$p] . "'", "'0'");
                            $expense_category_insert_id = $obj->InsertSQL($GLOBALS['expense_category_table'], $columns, $values, $action);						
                            if(preg_match("/^\d+$/", $expense_category_insert_id)) {
                                $expense_id = "";
                                if($expense_category_insert_id < 10) {
                                    $expense_id = "EXP_CAT_".date("dmYhis")."_0".$expense_category_insert_id;
                                }
                                else {
                                    $expense_id = "EXP_CAT_".date("dmYhis")."_".$expense_category_insert_id;
                                }
                                if(!empty($expense_id)) {
                                    $expense_id = $obj->encode_decode('encrypt', $expense_id);
                                }
                                $columns = array(); $values = array();						
                                $columns = array('expense_category_id');
                                $values = array("'".$expense_id."'");
                                $expense_update_id = $obj->UpdateSQL($GLOBALS['expense_category_table'], $expense_category_insert_id, $columns, $values, '');
                                if(preg_match("/^\d+$/", $expense_update_id)) {		
                                    $result = array('number' => '1', 'msg' => 'expense Successfully Created');					
                                    $balance = 1;							
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $expense_update_id);
                                }
                            }
                            // $expense_category_insert_id = $obj->InsertSQL($GLOBALS['expense_category_table'], $columns, $values, 'expense_category_id', '', $action[$p]);		
                            // if(preg_match("/^\d+$/", $expense_category_insert_id)) {								
                            //     $result = array('number' => '1', 'msg' => 'Expense Category Successfully Created');						
                            // }
                            else {
                                $result = array('number' => '2', 'msg' => $expense_category_insert_id);
                            }
                        } else {
                            $result = array('number' => '2', 'msg' => $expense_category_error);
                        }
                    }
                } else if (!empty($edit_id) && (empty($expense_category_error))) {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['expense_category_table'], 'expense_category_id', $edit_id, 'id');
                    if (preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "";
                        if (!empty($single_expense_category_name)) {
                            $action = "Expense Category Updated. Name - " . $obj->encode_decode('decrypt', $single_expense_category_name);
                        }
                        $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
    
                        $columns = array();
                        $values = array();
                        $columns = array('creator_name', 'expense_category_name', 'lower_case_name');
                        $values = array("'" . $creator_name . "'", "'" . $single_expense_category_name . "'", "'" . $single_lower_case_name . "'");
                        $expense_category_update_id = $obj->UpdateSQL($GLOBALS['expense_category_table'], $getUniqueID, $columns, $values, $action);
                        if (preg_match("/^\d+$/", $expense_category_update_id)) {
                            $result = array('number' => '1', 'msg' => 'Updated Successfully');
                        } else {
                            $result = array('number' => '2', 'msg' => $expense_category_update_id);
                        }
                    }
                } else {
                    $result = array('number' => '2', 'msg' => $expense_category_error);
                }
            } else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        } else if (!empty($expense_category_name_error)) {
            $result = array('number' => '2', 'msg' => $expense_category_name_error);
        } else {
            if (!empty($valid_expense_category)) {
                $result = array('number' => '3', 'msg' => $valid_expense_category);
            }
        }
    
        if (!empty($result)) {
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
        if (isset($_POST['search_text'])) {
            $search_text = $_POST['search_text'];
        }
    
        $total_records_list = array();
        $total_records_list = $obj->getTableRecords($GLOBALS['expense_category_table'], '', '','');
    
        if (!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if (!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if ((strpos(strtolower(html_entity_decode($obj->encode_decode('decrypt', $val['expense_category_name']))), $search_text) !== false)) {
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
        if (!empty($page_number) && !empty($page_limit) && !empty($total_pages)) {
            if ($total_pages > $page_limit) {
                if ($page_number) {
                    $page_start = ($page_number - 1) * $page_limit;
                    $page_end = $page_start + $page_limit;
                }
            } else {
                $page_start = 0;
                $page_end = $page_limit;
            }
        }
    
        $show_records_list = array();
        if (!empty($total_records_list)) {
            foreach ($total_records_list as $key => $val) {
                if ($key >= $page_start && $key < $page_end) {
                    $show_records_list[] = $val;
                }
            }
        }
    
        $prefix = 0;
        if (!empty($page_number) && !empty($page_limit)) {
            $prefix = ($page_number * $page_limit) - $page_limit;
        }
    
        if ($total_pages > $page_limit) { ?>
            <div class="pagination_cover mt-3"> <?php
                include("pagination.php"); ?>
            </div> <?php 
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
                        <th>Expense Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> <?php
                    if (!empty($show_records_list)) {
                        $count_expense_category = 0;
                        foreach ($show_records_list as $key => $list) {
                            $index = $key + 1;
    
                            if (!empty($prefix)) {
                                $index = $index + $prefix;
                            } ?>
                            <tr style="cursor:default;">
                                <td><?php echo $index; ?></td>
                                <td class="text-center"> <?php
                                    $expense_category_name = "";
                                    if (!empty($list['expense_category_name'])) {
                                        $expense_category_name = $list['expense_category_name'];
                                        $expense_category_name = $obj->encode_decode('decrypt', $expense_category_name);
                                        echo $expense_category_name;
                                    } ?>
                                </td>
                                <td>
                                    <?php 
                                        $access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $edit_action;
                                            include('permission_action.php');
                                        }
                                        
                                    ?>
                                    <?php 
                                        if(empty($access_error)) { ?> 
                                            <a href="Javascript:ShowModalContent('<?php if (!empty($page_title)) { echo $page_title; } ?>', '<?php if (!empty($list['expense_category_id'])) { echo $list['expense_category_id']; } ?>');"><i class="fa fa-pencil"></i> &ensp; </a> <?php 
                                        }
                                        $access_error = "";
                                        if(!empty($login_staff_id)) {
                                            $permission_action = $delete_action;
                                            include('permission_action.php');
                                        }
                                        if(empty($access_error)) {
                                            $expense_linked = "";
                                            $expense_linked = "";
                                            $expense_linked = $obj->getTableColumnValue($GLOBALS['expense_table'], 'expense_category_id',$list['expense_category_id'], 'expense_id');
                                            if(!empty($expense_linked)) { ?>
                                                    <a class="text-secondary" style="pointer-events: none; cursor: default;" > <i class="fa fa-trash" title="This Expense can't be deleted"></i> &ensp;</a> <?php 
                                            } 
                                            else { ?>
                                                <a href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['expense_category_id'])) { echo $list['expense_category_id']; } ?>');"><i class="fa fa-trash"></i> &ensp;</a> <?php
                                            }
                                        } ?>
                                </td>
                            </tr> <?php
                        }
                    } 
                    else { ?>
                        <tr>
                            <td colspan="3" class="text-center">Sorry! No records found</td>
                        </tr> <?php 
                    }  ?>
                </tbody>
            </table> <?php 
        }
    }

    if (isset($_REQUEST['expense_category_row_index'])) {
            $expense_category_row_index = $_REQUEST['expense_category_row_index'];
            $selected_expense_category_name = $_REQUEST['selected_expense_category_name'];
            ?>
        
            <tr class="expense_category_row" id="expense_category_row<?php if (!empty($expense_category_row_index)) { echo $expense_category_row_index; } ?>">
                <td class="text-center sno">
                    <?php if (!empty($expense_category_row_index)) { echo $expense_category_row_index; } ?>
                </td>
                <td class="text-center">
                    <?php
                    if (!empty($selected_expense_category_name)) {
                        $selected_expense_category_name = str_replace("@@@", "&", $selected_expense_category_name);
                        echo $selected_expense_category_name; ?>
        
                        <input type="hidden" name="expense_category_names[]" value="<?php if (!empty($selected_expense_category_name)) { echo $selected_expense_category_name; } ?>">
                    <?php } ?>
                </td>
                <td class="text-center product_pad">
                    <button class="btn btn-danger align-self-center px-2 py-1" type="button" onclick="Javascript:DeleteExpenseCategoryRow('<?php if (!empty($expense_category_row_index)) { echo $expense_category_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                </td>
            </tr>
            <?php
        }
        
        
        if (isset($_REQUEST['delete_expense_category_id'])) {
            $delete_expense_category_id = $_REQUEST['delete_expense_category_id'];
            $msg = "";
            if (!empty($delete_expense_category_id)) {
                $expense_category_unique_id = "";
                $expense_category_unique_id = $obj->getTableColumnValue($GLOBALS['expense_category_table'], 'expense_category_id', $delete_expense_category_id, 'id');
                if (preg_match("/^\d+$/", $expense_category_unique_id)) {
                    $expense_category_name = "";
                    $expense_category_name = $obj->getTableColumnValue($GLOBALS['expense_category_table'], 'expense_category_id', $delete_expense_category_id, 'expense_category_name');
        
                    $action = "";
                    if (!empty($expense_category_name)) {
                        $action = "Expense category Deleted. Name - " . $obj->encode_decode('decrypt', $expense_category_name);
                    }
                    $expense_linked = "";
                    $expense_linked = $obj->getTableColumnValue($GLOBALS['expense_table'], 'expense_category_id', $delete_expense_category_id, 'expense_id');
                    if(empty($expense_linked)) {
                        $columns = array();
                        $values = array();
                        $columns = array('deleted');
                        $values = array("'1'");
                        $msg = $obj->UpdateSQL($GLOBALS['expense_category_table'], $expense_category_unique_id, $columns, $values, $action);
                    }
                    else {
                        $msg = "This Expense category is associated with other screens";
                    }
                }
            }
            echo $msg;
            exit;
        }