<?php 
	$page_title = "User";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
        $company_count = $obj->CompanyCount();
        if($company_count == '0' || $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] != $GLOBALS['admin_user_type']) {
            header("Location:organization.php");
            exit;
        }
    }

    $user_list = array(); $user_count = 0;
    $user_list = $obj->getTableRecords($GLOBALS['user_table'], '', '');
    if(!empty($user_list)) {
        $user_count = count($user_list);
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
                                <h5 class="text-white">User Details</h5>
                            </div>
                            <div class="col-lg-4 col-4">
                                <?php if($user_count < $GLOBALS['max_user_count']){ ?>
                                     <button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="poppins smallfnt">
                       <form name="table_listing_form" method="post">
                            <div class="row mx-0">
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
    $(document).ready(function() {
        $("#admin").addClass("active");
        $("#user").addClass("active");
        table_listing_records_filter();

        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        const passBtn = $("#passwordBtn");

        passBtn.click(togglePassword);

        function togglePassword() {
            const passInput = $("#password");
            if (passInput.attr("type") === "password") {
                passInput.attr("type", "text");
            } 
            else {
                passInput.attr("type", "password");
            }
        }
    });
</script>