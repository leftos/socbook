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
-- Current Database: `socbook`
--

/*!40000 DROP DATABASE IF EXISTS `socbook`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `socbook` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `socbook`;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks`
--

LOCK TABLES `bookmarks` WRITE;
/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;
INSERT INTO `bookmarks` VALUES (14,'www.facebook.com',2,0,0,'2011-08-08 16:45:42',0);
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
INSERT INTO `booksncomms` VALUES (14,28),(14,30);
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
INSERT INTO `booksntags` VALUES (14,54,2),(14,55,2),(14,56,1),(14,60,1);
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
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  `dateposted` datetime NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `user` (`user`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (28,'Facebook, the social network','Ένα δημοφιλές social network.',7,'2011-08-08 16:47:39',0),(30,'Facebook και τα μυαλά στα μπλέντερ','Μπλα μπλα',8,'2011-08-08 16:49:37',0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commsntags`
--

DROP TABLE IF EXISTS `commsntags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
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
INSERT INTO `commsntags` VALUES (28,54),(30,54),(28,55),(30,55),(28,56),(30,60);
/*!40000 ALTER TABLE `commsntags` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagcloud`
--

LOCK TABLES `tagcloud` WRITE;
/*!40000 ALTER TABLE `tagcloud` DISABLE KEYS */;
INSERT INTO `tagcloud` VALUES (54,'social',2),(55,'network',2),(56,'facebook',1),(60,'dog',1);
/*!40000 ALTER TABLE `tagcloud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userrated`
--

DROP TABLE IF EXISTS `userrated`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
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
/*!40000 ALTER TABLE `userrated` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userratedtitles`
--

DROP TABLE IF EXISTS `userratedtitles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
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
INSERT INTO `users` VALUES (7,'leftos','fa44132b238e67958fb17d33a71d325221805079909c3a7f5bed1a03666cf834','leftos@gmail.com','user'),(8,'marios','551916735aeecf1474109865fda11948173d76b1a705293de527130b8dc7271b','not@yourbusiness.com','user');
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

-- Dump completed on 2011-08-08 20:40:30
