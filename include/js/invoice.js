function AddDetails() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var from_date = ""; to_date = ""; consignor_id = "";
				if (jQuery('input[name="from_date"]').length > 0) {
					from_date = jQuery('input[name="from_date"]').val();
				}

				if (jQuery('input[name="to_date"]').length > 0) {
					to_date = jQuery('input[name="to_date"]').val();
				}

				var consignor_id = "";
				if (jQuery('select[name="consignor_id"]').length > 0) {
					consignor_id = jQuery('select[name="consignor_id"]').val();
					if (typeof consignor_id == "undefined" || consignor_id == "") {
					}
				}
				var organization_id = "";
				if (jQuery('select[name="organization_id"]').length > 0) {
					organization_id = jQuery('select[name="organization_id"]').val();
					if (typeof organization_id == "undefined" || organization_id == "") {
					}
				}
				var branch_id = "";
				if (jQuery('select[name="branch_id"]').length > 0) {
					branch_id = jQuery('select[name="branch_id"]').val();
					if (typeof branch_id == "undefined" || branch_id == "") {
					}
				}

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}
				var all_errors_check = 1;

				if (jQuery('.add_details_buttton').length > 0) {
					jQuery('.add_details_buttton').attr('disabled', true);
				}
				var lr_number = "";
				if (jQuery('select[name="lr_number"]').length > 0) {
					lr_number = jQuery('select[name="lr_number"]').val();
					if (typeof lr_number == "undefined" || lr_number == "" || lr_number == null) {
						// all_errors_check = 0;
					}
				}

				var add = 1;
				if (lr_number != "") {
					if (jQuery('input[name="lr_numbers[]"]').length > 0) {
						jQuery('.bill_lr_table tbody').find('tr').each(function () {
							var prev_lr_number = jQuery(this).find('input[name="lr_numbers[]"]').val();
							if (prev_lr_number == lr_number) {
								add = 0;
							}
						});
					}
				}

				if (organization_id != '' && branch_id != '') {
					if (all_errors_check == 1) {
						if (add == 1) {
							var lr_count = jQuery('input[name="lr_count"]').val();
							lr_count = parseInt(lr_count) + 1;
							jQuery('input[name="lr_count"]').val(lr_count);

							var post_url = "common_changes.php?lr_row_index=" + lr_count + "&selected_lr_number=" + lr_number + "&from_date=" + from_date + "&to_date=" + to_date + "&consignor_id=" + consignor_id + "&selected_branch_id=" + branch_id + "&organization_id=" + organization_id;

							jQuery.ajax({
								url: post_url, success: function (result) {
									if (jQuery('.bill_lr_table tbody').length > 0) {
										jQuery('.bill_lr_table tbody').html(result);

										jQuery('.bill_lr_table tbody').find('tr').each(function () {
											var lr_number = jQuery(this).find('input[name="lr_numbers[]"]').val();
											jQuery(".selected_lr_number option[value='" + lr_number + "']").remove();
										});
									}

									if (jQuery('select[name="lr_number"]').length > 0) {
										jQuery('select[name="lr_number"]').val('').trigger("change");
										jQuery('select[name="lr_number"]').focus();
									}


								}
							});
						}
						else {
							jQuery('.bill_lr_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Lr Number is already Exists</span>');

							if (jQuery('.add_details_buttton').length > 0) {
								jQuery('.add_details_buttton').attr('disabled', false);
							}
						}
					}
					else {
						jQuery('.bill_lr_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please select LR number</span>');
					}
				}
				$("#product_display").show();
				$("#custom_product_display").hide();
			}
			else {
				window.location.reload();
			}
		}
	});
}
function AddLRDetails() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var from_date = ""; to_date = ""; consignor_id = "";
				if (jQuery('input[name="from_date"]').length > 0) {
					from_date = jQuery('input[name="from_date"]').val();
				}

				if (jQuery('input[name="to_date"]').length > 0) {
					to_date = jQuery('input[name="to_date"]').val();
				}

				var consignor_id = "";
				if (jQuery('select[name="consignor_id"]').length > 0) {
					consignor_id = jQuery('select[name="consignor_id"]').val();
					if (typeof consignor_id == "undefined" || consignor_id == "") {
					}
				}
				var organization_id = "";
				if (jQuery('select[name="organization_id"]').length > 0) {
					organization_id = jQuery('select[name="organization_id"]').val();
					if (typeof organization_id == "undefined" || organization_id == "") {
					}
				}
				var branch_id = "";
				if (jQuery('select[name="branch_id"]').length > 0) {
					branch_id = jQuery('select[name="branch_id"]').val();
					if (typeof branch_id == "undefined" || branch_id == "") {
					}
				}

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}
				var all_errors_check = 1;

				if (jQuery('.add_details_buttton').length > 0) {
					jQuery('.add_details_buttton').attr('disabled', true);
				}
				var lr_number = "";
				if (jQuery('select[name="lr_number"]').length > 0) {
					lr_number = jQuery('select[name="lr_number"]').val();
					if (typeof lr_number == "undefined" || lr_number == "" || lr_number == null) {
						all_errors_check = 0;
					}
				}
				var add = 1;
				if (lr_number != "") {
					if (jQuery('input[name="lr_numbers[]"]').length > 0) {
						jQuery('.bill_lr_table tbody').find('tr').each(function () {
							var prev_lr_number = jQuery(this).find('input[name="lr_numbers[]"]').val();
							if (prev_lr_number == lr_number) {
								// add = 0;
								$(this).closest("option").remove();
							}
						});
					}
				}
				if (lr_number != "") {
					if (jQuery('input[name="lr_numbers[]"]').length > 0) {
						jQuery('select[name="lr_number"]').find('option').each(function () {
							var prev_lr_number = jQuery(this).find('input[name="lr_numbers[]"]').val();
							if (prev_lr_number == lr_number) {
								// add = 0;
								$(this).closest("option").remove();
							}
						});
					}
				}
				if (all_errors_check == 1) {
					if (add == 1) {
						var lr_count = jQuery('input[name="lr_count"]').val();
						lr_count = parseInt(lr_count) + 1;
						jQuery('input[name="lr_count"]').val(lr_count);

						var post_url = "common_changes.php?selected_lr_row_index=" + lr_count + "&selected_lr_number=" + lr_number + "&from_date=" + from_date + "&to_date=" + to_date + "&consignor_id=" + consignor_id + "&selected_branch_id=" + branch_id + "&organization_id=" + organization_id;

						jQuery.ajax({
							url: post_url, success: function (result) {
								jQuery(".selected_lr_number option[value='" + lr_number + "']").remove();
								if (jQuery('.bill_lr_table tbody').find('tr').length > 0) {
									jQuery('.bill_lr_table tbody').find('tr:first').before(result);
								}
								else {
									jQuery('.bill_lr_table tbody').append(result);
								}


								if (jQuery('select[name="lr_number"]').length > 0) {
									jQuery('select[name="lr_number"]').select2('open');
									// jQuery('select[name="lr_number"]').focus();
								}


							}
						});
					}
					else {
						jQuery('.bill_lr_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Lr Number is already Exists</span>');

						if (jQuery('.add_details_buttton').length > 0) {
							jQuery('.add_details_buttton').attr('disabled', false);
						}
					}
				}
				else {
					jQuery('.bill_lr_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please select LR number</span>');
					// if(jQuery('.bill_lr_table').length > 0) {
					// 	jQuery('.bill_lr_table').attr('disabled', false);
					// }
				}


				$("#product_display").show();
				$("#custom_product_display").hide();
				// calTotal();
				// checkOverallAmount();
				// getGST();
			}
			else {
				window.location.reload();
			}
		}
	});
}
function AddacknowledgementDetails() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}
				if (jQuery('.add_details_buttton').length > 0) {
					jQuery('.add_details_buttton').attr('disabled', true);
				}
				var tripsheet_number = "";
				if (jQuery('input[name="tripsheet_number"]').length > 0) {
					tripsheet_number = jQuery('input[name="tripsheet_number"]').val().trim();
					if (typeof tripsheet_number == "undefined" || tripsheet_number == "" || tripsheet_number == null) {
						all_errors_check = 0;
					}
				}
				var post_url = "updation_action_changes.php?selected_tripsheet_number="+tripsheet_number;
				jQuery.ajax({
					url: post_url, success: function (result) {
						if (jQuery('.invoice_details').length > 0) {
							jQuery('.invoice_details').html(result);
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
function show_inactive_tripsheet() {
	if (jQuery("#show_bill").val() == "0") {
		jQuery("#show_bill").val("1")
		jQuery("#show_button").html("Show Active Tripsheet")
		table_listing_records_filter();
	}
	else {
		jQuery("#show_bill").val("0")
		jQuery("#show_button").html("Show cancelled Tripsheet")
		table_listing_records_filter();
	}
}
function get_search_lr_number(lr_number, lr_id) {
	jQuery('input[name="lr_number"]').val(jQuery('.' + lr_number).text());
	var lr_number = jQuery('input[name="lr_number"]').val();
	lr_number = lr_number.trim();
	jQuery('input[name="lr_number"]').val(lr_number)
	getLrDetails(lr_number);
	// jQuery('input[name="selected_lr_id"]').val(lr_id)
	// jQuery('input[name="selected_lr_id"]').val(lr_id).change();
	jQuery('#show_lr_number_list').hide();
}
function search_lr_number_list(form_name) {
	var input, filter, ul, li, a, i;
	input = document.forms[form_name]["lr_number"];
	filter = input.value.toUpperCase();
	if (filter != '') {
		jQuery('#show_lr_number_list').show();
		ul = document.getElementById("show_lr_number_list");
		li = ul.getElementsByTagName('li');
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("a")[0];
			a = a.innerHTML;
			a = a.split("/");
			if (a[0].toUpperCase().indexOf(filter) > -1) {
				// if($("<a></a>").length == 1)
				// {
				li[i].style.display = "";
				li[i].classList.add('current');

			} else {
				li[i].style.display = "none";
				li[i].classList.remove('current');
			}
		}
		if ($(".current").length == 1) {
			$("#show_lr_number_list").find('li').removeClass("active")
			$("#show_lr_number_list").find('li:visible').focus();
			$("#show_lr_number_list").find('li:visible').addClass("active")
		}
	}
	else
		jQuery('#show_lr_number_list').hide();
}
function getLrDetails(lr_number) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var post_url = "common_changes.php?get_lr_number=" + lr_number;
				jQuery.ajax({
					url: post_url, success: function (result) {
						// var list = result.split("$$$");
						// if (jQuery('input[name="consignee_mobile_number"]').length > 0) {
						// 	jQuery('input[name="consignee_mobile_number"]').val(list[0]);
						// }
						if(jQuery(".lr_details").length >0)
						{
							jQuery(".lr_details").html(result);
						}
						jQuery(".search_list li.active").css("display", "none");
					}
				});

			}
			else {
				window.location.reload();
			}
		}
	});
}
function getClear() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				// jQuery('#clearmodal .modal-body').html('');
				var post_url = "clearance_entry_changes.php?is_clear=1";
				jQuery.ajax({
					url: post_url, success: function (result) {
						
						jQuery('#clearancemodal .modal-body').html(result);
						jQuery('.modal-backdrop').each(function () {
							jQuery(this).remove();
						});
						// jQuery('.modal-backdrop').remove();
						jQuery('.clearance_modal_button').trigger("click");
					}
				});
			}
			else {
				window.location.reload();
			}
		}
	});
}
function getacknowledgementInvoice(tripsheet_id) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}
				if(jQuery('#AcknowledgementInvoiceModal .modal-body').length > 0) {
					jQuery('#AcknowledgementInvoiceModal .modal-body').html('');
				}
				var post_url = "updation_action_changes.php?selected_tripsheet_id=" + tripsheet_id;
				jQuery.ajax({
					url: post_url, success: function (result) {
						if(jQuery('#AcknowledgementInvoiceModal .modal-body').length > 0) {
							jQuery('#AcknowledgementInvoiceModal .modal-body').html(result);
						}
						if(jQuery('.acknowledgement_invoice_modal_button').length > 0) {
							jQuery('.acknowledgement_invoice_modal_button').trigger("click");
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
function DeleteLrRow(row_index, lr_number) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('#lr_row' + row_index).length > 0) {
					jQuery('#lr_row' + row_index).remove();
					// jQuery(".selected_lr_number option[value='" + lr_number + "']").add();
					let optionHTML = `
					<option value="${lr_number}">
						${lr_number}
					</option>`;
					$('.selected_lr_number').append(optionHTML);
				}
				calTotal();
			}
			else {
				window.location.reload();
			}
		}
	});
}
function calTotal() {
	if (jQuery('.sno').length > 0) {
		var row_count = 0;
		row_count = jQuery('.sno').length;
		if (typeof row_count != "undefined" && row_count != null && row_count != 0 && row_count != "") {
			var j = 1;
			var sno = document.getElementsByClassName('sno');
			for (var i = row_count - 1; i >= 0; i--) {
				// if(jQuery('.bill_products_table tbody').find('tr:nth-child('+i+')').length > 0) {
				// 	jQuery('.bill_products_table tbody').find('tr:nth-child('+i+')').find('.sno').html(j);
				// 	j = parseInt(j) + 1;
				// }
				sno[i].innerHTML = j;
				j = parseInt(j) + 1;
			}
		}
	}


	// getGST();
	// checkDiscount();
	// getbilltype();
}
function getLRNo() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {


				var branch_id = "";
				if (jQuery('select[name="branch_id"]').length > 0) {
					branch_id = jQuery('select[name="branch_id"]').val();
					if (typeof branch_id == "undefined" || branch_id == "") {
						all_errors_check = 0;
					}
				}
				var organization_id = "";
				if (jQuery('select[name="organization_id"]').length > 0) {
					organization_id = jQuery('select[name="organization_id"]').val();
					if (typeof organization_id == "undefined" || organization_id == "") {
						all_errors_check = 0;
					}
				}
				if (branch_id != "") {
					var post_url = "common_changes.php?branch_id=" + branch_id + "&organization_id=" + organization_id;
					jQuery.ajax({
						url: post_url, success: function (result) {

							if (jQuery('#lr_id').html().length > 0) {
								jQuery('#lr_id').html(result);
							}
							else {
								// jQuery('.invoice_bill_table tbody').append(result);
							}

						}
					});
				}
				else {
					jQuery('.invoice_bill_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">This L.R.No already Exists</span>');

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
function getConsignorDetails() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {


				var branch_id = "";
				if (jQuery('select[name="branch_id"]').length > 0) {
					branch_id = jQuery('select[name="branch_id"]').val();
					if (typeof branch_id == "undefined" || branch_id == "") {
						all_errors_check = 0;
					}
				}
				var organization_id = "";
				if (jQuery('select[name="organization_id"]').length > 0) {
					organization_id = jQuery('select[name="organization_id"]').val();
					if (typeof organization_id == "undefined" || organization_id == "") {
						all_errors_check = 0;
					}
				}
				if (branch_id != "") {

					var post_url = "common_changes.php?consignor_branch_id=" + branch_id + "&consignor_organization_id=" + organization_id;
					jQuery.ajax({
						url: post_url, success: function (result) {
							if (jQuery('#consignor_id').html().length > 0) {
								jQuery('#consignor_id').html(result);
							}
							else {
								// jQuery('.invoice_bill_table tbody').append(result);
							}

						}
					});
				}
				else {
					jQuery('.invoice_bill_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">This L.R.No already Exists</span>');

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
function NewVehicle() {
	jQuery('.vehicle_modal_button').trigger("click");
}
function getClearanceDetails() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var option = 1;
				if (jQuery('#length_check').prop('checked') == false) {
					option = 0;
				}

				if (option == 1) {
					var lr_id = "";
					if (jQuery('input[name="lr_id"]').length > 0) {
						lr_id = jQuery('input[name="lr_id"]').val();
						if (typeof lr_id == "undefined" || lr_id == "") {
							all_errors_check = 0;
						}
					}
					if (lr_id != "") {

						var post_url = "common_changes.php?lr_id=" + lr_id;
						jQuery.ajax({
							url: post_url, success: function (lr_details) {
								result = lr_details.split("$$$");
								// if(jQuery('#consignee_name').val().length > 0) {
								jQuery('#consignee_name').val(result[0]);
								// }
								// if(jQuery('#mobile_number').val().length >0)
								// {
								jQuery('#mobile_number').val(result[1]);
								// }		

							}
						});
					}
					else {
						jQuery('.invoice_bill_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">This L.R.No already Exists</span>');

						if (jQuery('.add_details_buttton').length > 0) {
							jQuery('.add_details_buttton').attr('disabled', false);
						}
					}
				}
				else {
					jQuery('#consignee_name').val('');
					jQuery('#mobile_number').val('');
				}


			}
			else {
				window.location.reload();
			}
		}
	});
}
function SaveCustomVehicle() {
	if (jQuery('.vehicle_preview').length > 0) {
		jQuery('.vehicle_preview').html('');
	}
	var res = ValidCustomvehicle();
	if (res == true) {

		var custom_vehicle = "";
		var custom_vehicle_name = ""; var custom_vehicle_mobile_number = ""; var custom_vehicle_city = ""; var custom_vehicle_state = ""; var valid = 1;
		if (jQuery('input[name="custom_vehicle_name"]').length > 0) {
			custom_vehicle_name = jQuery('input[name="custom_vehicle_name"]').val();
			custom_vehicle_name = custom_vehicle_name.trim();
			if (typeof custom_vehicle_name != "undefined" || custom_vehicle_name != "") {
				custom_vehicle = custom_vehicle_name;
			}
		}
		if (jQuery('input[name="custom_vehicle_mobile_number"]').length > 0) {
			custom_vehicle_mobile_number = jQuery('input[name="custom_vehicle_mobile_number"]').val();
			custom_vehicle_mobile_number = custom_vehicle_mobile_number.trim();
			if (typeof custom_vehicle_mobile_number != "undefined" || custom_vehicle_mobile_number != "") {
				custom_vehicle = custom_vehicle + '<br>' + custom_vehicle_mobile_number;
			}
		}
		if (jQuery('input[name="custom_vehicle_numberr"]').length > 0) {
			custom_vehicle_numberr = jQuery('input[name="custom_vehicle_numberr"]').val();
			custom_vehicle_numberr = custom_vehicle_numberr.trim();
			if (typeof custom_vehicle_numberr != "undefined" || custom_vehicle_numberr != "") {
				custom_vehicle = custom_vehicle + '<br>' + custom_vehicle_numberr;
			}
		}

		if (typeof custom_vehicle != "undefined" || custom_vehicle != "") {
			if (jQuery('.vehicle_preview').length > 0) {
				jQuery('.vehicle_preview').html('<b>Custom vehicle Details</b> <br> ' + custom_vehicle);
			}
		}

		jQuery('.vehicle_modal_button').trigger("click");
		getGST();
	}
}
function getunclrprintdetails() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var from_date = "";
				if (jQuery('input[name="from_date"]').length > 0) {
					from_date = jQuery('input[name="from_date"]').val();
					if (typeof from_date == "undefined" || from_date == "") {
						all_errors_check = 0;
					}
				}

				var to_date = "";
				if (jQuery('input[name="to_date"]').length > 0) {
					to_date = jQuery('input[name="to_date"]').val();
					if (typeof to_date == "undefined" || to_date == "") {
						all_errors_check = 0;
					}
				}
				var branch_id = "";
				if (jQuery('select[name="branch_id"]').length > 0) {
					branch_id = jQuery('select[name="branch_id"]').val();
					if (typeof branch_id == "undefined" || branch_id == "") {
						all_errors_check = 0;
					}
				}
				var bill_type = "";
				if (jQuery('select[name="bill_type"]').length > 0) {
					bill_type = jQuery('select[name="bill_type"]').val();
					if (typeof bill_type == "undefined" || bill_type == "") {
						all_errors_check = 0;
					}
				}
				var consignor_id = "";
				if (jQuery('select[name="consignor_id"]').length > 0) {
					consignor_id = jQuery('select[name="consignor_id"]').val();
					if (typeof consignor_id == "undefined" || consignor_id == "") {
						all_errors_check = 0;
					}
				}
				var organization_id = "";
				if (jQuery('select[name="organization_id"]').length > 0) {
					organization_id = jQuery('select[name="organization_id"]').val();
					if (typeof organization_id == "undefined" || organization_id == "") {
						all_errors_check = 0;
					}
				}
				var consignee_id = "";
				if (jQuery('select[name="consignee_id"]').length > 0) {
					consignee_id = jQuery('select[name="consignee_id"]').val();
					if (typeof consignee_id == "undefined" || consignee_id == "") {
						all_errors_check = 0;
					}
				}
				var search_text = "";
				if (jQuery('input[name="search_text"]').length > 0) {
					search_text = jQuery('input[name="search_text"]').val();
					if (typeof search_text == "undefined" || search_text == "") {
						all_errors_check = 0;
					}
				}
				window.open("reports/rpt_un_cl_lr_report.php?from_date=" + from_date + "&to_date=" + to_date + "&branch_id=" + branch_id + "&organization_id=" + organization_id + "&consignor_id=" + consignor_id + "&bill_type" + bill_type + "&consignee_id=" + consignee_id + "&search_text=" + search_text, "blank");
			}
			else {
				window.location.reload();
			}
		}
	});
}
function getclrprintdetails() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var from_date = "";
				if (jQuery('input[name="from_date"]').length > 0) {
					from_date = jQuery('input[name="from_date"]').val();
					if (typeof from_date == "undefined" || from_date == "") {
						all_errors_check = 0;
					}
				}

				var to_date = "";
				if (jQuery('input[name="to_date"]').length > 0) {
					to_date = jQuery('input[name="to_date"]').val();
					if (typeof to_date == "undefined" || to_date == "") {
						all_errors_check = 0;
					}
				}
				var branch_id = "";
				if (jQuery('select[name="branch_id"]').length > 0) {
					branch_id = jQuery('select[name="branch_id"]').val();
					if (typeof branch_id == "undefined" || branch_id == "") {
						all_errors_check = 0;
					}
				}
				var organization_id = "";
				if (jQuery('select[name="organization_id"]').length > 0) {
					organization_id = jQuery('select[name="organization_id"]').val();
					if (typeof organization_id == "undefined" || organization_id == "") {
						all_errors_check = 0;
					}
				}
				var consignor_id = "";
				if (jQuery('select[name="consignor_id"]').length > 0) {
					consignor_id = jQuery('select[name="consignor_id"]').val();
					if (typeof consignor_id == "undefined" || consignor_id == "") {
						all_errors_check = 0;
					}
				}
				var consignee_id = "";
				if (jQuery('select[name="consignee_id"]').length > 0) {
					consignee_id = jQuery('select[name="consignee_id"]').val();
					if (typeof consignee_id == "undefined" || consignee_id == "") {
						all_errors_check = 0;
					}
				}
				var bill_type = "";
				if (jQuery('select[name="bill_type"]').length > 0) {
					bill_type = jQuery('select[name="bill_type"]').val();
					if (typeof bill_type == "undefined" || bill_type == "") {
						all_errors_check = 0;
					}
				}
				var search_text = "";
				if (jQuery('input[name="search_text"]').length > 0) {
					search_text = jQuery('input[name="search_text"]').val();
					if (typeof search_text == "undefined" || search_text == "") {
						all_errors_check = 0;
					}
				}
				window.open("reports/rpt_cl_lr_report.php?from_date=" + from_date + "&to_date=" + to_date + "&branch_id=" + branch_id + "&consignor_id=" + consignor_id + "&consignee_id=" + consignee_id + "&organization_id=" + organization_id + "&bill_type=" + bill_type + "&search_text=" + search_text, "blank");
			}
			else {
				window.location.reload();
			}
		}
	});
}
function getAckprintdetails() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var from_date = "";
				if (jQuery('input[name="from_date"]').length > 0) {
					from_date = jQuery('input[name="from_date"]').val();
					if (typeof from_date == "undefined" || from_date == "") {
						all_errors_check = 0;
					}
				}

				var to_date = "";
				if (jQuery('input[name="to_date"]').length > 0) {
					to_date = jQuery('input[name="to_date"]').val();
					if (typeof to_date == "undefined" || to_date == "") {
						all_errors_check = 0;
					}
				}
				var branch_id = "";
				if (jQuery('select[name="branch_id"]').length > 0) {
					branch_id = jQuery('select[name="branch_id"]').val();
					if (typeof branch_id == "undefined" || branch_id == "") {
						all_errors_check = 0;
					}
				}
				var organization_id = "";
				if (jQuery('select[name="organization_id"]').length > 0) {
					organization_id = jQuery('select[name="organization_id"]').val();
					if (typeof organization_id == "undefined" || organization_id == "") {
						all_errors_check = 0;
					}
				}
				var search_text = "";
				if (jQuery('input[name="search_text"]').length > 0) {
					search_text = jQuery('input[name="search_text"]').val();
					if (typeof search_text == "undefined" || search_text == "") {
						all_errors_check = 0;
					}
				}
				window.open("reports/rpt_invoice_ack.php?from_date=" + from_date + "&to_date=" + to_date + "&organization_id=" + organization_id + "&branch_id=" + branch_id + "&search_text=" + search_text, "blank");
			}
			else {
				window.location.reload();
			}
		}
	});
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
		custom_vehicle_mobile_number = jQuery('input[name="custom_vehicle_mobile_number"]').val();
		custom_vehicle_mobile_number = custom_vehicle_mobile_number.trim();
		// if(typeof custom_vehicle_mobile_number == "undefined" || custom_vehicle_mobile_number == "") {
		// 	valid = 0;
		// 	jQuery('input[name="custom_vehicle_mobile_number"]').parent().parent().append('<span class="infos">Enter the mobile number </span>');
		// }
		// else{

		if (custom_vehicle_mobile_number != 'undefined' && custom_vehicle_mobile_number != '') {

			var phoneno = /^\d{10}$/;
			if (!custom_vehicle_mobile_number.match(phoneno)) {
				jQuery('input[name="custom_vehicle_mobile_number"]').parent().parent().append('<span class="infos">Invalid Mobile Number</span>');
				valid = 0;
			}
			else if (format.test(custom_vehicle_mobile_number) == true) {
				jQuery('input[name="custom_vehicle_mobile_number"]').parent().parent().append('<span class="infos">Invalid Mobile Number</span>');
				valid = 0;
			}
		}
		// }
	}
	if (jQuery('input[name="custom_vehicle_number"]').length > 0) {
		custom_vehicle_number = jQuery('input[name="custom_vehicle_number"]').val();
		custom_vehicle_number = custom_vehicle_number.trim();
		if (typeof custom_vehicle_number == "undefined" || custom_vehicle_number == "") {
			valid = 0;
			jQuery('input[name="custom_vehicle_number"]').parent().parent().append('<span class="infos">Enter the Vehicle number </span>');
		}
		else {
			if (format.test(custom_vehicle_number) == true) {
				jQuery('input[name="custom_vehicle_number"]').parent().parent().append('<span class="infos">Invalid vehicle number</span>');
				valid = 0;
			}
		}
	}

	return valid;
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
					var post_url = "common_changes.php?get_details_vehicle_id=" + vehicle_id;
					jQuery.ajax({
						url: post_url, success: function (result) {
							if (typeof result != "undefined" && result != "") {
								result = JSON.parse(result);
								var party_details = "";
								if (typeof result.name != "undefined" && result.name != "") {
									party_details = result.name;
								}
								if (typeof result.mobile_number != "undefined" && result.mobile_number != "") {
									party_details = party_details + '<br>' + result.mobile_number;
								}
								if (typeof result.vehicle_number != "undefined" && result.vehicle_number != "") {
									party_details = party_details + '<br>' + result.vehicle_number;
								}
								if (typeof party_details != "undefined" && party_details != "") {
									jQuery('.vehicle_preview').html('<b>Party Details</b> <br> ' + party_details);
									// getGST();
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
	getGST();
}
function ProductRowCheck(obj) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}

				var all_errors_check = 1;

				var selected_product_id = "";
				if (jQuery(obj).parent().parent().find('input[name="product_id[]"]').length > 0) {
					selected_product_id = jQuery(obj).parent().parent().find('input[name="product_id[]"]').val();
					if (typeof selected_product_id == "undefined" || selected_product_id == "") {
						all_errors_check = 0;
					}
				}
				var selected_quantity = "";
				if (jQuery(obj).parent().parent().find('input[name="quantity[]"]').length > 0) {
					selected_quantity = jQuery(obj).parent().parent().find('input[name="quantity[]"]').val();
					if (typeof selected_quantity != "undefined" && selected_quantity != "" && selected_quantity != 0) {
						selected_quantity = selected_quantity.replace(/ /g, '');
						selected_quantity = selected_quantity.trim();
						if (numbers_regex.test(selected_quantity) == false) {
							jQuery(obj).parent().parent().find('input[name="quantity[]"]').after('<span class="infos">Invalid Quantity</span>');
							all_errors_check = 0;
						}
						else {
							var product_current_stock = "";
							if (jQuery(obj).parent().parent().find('.product_current_stock').length > 0) {
								product_current_stock = jQuery(obj).parent().parent().find('.product_current_stock').html();
								if (typeof product_current_stock != "undefined" && product_current_stock != "" && product_current_stock != 0) {
									product_current_stock = product_current_stock.replace(/ /g, '');
									product_current_stock = product_current_stock.trim();
									if (numbers_regex.test(product_current_stock) == true) {
										if (parseInt(selected_quantity) > parseInt(product_current_stock)) {
											// jQuery(obj).parent().parent().find('input[name="quantity[]"]').after('<span class="infos">Max.Stock : '+product_current_stock+'</span>');
											// all_errors_check = 0;
										}
									}
								}
							}
						}
					}
					else {
						all_errors_check = 0;
					}
				}
				var selected_rate = "";
				if (jQuery(obj).parent().parent().find('input[name="rate[]"]').length > 0) {
					selected_rate = jQuery(obj).parent().parent().find('input[name="rate[]"]').val();
					if (typeof selected_rate != "undefined" && selected_rate != "" && selected_rate != 0) {
						selected_rate = selected_rate.replace(/ /g, '');
						selected_rate = selected_rate.trim();
						if (price_regex.test(selected_rate) == false) {
							jQuery(obj).parent().parent().find('input[name="rate[]"]').after('<span class="infos">Invalid Rate</span>');
							all_errors_check = 0;
						}
					}
					else {
						all_errors_check = 0;
					}
				}

				var selected_discount = "";
				if (jQuery(obj).parent().parent().find('input[name="product_discount[]"]').length > 0) {
					selected_discount = jQuery(obj).parent().parent().find('input[name="product_discount[]"]').val();
				}

				if (all_errors_check == 1) {
					if ((parseFloat(selected_rate) > 0 && price_regex.test(selected_rate) == true) && parseInt(selected_quantity) && numbers_regex.test(selected_quantity) == true) {
						var selected_amount = parseFloat(selected_rate) * parseInt(selected_quantity);
						selected_amount = check_decimal(selected_amount);
						if (jQuery(obj).parent().parent().find('.amount').length > 0) {
							jQuery(obj).parent().parent().find('.amount').html(selected_amount);

							if ($("#discount_option").val() == "1") {
								if (typeof selected_discount != "undefined" && selected_discount != "" && selected_discount != 0) {
									if (selected_discount.indexOf('%') != -1) {
										selected_discount = selected_discount.replace('%', '');
										selected_discount = selected_discount.trim();
										if (price_regex.test(selected_discount) == true) {
											selected_discount = ((parseFloat(selected_rate) * parseInt(selected_quantity)) * parseFloat(selected_discount)) / 100;
										}
									}
									var discount_amount = (parseFloat(selected_rate) * parseInt(selected_quantity)) - parseFloat(selected_discount);
									discount_amount = check_decimal(discount_amount);
									jQuery(obj).parent().parent().find('.product_total').html(discount_amount);
								}
								else {
									jQuery(obj).parent().parent().find('.product_total').html(check_decimal(parseFloat(selected_rate) * parseInt(selected_quantity)));
								}
							}
							showDiscount()
						}
					}
				}
				else {
					if (jQuery(obj).parent().parent().find('.amount').length > 0) {
						jQuery(obj).parent().parent().find('.amount').html('');
					}
					//jQuery('.invoice_bill_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please check all field values</span>');
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}
function DeleteReceiptRow(row_index) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('#receipt_row' + row_index).length > 0) {
					jQuery('#receipt_row' + row_index).remove();
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}
function cancel_split_modal(gcno, quantity, unit_id, rate) {
	jQuery('#modal1 .modal-header .close').trigger("click");
	document.getElementById(gcno + unit_id).value = quantity;
	document.getElementById(gcno + unit_id + 'freight').value = rate;
	document.getElementById(gcno + unit_id + 'td_freight').innerHTML = check_decimal(rate);
}
function check_decimal(check_number) {
	if (check_number != '' && check_number != 0) {
		var decimal = ""; var round_off = ''; var numbers = "";
		numbers = check_number.toString().split('.');
		if (typeof numbers[1] != 'undefined') {
			decimal = numbers[1];
		}
		if (decimal != "" && decimal != 00) {
			if (decimal.length == 1) {
				decimal = decimal + '0';
				check_number = numbers[0] + '.' + decimal;
			}
			if (decimal.length > 2) {
				check_number = check_number.toFixed(2);
			}
		}
		else {
			check_number = numbers[0] + '.00';
		}
	}
	return check_number;
}
function confirm_split_modal(gcno, unit_id, rate) {
	jQuery('#modal1 .modal-header .close').trigger("click");
	document.getElementById(gcno + unit_id + 'freight').value = rate;
	document.getElementById(gcno + unit_id + 'td_freight').innerHTML = check_decimal(rate);
}
function load_lorry_no(value) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var post_url = "common_changes.php?load_lorry_no=1&lorry_id=" + value;
				jQuery.ajax({
					url: post_url, success: function (lorry_details) {
						lorry_details = lorry_details.split("$$$");
						var lorry_number = ""; var lorry_mobile_number = "";
						if (lorry_details[0] != '') {
							lorry_number = lorry_details[0];
						}
						if (lorry_details[1] != '') {
							lorry_mobile_number = lorry_details[1];
						}

						if (jQuery('input[name="lorry_number"]').length > 0) {
							jQuery('input[name="lorry_number"]').val(lorry_number);
						}
						if (jQuery('input[name="lorry_mobile_number"]').length > 0) {
							jQuery('input[name="lorry_mobile_number"]').val(lorry_mobile_number);
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
function show_invoice_list() {
	var company_id = $("#filter_company_id").val();
	var from_date = $("#from_date").val();
	var to_date = $("#to_date").val();
	var search_text = $("#search_text").val();
	window.open("reports/rpt_invoice_list.php?company_id=" + company_id + "&from_date=" + from_date + "&to_date=" + to_date + "&search_text=" + search_text);
}
function exp_invoice_list() {
	var company_id = $("#filter_company_id").val();
	var from_date = $("#from_date").val();
	var to_date = $("#to_date").val();
	var search_text = $("#search_text").val();
	window.open("exp_invoice_list.php?company_id=" + company_id + "&from_date=" + from_date + "&to_date=" + to_date + "&search_text=" + search_text, '_self');
}
function getcheckboxcleared1(){
	var option = 1;
	if (jQuery('#length_check').prop('checked') == false) {
		jQuery('#length_check').prop('checked',true);
		getClearanceDetails();
	}
	else
	{
		jQuery('#length_check').prop('checked',false);
		getClearanceDetails();
	}
}
function getcheckboxcleared(){
	var option = 1;
	if (jQuery('#length_check').prop('checked') == false) {
		jQuery('#length_check').prop('checked',true);
		getClearDetails();
	}
	else
	{
		jQuery('#length_check').prop('checked',false);
		getClearDetails();
	}
}
function getClearDetails() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var option = 1;
				if (jQuery('#length_check').prop('checked') == false) {
					option = 0;
				}

				if (option == 1) {
					var clear_lr_number = "";
					if (jQuery('input[name="lr_number"]').length > 0) {
						clear_lr_number = jQuery('input[name="lr_number"]').val();
						if (typeof clear_lr_number == "undefined" || clear_lr_number == "") {
							all_errors_check = 0;
						}
					}
					if (clear_lr_number != "") {

						var post_url = "common_changes.php?clear_lr_number=" + clear_lr_number;
						jQuery.ajax({
							url: post_url, success: function (lr_details) {
								result = lr_details.split("$$$");
								// if(jQuery('#consignee_name').val().length > 0) {
								jQuery('input[name="clear_name"]').val(result[0]);
								// }
								// if(jQuery('#mobile_number').val().length >0)
								// {
								jQuery('input[name="clear_mobile_number"]').val(result[1]);
								// }		

							}
						});
					}
					else {
						jQuery('.invoice_bill_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">This L.R.No already Exists</span>');

						if (jQuery('.add_details_buttton').length > 0) {
							jQuery('.add_details_buttton').attr('disabled', false);
						}
					}
				}
				else {
					jQuery('#consignee_name').val('');
					jQuery('#mobile_number').val('');
				}


			}
			else {
				window.location.reload();
			}
		}
	});
}
