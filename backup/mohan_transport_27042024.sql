

CREATE TABLE `test_mohan_account_party` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `account_party_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `gst_number` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `price_value` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `cooly_value` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_account_party (id, created_date_time, creator, creator_name, account_party_id, name, address, city, district, mobile_number, state, gst_number, identification, unit_id, unit_name, price_value, opening_balance, opening_balance_type, cooly_value, deleted) VALUES ('1','2025-07-11 22:17:03','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','55334a706332396d64486468636d5636','51554e445545465356466c664d5445774e7a49774d6a55784d4445334d444e664d44453d','545339544c6c5a4654453156556c564851553467526b6c4f52534242556c5254','5645684a556c56515656493d','56476c796458423163673d3d','56476c79645842776458493d','4f4451344f546b794d6a51774d413d3d','5647467461577767546d466b64513d3d','','NULL','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','516d3934','80','','','','0');

INSERT INTO test_mohan_account_party (id, created_date_time, creator, creator_name, account_party_id, name, address, city, district, mobile_number, state, gst_number, identification, unit_id, unit_name, price_value, opening_balance, opening_balance_type, cooly_value, deleted) VALUES ('2','2025-07-31 16:17:09','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','51554e445545465356466c664d7a45774e7a49774d6a55774e4445334d446c664d44493d','51574e6a49464268636e5235494531685a476831','4e6a49784d673d3d','51584a3163484231613274766448526861513d3d','566d6c796457526f645735685a324679','4e5445784d6a45794d5449784d673d3d','5647467461577767546d466b64513d3d','','5a484e685a413d3d','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','55476c6c5932567a','40','200','Debit','600','0');

INSERT INTO test_mohan_account_party (id, created_date_time, creator, creator_name, account_party_id, name, address, city, district, mobile_number, state, gst_number, identification, unit_id, unit_name, price_value, opening_balance, opening_balance_type, cooly_value, deleted) VALUES ('3','2025-07-31 17:24:54','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','51554e445545465356466c664d7a45774e7a49774d6a55774e5449304e5452664d444d3d','546d5633494739755a513d3d','NULL','NULL','546d6c6a62324a68636e4d3d','4e4451304d5449784d6a45794d673d3d','5157356b5957316862694242626d5167546d6c6a62324a686369424a63327868626d527a','','5a484e685a413d3d','NULL','NULL','NULL','10000','Credit','NULL','1');

INSERT INTO test_mohan_account_party (id, created_date_time, creator, creator_name, account_party_id, name, address, city, district, mobile_number, state, gst_number, identification, unit_id, unit_name, price_value, opening_balance, opening_balance_type, cooly_value, deleted) VALUES ('4','2025-07-31 17:28:59','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','51554e445545465356466c664d7a45774e7a49774d6a55774e5449344e546c664d44513d','546d563364336433','5a6e4e6b5a673d3d','NULL','51573568613246775957787361513d3d','4e5455784e5451304e5451314e413d3d','5157356b61484a68494642795957526c6332673d','','63325a6b5a673d3d','NULL','NULL','NULL','2033','Debit','NULL','1');


CREATE TABLE `test_mohan_bank` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_bank (id, created_date_time, creator, creator_name, bill_company_id, bank_id, account_name, account_number, bank_name, ifsc_code, account_type, bank_name_account_number, branch, payment_mode_id, estimate_balance_date, invoice_balance_date, estimate_opening_balance, invoice_opening_balance, deleted) VALUES ('1','2025-07-11 23:14:06','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','516b464f533138784d5441334d6a41794e5445784d5451774e6c38774d513d3d','545539495155346756464a42546c4e5154314a55','4e5445774f5441354d4445774d4467314d444935','51306c5557534256546b6c50546942435155354c','51306c56516a41774d4441784d54513d','NULL','51306c5557534256546b6c50546942435155354c494367314d5441354d446b774d5441774f4455774d6a6b70','55306c575155744255306b3d','5547463562575675644639746232526c587a45314d4463794d4449314d5445314e544135587a4130,5547463562575675644639746232526c587a45784d4463794d4449314d5445774f544534587a4178','','','','','0');


CREATE TABLE `test_mohan_branch` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `creator` mediumtext NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `branch_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `branch_contact_number` mediumtext NOT NULL,
  `branch_lr_prefix` mediumtext NOT NULL,
  `branch_address` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `branch_city` mediumtext NOT NULL,
  `lower_case_city` mediumtext NOT NULL,
  `branch_pincode` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `tax_opening_balance` mediumtext NOT NULL,
  `tax_opening_balance_type` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_branch (id, creator, created_date_time, creator_name, bill_company_id, branch_id, name, branch_contact_number, branch_lr_prefix, branch_address, lower_case_name, branch_city, lower_case_city, branch_pincode, state, district, opening_balance, opening_balance_type, tax_opening_balance, tax_opening_balance_type, others_city, deleted) VALUES ('1','56564e46556c38774d513d3d','2025-07-09 17:41:10','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','4e7a4d334d7a67314e6a63334e773d3d','55315a4c','55326c325957746863326b675457467062673d3d','63326c325957746863326b3d','55326c325957746863326b3d','63326c325957746863326b3d','4e6a49324d546735','5647467461577767546d466b64513d3d','566d6c796457526f645735685a324679','NULL','NULL','NULL','NULL','','0');

INSERT INTO test_mohan_branch (id, creator, created_date_time, creator_name, bill_company_id, branch_id, name, branch_contact_number, branch_lr_prefix, branch_address, lower_case_name, branch_city, lower_case_city, branch_pincode, state, district, opening_balance, opening_balance_type, tax_opening_balance, tax_opening_balance_type, others_city, deleted) VALUES ('2','56564e46556c38774d513d3d','2025-07-09 17:42:58','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','516c4a42546b4e49587a41354d4463794d4449314d4455304d6a5534587a4179','56476870636e56776458493d','4f5459314e54557a4d6a41304f413d3d','56464253','4e43387949464e42553152535353424f515564425569417352456842556b465156564a4254534253543046454c43424f5255465349456450566b5653546b3146546c51675345395455456c55515577734946524953564a5655465653','64476870636e56776458493d','56476c796458423163673d3d','64476c796458423163673d3d','4e6a51784e6a4130','5647467461577767546d466b64513d3d','56476c79645842776458493d','11','Credit','NULL','NULL','','0');

INSERT INTO test_mohan_branch (id, creator, created_date_time, creator_name, bill_company_id, branch_id, name, branch_contact_number, branch_lr_prefix, branch_address, lower_case_name, branch_city, lower_case_city, branch_pincode, state, district, opening_balance, opening_balance_type, tax_opening_balance, tax_opening_balance_type, others_city, deleted) VALUES ('3','56564e46556c38774d513d3d','2025-07-09 17:43:48','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','516c4a42546b4e49587a41354d4463794d4449314d4455304d7a5134587a417a','5457466b64584a6861513d3d','4f446b794d7a497a4e4455774d413d3d','54555256','5457466b64584a6861534243636d46755932673d','6257466b64584a6861513d3d','5457466b64584a68615342585a584e30','6257466b64584a68615342335a584e30','4e6a497a4e545933','5647467461577767546d466b64513d3d','5457466b64584a6861513d3d','2340','Credit','NULL','NULL','','1');

INSERT INTO test_mohan_branch (id, creator, created_date_time, creator_name, bill_company_id, branch_id, name, branch_contact_number, branch_lr_prefix, branch_address, lower_case_name, branch_city, lower_case_city, branch_pincode, state, district, opening_balance, opening_balance_type, tax_opening_balance, tax_opening_balance_type, others_city, deleted) VALUES ('4','56564e46556c38774d513d3d','2025-07-14 15:31:58','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','5132397062574a68644739795a534243636d46755932673d','4f446b344e7a67334e7a67344e773d3d','51303143','516e6c6c4948426863334d67556d39685a413d3d','5932397062574a68644739795a534269636d46755932673d','51586c68626d463259584a6862513d3d','59586c68626d463259584a6862513d3d','4e6a49324d546735','5647467461577767546d466b64513d3d','5132686c626d356861513d3d','30000','Credit','60000','Credit','','0');

INSERT INTO test_mohan_branch (id, creator, created_date_time, creator_name, bill_company_id, branch_id, name, branch_contact_number, branch_lr_prefix, branch_address, lower_case_name, branch_city, lower_case_city, branch_pincode, state, district, opening_balance, opening_balance_type, tax_opening_balance, tax_opening_balance_type, others_city, deleted) VALUES ('5','56564e46556c38774d513d3d','2025-07-17 12:18:54','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','4e444d304d6a4d304d6a4d304d673d3d','566b343d','4d6a55764e5449314e6a59675a4774705957357a62325275','646d357949474a795957356a61413d3d','566d6c796457526f645735685a324679','646d6c796457526f645735685a324679','4d6a4d794d7a497a','5647467461577767546d466b64513d3d','566d6c796457526f645735685a324679','NULL','NULL','NULL','NULL','','0');


CREATE TABLE `test_mohan_charges` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `charges_id` mediumtext NOT NULL,
  `charges_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_charges (id, created_date_time, creator, creator_name, bill_company_id, charges_id, charges_name, lower_case_name, deleted) VALUES ('1','2025-07-15 12:39:40','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','51306842556b6446553138784e5441334d6a41794e5445794d7a6b304d4638774d513d3d','6247396a595777675a47567361585a6c636e6b3d','6247396a595777675a47567361585a6c636e6b3d','0');


CREATE TABLE `test_mohan_company_bill_number` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `create_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `financial_year` date NOT NULL,
  `bill_number_option` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  `creator_name` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `test_mohan_consignee` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `consignee_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `gst_number` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `price_value` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `cooly_value` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_consignee (id, created_date_time, creator, creator_name, consignee_id, name, address, city, mobile_number, district, state, gst_number, identification, others_city, unit_id, unit_name, price_value, opening_balance, opening_balance_type, cooly_value, deleted) VALUES ('1','2025-07-11 22:01:24','56564e46556c38784d5441334d6a41794e5441354e54517a4d5638774e773d3d','55334a706332396d64486468636d5636','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','5530464f52306c4d53513d3d','NULL','55326c325957746863326b3d','4e7a4d334d7a67314e6a63334e773d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','NULL','NULL','','','','','','','0');

INSERT INTO test_mohan_consignee (id, created_date_time, creator, creator_name, consignee_id, name, address, city, mobile_number, district, state, gst_number, identification, others_city, unit_id, unit_name, price_value, opening_balance, opening_balance_type, cooly_value, deleted) VALUES ('2','2025-07-11 22:13:05','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b5646587a45784d4463794d4449314d5441784d7a4131587a4179','545339544c6c5a4654453156556c564851553467526b6c4f52534242556c5254','5645684a556c56515656493d','56476c796458423163673d3d','4f4451344f546b794d6a51774d413d3d','56476c79645842776458493d','5647467461577767546d466b64513d3d','NULL','51554e445431564f5643425151564a5557513d3d','','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','516d3934','80','','','','1');

INSERT INTO test_mohan_consignee (id, created_date_time, creator, creator_name, consignee_id, name, address, city, mobile_number, district, state, gst_number, identification, others_city, unit_id, unit_name, price_value, opening_balance, opening_balance_type, cooly_value, deleted) VALUES ('3','2025-07-14 15:35:24','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','55334a706332396d64486468636d5636','5130394f55306c48546b5646587a45304d4463794d4449314d444d7a4e544930587a417a','564746746157773d','NULL','NULL','4e6a63334e6a63324e6a63334e673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','NULL','NULL','','','','','','','0');

INSERT INTO test_mohan_consignee (id, created_date_time, creator, creator_name, consignee_id, name, address, city, mobile_number, district, state, gst_number, identification, others_city, unit_id, unit_name, price_value, opening_balance, opening_balance_type, cooly_value, deleted) VALUES ('4','2025-07-14 22:45:33','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b5646587a45304d4463794d4449314d5441304e544d7a587a4130','533246796447687061773d3d','NULL','56476c796458423163673d3d','4f5459314e54557a4d6a41304f413d3d','56476c79645842776458493d','5647467461577767546d466b64513d3d','NULL','NULL','NULL','','','','','','','0');

INSERT INTO test_mohan_consignee (id, created_date_time, creator, creator_name, consignee_id, name, address, city, mobile_number, district, state, gst_number, identification, others_city, unit_id, unit_name, price_value, opening_balance, opening_balance_type, cooly_value, deleted) VALUES ('5','2025-07-15 09:44:49','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b5646587a45314d4463794d4449314d446b304e445135587a4131','626d46336157343d','NULL','NULL','4e6a63334e6a59334e6a63324e773d3d','5132397062574a68644739795a513d3d','5647467461577767546d466b64513d3d','NULL','NULL','NULL','','','','','','','0');

INSERT INTO test_mohan_consignee (id, created_date_time, creator, creator_name, consignee_id, name, address, city, mobile_number, district, state, gst_number, identification, others_city, unit_id, unit_name, price_value, opening_balance, opening_balance_type, cooly_value, deleted) VALUES ('6','2025-07-23 11:30:30','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b5646587a497a4d4463794d4449314d54457a4d444d77587a4132','52464d3d','NULL','NULL','4d7a517a4e444d304d7a517a4e413d3d','NULL','564756735957356e59573568','NULL','NULL','NULL','','','','','','','0');

INSERT INTO test_mohan_consignee (id, created_date_time, creator, creator_name, consignee_id, name, address, city, mobile_number, district, state, gst_number, identification, others_city, unit_id, unit_name, price_value, opening_balance, opening_balance_type, cooly_value, deleted) VALUES ('7','2025-07-31 15:26:40','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b5646587a4d784d4463794d4449314d444d794e6a5177587a4133','546d563349454e76626e4e705a32356c5a513d3d','5a47467a5a413d3d','53324679615746775958523061513d3d','4d6a4d794d7a497a4d6a4d794d773d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','5a484e68','','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','55476c6c5932567a','20','200','Credit','30','1');

INSERT INTO test_mohan_consignee (id, created_date_time, creator, creator_name, consignee_id, name, address, city, mobile_number, district, state, gst_number, identification, others_city, unit_id, unit_name, price_value, opening_balance, opening_balance_type, cooly_value, deleted) VALUES ('8','2025-07-31 16:16:07','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b5646587a4d784d4463794d4449314d4451784e6a4133587a4134','5130397563326c6e626d566c4945786859326831','5a47467a5a47467a','51584a3163484231613274766448526861513d3d','4d5449784d6a45794d5449784d673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','NULL','NULL','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','55476c6c5932567a','30','3000','Credit','500','0');


CREATE TABLE `test_mohan_consignor` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `consignor_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `gst_number` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `price_value` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `cooly_value` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('1','2025-07-11 22:01:24','56564e46556c38784d5441334d6a41794e5441354e54517a4d5638774e773d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45784d4463794d4449314d5441774d544930587a4178','533046535645684a','NULL','NULL','4f5459314e54557a4d6a41304f413d3d','NULL','NULL','NULL','NULL','','','','','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('2','2025-07-12 18:58:11','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45794d4463794d4449314d4459314f444578587a4179','545339544c69425453464a4a4945745353564e49546b45675545394d57553146556c4d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f544d304e5441794d6a67354d413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','5545464a52413d3d','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('3','2025-07-12 18:59:38','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45794d4463794d4449314d4459314f544d34587a417a','545339544c69424e515578425645684a494546485255354453555654','55306c575155744255306b3d','55326c325957746863326b3d','4f5455344e54557a4d6a45794e673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('4','2025-07-12 19:03:07','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45794d4463794d4449314d4463774d7a4133587a4130','545339544c694254556b56464946524953564a565545465553456b67516b464d5155704a','55306c575155744255306b3d','55326c325957746863326b3d','4f5451304d7a67324f4441794d773d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('5','2025-07-12 19:04:28','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45794d4463794d4449314d4463774e444934587a4131','545339544c694254556b6b67556b395a5155776756464a425245565355773d3d','55306c575155744255306b3d','55326c325957746863326b3d','4d4451314e6a49794d7a41324e513d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','5545464a52413d3d','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('6','2025-07-12 19:20:56','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45794d4463794d4449314d4463794d445532587a4132','545339544c69424852555655534546535155354a49453947526c4e4656434251556b6c4f5645565355773d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5467304d7a41794e7a63304f513d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('7','2025-07-12 19:23:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45794d4463794d4449314d4463794d7a4177587a4133','545339544c6942615255354a56456767556c5643516b5653','55306c575155744255306b3d','55326c325957746863326b3d','4f5467304d7a49324d5445794e413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('8','2025-07-12 19:25:28','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45794d4463794d4449314d4463794e544934587a4134','545339544c69425351556f675130465352464d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5451344e6a6b784d4463784d673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('9','2025-07-12 19:28:43','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45794d4463794d4449314d4463794f44517a587a4135','545339544c6941675530456755464a4a546c5246556c4d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5467304d7a51344f4441774d513d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('10','2025-07-14 11:03:59','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445774d7a5535587a4577','545339544c6942545655354e5430394f49456c4f5246565456464a4a52564d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5451304d6a59304e4459334e513d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('11','2025-07-14 11:08:55','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445774f445531587a4578','545339544c69425151557842546b6c57525577674c53425453565a42553156535755456756464a425245565355773d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5467304d6a45354f4467354f413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('12','2025-07-14 11:11:24','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445784d544930587a4579','545339544c694256546b6c5749464242513142425130744252305654494368514b53424d5645513d','55306c575155744255306b3d','55326c325957746863326b3d','4f5467304d7a45344e7a45304e513d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','51554e445431564f5643425151564a5557513d3d','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('13','2025-07-14 11:12:58','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445784d6a5534587a457a','545339544c694253515652495355354254534255556b464552564a54','55306c575155744255306b3d','55326c325957746863326b3d','4f4463314e44637a4d7a59324e673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('14','2025-07-14 11:15:41','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45304d4463794d4449314d5445784e545178587a4530','545339544c69424b5155314655794242556c525449454e5351555a5555773d3d','55306c575155744255306b3d','55326c325957746863326b3d','4d4451314e6a49794e7a67794d413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a494330674d4451314e6a49794e7a67794d44553d','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('15','2025-07-14 11:16:59','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445784e6a5535587a4531','545339544c694254556b6b67556b464e49455a4a546b556751564a5555773d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f4459324e7a63794e6a63304e773d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','51554e445431564f5643425151564a5557513d3d','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('16','2025-07-14 11:22:48','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445794d6a5134587a4532','545339544c69424655316442556b6b6755456c44564656535253424e51564a55','55306c575155744255306b3d','55326c325957746863326b3d','4d4451314e6a49794d7a417a4e673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a494330674d4451314e6a49744d6a4d774d7a5935','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('17','2025-07-14 11:24:21','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445794e444978587a4533','545339544c69424c4c6c4d7555694255556b464552564a54','55306c575155744255306b3d','55326c325957746863326b3d','4f4467794e5459334e6a6b7a4e773d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('18','2025-07-14 11:26:22','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445794e6a4979587a4534','54533954494334675530564d4945704652304655','55306c575155744255306b3d','55326c325957746863326b3d','4d4451314e6a49794e5445304d413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','5545464a524341674c5341774e4455324d6a49314d5451774d413d3d','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('19','2025-07-14 11:27:37','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445794e7a4d33587a4535','545339544c69424e515552425469424451564a455579416d4945465356464d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5451304d7a4d324d7a4d794f413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('20','2025-07-14 11:29:21','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445794f544978587a4977','5455464f53565a42546b354254673d3d','56456c535656425655673d3d','56476c796458423163673d3d','4f4441334d6a51324e546b304f513d3d','56476c79645842776458493d','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('21','2025-07-14 11:30:41','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d54457a4d445178587a4978','545339544c69424c515535455345464f49454e42556b5254','56456c535656425655673d3d','56476c796458423163673d3d','4f4467334d4459774f4459774f513d3d','56476c79645842776458493d','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('22','2025-07-14 11:32:15','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d54457a4d6a4531587a4979','545339544c6942485656425551534251556b6c4f5645565355773d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f4463314e4441794e7a41784f413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','51554e445431564f5643425151564a5557513d3d','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('23','2025-07-14 11:33:58','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d54457a4d7a5534587a497a','545339544c69424b5155314a5455456755464a4a546c5246556c4d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5451304d7a55304e4445774d773d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','51554e445431564f5643425151564a5557513d3d','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('24','2025-07-14 11:37:19','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d54457a4e7a4535587a4930','5169354351554a56','55306c575155744255306b3d','55326c325957746863326b3d','4f4467774e7a6b314d54597a4e673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('25','2025-07-14 11:40:11','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445304d444578587a4931','545339544c6942575255784e56564a565230464f49455a4a546b556751564a5555773d3d','56456c535656425655673d3d','56476c796458423163673d3d','4f5467304d7a4d794d6a51774d413d3d','56476c79645842776458493d','5647467461577767546d466b64513d3d','NULL','51554e445431564f5643425151564a5557513d3d','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('26','2025-07-14 11:42:50','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445304d6a5577587a4932','545339544c694251556b464c51564e494945465356464d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5463314d546b784e5451784d673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','51554e445431564f5643425151564a5557513d3d','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('27','2025-07-14 11:44:50','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','5130394f55306c48546b3953587a45304d4463794d4449314d5445304e445577587a4933','545339544c694254556b6b6753314a4a5530684f51534244543078505656493d','55306c575155744255306b3d','55326c325957746863326b3d','4f4459324f4441324e4459774d773d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('28','2025-07-14 15:35:24','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','56476870636e56745a573570','5130394f55306c48546b3953587a45304d4463794d4449314d444d7a4e544930587a4934','5533567961586c68','NULL','NULL','4f4463344e7a67334f4463334f413d3d','NULL','NULL','NULL','NULL','','','','','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('29','2025-07-14 19:18:24','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45304d4463794d4449314d4463784f444930587a4935','545339544c69424e5430684254694255556b464f55314250556c513d','56456c535656425655673d3d','56476c796458423163673d3d','4f5451304d7a4d334d6a41304f413d3d','56476c79645842776458493d','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','Tirupur','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('30','2025-07-14 19:19:40','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45304d4463794d4449314d4463784f545177587a4d77','545339544c69424e52554e42546b3953494531425130684a546b5654','56456c535656425655673d3d','56476c796458423163673d3d','4f5455344e5455774d5455314d513d3d','56476c79645842776458493d','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('31','2025-07-14 19:21:11','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45304d4463794d4449314d4463794d544578587a4d78','545339544c6942585355346756464a425245565355773d3d','56456c535656425655673d3d','56476c796458423163673d3d','4f5451304d7a51774f4441784d413d3d','56476c79645842776458493d','5647467461577767546d466b64513d3d','NULL','51554e445431564f5643425151564a5557513d3d','','NULL','NULL','NULL','','','Tirupur','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('32','2025-07-14 19:22:12','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45304d4463794d4449314d4463794d6a4579587a4d79','545339544c69425753564e4253534255525668555355784655773d3d','56456c535656425655673d3d','56476c796458423163673d3d','4f5451304d7a49304e6a49774d673d3d','56476c79645842776458493d','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','Tirupur','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('33','2025-07-14 20:45:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45304d4463794d4449314d4467304e544177587a4d7a','545339544c69424654457850556b45675531524256456c50546b5653575342514945785552413d3d','55306c575155744255306b3d','55326c325957746863326b3d','4d4451314e6a49794e7a63324e673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a494330674d4451314e6a49794e7a63324e6a453d','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('34','2025-07-14 20:47:22','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45304d4463794d4449314d4467304e7a4979587a4d30','545339544c6942534c6942514c6942514c673d3d','55306c575155744255306b3d','55326c325957746863326b3d','4e7a55354f44597a4f5463354e413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('35','2025-07-14 20:53:36','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45304d4463794d4449314d4467314d7a4d32587a4d31','545339544c69425451555a4a556b556754305a4752564e55494642535355355552564a54','55306c575155744255306b3d','55326c325957746863326b3d','4f5467304d7a41344f446b784e773d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','Sivakasi','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('36','2025-07-14 22:45:33','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45304d4463794d4449314d5441304e544d7a587a4d32','553246755a326c7361513d3d','NULL','NULL','4e7a4d334d7a67314e6a63334e773d3d','NULL','NULL','NULL','NULL','','','','','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('37','2025-07-15 09:44:49','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d446b304e445135587a4d33','63326868626d31315a324674','NULL','NULL','4e7a59344e7a67334e6a63324e773d3d','NULL','NULL','NULL','NULL','','','','','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('38','2025-07-15 16:33:30','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45314d4463794d4449314d44517a4d7a4d77587a4d34','546b464851564a42536b464f','55306c575155744255306b3d','55326c325957746863326b3d','4f5451304d7a4d334e546b304e413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('39','2025-07-15 16:35:42','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45314d4463794d4449314d44517a4e545179587a4d35','545339544c694251556b464c51564e4949455a4a546b556751564a5555773d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5467304d6a67354f4459324d513d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('40','2025-07-15 16:42:04','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45314d4463794d4449314d4451304d6a4130587a5177','545339544c694254556b6b675545394f4946425054466c4e52564a54','55306c575155744255306b3d','55326c325957746863326b3d','4f5455324e6a637a4e4451334f513d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('41','2025-07-15 16:45:46','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45314d4463794d4449314d4451304e545132587a5178','545339544c69424b5155354253306b6755464a4a546c5246556c4d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5449304e5445304d4441314f413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('42','2025-07-15 16:47:14','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45314d4463794d4449314d4451304e7a4530587a5179','545339544c6942534c69424c4c694255556b464552564a54','55306c575155744255306b3d','55326c325957746863326b3d','4f5441304d7a51314f5459304d413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('43','2025-07-15 16:48:26','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45314d4463794d4449314d4451304f444932587a517a','545339544c69424852555655534545675445464e5355354256456c5054673d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5451304d7a45324e4459304e513d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('44','2025-07-15 16:50:41','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45314d4463794d4449314d4451314d445178587a5130','545339544c69424257566c42546b4653494652535155524a546b63675130394e5545464f57513d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5451304d7a4d334e7a55334f413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('45','2025-07-15 16:55:13','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45314d4463794d4449314d4451314e54457a587a5131','545339544c694254556b6b67546b464f52456842546b456756464a425245565355773d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5451304d6a45784e5463774f413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('46','2025-07-15 16:57:30','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d4451314e7a4d77587a5132','545339544c694242553068505379424451564a455579416d4945465356464d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5451304d6a51784f54457a4d673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','NULL','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('47','2025-07-15 16:59:01','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5247566c5a57553d','55306c575155744255306b3d','55326c325957746863326b3d','4d7a51794d7a4d794d6a497a4d673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','NULL','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('48','2025-07-15 17:00:28','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','5130394f55306c48546b3953587a45314d4463794d4449314d4455774d444934587a5134','545339544c694251556b6c4f56455659','55306c575155744255306b3d','55326c325957746863326b3d','4f5467304d7a41794d5445304f413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('49','2025-07-15 19:30:07','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d44637a4d444133587a5135','545339544c69424c556c416755464a4a546c51675545464453773d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5451304d6a49314e4449784e413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','51554e445431564f5643425151564a5557513d3d','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('50','2025-07-15 19:31:47','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d44637a4d545133587a5577','545339544c694254556b6b675455465353566c425546424254694251556b6c4f56456c4f52794251556b565455773d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5451304d6a55794f5445324d413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','51554e445431564f5643425151564a5557513d3d','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('51','2025-07-15 19:36:11','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d44637a4e6a4578587a5578','545339544c694256546b6c52565555675545394d57553146556c6f3d','55306c575155744255306b3d','55326c325957746863326b3d','4f4467334d446b7a4d4459334f513d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('52','2025-07-15 19:38:28','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d44637a4f444934587a5579','545339544c69425451564a42566b464f5153424454307850565649675130394e5545464f57513d3d','55306c575155744255306b3d','55326c325957746863326b3d','4d4451314e6a49794d6a4d314d673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a494330674d4451314e6a49794d6a4d314d6a553d','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('53','2025-07-15 19:41:52','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d4463304d545579587a557a','545339544c6942545346564f54565648534545675255355552564a51556b6c5452564d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f4445794d6a6b314e7a677a4e673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','5545464a52413d3d','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('54','2025-07-15 19:44:00','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d4463304e444177587a5530','5230464f52564e4254673d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5467304d6a45304e446b354e673d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('55','2025-07-15 19:47:12','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d4463304e7a4579587a5531','545339544c694248544539535753424753553546494642425545565355773d3d','55306c575155744255306b3d','55326c325957746863326b3d','4d4451314e6a49794d6a4d7a4e413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','51554e445431564f5643425151564a5557534174494441304e5459794d6a497a4d7a5130','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('56','2025-07-15 19:49:03','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d4463304f54417a587a5532','55464a4652553554','55306c575155744255306b3d','55326c325957746863326b3d','4f5445314f544d314d7a457a4e413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('57','2025-07-15 19:51:25','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d4463314d544931587a5533','545339544c69424252314d3d','55306c575155744255306b3d','55326c325957746863326b3d','4f5467304d7a59324e6a41774f413d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('58','2025-07-15 20:09:30','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d4467774f544d77587a5534','51564a565443424e5155354a','55306c575155744255306b3d','55326c325957746863326b3d','4f5451304d7a63794e4459794e773d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','','','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('59','2025-07-15 20:13:11','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a45314d4463794d4449314d4467784d7a4578587a5535','545339544c69425453456c4f525342515430785a54555653','55306c575155744255306b3d','55326c325957746863326b3d','4f5459314e5455334e444d324f513d3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','NULL','564538675545465a','','NULL','NULL','NULL','','','Sivakasi','NULL','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('60','2025-07-31 15:13:34','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a4d784d4463794d4449314d444d784d7a4d30587a5977','5132397563326c6e626d3979494531685a476831','5a484e68','5157356b615731685a474674','4e6a45324d5445794d7a49784d673d3d','51584a70655746736458493d','5647467461577767546d466b64513d3d','NULL','NULL','','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','55476c6c5932567a','100','1000','Debit','Andimadam','45','1');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('61','2025-07-31 16:14:53','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a4d784d4463794d4449314d4451784e44557a587a5978','5132397563326c6e626d39794946427961586c68','5a475a7a5a6e4e6b','5157356b615731685a474674','4d6a4d794d7a497a4d7a497a4d673d3d','51584a70655746736458493d','5647467461577767546d466b64513d3d','NULL','5a484e6b5a673d3d','','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e513d3d','52334a6862513d3d','20','','0','Andimadam','150','0');

INSERT INTO test_mohan_consignor (id, created_date_time, creator, creator_name, consignor_id, name, address, city, mobile_number, district, state, gst_number, identification, bill_company_id, unit_id, unit_name, price_value, opening_balance, opening_balance_type, others_city, cooly_value, deleted) VALUES ('62','2025-07-31 18:01:31','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','5130394f55306c48546b3953587a4d784d4463794d4449314d4459774d544d78587a5979','5a484e68','NULL','NULL','4d6a4d784d6a4d784d6a4d7a4d673d3d','NULL','5647467461577767546d466b64513d3d','NULL','NULL','','NULL','NULL','NULL','','0','','NULL','1');


CREATE TABLE `test_mohan_driver` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `creator` mediumtext NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `driver_id` mediumtext NOT NULL,
  `driver_name` mediumtext NOT NULL,
  `driver_number` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `license_number` mediumtext NOT NULL,
  `license_type` mediumtext NOT NULL,
  `expiry_date` date NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_driver (id, creator, created_date_time, creator_name, bill_company_id, driver_id, driver_name, driver_number, lower_case_name, license_number, license_type, expiry_date, deleted) VALUES ('1','56564e46556c38774d513d3d','2025-07-09 17:47:24','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','52464a4a566b5653587a41354d4463794d4449314d4455304e7a4930587a4178','566d6c756233526f','4f5463774e6a59314d4455304e413d3d','646d6c756233526f','NULL','1','2025-08-07','0');

INSERT INTO test_mohan_driver (id, creator, created_date_time, creator_name, bill_company_id, driver_id, driver_name, driver_number, lower_case_name, license_number, license_type, expiry_date, deleted) VALUES ('2','56564e46556c38774d513d3d','2025-07-09 17:47:53','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','52464a4a566b5653587a41354d4463794d4449314d4455304e7a557a587a4179','545856796457646862673d3d','4e6a55344f4463354d446b774f413d3d','625856796457646862673d3d','5a6d56795a6d557a4e48497a4e444d3d','2','2025-08-16','0');

INSERT INTO test_mohan_driver (id, creator, created_date_time, creator_name, bill_company_id, driver_id, driver_name, driver_number, lower_case_name, license_number, license_type, expiry_date, deleted) VALUES ('3','56564e46556c38774d513d3d','2025-07-10 15:36:25','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','52464a4a566b5653587a45774d4463794d4449314d444d7a4e6a4931587a417a','526d56335a6e467863513d3d','4d6a4d794d6a55314d6a51314d413d3d','5a6d56335a6e467863513d3d','4e475a6e5a32633d','1','2025-07-11','1');

INSERT INTO test_mohan_driver (id, creator, created_date_time, creator_name, bill_company_id, driver_id, driver_name, driver_number, lower_case_name, license_number, license_type, expiry_date, deleted) VALUES ('4','56564e46556c38774d513d3d','2025-07-15 09:48:36','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','52464a4a566b5653587a45314d4463794d4449314d446b304f444d32587a4130','523246755a584e6f','4e6a63794f446b784f4449334d673d3d','5a3246755a584e6f','64577070627a4a714d6d566b626d747161773d3d','1','2025-08-08','0');


CREATE TABLE `test_mohan_expense` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
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
  `tripsheet_profit_loss_id` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `test_mohan_expense_category` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `expense_category_id` mediumtext NOT NULL,
  `expense_category_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_expense_category (id, created_date_time, creator, creator_name, bill_company_id, expense_category_id, expense_category_name, lower_case_name, deleted) VALUES ('1','2025-07-23 13:12:40','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','','5256685158304e42564638794d7a41334d6a41794e5441784d5449304d5638774d513d3d','52484a70646d567949484e68624746796553426862573931626e51675a5868775a57357a5a513d3d','5a484a70646d567949484e68624746796553426862573931626e51675a5868775a57357a5a513d3d','0');


CREATE TABLE `test_mohan_godown` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `creator` mediumtext NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `test_mohan_godown_staff` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `staff_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `username` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  `access_pages` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `access_page_actions` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `test_mohan_invest` (
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
  `payment_tax_type` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `test_mohan_invoice` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `invoice_id` mediumtext NOT NULL,
  `invoice_number` mediumtext NOT NULL,
  `invoice_date` mediumtext NOT NULL,
  `organization_id` mediumtext NOT NULL,
  `consignor_id` mediumtext NOT NULL,
  `consignee_id` mediumtext NOT NULL,
  `driver_name` mediumtext NOT NULL,
  `helper_name` mediumtext NOT NULL,
  `lr_number` mediumtext NOT NULL,
  `branch_id` mediumtext NOT NULL,
  `vehicle_id` mediumtext NOT NULL,
  `is_acknowledged` mediumtext NOT NULL,
  `cancelled` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  `organization_details` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `test_mohan_login` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `login_date_time` mediumtext NOT NULL,
  `logout_date_time` mediumtext NOT NULL,
  `ip_address` mediumtext NOT NULL,
  `browser` mediumtext NOT NULL,
  `os_detail` mediumtext NOT NULL,
  `type` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('1','2025-07-09 12:18:40','0000-00-00 00:00:00','103.93.105.58','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('2','2025-07-09 12:18:42','0000-00-00 00:00:00','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('3','2025-07-09 13:27:48','0000-00-00 00:00:00','103.93.105.58','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('4','2025-07-09 15:36:26','0000-00-00 00:00:00','103.93.105.58','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('5','2025-07-09 17:33:14','0000-00-00 00:00:00','103.93.105.58','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('6','2025-07-10 11:36:40','0000-00-00 00:00:00','103.93.105.58','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('7','2025-07-10 15:34:25','0000-00-00 00:00:00','103.93.105.58','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('8','2025-07-10 16:17:52','2025-07-10 16:17:57','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('9','2025-07-10 16:31:15','0000-00-00 00:00:00','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('10','2025-07-10 17:03:11','0000-00-00 00:00:00','157.51.44.58','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('11','2025-07-10 18:48:57','0000-00-00 00:00:00','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('12','2025-07-11 10:24:49','2025-07-11 11:20:05','59.98.50.83','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('13','2025-07-11 11:20:27','2025-07-11 11:37:03','59.98.50.83','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('14','2025-07-11 21:45:17','2025-07-11 21:54:42','117.196.90.212','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('15','2025-07-11 21:55:56','2025-07-11 21:57:50','117.196.90.212','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('16','2025-07-11 21:58:04','2025-07-11 22:07:57','117.196.90.212','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784d5441334d6a41794e5441354e54517a4d5638774e773d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('17','2025-07-11 22:08:12','2025-07-11 22:25:45','117.196.90.212','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('18','2025-07-11 23:04:34','0000-00-00 00:00:00','157.51.14.109','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Mobile Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('19','2025-07-11 23:05:02','0000-00-00 00:00:00','157.51.14.109','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Mobile Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('20','2025-07-12 01:53:18','0000-00-00 00:00:00','157.51.13.101','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Mobile Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('21','2025-07-12 04:24:37','0000-00-00 00:00:00','157.51.7.15','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('22','2025-07-12 10:27:01','0000-00-00 00:00:00','117.196.90.212','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('23','2025-07-12 11:33:04','0000-00-00 00:00:00','117.196.90.212','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('24','2025-07-12 18:41:11','0000-00-00 00:00:00','117.221.0.26','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('25','2025-07-13 22:14:44','0000-00-00 00:00:00','157.51.24.134','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Mobile Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('26','2025-07-14 10:06:16','2025-07-14 10:10:37','59.98.54.131','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('27','2025-07-14 10:10:54','0000-00-00 00:00:00','59.98.54.131','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('28','2025-07-14 10:38:33','2025-07-14 10:40:21','59.98.54.131','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('29','2025-07-14 11:01:38','2025-07-14 12:30:52','59.98.54.131','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('30','2025-07-14 15:28:12','2025-07-14 15:33:45','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('31','2025-07-14 15:33:59','2025-07-14 15:44:32','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('32','2025-07-14 15:44:35','2025-07-14 15:44:54','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('33','2025-07-14 15:45:11','2025-07-14 15:45:29','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('34','2025-07-14 15:45:32','0000-00-00 00:00:00','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('35','2025-07-14 19:14:54','2025-07-14 19:26:05','117.196.93.254','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('36','2025-07-14 20:38:33','0000-00-00 00:00:00','117.196.93.254','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('37','2025-07-14 22:41:08','0000-00-00 00:00:00','157.51.33.225','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('38','2025-07-15 09:23:36','2025-07-15 09:49:39','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('39','2025-07-15 09:50:35','2025-07-15 09:50:48','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('40','2025-07-15 09:50:50','2025-07-15 09:51:06','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('41','2025-07-15 09:51:20','2025-07-15 10:09:21','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('42','2025-07-15 10:09:23','2025-07-15 10:41:21','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('43','2025-07-15 10:41:29','2025-07-15 10:43:31','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('44','2025-07-15 10:43:51','2025-07-15 10:44:36','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('45','2025-07-15 10:44:37','2025-07-15 10:44:50','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('46','2025-07-15 10:45:05','2025-07-15 10:46:49','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('47','2025-07-15 10:46:51','2025-07-15 10:47:15','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('48','2025-07-15 10:47:34','0000-00-00 00:00:00','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('49','2025-07-15 11:49:30','0000-00-00 00:00:00','42.106.177.188','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('50','2025-07-15 14:44:04','0000-00-00 00:00:00','106.197.124.68','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Mobile Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('51','2025-07-15 15:00:23','0000-00-00 00:00:00','106.197.124.68','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Mobile Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('52','2025-07-15 16:14:14','0000-00-00 00:00:00','103.93.105.58','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('53','2025-07-15 16:23:39','0000-00-00 00:00:00','117.196.84.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('54','2025-07-15 18:16:09','0000-00-00 00:00:00','117.196.84.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('55','2025-07-15 19:23:59','0000-00-00 00:00:00','117.196.84.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('56','2025-07-15 19:28:22','0000-00-00 00:00:00','103.104.58.164','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('57','2025-07-15 21:26:33','0000-00-00 00:00:00','106.197.124.65','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Mobile Safari/537.36','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('58','2025-07-16 09:35:50','0000-00-00 00:00:00','103.93.105.58','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('59','2025-07-16 09:36:51','0000-00-00 00:00:00','103.93.105.58','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('60','2025-07-16 09:41:11','0000-00-00 00:00:00','103.93.105.58','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.51.1.lve.el8.x86_64 #1 SMP Tue May 6 15:14:12 UTC 2025 x86_64','Staff','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('61','2025-07-17 07:48:08','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('62','2025-07-17 07:49:25','2025-07-17 07:58:59','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('63','2025-07-17 07:59:21','2025-07-17 13:23:27','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Staff','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('64','2025-07-17 10:50:24','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('65','2025-07-17 13:23:43','2025-07-17 13:40:32','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Staff','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('66','2025-07-17 13:40:39','2025-07-17 14:47:55','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('67','2025-07-17 14:48:30','2025-07-17 15:33:57','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Staff','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('68','2025-07-17 14:54:56','2025-07-17 14:55:31','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Staff','56564e46556c38784d5441334d6a41794e5441354e54517a4d5638774e773d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('69','2025-07-17 14:55:38','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Staff','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('70','2025-07-17 15:34:44','2025-07-17 17:13:57','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Staff','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('71','2025-07-17 17:14:00','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('72','2025-07-17 17:28:33','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('73','2025-07-18 09:57:09','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('74','2025-07-18 15:48:40','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('75','2025-07-19 15:14:37','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('76','2025-07-22 11:01:59','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('77','2025-07-22 14:46:17','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('78','2025-07-22 14:53:38','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('79','2025-07-22 17:37:41','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('80','2025-07-22 18:16:49','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('81','2025-07-22 18:16:49','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('82','2025-07-23 09:37:48','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('83','2025-07-23 10:49:20','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('84','2025-07-23 16:46:25','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('85','2025-07-31 12:40:38','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('86','2025-08-01 09:27:26','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('87','2025-08-01 11:00:22','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('88','2025-08-01 11:18:22','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('89','2025-08-01 11:23:24','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('90','2025-08-01 13:29:20','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('91','2025-08-01 13:34:40','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('92','2025-08-01 14:58:56','2025-08-01 14:59:08','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('93','2025-08-01 14:59:11','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('94','2025-08-01 14:59:31','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('95','2025-08-01 15:05:57','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('96','2025-08-02 07:46:10','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('97','2025-08-02 08:00:30','2025-08-02 10:09:48','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('98','2025-08-02 10:09:52','0000-00-00 00:00:00','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('99','2025-08-02 11:16:41','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');

INSERT INTO test_mohan_login (id, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('100','2025-08-02 11:24:36','0000-00-00 00:00:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64','Super Admin','56564e46556c38774d513d3d','0');


CREATE TABLE `test_mohan_lr` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `lr_id` mediumtext NOT NULL,
  `lr_number` mediumtext NOT NULL,
  `lr_date` mediumtext NOT NULL,
  `reference_number` mediumtext NOT NULL,
  `organization_id` mediumtext NOT NULL,
  `consignor_id` mediumtext NOT NULL,
  `consignee_id` mediumtext NOT NULL,
  `consignor_name` mediumtext NOT NULL,
  `consignee_name` mediumtext NOT NULL,
  `bill_type` mediumtext NOT NULL,
  `vehicle_id` mediumtext NOT NULL,
  `bill_value` mediumtext NOT NULL,
  `bill_number` mediumtext NOT NULL,
  `bill_date` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `weight` mediumtext NOT NULL,
  `price_per_qty` mediumtext NOT NULL,
  `freight` mediumtext NOT NULL,
  `kooli_per_unit` mediumtext NOT NULL,
  `kooli_per_qty` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `delivery_charges` mediumtext NOT NULL,
  `delivery_charges_value` mediumtext NOT NULL,
  `unloading_charges` mediumtext NOT NULL,
  `unloading_charges_value` mediumtext NOT NULL,
  `loading_charges` mediumtext NOT NULL,
  `loading_charges_value` mediumtext NOT NULL,
  `gst_value` mediumtext NOT NULL,
  `from_branch_id` mediumtext NOT NULL,
  `from_branch_name` mediumtext NOT NULL,
  `to_branch_id` mediumtext NOT NULL,
  `to_branch_name` mediumtext NOT NULL,
  `organization_state` mediumtext NOT NULL,
  `consignee_state` mediumtext NOT NULL,
  `consignor_state` mediumtext NOT NULL,
  `from_branch_state` mediumtext NOT NULL,
  `organization_details` mediumtext NOT NULL,
  `consignee_details` mediumtext NOT NULL,
  `consignor_details` mediumtext NOT NULL,
  `vehicle_details` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `round_off` mediumtext NOT NULL,
  `total` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  `cancelled` mediumtext NOT NULL,
  `gst_option` mediumint(9) NOT NULL,
  `tax_value` mediumtext NOT NULL,
  `tax_option` mediumtext NOT NULL,
  `cgst` mediumtext NOT NULL,
  `sgst` mediumtext NOT NULL,
  `igst` mediumtext NOT NULL,
  `total_tax` mediumtext NOT NULL,
  `invoice_status` mediumtext NOT NULL,
  `invoice_number` mediumtext NOT NULL,
  `invoice_date` mediumtext NOT NULL,
  `is_cleared` mediumtext NOT NULL,
  `is_luggage_entry` mediumtext NOT NULL,
  `is_tripsheet_entry` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `consignee_city` mediumtext NOT NULL,
  `received_person` mediumtext NOT NULL,
  `received_mobile_number` mediumtext NOT NULL,
  `received_identification` mediumtext NOT NULL,
  `print_type` mediumtext NOT NULL,
  `account_party_id` mediumtext NOT NULL,
  `account_party_name` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `tripsheet_number` mediumtext NOT NULL,
  `luggagesheet_number` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `account_party_details` mediumtext NOT NULL,
  `total_qty` mediumtext NOT NULL,
  `others_consignee_city` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('1','2025-07-17 13:31:06','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','56476870636e56745a573570','62484a664d5463774e7a49774d6a55774d544d784d445a664d44453d','1/CMB-P','2025-04-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','545339544c694242545531425469424451564a4555773d3d','5530464f52306c4d53513d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e513d3d','0','10','020','200.00','5','50.00','250','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','5132397062574a68644739795a534243636d46755932673d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','5530464f52306c4d5353516b4a44637a4e7a4d344e5459334e7a636b4a43524f5655784d4a43516b546c564d5443516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','545339544c694242545531425469424451564a455579516b4a446b304e4449774e546b794d446b6b4a4352555479425151566b6b4a43525453565a42533046545353516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','NULL','52334a6862513d3d','0','250','0','0','0','5','NULL','0','0','0','NULL','C','NULL','0000-00-00','1','0','1','NULL','55326c325957746863326b3d','545339544c69425453456c4f525342515430785a54555653','','','NULL','NULL','NULL','NULL','1/CMB-TS','NULL','NULL','NULL','10','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('2','2025-07-17 14:51:51','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','56476870636e56745a573570','62484a664d5463774e7a49774d6a55774d6a55784e544a664d44493d','2/CMB-P','2025-04-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','545339544c694242545531425469424451564a4555773d3d','5530464f52306c4d53513d3d','Paid','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','3','0','31','93.00','3','9.00','102','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','5132397062574a68644739795a534243636d46755932673d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','5530464f52306c4d5353516b4a44637a4e7a4d344e5459334e7a636b4a43524f5655784d4a43516b546c564d5443516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','545339544c694242545531425469424451564a455579516b4a446b304e4449774e546b794d446b6b4a4352555479425151566b6b4a43525453565a42533046545353516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','NULL','55476c6c5932567a','0','102','0','0','0','5','NULL','0','0','0','NULL','C','NULL','0000-00-00','1','0','1','NULL','55326c325957746863326b3d','545339544c69424252314d3d','4e7a4d334d7a67314e6a63334e773d3d','','NULL','NULL','NULL','NULL','1/CMB-TS','NULL','NULL','NULL','3','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('3','2025-07-17 15:38:47','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d5463774e7a49774d6a55774d7a4d344e4464664d444d3d','1/VN-P','2025-04-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4467784d7a4578587a5535','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','545339544c69425453456c4f525342515430785a54555653','5530464f52306c4d53513d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','3','0','03','9.00','41','123.00','132','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','5530464f52306c4d5353516b4a44637a4e7a4d344e5459334e7a636b4a43524f5655784d4a43516b546c564d5443516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','545339544c69425453456c4f525342515430785a545556534a43516b4f5459314e5455334e444d324f53516b4a465250494642425753516b4a464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a43525761584a315a476831626d466e5958496b4a435255595731706243424f595752314a43516b546c564d54413d3d','NULL','55476c6c5932567a','0','132','0','0','0','5','NULL','0','0','0','NULL','C','NULL','0000-00-00','1','0','1','NULL','55326c325957746863326b3d','545339544c69425453456c4f525342515430785a54555653','','','NULL','NULL','NULL','NULL','1/VN-TS','NULL','NULL','NULL','3','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('4','2025-07-22 11:02:54','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d6a49774e7a49774d6a55784d5441794e5456664d44513d','3/CMB-P','2025-04-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4467784d7a4578587a5535','5130394f55306c48546b5646587a45304d4463794d4449314d444d7a4e544930587a417a','545339544c69425453456c4f525342515430785a54555653','564746746157773d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e513d3d','3','0','02','6.00','3','9.00','15','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','5132397062574a68644739795a534243636d46755932673d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','564746746157776b4a4351324e7a63324e7a59324e7a63324a43516b546c564d5443516b4a4535565445776b4a43524f5655784d4a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','545339544c69425453456c4f525342515430785a545556534a43516b4f5459314e5455334e444d324f53516b4a465250494642425753516b4a464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a43525761584a315a476831626d466e5958496b4a435255595731706243424f595752314a43516b546c564d54413d3d','NULL','52334a6862513d3d','0','15','0','1','0','5','NULL','0','0','0','NULL','O','NULL','0000-00-00','0','0','0','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','3','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('5','2025-07-22 15:07:16','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d6a49774e7a49774d6a55774d7a41334d545a664d44553d','2/VN-P','2025-07-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','545339544c694242545531425469424451564a4555773d3d','5530464f52306c4d53513d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','10','0','65','650.00','2','20.00','670','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d6a5534587a4179','56476870636e56776458493d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','5530464f52306c4d5353516b4a44637a4e7a4d344e5459334e7a636b4a43524f5655784d4a43516b546c564d5443516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','545339544c694242545531425469424451564a455579516b4a446b304e4449774e546b794d446b6b4a4352555479425151566b6b4a43525453565a42533046545353516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','NULL','55476c6c5932567a','0','670','0','1','0','5','NULL','0','0','0','NULL','O','NULL','0000-00-00','0','0','0','NULL','55326c325957746863326b3d','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','10','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('6','2025-07-22 15:15:50','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d6a49774e7a49774d6a55774d7a45314e5446664d44593d','4/CMB-P','2025-04-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4467784d7a4578587a5535','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','545339544c69425453456c4f525342515430785a54555653','5530464f52306c4d53513d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e513d3d','2','0','02','4.00','21','42.00','46','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','5132397062574a68644739795a534243636d46755932673d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','5530464f52306c4d5353516b4a44637a4e7a4d344e5459334e7a636b4a43524f5655784d4a43516b546c564d5443516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','545339544c69425453456c4f525342515430785a545556534a43516b4f5459314e5455334e444d324f53516b4a465250494642425753516b4a464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a43525761584a315a476831626d466e5958496b4a435255595731706243424f595752314a43516b546c564d54413d3d','NULL','52334a6862513d3d','0','46','0','1','0','5','NULL','0','0','0','NULL','O','NULL','0000-00-00','0','0','0','NULL','55326c325957746863326b3d','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','2','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('7','2025-07-22 15:22:43','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d6a49774e7a49774d6a55774d7a49794e444e664d44633d','3/VN-P','2025-04-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','545339544c694242545531425469424451564a4555773d3d','5530464f52306c4d53513d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','2','0','03','6.00','21','42.00','48','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','5530464f52306c4d5353516b4a44637a4e7a4d344e5459334e7a636b4a43524f5655784d4a43516b546c564d5443516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','545339544c694242545531425469424451564a455579516b4a446b304e4449774e546b794d446b6b4a4352555479425151566b6b4a43525453565a42533046545353516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','NULL','55476c6c5932567a','0','48','0','1','0','5','NULL','0','0','0','NULL','O','NULL','0000-00-00','0','0','0','NULL','55326c325957746863326b3d','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','2','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('8','2025-07-22 15:31:11','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d6a49774e7a49774d6a55774d7a4d784d5446664d44673d','4/VN-P','2025-04-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','545339544c694242545531425469424451564a4555773d3d','5530464f52306c4d53513d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e513d3d,5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774d773d3d','3,32','0,0','23,31','69.00,992.00','2,3','6.00,96.00','75,1088','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d6a5534587a4179','56476870636e56776458493d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','5530464f52306c4d5353516b4a44637a4e7a4d344e5459334e7a636b4a43524f5655784d4a43516b546c564d5443516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','545339544c694242545531425469424451564a455579516b4a446b304e4449774e546b794d446b6b4a4352555479425151566b6b4a43525453565a42533046545353516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','NULL','52334a6862513d3d,62476c30636d553d','0','1163','0','1','0','5','NULL','0','0','0','NULL','O','NULL','0000-00-00','0','0','0','NULL','55326c325957746863326b3d','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','35','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('9','2025-07-22 15:33:21','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d6a49774e7a49774d6a55774d7a4d7a4d6a46664d446b3d','5/VN-P','2025-04-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4467784d7a4578587a5535','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','545339544c69425453456c4f525342515430785a54555653','5530464f52306c4d53513d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','3','0','3','9.00','3','9.00','18','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d6a5534587a4179','56476870636e56776458493d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','5530464f52306c4d5353516b4a44637a4e7a4d344e5459334e7a636b4a43524f5655784d4a43516b546c564d5443516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','545339544c69425453456c4f525342515430785a545556534a43516b4f5459314e5455334e444d324f53516b4a465250494642425753516b4a464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a43525761584a315a476831626d466e5958496b4a435255595731706243424f595752314a43516b546c564d54413d3d','NULL','55476c6c5932567a','0','18','0','0','0','5','NULL','0','0','0','NULL','O','NULL','0000-00-00','0','0','0','NULL','55326c325957746863326b3d','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','3','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('10','2025-07-23 09:54:27','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d6a4d774e7a49774d6a55774f5455304d6a68664d54413d','6/VN-P','2025-07-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a45304d4463794d4449314d5441304e544d7a587a4130','545339544c694242545531425469424451564a4555773d3d','533246796447687061773d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','2','0','3','6.00','21','42.00','48','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','5132397062574a68644739795a534243636d46755932673d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','53324679644768706179516b4a446b324e5455314d7a49774e44676b4a43524f5655784d4a43516b546c564d5443516b4a465270636e56776458496b4a43525561584a31634842316369516b4a46526862576c73494535685a48556b4a43524f5655784d','545339544c694242545531425469424451564a455579516b4a446b304e4449774e546b794d446b6b4a4352555479425151566b6b4a43525453565a42533046545353516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','NULL','55476c6c5932567a','0','48','0','0','0','5','NULL','0','0','0','NULL','C','NULL','0000-00-00','0','0','1','NULL','56476c796458423163673d3d','NULL','NULL','NULL','NULL','NULL','NULL','NULL','2/VN-TS','NULL','NULL','NULL','2','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('11','2025-07-23 09:55:00','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d6a4d774e7a49774d6a55774f5455314d4446664d54453d','1/VN-G','2025-07-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','545339544c694242545531425469424451564a4555773d3d','5530464f52306c4d53513d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e413d3d','3','0','32','96.00','3','9.00','105','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','5530464f52306c4d5353516b4a44637a4e7a4d344e5459334e7a636b4a43524f5655784d4a43516b546c564d5443516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','545339544c694242545531425469424451564a455579516b4a446b304e4449774e546b794d446b6b4a4352555479425151566b6b4a43525453565a42533046545353516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','NULL','6132633d','-0.25','110','0','0','1','5','NULL','2.625','2.625','0','5.25','C','NULL','0000-00-00','0','0','1','NULL','55326c325957746863326b3d','NULL','NULL','NULL','NULL','NULL','NULL','NULL','3/VN-TS','NULL','NULL','NULL','3','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('12','2025-07-23 11:23:31','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d6a4d774e7a49774d6a55784d54497a4d7a4a664d54493d','2/VN-G','2025-07-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a45304d4463794d4449314d5441304e544d7a587a4130','5247566c5a57553d','533246796447687061773d3d','Paid','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','60','0','20','1200.00','55','3300.00','4500','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d6a5534587a4179','56476870636e56776458493d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','53324679644768706179516b4a446b324e5455314d7a49774e44676b4a43524f5655784d4a43516b546c564d5443516b4a465270636e56776458496b4a43525561584a31634842316369516b4a46526862576c73494535685a48556b4a43524f5655784d','5247566c5a57556b4a43517a4e44497a4d7a49794d6a4d794a43516b546c564d5443516b4a43516b4a464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a43525761584a315a476831626d466e5958496b4a435255595731706243424f595752314a43516b546c564d54413d3d','NULL','55476c6c5932567a','0','4725','0','0','1','5','NULL','112.5','112.5','0','225.00','O','NULL','0000-00-00','0','0','0','NULL','56476c796458423163673d3d','NULL','NULL','NULL','NULL','51554e445545465356466c664d5445774e7a49774d6a55784d4445334d444e664d44453d','545339544c6c5a4654453156556c564851553467526b6c4f52534242556c5254','NULL','NULL','NULL','NULL','545339544c6c5a4654453156556c564851553467526b6c4f52534242556c52544a43516b5645684a556c56515656496b4a435255595731706243424f595752314a43516b56476c79645842316369516b4a4467304f446b354d6a49304d44416b4a43524f5655784d4a43516b546c564d5443516b4a413d3d','60','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('13','2025-07-23 11:30:30','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d6a4d774e7a49774d6a55784d544d774d7a42664d544d3d','1/SVK-G','2025-07-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314e7a4d77587a5132','5130394f55306c48546b5646587a497a4d4463794d4449314d54457a4d444d77587a4132','545339544c694242553068505379424451564a455579416d4945465356464d3d','52464d3d','Account Party','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','3','0','32','96.00','2','6.00','102','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','5647467461577767546d466b64513d3d','564756735957356e59573568','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','52464d6b4a43517a4e444d304d7a517a4e444d304a43516b546c564d5443516b4a4535565445776b4a43524f5655784d4a43516b546c564d5443516b4a46526c624746755a3246755953516b4a4535565445773d','545339544c694242553068505379424451564a455579416d4945465356464d6b4a4351354e4451794e4445354d544d794a43516b546c564d5443516b4a43516b4a464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a43525761584a315a476831626d466e5958496b4a435255595731706243424f595752314a43516b546c564d54413d3d','NULL','55476c6c5932567a','-0.10','107','0','0','1','5','NULL','0','0','5.10','5.10','C','NULL','0000-00-00','0','0','1','NULL','NULL','NULL','NULL','NULL','NULL','51554e445545465356466c664d5445774e7a49774d6a55784d4445334d444e664d44453d','545339544c6c5a4654453156556c564851553467526b6c4f52534242556c5254','NULL','2/SVK-TS','NULL','NULL','545339544c6c5a4654453156556c564851553467526b6c4f52534242556c52544a43516b5645684a556c56515656496b4a435255595731706243424f595752314a43516b56476c79645842316369516b4a4467304f446b354d6a49304d44416b4a43524f5655784d4a43516b546c564d5443516b4a413d3d','3','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('14','2025-07-31 17:18:09','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d7a45774e7a49774d6a55774e5445344d5442664d54513d','7/VN-P','2025-07-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a4d784d4463794d4449314d4451784e44557a587a5978','5130394f55306c48546b5646587a4d784d4463794d4449314d4451784e6a4133587a4134','5132397563326c6e626d39794946427961586c68','5130397563326c6e626d566c4945786859326831','Paid','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e513d3d','0','2','20','40.00','150','300.00','340','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','5132397062574a68644739795a534243636d46755932673d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','5130397563326c6e626d566c49457868593268314a43516b4d5449784d6a45794d5449784d69516b4a4535565445776b4a43526b59584e6b59584d6b4a435242636e56776348567261323930644746704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a4535565445773d','5132397563326c6e626d39794946427961586c684a43516b4d6a4d794d7a497a4d7a497a4d69516b4a47527a5a47596b4a43526b5a6e4e6d6332516b4a435242626d52706257466b5957306b4a435242636d6c35595778316369516b4a46526862576c73494535685a48556b4a43524f5655784d','NULL','52334a6862513d3d','0','340','0','0','0','5','NULL','0','0','0','NULL','O','NULL','0000-00-00','0','0','0','NULL','51584a3163484231613274766448526861513d3d','NULL','NULL','NULL','NULL','51554e445545465356466c664d7a45774e7a49774d6a55774e4445334d446c664d44493d','51574e6a49464268636e5235494531685a476831','NULL','NULL','NULL','NULL','51574e6a49464268636e5235494531685a4768314a43516b4e6a49784d69516b4a46526862576c73494535685a48556b4a435242636e56776348567261323930644746704a43516b4e5445784d6a45794d5449784d69516b4a4535565445776b4a43526b6332466b','2','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('15','2025-07-31 18:06:02','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d7a45774e7a49774d6a55774e6a41324d444e664d54553d','5/CMB-P','2025-07-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a497a4d4463794d4449314d54457a4d444d77587a4132','5247566c5a57553d','52464d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','4','0','3','12.00','3','12.00','24','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','5132397062574a68644739795a534243636d46755932673d','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','5647467461577767546d466b64513d3d','564756735957356e59573568','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','52464d6b4a43517a4e444d304d7a517a4e444d304a43516b546c564d5443516b4a4535565445776b4a43524f5655784d4a43516b546c564d5443516b4a46526c624746755a3246755953516b4a4535565445773d','5247566c5a57556b4a43517a4e44497a4d7a49794d6a4d794a43516b546c564d5443516b4a43516b4a464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a43525761584a315a476831626d466e5958496b4a435255595731706243424f595752314a43516b546c564d54413d3d','NULL','55476c6c5932567a','0','24','0','0','0','5','NULL','0','0','0','NULL','C','NULL','0000-00-00','0','0','1','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','2/CMB-TS','NULL','NULL','NULL','4','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('16','2025-08-01 15:02:45','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d4445774f4449774d6a55774d7a41794e445a664d54593d','8/VN-P','2025-07-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314e7a4d77587a5132','5130394f55306c48546b5646587a497a4d4463794d4449314d54457a4d444d77587a4132','545339544c694242553068505379424451564a455579416d4945465356464d3d','52464d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','3','0','42','126.00','420','1260.00','1386','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','5647467461577767546d466b64513d3d','564756735957356e59573568','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','52464d6b4a43517a4e444d304d7a517a4e444d304a43516b546c564d5443516b4a4535565445776b4a43524f5655784d4a43516b546c564d5443516b4a46526c624746755a3246755953516b4a4535565445773d','545339544c694242553068505379424451564a455579416d4945465356464d6b4a4351354e4451794e4445354d544d794a43516b546c564d5443516b4a43516b4a464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a43525761584a315a476831626d466e5958496b4a435255595731706243424f595752314a43516b546c564d54413d3d','NULL','55476c6c5932567a','0','1386','0','0','0','5','NULL','0','0','0','NULL','C','NULL','0000-00-00','0','0','1','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','4/VN-TS','NULL','NULL','NULL','3','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('17','2025-08-01 15:03:08','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d4445774f4449774d6a55774d7a417a4d4468664d54633d','1/SVK-P','2025-07-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314e7a4d77587a5132','5130394f55306c48546b5646587a497a4d4463794d4449314d54457a4d444d77587a4132','545339544c694242553068505379424451564a455579416d4945465356464d3d','52464d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','4','0','32','128.00','42','168.00','296','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','5647467461577767546d466b64513d3d','564756735957356e59573568','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','52464d6b4a43517a4e444d304d7a517a4e444d304a43516b546c564d5443516b4a4535565445776b4a43524f5655784d4a43516b546c564d5443516b4a46526c624746755a3246755953516b4a4535565445773d','545339544c694242553068505379424451564a455579416d4945465356464d6b4a4351354e4451794e4445354d544d794a43516b546c564d5443516b4a43516b4a464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a43525761584a315a476831626d466e5958496b4a435255595731706243424f595752314a43516b546c564d54413d3d','NULL','55476c6c5932567a','0','296','0','0','0','5','NULL','0','0','0','NULL','C','NULL','0000-00-00','0','0','1','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','1/SVK-TS','NULL','NULL','NULL','4','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('18','2025-08-01 16:49:24','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d4445774f4449774d6a55774e4451354d6a56664d54673d','9/VN-P','2025-07-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45304d4463794d4449314d4463794d544578587a4d78','5130394f55306c48546b5646587a497a4d4463794d4449314d54457a4d444d77587a4132','545339544c6942585355346756464a425245565355773d3d','52464d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774d773d3d','21','0','21','441.00','2','42.00','483','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','5647467461577767546d466b64513d3d','564756735957356e59573568','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','52464d6b4a43517a4e444d304d7a517a4e444d304a43516b546c564d5443516b4a4535565445776b4a43524f5655784d4a43516b546c564d5443516b4a46526c624746755a3246755953516b4a4535565445773d','545339544c6942585355346756464a42524556535579516b4a446b304e444d304d4467774d54416b4a43524251304e505655355549464242556c525a4a43516b56456c53565642565569516b4a465270636e56776458496b4a43525561584a31634842316369516b4a46526862576c73494535685a48556b4a43524f5655784d','NULL','62476c30636d553d','0','483','0','0','0','5','NULL','0','0','0','NULL','O','NULL','0000-00-00','0','0','0','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','21','NULL');

INSERT INTO test_mohan_lr (id, created_date_time, creator, creator_name, lr_id, lr_number, lr_date, reference_number, organization_id, consignor_id, consignee_id, consignor_name, consignee_name, bill_type, vehicle_id, bill_value, bill_number, bill_date, unit_id, quantity, weight, price_per_qty, freight, kooli_per_unit, kooli_per_qty, amount, delivery_charges, delivery_charges_value, unloading_charges, unloading_charges_value, loading_charges, loading_charges_value, gst_value, from_branch_id, from_branch_name, to_branch_id, to_branch_name, organization_state, consignee_state, consignor_state, from_branch_state, organization_details, consignee_details, consignor_details, vehicle_details, unit_name, round_off, total, deleted, cancelled, gst_option, tax_value, tax_option, cgst, sgst, igst, total_tax, invoice_status, invoice_number, invoice_date, is_cleared, is_luggage_entry, is_tripsheet_entry, city, consignee_city, received_person, received_mobile_number, received_identification, print_type, account_party_id, account_party_name, godown_id, tripsheet_number, luggagesheet_number, godown_name, account_party_details, total_qty, others_consignee_city) VALUES ('19','2025-08-01 16:50:57','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','62484a664d4445774f4449774d6a55774e4455774e5464664d546b3d','2/SVK-P','2025-07-01','NULL','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4467784d7a4578587a5535','5130394f55306c48546b5646587a45304d4463794d4449314d5441304e544d7a587a4130','545339544c69425453456c4f525342515430785a54555653','533246796447687061773d3d','ToPay','NULL','NULL','NULL','0000-00-00','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e513d3d','3','0','21','63.00','3','9.00','72','NULL','NULL','NULL','NULL','NULL','NULL','NULL','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','5647467461577767546d466b64513d3d','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','53324679644768706179516b4a446b324e5455314d7a49774e44676b4a43524f5655784d4a43516b546c564d5443516b4a465270636e56776458496b4a43525561584a31634842316369516b4a46526862576c73494535685a48556b4a43524f5655784d','545339544c69425453456c4f525342515430785a545556534a43516b4f5459314e5455334e444d324f53516b4a465250494642425753516b4a464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a43525761584a315a476831626d466e5958496b4a435255595731706243424f595752314a43516b546c564d54413d3d','NULL','52334a6862513d3d','0','72','0','0','0','5','NULL','0','0','0','NULL','O','NULL','0000-00-00','0','0','0','NULL','56476c796458423163673d3d','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','3','NULL');


CREATE TABLE `test_mohan_organization` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `organization_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `address_line1` mediumtext NOT NULL,
  `address_line2` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `pincode` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `gst_number` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `lr_starting_date` date NOT NULL,
  `send_sms` int(100) NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `payment_tax_type` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_organization (id, created_date_time, creator, creator_name, organization_id, name, address_line1, address_line2, city, district, pincode, state, gst_number, mobile_number, lr_starting_date, send_sms, payment_mode_id, payment_mode_name, bank_id, bank_name, payment_tax_type, amount, total_amount, deleted) VALUES ('1','2024-05-15 15:15:29','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','545539495155346756464a42546c4e5154314a55','55314a4a546b6c5751564e424945314655314d67546b564255673d3d','5543354c4c6b3467556b39425243776755306c575155744255306b3d','55326c325957746863326b3d','566d6c796457526f645735685a324679','4e6a49324d54497a','5647467461577767546d466b64513d3d','4d7a4e47556c4e51557a49354d4442454d567053','4e7a4d334d7a67314e6a63334e773d3d','2025-07-01','2','5547463562575675644639746232526c587a45784d4463794d4449314d5445774f545535587a4179,5547463562575675644639746232526c587a45784d4463794d4449314d5445774f544534587a4178','55306c575155744255306b67516c4a42546b4e4949454e425530673d,5231424257513d3d',',516b464f533138784d5441334d6a41794e5445784d5451774e6c38774d513d3d',',51306c5557534256546b6c50546942435155354c','2,1','101,3000000','3000101','0');


CREATE TABLE `test_mohan_party` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_party (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, lower_case_name, address, city, district, state, pincode, mobile_number, others_city, party_details, opening_balance, opening_balance_type, name_mobile_city, identification, deleted) VALUES ('1','2025-07-11 23:23:34','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','1','5546565351306842553056665545465356466c664d5445774e7a49774d6a55784d54497a4d7a52664d44453d','533046424945465356553542513068425445464e49413d3d','613246684947467964573568593268686247467449413d3d','55306c575155744255306b3d','55326c325957746863326b3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','4e6a49324d546735','4f5459314e544d774f4459304e413d3d','','533046424945465356553542513068425445464e4943516b4a464e4a566b464c51564e4a4a43516b566d6c796457526f645735685a3246794a43516b55326c325957746863326b6b4a435255595731706243424f595752314a43516b4e6a49324d5467354a43516b4f5459314e544d774f4459304e413d3d','11','Debit','533046424945465356553542513068425445464e4943416f4f5459314e544d774f4459304e436b674c53425461585a686132467a61513d3d','55306c575155744255306b3d','0');

INSERT INTO test_mohan_party (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, lower_case_name, address, city, district, state, pincode, mobile_number, others_city, party_details, opening_balance, opening_balance_type, name_mobile_city, identification, deleted) VALUES ('2','2025-07-14 15:53:59','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','1','5546565351306842553056665545465356466c664d5451774e7a49774d6a55774d7a557a4e546c664d44493d','566d6c756233526f49413d3d','646d6c756233526f49413d3d','4d54497a49484e30636d566c64434269655755676347467a637942796232466b','546d563349474e7064486c3565586b3d','566d6c796457526f645735685a324679','5647467461577767546d466b64513d3d','4e6a49324d546735','4f4463344e7a67334f4463344e773d3d','New cityyyy','566d6c756233526f4943516b4a4445794d79427a64484a6c5a585167596e6c6c4948426863334d67636d39685a43516b4a465a70636e566b61485675595764686369516b4a45356c6479426a6158523565586c354a43516b5647467461577767546d466b6453516b4a4459794e6a45344f53516b4a4467334f4463344e7a67334f44633d','2000','Credit','566d6c756233526f4943416f4f4463344e7a67334f4463344e796b674c53424f5a58636759326c3065586c3565513d3d','NULL','0');


CREATE TABLE `test_mohan_payment` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
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
  `branch_id` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `open_balance_type` mediumtext NOT NULL,
  `credit` mediumtext NOT NULL,
  `debit` mediumtext NOT NULL,
  `payment_tax_type` mediumtext NOT NULL,
  `cash_balance` mediumtext NOT NULL,
  `lr_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `test_mohan_payment_mode` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `cash_balance` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_payment_mode (id, created_date_time, creator, creator_name, bill_company_id, payment_mode_id, payment_mode_name, lower_case_name, cash_balance, deleted) VALUES ('1','2025-07-11 23:09:18','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5547463562575675644639746232526c587a45784d4463794d4449314d5445774f544534587a4178','5231424257513d3d','5a33426865513d3d','0','0');

INSERT INTO test_mohan_payment_mode (id, created_date_time, creator, creator_name, bill_company_id, payment_mode_id, payment_mode_name, lower_case_name, cash_balance, deleted) VALUES ('2','2025-07-11 23:09:59','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5547463562575675644639746232526c587a45784d4463794d4449314d5445774f545535587a4179','55306c575155744255306b67516c4a42546b4e4949454e425530673d','63326c325957746863326b67596e4a68626d4e6f49474e686332673d','1','0');

INSERT INTO test_mohan_payment_mode (id, created_date_time, creator, creator_name, bill_company_id, payment_mode_id, payment_mode_name, lower_case_name, cash_balance, deleted) VALUES ('3','2025-07-11 23:10:24','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5547463562575675644639746232526c587a45784d4463794d4449314d5445784d444930587a417a','5130465453413d3d','5932467a61413d3d','0','0');

INSERT INTO test_mohan_payment_mode (id, created_date_time, creator, creator_name, bill_company_id, payment_mode_id, payment_mode_name, lower_case_name, cash_balance, deleted) VALUES ('4','2025-07-15 11:55:09','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5547463562575675644639746232526c587a45314d4463794d4449314d5445314e544135587a4130','55476876626d556763474635','63476876626d556763474635','0','0');

INSERT INTO test_mohan_payment_mode (id, created_date_time, creator, creator_name, bill_company_id, payment_mode_id, payment_mode_name, lower_case_name, cash_balance, deleted) VALUES ('5','2025-07-17 17:13:32','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','56476870636e56745a573570','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5547463562575675644639746232526c587a45334d4463794d4449314d4455784d7a4d79587a4131','5a47526b','5a47526b','0','0');


CREATE TABLE `test_mohan_product` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('1','2025-07-11 23:19:35','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784d5441334d6a41794e5445784d546b7a4e5638774d513d3d','52456c465530564d','5a476c6c63325673','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774d773d3d','62476c30636d553d','93.52','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('2','2025-07-14 10:31:57','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e5445774d7a45314e3138774d673d3d','516b3959','596d3934','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','NULL','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('3','2025-07-14 10:32:21','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e5445774d7a49794d5638774d773d3d','556b394d54413d3d','636d397362413d3d','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','NULL','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('4','2025-07-14 10:33:10','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e5445774d7a4d784d4638774e413d3d','516b4653556b564d','596d4679636d5673','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','NULL','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('5','2025-07-14 10:33:57','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e5445774d7a4d314e3138774e513d3d','52464a5654513d3d','5a484a3162513d3d','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','NULL','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('6','2025-07-14 10:34:40','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e5445774d7a51304d4638774e673d3d','556b564654413d3d','636d566c62413d3d','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','NULL','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('7','2025-07-14 10:35:02','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e5445774d7a55774d6c38774e773d3d','5545784256455567516b3959','6347786864475567596d3934','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','NULL','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('8','2025-07-14 10:35:26','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e5445774d7a55794e6c38774f413d3d','51314a4251307446556c4d67516b3959','59334a685932746c636e4d67596d3934','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','NULL','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('9','2025-07-14 10:35:51','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e5445774d7a55314d5638774f513d3d','5530314254457767516b3959','6332316862477767596d3934','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','NULL','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('10','2025-07-14 10:36:09','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e5445774d7a59774f5638784d413d3d','516b6c4849454a5057413d3d','596d6c6e49474a7665413d3d','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','NULL','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('11','2025-07-14 10:36:39','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e5445774d7a597a4f5638784d513d3d','516c564f52457846','596e56755a47786c','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','NULL','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('12','2025-07-14 10:36:58','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e5445774d7a59314f4638784d673d3d','52466c46','5a486c6c','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','NULL','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('13','2025-07-14 10:37:10','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e5445774d7a63784d4638784d773d3d','5130464f52513d3d','593246755a513d3d','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','NULL','NULL','NULL','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('14','2025-07-14 15:54:52','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','55464a5052465644564638784e4441334d6a41794e54417a4e5451314d6c38784e413d3d','56486c795a513d3d','64486c795a513d3d','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','35000','3892','12%','0');

INSERT INTO test_mohan_product (id, created_date_time, creator, creator_name, bill_company_id, product_id, product_name, lower_case_name, unit_id, unit_name, purchase_price, hsn_code, tax_slab, deleted) VALUES ('15','2025-08-01 13:21:12','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','4d6a59774e5449774d6a55774e444d7a4d546c664d44453d','55464a5052465644564638774d5441344d6a41794e5441784d6a45784d6c38784e513d3d','5a484e685a413d3d','5a484e685a413d3d','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','55476c6c5932567a','2','3121','5%','0');


CREATE TABLE `test_mohan_purchase_entry` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
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
  `payment_updation` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_purchase_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, purchase_entry_id, purchase_entry_date, purchase_bill_date, purchase_entry_number, party_id, party_name_mobile_city, party_details, company_state, party_state, gst_option, tax_type, tax_option, product_id, product_name, quantity, total_qty, rate, final_rate, overall_tax, product_amount, amount, sub_total, discount_name, discount, discount_value, discounted_total, charges_id, charges_value, charges_total, cgst_value, sgst_value, igst_value, total_tax_value, product_tax, charges_tax, round_off, total_amount, unit_id, unit_name, round_off_type, round_off_value, payment_updation, cancelled, deleted) VALUES ('1','2025-08-01 15:49:15','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a464e70646d467259584e704a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a44637a4e7a4d344e5459334e7a636b4a4351324d6a59784d6a4d6b4a43516752314e55535534674f69417a4d305a53553142544d6a6b774d455178576c493d','5546565351306842553056664d4445774f4449774d6a55774d7a51354d5456664d44453d','2025-08-01','2025-08-01','dsa','5546565351306842553056665545465356466c664d5451774e7a49774d6a55774d7a557a4e546c664d44493d','566d6c756233526f4943416f4f4463344e7a67334f4463344e796b674c53424f5a58636759326c3065586c3565513d3d','566d6c756233526f4943516b4a4445794d79427a64484a6c5a585167596e6c6c4948426863334d67636d39685a43516b4a465a70636e566b61485675595764686369516b4a45356c6479426a6158523565586c354a43516b5647467461577767546d466b6453516b4a4459794e6a45344f53516b4a4467334f4463344e7a67334f44633d','Tamil Nadu','Tamil Nadu','','','','55464a5052465644564638784e4441334d6a41794e5445774d7a63784d4638784d773d3d','5130464f52513d3d','3','3','2','2.00','NULL','6','6','6','','','NULL','6','NULL','NULL','NULL','0','0','0','0','','','2','6','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','','','1','0','0');


CREATE TABLE `test_mohan_receipt` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
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
  `branch_id` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_receipt (id, created_date_time, creator, creator_name, receipt_id, bill_company_id, receipt_number, receipt_date, gcno, payment_tax_type, lr_id, lr_number, party_id, name_mobile_city, party_type, party_name, amount, narration, payment_mode_id, payment_mode_name, bank_id, bank_name, total_amount, sales_bill_id, consignor_city, consignor_id, consignor_mobile_number, consignee_city, consignee_id, consignee_mobile_number, content, quantity, rate, freight, cooly, bill_no, bill_date, bill_value, private_mark, pay_option, vehicle_no, cnr_client_name, cne_client_name, tax_percentage, gst_option, consignee_state, consignor_state, consignor_gst_number, consignee_gst_number, description, consignor_identification, consignee_identification, branch_id, deleted) VALUES ('1','2025-07-17 13:31:36','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','56476870636e56745a573570','556b564452556c51564638784e7a41334d6a41794e5441784d7a457a4e3138774d513d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','RCT001/25-26','2025-07-17','','1','62484a664d5463774e7a49774d6a55774d544d784d445a664d44453d','1/CMB-P','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','5530464f52306c4d535341744944637a4e7a4d344e5459334e7a633d','Consignee','5530464f52306c4d53513d3d','100','56326c3061434230595867675a3341674c53426a645749674d544177','5547463562575675644639746232526c587a45784d4463794d4449314d5445774f544534587a4178','5231424257513d3d','516b464f533138784d5441334d6a41794e5445784d5451774e6c38774d513d3d','51306c5557534256546b6c50546942435155354c','100','','','','','','','','','','','','','','0000-00-00','','','','','','','','0','','','','','','','','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','0');

INSERT INTO test_mohan_receipt (id, created_date_time, creator, creator_name, receipt_id, bill_company_id, receipt_number, receipt_date, gcno, payment_tax_type, lr_id, lr_number, party_id, name_mobile_city, party_type, party_name, amount, narration, payment_mode_id, payment_mode_name, bank_id, bank_name, total_amount, sales_bill_id, consignor_city, consignor_id, consignor_mobile_number, consignee_city, consignee_id, consignee_mobile_number, content, quantity, rate, freight, cooly, bill_no, bill_date, bill_value, private_mark, pay_option, vehicle_no, cnr_client_name, cne_client_name, tax_percentage, gst_option, consignee_state, consignor_state, consignor_gst_number, consignee_gst_number, description, consignor_identification, consignee_identification, branch_id, deleted) VALUES ('2','2025-07-17 14:52:52','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','56476870636e56745a573570','556b564452556c51564638784e7a41334d6a41794e5441794e5449314d6c38774d673d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','RCT002/25-26','2025-07-17','','1,2','62484a664d5463774e7a49774d6a55774d6a55784e544a664d44493d','2/CMB-P','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','545339544c694242545531425469424451564a455579417449446b304e4449774e546b794d446b3d','Consignor','545339544c694242545531425469424451564a4555773d3d','52,50','563151674c53426e6343417451315643494330314d694258543151675932467a614341314d413d3d','5547463562575675644639746232526c587a45784d4463794d4449314d5445774f544534587a4178,5547463562575675644639746232526c587a45784d4463794d4449314d5445774f545535587a4179','5231424257513d3d,55306c575155744255306b67516c4a42546b4e4949454e425530673d','516b464f533138784d5441334d6a41794e5445784d5451774e6c38774d513d3d,','51306c5557534256546b6c50546942435155354c,','102','','','','','','','','','','','','','','0000-00-00','','','','','','','','0','','','','','','','','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','0');

INSERT INTO test_mohan_receipt (id, created_date_time, creator, creator_name, receipt_id, bill_company_id, receipt_number, receipt_date, gcno, payment_tax_type, lr_id, lr_number, party_id, name_mobile_city, party_type, party_name, amount, narration, payment_mode_id, payment_mode_name, bank_id, bank_name, total_amount, sales_bill_id, consignor_city, consignor_id, consignor_mobile_number, consignee_city, consignee_id, consignee_mobile_number, content, quantity, rate, freight, cooly, bill_no, bill_date, bill_value, private_mark, pay_option, vehicle_no, cnr_client_name, cne_client_name, tax_percentage, gst_option, consignee_state, consignor_state, consignor_gst_number, consignee_gst_number, description, consignor_identification, consignee_identification, branch_id, deleted) VALUES ('3','2025-07-17 15:41:38','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','556b564452556c51564638784e7a41334d6a41794e54417a4e44457a4f4638774d773d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','RCT003/25-26','2025-07-17','','1','62484a664d5463774e7a49774d6a55774d7a4d344e4464664d444d3d','1/VN-P','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','5530464f52306c4d535341744944637a4e7a4d344e5459334e7a633d','Consignee','5530464f52306c4d53513d3d','50','643351675932467a49445577','5547463562575675644639746232526c587a45784d4463794d4449314d5445774f545535587a4179','55306c575155744255306b67516c4a42546b4e4949454e425530673d','','','50','','','','','','','','','','','','','','0000-00-00','','','','','','','','0','','','','','','','','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','0');

INSERT INTO test_mohan_receipt (id, created_date_time, creator, creator_name, receipt_id, bill_company_id, receipt_number, receipt_date, gcno, payment_tax_type, lr_id, lr_number, party_id, name_mobile_city, party_type, party_name, amount, narration, payment_mode_id, payment_mode_name, bank_id, bank_name, total_amount, sales_bill_id, consignor_city, consignor_id, consignor_mobile_number, consignee_city, consignee_id, consignee_mobile_number, content, quantity, rate, freight, cooly, bill_no, bill_date, bill_value, private_mark, pay_option, vehicle_no, cnr_client_name, cne_client_name, tax_percentage, gst_option, consignee_state, consignor_state, consignor_gst_number, consignee_gst_number, description, consignor_identification, consignee_identification, branch_id, deleted) VALUES ('4','2025-07-17 15:42:21','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','556b564452556c51564638784e7a41334d6a41794e54417a4e4449794d5638774e413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','RCT004/25-26','2025-07-17','','2','62484a664d5463774e7a49774d6a55774d7a4d344e4464664d444d3d','1/VN-P','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','5530464f52306c4d535341744944637a4e7a4d344e5459334e7a633d','Consignee','5530464f52306c4d53513d3d','82','6432393049474e686332673d','5547463562575675644639746232526c587a45784d4463794d4449314d5445774f545535587a4179','55306c575155744255306b67516c4a42546b4e4949454e425530673d','','','82','','','','','','','','','','','','','','0000-00-00','','','','','','','','0','','','','','','','','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','0');


CREATE TABLE `test_mohan_return` (
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
  `payment_tax_type` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `test_mohan_role` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `role_id` mediumtext NOT NULL,
  `role_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `access_pages` mediumtext NOT NULL,
  `access_page_actions` mediumtext NOT NULL,
  `is_branch_staff` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_role (id, created_date_time, creator, creator_name, role_id, role_name, lower_case_name, access_pages, access_page_actions, is_branch_staff, deleted) VALUES ('1','2025-07-11 21:50:08','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','556b394d525638784d5441334d6a41794e5441354e5441774f4638774d513d3d','55315a4c49464e5551555a47','63335a7249484e3059575a6d','516e4a68626d4e6f,566d566f61574e735a513d3d,52484a70646d5679,5657357064413d3d,55474635625756756443424e6232526c,516d467561773d3d,5132397563326c6e626d3979,5132397563326c6e626d566c,51574e6a623356756443425159584a3065513d3d,5446493d,56484a7063484e6f5a575630,56484a7063484e6f5a5756304946427962325a706443424d62334e7a,5357353262326c6a5a53424259327475623364735a57526e5a57316c626e513d,5657356a62475668636d46755932556752573530636e6b3d,556d566a5a576c7764413d3d,556d567762334a3063773d3d','566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d,566d6c6c64773d3d$$$5157526b$$$524756735a58526c,566d6c6c64773d3d','yes','0');

INSERT INTO test_mohan_role (id, created_date_time, creator, creator_name, role_id, role_name, lower_case_name, access_pages, access_page_actions, is_branch_staff, deleted) VALUES ('2','2025-07-14 15:32:43','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','556b394d525638784e4441334d6a41794e54417a4d7a49304d3138774d673d3d','5132397062574a68644739795a5342546447466d5a673d3d','5932397062574a68644739795a53427a6447466d5a673d3d','52484a70646d5679,5657357064413d3d,55474635625756756443424e6232526c,516d467561773d3d,5132397563326c6e626d3979,5132397563326c6e626d566c,51574e6a623356756443425159584a3065513d3d,5446493d,56484a7063484e6f5a575630,56484a7063484e6f5a5756304946427962325a706443424d62334e7a,5357353262326c6a5a53424259327475623364735a57526e5a57316c626e513d,5657356a62475668636d46755932556752573530636e6b3d,556d566a5a576c7764413d3d,556d567762334a3063773d3d','566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b,566d6c6c64773d3d,566d6c6c64773d3d$$$5157526b$$$524756735a58526c,566d6c6c64773d3d','yes','0');


CREATE TABLE `test_mohan_sms_count` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` int(100) NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `type` mediumtext NOT NULL,
  `lr_number` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('1','2025-07-15 09:51:56','2147483647','56476870636e56745a573570','Clearance','4/SVK-P','7687876767');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('2','2025-07-15 09:51:56','2147483647','56476870636e56745a573570','Clearance','4/SVK-P','6776676767');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('3','2025-07-15 09:52:03','2147483647','56476870636e56745a573570','Clearance','3/SVK-P','9843088917');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('4','2025-07-15 09:52:03','2147483647','56476870636e56745a573570','Clearance','3/SVK-P','6776766776');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('5','2025-07-15 09:52:11','2147483647','56476870636e56745a573570','Clearance','2/SVK-P','9443372048');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('6','2025-07-15 09:52:11','2147483647','56476870636e56745a573570','Clearance','2/SVK-P','7373856777');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('7','2025-07-15 22:04:55','2147483647','55334a706332396d64486468636d5636','Clearance','1/SVK-G','0456227820');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('8','2025-07-15 22:04:55','2147483647','55334a706332396d64486468636d5636','Clearance','1/SVK-G','9655532048');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('9','2025-07-22 15:04:50','2147483647','55334a706332396d64486468636d5636','Clearance','1/VN-P','9655574369');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('10','2025-07-22 15:04:50','2147483647','55334a706332396d64486468636d5636','Clearance','1/VN-P','7373856777');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('11','2025-07-22 15:35:17','2147483647','55334a706332396d64486468636d5636','Clearance','2/CMB-P','9442059209');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('12','2025-07-22 15:35:17','2147483647','55334a706332396d64486468636d5636','Clearance','2/CMB-P','7373856777');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('13','2025-07-22 17:58:31','2147483647','55334a706332396d64486468636d5636','Clearance','1/CMB-P','9442059209');

INSERT INTO test_mohan_sms_count (id, created_date_time, creator, creator_name, type, lr_number, mobile_number) VALUES ('14','2025-07-22 17:58:31','2147483647','55334a706332396d64486468636d5636','Clearance','1/CMB-P','7373856777');


CREATE TABLE `test_mohan_staff` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `staff_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `username` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  `access_pages` mediumtext NOT NULL,
  `branch_id` mediumtext NOT NULL,
  `access_page_actions` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `test_mohan_stock` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` int(100) NOT NULL,
  `invoice_number` mediumtext NOT NULL,
  `gcno` mediumtext NOT NULL,
  `receipt_quantity` mediumtext NOT NULL,
  `invoice_quantity` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  `creator_name` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `test_mohan_suspense_party` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_suspense_party (id, created_date_time, creator, creator_name, bill_company_id, suspense_party_id, suspense_party_name, lower_case_name, address, city, district, state, pincode, mobile_number, others_city, suspense_party_details, opening_balance, opening_balance_type, name_mobile_city, identification, deleted) VALUES ('1','2025-07-17 15:53:38','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','553156545545564f553056665545465356466c664d5463774e7a49774d6a55774d7a557a4d7a68664d44453d','5533567a63475675633255676333566b6147453d','6333567a63475675633255676333566b6147453d','4d6938304e6a553249484e71595768755a43427463324a685a413d3d','NULL','NULL','5647467461577767546d466b64513d3d','4d6a4d794d7a4d7a','4f5455354e5451354e546b314f513d3d','','5533567a63475675633255676333566b6147456b4a4351794c7a51324e545967633270686147356b4947317a596d466b4a43516b5647467461577767546d466b6453516b4a44497a4d6a4d7a4d79516b4a446b314f5455304f5455354e546b3d','5000','Credit','5533567a63475675633255676333566b614745674b446b314f5455304f5455354e546b70','NULL','0');


CREATE TABLE `test_mohan_suspense_receipt` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_suspense_receipt (id, created_date_time, creator, creator_name, bill_company_id, suspense_receipt_id, suspense_receipt_number, suspense_receipt_date, bill_type, suspense_party_id, name_mobile_city, suspense_party_type, suspense_party_name, amount, narration, payment_mode_id, payment_mode_name, bank_id, bank_name, total_amount, payment_tax_type, deleted) VALUES ('1','2025-07-17 16:02:45','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','6333567a6347567563325666636d566a5a576c77644638784e7a41334d6a41794e5441304d4449304e5638774d513d3d','SR001/25-26','2025-07-17','','553156545545564f553056665545465356466c664d5463774e7a49774d6a55774d7a557a4d7a68664d44453d','5533567a63475675633255676333566b614745674b446b314f5455304f5455354e546b70','Suspense Party','5533567a63475675633255676333566b6147453d','1000','5a484e68','5547463562575675644639746232526c587a45784d4463794d4449314d5445774f544534587a4178','5231424257513d3d','516b464f533138784d5441334d6a41794e5445784d5451774e6c38774d513d3d','51306c5557534256546b6c50546942435155354c','1000','1','0');


CREATE TABLE `test_mohan_suspense_voucher` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_suspense_voucher (id, created_date_time, creator, creator_name, bill_company_id, suspense_voucher_id, suspense_voucher_number, suspense_voucher_date, bill_type, suspense_party_id, name_mobile_city, suspense_party_type, suspense_party_name, amount, narration, payment_mode_id, payment_mode_name, bank_id, bank_name, total_amount, payment_tax_type, deleted) VALUES ('1','2025-07-17 15:54:04','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','6333567a6347567563325666646d39315932686c636c38784e7a41334d6a41794e54417a4e5451774e4638774d513d3d','SV001/25-26','2025-07-17','','553156545545564f553056665545465356466c664d5463774e7a49774d6a55774d7a557a4d7a68664d44453d','5533567a63475675633255676333566b614745674b446b314f5455304f5455354e546b70','Suspense Party','5533567a63475675633255676333566b6147453d','1000','5a484e68','5547463562575675644639746232526c587a45784d4463794d4449314d5445774f544534587a4178','5231424257513d3d','516b464f533138784d5441334d6a41794e5445784d5451774e6c38774d513d3d','51306c5557534256546b6c50546942435155354c','1000','1','0');


CREATE TABLE `test_mohan_tripsheet` (
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
  `destination_branch_id` mediumtext NOT NULL,
  `destination_branch_name` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_tripsheet (id, created_date_time, creator, creator_name, tripsheet_id, tripsheet_number, organization_id, organization_details, godown_id, tripsheet_date, reference_number, vehicle_id, vehicle_name, vehicle_number, from_branch_id, from_branch_name, to_branch_id, to_branch_name, driver_name, driver_number, helper_name, lr_id, lr_date, lr_number, from_branch_lr_id, to_branch_lr_id, consignor_id, consignee_id, quantity, weight, unit_id, price_per_qty, total_amount, bill_type, luggage_id, is_acknowledged, destination_branch_id, destination_branch_name, cancelled, deleted) VALUES ('1','2025-07-17 15:26:19','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','56476870636e56745a573570','56464a4a55464e4952555655587a45334d4463794d4449314d444d794e6a4535587a4178','1/CMB-TS','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','NULL','2025-04-01','NULL','646d566f61574e735a5638784e5441334d6a41794e5441354e4463314d6c38774e413d3d','523246755a584e6f49465a6c61476c6a6247553d','564534354e554d344d446732','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','5132397062574a68644739795a534243636d46755932673d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','545856796457646862673d3d','4e6a55344f4463354d446b774f413d3d','NULL','62484a664d5463774e7a49774d6a55774d6a55784e544a664d44493d,62484a664d5463774e7a49774d6a55774d544d784d445a664d44453d','2025-04-01$$$2025-04-01','2/CMB-P$$$1/CMB-P','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130$$$516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178$$$516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133$$$5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178$$$5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','3$$$','$$$10','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d$$$5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e513d3d','31$$$020','102$$$250','Paid$$$ToPay','NULL','1','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','0','0');

INSERT INTO test_mohan_tripsheet (id, created_date_time, creator, creator_name, tripsheet_id, tripsheet_number, organization_id, organization_details, godown_id, tripsheet_date, reference_number, vehicle_id, vehicle_name, vehicle_number, from_branch_id, from_branch_name, to_branch_id, to_branch_name, driver_name, driver_number, helper_name, lr_id, lr_date, lr_number, from_branch_lr_id, to_branch_lr_id, consignor_id, consignee_id, quantity, weight, unit_id, price_per_qty, total_amount, bill_type, luggage_id, is_acknowledged, destination_branch_id, destination_branch_name, cancelled, deleted) VALUES ('2','2025-07-17 16:05:24','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','56464a4a55464e4952555655587a45334d4463794d4449314d4451774e544930587a4179','1/VN-TS','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','NULL','2025-04-01','NULL','646d566f61574e735a5638784e5441334d6a41794e5441354e4463314d6c38774e413d3d','523246755a584e6f49465a6c61476c6a6247553d','564534354e554d344d446732','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','545856796457646862673d3d','4e6a55344f4463354d446b774f413d3d','NULL','62484a664d5463774e7a49774d6a55774d7a4d344e4464664d444d3d','2025-04-01','1/VN-P','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4467784d7a4578587a5535','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','3','NULL','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','03','132','ToPay','NULL','1','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','0','0');

INSERT INTO test_mohan_tripsheet (id, created_date_time, creator, creator_name, tripsheet_id, tripsheet_number, organization_id, organization_details, godown_id, tripsheet_date, reference_number, vehicle_id, vehicle_name, vehicle_number, from_branch_id, from_branch_name, to_branch_id, to_branch_name, driver_name, driver_number, helper_name, lr_id, lr_date, lr_number, from_branch_lr_id, to_branch_lr_id, consignor_id, consignee_id, quantity, weight, unit_id, price_per_qty, total_amount, bill_type, luggage_id, is_acknowledged, destination_branch_id, destination_branch_name, cancelled, deleted) VALUES ('3','2025-07-31 18:05:25','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','56464a4a55464e4952555655587a4d784d4463794d4449314d4459774e544931587a417a','2/VN-TS','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','NULL','2025-07-01','NULL','646d566f61574e735a56387a4d5441334d6a41794e5441784d7a597a4f4638774d673d3d','52484e68','4d6a4d784d6a4d3d','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','5132397062574a68644739795a534243636d46755932673d','523246755a584e6f','4e6a63794f446b784f4449334d673d3d','NULL','62484a664d6a4d774e7a49774d6a55774f5455304d6a68664d54413d','2025-07-01','6/VN-P','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a45304d4463794d4449314d5441304e544d7a587a4130','2','NULL','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','3','48','ToPay','NULL','1','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','0','0');

INSERT INTO test_mohan_tripsheet (id, created_date_time, creator, creator_name, tripsheet_id, tripsheet_number, organization_id, organization_details, godown_id, tripsheet_date, reference_number, vehicle_id, vehicle_name, vehicle_number, from_branch_id, from_branch_name, to_branch_id, to_branch_name, driver_name, driver_number, helper_name, lr_id, lr_date, lr_number, from_branch_lr_id, to_branch_lr_id, consignor_id, consignee_id, quantity, weight, unit_id, price_per_qty, total_amount, bill_type, luggage_id, is_acknowledged, destination_branch_id, destination_branch_name, cancelled, deleted) VALUES ('4','2025-07-31 18:06:27','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','56464a4a55464e4952555655587a4d784d4463794d4449314d4459774e6a4933587a4130','2/CMB-TS','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','NULL','2025-07-01','6332527a','646d566f61574e735a56387a4d5441334d6a41794e5441784d7a597a4f4638774d673d3d','52484e68','4d6a4d784d6a4d3d','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','5132397062574a68644739795a534243636d46755932673d','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','523246755a584e6f','4e6a63794f446b784f4449334d673d3d','NULL','62484a664d7a45774e7a49774d6a55774e6a41324d444e664d54553d','2025-07-01','5/CMB-P','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a497a4d4463794d4449314d54457a4d444d77587a4132','4','NULL','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','3','24','ToPay','NULL','1','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','0','0');

INSERT INTO test_mohan_tripsheet (id, created_date_time, creator, creator_name, tripsheet_id, tripsheet_number, organization_id, organization_details, godown_id, tripsheet_date, reference_number, vehicle_id, vehicle_name, vehicle_number, from_branch_id, from_branch_name, to_branch_id, to_branch_name, driver_name, driver_number, helper_name, lr_id, lr_date, lr_number, from_branch_lr_id, to_branch_lr_id, consignor_id, consignee_id, quantity, weight, unit_id, price_per_qty, total_amount, bill_type, luggage_id, is_acknowledged, destination_branch_id, destination_branch_name, cancelled, deleted) VALUES ('5','2025-08-01 15:03:34','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','56464a4a55464e4952555655587a41784d4467794d4449314d444d774d7a4d30587a4131','3/VN-TS','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','NULL','2025-07-01','51513d3d','646d566f61574e735a56387a4d5441334d6a41794e5441784d7a597a4f4638774d673d3d','52484e68','4d6a4d784d6a4d3d','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','523246755a584e6f','4e6a63794f446b784f4449334d673d3d','NULL','62484a664d6a4d774e7a49774d6a55774f5455314d4446664d54453d','2025-07-01','1/VN-G','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314f544178587a5133','5130394f55306c48546b5646587a45784d4463794d4449314d5441774d544930587a4178','3','NULL','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e413d3d','32','110','ToPay','NULL','1','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','0','0');

INSERT INTO test_mohan_tripsheet (id, created_date_time, creator, creator_name, tripsheet_id, tripsheet_number, organization_id, organization_details, godown_id, tripsheet_date, reference_number, vehicle_id, vehicle_name, vehicle_number, from_branch_id, from_branch_name, to_branch_id, to_branch_name, driver_name, driver_number, helper_name, lr_id, lr_date, lr_number, from_branch_lr_id, to_branch_lr_id, consignor_id, consignee_id, quantity, weight, unit_id, price_per_qty, total_amount, bill_type, luggage_id, is_acknowledged, destination_branch_id, destination_branch_name, cancelled, deleted) VALUES ('6','2025-08-01 15:03:49','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','56464a4a55464e4952555655587a41784d4467794d4449314d444d774d7a5135587a4132','1/SVK-TS','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','NULL','2025-07-01','NULL','646d566f61574e735a56387a4d5441334d6a41794e5441784d7a597a4f4638774d673d3d','52484e68','4d6a4d784d6a4d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','545856796457646862673d3d','4e6a55344f4463354d446b774f413d3d','NULL','62484a664d4445774f4449774d6a55774d7a417a4d4468664d54633d','2025-07-01','1/SVK-P','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','5130394f55306c48546b3953587a45314d4463794d4449314d4451314e7a4d77587a5132','5130394f55306c48546b5646587a497a4d4463794d4449314d54457a4d444d77587a4132','4','NULL','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','32','296','ToPay','NULL','1','516c4a42546b4e49587a41354d4463794d4449314d4455304d6a5534587a4179','56476870636e56776458493d','0','0');

INSERT INTO test_mohan_tripsheet (id, created_date_time, creator, creator_name, tripsheet_id, tripsheet_number, organization_id, organization_details, godown_id, tripsheet_date, reference_number, vehicle_id, vehicle_name, vehicle_number, from_branch_id, from_branch_name, to_branch_id, to_branch_name, driver_name, driver_number, helper_name, lr_id, lr_date, lr_number, from_branch_lr_id, to_branch_lr_id, consignor_id, consignee_id, quantity, weight, unit_id, price_per_qty, total_amount, bill_type, luggage_id, is_acknowledged, destination_branch_id, destination_branch_name, cancelled, deleted) VALUES ('7','2025-08-01 16:49:41','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','56464a4a55464e4952555655587a41784d4467794d4449314d4451304f545178587a4133','4/VN-TS','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','NULL','2025-07-01','NULL','646d566f61574e735a56387a4d5441334d6a41794e5441784d7a597a4f4638774d673d3d','52484e68','4d6a4d784d6a4d3d','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','523246755a584e6f','4e6a63794f446b784f4449334d673d3d','NULL','62484a664d4445774f4449774d6a55774d7a41794e445a664d54593d','2025-07-01','8/VN-P','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','5130394f55306c48546b3953587a45314d4463794d4449314d4451314e7a4d77587a5132','5130394f55306c48546b5646587a497a4d4463794d4449314d54457a4d444d77587a4132','3','NULL','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','42','1386','ToPay','NULL','1','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','0','0');

INSERT INTO test_mohan_tripsheet (id, created_date_time, creator, creator_name, tripsheet_id, tripsheet_number, organization_id, organization_details, godown_id, tripsheet_date, reference_number, vehicle_id, vehicle_name, vehicle_number, from_branch_id, from_branch_name, to_branch_id, to_branch_name, driver_name, driver_number, helper_name, lr_id, lr_date, lr_number, from_branch_lr_id, to_branch_lr_id, consignor_id, consignee_id, quantity, weight, unit_id, price_per_qty, total_amount, bill_type, luggage_id, is_acknowledged, destination_branch_id, destination_branch_name, cancelled, deleted) VALUES ('8','2025-08-01 16:51:57','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','56464a4a55464e4952555655587a41784d4467794d4449314d4451314d545533587a4134','2/SVK-TS','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','545539495155346756464a42546c4e5154314a554a43516b55314a4a546b6c5751564e424945314655314d67546b56425569516b4a4641755379354f49464a505155517349464e4a566b464c51564e4a4a43516b55326c325957746863326b6b4a4351324d6a59784d6a4d6b4a435255595731706243424f595752314a43516b4d7a4e47556c4e51557a49354d4442454d5670534a43516b4e7a4d334d7a67314e6a63334e773d3d','NULL','2025-07-01','6332453d','646d566f61574e735a56387a4d5441334d6a41794e5441784d7a597a4f4638774d673d3d','52484e68','4d6a4d784d6a4d3d','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','55326c325957746863326b3d','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','566d357949454a795957356a61413d3d','523246755a584e6f','4e6a63794f446b784f4449334d673d3d','NULL','62484a664d6a4d774e7a49774d6a55784d544d774d7a42664d544d3d','2025-07-01','1/SVK-G','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','5130394f55306c48546b3953587a45314d4463794d4449314d4451314e7a4d77587a5132','5130394f55306c48546b5646587a497a4d4463794d4449314d54457a4d444d77587a4132','3','NULL','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','32','107','Account Party','NULL','1','516c4a42546b4e49587a41354d4463794d4449314d4455304d6a5534587a4179','56476870636e56776458493d','0','0');


CREATE TABLE `test_mohan_tripsheet_profit_loss` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `tripsheet_profit_loss_id` mediumtext NOT NULL,
  `trip_number` mediumtext NOT NULL,
  `vehicle_id` mediumtext NOT NULL,
  `vehicle_number` mediumtext NOT NULL,
  `driver_name` mediumtext NOT NULL,
  `from_tripsheet_date` date NOT NULL,
  `from_tripsheet_id` mediumtext NOT NULL,
  `from_tripsheet_number` mediumtext NOT NULL,
  `from_tripsheet_from_branch` mediumtext NOT NULL,
  `from_tripsheet_to_branch` mediumtext NOT NULL,
  `from_tripsheet_quantity` mediumtext NOT NULL,
  `from_tripsheet_weight` mediumtext NOT NULL,
  `from_tripsheet_rent` mediumtext NOT NULL,
  `to_tripsheet_date` date NOT NULL,
  `to_tripsheet_id` mediumtext NOT NULL,
  `to_tripsheet_number` mediumtext NOT NULL,
  `to_tripsheet_from_branch` mediumtext NOT NULL,
  `to_tripsheet_to_branch` mediumtext NOT NULL,
  `to_tripsheet_quantity` mediumtext NOT NULL,
  `to_tripsheet_weight` mediumtext NOT NULL,
  `to_tripsheet_rent` mediumtext NOT NULL,
  `total_rent` mediumtext NOT NULL,
  `trip_cost` mediumtext NOT NULL,
  `balance` mediumtext NOT NULL,
  `loading_wage` mediumtext NOT NULL,
  `night_food` mediumtext NOT NULL,
  `driver_salary` mediumtext NOT NULL,
  `tire_depreciation` mediumtext NOT NULL,
  `toll_gate` mediumtext NOT NULL,
  `net_balance` mediumtext NOT NULL,
  `starting_km` mediumtext NOT NULL,
  `ending_km` mediumtext NOT NULL,
  `travelled_km` mediumtext NOT NULL,
  `diesel` mediumtext NOT NULL,
  `mileage` mediumtext NOT NULL,
  `trip_balance` mediumtext NOT NULL,
  `advance` mediumtext NOT NULL,
  `diesel_cost` mediumtext NOT NULL,
  `diesel_cost_per_litre` mediumtext NOT NULL,
  `expense_name` mediumtext NOT NULL,
  `expense_value` mediumtext NOT NULL,
  `company_expense_type` mediumtext NOT NULL,
  `driver_expense_type` mediumtext NOT NULL,
  `tripsheet_status` mediumtext NOT NULL,
  `company_expense_name` mediumtext NOT NULL,
  `company_expense_value` mediumtext NOT NULL,
  `company_diesel_amount` mediumtext NOT NULL,
  `driver_diesel_amount` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_tripsheet_profit_loss (id, created_date_time, creator, creator_name, bill_company_id, tripsheet_profit_loss_id, trip_number, vehicle_id, vehicle_number, driver_name, from_tripsheet_date, from_tripsheet_id, from_tripsheet_number, from_tripsheet_from_branch, from_tripsheet_to_branch, from_tripsheet_quantity, from_tripsheet_weight, from_tripsheet_rent, to_tripsheet_date, to_tripsheet_id, to_tripsheet_number, to_tripsheet_from_branch, to_tripsheet_to_branch, to_tripsheet_quantity, to_tripsheet_weight, to_tripsheet_rent, total_rent, trip_cost, balance, loading_wage, night_food, driver_salary, tire_depreciation, toll_gate, net_balance, starting_km, ending_km, travelled_km, diesel, mileage, trip_balance, advance, diesel_cost, diesel_cost_per_litre, expense_name, expense_value, company_expense_type, driver_expense_type, tripsheet_status, company_expense_name, company_expense_value, company_diesel_amount, driver_diesel_amount, deleted) VALUES ('1','2025-08-02 13:06:51','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','56464a4a55464e49525556555831424d587a41794d4467794d4449314d4445774e6a5579587a4178','5a48633d','646d566f61574e735a56387a4d5441334d6a41794e5441784d7a597a4f4638774d673d3d','4d6a4d784d6a4d3d','5a484e6b63773d3d','2025-07-01','56464a4a55464e4952555655587a4d784d4463794d4449314d4459774e544931587a417a','2/VN-TS','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','2','NULL','48','2025-07-01','56464a4a55464e4952555655587a4d784d4463794d4449314d4459774e6a4933587a4130','2/CMB-TS','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','516c4a42546b4e49587a45334d4463794d4449314d5449784f445530587a4131','4','NULL','24','72.00','700.00','0','NULL','NULL','NULL','NULL','NULL','NULL','100','300','200.00','20','10.00','-528.00','NULL','NULL','20','பூஜை,சாப்பாடு படி',',200,','NULL','Paid','NULL','new','515','','500','0');


CREATE TABLE `test_mohan_unit` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('1','2025-07-09 17:48:56','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','546b3954','626d397a','0');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('2','2025-07-10 15:37:43','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774d673d3d','62576c6a636d39754d54493d','62576c6a636d39754d54493d','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('3','2025-07-10 15:37:43','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774d773d3d','62476c30636d553d','62476c30636d553d','0');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('4','2025-07-10 15:37:43','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e413d3d','6132633d','6132633d','0');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('5','2025-07-10 15:37:43','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e513d3d','52334a6862513d3d','5a334a6862513d3d','0');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('6','2025-07-10 15:37:43','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','55476c6c5932567a','63476c6c5932567a','0');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('7','2025-07-11 22:25:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d5441334d6a41794e5445774d6a55774d4638774e773d3d','516b4653556b564d','596d4679636d5673','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('8','2025-07-11 22:25:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d5441334d6a41794e5445774d6a55774d4638774f413d3d','52464a5654513d3d','5a484a3162513d3d','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('9','2025-07-11 22:25:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d5441334d6a41794e5445774d6a55774d4638774f513d3d','5130464f52513d3d','593246755a513d3d','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('10','2025-07-11 22:25:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d5441334d6a41794e5445774d6a55774d4638784d413d3d','52466c46','5a486c6c','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('11','2025-07-11 22:25:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d5441334d6a41794e5445774d6a55774d4638784d513d3d','516c564f52457846','596e56755a47786c','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('12','2025-07-11 22:25:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d5441334d6a41794e5445774d6a55774d4638784d673d3d','516b6c4849454a5057413d3d','596d6c6e49474a7665413d3d','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('13','2025-07-11 22:25:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d5441334d6a41794e5445774d6a55774d4638784d773d3d','5530314254457767516b3959','6332316862477767596d3934','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('14','2025-07-11 22:25:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d5441334d6a41794e5445774d6a55774d4638784e413d3d','51314a4251307446556942435431673d','59334a685932746c636942696233673d','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('15','2025-07-11 22:25:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d5441334d6a41794e5445774d6a55774d4638784e513d3d','5545784256455567516b3959','6347786864475567596d3934','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('16','2025-07-11 22:25:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d5441334d6a41794e5445774d6a55774d4638784e673d3d','556b564654413d3d','636d566c62413d3d','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('17','2025-07-11 22:25:00','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784d5441334d6a41794e5445774d6a55774d4638784e773d3d','556b394d54413d3d','636d397362413d3d','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('18','2025-07-14 10:09:07','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','566b464553565a4654413d3d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a564638784e4441334d6a41794e5445774d446b774e3138784f413d3d','546b3954','626d397a','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('19','2025-07-31 12:43:46','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a5646387a4d5441334d6a41794e5445794e444d304e6c38784f513d3d','5446496755484a765a48566a64413d3d','6248496763484a765a48566a64413d3d','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('20','2025-07-31 12:45:44','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a5646387a4d5441334d6a41794e5445794e4455304e4638794d413d3d','546b563349484279623252315933513d','626d563349484279623252315933513d','1');

INSERT INTO test_mohan_unit (id, created_date_time, creator, creator_name, bill_company_id, unit_id, unit_name, lower_case_name, deleted) VALUES ('21','2025-07-31 12:50:33','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','5655354a5646387a4d5441334d6a41794e5445794e54417a4d3138794d513d3d','5a484e68','5a484e68','1');


CREATE TABLE `test_mohan_unit_price` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `party_type` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `price_value` mediumtext NOT NULL,
  `cooly_value` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_unit_price (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, unit_id, unit_name, price_value, cooly_value, deleted) VALUES ('1','2025-07-11 22:13:05','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','4e545932596a51324e4455314d7a55324e5745304e6a55304e44457a5a444e6b','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','Consignee','5130394f55306c48546b5646587a45784d4463794d4449314d5441784d7a4131587a4179','545339544c6c5a4654453156556c564851553467526b6c4f52534242556c5254','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','516d3934','80','','0');

INSERT INTO test_mohan_unit_price (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, unit_id, unit_name, price_value, cooly_value, deleted) VALUES ('2','2025-07-11 22:17:03','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','4e545932596a51324e4455314d7a55324e5745304e6a55304e44457a5a444e6b','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','Account Party','51554e445545465356466c664d5445774e7a49774d6a55784d4445334d444e664d44453d','545339544c6c5a4654453156556c564851553467526b6c4f52534242556c5254','5655354a564638774f5441334d6a41794e5441314e4467314e6c38774d513d3d','516d3934','80','','0');

INSERT INTO test_mohan_unit_price (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, unit_id, unit_name, price_value, cooly_value, deleted) VALUES ('3','2025-07-31 15:29:13','56564e46556c38774d513d3d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','','Consignor','5130394f55306c48546b3953587a4d784d4463794d4449314d444d784d7a4d30587a5977','5132397563326c6e626d3979494531685a476831','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','55476c6c5932567a','100','45','0');

INSERT INTO test_mohan_unit_price (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, unit_id, unit_name, price_value, cooly_value, deleted) VALUES ('4','2025-07-31 15:30:13','56564e46556c38774d513d3d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','Consignee','5130394f55306c48546b5646587a4d784d4463794d4449314d444d794e6a5177587a4133','546d563349454e76626e4e705a32356c5a513d3d','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','55476c6c5932567a','20','30','0');

INSERT INTO test_mohan_unit_price (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, unit_id, unit_name, price_value, cooly_value, deleted) VALUES ('5','2025-07-31 16:14:53','56564e46556c38774d513d3d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','','Consignor','5130394f55306c48546b3953587a4d784d4463794d4449314d4451784e44557a587a5978','5132397563326c6e626d39794946427961586c68','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e513d3d','52334a6862513d3d','20','150','0');

INSERT INTO test_mohan_unit_price (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, unit_id, unit_name, price_value, cooly_value, deleted) VALUES ('6','2025-07-31 16:16:07','56564e46556c38774d513d3d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','Consignee','5130394f55306c48546b5646587a4d784d4463794d4449314d4451784e6a4133587a4134','5130397563326c6e626d566c4945786859326831','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','55476c6c5932567a','30','500','0');

INSERT INTO test_mohan_unit_price (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, unit_id, unit_name, price_value, cooly_value, deleted) VALUES ('7','2025-07-31 16:17:09','56564e46556c38774d513d3d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','Account Party','51554e445545465356466c664d7a45774e7a49774d6a55774e4445334d446c664d44493d','51574e6a49464268636e5235494531685a476831','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774d773d3d','62476c30636d553d','40','400','1');

INSERT INTO test_mohan_unit_price (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, unit_id, unit_name, price_value, cooly_value, deleted) VALUES ('8','2025-07-31 16:17:56','56564e46556c38774d513d3d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','Account Party','51554e445545465356466c664d7a45774e7a49774d6a55774e4445334d446c664d44493d','51574e6a49464268636e5235494531685a476831','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774d773d3d','62476c30636d553d','40','600','1');

INSERT INTO test_mohan_unit_price (id, created_date_time, creator, creator_name, bill_company_id, party_type, party_id, party_name, unit_id, unit_name, price_value, cooly_value, deleted) VALUES ('11','2025-07-31 16:51:00','56564e46556c38774d513d3d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a593d','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','Account Party','51554e445545465356466c664d7a45774e7a49774d6a55774e4445334d446c664d44493d','51574e6a49464268636e5235494531685a476831','5655354a564638784d4441334d6a41794e54417a4d7a63304d3138774e673d3d','55476c6c5932567a','40','600','0');


CREATE TABLE `test_mohan_user` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `type` mediumtext NOT NULL,
  `username` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `admin` int(100) NOT NULL,
  `role_id` mediumtext NOT NULL,
  `role_name` mediumtext NOT NULL,
  `branch_id` mediumtext NOT NULL,
  `is_branch_staff` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_user (id, created_date_time, creator, creator_name, user_id, name, lower_case_name, mobile_number, type, username, password, admin, role_id, role_name, branch_id, is_branch_staff, deleted, bill_company_id) VALUES ('1','2021-09-15 11:11:11','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','63334a706332396d64486468636d5636','4d544d304f546b344d7a517a4e413d3d','553356775a584967515752746157343d','55334a706332396d64486468636d5636','51575274615734784d6a4e41','1','NULL','NULL','NULL','NULL','0','5130394e5545464f575638774d513d3d');

INSERT INTO test_mohan_user (id, created_date_time, creator, creator_name, user_id, name, lower_case_name, mobile_number, type, username, password, admin, role_id, role_name, branch_id, is_branch_staff, deleted, bill_company_id) VALUES ('6','2025-07-11 21:51:12','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','56564e46556c38784d5441334d6a41794e5441354e5445784d6c38774e673d3d','63335669596e553d','646d466b61585a6c62413d3d','4f44677a4f4441354f4451304f513d3d','Staff','566b464553565a4654413d3d','564734324e32467a4e7a55354e45413d','0','556b394d525638784d5441334d6a41794e5441354e5441774f4638774d513d3d','55315a4c49464e5551555a47','516c4a42546b4e49587a41354d4463794d4449314d4455304d544577587a4178','yes','0','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178');

INSERT INTO test_mohan_user (id, created_date_time, creator, creator_name, user_id, name, lower_case_name, mobile_number, type, username, password, admin, role_id, role_name, branch_id, is_branch_staff, deleted, bill_company_id) VALUES ('7','2025-07-11 21:54:31','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','56564e46556c38784d5441334d6a41794e5441354e54517a4d5638774e773d3d','56464253','644842794947396d5a6d6c6a5a513d3d','4f5459314e54557a4d6a41304f413d3d','Staff','5646425349453947526b6c4452513d3d','564734324e32467a4e7a55354e45413d','0','556b394d525638784d5441334d6a41794e5441354e5441774f4638774d513d3d','55315a4c49464e5551555a47','516c4a42546b4e49587a41354d4463794d4449314d4455304d6a5534587a4179','yes','0','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178');

INSERT INTO test_mohan_user (id, created_date_time, creator, creator_name, user_id, name, lower_case_name, mobile_number, type, username, password, admin, role_id, role_name, branch_id, is_branch_staff, deleted, bill_company_id) VALUES ('8','2025-07-14 15:33:39','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','56564e46556c38784e4441334d6a41794e54417a4d7a4d7a4f5638774f413d3d','56476870636e56745a573570','5932397062574a68644739795a513d3d','4f4463344e7a67334f4463334f413d3d','Staff','5132397062574a68644739795a513d3d','5132397062574a68644739795a5445794d30413d','0','556b394d525638784e4441334d6a41794e54417a4d7a49304d3138774d673d3d','5132397062574a68644739795a5342546447466d5a673d3d','516c4a42546b4e49587a45304d4463794d4449314d444d7a4d545534587a4130','yes','0','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178');


CREATE TABLE `test_mohan_user_staff` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `staff_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `username` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  `access_pages` mediumtext NOT NULL,
  `branch_id` mediumtext NOT NULL,
  `access_page_actions` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `test_mohan_vehicle` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `creator` mediumtext NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `vehicle_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `vehicle_number` mediumtext NOT NULL,
  `vehicle_type` mediumtext NOT NULL,
  `insurance_date` date NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `pollution_date` date NOT NULL,
  `permit_date` date NOT NULL,
  `np_tax_date` date NOT NULL,
  `road_tax_date` date NOT NULL,
  `fitness_date` date NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_vehicle (id, creator, created_date_time, creator_name, bill_company_id, vehicle_id, name, mobile_number, vehicle_number, vehicle_type, insurance_date, lower_case_name, pollution_date, permit_date, np_tax_date, road_tax_date, fitness_date, deleted) VALUES ('1','56564e46556c38774d513d3d','2025-07-31 13:31:45','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','646d566f61574e735a56387a4d5441334d6a41794e5441784d7a45784f4638774d513d3d','546d563349465a6c61476c6a6247553d','4d5449784d6a45794d5449784d673d3d','4e6a59794e6a493d','1','2025-07-31','4e6a59794e6a493d','2025-07-31','2025-07-31','2025-07-31','2025-07-31','2025-07-31','0');

INSERT INTO test_mohan_vehicle (id, creator, created_date_time, creator_name, bill_company_id, vehicle_id, name, mobile_number, vehicle_number, vehicle_type, insurance_date, lower_case_name, pollution_date, permit_date, np_tax_date, road_tax_date, fitness_date, deleted) VALUES ('2','56564e46556c38774d513d3d','2025-07-31 13:36:38','55334a706332396d64486468636d5636','','646d566f61574e735a56387a4d5441334d6a41794e5441784d7a597a4f4638774d673d3d','52484e68','4d6a4d794d7a497a4d6a4d794d773d3d','4d6a4d784d6a4d3d','1','2025-07-31','4d6a4d784d6a4d3d','2025-08-03','2025-08-01','2025-08-04','2025-08-05','2025-08-02','0');


CREATE TABLE `test_mohan_voucher` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
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
  `purchase_entry_id` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO test_mohan_voucher (id, created_date_time, creator, creator_name, bill_company_id, voucher_id, voucher_number, voucher_date, bill_type, party_id, name_mobile_city, party_type, party_name, amount, narration, payment_mode_id, payment_mode_name, bank_id, bank_name, total_amount, payment_tax_type, purchase_entry_id, deleted) VALUES ('1','2025-08-01 15:49:15','56564e46556c38774d513d3d','55334a706332396d64486468636d5636','54314a485155354a576b46555355394f587a45314d4455794d4449304d444d784e544935587a4178','646d39315932686c636c38774d5441344d6a41794e54417a4e446b784e5638774d513d3d','V001/25-26','2025-08-01','','5546565351306842553056665545465356466c664d5451774e7a49774d6a55774d7a557a4e546c664d44493d','566d6c756233526f49434174494467334f4463344e7a67334f44633d','Purchase Party','566d6c756233526f49413d3d','6','NULL','5547463562575675644639746232526c587a45784d4463794d4449314d5445774f544534587a4178','5231424257513d3d','516b464f533138784d5441334d6a41794e5445784d5451774e6c38774d513d3d','51306c5557534256546b6c50546942435155354c','6','1','5546565351306842553056664d4445774f4449774d6a55774d7a51354d5456664d44453d','0');
