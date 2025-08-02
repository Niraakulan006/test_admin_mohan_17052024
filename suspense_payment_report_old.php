<?php 
	$page_title = "Suspense Payment Report";
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
    
    $from_date = date('Y-m-d', strtotime('-30 days')); $to_date = date('Y-m-d'); $current_date = date('Y-m-d');
    $party_list = array(); $party_count = 0;
    $payment_mode_list = array(); 
    $payment_mode_list = $obj->getTableRecords($GLOBALS['payment_mode_table'], '', '', '');

    $bank_list = array(); 
    $bank_list = $obj->getTableRecords($GLOBALS['bank_table'], '','', '');

    $filter_suspense_party_id =""; $fiter_bill_type ="";
    if(isset($_POST['filter_suspense_party_id'])) {
        $filter_suspense_party_id = $_POST['filter_suspense_party_id'];
    }

    $filter_bill_type="";
    if(isset($_POST['filter_bill_type'])) {
        $filter_bill_type = $_POST['filter_bill_type'];
    }

    if(isset($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    }

    if(isset($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    }

    $filter_payment_mode_id="";
    if(isset($_POST['filter_payment_mode_id'])) {
        $filter_payment_mode_id = $_POST['filter_payment_mode_id'];
    }

    $filter_bank_id="";
    if(isset($_POST['filter_bank_id'])) {
        $filter_bank_id = $_POST['filter_bank_id'];
    }

    $filter_category_id="";
    if(isset($_POST['filter_category_id'])) {
        $filter_category_id = $_POST['filter_category_id'];
    }

    $party_list = array();
     $party_list = $obj->getTableRecords($GLOBALS['suspense_party_table'],'','','');

    $category_list = array();
    $category_list = $obj->getTableRecords($GLOBALS['expense_category_table'],'','','');

    $payment_list =array();
    $payment_list = $obj->getSuspensePaymentReportList($from_date,$to_date,$filter_bill_type,$filter_suspense_party_id,$filter_payment_mode_id,$filter_bank_id);

    $excel_name = "Suspense Payment Report";
    if(!empty($from_date) && !empty($to_date)) {
        $excel_name = "Suspense Payment Report(" . date('d-m-Y', strtotime($from_date )) . " to " . date('d-m-Y', strtotime($to_date )) . ")";
    }

    $company_list = array();
    $company_list =$obj ->getTableRecords($GLOBALS['organization_table'],'id','1','');

    $company_name = ""; $city =""; $state = ""; $mobile_number = ""; $gst_number = "";
    
    if(!empty($company_list)){
        foreach($company_list as $data){
            if(!empty($data['name']) && $data['name'] != 'NULL'){
                $company_name = html_entity_decode($data['name']);
            }
            if(!empty($data['address_line1']) && $data['address_line1'] != 'NULL'){
                $address = $data['address_line1'];
            }
            if(!empty($data['city']) && $data['city'] != 'NULL'){
                $city = $data['city'];
            }
            if(!empty($data['state']) && $data['state'] != 'NULL'){
                $state = $data['state'];
            }
            if(!empty($data['mobile_number']) && $data['mobile_number'] != 'NULL'){
                $mobile_number = $data['mobile_number'];
            }
            if(!empty($data['gst_number']) && $data['gst_number'] != 'NULL'){
                $gst_number = $data['gst_number'];
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<?php 
	include "link_style_script.php"; ?>
    <script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
</head>	
<body>
<?php include "header.php"; ?>
<!--Right Content-->
    <div class="pcoded-content">
        <div class="page-header card">
            <!-- <div class="mt-5"> -->
                <div class="border card-box bg-white" id="table_records_cover">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-8">
                                <h5 class="text-white">Suspense Payment Report</h5>
                            </div>
                        </div>
                    </div>
                    <form name="payment_report_form" method="POST">
                        <div class="row  px-2 my-3">
                            <div class="col-lg-2 col-md-4 col-6">
                                <div class="form-group mb-2">
                                    <div class="form-label-group in-border">
                                        <input type="date" id="from_date" name="from_date" value="<?php if(!empty($from_date)) { echo $from_date; } ?>" onchange="Javascript:getOverallReport();checkDateCheck();"class="form-control shadow-none" placeholder="" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                        <label>From Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <div class="form-group mb-2">
                                    <div class="form-label-group in-border">
                                        <input type="date" id="to_date" name="to_date"  value="<?php if(!empty($to_date)) { echo $to_date; } ?>" onchange="Javascript:getOverallReport();checkDateCheck()" class="form-control shadow-none" placeholder="" max="<?php if(!empty($current_date)) { echo $current_date; } ?>">
                                        <label>To Date</label>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-lg-2 col-md-4 col-12">
                                <div class="form-group">
                                    <div class="form-label-group in-border mb-0">
                                        <select class="select2 select2-danger" name="filter_bill_type" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="Javascript:getBillType(this.value);">
                                            <option value="">Select</option>
                                            <option value="1" <?php if(!empty($filter_bill_type)){ if($filter_bill_type == '1'){ echo "selected"; } } ?>>Suspense Voucher</option>
                                            <option value="2" <?php if(!empty($filter_bill_type)){ if($filter_bill_type == '2'){ echo "selected"; } } ?>>Suspense Receipt</option>
                                        </select>
                                        <label>Bill Type</label>
                                    </div>
                                </div>        
                            </div>
                            <div class="col-lg-2 col-md-4 col-12">
                                <div class="form-group">
                                    <div class="form-label-group in-border mb-0" id="party_list">
                                        <select class="select2 select2-danger" name="filter_suspense_party_id" data-dropdown-css-class="select2-danger"  style="width: 100%;" onchange="Javascript:getOverallReport();">
                                            <option value="">Select</option> <?php
                                            if(!empty($party_list)) {
                                                foreach($party_list as $data) { 
                                                    if(!empty($data['suspense_party_id']) && $data['suspense_party_id'] != "NULL") {
                                                    ?>
                                                        <option value="<?php if(!empty($data['suspense_party_id'])) { echo $data['suspense_party_id']; } ?>"<?php if(!empty($filter_suspense_party_id)){ if($filter_suspense_party_id == $data['suspense_party_id']){ echo "selected"; } } ?>> <?php
                                                            if(!empty($data['suspense_party_name']) && $data['suspense_party_name'] != "NULL") {
                                                                $data['suspense_party_name'] = $obj->encode_decode('decrypt', $data['suspense_party_name']);
                                                                echo html_entity_decode($data['suspense_party_name']);
                                                                if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                                                    $data['mobile_number'] = $obj->encode_decode('decrypt', $data['mobile_number']);
                                                                    echo " - (".$data['mobile_number'].')';
                                                                }
                                                            } ?>
                                                        </option>
                                                    <?php
                                                    }
                                                }
                                            } ?>
                                        </select>
                                        <label>Party Name</label>
                                    </div>
                                </div>        
                            </div> 
                           
                            <div class="col-lg-2 col-md-4 col-12">
                                <div class="form-group">
                                    <div class="form-label-group in-border mb-0" id="payment_mode_list">
                                        <select class="select2 select2-danger" name="filter_payment_mode_id" data-dropdown-css-class="select2-danger"  style="width: 100%;" onchange="Javascript:getOverallReport();">
                                            <option value="">Select</option> <?php
                                            if(!empty($payment_mode_list)) {
                                                foreach($payment_mode_list as $data) { ?>
                                                    <option value="<?php if(!empty($data['payment_mode_id'])) { echo $data['payment_mode_id']; } ?>"<?php if(!empty($filter_payment_mode_id)){ if($filter_payment_mode_id == $data['payment_mode_id']){ echo "selected"; } } ?>> <?php
                                                        if(!empty($data['payment_mode_name'])) {
                                                            $data['payment_mode_name'] = html_entity_decode($obj->encode_decode('decrypt', $data['payment_mode_name']));
                                                            echo $data['payment_mode_name'];
                                                        } ?>
                                                    </option> <?php
                                                }
                                            } ?>
                                        </select>
                                        <label>Payment Mode</label>
                                    </div>
                                </div>        
                            </div>
                            <div class="col-lg-2 col-md-4 col-12">
                                <div class="form-group">
                                    <div class="form-label-group in-border mb-0" id="bank_list">
                                        <select class="select2 select2-danger" name="filter_bank_id" data-dropdown-css-class="select2-danger"  style="width: 100%;" onchange="Javascript:getOverallReport(this.value);">
                                            <option value="">Select</option> <?php
                                            if(!empty($bank_list)) {
                                                foreach($bank_list as $data) { ?>
                                                    <option value="<?php if(!empty($data['bank_id'])) { echo $data['bank_id']; } ?>"<?php if(!empty($filter_bank_id)){ if($filter_bank_id == $data['bank_id']){ echo "selected"; } } ?>> <?php
                                                        if(!empty($data['bank_name'])) {
                                                            $data['bank_name'] = $obj->encode_decode('decrypt', $data['bank_name']);
                                                            echo $data['bank_name'];
                                                        } 
                                                        echo " - ";
                                                        if(!empty($data['account_number'])) {
                                                            $data['account_number'] = $obj->encode_decode('decrypt', $data['account_number']);
                                                            echo $data['account_number'];
                                                        } ?>
                                                    </option> <?php
                                                }
                                            } ?>
                                        </select>
                                        <label>Bank Name</label>
                                    </div>
                                </div>        
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="ps-2 ">
                                    <a class="btn btn-primary m-1" style="font-size:11px;" href="reports/rpt_suspense_payment_report.php?filter_bill_type=<?php if(!empty($filter_bill_type)) { echo $filter_bill_type; } ?>&filter_payment_mode_id=<?php if(!empty($filter_payment_mode_id)) { echo $filter_payment_mode_id; } ?>&filter_bank_id=<?php if(!empty($filter_bank_id)) { echo $filter_bank_id; } ?>&filter_suspense_party_id=<?php if(!empty($filter_suspense_party_id)) { echo $filter_suspense_party_id; } ?>&from_date=<?php if(!empty($from_date)) { echo $from_date; } ?>&to_date=<?php if(!empty($to_date)) { echo $to_date; } ?>&filter_category_id=<?php if(!empty($filter_category_id)) { echo $filter_category_id; } ?>" target="_blank" > <i class="fa fa-print"></i> Print </a>

                                    <a class="btn btn-primary m-1" style="font-size:11px;" href="reports/rpt_suspense_payment_report.php?filter_bill_type=<?php if(!empty($filter_bill_type)) { echo $filter_bill_type; } ?>&filter_payment_mode_id=<?php if(!empty($filter_payment_mode_id)) { echo $filter_payment_mode_id; } ?>&filter_bank_id=<?php if(!empty($filter_bank_id)) { echo $filter_bank_id; } ?>&filter_suspense_party_id=<?php if(!empty($filter_suspense_party_id)) { echo $filter_suspense_party_id; } ?>&from_date=<?php if(!empty($from_date)) { echo $from_date; } ?>&to_date=<?php if(!empty($to_date)) { echo $to_date; } ?>&filter_category_id=<?php if(!empty($filter_category_id)) { echo $filter_category_id; } ?>&from=D" target="_blank" > <i class="fa fa-download"></i> PDF </a>

                                    <button class="btn btn-primary m-1" style="font-size:11px;" type="button" onclick="ExportToExcel();"> <i class="fa fa-download"></i> Excel</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card-body">
                        <div class="row px-3 pb-4 justify-content-center">    
                            <div class="col-lg-12">
                                <div class="table-responsive table-bordered">
                                    <table class="table table-bordered nowrap text-center" id="tbl_sales_list">
                                        <thead class="smallfnt ">
                                            <tr>
                                                <th colspan="8" class="text-center" style="border: 1px solid #dee2e6;font-weight: bold; font-size: 18px;">
                                                    Suspense Payment Report <?php if(!empty($from_date)){ echo " ( " .date('d-m-Y',strtotime($from_date )) ." to ". date('d-m-Y',strtotime($to_date )). " )"; }?>
                                                </th>
                                            </tr>
                                            <div>
                                                <tr class="d-none header">
                                                    <th colspan="3"></th>
                                                    <th colspan="6"><?php echo $obj->encode_decode('decrypt',$company_name); ?></th>
                                                </tr>
                                                <tr class="d-none header">
                                                    <th colspan="3"></th>
                                                    <th colspan="6"><?php echo $obj->encode_decode('decrypt',$address); ?></th>
                                                </tr>
                                                <tr class="d-none header">
                                                    <th colspan="3"></th>
                                                    <th colspan="6"><?php echo $obj->encode_decode('decrypt',$city); ?></th>
                                                </tr>
                                                <tr class="d-none header">
                                                    <th colspan="3"></th>
                                                    <th colspan="6"><?php echo $obj->encode_decode('decrypt',$state); ?></th>
                                                </tr>
                                                <tr class="d-none header">
                                                    <th colspan="3"></th>
                                                    <th colspan="6"><?php echo "Mobile No : ". $obj->encode_decode('decrypt',$mobile_number); ?></th>
                                                </tr>
                                                <tr class="d-none header">
                                                    <th colspan="3"></th>
                                                    <th colspan="6"><?php echo "GST No : ".$obj->encode_decode('decrypt',$gst_number); ?></th>
                                                </tr>
                                            </div>
                                            <tr class="bg-light">
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Bill No</th>
                                                <th>Payment Type</th>
                                                <th>Party Name</th>
                                                <th>Payment Mode</th>
                                                <th>Credit (Rs.)</th>
                                                <th>Debit (Rs.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $grand_amount = 0; $total_amount=0;

                                                if (!empty($payment_list)) {
                                                    $edit_action = $obj->encode_decode('encrypt', 'edit_action');
                                                    $index = 1;
                                                    $total_credit = 0;
                                                    $total_debit = 0;

                                                    foreach ($payment_list as $data) {

                                                        if($data['bill_type'] != 'Purchase' && $data['bill_type'] != 'Estimate'){
                                                            ?>
                                                    
                                                            <tr>
                                                                <td class="text-center px-2 py-2"><?php echo $index; ?></td>
                                                                <td class="text-center px-2 py-2">
                                                                    <?php echo date('d-m-Y', strtotime($data['bill_date'])); ?>
                                                                </td>
                                                                <td class="text-center px-2 py-2" style="cursor:pointer" >
                                                                    <?php if(!empty($data['bill_number']) && $data['bill_number'] != $GLOBALS['null_value']) {
                                                                        echo trim($obj->encode_decode('decrypt',$data['bill_number'])); 
                                                                    } else {
                                                                        echo "-";
                                                                    }
                                                                    ?><br> 
                                                                    &nbsp;
                                                                    <span style="font-size:9px;cursor:pointer;" onclick="Javascript:PaymentModalContent('<?php if(!empty($data['bill_id']) && $data['bill_id'] != $GLOBALS['null_value']) { echo $data['bill_id']; } ?>', '<?php if(!empty($data['bill_type']) && $data['bill_type'] != $GLOBALS['null_value']) { echo $data['bill_type']; } ?>')">
                                                                    <i class="bi bi-eye-fill text-dark fs-15" style="font-size: large;"></i>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <?php echo $data['bill_type']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if(!empty($data['party_name']) && $data['party_name'] != $GLOBALS['null_value']) {
                                                                        echo html_entity_decode($obj->encode_decode('decrypt', $data['party_name'])); 
                                                                    } else {
                                                                        echo " - ";
                                                                    } ?>
                                                                </td>
                                                                <td class="">
                                                                    <?php 

                                                                    if(!empty($data['payment_mode_name']) && $data['payment_mode_name'] != $GLOBALS['null_value']) {
                                                                        $payment_mode_name = array();
                                                                        $payment_mode_name = explode(",", $data['payment_mode_name']);
                                                                        $payment_mode_name = array_reverse($payment_mode_name);

                                                                        $bank_id = explode(",",$data['bank_id']);
                                                                        $bank_id = array_reverse($bank_id);
                                                                        for($i=0; $i < count($payment_mode_name); $i++) {
                                                                            $payment_mode ="";

                                                                            $payment_mode =$obj->encode_decode("decrypt", $payment_mode_name[$i]);
                                                                            
                                                                            if (!empty($data['credit']) || !empty($data['debit'])) {
                                                                                $amounts= array();
                                                                                if($data['bill_type'] == 'Suspense Receipt'){
                                                                                    $amounts = explode(",", $data['credit']);
                                                                                }else if($data['bill_type'] == 'Suspense Voucher'){
                                                                                    $amounts = explode(",", $data['debit']);
                                                                                }
                                                                                $amounts = array_reverse($amounts);
                                                                            }
                                                                            $bank_name = "";
                                                                            if(!empty($bank_id[$i])){
                                                                                $bank_name =  $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id[$i], 'bank_name');
                                                                                $bank_name = $obj->encode_decode('decrypt',$bank_name);
                                                                                $account_number =  $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id[$i], 'account_number');
                                                                                $account_number = $obj->encode_decode('decrypt',$account_number);
                                                                            }

                                                                            if(!empty($bank_name)){
                                                                                echo $payment_mode ." - ( ".$bank_name." ) -  ".$account_number;
                                                                            }else{
                                                                                echo $payment_mode;

                                                                            }  
                                                                            if($i < (count($payment_mode_name))-1) {
                                                                            echo ", <br>";

                                                                            }
                                                                        }  

                                                                    }else{
                                                                        echo "-";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="text-end text-success px-2 py-2">
                                                                    <?php
                                                                        echo $obj->numberFormat($data['credit'], 2);
                                                                        $total_credit += $data['credit'];
                                                                    ?>
                                                                </td>
                                                                <td class="text-end text-danger px-2 py-2">
                                                                    <?php
                                                                        echo $obj->numberFormat($data['debit'], 2);
                                                                        $total_debit += $data['debit'];
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                    
                                                            <?php $index++;
                                                        }
                                                        
                                                    }
                                                    ?>
                                                    <tr>
                                                        <th class="text-end" colspan="6">Total</th>
                                                        <th class="text-end mr-5"><?php echo $obj->numberFormat($total_credit, 2); ?></th>
                                                        <th class="text-end mr-5"><?php echo $obj->numberFormat($total_debit, 2); ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end" colspan="6">Current Balance</th>
                                                        <th class="text-end mr-5">
                                                            <?php echo ($total_credit > $total_debit) ? $obj->numberFormat($total_credit - $total_debit, 2) : '0.00'; ?>
                                                        </th>
                                                        <th class="text-end mr-5">
                                                            <?php echo ($total_debit > $total_credit) ? $obj->numberFormat($total_debit - $total_credit, 2) : '0.00'; ?>
                                                        </th>
                                                    </tr>
                                                    <?php
                                                    
                                                }
                                                else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="7" class="text-center">Sorry! No records found</td>
                                                        </tr>								
                                            <?php } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>  
<!--Right Content End-->
<?php include "footer.php"; ?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $("#report").addClass("active");
        $("#suspense_payment_report").addClass("active");
    });
    function getOverallReport(){
        if(jQuery('form[name="payment_report_form"]').length > 0){
            jQuery('form[name="payment_report_form"]').submit();
        }
    }
   
    function getBillType(bill_type){
        if(jQuery('select[name="filter_bill_type"]').length > 0) {
            jQuery('select[name="filter_bill_type"]').val(bill_type);
        }
        if(jQuery('select[name="filter_suspense_party_id"]').length > 0) {
            jQuery('select[name="filter_suspense_party_id"]').val('');
        }
        
        if(jQuery('form[name="payment_report_form"]').length > 0){
            jQuery('form[name="payment_report_form"]').submit();
        }
    }
   

    function ExportToExcel(type, fn, dl) {
        jQuery('.header').removeClass('d-none');
        
        var elt = document.getElementById('tbl_sales_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });

        if (dl) {
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' });
        } else {
            XLSX.writeFile(wb, fn || ('<?php echo $excel_name; ?>.' + (type || 'xlsx')));
        }
       
        jQuery('.header').addClass('d-none');
    }


    function PaymentModalContent(bill_id, type) {
        var url = "";
        bill_id = bill_id.trim();
        type = type.trim();

        if (type == 'Suspense Receipt') {
            url = "reports/rpt_suspense_receipt_a5.php?view_suspense_receipt_id=" + bill_id;
        } else if (type == 'Suspense Voucher') {
            url = "reports/rpt_suspense_voucher_a5.php?view_suspense_voucher_id=" + bill_id;
        }

        var post_url = "dashboard_changes.php?check_login_session=1";
        jQuery.ajax({
            url: post_url,
            success: function (check_login_session) {
                if (check_login_session == 1) {
                    jQuery('#PaymentModal .modal-header h1').html(type +"  Preview");
                    let uploadModal = new bootstrap.Modal(document.getElementById('PaymentModal'));
                    uploadModal.show();
                    jQuery('.payment_modal_button').trigger("click");
                    var iframe = '<iframe src="' + url + '" width="100%" height="500px" style="border:none;"></iframe>';
                    jQuery('#PaymentModal .modal-body').html(iframe);
                } else {
                    window.location.reload();
                }
            }
        });
    }

</script>