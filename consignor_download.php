<?php 
    include("include_files.php"); ?>
    
    <script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
    <table id="tbl_consignor_list" class="data-table table nowrap tablefont" style="margin: auto; width: 900px;display:none">
        <thead class="thead-dark">
            <tr>
                <th style="text-align: center; width: 50px;">S.No</th>
                <th style="text-align: center; width: 300px;">Consignor Name</th>
                <th style="text-align: center; width: 125px;">Consignor Number</th>
                <th style="text-align: center; width: 125px;">Identification</th>
                <th style="text-align: center; width: 125px;">Address</th>
                <th style="text-align: center; width: 125px;">City</th>
                <th style="text-align: center; width: 125px;">District</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_records_list = array();
            // if(!empty($GLOBALS['bill_company_id'])) {
                $total_records_list = $obj->getTableRecords($GLOBALS['consignor_table'], '','');
            // }

            $show_records_list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $key => $val) {
                    $show_records_list[] = $val;
                }
            }

            if(!empty($show_records_list)) {
                $edit_action = $obj->encode_decode('encrypt', 'edit_action');
                foreach($show_records_list as $key => $data) {
                    $index = $key + 1;
                    if(!empty($prefix)) { $index = $index + $prefix; } ?>
                    <tr>
                        <td class="text-center px-2 py-2"><?php echo $index; ?></td>
                        <td class="text-center px-2 py-2">
                            <div class="w-100">
                                <?php
                                    if(!empty($data['name'])) {
                                        $data['name'] = $obj->encode_decode('decrypt', $data['name']);
                                        echo $data['name'];
                                    }
                                ?>
                            </div>
                        </td>
                        <td class="text-center px-2 py-2">
                            <div class="w-100">
                                <?php
                                    if(!empty($data['mobile_number'])) {
                                        $data['mobile_number'] = $obj->encode_decode('decrypt', $data['mobile_number']);
                                        echo $data['mobile_number'];
                                    }
                                ?>
                            </div>
                        </td>
                        <td class="text-center px-2 py-2">
                            <?php
                                if(!empty($data['identification']) && $data['identification'] !='NULL') {
                                    $data['identification'] = $obj->encode_decode('decrypt', $data['identification']);
                                    echo $data['identification'];
                                }
                            ?>
                        </td>
                        <td class="text-center px-2 py-2">
                            <div class="w-100">
                                <?php
                                     if(!empty($data['address']) && $data['address'] != 'NULL') {
                                        $data['address'] = $obj->encode_decode('decrypt', $data['address']);
                                        echo $data['address'];
                                    }
                                ?>
                            </div>
                        </td>
                        <td class="text-center px-2 py-2">
                            <div class="w-100">
                                <?php
                                     if(!empty($data['city']) && $data['city'] != 'NULL') {
                                        $data['city'] = $obj->encode_decode('decrypt', $data['city']);
                                        echo $data['city'];
                                    }
                                ?>
                            </div>
                        </td>
                        <td class="text-center px-2 py-2">
                            <div class="w-100">
                                <?php
                                     if(!empty($data['district']) &&  $data['district'] != 'NULL') {
                                        $data['district'] = $obj->encode_decode('decrypt', $data['district']);
                                        echo $data['district'];
                                    }
                                ?>
                            </div>
                        </td>
                    </tr>

                <?php }
            } ?>
        </tbody>
    </table>
    <script>
            ExportToExcel('xlsx');
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_consignor_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('consignor_list.' + (type || 'xlsx')));
    }
   
        window.open("consignor.php","_self")
        
    </script>