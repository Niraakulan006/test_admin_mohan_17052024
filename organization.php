<?php 
	$page_title = "Organization";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
        if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] != $GLOBALS['admin_user_type']) {
            header("Location:dashboard.php");
            exit;
        }
    }
	
    $company_list = array(); $company_count = 0;
    $company_list = $obj->getTableRecords($GLOBALS['organization_table'], '', '');
    if(!empty($company_list)) {
        $company_count = count($company_list);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
	<script type="text/javascript" src="include/js/common.js"></script>
	<script type="text/javascript" src="include/js/cities.js"></script>
	<script type="text/javascript" src="include/js/creation_modules.js"></script>
    <script type="text/javascript" src="include/js/payment.js"></script>

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
                                <h5 class="text-white">Organization Details</h5>
                            </div>
                            <div class="col-lg-4 col-4">
                                <?php if($company_count < $GLOBALS['max_company_count']) { ?>
                                    <button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="poppins smallfnt">
                       <form name="table_listing_form" method="post">
                            <div class="col-sm-6 col-xl-8">
                                <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                            </div>	
                        </form>
                        <div id="table_listing_records" class="table-responsive"></div>
				    </div>
                </div>
            </div>
        </div>
    </div>
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#admin").addClass("active");
        $("#organization").addClass("active");
        // table_listing_records_filter();
            ShowModalContent('Organization','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178');
    });
</script>