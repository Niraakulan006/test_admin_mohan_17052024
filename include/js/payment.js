var number_regex = /^\d+$/;
var price_regex = /^(\d*\.)?\d+$/;

function SnoCalculation() {
    if (jQuery('.sno').length > 0) {
        var row_count = 0;
        row_count = jQuery('.sno').length;
        if (typeof row_count != "undefined" && row_count != null && row_count != 0 && row_count != "") {
            var j = 1;
            var sno = document.getElementsByClassName('sno');
            for (var i = row_count - 1; i >= 0; i--) {
                sno[i].innerHTML = j;
                j = parseInt(j) + 1;
            }
        }
    }
}

function AddPaymentRow() {
    var check_login_session = 1; var all_errors_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }

                var selected_payment_mode_id = "";
                if (jQuery('select[name="selected_payment_mode_id"]').is(":visible")) {
                    if (jQuery('select[name="selected_payment_mode_id"]').length > 0) {
                        selected_payment_mode_id = jQuery('select[name="selected_payment_mode_id"]').val();
                        selected_payment_mode_id = jQuery.trim(selected_payment_mode_id);
                        if (typeof selected_payment_mode_id == "undefined" || selected_payment_mode_id == "" || selected_payment_mode_id == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_bank_id = "";
                if (jQuery('select[name="selected_bank_id"]').is(":visible")) {
                    if (jQuery('select[name="selected_bank_id"]').length > 0) {
                        selected_bank_id = jQuery('select[name="selected_bank_id"]').val();
                        selected_bank_id = jQuery.trim(selected_bank_id);
                        if (typeof selected_bank_id == "undefined" || selected_bank_id == "" || selected_bank_id == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_amount = "";
                if (jQuery('input[name="selected_amount"]').length > 0) {

                    selected_amount = jQuery('input[name="selected_amount"]').val();
                    selected_amount = jQuery.trim(selected_amount);

                    if (typeof selected_amount == "undefined" || selected_amount == "" || selected_amount == 0) {
                        all_errors_check = 0;
                    }
                    else if (price_regex.test(selected_amount) == false) {
                        all_errors_check = 0;
                    }
                }

                var payment_tax_type = "";
                if (jQuery('select[name="selected_tax_type"]').length > 0) {
                    payment_tax_type = jQuery('select[name="selected_tax_type"]').val();
                    payment_tax_type = jQuery.trim(payment_tax_type);
                    if (typeof payment_tax_type == "undefined" || payment_tax_type == "" || payment_tax_type == 0) {
                        all_errors_check = 0;
                    }
                    else if (number_regex.test(payment_tax_type) == false) {
                        all_errors_check = 0;
                    }
                }

                if (parseFloat(all_errors_check) == 1) {
                    var add = 1;
                    if (selected_payment_mode_id != "") {
                        if (jQuery('input[name="payment_mode_id[]"]').length > 0) {
                            if (jQuery('input[name="bank_id[]"]').length > 0) {
                                jQuery('.payment_row_table tbody').find('tr').each(function () {
                                    var prev_payment_mode_id = "";
                                    prev_tax_type = jQuery(this).find('input[name="payment_tax_type[]"]').val();
                                    prev_payment_mode_id = jQuery(this).find('input[name="payment_mode_id[]"]').val();
                                    prev_bank_id = jQuery(this).find('input[name="bank_id[]"]').val();
                                    prev_tax_type = jQuery.trim(prev_tax_type);
                                    if (prev_tax_type == payment_tax_type && prev_payment_mode_id == selected_payment_mode_id && (selected_bank_id == prev_bank_id)) {
                                        add = 0;
                                    }
                                });
                            }
                        }
                    }
                    if (parseFloat(add) == 1) {
                        var payment_count = 0;
                        payment_count = jQuery('input[name="payment_row_count"]').val();
                        payment_count = parseInt(payment_count) + 1;
                        jQuery('input[name="payment_row_count"]').val(payment_count);

                        var post_url = "payment_bill_changes.php?payment_row_index=" + payment_count + "&selected_payment_mode_id=" + selected_payment_mode_id + "&selected_bank_id=" + selected_bank_id + "&selected_amount=" + selected_amount + "&payment_tax_type=" + payment_tax_type;

                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.payment_row_table tbody').find('tr').length > 0) {
                                    jQuery('.payment_row_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.payment_row_table tbody').append(result);
                                }
                                if (jQuery('select[name="selected_payment_mode_id"]').length > 0) {
                                    jQuery('select[name="selected_payment_mode_id"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="selected_bank_id"]').length > 0) {
                                    jQuery('select[name="selected_bank_id"]').val('').trigger('change');
                                }
                                if (jQuery('input[name="selected_amount"]').length > 0) {
                                    jQuery('input[name="selected_amount"]').val('');
                                }
                                if (jQuery('select[name="selected_tax_type"]').length > 0) {
                                    jQuery('select[name="selected_tax_type"]').val('').trigger('change');
                                }
                                if (jQuery('#AccBal').length > 0) {
                                    jQuery('#AccBal').html('');
                                }
                                PaymentTotal();
                                SnoCalculation();
                            }
                        });
                    }
                    else {
                        jQuery('.payment_row_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Payment Mode Already Exists</span>');
                    }
                }
                else {
                    jQuery('.payment_row_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check All Details</span>');
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}

function getBankDetails(bank_details) {
    var post_url = "payment_bill_changes.php?selected_bank_payment_mode=" + bank_details;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            if (result != "") {
                if (jQuery('#bank_list').length > 0) {
                    jQuery('#bank_list').removeClass('d-none');
                }
                if (jQuery('select[name="selected_bank_id"]')) {
                    jQuery('select[name="selected_bank_id"]').html(result);
                }

            }
            else {
                if (jQuery('#bank_list').length > 0) {
                    jQuery('#bank_list').addClass('d-none');
                }
                if (jQuery('select[name="selected_bank_id"]')) {
                    jQuery('select[name="selected_bank_id"]').val("");
                }
            }
            if (jQuery('input[name="mode_of_payment_amount"]')) {
                jQuery('input[name="mode_of_payment_amount"]').focus();
            }
            checkAvailableBalance();
        }

    });
}
function DeleteRow(id_name, row_index) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('#' + id_name + row_index).length > 0) {
                    jQuery('#' + id_name + row_index).remove();
                }
                PaymentTotal();
                SnoCalculation();
            }
            else {
                window.location.reload();
            }
        }
    });
}


function PaymentTotal() {
    var total_amount = 0;
    if (jQuery('.payment_row').length > 0) {
        jQuery('.payment_row').each(function () {
            var amount = 0;
            if (jQuery(this).find('input[name="amount[]"]').length > 0) {
                amount = jQuery(this).find('input[name="amount[]"]').val();
                amount = amount.trim();
            }
            if (amount != "" && amount != 0 && typeof amount != "undefined" && amount != null && price_regex.test(amount) !== false) {
                total_amount = parseFloat(amount) + parseFloat(total_amount);
                total_amount = total_amount.toFixed(2);
            }
        });
    }
    if (jQuery('.overall_total').length > 0) {
        jQuery('.overall_total').html('Rs.' + total_amount);
    }
}

function addExpenseCategoryDetails() {
    var check_login_session = 1; var all_errors_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }

                // if (jQuery('.add_details_buttton').length > 0) {
                // 	jQuery('.add_details_buttton').attr('disabled', true);
                // }
                var regex = /^(?=.*[a-zA-Z])[a-zA-Z0-9 ]+$/;

                validation_check = 1; var expense_category_name = ""; var character = 1;
                if (jQuery('input[name="expense_category_name"]').is(":visible")) {
                    if (jQuery('input[name="expense_category_name"]').length > 0) {
                        expense_category_name = jQuery('input[name="expense_category_name"]').val();
                        expense_category_name = expense_category_name.trim();
                        if (typeof expense_category_name != "undefined" && expense_category_name != "") {
                            if (expense_category_name.length > 50) {
                                character = 0;
                            } else {
                                if (regex.test(expense_category_name) == false) {
                                    // jQuery('input[name="expense_category_name"]').parent().after('<span class="infos">Invalid Expense_category</span>');
                                    validation_check = 0;
                                } else {
                                    jQuery('input[name="expense_category_name"]').val(expense_category_name);
                                }
                            }
                        } else {
                            all_errors_check = 0;
                        }


                    }
                }
                if (all_errors_check == 1) {
                    if (character == 1) {
                        if (validation_check == 1) {

                            var add = 1;
                            if (expense_category_name != "") {
                                if (jQuery('input[name="expense_category_names[]"]').length > 0) {
                                    jQuery('.added_expense_category_table tbody').find('tr').each(function () {
                                        var prev_expense_category_name = jQuery(this).find('input[name="expense_category_names[]"]').val();
                                        // if (prev_expense_category_name == expense_category_name) {
                                        // 	add = 0;
                                        // }
                                        var prev_expense_category_name = prev_expense_category_name.toLowerCase();
                                        var current_payment_mode_name = expense_category_name.toLowerCase();
                                        prev_expense_category_name = prev_expense_category_name.trim();
                                        current_payment_mode_name = current_payment_mode_name.trim();
                                        if (prev_expense_category_name == current_payment_mode_name) {
                                            add = 0;
                                        }
                                    });
                                }
                            }

                            if (add == 1) {
                                var expense_category_count = jQuery('input[name="expense_category_count"]').val();
                                expense_category_count = parseInt(expense_category_count) + 1;
                                jQuery('input[name="expense_category_count"]').val(expense_category_count);

                                var post_url = "expense_category_changes.php?expense_category_row_index=" + expense_category_count + "&selected_expense_category_name=" + expense_category_name;

                                jQuery.ajax({
                                    url: post_url, success: function (result) {

                                        if (jQuery('.added_expense_category_table tbody').find('tr').length > 0) {
                                            jQuery('.added_expense_category_table tbody').find('tr:first').before(result);
                                        }
                                        else {
                                            jQuery('.added_expense_category_table tbody').append(result);
                                        }
                                        SnoCalculation();

                                        if (jQuery('input[name="expense_category_name"]').length > 0) {
                                            jQuery('input[name="expense_category_name"]').val('');
                                        }

                                    }
                                });
                            }
                            else {
                                jQuery('.added_expense_category_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Expense_category Name already Exists</span>');

                                if (jQuery('.add_details_buttton').length > 0) {
                                    jQuery('.add_details_buttton').attr('disabled', false);
                                }
                            }
                        }
                        else {
                            jQuery('.added_expense_category_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Invalid Expense category</span>');
                            jQuery('input[name="expense_category_name"]').val('');

                            // if (jQuery('.add_details_buttton').length > 0) {
                            // 	jQuery('.add_details_buttton').attr('disabled', false);
                            // }
                        }
                    } else {
                        jQuery('.added_expense_category_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Expense category Name is more than 50</span>');
                    }
                } else {
                    jQuery('.added_expense_category_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please check all field values</span>');
                    if (jQuery('.add_details_buttton').length > 0) {
                        jQuery('.add_details_buttton').attr('disabled', false);
                    }
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}

function DeleteExpenseCategoryRow(row_index) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('#expense_category_row' + row_index).length > 0) {
                    jQuery('#expense_category_row' + row_index).remove();
                }
                SnoCalculation();
            }
            else {
                window.location.reload();
            }
        }
    });
}



function HideDetails(type) {
    var type_id = ""; var lower_type = "";
    if (type != "") {
        lower_type = type.toLowerCase();
        lower_type = lower_type.trim();
    }
    if (jQuery('select[name="' + lower_type + '_id"]').length > 0) {
        type_id = jQuery('select[name="' + lower_type + '_id"]').val();
    }
    if (type_id != "" && type_id != null && typeof type_id != "undefined") {
        if (jQuery('.details_element').length > 0) {
            jQuery('.details_element').removeClass('d-none');
        }
    }
    else {
        if (jQuery('.details_element').length > 0) {
            jQuery('.details_element').addClass('d-none');
        }
    }
}


function ViewDetails(type) {
    var type_id = ""; var lower_type = "";
    if (type != "") {
        lower_type = type.toLowerCase();
        lower_type = lower_type.trim();
        type = type.replace("_", " ");
    }
    if (jQuery('select[name="' + lower_type + '_id"]').length > 0) {
        type_id = jQuery('select[name="' + lower_type + '_id"]').val();
    }
    var post_url = "common_changes.php?view_party_details=" + type_id + "&details_type=" + lower_type;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            if (jQuery('.details_modal_button').length > 0) {
                jQuery('.details_modal_button').trigger('click');
            }
            if (jQuery('#ViewDetailsModal').length > 0) {
                if (jQuery('#ViewDetailsModal').find('.modal-title').length > 0) {
                    jQuery('#ViewDetailsModal').find('.modal-title').html(type + ' Details');
                }
                if (jQuery('#ViewDetailsModal').find('.modal-body').length > 0) {
                    jQuery('#ViewDetailsModal').find('.modal-body').html(result);
                }
            }
        }
    });
}

function getVoucherDtls() {
    var party_id = "";
    if (jQuery('select[name="party_id"]').length > 0) {
        party_id = jQuery('select[name="party_id"]').val();
        party_id = party_id.trim();
    }
    var balance_type = "";
    if (jQuery('select[name="balance_type"]').length > 0) {
        balance_type = jQuery('select[name="balance_type"]').val();
        balance_type = balance_type.trim();
    }
    var check_login_session = 1;
    // var party_id = document.getElementById('party_id').value;
    var post_url = "dashboard_changes.php?check_login_session=1";

    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                var post_url = "payment_bill_changes.php?purchase_party_id=" + party_id + "&balance_type=" + balance_type;
                jQuery.ajax({
                    url: post_url, success: function (party_name) {
                        if (party_id != "") {
                            if (jQuery('#party_pmt_dtls').length > 0) {
                                jQuery('#party_pmt_dtls').html(party_name);
                            }
                        }
                    }
                });

            }
            else {
                window.location.reload();
            }
        }
    });
}

function getReceiptDtls() {
    var party_id = "";
    if (jQuery('select[name="party_id"]').length > 0) {
        party_id = jQuery('select[name="party_id"]').val();
        party_id = party_id.trim();
    }
    var balance_type = "";
    if (jQuery('select[name="balance_type"]').length > 0) {
        balance_type = jQuery('select[name="balance_type"]').val();
        balance_type = balance_type.trim();
    }
    var check_login_session = 1;
    // var party_id = document.getElementById('party_id').value;
    var post_url = "dashboard_changes.php?check_login_session=1";

    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                var post_url = "payment_bill_changes.php?party_id=" + party_id + "&balance_type=" + balance_type;
                jQuery.ajax({
                    url: post_url, success: function (party_name) {
                        if (party_id != "") {
                            if (jQuery('#party_pmt_dtls').length > 0) {
                                jQuery('#party_pmt_dtls').html(party_name);
                            }
                        }
                    }
                });

            }
            else {
                window.location.reload();
            }
        }
    });
}

function getSuspenceVoucherDtls(party_id) {
    var check_login_session = 1;
    // var party_id = document.getElementById('party_id').value;
    var post_url = "dashboard_changes.php?check_login_session=1";

    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                var post_url = "payment_bill_changes.php?suspense_party_id=" + party_id;
                jQuery.ajax({
                    url: post_url, success: function (party_name) {
                        if (jQuery('#party_pmt_dtls').length > 0) {
                            jQuery('#party_pmt_dtls').html(party_name);
                        }
                    }
                });

            }
            else {
                window.location.reload();
            }
        }
    });
}

function getSuspenseReceiptDtls(party_id) {
    var check_login_session = 1;
    // var party_id = document.getElementById('party_id').value;
    var post_url = "dashboard_changes.php?check_login_session=1";

    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                var post_url = "payment_bill_changes.php?suspenseparty_id=" + party_id;
                jQuery.ajax({
                    url: post_url, success: function (party_name) {
                        if (jQuery('#party_pmt_dtls').length > 0) {
                            jQuery('#party_pmt_dtls').html(party_name);
                        }
                    }
                });

            }
            else {
                window.location.reload();
            }
        }
    });
}


function getBalDtls(type) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";

    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                var post_url = "payment_bill_changes.php?bill_type=" + type;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        result = result.trim();
                        if (type != "") {
                            if (jQuery('#AccBal').length > 0) {
                                jQuery('#AccBal').html("Available Balance Rs." + result);
                            }
                        }
                    }
                });
            }
            else {
                window.location.reload();
            }
        }
    });
    getAccountBalance();
}
function getAccountBalance() {
    var bank_id = "";
    if (jQuery('select[name="selected_bank_id"]').length > 0) {
        bank_id = jQuery('select[name="selected_bank_id"]').val();
    }

    var balance_type = "";
    if (jQuery('select[name="balance_type"]').length > 0) {
        balance_type = jQuery('select[name="balance_type"]').val();
    }

    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";

    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                var post_url = "payment_bill_changes.php?bank_id=" + bank_id + "&type=" + balance_type;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        result = result.trim();
                        if (result != "") {
                            if (jQuery('#AccBal').length > 0) {
                                jQuery('#AccBal').html("Available Balance Rs." + result);
                            }

                        }
                    }
                });
            }
            else {
                window.location.reload();
            }
        }
    });
}

function checkAvailableBalance() {
    var tax_type = 2; var payment_mode_id = ""; var bank_id = "";

    if (jQuery('select[name="selected_tax_type"]').length > 0) {
        tax_type = jQuery('select[name="selected_tax_type"]').val();
    }

    var payment_mode_id = "";
    if (jQuery('select[name="selected_payment_mode_id"]').length > 0) {
        payment_mode_id = jQuery('select[name="selected_payment_mode_id"]').val();
    }

    var bank_id = "";
    if (jQuery('select[name="selected_bank_id"]').length > 0) {
        bank_id = jQuery('select[name="selected_bank_id"]').val();
    }

    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";

    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                var post_url = "payment_bill_changes.php?selected_tax_type=" + tax_type + "&selected_payment_mode=" + payment_mode_id + "&selected_bank=" + bank_id;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        result = result.trim();
                        if (result != "") {
                            // if (jQuery('#AccBal').length > 0) {
                            //     jQuery('#AccBal').html("Available Balance Rs." + result);
                            // }
                            // if (jQuery('.AccBal').length > 0) {
                            //     jQuery('.AccBal').val(result);
                            // }

                            if (jQuery('#bank_list').hasClass('d-none')){
								if (jQuery('#AccBal').length > 0) {
									jQuery('#AccBal').html("Available Balance Rs."+result);
								}
							}else{
								if(bank_id != ""){
									if (jQuery('#AccBal').length > 0) {
										jQuery('#AccBal').html("Available Balance Rs"+result);
									}
								}
							}
                        }
                        
                    }
                });
            }
            else {
                window.location.reload();
            }
        }
    });

}

function ViewPartyDetails(type) {
    var type_id = ""; var lower_type = "";
    if (type != "") {
        lower_type = type.toLowerCase();
        lower_type = lower_type.trim();
        type = type.replace("_", " ");
    }
    if (jQuery('select[name="' + lower_type + '_id"]').length > 0) {
        type_id = jQuery('select[name="' + lower_type + '_id"]').val();
    }
    var post_url = "payment_bill_changes.php?view_party_details=" + type_id + "&details_type=" + lower_type;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            // alert(jQuery('#ViewDetailsModal').length )
            // if(jQuery('#ViewDetailsModal').length > 0) {
            //     jQuery('#ViewDetailsModal').trigger('click');
            // }
            var modal = new bootstrap.Modal(document.getElementById('ViewDetailsModal'));
            modal.show();
            if (jQuery('#ViewDetailsModal').length > 0) {
                if (jQuery('#ViewDetailsModal').find('.modal-title').length > 0) {
                    jQuery('#ViewDetailsModal').find('.modal-title').html(type + ' Details');
                }
                if (jQuery('#ViewDetailsModal').find('.modal-body').length > 0) {
                    jQuery('#ViewDetailsModal').find('.modal-body').html(result);
                }

            }
        }
    });
}


function ViewPendingDetails(type) {
    var type_id = ""; var lower_type = "";
    if (type != "") {
        lower_type = type.toLowerCase();
        lower_type = lower_type.trim();
        type = type.replace("_", " ");
    }
    if (jQuery('select[name="' + lower_type + '_id"]').length > 0) {
        type_id = jQuery('select[name="' + lower_type + '_id"]').val();
    }
    var post_url = "payment_bill_changes.php?party_id=" + type_id + "&type=" + lower_type;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            result = result.split("$$$");
            if (jQuery('.pending_modal_button').length > 0) {
                jQuery('.pending_modal_button').trigger('click');
            }
            if (jQuery('#PendingDetailsModal').length > 0) {
                if (jQuery('#PendingDetailsModal').find('.modal-title').length > 0) {
                    jQuery('#PendingDetailsModal').find('.modal-title').html(result[1]);
                }
                if (jQuery('#PendingDetailsModal').find('.modal-body').length > 0) {
                    jQuery('#PendingDetailsModal').find('.modal-body').html(result[0]);
                }
                var modal = new bootstrap.Modal(document.getElementById('PendingDetailsModal'));
                modal.show();
            }
        }
    });
}

function GetPayment() {
    var payment_mode_id = ""; var bank_id = ""; var payment_tax_type = "";
    if (jQuery('select[name="selected_tax_type"]').length > 0) {
        payment_tax_type = jQuery('select[name="selected_tax_type"]').val();
        payment_tax_type = jQuery.trim(payment_tax_type);
    }
   if (jQuery('.payment').length > 0) {
        jQuery('.payment').html('');
    }
    if (jQuery('input[name="available_balance"]').length > 0) {
        jQuery('input[name="available_balance"]').val('');
    }
    if (jQuery('select[name="selected_payment_mode_id"]').length > 0) {
        payment_mode_id = jQuery('select[name="selected_payment_mode_id"]').val();
        payment_mode_id = jQuery.trim(payment_mode_id);
    }

    if (jQuery('select[name="selected_bank_id"]').length > 0) {
        bank_id = jQuery('select[name="selected_bank_id"]').val();
        bank_id = jQuery.trim(bank_id);
    }

    var post_url = "payment_bill_changes.php?get_payment_mode_id=" + payment_mode_id + "&get_bank_id=" + bank_id + "&get_payment_tax_type=" + payment_tax_type;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            if (result != '') {
                if (jQuery('#bank_list').hasClass('d-none')){

                    if (jQuery('.payment').length > 0) {
                        jQuery('.payment').html("Available Balance Rs." + result);
                    }
                    if (jQuery('input[name="available_balance"]').length > 0) {
                        jQuery('input[name="available_balance"]').val(result);
                    }
                }else{
                    if(bank_id != ""){
                        if (jQuery('.payment').length > 0) {
                            jQuery('.payment').html("Available Balance Rs." + result);
                        }
                        if (jQuery('input[name="available_balance"]').length > 0) {
                            jQuery('input[name="available_balance"]').val(result);
                        }
                    }else{
                           if (jQuery('.payment').length > 0) {
                            jQuery('.payment').html('');
                        }
                        if (jQuery('input[name="available_balance"]').length > 0) {
                            jQuery('input[name="available_balance"]').val('');
                        }
                    }

                }
            } else {

                if(result != "" && result == 0){
                    if (jQuery('.payment').length > 0) {
                        jQuery('.payment').html("Available Balance Rs.0");
                    }
                    if (jQuery('input[name="available_balance"]').length > 0) {
                        jQuery('input[name="available_balance"]').val('0');
                    }
                }else{
                    if (jQuery('.payment').length > 0) {
                        jQuery('.payment').html('');
                    }
                    if (jQuery('input[name="available_balance"]').length > 0) {
                        jQuery('input[name="available_balance"]').val('');
                    }
                }
             
            }
        }
    });
}


function ViewReceiptPartyDetails() {
    var type_id = ""; var lower_type = "";
     if (jQuery('select[name="selected_party_type"]').length > 0) {
        type = jQuery('select[name="selected_party_type"]').val();
    }
    if (type != "") {
        lower_type = type.toLowerCase();
        lower_type = lower_type.trim();
        type = type.replace("_", " ");
    }
    if (jQuery('select[name="party_id"]').length > 0) {
        type_id = jQuery('select[name="party_id"]').val();
    }
    var post_url = "payment_bill_changes.php?view_party_details=" + type_id + "&details_type=" + lower_type;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            // alert(jQuery('#ViewDetailsModal').length )
            // if(jQuery('#ViewDetailsModal').length > 0) {
            //     jQuery('#ViewDetailsModal').trigger('click');
            // }
            var modal = new bootstrap.Modal(document.getElementById('ViewDetailsModal'));
            modal.show();
            if (jQuery('#ViewDetailsModal').length > 0) {
                if (jQuery('#ViewDetailsModal').find('.modal-title').length > 0) {
                    jQuery('#ViewDetailsModal').find('.modal-title').html(type + ' Details');
                }
                if (jQuery('#ViewDetailsModal').find('.modal-body').length > 0) {
                    jQuery('#ViewDetailsModal').find('.modal-body').html(result);
                }

            }
        }
    });
}

function LRNumbersList(){
    
    if(jQuery('#lr_amount_display').length > 0) {
        jQuery('#lr_amount_display').html('');
    }
    if(jQuery('#previous_receipt_amount').length > 0) {
        jQuery('#previous_receipt_amount').html('');
    }
    
    var party_id = ""; var party_type = "";
    if (jQuery('select[name="party_id"]').length > 0) {
        party_id = jQuery('select[name="party_id"]').val();
    }
    if (jQuery('select[name="selected_party_type"]').length > 0) {
        party_type = jQuery('select[name="selected_party_type"]').val();
    }
    if (party_type != "") {
        party_type = party_type.toLowerCase();
        party_type = party_type.trim();
    }
    var post_url = "payment_bill_changes.php?lr_details_party_id="+party_id+"&party_type="+party_type;
	jQuery.ajax({url: post_url, success: function(result){
		result = result.trim();
		if(jQuery('select[name="lr_id"]').length > 0) {
			jQuery('select[name="lr_id"]').html(result);
		}
	}});
}

function GetLRBillAmount(){

    if(jQuery('#lr_amount_display').length > 0) {
        jQuery('#lr_amount_display').html('');
    }
    var lr_id = ""; 
    if (jQuery('select[name="lr_id"]').length > 0) {
        lr_id = jQuery('select[name="lr_id"]').val();
    }

     var post_url = "payment_bill_changes.php?receipt_lr_id="+lr_id;
	jQuery.ajax({url: post_url, success: function(result){
		result = result.trim();
        result = result.split("$$$");

		if(jQuery('#lr_amount_display').length > 0) {
			jQuery('#lr_amount_display').html(result[0]);
		}
        if(jQuery('#previous_receipt_amount').length > 0) {
			jQuery('#previous_receipt_amount').html(result[1]);
		}
	}});

}


function ViewReceiptPendingDetails() {
    var type_id = ""; var lower_type = "";
 var party_type = "";
    if (jQuery('select[name="party_id"]').length > 0) {
        type_id = jQuery('select[name="party_id"]').val();
    }
    if (jQuery('select[name="selected_party_type"]').length > 0) {
        party_type = jQuery('select[name="selected_party_type"]').val();
    }
    if (party_type != "") {
        lower_type = party_type.toLowerCase();
        lower_type = lower_type.trim();
        // lower_type = lower_type.replace("_", " ");
    }

    var post_url = "payment_bill_changes.php?listing_party_details_party_id=" + type_id + "&type=" + lower_type;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            result = result.split("$$$");
            if (jQuery('.pending_modal_button').length > 0) {
                jQuery('.pending_modal_button').trigger('click');
            }
            if (jQuery('#PendingDetailsModal').length > 0) {
                if (jQuery('#PendingDetailsModal').find('.modal-title').length > 0) {
                    jQuery('#PendingDetailsModal').find('.modal-title').html(result[1]);
                }
                if (jQuery('#PendingDetailsModal').find('.modal-body').length > 0) {
                    jQuery('#PendingDetailsModal').find('.modal-body').html(result[0]);
                }
                var modal = new bootstrap.Modal(document.getElementById('PendingDetailsModal'));
                modal.show();
            }
        }
    });
}



function AddPurchasePaymentRow() {
    var check_login_session = 1; var all_errors_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }

                var selected_payment_mode_id = "";
                if (jQuery('select[name="selected_payment_mode_id"]').is(":visible")) {
                    if (jQuery('select[name="selected_payment_mode_id"]').length > 0) {
                        selected_payment_mode_id = jQuery('select[name="selected_payment_mode_id"]').val();
                        selected_payment_mode_id = jQuery.trim(selected_payment_mode_id);
                        if (typeof selected_payment_mode_id == "undefined" || selected_payment_mode_id == "" || selected_payment_mode_id == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_bank_id = "";
                if (jQuery('select[name="selected_bank_id"]').is(":visible")) {
                    if (jQuery('select[name="selected_bank_id"]').length > 0) {
                        selected_bank_id = jQuery('select[name="selected_bank_id"]').val();
                        selected_bank_id = jQuery.trim(selected_bank_id);
                        if (typeof selected_bank_id == "undefined" || selected_bank_id == "" || selected_bank_id == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_amount = "";
                if (jQuery('input[name="selected_amt"]').length > 0) {

                    selected_amount = jQuery('input[name="selected_amt"]').val();
                    selected_amount = jQuery.trim(selected_amount);

                    if (typeof selected_amount == "undefined" || selected_amount == "" || selected_amount == 0) {
                        all_errors_check = 0;
                    }
                    else if (price_regex.test(selected_amount) == false) {
                        all_errors_check = 0;
                    }
                }

                var payment_tax_type = "";
                if (jQuery('select[name="selected_tax_type"]').length > 0) {
                    payment_tax_type = jQuery('select[name="selected_tax_type"]').val();
                    payment_tax_type = jQuery.trim(payment_tax_type);
                    if (typeof payment_tax_type == "undefined" || payment_tax_type == "" || payment_tax_type == 0) {
                        all_errors_check = 0;
                    }
                    else if (number_regex.test(payment_tax_type) == false) {
                        all_errors_check = 0;
                    }
                }

                if (parseFloat(all_errors_check) == 1) {
                    var add = 1;
                    if (selected_payment_mode_id != "") {
                        if (jQuery('input[name="payment_mode_id[]"]').length > 0) {
                            if (jQuery('input[name="bank_id[]"]').length > 0) {
                                jQuery('.payment_row_table tbody').find('tr').each(function () {
                                    var prev_payment_mode_id = "";
                                    prev_tax_type = jQuery(this).find('input[name="payment_tax_type[]"]').val();
                                    prev_payment_mode_id = jQuery(this).find('input[name="payment_mode_id[]"]').val();
                                    prev_bank_id = jQuery(this).find('input[name="bank_id[]"]').val();
                                    prev_tax_type = jQuery.trim(prev_tax_type);
                                    if (prev_tax_type == payment_tax_type && prev_payment_mode_id == selected_payment_mode_id && (selected_bank_id == prev_bank_id)) {
                                        add = 0;
                                    }
                                });
                            }
                        }
                    }
                    if (parseFloat(add) == 1) {
                        var payment_count = 0;
                        payment_count = jQuery('input[name="payment_row_count"]').val();
                        payment_count = parseInt(payment_count) + 1;
                        jQuery('input[name="payment_row_count"]').val(payment_count);

                        var post_url = "purchase_bill_changes.php?payment_row_index=" + payment_count + "&selected_payment_mode_id=" + selected_payment_mode_id + "&selected_bank_id=" + selected_bank_id + "&selected_amount=" + selected_amount + "&payment_tax_type=" + payment_tax_type;

                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.payment_row_table tbody').find('tr').length > 0) {
                                    jQuery('.payment_row_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.payment_row_table tbody').append(result);
                                }
                                if (jQuery('select[name="selected_payment_mode_id"]').length > 0) {
                                    jQuery('select[name="selected_payment_mode_id"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="selected_bank_id"]').length > 0) {
                                    jQuery('select[name="selected_bank_id"]').val('').trigger('change');
                                }
                                if (jQuery('input[name="selected_amt"]').length > 0) {
                                    jQuery('input[name="selected_amt"]').val('');
                                }
                                if (jQuery('select[name="selected_tax_type"]').length > 0) {
                                    jQuery('select[name="selected_tax_type"]').val('').trigger('change');
                                }
                                if (jQuery('#AccBal').length > 0) {
                                    jQuery('#AccBal').html('');
                                }
                                PaymentVoucherTotal();
                                SnoVoucherCalculation();
                            }
                        });
                    }
                    else {
                        jQuery('.payment_row_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Payment Mode Already Exists</span>');
                    }
                }
                else {
                    jQuery('.payment_row_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check All Details</span>');
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}



function PaymentVoucherTotal() {
    var total_amount = 0;
    if (jQuery('.payment_row').length > 0) {
        jQuery('.payment_row').each(function () {
            var amount = 0;
            if (jQuery(this).find('input[name="voucher_amount[]"]').length > 0) {
                amount = jQuery(this).find('input[name="voucher_amount[]"]').val();
                amount = amount.trim();
            }
            if (amount != "" && amount != 0 && typeof amount != "undefined" && amount != null && price_regex.test(amount) !== false) {
                total_amount = parseFloat(amount) + parseFloat(total_amount);
                total_amount = total_amount.toFixed(2);
            }
        });
    }
    if (jQuery('.voucher_overall_total').length > 0) {
        jQuery('.voucher_overall_total').html('Rs.' + total_amount);
    }
}


function SnoVoucherCalculation() {
    if (jQuery('.payment_sno').length > 0) {
        var row_count = 0;
        row_count = jQuery('.payment_sno').length;
        if (typeof row_count != "undefined" && row_count != null && row_count != 0 && row_count != "") {
            var j = 1;
            var sno = document.getElementsByClassName('payment_sno');
            for (var i = row_count - 1; i >= 0; i--) {
                sno[i].innerHTML = j;
                j = parseInt(j) + 1;
            }
        }
    }
}
function DeleteVoucherRow(id_name, row_index) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('#' + id_name + row_index).length > 0) {
                    jQuery('#' + id_name + row_index).remove();
                }
                PaymentVoucherTotal();
                SnoVoucherCalculation();
            }
            else {
                window.location.reload();
            }
        }
    });
}



function GetDriverPayment() {
    var payment_mode_id = ""; var bank_id = ""; var payment_tax_type = "";
    if (jQuery('select[name="selected_tax_type"]').length > 0) {
        payment_tax_type = jQuery('select[name="selected_tax_type"]').val();
        payment_tax_type = jQuery.trim(payment_tax_type);
    }
   if (jQuery('.payment').length > 0) {
        jQuery('.payment').html('');
    }
    if (jQuery('input[name="available_balance"]').length > 0) {
        jQuery('input[name="available_balance"]').val('');
    }
    if (jQuery('select[name="driver_selected_payment_mode_id"]').length > 0) {
        payment_mode_id = jQuery('select[name="driver_selected_payment_mode_id"]').val();
        payment_mode_id = jQuery.trim(payment_mode_id);
    }

    if (jQuery('select[name="driver_selected_bank_id"]').length > 0) {
        bank_id = jQuery('select[name="driver_selected_bank_id"]').val();
        bank_id = jQuery.trim(bank_id);
    }

    var post_url = "profit_changes.php?get_driver_payment_mode_id=" + payment_mode_id + "&get_bank_id=" + bank_id + "&get_payment_tax_type=" + payment_tax_type;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            if (result != '') {
                if (jQuery('#bank_list').hasClass('d-none')){

                    if (jQuery('.payment').length > 0) {
                        jQuery('.payment').html("Available Balance Rs." + result);
                    }
                    if (jQuery('input[name="available_balance"]').length > 0) {
                        jQuery('input[name="available_balance"]').val(result);
                    }
                }else{
                    if(bank_id != ""){
                        if (jQuery('.payment').length > 0) {
                            jQuery('.payment').html("Available Balance Rs." + result);
                        }
                        if (jQuery('input[name="available_balance"]').length > 0) {
                            jQuery('input[name="available_balance"]').val(result);
                        }
                    }else{
                           if (jQuery('.payment').length > 0) {
                            jQuery('.payment').html('');
                        }
                        if (jQuery('input[name="available_balance"]').length > 0) {
                            jQuery('input[name="available_balance"]').val('');
                        }
                    }

                }
            } else {

                if(result != "" && result == 0){
                    if (jQuery('.payment').length > 0) {
                        jQuery('.payment').html("Available Balance Rs.0");
                    }
                    if (jQuery('input[name="available_balance"]').length > 0) {
                        jQuery('input[name="available_balance"]').val('0');
                    }
                }else{
                    if (jQuery('.payment').length > 0) {
                        jQuery('.payment').html('');
                    }
                    if (jQuery('input[name="available_balance"]').length > 0) {
                        jQuery('input[name="available_balance"]').val('');
                    }
                }
             
            }
        }
    });
}


function getDriverBankDetails(bank_details) {
    // alert(bank_details)
    var post_url = "payment_bill_changes.php?selected_bank_payment_mode=" + bank_details;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            if (result != "") {
                if (jQuery('#driver_bank_list').length > 0) {
                    jQuery('#driver_bank_list').removeClass('d-none');
                }
                if (jQuery('select[name="driver_selected_bank_id"]')) {
                    jQuery('select[name="driver_selected_bank_id"]').html(result);
                }

            }
            else {
                if (jQuery('#driver_bank_list').length > 0) {
                    jQuery('#driver_bank_list').addClass('d-none');
                }
                if (jQuery('select[name="driver_selected_bank_id"]')) {
                    jQuery('select[name="driver_selected_bank_id"]').val("");
                }
            }
            if (jQuery('input[name="driver_mode_of_payment_amount"]')) {
                jQuery('input[name="driver_mode_of_payment_amount"]').focus();
            }
            checkAvailableBalance();
        }

    });
}



function AddDriverExpensePaymentRow() {
    var check_login_session = 1; var all_errors_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }

                var selected_payment_mode_id = "";
                if (jQuery('select[name="driver_selected_payment_mode_id"]').is(":visible")) {
                    if (jQuery('select[name="driver_selected_payment_mode_id"]').length > 0) {
                        selected_payment_mode_id = jQuery('select[name="driver_selected_payment_mode_id"]').val();
                        selected_payment_mode_id = jQuery.trim(selected_payment_mode_id);
                        if (typeof selected_payment_mode_id == "undefined" || selected_payment_mode_id == "" || selected_payment_mode_id == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_bank_id = "";
                if (jQuery('select[name="driver_selected_bank_id"]').is(":visible")) {
                    if (jQuery('select[name="driver_selected_bank_id"]').length > 0) {
                        selected_bank_id = jQuery('select[name="driver_selected_bank_id"]').val();
                        selected_bank_id = jQuery.trim(selected_bank_id);
                        if (typeof selected_bank_id == "undefined" || selected_bank_id == "" || selected_bank_id == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_amount = "";
                if (jQuery('input[name="driver_selected_amt"]').length > 0) {

                    selected_amount = jQuery('input[name="driver_selected_amt"]').val();
                    selected_amount = jQuery.trim(selected_amount);

                    if (typeof selected_amount == "undefined" || selected_amount == "" || selected_amount == 0) {
                        all_errors_check = 0;
                    }
                    else if (price_regex.test(selected_amount) == false) {
                        all_errors_check = 0;
                    }
                }

                var payment_tax_type = "";
                if (jQuery('select[name="driver_selected_tax_type"]').length > 0) {
                    payment_tax_type = jQuery('select[name="driver_selected_tax_type"]').val();
                    payment_tax_type = jQuery.trim(payment_tax_type);
                    if (typeof payment_tax_type == "undefined" || payment_tax_type == "" || payment_tax_type == 0) {
                        all_errors_check = 0;
                    }
                    else if (number_regex.test(payment_tax_type) == false) {
                        all_errors_check = 0;
                    }
                }

                if (parseFloat(all_errors_check) == 1) {
                    var add = 1;
                    if (selected_payment_mode_id != "") {
                        if (jQuery('input[name="driver_payment_mode_id[]"]').length > 0) {
                            if (jQuery('input[name="driver_bank_id[]"]').length > 0) {
                                jQuery('.driver_payment_row_table tbody').find('tr').each(function () {
                                    var prev_payment_mode_id = "";
                                    prev_tax_type = jQuery(this).find('input[name="driver_payment_tax_type[]"]').val();
                                    prev_payment_mode_id = jQuery(this).find('input[name="driver_payment_mode_id[]"]').val();
                                    prev_bank_id = jQuery(this).find('input[name="driver_bank_id[]"]').val();
                                    prev_tax_type = jQuery.trim(prev_tax_type);
                                    if (prev_tax_type == payment_tax_type && prev_payment_mode_id == selected_payment_mode_id && (selected_bank_id == prev_bank_id)) {
                                        add = 0;
                                    }
                                });
                            }
                        }
                    }
                    if (parseFloat(add) == 1) {
                        var payment_count = 0;
                        payment_count = jQuery('input[name="driver_payment_row_count"]').val();
                        payment_count = parseInt(payment_count) + 1;
                        jQuery('input[name="driver_payment_row_count"]').val(payment_count);

                        var post_url = "profit_changes.php?driver_payment_row_index=" + payment_count + "&selected_payment_mode_id=" + selected_payment_mode_id + "&selected_bank_id=" + selected_bank_id + "&selected_amount=" + selected_amount + "&payment_tax_type=" + payment_tax_type;

                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.driver_payment_row_table tbody').find('tr').length > 0) {
                                    jQuery('.driver_payment_row_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.driver_payment_row_table tbody').append(result);
                                }
                                if (jQuery('select[name="driver_selected_payment_mode_id"]').length > 0) {
                                    jQuery('select[name="driver_selected_payment_mode_id"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="driver_selected_bank_id"]').length > 0) {
                                    jQuery('select[name="driver_selected_bank_id"]').val('').trigger('change');
                                }
                                if (jQuery('input[name="driver_selected_amt"]').length > 0) {
                                    jQuery('input[name="driver_selected_amt"]').val('');
                                }
                                if (jQuery('select[name="driver_selected_tax_type"]').length > 0) {
                                    jQuery('select[name="driver_selected_tax_type"]').val('').trigger('change');
                                }
                                if (jQuery('#AccBal').length > 0) {
                                    jQuery('#AccBal').html('');
                                }
                                PaymentDriverRowTotal();
                                SnoDriverCalculation();
                            }
                        });
                    }
                    else {
                        jQuery('.driver_payment_row_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Payment Mode Already Exists</span>');
                    }
                }
                else {
                    jQuery('.driver_payment_row_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check All Details</span>');
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}



function PaymentDriverRowTotal() {
    var total_amount = 0;
    if (jQuery('.driver_payment_row').length > 0) {
        jQuery('.driver_payment_row').each(function () {
            var amount = 0;
            if (jQuery(this).find('input[name="driver_amount[]"]').length > 0) {
                amount = jQuery(this).find('input[name="driver_amount[]"]').val();
                amount = amount.trim();
            }
            if (amount != "" && amount != 0 && typeof amount != "undefined" && amount != null && price_regex.test(amount) !== false) {
                total_amount = parseFloat(amount) + parseFloat(total_amount);
                total_amount = total_amount.toFixed(2);
            }
        });
    }
    if (jQuery('.driver_expense_overall_total').length > 0) {
        jQuery('.driver_expense_overall_total').html('Rs.' + total_amount);
    }
}

function DeleteDriverRow(id_name, row_index) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('#' + id_name + row_index).length > 0) {
                    jQuery('#' + id_name + row_index).remove();
                }
                PaymentDriverRowTotal();
                SnoDriverCalculation();
            }
            else {
                window.location.reload();
            }
        }
    });
}



function SecondGetPayment() {
    var payment_mode_id = ""; var bank_id = ""; var payment_tax_type = "";
    if (jQuery('select[name="driver_selected_tax_type"]').length > 0) {
        payment_tax_type = jQuery('select[name="driver_selected_tax_type"]').val();
        payment_tax_type = jQuery.trim(payment_tax_type);
    }
   if (jQuery('.second_payment').length > 0) {
        jQuery('.second_payment').html('');
    }
    if (jQuery('input[name="second_available_balance"]').length > 0) {
        jQuery('input[name="second_available_balance"]').val('');
    }
    if (jQuery('select[name="second_selected_payment_mode_id"]').length > 0) {
        payment_mode_id = jQuery('select[name="second_selected_payment_mode_id"]').val();
        payment_mode_id = jQuery.trim(payment_mode_id);
    }

    if (jQuery('select[name="second_selected_bank_id"]').length > 0) {
        bank_id = jQuery('select[name="second_selected_bank_id"]').val();
        bank_id = jQuery.trim(bank_id);
    }

    var post_url = "payment_bill_changes.php?get_payment_mode_id=" + payment_mode_id + "&get_bank_id=" + bank_id + "&get_payment_tax_type=" + payment_tax_type;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            if (result != '') {
                if (jQuery('#driver_bank_list').hasClass('d-none')){

                    if (jQuery('.second_payment').length > 0) {
                        jQuery('.second_payment').html("Available Balance Rs." + result);
                    }
                    if (jQuery('input[name="second_available_balance"]').length > 0) {
                        jQuery('input[name="second_available_balance"]').val(result);
                    }
                }else{
                    if(bank_id != ""){
                        if (jQuery('.second_payment').length > 0) {
                            jQuery('.second_payment').html("Available Balance Rs." + result);
                        }
                        if (jQuery('input[name="second_available_balance"]').length > 0) {
                            jQuery('input[name="second_available_balance"]').val(result);
                        }
                    }else{
                           if (jQuery('.second_payment').length > 0) {
                            jQuery('.second_payment').html('');
                        }
                        if (jQuery('input[name="second_available_balance"]').length > 0) {
                            jQuery('input[name="second_available_balance"]').val('');
                        }
                    }

                }
            } else {

                if(result != "" && result == 0){
                    if (jQuery('.second_payment').length > 0) {
                        jQuery('.second_payment').html("Available Balance Rs.0");
                    }
                    if (jQuery('input[name="second_available_balance"]').length > 0) {
                        jQuery('input[name="second_available_balance"]').val('0');
                    }
                }else{
                    if (jQuery('.second_payment').length > 0) {
                        jQuery('.second_payment').html('');
                    }
                    if (jQuery('input[name="second_available_balance"]').length > 0) {
                        jQuery('input[name="second_available_balance"]').val('');
                    }
                }
             
            }
        }
    });
}


function DriverExpenseLossTotal(){
       var driver_expense_cost = 0;
    if(jQuery('input[name="expense_value[]"]').length > 0) {
        jQuery('input[name="expense_value[]"]').each(function () {
            var expense_value = 0;
            expense_value = jQuery(this).val().trim();
            if(expense_value != "" && expense_value != 0 && price_regex.test(expense_value) == false) {
                if(jQuery(this).parent().parent().find('span.infos').length == 0) {
                    jQuery(this).parent().after('<span class="infos">Invalid</span>');
                }
            }
            else {
                if(jQuery(this).parent().parent().find('span.infos').length > 0) {
                    jQuery(this).parent().parent().find('span.infos').remove();
                }
                if (price_regex.test(expense_value)) {
                    driver_expense_cost += parseFloat(expense_value);
                }
            }
            
        });
    }
   var driver_diesel_amount = 0;
    if(jQuery('input[name="driver_diesel_amount"]').length > 0) {
        
        driver_diesel_amount = jQuery('input[name="driver_diesel_amount"]').val().trim();
        if(driver_diesel_amount != "" && driver_diesel_amount != 0 && price_regex.test(driver_diesel_amount) == false) {
            if(jQuery('input[name="driver_diesel_amount"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="driver_diesel_amount"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="driver_diesel_amount"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="driver_diesel_amount"]').parent().parent().find('span.infos').remove();
            }
        }
    }

        var driver_trip_cost = 0;
    if(price_regex.test(driver_diesel_amount) !== false && price_regex.test(driver_expense_cost) !== false) {
        driver_trip_cost = parseFloat(driver_diesel_amount) + parseFloat(driver_expense_cost);
        driver_trip_cost = driver_trip_cost.toFixed(2);
        if(jQuery('.trip_cost').length > 0) {
            jQuery('.trip_cost').html(driver_trip_cost);
        }
        if(jQuery('input[name="trip_cost"]').length > 0) {
            jQuery('input[name="trip_cost"]').val(driver_trip_cost);
        }
    } 
    else {
        if(jQuery('.trip_cost').length > 0) {
            jQuery('.trip_cost').html('');
        }
        if(jQuery('input[name="trip_cost"]').length > 0) {
            jQuery('input[name="trip_cost"]').val('');
        }
    }
}