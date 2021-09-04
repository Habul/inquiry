/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.5.62 : Database - website
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`website` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `website`;

/*Table structure for table `artikel` */

DROP TABLE IF EXISTS `artikel`;

CREATE TABLE `artikel` (
  `artikel_id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel_tanggal` datetime NOT NULL,
  `artikel_judul` varchar(255) NOT NULL,
  `artikel_slug` varchar(255) NOT NULL,
  `artikel_konten` longtext NOT NULL,
  `artikel_sampul` varchar(255) NOT NULL,
  `artikel_author` int(11) NOT NULL,
  `artikel_kategori` int(11) NOT NULL,
  `artikel_status` enum('publish','draft') NOT NULL,
  PRIMARY KEY (`artikel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `artikel` */

/*Table structure for table `halaman` */

DROP TABLE IF EXISTS `halaman`;

CREATE TABLE `halaman` (
  `halaman_id` int(11) NOT NULL AUTO_INCREMENT,
  `halaman_judul` varchar(255) NOT NULL,
  `halaman_slug` varchar(255) NOT NULL,
  `halaman_konten` longtext NOT NULL,
  PRIMARY KEY (`halaman_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `halaman` */

/*Table structure for table `inquiry` */

DROP TABLE IF EXISTS `inquiry`;

CREATE TABLE `inquiry` (
  `sales` varchar(20) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `inquiry_id` int(10) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `desc` varchar(50) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `deadline` date DEFAULT NULL,
  `keter` varchar(30) DEFAULT NULL,
  `request` enum('PRICE+LT','PRICE','LT','STOCK','PRICE+LT+STOCK','COO','CATALOGUE','DESIGN') DEFAULT NULL,
  `cek` int(5) DEFAULT NULL,
  `fu1` datetime DEFAULT NULL,
  `fu2` date DEFAULT NULL,
  `fu3` date DEFAULT NULL,
  `ket_fu` varchar(20) DEFAULT NULL,
  `cogs` float(9,3) DEFAULT NULL,
  `kurs` varchar(5) DEFAULT NULL,
  `cogs_idr` int(15) DEFAULT NULL,
  `reseller` int(15) DEFAULT NULL,
  `new_seller` int(15) DEFAULT NULL,
  `user` int(15) DEFAULT NULL,
  `delivery` varchar(20) DEFAULT NULL,
  `ket_purch` varchar(50) DEFAULT NULL,
  `diff` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`inquiry_id`),
  KEY `no_inq` (`inquiry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `inquiry` */

insert  into `inquiry`(`sales`,`tanggal`,`inquiry_id`,`brand`,`desc`,`qty`,`deadline`,`keter`,`request`,`cek`,`fu1`,`fu2`,`fu3`,`ket_fu`,`cogs`,`kurs`,`cogs_idr`,`reseller`,`new_seller`,`user`,`delivery`,`ket_purch`,`diff`) values 
('IT','2021-09-01 09:51:00',18725,'STAUFF','a3332dfd',1,'2021-09-30','test','STOCK',1,'2021-09-02 00:00:00','2021-09-02','2021-09-02','tetete',1.000,'EURO',1111,1132,12232,1212,'18 weeks','tetetet',NULL),
('IT','2021-09-01 09:52:22',18726,'EATON AIRFLEX','DDSDSD2',2,'2021-09-01','WWWW','PRICE+LT+STOCK',1,'2021-09-02 00:00:00','2021-09-02','2021-09-02','aaaaa',12121.102,'EUR',212232323,23223232,12121121,1212121,'18 weeks','testtt',NULL),
('IT','2021-09-01 10:03:38',18727,'STAUFF','sdjshjskdjskl',4,'2021-09-30','testt4','PRICE+LT+STOCK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('IT','2021-09-01 10:06:32',18728,'EATON VICKERS','A14SDSD3',5,'2021-09-30','TYRERER','PRICE+LT+STOCK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('IT','2021-09-01 10:08:26',18729,'EATON JEIL','TEEWRERE',6,'2021-09-01','test','PRICE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('IT','2021-09-01 10:08:58',18730,'EATON AEROQUIP','testtt',6,'2021-09-30','3424','PRICE+LT+STOCK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('IT','2021-09-01 13:48:46',18731,'EATON MOELLER','sfaasdsd',5,'2021-09-01','tested','PRICE+LT+STOCK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('IT','2021-09-01 13:49:10',18732,'EATON','eatonns new bos',4,'2021-09-01','tttt','STOCK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('IT','2021-09-02 13:43:12',18733,'EATON JEIL','ttttt',2,'2021-09-02','testt','PRICE+LT+STOCK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('IT','2021-09-02 16:35:55',18734,'INTEGRAL','a343trer34f',2,'2021-09-02','test note text area','PRICE+LT+STOCK',6,'2021-09-04 10:05:11',NULL,NULL,'gurararar',1.000,'EUR',212,111,222,1112,'23 WEEKS','TEST',NULL),
('IT','2021-09-03 11:17:24',18735,'NACOL','tttt',1,'2021-09-03','tested','PRICE+LT',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('IT','2021-09-03 14:03:24',18736,'STAUFF','A244343DFDF',2,'2021-09-03','TEST TEST TEST TEST TEST TEST ','STOCK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_nama` varchar(255) NOT NULL,
  `kategori_slug` varchar(255) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `kategori` */

insert  into `kategori`(`kategori_id`,`kategori_nama`,`kategori_slug`) values 
(16,'Email','email');

/*Table structure for table `pengaturan` */

DROP TABLE IF EXISTS `pengaturan`;

CREATE TABLE `pengaturan` (
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `link_facebook` varchar(255) NOT NULL,
  `link_twitter` varchar(255) NOT NULL,
  `link_instagram` varchar(255) NOT NULL,
  `link_github` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pengaturan` */

insert  into `pengaturan`(`nama`,`deskripsi`,`logo`,`link_facebook`,`link_twitter`,`link_instagram`,`link_github`) values 
('IT','Intisera','PNG-LOGO1.gif','https://www.facebook.com/h4bul/','#','#','https://github.com/habul');

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `pengguna_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengguna_nama` varchar(50) NOT NULL,
  `pengguna_email` varchar(255) NOT NULL,
  `pengguna_username` varchar(50) NOT NULL,
  `pengguna_password` varchar(255) NOT NULL,
  `pengguna_level` enum('admin','penulis','purchase','sales') NOT NULL,
  `pengguna_status` int(11) NOT NULL,
  PRIMARY KEY (`pengguna_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

/*Data for the table `pengguna` */

insert  into `pengguna`(`pengguna_id`,`pengguna_nama`,`pengguna_email`,`pengguna_username`,`pengguna_password`,`pengguna_level`,`pengguna_status`) values 
(1,'IT','it-div@dutaflow.com','admin','f671d5387c2cdad4c324b13b5f89750b','admin',1),
(36,'LIA','aku@dutaflow.com','lia','e10adc3949ba59abbe56e057f20f883e','purchase',1),
(37,'DANNI','aku@dutaflow.com','dani','e10adc3949ba59abbe56e057f20f883e','purchase',1),
(38,'ELFRI','aku@dutaflow.com','elfri','e10adc3949ba59abbe56e057f20f883e','purchase',1),
(39,'MAYENTI','aku@dutaflow.com','mayenti','e10adc3949ba59abbe56e057f20f883e','purchase',1),
(40,'PETER','aku@dutaflow.com','peter','e10adc3949ba59abbe56e057f20f883e','sales',1),
(41,'HERMAN','aku@dutaflow.com','herman','e10adc3949ba59abbe56e057f20f883e','sales',1),
(42,'FANNY','aku@dutaflow.com','fanny','e10adc3949ba59abbe56e057f20f883e','sales',1),
(43,'RIKI','aku@dutaflow.com','riki','e10adc3949ba59abbe56e057f20f883e','sales',1),
(44,'LINDA','aku@dutaflow.com','linda','e10adc3949ba59abbe56e057f20f883e','sales',1),
(45,'YUDHA','aku@dutaflow.com','yudha','e10adc3949ba59abbe56e057f20f883e','sales',1),
(46,'KRISTINA','aku@dutaflow.com','kristina','e10adc3949ba59abbe56e057f20f883e','sales',1),
(47,'DESI','aku@dutaflow.com','desi','e10adc3949ba59abbe56e057f20f883e','sales',1),
(48,'REGINA','aku@dutaflow.com','regina','e10adc3949ba59abbe56e057f20f883e','sales',1),
(49,'BELLA','aku@dutaflow.com','bella','e10adc3949ba59abbe56e057f20f883e','sales',1),
(50,'NINA','aku@dutaflow.com','nina','e10adc3949ba59abbe56e057f20f883e','sales',1),
(51,'YENNI','aku@dutaflow.com','yenni','e10adc3949ba59abbe56e057f20f883e','sales',1),
(52,'DEDE','aku@dutaflow.com','dede','e10adc3949ba59abbe56e057f20f883e','sales',1),
(53,'FITRI','aku@dutaflow.com','fitri','e10adc3949ba59abbe56e057f20f883e','sales',1),
(54,'RAHMAD','aku@dutaflow.com','rahmad','e10adc3949ba59abbe56e057f20f883e','sales',1),
(55,'LENI','aku@dutaflow.com','leni','e10adc3949ba59abbe56e057f20f883e','sales',1),
(56,'MELDA','aku@dutaflow.com','melda','e10adc3949ba59abbe56e057f20f883e','sales',1),
(57,'RANDI','aku@dutaflow.com','randi','e10adc3949ba59abbe56e057f20f883e','sales',1),
(58,'NELI','aku@dutaflow.com','neli','e10adc3949ba59abbe56e057f20f883e','sales',1),
(59,'FLORENSIA','aku@dutaflow.com','florensia','e10adc3949ba59abbe56e057f20f883e','sales',1),
(60,'LEVY','aku@dutaflow.com','levy','e10adc3949ba59abbe56e057f20f883e','sales',1),
(61,'HENRY','aku@dutaflow.com','henry','e10adc3949ba59abbe56e057f20f883e','purchase',1),
(62,'WIDIYANTO','aku@dutaflow.com','widi','e10adc3949ba59abbe56e057f20f883e','sales',1),
(63,'testttt','agnesnur@gmail.com','test','c56dc3579662f54af4bc60f8011d8f33','penulis',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
