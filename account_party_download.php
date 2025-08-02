<?php 
    include("include_files.php"); ?>
    
    <script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
    <table id="tbl_account_party_list" class="data-table table nowrap tablefont" style="margin: auto; width: 900px;display:none">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Party Name</th>
                    <th>City</th>
                    <th>Contact Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total_records_list = array();
                    $total_records_list = $obj->getTableRecords($GLOBALS['account_party_table'], '', '');
                    if(!empty($total_records_list)) {
                        foreach($total_records_list as $key => $data) { 

                            $account_party_id = '';
                            $account_party_id = $obj->getTableRecords($GLOBALS['account_party_table'], 'account_party_id', $data['account_party_id'], 'id');

                            ?>
                            <tr>
                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['account_party_id'])) { echo $data['account_party_id']; } ?>');"><?php echo $key + 1; ?></td>
                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['account_party_id'])) { echo $data['account_party_id']; } ?>');">
                                    <div class="w-100">
                                        <?php
                                            if(!empty($data['name'])) {
                                                $data['name'] = $obj->encode_decode('decrypt', $data['name']);
                                                echo $data['name'];
                                                if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                                    $data['city'] = $obj->encode_decode('decrypt', $data['city']);
                                                    // echo " - ".strtoupper(($data['city']));
                                                }
                                            }
                                        ?>
                                    </div>
                                    
                                    <?php
                                        if(!empty($data['creator_name'])) {
                                            $data['creator_name'] = $obj->encode_decode('decrypt', $data['creator_name']);
                                    ?>
                                            <small><?php echo "Last Opened : ".$data['creator_name']; ?></small>
                                    <?php		
                                        }
                                    ?>
                                </td>
                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['account_party_id'])) { echo $data['account_party_id']; } ?>');">
                                    <?php
                                        if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                                            // $data['city'] = $obj->encode_decode('decrypt', $data['city']);
                                            echo $data['city'];
                                        }
                                    ?>
                                </td>
                                <td onclick="Javascript:ShowModalContent('<?php if(!empty($page_title)) { echo $page_title; } ?>', '<?php if(!empty($data['account_party_id'])) { echo $data['account_party_id']; } ?>');">
                                    <?php
                                        if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                            $data['mobile_number'] = $obj->encode_decode('decrypt', $data['mobile_number']);
                                            echo $data['mobile_number'];
                                        }
                                    ?>
                                </td>
                                
                            </tr>
                            <?php
							}
						}
						else {
					?>
							<tr>
								<td colspan="4" class="text-center">Sorry! No records found</td>
							</tr>
					<?php } ?>
            </tbody>
        </table>


    <script>
            ExportToExcel('xlsx');
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_account_party_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('account_party_list.' + (type || 'xlsx')));
    }
   
        window.open("account_party.php","_self")
        
    </script>