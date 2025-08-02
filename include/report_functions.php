<?php
	class Report_functions extends Basic_Functions {
	    public function getPurchaseReportList($from_date, $to_date,$bill_no, $filter_party_id,$cancel_bill_btn) {
			$select_query = ""; $where = "";
			
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				$where = "purchase_entry_date >= '" . $from_date . "'";
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where . " AND purchase_entry_date <= '" . $to_date . "'";
				} else {
					$where = " purchase_entry_date <='" . $to_date . "'";
				}
			}
			if(!empty($bill_no)) {
				if(!empty($where)) {
					$where = $where . " AND purchase_entry_number ='" . $bill_no . "'";
				} else {
					$where = " purchase_entry_number ='" . $bill_no . "'";
				}
			}
			if(!empty($filter_party_id)) {
				if(!empty($where)) {
					$where = $where . " AND party_id = '" . $filter_party_id . "' ";
				} else {
					$where = "party_id = '" . $filter_party_id . "' ";
				}
			}

			if(empty($cancel_bill_btn)) {
				$cancel_bill_btn = 0;
				if(!empty($where)) {
					$where = $where . " AND cancelled = '0'";
				} else {
					$where = "cancelled = '0'";
				}
			}
			
			if(!empty($where)) {
				$select_query = " SELECT * FROM " . $GLOBALS['purchase_entry_table'] . " WHERE " . $where . " AND deleted='0' ORDER BY id
				DESC"; 
			} else { 
				$select_query="SELECT * FROM " .$GLOBALS['purchase_entry_table'] . " WHERE deleted='0' ORDER BY id
				DESC"; 
			} 
			if(!empty($select_query)) { 
				$list=$this->getQueryRecords($GLOBALS['purchase_entry_table'], $select_query);
			}
			
			return $list;
		}
		public function getPurchaseTaxReport($filter_party_id,$from_date, $to_date) {
			$list = array(); $select_query = ""; $where = "";
			if(!empty($filter_party_id)) {
				if(!empty($where)) {
					$where = $where . " party_id = '" . $filter_party_id . "' AND ";
				} else {
					$where = "party_id = '" . $filter_party_id . "' AND ";
				}
			}

			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where . " purchase_entry_date >= '" . $from_date . "' AND"; 
				} else {
					$where = "purchase_entry_date >= '" . $from_date . "' AND ";
				}
			}

			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where . " purchase_entry_date <= '" . $to_date . "' AND "; 	
				} else {
					$where = "purchase_entry_date <= '" . $to_date . "' AND ";
				}
			}
			if(!empty($where)) {
				$select_query = "SELECT * FROM " . $GLOBALS['purchase_entry_table'] . " WHERE " . $where . "  cancelled = '0' AND deleted = '0'  AND gst_option = '1' ORDER BY id DESC";	
			} else {
				$select_query = "SELECT * FROM " . $GLOBALS['purchase_entry_table'] . " WHERE cancelled = '0' AND deleted = '0' AND gst_option ='1' ORDER BY id DESC";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['purchase_entry_table'], $select_query);
			}
			return $list;
		}
		public function getSalesPartyList(){
			$party_list = array(); $select_query = "";

			$select_query = "SELECT consignor_id AS party_id, name, mobile_number FROM " . $GLOBALS['consignor_table'] . " WHERE deleted = '0'
				UNION ALL
				SELECT consignee_id AS party_id, name, mobile_number FROM " . $GLOBALS['consignee_table'] . " WHERE deleted = '0'
				UNION ALL
				SELECT account_party_id AS party_id, name, mobile_number FROM " . $GLOBALS['account_party_table'] . " WHERE deleted = '0'
			";

			if(!empty($select_query)) {
				$party_list = $this->getQueryRecords('', $select_query);
			}
			return $party_list;
		}

		public function getOpeningBalance($from_date, $to_date, $purchase_party_id, $consignor_id, $consignee_id, $account_party_id) {
			$select_query = ""; $list = array(); $party_where = ""; $where = ""; $opening_query = ""; $balance_query = ""; $branch_where = "";
			$party_type = "";
			if(!empty($purchase_party_id)) {
				$party_id = $purchase_party_id;
				$party_type = "Purchase Party";
			}
			else if(!empty($consignor_id)) {
				$party_id = $consignor_id;
				$party_type = "Consignor";
			}
			else if(!empty($consignee_id)) {
				$party_id = $consignee_id;
				$party_type = "Consignee";
			}
			else if(!empty($account_party_id)) {
				$party_id = $account_party_id;
				$party_type = "Account Party";
			}

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
						$where .= "branch_id IN ($branch_list) AND ";
						$branch_where = $where;
					} else {
						$branch_id = addslashes($login_branch_id);
						$where .= "branch_id = '" . $branch_id . "' AND ";
						$branch_where = $where;
					}
                }
            }

			if(!empty($party_type)) {
				if(!empty($party_where)) {
					$party_where = $party_where." party_type = '".$party_type."' AND ";
				}
				else {
					$party_where = " party_type = '".$party_type."' AND ";
				}
			}
			if(!empty($party_id)) {
				if(!empty($party_where)) {
					$party_where = $party_where." party_id = '".$party_id."' AND ";
				}
				else {
					$party_where = " party_id = '".$party_id."' AND ";
				}
			}
			if(!empty($party_id)) {
				if(!empty($from_date) && $from_date != "0000-00-00") {
					$from_date = date('Y-m-d', strtotime($from_date));
					if(!empty($where)) {
						$where = $where." DATE(bill_date) < '".$from_date."' AND ";
					}
					else {
						$where = " DATE(bill_date) < '".$from_date."' AND ";
					}
				}
				if(!empty($to_date) && $to_date != "0000-00-00") {
					$to_date = date('Y-m-d', strtotime($to_date));
					if(!empty($where)) {
						$where = $where." DATE(bill_date) < '".$to_date."' AND ";
					}
					else {
						$where = " DATE(bill_date) < '".$to_date."' AND ";
					}
				}
				$opening_query = "SELECT SUM(credit) as opening_credit, SUM(debit) as opening_debit FROM ".$GLOBALS['payment_table']." WHERE ".$party_where." ".$branch_where." bill_type = 'Opening Balance' AND deleted = '0'";
				$balance_query = "SELECT SUM(credit) as opening_credit, SUM(debit) as opening_debit FROM ".$GLOBALS['payment_table']." WHERE ".$party_where." ".$branch_where." ".$where." bill_type != 'Opening Balance' AND deleted = '0' ORDER BY bill_date ASC";
				$select_query = "SELECT SUM(opening_credit) as opening_credit, SUM(opening_debit) as opening_debit FROM ((".$opening_query.") UNION ALL (".$balance_query.")) as g";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords('', $select_query);
			}
			return $list;
		}
		public function GetPendingBalanceList($from_date, $to_date, $purchase_party_id, $consignor_id, $consignee_id, $account_party_id) {
			$select_query = ""; $list = array(); $where = ""; $agent_query = ""; $party_query = ""; $suspense_party_query = ""; $branch_where = "";
			$party_type = "";
			if(!empty($purchase_party_id)) {
				$party_id = $purchase_party_id;
				$party_type = "Purchase Party";
			}
			else if(!empty($consignor_id)) {
				$party_id = $consignor_id;
				$party_type = "Consignor";
			}
			else if(!empty($consignee_id)) {
				$party_id = $consignee_id;
				$party_type = "Consignee";
			}
			else if(!empty($account_party_id)) {
				$party_id = $account_party_id;
				$party_type = "Account Party";
			}

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
						$where .= "branch_id IN ($branch_list) AND ";
						$branch_where = $where;
					} else {
						$branch_id = addslashes($login_branch_id);
						$where .= "branch_id = '" . $branch_id . "' AND ";
						$branch_where = $where;
					}
                }
            }

			if(!empty($party_id)) {
				if(!empty($where)) {
					$where = $where." party_id = '".$party_id."' AND ";
				}
				else {
					$where = " party_id = '".$party_id."' AND ";
				}
			}

			if(!empty($party_id)) {
				if(!empty($from_date) && $from_date != "0000-00-00") {
					$from_date = date('Y-m-d', strtotime($from_date));
					if(!empty($where)) {
						$where = $where." DATE(bill_date) >= '".$from_date."' AND ";
					}
					else {
						$where = " DATE(bill_date) >= '".$from_date."' AND ";
					}
				}
				if(!empty($to_date) && $to_date != "0000-00-00") {
					$to_date = date('Y-m-d', strtotime($to_date));
					if(!empty($where)) {
						$where = $where." DATE(bill_date) <= '".$to_date."' AND ";
					}
					else {
						$where = " DATE(bill_date) <= '".$to_date."' AND ";
					}
				}
				
				$select_query = "SELECT * FROM ".$GLOBALS['payment_table']." WHERE ".$where." bill_type != 'Opening Balance' AND deleted = '0' ORDER BY bill_date ASC";
			}
			else {
				$purchase_party_query = "SELECT party_id, party_type, SUM(credit) as credit, SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE ".$branch_where." party_type = 'Purchase Party' AND deleted = '0' GROUP BY party_id";
				$consignor_query = "SELECT party_id, party_type, SUM(credit) as credit, SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE ".$branch_where." party_type = 'Consignor' AND deleted = '0' GROUP BY party_id";
				$consignee_query = "SELECT party_id, party_type, SUM(credit) as credit, SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE ".$branch_where." party_type = 'Consignee' AND deleted = '0' GROUP BY party_id";
				$account_party_query = "SELECT party_id, party_type, SUM(credit) as credit, SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE ".$branch_where." party_type = 'Account Party' AND deleted = '0' GROUP BY party_id";
				$select_query = "SELECT party_id, party_type, credit, debit FROM ((".$purchase_party_query.") UNION ALL (".$consignor_query.") UNION ALL (".$consignee_query.") UNION ALL (".$account_party_query.")) as g";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords('', $select_query);
			}
			return $list;
		}
		public function getSalesTaxReport($party_type,$filter_party_id,$from_date, $to_date,$filter_party_type) {
			$list = array(); $select_query = ""; $where = ""; $bill_type = "";
			if (!empty($filter_party_id)) {
				if (!empty($where)) {
					$where .= $party_type . "_id = '" . $filter_party_id . "' AND ";
				} else {
					$where = $party_type . "_id = '" . $filter_party_id . "' AND ";
				}
			}
			if (!empty($party_type)) {
				if($party_type == 'consignor'){
					$bill_type = 'Paid';
				}else if($party_type == 'consignee'){
					$bill_type = 'ToPay';

				}else if($party_type == 'account_party'){
					$bill_type = 'Account Party';
				}
			}
			if(!empty($bill_type)) {
				if(!empty($where)) {
					$where = $where . " bill_type ='" . $bill_type . "' AND";
				} else {
					$where = " bill_type ='" . $bill_type . "' AND";
				}
			}

			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where . " lr_date >= '" . $from_date . "' AND"; 
				} else {
					$where = "lr_date >= '" . $from_date . "' AND ";
				}
			}

			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where . " lr_date <= '" . $to_date . "' AND "; 	
				} else {
					$where = "lr_date <= '" . $to_date . "' AND ";
				}
			}
			if(!empty($where)) {
				 $select_query = "SELECT * FROM " . $GLOBALS['lr_table'] . " WHERE " . $where . "  cancelled = '0' AND deleted = '0'  AND gst_option = '1' ORDER BY id DESC";	
			} else {
				 $select_query = "SELECT * FROM " . $GLOBALS['lr_table'] . " WHERE cancelled = '0' AND deleted = '0' AND gst_option ='1' ORDER BY id DESC";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['lr_table'], $select_query);
			}
			return $list;
		}
		public function getSuspensePaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_id,$payment_mode_id,$bank_id){
			$reports = array();
			$where ="";
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
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND bill_type = 'Suspense Voucher' AND deleted = '0' ORDER BY bill_date ASC";
				} else {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE bill_type = 'Suspense Voucher' AND deleted = '0' ORDER BY bill_date ASC";
				}
			} else if($filter_bill_type == 2) {
				if(!empty($where)) {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND bill_type = 'Suspense Receipt' AND deleted = '0' ORDER BY bill_date ASC"; 	
				} else {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE bill_type = 'Suspense Receipt' AND deleted = '0' ORDER BY bill_date ASC"; 	
				}
			}else {
				if(!empty($where)) {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE " . $where . " AND  bill_type IN ('Suspense Voucher', 'Suspense Receipt')  AND deleted = '0' ORDER BY bill_date ASC";
				} else {
					$select_query = "SELECT * FROM " . $GLOBALS['payment_table'] . " WHERE  bill_type IN ('Suspense Voucher', 'Suspense Receipt')  AND deleted = '0' ORDER BY bill_date ASC";
				}
			}
			// echo $select_query;
			$reports = $this->getQueryRecords('', $select_query);
			return $reports;
		}
		public function getSuspensePartyOpeningBalance($from_date, $to_date, $suspense_party_id) {
			$select_query = ""; $list = array(); $party_where = ""; $where = ""; $opening_query = ""; $balance_query = "";
			$party_type = "";
			if(!empty($suspense_party_id)) {
				$party_id = $suspense_party_id;
				$party_type = "Suspense Party";
			}
			if(!empty($party_id)) {
				if(!empty($party_where)) {
					$party_where = $party_where." party_id = '".$party_id."' AND ";
				}
				else {
					$party_where = " party_id = '".$party_id."' AND ";
				}
			}
			if(!empty($party_id)) {
				if(!empty($from_date) && $from_date != "0000-00-00") {
					$from_date = date('Y-m-d', strtotime($from_date));
					if(!empty($where)) {
						$where = $where." DATE(bill_date) < '".$from_date."' AND ";
					}
					else {
						$where = " DATE(bill_date) < '".$from_date."' AND ";
					}
				}
				if(!empty($to_date) && $to_date != "0000-00-00") {
					$to_date = date('Y-m-d', strtotime($to_date));
					if(!empty($where)) {
						$where = $where." DATE(bill_date) < '".$to_date."' AND ";
					}
					else {
						$where = " DATE(bill_date) < '".$to_date."' AND ";
					}
				}
				$opening_query = "SELECT SUM(credit) as opening_credit, SUM(debit) as opening_debit FROM ".$GLOBALS['payment_table']." WHERE ".$party_where." bill_type = 'Opening Balance' AND deleted = '0'";
				$balance_query = "SELECT SUM(credit) as opening_credit, SUM(debit) as opening_debit FROM ".$GLOBALS['payment_table']." WHERE ".$party_where." ".$where." bill_type != 'Opening Balance' AND deleted = '0' ORDER BY bill_date ASC";
				 $select_query = "SELECT SUM(opening_credit) as opening_credit, SUM(opening_debit) as opening_debit FROM ((".$opening_query.") UNION ALL (".$balance_query.")) as g";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords('', $select_query);
			}
			return $list;
		}
		public function GetSuspensePendingBalanceList($from_date, $to_date, $suspense_party_id) {
			$select_query = ""; $list = array(); $where = ""; $agent_query = ""; $party_query = ""; $suspense_party_query = "";
			$party_type = "";
			if(!empty($suspense_party_id)) {
				$party_id = $suspense_party_id;
				$party_type = "Suspense Party";
			}
			if(!empty($party_id)) {
				if(!empty($where)) {
					$where = $where." party_id = '".$party_id."' AND ";
				}
				else {
					$where = " party_id = '".$party_id."' AND ";
				}
			}
			if(!empty($party_id)) {
				if(!empty($from_date) && $from_date != "0000-00-00") {
					$from_date = date('Y-m-d', strtotime($from_date));
					if(!empty($where)) {
						$where = $where." DATE(bill_date) >= '".$from_date."' AND ";
					}
					else {
						$where = " DATE(bill_date) >= '".$from_date."' AND ";
					}
				}
				if(!empty($to_date) && $to_date != "0000-00-00") {
					$to_date = date('Y-m-d', strtotime($to_date));
					if(!empty($where)) {
						$where = $where." DATE(bill_date) <= '".$to_date."' AND ";
					}
					else {
						$where = " DATE(bill_date) <= '".$to_date."' AND ";
					}
				}
				$select_query = "SELECT * FROM ".$GLOBALS['payment_table']." WHERE ".$where." bill_type != 'Opening Balance' AND deleted = '0' ORDER BY bill_date ASC";
			}
			else {
				
				$suspense_party_query = "SELECT party_id, party_type, SUM(credit) as credit, SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE party_type = 'Suspense Party' AND deleted = '0' GROUP BY party_id";
				
				$select_query = "SELECT party_id, party_type, credit, debit FROM ((".$suspense_party_query.")) as g";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords('', $select_query);
			}
			return $list;
		}
		public function getDaybookReportList($from_date, $to_date,$filter_purchase_party_id, $filter_consignor_id, $filter_consignee_id, $filter_account_party_id, $filter_bill_type, $payment_mode_id, $bank_id, $filter_suspense_party_id) {
			$select_query = ""; $list = array(); $where = "";
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
            
			if(!empty($from_date) && $from_date != "0000-00-00") {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND DATE(bill_date) >= '".$from_date."'";
				}
				else {
					$where = "DATE(bill_date) >= '".$from_date."'";
				}
			}
			if(!empty($to_date) && $to_date != "0000-00-00") {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND DATE(bill_date) <= '".$to_date."'";
				}
				else {
					$where = "DATE(bill_date) <= '".$to_date."'";
				}
			}

			$party_type = ""; $party_id = "";
			if(!empty($filter_purchase_party_id)) {
				$party_id = $filter_purchase_party_id;
				$party_type = "Purchase Party";
			}
			else if(!empty($filter_consignor_id)) {
				$party_id = $filter_consignor_id;
				$party_type = "Consignor";
			}
			else if(!empty($filter_consignee_id)) {
				$party_id = $filter_consignee_id;
				$party_type = "Consignee";
			}
			else if(!empty($filter_account_party_id)) {
				$party_id = $filter_account_party_id;
				$party_type = "Account Party";
			}
			else if(!empty($filter_suspense_party_id)) {
				$party_id = $filter_suspense_party_id;
				$party_type = "Suspense Party";
			}
			if(!empty($party_id)) {
				if(!empty($where)) {
					$where = $where." AND party_id = '".$party_id."' ";
				}
				else {
					$where = " party_id = '".$party_id."' ";
				}
			}
			if(!empty($filter_bill_type)) {
				if(!empty($where)) {
					$where = $where." AND bill_type = '".$filter_bill_type."'";
				}
				else {
					$where = "bill_type = '".$filter_bill_type."'";
				}
			}
			if(!empty($payment_mode_id)) {
				if(!empty($where)) {
					$where = $where." AND FIND_IN_SET('".$payment_mode_id."', payment_mode_id) ";
				}
				else {
					$where = " FIND_IN_SET('".$payment_mode_id."', payment_mode_id) ";
				}
			}
			if(!empty($bank_id)) {
				if(!empty($where)) {
					$where = $where." AND FIND_IN_SET('".$bank_id."', bank_id) ";
				}
				else {
					$where = " FIND_IN_SET('".$bank_id."', bank_id) ";
				}
			}
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['payment_table']." WHERE ".$where." AND bill_type != 'Opening Balance' AND party_type != 'NULL' AND party_type != 'Branch' AND deleted = '0' ORDER BY bill_date ASC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['payment_table']." WHERE bill_type != 'Opening Balance' AND party_type != 'NULL' AND party_type != 'Branch' AND deleted = '0' ORDER BY bill_date ASC";
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
			}
			return $list;
		}
		public function CompanyBalanceList($payment_tax_type, $payment_mode_id) {
			$select_query = ""; $list = array(); $where ="";
			$cash_balance = 0;
			if(!empty($payment_mode_id) && $payment_mode_id != $GLOBALS['null_value']) {
				$cash_balance = $this->getTableColumnValue($GLOBALS['payment_mode_table'],'payment_mode_id',$payment_mode_id,'cash_balance');
				if(!empty($cash_balance) && $cash_balance == 1){
					$where = " branch_id = '".$GLOBALS['null_value']."' AND ";
				}
			}
			if(!empty($payment_tax_type) && !empty($payment_mode_id)) {
				$select_query = "SELECT SUM(credit) as credit, SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE ".$where."  (bill_type = 'Company' OR bill_type = 'Invest' OR bill_type = 'Return' OR bill_type = 'Voucher' OR bill_type = 'Receipt' OR bill_type = 'Expense' OR bill_type = 'Suspense Voucher' OR bill_type = 'Suspense Receipt') AND payment_tax_type = '".$payment_tax_type."' AND payment_mode_id = '".$payment_mode_id."' AND deleted = '0'";
				$list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
			}
			return $list;
		}
		public function BranchBalanceList($payment_tax_type, $branch_id) {
			$select_query = ""; $list = array();
			if(!empty($payment_tax_type)) {
				$select_query = "SELECT SUM(credit) as credit, SUM(debit) as debit FROM ".$GLOBALS['payment_table']." WHERE payment_tax_type = '".$payment_tax_type."' AND branch_id = '".$branch_id."' AND cash_balance = '1' AND deleted = '0'";
				$list = $this->getQueryRecords($GLOBALS['payment_table'], $select_query);
			}
			return $list;
		}
    }
?>