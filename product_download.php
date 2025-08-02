<?php 
    include("include_files.php");
?>

<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
<table id="tbl_product_list" class="data-table table nowrap tablefont" style="margin: auto; width: 900px;display:none;">
    <thead class="thead-dark">
        <tr>
            <th style="text-align: center; width: 50px;">S.No</th>
            <th style="text-align: center; width: 200px;">Product Name</th>
            <th style="text-align: center; width: 200px;">Unit</th>
            <th style="text-align: center; width: 200px;">Price</th>           
            <th style="text-align: center; width: 150px;">Hsn Code</th>                 
            <th style="text-align: center; width: 150px;">Tax</th>                                
        </tr>
    </thead>
    
    <tbody>
    <?php 
        $search_text = "";
     
        if(isset($_REQUEST['search_text'])) {
            $search_text = $_REQUEST['search_text'];
        }
        $total_records_list = array();

        $total_records_list = $obj->getTableRecords($GLOBALS['product_table'],'','','DESC');
        
    
        if(!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $val) {
                    if((strpos(strtolower($obj->encode_decode('decrypt', $val['product_name'])), $search_text) !== false) ) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }

        if(!empty($total_records_list)) {
            foreach($total_records_list as $key => $data) {
                $index = $key + 1; 
                ?>
                <tr>
                    <td class="text-center px-2 py-2"><?php echo $index; ?></td>
                    <td class="text-center px-2 py-2">
                        <div class="w-100">
                            <?php
                                if(!empty($data['product_name']) && ($data['product_name'] != $GLOBALS['null_value'])) {
                                    $product_name = $data['product_name'];
                                    echo $obj->encode_decode("decrypt",$product_name);
                                }
                            ?>
                        </div>
                    </td> 
                    <td class="text-center px-2 py-2">
                        <div class="w-100">
                            <?php
                                if(!empty($data['unit_name']) && ($data['unit_name'] != $GLOBALS['null_value'])) {
                                    $unit_name = $data['unit_name'];
                                    echo $obj->encode_decode("decrypt",$unit_name);
                                }
                            ?>
                        </div>
                    </td>
                    <td class="text-center px-2 py-2">
                        <div class="w-100">
                            <?php
                                if(!empty($data['purchase_price']) && ($data['purchase_price'] != $GLOBALS['null_value'])) {
                                    $purchase_price = $data['purchase_price'];
                                    echo $purchase_price;
                                }
                            ?>
                        </div>
                    </td>
                    <td class="text-center px-2 py-2">
                        <div class="w-100">
                            <?php
                                if(!empty($data['hsn_code']) && ($data['hsn_code'] != $GLOBALS['null_value'])) {
                                    $hsn_code = $data['hsn_code'];
                                    echo $hsn_code;
                                }
                            ?>
                        </div>
                    </td>
                    <td class="text-center px-2 py-2">
                        <div class="w-100">
                            <?php
                                if(!empty($data['tax']) && ($data['tax'] != $GLOBALS['null_value'])) {
                                    $tax = $data['tax'];
                                    $tax = str_replace('%','',$tax);
                                    echo $tax;
                                }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php 
            }
        }
    ?>
    </tbody>
</table>

<script>
    ExportToExcel();
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_product_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        if (dl) {
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' });
        } else {
            XLSX.writeFile(wb, fn || ('product_list.' + (type || 'xlsx')));
        }
        window.open("product.php", "_self");
    }
</script>