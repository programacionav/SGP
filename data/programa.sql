-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: sgp
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `cambioestado`
--

DROP TABLE IF EXISTS `cambioestado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cambioestado` (
  `idCambioEstado` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idEstadoP` int(11) NOT NULL,
  `idPrograma` int(11) NOT NULL,
  PRIMARY KEY (`idCambioEstado`),
  KEY `idPrograma` (`idPrograma`),
  KEY `idUsuario` (`idUsuario`),
  KEY `cambioestado_ibfk_3_idx` (`idEstadoP`),
  CONSTRAINT `cambioestado_ibfk_3` FOREIGN KEY (`idEstadoP`) REFERENCES `estadoprograma` (`idEstadoP`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cambioestado_ibfk_1` FOREIGN KEY (`idPrograma`) REFERENCES `programa` (`idPrograma`),
  CONSTRAINT `cambioestado_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cambioestado`
--

LOCK TABLES `cambioestado` WRITE;
/*!40000 ALTER TABLE `cambioestado` DISABLE KEYS */;
/*!40000 ALTER TABLE `cambioestado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estadoobservacion`
--

DROP TABLE IF EXISTS `estadoobservacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estadoobservacion` (
  `idEstadoO` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`idEstadoO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadoobservacion`
--

LOCK TABLES `estadoobservacion` WRITE;
/*!40000 ALTER TABLE `estadoobservacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `estadoobservacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estadoprograma`
--

DROP TABLE IF EXISTS `estadoprograma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estadoprograma` (
  `idEstadoP` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`idEstadoP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadoprograma`
--

LOCK TABLES `estadoprograma` WRITE;
/*!40000 ALTER TABLE `estadoprograma` DISABLE KEYS */;
/*!40000 ALTER TABLE `estadoprograma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `observacion`
--

DROP TABLE IF EXISTS `observacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `observacion` (
  `idObservacion` int(11) NOT NULL AUTO_INCREMENT,
  `observacion` varchar(200) NOT NULL,
  `idEstadoO` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPrograma` int(11) NOT NULL,
  PRIMARY KEY (`idObservacion`),
  KEY `id_programa` (`idPrograma`),
  KEY `estado` (`idEstadoO`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `observacion_ibfk_1` FOREIGN KEY (`idPrograma`) REFERENCES `programa` (`idPrograma`),
  CONSTRAINT `observacion_ibfk_2` FOREIGN KEY (`idEstadoO`) REFERENCES `estadoobservacion` (`idEstadoO`),
  CONSTRAINT `observacion_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `observacion`
--

LOCK TABLES `observacion` WRITE;
/*!40000 ALTER TABLE `observacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `observacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programa`
--

DROP TABLE IF EXISTS `programa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programa` (
  `idPrograma` int(11) NOT NULL AUTO_INCREMENT,
  `idCursado` int(11) NOT NULL,
  `orientacion` varchar(200) NOT NULL,
  `añoActual` year(4) NOT NULL,
  `programaAnalitico` text NOT NULL,
  `propuestaMetodologica` varchar(200) NOT NULL,
  `condicionesAcredEvalu` varchar(200) NOT NULL,
  `horariosConsulta` varchar(200) NOT NULL,
  `bibliografia` varchar(200) NOT NULL,
  PRIMARY KEY (`idPrograma`),
  KEY `idCursado` (`idCursado`),
  CONSTRAINT `programa_ibfk_2` FOREIGN KEY (`idCursado`) REFERENCES `cursado` (`idCursado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programa`
--

LOCK TABLES `programa` WRITE;
/*!40000 ALTER TABLE `programa` DISABLE KEYS */;
/*!40000 ALTER TABLE `programa` ENABLE KEYS */;
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-08 18:14:11
