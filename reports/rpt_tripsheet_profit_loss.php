<?php

    include("../include_user_check_and_files.php");
    include("../include/number2words.php");

    $view_tripsheet_profit_loss_id = "";
    if(isset($_REQUEST['view_tripsheet_profit_loss_id'])) {
        $view_tripsheet_profit_loss_id = $_REQUEST['view_tripsheet_profit_loss_id'];


        $trip_number = ""; $vehicle_id = ""; $driver_name = ""; $from_tripsheet_id = ""; $to_tripsheet_id = "";
        $from_tripsheet_date = ""; $to_tripsheet_date = ""; $from_tripsheet_number = ""; $to_tripsheet_number = "";
        $from_tripsheet_from_branch = ""; $from_tripsheet_to_branch = ""; $to_tripsheet_from_branch = ""; $to_tripsheet_to_branch = "";
        $from_tripsheet_quantity = ""; $from_tripsheet_weight = ""; $to_tripsheet_quantity = ""; $to_tripsheet_weight = "";
        $from_tripsheet_rent = ""; $to_tripsheet_rent = ""; $total_rent = ""; $trip_cost = ""; $balance = ""; $loading_wage = ""; 
        $night_food = ""; $driver_salary = ""; $tire_depreciation = "";
        $toll_gate = ""; $net_balance = ""; $starting_km = ""; $ending_km = ""; $travelled_km = ""; $diesel = ""; $mileage = ""; 
        $trip_balance = ""; $advance = ""; $diesel_cost = ""; $diesel_cost_per_litre = ""; $expense_names = array(); 
        $expense_values = array(); $total_company_expense = 0;

        $tripsheet_profit_loss_list = array();
        $tripsheet_profit_loss_list = $obj->getTableRecords($GLOBALS['tripsheet_profit_loss_table'], 'tripsheet_profit_loss_id', $view_tripsheet_profit_loss_id);
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
                if(!empty($data['company_expense_name']) && $data['company_expense_name'] != $GLOBALS['null_value']) {
                    $company_expense_names = explode(',', $data['company_expense_name']);
                }
                if(!empty($data['company_expense_value']) && $data['company_expense_value'] != $GLOBALS['null_value']) {
                    $company_expense_values = explode(',', $data['company_expense_value']);
                }
            }
        }
    }
    else {
        header("Location: ../tripsheet_profit_loss.php");
        exit;
    }

?>


<html>
<head>
<title>Mohan Transport</title>
<style>
    
    @page {
        margin: 0;
    }
    body {
        margin: 0;
    }

    table 
    {
        width: 100%;
        border-collapse: collapse;
        /* margin-top: 20px; */
    }

    th,td {
        /* border: 1px solid #000; */
        padding: 1px;
        text-align: center;
    }

    .header {
        text-align: center;
    }
    @media print {
        body {
            font-family: 'Roboto', sans-serif;
        }

        thead {
            display: table-header-group;
        }

        
        @page {
            size: A4;
            margin: 40mm 10mm 20mm 10mm;
        }
    }
    
</style>
</head>

<body style="width: 210mm;height :297mm;  font-family: 'Roboto', sans-serif;" id="report_area">
    <div style="padding: 20px;">
        <div style="border:1px solid black;width: 200mm;padding-bottom: 20px">
            <h4 style="text-align: center;"><u>ட்ரிப் சீட் -  வருடம்</u></h4>

            <div class="row" style="padding-bottom: 3px;">
                <div style="width: 100%;">
                    <div style="display: flex;">
                        <div style="width: 30%;">
                            <div style="display: flex;">
                                <div style="width: 34%;text-align:center;padding: 0px;border: 1px solid black;">
                                    <p style="font-size: 12px;text-align:center;margin: 2px;">வண்டி எண்</p>
                                </div>
                                <div style="border: 1px solid black;">
                                    <p style="font-size: 17px;text-align:center;margin: 2px;padding: 6px 5px;"><?php if(!empty($vehicle_number)) { echo $vehicle_number; } ?></p>
                                </div>
                            </div>
                        </div>

                        <div style="width:10%"></div>

                        <div style="width: 30%;">
                            <div style="display: flex;">
                                <div style="width: 30%;border: 1px solid black;text-align:center">
                                    <p style="font-size: 17px;text-align:center;margin: 2px;padding: 6px 5px;"><?php if(!empty($trip_number)) { echo $trip_number; } ?></p>
                                </div>
                                <div style="width: 39%;border: 1px solid black;"><p style="font-size: 16px;text-align:center;margin: 8px;">ட்ரிப்</p></div>    
                            </div>
                        </div>

                        <div style="width:5%"></div>

                        <div style="width: 30%;">
                            
                            <div style="display: flex;">
                                <div style="width: 50%;border: 1px solid black;text-align:center">
                                    <p style="font-size: 14px;text-align:center;margin: 9px;">
                                    டிரைவர்</p>
                                </div>
                                <div style="border: 1px solid black; width:50%">
                                    <p style="font-size: 17px;text-align:center;margin: 2px;padding: 6px 5px;"><?php if(!empty($driver_name)) { echo $driver_name; } ?></p>
                                </div>    
                            </div>

                            
                        </div>

                    </div>
                </div>
            </div>

            <div>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="font-size:15px;">
                            <th style="border-top: 1px solid black; border-right: 1px solid black;width:8%; font-size : 12px;">GDM No</th>
                            <th style="border-top: 1px solid black; border-right: 1px solid black;width:15%">தேதி</th>
                            <th style="border-top: 1px solid black; border-right: 1px solid black;width:35%">ட்ரிப் விபரம்</th>
                            <th style="border-top: 1px solid black; border-right: 1px solid black;width:10%">Bdl</th>
                            <th style="border-top: 1px solid black; border-right: 1px solid black;width:12%">டன்</th>
                            <th style="border-top: 1px solid black; width:20%">வாடகை</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $from_tripsheet_list = array();
                            $from_tripsheet_list = $obj->getTableRecords($GLOBALS['tripsheet_table'], 'tripsheet_id', $from_tripsheet_id);
                            if(!empty($from_tripsheet_list)) {
                                foreach($from_tripsheet_list as $data) { ?>
                                    <tr>
                                        <td style="border-top: 1px solid black; border-right: 1px solid black;width:8%;"></td>
                                        <td style="border-top: 1px solid black; border-right: 1px solid black;width:15%;">
                                            <p style="font-size: 15px;"><?php
                                                if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") {
                                                    echo date('d-m-Y', strtotime($data['tripsheet_date']));
                                                }
                                            ?></p>
                                        </td>
                                        <td style="border-top: 1px solid black; border-right: 1px solid black;width:35%;">
                                            <p style="font-size: 15px;">
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
                                            </p>
                                        </td>
                                        <td style="border-top: 1px solid black; border-right: 1px solid black;width:10%;">
                                            <p style="font-size: 15px;">
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
                                            </p>
                                        </td>
                                        <td style="border-top: 1px solid black; border-right: 1px solid black;width:12%;">
                                            <p style="font-size: 15px;">
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
                                            </p>
                                        </td>
                                        <td style="border-top: 1px solid black; width:20%;">
                                            <p style="text-align: right; padding-right: 5px; font-size: 15px;">
                                                <?php if(!empty($from_tripsheet_rent)) { echo $obj->numberFormat($from_tripsheet_rent,2); } ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } 
                            $to_tripsheet_list = array();
                            $to_tripsheet_list = $obj->getTableRecords($GLOBALS['tripsheet_table'], 'tripsheet_id', $to_tripsheet_id);
                            if(!empty($to_tripsheet_list)) {
                                foreach($to_tripsheet_list as $data) { ?>
                                    <tr>
                                        <td style="border-top: 1px solid black; border-right: 1px solid black;width:8%;"></td>
                                        <td style="border-top: 1px solid black; border-right: 1px solid black;width:15%;">
                                            <p style="font-size: 15px;"><?php
                                                if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != "0000-00-00") {
                                                    echo date('d-m-Y', strtotime($data['tripsheet_date']));
                                                }
                                            ?></p>
                                        </td>
                                        <td style="border-top: 1px solid black; border-right: 1px solid black;width:35%;">
                                            <p style="font-size: 15px;">
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
                                            </p>
                                        </td>
                                        <td style="border-top: 1px solid black; border-right: 1px solid black;width:10%;">
                                            <p style="font-size: 15px;">
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
                                            </p>
                                        </td>
                                        <td style="border-top: 1px solid black; border-right: 1px solid black;width:12%;">
                                            <p style="font-size: 15px;">
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
                                            </p>
                                        </td>
                                        <td style="border-top: 1px solid black; width:20%;">
                                            <p style="text-align: right; padding-right: 5px; font-size: 15px;">
                                                <?php if(!empty($to_tripsheet_rent)) { echo $obj->numberFormat($to_tripsheet_rent,2); } ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } 
                        ?>

                        
                        <tr>
                            <td style="border-top: 1px solid black; border-right: 1px solid black;width:8%; padding:10px;border-bottom: 1px solid black;"></td>
                            <td style="border-top: 1px solid black; border-right: 1px solid black;width:15%; padding:10px;border-bottom: 1px solid black;"></td>
                            <td style="border-top: 1px solid black; border-right: 1px solid black;width:35%; padding:10px;border-bottom: 1px solid black;"></td>
                            <td style="border-top: 1px solid black; border-right: 1px solid black;width:22%;text-align:end" colspan="2">மொத்த வாடகை</td>
                            <td style="border-top: 1px solid black;border-bottom: 1px solid black; width:20%;">
                                <p style="text-align: right; padding-right: 5px; font-size: 15px;">
                                    <?php
                                        if(!empty($total_rent)) {
                                            echo $obj->numberFormat($total_rent,2);
                                        }
                                    ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="width: 100%;">
                <div style="display: flex;">
                    
                    <div style="width: 50%;">
                        <div>
                            <h4 style="margin: 10px 0px 4px 0px; text-align:center;"><u>கம்பெனி செலவுகள்</u></h4>
                            <div style="margin: 0 0 0 10px;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <?php if(empty($company_expense_names)) { ?>
                                        <tr>
                                            <td style="border: 1px solid black;width:65%;text-align:center;">பூஜை</td>
                                            <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;width:35%; padding:10px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black;width:65%;text-align:center;">சாப்பாடு படி</td>
                                            <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;width:35%; padding:10px;"></td>
                                        </tr>
                                        <?php } else { 
                                            if(!empty($company_expense_names)) {
                                                for($i=0; $i < count($company_expense_names); $i++) { ?>
                                                    <tr>
                                                        <td style="border: 1px solid black;width:65%;text-align:center;">
                                                            <p>
                                                                <?php
                                                                    if(!empty($company_expense_names[$i])) {
                                                                        echo $company_expense_names[$i];
                                                                    }
                                                                ?>
                                                            </p>
                                                        </td>
                                                        <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;width:35%;"><p style="text-align: right; padding-right: 5px; font-size: 15px;">
                                                            <?php if(!empty($company_expense_values[$i])) { echo $obj->numberFormat($company_expense_values[$i],2);
                                                            $total_company_expense +=$company_expense_values[$i]; } ?>
                                                        </p></td>
                                                    </tr>
                                                    <?php
                                                }
                                            } 
                                        } ?>
                                        <tr>
                                            <td style="border: 1px solid black;width:65%;text-align:center;">மொத்த கம்பெனி செலவுகள்</td>
                                            <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;width:35%;">
                                                <p style="text-align: right; padding-right: 5px; font-size: 15px;">
                                                <?php if(!empty($total_company_expense)) { 
                                                    echo $obj->numberFormat($total_company_expense,2); } ?>
                                                </p>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <h4 style="margin: 10px 0px 4px 0px; text-align:center;"><u>டிரைவர் செலவுகள்</u></h4>
                            <div style="margin: 0 0 0 10px;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <?php if(empty($expense_names)) { ?>
                                        <tr>
                                            <td style="border: 1px solid black;width:65%;text-align:center;">பூஜை</td>
                                            <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;width:35%; padding:10px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black;width:65%;text-align:center;">சாப்பாடு படி</td>
                                            <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;width:35%; padding:10px;"></td>
                                        </tr>
                                        <?php } else { 
                                            if(!empty($expense_names)) {
                                                for($i=0; $i < count($expense_names); $i++) { ?>
                                                    <tr>
                                                        <td style="border: 1px solid black;width:65%;text-align:center;">
                                                            <p>
                                                                <?php
                                                                    if(!empty($expense_names[$i])) {
                                                                        echo $expense_names[$i];
                                                                    }
                                                                ?>
                                                            </p>
                                                        </td>
                                                        <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;width:35%;"><p style="text-align: right; padding-right: 5px; font-size: 15px;">
                                                            <?php if(!empty($expense_values[$i])) { echo $obj->numberFormat($expense_values[$i],2); } ?>
                                                        </p></td>
                                                    </tr>
                                                    <?php
                                                }
                                            } 
                                        } ?>
                                        <tr>
                                            <td style="border: 1px solid black;width:65%;text-align:center;">டீசல் <?php if(!empty($diesel)) { echo $diesel; } ?> லிட்டர் * <?php if(!empty($diesel_cost_per_litre)) { echo $diesel_cost_per_litre; } ?>  </td>
                                            <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;width:35%;"><p style="text-align: right; padding-right: 5px; font-size: 15px;">
                                                <?php if(!empty($diesel_cost)) { echo $obj->numberFormat($diesel_cost,2); } ?>
                                            </p></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black;width:65%;text-align:center;">ட்ரிப் செலவுகள்</td>
                                            <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;width:35%;"><p style="text-align: right; padding-right: 5px; font-size: 15px;">
                                                <?php if(!empty($trip_cost)) { echo $obj->numberFormat($trip_cost,2); } ?>
                                            </p></td>
                                        </tr>
                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div style="width: 50%;">
                        <div style="margin: 0 0px 0 60px;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;text-align:end">ட்ரிப் செலவுகள்</td>
                                        <td style="width:47%;border-bottom: 1px solid black;"><p style="text-align: right; padding-right: 5px;font-size: 15px;">
                                            <?php if(!empty($trip_cost)) { echo $obj->numberFormat($trip_cost,2); } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;text-align:end">மிச்சம்</td>
                                        <td style="width:47%;border-bottom: 1px solid black;"><p style="text-align: right; padding-right: 5px;font-size: 15px;">
                                            <?php if(!empty($trip_balance)) { echo $obj->numberFormat($trip_balance,2); } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;text-align:end">Svk ஏத்து கூலி</td>
                                        <td style="width:47%;border-bottom: 1px solid black;"><p style="text-align: right; padding-right: 5px;font-size: 15px;">
                                            <?php if(!empty($loading_wage)) { echo $obj->numberFormat($loading_wage,2); } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;text-align:end">நைட் சாப்பாடு</td>
                                        <td style="width:47%;border-bottom: 1px solid black;"><p style="text-align: right; padding-right: 5px;font-size: 15px;">
                                            <?php if(!empty($night_food)) { echo $obj->numberFormat($night_food,2); } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;text-align:end">டிரைவர் சம்பளம்</td>
                                        <td style="width:47%;border-bottom: 1px solid black;"><p style="text-align: right; padding-right: 5px;font-size: 15px;">
                                            <?php if(!empty($driver_salary)) { echo $obj->numberFormat($driver_salary,2); } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;text-align:end">டயர் தேய்மானம்</td>
                                        <td style="width:47%;border-bottom: 1px solid black;"><p style="text-align: right; padding-right: 5px;font-size: 15px;">
                                            <?php if(!empty($tire_depreciation)) { echo $obj->numberFormat($tire_depreciation,2); } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;text-align:end">டோல் கேட்</td>
                                        <td style="width:47%;border-bottom: 1px solid black;"><p style="text-align: right; padding-right: 5px;font-size: 15px;">
                                            <?php if(!empty($toll_gate)) { echo $obj->numberFormat($toll_gate,2); } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;border-bottom: 1px solid black;text-align:end">நிகர மிச்சம்</td>
                                        <td style="width:47%;border-bottom: 1px solid black;"><p style="text-align: right; padding-right: 5px;font-size: 15px;">
                                            <?php if(!empty($net_balance)) { echo $obj->numberFormat($net_balance,2); } ?>
                                        </p></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div style="margin: 25px 0px 0 60px;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;text-align:end">முடிவு Km</td>
                                        <td style="width:47%;border-bottom: 1px solid black;border-top: 1px solid black;"><p style="font-size: 15px;">
                                            <?php if(!empty($ending_km)) { echo $ending_km; } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;text-align:end">ஆரம்ப Km</td>
                                        <td style="width:47%;border-bottom: 1px solid black;"><p style="font-size: 15px;">
                                            <?php if(!empty($starting_km)) { echo $starting_km; } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;text-align:end">ஓடிய km</td>
                                        <td style="width:47%;border-bottom: 1px solid black;"><p style="font-size: 15px;">
                                            <?php if(!empty($travelled_km)) { echo $travelled_km; } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;text-align:end">டீசல் (லிட்டர்)</td>
                                        <td style="width:47%;border-bottom: 1px solid black;"><p style="font-size: 15px;">
                                            <?php if(!empty($diesel)) { echo $diesel; } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:52%;border-bottom: 1px solid black;text-align:end">மைல்லேஜ்</td>
                                        <td style="width:47%;border-bottom: 1px solid black;"><p style="font-size: 15px;"><?php if(!empty($mileage)) { echo $mileage; } ?> பாயிண்ட்
                                        </p></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div style="margin: 25px 0px 0 30px;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:56%;text-align:end">ட்ரிப் மிச்சம்</td>
                                        <td style="border-bottom: 1px solid black;border-top: 1px solid black;width:44%;"><p style="text-align: right; padding-right: 5px;font-size: 15px;">
                                            <?php if(!empty($trip_balance)) { echo $obj->numberFormat($trip_balance,2); } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:56%;text-align:end">அட்வான்ஸ்</td>
                                        <td style="border-bottom: 1px solid black;border-top: 1px solid black;width:44%;"><p style="text-align: right; padding-right: 5px;font-size: 15px;">
                                            <?php if(!empty($advance)) { echo $obj->numberFormat($advance,2); } ?>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;width:56%;text-align:end;border-bottom: 1px solid black;">டீசல் செலவு</td>
                                        <td style="border-bottom: 1px solid black;width:44%;"> <p style="text-align: right; padding-right: 5px;font-size: 15px;">
                                            <?php if(!empty($diesel_cost)) { echo $obj->numberFormat($diesel_cost,2); } ?>
                                        </p></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="width: 200.5mm;padding-top: 3px;">
            <div style="width: 100%;">
                <div style="display: flex;">
                    <div style="width: 60%;">
                        <div style="border: 1px solid black;height: 70px;">
                            <p style="margin: 0;"><u>முக்கிய குறிப்புகள் : </u></p>
                        </div>
                    </div>
                    <div style="width: 40%">
                        <div style="border-top: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black;height: 70px;">
                            <p style="text-align: end;margin: 0;position: relative;bottom: -44px;right: 10px;">கணக்கு வாங்கியது</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-bottom-buffer"></div>
        </div>
        
    </div>
    
</body>
</html>