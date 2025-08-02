
<?php
	include("basic_functions.php");
	include("estimate_billing_functions.php");
	include("creation_functions.php");
	include("payment_functions.php");
	include("updation_functions.php");
	include("report_functions.php");

	class billing extends Basic_Functions {
		public function getProjectTitle() {
			$string = parent::getProjectTitle();
			return $string;
		}
		public function encode_decode($action, $string) {
			$string = parent::encode_decode($action, $string);
			return $string;
		}		
		public function InsertSQL($table, $columns, $values, $action) {
			$last_insert_id = "";		
			$last_insert_id = parent::InsertSQL($table, $columns, $values, $action);
			return $last_insert_id;
		}	
		public function UpdateSQL($table, $update_id, $columns, $values, $action) {
			$msg = "";		
			$msg = parent::UpdateSQL($table, $update_id, $columns, $values, $action);
			return $msg;
		}
		public function getTableColumnValue($table, $column, $value, $return_value) {
			$result = "";
			$result = parent::getTableColumnValue($table, $column, $value, $return_value);
			return $result;
		}
		public function getTableRecords($table, $column, $value) {
			$result = "";		
			$result = parent::getTableRecords($table, $column, $value);
			return $result;
		}
		public function daily_db_backup() {
			$result = "";		
			$result = parent::daily_db_backup();
			return $result;
		}
		public function image_directory() {
			$target_dir = "";		
			$target_dir = parent::image_directory();
			return $target_dir;
		}
		public function temp_image_directory() {
			$temp_dir = "";		
			$temp_dir = parent::temp_image_directory();
			return $temp_dir;
		}
		public function clear_temp_image_directory() {
			$res = "";		
			$res = parent::clear_temp_image_directory();
			return $res;
		}
		public function check_user_id_ip_address() {
			$check_login_id = "";			
			$check_login_id = parent::check_user_id_ip_address();			
			return $check_login_id;	
		}
		public function checkUser() {
			$login_user_id = "";			
			$login_user_id = parent::checkUser();			
			return $login_user_id;	
		}
		public function getDailyReport($from_date, $to_date) {
			$list = array();
			$list = parent::getDailyReport($from_date, $to_date);
			return $list;
		}
		public function send_mobile_details($mobile_number, $sms_number, $sms) {
			$res = "";
			$res = parent::send_mobile_details($mobile_number, $sms_number, $sms);
			return true;
		}
		/*public function send_mobile_details($phone_number, $msg) {
			$res = "";
			$res = parent::send_mobile_details($phone_number, $msg);
			return true;
		}*/
		public function automate_number($table, $column,$branch_id, $company_id) {
			$next_number = "";
			$next_number = parent::automate_number($table, $column,$branch_id, $company_id);
			return $next_number;
		}
		public function UpdateLRNumber() {
			$updated = "";
			$updated = parent::UpdateLRNumber();
			return $updated;
		}
		public function ClearLRDetails($from_date, $to_date) {
			$updated = "";
			$updated = parent::ClearLRDetails($from_date, $to_date);
			return $updated;
		}
		public function getBillingYearList() {
			$list = array();
			$list = parent::getBillingYearList();
			return $list;
		}
		public function CompanyCount() {
			$list = 0;
			$list = parent::CompanyCount();
			return $list;
		}
		public function getAllRecords($table, $column, $value) {
			$res = "";		
			$res = parent::getAllRecords($table, $column, $value);
			return $res;
		}
		public function numberFormat($number, $decimals) {
			$list = 0;
			$list = parent::numberFormat($number, $decimals);
			return $list;
		}
		public function getOtherCityList($district) {
			$list = array();
			$list = parent::getOtherCityList($district);
			return $list;
		}
		public function CheckRoleAccessPage($role_id, $permission_page) {
			$list = array();
			$list = parent::CheckRoleAccessPage($role_id, $permission_page);
			return $list;
		}

		// Estimate billing functions
		public function billing_function_object() {
			$billobj = "";		
			$billobj = new Billing_Functions();
			return $billobj;
		}
		public function CheckUnitNameAlreadyExists($unit_name) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$unit_id = "";
			$unit_id = $billobj->CheckUnitNameAlreadyExists($unit_name);
			return $unit_id;
		}
		public function CheckBranchNameAlreadyExists($branch_name,$branch_city) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$branch_id = "";
			$branch_id = $billobj->CheckBranchNameAlreadyExists($branch_name,$branch_city);
			return $branch_id;
		}
		public function CheckBranchLrAlreadyExists($branch_lr_prefix) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$branch_id = "";
			$branch_id = $billobj->CheckBranchLrAlreadyExists($branch_lr_prefix);
			return $branch_id;
		}
		public function CheckBranchMobileAlreadyExists($branch_contact_number) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$branch_id = "";
			$branch_id = $billobj->CheckBranchMobileAlreadyExists($branch_contact_number);
			return $branch_id;
		}
		public function getTrackLRnumberDetailsList($from_date, $to_date, $lr_number) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$lr_list = "";
			$lr_list = $billobj->getTrackLRnumberDetailsList($from_date, $to_date, $lr_number);
			return $lr_list;
		}
		public function getLRDetailsList($bill_company_id,$organization_id, $from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,$status,$from_date, $to_date,$godown_id, $filter_gst_type) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$lr_list = "";
			$lr_list = $billobj->getLRDetailsList($bill_company_id,$organization_id, $from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,$status,$from_date, $to_date,$godown_id, $filter_gst_type);
			return $lr_list;
		}
		public function getClearanceReportCount($bill_company_id,$organization_id, $from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,$status,$from_date, $to_date,$godown_id, $search_lr_number) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$lr_list = "";
			$lr_list = $billobj->getClearanceReportCount($bill_company_id,$organization_id, $from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,$status,$from_date, $to_date,$godown_id, $search_lr_number);
			return $lr_list;
		}
		public function getClearanceReportList($bill_company_id,$organization_id, $from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,$status,$from_date, $to_date,$godown_id, $search_lr_number, $page_number, $page_limit, $total_lr_count) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$lr_list = "";
			$lr_list = $billobj->getClearanceReportList($bill_company_id,$organization_id, $from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,$status,$from_date, $to_date,$godown_id, $search_lr_number, $page_number, $page_limit, $total_lr_count);
			return $lr_list;
		}
		public function getUnClearanceReportList($bill_company_id,$organization_id,$from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,$status,$from_date, $to_date,$godown_id) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$lr_list = "";
			$lr_list = $billobj->getUnClearanceReportList($bill_company_id,$organization_id,$from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,$status,$from_date, $to_date,$godown_id);
			return $lr_list;
		}
		public function checkVehicleNumberAlreadyExists($vehicle_number) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$lr_list = "";
			$lr_list = $billobj->checkVehicleNumberAlreadyExists($vehicle_number);
			return $lr_list;
		}
		public function CheckDriverAlreadyExists($driver_name,$driver_number) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$driver_id = "";
			$driver_id = $billobj->CheckDriverAlreadyExists($driver_name,$driver_number);
			return $driver_id;
		}
		public function getTripsheetDetailsList($consignor_id,$godown_id,$from_date,$to_date) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$invoice_list = "";
			$invoice_list = $billobj->getTripsheetDetailsList($consignor_id,$godown_id,$from_date,$to_date);
			return $invoice_list;
		}
		public function getLuggagesheetList($consignor_id,$branch_id,$status,$from_date,$to_date) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$invoice_list = "";
			$invoice_list = $billobj->getLuggagesheetList($consignor_id,$branch_id,$status,$from_date,$to_date);
			return $invoice_list;
		}
		public function consignorDetails($consignor_id, $table) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$invoice_list = "";
			$invoice_list = $billobj->consignorDetails($consignor_id, $table);
			return $invoice_list;
		}
		public function organizationDetails($bill_company_id, $table) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$invoice_list = "";
			$invoice_list = $billobj->organizationDetails($bill_company_id, $table);
			return $invoice_list;
		}
		public function getUnClearencelLrList($branch_id) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$invoice_list = "";
			$invoice_list = $billobj->getUnClearencelLrList($branch_id);
			return $invoice_list;
		}
		public function consigneeDetails($consignee_id, $table) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$invoice_list = "";
			$invoice_list = $billobj->consigneeDetails($consignee_id, $table);
			return $invoice_list;
		}
		public function accountpartyDetails($bill_company_id, $table) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$invoice_list = "";
			$invoice_list = $billobj->accountpartyDetails($bill_company_id, $table);
			return $invoice_list;
		}
		public function vehicleDetails($bill_company_id, $table) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$invoice_list = "";
			$invoice_list = $billobj->vehicleDetails($bill_company_id, $table);
			return $invoice_list;
		}
		public function LrTripsheetUpdate($lr_id,$tripsheet_number) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$list = array();
			$list = $billobj->LrTripsheetUpdate($lr_id,$tripsheet_number);
			return $list;
		}
		public function UpdateLuggage($luggage_id) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$list = array();
			$list = $billobj->UpdateLuggage($luggage_id);
			return $list;
		}
		public function getLRDetailsById($tripsheet_id) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$list = array();
			$list = $billobj->getLRDetailsById($tripsheet_id);
			return $list;
		}
		public function LrLuggageUpdate($lr_id,$luggagesheet_number) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$list = array();
			$list = $billobj->LrLuggageUpdate($lr_id,$luggagesheet_number);
			return $list;
		}
		public function getGodownReport($filter_godown_id,$from_date,$to_date,$branch_id) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$invoice_list = "";
			$invoice_list = $billobj->getGodownReport($filter_godown_id,$from_date,$to_date,$branch_id);
			return $invoice_list;
		}
		public function getClearedLuggagesheetLR($luggage_id) {
			$billobj = "";
			$billobj = $this->billing_function_object();
			$list = array();
			$list = $billobj->getClearedLuggagesheetLR($luggage_id);
			return $list;
		}
		public function getPurchaseList($from_date, $to_date,$search_text,$show_bill,$party_id) {
			$billing_obj = "";
			$billing_obj = $this->billing_function_object();
			$list = array();
			$list = $billing_obj->getPurchaseList($from_date, $to_date,$search_text,$show_bill,$party_id);
			return $list;
		}
		public function BillCompanyDetails($bill_company_id, $table) {
			$billing_obj = "";
			$billing_obj = $this->billing_function_object();
			$bill_company_details = "";
			$bill_company_details = $billing_obj->BillCompanyDetails($bill_company_id, $table);
			return $bill_company_details;
		}
		public function DeletePurchaseEntryInVoucher($bill_unique_id){
			$billing_obj = "";
			$billing_obj = $this->billing_function_object();
			$list = array();
			$list = $billing_obj->DeletePurchaseEntryInVoucher($bill_unique_id);
			return $list;
		}

		// Creation functions
		public function creation_function_object() {
			$create_obj = "";		
			$create_obj = new Creation_functions();
			return $create_obj;
		}
		public function CheckPaymentModeAlreadyExists($company_id, $payment_mode_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckPaymentModeAlreadyExists($company_id, $payment_mode_name);
			return $result;
		}
		public function GetPaymentmodeLinkedCount($payment_mode_id) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = "";
			$result = $creationobj->GetPaymentmodeLinkedCount($payment_mode_id);
			return $result;
		}
		public function GetBankLinkedCount($bank_id) {
			$creationobj = "";
			$creationobj = $this->creation_function_object();
			$result = "";
			$result = $creationobj->GetBankLinkedCount($bank_id);
			return $result;
		}
		public function GetProductLinkedCount($product_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->GetProductLinkedCount($product_id);
			return $list;
		}
		public function GetPartyLinkedCount($party_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->GetPartyLinkedCount($party_id);
			return $list;
		}
	
		public function GetRoleLinkedCount($role_id) {
			$result = "";
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = $create_obj->GetRoleLinkedCount($role_id);
			return $result;
		}
		public function CheckChargesAlreadyExists($company_id, $charges_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckChargesAlreadyExists($company_id, $charges_name);
			return $result;
		}
		public function GetChargesLinkedCount($charges_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetChargesLinkedCount($charges_id);
			return $result;
		}
		public function GetSalesPartyLinkedCount($sales_party_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetSalesPartyLinkedCount($sales_party_id);
			return $result;
		}
		public function GetUnitLinkedCount($unit_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetUnitLinkedCount($unit_id);
			return $result;
		}
		public function GetBranchLinkedCount($branch_id){
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetBranchLinkedCount($branch_id);
			return $result;
		}
		public function CheckExpenseCategoryAlreadyExists($bill_company_id,$expense_category_name) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->CheckExpenseCategoryAlreadyExists($bill_company_id,$expense_category_name);
			return $result;
		}
		public function getClearTableRecords($table) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$list = array();
			$list = $create_obj->getClearTableRecords($table);
			return $list;
		}

		// Payment functions
		public function payment_function_object() {
			$payment_obj = "";		
			$payment_obj = new Payment_functions();
			return $payment_obj;
		}
		public function DeletePayment($bill_id){
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->DeletePayment($bill_id);
			return $list;
		}
		public function getPartyOpeningBalanceInPaymentExist($party_id, $bill_type) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getPartyOpeningBalanceInPaymentExist($party_id, $bill_type);
			return $list;
		}
		public function getPaymentUniqueID($bill_unique_id, $payment_mode_id, $bank_id, $payment_tax_type){
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getPaymentUniqueID($bill_unique_id, $payment_mode_id, $bank_id, $payment_tax_type);
			return $list;
		}
		public function PrevPaymentList($bill_unique_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->PrevPaymentList($bill_unique_id);
			return $list;
		}
		public function DeleteCompanyOpeningBalance($organization_id,$payment_mode_id, $bank_id, $payment_tax_type){
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->DeleteCompanyOpeningBalance($organization_id,$payment_mode_id, $bank_id, $payment_tax_type);
			return $list;
		}
		public function checkAvailableBalance($bill_company_id, $tax_type, $payment_mode_id, $bank_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->checkAvailableBalance($bill_company_id, $tax_type, $payment_mode_id, $bank_id);
			return $list;
		}
		public function getPartyList($type){
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getPartyList($type);
			return $list;
		}
		public function getVoucherList($from_date, $to_date, $show_bill, $filter_party_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getVoucherList($from_date, $to_date, $show_bill, $filter_party_id);
			return $list;
		}
		public function GetPaymentAmount($payment_tax_type,$payment_mode_id, $bank_id, $login_branch_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->GetPaymentAmount($payment_tax_type,$payment_mode_id, $bank_id, $login_branch_id);
			return $list;
		}
		public function getPendingList($party_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getPendingList($party_id);
			return $list;
		}
		public function getExpenseList($from_date, $to_date, $show_bill, $filter_expense_category_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getExpenseList($from_date, $to_date, $show_bill, $filter_expense_category_id);
			return $list;
		}
		public function getSuspenseVoucherList($from_date, $to_date, $show_bill, $filter_party_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getSuspenseVoucherList($from_date, $to_date, $show_bill, $filter_party_id);
			return $list;
		}
		public function getSuspensePartyList(){
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getSuspensePartyList();
			return $list;
		}
		public function getSuspenseReceiptList($from_date, $to_date, $show_bill, $filter_party_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getSuspenseReceiptList($from_date, $to_date, $show_bill, $filter_party_id);
			return $list;
		}
		public function getPaymentPartyList($filter_bill_type) {
			$report_obj = "";
			$report_obj = $this->payment_function_object();
			$list = array();
			$list = $report_obj->getPaymentPartyList($filter_bill_type);
			return $list;
		}
		public function getPaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_id,$filter_payment_mode_id,$filter_bank_id,$filter_category_id) {
			$report_obj = "";
			$report_obj = $this->payment_function_object();
			$list = array();
			$list = $report_obj->getPaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_id,$filter_payment_mode_id,$filter_bank_id,$filter_category_id);
			return $list;
		}
		public function GetLRNumberList($party_type, $party_id, $bill_type, $login_branch_id){
			$report_obj = "";
			$report_obj = $this->payment_function_object();
			$list = array();
			$list = $report_obj->GetLRNumberList($party_type, $party_id, $bill_type, $login_branch_id);
			return $list;
		}
		public function getReceiptList($from_date, $to_date, $show_bill, $filter_party_id, $filter_lr_id, $login_branch_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getReceiptList($from_date, $to_date, $show_bill, $filter_party_id, $filter_lr_id, $login_branch_id);
			return $list;
		}
		public function CheckBalanceForReceiptRestriction($delete_receipt_id){
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->CheckBalanceForReceiptRestriction($delete_receipt_id);
			return $list;
		}
		public function DeleteBranchPayment($bill_id, $branch_id, $payment_tax_type){
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->DeleteBranchPayment($bill_id, $branch_id, $payment_tax_type);
			return $list;
		}
		public function UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type, $payment_tax_type, $branch_id){
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->UpdateBalance($bill_id,$bill_number,$bill_date,$bill_type,$party_id,$party_name,$party_type,$payment_mode_id,$payment_mode_name,$bank_id,$bank_name,$credit,$debit,$open_balance_type, $payment_tax_type, $branch_id);
			return $list;
		}
		public function CheckBalanceForInvestRestriction($invest_id){
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->CheckBalanceForInvestRestriction($invest_id);
			return $list;
		}
		public function getinvestList($bill_company_id,$from_date, $to_date, $show_bill) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getinvestList($bill_company_id,$from_date, $to_date, $show_bill);
			return $list;
		}
		public function getReturnList($bill_company_id,$from_date, $to_date, $show_bill) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->getReturnList($bill_company_id,$from_date, $to_date, $show_bill);
			return $list;
		}

		// Updation functions
		public function updation_function_object() {
			$updation_obj = "";		
			$updation_obj = new Updation_Functions();
			return $updation_obj;
		}
		public function getUnitPriceUniqueID($party_type, $party_id, $unit_id) {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->getUnitPriceUniqueID($party_type, $party_id, $unit_id);
			return $result;
		}
		public function UpdateUnitPrice($party_type, $party_id, $party_name, $unit_id, $price_value, $cooly_value) {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->UpdateUnitPrice($party_type, $party_id, $party_name, $unit_id, $price_value, $cooly_value);
			return $result;
		}
		public function ToBranchList($from_branch_id) {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->ToBranchList($from_branch_id);
			return $result;
		}
		public function getPriceValue($party_id, $unit_id) {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->getPriceValue($party_id, $unit_id);
			return $result;
		}
		public function getCoolyValue($party_id, $unit_id) {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->getCoolyValue($party_id, $unit_id);
			return $result;
		}
		public function GetLRListByBranch($from_date, $to_date, $from_branch_id, $to_branch_id) {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->GetLRListByBranch($from_date, $to_date, $from_branch_id, $to_branch_id);
			return $result;
		}
		public function getLRListRecords($row, $rowperpage, $searchValue, $organization_id, $from_date, $to_date, $from_branch_id, $to_branch_id, $consignee_id, $consignor_id, $bill_type, $status, $order_column, $order_direction, $filter_gst_option) {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->getLRListRecords($row, $rowperpage, $searchValue, $organization_id, $from_date, $to_date, $from_branch_id, $to_branch_id, $consignee_id, $consignor_id, $bill_type, $status, $order_column, $order_direction, $filter_gst_option);
			return $result;
		}
		public function getTripsheetListRecords($row, $rowperpage, $searchValue, $from_date, $to_date, $from_branch_filter, $to_branch_filter, $order_column, $order_direction) {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->getTripsheetListRecords($row, $rowperpage, $searchValue, $from_date, $to_date, $from_branch_filter, $to_branch_filter, $order_column, $order_direction);
			return $result;
		}
		public function getAcknowledgedTripsheetListRecords($row, $rowperpage, $searchValue, $from_date, $to_date, $login_branch_id, $order_column, $order_direction) {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->getAcknowledgedTripsheetListRecords($row, $rowperpage, $searchValue, $from_date, $to_date, $login_branch_id, $order_column, $order_direction);
			return $result;
		}
		public function getUnclearedRecordsList($row, $rowperpage, $lr_number, $from_date, $to_date, $login_branch_id, $order_column, $order_direction) {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->getUnclearedRecordsList($row, $rowperpage, $lr_number, $from_date, $to_date, $login_branch_id, $order_column, $order_direction);
			return $result;
		}
		public function VehicleInsuranceExpiryList() {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->VehicleInsuranceExpiryList();
			return $result;
		}
		public function DriverLicenseExpiryList() {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->DriverLicenseExpiryList();
			return $result;
		}
		public function getTripsheetListForProfitLoss($vehicle_id) {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->getTripsheetListForProfitLoss($vehicle_id);
			return $result;
		}
		public function getTripsheetProfitLossListRecords($row, $rowperpage, $order_column, $order_direction) {
			$updation_obj = "";
			$updation_obj = $this->updation_function_object();
			$result = "";
			$result = $updation_obj->getTripsheetProfitLossListRecords($row, $rowperpage, $order_column, $order_direction);
			return $result;
		}
		
		// Report functions
		public function report_function_object() {
			$report_obj = "";		
			$report_obj = new Report_functions();
			return $report_obj;
		}
		public function getPurchaseReportList($from_date, $to_date,$bill_no, $party_id,$cancel_bill_btn) {
			$reportobj = "";
			$reportobj = $this->report_function_object();
			$list = array();
			$list = $reportobj->getPurchaseReportList($from_date, $to_date,$bill_no, $party_id,$cancel_bill_btn);
			return $list;
		}
		public function getPurchaseTaxReport($filter_party_id,$from_date, $to_date) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getPurchaseTaxReport($filter_party_id,$from_date, $to_date);
			return $list;
		}
		public function getSalesPartyList(){
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getSalesPartyList();
			return $list;
		}
		public function getSalesTaxReport($party_type,$filter_party_id,$from_date, $to_date,$filter_party_type) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getSalesTaxReport($party_type,$filter_party_id,$from_date, $to_date,$filter_party_type);
			return $list;
		}
		public function getOpeningBalance($from_date, $to_date, $purchase_party_id, $consignor_id, $consignee_id, $account_party_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getOpeningBalance($from_date, $to_date, $purchase_party_id, $consignor_id, $consignee_id, $account_party_id);
			return $list;
		}
		public function GetPendingBalanceList($from_date, $to_date, $purchase_party_id, $consignor_id, $consignee_id, $account_party_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->GetPendingBalanceList($from_date, $to_date, $purchase_party_id, $consignor_id, $consignee_id, $account_party_id);
			return $list;
		}
		public function getSuspensePaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_id,$payment_mode_id,$bank_id){
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getSuspensePaymentReportList($from_date,$to_date,$filter_bill_type,$filter_party_id,$payment_mode_id,$bank_id);
			return $list;
		}
		public function GetSuspensePendingBalanceList($from_date, $to_date, $suspense_party_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->GetSuspensePendingBalanceList($from_date, $to_date, $suspense_party_id);
			return $list;
		}
		public function getSuspensePartyOpeningBalance($from_date, $to_date, $suspense_party_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getSuspensePartyOpeningBalance($from_date, $to_date, $suspense_party_id);
			return $list;
		}
		public function CompanyBalanceList($payment_tax_type, $payment_mode_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->CompanyBalanceList($payment_tax_type, $payment_mode_id);
			return $list;
		}
		public function BranchBalanceList($payment_tax_type, $branch_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->BranchBalanceList($payment_tax_type, $branch_id);
			return $list;
		}
		public function getDaybookReportList($from_date, $to_date,$filter_purchase_party_id, $filter_consignor_id, $filter_consignee_id, $filter_account_party_id, $filter_bill_type, $payment_mode_id, $bank_id,$filter_suspense_party_id) {
			$report_obj = "";
			$report_obj = $this->report_function_object();
			$list = array();
			$list = $report_obj->getDaybookReportList($from_date, $to_date,$filter_purchase_party_id, $filter_consignor_id, $filter_consignee_id, $filter_account_party_id, $filter_bill_type, $payment_mode_id, $bank_id,$filter_suspense_party_id);
			return $list;
		}

		public function GetConsignorLinkedCount($consignor_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetConsignorLinkedCount($consignor_id);
			return $result;
		}
		
		public function GetConsigneeLinkedCount($consignee_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetConsigneeLinkedCount($consignee_id);
			return $result;
		}

		public function GetAccountPartyLinkedCount($account_party_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetAccountPartyLinkedCount($account_party_id);
			return $result;
		}

		public function GetSuspensePartyLinkedCount($suspense_party_id) {
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->GetSuspensePartyLinkedCount($suspense_party_id);
			return $result;
		}

        public function GetPaymentAmountForChecking($payment_tax_type,$payment_mode_id, $bank_id, $voucher_id) {
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->GetPaymentAmountForChecking($payment_tax_type,$payment_mode_id, $bank_id, $voucher_id) ;
			return $list;
		}
		public function CheckBalanceSuspenseForReceipt($delete_suspense_receipt_id){
			$payment_obj = "";
			$payment_obj = $this->payment_function_object();
			$list = array();
			$list = $payment_obj->CheckBalanceSuspenseForReceipt($delete_suspense_receipt_id);
			return $list;
		}


		public function BranchLoginPartyList($party_type,$login_branch_id){
					$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->BranchLoginPartyList($party_type,$login_branch_id);
			return $result;
		}

		public function BranchOBusedinVoucherReturn(){
				$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->BranchOBusedinVoucherReturn();
			return $result;
		}

		public function PaymentlinkedParty($purchase_party_id){
			$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->PaymentlinkedParty($purchase_party_id);
			return $result;
		}

		public function LRLinkedCount($lr_number){
			$billobj = "";
			$billobj = $this->billing_function_object();
			$result = "";
			$result = $billobj->LRLinkedCount($lr_number);
			return $result;
		}

		public function BankLinkedPaymentModes(){
					$create_obj = "";
			$create_obj = $this->creation_function_object();
			$result = "";
			$result = $create_obj->BankLinkedPaymentModes();
			return $result;
		}
	}
?>