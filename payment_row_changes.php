<?php
    include("include_files.php");

if(isset($_REQUEST['payment_row_index'])) {
    $payment_row_index = $_REQUEST['payment_row_index'];

    $payment_mode_id = $_REQUEST['selected_payment_mode_id'];
    $payment_mode_id = trim($payment_mode_id);

    $bank_id = $_REQUEST['selected_bank_id'];
    $bank_id = trim($bank_id);

    $amount = $_REQUEST['selected_amount'];
    $amount = trim($amount);
    $payment_tax_type = $_REQUEST['payment_tax_type'];
    $payment_tax_type = trim($payment_tax_type);
    ?>
    <tr class="payment_row" id="payment_row<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>">
        <td class="payment_sno text-center">
            <?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>
        </td>
           <?php if(!empty($payment_tax_type)) { ?>
                <td>
                <?php 
                  
                    if(!empty($payment_tax_type)) {
                            if($payment_tax_type == 1) {
                                echo "With Tax"; 
                            } else {
                                echo "Without Tax";
                            } 
                    }  ?>
                    <input type="hidden" name="payment_tax_type[]" value="<?php if(!empty($payment_tax_type)) { echo $payment_tax_type; } ?>">
                </td>
        <?php } ?>
        <td class="text-center">
            <?php
                $payment_mode_name = "";
                $payment_mode_name = $obj->getTableColumnValue($GLOBALS['payment_mode_table'], 'payment_mode_id', $payment_mode_id, 'payment_mode_name');
                echo $obj->encode_decode('decrypt', $payment_mode_name);
            ?>
            <input type="hidden" name="payment_mode_id[]" value="<?php if(!empty($payment_mode_id)) { echo $payment_mode_id; } ?>">
        </td>
        <td class="text-center">
            <?php
                $bank_name = "";
                $bank_name = $obj->getTableColumnValue($GLOBALS['bank_table'], 'bank_id', $bank_id, 'bank_name');
                if(!empty($bank_name) && $bank_name != $GLOBALS['null_value']) {
                    echo $obj->encode_decode('decrypt', $bank_name);
                }
                else {
                    echo '-';
                }   
            ?>
            <input type="hidden" name="bank_id[]" value="<?php if(!empty($bank_id)) { echo $bank_id; } ?>">
        </td>
        <td class="text-center">
            <input type="text" name="expense_amount[]" style="width:75%!important;margin:auto!important;" class="form-control shadow-none px-1 text-center" value="<?php if(!empty($amount)) { echo $amount; } ?>" onfocus="Javascript:KeyboardControls(this,'number','','');" onkeyup="Javascript:PaymentVoucherTotal();InputBoxColor(this, 'text');">
        </td>
        
        <td class="text-center">
            <button class="btn btn-danger" type="button" onclick="Javascript:DeleteExpenseRow('payment_row', '<?php if(!empty($payment_row_index)) { echo $payment_row_index; } ?>');"><i class="fa fa-trash"></i></button>
        </td>
    </tr>
    <?php
}
?>