var price_regex = /^(\d*\.)?\d+$/;
var numbers_regex = /^\d+$/;

function consignorDetails(consignor_id) {
	if (jQuery('input[name="consignor_state"]').length > 0) {
		jQuery('input[name="consignor_state"]').val("");
	}
	if (jQuery('.consignor_preview').length > 0) {
		jQuery('.consignor_preview').html('');
	}
	if (typeof consignor_id != "undefined" && consignor_id != "") {
		var check_login_session = 1;
		var post_url = "dashboard_changes.php?check_login_session=1";
		jQuery.ajax({
			url: post_url, success: function (check_login_session) {
				if (check_login_session == 1) {
					var post_url = "lr_bill_changes.php?get_details_consignor_id=" + consignor_id;
					jQuery.ajax({
						url: post_url, success: function (result) {
							if (typeof result != "undefined" && result != "") {
								result = JSON.parse(result);
								var consignor_details = "";
								if (typeof result.name != "undefined" && result.name != "") {
									consignor_details = result.name;
								}
								if (typeof result.mobile_number != "undefined" && result.mobile_number != "") {
									consignor_details = consignor_details + '<br>' + result.mobile_number;
								}
								if (typeof result.identification != "undefined" && result.identification != "") {
									consignor_details = consignor_details + '<br>' + result.identification;
								}
								if (typeof result.address != "undefined" && result.address != "") {
									consignor_details = consignor_details + '<br>' + result.address;
								}
								// if (typeof result.email != "undefined" && result.email != "") {
								// 	consignor_details = consignor_details + '<br>' + result.email;
								// }
								
								if (typeof result.city != "undefined" && result.city != "") {
									consignor_details = consignor_details + '<br>' + result.city;
								}
								if (typeof result.district != "undefined" && result.district != "") {
									consignor_details = consignor_details + '<br>' + result.district;
								}
								if (typeof result.state != "undefined" && result.state != "") {
									consignor_details = consignor_details + '<br>' + result.state;
									if (jQuery('input[name="consignor_state"]').length > 0) {
										jQuery('input[name="consignor_state"]').val(result.state);
									}
								}
								if (typeof result.gst_number != "undefined" && result.gst_number != "") {
									consignor_details = consignor_details + '<br>' + result.gst_number;
								}
								if (typeof consignor_details != "undefined" && consignor_details != "") {
									jQuery('.consignor_preview').html(consignor_details);
								}
								getBillType();
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
	else
	{
		if (jQuery('input[name="consignor_mobile_number"]').length > 0) {
			jQuery('input[name="consignor_mobile_number"]').val('');
		}
		if (jQuery('input[name="selected_consignor_id"]').length > 0) {
			jQuery('input[name="selected_consignor_id"]').val('');
		}
		if (jQuery('input[name="consignor_identification"]').length > 0) {
			jQuery('input[name="consignor_identification"]').val('');
		}
	}
}
function addRow()
{
	if ($(".add_button").length > 0) {
		$(".add_button").addClass('d-none')
	}
	if ($(".delete_button").length > 0) {
		$(".delete_button").removeClass('d-none')
	}
	var check_login_session =1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var post_url = "lr_bill_changes.php?add_row=1";
				jQuery.ajax({
					url: post_url, success: function (result) {
						if(jQuery('.bill_products_table tbody').find('tr').length > 0) {
							jQuery('.bill_products_table tbody').find('tr:first').before(result);
						}
						else {
							jQuery('.bill_products_table tbody').append(result);
						}
						calTotal();
					}
				});
			}
		}
	});

}
function DeleteProductRow(obj) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery(obj).parent().parent().parent().length > 0) {
					jQuery(obj).parent().parent().parent().remove();
				}
				calTotal();
			}
			else {
				window.location.reload();
			}
		}
	});
}
function show_inactive_lr() {
	if (jQuery("#show_bill").val() == "0") {
		jQuery("#show_bill").val("1")
		jQuery("#show_button").html("Show Active LR")
	}
	else {
		jQuery("#show_bill").val("0")
		jQuery("#show_button").html("Show cancelled LR")
	}
}
function consigneeDetails(consignee_id) {
	if (jQuery('input[name="consignee_state"]').length > 0) {
		jQuery('input[name="consignee_state"]').val("");
	}
	if (jQuery('.consignee_preview').length > 0) {
		jQuery('.consignee_preview').html('');
	}
	if (typeof consignee_id != "undefined" && consignee_id != "") {
		var check_login_session = 1;
		var post_url = "dashboard_changes.php?check_login_session=1";
		jQuery.ajax({
			url: post_url, success: function (check_login_session) {
				if (check_login_session == 1) {
					var post_url = "lr_bill_changes.php?get_details_consignee_id=" + consignee_id;
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
								if (typeof result.identification != "undefined" && result.identification != "") {
									party_details = party_details + '<br>' + result.identification;
								}
								// if (typeof result.email != "undefined" && result.email != "") {
								// 	party_details = party_details + '<br>' + result.email;
								// }
								if (typeof result.address != "undefined" && result.address != "") {
									party_details = party_details + '<br>' + result.address;
								}
								if (typeof result.city != "undefined" && result.city != "") {
									party_details = party_details + '<br>' + result.city;
								}
								if (jQuery('select[name="city"]').length > 0) {
									jQuery('select[name="city"]').val(result.city).change();
								}
								if (typeof result.district != "undefined" && result.district != "") {
									party_details = party_details + '<br>' + result.district;
								}
								if (typeof result.state != "undefined" && result.state != "") {
									party_details = party_details + '<br>' + result.state;
								}
								if (jQuery('input[name="consignee_state"]').length > 0) {
									jQuery('input[name="consignee_state"]').val(result.state);
								}
								// if (typeof result.identification != "undefined" && result.identification != "") {
								// 	party_details = party_details + '<br>' + result.identification;
								// }
								if (typeof party_details != "undefined" && party_details != "") {
									jQuery('.consignee_preview').html(party_details);
								}
								getBillType();
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
	else
	{
		if(jQuery('input[name="consignee_mobile_number"]').length >0)
		{
			jQuery('input[name="consignee_mobile_number"]').val('');
		}
		if(jQuery('input[name="consignee_mobile_number"]').length >0)
		{
			jQuery('input[name="consignee_mobile_number"]').val('');
		}
		if(jQuery('input[name="selected_consignee_id"]').length >0)
		{
			jQuery('input[name="selected_consignee_id"]').val('');
		}
		if(jQuery('select[name="state"]').length >0)
		{
			jQuery('select[name="state"]').val('Tamil Nadu').trigger("change");
		}
	}
}
function account_partyDetails(account_party_id) {
	if (jQuery('.account_party_preview').length > 0) {
		jQuery('.account_party_preview').html('');
	}
	if (typeof account_party_id != "undefined" && account_party_id != "") {
		var check_login_session = 1;
		var post_url = "dashboard_changes.php?check_login_session=1";
		jQuery.ajax({
			url: post_url, success: function (check_login_session) {
				if (check_login_session == 1) {
					var post_url = "lr_bill_changes.php?get_details_account_party_id=" + account_party_id;
					jQuery.ajax({
						url: post_url, success: function (result) {

							if (typeof result != "undefined" && result != "") {
								result = JSON.parse(result);
								var party_details = "";
								if (typeof result.name != "undefined" && result.name != "") {
									party_details = result.name;
								}
								// if (typeof result.mobile_number != "undefined" && result.mobile_number != "") {
								// 	party_details = party_details + '<br>' + result.mobile_number;
								// }
								// if (typeof result.email != "undefined" && result.email != "") {
								// 	party_details = party_details + '<br>' + result.email;
								// }
								// if (typeof result.address != "undefined" && result.address != "") {
								// 	party_details = party_details + '<br>' + result.address;
								// }
								if (typeof result.city != "undefined" && result.city != "") {
									party_details = party_details + '<br>' + result.city;
								}
								// if (typeof result.state != "undefined" && result.state != "") {
								// 	party_details = party_details + '<br>' + result.state;
								if (jQuery('input[name="account_party_state"]').length > 0) {
									jQuery('input[name="account_party_state"]').val(result.state);
								}
								// }
								// if (typeof result.identification != "undefined" && result.identification != "") {
								// 	party_details = party_details + '<br>' + result.identification;
								// }

								if (typeof party_details != "undefined" && party_details != "") {
									jQuery('.account_party_preview').html(party_details);
								}
								getBillType();
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
	else
	{
		if(jQuery('input[name="selected_account_party_id"]').length >0)
		{
			jQuery('input[name="selected_account_party_id"]').val('');
		}
		if(jQuery('input[name="account_party_mobile_number"]').length >0)
		{
			jQuery('input[name="account_party_mobile_number"]').val('');
		}
	}
}
function consigneeState(state) {
	if (jQuery('input[name="consignee_state"]').length > 0) {
		jQuery('input[name="consignee_state"]').val(state);
	}
	getBranch(state);
}
function getBranch(state){
	var post_url = "lr_bill_changes.php?get_state_branch="+state;
	jQuery.ajax({
		url: post_url, success: function (result) {
			if(jQuery('select[name="to_branch_id"]').length > 0) {
				jQuery('select[name="to_branch_id"]').html(result);
			}
			getStates('lr',state, '', '');
		}
	});
}
function selectUnit(unit_id,obj)
{
	
	var add=1;
	if(unit_id != "") {
		if(jQuery('input[name="unit_id[]"]').length > 0) {
			jQuery('.bill_products_table tbody').find('tr').each(function(){
				var prev_unit_id = jQuery(this).find('input[name="unit_id[]"]').val();
				if(prev_unit_id == unit_id) {
					add = 0;
				}
			});
		}
	}
	if(add == 1)
	{
		if (jQuery(obj).parent().parent().find('input[name="unit_id[]"]').length > 0) {
			jQuery(obj).parent().parent().find('input[name="unit_id[]"]').val(unit_id)
		}
		
	}
	else
	{
		if(jQuery('.bill_products_table').parent().find('.infos').length > 0) {
			jQuery('.bill_products_table').parent().find('.infos').remove();
		}
		jQuery('.bill_products_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Product already Exists</span>');
		if (jQuery(obj).parent().parent().find('select[name="selected_unit_id"]').length > 0) {
			jQuery(obj).parent().parent().find('select[name="selected_unit_id"]').val('');
		}
	}
	getBillType();
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
				var selected_quantity = ""; var selected_weight = "";
				if (jQuery(obj).parent().parent().find('input[name="quantity[]"]').length > 0) {
					selected_quantity = jQuery(obj).parent().parent().find('input[name="quantity[]"]').val();
					if (typeof selected_quantity != "undefined" && selected_quantity != "" ) {
						jQuery(obj).parent().parent().find('input[name="weight[]"]').prop("readonly", true);
						selected_quantity = selected_quantity.replace(/ /g, '');
						selected_quantity = selected_quantity.trim();
						if (numbers_regex.test(selected_quantity) == true) {
							var selected_rate = "";
							if (jQuery(obj).parent().parent().find('input[name="price_per_qty[]"]').length > 0) {
								selected_rate = jQuery(obj).parent().parent().find('input[name="price_per_qty[]"]').val();
								if (typeof selected_rate != "undefined" && selected_rate != "") {
									selected_rate = selected_rate.replace(/ /g, '');
									selected_rate = selected_rate.trim();
									if (price_regex.test(selected_rate) == true) {
										var freight = ""; var total_kooli = 0;
										freight = parseFloat(selected_rate) * parseInt(selected_quantity);
										freight = check_decimal(freight);
										if (jQuery(obj).parent().parent().find('.freight').length > 0) {
											jQuery(obj).parent().parent().find('.freight').html(freight);
										}

										var selected_kooli = "";
										if (jQuery(obj).parent().parent().find('input[name="price_per_kooli[]"]').length > 0) {
											selected_kooli = jQuery(obj).parent().parent().find('input[name="price_per_kooli[]"]').val();
											if (typeof selected_kooli != "undefined" && selected_kooli != "" ) {
												selected_kooli = selected_kooli.replace(/ /g, '');
												selected_kooli = selected_kooli.trim();
												if (price_regex.test(selected_kooli) == true) {

													total_kooli = parseFloat(selected_kooli) * parseInt(selected_quantity);
													total_kooli = check_decimal(total_kooli);
													if (jQuery(obj).parent().parent().find('.total_kooli').length > 0) {
														jQuery(obj).parent().parent().find('.total_kooli').html(total_kooli);
													}

												}
												else {
													jQuery(obj).parent().parent().find('input[name="price_per_kooli[]"]').after('<span class="infos">Invalid kooli</span>');
												}
											}
											else {
												if (jQuery(obj).parent().parent().find('.total_kooli').length > 0) {
													jQuery(obj).parent().parent().find('.total_kooli').html('');
												}
											}
										}

										if(price_regex.test(freight) == true && price_regex.test(total_kooli) == true) {
											var amount = "";
											amount = parseFloat(freight) + parseFloat(total_kooli);
											amount = check_decimal(amount);
											if (jQuery(obj).parent().parent().find('.amount').length > 0) {
												jQuery(obj).parent().parent().find('.amount').html(amount);
											}
										}
										calTotal();
									}
									else {
										jQuery(obj).parent().parent().find('input[name="price_per_qty[]"]').after('<span class="infos">Invalid Rate</span>');
										if (jQuery(obj).parent().parent().find('.freight').length > 0) {
											jQuery(obj).parent().parent().find('.freight').html('');
										}
										if (jQuery(obj).parent().parent().find('.total_kooli').length > 0) {
											jQuery(obj).parent().parent().find('.total_kooli').html('');
										}
										if (jQuery(obj).parent().parent().find('.amount').length > 0) {
											jQuery(obj).parent().parent().find('.amount').html('');
										}
									}
								}
								else {
									if (jQuery(obj).parent().parent().find('.freight').length > 0) {
										jQuery(obj).parent().parent().find('.freight').html('');
									}
									if (jQuery(obj).parent().parent().find('.total_kooli').length > 0) {
										jQuery(obj).parent().parent().find('.total_kooli').html('');
									}
									if (jQuery(obj).parent().parent().find('.amount').length > 0) {
										jQuery(obj).parent().parent().find('.amount').html('');
									}
								}
							}
						}
						else {
							jQuery(obj).parent().parent().find('input[name="quantity[]"]').after('<span class="infos">Invalid Quantity</span>');
							if (jQuery(obj).parent().parent().find('.freight').length > 0) {
								jQuery(obj).parent().parent().find('.freight').html('');
							}
							if (jQuery(obj).parent().parent().find('.total_kooli').length > 0) {
								jQuery(obj).parent().parent().find('.total_kooli').html('');
							}
							if (jQuery(obj).parent().parent().find('.amount').length > 0) {
								jQuery(obj).parent().parent().find('.amount').html('');
							}
						}
					}
					else if (jQuery(obj).parent().parent().find('input[name="weight[]"]').length > 0) {
						jQuery(obj).parent().parent().find('input[name="weight[]"]').prop("readonly", false);
						selected_weight = jQuery(obj).parent().parent().find('input[name="weight[]"]').val();
						if (typeof selected_weight != "undefined" && selected_weight != "") {
							jQuery(obj).parent().parent().find('input[name="quantity[]"]').prop("readonly", true);
							selected_weight = selected_weight.replace(/ /g, '');
							selected_weight = selected_weight.trim();
							if (price_regex.test(selected_weight) == true) {
								
								var selected_rate = "";
								if (jQuery(obj).parent().parent().find('input[name="price_per_qty[]"]').length > 0) {
									selected_rate = jQuery(obj).parent().parent().find('input[name="price_per_qty[]"]').val();
									if (typeof selected_rate != "undefined" && selected_rate != "") {
										selected_rate = selected_rate.replace(/ /g, '');
										selected_rate = selected_rate.trim();
										if (price_regex.test(selected_rate) == true) {
											var freight = ""; var total_kooli = 0;
											freight = parseFloat(selected_rate) * parseFloat(selected_weight);
											freight = check_decimal(freight);
											if (jQuery(obj).parent().parent().find('.freight').length > 0) {
												jQuery(obj).parent().parent().find('.freight').html(freight);
											}
	
											var selected_kooli = "";
											if (jQuery(obj).parent().parent().find('input[name="price_per_kooli[]"]').length > 0) {
												selected_kooli = jQuery(obj).parent().parent().find('input[name="price_per_kooli[]"]').val();
												if (typeof selected_kooli != "undefined" && selected_kooli != "") {
													selected_kooli = selected_kooli.replace(/ /g, '');
													selected_kooli = selected_kooli.trim();
													if (price_regex.test(selected_kooli) == true) {
	
														total_kooli = parseFloat(selected_kooli) * parseFloat(selected_weight);
														total_kooli = check_decimal(total_kooli);
														if (jQuery(obj).parent().parent().find('.total_kooli').length > 0) {
															jQuery(obj).parent().parent().find('.total_kooli').html(total_kooli);
														}
	
													}
													else {
														jQuery(obj).parent().parent().find('input[name="price_per_kooli[]"]').after('<span class="infos">Invalid kooli</span>');
													}
												}
												else {
													if (jQuery(obj).parent().parent().find('.total_kooli').length > 0) {
														jQuery(obj).parent().parent().find('.total_kooli').html('');
													}
												}
											}
	
											if(price_regex.test(freight) == true && price_regex.test(total_kooli) == true) {
												var amount = "";
												amount = parseFloat(freight) + parseFloat(total_kooli);
												amount = check_decimal(amount);
												if (jQuery(obj).parent().parent().find('.amount').length > 0) {
													jQuery(obj).parent().parent().find('.amount').html(amount);
												}
											}
											calTotal();
										}
										else {
											jQuery(obj).parent().parent().find('input[name="price_per_qty[]"]').after('<span class="infos">Invalid Rate</span>');
											if (jQuery(obj).parent().parent().find('.freight').length > 0) {
												jQuery(obj).parent().parent().find('.freight').html('');
											}
											if (jQuery(obj).parent().parent().find('.total_kooli').length > 0) {
												jQuery(obj).parent().parent().find('.total_kooli').html('');
											}
											if (jQuery(obj).parent().parent().find('.amount').length > 0) {
												jQuery(obj).parent().parent().find('.amount').html('');
											}
										}
									}
									else {
										if (jQuery(obj).parent().parent().find('.freight').length > 0) {
											jQuery(obj).parent().parent().find('.freight').html('');
										}
										if (jQuery(obj).parent().parent().find('.total_kooli').length > 0) {
											jQuery(obj).parent().parent().find('.total_kooli').html('');
										}
										if (jQuery(obj).parent().parent().find('.amount').length > 0) {
											jQuery(obj).parent().parent().find('.amount').html('');
										}
									}
								}
							}
							else {
								jQuery(obj).parent().parent().find('input[name="weight[]"]').after('<span class="infos">Invalid Weight</span>');
								if (jQuery(obj).parent().parent().find('.freight').length > 0) {
									jQuery(obj).parent().parent().find('.freight').html('');
								}
								if (jQuery(obj).parent().parent().find('.total_kooli').length > 0) {
									jQuery(obj).parent().parent().find('.total_kooli').html('');
								}
								if (jQuery(obj).parent().parent().find('.amount').length > 0) {
									jQuery(obj).parent().parent().find('.amount').html('');
								}
							}
						}
						else {
							jQuery(obj).parent().parent().find('input[name="quantity[]"]').attr("readonly", false);
							if (jQuery(obj).parent().parent().find('.freight').length > 0) {
								jQuery(obj).parent().parent().find('.freight').html('');
							}
							if (jQuery(obj).parent().parent().find('.total_kooli').length > 0) {
								jQuery(obj).parent().parent().find('.total_kooli').html('');
							}
							if (jQuery(obj).parent().parent().find('.amount').length > 0) {
								jQuery(obj).parent().parent().find('.amount').html('');
							}
						}
					}
					else {
						if (jQuery(obj).parent().parent().find('.freight').length > 0) {
							jQuery(obj).parent().parent().find('.freight').html('');
						}
						if (jQuery(obj).parent().parent().find('.total_kooli').length > 0) {
							jQuery(obj).parent().parent().find('.total_kooli').html('');
						}
						if (jQuery(obj).parent().parent().find('.amount').length > 0) {
							jQuery(obj).parent().parent().find('.amount').html('');
						}
					}
				}
				
			}
			else {
				window.location.reload();
			}
		}
	});
}
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
					var post_url = "lr_bill_changes.php?get_details_vehicle_id=" + vehicle_id;
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
									jQuery('.vehicle_preview').html('<b>Vehicle Details</b> <br> ' + party_details);
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
function unitDetails(unit_id) {
	if (jQuery('input[name="party_state"]').length > 0) {
		jQuery('input[name="party_state"]').val("");
	}
	if (jQuery('.unit_preview').length > 0) {
		jQuery('.unit_preview').html('');
	}
	if (typeof unit_id != "undefined" && unit_id != "") {
		var check_login_session = 1;
		var post_url = "dashboard_changes.php?check_login_session=1";
		jQuery.ajax({
			url: post_url, success: function (check_login_session) {
				if (check_login_session == 1) {
					var post_url = "lr_bill_changes.php?get_details_unit_id=" + unit_id;
					jQuery.ajax({
						url: post_url, success: function (result) {
							if (typeof result != "undefined" && result != "") {
								result = JSON.parse(result);
								var party_details = "";
								if (typeof result.name != "undefined" && result.name != "") {
									party_details = result.name;
								}
								if (typeof party_details != "undefined" && party_details != "") {
									jQuery('.unit_preview').html('<b>Unit Details</b> <br> ' + party_details);
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
function NewConsignorParty() {
	jQuery('.consignor_modal_button').trigger("click");
}
function SaveCustomconsignor() {
	if (jQuery('.consignor_preview').length > 0) {
		jQuery('.consignor_preview').html('');
	}
	var res = ValidCustomconsginor();
	if (res == true) {

		var custom_consignor = "";
		var custom_consignor_name = ""; var custom_consignor_mobile_number = ""; var custom_consignor_city = ""; var custom_consignor_state = ""; var valid = 1;
		if (jQuery('input[name="custom_consignor_name"]').length > 0) {
			custom_consignor_name = jQuery('input[name="custom_consignor_name"]').val();
			custom_consignor_name = custom_consignor_name.trim();
			if (typeof custom_consignor_name != "undefined" || custom_consignor_name != "") {
				custom_consignor = custom_consignor_name;
			}
		}
		// if (jQuery('input[name="custom_consignor_mobile_number"]').length > 0) {
		// 	custom_consignor_mobile_number = jQuery('input[name="custom_consignor_mobile_number"]').val();
		// 	custom_consignor_mobile_number = custom_consignor_mobile_number.trim();
		// 	if (typeof custom_consignor_mobile_number != "undefined" || custom_consignor_mobile_number != "") {
		// 		custom_consignor = custom_consignor + '<br>' + custom_consignor_mobile_number;
		// 	}
		// }
		if (jQuery('input[name="custom_consignor_city"]').length > 0) {
			custom_consignor_city = jQuery('input[name="custom_consignor_city"]').val();
			custom_consignor_city = custom_consignor_city.trim();
			if (typeof custom_consignor_city != "undefined" || custom_consignor_city != "") {
				custom_consignor = custom_consignor + '<br>' + custom_consignor_city;
			}
		}
		// if (jQuery('select[name="state"]').length > 0) {
		// 	custom_consignor_state = jQuery('select[name="state"]').val();
		// 	custom_consignor_state = custom_consignor_state.trim();
		// 	if (typeof custom_consignor_state != "undefined" || custom_consignor_state != "") {
		// 		custom_consignor = custom_consignor + '<br>' + custom_consignor_state;
		// 	}
		// }
		// if (jQuery('input[name="custom_consignor_identification"]').length > 0) {
		// 	custom_consignor_identification = jQuery('input[name="custom_consignor_identification"]').val();
		// 	custom_consignor_identification = custom_consignor_identification.trim();
		// 	if (typeof custom_consignor_identification != "undefined" || custom_consignor_identification != "") {
		// 		custom_consignor = custom_consignor + '<br>' + custom_consignor_identification;
		// 	}
		// }
		if (typeof custom_consignor != "undefined" || custom_consignor != "") {
			if (jQuery('.consignor_preview').length > 0) {
				jQuery('.consignor_preview').html('<b>Custom consignor Details</b> <br> ' + custom_consignor);
			}
		}

		jQuery('.consignor_modal_button').trigger("click");
	}
}
function ValidCustomconsginor() {

	if (jQuery('#custom_consignor_cover').find('.infos').length > 0) {
		jQuery('#custom_consignor_cover').find('.infos').each(function () { jQuery(this).remove(); })
	}
	var custom_consignor_name = ""; var custom_consignor_mobile_number = ""; var custom_consignor_city = ""; var custom_consignor_state = ""; var valid = 1;
	var format = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?~]/;
	if (jQuery('input[name="custom_consignor_name"]').length > 0) {
		custom_consignor_name = jQuery('input[name="custom_consignor_name"]').val();
		custom_consignor_name = custom_consignor_name.trim();
		if (typeof custom_consignor_name == "undefined" || custom_consignor_name == "") {

			valid = 0;
			jQuery('input[name="custom_consignor_name"]').parent().parent().append('<span class="infos">Enter the name</span>');
		}
		else {
			if (format.test(custom_consignor_name) == true) {
				jQuery('input[name="custom_consignor_name"]').parent().parent().append('<span class="infos">Invalid Name</span>');
				valid = 0;
			}
		}
	}

	if (jQuery('input[name="custom_consignor_mobile_number"]').length > 0) {
		custom_consignor_mobile_number = jQuery('input[name="custom_consignor_mobile_number"]').val();
		custom_consignor_mobile_number = custom_consignor_mobile_number.trim();
		if (typeof custom_consignor_mobile_number == "undefined" || custom_consignor_mobile_number == "") {
			valid = 0;
			jQuery('input[name="custom_consignor_mobile_number"]').parent().parent().append('<span class="infos">Enter the mobile number </span>');
		}
		else {
			if (custom_consignor_mobile_number != 'undefined' && custom_consignor_mobile_number != '') {

				var phoneno = /^\d{10}$/;
				if (!custom_consignor_mobile_number.match(phoneno)) {
					jQuery('input[name="custom_consignor_mobile_number"]').parent().parent().append('<span class="infos">Invalid Mobile Number</span>');
					valid = 0;
				}
				else if (format.test(custom_consignor_mobile_number) == true) {
					jQuery('input[name="custom_consignor_mobile_number"]').parent().parent().append('<span class="infos">Invalid Mobile Number</span>');
					valid = 0;
				}
			}
		}
	}

	if (jQuery('input[name="custom_party_identification"]').length > 0) {
		custom_party_identification = jQuery('input[name="custom_party_identification"]').val();
		custom_party_identification = custom_party_identification.trim();
		if (format.test(custom_party_identification) == true) {
			jQuery('input[name="custom_party_identification"]').parent().parent().append('<span class="infos">Invalid Identification</span>');
			valid = 0;
		}
	}

	if (jQuery('textarea[name="custom_consignor_address"]').length > 0) {
		custom_consignor_address = jQuery('textarea[name="custom_consignor_address"]').val();
		custom_consignor_address = custom_consignor_address.trim();
		if (typeof custom_consignor_address == "undefined" || custom_consignor_address == "") {
			jQuery('textarea[name="custom_consignor_address"]').parent().parent().append('<span class="infos">Invalid Address</span>');
			valid = 0;
		}

	}

	if (jQuery('input[name="custom_consignor_city"]').length > 0) {
		custom_consignor_city = jQuery('input[name="custom_consignor_city"]').val();
		custom_consignor_city = custom_consignor_city.trim();
		if (typeof custom_consignor_city == "undefined" || custom_consignor_city == "") {
			valid = 0;
			jQuery('input[name="custom_consignor_city"]').parent().parent().append('<span class="infos">Enter the city </span>');
		}
		else {
			if (format.test(custom_consignor_city) == true) {
				jQuery('input[name="custom_consignor_city"]').parent().parent().append('<span class="infos">Invalid City</span>');
				valid = 0;
			}
		}
	}

	// alert(valid);	
	// if (jQuery('select[name="state"]').length > 0) {
	// 	custom_consignor_state = jQuery('select[name="state"]').val();
	// 	custom_consignor_state = custom_consignor_state.trim();
	// 	if (typeof custom_consignor_state == "undefined" || custom_consignor_state == "") {
	// 		valid = 0;
	// 		jQuery('select[name="state"]').parent().parent().append('<span class="infos">Select the state</span>');
	// 	}
	// }
	return valid;
}
function CancelCustomConsignor() {
	if (jQuery('#custom_consignor_cover').find('.infos').length > 0) {
		jQuery('#custom_consignor_cover').find('.infos').each(function () { jQuery(this).remove(); })
	}

	if (jQuery('input[name="custom_consignor_name"]').length > 0) {
		jQuery('input[name="custom_consignor_name"]').val('');
	}
	if (jQuery('input[name="custom_consignor_mobile_number"]').length > 0) {
		jQuery('input[name="custom_consignor_mobile_number"]').val('');
	}
	if (jQuery('input[name="custom_consignor_identification"]').length > 0) {
		jQuery('input[name="custom_consignor_identification"]').val('');
	}
	if (jQuery('input[name="custom_consignor_address"]').length > 0) {
		jQuery('input[name="custom_consignor_address"]').val('');
	}
	if (jQuery('input[name="custom_consignor_city"]').length > 0) {
		jQuery('input[name="custom_consignor_city"]').val('');
	}
	if (jQuery('select[name="custom_consignor_state"]').length > 0) {
		jQuery('select[name="custom_consignor_state"]').val('');
	}

	jQuery('.consignor_modal_button').trigger("click");
}
function NewConsigneeParty() {
	jQuery('.consignee_modal_button').trigger("click");
}
function SaveCustomconsignee() {
	if (jQuery('.consignee_preview').length > 0) {
		jQuery('.consignee_preview').html('');
	}
	var res = ValidCustomConsignee();
	if (res == true) {

		var custom_consignee = "";
		var custom_consignee_name = ""; var custom_consignee_mobile_number = ""; var custom_consignee_city = ""; var custom_consignee_state = ""; var valid = 1;
		if (jQuery('input[name="custom_consignee_name"]').length > 0) {
			custom_consignee_name = jQuery('input[name="custom_consignee_name"]').val();
			custom_consignee_name = custom_consignee_name.trim();
			if (typeof custom_consignee_name != "undefined" || custom_consignee_name != "") {
				custom_consignee = custom_consignee_name;
			}
		}
		// if (jQuery('input[name="custom_consignee_mobile_number"]').length > 0) {
		// 	custom_consignee_mobile_number = jQuery('input[name="custom_consignee_mobile_number"]').val();
		// 	custom_consignee_mobile_number = custom_consignee_mobile_number.trim();
		// 	if (typeof custom_consignee_mobile_number != "undefined" || custom_consignee_mobile_number != "") {
		// 		custom_consignee = custom_consignee + '<br>' + custom_consignee_mobile_number;
		// 	}
		// }
		if (jQuery('input[name="custom_consignee_city"]').length > 0) {
			custom_consignee_city = jQuery('input[name="custom_consignee_city"]').val();
			custom_consignee_city = custom_consignee_city.trim();
			if (typeof custom_consignee_city != "undefined" || custom_consignee_city != "") {
				custom_consignee = custom_consignee + '<br>' + custom_consignee_city;
			}
		}
		// if (jQuery('select[name="state"]').length > 0) {
		// 	custom_consignee_state = jQuery('select[name="state"]').val();
		// 	custom_consignee_state = custom_consignee_state.trim();
		// 	if (typeof custom_consignee_state != "undefined" || custom_consignee_state != "") {
		// 		custom_consignee = custom_consignee + '<br>' + custom_consignee_state;
		// 	}
		// }
		// if (jQuery('input[name="custom_stateentification"]').length > 0) {
		// 	custom_consignee_identification = jQuery('input[name="custom_consignee_identification"]').val();
		// 	custom_consignee_identification = custom_consignee_identification.trim();
		// 	if (typeof custom_consignee_identification != "undefined" || custom_consignee_identification != "") {
		// 		custom_consignee = custom_consignee + '<br>' + custom_consignee_identification;
		// 	}
		// }

		if (typeof custom_consignee != "undefined" || custom_consignee != "") {
			if (jQuery('.consignee_preview').length > 0) {
				jQuery('.consignee_preview').html('<b>Custom consignee Details</b> <br> ' + custom_consignee);
			}
		}

		jQuery('.consignee_modal_button').trigger("click");
	}
}
function ValidCustomConsignee() {

	if (jQuery('#consignee_cover').find('.infos').length > 0) {
		jQuery('#consignee_cover').find('.infos').each(function () { jQuery(this).remove(); })
	}
	var custom_consignee_name = ""; var custom_consignee_mobile_number = ""; var custom_consignee_city = ""; var custom_consignee_state = ""; var valid = 1;
	var format = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?~]/;
	if (jQuery('input[name="custom_consignee_name"]').length > 0) {
		custom_consignee_name = jQuery('input[name="custom_consignee_name"]').val();
		custom_consignee_name = custom_consignee_name.trim();
		if (typeof custom_consignee_name == "undefined" || custom_consignee_name == "") {

			valid = 0;
			jQuery('input[name="custom_consignee_name"]').parent().parent().append('<span class="infos">Enter the name</span>');
		}
		else {
			if (format.test(custom_consignee_name) == true) {
				jQuery('input[name="custom_consignee_name"]').parent().parent().append('<span class="infos">Invalid Name</span>');
				valid = 0;
			}
		}
	}
	if (jQuery('input[name="custom_consignee_mobile_number"]').length > 0) {
		custom_consignee_mobile_number = jQuery('input[name="custom_consignee_mobile_number"]').val();
		custom_consignee_mobile_number = custom_consignee_mobile_number.trim();
		if (typeof custom_consignee_mobile_number == "undefined" || custom_consignee_mobile_number == "") {
			valid = 0;
			jQuery('input[name="custom_consignee_mobile_number"]').parent().parent().append('<span class="infos">Enter the mobile number </span>');
		}
		else {
			if (custom_consignee_mobile_number != 'undefined' && custom_consignee_mobile_number != '') {

				var phoneno = /^\d{10}$/;
				if (!custom_consignee_mobile_number.match(phoneno)) {
					jQuery('input[name="custom_consignee_mobile_number"]').parent().parent().append('<span class="infos">Invalid Mobile Number</span>');
					valid = 0;
				}
				else if (format.test(custom_consignee_mobile_number) == true) {
					jQuery('input[name="custom_consignee_mobile_number"]').parent().parent().append('<span class="infos">Invalid Mobile Number</span>');
					valid = 0;
				}
			}
		}
	}
	// if(jQuery('input[name="custom_party_identification"]').length > 0) {
	// 	custom_party_identification = jQuery('input[name="custom_party_identification"]').val();
	// 	custom_party_identification = custom_party_identification.trim();
	// 	if(format.test(custom_party_identification) == true)
	// 	{
	// 		jQuery('input[name="custom_party_identification"]').parent().parent().append('<span class="infos">Invalid Identification</span>');
	// 		valid = 0;
	// 	}
	// }
	if (jQuery('textarea[name="custom_consignee_address"]').length > 0) {
		custom_consignee_address = jQuery('textarea[name="custom_consignee_address"]').val();
		custom_consignee_address = custom_consignee_address.trim();
		if (typeof custom_consignee_address == "undefined" || custom_consignee_address == "") {
			valid = 0;
			jQuery('textarea[name="custom_consignee_address"]').parent().parent().append('<span class="infos">Enter the Address</span>');
		}
	}
	if (jQuery('input[name="custom_consignee_city"]').length > 0) {
		custom_consignee_city = jQuery('input[name="custom_consignee_city"]').val();
		custom_consignee_city = custom_consignee_city.trim();
		if (typeof custom_consignee_city == "undefined" || custom_consignee_city == "") {
			valid = 0;
			jQuery('input[name="custom_consignee_city"]').parent().parent().append('<span class="infos">Enter the city </span>');
		}
		else {
			if (format.test(custom_consignee_city) == true) {
				jQuery('input[name="custom_consignee_city"]').parent().parent().append('<span class="infos">Invalid City</span>');
				valid = 0;
			}
		}
	}
	if (jQuery('select[name="state"]').length > 0) {
		custom_consignee_state = jQuery('select[name="state"]').val();
		custom_consignee_state = custom_consignee_state.trim();
		if (typeof custom_consignee_state == "undefined" || custom_consignee_state == "") {
			valid = 0;
			jQuery('select[name="state"]').parent().parent().append('<span class="infos">Select the state</span>');
		}
	}

	return valid;
}
function CancelCustomConsignee() {
	if (jQuery('#custom_consignee_cover').find('.infos').length > 0) {
		jQuery('#custom_consignee_cover').find('.infos').each(function () { jQuery(this).remove(); })
	}

	if (jQuery('input[name="custom_consignee_name"]').length > 0) {
		jQuery('input[name="custom_consignee_name"]').val('');
	}
	if (jQuery('input[name="custom_consignee_mobile_number"]').length > 0) {
		jQuery('input[name="custom_consignee_mobile_number"]').val('');
	}
	if (jQuery('input[name="custom_consignee_identification"]').length > 0) {
		jQuery('input[name="custom_consignee_identification"]').val('');
	}
	if (jQuery('input[name="custom_consignee_address"]').length > 0) {
		jQuery('input[name="custom_consignee_address"]').val('');
	}
	if (jQuery('input[name="custom_consignee_city"]').length > 0) {
		jQuery('input[name="custom_consignee_city"]').val('');
	}
	if (jQuery('select[name="custom_consignee_state"]').length > 0) {
		jQuery('select[name="custom_consignee_state"]').val('');
	}

	jQuery('.consignee_modal_button').trigger("click");
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
		if (jQuery('input[name="custom_vehicle_name"]').length > 0) {
			custom_vehicle_name = jQuery('input[name="custom_vehicle_name"]').val();
			custom_vehicle_name = custom_vehicle_name.trim();
			if (typeof custom_vehicle_name != "undefined" || custom_vehicle_name != "") {
				custom_vehicle = custom_vehicle_name;
			}
		}
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
			if (typeof custom_vehicle_number != "undefined" || custom_vehicle_number != "") {
				custom_vehicle = custom_vehicle + '<br>' + custom_vehicle_number;
			}
		}

		if (typeof custom_vehicle != "undefined" || custom_vehicle != "") {
			if (jQuery('.vehicle_preview').length > 0) {
				jQuery('.vehicle_preview').html('<b>Custom vehicle Details</b> <br> ' + custom_vehicle);
			}
		}

		jQuery('.vehicle_modal_button').trigger("click");
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
			jQuery('input[name="custom_vehicle_name"]').parent().parent().after('<span class="infos">Enter the name</span>');
		}
		else {
			if (format.test(custom_vehicle_name) == true) {
				jQuery('input[name="custom_vehicle_name"]').parent().parent().after('<span class="infos">Invalid Name</span>');
				valid = 0;
			}
		}
	}
	if (jQuery('input[name="custom_vehicle_contact_number"]').length > 0) {
		custom_vehicle_contact_number = jQuery('input[name="custom_vehicle_contact_number"]').val();
		custom_vehicle_contact_number = custom_vehicle_contact_number.trim();
		if (typeof custom_vehicle_contact_number == "undefined" || custom_vehicle_contact_number == "") {
			valid = 0;
			jQuery('input[name="custom_vehicle_contact_number"]').parent().parent().after('<span class="infos">Enter the mobile number </span>');
		}
		else {
			if (custom_vehicle_contact_number != 'undefined' && custom_vehicle_contact_number != '') {

				var phoneno = /^\d{10}$/;
				if (!custom_vehicle_contact_number.match(phoneno)) {
					jQuery('input[name="custom_vehicle_contact_number"]').parent().parent().after('<span class="infos">Invalid Mobile Number</span>');
					valid = 0;
				}
				else if (format.test(custom_vehicle_contact_number) == true) {
					jQuery('input[name="custom_vehicle_contact_number"]').parent().parent().after('<span class="infos">Invalid Mobile Number</span>');
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
}
function NewUnit() {
	jQuery('.unit_modal_button').trigger("click");
}
function SaveCustomUnit() {
	if (jQuery('.unit_preview').length > 0) {
		jQuery('.unit_preview').html('');
	}
	var res = ValidCustomUnit();
	if (res == true) {

		var custom_unit = "";
		var custom_unit_name = ""; var custom_unit_mobile_number = ""; var custom_unit_city = ""; var custom_unit_state = ""; var valid = 1;
		if (jQuery('input[name="custom_unit_name"]').length > 0) {
			custom_unit_name = jQuery('input[name="custom_unit_name"]').val();
			custom_unit_name = custom_unit_name.trim();
			if (typeof custom_unit_name != "undefined" || custom_unit_name != "") {
				custom_unit = custom_unit_name;
			}
		}

		if (typeof custom_unit != "undefined" || custom_unit != "") {
			if (jQuery('.unit_preview').length > 0) {
				jQuery('.unit_preview').html('<b>Custom unit Details</b> <br> ' + custom_unit);
			}
		}

		jQuery('.unit_modal_button').trigger("click");
	}
}
function ValidCustomUnit() {

	if (jQuery('#unit_cover').find('.infos').length > 0) {
		jQuery('#unit_cover').find('.infos').each(function () { jQuery(this).remove(); })
	}
	var custom_unit_name = ""; var custom_unit_mobile_number = ""; var custom_unit_city = ""; var custom_unit_state = ""; var valid = 1;
	var format = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?~]/;
	if (jQuery('input[name="custom_unit_name"]').length > 0) {
		custom_unit_name = jQuery('input[name="custom_unit_name"]').val();
		custom_unit_name = custom_unit_name.trim();
		if (typeof custom_unit_name == "undefined" || custom_unit_name == "") {

			valid = 0;
			jQuery('input[name="custom_unit_name"]').parent().parent().append('<span class="infos">Enter the name</span>');
		}
		else {
			if (format.test(custom_unit_name) == true) {
				jQuery('input[name="custom_unit_name"]').parent().parent().append('<span class="infos">Invalid Name</span>');
				valid = 0;
			}
		}
	}

	return valid;
}
function CancelCustomUnit() {
	if (jQuery('#custom_unit_cover').find('.infos').length > 0) {
		jQuery('#custom_unit_cover').find('.infos').each(function () { jQuery(this).remove(); })
	}

	if (jQuery('input[name="custom_unit_name"]').length > 0) {
		jQuery('input[name="custom_unit_name"]').val('');
	}

	jQuery('.unit_modal_button').trigger("click");
}
// function search_consignor_list(form_name) {
// 	var input, filter, ul, li, a, i;
// 	input = document.forms[form_name]["consignor_name"];
// 	filter = input.value.toUpperCase();
// 	if (filter != '') {
// 		jQuery('#show_consignor_list').show();
// 		ul = document.getElementById("show_consignor_list");
// 		li = ul.getElementsByTagName('li');
// 		for (i = 0; i < li.length; i++) {
// 			a = li[i].getElementsByTagName("a")[0];
// 			if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
// 				// if($("<a></a>").length == 1)
// 				// {
// 				li[i].style.display = "";
// 				li[i].classList.add('current');

// 			} else {
// 				li[i].style.display = "none";
// 				li[i].classList.remove('current');
// 			}
// 		}
// 		if ($(".current").length == 1) {
// 			$("#show_consignor_list").find('li').removeClass("active")
// 			$("#show_consignor_list").find('li:visible').focus();
// 		}
// 		if($(".current").length == 0)
// 		{
			
// 			$("#show_consignor_list").find('li:visible').removeClass("active")
// 		}
// 	}
// 	else
// 	{
// 		jQuery('#show_consignor_list').hide();	
// 		consignorDetails()
// 	}
// }

function search_account_party_list(form_name) {
	var input, filter, ul, li, a, i;
	input = document.forms[form_name]["account_party_name"];
	filter = input.value.toUpperCase();
	if (filter != '') {
		jQuery('#show_account_party_list').show();
		ul = document.getElementById("show_account_party_list");
		li = ul.getElementsByTagName('li');
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("a")[0];
			if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
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
			$("#show_account_party_list").find('li').removeClass("active")
			$("#show_account_party_list").find('li:visible').focus();
			
		}
		if($(".current").length == 0)
		{
			$("#show_account_party_list").find('li:visible').removeClass("active")
		}
	}
	else
	{
		jQuery('#show_account_party_list').hide();	
		account_partyDetails()
	}
	// else
	// 	jQuery('#show_account_party_list').hide();
}
function search_consignor_city_list(form_name) {
	var input, filter, ul, li, a, i;
	input = document.forms[form_name]["consignor_city"];
	filter = input.value.toUpperCase();
	if (filter != '') {
		jQuery('#show_consignor_city_list').show();
		ul = document.getElementById("show_consignor_city_list");
		li = ul.getElementsByTagName('li');
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("a")[0];
			if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
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
			$("#show_consignor_city_list").find('li').removeClass("active")
			$("#show_consignor_city_list").find('li:visible').focus();
			$("#show_consignor_city_list").find('li:visible').addClass("active")
		}
	}
	else
		jQuery('#show_consignor_city_list').hide();
}
function get_search_consignee(consignee, consignee_id) {
	jQuery('input[name="consignee_name"]').val(jQuery('.' + consignee).text());
	var consignee_name = jQuery('input[name="consignee_name"]').val();
	consignee_name = consignee_name.trim();
	var consignee_names = "";
	consignee_names = consignee_name.split("-");
	consignee_name = jQuery.trim(consignee_names['0']);
	jQuery('input[name="consignee_name"]').val(consignee_name)
	// removeCustomParty();
	jQuery('input[name="selected_consignee_id"]').val(consignee_id)
	jQuery('input[name="selected_consignee_id"]').val(consignee_id).change();
	jQuery('#show_consignee_list').hide();
	getConsigneeContact(consignee_id);
}
function get_search_account_party(account_party, account_party_id) {
	jQuery('input[name="account_party_name"]').val(jQuery('.' + account_party).text());
	var account_party_name = jQuery('input[name="account_party_name"]').val();
	account_party_name = account_party_name.trim();
	var account_party_names = "";
	account_party_names = account_party_name.split("-");
	account_party_name = jQuery.trim(account_party_names['0']);
	jQuery('input[name="account_party_name"]').val(account_party_name)
	// removeCustomParty();
	jQuery('input[name="selected_account_party_id"]').val(account_party_id)
	jQuery('input[name="selected_account_party_id"]').val(account_party_id).change();
	jQuery('#show_account_party_list').hide();
	getaccount_partyContact(account_party_id);
}
function get_search_city(city, city) {
	jQuery('input[name="city"]').val(jQuery('.' + city).text());
	// var city = jQuery('input[name="city"]').val();
	city = city.trim();
	jQuery('input[name="city"]').val(city)
	jQuery('input[name="city"]').val(city)
	jQuery('#show_city_list').hide();
	// getConsigneeContact(consignee_id);
}
function get_search_consignor_city(consignor_city, consignor_city) {
	jQuery('input[name="consignor_city"]').val(jQuery('.' + consignor_city).text());
	// var consignor_city = jQuery('input[name="consignor_city"]').val();
	consignor_city = consignor_city.trim();
	jQuery('input[name="consignor_city"]').val(consignor_city)
	jQuery('input[name="consignor_city"]').val(consignor_city)
	jQuery('#show_consignor_city_list').hide();
	// getConsigneeContact(consignee_id);
}

function getConsigneeContact(consignee_id) {
	if (jQuery('input[name="consignee_mobile_number"]').length > 0) {
		jQuery('input[name="consignee_mobile_number"]').val("");
	}

	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var post_url = "lr_bill_changes.php?get_consignee_id=" + consignee_id;
				jQuery.ajax({
					url: post_url, success: function (result) {
						result = result.trim();
						var list = result.split("$$$");
						if (jQuery('input[name="consignee_mobile_number"]').length > 0) {
							jQuery('input[name="consignee_mobile_number"]').val(list[0]);
						}
						if (jQuery('input[name="consignee_state"]').length > 0) {
							jQuery('input[name="consignee_state"]').val(list[1]);
						}
						if (jQuery('select[name="state"]').length > 0) {
							jQuery('select[name="state"]').val(list[1]).change();
						}
						if (jQuery('select[name="district"]').length > 0) {
							jQuery('select[name="district"]').val(list[3]).change();
						}
						if (jQuery('select[name="city"]').length > 0) {
							jQuery('select[name="city"]').val(list[2]).change();
						}
						consigneeDetails(consignee_id);
						jQuery(".search_list li.active").css("display", "none");
					}
				});
			}
			else {
				window.location.reload();
			}
		}
	});
	//}
}
function getaccount_partyContact(account_party_id) {
	if (jQuery('input[name="account_party_mobile_number"]').length > 0) {
		jQuery('input[name="account_party_mobile_number"]').val("");
	}

	//if(typeof product_id != "undefined" && product_id != "") {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var post_url = "lr_bill_changes.php?get_account_party_id=" + account_party_id;
				jQuery.ajax({
					url: post_url, success: function (result) {
						result = result.trim();
						var list = result.split("$$$");
						if (jQuery('input[name="account_party_mobile_number"]').length > 0) {
							jQuery('input[name="account_party_mobile_number"]').val(list[0]);
						}
						// if (jQuery('select[name="state"]').length > 0) {
						// 	jQuery('select[name="state"]').val(list[1]);
						// }
						// if (jQuery('input[name="account_party_state"]').length > 0) {
						// 	jQuery('input[name="account_party_state"]').val(list[1]);
						// }
						if (jQuery('input[name="account_party_identification"]').length > 0) {
							jQuery('input[name="account_party_identification"]').val(list[1]);
						}
						if (jQuery('input[name="city"]').length > 0) {
							jQuery('input[name="city"]').val(list[2]);
						};
						jQuery(".search_list li.active").css("display", "none");
						account_partyDetails(account_party_id);
					}
				});

			}
			else {
				window.location.reload();
			}
		}
	});
	//}
}
function search_consignor_list(form_name) {
	var input, filter, ul, li, a, i;
	input = document.forms[form_name]["consignor_name"];
	filter = input.value.toUpperCase();
	if (filter != '') {
		jQuery('#show_consignor_list').show();
		ul = document.getElementById("show_consignor_list");
		li = ul.getElementsByTagName('li');
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("a")[0];
			if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
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
			$("#show_consignor_list").find('li').removeClass("active")
			$("#show_consignor_list").find('li:visible').focus();
		}
		if($(".current").length == 0)
		{
			$("#show_consignor_list").find('li:visible').removeClass("active")
		}
	}
	else
	{
		jQuery('#show_consignor_list').hide();	
		consignorDetails()
	}
}
function search_consignee_list(form_name) {
	var input, filter, ul, li, a, i;
	input = document.forms[form_name]["consignee_name"];
	filter = input.value.toUpperCase();
	if (filter != '') {
		jQuery('#show_consignee_list').show();
		ul = document.getElementById("show_consignee_list");
		li = ul.getElementsByTagName('li');
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("a")[0];
			if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
				li[i].style.display = "";
				li[i].classList.add('current');
			} else {
				li[i].style.display = "none";
				li[i].classList.remove('current');
			}
		}
		if ($(".current").length == 1) {
			$("#show_consignee_list").find('li').removeClass("active")
			$("#show_consignee_list").find('li:visible').focus();
		}
		if($(".current").length == 0) {
			$("#show_consignee_list").find('li:visible').removeClass("active")
		}
	}
	else {
		jQuery('#show_consignee_list').hide();
		consigneeDetails();
	}
}
function search_city_list(form_name) {
	var input, filter, ul, li, a, i;
	input = document.forms[form_name]["city"];
	filter = input.value.toUpperCase();
	if (filter != '') {
		// jQuery('#show_city_list').show();
		// ul = document.getElementById("show_city_list");
		// li = ul.getElementsByTagName('li');		
		// for (i = 0; i < li.length; i++) {
		// 	a = li[i].getElementsByTagName("a")[0];
		// 	if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
		// 		// if($("<a></a>").length == 1)
		// 		// {
		// 			li[i].style.display = "";
		// 			li[i].classList.add('current');

		// 	} else {
		// 		li[i].style.display = "none";
		// 		li[i].classList.remove('current');
		// 	}
		// }
		// if($(".current").length == 1){
		// 	$("#show_city_list").find('li').removeClass("active")	
		// 	$("#show_city_list").find('li:visible').focus();
		// 	$("#show_city_list").find('li:visible').addClass("active")
		// }
	}
	else {
		jQuery('#show_city_list').hide();
	}
}
function get_search_consignor(consignor, consignor_id) {
	jQuery('input[name="consignor_name"]').val(jQuery('.' + consignor).text());
	var consignor_name = jQuery('input[name="consignor_name"]').val();
	consignor_name = consignor_name.trim();
	var consignor_names = "";
	consignor_names = consignor_name.split("-");
	consignor_name = jQuery.trim(consignor_names['0']);
	jQuery('input[name="consignor_name"]').val(consignor_name)
	// removeCustomParty();
	jQuery('input[name="selected_consignor_id"]').val(consignor_id)
	//jQuery('input[name="selected_consignor_id"]').val(consignor_id).change();
	jQuery('#show_consignor_list').hide();
	getConsignorContact(consignor_id);
}
function getConsignorContact(consignor_id) {
	if (jQuery('input[name="consignor_mobile_number"]').length > 0) {
		jQuery('input[name="consignor_mobile_number"]').val("");
	}

	//if(typeof product_id != "undefined" && product_id != "") {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var post_url = "lr_bill_changes.php?get_consignor_id=" + consignor_id;
				jQuery.ajax({
					url: post_url, success: function (consignor_list) {
						consignor_list = consignor_list.trim();
						result = consignor_list.split("$$$");
						if (jQuery('input[name="consignor_mobile_number"]').length > 0) {
							jQuery('input[name="consignor_mobile_number"]').val(result[0]);
						}
						if (jQuery('input[name="consignor_identification"]').length > 0) {
							jQuery('input[name="consignor_identification"]').val(result[1]);
							jQuery('input[name="consignor_identification"]').css("display", 'block');
						}
						if (jQuery('input[name="consignor_city"]').length > 0) {
							result[2] = result[2].trim();
							jQuery('input[name="consignor_city"]').val(result[2]);
						}

						jQuery('#show_consignor_list').css("display", 'none');
						// jQuery(".search_list li.active").css("display" , "none");
						consignorDetails(consignor_id);
					}
				});
			}
			else {
				window.location.reload();
			}
		}
	});
	//}
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
					var post_url = "lr_bill_changes.php?get_details_vehicle_id=" + vehicle_id;
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
function NewVehicle() {
	jQuery('.vehicle_modal_button').trigger("click");
}
function check_decimal(check_number) {
	if (check_number != '' && check_number != 0) {
		var decimal = ""; var round_off = ''; var numbers = "";
		numbers = check_number.toString().split('.');
		if (typeof numbers[1] != 'undefined') {
			decimal = numbers[1];
		}
		if (decimal != "" && decimal != "00") {
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
function CalProductAmount() {
	var all_errors_check = 1;

	var selected_quantity = "";
	selected_quantity = jQuery('input[name="quantity"]').val();
	var selected_weight = "";
	selected_weight = jQuery('input[name="weight"]').val();
	if(selected_quantity != ""){
		selected_quantity = selected_quantity.replace(/ /g, '');
		selected_quantity = selected_quantity.trim();
		if (selected_quantity.charAt(0) == 0) {
			selected_quantity = selected_quantity.slice(1);
			selected_quantity = selected_quantity.trim();
		}

		if (typeof selected_quantity != "undefined" && selected_quantity != "" && selected_quantity != 0) {
			if (numbers_regex.test(selected_quantity) == false) {
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
	else if(selected_weight != ""){
		selected_weight = selected_weight.replace(/ /g, '');
		selected_weight = selected_weight.trim();
		if (selected_weight.charAt(0) == 0) {
			selected_weight = selected_weight.slice(1);
			selected_weight = selected_weight.trim();
		}

		if (typeof selected_weight != "undefined" && selected_weight != "" && selected_weight != 0) {
			if (price_regex.test(selected_weight) == false) {
				all_errors_check = 0;
			}
			else {
				jQuery('input[name="selected_weight"]').val(selected_weight);
			}
		}
		else {
			all_errors_check = 0;
		}
	}

	var selected_rate = "";
	selected_rate = jQuery('input[name="price_per_qty"]').val();
	selected_rate = selected_rate.replace(/ /g, '');
	selected_rate = selected_rate.trim();
	if (selected_rate.charAt(0) == 0) {
		selected_rate = selected_rate.slice(1);
		selected_rate = selected_rate.trim();
	}

	if (typeof selected_rate != "undefined" && selected_rate != "" && selected_rate != 0) {
		if (price_regex.test(selected_rate) == false) {
			all_errors_check = 0;
		}
		else {
			jQuery('input[name="price_per_qty"]').val(selected_rate);
		}
	}
	else {
		all_errors_check = 0;
	}

	if (all_errors_check == 1) {
		if ((parseInt(selected_quantity) && numbers_regex.test(selected_quantity) == true) && (parseFloat(selected_rate) > 0 && price_regex.test(selected_rate) == true)) {
			var selected_amount = parseFloat(selected_rate) * parseInt(selected_quantity);
			selected_amount = check_decimal(selected_amount);
			if (jQuery('input[name="amount"]').length > 0) {
				jQuery('input[name="amount"]').val(selected_amount);
			}
		}
		else if((parseFloat(selected_weight) && price_regex.test(selected_weight) == true) && (parseFloat(selected_rate) > 0 && price_regex.test(selected_rate) == true)){
			var selected_amount = parseFloat(selected_rate) * parseFloat(selected_weight);
			selected_amount = check_decimal(selected_amount);
			if (jQuery('input[name="amount"]').length > 0) {
				jQuery('input[name="amount"]').val(selected_amount);
			}
		}
		else {
			if (jQuery('input[name="amount"]').length > 0) {
				jQuery('input[name="amount"]').val('');
			}
		}
	}
	else {
		if (jQuery('input[name="amount"]').length > 0) {
			jQuery('input[name="amount"]').val('');
		}
	}
	if (jQuery('.sub_total_amount').length > 0) {
		jQuery('.sub_total_amount').html(selected_amount);
	}
	if (jQuery('.overall_total_amount').length > 0) {
		jQuery('.overall_total_amount').html(selected_amount);
	}
	if (jQuery('.charges_total_value').length > 0) {
		jQuery('.charges_total_value').html(selected_amount);
	}
	if (jQuery('.loading_total_value').length > 0) {
		jQuery('.loading_total_value').html(selected_amount);
	}
	if (jQuery('.unloading_total_value').length > 0) {
		jQuery('.unloading_total_value').html(selected_amount);
	}
}
function calTotal() {
	var sno = 1;
	if (jQuery('.sno').length > 0) {
		jQuery('.sno').each(function() {
			jQuery(this).html(sno);
			sno = parseInt(sno) + 1;
		});
	}

	if(jQuery('.sub_total').length > 0) {
		jQuery('.sub_total').html('');
	}
	if(jQuery('.delivery_charges_value').length > 0) {
		jQuery('.delivery_charges_value').html('');
	}
	if(jQuery('.delivery_charges_total').length > 0) {
		jQuery('.delivery_charges_total').html('');
	}
	if(jQuery('.unloading_charges_value').length > 0) {
		jQuery('.unloading_charges_value').html('');
	}
	if(jQuery('.unloading_charges_total').length > 0) {
		jQuery('.unloading_charges_total').html('');
	}
	if(jQuery('.loading_charges_value').length > 0) {
		jQuery('.loading_charges_value').html('');
	}
	if(jQuery('.loading_charges_total').length > 0) {
		jQuery('.loading_charges_total').html('');
	}
	if(jQuery('.cgst_value').length > 0) {
		jQuery('.cgst_value').html('');
	}
	if(jQuery('.sgst_value').length > 0) {
		jQuery('.sgst_value').html('');
	}
	if(jQuery('.igst_value').length > 0) {
		jQuery('.igst_value').html('');
	}
	if(jQuery('.total_tax').length > 0) {
		jQuery('.total_tax').html('');
	}
	if(jQuery('.overall_total').length > 0) {
		jQuery('.overall_total').html('');
	}

	var amount_total = 0;
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
		});		
		if(price_regex.test(amount_total) == true) {
            amount_total = check_decimal(amount_total);	
			if(jQuery('.sub_total').length > 0) {
                jQuery('.sub_total').html(amount_total);
            }
			if (jQuery('.delivery_charges_total').length > 0) {
				jQuery('.delivery_charges_total').html(amount_total);
			}
			if (jQuery('.unloading_charges_total').length > 0) {
				jQuery('.unloading_charges_total').html(amount_total);
			}
			if (jQuery('.loading_charges_total').length > 0) {
				jQuery('.loading_charges_total').html(amount_total);
			}
			if(jQuery('.overall_total').length > 0) {
                jQuery('.overall_total').html(amount_total);
            }
		}
		checkDeliveryCharges();
	}
}

function checkDeliveryCharges() {
	var amount = 0;
	if (jQuery('.sub_total').length > 0) {
		amount = jQuery('.sub_total').html();	
		amount = amount.replace(/ /g, '');
		amount = amount.trim();

		var delivery_charges = ""; var delivery_charges_value = "";
		if(jQuery('.delivery_charges_value').length > 0) {
			jQuery('.delivery_charges_value').html('');
		}
		if (price_regex.test(amount) == true) {	
			if(jQuery('.extra_charges').length > 0) {
				delivery_charges = jQuery('.extra_charges').val();
				delivery_charges = jQuery.trim(delivery_charges);
			}
			if(typeof delivery_charges != "undefined" && delivery_charges != null && delivery_charges != "") {
				if (delivery_charges.indexOf('%') != -1) {
					delivery_charges = delivery_charges.replace('%', '');
					delivery_charges = jQuery.trim(delivery_charges);
					if (price_regex.test(delivery_charges) == true) {
						delivery_charges_value = (parseFloat(amount) * parseFloat(delivery_charges)) / 100;
					}
				}
				else {
					if (price_regex.test(delivery_charges) == true) {
						delivery_charges_value = parseFloat(delivery_charges);
					}
				}
			}
		}
		if(price_regex.test(delivery_charges_value) == true) {
			delivery_charges_value = check_decimal(delivery_charges_value);
			var total = "";
			total = parseFloat(amount) + parseFloat(delivery_charges_value);
			total = check_decimal(total);
			if (jQuery('.delivery_charges_value').length > 0) {
				jQuery('.delivery_charges_value').html(delivery_charges_value);
			}
			if (jQuery('.delivery_charges_total').length > 0) {
				jQuery('.delivery_charges_total').html(total);
			}
			if (jQuery('.unloading_charges_total').length > 0) {
				jQuery('.unloading_charges_total').html(total);
			}
			if (jQuery('.loading_charges_total').length > 0) {
				jQuery('.loading_charges_total').html(total);
			}
			if (jQuery('.overall_total').length > 0) {
				jQuery('.overall_total').html(total);
			}
		}
		checkUnloadingCharges();
	}
}

function checkUnloadingCharges() {
	var amount = 0;
	if (jQuery('.delivery_charges_total').length > 0) {
		amount = jQuery('.delivery_charges_total').html();	
		amount = amount.replace(/ /g, '');
		amount = amount.trim();
		
		var unloading_charges = ""; var unloading_charges_value = "";
		if(jQuery('.unloading_charges_value').length > 0) {
			jQuery('.unloading_charges_value').html('');
		}

		if (price_regex.test(amount) == true) {	
			if(jQuery('.unload').length > 0) {
				unloading_charges = jQuery('.unload').val();
				unloading_charges = jQuery.trim(unloading_charges);
			}
			if(typeof unloading_charges != "undefined" && unloading_charges != null && unloading_charges != "") {
				if (unloading_charges.indexOf('%') != -1) {
					unloading_charges = unloading_charges.replace('%', '');
					unloading_charges = jQuery.trim(unloading_charges);
					if (price_regex.test(unloading_charges) == true) {
						unloading_charges_value = (parseFloat(amount) * parseFloat(unloading_charges)) / 100;
					}
				}
				else {
					if (price_regex.test(unloading_charges) == true) {
						unloading_charges_value = parseFloat(unloading_charges);
					}
				}
			}
		}
		if(price_regex.test(unloading_charges_value) == true) {
			unloading_charges_value = check_decimal(unloading_charges_value);
			var total = "";
			total = parseFloat(amount) + parseFloat(unloading_charges_value);
			total = check_decimal(total);
			if (jQuery('.unloading_charges_value').length > 0) {
				jQuery('.unloading_charges_value').html(unloading_charges_value);
			}
			if (jQuery('.unloading_charges_total').length > 0) {
				jQuery('.unloading_charges_total').html(total);
			}
			if (jQuery('.loading_charges_total').length > 0) {
				jQuery('.loading_charges_total').html(total);
			}
			if (jQuery('.overall_total').length > 0) {
				jQuery('.overall_total').html(total);
			}
		}
		checkLoadingCharges();
	}
}

function checkLoadingCharges() {
	var amount = 0;
	if (jQuery('.unloading_charges_total').length > 0) {
		amount = jQuery('.unloading_charges_total').html();	
		amount = amount.replace(/ /g, '');
		amount = amount.trim();
		
		var loading_charges = ""; var loading_charges_value = "";
		if(jQuery('.loading_charges_value').length > 0) {
			jQuery('.loading_charges_value').html('');
		}

		if (price_regex.test(amount) == true) {	
			if(jQuery('.load').length > 0) {
				loading_charges = jQuery('.load').val();
				loading_charges = jQuery.trim(loading_charges);
			}
			if(typeof loading_charges != "undefined" && loading_charges != null && loading_charges != "") {
				if (loading_charges.indexOf('%') != -1) {
					loading_charges = loading_charges.replace('%', '');
					loading_charges = jQuery.trim(loading_charges);
					if (price_regex.test(loading_charges) == true) {
						loading_charges_value = (parseFloat(amount) * parseFloat(loading_charges)) / 100;
					}
				}
				else {
					if (price_regex.test(loading_charges) == true) {
						loading_charges_value = parseFloat(loading_charges);
					}
				}
			}
		}
		if(price_regex.test(loading_charges_value) == true) {
			loading_charges_value = check_decimal(loading_charges_value);
			var total = "";
			total = parseFloat(amount) + parseFloat(loading_charges_value);
			total = check_decimal(total);
			if (jQuery('.loading_charges_value').length > 0) {
				jQuery('.loading_charges_value').html(loading_charges_value);
			}
			if (jQuery('.loading_charges_total').length > 0) {
				jQuery('.loading_charges_total').html(total);
			}
			if (jQuery('.overall_total').length > 0) {
				jQuery('.overall_total').html(total);
			}
		}
		checkGST();
	}
}

function ShowGST() {
	var checkbox_button = document.getElementById('gst_option').checked;
    
    if(checkbox_button == true){
        document.getElementById('gst_option').value = 1;
    }
    else if(checkbox_button == false){
        document.getElementById('gst_option').value = 0;
    }
	checkGST();
}

function checkGST() {
	if(jQuery('.cgst_row').length > 0) { jQuery('.cgst_row').addClass('d-none'); }
	if(jQuery('.sgst_row').length > 0) { jQuery('.sgst_row').addClass('d-none'); }
	if(jQuery('.igst_row').length > 0) { jQuery('.igst_row').addClass('d-none'); }

	if(jQuery('.cgst').length > 0) { jQuery('.cgst').html(''); }
	if(jQuery('.sgst').length > 0) { jQuery('.sgst').html(''); }
	if(jQuery('.igst').length > 0) { jQuery('.igst').html(''); }

	if(jQuery('.cgst_value').length > 0) { jQuery('.cgst_value').html(''); }
	if(jQuery('.sgst_value').length > 0) { jQuery('.sgst_value').html(''); }
	if(jQuery('.igst_value').length > 0) { jQuery('.igst_value').html(''); }

	var gst_option = 0;
	if(jQuery('input[name="gst_option"]').length > 0) {
		gst_option = jQuery('input[name="gst_option"]').val();
		gst_option = jQuery.trim(gst_option);
	}
	var tax_amount = "";
	if (jQuery('.loading_charges_total').length > 0) {
		tax_amount = jQuery('.loading_charges_total').html();
		tax_amount = jQuery.trim(tax_amount);
	}
	var total_tax = "";
	if(parseInt(gst_option) == 1 && price_regex.test(tax_amount) == true) {
		var consignor_state = "";
		if (jQuery('input[name="consignor_state"]').length > 0) {
			consignor_state = jQuery('input[name="consignor_state"]').val();
			consignor_state = jQuery.trim(consignor_state);
		}
		var consignee_state = "";
		if (jQuery('input[name="consignee_state"]').length > 0) {
			consignee_state = jQuery('input[name="consignee_state"]').val();
			consignee_state = jQuery.trim(consignee_state);
		}
		var from_branch_state = "";
		if (jQuery('input[name="from_branch_state"]').length > 0) {
			from_branch_state = jQuery('input[name="from_branch_state"]').val();
			from_branch_state = jQuery.trim(from_branch_state);
		}
		var bill_type = "";
		if(jQuery('select[name="bill_type"]').length > 0) {
			bill_type = jQuery('select[name="bill_type"]').val().trim();
		}
		if(typeof bill_type != "undefined" && bill_type != null && bill_type != "") {
			var company_state = ""; var party_state = "";
			if(bill_type == "Paid") {
				company_state = consignor_state;
				party_state = consignee_state;
			}		
			else {
				company_state = from_branch_state;
				party_state = consignee_state;
			}
			var tax_value = 5;			
			if (company_state == party_state) {
				if(jQuery('.cgst_row').length > 0) { jQuery('.cgst_row').removeClass('d-none'); }
				if(jQuery('.sgst_row').length > 0) { jQuery('.sgst_row').removeClass('d-none'); }

				var tax = "";
				tax = parseInt(tax_value) / 2;
				if(jQuery('.cgst').length > 0) { jQuery('.cgst').html(tax+'%'); }
				if(jQuery('.sgst').length > 0) { jQuery('.sgst').html(tax+'%'); }
				
				total_tax = (parseFloat(tax_amount) * parseInt(tax_value)) / 100;
				total_tax = check_decimal(total_tax);

				total_tax_half = parseFloat(total_tax) / 2;
				total_tax_half = check_decimal(total_tax_half);
				if(jQuery('.cgst_value').length > 0) { jQuery('.cgst_value').html(total_tax_half); }
				if(jQuery('.sgst_value').length > 0) { jQuery('.sgst_value').html(total_tax_half); }
			}
			else {
				if(jQuery('.igst_row').length > 0) { jQuery('.igst_row').removeClass('d-none'); }
				var tax = "";
				tax = parseInt(tax_value);
				if(jQuery('.igst').length > 0) { jQuery('.igst').html(tax+'%'); }
				total_tax = (parseFloat(tax_amount) * parseInt(tax_value)) / 100;
				total_tax = check_decimal(total_tax);
				if(jQuery('.igst_value').length > 0) { jQuery('.igst_value').html(total_tax); }
			}	
		}
	}

	var overall_total = "";
	if(price_regex.test(total_tax) == true) {
		overall_total = parseFloat(tax_amount) + parseFloat(total_tax);
		overall_total = check_decimal(overall_total);
	}
	else {
		overall_total = tax_amount;
	}

	if (jQuery('.round_off').length > 0) {
		jQuery('.round_off').html('');
	}

	if(price_regex.test(overall_total) == true) {
		var decimal = ""; var round_off = '';
		var numbers = overall_total.toString().split('.');							
		if( typeof numbers[1] != 'undefined') {
			decimal = numbers[1];
		}
		if(decimal != "" && decimal != "00") {
			if(decimal.length == 1) {
				decimal = decimal+'0';
			}
			var round_off = 0;
			if(parseFloat(decimal) >= 50) {
				round_off = 100 - parseFloat(decimal);
				if(round_off.toString().length == 1) {
					round_off = "0.0"+round_off;
				}
				else {
					round_off = "0."+round_off;
				}
				overall_total = parseFloat(overall_total) + parseFloat(round_off);
				if (jQuery('.round_off').length > 0) {
					jQuery('.round_off').html(round_off);
				}
			}
			else { 
				round_off = decimal;                        
				if(round_off.toString().length == 1) {
					round_off = "0.0"+round_off;
				}
				else {
					round_off = "0."+round_off;
				}
				if (jQuery('.round_off').length > 0) {
					jQuery('.round_off').html("-"+round_off);
				}
				overall_total = parseFloat(overall_total) - parseFloat(round_off);
			}   
		}
	}
	if (jQuery('.overall_total').length > 0) {
		jQuery('.overall_total').html(overall_total);
	}
}

function GetToBranch(from_branch_id) {
	var post_url = "lr_bill_changes.php?get_to_branch_list="+from_branch_id;
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = result.trim();
			result = result.split("$$$");
			if(jQuery('select[name="to_branch_id"]').length > 0) {
				jQuery('select[name="to_branch_id"]').html(result[0]);
			}
			if(jQuery('input[name="from_branch_state"]').length > 0) {
				jQuery('input[name="from_branch_state"]').val(result[1]);
			}
			checkGST();
		}
	});
}
function getBillType() {
	var bill_type = "";
	if(jQuery('select[name="bill_type"]').length > 0) {
		bill_type = jQuery('select[name="bill_type"]').val().trim();
	}
	var consignor_id = "";
	if(jQuery('input[name="selected_consignor_id"]').length > 0) {
		consignor_id = jQuery('input[name="selected_consignor_id"]').val().trim();
	}
	var consignee_id = "";
	if(jQuery('input[name="selected_consignee_id"]').length > 0) {
		consignee_id = jQuery('input[name="selected_consignee_id"]').val().trim();
	}
	var account_party_id = "";
	if(jQuery('input[name="selected_account_party_id"]').length > 0) {
		account_party_id = jQuery('input[name="selected_account_party_id"]').val().trim();
	}
	if(bill_type != "" && bill_type != null && typeof bill_type != "undefined") {
		var bill_unit_id = "";
		if(bill_type == "ToPay") {
			bill_unit_id = consignee_id;
		}
		else if(bill_type == "Paid") {
			bill_unit_id = consignor_id;
		}
		else if(bill_type == "Account Party") {
			bill_unit_id = account_party_id;
		}
		if(jQuery('.product_row').length > 0) {
			jQuery('.product_row').each(function(){
				var this_row = jQuery(this);
				var unit_id = "";
				if(jQuery(this).find('select[name="selected_unit_id[]"]').length > 0) {
					unit_id = jQuery(this).find('select[name="selected_unit_id[]"]').val().trim();
				}
				var post_url = "lr_bill_changes.php?unit_price_id="+unit_id+"&unit_bill_id="+bill_unit_id+"&unit_bill_type="+bill_type;
				jQuery.ajax({
					url: post_url, success: function (result) {
						result = result.trim();
						list = result.split("$$$");
						if(list[0] != ""){
							list[0] = list[0].trim();

							if(this_row.find('input[name="price_per_qty[]"]').length > 0 && (this_row.find('input[name="price_per_qty[]"]').val() == 0 || this_row.find('input[name="price_per_qty[]"]').val() == "" || this_row.find('input[name="price_per_qty[]"]').val() == null)) {
								this_row.find('input[name="price_per_qty[]"]').val(list[0]);
							}
							var this_row_price = this_row.find('input[name="price_per_qty[]"]');
						}
						if(list[1] != ""){
							list[1] = list[1].trim();
							if(this_row.find('input[name="price_per_kooli[]"]').length > 0) {
								this_row.find('input[name="price_per_kooli[]"]').val(list[1]);
							}
						}
						ProductRowCheck(this_row_price);
					}
				});
			});
		}
	}
	else {
		checkGST();
	}
}