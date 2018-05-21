-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: clients
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

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
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext,
  `second_name` tinytext,
  `patronymic` varchar(45) DEFAULT NULL,
  `born_date` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `change_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (8,'ÐÑ€Ñ‚ÐµÐ¼','Ð‘Ð¾Ð»ÑŒÑˆÐ°ÐºÐ¾Ð²','ÐœÐ¸Ñ‚Ñ€Ð¾Ñ„Ð°Ð½Ð¾Ð²Ð¸Ñ‡','2000-07-14',1,'2018-05-20 22:46:39','2018-05-20 22:46:39'),(9,'Ð’Ð¸ÑÑÐ°Ñ€Ð¸Ð¾Ð½','Ð“Ð¾Ñ€ÑˆÐºÐ¾Ð²','ÐÐ»ÐµÐºÑÐ°Ð½Ð´Ñ€Ð¾Ð²Ð¸Ñ‡','1999-04-10',1,'2018-05-20 22:47:20','2018-05-20 22:47:20'),(10,'Ð•Ð²Ð³ÐµÐ½Ð¸Ð¹','Ð•Ñ„Ð¸Ð¼Ð¾Ð²','Ð’Ð°Ð»ÐµÑ€ÑŒÑÐ½Ð¾Ð²Ð¸Ñ‡','1998-03-06',1,'2018-05-20 22:47:54','2018-05-20 22:47:54'),(11,'Ð¡Ð²ÐµÑ‚Ð»Ð°Ð½Ð°','Ð¡ÐµÑ€Ð³ÐµÐµÐ²Ð°','ÐÐ°ÑƒÐ¼Ð¾Ð²Ð½Ð°','1992-04-04',0,'2018-05-20 22:49:26','2018-05-20 22:49:26'),(12,'Ð’Ð°ÑÐ¸Ð»Ð¸Ð¹','Ð•Ñ„Ð¸Ð¼Ð¾Ð²','Ð¡ÐµÑ€Ð³ÐµÐµÐ²Ð¸Ñ','1990-03-02',1,'2018-05-20 23:06:36','2018-05-20 23:06:36');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients_phone`
--

DROP TABLE IF EXISTS `clients_phone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients_phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `id_phone_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `id_client_idx` (`id_client`),
  KEY `id_phone_number_idx` (`id_phone_number`),
  CONSTRAINT `id_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_phone_number` FOREIGN KEY (`id_phone_number`) REFERENCES `phone_number` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients_phone`
--

LOCK TABLES `clients_phone` WRITE;
/*!40000 ALTER TABLE `clients_phone` DISABLE KEYS */;
INSERT INTO `clients_phone` VALUES (11,8,7),(12,8,8),(13,9,9),(14,10,10),(15,11,11),(16,11,7),(17,12,12);
/*!40000 ALTER TABLE `clients_phone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone_number`
--

DROP TABLE IF EXISTS `phone_number`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone_number` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone_number`
--

LOCK TABLES `phone_number` WRITE;
/*!40000 ALTER TABLE `phone_number` DISABLE KEYS */;
INSERT INTO `phone_number` VALUES (7,'828(647)795358'),(8,'614(099)877599'),(9,'212(298)264418'),(10,'60(1487)159960'),(11,'8(131)149805'),(12,'827(7272)634556');
/*!40000 ALTER TABLE `phone_number` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-21  2:08:51
