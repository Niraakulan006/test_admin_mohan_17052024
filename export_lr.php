<?php
include("include_files.php");
if(isset($_REQUEST['from_date'])) {

		$search_text = ""; $from_date = ""; $to_date = ""; $branch_id =""; $consignee_id = ""; $bill_type = ""; $lr_number = ""; $organization_id = "";$consignor_id = ""; $filter_gst_type = "";

		if(isset($_REQUEST['search_text'])) {

			$search_text = $_REQUEST['search_text'];

		}

        if(isset($_REQUEST['from_date']))

        {

            $from_date = $_REQUEST['from_date'];

        }

        if(isset($_REQUEST['to_date']))

        {

            $to_date = $_REQUEST['to_date'];

        }

        if(isset($_REQUEST['bill_type']))

        {

            $bill_type = $_REQUEST['bill_type'];

        }

        $show_bill = "";

		if(isset($_REQUEST['show_bill'])){

			$show_bill = $_REQUEST['show_bill'];

		}

        if(isset($_REQUEST['branch_id']))

        {

            $branch_id = $_REQUEST['branch_id'];

        }

        if(isset($_REQUEST['consignee_id']))

        {

            $consignee_id = $_REQUEST['consignee_id'];

        }

        if(isset($_REQUEST['consignor_id']))
        {
            $consignor_id = $_REQUEST['consignor_id'];
        }
        if(isset($_REQUEST['filter_gst_type']))
        {
            $filter_gst_type = $_REQUEST['filter_gst_type'];
        }
		$total_records_list = array();

            if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {

				if($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'] == $GLOBALS['godown_staff_user_type']) {

                    $godown_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_godown'];

                    $total_records_list = $obj->getLRDetailsList('',$organization_id,$branch_id,$consignee_id,$consignor_id,$bill_type,$show_bill,$from_date, $to_date,$godown_id, $filter_gst_type);

				}

				else {

					// $total_records_list = $obj->getTableRecords($GLOBALS['godown_table'], '', '');

                    $total_records_list = $obj->getLRDetailsList('',$organization_id,$branch_id,$consignee_id,$consignor_id,$bill_type,$show_bill,$from_date, $to_date,'', $filter_gst_type);

                }

            }

			// $total_records_list = $obj->getLRDetailsList('',$organization_id,$branch_id,$consignee_id,$consignor_id,$bill_type,$show_bill,$from_date, $to_date);

		if(!empty($search_text)) {

			$search_text = strtolower($search_text);

			$list = array();

			if(!empty($total_records_list)) {

				foreach($total_records_list as $val) {

					if( (strpos(strtolower($val['lr_number']), $search_text) !== false) ) {

						$list[] = $val;

					}

				}

			}

			$total_records_list = $list;

		}




		$max_lr_number = "";
        //$max_lr_number = $obj->automate_number($GLOBALS['lr_table'], 'lr_number', '', '');
        //echo "max_lr_number - ".$max_lr_number;

		$prefix = 0;

		if(!empty($page_number) && !empty($page_limit)) {

			$prefix = ($page_number * $page_limit) - $page_limit;

		} ?>

        <script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
        <table class="table nowrap cursor text-center bg-white tbl_lr_list" style='display:none;' id="tbl_lr_list">

            <thead class="bg-light">

                <tr>

                    <!-- <th>#</th> -->

                    <th>S.No</th>

                    <th>L.R.No / Date</th>

                    <th>Consignor</th>

                    <th>Consignee</th>

                    <th>Branch</th>

                    <th>Amount</th>

                    <th>Bill Type</th>

                    <th>Invoice No / Date</th>

                </tr>

            </thead>

            <tbody>

            <?php

                if(!empty($total_records_list)) {

                    $quantity = array();$total_quantity = 0;

                    // $edit_action = $obj->encode_decode('encrypt', 'edit_action');

                    foreach($total_records_list as $key => $data) {

                        $index = $key + 1; $consignee_name = ""; $consignor_name = "";

                        if(!empty($prefix)) { $index = $index + $prefix; }

                        $print_type = "";

                        if(empty($data['is_tripsheet_entry']))

                        { ?>

                            <tr>

                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>');"><?php echo $index; ?></td>

                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>');">



                                <?php

                                    if(!empty($data['lr_number'])) {

                                        // $data['lr_number'] = $obj->encode_decode('decrypt', $data['lr_number']);

                                        echo $data['lr_number']."<br>";

                                    }

                                    if(!empty($data['lr_date']) ) {

                                        echo date("d-m-Y", strtotime($data['lr_date']));

                                    }

                                    if(!empty($data['cancelled'])) {

                                ?>

                                        <br><span style="color: red;">Cancelled</span>

                                <?php

                                    }

                                ?></td>

                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>');">

                                    <?php

                                        if(!empty($data['consignor_id']))

                                        {

                                            $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'],'consignor_id',$data['consignor_id'],'name');

                                            if(!empty($consignor_name))

                                            {

                                                $consignor_name = $obj->encode_decode("decrypt",$consignor_name);

                                            }

                                            echo $consignor_name;
                                            $consignor_mobile_numer = "";
                                            $consignor_mobile_numer = $obj->getTableColumnValue($GLOBALS['consignor_table'],'consignor_id',$data['consignor_id'],'mobile_number');
                                            if(!empty($consignor_mobile_numer) && $consignor_mobile_numer != $GLOBALS['null_value']) {
                                                $consignor_mobile_numer = $obj->encode_decode("decrypt",$consignor_mobile_numer);
                                                echo "<br>".$consignor_mobile_numer;
                                            }

                                        }

                                    ?>

                                </td>

                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>');">

                                    <?php

                                        if(!empty($data['consignee_id']))

                                        {

                                            $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$data['consignee_id'],'name');

                                            if(!empty($consignee_name))

                                            {

                                                $consignee_name = $obj->encode_decode("decrypt",$consignee_name);


                                            }

                                            echo $consignee_name;
                                            $consignee_mobile_numer = "";
                                            $consignee_mobile_numer = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$data['consignee_id'],'mobile_number');
                                            if(!empty($consignee_mobile_numer) && $consignee_mobile_numer != $GLOBALS['null_value']) {
                                                $consignee_mobile_numer = $obj->encode_decode("decrypt",$consignee_mobile_numer);
                                                echo "<br>".$consignee_mobile_numer;
                                            }

                                        }

                                        if(empty($consignee_name) && !empty($data['account_party_id'])){

                                            $account_party_name = "";

                                            $account_party_name = $obj->getTableColumnValue($GLOBALS['account_party_table'],'account_party_id',$data['account_party_id'],'name');

                                            if(!empty($account_party_name)){

                                                $account_party_name = $obj->encode_decode('decrypt',$account_party_name);

                                            }

                                            echo $account_party_name." (Acc.Party)";
                                            $account_party_mobile_numer = "";
                                            $account_party_mobile_numer = $obj->getTableColumnValue($GLOBALS['account_party_table'],'account_party_id',$data['account_party_id'],'mobile_number');
                                            if(!empty($account_party_mobile_numer) && $account_party_mobile_numer != $GLOBALS['null_value']) {
                                                $account_party_mobile_numer = $obj->encode_decode("decrypt",$account_party_mobile_numer);
                                                echo "<br>".$account_party_mobile_numer;
                                            }

                                        }

                                    ?>

                                </td>

                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>');">

                                    <?php
                                        $consignee_city = "";
                                        if(!empty($data['consignee_city'])) {
                                            $consignee_city = $obj->encode_decode("decrypt",$data['consignee_city']);
                                        }
                                        else if(!empty($data['others_consignee_city'])) {
                                            $consignee_city = $obj->encode_decode("decrypt",$data['others_consignee_city']);
                                        }
                                        if(!empty($consignee_city)) {
                                            echo $consignee_city;
                                            if(!empty($data['branch_id'])) {
                                                $branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$data['branch_id'],'name');
                                                if(!empty($branch_name)) {
                                                    $branch_name = $obj->encode_decode("decrypt",$branch_name);
                                                    echo " - ".$branch_name;
                                                }
                                            }
                                        }
                                    ?>

                                </td>

                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>');"><?php if(!empty($data['total'])){ echo $data['total']; }?></td>

                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>');"><?php if(!empty($data['bill_type'])){ echo $data['bill_type']; }?></td>

                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>');">

                                    <?php  if(!empty($data['invoice_number']) && $data['invoice_number'] != $GLOBALS['null_value']) {

                                        // $data['lr_number'] = $obj->encode_decode('decrypt', $data['lr_number']);

                                        echo $data['invoice_number']."<br>";

                                    }

                                    if(!empty($data['invoice_date'] && $data['invoice_date'] != '0000-00-00') ) {

                                        echo date("d-m-Y", strtotime($data['invoice_date']));

                                    }?></td>


                                </td>

                            </tr>

                        <?php }

                        else

                        { ?>

                            <tr>

                                <td ><?php echo $index; ?></td>

                                <td >



                                <?php

                                    if(!empty($data['lr_number'])) {

                                        echo $data['lr_number']."<br>";

                                    }

                                    if(!empty($data['lr_date']) ) {

                                        echo date("d-m-Y", strtotime($data['lr_date']));

                                    }

                                    if(!empty($data['cancelled'])) {

                                ?>

                                        <br><span style="color: red;">Cancelled</span>

                                <?php

                                    }

                                ?></td>

                                <td >

                                    <?php

                                        if(!empty($data['consignor_id']))

                                        {

                                            $consignor_name = $obj->getTableColumnValue($GLOBALS['consignor_table'],'consignor_id',$data['consignor_id'],'name');

                                            if(!empty($consignor_name))

                                            {

                                                $consignor_name = $obj->encode_decode("decrypt",$consignor_name);

                                            }

                                            echo $consignor_name;
                                            $consignor_mobile_numer = "";
                                            $consignor_mobile_numer = $obj->getTableColumnValue($GLOBALS['consignor_table'],'consignor_id',$data['consignor_id'],'mobile_number');
                                            if(!empty($consignor_mobile_numer) && $consignor_mobile_numer != $GLOBALS['null_value']) {
                                                $consignor_mobile_numer = $obj->encode_decode("decrypt",$consignor_mobile_numer);
                                                echo "<br>".$consignor_mobile_numer;
                                            }

                                        }

                                    ?>

                                </td>

                                <td >

                                    <?php

                                        if(!empty($data['consignee_id']))

                                        {

                                            $consignee_name = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$data['consignee_id'],'name');

                                            if(!empty($consignee_name))

                                            {

                                                $consignee_name = $obj->encode_decode("decrypt",$consignee_name);

                                            }

                                            echo $consignee_name;
                                            $consignee_mobile_numer = "";
                                            $consignee_mobile_numer = $obj->getTableColumnValue($GLOBALS['consignee_table'],'consignee_id',$data['consignee_id'],'mobile_number');
                                            if(!empty($consignee_mobile_numer) && $consignee_mobile_numer != $GLOBALS['null_value']) {
                                                $consignee_mobile_numer = $obj->encode_decode("decrypt",$consignee_mobile_numer);
                                                echo "<br>".$consignee_mobile_numer;
                                            }

                                        }

                                        if(empty($consignee_name) && !empty($data['account_party_id'])){

                                            $account_party_name = "";

                                            $account_party_name = $obj->getTableColumnValue($GLOBALS['account_party_table'],'account_party_id',$data['account_party_id'],'name');

                                            if(!empty($account_party_name)){

                                                $account_party_name = $obj->encode_decode('decrypt',$account_party_name);

                                            }

                                            echo $account_party_name." (Acc.Party)";
                                            $account_party_mobile_numer = "";
                                            $account_party_mobile_numer = $obj->getTableColumnValue($GLOBALS['account_party_table'],'account_party_id',$data['account_party_id'],'mobile_number');
                                            if(!empty($account_party_mobile_numer) && $account_party_mobile_numer != $GLOBALS['null_value']) {
                                                $account_party_mobile_numer = $obj->encode_decode("decrypt",$account_party_mobile_numer);
                                                echo "<br>".$account_party_mobile_numer;
                                            }

                                        }

                                    ?>

                                </td>

                                <td >

                                <?php
                                        $consignee_city = "";
                                        if(!empty($data['consignee_city'])) {
                                            $consignee_city = $obj->encode_decode("decrypt",$data['consignee_city']);
                                        }
                                        else if(!empty($data['others_consignee_city'])) {
                                            $consignee_city = $obj->encode_decode("decrypt",$data['others_consignee_city']);
                                        }
                                        if(!empty($consignee_city)) {
                                            echo $consignee_city;
                                            if(!empty($data['branch_id'])) {
                                                $branch_name = $obj->getTableColumnValue($GLOBALS['branch_table'],'branch_id',$data['branch_id'],'name');
                                                if(!empty($branch_name)) {
                                                    $branch_name = $obj->encode_decode("decrypt",$branch_name);
                                                    echo " - ".$branch_name;
                                                }
                                            }
                                        }
                                    ?>

                                </td>

                                <td ><?php if(!empty($data['total'])){ echo $data['total']; }?></td>

                                <td ><?php if(!empty($data['bill_type'])){ echo $data['bill_type']; }?></td>

                                <td ><?php  if(!empty($data['tripsheet_number']) && $data['tripsheet_number'] != $GLOBALS['null_value']) {

                                        // $data['lr_number'] = $obj->encode_decode('decrypt', $data['lr_number']);

                                        echo $data['tripsheet_number']."<br>";

                                    }

                                    if(!empty($data['tripsheet_date']) && $data['tripsheet_date'] != '0000-00-00') {

                                        echo date("d-m-Y", strtotime($data['tripsheet_date']));

                                    }?></td>
                                    <td>

                                    <?php if($data['invoice_status'] == 'O') {


                                            if(empty($data['cancelled']) && empty($data['is_tripsheet_entry'])){ ?>

                                                <a class="pr-2" href="#" onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>');"><i class="fa fa-pencil"></i></a>

                                            <?php } ?>

                                            <?php

                                            if(empty($data['cancelled']) && empty($data['is_tripsheet_entry']))

                                            { ?>

                                                <a class="pr-2" href="Javascript:DeleteModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['lr_id'])) { echo $data['lr_id']; } ?>');" ><i class="fa fa-trash"></i></a>

                                            <?php }

                                            ?>

                                    <?php }

                                    ?>

                                    <a class=" pr-2" target="_blank" onclick="open_order_report('<?php echo $data['lr_id']; ?>',document.getElementById('<?php echo 'rpt_type_'.$data['lr_id']; ?>').value)"><i class="fa fa-print"></i> &ensp; </a>



                                </td>

                            </tr>

                        <?php }

                        ?>

                        <?php



                    }

                }

                else {

                    ?>

                        <tr>

                            <td colspan="10" class="text-center">Sorry! No records found</td>

                        </tr>

                    <?php

                } ?>

            </tbody>

        </table>

        <script>
            ExportToExcel('xlsx');

            function ExportToExcel(type, fn, dl) {
                var elt = document.getElementById('tbl_lr_list');
                var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });

                if (dl) {
                    XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' });
                } else {
                    XLSX.writeFile(wb, fn || ('lr_list.' + (type || 'xlsx')));
                }

                // Wait for download to start, then close
                setTimeout(function () {
                    window.close();
                }, 1000); // Adjust timing as needed
            }
        </script>
        <?php } ?>