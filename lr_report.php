<?php 
	$page_title = "LR report";
	include("include_files.php");
    $organization_id = ""; $branch_id =""; $consignee_id = ""; $consignor_id =""; $bill_type ="";$from_date =""; $to_date ="";$godown_id =""; $show_bill =""; $filter_gst_type = ""; 
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }

    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date("Y-m-d");
    $from_date = "";
    if(isset($_SESSION['billing_year_starting_date']) && !empty($_SESSION['billing_year_starting_date'])) {
        $from_date = $_SESSION['billing_year_starting_date'];
        if(!empty($from_date)) {
            $from_date = date("Y-m-d", strtotime($from_date));
        }
    }
    $to_date = "";
    if(isset($_SESSION['billing_year_ending_date']) && !empty($_SESSION['billing_year_ending_date'])) {
        $to_date = $_SESSION['billing_year_ending_date'];
        if(!empty($to_date)) {
            $to_date = date("Y-m-d", strtotime($to_date));
        }
    }
    
    if(!empty($from_date) && !empty($to_date)) {
        $current_date = date("Y-m-d");
        //echo "from_date - ".$from_date.", to_date - ".$to_date.", current_date - ".$current_date."<br>";
        if( (strtotime($current_date) >= strtotime($from_date)) && (strtotime($current_date) <= strtotime($to_date)) ) {
            $to_date = $current_date; 
        }
        else {
            $current_month = date("m");
            if($current_month == "01" || $current_month == "02" || $current_month == "03") {
                $to_date = date("Y", strtotime($to_date))."-".date("m-d");
            }
            else {
                $to_date = date("Y", strtotime($from_date))."-".date("m-d");
            }
        }
        if(!empty($to_date)) {
            $from_date = date("Y-m-d", strtotime("-10 days", strtotime($to_date)));
        }
    }

    $branch_list = array();
    $branch_list = $obj->getTableRecords($GLOBALS['branch_table'],'','');
    $consignee_list = array();
    $consignee_list = $obj->getTableRecords($GLOBALS['consignee_table'],'','');
    $consignor_list = array();
    $consignor_list = $obj->getTableRecords($GLOBALS['consignor_table'],'','');
    $account_party_list = array();
    $account_party_list = $obj->getTableRecords($GLOBALS['account_party_table'],'','');
    $organization_list = array();
    $organization_list = $obj->getTableRecords($GLOBALS['organization_table'],'','');

    if(isset($_POST['from_date']))
    {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date']))
    {
        $to_date = $_POST['to_date'];
    }
    if(isset($_POST['bill_type']))
    {
        $bill_type = $_POST['bill_type'];
    }
	if(isset($_POST['consignee_id']))
    {
        $consignee_id = $_POST['consignee_id'];
    }
    if(isset($_POST['consignor_id']))
    {
        $consignor_id = $_POST['consignor_id'];
    }
    if(isset($_POST['filter_gst_type']))
    {
        $filter_gst_type = $_POST['filter_gst_type'];
    }
    $from_branch_id = ""; $to_branch_id = "";
    if(isset($_POST['from_branch_id'])) {
        $from_branch_id = trim($_POST['from_branch_id']);
    }
    if(isset($_POST['to_branch_id'])) {
        $to_branch_id = trim($_POST['to_branch_id']);
    }

    $lr_list = array();
    $lr_list = $obj->getLRDetailsList('',$organization_id, $from_branch_id, $to_branch_id,$consignee_id,$consignor_id,$bill_type,'0',$from_date, $to_date,$godown_id, $filter_gst_type);

    $to_branch_list = array();
    if(!empty($from_branch_id)) {
        $to_branch_list = $obj->ToBranchList($from_branch_id);
    }
    else {
        $to_branch_list = $obj->getTableRecords($GLOBALS['branch_table'], '', '');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/common.js"></script>
</head>	
<body>
<?php include "header.php"; ?>
<!--Right Content-->
    <div class="pcoded-content">
        <div class="page-header card">
            <div class="mt-1">
                <div class="border card-box d-none add_update_form_content" id="add_update_form_content" >
                </div>
                <div class="border card-box bg-white" id="table_records_cover">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-8">
                                <h5 class="text-white">LR Report</h5>
                            </div>
                        </div>
                    </div>
                    <div class="poppins smallfnt">
                       <form name="report_form" method="post">
                            <div class="col-sm-6 col-xl-8">
                                <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                            </div>
                            <div class="row px-2 mt-3">
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="date" id="from_date" name="from_date" class="form-control shadow-none" placeholder="From Date" value="<?php if(!empty($from_date)){ echo $from_date; }?>" onChange="Javascript:getReport();">
                                            <label>From Date</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="date" id="to_date" name="to_date"  class="form-control shadow-none" placeholder="" value="<?php if(!empty($to_date)){ echo $to_date; }?>" onChange="Javascript:getReport();">
                                            <label>To Date</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select name="from_branch_id" class="form-control" onchange="Javascript:getToBranchFilter();">
                                                <option value="">Select Branch</option>
                                                <?php
                                                    if(!empty($branch_list)) {
                                                        foreach($branch_list as $data) {
                                                            if(!empty($login_branch_id)) {
                                                                if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value'] && in_array($data['branch_id'], $login_branch_id)) {
                                                                    ?>
                                                                    <option value="<?php echo $data['branch_id']; ?>" <?php if(!empty($from_branch_id) && $from_branch_id == $data['branch_id']) { ?>selected<?php } ?>>
                                                                        <?php
                                                                            if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['name']);
                                                                            }
                                                                        ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                            else if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value']) {
                                                                ?>
                                                                <option value="<?php echo $data['branch_id']; ?>" <?php if(!empty($from_branch_id) && $from_branch_id == $data['branch_id']) { ?>selected<?php } ?>>
                                                                    <?php
                                                                        if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                                            echo $obj->encode_decode('decrypt', $data['name']);
                                                                        }
                                                                    ?>
                                                                </option>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?> 
                                            </select>
                                            <label>From Branch</label>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select name="to_branch_id" class="form-control" onchange="Javascript:getReport();">
                                                <option value="">Select Branch</option>
                                                <?php
                                                    if(!empty($to_branch_list)) {
                                                        foreach($to_branch_list as $data) {
                                                ?>
                                                            <option value="<?php if(!empty($data['branch_id'])) { echo $data['branch_id']; } ?>" <?php if(!empty($to_branch_id) && $to_branch_id == $data['branch_id']) { ?>selected<?php } ?>>
                                                                <?php
                                                                    if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                                        echo $obj->encode_decode('decrypt', $data['name']);
                                                                    }
                                                                ?>
                                                            </option>
                                                <?php
                                                        }
                                                    }
                                                ?> 
                                            </select>
                                            <label>To Branch</label>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select class="form-control" name="bill_type" onchange="Javascript:getReport();">
                                                <option value="">Select Bill Type</option>
                                                <option <?php if(!empty($bill_type)){ if($bill_type == 'ToPay' ){ echo "selected"; } } ?>>ToPay</option>
                                                <option <?php if(!empty($bill_type)){ if($bill_type == 'Paid' ){ echo "selected"; } } ?>>Paid</option>
                                                <option <?php if(!empty($bill_type)){ if($bill_type == 'Account Party' ){ echo "selected"; } } ?>>Account Party</option>
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select class="form-control" onchange="Javascript:getReport();" name="consignee_id">
                                                <option value="">Select Consignee</option>
                                                <?php
                                                    if(!empty($consignee_list)) {
                                                        foreach($consignee_list as $data) {
                                                ?>
                                                            <option value="<?php if(!empty($data['consignee_id'])) { echo $data['consignee_id']; } ?>" <?php if(!empty($consignee_id)){ if($data['consignee_id'] == $consignee_id ){ echo "selected"; } } ?>>
                                                                <?php
                                                                    if(!empty($data['name'])) {
                                                                        $data['name'] = $obj->encode_decode('decrypt', $data['name']);
                                                                        echo $data['name'];
                                                                        if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                                                            $data['city'] = $obj->encode_decode('decrypt', $data['city']);
                                                                            echo " - ".$data['city'];
                                                                        }
                                                                    }
                                                                ?>
                                                            </option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select class="form-control"  onChange="Javascript:getReport();" name="consignor_id">
                                                <option value="">Select Consignor</option>
                                                <?php
                                                    if(!empty($consignor_list)) {
                                                        foreach($consignor_list as $data) {
                                                ?>
                                                            <option value="<?php if(!empty($data['consignor_id'])) { echo $data['consignor_id']; } ?>" <?php if(!empty($consignor_id)){ if($data['consignor_id'] == $consignor_id ){ echo "selected"; } } ?>>
                                                                <?php
                                                                    if(!empty($data['name'])) {
                                                                        $data['name'] = $obj->encode_decode('decrypt', $data['name']);
                                                                        echo $data['name'];
                                                                        if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                                                            $data['city'] = $obj->encode_decode('decrypt', $data['city']);
                                                                            echo " - ".$data['city'];
                                                                        }
                                                                    }
                                                                ?>
                                                            </option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label>Consignor</label>
                                        </div> 
                                    </div>
                                </div>
                                  <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2"  onChange="Javascript:getReport();">
                                            <select name="filter_gst_type" class="form-control">
                                                <option value="">Select GST Type</option>
                                                <option value="1"  <?php if(!empty($filter_gst_type) && $filter_gst_type == 1){ ?> Selected<?php } ?>>GST Bill</option>
                                                <option value="0"  <?php if($filter_gst_type == 0){ ?> Selected<?php } ?>>Non GST Bill</option>
                                            </select>
                                            <label>GST Type</label>
                                        </div> 
                                    </div>
                                </div>
                                <!-- <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group">
                                        <div class="form-label-group in-border">
                                            <input type="text" id="search_text" name="search_text" class="form-control shadow-none" placeholder="Search lr No" onKeyUp="Javascript:table_listing_records_filter();">
                                            <label>Search LR No</label>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="col-sm-3 col-lg-1 form-group">
                                    <button type="button" class="btn btn-success" type="button" onClick="DownloadProductExcel('tbl_sales_list', 'LR_report')"> <i class="fa fa-download"></i> Export </button>
                                    
                                </div> -->
                                <div class="col-sm-3 col-lg-2 form-group">
                                    <button type="button" class="btn btn-success" type="button" onClick="open_order_report('<?php echo $from_branch_id; ?>','<?php echo $to_branch_id; ?>','<?php echo $from_date; ?>','<?php echo $to_date; ?>','<?php echo $bill_type; ?>','<?php echo $consignee_id; ?>','<?php echo $consignor_id; ?>','<?php echo $filter_gst_type; ?>')"> <i class="fa fa-download"></i> Print </button>
                                    
                                </div>
                            </div>
                            <div class="table nowrap">
                                <div class="w-100 px-3 py-3">
                                    <div id="report_area" class="w-100">
                                        <table class="table nowrap" id="tbl_sales_list" style="border:1px solid black">
                                            <thead>
                                                <tr>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">S.No</th>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">LR.No/Date</th>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Consignor</th>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Consignee</th>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">From Branch</th>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">To Branch</th>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Qty / Weight</th>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Amount</th>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Bill type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $index = 0;
                                                    if(!empty($lr_list)) {
                                                        $account_party_name = "";
                                                        $edit_action = $obj->encode_decode('encrypt', 'edit_action');
                                                        $product_count = 0; $quantity = ""; $grand_amount = 0; $grand_tax = 0; $grand_quantity = 0;
                                                        foreach($lr_list as $key => $data) {
                                                            $index = $key + 1;
                                                            if(!empty($data['account_party_id'])){
                                                                $account_party_name =$obj->getTableColumnValue($GLOBALS['account_party_table'],'account_party_id',$data['account_party_id'],'name');
                                                                if(!empty($account_party_name)){
                                                                    $account_party_name = $obj->encode_decode("decrypt",$account_party_name);
                                                                }
                                                            }
                                                            if(!empty($data['product_id'])) {
                                                                $product_ids = explode(",", $data['product_id']);
                                                                $product_count = count($product_ids);
                                                            }
                                                            
                                                            $quantity = "";$weight = "";
                                                            
                                                            $quantity = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_number', $data['lr_number'], 'quantity');
                                                            

                                                            $quantity_value = 0;
                                                            if($quantity!=''){
                                                                $quantity_ids = explode(",", $quantity);
                                                                $quantity_value = array_sum($quantity_ids);
                                                            }
                                                            $weight_value = 0;
                                                            if($weight!=''){
                                                                $weight_ids = explode(",",$weight);
                                                                $weight_value = array_sum($weight_ids);
                                                            }
                                                            

                                                            if(!empty($prefix)) { $index = $index + $prefix; } ?>
                                                            
                                                                <tr>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2"><?php echo $index; ?></td>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                        <?php 
                                                                            if(!empty($data['lr_date'])) { 
                                                                                echo date("d-m-Y",strtotime($data['lr_date']))." <br> ".$data['lr_number'];
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                        <?php 
                                                                            if(!empty($data['consignor_id']))
                                                                            {
                                                                                $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'],'consignor_id',$data['consignor_id'],'name');
                                                                                if(!empty($consignor_name))
                                                                                {
                                                                                    $consignor_name = $obj->encode_decode("decrypt",$consignor_name);
                                                                                }
                                                                                echo $consignor_name;
                                                                                $consignor_mobile_numer = "";
                                                                                $consignor_mobile_numer = $obj->getTableColumnValue($GLOBALS['consignor_table'],'consignor_id',$data['consignor_id'],'mobile_number');
                                                                                if(!empty($consignor_mobile_numer) && $consignor_mobile_numer != $GLOBALS['null_value']) {
                                                                                    $consignor_mobile_numer = $obj->encode_decode("decrypt",$consignor_mobile_numer);
                                                                                    echo "<br>".$consignor_mobile_numer;
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                        <?php 
                                                                            if(!empty($data['consignee_id']))
                                                                            {
                                                                                $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$data['consignee_id'],'name');
                                                                                if(!empty($consignee_name))
                                                                                {
                                                                                    $consignee_name = $obj->encode_decode("decrypt",$consignee_name);
                                                                                }
                                                                                echo $consignee_name;
                                                                                $consignee_mobile_numer = "";
                                                                                $consignee_mobile_numer = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$data['consignee_id'],'mobile_number');
                                                                                if(!empty($consignee_mobile_numer) && $consignee_mobile_numer != $GLOBALS['null_value']) {
                                                                                    $consignee_mobile_numer = $obj->encode_decode("decrypt",$consignee_mobile_numer);
                                                                                    echo "<br>".$consignee_mobile_numer;
                                                                                }
                                                                            }
                                                                            if(empty($consignee_name) && !empty($account_party_name)){
                                                                                echo $account_party_name."(Acc.Party)";
                                                                                $account_party_mobile_numer = "";
                                                                                $account_party_mobile_numer = $obj->getTableColumnValue($GLOBALS['account_party_table'],'account_party_id',$data['account_party_id'],'mobile_number');
                                                                                if(!empty($account_party_mobile_numer) && $account_party_mobile_numer != $GLOBALS['null_value']) {
                                                                                    $account_party_mobile_numer = $obj->encode_decode("decrypt",$account_party_mobile_numer);
                                                                                    echo "<br>".$account_party_mobile_numer;
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                        <?php 
                                                                            $branch_name = "";
                                                                            if(!empty($data['from_branch_id'])) {
                                                                                $branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$data['from_branch_id'],'name');
                                                                                if(!empty($branch_name))
                                                                                {
                                                                                    $branch_name = $obj->encode_decode("decrypt",$branch_name);
                                                                                }
                                                                                echo $branch_name;
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                        <?php 
                                                                            $branch_name = "";
                                                                            if(!empty($data['to_branch_id'])) {
                                                                                $branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$data['to_branch_id'],'name');
                                                                                if(!empty($branch_name))
                                                                                {
                                                                                    $branch_name = $obj->encode_decode("decrypt",$branch_name);
                                                                                }
                                                                                echo $branch_name;
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                        <?php 
                                                                        // if(!empty($data['unit_id'])){
                                                                        //     $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$data['unit_id'],'unit_name');
                                                                        //     $unit_name = $obj->encode_decode('decrypt',$unit_name);
                                                                        // }
                                                                        $total_quantity = 0;$total_weight = 0;
                                                                        if($data['quantity']!=''){ 
                                                                            $quantity = explode(",",$data['quantity']);
                                                                            $total_quantity = array_sum($quantity);
                                                                        } 
                                                                        if($data['weight']!=''){
                                                                            $weight = explode(",",$data['weight']);
                                                                            $total_weight = array_sum($weight);
                                                                        }
                                                                        if($total_quantity!='' ){
                                                                            echo $total_quantity.",".$total_weight;
                                                                        }
                                                                        else if($total_quantity!='' ){
                                                                            echo $total_quantity;
                                                                        }
                                                                        else if($total_weight!=''){
                                                                            echo $total_weight;
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2"><?php if($data['total']!=''){ echo $data['total']; }?></td>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2"><?php if(!empty($data['bill_type'])){ echo $data['bill_type']; }?></td>
                                                                </tr>
                                                            <?php
                                                        } ?>
                                                        <!-- <tr>
                                                            <th class="text-right px-2 py-2" colspan="4" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Total</th>
                                                            <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-right px-2 py-2">
                                                                <?php echo number_format($grand_amount,2); ?>
                                                            </td>
                                                        </tr> -->
                                                    <?php }
                                                    else { ?>
                                                        <tr>
                                                            <td colspan="9" class="text-center">Sorry! No records found</td>
                                                        </tr>
                                                <?php } ?>
                                                <?php if($index == 1){ ?>
                                                    <tr style="height:40px;"></tr>
                                                <?php } ?>
                                            </tbody> 			
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
				    </div>
                </div>
            </div>
        </div>
    </div>
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#report").addClass("active");
        $("#lr_report").addClass("active");
    });
</script>
<script type="text/javascript">
    function getReport() {
        if(jQuery('form[name="report_form"]').length > 0) {
            jQuery('form[name="report_form"]').submit();
        }
    }

    function getProductOverallStock(product_id) {
        if(product_id != "") {
            if(jQuery('select[name="product_id"]').length > 0) {
                jQuery('select[name="product_id"]').val(product_id).trigger('change');
            }
            if(jQuery('form[name="report_form"]').length > 0) {
                jQuery('form[name="report_form"]').submit();
            }
        }
    }

    jQuery(document).ready(function(){
        <?php if(!empty($overall_stock_list) || !empty($stock_report)) { ?>
            prepare_report_preview();
        <?php } ?>
    });
</script>
<script>
        function DownloadProductExcel(table, name) {
            var uri = 'data:application/vnd.ms-excel;base64,'
                    ,
                    template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; 
					charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
                    , base64 = function (s) {
                        return window.btoa(unescape(encodeURIComponent(s)))
                    }
                    , format = function (s, c) {
                        return s.replace(/{(\w+)}/g, function (m, p) {
                            return c[p];
                        })
                    }
                if (!table.nodeType) table = document.getElementById(table)
                var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
                var a = document.createElement('a');
                a.href = uri + base64(format(template, ctx))
                a.download = name+'.xls';
                //triggering the function
                a.click();
        }
    </script>
    <script>
        function getToBranchFilter() {
            var from_branch_id = "";
            if(jQuery('select[name="from_branch_id"]').length > 0) {
                from_branch_id = jQuery('select[name="from_branch_id"]').val().trim();
            }
            var post_url = "lr_bill_changes.php?get_to_branch_filter="+from_branch_id;
            jQuery.ajax({
                url: post_url, success: function (result) {
                    result = result.trim();
                    if(jQuery('select[name="to_branch_id"]').length > 0) {
                        jQuery('select[name="to_branch_id"]').html(result);
                    }
                    getReport();
                }
            });
        }
        function open_order_report(from_branch_id,to_branch_id,from_date,to_date,bill_type,consignee_id,consignor_id,filter_gst_type){
            var url = "reports/rpt_lr_report.php?from_date="+ from_date +"&to_date="+ to_date +"&from_branch_id="+ from_branch_id +"&to_branch_id="+ to_branch_id +"&bill_type="+ bill_type +"&consignee_id="+ consignee_id +"&consignor_id="+ consignor_id+"&filter_gst_type="+filter_gst_type;
            window.open(url,'_blank');
        }
    </script>