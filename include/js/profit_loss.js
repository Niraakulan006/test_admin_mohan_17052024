var number_regex = /^\d+$/;
var price_regex = /^(\d*\.)?\d+$/;

function GetTripsheet() {
    var vehicle_id = "";
    if(jQuery('select[name="vehicle_id"]').length > 0) {
        vehicle_id = jQuery('select[name="vehicle_id"]').val().trim();
    }
    var post_url = "tripsheet_profit_loss_changes.php?get_tripsheet_no="+vehicle_id;
    jQuery.ajax({
        url: post_url, success : function(result) {
            if(jQuery('select[name="from_tripsheet_id"]').length > 0) {
                jQuery('select[name="from_tripsheet_id"]').html(result);
                jQuery('select[name="from_tripsheet_id"]').trigger('change');
            }

        }
    });
}

function GetToTripsheet() {
    var vehicle_id = "";
    if(jQuery('select[name="vehicle_id"]').length > 0) {
        vehicle_id = jQuery('select[name="vehicle_id"]').val().trim();
    }
    var from_tripsheet_id = "";
    if(jQuery('select[name="from_tripsheet_id"]').length > 0) {
        from_tripsheet_id = jQuery('select[name="from_tripsheet_id"]').val().trim();
    }
    var post_url = "tripsheet_profit_loss_changes.php?get_to_tripsheet="+vehicle_id+"&from_tripsheet_id_list="+from_tripsheet_id;
    jQuery.ajax({
        url: post_url, success : function(result) {
            if(jQuery('select[name="to_tripsheet_id"]').length > 0) {
                jQuery('select[name="to_tripsheet_id"]').html(result);
            }
            getTripsheetRow();
        }
    });
}


function getTripsheetRow() {
    var from_tripsheet_id = "";
    if(jQuery('select[name="from_tripsheet_id"]').length > 0) {
        from_tripsheet_id = jQuery('select[name="from_tripsheet_id"]').val().trim();
    }
    var to_tripsheet_id = "";
    if(jQuery('select[name="to_tripsheet_id"]').length > 0) {
        to_tripsheet_id = jQuery('select[name="to_tripsheet_id"]').val().trim();
    }
    var post_url = "tripsheet_profit_loss_changes.php?get_from_id_row="+from_tripsheet_id+"&get_to_id_row="+to_tripsheet_id;
    jQuery.ajax({
        url: post_url, success : function(result) {
            result = result.trim();
            if(jQuery('.trip_details_table').find('tbody').length > 0) {
                jQuery('.trip_details_table').find('tbody').html(result);
            }
            if(jQuery('.trip_details_div').length > 0) {
                if(result != "") {
                    jQuery('.trip_details_div').removeClass('d-none');
                }
                else {
                    jQuery('.trip_details_div').addClass('d-none');
                }
            }
            ProfitLossTotal();

        }
    });
}

function AddExpenseRow() {
    var post_url = "tripsheet_profit_loss_changes.php?add_expense_row=1";
    jQuery.ajax({
        url: post_url, success : function(result) {
            result = result.trim();
            if(jQuery('.trip_expense_table').find('tr.expense_row').length > 0) {
                jQuery('.trip_expense_table').find('tr.expense_row:last').after(result);
            }
            else {
                if(jQuery('.trip_expense_table').find('tr.driver_expense_row').length > 0) {
                    jQuery('.trip_expense_table').find('tr.driver_expense_row').before(result);
                }
            }
            SnoCalcPlus();
        }
    });
}

function DeleteExpenseRow(obj) {
    if(jQuery(obj).closest('tr').length > 0) {
        jQuery(obj).closest('tr').remove();
    }
    ProfitLossTotal();
} 

function ProfitLossTotal() {
    var from_tripsheet_rent = 0;
    if(jQuery('input[name="from_tripsheet_rent"]').length > 0) {
        from_tripsheet_rent = jQuery('input[name="from_tripsheet_rent"]').val().trim();
        if(from_tripsheet_rent != "" && from_tripsheet_rent != 0 && price_regex.test(from_tripsheet_rent) == false) {
            if(jQuery('input[name="from_tripsheet_rent"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="from_tripsheet_rent"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="from_tripsheet_rent"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="from_tripsheet_rent"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var to_tripsheet_rent = 0;
    if(jQuery('input[name="to_tripsheet_rent"]').length > 0) {
        to_tripsheet_rent = jQuery('input[name="to_tripsheet_rent"]').val().trim();
        if(to_tripsheet_rent != "" && to_tripsheet_rent != 0 && price_regex.test(to_tripsheet_rent) == false) {
            if(jQuery('input[name="to_tripsheet_rent"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="to_tripsheet_rent"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="to_tripsheet_rent"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="to_tripsheet_rent"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var total_rent = 0;
    if(price_regex.test(from_tripsheet_rent) !== false && price_regex.test(to_tripsheet_rent) !== false) {
        total_rent = parseFloat(from_tripsheet_rent) + parseFloat(to_tripsheet_rent);
        total_rent = total_rent.toFixed(2);
        if(jQuery('.total_rent').length > 0) {
            jQuery('.total_rent').html(total_rent);
        }
        if(jQuery('input[name="total_rent"]').length > 0) {
            jQuery('input[name="total_rent"]').val(total_rent);
        }
    }
    else {
        if(jQuery('.total_rent').length > 0) {
            jQuery('.total_rent').html('');
        }
        if(jQuery('input[name="total_rent"]').length > 0) {
            jQuery('input[name="total_rent"]').val('');
        }
    }
    var ending_km = 0;
    if(jQuery('input[name="ending_km"]').length > 0) {
        ending_km = jQuery('input[name="ending_km"]').val().trim();
        if(ending_km != "" && ending_km != 0 && price_regex.test(ending_km) == false) {
            if(jQuery('input[name="ending_km"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="ending_km"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="ending_km"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="ending_km"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var starting_km = 0;
    if(jQuery('input[name="starting_km"]').length > 0) {
        starting_km = jQuery('input[name="starting_km"]').val().trim();
        if(starting_km != "" && starting_km != 0 && price_regex.test(starting_km) == false) {
            if(jQuery('input[name="starting_km"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="starting_km"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="starting_km"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="starting_km"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var travelled_km = 0;
    if(price_regex.test(ending_km) !== false && price_regex.test(starting_km) !== false) {
        travelled_km = parseFloat(ending_km) - parseFloat(starting_km);
        travelled_km = travelled_km.toFixed(2);
        if(jQuery('.travelled_km').length > 0) {
            jQuery('.travelled_km').html(travelled_km);
        }
        if(jQuery('input[name="travelled_km"]').length > 0) {
            jQuery('input[name="travelled_km"]').val(travelled_km);
        }
    }
    else {
        if(jQuery('.travelled_km').length > 0) {
            jQuery('.travelled_km').html('');
        }
        if(jQuery('input[name="travelled_km"]').length > 0) {
            jQuery('input[name="travelled_km"]').val('');
        }
    }
    var diesel = 0;
    if(jQuery('input[name="diesel"]').length > 0) {
        diesel = jQuery('input[name="diesel"]').val().trim();
        if(diesel != "" && diesel != 0 && price_regex.test(diesel) == false) {
            if(jQuery('input[name="diesel"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="diesel"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="diesel"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="diesel"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var diesel_cost_per_litre = 0;
    if(jQuery('input[name="diesel_cost_per_litre"]').length > 0) {
        diesel_cost_per_litre = jQuery('input[name="diesel_cost_per_litre"]').val().trim();
        if(diesel_cost_per_litre != "" && diesel_cost_per_litre != 0 && price_regex.test(diesel_cost_per_litre) == false) {
            if(jQuery('input[name="diesel_cost_per_litre"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="diesel_cost_per_litre"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="diesel_cost_per_litre"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="diesel_cost_per_litre"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var mileage = 0;
    if(price_regex.test(travelled_km) !== false && price_regex.test(diesel) !== false) {
        mileage = parseFloat(travelled_km) / parseFloat(diesel);
        mileage = mileage.toFixed(2);
        if(jQuery('.mileage_span').length > 0) {
            jQuery('.mileage_span').removeClass('d-none');
        }
        if(jQuery('.mileage').length > 0) {
            jQuery('.mileage').html(mileage);
        }
        if(jQuery('input[name="mileage"]').length > 0) {
            jQuery('input[name="mileage"]').val(mileage);
        }
    }
    else {
        if(jQuery('.mileage_span').length > 0) {
            jQuery('.mileage_span').addClass('d-none');
        }
        if(jQuery('.mileage').length > 0) {
            jQuery('.mileage').html('');
        }
        if(jQuery('input[name="mileage"]').length > 0) {
            jQuery('input[name="mileage"]').val('');
        }
    }
    var trip_cost = 0;
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
            }
            if(price_regex.test(expense_value) !== false) {
                trip_cost = parseFloat(trip_cost) + parseFloat(expense_value);
                trip_cost = trip_cost.toFixed(2);
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
    var advance = 0;
    if(jQuery('input[name="advance"]').length > 0) {
        advance = jQuery('input[name="advance"]').val().trim();
        if(advance != "" && advance != 0 && price_regex.test(advance) == false) {
            if(jQuery('input[name="advance"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="advance"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="advance"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="advance"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    if(price_regex.test(driver_diesel_amount) !== false) {
        trip_cost = parseFloat(trip_cost) + parseFloat(driver_diesel_amount);
        trip_cost = trip_cost.toFixed(2);
    }
    if(price_regex.test(advance) !== false) {
        trip_cost = parseFloat(trip_cost) + parseFloat(advance);
        trip_cost = trip_cost.toFixed(2);
    }
    if(price_regex.test(trip_cost) !== false) {
        if(jQuery('.trip_cost').length > 0) {
            jQuery('.trip_cost').html(trip_cost);
        }
        if(jQuery('input[name="trip_cost"]').length > 0) {
            jQuery('input[name="trip_cost"]').val(trip_cost);
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
    var trip_balance = 0;
    if(price_regex.test(total_rent) !== false && price_regex.test(trip_cost) !== false) {
        trip_balance = parseFloat(total_rent) - parseFloat(trip_cost);
        trip_balance = trip_balance.toFixed(2);
        if(jQuery('.trip_balance').length > 0) {
            jQuery('.trip_balance').html(trip_balance);
        }
        if(jQuery('input[name="trip_balance"]').length > 0) {
            jQuery('input[name="trip_balance"]').val(trip_balance);
        }
    }
    else {
        if(jQuery('.trip_balance').length > 0) {
            jQuery('.trip_balance').html('');
        }
        if(jQuery('input[name="trip_balance"]').length > 0) {
            jQuery('input[name="trip_balance"]').val('');
        }
    }
    var loading_wage = 0;
    if(jQuery('input[name="loading_wage"]').length > 0) {
        loading_wage = jQuery('input[name="loading_wage"]').val().trim();
        if(loading_wage != "" && loading_wage != 0 && price_regex.test(loading_wage) == false) {
            if(jQuery('input[name="loading_wage"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="loading_wage"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="loading_wage"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="loading_wage"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var night_food = 0;
    if(jQuery('input[name="night_food"]').length > 0) {
        night_food = jQuery('input[name="night_food"]').val().trim();
        if(night_food != "" && night_food != 0 && price_regex.test(night_food) == false) {
            if(jQuery('input[name="night_food"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="night_food"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="night_food"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="night_food"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var driver_salary = 0;
    if(jQuery('input[name="driver_salary"]').length > 0) {
        driver_salary = jQuery('input[name="driver_salary"]').val().trim();
        if(driver_salary != "" && driver_salary != 0 && price_regex.test(driver_salary) == false) {
            if(jQuery('input[name="driver_salary"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="driver_salary"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="driver_salary"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="driver_salary"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var tire_depreciation = 0;
    if(jQuery('input[name="tire_depreciation"]').length > 0) {
        tire_depreciation = jQuery('input[name="tire_depreciation"]').val().trim();
        if(tire_depreciation != "" && tire_depreciation != 0 && price_regex.test(tire_depreciation) == false) {
            if(jQuery('input[name="tire_depreciation"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="tire_depreciation"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="tire_depreciation"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="tire_depreciation"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var toll_gate = 0;
    if(jQuery('input[name="toll_gate"]').length > 0) {
        toll_gate = jQuery('input[name="toll_gate"]').val().trim();
        if(toll_gate != "" && toll_gate != 0 && price_regex.test(toll_gate) == false) {
            if(jQuery('input[name="toll_gate"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="toll_gate"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="toll_gate"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="toll_gate"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var total_trip_calc = 0;
    if(jQuery('.trip_calc').length > 0) {
        jQuery('.trip_calc').each(function (){
            var trip_calc = 0;
            trip_calc = jQuery(this).val().trim();
            if(price_regex.test(trip_calc) !== false) {
                total_trip_calc = parseFloat(total_trip_calc) + parseFloat(trip_calc);
                total_trip_calc = total_trip_calc.toFixed(2);
            }
        });
    }
    var net_balance = 0; 
    if(price_regex.test(trip_balance) !== false && price_regex.test(total_trip_calc) !== false) {
        net_balance = parseFloat(trip_balance) - parseFloat(total_trip_calc);
        net_balance = net_balance.toFixed(2);
        if(parseFloat(net_balance) > 0) {
            if(jQuery('.net_balance').length > 0) {
                jQuery('.net_balance').html(net_balance);
            }
            if(jQuery('input[name="net_balance"]').length > 0) {
                jQuery('input[name="net_balance"]').val(net_balance);
            }
        }
        else {
            if(jQuery('.net_balance').length > 0) {
                jQuery('.net_balance').html('<span class="infos">Invalid</span>');
            }
            if(jQuery('input[name="net_balance"]').length > 0) {
                jQuery('input[name="net_balance"]').val('');
            }
        }
    }
    else {
        if(jQuery('.net_balance').length > 0) {
            jQuery('.net_balance').html('');
        }
        if(jQuery('input[name="net_balance"]').length > 0) {
            jQuery('input[name="net_balance"]').val('');
        }
    }
    SnoCalcPlus();
}

function SnoCalcPlus() {
    var snoElements = document.getElementsByClassName('sno');
    if (snoElements.length > 0) {
        for (var i = 0; i < snoElements.length; i++) {
            snoElements[i].innerHTML = i + 1;
        }
    }
    var snoElements = document.getElementsByClassName('company_sno');
    if (snoElements.length > 0) {
        for (var i = 0; i < snoElements.length; i++) {
            snoElements[i].innerHTML = i + 1;
        }
    }
}


function AddCompanyExpenseRow() {
    var post_url = "tripsheet_profit_loss_changes.php?add_company_expense_row=1";
    jQuery.ajax({
        url: post_url, success : function(result) {
            result = result.trim();
            if(jQuery('.company_expense_table').find('tr.company_expense_row').length > 0) {
                jQuery('.company_expense_table').find('tr.company_expense_row:last').after(result);
            }
            else {
                if(jQuery('.company_expense_table').find('tr.company_diesel_row').length > 0) {
                    jQuery('.company_expense_table').find('tr.company_diesel_row').after(result);
                }
            }
            SnoCalcPlus();
        }
    });
}
function DeleteCompanyExpenseRow(obj) {
    if(jQuery(obj).closest('tr').length > 0) {
        jQuery(obj).closest('tr').remove();
    }
} 
function DeleteDriverExpenseRow(obj) {
    if(jQuery(obj).closest('tr').length > 0) {
        jQuery(obj).closest('tr').remove();
    }
    ProfitLossTotal();
} 

function OpenExpenseModalold() {
  	form_name=jQuery('form').attr('name');
	if(jQuery('.expense_modal_button').length > 0) {
		var post_url = "expense_changes.php?show_expense_id=&add_expense=1"+"&expense_id="+expense_id+"&form_name="+form_name;
		jQuery.ajax({url: post_url, success: function(result){
			result = result.trim();
			if(result != "" && typeof result != "undefined" && result != null) {
                if(jQuery('#ExpenseModal').find('.modal-body').length > 0) {
					jQuery('#ExpenseModal').find('.modal-body').html();
				} 
                
                jQuery('#ExpenseModal').modal("show");
			}
           
		}});
	}
}

function AddExpensePaymentRow() {
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

                        var post_url = "payment_row_changes.php?payment_row_index=" + payment_count + "&selected_payment_mode_id=" + selected_payment_mode_id + "&selected_bank_id=" + selected_bank_id + "&selected_amount=" + selected_amount + "&payment_tax_type=" + payment_tax_type;

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
                                PaymentExpenseTotal();
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


function PaymentExpenseTotal() {
    var total_amount = 0;
    if (jQuery('.payment_row').length > 0) {
        jQuery('.payment_row').each(function () {
            var amount = 0;
            if (jQuery(this).find('input[name="expense_amount[]"]').length > 0) {
                amount = jQuery(this).find('input[name="expense_amount[]"]').val();
                amount = amount.trim();
            }
            if (amount != "" && amount != 0 && typeof amount != "undefined" && amount != null && price_regex.test(amount) !== false) {
                total_amount = parseFloat(amount) + parseFloat(total_amount);
                total_amount = total_amount.toFixed(2);
            }
        });
    }
    if (jQuery('.expense_overall_total').length > 0) {
        jQuery('.expense_overall_total').html('Rs.' + total_amount);
    }
}


function SnoExpenseCalculation() {
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
function DeleteExpenseRow(id_name, row_index) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('#' + id_name + row_index).length > 0) {
                    jQuery('#' + id_name + row_index).remove();
                }
                PaymentExpenseTotal();
                SnoVoucherCalculation();
            }
            else {
                window.location.reload();
            }
        }
    });
}

function ExpenseModalOpen() {
    var driver_expense_type =""; var company_expense_type = "";
        if (jQuery('input[name="company_expense_type"]:checked').length > 0) {
            company_expense_type = jQuery('input[name="company_expense_type"]:checked').val();
        }

        if (jQuery('input[name="driver_expense_type"]:checked').length > 0) {
            driver_expense_type = jQuery('input[name="driver_expense_type"]:checked').val();
        }
        // alert(company_expense_type +"/"+ driver_expense_type)
        if(company_expense_type == 'Paid' || driver_expense_type == 'Paid'){
            jQuery('#ExpenseModal').modal("show");

        }
}


function PaymentDriverExpenseTotal() {
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
    if (jQuery('.driver_diesel_overall_total').length > 0) {
        jQuery('.driver_diesel_overall_total').html('Rs.' + total_amount);
    }
}

function SnoDriverCalculation() {
    if (jQuery('.driver_payment_sno').length > 0) {
        var row_count = 0;
        row_count = jQuery('.driver_payment_sno').length;
        if (typeof row_count != "undefined" && row_count != null && row_count != 0 && row_count != "") {
            var j = 1;
            var sno = document.getElementsByClassName('driver_payment_sno');
            for (var i = row_count - 1; i >= 0; i--) {
                sno[i].innerHTML = j;
                j = parseInt(j) + 1;
            }
        }
    }
}



function checkValidation() {
    var formData = jQuery('form[name="tripsheet_profit_loss_form"]').serialize();
    var post_url = "profit_changes.php?checkvalidation=1";
    var form_name = "tripsheet_profit_loss_form";
    var overall_total = 0;
    if (jQuery('.overall_total').length > 0) {
        overall_total = jQuery('.overall_total').html();
    }
    jQuery.ajax({
        url: post_url,
        type: "POST",
        data: formData,
        dataType: 'html',
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        success: function (result) {
            try {
                var x = JSON.parse(result);
            } catch (e) {
                return false;
            }
            console.log(x);
            if (jQuery('span.infos').length > 0) {
                jQuery('span.infos').remove();
            }
            if (jQuery('.valid_error').length > 0) {
                jQuery('.valid_error').remove();
            }
            if (jQuery('div.alert').length > 0) {
                jQuery('div.alert').remove();
            }
            if (x.number == '1') {
                    var driver_expense_type =""; var company_expense_type = "";
				if (jQuery('input[name="company_expense_type"]:checked').length > 0) {
					company_expense_type = jQuery('input[name="company_expense_type"]:checked').val();
				}

				if (jQuery('input[name="driver_expense_type"]:checked').length > 0) {
					driver_expense_type = jQuery('input[name="driver_expense_type"]:checked').val();
				}
                if (jQuery('input[name="driver_diesel_amount"]').length > 0) {
					driver_diesel_amount = jQuery('input[name="driver_diesel_amount"]').val();
                }
                if (jQuery('input[name="company_diesel_amount"]').length > 0) {
					company_diesel_amount = jQuery('input[name="company_diesel_amount"]').val();
                }
                  var edit_id = "";    var hidden_driver_expense_type = ""; var hidden_company_expense_type = "";


                if (jQuery('input[name="edit_id"]').length > 0) {
					edit_id = jQuery('input[name="edit_id"]').val();
                }
                if (jQuery('input[name="hidden_driver_expense_type"]').length > 0) {
					hidden_driver_expense_type = jQuery('input[name="hidden_driver_expense_type"]').val();
                }
                if (jQuery('input[name="hidden_company_expense_type"]').length > 0) {
					hidden_company_expense_type = jQuery('input[name="hidden_company_expense_type"]').val();
                }

                if(edit_id != ""){
                    if((hidden_driver_expense_type == 'Paid')  && (hidden_company_expense_type == 'Paid')){
                        SaveModalContent(form_name, 'tripsheet_profit_loss_changes.php', 'tripsheet_profit_loss.php');
                    }else if(hidden_driver_expense_type == 'Credit' &&  driver_expense_type == 'Paid'){
                          jQuery('.driver_expense_section').removeClass('d-none');
                            jQuery('#driver_diesel_amount_display').html('<bold>Driver Diesel Expense</bold><br><span style="color:green;">Driver Diesel Expense Amount: Rs. ' + driver_diesel_amount + '</span>');

                            jQuery('.company_expense_section').addClass('d-none');
                            jQuery('#company_diesel_amount_display').html('');
                    }else if(hidden_company_expense_type == 'Credit' &&  company_expense_type == 'Paid'){
                            jQuery('.driver_expense_section').addClass('d-none');
                            jQuery('#driver_diesel_amount_display').html('');
                            jQuery('.company_expense_section').removeClass('d-none');
                            jQuery('#company_diesel_amount_display').html('<bold>Company Diesel Expense</bold><br><span style="color:green;">Company Diesel Expense Amount: Rs. ' + company_diesel_amount + '</span>');
                    }else{
                        SaveModalContent(form_name, 'tripsheet_profit_loss_changes.php', 'tripsheet_profit_loss.php');
                    }
                }
                else{
                    if(company_expense_type == 'Paid' || driver_expense_type == 'Paid'){
                        
                        var modal = new bootstrap.Modal(document.getElementById('ExpenseModal'));
                        modal.show();
                            // alert(driver_expense_type + "///"+ company_expense_type);
                            if(driver_expense_type == 'Paid' && company_expense_type == 'Paid'){
                                jQuery('.driver_expense_section').removeClass('d-none');
                                jQuery('#driver_diesel_amount_display').html('<bold>Driver Diesel Expense</bold><br><span style="color:green;">Driver Diesel Expense Amount: Rs. ' + driver_diesel_amount + '</span>');

                                jQuery('.company_expense_section').removeClass('d-none');
                                // jQuery('#company_diesel_amount_display').html('Company Diesel Expense Amount: Rs. ' + overall_total);
                                jQuery('#company_diesel_amount_display').html('<bold>Company Diesel Expense</bold><br><span style="color:green;">Company Diesel Expense Amount: Rs. ' + company_diesel_amount + '</span>');

                            }
                            else if (driver_expense_type == 'Paid') {

                                jQuery('.driver_expense_section').removeClass('d-none');
                                jQuery('#driver_diesel_amount_display').html('<bold>Driver Diesel Expense</bold><br><span style="color:green;">Driver Diesel Expense Amount: Rs. ' + driver_diesel_amount + '</span>');

                                jQuery('.company_expense_section').addClass('d-none');
                                jQuery('#company_diesel_amount_display').html('');
                            }

                        else if (company_expense_type == 'Paid') {
                                jQuery('.driver_expense_section').addClass('d-none');
                                jQuery('#driver_diesel_amount_display').html('');

                                jQuery('.company_expense_section').removeClass('d-none');
                                jQuery('#company_diesel_amount_display').html('<bold>Company Diesel Expense</bold><br><span style="color:green;">Company Diesel Expense Amount: Rs. ' + company_diesel_amount + '</span>');
                            }
                    }else{
                            SaveModalContent(form_name, 'tripsheet_profit_loss_changes.php', 'tripsheet_profit_loss.php');

                    }
                }
				
            
                
            }
            else if (x.number == '2') {
                
                jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-danger"> ' + x.msg + ' </div>');
                if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
                    jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
                }
            }
            else if (x.number == '3') {
                jQuery('form[name="' + form_name + '"]').append('<div class="valid_error"> <script type="text/javascript"> ' + x.msg + ' </script> </div>');
                if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
                    jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
                }
            }
        }
    });
}


function mileageCalculation(){
    var ending_km = 0;
    if(jQuery('input[name="ending_km"]').length > 0) {
        ending_km = jQuery('input[name="ending_km"]').val().trim();
        if(ending_km != "" && ending_km != 0 && price_regex.test(ending_km) == false) {
            if(jQuery('input[name="ending_km"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="ending_km"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="ending_km"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="ending_km"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var starting_km = 0;
    if(jQuery('input[name="starting_km"]').length > 0) {
        starting_km = jQuery('input[name="starting_km"]').val().trim();
        if(starting_km != "" && starting_km != 0 && price_regex.test(starting_km) == false) {
            if(jQuery('input[name="starting_km"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="starting_km"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="starting_km"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="starting_km"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var travelled_km = 0;
    if(price_regex.test(ending_km) !== false && price_regex.test(starting_km) !== false) {
        travelled_km = parseFloat(ending_km) - parseFloat(starting_km);
        travelled_km = travelled_km.toFixed(2);
        if(jQuery('.travelled_km').length > 0) {
            jQuery('.travelled_km').html(travelled_km);
        }
        if(jQuery('input[name="travelled_km"]').length > 0) {
            jQuery('input[name="travelled_km"]').val(travelled_km);
        }
    }
    else {
        if(jQuery('.travelled_km').length > 0) {
            jQuery('.travelled_km').html('');
        }
        if(jQuery('input[name="travelled_km"]').length > 0) {
            jQuery('input[name="travelled_km"]').val('');
        }
    }
    var diesel = 0;
    if(jQuery('input[name="diesel"]').length > 0) {
        diesel = jQuery('input[name="diesel"]').val().trim();
        if(diesel != "" && diesel != 0 && price_regex.test(diesel) == false) {
            if(jQuery('input[name="diesel"]').parent().parent().find('span.infos').length == 0) {
                jQuery('input[name="diesel"]').parent().after('<span class="infos">Invalid</span>');
            }
        }
        else {
            if(jQuery('input[name="diesel"]').parent().parent().find('span.infos').length > 0) {
                jQuery('input[name="diesel"]').parent().parent().find('span.infos').remove();
            }
        }
    }
    var mileage = 0;
    if(price_regex.test(travelled_km) !== false && price_regex.test(diesel) !== false) {
        mileage = parseFloat(travelled_km) / parseFloat(diesel);
        mileage = mileage.toFixed(2);
        if(jQuery('.mileage_span').length > 0) {
            jQuery('.mileage_span').removeClass('d-none');
        }
        if(jQuery('.mileage').length > 0) {
            jQuery('.mileage').html(mileage);
        }
        if(jQuery('input[name="mileage"]').length > 0) {
            jQuery('input[name="mileage"]').val(mileage);
        }
    }
    else {
        if(jQuery('.mileage_span').length > 0) {
            jQuery('.mileage_span').addClass('d-none');
        }
        if(jQuery('.mileage').length > 0) {
            jQuery('.mileage').html('');
        }
        if(jQuery('input[name="mileage"]').length > 0) {
            jQuery('input[name="mileage"]').val('');
        }
    }
}

