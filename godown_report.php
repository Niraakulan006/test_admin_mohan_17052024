<?php 
	$page_title = "Godown Report";
	include("include_files.php");

    $organization_id = ""; $from_date =""; $to_date ="";$filter_godown_id =""; 

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
    
    if(!empty($from_date) && !empty($to_date)) {
        $current_date = date("Y-m-d");
        //echo "from_date - ".$from_date.", to_date - ".$to_date.", current_date - ".$current_date."<br>";
        if( (strtotime($current_date) >= strtotime($from_date)) && (strtotime($current_date) <= strtotime($to_date)) ) {
            $to_date = $current_date; 
        }
        else {
            $current_month = date("m");
            if($current_month == "01" || $current_month == "02" || $current_month == "03") {
                $to_date = date("Y", strtotime($to_date))."-".date("m-d");
            }
            else {
                $to_date = date("Y", strtotime($from_date))."-".date("m-d");
            }
        }
        if(!empty($to_date)) {
            $from_date = date("Y-m-d", strtotime("-10 days", strtotime($to_date)));
        }
    }

    $godown_list = array();
    $godown_list = $obj->getTableRecords($GLOBALS['godown_table'],'','');
    
    if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['godown_staff_user_type']) {
       $filter_godown_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_godown'];
    }else{
        if(isset($_POST['filter_godown_id']))
        {
            $filter_godown_id = $_POST['filter_godown_id'];
        }
    }
    
    if(isset($_POST['from_date']))
    {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date']))
    {
        $to_date = $_POST['to_date'];
    }
    
    
    
    $branch_id ="";
    if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['branch_staff_user_type']) {
        $branch_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_branch_id'];
    }
    
    $total_records_list = array();
    $total_records_list = $obj->getGodownReport($filter_godown_id,$from_date,$to_date,$branch_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/common.js"></script>
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
                                <h5 class="text-white">Godown Report</h5>
                            </div>
                            <?php
                                $access_error = "";
                                if(!empty($login_staff_id)) {
                                    $permission_module = $GLOBALS['branch_staff_module'];
                                    $permission_action = $add_action;
                                    include('user_permission_action.php');

                                }
                                if(empty($access_error)) { ?>
                                    <!-- <div class="col-lg-4 col-4">
                                        <button class="btn btn-danger float-right" style="font-size:11px;" type="button" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '');"> <i class="fa fa-plus-circle"></i> Add </button>
                                    </div> -->
                            <?php } ?>
                        </div>
                    </div>
                    <!-- <div class="row justify-content-end mt-3 mr-1">
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="form-group">
                                <div class="form-label-group in-border">
                                    <input type="text" id="search_text" name="search_text" class="form-control shadow-none" placeholder="Search By Branch Staff" required onKeyUp="Javascript:table_listing_records_filter();">
                                    <label>Search By Branch Staff</label>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="table-responsive poppins smallfnt">
                       <form name="report_form" method="post">
                            <div class="col-sm-6 col-xl-8">
                                <input type="hidden" name="page_number" value="<?php if(!empty($page_number)) { echo $page_number; } ?>">
                                <input type="hidden" name="page_limit" value="<?php if(!empty($page_limit)) { echo $page_limit; } ?>">
                                <input type="hidden" name="page_title" value="<?php if(!empty($page_title)) { echo $page_title; } ?>">
                            </div>
                            <div class="row px-2 mt-3">
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="date" id="from_date" name="from_date" class="form-control shadow-none" placeholder="From Date" value="<?php if(!empty($from_date)){ echo $from_date; }?>" onChange="Javascript:getReport();" required>
                                            <label>From Date</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <input type="date" id="to_date" name="to_date"  class="form-control shadow-none" placeholder="" value="<?php if(!empty($to_date)){ echo $to_date; }?>" onChange="Javascript:getReport();" required>
                                            <label>To Date</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="form-group mb-1">
                                        <div class="form-label-group in-border pb-2">
                                            <select name="filter_godown_id" class="form-control" onChange="Javascript:getReport();" >
                                                <option value="">Select Godown</option>
                                                <?php
                                                    if(!empty($godown_list)) {
                                                        foreach($godown_list as $data) {
                                                ?>
                                                            <option value="<?php if(!empty($data['godown_id'])) { echo $data['godown_id']; } ?>"<?php if(!empty($filter_godown_id)){ if($data['godown_id'] == $filter_godown_id ){ echo "selected"; } } ?>>
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
                                <div class="col-sm-3 col-lg-2 form-group">
                                    <button type="button" class="btn btn-success" type="button" onClick="open_order_report('<?php echo $from_date; ?>','<?php echo $to_date; ?>','<?php echo $filter_godown_id; ?>')"> <i class="fa fa-download"></i> Print </button>
                                    
                                </div>
                                <!-- <div class="col-sm-3 form-group">
                                    <button type="button" class="btn btn-success" type="button" onClick="DownloadProductExcel('tbl_sales_list', 'LR_report')"> <i class="fa fa-download"></i> Export </button>
                                    
                                </div> -->
                            </div>
                            <div class="table nowrap">
                                <div class="w-100 px-3 py-3">
                                    <div id="report_area" class="w-100">
                                        <table class="table nowrap" id="tbl_sales_list" style="border:1px solid black">
                                            <thead>
                                                <tr>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">S.No</th>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Godown</th>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Date</th>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">LR Number</th>
                                                    <th class="text-center px-2 py-2" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Bill Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $index = 0;
                                                    if(!empty($total_records_list)) {
                                                        $edit_action = $obj->encode_decode('encrypt', 'edit_action');
                                                        $product_count = 0; $quantity = ""; $grand_amount = 0; $grand_tax = 0; $grand_quantity = 0;
                                                        foreach($total_records_list as $key => $data) {
                                                            $index = $key + 1;
                                                            
                                                            if(!empty($data['product_id'])) {
                                                                $product_ids = explode(",", $data['product_id']);
                                                                $product_count = count($product_ids);
                                                            }
                                                            
                                                            $quantity = "";
                                                            
                                                            $quantity = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_number', $data['lr_number'], 'quantity');
                                                            

                                                            $quantity_value = 0;
                                                            if($quantity!=''){
                                                                $quantity_ids = explode(",", $quantity);
                                                                $quantity_value = array_sum($quantity_ids);
                                                            }
                                                            

                                                            if(!empty($prefix)) { $index = $index + $prefix; } ?>
                                                            
                                                                <tr>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2"><?php echo $index; ?></td>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                        <?php 
                                                                            if(!empty($data['godown_id'])) { 
                                                                                $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$data['godown_id'],'name');
                                                                                echo $obj->encode_decode('decrypt',$godown_name);
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                        <?php 
                                                                            echo date('d-m-Y',strtotime($data['lr_date']));
                                                                        ?>
                                                                    </td>

                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-center px-2 py-2">
                                                                        <?php
                                                                            
                                                                            if(!empty($data['lr_number'])) {
                                                                                echo $data['lr_number'];
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-right px-2 py-2">
                                                                        <?php 
                                                                            if($data['total']!='') { 
                                                                                echo number_format($data['total'], 2); 
                                                                                $grand_amount+=$data['total']; 
                                                                            } 
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                        } ?>
                                                        <tr>
                                                            <th class="text-right px-2 py-2" colspan="4" style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;">Total</th>
                                                            <td style="border-left: 1px solid #000; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: right; padding: 2px 10px; font-size: 13px; vertical-align: middle; height: 30px;" class="text-right px-2 py-2">
                                                                <?php echo number_format($grand_amount,2); ?>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                    else { ?>
                                                        <tr>
                                                            <td colspan="6" class="text-center">Sorry! No records found</td>
                                                        </tr>
                                                <?php } ?>
                                                <?php if($index == 1){ ?>
                                                    <tr style="height:40px;"></tr>
                                                <?php } ?>
                                            </tbody> 			
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
				    </div>
                </div>
            </div>
        </div>
    </div>
<!--Right Content End-->
<button type="button" data-toggle="modal" data-target="#deletemodal" class="d-none delete_modal_button"></button>
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Delete</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success no" data-dismiss="modal" onClick="Javascript:cancel_delete_modal(this);">Cancel</button>
                <button type="button" class="btn btn-danger yes" onClick="Javascript:confirm_delete_modal(this);">Delete</button>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#report").addClass("active");
        $("#godown_report").addClass("active");
        table_listing_records_filter();
    });
</script>
<script type="text/javascript">
    function getReport() {
        if(jQuery('form[name="report_form"]').length > 0) {
            jQuery('form[name="report_form"]').submit();
        }
    }

    function getProductOverallStock(product_id) {
        if(product_id != "") {
            if(jQuery('select[name="product_id"]').length > 0) {
                jQuery('select[name="product_id"]').val(product_id).trigger('change');
            }
            if(jQuery('form[name="report_form"]').length > 0) {
                jQuery('form[name="report_form"]').submit();
            }
        }
    }

    jQuery(document).ready(function(){
        <?php if(!empty($overall_stock_list) || !empty($stock_report)) { ?>
            prepare_report_preview();
        <?php } ?>
    });
</script>
<script>
        function DownloadProductExcel(table, name) {
            var uri = 'data:application/vnd.ms-excel;base64,'
                    ,
                    template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; 
					charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
                    , base64 = function (s) {
                        return window.btoa(unescape(encodeURIComponent(s)))
                    }
                    , format = function (s, c) {
                        return s.replace(/{(\w+)}/g, function (m, p) {
                            return c[p];
                        })
                    }
                if (!table.nodeType) table = document.getElementById(table)
                var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
                var a = document.createElement('a');
                a.href = uri + base64(format(template, ctx))
                a.download = name+'.xls';
                //triggering the function
                a.click();
        }
    </script>
    <script>
        function open_order_report(from_date,to_date,godown_id){
            var url = "reports/rpt_godown_report.php?from_date="+ from_date +"&to_date="+ to_date +"&godown_id="+ godown_id ;

            
            window.open(url,'_blank');
        }
    </script>