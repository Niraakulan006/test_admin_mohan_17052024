<?php 
	$page_title = "Tripsheet Profit Loss";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['tripsheet_profit_loss_module'];
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
    <script type ="text/javascript" src="include/js/profit_loss.js"></script>
    <script type ="text/javascript" src="include/js/payment.js"></script>
    <script type="text/javascript" src="include/js/creation_modules.js"></script>
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
                                <h5 class="text-white">Tripsheet Profit Loss Details</h5>
                            </div>
                            <div class="col-lg-4 col-4">
                                <?php
                                $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_module = $GLOBALS['tripsheet_profit_loss_module'];
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
                        <div id="table_listing_records" class="table-responsive poppins">
                            <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                            <table class="table nowrap cursor text-center bg-white" id="datatable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>S.No</th>
                                        <th>From Trip No.</th>
                                        <th>To Trip No.</th>
                                        <th>Vehicle Number</th>
                                        <th>Driver</th>
                                        <th>Delivery</th>
                                        <th>Freight</th>
                                        <th>Cooly</th>
                                        <th>Overall</th>
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
        $("#tripsheet_profit_loss").addClass("active");

        if(jQuery('#datatable').length > 0) {
            var table = jQuery('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering" : true,
                "searching" : false,
                "columnDefs": [
                    { "orderable": false, "targets": [0,5,6,7,8,9] }
                ],
                "ajax": {
                    "url": "tripsheet_profit_loss_changes.php",
                    "type": "POST",
                },
                "columns": [
                    { "data": "sno", "className": "text-center" },
                    { "data": "from_tripsheet_number", "className": "text-center" },
                    { "data": "to_tripsheet_number", "className": "text-center" },
                    { "data": "vehicle_number", "className": "text-center" },
                    { "data": "driver_name", "className": "text-center" },
                    { "data": "delivery", "className": "text-center" },
                    { "data": "freight", "className": "text-center" },
                    { "data": "cooly", "className": "text-center" },
                    { "data": "overall", "className": "text-center" },
                    { "data": "action", "className": "text-center" }
                ]
            });
        }
    });
</script>