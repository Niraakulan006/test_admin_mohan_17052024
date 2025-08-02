<?php
    session_start();
    
    include("include/label.php");
    include("include/functions.php");
    include("include/validation.php");
    
    $obj = new billing();
    $valid = new validation();
    
    $view_action = $obj->encode_decode('encrypt', 'View'); $add_action = $obj->encode_decode('encrypt', 'Add');
    $edit_action = $obj->encode_decode('encrypt', 'Edit'); $delete_action = $obj->encode_decode('encrypt', 'Delete');

    $project_title = "";
    $project_title = $obj->getProjectTitle();

    $branch_id = ""; $login_branch_id = array();
    if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
        $is_branch_staff = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'], 'is_branch_staff');
        if($is_branch_staff == "yes") {
            $branch_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'], 'branch_id');
        }
    }
    if(!empty($branch_id) && $branch_id != $GLOBALS['null_value']) {
        $login_branch_id = explode(",", $branch_id);
    }
?>