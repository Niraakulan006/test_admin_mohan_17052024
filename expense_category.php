<?php 
	$page_title = "expense_category";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['expense_category_module'];
            include("permission_check.php");
        }
    }

    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date("Y-m-d"); 
    $current_date = date("Y-m-d");

    $party_list = array();
    $party_list = $obj->getPartyList('Purchase');

    $cancelled_bill = array(); $cancelled_count = 0;
    $cancelled_bill = $obj->getAllRecords($GLOBALS['expense_category_table'], 'deleted', 1);
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
                                <h5 class="text-white">Expense Category Details</h5>
                            </div>
                            <?php
                                $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_module = $GLOBALS['expense_category_module'];
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
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="input-group">
                                        <input type="text" name="search_text" class="form-control" style="height:34px;" placeholder="Search By Name" aria-label="Search" aria-describedby="basic-addon2" onkeyup="Javascript:table_listing_records_filter();">
                                        <span class="input-group-text" style="height:34px;" id="basic-addon2"><i class="bi bi-search"></i></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6 col-xl-8">
                                    <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                    <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                    <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                </div>	
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
        $("#expenses").addClass("active");
        $("#expense_category").addClass("active");
        table_listing_records_filter();
    });
</script>