ALTER TABLE `test_mohan_vehicle` ADD `pollution_date` DATE NOT NULL AFTER `lower_case_name`, ADD `permit_date` DATE NOT NULL AFTER `pollution_date`, ADD `np_tax_date` DATE NOT NULL AFTER `permit_date`, ADD `road_tax_date` DATE NOT NULL AFTER `np_tax_date`, ADD `fitness_date` DATE NOT NULL AFTER `road_tax_date`; 

ALTER TABLE `test_mohan_consignee` ADD `opening_balance` MEDIUMTEXT NOT NULL AFTER `price_value`, ADD `opening_balance_type` MEDIUMTEXT NOT NULL AFTER `opening_balance`; 


ALTER TABLE `test_mohan_consignor` ADD `opening_balance` MEDIUMTEXT NOT NULL AFTER `price_value`, ADD `opening_balance_type` MEDIUMTEXT NOT NULL AFTER `opening_balance`; 


ALTER TABLE `test_mohan_account_party` ADD `opening_balance` MEDIUMTEXT NOT NULL AFTER `price_value`, ADD `opening_balance_type` MEDIUMTEXT NOT NULL AFTER `opening_balance`; 

ALTER TABLE `test_mohan_account_party` ADD `cooly_value` MEDIUMTEXT NOT NULL AFTER `opening_balance_type`; 

ALTER TABLE `test_mohan_consignor` ADD `cooly_value` MEDIUMTEXT NOT NULL AFTER `others_city`; 

ALTER TABLE `test_mohan_consignee` ADD `cooly_value` MEDIUMTEXT NOT NULL AFTER `opening_balance_type`; 

ALTER TABLE `test_mohan_unit_price` ADD `cooly_value` MEDIUMTEXT NOT NULL AFTER `price_value`; 

ALTER TABLE `test_mohan_tripsheet_profit_loss` ADD `company_expense_type` MEDIUMTEXT NOT NULL AFTER `expense_value`, ADD `driver_expense_type` MEDIUMTEXT NOT NULL AFTER `company_expense_type`; 

ALTER TABLE `test_mohan_tripsheet_profit_loss` ADD `tripsheet_status` MEDIUMTEXT NOT NULL AFTER `driver_expense_type`; 

ALTER TABLE `test_mohan_tripsheet_profit_loss` ADD `company_expense_value` MEDIUMTEXT NOT NULL AFTER `tripsheet_status`, ADD `company_diesel_amount` MEDIUMTEXT NOT NULL AFTER `company_expense_value`, ADD `driver_diesel_amount` MEDIUMTEXT NOT NULL AFTER `company_diesel_amount`; 

ALTER TABLE `test_mohan_expense` ADD `tripsheet_profit_loss_id` MEDIUMTEXT NOT NULL AFTER `total_amount`;

ALTER TABLE `test_mohan_tripsheet_profit_loss` ADD `company_expense_name` MEDIUMTEXT NOT NULL AFTER `tripsheet_status`; 