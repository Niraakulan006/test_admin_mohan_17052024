<?php 
	$page_title = "Luggagesheet";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    
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

    $consignor_list = array();
    $consignor_list = $obj->getTableRecords($GLOBALS['consignor_table'],'','');
    $branch_list = array();
    $branch_list = $obj->getTableRecords($GLOBALS['branch_table'],'','');
    $login_staff_id = ""; $access_error ="";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['staff_user_type']) {
            $permission_module = $GLOBALS['lr_module'];
            include("user_permission_check.php");
            include("permission_check.php");
	
        }
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['godown_staff_user_type']) {
           $login_staff_id =  $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
        }
    }
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

            <div class="border card-box d-none add_update_form_content" id="add_update_form_content" >
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-8">
                                <h5 class="text-white">Edit Luggage Sheet</h5>
                            </div>
                            <div class="col-lg-4 col-4">
                                <button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="window.open('luggagesheet.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border card-box bg-white" id="table_records_cover">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-8">
                                    <h5 class="text-white">Luggage Details</h5>
                                </div>
                                <?php  $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_module = $GLOBALS['luggagesheet_module'];
                                    $permission_action = $add_action;
                                    include('user_permission_action.php');

                                }
                                if(empty($access_error)) { ?>
                                    <div class="col-lg-4 col-4">
                                        <button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    
                        <div class="table-responsive poppins smallfnt">
                        <form name="table_listing_form" method="post">
                            <div class="row px-2 mt-3">
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="date" id="from_dateame" name="from_date" class="form-control shadow-none" value="<?php if(!empty($from_date)){ echo $from_date; }?>" placeholder="" onChange="Javascript:table_listing_records_filter();" required>
                                            <label>From Date</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="date" id="to_date" name="to_date" class="form-control shadow-none" placeholder="" value="<?php if(!empty($to_date)){ echo $to_date; }?>" onChange="Javascript:table_listing_records_filter();" required>
                                            <label>To Date</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select class="form-control" name="consignor_id" onChange="Javascript:table_listing_records_filter();">
                                                <option value="">Select consignor</option>
                                                <?php if(!empty($consignor_list)) {
                                                    foreach($consignor_list as $data) { ?>
                                                        <option value="<?php if(!empty($data['consignor_id'])) { echo $data['consignor_id']; } ?>" <?php if(!empty($consignor_id)){ if($data['consignor_id'] == $consignor_id){ echo "selected"; } } ?>>
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
                                        </div> 
                                    </div>
                                </div> -->
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select class="form-control" name="branch_id" onChange="Javascript:table_listing_records_filter();">
                                                <option value="">Select branch</option>
                                                <?php if(!empty($branch_list)) {
                                                    foreach($branch_list as $data) { ?>
                                                        <option value="<?php if(!empty($data['branch_id'])) { echo $data['branch_id']; } ?>" <?php if(!empty($branch_id)){ if($data['branch_id'] == $branch_id){ echo "selected"; } } ?>>
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
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-6">
                                    <div class="form-group">
                                        <div class="form-label-group in-border">
                                            <input type="text" id="search_text" name="search_text" class="form-control shadow-none" placeholder="" onKeyUp="Javascript:table_listing_records_filter();" required>
                                            <label>Search Luggage number</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        $("#luggagesheet").addClass("active");
        table_listing_records_filter();
    });
</script>