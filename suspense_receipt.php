<?php 
	$page_title = "Suspense Receipt";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['suspense_receipt_module'];
            include("permission_check.php");
        }
    }

    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date("Y-m-d"); 
    $current_date = date("Y-m-d");

    $party_list = array();
    $party_list = $obj->getSuspensePartyList();

    $cancelled_bill = array(); $cancelled_count = 0;
    $cancelled_bill = $obj->getAllRecords($GLOBALS['suspense_receipt_table'], 'deleted', 1);
    $cancelled_count = count($cancelled_bill);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
        <?php 
         include "link_style_script.php"; ?>
        <script type="text/javascript" src="include/js/payment.js"></script>
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
                                <h5 class="text-white">Suspense Receipt Details</h5>
                            </div>
                            <?php
                                $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_module = $GLOBALS['suspense_receipt_module'];
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
                            <div class="row justify-content-end p-2">
                                <div class="col-lg-2 col-md-3 col-12">
                                    <div class="form-group pb-2">
                                        <div class="form-label-group in-border">
                                        <input type="date" name="from_date" class="form-control shadow-none" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>" onchange="Javascript:table_listing_records_filter();checkDateCheck();" placeholder="">
                                        <label>From Date</label>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-2 col-md-3 col-12">
                                    <div class="form-group pb-2">
                                        <div class="form-label-group in-border">
                                        <input type="date" name="to_date" class="form-control shadow-none" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" onchange="Javascript:table_listing_records_filter();checkDateCheck();" placeholder="" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                        <label>To Date</label>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-3 col-md-3 col-12 party_display">
                                    <div class="form-group pb-2">
                                        <div class="form-label-group in-border">
                                            <select name="filter_party_id" class="select2 select2-danger smallfnt" data-dropdown-css-class="select2-danger" onchange="Javascript:table_listing_records_filter();">
                                                <option value="">Select</option>
                                                <?php
                                                if(!empty($party_list)) {
                                                    foreach($party_list as $data) { ?>
                                                        <option value="<?php if(!empty($data['suspense_party_id'])) { echo $data['suspense_party_id']; } ?>"> <?php
                                                            if(!empty($data['name_mobile_city'])) {
                                                                $data['name_mobile_city'] = html_entity_decode($obj->encode_decode('decrypt', $data['name_mobile_city']));
                                                                echo $data['name_mobile_city'];
                                                            } ?>
                                                        </option> <?php
                                                    }
                                                } ?>
                                            </select>
                                            <label>Party</label>
                                        </div>
                                    </div>        
                                </div>
                                <div class="col-lg-3 col-md-4 col-6 mb-3">
                                    <div class="input-group">
                                    <input type="text" name="search_text" class="form-control" style="height:34px;" placeholder="Search By Bill No" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();">
                                    <span class="input-group-text" style="height:34px;" id="basic-addon2" onclick="Javascript:table_listing_records_filter();"><i class="bi bi-search"></i></span>
                                    </div>
                                </div>
                                
                            </div>
                            <input type="hidden" name='show_bill' value="0" id='show_bill'>
                            <?php if($cancelled_count > 0) { ?>
                                <div class="row mx-0 justify-content-end p-2">
                                    <div class="col-sm-4 col-lg-2 text-end">
                                        <button class="btn btn-dark poppins" id='show_button' style="font-size:11px;" type="button" onclick="Javascript:assign_bill_value();">Show Inactive Bill</button>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-sm-6 col-xl-8">
                                <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                            </div>	
                        </form>
                        <div id="table_listing_records" class="table-responsive poppins"></div>
				    </div>
                </div>
            </div>
        </div>
    </div>      
    <!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#suspense").addClass("active");
        $("#suspense_receipt").addClass("active");
        table_listing_records_filter();
    });
</script>