/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.4.22-MariaDB : Database - kaspin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kaspin` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `kaspin`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `m_barang` */

DROP TABLE IF EXISTS `m_barang`;

CREATE TABLE `m_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kd_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `satuan_barang` varchar(50) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `m_barang` */

insert  into `m_barang`(`id_barang`,`kd_barang`,`nama_barang`,`keterangan`,`satuan_barang`,`stok`,`created_at`,`created_by`,`updated_by`,`deleted_by`,`updated_at`,`deleted_at`) values (1,'brg-000001','Sandal','Ini adalah sandal premium','Pasang',15,'2022-03-10 02:14:03',NULL,NULL,NULL,'2022-03-09 19:14:03',NULL),(2,'brg-000002','Baju','Ini adalah baju premium','Pcs',NULL,'2022-03-09 18:03:20',NULL,NULL,NULL,'2022-03-09 18:03:20',NULL),(3,'brg-000003','Celana Panjang','Ini adalah celana bermerk','Pcs',NULL,'2022-03-10 01:15:27',NULL,NULL,NULL,'2022-03-09 18:15:27','2022-03-09 18:15:27');

/*Table structure for table `m_menu` */

DROP TABLE IF EXISTS `m_menu`;

CREATE TABLE `m_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(255) DEFAULT NULL,
  `status` char(255) DEFAULT NULL COMMENT '0=Tunggal, 1=parent, 2=child_parent, 3=sub_parent, 4=child_sub_parent',
  `parent_id` int(11) DEFAULT NULL,
  `sub_parent_id` int(11) DEFAULT NULL,
  `is_aktif` char(2) DEFAULT NULL COMMENT '0=Tidak Aktif, 1=Aktif',
  `urutan` int(11) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `url_menu` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `m_menu` */

insert  into `m_menu`(`id_menu`,`nama_menu`,`status`,`parent_id`,`sub_parent_id`,`is_aktif`,`urutan`,`icon`,`url_menu`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`) values (1,'Master','1',NULL,NULL,'1',2,'fab fa-buffer','/master','2022-02-01 14:58:37',NULL,NULL,1,NULL,NULL),(2,'Menu','4',1,11,'1',1,NULL,'/master/hak-akses/menu','2022-02-11 15:01:12','2022-02-26 12:05:06',NULL,1,NULL,NULL),(3,'Dashboard','0',NULL,NULL,'1',1,'fas fa-chalkboard','/dashboard','2022-02-14 10:14:03','2022-02-16 04:06:11',NULL,1,NULL,NULL),(4,'Role User','4',1,11,'1',2,NULL,'master/hak-akses/role-user','2022-02-14 08:51:01','2022-02-25 09:02:01',NULL,NULL,NULL,NULL),(10,'User','4',1,11,'1',3,NULL,'master/hak-akses/user','2022-02-16 06:25:09','2022-02-24 04:04:04',NULL,NULL,NULL,NULL),(11,'Hak Akses','3',1,NULL,'1',1,'fa fa-fingerprint','master/hak-akses','2022-02-24 03:39:51','2022-02-26 14:41:38',NULL,NULL,NULL,NULL),(14,'Barang','2',1,NULL,'1',4,'fa fa-box','master/barang','2022-03-09 16:53:02','2022-03-09 16:53:02',NULL,NULL,NULL,NULL),(15,'Transaksi Barang','1',NULL,NULL,'1',3,'fa fa-box','transaksi','2022-03-09 18:17:35','2022-03-09 18:17:35',NULL,NULL,NULL,NULL),(16,'Barang Masuk','2',15,NULL,'1',5,NULL,'transaksi/barang-masuk','2022-03-09 18:18:54','2022-03-09 18:18:54',NULL,NULL,NULL,NULL),(17,'Barang Keluar','2',15,NULL,'1',6,NULL,'transaksi/barang-keluar','2022-03-09 18:19:36','2022-03-09 18:19:36',NULL,NULL,NULL,NULL),(18,'Stok Barang','2',15,NULL,'1',7,NULL,'transaksi/stok-barang','2022-03-09 18:20:02','2022-03-09 18:20:02',NULL,NULL,NULL,NULL);

/*Table structure for table `m_menu_user` */

DROP TABLE IF EXISTS `m_menu_user`;

CREATE TABLE `m_menu_user` (
  `id_menu_user` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_menu_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `m_menu_user` */

insert  into `m_menu_user`(`id_menu_user`,`id_user`,`id_menu`,`id_role`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`) values (1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL),(2,1,2,1,NULL,NULL,NULL,NULL,NULL,NULL),(3,1,3,1,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,4,1,NULL,NULL,NULL,NULL,NULL,NULL),(5,1,10,1,NULL,NULL,NULL,NULL,NULL,NULL),(6,1,11,1,NULL,NULL,NULL,NULL,NULL,NULL),(7,1,12,1,NULL,NULL,NULL,NULL,NULL,NULL),(8,1,14,1,NULL,NULL,NULL,NULL,NULL,NULL),(9,2,14,2,NULL,NULL,NULL,NULL,NULL,NULL),(10,1,15,1,NULL,NULL,NULL,NULL,NULL,NULL),(11,2,15,2,NULL,NULL,NULL,NULL,NULL,NULL),(12,1,16,1,NULL,NULL,NULL,NULL,NULL,NULL),(13,2,16,2,NULL,NULL,NULL,NULL,NULL,NULL),(14,1,17,1,NULL,NULL,NULL,NULL,NULL,NULL),(15,2,17,2,NULL,NULL,NULL,NULL,NULL,NULL),(16,1,18,1,NULL,NULL,NULL,NULL,NULL,NULL),(17,2,18,2,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `m_role` */

DROP TABLE IF EXISTS `m_role`;

CREATE TABLE `m_role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `is_aktif` char(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_role`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `m_role` */

insert  into `m_role`(`id_role`,`nama_role`,`keterangan`,`is_aktif`,`created_at`,`updated_at`,`deleted_at`) values (1,'Admin','Admin Aplikasi','1','2022-02-16 11:47:34',NULL,NULL),(2,'User','User Aplikasi','1','2022-02-16 06:22:54','2022-02-16 06:23:05','2022-02-16 06:23:05'),(3,'User Iku','User Aplikasi','1','2022-02-16 06:23:11','2022-02-16 06:23:48','2022-02-16 06:23:48'),(4,'Staff','Staf Aplikasi','1','2022-03-09 16:09:58','2022-03-09 16:09:58',NULL);

/*Table structure for table `m_user` */

DROP TABLE IF EXISTS `m_user`;

CREATE TABLE `m_user` (
  `id_user` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_old` varchar(255) DEFAULT NULL,
  `see_password_old` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `see_password` varchar(255) DEFAULT NULL,
  `is_aktif` char(2) DEFAULT NULL COMMENT '0=Tidak Aktif, 1=Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `m_user` */

insert  into `m_user`(`id_user`,`nama`,`username`,`email`,`password_old`,`see_password_old`,`password`,`see_password`,`is_aktif`,`created_at`,`updated_at`,`deleted_at`,`created_by`,`updated_by`,`deleted_by`,`jabatan`) values (1,'Testing','testing',NULL,'$2y$10$MyOX7gXGa4ugkmgWa7NkuexnbK3z59H1OP4kOGk7I1oIQWvH146cm','728uql','$2y$10$MyOX7gXGa4ugkmgWa7NkuexnbK3z59H1OP4kOGk7I1oIQWvH146cm','728uql','1','2022-02-11 14:31:39',NULL,NULL,NULL,NULL,NULL,'admin'),(2,'Jatmiko','jatmiko',NULL,'$2y$10$kCO1Zp3PF8WgIKkro6uZhePyozhN7fZPoC4TRpwMEbyA2.961zXKi','jatmiko','$2y$10$J51kGiKdto6k9rn.3I8EcO8zZcouVNaXblfLTA/8zULzT35roHM4y','jatmiko','1','2022-03-09 16:50:56','2022-03-09 16:50:56',NULL,NULL,NULL,NULL,'staff');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2016_06_01_000001_create_oauth_auth_codes_table',1),(5,'2016_06_01_000002_create_oauth_access_tokens_table',1),(6,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(7,'2016_06_01_000004_create_oauth_clients_table',1),(8,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(9,'2019_08_19_000000_create_failed_jobs_table',1),(10,'2019_12_14_000001_create_personal_access_tokens_table',1);

/*Table structure for table `oauth_access_tokens` */

DROP TABLE IF EXISTS `oauth_access_tokens`;

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_access_tokens` */

/*Table structure for table `oauth_auth_codes` */

DROP TABLE IF EXISTS `oauth_auth_codes`;

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_auth_codes` */

/*Table structure for table `oauth_clients` */

DROP TABLE IF EXISTS `oauth_clients`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_clients` */

/*Table structure for table `oauth_personal_access_clients` */

DROP TABLE IF EXISTS `oauth_personal_access_clients`;

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_personal_access_clients` */

/*Table structure for table `oauth_refresh_tokens` */

DROP TABLE IF EXISTS `oauth_refresh_tokens`;

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_refresh_tokens` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `stok_barang` */

DROP TABLE IF EXISTS `stok_barang`;

CREATE TABLE `stok_barang` (
  `id_stok_barang` bigint(20) NOT NULL AUTO_INCREMENT,
  `kd_barang` varchar(10) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keluar` int(11) DEFAULT NULL,
  `masuk` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_stok_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `stok_barang` */

/*Table structure for table `t_barang` */

DROP TABLE IF EXISTS `t_barang`;

CREATE TABLE `t_barang` (
  `id_t_barang` bigint(20) NOT NULL AUTO_INCREMENT,
  `kd_barang` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `status_transaksi` char(2) NOT NULL COMMENT '0=keluar, 1=masuk',
  `jumlah` int(11) NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_t_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_barang` */

insert  into `t_barang`(`id_t_barang`,`kd_barang`,`tanggal`,`status_transaksi`,`jumlah`,`catatan`,`created_at`,`created_by`,`updated_by`,`deleted_by`,`updated_at`,`deleted_at`) values (1,'1','2022-03-10','1',10,'Pembelian dari Toko Cahaya','2022-03-09 19:11:55',NULL,NULL,NULL,'2022-03-09 19:11:55',NULL),(2,'1','2022-03-10','1',5,'Kiriman barang kurang','2022-03-09 19:14:03',NULL,NULL,NULL,'2022-03-09 19:14:03',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
