<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mohan Transport</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/feather.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <link rel="stylesheet" type="text/css" href="css/widget.css">
    <link rel="stylesheet" href="css/datatables/datatables.min.css">

    <link rel="stylesheet" type="text/css" href="include/css/modify.css">
</head>
<body>
<!--Loader-->    
<div class="loader-bg">
    <div class="loader-bar"></div>
</div>
<!--Loader End-->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">
                <div class="navbar-logo">
                    <a href="dashboard.php">
                        <div class="fnt f-14">Mohan Transport</div>
                    </a>
                    <a class="mobile-menu d-block d-lg-none" id="mobile-collapse" href="#">
                        <i class="feather icon-menu icon-toggle-right"></i>
                    </a>
                    <a class="mobile-options waves-effect waves-light">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                    <?php
                        $company_count = 0;
                        $company_count = $obj->CompanyCount();

                        $sidebar_admin_user = 0; $is_branch_staff = 0;
                        $login_user_name = ""; $login_user_type = ""; $login_role_id = ""; $login_role_name = "";
                        $sidebar_branch = 0; $sidebar_vehicle = 0; $sidebar_driver = 0; $sidebar_unit = 0; $sidebar_product = 0;
                        $sidebar_payment_mode = 0; $sidebar_bank = 0; $sidebar_charges = 0; $sidebar_party = 0; $sidebar_consignor = 0;
                        $sidebar_consignee = 0; $sidebar_account_party = 0; $sidebar_purchase_entry = 0; $sidebar_lr = 0;
                        $sidebar_tripsheet = 0; $sidebar_invoice_acknowledgement = 0; $sidebar_unclearance_entry = 0;
                        $sidebar_invest = 0; $sidebar_return = 0; $sidebar_voucher = 0; $sidebar_receipt = 0; $sidebar_expense_category = 0;
                        $sidebar_expense = 0; $sidebar_suspense_party = 0; $sidebar_suspense_voucher = 0; $sidebar_suspense_receipt = 0;
                        $sidebar_reports = 0; $sidebar_tripsheet_profit_loss = 0;
                        if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
                            $login_user_name = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'], 'name');
                            if(!empty($login_user_name) && $login_user_name != $GLOBALS['null_value']) {
                                $login_user_name = $obj->encode_decode('decrypt', $login_user_name);
                            }
                            $login_role_id = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'], 'role_id');
                            if(!empty($login_role_id) && $login_role_id != $GLOBALS['null_value']) {
                                $login_role_name = $obj->getTableColumnValue($GLOBALS['role_table'], 'role_id', $login_role_id, 'role_name');
                                if(!empty($login_role_name) && $login_role_name != $GLOBALS['null_value']) {
                                    $login_role_name = $obj->encode_decode('decrypt', $login_role_name);
                                }
                            }
                            else {
                                $login_role_name = "Super Admin";
                            }
                        }
                        if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
                            $login_user_type = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'];
                        }
                        if($company_count > 0) {
                            if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_type'])) {
                                if($login_user_type == $GLOBALS['admin_user_type']) {
                                    $sidebar_admin_user = 1;
                                }
                                else if($login_user_type == $GLOBALS['staff_user_type']) {
                                    $staff_id = "";
                                    if(!empty($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id']) && isset($_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'])) {
                                        $staff_id = $_SESSION[$GLOBALS['site_name_user_prefix'].'_user_id'];
                                        $branch_staff = $obj->getTableColumnValue($GLOBALS['user_table'], 'user_id', $staff_id, 'is_branch_staff');
                                        if($branch_staff == "yes") {
                                            $is_branch_staff = 1;
                                        }
                                    }
                                    if(!empty($staff_id)) {
                                        if($is_branch_staff == '1') {
                                            $sidebar_branch = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['branch_module']);
                                            $sidebar_vehicle = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['vehicle_module']);
                                            $sidebar_driver = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['driver_module']);
                                            $sidebar_unit = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['unit_module']);
                                            $sidebar_payment_mode = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['payment_mode_module']);
                                            $sidebar_bank = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['bank_module']);
                                            $sidebar_consignor = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['consignor_module']);
                                            $sidebar_consignee = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['consignee_module']);
                                            $sidebar_account_party = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['account_party_module']);
                                            $sidebar_lr = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['lr_module']);
                                            $sidebar_tripsheet = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['tripsheet_module']);
                                            $sidebar_tripsheet_profit_loss = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['tripsheet_profit_loss_module']);
                                            $sidebar_invoice_acknowledgement = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['invoice_acknowledgement_module']);
                                            $sidebar_unclearance_entry = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['unclearance_entry_module']);
                                            $sidebar_receipt = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['receipt_module']);
                                            $sidebar_reports = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['reports_module']);
                                        }
                                        else {
                                            $sidebar_branch = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['branch_module']);
                                            $sidebar_vehicle = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['vehicle_module']);
                                            $sidebar_driver = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['driver_module']);
                                            $sidebar_unit = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['unit_module']);
                                            $sidebar_product = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['product_module']);
                                            $sidebar_payment_mode = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['payment_mode_module']);
                                            $sidebar_bank = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['bank_module']);
                                            $sidebar_charges = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['charges_module']);
                                            $sidebar_party = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['party_module']);
                                            $sidebar_consignor = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['consignor_module']);
                                            $sidebar_consignee = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['consignee_module']);
                                            $sidebar_account_party = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['account_party_module']);
                                            $sidebar_purchase_entry = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['purchase_entry_module']);
                                            $sidebar_lr = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['lr_module']);
                                            $sidebar_tripsheet = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['tripsheet_module']);
                                            $sidebar_tripsheet_profit_loss = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['tripsheet_profit_loss_module']);
                                            $sidebar_invoice_acknowledgement = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['invoice_acknowledgement_module']);
                                            $sidebar_unclearance_entry = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['unclearance_entry_module']);
                                            $sidebar_invest = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['invest_module']);
                                            $sidebar_return = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['return_module']);
                                            $sidebar_voucher = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['voucher_module']);
                                            $sidebar_receipt = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['receipt_module']);
                                            $sidebar_expense_category = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['expense_category_module']);
                                            $sidebar_expense = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['expense_module']);
                                            $sidebar_suspense_party = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['suspense_party_module']);
                                            $sidebar_suspense_voucher = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['suspense_voucher_module']);
                                            $sidebar_suspense_receipt = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['suspense_receipt_module']);
                                            $sidebar_reports = $obj->CheckRoleAccessPage($login_role_id,$GLOBALS['reports_module']);
                                        }
                                    }
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </nav>
    </div>
    <!--Side Menu-->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <nav class="pcoded-navbar">
                <div class="nav-list">
                    <div class="pcoded-inner-navbar main-menu">
                        <ul class="pcoded-item pcoded-left-item">
                            <li id="dashboard">
                                <a href="dashboard.php" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"> <i class="fa fa-tachometer"></i></span>
                                    <span class="pcoded-mtext">Dashboard</span>
                                </a>
                            </li>
                            <?php if($login_user_type == $GLOBALS['admin_user_type']) { ?>
                                <li class="pcoded-hasmenu" id="admin">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-plus-circle"></i></span>
                                        <span class="pcoded-mtext">Admin</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li id="organization">
                                            <a href="organization.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"> <i class="fa fa-building-o"></i></span>
                                                <span class="pcoded-mtext">Organization</span>
                                            </a>
                                        </li>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == '1')){ ?>
                                            <li id="role">
                                                <a href="role.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-user"></i></span>
                                                    <span class="pcoded-mtext">Role</span>
                                                </a>
                                            </li>
                                            <li id="user">
                                                <a href="user.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-user"></i></span>
                                                    <span class="pcoded-mtext">User</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_branch) && $sidebar_branch == 1) || (!empty($sidebar_vehicle) && $sidebar_vehicle == 1) || (!empty($sidebar_driver) && $sidebar_driver == 1) || (!empty($sidebar_unit) && $sidebar_unit == 1) || (!empty($sidebar_product) && $sidebar_product == 1) || (!empty($sidebar_payment_mode) && $sidebar_payment_mode == 1) || (!empty($sidebar_bank) && $sidebar_bank == 1) || (!empty($sidebar_charges) && $sidebar_charges == 1) || (!empty($sidebar_party) && $sidebar_party == 1) || (!empty($sidebar_consignor) && $sidebar_consignor == 1) || (!empty($sidebar_consignee) && $sidebar_consignee == 1) || (!empty($sidebar_account_party) && $sidebar_account_party == 1)) { ?>
                                <li class="pcoded-hasmenu" id="creation">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-plus-circle"></i></span>
                                        <span class="pcoded-mtext">Creation</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_branch) && $sidebar_branch == 1)) { ?>
                                            <li id="branch">
                                                <a href="branch.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-home"></i></span>
                                                    <span class="pcoded-mtext">Branch</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_vehicle) && $sidebar_vehicle == 1)) { ?>
                                            <li id="vehicle">
                                                <a href="vehicle.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-bus"></i></span>
                                                    <span class="pcoded-mtext">Vehicle</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_driver) && $sidebar_driver == 1)) { ?>
                                            <li id="driver">
                                                <a href="driver.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-home"></i></span>
                                                    <span class="pcoded-mtext">Driver</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_unit) && $sidebar_unit == 1)) { ?>
                                            <li id="unit">
                                                <a href="unit.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-balance-scale"></i></span>
                                                    <span class="pcoded-mtext">LR Product</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_product) && $sidebar_product == 1)) { ?>
                                            <li id="product">
                                                <a href="product.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-balance-scale"></i></span>
                                                    <span class="pcoded-mtext">Purchase Product</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_payment_mode) && $sidebar_payment_mode == 1)) { ?>
                                            <li id="payment_mode">
                                                <a href="payment_mode.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-balance-scale"></i></span>
                                                    <span class="pcoded-mtext">Payment Mode</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_bank) && $sidebar_bank == 1)) { ?>
                                            <li id="bank">
                                                <a href="bank.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-balance-scale"></i></span>
                                                    <span class="pcoded-mtext">Bank</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_charges) && $sidebar_charges == 1)) { ?>
                                            <li id="charges">
                                                <a href="charges.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-balance-scale"></i></span>
                                                    <span class="pcoded-mtext">Charges</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_party) && $sidebar_party == 1)) { ?>
                                            <li id="purchase_party">
                                                <a href="purchase_party.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-balance-scale"></i></span>
                                                    <span class="pcoded-mtext">Purchase Party</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_consignor) && $sidebar_consignor == 1)) { ?>
                                            <li id="consignor">
                                                <a href="consignor.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-user-circle-o"></i></span>
                                                    <span class="pcoded-mtext">Consignor</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_consignee) && $sidebar_consignee == 1)) { ?>
                                            <li id="consignee">
                                                <a href="consignee.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-user-circle"></i></span>
                                                    <span class="pcoded-mtext">Consignee</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_account_party) && $sidebar_account_party == 1)) { ?>
                                            <li id="accountparty">
                                                <a href="account_party.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-user-circle"></i></span>
                                                    <span class="pcoded-mtext">Account Party</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_purchase_entry) && $sidebar_purchase_entry == 1)) { ?>
                                <li id="purchase">
                                    <a href="purchase_entry.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon">  <i class="bi bi-cart"></i></span>
                                        <span class="pcoded-mtext">Purchase Entry</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_lr) && $sidebar_lr == 1)){ ?>
                                <li id="lr">
                                    <a href="lr.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"> <i class="fa fa-files-o"></i></span>
                                        <span class="pcoded-mtext">LR</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_tripsheet) && $sidebar_tripsheet == 1)) { ?>
                                <li id="tripsheet">
                                    <a href="tripsheet.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"> <i class="fa fa-file"></i></span>
                                        <span class="pcoded-mtext">Tripsheet</span>
                                    </a>
                                </li>
                            <?php } ?>
                         
                            <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_invoice_acknowledgement) && $sidebar_invoice_acknowledgement == 1)) { ?>
                                <li id="invoiceacknowledgement">
                                    <a href="invoice_acknowledgement.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"> <i class="fa fa-pencil-square-o"></i></span>
                                        <span class="pcoded-mtext">Invoice Acknowledgement</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_tripsheet_profit_loss) && $sidebar_tripsheet_profit_loss == 1)) { ?>
                                <li id="tripsheet_profit_loss">
                                    <a href="tripsheet_profit_loss.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"> <i class="fa fa-file"></i></span>
                                        <span class="pcoded-mtext">Tripsheet Profit Loss</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_unclearance_entry) && $sidebar_unclearance_entry == 1)) { ?>
                                <li id="clearanceentry">
                                    <a href="clearance_entry.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"> <i class="fa fa-pencil-square"></i></span>
                                        <span class="pcoded-mtext">UnClearance Entry</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_invest) && $sidebar_invest == 1) || (!empty($sidebar_return) && $sidebar_return == 1) || (!empty($sidebar_voucher) && $sidebar_voucher == 1) || (!empty($sidebar_receipt) && $sidebar_receipt == 1)) {  ?>
                                <li class="pcoded-hasmenu" id="payment">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="bi bi-currency-exchange"></i></span>
                                        <span class="pcoded-mtext">Payment</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_invest) && $sidebar_invest == 1)) { ?>
                                            <li id="invest">
                                                <a href="invest.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Invest</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_return) && $sidebar_return == 1) ) { ?>
                                            <li id="return">
                                                <a href="return.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Return</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_voucher) && $sidebar_voucher == 1)) { ?>
                                            <li id="voucher">
                                                <a href="voucher.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Voucher</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_receipt) && $sidebar_receipt == 1)) { ?>
                                            <li id="receipt">
                                                <a href="receipt.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Receipt</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_expense_category) && $sidebar_expense_category == 1) || (!empty($sidebar_expense) && $sidebar_expense == 1)) { ?>
                                <li class="pcoded-hasmenu" id="expenses">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="bi bi-cash-coin"></i></span>
                                        <span class="pcoded-mtext">Expense</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_expense_category) && $sidebar_expense_category == 1)) { ?>
                                            <li id="expense_category">
                                                <a href="expense_category.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Expense Category</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_expense) && $sidebar_expense == 1)) { ?>
                                            <li id="expense">
                                                <a href="expense.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Expense</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_suspense_party) && $sidebar_suspense_party == 1) || (!empty($sidebar_suspense_receipt) && $sidebar_suspense_receipt == 1) || (!empty($sidebar_suspense_voucher) && $sidebar_suspense_voucher == 1)) {  ?>
                                <li class="pcoded-hasmenu" id="suspense">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="bi bi-coin"></i></span>
                                        <span class="pcoded-mtext">Suspense</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_suspense_party) && $sidebar_suspense_party == 1)) { ?>
                                            <li id="suspense_party">
                                                <a href="suspense_party.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"> <i class="fa fa-balance-scale"></i></span>
                                                    <span class="pcoded-mtext">Suspense Party</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_suspense_voucher) && $sidebar_suspense_voucher == 1)) { ?>
                                            <li id="suspense_voucher">
                                                <a href="suspense_voucher.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Suspense Voucher</span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                        <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_suspense_receipt) && $sidebar_suspense_receipt == 1)) { ?>
                                            <li id="suspense_receipt">
                                                <a href="suspense_receipt.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Suspense Receipt</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if((!empty($sidebar_admin_user) && $sidebar_admin_user == 1) || (!empty($sidebar_reports) && $sidebar_reports == 1)) { ?>
                                <li class="pcoded-hasmenu" id="report">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-ticket"></i></span>
                                        <span class="pcoded-mtext">Reports</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li id="lr_report">
                                            <a href="lr_report.php" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext">LR Report</span>
                                            </a>
                                        </li>
                                        <li id="clearance_report">
                                            <a href="clearance_report.php" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext">Clearance Report</span>
                                            </a>
                                        </li>
                                        <li id="unclearance_report">
                                            <a href="unclearance_report.php" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext">Unclearance Report</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" id="paymentreport">
                                            <a href="payment_report.php" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext"> Payment Report </span>
                                            </a>
                                        </li>
                                        <?php if($is_branch_staff != '1') { ?>
                                            <li class="nav-item" id="suspense_payment_report">
                                                <a href="suspense_payment_report.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext"> Suspense Payment Report </span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="suspense_party_balance_report">
                                                <a href="suspense_party_balance_report.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext"> Suspense Balance Report </span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="purchase_report">
                                                <a href="purchase_report.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext"> Purchase Report </span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="purchase_tax_report">
                                                <a href="purchase_tax_report.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext"> Purchase Tax Report </span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="sales_tax_report">
                                                <a href="sales_tax_report.php" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext"> Sales Tax Report </span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <li class="nav-item" id="pending_balance_report">
                                            <a href="pending_balance_report.php" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext"> Pending Balance Report </span>
                                            </a>
                                        </li>
                                        <li class="nav-item" id="daybook">
                                            <a href="daybook.php" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext"> Daybook </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                        <div class="sidebar-custom logout">
                            <a href="logout.php" class="btn text-white"><i class="fa fa-power-off"></i> Logout </a>
                        </div>
                    </div>
                </div>
            </nav>