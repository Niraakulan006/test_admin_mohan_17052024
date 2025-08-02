var number_regex = /^\d+$/;
var price_regex = /^(\d*\.)?\d+$/;
var percentage_regex = /^(?:\d{1,2}(?:\.\d{1,2})?)%?$/;

function KeyboardControls(obj,type,characters,color){
    var input = jQuery(obj);
    // Use onkeydown
    if(type == "text"){
        input.on('keypress', function(event) {
            // Get the keycode of the pressed key
            var keyCode = event.keyCode || event.which;
					
            // Allow: backspace, delete, tab, escape, enter, and arrow keys
            if ([8, 46, 9, 27, 13, 37, 38, 39, 40].indexOf(keyCode) !== -1 ||
                // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (keyCode === 65 && (event.ctrlKey || event.metaKey)) || 
                (keyCode === 67 && (event.ctrlKey || event.metaKey)) || 
                (keyCode === 86 && (event.ctrlKey || event.metaKey)) || 
                (keyCode === 88 && (event.ctrlKey || event.metaKey)) ||
                // Allow: home, end, page up, page down
                (keyCode >= 35 && keyCode <= 40)) {
                // Let it happen, don't do anything
                return;
            }
            
            // Block numeric key codes (0-9 on main keyboard and numpad)
            if ((keyCode >= 48 && keyCode <= 57)) {
                event.preventDefault();
            }
        });
    }
    // Use onfocus
    if(type == "mobile_number"){
        input.on('keypress', function(event) {
            var keyCode = event.keyCode || event.which;
        
            // Allow: backspace, delete, tab, escape, enter, period, arrow keys
            if ([8, 46, 9, 27, 13, 190].indexOf(keyCode) !== -1 ||
                // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (keyCode === 65 && (event.ctrlKey || event.metaKey)) || 
                (keyCode === 67 && (event.ctrlKey || event.metaKey)) || 
                (keyCode === 86 && (event.ctrlKey || event.metaKey)) || 
                (keyCode === 88 && (event.ctrlKey || event.metaKey)) ||
                // Allow: arrow keys
                (keyCode >= 37 && keyCode <= 40)) {
                // Let it happen, don't do anything
                return;
            }
        
            // Ensure that it is a number and stop the keypress if not
            if ((keyCode < 48 || keyCode > 57)) {
                event.preventDefault();
            }
        });
        
        input.on("input", function(event){
            var str_len = input.val().length;
            if(str_len > 10) {
                input.val(input.val().substring(0, 10));
            }
        });
        input.on('keypress', function (event) {
            if (event.keyCode === 32) {
                event.preventDefault();
            }
        });
    }
	// Use onfocus
    if(type == "email" || type == "password"){
        input.on('keypress', function (event) {
            if (event.keyCode === 32) {
                event.preventDefault();
            }
        });
    }
    // Use onfocus
    if(type == "number"){
        input.on('keypress', function(event) {
            var keyCode = event.keyCode || event.which;
        
            // Allow: backspace, delete, tab, escape, enter, period, arrow keys
            if ([8, 46, 9, 27, 13, 190].indexOf(keyCode) !== -1 ||
                // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (keyCode === 65 && (event.ctrlKey || event.metaKey)) || 
                (keyCode === 67 && (event.ctrlKey || event.metaKey)) || 
                (keyCode === 86 && (event.ctrlKey || event.metaKey)) || 
                (keyCode === 88 && (event.ctrlKey || event.metaKey)) ||
                // Allow: arrow keys
                (keyCode >= 37 && keyCode <= 40)) {
                // Let it happen, don't do anything
                return;
            }
        
		
            // Ensure that it is a number and stop the keypress if not
            if ((keyCode < 48 || keyCode > 57)) {
                event.preventDefault();
            }
        });
		
        input.on('keypress', function (event) {
            if (event.keyCode === 32) {
                event.preventDefault();
            }
        });
		
    }
	 // Use onfocus
	 if(type == "no_space"){
        input.on('keypress', function (event) {
            if (event.keyCode === 32) {
                event.preventDefault();
            }
        });
    }
	
	if(number_regex.test(characters) != false){
		if(characters != "" && characters != 0){
			input.on("input", function(event){
				var str_len = input.val().length;
				if(str_len > parseFloat(characters)) {
					input.val(input.val().substring(0, parseFloat(characters)));
				}
			});
		}
	}
    if(color == '1'){
        InputBoxColor(obj,type);
    }
}
function InputBoxColor(obj,type){
    if(type == 'select'){
		if(jQuery(obj).closest().find('.select2-selection--single').length > 0){
			jQuery(obj).closest().find('.select2-selection--single').css('border','1px solid #aaa');
		}
        if(jQuery(obj).parent().find('.infos').length > 0){
            jQuery(obj).parent().find('.infos').remove();
        }
        if(jQuery(obj).parent().parent().find('.infos').length > 0){
            jQuery(obj).parent().parent().find('.infos').remove();
        }
	}
	else{
		jQuery(obj).css('border','1px solid #ced4da');
        if(jQuery(obj).parent().find('.infos').length > 0){
            jQuery(obj).parent().find('.infos').remove();
        }
        if(jQuery(obj).parent().parent().find('.infos').length > 0){
            jQuery(obj).parent().parent().find('.infos').remove();
        }
	}
}
function AddUnitPriceRow() {
    var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
                var unit_count = 0;
                if(jQuery('input[name="unit_count"]').length > 0) {
                    unit_count = jQuery('input[name="unit_count"]').val().trim();
                    unit_count = parseInt(unit_count) + 1;
                }

                var post_url = "updation_action_changes.php?unit_price_index="+unit_count;

                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (jQuery('.unit_price_table tbody').find('tr.product_row').length > 0) {
                            jQuery('.unit_price_table tbody').find('tr.product_row:last').after(result);
                        }
                        else {
                            jQuery('.unit_price_table tbody').html(result);
                        }
                        if(jQuery('input[name="unit_count"]').length > 0) {
                            jQuery('input[name="unit_count"]').val(unit_count);
                        }
                        if (jQuery('.tableheight .unit_price_table tbody tr.product_row').length > 0) {
                            var scroll_container = jQuery('.tableheight');
                            var last_row = jQuery('.tableheight .unit_price_table tbody tr.product_row:last');

                            scroll_container.stop().animate({
                                scrollTop: scroll_container.scrollTop() + last_row.position().top
                            }, 300);
                        }
                        SnoCalcPlus();
                    }
                });
			}
			else {
				window.location.reload();
			}
		}
	});
}

function DeleteUnitPriceRow(id_name, row_index) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('#'+id_name+row_index).length > 0) {
					jQuery('#'+id_name+row_index).remove();
				}
                if(jQuery('.'+id_name).length == 0 && id_name == 'product_row') {
                    if(jQuery('.unit_price_table').find('tbody').length > 0) {
                        jQuery('.unit_price_table').find('tbody').html('<tr class="no_data_row"><th colspan="4" class="text-center px-2 py-2">No Data Found!</th></tr>');
                    }
                }
                SnoCalcPlus();
			}
			else {
				window.location.reload();
			}
		}
	});
}

function SnoCalcPlus() {
    var snoElements = document.getElementsByClassName('sno');
    if (snoElements.length > 0) {
        for (var i = 0; i < snoElements.length; i++) {
            snoElements[i].innerHTML = i + 1;
        }
    }
}