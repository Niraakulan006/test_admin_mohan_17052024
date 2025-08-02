<?php
	$page_title = "index";
	include("include_files.php");
	$bill_company_id = "";$organization_records = array();
	$check_users = array(); $user_count = 0;
	$check_users = $obj->getTableRecords($GLOBALS['user_table'], '', '');
	if(!empty($check_users)) {
		$user_count = count($check_users);
	}

	// echo $obj->encode_decode('decrypt', '5457396f5957356a59584a6e62773d3d').' - ';
	// echo $obj->encode_decode('decrypt', '513246795a32397462326868626b41784d6a4d3d');

	if(isset($_POST['name'])) {	
		$name = ""; $name_error = "";  $mobile_number = ""; $mobile_number_error = ""; 	$username = ""; $username_error = "";
		$password = ""; $password_error = ""; $admin = 1; $type = $GLOBALS['admin_user_type'];

		$create_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
		$valid_user = ""; $form_name = "user_form";
	
		if(isset($_POST['name'])) {	
			$name = $_POST['name'];
			$name = $valid->clean_value($name);
			if(empty($name)) {
				$name_error = "Enter the name";
			}
			if(!empty($name_error)) {
				$valid_user = $valid->error_display($form_name, "name", $name_error, 'text');			
			}
		}

		if(isset($_POST['mobile_number'])) {	
			$mobile_number = $_POST['mobile_number'];
			$mobile_number = $valid->clean_value($mobile_number);
			$mobile_number_error = $valid->valid_mobile_number($mobile_number, "Mobile number", "1");
			if(!empty($mobile_number_error)) {
				if(!empty($valid_user)) {
					$valid_user = $valid_user." ".$valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
				}
				else {
					$valid_user = $valid->error_display($form_name, "mobile_number", $mobile_number_error, 'text');
				}
			}
		}

		if(isset($_POST['username'])) {
			$username = $_POST['username'];
			$username = $valid->clean_value($username);
			if(empty($username)) {
				$username_error = "Enter the user id";
			}
			if(!empty($username_error)) {
				if(!empty($valid_user)) {
					$valid_user = $valid_user." ".$valid->error_display($form_name, "username", $username_error, 'text');
				}
				else {
					$valid_user = $valid->error_display($form_name, "username", $username_error, 'text');
				}
			}
		}

		if(isset($_POST['password'])) {
			$password = $_POST['password'];
			$password = $valid->clean_value($password);
			$password_error = $valid->valid_password($password, "Password", "1");
			if(!empty($password_error)) {
				if(!empty($valid_user)) {
					$valid_user = $valid_user." ".$valid->error_display($form_name, "password", $password_error, 'input_group');
				}
				else {
					$valid_user = $valid->error_display($form_name, "password", $password_error, 'input_group');
				}
			}
		}
		
		if(isset($_POST['edit_id'])) {
			$edit_id = $_POST['edit_id'];
		}
		
		$result = "";
		
		if(empty($valid_user)) {
			if(!empty($name)) {
				$name_array = "";
				$name_array = explode(" ", $name);
				if(is_array($name_array)) {
					for($n = 0; $n < count($name_array); $n++) {
						if(!empty($name_array[$n])) {
							$name_array[$n] = trim($name_array[$n]);
							$name_array[$n] = strtolower($name_array[$n]);
							$name_array[$n] = ucfirst($name_array[$n]);
						}
						else {
							unset($name_array[$n]);
						}
					}
					$name = implode(" ", $name_array);
				}    
				$name = $obj->encode_decode('encrypt', $name);
			}
			if(!empty($mobile_number)) {
				$mobile_number = $obj->encode_decode('encrypt', $mobile_number);
			}
			if(!empty($username)) {
				$username = $obj->encode_decode('encrypt', $username);
			}
			if(!empty($password)) {
				$password = $obj->encode_decode('encrypt', $password);
			}
				
			if(empty($edit_id)) {
				$created_date_time = $GLOBALS['create_date_time_label'];
				$creator_name = $name;
				
				$action = "";
				if(!empty($name)) {
					$action = "New User Created. Name - ".$obj->encode_decode('decrypt', $name);
				}

				$null_value = $GLOBALS['null_value'];

				$columns = array('created_date_time', 'creator', 'creator_name', 'user_id', 'name', 'mobile_number', 'type', 'username', 'password', 'admin', 'deleted');
				$values = array("'".$created_date_time."'", "'".$null_value."'", "'".$creator_name."'", "'".$null_value."'", "'".$name."'", "'".$mobile_number."'", "'".$type."'", "'".$username."'", "'".$password."'", "'".$admin."'", "'0'");
				$user_insert_id = $obj->InsertSQL($GLOBALS['user_table'], $columns, $values, $action);						
				if(preg_match("/^\d+$/", $user_insert_id)) {
					$user_id = "";
					if($user_insert_id < 10) {
						$user_id = "USER_0".$user_insert_id;
					}
					else {
						$user_id = "USER_".$user_insert_id;
					}
					if(!empty($user_id)) {
						$user_id = $obj->encode_decode('encrypt', $user_id);
					}
					$columns = array(); $values = array();						
					$columns = array('creator', 'user_id');
					$values = array("'".$user_id."'", "'".$user_id."'");
					$user_update_id = $obj->UpdateSQL($GLOBALS['user_table'], $user_insert_id, $columns, $values, '');
					if(preg_match("/^\d+$/", $user_update_id)) {		
						$result = array('number' => '1', 'msg' => 'User Successfully Created');					
					}
					else {
						$result = array('number' => '2', 'msg' => $user_update_id);
					}
				}
				else {
					$result = array('number' => '2', 'msg' => $user_insert_id);
				}
			}
		}
		else {
			if(!empty($valid_user)) {
				$result = array('number' => '3', 'msg' => $valid_user);
			}
		}
		
		if(!empty($result)) {
			$result = json_encode($result);
		}
		echo $result; exit;
	}

	if(isset($_POST['username'])) {
		$username = ""; $username_error = ""; $password = ""; $password_error = "";	
		$valid_login = ""; $form_name = "login_form";
		$username = $_POST['username'];
		$username = $valid->clean_value($username);
		if(empty($username)) {
			$valid_login = "Enter user name";			
		}	

		
		$password = $_POST['password'];
		$password = $valid->clean_value($password);
		if(empty($password)) {
			$valid_login = "Enter password";	
		}
		if(empty($username) && empty($password))
		{
			$valid_login = "Enter user name & password";
		}
		
		$result = "";
		
		if(empty($valid_login)) {		
			$login_id = ""; $check_users = array(); $check_password = ""; $admin_user = 0; $staff_user = 0;	$check_staff = array();	
			if(!empty($username)) {
				$encrypted_username = $obj->encode_decode('encrypt', $username);	
				$check_users = $obj->getTableRecords($GLOBALS['user_table'], 'username', $encrypted_username);
				if(!empty($check_users)) {
					foreach($check_users as $data) {
						$login_id = $data['id'];
						$check_password = $data['password'];
						if(!empty($data['admin']) && $data['admin'] == '1') {
							$admin_user = 1;
						}
						else {
							$staff_user = 1;
						}
					}
				}
			}
			
			if(!empty($login_id)) {				
				if($check_password == $obj->encode_decode('encrypt', $password)) {
					if(!empty($admin_user) && $admin_user == 1) {
						$check_users = $obj->getTableRecords($GLOBALS['user_table'], 'id', $login_id);
						if(!empty($check_users)) {
							foreach($check_users as $data) {
								$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'] = $data['user_id'];
								$_SESSION[$GLOBALS['site_name_user_prefix'].'_username'] = $obj->encode_decode('decrypt', $data['name']);
								$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] =  $GLOBALS['admin_user_type'];
								$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_mobile_number'] =  $obj->encode_decode('decrypt', $data['mobile_number']);
							}
						}
					}
					else if(!empty($staff_user) && $staff_user == 1) {
						$check_users = $obj->getTableRecords($GLOBALS['user_table'], 'id', $login_id);
						if(!empty($check_users)) {
							foreach($check_users as $data) {
								$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'] = $data['user_id'];
								$_SESSION[$GLOBALS['site_name_user_prefix'].'_username'] = $obj->encode_decode('decrypt', $data['name']);
								$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] =  $GLOBALS['staff_user_type'];
								$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_mobile_number'] =  $obj->encode_decode('decrypt', $data['mobile_number']);
							}
						}
					}
					
					if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
						$create_date_time = $GLOBALS['create_date_time_label'];			
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$browser = $_SERVER['HTTP_USER_AGENT'];
						$os_detail = php_uname();

						$action = "";
						if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
							$action = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']." User Login. IP Address - ".$ip_address." at ".date("d-m-Y h:is A", strtotime($create_date_time));
						}

						$columns = array('login_date_time', 'logout_date_time', 'ip_address', 'browser', 'os_detail', 'type', 'user_id');
						$values = array("'".$create_date_time."'", "'0000-00-00 00:00:00'", "'".$ip_address."'", "'".$browser."'", "'".$os_detail."'", "'".$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']."'", "'".$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']."'");						
						$user_login_record_id = $obj->InsertSQL($GLOBALS['login_table'], $columns, $values, $action);						
						if(preg_match("/^\d+$/", $user_login_record_id)) {												
							$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_login_record_id'] = $user_login_record_id;
							$_SESSION[$GLOBALS['site_name_user_prefix'].'_user_ip_address'] = $ip_address;						
							if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_ip_address']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_ip_address'])) {

								$organization_records = array(); $bill_company_id = "";
								$organization_records = $obj->getTableRecords($GLOBALS['organization_table'],'','');
								if(!empty($organization_records)) {
									foreach($organization_records as $data){
										if(!empty($data['organization_id'])){
											$bill_company_id = $data['organization_id'];
										}
									}
								}	
								if(!empty($bill_company_id)){
									$_SESSION['bill_company_id'] = $bill_company_id;
								}
								$redirection_page = "dashboard.php";

								$result = array('number' => '1', 'msg' => 'Login Successfully', 'redirection_page' => $redirection_page);
							}
						}
						else {
							$result = array('number' => '2', 'msg' => $user_login_record_id);
						}
					}	
				}
				else {
					$result = array('number' => '2', 'msg' => 'Password not match');
				}				
			}
			else {
				$result = array('number' => '2', 'msg' => 'Invalid User Name');
			}	
		}
		else {
			$result = array('number' => '2', 'msg' => $valid_login);
		}
		
		if(!empty($result)) {
			$result = json_encode($result);
		}
		echo $result; exit;
	}
	
?>	
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php if(!empty($project_title)) { echo $project_title; } ?> - <?php if(!empty($page_title)) { echo $page_title; } ?> </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/form.css">
	<script src="js/slim.min.js"></script>
	<script src="js/fonticons.js"></script>
	<link href="include/select2/css/select2.min.css" rel="stylesheet" />
	<link href="include/select2/css/select2-bootstrap4.min.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="include/css/modify.css">
	<script type="text/javascript" src="include/js/common.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
<div class="mobilebg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 align-self-center">
                <div class="let-pad">
                    <h1 class="bold heading2 pb-4">Mohan Transport</h1>
                    <h4 class="bold">Log In</h4>
					<form name="login_form" class="box w-100" action="login.php" method="POST">
						<div class="row">
							<?php 
							// echo $obj->encode_decode('decrypt','5457396f5957356a59584a6e62773d3d');
							// echo $obj->encode_decode('decrypt','513246795a32397462326868626b41784d6a4d3d');
							?>	
							<div class="col-lg-12 pt-4">
								<div class="w-100">
									<label class="medium login-label">User Name</label>
									<input type="text" class="form-control medium smallfnt" id="username" name="username" placeholder="username(*)">
								</div>
							</div>
							<div class="col-lg-12 pt-4">
								<div class="w-100">
									<label class="medium login-label">Password</label>
									<input type="password" class="form-control medium smallfnt" id="password" name="password" placeholder="Password(*)">
									<div style="position: relative; top: -31px; float: right; display: block;" class="input-group-append" data-toggle="tooltip" data-placement="right" title="Show Password">
										<button class="btn btn-secondary" style="padding: 2px 7px;" type="button" id="passwordBtn" data-toggle="button" aria-pressed="false"><i class="fa fa-eye"></i></button>
									</div>
								</div>
							</div>
							<div class="col-lg-12 pt-4">
								<button class="loginbtn bold submit_button" type="button" onClick="Javascript:FormSubmit(event, 'login_form', 'index.php', 'user.php');"> Log In</button>
							</div>
						</div>
					</form>
                </div>   
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-6 fullpad d-none d-lg-block">
                <img src="images/login.jpg" class="login-img" alt="" title="">
            </div>
        </div>
    </div>  
</div>
<script>
$(document).ready(function() {
  	$(function() {
  	  	$('[data-toggle="tooltip"]').tooltip();
 	 
	});

 	const passBtn = $("#passwordBtn");
 	passBtn.click(togglePassword);

 	function togglePassword() {
		const passInput = $("#password");
		if (passInput.attr("type") === "password") {
			passInput.attr("type", "text");
		} else {
			passInput.attr("type", "password");
		}
  	}
	jQuery('.register_controls').on("keypress", function(e) {
		if (e.keyCode == 13) {
			FormSubmit(event, 'user_form', 'index.php', '');
			return false; // prevent the button click from happening
		}
	});
	jQuery('.login_controls').on("keypress", function(e) {
		if (e.keyCode == 13) {
			FormSubmit(event, 'login_form', 'index.php', 'user.php');
			return false; // prevent the button click from happening
		}
	});
	jQuery('#username').on("keypress", function(e) {
		if (e.keyCode == 13) {
			jQuery('#password').focus();
		}
	});
	jQuery('#password').on("keypress", function(e) {
		if (e.keyCode == 13) {
			FormSubmit(event, 'login_form', 'index.php', 'user.php');
			return false; // prevent the button click from happening
		}
	});
});
</script>
	
<script>
    document.addEventListener("DOMContentLoaded", function(event) {

function OTPInput() {
const inputs = document.querySelectorAll('#otp > *[id]');
for (let i = 0; i < inputs.length; i++) { inputs[i].addEventListener('keydown', function(event) { if (event.key==="Backspace" ) { inputs[i].value='' ; if (i !==0) inputs[i - 1].focus(); } else { if (i===inputs.length - 1 && inputs[i].value !=='' ) { return true; } else if (event.keyCode> 47 && event.keyCode < 58) { inputs[i].value=event.key; if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } else if (event.keyCode> 64 && event.keyCode < 91) { inputs[i].value=String.fromCharCode(event.keyCode); if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } } }); } } OTPInput(); });
</script>    
</body>
</html>