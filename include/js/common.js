// JavaScript Document
function CheckPassword(field_name) {
	var password = "";
	if (jQuery('input[name="password"]').length > 0) {
		password = jQuery('input[name="password"]').val();
		//password = jQuery.trim(password);
	}

	if (jQuery('#password_cover').length > 0) {
		if (jQuery('#password_cover').find('label').length > 0) {
			jQuery('#password_cover').find('label').addClass('text-danger');
		}
		if (jQuery('#password_cover').find('input[name="length_check"]').length > 0) {
			jQuery('#password_cover').find('input[name="length_check"]').prop('checked', false);
		}
		if (jQuery('#password_cover').find('input[name="letter_check"]').length > 0) {
			jQuery('#password_cover').find('input[name="letter_check"]').prop('checked', false);
		}
		if (jQuery('#password_cover').find('input[name="number_symbol_check"]').length > 0) {
			jQuery('#password_cover').find('input[name="number_symbol_check"]').prop('checked', false);
		}
		if (jQuery('#password_cover').find('input[name="space_check"]').length > 0) {
			jQuery('#password_cover').find('input[name="space_check"]').prop('checked', false);
		}

		var upper_regex = /[A-Z]/; var lower_regex = /[a-z]/;
		var number_regex = /\d/; var symbol_regex = /[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\]/; var no_space_regex = /^\S+$/;

		if (typeof password != "undefined" && password != null && password != "") {
			var password_length = password.length;
			if (parseInt(password_length) >= 8 && parseInt(password_length) <= 20) {
				if (jQuery('#password_cover').find('input[name="length_check"]').length > 0) {
					jQuery('#password_cover').find('input[name="length_check"]').prop('checked', true);
					if (jQuery('#password_cover').find('input[name="length_check"]').parent().find('label').length > 0) {
						jQuery('#password_cover').find('input[name="length_check"]').parent().find('label').removeClass('text-danger');
						jQuery('#password_cover').find('input[name="length_check"]').parent().find('label').addClass('text-success');
					}
				}
			}
			if ((upper_regex.test(password) == true) && (lower_regex.test(password) == true)) {
				if (jQuery('#password_cover').find('input[name="letter_check"]').length > 0) {
					jQuery('#password_cover').find('input[name="letter_check"]').prop('checked', true);
					if (jQuery('#password_cover').find('input[name="letter_check"]').parent().find('label').length > 0) {
						jQuery('#password_cover').find('input[name="letter_check"]').parent().find('label').removeClass('text-danger');
						jQuery('#password_cover').find('input[name="letter_check"]').parent().find('label').addClass('text-success');
					}
				}
			}
			if ((number_regex.test(password) == true) && (symbol_regex.test(password) == true)) {
				if (jQuery('#password_cover').find('input[name="number_symbol_check"]').length > 0) {
					jQuery('#password_cover').find('input[name="number_symbol_check"]').prop('checked', true);
					if (jQuery('#password_cover').find('input[name="number_symbol_check"]').parent().find('label').length > 0) {
						jQuery('#password_cover').find('input[name="number_symbol_check"]').parent().find('label').removeClass('text-danger');
						jQuery('#password_cover').find('input[name="number_symbol_check"]').parent().find('label').addClass('text-success');
					}
				}
			}
			if (no_space_regex.test(password) == true) {
				if (jQuery('#password_cover').find('input[name="space_check"]').length > 0) {
					jQuery('#password_cover').find('input[name="space_check"]').prop('checked', true);
					if (jQuery('#password_cover').find('input[name="space_check"]').parent().find('label').length > 0) {
						jQuery('#password_cover').find('input[name="space_check"]').parent().find('label').removeClass('text-danger');
						jQuery('#password_cover').find('input[name="space_check"]').parent().find('label').addClass('text-success');
					}
				}
			}
		}
	}
}
function getClearance(lr_id) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				jQuery('#clearancemodal .modal-body').html('');
				var post_url = "clearance_entry_changes.php?is_cleared=1+&lr_id=" + lr_id;
				jQuery.ajax({
					url: post_url, success: function (result) {
						jQuery('#clearancemodal .modal-body').html(result);
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
function getAckowlegedInvoice() {

	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				jQuery('#AcknowledgementModal .modal-body').html('');
				var post_url = "invoice_acknowledgement_changes.php?is_acknowlegement=1";
				jQuery.ajax({
					url: post_url, success: function (result) {
						jQuery('#AcknowledgementModal .modal-body').html(result);
						jQuery('.acknowledgement_modal_button').trigger("click");
					}
				});
			}
			else {
				window.location.reload();
			}
		}
	});

}
function SelectAllModuleActionToggle(obj, toggle_id) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var toggle_value = 2;
				if (jQuery('#' + toggle_id).length > 0) {
					if (jQuery('#' + toggle_id).prop('checked') == true) {
						toggle_value = 1;
					}
					jQuery('#' + toggle_id).val(toggle_value);
				}
				if (parseInt(toggle_value) == 1) {
					if (jQuery('#' + toggle_id).parent().parent().parent().parent().find('input[type="checkbox"]').length > 0) {
						jQuery('#' + toggle_id).parent().parent().parent().parent().find('input[type="checkbox"]').each(function () {
							jQuery(this).prop('checked', true);
							jQuery(this).val('1');
						});
					}
				}
				else {
					if (jQuery('#' + toggle_id).parent().parent().parent().parent().find('input[type="checkbox"]').length > 0) {
						jQuery('#' + toggle_id).parent().parent().parent().parent().find('input[type="checkbox"]').each(function () {
							jQuery(this).prop('checked', false);
							jQuery(this).val('2');
						});
					}
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}
function FormSubmit(event, form_name, submit_page, redirection_page) {
	event.preventDefault();

	if (jQuery('div.alert').length > 0) {
		jQuery('div.alert').remove();
	}
	jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-danger mb-5"> <button type="button" class="close" data-dismiss="alert">&times;</button> Processing </div>');

	if (jQuery('.submit_button').length > 0) {
		jQuery('.submit_button').attr('disabled', true);
	}
	jQuery.ajax({
		url: submit_page,
		type: "post",
		async: true,
		data: jQuery('form[name="' + form_name + '"]').serialize(),
		dataType: 'html',
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (data) {
			//console.log(data);
			try {
				var x = JSON.parse(data);
			} catch (e) {
				return false;
			}
			//console.log(x);

			if (jQuery('span.infos').length > 0) {
				jQuery('span.infos').remove();
			}
			if (jQuery('.valid_error').length > 0) {
				jQuery('.valid_error').remove();
			}
			if (jQuery('div.alert').length > 0) {
				jQuery('div.alert').remove();
			}

			if (typeof x.redirection_page != "undefined" && x.redirection_page != "") {
				redirection_page = x.redirection_page;
			}

			if (x.number == '1') {
				jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' + x.msg + ' </div>');
				jQuery('html, body').animate({
					scrollTop: (jQuery('form[name="' + form_name + '"]').offset().top)
				}, 500);
				setTimeout(function () {
					if (typeof redirection_page != "undefined" && redirection_page != "") {
						window.location = redirection_page;
					}
					else {
						window.location.reload();
					}
				}, 1000);
			}

			if (x.number == '2') {
				jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' + x.msg + ' </div>');
				if (jQuery('.submit_button').length > 0) {
					jQuery('.submit_button').attr('disabled', false);
				}
				jQuery('html, body').animate({
					scrollTop: (jQuery('form[name="' + form_name + '"]').offset().top)
				}, 500);
			}

			if (x.number == '3') {
				jQuery('form[name="' + form_name + '"]').append('<div class="valid_error"> <script type="text/javascript"> ' + x.msg + ' </script> </div>');
				if (jQuery('.submit_button').length > 0) {
					jQuery('.submit_button').attr('disabled', false);
				}
				jQuery('html, body').animate({
					scrollTop: (jQuery('form[name="' + form_name + '"]').offset().top)
				}, 500);
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
		}
	});
}
function table_listing_records_filter() {
	if (jQuery('#table_listing_records').length > 0) {
		jQuery('#table_listing_records').html('<div class="alert alert-success mb-3 mx-3"> Loading... </div>');
	}

	var check_login_session = 1;
	// var post_url = "dashboard_changes.php?check_login_session=1";
	// jQuery.ajax({
	// 	url: post_url, success: function (check_login_session) {
	if (check_login_session == 1) {
		var page_title = ""; var post_send_file = "";
		if (jQuery('input[name="page_title"]').length > 0) {
			page_title = jQuery('input[name="page_title"]').val();
			if (typeof page_title != "undefined" && page_title != "") {
				page_title = page_title.replaceAll(" ", "_");
				page_title = page_title.toLowerCase();
				page_title = jQuery.trim(page_title);
				post_send_file = page_title + "_changes.php";
			}
		}
		jQuery.ajax({
			url: post_send_file,
			type: "post",
			async: true,
			data: jQuery('form[name="table_listing_form"]').serialize(),
			dataType: 'html',
			contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
			success: function (result) {
				if (jQuery('.alert').length > 0) {
					jQuery('.alert').remove();
				}
				if (jQuery('#table_listing_records').length > 0) {
					jQuery('#table_listing_records').html(result);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}
	else {
		window.location.reload();
	}
	// 	}
	// });
}
function ShowModalContent(page_title, add_edit_id_value) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	// jQuery.ajax({url: post_url, success: function(check_login_session){
	// 	if(check_login_session == 1) {
	var add_edit_id = ""; var post_send_file = ""; var heading = "";
	if (typeof page_title != "undefined" && page_title != "") {
		heading = page_title;
		page_title = page_title.replaceAll(" ", "_");
		page_title = page_title.toLowerCase();
		add_edit_id = "show_" + page_title + "_id";
		post_send_file = page_title + "_changes.php";
		page_title = page_title + " Details";
		if (jQuery('.edit_title').length > 0) {
			page_title = page_title.replaceAll("_", " ");
			page_title = page_title.toLowerCase().replace(/\b[a-z]/g, function (string) {
				return string.toUpperCase();
			});
			jQuery('.edit_title').html(page_title);
		}
		if (jQuery('#table_records_cover').length > 0) {
			jQuery('#table_records_cover').addClass('d-none');
		}
		if (jQuery('#add_update_form_content').length > 0) {
			jQuery('#add_update_form_content').removeClass('d-none');
		}
	}
	var post_url = post_send_file + "?" + add_edit_id + "=" + add_edit_id_value;
	jQuery.ajax({
		url: post_url, success: function (result) {
			if (jQuery('.add_update_form_content').length > 0) {
				jQuery('.add_update_form_content').html("");
				jQuery('.add_update_form_content').html(result);
			}
			jQuery('html, body').animate({
				scrollTop: (jQuery('.add_update_form_content').parent().parent().offset().top)
			}, 500);
		}
	});
	// }
	// else {
	// 	window.location.reload();
	// }
	// }});
}
function SaveModalContent(form_name, post_send_file, redirection_file) {
	if (jQuery('div.alert').length > 0) {
		jQuery('div.alert').remove();
	}
	jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-danger mb-3"> <button type="button" class="close" data-dismiss="alert">&times;</button> Processing </div>');
	if (jQuery('.submit_button').length > 0) {
		jQuery('.submit_button').attr('disabled', true);
	}
	if (form_name != "login_form") {
		if (form_name != "bill_company_form") {
			jQuery('html, body').animate({
				scrollTop: (jQuery('.add_update_form_content').parent().parent().offset().top)
			}, 500);
		}
		var check_login_session = 1;
		var post_url = "dashboard_changes.php?check_login_session=1";
		jQuery.ajax({
			url: post_url, success: function (check_login_session) {
				if (check_login_session == 1) {
					SendModalContent(form_name, post_send_file, redirection_file);
					// window.location.reload();
				}
				else {
					window.location.reload();
				}
			}
		});
	}
	else {
		jQuery('html, body').animate({
			scrollTop: (jQuery('form[name="' + form_name + '"]').offset().top)
		}, 500);
		SendModalContent(form_name, post_send_file, redirection_file);
		// window.location.reload();
	}
}
function SendModalContent(form_name, post_send_file, redirection_file) {
	jQuery.ajax({
		url: post_send_file,
		type: "post",
		async: true,
		data: jQuery('form[name="' + form_name + '"]').serialize(),
		dataType: 'html',
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (data) {
			// alert(data);
			//console.log(data);
			try {
				var x = JSON.parse(data);
			} catch (e) {
				return false;
			}
			//console.log(x);

			if (jQuery('span.infos').length > 0) {
				jQuery('span.infos').remove();
			}

			var inputFields = document.querySelectorAll('input');

			// Loop through each input field and set its border color to black
			inputFields.forEach(function (input) {
				input.style.borderColor = '#ccc';
			});

			if (jQuery('.valid_error').length > 0) {
				jQuery('.valid_error').remove();
			}
			if (jQuery('div.alert').length > 0) {
				jQuery('div.alert').remove();
			}

			if (x.number == '1') {
				// if(form_name == 'tripsheet_profit_loss_form'){
				// 	ExpenseModalOpen();
				// }else{
				jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' + x.msg + ' </div>');


				setTimeout(function () {
					var page_title = "";
					if (jQuery('input[name="page_title"]').length > 0) {
						page_title = jQuery('input[name="page_title"]').val();
						page_title = page_title.trim()
					}
					// alert(form_name+""+page_title)

					if (typeof x.product_id != "undefined" && x.product_id != "" && page_title != "Product") {

						if (jQuery('#CustomProductModal .modal-header').find('.close').length > 0) {
							jQuery('#CustomProductModal .modal-header').find('.close').trigger("click");
						}
						ChangeProductIDs();

						jQuery('form[name="purchase_entry_form"], form[name="invoice_form"]').each(function () {
							if (jQuery(this).find('.submit_button').length > 0) {
								jQuery(this).find('.submit_button').attr('disabled', false);
							}
						});

					} else if (typeof x.party_id != "undefined" && x.party_id != "" && page_title == "Purchase Entry") {

						if (jQuery('#CustomPartyModal .modal-header').find('.close').length > 0) {
							jQuery('#CustomPartyModal .modal-header').find('.close').trigger("click");
						}

						if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
							jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
						}


						selected_form = page_title.replaceAll(" ", "_");
						selected_form = selected_form.toLowerCase();

						ChangePartyIDs(selected_form + "_form");

						jQuery('form[name="purchase_entry_form"]').each(function () {
							if (jQuery(this).find('.submit_button').length > 0) {
								jQuery(this).find('.submit_button').attr('disabled', false);
							}
						});
					}
					else if (page_title == "Purchase Entry") {
						if (jQuery('#PaymentModal .modal-header').find('.close').length > 0) {
							jQuery('#PaymentModal .modal-header').find('.close').trigger("click");
							setTimeout(function () {
								window.location = x.redirection_page;
							}, 600);
						} else {
							window.location = x.redirection_file;
						}

					}
					// else if(page_title == 'Tripsheet Profit Loss'){
					// 	if (jQuery('#ExpenseModal .modal-header').find('.close').length > 0) {
					// 		jQuery('#ExpenseModal .modal-header').find('.close').trigger("click");
					// 		setTimeout(function () {
					// 			window.location = x.redirection_page;
					// 		}, 600)
					// 	}else{
					// 		window.location = x.redirection_file;
					// 	}
					// }
					else if (page_title == "Organization") {
						ShowModalContent('Organization', '54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178');
					}
					// else if((form_name == 'expense_form') && (page_title == 'Tripsheet Profit Loss')){
					// 		if (jQuery('#ExpenseModal').length > 0) {
					// 			jQuery('#ExpenseModal .modal-header .close').trigger("click");
					// 		}
					// }
					else if (jQuery('.redirection_form').length > 0) {
						if (typeof x.redirection_page != "undefined" && x.redirection_page != "") {
							window.location = x.redirection_page;
						}
						else {
							window.location = redirection_file;
						}
					}
					else {
						if (typeof x.lr_id != "undefined" && x.lr_id != null && x.lr_id != "") {
							jQuery('#LRPrintModal .modal-footer .yes').attr('id', x.lr_id);
							jQuery('#LRPrintModal .modal-footer .no').attr('id', x.lr_id);
							if (jQuery('.lr_print_modal_button').length > 0) {
								jQuery('.lr_print_modal_button').trigger("click");
							}

						}
						else {
							if (jQuery('#StockUpdateModal').length > 0) {
								jQuery('#StockUpdateModal .modal-header .close').trigger("click");
							}
							if (jQuery('.add_update_form_content').length > 0) {
								jQuery('.add_update_form_content').html("");
							}
							if (jQuery('#AcknowledgementModal').length > 0) {
								jQuery('#AcknowledgementModal .modal-header .close').trigger("click");
							}
							if (jQuery('#clearancemodal').length > 0) {
								jQuery('#clearancemodal .modal-header .close').trigger("click");
							}
							if (jQuery('#PaymentStatusModal').length > 0) {
								jQuery('#PaymentStatusModal .modal-header .close').trigger("click");
							}
							if (jQuery('#table_records_cover').hasClass('d-none')) {
								jQuery('#table_records_cover').removeClass('d-none');
							}
							if (form_name == 'bill_company_form' || form_name == 'lr_form' || form_name == 'tripsheet_form' || form_name == 'Acknowledgement_form' || form_name == 'clearance_form') {
								setTimeout(function () {
									window.location.reload();
								}, 1500);
							}
							else {
								table_listing_records_filter();
							}
							if (form_name == 'godown_form') {
								window.location.reload();
							}
						}
					}
				}, 1000);
			}
			// alert(form_name)
			if (x.number == '2') {
				if (form_name == 'purchase_entry_form') {
					if ($('#PaymentModal').hasClass('show')) {
						jQuery('#PaymentModal').find('.row:first').before('<div class="alert alert-danger"> ' + x.msg + ' </div>');
						if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
							jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
						}
					} else {
						jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-danger"> ' + x.msg + ' </div>');
						if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
							jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
						}
					}

				}
				else if (form_name == 'tripsheet_profit_loss_form') {
					if ($('#ExpenseModal').hasClass('show')) {
                        jQuery('#ExpenseModal').find('.expense-section:first').before('<div class="alert alert-danger"> ' + x.msg + ' </div>');
                        if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
                            jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
                        }
                    } else {
                        jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-danger"> ' + x.msg + ' </div>');
                        if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
                            jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
                        }
                    }
				}
				else {
					jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' + x.msg + ' </div>');
					if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
						jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
					}
				}

			}

			if (x.number == '3') {
				// alert("sumit")
				if (form_name == 'tripsheet_profit_loss_form' && jQuery('#ExpenseModal').length > 0 && jQuery('#ExpenseModal').hasClass('show')) {
					jQuery('form[name="' + form_name + '"]').append('<div class="valid_error"> <script type="text/javascript"> ' + x.msg + ' </script> </div>');
					if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
						jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
					}
				} else {
					jQuery('form[name="' + form_name + '"]').append('<div class="valid_error"> <script type="text/javascript"> ' + x.msg + ' </script> </div>');
					if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
						jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
					}
				}

			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
		}
	});
}
function SendModalContent_old(form_name, post_send_file, redirection_file) {
	jQuery.ajax({
		url: post_send_file,
		type: "post",
		async: true,
		data: jQuery('form[name="' + form_name + '"]').serialize(),
		dataType: 'html',
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (data) {
			//console.log(data);
			try {
				var x = JSON.parse(data);
			} catch (e) {
				return false;
			}
			//console.log(x);

			if (jQuery('span.infos').length > 0) {
				jQuery('span.infos').remove();
			}

			var inputFields = document.querySelectorAll('input');

			// Loop through each input field and set its border color to black
			inputFields.forEach(function (input) {
				input.style.borderColor = '#ccc';
			});

			if (jQuery('.valid_error').length > 0) {
				jQuery('.valid_error').remove();
			}
			if (jQuery('div.alert').length > 0) {
				jQuery('div.alert').remove();
			}

			if (x.number == '1') {
				jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' + x.msg + ' </div>');
				setTimeout(function () {
					var page_title = "";
					if (jQuery('input[name="page_title"]').length > 0) {
						page_title = jQuery('input[name="page_title"]').val();
						page_title = page_title.trim()
					}
					if (typeof x.product_id != "undefined" && x.product_id != "" && page_title != "Product") {

						if (jQuery('#CustomProductModal .modal-header').find('.close').length > 0) {
							jQuery('#CustomProductModal .modal-header').find('.close').trigger("click");
						}
						ChangeProductIDs();

						jQuery('form[name="purchase_entry_form"], form[name="invoice_form"]').each(function () {
							if (jQuery(this).find('.submit_button').length > 0) {
								jQuery(this).find('.submit_button').attr('disabled', false);
							}
						});

					} else if (typeof x.party_id != "undefined" && x.party_id != "" && page_title == "Purchase Entry") {

						if (jQuery('#CustomPartyModal .modal-header').find('.close').length > 0) {
							jQuery('#CustomPartyModal .modal-header').find('.close').trigger("click");
						}

						if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
							jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
						}


						selected_form = page_title.replaceAll(" ", "_");
						selected_form = selected_form.toLowerCase();

						ChangePartyIDs(selected_form + "_form");

						jQuery('form[name="purchase_entry_form"]').each(function () {
							if (jQuery(this).find('.submit_button').length > 0) {
								jQuery(this).find('.submit_button').attr('disabled', false);
							}
						});
					}
					else if (page_title == "Purchase Entry") {
						if (jQuery('#PaymentModal .modal-header').find('.close').length > 0) {
							jQuery('#PaymentModal .modal-header').find('.close').trigger("click");
							setTimeout(function () {
								window.location = x.redirection_page;
							}, 600);
						} else {
							window.location = x.redirection_file;
						}

					}

					else if (jQuery('.redirection_form').length > 0) {
						if (typeof x.redirection_page != "undefined" && x.redirection_page != "") {
							window.location = x.redirection_page;
						}
						else {
							window.location = redirection_file;
						}
					}
					else {
						if (typeof x.lr_id != "undefined" && x.lr_id != null && x.lr_id != "") {
							jQuery('#LRPrintModal .modal-footer .yes').attr('id', x.lr_id);
							jQuery('#LRPrintModal .modal-footer .no').attr('id', x.lr_id);
							if (jQuery('.lr_print_modal_button').length > 0) {
								jQuery('.lr_print_modal_button').trigger("click");
							}

						}
						else {
							if (jQuery('#StockUpdateModal').length > 0) {
								jQuery('#StockUpdateModal .modal-header .close').trigger("click");
							}
							if (jQuery('.add_update_form_content').length > 0) {
								jQuery('.add_update_form_content').html("");
							}
							if (jQuery('#AcknowledgementModal').length > 0) {
								jQuery('#AcknowledgementModal .modal-header .close').trigger("click");
							}
							if (jQuery('#clearancemodal').length > 0) {
								jQuery('#clearancemodal .modal-header .close').trigger("click");
							}
							if (jQuery('#PaymentStatusModal').length > 0) {
								jQuery('#PaymentStatusModal .modal-header .close').trigger("click");
							}
							if (jQuery('#table_records_cover').hasClass('d-none')) {
								jQuery('#table_records_cover').removeClass('d-none');
							}
							if (form_name == 'bill_company_form' || form_name == 'lr_form' || form_name == 'tripsheet_form') {
								setTimeout(function () {
									window.location.reload();
								}, 1500);
							}
							else {
								table_listing_records_filter();
							}
							if (form_name == 'godown_form') {
								window.location.reload();
							}
							if (jQuery('form[name="clearance_form"]').length > 0) {
								getClear();
							}
						}
					}
				}, 1000);
			}

			if (x.number == '2') {
				jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' + x.msg + ' </div>');
				if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
					jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
				}
			}

			if (x.number == '3') {
				jQuery('form[name="' + form_name + '"]').append('<div class="valid_error"> <script type="text/javascript"> ' + x.msg + ' </script> </div>');
				if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
					jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
		}
	});
}
function DeleteModalContent(page_title, delete_content_id) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (typeof page_title != "undefined" && page_title != "") {
					jQuery('#deletemodal .modal-header').find('h4').html("");
					jQuery('#deletemodal .modal-header').find('h4').html("Delete " + page_title);
					page_title = page_title.toLowerCase();
				}
				jQuery('.delete_modal_button').trigger("click");
				jQuery('#deletemodal .modal-body').html('');
				if (page_title == "quotation" || page_title == "estimate" || page_title == "invoice") {
					jQuery('#deletemodal .modal-body').html('Are you surely want to cancel this ' + page_title + '?');
				} else if (page_title == 'unit') {
					jQuery('#deletemodal .modal-body').html('Are you surely want to delete this LR Product ?');
				}
				else {
					jQuery('#deletemodal .modal-body').html('Are you surely want to delete this ' + page_title + '?');
				}
				jQuery('#deletemodal .modal-footer .yes').attr('id', delete_content_id);
				jQuery('#deletemodal .modal-footer .no').attr('id', delete_content_id);
			}
			else {
				window.location.reload();
			}
		}
	});
}
function DeleteNumberModalContent(page_title, delete_content_id) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (typeof page_title != "undefined" && page_title != "") {
					jQuery('#ReceiptDeleteModal .modal-header').find('h4').html("");
					jQuery('#ReceiptDeleteModal .modal-header').find('h4').html("Delete " + page_title);

					page_title = page_title.toLowerCase();
				}
				jQuery('.receipt_delete_modal_button').trigger("click");
				jQuery('#ReceiptDeleteModal .modal-body').html('');

				if (page_title == "quotation" || page_title == "estimate" || page_title == "invoice") {
					jQuery('#ReceiptDeleteModal .modal-body').html('Are you surely want to cancel this ' + page_title + '?');
				}
				else {
					jQuery('#ReceiptDeleteModal .modal-body').html('Are you surely want to delete this ' + page_title + '?');
				}

				jQuery('#ReceiptDeleteModal .modal-footer .yes').attr('id', delete_content_id);
				jQuery('#ReceiptDeleteModal .modal-footer .no').attr('id', delete_content_id);
			}
			else {
				window.location.reload();
			}
		}
	});
}
function confirm_delete_modal(obj) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				if (jQuery('#deletemodal .modal-body').find('.infos').length > 0) {
					jQuery('#deletemodal .modal-body').find('.infos').remove();
				}

				var page_title = ""; var post_send_file = "";
				if (jQuery('input[name="page_title"]').length > 0) {
					page_title = jQuery('input[name="page_title"]').val();
					if (typeof page_title != "undefined" && page_title != "") {
						page_title = page_title.replaceAll(" ", "_");
						page_title = page_title.toLowerCase();
						page_title = jQuery.trim(page_title);
						post_send_file = page_title + "_changes.php";
					}
				}
				var delete_content_id = jQuery(obj).attr('id');
				// if (page_title != 'receipt') {
				var post_url = post_send_file + "?delete_" + page_title + "_id=" + delete_content_id;
				jQuery.ajax({
					url: post_url, success: function (result) {
						jQuery('#deletemodal .modal-content').animate({ scrollTop: 0 }, 500);
						result = result.trim();
						var intRegex = /^\d+$/;
						if (intRegex.test(result) == true) {
							if (page_title == "quotation" || page_title == "estimate" || page_title == "invoice") {
								jQuery('#deletemodal .modal-body').append('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> Successfully Cancel the ' + page_title.replaceAll("_", " ") + ' </div>');
							} else if (page_title == 'unit') {
								jQuery('#deletemodal .modal-body').append('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> Successfully Delete the LR Product </div>');
							}
							else {
								jQuery('#deletemodal .modal-body').append('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> Successfully Delete the ' + page_title.replaceAll("_", " ") + ' </div>');
							}
							setTimeout(function () {
								jQuery('#deletemodal .modal-header .close').trigger("click");
								window.location.reload();
							}, 1000);

						}
						else {
							jQuery('#deletemodal .modal-body').append('<span class="infos w-100 text-center" style="font-size: 15px; font-weight: bold;">' + result + '</span>');
						}
					}
				});
				// }
				// else {
				// 	RemarksModalContent(delete_content_id, '')
				// }

			}
			else {
				window.location.reload();
			}
		}
	});
}
function cancel_delete_modal(obj) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				jQuery('#deletemodal .modal-header .close').trigger("click");
			}
			else {
				window.location.reload();
			}
		}
	});
}
function addUnitDetails() {
	var check_login_session = 1; var all_errors_check = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}
				var unit_name = "";
				var format = /[`!#$%^*()_+\-=\[\]{};:\\|,<>\/?~]/;
				var party_format = /^[0-9 ]+$/;
				if (jQuery('input[name="unit_name"]').is(":visible")) {
					if (jQuery('input[name="unit_name"]').length > 0) {
						unit_name = jQuery('input[name="unit_name"]').val();
						if (typeof unit_name == "undefined" || unit_name == "" || unit_name == 0) {
							all_errors_check = 0;
						}
						else {
							if (party_format.test(unit_name) == true || format.test(unit_name) == true) {
								// jQuery('input[name="unit_name"]').parent().parent().append('<span class="infos">Invalid Name</span>');
								all_errors_check = 0;
							}
						}
					}
				}
				if (all_errors_check == 1) {
					var add = 1;
					if (unit_name != "") {
						if (jQuery('input[name="unit_names[]"]').length > 0) {
							jQuery('.added_unit_table tbody').find('tr').each(function () {
								var prev_unit_name = jQuery(this).find('input[name="unit_names[]"]').val().toLowerCase();
								var lower_unit_name = unit_name.toLowerCase();

								if (prev_unit_name == lower_unit_name) {
									add = 0;
								}
							});
						}
					}

					if (add == 1) {
						var unit_count = jQuery('input[name="unit_count"]').val();
						unit_count = parseInt(unit_count) + 1;
						jQuery('input[name="unit_count"]').val(unit_count);
						var post_url = "unit_changes.php?unit_row_index=" + unit_count + "&selected_unit_name=" + unit_name;
						jQuery.ajax({
							url: post_url, success: function (result) {
								if (jQuery('.added_unit_table tbody').find('tr').length > 0) {
									jQuery('.added_unit_table tbody').find('tr:first').before(result);
								}
								else {
									jQuery('.added_unit_table tbody').append(result);
								}

								if (jQuery('input[name="unit_name"]').length > 0) {
									jQuery('input[name="unit_name"]').val('');
								}

							}
						});
					}
					else {
						jQuery('.added_unit_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Unit Name already Exists</span>');

						if (jQuery('.add_details_buttton').length > 0) {
							jQuery('.add_details_buttton').attr('disabled', false);
						}
					}
				}
				else {
					jQuery('.added_unit_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please check all field values</span>');
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
function showPaymentStatus() {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				jQuery('#PaymentStatusModal .modal-body').html('');
				var post_url = "lr_changes.php?payment_status=1";
				jQuery.ajax({
					url: post_url, success: function (result) {
						jQuery('#PaymentStatusModal .modal-body').html(result);
						jQuery('.paymentstatus_modal_button').trigger("click");
					}
				});
			}
			else {
				window.location.reload();
			}
		}
	});

}
function CustomCheckboxToggle(obj, toggle_id) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var toggle_value = 2;
				if (jQuery('#' + toggle_id).length > 0) {
					if (jQuery('#' + toggle_id).prop('checked') == true) {
						toggle_value = 1;
					}
					jQuery('#' + toggle_id).val(toggle_value);
				}
				if (jQuery('.staff_access_table').length > 0) {
					toggle_id = toggle_id.replace('view', '');
					toggle_id = toggle_id.replace('add', '');
					toggle_id = toggle_id.replace('edit', '');
					toggle_id = toggle_id.replace('delete', '');
					toggle_id = jQuery.trim(toggle_id);
					var checkbox_cover = toggle_id + "cover";
					//console.log('checkbox_cover - '+checkbox_cover+', checbox count - '+jQuery('#'+checkbox_cover).find('input[type="checkbox"]').length);
					if (jQuery('#' + checkbox_cover).find('input[type="checkbox"]').length > 0) {
						var view_checkbox = toggle_id + "view"; var add_checkbox = toggle_id + "add"; var edit_checkbox = toggle_id + "edit";
						var delete_checkbox = toggle_id + "delete"; var select_count = 0; var select_all_checkbox = toggle_id + "select_all";
						//console.log('add_checkbox - '+add_checkbox+', edit_checkbox - '+edit_checkbox+', delete_checkbox - '+delete_checkbox+', select_all_checkbox - '+select_all_checkbox);
						var view_count = 0;
						if (jQuery('#' + view_checkbox).prop('checked') == true) {
							select_count = parseInt(select_count) + 1;
							view_count = parseInt(view_count) + 1;
						}
						if (jQuery('#' + add_checkbox).prop('checked') == true) {
							select_count = parseInt(select_count) + 1;
							view_count = parseInt(view_count) + 1;
						}
						if (jQuery('#' + edit_checkbox).prop('checked') == true) {
							select_count = parseInt(select_count) + 1;
							view_count = parseInt(view_count) + 1;
						}
						if (jQuery('#' + delete_checkbox).prop('checked') == true) {
							select_count = parseInt(select_count) + 1;
							view_count = parseInt(view_count) + 1;
						}
						if (parseInt(select_count) == 4) {
							jQuery('#' + select_all_checkbox).prop('checked', true);
						}
						else {
							jQuery('#' + select_all_checkbox).prop('checked', false);
						}
						if (parseInt(view_count) > 0) {
							jQuery('#' + view_checkbox).prop('checked', true);
							jQuery('#' + view_checkbox).val('1');
						}
						else {
							jQuery('#' + view_checkbox).prop('checked', false);
							jQuery('#' + view_checkbox).val('2');
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
function CustomCheckboxLRToggle(obj, toggle_id) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var toggle_value = 2;
				if (jQuery('#' + toggle_id).length > 0) {
					if (jQuery('#' + toggle_id).prop('checked') == true) {
						toggle_value = 1;
					}
					jQuery('#' + toggle_id).val(toggle_value);
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}
function SelectAllModuleLRActionToggle(obj, toggle_id) {

	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var toggle_value = 2;
				if (jQuery('#' + toggle_id).length > 0) {
					if (jQuery('#' + toggle_id).prop('checked') == true) {
						toggle_value = 1;
					}
					jQuery('#' + toggle_id).val(toggle_value);
				}
				if (parseInt(toggle_value) == 1) {
					if (jQuery('#' + toggle_id).parent().parent().parent().parent().find('input[type="checkbox"]').length > 0) {
						jQuery('#' + toggle_id).parent().parent().parent().parent().find('input[type="checkbox"]').each(function () {
							jQuery(this).prop('checked', true);
							jQuery(this).val('1');
						});
					}
				}
				else {
					if (jQuery('#' + toggle_id).parent().parent().parent().parent().find('input[type="checkbox"]').length > 0) {
						jQuery('#' + toggle_id).parent().parent().parent().parent().find('input[type="checkbox"]').each(function () {
							jQuery(this).prop('checked', false);
							jQuery(this).val('2');
						});
					}
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}
function DeleteUnitRow(row_index) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('#unit_row' + row_index).length > 0) {
					jQuery('#unit_row' + row_index).remove();
				}
				// if(jQuery('input[name="unit_count"]').length > 0)
				// {
				// 	var unit_count = jQuery('input[name="unit_count"]').val();
				// 	unit_count = parseInt(unit_count) - 1;
				// 	jQuery('input[name="unit_count"]').val(unit_count);	
				// }
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
}

function InputBoxColor(obj, type) {
	if (type == 'select') {
		jQuery(obj).parent().find('.select2-selection--single').css('border', '1px solid #ccc');
	}
	else {
		jQuery(obj).css('border', '1px solid #ccc');
	}
}

function MobileNoControl(obj) {
	var input = jQuery(obj);
	input.on("input", function (event) {
		var str_len = input.val().length;
		if (str_len > 10) {
			input.val(input.val().substring(0, 10));
		}
	});
}

function PincodeControl(obj) {
	var input = jQuery(obj);
	input.on("input", function (event) {
		var str_len = input.val().length;
		if (str_len > 6) {
			input.val(input.val().substring(0, 6));
		}
	});
}

function SpaceControl(obj) {
	var input = jQuery(obj);
	input.on('keypress', function (event) {
		if (event.keyCode === 32) {
			event.preventDefault();
		}
	});
}

function LRprefix(obj) {
	var input = jQuery(obj);
	input.on("input", function (event) {
		var str_len = input.val().length;
		if (str_len > 3) {
			input.val(input.val().substring(0, 3));
		}
	});
}

function ToUpper(obj) {
	var input = jQuery(obj);
	input.val(input.val().toUpperCase());
}

function getOtherCity() {
	// if(jQuery('select[name="city"]').length > 0)
	// {	
	console.log(jQuery('select[name="city"]').val() + "heli");
	city = jQuery('select[name="city"]').val();

	if (city == 'Others') {
		var post_url = "dashboard_changes.php?check_login_session=1";
		jQuery.ajax({
			url: post_url, success: function (check_login_session) {
				if (check_login_session == 1) {
					var post_url = "lr_changes.php?others_city=1";
					jQuery.ajax({
						url: post_url, success: function (result) {
							if (jQuery('#others_city').length > 0) {
								jQuery('#others_city').html(result);
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
	else {
		if (jQuery('#others_city').length > 0) {
			jQuery('#others_city').html('');
		}
	}
	// }
}

function assign_bill_value() {
	if (jQuery("#show_bill").val() == "0") {
		jQuery("#show_bill").val("1");
		jQuery("#show_button").html("Show Active Bill");
		table_listing_records_filter();
	}
	else {
		jQuery("#show_bill").val("0");
		jQuery("#show_button").html("Show Inactive Bill")
		table_listing_records_filter();
	}
}

function CustomPartyModal(obj) {
	var form_name = jQuery(obj).closest('form').attr('name');

	if (jQuery("input[type='checkbox']").length > 0) {
		if (jQuery("input[type='checkbox']").prop('checked', false)) {
			if (jQuery("textarea[name='delivery_address']").length > 0) {
				jQuery("textarea[name='delivery_address']").val('');
			}
		} else {
			assign_address();
		}
	}

	if (jQuery('.custom_party_modal_button').length > 0) {
		var post_url = "purchase_party_changes.php?show_purchase_party_id=&add_custom_party=1" + "&form_name=" + form_name;
		jQuery.ajax({
			url: post_url, success: function (result) {
				result = result.trim();
				if (result != "" && typeof result != "undefined" && result != null) {
					if (jQuery('#CustomPartyModal').find('.modal-body').length > 0) {
						jQuery('#CustomPartyModal').find('.modal-body').html(result);
					}
				}
				// jQuery('.custom_party_modal_button').trigger("click");
				var modal = new bootstrap.Modal(document.getElementById('CustomPartyModal'));
				modal.show();
			}
		});
	}

}


function ChangePartyIDs(form_name) {

	var post_url = "bill_changes.php?change_party=1" + "&form_name=" + form_name;

	jQuery.ajax({
		url: post_url, success: function (result) {
			result = result.trim();

			// alert(result);
			if (jQuery('select[name="party_id"]').length > 0) {
				jQuery('select[name="party_id"]').html(result);
			}
			if (jQuery('select[name="party_id"]').length > 0) {
				jQuery('select[name="party_id"]').select2('open');
			}

		}
	});
}


function CustomProductModal() {
	if (jQuery('.custom_product_modal_button').length > 0) {
		var post_url = "product_changes.php?show_product_id=&add_custom_product=1";
		jQuery.ajax({
			url: post_url, success: function (result) {
				result = result.trim();
				if (result != "" && typeof result != "undefined" && result != null) {
					if (jQuery('#CustomProductModal').find('.modal-body').length > 0) {
						jQuery('#CustomProductModal').find('.modal-body').html(result);
					}
				}
				// jQuery('.custom_product_modal_button').trigger("click");
				var modal = new bootstrap.Modal(document.getElementById('CustomProductModal'));
				modal.show();
			}
		});
	}

}

function ChangeProductIDs() {
	var post_url = "bill_changes.php?change_product=1";
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = result.trim();
			if (jQuery('select[name="selected_product_id"]').length > 0) {
				jQuery('select[name="selected_product_id"]').html(result);
			}
			if (jQuery('select[name="selected_product_id"]').length > 0) {
				jQuery('select[name="selected_product_id"]').val('').trigger('change');
			}
		}
	});
}

function SelectedPartyList() {

	if (jQuery('#lr_amount_display').length > 0) {
		jQuery('#lr_amount_display').html('');
	}
	var selected_party_type = "";
	if (jQuery('select[name="selected_party_type"]').length > 0) {
		selected_party_type = jQuery('select[name="selected_party_type"]').val();
	}
	var post_url = "bill_changes.php?selected_party_type=" + selected_party_type;
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = result.trim();
			if (jQuery('select[name="party_id"]').length > 0) {
				jQuery('select[name="party_id"]').html(result);
			}
			HideDetails(selected_party_type)
		}
	});

}


function CancelLRPrint(obj) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('.add_update_form_content').length > 0) {
					jQuery('.add_update_form_content').html("");
				}
				if (jQuery('#table_records_cover').hasClass('d-none')) {
					jQuery('#table_records_cover').removeClass('d-none');
				}
				// table_listing_records_filter();
				jQuery('#LRPrintModal .modal-header .close').trigger("click");
				window.location.reload();
			}
			else {
				window.location.reload();
			}
		}
	});
}

function ConfirmLRPrint(obj) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				var lr_id = jQuery(obj).attr('id');
				if (typeof lr_id != "undefined" && lr_id != null && lr_id != "") {
					if (jQuery('.add_update_form_content').length > 0) {
						jQuery('.add_update_form_content').html("");
					}
					if (jQuery('#table_records_cover').hasClass('d-none')) {
						jQuery('#table_records_cover').removeClass('d-none');
					}
					// table_listing_records_filter();
					window.open("reports/rpt_receipt.php?view_lr_id=" + lr_id + "&rpt_type=all");
					window.location.reload();
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}
function checkDateCheck() {
	var from_date = ""; var to_date = "";
	if (jQuery('.infos').length > 0) {
		jQuery('.infos').each(function () { jQuery(this).remove(); });
	}
	if (jQuery('input[name="from_date"]').length > 0) {
		from_date = jQuery('input[name="from_date"]').val();
	}
	if (jQuery('input[name="to_date"]').length > 0) {
		to_date = jQuery('input[name="to_date"]').val();
	}
	if (to_date != "") {
		if (from_date > to_date) {
			jQuery('input[name="to_date"]').after('<span class="infos">To date Must be greater than the date ' + from_date + '</span>');
			if (jQuery('input[name="to_date"]').length > 0) {
				jQuery('input[name="to_date"]').val("");
			}
		}
	}
}