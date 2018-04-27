-- MySQL dump 10.16  Distrib 10.1.25-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: final
-- ------------------------------------------------------
-- Server version	10.1.25-MariaDB

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
-- Current Database: `final`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `final` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `final`;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignments` (
  `class_id` int(20) DEFAULT NULL,
  `assignment` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES (666,'Assignment1'),(666,'Assignment1'),(666,'Assignment2'),(666,'Assignment3'),(666,'Test'),(666,'Test2');
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `course_id` int(20) DEFAULT NULL,
  `teacher_id` int(20) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,5,'class1','its just a class'),(2,6,'class2','its just another class'),(337,NULL,'Web programming','where you program web sites'),(130,NULL,'class 130','it is class 131'),(252,NULL,'Computer Organization','stuff'),(2147483647,NULL,'class of wonder','makes you wonder?'),(666,16,'TeacherMan\'s class','TeacherMAN');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curclasses`
--

DROP TABLE IF EXISTS `curclasses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curclasses` (
  `teacher_id` int(20) DEFAULT NULL,
  `class_id` int(20) DEFAULT NULL,
  `student_id` int(20) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curclasses`
--

LOCK TABLES `curclasses` WRITE;
/*!40000 ALTER TABLE `curclasses` DISABLE KEYS */;
INSERT INTO `curclasses` VALUES (16,666,7);
/*!40000 ALTER TABLE `curclasses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curgrades`
--

DROP TABLE IF EXISTS `curgrades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curgrades` (
  `class_id` int(20) DEFAULT NULL,
  `student_id` int(20) DEFAULT NULL,
  `assignment` varchar(100) DEFAULT NULL,
  `points` int(20) DEFAULT NULL,
  `maxPoints` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curgrades`
--

LOCK TABLES `curgrades` WRITE;
/*!40000 ALTER TABLE `curgrades` DISABLE KEYS */;
INSERT INTO `curgrades` VALUES (666,NULL,'Assignment1',NULL,10),(666,NULL,'Assignment1',NULL,10),(666,NULL,'Assignment1',NULL,10),(666,NULL,'Assignment1',NULL,10),(666,NULL,'Assignment1',NULL,10),(666,NULL,'Assignment1',NULL,10),(666,NULL,'Assignment2',NULL,15),(666,NULL,'Assignment3',NULL,10),(666,NULL,'Test',NULL,1),(666,NULL,'Test2',NULL,2);
/*!40000 ALTER TABLE `curgrades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grades` (
  `course_id` int(20) DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL,
  `student_id` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grades`
--

LOCK TABLES `grades` WRITE;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;
INSERT INTO `grades` VALUES (7,'A',1),(1,'C',7),(666,'B',6),(666,'C',7),(666,'F',1),(666,'F',10),(666,'B',8);
/*!40000 ALTER TABLE `grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `permissions` int(10) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'oudvno','Jason','Hall',1,'User','$2y$10$xzbnE5Z6HkD0HdQTmko6w.UoHieDreCW1jLUs6d3GGFf43ODFA2Vu'),(8,'aosndpbi','sodjgbn','sojnok',1,'User2','$2y$10$mIsCC5wtw7QuE5hvCuz4NOvheixNRzRt/YLiX021OCNxtXp7H2vD6'),(9,'bjoaxnci','OUAdvn','IUbnidv',1,'User3','$2y$10$YRdVcW5SKrvJfAUAVz/6Z.e9spDmSnLRFNmnLl5ddutAvgAiGPVkq'),(10,'idnvjm','vdhuz k','dsv kj',1,'User4','$2y$10$vEPCpqtDyFx4U9OxezXK7e0LbZveU2Of38KCYb75yDJklLDSKPOgi'),(11,'VJNDALKM','AUOGDNM','AIDNVm',1,'User5','$2y$10$sRlBf0LQtHxUms7LCKonoexUNyW/9Dg4PXQ0qTb9MPyCQkh/l2l36'),(12,'*AIDN','AUSNO','SDINM',1,'User6','$2y$10$fmTg1qB5DU0dIzIHvUksPuCsbISKiB1PLWcolQHtxj/bBGRYbf3gK'),(13,'SDIVNCM','SDUNVO','SDINVOM',1,'User7','$2y$10$YzeZXxZGQuvyM/A55E6POum4aE0GJespI9iOx8QrNsYn5DMWGtcwG'),(14,'dosuvnlmk','Admin-Jason','Admin-Hall',3,'Admin','$2y$10$oKPFbpyi89nf1NUWKsFeT.pnq0Zy1HUMDg39/pef2CSQkU/dWsYc2'),(16,'aoinsm','Teacher','Man',2,'Teacher','$2y$10$qpAh7hoiojfGlg5DrC/wUONyyjuAAkX1xzxT3d30eqmx9vZm4aHhy'),(17,'aosnm','Name','OtherName',2,'Teacher2','$2y$10$7vOWIYqt3cRwD3W6VKWfiO2IrhbG6dHk93IqdgWV1RuljzBxZoVr.'),(18,'sbmd','UAHDnov','ibsdhvm',2,'Teacher3','$2y$10$.tDzbjm7l3./R5iVVKVvqOVpxK/6KK8R8jnheY5kbaW3n7pJe56pa'),(19,'dvuhbinok','isdbl','dsivnokm',1,'Teacher4','$2y$10$14rb22BG/7KW89q2kOH47OZnodSaZi4.ZdMgrkcr1/vUrMtAlS0Se');
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

-- Dump completed on 2018-04-27 14:30:28
