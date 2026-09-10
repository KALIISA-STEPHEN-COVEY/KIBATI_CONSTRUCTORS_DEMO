-- Kibati Constructors Database Backup Dump
-- Generated: 2026-09-07 15:16:35
CREATE DATABASE IF NOT EXISTS `kibati_db`;
USE `kibati_db`;

DROP TABLE IF EXISTS `contact_submissions`;
CREATE TABLE `contact_submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `project_message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `contact_submissions` VALUES("1","Covey Stephen","stephencovey03@gmail.com","testing database","2026-09-07 01:55:25");
INSERT INTO `contact_submissions` VALUES("2","Covey Stephen","stephencovey3@gmail.com","asphalt","2026-09-07 14:54:07");
INSERT INTO `contact_submissions` VALUES("3","Covey Stephen","stephencovey3@gmail.com","drainage systems","2026-09-07 15:03:40");


DROP TABLE IF EXISTS `service_inquiries`;
CREATE TABLE `service_inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `selected_service` varchar(100) NOT NULL,
  `project_specs` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `service_inquiries` VALUES("1","murvins ","stephencovey03@gmail.com","General Civil Inquiry","damamage toilets","2026-09-07 15:04:13");
INSERT INTO `service_inquiries` VALUES("2","stephencovey03@gmail.com","stephencovey03@gmail.com","General Civil Inquiry","draine","2026-09-07 15:24:17");


DROP TABLE IF EXISTS `portfolio_inquiries`;
CREATE TABLE `portfolio_inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `interested_project` varchar(255) NOT NULL,
  `custom_message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `client_reviews`;
CREATE TABLE `client_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `headline` varchar(255) NOT NULL,
  `rating_stars` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_meta` varchar(255) NOT NULL,
  `is_approved` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `tender_submissions`;
CREATE TABLE `tender_submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `project_scale` varchar(100) NOT NULL,
  `scope_details` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



