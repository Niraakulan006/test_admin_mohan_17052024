
CREATE TABLE `mohan_payment_mode` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `mohan_payment_mode`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `mohan_payment_mode`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  
CREATE TABLE `mohan_bank` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `account_name` mediumtext NOT NULL,
  `account_number` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `ifsc_code` mediumtext NOT NULL,
  `account_type` mediumtext NOT NULL,
  `bank_name_account_number` mediumtext NOT NULL,
  `branch` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `estimate_balance_date` mediumtext NOT NULL,
  `invoice_balance_date` mediumtext NOT NULL,
  `estimate_opening_balance` mediumtext NOT NULL,
  `invoice_opening_balance` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;ALTER TABLE `mohan_bank`
  ADD PRIMARY KEY (`id`);ALTER TABLE `mohan_bank`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  
CREATE TABLE `mohan_product` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `purchase_price` mediumtext NOT NULL,
  `hsn_code` mediumtext NOT NULL,
  `tax_slab` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `mohan_product`
  ADD PRIMARY KEY (`id`);ALTER TABLE `mohan_product`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  
CREATE TABLE `mohan_party` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `party_type` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `pincode` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `party_details` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `mohan_party`
  ADD PRIMARY KEY (`id`);ALTER TABLE `mohan_party`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;



CREATE TABLE `mohan_payment` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL DEFAULT '',
  `bill_id` mediumtext NOT NULL,
  `bill_number` mediumtext NOT NULL,
  `bill_date` date NOT NULL,
  `bill_type` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `party_type` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `open_balance_type` mediumtext NOT NULL,
  `credit` mediumtext NOT NULL,
  `debit` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `mohan_payment`
  ADD PRIMARY KEY (`id`);ALTER TABLE `mohan_payment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  CREATE TABLE `mohan_invest` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `invest_id` mediumtext NOT NULL,
  `invest_number` mediumtext NOT NULL,
  `invest_date` date NOT NULL,
  `party_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


CREATE TABLE `mohan_return` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `return_id` mediumtext NOT NULL,
  `return_number` mediumtext NOT NULL,
  `return_date` date NOT NULL,
  `party_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


CREATE TABLE `mohan_role` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `role_id` mediumtext NOT NULL,
  `role_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `access_pages` mediumtext NOT NULL,
  `access_page_actions` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `mohan_role`
  ADD PRIMARY KEY (`id`);ALTER TABLE `mohan_role`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  
  ALTER TABLE `mohan_user` ADD `role_id` MEDIUMTEXT NOT NULL AFTER `admin`, ADD `role_name` MEDIUMTEXT NOT NULL AFTER `role_id`; 

  ALTER TABLE `mohan_organization` ADD `payment_mode_id` MEDIUMTEXT NOT NULL AFTER `send_sms`, ADD `payment_mode_name` MEDIUMTEXT NOT NULL AFTER `payment_mode_id`, ADD `payment_tax_type` MEDIUMTEXT NOT NULL AFTER `payment_mode_name`, ADD `amount` MEDIUMTEXT NOT NULL AFTER `payment_tax_type`; 
  ALTER TABLE `mohan_organization` ADD `total_amount` MEDIUMTEXT NOT NULL AFTER `amount`; 
  ALTER TABLE `mohan_organization` ADD `bank_id` MEDIUMTEXT NOT NULL AFTER `payment_mode_name`, ADD `bank_name` MEDIUMTEXT NOT NULL AFTER `bank_id`; 

  ALTER TABLE `mohan_payment` ADD `payment_tax_type` MEDIUMTEXT NOT NULL AFTER `debit`;


  ALTER TABLE `mohan_return` ADD `payment_tax_type` MEDIUMTEXT NOT NULL AFTER `total_amount`; 

ALTER TABLE `mohan_invest` ADD `payment_tax_type` MEDIUMTEXT NOT NULL AFTER `total_amount`; 


CREATE TABLE `mohan_voucher` (
  `id` int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `voucher_id` mediumtext NOT NULL,
  `voucher_number` mediumtext NOT NULL,
  `voucher_date` date NOT NULL,
  `bill_type` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `party_type` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `payment_tax_type` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL
)


CREATE TABLE `mohan_charges` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `charges_id` mediumtext NOT NULL,
  `charges_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `mohan_charges`
  ADD PRIMARY KEY (`id`);ALTER TABLE `mohan_charges`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;



-- Jegan 


CREATE TABLE `mohan_expense` (
  `id` int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `expense_id` mediumtext NOT NULL,
  `expense_number` mediumtext NOT NULL,
  `expense_date` date NOT NULL,
  `payment_tax_type` mediumtext NOT NULL,
  `expense_category_id` mediumtext NOT NULL,
  `expense_category_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL
);

CREATE TABLE `mohan_expense_category` (
  `id` int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `expense_category_id` mediumtext NOT NULL,
  `expense_category_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
);




ALTER TABLE `mohan_unit` CHANGE `id` `id` INT(100) NOT NULL AUTO_INCREMENT;



CREATE TABLE `mohan_purchase_entry` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `purchase_entry_id` mediumtext NOT NULL,
  `purchase_entry_date` date NOT NULL,
  `purchase_bill_date` date NOT NULL DEFAULT current_timestamp(),
  `purchase_entry_number` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name_mobile_city` mediumtext NOT NULL,
  `party_details` mediumtext NOT NULL,
  `company_state` mediumtext NOT NULL,
  `party_state` mediumtext NOT NULL,
  `gst_option` mediumtext NOT NULL,
  `tax_type` mediumtext NOT NULL,
  `tax_option` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_qty` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `final_rate` mediumtext NOT NULL,
  `overall_tax` mediumtext NOT NULL,
  `product_amount` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `sub_total` mediumtext NOT NULL,
  `discount_name` mediumtext NOT NULL,
  `discount` mediumtext NOT NULL,
  `discount_value` mediumtext NOT NULL,
  `discounted_total` mediumtext NOT NULL,
  `charges_id` mediumtext NOT NULL,
  `charges_value` mediumtext NOT NULL,
  `charges_total` mediumtext NOT NULL,
  `cgst_value` mediumtext NOT NULL,
  `sgst_value` mediumtext NOT NULL,
  `igst_value` mediumtext NOT NULL,
  `total_tax_value` mediumtext NOT NULL,
  `product_tax` mediumtext NOT NULL,
  `charges_tax` mediumtext NOT NULL,
  `round_off` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `round_off_type` mediumtext NOT NULL,
  `round_off_value` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



ALTER TABLE `mohan_purchase_entry`
  ADD PRIMARY KEY (`id`);ALTER TABLE `mohan_purchase_entry`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Replace
DROP TABLE `mohan_receipt`;



CREATE TABLE `mohan_receipt` (
  `id` int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `receipt_id` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `receipt_number` mediumtext NOT NULL,
  `receipt_date` date NOT NULL,
  `gcno` mediumtext NOT NULL,
  `payment_tax_type` mediumtext NOT NULL,
  `lr_id` mediumtext NOT NULL,
  `lr_number` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `party_type` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `sales_bill_id` mediumtext NOT NULL,
  `consignor_city` mediumtext NOT NULL,
  `consignor_id` mediumtext NOT NULL,
  `consignor_mobile_number` mediumtext NOT NULL,
  `consignee_city` mediumtext NOT NULL,
  `consignee_id` mediumtext NOT NULL,
  `consignee_mobile_number` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `freight` mediumtext NOT NULL,
  `cooly` mediumtext NOT NULL,
  `bill_no` mediumtext NOT NULL,
  `bill_date` date NOT NULL,
  `bill_value` mediumtext NOT NULL,
  `private_mark` mediumtext NOT NULL,
  `pay_option` mediumtext NOT NULL,
  `vehicle_no` mediumtext NOT NULL,
  `cnr_client_name` mediumtext NOT NULL,
  `cne_client_name` mediumtext NOT NULL,
  `tax_percentage` mediumtext NOT NULL,
  `gst_option` int(100) NOT NULL,
  `consignee_state` mediumtext NOT NULL,
  `consignor_state` mediumtext NOT NULL,
  `consignor_gst_number` mediumtext NOT NULL,
  `consignee_gst_number` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `consignor_identification` mediumtext NOT NULL,
  `consignee_identification` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL
);

CREATE TABLE `mohan_suspense_party` (
  `id` int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `suspense_party_id` mediumtext NOT NULL,
  `suspense_party_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `pincode` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `suspense_party_details` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
);

CREATE TABLE `mohan_suspense_receipt` (
  `id` int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `suspense_receipt_id` mediumtext NOT NULL,
  `suspense_receipt_number` mediumtext NOT NULL,
  `suspense_receipt_date` date NOT NULL,
  `bill_type` mediumtext NOT NULL,
  `suspense_party_id` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `suspense_party_type` mediumtext NOT NULL,
  `suspense_party_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `payment_tax_type` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL
);

CREATE TABLE `mohan_suspense_voucher` (
  `id` int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `suspense_voucher_id` mediumtext NOT NULL,
  `suspense_voucher_number` mediumtext NOT NULL,
  `suspense_voucher_date` date NOT NULL,
  `bill_type` mediumtext NOT NULL,
  `suspense_party_id` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `suspense_party_type` mediumtext NOT NULL,
  `suspense_party_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `payment_tax_type` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL
);


ALTER TABLE `mohan_vehicle` CHANGE `id` `id` INT(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `mohan_vehicle` ADD `vehicle_type` MEDIUMTEXT NOT NULL AFTER `vehicle_number`, 
ADD `insurance_date` MEDIUMTEXT NOT NULL AFTER `vehicle_type`;


ALTER TABLE `mohan_driver` ADD `license_number` MEDIUMTEXT NOT NULL AFTER `lower_case_name`, ADD `license_type` MEDIUMTEXT NOT NULL AFTER `license_number`, ADD `expiry_date` MEDIUMTEXT NOT NULL AFTER `license_type`;



-- nirakulan


CREATE TABLE mohan_unit_price (
 id int(100) NOT NULL AUTO_INCREMENT,
 created_date_time datetime NOT NULL,
 creator mediumtext NOT NULL,
 creator_name mediumtext NOT NULL,
 bill_company_id mediumtext NOT NULL,
 party_type mediumtext NOT NULL,
 party_id mediumtext NOT NULL,
 party_name mediumtext NOT NULL,
 unit_id mediumtext NOT NULL,
 unit_name mediumtext NOT NULL,
 price_value mediumtext NOT NULL,
 deleted int(100) NOT NULL,
 PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


ALTER TABLE `mohan_branch` ADD `opening_balance` MEDIUMTEXT NOT NULL AFTER `district`, ADD `opening_balance_type` MEDIUMTEXT NOT NULL AFTER `opening_balance`; 
ALTER TABLE `mohan_payment` ADD `branch_id` MEDIUMTEXT NOT NULL AFTER `party_type`; 
ALTER TABLE `mohan_branch` ADD `tax_opening_balance` MEDIUMTEXT NOT NULL AFTER `opening_balance_type`, ADD `tax_opening_balance_type` MEDIUMTEXT NOT NULL AFTER `tax_opening_balance`; 


ALTER TABLE `mohan_consignee` ADD `unit_id` MEDIUMTEXT NOT NULL AFTER `others_city`, ADD `unit_name` MEDIUMTEXT NOT NULL AFTER `unit_id`, ADD `price_value` MEDIUMTEXT NOT NULL AFTER `unit_name`; 
ALTER TABLE `mohan_consignor` ADD `unit_id` MEDIUMTEXT NOT NULL AFTER `bill_company_id`, ADD `unit_name` MEDIUMTEXT NOT NULL AFTER `unit_id`, ADD `price_value` MEDIUMTEXT NOT NULL AFTER `unit_name`; 
ALTER TABLE `mohan_account_party` ADD `unit_id` MEDIUMTEXT NOT NULL AFTER `identification`, ADD `unit_name` MEDIUMTEXT NOT NULL AFTER `unit_id`, ADD `price_value` MEDIUMTEXT NOT NULL AFTER `unit_name`; 
ALTER TABLE `mohan_lr` ADD `consignor_state` MEDIUMTEXT NOT NULL AFTER `consignee_state`, ADD `from_branch_state` MEDIUMTEXT NOT NULL AFTER `consignor_state`; 
ALTER TABLE `mohan_lr` CHANGE `branch_id` `from_branch_id` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL; 
ALTER TABLE `mohan_lr` ADD `from_branch_name` MEDIUMTEXT NOT NULL AFTER `from_branch_id`, ADD `to_branch_id` MEDIUMTEXT NOT NULL AFTER `from_branch_name`, ADD `to_branch_name` MEDIUMTEXT NOT NULL AFTER `to_branch_id`; 
ALTER TABLE `mohan_lr` ADD `consignor_name` MEDIUMTEXT NOT NULL AFTER `consignee_id`, ADD `consignee_name` MEDIUMTEXT NOT NULL AFTER `consignor_name`; 
ALTER TABLE `mohan_lr` ADD `account_party_name` MEDIUMTEXT NOT NULL AFTER `account_party_id`; 
DROP TABLE `mohan_tripsheet`;
CREATE TABLE `mohan_tripsheet` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `created_date_time` datetime NOT NULL,
 `creator` mediumtext NOT NULL,
 `creator_name` mediumtext NOT NULL,
 `tripsheet_id` mediumtext NOT NULL,
 `tripsheet_number` mediumtext NOT NULL,
 `organization_id` mediumtext NOT NULL,
 `organization_details` mediumtext NOT NULL,
 `godown_id` mediumtext NOT NULL,
 `tripsheet_date` date NOT NULL,
 `reference_number` mediumtext NOT NULL,
 `vehicle_id` mediumtext NOT NULL,
 `vehicle_name` mediumtext NOT NULL,
 `vehicle_number` mediumtext NOT NULL,
 `from_branch_id` mediumtext NOT NULL,
 `from_branch_name` mediumtext NOT NULL,
 `to_branch_id` mediumtext NOT NULL,
 `to_branch_name` mediumtext NOT NULL,
 `driver_name` mediumtext NOT NULL,
 `driver_number` mediumtext NOT NULL,
 `helper_name` mediumtext NOT NULL,
 `lr_id` mediumtext NOT NULL,
 `lr_date` mediumtext NOT NULL,
 `lr_number` mediumtext NOT NULL,
 `from_branch_lr_id` mediumtext NOT NULL,
 `to_branch_lr_id` mediumtext NOT NULL,
 `consignor_id` mediumtext NOT NULL,
 `consignee_id` mediumtext NOT NULL,
 `quantity` mediumtext NOT NULL,
 `weight` mediumtext NOT NULL,
 `unit_id` mediumtext NOT NULL,
 `price_per_qty` mediumtext NOT NULL,
 `total_amount` mediumtext NOT NULL,
 `bill_type` mediumtext NOT NULL,
 `luggage_id` mediumtext NOT NULL,
 `is_acknowledged` int(100) NOT NULL,
 `cancelled` int(100) NOT NULL,
 `deleted` int(100) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci



ALTER TABLE `mohan_purchase_entry` ADD `payment_updation` MEDIUMTEXT NOT NULL AFTER `round_off_value`; 

ALTER TABLE `mohan_voucher` ADD `purchase_entry_id` MEDIUMTEXT NOT NULL AFTER `payment_tax_type`; 

ALTER TABLE `mohan_payment` CHANGE `bill_date` `bill_date` DATE NOT NULL; 


-- nirakulan

ALTER TABLE `mohan_role` ADD `is_branch_staff` MEDIUMTEXT NOT NULL AFTER `access_page_actions`; 
ALTER TABLE `mohan_user` ADD `branch_id` MEDIUMTEXT NOT NULL AFTER `role_name`, ADD `is_branch_staff` MEDIUMTEXT NOT NULL AFTER `branch_id`; 
ALTER TABLE `mohan_user` CHANGE `id` `id` INT(100) NOT NULL AUTO_INCREMENT; 

ALTER TABLE `mohan_vehicle` CHANGE `insurance_date` `insurance_date` DATE NOT NULL;
ALTER TABLE `mohan_driver` CHANGE `expiry_date` `expiry_date` DATE NOT NULL;



-- new

ALTER TABLE `mohan_consignor` ADD `others_city` MEDIUMTEXT NOT NULL AFTER `price_value`; 

ALTER TABLE `mohan_payment_mode` ADD `cash_balance` MEDIUMTEXT NOT NULL AFTER `lower_case_name`; 

ALTER TABLE `mohan_payment` ADD `cash_balance` MEDIUMTEXT NOT NULL AFTER `payment_tax_type`; 

ALTER TABLE `mohan_receipt` ADD `branch_id` MEDIUMTEXT NOT NULL AFTER `consignee_identification`; 

ALTER TABLE `test_mohan_payment` ADD `lr_id` MEDIUMTEXT NOT NULL AFTER `cash_balance`; 