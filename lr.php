<?php 
	$page_title = "Lr";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['lr_module'];
            include("permission_check.php");
        }
    }

    $lr_starting_date = "";
    $lr_starting_date = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $GLOBALS['bill_company_id'], 'lr_starting_date');
    if(empty($lr_starting_date) || $lr_starting_date == '0000-00-00'){
        $lr_starting_date = date('Y-m-d', strtotime('-30 days'));
    }
    $from_date = $lr_starting_date; $to_date = date("Y-m-d");

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
            if(!empty($lr_starting_date)){
                $from_date = $lr_starting_date;
            }
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
    $cancelled_count = 0; $cancelled_lr_list = array();
    $cancelled_lr_list = $obj->getTableRecords($GLOBALS['lr_table'], 'cancelled', '1');
    $cancelled_count = count($cancelled_lr_list);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/common.js"></script>
    <script type="text/javascript" src="include/js/countries.js"></script>
    <script type="text/javascript" src="include/js/district.js"></script>
    <script type="text/javascript" src="include/js/cities.js"></script>
    <script type="text/javascript" src="include/js/lr.js"></script>
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
                                <h5 class="text-white">LR Details</h5>
                            </div>
                            <?php  $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_module = $GLOBALS['lr_module'];
                                    $permission_action = $add_action;
                                    include('permission_action.php');
                                }
                                if(empty($access_error)) { ?>
                                    <div class="col-lg-4 col-4">
                                        <button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                    </div>
                                <?php } ?>
                        </div>
                    </div>
               
                    <div class="poppins smallfnt">
                        <form name="table_listing_form" method="post">
                            <div class="row px-2 mt-3">
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="date" id="from_date" name="from_date" class="form-control shadow-none" placeholder="" value="<?php if(!empty($from_date)){ echo $from_date; }?>">
                                            <label>From Date</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="date" id="to_date" name="to_date" class="form-control shadow-none" placeholder="" value="<?php if(!empty($to_date)){ echo $to_date; }?>">
                                            <label>To Date</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select name="from_branch_filter" class="form-control">
                                                <option value="">Select Branch</option>
                                                <?php
                                                    if(!empty($branch_list)) {
                                                        foreach($branch_list as $data) {
                                                            if(!empty($login_branch_id)) {
                                                                if(!empty($data['branch_id']) && $data['branch_id'] != $GLOBALS['null_value'] && in_array($data['branch_id'], $login_branch_id)) {
                                                                    ?>
                                                                    <option value="<?php echo $data['branch_id']; ?>">
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
                                                                <option value="<?php echo $data['branch_id']; ?>">
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
                                            <select name="to_branch_filter" class="form-control">
                                                <option value="">Select Branch</option>
                                                <?php
                                                    if(!empty($branch_list)) {
                                                        foreach($branch_list as $data) {
                                                ?>
                                                            <option value="<?php if(!empty($data['branch_id'])) { echo $data['branch_id']; } ?>">
                                                                <?php
                                                                    if(!empty($data['name'])) {
                                                                        $data['name'] = $obj->encode_decode('decrypt', $data['name']);
                                                                        echo $data['name'];
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
                                            <select class="form-control" name="bill_type">
                                                <option value="">Select Bill Type</option>
                                                <option>ToPay</option>
                                                <option>Paid</option>
                                                <option>Account Party</option>
                                            </select>
                                            <label>Bill Type</label>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select class="form-control" name="consignor_id">
                                                <option value="">Select Consignor</option>
                                                <?php
                                                    if(!empty($consignor_list)) {
                                                        foreach($consignor_list as $data) {
                                                ?>
                                                            <option value="<?php if(!empty($data['consignor_id'])) { echo $data['consignor_id']; } ?>">
                                                                <?php
                                                                    if(!empty($data['name'])) {
                                                                        $data['name'] = $obj->encode_decode('decrypt', $data['name']);
                                                                        echo $data['name'];
                                                                        if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                                                            $data['city'] = $obj->encode_decode('decrypt', $data['city']);
                                                                            echo " - ".$data['city'];
                                                                        }
                                                                    }
                                                                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                                                        $data['mobile_number'] = $obj->encode_decode('decrypt', $data['mobile_number']);
                                                                        echo " - ".$data['mobile_number'];
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
                                        <div class="form-label-group in-border pb-2">
                                            <select class="form-control" name="consignee_id">
                                                <option value="">Select Consignee</option>
                                                <?php
                                                    if(!empty($consignee_list)) {
                                                        foreach($consignee_list as $data) {
                                                ?>
                                                            <option value="<?php if(!empty($data['consignee_id'])) { echo $data['consignee_id']; } ?>">
                                                                <?php
                                                                    if(!empty($data['name'])) {
                                                                        $data['name'] = $obj->encode_decode('decrypt', $data['name']);
                                                                        echo $data['name'];
                                                                        if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                                                            $data['city'] = $obj->encode_decode('decrypt', $data['city']);
                                                                            echo " - ".$data['city'];
                                                                        }
                                                                        if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                                                            $data['mobile_number'] = $obj->encode_decode('decrypt', $data['mobile_number']);
                                                                            echo " - ".$data['mobile_number'];
                                                                        }
                                                                    }
                                                                ?>
                                                            </option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label>Consignee</label>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select name="filter_gst_option" class="form-control">
                                                <option value="">Select GST Type</option>
                                                <option value="1">GST Bill</option>
                                                <option value="0">Non GST Bill</option>
                                            </select>
                                            <label>GST Type</label>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group">
                                        <div class="form-label-group in-border">
                                            <input type="text" id="search_text" name="search_text" class="form-control shadow-none" placeholder="Search lr No">
                                            <label>Search LR No</label>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name='show_bill' value="0" id='show_bill'>
                                <?php if($cancelled_count > 0) { ?>
                                    <div class="col-sm-3 text-center text-sm-left mb-4">
                                        <button class="btn btn-dark poppins" id='show_button' style="font-size:11px;" type="button" onClick="Javascript:show_inactive_lr();">Show Cancelled Bill</button>
                                    </div>
                                <?php } ?>
                                <!-- <button type="button" class="btn btn-dark m-2" onClick="showPaymentStatus('tbl_lr_list', 'LR List')"><i class="fa fa-download"></i> Payment status</button> -->
                            </div>
                        </form>
                        <div id="table_listing_records" class="table-responsive poppins">
                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                            <table class="table nowrap cursor text-center bg-white tbl_lr_list" id="datatable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>S.No</th>
                                        <th>LR Date</th>
                                        <th>LR.No</th>
                                        <th>Consignor</th>
                                        <th>Consignee</th>
                                        <th>From Branch</th>
                                        <th>To Branch</th>
                                        <th>Amount</th>
                                        <th>Bill Type</th>
                                        <th>Tripsheet No.</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
				    </div>
                </div>
            </div>
        </div>
    </div>
<!--Right Content End-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    function DownloadLR(from_date, to_date, branch_id, bill_type, consignee_id, consignor_id, search_text, show_bill) {
        window.open("export_lr.php?from_date="+from_date+"&to_date="+to_date+"&branch_id="+branch_id+"&bill_type="+bill_type+"&consignee_id="+consignee_id+"&consignor_id="+consignor_id+"&search_text="+search_text+"&show_bill="+show_bill+"&filter_gst_option="+filter_gst_option, "_blank")
    }
</script>
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#lr").addClass("active");

        function getToBranchFilter() {
            var from_branch_id = "";
            if(jQuery('select[name="from_branch_filter"]').length > 0) {
                from_branch_id = jQuery('select[name="from_branch_filter"]').val().trim();
            }
            var post_url = "lr_bill_changes.php?get_to_branch_filter="+from_branch_id;
            jQuery.ajax({
                url: post_url, success: function (result) {
                    result = result.trim();
                    if(jQuery('select[name="to_branch_filter"]').length > 0) {
                        jQuery('select[name="to_branch_filter"]').html(result);
                    }
                }
            });
        }
        if(jQuery('#datatable').length > 0) {
            var table = jQuery('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering" : true,
                "searching" : false,
                "columnDefs": [
                    { "orderable": false, "targets": [0,10,11] }
                ],
                "ajax": {
                    "url": "lr_changes.php",
                    "type": "POST",
                    "data": function(d) {
                        if(jQuery('input[name="from_date"]').length > 0) {
                            d.from_date = jQuery('input[name="from_date"]').val();
                        }
                        if(jQuery('input[name="to_date"]').length > 0) {
                            d.to_date = jQuery('input[name="to_date"]').val();
                        }
                        if(jQuery('select[name="from_branch_filter"]').length > 0) {
                            d.from_branch_filter = jQuery('select[name="from_branch_filter"]').val();
                        }
                        if(jQuery('select[name="to_branch_filter"]').length > 0) {
                            d.to_branch_filter = jQuery('select[name="to_branch_filter"]').val();
                        }
                        if(jQuery('select[name="bill_type"]').length > 0) {
                            d.bill_type = jQuery('select[name="bill_type"]').val();
                        }
                        if(jQuery('select[name="consignor_id"]').length > 0) {
                            d.consignor_id = jQuery('select[name="consignor_id"]').val();
                        }
                        if(jQuery('select[name="consignee_id"]').length > 0) {
                            d.consignee_id = jQuery('select[name="consignee_id"]').val();
                        }
                        if(jQuery('input[name="search_text"]').length > 0) {
                            d.search_text = jQuery('input[name="search_text"]').val();
                        }
                        if(jQuery('input[name="show_bill"]').length > 0) {
                            d.show_bill = jQuery('input[name="show_bill"]').val();
                        }
                        if(jQuery('select[name="filter_gst_option"]').length > 0) {
                            d.filter_gst_option = jQuery('select[name="filter_gst_option"]').val();
                        }
                    }
                },
                "columns": [
                    { "data": "sno", "className": "text-center" },
                    { "data": "lr_date", "className": "text-center" },
                    { "data": "lr_number", "className": "text-center" },
                    { "data": "consignor_name", "className": "text-center" },
                    { "data": "consignee_name", "className": "text-center" },
                    { "data": "from_branch_name", "className": "text-center" },
                    { "data": "to_branch_name", "className": "text-center" },
                    { "data": "total", "className": "text-center" },
                    { "data": "bill_type", "className": "text-center" },
                    { "data": "tripsheet_number", "className": "text-center" },
                    { "data": "rpt_type", "className": "text-center" },
                    { "data": "action", "className": "text-center" }
                ],
                "drawCallback": function(settings) {
                    if(jQuery('select[name="rpt_type"]').length > 0) {
                        jQuery('select[name="rpt_type"]').select2({
                            width: '100px !important'
                        });
                    }
                }
            });
            if(jQuery('input[name="from_date"]').length > 0) {
                jQuery('input[name="from_date"]').on('change', function() {
                    table.ajax.reload();
                });
            }
            if(jQuery('input[name="to_date"]').length > 0) {
                jQuery('input[name="to_date"]').on('change', function() {
                    table.ajax.reload();
                });
            }
            if(jQuery('select[name="from_branch_filter"]').length > 0) {
                jQuery('select[name="from_branch_filter"]').on('change', function() {
                    getToBranchFilter();
                    table.ajax.reload();
                });
            }
            if(jQuery('select[name="to_branch_filter"]').length > 0) {
                jQuery('select[name="to_branch_filter"]').on('change', function() {
                    table.ajax.reload();
                });
            }
            if(jQuery('select[name="bill_type"]').length > 0) {
                jQuery('select[name="bill_type"]').on('change', function() {
                    table.ajax.reload();
                });
            }
            if(jQuery('select[name="consignor_id"]').length > 0) {
                jQuery('select[name="consignor_id"]').on('change', function() {
                    table.ajax.reload();
                });
            }
            if(jQuery('select[name="consignee_id"]').length > 0) {
                jQuery('select[name="consignee_id"]').on('change', function() {
                    table.ajax.reload();
                });
            }
            if(jQuery('input[name="search_text"]').length > 0) {
                jQuery('input[name="search_text"]').on('keyup', function() {
                    table.ajax.reload();
                });
            }
            if(jQuery('input[name="show_bill"]').length > 0) {
                jQuery('input[name="show_bill"]').on('change', function() {
                    table.ajax.reload();
                });
            }
            if(jQuery('#show_button').length > 0) {
                jQuery('#show_button').on('click', function() {
                    table.ajax.reload();
                });
            }
            if(jQuery('select[name="filter_gst_option"]').length > 0) {
                jQuery('select[name="filter_gst_option"]').on('change', function() {
                    table.ajax.reload();
                });
            }
        }
    });
    function OpenPDF(lr_id) {
        var rpt_type = ""; var url = "";
        if(jQuery('#rpt_type'+lr_id).length > 0) {
            rpt_type = jQuery('#rpt_type'+lr_id).val().trim();
        }
        url = "reports/rpt_receipt.php?view_lr_id="+lr_id+"&rpt_type="+rpt_type;
        window.open(url, '_blank');
    }
</script>