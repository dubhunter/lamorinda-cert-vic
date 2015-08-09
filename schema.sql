-- MySQL dump 10.13  Distrib 5.6.21, for osx10.10 (x86_64)
--
-- Host: localhost    Database: lamorinda_cert_vrc
-- ------------------------------------------------------
-- Server version	5.6.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agencies`
--

DROP TABLE IF EXISTS `agencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agencies` (
  `id` char(8) NOT NULL COMMENT 'Agency ID',
  `name` varchar(60) NOT NULL COMMENT 'Agency Name',
  `street` varchar(60) NOT NULL COMMENT 'Agency Street Address',
  `city` varchar(30) NOT NULL COMMENT 'Agency City',
  `phone` char(16) NOT NULL COMMENT 'Agency Primary Phone Number',
  `contact` varchar(60) NOT NULL COMMENT 'Agency Contact',
  `position` varchar(30) NOT NULL COMMENT 'Contact position',
  `phone_direct` char(16) NOT NULL DEFAULT '' COMMENT 'Contact Phone Direct',
  `fax` char(16) DEFAULT NULL COMMENT 'Contact Fax Number',
  `phone_cell` char(16) NOT NULL DEFAULT '' COMMENT 'Contact Phone Cell',
  `email` varchar(60) NOT NULL COMMENT 'Contact Email',
  `radio` varchar(12) DEFAULT NULL COMMENT 'Contact radio channel',
  `comment` varchar(240) DEFAULT NULL COMMENT 'Contact Comments',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Agency';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agencies`
--

LOCK TABLES `agencies` WRITE;
/*!40000 ALTER TABLE `agencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `agencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsw`
--

DROP TABLE IF EXISTS `dsw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dsw` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'DSW ID',
  `volunteer_id` int(11) NOT NULL COMMENT 'Volunteer ID',
  `dsw_class_id` int(11) NOT NULL COMMENT 'Clasification',
  `jurisdiction_id` int(11) NOT NULL COMMENT 'City',
  `date` date NOT NULL COMMENT 'Date',
  `sworn_by` char(3) NOT NULL COMMENT 'Sworn in By',
  PRIMARY KEY (`id`),
  KEY `fk_dsw` (`volunteer_id`),
  KEY `fk_dswjur` (`jurisdiction_id`),
  KEY `fk_class` (`dsw_class_id`),
  CONSTRAINT `dsw_ibfk_1` FOREIGN KEY (`volunteer_id`) REFERENCES `volunteers` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `dsw_ibfk_2` FOREIGN KEY (`jurisdiction_id`) REFERENCES `jurisdictions` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `dsw_ibfk_3` FOREIGN KEY (`dsw_class_id`) REFERENCES `dsw_classes` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Disaster Service Worker registrations';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsw`
--

LOCK TABLES `dsw` WRITE;
/*!40000 ALTER TABLE `dsw` DISABLE KEYS */;
/*!40000 ALTER TABLE `dsw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsw_classes`
--

DROP TABLE IF EXISTS `dsw_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dsw_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'DSW Classification ID',
  `class` varchar(50) NOT NULL COMMENT 'DSW Classification',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dswc` (`class`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Disaster Service Worker Classifications';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsw_classes`
--

LOCK TABLES `dsw_classes` WRITE;
/*!40000 ALTER TABLE `dsw_classes` DISABLE KEYS */;
INSERT INTO `dsw_classes` VALUES (1,'Animal Rescue, Care & Shelter'),(2,'Communications'),(3,'Community Emergency Response Team Member'),(4,'Emergency Operations Center/Incident Command'),(6,'Fire'),(5,'Human Services'),(7,'Laborer'),(8,'Law Enforcement'),(9,'Logistics'),(10,'Medical & Environmental Health'),(11,'Safety Assessment Program Evaluator'),(12,'Search & Rescue'),(13,'Utilities');
/*!40000 ALTER TABLE `dsw_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jurisdictions`
--

DROP TABLE IF EXISTS `jurisdictions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jurisdictions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Jurisdiction ID',
  `jurisdiction` varchar(30) NOT NULL COMMENT 'City or Town',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jur` (`jurisdiction`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Jurisdictions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jurisdictions`
--

LOCK TABLES `jurisdictions` WRITE;
/*!40000 ALTER TABLE `jurisdictions` DISABLE KEYS */;
INSERT INTO `jurisdictions` VALUES (1,'Lafayette'),(2,'Moraga'),(3,'Orinda');
/*!40000 ALTER TABLE `jurisdictions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `placements`
--

DROP TABLE IF EXISTS `placements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `placements` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Placement ID',
  `volunteer_id` int(11) NOT NULL COMMENT 'Volunteer ID',
  `requests_details_id` int(11) NOT NULL COMMENT 'Request Detail ID',
  `comment` varchar(240) DEFAULT NULL COMMENT 'Placement Comments',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Placement Date & Time',
  PRIMARY KEY (`id`),
  KEY `fk_pvolunteer_id` (`volunteer_id`),
  KEY `fk_prd` (`requests_details_id`),
  CONSTRAINT `placements_ibfk_1` FOREIGN KEY (`volunteer_id`) REFERENCES `volunteers` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `placements_ibfk_2` FOREIGN KEY (`requests_details_id`) REFERENCES `request_details` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Placement details';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `placements`
--

LOCK TABLES `placements` WRITE;
/*!40000 ALTER TABLE `placements` DISABLE KEYS */;
/*!40000 ALTER TABLE `placements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_details`
--

DROP TABLE IF EXISTS `request_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Request Detail ID',
  `request_id` int(11) NOT NULL COMMENT 'Request ID',
  `skill_code` char(7) NOT NULL COMMENT 'Req Skill',
  `number` int(11) NOT NULL COMMENT 'Req Number Needed',
  `days` int(11) NOT NULL COMMENT 'Req Number Days',
  `start_date` date NOT NULL COMMENT 'Req Start Date',
  `start_time` time NOT NULL COMMENT 'Req Start Time',
  `hours` decimal(10,0) NOT NULL COMMENT 'Req Hours per Day',
  `comment` varchar(240) DEFAULT NULL COMMENT 'Request Comments',
  `open` int(11) NOT NULL COMMENT 'Req Number Open',
  PRIMARY KEY (`id`),
  KEY `rid` (`request_id`),
  KEY `fk_rdsc` (`skill_code`),
  CONSTRAINT `request_details_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `request_details_ibfk_2` FOREIGN KEY (`skill_code`) REFERENCES `skills` (`code`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Request details';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_details`
--

LOCK TABLES `request_details` WRITE;
/*!40000 ALTER TABLE `request_details` DISABLE KEYS */;
INSERT INTO `request_details` VALUES (1,1,'EV-101',3,1,'2015-09-01','07:00:00',3,'Most important.',1);
/*!40000 ALTER TABLE `request_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Request ID',
  `agency_id` char(8) NOT NULL DEFAULT '' COMMENT 'Req Agency',
  `street` varchar(60) NOT NULL COMMENT 'Req Street',
  `jurisdiction_id` int(11) NOT NULL COMMENT 'Req City',
  `contact` varchar(60) NOT NULL COMMENT 'Req Contact',
  `phone_work` char(16) NOT NULL DEFAULT '' COMMENT 'Req Phone Work',
  `fax` char(16) DEFAULT NULL COMMENT 'Req Fax Number',
  `phone_cell` char(16) NOT NULL DEFAULT '' COMMENT 'Req Phone Cell',
  `email` varchar(60) NOT NULL COMMENT 'Req Email',
  `radio` varchar(12) DEFAULT NULL COMMENT 'Contact radio channel',
  `comment` varchar(240) DEFAULT NULL COMMENT 'Request Comments',
  `open` tinyint(1) NOT NULL COMMENT 'Req Open',
  PRIMARY KEY (`id`),
  KEY `fk_ra` (`agency_id`),
  KEY `fk_rjur` (`jurisdiction_id`),
  KEY `open` (`open`),
  CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`jurisdiction_id`) REFERENCES `jurisdictions` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Requests for volunteers';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skills` (
  `code` char(7) NOT NULL COMMENT 'Skill Code',
  `skill` varchar(30) NOT NULL COMMENT 'Skill Description',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Skills';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES ('EV-101','First Aid Certified'),('EV-102','CPR Certified'),('EV-103','Mental Health Counseling'),('EV-104','Medical Doctor'),('EV-105','Nurse'),('EV-106','Emergency Medical Responder'),('EV-107','Veterinarian'),('EV-108','Vet Tech'),('EV-201','Carded Food Handler'),('EV-202','Crowd Control'),('EV-203','Child Skills'),('EV-204','Messenger / Runner outside'),('EV-205','Experienced Supervisor'),('EV-206','Search and Rescue'),('EV-301','Clerical'),('EV-302','Data Entry'),('EV-303','Phones'),('EV-304','Messenger / Runner inside'),('EV-401','HAM Radio Operator'),('EV-402','Hotline Operator'),('EV-403','Language - Spanish'),('EV-404','Language - Chinese'),('EV-405','Language - Tagalog'),('EV-406','Language - Vietnamese'),('EV-407','Language - Other'),('EV-408','Language - French'),('EV-409','Language - German'),('EV-410','Language - Arabic'),('EV-411','Language - Hebrew'),('EV-412','Language - Japanese'),('EV-413','Language - Korean'),('EV-414','Language - Portuguese'),('EV-415','Language - Farsi'),('EV-416','Language - Pashto'),('EV-417','Language - Russian'),('EV-501','Loading / Shipping'),('EV-502','Sorting / Packing'),('EV-503','Clean-up / Waste Removal'),('EV-504','Building Maintenance'),('EV-511','Drive 4WD Truck'),('EV-512','Operate Backhoe'),('EV-513','Operate Chainsaw'),('EV-514','Operate Loader'),('EV-515','Operate Generator'),('EV-516','Operate Other'),('EV-521','Own 4WD Truck'),('EV-522','Own Backhoe'),('EV-523','Own Chainsaw'),('EV-524','Own Loader'),('EV-525','Own Generator'),('EV-526','Own Other'),('EV-601','Construction Supervisor'),('EV-602','Structural Engineer'),('EV-603','Carpenter'),('EV-604','Plumber'),('EV-605','Electrician'),('EV-606','HVAC'),('EV-607','Roofer'),('EV-900','Other');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timesheets`
--

DROP TABLE IF EXISTS `timesheets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timesheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Timesheet ID',
  `volunteer_id` int(11) NOT NULL COMMENT 'Volunteer ID',
  `requests_details_id` int(11) NOT NULL COMMENT 'Request Detail ID',
  `comment` varchar(240) DEFAULT NULL COMMENT 'Timesheet Comments',
  `date` date DEFAULT NULL COMMENT 'Timesheet Date',
  `hours` decimal(5,2) DEFAULT NULL COMMENT 'Timesheet Hours',
  PRIMARY KEY (`id`),
  KEY `fk_tsvolunteer_id` (`volunteer_id`),
  KEY `fk_tsrequests_details_id` (`requests_details_id`),
  CONSTRAINT `timesheets_ibfk_1` FOREIGN KEY (`volunteer_id`) REFERENCES `volunteers` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `timesheets_ibfk_2` FOREIGN KEY (`requests_details_id`) REFERENCES `request_details` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Timesheet details';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timesheets`
--

LOCK TABLES `timesheets` WRITE;
/*!40000 ALTER TABLE `timesheets` DISABLE KEYS */;
/*!40000 ALTER TABLE `timesheets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `role` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2a$08$O3NW0mI9u8OHqt7blrMG7eFRVaTiSHP8mxsnCCJnluWaTOhuKYL4y',1,'2015-06-07 18:43:50','2015-06-22 13:50:48');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteer_availability`
--

DROP TABLE IF EXISTS `volunteer_availability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `volunteer_availability` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Availability ID',
  `volunteer_id` int(11) NOT NULL COMMENT 'Volunteer ID',
  `date` date NOT NULL COMMENT 'Date',
  `start` time NOT NULL COMMENT 'Start Time',
  `end` time NOT NULL COMMENT 'End Time',
  `comment` varchar(240) DEFAULT NULL COMMENT 'Availability Comment',
  `open` tinyint(1) NOT NULL COMMENT 'Open',
  PRIMARY KEY (`id`),
  KEY `fk_ava` (`volunteer_id`),
  CONSTRAINT `volunteer_availability_ibfk_1` FOREIGN KEY (`volunteer_id`) REFERENCES `volunteers` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Volunteer availability';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteer_availability`
--

LOCK TABLES `volunteer_availability` WRITE;
/*!40000 ALTER TABLE `volunteer_availability` DISABLE KEYS */;
/*!40000 ALTER TABLE `volunteer_availability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteer_skills`
--

DROP TABLE IF EXISTS `volunteer_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `volunteer_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Volunteer Skills ID',
  `volunteer_id` int(11) NOT NULL COMMENT 'Volunteer ID',
  `skill_code` char(7) NOT NULL COMMENT 'Skill Code',
  `check` tinyint(1) NOT NULL COMMENT 'Checked',
  `license` char(15) NOT NULL COMMENT 'License',
  `license_auth` varchar(60) NOT NULL COMMENT 'License Authority',
  `license_exp` date DEFAULT NULL COMMENT 'License Expiration Date',
  `specialty` varchar(60) NOT NULL COMMENT 'Specialty',
  `comment` varchar(240) DEFAULT NULL COMMENT 'Volunteer Skills Comment',
  PRIMARY KEY (`id`),
  KEY `fk_vsvolunteer_id` (`volunteer_id`),
  KEY `fk_vssc` (`skill_code`),
  CONSTRAINT `volunteer_skills_ibfk_1` FOREIGN KEY (`volunteer_id`) REFERENCES `volunteers` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `volunteer_skills_ibfk_2` FOREIGN KEY (`skill_code`) REFERENCES `skills` (`code`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Volunteer Skills';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteer_skills`
--

LOCK TABLES `volunteer_skills` WRITE;
/*!40000 ALTER TABLE `volunteer_skills` DISABLE KEYS */;
/*!40000 ALTER TABLE `volunteer_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteers`
--

DROP TABLE IF EXISTS `volunteers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `volunteers` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Volunteer ID',
  `name_last` varchar(30) NOT NULL COMMENT 'Name Last',
  `name_first` varchar(30) NOT NULL COMMENT 'Name First',
  `name_middle` varchar(30) DEFAULT NULL COMMENT 'Name Middle',
  `address` varchar(50) NOT NULL COMMENT 'Address',
  `city` varchar(30) NOT NULL COMMENT 'City',
  `state` char(3) NOT NULL DEFAULT 'CA' COMMENT 'State',
  `zip` char(10) NOT NULL COMMENT 'ZIP',
  `phone_day` char(16) DEFAULT NULL COMMENT 'Phone Day',
  `phone_eve` char(16) DEFAULT NULL COMMENT 'Phone Eve',
  `phone_cell` char(16) NOT NULL DEFAULT '' COMMENT 'Phone Cell',
  `email` varchar(60) NOT NULL COMMENT 'Email',
  `minor` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Under 18',
  `dob` date DEFAULT NULL COMMENT 'Date of Birth',
  `guardian_name` varchar(60) DEFAULT NULL COMMENT 'Parent/Guardian name if under 18',
  `id_type` char(3) DEFAULT NULL COMMENT 'ID Type',
  `id_number` char(10) DEFAULT NULL COMMENT 'ID Number',
  `id_state` char(4) DEFAULT NULL COMMENT 'ID State, Country or Branch',
  `agency` varchar(60) DEFAULT NULL COMMENT 'Agency, School, etc.',
  `training` mediumtext COMMENT 'Disaster training',
  `ec_name` varchar(40) DEFAULT NULL COMMENT 'Emergency Contact Name',
  `ec_phone` char(16) DEFAULT NULL COMMENT 'Emergency Contact Phone',
  `image` mediumblob COMMENT 'Volunteer Photo',
  `intake_by` char(3) DEFAULT NULL COMMENT 'Intake Form by',
  `intake_time` datetime DEFAULT NULL COMMENT 'Intake Form time',
  `bg_by` char(3) DEFAULT NULL COMMENT 'Background by',
  `bg_time` datetime DEFAULT NULL COMMENT 'Background time',
  `bg_pass` tinyint(1) DEFAULT NULL COMMENT 'BG Check Passed',
  `screen_by` char(3) DEFAULT NULL COMMENT 'Screened by',
  `screen_time` datetime DEFAULT NULL COMMENT 'Screened time',
  `rev_by` char(3) DEFAULT NULL COMMENT 'Reviewed by',
  `rev_time` datetime DEFAULT NULL COMMENT 'Reviewed time',
  `db_by` char(3) DEFAULT NULL COMMENT 'Data Entered by',
  `db_time` datetime DEFAULT NULL COMMENT 'Data Entry time',
  `comment` varchar(240) DEFAULT NULL COMMENT 'Request Comments',
  `available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Available',
  PRIMARY KEY (`id`),
  KEY `name_last` (`name_last`),
  KEY `available` (`available`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Volunteer basic information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteers`
--

LOCK TABLES `volunteers` WRITE;
/*!40000 ALTER TABLE `volunteers` DISABLE KEYS */;
/*!40000 ALTER TABLE `volunteers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-08 19:44:12
