/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.8-MariaDB : Database - hr_asclar
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hr_asclar` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `hr_asclar`;

/*Table structure for table `golongan` */

DROP TABLE IF EXISTS `golongan`;

CREATE TABLE `golongan` (
  `kode_golongan` varchar(3) NOT NULL,
  `nama_golongan` varchar(10) DEFAULT NULL,
  `tunjangan_suami_istri` int(10) DEFAULT NULL,
  `tunjangan_anak` int(10) DEFAULT NULL,
  `uang_makan` int(10) DEFAULT NULL,
  `uang_lembur` int(10) DEFAULT NULL,
  `akses` int(10) DEFAULT NULL,
  PRIMARY KEY (`kode_golongan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `golongan` */

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `kode_jabatan` varchar(3) NOT NULL,
  `nama_jabatan` varchar(40) DEFAULT NULL,
  `gapok` int(10) DEFAULT NULL,
  `tunjangan_jabatan` int(10) DEFAULT NULL,
  PRIMARY KEY (`kode_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `jabatan` */

/*Table structure for table `master_gaji` */

DROP TABLE IF EXISTS `master_gaji`;

CREATE TABLE `master_gaji` (
  `bulan` varchar(20) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `masuk` int(5) DEFAULT NULL,
  `sakit` int(5) DEFAULT NULL,
  `izin` int(5) DEFAULT NULL,
  `alpha` int(5) DEFAULT NULL,
  `lembur` int(5) DEFAULT NULL,
  `potongan` int(5) DEFAULT NULL,
  KEY `nip` (`nip`),
  CONSTRAINT `master_gaji_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `master_gaji` */

/*Table structure for table `pegawai` */

DROP TABLE IF EXISTS `pegawai`;

CREATE TABLE `pegawai` (
  `nip` varchar(20) NOT NULL,
  `nama_pegawai` varchar(40) DEFAULT NULL,
  `kode_jabatan` varchar(3) DEFAULT NULL,
  `kode_golongan` varchar(3) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `jumlah_anak` int(2) DEFAULT NULL,
  PRIMARY KEY (`nip`),
  KEY `kode_jabatan` (`kode_jabatan`),
  CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`kode_jabatan`) REFERENCES `golongan` (`kode_golongan`),
  CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`kode_jabatan`) REFERENCES `jabatan` (`kode_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pegawai` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `idadmin` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `namalengkap` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`idadmin`,`username`,`password`,`namalengkap`) values 
(1,'user','202cb962ac59075b964b07152d234b70','administrator');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
