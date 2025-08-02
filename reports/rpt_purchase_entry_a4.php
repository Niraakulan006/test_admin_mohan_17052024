<?php

include("../include_user_check_and_files.php");
include("../include/number2words.php");

$view_purchase_entry_id = "";
if (isset($_REQUEST['view_purchase_entry_id'])) {
    $view_purchase_entry_id = $_REQUEST['view_purchase_entry_id'];
} else {
    header("Location: ../purchase_entry.php");
    exit;
}

$purchase_entry_date = date('Y-m-d'); $current_date = date('Y-m-d');$gst_option = 0; $tax_type = 0; $tax_option = 0; $overall_tax = "";$selected_godown_ids = "";$draft = 0;
$godown_ids = array();$brand_ids = array();$product_ids = array(); $product_names = array();$cases = array();$piece_per_cases = array();$rate_per_pieces = array();$rate_per_cases = array(); $product_amount = array();$discount = ""; $discount_value = "";$extra_charges = ""; $extra_charges_value = "";$hsn_codes=array(); $round_off = ""; $round_off_type=""; $round_off_value=""; $total_amount = "";$selected_per =""; $per_type =""; 
$godown_type ="";$selected_godown_ids =""; $selected_godown_names = "";$unit_ids =array(); $unit_names=array(); $sub_total = 0;
$purchase_entry_number = ""; $total_quantity = 0; $cancelled = 0; $company_details = array(); $party_details = array(); $quantity = array();
$content = array();  $charges_id = array(); $charges_value = array(); $charges_total =array(); $discount = ""; $discount_name = ""; $discount_option = 0; $discount_value = 0;$discounted_total = 0; $discount_amt =0; $party_state = ""; $company_state = ""; $igst_value = 0; $cgst_value = 0; $sgst_value = 0; $total_tax_value = 0; $terms_and_condition = ""; $vehicle_details = "";
$bill_total_amount = 0;
   
if (!empty($view_purchase_entry_id)) {
    $purchase_entry_list = array();
    $purchase_entry_list = $obj->getTableRecords($GLOBALS['purchase_entry_table'], 'purchase_entry_id', $view_purchase_entry_id, '');
            
    if(!empty($purchase_entry_list)) {
        foreach($purchase_entry_list as $data) {
            if(!empty($data['purchase_entry_date'])) {
                $purchase_entry_date = date('d-m-Y', strtotime($data['purchase_entry_date']));
            }
            if(!empty($data['party_id']) && $data['party_id'] != $GLOBALS['null_value']) {
                $party_id = $data['party_id'];
            }
            if(!empty($data['rate']) && $data['rate'] != $GLOBALS['null_value']) {
                $rates = $data['rate'];
                $rates = explode(",", $rates);
                $rates = array_reverse($rates);
            }
            if(!empty($data['quantity']) && $data['quantity'] != $GLOBALS['null_value']) {
                $quantity = $data['quantity'];
                $quantity = explode(",", $quantity);
                $quantity = array_reverse($quantity);
            }
            if(!empty($data['product_id']) && $data['product_id'] != $GLOBALS['null_value']) {
                $product_ids = $data['product_id'];
                $product_ids = explode(",", $product_ids);
                $product_ids = array_reverse($product_ids);
                $product_count = count($product_ids);
            }
            if(!empty($data['product_name']) && $data['product_name'] != $GLOBALS['null_value']) {
                $product_names = $data['product_name'];
                $product_names = explode(",", $product_names);
                $product_names = array_reverse($product_names);
            }
            if(!empty($data['unit_name']) && $data['unit_name'] != $GLOBALS['null_value']) {
                $unit_names = $data['unit_name'];
                $unit_names = explode(",", $unit_names);
                $unit_names = array_reverse($unit_names);
            }
            if(!empty($data['unit_id']) && $data['unit_id'] != $GLOBALS['null_value']) {
                $unit_ids = $data['unit_id'];
                $unit_ids = explode(",", $unit_ids);
                $unit_ids = array_reverse($unit_ids);
            }
            if(!empty($data['product_amount']) && $data['product_amount'] != $GLOBALS['null_value']) {
                $product_amount = $data['product_amount'];
                $product_amount = explode(",", $product_amount);
                $product_amount = array_reverse($product_amount);
            }
             if(!empty($data['product_tax']) && $data['product_tax'] != $GLOBALS['null_value']) {
                $product_tax = $data['product_tax'];
                $product_tax = explode(",", $product_tax);
                $product_tax = array_reverse($product_tax);
            }
            if(!empty($data['round_off']) && $data['round_off'] != $GLOBALS['null_value']) {
                $round_off = $data['round_off'];
            }
            if(!empty($data['round_off_type']) && $data['round_off_type'] != $GLOBALS['null_value']) {
                $round_off_type = $data['round_off_type'];
            }
            if(!empty($data['round_off_value']) && $data['round_off_value'] != $GLOBALS['null_value']) {
                $round_off_value = $data['round_off_value'];
            }
            if(!empty($data['tax_option']) && $data['tax_option'] != $GLOBALS['null_value']) {
                $tax_option = $data['tax_option'];
            }
            if(!empty($data['overall_tax']) && $data['overall_tax'] != $GLOBALS['null_value']) {
                $overall_tax = $data['overall_tax'];
            }
            if(!empty($data['tax_type']) && $data['tax_type'] != $GLOBALS['null_value']) {
                $tax_type = $data['tax_type'];
            }
            if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                $total_amount = $data['total_amount'];
            }
            if(!empty($data['purchase_entry_number']) && $data['purchase_entry_number'] != $GLOBALS['null_value']) {
                $purchase_entry_number = $data['purchase_entry_number'];
            }
            if(!empty($data['total_amount']) && $data['total_amount'] != $GLOBALS['null_value']) {
                $bill_total_amount = $data['total_amount'];
            }
            if(!empty($data['charges_value'])) {
                $charges_value = $data['charges_value'];
                $charges_value = explode(",", $charges_value);
            }
            if(!empty($data['charges_id']) && ($data['charges_id'] != $GLOBALS['null_value'])) {
                $charges_id = $data['charges_id'];
                $charges_id = explode(",", $charges_id);
                $charges_count = count($charges_id);
            }      
            if(!empty($data['charges_total'])) {
                $charges_total = $data['charges_total'];
                $charges_total = explode(",", $charges_total);
            }   
            if(!empty($data['sub_total']) && $data['sub_total'] != $GLOBALS['null_value']) {
                $sub_total = $data['sub_total'];
            }
            if(!empty($data['cancelled']) && $data['cancelled'] != $GLOBALS['null_value']) {
                $cancelled = $data['cancelled'];
            } 
            if(!empty($data['gst_option']) && $data['gst_option'] != $GLOBALS['null_value']) {
                $gst_option = $data['gst_option'];
            } 
            if(!empty($data['bill_company_details']) && $data['bill_company_details'] != $GLOBALS['null_value']) {
                $company_details = $obj->encode_decode('decrypt', $data['bill_company_details']);
                $company_details = explode("$$$", $company_details);
            }
            if(!empty($data['party_details']) && $data['party_details'] != $GLOBALS['null_value']) {
                $party_details = $obj->encode_decode('decrypt', $data['party_details']);
                $party_details = explode("$$$", $party_details);
            }    

            if(!empty($data['discount_option']) && $data['discount_option'] != $GLOBALS['null_value']) {
                $discount_option = $data['discount_option'];
            }
            if(!empty($data['discount_name']) && $data['discount_name'] != $GLOBALS['null_value']) {
                $discount_name = $obj->encode_decode('decrypt',$data['discount_name']);
            }
            if(!empty($data['discounted_total']) && $data['discounted_total'] != $GLOBALS['null_value']) {
                $discounted_total = $data['discounted_total'];
            }
            if(!empty($data['discount_value']) && $data['discount_value'] != $GLOBALS['null_value']) {
                $discount_value = $data['discount_value'];
            }
            if(!empty($data['discount']) && $data['discount'] != $GLOBALS['null_value']) {
                $discount_amt = $data['discount'];
                if(strpos($discount_amt, '%') !== false) {  
                    $discount = "";
                }else{
                    $discount = "Rs.";
                }
            }
            if(!empty($data['company_state']) && $data['company_state'] != $GLOBALS['null_value']) {
                $company_state = $data['company_state'];
            }
            if(!empty($data['party_state']) && $data['party_state'] != $GLOBALS['null_value']) {
                $party_state = $data['party_state'];
            } 
            if(!empty($data['igst_value']) && $data['igst_value'] != $GLOBALS['null_value']) {
                $igst_value = $data['igst_value'];
            }
            if(!empty($data['cgst_value']) && $data['cgst_value'] != $GLOBALS['null_value']) {
                $cgst_value = $data['cgst_value'];
            } 
            if(!empty($data['sgst_value']) && $data['sgst_value'] != $GLOBALS['null_value']) {
                $sgst_value = $data['sgst_value'];
            }
            if(!empty($data['total_tax_value']) && $data['total_tax_value'] != $GLOBALS['null_value']) {
                $total_tax_value = $data['total_tax_value'];
            } 
            if(!empty($data['terms_and_condition']) && $data['terms_and_condition'] != $GLOBALS['null_value']) {
                $terms_and_condition = $data['terms_and_condition'];
            } 
            if(!empty($data['vehicle_details']) && $data['vehicle_details'] != $GLOBALS['null_value']) {
                $vehicle_details = $data['vehicle_details'];
            } 
        }
    }
$company_name = "";
$company_name = $obj->getTableColumnValue($GLOBALS['organization_table'], 'organization_id', $GLOBALS['bill_company_id'], 'name');
if(!empty($company_name) && $company_name != $GLOBALS['null_value']){
    $company_name = $obj->encode_decode('decrypt', $company_name);
}

require_once('../fpdf/AlphaPDF.php');
$pdf = new AlphaPDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetTitle('Purchase Entry');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFont('Arial', 'BI', 10);

$height = 0;
$display = '';
$y2 = $pdf->GetY();
$y = $pdf->GetY();
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(11);

$file_name="Purchase Entry";
include("rpt_billing_header.php");
if($cancelled == '0'){
    // include("rpt_watermark.php");
}

if($cancelled == '1') {
    if(file_exists('../include/images/cancelled.jpg')) {
        $pdf->SetAlpha(0.3);
        $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
        $pdf->SetAlpha(1);
    }
}

$bill_to_y = $pdf->GetY();
$pdf->SetFont('Arial','B',9);
$pdf->SetX(10);
$pdf->Cell(0,1,'',0,1,'L',0);
$pdf->Cell(63,4,'Supplier : ',0,1,'L',0);
$pdf->Cell(0,1,'',0,1,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(12);


for($i=0;$i<count($party_details);$i++)
{
    if($party_details[$i]!="NULL" && $party_details[$i]!="")
    {
        $pdf->SetFont('Arial','',9);
        $pdf->SetX(15);
        if($i==0)
        {
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(65,4,$party_details[$i],0,1,'L',0);
            $pdf->Cell(0,1,'',0,1,'L',0);
        }
        else{
            $party_details[$i] = trim($party_details[$i]);
            $pdf->MultiCell(65,4,$party_details[$i],0,'L',0);
            $pdf->Cell(0,1,'',0,1,'L',0);
        }
    }
}


$party_y = $pdf->GetY();
$pdf->SetFont('Arial','B',9);
$pdf->SetY($bill_to_y);
$pdf->SetX(110);
$pdf->Cell(80,8,'Purchase Entry No. :  ',0,0,'L',0);

$pdf->SetFont('Arial','',9);
$pdf->SetX(142);
$pdf->Cell(40,8,$purchase_entry_number,0,1,'L',0);

$pdf->SetFont('Arial','B',9);
$pdf->SetX(110);
$pdf->Cell(20,8,'Dated                        : ',0,0,'L',0);

$pdf->SetFont('Arial','',9);
$pdf->SetX(142);
$pdf->Cell(40,8,$purchase_entry_date,0,1,'L',0);

if(!empty($vehicle_details)){
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(110);
    $pdf->Cell(20,8,'Vehicle Details      : ',0,0,'L',0);

    $pdf->SetFont('Arial','',9);
    $pdf->SetX(142);
    $pdf->MultiCell(55,8,$vehicle_details,0,'L',0);
}




$bill_to_y2 = $pdf->GetY();
$y_array = array($party_y,$bill_to_y2);
$max_bill_y = max($y_array);
$pdf->SetY($bill_to_y);
$pdf->SetX(10);
$pdf->Cell(100,40,'',1,0,'L',0);

$pdf->SetX(110);
$pdf->Cell(90,40,'',1,1,'L',0);

$bill_to_y1 = $pdf->GetY();

$pdf->SetY($bill_to_y);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(73);
$pdf->Cell(0,1,'',0,1,'L',0);
$pdf->SetX(110);

$delivery_y = $pdf->GetY();

$pdf->SetY($bill_to_y);
$pdf->SetFont('Arial','B',10);

$pdf->Cell(0,2,'',0,1,'C',0);

$pdf->SetFont('Arial','',9);

$pdf->Cell(0,2,'',0,1,'L',0);

$pdf->Cell(0,2,'',0,1,'L',0);

$bill_to_y2 = $pdf->GetY();
$y_array = array($bill_to_y1,$bill_to_y2,$delivery_y);
$max_bill_y = max($y_array);
$pdf->SetY($bill_to_y);
$pdf->SetX(10);
$pdf->Cell(100,($max_bill_y - $bill_to_y),'',1,0,'L',0);
$pdf->SetX(110);
$pdf->Cell(90,($max_bill_y - $bill_to_y),'',1,1,'L',0);


$header_height = $max_bill_y - 10;
if($header_height > 45){
    // $height -= ($header_height - 45);
}
$address_height = $max_bill_y - $bill_to_y;

$starting_y = $pdf->GetY();
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(101,114,122);
$pdf->SetTextColor(255,255,255);

$pdf->SetX(10);
$pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
if($gst_option == 1 && $tax_type == 1){
    $pdf->Cell(60, 7, 'Products', 1, 0, 'C', 1);
    $pdf->Cell(25, 7, 'Unit', 1, 0, 'C', 1);
    $pdf->Cell(20, 7, 'Qty', 1, 0, 'C', 1);
    $pdf->Cell(25, 7, 'Rate', 1, 0, 'C', 1);
    $pdf->Cell(15, 7, 'Tax', 1, 0, 'C', 1);
    $pdf->Cell(35, 7, 'Amount', 1, 1, 'C', 1);
}else{
    $pdf->Cell(75, 7, 'Products', 1, 0, 'C', 1);
    $pdf->Cell(25, 7, 'Unit', 1, 0, 'C', 1);
    $pdf->Cell(20, 7, 'Qty', 1, 0, 'C', 1);
    $pdf->Cell(25, 7, 'Rate', 1, 0, 'C', 1);
    $pdf->Cell(35, 7, 'Amount', 1, 1, 'C', 1);
}

$pdf->SetTextColor(0,0,0);
   

$pdf->SetFont('Arial', '', 8);
$product_y = $pdf->GetY();

$y_axis = $pdf->GetY();
$s_no = 1;
$net_amount = 0;
$footer_height = 0;
$footer_height += 25;
if(!empty($round_off_value)){
    $footer_height += 5;
    $height -= 5;
}
if(!empty($discount_amt) && $discount_amt != $GLOBALS['null_value']) {
    $footer_height += 10;
    $height -= 10;
}

if(!empty($gst_option)){
    if($company_state == $party_state){
        $footer_height += 15;
        $height -= 15;

    }else{
        $footer_height += 10;
        $height -= 10;
    }
}

if(!empty($charges_id) && $charges_id != $GLOBALS['null_value'] ) {
    $charges_count = 0;
    $charges_count = count($charges_id);
    $footer_height += $charges_count * 10 ;
    $height -= $charges_count * 5;

}

$total_pages = array(1);
$page_number = 1;
$last_count = 0;

if (!empty($view_purchase_entry_id) && !empty($product_ids)) {
    for ($p = 0; $p < count($product_ids); $p++) {

        if ($pdf->GetY() >= 265) {
            $y = $pdf->GetY();
            // $pdf->SetY($y_axis);
            // $pdf->SetX(10);

            // if($gst_option == 1 && $tax_type == 1){
            //     $pdf->Cell(10, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(50, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(25, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(20, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(20, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(25, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(15, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(25, 270 - $y_axis, '', 1, 1, 'C', 0);
            // }else{
            //     $pdf->Cell(10, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(65, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(25, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(20, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(20, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(25, 270 - $y_axis, '', 1, 0, 'C', 0);
            //     $pdf->Cell(25, 270 - $y_axis, '', 1, 1, 'C', 0);
            // }   
           
            $pdf->SetFont('Arial', 'B', 9);

            $next_page = $pdf->PageNo() + 1;
            $pdf->SetFont('Arial','I',7);
            $pdf->SetY(-15);
            $pdf->SetX(10);
            $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');

            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);

            $page_number += 1;
            $total_pages[] = $page_number;
            $last_count = $p + 1;
            $pdf->SetTitle('Purchase Entry');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFont('Arial', 'BI', 10);

            $y2 = $pdf->GetY();
            $y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetY(11);
      
            $file_name="Purchase Entry";

            include("rpt_billing_header.php");
            if($cancelled == '0'){
                // include("rpt_watermark.php");
            }
            
            if($cancelled == '1') {
                if(file_exists('../include/images/cancelled.jpg')) {
                    $pdf->SetAlpha(0.3);
                    $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
                    $pdf->SetAlpha(1);
                }
            }

            $bill_to_y = $pdf->GetY();
            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(10);
            $pdf->Cell(0,1,'',0,1,'L',0);
            $pdf->Cell(63,4,'Supplier : ',0,1,'L',0);
            $pdf->Cell(0,1,'',0,1,'L',0);
            $pdf->SetFont('Arial','B',10);
            $pdf->SetX(12);
            for($i=0;$i<count($party_details);$i++)
            {
                if($party_details[$i]!="NULL" && $party_details[$i]!="")
                {
                    $pdf->SetFont('Arial','',9);
                    $pdf->SetX(15);
                    if($i==0)
                    {
                        $pdf->SetFont('Arial','B',9);
                        $pdf->Cell(65,4,$party_details[$i],0,1,'L',0);
                        $pdf->Cell(0,1,'',0,1,'L',0);
                    }
                    else{
                        $party_details[$i] = trim($party_details[$i]);
                        $pdf->MultiCell(65,4,$party_details[$i],0,'L',0);
                        $pdf->Cell(0,1,'',0,1,'L',0);
                    }
                }
            }

            $party_y = $pdf->GetY();
            $pdf->SetFont('Arial','B',9);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(110);
            $pdf->Cell(80,8,'Purchase Entry No. :  ',0,0,'L',0);

            $pdf->SetFont('Arial','',9);
            $pdf->SetX(142);
            $pdf->Cell(40,8,$purchase_entry_number,0,1,'L',0);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(110);
            $pdf->Cell(20,8,'Dated                        : ',0,0,'L',0);

            $pdf->SetFont('Arial','',9);
            $pdf->SetX(142);
            $pdf->Cell(40,8,$purchase_entry_date,0,1,'L',0);

                        
            $pdf->SetFont('Arial','B',9);
            $pdf->SetX(110);
            $pdf->Cell(20,8,'Vehicle Details      : ',0,0,'L',0);

            $pdf->SetFont('Arial','',9);
            $pdf->SetX(142);
            $pdf->MultiCell(55,8,$vehicle_details,0,'L',0);


            $bill_to_y2 = $pdf->GetY();
            $y_array = array($party_y,$bill_to_y2);
            $max_bill_y = max($y_array);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(100,40,'',1,0,'L',0);

            $pdf->SetX(110);
            $pdf->Cell(90,40,'',1,1,'L',0);

            $bill_to_y1 = $pdf->GetY();

            $pdf->SetY($bill_to_y);
            $pdf->SetFont('Arial','B',10);
            $pdf->SetX(73);
            $pdf->Cell(0,1,'',0,1,'L',0);
            $pdf->SetX(110);

            $delivery_y = $pdf->GetY();

            $pdf->SetY($bill_to_y);
            $pdf->SetFont('Arial','B',10);

            $pdf->Cell(0,2,'',0,1,'C',0);

            $pdf->SetFont('Arial','',9);

            $pdf->Cell(0,2,'',0,1,'L',0);

            $pdf->Cell(0,2,'',0,1,'L',0);

            $bill_to_y2 = $pdf->GetY();
            $y_array = array($bill_to_y1,$bill_to_y2,$delivery_y);
            $max_bill_y = max($y_array);
            $pdf->SetY($bill_to_y);
            $pdf->SetX(10);
            $pdf->Cell(100,($max_bill_y - $bill_to_y),'',1,0,'L',0);
            $pdf->SetX(110);
            $pdf->Cell(90,($max_bill_y - $bill_to_y),'',1,1,'L',0);


            $starting_y = $pdf->GetY();
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor(101,114,122);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetX(10);
            $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
            if($gst_option == 1 && $tax_type == 1){
                $pdf->Cell(60, 7, 'Products', 1, 0, 'C', 1);
                $pdf->Cell(25, 7, 'Unit', 1, 0, 'C', 1);
                $pdf->Cell(20, 7, 'Qty', 1, 0, 'C', 1);
                $pdf->Cell(25, 7, 'Rate', 1, 0, 'C', 1);
                $pdf->Cell(15, 7, 'Tax', 1, 0, 'C', 1);
                $pdf->Cell(35, 7, 'Amount', 1, 1, 'C', 1);
            }else{
                $pdf->Cell(75, 7, 'Products', 1, 0, 'C', 1);
                $pdf->Cell(25, 7, 'Unit', 1, 0, 'C', 1);
                $pdf->Cell(20, 7, 'Qty', 1, 0, 'C', 1);
                $pdf->Cell(25, 7, 'Rate', 1, 0, 'C', 1);
                $pdf->Cell(35, 7, 'Amount', 1, 1, 'C', 1);
            }

            
            $pdf->SetTextColor(0,0,0);
               
            
            $pdf->SetFont('Arial', '', 8);
            $product_y = $pdf->GetY();

        }
        $rates[$p] = trim($rates[$p]);
        $quantity[$p] = trim($quantity[$p]);
        $product_names[$p] = trim($product_names[$p]);
        $product_amount[$p] = trim($product_amount[$p]);
        if(!empty($unit_names[$p])){
            $unit_names[$p] = trim($unit_names[$p]);
        }
        if(!empty($product_tax[$p])){
            $product_tax[$p] = trim($product_tax[$p]);
        }
        $total_quantity += $quantity[$p];
        $y = $pdf->GetY();
        $pdf->SetY($product_y);
        $pdf->SetX(10);
        $pdf->Cell(10, 6, $s_no, 0, 0, 'L', 0);

        if($gst_option == 1 && $tax_type == 1){
            $pdf->SetY($product_y);
            $pdf->SetX(20);
            $pdf->MultiCell(60, 6, html_entity_decode($obj->encode_decode("decrypt", $product_names[$p])), 0, 'L');
            $name_y = $pdf->GetY() - $product_y;

            if(!empty($unit_names[$p])){
                $pdf->SetY($product_y);
                $pdf->SetX(80);
                $pdf->MultiCell(25, 6,$obj->encode_decode('decrypt', $unit_names[$p]), 0, 'C');
            } else {
                $pdf->SetY($product_y);
                $pdf->SetX(80);
                $pdf->MultiCell(25, 6,'', 0, 'C');
            }
            $unit_y = $pdf->GetY() - $product_y;

            $pdf->SetY($product_y);
            $pdf->SetX(105);
            $pdf->MultiCell(20, 6,$quantity[$p], 0, 'R');
            $quantity_y = $pdf->GetY() - $product_y;

            $pdf->SetY($product_y);
            $pdf->SetX(125);
            $pdf->MultiCell(25, 6,$obj->numberFormat($rates[$p],2), 0, 'R');
            $rate_y = $pdf->GetY() - $product_y;
                        
            $pdf->SetY($product_y);
            $pdf->SetX(150);
            $pdf->MultiCell(15, 6,$product_tax[$p], 0, 'R');
            $tax_y = $pdf->GetY() - $product_y;


            $pdf->SetY($product_y);
            $pdf->SetX(165);
            $pdf->MultiCell(35, 6,$obj->numberFormat($product_amount[$p],2), 0, 'R');
            $amount_y = $pdf->GetY() - $product_y;
        }else{

            $pdf->SetY($product_y);
            $pdf->SetX(20);
            $pdf->MultiCell(75, 6, html_entity_decode($obj->encode_decode("decrypt", $product_names[$p])), 0, 'L');
            $name_y = $pdf->GetY() - $product_y;

            if(!empty($unit_names[$p])){
                $pdf->SetY($product_y);
                $pdf->SetX(95);
                $pdf->MultiCell(25, 6,$obj->encode_decode('decrypt', $unit_names[$p]), 0, 'C');
            } else {
                $pdf->SetY($product_y);
                $pdf->SetX(95);
                $pdf->MultiCell(25, 6,'', 0, 'C');
            }
            $unit_y = $pdf->GetY() - $product_y;

            $pdf->SetY($product_y);
            $pdf->SetX(120);
            $pdf->MultiCell(20, 6,$quantity[$p], 0, 'R');
            $quantity_y = $pdf->GetY() - $product_y;


            $pdf->SetY($product_y);
            $pdf->SetX(140);
            $pdf->MultiCell(25, 6,$obj->numberFormat($rates[$p],2), 0, 'R');
            $rate_y = $pdf->GetY() - $product_y;

            $pdf->SetY($product_y);
            $pdf->SetX(165);
            $pdf->MultiCell(35, 6,$obj->numberFormat($product_amount[$p],2), 0, 'R');
            $amount_y = $pdf->GetY() - $product_y;

        }

        $y_array = array($name_y, $quantity_y, $rate_y, $unit_y, $amount_y);
        $product_max = max($y_array);

        $pdf->SetY($product_y);
        $pdf->SetX(10);
        $pdf->Cell(10,$product_max,'',1,0,'C');
        $pdf->SetX(20);

        if($gst_option == 1 && $tax_type == 1){
            $pdf->Cell(60,$product_max,'',1,0,'C');
            $pdf->SetX(80);
            $pdf->Cell(25,$product_max,'',1,0,'C');
            $pdf->SetX(105);
            $pdf->Cell(20,$product_max,'',1,0,'C');
            $pdf->SetX(125);
            $pdf->Cell(25,$product_max,'',1,0,'C');
            $pdf->SetX(150);
            $pdf->Cell(15,$product_max,'',1,0,'C');
            $pdf->SetX(165);
            $pdf->Cell(35,$product_max,'',1,1,'C');
        }else{
            $pdf->Cell(75,$product_max,'',1,0,'C');
            $pdf->SetX(95);
            $pdf->Cell(25,$product_max,'',1,0,'C');
            $pdf->SetX(120);
            $pdf->Cell(20,$product_max,'',1,0,'C');
            $pdf->SetX(140);
            $pdf->Cell(25,$product_max,'',1,0,'C');
            $pdf->SetX(165);
            $pdf->Cell(35,$product_max,'',1,1,'C');
        }



        $product_y += $product_max;
        $s_no++;

    }
}

$end_y = $pdf->GetY();

$last_page_count = $s_no - $last_count;

if (($footer_height + $end_y) > 270) {
    $y = $pdf->GetY();
    $pdf->SetY($y_axis);
    $pdf->SetX(10);
   
        if($gst_option == 1 && $tax_type == 1){

            $pdf->Cell(10, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(60, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(25, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(20, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(25, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(15, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(35, 270 - $y_axis, '', 1, 1, 'C', 0);

        }else{
            $pdf->Cell(10, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(75, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(25, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(20, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(25, 270 - $y_axis, '', 1, 0, 'C', 0);
            $pdf->Cell(35, 270 - $y_axis, '', 1, 1, 'C', 0);
        }
    

    $pdf->SetFont('Arial','I',7);
    $pdf->SetY(-15);
    $pdf->SetX(10);
    $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);

    $pdf->SetTitle('Purchase Entry');
    $pdf->SetFont('Arial', 'BI', 10);

    $y2 = $pdf->GetY();
    $y = $pdf->GetY();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetY(11);
    
    $file_name="Purchase Entry";

    include("rpt_billing_header.php");
    if($cancelled == '0'){
        // include("rpt_watermark.php");
    }
    
    if($cancelled == '1') {
        if(file_exists('../include/images/cancelled.jpg')) {
            $pdf->SetAlpha(0.3);
            $pdf->Image('../include/images/cancelled.jpg',45,110,125,70);
            $pdf->SetAlpha(1);
        }
    }
    
    $bill_to_y = $pdf->GetY();
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(0,1,'',0,1,'L',0);
    $pdf->Cell(63,4,'Supplier : ',0,1,'L',0);
    $pdf->Cell(0,1,'',0,1,'L',0);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetX(12);
    for($i=0;$i<count($party_details);$i++)
    {
        if($party_details[$i]!="NULL" && $party_details[$i]!="")
        {
            $pdf->SetFont('Arial','',9);
            $pdf->SetX(15);
            if($i==0)
            {
                $pdf->SetFont('Arial','B',9);
                $pdf->Cell(65,4,$party_details[$i],0,1,'L',0);
                $pdf->Cell(0,1,'',0,1,'L',0);
            }
            else{
                $party_details[$i] = trim($party_details[$i]);
                $pdf->MultiCell(65,4,$party_details[$i],0,'L',0);
                $pdf->Cell(0,1,'',0,1,'L',0);
            }
        }
    }

    $party_y = $pdf->GetY();
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY($bill_to_y);
    $pdf->SetX(110);
    $pdf->Cell(80,8,'Purchase Entry No. :  ',0,0,'L',0);

    $pdf->SetFont('Arial','',9);
    $pdf->SetX(142);
    $pdf->Cell(40,8,$purchase_entry_number,0,1,'L',0);

    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(110);
    $pdf->Cell(20,8,'Dated                        : ',0,0,'L',0);

    $pdf->SetFont('Arial','',9);
    $pdf->SetX(142);
    $pdf->Cell(40,8,$purchase_entry_date,0,1,'L',0);


    $bill_to_y2 = $pdf->GetY();
    $y_array = array($party_y,$bill_to_y2);
    $max_bill_y = max($y_array);
    $pdf->SetY($bill_to_y);
    $pdf->SetX(10);
    $pdf->Cell(100,40,'',1,0,'L',0);

    $pdf->SetX(110);
    $pdf->Cell(90,40,'',1,1,'L',0);

    $bill_to_y1 = $pdf->GetY();

    $pdf->SetY($bill_to_y);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetX(73);
    $pdf->Cell(0,1,'',0,1,'L',0);
    $pdf->SetX(110);

    $delivery_y = $pdf->GetY();

    $pdf->SetY($bill_to_y);
    $pdf->SetFont('Arial','B',10);

    $pdf->Cell(0,2,'',0,1,'C',0);

    $pdf->SetFont('Arial','',9);

    $pdf->Cell(0,2,'',0,1,'L',0);

    $pdf->Cell(0,2,'',0,1,'L',0);

    $bill_to_y2 = $pdf->GetY();
    $y_array = array($bill_to_y1,$bill_to_y2,$delivery_y);
    $max_bill_y = max($y_array);
    $pdf->SetY($bill_to_y);
    $pdf->SetX(10);
    $pdf->Cell(100,($max_bill_y - $bill_to_y),'',1,0,'L',0);
    $pdf->SetX(110);
    $pdf->Cell(90,($max_bill_y - $bill_to_y),'',1,1,'L',0);



    $starting_y = $pdf->GetY();
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(101,114,122);
    $pdf->SetTextColor(255,255,255);
        $pdf->SetX(10);
        $pdf->Cell(10, 7, 'S.No', 1, 0, 'C', 1);
        if($gst_option == 1 && $tax_type == 1){
            $pdf->Cell(60, 7, 'Products', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'Unit', 1, 0, 'C', 1);
            $pdf->Cell(20, 7, 'Qty', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'Rate', 1, 0, 'C', 1);
            $pdf->Cell(15, 7, 'Tax', 1, 0, 'C', 1);
            $pdf->Cell(35, 7, 'Amount', 1, 1, 'C', 1);
        }else{
            $pdf->Cell(75, 7, 'Products', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'Unit', 1, 0, 'C', 1);
            $pdf->Cell(20, 7, 'Qty', 1, 0, 'C', 1);
            $pdf->Cell(25, 7, 'Rate', 1, 0, 'C', 1);
            $pdf->Cell(35, 7, 'Amount', 1, 1, 'C', 1);
        }
    $pdf->SetTextColor(0,0,0);
       
        
    
    $pdf->SetFont('Arial', '', 8);

    $y_axis = $pdf->GetY();
    $content_height = 265 - $footer_height;

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(10, $content_height - $y_axis, '', 1, 0);

    if($gst_option == 1 && $tax_type == 1){

        $pdf->Cell(60, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(20, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(15, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(35, $content_height - $y_axis, '', 1, 1);

    }else{
        $pdf->Cell(75, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(20, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(35, $content_height - $y_axis, '', 1, 1);
    }
   
    $pdf->SetY($content_height);
} else {
    $content_height = 265 - $footer_height;

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(10, $content_height - $y_axis, '', 1, 0);

    if($gst_option == 1 && $tax_type == 1){

        $pdf->Cell(60, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(20, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(15, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(35, $content_height - $y_axis, '', 1, 1);

    }else{
        $pdf->Cell(75, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(20, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(25, $content_height - $y_axis, '', 1, 0);
        $pdf->Cell(35, $content_height - $y_axis, '', 1, 1);
    }
}

$max_page = max($total_pages);



    
    
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetX(10);

    if($gst_option == 1 && $tax_type == 1){

        $pdf->Cell(95, 5, 'Total Qty', 1, 0, 'R', 0);
        $pdf->Cell(20, 5, $total_quantity." ", 1, 0, 'R', 0);

        if(!empty($sub_total)) {
            $pdf->SetX(125);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(45,5,'Sub Total',1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(30,5,$obj->numberFormat($sub_total,2),1,1,'R',0);
        }

    }else{
        $pdf->Cell(110, 5, 'Total Qty', 1, 0, 'R', 0);
        $pdf->Cell(20, 5, $total_quantity." ", 1, 0, 'R', 0);

        if(!empty($sub_total)) {
            $pdf->SetX(95);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(75,5,'Sub Total',1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(30,5,$obj->numberFormat($sub_total,2),1,1,'R',0);
        }
    }

    if(!empty($discount_value)){
        $discount_value = $obj->numberFormat($discount_value,2);

        $pdf->SetX(95);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(75,5,$discount_name.' (' . $discount. " " .$discount_amt. ")",1,0,'R',0);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(30,5,$discount_value,1,1,'R',0);

        $pdf->SetX(95);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(75,5,'Discounted Total',1,0,'R',0);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(30,5,$obj->numberFormat($discounted_total,2),1,1,'R',0);

    }
    

    if(!empty($charges_id) && $charges_id != $GLOBALS['null_value'] ) {
        $total_charge = 0;  
        $total_discount = 0; $after_charges_total = 0;
        
        $total_discount = $discounted_total;
        
        for($o = 0; $o < count($charges_id); $o++) {
            if($charges_id[$o] != $GLOBALS['null_value'] ){
                $charges_name = $obj->getTableColumnValue($GLOBALS['charges_table'], 'charges_id', $charges_id[$o], 'charges_name');
                $pdf->SetX(95);
                  $charges[$o] = "";
                $pdf->SetFont('Arial','B',8);
                if(strpos($charges_value[$o], '%') !== false) {
                    $charges_values = str_replace('%', '', $charges_value[$o]);
                    $charges_values = trim($charges_values);
                    $charges[$o] = $charges_value[$o];

                }
                else {
                    $charges_values = $charges_value[$o];
                    $charges[$o] = 'Rs.'. $charges_value[$o];

                }
                $pdf->Cell(75,5,$obj->encode_decode('decrypt', $charges_name)."( ".$charges[$o].")",1,0,'R',0);
                // $pdf->SetFont('Arial','',8);
                // $pdf->Cell(30,5, $obj->numberFormat($charges_total[$o],2),1,1,'R',0);
                // $pdf->SetX(130);
                // $pdf->SetFont('Arial','B',8);
                // $pdf->Cell(40,5,'Total',1,0,'R',0);
                // $pdf->SetFont('Arial','',8);
                // if($discount_option == '1'){
                //     $total_discount = $total_discount + $charges_total[$o]; 
                // } elseif($discount_option == '2'){
                //     $total_discount = $total_discount + $charges_total[$o]; 
                // }
                // $pdf->Cell(30,5,number_format(((float) $total_discount),2),1,1,'R',0);
                $pdf->SetFont('Arial','',8);
         
                if(strpos($charges_value[$o], '%') !== false) {
                    $charges_value1 = ($charges_values * $total_discount) / 100;
                    $charges_value1 = number_format($charges_value1, 2);
                    $charges_value1 = str_replace(",", "", $charges_value1);
                } else {
                    $charges_value1 = $charges_values;
                }
                $pdf->Cell(30,5, $obj->numberFormat($charges_value1,2),1,1,'R',0);
                
                $pdf->SetX(95);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(75,5,'Total',1,0,'R',0);
                $pdf->SetFont('Arial','',8);

                $total_discount = $total_discount + $charges_value1;
                
                $pdf->Cell(30,5,$obj->numberFormat(((float) $total_discount),2),1,1,'R',0);
            }
        }
    }

   
    $overall_tax_value = "";
    if($gst_option == 1 && $company_state == $party_state) {
        if(!empty($overall_tax)){
            $overall_tax_value = str_replace('%','',$overall_tax);
            $overall_tax_value = $overall_tax_value/2;
            $overall_tax_value = " (". $overall_tax_value ." %)";
        }
        if(!empty($cgst_value)){  
            $pdf->SetX(95);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(75,5,'CGST'.$overall_tax_value,1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(30,5,$cgst_value,1,1,'R',0);
        }
        if(!empty($sgst_value)){  

            $pdf->SetX(95);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(75,5,'SGST'. $overall_tax_value,1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(30,5,$sgst_value,1,1,'R',0);
        }
    }
    
    $overall_tax_value = "";
    if($gst_option == 1 && $company_state != $party_state) {
        if(!empty($overall_tax)){
            $overall_tax_value = str_replace('%','',$overall_tax);
            $overall_tax_value = " (". $overall_tax_value ."%)";
        }
        if(!empty($igst_value)){  

            $pdf->SetX(95);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(75,5,'IGST'.$overall_tax_value,1,0,'R',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(30,5,$igst_value,1,1,'R',0);
        }
    }

    if(!empty($total_tax_value)){  

        $pdf->SetX(95);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(75,5,'Total Tax',1,0,'R',0);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(30,5,$total_tax_value,1,1,'R',0);
    }

    
    if(!empty($round_off_type))
    {
        if($round_off_type == '1')
        {
            $round_off_value = "+ ".$round_off_value;
        }
        elseif($round_off_type == '2')
        {
            $round_off_value = " - ".$round_off_value;
        }
    }
// echo $round_off_value;
    if(!empty($round_off_value)) {
        $pdf->SetX(95);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(75,5,'Round off',1,0,'R',0);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(30,5,$round_off_value,1,1,'R',0);
    }

    if(!empty($bill_total_amount)) {
        $bill_total_amount = $obj->numberFormat($bill_total_amount,2);

        $pdf->SetX(95);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(75,5,'Bill Total',1,0,'R',0);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(30,5,$bill_total_amount,1,1,'R',0);
    }
    
    $y3=$pdf->getY();
    $pdf->SetFont('Arial','',8);
    $pdf->SetX(10);
    $pdf->Cell(40,5,'Amount Chargeable (in words)',0,0,'L',0);
    $pdf->SetX(10);
    $pdf->Cell(0,5,'E. & O.E',0,1,'R',0);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetX(10);
    $pdf->Cell(150,5,getIndianCurrency($total_amount).' Only',0,1,'L',0);
    $y31=$pdf->GetY();
    $pdf->SetY($y3);
    $pdf->Cell(0,$y31-$y3,'',1,1,'L');

    $line_y = $pdf->GetY();
    $pdf->Line(10, $line_y, 200, $line_y);
    $pdf->SetFont('Arial', 'BU', 8);
    $pdf->SetX(10);

    $pdf->SetY($line_y+2);
    $pdf->SetX(155);
    $pdf->SetFont('Arial', 'B', 9);
      $pdf->SetY($line_y);
    $pdf->SetFont('Arial','BU',9);
    $pdf->Cell(100,5,'Declaration', 0, 1, '');
    $pdf->SetY($line_y);
    $pdf->SetFont('Arial', 'B', 9);

    $pdf->SetX(160);
    $pdf->Cell(90, 7,html_entity_decode($company_name), 0, 1, 'L', 0);
    $pdf->SetFont('Arial','',8);
    $pdf->setX(13);
    if(!empty($terms_and_condition)){
        $pdf->MultiCell(90,4,'* '.$terms_and_condition, 0, 1, '');
    }else{
        $pdf->MultiCell(90,4,'* We declare that this bill shows the actual price of the goods described and that all particulars are true and correct. ', 0, 1, '');
    }
      
    $pdf->setX(13);
    $pdf->MultiCell(90,6,'* Subject to SIVAKASI jurisdiction only', 0, 1, '');
    $pdf->Cell(190,2,'', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 9);

    $pdf->SetY($line_y+15);
    $pdf->SetX(155);
    $pdf->Cell(90, 5, 'Authorized Signatory', 0, 1, 'L', 0);
    $end_y = $pdf->GetY();

    $pdf->SetFont('Arial', '', 7);
    $pdf->SetY(10);
    $pdf->SetX(10);
    $pdf->Cell(190, $end_y - 7, '', 1, 1, 'C');

//    $pdf->SetY(280);
    $pdf->Cell(190,3,'***This is a Computer Generated bill. Hence Digital Signature is not required.***',0,0,'C',0);

    $pdf->SetFont('Arial','I',7);
    // $pdf->SetY(-15);
    $pdf->SetX(10);
    $pdf->Cell(190,4,'Page No : '.$pdf->PageNo().' / {nb}',0,0,'R');
    $pdf->Output('I', $purchase_entry_number);
    // $pdf->Output();

}
