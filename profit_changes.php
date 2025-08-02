<?php
    include("include_files.php");

if(isset($_REQUEST['checkvalidation'])){
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
        $edit_id = ""; $form_name = "tripsheet_profit_loss_form"; $valid_tripsheet_profit_loss = ""; $company_expense_type = ""; $driver_expense_type = "";$expense_id = ""; $payment_updation = 0;     $driver_diesel_amount = ""; $company_diesel_amount = "";
        $hidden_driver_expense_type = ""; $hidden_company_expense_type = "";
        $expense_date = ""; $expense_date_error = ""; $valid_expense = "";     $payment_tax_types = array();
        $payment_mode_ids = array(); $bank_ids = array(); $bank_names = array(); $payment_mode_names = array(); $amount = array(); $total_amount = 0; $payment_error = ""; $narration = ""; $narration_error = ""; $selected_payment_mode_id = "";


        if(isset($_POST['edit_id'])) {
            $edit_id = trim($_POST['edit_id']);
        }

        // if(!empty($edit_id)){
        //     if(isset($_POST['hidden_driver_expense_type'])) {
        //         $hidden_driver_expense_type = trim($_POST['hidden_driver_expense_type']);
        //     }
        //     if(isset($_POST['hidden_company_expense_type'])) {
        //         $hidden_company_expense_type = trim($_POST['hidden_company_expense_type']);
        //     }
          
        // }
        if(isset($_POST['expense_id'])) {
            $expense_id = $_POST['expense_id'];
            $expense_id = trim($expense_id);
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

        if(isset($_POST['company_expense_type'])) {
            $company_expense_type = trim($_POST['company_expense_type']);
            $company_expense_type_error = $valid->common_validation($company_expense_type, 'Driver Name', 'radio');
            if(!empty($company_expense_type_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'company_expense_type', $company_expense_type_error, 'radio');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'company_expense_type', $company_expense_type_error, 'radio');
                }
            }
        }
        if(isset($_POST['driver_expense_type'])) {
            $driver_expense_type = trim($_POST['driver_expense_type']);
            $driver_expense_type_error = $valid->common_validation($driver_expense_type, 'Driver Expense Type', 'radio');
            if(!empty($driver_expense_type_error)) {
                if(!empty($valid_tripsheet_profit_loss)) {
                    $valid_tripsheet_profit_loss = $valid_tripsheet_profit_loss." ".$valid->error_display($form_name, 'driver_expense_type', $driver_expense_type_error, 'radio');
                }
                else {
                    $valid_tripsheet_profit_loss = $valid->error_display($form_name, 'driver_expense_type', $driver_expense_type_error, 'radio');
                }
            }
        }


        if(isset($_POST['company_diesel_amount'])) {
            $company_diesel_amount = $_POST['company_diesel_amount'];
            $company_diesel_amount = trim($company_diesel_amount);
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

        }else{
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

        
        if(isset($_POST['company_diesel_amount'])) {
            $company_diesel_amount = $_POST['company_diesel_amount'];
            $company_diesel_amount = trim($company_diesel_amount);
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

        }else{
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
            $payment_updation = 1;
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

              $result = "";
        if(empty($valid_tripsheet_profit_loss) && empty($expense_error)) {
            $result = array('number' => '1', 'msg' => 'Tripsheet Profit Loss Successfully Created','redirection_page' =>'tripsheet_profit_loss.php','tripsheet_profit_loss_id' => '');
        }         
        else{
            if(!empty($valid_tripsheet_profit_loss)) {
                $result = array('number' => '3', 'msg' => $valid_tripsheet_profit_loss);            
            }else if(!empty($expense_error)) {
                $result = array('number' => '2', 'msg' => $expense_error);            
            }
        }
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;  
}


if (isset($_REQUEST['get_driver_payment_mode_id'])) {
    $payment_mode_id = trim($_REQUEST['get_driver_payment_mode_id']);
    $bank_id = trim($_REQUEST['get_bank_id']);
    $payment_tax_type = trim($_REQUEST['get_payment_tax_type']);
    if(!empty($payment_tax_type) && !empty($payment_mode_id)){
        $total_amount = 0;
        $total_amount = $obj->GetPaymentAmount($payment_tax_type,$payment_mode_id, $bank_id, $login_branch_id);
        if(!empty($total_amount)){
             echo $total_amount;
        }else{
            echo "0";
        }           
    }                                                     
}

if(isset($_REQUEST['driver_payment_row_index'])) {
    $payment_row_index = $_REQUEST['driver_payment_row_index'];

    $payment_mode_id = $_REQUEST['selected_payment_mode_id'];
    $payment_mode_id = trim($payment_mode_id);

    $bank_id = $_REQUEST['selected_bank_id'];
    $bank_id = trim($bank_id);

    $amount = $_REQUEST['selected_amount'];
    $amount = trim($amount);
    $payment_tax_type = $_REQUEST['payment_tax_type'];
    $payment_tax_type = trim($payment_tax_type);
    ?>
    <tr class="driver_payment_row" id="driver_payment_row<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>">
        <td class="sno text-center">
            <?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>
        </td>
           <?php if(!empty($payment_tax_type)) { ?>
                <td>
                <?php 
                        /* if(!empty($payment_tax_type)) { ?>
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <select name="payment_tax_type" class="select2 select2-danger smallfnt form-control" style="width:100% !important;">
                                        <option value="">Select Tax type</option>
                                        <option value="1" <?php if(!empty($payment_tax_type) && ($payment_tax_type == 1)) { ?> selected <?php } ?>>with tax</option>
                                        <option value="2" <?php if(!empty($payment_tax_type) && ($payment_tax_type == 2)) { ?> selected <?php } ?>>without tax</option>
                                    </select>
                                    <label>Tax Type <span class="text-danger">*</span></label>
                                </div>
                            </div>
                    <?php } */ 
                    if(!empty($payment_tax_type)) {
                            if($payment_tax_type == 1) {
                                echo "With Tax"; 
                            } else {
                                echo "Without Tax";
                            } 
                    }  ?>
                    <input type="hidden" name="driver_payment_tax_type[]" value="<?php if(!empty($payment_tax_type)) { echo $payment_tax_type; } ?>">
                </td>
        <?php } ?>
        <td class="text-center">
            <?php
                $payment_mode_name = "";
                $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_id, 'payment_mode_name');
                echo $obj->encode_decode('decrypt', $payment_mode_name);
            ?>
            <input type="hidden" name="driver_payment_mode_id[]" value="<?php if(!empty($payment_mode_id)) { echo $payment_mode_id; } ?>">
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
            <input type="hidden" name="driver_bank_id[]" value="<?php if(!empty($bank_id)) { echo $bank_id; } ?>">
        </td>
        <td class="text-center">
            <input type="text" name="driver_amount[]" style="width:75%!important;margin:auto!important;" class="form-control shadow-none px-1 text-center" value="<?php if(!empty($amount)) { echo $amount; } ?>" onfocus="Javascript:KeyboardControls(this,'number','','');" onkeyup="Javascript:PaymentDriverRowTotal();InputBoxColor(this, 'text');">
        </td>
        
        <td class="text-center">
            <button class="btn btn-danger" type="button" onclick="Javascript:DeleteDriverRow('driver_payment_row', '<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>');"><i class="fa fa-trash"></i></button>
        </td>
    </tr>
    <?php
}


?>