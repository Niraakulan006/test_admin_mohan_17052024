<?php 
	$page_title = "Account Party";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['account_party_module'];
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
    <script type="text/javascript" src="include/js/common.js"></script>
    <script type="text/javascript" src="include/js/updation.js"></script>
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
                                <h5 class="text-white">Account Party Details</h5>
                            </div>
                            <div class="col-lg-4 col-4">
                                <?php  
                                    $access_error = "";
                                    if(!empty($login_staff_id)) {
                                        $permission_module = $GLOBALS['account_party_module'];
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
                            <div class="row mx-0 justify-content-end mt-2">
                                <div class="col-lg-5 col-md-4 col-6 text-right">
                                    <div class="d-flex float-right">
                                        <div class="form-group">
                                            <div class="form-label-group in-border pb-2">
                                                <input type="text" id="search_text" name="search_text" class="form-control shadow-none" placeholder="Search By Party" onKeyUp="Javascript:table_listing_records_filter();" required>
                                                <label>Search By Party</label>
                                            </div>
                                        </div>
                                        <div class="pl-2">
                                            <button class="btn btn-success float-right py-2" style="font-size:11px;" type="button" onClick="window.open('account_party_download.php','_self');"> <i class="fa fa-cloud-download" ></i> Excel Download </button>
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
        $("#accountparty").addClass("active");
        table_listing_records_filter();
    });

    function ExcelDownload() {
        var search_text = ""; var url = "";
        search_text = jQuery('input[name="search_text"]').val();
        url = "account_party_download.php?search_text="+search_text;
        window.open(url,'_blank');
    }
</script>