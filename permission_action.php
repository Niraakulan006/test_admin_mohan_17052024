<?php
    if(!empty($login_staff_id) && !empty($permission_module) && !empty($permission_action)) {
        $check_role_id = "";
        $check_role_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $login_staff_id, 'role_id');
        $access_page_permission = 0;
        $access_page_permission = $obj->CheckRoleAccessPage($check_role_id, $permission_module);
        if(!empty($access_page_permission) && $access_page_permission == 1) {
            $role_list = array();
            $role_list = $obj->getTableRecords($GLOBALS['role_table'], 'role_id', $check_role_id, '');
            if(!empty($role_list)) {
                foreach($role_list as $role) {
                    if(!empty($role['access_pages'])) {
                        $access_pages = explode(",", $role['access_pages']);
                    }
                    if(!empty($role['access_page_actions'])) {
                        $access_page_actions = explode(",", $role['access_page_actions']);
                    }
                }
            }
            $module_action = array(); $permission_module_encrypted = $obj->encode_decode('encrypt', $permission_module);
            if(!empty($access_pages)) {
                for($i = 0; $i < count($access_pages); $i++) {
                    if(!empty($access_pages[$i]) && $permission_module_encrypted == $access_pages[$i]) {
                        if(!empty($access_page_actions[$i])) {
                            $module_action = explode("$$$", $access_page_actions[$i]);
                        }
                    }
                }
            }
            
            if(!empty($module_action)) {
                if(!in_array($permission_action, $module_action)) {
                    if($permission_action == $view_action) {
                        $access_error = "You don't get permission to view ".strtolower($permission_module);
                    }
                    else if($permission_action == $add_action) {
                        $access_error = "You don't get permission to add ".strtolower($permission_module);
                    }
                    else if($permission_action == $edit_action) {
                        $access_error = "You don't get permission to edit ".strtolower($permission_module);
                    }
                    else if($permission_action == $delete_action) {
                        $access_error = "You don't get permission to delete ".strtolower($permission_module);
                    }
                }
            }
        }
    }
?>  