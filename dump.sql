/*
SQLyog Community v12.09 (64 bit)
MySQL - 5.5.23 : Database - magnetic
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`magnetic` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `magnetic`;

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `created` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `items` */

insert  into `items`(`id`,`name`,`description`,`price`,`quantity`,`created`) values (2,'wood','oak','3324.00',324,'2016-09-06'),(3,'stone','granite','34324.00',324,'2016-09-06'),(5,'glass','crystal','234.00',12,'2016-09-08');

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `order` */

insert  into `order`(`id`,`user_id`,`adress`,`created`,`item_id`,`quantity`,`username`) values (1,1,'town','2016-09-08',2,3,'terr');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `user_ip` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`email`,`telephone`,`user_ip`,`status`) values (1,'terr','96e79218965eb72c92a549dd5a330112','terr@gmail.com','111111','127.0.0.1','admin'),(2,'admin','96e79218965eb72c92a549dd5a330112','admin@mail.com','32423432','127.0.0.1','user'),(3,'torr','96e79218965eb72c92a549dd5a330112','torr@gmail.com','43243232','127.0.0.1','user');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
