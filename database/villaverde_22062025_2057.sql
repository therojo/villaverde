-- MySQL dump 10.13  Distrib 5.7.39, for Linux (x86_64)
--
-- Host: localhost    Database: villaverde
-- ------------------------------------------------------
-- Server version	5.7.39

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
-- Table structure for table `Calles`
--

DROP TABLE IF EXISTS `Calles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Calles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Calles`
--

LOCK TABLES `Calles` WRITE;
/*!40000 ALTER TABLE `Calles` DISABLE KEYS */;
INSERT INTO `Calles` VALUES (1,'Amarantos','2025-05-15 20:41:44'),(2,'Aralias','2025-05-15 20:41:49'),(3,'Jarales','2025-05-15 20:41:55'),(4,'Villa Verde','2025-05-15 20:42:00'),(5,'Oyamel','2025-05-15 20:42:03'),(6,'Tule','2025-05-15 20:42:06'),(7,'Tulias','2025-05-15 20:42:10');
/*!40000 ALTER TABLE `Calles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Chips`
--

DROP TABLE IF EXISTS `Chips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Chips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(10) DEFAULT NULL,
  `estatus` enum('activo','inactivo') DEFAULT NULL,
  `placas` varchar(12) DEFAULT NULL,
  `modelo` int(11) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idInmuebleColono` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `chips_idInmuebleColono_fkey` (`idInmuebleColono`),
  CONSTRAINT `chips_idInmuebleColono_fkey` FOREIGN KEY (`idInmuebleColono`) REFERENCES `InmueblesColonos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Chips`
--

LOCK TABLES `Chips` WRITE;
/*!40000 ALTER TABLE `Chips` DISABLE KEYS */;
INSERT INTO `Chips` VALUES (1,'109','activo','',0,'','','2025-06-22 01:09:55','2025-06-22 01:09:55',1),(2,'110','activo',NULL,NULL,NULL,'','2025-06-22 01:10:18','2025-06-22 01:10:18',1),(3,'103','activo',NULL,NULL,NULL,'','2025-06-21 18:24:10','2025-06-21 18:24:10',4),(4,'104','activo',NULL,NULL,NULL,'','2025-06-21 18:24:10','2025-06-21 18:24:10',6),(5,'105','activo',NULL,NULL,NULL,'','2025-06-21 20:20:41','2025-06-21 20:20:41',4),(6,'6','activo',NULL,NULL,NULL,'','2025-06-21 20:22:38','2025-06-21 20:22:38',6),(7,'106','activo',NULL,NULL,NULL,'','2025-06-21 20:23:41','2025-06-21 20:23:41',3),(8,'133','activo',NULL,NULL,NULL,'','2025-06-22 01:13:35','2025-06-22 01:13:35',5),(9,'112','activo',NULL,NULL,NULL,'','2025-06-22 01:14:19','2025-06-22 01:14:19',6);
/*!40000 ALTER TABLE `Chips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Colonos`
--

DROP TABLE IF EXISTS `Colonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Colonos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido1` varchar(50) DEFAULT NULL,
  `apellido2` varchar(30) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `fechaSalida` date DEFAULT NULL,
  `estatus` enum('activo','inactivo') DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Colonos`
--

LOCK TABLES `Colonos` WRITE;
/*!40000 ALTER TABLE `Colonos` DISABLE KEYS */;
INSERT INTO `Colonos` VALUES (1,'profe','Ramirez','gallo','492248777','chinto@gmail.com',NULL,'activo','2025-05-15 20:08:07','2025-05-15 20:08:07'),(2,'Miguel','Sanchez','Ramirez','49258888','notiene@gmail.com',NULL,'activo','2025-06-21 01:11:25','2025-06-21 01:11:25'),(3,'Manuel','Sanchez','Palacios','492587777','nohay@gmail.com',NULL,'activo','2025-06-21 01:11:49','2025-06-21 01:11:49'),(4,'Don Rodo','Garcia','Renteria','492877777','nohay@gmail.com',NULL,'activo','2025-06-21 01:11:42','2025-06-21 01:11:42'),(5,'Genaro','Mendez','','492587777','',NULL,'activo','2025-05-17 20:42:22','2025-05-17 20:42:22'),(6,'super','','','','super@gmail.com',NULL,'activo','2025-06-05 00:52:05','2025-06-05 00:52:05'),(7,'Artemio','Martinez','','4925887787','',NULL,'activo','2025-06-22 01:17:57','2025-06-22 01:17:57'),(8,'Jaman','red','blue','498777888','',NULL,'activo','2025-06-22 01:21:47','2025-06-22 01:21:47');
/*!40000 ALTER TABLE `Colonos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Condonaciones`
--

DROP TABLE IF EXISTS `Condonaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Condonaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `justificacion` varchar(50) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Condonaciones`
--

LOCK TABLES `Condonaciones` WRITE;
/*!40000 ALTER TABLE `Condonaciones` DISABLE KEYS */;
INSERT INTO `Condonaciones` VALUES (1,'por algo','2025-05-30 02:14:15','2025-05-30 02:14:15',1);
/*!40000 ALTER TABLE `Condonaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DetallePagos`
--

DROP TABLE IF EXISTS `DetallePagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DetallePagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double DEFAULT NULL,
  `estatus` enum('activo','cancelado') DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL,
  `idPago` int(11) NOT NULL,
  `idMes` int(11) NOT NULL,
  `idEjercicio` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detallePagos_idPago_fkey` (`idPago`),
  KEY `detallePagos_idMes_fkey` (`idMes`),
  KEY `detallePagos_idEjercicio_fkey` (`idEjercicio`),
  CONSTRAINT `detallePagos_idEjercicio_fkey` FOREIGN KEY (`idEjercicio`) REFERENCES `Ejercicios` (`id`),
  CONSTRAINT `detallePagos_idMes_fkey` FOREIGN KEY (`idMes`) REFERENCES `Meses` (`id`),
  CONSTRAINT `detallePagos_idPago_fkey` FOREIGN KEY (`idPago`) REFERENCES `Pagos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DetallePagos`
--

LOCK TABLES `DetallePagos` WRITE;
/*!40000 ALTER TABLE `DetallePagos` DISABLE KEYS */;
INSERT INTO `DetallePagos` VALUES (1,500,'activo',NULL,1,3,1),(2,250,'activo',NULL,2,6,1),(3,250,'activo',NULL,2,7,1),(4,250,'activo',NULL,3,8,1),(5,250,'activo',NULL,3,9,1),(6,250,'activo',NULL,3,10,1),(7,250,'activo',NULL,3,11,1),(8,250,'activo',NULL,3,12,1),(9,250,'activo',NULL,4,4,1),(10,250,'activo',NULL,4,5,1),(11,250,'activo',NULL,4,6,1),(12,250,'activo',NULL,4,7,1),(13,250,'activo',NULL,4,8,1),(14,250,'activo',NULL,4,9,1),(15,250,'activo',NULL,5,5,1),(16,250,'activo',NULL,5,6,1),(17,250,'activo',NULL,5,7,1),(18,250,'activo',NULL,6,10,1),(19,250,'activo',NULL,7,6,1),(20,250,'activo',NULL,7,7,1),(21,250,'activo',NULL,8,1,2),(22,250,'activo',NULL,9,11,1),(23,250,'activo',NULL,9,12,1),(24,250,'activo',NULL,9,1,2),(25,250,'activo',NULL,9,2,2);
/*!40000 ALTER TABLE `DetallePagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Egresos`
--

DROP TABLE IF EXISTS `Egresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Egresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `total` double DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `estatus` enum('pagado','cancelado') DEFAULT 'pagado',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idPartida` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `egresos_idPartida_fkey` (`idPartida`),
  KEY `egresos_idUsuario_fkey` (`idUsuario`),
  CONSTRAINT `egresos_idPartida_fkey` FOREIGN KEY (`idPartida`) REFERENCES `Partidas` (`id`),
  CONSTRAINT `egresos_idUsuario_fkey` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Egresos`
--

LOCK TABLES `Egresos` WRITE;
/*!40000 ALTER TABLE `Egresos` DISABLE KEYS */;
INSERT INTO `Egresos` VALUES (1,'2025-06-22',1500,'pagoa a fernando','pagado','2025-06-23 02:15:57',1,1),(2,'2025-06-22',3200,'agua','pagado','2025-06-23 02:32:53',1,1),(3,'2025-06-23',2800,'algo mas ','pagado','2025-06-23 02:39:36',1,1);
/*!40000 ALTER TABLE `Egresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ejercicios`
--

DROP TABLE IF EXISTS `Ejercicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ejercicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(45) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `estatus` enum('activo','inactivo') DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ejercicios_idUsuario_fkey` (`idUsuario`),
  CONSTRAINT `ejercicios_idUsuario_fkey` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ejercicios`
--

LOCK TABLES `Ejercicios` WRITE;
/*!40000 ALTER TABLE `Ejercicios` DISABLE KEYS */;
INSERT INTO `Ejercicios` VALUES (1,'2025','nada','activo','2025-05-15 19:53:18',1),(2,'2026','','inactivo','2025-06-03 17:36:37',1);
/*!40000 ALTER TABLE `Ejercicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Inmuebles`
--

DROP TABLE IF EXISTS `Inmuebles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Inmuebles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `numeroInterior` varchar(10) DEFAULT NULL,
  `observaciones` varchar(150) DEFAULT NULL,
  `asignado` enum('si','no') DEFAULT NULL,
  `tipo` enum('casa','terreno','baldio') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idCalle` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inmuebles_idCalle_fkey` (`idCalle`),
  KEY `inmuebles_idUsuario_fkey` (`idUsuario`),
  CONSTRAINT `inmuebles_idCalle_fkey` FOREIGN KEY (`idCalle`) REFERENCES `Calles` (`id`),
  CONSTRAINT `inmuebles_idUsuario_fkey` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Inmuebles`
--

LOCK TABLES `Inmuebles` WRITE;
/*!40000 ALTER TABLE `Inmuebles` DISABLE KEYS */;
INSERT INTO `Inmuebles` VALUES (1,217,'','Esquina al tren','si','casa','2025-05-17 20:46:32',1,1),(2,225,'','Vecina','si','casa','2025-05-19 20:54:31',1,1),(3,105,'','','si','casa','2025-05-17 20:46:32',3,1),(4,1,'','En tule','si','casa','2025-06-22 01:46:38',6,1),(5,220,'','Ninguna','si',NULL,'2025-05-19 20:50:22',1,1),(6,123,'','','si',NULL,'2025-06-02 19:35:25',3,1),(7,25,'','','si',NULL,'2025-06-07 23:03:33',5,2),(8,105,'','','si',NULL,'2025-06-22 01:36:44',6,2);
/*!40000 ALTER TABLE `Inmuebles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `InmueblesColonos`
--

DROP TABLE IF EXISTS `InmueblesColonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `InmueblesColonos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicio` date DEFAULT NULL,
  `fechaSalidaColonia` date DEFAULT NULL,
  `estatus` enum('activo','inactivo') DEFAULT NULL,
  `alCorriente` enum('si','no') DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idColono` int(11) NOT NULL,
  `idInmueble` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inmueblesColonos_idColono_fkey` (`idColono`),
  KEY `inmueblesColonos_idInmueble_fkey` (`idInmueble`),
  KEY `inmueblesColonos_idUsuario_fkey` (`idUsuario`),
  CONSTRAINT `inmueblesColonos_idColono_fkey` FOREIGN KEY (`idColono`) REFERENCES `Colonos` (`id`),
  CONSTRAINT `inmueblesColonos_idInmueble_fkey` FOREIGN KEY (`idInmueble`) REFERENCES `Inmuebles` (`id`),
  CONSTRAINT `inmueblesColonos_idUsuario_fkey` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InmueblesColonos`
--

LOCK TABLES `InmueblesColonos` WRITE;
/*!40000 ALTER TABLE `InmueblesColonos` DISABLE KEYS */;
INSERT INTO `InmueblesColonos` VALUES (1,'2025-06-01',NULL,'activo','si','2025-05-24 17:17:06','2025-05-24 17:17:06',2,1,1),(2,'2025-05-24',NULL,'activo','si','2025-05-25 01:52:28','2025-05-25 01:52:28',4,3,1),(3,'2025-05-24',NULL,'activo','no','2025-05-25 01:52:28','2025-05-25 01:52:28',4,4,1),(4,'2025-05-24',NULL,'activo','si','2025-05-25 01:52:28','2025-05-25 01:52:28',1,2,1),(5,'2025-03-01',NULL,'activo','si','2025-06-02 19:36:18','2025-06-02 19:36:18',3,6,1),(6,'2025-06-07',NULL,'activo','si','2025-06-07 23:03:33','2025-06-07 23:03:33',5,7,2),(7,'2025-06-22',NULL,'activo','si','2025-06-22 01:36:44','2025-06-22 01:36:44',4,8,2),(8,'2025-06-22',NULL,'activo','si','2025-06-22 01:46:38','2025-06-22 01:46:38',1,4,2);
/*!40000 ALTER TABLE `InmueblesColonos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Meses`
--

DROP TABLE IF EXISTS `Meses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Meses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Meses`
--

LOCK TABLES `Meses` WRITE;
/*!40000 ALTER TABLE `Meses` DISABLE KEYS */;
INSERT INTO `Meses` VALUES (1,'Ene','2025-05-22 20:56:03'),(2,'Feb','2025-05-22 20:56:07'),(3,'Mar','2025-05-22 20:56:10'),(4,'Abr','2025-05-22 20:56:14'),(5,'May','2025-05-22 20:56:17'),(6,'Jun','2025-05-22 20:56:21'),(7,'Jul','2025-05-22 20:56:24'),(8,'Ago','2025-05-22 20:56:28'),(9,'Sep','2025-05-22 20:56:32'),(10,'Oct','2025-05-22 20:56:35'),(11,'Nov','2025-05-22 20:56:39'),(12,'Dic','2025-05-22 20:56:42');
/*!40000 ALTER TABLE `Meses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Notas`
--

DROP TABLE IF EXISTS `Notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `idInmuebleColono` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `notas_idInmuebleColono_fkey` (`idInmuebleColono`),
  CONSTRAINT `notas_idInmuebleColono_fkey` FOREIGN KEY (`idInmuebleColono`) REFERENCES `InmueblesColonos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notas`
--

LOCK TABLES `Notas` WRITE;
/*!40000 ALTER TABLE `Notas` DISABLE KEYS */;
/*!40000 ALTER TABLE `Notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pagos`
--

DROP TABLE IF EXISTS `Pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `folio` int(11) NOT NULL,
  `estatus` enum('activo','cancelado') DEFAULT 'activo',
  `total` double NOT NULL,
  `numeroMensualidades` int(11) NOT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idTalon` int(11) NOT NULL,
  `idPartida` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCondonacion` int(11) DEFAULT NULL,
  `idInmuebleColono` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pagos_idUsuario_fkey` (`idUsuario`),
  KEY `pagos_idInmuebleColono_fkey` (`idInmuebleColono`),
  KEY `pagos_idTalon_fkey` (`idTalon`),
  KEY `pagos_idCondonacion_fkey` (`idCondonacion`),
  KEY `pagos_idPartida_fkey` (`idPartida`),
  CONSTRAINT `pagos_idCondonacion_fkey` FOREIGN KEY (`idCondonacion`) REFERENCES `Condonaciones` (`id`),
  CONSTRAINT `pagos_idInmuebleColono_fkey` FOREIGN KEY (`idInmuebleColono`) REFERENCES `InmueblesColonos` (`id`),
  CONSTRAINT `pagos_idPartida_fkey` FOREIGN KEY (`idPartida`) REFERENCES `Partidas` (`id`),
  CONSTRAINT `pagos_idTalon_fkey` FOREIGN KEY (`idTalon`) REFERENCES `Talones` (`id`),
  CONSTRAINT `pagos_idUsuario_fkey` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pagos`
--

LOCK TABLES `Pagos` WRITE;
/*!40000 ALTER TABLE `Pagos` DISABLE KEYS */;
INSERT INTO `Pagos` VALUES (1,'2025-06-06',1,'activo',500,1,NULL,'2025-06-06 03:08:54','2025-06-18 16:32:13',1,1,2,NULL,5),(2,'2025-06-06',2,'activo',500,2,NULL,'2025-06-06 03:09:17','2025-06-14 23:26:50',1,2,2,NULL,1),(3,'2025-06-08',4,'activo',1250,5,NULL,'2025-06-08 22:22:40','2025-06-18 16:32:36',1,1,2,NULL,1),(4,'2025-06-08',5,'activo',1500,6,NULL,'2025-06-08 22:23:22','2025-06-18 16:32:45',1,1,2,NULL,5),(5,'2025-06-12',3,'activo',750,3,NULL,'2025-06-12 01:29:16','2025-06-18 16:32:25',1,1,2,NULL,4),(6,'2025-06-18',6,'activo',250,1,NULL,'2025-06-18 16:35:47','2025-06-18 16:35:47',1,1,2,NULL,5),(7,'2025-06-18',7,'activo',500,2,NULL,'2025-06-18 16:36:17','2025-06-18 16:36:17',1,1,2,NULL,6),(8,'2025-06-18',8,'activo',250,1,NULL,'2025-06-18 16:36:28','2025-06-18 16:36:28',1,1,2,NULL,1),(9,'2025-06-18',9,'activo',1000,4,NULL,'2025-06-18 17:03:43','2025-06-18 17:03:43',1,1,2,NULL,5);
/*!40000 ALTER TABLE `Pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Parametros`
--

DROP TABLE IF EXISTS `Parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Parametros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuota` int(11) DEFAULT NULL,
  `estatus` enum('activo','inactivo') DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Parametros`
--

LOCK TABLES `Parametros` WRITE;
/*!40000 ALTER TABLE `Parametros` DISABLE KEYS */;
INSERT INTO `Parametros` VALUES (1,250,'activo','2025-06-01 21:06:37','2025-06-01 21:06:37');
/*!40000 ALTER TABLE `Parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Partidas`
--

DROP TABLE IF EXISTS `Partidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Partidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Partidas`
--

LOCK TABLES `Partidas` WRITE;
/*!40000 ALTER TABLE `Partidas` DISABLE KEYS */;
INSERT INTO `Partidas` VALUES (1,'Vigilancia','Cuotas vigilancia','2025-06-14 22:31:15'),(2,'Mantenimientos','Reparaciones','2025-06-14 23:26:25');
/*!40000 ALTER TABLE `Partidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sesiones`
--

DROP TABLE IF EXISTS `Sesiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sesiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTalon` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sesiones_idTalon_fkey` (`idTalon`),
  KEY `sesiones_idUsuario_fkey` (`idUsuario`),
  CONSTRAINT `sesiones_idTalon_fkey` FOREIGN KEY (`idTalon`) REFERENCES `Talones` (`id`),
  CONSTRAINT `sesiones_idUsuario_fkey` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sesiones`
--

LOCK TABLES `Sesiones` WRITE;
/*!40000 ALTER TABLE `Sesiones` DISABLE KEYS */;
INSERT INTO `Sesiones` VALUES (3,1,2,'2025-06-15 02:12:35');
/*!40000 ALTER TABLE `Sesiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Talones`
--

DROP TABLE IF EXISTS `Talones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Talones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `folioInicial` int(11) NOT NULL,
  `folioFinal` int(11) NOT NULL,
  `ejercicio` int(11) NOT NULL,
  `estatus` enum('abierto','cerrado') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Talones`
--

LOCK TABLES `Talones` WRITE;
/*!40000 ALTER TABLE `Talones` DISABLE KEYS */;
INSERT INTO `Talones` VALUES (1,1,'noi',1,10,2025,'cerrado','2025-06-18 17:03:21'),(2,2,'Cuotas de colonos',1,5,2025,'abierto','2025-06-18 16:58:57'),(3,3,'no',1,8,2025,'cerrado','2025-06-18 16:38:49');
/*!40000 ALTER TABLE `Talones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `estatus` enum('activo','inactivo') DEFAULT NULL,
  `password` varchar(70) DEFAULT NULL,
  `tipo` enum('colono','admin') DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idColono` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarios_idColono_fkey` (`idColono`),
  CONSTRAINT `usuarios_idColono_fkey` FOREIGN KEY (`idColono`) REFERENCES `Colonos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES (1,'profe','activo','$2y$10$V1FEmi71Zoo5z50b7HLP1eG5Ii1m6k7U6YkpgH4VLZxKUvJh7xYOG','colono','2025-05-15 20:05:23',1),(2,'super','activo','$2y$10$V1FEmi71Zoo5z50b7HLP1eG5Ii1m6k7U6YkpgH4VLZxKUvJh7xYOG','admin','2025-06-05 00:52:56',2);
/*!40000 ALTER TABLE `Usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-22 20:57:34
