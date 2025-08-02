<?php 
	$page_title = "Bank";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['bank_module'];
            include("permission_check.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
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
                                <h5 class="text-white">Bank Details</h5>
                            </div>
                            <?php
                                $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_module = $GLOBALS['bank_module'];
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
                            <div class="row justify-content-end mt-3 mr-1">
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="form-group">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="text" id="search_text" name="search_text" class="form-control shadow-none" placeholder="Search By Bank Name"  onKeyUp="Javascript:table_listing_records_filter();" required>
                                            <label>Search By Bank Name</label>
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
        $("#creation").addClass("active");
        $("#bank").addClass("active");
        table_listing_records_filter();
    });
</script>