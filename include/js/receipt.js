var price_regex = /^(\d*\.)?\d+$/;
var numbers_regex =/^(\d*\.)?\d+$/;

function primary_company(receipt_company_id) {
	var intRegex = /^\d+$/;
	if(intRegex.test(receipt_company_id) == true) {
		var post_url = "receipt_changes.php?primary_company_id="+receipt_company_id;
		jQuery.ajax({url: post_url, success: function(primary_company){			
			if(primary_company == 1) {
				
				if(jQuery('input[name="gcno"]').length > 0) {
					jQuery('input[name="gcno"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="receipt_date"]').length > 0) {
					jQuery('input[name="receipt_date"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="consignor_city"]').length > 0) {
					jQuery('input[name="consignor_city"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="consignor_name"]').length > 0) {
					jQuery('input[name="consignor_name"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="consignor_mobile_number"]').length > 0) {
					jQuery('input[name="consignor_mobile_number"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="consignee_city"]').length > 0) {
					jQuery('input[name="consignee_city"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="consignee_name"]').length > 0) {
					jQuery('input[name="consignee_name"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="consignee_mobile_number"]').length > 0) {
					jQuery('input[name="consignee_mobile_number"]').attr('required', 'required');
				}
				
				if(jQuery('textarea[name="receipt_content"]').length > 0) {
					jQuery('textarea[name="receipt_content"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="quantity"]').length > 0) {
					jQuery('input[name="quantity"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="rate"]').length > 0) {
					jQuery('input[name="rate"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="freight"]').length > 0) {
					jQuery('input[name="freight"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="bill_no"]').length > 0) {
					jQuery('input[name="bill_no"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="bill_date"]').length > 0) {
					jQuery('input[name="bill_date"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="bill_value"]').length > 0) {
					jQuery('input[name="bill_value"]').attr('required', 'required');
				}
				
				if(jQuery('input[name="pay_option"]').length > 0) {
					jQuery('input[name="pay_option"]').each(function(){ jQuery(this).attr('required', 'required'); });
				}
				
				/*if(jQuery('input[name="vehicle_no"]').length > 0) {
					jQuery('input[name="vehicle_no"]').attr('required', 'required');
				}*/
				
			}
			else {
				
				if(jQuery('input[name="gcno"]').length > 0) {
					jQuery('input[name="gcno"]').removeAttr('required');
				}
				
				if(jQuery('input[name="receipt_date"]').length > 0) {
					jQuery('input[name="receipt_date"]').removeAttr('required');
				}
				
				if(jQuery('input[name="consignor_city"]').length > 0) {
					jQuery('input[name="consignor_city"]').removeAttr('required');
				}
				
				if(jQuery('input[name="consignor_name"]').length > 0) {
					jQuery('input[name="consignor_name"]').removeAttr('required');
				}
				
				if(jQuery('input[name="consignor_mobile_number"]').length > 0) {
					jQuery('input[name="consignor_mobile_number"]').removeAttr('required');
				}
				
				if(jQuery('input[name="consignee_city"]').length > 0) {
					jQuery('input[name="consignee_city"]').removeAttr('required');
				}
				
				if(jQuery('input[name="consignee_name"]').length > 0) {
					jQuery('input[name="consignee_name"]').removeAttr('required');
				}
				
				if(jQuery('input[name="consignee_mobile_number"]').length > 0) {
					jQuery('input[name="consignee_mobile_number"]').removeAttr('required');
				}
				
				if(jQuery('textarea[name="receipt_content"]').length > 0) {
					jQuery('textarea[name="receipt_content"]').removeAttr('required');
				}
				
				if(jQuery('input[name="quantity"]').length > 0) {
					jQuery('input[name="quantity"]').removeAttr('required');
				}
				
				if(jQuery('input[name="rate"]').length > 0) {
					jQuery('input[name="rate"]').removeAttr('required');
				}
				
				if(jQuery('input[name="freight"]').length > 0) {
					jQuery('input[name="freight"]').removeAttr('required');
				}
				
				if(jQuery('input[name="bill_no"]').length > 0) {
					jQuery('input[name="bill_no"]').removeAttr('required');
				}
				
				if(jQuery('input[name="bill_date"]').length > 0) {
					jQuery('input[name="bill_date"]').removeAttr('required');
				}
				
				if(jQuery('input[name="bill_value"]').length > 0) {
					jQuery('input[name="bill_value"]').removeAttr('required');
				}
				
				if(jQuery('input[name="pay_option"]').length > 0) {
					jQuery('input[name="pay_option"]').each(function(){ jQuery(this).removeAttr('required'); });
				}
				
				/*if(jQuery('input[name="vehicle_no"]').length > 0) {
					jQuery('input[name="vehicle_no"]').removeAttr('required');
				}*/
				
			}
			
		}});
	}
	
	ShowGST();
}

function getReceiptNumber() {
	var receipt_company_id = jQuery('select[name="company_id"]').val();
	if(receipt_company_id != "") {
		var post_url = "receipt_changes.php?get_company_receipt_number="+receipt_company_id;
		jQuery.ajax({url: post_url, success: function(receipt_number){
			receipt_number = receipt_number.split("$$$");
			if(jQuery('input[name="gcno"]').length > 0) {
				// jQuery('input[name="gcno"]').val(receipt_number[0]);
			}
			if(jQuery('input[name="tax_percentage"]').length > 0) {
				jQuery('input[name="tax_percentage"]').val(receipt_number[1]);
				jQuery('input[name="tax_perc"]').val(receipt_number[1]);
			}
		}});
	}
	else {
		// if(jQuery('input[name="gcno"]').length > 0) {
		// 	jQuery('input[name="gcno"]').val('');
		// }
	}
}

function check_decimal(check_number) {
	if(check_number != '' && check_number != 0) {				
		var decimal = ""; var round_off = ''; var numbers = "";
		numbers = check_number.toString().split('.');							
		if( typeof numbers[1] != 'undefined') {
			decimal = numbers[1];
		}
		if(decimal != "" && decimal != 00) {						
			if(decimal.length == 1) {
				decimal = decimal+'0';
				check_number = numbers[0]+'.'+decimal;
			}
			if(decimal.length > 2) {
				check_number = check_number.toFixed(2);
			}
		}
		else {
			check_number = numbers[0]+'.00';
		}
	}
	return check_number;
}

function getFright() {
	var freight = "";
	quantity_regex = /^(\d*\.)?\d+$/;
	var quantity = jQuery('input[name="selected_quantity"]').val();
	var rate = jQuery('input[name="selected_rate"]').val();

	if(jQuery('input[name="selected_quantity"]').parent().find('.infos').length > 0) {
		jQuery('input[name="selected_quantity"]').parent().find('.infos').remove();
	}

	if(jQuery('input[name="selected_rate"]').parent().find('.infos').length > 0) {
		jQuery('input[name="selected_rate"]').parent().find('.infos').remove();
	}
	
	quantity = jQuery.trim(quantity);
	jQuery('input[name="selected_quantity"]').val(quantity);
	rate = jQuery.trim(rate);
	jQuery('input[name="selected_rate"]').val(rate);

	var intRegex = /^\d+$/;
	if(quantity!=''){
		if(quantity_regex.test(quantity) == false) {
			jQuery('input[name="selected_amount"]').val('');
			jQuery('input[name="selected_quantity"]').parent().append('<span class="infos">Invalid Quantity</span>');
			quantity = "";
		}
	}

	if(rate!=''){
		if(quantity_regex.test(rate) == false) {
			jQuery('input[name="selected_amount"]').val('');
			jQuery('input[name="selected_rate"]').parent().append('<span class="infos">Invalid Rate</span>');
			rate = "";
		}
	}
	
	if(quantity != '' && rate != ''){
		freight = check_decimal(parseFloat(quantity) * parseFloat(rate));
		if(quantity_regex.test(freight) == true) {
			jQuery('input[name="selected_amount"]').val(freight);
			ShowGST();
		}
		else {
			jQuery('input[name="selected_amount"]').val('');
		}
	}
	else {
		jQuery('input[name="selected_amount"]').val('');
	}
}

function check_cooly(){
	cooly_regex = /^(\d*\.)?\d+$/;
	var cooly = jQuery('input[name="cooly"]').val();

	if(jQuery('input[name="cooly"]').parent().find('.infos').length > 0) {
		jQuery('input[name="cooly"]').parent().find('.infos').remove();
	}

	if(cooly != ''){
		if(cooly_regex.test(cooly) == false) {
			jQuery('input[name="cooly"]').parent().append('<span class="infos">Invalid Cooly</span>');
		}
	}
}

function check_bill_value(){
	bill_value_regex = /^(\d*\.)?\d+$/;
	var bill_value = jQuery('input[name="bill_value"]').val();

	if(jQuery('input[name="bill_value"]').parent().find('.infos').length > 0) {
		jQuery('input[name="bill_value"]').parent().find('.infos').remove();
	}
	if(bill_value != ''){
		if(bill_value_regex.test(bill_value) == false) {
			jQuery('input[name="bill_value"]').parent().append('<span class="infos">Invalid Bill value</span>');
		}
	}
}

function getClientDetails(obj, list_id) {
	var input, filter, ul, li, a, i;
    input = jQuery(obj);
    filter = input.val().toUpperCase();
	if(filter != '') {
		jQuery('#'+list_id).show();
		ul = document.getElementById(list_id);
		li = jQuery('li.display'); //ul.getElementsByTagName('li.display');
		var all_none = 0;
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("a")[0];
			if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
				li[i].style.display = "";
			} else {
				li[i].style.display = "none";
				all_none = parseInt(all_none) + 1;
			}
		}
		if(all_none == li.length) {
			jQuery('#'+list_id).hide();
		}
	}
	else {
		jQuery('#'+list_id).hide();
	}
}

function hide_list(list_id) {
	jQuery('#'+list_id).hide();
}

function SelectPayOption(obj) {
	var radio = jQuery(obj).parent().find('input[type="radio"]');
	if(jQuery(radio).is(':checked') == false)
		jQuery(radio).prop('checked', true);
	else
		jQuery(radio).prop("checked", false);
}

function changeReceiptContent(receipt_content, content) {
	if(receipt_content == "Others") {
		if(jQuery('.receipt_other_content').length > 0) {
			jQuery('.receipt_other_content').css({"display" : "inline-block"});
			if(jQuery('input[name="receipt_other_content"]').length > 0) {
				jQuery('input[name="receipt_other_content"]').val(content);
			}
		}
	}
	else {
		if(jQuery('.receipt_other_content').length > 0) {
			jQuery('.receipt_other_content').css({"display" : "none"});
			if(jQuery('input[name="receipt_other_content"]').length > 0) {
				jQuery('input[name="receipt_other_content"]').val('');
			}
		}
	}
}

function AddCNRCustomClient(){
	$(jQuery('select[name="cnr_client_id"]')).val("");
	$(jQuery('select[name="cnr_client_id"]')).trigger("change");
	$("#cnr_client_display").addClass('d-none')
	$("#cnr_custom_client_display").removeClass('d-none')
	$("#consignor_mobile_number").val("");
	$("#cnr_client_name").focus();
	$(jQuery('input[name="consignor_mobile_number"]')).val("");
	$(jQuery('input[name="consignor_gst_number"]')).val("");
	$(jQuery('input[name="consignor_identification"]')).val("");
	$(jQuery('input[name="consignee_city"]')).val("");
}

function AddCNECustomClient(){
	$(jQuery('select[name="cne_client_id"]')).val("");
	$(jQuery('select[name="cne_client_id"]')).trigger("change");
	$("#cne_client_display").addClass('d-none')
	$("#cne_custom_client_display").removeClass('d-none')
	$("#consignee_mobile_number").val("");
	$("#cne_client_name").focus();
	
	$(jQuery('input[name="consignee_mobile_number"]')).val("");
	$(jQuery('input[name="consignee_gst_number"]')).val("");
	$(jQuery('input[name="consignee_identification"]')).val("");
	$(jQuery('select[name="consignee_state"]')).val("");
	$(jQuery('select[name="consignee_state"]')).trigger("change");
	$(jQuery('input[name="consignee_city"]')).val("");
}

function removeCNRCustomClient(){
	$("#cnr_client_display").removeClass('d-none')
	$("#cnr_custom_client_display").addClass('d-none')
	$("#cnr_client_name").val("");
	$(jQuery('input[name="consignor_mobile_number"]')).val("");
	$(jQuery('input[name="consignor_gst_number"]')).val("");
	$(jQuery('input[name="consignor_identification"]')).val("");
	$(jQuery('input[name="consignee_city"]')).val("");
}

function removeCNECustomClient(){
	$("#cne_client_display").removeClass('d-none')
	$("#cne_custom_client_display").addClass('d-none')
	$("#cne_client_name").val("");
	$(jQuery('input[name="consignee_mobile_number"]')).val("");
	$(jQuery('input[name="consignee_gst_number"]')).val("");
	$(jQuery('input[name="consignee_identification"]')).val("");
	$(jQuery('input[name="consignee_state"]')).trigger("change");
	$(jQuery('input[name="consignee_city"]')).val("");
}

function load_mobile_number(value, type){
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({url: post_url, success: function(check_login_session){
		if(check_login_session == 1) {

			var post_url = "common_changes.php?load_mobile_number=1&client_id="+value+"&client_type="+type;	
			jQuery.ajax({url: post_url, success: function(client_list){
				
				var client_details = client_list.split("$$$");
				var client_mobile = client_details[0];
				var client_city = client_details[1];
				var client_state = client_details[2];
				var client_gst_number = client_details[3];
				var client_identification = client_details[4];

				if(type == "cnr"){
					if(jQuery('input[name="consignor_mobile_number"]').length > 0) {
						jQuery('input[name="consignor_mobile_number"]').val(client_mobile);
					}

					if(jQuery('input[name="consignor_city"]').length > 0) {
						jQuery('input[name="consignor_city"]').val(client_city);
					}
					if(jQuery('input[name="consignor_gst_number"]').length > 0) {
						jQuery('input[name="consignor_gst_number"]').val(client_gst_number);
					}
					if(jQuery('input[name="consignor_identification"]').length > 0) {
						jQuery('input[name="consignor_identification"]').val(client_identification);
					}
				}
				else if(type == "cne"){
					if(jQuery('input[name="consignee_mobile_number"]').length > 0) {
						jQuery('input[name="consignee_mobile_number"]').val(client_mobile);
					}

					if(jQuery('select[name="city"]').length > 0) {
						jQuery('select[name="city"]').val(client_city);
						print_city(client_city)
					}
					if(jQuery('input[name="consignee_gst_number"]').length > 0) {
						jQuery('input[name="consignee_gst_number"]').val(client_gst_number);
					}
					if(jQuery('input[name="consignee_identification"]').length > 0) {
						jQuery('input[name="consignee_identification"]').val(client_identification);
					}
					print_state(client_state);
				}
				show_rate();
			}});
			
		}
		else {
			window.location.reload();
		}
	}});
}

function ShowGST(){
	if(jQuery('.sno').length > 0 ) {
		var row_count = 0;
		row_count = jQuery('.sno').length;
		if(typeof row_count != "undefined" && row_count != null && row_count != 0 && row_count != "") {
			var j = 1;
			var sno = document.getElementsByClassName('sno');
			for(var i = row_count-1; i >= 0; i--) {
				// if(jQuery('.bill_products_table tbody').find('tr:nth-child('+i+')').length > 0) {
				// 	jQuery('.bill_products_table tbody').find('tr:nth-child('+i+')').find('.sno').html(j);
				// 	j = parseInt(j) + 1;
				// }
				sno[i].innerHTML=j;
				j = parseInt(j) + 1;
			}
		}
	}

	if(jQuery('.sub_total_amount').length > 0) {
        jQuery('.sub_total_amount').html('');
    }
    if(jQuery('.cgst_value').length > 0) {
        jQuery('.cgst_value').html('');
    }
	if(jQuery('.sgst_value').length > 0) {
        jQuery('.sgst_value').html('');
    }
	if(jQuery('.total_tax_value').length > 0) {
        jQuery('.total_tax_value').html('');
    }
	if(jQuery('.igst_value').length > 0) {
        jQuery('.igst_value').html('');
    }
	if(jQuery('.bill_total_amount').length > 0) {
        jQuery('.bill_total_amount').html('');
    }
	if(jQuery('.total_bill_value').length > 0) {
        jQuery('.total_bill_value').html('');
    }
	var amount_total = 0; var total_tax=0;
	if(jQuery('.product_row').length > 0) {
		jQuery('.product_row').each(function(){
			var amount = jQuery(this).find('.amount').html();
			
			if (typeof amount != "undefined" && amount != "" && amount != 0) {
				amount = amount.replace(/ /g,'');
				amount = amount.trim();
				if(price_regex.test(amount) == true) {
					amount_total = parseFloat(amount_total) + parseFloat(amount);
				}
			}
			// total_tax=parseFloat(total_tax) + parseFloat(tax);
		});
		if (typeof amount_total != "undefined" && amount_total != "" && amount_total != 0) {
            amount_total = check_decimal(amount_total);
			
			if(jQuery('.sub_total_amount').length > 0) {
                jQuery('.sub_total_amount').html(amount_total);
            }
		}
	}

	var receipt_company_id = "";
	if(jQuery('select[name="company_id"]').length > 0){
		receipt_company_id = jQuery('select[name="company_id"]').val();
	}
	else if(jQuery('input[name="company_id"]').length > 0){
		receipt_company_id = jQuery('input[name="company_id"]').val();
	}
	 
	if(receipt_company_id != "") {
		var post_url = "receipt_changes.php?get_company_receipt_number="+receipt_company_id;
		jQuery.ajax({url: post_url, success: function(receipt_number){
			receipt_number = receipt_number.split("$$$");
			// if(jQuery('input[name="gcno"]').length > 0) {
			// 	jQuery('input[name="gcno"]').val(receipt_number[0]);
			// }
			var primary_company = "";
			primary_company = receipt_number[2];

			var sub_total_amount = 0; var cooly = 0;
			if(jQuery('.sub_total_amount').html()!=''){
				sub_total_amount = jQuery('.sub_total_amount').html();
			}

			if(jQuery('input[name="cooly"]').val()!=''){
				cooly = jQuery('input[name="cooly"]').val();
			}

			var total_amount = 0;
			if(sub_total_amount!=''){
				sub_total_amount = sub_total_amount.replace(",", "");
				total_amount = parseFloat(sub_total_amount);
			}
			if(primary_company == "1"){
				$(".gst_row").removeClass('d-none');
				$(".div_bill_no").removeClass('d-none');
				$(".div_bill_date").removeClass('d-none');
				$(".div_bill_value").removeClass('d-none');
				if(jQuery('input[name="tax_percentage"]').length > 0) {
					jQuery('input[name="tax_percentage"]').val(receipt_number[1]);
					jQuery('input[name="tax_perc"]').val(receipt_number[1]);
	
					var check_login_session = 1;
					var post_url = "dashboard_changes.php?check_login_session=1";	
					jQuery.ajax({url: post_url, success: function(check_login_session){
						if(check_login_session == 1) {	
							var option = 1;
							if(jQuery('#gst_option').prop('checked') == false) {
								option = 0;
							}
							if(jQuery('#gst_option').length > 0) {
								jQuery('#gst_option').val(option);
							}
							var gst_option = 0;
							if(jQuery('input[name="gst_option"]').length > 0) {
								gst_option = jQuery('input[name="gst_option"]').val();
							}
	
							if(jQuery('input[name="tax_percentage"]').length > 0) {
								tax_percentage = jQuery('input[name="tax_percentage"]').val();
							}
	
							if(jQuery('select[name="state"]').length > 0) {
								state = jQuery('select[name="state"]').val();
							}
							
							if(jQuery('.tax_perc_row').length > 0) {
								jQuery('.tax_perc_row').css({"display" : "none"});
							}
							
							
							if(jQuery('.igst_row').length > 0) {
								jQuery('.igst_row').css({"display" : "none"});
							}
							if(jQuery('.cgst_row').length > 0) {
								jQuery('.cgst_row').css({"display" : "none"});
							}
							if(jQuery('.sgst_row').length > 0) {
								jQuery('.sgst_row').css({"display" : "none"});
							}
							
							if(jQuery('.total_tax_row').length > 0) {
								jQuery('.total_tax_row').css({"display" : "none"});
							}
							
							var net_tax_value = 0; var tax_value = "";
							var company_state = "";

							if(gst_option == "1") {
	
								jQuery('.tax_perc_row').css({"display" : "table-row"});
								if(state != 'Tamil Nadu' && state != ''){
									jQuery('.igst_row').css({"display" : "table-row"});
									jQuery('.cgst_row').css({"display" : "none"});
									jQuery('.sgst_row').css({"display" : "none"});
								}
								else{
									jQuery('.cgst_row').css({"display" : "table-row"});
									jQuery('.sgst_row').css({"display" : "table-row"});
									jQuery('.igst_row').css({"display" : "none"});
								}
								
								jQuery('.total_tax_row').css({"display" : "table-row"});
								
								if(total_amount != "0" && tax_percentage!=''){
									if(tax_percentage.indexOf('%') != -1) {
										tax_percentage = tax_percentage.replace('%','');
										tax_percentage = tax_percentage.trim();
										tax_value = (parseFloat(total_amount) * (tax_percentage)) / 100;
										net_tax_value = tax_value;
										tax_value = tax_value / 2;
									}
									if(state != 'Tamil Nadu'){
										jQuery('.igst_value').html(check_decimal(net_tax_value));
									}
									else{
										jQuery('.cgst_value').html(check_decimal(tax_value));
										jQuery('.sgst_value').html(check_decimal(tax_value));
									}
									
									jQuery('.total_tax_value').html(check_decimal(net_tax_value));
								}
							}
							
							total_amount = parseFloat(total_amount) + parseFloat(net_tax_value)+ parseFloat(cooly);

							if(jQuery('.bill_total_amount').length > 0) {
								jQuery('.bill_total_amount').html(check_decimal(total_amount));
							}
						}
						else {
							window.location.reload();
						}
					}});
				}
			}
			else{
				$(".gst_row").addClass('d-none');
				$(".div_bill_no").addClass('d-none');
				$(".div_bill_date").addClass('d-none');
				$(".div_bill_value").addClass('d-none');

				total_amount = parseFloat(total_amount) + parseFloat(cooly);

				if(jQuery('.bill_total_amount').length > 0) {
					jQuery('.bill_total_amount').html(check_decimal(total_amount));
				}
			}
			
		}});
	}
}
function DeleteGcnoRow(row_index) {
	
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";	
	jQuery.ajax({url: post_url, success: function(check_login_session){
		if(check_login_session == 1) {
			if(jQuery('#product_row'+row_index).length > 0) {
				jQuery('#product_row'+row_index).remove();
			}
			
		}
		else {
			window.location.reload();
		}
	}});
}
function DeleteGcno(gcno) {
	
	var deleted_gcno = jQuery("#deleted_gcno").val();
	
	if(deleted_gcno == '')
	{
		$("#deleted_gcno").val("'"+gcno+"'");
	}
	else{
		$("#deleted_gcno").val(deleted_gcno+",'"+gcno+"'");
		
	}
}
function show_receipt_list(){
	var company_id = $("#filter_company_id").val();
	var from_date = $("#from_date").val();
	var to_date = $("#to_date").val();
	var client_id = $("#client_id").val();
	var search_text = $("#search_text").val();
	var search_invoice = $("#search_invoice").val();
	var consignee_city = $("#city").val();
	var private_mark = $("#private_mark").val();
	
	
	window.open("reports/rpt_receipt_list.php?company_id="+company_id+"&from_date="+from_date+"&to_date="+to_date+"&client_id="+client_id+"&search_text="+search_text+"&search_invoice="+search_invoice+"&consignee_city="+consignee_city+"&private_mark="+private_mark);
}

function exp_receipt_list(){
	var company_id = $("#filter_company_id").val();
	var from_date = $("#from_date").val();
	var to_date = $("#to_date").val();
	var client_id = $("#client_id").val();
	var search_text = $("#search_text").val();
	var search_invoice = $("#search_invoice").val();
	var consignee_city = $("#city").val();
	var private_mark = $("#private_mark").val();
	var deleted_gcno = $("#deleted_gcno").val();

	window.open("exp_receipt_list.php?company_id="+company_id+"&from_date="+from_date+"&to_date="+to_date+"&client_id="+client_id+"&search_text="+search_text+"&search_invoice="+search_invoice+"&consignee_city="+consignee_city+"&private_mark="+private_mark+"&deleted_gcno="+deleted_gcno,'_self');
	
}

function AddVehicleList(){
	$("#div_vehicle_name").removeClass('d-none');
	$("#div_vehicle_no").removeClass('d-none');
	$("#vehicle_detalis").addClass('d-none');
}

function AddDetails() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";	
	jQuery.ajax({url: post_url, success: function(check_login_session){
		if(check_login_session == 1) {

			// var selected_tax=jQuery('input[name="selected_tax"]').val();
			
			if(jQuery('.infos').length > 0) {
				jQuery('.infos').each(function(){ jQuery(this).remove(); });
			}
		
			if(jQuery('.add_details_buttton').length > 0) {
				jQuery('.add_details_buttton').attr('disabled', true);
			}
			
			var all_errors_check = 1;
			
			var selected_unit_id = "";
			if(jQuery('select[name="selected_unit_id"]').length > 0) {
				selected_unit_id = jQuery('select[name="selected_unit_id"]').val();
				if (typeof selected_unit_id == "undefined" || selected_unit_id == "") {
					all_errors_check = 0;
				}
			}

			var selected_quantity = "";
			if(jQuery('input[name="selected_quantity"]').length > 0) {
				selected_quantity = jQuery('input[name="selected_quantity"]').val();	
				if (typeof selected_quantity != "undefined" && selected_quantity != "" && selected_quantity != 0) {
					selected_quantity = selected_quantity.replace(/ /g,'');
					selected_quantity = selected_quantity.trim();
					if(numbers_regex.test(selected_quantity) == false) {
						jQuery('input[name="selected_quantity"]').parent().append('<span class="infos">Invalid Quantity</span>');
						all_errors_check = 0;
					}
					else {
						jQuery('input[name="selected_quantity"]').val(selected_quantity);
					}
				}
				else {
					all_errors_check = 0;
				}
			}
		
			var selected_rate = "";
			if(jQuery('input[name="selected_rate"]').length > 0) {
				selected_rate = jQuery('input[name="selected_rate"]').val();	
				if (typeof selected_rate != "undefined" && selected_rate != "" && selected_rate != 0) {
					selected_rate = selected_rate.replace(/ /g,'');
					selected_rate = selected_rate.trim();
					if(price_regex.test(selected_rate) == false) {
						jQuery('input[name="selected_rate"]').parent().after('<span class="infos">Invalid Rate</span>');
						all_errors_check = 0;
					}
					else {
						jQuery('input[name="selected_rate"]').val(selected_rate);
					}
				}
				else {
					all_errors_check = 0;
				}
			}

			var selected_amount = "";
			if(jQuery('input[name="selected_amount"]').length > 0) {
				selected_amount = jQuery('input[name="selected_amount"]').val();	
				if (typeof selected_amount != "undefined" && selected_amount != "" && selected_amount != 0) {
					selected_amount = selected_amount.replace(/ /g,'');
					selected_amount = selected_amount.trim();
					if(price_regex.test(selected_amount) == false) {
						jQuery('input[name="selected_amount"]').parent().after('<span class="infos">Invalid Amount</span>');
						all_errors_check = 0;
					}
					else {
						jQuery('input[name="selected_amount"]').val(selected_amount);
					}
				}
				else {
					all_errors_check = 0;
				}
			}
			
			if(all_errors_check == 1) {		
				var add = 1;
				if(selected_unit_id != "") {
					if(jQuery('input[name="unit_id[]"]').length > 0) {
						jQuery('.bill_products_table tbody').find('tr').each(function(){
							var prev_unit_id = jQuery(this).find('input[name="unit_id[]"]').val();
							if(prev_unit_id == selected_unit_id) {
								// add = 0;
								$(this).closest("tr").remove();
							}
						});
					}
				}
				
				if(add == 1) {
					var product_count = jQuery('input[name="product_count"]').val();
					product_count = parseInt(product_count) + 1;
					jQuery('input[name="product_count"]').val(product_count);
					
					var post_url = "common_changes.php?product_row_index="+product_count+"&selected_unit_id="+selected_unit_id+"&selected_quantity="+selected_quantity+"&selected_rate="+selected_rate+"&selected_amount="+selected_amount;
					
					jQuery.ajax({url: post_url, success: function(result){

						if(jQuery('.bill_products_table tbody').find('tr').length > 0) {
							jQuery('.bill_products_table tbody').find('tr:first').before(result);
						}
						else {
							jQuery('.bill_products_table tbody').append(result);
						}
						
						if(jQuery('select[name="selected_unit_id"]').length > 0) {
							jQuery('select[name="selected_unit_id"]').val('').trigger("change");
							jQuery('select[name="selected_unit_id"]').focus();
						}
						
						if(jQuery('input[name="selected_rate"]').length > 0) {
							jQuery('input[name="selected_rate"]').val('');
						}
						if(jQuery('input[name="selected_quantity"]').length > 0) {
							jQuery('input[name="selected_quantity"]').val('');
						}
						if(jQuery('input[name="selected_amount"]').length > 0) {
							jQuery('input[name="selected_amount"]').val('');
						}
		
						if(jQuery('.add_details_buttton').length > 0) {
							jQuery('.add_details_buttton').attr('disabled', false);
						}
					}});
				}
				else {
					jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Product already Exists</span>');
		
					if(jQuery('.add_details_buttton').length > 0) {
						jQuery('.add_details_buttton').attr('disabled', false);
					}
				}		
			}
			else {
				jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please check all field values</span>');
				if(jQuery('.add_details_buttton').length > 0) {
					jQuery('.add_details_buttton').attr('disabled', false);
				}
			}
			// ShowGST();
			// getGST();
		}
		else {
			window.location.reload();
		}
	}});
}

function ProductRowCheck(obj) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";	
	jQuery.ajax({url: post_url, success: function(check_login_session){
		if(check_login_session == 1) {
			if(jQuery('.infos').length > 0) {
				jQuery('.infos').each(function(){ jQuery(this).remove(); });
			}
			
			var all_errors_check = 1;
			
			var selected_quantity = "";
			if(jQuery(obj).parent().parent().find('input[name="quantity[]"]').length > 0) {
				selected_quantity = jQuery(obj).parent().parent().find('input[name="quantity[]"]').val();	
				console.log(selected_quantity)			
				if (typeof selected_quantity != "undefined" && selected_quantity != "" && selected_quantity != 0) {
					selected_quantity = selected_quantity.replace(/ /g,'');
					selected_quantity = selected_quantity.trim();
					if(numbers_regex.test(selected_quantity) == false) {
						jQuery(obj).parent().parent().find('input[name="quantity[]"]').after('<span class="infos">Invalid Quantity</span>');
						all_errors_check = 0;
					}
				}
				else {
					all_errors_check = 0;
				}
			}	
			var selected_rate = "";
			if(jQuery(obj).parent().parent().find('input[name="rate[]"]').length > 0) {
				selected_rate = jQuery(obj).parent().parent().find('input[name="rate[]"]').val();				
				if (typeof selected_rate != "undefined" && selected_rate != "" && selected_rate != 0) {
					selected_rate = selected_rate.replace(/ /g,'');
					selected_rate = selected_rate.trim();
					if(price_regex.test(selected_rate) == false) {
						jQuery(obj).parent().parent().find('input[name="rate[]"]').after('<span class="infos">Invalid Rate</span>');
						all_errors_check = 0;
					}
				}
				else {
					all_errors_check = 0;
				}
			}
			
			if(all_errors_check == 1) {
				if((parseFloat(selected_rate) > 0 && price_regex.test(selected_rate) == true) && parseFloat(selected_quantity) && numbers_regex.test(selected_quantity) == true) {
					var selected_amount = parseFloat(selected_rate) * parseFloat(selected_quantity);
					selected_amount = check_decimal(selected_amount);
					if(jQuery(obj).parent().parent().find('.amount').length > 0) {
						jQuery(obj).parent().parent().find('.amount').html(selected_amount);
						ShowGST();
					}
				}
			}
			else {
				if(jQuery(obj).parent().parent().find('.amount').length > 0) {
					jQuery(obj).parent().parent().find('.amount').html('');
				}
			}
		}
		else {
			window.location.reload();
		}
	}});
}

function DeleteProductRow(row_index) {
	
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";	
	jQuery.ajax({url: post_url, success: function(check_login_session){
		if(check_login_session == 1) {
			if(jQuery('#product_row'+row_index).length > 0) {
				jQuery('#product_row'+row_index).remove();
			}
			ShowGST();
		}
		else {
			window.location.reload();
		}
	}});
}


function check_merge(check_status, client_id){
	var hid_client_id = $("#hid_client_id").val();
	if(check_status == true){
		if(hid_client_id == ""){
			$("#hid_client_id").val(client_id);
		}
		else{
			$("#hid_client_id").val(hid_client_id+','+client_id);
		}
	}
	else{
		$("#hid_client_id").val(hid_client_id.replace(client_id,""));
	}
}

function search_client_list() {
	var input, filter, ul, li, a, i;
    input = document.forms["receipt_form"]["cnr_client_name"];
    filter = input.value.toUpperCase();
	if(filter != '') {
		jQuery('#show_client_list').show();
		ul = document.getElementById("show_client_list");
		li = ul.getElementsByTagName('li');
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("a")[0];
			if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
				li[i].style.display = "";
			} else {
				li[i].style.display = "none";
			}
		}
	}
	else
		jQuery('#show_client_list').hide();
}

function get_search_client(client, client_id) {
	jQuery('input[name="cnr_client_name"]').val(jQuery('.'+client).text());
	var client_name = jQuery('input[name="cnr_client_name"]').val();
	client_name = client_name.trim();
	jQuery('input[name="cnr_client_name"]').val(client_name)
	removeCNRCustomClient();
	jQuery('select[name="cnr_client_id"]').val(client_id)
	jQuery('select[name="cnr_client_id"]').val(client_id).change();
	load_mobile_number(client_id,'cnr')
	jQuery('#show_client_list').hide();
}

function search_cne_client_list() {
	var input, filter, ul, li, a, i;
    input = document.forms["receipt_form"]["cne_client_name"];
    filter = input.value.toUpperCase();
	if(filter != '') {
		jQuery('#show_cne_client_list').show();
		ul = document.getElementById("show_cne_client_list");
		li = ul.getElementsByTagName('li');
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("a")[0];
			if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
				li[i].style.display = "";
			} else {
				li[i].style.display = "none";
			}
		}
	}
	else
		jQuery('#show_cne_client_list').hide();
}

function get_cne_search_client(client, client_id) {
	jQuery('input[name="cne_client_name"]').val(jQuery('.'+client).text());
	var client_name = jQuery('input[name="cne_client_name"]').val();
	client_name = client_name.trim();
	jQuery('input[name="cne_client_name"]').val(client_name)
	removeCNECustomClient();
	jQuery('select[name="cne_client_id"]').val(client_id)
	jQuery('select[name="cne_client_id"]').val(client_id).change();
	load_mobile_number(client_id,'cne')
	jQuery('#show_cne_client_list').hide();
}

function show_rate(){
	var pay_option = "";

	if(jQuery('select[name="pay_option"]').length > 0) {
		pay_option = jQuery('select[name="pay_option"]').val();
		if(pay_option == "1"){
			from_party = $("#cnr_client_id").val();
		}
		else if(pay_option == "2"){
			from_party = $("#cne_client_id").val();
		}

		if(pay_option != '' && from_party != ''){
			var selected_unit_id = "";
			if(jQuery('select[name="selected_unit_id"]').length > 0) {
				selected_unit_id = jQuery('select[name="selected_unit_id"]').val();
				var post_url = "receipt_changes.php?show_rate=1"+"&from_party="+from_party+"&pay_option="+pay_option+"&selected_unit_id="+selected_unit_id;
				jQuery('input[name="selected_rate"]').val('');
				jQuery.ajax({url: post_url, success: function(result){
					if(result != ''){
						jQuery('input[name="selected_rate"]').val(result);
					}
				}});
			}
		}
	}
}

function ShowCustomCity(){
	$(jQuery('select[name="city"]')).val("");
	$(jQuery('select[name="city"]')).trigger("change");
	$("#city_display").addClass('d-none');
	$(".custom_city_name").removeClass('d-none')
}

function removecustomcity(){
	$("#consignee_city_name").val('');
	$("#city_display").removeClass('d-none');
	$(".custom_city_name").addClass('d-none')
}

function removeVehicle(){
	$("#div_vehicle_name").addClass('d-none');
	$("#div_vehicle_no").addClass('d-none');
	$("#vehicle_detalis").removeClass('d-none');
}

function getClient(client_id){
	// var receipt_company_id = jQuery('select[name="company_id"]').val();
	// if(receipt_company_id != "") {
	// 	var post_url = "common_changes.php?getClient="+client_id;
	// 	jQuery.ajax({url: post_url, success: function(result){

	// 	}});
	// }
	if(jQuery("#cnr_custom_client_display").is(":visible")){
		jQuery("#cnr_custom_client_display").addClass('d-none')
		jQuery("#cnr_client_display").removeClass('d-none')
		jQuery("input[name='cnr_client_name']").val('');
	}
	
	jQuery("select[name='cnr_client_id']").val(client_id).change();
}

function getCNEClient(client_id){
	if(jQuery("#cne_custom_client_display").is(":visible")){
		jQuery("#cne_custom_client_display").addClass('d-none')
		jQuery("#cne_client_display").removeClass('d-none')
		jQuery("input[name='cne_client_name']").val('');
	}
	
	jQuery("select[name='cne_client_id']").val(client_id).change();
}