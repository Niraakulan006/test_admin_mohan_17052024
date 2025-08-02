<?php 
	include("include_user_check_and_files.php");
    include "link_style_script.php";
    include "header.php"; 

    $year_list = array();
    $year_list = $obj->getBillingYearList();

    $billing_year = "";
    if(isset($_SESSION['billing_year']) && !empty($_SESSION['billing_year'])) {
        $billing_year = $_SESSION['billing_year'];
    }

    $year = date('Y'); $month = date("m");
    if(!empty($year) && !empty($month)) {
        $month = (int)$month;
        if($month <= 3) { $year = $year - 1; }
    }
    if(empty($billing_year)) {
        if(!empty($year)) {
			$_SESSION['billing_year'] = $year;
            $billing_year = $year;
			$_SESSION['billing_year_starting_date'] = "01-04-".$year;
			$_SESSION['billing_year_ending_date'] = "31-03-".($year + 1);
		}
    }
    $vehicle_expiry_list = array();
    $vehicle_expiry_list = $obj->VehicleInsuranceExpiryList();

    $driver_license_expiry_list = array();
    $driver_license_expiry_list = $obj->DriverLicenseExpiryList();
?>
<!--Right Content-->
    <div class="pcoded-content">
        <div class="page-header card">
            <div class="mt-1">
                <?php 
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

                    $updated = "";
                  //  $updated = $obj->ClearLRDetails($from_date, $to_date);
                ?>

                <div class="row mx-0">
                    <div class="col-lg-3 col-md-6 col-12 py-3">
                        <div class="card">
                            <div class="card-header text-white">Billing Year</div>
                            <div class="card-body">
                                <select name="billing_year" class="form-control" onChange="Javascript:ChangeBillingYear(this.value);">
                                    <option value="">Select</option>
                                    <?php
                                        if(!empty($year_list)) {
                                            foreach($year_list as $year) {
                                                if(!empty($year)) {
                                    ?>
                                                    <option value="<?php echo $year; ?>" <?php if(!empty($billing_year) && $year == $billing_year) { ?>selected="selected"<?php } ?> ><?php echo $year." - ".($year + 1); ?></option>
                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </select>                                
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!empty($vehicle_expiry_list) || !empty($driver_license_expiry_list)) { ?>
                    <div class="row mx-0 justify-content-center">
                        <?php if(!empty($vehicle_expiry_list)) { ?>
                            <div class="col-lg-12 col-md-12 col-12 py-2">
                                <div class="card">
                                    <div class="card-header text-white text-center">Vehicle Insurance Expiry Remainder</div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-nowrap table-bordered border nowrap smallfnt cursor text-center w-100">
                                                <thead class="bg-dark text-white">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Vehicle No.</th>
                                                        <th>Mobile No.</th>
                                                        <th>Expiry Date</th>
                                                        <th>Permit Date</th>
                                                        <th>Fitness Date</th>
                                                        <th>PUCC Date</th>
                                                        <th>N/P Tax Date</th>
                                                        <th>Road Tax Date</th>
                                                        <th>Bal. Days</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($vehicle_expiry_list as $data) {
                                                            $balance_days = 0; $insurance_date = "";
                                                            $insurance_date = new DateTime(date('Y-m-d', strtotime($data['insurance_date'])));
                                                            $today = new DateTime();
                                                            $interval = $today->diff($insurance_date);
                                                            $balance_days = ($interval->days) + 1;
                                                            ?>
                                                            <tr>
                                                                <th>
                                                                    <?php
                                                                        if(!empty($data['name']) && $data['name'] != $GLOBALS['null_value']) {
                                                                            echo $obj->encode_decode('decrypt', $data['name']);
                                                                        }
                                                                    ?>
                                                                </th>
                                                                <th>
                                                                    <?php
                                                                        if(!empty($data['vehicle_number']) && $data['vehicle_number'] != $GLOBALS['null_value']) {
                                                                            echo $obj->encode_decode('decrypt', $data['vehicle_number']);
                                                                        }
                                                                    ?>
                                                                </th>
                                                                <th>
                                                                    <?php
                                                                        if(!empty($data['mobile_number']) && $data['mobile_number'] != $GLOBALS['null_value']) {
                                                                            echo $obj->encode_decode('decrypt', $data['mobile_number']);
                                                                        }
                                                                    ?>
                                                                </th>
                                                                <th>
                                                                    <?php
                                                                        if(!empty($data['insurance_date'])) {
                                                                            echo date('d-m-Y', strtotime($data['insurance_date']));
                                                                        }
                                                                    ?>
                                                                </th>
                                                                  <th>
                                                                    <?php
                                                                        if(!empty($data['permit_date'])) {
                                                                            echo date('d-m-Y', strtotime($data['permit_date']));
                                                                        }
                                                                    ?>
                                                                </th>
                                                                  <th>
                                                                    <?php
                                                                        if(!empty($data['fitness_date'])) {
                                                                            echo date('d-m-Y', strtotime($data['fitness_date']));
                                                                        }
                                                                    ?>
                                                                </th>
                                                                  <th>
                                                                    <?php
                                                                        if(!empty($data['pollution_date'])) {
                                                                            echo date('d-m-Y', strtotime($data['pollution_date']));
                                                                        }
                                                                    ?>
                                                                </th>
                                                                  <th>
                                                                    <?php
                                                                        if(!empty($data['np_tax_date'])) {
                                                                            echo date('d-m-Y', strtotime($data['np_tax_date']));
                                                                        }
                                                                    ?>
                                                                </th>
                                                                  <th>
                                                                    <?php
                                                                        if(!empty($data['road_tax_date'])) {
                                                                            echo date('d-m-Y', strtotime($data['road_tax_date']));
                                                                        }
                                                                    ?>
                                                                </th>
                                                                <th class="text-danger">
                                                                    <?php
                                                                        if($insurance_date < $today) {
                                                                            echo "Expired";
                                                                        }
                                                                        else {
                                                                            echo $balance_days." Days";
                                                                        }
                                                                    ?>
                                                                </th>
                                                            </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if(!empty($driver_license_expiry_list)) { ?>
                            <div class="col-lg-6 col-md-12 col-12 py-2">
                                <div class="card">
                                    <div class="card-header text-white text-center">Driver License Expiry Remainder</div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap table-bordered border nowrap smallfnt cursor text-center w-100">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>License No.</th>
                                                            <th>Mobile No.</th>
                                                            <th>Expiry Date</th>
                                                            <th>Bal. Days</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            foreach($driver_license_expiry_list as $data) {
                                                                $balance_days = 0; $expiry_date = "";
                                                                $expiry_date = new DateTime(date('Y-m-d', strtotime($data['expiry_date'])));
                                                                $today = new DateTime();
                                                                $interval = $today->diff($expiry_date);
                                                                $balance_days = ($interval->days) + 1;
                                                                ?>
                                                                </tr>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['driver_name']) && $data['driver_name'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['driver_name']);
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['license_number']) && $data['license_number'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['license_number']);
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['driver_number']) && $data['driver_number'] != $GLOBALS['null_value']) {
                                                                                echo $obj->encode_decode('decrypt', $data['driver_number']);
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php
                                                                            if(!empty($data['expiry_date'])) {
                                                                                echo date('d-m-Y', strtotime($data['expiry_date']));
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                    <th class="text-danger">
                                                                        <?php
                                                                            if($expiry_date < $today) {
                                                                                echo "Expired";
                                                                            }
                                                                            else {
                                                                                echo $balance_days." Days";
                                                                            }
                                                                        ?>
                                                                    </th>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<!--Right Content End-->
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#dashboard").addClass("active");
    });

    jQuery('select[name="billing_year"]').select2();

    function ChangeBillingYear(billing_year) {
        var check_login_session = 1;
        var post_url = "dashboard_changes.php?check_login_session=1";
        jQuery.ajax({url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var numbers_regex = /^\d+$/;

                if(jQuery('select[name="billing_year"]').parent().find('.alert').length > 0) {
                    jQuery('select[name="billing_year"]').parent().find('.alert').remove();
                }

                var check_login_session = 1;
                var post_url = "dashboard_changes.php?update_billing_year="+billing_year;
                jQuery.ajax({url: post_url, success: function (result) {
                    result = jQuery.trim(result);
                    if (numbers_regex.test(result) == true) {
                        jQuery('select[name="billing_year"]').before('<div class="alert alert-success">Updated Successfully</div>');
                        setTimeout(function () { window.location.reload(); }, 1000);
                    }
                    /*else {
                        jQuery('select[name="billing_year"]').before('<div class="alert alert-danger">'+result+'</div>');
                    }*/
                }});
                
            }
            else {
                window.location.reload();
            }
        }});
    }
</script>