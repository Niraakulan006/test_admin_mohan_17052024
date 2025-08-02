<?php 
	$page_title = "Product";
	include("include_user_check_and_files.php");
	$login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['product_module'];
            include("permission_check.php");
        }
    }
    
    $product_list = array();
	$product_list = $obj->getTableRecords($GLOBALS['product_table'], '', '','');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
    <script type="text/javascript" src="include/js/common.js"></script>
    <script type="text/javascript" src="include/js/product_upload.js"></script>
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
                                <h5 class="text-white">Purchase Product Details</h5>
                            </div>
                            <?php
                                $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_module = $GLOBALS['product_module'];
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
                        
                         <div class="col-lg-12 col-12 float-right text-right">
                            <?php if(count($product_list) > 0) { ?>
                            <button class="btn btn-success m-1" style="font-size:11px;" type="button" id="download_products" onClick="window.open('product_download.php','_self');"> <i class="fa fa-download"></i> Download </button>
                            <?php } ?>
                            <?php
                                $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_action = $add_action;
                                    include('permission_action.php');
                                }
                                if(empty($access_error)) {
                                    ?>
                                    <button class="btn btn-primary m-1" style="font-size:11px;" type="button" id="product_upload_excel" onClick="Javascript:ProductUploadCheck();"> <i class="fa fa-upload"></i> Upload </button>
                            <?php } ?>
                            <button class="btn btn-dark m-1" style="font-size:11px;" type="button" id="download_template" onClick="window.open('product_template.php','_self');"> <i class="fa fa-file"></i> Template </button>
                            <input type="file" name="product_excel_upload" id="product_excel_upload" style="display: none;" accept=".xls,.xlsx" onChange="Javascript:getExcelData(this);">	
                        </div>
                        <div class="row add_update_excel_form_content_excel px-0 mx-auto"></div>
                        <div id="excel_div">
                            <form name="table_listing_form" method="post">
                                <div class="row justify-content-end mt-3 mr-1">
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="form-group">
                                            <div class="form-label-group in-border pb-2">
                                                <input type="text" id="search_text" name="search_text" class="form-control shadow-none" placeholder="Search By Product Name"  onKeyUp="Javascript:table_listing_records_filter();" required>
                                                <label>Search By Purchase Product Name</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-8">
                                    <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                    <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                    <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                                    <input type="hidden" name="upload_type" value="">
                                </div>
                            </form>
                        </div>
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
        $("#product").addClass("active");
        table_listing_records_filter();
    });
</script>