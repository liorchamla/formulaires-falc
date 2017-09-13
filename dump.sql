-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: formulaires
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

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
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `content` text NOT NULL,
  `formulaire_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,'2017-03-25 18:25:02','{\"1\":\"Oui\",\"2\":\"Pour ma sant\\u00e9\",\"3\":\"Logistique  montage\",\"4\":\"Je ne sais pas\",\"5\":\"Non\",\"6\":\"Non\",\"7\":\"Je ne sais pas\"}',1),(5,'2017-03-26 03:29:08','{\"1\":\"Je ne sais pas\",\"2\":\"Pour ma sant\\u00e9\",\"3\":\"Logistique  pr\\u00e9paration de commande\",\"4\":\"Non\",\"5\":\"Je ne sais pas\",\"6\":\"Je ne sais pas\",\"7\":\"Non\"}',1),(6,'2017-03-26 04:12:38','{\"1\":\"Oui\",\"2\":\"Pour ma sant\\u00e9\",\"3\":\"Logistique  pr\\u00e9paration de commande\",\"4\":\"Non\",\"5\":\"Oui\",\"6\":\"Non\",\"7\":\"Oui\"}',1),(7,'2017-03-27 08:20:51','{\"1\":\"Non\",\"2\":\"Pour ma sant\\u00e9\",\"3\":\"Logistique  montage\",\"4\":\"Je ne sais pas\",\"5\":\"Je ne sais pas\",\"6\":\"Non\",\"7\":\"Non\"}',1),(8,'2017-03-27 09:22:53','{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"Oui\",\"6\":\"Non\",\"7\":\"Oui\"}',1);
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `slug` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` VALUES (1,'EPE 2017','epe-2017');
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` text NOT NULL,
  `type` text NOT NULL,
  `custom` text NOT NULL,
  `color` text NOT NULL,
  `image` text NOT NULL,
  `form_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'Je suis bien dans mon atelier','duo','','primary','',1),(2,'Je veux faire des soutiens','custom','[{\"value\":\"Pour le travail\",\"heading\":\"Pour le travail\",\"title\":{\"type\":\"img\",\"src\":[\"img\\/travail-2.jpg\"]}},{\"value\":\"Pour ma sant\\u00e9\",\"heading\":\"Pour ma sant\\u00e9\",\"title\":{\"type\":\"img\",\"src\":[\"img\\/sante-2.png\"]}},{\"value\":\"Pour mon quotidien\",\"heading\":\"Pour mon quotidien\",\"title\":{\"type\":\"img\",\"src\":[\"img\\/quotidien.png\"]}}]','success','',1),(3,'J\'aimerais être dans cet atelier','custom','[{\"value\":\"Pr\\u00e9paration de commande\",\"heading\":\"Logistique <br> pr\\u00e9paration de commande\",\"title\":{\"type\":\"img\",\"src\":[\"img\\/logistique-preparation.png\",\"img\\/quotidien.png\"]}},{\"value\":\"Montage\",\"heading\":\"Logistique <br> montage\",\"title\":{\"type\":\"img\",\"src\":[\"img\\/logistique-montage.png\"]}}]','primary','[\"img\\/choix.png\"]',1),(4,'C\'était bien cette année dans l\'atelier ?','duo','','success','',1),(5,'Quand je ne sais pas faire, je demande de l\'aide','duo','','primary','[\"img\\/aide.png\",\"img\\/quotidien.png\"]',1),(6,'Je suis content de l\'aide du moniteur ?','duo','','info','[\"img\\/aide.png\"]',1),(7,'Je comprend mon travail','duo','','primary','[\"img\\/travail-2.jpg\"]',1);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-02 15:51:41
