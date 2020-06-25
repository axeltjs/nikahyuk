-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: nikahyuk
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-1:10.3.22+maria~xenial-log

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
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placeholder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banners_promotion_id_foreign` (`promotion_id`),
  CONSTRAINT `banners_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'15930724973jpg.jpg','Mau nikah ga pake ribet!','Cukup registrasi dan isi surveinya dan kamu akan mendapatkan penawaran menarik dari Nikahyuk.online','banner',NULL,'2020-06-25 08:08:17','2020-06-25 08:08:17'),(2,'15930725981jpg.jpg','Cicilan pernikahan dengan bunga <span>0%</span>','Kamu juga bisa ambil paket nikah dengan cicilan bunga 0%. Daftar sekarang!','banner',NULL,'2020-06-25 08:09:58','2020-06-25 08:11:03');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_vendor_id_foreign` (`vendor_id`),
  KEY `chat_customer_id_foreign` (`customer_id`),
  CONSTRAINT `chat_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  CONSTRAINT `chat_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1,2,8,'2020-06-25 12:09:04','2020-06-25 12:09:04'),(2,2,6,'2020-06-25 12:26:54','2020-06-25 12:26:54'),(3,2,9,'2020-06-25 12:36:56','2020-06-25 12:36:56');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_message`
--

DROP TABLE IF EXISTS `chat_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_message` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `chat_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_message_chat_id_foreign` (`chat_id`),
  KEY `chat_message_user_id_foreign` (`user_id`),
  CONSTRAINT `chat_message_chat_id_foreign` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`),
  CONSTRAINT `chat_message_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_message`
--

LOCK TABLES `chat_message` WRITE;
/*!40000 ALTER TABLE `chat_message` DISABLE KEYS */;
INSERT INTO `chat_message` VALUES (1,1,2,'Hai Rohit Vaswani, kami memiliki penawaran yang cocok buat kamu! <br> kamu bisa cek link dibawah ini ya. <br><br> <a target=\"__blank\" href=\"https://nikahyuk.online/customer/quotation/1\">Paket Pernikahan Sederhana</a>','2020-06-25 12:09:04','2020-06-25 12:09:04'),(2,1,8,'Bisa kurang ga mas?','2020-06-25 12:10:03','2020-06-25 12:10:03'),(3,1,2,'Oke bro tawar','2020-06-25 12:10:16','2020-06-25 12:10:16'),(4,1,8,'16 Juta boleh? dekorasinya dikurangin deh jangan pake vas bunga','2020-06-25 12:10:46','2020-06-25 12:10:46'),(5,1,2,'oke','2020-06-25 12:10:51','2020-06-25 12:10:51'),(6,2,2,'Hai Muzib, kami memiliki penawaran yang cocok buat kamu! <br> kamu bisa cek link dibawah ini ya. <br><br> <a target=\"__blank\" href=\"https://nikahyuk.online/customer/quotation/2\">Paket Pernikahan Istimewa</a>','2020-06-25 12:26:54','2020-06-25 12:26:54'),(7,2,6,'Mantab, gaskeun','2020-06-25 12:27:13','2020-06-25 12:27:13'),(8,3,2,'Hai Nadine Putri, kami memiliki penawaran yang cocok buat kamu! <br> kamu bisa cek link dibawah ini ya. <br><br> <a target=\"__blank\" href=\"https://nikahyuk.online/customer/quotation/3\">Paket Pernikahan Romantis</a>','2020-06-25 12:36:56','2020-06-25 12:36:56'),(9,3,9,'Kurang dikit ya mbak, jadi 32jt gimana?','2020-06-25 12:37:46','2020-06-25 12:37:46'),(10,3,2,'oke','2020-06-25 12:37:57','2020-06-25 12:37:57');
/*!40000 ALTER TABLE `chat_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_permit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `budget_min` double NOT NULL DEFAULT 0,
  `budget_max` double NOT NULL DEFAULT 0,
  `approved` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reject_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companies_user_id_foreign` (`user_id`),
  CONSTRAINT `companies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,2,'Ex Project','Jl. Adam Malik','1593086209ktpjpeg.jpeg','1593086209siup1jpg.jpg','1593086209kantor1jpg.jpg',20000000,180000000,1,'2020-06-25 11:56:49','2020-06-25 12:03:43','-','1593086209npwp1jpg.jpg');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_item`
--

DROP TABLE IF EXISTS `event_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_item` (
  `model_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_item`
--

LOCK TABLES `event_item` WRITE;
/*!40000 ALTER TABLE `event_item` DISABLE KEYS */;
INSERT INTO `event_item` VALUES (1,'Gaun Pengantin','App\\Models\\Survey','2020-06-25 12:08:14','2020-06-25 12:08:14'),(1,'Seragam kedua orang tua','App\\Models\\Survey','2020-06-25 12:08:14','2020-06-25 12:08:14'),(1,'Make up','App\\Models\\Survey','2020-06-25 12:08:14','2020-06-25 12:08:14'),(1,'Gedung','App\\Models\\Survey','2020-06-25 12:08:14','2020-06-25 12:08:14'),(1,'Dekorasi','App\\Models\\Survey','2020-06-25 12:08:14','2020-06-25 12:08:14'),(1,'Katering','App\\Models\\Survey','2020-06-25 12:08:14','2020-06-25 12:08:14'),(2,'Make up','App\\Models\\Survey','2020-06-25 12:25:28','2020-06-25 12:25:28'),(2,'Gedung','App\\Models\\Survey','2020-06-25 12:25:28','2020-06-25 12:25:28'),(2,'Dekorasi','App\\Models\\Survey','2020-06-25 12:25:28','2020-06-25 12:25:28'),(3,'Mahar','App\\Models\\Survey','2020-06-25 12:36:22','2020-06-25 12:36:22'),(3,'Gaun Pengantin','App\\Models\\Survey','2020-06-25 12:36:22','2020-06-25 12:36:22'),(3,'Seragam kedua orang tua','App\\Models\\Survey','2020-06-25 12:36:22','2020-06-25 12:36:22'),(3,'Make up','App\\Models\\Survey','2020-06-25 12:36:22','2020-06-25 12:36:22'),(3,'Gedung','App\\Models\\Survey','2020-06-25 12:36:22','2020-06-25 12:36:22'),(3,'Dekorasi','App\\Models\\Survey','2020-06-25 12:36:22','2020-06-25 12:36:22'),(3,'Katering','App\\Models\\Survey','2020-06-25 12:36:22','2020-06-25 12:36:22');
/*!40000 ALTER TABLE `event_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` bigint(20) unsigned NOT NULL,
  `amount` double NOT NULL,
  `status` tinyint(4) NOT NULL,
  `bukti_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_transaction_id_foreign` (`transaction_id`),
  CONSTRAINT `invoices_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,'INV-25072020121140/0802/1/1',1,5333333.3333333,1,'1593087169gopayjpg.jpg',NULL,'2020-06-25 12:13:38','2020-07-25'),(2,'INV-25082020121140/0802/1/2',1,5333333.3333333,0,NULL,NULL,NULL,'2020-08-25'),(3,'INV-25092020121140/0802/1/3',1,5333333.3333333,0,NULL,NULL,NULL,'2020-09-25'),(4,'INV-25062020123041/0602/2/3',2,45000000,0,NULL,'2020-06-25 12:30:41','2020-06-25 12:30:41',NULL);
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_04_23_022114_create_permission_tables',1),(5,'2020_04_25_002057_create_surveys_table',1),(6,'2020_04_25_002220_event_item',1),(7,'2020_05_10_000822_add_location_name',1),(8,'2020_05_10_020354_add_city_idand_province_from_surveys',1),(9,'2020_05_11_020105_remove__active_field_from_event_item',1),(10,'2020_05_11_021054_add_invitation_qty_from_surveys',1),(11,'2020_05_16_000507_create_companies_table',1),(12,'2020_05_16_033225_create_vendor_setups_table',1),(13,'2020_05_16_042359_create_quotations_table',1),(14,'2020_05_16_060517_create_selected_vendors_table',1),(15,'2020_05_16_202032_add_approved_on_companies_table',1),(16,'2020_05_17_021206_add_nullable_on_business_permin_to_companies_table',1),(17,'2020_05_17_021846_add_price_range_on_companies_table',1),(18,'2020_05_17_035045_change_typo_in_companies_table',1),(19,'2020_05_29_172634_create_notifications_table',1),(20,'2020_06_02_134834_create_chat_table',1),(21,'2020_06_02_135951_create_chat_message_table',1),(22,'2020_06_11_055846_add_reject_reason_from_companies',1),(23,'2020_06_11_170518_create_transactions_table',1),(24,'2020_06_11_171354_create_invoices_table',1),(25,'2020_06_13_103239_add_quotation_id_from_transactions',1),(26,'2020_06_13_125105_add_jatuh_tempo_from_invoices',1),(27,'2020_06_13_160632_add_number_from_invoices',1),(28,'2020_06_13_234059_add_address_field_from_users',1),(29,'2020_06_14_002551_add_bukti_bayar_field_from_invoices',1),(30,'2020_06_14_080523_create_promotions_table',1),(31,'2020_06_14_080606_create_banners_table',1),(32,'2020_06_14_080747_create_ratings_table',1),(33,'2020_06_15_065046_add_approved_from_promotions',1),(34,'2020_06_21_023417_add_photo_from_users',2),(35,'2020_06_23_004744_add_timestamp_on_event_item',2),(36,'2020_06_24_043554_add_ktp_from_users',2),(37,'2020_06_24_044440_add_npwp_from_companies',2),(38,'2020_06_24_045555_change_reject_reason_to_nullable_from_companies',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',6),(2,'App\\Models\\User',7),(2,'App\\Models\\User',8),(2,'App\\Models\\User',9),(3,'App\\Models\\User',2),(3,'App\\Models\\User',3),(3,'App\\Models\\User',4),(3,'App\\Models\\User',5);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('021947d6-03b7-4d39-9924-daf46ec2137d','App\\Notifications\\OfferNotification','App\\Models\\User',2,'{\"type\":\"penawaran\",\"message\":\"Customer atas nama Muzib sedang mencari vendor, segera tawarkan penawaran terbaikmu!\",\"user_id\":6,\"user_name\":\"Muzib\",\"from\":\"customer\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/vendor\\/quotation\",\"survey\":\"https:\\/\\/nikahyuk.online\\/customer\\/survey\\/2\"}',NULL,'-',NULL,'2020-06-25 12:25:28','2020-06-25 12:25:28'),('02d1e3ee-1e6a-4915-97b2-6c433031ba52','App\\Notifications\\CreateTransactionNotication','App\\Models\\User',6,'{\"type\":\"transaction_notif\",\"message\":\"Transaksi Anda telah di Disetujui! dengan nomor transaksi: NY-25062020122722\\/0602\\/1\",\"vendor_id\":2,\"customer_id\":6,\"user_name\":\"Ex Project\",\"transaction_id\":2,\"transaction_number\":\"NY-25062020122722\\/0602\\/1\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/transaction\\/2\"}',NULL,'-',NULL,'2020-06-25 12:30:41','2020-06-25 12:30:41'),('0564c6c8-0bdf-4f88-a44a-469298ffcd4d','App\\Notifications\\ChatNotification','App\\Models\\User',8,'{\"type\":\"chat\",\"message\":\"Pesan Baru Belum Dibaca Dari Adel Anggraini\",\"from_user_id\":2,\"from_user_name\":\"Adel Anggraini\",\"photo_profile\":\"https:\\/\\/nikahyuk.online\\/admin\\/images\\/user.png\",\"to_user_id\":8,\"to_user_name\":\"Rohit Vaswani\"}',NULL,'-',NULL,'2020-06-25 12:10:16','2020-06-25 12:10:16'),('09b14ec8-5fe8-4bdb-8eac-d941d4a44781','App\\Notifications\\ChatNotification','App\\Models\\User',9,'{\"type\":\"chat\",\"message\":\"Pesan Baru Belum Dibaca Dari Adel Anggraini\",\"from_user_id\":2,\"from_user_name\":\"Adel Anggraini\",\"photo_profile\":\"https:\\/\\/nikahyuk.online\\/storage\\/user\\/1593088437profile2jpg.jpg\",\"to_user_id\":9,\"to_user_name\":\"Nadine Putri\"}',NULL,'-',NULL,'2020-06-25 12:37:57','2020-06-25 12:37:57'),('0d10b1a0-ea9c-4c8d-ae6f-4f5629a7330e','App\\Notifications\\PaymentConfirmNotification','App\\Models\\User',8,'{\"type\":\"payment_confirm\",\"message\":\"Pembayaran INV-25072020121140\\/0802\\/1\\/1 telah <b>diterima<\\/b> oleh Admin\",\"vendor_id\":1,\"customer_id\":8,\"user_name\":\"Rohit Vaswani\",\"invoice_id\":1,\"invoice_number\":\"INV-25072020121140\\/0802\\/1\\/1\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/invoice\\/1\"}',NULL,'-',NULL,'2020-06-25 12:13:38','2020-06-25 12:13:38'),('17e8b012-d824-402f-9917-91aaf3e723a2','App\\Notifications\\CreateTransactionNotication','App\\Models\\User',6,'{\"type\":\"transaction_notif\",\"message\":\"Transaksi Anda telah dibuat! dengan nomor transaksi: NY-25062020122722\\/0602\\/1\",\"vendor_id\":\"2\",\"customer_id\":6,\"user_name\":\"Ex Project\",\"transaction_id\":2,\"transaction_number\":\"NY-25062020122722\\/0602\\/1\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/transaction\\/2\"}',NULL,'-',NULL,'2020-06-25 12:27:22','2020-06-25 12:27:22'),('3bfe49a9-10b1-46dc-b629-9a8717f97833','App\\Notifications\\CreateTransactionNotication','App\\Models\\User',8,'{\"type\":\"transaction_notif\",\"message\":\"Transaksi Anda telah di Disetujui! dengan nomor transaksi: NY-25062020121113\\/0802\\/0\",\"vendor_id\":2,\"customer_id\":8,\"user_name\":\"Ex Project\",\"transaction_id\":1,\"transaction_number\":\"NY-25062020121113\\/0802\\/0\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/transaction\\/1\"}',NULL,'-',NULL,'2020-06-25 12:11:40','2020-06-25 12:11:40'),('3c91a890-278f-43de-9ab1-ea45952d5989','App\\Notifications\\CreateTransactionNotication','App\\Models\\User',9,'{\"type\":\"transaction_notif\",\"message\":\"Transaksi Anda telah dibuat! dengan nomor transaksi: NY-25062020123812\\/0902\\/2\",\"vendor_id\":\"2\",\"customer_id\":9,\"user_name\":\"Ex Project\",\"transaction_id\":3,\"transaction_number\":\"NY-25062020123812\\/0902\\/2\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/transaction\\/3\"}',NULL,'-',NULL,'2020-06-25 12:38:12','2020-06-25 12:38:12'),('4b77e891-91be-4c94-baea-8fba339a982f','App\\Notifications\\ChatNotification','App\\Models\\User',8,'{\"type\":\"chat\",\"message\":\"Pesan Baru Belum Dibaca Dari Adel Anggraini\",\"from_user_id\":2,\"from_user_name\":\"Adel Anggraini\",\"photo_profile\":\"https:\\/\\/nikahyuk.online\\/admin\\/images\\/user.png\",\"to_user_id\":8,\"to_user_name\":\"Rohit Vaswani\"}',NULL,'-',NULL,'2020-06-25 12:10:51','2020-06-25 12:10:51'),('4ec25592-332f-428d-8ef1-7f80d726f6b8','App\\Notifications\\OfferNotification','App\\Models\\User',2,'{\"type\":\"penawaran\",\"message\":\"Customer atas nama Rohit Vaswani sedang mencari vendor, segera tawarkan penawaran terbaikmu!\",\"user_id\":8,\"user_name\":\"Rohit Vaswani\",\"from\":\"customer\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/vendor\\/quotation\",\"survey\":\"https:\\/\\/nikahyuk.online\\/customer\\/survey\\/1\"}',NULL,'-',NULL,'2020-06-25 12:08:14','2020-06-25 12:08:14'),('4feb2afe-ae2c-4296-9836-aa14fadcf37e','App\\Notifications\\OfferCompleteNotification','App\\Models\\User',9,'{\"message\":\"Vendor Ex Project telah memberikan penawaran ke kamu. cek sekarang juga!\",\"user_id\":2,\"user_name\":\"Adel Anggraini\",\"quotation_id\":3,\"quotation_package_name\":\"Paket Pernikahan Romantis\",\"from\":\"vendor\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/customer\\/chat\"}',NULL,'-',NULL,'2020-06-25 12:36:56','2020-06-25 12:36:56'),('7235d0df-1db9-4bcc-a5f7-57ea64975fcb','App\\Notifications\\ChatNotification','App\\Models\\User',2,'{\"type\":\"chat\",\"message\":\"Pesan Baru Belum Dibaca Dari Rohit Vaswani\",\"from_user_id\":8,\"from_user_name\":\"Rohit Vaswani\",\"photo_profile\":\"https:\\/\\/nikahyuk.online\\/admin\\/images\\/user.png\",\"to_user_id\":2,\"to_user_name\":\"Adel Anggraini\"}',NULL,'-',NULL,'2020-06-25 12:10:03','2020-06-25 12:10:03'),('8d48ed5c-04a7-48b4-b416-46f8ad113455','App\\Notifications\\PromotionVendorNotif','App\\Models\\User',1,'{\"type\":\"promotion\",\"message\":\"Ada Artikel Promosi yang memerluka persetujuan Anda. klik untuk melihat\",\"user_name\":\"Notifikasi Promosi\",\"vendor_id\":2,\"customer_id\":1,\"promotion_id\":2,\"next_route\":\"https:\\/\\/nikahyuk.online\\/admin\\/promotion?id=2\"}',NULL,'-',NULL,'2020-06-25 11:59:59','2020-06-25 11:59:59'),('98475cf5-e616-45dc-99b7-30741b28ca17','App\\Notifications\\PaymentConfirmNotification','App\\Models\\User',1,'{\"type\":\"payment_confirm\",\"message\":\"Ada pembayaran yang harus dikonfirmasi. Pembayaran no. INV-25072020121140\\/0802\\/1\\/1\",\"vendor_id\":8,\"customer_id\":1,\"user_name\":\"Rohit Vaswani\",\"invoice_id\":1,\"invoice_number\":\"INV-25072020121140\\/0802\\/1\\/1\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/admin\\/payment\\/validation?id=1\"}',NULL,'-',NULL,'2020-06-25 12:12:50','2020-06-25 12:12:50'),('9ecfdad3-78ce-47a2-a355-4150b977f7fe','App\\Notifications\\OfferCompleteNotification','App\\Models\\User',6,'{\"message\":\"Vendor Ex Project telah memberikan penawaran ke kamu. cek sekarang juga!\",\"user_id\":2,\"user_name\":\"Adel Anggraini\",\"quotation_id\":2,\"quotation_package_name\":\"Paket Pernikahan Istimewa\",\"from\":\"vendor\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/customer\\/chat\"}',NULL,'-',NULL,'2020-06-25 12:26:54','2020-06-25 12:26:54'),('a97ae6fe-b587-4ab8-a0c6-bcd430690fba','App\\Notifications\\OfferNotification','App\\Models\\User',2,'{\"type\":\"penawaran\",\"message\":\"Customer atas nama Nadine Putri sedang mencari vendor, segera tawarkan penawaran terbaikmu!\",\"user_id\":9,\"user_name\":\"Nadine Putri\",\"from\":\"customer\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/vendor\\/quotation\",\"survey\":\"https:\\/\\/nikahyuk.online\\/customer\\/survey\\/3\"}',NULL,'-',NULL,'2020-06-25 12:36:22','2020-06-25 12:36:22'),('b3f8ab68-8117-4f7c-8216-bc681d3150f9','App\\Notifications\\PromotionVendorNotif','App\\Models\\User',1,'{\"type\":\"promotion\",\"message\":\"Ada Artikel Promosi yang memerluka persetujuan Anda. klik untuk melihat\",\"user_name\":\"Notifikasi Promosi\",\"vendor_id\":2,\"customer_id\":1,\"promotion_id\":1,\"next_route\":\"https:\\/\\/nikahyuk.online\\/admin\\/promotion?id=1\"}',NULL,'-',NULL,'2020-06-25 11:58:20','2020-06-25 11:58:20'),('b7d10f2f-641b-4669-af59-19a5646ab701','App\\Notifications\\ChatNotification','App\\Models\\User',2,'{\"type\":\"chat\",\"message\":\"Pesan Baru Belum Dibaca Dari Rohit Vaswani\",\"from_user_id\":8,\"from_user_name\":\"Rohit Vaswani\",\"photo_profile\":\"https:\\/\\/nikahyuk.online\\/admin\\/images\\/user.png\",\"to_user_id\":2,\"to_user_name\":\"Adel Anggraini\"}',NULL,'-',NULL,'2020-06-25 12:10:46','2020-06-25 12:10:46'),('ba3324e0-2cbc-405e-8545-e40f8a422843','App\\Notifications\\PromotionVendorNotif','App\\Models\\User',1,'{\"type\":\"promotion\",\"message\":\"Artikel Promosi Anda telah disetujui admin. klik untuk melihat\",\"user_name\":\"Notifikasi Promosi\",\"vendor_id\":2,\"customer_id\":1,\"promotion_id\":\"2\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/vendor\\/promotion\\/2\"}',NULL,'-',NULL,'2020-06-25 12:00:16','2020-06-25 12:00:16'),('c56a9727-61bb-49a6-83ef-661f10902211','App\\Notifications\\ChatNotification','App\\Models\\User',2,'{\"type\":\"chat\",\"message\":\"Pesan Baru Belum Dibaca Dari Nadine Putri\",\"from_user_id\":9,\"from_user_name\":\"Nadine Putri\",\"photo_profile\":\"https:\\/\\/nikahyuk.online\\/storage\\/user\\/1593088640profile3png.png\",\"to_user_id\":2,\"to_user_name\":\"Adel Anggraini\"}',NULL,'-',NULL,'2020-06-25 12:37:46','2020-06-25 12:37:46'),('cbff3cb7-aa21-4042-96c6-25d2e047a989','App\\Notifications\\OfferCompleteNotification','App\\Models\\User',8,'{\"message\":\"Vendor Ex Project telah memberikan penawaran ke kamu. cek sekarang juga!\",\"user_id\":2,\"user_name\":\"Adel Anggraini\",\"quotation_id\":1,\"quotation_package_name\":\"Paket Pernikahan Sederhana\",\"from\":\"vendor\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/customer\\/chat\"}',NULL,'-',NULL,'2020-06-25 12:09:05','2020-06-25 12:09:05'),('d17c8145-968a-4c52-8cfc-fb9d72a10e57','App\\Notifications\\ChatNotification','App\\Models\\User',2,'{\"type\":\"chat\",\"message\":\"Pesan Baru Belum Dibaca Dari Muzib\",\"from_user_id\":6,\"from_user_name\":\"Muzib\",\"photo_profile\":\"https:\\/\\/nikahyuk.online\\/admin\\/images\\/user.png\",\"to_user_id\":2,\"to_user_name\":\"Adel Anggraini\"}',NULL,'-',NULL,'2020-06-25 12:27:13','2020-06-25 12:27:13'),('db06d48e-dd34-49fe-9b37-98577599fc08','App\\Notifications\\PromotionVendorNotif','App\\Models\\User',1,'{\"type\":\"promotion\",\"message\":\"Artikel Promosi Anda telah disetujui admin. klik untuk melihat\",\"user_name\":\"Notifikasi Promosi\",\"vendor_id\":2,\"customer_id\":1,\"promotion_id\":\"1\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/vendor\\/promotion\\/1\"}',NULL,'-',NULL,'2020-06-25 11:58:48','2020-06-25 11:58:48'),('ea535baa-4505-4565-86c3-655036f0b0af','App\\Notifications\\CreateTransactionNotication','App\\Models\\User',8,'{\"type\":\"transaction_notif\",\"message\":\"Transaksi Anda telah dibuat! dengan nomor transaksi: NY-25062020121113\\/0802\\/0\",\"vendor_id\":\"2\",\"customer_id\":8,\"user_name\":\"Ex Project\",\"transaction_id\":1,\"transaction_number\":\"NY-25062020121113\\/0802\\/0\",\"next_route\":\"https:\\/\\/nikahyuk.online\\/transaction\\/1\"}',NULL,'-',NULL,'2020-06-25 12:11:13','2020-06-25 12:11:13');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promotions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `promotions_company_id_foreign` (`company_id`),
  CONSTRAINT `promotions_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotions`
--

LOCK TABLES `promotions` WRITE;
/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
INSERT INTO `promotions` VALUES (1,'Promo diskon bulan januari 20%','<p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit error fugit, dolor doloribus iusto perferendis explicabo sapiente aliquam ut necessitatibus! Ratione molestias accusamus nulla voluptates rerum hic earum possimus praesentium.</p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\"><o:p><br></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\"><o:p></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit error fugit, dolor doloribus iusto perferendis explicabo sapiente aliquam ut necessitatibus! Ratione molestias accusamus nulla voluptates rerum hic earum possimus praesentium.</p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\"><o:p><br></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\"><o:p></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit error fugit, dolor doloribus iusto perferendis explicabo sapiente aliquam ut necessitatibus! Ratione molestias accusamus nulla voluptates rerum hic earum possimus praesentium.</p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\"><o:p><br></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\"><o:p></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit error fugit, dolor doloribus iusto perferendis explicabo sapiente aliquam ut necessitatibus! Ratione molestias accusamus nulla voluptates rerum hic earum possimus praesentium.<o:p></o:p></p>','1593086300promojpg.jpg',1,'2020-06-25 11:58:20','2020-06-25 11:58:48',1),(2,'Promo Berkah Ramadhan','<p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit error fugit, dolor doloribus iusto perferendis explicabo sapiente aliquam ut necessitatibus! Ratione molestias accusamus nulla voluptates rerum hic earum possimus praesentium.&nbsp;<span style=\"font-size: 12pt;\">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit error fugit, dolor doloribus iusto perferendis explicabo sapiente aliquam ut necessitatibus! Ratione molestias accusamus nulla voluptates rerum hic earum possimus praesentium.</span></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\"><span style=\"font-size: 12pt;\"><br></span></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit error fugit, dolor doloribus iusto perferendis explicabo sapiente aliquam ut necessitatibus! Ratione molestias accusamus nulla voluptates rerum hic earum possimus praesentium.</p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\"><o:p><br></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\"><o:p></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit error fugit, dolor doloribus iusto perferendis explicabo sapiente aliquam ut necessitatibus! Ratione molestias accusamus nulla voluptates rerum hic earum possimus praesentium.<o:p></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\"><o:p></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: Calibri, sans-serif;\"><o:p></o:p></p>','1593086399promo_2jpg.jpg',1,'2020-06-25 11:59:59','2020-06-25 12:00:17',1);
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotations`
--

DROP TABLE IF EXISTS `quotations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT '-',
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '-',
  `price` double DEFAULT 0,
  `customer_id` bigint(20) unsigned NOT NULL,
  `creator_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quotations_customer_id_foreign` (`customer_id`),
  KEY `quotations_creator_id_foreign` (`creator_id`),
  CONSTRAINT `quotations_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quotations_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotations`
--

LOCK TABLES `quotations` WRITE;
/*!40000 ALTER TABLE `quotations` DISABLE KEYS */;
INSERT INTO `quotations` VALUES (1,'Paket Pernikahan Sederhana',NULL,'1593086944wedding_packagedocx.docx',19000000,8,2,'2020-06-25 12:09:04','2020-06-25 12:09:04'),(2,'Paket Pernikahan Istimewa',NULL,'1593088014wedding_packagedocx.docx',45000000,6,2,'2020-06-25 12:26:54','2020-06-25 12:26:54'),(3,'Paket Pernikahan Romantis',NULL,'1593088616wedding_packagedocx.docx',32500000,9,2,'2020-06-25 12:36:56','2020-06-25 12:36:56');
/*!40000 ALTER TABLE `quotations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `score` double(8,2) NOT NULL,
  `review` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_customer_id_foreign` (`customer_id`),
  KEY `ratings_company_id_foreign` (`company_id`),
  CONSTRAINT `ratings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  CONSTRAINT `ratings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (1,5.00,'Pelayanannya terbaik, harga terjangkau.',1,8,'2020-06-25 12:14:29','2020-06-25 12:14:29');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web','2020-06-20 12:22:47','2020-06-20 12:22:47'),(2,'Customer','web','2020-06-20 12:22:47','2020-06-20 12:22:47'),(3,'Vendor','web','2020-06-20 12:22:47','2020-06-20 12:22:47');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `selected_vendors`
--

DROP TABLE IF EXISTS `selected_vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `selected_vendors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `vendor_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `selected_vendors_customer_id_foreign` (`customer_id`),
  KEY `selected_vendors_vendor_id_foreign` (`vendor_id`),
  CONSTRAINT `selected_vendors_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `selected_vendors_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `selected_vendors`
--

LOCK TABLES `selected_vendors` WRITE;
/*!40000 ALTER TABLE `selected_vendors` DISABLE KEYS */;
INSERT INTO `selected_vendors` VALUES (1,8,2,'2020-06-25 12:08:14','2020-06-25 12:08:14'),(2,6,2,'2020-06-25 12:25:28','2020-06-25 12:25:28'),(3,9,2,'2020-06-25 12:36:22','2020-06-25 12:36:22');
/*!40000 ALTER TABLE `selected_vendors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surveys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `budget` double NOT NULL,
  `event_date` datetime NOT NULL,
  `event_date_end` date NOT NULL,
  `location_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_long` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` int(11) NOT NULL,
  `invitation_qty` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `surveys_user_id_foreign` (`user_id`),
  CONSTRAINT `surveys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surveys`
--

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;
INSERT INTO `surveys` VALUES (1,8,22000000,'2020-09-01 00:00:00','2020-09-02',NULL,NULL,15,2000,19,'Nasional','2020-06-25 12:07:13','2020-06-25 12:08:14'),(2,6,50000000,'2020-12-01 00:00:00','2020-12-02',NULL,NULL,15,5000,387,'Nasional','2020-06-25 12:25:28','2020-06-25 12:25:28'),(3,9,35000000,'2020-10-31 00:00:00','2020-11-01',NULL,NULL,15,2500,387,'Nasional','2020-06-25 12:36:22','2020-06-25 12:36:22');
/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `vendor_id` bigint(20) unsigned NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quotation_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_customer_id_foreign` (`customer_id`),
  KEY `transactions_vendor_id_foreign` (`vendor_id`),
  KEY `transactions_quotation_id_foreign` (`quotation_id`),
  CONSTRAINT `transactions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  CONSTRAINT `transactions_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`),
  CONSTRAINT `transactions_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,8,2,'NY-25062020121113/0802/0',16000000,1,'3','2020-05-25 12:38:12','2020-06-25 12:11:40',1),(2,6,2,'NY-25062020122722/0602/1',45000000,1,'cash','2020-06-25 12:27:22','2020-06-25 12:30:41',2),(3,9,2,'NY-25062020123812/0902/2',32000000,0,'3','2020-07-25 12:38:12','2020-06-25 12:38:12',3);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ktp_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ktp_selfie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Axel Saputra','admin@gmail.com','082154981441','Jl. TB Simatupang Kav. 1B Lt. 5, Cilandak 12560 Jakarta',NULL,'2020-06-20 12:22:47','$2y$10$Cmu165KiYZLfpttf1Jo5JO690BtWmjjhOxHCpq4D1iYMdWsYNO7sO','LUPhXlAtEyXkMRkdXCUuXvUW3gTXeizkqfGXBMh1libS53gas7DWJSNXBCXB','2020-06-20 12:22:47','2020-06-20 12:22:47',NULL,NULL,NULL),(2,'Adel Anggraini','vendor@gmail.com','082154981442','Jl. TB Simatupang Kav. 1B Lt. 5, Cilandak 12560 Jakarta','1593088437profile2jpg.jpg','2020-06-20 12:22:47','$2y$10$5zYfZEDGdjGN.IOcVxb2teFKA9dncknvjD.cDpi8e5doLUlL8Gcie','HlNb5zRJU7Qyr7c7VA5VuGaFk7WcUye6bcmBEKIsEG9qDLKXwGxmhFOCKC79','2020-06-20 12:22:47','2020-06-25 12:33:57',NULL,NULL,'1593086209skpng.png'),(3,'Rohit Vaswani','vendor1@gmail.com','082154981442','Jl. TB Simatupang Kav. 1B Lt. 5, Cilandak 12560 Jakarta',NULL,'2020-06-20 12:22:47','$2y$10$mOnTb3VDO8o6CANyTnoWOukDlwkg2jiojUOuekElYC52/1cJiuvqS','vhuAR3TBBf','2020-06-20 12:22:47','2020-06-20 12:22:47',NULL,NULL,NULL),(4,'Mudit Trivendi','vendor2@gmail.com','082154981442','Jl. TB Simatupang Kav. 1B Lt. 5, Cilandak 12560 Jakarta',NULL,'2020-06-20 12:22:47','$2y$10$FCr6ENMwHLJMhUlDv26aHunV3xoisImAHpU0paLA.dJTLeTLIBWlG','7w54ZmBF29','2020-06-20 12:22:47','2020-06-20 12:22:47',NULL,NULL,NULL),(5,'Nadine Putri','vendor3@gmail.com','082154981442','Jl. TB Simatupang Kav. 1B Lt. 5, Cilandak 12560 Jakarta',NULL,'2020-06-20 12:22:47','$2y$10$NaBe8CVC9jwMonJU0IVva.P5pPa3BkIbSf8ZLJ8xuNLhFcM3RvWLO','St8jCvn2I3','2020-06-20 12:22:47','2020-06-20 12:22:47',NULL,NULL,NULL),(6,'Muzib','customer@gmail.com','082154981443','Jl. Adam Malik No. 74, RT.026, Karang Asam 75123 Samarinda','1593088361profilejpg.jpg','2020-06-20 12:22:47','$2y$10$MGRGIm9cJmn9tAjoF.vPX.rF7/sTIpo0IX7NMTCetLO0EyID.NrUq','Wt23i6iklIsWJIw6aSxP8zLgxS1to7N7BgnmXUDsQ2zMmF8oBBr5s3MnpVCE','2020-06-20 12:22:47','2020-06-25 12:32:41','1593087928ktp2jpeg.jpeg','1593087928selfie2jpg.jpg','1593087928skpng.png'),(7,'Wawan','customer2@gmail.com','082154981100','Jl. Adi Sucipto No. 88, RT.010, Sambutan 75442 Samarinda',NULL,'2020-06-20 12:22:47','$2y$10$n/WPWzxlC44xpopUQB4AV.QrIrJ3p1iGu78wLMXRMHnfJbcz8PKem','QLKQUJVIKq','2020-06-20 12:22:47','2020-06-20 12:22:47',NULL,NULL,NULL),(8,'Rohit Vaswani','rohit.vaswani@vmlyr.com','08541222991','Jl. Gatot Subroto, Jakarta Selatan',NULL,NULL,'$2y$10$HtIqNqFdiNc7HELvHWBOdeAO6VtbkSbdhlfdtWbdwSbsrFT0eDcma',NULL,'2020-06-25 12:04:49','2020-06-25 12:07:13','1593086833ktpjpeg.jpeg','1593086833selfiejpeg.jpeg','1593086833skpng.png'),(9,'Nadine Putri','nadine.putri@vmlyr.com','089912371123','Jl. Gatot Subroto, Jakarta Selatan','1593088640profile3png.png',NULL,'$2y$10$CxlS27dCBevh3ykDvRnQm.lH.67h7ramgQSHkv51qnHrI3hdRxh6.',NULL,'2020-06-25 12:34:56','2020-06-25 12:37:20','1593088582ktp3jpg.JPG','1593088582npwp4png.png','1593088582skpng.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_setups`
--

DROP TABLE IF EXISTS `vendor_setups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendor_setups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_setups_company_id_foreign` (`company_id`),
  CONSTRAINT `vendor_setups_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_setups`
--

LOCK TABLES `vendor_setups` WRITE;
/*!40000 ALTER TABLE `vendor_setups` DISABLE KEYS */;
INSERT INTO `vendor_setups` VALUES (1,'city_id','19',1,NULL,NULL),(2,'city_id','387',1,NULL,NULL),(3,'theme','Nasional',1,NULL,NULL),(4,'theme','Adat Jawa',1,NULL,NULL),(5,'item_acara','Mahar',1,NULL,NULL),(6,'item_acara','Gaun Pengantin',1,NULL,NULL),(7,'item_acara','Seragam kedua orang tua',1,NULL,NULL),(8,'item_acara','Make up',1,NULL,NULL),(9,'item_acara','Gedung',1,NULL,NULL),(10,'item_acara','Dekorasi',1,NULL,NULL),(11,'item_acara','Katering',1,NULL,NULL);
/*!40000 ALTER TABLE `vendor_setups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-25 12:41:02
