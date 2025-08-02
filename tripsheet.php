<?php 
	$page_title = "Tripsheet";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['tripsheet_module'];
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
    $branch_list = array();
    $branch_list = $obj->getTableRecords($GLOBALS['branch_table'],'','');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type ="text/javascript" src="include/js/luggage.js"></script>
</head>	
<body>
<?php include "header.php"; ?>
<!--Right Content-->
    <div class="pcoded-content">
        <div class="page-header card">
            <div class="mt-1">
                <div class="border card-box d-none add_update_form_content" id="add_update_form_content">
                </div>
                <div class="border card-box bg-white" id="table_records_cover">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-8">
                                <h5 class="text-white">Tripsheet Details</h5>
                            </div>
                            <div class="col-lg-4 col-4">
                                <?php
                                $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_module = $GLOBALS['tripsheet_module'];
                                    $permission_action = $add_action;
                                    include('permission_action.php');
                                }
                                if(empty($access_error)) { ?>
                                    <button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="poppins smallfnt">
                       <form name="table_listing_form" method="post">
                            <div class="row px-2 mt-3">
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="date" id="from_date" name="from_date" class="form-control shadow-none" value="<?php if(!empty($from_date)){ echo $from_date; }?>" placeholder="">
                                            <label>From Date</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="date" id="to_date" name="to_date" class="form-control shadow-none" value="<?php if(!empty($to_date)){ echo $to_date; }?>" placeholder="">
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
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="form-group">
                                        <input type="text" id="search_text" name="search_text" class="form-control shadow-none" placeholder="Search By Tripsheet no">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="table_listing_records" class="table-responsive poppins">
                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                            <table class="table nowrap cursor text-center bg-white" id="datatable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Tripsheet Date</th>
                                        <th>Tripsheet No.</th>
                                        <th>From Branch</th>
                                        <th>To Branch</th>
                                        <th>LR Count</th>
                                        <th>Vehicle Name</th>
                                        <th>Vehicle Number</th>
                                        <th>Driver</th>
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
<?php include "footer.php"; ?>        
<script>
    $(document).ready(function(){
        $("#tripsheet").addClass("active");

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
                    { "orderable": false, "targets": [0,5,9] }
                ],
                "ajax": {
                    "url": "tripsheet_changes.php",
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
                        if(jQuery('input[name="search_text"]').length > 0) {
                            d.search_text = jQuery('input[name="search_text"]').val();
                        }
                    }
                },
                "columns": [
                    { "data": "sno", "className": "text-center" },
                    { "data": "tripsheet_date", "className": "text-center" },
                    { "data": "tripsheet_number", "className": "text-center" },
                    { "data": "from_branch_name", "className": "text-center" },
                    { "data": "to_branch_name", "className": "text-center" },
                    { "data": "lr_count", "className": "text-center" },
                    { "data": "vehicle_name", "className": "text-center" },
                    { "data": "vehicle_number", "className": "text-center" },
                    { "data": "driver_name", "className": "text-center" },
                    { "data": "action", "className": "text-center" }
                ]
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
            if(jQuery('input[name="search_text"]').length > 0) {
                jQuery('input[name="search_text"]').on('keyup', function() {
                    table.ajax.reload();
                });
            }
        }
    });
</script>