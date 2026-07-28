-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: thuctap
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_vi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'enum: ''event_type'', ''department''',
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Hội nghị',NULL,'conference',NULL,'event_type'),(2,'Hội thảo',NULL,'workshop',NULL,'event_type'),(3,'Chuyên đề',NULL,'seminar',NULL,'event_type'),(4,'Văn hóa',NULL,'cultural',NULL,'event_type'),(5,'Thể thao',NULL,'sports',NULL,'event_type'),(6,'Định hướng',NULL,'orientation',NULL,'event_type'),(8,'Công nghệ thông tin',NULL,'cong-nghe-thong-tin',NULL,'department'),(9,'Quản trị kinh doanh',NULL,'quan-tri-kinh-doanh',NULL,'department'),(10,'Thiết kế đồ hoạ',NULL,'thiet-ke-do-hoa',NULL,'department'),(11,'Ngôn ngữ Anh',NULL,'ngon-ngu-anh',NULL,'department'),(12,'Ngôn ngữ Nhật',NULL,'ngon-ngu-nhat',NULL,'department'),(13,'Ngôn ngữ Hàn',NULL,'ngon-ngu-han',NULL,'department'),(14,'Truyền thông đa phương tiện',NULL,'truyen-thong-da-phuong-tien',NULL,'department');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_departments`
--

DROP TABLE IF EXISTS `event_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_departments` (
  `event_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`event_id`,`department_id`),
  KEY `event_departments_department_id_foreign` (`department_id`),
  CONSTRAINT `event_departments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_departments_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_departments`
--

LOCK TABLES `event_departments` WRITE;
/*!40000 ALTER TABLE `event_departments` DISABLE KEYS */;
INSERT INTO `event_departments` VALUES (1,8),(4,8),(6,8),(7,8),(8,8),(9,8),(10,8),(11,8),(12,8),(13,8),(14,8),(15,8),(4,9),(6,9),(8,9),(9,9),(10,9),(11,9),(12,9),(14,9),(15,9),(1,10),(4,10),(6,10),(7,10),(8,10),(9,10),(11,10),(12,10),(13,10),(15,10),(4,11),(6,11),(8,11),(9,11),(11,11),(12,11),(15,11),(4,12),(7,12),(8,12),(9,12),(10,12),(11,12),(12,12),(13,12),(15,12),(1,13),(4,13),(7,13),(8,13),(9,13),(10,13),(11,13),(12,13),(13,13),(14,13),(15,13),(4,14),(8,14),(9,14),(11,14),(12,14),(15,14);
/*!40000 ALTER TABLE `event_departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_documents`
--

DROP TABLE IF EXISTS `event_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` bigint DEFAULT NULL COMMENT 'bytes',
  `file_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_documents_event_id_foreign` (`event_id`),
  CONSTRAINT `event_documents_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_documents`
--

LOCK TABLES `event_documents` WRITE;
/*!40000 ALTER TABLE `event_documents` DISABLE KEYS */;
INSERT INTO `event_documents` VALUES (1,NULL,'SYB3013 - Assignment_SP2026.doc.pdf','documents/aXazOCl0zfPwAIJhR8nb9hiVE0vCCS0SF5PJ7JKH.pdf',926763,'pdf',NULL);
/*!40000 ALTER TABLE `event_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_images`
--

DROP TABLE IF EXISTS `event_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_banner` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_images_event_id_foreign` (`event_id`),
  CONSTRAINT `event_images_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_images`
--

LOCK TABLES `event_images` WRITE;
/*!40000 ALTER TABLE `event_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_medias`
--

DROP TABLE IF EXISTS `event_medias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_medias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_banner` tinyint(1) NOT NULL DEFAULT '0',
  `is_recap` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `document_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_medias_event_id_foreign` (`event_id`),
  CONSTRAINT `event_medias_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=558 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_medias`
--

LOCK TABLES `event_medias` WRITE;
/*!40000 ALTER TABLE `event_medias` DISABLE KEYS */;
INSERT INTO `event_medias` VALUES (24,1,'image','events/banners/GrHoiMwMYDqDzlFb3LU4JmKdvzYnFLjVTDpPS9Cn.png',NULL,NULL,NULL,1,0,0,NULL,NULL,NULL,NULL),(77,NULL,'image','media/BsAM7N5Piq6JuGfvBlLMRlwZpc5uUD7PEIEvSP7P.jpg',NULL,'616CBsWQSQL._AC_SL1000_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(78,NULL,'image','media/WpbXiSl9tZlSvVLxuk71qqqzv9wK0mdr1cphvmTf.jpg',NULL,'61R-mK3oTyL._AC_SL1000_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(79,NULL,'image','media/0wKdga6H6AjF0sKrXvJH0mijZdiVXIyhEFxAxG2A.jpg',NULL,'61HkBdxrxOL._AC_SL1000_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(80,NULL,'image','media/ySQeAum35znhDfuR9rydRhzQI8qzW8wQ1NsGu3EA.jpg',NULL,'61hUT-D0uXL._AC_SL1000_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(81,NULL,'image','media/5TFxXyYKSw7Vr2miHzZhlPq6gKdFsyIALkfMzvhi.jpg',NULL,'61JoL0JYDTL._AC_SL1000_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(82,NULL,'image','media/nUIKhyiJP25gcVCiOT0eSeOsmLrt8MNNN4Gvkp9M.jpg',NULL,'41nCEJKs2KS._AC_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(83,NULL,'image','media/mEysUYWVBZytH5OCKPhI0XwgItRELol4LJa5iln6.jpg',NULL,'41GanKr-ABS._AC_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(84,NULL,'image','media/YRUAs465BLj4jXTEke6Faml9B8swWNz70fGhmbp5.jpg',NULL,'41a7fyWxPzS._AC_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(85,NULL,'image','media/h0WHXz12eKUIxadLJJr8W7jsDHSmWz1DLQ3TbVLN.jpg',NULL,'71LdmT-ONXL._AC_SL1200_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(86,NULL,'image','media/hdSKejnG7Y6dc4H0ddtjTXYzFQOVUd1fLH9QpEhH.jpg',NULL,'71gYCACh8lL._AC_SL1200_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(87,NULL,'image','media/8rzvVVtaks1QRVHHs1SqgJWmKarR4PxujDWKEmUA.jpg',NULL,'81Bz2I74sVL._AC_SL1500_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(88,NULL,'image','media/q3aKFbWfX7UW2O1AhgZOVo75H7FGGBDIkS4EN5ks.jpg',NULL,'71P-w9lyM0L._AC_SL1500_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(89,NULL,'image','media/8DL5U19xhrBbx8o6rkOjWOgL4VCIJrAeOxSFGGrx.jpg',NULL,'81IBMCOJZoL._AC_SL1500_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(90,NULL,'image','media/PmzHWxwlfh3SvLvJPEfB9SVRufg6lK4Qv6FJFvQb.jpg',NULL,'61iq18pSZ1L._AC_SL1200_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(91,NULL,'image','media/aJbU7jSmoMSzibpm2AsOTAfhv2hyCPYsr4BxALP3.jpg',NULL,'61X3Lxfy-YL._AC_SL1200_.jpg',NULL,0,0,0,NULL,NULL,NULL,NULL),(92,NULL,'video','media/S4f4nLEG2UVoGAhSt0zbPSQGURytB2tDprYcqfjd.mp4',NULL,'Endfield.mp4',NULL,0,0,0,NULL,NULL,NULL,NULL),(93,4,'image','events/banners/OQ1S0cbkDcEGgrksth0E4HbNDTd53kNroJNzlvBB.png',NULL,NULL,NULL,1,0,0,NULL,NULL,NULL,NULL),(94,6,'image','events/banners/DegiTolX4bOwyJiAoOkYYRH1ReGp8yJf9ukhzJSD.png',NULL,NULL,NULL,1,0,0,NULL,NULL,NULL,NULL),(138,4,'image','conference/le-ton-vinh-ong-vang-fall-2024/banners/6GR7e9KJot6K0Y4MYEqYMowOSDcz19fvUTtSfQRw.jpg',NULL,NULL,NULL,1,0,0,'2026-06-24 19:18:39',NULL,NULL,NULL),(139,5,'image','conference/talkshow-hanh-trang-genz-ai/banners/bzR6Jf64oeh5eBGLCZHccXMjYkdqfGpgxkVShjVz.jpg',NULL,NULL,NULL,1,0,0,'2026-06-24 19:18:39',NULL,NULL,NULL),(140,6,'image','orientation/jobfair-2024/banners/yK4JLUO35r5vzEHokeHqxO9Sg1M7UKnccE7JYQdw.png',NULL,NULL,NULL,1,0,0,'2026-06-24 19:18:39',NULL,NULL,NULL),(141,7,'image','seminar/xu-huong-nghe-nghiep-2026-ban-da-thuc-su-san-sang/banners/FydQDjVQvk2F6BfBCX6Ch1BNN37504iJI5Tdozov.jpg',NULL,NULL,NULL,1,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(142,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/banners/eRgT6tRDh0KvqrkluOgRIzqOk3vcExIOL7z9j3ez.jpg',NULL,NULL,NULL,1,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(143,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/banners/wLC7qNFwdTSUx6iipA8cwdvLmmOcMjkE55nxDIWO.jpg',NULL,NULL,NULL,1,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(144,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/1WskPvANTGNHJXPYR6zl5hdYqdaDcSRlwgUVwe85.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(145,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/72TduiCAoBfvedKDINwv4OmwnGxyt8nwcrUtWxFz.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(146,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/8SQgaZMGQas8dNxEvU5yDiwOeqCQlAzHYGPMAQJ9.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(147,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/Ct6A28X79nWmglLOp5Uyjj47QppH9VAjxUTSsfVV.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(148,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/I3g5byCMTDZcNHaxKQ1Gqq43ld35NvI3TBuryZza.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(149,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/MwxkNRY89nJvIgTH8BOS0PI28FFoCOHbmmKwfw7t.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(150,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/OUJlYWnhSjgomSMZMC4Ix5Q0tCfuR2aSu2qHEsi4.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(151,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/S6rqozZVbvb2Q2dztq08BKL1j9lP81UUIXM2qrgB.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(152,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/SVn71PXuem4xc6kz2NLlCiPGPyEx5H0jIr2AYAD7.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(153,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/Xr77o6QGmueqaEXjNtWDTE7VFFi5VdXgyD35AegW.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(154,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/a6i3J2zKZhTEtEMBwrDQZ3W9HVOaVf96pVRYq08H.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(155,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/nPbzAg6Y551GPWpZv1aB4qUy9lCuGUX3wDKaiicZ.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(156,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/nZe4kk8sHXkutwHQT9O4DS5HKcRRoc4AIXxG68sj.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(157,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/pJvuvyZg3N267s23GTJI2Qk8RDcqGwh0owikukmA.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(158,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/pdJ8C3HuEZfPLmC8pxXgwn92vxw5vndprOpzXjaj.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(159,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/sWgtgs1gPP08c5vTawwtVGl5diE0ezvKoUV9pYT3.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(160,8,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/y4gUdDcP9YUp3v6e15d5WrJtUJ6arndqO0kfK19H.jpg',NULL,NULL,NULL,0,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(161,9,'image','sports/su-kien-sunny-bee/banners/eGO0Yyk2lAHT8S3CyEu0XjzRGgHU3NloY5OUvfNe.jpg',NULL,NULL,NULL,1,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(162,10,'image','sports/workshop-sang-tao-noi-dung/banners/8ZpVAbgikdje5YIQoujZlgj0MLdVjihKJ5rqoqdK.jpg',NULL,NULL,NULL,1,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(163,1,'image','workshop/workshop 2026/banners/MqbAoCs090AlE5qKqkPJpXPdRLmCuNsVOm8xwuSf.jpg',NULL,NULL,NULL,1,0,0,'2026-06-24 19:19:48',NULL,NULL,NULL),(172,4,'image','media/hdSKejnG7Y6dc4H0ddtjTXYzFQOVUd1fLH9QpEhH.jpg',NULL,'','<p class=\"ds-markdown-paragraph\"><span class=\"\">Mỗi phi&ecirc;n thảo luận đều được ban tổ chức d&agrave;y c&ocirc;ng nghi&ecirc;n cứu v&agrave; lựa chọn, đảm bảo mang lại gi&aacute; trị cốt l&otilde;i cho người tham dự:</span></p>\n<p class=\"ds-markdown-paragraph\"><span class=\"\">Cập nhật xu hướng mới nhất: Ph&acirc;n t&iacute;ch b&aacute;o c&aacute;o từ c&aacute;c tổ chức uy t&iacute;n về bức tranh to&agrave;n cảnh ng&agrave;nh nghề T&ecirc;n ng&agrave;nh năm 2026 v&agrave; tầm nh&igrave;n 2030.</span></p>\n<p class=\"ds-markdown-paragraph\"><span class=\"\">Lớp học chuy&ecirc;n s&acirc;u: C&aacute;c kỹ năng cứng v&agrave; mềm thiết yếu từ Data Analytics, Design Thinking đến Kỹ năng thuyết tr&igrave;nh đỉnh cao, được dẫn dắt bởi c&aacute;c chuy&ecirc;n gia h&agrave;ng đầu.</span></p>\n<p class=\"ds-markdown-paragraph\"><span class=\"\">Chứng nhận gi&aacute; trị: Tham dự đầy đủ chương tr&igrave;nh, bạn sẽ nhận được Chứng chỉ c&oacute; m&atilde; số x&aacute;c thực, được c&ocirc;ng nhận bởi T&ecirc;n đơn vị đối t&aacute;c, gi&uacute;p hồ sơ năng lực của bạn th&ecirc;m phần thuyết phục.</span></p>\n<p class=\"ds-markdown-paragraph\"><span class=\"\">T&agrave;i liệu hội thảo độc quyền: Một bộ t&agrave;i liệu tổng hợp c&aacute;c b&agrave;i nghi&ecirc;n cứu v&agrave; t&agrave;i liệu tham khảo do c&aacute;c giảng vi&ecirc;n v&agrave; chuy&ecirc;n gia bi&ecirc;n soạn, chỉ d&agrave;nh ri&ecirc;ng cho người tham dự.</span></p>\n<p class=\"ds-markdown-paragraph\"><span class=\"\">Cơ hội học bổng: D&agrave;nh tặng những đại biểu c&oacute; đ&oacute;ng g&oacute;p nổi bật trong phần thảo luận những suất học bổng du học hoặc học ph&iacute; cho c&aacute;c kh&oacute;a học chuy&ecirc;n m&ocirc;n.</span></p>',0,0,0,'2026-06-24 20:56:45','documents/cK0BWAU2Fjfi6Wfe4psC56oBD92UYzQeZQpPAL0F.pdf','SYB3013 - Assignment_SP2026.doc.pdf',''),(173,4,'image','media/YRUAs465BLj4jXTEke6Faml9B8swWNz70fGhmbp5.jpg',NULL,'','<p><span class=\"\">Ch&uacute;ng t&ocirc;i vinh dự được ch&agrave;o đ&oacute;n những vị kh&aacute;ch mời đặc biệt: Tiến sĩ T&ecirc;n kh&aacute;ch mời 1 &ndash; Trưởng ph&ograve;ng Nghi&ecirc;n cứu v&agrave; Ph&aacute;t triển của Tập đo&agrave;n đa quốc gia, v&agrave; &Ocirc;ng/B&agrave; T&ecirc;n kh&aacute;ch mời 2 &ndash; Chuy&ecirc;n gia tư vấn chiến lược cấp cao, Top 50 nh&agrave; l&atilde;nh đạo c&oacute; tầm ảnh hưởng tại Việt Nam. Với kinh nghiệm d&agrave;y dặn v&agrave; tầm nh&igrave;n chiến lược, họ sẽ gi&uacute;p bạn nh&igrave;n thấy bức tranh to&agrave;n cảnh v&agrave; x&aacute;c định r&otilde; r&agrave;ng lộ tr&igrave;nh ph&aacute;t triển sự nghiệp tương lai của m&igrave;nh.</span></p>',0,0,0,'2026-06-24 20:56:45','','',''),(175,10,'image','workshop/workshop 2026/banners/MqbAoCs090AlE5qKqkPJpXPdRLmCuNsVOm8xwuSf.jpg',NULL,'','<p class=\"ds-markdown-paragraph\"><span class=\"\">Thị trường lao động kh&ocirc;ng ngừng biến động. Tr&iacute; tuệ nh&acirc;n tạo, Chuyển đổi số, hay Kinh tế xanh kh&ocirc;ng c&ograve;n l&agrave; những từ kh&oacute;a xa vời, ch&uacute;ng đang định h&igrave;nh lại mọi ng&oacute;c ng&aacute;ch trong c&ocirc;ng việc tương lai của bạn. C&acirc;u hỏi đặt ra l&agrave;: Bạn đang đứng ở đ&acirc;u trong cuộc đua n&agrave;y?</span></p>\n<p class=\"ds-markdown-paragraph\"><span class=\"\">Nhận thức r&otilde; tr&aacute;ch nhiệm trong việc dẫn dắt sinh vi&ecirc;n tiếp cận tri thức mới, Đơn vị tổ chức tr&acirc;n trọng giới thiệu hội thảo chuy&ecirc;n đề: T&ecirc;n sự kiện. Đ&acirc;y l&agrave; diễn đ&agrave;n học thuật cấp cao, nơi l&yacute; thuyết gặp gỡ thực tiễn, nơi giảng đường kết nối với doanh nghiệp.</span></p>',0,0,0,'2026-06-24 21:24:09','','',''),(176,11,'image','cultural/ngay-hoi-trong-cay-vi-mot-mau-xanh-tuong-lai-500-cay-xanh-phu-kin-doi-trong/banners/cVHWAGVBbN5roPwk9flruAIQqwqMhj3vsnKITDMw.jpg',NULL,NULL,NULL,1,0,0,'2026-06-25 01:00:54',NULL,NULL,NULL),(203,12,'image','workshop/unleash-yourself-hoi-thao-ky-nang-mem-danh-cho-sinh-vien-2025/banners/iGcuBO9qOVJBqDXhl7GBlwCY7OTOs0DSWZunjpBV.jpg',NULL,NULL,NULL,1,0,0,'2026-06-25 19:56:16',NULL,NULL,NULL),(204,12,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/I3g5byCMTDZcNHaxKQ1Gqq43ld35NvI3TBuryZza.jpg',NULL,'','<p>Bằng cấp l&agrave; điều kiện cần &mdash; nhưng kỹ năng mềm mới l&agrave; thứ quyết định bạn c&oacute; được việc, được thăng tiến v&agrave; được y&ecirc;u th&iacute;ch trong m&ocirc;i trường l&agrave;m việc hay kh&ocirc;ng. Rất nhiều sinh vi&ecirc;n giỏi vẫn vấp ng&atilde; ngay từ v&ograve;ng phỏng vấn đầu ti&ecirc;n chỉ v&igrave; thiếu những kỹ năng tưởng chừng đơn giản n&agrave;y.</p>',0,0,0,'2026-06-25 20:47:10','','',''),(205,12,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/MwxkNRY89nJvIgTH8BOS0PI28FFoCOHbmmKwfw7t.jpg',NULL,'','<p>UNLEASH YOURSELF được thiết kế như một h&agrave;nh tr&igrave;nh trải nghiệm thực chiến &mdash; kh&ocirc;ng phải l&yacute; thuyết su&ocirc;ng. Từ c&aacute;ch mở miệng thuyết phục, c&aacute;ch dẫn dắt đội nh&oacute;m, đến c&aacute;ch x&acirc;y dựng thương hiệu c&aacute; nh&acirc;n: mỗi phi&ecirc;n đều c&oacute; b&agrave;i tập thực h&agrave;nh ngay tại chỗ c&ugrave;ng phản hồi trực tiếp từ chuy&ecirc;n gia.</p>',0,0,0,'2026-06-25 20:47:10','','',''),(206,12,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/8SQgaZMGQas8dNxEvU5yDiwOeqCQlAzHYGPMAQJ9.jpg',NULL,'','<p>Hội thảo quy tụ những diễn giả đ&atilde; đi qua con đường bạn đang bước &mdash; người từng l&agrave; sinh vi&ecirc;n b&igrave;nh thường v&agrave; trở th&agrave;nh nh&agrave; l&atilde;nh đạo, người HR đ&atilde; phỏng vấn h&agrave;ng ngh&igrave;n ứng vi&ecirc;n, người đ&atilde; x&acirc;y dựng mạng lưới từ con số kh&ocirc;ng. Họ sẽ chia sẻ thật, kh&ocirc;ng m&agrave;u m&egrave;.</p>',0,0,0,'2026-06-25 20:47:10','','',''),(207,12,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/SVn71PXuem4xc6kz2NLlCiPGPyEx5H0jIr2AYAD7.jpg',NULL,'','<p>Cuối ng&agrave;y, bạn kh&ocirc;ng chỉ mang về một tập t&agrave;i liệu &mdash; bạn mang về một mạng lưới kết nối, một bộ kỹ năng được n&acirc;ng cấp v&agrave; quan trọng nhất: sự tự tin để bước v&agrave;o thị trường lao động với tư thế của người sẵn s&agrave;ng. Số lượng c&oacute; hạn &mdash; đừng để cơ hội n&agrave;y thuộc về người kh&aacute;c.</p>',0,0,0,'2026-06-25 20:47:10','','',''),(208,13,'image','seminar/dsdsdasa/banners/psl0QyxfapW1DahZegi5f0aokJrzFKFHzpBaw6Dr.png',NULL,NULL,NULL,1,0,0,'2026-06-27 00:12:37',NULL,NULL,NULL),(217,14,'image','seminar/dfdasdsad/banners/QNXpbBiMfxKs6O6YO0Tqso0KzCEWTK3S7OmlWhq9.png',NULL,NULL,NULL,1,0,0,'2026-06-27 01:20:24',NULL,NULL,NULL),(410,11,'image','cultural/ngay-hoi-trong-cay-vi-mot-mau-xanh-tuong-lai-500-cay-xanh-phu-kin-doi-trong/media/pFvxwTHNt8dsJ5UL4cbhcXnwnQbvOZPCQiWodtjp.jpg',NULL,'','<p><strong>Sự kiện</strong><br><br>S&aacute;ng sớm ng&agrave;y 22 th&aacute;ng 6, hơn 200 t&igrave;nh nguyện vi&ecirc;n đến từ khắp nơi đ&atilde; tề tựu tại x&atilde; Cao Sơn, huyện Đ&agrave; Bắc, tỉnh H&ograve;a B&igrave;nh để tham gia chương tr&igrave;nh trồng c&acirc;y từ thiện \"V&igrave; một m&agrave;u xanh tương lai\" &mdash; một s&aacute;ng kiến được tổ chức thường ni&ecirc;n nhằm phục hồi diện t&iacute;ch rừng bị suy tho&aacute;i.</p>',0,0,0,'2026-07-04 07:36:29','','',''),(411,11,'image','cultural/ngay-hoi-trong-cay-vi-mot-mau-xanh-tuong-lai-500-cay-xanh-phu-kin-doi-trong/media/jJU5gmDjjhCXOi5gUzPnHfUP6gzxOkNyjdWiZ8yi.jpg',NULL,'','<p><strong>Nổi bật</strong><br><br>Chương tr&igrave;nh năm nay ghi nhận sự tham gia đặc biệt của c&aacute;c em học sinh tiểu học địa phương c&ugrave;ng c&aacute;n bộ nh&acirc;n vi&ecirc;n từ nhiều doanh nghiệp tr&ecirc;n địa b&agrave;n. Mỗi người tham gia được trao một c&acirc;y con giống bản địa &mdash; bao gồm keo tai tượng, l&aacute;t hoa v&agrave; tre luồng &mdash; ph&ugrave; hợp với điều kiện thổ nhưỡng khu vực.</p>',0,0,0,'2026-07-04 07:36:29','','',''),(412,11,'image','cultural/ngay-hoi-trong-cay-vi-mot-mau-xanh-tuong-lai-500-cay-xanh-phu-kin-doi-trong/media/iPI2raIKN9OZUu7IuRfnzX6SCOYUyGPY6glnHIKk.jpg',NULL,'','<p><strong>Cuối c&ugrave;ng</strong><br><br>Sau buổi trồng c&acirc;y, c&aacute;c t&igrave;nh nguyện vi&ecirc;n c&ograve;n tham gia dọn dẹp vệ sinh khu vực xung quanh v&agrave; trao tặng học bổng cho 15 học sinh c&oacute; ho&agrave;n cảnh kh&oacute; khăn tại địa phương &mdash; một điểm nhấn nh&acirc;n văn l&agrave;m d&agrave;y th&ecirc;m &yacute; nghĩa của ng&agrave;y hội.</p>',0,0,0,'2026-07-04 07:36:29','','',''),(413,6,'image','orientation/jobfair-2024/banners/1MeOkOL5PEOJ3GVmDWiETzEACU1yR4ejBEpTAFHl.png',NULL,NULL,NULL,1,0,0,'2026-07-04 08:28:56',NULL,NULL,NULL),(435,6,'image','orientation/jobfair-2024/media/ot4WT21JdRMG5Q4T0oIMZp9hxsxPnblVWpvZO51c.png',NULL,NULL,NULL,0,1,0,'2026-07-04 08:38:48',NULL,NULL,NULL),(436,6,'image','media/aVorxB2AUaK3VEPd3BNIklERzNvXpA4UiuhzCvJv.jpg',NULL,'Điểm thi của cá nhân được nói đến','‼️GIA TIÊN QUÁ MẠNH: TỔNG 3 MÔN 9Đ VẪN ĐỖ TRƯỜNG TOP CỦA TỈNH BẮC NINH 😀\nMới đây một trường hợp hi hữu tại Bắc Ninh, khi 1 ông cháu thi vào lớp 10 được 9.38đ 3 môn vẫn đậu trường THPT Ngô Sĩ Liên (Trường này năm 2025 có điểm chuẩn cao nhất tỉnh Bắc Giang Cũ với 23.8đ) \nLí do vì năm ngoái điểm chuẩn quá cao và các thí sinh được nộp 2 nguyện vọng, nên em nào điểm thấp thì sẽ không dám nộp trường này. Tuy nhiên việc thiếu vài chỉ tiêu, dẫn đến trường lấy xuống một số em dưới 20đ trong đó có ông cháu 9.38đ này\nMặc dù không làm gì sai, nhưng em học sinh này đang bị nhiều học sinh khác trong tỉnh spam vì điểm thấp mà vẫn lọt vào trường Top, nghĩ cũng tội 🥹',0,0,0,'2026-07-04 08:38:48','','',''),(437,6,'image','media/VJRTGLY12YhcxJpt6GAiZbYI07KGHGFBTbd4cs0E.jpg',NULL,'TOP 10 THÍ SINH CÓ ĐIỂM CAO NHẤT KỲ THI TUYỂN SINH VÀO LỚP 10','🎉🎉 VINH DANH TOP 10 THÍ SINH CÓ ĐIỂM CAO NHẤT KỲ THI TUYỂN SINH VÀO LỚP 10 – NĂM HỌC 2026 - 2027 🎉🎉\n🌟 Trường THPT C Phủ Lý trân trọng chúc mừng các em học sinh đã xuất sắc đạt thành tích cao trong Kỳ thi tuyển sinh vào lớp 10 năm học 2026 - 2027.\n📚 Với sự nỗ lực không ngừng, tinh thần học tập nghiêm túc cùng ý chí quyết tâm vượt khó, các em đã đạt được những kết quả đáng tự hào, ghi tên mình vào danh sách TOP 10 thí sinh có điểm cao nhất kỳ thi tuyển sinh năm nay.\n🏆 Thành tích của các em không chỉ là niềm vui, niềm tự hào của gia đình, thầy cô và nhà trường mà còn là nguồn động lực, cảm hứng để các thế hệ học sinh tiếp tục phấn đấu trên con đường chinh phục tri thức.\n💐 Chúc các em tiếp tục phát huy truyền thống hiếu học, không ngừng rèn luyện đạo đức, bồi dưỡng tri thức và gặt hái nhiều thành công hơn nữa trong hành trình học tập tại Trường THPT C Phủ Lý.\n❤️ Chào mừng các em đến với ngôi nhà chung THPT C Phủ Lý – nơi chắp cánh những ước mơ và khát vọng vươn xa!',0,0,0,'2026-07-04 08:38:48','','',''),(438,6,'image','media/HwP3owSCDVIjW1cHITEQxthPxBE0kcNvhRwyFapo.jpg',NULL,'','ĐẢM BẢO \"MẶT TIỀN\" CÁC CHÁU CÒN NGUYÊN LUÔN 🐧 \nÔng Ahn Min Seok, người vừa đắc cử chức Giám đốc Sở Giáo dục tỉnh Gyeonggi cho biết ông đang đề xuất tổ chức một cuộc thảo luận công khai về việc thành lập \"Cục Bảo vệ Hoạt động Giáo dục\" sau khi ông xem hết 10 tập của Teach You a Leson.\nLý do bởi, trên thực tế, tồn tại nhiều tình trạng giáo viên sợ học sinh, BLHĐ, và chức năng của nhà trường ngày nay không được tôn trọng và đề cao như trước. Đây là thời điểm mà việc khôi phục niềm tin trong cộng đồng trường học quan trọng hơn bao giờ hết. Ông cũng nhấn mạnh, cục đề cao tính giáo dục và sẽ không sử dụng baoluc dưới mọi hình thức.\nSau khi thông tin về đề xuất thành lập cục trên ra đời, rất nhiều giáo viên - những người từng phục vụ trong các lực lượng đặc nhiệm (thuỷ quân, lục quân, không quân) đã liên hệ để ứng cử thành thầy Na Hwa Jin. \nHiện tại, đề xuất đang chờ quyết định của Bộ Giáo dục.',0,0,0,'2026-07-04 08:38:48','','',''),(439,6,'image','http://127.0.0.1:8000/admin/events/6/design',NULL,'','Form đăng ký',0,0,0,'2026-07-04 08:38:50','','','https://drive.google.com/drive/folders/1i8tzwjdmNiCfNzvYQRKMaNfpVhvE7M76'),(483,12,'image','https://drive.google.com/thumbnail?id=1pReZVoCpRgRLhVhf0SFvwQv2N0mToANt&sz=w1920',NULL,'Reed_the_Flame_Shadow_Skin_3.png',NULL,0,1,0,'2026-07-08 02:16:47',NULL,NULL,NULL),(484,12,'image','https://drive.google.com/thumbnail?id=15dNmbPGVOegRjc2EvJLUD2FCael5QMJl&sz=w1920',NULL,'Reed_the_Flame_Shadow_Skin_1.png',NULL,0,1,0,'2026-07-08 02:16:47',NULL,NULL,NULL),(485,12,'image','https://drive.google.com/thumbnail?id=1AwqgfZSaggZ3URa5pBUkSgiHOFiqLuFY&sz=w1920',NULL,'Reed_the_Flame_Shadow_Skin_2.png',NULL,0,1,0,'2026-07-08 02:16:47',NULL,NULL,NULL),(486,12,'image','https://drive.google.com/thumbnail?id=1mCT2fkm6BUTn2LBhvwhSyPMwFS8W-R1x&sz=w1920',NULL,'Reed_The_Flame_Shadow_E1.png',NULL,0,1,0,'2026-07-08 02:16:47',NULL,NULL,NULL),(487,12,'image','https://drive.google.com/thumbnail?id=1-D1Gxq_bn2px4xl0fmrFgoHsT6fBuRBL&sz=w1920',NULL,'zen_5hh3uGUb8C.png',NULL,0,1,0,'2026-07-08 02:16:47',NULL,NULL,NULL),(488,12,'image','https://drive.google.com/thumbnail?id=177FMvsTfHpyZmWi0YZirrmwQLL0nFldc&sz=w1920',NULL,'0109.e6b483.jpg',NULL,0,1,0,'2026-07-08 02:16:47',NULL,NULL,NULL),(489,12,'image','https://drive.google.com/thumbnail?id=1XLedUfvBhf7Tga8HlX_A9Y-iyJcBSCmw&sz=w1920',NULL,'0108.9ba62d.jpg',NULL,0,1,0,'2026-07-08 02:16:47',NULL,NULL,NULL),(490,12,'image','https://drive.google.com/thumbnail?id=1zJshdSfytWM4dhZZd1fFnN7mDGxZ0qyu&sz=w1920',NULL,'YbSzdLe7.jpeg',NULL,0,1,0,'2026-07-08 02:16:47',NULL,NULL,NULL),(491,12,'image','https://drive.google.com/thumbnail?id=1nFczd1q0JIguCZ4duv5ezLKcRRPDNJ6E&sz=w1920',NULL,'__reed_reed_the_flame_shadow_and_necrass_arknights_drawn_by_starshadowmagician__e4b7b2606fd99998350d7edbc9ad8d00.png',NULL,0,1,0,'2026-07-08 02:16:47',NULL,NULL,NULL),(492,12,'image','https://drive.google.com/thumbnail?id=1xllxRV5o4WLrOo9sTJskCgARW__mx96_&sz=w1920',NULL,'__reed_reed_the_flame_shadow_and_necrass_arknights_drawn_by_ruoganzhao__d7ec63b3f0eb274404a474ecd4552c15.jpg',NULL,0,1,0,'2026-07-08 02:16:47',NULL,NULL,NULL),(493,12,'image','https://drive.google.com/thumbnail?id=1Rg2iekhghCbGNqGptXVx3D5-k2qthEPh&sz=w1920',NULL,'Gq17WEtWwAUBzjE.jpg',NULL,0,1,0,'2026-07-08 02:16:47',NULL,NULL,NULL),(494,12,'image','https://drive.google.com/thumbnail?id=1GE0ZmIC13j1DXP6KEiPliRzN3be9p_nU&sz=w1920',NULL,'Reed AS 2024 HD.jpg',NULL,0,1,0,'2026-07-08 02:16:47',NULL,NULL,NULL),(495,4,'image','https://drive.google.com/thumbnail?id=1pReZVoCpRgRLhVhf0SFvwQv2N0mToANt&sz=w1920',NULL,'Reed_the_Flame_Shadow_Skin_3.png',NULL,0,1,0,'2026-07-08 02:20:02',NULL,NULL,NULL),(496,4,'image','https://drive.google.com/thumbnail?id=15dNmbPGVOegRjc2EvJLUD2FCael5QMJl&sz=w1920',NULL,'Reed_the_Flame_Shadow_Skin_1.png',NULL,0,1,0,'2026-07-08 02:20:02',NULL,NULL,NULL),(497,4,'image','https://drive.google.com/thumbnail?id=1AwqgfZSaggZ3URa5pBUkSgiHOFiqLuFY&sz=w1920',NULL,'Reed_the_Flame_Shadow_Skin_2.png',NULL,0,1,0,'2026-07-08 02:20:02',NULL,NULL,NULL),(498,4,'image','https://drive.google.com/thumbnail?id=1mCT2fkm6BUTn2LBhvwhSyPMwFS8W-R1x&sz=w1920',NULL,'Reed_The_Flame_Shadow_E1.png',NULL,0,1,0,'2026-07-08 02:20:02',NULL,NULL,NULL),(499,4,'image','https://drive.google.com/thumbnail?id=1-D1Gxq_bn2px4xl0fmrFgoHsT6fBuRBL&sz=w1920',NULL,'zen_5hh3uGUb8C.png',NULL,0,1,0,'2026-07-08 02:20:02',NULL,NULL,NULL),(500,4,'image','https://drive.google.com/thumbnail?id=177FMvsTfHpyZmWi0YZirrmwQLL0nFldc&sz=w1920',NULL,'0109.e6b483.jpg',NULL,0,1,0,'2026-07-08 02:20:02',NULL,NULL,NULL),(501,4,'image','https://drive.google.com/thumbnail?id=1XLedUfvBhf7Tga8HlX_A9Y-iyJcBSCmw&sz=w1920',NULL,'0108.9ba62d.jpg',NULL,0,1,0,'2026-07-08 02:20:02',NULL,NULL,NULL),(502,4,'image','https://drive.google.com/thumbnail?id=1zJshdSfytWM4dhZZd1fFnN7mDGxZ0qyu&sz=w1920',NULL,'YbSzdLe7.jpeg',NULL,0,1,0,'2026-07-08 02:20:02',NULL,NULL,NULL),(503,4,'image','https://drive.google.com/thumbnail?id=1nFczd1q0JIguCZ4duv5ezLKcRRPDNJ6E&sz=w1920',NULL,'__reed_reed_the_flame_shadow_and_necrass_arknights_drawn_by_starshadowmagician__e4b7b2606fd99998350d7edbc9ad8d00.png',NULL,0,1,0,'2026-07-08 02:20:02',NULL,NULL,NULL),(504,4,'image','https://drive.google.com/thumbnail?id=1xllxRV5o4WLrOo9sTJskCgARW__mx96_&sz=w1920',NULL,'__reed_reed_the_flame_shadow_and_necrass_arknights_drawn_by_ruoganzhao__d7ec63b3f0eb274404a474ecd4552c15.jpg',NULL,0,1,0,'2026-07-08 02:20:02',NULL,NULL,NULL),(505,4,'image','https://drive.google.com/thumbnail?id=1Rg2iekhghCbGNqGptXVx3D5-k2qthEPh&sz=w1920',NULL,'Gq17WEtWwAUBzjE.jpg',NULL,0,1,0,'2026-07-08 02:20:02',NULL,NULL,NULL),(506,4,'image','https://drive.google.com/thumbnail?id=1GE0ZmIC13j1DXP6KEiPliRzN3be9p_nU&sz=w1920',NULL,'Reed AS 2024 HD.jpg',NULL,0,1,0,'2026-07-08 02:20:02',NULL,NULL,NULL),(512,15,'image','cultural/su-kien-tu-do-ban-nhap-cua-ban/banners/xi9VJu7UclwXIrb4wccxYcC2p1vrjq4L95wx4Eid.png',NULL,NULL,NULL,1,0,0,'2026-07-10 03:16:30',NULL,NULL,NULL),(518,15,'image','cultural/su-kien-tu-do-ban-nhap-cua-ban/media/uo3hH0rHZKzIzTISAb9GZAV6GJLQsS09C3lAszo9.png',NULL,NULL,NULL,0,1,0,'2026-07-10 04:06:12',NULL,NULL,NULL),(519,15,'image','seminar/dsdsdasa/banners/psl0QyxfapW1DahZegi5f0aokJrzFKFHzpBaw6Dr.png',NULL,'','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',0,0,0,'2026-07-10 04:06:12','','',''),(520,15,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/nPbzAg6Y551GPWpZv1aB4qUy9lCuGUX3wDKaiicZ.jpg',NULL,'','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',0,0,0,'2026-07-10 04:06:12','','',''),(521,15,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/8SQgaZMGQas8dNxEvU5yDiwOeqCQlAzHYGPMAQJ9.jpg',NULL,'','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',0,0,0,'2026-07-10 04:06:12','','',''),(522,15,'image','media/0wKdga6H6AjF0sKrXvJH0mijZdiVXIyhEFxAxG2A.jpg',NULL,'','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',0,0,0,'2026-07-10 04:06:12','','',''),(534,13,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/pJvuvyZg3N267s23GTJI2Qk8RDcqGwh0owikukmA.jpg',NULL,'','<p><strong><span class=\"\">Lorem ipsum dolor sit amet</span></strong><span class=\"\">, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p>',0,0,0,'2026-07-11 04:05:42','','',''),(535,13,'image','sports/ban-da-san-sang-de-but-pha-gioi-han/media/8SQgaZMGQas8dNxEvU5yDiwOeqCQlAzHYGPMAQJ9.jpg',NULL,'','<p><strong><span class=\"\">Lorem ipsum dolor sit amet</span></strong><span class=\"\">, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p>',0,0,0,'2026-07-11 04:05:42','documents/n1KPYCFcAB89GCCn4yQMhZ6VKdw8kXR4m68zdxwp.pdf','SYB3013 - Assignment_SP2026.doc.pdf',''),(536,13,'image','media/0wKdga6H6AjF0sKrXvJH0mijZdiVXIyhEFxAxG2A.jpg',NULL,'','<p><strong><span class=\"\">Lorem ipsum dolor sit amet</span></strong><span class=\"\">, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p>',0,0,0,'2026-07-11 04:05:42','','',''),(537,13,'image','media/hdSKejnG7Y6dc4H0ddtjTXYzFQOVUd1fLH9QpEhH.jpg',NULL,'','<p><strong><span class=\"\">Lorem ipsum dolor sit amet</span></strong><span class=\"\">, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p>',0,0,0,'2026-07-11 04:05:42','','',''),(541,13,'image','https://drive.google.com/thumbnail?id=1wNRf88xZTm114QKm6yO0absgE6uyWDnC&sz=w1920',NULL,'elden-ring-shadow-of-the-erdtree-tag-page-cover-art-1269937118.jpg',NULL,0,1,0,'2026-07-16 07:38:30',NULL,NULL,NULL),(542,13,'image','https://drive.google.com/thumbnail?id=11ZNaI7UoRhnLzle7rtpIfSgHU7ZqA68S&sz=w1920',NULL,'clair-obscur-expedition-33-1145895026.jpg',NULL,0,1,0,'2026-07-16 07:38:30',NULL,NULL,NULL),(543,13,'image','https://drive.google.com/thumbnail?id=1X2wD_Er4M8nasLgzuQ3gik4vfmFkseIj&sz=w1920',NULL,'battlefield-6-tag-page-cover-art-3720488752.jpg',NULL,0,1,0,'2026-07-16 07:38:30',NULL,NULL,NULL),(544,11,'image','https://drive.google.com/thumbnail?id=1B_PASKPz23HVv54Cy0Yz89aE7puZ1eiv&sz=w1920',NULL,'81Bz2I74sVL._AC_SL1500_.jpg',NULL,0,1,0,'2026-07-16 07:44:31',NULL,NULL,NULL),(545,11,'image','https://drive.google.com/thumbnail?id=1_G8PYPjq0_0hmX0MjchLGV6e8o38auFR&sz=w1920',NULL,'71P-w9lyM0L._AC_SL1500_.jpg',NULL,0,1,0,'2026-07-16 07:44:31',NULL,NULL,NULL),(546,11,'image','https://drive.google.com/thumbnail?id=1lOXHy8HNV-DL9VEJACD0R8BOsAeFdIsx&sz=w1920',NULL,'81IBMCOJZoL._AC_SL1500_.jpg',NULL,0,1,0,'2026-07-16 07:44:31',NULL,NULL,NULL),(547,11,'image','https://drive.google.com/thumbnail?id=1r09mtJtPYxYFfYER6KG1xuRe52mxB-OM&sz=w1920',NULL,'616CBsWQSQL._AC_SL1000_.jpg',NULL,0,1,0,'2026-07-16 07:44:31',NULL,NULL,NULL),(548,11,'image','https://drive.google.com/thumbnail?id=1euCiJvlU9UHBAUtOl77C6_GMpI6FhZ_V&sz=w1920',NULL,'4103XTIyQmS._AC_.jpg',NULL,0,1,0,'2026-07-16 07:44:31',NULL,NULL,NULL),(549,16,'image','https://drive.google.com/thumbnail?id=1-D1Gxq_bn2px4xl0fmrFgoHsT6fBuRBL&sz=w1920',NULL,NULL,NULL,1,0,0,'2026-07-22 09:03:59',NULL,NULL,NULL),(550,16,'image','https://drive.google.com/thumbnail?id=11ZNaI7UoRhnLzle7rtpIfSgHU7ZqA68S&sz=w1920',NULL,NULL,NULL,0,0,0,'2026-07-22 09:03:59',NULL,NULL,NULL),(551,16,'image','https://drive.google.com/thumbnail?id=1pReZVoCpRgRLhVhf0SFvwQv2N0mToANt&sz=w1920',NULL,NULL,NULL,0,0,0,'2026-07-22 09:03:59',NULL,NULL,NULL),(552,17,'image','https://drive.google.com/thumbnail?id=1mCT2fkm6BUTn2LBhvwhSyPMwFS8W-R1x&sz=w1920',NULL,NULL,NULL,1,0,0,'2026-07-22 09:03:59',NULL,NULL,NULL),(553,17,'image','https://drive.google.com/thumbnail?id=1-D1Gxq_bn2px4xl0fmrFgoHsT6fBuRBL&sz=w1920',NULL,NULL,NULL,0,0,0,'2026-07-22 09:03:59',NULL,NULL,NULL),(554,18,'image','https://drive.google.com/thumbnail?id=177FMvsTfHpyZmWi0YZirrmwQLL0nFldc&sz=w1920',NULL,NULL,NULL,1,0,0,'2026-07-22 09:03:59',NULL,NULL,NULL),(555,19,'image','https://drive.google.com/thumbnail?id=1XLedUfvBhf7Tga8HlX_A9Y-iyJcBSCmw&sz=w1920',NULL,NULL,NULL,1,0,0,'2026-07-22 09:03:59',NULL,NULL,NULL),(556,20,'image','https://drive.google.com/thumbnail?id=1_G8PYPjq0_0hmX0MjchLGV6e8o38auFR&sz=w1920',NULL,NULL,NULL,1,0,0,'2026-07-22 09:03:59',NULL,NULL,NULL),(557,20,'image','https://drive.google.com/thumbnail?id=1Rg2iekhghCbGNqGptXVx3D5-k2qthEPh&sz=w1920',NULL,NULL,NULL,0,0,0,'2026-07-22 09:03:59',NULL,NULL,NULL);
/*!40000 ALTER TABLE `event_medias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_schedule`
--

DROP TABLE IF EXISTS `event_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_schedule` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `speaker_id` bigint unsigned DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_schedule_event_id_foreign` (`event_id`),
  KEY `event_schedule_speaker_id_foreign` (`speaker_id`),
  CONSTRAINT `event_schedule_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_schedule_speaker_id_foreign` FOREIGN KEY (`speaker_id`) REFERENCES `speakers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_schedule`
--

LOCK TABLES `event_schedule` WRITE;
/*!40000 ALTER TABLE `event_schedule` DISABLE KEYS */;
INSERT INTO `event_schedule` VALUES (5,13,'2026-07-05 12:00:00','2026-07-05 15:00:00','Begin and End of phase 1',NULL,NULL,0);
/*!40000 ALTER TABLE `event_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_speakers`
--

DROP TABLE IF EXISTS `event_speakers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_speakers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `speaker_id` bigint unsigned NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'enum: ''speaker'',''guest'',''mc'',''moderator''',
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_speakers_event_id_speaker_id_unique` (`event_id`,`speaker_id`),
  KEY `event_speakers_speaker_id_foreign` (`speaker_id`),
  CONSTRAINT `event_speakers_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_speakers_speaker_id_foreign` FOREIGN KEY (`speaker_id`) REFERENCES `speakers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_speakers`
--

LOCK TABLES `event_speakers` WRITE;
/*!40000 ALTER TABLE `event_speakers` DISABLE KEYS */;
INSERT INTO `event_speakers` VALUES (4,1,1,NULL),(5,6,1,'speaker'),(6,4,1,NULL),(7,8,1,NULL),(8,9,1,'speaker'),(9,11,2,'speaker'),(10,10,1,NULL),(11,12,1,NULL),(13,14,1,'speaker'),(14,13,2,'speaker'),(15,13,4,'speaker'),(16,15,1,'speaker'),(17,15,3,'speaker');
/*!40000 ALTER TABLE `event_speakers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_videos`
--

DROP TABLE IF EXISTS `event_videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_videos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_recap` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_videos_event_id_foreign` (`event_id`),
  CONSTRAINT `event_videos_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_videos`
--

LOCK TABLES `event_videos` WRITE;
/*!40000 ALTER TABLE `event_videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `recap_drive_link` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` tinyint DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `department_id` bigint unsigned DEFAULT NULL,
  `views_count` int NOT NULL DEFAULT '0',
  `likes_count` int NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `page_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qr_code_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `events_slug_unique` (`slug`),
  KEY `events_category_id_foreign` (`category_id`),
  KEY `events_department_id_foreign` (`department_id`),
  KEY `events_created_by_foreign` (`created_by`),
  KEY `events_is_published_index` (`is_published`),
  KEY `events_event_date_index` (`event_date`),
  KEY `events_views_count_index` (`views_count`),
  KEY `events_likes_count_index` (`likes_count`),
  CONSTRAINT `events_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `events_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `events_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Sự kiện test','workshop 2026','mô tả',NULL,'2026-06-17 12:30:00','2026-06-17 17:00:00','Phòng Hội Trường','2025-2026',3,2,NULL,8,0,1,'draft',NULL,NULL,1,'2026-06-15 03:24:26','2026-07-11 05:20:44'),(4,'Lễ Tôn vinh Ong Vàng Polytechnic học kỳ Fall 2024','le-ton-vinh-ong-vang-fall-2024','Lễ Tôn vinh Sinh viên Giỏi, xuất sắc học kỳ Fall 2024 nhằm tuyên dương và ghi nhận những nỗ lực học tập của sinh viên. Sự kiện là dấu mốc quan trọng, đánh dấu sự trưởng thành và nỗ lực không ngừng nghỉ của các bạn sinh viên.\r\n\r\nTham gia sự kiện, các bạn không chỉ nhận được phần thưởng xứng đáng mà còn có cơ hội giao lưu, học hỏi từ các cựu sinh viên thành đạt và đại diện các doanh nghiệp hàng đầu trong ngành.\r\n\r\nSự kiện năm nay hứa hẹn mang đến nhiều bất ngờ với sự dàn dựng công phu, âm nhạc sôi động và những câu chuyện truyền cảm hứng từ chính các bạn sinh viên vượt khó vươn lên.','https://drive.google.com/drive/folders/1kmDjYd4AUZGiLmm3N41k7di6gxUEQoMW?usp=drive_link','2026-07-01 18:00:00','2026-07-01 21:30:00','Hội trường lớn, Tòa nhà F','2025-2026',3,1,NULL,9,0,0,'archived','2',NULL,NULL,'2026-06-16 00:46:02','2026-07-14 08:07:29'),(5,'Talkshow: Hành trang GenZ - Sẵn sàng cho kỷ nguyên AI','talkshow-hanh-trang-genz-ai','Trí tuệ nhân tạo (AI) đang thay đổi mọi khía cạnh của cuộc sống và công việc. Talkshow \'Hành trang GenZ - Sẵn sàng cho kỷ nguyên AI\' mang đến cho sinh viên bức tranh toàn cảnh về tương lai của thị trường lao động dưới sự tác động của AI.\n\nTại buổi chia sẻ, các chuyên gia công nghệ sẽ giải đáp các thắc mắc về kỹ năng cần thiết để làm chủ công nghệ, không bị AI thay thế mà ngược lại, dùng AI như một đòn bẩy để phát triển sự nghiệp.\n\nBạn sẽ được hướng dẫn sử dụng các công cụ AI phổ biến hiện nay như ChatGPT, Midjourney trong quá trình học tập và làm việc nhóm hiệu quả.',NULL,'2026-06-21 14:00:00','2026-06-21 16:30:00','Phòng Hội thảo số 3','2025-2026',3,NULL,NULL,7,0,1,'published',NULL,NULL,NULL,'2026-06-16 00:46:02','2026-07-22 02:54:30'),(6,'Ngày hội Việc làm JobFair 2024','jobfair-2024','Ngày hội việc làm lớn nhất năm, quy tụ hơn 50 doanh nghiệp hàng đầu trong các lĩnh vực Công nghệ thông tin, Thiết kế đồ họa, Quản trị kinh doanh và Ngôn ngữ.\r\n\r\nĐây là cơ hội \'vàng\' để sinh viên trực tiếp nộp CV, phỏng vấn thử, và tìm kiếm cơ hội thực tập, việc làm ngay khi còn ngồi trên ghế nhà trường.\r\n\r\nSự kiện bao gồm các gian hàng tư vấn trực tiếp, các phiên hội thảo nhỏ giới thiệu về môi trường làm việc của từng doanh nghiệp và chương trình bốc thăm trúng thưởng hấp dẫn.',NULL,'2026-07-16 08:00:00','2026-07-16 17:00:00','Sân trường chính','2025-2026',3,6,NULL,12,1,1,'published','2',NULL,NULL,'2026-06-16 00:46:02','2026-07-13 01:41:34'),(7,'Xu Huong Nghe Nghiep 2026 Ban Da Thuc Su San Sang','xu-huong-nghe-nghiep-2026-ban-da-thuc-su-san-sang','Event description',NULL,'2026-06-25 02:19:00','2026-06-25 04:19:48','TBD','2025-2026',3,4,NULL,1,0,1,'draft',NULL,NULL,NULL,'2026-06-24 19:19:48','2026-07-11 05:20:44'),(8,'Ban Da San Sang De But Pha Gioi Han','ban-da-san-sang-de-but-pha-gioi-han','Event description',NULL,'2026-06-25 02:19:00','2026-06-25 04:19:48','TBD','2025-2026',3,5,NULL,1,0,1,'draft',NULL,NULL,NULL,'2026-06-24 19:19:48','2026-07-11 05:20:44'),(9,'Su Kien Sunny Bee','su-kien-sunny-bee','Event description',NULL,'2026-06-25 02:19:00','2026-06-25 04:19:00','TBD','2025-2026',3,3,NULL,0,0,1,'published',NULL,NULL,NULL,'2026-06-24 19:19:48','2026-07-11 05:20:44'),(10,'Workshop Sang Tao Noi Dung','workshop-sang-tao-noi-dung','Event description',NULL,'2026-06-25 02:19:00','2026-06-25 04:19:48','TBD','2025-2026',3,6,NULL,0,0,1,'draft','2',NULL,NULL,'2026-06-24 19:19:48','2026-07-11 05:20:44'),(11,'Ngày hội trồng cây \"Vì một màu xanh tương lai\" — 500 cây xanh phủ kín đồi trống','ngay-hoi-trong-cay-vi-mot-mau-xanh-tuong-lai-500-cay-xanh-phu-kin-doi-trong','\"Mỗi cây chúng ta trồng hôm nay là một lá phổi nhỏ cho thế hệ mai sau. Đây không chỉ là hành động môi trường — đây là hành động yêu thương.\" — Đại diện Ban tổ chức','https://drive.google.com/drive/folders/1tOtyPtymqKm-txeBmRZG1oEbYYGAZEdJ?usp=sharing','2026-06-26 13:30:00',NULL,'Vườn trọi AB','2025-2026',3,4,NULL,10,0,0,'archived','2',NULL,1,'2026-06-25 01:00:39','2026-07-18 08:10:38'),(12,'UNLEASH YOURSELF — Hội thảo Kỹ năng mềm dành cho Sinh viên 2025','unleash-yourself-hoi-thao-ky-nang-mem-danh-cho-sinh-vien-2025','Bạn sắp tốt nghiệp nhưng chưa tự tin vào phỏng vấn? Bạn giỏi chuyên môn nhưng không biết cách trình bày ý tưởng? Bạn muốn xây dựng hình ảnh cá nhân và mạng lưới quan hệ từ khi còn ngồi trên ghế giảng đường? UNLEASH YOURSELF chính là sự kiện dành cho bạn.\r\n\r\nHội thảo quy tụ các chuyên gia nhân sự hàng đầu, những người trẻ đã thành công sớm và các doanh nghiệp đang tìm kiếm nhân tài — tất cả trong một ngày bùng nổ năng lượng và giá trị thực tế. Bạn sẽ được:\r\n\r\n• Học cách giao tiếp thuyết phục và trình bày trước đám đông\r\n• Hiểu tư duy lãnh đạo và làm việc nhóm hiệu quả\r\n• Xây dựng hồ sơ cá nhân nổi bật trên LinkedIn và thị trường lao động\r\n• Kết nối trực tiếp với nhà tuyển dụng và mentors trong ngành\r\n\r\nĐây không phải một buổi học thêm — đây là bước ngoặt bạn cần trước khi bước ra thế giới thật.','https://drive.google.com/drive/folders/1kmDjYd4AUZGiLmm3N41k7di6gxUEQoMW?usp=drive_link','2026-06-29 14:00:00',NULL,'Hội trường','2025-2026',3,2,NULL,8,0,0,'archived','1',NULL,1,'2026-06-25 19:56:04','2026-07-11 05:20:44'),(13,'dsdsdasa','dsdsdasa','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','https://drive.google.com/drive/folders/1CQ1KNvnB23hQqztsyiqb-faW1BOzUhf6?usp=drive_link','2026-07-05 13:50:00','2026-07-15 15:00:00','ẻwweqwe','2025-2026',3,3,NULL,8,1,0,'archived','1',NULL,1,'2026-06-27 00:12:23','2026-07-21 06:53:43'),(14,'dfdasdsad','dfdasdsad','dsadsada',NULL,'2026-06-29 12:22:00',NULL,'dấdsadasdaewqewq','2025-2026',3,3,NULL,0,0,1,'ended','2',NULL,1,'2026-06-27 01:20:13','2026-07-11 05:20:44'),(15,'Sự kiện tự do (Bản nháp của bạn)','su-kien-tu-do-ban-nhap-cua-ban','Đây là một sự kiện nháp để bạn có thể tự do thêm thắt, chỉnh sửa và thử nghiệm các thiết kế.',NULL,'2026-07-21 10:21:00','2026-07-25 12:30:00','Phòng thực hành','2025-2026',3,4,NULL,4,0,1,'published','1',NULL,NULL,'2026-07-07 03:21:30','2026-07-21 06:53:31'),(16,'Workshop Kỹ Năng Lãnh Đạo 2026','workshop-ky-nang-lanh-dao-2026-6a60877f3d379','Phát triển kỹ năng quản lý và điều hành đội nhóm hiệu quả.',NULL,'2026-07-28 11:30:59','2026-07-28 14:30:59','Hội trường 4','2025-2026',3,4,NULL,97,0,1,'published',NULL,NULL,1,'2026-07-22 09:03:59','2026-07-22 09:03:59'),(17,'Tech Talk: Tương Lai Của AI','tech-talk-tuong-lai-cua-ai-6a60877f73fbe','Thảo luận về xu hướng AI và cách áp dụng vào học tập và làm việc.',NULL,'2026-07-28 08:30:59','2026-07-28 11:30:59','Hội trường 3','2025-2026',3,3,NULL,71,0,1,'published',NULL,NULL,1,'2026-07-22 09:03:59','2026-07-22 09:07:18'),(18,'Ngày Hội Định Hướng Tân Sinh Viên','ngay-hoi-dinh-huong-tan-sinh-vien-6a60877f77465','Hoạt động chào đón tân sinh viên hòa nhập môi trường mới.',NULL,'2026-07-31 14:30:59','2026-07-31 17:30:59','Hội trường 5','2025-2026',3,4,NULL,91,0,1,'published',NULL,NULL,1,'2026-07-22 09:03:59','2026-07-22 09:03:59'),(19,'Giao Lưu Cựu Sinh Viên Khởi Nghiệp','giao-luu-cuu-sinh-vien-khoi-nghiep-6a60877f7a00f','Lắng nghe câu chuyện khởi nghiệp thành công từ cựu sinh viên.',NULL,'2026-08-10 09:30:59','2026-08-10 12:30:59','Hội trường 4','2025-2026',3,3,NULL,90,0,1,'published',NULL,NULL,1,'2026-07-22 09:03:59','2026-07-22 09:03:59'),(20,'Cuộc Thi Sáng Tạo Trẻ Lần Thứ V','cuoc-thi-sang-tao-tre-lan-thu-v-6a60877f7c2c1','Sân chơi thể hiện ý tưởng sáng tạo, đột phá dành cho sinh viên.',NULL,'2026-08-14 09:30:59','2026-08-14 12:30:59','Hội trường 3','2025-2026',3,1,NULL,86,0,1,'published',NULL,NULL,1,'2026-07-22 09:03:59','2026-07-22 09:03:59');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_10_021900_create_categories_table',1),(5,'2026_06_10_021901_create_speakers_table',1),(6,'2026_06_10_021931_create_events_table',1),(7,'2026_06_10_021931_create_registrations_table',1),(8,'2026_06_10_021932_create_event_schedule_table',1),(9,'2026_06_10_021933_create_event_speakers_table',1),(10,'2026_06_10_021934_create_event_images_table',1),(11,'2026_06_10_021935_create_event_videos_table',1),(12,'2026_06_10_021936_create_event_documents_table',1),(13,'2026_06_10_021938_create_registration_checkins_table',1),(14,'2026_06_12_082000_create_event_medias_table',1),(17,'2026_06_16_072006_change_caption_type_in_event_media_table',2),(18,'2026_06_16_080244_add_content_to_event_medias_table',3),(19,'2026_06_17_080838_drop_registration_columns_from_events',4),(20,'2026_06_17_081303_drop_registration_columns_from_events',4),(21,'2026_06_17_084549_add_likes_count_to_events',5),(22,'2026_06_17_094100_drop_registration_tables',6),(23,'2026_06_18_075136_add_design_columns_to_events_and_medias_table',7),(24,'2026_06_18_090846_add_font_family_columns_to_events_table',7),(25,'2026_06_20_072909_create_event_departments_table',8),(26,'2026_06_20_083000_add_type_to_speakers_table',8),(27,'2026_06_22_022612_add_is_hidden_to_speakers_table',8),(28,'2026_06_23_085305_add_indexes_to_events_table',8),(29,'2026_06_24_025705_add_status_to_events_table',8),(30,'2026_06_24_091302_add_name_vi_to_categories_table',8),(31,'2026_06_30_080210_drop_design_columns_from_events_table',9),(32,'2026_06_30_999999_sync_merged_columns',10),(33,'2026_07_06_161019_remove_type_from_speakers_table',10),(34,'2026_07_07_162348_add_recap_drive_link_to_events_table',11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `speakers`
--

DROP TABLE IF EXISTS `speakers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `speakers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speakers`
--

LOCK TABLES `speakers` WRITE;
/*!40000 ALTER TABLE `speakers` DISABLE KEYS */;
INSERT INTO `speakers` VALUES (1,'Kalt\'sit',NULL,'/storage/speakers/Fc5mMFrgGT7E6nlweRGqfpcGmp9NRG78VOwitHAm.jpg','Medic',0),(2,'Đinh Thị Linh An','Đại diện Ban tổ chức','http://127.0.0.1:8000/drive-proxy?path=speakers%2FU9ITQjk9N9t6K96zJxyaGGN4cBfU1xUjlNWJESiM.jpg',NULL,0),(3,'Fare','Observer','http://127.0.0.1:8000/drive-proxy?path=speakers%2F3uBYml8WcwkVSwMbNiljvpnlFeQeMZHTY3diJmzf.jpg',NULL,0),(4,'Fare','Observer','http://127.0.0.1:8000/drive-proxy?path=speakers%2FdI1bMz8HbzAJvxRIV9aOv1MZ9G7035DBqfxT7efI.jpg',NULL,0);
/*!40000 ALTER TABLE `speakers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'School Admin','admin@school.edu','2026-06-12 02:04:45','$2y$12$0nBNe/mo2dNwOXSmv/yqY.xi/5YHAhPUoIV84U.SF1J9PAqKaSeeG','admin',NULL,'2026-06-12 02:04:46','2026-07-04 02:10:28'),(2,'Admin test 1','admin@test.edu',NULL,'$2y$12$zthDZ3F3qk6b3C41yQZM6upxv7.NJhc4DSabK4XYzs5/3olxrsaIa','admin',NULL,'2026-07-03 07:35:57','2026-07-03 07:35:57');
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

-- Dump completed on 2026-07-23 14:23:48
