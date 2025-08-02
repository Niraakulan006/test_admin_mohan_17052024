<?php
    include("include_user_check_and_files.php");
   
    if(isset($_REQUEST['show_upload_excel'])) {
		$show_upload_excel = $_REQUEST['show_upload_excel'];
		if(!empty($show_upload_excel) && $show_upload_excel == 1) { ?>
			<form class="py-4 poppins pd-20" name="excel_upload_form" method="POST">
                <div class="col-12 my-3">
                    <div class="excel_back_upload_details back_button">
                        <span style="color:green;padding-left:20px;font-size:large;">Tax must be in [0, 5, 12, 18, 28]  </span><br>
                    </div>
                </div>
                <div class="col-12 my-3" style="position: relative;">
                    <div class="excel_upload_details" style="display: none;">
                        <span class="excel_upload_count"></span> upload in out of <span class="excel_upload_total_count"></span>
                    </div>
                </div>
				<div class="col-lg-11">
					<div class="col-12">
                        <input type="hidden" name="upload_row_index" value="1">
						<div class="table-responsive">
							<table id="excel_upload_details_table" class="data-table table tablefont" style="margin: auto;width:1355px;">
                                <tbody>
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align: center; width: 50px;">S.No</th>
                                            <th style="text-align: center; width: 125px;">Product Name</th>
                                            <th style="text-align: center; width: 125px;">Unit</th>
                                            <th style="text-align: center; width: 125px;">Price</th>                 
                                            <th style="text-align: center; width: 125px;">HSN Code</th>
                                            <th style="text-align: center; width: 125px;">Tax</th>                 
                                        </tr>
                                    </thead>
								</tbody>
							</table>
						</div>
					</div>
                    <!-- <div class="col-12 my-3" style="position: relative;">
                        <div class="excel_upload_details" style="display: none;">
                            <span class="excel_upload_count"></span> upload in out of <span class="excel_upload_total_count"></span>
                        </div>
                    </div> -->
					
					<div class="col-md-12 pt-3 text-center">
						<button class="btn btn-primary btnwidth submit_button" disabled type="button" onClick="Javascript:UploadExcelData(event, 'excel_upload_form');">Submit</button>
					</div>
				</div>
			</form>
<?php			
		}
	}

    if(isset($_REQUEST['excel_row_index'])) {
        $excel_row_index = ""; $excel_row_values = ""; $sno = ""; $hsn_code = "";  $product_name = ""; $product_name_error = ""; $unit_id = ""; $unit_id_error = "";  $unit_name = ""; $unit_name_error = ""; $upload_type = ""; $price = ""; $price_error = "";
       $product_error="";

        if(isset($_REQUEST['upload_type'])){
            $upload_type = $_REQUEST['upload_type'];
        }

        $excel_row_index = $_REQUEST['excel_row_index'];
        $excel_row_index = trim($excel_row_index);

		$excel_row_values = $_REQUEST['excel_row_values'];
		$excel_row_values = trim($excel_row_values);


        if(!empty($excel_row_values)) {
            $excel_row_values = json_decode($excel_row_values);
            
            if($excel_row_values['0'] != "undefined" && $excel_row_values['0'] != $GLOBALS['null_value']) {
				$sno = trim($excel_row_values['0']);
			}

            if(!empty($excel_row_values['1']) && $excel_row_values['1'] != 'undefined' && $excel_row_values['1'] != $GLOBALS['null_value']){
                $excel_row_values['1']=trim($excel_row_values['1']);
                $product_name = $excel_row_values['1'];
                    
                $product_name = trim($product_name);
                $product_name = str_replace("_____","#",$product_name);
                $product_name = str_replace("____","+",$product_name);
                $product_name = str_replace("___","&",$product_name);
                $product_name = str_replace("__",'"',$product_name);
                $product_name = str_replace("_","'",$product_name);

				$product_name_error = $valid->valid_product_name($product_name, "Product Name", "1","50");              
            }

            if(!empty($excel_row_values['2']) && $excel_row_values['2'] != 'undefined' && $excel_row_values['2'] != $GLOBALS['null_value']){
                $excel_row_values['2']=trim($excel_row_values['2']);
                $unit_name = $excel_row_values['2'];
				$unit_name_error = $valid->valid_text($unit_name, "Unit Name", "1");
            }

            if(!empty($excel_row_values['3']) && $excel_row_values['3'] != "undefined" && $excel_row_values['3'] != $GLOBALS['null_value']) {
                $excel_row_values['3'] = trim($excel_row_values['3']);
                $price = $excel_row_values['3'];
                $price_error = $valid->valid_price($price, "Price", "1","6");                 
			}

            if(!empty($excel_row_values['4']) && $excel_row_values['4'] != 'undefined' && $excel_row_values['4'] != $GLOBALS['null_value']){
                $excel_row_values['4']=trim($excel_row_values['4']);
                $hsn_code = $excel_row_values['4'];
				$hsn_code_error = $valid->valid_hsn($hsn_code, "HSN Code", "1");
            }

            if(!empty($excel_row_values['5']) && $excel_row_values['5'] != "undefined" && $excel_row_values['5'] != $GLOBALS['null_value']) {
                $excel_row_values['5'] = trim($excel_row_values['5']);
                $tax = $excel_row_values['5'];
                $tax_error = $valid->valid_percentage($tax, "Tax", "0","1");                 
			}
         
        }

        $row_id = date("dmyhis")."_".$excel_row_index;

        ?>
    
        <tr id="<?php if(!empty($row_id)) { echo $row_id; } ?>" class="excel_row">
            <td style="width: 10px; text-align: center;">
                <?php if(!empty($sno)) { echo $sno; } ?>
                <input type="hidden" name="excel_upload_type" value="<?php if(!empty($upload_type)) { echo $upload_type; } ?>" placeholder="excel_upload_type">
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="product_name" value="<?php if(!empty($product_name)) { echo $product_name; } ?>" placeholder="Product Name" onfocus="Javascript:KeyboardControls(this,'text',25,'');">
                <?php if(!empty($product_name_error)) { ?>
                <span class="infos"><?php $product_name_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="unit_name" value="<?php if(!empty($unit_name)) { echo $unit_name; } ?>" placeholder="Unit Name" onfocus="Javascript:KeyboardControls(this,'text',25,'');">
                <?php if(!empty($unit_name_error)) { ?>
                <span class="infos"><?php $unit_name_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="price" value="<?php if(!empty($price)) { echo $price; } ?>" placeholder="Price" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
                <?php if(!empty($price_error)) { ?>
                <span class="infos"><?php $price_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="hsn_code" value="<?php if(!empty($hsn_code)) { echo $hsn_code; } ?>" placeholder="HSN Code" onfocus="Javascript:KeyboardControls(this,'number',25,'');">
                <?php if(!empty($hsn_code_error)) { ?>
                <span class="infos"><?php $hsn_code_error; ?></span>
                <?php } ?>
            </td>
            <td style="width: 100px;">
                <input type="text" class="form-control mb-1" name="tax" value="<?php if(!empty($tax)) { echo $tax; } ?>" placeholder="Tax" onfocus="Javascript:KeyboardControls(this,'number',8,'');">
                <?php if(!empty($tax_error)) { ?>
                <span class="infos"><?php $tax_error; ?></span>
                <?php } ?>
            </td>
            <td class="excel_upload_status" style="width: 50px;"></td>
        </tr>
<?php
    }

    if(isset($_REQUEST['product_name'])) {
       $product_name = ""; $product_name_error = "";  $unit_name = ""; $unit_name_error = ""; $excel_upload_type=""; $price = ""; $price_error = "";  $tax = ""; $tax_error = ""; $product_type = ""; $product_type_error = ""; $product_code = ""; $product_code_error = "";
        $excel_upload_error = ""; 
        $hsn_code = $hsn_code_error = "";
        
        if(isset($_REQUEST['excel_upload_type'])){
            $excel_upload_type = $_REQUEST['excel_upload_type'];
        }

        if(isset($_REQUEST['product_name'])){
            $product_name = $_REQUEST['product_name'];

            $product_name = trim($product_name);

            $product_name = str_replace("_____","#",$product_name);
            $product_name = str_replace("____","+",$product_name);
            $product_name = str_replace("___","&",$product_name);
            $product_name = str_replace("__",'"',$product_name);
            $product_name = str_replace("_","'",$product_name);

            if(empty($product_name)){
                $excel_upload_error = "Enter the Product Name";
            }
            if(!empty($product_name)){
                if(!empty($product_name) && strlen($product_name) > 50) {
                    $product_name_error = "Product - Max.Character Count : 50";
                }
                else if(!preg_match("/^(?!\d+$)[a-zA-Z\d][\w'\"\s\(\)\-\.@\&\/\\\]+$/",$product_name)){
                    $product_name_error = "Invalid Product Name";
                }
               
            }
            

            if(!empty($product_name_error) ) {
                if(!empty($excel_upload_error)) {
                    $excel_upload_error = $excel_upload_error." ".$product_name_error;
                }
                else {
                    $excel_upload_error = $product_name_error;
                }
            }
        }       

        if(isset($_REQUEST['hsn_code'])){
            $hsn_code = $_REQUEST['hsn_code'];
            $hsn_code = trim($hsn_code);
            $hsn_code_error = $valid->valid_hsn($hsn_code, "HSN Code", "0");
    
            
            if(!empty($hsn_code_error)) {
                if(!empty($excel_upload_error)) {
                   $excel_upload_error = $excel_upload_error."<br>".$hsn_code_error;
                }
                else {
                    $excel_upload_error = $hsn_code_error;
                }
            }
        }

        if(isset($_REQUEST['unit_name'])){
            $unit_name = $_REQUEST['unit_name'];
            $unit_name = trim($unit_name);
            $unit_name_error = $valid->valid_text($unit_name, "Unit Name", "1");
    
            if(!empty($unit_name) && empty($unit_name_error) && strlen($unit_name) > 25) {
                $unit_name_error = "Unit Name - Max.Character Count : 25";
            }
            
            if(!empty($unit_name_error)) {
                if(!empty($excel_upload_error)) {
                   $excel_upload_error = $excel_upload_error."<br>".$unit_name_error;
                }
                else {
                    $excel_upload_error = $unit_name_error;
                }
            }
        }
       
        
      
        if(isset($_REQUEST['price'])){
            $price = $_REQUEST['price'];
            $price = trim($price);
            $price_error = $valid->valid_number($price, "Price", "0");
    
            if(!empty($price) && empty($price_error) && strlen($price) > 6) {
                $price_error = "Price- Max.Character Count : 6";
            }          
        }
        if(!empty($price_error)) {
            if(!empty($excel_upload_error)) {
                $excel_upload_error = $excel_upload_error."<br>".$price_error;
            }
            else {
                $excel_upload_error = $price_error;
            }
        }

        if(isset($_REQUEST['tax'])){
            $tax = $_REQUEST['tax'];
            $tax = trim($tax);
            $tax_error = $valid->valid_percentage($tax, "Tax", "0");
    
        }

        if(!empty($tax) && strpos($tax, '%') !== true) {
            $valid_types = ['', '0', '5', '12', '18', '28'];  
            if (!in_array($tax, $valid_types)) {
                $tax_error = "Tax must be in (5, 12, 18, 28)";
            }
            $tax = $tax . '%';
        } else {
            $valid_types = ['', '0%', '5%', '12%', '18%', '28%'];  
            if (!in_array($tax, $valid_types)) {
                $tax_error = "Tax must be in (5, 12, 18, 28)";
            }
        }

        if(!empty($tax_error)) {
            if(!empty($excel_upload_error)) {
                $excel_upload_error = $excel_upload_error."<br>".$tax_error;
            }
            else {
                $excel_upload_error = $tax_error;
            }
        }
       
        $result = "";  
        if(empty($excel_upload_error)) {
            $product_unit_id = "";  $product_category_id = ""; 

            $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
            $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
            $bill_company_id = $GLOBALS['bill_company_id'];
            $null_value = $GLOBALS['null_value'];
            
            if(!empty($unit_name)) {
                $lower_case_name = "";
                $lower_case_name = strtolower($unit_name);
                $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
                $unit_name = $obj->encode_decode('encrypt',$unit_name);
                // $bill_company_id = $GLOBALS['bill_company_id'];

                $prev_unit_id = "";	
				if(!empty($lower_case_name)) {
                    $prev_unit_id = ""; $unit_error = "";
                    if(!empty($lower_case_name)) {
                        $prev_unit_id = $obj->getTableColumnValue($GLOBALS['unit_table'],'lower_case_name',$lower_case_name,'unit_id');
                    }
					if(empty($prev_unit_id)) {						
                        $action = ""; $unit_insert_id = "";
                        if(!empty($unit_name)) {
                            $action = "New unit Created. Name - ".$obj->encode_decode('decrypt', $unit_name);
                        }

                        $null_value = $GLOBALS['null_value'];
                        $columns = array();$values = array();
                        $columns = array('created_date_time', 'creator', 'creator_name',  'unit_id', 'unit_name', 'lower_case_name', 'deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$unit_name."'", "'".$lower_case_name."'", "'0'");
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
                                $product_unit_id = $unit_id;		
                            }
                        }
                    }
                    else {
                        $product_unit_id = $prev_unit_id;
                    }
                }
            }
                                // echo $product_unit_id.'hlo';

          
            if(!empty($product_name)){
                $lower_case_name = strtolower($product_name);
                $product_name = $obj->encode_decode('encrypt', $product_name);
                $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);


                $prev_product_id = ""; $prev_product_name = "";$product_error = ""; 
                if(!empty($lower_case_name) && $lower_case_name != $GLOBALS['null_value']) {
                    $prev_product_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'lower_case_name', $lower_case_name, 'product_id');
                    if(!empty($prev_product_id)) {
                        $prev_product_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $prev_product_id, 'product_name');
                        $prev_product_name =$obj->encode_decode('decrypt',$prev_product_name);
                        $product_error = "This Product Name already exists in ".$prev_product_name;
                    }
                }
                if(empty($prev_product_id)) {						
                    $action = "";
                    if(!empty($product_name)) {
                        $action = "New Product Created. Name - ".$obj->encode_decode('decrypt', $product_name);
                    }

                    $product_insert_id = ""; $null_value = $GLOBALS['null_value'];
                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id','product_id', 'product_name', 'lower_case_name', 'unit_id', 'unit_name', 'purchase_price', 'hsn_code','tax_slab', 'deleted');

                    $values = array("'" . $created_date_time . "'", "'" . $creator . "'", "'" . $creator_name . "'", "'" . $bill_company_id . "'","'" . $null_value . "'", "'" . $product_name . "'", "'" . $lower_case_name . "'","'" . $product_unit_id . "'","'" . $unit_name . "'","'" . $price . "'","'" . $hsn_code . "'","'" . $tax . "'","'0'");
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
                            // $result = array('number' => '1', 'msg' => 'Product Successfully Created');		
                            $result = 1;						
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $product_update_id);
                        }
                    }
                    // $product_insert_id = $obj->InsertSQL($GLOBALS['product_table'], $columns, $values, 'product_id', '', $action);
                    // if(preg_match("/^\d+$/", $product_insert_id)) {
                        // $product_id = $obj->getTableColumnValue($GLOBALS['product_table'], 'id', $product_insert_id, 'product_id');
                        // $result = array('number' => '1', 'msg' => 'Product Successfully Created');
                    // }
                    else {
                        $result = array('number' => '2', 'msg' => $product_insert_id);
                    }
                }
                else {
                    if($excel_upload_type == "2"){
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $prev_product_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            
                            if(!empty($product_name)) {
                                $action = "Product Updated. Name - ".$product_name;
                            }

                            $columns = array(); $values = array();						
                            $columns = array('creator_name', 'bill_company_id', 'product_name', 'lower_case_name','unit_id','unit_name','purchase_price','hsn_code','tax_slab');
                            $values = array("'" . $creator_name . "'", "'" . $bill_company_id . "'","'" . $product_name . "'", "'" . $lower_case_name . "'","'" . $product_unit_id . "'","'" . $unit_name . "'","'" . $price . "'","'" . $hsn_code . "'","'" . $tax . "'");

                            // $product_update_id = $obj->UpdateSQL($GLOBALS['product_table'], $getUniqueID, $columns, $values, $action);
                            $product_update_id = $obj->UpdateSQL($GLOBALS['product_table'], $getUniqueID, $columns, $values, $action);
                            $result = $product_update_id;
                        }
                        else{
                            $result = $product_error;
                        }
                    }
                    else {
                        echo $excel_upload_error = $product_error;
                    }
                }
            }
            if(!empty($result)) {
			$result = json_encode($result);
		}
           echo  $result; exit;
        } else{
            echo  $excel_upload_error;
        }
    }

    ?>

   