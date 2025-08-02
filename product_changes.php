<?php
	include("include_files.php");
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['product_module'];
        }
    }

	if(isset($_REQUEST['show_product_id'])) { 
        $show_product_id = $_REQUEST['show_product_id'];
        $show_product_id = trim($show_product_id);    

        $add_custom_product = "";
		if(isset($_REQUEST['add_custom_product'])) {
			$add_custom_product = $_REQUEST['add_custom_product'];
			$add_custom_product = trim($add_custom_product);
		}

        $product_name = ""; $unit_id = "";$purchase_price = ""; $hsn_code = "";$tax_slab = ""; 

        if(!empty($show_product_id)) {
            $product_list = array();
            $product_list = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $show_product_id, '');
            if(!empty($product_list)) {
                foreach($product_list as $data) {
                   
                    if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                        $product_name = $obj->encode_decode('decrypt',$data['product_name']);
                    } 
                    if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                        $unit_id = $data['unit_id'];
                    } 
                    if(!empty($data['purchase_price']) && $data['purchase_price'] != $GLOBALS['null_value']) {
                        $purchase_price = $data['purchase_price'];
                    }
                  
                    if(!empty($data['hsn_code']) && $data['hsn_code'] != $GLOBALS['null_value']) {
                        $hsn_code = $data['hsn_code'];
                    } 
                    if(!empty($data['tax_slab']) && $data['tax_slab'] != $GLOBALS['null_value']) {
                        $tax_slab = $data['tax_slab'];
                    } 
                }
            }
        }
        
        
        $unit_list = array();
        $unit_list = $obj->getTableRecords($GLOBALS['unit_table'], '', '', '');

        ?>
        <form class="poppins pd-20 redirection_form" name="product_form" method="POST">
            <?php if(empty($add_custom_product)) { ?>
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-8">
                            <?php if(empty($show_product_id)) { ?>
                                <div class="text-white">Add Purchase Product</div>
                            <?php } else if(!empty($show_product_id)) { ?>
                                <div class="text-white">Edit Purchase Product</div>
                            <?php } ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-4">
                            <button class="btn btn-dark float-right" style="font-size:11px;" type="button" onclick="window.open('product.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_product_id)) { echo $show_product_id; } ?>">
              
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="form-group mb-2">
                        <div class="form-label-group in-border">
                            <input type="text" id="product_name" name="product_name" value="<?php if(!empty($product_name)) { echo $product_name; } ?>" class="form-control shadow-none">
                            <label>Purchase Product Name <span class="text-danger">*</span></label>
                        </div>
                        <!-- <div class="new_smallfnt">Contains Text Only</div> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="form-group mb-2">
                        <div class="form-label-group in-border mb-0">
                            <select name="unit_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select LR Product</option>
                                    <?php
                                        if(!empty($unit_list)) {
                                            foreach($unit_list as $data) {
                                                if(!empty($data['unit_id'])) {
                                    ?>
                                                    <option value="<?php echo $data['unit_id']; ?>" <?php if(!empty($unit_id) && $data['unit_id'] == $unit_id) { ?>selected<?php } ?> >
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
                                        }
                                    ?>
                                </select>
                            <label>Select LR Product <span class="text-danger">*</span></label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="form-group mb-2">
                        <div class="form-label-group in-border">
                            <input type="text" id="purchase_price" name="purchase_price" value="<?php if(!empty($purchase_price)) { echo $purchase_price; } ?>" class="form-control shadow-none">
                            <label>Purchase Price</label>
                        </div>
                    </div>
                </div>
          
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="form-group mb-2">
                        <div class="form-label-group in-border">
                            <input type="text" id="hsn_code" name="hsn_code" value="<?php if(!empty($hsn_code)) { echo $hsn_code; } ?>" class="form-control shadow-none" maxlength="8">
                            <label>HSN Code</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="form-group mb-2">
                        <div class="form-label-group in-border mb-0">
                            <select name="tax_slab" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Tax</option>
                                <option <?php if(!empty($tax_slab) && $tax_slab == '0%'){ ?>selected<?php }?>>0%</option>
                                <option <?php if(!empty($tax_slab) && $tax_slab == '5%'){ ?>selected<?php }?>>5%</option>
                                <option <?php if(!empty($tax_slab) && $tax_slab == '12%'){ ?>selected<?php }?>>12%</option>
                                <option <?php if(!empty($tax_slab) && $tax_slab == '18%'){ ?>selected<?php }?>>18%</option>
                                <option <?php if(!empty($tax_slab) && $tax_slab == '28%'){ ?>selected<?php }?>>28%</option>
                            </select>
                            <label>Select Tax</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark submit_button" type="button" onClick="Javascript:SaveModalContent('product_form', 'product_changes.php', 'product.php');">
                            Submit
                    </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
             <script>
                <?php if(isset($add_custom_product) && $add_custom_product == '1') { ?>
                    jQuery('#CustomProductModal').on('shown.bs.modal', function () {
                        jQuery('form[name="product_form"]').find('select').select2({
                            dropdownParent: jQuery('#CustomProductModal')
                        });
                    });
                <?php } ?>
            </script>
        </form>
		<?php
    } 
    if(isset($_POST['product_name'])) {
        $product_id = ""; $product_id_error = ""; $product_name = ""; $product_name_error = "";$unit_id = ""; $unit_id_error = ""; $purchase_price = ""; $purchase_price_error = "";$hsn_code = ""; $hsn_code_error = "";$tax_slab = ""; $tax_slab_error = "";$valid_product = ""; $form_name = "product_form"; 
        $edit_id = "";

        if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
		}

        if(isset($_POST['product_name'])) {
            $product_name = $_POST['product_name'];
            $product_name = trim($product_name);
            $product_name_error = $valid->valid_product_name($product_name, 'Purchase Product Name', 1,'50');
            if(!empty($product_name_error)) {
                if(!empty($valid_product)) {
                    $valid_product = $valid_product." ".$valid->error_display($form_name, 'product_name', $product_name_error, 'text');
                }
                else {
                    $valid_product = $valid->error_display($form_name, 'product_name', $product_name_error, 'text');
                }
            }
        }

        if(isset($_POST['unit_id'])) {
            $unit_id = $_POST['unit_id'];
            $unit_id = trim($unit_id);
            $unit_id_error = $valid->common_validation($unit_id, 'Unit', 'select');
            if(empty($unit_id_error)) {
                $unit_unique_id = "";
                $unit_unique_id = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'id');
                if(!preg_match("/^\d+$/", $unit_unique_id)) {
                    $unit_id_error = "Invalid Unit";
                }
            }
            if(!empty($unit_id_error)) {
                if(!empty($valid_product)) {
                    $valid_product = $valid_product." ".$valid->error_display($form_name, 'unit_id', $unit_id_error, 'select');
                }
                else {
                    $valid_product = $valid->error_display($form_name, 'unit_id', $unit_id_error, 'select');
                }
            }
        }
       
        if(isset($_POST['purchase_price'])) {
            $purchase_price = $_POST['purchase_price'];
            $purchase_price = trim($purchase_price);
            $purchase_price_error = $valid->valid_price($purchase_price, 'Purchase Price', 0, '99999.99');
        }
        if(!empty($purchase_price_error)) {
            if(!empty($valid_product)) {
                $valid_product = $valid_product." ".$valid->error_display($form_name, 'purchase_price', $purchase_price_error, 'text');
            }
            else {
                $valid_product = $valid->error_display($form_name, 'purchase_price', $purchase_price_error, 'text');
            }
        }

    

        if(isset($_POST['hsn_code'])) {
            $hsn_code = $_POST['hsn_code'];
            $hsn_code = trim($hsn_code);
            $hsn_code_error = $valid->valid_hsn($hsn_code, 'HSN Code', '');
            if(!empty($hsn_code_error)) {
                if(!empty($valid_product)) {
                    $valid_product = $valid_product." ".$valid->error_display($form_name, 'hsn_code', $hsn_code_error, 'text');
                }
                else {
                    $valid_product = $valid->error_display($form_name, 'hsn_code', $hsn_code_error, 'text');
                }
            }
        }

        if(isset($_POST['tax_slab'])) {
            $tax_slab = $_POST['tax_slab'];
            $tax_slab = trim($tax_slab);
        }
    
        $result = "";
		if(empty($valid_product)) {
            $check_user_id_ip_address = "";
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $lower_case_name = ""; $category_name = "";$unit_name = ""; 
                if(!empty($product_name)) {
                    $lower_case_name = strtolower($product_name);
                    $product_name = $obj->encode_decode('encrypt', $product_name);
                    $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                } 
                else {
                    $product_name = $GLOBALS['null_value'];
                    $lower_case_name = $GLOBALS['null_value'];
                } 

                
                if(!empty($unit_id)){
                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
                }
                else {
                    $unit_id = $GLOBALS['null_value'];
                    $unit_name = $GLOBALS['null_value'];
                } 
             
                if(empty($product_name)) {
                    $product_name = $GLOBALS['null_value'];
                }
                if(empty($unit_id)) {
                    $unit_id = $GLOBALS['null_value'];
                }
                if(empty($unit_name)) {
                    $unit_name = $GLOBALS['null_value'];
                }
                if(empty($purchase_price)) {
                    $purchase_price = $GLOBALS['null_value'];
                }
              
                if(empty($hsn_code)) {
                    $hsn_code = $GLOBALS['null_value'];
                }
                if(empty($tax_slab)) {
                    $tax_slab = $GLOBALS['null_value'];
                }

                $prev_product_id = ""; $product_error = "";
                if(!empty($lower_case_name)) {
                    $prev_product_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'lower_case_name', $lower_case_name, 'product_id');
                    if(!empty($prev_product_id)) {
                        $product_error = "This Purchase Product name already exists";
                    }
                }
                  
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $bill_company_id =$GLOBALS['bill_company_id'];
                
                $update_stock = 0; 
                if(empty($edit_id)) {
                    if(empty($prev_product_id)) {					
                        $action = "";
                        if(!empty($product_name)) {
                            $action = "New Purchase Product Created - ".$obj->encode_decode("decrypt",$product_name);
                        }
                        $null_value = $GLOBALS['null_value'];
                        $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id','product_id', 'product_name', 'lower_case_name', 'unit_id', 'unit_name', 'purchase_price', 'hsn_code','tax_slab', 'deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'",  "'".$bill_company_id."'","'".$null_value."'", "'".$product_name."'", "'".$lower_case_name."'","'".$unit_id."'", "'".$unit_name."'", "'".$purchase_price."'", "'".$hsn_code."'","'".$tax_slab."'", "'0'");
                        $product_insert_id = $obj->InsertSQL($GLOBALS['product_table'], $columns, $values, $action);						
							if(preg_match("/^\d+$/", $product_insert_id)) {
								$product_id = "";
								if($product_insert_id < 10) {
									$product_id = "PRODUCT_".date("dmYhis")."_0".$product_insert_id;
								}
								else {
									$product_id = "PRODUCT_".date("dmYhis")."_".$product_insert_id;
								}
								if(!empty($product_id)) {
									$product_id = $obj->encode_decode('encrypt', $product_id);
								}
								$columns = array(); $values = array();						
								$columns = array('product_id');
								$values = array("'".$product_id."'");
								$product_update_id = $obj->UpdateSQL($GLOBALS['product_table'], $product_insert_id, $columns, $values, '');
								if(preg_match("/^\d+$/", $product_update_id)) {	
									$update_product_id = $product_id;	
									$result = array('number' => '1', 'msg' => 'Purchase Product Successfully Created','product_id' => $product_id);					
								}
								else {
									$result = array('number' => '2', 'msg' => $product_update_id);
								}
							}
							else {
								$result = array('number' => '2', 'msg' => $product_insert_id);
							}
                    }else{
                        if(!empty($product_error)) {
                            $result = array('number' => '2', 'msg' => $product_error);
                        }
                    }
                }
                else {
                    if(empty($prev_product_id) || $prev_product_id == $edit_id) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            if(!empty($product_name)) {
                                $action = "Purchase Product Updated - ".$obj->encode_decode("decrypt",$product_name);
                            }
                        
                            $columns = array(); $values = array();						
                            $columns = array('creator_name', 'product_name', 'lower_case_name','unit_id', 'unit_name', 'purchase_price', 'hsn_code','tax_slab');
                            $values = array("'".$creator_name."'", "'".$product_name."'", "'".$lower_case_name."'", "'".$unit_id."'", "'".$unit_name."'","'".$purchase_price."'", "'".$hsn_code."'","'".$tax_slab."'");
                            $entry_update_id = $obj->UpdateSQL($GLOBALS['product_table'], $getUniqueID, $columns, $values, $action);
                            if(preg_match("/^\d+$/", $entry_update_id)) {
                                $update_stock = 1;	
                                $product_id = $edit_id;							
                                $result = array('number' => '1', 'msg' => 'Updated Successfully','product_id' => $product_id);						
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $entry_update_id);
                            }							
                        }
                    }else{
                        if(!empty($product_error)) {
                            $result = array('number' => '2', 'msg' => $product_error);
                        }
                    }
                    
                }
                
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
		}
		else {
			if(!empty($valid_product)) {
				$result = array('number' => '3', 'msg' => $valid_product);
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
        $total_records_list = $obj->getTableRecords($GLOBALS['product_table'], '', '', 'DESC');
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if((strpos(strtolower($obj->encode_decode('decrypt', $val['product_name'])), $search_text) !== false) ) {
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
        <?php } ?>
        <?php
            $access_error = "";
            if(!empty($login_staff_id)) {
                $permission_action = $view_action;
                include('permission_action.php');
            }
            if(empty($access_error)) { 
        ?>
                <table class="table nowrap cursor text-center smallfnt">
                    <thead class="bg-light">
                        <tr>
                            <th>S.No</th>
                            <th>Purchase Product Name</th>
                            <th>LR Product</th>
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
                                        <?php
                                                if(!empty($list['product_name']) && $list['product_name'] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt', $list['product_name']);
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if(!empty($list['unit_name']) && $list['unit_name'] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt', $list['unit_name']);
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
                                                if(empty($access_error)) {
                                            ?> 
                                                    <a class="pe-2" href="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['product_id'])) { echo $list['product_id']; } ?>');"><i class="fa fa-pencil"></i></a>
                                            <?php } ?>  
                                            <?php 
                                                $access_error = "";
                                                if(!empty($login_staff_id)) {
                                                    $permission_action = $delete_action;
                                                    include('permission_action.php');
                                                }
                                                if(empty($access_error)) { 
                                                    $linked_count = 0;
                                                    $linked_count = $obj->GetProductLinkedCount($list['product_id']);
                                                    if($linked_count > 0) {
                                            ?>                                        
                                                        <span title="This Purchase Product can't be deleted">                           
                                                            <a class="pe-2" style="pointer-events: none; cursor: default;" > <i class="fa fa-trash text-secondary" title="delete"></i></a>
                                                        </span>
                                            <?php 
                                                    }
                                                    else {
                                            ?> 
                                                        <a class="pe-2" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($list['product_id'])) { echo $list['product_id']; } ?>');" ><i class="fa fa-trash"></i></a>
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
                                    <td colspan="5" class="text-center">Sorry! No records found</td>
                                </tr>
                        <?php 
                            } 
                        ?>
                    </tbody>
                </table>   
<?php	
            }
	}

    if(isset($_REQUEST['delete_product_id'])) {
        $delete_product_id = $_REQUEST['delete_product_id'];
        $msg = "";
        if(!empty($delete_product_id)) {	
            $product_unique_id = "";
            $product_unique_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $delete_product_id, 'id');
            if(preg_match("/^\d+$/", $product_unique_id)) {
                $name = "";
                $name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $delete_product_id, 'product_name');
                
                $action = "";
                if(!empty($name)) {
                    $action = "Purchase Product Deleted. Name - ".$obj->encode_decode('decrypt', $name);
                }
        
                $linked_count = 0;
                $linked_count = $obj->GetProductLinkedCount($delete_product_id); 
            
                if(empty($linked_count)) {
                    $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $obj->UpdateSQL($GLOBALS['product_table'], $product_unique_id, $columns, $values, $action);
                }
                else {
                    $msg = "This Purchase Product is associated with other screens";
                }
            }
        }
        echo $msg;
        exit;	
    }

    if(isset($_REQUEST['clear_category_product_tables'])) {
        $clear_category_product_tables = $_REQUEST['clear_category_product_tables'];
        if(!empty($clear_category_product_tables) && $clear_category_product_tables == 1) {
            $clear_records = 1;
            $tables = array($GLOBALS['product_table']);
            $clear_records = $obj->getClearTableRecords($tables);
            echo $clear_records;
            exit;
        }
    }

    if(isset($_REQUEST['check_product_count'])){
        $check_product_count = $_REQUEST['check_product_count'];
       
        $product_list = array();
        $product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '','');
        
        if(!empty($product_list)){
            echo $product_count = count($product_list);
        }
    }
?>
