<?php
	
	class validation {	

		public function clean_value($field_value) {
			if(!empty($field_value)) {
				//$field_value = strip_tags($field_value);
				$field_value = trim($field_value);
			}
			return $field_value;
		}

		public function common_validation($field_value, $field_name, $field_type) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				if(preg_match("/^[\>\<]+$/", $field_value)) {
					$result = "(> <) not allowed";
				}
			}
			else {
				if($field_type == "select") {
					$result = "Select the ".$field_name;
				}
				else {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}
		public function valid_name($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(!preg_match("/^(?!\d+$)[a-zA-Z\d][a-zA-Z'\"\s].+$/", $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		public function valid_mobile_number($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				if($field_value >0)
				{
					$result = $this->common_validation($field_value, $field_name, '');
					if(empty($result)) {
						if(!preg_match('/^[0-9]{10}$/', $field_value) && !preg_match('/^[0-9]{5}(\s)[0-9]{5}$/', $field_value)) {
							$result = "Invalid ".$field_name;
						}
					}
				}
				else
				{
					
					$result = "Invalid ".$field_name;
				}
				
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		public function valid_pincode($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(!preg_match('/^[0-9]{6}$/', $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		public function valid_email($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(!preg_match('/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/', $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		public function valid_username($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(!empty($result)) {
					if(!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/", $field_value) && !preg_match("/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/", $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}
		
		public function PasswordRequirements($post_name) {
			$count = 0; $result = 0; $success = 0;
			if(preg_match("/\d/", $post_name)) {
				$count++;
			}
			if(preg_match("/[A-Z]/", $post_name)) {
				$count++;
			}
			if(preg_match("/[a-z]/", $post_name)) {
				$count++;
			}
			// This is where I need help
			if(preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $post_name)) {
				$count++;
			}
			if($count == 4) {
				$success = 1;
			}
			return $success;
		}

		public function valid_password($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(strlen($field_value) < 8) {
						$result = $field_name." must be min.8 characters";
					}
					else {
						$result = $this->PasswordRequirements($field_value);
						if($result != 1) {
							$result = "Invalid ".$field_name;
						}
						else { $result = ""; }
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		public function valid_gst_number($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				// $result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(!preg_match("/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/", $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		public function valid_text($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(!preg_match("/^[a-zA-Z\s]+$/", $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		public function valid_lr_prefix($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(!preg_match("/^[a-zA-Z]{1,3}+$/", $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}


		public function valid_number($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(!preg_match("/^[0-9]*$/", $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		public function valid_text_number($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(!preg_match("/^[a-zA-Z0-9 ]+$/", $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		public function valid_price($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(!preg_match("/^[0-9]+(\\.[0-9]+)?$/", $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		public function valid_percentage($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					$field_value = str_replace("%", "", $field_value);
					if(!preg_match("/^[0-9]+(\\.[0-9]+)?$/", $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}
		
		public function valid_name_text($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(!preg_match("/^[a-zA-Z][a-z A-Z\s\&\.]+$/", $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}
		
		public function valid_product_name($field_value, $field_name, $required, $characters) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				if (!preg_match("/^(?=.*[a-zA-Z])[^?!<>$+=`~_|?;^{}]*$/", $field_value)) {
					$result = "Invalid " . $field_name;
				}
                else if(!empty($characters) && preg_match("/^[0-9]*$/", $characters) && strlen($field_value) > $characters) {
                    $result = "Only ".$characters." characters are allowed for ".$field_name;
                }
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		public function valid_hsn($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(!preg_match("/^[0-9]{4,8}$/", $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		    
		public function valid_company_name($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(!preg_match("/^(?=.*[a-zA-Z])[a-zA-Z\s &-.']+$/", $field_value)) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}


		public function valid_date($field_value, $field_name, $required) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				$result = $this->common_validation($field_value, $field_name, '');
				if(empty($result)) {
					if(date('d-m-Y', strtotime($field_value)) != $field_value) {
						$result = "Invalid ".$field_name;
					}
				}
			}
			else {
				if($required == 1) {
					$result = "Select the ".$field_name;
				}
			}
			return $result;
		}
		

		public function valid_address($field_value, $field_name, $required, $characters) {
			$result = "";
			$field_value = trim($field_value);
			if(!empty($field_value)) {
				if(preg_match("/[?!<>$+=`~|?;^*{}]/", $field_value)) {
					$result = "Invalid ".$field_name;
				}
                else if(!empty($characters) && preg_match("/^[0-9]*$/", $characters) && strlen($field_value) > $characters) {
                    $result = "Only ".$characters." characters are allowed for ".$field_name;
                }
			}
			else {
				if($required == 1) {
					$result = "Enter the ".$field_name;
				}
			}
			return $result;
		}

		public function error_display($form_name, $field, $error, $type) {
			$result = "";
			if(!empty($error)) {
				if($type == "text") {
					$result = "if(jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().parent().find('span.infos').length == 0) {
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().after('<span class=".'"infos"'."> <i class=".'"fa fa-exclamation-circle"'."></i>".$error."</span>');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').css('border','1px solid red');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').focus();
								}";
				}
				if($type == "radio") {
					$result = "if(jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().parent().parent().find('span.infos').length == 0) {
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().parent().after('<span class=".'"infos w-100"'."> <i class=".'"fa fa-exclamation-circle"'."></i>".$error."</span>');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').css('border','1px solid red');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').focus();
								}";
				}
				if($type == "textarea") {
					$result = "if(jQuery('form[name=".'"'.$form_name.'"'."] textarea[name=".'"'.$field.'"'."]').parent().parent().find('span.infos').length == 0) {
									jQuery('form[name=".'"'.$form_name.'"'."] textarea[name=".'"'.$field.'"'."]').parent().after('<span class=".'"infos"'."> <i class=".'"fa fa-exclamation-circle"'."></i>".$error."</span>');
									jQuery('form[name=".'"'.$form_name.'"'."] textarea[name=".'"'.$field.'"'."]').css('border','1px solid red');
									jQuery('form[name=".'"'.$form_name.'"'."] textarea[name=".'"'.$field.'"'."]').focus();
								}";
				}
				if($type == "input_group") {
					if($field == "pincode") {
						$result = "if(jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().parent().parent().find('span.infos').length == 0) {
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().parent().parent().after('<span class=".'"infos"'."> <i class=".'"fa fa-exclamation-circle"'."></i>".$error."</span>');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').css('border','1px solid red');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').focus();
								}
								else {
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().parent().parent().after('<span class=".'"infos"'."> <i class=".'"fa fa-exclamation-circle"'."></i>".$error."</span>');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').css('border','1px solid red');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').focus();
								}";
					}
					else {
						$result = "if(jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().parent().parent().find('span.infos').length == 0) {
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().parent().after('<span class=".'"infos"'."> <i class=".'"fa fa-exclamation-circle"'."></i>".$error."</span>');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').css('border','1px solid red');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').focus();
								}";
					}			
				}
				if($type == "input_group_array") {
					$result = "if(jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().parent().parent().find('span.infos').length == 0) {
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().parent().parent().append('<span class=".'"infos"'."> <i class=".'"fa fa-exclamation-circle"'."></i>".$error."</span>');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').css('border','1px solid red');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').focus();
								}";
				}
				if($type == "select") {
					$result = "if(jQuery('form[name=".'"'.$form_name.'"'."] select[name=".'"'.$field.'"'."]').parent().parent().find('span.infos').length == 0) {
									jQuery('form[name=".'"'.$form_name.'"'."] select[name=".'"'.$field.'"'."]').parent().parent().append('<span class=".'"infos"'."> <i class=".'"fa fa-exclamation-circle"'."></i>".$error."</span>');
									jQuery('form[name=".'"'.$form_name.'"'."] select[name=".'"'.$field.'"'."]').parent().find('.select2-selection--single').css('border','1px solid red');
									jQuery('form[name=".'"'.$form_name.'"'."] select[name=".'"'.$field.'"'."]').focus();
								}";
				}
				if($type == "custom_radio") {
					$result = "if(jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().parent().parent().parent().parent().find('span.infos').length == 0) {
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').parent().parent().parent().parent().after('<span class=".'"infos"'."> <i class=".'"fa fa-exclamation-circle"'."></i>".$error."</span>');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').css('border','1px solid red');
									jQuery('form[name=".'"'.$form_name.'"'."] input[name=".'"'.$field.'"'."]').focus();
								}";
				}
				if($type == "upload_modal_button") {
					$result = "if(jQuery('form[name=".'"'.$form_name.'"'."] button[name=".'"'.$field.'"'."]').parent().parent().find('span.infos').length == 0) {
									jQuery('form[name=".'"'.$form_name.'"'."] button[name=".'"'.$field.'"'."]').parent().after('<span class=".'"w-100 infos"'."> <i class=".'"fa fa-exclamation-circle"'."></i>".$error."</span>');
									jQuery('form[name=".'"'.$form_name.'"'."] button[name=".'"'.$field.'"'."]').css('border','1px solid red');
									jQuery('form[name=".'"'.$form_name.'"'."] button[name=".'"'.$field.'"'."]').focus();
								}";
				}
				if($type == "on_off_checkbox") {
					$result = "if(jQuery('form[name=".'"'.$form_name.'"'."] checkbox[name=".'"'.$field.'"'."]').parent().parent().parent().find('span.infos').length == 0) {
									jQuery('form[name=".'"'.$form_name.'"'."] checkbox[name=".'"'.$field.'"'."]').parent().parent().after('<span class=".'"infos"'."> <i class=".'"fa fa-exclamation-circle"'."></i>".$error."</span>');
									jQuery('form[name=".'"'.$form_name.'"'."] checkbox[name=".'"'.$field.'"'."]').css('border','1px solid red');
									jQuery('form[name=".'"'.$form_name.'"'."] checkbox[name=".'"'.$field.'"'."]').focus();
								}";
				}
			}
			
			return $result;
		}

		public function row_error_display($form_name, $field, $error, $type, $row_name, $row_no) {
			$result = ""; $sno_element = ""; $extra_parent = ""; $closest_parent = "";
			
			if($field == "expense_name[]" || $field == "expense_value[]") {
				$extra_parent = "parent().";
				$closest_parent = "parent().";
			}
			if(!empty($error) && !empty($row_no)) {
				if($row_name == "company_expense_row") {
					$sno_element = "var snoElement = jQuery(\"form[name='".$form_name."'] tr.".$row_name." .company_sno\").filter(function() {
						return jQuery(this).text().trim() == ".$row_no.";
					});";
				}
				else {
					$sno_element = "var snoElement = jQuery(\"form[name='".$form_name."'] tr.".$row_name." .sno\").filter(function() {
						return jQuery(this).text().trim() == ".$row_no.";
					});";
				}
				
				if ($type == "text") {
					$result = $sno_element."
						if(snoElement.parent().".$closest_parent."find(\"input[name='".$field."']\").parent().find('span.infos').length == 0) {
							snoElement.parent().".$closest_parent."find(\"input[name='".$field."']\").".$extra_parent."after('<span class=\"infos w-100\"> <i class=\"fa fa-exclamation-circle\"></i> ".$error."</span>');
							snoElement.parent().".$closest_parent."find(\"input[name='".$field."']\").focus();
						}";
				}
				
				if($type == "textarea") {
					$result = $sno_element."
						if(snoElement.parent().find(\"textarea[name='".$field."']\").parent().find('span.infos').length == 0) {
							snoElement.parent().find(\"textarea[name='".$field."']\").after('<span class=\"infos w-100\"> <i class=\"fa fa-exclamation-circle\"></i> ".$error."</span>');
							snoElement.parent().find(\"textarea[name='".$field."']\").focus();
						}";
				}
				if($type == "select") {
					$result = $sno_element."
						if(snoElement.parent().find(\"select[name='".$field."']\").parent().find('span.infos').length == 0) {
							snoElement.parent().find(\"select[name='".$field."']\").parent().after('<span class=\"infos w-100\"> <i class=\"fa fa-exclamation-circle\"></i> ".$error."</span>');
							snoElement.parent().find(\"select[name='".$field."']\").focus();
						}";
				}
			}
			return $result;
		}
		
	}

?>
