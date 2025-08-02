<?php
	include("include_files.php");
    $login_staff_id = "";
	if(isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && !empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
		if(!empty($GLOBALS['user_type']) && $GLOBALS['user_type'] != $GLOBALS['admin_user_type']) {
			$login_staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
			$permission_module = $GLOBALS['invoice_acknowledgement_module'];
		}
	}
    if(isset($_POST['draw'])){
        $draw = trim($_POST['draw']);

        $search_text = ""; $from_date = ""; $to_date = ""; 
        if(isset($_POST['start'])) {
            $row = trim($_POST['start']);
        }
        if(isset($_POST['length'])) {
            $rowperpage = trim($_POST['length']);
        }
        if(isset($_POST['search_text'])) {
            $search_text = trim($_POST['search_text']);
        }
        if(isset($_POST['from_date'])) {
            $from_date = trim($_POST['from_date']);
        }
        if(isset($_POST['to_date'])) {
            $to_date = trim($_POST['to_date']);
        }
        $page_title = "Invoice Acknowledgement";
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
            1 => 'tripsheet_date',
            2 => 'tripsheet_number',
            3 => 'lr_count',
            4 => ''
        ];
        if(!empty($order_column_index) && isset($columns[$order_column_index])) {
            $order_column = $columns[$order_column_index];
        }
        $access_error = "";
        if(!empty($login_staff_id)) {
            $permission_action = $view_action;
            include('permission_action.php');
        }
        $totalRecords = 0; $filteredRecords = 0;
        if(empty($access_error)) {
            $totalRecords = count($obj->getAcknowledgedTripsheetListRecords($row, $rowperpage, $search_text, $from_date, $to_date, $login_branch_id, $order_column, $order_direction));
            $filteredRecords = count($obj->getAcknowledgedTripsheetListRecords('', '', $search_text, $from_date, $to_date, $login_branch_id, $order_column, $order_direction));
        }

        $data = [];
        $permission_module = $GLOBALS['invoice_acknowledgement_module'];

        $invoice_acknowledgement_list = $obj->getAcknowledgedTripsheetListRecords($row, $rowperpage, $search_text, $from_date, $to_date, $login_branch_id, $order_column, $order_direction);
        $sno = $row + 1;
        
        if(empty($access_error)) {
            foreach ($invoice_acknowledgement_list as $val) {
                $tripsheet_date = ""; $tripsheet_number = ""; $lr_id = ""; $lr_count = 0;

                if(!empty($val['tripsheet_date']) && $val['tripsheet_date'] != "0000-00-00") {
                    $tripsheet_date = date('d-m-Y', strtotime($val['tripsheet_date']));
                }
                if(!empty($val['tripsheet_number']) && $val['tripsheet_number'] != $GLOBALS['null_value']) {
                    $tripsheet_number = $val['tripsheet_number'];
                }
                if(!empty($val['lr_id']) && $val['lr_id'] != $GLOBALS['null_value']) {
                    $lr_id = explode(',', $val['lr_id']);
                    $lr_count = count($lr_id);
                }

                $action = "";
                $action = '<a class="pr-2" href="Javascript:getacknowledgementInvoice('.'\''.$val['tripsheet_id'].'\''.');"><i class="fa fa-eye"></i></a>';

                $data[] = [
                    "sno" => $sno++,
                    "tripsheet_date" => $tripsheet_date,
                    "tripsheet_number" => $tripsheet_number,
                    "lr_count" => $lr_count,
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
    if(isset($_REQUEST['is_acknowlegement'])) { 
        ?>          
        <form name="Acknowledgement_form" method="post">
            <div class="row">
                <div class="form-group col-3 mx-auto my-5">
                    <div class="form-label-group in-border mb-0">
                        <input type="text" id="tripsheet_number" name="tripsheet_number" class="form-control shadow-none" placeholder="">
                        <label>Tripsheet number <span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="form-group col-3 mx-auto my-5">
                    <div class="form-label-group in-border mb-0">
                        <button class="btn btn-dark btnwidth search_button" type="button" onClick="Javascript:AddacknowledgementDetails();">Search</button>
                    </div>
                </div>
            </div>
            <div class="row p-2 mb-2 invoice_details">
            </div>
        </form>
        <?php	
    }
    if(isset($_POST['tripsheet_number'])) {
        $tripsheet_number = ""; $form_name = "Acknowledgement_form";
        $acknowledgment_date = date("d-m-Y");

        $tripsheet_number = $_POST['tripsheet_number'];
        $tripsheet_number = $valid->clean_value($tripsheet_number);
        if(!empty($tripsheet_number)) {
            $invoice_unique_id = "";
            $invoice_unique_id = $obj->getTableColumnValue($GLOBALS['tripsheet_table'], 'tripsheet_number', $tripsheet_number, 'id');
        }
        $lr_numbers = array();
        if(isset($_POST['lr_number'])) {
            $lr_numbers = $_POST['lr_number'];
        }
        
        $result = "";
        $created_date_time = $GLOBALS['create_date_time_label']; $creator = $GLOBALS['creator'];
        $creator_name = $obj->encode_decode('encrypt', $GLOBALS['creator_name']);
        if(!empty($invoice_unique_id) ) {
            $check_user_id_ip_address = 0;
            $check_user_id_ip_address = $obj->check_user_id_ip_address();	
            if(preg_match("/^\d+$/", $check_user_id_ip_address)) {
                if(!empty($lr_numbers)) {
                    for($i=0; $i < count($lr_numbers); $i++) {
                        $lr_unique_id = "";
                        $lr_unique_id = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_number', $lr_numbers[$i], 'id');
                        $action = "LR acknowledged - ".$lr_numbers[$i];
                        if(preg_match("/^\d+$/", $lr_unique_id)) {
                            $columns = array(); $values = array();
                            $columns = array('invoice_status');
                            $values = array('"C"');
                            $invoice_update_id = $obj->UpdateSQL($GLOBALS['lr_table'], $lr_unique_id, $columns, $values, $action);
                        }
                    }
                }
                $invoice_list = array(); $overall_invoice_status = array();
                $invoice_list = $obj->getTableRecords($GLOBALS['tripsheet_table'], 'id', $invoice_unique_id);
                if(!empty($invoice_list)) {
                    $invoice_lr_numbers = ""; $lr_number = "";
                    foreach($invoice_list as $data) {
                        if(!empty($data['lr_number'])) {
                            $invoice_lr_numbers = explode("$$$", $data['lr_number']);
                        }
                    }
                    if(!empty($invoice_lr_numbers)) {
                        foreach($invoice_lr_numbers as $lr_number) {
                            if(!empty($lr_number)) {
                                $invoice_status = ""; 
                                $invoice_status = $obj->getTableColumnValue($GLOBALS['lr_table'], 'lr_number', $lr_number, 'invoice_status');
                                $overall_invoice_status[] = $invoice_status;
                            }
                        }
                    }
                }
                if(is_array($overall_invoice_status) && !empty($overall_invoice_status) && (!in_array('O',$overall_invoice_status))){
                    $columns = array('is_acknowledged');
                    $values = array( "'1'");                    
                    $invoice_update_id = $obj->UpdateSQL($GLOBALS['tripsheet_table'], $invoice_unique_id, $columns, $values, '');
                    if(preg_match("/^\d+$/", $invoice_update_id)) {
                        $result = array('number' => '1', 'msg' => 'Tripsheet Updated Successfully');
                    }
                }
                else if(is_array($overall_invoice_status) && !empty($overall_invoice_status) && (in_array('C',$overall_invoice_status)) && (in_array('O',$overall_invoice_status))){
                    $result = array('number' => '1', 'msg' => 'Updated Successfully');
                }
            }
            else {
                $result = array('number' => '2', 'msg' => 'Invalid IP');
            }
        }

        if(!empty($result)) {
            $result = json_encode($result);
        }
        echo $result; exit;

    }
?>