-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: agexcom
-- ------------------------------------------------------
-- Server version	5.7.21-log

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
-- Table structure for table `arquivo_job`
--

DROP TABLE IF EXISTS `arquivo_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arquivo_job` (
  `id_arquivo` int(11) NOT NULL AUTO_INCREMENT,
  `caminho` varchar(300) NOT NULL,
  `user` int(11) NOT NULL,
  `job_idjob` int(11) NOT NULL,
  `aprovado` enum('sim','não','aguardando') DEFAULT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_arquivo`),
  KEY `fk_comentario_arquivo_job1_idx` (`job_idjob`),
  KEY `fk_user_idx` (`user`),
  CONSTRAINT `fk_comentario_arquivo_job1` FOREIGN KEY (`job_idjob`) REFERENCES `job` (`idjob`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user` FOREIGN KEY (`user`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arquivo_job`
--

LOCK TABLES `arquivo_job` WRITE;
/*!40000 ALTER TABLE `arquivo_job` DISABLE KEYS */;
/*!40000 ALTER TABLE `arquivo_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_has_job`
--

DROP TABLE IF EXISTS `categoria_has_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_has_job` (
  `categoria_idcategoria` int(11) NOT NULL,
  `job_idjob` int(11) NOT NULL,
  PRIMARY KEY (`categoria_idcategoria`,`job_idjob`),
  KEY `fk_categoria_digital_has_job_job1_idx` (`job_idjob`),
  KEY `fk_categoria_digital_has_job_categoria_digital1_idx` (`categoria_idcategoria`),
  CONSTRAINT `fk_categoria_digital_has_job_categoria_digital1` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria_job` (`idcategoria_digital`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_categoria_digital_has_job_job1` FOREIGN KEY (`job_idjob`) REFERENCES `job` (`idjob`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_has_job`
--

LOCK TABLES `categoria_has_job` WRITE;
/*!40000 ALTER TABLE `categoria_has_job` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria_has_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_job`
--

DROP TABLE IF EXISTS `categoria_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_job` (
  `idcategoria_digital` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`idcategoria_digital`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_job`
--

LOCK TABLES `categoria_job` WRITE;
/*!40000 ALTER TABLE `categoria_job` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentario` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `arquivo` int(11) DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `job_idjob` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idcomentario`),
  KEY `fk_comentario_idx` (`arquivo`),
  KEY `fk_comentario_job1_idx` (`job_idjob`),
  KEY `fk_comentario_status_coment1_idx` (`status`),
  CONSTRAINT `fk_comentario` FOREIGN KEY (`arquivo`) REFERENCES `arquivo_job` (`id_arquivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_job1` FOREIGN KEY (`job_idjob`) REFERENCES `job` (`idjob`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_status_coment1` FOREIGN KEY (`status`) REFERENCES `status_coment` (`idstatus_coment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `idevento` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `nome` varchar(45) NOT NULL,
  `local` varchar(45) NOT NULL,
  PRIMARY KEY (`idevento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job` (
  `idjob` int(11) NOT NULL AUTO_INCREMENT,
  `evento` int(11) DEFAULT NULL,
  `data_entrega` date NOT NULL,
  `hora_entrega` time NOT NULL,
  `data_pedido` date NOT NULL,
  `hora_pedido` time NOT NULL,
  `status` int(11) NOT NULL,
  `observacao` varchar(150) DEFAULT NULL,
  `solicitante` int(11) DEFAULT NULL,
  `colaborador` int(11) DEFAULT NULL,
  PRIMARY KEY (`idjob`),
  KEY `fk_evento_idx` (`evento`),
  KEY `fk_job_status1_idx` (`status`),
  KEY `fk_solicintante_idx` (`solicitante`),
  KEY `fk_colaborador_idx` (`colaborador`),
  CONSTRAINT `fk_colaborador` FOREIGN KEY (`colaborador`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_evento` FOREIGN KEY (`evento`) REFERENCES `evento` (`idevento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_job_status1` FOREIGN KEY (`status`) REFERENCES `status` (`idstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitante` FOREIGN KEY (`solicitante`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `idstatus` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`idstatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_coment`
--

DROP TABLE IF EXISTS `status_coment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_coment` (
  `idstatus_coment` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`idstatus_coment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_coment`
--

LOCK TABLES `status_coment` WRITE;
/*!40000 ALTER TABLE `status_coment` DISABLE KEYS */;
/*!40000 ALTER TABLE `status_coment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_hier`
--

DROP TABLE IF EXISTS `status_hier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_hier` (
  `idstatus_hier` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`idstatus_hier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_hier`
--

LOCK TABLES `status_hier` WRITE;
/*!40000 ALTER TABLE `status_hier` DISABLE KEYS */;
/*!40000 ALTER TABLE `status_hier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `hierarquia` int(11) DEFAULT NULL,
  `fone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `user` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `fk_hierarquia_idx` (`hierarquia`),
  CONSTRAINT `fk_hierarquia` FOREIGN KEY (`hierarquia`) REFERENCES `status_hier` (`idstatus_hier`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'agexcom'
--

--
-- Dumping routines for database 'agexcom'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-29 13:44:35
