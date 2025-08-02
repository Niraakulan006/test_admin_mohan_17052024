function organizationDetails(organization_id) {
	if (jQuery('input[name="organization_state"]').length > 0) {
		jQuery('input[name="organization_state"]').val("");
	}
	if (typeof organization_id != "undefined" && organization_id != "") {
		
		var check_login_session = 1;
		var post_url = "dashboard_changes.php?check_login_session=1";
		jQuery.ajax({
			url: post_url, success: function (check_login_session) {
				if (check_login_session == 1) {
					var post_url = "lr_bill_changes.php?get_details_organization_id=" + organization_id;
					jQuery.ajax({
						url: post_url, success: function (result) {
							if (typeof result != "undefined" && result != "") {
								result = JSON.parse(result);
								var party_details = "";
								if (jQuery('input[name="organization_state"]').length > 0) {
									jQuery('input[name="organization_state"]').val(result.state);
									// getGST();
								}
								if (jQuery('select[name="print_type"]').length > 0) {
									jQuery('select[name="print_type"]').val(result.print_type).trigger("change");
								}
							}
							else {
								console.log(result);
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
}
function addDetails() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var selected_tax = jQuery('input[name="selected_tax"]').val();

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}

				if (jQuery('.add_details_buttton').length > 0) {
					jQuery('.add_details_buttton').attr('disabled', true);
				}

				var all_errors_check = 1;

				var lr_id = "";
				if (jQuery('select[name="selected_lr_id"]').length > 0) {
					lr_id = jQuery('select[name="selected_lr_id"]').val();
					if (typeof lr_id == "undefined" || lr_id == "") {
						all_errors_check = 0;
					}
				}

				if (all_errors_check == 1) {
					var add = 1;

					if(lr_id != "") {
						if(jQuery('input[name="lr_id[]"]').length > 0) {
							jQuery('.bill_products_table tbody').find('tr').each(function(){
								var prev_lr_id = jQuery(this).find('input[name="lr_id[]"]').val();
								if(prev_lr_id == lr_id) {
									add = 0;
								}
							});
						}
					}
					if (add == 1) {
						var product_count = jQuery('input[name="product_count"]').val();
						product_count = parseInt(product_count) + 1;
						jQuery('input[name="product_count"]').val(product_count);

						var post_url = "luggage_bill_changes.php?product_row_index=" + product_count +"&lr_id=" + lr_id;
						jQuery.ajax({
							url: post_url, success: function (result) {

								if(jQuery('.bill_products_table tbody').find('tr').length > 0) {
									jQuery('.bill_products_table tbody').find('tr:first').before(result);
								}
								else {
									jQuery('.bill_products_table tbody').append(result);
								}
								
								if(jQuery('select[name="lr_id"]').length > 0) {
									jQuery('select[name="lr_id"]').val('').trigger("change");
									jQuery('select[name="lr_id"]').focus();
								}
								if(jQuery('input[name="custom_unit_name"]').length > 0) {
									jQuery('input[name="custom_unit_name"]').val('');
								}
								
								if(jQuery('input[name="price_per_qty"]').length > 0) {
									jQuery('input[name="price_per_qty"]').val('');
								}
								if(jQuery('input[name="quantity"]').length > 0) {
									jQuery('input[name="quantity"]').val('');
								}
								if(jQuery('input[name="amount"]').length > 0) {
									jQuery('input[name="amount"]').val('');
								}
								if(jQuery('select[name="organization_id"]').length > 0) {
									jQuery('select[name="organization_id"]').attr('disabled', true);
								}
								if(jQuery('.add_details_buttton').length > 0) {
									jQuery('.add_details_buttton').attr('disabled', false);
								}
							}
						});
					}
					else {
						jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">LR already Exists</span>');

						if (jQuery('.add_details_buttton').length > 0) {
							jQuery('.add_details_buttton').attr('disabled', false);
						}
					}
				}
				else {
					jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please check all field values</span>');
					if (jQuery('.add_details_buttton').length > 0) {
						jQuery('.add_details_buttton').attr('disabled', false);
					}
				}
				$("#product_display").show();
				$("#custom_product_display").hide();
				// getGST();
			}
			else {
				window.location.reload();
			}
		}
	});
}
function vehicleDetails(vehicle_id) {
	if (jQuery('input[name="party_state"]').length > 0) {
		jQuery('input[name="party_state"]').val("");
	}
	if (jQuery('.vehicle_preview').length > 0) {
		jQuery('.vehicle_preview').html('');
	}
	if (typeof vehicle_id != "undefined" && vehicle_id != "") {
		var check_login_session = 1;
		var post_url = "dashboard_changes.php?check_login_session=1";
		jQuery.ajax({
			url: post_url, success: function (check_login_session) {
				if (check_login_session == 1) {
					var post_url = "luggage_bill_changes.php?get_details_vehicle_id=" + vehicle_id;
					jQuery.ajax({
						url: post_url, success: function (result) {
							if (typeof result != "undefined" && result != "") {
								result = JSON.parse(result);
								var party_details = "";
								if (typeof result.mobile_number != "undefined" && result.mobile_number != "") {
									party_details = party_details + 'Mobile: ' + result.mobile_number;
								}
								if (typeof result.vehicle_number != "undefined" && result.vehicle_number != "") {
									party_details = party_details + '<br>Vehicle No: ' + result.vehicle_number;
								}
								if (typeof party_details != "undefined" && party_details != "") {
									jQuery('.vehicle_preview').html('<div class="font-weight-bold text-pinterest smallfnt text-center">Vehicle Details</div><div class="text-center">' + party_details + '</div>');
								}
							}
							else {
								console.log(result);
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
}

function organization_gst_option(organization_id) {
	if (jQuery('input[name="gst_option"]').length > 0) {
		jQuery('input[name="gst_option"]').val("");
	}

	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var post_url = "lr_bill_changes.php?organization_gst_option=" + organization_id;
				jQuery.ajax({
					url: post_url, success: function (result) {
						var option = 1;
						if (result == 1) {
							option = 0;
							if ($(".div_bill_value").length > 0) {
								$(".div_bill_value").removeClass('d-none')
							}
							if ($(".div_bill_date").length > 0) {
								$(".div_bill_date").removeClass('d-none')
							}
							if ($(".div_bill_number").length > 0) {
								$(".div_bill_number").removeClass('d-none')
							}
							if (jQuery('input[type="checkbox"]').length > 0) {

								jQuery('#gst_option').attr('checked', true);
								ShowGST();
							}
						}
						else {
							if ($(".div_bill_value").length > 0) {
								$(".div_bill_value").addClass('d-none')
							}
							if ($(".div_bill_date").length > 0) {
								$(".div_bill_date").addClass('d-none')
							}
							if ($(".div_bill_number").length > 0) {
								$(".div_bill_number").addClass('d-none')
							}
							if (jQuery('input[type="checkbox"]').length > 0) {
								jQuery('#gst_option').attr('checked', false);
								ShowGST();
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

function NewVehicle() {
	jQuery('.vehicle_modal_button').trigger("click");
}
function SaveCustomVehicle() {
	if (jQuery('.vehicle_preview').length > 0) {
		jQuery('.vehicle_preview').html('');
	}
	var res = ValidCustomvehicle();
	if (res == true) {

		var custom_vehicle = "";
		var custom_vehicle_name = ""; var custom_vehicle_mobile_number = ""; var custom_vehicle_city = ""; var custom_vehicle_state = ""; var valid = 1;
		
		if (jQuery('input[name="custom_vehicle_contact_number"]').length > 0) {
			custom_vehicle_contact_number = jQuery('input[name="custom_vehicle_contact_number"]').val();
			custom_vehicle_contact_number = custom_vehicle_contact_number.trim();
			if (typeof custom_vehicle_contact_number != "undefined" || custom_vehicle_contact_number != "") {
				custom_vehicle = custom_vehicle + '<br>' + custom_vehicle_contact_number;
			}
		}
		if (jQuery('input[name="custom_vehicle_number"]').length > 0) {
			custom_vehicle_number = jQuery('input[name="custom_vehicle_number"]').val();
			custom_vehicle_number = custom_vehicle_number.trim();
		}

		if (typeof custom_vehicle_number != "undefined" || custom_vehicle_number != "") {
			if (jQuery('.vehicle_preview').length > 0) {
				jQuery('.vehicle_preview').html('<div class="font-weight-bold text-pinterest smallfnt text-center">Vehicle Details</div><div class="text-center">Mobile: ' + custom_vehicle_contact_number + '<br>Vehicle No: ' + custom_vehicle_number + '</div>');
			}
		}

		jQuery('.vehicle_modal_button').trigger("click");
		// getGST();
	}
}
function ValidCustomvehicle() {

	if (jQuery('#vehicle_cover').find('.infos').length > 0) {
		jQuery('#vehicle_cover').find('.infos').each(function () { jQuery(this).remove(); })
	}
	var custom_vehicle_name = ""; var custom_vehicle_mobile_number = ""; var custom_vehicle_city = ""; var custom_vehicle_state = ""; var valid = 1;
	var format = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?~]/;
	if (jQuery('input[name="custom_vehicle_name"]').length > 0) {
		custom_vehicle_name = jQuery('input[name="custom_vehicle_name"]').val();
		custom_vehicle_name = custom_vehicle_name.trim();
		if (typeof custom_vehicle_name == "undefined" || custom_vehicle_name == "") {

			valid = 0;
			jQuery('input[name="custom_vehicle_name"]').parent().parent().append('<span class="infos">Enter the name</span>');
		}
		else {
			if (format.test(custom_vehicle_name) == true) {
				jQuery('input[name="custom_vehicle_name"]').parent().parent().append('<span class="infos">Invalid Name</span>');
				valid = 0;
			}
		}
	}
	if (jQuery('input[name="custom_vehicle_mobile_number"]').length > 0) {
		custom_vehicle_contact_number = jQuery('input[name="custom_vehicle_mobile_number"]').val();
		custom_vehicle_contact_number = custom_vehicle_contact_number.trim();
		if (typeof custom_vehicle_contact_number == "undefined" || custom_vehicle_contact_number == "") {
			valid = 0;
			jQuery('input[name="custom_vehicle_mobile_number"]').parent().parent().after('<span style="padding-left: 50px;" class="infos">Enter the mobile number </span>');
		}
		else {
			if (custom_vehicle_contact_number != 'undefined' && custom_vehicle_contact_number != '') {

				var phoneno = /^\d{10}$/;
				if (!custom_vehicle_contact_number.match(phoneno)) {
					jQuery('input[name="custom_vehicle_mobile_number"]').parent().parent().after('<span class="infos">Invalid Mobile Number</span>');
					valid = 0;
				}
				else if (format.test(custom_vehicle_contact_number) == true) {
					jQuery('input[name="custom_vehicle_mobile_number"]').parent().parent().after('<span  class="infos">Invalid Mobile Number</span>');
					valid = 0;
				}
			}
		}
	}
	if (jQuery('input[name="custom_vehicle_number"]').length > 0) {
		custom_vehicle_number = jQuery('input[name="custom_vehicle_number"]').val();
		custom_vehicle_number = custom_vehicle_number.trim();
		if (typeof custom_vehicle_number == "undefined" || custom_vehicle_number == "") {
			valid = 0;
			jQuery('input[name="custom_vehicle_number"]').parent().parent().after('<span class="infos">Enter the vehicle number </span>');
		}
		else {
			if (format.test(custom_vehicle_number) == true) {
				jQuery('input[name="custom_vehicle_number"]').parent().parent().after('<span class="infos">Invalid vehicle number</span>');
				valid = 0;
			}
		}
	}

	return valid;
}
function CancelCustomvehicle() {
	if (jQuery('#custom_vehicle_cover').find('.infos').length > 0) {
		jQuery('#custom_vehicle_cover').find('.infos').each(function () { jQuery(this).remove(); })
	}

	if (jQuery('input[name="custom_vehicle_name"]').length > 0) {
		jQuery('input[name="custom_vehicle_name"]').val('');
	}
	if (jQuery('input[name="custom_vehicle_mobile_number"]').length > 0) {
		jQuery('input[name="custom_vehicle_mobile_number"]').val('');
	}

	if (jQuery('select[name="custom_vehicle_number"]').length > 0) {
		jQuery('select[name="custom_vehicle_number"]').val('');
	}

	jQuery('.vehicle_modal_button').trigger("click");
	// getGST();
}

function addDetails() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var selected_tax = jQuery('input[name="selected_tax"]').val();

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}

				if (jQuery('.add_details_buttton').length > 0) {
					jQuery('.add_details_buttton').attr('disabled', true);
				}

				var all_errors_check = 1;

				var lr_id = "";
				if (jQuery('select[name="selected_lr_id"]').length > 0) {
					lr_id = jQuery('select[name="selected_lr_id"]').val();
					if (typeof lr_id == "undefined" || lr_id == "") {
						all_errors_check = 0;
					}
				}

				if (all_errors_check == 1) {
					var add = 1;

					if(lr_id != "") {
						if(jQuery('input[name="lr_id[]"]').length > 0) {
							jQuery('.bill_products_table tbody').find('tr').each(function(){
								var prev_lr_id = jQuery(this).find('input[name="lr_id[]"]').val();
								if(prev_lr_id == lr_id) {
									add = 0;
								}
							});
						}
					}
					if (add == 1) {
						var product_count = jQuery('input[name="product_count"]').val();
						product_count = parseInt(product_count) + 1;
						jQuery('input[name="product_count"]').val(product_count);

						var post_url = "luggage_bill_changes.php?product_row_index=" + product_count +"&lr_id=" + lr_id;
						jQuery.ajax({
							url: post_url, success: function (result) {

								if(jQuery('.bill_products_table tbody').find('tr').length > 0) {
									jQuery('.bill_products_table tbody').find('tr:first').before(result);
								}
								else {
									jQuery('.bill_products_table tbody').append(result);
								}
								
								if(jQuery('select[name="lr_id"]').length > 0) {
									jQuery('select[name="lr_id"]').val('').trigger("change");
									jQuery('select[name="lr_id"]').focus();
								}
								if(jQuery('input[name="custom_unit_name"]').length > 0) {
									jQuery('input[name="custom_unit_name"]').val('');
								}
								
								if(jQuery('input[name="price_per_qty"]').length > 0) {
									jQuery('input[name="price_per_qty"]').val('');
								}
								if(jQuery('input[name="quantity"]').length > 0) {
									jQuery('input[name="quantity"]').val('');
								}
								if(jQuery('input[name="amount"]').length > 0) {
									jQuery('input[name="amount"]').val('');
								}
								if(jQuery('select[name="organization_id"]').length > 0) {
									jQuery('select[name="organization_id"]').attr('disabled', true);
								}
								if(jQuery('.add_details_buttton').length > 0) {
									jQuery('.add_details_buttton').attr('disabled', false);
								}
							}
						});
					}
					else {
						jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">LR already Exists</span>');

						if (jQuery('.add_details_buttton').length > 0) {
							jQuery('.add_details_buttton').attr('disabled', false);
						}
					}
				}
				else {
					jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please check all field values</span>');
					if (jQuery('.add_details_buttton').length > 0) {
						jQuery('.add_details_buttton').attr('disabled', false);
					}
				}
				$("#product_display").show();
				$("#custom_product_display").hide();
				// getGST();
			}
			else {
				window.location.reload();
			}
		}
	});
}

function addDetails1() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var selected_tax = jQuery('input[name="selected_tax"]').val();

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}

				if (jQuery('.add_details_buttton').length > 0) {
					jQuery('.add_details_buttton').attr('disabled', true);
				}

				var all_errors_check = 1;

				// var lr_id = "";
				// if (jQuery('select[name="lr_id"]').length > 0) {
				// 	lr_id = jQuery('select[name="lr_id"]').val();
				// 	if (typeof lr_id == "undefined" || lr_id == "") {
				// 	}
				// }

				var lr_id_values = [];

				jQuery('input[name="lr_id_check[]"]').each(function() {
					if (jQuery(this).is(':checked')) {
						lr_id_values.push(jQuery(this).val());
					}
				});

				if (lr_id_values.length === 0 && (lr_id_values === undefined || lr_id_values === "")) {
					all_errors_check = 0;
				}

				var lr_id_check = lr_id_values.join(',');

				if (all_errors_check == 1) {
					var add = 1;
					if (add == 1) {
						var product_count = jQuery('input[name="product_count"]').val();
						product_count = parseInt(product_count) + 1;
						jQuery('input[name="product_count"]').val(product_count);

						var post_url = "luggage_bill_changes.php?product_row_index1=" + product_count +"&lr_id_check=" + lr_id_check;
						jQuery.ajax({
							url: post_url, success: function (result) {

								if(jQuery('.bill_products_table tbody').find('tr').length > 0) {
									jQuery('.bill_products_table tbody').find('tr:first').before(result);
								}
								else {
									jQuery('.bill_products_table tbody').append(result);
								}
								
								if(jQuery('select[name="lr_id"]').length > 0) {
									jQuery('select[name="lr_id"]').val('').trigger("change");
									jQuery('select[name="lr_id"]').focus();
								}
								if(jQuery('select[name="luggage_id"]').length > 0) {
									jQuery('select[name="luggage_id"]').val('').trigger("change");
								}

								if(jQuery('input[name="lr_id_check"]').length > 0) {
									jQuery('input[name="lr_id_check"]').val('');
								}

								jQuery('.luggagesheet_display').html('<div class="font-weight-bold text-pinterest smallfnt text-center">Lr Details</div><div class="text-center"></div>');

								if(jQuery('input[name="custom_unit_name"]').length > 0) {
									jQuery('input[name="custom_unit_name"]').val('');
								}
								
								if(jQuery('input[name="price_per_qty"]').length > 0) {
									jQuery('input[name="price_per_qty"]').val('');
								}
								if(jQuery('input[name="quantity"]').length > 0) {
									jQuery('input[name="quantity"]').val('');
								}
								if(jQuery('input[name="amount"]').length > 0) {
									jQuery('input[name="amount"]').val('');
								}
				
								if(jQuery('.add_details_buttton').length > 0) {
									jQuery('.add_details_buttton').attr('disabled', false);
								}
							}
						});
					}
					else {
						jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Product already Exists</span>');

						if (jQuery('.add_details_buttton').length > 0) {
							jQuery('.add_details_buttton').attr('disabled', false);
						}
					}
				}
				else {
					jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please check all field values</span>');
					if (jQuery('.add_details_buttton').length > 0) {
						jQuery('.add_details_buttton').attr('disabled', false);
					}
				}
				$("#product_display").show();
				$("#custom_product_display").hide();
				// getGST();
			}
			else {
				window.location.reload();
			}
		}
	});
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
				if (typeof selected_quantity != "undefined" && selected_quantity != "" && selected_quantity != 0) {
					selected_quantity = selected_quantity.replace(/ /g,'');
					selected_quantity = selected_quantity.trim();
				}
				else {
					all_errors_check = 0;
				}
			}	
			var selected_rate = "";
			if(jQuery(obj).parent().parent().find('input[name="price_per_qty[]"]').length > 0) {
				selected_rate = jQuery(obj).parent().parent().find('input[name="price_per_qty[]"]').val();				
				if (typeof selected_rate != "undefined" && selected_rate != "" && selected_rate != 0) {
					selected_rate = selected_rate.replace(/ /g,'');
					selected_rate = selected_rate.trim();
					// jQuery(obj).parent().parent().find('input[name="price_per_qty[]"]').after('<span class="infos">Invalid Rate</span>');
					// all_errors_check = 0;
				}
				else {
					all_errors_check = 0;
				}
			}
		
			if(all_errors_check == 1) {
				var selected_amount = parseFloat(selected_rate) * parseFloat(selected_quantity);
				if(jQuery(obj).parent().parent().find('.total_display').length > 0) {
					jQuery(obj).parent().parent().find('.total_display').html(selected_amount);
					jQuery(obj).parent().parent().find('input[name="total_amount[]"]').val(selected_amount);
				}		
			}
			else {
				if(jQuery(obj).parent().parent().find('.amount').length > 0) {
					jQuery(obj).parent().parent().find('.amount').html('');
				}
				//jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please check all field values</span>');
			}
		}
		else {
			window.location.reload();
		}
	}});
}
function getBranchLR()
{ //obj
	var branch_array = [];var branch_id = "";var str_branch = "";
	/*var len = obj.options.length;
	for (var i = 0; i < len; i++) {
		branch_id = obj.options[i];
	
		if (branch_id.selected && str_branch != branch_id) {
			branch_array.push(branch_id.value);
		}
		str_branch = branch_id;
		//console.log("str_branch :"+str_branch+",branch_array :"+branch_array);
	}*/

	if(jQuery('select[name="branch_name"]').length > 0) {
		jQuery('select[name="branch_name"]').find('option').each(function() {
			if(jQuery(this).is(':selected')) {
				branch_array.push(jQuery(this).val());
			}
		});
	}

	jQuery('input[name="branch_id[]"]').val(branch_array);
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var post_url = "luggage_bill_changes.php?get_branch_lr=" + branch_array;
					jQuery.ajax({
						url: post_url, success: function (result) {
							if (typeof result != "undefined" && result != "") {
								list = result.split("$$$");
								if(jQuery('.lr_details').length >0)
								{
									jQuery('.lr_details').html(list[0]);
								}
								if(jQuery('.luggage_list').length >0)
								{
									jQuery('.luggage_list').html(list[1]);
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
function getLuggageBranchLR(branch_id)
{
	if(jQuery('input[name="branch_id"]').length >0)
	{
		jQuery('input[name="branch_id"]').val(branch_id);
	}
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var post_url = "luggage_bill_changes.php?get_luggage_branch_lr=" + branch_id;
					jQuery.ajax({
						url: post_url, success: function (result) {
							if (typeof result != "undefined" && result != "") {
								if(jQuery('.lr_details').length >0)
								{
									jQuery('.lr_details').html(result);
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
function getLrbyState() {

	state = "";
	if (jQuery('select[name="lr_state"]').length > 0) {
		var state = jQuery('select[name="lr_state"]').val();
	}

	if (typeof state != "undefined" && state != "") {
		var check_login_session = 1;
		var post_url = "dashboard_changes.php?check_login_session=1";
		jQuery.ajax({
			url: post_url, success: function (check_login_session) {
				if (check_login_session == 1) {
					
					if (jQuery('select[name="organization_id"]').length > 0) {
						var organization_id = jQuery('select[name="organization_id"]').val();
					}
					if (jQuery('select[name="godown_id"]').length > 0) {
						var godown_id = jQuery('select[name="godown_id"]').val();
					}
					if (jQuery('input[name="luggage_date"]').length > 0) {
						var luggage_date = jQuery('input[name="luggage_date"]').val();
					}

					var post_url = "luggage_bill_changes.php?get_details_lr=" + state + '&godown_id='+ godown_id + '&date=' + luggage_date+"&selected_organization_id="+organization_id;
					jQuery.ajax({
						url: post_url, success: function (result) {
							if (typeof result != "undefined" && result != "") {
								if (jQuery('.lr_id').length > 0) {
									jQuery('.lr_id').html(result);
								}
							}
							else {
								console.log(result);
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
}

function DeleteProductRow(row_index) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var deleted_lr_id = ""; var deleted_lr_number = "";
				if (jQuery('#product_row' + row_index).find('input[name="lr_id[]"]').length > 0) {
					deleted_lr_id = jQuery('#product_row' + row_index).find('input[name="lr_id[]"]').val();
					deleted_lr_number = jQuery('#product_row' + row_index).find('input[name="lr_number[]"]').val();
					// deleted_lr_id_option = '<option value="' + deleted_lr_id + '">' + deleted_lr_number + '</option>';
				}
				if (jQuery('#product_row' + row_index).length > 0) {
					jQuery('#product_row' + row_index).remove();
					
				}
				if(deleted_lr_id != ""){
					const newOption = $('<option>', {
						value: deleted_lr_id,
						text: deleted_lr_number
					});
					if(jQuery('select[name="selected_lr_id"]').length > 0) {
						$('select[name="selected_lr_id"]').append(newOption);
					}
				}
				// if(jQuery('select[name="selected_lr_id"]').length > 0) {
				// 	jQuery('select[name="selected_lr_id"]').append(deleted_lr_id_option);
				// }
				if(jQuery('.product_row').length == 0) {
					if(jQuery('select[name="from_branch_id"]').length > 0) {
						jQuery('select[name="from_branch_id"]').parent().css('pointer-events', 'auto');
					}
				}
				var from_branch_id = "";
				if(jQuery('select[name="from_branch_id"]').length > 0) {
					from_branch_id = jQuery('select[name="from_branch_id"]').val().trim();
				}
				var to_branch_id = "";
				if(jQuery('select[name="to_branch_id[]"]').length > 0) {
					to_branch_id = jQuery('select[name="to_branch_id[]"]').val();
				}
				
				// LRNumberChanges(from_branch_id,to_branch_id);
			}
			else {
				window.location.reload();
			}
		}
	});
	if (jQuery('.product_row').length > 0) {
		if (jQuery('select[name="organization_id"]').length > 0) {
			jQuery('select[name="organization_id"]').attr('disabled', false);
		}
		
	}
}

function showLr(){
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('select[name="luggage_id"]').length > 0) {
					var luggage_id = jQuery('select[name="luggage_id"]').val();
				}

				var post_url = "luggage_bill_changes.php?get_details_lr_list=" + luggage_id;
				jQuery.ajax({
					url: post_url, success: function (result) {
						jQuery('.luggagesheet_display').html(result);
					}
				});
			}
			else {
				window.location.reload();
			}
		}
	});
}

function organization_luggage_lr_details(organization_id)
{
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var post_url = "luggage_bill_changes.php?organization_id=" + organization_id;
				jQuery.ajax({
					url: post_url, success: function (result) {
						var list = result.split("$$$");
						if(list[0] != '' && list[0] != 'undefined')
						{
							if(jQuery('.luggage_id').length >0)
							{
								jQuery('.luggage_id').html(list[0])
							}
						}
						if(list[1] != '' && list[1] != 'undefined')
						{
							if(jQuery('.lr_id').length >0)
							{
								jQuery('.lr_id').html(list[1])
							}
						}
						
						if(jQuery('input[name="organization_id"]').length >0)
						{
							jQuery('input[name="organization_id"]').val(organization_id);
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
function addDetailsLuggage() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				all_errors_check = 1;
				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}
				if (jQuery('.add_details_buttton').length > 0) {
					jQuery('.add_details_buttton').attr('disabled', true);
				}
				var all_errors_check = 1;
				var luggage_id = "";
				if (jQuery('select[name="luggage_id"]').length > 0) {
					luggage_id = jQuery('select[name="luggage_id"]').val();
					if (typeof luggage_id == "undefined" || luggage_id == "") {
						all_errors_check = 0;
					}
				}
				if (all_errors_check == 1) {
					var add = 1;
					if (luggage_id != "") {
						if (jQuery('input[name="luggage_clearance_id[]"]').length > 0) {
							jQuery('.bill_products_table tbody').find('tr').each(function () {
								var prev_luggage_id = jQuery(this).find('input[name="luggage_clearance_id[]"]').val();
								if (prev_luggage_id == luggage_id) {
									add = 0;
								}
							});
						}
					}
					if (add == 1) {
						var product_count = jQuery('input[name="product_count"]').val();
						product_count = parseInt(product_count) + 1;
						jQuery('input[name="product_count"]').val(product_count);

						var post_url = "luggage_bill_changes.php?product_row_index2=" + product_count +"&luggage_id=" + luggage_id;
						jQuery.ajax({
							url: post_url, success: function (result) {

								if(jQuery('.bill_products_table tbody').find('tr').length > 0) {
									jQuery('.bill_products_table tbody').find('tr:first').before(result);
								}
								else {
									jQuery('.bill_products_table tbody').append(result);
								}
								if(jQuery('select[name="branch_id"]').length >0)
								{
									jQuery('select[name="branch_id"]').attr('disabled', true)
								}
								if(jQuery('select[name="lr_id"]').length > 0) {
									jQuery('select[name="lr_id"]').val('').trigger("change");
									jQuery('select[name="lr_id"]').focus();
								}
								if(jQuery('select[name="luggage_id"]').length > 0) {
									jQuery('select[name="luggage_id"]').val('').trigger("change");
								}

								if(jQuery('input[name="lr_id_check"]').length > 0) {
									jQuery('input[name="lr_id_check"]').val('');
								}

								jQuery('.luggagesheet_display').html('<div class="font-weight-bold text-pinterest smallfnt text-center">Lr Details</div><div class="text-center"></div>');

								if(jQuery('input[name="custom_unit_name"]').length > 0) {
									jQuery('input[name="custom_unit_name"]').val('');
								}
								
								if(jQuery('input[name="price_per_qty"]').length > 0) {
									jQuery('input[name="price_per_qty"]').val('');
								}
								if(jQuery('input[name="quantity"]').length > 0) {
									jQuery('input[name="quantity"]').val('');
								}
								if(jQuery('input[name="amount"]').length > 0) {
									jQuery('input[name="amount"]').val('');
								}
				
								if(jQuery('.add_details_buttton').length > 0) {
									jQuery('.add_details_buttton').attr('disabled', false);
								}
							}
						});
					}
					else {
						jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Luggage already Exists</span>');

						if (jQuery('.add_details_buttton').length > 0) {
							jQuery('.add_details_buttton').attr('disabled', false);
						}
					}
				}
				else {
					jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please check all field values</span>');
					if (jQuery('.add_details_buttton').length > 0) {
						jQuery('.add_details_buttton').attr('disabled', false);
					}
				}
				$("#product_display").show();
				$("#custom_product_display").hide();
				// getGST();
			}
			else {
				window.location.reload();
			}
		}
	});
}

function addDetailsLR() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var selected_tax = jQuery('input[name="selected_tax"]').val();

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}

				if (jQuery('.add_details_buttton').length > 0) {
					jQuery('.add_details_buttton').attr('disabled', true);
				}

				var all_errors_check = 1;
				var lr_id = "";
				if (jQuery('select[name="selected_lr_id"]').length > 0) {
					lr_id = jQuery('select[name="selected_lr_id"]').val();
					if (typeof lr_id == "undefined" || lr_id == "") {
						all_errors_check = 0;
					}
				}
				var from_branch_id = "";
				if(jQuery('select[name="from_branch_id"]').length > 0) {
					from_branch_id = jQuery('select[name="from_branch_id"]').val().trim();
				}
				var to_branch_id = "";
				if(jQuery('select[name="to_branch_id[]"]').length > 0) {
					to_branch_id = jQuery('select[name="to_branch_id[]"]').val();
				}
				if (all_errors_check == 1) {
					var add = 1;
					if (lr_id != "") {
						if (jQuery('input[name="lr_id[]"]').length > 0) {
							jQuery('.bill_products_table tbody').find('tr').each(function () {
								var prev_lr_id = jQuery(this).find('input[name="lr_id[]"]').val();
								if (prev_lr_id == lr_id) {
									add = 0;
								}
							});
						}
					}
					if (add == 1) {
						var product_count = jQuery('input[name="product_count"]').val();
						product_count = parseInt(product_count) + 1;
						jQuery('input[name="product_count"]').val(product_count);

						var post_url = "luggage_bill_changes.php?product_row_index3=" + product_count +"&lr_id=" + lr_id;
						jQuery.ajax({
							url: post_url, success: function (result) {

								if(jQuery('.bill_products_table tbody').find('tr').length > 0) {
									jQuery('.bill_products_table tbody').find('tr:first').before(result);
								}
								else {
									jQuery('.bill_products_table tbody').append(result);
								}
								if(jQuery('select[name="from_branch_id"]').length > 0) {
									jQuery('select[name="from_branch_id"]').parent().css('pointer-events', 'none');
								}
								if(jQuery('select[name="selected_lr_id"]').length > 0) {
									jQuery('select[name="selected_lr_id"]').val('').trigger("change");
									jQuery('select[name="selected_lr_id"]').focus();
								}
								if(jQuery('select[name="luggage_id"]').length > 0) {
									jQuery('select[name="luggage_id"]').val('').trigger("change");
								}

								if(jQuery('input[name="lr_id_check"]').length > 0) {
									jQuery('input[name="lr_id_check"]').val('');
								}

								jQuery('.luggagesheet_display').html('<div class="font-weight-bold text-pinterest smallfnt text-center">Lr Details</div><div class="text-center"></div>');

								if(jQuery('input[name="custom_unit_name"]').length > 0) {
									jQuery('input[name="custom_unit_name"]').val('');
								}
								
								if(jQuery('input[name="price_per_qty"]').length > 0) {
									jQuery('input[name="price_per_qty"]').val('');
								}
								if(jQuery('input[name="quantity"]').length > 0) {
									jQuery('input[name="quantity"]').val('');
								}
								if(jQuery('input[name="amount"]').length > 0) {
									jQuery('input[name="amount"]').val('');
								}
				
								if(jQuery('.add_details_buttton').length > 0) {
									jQuery('.add_details_buttton').attr('disabled', false);
								}

								LRNumberChanges(from_branch_id,to_branch_id);
							}
						});
					}
					else {
						jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">LR already Exists</span>');

						if (jQuery('.add_details_buttton').length > 0) {
							jQuery('.add_details_buttton').attr('disabled', false);
						}
					}
				}
				else {
					jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please check all field values</span>');
					if (jQuery('.add_details_buttton').length > 0) {
						jQuery('.add_details_buttton').attr('disabled', false);
					}
				}
				$("#product_display").show();
				$("#custom_product_display").hide();
				// getGST();
			}
			else {
				window.location.reload();
			}
		}
	});
}

function LRNumberChanges(from_branch_id,to_branch_id) {
	var lr_id_array = new Array();
	if(jQuery('.product_row').length > 0) {
		jQuery('.product_row').each(function(){
			var prev_lr_id = "";
			if(jQuery(this).find('input[name="lr_id[]"]').length > 0) {
				prev_lr_id = jQuery(this).find('input[name="lr_id[]"]').val();
				lr_id_array.push(prev_lr_id);
			}
		});
	}
	// alert(from_branch_id+"/////"+to_branch_id)
	// alert(lr_id_array)
	var post_url = "luggage_bill_changes.php?change_lr_id="+lr_id_array+"&from_branch_id="+from_branch_id+"&to_branch_id="+to_branch_id;
	jQuery.ajax({url: post_url, success: function(result){
		result = result.trim();
		// alert(result)
		if(jQuery('select[name="selected_lr_id"]').length > 0) {
			jQuery('select[name="selected_lr_id"]').html(result);
		}
		if(jQuery('select[name="selected_lr_id"]').length > 0) {
			jQuery('.bill_products_table tbody tr:first').find('select[name="selected_lr_id"]').select2('open');
		}
	}});
}

function updateproductcount(product_count)
{
	if(jQuery('input[name="product_count"]').length >0)
	{
		jQuery('input[name="product_count"]').val(product_count);
	}
}
function getDriverNo(driver_name){
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var post_url = "luggage_bill_changes.php?get_driver_no=" + driver_name;
				jQuery.ajax({
					url: post_url, success: function (result) {
						result = result.trim();
						if(jQuery('input[name="driver_number"]').length > 0){
							jQuery('input[name="driver_number"]').val(result);
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

function GetMultipleBranch(from_branch_id) {
	var post_url = "updation_action_changes.php?get_multiple_branch_list="+from_branch_id;
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = result.trim();
			if(jQuery('select[name="to_branch_id[]"]').length > 0) {
				jQuery('select[name="to_branch_id[]"]').html(result);
			}
			if(jQuery('select[name="destination_branch_id"]').length > 0) {
				jQuery('select[name="destination_branch_id"]').html('<option value="">Select</option>'+result);
			}
			getLRList();
		}
	});
}

function getLRList() {
	var from_branch_id = "";
	if(jQuery('select[name="from_branch_id"]').length > 0) {
		from_branch_id = jQuery('select[name="from_branch_id"]').val().trim();
	}
	var to_branch_id = "";
	if(jQuery('select[name="to_branch_id[]"]').length > 0) {
		to_branch_id = jQuery('select[name="to_branch_id[]"]').val();
	}
	var post_url = "updation_action_changes.php?get_from_branch_lr="+from_branch_id+"&get_to_branch_lr="+to_branch_id;
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = result.trim();
			if(jQuery('select[name="selected_lr_id"]').length > 0) {
				jQuery('select[name="selected_lr_id"]').html(result);
			}
		}
	});
}

function removedToBranchLR(){
	var to_branch_ids = "";
	if(jQuery('select[name="to_branch_id[]"]').length > 0) {
		to_branch_ids = jQuery('select[name="to_branch_id[]"]').val();
	}
	var prev_to_branch_ids_array = [];
	
	if(jQuery('.product_row').length > 0) {
		jQuery('.product_row').each(function(){
			var prev_to_branch_ids = "";
			if(jQuery(this).find('input[name="prev_to_branch_ids[]"]').length > 0) {
				prev_to_branch_ids = jQuery(this).find('input[name="prev_to_branch_ids[]"]').val();
				prev_to_branch_ids_array.push(prev_to_branch_ids);
			}
		});
	}

	var post_url = "luggage_bill_changes.php?removed_to_branch_ids="+to_branch_ids+"&prev_to_branch_ids="+prev_to_branch_ids_array;
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = result.trim();
			list = result.split(",");
			if(list != ""){
				for(var i=0 ; i<list.length; i++){
					if(jQuery('.product_row').length > 0) {
						jQuery('.product_row').each(function(){
							if(jQuery(this).find('input[name="prev_to_branch_ids[]"]').length > 0) {
								if(jQuery(this).find('input[name="prev_to_branch_ids[]"]').val() == list[i]){
										jQuery(this).remove();
								}
							}
						});
					}
				}
			}
		}
	});
}