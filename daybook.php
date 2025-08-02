<?php 
	$page_title = "Daybook";
	include("include_user_check_and_files.php");

	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }

    $from_date = date("Y-m-d"); $to_date = date("Y-m-d"); $filter_purchase_party_id = ""; $filter_consignor_id = ""; $filter_consignee_id = ""; $filter_account_party_id = ""; $filter_bill_type = ""; $filter_payment_mode_id = ""; $filter_bank_id = ""; $filter_suspense_party_id = "";
    if(isset($_POST['filter_from_date'])) {
        $from_date = $_POST['filter_from_date'];
        $from_date = trim($from_date);
        $from_date = date('Y-m-d', strtotime($from_date));
    }
    if(isset($_POST['filter_to_date'])) {
        $to_date = $_POST['filter_to_date'];
        $to_date = trim($to_date);
        $to_date = date('Y-m-d', strtotime($to_date));
    }
    if(isset($_POST['filter_purchase_party_id'])) {
        $filter_purchase_party_id = $_POST['filter_purchase_party_id'];
        $filter_purchase_party_id = trim($filter_purchase_party_id);
    }
    if(isset($_POST['filter_consignor_id'])) {
        $filter_consignor_id = $_POST['filter_consignor_id'];
        $filter_consignor_id = trim($filter_consignor_id);
    }
    if(isset($_POST['filter_consignee_id'])) {
        $filter_consignee_id = $_POST['filter_consignee_id'];
        $filter_consignee_id = trim($filter_consignee_id);
    }
    if(isset($_POST['filter_account_party_id'])) {
        $filter_account_party_id = $_POST['filter_account_party_id'];
        $filter_account_party_id = trim($filter_account_party_id);
    }
    if(isset($_POST['filter_bill_type'])) {
        $filter_bill_type = $_POST['filter_bill_type'];
        $filter_bill_type = trim($filter_bill_type);
    }
    if(isset($_POST['filter_payment_mode_id'])) {
        $filter_payment_mode_id = $_POST['filter_payment_mode_id'];
        $filter_payment_mode_id = trim($filter_payment_mode_id);
    }
    if(isset($_POST['filter_bank_id'])) {
        $filter_bank_id = $_POST['filter_bank_id'];
        $filter_bank_id = trim($filter_bank_id);
    }
    if(isset($_POST['filter_suspense_party_id'])) {
        $filter_suspense_party_id = $_POST['filter_suspense_party_id'];
        $filter_suspense_party_id = trim($filter_suspense_party_id);
    }
    $purchase_party_list = array();
    $purchase_party_list = $obj->getTableRecords($GLOBALS['party_table'],'', '','');

    $consignor_list = array();
    $consignor_list = $obj->getTableRecords($GLOBALS['consignor_table'],'', '','');

    $consignee_list = array();
    $consignee_list = $obj->getTableRecords($GLOBALS['consignee_table'],'', '','');

    $account_party_list = array();
    $account_party_list = $obj->getTableRecords($GLOBALS['account_party_table'],'', '','');

    $payment_mode_list = array(); 
    $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], '', '', '');

    $bank_list = array();
    $bank_list = $obj->getTableRecords($GLOBALS['bank_table'], '', '', '');

    $branch_list = array();
    $branch_list = $obj->getTableRecords($GLOBALS['branch_table'], '', '', '');

    
    $suspense_party_list = array();
    $suspense_party_list = $obj->getTableRecords($GLOBALS['suspense_party_table'],'', '','');

    $total_records_list = array();
    $total_records_list = $obj->getDaybookReportList($from_date, $to_date, $filter_purchase_party_id, $filter_consignor_id, $filter_consignee_id, $filter_account_party_id, $filter_bill_type, $filter_payment_mode_id, $filter_bank_id, $filter_suspense_party_id);
   
    $company_list = array();
    $company_list = $obj->getTableRecords($GLOBALS['organization_table'],'', '', '');
    
    $company_name = ""; $address1 = ""; $address2 = ""; $city =""; $state = ""; $mobile_number = ""; $gst_number = "";

    if(!empty($company_list)){
        foreach($company_list as $data){
            if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']){
                $company_name = $data['name'];
            }
            if(!empty($data['address_line1']) && $data['address_line1'] != $GLOBALS['null_value']){
                $address1 = $data['address_line1'];
            }
            if(!empty($data['address_line2']) && $data['address_line2'] != $GLOBALS['null_value']){
                $address2 = $data['address_line2'];
            } 
            if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']){
                $city = $data['city'];
            }
            if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']){
                $state = $data['state'];
            }
            if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']){
                $mobile_number = $data['mobile_number'];
            }
            if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']){
                $gst_number = $data['gst_number'];
            }
        }
    }
    $date_display = "";
    if($from_date == $to_date){
        $date_display = '('.date('d-m-Y', strtotime($from_date)).')';
    }
    else{
        $date_display = '('.date('d-m-Y', strtotime($from_date)).' to '.date('d-m-Y', strtotime($to_date)).')';
    }

    $excel_name = "";
    $excel_name = "Daybook ( ".$date_display." )";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
</head>	
<body>
<?php include "header.php"; ?>
<!--Right Content-->
<div class="pcoded-content">
    <div class="page-header card">
        <div class="mt-1">
            <div class="row mx-0">
                <div class="col-12">
                    <form name="daybook_report_form" method="post">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-8">
                                        <h5 class="text-white">Daybook</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mx-0">
                                    <div class="col-lg-2 col-md-4 col-6 py-2">
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <input type="date" name="filter_from_date" class="form-control shadow-none" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" onchange="Javascript:getReport();">
                                                <label>From Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6 py-2">
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <input type="date" name="filter_to_date" class="form-control shadow-none" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" onchange="Javascript:getReport();">
                                                <label>To Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6 py-2">
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <select name="filter_purchase_party_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:GetParty(this.value, '', '', '');">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($purchase_party_list)) {
                                                            foreach($purchase_party_list as $data) {
                                                                if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['party_id']; ?>" <?php if(!empty($filter_purchase_party_id) && $filter_purchase_party_id == $data['party_id']) { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['name_mobile_city']) && $data['name_mobile_city'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['name_mobile_city']);
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Purchase Party</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6 py-2">
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <select name="filter_consignor_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:GetParty('', this.value, '', '');">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($consignor_list)) {
                                                            foreach($consignor_list as $data) {
                                                                if(!empty($data['consignor_id']) && $data['consignor_id'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['consignor_id']; ?>" <?php if(!empty($filter_consignor_id) && $filter_consignor_id == $data['consignor_id']) { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['name']);
                                                                                if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                                                                    echo " (".$obj->encode_decode('decrypt', $data['mobile_number']).")";
                                                                                }
                                                                                if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                                                                    echo " - ".$obj->encode_decode('decrypt', $data['city']);
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Consignor</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6 py-2">
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <select name="filter_consignee_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:GetParty('', '', this.value, '');">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($consignee_list)) {
                                                            foreach($consignee_list as $data) {
                                                                if(!empty($data['consignee_id']) && $data['consignee_id'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['consignee_id']; ?>" <?php if(!empty($filter_consignee_id) && $filter_consignee_id == $data['consignee_id']) { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['name']);
                                                                                if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                                                                    echo " (".$obj->encode_decode('decrypt', $data['mobile_number']).")";
                                                                                }
                                                                                if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                                                                    echo " - ".$obj->encode_decode('decrypt', $data['city']);
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Consignee</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6 py-2">
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <select name="filter_account_party_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:GetParty('', '', '', this.value);">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($account_party_list)) {
                                                            foreach($account_party_list as $data) {
                                                                if(!empty($data['account_party_id']) && $data['account_party_id'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['account_party_id']; ?>" <?php if(!empty($filter_account_party_id) && $filter_account_party_id == $data['account_party_id']) { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['name']);
                                                                                if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                                                                    echo " (".$obj->encode_decode('decrypt', $data['mobile_number']).")";
                                                                                }
                                                                                if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                                                                    echo " - ".$obj->encode_decode('decrypt', $data['city']);
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Account Party</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6 py-2">
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <select name="filter_suspense_party_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:GetParty('', '', '', this.value);">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($suspense_party_list)) {
                                                            foreach($suspense_party_list as $data) {
                                                                if(!empty($data['suspense_party_id']) && $data['suspense_party_id'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['suspense_party_id']; ?>" <?php if(!empty($filter_suspense_party_id) && $filter_suspense_party_id == $data['suspense_party_id']) { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['suspense_party_name']) && $data['suspense_party_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['suspense_party_name']);
                                                                                if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                                                                    echo " (".$obj->encode_decode('decrypt', $data['mobile_number']).")";
                                                                                }
                                                                                if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                                                                    echo " - ".$obj->encode_decode('decrypt', $data['city']);
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Suspense Party</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6 py-2">
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <select name="filter_bill_type" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                    <option value="">Select</option>
                                                    <option value="Purchase Entry" <?php if($filter_bill_type == 'Purchase Entry') { ?>selected<?php } ?>>Purchase Entry</option>
                                                    <option value="LR Entry" <?php if($filter_bill_type == 'LR Entry') { ?>selected<?php } ?>>LR Entry</option>
                                                    <option value="Voucher" <?php if($filter_bill_type == 'Voucher') { ?>selected<?php } ?>>Voucher</option>
                                                    <option value="Receipt" <?php if($filter_bill_type == 'Receipt') { ?>selected<?php } ?>>Receipt</option>
                                                    <option value="Expense" <?php if($filter_bill_type == 'Expense') { ?>selected<?php } ?>>Expense</option>
                                                    <option value="Suspense" <?php if($filter_bill_type == 'Suspense') { ?>selected<?php } ?>>Suspense</option>
                                                </select>
                                                <label>Bill Type</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6 py-2">
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <select name="filter_payment_mode_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($payment_mode_list)) {
                                                            foreach($payment_mode_list as $data) {
                                                                if(!empty($data['payment_mode_id']) && $data['payment_mode_id'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['payment_mode_id']; ?>" <?php if(!empty($filter_payment_mode_id) && $filter_payment_mode_id == $data['payment_mode_id']) { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['payment_mode_name']) && $data['payment_mode_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['payment_mode_name']);
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Payment Mode</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6 py-2">
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <select name="filter_bank_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:getReport();">
                                                    <option value="">Select</option>
                                                    <?php
                                                        if(!empty($bank_list)) {
                                                            foreach($bank_list as $data) {
                                                                if(!empty($data['bank_id']) && $data['bank_id'] != $GLOBALS['null_value']) {
                                                                    ?>
                                                                    <option value="<?php echo $data['bank_id']; ?>" <?php if(!empty($filter_bank_id) && $filter_bank_id == $data['bank_id']) { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['bank_name']) && $data['bank_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['bank_name']);
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <label>Bank</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(!empty($total_records_list)) { ?>
                                        <div class="col-lg-2 col-md-4 col-12 ms-auto py-2 text-end">
                                            <button class="btn btn-success rounded-circle p-2 mx-1" style="font-size:14px; width:38px; height: 38px;" title="Excel Download" type="button" onclick="Javascript:ExportToExcel();"><i class="fa fa-cloud-download"></i></button>
                                            <a class="btn btn-primary rounded-circle p-2 mx-1" style="font-size:14px; width:38px; height: 38px;" href="reports/rpt_daybook_report.php?filter_bill_type=<?php if(!empty($filter_bill_type)) { echo $filter_bill_type; } ?>&filter_payment_mode_id=<?php if(!empty($filter_payment_mode_id)) { echo $filter_payment_mode_id; } ?>&filter_bank_id=<?php if(!empty($filter_bank_id)) { echo $filter_bank_id; } ?>&filter_account_party_id=<?php if(!empty($filter_account_party_id)) { echo $filter_account_party_id; } ?>&from_date=<?php if(!empty($from_date)) { echo $from_date; } ?>&to_date=<?php if(!empty($to_date)) { echo $to_date; } ?>&filter_consignor_id=<?php if(!empty($filter_consignor_id)) { echo $filter_consignor_id; } ?>&filter_consignee_id=<?php if(!empty($filter_consignee_id)) { echo $filter_consignee_id; } ?>&filter_purchase_party_id=<?php if(!empty($filter_purchase_party_id)) { echo $filter_purchase_party_id; } ?>" target="_blank" > <i class="fa fa-print"></i></a>
                                            <a class="btn btn-info rounded-circle p-2 mx-1" style="font-size:14px; width:38px; height: 38px;" href="reports/rpt_daybook_report.php?filter_bill_type=<?php if(!empty($filter_bill_type)) { echo $filter_bill_type; } ?>&filter_payment_mode_id=<?php if(!empty($filter_payment_mode_id)) { echo $filter_payment_mode_id; } ?>&filter_bank_id=<?php if(!empty($filter_bank_id)) { echo $filter_bank_id; } ?>&filter_account_party_id=<?php if(!empty($filter_account_party_id)) { echo $filter_account_party_id; } ?>&from_date=<?php if(!empty($from_date)) { echo $from_date; } ?>&to_date=<?php if(!empty($to_date)) { echo $to_date; } ?>&filter_consignor_id=<?php if(!empty($filter_consignor_id)) { echo $filter_consignor_id; } ?>&filter_consignee_id=<?php if(!empty($filter_consignee_id)) { echo $filter_consignee_id; } ?>&filter_purchase_party_id=<?php if(!empty($filter_purchase_party_id)) { echo $filter_purchase_party_id; } ?>&from=D" target="_blank" > <i class="fa fa-download"></i></a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php if(empty($is_branch_staff)){
                                    ?>
                                    <div class="row mx-0 pb-2">
                                        <div class="col-12 py-2 border" style="background-color:antiquewhite;">
                                            <h5 class="text-center">Company Balance</h5>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 pl-0 pr-2">
                                            <div class="table-responsive">
                                                <table class="table table-bordered nowrap cursor text-center smallfnt">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th colspan="3">Estimate Balance</th>
                                                        </tr>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Payment Mode</th>
                                                            <th>Available Balance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $total_balance_amount = 0; $sno = 1;
                                                            if(!empty($payment_mode_list)) {
                                                                foreach($payment_mode_list as $data) {
                                                                    $credit_amount = 0; $debit_amount = 0; $balance_amount = 0;
                                                                    $balance_list = array(); 
                                                                    $balance_list = $obj->CompanyBalanceList('2', $data['payment_mode_id']);
                                                                    if(!empty($balance_list)) {
                                                                        foreach($balance_list as $row) {
                                                                            if(!empty($row['credit']) && $row['credit'] != $GLOBALS['null_value']) {
                                                                                $credit_amount = $row['credit'];
                                                                            }
                                                                            if(!empty($row['debit']) && $row['debit'] != $GLOBALS['null_value']) {
                                                                                $debit_amount = $row['debit'];
                                                                            }
                                                                        }
                                                                    }
                                                                    
                                                                    if($credit_amount > $debit_amount) {
                                                                        $balance_amount = $credit_amount - $debit_amount;
                                                                    }
                                                                    else {
                                                                        $balance_amount = $debit_amount - $credit_amount;
                                                                    }
                                                                    $total_balance_amount += $balance_amount;
                                                                    ?>
                                                                    <tr>
                                                                        <th>
                                                                            <?php echo $sno++; ?>
                                                                        </th>
                                                                        <th>
                                                                            <?php
                                                                                if(!empty($data['payment_mode_name']) && $data['payment_mode_name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['payment_mode_name']);
                                                                                }
                                                                            ?>
                                                                        </th>
                                                                        <th class="text-right">
                                                                            <?php echo $obj->numberFormat($balance_amount, 2); ?>
                                                                        </th>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <th colspan="2">Total</th>
                                                                    <th class="text-right">
                                                                        <?php
                                                                            echo $obj->numberFormat($total_balance_amount, 2);
                                                                        ?>
                                                                    </th>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 pl-2 pr-0">
                                            <div class="table-responsive">
                                                <table class="table table-bordered nowrap cursor text-center smallfnt">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th colspan="3">Invoice Balance</th>
                                                        </tr>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Payment Mode</th>
                                                            <th>Available Balance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $total_balance_amount = 0; $sno = 1;
                                                            if(!empty($payment_mode_list)) {
                                                                foreach($payment_mode_list as $data) {
                                                                    $credit_amount = 0; $debit_amount = 0; $balance_amount = 0;
                                                                    $balance_list = array(); 
                                                                    $balance_list = $obj->CompanyBalanceList('1', $data['payment_mode_id']);
                                                                    if(!empty($balance_list)) {
                                                                        foreach($balance_list as $row) {
                                                                            if(!empty($row['credit']) && $row['credit'] != $GLOBALS['null_value']) {
                                                                                $credit_amount = $row['credit'];
                                                                            }
                                                                            if(!empty($row['debit']) && $row['debit'] != $GLOBALS['null_value']) {
                                                                                $debit_amount = $row['debit'];
                                                                            }
                                                                        }
                                                                    }
                                                                    
                                                                    if($credit_amount > $debit_amount) {
                                                                        $balance_amount = $credit_amount - $debit_amount;
                                                                    }
                                                                    else {
                                                                        $balance_amount = $debit_amount - $credit_amount;
                                                                    }
                                                                    $total_balance_amount += $balance_amount;
                                                                    ?>
                                                                    <tr>
                                                                        <th>
                                                                            <?php echo $sno++; ?>
                                                                        </th>
                                                                        <th>
                                                                            <?php
                                                                                if(!empty($data['payment_mode_name']) && $data['payment_mode_name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['payment_mode_name']);
                                                                                }
                                                                            ?>
                                                                        </th>
                                                                        <th class="text-right">
                                                                            <?php echo $obj->numberFormat($balance_amount, 2); ?>
                                                                        </th>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <th colspan="2">Total</th>
                                                                    <th class="text-right">
                                                                        <?php
                                                                            echo $obj->numberFormat($total_balance_amount, 2);
                                                                        ?>
                                                                    </th>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } ?>
                                
                                <div class="row mx-0 pb-2">
                                    <div class="col-12 py-2 border" style="background-color:#e5fad7;">
                                        <h5 class="text-center">Branch Balance</h5>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 pl-0 pr-2">
                                        <div class="table-responsive">
                                            <table class="table table-bordered nowrap cursor text-center smallfnt">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th colspan="3">Estimate Balance</th>
                                                    </tr>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Branch Name</th>
                                                        <th>Available Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_balance_amount = 0; $sno = 1;
                                                        if(!empty($branch_list)) {
                                                            foreach($branch_list as $data) {
                                                                if(in_array($data['branch_id'], $login_branch_id) || $GLOBALS['user_type'] == "Super Admin"){
                                                                    $credit_amount = 0; $debit_amount = 0; $balance_amount = 0;
                                                                    $balance_list = array(); 
                                                                    $balance_list = $obj->BranchBalanceList('2', $data['branch_id']);
                                                                    if(!empty($balance_list)) {
                                                                        foreach($balance_list as $row) {
                                                                            if(!empty($row['credit']) && $row['credit'] != $GLOBALS['null_value']) {
                                                                                $credit_amount = $row['credit'];
                                                                            }
                                                                            if(!empty($row['debit']) && $row['debit'] != $GLOBALS['null_value']) {
                                                                                $debit_amount = $row['debit'];
                                                                            }
                                                                        }
                                                                    }
                                                                    
                                                                    if($credit_amount > $debit_amount) {
                                                                        $balance_amount = $credit_amount - $debit_amount;
                                                                    }
                                                                    else {
                                                                        $balance_amount = $debit_amount - $credit_amount;
                                                                    }
                                                                    $total_balance_amount += $balance_amount;
                                                                    ?>
                                                                    <tr>
                                                                        <th>
                                                                            <?php echo $sno++; ?>
                                                                        </th>
                                                                        <th>
                                                                            <?php
                                                                                if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['name']);
                                                                                }
                                                                            ?>
                                                                        </th>
                                                                        <th class="text-right">
                                                                            <?php echo $obj->numberFormat($balance_amount, 2); ?>
                                                                        </th>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                
                                                            }
                                                            ?>
                                                            <tr>
                                                                <th colspan="2">Total</th>
                                                                <th class="text-right">
                                                                    <?php
                                                                        echo $obj->numberFormat($total_balance_amount, 2);
                                                                    ?>
                                                                </th>
                                                            </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 pl-2 pr-0">
                                        <div class="table-responsive">
                                            <table class="table table-bordered nowrap cursor text-center smallfnt">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th colspan="3">Invoice Balance</th>
                                                    </tr>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Branch Name</th>
                                                        <th>Available Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $total_balance_amount = 0; $sno = 1;
                                                        if(!empty($branch_list)) {
                                                            foreach($branch_list as $data) {
                                                                if(in_array($data['branch_id'], $login_branch_id) || $GLOBALS['user_type'] == "Super Admin"){
                                                                    $credit_amount = 0; $debit_amount = 0; $balance_amount = 0;
                                                                    $balance_list = array(); 
                                                                    $balance_list = $obj->BranchBalanceList('1', $data['branch_id']);
                                                                    if(!empty($balance_list)) {
                                                                        foreach($balance_list as $row) {
                                                                            if(!empty($row['credit']) && $row['credit'] != $GLOBALS['null_value']) {
                                                                                $credit_amount = $row['credit'];
                                                                            }
                                                                            if(!empty($row['debit']) && $row['debit'] != $GLOBALS['null_value']) {
                                                                                $debit_amount = $row['debit'];
                                                                            }
                                                                        }
                                                                    }
                                                                    
                                                                    if($credit_amount > $debit_amount) {
                                                                        $balance_amount = $credit_amount - $debit_amount;
                                                                    }
                                                                    else {
                                                                        $balance_amount = $debit_amount - $credit_amount;
                                                                    }
                                                                    $total_balance_amount += $balance_amount;
                                                                    ?>
                                                                    <tr>
                                                                        <th>
                                                                            <?php echo $sno++; ?>
                                                                        </th>
                                                                        <th>
                                                                            <?php
                                                                                if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $data['name']);
                                                                                }
                                                                            ?>
                                                                        </th>
                                                                        <th class="text-right">
                                                                            <?php echo $obj->numberFormat($balance_amount, 2); ?>
                                                                        </th>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                                ?>
                                                            <tr>
                                                                <th colspan="2">Total</th>
                                                                <th class="text-right">
                                                                    <?php
                                                                        echo $obj->numberFormat($total_balance_amount, 2);
                                                                    ?>
                                                                </th>
                                                            </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-0 justify-content-center">    
                                    <div class="col-lg-12 px-0">
                                        <div class="table-responsive table-bordered">
                                            <table class="table table-nowrap table-bordered nowrap text-center" id="tbl_daybook_report_list">
                                                <thead class="smallfnt">
                                                    <tr>
                                                        <th colspan="9" class="text-center" style="border: 1px solid #dee2e6;font-weight: bold; font-size: 18px;">
                                                            Daybook <?php if(!empty($date_display)){ echo $date_display; }?>
                                                        </th>
                                                    </tr>
                                                    <div>
                                                        <tr class="d-none header">
                                                            <th colspan="2"></th>
                                                            <th colspan="6"><?php echo $obj->encode_decode('decrypt',$company_name); ?></th>
                                                        </tr>
                                                        <tr class="d-none header">
                                                            <th colspan="2"></th>
                                                            <th colspan="6"><?php echo $obj->encode_decode('decrypt',$address1); ?></th>
                                                        </tr>
                                                        <tr class="d-none header">
                                                            <th colspan="2"></th>
                                                            <th colspan="6"><?php echo $obj->encode_decode('decrypt',$city); ?></th>
                                                        </tr>
                                                        <tr class="d-none header">
                                                            <th colspan="2"></th>
                                                            <th colspan="6"><?php echo $obj->encode_decode('decrypt',$state); ?></th>
                                                        </tr>
                                                        <tr class="d-none header">
                                                            <th colspan="2"></th>
                                                            <th colspan="6"><?php echo "Mobile No : ". $obj->encode_decode('decrypt',$mobile_number); ?></th>
                                                        </tr>
                                                        <?php if(!empty($gst_number)) { ?>
                                                            <tr class="d-none header">
                                                                <th colspan="2"></th>
                                                                <th colspan="6"><?php echo "GST No : ".$obj->encode_decode('decrypt',$gst_number); ?></th>
                                                            </tr>
                                                        <?php } ?>
                                                    </div>
                                                    <tr class="bg-primary">
                                                        <th>S.No</th>
                                                        <th>Date</th>
                                                        <th>Bill No</th>
                                                        <th>Payment Type</th>
                                                        <th>Party Type</th>
                                                        <th>Particular</th>
                                                        <th>Payment Mode</th>
                                                        <th>Credit (Rs.)</th>
                                                        <th>Debit (Rs.)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $index = 1; $total_credit = 0; $total_debit = 0; $str_bill_no = "";
                                                        if(!empty($total_records_list)) {
                                                            $grouped = [];

                                                            foreach ($total_records_list as $data) {
                                                                $bill_number = ""; $payment_mode = ""; $bank_mode = "";
                                                                if(!empty($data['bill_number']) && $data['bill_number'] != $GLOBALS['null_value']) {
                                                                    $bill_number = $data['bill_number'];
                                                                }
                                                                if ($bill_number == '') continue; 

                                                                if(!empty($data['payment_mode_id']) && $data['payment_mode_id'] != $GLOBALS['null_value']) {
                                                                    $payment_mode = $data['payment_mode_id'];
                                                                }
                                                                if(!empty($data['bank_id']) && $data['bank_id'] != $GLOBALS['null_value']) {
                                                                    $bank_mode = $data['bank_id'];
                                                                }

                                                                if (!isset($grouped[$bill_number])) {
                                                                    $grouped[$bill_number] = [
                                                                        'bill_date' => $data['bill_date'],
                                                                        'bill_type' => $data['bill_type'],
                                                                        'bill_id' => $data['bill_id'],
                                                                        'party_type' => $data['party_type'],
                                                                        'party_id' => $data['party_id'],
                                                                        'payment_modes' => [],
                                                                        'bank_modes' => [],
                                                                        'credit' => 0,
                                                                        'debit' => 0
                                                                    ];
                                                                }

                                                                if (!in_array($payment_mode, $grouped[$bill_number]['payment_modes'])) {
                                                                    if((empty($filter_payment_mode_id) || (!empty($filter_payment_mode_id) && $filter_payment_mode_id == $payment_mode)) && (empty($filter_bank_id) || (!empty($filter_bank_id) && $filter_bank_id == $bank_mode))) {
                                                                        $grouped[$bill_number]['payment_modes'][] = $payment_mode;
                                                                        $grouped[$bill_number]['bank_modes'][] = $bank_mode;
                                                                        if(!empty($data['credit'])) {
                                                                            $grouped[$bill_number]['credit'] += $data['credit'];
                                                                        }
                                                                        if(!empty($data['debit'])) {
                                                                            $grouped[$bill_number]['debit'] += $data['debit'];
                                                                        }
                                                                    }
                                                                }
                                                            }

                                                            $index = 1;
                                                            foreach ($grouped as $bill_number => $info) {
                                                                ?>
                                                                <tr>
                                                                    <td class="text-center px-2 py-2"><?php echo $index++; ?></td>
                                                                    <td class="text-center px-2 py-2">
                                                                        <?php 
                                                                            if(!empty($info['bill_date']) && $info['bill_date'] != '0000-00-00') {
                                                                                echo date('d-m-Y', strtotime($info['bill_date']));
                                                                            } 
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center px-2 py-2"><?php echo $bill_number; ?></td>
                                                                    <td>
                                                                        <?php 
                                                                            if(!empty($info['bill_type']) && $info['bill_type'] != $GLOBALS['null_value']) {
                                                                                echo $info['bill_type'];
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php 
                                                                            if(!empty($info['party_type']) && $info['party_type'] != $GLOBALS['null_value']) {
                                                                                echo $info['party_type'];
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            if($info['bill_type'] == "Expense") {
                                                                                $expense_name = "";
                                                                                $expense_name = $obj->getTableColumnValue($GLOBALS['expense_table'], 'expense_id', $info['bill_id'], 'expense_category_name');
                                                                                if(!empty($expense_name) && $expense_name != $GLOBALS['null_value']) {
                                                                                    echo $obj->encode_decode('decrypt', $expense_name);
                                                                                }
                                                                            }
                                                                            else {
                                                                                $party_name = "";
                                                                                if (!empty($info['party_type']) && !empty($info['party_id'])) {
                                                                                    if ($info['party_type'] == 'Purchase Party') {
                                                                                        $party_name = $obj->getTableColumnValue($GLOBALS['party_table'], 'party_id', $info['party_id'], 'name_mobile_city');
                                                                                    } 
                                                                                    elseif ($info['party_type'] == 'Consignor') {
                                                                                        $party_name = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $info['party_id'], 'name');
                                                                                    } 
                                                                                    elseif ($info['party_type'] == 'Consignee') {
                                                                                        $party_name = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $info['party_id'], 'name');
                                                                                    } 
                                                                                    elseif ($info['party_type'] == 'Account Party') {
                                                                                        $party_name = $obj->getTableColumnValue($GLOBALS['account_party_table'], 'account_party_id', $info['party_id'], 'name');
                                                                                    }
                                                                                    elseif ($info['party_type'] == 'Suspense Party') {
                                                                                        $party_name = $obj->getTableColumnValue($GLOBALS['suspense_party_table'], 'suspense_party_id', $info['party_id'], 'suspense_party_name');
                                                                                    }
                                                                                    if(!empty($party_name) && $party_name != $GLOBALS['null_value']) {
                                                                                        echo $obj->encode_decode('decrypt', $party_name);
                                                                                    }
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            $payment_mode_ids = array();
                                                                            $payment_mode_ids = $info['payment_modes'];
                                                                            $bank_ids = array();
                                                                            $bank_ids = $info['bank_modes'];
                                                                            if(!empty($payment_mode_ids)) {
                                                                                for($i=0; $i < count($payment_mode_ids); $i++) {
                                                                                    $payment_mode_name = "";
                                                                                    $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_ids[$i], 'payment_mode_name');
                                                                                    $bank_name = "";
                                                                                    $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_ids[$i], 'bank_name');
                                                                                    if(!empty($payment_mode_name) && $payment_mode_name != $GLOBALS['null_value']) {
                                                                                        echo $obj->encode_decode('decrypt', $payment_mode_name);
                                                                                    }
                                                                                    if(!empty($bank_name) && $bank_name != $GLOBALS['null_value']) {
                                                                                        echo  ' - '.$obj->encode_decode('decrypt', $bank_name);
                                                                                    }
                                                                                    if($i != (count($payment_mode_ids) - 1)) {
                                                                                        echo "<br>";
                                                                                    }
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-end text-success fw-bold px-2 py-2">
                                                                        <?php
                                                                            echo $obj->numberFormat($info['credit'], 2);
                                                                            $total_credit += $info['credit'];
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-end text-danger fw-bold px-2 py-2">
                                                                        <?php
                                                                            echo $obj->numberFormat($info['debit'], 2);
                                                                            $total_debit += $info['debit'];
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                            <tr>
                                                                <th class="text-end" colspan="7">Total</th>
                                                                <th class="text-end text-success mr-5" style="margin: 30px 40px;"><?php echo $obj->numberFormat($total_credit,2); ?></th>
                                                                <th class="text-end text-danger mr-5" style="margin: 30px 40px;"><?php echo $obj->numberFormat($total_debit,2); ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-end" colspan="7">Current Balance</th>
                                                                <th class="text-end text-success mr-5" style="margin: 30px 40px;">
                                                                    <?php 
                                                                        if($total_credit > $total_debit) {
                                                                            $total = $total_credit - $total_debit;
                                                                            echo $obj->numberFormat($total,2); 
                                                                        }
                                                                    ?>
                                                                </th>
                                                                <th class="text-end text-danger mr-5" style="margin: 30px 40px;">
                                                                    <?php 
                                                                        if($total_debit > $total_credit) {
                                                                            $total = $total_debit - $total_credit;
                                                                            echo $obj->numberFormat($total,2); 
                                                                        }
                                                                    ?>
                                                                </th>
                                                            </tr>
                                                            <?php 
                                                        }
                                                        else {
                                                            ?>
                                                            <tr>
                                                                <td colspan="9" class="text-center">Sorry! No records found</td>
                                                            </tr>								
                                                            <?php 
                                                        } 
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </form> 
                </div>
            </div>  
        </div>
    </div>          
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#daybook").addClass("active");
    });
</script>
<script type="text/javascript">
    function getReport() {
        if(jQuery('form[name="daybook_report_form"]').length > 0) {
            jQuery('form[name="daybook_report_form"]').submit();
        }
    }
    function GetParty(purchase_party_id, consignor_id, consignee_id, account_party_id) {
        if(purchase_party_id != "") {
            if(jQuery('select[name="filter_consignor_id"]').length > 0) {
                jQuery('select[name="filter_consignor_id"]').val('').trigger('change');
            }
            if(jQuery('select[name="filter_consignee_id"]').length > 0) {
                jQuery('select[name="filter_consignee_id"]').val('').trigger('change');
            }
            if(jQuery('select[name="filter_account_party_id"]').length > 0) {
                jQuery('select[name="filter_account_party_id"]').val('').trigger('change');
            }
        }
        if(consignor_id != "") {
            if(jQuery('select[name="filter_purchase_party_id"]').length > 0) {
                jQuery('select[name="filter_purchase_party_id"]').val('').trigger('change');
            }
            if(jQuery('select[name="filter_consignee_id"]').length > 0) {
                jQuery('select[name="filter_consignee_id"]').val('').trigger('change');
            }
            if(jQuery('select[name="filter_account_party_id"]').length > 0) {
                jQuery('select[name="filter_account_party_id"]').val('').trigger('change');
            }
        }
        if(consignee_id != "") {
            if(jQuery('select[name="filter_purchase_party_id"]').length > 0) {
                jQuery('select[name="filter_purchase_party_id"]').val('').trigger('change');
            }
            if(jQuery('select[name="filter_consignor_id"]').length > 0) {
                jQuery('select[name="filter_consignor_id"]').val('').trigger('change');
            }
            if(jQuery('select[name="filter_account_party_id"]').length > 0) {
                jQuery('select[name="filter_account_party_id"]').val('').trigger('change');
            }
        }
        if(account_party_id != "") {
            if(jQuery('select[name="filter_purchase_party_id"]').length > 0) {
                jQuery('select[name="filter_purchase_party_id"]').val('').trigger('change');
            }
            if(jQuery('select[name="filter_consignor_id"]').length > 0) {
                jQuery('select[name="filter_consignor_id"]').val('').trigger('change');
            }
            if(jQuery('select[name="filter_consignee_id"]').length > 0) {
                jQuery('select[name="filter_consignee_id"]').val('').trigger('change');
            }
        }
        getReport();
    }
</script>
<script>
    function ExportToExcel(type, fn, dl) {
        jQuery('.header').removeClass('d-none');
        
        var elt = document.getElementById('tbl_daybook_report_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });

        if (dl) {
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' });
        } else {
            XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        }
        jQuery('.header').addClass('d-none');
    }
</script>