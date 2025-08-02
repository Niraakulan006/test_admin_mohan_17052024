<?php 

    $company_list = array();
    $company_list = $obj->getTableRecords($GLOBALS['organization_table'], 'id', '1', '');

    $company_name = ""; $company_city = ""; $company_district = ""; $company_state = "";$company_mobile_number = ""; $company_gst_number = "";

    if(!empty($company_list)) {
        foreach($company_list as $data) {
            if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                $company_name = html_entity_decode($obj->encode_decode('decrypt', $data['name']));
            }
            if(!empty($data['city']) && $data['city'] != $GLOBALS['null_value']) {
                $company_city = $obj->encode_decode('decrypt', $data['city']);
            }
            if(!empty($data['district']) && $data['district'] != $GLOBALS['null_value']) {
                $company_district = $obj->encode_decode('decrypt', $data['district']);
            }
            if(!empty($data['state']) && $data['state'] != $GLOBALS['null_value']) {
                $company_state = $obj->encode_decode('decrypt', $data['state']);
            }
            if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                $company_mobile_number = $obj->encode_decode('decrypt', $data['mobile_number']);
            }
            if(!empty($data['gst_number']) && $data['gst_number'] != $GLOBALS['null_value']) {
                $company_gst_number = $obj->encode_decode('decrypt', $data['gst_number']);
            }
        }
    }
    $header_y = $pdf->GetY();
    $pdf->SetFont('Arial','B',12);
    $pdf->SetX(10);
    $pdf->Cell(190,6,$company_name,0,1,'C');
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(190,3,$company_city.', '.$company_district.' (Dist.)',0,1,'C');
    $pdf->Cell(190,3,$company_state,0,1,'C');
    $pdf->Cell(190,3,'Contact : '.$company_mobile_number,0,1,'C');
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(190,4,'GST IN : '.$company_gst_number,0,1,'C');

    $pdf->SetY($header_y);
    $pdf->SetX(10);
    $pdf->Cell(190,20,'',1,1,'C');
