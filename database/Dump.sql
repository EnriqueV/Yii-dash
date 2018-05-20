CREATE DATABASE  IF NOT EXISTS `piscos_admin` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `piscos_admin`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: piscos_admin
-- ------------------------------------------------------
-- Server version	5.6.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `AuthAssignment`
--

DROP TABLE IF EXISTS `AuthAssignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthAssignment`
--

LOCK TABLES `AuthAssignment` WRITE;
/*!40000 ALTER TABLE `AuthAssignment` DISABLE KEYS */;
INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES ('Admin','1',NULL,'N;'),('Cliente','14',NULL,'N;'),('Cliente','15',NULL,'N;'),('Cliente','3',NULL,'N;'),('Usuario','16',NULL,'N;'),('Usuario','17',NULL,'N;'),('Usuario','18',NULL,'N;'),('Usuario','19',NULL,'N;'),('Usuario','2',NULL,'N;'),('Usuario','37',NULL,'N;'),('Usuario','38',NULL,'N;'),('Usuario','39',NULL,'N;'),('Usuario','40',NULL,'N;'),('Usuario','42',NULL,'N;');
/*!40000 ALTER TABLE `AuthAssignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AuthItem`
--

DROP TABLE IF EXISTS `AuthItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthItem`
--

LOCK TABLES `AuthItem` WRITE;
/*!40000 ALTER TABLE `AuthItem` DISABLE KEYS */;
INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES ('Admin',2,NULL,NULL,'N;'),('Cliente',2,'-',NULL,'N;'),('Pisco.Pictures',0,NULL,NULL,'N;'),('Usuario',2,'-',NULL,'N;');
/*!40000 ALTER TABLE `AuthItem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AuthItemChild`
--

DROP TABLE IF EXISTS `AuthItemChild`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthItemChild`
--

LOCK TABLES `AuthItemChild` WRITE;
/*!40000 ALTER TABLE `AuthItemChild` DISABLE KEYS */;
INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES ('Cliente','Pisco.Pictures'),('Usuario','Pisco.Pictures');
/*!40000 ALTER TABLE `AuthItemChild` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Rights`
--

DROP TABLE IF EXISTS `Rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Rights`
--

LOCK TABLES `Rights` WRITE;
/*!40000 ALTER TABLE `Rights` DISABLE KEYS */;
/*!40000 ALTER TABLE `Rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `imageUrl` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner`
--

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_cupones`
--

DROP TABLE IF EXISTS `categorias_cupones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias_cupones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_cupones`
--

LOCK TABLES `categorias_cupones` WRITE;
/*!40000 ALTER TABLE `categorias_cupones` DISABLE KEYS */;
INSERT INTO `categorias_cupones` (`id`, `nombre`) VALUES (2,'Cafes');
/*!40000 ALTER TABLE `categorias_cupones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_noticia`
--

DROP TABLE IF EXISTS `categorias_noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias_noticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_noticia`
--

LOCK TABLES `categorias_noticia` WRITE;
/*!40000 ALTER TABLE `categorias_noticia` DISABLE KEYS */;
INSERT INTO `categorias_noticia` (`id`, `nombre`) VALUES (3,'Nacionales');
/*!40000 ALTER TABLE `categorias_noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codigos_recuperar_clave`
--

DROP TABLE IF EXISTS `codigos_recuperar_clave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codigos_recuperar_clave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(128) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `expiracion` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_recuperar_clave_user_id_fk_idx` (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codigos_recuperar_clave`
--

LOCK TABLES `codigos_recuperar_clave` WRITE;
/*!40000 ALTER TABLE `codigos_recuperar_clave` DISABLE KEYS */;
INSERT INTO `codigos_recuperar_clave` (`id`, `codigo`, `userId`, `expiracion`) VALUES (11,'a56a0b8de03116edc52acb9c3282c705',39,'2017-12-07');
/*!40000 ALTER TABLE `codigos_recuperar_clave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contenido`
--

DROP TABLE IF EXISTS `contenido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contenido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(65) DEFAULT NULL,
  `texto` text,
  `tipo` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contenido`
--

LOCK TABLES `contenido` WRITE;
/*!40000 ALTER TABLE `contenido` DISABLE KEYS */;
INSERT INTO `contenido` (`id`, `titulo`, `texto`, `tipo`) VALUES (2,'Historia','Somos un grupo de amigos y empresarios que compartimos el orgullo, el amor y la pasión por el Pisco, la gastronomía y la cultura Peruana.','historia');
/*!40000 ALTER TABLE `contenido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cupones_codigos_generados`
--

DROP TABLE IF EXISTS `cupones_codigos_generados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cupones_codigos_generados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(75) NOT NULL,
  `cupon_descuento_id` int(11) NOT NULL COMMENT 'Esta columna no sera relacionada ya que el cupon puede ser borrado en algun momento.',
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cupones_codigo_generados_user_id_fk_idx` (`userId`),
  CONSTRAINT `cupones_codigo_generados_user_id_fk` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cupones_codigos_generados`
--

LOCK TABLES `cupones_codigos_generados` WRITE;
/*!40000 ALTER TABLE `cupones_codigos_generados` DISABLE KEYS */;
INSERT INTO `cupones_codigos_generados` (`id`, `codigo`, `cupon_descuento_id`, `userId`) VALUES (3,'testeste3',10,1),(5,'12345',10,1);
/*!40000 ALTER TABLE `cupones_codigos_generados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cupones_descuento`
--

DROP TABLE IF EXISTS `cupones_descuento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cupones_descuento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `imageUrl` varchar(250) NOT NULL,
  `descripcion` text,
  `piscoId` int(11) NOT NULL,
  `categoriaId` int(11) NOT NULL,
  `expirationDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `piscoIdFK_idx` (`piscoId`),
  KEY `cuponesDescuentoCategoriaCuponFk_idx` (`categoriaId`),
  CONSTRAINT `cuponesDescuentoCategoriaCuponFk` FOREIGN KEY (`categoriaId`) REFERENCES `categorias_cupones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cuponesDescuentopiscoIdFK` FOREIGN KEY (`piscoId`) REFERENCES `pisco` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cupones_descuento`
--

LOCK TABLES `cupones_descuento` WRITE;
/*!40000 ALTER TABLE `cupones_descuento` DISABLE KEYS */;
INSERT INTO `cupones_descuento` (`id`, `name`, `imageUrl`, `descripcion`, `piscoId`, `categoriaId`, `expirationDate`) VALUES (6,'CuponTest','1792_test.jpeg','',3,2,'0000-00-00 00:00:00'),(7,'CuponTest2','7059_test.jpg','Una descripcion',3,2,'0000-00-00 00:00:00'),(9,'CuponTest2','7525_test.jpg','xcxcxcxcxcxc',3,2,'2012-04-20 00:00:00'),(10,'CuponTest2','2063_test.jpg','sdsdsdsdsdsd',3,2,'2018-03-08 07:03:00'),(12,'CuponTest2','6502_test.jpg','una ddescrpcion',3,2,'2018-03-08 08:16:00');
/*!40000 ALTER TABLE `cupones_descuento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `piscoId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `favoritosPiscoId_idx` (`piscoId`),
  KEY `favoritosUserId_idx` (`userId`),
  CONSTRAINT `favoritosPiscoId` FOREIGN KEY (`piscoId`) REFERENCES `pisco` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `favoritosUserId` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoritos`
--

LOCK TABLES `favoritos` WRITE;
/*!40000 ALTER TABLE `favoritos` DISABLE KEYS */;
/*!40000 ALTER TABLE `favoritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotos`
--

DROP TABLE IF EXISTS `fotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(400) NOT NULL,
  `esPrincipal` tinyint(4) DEFAULT '0',
  `piscoId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `piscoIdFk_idx` (`piscoId`),
  CONSTRAINT `fotosPiscoIdFk` FOREIGN KEY (`piscoId`) REFERENCES `pisco` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotos`
--

LOCK TABLES `fotos` WRITE;
/*!40000 ALTER TABLE `fotos` DISABLE KEYS */;
INSERT INTO `fotos` (`id`, `url`, `esPrincipal`, `piscoId`) VALUES (1,'1245_peru.jpg',1,3);
/*!40000 ALTER TABLE `fotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastronomia`
--

DROP TABLE IF EXISTS `gastronomia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastronomia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `piscoId` int(11) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `imageUrl` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gastronomia_pisco_fk_idx` (`piscoId`),
  CONSTRAINT `gastronomia_pisco_fk` FOREIGN KEY (`piscoId`) REFERENCES `pisco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastronomia`
--

LOCK TABLES `gastronomia` WRITE;
/*!40000 ALTER TABLE `gastronomia` DISABLE KEYS */;
INSERT INTO `gastronomia` (`id`, `piscoId`, `titulo`, `descripcion`, `imageUrl`) VALUES (2,2,'Un titulo2','Una texto2','1428_test.jpg');
/*!40000 ALTER TABLE `gastronomia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dia` enum('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo') NOT NULL,
  `horaInicial` varchar(45) NOT NULL,
  `horaFinal` varchar(45) NOT NULL,
  `piscoId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `piscoIdFK_idx` (`piscoId`),
  CONSTRAINT `horariosPiscoIdFK` FOREIGN KEY (`piscoId`) REFERENCES `pisco` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` (`id`, `dia`, `horaInicial`, `horaFinal`, `piscoId`) VALUES (8,'Lunes','0:00','0:00',2),(9,'Martes','0:00','0:00',2),(10,'Miercoles','0:00','0:00',2),(11,'Jueves','0:00','0:00',2),(12,'Viernes','0:00','0:00',2),(13,'Sabado','0:00','0:00',2),(14,'Domingo','0:00','0:00',2),(15,'Lunes','0:00','0:00',3),(16,'Martes','0:00','0:00',3),(17,'Miercoles','0:00','0:00',3),(18,'Jueves','0:00','0:00',3),(19,'Viernes','0:00','0:00',3),(20,'Sabado','0:00','0:00',3),(21,'Domingo','0:00','0:00',3);
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `miembro`
--

DROP TABLE IF EXISTS `miembro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `miembro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `imageUrl` varchar(350) NOT NULL,
  `posicion` int(11) NOT NULL DEFAULT '1',
  `biografia` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `miembro`
--

LOCK TABLES `miembro` WRITE;
/*!40000 ALTER TABLE `miembro` DISABLE KEYS */;
INSERT INTO `miembro` (`id`, `nombre`, `imageUrl`, `posicion`, `biografia`) VALUES (4,'Lucero Villagarcia','3308_LUCERO VILLAGARCIA.jpg',1,''),(5,'Hans Hillburg','264_HANS HILBURG.jpg',2,''),(6,'Ricardo Villanueva','7353_RICARDO VILLANUEVA.jpg',3,''),(7,'Juan Yuki <br>Nakandakari','2356_JUAN YUKI NAKANDAKARI.jpg',5,''),(8,'Elizabeth <br>Changanaqui','8402_ELIZABETH CHANGANAQUI.jpg',6,''),(9,'Manuel Cadenas <br>Mújica','8660_manuel-cadenas-mujica.jpg',4,'');
/*!40000 ALTER TABLE `miembro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia`
--

DROP TABLE IF EXISTS `noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(75) NOT NULL,
  `text` text NOT NULL,
  `creado` datetime DEFAULT NULL,
  `categoriaId` int(11) NOT NULL,
  `imageUrl` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryId_idx` (`categoriaId`),
  CONSTRAINT `noticiasCategoryId` FOREIGN KEY (`categoriaId`) REFERENCES `categorias_noticia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia`
--

LOCK TABLES `noticia` WRITE;
/*!40000 ALTER TABLE `noticia` DISABLE KEYS */;
INSERT INTO `noticia` (`id`, `titulo`, `text`, `creado`, `categoriaId`, `imageUrl`) VALUES (1,'testes','Una pruba de texto','2017-11-19 20:01:27',3,'5068_test.jpeg'),(2,'Festividades y eventos','Herederos de culturas nativas y europeas, Perú mantiene vigente una diversidad de fiestas y tradiciones que conforman el patrimonio cultural. Un sinfín de eventos y festivales a través de todo el año prestan color y sabor a nuestro día a día, con celebraciones que, entre vibrantes bailes y actos de profunda devoción religiosa, llenan la vida peruana de pasión y felicidad.','2017-11-22 09:41:57',3,'7650_phone.jpg'),(3,'Loremp','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis malesuada eros, vitae placerat augue. Phasellus ac semper risus. Cras eros orci, tincidunt non ultricies vel, molestie eget tortor.','2017-11-22 10:17:41',3,'2413_peru.jpg'),(4,'Nocia de Prueba','fasfsfsafsafasfsafsafasfasfasfsafafaafsfasfasfasfasfasfasfas\r\nafsfasfasfasfasafsfasafsafsafsfas\r\nafsafsfasfasfasafsafs\r\nafsfasfasafsafsafsafsafsafsfasafsfasfasfasafsafsafsafsafsfasafs\r\n\r\nfafasafsafsfsafasafsafsafsafsfs','2018-02-22 18:34:54',3,'4330_logo_PiscoMagic.png');
/*!40000 ALTER TABLE `noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pisco`
--

DROP TABLE IF EXISTS `pisco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pisco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `latitud` varchar(400) DEFAULT NULL,
  `longitud` varchar(400) DEFAULT NULL,
  `telefono` varchar(75) DEFAULT NULL,
  `direccion` text,
  `web` varchar(150) DEFAULT NULL,
  `activo` tinyint(4) NOT NULL,
  `userId` int(11) NOT NULL,
  `ratingGeneral` int(11) DEFAULT '0',
  `youtubeUrl` varchar(45) DEFAULT NULL,
  `esDestacado` tinyint(4) NOT NULL,
  `aprobado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userIdFK_idx` (`userId`),
  CONSTRAINT `userIdFK` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pisco`
--

LOCK TABLES `pisco` WRITE;
/*!40000 ALTER TABLE `pisco` DISABLE KEYS */;
INSERT INTO `pisco` (`id`, `name`, `latitud`, `longitud`, `telefono`, `direccion`, `web`, `activo`, `userId`, `ratingGeneral`, `youtubeUrl`, `esDestacado`, `aprobado`) VALUES (2,'nombrepisco','','','','','',1,3,0,'',0,1),(3,'Pisco Test','40.7127837','74.0059413','899121-12','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis malesuada eros, vitae placerat augue. Phasellus ac semper risus. Cras eros orci, tincidunt non ultricies vel, molestie eget tortor.','http://dcsocialmarketing.com/',1,3,0,'https://www.youtube.com/watch?v=fM2qXRkwkiI',0,1);
/*!40000 ALTER TABLE `pisco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` (`user_id`, `lastname`, `firstname`) VALUES (1,'Admin','Administrator'),(3,'---','Cliente Usuario'),(39,'Calderon','Hugo Alberto'),(40,'Valencia','Eduardo');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles_fields`
--

DROP TABLE IF EXISTS `profiles_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles_fields`
--

LOCK TABLES `profiles_fields` WRITE;
/*!40000 ALTER TABLE `profiles_fields` DISABLE KEYS */;
INSERT INTO `profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES (1,'lastname','Last Name','VARCHAR','50','3',1,'','','Incorrect Last Name (length between 3 and 50 characters).','','','','',1,3),(2,'firstname','First Name','VARCHAR','50','3',1,'','','Incorrect First Name (length between 3 and 50 characters).','','','','',0,3);
/*!40000 ALTER TABLE `profiles_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radio`
--

DROP TABLE IF EXISTS `radio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urlRadio` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radio`
--

LOCK TABLES `radio` WRITE;
/*!40000 ALTER TABLE `radio` DISABLE KEYS */;
/*!40000 ALTER TABLE `radio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telefono` varchar(75) DEFAULT NULL,
  `activkey` varchar(128) NOT NULL,
  `create_at` datetime NOT NULL,
  `lastvisit_at` datetime DEFAULT NULL,
  `superuser` int(1) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `android_id` varchar(450) DEFAULT NULL,
  `iphone_id` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `email`, `telefono`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`, `android_id`, `iphone_id`) VALUES (1,'admin','d9fed96a754062af163ede7504bf20c2','hugo.calderon@503consulting.com','-','2f8016d006a69a0d6247c4832147eb52','2014-09-15 15:48:10','2018-03-08 01:01:43',1,1,'NULL',NULL),(3,'cliente','d9fed96a754062af163ede7504bf20c2','albert.hugo1@hotmail.com',NULL,'040b38c9a9d0773e150265cf2b9d9498','2017-10-16 19:33:46','2018-03-08 05:41:25',2,1,NULL,NULL),(39,'albert.hugo','d9fed96a754062af163ede7504bf20c2','albert.hugo@hotmail.com','12345678','b4f5152e72c1552d690cde6af5ac0e0d','2017-12-07 17:19:18','0000-00-00 00:00:00',3,1,NULL,NULL),(40,'daiki','9ad314078ecdebabed235b0fda1e8594','kalienrique40@gmail.com',NULL,'00dad08eaeeadcce4db6596057af2f28','2018-02-22 20:14:52','0000-00-00 00:00:00',1,0,NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'piscos_admin'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-08 14:28:43
