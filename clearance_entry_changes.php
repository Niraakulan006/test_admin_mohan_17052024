<?php
	include("include_files.php");
    $login_staff_id = "";
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
			$login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			$permission_module = $GLOBALS['unclearance_entry_module'];
		}
	}
    if(isset($_POST['draw'])){
        $draw = trim($_POST['draw']);

        $lr_number = ""; $from_date = ""; $to_date = ""; 
        if(isset($_POST['start'])) {
            $row = trim($_POST['start']);
        }
        if(isset($_POST['length'])) {
            $rowperpage = trim($_POST['length']);
        }
        if(isset($_POST['lr_number'])) {
            $lr_number = trim($_POST['lr_number']);
        }
        if(isset($_POST['from_date'])) {
            $from_date = trim($_POST['from_date']);
        }
        if(isset($_POST['to_date'])) {
            $to_date = trim($_POST['to_date']);
        }
        $page_title = "Clearance Entry";
        $order_column = "";
        $order_column_index = "";
        $order_direction = "";

        if(isset($_POST['order'][0]['column'])) {
            $order_column_index = intval($_POST['order'][0]['column']);
        }
        if(isset($_POST['order'][0]['dir'])) {
            $order_direction = $_POST['order'][0]['dir'] === 'desc' ? 'DESC' : 'ASC';
        }
        $columns = [
            0 => '',
            1 => 'lr_date',
            2 => 'lr_number',
            3 => 'consignor_name',
            4 => 'received_person',
            5 => ''
        ];
        if(!empty($order_column_index) && isset($columns[$order_column_index])) {
            $order_column = $columns[$order_column_index];
        }
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        $totalRecords = 0;
        if(empty($access_error)) {
            $totalRecords = count($obj->getUnclearedRecordsList($row, $rowperpage, $lr_number, $from_date, $to_date, $login_branch_id, $order_column, $order_direction));
            $filteredRecords = count($obj->getUnclearedRecordsList('', '', $lr_number, $from_date, $to_date, $login_branch_id, $order_column, $order_direction));
        }

        $data = [];
        $permission_module = $GLOBALS['unclearance_entry_module'];

        $uncleared_list = $obj->getUnclearedRecordsList($row, $rowperpage, $lr_number, $from_date, $to_date, $login_branch_id, $order_column, $order_direction);
        $sno = $row + 1;
        if(empty($access_error)) {
            foreach ($uncleared_list as $val) {
                $lr_date = ""; $lr_number = ""; $consignor_name = ""; $received_person = "";

                if(!empty($val['lr_date']) && $val['lr_date'] != "0000-00-00") {
                    $lr_date = date('d-m-Y', strtotime($val['lr_date']));
                }
                if(!empty($val['lr_number']) && $val['lr_number'] != $GLOBALS['null_value']) {
                    $lr_number = $val['lr_number'];
                }
                if(!empty($val['consignor_name']) && $val['consignor_name'] != $GLOBALS['null_value']) {
                    $consignor_name = $obj->encode_decode('decrypt', $val['consignor_name']);
                }
                if(!empty($val['received_person']) && $val['received_person'] != $GLOBALS['null_value']) {
                    $received_person = $obj->encode_decode('decrypt', $val['received_person']);
                }
                else {
                    $received_person = "Not Received";
                }

                $action = ""; 
                if(empty($val['is_cleared'])) {
                    $action = '<a class="pr-2" href="Javascript:getClearance('.'\''.$val['lr_id'].'\''.');"><i class="fa fa-location-arrow"></i>&ensp; Clear</a>';
                }
                else {
                    $action = "<span class='text-success' style='font-weight:bold;'>Cleared</span>";
                }

                $data[] = [
                    "sno" => $sno++,
                    "lr_date" => $lr_date,
                    "lr_number" => $lr_number,
                    "consignor_name" => $consignor_name,
                    "received_person" => $received_person,
                    "action" => $action
                ];
            }
        }

        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ];

        echo json_encode($response);
    }
    if(isset($_REQUEST['is_cleared'])) { 
        $lr_id = $_REQUEST['lr_id'];
        ?>
        <form name="clearance_form" method="post">
            <input type="hidden" id="lr_id" name="lr_id" value ="<?php if(!empty($lr_id)){ echo $lr_id; }?>"class="form-control shadow-none" placeholder="" required>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="consignee_name"  name="name" class="form-control shadow-none" value="" placeholder="" required>
                            <label>Name</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="mobile_number" name="mobile_number" value="" class="form-control shadow-none" placeholder="" required>
                            <label>Mobile Number</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="identification" name="identification" value="" class="form-control shadow-none" placeholder="" required>
                            <label>Identification</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-check pr-3">
                        <input class="form-check-input" id="length_check" type="checkbox" name="length_check" value="" id="defaultCheck1" onclick="Javascript:getClearanceDetails();">
                        <label class="form-check-label fw-400 checkbox" for="defaultCheck1" onclick="Javascript:getcheckboxcleared1();">
                            Check if receiver is same as consignee
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-dark btnwidth submit_button" type="button" onClick="Javascript:SaveModalContent('clearance_form', 'clearance_entry_changes.php', 'clearance_entry.php');">Submit</button>
                </div>
            </div>
        </form>
        <?php  
    } 
    if(isset($_POST['name'])) {
        $name = "";  $mobile_error = ""; $mobile_number = ""; $mobile_error = ""; $lr_id = ""; $identification = "";
        $valid_stock = ""; $form_name = "clearance_form"; $stock_error = ""; $valid_clearance = "";
    
        $name = $_POST['name'];
        if(isset($lr_id)) {
            $lr_id = $_POST['lr_id'];
        }
        // $name_error = $valid->valid_name($name,"name",'1');
        if(!empty($name)){
            $name_error = $valid->common_validation($name, "Consignee Name", "text");
        }else{
            $name_error = "Enter the Name";
        }

        if(!empty($name_error)) {
            if(!empty($valid_clearance)) {
                $valid_clearance = $valid_clearance." ".$valid->error_display($form_name, "name", $name_error, 'text');
            }
            else {
                $valid_clearance = $valid->error_display($form_name, "name", $name_error, 'text');
            }
        }
    
        $mobile_number = $_POST['mobile_number'];
        $mobile_error = $valid->valid_mobile_number($mobile_number,'mobile_number','text');
        if(!empty($mobile_error)) {
            if(!empty($valid_clearance)) {
                $valid_clearance = $valid_clearance." ".$valid->error_display($form_name, "mobile_number", $mobile_error, 'text');
            }
            else {
                $valid_clearance = $valid->error_display($form_name, "mobile_number", $mobile_error, 'text');
            }
        }
    
        $identification = ""; $identification_error ="";
        if(isset($_POST['identification'])) {
            $identification = $_POST['identification'];
            // if(empty($identification))
            // {
            //     $identification_error = "Enter identification";
            // }
            // if(!empty($identification_error)) {
            //     if(!empty($valid_clearance)) {
            //         $valid_clearance = $valid_clearance." ".$valid->error_display($form_name, "identification", $identification_error, 'text');
            //     }
            //     else {
            //         $valid_clearance = $valid->error_display($form_name, "identification", $identification_error, 'text');
            //     }
            // }
        }
       
    
        $result = "";
        if(empty($valid_clearance) ) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(!empty($name))
            {
                $name= $obj->encode_decode("encrypt",$name);
            }
            if(!empty($mobile_number))
            {
                $mobile_number = $obj->encode_decode("encrypt",$mobile_number);
            }
            if(!empty($identification))
            {
                $identification = $obj->encode_decode("encrypt",$identification);
            }
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $columns = array('received_person','received_mobile_number','received_identification','is_cleared');
                $values = array( "'".$name."'","'".$mobile_number."'","'".$identification."'",'1');
                $lr_unique_id = "";
                $lr_unique_id = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $lr_id, 'id');
                        
                $lr_update_id = $obj->UpdateSQL($GLOBALS['lr_table'], $lr_unique_id, $columns, $values, '');
                if(preg_match("/^\d+$/", $lr_update_id)) {
    
                    $receiver_details = "";
                    if(!empty($name)) {
                        $receiver_details = $obj->encode_decode("decrypt", $name);
                        if(!empty($mobile_number)) {
                            $receiver_details = $receiver_details." - ".$obj->encode_decode("decrypt", $mobile_number);
                        }
                    }
    
                    $lr_number = ""; $consignor_id = ""; $consignee_id = "";                     
                    $lr_list = array();
                    $lr_list = $obj->getTableRecords($GLOBALS['lr_table'], 'lr_id', $lr_id);
                    if(!empty($lr_list)) {
                        foreach($lr_list as $lr) {
                            if(!empty($lr['lr_number'])) {
                                $lr_number = $lr['lr_number'];
                            }
                            if(!empty($lr['consignor_id'])) {
                                $consignor_id = $lr['consignor_id'];
                            }
                            if(!empty($lr['consignee_id'])) {
                                $consignee_id = $lr['consignee_id'];
                            }
                        }
                    }
    
                    $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                    $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
    
                    //echo "consignor_id - ".$consignor_id.", consignee_id - ".$consignee_id."<br>";
                    if(!empty($consignor_id) && !empty($lr_number) && !empty($receiver_details)) {
                        $consignor_mobile_number = "";
                        $consignor_mobile_number = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_id, 'mobile_number');
                        if(!empty($consignor_mobile_number)){
                            $consignor_mobile_number = $obj->encode_decode('decrypt', $consignor_mobile_number);
                            //echo "consignor_mobile_number - ".$consignor_mobile_number."<br>";
                            //$clear_sms = $consignor_mobile_number."|".$lr_number."|".$receiver_details;
                            $clear_sms = $lr_number."|".$receiver_details;
                            //echo $clear_sms."<br>";
                            $sms_response = "";
                            $sms_response = $obj->send_mobile_details($consignor_mobile_number, '164518', $clear_sms);
    
                            $columns = array('created_date_time', 'creator', 'creator_name','lr_number', 'mobile_number', 'type');
                            $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$lr_number."'", "'".$consignor_mobile_number."'", "'Clearance'");
    
                            $clr_sms_insert_id = $obj->InsertSQL($GLOBALS['sms_count_table'], $columns, $values, 'Consignor Consignor Clearance SMS send Successfully');
                        }
                    }
                    if(!empty($consignee_id) && !empty($lr_number) && !empty($receiver_details)) {
                        $consignee_mobile_number = "";
                        $consignee_mobile_number = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_id, 'mobile_number');
                        if(!empty($consignee_mobile_number)){
                            $consignee_mobile_number = $obj->encode_decode('decrypt', $consignee_mobile_number);
                            //echo "consignee_mobile_number - ".$consignee_mobile_number."<br>";
                            //$clear_sms = $consignee_mobile_number."|".$lr_number."|".$receiver_details;
                            $clear_sms = $lr_number."|".$receiver_details;
                            //echo $clear_sms."<br>";
                            $sms_response = "";
                            $sms_response = $obj->send_mobile_details($consignee_mobile_number, '164518', $clear_sms);
    
                            $columns = array('created_date_time', 'creator', 'creator_name','lr_number', 'mobile_number', 'type');
                            $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$lr_number."'", "'".$consignee_mobile_number."'", "'Clearance'");
    
                            $clr_sms_insert_id = $obj->InsertSQL($GLOBALS['sms_count_table'], $columns, $values, 'Consignor Consignee Clearance SMS send Successfully');
                        }
                    }
    
                    $result = array('number' => '1', 'msg' => 'Updated Successfully');
                }
     
    
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_clearance)) {
                $result = array('number' => '3', 'msg' => $valid_clearance);
            }
        }
    
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;
    
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;
    
    }
    if(isset($_REQUEST['is_clear'])) { 
        $lr_list = array();
        $select_query ="SELECT * FROM ".$GLOBALS['lr_table']." WHERE is_cleared = '0' AND deleted = '0' AND is_tripsheet_entry = '1' ";
        $lr_list= $obj->getQueryRecords($GLOBALS['lr_table'],$select_query);
        // $lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'is_cleared','0');
        ?>
        <form name="clearance_form" method="post">
            <input type="hidden" id="lr_id" name="lr_id" value ="<?php if(!empty($lr_id)){ echo $lr_id; }?>"class="form-control shadow-none" placeholder="" required>
            <div class="row">
                <div class="col-lg-5 col-md-4 col-6">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" list = 'lr_number_list' id="lr_number" name="lr_number" class="form-control shadow-nonex" placeholder="Lr number" value="<?php if(!empty($lr_number)){ echo $lr_number; }?>" style="margin: 0;">
                            <label>Lr number</label>
                            <div style="max-height: 150px;overflow-y: scroll;" class='lr_number_search_list' style="position:initial;">
                                <ul class="suggestion_box" id="show_lr_number_list">
                                    <?php
                                        if(!empty($lr_list)) {
                                            $i = 0;
                                            
                                            foreach($lr_list as $data) { ?>
                                                <li style="display: none;"> 
                                                    <a class="<?php echo 'lr_number'.$i; ?>" href="Javascript:get_search_lr_number('<?php echo 'lr_number'.$i; ?>', '<?php echo $data['lr_number']; ?>');">
                                                        <?php 
                                                        if(!empty($data['lr_number'])) {
                                                            // $data['lr_number'] = $obj->encode_decode('decrypt', $data['lr_number']);
                                                            // echo $data['mobile_number'];
                                                            
                                                            echo trim($data['lr_number']);
                                                        } ?>
                                                    </a>
                                                </li>
                                                <?php
                                                $i++; 
                                            }
                                        }
                                    ?>
                                </ul>
                            </div> 
                            <!-- <select name="clear_lr_number" class="form-control" id="state" >
                                <option value="">Select LR NO</option>
                                <?php
                                    if(!empty($lr_list)) {
                                        foreach($lr_list as $data) {
                                ?>
                                            <option value="<?php if(!empty($data['lr_number'])) { echo $data['lr_number']; } ?>">
                                                <?php
                                                    if(!empty($data['lr_number'])) {
                                                        // $data['lr_number'] = $obj->encode_decode('decrypt', $data['lr_number']);
                                                        echo $data['lr_number'];
                                                    }
                                                ?>
                                            </option>
                                <?php
                                        }
                                    }
                                ?> 
                            </select> -->
                        </div> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="lr_details col-lg-12 col-md-12 col-12">
    
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="consignee_name"  name="clear_name" class="form-control shadow-none" value="" placeholder="" required>
                            <label>Name</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="mobile_number" name="clear_mobile_number" value="" class="form-control shadow-none" placeholder="" required>
                            <label>Mobile Number</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="form-group mb-1">
                        <div class="form-label-group in-border pb-2">
                            <input type="text" id="identification" name="clear_identification" value="" class="form-control shadow-none" placeholder="" required>
                            <label>Identification</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-check pr-3">
                        <input class="form-check-input" id="length_check" type="checkbox" name="length_check" value="" id="defaultCheck1" onclick="Javascript:getClearDetails();">
                        <label class="form-check-label fw-400 checkbox" for="defaultCheck1" onclick="Javascript:getcheckboxcleared();">
                            Check if receiver is same as consignee
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-dark btnwidth submit_button" type="button" onClick="Javascript:SaveModalContent('clearance_form', 'clearance_entry_changes.php', 'clearance_entry.php');">Submit</button>
                </div>
            </div>
        </form>
        <script type="text/javascript">   
           jQuery(document).ready(function(){
                jQuery('input[name="lr_number"]').on("keypress", function(e) {
                    if (e.keyCode == 13) {
                        
                        if(jQuery(".lr_number_search_list li.active").length!=0) {
                            var search_product_link = jQuery.trim(jQuery(".lr_number_search_list li.active").find('a').attr('href'));
                            // jQuery(".consignor_search_list li.active").css("display" , "none");
                            window.location = search_product_link;
                        }
                        return false;
                    }
                });
    
                jQuery('input[name="lr_number"]').keyup(function(e) {
                    if(e.which != 13){
                        search_lr_number_list('clearance_form')
                    }
                    
                    if(e.which == 38){
                        var storeTarget = jQuery('.lr_number_search_list').find("li.active");
                        do {
                            storeTarget = storeTarget.prev();
                        } while (storeTarget.length && storeTarget.is(':hidden'));
                        
                        jQuery(".lr_number_search_list li.active").removeClass("active");
                        storeTarget.focus().addClass("active");
    
                        return false;
                    }
                    if(e.which == 40){
                        if(jQuery(".lr_number_search_list li.active").length!=0) {
                            if(jQuery('.lr_number_search_list').find("li.active").nextAll('li:visible').length > 0) {
                                var storeTarget = jQuery('.lr_number_search_list').find("li.active").nextAll('li:visible').first().focus();
                                jQuery(".lr_number_search_list li.active").removeClass("active");
                                storeTarget.addClass("active");
                            }
                            else {
                                jQuery(".lr_number_search_list li.active").removeClass("active");
                                jQuery('.lr_number_search_list').find("li:visible").first().focus().addClass("active");
                            }
                        }
                        else {
                            jQuery('.lr_number_search_list').find("li:visible").first().focus().addClass("active");
                        }
                        return false;
                    }
                });
            });
        </script>
        <?php  
    } 
    if(isset($_POST['clear_name'])) {
        $name = "";  $mobile_error = ""; $mobile_number = ""; $mobile_error = ""; $lr_id = ""; $identification = "";
        $valid_stock = ""; $form_name = "clearance_form"; $stock_error = ""; $valid_clearance = ""; $lr_number ="";
        $lr_error ="";
        if(isset($_POST['lr_number']))
        {
            $lr_number = $_POST['lr_number'];
        }
        if(empty($lr_number))
        {
            $lr_error = "Enter lr Number";
        }
        if(!empty($lr_error)) {
            if(!empty($valid_clearance)) {
                $valid_clearance = $valid_clearance." ".$valid->error_display($form_name, "lr_number", $lr_error, 'text');
            }
            else {
                $valid_clearance = $valid->error_display($form_name, "lr_number", $lr_error, 'text');
            }
        }

        if(!empty($lr_number)) {
            $from_date = "";
            if(isset($_SESSION['billing_year_starting_date']) && !empty($_SESSION['billing_year_starting_date'])) {
                $from_date = $_SESSION['billing_year_starting_date'];
                if(!empty($from_date)) {
                    $from_date = date("Y-m-d", strtotime($from_date));
                }
            }
            $to_date = "";
            if(isset($_SESSION['billing_year_ending_date']) && !empty($_SESSION['billing_year_ending_date'])) {
                $to_date = $_SESSION['billing_year_ending_date'];
                if(!empty($to_date)) {
                    $to_date = date("Y-m-d", strtotime($to_date));
                }
            }
            if(!empty($from_date) && !empty($to_date)) {
                $lr_list = array();
                $select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE lr_number = '".$lr_number."' AND
                               DATE(lr_date) >= '".$from_date."' AND DATE(lr_date) <= '".$to_date."' AND cancelled = '0'";
                $lr_list = $obj->getQueryRecords($GLOBALS['lr_table'], $select_query);
                if(!empty($lr_list)) {
                    foreach($lr_list as $data) {
                        if(!empty($data['lr_id'])) {
                            $lr_id = $data['lr_id'];
                        }
                    }
                }
            }
            //$lr_id = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_number',$lr_number,'lr_id');
        }
    
        if(isset($_POST['clear_name']))
        {
            $name = $_POST['clear_name'];
        }
        // if(isset($lr_id))
        // {
        //     $lr_id = $_POST['lr_id'];
        // }
        // $name_error = $valid->valid_name($name,"name",'1');
        if(empty($name)) {
            $name_error = "Enter the name";
        }
        if(!empty($name_error)) {
            if(!empty($valid_clearance)) {
                $valid_clearance = $valid_clearance." ".$valid->error_display($form_name, "clear_name", $name_error, 'text');
            }
            else {
                $valid_clearance = $valid->error_display($form_name, "clear_name", $name_error, 'text');
            }
        }
    
        $mobile_number = $_POST['clear_mobile_number'];
        $mobile_error = $valid->valid_mobile_number($mobile_number,'clear_mobile_number','text');
        if(!empty($mobile_error)) {
            if(!empty($valid_clearance)) {
                $valid_clearance = $valid_clearance." ".$valid->error_display($form_name, "clear_mobile_number", $mobile_error, 'text');
            }
            else {
                $valid_clearance = $valid->error_display($form_name, "clear_mobile_number", $mobile_error, 'text');
            }
        }
    
        $identification = ""; $identification_error ="";
        if(isset($_POST['clear_identification']))
        {
            $identification = $_POST['clear_identification'];
            // if(empty($identification))
            // {
            //     $identification_error = "Enter identification";
            // }
            // if(!empty($identification_error)) {
            //     if(!empty($valid_clearance)) {
            //         $valid_clearance = $valid_clearance." ".$valid->error_display($form_name, "identification", $identification_error, 'text');
            //     }
            //     else {
            //         $valid_clearance = $valid->error_display($form_name, "identification", $identification_error, 'text');
            //     }
            // }
        }
       
    
        $result = "";
        if(empty($valid_clearance) ) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(!empty($name))
            {
                $name= $obj->encode_decode("encrypt",$name);
            }
            if(!empty($mobile_number))
            {
                $mobile_number = $obj->encode_decode("encrypt",$mobile_number);
            }
            if(!empty($identification))
            {
                $identification = $obj->encode_decode("encrypt",$identification);
            }
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                $columns = array('received_person','received_mobile_number','received_identification','is_cleared');
                $values = array( "'".$name."'","'".$mobile_number."'","'".$identification."'",'1');
                $lr_unique_id = "";
                $lr_unique_id = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_id', $lr_id, 'id');
                        
                $lr_update_id = $obj->UpdateSQL($GLOBALS['lr_table'], $lr_unique_id, $columns, $values, '');
                if(preg_match("/^\d+$/", $lr_update_id)) {
    
                    $receiver_details = "";
                    if(!empty($name)) {
                        $receiver_details = $obj->encode_decode("decrypt", $name);
                        if(!empty($mobile_number)) {
                            $receiver_details = $receiver_details." - ".$obj->encode_decode("decrypt", $mobile_number);
                        }
                    }
    
                    $lr_number = ""; $consignor_id = ""; $consignee_id = "";                     
                    $lr_list = array();
                    $lr_list = $obj->getTableRecords($GLOBALS['lr_table'], 'lr_id', $lr_id);
                    if(!empty($lr_list)) {
                        foreach($lr_list as $lr) {
                            if(!empty($lr['lr_number'])) {
                                $lr_number = $lr['lr_number'];
                            }
                            if(!empty($lr['consignor_id'])) {
                                $consignor_id = $lr['consignor_id'];
                            }
                            if(!empty($lr['consignee_id'])) {
                                $consignee_id = $lr['consignee_id'];
                            }
                        }
                    }
    
                    $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
                    $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
    
                    //echo "consignor_id - ".$consignor_id.", consignee_id - ".$consignee_id."<br>";
                    if(!empty($consignor_id) && !empty($lr_number) && !empty($receiver_details)) {
                        $consignor_mobile_number = "";
                        $consignor_mobile_number = $obj->getTableColumnValue($GLOBALS['consignor_table'], 'consignor_id', $consignor_id, 'mobile_number');
                        if(!empty($consignor_mobile_number)){
                            $consignor_mobile_number = $obj->encode_decode('decrypt', $consignor_mobile_number);
                            //echo "consignor_mobile_number - ".$consignor_mobile_number."<br>";
                            //$clear_sms = $consignor_mobile_number."|".$lr_number."|".$receiver_details;
                            $clear_sms = $lr_number."|".$receiver_details;
                            //echo $clear_sms."<br>";
                            $sms_response = "";
                            $sms_response = $obj->send_mobile_details($consignor_mobile_number, '164518', $clear_sms);
    
                            $columns = array('created_date_time', 'creator', 'creator_name','lr_number', 'mobile_number', 'type');
                            $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$lr_number."'", "'".$consignor_mobile_number."'", "'Clearance'");
    
                            $clr_sms_insert_id = $obj->InsertSQL($GLOBALS['sms_count_table'], $columns, $values, 'Consignor Consignor Clearance SMS send Successfully');
                        }
                    }
                    if(!empty($consignee_id) && !empty($lr_number) && !empty($receiver_details)) {
                        $consignee_mobile_number = "";
                        $consignee_mobile_number = $obj->getTableColumnValue($GLOBALS['consignee_table'], 'consignee_id', $consignee_id, 'mobile_number');
                        if(!empty($consignee_mobile_number)){
                            $consignee_mobile_number = $obj->encode_decode('decrypt', $consignee_mobile_number);
                            //echo "consignee_mobile_number - ".$consignee_mobile_number."<br>";
                            //$clear_sms = $consignee_mobile_number."|".$lr_number."|".$receiver_details;
                            $clear_sms = $lr_number."|".$receiver_details;
                            //echo $clear_sms."<br>";
                            $sms_response = "";
                            $sms_response = $obj->send_mobile_details($consignee_mobile_number, '164518', $clear_sms);
    
                            $columns = array('created_date_time', 'creator', 'creator_name','lr_number', 'mobile_number', 'type');
                            $values = array("'".$created_date_time."'", "'".$creator."'", "'".$creator_name."'", "'".$lr_number."'", "'".$consignee_mobile_number."'", "'Clearance'");
    
                            $clr_sms_insert_id = $obj->InsertSQL($GLOBALS['sms_count_table'], $columns, $values, 'Consignor Consignee Clearance SMS send Successfully');
                        }
                    }
    
                    $result = array('number' => '1', 'msg' => 'Updated Successfully');
                }
    
    
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }
        else {
            if(!empty($valid_clearance)) {
                $result = array('number' => '3', 'msg' => $valid_clearance);
            }
        }
    
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;
    
        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;
    
    }
?>
