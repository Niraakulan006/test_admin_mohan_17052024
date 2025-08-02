<?php 
    class Payment_functions extends Basic_Functions {
        public function UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type, $payment_tax_type, $branch_id){
            $query = ""; $list = array(); $unique_id = ""; $cash_balance = 0; $lr_id = "";
        
            if($bill_type == "Voucher" || $bill_type == "Receipt" || $bill_type == "Expense" || $bill_type == "Suspense Voucher" || $bill_type == "Suspense Receipt" || $bill_type == "Invest" || $bill_type == "Return" || $bill_type == "Company"){
                $query = "SELECT id FROM ".$GLOBALS['payment_table']." WHERE bill_id = '".$bill_id."' AND payment_mode_id = '".$payment_mode_id."' AND bank_id = '". $bank_id."' AND payment_tax_type = '". $payment_tax_type."' AND deleted = '0'";
            } 
            else if($party_type == "Branch") {
                $query = "SELECT id FROM ".$GLOBALS['payment_table']." WHERE bill_id = '".$bill_id."' AND payment_tax_type = '". $payment_tax_type."' AND deleted = '0'";
            }
            else {
                $query = "SELECT id FROM " . $GLOBALS['payment_table'] . " WHERE bill_id = '" . $bill_id . "' AND deleted = '0'";
            }
            if(empty($branch_id)) {
                $branch_id = $GLOBALS['null_value'];
            }

            $payment_tax_type = trim($payment_tax_type);
        
            $list = $this->getQueryRecords('', $query);
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $unique_id = $data['id'];
                    }
                }
            }
            if($bill_type == "Receipt"){
                $lr_id = $this->getTableColumnValue($GLOBALS['receipt_table'], 'receipt_id', $bill_id, 'lr_id');
            }
            if($bill_type == "LR Entry"){
                $lr_id = $bill_id;
            }
            if(empty($lr_id)){
                $lr_id = $GLOBALS['null_value'];
            }
           if($bill_type == 'Branch Tax Opening' || $bill_type == 'Branch Opening Balance'){
                $payment_mode_id = $this->getTableColumnValue($GLOBALS['payment_mode_table'],'cash_balance','1','payment_mode_id');
            }
            if(!empty($payment_mode_id) && $payment_mode_id != $GLOBALS['null_value']){
                $cash_balance = $this->getTableColumnValue($GLOBALS['payment_mode_table'],'payment_mode_id',$payment_mode_id,'cash_balance');
            }
        
            $bill_date = date('Y-m-d',strtotime($bill_date));
        
            $created_date_time = $GLOBALS['create_date_time_label'];
            $creator = $GLOBALS['creator'];
            $creator_name = $GLOBALS['creator_name'];
            $bill_company_id = $GLOBALS['bill_company_id'];

            if(preg_match("/^\d+$/", $unique_id)) {
                $action = "Updated Successfully";
                $columns = array(); $values = array();
                $columns = array('creator_name', 'bill_company_id','bill_date','party_id','party_name','party_type','branch_id','bank_id','bank_name','payment_mode_id','payment_mode_name','open_balance_type','credit','debit', 'payment_tax_type','cash_balance','lr_id');
                $values = array("'".$creator_name."'", "'".$bill_company_id."'","'".$bill_date."'", "'".$party_id."'","'".$party_name."'","'".$party_type."'","'".$branch_id."'","'".$bank_id."'","'".$bank_name."'","'".$payment_mode_id."'","'".$payment_mode_name."'","'".$open_balance_type."'","'".$credit."'","'".$debit."'", "'".$payment_tax_type."'","'".$cash_balance."'","'".$lr_id."'");
                $payment_update_id = $this->UpdateSQL($GLOBALS['payment_table'], $unique_id, $columns, $values, $action);
            }
            else {
                $action = "Inserted Successfully";
                $null_value = $GLOBALS['null_value'];
                $columns = array(); $values = array();
                $columns = array('bill_company_id','created_date_time','creator', 'creator_name', 'bill_id','bill_number','bill_date','bill_type', 'party_id','party_name','party_type','branch_id','bank_id','bank_name','payment_mode_id','payment_mode_name','open_balance_type', 'credit','debit','payment_tax_type', 'cash_balance', 'lr_id','deleted');
                $values = array("'".$GLOBALS['bill_company_id']."'","'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_id."'","'".$bill_number."'","'".$bill_date."'","'".$bill_type."'", "'".$party_id."'","'".$party_name."'","'".$party_type."'","'".$branch_id."'","'".$bank_id."'","'".$bank_name."'","'".$payment_mode_id."'","'".$payment_mode_name."'", "'".$open_balance_type."'", "'".$credit."'","'".$debit."'","'".$payment_tax_type."'","'".$cash_balance."'","'".$lr_id."'","'0'");
                $payment_insert_id = $this->InsertSQL($GLOBALS['payment_table'], $columns, $values,$action);
            }
        }
        public function DeleteBranchPayment($bill_id, $branch_id, $payment_tax_type) {
            $select_query = ""; $list = array();
            if(!empty($branch_id) && !empty($payment_tax_type)) {
                $select_query = "SELECT id FROM ".$GLOBALS['payment_table']." WHERE bill_id = '".$bill_id."' AND branch_id = '".$branch_id."' AND payment_tax_type = '".$payment_tax_type."' AND deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $columns = array(); $values = array();
                        $columns = array('deleted');
                        $values = array('"1"');
                        $msg = $this->UpdateSQL($GLOBALS['payment_table'], $data['id'], $columns, $values, '');
                    }
                }
            }
        }
        public function DeletePayment($bill_id){
            $payment_bill_list = array(); $payment_unique_id = "";

            $payment_bill_list = $this->getTableRecords($GLOBALS['payment_table'], 'bill_id', $bill_id,'');
            if(!empty($payment_bill_list)){
                foreach($payment_bill_list as $value){
                    if(!empty($value['id'])){
                        $payment_unique_id = $value['id'];
                    }
                    if(preg_match("/^\d+$/", $payment_unique_id)) {
                        $action = "Payment Deleted.";
                    
                        $columns = array(); $values = array();						
                        $columns = array('deleted');
                        $values = array("'1'");
                        $msg = $this->UpdateSQL($GLOBALS['payment_table'], $payment_unique_id, $columns, $values, $action);
                    }
                }
            }
        }
        public function getPartyOpeningBalanceInPaymentExist($party_id, $bill_type) {
            $list = array(); $select_query = ""; $id = ""; $where = ""; $payment_id = "";
        
            if(!empty($party_id)){
                if(!empty($where)) {
                    $where = $where." party_id = '".$party_id."' AND ";
                }
                else {
                    $where = "party_id = '".$party_id."' AND ";
                }
            }
            if(!empty($bill_type)){
                if(!empty($where)) {
                    $where = $where." bill_type = '".$bill_type."' AND ";
                }
                else {
                    $where = "bill_type = '".$bill_type."' AND ";
                }
            }
            if(!empty($where)) {
                $select_query = "SELECT id FROM ".$GLOBALS['payment_table']." WHERE ".$where." deleted='0'";    
            }
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $payment_id = $data['id'];
                    }
                }
            }
            return $payment_id;
        }
        public function getPaymentUniqueID($bill_id, $payment_mode_id, $bank_id, $payment_tax_type) {
            $where = "";
            $select_query = "";
            $list = array();
            $unique_id = "";
            $bill_company_id = $GLOBALS['bill_company_id'];

            if (!empty($bill_company_id)) {
                $where = " bill_company_id = '" . $bill_company_id . "' AND ";
            }

            if (!empty($payment_mode_id) && $payment_mode_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " payment_mode_id = '" . $payment_mode_id . "' AND ";
                } else {
                    $where = " payment_mode_id = '" . $payment_mode_id . "' AND ";
                }
            }

            if (!empty($bank_id) && $bank_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " bank_id = '" . $bank_id . "' AND ";
                } else {
                    $where = " bank_id = '" . $bank_id . "' AND ";
                }
            }
            if (!empty($payment_tax_type) && $payment_tax_type != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " payment_tax_type = '" . $payment_tax_type . "' AND ";
                } else {
                    $where = " payment_tax_type = '" . $payment_tax_type . "' AND ";
                }
            }
            if (!empty($bill_id) && $bill_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " bill_id = '" . $bill_id . "' AND ";
                } else {
                    $where = " bill_id = '" . $bill_id . "' AND ";
                }
            }
        
            if (!empty($where)) {
                $select_query = "SELECT id FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            if (!empty($list)) {
                foreach ($list as $data) {
                    if (!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $unique_id = $data['id'];
                    }
                }
            }

            return $unique_id;
        }
        public function PrevPaymentList($bill_unique_id) {
            $select_query = "";
            $list = array();
            $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE bill_id = '" . $bill_unique_id . "' AND deleted = '0'";
            $list = $this->getQueryRecords('', $select_query);
            return $list;
        }
        public function DeleteCompanyOpeningBalance($organization_id,$payment_mode_id, $bank_id, $payment_tax_type) {
            $where = "";
            $select_query = "";
            $list = array();
            $unique_id = "";
            $bill_company_id = $GLOBALS['bill_company_id'];

            if (!empty($bill_company_id)) {
                $where = " bill_company_id = '" . $bill_company_id . "' AND ";
            }

            if (!empty($payment_mode_id) && $payment_mode_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " payment_mode_id = '" . $payment_mode_id . "' AND ";
                } else {
                    $where = " payment_mode_id = '" . $payment_mode_id . "' AND ";
                }
            }

            if (!empty($bank_id) && $bank_id != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " bank_id = '" . $bank_id . "' AND ";
                } else {
                    $where = " bank_id = '" . $bank_id . "' AND ";
                }
            }
            if (!empty($payment_tax_type) && $payment_tax_type != $GLOBALS['null_value']) {
                if (!empty($where)) {
                    $where = $where . " payment_tax_type = '" . $payment_tax_type . "' AND ";
                } else {
                    $where = " payment_tax_type = '" . $payment_tax_type . "' AND ";
                }
            }

            if (!empty($where)) {
                $select_query = "SELECT id FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " bill_type ='Voucher' AND deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            if (!empty($list)) {
                foreach ($list as $data) {
                    if (!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $unique_id = $data['id'];
                    }
                }
            }

            return $unique_id;
        }
        public function checkAvailableBalance($bill_company_id, $tax_type, $payment_mode_id, $bank_id) {
            $list = array(); $select_query = ""; $id = ""; $where = ""; $payment_id = ""; $total_credit = 0; $total_debit = 0;
            $balance = 0;
        
            if(!empty($bill_company_id)){
                if(!empty($where)) {
                    $where = $where." bill_company_id = '".$bill_company_id."' AND ";
                }
                else {
                    $where = "bill_company_id = '".$bill_company_id."' AND ";
                }
            }
            if(!empty($tax_type)){
                if(!empty($where)) {
                    $where = $where." payment_tax_type = '".$tax_type."' AND ";
                }
                else {
                    $where = "payment_tax_type = '".$tax_type."' AND ";
                }
            }
            if(!empty($payment_mode_id)){
                if(!empty($where)) {
                    $where = $where." payment_mode_id = '".$payment_mode_id."' AND ";
                }
                else {
                    $where = "payment_mode_id = '".$payment_mode_id."' AND ";
                }
            }
            if(!empty($bank_id)){
                if(!empty($where)) {
                    $where = $where." bank_id = '".$bank_id."' AND ";
                }
                else {
                    $where = "bank_id = '".$bank_id."' AND ";
                }
            }

            if(!empty($where)) {
                $select_query = "SELECT SUM(credit) as total_credit, SUM(debit) as total_debit FROM ".$GLOBALS['payment_table']." WHERE ".$where."  bill_type NOT IN ('Purchase Entry', 'LR Entry') AND deleted='0'";    
            }
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    $total_credit += $data['total_credit'];
                    $total_debit += $data['total_debit']; 
                }
            }
            $balance = $total_credit - $total_debit;
            return $balance;
        }
        public function getPartyList($type) {
            $select_query = "";
            if($type == 'Purchase'){
                $select_query = "SELECT * FROM ".$GLOBALS['party_table']." WHERE party_type ='1' AND deleted ='0'";
            }
            $list = $this->getQueryRecords($GLOBALS['party_table'],$select_query);
            return $list;
        }
        public function getVoucherList($from_date, $to_date, $show_bill, $filter_party_id) {
            $list = array(); $select_query = ""; $where = "";

            if(!empty($filter_party_id)) {
                $where = "party_id = '" . $filter_party_id . "'";
            }

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where . " AND voucher_date >= '" . $from_date . "'";
                } else {
                    $where = "voucher_date >= '" . $from_date . "'";
                }
            }

            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where . " AND voucher_date <= '" . $to_date . "'";
                } else {
                    $where = "voucher_date <= '" . $to_date . "'";
                }
            }

            if($show_bill == '0' || $show_bill == '1') {
                if(!empty($where)) {
                    $where = $where . " AND deleted = '" . $show_bill . "' ";
                } else {
                    $where = "deleted = '" . $show_bill . "' ";
                }
            }

            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['voucher_table'] . " WHERE " . $where . " ORDER BY id DESC";
            } 
            else {
                $select_query = "SELECT * FROM " . $GLOBALS['voucher_table'] . " WHERE deleted = '0' ORDER BY id DESC";
            }
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['voucher_table'], $select_query);
            }
            return $list;
        }
        public function GetPaymentAmountoldd($payment_tax_type,$payment_mode_id, $bank_id, $login_branch_id) {
            $list = array(); $select_query = ""; $where = "";$credit = 0;$debit =0;$total_amount =0; $cash_balance = 0;


                    // print_r($login_branch_id)
            // if(!empty($login_branch_id)){
            //     // if(is_array($login_branch_id)) {
			// 		for($i=0; $i < count($login_branch_id); $i++) {

            //             if(!empty($where)) {
            //                 $where = $where . " OR branch_id = '" . $login_branch_id[$i] . "'";
            //             } else {
            //                 $where = "branch_id = '" . $login_branch_id[$i] . "'";
            //             }
            //         }
            //     // }
            // }else{
            //     if(!empty($where)) {
            //         $where = $where . " AND branch_id = '" . $GLOBALS['null_value'] . "'";
            //     } else {
            //         $where = "branch_id = '" . $GLOBALS['null_value'] . "'";
            //     }
            // }

            if (!empty($login_branch_id)) {
                if (is_array($login_branch_id)) {
                    $branch_ids = array_map(function($id) {
                        return "'" . addslashes($id) . "'";
                    }, $login_branch_id);
                    $branch_list = implode(",", $branch_ids);
                    $where .= (!empty($where) ? " AND " : "") . "branch_id IN ($branch_list)";
                } else {
                    $branch_id = addslashes($login_branch_id);
                    $where .= (!empty($where) ? " AND " : "") . "branch_id = '" . $branch_id . "'";
                }
            }

            if(!empty($payment_tax_type) && $payment_tax_type != $GLOBALS['null_value']) {
                if(!empty($where)) {
                    $where = $where . " AND payment_tax_type = '" . $payment_tax_type . "'";
                } else {
                    $where = "payment_tax_type = '" . $payment_tax_type . "'";
                }
            }
        
            if(!empty($payment_mode_id) && $payment_mode_id != $GLOBALS['null_value']) {
                $cash_balance = $this->getTableColumnValue($GLOBALS['payment_mode_table'],'payment_mode_id',$payment_mode_id,'cash_balance');

                    if(!empty($where)) {
                        $where = $where . " AND payment_mode_id = '" . $payment_mode_id . "'";
                    } else {
                        $where = "payment_mode_id = '" . $payment_mode_id . "'";
                    }
                
                if(!empty($cash_balance) && $cash_balance != $GLOBALS['null_value']){
                    if(!empty($where)) {
                        $where = $where . " AND cash_balance = '" . $cash_balance . "'";
                    } else {
                        $where = "cash_balance = '" . $cash_balance . "'";
                    }
                }

            }

            if(!empty($bank_id) && $bank_id != $GLOBALS['null_value']) {
                if(!empty($where)) {
                    $where = $where . " AND bank_id = '" . $bank_id . "'";
                } else {
                    $where = "bank_id = '" . $bank_id . "'";
                }
            }
    
            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . "  AND deleted ='0' ";
            } else {
                $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE deleted ='0' ";
            }
            
            // echo $select_query;
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
                if(!empty($list)) {
                    foreach($list as $data) {
                        if(!empty($data['credit'])) {
                            $credit += (float)$data['credit'];
                        }
                        if(!empty($data['debit'])) {
                            $debit += (float)$data['debit'];
                        }
                        $total_amount = ($credit - $debit);
                    }
                }
            }
            return $total_amount;
        }


        public function GetPaymentAmount($payment_tax_type,$payment_mode_id, $bank_id, $login_branch_id) {
            $list = array(); $select_query = ""; $where = "";$credit = 0;$debit =0;$total_amount =0; $cash_balance = 0;


                    // print_r($login_branch_id)
            // if(!empty($login_branch_id)){
            //     // if(is_array($login_branch_id)) {
			// 		for($i=0; $i < count($login_branch_id); $i++) {

            //             if(!empty($where)) {
            //                 $where = $where . " OR branch_id = '" . $login_branch_id[$i] . "'";
            //             } else {
            //                 $where = "branch_id = '" . $login_branch_id[$i] . "'";
            //             }
            //         }
            //     // }
            // }else{
            //     if(!empty($where)) {
            //         $where = $where . " AND branch_id = '" . $GLOBALS['null_value'] . "'";
            //     } else {
            //         $where = "branch_id = '" . $GLOBALS['null_value'] . "'";
            //     }
            // }

            if (!empty($login_branch_id)) {
                if (is_array($login_branch_id)) {
                    $branch_ids = array_map(function($id) {
                        return "'" . addslashes($id) . "'";
                    }, $login_branch_id);
                    $branch_list = implode(",", $branch_ids);
                    $where .= (!empty($where) ? " AND " : "") . "branch_id IN ($branch_list)";
                } else {
                    $branch_id = addslashes($login_branch_id);
                    $where .= (!empty($where) ? " AND " : "") . "branch_id = '" . $branch_id . "'";
                }
            }

            if(!empty($payment_tax_type) && $payment_tax_type != $GLOBALS['null_value']) {
                if(!empty($where)) {
                    $where = $where . " AND payment_tax_type = '" . $payment_tax_type . "'";
                } else {
                    $where = "payment_tax_type = '" . $payment_tax_type . "'";
                }
            }
        
            if(!empty($payment_mode_id) && $payment_mode_id != $GLOBALS['null_value']) {
                $cash_balance = $this->getTableColumnValue($GLOBALS['payment_mode_table'],'payment_mode_id',$payment_mode_id,'cash_balance');

                    if(!empty($where)) {
                        $where = $where . " AND payment_mode_id = '" . $payment_mode_id . "'";
                    } else {
                        $where = "payment_mode_id = '" . $payment_mode_id . "'";
                    }
                
                if(!empty($cash_balance) && $cash_balance != $GLOBALS['null_value']){
                    if(!empty($where)) {
                        $where = $where . " AND cash_balance = '" . $cash_balance . "' ";
                    } else {
                        $where = "cash_balance = '" . $cash_balance . "'";
                    }
                    if(empty($login_branch_id)){
                        if(!empty($cash_balance) && $cash_balance == 1){
                            if(!empty($where)) {
                                $where .= " AND branch_id = '".$GLOBALS['null_value']."' ";
                            } else {
                                $where = " = '".$GLOBALS['null_value']."' ";
                            }
                        }
                    }
                }

            }
            // echo $GLOBALS['admin_user_type'];

            if(!empty($bank_id) && $bank_id != $GLOBALS['null_value']) {
                if(!empty($where)) {
                    $where = $where . " AND bank_id = '" . $bank_id . "'";
                } else {
                    $where = "bank_id = '" . $bank_id . "'";
                }
            }
    
            if(!empty($where)) {
               $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND deleted ='0' ";
            } else {
                $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE deleted ='0' ";
            }
            
            // echo $select_query;
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
                if(!empty($list)) {
                    foreach($list as $data) {
                        if(!empty($data['credit'])) {
                            $credit += (float)$data['credit'];
                        }
                        if(!empty($data['debit'])) {
                            $debit += (float)$data['debit'];
                        }
                        $total_amount = ($credit - $debit);
                    }
                }
            }
            return $total_amount;
        }
        public function getPendingList($party_id) {
            $select_query = ""; $list = array();
            if(!empty($party_id)) {
                
                $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE (party_id = '" . $party_id . "') AND deleted = '0' ORDER BY bill_date ASC";
                
                $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
            }
            return $list;
        }
        public function getReceiptList($from_date, $to_date, $show_bill, $filter_party_id, $filter_lr_id, $login_branch_id) {
            
            $list = array(); $select_query = ""; $where = "";

            if(!empty($filter_party_id)) {
                $where = "party_id = '" . $filter_party_id . "'";
            }
       
            if(!empty($filter_lr_id) && $filter_lr_id != $GLOBALS['null_value']) {
                if(!empty($where)) {
                    $where = $where . " AND lr_id = '" . $filter_lr_id . "'";
                } else {
                    $where = "lr_id = '" . $filter_lr_id . "'";
                }
            }
    
            if(!empty($login_branch_id)) {
                $creator_name = $GLOBALS['creator_name'];
                $creator_name = $this->encode_decode('encrypt',$creator_name);
                
                if(!empty($creator_name) && $creator_name != $GLOBALS['null_value']) {
                    if(!empty($where)) {
                        $where = $where . " AND creator_name = '" . $creator_name . "'";
                    } else {
                        $where = "creator_name = '" . $creator_name . "'";
                    }
                }
            }

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where . " AND receipt_date >= '" . $from_date . "'";
                } else {
                    $where = "receipt_date >= '" . $from_date . "'";
                }
            }

            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where . " AND receipt_date <= '" . $to_date . "'";
                } else {
                    $where = "receipt_date <= '" . $to_date . "'";
                }
            }

            if($show_bill == '0' || $show_bill == '1') {
                if(!empty($where)) {
                    $where = $where . " AND deleted = '" . $show_bill . "' ";
                } else {
                    $where = "deleted = '" . $show_bill . "' ";
                }
            }



            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['receipt_table'] . " WHERE " . $where . " ORDER BY id DESC";
            } 
            else {
                $select_query = "SELECT * FROM " . $GLOBALS['receipt_table'] . " WHERE deleted = '0' ORDER BY id DESC";
            }
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['receipt_table'], $select_query);
            }
            return $list;
        }
        public function getExpenseList($from_date, $to_date, $show_bill, $filter_expense_category_id) {
            $list = array(); $select_query = ""; $where = "";

            if(!empty($filter_expense_category_id)) {
                $where = "expense_category_id = '" . $filter_expense_category_id . "'";
            }

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where . " AND expense_date >= '" . $from_date . "'";
                } else {
                    $where = "expense_date >= '" . $from_date . "'";
                }
            }
        
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where . " AND expense_date <= '" . $to_date . "'";
                } else {
                    $where = "expense_date <= '" . $to_date . "'";
                }
            }

            if($show_bill == '0' || $show_bill == '1') {
                if(!empty($where)) {
                    $where = $where . " AND deleted = '" . $show_bill . "' ";
                } else {
                    $where = "deleted = '" . $show_bill . "' ";
                }
            }

            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['expense_table'] . " WHERE " . $where . " ORDER BY id DESC";
            } 
            else {
                $select_query = "SELECT * FROM " . $GLOBALS['expense_table'] . " WHERE deleted = '0' ORDER BY id DESC";
            }
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['expense_table'], $select_query);
            }
            return $list;
        }
        public function getSuspenseVoucherList($from_date, $to_date, $show_bill, $filter_party_id) {
            $list = array(); $select_query = ""; $where = "";

            if(!empty($filter_party_id)) {
                $where = "suspense_party_id = '" . $filter_party_id . "'";
            }

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where . " AND suspense_voucher_date >= '" . $from_date . "'";
                } else {
                    $where = "suspense_voucher_date >= '" . $from_date . "'";
                }
            }

            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where . " AND suspense_voucher_date <= '" . $to_date . "'";
                } else {
                    $where = "suspense_voucher_date <= '" . $to_date . "'";
                }
            }

            if($show_bill == '0' || $show_bill == '1') {
                if(!empty($where)) {
                    $where = $where . " AND deleted = '" . $show_bill . "' ";
                } else {
                    $where = "deleted = '" . $show_bill . "' ";
                }
            }

            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['suspense_voucher_table'] . " WHERE " . $where . " ORDER BY id DESC";
            } 
            else {
                $select_query = "SELECT * FROM " . $GLOBALS['suspense_voucher_table'] . " WHERE deleted = '0' ORDER BY id DESC";
            }
            // echo $select_query;
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['suspense_voucher_table'], $select_query);
            }
            return $list;
        }
        public function getSuspensePartyList() {
            $select_query = "";
            $select_query = "SELECT * FROM ".$GLOBALS['suspense_party_table']." WHERE deleted ='0'";
            
            $list = $this->getQueryRecords($GLOBALS['suspense_party_table'],$select_query);
            return $list;
        }
        public function getSuspenseReceiptList($from_date, $to_date, $show_bill, $filter_party_id) {
            $list = array(); $select_query = ""; $where = "";

            if(!empty($filter_party_id)) {
                $where = "suspense_party_id = '" . $filter_party_id . "'";
            }

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where . " AND suspense_receipt_date >= '" . $from_date . "'";
                } else {
                    $where = "suspense_receipt_date >= '" . $from_date . "'";
                }
            }

            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where . " AND suspense_receipt_date <= '" . $to_date . "'";
                } else {
                    $where = "suspense_receipt_date <= '" . $to_date . "'";
                }
            }

            if($show_bill == '0' || $show_bill == '1') {
                if(!empty($where)) {
                    $where = $where . " AND deleted = '" . $show_bill . "' ";
                } else {
                    $where = "deleted = '" . $show_bill . "' ";
                }
            }

            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['suspense_receipt_table'] . " WHERE " . $where . " ORDER BY id DESC";
            } 
            else {
                $select_query = "SELECT * FROM " . $GLOBALS['suspense_receipt_table'] . " WHERE deleted = '0' ORDER BY id DESC";
            }
            // echo $select_query;
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['suspense_receipt_table'], $select_query);
            }
            return $list;
        }
        public function getPaymentPartyList($bill_type) {
            $list = array(); $select_query = ""; $where = ""; 
        
            if($bill_type == 1) {
                $bill_type = "Voucher";
            }
            if($bill_type == 2) {
                $bill_type = "Receipt";
            }
            if($bill_type == 3) {
                $bill_type = "Expense";
            }
            if(!empty($bill_type)){
                if(!empty($where)) {
                    $where .= " bill_type = '" . $bill_type . "' AND";
                } else {
                    $where = " bill_type = '" . $bill_type . "' AND";
                }
            }
            
            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . "  WHERE " . $where . " party_type NOT IN ('Branch','Company','Expense Category','Branch Opening Balance','Branch Tax Opening') AND deleted = '0' GROUP BY party_id ORDER BY created_date_time ASC ";
            } else {
                $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . "  WHERE party_type NOT IN ('Branch','Company','Expense Category','Branch Opening Balance','Branch Tax Opening') AND deleted = '0' GROUP BY party_id ORDER BY created_date_time ASC";
            }

            if(!empty($select_query)) {
                $list = $this->getQueryRecords('', $select_query);
            }
            // print_r($list);
            return $list;
        }
        public function getPaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_id,$payment_mode_id,$bank_id,$filter_category_id){
            $reports = array();
            $where ="";
            $branch_id = ""; $login_branch_id = array();
            if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
                $is_branch_staff = $this->getTableColumnValue($GLOBALS['user_table'], 'user_id', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'], 'is_branch_staff');
                if($is_branch_staff == "yes") {
                    $branch_id = $this->getTableColumnValue($GLOBALS['user_table'], 'user_id', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'], 'branch_id');

					if(!empty($branch_id) && $branch_id != $GLOBALS['null_value']) {
						$login_branch_id = explode(",", $branch_id);
					}
					if (is_array($login_branch_id)) {
						$branch_ids = array_map(function($id) {
							return "'" . addslashes($id) . "'";
						}, $login_branch_id);
						$branch_list = implode(",", $branch_ids);
						$where .= "branch_id IN ($branch_list) ";
					} else {
						$branch_id = addslashes($login_branch_id);
						$where .= "branch_id = '" . $branch_id . "'  ";
					}
                }
            }

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where . " AND bill_date >= '" . $from_date . "'";
                } else {
                    $where = "bill_date >= '" . $from_date . "'";
                }
            }
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where . " AND bill_date <= '" . $to_date . "'";
                } else {
                    $where = "bill_date <= '" . $to_date . "'";
                }
            }

            if(!empty($filter_party_id)){ 
                if(!empty($where)) {
                    $where = $where . " AND party_id = '" . $filter_party_id . "' ";
                } else {
                    $where = "party_id = '" . $filter_party_id . "'";
                }
            }

            if(!empty($filter_category_id)){ 
                if(!empty($where)) {
                    $where = $where . " AND party_id = '" . $filter_category_id . "' ";
                } else {
                    $where = "party_id = '" . $filter_category_id . "'";
                }
            }

            if(!empty($bank_id)){ 
                if(!empty($where)) {
                    $where = $where . " AND bank_id = '" . $bank_id . "' ";
                } else {
                    $where = "bank_id = '" . $bank_id . "'";
                }
            }

            if(!empty($payment_mode_id)){ 
                if(!empty($where)) {
                    $where = $where . " AND payment_mode_id = '" . $payment_mode_id . "' ";
                } else {
                    $where = "payment_mode_id = '" . $payment_mode_id . "'";
                }
            }

            if($filter_bill_type == 1) {
                if(!empty($where)) {
                    $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND bill_type = 'Voucher' AND deleted = '0' ORDER BY bill_date ASC";
                } else {
                    $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE bill_type = 'Voucher' AND deleted = '0' ORDER BY bill_date ASC";
                }
            } else if($filter_bill_type == 2) {
                if(!empty($where)) {
                    $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND bill_type = 'Receipt' AND deleted = '0' ORDER BY bill_date ASC"; 	
                } else {
                    $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE bill_type = 'Receipt' AND deleted = '0' ORDER BY bill_date ASC"; 	
                }
            } else if($filter_bill_type == 3) {
                if(!empty($where)) {
                    $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND bill_type = 'Expense' AND deleted = '0' ORDER BY bill_date ASC"; 	
                } else {
                    $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE bill_type = 'Expense' AND deleted = '0' ORDER BY bill_date ASC"; 	
                }
            } else {
                if(!empty($where)) {
                    $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND  bill_type IN ('voucher', 'expense', 'receipt')  AND deleted = '0' ORDER BY bill_date ASC";
                } else {
                    $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE  bill_type IN ('voucher', 'expense', 'receipt')  AND deleted = '0' ORDER BY bill_date ASC";
                }
            }
            // echo $select_query;
            $reports = $this->getQueryRecords('', $select_query);
            return $reports;
        }
        public function GetLRNumberList($party_type, $party_id, $bill_type, $login_branch_id){
            $list = array(); $select_query = ""; $party_field_name = ""; $lr_number_list =array();

            if($party_type == 'consignor'){
                $party_field_name = 'consignor_id';
            }else if($party_type == 'consignee'){
                    $party_field_name = 'consignee_id';
            }else{
            $party_field_name = 'account_party_id';
                $bill_type = 'Account Party';
            }
            $where ="";
            if(!empty($party_id)){ 
                if(!empty($where)) {
                    $where = $where . " AND ".$party_field_name." = '" . $party_id . "' ";
                } else {
                    $where = " ".$party_field_name." = '" . $party_id . "'";
                }
            }
            // if($party_type == 'consignor' && !empty($login_branch_id)){
            //     if(!empty($where)) {
            //         $where = $where . " AND branch_id = '" . $login_branch_id . "' ";
            //     } else {
            //         $where = "branch_id = '" . $login_branch_id . "'";
            //     }
            // }
            if ($party_type == 'consignor' && !empty($login_branch_id)) {
                if (is_array($login_branch_id)) {
                    $branch_ids = array_map(function($id) {
                        return "'" . addslashes($id) . "'";
                    }, $login_branch_id);
                    $branch_list = implode(",", $branch_ids);
                    $where .= (!empty($where) ? " AND " : "") . "from_branch_id IN ($branch_list)";
                } else {
                    $branch_id = addslashes($login_branch_id);
                    $where .= (!empty($where) ? " AND " : "") . "from_branch_id = '" . $branch_id . "'";
                }
            }


            if(!empty($bill_type)){ 
                if(!empty($where)) {
                    $where = $where . " AND bill_type = '" . $bill_type . "' ";
                } else {
                    $where = "bill_type = '" . $bill_type . "'";
                }
            }

            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['lr_table'] . " WHERE " . $where . " AND  deleted = '0' ORDER BY lr_date DESC";
            } else {
                $select_query = "SELECT * FROM " . $GLOBALS['lr_table'] . " WHERE deleted = '0' ORDER BY lr_date DESC";
            }
            $lr_list = $this->getQueryRecords('', $select_query);

            if(!empty($lr_list)){
                foreach($lr_list as $data){
                    if(!empty($data['lr_id'])){
                          $payment_query = "SELECT SUM(credit) AS credit ,SUM(debit) AS debit,lr_id FROM ".$GLOBALS['payment_table']." WHERE lr_id = '".$data['lr_id']."' AND deleted = '0' HAVING (SUM(credit) - SUM(debit)) != 0";
                        $lr_number_list = $this->getQueryRecords('', $payment_query);
                         
                    }
                }
                
            }
            return $lr_number_list;

        }
        public function CheckBalanceForReceiptRestriction($receipt_id){
            $receipt_details = array(); $bank_ids = array(); $amount = array(); $payment_tax_types = array();
                    $where = ""; $balance =0; $allow_delete = 0; $payment_mode_ids = array(); $total_credit = 0; $total_debit = 0;
            $select_query = "";
            $list = array();
            $unique_id = "";
            $receipt_details = $this->getTableRecords($GLOBALS['receipt_table'],'receipt_id',$receipt_id);
            if(!empty($receipt_details)){
                foreach($receipt_details as $data){
                    if(!empty($data['payment_mode_id'])){
                        $payment_mode_ids = explode(',',$data['payment_mode_id']);
                    }
                    if(!empty($data['bank_id'])){
                        $bank_ids = explode(',',$data['bank_id']);
                    }
                    if(!empty($data['amount'])){
                        $amount = explode(',',$data['amount']);
                    }
                    if(!empty($data['payment_tax_type'])){
                        $payment_tax_types = explode(',',$data['payment_tax_type']);
                    }
                }
            }
            if(!empty($payment_mode_ids)){

                for($i=0; $i < count($payment_mode_ids); $i++) {
                    $payment_mode_ids[$i] = trim($payment_mode_ids[$i]);
                    $payment_tax_types[$i] = trim($payment_tax_types[$i]);
                    
                    if (!empty($bank_ids[$i]) && $bank_ids[$i] != $GLOBALS['null_value']) {

                    $bank_ids[$i] = trim($bank_ids[$i]);
                    }
                
                    $amount[$i] = trim($amount[$i]);
            
                    $bill_company_id = $GLOBALS['bill_company_id'];

                    if (!empty($bill_company_id)) {
                        $where = " bill_company_id = '" . $bill_company_id . "' AND ";
                    }

                    if (!empty($payment_mode_ids[$i]) && $payment_mode_ids[$i] != $GLOBALS['null_value']) {
                        if (!empty($where)) {
                            $where = $where . " payment_mode_id = '" . $payment_mode_ids[$i] . "' AND ";
                        } else {
                            $where = " payment_mode_id = '" . $payment_mode_ids[$i] . "' AND ";
                        }
                    }

                    if (!empty($receipt_id) && $receipt_id != $GLOBALS['null_value']) {
                        if (!empty($where)) {
                            $where = $where . " bill_id != '" . $receipt_id . "' AND ";
                        } else {
                            $where = " bill_id != '" . $receipt_id . "' AND ";
                        }
                    }

                    if (!empty($bank_ids[$i]) && $bank_ids[$i] != $GLOBALS['null_value']) {
                        if (!empty($where)) {
                            $where = $where . " bank_id = '" . $bank_ids[$i] . "' AND ";
                        } else {
                            $where = " bank_id = '" . $bank_ids[$i] . "' AND ";
                        }
                    }
                    if (!empty($payment_tax_types[$i]) && $payment_tax_types[$i] != $GLOBALS['null_value']) {
                        if (!empty($where)) {
                            $where = $where . " payment_tax_type = '" . $payment_tax_types[$i] . "' AND ";
                        } else {
                            $where = " payment_tax_type = '" . $payment_tax_types[$i] . "' AND ";
                        }
                    }

                    if(!empty($where)) {
                        $select_query = "SELECT SUM(credit) as total_credit, SUM(debit) as total_debit FROM ".$GLOBALS['payment_table']." WHERE ".$where."  bill_type NOT IN ('Purchase Entry', 'LR Entry') AND deleted='0'";    
                    }
                    if(!empty($select_query)) {
                        $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
                    }
                    if(!empty($list)) {
                        foreach($list as $data) {
                            $total_credit += $data['total_credit'];
                            $total_debit += $data['total_debit']; 
                        }
                    }
                    $balance = $total_credit - $total_debit;
                    if ($balance < 0) {
                        $allow_delete = 1;
                    }
                
                }
            }
            return $allow_delete;

        }
        public function CheckBalanceForInvestRestriction($invest_id){
            $invest_details = array(); $bank_ids = array(); $amount = array(); $payment_tax_types = array();
            $where = ""; $balance =0; $allow_delete = 0; $payment_mode_ids = array(); $total_credit = 0; $total_debit = 0;
            $select_query = "";
            $list = array();
            $unique_id = "";
            $invest_details = $this->getTableRecords($GLOBALS['invest_table'],'invest_id',$invest_id);
            if(!empty($invest_details)){
                foreach($invest_details as $data){
                    if(!empty($data['payment_mode_id'])){
                        $payment_mode_ids = explode(',',$data['payment_mode_id']);
                    }
                    if(!empty($data['bank_id'])){
                        $bank_ids = explode(',',$data['bank_id']);
                    }
                    if(!empty($data['amount'])){
                        $amount = explode(',',$data['amount']);
                    }
                    if(!empty($data['payment_tax_type'])){
                        $payment_tax_types = explode(',',$data['payment_tax_type']);
                    }
                }
            }
            if(!empty($payment_mode_ids)){
                for($i=0; $i < count($payment_mode_ids); $i++) {
                    $payment_mode_ids[$i] = trim($payment_mode_ids[$i]);
                    $payment_tax_types[$i] = trim($payment_tax_types[$i]);
                    
                    if (!empty($bank_ids[$i]) && $bank_ids[$i] != $GLOBALS['null_value']) {

                    $bank_ids[$i] = trim($bank_ids[$i]);
                    }
                
                    $amount[$i] = trim($amount[$i]);
            
                    $bill_company_id = $GLOBALS['bill_company_id'];

                    if (!empty($bill_company_id)) {
                        $where = " bill_company_id = '" . $bill_company_id . "' AND ";
                    }

                    if (!empty($payment_mode_ids[$i]) && $payment_mode_ids[$i] != $GLOBALS['null_value']) {
                        if (!empty($where)) {
                            $where = $where . " payment_mode_id = '" . $payment_mode_ids[$i] . "' AND ";
                        } else {
                            $where = " payment_mode_id = '" . $payment_mode_ids[$i] . "' AND ";
                        }
                    }

                    if (!empty($invest_id) && $invest_id != $GLOBALS['null_value']) {
                        if (!empty($where)) {
                            $where = $where . " bill_id != '" . $invest_id . "' AND ";
                        } else {
                            $where = " bill_id != '" . $invest_id . "' AND ";
                        }
                    }

                    if (!empty($bank_ids[$i]) && $bank_ids[$i] != $GLOBALS['null_value']) {
                        if (!empty($where)) {
                            $where = $where . " bank_id = '" . $bank_ids[$i] . "' AND ";
                        } else {
                            $where = " bank_id = '" . $bank_ids[$i] . "' AND ";
                        }
                    }
                    if (!empty($payment_tax_types[$i]) && $payment_tax_types[$i] != $GLOBALS['null_value']) {
                        if (!empty($where)) {
                            $where = $where . " payment_tax_type = '" . $payment_tax_types[$i] . "' AND ";
                        } else {
                            $where = " payment_tax_type = '" . $payment_tax_types[$i] . "' AND ";
                        }
                    }

                    if(!empty($where)) {
                        $select_query = "SELECT SUM(credit) as total_credit, SUM(debit) as total_debit FROM ".$GLOBALS['payment_table']." WHERE ".$where."  bill_type NOT IN ('Purchase Entry', 'LR Entry') AND deleted='0'";    
                    }
                    if(!empty($select_query)) {
                        $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
                    }
                    if(!empty($list)) {
                        foreach($list as $data) {
                            $total_credit += $data['total_credit'];
                            $total_debit += $data['total_debit']; 
                        }
                    }
                    $balance = $total_credit - $total_debit;
                    if ($balance < 0) {
                        $allow_delete = 1;
                    }
                
                }
            }
            return $allow_delete;
        }
        public function getinvestList($bill_company_id,$from_date, $to_date, $show_bill) {
            $list = array(); $select_query = ""; $where = "";

            if(!empty($filter_party_id)) {
                $where = "party_id = '" . $filter_party_id . "'";
            }

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where . " AND invest_date >= '" . $from_date . "'";
                } else {
                    $where = "invest_date >= '" . $from_date . "'";
                }
            }

            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where . " AND invest_date <= '" . $to_date . "'";
                } else {
                    $where = "invest_date <= '" . $to_date . "'";
                }
            }

            if($show_bill == '0' || $show_bill == '1') {
                if(!empty($where)) {
                    $where = $where . " AND deleted = '" . $show_bill . "' ";
                } else {
                    $where = "deleted = '" . $show_bill . "' ";
                }
            }

            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['invest_table'] . " WHERE " . $where . " ORDER BY id DESC";
            } 
            else {
                $select_query = "SELECT * FROM " . $GLOBALS['invest_table'] . " WHERE deleted = '0' ORDER BY id DESC";
            }
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['invest_table'], $select_query);
            }
            return $list;
        }
        public function getReturnList($bill_company_id,$from_date, $to_date, $show_bill) {
            $list = array(); $select_query = ""; $where = "";

            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where . " AND return_date >= '" . $from_date . "'";
                } else {
                    $where = "return_date >= '" . $from_date . "'";
                }
            }

            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where . " AND return_date <= '" . $to_date . "'";
                } else {
                    $where = "return_date <= '" . $to_date . "'";
                }
            }

            if($show_bill == '0' || $show_bill == '1') {
                if(!empty($where)) {
                    $where = $where . " AND deleted = '" . $show_bill . "' ";
                } else {
                    $where = "deleted = '" . $show_bill . "' ";
                }
            }

            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['return_table'] . " WHERE " . $where . " ORDER BY id DESC";
            } 
            else {
                $select_query = "SELECT * FROM " . $GLOBALS['return_table'] . " WHERE deleted = '0' ORDER BY id DESC";
            }
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['return_table'], $select_query);
            }
            return $list;
        }

        public function GetPaymentAmountForChecking($payment_tax_type,$payment_mode_id, $bank_id, $voucher_id) {
            $list = array(); $select_query = ""; $where = "";$credit = 0;$debit =0;$total_amount =0;


            if(!empty($payment_tax_type) && $payment_tax_type != $GLOBALS['null_value']) {
                if(!empty($where)) {
                    $where = $where . " AND payment_tax_type = '" . $payment_tax_type . "'";
                } else {
                    $where = "payment_tax_type = '" . $payment_tax_type . "'";
                }
            }
        
            if(!empty($payment_mode_id) && $payment_mode_id != $GLOBALS['null_value']) {
                if(!empty($where)) {
                    $where = $where . " AND payment_mode_id = '" . $payment_mode_id . "'";
                } else {
                    $where = "payment_mode_id = '" . $payment_mode_id . "'";
                }
            }

            if(!empty($bank_id) && $bank_id != $GLOBALS['null_value']) {
                if(!empty($where)) {
                    $where = $where . " AND bank_id = '" . $bank_id . "'";
                } else {
                    $where = "bank_id = '" . $bank_id . "'";
                }
            }

            if(!empty($voucher_id) && $voucher_id != $GLOBALS['null_value']) {
                if(!empty($where)) {
                    $where = $where . " AND bill_id != '" . $voucher_id . "'";
                } else {
                    $where = "bill_id != '" . $voucher_id . "'";
                }
            }

            if(!empty($where)) {
                $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . "  AND deleted ='0' ";
            } else {
                $select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE deleted ='0' ";
            }
            
            // echo $select_query;
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
                if(!empty($list)) {
                    foreach($list as $data) {
                        if(!empty($data['credit'])) {
                            $credit += (float)$data['credit'];
                        }
                        if(!empty($data['debit'])) {
                            $debit += (float)$data['debit'];
                        }
                        $total_amount = ($credit - $debit);
                    }
                }
            }
            return $total_amount;
        }

        public function CheckBalanceSuspenseForReceipt($suspense_receipt_id){
            $suspense_receipt_details = array(); $bank_ids = array(); $amount = array(); $payment_tax_types = array();
                    $where = ""; $balance =0; $allow_delete = 0; $payment_mode_ids = array(); $total_credit = 0; $total_debit = 0;
            $select_query = "";
            $list = array();
            $unique_id = "";
            $suspense_receipt_details = $this->getTableRecords($GLOBALS['suspense_receipt_table'],'suspense_receipt_id',$suspense_receipt_id);
            if(!empty($suspense_receipt_details)){
                foreach($suspense_receipt_details as $data){
                    if(!empty($data['payment_mode_id'])){
                        $payment_mode_ids = explode(',',$data['payment_mode_id']);
                    }
                    if(!empty($data['bank_id'])){
                        $bank_ids = explode(',',$data['bank_id']);
                    }
                    if(!empty($data['amount'])){
                        $amount = explode(',',$data['amount']);
                    }
                    if(!empty($data['payment_tax_type'])){
                        $payment_tax_types = explode(',',$data['payment_tax_type']);
                    }
                }
            }
            if(!empty($payment_mode_ids)){

                for($i=0; $i < count($payment_mode_ids); $i++) {
                    $payment_mode_ids[$i] = trim($payment_mode_ids[$i]);
                    $payment_tax_types[$i] = trim($payment_tax_types[$i]);
                    
                    if (!empty($bank_ids[$i]) && $bank_ids[$i] != $GLOBALS['null_value']) {

                    $bank_ids[$i] = trim($bank_ids[$i]);
                    }
                
                    $amount[$i] = trim($amount[$i]);
            
                    $bill_company_id = $GLOBALS['bill_company_id'];

                    if (!empty($bill_company_id)) {
                        $where = " bill_company_id = '" . $bill_company_id . "' AND ";
                    }

                    if (!empty($payment_mode_ids[$i]) && $payment_mode_ids[$i] != $GLOBALS['null_value']) {
                        if (!empty($where)) {
                            $where = $where . " payment_mode_id = '" . $payment_mode_ids[$i] . "' AND ";
                        } else {
                            $where = " payment_mode_id = '" . $payment_mode_ids[$i] . "' AND ";
                        }
                    }

                    if (!empty($suspense_receipt_id) && $suspense_receipt_id != $GLOBALS['null_value']) {
                        if (!empty($where)) {
                            $where = $where . " bill_id != '" . $suspense_receipt_id . "' AND ";
                        } else {
                            $where = " bill_id != '" . $suspense_receipt_id . "' AND ";
                        }
                    }

                    if (!empty($bank_ids[$i]) && $bank_ids[$i] != $GLOBALS['null_value']) {
                        if (!empty($where)) {
                            $where = $where . " bank_id = '" . $bank_ids[$i] . "' AND ";
                        } else {
                            $where = " bank_id = '" . $bank_ids[$i] . "' AND ";
                        }
                    }
                    if (!empty($payment_tax_types[$i]) && $payment_tax_types[$i] != $GLOBALS['null_value']) {
                        if (!empty($where)) {
                            $where = $where . " payment_tax_type = '" . $payment_tax_types[$i] . "' AND ";
                        } else {
                            $where = " payment_tax_type = '" . $payment_tax_types[$i] . "' AND ";
                        }
                    }

                    if(!empty($where)) {
                        $select_query = "SELECT SUM(credit) as total_credit, SUM(debit) as total_debit FROM ".$GLOBALS['payment_table']." WHERE ".$where."  bill_type NOT IN ('Purchase Entry', 'LR Entry') AND deleted='0'";    
                    }
                    if(!empty($select_query)) {
                        $list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
                    }
                    if(!empty($list)) {
                        foreach($list as $data) {
                            $total_credit += $data['total_credit'];
                            $total_debit += $data['total_debit']; 
                        }
                    }
                    $balance = $total_credit - $total_debit;
                    if ($balance < 0) {
                        $allow_delete = 1;
                    }
                
                }
            }
            return $allow_delete;

        }
    } 
?>