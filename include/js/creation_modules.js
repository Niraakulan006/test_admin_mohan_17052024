var number_regex = /^\d+$/;
var price_regex = /^(\d*\.)?\d+$/;
var percentage_regex = /^(?:\d{1,2}(?:\.\d{1,2})?)%?$/;
var letter_regex = /^[a-zA-Z\s ]+$/;


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
function SnoCalculation(){
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

function addCreationDetails(name, characters) {
	var check_login_session = 1; var all_errors_check = 1; var error = 1; var letters_check = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}
				var creation_name = "";
				var format = letter_regex;
				var name_variable = "";
				name_variable = name.toLowerCase();
				name_variable = name_variable.trim();
				name_variable = name_variable.replace("_"," ");

				if (jQuery('input[name="'+name+'_name"]').is(":visible")) {
					if (jQuery('input[name="'+name+'_name"]').length > 0) {
						creation_name = jQuery('input[name="'+name+'_name"]').val();
						creation_name = creation_name.trim();
						if (typeof creation_name == "undefined" || creation_name == "" || creation_name == 0 || creation_name == null) {
							all_errors_check = 0;
						}
						// else if(format.test(creation_name) == false) {
						// 	letters_check = 0;
						// }
						else if(creation_name.length > parseInt(characters)) {
							error = 0;
						}else{
							 creation_name = creation_name.replace("&","$");
                            creation_name = creation_name.replace('"','^');
                            creation_name = creation_name.replace("'",'@@');
                            creation_name = creation_name.replace("+",'**');
                            creation_name = creation_name.replace("#",'!!');
						}
					}
				}
				if(parseInt(all_errors_check) == 1) {
					if(parseInt(letters_check) == 1) {
						if(parseInt(error) == 1) {
							var add = 1;
							if (creation_name != "") {
								if (jQuery('input[name="'+name+'_names[]"]').length > 0) {
									jQuery('.added_'+name+'_table tbody').find('tr').each(function () {
										var prev_creation_name = jQuery(this).find('input[name="'+name+'_names[]"]').val().toLowerCase();
										var current_creation_name = creation_name.toLowerCase();
										if (prev_creation_name == current_creation_name) {
											add = 0;
										}
									});
								}
							}
							if (add == 1) {
								var count = jQuery('input[name="'+name+'_count"]').val();
								count = parseInt(count) + 1;
								jQuery('input[name="'+name+'_count"]').val(count);
								var post_url = name+"_changes.php?"+name+"_row_index="+count+"&selected_"+name+"_name="+creation_name;
								jQuery.ajax({
									url: post_url, success: function (result) {
										if (jQuery('.added_'+name+'_table tbody').find('tr').length > 0) {
											jQuery('.added_'+name+'_table tbody').find('tr:first').before(result);
										}
										else {
											jQuery('.added_'+name+'_table tbody').append(result);
										}
										if (jQuery('input[name="'+name+'_name"]').length > 0) {
											jQuery('input[name="'+name+'_name"]').val('').focus();
										}
										SnoCalculation();
									}
								});
							}
							else {
								jQuery('.added_'+name+'_table').before('<div class="infos w-100 text-danger text-center mb-3" style="font-size: 15px;">This '+name_variable+' already Exists</div>');
							}
						}
						else {
							jQuery('.added_'+name+'_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;">Only '+characters+' Characters allowed</div>');
						}
					}
					else {
						jQuery('.added_'+name+'_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;color:red;">Invalid Characters</div>');
						jQuery('input[name="'+name+'_name"]').val('');
					}
				}
				else {
					jQuery('.added_'+name+'_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;">Please check all field values</div>');
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}


function DeleteCreationRow(id_name, row_index) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('#'+id_name+'_row'+row_index).length > 0) {
					jQuery('#'+id_name+'_row'+row_index).remove();
				}
				SnoCalculation();
			}
			else {
				window.location.reload();
			}
		}
	});
}

function GetBranch(role_id) {
	var post_url = "user_changes.php?selected_role="+role_id;
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = result.trim();
			if(result == 'yes') {
				if(jQuery('#branch_div').length > 0) {
					jQuery('#branch_div').removeClass('d-none');
				}
			}
			else {
				if(jQuery('#branch_div').length > 0) {
					jQuery('#branch_div').addClass('d-none');
				}
			}
			if(jQuery('select[name="branch_id[]"]').length > 0) {
				jQuery('select[name="branch_id[]"]').val('');
			}
		}
	});
}

function ChangeAccessList() {
	var is_branch_staff = "";
	if(jQuery('#yes_branch_staff').length > 0) {
		if (jQuery('#yes_branch_staff').prop('checked') == true) {
			is_branch_staff = 1;
		}
	}
	if(jQuery('#no_branch_staff').length > 0) {
		if (jQuery('#no_branch_staff').prop('checked') == true) {
			is_branch_staff = 0;
		}
	}
	var post_url = "role_changes.php?change_access_list="+is_branch_staff;
	jQuery.ajax({
		url: post_url, success: function (result) {
			if (jQuery('.staff_access_table').find('tbody').length > 0) {
				jQuery('.staff_access_table').find('tbody').html(result);
			}
		}
	});
}