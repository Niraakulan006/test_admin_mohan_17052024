<?php
    include("include_files.php");

    if(isset($_REQUEST['unit_price_index'])) {
        $product_row_index = trim($_REQUEST['unit_price_index']);

        $unit_list = array();
        $unit_list = $obj->getTableRecords($GLOBALS['unit_table'], '', '', '');
        ?>
        <tr class="product_row" id="product_row<?php echo $product_row_index; ?>">
            <th class="text-center px-2 py-2 sno"><?php echo $product_row_index; ?></th>
            <th class="text-center px-2 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border" style="min-width:80px!important;">
                        <select name="unit_id[]" class="form-control shadow-none" style="width:100%!important;">
                            <option value="">Select</option>
                            <?php
                                if(!empty($unit_list)) {
                                    foreach($unit_list as $data) {
                                        if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                                            ?>
                                            <option value="<?php echo $data['unit_id']; ?>">
                                                <?php
                                                    if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $data['unit_name']);
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </th>
            <th class="text-center px-2 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <input type="text" name="price_value[]" class="form-control shadow-none mx-auto" style="min-width:80px!important;" onfocus="Javascript:KeyboardControls(this,'number','','');" onkeyup="Javascript:InputBoxColor(this, 'text');">
                    </div>
                </div>
            </th>
            <th class="text-center px-2 py-2">
                <div class="form-group">
                    <div class="form-label-group in-border">
                        <input type="text" name="cooly_value[]" class="form-control shadow-none mx-auto" style="min-width:80px!important;" onfocus="Javascript:KeyboardControls(this,'number','','');" onkeyup="Javascript:InputBoxColor(this, 'text');">
                    </div>
                </div>
            </th>
            <th class="text-center px-2 py-2">
                <button class="btn btn-danger px-2 py-1" type="button" style="font-size:10px!important;" onclick="Javascript:DeleteUnitPriceRow('product_row', '<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>');"><i class="fa fa-trash"></i></button>
            </th>
            <script type="text/javascript">
                if(jQuery('#product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>').find('select').length > 0) {
                    jQuery('#product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>').find('select').select2();
                }
            </script>
        </tr>
        <?php
    }

    if(isset($_REQUEST['get_multiple_branch_list'])) {
        $from_branch_id = trim($_REQUEST['get_multiple_branch_list']);
        $branch_list = array();
		if(!empty($from_branch_id)) {
			$branch_list = $obj->ToBranchList($from_branch_id);
		}
		if(!empty($branch_list)) {
			foreach($branch_list as $data) {
                if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value']) {
                    ?>
                    <option value="<?php echo $data['branch_id']; ?>">
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

    if(isset($_REQUEST['get_from_branch_lr'])) {
        $from_branch_id = trim($_REQUEST['get_from_branch_lr']);

        $to_branch_ids = array();
        if(isset($_REQUEST['get_to_branch_lr'])) {
            $to_branch_ids = trim($_REQUEST['get_to_branch_lr']);
        }

        $lr_list = array();
        $from_date = ""; $to_date = "";
        if(isset($_SESSION['billing_year_starting_date']) && !empty($_SESSION['billing_year_starting_date'])) {
            $from_date = $_SESSION['billing_year_starting_date'];
            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
            }
        }			
        if(isset($_SESSION['billing_year_ending_date']) && !empty($_SESSION['billing_year_ending_date'])) {
            $to_date = $_SESSION['billing_year_ending_date'];
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
            }
        }
        if(!empty($from_branch_id)) {
            $lr_list = $obj->GetLRListByBranch($from_date, $to_date, $from_branch_id, $to_branch_ids);
        }
        ?>
        <option value="">Select LR.No</option>
        <?php
        if(!empty($lr_list)) {
            foreach($lr_list as $data) {
                if(!empty($data['lr_id']) && $data['lr_id'] != $GLOBALS['null_value']) {
                    ?>
                    <option value="<?php echo $data['lr_id']; ?>">
                        <?php
                            if(!empty($data['lr_number']) && $data['lr_number'] != $GLOBALS['null_value']) {
                                echo $data['lr_number'];
                            }
                        ?>
                    </option>
                    <?php
                }
            }
        }
    }

    if(isset($_REQUEST['selected_tripsheet_number'])) {
		$selected_tripsheet_number = trim($_REQUEST['selected_tripsheet_number']);
        $invoice_number_list = array();

        $from_date = "";
        if(isset($_SESSION['billing_year_starting_date']) && !empty($_SESSION['billing_year_starting_date'])) {
            $from_date = $_SESSION['billing_year_starting_date'];
            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
            }
        }
        $to_date = "";
        if(isset($_SESSION['billing_year_ending_date']) && !empty($_SESSION['billing_year_ending_date'])) {
            $to_date = $_SESSION['billing_year_ending_date'];
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
            }
        }
        $where = ""; $from_where = "";
        if(!empty($login_branch_id)) {
            for($i=0; $i < count($login_branch_id); $i++) {
                if(!empty($from_where)) {
                    $from_where = $from_where." OR FIND_IN_SET('".$login_branch_id[$i]."', to_branch_id) ";
                }
                else {
                    $from_where = " FIND_IN_SET('".$login_branch_id[$i]."', to_branch_id) ";
                }
            }
        }
        if(!empty($from_where)) {
            $where = " (".$from_where.") AND ";
        }
        
        $select_query = "";
        if(!empty($from_date) && !empty($to_date)) {
            $select_query = "SELECT * FROM ".$GLOBALS['tripsheet_table']." WHERE ".$where." tripsheet_number = '".$selected_tripsheet_number."' AND DATE(tripsheet_date) >= '".$from_date."' AND DATE(tripsheet_date) <= '".$to_date."' AND cancelled = '0' AND deleted = '0'";
        }
        if(!empty($select_query)) {
            $invoice_number_list = $obj->getQueryRecords($GLOBALS['tripsheet_table'], $select_query);
        }
        $tripsheet_date = ""; $from_branch_id = ""; $from_branch_name = ""; $to_branch_ids = array(); $to_branch_names = array(); 
        $lr_ids = array(); $vehicle_id = ""; $vehicle_name = ""; $vehicle_number = ""; $driver_name = ""; $is_acknowledged = 0;
        $lr_count = 0; $lr_dates = array(); $lr_numbers = array(); $from_branch_lr_ids = array(); $to_branch_lr_ids = array();
        $consignor_ids = array(); $consignee_ids = array(); $quantity_values = array(); $weight_values = array();
        $price_per_qty_values = array(); $unit_ids = array(); $total_values = array(); $bill_types = array();
        if(!empty($invoice_number_list)) {
            foreach($invoice_number_list as $data) {
                if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") {
                    $tripsheet_date = date('d-m-Y', strtotime($data['tripsheet_date']));
                }
                if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) {
                    $from_branch_id = $data['from_branch_id'];
                }
                if(!empty($data['from_branch_name']) && $data['from_branch_name'] != $GLOBALS['null_value']) {
                    $from_branch_name = $obj->encode_decode('decrypt', $data['from_branch_name']);
                }
                if(!empty($data['to_branch_id']) && $data['to_branch_id'] != $GLOBALS['null_value']) {
                    $to_branch_ids = explode(',', $data['to_branch_id']);
                }
                if(!empty($data['to_branch_name']) && $data['to_branch_name'] != $GLOBALS['null_value']) {
                    $to_branch_names = explode(',', $data['to_branch_name']);
                }
                if(!empty($data['lr_id']) && $data['lr_id'] != $GLOBALS['null_value']) {
                    $lr_ids = explode(',', $data['lr_id']);
                    $lr_count = count($lr_ids);
                }
                if(!empty($data['vehicle_id']) && $data['vehicle_id'] != $GLOBALS['null_value']) {
                    $vehicle_id = $data['vehicle_id'];
                }
                if(!empty($data['vehicle_name']) && $data['vehicle_name'] != $GLOBALS['null_value']) {
                    $vehicle_name = $obj->encode_decode('decrypt', $data['vehicle_name']);
                }
                if(!empty($data['vehicle_number']) && $data['vehicle_number'] != $GLOBALS['null_value']) {
                    $vehicle_number = $obj->encode_decode('decrypt', $data['vehicle_number']);
                }
                if(!empty($data['driver_name']) && $data['driver_name'] != $GLOBALS['null_value']) {
                    $driver_name = $obj->encode_decode('decrypt', $data['driver_name']);
                }
                if(!empty($data['is_acknowledged'])) {
                    $is_acknowledged = $data['is_acknowledged'];
                }
                if(!empty($data['lr_date']) && $data['lr_date'] != $GLOBALS['null_value']) {
                    $lr_dates = explode("$$$", $data['lr_date']);
                }
                if(!empty($data['lr_number']) && $data['lr_number'] != $GLOBALS['null_value']) {
                    $lr_numbers = explode("$$$", $data['lr_number']);
                }
                if(!empty($data['from_branch_lr_id']) && $data['from_branch_lr_id'] != $GLOBALS['null_value']) {
                    $from_branch_lr_ids = explode("$$$", $data['from_branch_lr_id']);
                }
                if(!empty($data['to_branch_lr_id']) && $data['to_branch_lr_id'] != $GLOBALS['null_value']) {
                    $to_branch_lr_ids = explode("$$$", $data['to_branch_lr_id']);
                }
                if(!empty($data['consignor_id']) && $data['consignor_id'] != $GLOBALS['null_value']) {
                    $consignor_ids = explode("$$$", $data['consignor_id']);
                }
                if(!empty($data['consignee_id']) && $data['consignee_id'] != $GLOBALS['null_value']) {
                    $consignee_ids = explode("$$$", $data['consignee_id']);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity_values = explode("$$$", $data['quantity']);
                }
                if(!empty($data['weight']) && $data['weight'] != $GLOBALS['null_value']) {
                    $weight_values = explode("$$$", $data['weight']);
                }
                if(!empty($data['price_per_qty']) && $data['price_per_qty'] != $GLOBALS['null_value']) {
                    $price_per_qty_values = explode("$$$", $data['price_per_qty']);
                }
                if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                    $unit_ids = explode("$$$", $data['unit_id']);
                }
                if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                    $total_values = explode("$$$", $data['total_amount']);
                }
                if(!empty($data['bill_type']) && $data['bill_type'] != $GLOBALS['null_value']) {
                    $bill_types = explode("$$$", $data['bill_type']);
                }
            }
            $acknowledged_error = "";
            if(!empty($is_acknowledged) && $is_acknowledged == '1'){
                $acknowledged_error = "This invoice number is already acknowledged";
            }
            if(!empty($selected_tripsheet_number) && empty($acknowledged_error)) { 
                ?>
                <div class="col-lg-6 col-md-6 col-6">
                    <table class="table nowrap">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="font-weight-bold text-pinterest smallfnt pb-1 text-center">Tripsheet Date</div>
                                </td>
                                <td class="text-pinterest smallfnt font-weight-bold">
                                    <div> : 
                                        <?php 
                                            if(!empty($tripsheet_date)) { 
                                                echo date('d-m-Y',strtotime($tripsheet_date)); 
                                            }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="font-weight-bold text-pinterest smallfnt pb-1 text-center">Tripsheet Number</div>
                                </td>
                                <td class="text-pinterest smallfnt font-weight-bold">
                                    <div> : 
                                        <?php echo $selected_tripsheet_number; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="font-weight-bold text-pinterest smallfnt pb-1 text-center">From Branch</div>
                                </td>
                                <td class="text-pinterest smallfnt font-weight-bold">
                                    <div> : 
                                        <?php
                                            if(!empty($from_branch_name)) {
                                                echo $from_branch_name;
                                            }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>                
                </div> 
                <div class="col-lg-6 col-md-6 col-6">
                    <table class="table nowrap">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">LR count</div>
                                </td>
                                <td class="text-pinterest smallfnt font-weight-bold">
                                    <div> : 
                                        <?php if(!empty($lr_count)){ echo $lr_count; } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">Vehicle Name</div>
                                </td>
                                <td class="text-pinterest smallfnt font-weight-bold">
                                    <div> : 
                                        <?php if(!empty($vehicle_name)){ echo $vehicle_name; } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">Vehicle Number</div>
                                </td>
                                <td class="text-pinterest smallfnt font-weight-bold">
                                    <div> : 
                                        <?php if(!empty($vehicle_number)){ echo $vehicle_number; } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">Driver</div>
                                </td>
                                <td class="text-pinterest smallfnt font-weight-bold">
                                    <div> : 
                                        <?php if(!empty($driver_name)){ echo $driver_name; } ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive poppins smallfnt">
                    <input type="hidden" name="lr_count" value="<?php if(!empty($lr_count)) { echo $lr_count; } else { echo "0"; } ?>">
                    <table class="table nowrap table-bordered bill_lr_table">
                        <thead class="bg-pinterest">
                            <tr class="text-white">
                                <th class="text-center px-2 py-2">#</th>
                                <th class="text-center px-2 py-2">LR Date</th>
                                <th class="text-center px-2 py-2">LR No</th>
                                <th class="text-center px-2 py-2">Bill Type</th>
                                <th class="text-center px-2 py-2">Destination</th>
                                <th class="text-center px-2 py-2">Consignor</th>
                                <th class="text-center px-2 py-2">Consignee</th>
                                <th class="text-center px-2 py-2">Articles Qty / UNIT</th>
                                <th class="text-center px-2 py-2">Price/QTY</th>
                                <th class="text-center px-2 py-2">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sno = 1;
                                if(!empty($lr_ids)) {
                                    for($i=0; $i < count($lr_ids); $i++) {
                                        if(empty($login_branch_id) || (!empty($login_branch_id) && in_array($to_branch_lr_ids[$i], $login_branch_id))) {
                                            $invoice_status = "";
                                            $invoice_status = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $lr_ids[$i], 'invoice_status');
                                            if($invoice_status != 'C') {
                                                ?>
                                                <tr class="lr_row" id="lr_row<?php echo $i+1; ?>">
                                                    <th class="text-center px-2 py-2 sno">
                                                        <?php echo $sno++; ?>
                                                    </th>
                                                    <th class="text-center px-2 py-2">
                                                        <?php
                                                            if(!empty($lr_dates[$i]) && $lr_dates[$i] != "0000-00-00" && $lr_dates[$i] != $GLOBALS['null_value']) {
                                                                echo date('d-m-Y', strtotime($lr_dates[$i]));
                                                            } 
                                                        ?>
                                                    </th>
                                                    <th class="text-center px-2 py-2">
                                                        <?php
                                                            if(!empty($lr_numbers[$i])) {
                                                                echo $lr_numbers[$i];
                                                            }
                                                        ?>
                                                        <input type="hidden" name="lr_number[]" value="<?php if(!empty($lr_numbers[$i])) { echo $lr_numbers[$i]; } ?>">
                                                    </th>
                                                    <th class="text-center px-2 py-2">
                                                        <?php
                                                            if(!empty($bill_types[$i])) {
                                                                echo $bill_types[$i];
                                                            }
                                                        ?>
                                                    </th>
                                                    <th class="text-center px-2 py-2">
                                                        <?php
                                                            if(!empty($to_branch_lr_ids[$i])) {
                                                                $to_branch_lr_name = "";
                                                                $to_branch_lr_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $to_branch_lr_ids[$i], 'name');
                                                                if(!empty($to_branch_lr_name) && $to_branch_lr_name != $GLOBALS['null_value']) {
                                                                    echo $obj->encode_decode('decrypt', $to_branch_lr_name);
                                                                }
                                                            }
                                                        ?>
                                                    </th>  
                                                    <th class="text-center px-2 py-2">
                                                        <?php
                                                            if(!empty($consignor_ids[$i])) {
                                                                $consignor_name = "";
                                                                $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_ids[$i], 'name');
                                                                if(!empty($consignor_name) && $consignor_name != $GLOBALS['null_value']) {
                                                                    echo $obj->encode_decode('decrypt', $consignor_name);
                                                                }
                                                            }
                                                        ?>
                                                    </th>
                                                    <th class="text-center px-2 py-2">
                                                        <?php
                                                            if(!empty($consignee_ids[$i])) {
                                                                $consignee_name = "";
                                                                $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_ids[$i], 'name');
                                                                if(!empty($consignee_name) && $consignee_name != $GLOBALS['null_value']) {
                                                                    echo $obj->encode_decode('decrypt', $consignee_name);
                                                                }
                                                            }
                                                        ?>
                                                    </th>
                                                    <th class="text-center px-2 py-2">
                                                        <?php
                                                            $quantity = array();
                                                            if(!empty($quantity_values[$i])) {
                                                                $quantity = explode(',', $quantity_values[$i]);
                                                            }
                                                            $weight = array();
                                                            if(!empty($weight_values[$i])) {
                                                                $weight = explode(',', $weight_values[$i]);
                                                            }
                                                            $unit_id = array();
                                                            if(!empty($unit_ids[$i])) {
                                                                $unit_id = explode(',', $unit_ids[$i]);
                                                            }
                                                            if(!empty($quantity) && !empty($unit_id)) {
                                                                $last_count = 0;
                                                                $last_count = count($unit_id) - 1;
                                                                for($j=0; $j < count($unit_id); $j++) {
                                                                    if(!empty($quantity[$j])) {
                                                                        $unit_name = "";
                                                                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id[$j], 'unit_name');
                                                                        echo $quantity[$j]." / ".$obj->encode_decode('decrypt', $unit_name);
                                                                        if($j != $last_count) {
                                                                            echo "<br>";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            if(!empty($weight) && !empty($unit_id)) {
                                                                $last_count = 0;
                                                                $last_count = count($unit_id) - 1;
                                                                for($k=0; $k < count($unit_id); $k++) {
                                                                    if(!empty($weight[$k])) {
                                                                        $unit_name = "";
                                                                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id[$k], 'unit_name');
                                                                        echo $weight[$k]." / ".$obj->encode_decode('decrypt', $unit_name);
                                                                        if($k != $last_count) {
                                                                            echo "<br>";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </th>
                                                    <th class="text-center px-2 py-2">
                                                        <?php
                                                            if(!empty($price_per_qty_values[$i])) {
                                                                echo $price_per_qty_values[$i];
                                                            }
                                                        ?>
                                                    </th>
                                                    <th class="text-center px-2 py-2">
                                                        <?php
                                                            if(!empty($total_values[$i])) {
                                                                echo $total_values[$i];
                                                            }
                                                        ?>
                                                    </th>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark btnwidth submit_button" type="button" onClick="Javascript:SaveModalContent('Acknowledgement_form', 'invoice_acknowledgement_changes.php', 'invoice_acknowlegement.php');">Submit</button>
                </div>
                <?php 
            }
            else { 
                ?>
                <span style="color:red"><?php echo $acknowledged_error; ?></sapn>
                <?php 
            }
        }
        else { 
            if(!empty($selected_tripsheet_number)) {
                ?>
                <span style="color:red"><?php echo "This invoice number not exist"; ?></span>
                <?php 
            }
            else {
                ?>
                <span style="color:red"><?php echo "Enter Tripsheet Number"; ?></span>
                <?php 
            }
        }
        ?>
		<script type="text/javascript">
			calTotal();
		</script>  
		<?php        
	}

    if(isset($_REQUEST['selected_tripsheet_id'])) {
		$selected_tripsheet_id = trim($_REQUEST['selected_tripsheet_id']);
        $tripsheet_id_list = array();
        $tripsheet_id_list = $obj->getTableRecords($GLOBALS['tripsheet_table'], 'tripsheet_id', $selected_tripsheet_id);

        $tripsheet_date = ""; $from_branch_id = ""; $from_branch_name = ""; $to_branch_ids = array(); $to_branch_names = array(); 
        $lr_ids = array(); $vehicle_id = ""; $vehicle_name = ""; $vehicle_number = ""; $driver_name = ""; $is_acknowledged = 0;
        $lr_count = 0; $lr_dates = array(); $lr_numbers = array(); $from_branch_lr_ids = array(); $to_branch_lr_ids = array();
        $consignor_ids = array(); $consignee_ids = array(); $quantity_values = array(); $weight_values = array();
        $price_per_qty_values = array(); $unit_ids = array(); $total_values = array(); $bill_types = array(); $tripsheet_number = "";
        if(!empty($tripsheet_id_list)) {
            foreach($tripsheet_id_list as $data) {
                if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") {
                    $tripsheet_date = date('d-m-Y', strtotime($data['tripsheet_date']));
                }
                if(!empty($data['tripsheet_number']) && $data['tripsheet_number'] != $GLOBALS['null_value']) {
                    $tripsheet_number = $data['tripsheet_number'];
                }
                if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) {
                    $from_branch_id = $data['from_branch_id'];
                }
                if(!empty($data['from_branch_name']) && $data['from_branch_name'] != $GLOBALS['null_value']) {
                    $from_branch_name = $obj->encode_decode('decrypt', $data['from_branch_name']);
                }
                if(!empty($data['to_branch_id']) && $data['to_branch_id'] != $GLOBALS['null_value']) {
                    $to_branch_ids = explode(',', $data['to_branch_id']);
                }
                if(!empty($data['to_branch_name']) && $data['to_branch_name'] != $GLOBALS['null_value']) {
                    $to_branch_names = explode(',', $data['to_branch_name']);
                }
                if(!empty($data['lr_id']) && $data['lr_id'] != $GLOBALS['null_value']) {
                    $lr_ids = explode(',', $data['lr_id']);
                    $lr_count = count($lr_ids);
                }
                if(!empty($data['vehicle_id']) && $data['vehicle_id'] != $GLOBALS['null_value']) {
                    $vehicle_id = $data['vehicle_id'];
                }
                if(!empty($data['vehicle_name']) && $data['vehicle_name'] != $GLOBALS['null_value']) {
                    $vehicle_name = $obj->encode_decode('decrypt', $data['vehicle_name']);
                }
                if(!empty($data['vehicle_number']) && $data['vehicle_number'] != $GLOBALS['null_value']) {
                    $vehicle_number = $obj->encode_decode('decrypt', $data['vehicle_number']);
                }
                if(!empty($data['driver_name']) && $data['driver_name'] != $GLOBALS['null_value']) {
                    $driver_name = $obj->encode_decode('decrypt', $data['driver_name']);
                }
                if(!empty($data['is_acknowledged'])) {
                    $is_acknowledged = $data['is_acknowledged'];
                }
                if(!empty($data['lr_date']) && $data['lr_date'] != $GLOBALS['null_value']) {
                    $lr_dates = explode("$$$", $data['lr_date']);
                }
                if(!empty($data['lr_number']) && $data['lr_number'] != $GLOBALS['null_value']) {
                    $lr_numbers = explode("$$$", $data['lr_number']);
                }
                if(!empty($data['from_branch_lr_id']) && $data['from_branch_lr_id'] != $GLOBALS['null_value']) {
                    $from_branch_lr_ids = explode("$$$", $data['from_branch_lr_id']);
                }
                if(!empty($data['to_branch_lr_id']) && $data['to_branch_lr_id'] != $GLOBALS['null_value']) {
                    $to_branch_lr_ids = explode("$$$", $data['to_branch_lr_id']);
                }
                if(!empty($data['consignor_id']) && $data['consignor_id'] != $GLOBALS['null_value']) {
                    $consignor_ids = explode("$$$", $data['consignor_id']);
                }
                if(!empty($data['consignee_id']) && $data['consignee_id'] != $GLOBALS['null_value']) {
                    $consignee_ids = explode("$$$", $data['consignee_id']);
                }
                if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                    $quantity_values = explode("$$$", $data['quantity']);
                }
                if(!empty($data['weight']) && $data['weight'] != $GLOBALS['null_value']) {
                    $weight_values = explode("$$$", $data['weight']);
                }
                if(!empty($data['price_per_qty']) && $data['price_per_qty'] != $GLOBALS['null_value']) {
                    $price_per_qty_values = explode("$$$", $data['price_per_qty']);
                }
                if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                    $unit_ids = explode("$$$", $data['unit_id']);
                }
                if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                    $total_values = explode("$$$", $data['total_amount']);
                }
                if(!empty($data['bill_type']) && $data['bill_type'] != $GLOBALS['null_value']) {
                    $bill_types = explode("$$$", $data['bill_type']);
                }
            }
            if(!empty($tripsheet_number)) { 
                ?>
                <div class="row mx-0">
                    <div class="col-6">
                        <table class="table nowrap">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="font-weight-bold text-pinterest smallfnt pb-1 text-center">Tripsheet Date</div>
                                    </td>
                                    <td class="text-pinterest smallfnt font-weight-bold">
                                        <div> : 
                                            <?php 
                                                if(!empty($tripsheet_date)) { 
                                                    echo date('d-m-Y',strtotime($tripsheet_date)); 
                                                }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="font-weight-bold text-pinterest smallfnt pb-1 text-center">Tripsheet Number</div>
                                    </td>
                                    <td class="text-pinterest smallfnt font-weight-bold">
                                        <div> : 
                                            <?php echo $tripsheet_number; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="font-weight-bold text-pinterest smallfnt pb-1 text-center">From Branch</div>
                                    </td>
                                    <td class="text-pinterest smallfnt font-weight-bold">
                                        <div> : 
                                            <?php
                                                if(!empty($from_branch_name)) {
                                                    echo $from_branch_name;
                                                }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>                
                    </div> 
                    <div class="col-6">
                        <table class="table nowrap">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">LR count</div>
                                    </td>
                                    <td class="text-pinterest smallfnt font-weight-bold">
                                        <div> : 
                                            <?php if(!empty($lr_count)){ echo $lr_count; } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">Vehicle Name</div>
                                    </td>
                                    <td class="text-pinterest smallfnt font-weight-bold">
                                        <div> : 
                                            <?php if(!empty($vehicle_name)){ echo $vehicle_name; } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">Vehicle Number</div>
                                    </td>
                                    <td class="text-pinterest smallfnt font-weight-bold">
                                        <div> : 
                                            <?php if(!empty($vehicle_number)){ echo $vehicle_number; } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">Driver</div>
                                    </td>
                                    <td class="text-pinterest smallfnt font-weight-bold">
                                        <div> : 
                                            <?php if(!empty($driver_name)){ echo $driver_name; } ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive poppins smallfnt">
                        <input type="hidden" name="lr_count" value="<?php if(!empty($lr_count)) { echo $lr_count; } else { echo "0"; } ?>">
                        <table class="table nowrap table-bordered bill_lr_table">
                            <thead class="bg-pinterest">
                                <tr class="text-white">
                                    <th class="text-center px-2 py-2">#</th>
                                    <th class="text-center px-2 py-2">LR Date</th>
                                    <th class="text-center px-2 py-2">LR No</th>
                                    <th class="text-center px-2 py-2">Bill Type</th>
                                    <th class="text-center px-2 py-2">Destination</th>
                                    <th class="text-center px-2 py-2">Consignor</th>
                                    <th class="text-center px-2 py-2">Consignee</th>
                                    <th class="text-center px-2 py-2">Articles Qty / UNIT</th>
                                    <th class="text-center px-2 py-2">Price/QTY</th>
                                    <th class="text-center px-2 py-2">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sno = 1;
                                    if(!empty($lr_ids)) {
                                        for($i=0; $i < count($lr_ids); $i++) {
                                            if(empty($login_branch_id) || (!empty($login_branch_id) && in_array($to_branch_lr_ids[$i], $login_branch_id))) {
                                                $invoice_status = "";
                                                $invoice_status = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $lr_ids[$i], 'invoice_status');
                                                if($invoice_status == 'C') {
                                                    ?>
                                                    <tr class="lr_row" id="lr_row<?php echo $i+1; ?>">
                                                        <th class="text-center px-2 py-2 sno">
                                                            <?php echo $sno++; ?>
                                                        </th>
                                                        <th class="text-center px-2 py-2">
                                                            <?php
                                                                if(!empty($lr_dates[$i]) && $lr_dates[$i] != "0000-00-00" && $lr_dates[$i] != $GLOBALS['null_value']) {
                                                                    echo date('d-m-Y', strtotime($lr_dates[$i]));
                                                                } 
                                                            ?>
                                                        </th>
                                                        <th class="text-center px-2 py-2">
                                                            <?php
                                                                if(!empty($lr_numbers[$i])) {
                                                                    echo $lr_numbers[$i];
                                                                }
                                                            ?>
                                                        </th>
                                                        <th class="text-center px-2 py-2">
                                                            <?php
                                                                if(!empty($bill_types[$i])) {
                                                                    echo $bill_types[$i];
                                                                }
                                                            ?>
                                                        </th>
                                                        <th class="text-center px-2 py-2">
                                                            <?php
                                                                if(!empty($to_branch_lr_ids[$i])) {
                                                                    $to_branch_lr_name = "";
                                                                    $to_branch_lr_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $to_branch_lr_ids[$i], 'name');
                                                                    if(!empty($to_branch_lr_name) && $to_branch_lr_name != $GLOBALS['null_value']) {
                                                                        echo $obj->encode_decode('decrypt', $to_branch_lr_name);
                                                                    }
                                                                }
                                                            ?>
                                                        </th>  
                                                        <th class="text-center px-2 py-2">
                                                            <?php
                                                                if(!empty($consignor_ids[$i])) {
                                                                    $consignor_name = "";
                                                                    $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_ids[$i], 'name');
                                                                    if(!empty($consignor_name) && $consignor_name != $GLOBALS['null_value']) {
                                                                        echo $obj->encode_decode('decrypt', $consignor_name);
                                                                    }
                                                                }
                                                            ?>
                                                        </th>
                                                        <th class="text-center px-2 py-2">
                                                            <?php
                                                                if(!empty($consignee_ids[$i])) {
                                                                    $consignee_name = "";
                                                                    $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_ids[$i], 'name');
                                                                    if(!empty($consignee_name) && $consignee_name != $GLOBALS['null_value']) {
                                                                        echo $obj->encode_decode('decrypt', $consignee_name);
                                                                    }
                                                                }
                                                            ?>
                                                        </th>
                                                        <th class="text-center px-2 py-2">
                                                            <?php
                                                                $quantity = array();
                                                                if(!empty($quantity_values[$i])) {
                                                                    $quantity = explode(',', $quantity_values[$i]);
                                                                }
                                                                $weight = array();
                                                                if(!empty($weight_values[$i])) {
                                                                    $weight = explode(',', $weight_values[$i]);
                                                                }
                                                                $unit_id = array();
                                                                if(!empty($unit_ids[$i])) {
                                                                    $unit_id = explode(',', $unit_ids[$i]);
                                                                }
                                                                if(!empty($quantity) && !empty($unit_id)) {
                                                                    $last_count = 0;
                                                                    $last_count = count($unit_id) - 1;
                                                                    for($j=0; $j < count($unit_id); $j++) {
                                                                        if(!empty($quantity[$j])) {
                                                                            $unit_name = "";
                                                                            $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id[$j], 'unit_name');
                                                                            echo $quantity[$j]." / ".$obj->encode_decode('decrypt', $unit_name);
                                                                            if($j != $last_count) {
                                                                                echo "<br>";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                if(!empty($weight) && !empty($unit_id)) {
                                                                    $last_count = 0;
                                                                    $last_count = count($unit_id) - 1;
                                                                    for($k=0; $k < count($unit_id); $k++) {
                                                                        if(!empty($weight[$k])) {
                                                                            $unit_name = "";
                                                                            $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id[$k], 'unit_name');
                                                                            echo $weight[$k]." / ".$obj->encode_decode('decrypt', $unit_name);
                                                                            if($k != $last_count) {
                                                                                echo "<br>";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </th>
                                                        <th class="text-center px-2 py-2">
                                                            <?php
                                                                if(!empty($price_per_qty_values[$i])) {
                                                                    echo $price_per_qty_values[$i];
                                                                }
                                                            ?>
                                                        </th>
                                                        <th class="text-center px-2 py-2">
                                                            <?php
                                                                if(!empty($total_values[$i])) {
                                                                    echo $total_values[$i];
                                                                }
                                                            ?>
                                                        </th>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php 
            }
        }
        ?>
		<script type="text/javascript">
			calTotal();
		</script>  
		<?php        
	}
    
?>