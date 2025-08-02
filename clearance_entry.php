<?php 
	$page_title = "Clearance Entry";
	include("include_user_check_and_files.php");

	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
   
    $lr_list = array();
    $lr_list = $obj->getUnClearencelLrList($login_branch_id);
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['unclearance_entry_module'];
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type ="text/javascript" src="include/js/invoice.js"></script>
    <script type ="text/javascript" src="include/js/common.js"></script>
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
                            <h5 class="text-white">UnClearance Entry Details</h5>
                        </div>
                    </div>
                </div>
                
                <div class="poppins smallfnt">
                    <form name="table_listing_form" method="post">
                        <div class="row px-2 mt-3">
                            <div class="col-lg-2 col-md-4 col-6">
                                <div class="form-group mb-1">
                                    <div class="form-label-group in-border pb-2">
                                        <input type="date" id="from_date" name="from_date" value="<?php if(!empty($from_date)) { echo $from_date; }?>" class="form-control shadow-none" placeholder="">
                                        <label>From Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <div class="form-group mb-1">
                                    <div class="form-label-group in-border pb-2">
                                        <input type="date" id="to_date" name="to_date" value="<?php if(!empty($to_date)){ echo $to_date; }?>" class="form-control shadow-none" placeholder="">
                                        <label>To Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-6">
                                <div class="form-group mb-1">
                                    <div class="form-label-group in-border pb-2">
                                        <select class="form-control" name="lr_number">
                                            <option value="">Select LR</option>
                                            <?php
                                                if(!empty($lr_list)) {
                                                    foreach($lr_list as $data) {
                                            ?>
                                                        <option value="<?php if(!empty($data['lr_number'])) { echo $data['lr_number']; } ?>">
                                                            <?php
                                                                if(!empty($data['lr_number'])) {
                                                                    echo $data['lr_number'];
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

                            <?php
                                $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_module = $GLOBALS['unclearance_entry_module'];
                                    $permission_action = $add_action;
                                    include('permission_action.php');
                                }
                                if(empty($access_error)) { ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="form-group mb-1">
                                            <div class="form-label-group in-border pb-2">
                                                <button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="getClear();">Clear</button>
                                            </div> 
                                        </div>
                                    </div>
                            <?php } ?>
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
                                    <th>Received By</th>
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
        $("#clearanceentry").addClass("active");

        if(jQuery('#datatable').length > 0) {
            var table = jQuery('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering" : true,
                "searching" : false,
                "columnDefs": [
                    { "orderable": false, "targets": [0,5] }
                ],
                "ajax": {
                    "url": "clearance_entry_changes.php",
                    "type": "POST",
                    "data": function(d) {
                        if(jQuery('input[name="from_date"]').length > 0) {
                            d.from_date = jQuery('input[name="from_date"]').val();
                        }
                        if(jQuery('input[name="to_date"]').length > 0) {
                            d.to_date = jQuery('input[name="to_date"]').val();
                        }
                        if(jQuery('select[name="lr_number"]').length > 0) {
                            d.lr_number = jQuery('select[name="lr_number"]').val();
                        }
                    }
                },
                "columns": [
                    { "data": "sno", "className": "text-center" },
                    { "data": "lr_date", "className": "text-center" },
                    { "data": "lr_number", "className": "text-center" },
                    { "data": "consignor_name", "className": "text-center" },
                    { "data": "received_person", "className": "text-center" },
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
            if(jQuery('select[name="lr_number"]').length > 0) {
                jQuery('select[name="lr_number"]').on('change', function() {
                    table.ajax.reload();
                });
            }
        }
    });
</script>