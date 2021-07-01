-- MariaDB dump 10.19  Distrib 10.5.10-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: covid19_sample_db
-- ------------------------------------------------------
-- Server version	10.5.10-MariaDB-1:10.5.10+maria~focal

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `checkups`
--

DROP TABLE IF EXISTS `checkups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checkups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checkups`
--

LOCK TABLES `checkups` WRITE;
/*!40000 ALTER TABLE `checkups` DISABLE KEYS */;
INSERT INTO `checkups` VALUES (1,'Screening','2021-06-07 01:47:33','2021-06-07 01:47:35'),(2,'Pelaku Perjalanan','2021-06-07 01:47:36','2021-06-07 01:47:36'),(3,'KERT','2021-06-07 01:47:37','2021-06-07 01:47:38'),(4,'Suspect','2021-06-07 01:47:39','2021-06-07 01:47:40');
/*!40000 ALTER TABLE `checkups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `explanations`
--

DROP TABLE IF EXISTS `explanations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `explanations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `explanations`
--

LOCK TABLES `explanations` WRITE;
/*!40000 ALTER TABLE `explanations` DISABLE KEYS */;
INSERT INTO `explanations` VALUES (1,'Pengambilan Spesimen 1','2021-06-07 01:47:23','2021-06-07 01:47:26'),(2,'Pengambilan Spesimen 2','2021-06-07 01:47:28','2021-06-07 01:47:28'),(3,'Pengambilan Spesimen 3','2021-06-07 01:47:29','2021-06-07 01:47:30');
/*!40000 ALTER TABLE `explanations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_06_05_151722_create_roles_table',1),(2,'2020_12_20_154739_create_users_table',1),(3,'2021_06_05_135647_create_inspenctions_table',1),(4,'2021_06_05_145554_create_swab_types_table',1),(5,'2021_06_05_152137_create_patients_table',1),(6,'2021_06_05_152156_create_samples_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL COMMENT 'Tempat lahir',
  `date_of_birth` date NOT NULL COMMENT 'Tanggal lahir',
  `nik` varchar(255) NOT NULL COMMENT 'Nomor Induk Kependududkan',
  `address` varchar(255) NOT NULL COMMENT 'Alamat',
  `gender` enum('L','P') NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patients_nik_unique` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'Dummy Sadikin','Kotamobagu','1985-01-15','7173021501850001','Citra Lestari Land Nomor 5','L','08225555555',NULL,NULL),(2,'Lando Sadikin','Manado','2005-06-08','7173020806050002',' Citra Lestari Land Nomor 5','L','08222722222',NULL,NULL),(3,'Sanyo Sadikin','Manado','2010-07-15','7173021507100003',' Citra Lestari Land Nomor 5','P','08227277272',NULL,NULL),(4,'Juminten Salama','Manado','1989-06-14','7173021501890001','Perum Citra Lestari 5','P','0822272221',NULL,NULL);
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','2021-06-07 01:47:06','2021-06-07 01:47:07'),(2,'labelator','2021-06-07 01:47:09','2021-06-07 01:47:10'),(3,'validator','2021-06-07 01:47:11','2021-06-07 01:47:12'),(4,'inputor','2021-06-07 01:47:13','2021-06-07 01:47:14');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `samples`
--

DROP TABLE IF EXISTS `samples`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `samples` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) unsigned NOT NULL,
  `checkup_id` bigint(20) unsigned NOT NULL,
  `explanation_id` bigint(20) unsigned NOT NULL,
  `code` varchar(255) NOT NULL,
  `indications` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('ISSUED','LABELED','VERIFIED') NOT NULL DEFAULT 'ISSUED',
  `verify_status` enum('PROCESS','POSITIVE','NEGATIVE') NOT NULL DEFAULT 'PROCESS',
  `label_status` enum('PROCESS','EXTRACTING','MIXING','PCR','TIDAK_LAYAK') NOT NULL DEFAULT 'PROCESS',
  PRIMARY KEY (`id`),
  UNIQUE KEY `samples_code_unique` (`code`),
  KEY `samples_inspenction_id_foreign` (`checkup_id`),
  KEY `samples_swab_type_id_foreign` (`explanation_id`),
  KEY `samples_patient_id_foreign` (`patient_id`),
  CONSTRAINT `samples_inspenction_id_foreign` FOREIGN KEY (`checkup_id`) REFERENCES `checkups` (`id`),
  CONSTRAINT `samples_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `samples_swab_type_id_foreign` FOREIGN KEY (`explanation_id`) REFERENCES `explanations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `samples`
--

LOCK TABLES `samples` WRITE;
/*!40000 ALTER TABLE `samples` DISABLE KEYS */;
INSERT INTO `samples` VALUES (1,1,1,1,'USR001','JUST TEST','2021-06-07 15:33:37','2021-06-07 16:04:29','ISSUED','PROCESS','PROCESS'),(2,2,2,1,'USR002','JUST TEST','2021-06-07 16:04:25','2021-06-07 16:04:30','LABELED','PROCESS','MIXING'),(3,3,3,2,'USR003','JUST TEST','2021-06-07 16:05:47','2021-06-07 16:05:48','VERIFIED','NEGATIVE','PCR'),(4,4,3,3,'USR004','JUST TEST','2021-06-07 16:33:13','2021-06-07 16:33:15','LABELED','PROCESS','TIDAK_LAYAK'),(14,4,4,3,'USR012','test data','2021-06-07 18:42:55','2021-06-07 19:12:46','VERIFIED','POSITIVE','PCR');
/*!40000 ALTER TABLE `samples` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Super Admin','admin@email.id','082271111111','$2y$12$1atei2A/Mc8ro4GYwY9MSuGwcRzdYymcxmz.rGLXu6GfPLTe9RZPe','ACTIVE'),(2,2,'Labelator Account','labelator@email.id','082271111112','$2y$10$22cal1G9NRvAuJol4sinLuw18FFMiZKGL2HSFiE.RgDh1.h12Wz5u','ACTIVE'),(3,3,'Validator Account','validator@email.id','082271111113','$2y$10$QYN21E3wlfaMCPuxN2CtQO1Yb/yj2HOahASXSO6/dT.4pKyDOO4Zq','ACTIVE'),(4,4,'Inputor Account','inputor@email.id','082271111114','$2y$10$QYN21E3wlfaMCPuxN2CtQO1Yb/yj2HOahASXSO6/dT.4pKyDOO4Zq','ACTIVE');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-07 20:00:26
