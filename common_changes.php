<?php 
    
    include("include_files.php");

    if(isset($_REQUEST['load_mobile_number'])){
        $client_id = $_REQUEST['client_id'];
        $client_type = $_REQUEST['client_type'];

        $client_list = array();
        $client_list = $obj->getTableRecords($GLOBALS['client_table'], 'client_id', $client_id);

        $client_mobile = ""; $client_city = ""; $client_state = ""; $client_gst_number = ""; $client_identification = "";

        if(!empty($client_list)){
            foreach($client_list as $data){
                if(!empty($data['mobile_number'])){
                    $client_mobile = $obj->encode_decode('decrypt', $data['mobile_number']);
                }
                if(!empty($data['city'])){
                    $client_city = $obj->encode_decode('decrypt', $data['city']);
                }
                if(!empty($data['state'])){
                    $client_state = $obj->encode_decode('decrypt', $data['state']);
                }
                if(!empty($data['gst_number'])){
                    $client_gst_number = $obj->encode_decode('decrypt', $data['gst_number']);
                }
                if(!empty($data['identification'])){
                    $client_identification = $obj->encode_decode('decrypt', $data['identification']);
                }
            }
        }
        if(empty($client_city)){
            $client_city = $obj->getTableColumnValue($GLOBALS['receipt_table'], 'cne_client_id', $client_id, 'consignee_city');
            if(!empty($client_city)){
                $client_city = $obj->encode_decode('decrypt', $client_city);
            }
        }
        $client_mobile.'$$$'.$client_city.'$$$'.$client_state.'$$$'.$client_gst_number.'$$$'.$client_identification;
    }
    if(isset($_REQUEST['lr_number']))
    {
        $lr_number = $_REQUEST['lr_number'];
        $is_tripsheet_entry =""; $is_luggagesheet_entry = ""; $invoice_status = ""; $is_cleared = ""; $branch_id =""; $tripsheet_number =""; $godown_id =""; 
        if(!empty($lr_number))
        {
            $from_date = ""; $to_date = "";
            $year = date('Y'); $month = date("m");
            if(!empty($year) && !empty($month)) {
                $month = (int)$month;
                if($month <= 3) { $year = $year - 1; }
            }
            if(!empty($year)) {
                $from_date = "01-04-".$year;
                $to_date = "31-03-".($year + 1);
            }

            $lr_list = $obj->getTrackLRnumberDetailsList($from_date, $to_date, $lr_number);
            foreach($lr_list as $data)
            {
                if(!empty($data['is_tripsheet_entry']))
                {
                    $is_tripsheet_entry = $data['is_tripsheet_entry'];
                }
                if(!empty($data['is_luggage_entry']))
                {
                    $is_luggagesheet_entry = $data['is_luggage_entry'];
                }
                if(!empty($data['invoice_status']))
                {
                    $invoice_status = $data['invoice_status'];
                }
                if(!empty($data['is_cleared']))
                {
                    $is_cleared = $data['is_cleared'];
                }
                if(!empty($data['branch_id']))
                {
                    $branch_id = $data['branch_id'];
                }
                if(!empty($data['tripsheet_number']))
                {
                    $tripsheet_number = $data['tripsheet_number'];
                }
                if(!empty($data['godown_id']))
                {
                    $godown_id = $data['godown_id'];
                }
            }
            //echo "is_cleared - ".$is_cleared.", invoice_status - ".$invoice_status."<br>";
            //echo "is_luggagesheet_entry - ".$is_luggagesheet_entry.", godown_id - ".$godown_id."<br>";
            //echo "is_tripsheet_entry - ".$is_tripsheet_entry."<br>";
            if($is_cleared == '1')
            {
                echo "Your Parcel is dispatched.";
            }
            elseif($invoice_status == 'C')
            {
                $branch_name = ""; $branch_number = ""; $branch_address =""; $branch_bincode= ""; $branch_city = ""; $branch_state = "";
                $branch_details = $obj->getTableRecords($GLOBALS['branch_table'],'branch_id',$branch_id);
                foreach($branch_details as $list) 
                {
                    if(!empty($list['name']))
                    {
                        $branch_name = $obj->encode_decode("decrypt",$list['name'])."<br>";
                    }
                    if(!empty($list['branch_address']))
                    {
                        $branch_address =  $obj->encode_decode("decrypt",$list['branch_address'])."<br>";
                    }
                    if(!empty($list['branch_contact_number']))
                    {
                        $branch_contact_number =  $obj->encode_decode("decrypt",$list['branch_contact_number'])."<br>";
                    }
                    if(!empty($list['branch_pincode']))
                    {
                        $branch_pincode =  $obj->encode_decode("decrypt",$list['branch_pincode'])."<br>";
                    }
                    if(!empty($list['branch_city']))
                    {
                        $branch_city =  $obj->encode_decode("decrypt",$list['branch_city'])."<br>";
                    }
                    if(!empty($list['state']))
                    {
                        $branch_state =  $obj->encode_decode("decrypt",$list['state'])."<br>";
                    }
                }
                //echo $branch_name.$branch_address.$branch_city.$branch_pincode.$branch_state."$$$".$branch_contact_number;
                echo $branch_name.$branch_city."$$$".$branch_contact_number;
            }
            elseif($is_tripsheet_entry == '1')
            {
                $driver_name =""; $driver_number = ""; $helper_name = "";
                if(!empty($tripsheet_number))
                {
                    $driver_name = $obj->getTableColumnValue($GLOBALS['tripsheet_table'],'tripsheet_number',$tripsheet_number,'driver_name');
                    if(!empty($driver_name))
                    {
                        $driver_name = $obj->encode_decode("decrypt",$driver_name);
                    }
                    $driver_number = $obj->getTableColumnValue($GLOBALS['tripsheet_table'],'tripsheet_number',$tripsheet_number,'driver_number');
                    if(!empty($driver_number))
                    {
                        $driver_number = $obj->encode_decode("decrypt",$driver_number);
                    }
                    $helper_name = $obj->getTableColumnValue($GLOBALS['tripsheet_table'],'tripsheet_number',$tripsheet_number,'helper_name');
                    if(!empty($helper_name))
                    {
                        $helper_name = $obj->encode_decode("decrypt",$helper_name);
                        echo "Driver Name : ".$driver_name.", Helper Name - ".$helper_name."$$$".$driver_number;
                    }
                    else {                        
                        echo "Driver Name : ".$driver_name."$$$".$driver_number;
                    }
                }
            }
            /*
            elseif($is_luggagesheet_entry == '' && $godown_id != 'NULL')
            {
                $godown_name =""; $godown_number = "";
                if($godown_id != ''){
                    $godown_name = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'name');
                    if(!empty($godown_name))
                    {
                        $godown_name = $obj->encode_decode("decrypt",$godown_name);
                    }
                    $godown_number = $obj->getTableColumnValue($GLOBALS['godown_table'],'godown_id',$godown_id,'mobile_number');
                    echo $godown_name."$$$".$godown_number;
                }
            }*/
            else
            {
                $organization_details = array(); $organization_number = ""; $organization_address1 =""; $organization_address2 =""; $organization_city = ""; 
                $organization_gst_number =""; $organization_pincode =""; $organization_state =""; $organization_name ="";
                $organization_details = $obj->getTableRecords($GLOBALS['organization_table'],'','');
                foreach($organization_details as $data)
                {
                    if(!empty($data['name']))
                    {
                        $organization_name = $obj->encode_decode("decrypt",$data['name'])."<br>";
                    }
                    if(!empty($data['address_line1']) && $data['address_line1'] != 'NULL')
                    {
                        $organization_address1 = $obj->encode_decode("decrypt",$data['address_line1'])."<br>";
                    }
                    if(!empty($data['address_line2']) && $data['address_line2'] != 'NULL')
                    {
                        $organization_address2 = $obj->encode_decode("decrypt",$data['address_line2'])."<br>";
                    }
                    if(!empty($data['city']) && $data['city'] != 'NULL')
                    {
                        $organization_city = $obj->encode_decode("decrypt",$data['city'])."<br>";
                    }
                    if(!empty($data['pincode']) && $data['pincode'] != 'NULL')
                    {
                        $organization_pincode = $obj->encode_decode("decrypt",$data['pincode'])."<br>";
                    }
                    if(!empty($data['state']) && $data['state'] != 'NULL')
                    {
                        $organization_state = $obj->encode_decode("decrypt",$data['state'])."<br>";
                    }
                    if(!empty($data['gst_number']) && $data['gst_number'] != 'NULL')
                    {
                        $organization_gst_number = $obj->encode_decode("decrypt",$data['gst_number'])."<br>";
                    }
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != 'NULL')
                    {
                        $organization_number = $obj->encode_decode("decrypt",$data['mobile_number'])."<br>";
                    }
                }
                
                //echo $organization_name."".$organization_address1."".$organization_address2."".$organization_city."".$organization_pincode."".$organization_state."$$$".$organization_number;
                echo $organization_name.$organization_city."$$$".$organization_number;
            }
        }
    }
    if(isset($_REQUEST['lr_row_index'])) {
		$lr_row_index = $_REQUEST['lr_row_index'];
		$selected_lr_number = $_REQUEST['selected_lr_number'];
        $from_date = $_REQUEST['from_date'];
        $to_date = $_REQUEST['to_date'];
        $consignor_id = $_REQUEST['consignor_id'];
        $branch_id = $_REQUEST['selected_branch_id'];
        $organization_id = $_REQUEST['organization_id'];

        $where= "";
        if(!empty($consignor_id)) {
            
            $where = "consignor_id = '".$consignor_id."'";
            
        }
        if(!empty($organization_id)) {
            if(!empty($where)) {
                $where = $where." AND organization_id = '".$organization_id."'";
            }
            else {
                $where = "organization_id = '".$organization_id."'";
            }
        }
        if(!empty($branch_id)) {
            if(!empty($where)) {
                $where = $where." AND branch_id = '".$branch_id."'";
            }
            else {
                $where = "branch_id = '".$branch_id."'";
            }
        }
        if(!empty($from_date)) {
            $from_date = date("Y-m-d", strtotime($from_date));
            if(!empty($where)) {
                $where = $where." AND lr_date >= '".$from_date."'";
            }
            else {
                $where = "lr_date >= '".$from_date."'";
            }
        }
        
        if(!empty($to_date)) {
            $to_date = date("Y-m-d", strtotime($to_date));
            if(!empty($where)) {
                $where = $where." AND lr_date <= '".$to_date."'";
            }
            else {
                $where = "lr_date <= '".$to_date."'";
            }
        }

        // $select_lr_query = "SELECT lr_number FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0' ";
        // $lr_query_list = $obj->getQueryRecords($GLOBALS['lr_table'],$select_lr_query);
        // foreach($lr_query_list as $list)
        // {
        //     $lr_list[] = $list['lr_number'];
        // }

        if((!empty($from_date) || !empty($to_date) && !empty($consignor_id)))
        {
            $lr_list = array();
            $select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0' AND invoice_status ='O' ";
            $lr_list = $obj->getQueryRecords($GLOBALS['lr_table'],$select_query);
    
        
        // $lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'lr_number',$selected_lr_number);

            $organization_id = ""; $lr_date = ""; $lr_number = ""; $consignor_id = ""; $consignee_id = ""; $quantity = ""; $unit_id = ""; $price_per_qty = ""; $amount = "";  $consginor_name = ""; $organization_name = ""; $consignee_name = "";  $consginor_name = ""; $bill_type = "";

            
            if(!empty($lr_list ))
            {
                foreach($lr_list as $data)
                {
                    if(!empty($data['organization_id']))
                    {
                        $organization_id = $data['organization_id'];
                    }
                    if(!empty($data['lr_date']))
                    {
                        $lr_date = $data['lr_date'];
                    }
                    if(!empty($data['lr_number']))
                    {
                        $lr_number = $data['lr_number'];
                    }
                    if(!empty($data['consignee_id']))
                    {
                        $consignee_id = $data['consignee_id'];
                    }
                    if(!empty($data['consignor_id']))
                    {
                        $consignor_id = $data['consignor_id'];
                    }
                    if(!empty($data['quantity']))
                    {
                        $quantity = $data['quantity'];
                    }
                    if(!empty($data['price_per_qty']))
                    {
                        $price_per_qty = $data['price_per_qty'];
                    }
                    if(!empty($data['bill_type']))
                    {
                        $bill_type = $data['bill_type'];
                    }
                    if(!empty($data['unit_id']))
                    {
                        $unit_id = $data['unit_id'];
                    }
                    if(!empty($data['amount']))
                    {
                        $amount = $data['amount'];
                    }
                
                    if(!empty($organization_id))
                    {
                        $organization_name = $obj->getTableColumnValue($GLOBALS['organization_table'],'organization_id',$organization_id,'name');
                        if(!empty($organization_name))
                        {
                            $organization_name = $obj->encode_decode("decrypt",$organization_name);
                        }
                    }
                    ?>

                    <tr class="lr_row" id="lr_row<?php if(!empty($lr_row_index)) { echo $lr_row_index; } ?>">
                        <td class="text-center sno">
                        </td>
                        <td>
                        <?php echo date('d-m-Y',strtotime($lr_date)); ?>
                        </td>
                        <td>
                        <?php echo $lr_number; ?>
                        <input type="hidden" name="lr_numbers[]" value="<?php if(!empty($lr_number)){ echo $lr_number; }?>">
                        </td>
                        <td>
                            <?php 
                                if(!empty($consignor_id))
                                {
                                $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'],'consignor_id',$consignor_id,'name');
                                    if(!empty($consignor_name))
                                    {
                                        $consignor_name = $obj->encode_decode("decrypt",$consignor_name);
                                    }
                                    echo $consignor_name;
                                }
                            ?>
                        </td>
                        <td>
                            <?php 
                                if(!empty($consignee_id))
                                {
                                    $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$consignee_id,'name');
                                    if(!empty($consignee_name))
                                    {
                                        $consignee_name = $obj->encode_decode("decrypt",$consignee_name);
                                    }
                                    echo $consignee_name;
                                }
                            ?>
                        </td>
                        <td>
                            <?php if(!empty($quantity)){ echo $quantity; }?>
                        </td>
                        
                        <td class="sub_unit_qty">
                            <?php if(!empty($unit_id)){
                                    $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id,'unit_name');
                                    if(!empty($unit_name))
                                    {
                                        $unit_name = $obj->encode_decode("decrypt",$unit_name);
                                    }
                                    echo $unit_name;
                                }?>
                            
                        </td>
                        <td class="pirce_per_quantity">
                            <?php if(!empty($price_per_qty)){ echo $price_per_qty; }?>

                        </td>
                        
                        <td class="text-right amount ">
                            <?php if(!empty($amount)) { echo $amount; } ?>
                        </td>

                        <td class="text-right ">
                            <?php if(!empty($bill_type)) { echo $bill_type; } ?>
                        </td>
                        
                        <td class="text-center">
                            <button class="btn btn-danger align-self-center px-3 py-2" type="button" onclick="Javascript:DeleteLrRow('<?php if(!empty($lr_row_index)) { echo $lr_row_index; } ?>','<?php echo $lr_number ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>    
                    </tr>
                    <?php 
                }
            }
            else
            {
                echo "No records found";
            }
        }
        ?>
		
		<?php        
	}

    if(isset($_REQUEST['selected_lr_row_index'])) {
		$lr_row_index = $_REQUEST['selected_lr_row_index'];
		$selected_lr_number = $_REQUEST['selected_lr_number'];
        $from_date = $_REQUEST['from_date'];
        $to_date = $_REQUEST['to_date'];
        $consignor_id = $_REQUEST['consignor_id'];
        $branch_id = $_REQUEST['selected_branch_id'];
        $organization_id = $_REQUEST['organization_id'];
        
        $where= "";
        if(!empty($consignor_id)) {
            
            $where = "consignor_id = '".$consignor_id."'";
            
        }
        
        if(!empty($selected_lr_number)) {
            if(!empty($where)) {
                $where = $where." AND lr_number = '".$selected_lr_number."'";
            }
            else {
                $where = "lr_number = '".$selected_lr_number."'";
            }
        }
        

        // $select_lr_query = "SELECT lr_number FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0' ";
        // $lr_query_list = $obj->getQueryRecords($GLOBALS['lr_table'],$select_lr_query);
        // foreach($lr_query_list as $list)
        // {
        //     $lr_list[] = $list['lr_number'];
        // }


        $lr_list = array();
        $select_query = "SELECT * FROM ".$GLOBALS['lr_table']." WHERE ".$where." AND deleted = '0'  AND invoice_status ='O' ";
        $lr_list = $obj->getQueryRecords($GLOBALS['lr_table'],$select_query);


        // $lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'lr_number',$selected_lr_number);

        $organization_id = ""; $lr_date = ""; $lr_number = ""; $consignor_id = ""; $consignee_id = ""; $quantity = array(); $unit_id = array(); $price_per_qty = ""; $amount = "";  $consginor_name = ""; $organization_name = ""; $consignee_name = "";  $consginor_name = ""; $bill_type = ""; $total = 0;

        
        if(!empty($lr_list ))
        {
            foreach($lr_list as $data)
            {
                if(!empty($data['organization_id']))
                {
                    $organization_id = $data['organization_id'];
                }
                if(!empty($data['lr_date']))
                {
                    $lr_date = $data['lr_date'];
                }
                if(!empty($data['lr_number']))
                {
                    $lr_number = $data['lr_number'];
                }
                if(!empty($data['consignee_id']))
                {
                    $consignee_id = $data['consignee_id'];
                }
                if(!empty($data['consignor_id']))
                {
                    $consignor_id = $data['consignor_id'];
                }
                if(!empty($data['quantity']))
                {
                    $quantity = $data['quantity'];
                    $quantity = explode(",", $quantity);
                }
                if(!empty($data['price_per_qty']))
                {
                    $price_per_qty = $data['price_per_qty'];
                }
                if(!empty($data['bill_type']))
                {
                    $bill_type = $data['bill_type'];
                }
                if(!empty($data['unit_id']))
                {
                    $unit_id = $data['unit_id'];
                    $unit_id = explode(",", $unit_id);
                }
                if(!empty($data['amount']))
                {
                    $amount = $data['amount'];
                }

                if(!empty($data['total']))
                {
                    $total = $data['total'];
                }
            
                if(!empty($organization_id))
                {
                    $organization_name = $obj->getTableColumnValue($GLOBALS['organization_table'],'organization_id',$organization_id,'name');
                    if(!empty($organization_name))
                    {
                        $organization_name = $obj->encode_decode("decrypt",$organization_name);
                    }
                }
                ?>

                <tr class="lr_row" id="lr_row<?php if(!empty($lr_row_index)) { echo $lr_row_index; } ?>">
                    <td class="text-center sno">
                    </td>
                    <td>
                    <?php echo date('d-m-Y',strtotime($lr_date)); ?>
                    </td>
                    <td>
                    <?php echo $lr_number; ?>
                    <input type="hidden" name="lr_numbers[]" value="<?php if(!empty($lr_number)){ echo $lr_number; }?>">
                    </td>
                    <td>
                        <?php 
                            if(!empty($consignor_id))
                            {
                            $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'],'consignor_id',$consignor_id,'name');
                                if(!empty($consignor_name))
                                {
                                    $consignor_name = $obj->encode_decode("decrypt",$consignor_name);
                                }
                                echo $consignor_name;
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            if(!empty($consignee_id))
                            {
                                $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$consignee_id,'name');
                                if(!empty($consignee_name))
                                {
                                    $consignee_name = $obj->encode_decode("decrypt",$consignee_name);
                                }
                                echo $consignee_name;
                            }
                        ?>
                    </td>
                    <td>
                        <?php if(!empty($quantity)) 

                        for($i = 0; $i < count($quantity); $i++) {
                            if(!empty($unit_id)){
                            
                                $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id[$i],'unit_name');
                                $unit_name = $obj->encode_decode("decrypt", $unit_name);
                            }

                            echo $quantity[$i]. " / ".$unit_name; ?> <br>
                       <?php }

                        ?>
                    </td>
                    
                    <!-- <td class="sub_unit_qty">
                        <?php if(!empty($unit_id)){
                                $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'],'unit_id',$unit_id,'unit_name');
                                if(!empty($unit_name))
                                {
                                    $unit_name = $obj->encode_decode("decrypt",$unit_name);
                                }
                                echo $unit_name;
                            }?>
                        
                    </td> -->
                    <td class="pirce_per_quantity">
                        <?php if(!empty($price_per_qty)){ echo $price_per_qty; }?>

                    </td>
                    
                    <td class="text-right amount ">
                        <?php /* if(!empty($amount)) { echo $amount; } */ ?>
                        <?php if(!empty($total)) { echo $total; } ?>
                    </td>

                    <td class="text-right ">
                        <?php if(!empty($bill_type)) { echo $bill_type; } ?>
                    </td>
                    
                    <td class="text-center">
                        <button class="btn btn-danger align-self-center px-3 py-2" type="button" onclick="Javascript:DeleteLrRow('<?php if(!empty($lr_row_index)) { echo $lr_row_index; } ?>','<?php echo $lr_number; ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </td>    
                </tr>
                <?php 
                }
            }
        ?>
		<script type="text/javascript">
			calTotal();
		</script>  
		<?php        
	}
    if(isset($_REQUEST['get_lr_number']))
    {
        $lr_number = $_REQUEST['get_lr_number'];
        $lr_details = array(); $consignor_details = array();$consignee_details =array(); $bill_type = ""; $bundle_qty = ""; $bill_total =0;
        $lr_details = $obj->getTableRecords($GLOBALS['lr_table'],'lr_number',$lr_number);
        foreach($lr_details as  $data)
        {
            if(!empty($data['consignor_details']))
            {
                $consignor_details =$obj->encode_decode("decrypt",$data['consignor_details']);
            }
            if(!empty($data['consignee_details']))
            {
                $consignee_details =$obj->encode_decode("decrypt",$data['consignee_details']);
            }
            if(!empty($data['bill_type']))
            {
                $bill_type =$data['bill_type'];
            }
            if(!empty($data['quantity']))
            {
                $bundle_qty =$data['quantity'];
            }
            if(!empty($data['amount']))
            {
                $bill_total =$data['amount'];
            }
        }
        if(!empty($consignor_details))
        {
            $consignor_details = explode("$$$",$consignor_details);
        }
        if(!empty($consignee_details))
        {
            $consignee_details = explode("$$$",$consignee_details);
        }
        $consignor = "";
        for($i=0;$i<count($consignor_details);$i++)
        {
            if($i == '0')
            {
                if($consignor_details[$i] != 'NULL')
                {
                    $consignor = $consignor_details[$i];
                }
            }
            else
            {
                if($consignor_details[$i] != 'NULL')
                {
                    $consignor = $consignor." ".$consignor_details[$i];
                }
            }
        }
        $consignee = "";
        for($i=0;$i<count($consignee_details);$i++)
        {
            if($i == '0')
            {
                if($consignee_details[$i] != 'NULL')
                {
                    $consignee = $consignee_details[$i];
                }
            }
            else
            {
                if($consignee_details[$i] != 'NULL')
                {
                    $consignee = $consignee." ".$consignee_details[$i];
                }
            }
        }
        ?>
        <div class="form-label-group in-border pb-2  border" style="font-size:14px;padding:10px;">
            <div class="row">
                <div class="col-lg-12 col-md-4 col-6 text-center" style="color:#810304;font-weight:bold">
                    <?php echo "LR Details"; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    Consignor
                </div>
                <div class="col-lg-9 col-md-4 col-6">
                    <?php echo ": ".$consignor; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    Consignee 
                </div>
                <div class="col-lg-9 col-md-4 col-6">
                    <?php echo ": ".$consignee; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    Bill type
                </div>
                <div class="col-lg-9 col-md-4 col-6">
                    <?php echo ": ".$bill_type; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    Bundle Qty 
                </div>
                <div class="col-lg-9 col-md-4 col-6">
                    <?php echo ": ".$bundle_qty; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    Bill Total 
                </div>
                <div class="col-lg-9 col-md-4 col-6">
                    <?php echo ": ".$bill_total; ?>
                </div>
            </div>
        </div>
   <?php }
    if(isset($_REQUEST['get_details_vehicle_id'])) {
		$get_details_vehicle_id = "";
		$get_details_vehicle_id = $_REQUEST['get_details_vehicle_id'];

		$name = ""; $address = ""; $city = ""; $mobile_number = ""; $vehicle_number = "";
        if(!empty($get_details_vehicle_id)) {
            $vehicle_list = array(); $vehicle_details = "";
            $vehicle_list = $obj->getTableRecords($GLOBALS['vehicle_table'], 'vehicle_id', $get_details_vehicle_id);
            if(!empty($vehicle_list)) {
				foreach($vehicle_list as $data) {
					if(!empty($data['name'])) {
						$name = $obj->encode_decode('decrypt', $data['name']);
					}
                    if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
						$mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
					}
                    if(!empty($data['vehicle_number']) && $data['vehicle_number'] != $GLOBALS['null_value']) {
						$vehicle_number = $obj->encode_decode('decrypt', $data['vehicle_number']);
					}
                    
				}
				$vehicle_details = array('name' => $name, 'mobile_number' => $mobile_number,'vehicle_number' => $vehicle_number);
            }
        }
		if(!empty($vehicle_details)) {
			$vehicle_details = json_encode($vehicle_details);
		}
		echo $vehicle_details;
		exit;
	}
    if(isset($_REQUEST['branch_id'])) {
		$branch_id = "";
        $branch_id = $_REQUEST['branch_id'];
        $organization_id = $_REQUEST['organization_id'];
		
		if(!empty($branch_id)) {
            $lr_list = array();
			// $lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'branch_id',$branch_id);  
            echo $select_query ="SELECT * FROM ".$GLOBALS['lr_table']." WHERE branch_id = '".$branch_id."' AND organization_id = '".$organization_id."' AND is_tripsheet_entry = '0' AND deleted = '0' AND cancelled = '0'  "; 
            $lr_list = $obj->getQueryRecords($GLOBALS['lr_table'],$select_query);

             ?>

            <option value="">Select LR No</option>
            <?php
            foreach($lr_list as $data){
                ?>
                <option value="<?php if(!empty($data['lr_number'])) { echo $data['lr_number']; } ?>" <?php if(!empty($lr_number) && $data['lr_number'] == $lr_number) { ?> selected <?php } ?> >
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
	
	}
    if(isset($_REQUEST['consignor_branch_id'])) {
		$branch_id = "";
        $branch_id = $_REQUEST['consignor_branch_id'];
        $organization_id = $_REQUEST['consignor_organization_id'];
		
		if(!empty($branch_id)) {
            $lr_list = array(); $consignor_name = "";
			// $lr_list = $obj->getTableRecords($GLOBALS['lr_table'],'branch_id',$branch_id);  
           $select_query ="SELECT * FROM ".$GLOBALS['lr_table']." WHERE branch_id = '".$branch_id."' AND organization_id = '".$organization_id."' AND invoice_status = 'O' AND deleted = '0' AND cancelled = '0'  "; 
            $lr_list = $obj->getQueryRecords($GLOBALS['lr_table'],$select_query);
             ?>

            <option value="">Select Consignor</option>
            <?php
            foreach($lr_list as $data){
                ?>
                <option value="<?php if(!empty($data['consignor_id'])) { echo $data['consignor_id']; } ?>" <?php if(!empty($consignor_id) && $data['consignor_id'] == $consignor_id) { ?> selected <?php } ?> >
                    <?php
                        if(!empty($data['consignor_id']))
                        {
                            $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'],'consignor_id',$data['consignor_id'],'name');
                        }
                        if(!empty($consignor_name)) {
                            $consignor_name = $obj->encode_decode('decrypt', $consignor_name);
                            echo $consignor_name;
                           
                        }
                    ?>
                </option>
                <?php
            }
                		
		}
	
	}
    if(isset($_REQUEST['lr_id']))
    {
        $lr_id = $_REQUEST['lr_id']; $consignee_name = ""; $consignee_number = "";
        $consignee_id = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_id',$lr_id,'consignee_id');
        if(!empty($consignee_id))
        {
            $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$consignee_id,'name');
            if(!empty($consignee_name))
            {
                $consignee_name = $obj->encode_decode("decrypt",$consignee_name);
            }
            $consignee_number = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$consignee_id,'mobile_number');
            if(!empty($consignee_number))
            {
                $consignee_number = $obj->encode_decode("decrypt",$consignee_number);
            }
        }
        echo $consignee_name."$$$".$consignee_number;
    }
    if(isset($_REQUEST['clear_lr_number']))
    {
        $clear_lr_number = $_REQUEST['clear_lr_number']; $consignee_name = ""; $consignee_number = "";
        $consignee_id = $obj->getTableColumnValue($GLOBALS['lr_table'],'lr_number',$clear_lr_number,'consignee_id');
        if(!empty($consignee_id))
        {
            $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$consignee_id,'name');
            if(!empty($consignee_name))
            {
                $consignee_name = $obj->encode_decode("decrypt",$consignee_name);
            }
            $consignee_number = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$consignee_id,'mobile_number');
            if(!empty($consignee_number))
            {
                $consignee_number = $obj->encode_decode("decrypt",$consignee_number);
            }
        }
        echo $consignee_name."$$$".$consignee_number;
    }
    if(isset($_REQUEST['load_lorry_no'])){
        $load_lorry_no = $_REQUEST['load_lorry_no'];
        $lorry_id = $_REQUEST['lorry_id'];

        $lorry_list = array();
        $lorry_list = $obj->getTableRecords($GLOBALS['lorry_table'], 'id', $lorry_id);

        $lorry_number = ""; $lorry_mobile_number = "";
        if(!empty($lorry_list)){
            foreach($lorry_list as $lorry){
                if(!empty($lorry['lorry_number'])){
                    $lorry_number = $obj->encode_decode('decrypt', $lorry['lorry_number']);
                }
                if(!empty($lorry['mobile_number'])){
                    $lorry_mobile_number = $obj->encode_decode('decrypt', $lorry['mobile_number']);
                }
            }
        }
        
        echo $lorry_number.'$$$'.$lorry_mobile_number;

    }
    if(isset($_REQUEST['product_row_index'])) {
        $product_row_index = $_REQUEST['product_row_index'];
        $selected_quantity = $_REQUEST['selected_quantity'];
        $selected_unit_id = $_REQUEST['selected_unit_id'];
        $selected_rate = $_REQUEST['selected_rate'];
        $selected_amount = $_REQUEST['selected_amount']; ?>

        <tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
            <td class="text-center sno">
            </td>
            <td colspan="2" class="text-center">
                <?php
                    if(!empty($selected_unit_id)) {
                        $unit_name = $obj->getTableColumnValue($GLOBALS['unit_table'], 'unit_id', $selected_unit_id, 'unit_name'); ?>
                        <input type="hidden" name="unit_name[]" value="<?php if(!empty($unit_name)) { echo $unit_name; } ?>">
                        <?php if(!empty($unit_name)) {
                            $unit_name = $obj->encode_decode('decrypt', $unit_name);
                            echo $unit_name;
                        }
                ?>
                        <input type="hidden" name="unit_id[]" value="<?php if(!empty($selected_unit_id)) { echo $selected_unit_id; } ?>">
                <?php        
                    }
                ?>
            </td>
            <td>
                <input type="number" name="quantity[]" class="form-control w-100 text-center" onkeyup="Javascript:ProductRowCheck(this);" value="<?php if(!empty($selected_quantity)) { echo $selected_quantity; } ?>">
            </td>
            
            <td class="text-center">
                <input type="hidden" name="rate[]" class="form-control w-100" onkeyup="Javascript:ProductRowCheck(this);" value="<?php if(!empty($selected_rate)) { echo $selected_rate; } ?>">
                <?php if(!empty($selected_rate)) { echo $selected_rate; } ?>
            </td>
            
            <td class="text-right amount <?php if(empty($discount_lock)) { echo "discount_products"; } ?>">
                <?php if(!empty($selected_amount)) { echo $selected_amount; } ?>
            </td>
            <td class="text-center">
                <button class="btn btn-danger align-self-center px-3 py-2" type="button" onclick="Javascript:DeleteProductRow('<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>');"> <i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>    
        </tr>
        <script type="text/javascript">
            ShowGST();
        </script>  
        <?php        
    }
    if(isset($_REQUEST['main_client'])){
        $main_client = ""; $search_text = ""; $hid_client_id = "";
        if(isset($_REQUEST['main_client'])){
            $main_client = $_REQUEST['main_client'];
        }

        if(isset($_REQUEST['search_text'])){
            $search_text = $_REQUEST['search_text'];
        }

        if(isset($_REQUEST['hid_client_id'])){
            $hid_client_id = $_REQUEST['hid_client_id'];
        }

        $client_list = array();
		$client_list = $obj->getTableRecords($GLOBALS['client_table'],'','');

        if(!empty($search_text)) {
			$search_text = strtolower($search_text);
			$list = array();
			if(!empty($client_list)) {
				foreach($client_list as $val) {
					if( (strpos(strtolower($obj->encode_decode('decrypt', $val['name'])), $search_text) !== false) ) {
						$list[] = $val;
					}
				}
			}
			$client_list = $list;
		}

        if(!empty($client_list)){
            $sno = 1;
            foreach($client_list as  $client){
                $client_id = $client['client_id'];
                $client_name = $obj->encode_decode('decrypt', $client['name']);
                
                if($client_id != $main_client){
                    ?>
                    <tr class="product_row" id="product_row<?php if(!empty($product_row_index)) { echo $product_row_index; } ?>">
                        <td class="text-center sno"><?php echo $sno; ?>
                        </td>
                        <td>
                            <?php if(!empty($client_name)) { echo $client_name; } ?>
                        </td>
                        <td>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <div class="w-100">
                                        <label class="switch">
                                            <input type="checkbox" onchange="Javascript:check_merge(this.checked, '<?php echo $client_id; ?>')" name="merge_client_id[]" <?php if(strpos($hid_client_id, $client_id) !== false){ echo "checked"; } ?> value="<?php echo $client_id; ?>">
                                            <div class="slider round"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php $sno++; 
                } ?>
                <?php
            } ?>
            <?php
        }
    }
    if(isset($_REQUEST['getClient'])){
        $client_id = "";
        
    }
    // if(isset($_REQUEST['get_city']))
    // {
    //     $district = $_REQUEST['get_district'];
    //     if(!empty($district))
    //     {
    //         $district =$obj->encode_decode("encrypt",$district);
    //     }
    //     $consignee_cities ="NULL"; $consingee_select_query="";
        
    //     $consingee_select_query ="SELECT DISTINCT(others_city) as city FROM ".$GLOBALS['consignee_table']." WHERE district ='".$district."' AND deleted ='0' ";
    //     $lr_list =$obj->getQueryRecords($GLOBALS['consignee_table'],$consingee_select_query);
    //     foreach($lr_list as $data)
    //     {
    //         if(!empty($data['city']))
    //         {
    //             if($consignee_cities == 'NULL')
    //             {
    //                 $consignee_cities =trim($data['city']);
    //             }
    //             else
    //             {
    //                 $consignee_cities =$consignee_cities.",".trim($data['city']);
    //             }
    //         }
            
    //     }
    //     if(!empty($consignee_cities) && $consignee_cities != 'NULL')
    //     {
    //         echo trim($consignee_cities);
    //     }
    //     exit;
    // }

    
	if(isset($_REQUEST['get_city'])) {
		$district = $_REQUEST['get_district'];

		if(!empty($district))
		{
			$district = $obj->encode_decode("encrypt",$district);
		}

		$city = ""; $list = array();

		$list = $obj->getOtherCityList($district);
		foreach($list as $data) {
			if(!empty($data['city'])) {
				$data['city'] = $obj->encode_decode("decrypt",$data['city']);
				if(!empty($city)) {
					$city = $city.",".trim($data['city']);
				}
				else {
					$city = $data['city'];
				}
			}
			
		}
		if(!empty($city)) {
			echo trim($city);
		}
		exit;
	}
	
	if(isset($_REQUEST['others_city'])) {
		$other_city = $_REQUEST['others_city'];
		$selected_district_index = $_REQUEST['selected_district'];
		$form_name = $_REQUEST['form_name'];

		if($other_city == '1')
		{ 
			?>
			<div class="form-group">
				<div class="form-label-group in-border">
					<input type="text" id="others_city" name="others_city" class="form-control shadow-none" value="" onkeydown="Javascript:KeyboardControls(this,'text',30,1);">
					<label>Others city <span class="text-danger">*</span></label>
				</div>
				<div class="new_smallfnt">Text Only (Max Char : 30)</div>
			</div>
			<?php 
		}
	}
?>
