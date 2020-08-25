-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: rdndevsbook
-- ------------------------------------------------------
-- Server version	5.7.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  FULLTEXT KEY `name_email_FULLTEXT` (`name`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','admin@admin.com','$2y$10$JxsGcZCAPf6pl8BvnppKtONxdVxkJW1pKjWzlr67oSBFS5/nD/oVm',NULL,'2020-08-14 18:42:31','2020-08-14 18:42:31');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2016_06_01_000001_create_oauth_auth_codes_table',1),(2,'2016_06_01_000002_create_oauth_access_tokens_table',1),(3,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(4,'2016_06_01_000004_create_oauth_clients_table',1),(5,'2016_06_01_000005_create_oauth_personal_access_clients_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('0d347d9733e863c61a67977d1f95ef03d354771b27e38c6d8aea74792ab67ed1ef2d1434d6fb62ec',10,2,NULL,'[]',0,'2020-08-24 18:55:48','2020-08-24 18:55:48','2020-08-24 23:55:48'),('26462d4dbca1518d7228fb0b5cd10e4b0b72e76d0d7f9f7fa1d5ce079ec053aafa5ba9c2fac103b5',4,2,NULL,'[]',0,'2020-08-24 18:01:08','2020-08-24 18:01:08','2020-08-24 23:01:08'),('957069fd3cd6e7414b244db1134a3c2b5e28117024f8400dedee3caec1d6de94ea2e8c519a42fb98',11,2,NULL,'[]',0,'2020-08-25 15:24:26','2020-08-25 15:24:26','2020-08-25 20:24:26'),('9d60a3725d160eda40f6e24b913bfeee02029ef8584045a0cc68731d10a3a406e474ee0c97582bc9',12,2,NULL,'[]',0,'2020-08-25 15:21:55','2020-08-25 15:21:55','2020-08-25 20:21:55'),('9f2825e6140fa6a41dc7a56589b0b2678da0944d8ec9bd7d9e2ac9938f8494dc71b51e4770648d4a',9,2,NULL,'[]',0,'2020-08-24 18:51:35','2020-08-24 18:51:35','2020-08-24 23:51:35'),('bb315d007086b89bea1d6de5316cb573737cb7c6e49a6111f5e4f8fe720362e3ab27baff0a9472a4',11,2,NULL,'[]',1,'2020-08-24 18:56:52','2020-08-24 18:56:52','2020-08-24 23:56:52'),('ec687df9089634ca33b19953d8afe65f34f8c1dc12c6d089905add79983454002d50bda08b15323e',13,2,NULL,'[]',0,'2020-08-25 15:23:52','2020-08-25 15:23:52','2020-08-25 20:23:52');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Lumen Personal Access Client','54pMQUYxjVqAgzpyC91dtODUnBZO8aUQdjGrJcGR',NULL,'http://localhost',1,0,0,'2020-08-24 16:03:15','2020-08-24 16:03:15'),(2,NULL,'Lumen Password Grant Client','aClECVmq39o6ToTutTPdfUleMRYWll6AIk2RvHG6','users','http://localhost',0,1,0,'2020-08-24 16:03:15','2020-08-24 16:03:15');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2020-08-24 16:03:15','2020-08-24 16:03:15');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
INSERT INTO `oauth_refresh_tokens` VALUES ('556262b5441cf797c26f4284d73020ddf904bbd18ca7083e0d4c365bbeb0e475fe6fec58b678ca2f','6f9949a3af473cfda8d79d8cc2ed202549284fd4e70b53cf387a16c256a4d7c042c23bf1f0d0aee9',0,'2021-08-24 16:48:06'),('594a64f38ba5baa45b57b8ba4c2f24d2932b3b6cbc1d8b38943c4283e0ddbb33d5cfe0e734b47fb9','9d60a3725d160eda40f6e24b913bfeee02029ef8584045a0cc68731d10a3a406e474ee0c97582bc9',0,'2021-08-25 15:21:55'),('5ee7d18b3b965ad022f50adab321477ed43673021f252edf1e34ec0a7efbc983b873bcb69adaa685','bb315d007086b89bea1d6de5316cb573737cb7c6e49a6111f5e4f8fe720362e3ab27baff0a9472a4',0,'2021-08-24 18:56:52'),('7baeb3b20579db66a1a5fc1c7d076a50deaec04320b0c152ba9dbac30af1b55dc296ce03cde03959','ec687df9089634ca33b19953d8afe65f34f8c1dc12c6d089905add79983454002d50bda08b15323e',0,'2021-08-25 15:23:52'),('7f3177c09ed0945ccff11d145d9bc57620e793c45d0aee1f00fc08350d1a76dde6b95d64c7f81b9f','26462d4dbca1518d7228fb0b5cd10e4b0b72e76d0d7f9f7fa1d5ce079ec053aafa5ba9c2fac103b5',0,'2021-08-24 18:01:08'),('86d0cfbd329c0ddcd1f876c55f067dd378f37b6448f33c639641f7c7c27504e481c0a55afb39ba6a','0d347d9733e863c61a67977d1f95ef03d354771b27e38c6d8aea74792ab67ed1ef2d1434d6fb62ec',0,'2021-08-24 18:55:48'),('981eb2d525cd5cecb20a58684fe352af7a7f352486a1baa7669f413aede9b67eab7634ed6db7b8ed','957069fd3cd6e7414b244db1134a3c2b5e28117024f8400dedee3caec1d6de94ea2e8c519a42fb98',0,'2021-08-25 15:24:26'),('9931e13784aebac1a1d5ad09aa8e1114ba1c5ecd94501f2ee1504d021bd260ab29fb6cdcfbfabd64','9f2825e6140fa6a41dc7a56589b0b2678da0944d8ec9bd7d9e2ac9938f8494dc71b51e4770648d4a',0,'2021-08-24 18:51:35');
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` enum('text','photo') DEFAULT NULL,
  `body` longtext,
  `likes_count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (6,2,'text','asdf',0,'2020-08-18 21:04:53','2020-08-18 21:04:53'),(13,1,'photo','12e840e545f027dc9b21897781789823.jpg',0,'2020-08-21 17:44:53','2020-08-21 17:44:53'),(14,11,'text','meu primeiro post',0,'2020-08-24 20:31:05','2020-08-24 20:31:05'),(15,11,'text','meu segundo post',0,'2020-08-24 20:34:19','2020-08-24 20:34:19'),(16,11,'text','terceiro post',0,'2020-08-24 20:41:47','2020-08-24 20:41:47'),(17,11,'text','quarto post',0,'2020-08-24 20:42:26','2020-08-25 15:28:08'),(18,11,'photo','b7c2b1544609b60b2d7748c01c2c06c0.jpeg',0,'2020-08-24 20:44:59','2020-08-24 20:44:59'),(19,11,'text','asdfasdf',0,'2020-08-24 20:45:30','2020-08-24 20:45:30'),(20,10,'text','algo do user 10',0,'2020-08-24 21:14:27','2020-08-24 21:14:27'),(21,10,'text','mais algo do user 10',0,'2020-08-25 16:18:21','2020-08-25 16:18:21');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_comments`
--

DROP TABLE IF EXISTS `posts_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_comments`
--

LOCK TABLES `posts_comments` WRITE;
/*!40000 ALTER TABLE `posts_comments` DISABLE KEYS */;
INSERT INTO `posts_comments` VALUES (1,19,10,'muito bom','2020-08-25 15:45:37','2020-08-25 15:45:37'),(2,19,9,'muito legal','2020-08-25 15:48:16','2020-08-25 15:48:16'),(3,20,11,'legal','2020-08-25 16:17:05','2020-08-25 16:17:05'),(4,20,11,'muito bom','2020-08-25 17:13:58','2020-08-25 17:13:58'),(5,20,11,'muito bom','2020-08-25 17:14:02','2020-08-25 17:14:02'),(6,20,11,'muito bom','2020-08-25 17:14:03','2020-08-25 17:14:03');
/*!40000 ALTER TABLE `posts_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_likes`
--

DROP TABLE IF EXISTS `posts_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_likes`
--

LOCK TABLES `posts_likes` WRITE;
/*!40000 ALTER TABLE `posts_likes` DISABLE KEYS */;
INSERT INTO `posts_likes` VALUES (1,10,19,'2020-08-25 15:33:41','2020-08-25 15:33:41'),(2,9,19,'2020-08-25 15:39:57','2020-08-25 15:39:57'),(8,11,20,'2020-08-25 17:12:18','2020-08-25 17:12:18');
/*!40000 ALTER TABLE `posts_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `work` varchar(150) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  FULLTEXT KEY `name_email_FULLTEXT` (`name`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Rodinei','rodinei@teste.com','$2y$10$xckNMkEIsVUtMf.u2mi95uPSvorfU/s4XF86LcSWQD.FoLiUD16jy',NULL,'1983-06-21','São Paulo - SP','Programador Fullstack','68317f500b7bee6fc1f2f0f75b813693.jpg','a126896b640ca5a62a58a01ea775d536.jpg','2020-08-14 18:42:31','2020-08-24 16:33:03'),(2,'outro fulano','fulano@teste.com','$2y$10$xckNMkEIsVUtMf.u2mi95uPSvorfU/s4XF86LcSWQD.FoLiUD16jy',NULL,'1999-01-01',NULL,NULL,'avatar.jpg',NULL,'2020-08-17 19:20:28','2020-08-17 19:20:59'),(3,'teste','teste@teste.com','$2y$10$.i9pfa.xLAX2yLq/f.d2tugvJI0cmCb03GEK4wDEzG8RvJCXOao6m',NULL,'1989-09-14',NULL,NULL,NULL,NULL,'2020-08-18 14:36:44',NULL),(4,'rodineiapi','rodineiapi@teste.com','$2y$10$qCPypZe38r/03DLCIMLcFORUP2S7pQxX07haoL2eOjuFRzQ8iwfwG',NULL,'1983-06-21',NULL,NULL,NULL,NULL,'2020-08-24 16:47:54','2020-08-24 16:47:54'),(5,'rodineiapi','rodineiapi2@teste.com','$2y$10$/T7O/4sfnsmm/lCPY8jjCeOPB7j4xNVVaSQHWwpnz/KelQXDShOxC',NULL,'1983-06-21',NULL,NULL,NULL,NULL,'2020-08-24 18:42:39','2020-08-24 18:42:39'),(6,'rodineiap3','rodineiapi3@teste.com','$2y$10$5C0LeDdQpU/HTjkGETY8weWJrh/1.hxeebTqg7dzRrVn6FfeLSDD6',NULL,'1983-06-21',NULL,NULL,NULL,NULL,'2020-08-24 18:47:03','2020-08-24 18:47:03'),(7,'rodineiap4','rodineiapi4@teste.com','$2y$10$RgllR5vixyuT5locw0pwrub6ZpLM2Dt.59nO9VTOiCUHp2FSxSKhe',NULL,'1983-06-21',NULL,NULL,NULL,NULL,'2020-08-24 18:47:23','2020-08-24 18:47:23'),(8,'rodineiap5','rodineiapi5@teste.com','$2y$10$eNBQtdQ7HVwq0bpR7pXgCuQgLW4Kc37IevTyl.xVHFz82lBL5V97C',NULL,'1983-06-21',NULL,NULL,NULL,NULL,'2020-08-24 18:49:22','2020-08-24 18:49:22'),(9,'rodineiap6','rodineiapi6@teste.com','$2y$10$jlLcQ4SxIwSDOkjFlLq4jOd.hSPktKPN6MHFU8G4WyGstX/CKQV9G',NULL,'1983-06-21',NULL,NULL,NULL,NULL,'2020-08-24 18:51:34','2020-08-24 18:51:34'),(10,'rodineiap7','rodineiapi7@teste.com','$2y$10$xWguRTeI8eNJu7NTBYCk4.yRFc8ODVEScK6l2HMZtUQAYCURQBBae',NULL,'1983-06-21',NULL,NULL,NULL,NULL,'2020-08-24 18:55:48','2020-08-24 18:55:48'),(11,'rodinei 8 teste','rodineiap8@teste.com','$2y$10$OaOfeJEFkk7t0M54tkpclu/AmE2FaB4u6vx/q2qWFtba8UrDwLd6S',NULL,'1983-06-21','sp','dev','87a03f802dd65147070ba9d7e127d5da.jpeg','4681d82ed7d26840083159bdbf97b66d.jpeg','2020-08-24 18:56:52','2020-08-24 20:18:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_following`
--

DROP TABLE IF EXISTS `users_following`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_following` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_from` int(11) NOT NULL,
  `user_id_to` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_following`
--

LOCK TABLES `users_following` WRITE;
/*!40000 ALTER TABLE `users_following` DISABLE KEYS */;
INSERT INTO `users_following` VALUES (5,2,1,'2020-08-18 14:54:52','2020-08-18 14:54:52',0),(6,1,2,'2020-08-18 15:16:36','2020-08-18 15:16:36',0),(7,1,3,'2020-08-18 15:17:01','2020-08-18 15:17:01',0),(8,11,10,'2020-08-24 20:57:29','2020-08-24 20:57:29',0),(9,11,9,'2020-08-24 20:57:29','2020-08-24 20:57:29',0),(10,9,11,'2020-08-24 21:07:05','2020-08-24 21:07:05',0),(11,10,11,'2020-08-25 16:17:41','2020-08-25 16:17:41',0),(12,1,11,'2020-08-25 18:50:49','2020-08-25 18:50:49',0),(14,11,8,'2020-08-25 19:19:28','2020-08-25 19:19:28',0);
/*!40000 ALTER TABLE `users_following` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-25 16:43:21
