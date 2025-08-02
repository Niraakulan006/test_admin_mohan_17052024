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

        $trip_number = ""; $vehicle_id = ""; $driver_name = ""; $from_tripsheet_id = ""; $to_tripsheet_id = "";
        $from_tripsheet_date = ""; $to_tripsheet_date = ""; $from_tripsheet_number = ""; $to_tripsheet_number = "";
        $from_tripsheet_from_branch = ""; $from_tripsheet_to_branch = ""; $to_tripsheet_from_branch = ""; $to_tripsheet_to_branch = "";
        $from_tripsheet_quantity = ""; $from_tripsheet_weight = ""; $to_tripsheet_quantity = ""; $to_tripsheet_weight = "";
        $from_tripsheet_rent = ""; $to_tripsheet_rent = ""; $total_rent = ""; $trip_cost = ""; $balance = ""; $loading_wage = ""; 
        $night_food = ""; $driver_salary = ""; $tire_depreciation = "";
        $toll_gate = ""; $net_balance = ""; $starting_km = ""; $ending_km = ""; $travelled_km = ""; $diesel = ""; $mileage = ""; 
        $trip_balance = ""; $advance = ""; $diesel_cost = ""; $diesel_cost_per_litre = ""; $expense_names = array(); 
        $expense_values = array();

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
            }
        }

        $vehicle_list = array();
        $vehicle_list = $obj->getTableRecords($GLOBALS['vehicle_table'], '', '');

        $tripsheet_from_list = array();
        $tripsheet_from_list = $obj->getTripsheetListForProfitLoss($vehicle_id);
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
            <div class="row mx-0 p-2 justify-content-center <?php if(empty($show_tripsheet_profit_loss_id)) { ?>d-none<?php } ?> trip_details_div">
                <div class="table-responsive col-lg-4 col-md-6 col-12 py-1">
                    <table class="table table-nowrap table-bordered border nowrap smallfnt cursor text-center w-100 trip_distance_table">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    கம்பெனி செலவுகள்
                                    <button type="button" class="btn btn-primary rounded ml-5" style="font-size:11px;" onclick="Javascript:AddExpenseRow();"><i class="fa fa-plus"></i>&ensp;Add</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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
                                            <input type="text" name="ending_km" class="form-control shadow-none" value="<?php if(!empty($ending_km)) { echo $ending_km; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
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
                                            <input type="text" name="diesel" class="form-control shadow-none" value="<?php if(!empty($diesel)) { echo $diesel; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
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
                                            <input type="text" name="diesel_cost_per_litre" class="form-control shadow-none" value="<?php if(!empty($diesel_cost_per_litre)) { echo $diesel_cost_per_litre; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive col-lg-4 col-md-6 col-12 py-1">
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
                                        <button type="button" class="btn btn-danger" style="font-size:11px;" onclick="Javascript:DeleteExpenseRow(this);"><i class="fa fa-times"></i></button>
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
                                        <button type="button" class="btn btn-danger" style="font-size:11px;" onclick="Javascript:DeleteExpenseRow(this);"><i class="fa fa-times"></i></button>
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
                                                    <button type="button" class="btn btn-danger" style="font-size:11px;" onclick="Javascript:DeleteExpenseRow(this);"><i class="fa fa-times"></i></button>
                                                </th>
                                            </tr>
                                            <?php
                                        }
                                    }
                                } 
                            ?>
                            <tr class="expense_total">
                                <th style="width:65%!important;">
                                    டீசல் செலவு
                                </th>
                                <th style="width:25%!important;">
                                    <span class="diesel_cost"><?php if(!empty($diesel_cost)) { echo $diesel_cost; } ?></span>
                                    <input type="hidden" name="diesel_cost" value="<?php if(!empty($diesel_cost)) { echo $diesel_cost; } ?>">
                                </th>
                                <th style="width:10%!important;">
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
                <div class="table-responsive col-lg-4 col-md-6 col-12 py-1">
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
                        </tbody>
                    </table>
                    <table class="table table-nowrap table-bordered border nowrap smallfnt cursor text-center w-100 trip_distance_table">
                    </table>

                </div>
            </div>
            <div class="col-md-12 pt-3 text-center">
                <button class="btn btn-dark btnwidth submit_button" type="button" onClick="Javascript:SaveModalContent('tripsheet_profit_loss_form', 'tripsheet_profit_loss_changes.php', 'tripsheet_profit_loss.php');">Submit</button>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
            <script type="text/javascript">
                ProfitLossTotal();
            </script>
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
        $toll_gate = ""; $toll_gate_error = ""; $net_balance = ""; $starting_km = ""; $starting_km_error = ""; $ending_km = ""; $ending_km_error = ""; $travelled_km = ""; $diesel = ""; $diesel_error = ""; $mileage = ""; 
        $trip_balance = ""; $advance = ""; $advance_error = ""; $diesel_cost = ""; $diesel_cost_per_litre = ""; 
        $diesel_cost_per_litre_error = ""; $expense_names = array(); $expense_values = array(); $expense_error = "";
        $edit_id = ""; $form_name = "tripsheet_profit_loss_form"; $valid_tripsheet_profit_loss = "";

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
        if(isset($_POST['trip_balance'])) {
            $trip_balance = trim($_POST['trip_balance']);
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
        if(isset($_POST['diesel_cost'])) {
            $diesel_cost = trim($_POST['diesel_cost']);
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
        if(empty($valid_tripsheet_profit_loss) && empty($expense_error)) {
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
                if(!empty(array_filter($expense_names, fn($value) => $value !== ""))) {
                    $expense_names = implode(",", $expense_names);
                }
                else {
                    $expense_names = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($expense_values, fn($value) => $value !== ""))) {
                    $expense_values = implode(",", $expense_values);
                }
                else {
                    $expense_values = $GLOBALS['null_value'];
                }

				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']); $bill_company_id = $GLOBALS['bill_company_id'];
                $tripsheet_profit_loss_id = "";
				if(empty($edit_id)) {			
                    $action = "";
                    $action = "New Tripsheet Profit Loss Created.";

                    $null_value = $GLOBALS['null_value'];
                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'tripsheet_profit_loss_id', 'trip_number', 'vehicle_id', 'vehicle_number', 'driver_name', 'from_tripsheet_date', 'from_tripsheet_id', 'from_tripsheet_number', 'from_tripsheet_from_branch', 'from_tripsheet_to_branch', 'from_tripsheet_quantity', 'from_tripsheet_weight', 'from_tripsheet_rent', 'to_tripsheet_date', 'to_tripsheet_id', 'to_tripsheet_number', 'to_tripsheet_from_branch', 'to_tripsheet_to_branch', 'to_tripsheet_quantity', 'to_tripsheet_weight', 'to_tripsheet_rent', 'total_rent', 'trip_cost', 'balance', 'loading_wage', 'night_food', 'driver_salary', 'tire_depreciation', 'toll_gate', 'net_balance', 'starting_km', 'ending_km', 'travelled_km', 'diesel', 'mileage', 'trip_balance', 'advance', 'diesel_cost', 'diesel_cost_per_litre', 'expense_name', 'expense_value', 'deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$null_value."'", "'".$trip_number."'", "'".$vehicle_id."'", "'".$vehicle_number."'", "'".$driver_name."'", "'".$from_tripsheet_date."'", "'".$from_tripsheet_id."'", "'".$from_tripsheet_number."'", "'".$from_tripsheet_from_branch."'", "'".$from_tripsheet_to_branch."'", "'".$from_tripsheet_quantity."'", "'".$from_tripsheet_weight."'", "'".$from_tripsheet_rent."'", "'".$to_tripsheet_date."'", "'".$to_tripsheet_id."'", "'".$to_tripsheet_number."'", "'".$to_tripsheet_from_branch."'", "'".$to_tripsheet_to_branch."'", "'".$to_tripsheet_quantity."'", "'".$to_tripsheet_weight."'", "'".$to_tripsheet_rent."'", "'".$total_rent."'", "'".$trip_cost."'", "'".$balance."'", "'".$loading_wage."'", "'".$night_food."'", "'".$driver_salary."'", "'".$tire_depreciation."'", "'".$toll_gate."'", "'".$net_balance."'", "'".$starting_km."'", "'".$ending_km."'", "'".$travelled_km."'", "'".$diesel."'", "'".$mileage."'", "'".$trip_balance."'", "'".$advance."'", "'".$diesel_cost."'", "'".$diesel_cost_per_litre."'", "'".$expense_names."'", "'".$expense_values."'", "'0'");

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
				}
				else {
                    $getUniqueID = "";
                    $getUniqueID = $obj->getTableColumnValue($GLOBALS['tripsheet_profit_loss_table'], 'tripsheet_profit_loss_id', $edit_id, 'id');
                    if(preg_match("/^\d+$/", $getUniqueID)) {
                        $action = "";
                        $action = "Tripsheet Profit Loss Updated";
                    
                        $columns = array(); $values = array();
                        $columns = array('creator_name', 'trip_number', 'vehicle_id', 'vehicle_number', 'driver_name', 'from_tripsheet_date', 'from_tripsheet_id', 'from_tripsheet_number', 'from_tripsheet_from_branch', 'from_tripsheet_to_branch', 'from_tripsheet_quantity', 'from_tripsheet_weight', 'from_tripsheet_rent', 'to_tripsheet_date', 'to_tripsheet_id', 'to_tripsheet_number', 'to_tripsheet_from_branch', 'to_tripsheet_to_branch', 'to_tripsheet_quantity', 'to_tripsheet_weight', 'to_tripsheet_rent', 'total_rent', 'trip_cost', 'balance', 'loading_wage', 'night_food', 'driver_salary', 'tire_depreciation', 'toll_gate', 'net_balance', 'starting_km', 'ending_km', 'travelled_km', 'diesel', 'mileage', 'trip_balance', 'advance', 'diesel_cost', 'diesel_cost_per_litre', 'expense_name', 'expense_value');
                        $values = array("'".$creator_name."'", "'".$trip_number."'", "'".$vehicle_id."'", "'".$vehicle_number."'", "'".$driver_name."'", "'".$from_tripsheet_date."'", "'".$from_tripsheet_id."'", "'".$from_tripsheet_number."'", "'".$from_tripsheet_from_branch."'", "'".$from_tripsheet_to_branch."'", "'".$from_tripsheet_quantity."'", "'".$from_tripsheet_weight."'", "'".$from_tripsheet_rent."'", "'".$to_tripsheet_date."'", "'".$to_tripsheet_id."'", "'".$to_tripsheet_number."'", "'".$to_tripsheet_from_branch."'", "'".$to_tripsheet_to_branch."'", "'".$to_tripsheet_quantity."'", "'".$to_tripsheet_weight."'", "'".$to_tripsheet_rent."'", "'".$total_rent."'", "'".$trip_cost."'", "'".$balance."'", "'".$loading_wage."'", "'".$night_food."'", "'".$driver_salary."'", "'".$tire_depreciation."'", "'".$toll_gate."'", "'".$net_balance."'", "'".$starting_km."'", "'".$ending_km."'", "'".$travelled_km."'", "'".$diesel."'", "'".$mileage."'", "'".$trip_balance."'", "'".$advance."'", "'".$diesel_cost."'", "'".$diesel_cost_per_litre."'", "'".$expense_names."'", "'".$expense_values."'");
                        
                        $profit_loss_update_id = $obj->UpdateSQL($GLOBALS['tripsheet_profit_loss_table'], $getUniqueID, $columns, $values, $action);
                        if(preg_match("/^\d+$/", $profit_loss_update_id)) {	
                            $result = array('number' => '1', 'msg' => 'Updated Successfully');				
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $profit_loss_update_id);
                        }							
                    }
				}
			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_tripsheet_profit_loss)) {
				$result = array('number' => '3', 'msg' => $valid_tripsheet_profit_loss);
			}
            if(!empty($expense_error)) {
				$result = array('number' => '2', 'msg' => $expense_error);
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
                $from_tripsheet_number = ""; $to_tripsheet_number = ""; $vehicle_number = ""; $driver_name = "";

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
                <button type="button" class="btn btn-danger" style="font-size:11px;" onclick="Javascript:DeleteExpenseRow(this);"><i class="fa fa-times"></i></button>
            </th>
        </tr>
        <?php
    }
?>