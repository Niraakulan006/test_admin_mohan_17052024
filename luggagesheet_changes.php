<?php
	include("include_files.php");

	if(isset($_REQUEST['show_luggagesheet_id'])) { 
        $show_luggage_id = $_REQUEST['show_luggagesheet_id'];
        $luggage_date = date("Y-m-d");
        $luggage_list = array();
        $luggage_list = $obj->getTableRecords($GLOBALS['luggagesheet_table'], 'luggage_id', $show_luggage_id);
        if(!empty($luggage_list)) {
            foreach($luggage_list as $data) {
                if(!empty($data['organization_id'])) {
                    $organization_id =  $data['organization_id'];
                }
                if(!empty($data['luggage_date'])) {
                    $luggage_date =  $data['luggage_date'];
                }
                if(!empty($data['vehicle_id'])) {
                    $vehicle_id = $data['vehicle_id'];
                }
                if(!empty($data['branch_id'])) {
                    $branch_id = $data['branch_id'];
                }
                if(!empty($data['driver_name'])) {
                    $driver_name = $data['driver_name'];
                }
                if(!empty($data['helper_name'])) {
                    $helper_name = $obj->encode_decode('decrypt',$data['helper_name']);
                }
                if(!empty($data['lr_id'])) {
                    $lr_id = $data['lr_id'];
                    $lr_ids = explode(",",$data['lr_id']);
                }
                if(!empty($data['unit_id'])) {
                    $unit_id = $data['unit_id'];
                    $unit_id = explode(",",$data['unit_id']);
                }
                if(!empty($data['quantity'])) {
                    $quantity = $data['quantity'];
                    $quantity = explode(",",$data['quantity']);
                }
                
                if(!empty($data['price_per_qty'])) {
                    $price_per_qty = $data['price_per_qty'];
                    $price_per_qty = explode(",",$data['price_per_qty']);
                }
            }
        }
        $branch_list = array();
        $branch_list = $obj->getTableRecords($GLOBALS['branch_table'],'','');
        $vehicle_list = array();
        $vehicle_list = $obj->getTableRecords($GLOBALS['vehicle_table'],'','');
        $lr_list = array();
        $lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'godown_id',$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_godown']);
        $driver_list = array();
        $driver_list = $obj->getTableRecords($GLOBALS['driver_table'],'','');
        ?>
        <form class="poppins pd-20" name="luggage_form" method="POST">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-8">
						<h5 class="text-white">Edit Luggage Sheet</h5>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('luggagesheet.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
			<div class="row p-3">
				<input type="hidden" name="edit_id" value="<?php if(!empty($show_luggage_id)) { echo $show_luggage_id; } ?>">
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="date" id="luggage_date" name="luggage_date" value="<?php if(!empty($luggage_date)){ echo $luggage_date; }?>" class="form-control shadow-none" placeholder="" required>
                            <label>Date</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <select class="form-control" name="vehicle_id" onchange="vehicleDetails(this.value)">
                                <option value="">Select Vehicle</option>
                                    <?php
                                        if(!empty($vehicle_list)) {
                                            foreach($vehicle_list as $data) { ?>
                                                <option value="<?php if(!empty($data['vehicle_id'])) { echo $data['vehicle_id']; } ?>" <?php if(!empty($vehicle_id)){ if($data['vehicle_id'] == $vehicle_id ){ echo "selected"; } } ?>>
                                                    <?php
                                                        if(!empty($data['vehicle_number'])) {
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
                    <div class="border mb-2">
                        <div class="p-2 ">
                            <div class="p-2 vehicle_preview">
                                <div class="font-weight-bold text-pinterest smallfnt text-center pb-1">Vehicle Details</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 d-none">
                    <div class="input-group mb-3">
                        <select class="form-control " name="branch_id" onchange="getLuggageBranchLR(this.value)" <?php if(!empty($show_luggage_id)){ ?>disabled<?php } ?>>
                            <option value="">Select Branch</option>
                                <?php
                                    if(!empty($branch_list)) {
                                        foreach($branch_list as $data) { ?>
                                            <option value="<?php if(!empty($data['branch_id'])) { echo $data['branch_id']; } ?>" <?php if(!empty($branch_id)){ if($data['branch_id'] == $branch_id ){ echo "selected"; } } ?>>
                                                <?php
                                                    if(!empty($data['name'])) {
                                                        echo $obj->encode_decode("decrypt",$data['name']);
                                                    }
                                                ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                ?>
                        </select>
                    </div>
                    <?php ?>
                        <input type="hidden" name="branch_id" value="<?php if(!empty($branch_id)){ echo $branch_id; }?>">
                    <?php ?>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <select name="driver_name" id="driver_name" class="form-control shadow-none">
                                <option value="">Select name</option>
                                <?php if(!empty($driver_list)){
                                    foreach($driver_list as $col){ ?>
                                        <option value="<?php if(!empty($col['driver_name'])){echo $col['driver_name'];} ?>" <?php if(!empty($driver_name) && $driver_name == $col['driver_name']){ ?>selected<?php } ?>>
                                            <?php
                                                if(!empty($col['driver_name'])){
                                                    $col['driver_name'] = $obj->encode_decode('decrypt',$col['driver_name']);
                                                    echo $col['driver_name'];
                                                }
                                            ?>
                                        </option>
                                    <?php
                                    }
                                } ?>
                            </select>
                            <label>Driver Name</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="helper_name" name="helper_name" class="form-control shadow-none" placeholder="" value="<?php if(!empty($helper_name)){echo $helper_name;}?>" required>
                            <label>Helper Name</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 ">
                    <div class="form-label-group in-border pb-2">
                        <div class="input-group mb-3 lr_details">
                            <select class="form-control" name="selected_lr_id" >
                                <option value="">Select lr</option>
                                    <?php
                                        if(!empty($lr_list)) {
                                            foreach($lr_list as $data) { ?>
                                                <option value="<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>" <?php if(!empty($lr_id)){ if($data['lr_id'] == $lr_id ){ echo "selected"; } } ?>>
                                                    <?php
                                                        if(!empty($data['lr_number'])) {
                                                            $data['lr_number'] = $data['lr_number'];
                                                            echo $data['lr_number'];
                                                        }
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    ?>
                            </select>
                            <label>LR No</label>
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="button"  onClick="Javascript:addDetails();"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            <div class="table-responsive poppins smallfnt">
                <input type="hidden" name="product_count" value="<?php if(!empty($product_row_index)) { echo $product_row_index; } else { echo "0"; } ?>">
				<input type="hidden" name="tax_percentage" value="<?php if(!empty($tax_percentage)) { echo $tax_percentage; } ?>">
				
				<style>
					.table td, .table th { border-top: none; }
					.input-group-append .btn, .input-group-prepend .btn { z-index: 0; }
					.tax_cover .select2-container { width: 100px !important; }
					.party_cover .select2-container { width: 80% !important; }
				</style>
                <table class="table nowrap table-bordered text-center bill_products_table">
                    <thead class="bg-pinterest">
                        <tr class="text-white">
                            <th>#</th>
                            <th>Date</th>
                            <th>LR No</th>
                            <th>Branch</th>
                            <th>Consignor</th>
                            <th>Consignee</th>
                            <th>Articles Qty / Unit</th>
                            <th>Price/QTY</th>
                            <th>Amount</th>
                            <th>Bill Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
						if(!empty($show_luggage_id)) { 
								for($p = 0; $p < count($lr_ids); $p++) { 
									$product_row_index = $p + 1;
									$lr_ids[$p] = trim($lr_ids[$p]);
                                    $lr_list = array();
                                    $lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'lr_id',$lr_ids[$p]);

                                    $organization_id = ""; $lr_date = ""; $lr_number = ""; $consignor_id = ""; $consignee_id = ""; $quantity = array(); $unit_id = array(); $price_per_qty = ""; $amount = "";  $consginor_name = ""; $organization_name = ""; $consignee_name = ""; $consginor_name = ""; $bill_type  = ""; $total = 0;
                                    foreach($lr_list as $data)
                                    {
                                        if(!empty($data['organization_id']))
                                        {
                                            $organization_id = $data['organization_id'];
                                        }
                                        if(!empty($data['lr_date']))
                                        {
                                            $lr_date = $data['lr_date'];
                                        }
                                        if(!empty($data['bill_type']))
                                        {
                                            $bill_type = $data['bill_type'];
                                        }
                                        if(!empty($data['lr_number']))
                                        {
                                            $lr_number = $data['lr_number'];
                                        }
                                        if(!empty($data['consignee_id']))
                                        {
                                            $consignee_id = $data['consignee_id'];
                                        }
                                        if(!empty($data['consignor_id']))
                                        {
                                            $consignor_id = $data['consignor_id'];
                                        }
                                        if(!empty($data['quantity']))
                                        {
                                            $quantity = $data['quantity'];
                                            $quantity = explode(",", $quantity);
                                        }
                                        if(!empty($data['price_per_qty']))
                                        {
                                            $price_per_qty = $data['price_per_qty'];
                                        }
                                        if(!empty($data['unit_id']))
                                        {
                                            $unit_id = $data['unit_id'];
                                            $unit_id = explode(",", $unit_id);
                                        }
                                        if(!empty($data['amount']))
                                        {
                                            $amount = $data['amount'];
                                        }
                                        if(!empty($data['total']))
                                        {
                                            $total = $data['total'];
                                        }
                                        
                                    }
                                    ?>
                                    
									<tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
                                    <input type="hidden" value="<?php echo $lr_ids[$p]; ?>" name="lr_id[]">
										<td class="text-center sno">
											<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>
										</td>
                                        <td class="text-center" >
											<?php
												if(!empty($lr_ids[$p])) {
                                                    $lr_date = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_ids[$p],'lr_date');
                                                    
                                                    if(!empty($lr_date)) {
                                                        echo $lr_date;
                                                    }
                                                }
											?>
                                        </td>
                                        <td class="text-center" >
											<?php
												if(!empty($lr_ids[$p])) {
                                                    $lr_no = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_ids[$p],'lr_number');
                                                    
                                                    if(!empty($lr_no)) {
                                                        echo $lr_no;
                                                    }
                                                }
											?>
                                        </td>
										
                                        <td class="text-center" >
											<?php
												if(!empty($lr_ids[$p])) {
                                                    $consignor_id = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_ids[$p],'consignor_id');
                                                    ?>
                                                    <input type="hidden" name="consignor_id" value="<?php if(!empty($consignor_id)){ echo $consignor_id; }?>">
                                                    <?php
                                                    if(!empty($consignor_id)) {
                                                        $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'],'consignor_id',$consignor_id,'name');
                                                        if(!empty($consignor_name)){
                                                            $consignor_name = $obj->encode_decode('decrypt', $consignor_name);
                                                            echo $consignor_name;
                                                        }
                                                    }
                                                }
											?>
                                        </td>
                                        <td class="text-center" >
                                            <?php
												if(!empty($lr_ids[$p])) {
                                                    $consignee_id = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_ids[$p],'consignee_id');
                                                    
                                                    if(!empty($consignee_id)) {
                                                        $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$consignee_id,'name');
                                                        if(!empty($consignee_name)){
                                                            $consignee_name = $obj->encode_decode('decrypt', $consignee_name);
                                                            echo $consignee_name;
                                                        }
                                                    }
                                                }
											?>
                                        </td>
                                        <td class="text-center" >
                                            <input type="hidden" name="quantity[]" class="mx-auto form-control text-center" style="width: 90px !important;" value="<?php if(!empty($quantity[$p])) { echo $quantity[$p]; } ?>" onkeyup="Javascript:ProductRowCheck(this)">
                                            <?php
                                        for($q = 0; $q < count($quantity); $q++) {
                                            if(!empty($unit_id)){
                                            
                                                $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id[$q],'unit_name');
                                                $unit_name = $obj->encode_decode("decrypt", $unit_name);
                                            }
        
                                            echo $quantity[$q]. " / ".$unit_name; ?> <br>
                                        <?php }

                                            // if(!empty($unit_id)) { 
                                            //     if(!empty($unit_id)) {
                                            //         $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id,'unit_name');
                                            //         if(!empty($unit_name)){
                                            //             $unit_name = $obj->encode_decode('decrypt', $unit_name);
                                            //             echo "".$unit_name;
                                            //         }
                                            //     }
                                            // }
							    		?>
                                        </td>
                                        
                                        <!-- <td class="text-center" >
                                            <?php
												if(!empty($unit_id[$p])) { 
                                                    if(!empty($unit_id[$p])) {
                                                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id[$p],'unit_name');
                                                        if(!empty($unit_name)){
                                                            $unit_name = $obj->encode_decode('decrypt', $unit_name);
                                                            echo $unit_name;
                                                        }
                                                    }
                                                }                        
											?>
                                            <input type="hidden" name="unit_id[]" class="mx-auto form-control text-center" style="width: 90px !important;" value="<?php if(!empty($unit_id[$p])) { echo $unit_id[$p]; } ?>">
                                        </td> -->
                                        <td class="text-center" >
                                            <input type="hidden" name="price_per_qty[]" class="mx-auto form-control text-center" style="width: 90px !important;" value="<?php if(!empty($price_per_qty[$p])) { echo $price_per_qty[$p]; } ?>" onkeyup="Javascript:ProductRowCheck(this);">
                                            <?php 
                                             if(!empty($price_per_qty[$p])) { echo $price_per_qty[$p]; }
                                            ?>
                                        </td>
                                        <td class="text-center" >
											<?php
												if(!empty($lr_ids[$p])) {
                                                    $amount = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_ids[$p],'amount');
                                                    
                                                    if(!empty($amount)) {
                                                        echo $amount;
                                                    }
                                                }
											?>
                                        </td>
                                        <td class="text-center" >
											<?php
												if(!empty($lr_ids[$p])) {
                                                    $bill_type = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_ids[$p],'bill_type');
                                                    
                                                    if(!empty($bill_type)) {
                                                        echo $bill_type;
                                                    }
                                                }
											?>
                                        </td>
										<td class="text-center">
											<button class="btn btn-danger align-self-center px-3 py-2" type="button" onclick="Javascript:DeleteProductRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
										</td>    
									</tr>
									<?php
									$discounted_value = "";
								} 
							} 
						?>
                    </tbody>
                </table>
            </div>
            <div class="row p-lg-3 p-1">    
                <div class="col-md-12 pt-3 text-center">
                    <button class="btn btn-dark btnwidth submit_button" type="button" onClick="Javascript:SaveModalContent('luggage_form', 'luggagesheet_changes.php', 'luggagesheet.php');">Submit</button>
                </div>
            </div> 
        </form>
		<?php
    } 
    if(isset($_POST['edit_id'])) {	
		$name = ""; $name_error = "";  $mobile_number = ""; $mobile_number_error = ""; 	$lrname = ""; $lrname_error = "";
		$password = ""; $password_error = ""; $type = $GLOBALS['admin_user_type']; $lr_number = ""; $total_amount =0; $tax_option =0; $gst_option = 0; $tax_value = 0; $city = ""; $consignor_city = ""; $total =0; $branch_id ="";
		$valid_luggage = ""; $form_name = "luggage_form"; $organization_id = ""; $lr_date = ""; $consignor_id = ""; $consignee_id = ""; $vehicle_id = "";$vehicle_id_error = ""; $lr_id =array(); $luggage_date ="";
        $godown_id = ""; $bill_type = ""; $vehicle_id = ""; $bill_value= ""; $bill_number = ""; $bill_date = ""; $quantity = ""; $unit_id = "";  $price_per_qty = "";  $amount = ""; $extra_charges = ""; $gst_value =""; $lr_number = ""; $lr_error = "";
        
        // if(isset($_POST['organization_id']))
        // {
        //     $organization_id = $_POST['organization_id'];
        // }

        $luggagesheet_number = "";

        if(empty($_POST['edit_id'])){
			$luggagesheet_number = $obj->automate_number($GLOBALS['luggagesheet_table'],'luggagesheet_number','','');
		}
		else{
			$luggagesheet_number = $obj->getTableColumnValue($GLOBALS['luggagesheet_table'], 'luggage_id', $_POST['edit_id'], 'luggagesheet_number');
			$luggagesheet_number = $luggagesheet_number;
		}
    
        // if(empty($organization_id))
        // {
        //     $organization_error = "Select the organization";
        //     if(!empty($organization_error))
        //     {
        //         if(!empty($valid_luggage)) {
        //             $valid_luggage = $valid_luggage." ".$valid->error_display($form_name, "organization_id", $organization_error, 'select');
        //         }
        //         else {
        //             $valid_luggage = $valid->error_display($form_name, "organization_id", $organization_error, 'select');
        //         }
        //     }
           
        // }
        if(isset($_POST['city'])){
			$city = $_POST['city'];
		}
        if(isset($_POST['consignor_id'])){
			$consignor_id = $_POST['consignor_id'];
		}
        if(isset($_POST['consignor_city'])){
			$consignor_city = $_POST['consignor_city'];
		}

        if(isset($_POST['luggage_date'])){
			$luggage_date = $_POST['luggage_date'];
		}

        if(isset($_POST['helper_name'])){
			$helper_name = $_POST['helper_name'];
		}
       
        if(isset($_POST['driver_name'])){
			$driver_name = $_POST['driver_name'];
		}
        if(empty($driver_name))
        {
            $driver_error ="Select driver name";
            if(!empty($valid_luggage)) {
                $valid_luggage = $valid_luggage." ".$valid->error_display($form_name, "driver_name", $driver_error, 'select');
            }
            else {
                $valid_luggage = $valid->error_display($form_name, "driver_name", $driver_error, 'select');
            }
        }
        if(isset($_POST['branch_id']))
        {
            $branch_id =$_POST['branch_id'];
        }

        if(isset($_POST['vehicle_id']))
        {
            $vehicle_id = $_POST['vehicle_id'];
        }

        if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['admin_user_type']){
            $godown_id = "";
        }else if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['godown_staff_user_type']){
            if(isset($_POST['godown_id']))
            {
                $godown_id = $_POST['godown_id'];
            }
        }
        if(isset($_POST['lr_id']))
        {
            $lr_id = $_POST['lr_id'];
            if(!empty($lr_id))
            {
                $lr_id = array_reverse($lr_id);
            }
        }

        if(isset($_POST['quantity']))
        {
            $quantity = $_POST['quantity'];
            if(!empty($quantity))
            {
                $quantity = array_reverse($quantity);
            }
        }
       
        if(isset($_POST['unit_id']))
        {
            $unit_id = $_POST['unit_id'];
            if(!empty($unit_id))
            {
                $unit_id = array_reverse($unit_id);
            }
        }
        if(isset($_POST['price_per_qty']))
        {
            $price_per_qty = $_POST['price_per_qty'];
            if(!empty($price_per_qty))
            {
                $price_per_qty = array_reverse($price_per_qty);
            }
        }
        if(isset($_POST['price_per_qty']))
        {
            $price_per_qty = $_POST['price_per_qty'];
            if(!empty($price_per_qty))
            {
                $price_per_qty = array_reverse($price_per_qty);
            }
        }
        if(isset($_POST['bill_type']))
        {
            $bill_type = $_POST['bill_type'];
            if(!empty($bill_type))
            {
                $bill_type = array_reverse($bill_type);
            }
        }
		
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
                    if(!empty($valid_luggage)) {
                        $valid_luggage = $valid_luggage." ".$valid->error_display($form_name, "custom_vehicle_mobile_number", $custom_vehicle_mobile_error, 'text');
                    }
                    else {
                        $valid_luggage = $valid->error_display($form_name, "custom_vehicle_mobile_number", $custom_vehicle_mobile_error, 'text');
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
                    if(!empty($valid_luggage)) {
                        $valid_luggage = $valid_luggage." ".$valid->error_display($form_name, "custom_vehicle_number", $custom_vehicle_number_error, 'text');
                    }
                    else {
                        $valid_luggage = $valid->error_display($form_name, "custom_vehicle_number", $custom_vehicle_number_error, 'text');
                    }
                }
			}
			
			if(empty($custom_vehicle_number) ) {
				$vehicle_id_error = "Select the vehicle or Add custom vehicle details";
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
				if(!empty($valid_luggage)) {
					$valid_luggage = $valid_luggage." ".$valid->error_display($form_name, "vehicle_id", $vehicle_id_error, 'select');
				}
				else {
					$valid_luggage = $valid->error_display($form_name, "vehicle_id", $vehicle_id_error, 'select');
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
				if(!empty($valid_luggage)) {
					$valid_luggage = $valid_luggage." ".$valid->error_display($form_name, "vehicle_id", $vehicle_id_error, 'select');
				}
				else {
					$valid_luggage = $valid->error_display($form_name, "vehicle_id", $vehicle_id_error, 'select');
				}
			}
		}
		
		if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
		}

		$result = "";
		
		if(empty($valid_luggage)  && empty($lr_error)) {
			$check_user_id_ip_address = 0;
			$check_user_id_ip_address = $obj->check_user_id_ip_address();	
			if(preg_match("/^\d+$/", $check_user_id_ip_address)) {

                $bill_company_id = $GLOBALS['bill_company_id'];

				if(!empty($name)) {
					$name_array = "";
					$name_array = explode(" ", $name);
					if(is_array($name_array)) {
						for($n = 0; $n < count($name_array); $n++) {
							if(!empty($name_array[$n])) {
								$name_array[$n] = trim($name_array[$n]);
								$name_array[$n] = strtolower($name_array[$n]);
								$name_array[$n] = ucfirst($name_array[$n]);
							}
							else {
								unset($name_array[$n]);
							}
						}
						$name = implode(" ", $name_array);
					}    
					$name = $obj->encode_decode('encrypt', $name);
				}
                $consignor =array();
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);

                if(empty($vehicle_id)) {

					if(!empty($custom_vehicle_mobile_number)) {
						$custom_vehicle_mobile_number = $obj->encode_decode('encrypt', $custom_vehicle_mobile_number);
					}

                    if(!empty($custom_vehicle_number)) {
						$custom_vehicle_number = $obj->encode_decode('encrypt', $custom_vehicle_number);
					}
					
					
					if(!empty($custom_vehicle_number)) {
						$action = "";
						if(!empty($custom_vehicle_number)) {
							$action = "New vehicle Created. Name - ".$obj->encode_decode('decrypt', $custom_vehicle_number);
						}

						$null_value = $GLOBALS['null_value'];
						$columns = array('created_date_time', 'creator', 'creator_name', 'vehicle_id', 'mobile_number','vehicle_number','lower_case_name','deleted');
						$values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'", "'".$custom_vehicle_mobile_number."'", "'".$custom_vehicle_number."'","'".$lower_case_name."'", "'0'");
						$vehicle_insert_id = $obj->InsertSQL($GLOBALS['vehicle_table'], $columns, $values, $action);						
						if(preg_match("/^\d+$/", $vehicle_insert_id)) {
							$custom_vehicle_id = "";
							if($vehicle_insert_id < 10) {
								$custom_vehicle_id = "VEHICLE_0".$vehicle_insert_id;
							}
							else {
								$custom_vehicle_id = "VEHICLE_".$vehicle_insert_id;
							}
							if(!empty($custom_vehicle_id)) {
								$custom_vehicle_id = $obj->encode_decode('encrypt', $custom_vehicle_id);
							}

							$columns = array(); $values = array();						
							$columns = array('vehicle_id');
							$values = array("'".$custom_vehicle_id."'");
							$vehicle_update_id = $obj->UpdateSQL($GLOBALS['vehicle_table'], $vehicle_insert_id, $columns, $values, '');
							if(preg_match("/^\d+$/", $vehicle_update_id)) {	
								$vehicle_id = $custom_vehicle_id;		
							}
						}
					}
				}
                $quantity_error ="";
                $total_costs = array();
                if(!empty($unit_id))
                {
                    for($i = 0; $i < count($unit_id); $i++) {
                        if(!empty($quantity[$i]) && $quantity[$i] >0){
                            $inv_quantity_error = $valid->valid_number($quantity[$i],'quantity','1');
                            if(empty($inv_quantity_error))
                            {
                                $total_cost = $quantity[$i] * $price_per_qty[$i];
                                $total_costs[] = $total_cost;
                            }
                            else
                            {
                                $quantity_error ="Invalid Quantity";
                            }
                        }
                        else
                        {
                            $quantity_error = "Empty quantity";
                        }
                    }
                
                }
                
                // if(empty($unit_id) && empty($quantity))
                // {
                //     $quantity_error ="select lr ";
                // }
              
                $total_costs_str = implode(',', $total_costs);

                $organization_details = "";
				// if(!empty($organization_id)) {
					$organization_details = $obj->organizationDetails($organization_id, $GLOBALS['organization_table']);
				// }
				if(!empty($vehicle_id)) {
					$vehicle_details = $obj->vehicleDetails($vehicle_id, $GLOBALS['vehicle_table']);
				}
                if(!empty($lr_id)) {
                    $lr_id = implode(",", $lr_id);
                }
                if(!empty($quantity)) {
                    $quantity = implode(",", $quantity);
                }
                
                if(!empty($unit_id)) {
                    $unit_id = implode(",", $unit_id);
                }
                if(!empty($price_per_qty)) {
                    $price_per_qty = implode(",", $price_per_qty);
                }
                if(!empty($helper_name))
                {
                    $helper_name = $obj->encode_decode("encrypt",$helper_name);
                }
				$created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
                $update_stock = 0; 
				if(empty($quantity_error))
                {
                    if(empty($edit_id)) {
                        $action = "";
                        $update_stock = 1;
                        if(!empty($name)) {
                            $action = "New Luggage Created. Name - ".$obj->encode_decode('decrypt', $name);
                        }
                        $null_value = $GLOBALS['null_value'];
                        $columns = array('created_date_time', 'creator', 'creator_name','luggage_id', 'luggagesheet_number','organization_id','lr_id','vehicle_id','luggage_date','driver_name','helper_name','deleted','cancelled','quantity','unit_id','price_per_qty','total','consignor_id','godown_id','organization_details','branch_id');
                        $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$null_value."'","'".$luggagesheet_number."'","'".$organization_id."'", "'".$lr_id."'", "'".$vehicle_id."'", "'".$luggage_date."'","'".$driver_name."'","'".$helper_name."'","'0'",'0',"'".$quantity."'","'".$unit_id."'", "'".$price_per_qty."'","'".$total_costs_str."'","'".$consignor_id."'","'".$godown_id."'","'".$organization_details."'","'".$branch_id."'");
                        $luggage_insert_id = $obj->InsertSQL($GLOBALS['luggagesheet_table'], $columns, $values, $action);		
                        if(preg_match("/^\d+$/", $luggage_insert_id)) {
                            $luggage_id = "";
                            if($luggage_insert_id < 10) {
                                $luggage_id = "LUGGAGE_".date("dmYhis")."_0".$luggage_insert_id;
                            }
                            else {
                                $luggage_id = "LUGGAGE_".date("dmYhis")."_".$luggage_insert_id;
                            }
                            if(!empty($luggage_id)) {
                                $luggage_id = $obj->encode_decode('encrypt', $luggage_id);
                            }
                            $columns = array(); $values = array();						
                            $columns = array('luggage_id');
                            $values = array("'".$luggage_id."'");
                            $luggage_update_id = $obj->UpdateSQL($GLOBALS['luggagesheet_table'], $luggage_insert_id, $columns, $values, '');
                            if(preg_match("/^\d+$/", $luggage_update_id)) {
                                $lr_id = explode(',',$lr_id);
                                $unit_id = explode(',',$unit_id);
                                $quantity = explode(',',$quantity);
    
                               
                                for($i=0;$i<count($lr_id);$i++){
    
                                    $lr_luggage_update = $obj->LrLuggageUpdate($lr_id[$i],$luggagesheet_number);
    
                                    // $checkStockAvail = $obj->checkStockAvail($lr_id[$i],$unit_id[$i],$quantity[$i]);
                                    // if($checkStockAvail == '1'){
                                        // $getUniqueLRID = "";
                                        // $getUniqueLRID = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_id[$i],'id');
                                        // $columns = array(); $values = array();          		
                                        // $columns = array('is_luggage_entry','luggagesheet_number');
                                        // $values = array("'1'","'".$luggagesheet_number."'");
                                        // $updateLR = $obj->UpdateSQL($GLOBALS['lr_table'], $getUniqueLRID, $columns, $values, $action);
                                    // }
    
                                    // if(preg_match("/^\d+$/", $luggage_update_id)) {
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
    
                                    // if(preg_match("/^\d+$/", $luggage_update_id)) {
                                    //     $getUniqueLRID = "";
                                    //     $getUniqueLRID = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_id[$i],'id');
                                    //     $columns = array('quantity', 'unit_id');
                                    //     $values = array("'".$quantity[$i]."'","'".$unit_id[$i]."'");
                                    //     $update_quantity = $obj->UpdateSQL($GLOBALS['luggagesheet_table'],$getUniqueLRID,$columns, $values, $action);
                                    // }
                                }
                                $result = array('number' => '1', 'msg' => 'Luggagesheet Successfully Created');
                                // $result = array('number' => '1', 'msg' => 'lr Successfully Created','lr_id' => $lr_id,'print_type' => $print_type);
                            }
                            else {
                                $result = array('number' => '2', 'msg' => $luggage_update_id);
                            }
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $luggage_insert_id);
                        }
                    }
                    else {
                        $update_stock = 1;
                        if(empty($prev_luggage_id) || $prev_luggage_id == $edit_id) {
                            $getUniqueID = "";
                            $getUniqueID = $obj->getTableColumnValue($GLOBALS['luggagesheet_table'], 'luggage_id', $edit_id, 'id');
                            if(preg_match("/^\d+$/", $getUniqueID)) {
                                $action = "";
                                if(!empty($name)) {
                                    $action = "lr Updated. Name - ".$obj->encode_decode('decrypt', $name);
                                }
                                
                                $columns = array(); $values = array();						
                                $columns = array('creator', 'organization_id','lr_id','vehicle_id','luggage_date','driver_name','helper_name','quantity','unit_id','price_per_qty','total','consignor_id','godown_id','organization_details','branch_id');
                                $values = array("'".$creator."'", "'".$organization_id."'", "'".$lr_id."'", "'".$vehicle_id."'", "'".$luggage_date."'","'".$driver_name."'","'".$helper_name."'","'".$quantity."'","'".$unit_id."'", "'".$price_per_qty."'","'".$total_costs_str."'","'".$consignor_id."'","'".$godown_id."'","'".$organization_details."'","'".$branch_id."'");
                                $luggage_update_id = $obj->UpdateSQL($GLOBALS['luggagesheet_table'], $getUniqueID, $columns, $values, $action);

                                if(preg_match("/^\d+$/", $luggage_update_id)) {
                                    $lr_id = explode(',',$lr_id);
                                    $unit_id = explode(',',$unit_id);
                                    $quantity = explode(',',$quantity);
                                    $prev_lr_list = array();
                                    $prev_lr_list = $obj->getTableRecords($GLOBALS['lr_table'], 'luggagesheet_number', $luggagesheet_number,'');
                                    if(!empty($prev_lr_list)) {
                                        $values = array();
                                        // foreach($prev_lr_list as $row) {
                                        //     if(!empty($row['lr_number']))
                                        //     {
                                        //         $lr_number = $row['id'];
                                        //     }
                                        // }
                                        foreach($prev_lr_list as $data) {
                                            if(!empty($data['lr_id'])) {
                                                if(!in_array($data['lr_id'], $lr_id)) {
                                                    $columns = array(); $values = array();						
                                                    $columns = array('is_luggage_entry','luggagesheet_number','is_cleared');
                                                    $values = array("'0'","''","'0'");
                                                    $sales_invoice_update_id = $obj->UpdateSQL($GLOBALS['lr_table'], $data['id'], $columns, $values, '');
                                                }	
                                            }
                                        }
                                    }

                                    for($i=0;$i<count($lr_id);$i++){
                                        $lr_luggage_update = $obj->LrLuggageUpdate($lr_id[$i],$luggagesheet_number);
                                        // $getUniqueLuggageID = "";
                                        // $getUniqueLuggageID = $obj->getTableColumnValue($GLOBALS['stock_table'],'remarks',$edit_id,'id');
                                        // $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'lr_id','outward_quantity', 'unit_id');
                                        // $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'","'".$lr_id[$i]."'", "'".$quantity[$i]."'","'".$unit_id[$i]."'");
                                        // $stock_insert_id = $obj->UpdateSQL($GLOBALS['stock_table'],$getUniqueLuggageID,$columns, $values, $action);
                                        // if(preg_match("/^\d+$/", $stock_insert_id)) {
                                        //     $update_stock = 0;
                                        // }
                                    }
                                    $result = array('number' => '1', 'msg' => 'Luggaesheet Successfully Created');
                                    // $result = array('number' => '1', 'msg' => 'lr Successfully Created','lr_id' => $lr_id,'print_type' => $print_type);
                                }
                                else {
                                    $result = array('number' => '2', 'msg' => $lr_update_id);
                                }							
                            }
                        }
                        else {
                            $result = array('number' => '2', 'msg' => $lr_error);
                        }
                    }
                }
                else
                {
                    $result = array('number' => '2', 'msg' => $quantity_error);
                }
			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid IP');
			}
		}
		else {
			if(!empty($valid_luggage)) {
				$result = array('number' => '3', 'msg' => $valid_luggage);
			}
            if(!empty($lr_error)) {
				$result = array('number' => '2', 'msg' => $lr_error);
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
        

        $login_staff_id = "";
		if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
			$login_staff_id =  $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
		}
		if(empty($login_staff_id)){
			if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['godown_staff_user_type']) {
				$login_staff_id =  $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			}
		}

		$search_text = ""; $from_date = ""; $to_date = ""; $godown_id =""; $consignee_id = ""; $bill_type = ""; $lr_number = ""; $organization_id = ""; $consignor_id =""; $branch_id =""; $status ="";
		if(isset($_POST['search_text'])) {
			$search_text = $_POST['search_text'];
		}
        if(isset($_POST['from_date']))
        {
            $from_date = $_POST['from_date'];
        }
        if(isset($_POST['to_date']))
        {
            $to_date = $_POST['to_date'];
        }
        if(isset($_POST['branch_id']))
        {
            $branch_id = $_POST['branch_id'];
        }
        if(isset($_POST['consignor_id']))
        {
            $consignor_id = $_POST['consignor_id'];
        }
        if(isset($_POST['godown_id']))
        {
            $godown_id = $_POST['godown_id'];
        }
        
		$total_records_list = array();
		$total_records_list = $obj->getLuggagesheetList($consignor_id,$branch_id,$status,$from_date,$to_date);
		if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($total_records_list)) {
				foreach($total_records_list as $val) {
					if( (strpos(strtolower($val['luggagesheet_number']), $search_text) !== false) ) {
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
		} ?>
        
		<?php if($total_pages > $page_limit) { ?>
			<div class="pagination_cover mt-3"> 
				<?php
					include("pagination.php");
				?> 
			</div> 
		<?php } 
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_module = $GLOBALS['lr_module'];
            $permission_action = $view_action;
            include('user_permission_action.php');
        }
		if(empty($access_error)) {
        ?>
        
		<table class="table nowrap cursor text-center bg-white">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Date <br> Number</th>
                    <th>LR Count</th>
                    <th>Vehicle Name</th>
                    <th>Vehicle Number</th>
                    <th>Driver</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    if(!empty($show_records_list)) {
                        $quantity = array();$total_quantity = 0;
                        // $edit_action = $obj->encode_decode('encrypt', 'edit_action');
                        foreach($show_records_list as $key => $data) {
                            $index = $key + 1; $consignee_name = ""; $consignor_name = "";
                            if(!empty($prefix)) { $index = $index + $prefix; }
                            ?>
                            <tr>
                                <td ><?php echo $index; ?></td>
                                <td>
                                <?php
                                    if(!empty($data['luggage_date'])) {
                                        echo date("d-m-Y", strtotime($data['luggage_date']))."<br>";
                                        if(!empty($data['luggagesheet_number'])) {
                                            echo $data['luggagesheet_number'];
                                        }
                                    }
                                ?>
                                </td>
                                
                                <td>
                                     <?php
                                        if(!empty($data['lr_id'])) {
                                            $lr_ids= explode(",",$data['lr_id']);
                                            $lr_count = count($lr_ids);
                                            echo $lr_count;
                                        }
                                    ?>
                                </td>
                                <td >
                                    <?php 
                                        if(!empty($data['vehicle_id']))
                                        {
                                            $vehicle_name = $obj->getTableColumnValue($GLOBALS['vehicle_table'],'vehicle_id',$data['vehicle_id'],'name');
                                            $vehicle_name = $obj->encode_decode("decrypt",$vehicle_name);
                                            echo $vehicle_name;
                                        }
                                    ?>
                                </td>
                                <td >
                                    <?php 
                                        if(!empty($data['vehicle_id']))
                                        {
                                            $vehicle_number = $obj->getTableColumnValue($GLOBALS['vehicle_table'],'vehicle_id',$data['vehicle_id'],'vehicle_number');
                                            $vehicle_number = $obj->encode_decode("decrypt",$vehicle_number);
                                            echo $vehicle_number;
                                        }
                                    ?>
                                </td>
                                <td >
                                    <?php 
                                        if(!empty($data['driver_name']))
                                        {
                                            $driver_name = $obj->encode_decode("decrypt",$data['driver_name']);
                                            echo $driver_name;
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php $access_error = ""; $delete = 1;
                                        if(!empty($login_staff_id)) {
                                            $permission_module = $GLOBALS['luggagesheet_module'];
                                            $permission_action = $edit_action;
                                            include('user_permission_action.php');
                                            
                                        }
                                        $cleared_luggagesheet_lr_list =array(); $cleared_lr_count =0;
                                        $cleared_luggagesheet_lr_list = $obj->getClearedLuggagesheetLR($data['luggage_id']);
                                        $cleared_lr_count = count($cleared_luggagesheet_lr_list);

                                        if(empty($access_error) && empty($cleared_lr_count)) { ?>
                                        <a class="pr-2" href="#" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['luggage_id'])) { echo $data['luggage_id']; } ?>');"><i class="fa fa-pencil"></i></a>
                                        <?php } ?>
                                        <a class=" pr-2" target="_blank" href="reports/rpt_luggagesheet.php?view_luggagesheet_id=<?php if(!empty($data['luggage_id'])) { echo $data['luggage_id']; } ?>" ><i class="fa fa-print"></i> &ensp; </a>
                                        <?php
                                            $access_error = "";
                                            if(!empty($login_staff_id)) {
                                                $permission_module = $GLOBALS['unit_module'];
                                                $permission_action = $delete_action;
                                                include('user_permission_action.php');

                                            } 
                                            if(empty($access_error)) {
                                                $hide_delete = 1;
                                                    if($delete == 1 && empty($cleared_lr_count)){ ?>
                                                        <a href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['luggage_id'])) { echo $data['luggage_id']; } ?>');"  ><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                <?php 
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
		<?php } ?>
    <?php	
	}
    if(isset($_REQUEST['delete_luggagesheet_id'])) {
		$delete_luggagesheet_id = $_REQUEST['delete_luggagesheet_id'];
        
		$msg = "";
		if(!empty($delete_luggagesheet_id)) {	
			$luggagesheet_id = "";
			$luggagesheet_id = $obj->getTableColumnValue($GLOBALS['luggagesheet_table'], 'luggage_id', $delete_luggagesheet_id, 'id');

            if(preg_match("/^\d+$/", $luggagesheet_id)) {
            	$luggagesheet_number = "";
            	$luggagesheet_number = $obj->getTableColumnValue($GLOBALS['luggagesheet_table'], 'luggage_id', $delete_luggagesheet_id, 'luggagesheet_number');
            
            	$action = "";
            	if(!empty($luggagesheet_number)) {
            		$action = "Luggagesheet Deleted. Name - ".$luggagesheet_number;
            	}
                $lr_id = ""; $lr_ids = array();
                $lr_id = $obj->getTableColumnValue($GLOBALS['luggagesheet_table'],'luggage_id',$delete_luggagesheet_id,'lr_id');
                if(!empty($lr_id))
                {
                    $lr_ids = explode(",",$lr_id);
                    for($i = 0; $i < count($lr_ids); $i++)
                    {
                        $getUniqueID = "";
                        $getUniqueID = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $lr_ids[$i], 'id');
                        if(preg_match("/^\d+$/", $getUniqueID)) {
                            $columns = array(); $values = array();						
                            $columns = array('is_luggage_entry','is_cleared');
                            $values = array("'0'","'0'");
                            $sales_invoice_update_id = $obj->UpdateSQL($GLOBALS['lr_table'], $getUniqueID, $columns, $values, '');
                        }

                        // $stockuniqueID ="";
                        // $stockuniqueID = $obj->getTableColumnValue($GLOBALS['stock_table'],'lr_id',$lr_ids[$i],'id');
                        // if(preg_match("/^\d+$/", $stockuniqueID)) {
                        //     $columns = array(); $values = array();						
                        //     $columns = array('deleted');
                        //     $values = array("'1'");
                        //     $sales_invoice_update_id = $obj->UpdateSQL($GLOBALS['stock_table'], $stockuniqueID, $columns, $values, '');
                        // }
                    }
                }
            	$columns = array(); $values = array();          		
            	$columns = array('deleted');
            	$values = array("'1'");
            	$msg = $obj->UpdateSQL($GLOBALS['luggagesheet_table'], $luggagesheet_id, $columns, $values, $action);
            }
		}
		echo $msg;
		exit;	
	} ?>
    <!-- <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Delete</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div> -->