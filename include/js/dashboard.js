function UpdateBillCompany() {	
	if(jQuery('form[name="bill_company_form"]').find('.alert').length > 0) {
		jQuery('form[name="bill_company_form"]').find('.alert').remove();
	}
	var bill_company_id = "";
	if(jQuery('select[name="bill_company_id"]').length > 0) {
		bill_company_id = jQuery('select[name="bill_company_id"]').val();
	}
	var msg = "";
	if(typeof bill_company_id != "undefined" && bill_company_id != "") {
		jQuery.ajax({type : 'POST', url: 'dashboard_changes.php', data : jQuery('form[name="bill_company_form"]').serialize(), success: function(result) {
			var intRegex = /^\d+$/;
			if(intRegex.test(result) == true) {
				msg = '<div class="alert alert-primary">Successfully change the company <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				jQuery('form[name="bill_company_form"]').find('.row').before(msg);
				setTimeout(function() {
					window.location.reload();
				  }, 1500);		
			}
			else {
				msg = '<div class="alert alert-warning">'+result+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				jQuery('form[name="bill_company_form"]').find('.row').before(msg);
			}
		}});
	}
	else {
		msg = '<div class="alert alert-warning">Select the bill company <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		jQuery('form[name="bill_company_form"]').find('.row').before(msg);
	}
}

function confirm_bill_number_option() {
	var bill_number_option = "";
	if(jQuery('input[name="bill_number_option"]').is(":checked")) {
		bill_number_option = jQuery("input[name='bill_number_option']:checked").val();
	}
	if(bill_number_option != '') {
		if(jQuery('.alert').length > 0) {
			jQuery('.alert').remove();
		}
		var post_url = "dashboard_changes.php?bill_number_option="+bill_number_option;
		jQuery.ajax({url: post_url, success: function(result){
			var intRegex = /^\d+$/;	var msg = "";
			if(intRegex.test(result) == true) {
				window.location.reload();
			}
			else {
				if(jQuery('.alert').length > 0) {
					jQuery('.alert').remove();
				}
				if(jQuery('.alert').length == 0) {
					var msg = '<div class="alert alert-warning">'+result+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
					jQuery('.bill_number_list').before(msg);
				}
			}
		}});
	}
	else {
		if(jQuery('.alert').length == 0) {
			var msg = '<div class="alert alert-warning">Select the bill number option<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			jQuery('.bill_number_list').before(msg);
		}
	}
}

function cancel_bill_number_option() {
	jQuery('#myModal .modal-header .btn').trigger("click");
}