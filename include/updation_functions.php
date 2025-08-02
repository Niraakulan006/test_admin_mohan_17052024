<?php
    class Updation_Functions extends Basic_Functions {
        public function UpdateUnitPrice($party_type, $party_id, $party_name, $unit_id, $price_value, $cooly_value) {
            if(!empty($party_id) && !empty($unit_id) && !empty($price_value)) {
                $unit_price_unique_id = "";
                $unit_price_unique_id = $this->getUnitPriceUniqueID($party_type, $party_id, $unit_id);

                $unit_name = "";
                $unit_name = $this->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $unit_id, 'unit_name');
                if(empty($party_type)) {
                    $party_type = $GLOBALS['null_value'];
                }
                if(empty($party_id)) {
                    $party_id = $GLOBALS['null_value'];
                }
                if(empty($party_name)) {
                    $party_name = $GLOBALS['null_value'];
                }
                if(empty($unit_id)) {
                    $unit_id = $GLOBALS['null_value'];
                }
                if(empty($unit_name)) {
                    $unit_name = $GLOBALS['null_value'];
                }
                if(empty($price_value)) {
                    $price_value = $GLOBALS['null_value'];
                }
				if(empty($cooly_value)) {
                    $cooly_value = $GLOBALS['null_value'];
                }
                $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
				$creator_name = $this->encode_decode('encrypt', $GLOBALS['creator_name']);
                $bill_company_id = $GLOBALS['bill_company_id'];

                if(preg_match("/^\d+$/", $unit_price_unique_id)) {
                    $action = "Updated Successfully.";
                    $columns = array(); $values = array();
                    $columns = array('creator_name', 'party_name', 'unit_name', 'price_value','cooly_value');
                    $values = array("'".$creator_name."'", "'".$party_name."'", "'".$unit_name."'", "'".$price_value."'","'".$cooly_value."'");
                    $unit_price_update_id = $this->UpdateSQL($GLOBALS['unit_price_table'], $unit_price_unique_id, $columns, $values, $action);
                }
                else {
                    $action = "Inserted Successfully.";
                    $columns = array(); $values = array();
                    $columns = array('created_date_time', 'creator', 'creator_name', 'bill_company_id', 'party_type', 'party_id', 'party_name', 'unit_id', 'unit_name', 'price_value', 'cooly_value','deleted');
                    $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$bill_company_id."'", "'".$party_type."'", "'".$party_id."'", "'".$party_name."'", "'".$unit_id."'", "'".$unit_name."'", "'".$price_value."'","'".$cooly_value."'", "'0'");
                    $unit_price_insert_id = $this->InsertSQL($GLOBALS['unit_price_table'], $columns, $values, $action);
                }
            }
        }
        public function getUnitPriceUniqueID($party_type, $party_id, $unit_id) {
            $select_query = ""; $list = array(); $unique_id = "";
            if(!empty($party_type) && !empty($party_id) && !empty($unit_id)) {
                $select_query = "SELECT id FROM ".$GLOBALS['unit_price_table']." WHERE party_type = '".$party_type."' AND party_id = '".$party_id."' AND unit_id = '".$unit_id."' AND deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            if(!empty($list)) {
                foreach($list as $data) {
                    if(!empty($data['id']) && $data['id'] != $GLOBALS['null_value']) {
                        $unique_id = $data['id'];
                    }
                }
            }
            return $unique_id;
        }
        public function ToBranchList($from_branch_id) {
            $select_query = ""; $list = array();
            if(!empty($from_branch_id)) {
                $select_query = "SELECT * FROM ".$GLOBALS['branch_table']." WHERE branch_id != '".$from_branch_id."' AND deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            return $list;
        }
        public function getPriceValue($party_id, $unit_id) {
            $select_query = ""; $list = array(); $price_value = 0;
            if(!empty($party_id) && !empty($unit_id)) {
                $select_query = "SELECT price_value FROM ".$GLOBALS['unit_price_table']." WHERE party_id = '".$party_id."' AND unit_id = '".$unit_id."' AND deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
                if(!empty($list)) {
                    foreach($list as $data) {
                        if(!empty($data['price_value']) && $data['price_value'] != $GLOBALS['null_value']) {
                            $price_value = $data['price_value'];
                        }
                    }
                }
            }
            return $price_value;
        }
		public function getCoolyValue($party_id, $unit_id) {
            $select_query = ""; $list = array(); $cooly_value = 0;
            if(!empty($party_id) && !empty($unit_id)) {
                $select_query = "SELECT cooly_value FROM ".$GLOBALS['unit_price_table']." WHERE party_id = '".$party_id."' AND unit_id = '".$unit_id."' AND deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
                if(!empty($list)) {
                    foreach($list as $data) {
                        if(!empty($data['cooly_value']) && $data['cooly_value'] != $GLOBALS['null_value']) {
                            $cooly_value = $data['cooly_value'];
                        }
                    }
                }
            }
            return $cooly_value;
        }
        public function GetLRListByBranch($from_date, $to_date, $from_branch_id, $to_branch_id) {
            $select_query = ""; $list = array(); $where = "";
            if(!empty($from_date)) {
                $from_date = date('Y-m-d', strtotime($from_date));
                if(!empty($where)) {
                    $where = $where." DATE(lr_date) >= '".$from_date."' AND ";
                }
                else {
                    $where = " DATE(lr_date) >= '".$from_date."' AND ";
                }
            }
            if(!empty($to_date)) {
                $to_date = date('Y-m-d', strtotime($to_date));
                if(!empty($where)) {
                    $where = $where." DATE(lr_date) <= '".$to_date."' AND ";
                }
                else {
                    $where = " DATE(lr_date) <= '".$to_date."' AND ";
                }
            }
            if(!empty($from_branch_id) && !empty($to_branch_id)) {
				if(strpos($to_branch_id, ',') !== false) {
					$to_branch_id = explode(",", $to_branch_id);
				}
				if(is_array($to_branch_id)) {
					$to_where = "";
					for($i=0; $i < count($to_branch_id); $i++) {
						if(!empty($to_branch_id[$i])) {
							if(!empty($to_where)) {
								$to_where = $to_where." OR to_branch_id = '".$to_branch_id[$i]."' ";
							}
							else {
								$to_where = " to_branch_id = '".$to_branch_id[$i]."' ";
							}
						}
					}
					if(!empty($to_where)) {
						if(!empty($where)) {
							$where = $where." (".$to_where.") AND ";
						}
						else {
							$where = " (".$to_where.") AND ";
						}
					}
				}
				else {
					if(!empty($to_branch_id)) {
						if(!empty($where)) {
							$where = $where." to_branch_id = '".$to_branch_id."' AND ";
						}
						else {
							$where = " to_branch_id = '".$to_branch_id."' AND ";
						}
					}
				}
                 $select_query = "SELECT lr_id, lr_number FROM ".$GLOBALS['lr_table']." WHERE ".$where." from_branch_id = '".$from_branch_id."' AND is_cleared = '0' AND is_luggage_entry = '0' AND is_tripsheet_entry = '0' AND cancelled = '0' AND deleted = '0'";
                $list = $this->getQueryRecords('', $select_query);
            }
            return $list;
        }
        public function getLRListRecords($row, $rowperpage, $searchValue, $organization_id, $from_date, $to_date, $from_branch_id, $to_branch_id, $consignee_id, $consignor_id, $bill_type, $status, $order_column, $order_direction, $filter_gst_option) {
            $select_query = ""; $list = array(); $where = ""; $order_by_query = "";
            if(!empty($organization_id)) {
				if(!empty($where)) {
					$where = $where." organization_id = '".$organization_id."' AND ";
				}
				else {
					$where = "organization_id = '".$organization_id."' AND ";
				}
			}
			if($filter_gst_option == 0 || $filter_gst_option == 1) {
				if(!empty($where)) {
					$where = $where." gst_option = '".$filter_gst_option."' AND ";
				}
				else {
					$where = "gst_option = '".$filter_gst_option."' AND ";
				}
			}
            if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." lr_date >= '".$from_date."' AND ";
				}
				else {
					$where = " lr_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." lr_date <= '".$to_date."' AND ";
				}
				else {
					$where = " lr_date <= '".$to_date."' AND ";
				}
			}
			$from_where = "";
            if(!empty($from_branch_id)) {
				if(is_array($from_branch_id)) {
					for($i=0; $i < count($from_branch_id); $i++) {
						if(!empty($from_where)) {
							$from_where = $from_where." OR from_branch_id = '".$from_branch_id[$i]."' ";
						}
						else {
							$from_where = " from_branch_id = '".$from_branch_id[$i]."' ";
						}
					}
					if(!empty($from_where)) {
						if(!empty($where)) {
							$where = $where." (".$from_where.") AND ";
						}
						else {
							$where = " (".$from_where.") AND ";
						}
					}
				}
				else {
					if(!empty($where)) {
						$where = $where." from_branch_id = '".$from_branch_id."' AND ";
					}
					else {
						$where = "from_branch_id = '".$from_branch_id."' AND ";
					}
				}
			}
			if(!empty($to_branch_id)) {
				if(!empty($where)) {
					$where = $where." to_branch_id = '".$to_branch_id."' AND ";
				}
				else {
					$where = "to_branch_id = '".$to_branch_id."' AND ";
				}
			}
            if(!empty($consignee_id)) {
				if(!empty($where)) {
					$where = $where." consignee_id = '".$consignee_id."' AND ";
				}
				else {
					$where = "consignee_id = '".$consignee_id."' AND ";
				}
			}
            if(!empty($consignor_id)) {
				if(!empty($where)) {
					$where = $where." consignor_id = '".$consignor_id."' AND ";
				}
				else {
					$where = "consignor_id = '".$consignor_id."' AND ";
				}
			}
            if(!empty($bill_type)) {
				if(!empty($where)) {
					$where = $where." bill_type = '".$bill_type."' AND ";
				}
				else {
					$where = "bill_type = '".$bill_type."' AND ";
				}
			}
            if($status == '1') {
                if(!empty($where)) {
                    $where = $where." cancelled = '1' AND ";
                }
                else {
                    $where = " cancelled = '1' AND ";
                }
            }
            else {
                if(!empty($where)) {
                    $where = $where." cancelled = '0' AND ";
                }
                else {
                    $where = " cancelled = '0' AND ";
                }
            }
            if(!empty($searchValue)){
				if(!empty($where)) {
					$where = $where." (lr_number LIKE '%".$searchValue."%') AND ";
				}
				else {
					$where = " (lr_number LIKE '%".$searchValue."%') AND ";
				}
			}
            if(!empty($order_column) && !empty($order_direction)) {
				if ($order_column == 'total') {
					$order_by_query = "ORDER BY CAST(total AS DECIMAL(10,2)) ".$order_direction;
				} 
				else {
					$order_by_query = "ORDER BY ".$order_column." ".$order_direction;
				}
			}
			else {
				$order_by_query = "ORDER BY DATE(lr_date) DESC, id DESC";
			}
            if(!empty($rowperpage)) {
				$select_query = "SELECT * FROM ".$GLOBALS['lr_table']."
							WHERE ".$where." deleted = '0'
							".$order_by_query."
							LIMIT $row, $rowperpage";
			}
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['lr_table']."
							WHERE ".$where." deleted = '0'
							".$order_by_query;
			}
			$list = $this->getQueryRecords($GLOBALS['lr_table'], $select_query);
			return $list;
        }
        public function getTripsheetListRecords($row, $rowperpage, $searchValue, $from_date, $to_date, $from_branch_filter, $to_branch_filter, $order_column, $order_direction) {
            $select_query = ""; $list = array(); $where = ""; $order_by_query = "";
            if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." tripsheet_date >= '".$from_date."' AND ";
				}
				else {
					$where = " tripsheet_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." tripsheet_date <= '".$to_date."' AND ";
				}
				else {
					$where = " tripsheet_date <= '".$to_date."' AND ";
				}
			}
			$from_where = "";
            if(!empty($from_branch_filter)) {
				if(is_array($from_branch_filter)) {
					for($i=0; $i < count($from_branch_filter); $i++) {
						if(!empty($from_where)) {
							$from_where = $from_where." OR from_branch_id = '".$from_branch_filter[$i]."' ";
						}
						else {
							$from_where = " from_branch_id = '".$from_branch_filter[$i]."' ";
						}
					}
					if(!empty($from_where)) {
						if(!empty($where)) {
							$where = $where." (".$from_where.") AND ";
						}
						else {
							$where = " (".$from_where.") AND ";
						}
					}
				}
				else {
					if(!empty($where)) {
						$where = $where." from_branch_id = '".$from_branch_filter."' AND ";
					}
					else {
						$where = "from_branch_id = '".$from_branch_filter."' AND ";
					}
				}
			}
			if(!empty($to_branch_filter)) {
				if(!empty($where)) {
					$where = $where." FIND_IN_SET('".$to_branch_filter."', to_branch_id) AND ";
				}
				else {
					$where = " FIND_IN_SET('".$to_branch_filter."', to_branch_id) AND ";
				}
			}
            if(!empty($searchValue)){
				if(!empty($where)) {
					$where = $where." (tripsheet_number LIKE '%".$searchValue."%') AND ";
				}
				else {
					$where = " (tripsheet_number LIKE '%".$searchValue."%') AND ";
				}
			}
            if(!empty($order_column) && !empty($order_direction)) {
                $order_by_query = "ORDER BY ".$order_column." ".$order_direction;
			}
			else {
				$order_by_query = "ORDER BY DATE(tripsheet_date) DESC, id DESC";
			}
            if(!empty($rowperpage)) {
				$select_query = "SELECT * FROM ".$GLOBALS['tripsheet_table']."
							WHERE ".$where." cancelled = '0' AND deleted = '0'
							".$order_by_query."
							LIMIT $row, $rowperpage";
			}
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['tripsheet_table']."
							WHERE ".$where." cancelled = '0' AND deleted = '0'
							".$order_by_query;
			}
			$list = $this->getQueryRecords($GLOBALS['tripsheet_table'], $select_query);
			return $list;
        }
        public function getAcknowledgedTripsheetListRecords($row, $rowperpage, $searchValue, $from_date, $to_date, $login_branch_id, $order_column, $order_direction) {
            $select_query = ""; $list = array(); $where = ""; $order_by_query = ""; $tripsheet_list = array();
            if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." tripsheet_date >= '".$from_date."' AND ";
				}
				else {
					$where = " tripsheet_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." tripsheet_date <= '".$to_date."' AND ";
				}
				else {
					$where = " tripsheet_date <= '".$to_date."' AND ";
				}
			}
            if(!empty($searchValue)){
				if(!empty($where)) {
					$where = $where." (tripsheet_number LIKE '%".$searchValue."%') AND ";
				}
				else {
					$where = " (tripsheet_number LIKE '%".$searchValue."%') AND ";
				}
			}
			$from_where = "";
			if(!empty($login_branch_id)) {
				for($i=0; $i < count($login_branch_id); $i++) {
					if(!empty($login_branch_id[$i])) {
						if(!empty($from_where)) {
							$from_where = $from_where." OR FIND_IN_SET('".$login_branch_id[$i]."', to_branch_id) ";
						}
						else {
							$from_where = " FIND_IN_SET('".$login_branch_id[$i]."', to_branch_id) ";
						}
					}
				}
			}
			if(!empty($from_where)) {
				if(!empty($where)) {
					$where = $where." (".$from_where.") AND ";
				}
				else {
					$where = " (".$from_where.") AND ";
				}
			}
            if(!empty($order_column) && !empty($order_direction)) {
                $order_by_query = "ORDER BY ".$order_column." ".$order_direction;
			}
			else {
				$order_by_query = "ORDER BY DATE(tripsheet_date) DESC, id DESC";
			}
            if(!empty($rowperpage)) {
				$select_query = "SELECT * FROM ".$GLOBALS['tripsheet_table']."
							WHERE ".$where." is_acknowledged = '1' AND cancelled = '0' AND deleted = '0'
							".$order_by_query."
							LIMIT $row, $rowperpage";
			}
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['tripsheet_table']."
							WHERE ".$where." is_acknowledged = '1' AND cancelled = '0' AND deleted = '0'
							".$order_by_query;
			}
			$list = $this->getQueryRecords($GLOBALS['tripsheet_table'], $select_query);
			if(!empty($list)) {
				foreach($list as $data) {
					if($data['is_acknowledged'] == '1') {
						$tripsheet_list[] = $data;
					}
					else {
						$lr_ids = array();
						if(!empty($data['lr_id']) && $data['lr_id'] != $GLOBALS['null_value']) {
							$lr_ids = explode(",", $data['lr_id']);
						}
						if(!empty($lr_ids)) {
							for($i=0; $i < count($lr_ids); $i++) {
								if(!empty($lr_ids[$i])) {
									$invoice_status = "";
									$invoice_status = $this->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $lr_ids[$i], 'invoice_status');
									if($invoice_status == 'C') {
										$tripsheet_list[] = $data;
										break;
									}
								}
							}
						}
					}
				}
			}
			return $tripsheet_list;
        }
		public function getUnclearedRecordsList($row, $rowperpage, $lr_number, $from_date, $to_date, $login_branch_id, $order_column, $order_direction) {
			$select_query = ""; $list = array(); $where = ""; $order_by_query = "";
            if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." lr_date >= '".$from_date."' AND ";
				}
				else {
					$where = " lr_date >= '".$from_date."' AND ";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." lr_date <= '".$to_date."' AND ";
				}
				else {
					$where = " lr_date <= '".$to_date."' AND ";
				}
			}
            if(!empty($lr_number)){
				if(!empty($where)) {
					$where = $where." lr_number = '".$lr_number."' AND ";
				}
				else {
					$where = " lr_number = '".$lr_number."' AND ";
				}
			}
			$from_where = "";
			if(!empty($login_branch_id)) {
				for($i=0; $i < count($login_branch_id); $i++) {
					if(!empty($login_branch_id[$i])) {
						if(!empty($from_where)) {
							$from_where = $from_where." OR to_branch_id = '".$login_branch_id[$i]."' ";
						}
						else {
							$from_where = " to_branch_id = '".$login_branch_id[$i]."' ";
						}
					}
				}
			}
			if(!empty($from_where)) {
				if(!empty($where)) {
					$where = $where." (".$from_where.") AND ";
				}
				else {
					$where = " (".$from_where.") AND ";
				}
			}
            if(!empty($order_column) && !empty($order_direction)) {
				$order_by_query = "ORDER BY ".$order_column." ".$order_direction;
			}
			else {
				$order_by_query = "ORDER BY DATE(lr_date) DESC, id DESC";
			}
            if(!empty($rowperpage)) {
				$select_query = "SELECT * FROM ".$GLOBALS['lr_table']."
							WHERE ".$where." is_tripsheet_entry = '1' AND cancelled = '0' AND deleted = '0'
							".$order_by_query."
							LIMIT $row, $rowperpage";
			}
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['lr_table']."
							WHERE ".$where." is_tripsheet_entry = '1' AND cancelled = '0' AND deleted = '0'
							".$order_by_query;
			}
			$list = $this->getQueryRecords($GLOBALS['lr_table'], $select_query);
			return $list;
		}
		public function VehicleInsuranceExpiryList() {
			$select_query = ""; $list = array();
			$select_query = "SELECT *,
					DATEDIFF(DATE_ADD(CURDATE(), INTERVAL 30 DAY), insurance_date) AS days_diff
				FROM ".$GLOBALS['vehicle_table']."
				WHERE insurance_date IS NOT NULL
				AND insurance_date != '0000-00-00'
				AND insurance_date != '1970-01-01'
				AND insurance_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)
				AND deleted = '0' ORDER BY insurance_date ASC;";
			$list = $this->getQueryRecords('', $select_query);
			return $list;
		}
		public function DriverLicenseExpiryList() {
			$select_query = ""; $list = array();
			$select_query = "SELECT *,
					DATEDIFF(DATE_ADD(CURDATE(), INTERVAL 30 DAY), expiry_date) AS days_diff
				FROM ".$GLOBALS['driver_table']."
				WHERE expiry_date IS NOT NULL
				AND expiry_date != '0000-00-00'
				AND expiry_date != '1970-01-01'
				AND expiry_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)
				AND deleted = '0' ORDER BY expiry_date ASC;";
			$list = $this->getQueryRecords('', $select_query);
			return $list;
		}
		public function getTripsheetListForProfitLoss($vehicle_id) {
			$select_query = ""; $list = array();
			if(!empty($vehicle_id)) {
				$select_query = "SELECT * FROM ".$GLOBALS['tripsheet_table']." WHERE vehicle_id = '".$vehicle_id."' AND tripsheet_id NOT IN ((SELECT from_tripsheet_id FROM ".$GLOBALS['tripsheet_profit_loss_table']." WHERE deleted = '0') UNION (SELECT to_tripsheet_id FROM ".$GLOBALS['tripsheet_profit_loss_table']." WHERE deleted = '0')) AND is_acknowledged = '1' AND cancelled = '0' AND deleted = '0'";
				$list = $this->getQueryRecords('', $select_query);
			}
			return $list;
		}
		public function getTripsheetProfitLossListRecords($row, $rowperpage, $order_column, $order_direction) {
            $select_query = ""; $list = array(); $where = ""; $order_by_query = "";
            if(!empty($order_column) && !empty($order_direction)) {
                $order_by_query = "ORDER BY ".$order_column." ".$order_direction;
			}
			else {
				$order_by_query = "ORDER BY id DESC";
			}
            if(!empty($rowperpage)) {
				$select_query = "SELECT * FROM ".$GLOBALS['tripsheet_profit_loss_table']."
							WHERE ".$where." deleted = '0'
							".$order_by_query."
							LIMIT $row, $rowperpage";
			}
			else {
				$select_query = "SELECT * FROM ".$GLOBALS['tripsheet_profit_loss_table']."
							WHERE ".$where." deleted = '0'
							".$order_by_query;
			}
			$list = $this->getQueryRecords($GLOBALS['tripsheet_profit_loss_table'], $select_query);
			return $list;
        }
    }
?>