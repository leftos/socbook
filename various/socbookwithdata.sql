-- MySQL dump 10.13 Distrib 5.5.8, for Win32 (x86)
--
-- Host: localhost Database: socbook
-- ------------------------------------------------------
-- Server version 5.5.8-log

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
-- Current Database: `socbook`
--

/*!40000 DROP DATABASE IF EXISTS `socbook`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `socbook` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `socbook`;

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookmarks` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `popularity` int(11) NOT NULL DEFAULT '1',
  `rating` int(11) DEFAULT NULL,
  `visits` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `reported` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks`
--

LOCK TABLES `bookmarks` WRITE;
/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;
INSERT INTO `bookmarks` VALUES (14,'www.facebook.com',2,1,0,'2011-08-08 16:45:42',1),(15,'www.github.com',1,0,0,'2011-09-04 09:39:12',0),(16,'www.twitter.com',1,0,0,'2011-09-04 09:39:40',0),(17,'www.arstechnica.com',1,0,0,'2011-09-04 09:56:33',0),(18,'www.autotriti.gr',1,0,0,'2011-09-04 09:57:14',0),(19,'www.sport24.gr',1,0,0,'2011-09-04 09:57:39',0),(20,'www.di.fm',1,0,0,'2011-09-04 09:58:29',0),(21,'www.ministryofsound.com',1,0,0,'2011-09-04 09:59:20',0),(22,'www.php.net',1,0,0,'2011-09-04 09:59:53',0),(23,'www.youtube.com',1,0,0,'2011-09-04 10:00:45',0),(24,'www.in.gr',1,0,0,'2011-09-04 10:01:19',0),(25,'stackoverflow.com',1,0,0,'2011-09-04 10:02:56',0),(26,'plus.google.com',1,0,0,'2011-09-04 10:03:45',0),(27,'news.google.gr',1,0,0,'2011-09-04 10:07:02',0),(28,'www.ceid.upatras.gr',1,0,0,'2011-09-04 10:08:29',0),(29,'www.upatras.gr',1,0,0,'2011-09-04 10:10:37',0);
/*!40000 ALTER TABLE `bookmarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booksncomms`
--

DROP TABLE IF EXISTS `booksncomms`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booksncomms` (
  `bid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`bid`,`cid`),
  KEY `cid` (`cid`),
  CONSTRAINT `booksncomms_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `bookmarks` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `booksncomms_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `comments` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booksncomms`
--

LOCK TABLES `booksncomms` WRITE;
/*!40000 ALTER TABLE `booksncomms` DISABLE KEYS */;
INSERT INTO `booksncomms` VALUES (14,28),(14,30),(15,31),(16,32),(17,33),(18,34),(19,35),(20,36),(21,37),(22,38),(23,39),(24,40),(25,41),(26,42),(27,43),(28,44),(29,45);
/*!40000 ALTER TABLE `booksncomms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booksntags`
--

DROP TABLE IF EXISTS `booksntags`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booksntags` (
  `bid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `popularity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`,`tid`),
  KEY `tid` (`tid`),
  CONSTRAINT `booksntags_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `bookmarks` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `booksntags_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `tagcloud` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booksntags`
--

LOCK TABLES `booksntags` WRITE;
/*!40000 ALTER TABLE `booksntags` DISABLE KEYS */;
INSERT INTO `booksntags` VALUES (14,54,2),(14,55,2),(14,56,1),(14,60,1),(15,61,1),(15,62,1),(15,63,1),(16,54,1),(16,55,1),(16,64,1),(16,65,1),(16,66,1),(17,67,1),(17,68,1),(17,69,1),(17,70,1),(17,71,1),(18,67,1),(18,72,1),(18,73,1),(18,74,1),(18,75,1),(18,76,1),(19,67,1),(19,77,1),(19,78,1),(19,79,1),(19,80,1),(19,81,1),(19,82,1),(19,83,1),(20,84,1),(20,85,1),(20,86,1),(20,87,1),(20,88,1),(20,89,1),(20,90,1),(21,86,1),(21,87,1),(21,88,1),(21,89,1),(21,90,1),(21,91,1),(21,92,1),(21,93,1),(21,94,1),(21,95,1),(21,96,1),(22,84,1),(22,97,1),(22,98,1),(22,99,1),(23,90,1),(23,100,1),(23,101,1),(23,102,1),(23,103,1),(24,67,1),(24,104,1),(24,105,1),(25,98,1),(25,99,1),(25,106,1),(25,107,1),(25,108,1),(25,109,1),(26,54,1),(26,110,1),(26,111,1),(26,112,1),(26,113,1),(26,114,1),(27,67,1),(27,104,1),(27,115,1),(28,116,1),(28,117,1),(28,118,1),(28,119,1),(28,120,1),(28,121,1),(28,122,1),(28,123,1),(28,124,1),(28,125,1),(29,121,1),(29,122,1),(29,123,1);
/*!40000 ALTER TABLE `booksntags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  `dateposted` datetime NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `user` (`user`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (28,'Facebook, the social network','Ένα δημοφιλές social network.',7,'2011-08-08 16:47:39',0),(30,'Facebook και τα μυαλά στα μπλέντερ','Μπλα μπλα',8,'2011-08-08 16:49:37',0),(31,'Github','Υπηρεσία source control',7,'2011-09-04 09:39:12',0),(32,'Twitter','Υπηρεσία κοινωνικής δικτύωσης με σύντομα μηνύματα',7,'2011-09-04 09:39:40',0),(33,'Ars Technica','Ιστοσελίδα ενημέρωσης για τεχνολογικά νέα',7,'2011-09-04 09:56:33',0),(34,'Auto Triti','Περιοδικό αυτοκινήτων',7,'2011-09-04 09:57:14',0),(35,'Sport 24','Αθλητικά νεά',7,'2011-09-04 09:57:39',0),(36,'Digitally Imported (di.fm)','Web Radio με ηλεκτρονική μουσική',7,'2011-09-04 09:58:29',0),(37,'Ministry of Sound','Ένα από τα μεγαλύτερα club στην Αγγλία, με events, albums, compilations, βίντεο, κλπ.',7,'2011-09-04 09:59:20',0),(38,'PHP','Γλώσσα προγραμματισμού για ιστοσελίδες',7,'2011-09-04 09:59:53',0),(39,'YouTube','Βίντεο από όλο τον κόσμο και on demand ενοικίαση ταινιών',7,'2011-09-04 10:00:45',0),(40,'In.gr','Νέα και ενημέρωση για την Ελλάδα και τον κόσμο',7,'2011-09-04 10:01:19',0),(41,'Stack Overflow','Ιστοσελίδα με ερωταπαντήσεις για θέματα προγραμματισμού και όχι μονο',7,'2011-09-04 10:02:56',0),(42,'Google+','Η νέα υπηρεσία κοινωνικής δικτύωσης της Google.',7,'2011-09-04 10:03:45',0),(43,'Google News Greece','News aggregator, με κύριο θέμα την Ελλάδα',7,'2011-09-04 10:07:02',0),(44,'Computer Engineering & Informatics Department','Η ιστοσελίδα της σχολής.',7,'2011-09-04 10:08:29',0),(45,'Πανεπιστήμιο Πατρών','Κεντρική σελίδα του πανεπιστημίου',7,'2011-09-04 10:10:37',0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commsntags`
--

DROP TABLE IF EXISTS `commsntags`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commsntags` (
  `cid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  PRIMARY KEY (`cid`,`tid`),
  KEY `tid` (`tid`),
  CONSTRAINT `commsntags_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `comments` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `commsntags_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `tagcloud` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commsntags`
--

LOCK TABLES `commsntags` WRITE;
/*!40000 ALTER TABLE `commsntags` DISABLE KEYS */;
INSERT INTO `commsntags` VALUES (28,54),(30,54),(32,54),(42,54),(28,55),(30,55),(32,55),(28,56),(30,60),(31,61),(31,62),(31,63),(32,64),(32,65),(32,66),(33,67),(34,67),(35,67),(40,67),(43,67),(33,68),(33,69),(33,70),(33,71),(34,72),(34,73),(34,74),(34,75),(34,76),(35,77),(35,78),(35,79),(35,80),(35,81),(35,82),(35,83),(36,84),(38,84),(36,85),(36,86),(37,86),(36,87),(37,87),(36,88),(37,88),(36,89),(37,89),(36,90),(37,90),(39,90),(37,91),(37,92),(37,93),(37,94),(37,95),(37,96),(38,97),(38,98),(41,98),(38,99),(41,99),(39,100),(39,101),(39,102),(39,103),(40,104),(43,104),(40,105),(41,106),(41,107),(41,108),(41,109),(42,110),(42,111),(42,112),(42,113),(42,114),(43,115),(44,116),(44,117),(44,118),(44,119),(44,120),(44,121),(45,121),(44,122),(45,122),(44,123),(45,123),(44,124),(44,125);
/*!40000 ALTER TABLE `commsntags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagcloud`
--

DROP TABLE IF EXISTS `tagcloud`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagcloud` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `popularity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagcloud`
--

LOCK TABLES `tagcloud` WRITE;
/*!40000 ALTER TABLE `tagcloud` DISABLE KEYS */;
INSERT INTO `tagcloud` VALUES (54,'social',4),(55,'network',3),(56,'facebook',1),(60,'dog',1),(61,'source',1),(62,'control',1),(63,'github',1),(64,'twitter',1),(65,'tweet',1),(66,'retweet',1),(67,'news',5),(68,'technology',1),(69,'windows',1),(70,'apple',1),(71,'gaming',1),(72,'car',1),(73,'cars',1),(74,'ads',1),(75,'used',1),(76,'new',1),(77,'sport',1),(78,'sports',1),(79,'football',1),(80,'basketball',1),(81,'ποδόσφαιρο',1),(82,'μπάσκετ',1),(83,'νέα',1),(84,'web',2),(85,'radio',1),(86,'trance',2),(87,'electronic',2),(88,'house',2),(89,'electro',2),(90,'music',3),(91,'ministry',1),(92,'sound',1),(93,'disco',1),(94,'annual',1),(95,'clubbers',1),(96,'guide',1),(97,'php',1),(98,'programming',2),(99,'development',2),(100,'video',1),(101,'youtube',1),(102,'videos',1),(103,'movies',1),(104,'greece',2),(105,'world',1),(106,'q&a',1),(107,'faq',1),(108,'questions',1),(109,'answers',1),(110,'google+',1),(111,'google',1),(112,'plus',1),(113,'circles',1),(114,'hangout',1),(115,'aggregator',1),(116,'computer',1),(117,'engineering',1),(118,'informatics',1),(119,'department',1),(120,'ceid',1),(121,'upatras',2),(122,'university',2),(123,'patras',2),(124,'μηχανικών',1),(125,'πληροφορικής',1);
/*!40000 ALTER TABLE `tagcloud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userrated`
--

DROP TABLE IF EXISTS `userrated`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userrated` (
  `bid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `rating` enum('-1','1') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`bid`,`uid`),
  KEY `uid` (`uid`),
  CONSTRAINT `userrated_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `bookmarks` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userrated_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userrated`
--

LOCK TABLES `userrated` WRITE;
/*!40000 ALTER TABLE `userrated` DISABLE KEYS */;
INSERT INTO `userrated` VALUES (14,7,'1');
/*!40000 ALTER TABLE `userrated` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userratedtitles`
--

DROP TABLE IF EXISTS `userratedtitles`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userratedtitles` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `rating` enum('-1','1') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cid`,`uid`),
  KEY `uid` (`uid`),
  CONSTRAINT `userratedtitles_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `comments` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userratedtitles_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userratedtitles`
--

LOCK TABLES `userratedtitles` WRITE;
/*!40000 ALTER TABLE `userratedtitles` DISABLE KEYS */;
/*!40000 ALTER TABLE `userratedtitles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `class` enum('user','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'leftos','fa44132b238e67958fb17d33a71d325221805079909c3a7f5bed1a03666cf834','leftos@gmail.com','admin'),(8,'marios','551916735aeecf1474109865fda11948173d76b1a705293de527130b8dc7271b','not@yourbusiness.com','user');
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

-- Dump completed on 2011-09-04 13:15:56