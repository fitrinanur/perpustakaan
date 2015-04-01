/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.27 : Database - perpustakaan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`perpustakaan` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `perpustakaan`;

/*Table structure for table `anggota` */

DROP TABLE IF EXISTS `anggota`;

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_anggota` varchar(10) DEFAULT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `pekerjaan` varchar(12) DEFAULT NULL,
  `no_hp` varchar(12) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12003 DEFAULT CHARSET=latin1;

/*Data for the table `anggota` */

insert  into `anggota`(`id`,`no_anggota`,`nama`,`pekerjaan`,`no_hp`,`gambar`) values (12001,'A0001','mirza','dosen','085647257734',NULL),(12002,'A0002','arif','dosen','085647567876',NULL);

/*Table structure for table `buku` */

DROP TABLE IF EXISTS `buku`;

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `id_lokasi` int(11) DEFAULT NULL,
  `judul` varchar(25) DEFAULT NULL,
  `pengarang` varchar(25) DEFAULT NULL,
  `kuantitas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `buku_ibfk_2` (`id_lokasi`),
  CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `buku` */

insert  into `buku`(`id`,`id_lokasi`,`judul`,`pengarang`,`kuantitas`) values (123,1,'pemrograman JAVA','harrytanoe',2),(124,2,'rembulan tenggelam diwaja','tere liye',3);

/*Table structure for table `lokasi` */

DROP TABLE IF EXISTS `lokasi`;

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(10) DEFAULT NULL,
  `kuantitas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `lokasi` */

insert  into `lokasi`(`id`,`nama_lokasi`,`kuantitas`) values (1,'Rak 01',2),(2,'Rak 02',1),(3,'Rak 03',5),(4,'Rak 04',3),(5,'Rak 05',2);

/*Table structure for table `peminjaman` */

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `jumlah_buku_pinjam` int(11) DEFAULT NULL,
  `status` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_buku` (`id_buku`),
  KEY `id_transaksi` (`id_transaksi`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`),
  CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`id`,`id_buku`,`id_transaksi`,`tgl_pinjam`,`jumlah_buku_pinjam`,`status`) values (123,123,101,'2015-02-24',2,'aktif');

/*Table structure for table `pengembalian` */

DROP TABLE IF EXISTS `pengembalian`;

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `jumlah_buku_kembali` int(11) DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_peminjaman` (`id_peminjaman`),
  CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengembalian` */

insert  into `pengembalian`(`id`,`id_peminjaman`,`tgl_kembali`,`jumlah_buku_kembali`,`denda`) values (221,123,'2015-02-27',2,500);

/*Table structure for table `petugas` */

DROP TABLE IF EXISTS `petugas`;

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `no_hp` varchar(12) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `petugas` */

insert  into `petugas`(`id`,`nama`,`no_hp`,`password`) values (991,'arif','085647384234','admin');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `jenis_transaksi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_anggota` (`id_anggota`),
  KEY `id_petugas` (`id_petugas`),
  KEY `id_buku` (`id_buku`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id`),
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`),
  CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id`,`id_anggota`,`id_petugas`,`id_buku`,`tgl_transaksi`,`jenis_transaksi`) values (101,12001,991,123,'2015-02-24','pinjam');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
