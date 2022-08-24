
TINYINT = 1 byte (8 bit)
SMALLINT = 2 bytes (16 bit)
MEDIUMINT = 3 bytes (24 bit)
INT = 4 bytes (32 bit)
BIGINT = 8 bytes (64 bit).

-- ##############################################################################################################################################################################################
-- ##############################################################################################################################################################################################
-- 테이블

CREATE TABLE `invite_code` (
	`ic_id`	int(11)	NOT NULL PRIMARY key,
	`mb_id`	int(11)	NOT NULL,
	`group_id`	varchar(50)	NOT NULL,
	`status`	varchar(50)	NOT NULL,
	`ic_number`	varchar(50)	NOT NULL,
	`ic_regdate`	datetime	NOT NULL,
);

CREATE TABLE `code_car` (
	`cc_id`	int(11)	NOT NULL PRIMARY key,
	`ic_number`	varchar(50)	NOT NULL,
	`cr_id`	VARCHAR(255)	NOT NULL,
	`group_id`	varchar(50)	NOT NULL,
	`status`	varchar(50)	NOT NULL,
	`member`	int(11)	NOT NULL,
	`cc_regdate`	datetime	NOT NULL,
);

CREATE TABLE `member` (
	`mb_id`	int(11)	NOT NULL PRIMARY key,
	`mb_userid`	varchar(250)	NOT NULL,
	`mb_password`	varchar(250)	NOT NULL,
	`mb_email`	varchar(250)	NOT NULL,
	`mb_phone`	varchar(250)	NOT NULL,
	`mb_nickname`	varchar(250)	NOT NULL,
	`mb_image`	varchar(250)	NOT NULL,
	`mb_is_admin`	tinyint	NOT NULL,
	`mb_register_car`	tinyint	NOT NULL,
	`mb_lastlogin_datetime`	datetime	NOT NULL,
	`mb_regdate`	datetime	NOT NULL
);

CREATE TABLE `car_registeration` (
	`cr_id`	int(11)	NOT NULL PRIMARY key,
	`mb_id`	int(11)	NOT NULL,
	`group_id`	int(11)	NOT NULL,
	`status`	varchar(50)	NOT NULL,
	`cr_number_classification`	varchar(250)	NOT NULL,
	`cr_registeration_number`	varchar(250)	NOT NULL,
	`cr_carname`	varchar(250)	NOT NULL,
	`cr_mac_address`	varchar(50)	NOT NULL,
	`cr_regdate`	datetime	NOT NULL,
)DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `small_group` (
	`sg_id`	int(11)	NOT NULL PRIMARY key,
	`mb_id`	int(11)	NOT NULL,
	`sg_title`	varchar(250)	NOT NULL,
	`sg_description`	varchar(250)	NOT NULL,
	`status`	varchar(50)	NOT NULL,
	`sg_regdate`	datetime	NOT NULL
);

CREATE TABLE `ceo_group` (
	`cg_id`	int(11)	NOT NULL PRIMARY key,
	`mb_id`	int(11)	NOT NULL,
	`cg_career`	varchar(250)	NOT NULL,
	`cg_certificate`	varchar(250)	NOT NULL,
	`cg_company_registernumber`	varchar(250)	NOT NULL,
	`cg_title`	varchar(250)	NOT NULL,
	`cg_description`	varchar(250)	NOT NULL,
	`status`	varchar(50) NOT	NULL,
	`cg_regdate`	datetime	NOT NULL
);

CREATE TABLE `vehicle_status` (
	`vs_id`	int(11)	NOT NULL PRIMARY key,
	`vs_startup_information`	varchar(50)	NOT NULL,
	`cr_id`	int(11)	NOT NULL,
	`member`	int(11)	NOT NULL,
	`vs_authentication_value`	varchar(50) NOT	NULL,
	`vs_latitude`	varchar(50)	NOT NULL,
	`vs_longitude`	varchar(50)	NOT NULL,
	`vs_regdate`	datetime	NOT NULL,

);

CREATE TABLE `rent_group` (
	`rg_id`	int(11)	NOT NULL PRIMARY key,
	`mb_id`	int(11)	NOT NULL,
	`rg_career`	varchar(250)	NOT NULL,
	`rg_certificate`	varchar(250)	NOT NULL,
	`rg_company_registernumber`	varchar(250)	NOT NULL,
	`rg_title`	varchar(250)	NOT NULL,
	`rg_description`	varchar(250)	NOT NULL,
	`status`	varchar(50)	NOT NULL,
	`rg_regdate`	datetime	NOT NULL
);


-- ##############################################################################################################################################################################################
-- ##############################################################################################################################################################################################
-- 더미 데이터
INSERT INTO `car_registeration` (`cr_id`, `mb_id`, `group_id`, `status`, `cr_number_classification`, `cr_registeration_number`, `cr_carname`, `cr_mac_address`, `cr_regdate`) VALUES ('3', '2', '2', 'ceo_group', '가(04185)', '04185', '아반때', '00112233445566', '2022-08-05 15:19:48.000000');
INSERT INTO `car_registeration` (`cr_id`, `mb_id`, `group_id`, `status`, `cr_number_classification`, `cr_registeration_number`, `cr_carname`, `cr_mac_address`, `cr_regdate`) VALUES ('4', '2', '2', 'ceo_group', '가(04185)', '04185', '아반때', '00112233445566', '2022-08-05 15:19:48.000000');
INSERT INTO `car_registeration` (`cr_id`, `mb_id`, `group_id`, `status`, `cr_number_classification`, `cr_registeration_number`, `cr_carname`, `cr_mac_address`, `cr_regdate`) VALUES ('5', '2', '2', 'ceo_group', '가(04185)', '04185', '아반때', '00112233445566', '2022-08-05 15:19:48.000000');
INSERT INTO `car_registeration` (`cr_id`, `mb_id`, `group_id`, `status`, `cr_number_classification`, `cr_registeration_number`, `cr_carname`, `cr_mac_address`, `cr_regdate`) VALUES ('6', '2', '2', 'ceo_group', '가(04185)', '04185', '아반때', '00112233445566', '2022-08-05 15:19:48.000000');
INSERT INTO `car_registeration` (`cr_id`, `mb_id`, `group_id`, `status`, `cr_number_classification`, `cr_registeration_number`, `cr_carname`, `cr_mac_address`, `cr_regdate`) VALUES ('7', '2', '2', 'ceo_group', '가(04185)', '04185', '아반때', '00112233445566', '2022-08-05 15:19:48.000000');



INSERT INTO `ceo_group` (`cg_id`, `mb_id`, `cg_career`, `cg_certificate`, `cg_company_registernumber`, `cg_title`, `cg_description`, `status`, `cg_regdate`) VALUES ('2', '1', '10', 'test', '사업자등록번호: 111-11-11111', 'helowo towjros', 'helowo towjros', 'ceo_group', '2022-08-07 03:56:40.000000');
INSERT INTO `ceo_group` (`cg_id`, `mb_id`, `cg_career`, `cg_certificate`, `cg_company_registernumber`, `cg_title`, `cg_description`, `status`, `cg_regdate`) VALUES ('3', '2', '1', 'test', '사업자등록번호: 111-11-11111', 'helowo towjros', 'helowo towjros', 'ceo_group', '2022-08-07 03:56:40.000000');
INSERT INTO `ceo_group` (`cg_id`, `mb_id`, `cg_career`, `cg_certificate`, `cg_company_registernumber`, `cg_title`, `cg_description`, `status`, `cg_regdate`) VALUES ('4', '3', '2', 'test', '사업자등록번호: 111-11-11111', 'helowo towjros', 'helowo towjros', 'ceo_group', '2022-08-07 03:56:40.000000');
INSERT INTO `ceo_group` (`cg_id`, `mb_id`, `cg_career`, `cg_certificate`, `cg_company_registernumber`, `cg_title`, `cg_description`, `status`, `cg_regdate`) VALUES ('5', '2', '5', 'test', '사업자등록번호: 111-11-11111', 'helowo towjros', 'helowo towjros', 'ceo_group', '2022-08-07 03:56:40.000000');
INSERT INTO `ceo_group` (`cg_id`, `mb_id`, `cg_career`, `cg_certificate`, `cg_company_registernumber`, `cg_title`, `cg_description`, `status`, `cg_regdate`) VALUES ('6', '1', '3', 'test', '사업자등록번호: 111-11-11111', 'helowo towjros', 'helowo towjros', 'ceo_group', '2022-08-07 03:56:40.000000');



INSERT INTO `rent_group` (`rg_id`, `mb_id`, `rg_career`, `rg_certificate`, `rg_company_registernumber`, `rg_title`, `rg_description`, `status`, `rg_regdate`) VALUES ('2', '2', '12', 'testtest', '1111-11-11111', 'testtest', 'testtesttesttesttesttest', 'rent_group', '2022-08-07 05:59:10.000000');
INSERT INTO `rent_group` (`rg_id`, `mb_id`, `rg_career`, `rg_certificate`, `rg_company_registernumber`, `rg_title`, `rg_description`, `status`, `rg_regdate`) VALUES ('3', '3', '12', 'testtest', '1111-11-11111', 'testtest', 'testtesttesttesttesttest', 'rent_group', '2022-08-07 05:59:10.000000');
INSERT INTO `rent_group` (`rg_id`, `mb_id`, `rg_career`, `rg_certificate`, `rg_company_registernumber`, `rg_title`, `rg_description`, `status`, `rg_regdate`) VALUES ('4', '4', '12', 'testtest', '1111-11-11111', 'testtest', 'testtesttesttesttesttest', 'rent_group', '2022-08-07 05:59:10.000000');
INSERT INTO `rent_group` (`rg_id`, `mb_id`, `rg_career`, `rg_certificate`, `rg_company_registernumber`, `rg_title`, `rg_description`, `status`, `rg_regdate`) VALUES ('5', '1', '4', 'testtest', '1111-11-11111', 'testtest', 'testtesttesttesttesttest', 'rent_group', '2022-08-07 05:59:10.000000');
INSERT INTO `rent_group` (`rg_id`, `mb_id`, `rg_career`, `rg_certificate`, `rg_company_registernumber`, `rg_title`, `rg_description`, `status`, `rg_regdate`) VALUES ('6', '3', '5', 'testtest', '1111-11-11111', 'testtest', 'testtesttesttesttesttest', 'rent_group', '2022-08-07 05:59:10.000000');
INSERT INTO `rent_group` (`rg_id`, `mb_id`, `rg_career`, `rg_certificate`, `rg_company_registernumber`, `rg_title`, `rg_description`, `status`, `rg_regdate`) VALUES ('7', '1', '4', 'testtest', '1111-11-11111', 'testtest', 'testtesttesttesttesttest', 'rent_group', '2022-08-07 05:59:10.000000');



INSERT INTO `invite_code` (`ic_id`, `mb_id`, `group_id`, `status`, `ic_number`, `ic_regdate`) VALUES ('2', '2', '2', 'ceo_group', 'ddsfwgwgwgsaws', '2022-08-07 08:20:51.000000');

INSERT INTO `invite_code` (`ic_id`, `mb_id`, `group_id`, `status`, `ic_number`, `ic_regdate`) VALUES ('3', '2', '2', 'ceo_group', 'ewrewrwerwer', '2022-08-07 08:20:51.000000');
INSERT INTO `invite_code` (`ic_id`, `mb_id`, `group_id`, `status`, `ic_number`, `ic_regdate`) VALUES ('4', '2', '2', 'ceo_group', 'dsfsdfdsf', '2022-08-07 08:20:51.000000');
INSERT INTO `invite_code` (`ic_id`, `mb_id`, `group_id`, `status`, `ic_number`, `ic_regdate`) VALUES ('5', '2', '2', 'ceo_group', 'ewrewrwer', '2022-08-07 08:20:51.000000');
INSERT INTO `invite_code` (`ic_id`, `mb_id`, `group_id`, `status`, `ic_number`, `ic_regdate`) VALUES ('6', '2', '2', 'ceo_group', 'dsfsdfsdfsdfsdfs', '2022-08-07 08:20:51.000000');





INSERT INTO `vehicle_status` (`vs_id`, `vs_startup_information`, `cr_id`, `member`, `vs_authentication_value`, `vs_latitude`, `vs_longitude`, `vs_regdate`) VALUES ('7', 'on', '2', '2', 'wfwgwgds', '2.17403', '2.17403', '2022-08-15 14:19:00.000000');

INSERT INTO `vehicle_status` (`vs_id`, `vs_startup_information`, `cr_id`, `member`, `vs_authentication_value`, `vs_latitude`, `vs_longitude`, `vs_regdate`) VALUES ('8', 'on', '2', '2', 'wfwgwgds', '2.17403', '2.17403', '2022-08-15 14:19:05.000000');

INSERT INTO `vehicle_status` (`vs_id`, `vs_startup_information`, `cr_id`, `member`, `vs_authentication_value`, `vs_latitude`, `vs_longitude`, `vs_regdate`) VALUES ('9', 'off', '2', '2', 'wfwgwgds', '2.17403', '2.17403', '2022-08-15 14:19:10.000000');




