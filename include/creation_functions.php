<?php
    class Creation_functions extends Basic_Functions{
        public function CheckPaymentModeAlreadyExists($company_id, $payment_mode_name) {
			$list = array(); $select_query = ""; $payment_mode_id = ""; $where = "";
			if(!empty($bill_company_id)) {
				$where = " bill_company_id = '".$company_id."' AND ";
			}
			if(!empty($payment_mode_name)) {
				$select_query = "SELECT payment_mode_id FROM ".$GLOBALS['payment_mode_table']." WHERE ".$where." lower_case_name = '".$payment_mode_name."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['payment_mode_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['payment_mode_id'])) {
							$payment_mode_id = $data['payment_mode_id'];
						}
					}
				}
			}
			return $payment_mode_id;
		}
		public function GetPaymentmodeLinkedCount($payment_mode_id) {
			$list = array(); $select_query = ""; $count = 0;
			if(!empty($payment_mode_id)) {
				$select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['bank_table']." WHERE FIND_IN_SET('".$payment_mode_id."', payment_mode_id) AND deleted = '0')
									UNION ALL 
									(SELECT count(id) as id_count FROM ".$GLOBALS['receipt_table']." WHERE FIND_IN_SET('".$payment_mode_id."', payment_mode_id) AND deleted = '0')
									UNION ALL 
									(SELECT count(id) as id_count FROM ".$GLOBALS['voucher_table']." WHERE FIND_IN_SET('".$payment_mode_id."', payment_mode_id) AND deleted = '0')
									UNION ALL 
									(SELECT count(id) as id_count FROM ".$GLOBALS['organization_table']." WHERE FIND_IN_SET('".$payment_mode_id."', payment_mode_id) AND deleted = '0')
									UNION ALL 
									(SELECT count(id) as id_count FROM ".$GLOBALS['invest_table']." WHERE FIND_IN_SET('".$payment_mode_id."', payment_mode_id) AND deleted = '0')
									UNION ALL 
									(SELECT count(id) as id_count FROM ".$GLOBALS['return_table']." WHERE FIND_IN_SET('".$payment_mode_id."', payment_mode_id) AND deleted = '0')
									UNION ALL 
									(SELECT count(id) as id_count FROM ".$GLOBALS['expense_table']." WHERE FIND_IN_SET('".$payment_mode_id."', payment_mode_id) AND deleted = '0')
									)
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
		public function GetBankLinkedCount($bank_id) {
			$list = array(); $select_query = ""; $where = ""; $count = 0;
			if(!empty($bank_id)) {
				$where = " FIND_IN_SET('".$bank_id."', bank_id) AND ";

				$select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['voucher_table']." WHERE FIND_IN_SET('".$bank_id."', bank_id) AND deleted = '0')
									UNION ALL 
									(SELECT count(id) as id_count FROM ".$GLOBALS['receipt_table']." WHERE FIND_IN_SET('".$bank_id."', bank_id) AND deleted = '0')
									UNION ALL 
									(SELECT count(id) as id_count FROM ".$GLOBALS['invest_table']." WHERE FIND_IN_SET('".$bank_id."', bank_id) AND deleted = '0')
									UNION ALL 
									(SELECT count(id) as id_count FROM ".$GLOBALS['return_table']." WHERE FIND_IN_SET('".$bank_id."', bank_id) AND deleted = '0')
									UNION ALL 
									(SELECT count(id) as id_count FROM ".$GLOBALS['expense_table']." WHERE FIND_IN_SET('".$bank_id."', bank_id) AND deleted = '0')
									UNION ALL 
									(SELECT count(id) as id_count FROM ".$GLOBALS['organization_table']." WHERE FIND_IN_SET('".$bank_id."', bank_id) AND deleted = '0')
									)
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
		public function GetProductLinkedCount($product_id) {
			$list = array(); $select_query = ""; $where = ""; $mt_where = ""; $count = 0;
			if(!empty($product_id)) {
				$where = " FIND_IN_SET('".$product_id."', product_id) AND ";

				$select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['purchase_entry_table']." WHERE ".$where." deleted = '0')
									)
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
		public function GetPartyLinkedCount($party_id) {
			$list = array(); $select_query = ""; $where = ""; $mt_where = ""; $count = 0;
			if(!empty($party_id)) {
				$where = " FIND_IN_SET('".$party_id."', party_id) AND ";

				$select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['purchase_entry_table']." WHERE ".$where." deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['voucher_table']." WHERE ".$where." deleted = '0')
									)
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
		public function GetRoleLinkedCount($role_id) {
			$list = array(); $select_query = ""; $count = 0;
			if(!empty($role_id)) {
				$select_query = "SELECT id_count FROM ((SELECT count(id) as id_count FROM ".$GLOBALS['user_table']." WHERE FIND_IN_SET('".$role_id."', role_id) AND deleted = '0')) as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
		public function CheckChargesAlreadyExists($company_id, $charge_name) {
			$list = array(); $select_query = ""; $charges_id = ""; $where = "";
			
			if(!empty($charge_name)) {
				$select_query = "SELECT charges_id FROM ".$GLOBALS['charges_table']." WHERE ".$where." lower_case_name = '".$charge_name."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['charges_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['charges_id'])) {
							$charges_id = $data['charges_id'];
						}
					}
				}
			}
			return $charges_id;
		}
		public function GetChargesLinkedCount($charges_id) {
			$list = array(); $select_query = ""; $where = ""; $count = 0;
			if(!empty($charges_id)) {

				$select_query = "SELECT id_count FROM 
				((SELECT count(id) as id_count FROM ".$GLOBALS['purchase_entry_table']." WHERE FIND_IN_SET('".$charges_id."', charges_id) AND deleted = '0')
				)
				as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
		public function CheckExpenseCategoryAlreadyExists($bill_company_id, $expense_category_name) {
			$list = array(); $select_query = ""; $expense_category_id = "";
			if(!empty($expense_category_name)) {
				$select_query = "SELECT expense_category_id FROM ".$GLOBALS['expense_category_table']." WHERE lower_case_name = '".$expense_category_name."' AND bill_company_id = '".$bill_company_id."' AND deleted = '0'";	
			}
			
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['expense_category_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['expense_category_id'])) {
							$expense_category_id = $data['expense_category_id'];
						}
					}
				}
			}
			return $expense_category_id;
		}
		public function GetSuspensePartyLinkedCount($party_id) {
			$list = array(); $select_query = ""; $where = ""; $mt_where = ""; $count = 0;
			if(!empty($party_id)) {
				$where = " FIND_IN_SET('".$party_id."', suspense_party_id) AND ";

				$select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['suspense_receipt_table']." WHERE ".$where." deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['suspense_voucher_table']." WHERE ".$where." deleted = '0'))
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
		public function getClearTableRecords($tables) {
			$success = 0; $con = $this->connect();
			if(!empty($tables)) {
				foreach($tables as $table) {
					if(!empty($table)) {
						if($table == $GLOBALS['product_table']) {
							$list = array(); $success++;
							$list = $this->getTableRecords($GLOBALS['product_table'], '', '');
							if(!empty($list)) {
								foreach($list as $data) {
									$linked_count = 0;
									if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
										$linked_count = $this->GetProductLinkedCount($data['product_id']);
										$linked_count = '0';
										if($linked_count == '0') {
											$columns = array(); $values = array();
											$columns = array('deleted'); $values = array("'1'");
											$product_update_id = $this->UpdateSQL($GLOBALS['product_table'], $data['id'], $columns, $values, '');
										}
									}
								}
							}
						}
						else {
							$table = trim(str_replace("'", "", $table));
							$update_query = "";
							$update_query = "UPDATE ".$table." SET deleted = '1'";
							if(!empty($update_query)) {							
								$result = $con->prepare($update_query);
								if($result->execute() === TRUE) {
									$success++;	
								}
							}
						}
					}
				}
				if($success == count($tables)) {
					$success = 1;
				}
				else {
					$success = "Unable to clear";
				}
			}
			return $success;
		}

		public function GetSalesPartyLinkedCount($sales_party_id) {
			$list = array(); $select_query = ""; $where = ""; $lr_where = ""; $count = 0;
			if(!empty($sales_party_id)) {
				$where = " FIND_IN_SET('".$sales_party_id."', party_id) AND ";
				 $lr_where = "(".
								"FIND_IN_SET('".$sales_party_id."', consignor_id) OR ".
								"FIND_IN_SET('".$sales_party_id."', consignee_id) OR ".
								"FIND_IN_SET('".$sales_party_id."', account_party_id) ".
							") AND";

				$select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['lr_entry_table']." WHERE ".$lr_where." deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['receipt_table']." WHERE ".$where." deleted = '0')
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}
	
		public function GetBranchLinkedCount($branch_id){
						$list = array(); $select_query = ""; $where = ""; $lr_where = ""; $count = 0;
			if(!empty($branch_id)) {
				$where = " FIND_IN_SET('".$branch_id."', branch_id) ";
					$lr_where = "(".
						"FIND_IN_SET('".$branch_id."', from_branch_id) OR ".
						"FIND_IN_SET('".$branch_id."', to_branch_id)".
					")";

					$select_query = "
						SELECT id_count FROM (
							(SELECT count(id) as id_count 
							FROM ".$GLOBALS['lr_table']." 
							WHERE ".$lr_where." AND deleted = '0')
							UNION ALL
							(SELECT count(id) as id_count 
							FROM ".$GLOBALS['tripsheet_table']." 
							WHERE ".$lr_where." AND deleted = '0')
							UNION ALL
							(SELECT count(id) as id_count 
							FROM ".$GLOBALS['user_table']." 
							WHERE ".$where." AND deleted = '0')
						) as g
					";

					$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;

		}
		public function GetUnitLinkedCount($unit_id) {
			$list = array(); $select_query = ""; $where = ""; $mt_where = ""; $count = 0;
			if(!empty($unit_id)) {
				$where = " FIND_IN_SET('".$unit_id."', unit_id) AND ";

				 $select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['purchase_entry_table']." WHERE ".$where." deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['tripsheet_table']." WHERE ".$where." deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['unit_price_table']." WHERE ".$where." deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['lr_table']." WHERE ".$where." deleted = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['product_table']." WHERE ".$where." deleted = '0')
									)
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}

		public function GetConsignorLinkedCount($consignor_id) {
			$list = array(); $select_query = ""; $where = ""; $mt_where = ""; $count = 0;
			if(!empty($consignor_id)) {
				$where = " FIND_IN_SET('".$consignor_id."', consignor_id) AND ";
				$receipt_where = " FIND_IN_SET('".$consignor_id."', party_id) AND ";


				 $select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['lr_table']." WHERE ".$where." deleted = '0' AND cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['tripsheet_table']." WHERE ".$where." deleted = '0'  AND cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['receipt_table']." WHERE ".$receipt_where." deleted = '0')
									)
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}

		
		public function GetConsigneeLinkedCount($consignee_id) {
			$list = array(); $select_query = ""; $where = ""; $mt_where = ""; $count = 0;
			if(!empty($consignee_id)) {
				$where = " FIND_IN_SET('".$consignee_id."', consignee_id) AND ";
				$receipt_where = " FIND_IN_SET('".$consignee_id."', party_id) AND ";


				 $select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['lr_table']." WHERE ".$where." deleted = '0' AND cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['tripsheet_table']." WHERE ".$where." deleted = '0'  AND cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['receipt_table']." WHERE ".$receipt_where." deleted = '0')
									)
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}

		
		public function GetAccountPartyLinkedCount($account_party_id) {
			$list = array(); $select_query = ""; $where = ""; $mt_where = ""; $count = 0;
			if(!empty($account_party_id)) {
				$where = " FIND_IN_SET('".$account_party_id."', account_party_id) AND ";
				$receipt_where = " FIND_IN_SET('".$account_party_id."', party_id) AND ";


				 $select_query = "SELECT id_count FROM 
									((SELECT count(id) as id_count FROM ".$GLOBALS['lr_table']." WHERE ".$where." deleted = '0' AND cancelled = '0')
									UNION ALL
									(SELECT count(id) as id_count FROM ".$GLOBALS['receipt_table']." WHERE ".$receipt_where." deleted = '0')
									)
								as g";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}

		public function BranchLoginPartyList($party_type,$login_branch_id){
			$staff_branch_ids = "";
			if(!empty($login_branch_id) && $login_branch_id != $GLOBALS['null_value']) {
				$staff_branch_ids = implode(",", $login_branch_id);
			}
			$list = array(); $select_query = ""; $where = "";
			if(!empty($party_type)){
				if($party_type == 'consignor') {
					$select_query = "SELECT DISTINCT(consignor_id) as consignor_id FROM ".$GLOBALS['lr_table']."  WHERE (FIND_IN_SET(from_branch_id, '".$staff_branch_ids."') OR FIND_IN_SET(to_branch_id, '".$staff_branch_ids."')) AND lr_id IN (SELECT bill_id FROM ".$GLOBALS['payment_table']." WHERE bill_type = 'LR Entry' AND deleted = '0') AND cancelled = '0' AND deleted = '0'";
				}else if($party_type == 'consignee') {
					 $select_query = "SELECT DISTINCT(consignee_id) as consignee_id FROM ".$GLOBALS['lr_table']."  WHERE (FIND_IN_SET(from_branch_id, '".$staff_branch_ids."') OR FIND_IN_SET(to_branch_id, '".$staff_branch_ids."')) AND lr_id IN (SELECT bill_id FROM ".$GLOBALS['payment_table']." WHERE bill_type = 'LR Entry' AND deleted = '0') AND cancelled = '0' AND deleted = '0'";
				}else{
					$select_query = "SELECT DISTINCT(account_party_id) as account_party_id FROM ".$GLOBALS['lr_table']."  WHERE (FIND_IN_SET(from_branch_id, '".$staff_branch_ids."') OR FIND_IN_SET(to_branch_id, '".$staff_branch_ids."')) AND lr_id IN (SELECT bill_id FROM ".$GLOBALS['payment_table']." WHERE bill_type = 'LR Entry' AND deleted = '0') AND cancelled = '0' AND deleted = '0'";
				}
			}
				$list = $this->getQueryRecords('', $select_query);

			return $list;

		}

		public function BranchOBusedinVoucherReturn(){
			$list = array(); $select_query = ""; $where = "";$count = 0;

			$select_query = "SELECT * FROM ".$GLOBALS['payment_table']." WHERE bill_type IN('Return','Voucher') AND cash_balance = '1' AND deleted = '0'";
			$list = $this->getQueryRecords($GLOBALS['payment_table'] , $select_query);
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
						$count = $data['id'];
					}
				}
			}
			return $count;
		}

		public function PaymentlinkedParty($party_id){
			$list = array(); $select_query = "";  $count = 0;
			if(!empty($party_id)){
				$where = " FIND_IN_SET('".$party_id."', party_id) AND ";
			}

			if(!empty($where)){
				 $select_query = "SELECT count(id) as id_count FROM ".$GLOBALS['payment_table']." WHERE ".$where." bill_type !='Opening Balance' AND deleted = '0'";
				$list = $this->getQueryRecords('', $select_query);
			}
			if(!empty($list)) {
				foreach($list as $data) {
					if(!empty($data['id_count']) && $data['id_count'] != $GLOBALS['null_value']) {
						$count = $data['id_count'];
					}
				}
			}
			return $count;
		}


		public function BankLinkedPaymentModes(){
			$list = array(); $select_query = "";  

			$select_query = "SELECT pm.payment_mode_id, pm.payment_mode_name, 'Cash' AS mode_type FROM
            ".$GLOBALS['payment_mode_table']." pm WHERE pm.deleted = '0' AND pm.cash_balance = 1

                UNION
                SELECT pm.payment_mode_id, pm.payment_mode_name, 'Linked with Bank' AS mode_type FROM
            ".$GLOBALS['payment_mode_table']." pm WHERE EXISTS ( SELECT * FROM ".$GLOBALS['bank_table']." b WHERE FIND_IN_SET(pm.payment_mode_id, b.payment_mode_id) > 0
            ) ";
				$list = $this->getQueryRecords('', $select_query);
				return $list;

		}
    }

?>