if(!empty($edit_id)){
            if(isset($_POST['hidden_driver_expense_type'])) {
                $hidden_driver_expense_type = trim($_POST['hidden_driver_expense_type']);
            }
            if(isset($_POST['hidden_company_expense_type'])) {
                $hidden_company_expense_type = trim($_POST['hidden_company_expense_type']);
            }
        }
        function combineAndSumUp ($myArray) {
            $finalArray = Array ();
            foreach ($myArray as $nkey => $nvalue) {
                $has = false;
                $fk = false;
                foreach ($finalArray as $fkey => $fvalue) {
                    if(($fvalue['tax_type'] == $nvalue['tax_type']) && ($fvalue['payment_mode_id'] == $nvalue['payment_mode_id']) && ($fvalue['bank_id'] == $nvalue['bank_id'])) {    
                        $has = true;
                        $fk = $fkey;
                        break;
                    }
                }
    
                if($has === false) {
                    $finalArray[] = $nvalue;
                } else {
                    $finalArray[$fk]['tax_type'] = $nvalue['tax_type'];
                    $finalArray[$fk]['payment_mode_id'] = $nvalue['payment_mode_id'];
                    $finalArray[$fk]['bank_id'] = $nvalue['bank_id'];
                    $finalArray[$fk]['expense_amount'] += $nvalue['expense_amount'];
                }
            }
            return $finalArray;
        }

        if(isset($_POST['expense_id'])) {
            $expense_id = $_POST['expense_id'];
            $expense_id = trim($expense_id);
        }  
 
        if(isset($_POST['tripsheet_status'])) {
            $tripsheet_status = $_POST['tripsheet_status'];
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