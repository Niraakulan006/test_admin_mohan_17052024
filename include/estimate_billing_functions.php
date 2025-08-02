<?php
    class Billing_Functions extends Basic_Functions {
		public function CheckUnitNameAlreadyExists($unit_name) {
			$list = array(); $select_query = ""; $unit_id = "";
			if(!empty($unit_name)) {
				$select_query = "SELECT unit_id FROM ".$GLOBALS['unit_table']." WHERE lower_case_name = '".$unit_name."' AND deleted = '0'";	
			}
			//echo $select_query;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['unit_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['unit_id'])) {
							$unit_id = $data['unit_id'];
						}
					}
				}
			}
			return $unit_id;
		}
		public function CheckDriverAlreadyExists($driver_name,$driver_number) {
			$list = array(); $select_query = ""; $driver_id = "";
			if(!empty($driver_name) && !empty($driver_number)) {
				$select_query = "SELECT driver_id FROM ".$GLOBALS['driver_table']." WHERE driver_number = '".$driver_number."' AND lower_case_name = '".$driver_name."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['driver_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['driver_id'])) {
							$driver_id = $data['driver_id'];
						}
					}
				}
			}
			return $driver_id;
		}
		public function checkVehicleNumberAlreadyExists($vehicle_number) {
			$list = array(); $select_query = ""; $vechile_id = "";
			if(!empty($vehicle_number)) {
				$select_query = "SELECT vehicle_id FROM ".$GLOBALS['vehicle_table']." WHERE lower_case_name = '".$vehicle_number."' AND deleted = '0'";	
			}
			//echo $select_query;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['vehicle_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['vehicle_id'])) {
							$vechile_id = $data['vehicle_id'];
						}
					}
				}
			}
			return $vechile_id;
		}
		public function CheckBranchNameAlreadyExists($branch_name,$branch_city) {
			$list = array(); $select_query = ""; $branch_id = "";

			if(!empty($branch_name) && !empty($branch_city)) {
				$select_query = "SELECT * FROM ".$GLOBALS['branch_table']." WHERE lower_case_name = '".$branch_name."' AND lower_case_city = '".$branch_city."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['branch_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['branch_id'])) {
							$branch_id = $data['branch_id'];
						}
					}
				}
			}
			return $branch_id;
		}
		public function CheckBranchLrAlreadyExists($branch_lr_prefix) {
			$list = array(); $select_query = ""; $branch_id = "";

			if(!empty($branch_lr_prefix)) {
				$select_query = "SELECT * FROM ".$GLOBALS['branch_table']." WHERE branch_lr_prefix = '".$branch_lr_prefix."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['branch_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['branch_id'])) {
							$branch_id = $data['branch_id'];
						}
					}
				}
			}
			return $branch_id;
		}
		public function CheckBranchMobileAlreadyExists($branch_contact_number) {
			$list = array(); $select_query = ""; $branch_id = "";

			if(!empty($branch_contact_number)) {
				$select_query = "SELECT * FROM ".$GLOBALS['branch_table']." WHERE branch_contact_number = '".$branch_contact_number."' AND deleted = '0'";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['branch_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['branch_id'])) {
							$branch_id = $data['branch_id'];
						}
					}
				}
			}
			return $branch_id;
		}
		public function getTrackLRnumberDetailsList($from_date, $to_date, $lr_number) {
			$list = array(); $select_query = ""; $where = "";

			if(!empty($lr_number)) {
				$where = "lr_number = '".$lr_number."'";
			}
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND lr_date >= '".$from_date."'";
				}
				else {
					$where = "lr_date >= '".$from_date."'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND lr_date <= '".$to_date."'";
				}
				else {
					$where = "lr_date <= '".$to_date."'";
				}
			}

			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0'";
				$list = $this->getQueryRecords($GLOBALS['lr_table'], $select_query);	
			}
			return $list;
		}
		public function getLRDetailsList($bill_company_id,$organization_id, $from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,$status,$from_date, $to_date,$godown_id, $filter_gst_type) {
			$list = array(); $select_query = ""; $where = "";

			// if(!empty($bill_company_id)) {
			// 	$where = "bill_company_id = '".$bill_company_id."'";
			// }
			if(!empty($bill_type)) {
				if(!empty($where)) {
					$where = $where." AND bill_type = '".$bill_type."'";
				}
				else {
					$where = "bill_type = '".$bill_type."'";
				}
			}
			if(!empty($godown_id)) {
				if(!empty($where)) {
					$where = $where." AND godown_id = '".$godown_id."'";
				}
				else {
					$where = "godown_id = '".$godown_id."'";
				}	
			}
			if(!empty($godown_id)) {
				if(!empty($where)) {
					$where = $where." AND godown_id = '".$godown_id."'";
				}
				else {
					$where = "godown_id = '".$godown_id."'";
				}	
			}
			if($filter_gst_type == 0 || $filter_gst_type == 1) {
				if(!empty($where)) {
					$where = $where." AND gst_option = '".$filter_gst_type."'";
				}
				else {
					$where = "gst_option = '".$filter_gst_type."'";
				}
			}
			if(!empty($consignee_id)) {
				if(!empty($where)) {
					$where = $where." AND consignee_id = '".$consignee_id."'";
				}
				else {
					$where = "consignee_id = '".$consignee_id."'";
				}
			}
			if(!empty($consignor_id)) {
				if(!empty($where)) {
					$where = $where." AND consignor_id = '".$consignor_id."'";
				}
				else {
					$where = "consignor_id = '".$consignor_id."'";
				}
			}
			if(!empty($from_branch_id)) {
				if(!empty($where)) {
					$where = $where." AND from_branch_id = '".$from_branch_id."'";
				}
				else {
					$where = "from_branch_id = '".$from_branch_id."'";
				}
			}
			if(!empty($to_branch_id)) {
				if(!empty($where)) {
					$where = $where." AND to_branch_id = '".$to_branch_id."'";
				}
				else {
					$where = "to_branch_id = '".$to_branch_id."'";
				}
			}
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND lr_date >= '".$from_date."'";
				}
				else {
					$where = "lr_date >= '".$from_date."'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND lr_date <= '".$to_date."'";
				}
				else {
					$where = "lr_date <= '".$to_date."'";
				}
			}
			if($status == "1") {

				if(!empty($where)) {
					$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0' AND cancelled = '1' ORDER BY DATE(lr_date) DESC, id DESC";	
				}
				else
				{
					$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE  deleted = '0'  AND cancelled = '1' ORDER BY DATE(lr_date) DESC, id DESC";	
				}
				if(!empty($select_query)) {
					$list = $this->getQueryRecords($GLOBALS['lr_table'], $select_query);
				}
			}
			else
			{
				if(!empty($where)) {
					$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0' AND cancelled = '0' ORDER BY DATE(lr_date) DESC, id DESC";	
				}
				else
				{
					$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE  deleted = '0'  AND cancelled = '0' ORDER BY DATE(lr_date) DESC, id DESC";	
				}
				//echo $select_query;
				if(!empty($select_query)) {
					$list = $this->getQueryRecords($GLOBALS['lr_table'], $select_query);
				}
			}
			return $list;
		}
		public function LrTripsheetUpdate($lr_id,$tripsheet_number) {
			$getUniqueId = $this->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_id,'id');
			$columns = array(); $values = array();          		
			$columns = array('is_tripsheet_entry','tripsheet_number');
			$values = array("'1'","'".$tripsheet_number."'");
			$list = $this->UpdateSQL($GLOBALS['lr_table'], $getUniqueId, $columns, $values,'');
			return $list;
		}
		public function getClearanceReportCount($bill_company_id,$organization_id, $from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,$status,$from_date, $to_date,$godown_id, $search_lr_number) {
			$lr_count = 0; $list = array(); $select_query = ""; $where = "";

			// if(!empty($bill_company_id)) {
			// 	$where = "bill_company_id = '".$bill_company_id."'";
			// }
			if(!empty($bill_type)) {
				if(!empty($where)) {
					$where = $where." AND bill_type = '".$bill_type."'";
				}
				else {
					$where = "bill_type = '".$bill_type."'";
				}
			}
			if(!empty($godown_id))
			{
				if(!empty($where)) {
					$where = $where." AND godown_id = '".$godown_id."'";
				}
				else {
					$where = "godown_id = '".$godown_id."'";
				}	
			}
			if(!empty($organization_id)) {
				if(!empty($where)) {
					$where = $where." AND organization_id = '".$organization_id."'";
				}
				else {
					$where = "organization_id = '".$organization_id."'";
				}
			}
			if(!empty($consignee_id)) {
				if(!empty($where)) {
					$where = $where." AND consignee_id = '".$consignee_id."'";
				}
				else {
					$where = "consignee_id = '".$consignee_id."'";
				}
			}
			if(!empty($consignor_id)) {
				if(!empty($where)) {
					$where = $where." AND consignor_id = '".$consignor_id."'";
				}
				else {
					$where = "consignor_id = '".$consignor_id."'";
				}
			}
			if(!empty($from_branch_id)) {
				if(!empty($where)) {
					$where = $where." AND from_branch_id = '".$from_branch_id."'";
				}
				else {
					$where = "from_branch_id = '".$from_branch_id."'";
				}
			}
			if(!empty($to_branch_id)) {
				if(!empty($where)) {
					$where = $where." AND to_branch_id = '".$to_branch_id."'";
				}
				else {
					$where = "to_branch_id = '".$to_branch_id."'";
				}
			}
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND lr_date >= '".$from_date."'";
				}
				else {
					$where = "lr_date >= '".$from_date."'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND lr_date <= '".$to_date."'";
				}
				else {
					$where = "lr_date <= '".$to_date."'";
				}
			}
			if(!empty($search_lr_number)) {
				if(!empty($where)) {
					$where = $where." AND lr_number = '".$search_lr_number."'";
				}
				else {
					$where = "lr_number = '".$search_lr_number."'";
				}
			}
			
			if(!empty($where)) {
				if(!empty($search_lr_number)) {
					$select_query = "SELECT COUNT(id) as lr_count FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0' AND cancelled = '0' AND is_cleared =  '1'";
				}
				else {
					$select_query = "SELECT COUNT(id) as lr_count FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0' AND cancelled = '0' AND is_cleared =  '1'";
				}	
			}
			else
			{
				$select_query = "SELECT COUNT(id) as lr_count FROM ".$GLOBALS['lr_table']." WHERE  deleted = '0'  AND cancelled = '0' AND is_cleared =  '1'";	
			}
			//echo $select_query; exit;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['lr_table'], $select_query);
				if(!empty($list)) {
					foreach($list as $data) {
						if(!empty($data['lr_count'])) {
							$lr_count = $data['lr_count'];
						}
					}
				}
			}
			return $lr_count;
		}
		public function getClearanceReportList($bill_company_id,$organization_id, $from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,$status,$from_date, $to_date,$godown_id, $search_lr_number, $page_number, $page_limit, $total_lr_count) {
			$list = array(); $select_query = ""; $where = "";

			// if(!empty($bill_company_id)) {
			// 	$where = "bill_company_id = '".$bill_company_id."'";
			// }
			if(!empty($bill_type)) {
				if(!empty($where)) {
					$where = $where." AND bill_type = '".$bill_type."'";
				}
				else {
					$where = "bill_type = '".$bill_type."'";
				}
			}
			if(!empty($godown_id))
			{
				if(!empty($where)) {
					$where = $where." AND godown_id = '".$godown_id."'";
				}
				else {
					$where = "godown_id = '".$godown_id."'";
				}	
			}
			if(!empty($organization_id)) {
				if(!empty($where)) {
					$where = $where." AND organization_id = '".$organization_id."'";
				}
				else {
					$where = "organization_id = '".$organization_id."'";
				}
			}
			if(!empty($consignee_id)) {
				if(!empty($where)) {
					$where = $where." AND consignee_id = '".$consignee_id."'";
				}
				else {
					$where = "consignee_id = '".$consignee_id."'";
				}
			}
			if(!empty($consignor_id)) {
				if(!empty($where)) {
					$where = $where." AND consignor_id = '".$consignor_id."'";
				}
				else {
					$where = "consignor_id = '".$consignor_id."'";
				}
			}
			if(!empty($from_branch_id)) {
				if(!empty($where)) {
					$where = $where." AND from_branch_id = '".$from_branch_id."'";
				}
				else {
					$where = "from_branch_id = '".$from_branch_id."'";
				}
			}
			if(!empty($to_branch_id)) {
				if(!empty($where)) {
					$where = $where." AND to_branch_id = '".$to_branch_id."'";
				}
				else {
					$where = "to_branch_id = '".$to_branch_id."'";
				}
			}
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND lr_date >= '".$from_date."'";
				}
				else {
					$where = "lr_date >= '".$from_date."'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND lr_date <= '".$to_date."'";
				}
				else {
					$where = "lr_date <= '".$to_date."'";
				}
			}
			if(!empty($search_lr_number)) {
				if(!empty($where)) {
					$where = $where." AND lr_number = '".$search_lr_number."'";
				}
				else {
					$where = "lr_number = '".$search_lr_number."'";
				}
			}

			$page_start = 0; $page_end = 0;
			if(!empty($total_lr_count)) {				
				if($total_lr_count > $page_limit) {
					if(!empty($page_number)) {
						$page_start = ($page_number - 1) * $page_limit;
						$page_end = $page_limit;
					}
					else {
						$page_start = 0;
						$page_end = $page_limit;
					}
				}
				else {
					$page_start = 0;
					$page_end = $page_limit;
				}
			}
			
			if(!empty($where)) {
				if(!empty($search_lr_number)) {
					$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0' AND cancelled = '0' AND is_cleared =  '1'";
				}
				else {
					$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0' AND cancelled = '0' AND is_cleared =  '1' 
										ORDER BY id DESC LIMIT ".$page_start.", ".$page_end;
				}	
			}
			else
			{
				$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE  deleted = '0'  AND cancelled = '0' AND is_cleared =  '1' 
									ORDER BY id DESC LIMIT ".$page_start.", ".$page_end;	
			}
			//echo $select_query; exit;
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['lr_table'], $select_query);
			}
			return $list;
		}
		public function getUnClearanceReportList($bill_company_id,$organization_id, $from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,$status,$from_date, $to_date,$godown_id) {
			$list = array(); $select_query = ""; $where = "";

			// if(!empty($bill_company_id)) {
			// 	$where = "bill_company_id = '".$bill_company_id."'";
			// }
			if(!empty($bill_type)) {
				if(!empty($where)) {
					$where = $where." AND bill_type = '".$bill_type."'";
				}
				else {
					$where = "bill_type = '".$bill_type."'";
				}
			}
			if(!empty($godown_id))
			{
				if(!empty($where)) {
					$where = $where." AND godown_id = '".$godown_id."'";
				}
				else {
					$where = "godown_id = '".$godown_id."'";
				}	
			}
			if(!empty($organization_id)) {
				if(!empty($where)) {
					$where = $where." AND organization_id = '".$organization_id."'";
				}
				else {
					$where = "organization_id = '".$organization_id."'";
				}
			}
			if(!empty($consignee_id)) {
				if(!empty($where)) {
					$where = $where." AND consignee_id = '".$consignee_id."'";
				}
				else {
					$where = "consignee_id = '".$consignee_id."'";
				}
			}
			if(!empty($consignor_id)) {
				if(!empty($where)) {
					$where = $where." AND consignor_id = '".$consignor_id."'";
				}
				else {
					$where = "consignor_id = '".$consignor_id."'";
				}
			}
			if(!empty($from_branch_id)) {
				if(!empty($where)) {
					$where = $where." AND from_branch_id = '".$from_branch_id."'";
				}
				else {
					$where = "from_branch_id = '".$from_branch_id."'";
				}
			}
			if(!empty($to_branch_id)) {
				if(!empty($where)) {
					$where = $where." AND to_branch_id = '".$to_branch_id."'";
				}
				else {
					$where = "to_branch_id = '".$to_branch_id."'";
				}
			}
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND lr_date >= '".$from_date."'";
				}
				else {
					$where = "lr_date >= '".$from_date."'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND lr_date <= '".$to_date."'";
				}
				else {
					$where = "lr_date <= '".$to_date."'";
				}
			}
			
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0' AND cancelled = '0' AND is_cleared =  '0' AND is_tripsheet_entry = '1' ORDER BY id DESC";	
			}
			else
			{
				$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE  deleted = '0'  AND cancelled = '0' AND is_cleared =  '0' AND is_tripsheet_entry = '1' ORDER BY id DESC";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['lr_table'], $select_query);
			}
			return $list;
		}
		public function getTripsheetDetailsList($consignor_id,$godown_id,$from_date,$to_date) {
			$list = array(); $select_query = ""; $where = "";

			if(!empty($consignor_id)) {
				if(!empty($where)) {
					$where = $where." AND consignor_id = '".$consignor_id."'";
				}
				else {
					$where = "consignor_id = '".$consignor_id."'";
				}
			}
			if(!empty($godown_id)) {
				if(!empty($where)) {
					$where = $where." AND godown_id = '".$godown_id."'";
				}
				else {
					$where = "godown_id = '".$godown_id."'";
				}
			}
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND tripsheet_date >= '".$from_date."'";
				}
				else {
					$where = "tripsheet_date >= '".$from_date."'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND tripsheet_date <= '".$to_date."'";
				}
				else {
					$where = "tripsheet_date <= '".$to_date."'";
				}
			}
			
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['tripsheet_table']." WHERE ".$where." AND deleted = '0' AND cancelled = '0'  ORDER BY id DESC";	
			}
			else
			{
				$select_query = "SELECT * FROM ".$GLOBALS['tripsheet_table']." WHERE  deleted = '0' AND cancelled = '0'  ORDER BY id DESC";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['tripsheet_table'], $select_query);
			}
			
			return $list;
		}
		public function getLuggagesheetList($consignor_id,$branch_id,$status,$from_date,$to_date) {
			$list = array(); $select_query = ""; $where = "";

			
			if(!empty($consignor_id)) {
				if(!empty($where)) {
					$where = $where." AND consignor_id = '".$consignor_id."'";
				}
				else {
					$where = "consignor_id = '".$consignor_id."'";
				}
			}
			if(!empty($branch_id)) {
				if(!empty($where)) {
					$where = $where." AND branch_id = '".$branch_id."'";
				}
				else {
					$where = "branch_id = '".$branch_id."'";
				}
			}
			// if(!empty($from_date)) {
			// 	$from_date = date("Y-m-d", strtotime($from_date));
			// 	if(!empty($where)) {
			// 		$where = $where." AND luggage_date >= '".$from_date."'";
			// 	}
			// 	else {
			// 		$where = "luggage_date >= '".$from_date."'";
			// 	}
			// }
			// if(!empty($to_date)) {
			// 	$to_date = date("Y-m-d", strtotime($to_date));
			// 	if(!empty($where)) {
			// 		$where = $where." AND luggage_date <= '".$to_date."'";
			// 	}
			// 	else {
			// 		$where = "luggage_date <= '".$to_date."'";
			// 	}
			// }
			if($status == '1')
			{
				if(!empty($where)) {
					$select_query = "SELECT * FROM ".$GLOBALS['luggagesheet_table']." WHERE ".$where." AND deleted = '0' AND cancelled = '1'  ORDER BY id DESC";	
				}
				else
				{
					 $select_query = "SELECT * FROM ".$GLOBALS['luggagesheet_table']." WHERE  deleted = '0' AND cancelled = '1'  ORDER BY id DESC";	
				}
				if(!empty($select_query)) {
					$list = $this->getQueryRecords($GLOBALS['luggagesheet_table'], $select_query);
				}
			}
			else
			{
				if(!empty($where)) {
					$select_query = "SELECT * FROM ".$GLOBALS['luggagesheet_table']." WHERE ".$where." AND deleted = '0' AND cancelled = '0'  ORDER BY id DESC";	
				}
				else
				{
					$select_query = "SELECT * FROM ".$GLOBALS['luggagesheet_table']." WHERE  deleted = '0' AND cancelled = '0'  ORDER BY id DESC";	
				}
				if(!empty($select_query)) {
					$list = $this->getQueryRecords($GLOBALS['luggagesheet_table'], $select_query);
				}
			}
			
			return $list;
		}
		public function UpdateLuggage($luggage_id) {
			$getUniqueId = $this->getTableColumnValue($GLOBALS['luggagesheet_table'],'luggage_id',$luggage_id,'id');
			$columns = array(); $values = array();          		
			$columns = array('is_cleared');
			$values = array("'1'");
			$list = $this->UpdateSQL($GLOBALS['luggagesheet_table'], $getUniqueId, $columns, $values,'');
			return $list;
		}
		public function getClearedLuggagesheetLR($luggage_id) {
			$luggagesheet_number = $this->getTableColumnValue($GLOBALS['luggagesheet_table'],'luggage_id',$luggage_id,'luggagesheet_number');
			$select_query ="";
			$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE  luggagesheet_number = '".$luggagesheet_number."' AND is_tripsheet_entry = '1' ";
			$luggage_lr_list = $this->getQueryRecords('',$select_query);
			return $luggage_lr_list;
		}
		public function getUnClearencelLrList($branch_id) {
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
			$where = ""; $from_where = "";
			if(!empty($branch_id)) {
				for($i=0; $i < count($branch_id); $i++) {
					if(!empty($branch_id[$i])) {
						if(!empty($from_where)) {
							$from_where = $from_where." OR to_branch_id = '".$branch_id[$i]."'";
						}
						else {
							$from_where = " to_branch_id = '".$branch_id[$i]."'";
						}
					}
				}
			}
			if(!empty($from_where)) {
				$where = " (".$from_where.") AND ";
			}
			if(!empty($from_date) && !empty($to_date)) {
				$lr_list = array();
				$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE ".$where." DATE(lr_date) >= '".$from_date."' AND DATE(lr_date) <= '".$to_date."'	AND is_tripsheet_entry = '1' AND deleted ='0' ";
				$lr_list = $this->getQueryRecords($GLOBALS['lr_table'],$select_query);
			}
			return $lr_list;
		}
		public function organizationDetails($organization_id, $table) {
			$bill_company_details = "";
			// if(!empty($organization_id)) {
				$check_organization = array();
				$check_organization = $this->getTableRecords($GLOBALS['organization_table'], '','');
				if(!empty($check_organization)) {
					foreach($check_organization as $data) {
				
						if(!empty($data['name'])) {
							$bill_company_details = $this->encode_decode('decrypt', $data['name']);
						}
						if(!empty($data['address_line1']) && $data['address_line1'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['address_line1']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];	
						}
						if(!empty($data['address_line2']) && $data['address_line2'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['address_line2']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];	
						}
						if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['city']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];	
						}
						if(!empty($data['pincode']) && $data['pincode'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['pincode']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];	
						}
						if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['state']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];	
						}
						if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['gst_number']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['mobile_number']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
					}
				}
				if(!empty($bill_company_details)) {
					$bill_company_details = $this->encode_decode('encrypt', $bill_company_details);
				}
			// }
			return $bill_company_details;
		}
		public function getGodownReport($filter_godown_id,$from_date,$to_date,$branch_id) {
			$list = array(); $select_query = ""; $where = "";

			if(!empty($filter_godown_id)) {
				$where = "godown_id = '".$filter_godown_id."'";
			}
			if(!empty($branch_id)) {
				if(!empty($where)) {
					$where = $where."branch_id = '".$branch_id."'";
				}
				else {
					$where = "branch_id = '".$branch_id."'";
				}
			}
			if(!empty($from_date)) {
				$from_date = date("Y-m-d", strtotime($from_date));
				if(!empty($where)) {
					$where = $where." AND lr_date >= '".$from_date."'";
				}
				else {
					$where = "lr_date >= '".$from_date."'";
				}
			}
			if(!empty($to_date)) {
				$to_date = date("Y-m-d", strtotime($to_date));
				if(!empty($where)) {
					$where = $where." AND lr_date <= '".$to_date."'";
				}
				else {
					$where = "lr_date <= '".$to_date."'";
				}
			}
			
			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0' AND godown_id != 0 ORDER BY id DESC";	
			}
			else
			{
				$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE  deleted = '0'  ORDER BY id DESC";	
			}
			if(!empty($select_query)) {
				$list = $this->getQueryRecords($GLOBALS['lr_table'], $select_query);
			}
			return $list;
		}
		public function LrLuggageUpdate($lr_id,$luggagesheet_number) {
			$getUniqueId = $this->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_id,'id');
			$columns = array(); $values = array();          		
			$columns = array('is_luggage_entry','luggagesheet_number');
			$values = array("'1'","'".$luggagesheet_number."'");
			$list = $this->UpdateSQL($GLOBALS['lr_table'], $getUniqueId, $columns, $values,'');
			return $list;
		}
		public function consignorDetails($consignor_id, $table) {
			$bill_company_details = "";
			if(!empty($consignor_id)) {
				$check_consignor = array();
				$check_consignor = $this->getTableRecords($GLOBALS['consignor_table'],'consignor_id',$consignor_id);
				if(!empty($check_consignor)) {
					foreach($check_consignor as $data) {
						if(!empty($data['name'])) {
							$bill_company_details = $this->encode_decode('decrypt', $data['name']);
						}
						if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['mobile_number']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['identification']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value']."$$$";
						}
						if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['address']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['city']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];	
						}
						
						if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['district']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];	
						}

						if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['state']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];	
						}
						
						if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['email']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						
					}
				}
				if(!empty($bill_company_details)) {
					$bill_company_details = $this->encode_decode('encrypt', $bill_company_details);
				}
			}
			return $bill_company_details;
		}
		public function consigneeDetails($consignee_id, $table) {
			$bill_company_details = "";
			if(!empty($consignee_id)) {
				$check_consignee = array();
				$check_consignee = $this->getTableRecords($GLOBALS['consignee_table'], 'consignee_id',$consignee_id);
				if(!empty($check_consignee)) {
					foreach($check_consignee as $data) {
				
						if(!empty($data['name'])) {
							$bill_company_details = $this->encode_decode('decrypt', $data['name']);
						}
						if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['mobile_number']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['identification']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['address']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['city']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['district']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];	
						}
						if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode("decrypt",$data['state']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['email']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						
					}
				}
				if(!empty($bill_company_details)) {
					$bill_company_details = $this->encode_decode('encrypt', $bill_company_details);
				}
			}
			return $bill_company_details;
		}
		public function accountpartyDetails($account_party_id, $table) {
			$bill_company_details = "";
			if(!empty($account_party_id)) {
				$check_account_party = array();
				$check_account_party = $this->getTableRecords($GLOBALS['account_party_table'], 'account_party_id',$account_party_id);
				if(!empty($check_account_party)) {
					foreach($check_account_party as $data) {
				
						if(!empty($data['name'])) {
							$bill_company_details = $this->encode_decode('decrypt', $data['name']);
						}
						if(!empty($data['address']) && $data['address'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['address']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode("decrypt",$data['state']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['city']);
						}
						else
						{
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['mobile_number']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['email']) && $data['email'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['email']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['identification']) && $data['identification'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['identification']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'].'$$$';
						}
					}
				}
				if(!empty($bill_company_details)) {
					$bill_company_details = $this->encode_decode('encrypt', $bill_company_details);
				}
			}
			return $bill_company_details;
		}
		public function vehicleDetails($vehicle_id, $table) {
			$bill_company_details = "";
			if(!empty($vehicle_id)) {
				$check_vehicle = array();
				$check_vehicle = $this->getTableRecords($GLOBALS['vehicle_table'], 'vehicle_id',$vehicle_id);
				if(!empty($check_vehicle)) {
					foreach($check_vehicle as $data) {
				
						if(!empty($data['name'])) {
							$bill_company_details = $this->encode_decode('decrypt', $data['name']);
						}
						if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['mobile_number']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						
						if(!empty($data['vehicle_number']) && $data['vehicle_number'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['vehicle_number']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
					}
				}
				if(!empty($bill_company_details)) {
					$bill_company_details = $this->encode_decode('encrypt', $bill_company_details);
				}
			}
			return $bill_company_details;
		}
		public function getLRDetailsById($tripsheet_id){
			$tripsheet_list = array();
			if(!empty($tripsheet_id)) {
				$tripsheet_number = ""; $trip_lr_ids = "";

				$tripsheet_list = array();
				$tripsheet_list = $this->getTableRecords($GLOBALS['tripsheet_table'], 'tripsheet_id', $tripsheet_id);
				if(!empty($tripsheet_list)) {
					foreach($tripsheet_list as $data) {
						if(!empty($data['tripsheet_number'])) { $tripsheet_number =  $data['tripsheet_number']; }
						if(!empty($data['lr_id'])) { $trip_lr_ids = $data['lr_id']; }						
					}
				}

				if(!empty($tripsheet_number) && !empty($trip_lr_ids)) {
					$select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE FIND_IN_SET(lr_id, '".$trip_lr_ids."') AND deleted = '0' ORDER BY from_branch_id";
					$tripsheet_list = $this->getQueryRecords('',$select_query);
				}
			}
			return $tripsheet_list;
		}
		public function BillCompanyDetails($bill_company_id, $table) {
			$bill_company_details = "";
			if(!empty($bill_company_id)) {
				$check_company = array();
				$check_company = $this->getTableRecords($GLOBALS['organization_table'], '','');
				if(!empty($check_company)) {
					foreach($check_company as $data) {
						if(!empty($data['name'])) {
							$bill_company_details = $this->encode_decode('decrypt', $data['name']);
						}
						if(!empty($data['address_line1'])) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['address_line1']);
						}
						if(!empty($data['city'])) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['city']);
						}
						if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['district']);
						}
						if(!empty($data['state'])) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['state']);
						}
						if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['mobile_number']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['pincode']) && $data['pincode'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".$this->encode_decode('decrypt', $data['pincode']);
						}
						else {
							$bill_company_details = $bill_company_details."$$$".$GLOBALS['null_value'];
						}
						if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']) {
							$bill_company_details = $bill_company_details."$$$".' GSTIN : '.$this->encode_decode('decrypt', $data['gst_number']);
						}
					
					}
				}
				if(!empty($bill_company_details)) {
					$bill_company_details = $this->encode_decode('encrypt', $bill_company_details);
				}
			}
			return $bill_company_details;
		}
		public function getPurchaseList($from_date, $to_date,$search_text,$show_bill,$party_id) {
            $list = array(); $select_query = ""; $where = "";
            $bill_company_id = $GLOBALS['bill_company_id'];
            if(!empty($bill_company_id)) {
				$where = "bill_company_id = '".$bill_company_id."' ";
			}
            if(!empty($from_date)) {
                $from_date = date("Y-m-d", strtotime($from_date));
                if(!empty($where)) {
                    $where = $where." AND purchase_entry_date >= '".$from_date."'";
                }
                else {
                    $where = "purchase_entry_date >= '".$from_date."'";
                }
            }
            if(!empty($to_date)) {
                $to_date = date("Y-m-d", strtotime($to_date));
                if(!empty($where)) {
                    $where = $where." AND purchase_entry_date <= '".$to_date."'";
                }
                else {
                    $where = "purchase_entry_date <= '".$to_date."'";
                }
            }
            if($show_bill == '0' || $show_bill == '1'){
                if(!empty($where)) {
                    $where = $where." AND cancelled = '".$show_bill."' ";
                }
                else {
                    $where = "cancelled = '".$show_bill."' ";
                }
            }

			if(!empty($party_id))
			{
				if(!empty($where)){
					$where = $where." AND party_id = '".$party_id."' ";
				}
				else
				{
					 $where = "party_id = '".$party_id."' ";
				}
			}

			if(!empty($where)) {
				$select_query = "SELECT * FROM ".$GLOBALS['purchase_entry_table']." WHERE ".$where." AND deleted = '0' ORDER BY id DESC";	
			}
			else{
				$select_query = "SELECT * FROM ".$GLOBALS['purchase_entry_table']." WHERE cancelled = '0' AND deleted = '0' ORDER BY id DESC";
			}
            if(!empty($select_query)) {
                $list = $this->getQueryRecords($GLOBALS['purchase_entry_table'], $select_query);
            }
            return $list;
        }
		public function DeletePurchaseEntryInVoucher($purchase_entry_id){
			$voucher_unique_id = ""; $action = ""; $msg = "";
			$voucher_unique_id = $this->getTableColumnValue($GLOBALS['voucher_table'], 'purchase_entry_id', $purchase_entry_id, 'id');
			if(!empty($voucher_unique_id)){
				 $columns = array(); $values = array();			
                    $columns = array('deleted');
                    $values = array("'1'");
                    $msg = $this->UpdateSQL($GLOBALS['voucher_table'], $voucher_unique_id, $columns, $values, $action);
			}
			return $msg;
		}

		public function LRLinkedCount($lr_number){

				$list = array(); $select_query = "";  $count = 0;
			if(!empty($lr_number)) {
				$where = "lr_number = '".$lr_number."' ";
			}

			if(!empty($where)){
				 $select_query = "SELECT count(id) as id_count FROM ".$GLOBALS['receipt_table']." WHERE ".$where." AND deleted = '0'";
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
    }
?>