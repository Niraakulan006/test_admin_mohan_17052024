<?php
	include("include_files.php");
    $login_staff_id = "";
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
			$login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			$permission_module = $GLOBALS['tripsheet_module'];
		}
	}
    
	if(isset($_REQUEST['show_tripsheet_id'])) { 
        $show_tripsheet_id = $_REQUEST['show_tripsheet_id'];

        $tripsheet_date = date("Y-m-d");

        $tripsheet_date = "";
        $tripsheet_date = $obj->getTableColumnValue($GLOBALS['organization_table'],'id','1','lr_starting_date');
        if(!empty($tripsheet_date) && $tripsheet_date == $GLOBALS['default_date']) {
            $tripsheet_date = "";
        }

        $reference_number = ""; $vehicle_id = ""; $from_branch_id = ""; $to_branch_id = array(); $driver_name = ""; $driver_number = ""; $helper_name = ""; $branch_id =""; $lr_ids = array(); $luggage_ids = array();  $to_branch_ids = array();
        $lr_dates = array(); $lr_numbers = array(); $from_branch_lr_ids = array(); $to_branch_lr_ids = array(); $consignor_ids = array();
        $consignee_ids = array(); $quantity_values = array(); $weight_values = array(); $unit_ids = array(); $price_per_qty_values = array();
        $total_values = array(); $bill_types = array(); $destination_branch_id = "";

        $tripsheet_list = array();
        $tripsheet_list = $obj->getTableRecords($GLOBALS['tripsheet_table'], 'tripsheet_id', $show_tripsheet_id);
        if(!empty($tripsheet_list)) {
            foreach($tripsheet_list as $data) {
                if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") {
                    $tripsheet_date = date('Y-m-d', strtotime($data['tripsheet_date']));
                }
                if(!empty($data['reference_number']) && $data['reference_number'] != $GLOBALS['null_value']) {
                    $reference_number = $obj->encode_decode('decrypt', $data['reference_number']);
                }
                if(!empty($data['vehicle_id']) && $data['vehicle_id'] != $GLOBALS['null_value']) {
                    $vehicle_id = $data['vehicle_id'];
                }
                if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) {
                    $from_branch_id = $data['from_branch_id'];
                }
                if(!empty($data['to_branch_id']) && $data['to_branch_id'] != $GLOBALS['null_value']) {
                    $to_branch_id = explode(',', $data['to_branch_id']);
                }
                if(!empty($data['to_branch_id']) && $data['to_branch_id'] != $GLOBALS['null_value']) {
                    $to_branch_ids = $data['to_branch_id'];
                }
                
                if(!empty($data['destination_branch_id']) && $data['destination_branch_id'] != $GLOBALS['null_value']) {
                    $destination_branch_id = $data['destination_branch_id'];
                }
                if(!empty($data['driver_name']) && $data['driver_name'] != $GLOBALS['null_value']) {
                    $driver_name = $data['driver_name'];
                }
                if(!empty($data['driver_number']) && $data['driver_number'] != $GLOBALS['null_value']) {
                    $driver_number = $obj->encode_decode('decrypt', $data['driver_number']);
                }
                if(!empty($data['helper_name']) && $data['helper_name'] != $GLOBALS['null_value']) {
                    $helper_name = $obj->encode_decode('decrypt', $data['helper_name']);
                }
                if(!empty($data['lr_id']) && $data['lr_id'] != $GLOBALS['null_value']) {
                    $lr_ids = explode(",", $data['lr_id']);
                }
                if(!empty($data['luggage_id']) && $data['luggage_id'] != $GLOBALS['null_value']) {
                    $luggage_ids = explode(",",$data['luggage_id']);
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
        }

        $branch_list = array();
        $branch_list = $obj->getTableRecords($GLOBALS['branch_table'],'','');
        $vehicle_list = array();
        $vehicle_list = $obj->getTableRecords($GLOBALS['vehicle_table'],'','');
        $driver_list = array();
        $driver_list = $obj->getTableRecords($GLOBALS['driver_table'],'','');

        $to_branch_list = array();
        if(!empty($from_branch_id)) {
            $to_branch_list = $obj->ToBranchList($from_branch_id);
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
        ?>
        <form class="poppins pd-20 redirection_form" name="tripsheet_form" method="POST">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
                        <?php if(!empty($show_tripsheet_id)) { ?>
                            <h5 class="text-white">Edit TripSheet</h5>
                        <?php } else { ?>
                            <h5 class="text-white">Add TripSheet</h5>
                        <?php } ?>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('tripsheet.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
			<div class="row mx-0 p-2">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_tripsheet_id)) { echo $show_tripsheet_id; } ?>">
                <div class="col-lg-2 col-md-4 col-6 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" id="tripsheet_date" name="tripsheet_date" value="<?php if(!empty($tripsheet_date)){ echo $tripsheet_date; }?>" class="form-control shadow-none" placeholder="">
                            <label>Date <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" name="reference_number" value="<?php if(!empty($reference_number)){ echo $reference_number; }?>" class="form-control shadow-none" placeholder="">
                            <label>Ref.Number</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="form-control shadow-none" name="vehicle_id" onchange="vehicleDetails(this.value)">
                                <option value="">Select Vehicle</option>
                                <?php
                                    if(!empty($vehicle_list)) {
                                        foreach($vehicle_list as $data) { ?>
                                            <option value="<?php if(!empty($data['vehicle_id'])) { echo $data['vehicle_id']; } ?>" <?php if(!empty($vehicle_id) && $data['vehicle_id'] == $vehicle_id){ ?>selected<?php } ?>>
                                                <?php
                                                    if(!empty($data['vehicle_number']) && $data['vehicle_number'] != $GLOBALS['null_value']) {
                                                        if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                            echo $obj->encode_decode('decrypt', $data['name'])." - ";
                                                        }
                                                        $data['vehicle_number'] = $obj->encode_decode('decrypt', $data['vehicle_number']);
                                                        echo $data['vehicle_number'];
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                            <label>Vehicle</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="border mb-2 d-none">
                            <div class="p-2 vehicle_preview">
                                <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">Vehicle Details</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border" <?php if(!empty($show_tripsheet_id)) { ?>style="pointer-events:none;"<?php } ?>>
                            <select name="from_branch_id" class="form-control shadow-none" onchange="Javascript:GetMultipleBranch(this.value);">
                                <option value="">Select Branch</option>
                                <?php
                                    $branch_count = 0;
                                    if(!empty($branch_list)) {
                                        foreach($branch_list as $data) {
                                            if(!empty($login_branch_id)) {
                                                if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value'] && in_array($data['branch_id'], $login_branch_id)) {
                                                    $branch_count++;
                                                    ?>
                                                    <option value="<?php echo $data['branch_id']; ?>" <?php if((!empty($from_branch_id) && $from_branch_id == $data['branch_id']) || (count($login_branch_id) == '1')) { ?>selected<?php } ?>>
                                                        <?php
                                                            if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                                echo $obj->encode_decode('decrypt', $data['name']);
                                                            }
                                                        ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            else if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value']) {
                                                $branch_count++;
                                                ?>
                                                <option value="<?php echo $data['branch_id']; ?>" <?php if(!empty($from_branch_id) && $from_branch_id == $data['branch_id']) { ?>selected<?php } ?>>
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
                                ?>
                            </select>
                            <label>From Branch <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    <?php if(empty($show_tripsheet_id) && $branch_count == '1') { ?>
                        if(jQuery('select[name="from_branch_id"]').length > 0) {
                            jQuery('select[name="from_branch_id"]').trigger('change');
                        }
                    <?php } ?>
                </script>
                <div class="col-lg-3 col-md-6 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="to_branch_id[]" class="form-control shadow-none" multiple onchange="Javascript:getLRList();removedToBranchLR();">
                                <?php
                                    if(!empty($to_branch_list)) {
                                        foreach($to_branch_list as $data) {
                                            if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['branch_id']; ?>" <?php if(!empty($to_branch_id) && (in_array($data['branch_id'], $to_branch_id))) { ?>selected<?php } ?>>
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
                                ?>
                            </select>
                            <label>To Branch <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="destination_branch_id" class="form-control shadow-none">
                                <option value="">Select</option>
                                <?php
                                    if(!empty($to_branch_list)) {
                                        foreach($to_branch_list as $data) {
                                            if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value']) {
                                                ?>
                                                <option value="<?php echo $data['branch_id']; ?>" <?php if(!empty($destination_branch_id) &&  $destination_branch_id == $data['branch_id']) { ?>selected<?php } ?>>
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
                                ?>
                            </select>
                            <label>Destination <span class="text-danger">*</span></label>
                        </div> 
                        <div class="new_smallfnt text-center text-primary"><i>Just for Report Purpose (Not for LR selection)</i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select name="driver_name" class="form-control shadow-none" onchange="Javascript:getDriverNo(this.value);" >
                                <option value="">Select name</option>
                                <?php 
                                    if(!empty($driver_list)){
                                        foreach($driver_list as $col) {
                                            ?>
                                            <option value="<?php if(!empty($col['driver_name'])){ echo $col['driver_name']; } ?>" <?php if(!empty($driver_name) && $driver_name == $col['driver_name']){ ?>selected<?php } ?>>
                                                <?php
                                                    if(!empty($col['driver_name']) && $col['driver_name'] != $GLOBALS['null_value']){
                                                        $col['driver_name'] = $obj->encode_decode('decrypt',$col['driver_name']);
                                                        echo $col['driver_name'];
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    } 
                                ?>
                            </select>
                            <label>Driver Name</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="driver_number" name="driver_number" value="<?php if(!empty($driver_number)){ echo $driver_number; } ?>" class="form-control shadow-none" placeholder="">
                            <label>Driver Number</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="helper_name" name="helper_name" value="<?php if(!empty($helper_name)){ echo $helper_name; } ?>" class="form-control shadow-none" placeholder="">
                            <label>Helper Name</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 d-none">
                    <div class="form-label-group in-border pb-2">
                        <div class="input-group mb-3 luggage_list">
                            <select class="form-control" name="luggage_id">
                                <option value="">Luggagesheet No</option>
                                    <?php
                                        if(!empty($luggagesheet_list)) {
                                            foreach($luggagesheet_list as $data) { ?>
                                                <option value="<?php if(!empty($data['luggage_id'])) { echo $data['luggage_id']; } ?>">
                                                    <?php
                                                        if(!empty($data['luggagesheet_number'])) {
                                                            echo $data['luggagesheet_number'];
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    ?>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="button" style="font-size: 11px;" onClick="Javascript:addDetailsLuggage();"><i class="fa fa-plus"></i> Add</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-3 col-md-6 col-12 py-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <div class="input-group mb-3 lr_details">
                                <select class="form-control shadow-none" name="selected_lr_id">
                                    <option value="">Select Lr No</option>
                                        <?php
                                            if(!empty($lr_list)) {
                                                foreach($lr_list as $data) { ?>
                                                    <option value="<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>">
                                                        <?php
                                                            if(!empty($data['lr_number']) && $data['lr_number'] != $GLOBALS['null_value']) {
                                                                echo $data['lr_number'];
                                                            }
                                                        ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </option>
                                </select>
                                <label>LR No</label>
                                
                                <div class="input-group-append">
                                    <button class="btn btn-danger" type="button" style="font-size: 11px;" onClick="Javascript:addDetailsLR();"><i class="fa fa-plus"></i> Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            <div class="table-responsive poppins smallfnt">
                <input type="hidden" name="product_count" value="<?php if(!empty($product_row_index)) { echo $product_row_index; } else { echo "0"; } ?>">
				<style>
					.table td, .table th { border-top: none; }
					.input-group-append .btn, .input-group-prepend .btn { z-index: 0; }
					.tax_cover .select2-container { width: 100px !important; }
					.party_cover .select2-container { width: 80% !important; }
				</style>
                <table class="table nowrap table-bordered text-center bill_products_table">
                    <thead class="bg-pinterest">
                        <tr class="text-white">
                            <th class="text-center px-2 py-2">#</th>
                            <th class="text-center px-2 py-2">Date</th>
                            <th class="text-center px-2 py-2">LR No</th>
                            <th class="text-center px-2 py-2">From Branch</th>
                            <th class="text-center px-2 py-2">To Branch</th>
                            <th class="text-center px-2 py-2">Consignor</th>
                            <th class="text-center px-2 py-2">Consignee</th>
                            <th class="text-center px-2 py-2">Articles Qty / Unit</th>
                            <th class="text-center px-2 py-2">Price/QTY</th>
                            <th class="text-center px-2 py-2">Amount</th>
                            <th class="text-center px-2 py-2">Bill Type</th>
                            <th class="text-center px-2 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($lr_ids)) {
                                for ($i=0; $i < count($lr_ids); $i++) { 
                                    $lr_number = ""; $lr_date = ""; $from_branch_lr_id = ""; $to_branch_lr_id = ""; $consignor_id = "";
                                    $consignee_id = ""; $unit_id = array(); $quantity = array(); $weight = array(); $price_per_qty = ""; $total = ""; $bill_type = "";
                                    $lr_number = $lr_numbers[$i]; $lr_date = $lr_dates[$i]; $from_branch_lr_id = $from_branch_lr_ids[$i];
                                    $to_branch_lr_id = $to_branch_lr_ids[$i]; $consignor_id = $consignor_ids[$i]; $consignee_id = $consignee_ids[$i]; 
                                    if(!empty($quantity_values[$i]) && $quantity_values[$i] != $GLOBALS['null_value']) {
                                        $quantity = explode(',', $quantity_values[$i]);
                                    }
                                    if(!empty($weight_values[$i]) && $weight_values[$i] != $GLOBALS['null_value']) {
                                        $weight = explode(',', $weight_values[$i]);
                                    }
                                    if(!empty($unit_ids[$i]) && $unit_ids[$i] != $GLOBALS['null_value']) {
                                        $unit_id = explode(',', $unit_ids[$i]);
                                    }
                                    $price_per_qty = $price_per_qty_values[$i]; $total = $total_values[$i]; $bill_type = $bill_types[$i];
                                    ?>
                                    <tr class="product_row" id="product_row<?php echo $i+1; ?>">
                                        <th class="text-center px-2 py-2 sno"><?php echo $i+1; ?></th>
                                        <th class="text-center px-2 py-2">
                                            <?php
                                                if(!empty($lr_date)){
                                                    echo date('d-m-Y', strtotime($lr_date));
                                                }
                                            ?>
                                            <input type="hidden" name="lr_id[]" value="<?php echo $lr_ids[$i];?>">
                                        </th>
                                        <th class="text-center px-2 py-2">
                                            <?php
                                                if(!empty($lr_number)) {
                                                    echo $lr_number;
                                                }
                                            ?>
                                            <input type="hidden" name="lr_number[]" value="<?php if(!empty($lr_number)) { echo $lr_number;  } ?>">

                                        </th>
                                        <th class="text-center px-2 py-2">
                                            <?php
                                                $from_branch_name = "";
                                                if(!empty($from_branch_lr_id)) {
                                                    $from_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $from_branch_lr_id, 'name');
                                                    if(!empty($from_branch_name) && $from_branch_name != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $from_branch_name);
                                                    }
                                                }
                                            ?>
                                        </th>
                                        <th class="text-center px-2 py-2">
                                            <?php
                                                $to_branch_name = "";
                                                if(!empty($to_branch_lr_id)) {
                                                    $to_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $to_branch_lr_id, 'name');
                                                    if(!empty($to_branch_name) && $to_branch_name != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode('decrypt', $to_branch_name);
                                                    }
                                                }
                                                
                                            ?>
                                            <input type="hidden" name="prev_to_branch_ids[]" value="<?php if(!empty($to_branch_lr_id)) { echo $to_branch_lr_id; } ?>">

                                        </th>
                                        <th class="text-center px-2 py-2">
                                            <?php
                                                $consignor_name = "";
                                                if(!empty($consignor_id)) {
                                                    $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_id, 'name');
                                                    if(!empty($consignor_name) && $consignor_name != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode("decrypt", $consignor_name);
                                                    }
                                                }
                                            ?>
                                        </th>
                                        <th class="text-center px-2 py-2">
                                            <?php
                                                $consignee_name = "";
                                                if(!empty($consignee_id)) {
                                                    $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_id, 'name');
                                                    if(!empty($consignee_name) && $consignee_name != $GLOBALS['null_value']) {
                                                        echo $obj->encode_decode("decrypt", $consignee_name);
                                                    }
                                                }
                                            ?>
                                        </th>
                                        <th class="text-center px-2 py-2">
                                            <?php 
                                                if(!empty($quantity)) {
                                                    for($q = 0; $q < count($quantity); $q++) {
                                                        $unit_name = "";
                                                        if(!empty($unit_id[$q])) {
                                                            $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id[$q], 'unit_name');
                                                            $unit_name = $obj->encode_decode("decrypt", $unit_name);
                                                        }
                                                        if($quantity[$q] >= 0 && !empty($quantity[$q])) {
                                                            echo $quantity[$q]. " / ".$unit_name."<br>";
                                                        } 
                                                    }
                                                }
                                                if(!empty($weight)) {
                                                    for($e = 0; $e < count($weight); $e++) {
                                                        $unit_name = "";
                                                        if(!empty($unit_id[$e])) {
                                                            $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id[$e], 'unit_name');
                                                            $unit_name = $obj->encode_decode("decrypt", $unit_name);
                                                        }
                                                        if($weight[$e] >= 0 && !empty($weight[$e])) {
                                                            echo $weight[$e]. " / ".$unit_name."<br>";
                                                        }
                                                    }
                                                }
                                            ?>
                                        </th>
                                        <th class="text-center px-2 py-2">
                                            <?php
                                                if(!empty($price_per_qty)) { echo $price_per_qty; }
                                            ?>
                                        </th>
                                        <th class="total_display text-center px-2 py-2">
                                            <?php
                                                echo $total;
                                            ?>
                                        </th>
                                        <th class="text-center px-2 py-2">
                                            <?php
                                                if(!empty($bill_type)) {
                                                    echo $bill_type;
                                                }
                                            ?>
                                        </th>
                                        <th class="text-center px-2 py-2">
                                            <button class="btn btn-danger align-self-center px-3 py-2" type="button" onclick="Javascript:DeleteProductRow('<?php echo $i+1; ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </th>  
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row p-lg-3 p-1">    
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark btnwidth submit_button" type="button" onClick="Javascript:SaveModalContent('tripsheet_form', 'tripsheet_changes.php', 'tripsheet.php');">Submit</button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
			<script src="include/select2/js/select.js"></script>
        
            <script>
                jQuery(document).ready(function(){
                    <?php 
                        if(!empty($show_tripsheet_id)) { ?>
                            LRNumberChanges('<?php if(!empty($from_branch_id)){ echo $from_branch_id; } ?>','<?php if(!empty($to_branch_ids)){ echo $to_branch_ids; } ?>');
                   
                        <?php }
                    ?>
                });
            </script>
        </form>
		<?php
    } 
    if(isset($_POST['edit_id'])) {	
        $tripsheet_number = ""; $tripsheet_date = ""; $tripsheet_date_error = ""; $reference_number = ""; $reference_number_error = "";
        $vehicle_id = ""; $vehicle_id_error = ""; $from_branch_id = ""; $from_branch_id_error = ""; $to_branch_id = array();
        $to_branch_id_error = ""; $driver_name = ""; $driver_name_error = ""; $driver_number = ""; $driver_number_error = "";
        $helper_name = ""; $helper_name_error = ""; $organization_id = ""; $organization_details = ""; $lr_id = array();
        $godown_id = ""; $luggage_clearance_id = ""; $from_branch_name = ""; $to_branch_names = array();
        $lr_numbers = array(); $lr_dates = array(); $from_branch_lr_ids = array(); $to_branch_lr_ids = array(); $consignor_ids = array();
        $consignee_ids = array(); $unit_ids = array(); $quantity_values = array(); $weight_values = array(); $price_per_qty_values = array(); $total_values = array(); $bill_types = array(); $destination_branch_id = ""; $destination_branch_id_error = "";
        
        $valid_tripsheet = ""; $form_name = "tripsheet_form"; $edit_id = "";

        if(isset($_SESSION['bill_company_id']) && !empty($_SESSION['bill_company_id'])) {
            $organization_id = $_SESSION['bill_company_id'];
            if(!empty($organization_id)) {
                $organization_details = $obj->organizationDetails($organization_id, $GLOBALS['organization_table']);
            }
        }
        if(isset($_POST['edit_id'])) {
			$edit_id = trim($_POST['edit_id']);
		}
        
        if(isset($_POST['tripsheet_date'])){
			$tripsheet_date = trim($_POST['tripsheet_date']);
		}
        if(empty($tripsheet_date)) {
            $tripsheet_date_error = "Select Date";
        }
        if(!empty($tripsheet_date_error)) {
            if(!empty($valid_tripsheet)) {
                $valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "tripsheet_date", $tripsheet_date_error, 'text');
            }
            else {
                $valid_tripsheet = $valid->error_display($form_name, "tripsheet_date", $tripsheet_date_error, 'text');
            }
        }

        if(isset($_POST['reference_number'])) {
            $reference_number = trim($_POST['reference_number']);
            if(!empty($reference_number)) {
                $reference_number_error = $valid->common_validation($reference_number, 'Reference No', 'text');
            }
        }
        if(!empty($reference_number_error)) {
            if(!empty($valid_tripsheet)) {
                $valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "reference_number", $reference_number_error, 'text');
            }
            else {
                $valid_tripsheet = $valid->error_display($form_name, "reference_number", $reference_number_error, 'text');
            }
        }

        if(isset($_POST['vehicle_id'])) {
            $vehicle_id = trim($_POST['vehicle_id']);
            $vehicle_id_error = $valid->common_validation($vehicle_id, 'Vehicle', 'select');
        }
        if(!empty($vehicle_id_error)) {
            if(!empty($valid_tripsheet)) {
                $valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "vehicle_id", $vehicle_id_error, 'select');
            }
            else {
                $valid_tripsheet = $valid->error_display($form_name, "vehicle_id", $vehicle_id_error, 'select');
            }
        }

        if(isset($_POST['from_branch_id'])) {
            $from_branch_id = trim($_POST['from_branch_id']);
            $from_branch_id_error = $valid->common_validation($from_branch_id, 'From Branch', 'select');
        }
        if(!empty($from_branch_id_error)) {
            if(!empty($valid_tripsheet)) {
                $valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "from_branch_id", $from_branch_id_error, 'select');
            }
            else {
                $valid_tripsheet = $valid->error_display($form_name, "from_branch_id", $from_branch_id_error, 'select');
            }
        }

        if(isset($_POST['to_branch_id'])) {
            $to_branch_id = $_POST['to_branch_id'];
        }
        if(empty($to_branch_id)) {
            $to_branch_id_error = "Select To Branch";
        }
        if(!empty($to_branch_id_error)) {
            if(!empty($valid_tripsheet)) {
                $valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "to_branch_id[]", $to_branch_id_error, 'select');
            }
            else {
                $valid_tripsheet = $valid->error_display($form_name, "to_branch_id[]", $to_branch_id_error, 'select');
            }
        }

        if(isset($_POST['destination_branch_id'])) {
            $destination_branch_id = trim($_POST['destination_branch_id']);
            $destination_branch_id_error = $valid->common_validation($destination_branch_id, 'Destination Branch', 'select');
        }
        if(!empty($destination_branch_id_error)) {
            if(!empty($valid_tripsheet)) {
                $valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "destination_branch_id", $destination_branch_id_error, 'select');
            }
            else {
                $valid_tripsheet = $valid->error_display($form_name, "destination_branch_id", $destination_branch_id_error, 'select');
            }
        }

        if(isset($_POST['driver_name'])){
			$driver_name = trim($_POST['driver_name']);
            $driver_name_error = $valid->common_validation($driver_name, 'Driver Name', 'select');
		}
        if(!empty($driver_name_error)) {
            if(!empty($valid_tripsheet)) {
                $valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "driver_name", $driver_name_error, 'select');
            }
            else {
                $valid_tripsheet = $valid->error_display($form_name, "driver_name", $driver_name_error, 'select');
            }
        }

        if(isset($_POST['driver_number'])){
			$driver_number = trim($_POST['driver_number']);
            $driver_number_error = $valid->valid_mobile_number($driver_number,'Driver Number','0');
		}
        if(!empty($driver_number_error)) {
            if(!empty($valid_tripsheet)) {
                $valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "driver_number", $driver_number_error, 'text');
            }
            else {
                $valid_tripsheet = $valid->error_display($form_name, "driver_number", $driver_number_error, 'text');
            }
        }

        if(isset($_POST['helper_name'])){
			$helper_name = trim($_POST['helper_name']);
            if(!empty($helper_name)) {
                $helper_name_error = $valid->common_validation($helper_name,'Helper Name','text');
            }
		}
        if(!empty($helper_name_error)) {
            if(!empty($valid_tripsheet)) {
                $valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "helper_name", $helper_name_error, 'text');
            }
            else {
                $valid_tripsheet = $valid->error_display($form_name, "helper_name", $helper_name_error, 'text');
            }
        }
        
        if(isset($_POST['lr_id'])) {
            $lr_id = $_POST['lr_id'];
        } 
        if(!empty($lr_id)) {
            for($i=0; $i < count($lr_id); $i++) {
                $lr_list = array();
                $lr_list = $obj->getTableRecords($GLOBALS['lr_table'], 'lr_id', $lr_id[$i]);
                if(!empty($lr_list)) {
                    foreach($lr_list as $data) {
                        $lr_number = ""; $lr_date = ""; $from_branch_lr_id = ""; $to_branch_lr_id = ""; $consignor_id = "";
                        $consignee_id = ""; $unit_id = ""; $quantity = ""; $weight = ""; $price_per_qty = ""; $total = ""; $bill_type = "";
                        if(!empty($data['lr_number']) && $data['lr_number'] != $GLOBALS['null_value']) {
                            $lr_number = $data['lr_number'];
                        }
                        if(!empty($data['lr_date']) && $data['lr_date'] != "0000-00-00") {
                            $lr_date = date('Y-m-d', strtotime($data['lr_date']));
                        }
                        if(!empty($data['from_branch_id']) && $data['from_branch_id'] != $GLOBALS['null_value']) {
                            $from_branch_lr_id = $data['from_branch_id'];
                        }
                        if(!empty($data['to_branch_id']) && $data['to_branch_id'] != $GLOBALS['null_value']) {
                            $to_branch_lr_id = $data['to_branch_id'];
                        }
                        if(!empty($data['consignor_id']) && $data['consignor_id'] != $GLOBALS['null_value']) {
                            $consignor_id = $data['consignor_id'];
                        }
                        if(!empty($data['consignee_id']) && $data['consignee_id'] != $GLOBALS['null_value']) {
                            $consignee_id = $data['consignee_id'];
                        }
                        if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                            $unit_id = $data['unit_id'];
                        }
                        if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                            $quantity = $data['quantity'];
                        }
                        if(!empty($data['weight']) && $data['weight'] != $GLOBALS['null_value']) {
                            $weight = $data['weight'];
                        }
                        if(!empty($data['price_per_qty']) && $data['price_per_qty'] != $GLOBALS['null_value']) {
                            $price_per_qty = $data['price_per_qty'];
                        }
                        if(!empty($data['total']) && $data['total'] != $GLOBALS['null_value']) {
                            $total = $data['total'];
                        }
                        if(!empty($data['bill_type']) && $data['bill_type'] != $GLOBALS['null_value']) {
                            $bill_type = $data['bill_type'];
                        }
                        $lr_numbers[] = $lr_number; $lr_dates[] = $lr_date; $from_branch_lr_ids[] = $from_branch_lr_id; 
                        $to_branch_lr_ids[] = $to_branch_lr_id; $consignor_ids[] = $consignor_id;
                        $consignee_ids[] = $consignee_id; $unit_ids[] = $unit_id; $quantity_values[] = $quantity; $weight_values[] = $weight; $price_per_qty_values[] = $price_per_qty; $total_values[] = $total; $bill_types[] = $bill_type;
                    }
                }
            }
        }
        else {
            if(empty($valid_tripsheet)) {
                $lr_id_error = "Add LR to table";
            }
        }
        /*
        if(isset($_POST['luggage_clearance_id']))
        {
            $luggage_clearance_id = $_POST['luggage_clearance_id'];
            if(!empty($luggage_clearance_id))
            {
                $luggage_clearance_id = array_reverse($luggage_clearance_id);
            }
        }
        */

        /*
		$custom_vehicle_error = ""; $custom_vehicle_mobile_error = ""; $custom_vehicle_name = ""; $custom_vehicle_mobile_number = ""; $error = 0; $custom_vehicle_number = "";
		
		if(empty($vehicle_id)) {

			if(isset($_POST['custom_vehicle_mobile_number'])) {
				$custom_vehicle_mobile_number = $_POST['custom_vehicle_mobile_number'];
				$custom_vehicle_mobile_error = $valid->valid_mobile_number($custom_vehicle_mobile_number, "Mobile Number", "1");
				// if(!empty($custom_vehicle_mobile_error)) {
				// 	$error = 1;
				// }
                if(!empty($custom_vehicle_mobile_error))
                {
                    if(!empty($valid_tripsheet)) {
                        $valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "custom_vehicle_mobile_number", $custom_vehicle_mobile_error, 'text');
                    }
                    else {
                        $valid_tripsheet = $valid->error_display($form_name, "custom_vehicle_mobile_number", $custom_vehicle_mobile_error, 'text');
                    }
                }
                
			}
            if(isset($_POST['custom_vehicle_number'])) {
				$custom_vehicle_number = $_POST['custom_vehicle_number'];
                if(empty($custom_vehicle_number))
                {
                    $custom_vehicle_number_error = "Enter the vehicle number";
                }
                if(!empty($custom_vehicle_number_error))
                {
                    if(!empty($valid_tripsheet)) {
                        $valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "custom_vehicle_number", $custom_vehicle_number_error, 'text');
                    }
                    else {
                        $valid_tripsheet = $valid->error_display($form_name, "custom_vehicle_number", $custom_vehicle_number_error, 'text');
                    }
                }
			}
			
			if(empty($custom_vehicle_number) ) {
				$vehicle_id_error = "Select the vehicle";
			}
            
			if(empty($vehicle_id_error)) {
				$columns = array(); $values = array(); $check_vehicles = array();		
				if(!empty($custom_vehicle_number) ) {

					$check_vehicles = $obj->getTableRecords($GLOBALS['vehicle_table'], '', '');
					if(!empty($check_vehicles)) {
						foreach($check_vehicles as $data) {
							if(!empty($data['vechile_number']) && $data['vechile_number'] == $custom_vehicle_number) {
								$vehicle_id_error = "This mobile number is already exist";
							}
							if(!empty($vehicle_id_error)) {
								break;
							}
						}
					}
				}
			}
            if(!empty($vehicle_id_error)) {
				if(!empty($valid_tripsheet)) {
					$valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "vehicle_id", $vehicle_id_error, 'select');
				}
				else {
					$valid_tripsheet = $valid->error_display($form_name, "vehicle_id", $vehicle_id_error, 'select');
				}
			}
            $lower_case_name = "";
            if(!empty($custom_vehicle_number)) {
                $lower_case_name = strtolower($custom_vehicle_number);
                $lower_case_name = $obj->encode_decode('encrypt', $lower_case_name);
            }
			if(empty($vehicle_id_error)) {
				$columns = array(); $values = array(); $check_vehicles = array();		
				if(!empty($custom_vehicle_number) ) {
					$check_vehicles = $obj->getTableRecords($GLOBALS['vehicle_table'], '', '');
                   if(!empty($check_vehicles)) {
						foreach($check_vehicles as $data) {
							if(!empty($data['lower_case_name']) && $data['lower_case_name'] == $lower_case_name) {
								$vehicle_id_error = "This Vehicle number is already exist";
							}
							if(!empty($vehicle_id_error)) {
								break;
							}
						}
					}
				}
			}
			if(!empty($vehicle_id_error)) {
				if(!empty($valid_tripsheet)) {
					$valid_tripsheet = $valid_tripsheet." ".$valid->error_display($form_name, "vehicle_id", $vehicle_id_error, 'select');
				}
				else {
					$valid_tripsheet = $valid->error_display($form_name, "vehicle_id", $vehicle_id_error, 'select');
				}
			}
		}
        */
		$result = "";
      
		if(empty($valid_tripsheet) && empty($lr_id_error)) {
			$check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $bill_company_id = $GLOBALS['bill_company_id'];
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);

                if(!empty($tripsheet_date)) {
                    $tripsheet_date = date('Y-m-d', strtotime($tripsheet_date));
                }
                if(!empty($reference_number)) {
                    $reference_number = $obj->encode_decode('encrypt', $reference_number);
                }
                else {
                    $reference_number = $GLOBALS['null_value'];
                }
                $vehicle_name = ""; $vehicle_number = "";
                if(!empty($vehicle_id)) {
                    $vehicle_name = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'vehicle_id', $vehicle_id, 'name');
                    $vehicle_number = $obj->getTableColumnValue($GLOBALS['vehicle_table'], 'vehicle_id', $vehicle_id, 'vehicle_number');
                }
                else {
                    $vehicle_id = $GLOBALS['null_value'];
                    $vehicle_name = $GLOBALS['null_value'];
                    $vehicle_number = $GLOBALS['null_value'];
                }
                if(empty($edit_id)) {
                    $tripsheet_number = $obj->automate_number($GLOBALS['tripsheet_table'], 'tripsheet_number', '', $from_branch_id);
                }
                else {
                    $tripsheet_number = $obj->getTableColumnValue($GLOBALS['tripsheet_table'], 'tripsheet_id', $edit_id, 'tripsheet_number');
                }

                if(!empty($from_branch_id)) {
                    $from_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $from_branch_id, 'name');
                }
                else {
                    $from_branch_id = $GLOBALS['null_value'];
                    $from_branch_name = $GLOBALS['null_value'];
                }
                if(!empty($to_branch_id)) {
                    for($i=0; $i < count($to_branch_id); $i++) {
                        if(!empty($to_branch_id[$i])) {
                            $to_branch_name = "";
                            $to_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $to_branch_id[$i], 'name');
                            $to_branch_names[] = $to_branch_name;
                        }
                    }
                    if(!empty(array_filter($to_branch_id, fn($value) => $value !== ""))) {
                        $to_branch_id = implode(",", $to_branch_id);
                    }
                    else {
                        $to_branch_id = $GLOBALS['null_value'];
                    }
                    if(!empty(array_filter($to_branch_names, fn($value) => $value !== ""))) {
                        $to_branch_names = implode(",", $to_branch_names);
                    }
                    else {
                        $to_branch_names = $GLOBALS['null_value'];
                    }
                }
                else {
                    $to_branch_id = $GLOBALS['null_value'];
                    $to_branch_names = $GLOBALS['null_value'];
                }
                $destination_branch_name = "";
                if(!empty($destination_branch_id)) {
                    $destination_branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'], 'branch_id', $destination_branch_id, 'name');
                }
                else {
                    $destination_branch_id = $GLOBALS['null_value'];
                    $destination_branch_name = $GLOBALS['null_value'];
                }
                if(empty($driver_name)) {
                    $driver_name = $GLOBALS['null_value'];
                }
                if(!empty($driver_number)) {
                    $driver_number = $obj->encode_decode("encrypt",$driver_number);
                }
                else {
                    $driver_number = $GLOBALS['null_value'];
                }
                if(!empty($helper_name)) {
                    $helper_name = $obj->encode_decode("encrypt",$helper_name);
                }
                else {
                    $helper_name = $GLOBALS['null_value'];
                }
                if(!empty($luggage_clearance_id)) {
                    $luggage_clearance_id = implode(",", $luggage_clearance_id);
                }
                else {
                    $luggage_clearance_id = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($lr_id, fn($value) => $value !== ""))) {
                    $lr_id = implode(",", $lr_id);
                }
                else {
                    $lr_id = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($lr_numbers, fn($value) => $value !== ""))) {
                    $lr_numbers = implode("$$$", $lr_numbers);
                }
                else {
                    $lr_numbers = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($lr_dates, fn($value) => $value !== ""))) {
                    $lr_dates = implode("$$$", $lr_dates);
                }
                else {
                    $lr_dates = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($from_branch_lr_ids, fn($value) => $value !== ""))) {
                    $from_branch_lr_ids = implode("$$$", $from_branch_lr_ids);
                }
                else {
                    $from_branch_lr_ids = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($to_branch_lr_ids, fn($value) => $value !== ""))) {
                    $to_branch_lr_ids = implode("$$$", $to_branch_lr_ids);
                }
                else {
                    $to_branch_lr_ids = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($consignor_ids, fn($value) => $value !== ""))) {
                    $consignor_ids = implode("$$$", $consignor_ids);
                }
                else {
                    $consignor_ids = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($consignee_ids, fn($value) => $value !== ""))) {
                    $consignee_ids = implode("$$$", $consignee_ids);
                }
                else {
                    $consignee_ids = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($unit_ids, fn($value) => $value !== ""))) {
                    $unit_ids = implode("$$$", $unit_ids);
                }
                else {
                    $unit_ids = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($quantity_values, fn($value) => $value !== ""))) {
                    $quantity_values = implode("$$$", $quantity_values);
                }
                else {
                    $quantity_values = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($weight_values, fn($value) => $value !== ""))) {
                    $weight_values = implode("$$$", $weight_values);
                }
                else {
                    $weight_values = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($price_per_qty_values, fn($value) => $value !== ""))) {
                    $price_per_qty_values = implode("$$$", $price_per_qty_values);
                }
                else {
                    $price_per_qty_values = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($total_values, fn($value) => $value !== ""))) {
                    $total_values = implode("$$$", $total_values);
                }
                else {
                    $total_values = $GLOBALS['null_value'];
                }
                if(!empty(array_filter($bill_types, fn($value) => $value !== ""))) {
                    $bill_types = implode("$$$", $bill_types);
                }
                else {
                    $bill_types = $GLOBALS['null_value'];
                }
                if(empty($godown_id)) {
                    $godown_id = $GLOBALS['null_value'];
                }
				
                if(empty($edit_id)) {
                    $action = "";
                    if(!empty($from_branch_name) && $from_branch_name != $GLOBALS['null_value']) {
                        $action = "New Tripsheet Created. From Branch - ".$obj->encode_decode('decrypt', $from_branch_name);
                    }

                    $null_value = $GLOBALS['null_value'];
                    $columns = array('created_date_time', 'creator', 'creator_name', 'tripsheet_id', 'tripsheet_number', 'organization_id', 'organization_details', 'godown_id', 'tripsheet_date', 'reference_number', 'vehicle_id', 'vehicle_name', 'vehicle_number', 'from_branch_id', 'from_branch_name', 'to_branch_id', 'to_branch_name', 'destination_branch_id', 'destination_branch_name', 'driver_name', 'driver_number', 'helper_name', 'lr_id', 'lr_date', 'lr_number', 'from_branch_lr_id', 'to_branch_lr_id', 'consignor_id', 'consignee_id', 'quantity', 'weight', 'unit_id', 'price_per_qty', 'total_amount', 'bill_type', 'luggage_id', 'is_acknowledged', 'cancelled', 'deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$tripsheet_number."'", "'".$organization_id."'", "'".$organization_details."'", "'".$godown_id."'", "'".$tripsheet_date."'", "'".$reference_number."'", "'".$vehicle_id."'", "'".$vehicle_name."'", "'".$vehicle_number."'", "'".$from_branch_id."'", "'".$from_branch_name."'", "'".$to_branch_id."'", "'".$to_branch_names."'", "'".$destination_branch_id."'", "'".$destination_branch_name."'", "'".$driver_name."'", "'".$driver_number."'", "'".$helper_name."'", "'".$lr_id."'", "'".$lr_dates."'", "'".$lr_numbers."'", "'".$from_branch_lr_ids."'", "'".$to_branch_lr_ids."'", "'".$consignor_ids."'", "'".$consignee_ids."'", "'".$quantity_values."'", "'".$weight_values."'", "'".$unit_ids."'", "'".$price_per_qty_values."'", "'".$total_values."'", "'".$bill_types."'", "'".$luggage_clearance_id."'", "'0'", "'0'", "'0'");

                    $tripsheet_insert_id = $obj->InsertSQL($GLOBALS['tripsheet_table'], $columns, $values, $action);					
                    if(preg_match("/^\d+$/", $tripsheet_insert_id)) {
                        $tripsheet_id = "";
                        if($tripsheet_insert_id < 10) {
                            $tripsheet_id = "TRIPSHEET_".date("dmYhis")."_0".$tripsheet_insert_id;
                        }
                        else {
                            $tripsheet_id = "TRIPSHEET_".date("dmYhis")."_".$tripsheet_insert_id;
                        }
                        if(!empty($tripsheet_id)) {
                            $tripsheet_id = $obj->encode_decode('encrypt', $tripsheet_id);
                        }
                        $columns = array(); $values = array();						
                        $columns = array('tripsheet_id');
                        $values = array("'".$tripsheet_id."'");
                        $tripsheet_update_id = $obj->UpdateSQL($GLOBALS['tripsheet_table'], $tripsheet_insert_id, $columns, $values, '');

                        if(preg_match("/^\d+$/", $tripsheet_update_id)) {
                            $lr_id = explode(',',$lr_id);

                            for($i=0;$i < count($lr_id);$i++){
                                $getUniqueLRID = "";
                                $getUniqueLRID = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $lr_id[$i], 'id');
                                $columns = array(); $values = array();          		
                                $columns = array('is_tripsheet_entry','tripsheet_number');
                                $values = array("'1'","'".$tripsheet_number."'");
                                $updateLR = $obj->UpdateSQL($GLOBALS['lr_table'], $getUniqueLRID, $columns, $values, $action);

                                // if(preg_match("/^\d+$/", $updateLR)) {
                                //     $consignee_id =""; $lr_number = "";$lr_date ="";$consignor_id =""; $godown_id = "";
                                //     $consignee_id = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_id[$i],'consignee_id');
                                //     $lr_number = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_id[$i],'lr_number');
                                //     $lr_date = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_id[$i],'lr_date');
                                //     $consignor_id = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_id[$i],'consignor_id');
                                //     $godown_id = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_id[$i],'godown_id');

                                //     $columns = array('created_date_time', 'creator','creator_name','lr_id','godown_id','outward_quantity','unit_id','lr_number','lr_date','consignee_id','consignor_id','deleted');
                                //     $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$lr_id[$i]."'","'".$godown_id."'","'".$quantity[$i]."'","'".$unit_id[$i]."'","'".$lr_number."'","'".$lr_date."'","'".$consignee_id."'","'".$consignor_id."'",'0');
                                //     $stock_insert_id = $obj->InsertSQL($GLOBALS['stock_table'],$columns, $values, $action);
                                //     if(preg_match("/^\d+$/", $stock_insert_id)) {
                                //         $update_stock = 0;
                                //     }
                                // }
                            }
                            $cleared_luggagesheet_lr_list = array(); $cleared_lr_count = 0; $luggagesheet_lr_list = array(); $luggagesheet_lr_count = 0;
                            /*
                            if(!empty($luggage_clearance_id)){
                                $luggage_clearance_id = explode(',',$luggage_clearance_id);
                                for($i=0;$i<count($luggage_clearance_id);$i++){
                                    $cleared_luggagesheet_lr_list = $obj->getClearedLuggagesheetLR($luggage_clearance_id[$i]);
                                    $cleared_lr_count = count($cleared_luggagesheet_lr_list);
                                    $luggagesheet_number = $obj->getTableColumnValue($GLOBALS['luggagesheet_table'],'luggage_id',$luggage_clearance_id[$i],'luggagesheet_number');
                                    $luggagesheet_lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'luggagesheet_number',$luggagesheet_number);
                                    $lr_count = count($luggagesheet_lr_list);
                                    if($lr_count == $cleared_lr_count)
                                    {
                                        $luggagesheet_lr_list = $obj->UpdateLuggage($luggage_clearance_id[$i]);
                                    }
                                    else
                                    {
                                        $getUniqueId = $obj->getTableColumnValue($GLOBALS['luggagesheet_table'],'luggage_id',$luggage_clearance_id[$i],'id');
                                        $columns = array(); $values = array();          		
                                        $columns = array('is_cleared');
                                        $values = array("'0'");
                                        $list = $obj->UpdateSQL($GLOBALS['luggagesheet_table'], $getUniqueId, $columns, $values,'');
                                    }
                                }
                                // Already commented before 27-06-2025
                                // foreach($prev_lr_list as $data) {
                                //     if(!empty($data['lr_id'])) {
                                //         if(!in_array($data['lr_id'], $lr_id)) {
                                //             $columns = array(); $values = array();						
                                //             $columns = array('is_tripsheet_entry','tripsheet_number');
                                //             $values = array("'0'","''");
                                //             $sales_invoice_update_id = $obj->UpdateSQL($GLOBALS['lr_table'], $data['id'], $columns, $values, '');
                                //         }	
                                //     }
                                // }
                            }*/
                            $result = array('number' => '1', 'msg' => 'Tripsheet Successfully Created');
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $lr_update_id);
                        }
                    }
                    else {
                        $result = array('number' => '2', 'msg' => $lr_insert_id);
                    }
				}
				else {
					if(!empty($edit_id)) {
						$getUniqueID = "";
						$getUniqueID = $obj->getTableColumnValue($GLOBALS['tripsheet_table'], 'tripsheet_id', $edit_id, 'id');
						if(preg_match("/^\d+$/", $getUniqueID)) {
							$action = "";
                            if(!empty($from_branch_name) && $from_branch_name != $GLOBALS['null_value']) {
                                $action = "Tripsheet Updated. From Branch - ".$obj->encode_decode('decrypt', $from_branch_name);
                            }
                            $null_value = $GLOBALS['null_value'];
							$columns = array(); $values = array();
                            $columns = array('creator_name', 'organization_id', 'organization_details', 'godown_id', 'tripsheet_date', 'reference_number', 'vehicle_id', 'vehicle_name', 'vehicle_number', 'from_branch_id', 'from_branch_name', 'to_branch_id', 'to_branch_name', 'destination_branch_id', 'destination_branch_name', 'driver_name', 'driver_number', 'helper_name', 'lr_id', 'lr_date', 'lr_number', 'from_branch_lr_id', 'to_branch_lr_id', 'consignor_id', 'consignee_id', 'quantity', 'weight', 'unit_id', 'price_per_qty', 'total_amount', 'bill_type', 'luggage_id');
                            $values = array("'".$creator_name."'", "'".$organization_id."'", "'".$organization_details."'", "'".$godown_id."'", "'".$tripsheet_date."'", "'".$reference_number."'", "'".$vehicle_id."'", "'".$vehicle_name."'", "'".$vehicle_number."'", "'".$from_branch_id."'", "'".$from_branch_name."'", "'".$to_branch_id."'", "'".$to_branch_names."'", "'".$destination_branch_id."'", "'".$destination_branch_name."'", "'".$driver_name."'", "'".$driver_number."'", "'".$helper_name."'", "'".$lr_id."'", "'".$lr_dates."'", "'".$lr_numbers."'", "'".$from_branch_lr_ids."'", "'".$to_branch_lr_ids."'", "'".$consignor_ids."'", "'".$consignee_ids."'", "'".$quantity_values."'", "'".$weight_values."'", "'".$unit_ids."'", "'".$price_per_qty_values."'", "'".$total_values."'", "'".$bill_types."'", "'".$luggage_clearance_id."'");
							$lr_update_id = $obj->UpdateSQL($GLOBALS['tripsheet_table'], $getUniqueID, $columns, $values, $action);

							if(preg_match("/^\d+$/", $lr_update_id)) {
                                $lr_id = explode(',',$lr_id);

                                $prev_lr_list = array();
                                $prev_lr_list = $obj->getTableRecords($GLOBALS['lr_table'], 'tripsheet_number', $tripsheet_number,'');
                                if(!empty($prev_lr_list)) {
                                    foreach($prev_lr_list as $data) {
                                        if(!empty($data['lr_id'])) {
                                            if(!in_array($data['lr_id'], $lr_id)) {
                                                $columns = array(); $values = array();						
                                                $columns = array('is_tripsheet_entry', 'tripsheet_number');
                                                $values = array("'0'", "'".$null_value."'");
                                                $sales_invoice_update_id = $obj->UpdateSQL($GLOBALS['lr_table'], $data['id'], $columns, $values, '');
                                            }	
                                        }
                                    }
                                }
                                for($i=0;$i < count($lr_id);$i++){
                                    $lr_luggage_update = $obj->LrTripsheetUpdate($lr_id[$i], $tripsheet_number);
                                    // $getUniqueLuggageID = "";
                                    // $getUniqueLuggageID = $obj->getTableColumnValue($GLOBALS['stock_table'],'remarks',$edit_id,'id');
                                    // $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'lr_id','outward_quantity', 'unit_id');
                                    // $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'","'".$lr_id[$i]."'", "'".$quantity[$i]."'","'".$unit_id[$i]."'");
                                    // $stock_insert_id = $obj->UpdateSQL($GLOBALS['stock_table'],$getUniqueLuggageID,$columns, $values, $action);
                                    // if(preg_match("/^\d+$/", $stock_insert_id)) {
                                    //     $update_stock = 0;
                                    // }
                                }
                                $result = array('number' => '1', 'msg' => 'Tripsheet Successfully Updated');
                                //$result = array('number' => '1', 'msg' => 'lr Successfully Created','lr_id' => $lr_id,'print_type' => $print_type);
                                /*
                                if(!empty($luggage_clearance_id)){
                                    
                                    $luggage_clearance_id = explode(',',$luggage_clearance_id);
                                    for($i=0;$i<count($luggage_clearance_id);$i++){
                                        if(!empty($luggage_clearance_id[$i]))
                                        {
                                           
                                            $cleared_luggagesheet_lr_list = $obj->getClearedLuggagesheetLR($luggage_clearance_id[$i]);
                                            $cleared_lr_count = count($cleared_luggagesheet_lr_list);
                                            $luggagesheet_number = $obj->getTableColumnValue($GLOBALS['luggagesheet_table'],'luggage_id',$luggage_clearance_id[$i],'luggagesheet_number');
                                            $luggagesheet_lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'luggagesheet_number',$luggagesheet_number);
                                            $lr_count = count($luggagesheet_lr_list);
                                            if($lr_count == $cleared_lr_count)
                                            {
                                                $luggagesheet_lr_list = $obj->UpdateLuggage($luggage_clearance_id[$i]);
                                            }
                                            else
                                            {
                                                $getUniqueId = $obj->getTableColumnValue($GLOBALS['luggagesheet_table'],'luggage_id',$luggage_clearance_id[$i],'id');
                                                $columns = array(); $values = array();          		
                                                $columns = array('is_cleared');
                                                $values = array("'0'");
                                                $list = $obj->UpdateSQL($GLOBALS['luggagesheet_table'], $getUniqueId, $columns, $values,'');
                                            }
                                        }
                                    }
    
                                    // Already commented before 27-06-2025
                                    // foreach($prev_lr_list as $data) {
                                    //     if(!empty($data['lr_id'])) {
                                    //         if(!in_array($data['lr_id'], $lr_id)) {
                                    //             $columns = array(); $values = array();						
                                    //             $columns = array('is_tripsheet_entry','tripsheet_number');
                                    //             $values = array("'0'","''");
                                    //             $sales_invoice_update_id = $obj->UpdateSQL($GLOBALS['lr_table'], $data['id'], $columns, $values, '');
                                    //         }	
                                    //     }
                                    // }
                                }*/
							}
							else {
								$result = array('number' => '2', 'msg' => $lr_update_id);
							}			
                            				
						}
					}
                }
			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_tripsheet)) {
				$result = array('number' => '3', 'msg' => $valid_tripsheet);
			}
            if(!empty($lr_id_error)) {
				$result = array('number' => '2', 'msg' => $lr_id_error);
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
        if(isset($_POST['search_text'])) {
            $search_text = trim($_POST['search_text']);
        }
        if(isset($_POST['from_date'])) {
            $from_date = trim($_POST['from_date']);
        }
        if(isset($_POST['to_date'])) {
            $to_date = trim($_POST['to_date']);
        }
        if(isset($_POST['from_branch_filter'])) {
            $from_branch_filter = trim($_POST['from_branch_filter']);
        }
        if(isset($_POST['to_branch_filter'])) {
            $to_branch_filter = trim($_POST['to_branch_filter']);
        }
        if(empty($from_branch_filter) && !empty($login_branch_id)) {
            $from_branch_filter = $login_branch_id;
        }
        $page_title = "Tripsheet";
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
            1 => 'tripsheet_date',
            2 => 'tripsheet_number',
            3 => 'from_branch_name',
            4 => 'to_branch_name',
            5 => 'lr_count',
            6 => 'vehicle_name',
            7 => 'vehicle_number',
            8 => 'driver_name',
            9 => ''
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
            $totalRecords = count($obj->getTripsheetListRecords($row, $rowperpage, $search_text, $from_date, $to_date, $from_branch_filter, $to_branch_filter, $order_column, $order_direction));
            $filteredRecords = count($obj->getTripsheetListRecords('', '', $search_text, $from_date, $to_date, $from_branch_filter, $to_branch_filter, $order_column, $order_direction));
        }

        $data = [];
        $permission_module = $GLOBALS['tripsheet_module'];

        $tripsheet_list = $obj->getTripsheetListRecords($row, $rowperpage, $search_text, $from_date, $to_date, $from_branch_filter, $to_branch_filter, $order_column, $order_direction);
        $sno = $row + 1;
        if(empty($access_error)) {
            foreach ($tripsheet_list as $val) {
                $tripsheet_date = ""; $tripsheet_number = ""; $from_branch_name = ""; $to_branch_name = ""; $lr_id = ""; $lr_count = 0;
                $vehicle_name = ""; $vehicle_number = ""; $driver_name = ""; $to_branch_name_array = "";

                if(!empty($val['tripsheet_date']) && $val['tripsheet_date'] != "0000-00-00") {
                    $tripsheet_date = date('d-m-Y', strtotime($val['tripsheet_date']));
                }
                if(!empty($val['tripsheet_number']) && $val['tripsheet_number'] != $GLOBALS['null_value']) {
                    $tripsheet_number = $val['tripsheet_number'];
                }
                if(!empty($val['from_branch_name']) && $val['from_branch_name'] != $GLOBALS['null_value']) {
                    $from_branch_name = $obj->encode_decode('decrypt', $val['from_branch_name']);
                }
                if(!empty($val['to_branch_name']) && $val['to_branch_name'] != $GLOBALS['null_value']) {
                    $to_branch_name_array = explode(',', $val['to_branch_name']);
                    $last_count = count($to_branch_name_array) - 1;
                    for($i=0; $i < count($to_branch_name_array); $i++) {
                        $to_branch_name .= $obj->encode_decode('decrypt', $to_branch_name_array[$i]);
                        if($i != $last_count) {
                            $to_branch_name .= '<br>';
                        }
                    }
                }
                if(!empty($val['lr_id']) && $val['lr_id'] != $GLOBALS['null_value']) {
                    $lr_id = explode(',', $val['lr_id']);
                    $lr_count = count($lr_id);
                }
                if(!empty($val['vehicle_name']) && $val['vehicle_name'] != $GLOBALS['null_value']) {
                    $vehicle_name = $obj->encode_decode('decrypt', $val['vehicle_name']);
                }
                if(!empty($val['vehicle_number']) && $val['vehicle_number'] != $GLOBALS['null_value']) {
                    $vehicle_number = $obj->encode_decode('decrypt', $val['vehicle_number']);
                }
                if(!empty($val['driver_name']) && $val['driver_name'] != $GLOBALS['null_value']) {
                    $driver_name = $obj->encode_decode('decrypt', $val['driver_name']);
                }

                $action = ""; $edit_option = ""; $delete_option = ""; $print_option = "";
                $print_option = '<a class="dropdown-item pr-2" target="_blank" href="reports/rpt_tripsheet.php?view_tripsheet_id='.$val['tripsheet_id'].'"><i class="fa fa-print"></i>&ensp; Print Overall</a><a class="dropdown-item pr-2" target="_blank" href="reports/rpt_tripsheet_branchwise.php?view_tripsheet_id='.$val['tripsheet_id'].'"><i class="fa fa-print"></i>&ensp; Print Branchwise</a>';
                $access_error = "";
                if(!empty($login_staff_id)) {
                    $permission_action = $edit_action;
                    include('permission_action.php');
                }
                if(empty($access_error) && empty($val['cancelled']) && empty($val['is_acknowledged'])) {
                    $edit_option = '<a class="dropdown-item pr-2" href="Javascript:ShowModalContent('.'\''.$page_title.'\''.', '.'\''.$val['tripsheet_id'].'\''.');"><i class="fa fa-pencil"></i>&ensp; Edit</a>';
                }
                $access_error = "";
                if(!empty($login_staff_id)) {
                    $permission_action = $delete_action;
                    include('permission_action.php');
                }
                if(empty($access_error) && empty($val['cancelled']) && empty($val['is_acknowledged'])) {
                    $delete_option = '<a class="dropdown-item pr-2" href="Javascript:DeleteModalContent('.'\''.$page_title.'\''.', '.'\''.$val['tripsheet_id'].'\''.');"><i class="fa fa-trash"></i>&ensp; Delete</a>';
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
                    "tripsheet_date" => $tripsheet_date,
                    "tripsheet_number" => $tripsheet_number,
                    "from_branch_name" => $from_branch_name,
                    "to_branch_name" => $to_branch_name,
                    "lr_count" => $lr_count,
                    "vehicle_name" => $vehicle_name,
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
    if(isset($_REQUEST['delete_tripsheet_id'])) {
		$delete_tripsheet_id = $_REQUEST['delete_tripsheet_id'];
        
		$msg = "";
		if(!empty($delete_tripsheet_id)) {	
			$tripsheet_unique_id = "";
			$tripsheet_unique_id = $obj->getTableColumnValue($GLOBALS['tripsheet_table'], 'tripsheet_id', $delete_tripsheet_id, 'id');

            if(preg_match("/^\d+$/", $tripsheet_unique_id)) {
            	$tripsheet_number = "";
            	$tripsheet_number = $obj->getTableColumnValue($GLOBALS['tripsheet_table'], 'tripsheet_id', $delete_tripsheet_id, 'tripsheet_number');
            
            	$action = "";
            	if(!empty($tripsheet_number)) {
            		$action = "Tripsheet Deleted. Number - ".$tripsheet_number;
            	}
                $null_value = $GLOBALS['null_value'];
                $lr_id = ""; $lr_ids = array();
                $lr_id = $obj->getTableColumnValue($GLOBALS['tripsheet_table'], 'tripsheet_id', $delete_tripsheet_id, 'lr_id');
                if(!empty($lr_id)) {
                    $lr_ids = explode(",",$lr_id);
                    for($i = 0; $i < count($lr_ids); $i++) {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $lr_ids[$i], 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $columns = array(); $values = array();						
                            $columns = array('is_tripsheet_entry','tripsheet_number');
                            $values = array("'0'","'".$null_value."'");
                            $sales_invoice_update_id = $obj->UpdateSQL($GLOBALS['lr_table'], $getUniqueID, $columns, $values, '');
                        }
                    }
                }

            	$columns = array(); $values = array();          		
            	$columns = array('deleted');
            	$values = array("'1'");
            	$msg = $obj->UpdateSQL($GLOBALS['tripsheet_table'], $tripsheet_unique_id, $columns, $values, $action);
            }
		}
		echo $msg;
		exit;	
	}
?>