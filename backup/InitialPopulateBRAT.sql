SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+08:00";

--
-- Database: `BratPhrase2`
--

CREATE DATABASE IF NOT EXISTS `BratPhrase2`;
USE `BratPhrase2`;

-- --------------------------------------------------------

--
-- Table structure for table `Language`
--

DROP TABLE IF EXISTS `Language`;
CREATE TABLE IF NOT EXISTS `Language` (
  `Language_Code` varchar(2) NOT NULL,
  `Language` varchar(255) NOT NULL,
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Language_Code`)
);


INSERT INTO `Language`(`Language_Code`, `Language`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
('EN', 'English', now(), now(), 'System', 1);


-- --------------------------------------------------------

--
-- Table structure for table `SystemCode`
--

DROP TABLE IF EXISTS `SystemCode`;
CREATE TABLE IF NOT EXISTS `SystemCode` (
  `Language` varchar(2) NOT NULL,
  `System_code` varchar(4) NOT NULL,
  `System_message` varchar(255) NOT NULL,
  `System_description` varchar(255) NOT NULL,
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Language`,`System_code`),
  FOREIGN KEY (`Language`) REFERENCES `Language`(`Language_Code`)
);


-- --------------------------------------------------------

--
-- Table structure for table `Country`
--

DROP TABLE IF EXISTS `Country`;
CREATE TABLE IF NOT EXISTS `Country` (
  `Country_Code` varchar(12),
  `Country_Name` varchar(255),
  `Country_Dial_Code` varchar(3),
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Country_Code`)
);


INSERT INTO `Language`(`Country_Code`, `Country_Name`, `Country_Dial_Code`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
('65', 'Singapore', '65', now(), now(), 'System', 1);


-- --------------------------------------------------------

--
-- Table structure for table `State`
--

DROP TABLE IF EXISTS `State`;
CREATE TABLE IF NOT EXISTS `State` (
  `Country_Code` varchar(12),
  `State_Code` varchar(3),
  `State_Name` varchar(50),
  `Area_Dial_Code` varchar(3),
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `UK_StateCode` (`Country_Code`,`State_Code`),
  FOREIGN KEY (`Country_Code`) REFERENCES `Country`(`Country_Code`)
);


-- --------------------------------------------------------

--
-- Table structure for table `Company`
--

DROP TABLE IF EXISTS `Company`;
CREATE TABLE IF NOT EXISTS `Company` (
  `Company_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Company_Description` varchar(225) NOT NULL,
  `Country_Code` varchar(12) NOT NULL,
  `Company_Billing_Address_Line1` varchar(30) NOT NULL,
  `Company_Billing_Address_Line2` varchar(30),
  `Company_Billing_Address_City` varchar(30) NOT NULL,
  `Company_Billing_Address_State` varchar(12),
  `Company_Billing_Address_Country` varchar(12),
  `Company_Billing_PostalCode` varchar(20) NOT NULL,
  `Company_contact_person` varchar(50) NOT NULL,
  `Company_contact_email` varchar(50) NOT NULL,
  `Company_contact_country_code` varchar(3) NOT NULL,
  `Company_contact_area_code` varchar(3),
  `Company_contact_contactNo` varchar(20) NOT NULL,
  `Company_Registration_number` varchar(50) NOT NULL,
  `Company_Bank_payment_Link_Info` varchar(50),
  `Company_Logo` varchar(255),
  `Company_Language` varchar(2),
  `Relationship_Manager_ID` varchar(50),
  `First_login_flag` tinyint(1) NOT NULL DEFAULT '1',
  `Force_change_password_days` int(11) NOT NULL DEFAULT '0',
  `No_of_retries_allowed` int(11) NOT NULL DEFAULT '0',
  `Check_Last_5_Passwords` tinyint(1) NOT NULL DEFAULT '0',
  `Minimum_length_of_password` int(11) NOT NULL DEFAULT '0',
  `Compulsory_upper_case` tinyint(1) NOT NULL DEFAULT '0',
  `Compulsory_numeric` tinyint(1) NOT NULL DEFAULT '0',
  `Compulsory_special_character` tinyint(1) NOT NULL DEFAULT '0',
  `Automatic_SignOnActivity_Lockout` int(11) NOT NULL DEFAULT '0',
  `Automatic_NoActivity_logout_time` int(11) NOT NULL DEFAULT '0',
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Company_ID`),
  FOREIGN KEY (`Company_Language`) REFERENCES `Language`(`Language_Code`)
);


INSERT INTO `Company`(`Company_Description`, `Country_Code`, `Company_Billing_Address_Line1`, `Company_Billing_Address_City`, `Company_Billing_PostalCode`, `Company_contact_person`, `Company_contact_email`, `Company_contact_country_code`, `Company_contact_contactNo`, `Company_Registration_number`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
('B-Robotics', '65', '40 Jalan Jalan Road #03-01', 'Singapore', '456123', 'Mao Jie', 'maojie@qiq.global', '65', '7894567898', '123456', now(), now(), 'System', 1);

-- --------------------------------------------------------

--
-- Table structure for table `CompanyUserGroup`
--

DROP TABLE IF EXISTS `CompanyUserGroup`;
CREATE TABLE IF NOT EXISTS `CompanyUserGroup` (
  `Company_ID` int(11) NOT NULL,
  `User_Group_ID` varchar(12) NOT NULL,
  `User_Group_Name` varchar(50) NOT NULL,
  `User_Role_Description` varchar(255) NOT NULL,
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`Company_ID`,`User_Group_ID`),
  FOREIGN KEY (`Company_ID`) REFERENCES `Company` (`Company_ID`)
);


INSERT INTO `CompanyUserGroup` (`Company_ID`, `User_Group_ID`, `User_Group_Name`, `User_Role_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(1, '1', 'System', 'The auto generated system user group', now(), now(), 'System', 1),
(1, '2', 'SystemAdmin', 'The admin that controls the user of the system', now(), now(), 'System', 1),
(1, '3', 'ApplicationAdmin', 'The admin that controls the menu of the system', now(), now(), 'System', 1);

-- --------------------------------------------------------


--
-- Table structure for table `CompanyUser`
--

DROP TABLE IF EXISTS `CompanyUser`;
CREATE TABLE IF NOT EXISTS `CompanyUser` (
  `User_ID` varchar(50) NOT NULL,
  `Company_ID` int(11) NOT NULL,
  `User_Group_ID` varchar(12) NOT NULL,
  `User_first_name` varchar(50) NOT NULL,
  `User_middle_name` varchar(50),
  `User_last_name` varchar(50),
  `User_email_address` varchar(255) NOT NULL,
  `User_contact_country_code` varchar(3),
  `User_contact_area_code` varchar(3),
  `User_contact_contactNo` varchar(20),
  `User_Status` varchar(4) NOT NULL,
  `No_Of_Passsword_Retries` int(11) NOT NULL,
  `Last5_Passwords` longtext,
  `Last_Changed_Password_DateTime` datetime,
  `Current_Password` longtext NOT NULL,
  `Last_SignOn_DateTime` datetime,
  `First_Login` tinyint(1) NOT NULL DEFAULT '1',
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `UK_UserAccount` (`Company_ID`,`User_email_address`),
  FOREIGN KEY (`Company_ID`,`User_Group_ID`) REFERENCES `CompanyUserGroup` (`Company_ID`, `User_Group_ID`)
);


INSERT INTO `CompanyUser` (`User_ID`, `Company_ID`, `User_Group_ID`, `User_first_name`, `User_email_address`, `User_Status`, `No_Of_Passsword_Retries`, `Current_Password`, `First_Login`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
('System', 1, '1', 'System', 'system@gmail.com', '1', 0, '3817cfe6eafe7a149b5fe019832bc819', 1, now(), now(), 'System', 1),
('SystemAdmin1', 1, '2', 'System Admin', 'sysadmin1@gmail.com', '1', 0, 'c15a5c301f21c19c4868f604d10ed077', 1, now(), now(), 'System', 1),
('ApplicationAdmin1', 1, '3', 'Application Admin', 'appadmin1@gmail.com','1', 0, 'ca1fbbc12900fd9579805729387c4d7d', 1, now(), now(), 'System', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Menu`
--

DROP TABLE IF EXISTS `Menu`;
CREATE TABLE IF NOT EXISTS `Menu` (
  `Company_ID` int(11) NOT NULL,
  `Menu_ID` varchar(10) NOT NULL,
  `Parent_Menu_ID` varchar(10) NOT NULL,
  `MenuDescription` varchar(255) NOT NULL,
  `Program` varchar(225) NOT NULL,
  `Parameter` varchar(20),
  `Parameter_description` varchar(255),
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `UK_Menu` (`Company_ID`,`Menu_ID`),
  FOREIGN KEY (`Company_ID`) REFERENCES `Company` (`Company_ID`)
);


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(1, '1', '0', 'Management for the Admin to run the system', 'menugenerator.prg', now(), now(), 'System', 1),
(1, '2', '0', 'Management for the Admin to run the menu for the system', 'menugenerator.prg', now(), now(), 'System', 1);

INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(1, '3', '1', 'Management for the Admin to Add Change Delete the Company', 'listgenerator.prg', 'SysCompany', 'Access to Add Change Delete the company table', now(), now(), 'System', 1),
(1, '4', '1', 'Management for the Admin to Add Change Delete the User Group', 'listgenerator.prg', 'SysUserGroup', 'Access to Add Change Delete the user group table for the company', now(), now(), 'System', 1),
(1, '5', '1', 'Management for the Admin to Add Change Delete the User, 'listgenerator.prg', 'SysUser', 'Access to Add Change Delete the user table for the company', now(), now(), 'System', 1),
(1, '6', '1', 'Management for the Admin to Add Change Delete the System Code for BRAT', 'listgenerator.prg', 'SysCode', 'Access to configure the system code for BRAT', now(), now(), 'System', 1),
(1, '7', '1', 'Management for the Admin to Manage the language that BRAT will support', 'listgenerator.prg', 'SysLanguage', 'Access to configure the language for BRAT', now(), now(), 'System', 1),
(1, '8', '1', 'Management for the Admin to manage the country and state that will be served', 'listgenerator.prg', 'SysCountry', 'Access to configure different country and country state for BRAT', now(), now(), 'System', 1),
(1, '9', '2', 'Management for the Application Admin to Add Change and Delete the Menu and the structure', 'listgenerator.prg', 'SysMenu', 'Access to Add Change Delete for the Menu ', now(), now(), 'System', 1),
(1, '10', '2', 'Management for the Application Admin to manage who can access to the menu', 'listgenerator.prg', 'SysMenuAccess', 'Access to Add Change Delete for the Menu Access Rights', now(), now(), 'System', 1),
(1, '11', '2', 'Management for the Application Admin to manage the configuration of the list', 'listgenerator.prg', 'SysListConfig', 'Access to Add Change Delete List configuration for the list generator', now(), now(), 'System', 1),
(1, '12', '2', 'Management for the Application Admin to manage the Logical table and the definition related to Logical table', 'listgenerator.prg', 'SysLogical', 'Access to manage the logical table and its definition', now(), now(), 'System', 1);

-- --------------------------------------------------------

--
-- Table structure for table `MenuLanguage`
--

DROP TABLE IF EXISTS `MenuLanguage`;
CREATE TABLE IF NOT EXISTS `MenuLanguage` (
  `Company_ID` int(11) NOT NULL,
  `Menu_ID` varchar(10) NOT NULL,
  `Language` varchar(2) NOT NULL,
  `Menu_Display` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `UK_MenuLanguage` (`Company_ID`,`Menu_ID`,`Language`),
  FOREIGN KEY (`Company_ID`,`Menu_ID`) REFERENCES `Menu` (`Company_ID`, `Menu_ID`),
  FOREIGN KEY (`Language`) REFERENCES `Language`(`Language_Code`)
);


INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(1, '1', 'EN', 'Admin Management', now(), now(), 'System', 1),
(1, '2', 'EN', 'Menu Management', now(), now(), 'System', 1),
(1, '3', 'EN', 'Company', now(), now(), 'System', 1),
(1, '4', 'EN', 'User Group', now(), now(), 'System', 1),
(1, '5', 'EN', 'User', now(), now(), 'System', 1),
(1, '6', 'EN', 'System Code', now(), now(), 'System', 1),
(1, '7', 'EN', 'Language', now(), now(), 'System', 1),
(1, '8', 'EN', 'Country', now(), now(), 'System', 1),
(1, '9', 'EN', 'Menu', now(), now(), 'System', 1),
(1, '10', 'EN', 'Menu Access', now(), now(), 'System', 1),
(1, '11', 'EN', 'List Configuration', now(), now(), 'System', 1),
(1, '12', 'EN', 'Logical Table Definition', now(), now(), 'System', 1);

-- --------------------------------------------------------

--
-- Table structure for table `MenuAccess`
--

DROP TABLE IF EXISTS `MenuAccess`;
CREATE TABLE IF NOT EXISTS `MenuAccess` (
  `Company_ID` int(11) NOT NULL,
  `User_Group_ID` varchar(12) NOT NULL,
  `Menu_ID` varchar(10) NOT NULL,
  `Access_Rights` enum('R','A','B','C','D','E','F','G') NOT NULL COMMENT '“R” = Read only, not allow to Add/Change/Delete “A” = Can Read / Add / Change / Delete “B” = Can Read / Add “C” = Can Read / Change “D” = Can Read / Delete “E” = Can Read / Add / Change “F” = Can Read / Add / Delete “G” = Can Read / Change / Delete',
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `UK_MenuAccessUserGroup` (`Company_ID`,`User_Group_ID`,`Menu_ID`),
  FOREIGN KEY (`Company_ID`,`User_Group_ID`) REFERENCES `CompanyUserGroup` (`Company_ID`, `User_Group_ID`),
  FOREIGN KEY (`Company_ID`,`Menu_ID`) REFERENCES `Menu` (`Company_ID`, `Menu_ID`)
);



INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(1, '2', '1', 'A', now(), now(), 'System', 1),
(1, '2', '3', 'A', now(), now(), 'System', 1),
(1, '2', '4', 'A', now(), now(), 'System', 1),
(1, '2', '5', 'A', now(), now(), 'System', 1),
(1, '2', '6', 'A', now(), now(), 'System', 1),
(1, '2', '7', 'A', now(), now(), 'System', 1),
(1, '2', '8', 'A', now(), now(), 'System', 1),
(1, '3', '1', 'A', now(), now(), 'System', 1),
(1, '3', '6', 'A', now(), now(), 'System', 1),
(1, '3', '7', 'A', now(), now(), 'System', 1),
(1, '3', '8', 'A', now(), now(), 'System', 1),
(1, '3', '9', 'A', now(), now(), 'System', 1),
(1, '3', '10', 'A', now(), now(), 'System', 1),
(1, '3', '11', 'A', now(), now(), 'System', 1),
(1, '3', '12', 'A', now(), now(), 'System', 1);


-- --------------------------------------------------------

--
-- Table structure for table `ListConfiguration`
--

DROP TABLE IF EXISTS `ListConfiguration`;
CREATE TABLE IF NOT EXISTS `ListConfiguration` (
  `ListConfiguration_ID` int(11) NOT NULL AUTO_INCREMENT,
  `List_Name` varchar(20) NOT NULL,
  `No_Show_Field` int(11) NOT NULL,
  `Shown_Field` varchar(255) NOT NULL,
  `Sort_Field` int(11),
  `SortFilter_Field` varchar(255),
  `Logical_Table_Name` varchar(255) NOT NULL,
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ListConfiguration_ID`)
);


INSERT INTO `ListConfiguration` (`List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
('SysCompany', 21, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21', 'company.php', now(), now(), 'System', 1),
('SysUserGroup', 3, '1,2,3', 'usergroup.php', now(), now(), 'System', 1),
('SysUser', 9, '1,2,3,4,5,6,7,8,9', 'user.php', now(), now(), 'System', 1),
('SysCode', 3, '1,2,3', 'systemcode.php', now(), now(), 'System', 1),
('SysLanguage', 2, '1,2', 'language.php', now(), now(), 'System', 1),
('SysCountry', 4, '1,3,2,4', 'country.php', now(), now(), 'System', 1),
('SysMenu', 7, '1,2,3,4,5,6,7', 'menu.php', now(), now(), 'System', 1),
('SysMenuAccess', 4, '1,2,3,4', 'menu.php', now(), now(), 'System', 1),
('SysListConfig', 7, '1,2,3,4,5,6,7', 'listconfiguration.php', now(), now(), 'System', 1),
('SysLogical', 10, '1,2,3,4,5,6,7,8,9,10', 'logicaltable.php', now(), now(), 'System', 1);


-- --------------------------------------------------------

--
-- Table structure for table `ListConfigurationLanguage`
--

DROP TABLE IF EXISTS `ListConfigurationLanguage`;
CREATE TABLE IF NOT EXISTS `ListConfigurationLanguage` (
  `ListConfiguration_ID` int(11) NOT NULL,
  `Language` varchar(2) NOT NULL,
  `Title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ListConfiguration_ID`,`Language`),
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
('SysCompany', 'EN', 'Company', now(), now(), 'System', 1),
('SysUserGroup', 'EN', 'User Group', now(), now(), 'System', 1),
('SysUser', 'EN', 'User', now(), now(), 'System', 1),
('SysCode', 'EN', 'System Code', now(), now(), 'System', 1),
('SysLanguage', 'EN', 'Language', now(), now(), 'System', 1),
('SysCountry', 'EN', 'Country and State', now(), now(), 'System', 1),
('SysMenu', 'EN', 'Menu', now(), now(), 'System', 1),
('SysMenuAccess', 'EN', 'Menu Access Rights for the user', now(), now(), 'System', 1),
('SysListConfig', 'EN', 'List Configuration', now(), now(), 'System', 1),
('SysLogical', 'EN', 'Logical Table and Definition', now(), now(), 'System', 1);


-- --------------------------------------------------------

--
-- Table structure for table `LogicalTable`
--

DROP TABLE IF EXISTS `LogicalTable`;
CREATE TABLE IF NOT EXISTS `LogicalTable` (
  `Logical_Table_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Logical_Table_Name` varchar(255) NOT NULL,
  `Logical_Table_Description` varchar(255) NOT NULL,
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Logical_Table_ID`),
  UNIQUE KEY (`Logical_Table_Name`)
);


INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
('Company', 'Table show the company', now(), now(), 'System', 1),
('User Group', 'Table show the user group', now(), now(), 'System', 1),
('User', 'Table show the user', now(), now(), 'System', 1),
('System Code', 'Table show the system code', now(), now(), 'System', 1),
('Langauge', 'Table show the list of language', now(), now(), 'System', 1),
('Country', 'Table show the list of country and the state related to the country', now(), now(), 'System', 1),
('Menu', 'Table show the list of menu selections', now(), now(), 'System', 1),
('Menu Access', 'Table show the list of menu access for the user', now(), now(), 'System', 1),
('List Configuration', 'Table show the list configuration', now(), now(), 'System', 1),
('Logical Table', 'Table show the logical table and the definition', now(), now(), 'System', 1);


-- --------------------------------------------------------

--
-- Table structure for table `LogicalDefinitionTable`
--

DROP TABLE IF EXISTS `LogicalDefinitionTable`;
CREATE TABLE IF NOT EXISTS `logical_definition_table` (
  `Logical_Table_ID` int(11) NOT NULL,
  `Field_no` int(11) NOT NULL,
  `Field_Type` varchar(255),
  `Field_Validation` tinyint(1) NOT NULL DEFAULT '0',
  `Validation_type` varchar(255),
  `Validation_parameter` varchar(255),
  `Program_validation` tinyint(1) NOT NULL DEFAULT '1',
  `bind_validation` varchar(255),
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Logical_Table_ID`,`Field_no`),
  FOREIGN KEY (`Logical_Table_ID`) REFERENCES `LogicalTable`(`Logical_Table_ID`)
);



INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(1, 1, now(), now(), 'System', 1),
(1, 2, now(), now(), 'System', 1),
(1, 3, now(), now(), 'System', 1),
(1, 4, now(), now(), 'System', 1),
(1, 5, now(), now(), 'System', 1),
(1, 6, now(), now(), 'System', 1),
(1, 7, now(), now(), 'System', 1),
(1, 8, now(), now(), 'System', 1),
(1, 9, now(), now(), 'System', 1),
(1, 10, now(), now(), 'System', 1),
(1, 11, now(), now(), 'System', 1),
(1, 12, now(), now(), 'System', 1),
(1, 13, now(), now(), 'System', 1),
(1, 14, now(), now(), 'System', 1),
(1, 15, now(), now(), 'System', 1),
(1, 16, now(), now(), 'System', 1),
(1, 17, now(), now(), 'System', 1),
(1, 18, now(), now(), 'System', 1),
(1, 19, now(), now(), 'System', 1),
(1, 20, now(), now(), 'System', 1),
(1, 21, now(), now(), 'System', 1),
(2, 1, now(), now(), 'System', 1),
(2, 2, now(), now(), 'System', 1),
(2, 3, now(), now(), 'System', 1),
(3, 1, now(), now(), 'System', 1),
(3, 2, now(), now(), 'System', 1),
(3, 3, now(), now(), 'System', 1),
(3, 4, now(), now(), 'System', 1),
(3, 5, now(), now(), 'System', 1),
(3, 6, now(), now(), 'System', 1),
(3, 7, now(), now(), 'System', 1),
(3, 8, now(), now(), 'System', 1),
(3, 9, now(), now(), 'System', 1),
(4, 1, now(), now(), 'System', 1),
(4, 2, now(), now(), 'System', 1),
(4, 3, now(), now(), 'System', 1),
(5, 1, now(), now(), 'System', 1),
(5, 2, now(), now(), 'System', 1),
(6, 1, now(), now(), 'System', 1),
(6, 2, now(), now(), 'System', 1),
(6, 3, now(), now(), 'System', 1),
(6, 4, now(), now(), 'System', 1),
(7, 1, now(), now(), 'System', 1),
(7, 2, now(), now(), 'System', 1),
(7, 3, now(), now(), 'System', 1),
(7, 4, now(), now(), 'System', 1),
(7, 5, now(), now(), 'System', 1),
(7, 6, now(), now(), 'System', 1),
(7, 7, now(), now(), 'System', 1),
(8, 1, now(), now(), 'System', 1),
(8, 2, now(), now(), 'System', 1),
(8, 3, now(), now(), 'System', 1),
(8, 4, now(), now(), 'System', 1),
(9, 1, now(), now(), 'System', 1),
(9, 2, now(), now(), 'System', 1),
(9, 3, now(), now(), 'System', 1),
(9, 4, now(), now(), 'System', 1),
(9, 5, now(), now(), 'System', 1),
(9, 6, now(), now(), 'System', 1),
(9, 7, now(), now(), 'System', 1),
(10, 1, now(), now(), 'System', 1),
(10, 2, now(), now(), 'System', 1),
(10, 3, now(), now(), 'System', 1),
(10, 4, now(), now(), 'System', 1),
(10, 5, now(), now(), 'System', 1),
(10, 6, now(), now(), 'System', 1),
(10, 7, now(), now(), 'System', 1),
(10, 8, now(), now(), 'System', 1),
(10, 9, now(), now(), 'System', 1),
(10, 10, now(), now(), 'System', 1);



-- --------------------------------------------------------

--
-- Table structure for table `LogicalDefinitionTableLanguage`
--

DROP TABLE IF EXISTS `LogicalDefinitionTableLanguage`;
CREATE TABLE IF NOT EXISTS `LogicalDefinitionTableLanguage` (
  `Logical_Table_ID` int(11) NOT NULL
  `Field_no` int(11) NOT NULL
  `Language` varchar(2) NOT NULL,
  `Field_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `UK_LogicalDefinitionTableLanguage` (`Logical_Table_ID`,`Field_no`,`Language`),
  FOREIGN KEY (`Logical_Table_ID`,`Field_no`) REFERENCES `LogicalDefinitionTable` (`Logical_Table_ID`,`Field_no`),
  FOREIGN KEY (`Language`) REFERENCES `Language`(`Language_Code`)
);


INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(1, 1, 'EN', 'Company Name', now(), now(), 'System', 1),
(1, 2, 'EN', 'Country for the Company', now(), now(), 'System', 1),
(1, 3, 'EN', 'Address', now(), now(), 'System', 1),
(1, 4, 'EN', 'Contact Person', now(), now(), 'System', 1),
(1, 5, 'EN', 'Contact Email', now(), now(), 'System', 1),
(1, 6, 'EN', 'Contact Contact No', now(), now(), 'System', 1),
(1, 7, 'EN', 'Registration Number', now(), now(), 'System', 1),
(1, 8, 'EN', 'Bank Payment Link Info', now(), now(), 'System', 1),
(1, 9, 'EN', 'Filename Logo', now(), now(), 'System', 1),
(1, 10, 'EN', 'Company Language', now(), now(), 'System', 1),
(1, 11, 'EN', 'Relationship Manager', now(), now(), 'System', 1),
(1, 12, 'EN', 'First Login Flag', now(), now(), 'System', 1),
(1, 13, 'EN', 'Force Change Password (Days)', now(), now(), 'System', 1),
(1, 14, 'EN', 'No Of Retries allowed', now(), now(), 'System', 1),
(1, 15, 'EN', 'Check Last 5 Passwords', now(), now(), 'System', 1),
(1, 16, 'EN', 'Password Minimum Length', now(), now(), 'System', 1),
(1, 17, 'EN', 'Compulsory Upper Case', now(), now(), 'System', 1),
(1, 18, 'EN', 'Compulsory Numeric', now(), now(), 'System', 1),
(1, 19, 'EN', 'Compulsory Special Characters', now(), now(), 'System', 1),
(1, 20, 'EN', 'Automatic Sign On Activity Lockout (Days)', now(), now(), 'System', 1),
(1, 21, 'EN', 'Automatic No Activity Lockout (Seconds)', now(), now(), 'System', 1),
(2, 1, 'EN', 'Company Name', now(), now(), 'System', 1),
(2, 2, 'EN', 'User Role Name', now(), now(), 'System', 1),
(2, 3, 'EN', 'User Role Description', now(), now(), 'System', 1),
(3, 1, 'EN', 'Company Name', now(), now(), 'System', 1),
(3, 2, 'EN', 'User Role Name', now(), now(), 'System', 1),
(3, 3, 'EN', 'Name', now(), now(), 'System', 1),
(3, 4, 'EN', 'Email Address', now(), now(), 'System', 1),
(3, 5, 'EN', 'Contact Number', now(), now(), 'System', 1),
(3, 6, 'EN', 'User Status', now(), now(), 'System', 1),
(3, 7, 'EN', 'Number of Password Retries', now(), now(), 'System', 1),
(3, 8, 'EN', 'Last Sign On Date and Time', now(), now(), 'System', 1),
(3, 9, 'EN', 'Is User sign in for the first time', now(), now(), 'System', 1),
(4, 1, 'EN', 'System Code', now(), now(), 'System', 1),
(4, 2, 'EN', 'System Message', now(), now(), 'System', 1),
(4, 3, 'EN', 'System Description', now(), now(), 'System', 1),
(5, 1, 'EN', 'Language Code', now(), now(), 'System', 1),
(5, 2, 'EN', 'Language', now(), now(), 'System', 1),
(6, 1, 'EN', 'Country', now(), now(), 'System', 1),
(6, 2, 'EN', 'Country Dial Code', now(), now(), 'System', 1),
(6, 3, 'EN', 'State Name', now(), now(), 'System', 1),
(6, 4, 'EN', 'Area Dial Code', now(), now(), 'System', 1),
(7, 1, 'EN', 'Company Name', now(), now(), 'System', 1),
(7, 2, 'EN', 'Menu', now(), now(), 'System', 1),
(7, 3, 'EN', 'Parent Menu', now(), now(), 'System', 1),
(7, 4, 'EN', 'Menu Desctiption', now(), now(), 'System', 1),
(7, 5, 'EN', 'Program', now(), now(), 'System', 1),
(7, 6, 'EN', 'Parameters', now(), now(), 'System', 1),
(7, 7, 'EN', 'Parameters Description', now(), now(), 'System', 1),
(8, 1, 'EN', 'Company', now(), now(), 'System', 1),
(8, 2, 'EN', 'User Role', now(), now(), 'System', 1),
(8, 3, 'EN', 'Menu', now(), now(), 'System', 1),
(8, 4, 'EN', 'Access Rights', now(), now(), 'System', 1),
(9, 1, 'EN', 'List Name', now(), now(), 'System', 1),
(9, 2, 'EN', 'Title', now(), now(), 'System', 1),
(9, 3, 'EN', 'Number of Fields', now(), now(), 'System', 1),
(9, 4, 'EN', 'Shown Fields', now(), now(), 'System', 1),
(9, 5, 'EN', 'Number of Fields support sort filter', now(), now(), 'System', 1),
(9, 6, 'EN', 'Shown Fields support sort and filter', now(), now(), 'System', 1),
(9, 7, 'EN', 'Logical Table Name', now(), now(), 'System', 1),
(10, 1, 'EN', 'Table Name', now(), now(), 'System', 1),
(10, 2, 'EN', 'Table Description', now(), now(), 'System', 1),
(10, 3, 'EN', 'Field Number', now(), now(), 'System', 1),
(10, 4, 'EN', 'Field Name', now(), now(), 'System', 1),
(10, 5, 'EN', 'Field Type', now(), now(), 'System', 1),
(10, 6, 'EN', 'Field Validataoin', now(), now(), 'System', 1),
(10, 7, 'EN', 'Validation Type', now(), now(), 'System', 1),
(10, 8, 'EN', 'Validation Parameter', now(), now(), 'System', 1),
(10, 9, 'EN', 'Program Validation', now(), now(), 'System', 1),
(10, 10, 'EN', 'Bind Validation', now(), now(), 'System', 1);

-- --------------------------------------------------------

