-- MySQL dump 10.13  Distrib 5.1.53, for Win64 (unknown)
--
-- Host: localhost    Database: socbook
-- ------------------------------------------------------
-- Server version	5.1.53-community-log

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
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks`
--

LOCK TABLES `bookmarks` WRITE;
/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;
INSERT INTO `bookmarks` VALUES (1,'www.di.fm',1,0,0,'2011-07-24 16:24:04',0),(2,'www.radioparea.gr',1,0,0,'2011-07-24 16:24:55',0),(3,'www.github.com',1,0,1,'2011-07-24 16:25:21',0);
/*!40000 ALTER TABLE `bookmarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booksncomms`
--

DROP TABLE IF EXISTS `booksncomms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
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
INSERT INTO `booksncomms` VALUES (1,1),(2,2),(3,3);
/*!40000 ALTER TABLE `booksncomms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booksntags`
--

DROP TABLE IF EXISTS `booksntags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booksntags` (
  `bid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
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
INSERT INTO `booksntags` VALUES (1,1),(2,1),(1,2),(2,2),(1,3),(1,4),(1,5),(1,6),(1,7),(2,8),(2,9),(3,10),(3,11),(3,12);
/*!40000 ALTER TABLE `booksntags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `user` int(11) NOT NULL,
  `dateposted` datetime NOT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `user` (`user`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'Digitally Imported (di.fm)','Web radio Î¼Îµ Î·Î»ÎµÎºÏ„ÏÎ¿Î½Î¹ÎºÎ® Î¼Î¿Ï…ÏƒÎ¹ÎºÎ®.',1,'2011-07-24 16:24:04',0),(2,'Radioparea.gr Web Radio','Î†Î»Î»Î¿ Î­Î½Î± web radio.',1,'2011-07-24 16:24:55',0),(3,'GitHub, source control','Î Î»Î±Ï„Ï†ÏŒÏÎ¼Î± ÎµÎ»Î­Î³Ï‡Î¿Ï… Ï€Î·Î³Î±Î¯Î¿Ï… ÎºÏŽÎ´Î¹ÎºÎ± ÎºÎ±Î¹ ÏƒÏ…Î½ÎµÏÎ³Î±ÏƒÎ¯Î±Ï‚',1,'2011-07-24 16:25:21',0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagcloud`
--

DROP TABLE IF EXISTS `tagcloud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagcloud` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `popularity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagcloud`
--

LOCK TABLES `tagcloud` WRITE;
/*!40000 ALTER TABLE `tagcloud` DISABLE KEYS */;
INSERT INTO `tagcloud` VALUES (1,'radio',2),(2,'music',2),(3,'streaming',1),(4,'electronic',1),(5,'trance',1),(6,'techno',1),(7,'house',1),(8,'mainsteam',1),(9,'web',1),(10,'source',1),(11,'control',1),(12,'github',1);
/*!40000 ALTER TABLE `tagcloud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `class` enum('user','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'leftos','fa44132b238e67958fb17d33a71d325221805079909c3a7f5bed1a03666cf834','leftos@gmail.com','admin'),(2,'loathK','5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8','temp@email.com','admin');
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

-- Dump completed on 2011-07-24 19:25:55
