<?php
    include("include_files.php");
    $login_staff_id = "";
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
			$login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			$permission_module = $GLOBALS['tripsheet_module'];
		}
	}
    if(isset($_REQUEST['show_tripsheet_profit_loss_id'])) {
        $show_tripsheet_profit_loss_id = trim($_REQUEST['show_tripsheet_profit_loss_id']);

        $trip_number = ""; $vehicle_id = ""; $driver_name = ""; $from_tripsheet_id = ""; $to_tripsheet_id = "";$expense_data = array();
        $from_tripsheet_date = ""; $to_tripsheet_date = ""; $from_tripsheet_number = ""; $to_tripsheet_number = "";
        $from_tripsheet_from_branch = ""; $from_tripsheet_to_branch = ""; $to_tripsheet_from_branch = ""; $to_tripsheet_to_branch = "";
        $from_tripsheet_quantity = ""; $from_tripsheet_weight = ""; $to_tripsheet_quantity = ""; $to_tripsheet_weight = "";
        $from_tripsheet_rent = ""; $to_tripsheet_rent = ""; $total_rent = ""; $trip_cost = ""; $balance = ""; $loading_wage = ""; 
        $night_food = ""; $driver_salary = ""; $tire_depreciation = "";            $company_expense_values = array(); $driver_diesel_amount = ""; $company_diesel_amount = ""; $company_expense_names = array();
        $toll_gate = ""; $net_balance = ""; $starting_km = ""; $ending_km = ""; $travelled_km = ""; $diesel = ""; $mileage = ""; 
        $trip_balance = ""; $advance = ""; $diesel_cost = ""; $diesel_cost_per_litre = ""; $expense_names = array(); 
        $expense_values = array(); $company_expense_type = ""; $driver_expense_type = ""; $tripsheet_status = array();
        // $expense_data = $obj->getTableRecords($GLOBALS['expense_table'], 'purchase_entry_id', $show_purchase_entry_id, '');
        $tripsheet_profit_loss_list = array();
        $tripsheet_profit_loss_list = $obj->getTableRecords($GLOBALS['tripsheet_profit_loss_table'], 'tripsheet_profit_loss_id', $show_tripsheet_profit_loss_id);
        if(!empty($tripsheet_profit_loss_list)) {
            foreach($tripsheet_profit_loss_list as $data) {
                if(!empty($data['trip_number']) && $data['trip_number'] != $GLOBALS['null_value']) {
                    $trip_number = $obj->encode_decode('decrypt', $data['trip_number']);
                }
                if(!empty($data['vehicle_id']) && $data['vehicle_id'] != $GLOBALS['null_value']) {
                    $vehicle_id = $data['vehicle_id'];
                }
                if(!empty($data['vehicle_number']) && $data['vehicle_number'] != $GLOBALS['null_value']) {
                    $vehicle_number = $obj->encode_decode('decrypt', $data['vehicle_number']);
                }
                if(!empty($data['driver_name']) && $data['driver_name'] != $GLOBALS['null_value']) {
                    $driver_name = $obj->encode_decode('decrypt', $data['driver_name']);
                }
                if(!empty($data['from_tripsheet_date']) && $data['from_tripsheet_date'] != "0000-00-00") {
                    $from_tripsheet_date = date('d-m-Y', strtotime($data['from_tripsheet_date']));
                }
                if(!empty($data['from_tripsheet_id']) && $data['from_tripsheet_id'] != $GLOBALS['null_value']) {
                    $from_tripsheet_id = $data['from_tripsheet_id'];
                }
                if(!empty($data['from_tripsheet_number']) && $data['from_tripsheet_number'] != $GLOBALS['null_value']) {
                    $from_tripsheet_number = $data['from_tripsheet_number'];
                }
                if(!empty($data['from_tripsheet_from_branch']) && $data['from_tripsheet_from_branch'] != $GLOBALS['null_value']) {
                    $from_tripsheet_from_branch = $data['from_tripsheet_from_branch'];
                }
                if(!empty($data['from_tripsheet_to_branch']) && $data['from_tripsheet_to_branch'] != $GLOBALS['null_value']) {
                    $from_tripsheet_to_branch = $data['from_tripsheet_to_branch'];
                }
                if(!empty($data['from_tripsheet_quantity']) && $data['from_tripsheet_quantity'] != $GLOBALS['null_value']) {
                    $from_tripsheet_quantity = $data['from_tripsheet_quantity'];
                }
                if(!empty($data['from_tripsheet_weight']) && $data['from_tripsheet_weight'] != $GLOBALS['null_value']) {
                    $from_tripsheet_weight = $data['from_tripsheet_weight'];
                }
                if(!empty($data['from_tripsheet_rent']) && $data['from_tripsheet_rent'] != $GLOBALS['null_value']) {
                    $from_tripsheet_rent = $data['from_tripsheet_rent'];
                }
                if(!empty($data['to_tripsheet_date']) && $data['to_tripsheet_date'] != "0000-00-00") {
                    $to_tripsheet_date = date('d-m-Y', strtotime($data['to_tripsheet_date']));
                }
                if(!empty($data['to_tripsheet_id']) && $data['to_tripsheet_id'] != $GLOBALS['null_value']) {
                    $to_tripsheet_id = $data['to_tripsheet_id'];
                }
                if(!empty($data['to_tripsheet_number']) && $data['to_tripsheet_number'] != $GLOBALS['null_value']) {
                    $to_tripsheet_number = $data['to_tripsheet_number'];
                }
                if(!empty($data['to_tripsheet_from_branch']) && $data['to_tripsheet_from_branch'] != $GLOBALS['null_value']) {
                    $to_tripsheet_from_branch = $data['to_tripsheet_from_branch'];
                }
                if(!empty($data['to_tripsheet_to_branch']) && $data['to_tripsheet_to_branch'] != $GLOBALS['null_value']) {
                    $to_tripsheet_to_branch = $data['to_tripsheet_to_branch'];
                }
                if(!empty($data['to_tripsheet_quantity']) && $data['to_tripsheet_quantity'] != $GLOBALS['null_value']) {
                    $to_tripsheet_quantity = $data['to_tripsheet_quantity'];
                }
                if(!empty($data['to_tripsheet_weight']) && $data['to_tripsheet_weight'] != $GLOBALS['null_value']) {
                    $to_tripsheet_weight = $data['to_tripsheet_weight'];
                }
                if(!empty($data['to_tripsheet_rent']) && $data['to_tripsheet_rent'] != $GLOBALS['null_value']) {
                    $to_tripsheet_rent = $data['to_tripsheet_rent'];
                }
                if(!empty($data['total_rent']) && $data['total_rent'] != $GLOBALS['null_value']) {
                    $total_rent = $data['total_rent'];
                }
                if(!empty($data['trip_cost']) && $data['trip_cost'] != $GLOBALS['null_value']) {
                    $trip_cost = $data['trip_cost'];
                }
                if(!empty($data['balance']) && $data['balance'] != $GLOBALS['null_value']) {
                    $balance = $data['balance'];
                }
                if(!empty($data['loading_wage']) && $data['loading_wage'] != $GLOBALS['null_value']) {
                    $loading_wage = $data['loading_wage'];
                }
                if(!empty($data['night_food']) && $data['night_food'] != $GLOBALS['null_value']) {
                    $night_food = $data['night_food'];
                }
                if(!empty($data['driver_salary']) && $data['driver_salary'] != $GLOBALS['null_value']) {
                    $driver_salary = $data['driver_salary'];
                }
                if(!empty($data['tire_depreciation']) && $data['tire_depreciation'] != $GLOBALS['null_value']) {
                    $tire_depreciation = $data['tire_depreciation'];
                }
                if(!empty($data['toll_gate']) && $data['toll_gate'] != $GLOBALS['null_value']) {
                    $toll_gate = $data['toll_gate'];
                }
                if(!empty($data['net_balance']) && $data['net_balance'] != $GLOBALS['null_value']) {
                    $net_balance = $data['net_balance'];
                }
                if(!empty($data['starting_km']) && $data['starting_km'] != $GLOBALS['null_value']) {
                    $starting_km = $data['starting_km'];
                }
                if(!empty($data['ending_km']) && $data['ending_km'] != $GLOBALS['null_value']) {
                    $ending_km = $data['ending_km'];
                }
                if(!empty($data['travelled_km']) && $data['travelled_km'] != $GLOBALS['null_value']) {
                    $travelled_km = $data['travelled_km'];
                }
                if(!empty($data['diesel']) && $data['diesel'] != $GLOBALS['null_value']) {
                    $diesel = $data['diesel'];
                }
                if(!empty($data['mileage']) && $data['mileage'] != $GLOBALS['null_value']) {
                    $mileage = $data['mileage'];
                }
                if(!empty($data['trip_balance']) && $data['trip_balance'] != $GLOBALS['null_value']) {
                    $trip_balance = $data['trip_balance'];
                }
                if(!empty($data['advance']) && $data['advance'] != $GLOBALS['null_value']) {
                    $advance = $data['advance'];
                }
                if(!empty($data['diesel_cost']) && $data['diesel_cost'] != $GLOBALS['null_value']) {
                    $diesel_cost = $data['diesel_cost'];
                }
                if(!empty($data['diesel_cost_per_litre']) && $data['diesel_cost_per_litre'] != $GLOBALS['null_value']) {
                    $diesel_cost_per_litre = $data['diesel_cost_per_litre'];
                }
                if(!empty($data['expense_name']) && $data['expense_name'] != $GLOBALS['null_value']) {
                    $expense_names = explode(',', $data['expense_name']);
                }
                if(!empty($data['expense_value']) && $data['expense_value'] != $GLOBALS['null_value']) {
                    $expense_values = explode(',', $data['expense_value']);
                }
                if(!empty($data['tripsheet_status']) && $data['tripsheet_status'] != $GLOBALS['null_value']) {
                    $tripsheet_status = explode(',', $data['tripsheet_status']);
                }
                if(!empty($data['driver_expense_type']) && $data['driver_expense_type'] != $GLOBALS['null_value']) {
                    $driver_expense_type = $data['driver_expense_type'];
                }
                if(!empty($data['company_expense_type']) && $data['company_expense_type'] != $GLOBALS['null_value']) {
                    $company_expense_type = $data['company_expense_type'];
                }
    
                if(!empty($data['driver_diesel_amount']) && $data['driver_diesel_amount'] != $GLOBALS['null_value']) {
                    $driver_diesel_amount = $data['driver_diesel_amount'];
                }
                if(!empty($data['company_expense_value']) && $data['company_expense_value'] != $GLOBALS['null_value']) {
                    $company_expense_values =  explode(',',$data['company_expense_value']);
                }
                if(!empty($data['company_expense_name']) && $data['company_expense_name'] != $GLOBALS['null_value']) {
                    $company_expense_names =  explode(',',$data['company_expense_name']);
                }
                if(!empty($data['company_diesel_amount']) && $data['company_diesel_amount'] != $GLOBALS['null_value']) {
                    $company_diesel_amount = $data['company_diesel_amount'];
                }
            }
        }

        
        $expense_category_list = array();
        $expense_category_list = $obj->getTableRecords($GLOBALS['expense_category_table'],'','','');

        $vehicle_list = array();
        $vehicle_list = $obj->getTableRecords($GLOBALS['vehicle_table'], '', '');

        $tripsheet_from_list = array();
        $tripsheet_from_list = $obj->getTripsheetListForProfitLoss($vehicle_id);

        $payment_mode_list = array(); 
		$payment_mode_list = $obj->BankLinkedPaymentModes();

        $expense_date = date("Y-m-d"); 
        $payment_mode_ids_edit = array();$payment_bank_id = array(); $edit_payment_amount = array();$expense_id="";$payment_mode_name = array();$bank_name = array();$payment_amount = array();$payment_total_amount = "";
        if(!empty($expense_data)){
            foreach($expense_data as $data) {
                if(!empty($data['payment_mode_id'])) {
                    $payment_mode_ids_edit = $data['payment_mode_id'];
                    $payment_mode_ids_edit = explode(",", $payment_mode_ids_edit);
                    $payment_mode_ids_edit = array_reverse($payment_mode_ids_edit);    
                }
                if(!empty($data['bank_id'])) {
                    $payment_bank_id = $data['bank_id'];
                    $payment_bank_id = explode(",", $payment_bank_id);
                    $payment_bank_id = array_reverse($payment_bank_id);
                }
                if(!empty($data['amount'])) {
                    $edit_payment_amount = $data['amount'];
                    $edit_payment_amount = explode(",", $edit_payment_amount);
                    $edit_payment_amount = array_reverse($edit_payment_amount);
                }
                if(!empty($data['expense_id'])) {
                    $expense_id = $data['expense_id'];
                }
                if(!empty($data['payment_mode_name'])) {
                    $payment_mode_name = $data['payment_mode_name'];
                    $payment_mode_name = explode(",", $payment_mode_name);
                    $payment_mode_name = array_reverse($payment_mode_name);
                }
                if(!empty($data['bank_name'])) {
                    $bank_name = $data['bank_name'];
                    $bank_name = explode(",", $bank_name);
                    $bank_name = array_reverse($bank_name);
                }
                if(!empty($data['amount'])) {
                    $payment_amount = $data['amount'];
                    $payment_amount = explode(",", $payment_amount);
                    $payment_amount = array_reverse($payment_amount);
                }            
                if(!empty($data['total_amount'])) {
                    $payment_total_amount = $data['total_amount'];
                }            
            }
        }
        ?>
        <form class="poppins pd-20 redirection_form" name="tripsheet_profit_loss_form" method="POST">
            <style>
				.select2-container .select2-selection--single {
					height: calc(2rem + 2px) !important;
				}
			</style>
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
                        <?php if(!empty($show_tripsheet_profit_loss_id)) { ?>
                            <h5 class="text-white">Edit TripSheet Profit Loss</h5>
                        <?php } else { ?>
                            <h5 class="text-white">Add TripSheet Profit Loss</h5>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('tripsheet_profit_loss.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row mx-0 p-2 justify-content-center">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_tripsheet_profit_loss_id)) { echo $show_tripsheet_profit_loss_id; } ?>">
                <input type="hidden" name="hidden_driver_expense_type" value="<?php if(!empty($driver_expense_type)) { echo $driver_expense_type; } ?>">
                 <input type="hidden" name="hidden_company_expense_type" value="<?php if(!empty($company_expense_type)) { echo $company_expense_type; } ?>">
                <input type="hidden" name="expense_id" id="expense_id" value="<?php if(!empty($expense_id)) { echo $expense_id; } ?>">   
                <div class="col-lg-2 col-md-4 col-6 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="trip_number" class="form-control shadow-none" value="<?php if(!empty($trip_number)) { echo $trip_number; } ?>" placeholder="">
                            <label>ட்ரிப் எண்</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="vehicle_id" class="form-control shadow-none" onchange="Javascript:GetTripsheet();">
                                <option value="">Select</option>
                                <?php
                                    if(!empty($vehicle_list)) {
                                        foreach($vehicle_list as $data) {
                                            if(!empty($data['vehicle_id']) && $data['vehicle_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['vehicle_id'] ?>" <?php if(!empty($vehicle_id) && $vehicle_id == $data['vehicle_id']) { ?>selected<?php } ?>>
                                                    <?php
                                                        if(!empty($data['vehicle_number']) && $data['vehicle_number'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['vehicle_number']);
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>வண்டி எண்</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="driver_name" class="form-control shadow-none" value="<?php if(!empty($driver_name)) { echo $driver_name; } ?>" placeholder="">
                            <label>டிரைவர்</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-0 p-2 justify-content-center">
                <div class="col-lg-3 col-md-6 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="from_tripsheet_id" class="form-control shadow-none" onchange="Javascript:GetToTripsheet();">
                                <option value="">Select</option>
                                <?php
                                    if(!empty($from_tripsheet_id)) {
                                        ?>
                                        <option value="<?php echo $from_tripsheet_id; ?>" selected>
                                            <?php
                                                if(!empty($from_tripsheet_number) && $from_tripsheet_number != $GLOBALS['null_value']) {
                                                    echo $from_tripsheet_number;
                                                }
                                            ?>
                                        </option>
                                        <?php
                                    }
                                    if(!empty($tripsheet_from_list)) {
                                        foreach($tripsheet_from_list as $data) {
                                            if(!empty($data['tripsheet_id']) && $data['tripsheet_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['tripsheet_id']; ?>">
                                                    <?php
                                                        if(!empty($data['tripsheet_number']) && $data['tripsheet_number'] != $GLOBALS['null_value']) {
                                                            echo $data['tripsheet_number'];
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Starting Trip</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="to_tripsheet_id" class="form-control shadow-none" onchange="Javascript:getTripsheetRow();">
                                <option value="">Select</option>
                                <?php
                                    if(!empty($to_tripsheet_id)) {
                                        ?>
                                        <option value="<?php echo $to_tripsheet_id; ?>" selected>
                                            <?php
                                                if(!empty($to_tripsheet_number) && $to_tripsheet_number != $GLOBALS['null_value']) {
                                                    echo $to_tripsheet_number;
                                                }
                                            ?>
                                        </option>
                                        <?php
                                    }
                                    if(!empty($tripsheet_from_list)) {
                                        foreach($tripsheet_from_list as $data) {
                                            if(!empty($data['tripsheet_id']) && $data['tripsheet_id'] != $GLOBALS['null_value'] && $data['tripsheet_id'] != $from_tripsheet_id) {
                                                ?>
                                                <option value="<?php echo $data['tripsheet_id']; ?>">
                                                    <?php
                                                        if(!empty($data['tripsheet_number']) && $data['tripsheet_number'] != $GLOBALS['null_value']) {
                                                            echo $data['tripsheet_number'];
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <label>Return Trip</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-0 p-2 justify-content-center <?php if(empty($show_tripsheet_profit_loss_id)) { ?>d-none<?php } ?> trip_details_div">
                <div class="table-responsive col-lg-10 col-md-12 col-12">
                    <table class="table table-nowrap table-bordered border nowrap smallfnt cursor text-center w-100 trip_details_table">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>தேதி</th>
                                <th>ட்ரிப் விபரம்</th>
                                <th style="width:150px!important;">Bdl</th>
                                <th style="width:150px!important;">டன்</th>
                                <th>வாடகை</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $from_tripsheet_list = array();
                                $from_tripsheet_list = $obj->getTableRecords($GLOBALS['tripsheet_table'], 'tripsheet_id', $from_tripsheet_id);
                                if(!empty($from_tripsheet_list)) {
                                    foreach($from_tripsheet_list as $data) {
                                        ?>
                                        <tr>
                                            <th>
                                                <?php
                                                    if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") {
                                                        echo date('d-m-Y', strtotime($data['tripsheet_date']));
                                                    }
                                                ?>
                                                <input type="hidden" name="from_tripsheet_date" value="<?php if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") { echo $data['tripsheet_date']; } ?>">
                                                <input type="hidden" name="from_tripsheet_id" value="<?php if(!empty($data['tripsheet_id']) && $data['tripsheet_id'] != $GLOBALS['null_value']) { echo $data['tripsheet_id']; } ?>">
                                            </th>
                                            <th>
                                                <?php
                                                    $from_branch_name = "";
                                                    if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) {
                                                        $from_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $data['from_branch_id'], 'name');
                                                        if(!empty($from_branch_name) && $from_branch_name != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $from_branch_name);
                                                        }
                                                    }
                                                    echo ' To ';
                                                    $destination_branch_name = "";
                                                    if(!empty($data['destination_branch_id']) && $data['destination_branch_id'] != $GLOBALS['null_value']) {
                                                        $destination_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $data['destination_branch_id'], 'name');
                                                        if(!empty($destination_branch_name) && $destination_branch_name != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $destination_branch_name);
                                                        }
                                                    }
                                                ?>
                                                <input type="hidden" name="from_tripsheet_from_branch" value="<?php if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) { echo $data['from_branch_id']; } ?>">
                                                <input type="hidden" name="from_tripsheet_to_branch" value="<?php if(!empty($data['destination_branch_id']) && $data['destination_branch_id'] != $GLOBALS['null_value']) { echo $data['destination_branch_id']; } ?>">
                                            </th>
                                            <th>
                                                <?php
                                                    $quantity = array(); $total_qty = 0;
                                                    if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                                                        $quantity = explode("$$$", $data['quantity']);
                                                        if(!empty($quantity)) {
                                                            for($i=0; $i < count($quantity); $i++) {
                                                                $qty_array = array();
                                                                $qty_array = explode(",", $quantity[$i]);
                                                                if(!empty($qty_array)) {
                                                                    for($j=0; $j < count($qty_array); $j++) {
                                                                        if(!empty($qty_array[$j])) {
                                                                            $total_qty += $qty_array[$j];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    echo $total_qty;
                                                ?>
                                                <input type="hidden" name="from_tripsheet_quantity" value="<?php echo $total_qty; ?>">
                                            </th>
                                            <th>
                                                <?php
                                                    $weight = array(); $total_weight = 0;
                                                    if(!empty($data['weight']) && $data['weight'] != $GLOBALS['null_value']) {
                                                        $weight = explode("$$$", $data['weight']);
                                                        if(!empty($weight)) {
                                                            for($i=0; $i < count($weight); $i++) {
                                                                $weight_array = array();
                                                                $weight_array = explode(",", $weight[$i]);
                                                                if(!empty($weight_array)) {
                                                                    for($j=0; $j < count($weight_array); $j++) {
                                                                        if(!empty($weight_array[$j])) {
                                                                            $total_weight += $weight_array[$j];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    echo $total_weight;
                                                ?>
                                                <input type="hidden" name="from_tripsheet_weight" value="<?php echo $total_weight; ?>">
                                            </th>
                                            <th>
                                                <div class="form-group mb-0">
                                                    <div class="form-label-group in-border">
                                                        <input type="text" name="from_tripsheet_rent" class="form-control shadow-none" value="<?php if(!empty($from_tripsheet_rent)) { echo $from_tripsheet_rent; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                        <?php
                                    }
                                }
                                $to_tripsheet_list = array();
                                $to_tripsheet_list = $obj->getTableRecords($GLOBALS['tripsheet_table'], 'tripsheet_id', $to_tripsheet_id);
                                if(!empty($to_tripsheet_list)) {
                                    foreach($to_tripsheet_list as $data) {
                                        ?>
                                        <tr>
                                            <th>
                                                <?php
                                                    if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") {
                                                        echo date('d-m-Y', strtotime($data['tripsheet_date']));
                                                    }
                                                ?>
                                                <input type="hidden" name="to_tripsheet_date" value="<?php if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") { echo $data['tripsheet_date']; } ?>">
                                                <input type="hidden" name="to_tripsheet_id" value="<?php if(!empty($data['tripsheet_id']) && $data['tripsheet_id'] != $GLOBALS['null_value']) { echo $data['tripsheet_id']; } ?>">
                                            </th>
                                            <th>
                                                <?php
                                                    $from_branch_name = "";
                                                    if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) {
                                                        $from_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $data['from_branch_id'], 'name');
                                                        if(!empty($from_branch_name) && $from_branch_name != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $from_branch_name);
                                                        }
                                                    }
                                                    echo ' To ';
                                                    $destination_branch_name = "";
                                                    if(!empty($data['destination_branch_id']) && $data['destination_branch_id'] != $GLOBALS['null_value']) {
                                                        $destination_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $data['destination_branch_id'], 'name');
                                                        if(!empty($destination_branch_name) && $destination_branch_name != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $destination_branch_name);
                                                        }
                                                    }
                                                ?>
                                                <input type="hidden" name="to_tripsheet_from_branch" value="<?php if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) { echo $data['from_branch_id']; } ?>">
                                                <input type="hidden" name="to_tripsheet_to_branch" value="<?php if(!empty($data['destination_branch_id']) && $data['destination_branch_id'] != $GLOBALS['null_value']) { echo $data['destination_branch_id']; } ?>">
                                            </th>
                                            <th>
                                                <?php
                                                    $quantity = array(); $total_qty = 0;
                                                    if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                                                        $quantity = explode("$$$", $data['quantity']);
                                                        if(!empty($quantity)) {
                                                            for($i=0; $i < count($quantity); $i++) {
                                                                $qty_array = array();
                                                                $qty_array = explode(",", $quantity[$i]);
                                                                if(!empty($qty_array)) {
                                                                    for($j=0; $j < count($qty_array); $j++) {
                                                                        if(!empty($qty_array[$j])) {
                                                                            $total_qty += $qty_array[$j];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    echo $total_qty;
                                                ?>
                                                <input type="hidden" name="to_tripsheet_quantity" value="<?php echo $total_qty; ?>">
                                            </th>
                                            <th>
                                                <?php
                                                    $weight = array(); $total_weight = 0;
                                                    if(!empty($data['weight']) && $data['weight'] != $GLOBALS['null_value']) {
                                                        $weight = explode("$$$", $data['weight']);
                                                        if(!empty($weight)) {
                                                            for($i=0; $i < count($weight); $i++) {
                                                                $weight_array = array();
                                                                $weight_array = explode(",", $weight[$i]);
                                                                if(!empty($weight_array)) {
                                                                    for($j=0; $j < count($weight_array); $j++) {
                                                                        if(!empty($weight_array[$j])) {
                                                                            $total_weight += $weight_array[$j];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    echo $total_weight;
                                                ?>
                                                <input type="hidden" name="to_tripsheet_weight" value="<?php echo $total_weight; ?>">
                                            </th>
                                            <th>
                                                <div class="form-group mb-0">
                                                    <div class="form-label-group in-border">
                                                        <input type="text" name="to_tripsheet_rent" class="form-control shadow-none" value="<?php if(!empty($to_tripsheet_rent)) { echo $to_tripsheet_rent; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                        <?php
                                    }
                                }
                                if(!empty($from_tripsheet_id) && !empty($to_tripsheet_id)) {
                                    ?>
                                    <tr>
                                        <th colspan="4" class="text-right">மொத்த வாடகை :</th>
                                        <th>
                                            <span class="total_rent">
                                                <?php
                                                    if(!empty($total_rent)) {
                                                        echo $total_rent;
                                                    }
                                                ?>
                                            </span>
                                        </th>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="row mx-0 p-2 <?php if(empty($show_tripsheet_profit_loss_id)) { ?>d-none<?php } ?> trip_details_div">
                <div class="col-lg-8 col-md-6 col-12 py-1 d-flex">
                    <div class="col-lg-6 col-md-6 col-12 py-1">
                        <table class="table table-nowrap table-bordered border nowrap smallfnt cursor text-center w-100 company_expense_table">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        கம்பெனி செலவுகள்
                                        <button type="button" class="btn btn-primary rounded ml-5" style="font-size:11px;" onclick="Javascript:AddCompanyExpenseRow();"><i class="fa fa-plus"></i>&ensp;Add</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="width:65%!important;">
                                        டீசல் செலவு
                                    </th>
                                    <th style="width:25%!important;">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border">
                                                <input type="text" name="company_diesel_amount" class="form-control shadow-none"  style="min-width:100px!important;" value="<?php if(!empty($company_diesel_amount)) { echo $company_diesel_amount; } ?>">
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr class="company_diesel_row">
                                    <th></th>
                                    <th style="width:100%!important;">
                                        <div>
                                            <div class="form-check form-check-inline ml-3">
                                                <input class="form-check-input" type="radio" name="company_expense_type" id="company_paid" value="Paid" <?php if(!empty($company_expense_type) && $company_expense_type == 'Paid') { ?> checked<?php } ?>>
                                                <label class="form-check-label" for="paid">Paid</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="company_expense_type" id="company_credit" value="Credit" <?php if(!empty($company_expense_type) && $company_expense_type == 'Credit') { ?> checked<?php } ?>>
                                                <label class="form-check-label" for="credit">Credit</label>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <?php
                                    if(!empty($company_expense_names)) {
                                        for($i=0; $i < count($company_expense_names); $i++) {
                                            ?>
                                            <tr class="company_expense_row">
                                                <th style="width:65%!important;">
                                                    <?php
                                                        if(!empty($company_expense_names[$i])) {
                                                            echo $company_expense_names[$i];
                                                        }
                                                    ?>
                                                    <input type="hidden" name="company_expense_name[]" value="<?php if(!empty($company_expense_names[$i])) { echo $company_expense_names[$i]; } ?>">
                                                    <span class="d-none company_sno"></span>
                                                </th>
                                                <th style="width:25%!important;">
                                                    <div class="form-group mb-0">
                                                        <div class="form-label-group in-border">
                                                            <input type="text" name="company_expense_value[]" class="form-control shadow-none" value="<?php if(!empty($company_expense_values[$i])) { echo $company_expense_values[$i]; } ?>" style="min-width:100px!important;">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th style="width:10%!important;">
                                                    <button type="button" class="btn btn-danger" style="font-size:11px;" onclick="Javascript:DeleteCompanyExpenseRow(this);"><i class="fa fa-times"></i></button>
                                                </th>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive col-lg-6 col-md-6 col-12 py-1">
                        <table class="table table-nowrap table-bordered border nowrap smallfnt cursor text-center w-100 trip_expense_table">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        டிரைவர் செலவுகள்
                                        <button type="button" class="btn btn-primary rounded ml-5" style="font-size:11px;" onclick="Javascript:AddExpenseRow();"><i class="fa fa-plus"></i>&ensp;Add</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($expense_names)) { ?>
                                    <tr class="expense_row">
                                        <th style="width:65%!important;">
                                            பூஜை
                                            <input type="hidden" name="expense_name[]" value="பூஜை">
                                            <span class="d-none sno"></span>
                                        </th>
                                        <th style="width:25%!important;">
                                            <div class="form-group mb-0">
                                                <div class="form-label-group in-border">
                                                    <input type="text" name="expense_value[]" class="form-control shadow-none" value="" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                                </div>
                                            </div>
                                        </th>
                                        <th style="width:10%!important;">
                                            <button type="button" class="btn btn-danger" style="font-size:11px;" onclick="Javascript:DeleteDriverExpenseRow(this);"><i class="fa fa-times"></i></button>
                                        </th>
                                    </tr>
                                    <tr class="expense_row">
                                        <th style="width:65%!important;">
                                            சாப்பாடு படி
                                            <input type="hidden" name="expense_name[]" value="சாப்பாடு படி">
                                            <span class="d-none sno"></span>
                                        </th>
                                        <th style="width:25%!important;">
                                            <div class="form-group mb-0">
                                                <div class="form-label-group in-border">
                                                    <input type="text" name="expense_value[]" class="form-control shadow-none" value="" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                                </div>
                                            </div>
                                        </th>
                                        <th style="width:10%!important;">
                                            <button type="button" class="btn btn-danger" style="font-size:11px;" onclick="Javascript:DeleteDriverExpenseRow(this);"><i class="fa fa-times"></i></button>
                                        </th>
                                    </tr>
                                <?php } else { 
                                        if(!empty($expense_names)) {
                                            for($i=0; $i < count($expense_names); $i++) {
                                                ?>
                                                <tr class="expense_row">
                                                    <th style="width:65%!important;">
                                                        <?php
                                                            if(!empty($expense_names[$i])) {
                                                                echo $expense_names[$i];
                                                            }
                                                        ?>
                                                        <input type="hidden" name="expense_name[]" value="<?php if(!empty($expense_names[$i])) { echo $expense_names[$i]; } ?>">
                                                        <span class="d-none sno"></span>
                                                    </th>
                                                    <th style="width:25%!important;">
                                                        <div class="form-group mb-0">
                                                            <div class="form-label-group in-border">
                                                                <input type="text" name="expense_value[]" class="form-control shadow-none" value="<?php if(!empty($expense_values[$i])) { echo $expense_values[$i]; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th style="width:10%!important;">
                                                        <button type="button" class="btn btn-danger" style="font-size:11px;" onclick="Javascript:DeleteDriverExpenseRow(this);"><i class="fa fa-times"></i></button>
                                                    </th>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    } 
                                ?>
                                <tr class="driver_expense_row">
                                    <th style="width:65%!important;">
                                            டீசல் செலவு
                                    </th>
                                    <th style="width:25%!important;">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border">
                                                <input type="text" name="driver_diesel_amount" class="form-control shadow-none" value="<?php if(!empty($driver_diesel_amount)) { echo $driver_diesel_amount; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();" >
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th style="width:100%!important;">
                                        <div>
                                            <div class="form-check form-check-inline ml-3">
                                                <input class="form-check-input" type="radio" name="driver_expense_type" id="driver_paid" value="Paid"  <?php if(!empty($driver_expense_type) && $driver_expense_type == 'Paid') { ?> checked<?php } ?>>
                                                <label class="form-check-label" for="paid">Paid</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="driver_expense_type" id="driver_credit" value="Credit" <?php if(!empty($driver_expense_type) && $driver_expense_type == 'Credit') { ?> checked<?php } ?>>
                                                <label class="form-check-label" for="credit">Credit</label>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width:75%!important;">அட்வான்ஸ்</th>
                                    <th style="width:25%!important;">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border">
                                                <input type="text" name="advance" class="form-control shadow-none" value="<?php if(!empty($advance)) { echo $advance; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr class="expense_total">
                                    <th style="width:65%!important;">
                                        ட்ரிப் செலவுகள்
                                    </th>
                                    <th style="width:25%!important;">
                                        <span class="trip_cost"><?php if(!empty($trip_cost)) { echo $trip_cost; } ?></span>
                                        <input type="hidden" name="trip_cost" value="<?php if(!empty($trip_cost)) { echo $trip_cost; } ?>">
                                    </th>
                                    <th style="width:10%!important;">
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table-responsive col-lg-4 col-md-6 col-12 py-1">
                    <div class="col-lg-12 col-md-6 col-12 py-1">
                        <table class="table table-nowrap table-bordered border nowrap smallfnt cursor text-center w-100 trip_balance_table">
                            <tbody>
                                <tr>
                                    <th style="width:75%!important;">மொத்த வாடகை</th>
                                    <th style="width:25%!important;">
                                        <span class="total_rent"><?php if(!empty($total_rent)) { echo $total_rent; } ?></span>
                                        <input type="hidden" name="total_rent" value="<?php if(!empty($total_rent)) { echo $total_rent; } ?>">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width:75%!important;">ட்ரிப் செலவுகள்</th>
                                    <th style="width:25%!important;">
                                        <span class="trip_cost"><?php if(!empty($trip_cost)) { echo $trip_cost; } ?></span>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width:75%!important;">மிச்சம்</th>
                                    <th style="width:25%!important;">
                                        <span class="trip_balance"><?php if(!empty($trip_balance)) { echo $trip_balance; } ?></span>
                                        <input type="hidden" name="trip_balance" value="<?php if(!empty($trip_balance)) { echo $trip_balance; } ?>">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width:75%!important;">ஏத்து கூலி</th>
                                    <th style="width:25%!important;">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border">
                                                <input type="text" name="loading_wage" class="form-control shadow-none trip_calc" value="<?php if(!empty($loading_wage)) { echo $loading_wage; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width:75%!important;">நைட் சாப்பாடு</th>
                                    <th style="width:25%!important;">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border">
                                                <input type="text" name="night_food" class="form-control shadow-none trip_calc" value="<?php if(!empty($night_food)) { echo $night_food; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width:75%!important;">டிரைவர் சம்பளம்</th>
                                    <th style="width:25%!important;">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border">
                                                <input type="text" name="driver_salary" class="form-control shadow-none trip_calc" value="<?php if(!empty($driver_salary)) { echo $driver_salary; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width:75%!important;">டயர் தேய்மானம்</th>
                                    <th style="width:25%!important;">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border">
                                                <input type="text" name="tire_depreciation" class="form-control shadow-none trip_calc" value="<?php if(!empty($tire_depreciation)) { echo $tire_depreciation; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width:75%!important;">டோல் கேட்</th>
                                    <th style="width:25%!important;">
                                        <div class="form-group mb-0">
                                            <div class="form-label-group in-border">
                                                <input type="text" name="toll_gate" class="form-control shadow-none trip_calc" value="<?php if(!empty($toll_gate)) { echo $toll_gate; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width:75%!important;">நிகர மிச்சம்</th>
                                    <th style="width:25%!important;">
                                        <span class="net_balance"><?php if(!empty($net_balance)) { echo $net_balance; } ?></span>
                                        <input type="hidden" name="net_balance" value="<?php if(!empty($net_balance)) { echo $net_balance; } ?>">
                                    </th>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table-responsive col-lg-4 col-md-6 col-12 py-1">
                    <table class="table table-nowrap table-bordered border nowrap smallfnt cursor text-center w-100 trip_distance_table">
                        <tbody>
                            <tr style="padding-top: 20px;">
                                <th style="width:75%!important;">ஆரம்ப Km</th>
                                <th style="width:25%!important;">
                                    <div class="form-group mb-0">
                                        <div class="form-label-group in-border">
                                            <input type="text" name="starting_km" class="form-control shadow-none" value="<?php if(!empty($starting_km)) { echo $starting_km; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th style="width:75%!important;">முடிவு Km</th>
                                <th style="width:25%!important;">
                                    <div class="form-group mb-0">
                                        <div class="form-label-group in-border">
                                            <input type="text" name="ending_km" class="form-control shadow-none" value="<?php if(!empty($ending_km)) { echo $ending_km; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();" >
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th style="width:75%!important;">ஓடிய Km</th>
                                <th style="width:25%!important;">
                                    <span class="travelled_km"><?php if(!empty($travelled_km)) { echo $travelled_km; } ?></span>
                                    <input type="hidden" name="travelled_km" value="<?php if(!empty($travelled_km)) { echo $travelled_km; } ?>">
                                </th>
                            </tr>
                            <tr>
                                <th style="width:75%!important;">டீசல் (லிட்டர்)</th>
                                <th style="width:25%!important;">
                                    <div class="form-group mb-0">
                                        <div class="form-label-group in-border">
                                            <input type="text" name="diesel" class="form-control shadow-none" value="<?php if(!empty($diesel)) { echo $diesel; } ?>" style="min-width:100px!important;" onkeyup="Javascript:mileageCalculation();">
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th style="width:75%!important;">மைல்லேஜ்</th>
                                <th style="width:25%!important;">
                                    <span class="mileage_span <?php if(empty($show_tripsheet_profit_loss_id)) { ?>d-none<?php } ?>"><span class="mileage"><?php if(!empty($mileage)) { echo $mileage; } ?></span>பாயிண்ட்</span>
                                    <input type="hidden" name="mileage" value="">
                                </th>
                            </tr>
                            <tr>
                                <th style="width:75%!important;">டீசல்/லிட்டர்(in Rs.)</th>
                                <th style="width:25%!important;">
                                    <div class="form-group mb-0">
                                        <div class="form-label-group in-border">
                                            <input type="text" name="diesel_cost_per_litre" class="form-control shadow-none" value="<?php if(!empty($diesel_cost_per_litre)) { echo $diesel_cost_per_litre; } ?>" style="min-width:100px!important;" >
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 pt-3 text-center">
                <div class="form-check form-check-inline">
                    <input class="form-check-input tripsheet-check" type="checkbox" id="delivery" name="tripsheet_status[]" value="D"
                    <?php if (in_array('D', $tripsheet_status)) { echo 'checked'; } ?>>
                    <label class="form-check-label" for="delivery">Delivery</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input tripsheet-check" type="checkbox" id="freight" name="tripsheet_status[]" value="F"
                    <?php if (in_array('F', $tripsheet_status)){ echo 'checked'; } ?>>
                    <label class="form-check-label" for="freight">Freight</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input tripsheet-check" type="checkbox" id="cooly" name="tripsheet_status[]" value="C"
                    <?php if (in_array('C', $tripsheet_status)) { echo 'checked'; }?>>
                    <label class="form-check-label" for="cooly">Cooly</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="overall" name="tripsheet_status[]" value="O"
                    <?php if (in_array('O', $tripsheet_status)) { echo 'checked'; } ?>>
                    <label class="form-check-label" for="overall">Overall</label>
                </div>
            </div>


            <div class="col-md-12 pt-3 text-center">
                <button class="btn btn-dark btnwidth submit_button" type="button" onClick="checkValidation();">Submit</button>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script type="text/javascript">
                ProfitLossTotal();
            </script>
            <script>
                jQuery(document).ready(function () {
                    jQuery('#overall').change(function () {
                        const isChecked = jQuery(this).is(':checked');
                        jQuery('.tripsheet-check').prop('checked', isChecked);
                    });
                });
            </script>
            <div class="modal fade" id="ExpenseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Expense</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="expense-section company_expense_section d-none">
                          
                            <div id="company_diesel_amount_display" style="font-size:16px;color:#4f71a5;padding:10px;font-weight:bold;"></div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border">
                                            <input type="date" class="form-control shadow-none" name="expense_date" value="<?php if(!empty($expense_date)) { echo $expense_date; } ?>"  max="<?php if(!empty($expense_date)) { echo $expense_date; } ?>">
                                            <label>Date(*)</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12 party_display">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select name="expense_category_id" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2 select2-danger">
                                                    <option value="">Select</option>
                                                    <?php
                                                    if(!empty($expense_category_list)) {
                                                        foreach($expense_category_list as $data) { ?>
                                                            <option value="<?php if(!empty($data['expense_category_id'])) { echo $data['expense_category_id']; } ?>"> <?php
                                                                if(!empty($data['expense_category_name'])) {
                                                                    $data['expense_category_name'] = html_entity_decode($obj->encode_decode('decrypt', $data['expense_category_name']));
                                                                    echo $data['expense_category_name'];
                                                                } ?>
                                                            </option> <?php
                                                        }
                                                    } ?>
                                                </select>
                                                <label>Category(*)</label> 
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border">
                                            <textarea class="form-control" id="narration" name="narration" placeholder="" onkeydown="Javascript:KeyboardControls(this,'',150,'');InputBoxColor(this,'text');"></textarea>
                                                <label>Narration(*)</label>
                                            </div>
                                            <div class="new_smallfnt">Max Char: 150(Except <>?{}!*^%$)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border mb-0" id="payment_tax_type">
                                                <select name="selected_tax_type" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2 select2-danger" style="width: 100%;" onchange="Javascript:GetPayment();" >
                                                    <option value="">Select</option>
                                                    <option value="1">With Tax</option>
                                                    <option value="2">Without Tax</option>
                                                </select>
                                                <label>Type(*)</label>  
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-6">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select name="selected_payment_mode_id" class="select2 select2-danger smallfnt" style="width: 100%;" onchange="Javascript:getBankDetails(this.value);GetPayment();">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($payment_mode_list)) {
                                                            foreach($payment_mode_list as $data) { ?>
                                                                <option value="<?php if(!empty($data['payment_mode_id'])) { echo $data['payment_mode_id']; } ?>">
                                                                    <?php
                                                                        if(!empty($data['payment_mode_name'])) {
                                                                            $data['payment_mode_name'] = $obj->encode_decode('decrypt', $data['payment_mode_name']);
                                                                            echo $data['payment_mode_name'];
                                                                        }
                                                                    ?>
                                                                </option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Select Payment Mode(*)</label>
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12 d-none" id="bank_list">
                                        <div class="form-group">
                                            <div class="form-label-group in-border mt-0">
                                                <select name="selected_bank_id" class="select2 select2-danger smallfnt form-control" style="width:100% !important;"  onchange="Javascript:GetPayment();">
                                                    <option value="">Select Bank</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border">
                                            <input type="text" name="selected_amt" class="form-control shadow-none" placeholder="" >
                                            <label>Amount</label>
                                            </div>
                                                <span class="payment text-danger fw-bold"></span>
                                                <input type="hidden" name="available_balance" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-3 col-12">
                                        <button class="btn btn-danger add_payment_button" style="font-size:12px;" type="button" onclick="Javascript:AddExpensePaymentRow();" name="append_button">
                                            Add
                                        </button>
                                    </div> 
                                </div>
                                <div class="row justify-content-center pt-3"> 
                                    <div class="col-lg-8">
                                        <div class="table-responsive text-center">
                                            <input type="hidden" name="payment_row_count" value="0">
                                            <table class="table nowrap cursor smallfnt w-100 table-bordered payment_row_table">
                                                <thead class="bg-secondary text-white smallfnt">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Payment Tax Type</th>
                                                        <th>Payment Mode</th>
                                                        <th>Bank Name</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(!empty($payment_mode_ids_edit)){
                                                        for($j = 0; $j < count($payment_mode_ids_edit); $j++) {
                                                        ?>
                                                            <tr class="payment_row" id="payment_row<?php if(!empty($expense_count)) { echo $expense_count; } ?>">
                                                                <td class="payment_sno text-center">
                                                                    <?php if(!empty($expense_count)) { echo $expense_count; } ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                      if(!empty($payment_tax_type[$j])) {
                                                                            if($payment_tax_type[$j] == 1) {
                                                                                echo "With Tax"; 
                                                                            } else {
                                                                                echo "Without Tax";
                                                                            } 
                                                                    }  ?>
                                                                    <input type="hidden" name="payment_tax_type[]" value="<?php if(!empty($payment_tax_type[$j])) { echo $payment_tax_type[$j]; } ?>">
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                        if(!empty($payment_mode_name[$j]) && $payment_mode_name[$j] != $GLOBALS['null_value']) {                                                                                                                        
                                                                            echo $obj->encode_decode('decrypt', $payment_mode_name[$j]);
                                                                        }else{
                                                                            echo '-';
                                                                        }
                                                                    ?>
                                                                    <input type="hidden" name="payment_mode_id[]" value="<?php if(!empty($payment_mode_ids_edit[$j])) { echo $payment_mode_ids_edit[$j]; } ?>">
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                        if(!empty($bank_name[$j]) && $bank_name[$j] != $GLOBALS['null_value']) {                                                        
                                                                            echo $obj->encode_decode('decrypt', $bank_name[$j]);
                                                                        }
                                                                        else {
                                                                            echo '-';
                                                                        }   
                                                                    ?>
                                                                    <input type="hidden" name="bank_id[]" value="<?php if(!empty($payment_bank_id[$j])) { echo $payment_bank_id[$j]; } ?>">
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="text" name="expense_amount[]" style="width:75%!important;margin:auto!important;" class="form-control shadow-none px-1 text-center" value="<?php if(!empty($payment_amount[$j])) { echo $payment_amount[$j]; } ?>" onfocus="Javascript:KeyboardControls(this,'number','8','');" onkeyup="Javascript:PaymentExpenseTotal();InputBoxColor(this, 'text');">
                                                                </td>
                                                                <?php
                                                                if(!empty($edit_id)){ ?>
                                                                <td class="text-center">
                                                                    <button class="btn btn-danger" type="button" onclick="Javascript:DeleteExpenseRow('payment_row', '<?php if(!empty($expense_count)) { echo $expense_count; } ?>');"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                                <?php
                                                                }

                                                                ?>
                                                            </tr>              
                                                        <?php
                                                        $expense_count--;
                                                        }
                                                    }
                                                    ?>                                  
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="4" class="text-end">Total Amount : </th>
                                                        <th class="expense_overall_total"><?php if(!empty($payment_total_amount)){ echo $payment_total_amount; } ?></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="expense-section driver_expense_section d-none">
                            <div id="driver_diesel_amount_display" style="font-size:16px;color:#4f71a5;padding:10px;font-weight:bold;"></div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border">
                                            <input type="date" class="form-control shadow-none" name="driver_expense_date" value="<?php if(!empty($expense_date)) { echo $expense_date; } ?>"  max="<?php if(!empty($expense_date)) { echo $expense_date; } ?>">
                                            <label>Date(*)</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12 party_display">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select name="driver_expense_category_id" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2 select2-danger">
                                                    <option value="">Select</option>
                                                    <?php
                                                    if(!empty($expense_category_list)) {
                                                        foreach($expense_category_list as $data) { ?>
                                                            <option value="<?php if(!empty($data['expense_category_id'])) { echo $data['expense_category_id']; } ?>"> <?php
                                                                if(!empty($data['expense_category_name'])) {
                                                                    $data['expense_category_name'] = html_entity_decode($obj->encode_decode('decrypt', $data['expense_category_name']));
                                                                    echo $data['expense_category_name'];
                                                                } ?>
                                                            </option> <?php
                                                        }
                                                    } ?>
                                                </select>
                                                <label>Category(*)</label> 
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border">
                                            <textarea class="form-control" id="narration" name="driver_narration" placeholder="" onkeydown="Javascript:KeyboardControls(this,'',150,'');InputBoxColor(this,'text');"></textarea>
                                                <label>Narration(*)</label>
                                            </div>
                                            <div class="new_smallfnt">Max Char: 150(Except <>?{}!*^%$)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border mb-0" id="payment_tax_type">
                                                <select name="driver_selected_tax_type" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2 select2-danger" style="width: 100%;" onchange ="SecondGetPayment();" >
                                                    <option value="">Select</option>
                                                    <option value="1">With Tax</option>
                                                    <option value="2">Without Tax</option>
                                                </select>
                                                <label>Type(*)</label>  
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-6">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border mb-0">
                                                <select name="driver_selected_payment_mode_id" class="select2 select2-danger smallfnt" style="width: 100%;" onchange="Javascript:getDriverBankDetails(this.value);SecondGetPayment();">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($payment_mode_list)) {
                                                            foreach($payment_mode_list as $data) { ?>
                                                                <option value="<?php if(!empty($data['payment_mode_id'])) { echo $data['payment_mode_id']; } ?>">
                                                                    <?php
                                                                        if(!empty($data['payment_mode_name'])) {
                                                                            $data['payment_mode_name'] = $obj->encode_decode('decrypt', $data['payment_mode_name']);
                                                                            echo $data['payment_mode_name'];
                                                                        }
                                                                    ?>
                                                                </option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Select Payment Mode(*)</label>
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12 d-none" id="driver_bank_list">
                                        <div class="form-group">
                                            <div class="form-label-group in-border mt-0">
                                                <select name="driver_selected_bank_id" class="select2 select2-danger smallfnt form-control" style="width:100% !important;"  onchange="Javascript:SecondGetPayment();">
                                                    <option value="">Select Bank</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12">
                                        <div class="form-group pb-2">
                                            <div class="form-label-group in-border">
                                            <input type="text" name="driver_selected_amt" class="form-control shadow-none" placeholder="" >
                                            <label>Amount</label>
                                            </div>
                                                <span class="second_payment text-danger fw-bold"></span>
                                                <input type="hidden" name="second_available_balance" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-3 col-12">
                                        <button class="btn btn-danger add_payment_button" style="font-size:12px;" type="button" onclick="Javascript:AddDriverExpensePaymentRow();" name="append_button">
                                            Add
                                        </button>
                                    </div> 
                                </div>
                                <div class="row justify-content-center pt-3"> 
                                    <div class="col-lg-8">
                                        <div class="table-responsive text-center">
                                            <input type="hidden" name="driver_payment_row_count" value="0">
                                            <table class="table nowrap cursor smallfnt w-100 table-bordered driver_payment_row_table">
                                                <thead class="bg-secondary text-white smallfnt">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Payment Tax Type</th>
                                                        <th>Payment Mode</th>
                                                        <th>Bank Name</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(!empty($payment_mode_ids_edit)){
                                                        for($j = 0; $j < count($payment_mode_ids_edit); $j++) {
                                                        ?>
                                                            <tr class="driver_payment_row" id="driver_payment_row<?php if(!empty($expense_count)) { echo $expense_count; } ?>">
                                                                <td class="driver_payment_sno text-center">
                                                                    <?php if(!empty($expense_count)) { echo $expense_count; } ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                      if(!empty($payment_tax_type[$j])) {
                                                                            if($payment_tax_type[$j] == 1) {
                                                                                echo "With Tax"; 
                                                                            } else {
                                                                                echo "Without Tax";
                                                                            } 
                                                                    }  ?>
                                                                    <input type="hidden" name="driver_payment_tax_type[]" value="<?php if(!empty($payment_tax_type[$j])) { echo $payment_tax_type[$j]; } ?>">
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                        if(!empty($payment_mode_name[$j]) && $payment_mode_name[$j] != $GLOBALS['null_value']) {                                                                                                                        
                                                                            echo $obj->encode_decode('decrypt', $payment_mode_name[$j]);
                                                                        }else{
                                                                            echo '-';
                                                                        }
                                                                    ?>
                                                                    <input type="hidden" name="driver_payment_mode_id[]" value="<?php if(!empty($payment_mode_ids_edit[$j])) { echo $payment_mode_ids_edit[$j]; } ?>">
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                        if(!empty($bank_name[$j]) && $bank_name[$j] != $GLOBALS['null_value']) {                                                        
                                                                            echo $obj->encode_decode('decrypt', $bank_name[$j]);
                                                                        }
                                                                        else {
                                                                            echo '-';
                                                                        }   
                                                                    ?>
                                                                    <input type="hidden" name="driver_bank_id[]" value="<?php if(!empty($payment_bank_id[$j])) { echo $payment_bank_id[$j]; } ?>">
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="text" name="driver_expense_amount[]" style="width:75%!important;margin:auto!important;" class="form-control shadow-none px-1 text-center" value="<?php if(!empty($payment_amount[$j])) { echo $payment_amount[$j]; } ?>" onfocus="Javascript:KeyboardControls(this,'number','8','');" onkeyup="Javascript:PaymentDriverRowTotal();InputBoxColor(this, 'text');">
                                                                </td>
                                                                <?php
                                                                if(!empty($edit_id)){ ?>
                                                                <td class="text-center">
                                                                    <button class="btn btn-danger" type="button" onclick="Javascript:DeleteDriverExpenseRow('driver_payment_row', '<?php if(!empty($expense_count)) { echo $expense_count; } ?>');"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                                <?php
                                                                }

                                                                ?>
                                                            </tr>              
                                                        <?php
                                                        $expense_count--;
                                                        }
                                                    }
                                                    ?>                                  
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="4" class="text-end">Total Amount : </th>
                                                        <th class="driver_expense_overall_total"><?php if(!empty($payment_total_amount)){ echo $payment_total_amount; } ?></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onClick="Javascript:SaveModalContent('tripsheet_profit_loss_form', 'tripsheet_profit_loss_changes.php', 'tripsheet_profit_loss.php');">Save</button>
                        </div>
                    </div>
                </div>
            </div>  
        </form>
        <?php
    }
    if(isset($_POST['edit_id'])) {
        $trip_number = ""; $trip_number_error = ""; $vehicle_id = ""; $vehicle_id_error = ""; $driver_name = ""; $driver_name_error = "";
        $from_tripsheet_id = ""; $from_tripsheet_id_error = ""; $to_tripsheet_id = ""; $to_tripsheet_id_error = "";
        $from_tripsheet_date = ""; $to_tripsheet_date = ""; $from_tripsheet_number = ""; $to_tripsheet_number = "";
        $from_tripsheet_from_branch = ""; $from_tripsheet_to_branch = ""; $to_tripsheet_from_branch = ""; $to_tripsheet_to_branch = "";
        $from_tripsheet_quantity = ""; $from_tripsheet_weight = ""; $to_tripsheet_quantity = ""; $to_tripsheet_weight = "";
        $from_tripsheet_rent = ""; $from_tripsheet_rent_error = ""; $to_tripsheet_rent = ""; $to_tripsheet_rent_error = "";
        $total_rent = ""; $trip_cost = ""; $balance = ""; $loading_wage = ""; $loading_wage_error = ""; $night_food = ""; 
        $night_food_error = ""; $driver_salary = ""; $driver_salary_error = ""; $tire_depreciation = ""; $tire_depreciation_error = "";
        $toll_gate = ""; $toll_gate_error = ""; $net_balance = ""; $starting_km = ""; $starting_km_error = ""; $ending_km = ""; $ending_km_error = ""; $travelled_km = ""; $diesel = ""; $diesel_error = ""; $mileage = ""; $company_expense_type_error = ""; $driver_expense_type_error = ""; $expense_category_id = ""; $expense_category_name = "";
        $trip_balance = ""; $advance = ""; $advance_error = ""; $diesel_cost = ""; $diesel_cost_per_litre = ""; 
        $diesel_cost_per_litre_error = ""; $expense_names = array(); $expense_values = array(); $expense_error = "";
        $edit_id = ""; $form_name = "tripsheet_profit_loss_form"; $valid_tripsheet_profit_loss = ""; $company_expense_type = ""; $driver_expense_type = "";$expense_id = ""; $payment_updation = 0; $tripsheet_status = array(); $driver_diesel_payment_update = 0;
         $company_expense_names = array(); $company_expense_values = array(); $company_expense_name_error = "";
        $expense_date = ""; $expense_date_error = ""; $valid_expense = "";     $payment_tax_types = array();
        $payment_mode_ids = array(); $bank_ids = array(); $bank_names = array(); $payment_mode_names = array(); $amount = array(); $total_amount = 0; $payment_error = ""; $narration = ""; $narration_error = ""; $selected_payment_mode_id = "";
        $driver_diesel_amount = ""; $company_diesel_amount = ""; $hidden_driver_expense_type = ""; $hidden_company_expense_type = "";

        if(isset($_POST['edit_id'])) {
            $edit_id = trim($_POST['edit_id']);
        }
        if(isset($_POST['trip_number'])) {
            $trip_number = trim($_POST['trip_number']);
            $trip_number_error = $valid->common_validation($trip_number, 'Trip Number', 'text');
            if(!empty($trip_number_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'trip_number', $trip_number_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'trip_number', $trip_number_error, 'text');
                }
            }
        }
        if(isset($_POST['vehicle_id'])) {
            $vehicle_id = trim($_POST['vehicle_id']);
            $vehicle_id_error = $valid->common_validation($vehicle_id, 'Vehicle', 'select');
            if(!empty($vehicle_id_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'vehicle_id', $vehicle_id_error, 'select');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'vehicle_id', $vehicle_id_error, 'select');
                }
            }
        }
        if(isset($_POST['driver_name'])) {
            $driver_name = trim($_POST['driver_name']);
            $driver_name_error = $valid->common_validation($driver_name, 'Driver Name', 'text');
            if(!empty($driver_name_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'driver_name', $driver_name_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'driver_name', $driver_name_error, 'text');
                }
            }
        }
        if(isset($_POST['from_tripsheet_id'])) {
            $from_tripsheet_id = trim($_POST['from_tripsheet_id']);
            $from_tripsheet_id_error = $valid->common_validation($from_tripsheet_id, 'From Trip', 'select');
            if(!empty($from_tripsheet_id_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'from_tripsheet_id', $from_tripsheet_id_error, 'select');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'from_tripsheet_id', $from_tripsheet_id_error, 'select');
                }
            }
        }
        if(isset($_POST['to_tripsheet_id'])) {
            $to_tripsheet_id = trim($_POST['to_tripsheet_id']);
            $to_tripsheet_id_error = $valid->common_validation($to_tripsheet_id, 'To Trip', 'select');
            if(!empty($to_tripsheet_id_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'to_tripsheet_id', $to_tripsheet_id_error, 'select');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'to_tripsheet_id', $to_tripsheet_id_error, 'select');
                }
            }
        }
        if(isset($_POST['from_tripsheet_date'])) {
            $from_tripsheet_date = trim($_POST['from_tripsheet_date']);
        }
        if(isset($_POST['to_tripsheet_date'])) {
            $to_tripsheet_date = trim($_POST['to_tripsheet_date']);
        }
        if(isset($_POST['from_tripsheet_from_branch'])) {
            $from_tripsheet_from_branch = trim($_POST['from_tripsheet_from_branch']);
        }
        if(isset($_POST['from_tripsheet_to_branch'])) {
            $from_tripsheet_to_branch = trim($_POST['from_tripsheet_to_branch']);
        }
        if(isset($_POST['to_tripsheet_from_branch'])) {
            $to_tripsheet_from_branch = trim($_POST['to_tripsheet_from_branch']);
        }
        if(isset($_POST['to_tripsheet_to_branch'])) {
            $to_tripsheet_to_branch = trim($_POST['to_tripsheet_to_branch']);
        }
        if(isset($_POST['from_tripsheet_quantity'])) {
            $from_tripsheet_quantity = trim($_POST['from_tripsheet_quantity']);
        }
        if(isset($_POST['from_tripsheet_weight'])) {
            $from_tripsheet_weight = trim($_POST['from_tripsheet_weight']);
        }
        if(isset($_POST['to_tripsheet_quantity'])) {
            $to_tripsheet_quantity = trim($_POST['to_tripsheet_quantity']);
        }
        if(isset($_POST['to_tripsheet_weight'])) {
            $to_tripsheet_weight = trim($_POST['to_tripsheet_weight']);
        }
        if(isset($_POST['from_tripsheet_rent'])) {
            $from_tripsheet_rent = trim($_POST['from_tripsheet_rent']);
            $from_tripsheet_rent_error = $valid->valid_price($from_tripsheet_rent, 'வாடகை', '1');
            if(!empty($from_tripsheet_rent_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'from_tripsheet_rent', $from_tripsheet_rent_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'from_tripsheet_rent', $from_tripsheet_rent_error, 'text');
                }
            }
        }
        if(isset($_POST['to_tripsheet_rent'])) {
            $to_tripsheet_rent = trim($_POST['to_tripsheet_rent']);
            $to_tripsheet_rent_error = $valid->valid_price($to_tripsheet_rent, 'வாடகை', '1');
            if(!empty($to_tripsheet_rent_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'to_tripsheet_rent', $to_tripsheet_rent_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'to_tripsheet_rent', $to_tripsheet_rent_error, 'text');
                }
            }
        }
        if(isset($_POST['total_rent'])) {
            $total_rent = trim($_POST['total_rent']);
        }
        if(isset($_POST['trip_cost'])) {
            $trip_cost = trim($_POST['trip_cost']);
        }
        if(isset($_POST['loading_wage'])) {
            $loading_wage = trim($_POST['loading_wage']);
            $loading_wage_error = $valid->valid_price($loading_wage, 'ஏத்து கூலி', '0');
            if(!empty($loading_wage_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'loading_wage', $loading_wage_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'loading_wage', $loading_wage_error, 'text');
                }
            }
        }
        if(isset($_POST['night_food'])) {
            $night_food = trim($_POST['night_food']);
            $night_food_error = $valid->valid_price($night_food, 'நைட் சாப்பாடு', '0');
            if(!empty($night_food_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'night_food', $night_food_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'night_food', $night_food_error, 'text');
                }
            }
        }
        if(isset($_POST['driver_salary'])) {
            $driver_salary = trim($_POST['driver_salary']);
            $driver_salary_error = $valid->valid_price($driver_salary, 'டிரைவர் சம்பளம்', '0');
            if(!empty($driver_salary_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'driver_salary', $driver_salary_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'driver_salary', $driver_salary_error, 'text');
                }
            }
        }
        if(isset($_POST['tire_depreciation'])) {
            $tire_depreciation = trim($_POST['tire_depreciation']);
            $tire_depreciation_error = $valid->valid_price($tire_depreciation, 'டயர் தேய்மானம்', '0');
            if(!empty($tire_depreciation_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'tire_depreciation', $tire_depreciation_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'tire_depreciation', $tire_depreciation_error, 'text');
                }
            }
        }
        if(isset($_POST['toll_gate'])) {
            $toll_gate = trim($_POST['toll_gate']);
            $toll_gate_error = $valid->valid_price($toll_gate, 'டோல் கேட்', '0');
            if(!empty($toll_gate_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'toll_gate', $toll_gate_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'toll_gate', $toll_gate_error, 'text');
                }
            }
        }
        if(isset($_POST['net_balance'])) {
            $net_balance = trim($_POST['net_balance']);
        }
        if(isset($_POST['starting_km'])) {
            $starting_km = trim($_POST['starting_km']);
            $starting_km_error = $valid->valid_price($starting_km, 'ஆரம்ப Km', '1');
            if(!empty($starting_km_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'starting_km', $starting_km_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'starting_km', $starting_km_error, 'text');
                }
            }
        }
        if(isset($_POST['ending_km'])) {
            $ending_km = trim($_POST['ending_km']);
            $ending_km_error = $valid->valid_price($ending_km, 'முடிவு Km', '1');
            if(!empty($ending_km_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'ending_km', $ending_km_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'ending_km', $ending_km_error, 'text');
                }
            }
        }
        if(isset($_POST['travelled_km'])) {
            $travelled_km = trim($_POST['travelled_km']);
        }
        if(isset($_POST['diesel'])) {
            $diesel = trim($_POST['diesel']);
            $diesel_error = $valid->valid_price($diesel, 'டீசல்', '1');
            if(!empty($diesel_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'diesel', $diesel_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'diesel', $diesel_error, 'text');
                }
            }
        }
        if(isset($_POST['mileage'])) {
            $mileage = trim($_POST['mileage']);
        }
        if(isset($_POST['diesel_cost_per_litre'])) {
            $diesel_cost_per_litre = trim($_POST['diesel_cost_per_litre']);
            $diesel_cost_per_litre_error = $valid->valid_price($diesel_cost_per_litre, 'டீசல்/லிட்டர்', '1');
            if(!empty($diesel_cost_per_litre_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'diesel_cost_per_litre', $diesel_cost_per_litre_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'diesel_cost_per_litre', $diesel_cost_per_litre_error, 'text');
                }
            }
        }
        if(isset($_POST['trip_balance'])) {
            $trip_balance = trim($_POST['trip_balance']);
        }
        if(isset($_POST['company_expense_name'])) {
            $company_expense_names = $_POST['company_expense_name'];
        }
        if(isset($_POST['company_expense_value'])) {
            $company_expense_values = $_POST['company_expense_value'];
        }
        if(!empty($company_expense_names)) {
            for($i=0; $i < count($company_expense_names); $i++) {
                $company_expense_names[$i] = trim($company_expense_names[$i]);
                if(isset($company_expense_names[$i])) {
                    $company_expense_name_error = "";
                    $company_expense_name_error = $valid->common_validation($company_expense_names[$i], 'Name', 'text');
                    if(!empty($company_expense_name_error)) {
                        if(!empty($valid_tripsheet_profit_loss)) {
                            $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->row_error_display($form_name, 'company_expense_name[]', $company_expense_name_error, 'text', 'company_expense_row', $i+1);
                        }
                        else {
                            $valid_tripsheet_profit_loss = $valid->row_error_display($form_name, 'company_expense_name[]', $company_expense_name_error, 'text', 'company_expense_row', $i+1);
                        }
                    }
                }
                $company_expense_values[$i] = trim($company_expense_values[$i]);
                if(isset($company_expense_values[$i])) {
                    $company_expense_value_error = "";
                    $company_expense_value_error = $valid->valid_price($company_expense_values[$i], 'Value', '1');
                    if(!empty($company_expense_value_error)) {
                        if(!empty($valid_tripsheet_profit_loss)) {
                            $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->row_error_display($form_name, 'company_expense_value[]', $company_expense_value_error, 'text', 'company_expense_row', $i+1);
                        }
                        else {
                            $valid_tripsheet_profit_loss = $valid->row_error_display($form_name, 'company_expense_value[]', $company_expense_value_error, 'text', 'company_expense_row', $i+1);
                        }
                    }
                }
                if(empty($valid_tripsheet_profit_loss)) {
                    for($j=$i+1; $j < count($company_expense_names); $j++) {
                        if(!empty($company_expense_names[$i]) && !empty($company_expense_names[$j]) && $company_expense_names[$i] == $company_expense_names[$j]) {
                            $expense_error = "Same Company Expenses repeatedly exists";
                        }
                    }
                }
            }
        }
        if(isset($_POST['company_diesel_amount'])) {
            $company_diesel_amount = trim($_POST['company_diesel_amount']);
            $company_diesel_amount_error = $valid->valid_price($company_diesel_amount, 'டீசல் செலவு', '0');
            if(!empty($company_diesel_amount_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'company_diesel_amount', $company_diesel_amount_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'company_diesel_amount', $company_diesel_amount_error, 'text');
                }
            }
        }
        if(!empty($company_diesel_amount) && empty($company_diesel_amount_error)) {
            if(isset($_POST['company_expense_type'])) {
                $company_expense_type = trim($_POST['company_expense_type']);
            }
            if(empty($company_expense_type)) {
                $company_expense_type_error = "Select Payment Status";
            }
            if(!empty($company_expense_type_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'company_expense_type', $company_expense_type_error, 'radio');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'company_expense_type', $company_expense_type_error, 'radio');
                }
            }
        }
        if(isset($_POST['driver_diesel_amount'])) {
            $driver_diesel_amount = trim($_POST['driver_diesel_amount']);
            $driver_diesel_amount_error = $valid->valid_price($driver_diesel_amount, 'டீசல் செலவு', '0');
            if(!empty($driver_diesel_amount_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'driver_diesel_amount', $driver_diesel_amount_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'driver_diesel_amount', $driver_diesel_amount_error, 'text');
                }
            }
        }
        if(!empty($driver_diesel_amount) && empty($driver_diesel_amount_error)) {
            if(isset($_POST['driver_expense_type'])) {
                $driver_expense_type = trim($_POST['driver_expense_type']);
            }
            if(empty($driver_expense_type)) {
                $driver_expense_type_error = "Select Payment Status";
            }
            if(!empty($driver_expense_type_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'driver_expense_type', $driver_expense_type_error, 'radio');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'driver_expense_type', $driver_expense_type_error, 'radio');
                }
            }
        }
        if(isset($_POST['driver_diesel_amount'])) {
            $driver_diesel_amount = $_POST['driver_diesel_amount'];
            $driver_diesel_amount = trim($driver_diesel_amount);
        } 

        $driver_diesel_amount_error = "";
        // echo $driver_diesel_amount."/".$driver_expense_type;
        if((!empty($driver_expense_type) && $driver_expense_type == 'Paid')){
             if(empty($driver_diesel_amount)){
                    $driver_diesel_amount_error = $valid->common_validation($driver_diesel_amount, 'Driver Diesel Amount', 'radio');
                    if(!empty($driver_diesel_amount_error)) {
                        if(!empty($valid_tripsheet_profit_loss)) {
                            $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'driver_diesel_amount', $driver_diesel_amount_error, 'text');
                        }
                        else {
                            $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'driver_diesel_amount', $driver_diesel_amount_error, 'text');
                        }
                    }
             }

            $driver_diesel_payment_update = 1;

        }
        else{
            if(!empty($driver_diesel_amount) && (empty($driver_expense_type))){
                $driver_expense_type_error = "Select Status";
                    if(!empty($driver_expense_type_error)) {
                        if(!empty($valid_tripsheet_profit_loss)) {
                            $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'driver_expense_type', $driver_expense_type_error, 'radio');
                        }
                        else {
                            $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'driver_expense_type', $driver_expense_type_error, 'radio');
                        }
             }

            }
        }
        if((!empty($company_expense_type) && $company_expense_type == 'Paid')){
             if(empty($company_diesel_amount)){
                    $company_diesel_amount_error = $valid->common_validation($company_diesel_amount, 'company Diesel Amount', 'radio');
                    if(!empty($company_diesel_amount_error)) {
                        if(!empty($valid_tripsheet_profit_loss)) {
                            $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'company_diesel_amount', $company_diesel_amount_error, 'text');
                        }
                        else {
                            $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'company_diesel_amount', $company_diesel_amount_error, 'text');
                        }
                    }
             }

            $company_diesel_payment_update = 1;

        }else{
            if(!empty($company_diesel_amount) && (empty($company_expense_type))){
                $company_expense_type_error = "Select Status";
                if(!empty($company_expense_type_error)) {
                    if(!empty($valid_tripsheet_profit_loss)) {
                        $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'company_expense_type', $company_expense_type_error, 'radio');
                    }
                    else {
                        $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'company_expense_type', $company_expense_type_error, 'radio');
                    }
                }
            }
        }
        if((!empty($company_expense_type) && $company_expense_type == 'Paid')){
            $payment_updation = 1;
        }

        
        if(isset($_POST['advance'])) {
            $advance = trim($_POST['advance']);
            $advance_error = $valid->valid_price($advance, 'அட்வான்ஸ்', '0');
            if(!empty($advance_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'advance', $advance_error, 'text');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'advance', $advance_error, 'text');
                }
            }
        }
        
        if(isset($_POST['expense_name'])) {
            $expense_names = $_POST['expense_name'];
        }
        if(isset($_POST['expense_value'])) {
            $expense_values = $_POST['expense_value'];
        }
        if(!empty($expense_names)) {
            for($i=0; $i < count($expense_names); $i++) {
                $expense_names[$i] = trim($expense_names[$i]);
                if(isset($expense_names[$i])) {
                    $expense_name_error = "";
                    if(!empty($expense_names[$i])) {
                        $expense_name_error = $valid->common_validation($expense_names[$i], 'Name', 'text');
                    }
                    if(!empty($valid_tripsheet_profit_loss)) {
                        $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->row_error_display($form_name, 'expense_name[]', $expense_name_error, 'text', 'expense_row', $i+1);
                    }
                    else {
                        $valid_tripsheet_profit_loss = $valid->row_error_display($form_name, 'expense_name[]', $expense_name_error, 'text', 'expense_row', $i+1);
                    }
                }
                $expense_values[$i] = trim($expense_values[$i]);
                if(isset($expense_values[$i])) {
                    $expense_value_error = "";
                    $expense_value_error = $valid->valid_price($expense_values[$i], 'Value', '0');
                    if(!empty($valid_tripsheet_profit_loss)) {
                        $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->row_error_display($form_name, 'expense_value[]', $expense_value_error, 'text', 'expense_row', $i+1);
                    }
                    else {
                        $valid_tripsheet_profit_loss = $valid->row_error_display($form_name, 'expense_value[]', $expense_value_error, 'text', 'expense_row', $i+1);
                    }
                }
                if(empty($valid_tripsheet_profit_loss)) {
                    for($j=$i+1; $j < count($expense_names); $j++) {
                        if($expense_names[$i] == $expense_names[$j]) {
                            $expense_error = "Same Expenses repeatedly exists";
                        }
                    }
                }
            }
        }
        
        
               $expense_total_amounts = 0; $payment_error = ""; $expense_amount = array(); $company_expense_total_amounts = 0; $driver_expense_amount  = 0; $driver_expense_total_amounts  = 0; $expense_arrray = array();
        if(!empty($payment_updation) && $payment_updation == 1){
            
                if(isset($_POST['payment_mode_id'])) {
                    $payment_mode_ids = $_POST['payment_mode_id'];
                    $payment_mode_ids = array_reverse($payment_mode_ids);
                }
            
                if(isset($_POST['bank_id'])) {
                    $bank_ids = $_POST['bank_id'];
                    $bank_ids = array_reverse($bank_ids);
                }
                if(isset($_POST['expense_amount'])) {
                    $expense_amount = $_POST['expense_amount'];
                    $expense_amount = array_reverse($expense_amount);
                }   
                if(isset($_POST['payment_tax_type'])) {
                    $payment_tax_types = $_POST['payment_tax_type'];
                    $payment_tax_types = array_reverse($payment_tax_types);
                }       
                // print_r($payment_tax_types);
                if(isset($_POST['expense_date'])) {
                    $expense_date = $_POST['expense_date'];
                }
                if(empty($expense_date)) {
                    $error = 'Select date';
                    if(!empty($valid_tripsheet_profit_loss)) {
                        $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'expense_date', $error, 'text');
                    }
                    else {
                        $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'expense_date', $error, 'text');
                    }
                }
                if(isset($_POST['narration'])) {
                    $narration = $_POST['narration'];
                }
                if(empty($narration)) {
                    if(!empty($valid_tripsheet_profit_loss)) {
                        $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'narration', 'give narration', 'textarea');
                    }
                    else {
                        $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'narration', 'give narration', 'textarea');
                    }
                }
                if(isset($_POST['expense_category_id'])) {
                    $expense_category_id = $_POST['expense_category_id'];
                    $expense_category_id = trim($expense_category_id);
                    $expense_category_id_error = $valid->common_validation($expense_category_id, 'party', 'select');
                }
                if(empty($expense_category_id)) {
                    if(!empty($valid_tripsheet_profit_loss)) {
                        $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'expense_category_id', 'Select Categoty Id', 'select');
                    }
                    else {
                        $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'expense_category_id', 'Select Categoty Id', 'select');
                    }
                }
                $expense_amount_error = "";  $expense_array = array();
                if(!empty($payment_mode_ids)) {
                    for($i=0; $i < count($payment_mode_ids); $i++) {
                        $payment_mode_ids[$i] = trim($payment_mode_ids[$i]);
                        $payment_mode_name = "";
                        $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_ids[$i], 'payment_mode_name');
                        $payment_mode_names[$i] = $payment_mode_name;
                        
                        $bank_ids[$i] = trim($bank_ids[$i]); $decrypt_bank_name = "";
                        if(!empty($bank_ids[$i])) {
                            $bank_name = ""; 
                            $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_ids[$i], 'bank_name');
                            if(!empty($bank_name) && $bank_name != $GLOBALS['null_value']) {
                                $bank_names[$i] = $bank_name;
                                $decrypt_bank_name = 'Bank -'. $obj->encode_decode('decrypt',$bank_names[$i]); 
                            }
                            else {
                                $bank_names[$i] = "";
                            }
                        }
                        else {
                            $bank_ids[$i] = "";
                            $bank_names[$i] = "";
                        }
                        if(isset($expense_amount[$i])) {
                           $expense_amount[$i] = trim($expense_amount[$i]);
                            $expense_amount_error = "";
                            $expense_amount_error = $valid->valid_price($expense_amount[$i], 'Amount', '1', '');
                            if(!empty($expense_amount_error)) {
                                if(!empty($valid_expense)) {
                                    $valid_expense = $valid_expense." ".$valid->row_error_display($form_name, 'amount[]', $expense_amount_error, 'text', 'payment_row', ($i+1));
                                }
                                else {
                                    $valid_expense = $valid->row_error_display($form_name, 'amount[]', $expense_amount_error, 'text', 'payment_row', ($i+1));
                                }
                            }
                            else {
                                $company_expense_total_amounts += $expense_amount[$i];
                            }
                        }

                        
                       
                        $get_expense_id = "";
                        $expense_arrray[] = array("tax_type" => $payment_tax_types[$i], 'payment_mode_id' => $payment_mode_ids[$i], "bank_id" => $bank_ids[$i], 'expense_amount' => $expense_amount[$i]);
                        // if(!empty($edit_id)){
                        //     $get_expense_id = $obj->getTableColumnValue($GLOBALS['expense_table'],'tripsheet_profit_loss_id', $edit_id, 'expense_id');
                        // }
                        // $available_balance = 0; $tax_type_display = "";
                        // $available_balance =$obj->GetPaymentAmountForChecking($payment_tax_types[$i],$payment_mode_ids[$i],$bank_ids[$i],$get_expense_id);
                        
                        // if($payment_tax_types[$i] == 1){
                        //     $tax_type_display = "With Tax";
                        // }else{
                        //     $tax_type_display = "Without Tax";
                        // }

                        //     if($expense_amount[$i] > $available_balance){
                        //         $payment_error = "Max Amount in Payment Mode -  ".$obj->encode_decode('decrypt',$payment_mode_names[$i]). $decrypt_bank_name. " ".$tax_type_display ."  is Rs.".$available_balance;
                        //     }
                        
                    }
                    if($company_expense_total_amounts != $company_diesel_amount){
                        $payment_error = "Amount Should be equal to Rs. ". $company_expense_total_amounts;
                    }  
                       

                }
                else {
                    $payment_error .= "Add Company Payment";
                } 
        }

        // echo $driver_diesel_payment_update."hiii";
        if(!empty($driver_diesel_payment_update) && $driver_diesel_payment_update == 1 && $hidden_driver_expense_type != 'Paid'){
            
                if(isset($_POST['driver_payment_mode_id'])) {
                    $driver_payment_mode_ids = $_POST['driver_payment_mode_id'];
                    $driver_payment_mode_ids = array_reverse($driver_payment_mode_ids);
                }
            
                if(isset($_POST['driver_bank_id'])) {
                    $driver_bank_ids = $_POST['driver_bank_id'];
                    $driver_bank_ids = array_reverse($driver_bank_ids);
                }
                  if(isset($_POST['driver_amount'])) {
                    $driver_expense_amount = $_POST['driver_amount'];
                    $driver_expense_amount = array_reverse($driver_expense_amount);
                }   
                if(isset($_POST['driver_payment_tax_type'])) {
                    $driver_payment_tax_types = $_POST['driver_payment_tax_type'];
                    $driver_payment_tax_types = array_reverse($driver_payment_tax_types);
                }       
                // print_r($payment_tax_types);
                if(isset($_POST['driver_expense_date'])) {
                    $driver_expense_date = $_POST['driver_expense_date'];
                }
                if(empty($driver_expense_date)) {
                    $error = 'Select date';
                    if(!empty($valid_tripsheet_profit_loss)) {
                        $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'driver_expense_date', $error, 'text');
                    }
                    else {
                        $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'driver_expense_date', $error, 'text');
                    }
                }

                if(isset($_POST['driver_narration'])) {
                    $driver_narration = $_POST['driver_narration'];
                }
                if(empty($driver_narration)) {
                    if(!empty($valid_tripsheet_profit_loss)) {
                        $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'driver_narration', 'give narration', 'textarea');
                    }
                    else {
                        $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'driver_narration', 'give narration', 'textarea');
                    }
                }
                
                if(isset($_POST['driver_expense_category_id'])) {
                    $driver_expense_category_id = $_POST['driver_expense_category_id'];
                    $driver_expense_category_id = trim($driver_expense_category_id);
                    $driver_expense_category_id_error = $valid->common_validation($driver_expense_category_id, 'party', 'select');
                }
                if(empty($driver_expense_category_id)) {
                    if(!empty($valid_tripsheet_profit_loss)) {
                        $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'driver_expense_category_id', 'Select Categoty Id', 'select');
                    }
                    else {
                        $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'driver_expense_category_id', 'Select Categoty Id', 'select');
                    }
                }
                $expense_amount_error = ""; 
                if(!empty($driver_payment_mode_ids)) {
                    for($i=0; $i < count($driver_payment_mode_ids); $i++) {
                        $driver_payment_mode_ids[$i] = trim($driver_payment_mode_ids[$i]);
                        $driver_payment_mode_name = "";
                        $driver_payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $driver_payment_mode_ids[$i], 'payment_mode_name');
                        $driver_payment_mode_names[$i] = $driver_payment_mode_name;
                        
                        $driver_bank_ids[$i] = trim($driver_bank_ids[$i]); $driver_decrypt_bank_name = "";
                        if(!empty($driver_bank_ids[$i])) {
                            $driver_bank_name = ""; 
                            $driver_bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $driver_bank_ids[$i], 'bank_name');
                            if(!empty($driver_bank_name) && $driver_bank_name != $GLOBALS['null_value']) {
                                $driver_bank_names[$i] = $driver_bank_name;
                                $driver_decrypt_bank_name = 'Bank -'. $obj->encode_decode('decrypt',$driver_bank_names[$i]); 
                            }
                            else {
                                $driver_bank_names[$i] = "";
                            }
                        }
                        else {
                            $driver_bank_ids[$i] = "";
                            $driver_bank_names[$i] = "";
                        }
                        if(isset($driver_expense_amount[$i])) {
                           $driver_expense_amount[$i] = trim($driver_expense_amount[$i]);
                            $driver_expense_amount_error = "";
                            $driver_expense_amount_error = $valid->valid_price($driver_expense_amount[$i], 'Amount', '1', '');
                            if(!empty($driver_expense_amount_error)) {
                                if(!empty($valid_expense)) {
                                    $valid_expense = $valid_expense." ".$valid->row_error_display($form_name, 'amount[]', $driver_expense_amount_error, 'text', 'payment_row', ($i+1));
                                }
                                else {
                                    $valid_expense = $valid->row_error_display($form_name, 'amount[]', $driver_expense_amount_error, 'text', 'payment_row', ($i+1));
                                }
                            }
                            else {
                                $driver_expense_total_amounts += $driver_expense_amount[$i];
                            }
                        }
                        $get_expense_id = "";
                        // if(!empty($edit_id)){
                        //     $get_expense_id = $obj->getTableColumnValue($GLOBALS['expense_table'],'tripsheet_profit_loss_id', $edit_id, 'expense_id');
                        // }
                        $tax_type_display = "";
                        $expense_arrray[] = array("tax_type" => $driver_payment_tax_types[$i], 'payment_mode_id' => $driver_payment_mode_ids[$i], "bank_id" => $driver_bank_ids[$i], 'expense_amount' => $driver_expense_amount[$i]);
                        // $available_balance += $obj->GetPaymentAmountForChecking($driver_payment_tax_types[$i],$driver_payment_mode_ids[$i],$driver_bank_ids[$i],$get_expense_id);
                        
                        // if($driver_payment_tax_types[$i] == 1){
                        //     $tax_type_display = "With Tax";
                        // }else{
                        //     $tax_type_display = "Without Tax";
                        // }

                            // if($driver_expense_amount[$i] > $available_balance){
                            //     $payment_error = "Max Amount in Payment Mode -  ".$obj->encode_decode('decrypt',$driver_payment_mode_names[$i]). $driver_decrypt_bank_name. " ".$tax_type_display ."  is Rs.".$available_balance;
                            // }
                        
                    }
                        // if($total_amount != $expense_total_amounts){
                        //     $payment_error = "Amount Should be equal to Rs. ". $total_amount;
                                                    
                        // }  
                    if($driver_expense_total_amounts != $driver_diesel_amount){
                        $payment_error = "Expense Amount Should be equal to Rs. ". $driver_expense_total_amounts;
                    } 

                }
                else {
                    $payment_error = $payment_error."<br>" ."Add Driver Payment";
                } 
        }
        // echo $payment_error."dk";

    if(!empty($expense_arrray)) {
            array_multisort(array_column($expense_arrray, "tax_type"), SORT_ASC,array_column($expense_arrray, "payment_mode_id"), SORT_ASC,array_column($expense_arrray, "bank_id"), $expense_arrray);
            $final_array = combineAndSumUp($expense_arrray);
        }

        array_multisort(array_column($expense_arrray, "tax_type"), SORT_ASC,array_column($expense_arrray, "payment_mode_id"), SORT_ASC,array_column($expense_arrray, "bank_id"), $expense_arrray);

        if(!empty($final_array))
        {
            foreach($final_array as $data)
            {
                $available_balance = 0; $total_expense_amount = 0; $get_expense_id = 0; $expense_tax_type = ""; $expense_payment_mode_id = ""; $expense_bank_id = ""; $expense_amount = 0;

                if(!empty($data['tax_type'])) {
                    $expense_tax_type = $data['tax_type'];
                }

                if(!empty($data['payment_mode_id'])) {
                    $expense_payment_mode_id = $data['payment_mode_id'];
                }

                if(!empty($data['bank_id'])) {
                    $expense_bank_id = $data['bank_id'];
                }

                if(!empty($data['expense_amount'])) {
                    $expense_amount = $data['expense_amount'];
                }
                
                $available_balance = $obj->GetPaymentAmountForChecking($expense_tax_type,$expense_payment_mode_id,$expense_bank_id,$get_expense_id);
                
                if($available_balance < $expense_amount) {

                    $payment_mode_name = "";
                    $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $expense_payment_mode_id, 'payment_mode_name');
                    $bank_name = ""; 
                    $payment_mode_name = $obj->encode_decode("decrypt", $payment_mode_name);
                    $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $expense_bank_id, 'bank_name');
                    $bank_name = $obj->encode_decode("decrypt", $bank_name);
             
                    if($expense_tax_type == 1) {
                        $payment_error .= "The available balance with tax, in ". $bank_name. " on ". $payment_mode_name." was ₹". $available_balance;
                        break;
                    } else {
                        if($expense_tax_type == 2) {
                            
                            $payment_error .= "The available balance without tax, in ". $bank_name. " on ". $payment_mode_name." was ₹". $available_balance. "<br>";
                            break;

                        }
                    }
                    
                } 
                
            }
        } 

        // echo $payment_error."/////";

                // $result = array('number' => '2', 'msg' => $payment_error);  
        if(empty($valid_tripsheet_profit_loss) && empty($expense_error)) {
            if(empty($payment_error)){
                $check_user_id_ip_address = 0;
                $check_user_id_ip_address = $obj->check_user_id_ip_address();	
                if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                    $vehicle_number = ""; $from_tripsheet_number = ""; $to_tripsheet_number = "";
                    if(!empty($trip_number)) {
                        $trip_number = $obj->encode_decode('encrypt', $trip_number);
                    }
                    else {
                        $trip_number = $GLOBALS['null_value'];
                    }
                    if(!empty($driver_name)) {
                        $driver_name = $obj->encode_decode('encrypt', $driver_name);
                    }
                    else {
                        $driver_name = $GLOBALS['null_value'];
                    }
                    if(!empty($vehicle_id)) {
                        $vehicle_number = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'vehicle_id', $vehicle_id, 'vehicle_number');
                    }
                    else {
                        $vehicle_id = $GLOBALS['null_value'];
                        $vehicle_number = $GLOBALS['null_value'];
                    }
                    if(!empty($from_tripsheet_id)) {
                        $from_tripsheet_number = $obj->getTableColumnValue($GLOBALS['tripsheet_table'], 'tripsheet_id', $from_tripsheet_id, 'tripsheet_number');
                    }
                    else {
                        $from_tripsheet_id = $GLOBALS['null_value'];
                        $from_tripsheet_number = $GLOBALS['null_value'];
                    }
                    if(!empty($to_tripsheet_id)) {
                        $to_tripsheet_number = $obj->getTableColumnValue($GLOBALS['tripsheet_table'], 'tripsheet_id', $to_tripsheet_id, 'tripsheet_number');
                    }
                    else {
                        $to_tripsheet_id = $GLOBALS['null_value'];
                        $to_tripsheet_number = $GLOBALS['null_value'];
                    }
                    if(!empty($from_tripsheet_date)) {
                        $from_tripsheet_date = date('Y-m-d', strtotime($from_tripsheet_date));
                    }
                    if(!empty($to_tripsheet_date)) {
                        $to_tripsheet_date = date('Y-m-d', strtotime($to_tripsheet_date));
                    }
                    if(empty($from_tripsheet_from_branch)) {
                        $from_tripsheet_from_branch = $GLOBALS['null_value'];
                    }
                    if(empty($from_tripsheet_to_branch)) {
                        $from_tripsheet_to_branch = $GLOBALS['null_value'];
                    }
                    if(empty($from_tripsheet_quantity)) {
                        $from_tripsheet_quantity = $GLOBALS['null_value'];
                    }
                    if(empty($from_tripsheet_weight)) {
                        $from_tripsheet_weight = $GLOBALS['null_value'];
                    }
                    if(empty($from_tripsheet_rent)) {
                        $from_tripsheet_rent = $GLOBALS['null_value'];
                    }
                    if(empty($to_tripsheet_from_branch)) {
                        $to_tripsheet_from_branch = $GLOBALS['null_value'];
                    }
                    if(empty($to_tripsheet_to_branch)) {
                        $to_tripsheet_to_branch = $GLOBALS['null_value'];
                    }
                    if(empty($to_tripsheet_quantity)) {
                        $to_tripsheet_quantity = $GLOBALS['null_value'];
                    }
                    if(empty($to_tripsheet_weight)) {
                        $to_tripsheet_weight = $GLOBALS['null_value'];
                    }
                    if(empty($to_tripsheet_rent)) {
                        $to_tripsheet_rent = $GLOBALS['null_value'];
                    }
                    if(empty($total_rent)) {
                        $total_rent = $GLOBALS['null_value'];
                    }
                    if(empty($trip_cost)) {
                        $trip_cost = $GLOBALS['null_value'];
                    }
                    if(empty($balance)) {
                        $balance = $GLOBALS['null_value'];
                    }
                    if(empty($loading_wage)) {
                        $loading_wage = $GLOBALS['null_value'];
                    }
                    if(empty($night_food)) {
                        $night_food = $GLOBALS['null_value'];
                    }
                    if(empty($driver_salary)) {
                        $driver_salary = $GLOBALS['null_value'];
                    }
                    if(empty($tire_depreciation)) {
                        $tire_depreciation = $GLOBALS['null_value'];
                    }
                    if(empty($toll_gate)) {
                        $toll_gate = $GLOBALS['null_value'];
                    }
                    if(empty($net_balance)) {
                        $net_balance = $GLOBALS['null_value'];
                    }
                    if(empty($starting_km)) {
                        $starting_km = $GLOBALS['null_value'];
                    }
                    if(empty($ending_km)) {
                        $ending_km = $GLOBALS['null_value'];
                    }
                    if(empty($travelled_km)) {
                        $travelled_km = $GLOBALS['null_value'];
                    }
                    if(empty($diesel)) {
                        $diesel = $GLOBALS['null_value'];
                    }
                    if(empty($mileage)) {
                        $mileage = $GLOBALS['null_value'];
                    }
                    if(empty($trip_balance)) {
                        $trip_balance = $GLOBALS['null_value'];
                    }
                    if(empty($advance)) {
                        $advance = $GLOBALS['null_value'];
                    }
                    if(empty($diesel_cost)) {
                        $diesel_cost = $GLOBALS['null_value'];
                    }
                    if(empty($diesel_cost_per_litre)) {
                        $diesel_cost_per_litre = $GLOBALS['null_value'];
                    }
                    if(empty($company_expense_type)) {
                        $company_expense_type = $GLOBALS['null_value'];
                    }
                    if(empty($driver_expense_type)) {
                        $driver_expense_type = $GLOBALS['null_value'];
                    }
                    if(!empty(array_filter($expense_names, fn($value) => $value !== ""))) {
                        $expense_names = implode(",", $expense_names);
                    }
                    else {
                        $expense_names = $GLOBALS['null_value'];
                    }
                    if(!empty(array_filter($company_expense_names, fn($value) => $value !== ""))) {
                        $company_expense_names = implode(",", $company_expense_names);
                    }
                    else {
                        $company_expense_names = $GLOBALS['null_value'];
                    }
                    if(!empty(array_filter($expense_values, fn($value) => $value !== ""))) {
                        $expense_values = implode(",", $expense_values);
                    }
                    else {
                        $expense_values = $GLOBALS['null_value'];
                    }
                    if(!empty(array_filter($company_expense_values, fn($value) => $value !== ""))) {
                        $company_expense_values = implode(",", $company_expense_values);
                    }
                    else {
                        $company_expense_values = $GLOBALS['null_value'];
                    }
                    if(!empty(array_filter($tripsheet_status, fn($value) => $value !== ""))) {
                        $tripsheet_status = implode(",", $tripsheet_status);
                    }
                    else {
                        $tripsheet_status = $GLOBALS['null_value'];
                    }
                    if(!empty($expense_category_id)){
                        $expense_category_name = $obj->getTableColumnValue($GLOBALS['expense_category_table'], 'expense_category_id', $expense_category_id, 'expense_category_name');
                    } else {
                        $expense_category_id = $GLOBALS['null_value'];
                        $expense_category_name = $GLOBALS['null_value'];
                    }
                    if(!empty($driver_expense_category_id)){
                        $driver_expense_category_name = $obj->getTableColumnValue($GLOBALS['expense_category_table'], 'expense_category_id', $driver_expense_category_id, 'expense_category_name');
                    } else {
                        $driver_expense_category_id = $GLOBALS['null_value'];
                        $driver_expense_category_name = $GLOBALS['null_value'];
                    }
                           if(!empty($payment_mode_ids)) {
                                $payment_mode_ids = array_reverse($payment_mode_ids);
                                $payment_mode_ids = implode(',', $payment_mode_ids);
                            }
                            else {
                                $payment_mode_ids = $GLOBALS['null_value'];
                            }
                            if(!empty($payment_mode_names)) {
                                $payment_mode_names = array_reverse($payment_mode_names);
                                $payment_mode_names = implode(',', $payment_mode_names);
                            }
                            else {
                                $payment_mode_names = $GLOBALS['null_value'];
                            }
                            if(!empty($bank_ids)) {
                                $bank_ids = array_reverse($bank_ids);
                                $bank_ids = implode(',', $bank_ids);
                            }
                            else {
                                $bank_ids = $GLOBALS['null_value'];
                            }
                            if(!empty($bank_names)) {
                                $bank_names = array_reverse($bank_names);
                                $bank_names = implode(',', $bank_names);
                            }
                            else {
                                $bank_names = $GLOBALS['null_value'];
                            }

                            if(!empty($expense_date)) {
                                $expense_date = date("Y-m-d", strtotime($expense_date));
                            }

                            if(!empty($payment_tax_types)) {
                                $payment_tax_types = array_reverse($payment_tax_types);
                                $payment_tax_types = implode(',', $payment_tax_types);
                            }
                            else {
                                $payment_tax_types = $GLOBALS['null_value'];
                            }
                            if(!empty($driver_expense_amount)) {
                                $driver_expense_amount = array_reverse($driver_expense_amount);
                                $driver_expense_amount = implode(',', $driver_expense_amount);
                            }
                            else {
                                $driver_expense_amount = $GLOBALS['null_value'];
                            }
                            if(!empty($company_expense_amount)) {
                                $company_expense_amount = array_reverse($company_expense_amount);
                                $company_expense_amount = implode(',', $company_expense_amount);
                            }
                            else {
                                $company_expense_amount = $GLOBALS['null_value'];
                            }
                            if(!empty($narration)) {
                                $narration = $obj->encode_decode('encrypt', $narration);
                            }
                            else {
                                $narration = $GLOBALS['null_value'];
                            }
                            if(empty($party_type)){
                                $party_type = $GLOBALS['null_value'];
                            }

                            if(!empty($driver_payment_tax_types)) {
                                $driver_payment_tax_types = array_reverse($driver_payment_tax_types);
                                $driver_payment_tax_types = implode(',', $driver_payment_tax_types);
                            }
                            else {
                                $driver_payment_tax_types = $GLOBALS['null_value'];
                            }

                            if(!empty($driver_narration)) {
                                $driver_narration = $obj->encode_decode('encrypt', $driver_narration);
                            }
                            else {
                                $driver_narration = $GLOBALS['null_value'];
                            }
                            if(!empty($driver_payment_mode_ids)) {
                                $driver_payment_mode_ids = array_reverse($driver_payment_mode_ids);
                                $driver_payment_mode_ids = implode(',', $driver_payment_mode_ids);
                            }
                            else {
                                $driver_payment_mode_ids = $GLOBALS['null_value'];
                            }
                            if(!empty($driver_payment_mode_names)) {
                                $driver_payment_mode_names = array_reverse($driver_payment_mode_names);
                                $driver_payment_mode_names = implode(',', $driver_payment_mode_names);
                            }
                            else {
                                $driver_payment_mode_names = $GLOBALS['null_value'];
                            }
                            if(!empty($driver_bank_ids)) {
                                $driver_bank_ids = array_reverse($driver_bank_ids);
                                $driver_bank_ids = implode(',', $driver_bank_ids);
                            }
                            else {
                                $driver_bank_ids = $GLOBALS['null_value'];
                            }
                            if(!empty($driver_bank_names)) {
                                $driver_bank_names = array_reverse($driver_bank_names);
                                $driver_bank_names = implode(',', $driver_bank_names);
                            }
                            else {
                                $driver_bank_names = $GLOBALS['null_value'];
                            }
                            
                            $expense_party_type = "Expense Category";

                    $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                    $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']); $bill_company_id = $GLOBALS['bill_company_id'];
                    $tripsheet_profit_loss_id = ""; $balance = 0; $update_payment_table = 0;
                    if(empty($edit_id)) {			
                        $action = "";
                        $action = "New Tripsheet Profit Loss Created.";

                        $null_value = $GLOBALS['null_value'];
                        $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'tripsheet_profit_loss_id', 'trip_number', 'vehicle_id', 'vehicle_number', 'driver_name', 'from_tripsheet_date', 'from_tripsheet_id', 'from_tripsheet_number', 'from_tripsheet_from_branch', 'from_tripsheet_to_branch', 'from_tripsheet_quantity', 'from_tripsheet_weight', 'from_tripsheet_rent', 'to_tripsheet_date', 'to_tripsheet_id', 'to_tripsheet_number', 'to_tripsheet_from_branch', 'to_tripsheet_to_branch', 'to_tripsheet_quantity', 'to_tripsheet_weight', 'to_tripsheet_rent', 'total_rent', 'trip_cost', 'balance', 'loading_wage', 'night_food', 'driver_salary', 'tire_depreciation', 'toll_gate', 'net_balance', 'starting_km', 'ending_km', 'travelled_km', 'diesel', 'mileage', 'trip_balance', 'advance', 'diesel_cost', 'diesel_cost_per_litre', 'expense_name', 'expense_value', 'driver_expense_type', 'company_expense_type', 'tripsheet_status','company_expense_name','company_expense_value','company_diesel_amount','driver_diesel_amount','deleted');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$trip_number."'", "'".$vehicle_id."'", "'".$vehicle_number."'", "'".$driver_name."'", "'".$from_tripsheet_date."'", "'".$from_tripsheet_id."'", "'".$from_tripsheet_number."'", "'".$from_tripsheet_from_branch."'", "'".$from_tripsheet_to_branch."'", "'".$from_tripsheet_quantity."'", "'".$from_tripsheet_weight."'", "'".$from_tripsheet_rent."'", "'".$to_tripsheet_date."'", "'".$to_tripsheet_id."'", "'".$to_tripsheet_number."'", "'".$to_tripsheet_from_branch."'", "'".$to_tripsheet_to_branch."'", "'".$to_tripsheet_quantity."'", "'".$to_tripsheet_weight."'", "'".$to_tripsheet_rent."'", "'".$total_rent."'", "'".$trip_cost."'", "'".$balance."'", "'".$loading_wage."'", "'".$night_food."'", "'".$driver_salary."'", "'".$tire_depreciation."'", "'".$toll_gate."'", "'".$net_balance."'", "'".$starting_km."'", "'".$ending_km."'", "'".$travelled_km."'", "'".$diesel."'", "'".$mileage."'", "'".$trip_balance."'", "'".$advance."'", "'".$diesel_cost."'", "'".$diesel_cost_per_litre."'", "'".$expense_names."'", "'".$expense_values."'","'".$driver_expense_type."'","'".$company_expense_type."'", "'".$tripsheet_status."'","'".$company_expense_names."'","'".$company_expense_values."'","'".$company_diesel_amount."'","'".$driver_diesel_amount."'","'0'");

                        $profit_loss_insert_id = $obj->InsertSQL($GLOBALS['tripsheet_profit_loss_table'], $columns, $values, $action);						
                        if(preg_match("/^\d+$/", $profit_loss_insert_id)) {
                            if($profit_loss_insert_id < 10) {
                                $tripsheet_profit_loss_id = "TRIPSHEET_PL_".date("dmYhis")."_0".$profit_loss_insert_id;
                            }
                            else {
                                $tripsheet_profit_loss_id = "TRIPSHEET_PL_".date("dmYhis")."_".$profit_loss_insert_id;
                            }
                            if(!empty($tripsheet_profit_loss_id)) {
                                $tripsheet_profit_loss_id = $obj->encode_decode('encrypt', $tripsheet_profit_loss_id);
                            }
                            $columns = array(); $values = array();						
                            $columns = array('tripsheet_profit_loss_id');
                            $values = array("'".$tripsheet_profit_loss_id."'");
                            $profit_loss_update_id = $obj->UpdateSQL($GLOBALS['tripsheet_profit_loss_table'], $profit_loss_insert_id, $columns, $values, '');
                            if(preg_match("/^\d+$/", $profit_loss_update_id)) {
                                $result = array('number' => '1', 'msg' => 'Tripsheet Profit Loss Successfully Created');					
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $profit_loss_update_id);
                            }
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $profit_loss_insert_id);
                        }

                        if(!empty($tripsheet_profit_loss_id) && !empty($payment_updation) && $payment_updation == 1) {
                            $columns = array(); $values = array(); $expense_number = "";

                            $expense_number = $obj->new_automate_number($GLOBALS['expense_table'], 'expense_number');
                            if(empty($expense_number)){
                                $expense_number = $GLOBALS['null_value'];
                            }

                            $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'expense_id', 'expense_number', 'expense_date','expense_category_id', 'expense_category_name','payment_tax_type', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount','tripsheet_profit_loss_id','deleted');
                            $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$expense_number."'", "'".$expense_date."'", "'".$expense_category_id."'", "'".$expense_category_name."'", "'".$payment_tax_types."'", "'".$narration."'", "'".$expense_amount."'", "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'", "'".$company_expense_total_amounts."'", "'".$tripsheet_profit_loss_id."'","'0'");
                            $expense_insert_id = $obj->InsertSQL($GLOBALS['expense_table'], $columns, $values, $action);						

                            if(preg_match("/^\d+$/", $expense_insert_id)) {
                                        $expense_id = "";
                                        if($expense_insert_id < 10) {
                                            $expense_id = "expense_".date("dmYhis")."_0".$expense_insert_id;
                                        }
                                        else {
                                            $expense_id = "expense_".date("dmYhis")."_".$expense_insert_id;
                                        }
                                        if(!empty($expense_id)) {
                                            $expense_id = $obj->encode_decode('encrypt', $expense_id);
                                        }
                                        $columns = array(); $values = array();						
                                        $columns = array('expense_id');
                                        $values = array("'".$expense_id."'");
                                        $expense_update_id = $obj->UpdateSQL($GLOBALS['expense_table'], $expense_insert_id, $columns, $values, '');
                                        if(preg_match("/^\d+$/", $expense_update_id)) {		
                                            $update_payment_table = 1;
                                            $result = array('number' => '1', 'msg' => 'Expense Successfully Created');					
                                            $balance = 1;							
                                        }
                                        else {
                                            $result = array('number' => '2', 'msg' => $expense_update_id);
                                        }
                                    }
                                $result = array('number' => '1', 'msg' => 'Tripsheet Profit Loss Successfully Created','redirection_page' =>'tripsheet_profit_loss.php','tripsheet_profit_loss_id' => $tripsheet_profit_loss_id);
                        }

                        if(!empty($tripsheet_profit_loss_id) && !empty($driver_diesel_payment_update) && $driver_diesel_payment_update == 1) {
                            $columns = array(); $values = array();
                            $expense_number = "";

                            $expense_number = $obj->new_automate_number($GLOBALS['expense_table'], 'expense_number');
                            if(empty($expense_number)){
                                $expense_number = $GLOBALS['null_value'];
                            }

                            $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'expense_id', 'expense_number', 'expense_date','expense_category_id', 'expense_category_name','payment_tax_type', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount','tripsheet_profit_loss_id','deleted');
                            $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$expense_number."'", "'".$driver_expense_date."'", "'".$driver_expense_category_id."'", "'".$driver_expense_category_name."'", "'".$driver_payment_tax_types."'", "'".$driver_narration."'", "'".$driver_expense_amount."'", "'".$driver_payment_mode_ids."'", "'".$driver_payment_mode_names."'", "'".$driver_bank_ids."'", "'".$driver_bank_names."'", "'".$driver_expense_total_amounts."'", "'".$tripsheet_profit_loss_id."'","'0'");
                            $expense_insert_id = $obj->InsertSQL($GLOBALS['expense_table'], $columns, $values, $action);						

                                    if(preg_match("/^\d+$/", $expense_insert_id)) {
                                        $driver_expense_id = "";
                                        if($expense_insert_id < 10) {
                                            $driver_expense_id = "expense_".date("dmYhis")."_0".$expense_insert_id;
                                        }
                                        else {
                                            $driver_expense_id = "expense_".date("dmYhis")."_".$expense_insert_id;
                                        }
                                        if(!empty($driver_expense_id)) {
                                            $driver_expense_id = $obj->encode_decode('encrypt', $driver_expense_id);
                                        }
                                        $columns = array(); $values = array();						
                                        $columns = array('expense_id');
                                        $values = array("'".$driver_expense_id."'");
                                        $expense_update_id = $obj->UpdateSQL($GLOBALS['expense_table'], $expense_insert_id, $columns, $values, '');
                                        if(preg_match("/^\d+$/", $expense_update_id)) {		
                                            $result = array('number' => '1', 'msg' => 'Expense Successfully Created');					
                                            $driver_balance = 1;	 						
                                        }
                                        else {
                                            $result = array('number' => '2', 'msg' => $expense_update_id);
                                        }
                                    }
                                
                                $result = array('number' => '1', 'msg' => 'Tripsheet Profit Loss Successfully Created','redirection_page' =>'tripsheet_profit_loss.php','tripsheet_profit_loss_id' => $tripsheet_profit_loss_id);
                        }
                    }
                    else {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['tripsheet_profit_loss_table'], 'tripsheet_profit_loss_id', $edit_id, 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $action = "";
                            $action = "Tripsheet Profit Loss Updated";
                        
                            $columns = array(); $values = array();
                            $columns = array('creator_name', 'trip_number', 'vehicle_id', 'vehicle_number', 'driver_name', 'from_tripsheet_date', 'from_tripsheet_id', 'from_tripsheet_number', 'from_tripsheet_from_branch', 'from_tripsheet_to_branch', 'from_tripsheet_quantity', 'from_tripsheet_weight', 'from_tripsheet_rent', 'to_tripsheet_date', 'to_tripsheet_id', 'to_tripsheet_number', 'to_tripsheet_from_branch', 'to_tripsheet_to_branch', 'to_tripsheet_quantity', 'to_tripsheet_weight', 'to_tripsheet_rent', 'total_rent', 'trip_cost', 'balance', 'loading_wage', 'night_food', 'driver_salary', 'tire_depreciation', 'toll_gate', 'net_balance', 'starting_km', 'ending_km', 'travelled_km', 'diesel', 'mileage', 'trip_balance', 'advance', 'diesel_cost', 'diesel_cost_per_litre', 'expense_name', 'expense_value', 'driver_expense_type', 'company_expense_type','tripsheet_status','company_expense_value','company_expense_name','company_diesel_amount','driver_diesel_amount');
                            $values = array("'".$creator_name."'", "'".$trip_number."'", "'".$vehicle_id."'", "'".$vehicle_number."'", "'".$driver_name."'", "'".$from_tripsheet_date."'", "'".$from_tripsheet_id."'", "'".$from_tripsheet_number."'", "'".$from_tripsheet_from_branch."'", "'".$from_tripsheet_to_branch."'", "'".$from_tripsheet_quantity."'", "'".$from_tripsheet_weight."'", "'".$from_tripsheet_rent."'", "'".$to_tripsheet_date."'", "'".$to_tripsheet_id."'", "'".$to_tripsheet_number."'", "'".$to_tripsheet_from_branch."'", "'".$to_tripsheet_to_branch."'", "'".$to_tripsheet_quantity."'", "'".$to_tripsheet_weight."'", "'".$to_tripsheet_rent."'", "'".$total_rent."'", "'".$trip_cost."'", "'".$balance."'", "'".$loading_wage."'", "'".$night_food."'", "'".$driver_salary."'", "'".$tire_depreciation."'", "'".$toll_gate."'", "'".$net_balance."'", "'".$starting_km."'", "'".$ending_km."'", "'".$travelled_km."'", "'".$diesel."'", "'".$mileage."'", "'".$trip_balance."'", "'".$advance."'", "'".$diesel_cost."'", "'".$diesel_cost_per_litre."'", "'".$expense_names."'", "'".$expense_values."'","'".$driver_expense_type."'","'".$company_expense_type."'","'".$tripsheet_status."'","'".$company_expense_values."'","'".$company_expense_names."'","'".$company_diesel_amount."'","'".$driver_diesel_amount."'");
                            
                            $profit_loss_update_id = $obj->UpdateSQL($GLOBALS['tripsheet_profit_loss_table'], $getUniqueID, $columns, $values, $action);
                            $tripsheet_profit_loss_id = $edit_id;
                            if(preg_match("/^\d+$/", $profit_loss_update_id)) {	
                                $result = array('number' => '1', 'msg' => 'Updated Successfully');				
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $profit_loss_update_id);
                            }							
                        }

                            if(!empty($tripsheet_profit_loss_id) && !empty($payment_updation) && $payment_updation == 1 &&($hidden_company_expense_type != 'Paid')) {
                                $columns = array(); $values = array(); $expense_number = "";

                                $expense_number = $obj->new_automate_number($GLOBALS['expense_table'], 'expense_number');
                                if(empty($expense_number)){
                                    $expense_number = $GLOBALS['null_value'];
                                }

                                $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'expense_id', 'expense_number', 'expense_date','expense_category_id', 'expense_category_name','payment_tax_type', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount','tripsheet_profit_loss_id','deleted');
                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$expense_number."'", "'".$expense_date."'", "'".$expense_category_id."'", "'".$expense_category_name."'", "'".$payment_tax_types."'", "'".$narration."'", "'".$expense_amount."'", "'".$payment_mode_ids."'", "'".$payment_mode_names."'", "'".$bank_ids."'", "'".$bank_names."'", "'".$company_expense_total_amounts."'", "'".$tripsheet_profit_loss_id."'","'0'");
                                $expense_insert_id = $obj->InsertSQL($GLOBALS['expense_table'], $columns, $values, $action);						

                                if(preg_match("/^\d+$/", $expense_insert_id)) {
                                            $expense_id = "";
                                            if($expense_insert_id < 10) {
                                                $expense_id = "expense_".date("dmYhis")."_0".$expense_insert_id;
                                            }
                                            else {
                                                $expense_id = "expense_".date("dmYhis")."_".$expense_insert_id;
                                            }
                                            if(!empty($expense_id)) {
                                                $expense_id = $obj->encode_decode('encrypt', $expense_id);
                                            }
                                            $columns = array(); $values = array();						
                                            $columns = array('expense_id');
                                            $values = array("'".$expense_id."'");
                                            $expense_update_id = $obj->UpdateSQL($GLOBALS['expense_table'], $expense_insert_id, $columns, $values, '');
                                            if(preg_match("/^\d+$/", $expense_update_id)) {		
                                                $update_payment_table = 1;
                                                $result = array('number' => '1', 'msg' => 'Expense Successfully Created');					
                                            }
                                            else {
                                                $result = array('number' => '2', 'msg' => $expense_update_id);
                                            }
                                        }
                                    $result = array('number' => '1', 'msg' => 'Tripsheet Profit Loss Successfully Created','redirection_page' =>'tripsheet_profit_loss.php','tripsheet_profit_loss_id' => $tripsheet_profit_loss_id);
                            }

                            if(!empty($tripsheet_profit_loss_id) && !empty($driver_diesel_payment_update) && $driver_diesel_payment_update == 1 && $hidden_driver_expense_type != 'Paid') {
                                $columns = array(); $values = array();
                                $expense_number = "";

                                $expense_number = $obj->new_automate_number($GLOBALS['expense_table'], 'expense_number');
                                if(empty($expense_number)){
                                    $expense_number = $GLOBALS['null_value'];
                                }

                                $columns = array('created_date_time', 'creator', 'creator_name','bill_company_id', 'expense_id', 'expense_number', 'expense_date','expense_category_id', 'expense_category_name','payment_tax_type', 'narration', 'amount', 'payment_mode_id', 'payment_mode_name', 'bank_id', 'bank_name','total_amount','tripsheet_profit_loss_id','deleted');
                                $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'","'".$bill_company_id."'", "'".$null_value."'", "'".$expense_number."'", "'".$driver_expense_date."'", "'".$driver_expense_category_id."'", "'".$driver_expense_category_name."'", "'".$driver_payment_tax_types."'", "'".$driver_narration."'", "'".$driver_expense_amount."'", "'".$driver_payment_mode_ids."'", "'".$driver_payment_mode_names."'", "'".$driver_bank_ids."'", "'".$driver_bank_names."'", "'".$driver_expense_total_amounts."'", "'".$tripsheet_profit_loss_id."'","'0'");
                                $expense_insert_id = $obj->InsertSQL($GLOBALS['expense_table'], $columns, $values, $action);						

                                if(preg_match("/^\d+$/", $expense_insert_id)) {
                                            $driver_expense_id = "";
                                            if($expense_insert_id < 10) {
                                                $driver_expense_id = "expense_".date("dmYhis")."_0".$expense_insert_id;
                                            }
                                            else {
                                                $driver_expense_id = "expense_".date("dmYhis")."_".$expense_insert_id;
                                            }
                                            if(!empty($driver_expense_id)) {
                                                $driver_expense_id = $obj->encode_decode('encrypt', $driver_expense_id);
                                            }
                                            $columns = array(); $values = array();						
                                            $columns = array('expense_id');
                                            $values = array("'".$driver_expense_id."'");
                                            $expense_update_id = $obj->UpdateSQL($GLOBALS['expense_table'], $expense_insert_id, $columns, $values, '');
                                            if(preg_match("/^\d+$/", $expense_update_id)) {		
                                                $result = array('number' => '1', 'msg' => 'Expense Successfully Created');					
                                                $driver_balance = 1;	 						
                                            }
                                            else {
                                                $result = array('number' => '2', 'msg' => $expense_update_id);
                                            }
                                        }
                                    $result = array('number' => '1', 'msg' => 'Tripsheet Profit Loss Successfully Created','redirection_page' =>'tripsheet_profit_loss.php','tripsheet_profit_loss_id' => $tripsheet_profit_loss_id);
                            }
                    }
                    if(!empty($update_payment_table) && $update_payment_table == 1) {
                        $bill_company_id = $GLOBALS['bill_company_id']; $bill_id = $tripsheet_profit_loss_id; $credit  = 0; $debit = 0; $bill_type ="Expense";$bill_number = $expense_number; $party_name =""; $party_type = "Expense Category"; $payment_mode_id = $GLOBALS['null_value']; $payment_mode_name = $GLOBALS['null_value'];$bank_id =  $GLOBALS['null_value'];$bank_name =  $GLOBALS['null_value']; $open_balance_type = "Debit"; $payment_tax_type = $GLOBALS['null_value'];
                        $bill_date = $expense_date;

                        $debit  = $total_amount; 
                        
                        if(empty($credit)){
                            $credit = 0;
                        }
                        if(empty($debit)){
                            $debit = 0;
                        }
                        if(empty($opening_balance)){
                            $opening_balance = 0;
                        }
                        if(empty($opening_balance_type)){
                            $opening_balance_type = $GLOBALS['null_value'];
                        }
                            $party_id = $expense_id;
                        
                        if(!empty($party_id)){
                            $party_name = $obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$party_id,'party_name');
                        }
                        $update_balance ="";
                        $update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type, $payment_tax_type,'');

                    }
                    if(!empty($driver_balance) && $driver_balance == 1) {
                        $bill_company_id = $GLOBALS['bill_company_id']; $bill_id = $tripsheet_profit_loss_id; $credit  = 0; $debit = 0; $bill_type ="Expense";$bill_number = $expense_number; $party_name =""; $party_type = "Expense Category"; $driver_payment_mode_id = $GLOBALS['null_value']; $driver_payment_mode_name = $GLOBALS['null_value'];$driver_bank_id =  $GLOBALS['null_value'];$driver_bank_name =  $GLOBALS['null_value']; $open_balance_type = "Debit"; $payment_tax_type = $GLOBALS['null_value'];
                        $bill_date = $expense_date;

                        $debit  = $total_amount; 
                        
                        if(empty($credit)){
                            $credit = 0;
                        }
                        if(empty($debit)){
                            $debit = 0;
                        }
                        if(empty($opening_balance)){
                            $opening_balance = 0;
                        }
                        if(empty($opening_balance_type)){
                            $opening_balance_type = $GLOBALS['null_value'];
                        }
                            $party_id = $driver_expense_id;
                        
                        if(!empty($party_id)){
                            $party_name = $obj->getTableColumnValue($GLOBALS['party_table'],'party_id',$party_id,'party_name');
                        }
                        $update_balance ="";
                        $update_balance = $obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type, $payment_tax_type,'');

                    }
                }
                else {
                    $result = array('number' => '2', 'msg' => 'Invalid IP');
                }
            }  else {
                if(!empty($payment_error)) {
                    $result = array('number' => '2', 'msg' => $payment_error);   
                }
            }
        }
        else {
            
            if(!empty($expense_error)) {
                $result = array('number' => '2', 'msg' => $expense_error);
            } else if(!empty($valid_tripsheet_profit_loss)) {
                $result = array('number' => '3', 'msg' => $valid_tripsheet_profit_loss);
            } 
        }
		if(!empty($result)) {
			$result = json_encode($result);
		}
		echo $result; exit;
    }
    if(isset($_POST['draw'])){
        $draw = trim($_POST['draw']);

        $search_text = ""; $from_date = ""; $to_date = ""; $from_branch_filter = ""; $to_branch_filter = "";
        if(isset($_POST['start'])) {
            $row = trim($_POST['start']);
        }
        if(isset($_POST['length'])) {
            $rowperpage = trim($_POST['length']);
        }
        $page_title = "Tripsheet Profit Loss";
        $order_column = "";
        $order_column_index = "";
        $order_direction = "";

        if(isset($_POST['order'][0]['column'])) {
            $order_column_index = intval($_POST['order'][0]['column']);
        }
        if(isset($_POST['order'][0]['dir'])) {
            $order_direction = $_POST['order'][0]['dir'] === 'desc' ? 'DESC' : 'ASC';
        }
        $columns = [
            0 => '',
            1 => 'from_tripsheet_number',
            2 => 'to_tripsheet_number',
            3 => 'vehicle_number',
            4 => 'driver_name',
            5 => ''
        ];
        if(!empty($order_column_index) && isset($columns[$order_column_index])) {
            $order_column = $columns[$order_column_index];
        }
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        $totalRecords = 0; $filteredRecords = 0;
        if(empty($access_error)) {
            $totalRecords = count($obj->getTripsheetProfitLossListRecords($row, $rowperpage, $order_column, $order_direction));
            $filteredRecords = count($obj->getTripsheetProfitLossListRecords('', '', $order_column, $order_direction));
        }

        $data = [];
        $permission_module = $GLOBALS['tripsheet_profit_loss_module'];

        $tripsheet_list = $obj->getTripsheetProfitLossListRecords($row, $rowperpage, $order_column, $order_direction);
        $sno = $row + 1;
        if(empty($access_error)) {
            foreach ($tripsheet_list as $val) {
                $from_tripsheet_number = ""; $to_tripsheet_number = ""; $vehicle_number = ""; $driver_name = ""; $tripsheet_status = "";

                if(!empty($val['from_tripsheet_number']) && $val['from_tripsheet_number'] != $GLOBALS['null_value']) {
                    $from_tripsheet_number = $val['from_tripsheet_number'];
                }
                if(!empty($val['to_tripsheet_number']) && $val['to_tripsheet_number'] != $GLOBALS['null_value']) {
                    $to_tripsheet_number = $val['to_tripsheet_number'];
                }
                if(!empty($val['vehicle_number']) && $val['vehicle_number'] != $GLOBALS['null_value']) {
                    $vehicle_number = $obj->encode_decode('decrypt', $val['vehicle_number']);
                }
                if(!empty($val['driver_name']) && $val['driver_name'] != $GLOBALS['null_value']) {
                    $driver_name = $obj->encode_decode('decrypt', $val['driver_name']);
                }
                if(!empty($val['tripsheet_status']) && $val['tripsheet_status'] != $GLOBALS['null_value']) {
                    $tripsheet_status = explode(',',$val['tripsheet_status']);
                }
                $cooly = ""; $overall = ""; $freight = ""; $delivery = "";
                $icon = "";
                  $icon = '<i class="bi bi-check-circle-fill text-success fs-4"></i>'; 

                if (!empty($tripsheet_status)) {
                    if (in_array('D', $tripsheet_status)) {
                        $delivery = $icon;
                    }
                    if (in_array('F', $tripsheet_status)) {
                        $freight = $icon;
                    }
                    if (in_array('O', $tripsheet_status)) {
                        $overall = $icon;
                    }
                    if (in_array('C', $tripsheet_status)) {
                        $cooly = $icon;
                    }
                }
                $action = ""; $edit_option = ""; $delete_option = ""; $print_option = "";
                /*
                $print_option = '<a class="dropdown-item pr-2" target="_blank" href="reports/rpt_tripsheet.php?view_tripsheet_id='.$val['tripsheet_id'].'"><i class="fa fa-print"></i>&ensp; Print Overall</a><a class="dropdown-item pr-2" target="_blank" href="reports/rpt_tripsheet_branchwise.php?view_tripsheet_id='.$val['tripsheet_id'].'"><i class="fa fa-print"></i>&ensp; Print Branchwise</a>';
                */
                $print_option = '<a class="dropdown-item pr-2" target="_blank" href="reports/rpt_tripsheet_profit_loss.php?view_tripsheet_profit_loss_id='.$val['tripsheet_profit_loss_id'].'"><i class="fa fa-print"></i>&ensp; Print</a>';
                
                $access_error = "";
                if(!empty($login_staff_id)) {
                    $permission_action = $edit_action;
                    include('permission_action.php');
                }
                if(empty($access_error)) {
                    $edit_option = '<a class="dropdown-item pr-2" href="Javascript:ShowModalContent('.'\''.$page_title.'\''.', '.'\''.$val['tripsheet_profit_loss_id'].'\''.');"><i class="fa fa-pencil"></i>&ensp; Edit</a>';
                }
                $access_error = "";
                if(!empty($login_staff_id)) {
                    $permission_action = $delete_action;
                    include('permission_action.php');
                }
                if(empty($access_error)) {
                    $delete_option = '<a class="dropdown-item pr-2" href="Javascript:DeleteModalContent('.'\''.$page_title.'\''.', '.'\''.$val['tripsheet_profit_loss_id'].'\''.');"><i class="fa fa-trash"></i>&ensp; Delete</a>';
                }
                $action = '<div class="dropdown">
                                <a class="btn btn-dark poppins px-3" href="#" role="button" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v text-white"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                '.$print_option.$edit_option.$delete_option.'
                                </div>
                            </div>';

                $data[] = [
                    "sno" => $sno++,
                    "from_tripsheet_number" => $from_tripsheet_number,
                    "to_tripsheet_number" => $to_tripsheet_number,
                    "vehicle_number" => $vehicle_number,
                    "driver_name" => $driver_name,
                    "delivery" => $delivery,
                    "freight" => $freight,
                    "cooly" => $cooly,
                    "overall" => $overall,
                    "action" => $action
                ];
            }
        }

        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ];

        echo json_encode($response);
    }
    if(isset($_REQUEST['delete_tripsheet_profit_loss_id'])) {
		$delete_tripsheet_profit_loss_id = $_REQUEST['delete_tripsheet_profit_loss_id'];
        
		$msg = "";
		if(!empty($delete_tripsheet_profit_loss_id)) {	
			$tripsheet_unique_id = "";
			$tripsheet_unique_id = $obj->getTableColumnValue($GLOBALS['tripsheet_profit_loss_table'], 'tripsheet_profit_loss_id', $delete_tripsheet_profit_loss_id, 'id');

            if(preg_match("/^\d+$/", $tripsheet_unique_id)) {
            	$action = "";
                $action = "Tripsheet Profit Loss Deleted.";

                $null_value = $GLOBALS['null_value'];

            	$columns = array(); $values = array();          		
            	$columns = array('deleted');
            	$values = array("'1'");
            	$msg = $obj->UpdateSQL($GLOBALS['tripsheet_profit_loss_table'], $tripsheet_unique_id, $columns, $values, $action);
            }
		}
		echo $msg;
		exit;	
	}
    if(isset($_REQUEST['get_tripsheet_no'])) {
        $vehicle_id = trim($_REQUEST['get_tripsheet_no']);

        $tripsheet_list = array();
        $tripsheet_list = $obj->getTripsheetListForProfitLoss($vehicle_id);

        ?>
        <option value="">Select</option>
        <?php
        if(!empty($tripsheet_list)) {
            foreach($tripsheet_list as $data) {
                if(!empty($data['tripsheet_id']) && $data['tripsheet_id'] != $GLOBALS['null_value']) {
                    ?>
                    <option value="<?php echo $data['tripsheet_id']; ?>">
                        <?php
                            if(!empty($data['tripsheet_number']) && $data['tripsheet_number'] != $GLOBALS['null_value']) {
                                echo $data['tripsheet_number'];
                            }
                        ?>
                    </option>
                    <?php
                }
            }
        }
    }
    if(isset($_REQUEST['get_to_tripsheet'])) {
        $vehicle_id = trim($_REQUEST['get_to_tripsheet']);
        $from_tripsheet_id = "";
        if(isset($_REQUEST['from_tripsheet_id_list'])) {
            $from_tripsheet_id = trim($_REQUEST['from_tripsheet_id_list']);
        }
        $tripsheet_list = array();
        $tripsheet_list = $obj->getTripsheetListForProfitLoss($vehicle_id);

        ?>
        <option value="">Select</option>
        <?php
        if(!empty($tripsheet_list) && !empty($from_tripsheet_id)) {
            foreach($tripsheet_list as $data) {
                if(!empty($data['tripsheet_id']) && $data['tripsheet_id'] != $GLOBALS['null_value'] && $data['tripsheet_id'] != $from_tripsheet_id) {
                    ?>
                    <option value="<?php echo $data['tripsheet_id']; ?>">
                        <?php
                            if(!empty($data['tripsheet_number']) && $data['tripsheet_number'] != $GLOBALS['null_value']) {
                                echo $data['tripsheet_number'];
                            }
                        ?>
                    </option>
                    <?php
                }
            }
        }
    }
    if(isset($_REQUEST['get_from_id_row'])) {
        $from_tripsheet_id = trim($_REQUEST['get_from_id_row']);

        $to_tripsheet_id = "";
        if(isset($_REQUEST['get_to_id_row'])) {
            $to_tripsheet_id = trim($_REQUEST['get_to_id_row']);
        }

        $from_tripsheet_list = array();
        $from_tripsheet_list = $obj->getTableRecords($GLOBALS['tripsheet_table'], 'tripsheet_id', $from_tripsheet_id);
        if(!empty($from_tripsheet_list)) {
            foreach($from_tripsheet_list as $data) {
                ?>
                <tr>
                    <th>
                        <?php
                            if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") {
                                echo date('d-m-Y', strtotime($data['tripsheet_date']));
                            }
                        ?>
                        <input type="hidden" name="from_tripsheet_date" value="<?php if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") { echo $data['tripsheet_date']; } ?>">
                        <input type="hidden" name="from_tripsheet_id" value="<?php if(!empty($data['tripsheet_id']) && $data['tripsheet_id'] != $GLOBALS['null_value']) { echo $data['tripsheet_id']; } ?>">
                    </th>
                    <th>
                        <?php
                            $from_branch_name = "";
                            if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) {
                                $from_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $data['from_branch_id'], 'name');
                                if(!empty($from_branch_name) && $from_branch_name != $GLOBALS['null_value']) {
                                    echo $obj->encode_decode('decrypt', $from_branch_name);
                                }
                            }
                            echo ' To ';
                            $destination_branch_name = "";
                            if(!empty($data['destination_branch_id']) && $data['destination_branch_id'] != $GLOBALS['null_value']) {
                                $destination_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $data['destination_branch_id'], 'name');
                                if(!empty($destination_branch_name) && $destination_branch_name != $GLOBALS['null_value']) {
                                    echo $obj->encode_decode('decrypt', $destination_branch_name);
                                }
                            }
                        ?>
                        <input type="hidden" name="from_tripsheet_from_branch" value="<?php if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) { echo $data['from_branch_id']; } ?>">
                        <input type="hidden" name="from_tripsheet_to_branch" value="<?php if(!empty($data['destination_branch_id']) && $data['destination_branch_id'] != $GLOBALS['null_value']) { echo $data['destination_branch_id']; } ?>">
                    </th>
                    <th>
                        <?php
                            $quantity = array(); $total_qty = 0;
                            if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                                $quantity = explode("$$$", $data['quantity']);
                                if(!empty($quantity)) {
                                    for($i=0; $i < count($quantity); $i++) {
                                        $qty_array = array();
                                        $qty_array = explode(",", $quantity[$i]);
                                        if(!empty($qty_array)) {
                                            for($j=0; $j < count($qty_array); $j++) {
                                                if(!empty($qty_array[$j])) {
                                                    $total_qty += $qty_array[$j];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            echo $total_qty;
                        ?>
                        <input type="hidden" name="from_tripsheet_quantity" value="<?php echo $total_qty; ?>">
                    </th>
                    <th>
                        <?php
                            $weight = array(); $total_weight = 0;
                            if(!empty($data['weight']) && $data['weight'] != $GLOBALS['null_value']) {
                                $weight = explode("$$$", $data['weight']);
                                if(!empty($weight)) {
                                    for($i=0; $i < count($weight); $i++) {
                                        $weight_array = array();
                                        $weight_array = explode(",", $weight[$i]);
                                        if(!empty($weight_array)) {
                                            for($j=0; $j < count($weight_array); $j++) {
                                                if(!empty($weight_array[$j])) {
                                                    $total_weight += $weight_array[$j];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            echo $total_weight;
                        ?>
                        <input type="hidden" name="from_tripsheet_weight" value="<?php echo $total_weight; ?>">
                    </th>
                    <th>
                        <?php 
                              $total_amount_array = array(); $total_amount = 0;
                            if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                                $total_amount_array = explode("$$$", $data['total_amount']);
                                if(!empty($total_amount_array)) {
                                    for($k=0; $k < count($total_amount_array); $k++) {
                                        if(!empty($total_amount_array[$k])) {
                                            $total_amount += $total_amount_array[$k];
                                        }
                                    }
                                }

                            }
                        ?>
                        <div class="form-group mb-0">
                            <div class="form-label-group in-border">
                                <input type="text" name="from_tripsheet_rent" class="form-control shadow-none" value="<?php if(!empty($total_amount) && $total_amount != $GLOBALS['null_value']) { echo $total_amount; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                            </div>
                        </div>
                    </th>
                </tr>
                <?php
            }
        }
        $to_tripsheet_list = array();
        $to_tripsheet_list = $obj->getTableRecords($GLOBALS['tripsheet_table'], 'tripsheet_id', $to_tripsheet_id);
        if(!empty($to_tripsheet_list)) {
            foreach($to_tripsheet_list as $data) {
                ?>
                <tr>
                    <th>
                        <?php
                            if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") {
                                echo date('d-m-Y', strtotime($data['tripsheet_date']));
                            }
                        ?>
                        <input type="hidden" name="to_tripsheet_date" value="<?php if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") { echo $data['tripsheet_date']; } ?>">
                        <input type="hidden" name="to_tripsheet_id" value="<?php if(!empty($data['tripsheet_id']) && $data['tripsheet_id'] != $GLOBALS['null_value']) { echo $data['tripsheet_id']; } ?>">
                    </th>
                    <th>
                        <?php
                            $from_branch_name = "";
                            if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) {
                                $from_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $data['from_branch_id'], 'name');
                                if(!empty($from_branch_name) && $from_branch_name != $GLOBALS['null_value']) {
                                    echo $obj->encode_decode('decrypt', $from_branch_name);
                                }
                            }
                            echo ' To ';
                            $destination_branch_name = "";
                            if(!empty($data['destination_branch_id']) && $data['destination_branch_id'] != $GLOBALS['null_value']) {
                                $destination_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $data['destination_branch_id'], 'name');
                                if(!empty($destination_branch_name) && $destination_branch_name != $GLOBALS['null_value']) {
                                    echo $obj->encode_decode('decrypt', $destination_branch_name);
                                }
                            }
                        ?>
                        <input type="hidden" name="to_tripsheet_from_branch" value="<?php if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) { echo $data['from_branch_id']; } ?>">
                        <input type="hidden" name="to_tripsheet_to_branch" value="<?php if(!empty($data['destination_branch_id']) && $data['destination_branch_id'] != $GLOBALS['null_value']) { echo $data['destination_branch_id']; } ?>">
                    </th>
                    <th>
                        <?php
                            $quantity = array(); $total_qty = 0;
                            if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                                $quantity = explode("$$$", $data['quantity']);
                                if(!empty($quantity)) {
                                    for($i=0; $i < count($quantity); $i++) {
                                        $qty_array = array();
                                        $qty_array = explode(",", $quantity[$i]);
                                        if(!empty($qty_array)) {
                                            for($j=0; $j < count($qty_array); $j++) {
                                                if(!empty($qty_array[$j])) {
                                                    $total_qty += $qty_array[$j];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            echo $total_qty;
                        ?>
                        <input type="hidden" name="to_tripsheet_quantity" value="<?php echo $total_qty; ?>">
                    </th>
                    <th>
                        <?php
                            $weight = array(); $total_weight = 0;
                            if(!empty($data['weight']) && $data['weight'] != $GLOBALS['null_value']) {
                                $weight = explode("$$$", $data['weight']);
                                if(!empty($weight)) {
                                    for($i=0; $i < count($weight); $i++) {
                                        $weight_array = array();
                                        $weight_array = explode(",", $weight[$i]);
                                        if(!empty($weight_array)) {
                                            for($j=0; $j < count($weight_array); $j++) {
                                                if(!empty($weight_array[$j])) {
                                                    $total_weight += $weight_array[$j];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            echo $total_weight;
                        ?>
                        <input type="hidden" name="to_tripsheet_weight" value="<?php echo $total_weight; ?>">
                    </th>
                    <th>
                            <?php 
                              $total_amount_array = array(); $total_amount = 0;
                            if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                                $total_amount_array = explode("$$$", $data['total_amount']);
                                if(!empty($total_amount_array)) {
                                    for($k=0; $k < count($total_amount_array); $k++) {
                                        if(!empty($total_amount_array[$k])) {
                                            $total_amount += $total_amount_array[$k];
                                        }
                                    }
                                }

                            }
                        ?>
                        <div class="form-group mb-0">
                            <div class="form-label-group in-border">
                                <input type="text" name="to_tripsheet_rent" class="form-control shadow-none" value="<?php if(!empty($total_amount) && $total_amount != $GLOBALS['null_value']) { echo $total_amount; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                            </div>
                        </div>
                    </th>
                </tr>
                <?php
            }
        }
        if(!empty($from_tripsheet_id) && !empty($to_tripsheet_id)) {
            ?>
            <tr>
                <th colspan="4" class="text-right">மொத்த வாடகை :</th>
                <th>
                    <span class="total_rent"></span>
                </th>
            </tr>
            <?php
        }
    }
    if(isset($_REQUEST['add_expense_row']) && $_REQUEST['add_expense_row'] == '1') {
        ?>
        <tr class="expense_row">
            <th style="width:65%!important;">
                <div class="form-group mb-0">
                    <div class="form-label-group in-border">
                        <input type="text" name="expense_name[]" class="form-control shadow-none" value="" style="min-width:100px!important;">
                        <span class="d-none sno"></span>
                    </div>
                </div>
            </th>
            <th style="width:25%!important;">
                <div class="form-group mb-0">
                    <div class="form-label-group in-border">
                        <input type="text" name="expense_value[]" class="form-control shadow-none" value="" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                    </div>
                </div>
            </th>
            <th style="width:10%!important;">
                <button type="button" class="btn btn-danger" style="font-size:11px;" onclick="Javascript:DeleteDriverExpenseRow(this);"><i class="fa fa-times"></i></button>
            </th>
        </tr>
        <?php
    }

    if(isset($_REQUEST['add_company_expense_row']) && $_REQUEST['add_company_expense_row'] == '1') {
        ?>
        <tr class="company_expense_row">
            <th style="width:65%!important;">
                <div class="form-group mb-0">
                    <div class="form-label-group in-border">
                        <input type="text" name="company_expense_name[]" class="form-control shadow-none" value="" style="min-width:100px!important;">
                        <span class="d-none company_sno"></span>
                    </div>
                </div>
            </th>
            <th style="width:25%!important;">
                <div class="form-group mb-0">
                    <div class="form-label-group in-border">
                        <input type="text" name="company_expense_value[]" class="form-control shadow-none" value="" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                    </div>
                </div>
            </th>
            <th style="width:10%!important;">
                <button type="button" class="btn btn-danger" style="font-size:11px;" onclick="Javascript:DeleteCompanyExpenseRow(this);"><i class="fa fa-times"></i></button>
            </th>
        </tr>
        <?php
    }
?>