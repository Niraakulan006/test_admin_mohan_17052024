<?php 
	$page_title = "Purchase Report";
	include("include_user_check_and_files.php");
	$page_number = $GLOBALS['page_number']; $page_limit = $GLOBALS['page_limit'];

    $login_staff_id = "";
    if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
            $login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
            $permission_module = $GLOBALS['reports_module'];
            include("permission_check.php");
        }
    }

    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d');$current_date = date('Y-m-d');$bill = "";

    $total_records_list = $obj->getTableRecords($GLOBALS['purchase_entry_table'], '', '', '');
    $party_list = $obj->getTableRecords($GLOBALS['party_table'], 'party_type', '1', '');
    $bill_no_list = $obj->getTableRecords($GLOBALS['purchase_entry_table'], '', '', '');
    
    $cancel_bill_btn = "";
    $party_id = ""; $bill_no = "";
    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }
    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }
    if(isset($_POST['party_id'])) {
        $party_id = $_POST['party_id'];
    }
    if(isset($_POST['bill_no'])) {
        $bill_no = $_POST['bill_no'];
    }
    $cancel_bill_btn = "";
    if(isset($_POST['cancel_bill_btn'])){
        $cancel_bill_btn = $_REQUEST['cancel_bill_btn'];
    }
    
    $total_records_list = array();
    $total_records_list = $obj->getPurchaseReportList($from_date, $to_date,$bill_no, $party_id,$cancel_bill_btn);
    
    $excel_name = "";
    if(!empty($from_date) && !empty($to_date)){
    $excel_name = "Purchase Report( ".date('d-m-Y',strtotime($from_date ))." to ".date('d-m-Y',strtotime($to_date )).")";
    }else{
        $excel_name = "Purchase Report";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
</head>	
<body>
<?php include "header.php"; ?>
<!--Right Content-->
    <div class="pcoded-content">
        <div class="page-header card">
            <div class="mt-1">
                <div class="border card-box d-none add_update_form_content" id="add_update_form_content" ></div>
                <div class="border card-box bg-white" id="table_records_cover">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-8">
                                <h5 class="text-white">Purchase Report</h5>
                            </div>
                        </div>
                    </div>
                    <form name="purchase_report_form" method="post">
                        <div class="row pt-2">   
                            <div class="col-lg-2 col-md-3 col-6 d-none">
                                <div class="form-group mb-2">
                                    <div class="form-label-group in-border mb-0">
                                        <select class="select2 select2-danger" name="bill_no" onchange="Javascript:getOverallReport();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option value="">Select</option>    
                                                <?php 
                                                if(!empty($bill_no_list)) {
                                                    foreach($bill_no_list as $bill) {  ?>
                                                        <option value="<?php echo $bill['purchase_entry_number']; ?>" <?php if(!empty($bill_no) && $bill_no == $bill['purchase_entry_number']) { echo 'selected'; } ?> ><?php echo $bill['purchase_entry_number']; ?></option>          
                                                        <?php 
                                                    } 
                                                } ?>
                                        </select>
                                        <label>Bill No</label>
                                    </div>
                                </div> 
                            </div> 
                            <div class="col-lg-2 col-md-3 col-6">
                                <div class="form-group mb-2">
                                    <div class="form-label-group in-border mb-0">
                                        <select class="select2 select2-danger" name="party_id" onchange="Javascript:getOverallReport();" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option value="">Select</option>    
                                                <?php if(!empty($party_list)) {
                                                    foreach($party_list as $party) { ?>
                                                        <option value="<?php echo $party['party_id']; ?>" <?php if(!empty($party_id) && $party_id == $party['party_id']) { echo 'selected'; } ?> ><?php echo $obj->encode_decode('decrypt', $party['name_mobile_city']); ?></option>
                                                <?php } 
                                                } ?>
                                        </select>
                                        <label>Party</label>
                                    </div>
                                </div> 
                            </div> 
                                <div class="col-lg-2 col-md-3 col-12">
                                    <div class="form-group pb-1">
                                        <div class="form-label-group in-border pb-1">
                                        <input type="date" class="form-control shadow-none" placeholder="" required="" name="from_date" onchange="Javascript:getOverallReport();checkDateCheck();"  value="<?php if(!empty($from_date)) { echo $from_date; } ?>"  max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                            <label>From Date</label>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-2 col-md-3 col-12">
                                    <div class="form-group pb-1">
                                        <div class="form-label-group in-border pb-1">
                                            <input type="date" class="form-control shadow-none" placeholder="" required="" name="to_date" onchange="Javascript:getOverallReport();checkDateCheck();" value="<?php if(!empty($to_date)) { echo $to_date; } ?>" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                            <label>To Date</label>
                                        </div>
                                    </div> 
                                </div>
                               <div class="col-lg-3 col-md-2 col-12">
                                    <div class="form-group mb-1">
                                        <div class="form-check form-switch d-flex align-items-center">
                                            <input class="form-check-input me-2" type="checkbox" name="cancel_bill_btn"
                                                <?php if($cancel_bill_btn == "1"){ echo "checked"; } ?>
                                                id="FormSelectDefault" value="<?php if($cancel_bill_btn == "1"){ echo "1"; }else{ echo "0"; } ?>"
                                                onChange='Javascript:show_cancelled_bill(this.checked);'>

                                            <label for="FormSelectDefault" class="form-check-label text-muted smallfnt mb-0">
                                                Show Cancelled Bill Also
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            <div class="row  justify-content-end">   
                                <div class="col-lg-3 col-6 text-end">
                                    <button class="btn btn-primary m-1" style="font-size:11px;" type="button" onClick="window.open('reports/rpt_purchase_report_a4.php?party_id=<?php if(!empty($party_id)) { echo $party_id; } ?>&from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>&bill_no=<?php if(!empty($bill_no)) { echo $bill_no; }?>&cancel_bill_btn=<?php echo $cancel_bill_btn; ?>')"> <i class="fa fa-print"></i> Print </button>
                                    <button class="btn btn-primary m-1" style="font-size:11px;" type="button" onClick="window.open('reports/rpt_purchase_report_a4.php?party_id=<?php if(!empty($party_id)) { echo $party_id; } ?>&from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>&bill_no=<?php if(!empty($bill_no)) { echo $bill_no; }?>&cancel_bill_btn=<?php echo $cancel_bill_btn; ?>&from=D')"> <i class="fa fa-download"></i> PDF </button>
                                    <button class="btn btn-danger m-1" style="font-size:11px;" type="button" onclick="ExportToExcel();"> <i class="fa fa-download"></i> Export </button>  
                                    </div> 
                                       
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered nowrap cursor text-center smallfnt" id="tbl_purchase_list">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Purchase Bill Number</th>
                                                <th>Date</th>
                                                <th>Party Name</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $grand_amount =0;
                                            if(!empty($total_records_list)) {
                                                foreach($total_records_list as $key => $list) { 
                                                    $index = $key + 1; 
                                                    $total_amount = 0;
                                                    $total_amount += (float) $list['total_amount'];?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $index; ?>
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($list['purchase_entry_number'])) {
                                                                echo $list['purchase_entry_number'];
                                                            } 
                                                            if (!empty($list['cancelled'])) {
                                                                ?>
                                                                <br><span style="color: red;">Cancelled</span>
                                                                <?php
                                                            }
                                                        ?>
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($list['purchase_entry_date'])) {
                                                                echo date('d-m-Y', strtotime($list['purchase_entry_date']));
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($list['party_name_mobile_city'])) {
                                                                echo $obj->encode_decode('decrypt', $list['party_name_mobile_city']);
                                                            } ?>
                                                        </td>
                                                        <td class="text-end">
                                                            <?php if(!empty($total_amount)) {
                                                                
                                                                echo number_format($total_amount, 2);
                                                            }
                                                            if($list['cancelled'] == '0'){ 
                                                                $grand_amount+=$total_amount; 
                                                            } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th class="text-right" colspan="4" style="text-align: right;" >Total</th>
                                                    <th class="mr-5" style="text-align: center;margin: 30px 40px;"><?php echo $obj->numberFormat($grand_amount,2); ?></th>
                                                    </tr>
                                                <tr>
                                            <?php } else {
                                                ?>
                                                
                                                    <td colspan="5" class="text-center">Sorry! No records found</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    
                                    </table> 
                                </div>
                            </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>          
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    jQuery(document).ready(function(){
        $("#report").addClass("active");
        $("#purchase_report").addClass("active");
        
    });
    
    function getOverallReport(){
        if(jQuery('form[name="purchase_report_form"]').length > 0){
            jQuery('form[name="purchase_report_form"]').submit();
        }
    }
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_purchase_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        window.open("purchase_report.php","_self");
    }

    function show_cancelled_bill(chk_value){
       if(chk_value == true) {
           $("input[name='cancel_bill_btn']").val("1");
       } else {
           $("input[name='cancel_bill_btn']").val("0");
       }
       getOverallReport();
   }           
  
</script>
<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
<script type="text/javascript" src="include/js/bootstrap-datepicker.min.js"></script>