<?php 
	$page_title = "Suspense Party Balance Report";
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

    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date("Y-m-d"); $filter_suspense_party_id = ""; $filter_consignor_id = ""; $filter_consignee_id = ""; $filter_account_party_id = ""; $current_date = date("Y-m-d");
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
    if(isset($_POST['filter_suspense_party_id'])) {
        $filter_suspense_party_id = $_POST['filter_suspense_party_id'];
        $filter_suspense_party_id = trim($filter_suspense_party_id);
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

    $suspense_party_list = array();
    $suspense_party_list = $obj->getTableRecords($GLOBALS['suspense_party_table'],'', '','');


    $payment_mode_list = array(); 
    $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], '', '', '');

    $bank_list = array();
    $bank_list = $obj->getTableRecords($GLOBALS['bank_table'], '', '', '');

    $total_records_list = array();
    if(!empty($filter_suspense_party_id)) {
        $total_records_list = $obj->GetSuspensePendingBalanceList($from_date, $to_date, $filter_suspense_party_id);
    }
    else {
        $total_records_list = $obj->GetSuspensePendingBalanceList('', '', '');
    }
   
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

    $excel_name = "";
    $excel_name = "Suspense Party Balance Report( ".date('d-m-Y',strtotime($from_date))." to ".date('d-m-Y',strtotime($to_date))." )";
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
                    <form name="pending_balance_report_form" method="post">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-8">
                                        <h5 class="text-white">Suspense Party Balance Report</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mx-0">
                                    <?php if(!empty($filter_suspense_party_id)) { ?>
                                        <div class="col-lg-2 col-md-4 col-6 py-2">
                                            <div class="form-group">
                                                <div class="form-label-group in-border">
                                                    <input type="date" name="filter_from_date" class="form-control shadow-none" value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>" onchange="Javascript:getReport();">
                                                    <label>From Date</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-4 col-6 py-2">
                                            <div class="form-group">
                                                <div class="form-label-group in-border">
                                                    <input type="date" name="filter_to_date" class="form-control shadow-none" value="<?php if(!empty($to_date)) { echo $to_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>" onchange="Javascript:getReport();">
                                                    <label>To Date</label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                               
                                        <div class="col-lg-2 col-md-4 col-6 py-2">
                                            <div class="form-group">
                                                <div class="form-label-group in-border">
                                                    <select name="filter_suspense_party_id" class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width:100%!important;" onchange="Javascript:GetParty(this.value);">
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
                                
                                    <?php if(!empty($total_records_list)) { ?>
                                        <div class="col-lg-2 col-md-4 col-12 ms-auto py-2 text-end">
                                            <button class="btn btn-success rounded-circle p-2 mx-1" style="font-size:14px; width:38px; height: 38px;" title="Excel Download" type="button" onclick="Javascript:ExportToExcel();"><i class="fa fa-cloud-download"></i></button>
                                             <button class="btn btn-primary rounded-circle p-2 mx-1" style="font-size:14px; width:38px; height: 38px;" title="Print PDF" type="button" onclick="window.open('reports/rpt_suspense_balance_report.php?filter_from_date=<?php if(!empty($from_date)) { echo $from_date; } ?>&filter_to_date=<?php if(!empty($to_date)) { echo $to_date; } ?>&filter_suspense_party_id=<?php if(!empty($filter_suspense_party_id)) { echo $filter_suspense_party_id; } ?>')"><i class="fa fa-print"></i></button>
                                            <button class="btn btn-info rounded-circle p-2 mx-1" style="font-size:14px; width:38px; height: 38px;" title="Download PDF" type="button" onclick="window.open('reports/rpt_suspense_balance_report.php?filter_from_date=<?php if(!empty($from_date)) { echo $from_date; } ?>&filter_to_date=<?php if(!empty($to_date)) { echo $to_date; } ?>&filter_suspense_party_id=<?php if(!empty($filter_suspense_party_id)) { echo $filter_suspense_party_id; } ?>&from=D')"><i class="fa fa-download"></i></button>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="row mx-0 justify-content-center">    
                                    <div class="col-lg-12 px-0">
                                        <div class="table-responsive table-bordered">
                                            <?php if(!empty($filter_suspense_party_id)) { ?>
                                                <table class="table table-nowrap table-bordered nowrap text-center" id="tbl_pending_balance_report_list">
                                                    <thead class="smallfnt">
                                                        <tr>
                                                            <th colspan="5" class="text-center" style="border: 1px solid #dee2e6;font-weight: bold; font-size: 18px;">
                                                                Suspense Party Balance Report <?php if(!empty($from_date)){ echo " ( " .date('d-m-Y',strtotime($from_date )) ." to ". date('d-m-Y',strtotime($to_date )). " )"; }?>
                                                            </th>
                                                        </tr>
                                                        <div>
                                                            <tr class="d-none header">
                                                                <th colspan="5"><?php echo $obj->encode_decode('decrypt',$company_name); ?></th>
                                                            </tr>
                                                            <tr class="d-none header">
                                                                <th colspan="5"><?php echo $obj->encode_decode('decrypt',$address1); ?></th>
                                                            </tr>
                                                            <tr class="d-none header">
                                                                <th colspan="5"><?php echo $obj->encode_decode('decrypt',$city); ?></th>
                                                            </tr>
                                                            <tr class="d-none header">
                                                                <th colspan="5"><?php echo $obj->encode_decode('decrypt',$state); ?></th>
                                                            </tr>
                                                            <tr class="d-none header">
                                                                <th colspan="5"><?php echo "Mobile No : ". $obj->encode_decode('decrypt',$mobile_number); ?></th>
                                                            </tr>
                                                            <?php if(!empty($gst_number)) { ?>
                                                                <tr class="d-none header">
                                                                    <th colspan="5"><?php echo "GST No : ".$obj->encode_decode('decrypt',$gst_number); ?></th>
                                                                </tr>
                                                            <?php } ?>
                                                        </div>
                                                        <?php
                                                            $party_name = "";
                                                            if(!empty($filter_suspense_party_id)) {
                                                                $party_name = $obj->getTableColumnValue($GLOBALS['suspense_party_table'], 'suspense_party_id', $filter_suspense_party_id, 'suspense_party_name');
                                                            }
                                                           
                                                            if(!empty($party_name) && $party_name != $GLOBALS['null_value']) {
                                                                ?>
                                                                <tr class="bg-info text-white">
                                                                    <th colspan="6" class="text-center">
                                                                        <?php echo 'Name : '.$obj->encode_decode('decrypt', $party_name); ?>
                                                                    </th>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                        <tr class="bg-secondary text-white">
                                                            <th>S.No</th>
                                                            <th>Date</th>
                                                            <th>Bill No</th>
                                                            <!-- <th>Bill Type</th> -->
                                                            <th>Credit (Rs.)</th>
                                                            <th>Debit (Rs.)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $index = 1; $total_credit = 0; $total_debit = 0;
                                                            $balance_credit = 0; $balance_debit = 0;
                                                            $opening_credit = 0; $opening_debit = 0;
                                                            $opening_balance_list = array();
                                                            $opening_balance_list = $obj->getSuspensePartyOpeningBalance($from_date, $to_date, $filter_suspense_party_id);
                                                            if(!empty($opening_balance_list)) {
                                                                foreach($opening_balance_list as $data) {
                                                                    if(!empty($data['opening_credit']) && $data['opening_credit'] != $GLOBALS['null_value']) {
                                                                        $balance_credit = $data['opening_credit'];
                                                                    }
                                                                    if(!empty($data['opening_debit']) && $data['opening_debit'] != $GLOBALS['null_value']) {
                                                                        $balance_debit = $data['opening_debit'];
                                                                    }
                                                                }
                                                                if(!empty($balance_credit) || !empty($balance_debit)) {
                                                                    if($balance_credit > $balance_debit) {
                                                                        $opening_credit = $balance_credit - $balance_debit;
                                                                    }
                                                                    else {
                                                                        $opening_debit = $balance_debit - $balance_credit;
                                                                    }
                                                                }
                                                            }
                                                            if(!empty($opening_credit) || !empty($opening_debit)) {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="3" class="text-end">Opening Balance</td>
                                                                    <td class="text-end text-success px-2 py-2">
                                                                        <?php 
                                                                            if(!empty($opening_credit)) { 
                                                                                echo $obj->numberFormat($opening_credit,2); 
                                                                                $total_credit += $opening_credit; 
                                                                            }
                                                                            else {
                                                                                echo '0.00';
                                                                            } 
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-end text-danger px-2 py-2">
                                                                        <?php 
                                                                            if(!empty($opening_debit)) { 
                                                                                echo $obj->numberFormat($opening_debit,2); 
                                                                                $total_debit += $opening_debit; 
                                                                            }
                                                                            else {
                                                                                echo '0.00';
                                                                            } 
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            if(!empty($total_records_list)) {
                                                                foreach($total_records_list as $data) { 
                                                                    ?>
                                                                    <tr>
                                                                        <td class="text-center px-2 py-2"><?php echo $index; ?></td>
                                                                        <td class="text-center px-2 py-2">
                                                                            <?php 
                                                                                if(!empty($data['bill_date']) && $data['bill_date'] != "0000-00-00") {
                                                                                    echo date('d-m-Y',strtotime($data['bill_date']));
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-center px-2 py-2">
                                                                            <?php 
                                                                                if(!empty($data['bill_number']) && $data['bill_number'] != $GLOBALS['null_value']) {
                                                                                    echo $data['bill_number'];
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <?php /*
                                                                        <td>
                                                                            <?php 
                                                                                if(!empty($data['bill_type']) && $data['bill_type'] != $GLOBALS['null_value']) {
                                                                                    echo $data['bill_type'];
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        */ ?>
                                                                        <td class="text-end text-success fw-bold px-2 py-2">
                                                                            <?php 
                                                                                if(!empty($data['credit'])) { 
                                                                                    echo $obj->numberFormat($data['credit'],2); 
                                                                                    $total_credit += $data['credit']; 
                                                                                }
                                                                                else {
                                                                                    echo '0.00';
                                                                                } 
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-end text-danger fw-bold px-2 py-2">
                                                                            <?php 
                                                                                if(!empty($data['debit'])) { 
                                                                                    echo $obj->numberFormat($data['debit'],2); 
                                                                                    $total_debit += $data['debit'];
                                                                                } 
                                                                                else {
                                                                                    echo '0.00';
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $index++;
                                                                } 
                                                            }
                                                            if(!empty($opening_credit) || !empty($opening_debit) || !empty($total_records_list)) {
                                                                ?>
                                                                <tr>
                                                                    <th class="text-end" colspan="3">Total</th>
                                                                    <th class="text-end text-success mr-5" style="margin: 30px 40px;"><?php echo $obj->numberFormat($total_credit,2); ?></th>
                                                                    <th class="text-end text-danger mr-5" style="margin: 30px 40px;"><?php echo $obj->numberFormat($total_debit,2); ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-end" colspan="3">Current Balance</th>
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
                                                                    <td colspan="5" class="text-center">Sorry! No records found</td>
                                                                </tr>								
                                                                <?php 
                                                            } 
                                                        ?>
                                                    </tbody>
                                                </table>
                                            <?php } else { ?>
                                                 <table class="table table-nowrap table-bordered nowrap text-center" id="tbl_pending_balance_report_list">
                                                    <thead class="smallfnt">
                                                        <tr>
                                                            <th colspan="5" class="text-center" style="border: 1px solid #dee2e6;font-weight: bold; font-size: 18px;">
                                                                Suspense Party Balance Report
                                                            </th>
                                                        </tr>
                                                        <div>
                                                            <tr class="d-none header">
                                                                <th colspan="5"><?php echo $obj->encode_decode('decrypt',$company_name); ?></th>
                                                            </tr>
                                                            <tr class="d-none header">
                                                                <th colspan="5"><?php echo $obj->encode_decode('decrypt',$address1); ?></th>
                                                            </tr>
                                                            <tr class="d-none header">
                                                                <th colspan="5"><?php echo $obj->encode_decode('decrypt',$city); ?></th>
                                                            </tr>
                                                            <tr class="d-none header">
                                                                <th colspan="5"><?php echo $obj->encode_decode('decrypt',$state); ?></th>
                                                            </tr>
                                                            <tr class="d-none header">
                                                                <th colspan="5"><?php echo "Mobile No : ". $obj->encode_decode('decrypt',$mobile_number); ?></th>
                                                            </tr>
                                                            <?php if(!empty($gst_number)) { ?>
                                                                <tr class="d-none header">
                                                                    <th colspan="5"><?php echo "GST No : ".$obj->encode_decode('decrypt',$gst_number); ?></th>
                                                                </tr>
                                                            <?php } ?>
                                                        </div>
                                                        <tr class="bg-secondary text-white">
                                                            <th>S.No</th>
                                                            <!-- <th>Type</th> -->
                                                            <th>Party</th>
                                                            <th>Credit (Rs.)</th>
                                                            <th>Debit (Rs.)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $index = 1; $total_credit = 0; $total_debit = 0;
                                                            if(!empty($total_records_list)) {
                                                                foreach($total_records_list as $data) { 
                                                                    $credit = 0; $debit = 0;
                                                                    if(!empty($data['credit']) && !empty($data['debit'])) {
                                                                        if($data['credit'] > $data['debit']) {
                                                                            $credit = $data['credit'] - $data['debit'];
                                                                        }
                                                                        else {
                                                                            $debit = $data['debit'] - $data['credit'];
                                                                        }
                                                                    }
                                                                    else if(!empty($data['credit'])) {
                                                                        $credit = $data['credit'];
                                                                    }
                                                                    else if(!empty($data['debit'])) {
                                                                        $debit = $data['debit'];
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <th><?php echo $index; ?></th>
                                                                        <?php /*
                                                                        <th class="text-center">
                                                                            <?php
                                                                                if(!empty($data['party_type']) && $data['party_type'] != $GLOBALS['null_value']) {
                                                                                    echo $data['party_type'];
                                                                                }
                                                                            ?>
                                                                        </th>
                                                                         */ ?>
                                                                        <td onclick="Javascript:ShowPartyBalance('<?php if(!empty($data['party_id'])) { echo $data['party_id']; } ?>', '<?php if(!empty($data['party_type'])) { echo $data['party_type']; } ?>');" style="cursor:pointer!important;">
                                                                            <?php
                                                                                $party_name = "";
                                                                                if(!empty($data['party_type']) && !empty($data['party_id'])) {
                                                                                    if($data['party_type'] == 'Suspense Party') {
                                                                                        $party_name = $obj->getTableColumnValue($GLOBALS['suspense_party_table'], 'suspense_party_id', $data['party_id'], 'suspense_party_name');
                                                                                    }
                                                                                   
                                                                                    if(!empty($party_name) && $party_name != $GLOBALS['null_value']) {
                                                                                        echo $obj->encode_decode('decrypt', $party_name);
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-end">
                                                                            <?php
                                                                                if(!empty($credit)) {
                                                                                    echo $obj->numberFormat($credit, 2);
                                                                                    $total_credit += $credit;
                                                                                }else{
                                                                                    echo "-";
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-end">
                                                                            <?php
                                                                                if(!empty($debit)) {
                                                                                    echo $obj->numberFormat($debit, 2);
                                                                                    $total_debit += $debit;
                                                                                }else{
                                                                                    echo "-";
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $index++;
                                                                } 
                                                                ?>
                                                                <tr>
                                                                    <th class="text-end" colspan="2">Total</th>
                                                                    <th class="text-end text-success mr-5" style="margin: 30px 40px;"><?php echo $obj->numberFormat($total_credit,2); ?></th>
                                                                    <th class="text-end text-danger mr-5" style="margin: 30px 40px;"><?php echo $obj->numberFormat($total_debit,2); ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-end" colspan="2">Current Balance</th>
                                                                    <th class="text-end text-success mr-5" style="margin: 30px 40px;">
                                                                        <?php 
                                                                            if($total_credit > $total_debit) {
                                                                                $total = $total_credit - $total_debit;
                                                                                echo $obj->numberFormat($total,2); 
                                                                            }else{
                                                                                echo "0.00";
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th class="text-end text-danger mr-5" style="margin: 30px 40px;">
                                                                        <?php 
                                                                            if($total_debit > $total_credit) {
                                                                                $total = $total_debit - $total_credit;
                                                                                echo $obj->numberFormat($total,2); 
                                                                            }else{
                                                                                echo "0.00";
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                </tr>
                                                                <?php 
                                                            }
                                                            else {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="4" class="text-center">Sorry! No records found</td>
                                                                </tr>								
                                                                <?php 
                                                            } 
                                                        ?>
                                                    </tbody>
                                                </table>
                                            <?php } ?>
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
        $("#report").addClass("active");
        $("#suspense_party_balance_report").addClass("active");
    });
</script>
<script type="text/javascript">
    function getReport() {
        if(jQuery('form[name="pending_balance_report_form"]').length > 0) {
            jQuery('form[name="pending_balance_report_form"]').submit();
        }
    }
    function ShowPartyBalance(party_id, party_type) {
        // if(party_type == 'Suspense Party') {
            if(jQuery('select[name="filter_suspense_party_id"]').length > 0) {
                jQuery('select[name="filter_suspense_party_id"]').val(party_id);
            }
        // }
        getReport();
    }
    function GetParty(suspense_party_id) {
        if(suspense_party_id != "") {
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

        getReport();
    }
</script>
<script>
    function ExportToExcel(type, fn, dl) {
        jQuery('.header').removeClass('d-none');
        
        var elt = document.getElementById('tbl_pending_balance_report_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });

        if (dl) {
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' });
        } else {
            XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        }
        jQuery('.header').addClass('d-none');
    }
</script>