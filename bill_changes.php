<?php
    include("include_files.php");

    if(isset($_REQUEST['selected_unit'])) {
        $selected_unit_id = "";$selected_product_id = ""; $quantity = 0; $total_quantity = 0;$unit_id =""; $purchase_rate = 0;
        $selected_product_id = $_REQUEST['product_id'];
        $selected_unit_type = $_REQUEST['selected_unit'];
        $quantity = $_REQUEST['quantity'];
        $purchase_rate = $_REQUEST['rate'];

        if(empty($quantity)){
            $quantity =0;
        }
        $unit_id =$obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$selected_product_id,'unit_id');
        $total_quantity = $quantity;
        
        $amount ="";
        if(!empty($total_quantity) && !empty($purchase_rate))
        {
            $amount = $total_quantity * $purchase_rate;
        }

        if(!empty($selected_unit_type)){
            echo $total_quantity."$$$".$amount;
        
        }else{
            echo "";
        }
    }
    
	if(isset($_REQUEST['selected_row_unit'])) {
        $selected_unit_id = "";$selected_product_id = ""; $quantity = 0; $contains = 0;$total_quantity = 0;$unit_id ="";
        $selected_product_id = $_REQUEST['selected_row_product_id'];
        $selected_unit_type = $_REQUEST['selected_row_unit'];
        $contains = $_REQUEST['seletcted_row_contains'];
        $quantity = $_REQUEST['selected_row_quantity'];
        $rate = $_REQUEST['selected_rate'];
        $amount = $_REQUEST['selected_amount'];

        $subunit_need = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$selected_product_id,'subunit_need');

        if(empty($contains)){
            $contains =0;
        }
        if(empty($quantity)){
            $quantity =0;
        }
        $unit_id =$obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$selected_product_id,'unit_id');
        if($selected_unit_type == '1')
        {
            $selected_unit_id =$obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$selected_product_id,'unit_id');
        }
        else if($selected_unit_type == '2')
        {
            $selected_unit_id =$obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$selected_product_id,'subunit_id');
        }

        if($subunit_need == '1')
        {
            if($selected_unit_id == $unit_id){
                $total_quantity = $quantity * $contains;
            }else{
                $total_quantity = $quantity;
            }   
        }
        else
        {
            
        }

        $amount ="";

        
        if(!empty($total_quantity)){
            echo $total_quantity;
        }
        
    }

    if(isset($_REQUEST['get_unit'])) {
		$get_unit_product_id = ""; $purchase_price = "";
		$get_unit_product_id = $_REQUEST['get_unit'];
		$godown_id = $_REQUEST['godown_id'];


		
		if(!empty($get_unit_product_id)) {
			$unit_id=""; $subunit_id = "";
			$unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$get_unit_product_id,'unit_id');

			$purchase_price = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$get_unit_product_id,'purchase_price');

            
			
			?>
            <option value="">Select</option>
            <option value="1" selected>
                <?php
                    if(!empty($unit_id)) {
                        
                        $unit_name = "";
                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
                        if(!empty($unit_name)) {
                            $unit_name = $obj->encode_decode('decrypt', $unit_name);
                            echo $unit_name;
                        }
                    }
                ?>
            </option>
            <?php
		}
		else {
			$unit_list = array();
			$unit_list = $obj->getTableRecords($GLOBALS['unit_table'], 'bill_company_id', $GLOBALS['bill_company_id'],''); ?>
			
				<?php
				if(!empty($unit_list)) {
					foreach($unit_list as $data) { ?>
                        <option value="">Select</option>
						<option value="<?php if(!empty($data['unit_id'])) { echo $data['unit_id']; } ?>">
							<?php
								if(!empty($data['unit_name'])) {
									$data['unit_name'] = $obj->encode_decode('decrypt', $data['unit_name']);
									echo $data['unit_name'];
								}
							?>
						</option>
                        
						<?php
					}
				} ?>
			$$$
			
			<option value="">Select</option>
			$$$
			
			<?php			
         
		} ?>
        $$$
        <?php 
           if(!empty($purchase_price) && $purchase_price != $GLOBALS['null_value']){
                echo $purchase_price;
            }
	}
    if(isset($_REQUEST['get_party_state'])) {
        $party_id = $_REQUEST['get_party_state'];
        $party_state = "";
        if(!empty($party_id)) {
            $party_state = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'state');
            $party_state =$obj->encode_decode('decrypt',$party_state);
        }
        echo $party_state;
    }
    
   
    if(isset($_REQUEST['show_discount']))
    {
        $show_discount =$_REQUEST['show_discount'];
        
        ?>
            <div class="col-lg-5 col-5">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger tax_selector" name="discount_option" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="taxdiscountshow(this.value);">
                            <!-- <option value="">Before/After  Tax</option> -->
                            <option value="1">Before Tax</option>
                            <option value="2">After Tax</option>
                        </select>
                        <label>Discount After Tax</label>
                    </div>
                    <input type="hidden" name="is_discount" value="">
                </div> 
            </div>
            <div class="col-lg-3 col-3">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <input type="text" id="discount" name="discount" class="form-control shadow-none" placeholder="" onkeyup="Javascript:checkDiscount();" required>
                        <label></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-3 ">
                <div class="form-group">
                    <div class="form-label-group in-border d-flex">
                        <i class="bi bi-currency-rupee"></i><p class="discount_value"></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-1 align-self-center " onclick="Javascript:removeDiscount();">
                <i class="bi bi-x-circle"></i>
            </div>
        <div class="col-lg-12 col-12 d-flex">
            <div class="col-lg-8 col-8">
                Total Amount
            </div>
            <div class="col-lg-3 col-3 d-flex justify-content-center">
                <i class="bi bi-currency-rupee"></i><p class="discounted_total"></p>
            </div>
        </div>
        
        <script src="include/select2/js/select2.min.js"></script>
        <script src="include/select2/js/select.js"></script>
        <?php
        
    }
    
   

    if(isset($_REQUEST['show_charges']))
    {
        $gst_option = 0;
        $show_charges =$_REQUEST['show_charges'];
        $gst_option =$_REQUEST['gst_option'];
        $selected_tax =$_REQUEST['selected_tax'];
        $tax_array = array();
        $tax_array = explode(",", $selected_tax);
        $tax_array = array_unique($tax_array);

        $charges_list =array();
        $charges_list = $obj->getTableRecords($GLOBALS['charges_table'],'','','');
        
            ?>
             <div class="row charges_row div_charges">
                <div class="col-4 col-lg-5">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" name="charges_id[]"  data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:checkGST();">
                                    <option value="">Select</option>
                                    <?php
                                        if(!empty($charges_list)) {
                                            foreach ($charges_list as $data) {
                                                if(!empty($data['charges_id']) && $data['charges_id'] != $GLOBALS['null_value']) {
                                                    ?>
                                                    <option value="<?php echo $data['charges_id']; ?>" <?php if(!empty($overall_charges_ids) && $overall_charges_ids == $data['charges_id']) { ?>selected<?php } ?>>
                                                        <?php
                                                            if(!empty($data['charges_name']) && $data['charges_name'] != $GLOBALS['null_value']) {
                                                                echo $obj->encode_decode('decrypt', $data['charges_name']);
                                                            }
                                                        ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                            <label class="f-10">Select Charges </label>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-4">
                    <div class="form-label-group in-border">
                        <!-- <div class="input-group">
                            <input type="text" name="charges_value[]" onkeyup="Javascript:CheckCharges();" value="" class="form-control shadow-none">
                            <label>%</label>
                        </div> -->
                        <div class="input-group">
                            <input type="text" name="charges_value[]" onkeyup="Javascript:CheckCharges();" value="" class="form-control shadow-none">
                            <div class="input-group-append charges_tax <?php if($gst_option == 0) { ?> d-none <?php } ?>" style="width:60%!important;">
                                <select name="charges_tax[]" onChange="Javascript:checkGST();" class="select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="">select tax</option>
                                    <?php
                                        if(!empty($tax_array) && (count($tax_array) > 0)) {
                                            for($i = 0; $i < count ($tax_array); $i++) {
                                                if(!empty($tax_array[$i])) { ?>
                                                    <option value="<?php echo $tax_array[$i]; ?>"><?php echo $tax_array[$i]; ?></option>
                                                <?php }
                                            }
                                        }
                                    ?>                                
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-3 pt-3 pb-3">
                    <div class="form-group">
                        <div class="form-label-group in-border d-flex justify-content-end">
                            <!-- <input type="text" id="discounted_total" name="discounted_total" class="form-control shadow-none discounted_total" placeholder="" required> -->
                            <i class="bi bi-currency-rupee"></i><p class="charges_total"></p>
                        </div>
                    </div>
                </div>
                <div class="col-1 align-self-center pt-2" onclick="Javascript:removeCharges(this);">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div class="col-lg-12 col-12 d-flex p-0">
                    <div class="col-lg-8 col-8 p-2">
                        Total Amount
                    </div>
                    <div class="col-lg-4 col-3 d-flex justify-content-end pb-3 text-right">
                        <i class="bi bi-currency-rupee"></i><p class="charges_sub_total"></p>
                    </div>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <?php
        
    }
    if(isset($_REQUEST['selected_unit_id']))
    {
        $getPurchaseRate = $_REQUEST['getPurchaseRate'];
        $selected_unit_id = $_REQUEST['selected_unit_id'];
        $selected_product_id = $_REQUEST['selected_product_id'];
        $purchase_rate ="";
        
        $purchase_rate = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$selected_product_id,'rate');
        
        // echo $purchase_rate;
    }

   if(isset($_REQUEST['checkvalidation'])){
        $edit_id = ''; $valid_form = "";$receipt_id = "";
        $form_name = 'sales_bill_form';$party_id="";
        $product_id = $unit_id = $product_name = $category_id = $godown_id = $type = $sub_unit_need = $inventory_enable = $negative_stock = $qty = $price = $total = $hsncode = $sales_product_unique_ids = $tax_percentage = $stock_unique_ids = array();
        $discount_value =""; $discounted_total =0;      
        $charges_id = array(); $charges_tax = array();
        $charges_total_amounts = array();
        $charges_values = array();
        $discount_option =""; $discount_option_error ="";  $discount =""; $discount_error ="";$total_tax_value = 0;  
        $round_off =0;  $round_off_type =""; $round_off_value ="";$subunit_contains="";$customer_mobile_number = '';
    
        $receipt_date = ""; $receipt_date_error = "";
        $payment_mode_ids = array(); $bank_ids = array(); $bank_names = array(); $payment_mode_names = array(); $amount = array(); $total_amount = 0; $payment_error = ""; $narration = ""; $narration_error = ""; $selected_payment_mode_id = "";

        $valid_receipt = "";         
        if(isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_id = trim($edit_id);
        }        
        if(isset($_POST['receipt_id'])) {
            $receipt_id = $_POST['receipt_id'];
            $receipt_id = trim($receipt_id);
        }   
        if(isset($_POST['party_number'])) {
            $party_number = $_POST['party_number'];
            $party_number = trim($party_number);
            // if(!empty($party_number)) {
            //     $party_number = $obj->encode_decode('encrypt', $party_number);
            // }
        }
        
        if(isset($_POST['party_id'])) {
            $party_id = $_POST['party_id'];
            $party_id = trim($party_id);
            
        }

        $quantity_error = '';

        if(empty($party_id)) {
            if (!empty($valid_form)) {
                $valid_form = $valid_form." ".$valid->error_display($form_name, 'party_name', "select party", 'text');
            } else {
                $valid_form = $valid->error_display($form_name, 'party_name', "select party", 'text');
            }
        }
        

        if(isset($_POST['party_name'])) {
            $party_name = $_POST['party_name'];
            $party_name = trim($party_name);  
        }
        if(isset($_POST['product_name'])) {
            $product_name = $_POST['product_name'];
            $product_name = array_reverse($product_name);
        }        
        if(isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
            $product_id = array_reverse($product_id);
        }
        if(isset($_POST['unit_id'])) {
            $unit_id = $_POST['unit_id'];
            $unit_id = array_reverse($unit_id);
        }
        if(isset($_POST['category_id'])) {
            $category_id = $_POST['category_id'];
            $category_id = array_reverse($category_id);
        }
        if(isset($_POST['godown_id'])) {
            $godown_id = $_POST['godown_id'];
            $godown_id = array_reverse($godown_id);
        }
        
        if(isset($_POST['negative_stock'])) {
            $negative_stock = $_POST['negative_stock'];
            $negative_stock = array_reverse($negative_stock);
        }
               
        if(isset($_POST['qty'])) {
            $qty = $_POST['qty'];
            $qty = array_reverse($qty);
        }
        if(isset($_POST['price'])) {
            $price = $_POST['price'];
            $price = array_reverse($price);
        }        
        if(isset($_POST['total'])) {
            $total = $_POST['total'];
            $total = array_reverse($total);
        }    

        $sub_total = 0;
        $total_amounts = 0;
        if(!empty($product_name) && count($product_name) > 0) {
            for($i = 0; $i < count($product_name); $i++) {
                $product_name[$i] = trim($product_name[$i]);
                if(!empty($product_name[$i])) {
                    $quantity_error = $valid->common_validation($product_name[$i], 'Product Name', '1', '50');
                    if (!empty($quantity_error)) {
                        if (!empty($valid_form)) {
                            $valid_form = $valid_form." ".$valid->row_error_display($form_name, 'product_name[]', $quantity_error, 'text', 'product_row', ($i+1));
                        } else {
                            $valid_form = $valid->row_error_display($form_name, 'product_name[]', $quantity_error, 'text', 'product_row', ($i+1));
                        }
                    }
                    $qty[$i] = trim($qty[$i]);       
                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $qty[$i]) && $qty[$i] <= 99999999 && $qty[$i] > 0){
                        if (!empty($edit_id)) {
                            $consumptionData = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id[$i], '');

                            $raw_material_id ="";$raw_material_unit_id ="";
                            if (!empty($consumptionData)) {
                                foreach ($consumptionData as $row) {
                                    if (!empty($row['raw_material_product_id'])) {
                                        if(!empty($row['raw_material_product_id']) && $row['raw_material_product_id'] !=$GLOBALS['null_value']){
                                            $raw_material_id = $row['raw_material_product_id'];
                                            $raw_material_unit_id = $row['unit_id'];
                                        }
                                        $unique_id = $obj->getStockUniqueID($edit_id, $raw_material_id, $raw_material_unit_id);
                                        if (!empty($unique_id)) {
                                            $stock_unique_ids[] = $unique_id;
                                        }
                                    }
                                }
                            }

                            $sales_bill_unique_id = $obj->getSalesListUniqueID($edit_id, $product_id[$i], $unit_id[$i]);
                            if (!empty($sales_bill_unique_id)) {
                                $sales_product_unique_ids[] = $sales_bill_unique_id;
                            }
                        }
                        $total[$i] = trim($total[$i]);
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $total[$i]) && $total[$i] <= 99999999 && $total[$i] > 0) {
                            $sub_total += $total[$i];
                                
                            // if(!empty($product_id[$i]) && $product_id != $GLOBALS['null_value']) {
                            //     $inward_quantity = 0; $outward_quantity = 0; $current_stock = 0;   
                            //     $hasConsumption = false;

                            //     $consumptionData = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id[$i], '');
                            
                            //     if (!empty($consumptionData)) {
                            //         foreach ($consumptionData as $row) {
                            //             if (!empty($row['raw_material_product_id'])) {
                            //                 $hasConsumption = true;
                            //                 $raw_material_id = $row['raw_material_product_id'];
                            //                 $quantity = $row['quantity'];
                                           
                            //                 $inward_quantity = $obj->getInwardQty($edit_id, $raw_material_id, $unit_id[$i]);
                            //                 $outward_quantity = $obj->getOutwardQty($edit_id, $raw_material_id, $unit_id[$i]);
                            //             }

                            //             $current_stock = $inward_quantity - $outward_quantity;
                            //             if($current_stock < 0) {
                            //                 $current_stock = 0;
                            //             }

                            //             if (!empty($raw_material_id) && $current_stock) {
                            //                 $raw_material_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $raw_material_id, 'product_name');
                            //                 if (!empty($raw_material_name)) {
                            //                     $raw_material_name = $obj->encode_decode('decrypt', $raw_material_name);
                            //                 }
                            //             }

                            //             if($quantity*$qty[$i] > $current_stock) {
                            //                 $quantity_error = "Stock";
                            //             } 
                            //             if(!empty($quantity_error)) {
                                           
                            //                 if(!empty($valid_form)) {
                            //                     $valid_form = $valid_form." ".$valid->row_error_display(
                            //                     $form_name,'qty[]',$quantity_error,'text','product_row',($i + 1));   
                            //                 }
                            //                 else {
                            //                    $valid_form = $valid->row_error_display(
                            //                         $form_name,
                            //                         'qty[]',
                            //                         $quantity_error . '<br><br><span class="custom-tooltip"><i class="bi bi-info-square fs-15"></i><span class="tooltip-text">Available Stock<br>' . htmlspecialchars($raw_material_name) . ' - ' . htmlspecialchars($current_stock) . '</span></span>',
                            //                         'text',
                            //                         'product_row',
                            //                         ($i+1)
                            //                     );

                            //                 }
                            //             }
                            //         }                
                            //     }
                            // }

                            if (!empty($product_id[$i]) && $product_id != $GLOBALS['null_value']) {
                                $inward_quantity = 0;
                                $outward_quantity = 0;
                                $current_stock = 0;
                                $hasConsumption = false;
                                $quantity_error = "";

                                $consumptionData = $obj->getTableRecords($GLOBALS['product_table'], 'product_id', $product_id[$i], '');

                              ;
                                
                                if (!empty($consumptionData)) {
                                    foreach ($consumptionData as $row) {
                                        if (!empty($row['raw_material_product_id'])) {
                                            $hasConsumption = true;

                                            $raw_material_ids = explode(",", $row['raw_material_product_id']);
                                            $quantities = explode(",", $row['quantity']);

                                            $tooltip_table = '<table class="tooltip-table "><thead><tr><th>Product</th><th>Stock</th></tr></thead><tbody>';
                                            
                                            for ($j = 0; $j < count($raw_material_ids); $j++) {
                                                $raw_material_id = trim($raw_material_ids[$j]);
                                                $raw_material_unit_id = $obj->getTableColumnValue($GLOBALS['product_table'],'product_id',$raw_material_id,'unit_id');
                                                $required_qty = isset($quantities[$j]) ? trim($quantities[$j]) : 0;

                                                if (!empty($raw_material_id) && $raw_material_id != $GLOBALS['null_value']) {
                                                $inward_quantity = $obj->getInwardQty($edit_id, $raw_material_id, $raw_material_unit_id);
                                                $outward_quantity = $obj->getOutwardQty($edit_id, $raw_material_id, $raw_material_unit_id);
                                                $current_stock = $inward_quantity - $outward_quantity;

                                                if ($current_stock < 0) {
                                                    $current_stock = 0;
                                                }

                                                $raw_material_name = $obj->getTableColumnValue($GLOBALS['product_table'], 'product_id', $raw_material_id, 'product_name');
                                                if (!empty($raw_material_name)) {
                                                    $raw_material_name = $obj->encode_decode('decrypt', $raw_material_name);
                                                }

                                                // Add to tooltip
                                                $tooltip_table .= '<tr><td>' . htmlspecialchars($raw_material_name) . '</td><td>' . htmlspecialchars($current_stock) . '</td></tr>';

                                                // Check stock requirement
                                                if(!empty($required_qty) && $required_qty != $GLOBALS['null_value']){
                                                    if ($required_qty * $qty[$i] > $current_stock) {
                                                        $quantity_error = "Insufficient Stock";
                                                    }
                                                }
                                            }
                                            }

                                            $tooltip_table .= '</tbody></table>';

                                            // Show error
                                            if (!empty($quantity_error)) {
                                                $tooltip_html = '<span class="custom-tooltip"><i class="bi bi-info-square fs-15"></i><span class="tooltip-text">Available Stock<br>' . $tooltip_table . '</span></span>';

                                                if (!empty($valid_form)) {
                                                    $valid_form .= " " . $valid->row_error_display(
                                                        $form_name, 'qty[]', $quantity_error, 'text', 'product_row', ($i + 1)
                                                    );
                                                } else {
                                                    $valid_form = $valid->row_error_display(
                                                        $form_name,
                                                        'qty[]',
                                                        $quantity_error . '<br><br>' . $tooltip_html,
                                                        'text',
                                                        'product_row',
                                                        ($i + 1)
                                                    );
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                                             
                        }else{
                            $quantity_error = "Invalid Total";
                            if(!empty($valid_form)) {
                                $valid_form = $valid_form." ".$valid->row_error_display($form_name, 'price[]', $quantity_error, 'text', 'product_row', ($i+1));
                            }
                            else {
                                $valid_form = $valid->row_error_display($form_name, 'price[]', $quantity_error, 'text', 'product_row', ($i+1));
                            }                            
                        }               
                    }else{
                        $quantity_error = "Enter the Quantity";
                        if(!empty($valid_form)) {
                            $valid_form = $valid_form." ".$valid->row_error_display($form_name, 'qty[]', $quantity_error, 'text', 'product_row', ($i+1));
                        }
                        else {
                            $valid_form = $valid->row_error_display($form_name, 'qty[]', $quantity_error, 'text', 'product_row', ($i+1));
                        }
                    }               
                    $price[$i] = trim($price[$i]);
                    if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $price[$i]) && $price[$i] <= 99999999 && $price[$i] > 0) {

                    } else {
                            $quantity_error = "Invalid Amount";
                            if(!empty($valid_form)) {
                                $valid_form = $valid_form." ".$valid->row_error_display($form_name, 'price[]', $quantity_error, 'text', 'product_row', ($i+1));
                            }
                            else {
                                $valid_form = $valid->row_error_display($form_name, 'price[]', $quantity_error, 'text', 'product_row', ($i+1));
                            }
                    }
                    $product_name[$i] = $obj->encode_decode('encrypt', $product_name[$i]);
                }else {
                        $quantity_error = "Enter the Product Name";
                        if(!empty($valid_form)) {
                            $valid_form = $valid_form." ".$valid->row_error_display($form_name, 'product_name[]', $quantity_error, 'text', 'product_row', ($i+1));
                        }
                        else {
                            $valid_form = $valid->row_error_display($form_name, 'product_name[]', $quantity_error, 'text', 'product_row', ($i+1));
                        }
                    }
            }
        }  else {
            $quantity_error = "Please Append Atleast one Product";
        }
        $total_amount = $sub_total;
           if(empty($valid_form)){
           if(isset($_POST['charges_id'])) {
                $charges_id = $_POST['charges_id'];
            }
        
            if(isset($_POST['charges_value'])) {
                $charges_values = $_POST['charges_value'];
            }

            $discount_option =""; $discount_option_error ="";  $discount =""; $discount_error ="";  

            if(isset($_POST['discount_name'])) {
                $discount_name = $_POST['discount_name'];
            }
            if(isset($_POST['charges_value'])) {
                $charges_values = $_POST['charges_value'];
            }
            
            if(isset($_POST['discount'])) {
                $discount = $_POST['discount'];
                $discount = trim($discount);
            }
            
            if(!empty($discount) && empty($quantity_error)) {
                if(empty($discount_name)){
                    $quantity_error = "Enter Discount Name";
                }
                else{
                    if(empty($discount)){
                        $quantity_error = "Enter Discount Value";
                    }
                    if(strpos($discount, '%') !== false) {
                        $discount_percent = str_replace('%', '', $discount);
                        $discount_percent = trim($discount_percent);
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $discount_percent) && ($discount_percent > 0) && ($discount_percent < 100)){
                            $discount_value = ($discount_percent * $sub_total) / 100;
                        }
                        else {
                            $quantity_error = "Invalid Discount";
                        }
                    }
                    else {
                        if(preg_match("/^[0-9]+(\\.[0-9]+)?$/", $discount) && ($discount > 0) && ($discount <= $sub_total)){
                            $discount_value = $discount;
                        }
                        else {
                            $quantity_error = "Invalid Discount";
                        }
                    }
                    if(!empty($discount_value)) {
                        $discount_value = number_format($discount_value, 2);
                        $discount_value = str_replace(",", "", $discount_value);
                        $total_amount = $total_amount - $discount_value;
                    }
                }
                
            }
            $discounted_total = $total_amount;   
            
            $charges_total_amounts = array();
            if(!empty($charges_values) && empty($quantity_error)) {
               
                for($i=0; $i < count($charges_id); $i++) {
                    $charges_id[$i] = trim($charges_id[$i]);
                    if(!empty($charges_id[$i])) {
                        if(empty($charges_values[$i])){
                           $quantity_error="Enter Charges value";
                        }
                        $charges_name = ""; $charges_value = 0;
                        $charges_name = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $charges_id[$i], 'charges_name');
                        $charges_names[$i] = $charges_name;
                        $charges_values[$i] = trim($charges_values[$i]);
                        if(isset($charges_values[$i])) {
                            $charges_error = "";
                            if(strpos($charges_values[$i], '%') !== false) {
                                $charges_value = str_replace('%', '', $charges_values[$i]);
                                $charges_value = trim($charges_value);
                            }
                            else {
                                $charges_value = $charges_values[$i];
                            }
                            $charges_error = $valid->valid_price($charges_value, ($obj->encode_decode('decrypt', $charges_name)), 1, '');
                            if(!empty($charges_error)) {
                                if(!empty($sales_bill_error)) {
                                    $sales_bill_error = $sales_bill_error."<br>".$charges_error;
                                }
                                else {
                                    $sales_bill_error = $charges_error;
                                }
                            }
                            else {
                                if(strpos($charges_values[$i], '%') !== false) {
                                    $charges_value = ($charges_value * $total_amount) / 100;
                                    $charges_value = number_format($charges_value, 2);
                                    $charges_value = str_replace(",", "", $charges_value);
                                }
                            }
                        }
                        if(empty($sales_bill_error)) {
                            $charges_total[$i] = $charges_value;
                            
                            $total_amount += $charges_value;


                            
                        }
                        $charges_total_amounts[] = $total_amount;
                    }else{
                        if(!empty($charges_values[$i])){
                           $quantity_error="Select Charges";
                        }
                    }
                    if(empty($sales_bill_error)) {
                        for($j=$i+1; $j < count($charges_id); $j++) {
                            if($charges_id[$i] == $charges_id[$j]) {
                                $sales_bill_error = "Same Charges Repeatedly Exists";
                                break;
                            }
                              
                        }
                    }

                }
            }    
             
        }

        $round_off =0;  $round_off_type =""; $round_off_value ="";
        if(!empty($total_amount)) {	
            // echo $_POST['round_off'];
            if(isset($_POST['round_off']))
            {
                $round_off = $_POST['round_off'];
            }
            else
            {
                $round_off ="2";
            }
            if(isset($_POST['round_off_type']))
            {
                $round_off_type = $_POST['round_off_type'];
            }
            if(isset($_POST['round_off_value']))
            {
                $round_off_value = $_POST['round_off_value'];
            }

            if($round_off == '2')
            {
                /*  25062025 changed lines */

                        // if($round_off_value < 10) {
                        //     $round_off_value = ".0".$round_off_value;
                        // }
                        // else {
                            $round_off_value = ".".$round_off_value;
                        // }

                        // echo $round_off_value."hai";
                        if($round_off_type == '1')
                        {
                            // $round_off_value = ".".$round_off_value;
                            $total_amount = $total_amount+$round_off_value;
                            // echo $total_amount;
                        }
                        else if($round_off_type == '2')
                        {
                            // $round_off_value = ".".$round_off_value;
                            $total_amount = $total_amount-$round_off_value;
                        }
                    /*  ---  */
            }
            else
            {
                if(!empty($total_amount)) {	
                    if (strpos( $total_amount, "." ) !== false) {
                        $pos = strpos($total_amount, ".");
                        $decimal = substr($total_amount, ($pos + 1), strlen($total_amount));
                        if($decimal != "00") {
                            if(strlen($decimal) == 1) {
                                $decimal = $decimal."0";
                            }
                            if($decimal >= 50) {				
                                $rnd_off = 100 - $decimal;
                                if($rnd_off < 10) {
                                    $rnd_off = "0.0".$rnd_off;
                                }
                                else {
                                    $rnd_off = "0.".$rnd_off;
                                }
                                
                                $total_amount = $total_amount + $rnd_off;
                            }
                            else {
                                $decimal = "0.".$decimal;
                                $rnd_off = "-".$decimal;
                                $total_amount = $total_amount - $decimal;
                            }
                        }
                    }
                }
            }
        }
        $grand_total = $total_amount;  
        $result = "";
       
        if(empty($valid_form) && empty($quantity_error)) {
             $sales_invoice_data = [
                "party_number" => $party_number,
                "party_id" => $party_id,
                "party_name" => $party_name,
                "sales_bill_total" => $grand_total
             ];
            $result = array('number' => '1', 'msg' => 'Sales Entry Successfully Created', 'salesInvoiceData' => $sales_invoice_data);
        }         
        else{
            if(!empty($valid_form)) {
                $result = array('number' => '3', 'msg' => $valid_form);            
            }else if(!empty($quantity_error)) {
                $result = array('number' => '2', 'msg' => $quantity_error);            
            }
        }
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;                    
    }   
    
    if(isset($_REQUEST['get_party_id'])) {
        $party_id = $_REQUEST['get_party_id'];
        if($party_id == '1'){
            echo "Counter Sales";
        }else{
            $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $party_id, 'party_name');
            if(!empty($party_name) && $party_name != $GLOBALS['null_value']) {
                $party_name = $obj->encode_decode('decrypt', $party_name);
                echo $party_name;
            }
        }
       
    }

    if(isset($_REQUEST['display_charges'])){
        $display_charges =$_REQUEST['display_charges'];
        $charges_list =array();
        $charges_list = $obj->getTableRecords($GLOBALS['charges_table'],'','',''); ?>
        <div class="row charges_row pt-2 div_charges">
            <div class="col-1 align-self-center" onclick="Javascript:removeCharges(this);">
                <i class="bi bi-x-circle"></i>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <select class="select2 select2-danger" name="charges_id[]"  data-dropdown-css-class="select2-danger" style="width: 100%;" >
                        <option value="">Select</option>
                        <?php
                            if(!empty($charges_list)) {
                                foreach ($charges_list as $data) {
                                    if(!empty($data['charges_id']) && $data['charges_id'] != $GLOBALS['null_value']) {
                                        ?>
                                        <option value="<?php echo $data['charges_id']; ?>">
                                            <?php
                                                if(!empty($data['charges_name']) && $data['charges_name'] != $GLOBALS['null_value']) {
                                                    echo $obj->encode_decode('decrypt', $data['charges_name']);
                                                }
                                            ?>
                                        </option>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </select>
                        <label class="f-10">Select Charges </label>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group mb-1">
                    <div class="form-label-group in-border">
                        <input type='hidden' name='hidden_charges[]' id='hidden_charges' value="">
                        <input type="text"  name="charges_value[]" onkeyup="Javascript:CheckCharges();" value="" class="form-control shadow-none">
                        <label class="f-10">Rupees</label>
                    </div>
                </div> 
            </div>
            <div class="col-3 d-flex text-end">
                    <i class="bi bi-currency-rupee"></i><p class="charges_total"></p>
            </div>
            <div class="d-flex p-1 border-top">
                <div class="w-75">
                    Total Amount
                </div>
                <div class="w-25 text-end">
                    <i class="bi bi-currency-rupee"></i><span class="charges_sub_total">0.00
                </div>
            </div>  
        </div>
        <script src="include/select2/js/select2.min.js"></script>
        <script src="include/select2/js/select.js"></script>
        <?php 
    }

    if(isset($_REQUEST['selected_bank_payment_mode'])) {
        $selected_bank_payment_mode = "";
        $selected_bank_payment_mode = $_REQUEST['selected_bank_payment_mode'];
        
        if(!empty($selected_bank_payment_mode)) {
            $bank_list = array();
            $bank_list = $obj->getTableRecords($GLOBALS['bank_table'], 'bill_company_id', $GLOBALS['bill_company_id'],'');
            $filtered_banks = array();
            foreach($bank_list as $bank) {
                $payment_modes = explode(',', $bank['payment_mode_id']);
                if (in_array($selected_bank_payment_mode, $payment_modes)) {
                    $filtered_banks[] = $bank;
                }
            }

            if(!empty($filtered_banks)){
                ?>
                    <option value="">Select Bank</option>
                    <?php
                        foreach ($filtered_banks as $list){
                            ?>
                            <option value="<?php if(!empty($list['bank_id'])){echo $list['bank_id'];} ?>" <?php if(!empty($bank_id) && $list['bank_id'] == $bank_id){ ?>selected<?php } ?>> 
                            <?php
                                $account_name = "";
                                $account_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $list['bank_id'], 'bank_name');
                                if(!empty($account_name)) {
                                    $account_name = $obj->encode_decode('decrypt', $account_name);
                                    echo $account_name;
                                }
                                ?>
                            </option>
                            <?php
                        }
                    ?>
                <?php
            }

        }
    }

    if(isset($_REQUEST['payment_row_index'])) {
    $payment_row_index = $_REQUEST['payment_row_index'];

    $payment_mode_id = $_REQUEST['selected_payment_mode_id'];
    $payment_mode_id = trim($payment_mode_id);

    $bank_id = $_REQUEST['selected_bank_id'];
    $bank_id = trim($bank_id);

    $amount = $_REQUEST['selected_amount'];
    $amount = trim($amount);
    ?>
    <tr class="payment_row" id="payment_row<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>">
        <td class="sno text-center">
            <?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>
        </td>
        <td class="text-center">
            <?php
                $payment_mode_name = "";
                $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_id, 'payment_mode_name');
                echo $obj->encode_decode('decrypt', $payment_mode_name);
            ?>
            <input type="hidden" name="payment_mode_id[]" value="<?php if(!empty($payment_mode_id)) { echo $payment_mode_id; } ?>">
        </td>
        <td class="text-center">
            <?php
                $bank_name = "";
                $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id, 'bank_name');
                if(!empty($bank_name) && $bank_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $bank_name);
                }
                else {
                    echo '-';
                }   
            ?>
            <input type="hidden" name="bank_id[]" value="<?php if(!empty($bank_id)) { echo $bank_id; } ?>">
        </td>
        <td class="text-center">
            <input type="text" name="amount[]" style="width:75%!important;margin:auto!important;" class="form-control shadow-none px-1 text-center" value="<?php if(!empty($amount)) { echo $amount; } ?>" onfocus="Javascript:KeyboardControls(this,'number','','');" onkeyup="Javascript:PaymentTotal();InputBoxColor(this, 'text');">
        </td>
        <td class="text-center">
            <button class="btn btn-danger" type="button" onclick="Javascript:DeleteRow('payment_row', '<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>');"><i class="fa fa-trash"></i></button>
        </td>
    </tr>
    <?php
}




	if(isset($_REQUEST['change_party'])) {
		$party_list = array();
		$party_list = $obj->getTableRecords($GLOBALS['party_table'], 'bill_company_id', $GLOBALS['bill_company_id']);
		
		?>
		<option value="">Select</option>
		<?php
		if(!empty($party_list)) {
			foreach($party_list as $data) {
				if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
					?>
					<option value="<?php echo $data['party_id']; ?>">
						<?php
							if(!empty($data['party_name']) && $data['party_name'] != $GLOBALS['null_value']) {
								echo $obj->encode_decode('decrypt', $data['party_name']);
							}
						?>
					</option>
					<?php
				}
			}
		}
	}

        
	if(isset($_REQUEST['change_product'])) {
		$product_list = array();
		$product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '');
		
		?>
		<option value="">Select</option>
		<?php
		if(!empty($product_list)) {
			foreach($product_list as $data) {
				if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
					?>
					<option value="<?php echo $data['product_id']; ?>">
						<?php
							if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
								echo $obj->encode_decode('decrypt', $data['product_name']);
							}
						?>
					</option>
					<?php
				}
			}
		}
	}
    if(isset($_REQUEST['selected_party_type'])) {
        $selected_party_type = $_REQUEST['selected_party_type'];
        
		$party_list = array(); $party_type = ""; $branch_party_list = array();
        if($selected_party_type == 'Consignor'){
            $party_type = 'consignor';
        }else if($selected_party_type == 'Consignee'){
            $party_type = 'consignee';
        }else{
            $party_type = 'account_party';
        }
        // echo $GLOBALS[$party_type.'_table'];
        if(!empty($login_branch_id)){
            $branch_party_list = $obj->BranchLoginPartyList($party_type,$login_branch_id);
        }else{
	    	$party_list = $obj->getTableRecords($GLOBALS[$party_type.'_table'], '', '');

        }
            if(!empty($selected_party_type)){

                if(empty($login_branch_id)){
                        ?>
                        <option value="">Select</option>
                        <?php
                        if(!empty($party_list)) {
                            foreach($party_list as $data) {
                                if(!empty($data[$party_type.'_id']) && $data[$party_type.'_id'] != $GLOBALS['null_value']) {
                                    ?>
                                    <option value="<?php echo $data[$party_type.'_id']; ?>">
                                        <?php
                                            if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                echo $obj->encode_decode('decrypt', $data['name']);
                                            }
                                            if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                                echo ' - ('. $obj->encode_decode('decrypt', $data['mobile_number']).')';
                                            }
                                        ?>
                                    </option>
                                    <?php
                                }
                            }
                        }
                
                }else{  ?>
                        <option value="">Select</option>
                            <?php
                        if(!empty($branch_party_list)) {
                            foreach($branch_party_list as $value) {
                                if(!empty($value[$party_type.'_id']) && $value[$party_type.'_id'] != $GLOBALS['null_value']) {
                                    ?>
                                    
                                    <option value="<?php echo $value[$party_type.'_id']; ?>">
                                        <?php
                                        $party_name = "";
	    	                            $party_name = $obj->getTableColumnValue($GLOBALS[$party_type.'_table'], $party_type.'_id', $value[$party_type.'_id'],'name');
                                            if(!empty($party_name) && $party_name != $GLOBALS['null_value']) {
                                                echo $obj->encode_decode('decrypt', $party_name);
                                            }
                                            // if(!empty($value['name']) && $value['name'] != $GLOBALS['null_value']) {
                                            //     echo $obj->encode_decode('decrypt', $value['name']);
                                            // }
                                            // if(!empty($value['mobile_number']) && $value['mobile_number'] != $GLOBALS['null_value']) {
                                            //     echo ' - ('. $obj->encode_decode('decrypt', $value['mobile_number']).')';
                                            // }
                                        ?>
                                    </option>
                                    <?php
                                }
                            }
                        }
                    
                }
            }else{ ?>
                <option value="">Select</option>

            <?php

            }
	}
    
	if(isset($_REQUEST['sales_report_party_type'])) {
        $party_type ="";
        $party_type = $_REQUEST['sales_report_party_type'];
		$party_list = array();
		$party_list = $obj->getTableRecords($GLOBALS[$party_type.'_table'], 'bill_company_id', $GLOBALS['bill_company_id']);
		
		?>
		<option value="">Select</option>
		<?php
		if(!empty($party_list)) {
			foreach($party_list as $data) {
				if(!empty($data[$party_type.'_id']) && $data[$party_type.'_id'] != $GLOBALS['null_value']) {
					?>
					<option value="<?php echo $data['party_id']; ?>">
						<?php
							if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
								echo $obj->encode_decode('decrypt', $data['name']);
							}
						?>
					</option>
					<?php
				}
			}
		}
	}


?>