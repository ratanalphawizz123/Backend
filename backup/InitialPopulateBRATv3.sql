SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+08:00";

--
-- Database: `BratPhase2`
--

CREATE DATABASE IF NOT EXISTS `BratPhase2`;
USE `BratPhase2`;

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

SET @LanguageCode = 'EN';
SET @Language = 'English';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `Language`(`Language_Code`, `Language`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LanguageCode, @Language, @currenttime, @currenttime, @whodidit, @entrystatus);


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



SET @CountryCode = '65';
SET @CountryName = 'Singapore';
SET @CountryDialCode = '65';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `Country`(`Country_Code`, `Country_Name`, `Country_Dial_Code`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CountryCode, @CountryName, @CountryDialCode, @currenttime, @currenttime, @whodidit, @entrystatus);


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


SET @CompanyID = 1;
SET @CompanyName = 'B-Robotics';
SET @CountryCode = '65';
SET @CompanyAddress = '40 Jalan Jalan Road #03-01';
SET @City = 'Singapore';
SET @PostalCode = '456123';
SET @PersonInCharge = 'Mao Jie';
SET @PersonInChargeEmail = 'maojie@qiq.global';
SET @PersonInChargeCountryCode = '65';
SET @PersonInChargeContactNo = '7894567898';
SET @CompanyRegNo = '123456';
SET @Language = 'EN';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `Company`(`Company_ID`, `Company_Description`, `Country_Code`, `Company_Billing_Address_Line1`, `Company_Billing_Address_City`, `Company_Billing_PostalCode`, `Company_contact_person`, `Company_contact_email`, `Company_contact_country_code`, `Company_contact_contactNo`, `Company_Registration_number`, `Company_Language`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @CompanyName, @CountryCode, @CompanyAddress, @City, @PostalCode, @PersonInCharge, @PersonInChargeEmail, @PersonInChargeCountryCode, @PersonInChargeContactNo, @CompanyRegNo, @Language, @currenttime, @currenttime, @whodidit, @entrystatus);



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


SET @CompanyId = 1;
SET @UserGroupId = '1';
SET @UserGroupName = 'System';
SET @UserGroupDescription = 'The auto generated system user group';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `CompanyUserGroup` (`Company_ID`, `User_Group_ID`, `User_Group_Name`, `User_Role_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyId, @UserGroupId, @UserGroupName, @UserGroupDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyId = 1;
SET @UserGroupId = '2';
SET @UserGroupName = 'SystemAdmin';
SET @UserGroupDescription = 'The admin that controls the user of the system';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `CompanyUserGroup` (`Company_ID`, `User_Group_ID`, `User_Group_Name`, `User_Role_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyId, @UserGroupId, @UserGroupName, @UserGroupDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyId = 1;
SET @UserGroupId = '3';
SET @UserGroupName = 'ApplicationAdmin';
SET @UserGroupDescription = 'The admin that controls the menu of the system';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `CompanyUserGroup` (`Company_ID`, `User_Group_ID`, `User_Group_Name`, `User_Role_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyId, @UserGroupId, @UserGroupName, @UserGroupDescription, @currenttime, @currenttime, @whodidit, @entrystatus);



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


SET @UserId = 'System';
SET @CompanyId = 1;
SET @UserGroupId = '1';
SET @UserName = 'System';
SET @UserEmail = 'system@gmail.com';
SET @UserStatus = '1';
SET @NoOfPasswordRetries = 0;
SET @CurrentPassword = '3817cfe6eafe7a149b5fe019832bc819';
SET @FirstLogin = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `CompanyUser` (`User_ID`, `Company_ID`, `User_Group_ID`, `User_first_name`, `User_email_address`, `User_Status`, `No_Of_Passsword_Retries`, `Current_Password`, `First_Login`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@UserId, @CompanyId, @UserGroupId, @UserName, @UserEmail, @UserStatus, @NoOfPasswordRetries, @CurrentPassword, @FirstLogin, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @UserId = 'SystemAdmin1';
SET @CompanyId = 1;
SET @UserGroupId = '2';
SET @UserName = 'System Admin';
SET @UserEmail = 'sysadmin1@gmail.com';
SET @UserStatus = '1';
SET @NoOfPasswordRetries = 0;
SET @CurrentPassword = 'c15a5c301f21c19c4868f604d10ed077';
SET @FirstLogin = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `CompanyUser` (`User_ID`, `Company_ID`, `User_Group_ID`, `User_first_name`, `User_email_address`, `User_Status`, `No_Of_Passsword_Retries`, `Current_Password`, `First_Login`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@UserId, @CompanyId, @UserGroupId, @UserName, @UserEmail, @UserStatus, @NoOfPasswordRetries, @CurrentPassword, @FirstLogin, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @UserId = 'ApplicationAdmin1';
SET @CompanyId = 1;
SET @UserGroupId = '3';
SET @UserName = 'Application Admin';
SET @UserEmail = 'appadmin1@gmail.com';
SET @UserStatus = '1';
SET @NoOfPasswordRetries = 0;
SET @CurrentPassword = 'ca1fbbc12900fd9579805729387c4d7d';
SET @FirstLogin = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `CompanyUser` (`User_ID`, `Company_ID`, `User_Group_ID`, `User_first_name`, `User_email_address`, `User_Status`, `No_Of_Passsword_Retries`, `Current_Password`, `First_Login`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@UserId, @CompanyId, @UserGroupId, @UserName, @UserEmail, @UserStatus, @NoOfPasswordRetries, @CurrentPassword, @FirstLogin, @currenttime, @currenttime, @whodidit, @entrystatus);



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



SET @CompanyID = 1;
SET @MenuID = '1';
SET @ParentMenuID = '0';
SET @MenuDescription = 'Management for the Admin to run the system';
SET @ProgramName = 'menugenerator.prg';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName,  @currenttime, @currenttime, @whodidit, @entrystatus);



SET @CompanyID = 1;
SET @MenuID = '2';
SET @ParentMenuID = '0';
SET @MenuDescription = 'Management for the Admin to run the menu for the system';
SET @ProgramName = 'menugenerator.prg';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName,  @currenttime, @currenttime, @whodidit, @entrystatus);




SET @CompanyID = 1;
SET @MenuID = '3';
SET @ParentMenuID = '1';
SET @MenuDescription = 'Management for the Admin to Add Change Delete the Company';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysCompany';
SET @ParameterDescription = 'Access to Add Change Delete the company table';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '4';
SET @ParentMenuID = '1';
SET @MenuDescription = 'Management for the Admin to Add Change Delete the User Group';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysUserGroup';
SET @ParameterDescription = 'Access to Add Change Delete the user group table for the company';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '5';
SET @ParentMenuID = '1';
SET @MenuDescription = 'Management for the Admin to Add Change Delete the User';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysUser';
SET @ParameterDescription = 'Access to Add Change Delete the user table for the company';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '6';
SET @ParentMenuID = '1';
SET @MenuDescription = 'Management for the Admin to Add Change Delete the System Code for BRAT';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysCode';
SET @ParameterDescription = 'Access to configure the system code for BRAT';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '7';
SET @ParentMenuID = '1';
SET @MenuDescription = 'Management for the Admin to Manage the language that BRAT will support';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysLanguage';
SET @ParameterDescription = 'Access to configure the language for BRAT';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '8';
SET @ParentMenuID = '1';
SET @MenuDescription = 'Management for the Admin to manage the country and state that will be served';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysCountry';
SET @ParameterDescription = 'Access to configure different country and country state for BRAT';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @CompanyID = 1;
SET @MenuID = '9';
SET @ParentMenuID = '1';
SET @MenuDescription = 'Management for the Admin to manage the country and state that will be served';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysState';
SET @ParameterDescription = 'Access to configure different country and country state for BRAT';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '10';
SET @ParentMenuID = '2';
SET @MenuDescription = 'Management for the Application Admin to Add Change and Delete the Menu and the structure';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysMenu';
SET @ParameterDescription = 'Access to Add Change Delete for the Menu';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '11';
SET @ParentMenuID = '2';
SET @MenuDescription = 'Management for the Application Admin to manage who can access to the menu';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysMenuAccess';
SET @ParameterDescription = 'Access to Add Change Delete for the Menu Access Rights';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '12';
SET @ParentMenuID = '2';
SET @MenuDescription = 'Management for the Application Admin to manage the configuration of the list';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysListConfig';
SET @ParameterDescription = 'Access to Add Change Delete List configuration for the list generator';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @CompanyID = 1;
SET @MenuID = '13';
SET @ParentMenuID = '2';
SET @MenuDescription = 'Management for the Application Admin to manage the configuration of the form';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysFormConfig';
SET @ParameterDescription = 'Access to Add Change Delete Form configuration for the form generator';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '14';
SET @ParentMenuID = '2';
SET @MenuDescription = 'Management for the Application Admin to manage the Logical table';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysLogicalTable';
SET @ParameterDescription = 'Access to manage the logical table';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @CompanyID = 1;
SET @MenuID = '15';
SET @ParentMenuID = '2';
SET @MenuDescription = 'Management for the Application Admin to manage the Logical Table definition';
SET @ProgramName = 'listgenerator.prg';
SET @Parameter = 'SysLogicalTableDef';
SET @ParameterDescription = 'Access to manage the logical table definition';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;


INSERT INTO `Menu` (`Company_ID`, `Menu_ID`, `Parent_Menu_ID`, `MenuDescription`, `Program`, `Parameter`, `Parameter_description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @ParentMenuID, @MenuDescription, @ProgramName, @Parameter, @ParameterDescription, @currenttime, @currenttime, @whodidit, @entrystatus);





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


SET @CompanyID = 1;
SET @MenuID = '1';
SET @Language = 'EN';
SET @Menu = 'Admin Management';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '2';
SET @Language = 'EN';
SET @Menu = 'Menu Management';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '3';
SET @Language = 'EN';
SET @Menu = 'Company';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '4';
SET @Language = 'EN';
SET @Menu = 'User Group';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '5';
SET @Language = 'EN';
SET @Menu = 'User';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '6';
SET @Language = 'EN';
SET @Menu = 'System Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '7';
SET @Language = 'EN';
SET @Menu = 'Language';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '8';
SET @Language = 'EN';
SET @Menu = 'Country';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @CompanyID = 1;
SET @MenuID = '9';
SET @Language = 'EN';
SET @Menu = 'State';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '10';
SET @Language = 'EN';
SET @Menu = 'Menu';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '11';
SET @Language = 'EN';
SET @Menu = 'Menu Access';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '12';
SET @Language = 'EN';
SET @Menu = 'List Configuration';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '13';
SET @Language = 'EN';
SET @Menu = 'Form Configuration';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @CompanyID = 1;
SET @MenuID = '14';
SET @Language = 'EN';
SET @Menu = 'Logical Table';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @MenuID = '15';
SET @Language = 'EN';
SET @Menu = 'Logical Table Definition';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuLanguage` (`Company_ID`, `Menu_ID`, `Language`, `Menu_Display`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @MenuID, @Language, @Menu, @currenttime, @currenttime, @whodidit, @entrystatus);




-- --------------------------------------------------------

--
-- Table structure for table `MenuAccess`
--

DROP TABLE IF EXISTS `MenuAccess`;
CREATE TABLE IF NOT EXISTS `MenuAccess` (
  `Company_ID` int(11) NOT NULL,
  `User_Group_ID` varchar(12) NOT NULL,
  `Menu_ID` varchar(10) NOT NULL,
  `Access_Rights` enum('R','A','B','C','D','E','F','G') NOT NULL COMMENT '''R'' = Read only, not allow to Add/Change/Delete ''A'' = Can Read / Add / Change / Delete ''B'' = Can Read / Add ''C'' = Can Read / Change ''D'' = Can Read / Delete ''E'' = Can Read / Add / Change ''F'' = Can Read / Add / Delete ''G'' = Can Read / Change / Delete',
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `UK_MenuAccessUserGroup` (`Company_ID`,`User_Group_ID`,`Menu_ID`),
  FOREIGN KEY (`Company_ID`,`User_Group_ID`) REFERENCES `CompanyUserGroup` (`Company_ID`, `User_Group_ID`),
  FOREIGN KEY (`Company_ID`,`Menu_ID`) REFERENCES `Menu` (`Company_ID`, `Menu_ID`)
);



SET @CompanyID = 1;
SET @UserGroupID = '2';
SET @MenuID = '1';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '2';
SET @MenuID = '3';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '2';
SET @MenuID = '4';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '2';
SET @MenuID = '5';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '2';
SET @MenuID = '6';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '2';
SET @MenuID = '7';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '2';
SET @MenuID = '8';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @CompanyID = 1;
SET @UserGroupID = '2';
SET @MenuID = '9';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '3';
SET @MenuID = '1';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '3';
SET @MenuID = '2';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '3';
SET @MenuID = '6';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '3';
SET @MenuID = '7';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '3';
SET @MenuID = '8';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '3';
SET @MenuID = '9';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '3';
SET @MenuID = '10';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @CompanyID = 1;
SET @UserGroupID = '3';
SET @MenuID = '11';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @CompanyID = 1;
SET @UserGroupID = '3';
SET @MenuID = '12';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @CompanyID = 1;
SET @UserGroupID = '3';
SET @MenuID = '13';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @CompanyID = 1;
SET @UserGroupID = '3';
SET @MenuID = '14';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @CompanyID = 1;
SET @UserGroupID = '3';
SET @MenuID = '15';
SET @AccessRights = 'A';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `MenuAccess` (`Company_ID`, `User_Group_ID`, `Menu_ID`, `Access_Rights`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@CompanyID, @UserGroupID, @MenuID, @AccessRights, @currenttime, @currenttime, @whodidit, @entrystatus);


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


SET @ListConfigurationID = 1;
SET @ListName = 'SysCompany';
SET @NoShowField = 29;
SET @ShowField = '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29';
SET @listconfigurationsource = 'company.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @ListConfigurationID = 2;
SET @ListName = 'SysUserGroup';
SET @NoShowField = 5;
SET @ShowField = '1,2,3,4,5';
SET @listconfigurationsource = 'usergroup.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @ListConfigurationID = 3;
SET @ListName = 'SysUser';
SET @NoShowField = 12;
SET @ShowField = '1,2,3,4,5,6,7,8,9,10,11,12';
SET @listconfigurationsource = 'user.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @ListConfigurationID = 4;
SET @ListName = 'SysCode';
SET @NoShowField = 5;
SET @ShowField = '1,2,3,4,5';
SET @listconfigurationsource = 'systemcode.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @ListConfigurationID = 5;
SET @ListName = 'SysLanguage';
SET @NoShowField = 2;
SET @ShowField = '1,2';
SET @listconfigurationsource = 'language.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @ListConfigurationID = 6;
SET @ListName = 'SysCountry';
SET @NoShowField = 3;
SET @ShowField = '1,2,3';
SET @listconfigurationsource = 'country.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @ListConfigurationID = 7;
SET @ListName = 'SysState';
SET @NoShowField = 5;
SET @ShowField = '1,2,3,4,5';
SET @listconfigurationsource = 'menu.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @ListConfigurationID = 8;
SET @ListName = 'SysMenu';
SET @NoShowField = 12;
SET @ShowField = '1,2,3,4,5,6,7,8,9,10,11,12';
SET @listconfigurationsource = 'menuaccess.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @ListConfigurationID = 9;
SET @ListName = 'SysMenuAccess';
SET @NoShowField = 7;
SET @ShowField = '1,2,3,4,5,6,7';
SET @listconfigurationsource = 'listconfiguration.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @ListConfigurationID = 10;
SET @ListName = 'SysListConfig';
SET @NoShowField = 10;
SET @ShowField = '1,2,3,4,5,6,7,8,9,10';
SET @listconfigurationsource = 'logicaltable.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @ListConfigurationID = 11;
SET @ListName = 'SysFormConfig';
SET @NoShowField = 8;
SET @ShowField = '1,2,3,4,5,6,7,8';
SET @listconfigurationsource = 'menuaccess.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @ListConfigurationID = 12;
SET @ListName = 'SysLogicalTable';
SET @NoShowField = 3;
SET @ShowField = '1,2,3';
SET @listconfigurationsource = 'listconfiguration.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @ListConfigurationID = 13;
SET @ListName = 'SysLogicalTableDef';
SET @NoShowField = 12;
SET @ShowField = '1,2,3,4,5,6,7,8,9,10,11,12';
SET @listconfigurationsource = 'logicaltable.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfiguration` (`ListConfiguration_ID`, `List_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @ListName, @NoShowField, @ShowField, @listconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);


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
  FOREIGN KEY (`ListConfiguration_ID`) REFERENCES `ListConfiguration`(`ListConfiguration_ID`),
  FOREIGN KEY (`Language`) REFERENCES `Language`(`Language_Code`)
);



SET @ListConfigurationID = 1;
SET @Language = 'EN';
SET @Title = 'Company';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @ListConfigurationID = 2;
SET @Language = 'EN';
SET @Title = 'User Group';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @ListConfigurationID = 3;
SET @Language = 'EN';
SET @Title = 'User';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @ListConfigurationID = 4;
SET @Language = 'EN';
SET @Title = 'System Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @ListConfigurationID = 5;
SET @Language = 'EN';
SET @Title = 'Language';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @ListConfigurationID = 6;
SET @Language = 'EN';
SET @Title = 'Country';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @ListConfigurationID = 7;
SET @Language = 'EN';
SET @Title = 'State';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @ListConfigurationID = 8;
SET @Language = 'EN';
SET @Title = 'Menu';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @ListConfigurationID = 9;
SET @Language = 'EN';
SET @Title = 'Menu Access Rights for the User';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @ListConfigurationID = 10;
SET @Language = 'EN';
SET @Title = 'List Confiugration';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @ListConfigurationID = 11;
SET @Language = 'EN';
SET @Title = 'Form Configuration';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @ListConfigurationID = 12;
SET @Language = 'EN';
SET @Title = 'Logical Table';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @ListConfigurationID = 13;
SET @Language = 'EN';
SET @Title = 'Logical Table Definition';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `ListConfigurationLanguage` (`ListConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@ListConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);




-- --------------------------------------------------------

--
-- Table structure for table `FormConfiguration`
--

DROP TABLE IF EXISTS `FormConfiguration`;
CREATE TABLE IF NOT EXISTS `FormConfiguration` (
  `FormConfiguration_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Form_Name` varchar(20) NOT NULL,
  `No_Show_Field` int(11) NOT NULL,
  `Shown_Field` varchar(255) NOT NULL,
  `Logical_Table_Name` varchar(255) NOT NULL,
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`FormConfiguration_ID`)
);


SET @FormConfigurationID = 1;
SET @FormName = 'SysCompany';
SET @NoShowField = 29;
SET @ShowField = '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29';
SET @formconfigurationsource = 'company.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @FormConfigurationID = 2;
SET @FormName = 'SysUserGroup';
SET @NoShowField = 5;
SET @ShowField = '1,2,3,4,5';
SET @formconfigurationsource = 'usergroup.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @FormConfigurationID = 3;
SET @FormName = 'SysUser';
SET @NoShowField = 12;
SET @ShowField = '1,2,3,4,5,6,7,8,9,10,11,12';
SET @formconfigurationsource = 'user.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @FormConfigurationID = 4;
SET @FormName = 'SysCode';
SET @NoShowField = 5;
SET @ShowField = '1,2,3,4,5';
SET @formconfigurationsource = 'systemcode.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @FormConfigurationID = 5;
SET @FormName = 'SysLanguage';
SET @NoShowField = 2;
SET @ShowField = '1,2';
SET @formconfigurationsource = 'language.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @FormConfigurationID = 6;
SET @FormName = 'SysCountry';
SET @NoShowField = 3;
SET @ShowField = '1,2,3';
SET @formconfigurationsource = 'country.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @FormConfigurationID = 7;
SET @FormName = 'SysState';
SET @NoShowField = 5;
SET @ShowField = '1,2,3,4,5';
SET @formconfigurationsource = 'menu.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @FormConfigurationID = 8;
SET @FormName = 'SysMenu';
SET @NoShowField = 12;
SET @ShowField = '1,2,3,4,5,6,7,8,9,10,11,12';
SET @formconfigurationsource = 'menuaccess.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @FormConfigurationID = 9;
SET @FormName = 'SysMenuAccess';
SET @NoShowField = 7;
SET @ShowField = '1,2,3,4,5,6,7';
SET @formconfigurationsource = 'formconfiguration.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @FormConfigurationID = 10;
SET @FormName = 'SysFormConfig';
SET @NoShowField = 10;
SET @ShowField = '1,2,3,4,5,6,7,8,9,10';
SET @formconfigurationsource = 'logicaltable.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @FormConfigurationID = 11;
SET @FormName = 'SysFormConfig';
SET @NoShowField = 8;
SET @ShowField = '1,2,3,4,5,6,7,8';
SET @formconfigurationsource = 'menuaccess.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @FormConfigurationID = 12;
SET @FormName = 'SysLogicalTable';
SET @NoShowField = 3;
SET @ShowField = '1,2,3';
SET @formconfigurationsource = 'formconfiguration.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @FormConfigurationID = 13;
SET @FormName = 'SysLogicalTableDef';
SET @NoShowField = 12;
SET @ShowField = '1,2,3,4,5,6,7,8,9,10,11,12';
SET @formconfigurationsource = 'logicaltable.php';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfiguration` (`FormConfiguration_ID`, `Form_Name`, `No_Show_Field`, `Shown_Field`, `Logical_Table_Name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @FormName, @NoShowField, @ShowField, @formconfigurationsource, @currenttime, @currenttime, @whodidit, @entrystatus);


-- --------------------------------------------------------

--
-- Table structure for table `FormConfigurationLanguage`
--

DROP TABLE IF EXISTS `FormConfigurationLanguage`;
CREATE TABLE IF NOT EXISTS `FormConfigurationLanguage` (
  `FormConfiguration_ID` int(11) NOT NULL,
  `Language` varchar(2) NOT NULL,
  `Title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `REC_create_datetime` datetime NOT NULL,
  `REC_lastUpdate_datetime` datetime NOT NULL,
  `REC_lastUpdate_by` varchar(50) NOT NULL,
  `REC_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`FormConfiguration_ID`,`Language`),
  FOREIGN KEY (`FormConfiguration_ID`) REFERENCES `FormConfiguration`(`FormConfiguration_ID`),
  FOREIGN KEY (`Language`) REFERENCES `Language`(`Language_Code`)
);



SET @FormConfigurationID = 1;
SET @Language = 'EN';
SET @Title = 'Company';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @FormConfigurationID = 2;
SET @Language = 'EN';
SET @Title = 'User Group';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @FormConfigurationID = 3;
SET @Language = 'EN';
SET @Title = 'User';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @FormConfigurationID = 4;
SET @Language = 'EN';
SET @Title = 'System Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @FormConfigurationID = 5;
SET @Language = 'EN';
SET @Title = 'Language';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @FormConfigurationID = 6;
SET @Language = 'EN';
SET @Title = 'Country';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @FormConfigurationID = 7;
SET @Language = 'EN';
SET @Title = 'State';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @FormConfigurationID = 8;
SET @Language = 'EN';
SET @Title = 'Menu';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @FormConfigurationID = 9;
SET @Language = 'EN';
SET @Title = 'Menu Access Rights for the User';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @FormConfigurationID = 10;
SET @Language = 'EN';
SET @Title = 'Form Confiugration';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @FormConfigurationID = 11;
SET @Language = 'EN';
SET @Title = 'Form Configuration';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @FormConfigurationID = 12;
SET @Language = 'EN';
SET @Title = 'Logical Table';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @FormConfigurationID = 13;
SET @Language = 'EN';
SET @Title = 'Logical Table Definition';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `FormConfigurationLanguage` (`FormConfiguration_ID`, `Language`, `Title`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@FormConfigurationID, @Language, @Title, @currenttime, @currenttime, @whodidit, @entrystatus);




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


SET @LogicalTableName = 'Company';
SET @LogicalTableDescription = 'Table show the company';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableName = 'User Group';
SET @LogicalTableDescription = 'Table show the user group';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableName = 'User';
SET @LogicalTableDescription = 'Table show the user';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableName = 'System Code';
SET @LogicalTableDescription = 'Table show the system code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableName = 'Language';
SET @LogicalTableDescription = 'Table show the list of language';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableName = 'Country';
SET @LogicalTableDescription = 'Table show the list of country related to the country';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableName = 'State';
SET @LogicalTableDescription = 'Table show the list of state related to the country';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableName = 'Menu';
SET @LogicalTableDescription = 'Table show the list of menu selections';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableName = 'Menu Access';
SET @LogicalTableDescription = 'Table show the list of menu access for the user';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableName = 'List Configuration';
SET @LogicalTableDescription = 'Table show the list configuration';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableName = 'Form Configuration';
SET @LogicalTableDescription = 'Table show the form configuration';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableName = 'Logical Table';
SET @LogicalTableDescription = 'Table show the logical table';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableName = 'Logical Table Definition';
SET @LogicalTableDescription = 'Table show the logical table definition';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalTable` (`Logical_Table_Name`, `Logical_Table_Description`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableName, @LogicalTableDescription, @currenttime, @currenttime, @whodidit, @entrystatus);



-- --------------------------------------------------------

--
-- Table structure for table `LogicalDefinitionTable`
--

DROP TABLE IF EXISTS `LogicalDefinitionTable`;
CREATE TABLE IF NOT EXISTS `LogicalDefinitionTable` (
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


SET @LogicalTableID = 1;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 3;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 4;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 5;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 6;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 7;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 8;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 9;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 10;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 11;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 12;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 13;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 14;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 15;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 16;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 17;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 18;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 19;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 20;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 21;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 1;
SET @FieldNo = 22;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 23;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 24;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 25;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 26;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 27;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 28;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 29;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 2;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 2;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 2;
SET @FieldNo = 3;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 2;
SET @FieldNo = 4;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 2;
SET @FieldNo = 5;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 3;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 4;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 5;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 6;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 7;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 8;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 3;
SET @FieldNo = 9;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 3;
SET @FieldNo = 10;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 11;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 12;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 4;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 4;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 4;
SET @FieldNo = 3;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 4;
SET @FieldNo = 4;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 4;
SET @FieldNo = 5;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 5;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 5;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 6;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 6;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 6;
SET @FieldNo = 3;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 7;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 7;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 7;
SET @FieldNo = 3;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 7;
SET @FieldNo = 4;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 7;
SET @FieldNo = 5;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 3;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 4;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 8;
SET @FieldNo = 5;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 6;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 7;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 8;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 8;
SET @FieldNo = 9;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 8;
SET @FieldNo = 10;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 11;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 8;
SET @FieldNo = 12;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 3;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 4;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 5;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 6;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 7;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 3;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 4;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 5;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 6;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 7;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 8;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 9;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 10;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 11;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 3;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 4;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 5;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 6;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 7;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 8;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 12;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 12;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 12;
SET @FieldNo = 3;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 13;
SET @FieldNo = 1;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 2;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 3;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 4;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 5;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 6;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 7;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 8;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 9;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 10;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 11;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 12;
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTable` (`Logical_Table_ID`, `Field_no`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by` , `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @currenttime, @currenttime, @whodidit, @entrystatus);


-- --------------------------------------------------------

--
-- Table structure for table `LogicalDefinitionTableLanguage`
--

DROP TABLE IF EXISTS `LogicalDefinitionTableLanguage`;
CREATE TABLE IF NOT EXISTS `LogicalDefinitionTableLanguage` (
  `Logical_Table_ID` int(11) NOT NULL,
  `Field_no` int(11) NOT NULL,
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


SET @LogicalTableID = 1;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'Company ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'Company Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 1;
SET @FieldNo = 3;
SET @Language = 'EN';
SET @FieldName = 'Country of origin of the company';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 4;
SET @Language = 'EN';
SET @FieldName = 'Billing Address Line 1';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 1;
SET @FieldNo = 5;
SET @Language = 'EN';
SET @FieldName = 'Billing Address Line 2';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 6;
SET @Language = 'EN';
SET @FieldName = 'Billing Address City';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 7;
SET @Language = 'EN';
SET @FieldName = 'Billing Address State';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 1;
SET @FieldNo = 8;
SET @Language = 'EN';
SET @FieldName = 'Billing Address Country';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 9;
SET @Language = 'EN';
SET @FieldName = 'Billing Address Postal Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 10;
SET @Language = 'EN';
SET @FieldName = 'Contact Person';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 11;
SET @Language = 'EN';
SET @FieldName = 'Contact Email';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 12;
SET @Language = 'EN';
SET @FieldName = 'Contact Country Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 13;
SET @Language = 'EN';
SET @FieldName = 'Force Change Password (Days)';
SET @currenttime = now();
SET @whodidit = 'Contact Area Code';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 14;
SET @Language = 'EN';
SET @FieldName = 'Contact Number';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 15;
SET @Language = 'EN';
SET @FieldName = 'Company Registration Number';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 16;
SET @Language = 'EN';
SET @FieldName = 'Company Bank Payment Link Info';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 17;
SET @Language = 'EN';
SET @FieldName = 'Company Logo Image file';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 18;
SET @Language = 'EN';
SET @FieldName = 'Company Offical Language';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 19;
SET @Language = 'EN';
SET @FieldName = 'Company Relationship Manager';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 20;
SET @Language = 'EN';
SET @FieldName = 'Implement First Login Flag';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 21;
SET @Language = 'EN';
SET @FieldName = 'Force Change Password (In Days)';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 1;
SET @FieldNo = 22;
SET @Language = 'EN';
SET @FieldName = 'Max No Of Retries allowed';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 1;
SET @FieldNo = 23;
SET @Language = 'EN';
SET @FieldName = 'Implement Cannot use last 5 passwords';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 24;
SET @Language = 'EN';
SET @FieldName = 'Min Length of Password';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 1;
SET @FieldNo = 25;
SET @Language = 'EN';
SET @FieldName = 'Compulsory Upper Case';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 26;
SET @Language = 'EN';
SET @FieldName = 'Compulsory Numeric';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 27;
SET @Language = 'EN';
SET @FieldName = 'Compulsory Special Characters';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 1;
SET @FieldNo = 28;
SET @Language = 'EN';
SET @FieldName = 'Maximum user inactivity (In Days)';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 1;
SET @FieldNo = 29;
SET @Language = 'EN';
SET @FieldName = 'No Activity Lock out (In Seconds)';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 2;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'Company ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 2;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'User Group ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 2;
SET @FieldNo = 3;
SET @Language = 'EN';
SET @FieldName = 'User Role Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 2;
SET @FieldNo = 4;
SET @Language = 'EN';
SET @FieldName = 'User Role Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 2;
SET @FieldNo = 5;
SET @Language = 'EN';
SET @FieldName = 'User Role Description';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'User ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'Company Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 3;
SET @Language = 'EN';
SET @FieldName = 'User Group Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 4;
SET @Language = 'EN';
SET @FieldName = 'First Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 5;
SET @Language = 'EN';
SET @FieldName = 'Middle Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 6;
SET @Language = 'EN';
SET @FieldName = 'Last Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 7;
SET @Language = 'EN';
SET @FieldName = 'Email Address';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 8;
SET @Language = 'EN';
SET @FieldName = 'Country Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 9;
SET @Language = 'EN';
SET @FieldName = 'Area Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 3;
SET @FieldNo = 10;
SET @Language = 'EN';
SET @FieldName = 'Contact Number';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 11;
SET @Language = 'EN';
SET @FieldName = 'User Status';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 3;
SET @FieldNo = 12;
SET @Language = 'EN';
SET @FieldName = 'Number Of password retries';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 4;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'Language ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 4;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'System Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 4;
SET @FieldNo = 3;
SET @Language = 'EN';
SET @FieldName = 'Language';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 4;
SET @FieldNo = 4;
SET @Language = 'EN';
SET @FieldName = 'System Message';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 4;
SET @FieldNo = 5;
SET @Language = 'EN';
SET @FieldName = 'System Description';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 5;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'Language Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 5;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'Language';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 6;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'Country ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 6;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'Country Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 6;
SET @FieldNo = 3;
SET @Language = 'EN';
SET @FieldName = 'Country Dial Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);



SET @LogicalTableID = 7;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'Country Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 7;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'State Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 7;
SET @FieldNo = 3;
SET @Language = 'EN';
SET @FieldName = 'Country Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 7;
SET @FieldNo = 4;
SET @Language = 'EN';
SET @FieldName = 'State Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 7;
SET @FieldNo = 5;
SET @Language = 'EN';
SET @FieldName = 'Area Dial Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'Company ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'Company Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 3;
SET @Language = 'EN';
SET @FieldName = 'Menu ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 4;
SET @Language = 'EN';
SET @FieldName = 'Menu Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 8;
SET @FieldNo = 5;
SET @Language = 'EN';
SET @FieldName = 'Language Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 6;
SET @Language = 'EN';
SET @FieldName = 'Language';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 8;
SET @FieldNo = 7;
SET @Language = 'EN';
SET @FieldName = 'Menu Display';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 8;
SET @Language = 'EN';
SET @FieldName = 'Parent Menu';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 9;
SET @Language = 'EN';
SET @FieldName = 'Menu Description';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 10;
SET @Language = 'EN';
SET @FieldName = 'Program';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 11;
SET @Language = 'EN';
SET @FieldName = 'Parameter';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 8;
SET @FieldNo = 12;
SET @Language = 'EN';
SET @FieldName = 'Parameter Description';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'Company ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'Company Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 3;
SET @Language = 'EN';
SET @FieldName = 'User Group ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 4;
SET @Language = 'EN';
SET @FieldName = 'User Group Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 5;
SET @Language = 'EN';
SET @FieldName = 'Menu ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 9;
SET @FieldNo = 6;
SET @Language = 'EN';
SET @FieldName = 'Menu Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 9;
SET @FieldNo = 7;
SET @Language = 'EN';
SET @FieldName = 'Access Rights';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'List Configuration ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'Language Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 3;
SET @Language = 'EN';
SET @FieldName = 'Language';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 4;
SET @Language = 'EN';
SET @FieldName = 'Title';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 5;
SET @Language = 'EN';
SET @FieldName = 'List Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 6;
SET @Language = 'EN';
SET @FieldName = 'Number of Fields in this List';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 7;
SET @Language = 'EN';
SET @FieldName = 'Which Fields No in Logical Table';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 8;
SET @Language = 'EN';
SET @FieldName = 'Number of Fields to be sorted';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 9;
SET @Language = 'EN';
SET @FieldName = 'Which Fields No in Logical Table is sortable';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 10;
SET @FieldNo = 10;
SET @Language = 'EN';
SET @FieldName = 'Logical Table Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 11;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'Form Configuration ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'Language Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 3;
SET @Language = 'EN';
SET @FieldName = 'Language';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 4;
SET @Language = 'EN';
SET @FieldName = 'Title';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 5;
SET @Language = 'EN';
SET @FieldName = 'Form Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 6;
SET @Language = 'EN';
SET @FieldName = 'Number of Fields in this List';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 11;
SET @FieldNo = 7;
SET @Language = 'EN';
SET @FieldName = 'Which Fields No in Logical Table';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 11;
SET @FieldNo = 8;
SET @Language = 'EN';
SET @FieldName = 'Logical Table Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 12;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'Logical Table ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 12;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'Logical Table Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 12;
SET @FieldNo = 3;
SET @Language = 'EN';
SET @FieldName = 'Logical Table Description';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 13;
SET @FieldNo = 1;
SET @Language = 'EN';
SET @FieldName = 'Logical Table ID';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 2;
SET @Language = 'EN';
SET @FieldName = 'Logial Table Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 13;
SET @FieldNo = 3;
SET @Language = 'EN';
SET @FieldName = 'Field No';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 4;
SET @Language = 'EN';
SET @FieldName = 'Language Code';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 13;
SET @FieldNo = 5;
SET @Language = 'EN';
SET @FieldName = 'Language';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 6;
SET @Language = 'EN';
SET @FieldName = 'Field Name';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 7;
SET @Language = 'EN';
SET @FieldName = 'Field Type';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);

SET @LogicalTableID = 13;
SET @FieldNo = 8;
SET @Language = 'EN';
SET @FieldName = 'Field Validation';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 9;
SET @Language = 'EN';
SET @FieldName = 'Validation Type';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 10;
SET @Language = 'EN';
SET @FieldName = 'Validation Parameter';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 11;
SET @Language = 'EN';
SET @FieldName = 'Program Validation';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


SET @LogicalTableID = 13;
SET @FieldNo = 12;
SET @Language = 'EN';
SET @FieldName = 'Bind Validation';
SET @currenttime = now();
SET @whodidit = 'System';
SET @entrystatus = 1;

INSERT INTO `LogicalDefinitionTableLanguage` (`Logical_Table_ID`, `Field_no`, `Language`, `Field_name`, `REC_create_datetime`, `REC_lastUpdate_datetime`, `REC_lastUpdate_by`, `REC_status`) VALUES
(@LogicalTableID, @FieldNo, @Language, @FieldName, @currenttime, @currenttime, @whodidit, @entrystatus);


-- --------------------------------------------------------

