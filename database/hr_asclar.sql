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
  `askes` int(10) DEFAULT NULL,
  PRIMARY KEY (`kode_golongan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `golongan` */

insert  into `golongan`(`kode_golongan`,`nama_golongan`,`tunjangan_suami_istri`,`tunjangan_anak`,`uang_makan`,`uang_lembur`,`askes`) values 
('G01','K1',1000000,500000,500000,10000,125000),
('G02','K2',1250000,700000,500000,10000,125000);

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

insert  into `jabatan`(`kode_jabatan`,`nama_jabatan`,`gapok`,`tunjangan_jabatan`) values 
('H01','Project Manager',8500000,1500000),
('H02','Lead Backend Engineer',5000000,1000000),
('H03','Lead Frontend Engineer',4500000,1000000),
('H04','Backend engineer',3500000,1000000);

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
  `statuses` varchar(15) DEFAULT NULL,
  `jumlah_anak` int(2) DEFAULT NULL,
  PRIMARY KEY (`nip`),
  KEY `kode_golongan` (`kode_golongan`),
  KEY `kode_jabatan` (`kode_jabatan`),
  CONSTRAINT `pegawai_ibfk_3` FOREIGN KEY (`kode_golongan`) REFERENCES `golongan` (`kode_golongan`),
  CONSTRAINT `pegawai_ibfk_4` FOREIGN KEY (`kode_jabatan`) REFERENCES `jabatan` (`kode_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pegawai` */

insert  into `pegawai`(`nip`,`nama_pegawai`,`kode_jabatan`,`kode_golongan`,`statuses`,`jumlah_anak`) values 
('19002238','Firli','H03','G01','Belum Menikah',0),
('19002328','Widi','H01','G01','Menikah',2),
('19005566','Yoy','H02','G02','Belum Menikah',0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `idadmin` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `namalengkap` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`idadmin`,`username`,`password`,`namalengkap`) values 
(1,'user','202cb962ac59075b964b07152d234b70','administrator'),
(3,'admin','202cb962ac59075b964b07152d234b70','Jojoy'),
(5,'asd','7815696ecbf1c96e6894b779456d330e','asddddd');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
