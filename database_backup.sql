-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: thuctap
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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'enum: ''event_type'', ''department''',
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
INSERT INTO `categories` VALUES (1,'Conference','conference',NULL,'event_type'),(2,'Workshop','workshop',NULL,'event_type'),(3,'Seminar','seminar',NULL,'event_type'),(4,'Cultural','cultural',NULL,'event_type'),(5,'Sports','sports',NULL,'event_type'),(6,'Orientation','orientation',NULL,'event_type'),(7,'Other','other',NULL,'event_type'),(8,'Công nghệ thông tin','cong-nghe-thong-tin',NULL,'department'),(9,'Quản trị kinh doanh','quan-tri-kinh-doanh',NULL,'department'),(10,'Thiết kế đồ hoạ','thiet-ke-do-hoa',NULL,'department'),(11,'Ngôn ngữ Anh','ngon-ngu-anh',NULL,'department'),(12,'Ngôn ngữ Nhật','ngon-ngu-nhat',NULL,'department'),(13,'Ngôn ngữ Hàn','ngon-ngu-han',NULL,'department'),(14,'Truyền thông đa phương tiện','truyen-thong-da-phuong-tien',NULL,'department');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` bigint DEFAULT NULL COMMENT 'bytes',
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- Table structure for table `event_medias`
--

DROP TABLE IF EXISTS `event_medias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_medias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `is_banner` tinyint(1) NOT NULL DEFAULT '0',
  `is_recap` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_medias_event_id_foreign` (`event_id`),
  CONSTRAINT `event_medias_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_medias`
--

LOCK TABLES `event_medias` WRITE;
/*!40000 ALTER TABLE `event_medias` DISABLE KEYS */;
INSERT INTO `event_medias` VALUES (24,1,'image','events/banners/GrHoiMwMYDqDzlFb3LU4JmKdvzYnFLjVTDpPS9Cn.png',NULL,NULL,NULL,1,0,0,NULL),(77,NULL,'image','media/BsAM7N5Piq6JuGfvBlLMRlwZpc5uUD7PEIEvSP7P.jpg',NULL,'616CBsWQSQL._AC_SL1000_.jpg',NULL,0,0,0,NULL),(78,NULL,'image','media/WpbXiSl9tZlSvVLxuk71qqqzv9wK0mdr1cphvmTf.jpg',NULL,'61R-mK3oTyL._AC_SL1000_.jpg',NULL,0,0,0,NULL),(79,NULL,'image','media/0wKdga6H6AjF0sKrXvJH0mijZdiVXIyhEFxAxG2A.jpg',NULL,'61HkBdxrxOL._AC_SL1000_.jpg',NULL,0,0,0,NULL),(80,NULL,'image','media/ySQeAum35znhDfuR9rydRhzQI8qzW8wQ1NsGu3EA.jpg',NULL,'61hUT-D0uXL._AC_SL1000_.jpg',NULL,0,0,0,NULL),(81,NULL,'image','media/5TFxXyYKSw7Vr2miHzZhlPq6gKdFsyIALkfMzvhi.jpg',NULL,'61JoL0JYDTL._AC_SL1000_.jpg',NULL,0,0,0,NULL),(82,NULL,'image','media/nUIKhyiJP25gcVCiOT0eSeOsmLrt8MNNN4Gvkp9M.jpg',NULL,'41nCEJKs2KS._AC_.jpg',NULL,0,0,0,NULL),(83,NULL,'image','media/mEysUYWVBZytH5OCKPhI0XwgItRELol4LJa5iln6.jpg',NULL,'41GanKr-ABS._AC_.jpg',NULL,0,0,0,NULL),(84,NULL,'image','media/YRUAs465BLj4jXTEke6Faml9B8swWNz70fGhmbp5.jpg',NULL,'41a7fyWxPzS._AC_.jpg',NULL,0,0,0,NULL),(85,NULL,'image','media/h0WHXz12eKUIxadLJJr8W7jsDHSmWz1DLQ3TbVLN.jpg',NULL,'71LdmT-ONXL._AC_SL1200_.jpg',NULL,0,0,0,NULL),(86,NULL,'image','media/hdSKejnG7Y6dc4H0ddtjTXYzFQOVUd1fLH9QpEhH.jpg',NULL,'71gYCACh8lL._AC_SL1200_.jpg',NULL,0,0,0,NULL),(87,NULL,'image','media/8rzvVVtaks1QRVHHs1SqgJWmKarR4PxujDWKEmUA.jpg',NULL,'81Bz2I74sVL._AC_SL1500_.jpg',NULL,0,0,0,NULL),(88,NULL,'image','media/q3aKFbWfX7UW2O1AhgZOVo75H7FGGBDIkS4EN5ks.jpg',NULL,'71P-w9lyM0L._AC_SL1500_.jpg',NULL,0,0,0,NULL),(89,NULL,'image','media/8DL5U19xhrBbx8o6rkOjWOgL4VCIJrAeOxSFGGrx.jpg',NULL,'81IBMCOJZoL._AC_SL1500_.jpg',NULL,0,0,0,NULL),(90,NULL,'image','media/PmzHWxwlfh3SvLvJPEfB9SVRufg6lK4Qv6FJFvQb.jpg',NULL,'61iq18pSZ1L._AC_SL1200_.jpg',NULL,0,0,0,NULL),(91,NULL,'image','media/aJbU7jSmoMSzibpm2AsOTAfhv2hyCPYsr4BxALP3.jpg',NULL,'61X3Lxfy-YL._AC_SL1200_.jpg',NULL,0,0,0,NULL),(92,NULL,'video','media/S4f4nLEG2UVoGAhSt0zbPSQGURytB2tDprYcqfjd.mp4',NULL,'Endfield.mp4',NULL,0,0,0,NULL),(93,4,'image','events/banners/OQ1S0cbkDcEGgrksth0E4HbNDTd53kNroJNzlvBB.png',NULL,NULL,NULL,1,0,0,NULL),(94,6,'image','events/banners/DegiTolX4bOwyJiAoOkYYRH1ReGp8yJf9ukhzJSD.png',NULL,NULL,NULL,1,0,0,NULL),(134,6,'image','media/aVorxB2AUaK3VEPd3BNIklERzNvXpA4UiuhzCvJv.jpg',NULL,'Điểm thi của cá nhân được nói đến','‼️GIA TIÊN QUÁ MẠNH: TỔNG 3 MÔN 9Đ VẪN ĐỖ TRƯỜNG TOP CỦA TỈNH BẮC NINH 😀\nMới đây một trường hợp hi hữu tại Bắc Ninh, khi 1 ông cháu thi vào lớp 10 được 9.38đ 3 môn vẫn đậu trường THPT Ngô Sĩ Liên (Trường này năm 2025 có điểm chuẩn cao nhất tỉnh Bắc Giang Cũ với 23.8đ) \nLí do vì năm ngoái điểm chuẩn quá cao và các thí sinh được nộp 2 nguyện vọng, nên em nào điểm thấp thì sẽ không dám nộp trường này. Tuy nhiên việc thiếu vài chỉ tiêu, dẫn đến trường lấy xuống một số em dưới 20đ trong đó có ông cháu 9.38đ này\nMặc dù không làm gì sai, nhưng em học sinh này đang bị nhiều học sinh khác trong tỉnh spam vì điểm thấp mà vẫn lọt vào trường Top, nghĩ cũng tội 🥹',0,0,0,NULL),(135,6,'image','media/VJRTGLY12YhcxJpt6GAiZbYI07KGHGFBTbd4cs0E.jpg',NULL,'TOP 10 THÍ SINH CÓ ĐIỂM CAO NHẤT KỲ THI TUYỂN SINH VÀO LỚP 10','🎉🎉 VINH DANH TOP 10 THÍ SINH CÓ ĐIỂM CAO NHẤT KỲ THI TUYỂN SINH VÀO LỚP 10 – NĂM HỌC 2026 - 2027 🎉🎉\n🌟 Trường THPT C Phủ Lý trân trọng chúc mừng các em học sinh đã xuất sắc đạt thành tích cao trong Kỳ thi tuyển sinh vào lớp 10 năm học 2026 - 2027.\n📚 Với sự nỗ lực không ngừng, tinh thần học tập nghiêm túc cùng ý chí quyết tâm vượt khó, các em đã đạt được những kết quả đáng tự hào, ghi tên mình vào danh sách TOP 10 thí sinh có điểm cao nhất kỳ thi tuyển sinh năm nay.\n🏆 Thành tích của các em không chỉ là niềm vui, niềm tự hào của gia đình, thầy cô và nhà trường mà còn là nguồn động lực, cảm hứng để các thế hệ học sinh tiếp tục phấn đấu trên con đường chinh phục tri thức.\n💐 Chúc các em tiếp tục phát huy truyền thống hiếu học, không ngừng rèn luyện đạo đức, bồi dưỡng tri thức và gặt hái nhiều thành công hơn nữa trong hành trình học tập tại Trường THPT C Phủ Lý.\n❤️ Chào mừng các em đến với ngôi nhà chung THPT C Phủ Lý – nơi chắp cánh những ước mơ và khát vọng vươn xa!',0,0,0,NULL),(136,6,'image','media/HwP3owSCDVIjW1cHITEQxthPxBE0kcNvhRwyFapo.jpg',NULL,'','ĐẢM BẢO \"MẶT TIỀN\" CÁC CHÁU CÒN NGUYÊN LUÔN 🐧 \nÔng Ahn Min Seok, người vừa đắc cử chức Giám đốc Sở Giáo dục tỉnh Gyeonggi cho biết ông đang đề xuất tổ chức một cuộc thảo luận công khai về việc thành lập \"Cục Bảo vệ Hoạt động Giáo dục\" sau khi ông xem hết 10 tập của Teach You a Leson.\nLý do bởi, trên thực tế, tồn tại nhiều tình trạng giáo viên sợ học sinh, BLHĐ, và chức năng của nhà trường ngày nay không được tôn trọng và đề cao như trước. Đây là thời điểm mà việc khôi phục niềm tin trong cộng đồng trường học quan trọng hơn bao giờ hết. Ông cũng nhấn mạnh, cục đề cao tính giáo dục và sẽ không sử dụng baoluc dưới mọi hình thức.\nSau khi thông tin về đề xuất thành lập cục trên ra đời, rất nhiều giáo viên - những người từng phục vụ trong các lực lượng đặc nhiệm (thuỷ quân, lục quân, không quân) đã liên hệ để ứng cử thành thầy Na Hwa Jin. \nHiện tại, đề xuất đang chờ quyết định của Bộ Giáo dục.',0,0,0,NULL),(137,6,'image','media/hdSKejnG7Y6dc4H0ddtjTXYzFQOVUd1fLH9QpEhH.jpg',NULL,'','New Acheron Figure Annouced',0,0,0,NULL);
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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `speaker_id` bigint unsigned DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_schedule_event_id_foreign` (`event_id`),
  KEY `event_schedule_speaker_id_foreign` (`speaker_id`),
  CONSTRAINT `event_schedule_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_schedule_speaker_id_foreign` FOREIGN KEY (`speaker_id`) REFERENCES `speakers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_schedule`
--

LOCK TABLES `event_schedule` WRITE;
/*!40000 ALTER TABLE `event_schedule` DISABLE KEYS */;
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
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'enum: ''speaker'',''guest'',''mc'',''moderator''',
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_speakers_event_id_speaker_id_unique` (`event_id`,`speaker_id`),
  KEY `event_speakers_speaker_id_foreign` (`speaker_id`),
  CONSTRAINT `event_speakers_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_speakers_speaker_id_foreign` FOREIGN KEY (`speaker_id`) REFERENCES `speakers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_speakers`
--

LOCK TABLES `event_speakers` WRITE;
/*!40000 ALTER TABLE `event_speakers` DISABLE KEYS */;
INSERT INTO `event_speakers` VALUES (4,1,1,NULL),(5,6,1,NULL);
/*!40000 ALTER TABLE `event_speakers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `event_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` tinyint DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `department_id` bigint unsigned DEFAULT NULL,
  `views_count` int NOT NULL DEFAULT '0',
  `likes_count` int NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `page_template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qr_code_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `events_slug_unique` (`slug`),
  KEY `events_category_id_foreign` (`category_id`),
  KEY `events_department_id_foreign` (`department_id`),
  KEY `events_created_by_foreign` (`created_by`),
  CONSTRAINT `events_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `events_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `events_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Sự kiện test','workshop 2026','mô tả','2026-06-17 12:30:00','2026-06-17 17:00:00','Phòng Hội Trường','Fall 2024',NULL,2,NULL,4,0,0,NULL,NULL,1,'2026-06-15 03:24:26','2026-06-15 21:32:48'),(4,'Lễ Tôn vinh Ong Vàng Polytechnic học kỳ Fall 2024','le-ton-vinh-ong-vang-fall-2024','Lễ Tôn vinh Sinh viên Giỏi, xuất sắc học kỳ Fall 2024 nhằm tuyên dương và ghi nhận những nỗ lực học tập của sinh viên. Sự kiện là dấu mốc quan trọng, đánh dấu sự trưởng thành và nỗ lực không ngừng nghỉ của các bạn sinh viên.\r\n\r\nTham gia sự kiện, các bạn không chỉ nhận được phần thưởng xứng đáng mà còn có cơ hội giao lưu, học hỏi từ các cựu sinh viên thành đạt và đại diện các doanh nghiệp hàng đầu trong ngành.\r\n\r\nSự kiện năm nay hứa hẹn mang đến nhiều bất ngờ với sự dàn dựng công phu, âm nhạc sôi động và những câu chuyện truyền cảm hứng từ chính các bạn sinh viên vượt khó vươn lên.','2026-07-01 18:00:00','2026-07-01 21:30:00','Hội trường lớn, Tòa nhà F','Fall 2024',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,'2026-06-16 00:46:02','2026-06-16 01:05:44'),(5,'Talkshow: Hành trang GenZ - Sẵn sàng cho kỷ nguyên AI','talkshow-hanh-trang-genz-ai','Trí tuệ nhân tạo (AI) đang thay đổi mọi khía cạnh của cuộc sống và công việc. Talkshow \'Hành trang GenZ - Sẵn sàng cho kỷ nguyên AI\' mang đến cho sinh viên bức tranh toàn cảnh về tương lai của thị trường lao động dưới sự tác động của AI.\n\nTại buổi chia sẻ, các chuyên gia công nghệ sẽ giải đáp các thắc mắc về kỹ năng cần thiết để làm chủ công nghệ, không bị AI thay thế mà ngược lại, dùng AI như một đòn bẩy để phát triển sự nghiệp.\n\nBạn sẽ được hướng dẫn sử dụng các công cụ AI phổ biến hiện nay như ChatGPT, Midjourney trong quá trình học tập và làm việc nhóm hiệu quả.','2026-06-21 14:00:00','2026-06-21 16:30:00','Phòng Hội thảo số 3','2024',NULL,NULL,NULL,0,0,1,NULL,NULL,NULL,'2026-06-16 00:46:02','2026-06-16 00:46:02'),(6,'Ngày hội Việc làm JobFair 2024','jobfair-2024','Ngày hội việc làm lớn nhất năm, quy tụ hơn 50 doanh nghiệp hàng đầu trong các lĩnh vực Công nghệ thông tin, Thiết kế đồ họa, Quản trị kinh doanh và Ngôn ngữ.\n\nĐây là cơ hội \'vàng\' để sinh viên trực tiếp nộp CV, phỏng vấn thử, và tìm kiếm cơ hội thực tập, việc làm ngay khi còn ngồi trên ghế nhà trường.\n\nSự kiện bao gồm các gian hàng tư vấn trực tiếp, các phiên hội thảo nhỏ giới thiệu về môi trường làm việc của từng doanh nghiệp và chương trình bốc thăm trúng thưởng hấp dẫn.','2026-07-16 08:00:00','2026-07-16 17:00:00','Sân trường chính','Fall 2024',NULL,6,NULL,0,0,0,NULL,NULL,NULL,'2026-06-16 00:46:02','2026-06-16 03:05:27');
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
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
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
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_10_021900_create_categories_table',1),(5,'2026_06_10_021901_create_speakers_table',1),(6,'2026_06_10_021931_create_events_table',1),(7,'2026_06_10_021931_create_registrations_table',1),(8,'2026_06_10_021932_create_event_schedule_table',1),(9,'2026_06_10_021933_create_event_speakers_table',1),(10,'2026_06_10_021934_create_event_images_table',1),(11,'2026_06_10_021935_create_event_videos_table',1),(12,'2026_06_10_021936_create_event_documents_table',1),(13,'2026_06_10_021938_create_registration_checkins_table',1),(14,'2026_06_12_082000_create_event_medias_table',1),(17,'2026_06_16_072006_change_caption_type_in_event_media_table',2),(18,'2026_06_16_080244_add_content_to_event_medias_table',3),(19,'2026_06_17_080838_drop_registration_columns_from_events',4),(20,'2026_06_17_081303_drop_registration_columns_from_events',4),(21,'2026_06_17_084549_add_likes_count_to_events',5),(22,'2026_06_17_094100_drop_registration_tables',6);
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speakers`
--

LOCK TABLES `speakers` WRITE;
/*!40000 ALTER TABLE `speakers` DISABLE KEYS */;
INSERT INTO `speakers` VALUES (1,'Kalt\'sit',NULL,'/storage/speakers/Fc5mMFrgGT7E6nlweRGqfpcGmp9NRG78VOwitHAm.jpg','Medic');
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'School Admin','admin@school.edu','2026-06-12 02:04:45','$2y$12$TAFTW.yMEXDOx6XdmO7IsumdrIoSAgxiUIGggThnT9oPHBB7XYmrm','admin',NULL,'2026-06-12 02:04:46','2026-06-12 02:04:46');
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

-- Dump completed on 2026-06-18  9:49:01
