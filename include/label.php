<?php
	/*require 'mailin_sms/sms_api.php';
	$GLOBALS['mailin_sms_api_key'] = "zaG0R7cJBhkUbf54";*/

	date_default_timezone_set('Asia/Calcutta');
	$GLOBALS['create_date_time_label'] = date('Y-m-d H:i:s');
	$GLOBALS['site_name_user_prefix'] = "mohan"; $GLOBALS['user_id'] = ""; $GLOBALS['creator'] = "";
	$GLOBALS['creator_name'] = ""; $GLOBALS['null_value'] = "NULL"; $GLOBALS['bill_company_id'] = ""; $GLOBALS['user_type'] = "";

	$GLOBALS['page_number'] = 1; $GLOBALS['page_limit'] = 10; $GLOBALS['page_limit_list'] = array("10", "25", "50", "100");

	$GLOBALS['backup_folder_name'] = 'backup';
	$GLOBALS['log_backup_file'] = $GLOBALS['backup_folder_name']."/logs/".date("Y").".csv"; 

	$GLOBALS['max_company_count'] = 1; $GLOBALS['max_godown_count'] = 1; $GLOBALS['default_date'] = "1970-01-01";
	
	$GLOBALS['Reset_to_one'] = "Reset To 1"; $GLOBALS['continue_last_number'] = "Continue from last number"; $GLOBALS['custom_number'] = "Custom Number";
	
	$GLOBALS['admin_user_type'] = "Super Admin"; $GLOBALS['staff_user_type'] = "Staff";
	// $GLOBALS['branch_staff_user_type'] = "Branch Staff"; $GLOBALS['godown_staff_user_type'] = "Godown Staff";

	$GLOBALS['admin_folder_name'] = "admin_mohan_17052024";

	$GLOBALS['max_user_count'] = 10;
	$GLOBALS['max_role_count'] = 10;
	
	// Tables
	$GLOBALS['table_prefix'] = "test_mohan_";
	$GLOBALS['organization_table'] = $GLOBALS['table_prefix'].'organization';
	$GLOBALS['role_table'] = $GLOBALS['table_prefix'].'role'; 
	$GLOBALS['user_table'] = $GLOBALS['table_prefix'].'user'; 
	$GLOBALS['login_table'] = $GLOBALS['table_prefix'].'login'; 
	$GLOBALS['branch_table'] = $GLOBALS['table_prefix'].'branch';
	$GLOBALS['vehicle_table'] = $GLOBALS['table_prefix'].'vehicle';
	$GLOBALS['driver_table'] = $GLOBALS['table_prefix'].'driver';
	$GLOBALS['unit_table'] = $GLOBALS['table_prefix'].'unit'; 
	$GLOBALS['product_table'] = $GLOBALS['table_prefix'].'product'; 
	$GLOBALS['payment_mode_table'] = $GLOBALS['table_prefix'].'payment_mode'; 
	$GLOBALS['bank_table'] = $GLOBALS['table_prefix'].'bank'; 
	$GLOBALS['charges_table'] = $GLOBALS['table_prefix'].'charges'; 
	$GLOBALS['party_table'] = $GLOBALS['table_prefix'].'party'; 
	$GLOBALS['consignor_table'] = $GLOBALS['table_prefix'].'consignor';
	$GLOBALS['consignee_table'] = $GLOBALS['table_prefix'].'consignee'; 
	$GLOBALS['account_party_table'] = $GLOBALS['table_prefix'].'account_party'; 
	$GLOBALS['purchase_entry_table'] = $GLOBALS['table_prefix'].'purchase_entry';
	$GLOBALS['lr_table'] = $GLOBALS['table_prefix'].'lr'; 
	$GLOBALS['sms_count_table'] = $GLOBALS['table_prefix']."sms_count";
	$GLOBALS['tripsheet_table'] = $GLOBALS['table_prefix'].'tripsheet';
	$GLOBALS['payment_table'] = $GLOBALS['table_prefix'].'payment'; 
	$GLOBALS['invest_table'] = $GLOBALS['table_prefix'].'invest'; 
	$GLOBALS['return_table'] = $GLOBALS['table_prefix'].'return'; 
	$GLOBALS['voucher_table'] = $GLOBALS['table_prefix'].'voucher'; 
	$GLOBALS['receipt_table'] = $GLOBALS['table_prefix'].'receipt'; 
	$GLOBALS['expense_category_table'] = $GLOBALS['table_prefix'].'expense_category';
	$GLOBALS['expense_table'] = $GLOBALS['table_prefix'].'expense';
	$GLOBALS['sms_count_table'] = $GLOBALS['table_prefix'].'sms_count';
	$GLOBALS['suspense_party_table'] = $GLOBALS['table_prefix'].'suspense_party';
	$GLOBALS['suspense_voucher_table'] = $GLOBALS['table_prefix'].'suspense_voucher';
	$GLOBALS['suspense_receipt_table'] = $GLOBALS['table_prefix'].'suspense_receipt';
	$GLOBALS['unit_price_table'] = $GLOBALS['table_prefix']."unit_price";
	$GLOBALS['tripsheet_profit_loss_table'] = $GLOBALS['table_prefix']."tripsheet_profit_loss";

	// $GLOBALS['godown_table'] = $GLOBALS['table_prefix']."godown"; 
	// $GLOBALS['godown_staff_table'] = $GLOBALS['table_prefix'].'godown_staff'; 
	// $GLOBALS['luggagesheet_table'] = $GLOBALS['table_prefix'].'luggagesheet'; 

	//Modules
	$GLOBALS['branch_module'] = 'Branch'; 
	$GLOBALS['vehicle_module'] = 'Vehicle';
	$GLOBALS['driver_module'] = 'Driver';
	$GLOBALS['unit_module'] = 'Unit';
	$GLOBALS['product_module'] = 'Product';
	$GLOBALS['payment_mode_module'] = 'Payment Mode';
	$GLOBALS['bank_module'] = 'Bank';
	$GLOBALS['charges_module'] = 'Charges';
	$GLOBALS['party_module'] = 'Party';
	$GLOBALS['consignor_module'] = 'Consignor';
	$GLOBALS['consignee_module'] = 'Consignee';
	$GLOBALS['account_party_module'] = 'Account Party';
	$GLOBALS['purchase_entry_module'] = 'Purchase Entry';
	$GLOBALS['lr_module'] = 'LR';
	$GLOBALS['tripsheet_module'] = "Tripsheet";
	$GLOBALS['tripsheet_profit_loss_module'] = "Tripsheet Profit Loss";
	$GLOBALS['invoice_acknowledgement_module'] = 'Invoice Acknowledgement';
	$GLOBALS['unclearance_entry_module'] = "Unclearance Entry";
	$GLOBALS['invest_module'] = "Invest"; 
	$GLOBALS['return_module'] = "Return"; 
	$GLOBALS['voucher_module'] = 'Voucher';
	$GLOBALS['receipt_module'] = 'Receipt';
	$GLOBALS['expense_category_module'] = 'Expense Category';
	$GLOBALS['expense_module'] = 'Expense';
	$GLOBALS['suspense_party_module'] = 'Suspense Party'; 
	$GLOBALS['suspense_voucher_module'] = 'Suspense Voucher'; 
	$GLOBALS['suspense_receipt_module'] = 'Suspense Receipt'; 
	$GLOBALS['reports_module'] = 'Reports'; 

	// $GLOBALS['godown_module'] = 'godown'; 
	// $GLOBALS['godown_staff_module'] = 'godown_staff';   
	// $GLOBALS['luggagesheet_module'] = "luggagesheet"; 
	
	//Access Modules
	$user_access_list = array();
	$user_access_list[] = $GLOBALS['branch_module'];
	$user_access_list[] = $GLOBALS['vehicle_module'];
	$user_access_list[] = $GLOBALS['driver_module'];
	$user_access_list[] = $GLOBALS['unit_module'];
	$user_access_list[] = $GLOBALS['product_module'];
	$user_access_list[] = $GLOBALS['payment_mode_module'];
	$user_access_list[] = $GLOBALS['bank_module'];
	$user_access_list[] = $GLOBALS['charges_module'];
	$user_access_list[] = $GLOBALS['party_module'];
	$user_access_list[] = $GLOBALS['consignor_module'];
	$user_access_list[] = $GLOBALS['consignee_module'];
	$user_access_list[] = $GLOBALS['account_party_module'];
	$user_access_list[] = $GLOBALS['purchase_entry_module'];
	$user_access_list[] = $GLOBALS['lr_module'];
	$user_access_list[] = $GLOBALS['tripsheet_module'];
	$user_access_list[] = $GLOBALS['tripsheet_profit_loss_module'];
	$user_access_list[] = $GLOBALS['invoice_acknowledgement_module'];
	$user_access_list[] = $GLOBALS['unclearance_entry_module'];
	$user_access_list[] = $GLOBALS['invest_module'];
	$user_access_list[] = $GLOBALS['return_module'];
	$user_access_list[] = $GLOBALS['voucher_module'];
	$user_access_list[] = $GLOBALS['receipt_module'];
	$user_access_list[] = $GLOBALS['expense_category_module'];
	$user_access_list[] = $GLOBALS['expense_module'];
	$user_access_list[] = $GLOBALS['suspense_party_module'];
	$user_access_list[] = $GLOBALS['suspense_voucher_module'];
	$user_access_list[] = $GLOBALS['suspense_receipt_module'];
	$user_access_list[] = $GLOBALS['reports_module'];

	$GLOBALS['access_pages_list'] = $user_access_list;

	//Branch Access Modules
	$branch_user_access_list = array();
	$branch_user_access_list[] = $GLOBALS['branch_module'];
	$branch_user_access_list[] = $GLOBALS['vehicle_module'];
	$branch_user_access_list[] = $GLOBALS['driver_module'];
	$branch_user_access_list[] = $GLOBALS['unit_module'];
	$branch_user_access_list[] = $GLOBALS['payment_mode_module'];
	$branch_user_access_list[] = $GLOBALS['bank_module'];
	$branch_user_access_list[] = $GLOBALS['consignor_module'];
	$branch_user_access_list[] = $GLOBALS['consignee_module'];
	$branch_user_access_list[] = $GLOBALS['account_party_module'];
	$branch_user_access_list[] = $GLOBALS['lr_module'];
	$branch_user_access_list[] = $GLOBALS['tripsheet_module'];
	$branch_user_access_list[] = $GLOBALS['tripsheet_profit_loss_module'];
	$branch_user_access_list[] = $GLOBALS['invoice_acknowledgement_module'];
	$branch_user_access_list[] = $GLOBALS['unclearance_entry_module'];
	$branch_user_access_list[] = $GLOBALS['receipt_module'];
	$branch_user_access_list[] = $GLOBALS['reports_module'];

	$GLOBALS['branch_access_pages_list'] = $branch_user_access_list;

	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		$GLOBALS['creator'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
	}
	if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_username']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_username'])) {
		$GLOBALS['creator_name'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_username'];
	}
	if(!empty($_SESSION['bill_company_id']) && isset($_SESSION['bill_company_id'])) {
		$GLOBALS['bill_company_id'] = $_SESSION['bill_company_id'];
	}
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
		$GLOBALS['user_type'] = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'];
	}
?>