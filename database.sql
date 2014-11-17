CREATE DATABASE  IF NOT EXISTS `carrinho` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `carrinho`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: carrinho
-- ------------------------------------------------------
-- Server version	5.6.14

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Casa'),(2,'Carro'),(3,'Celular'),(4,'Computador'),(5,'Escola'),(6,'Utensilios');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(11) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`,`id_pessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_item`
--

DROP TABLE IF EXISTS `pedido_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_pedido`,`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_item`
--

LOCK TABLES `pedido_item` WRITE;
/*!40000 ALTER TABLE `pedido_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `telefone` varchar(20) COLLATE utf8_bin NOT NULL,
  `endereco` varchar(255) COLLATE utf8_bin NOT NULL,
  `bairro` varchar(255) COLLATE utf8_bin NOT NULL,
  `cidade` varchar(255) COLLATE utf8_bin NOT NULL,
  `estado` varchar(2) COLLATE utf8_bin NOT NULL,
  `pais` varchar(255) COLLATE utf8_bin NOT NULL,
  `observacao` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `descricao` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `imagem` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `preco` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (1,'Mesa 1','Descricao Mesa 1','imagem1.jpg','500'),(2,'Mesa 2','Descricao Mesa 2','imagem1.jpg','600'),(3,'Mesa 3','Descricao Mesa 3','imagem1.jpg','700'),(4,'Cadeira 1','Descricao Cadeira 1','imagem1.jpg','100'),(5,'Cadeira 2','Descricao Cadeira 2','imagem1.jpg','150'),(6,'Cadeira 3','Descricao Cadeira 3','imagem1.jpg','200'),(7,'Copo 1','Descricao Copo 1','imagem1.jpg','10'),(8,'Copo 2','Descricao Copo 2','imagem1.jpg','15'),(9,'Copo 3','Descricao Copo 3','imagem1.jpg','20'),(10,'Pneu R13','Descricao Pneu R13','imagem1.jpg','190'),(11,'Pneu R14','Descricao Pneu R14','imagem1.jpg','230'),(12,'Pneu R15','Descricao Pneu R15','imagem1.jpg','290'),(13,'Pneu R16','Descricao Pneu R16','imagem1.jpg','350'),(14,'Roda R13','Descricao Roda R13','imagem1.jpg','400'),(15,'Roda R14','Descricao Roda R14','imagem1.jpg','460'),(16,'Roda R15','Descricao Roda R15','imagem1.jpg','550'),(17,'Roda R16','Descricao Roda R16','imagem1.jpg','650'),(18,'Mouse 1','Descricao Mouse 1','imagem1.jpg','20'),(19,'Mouse 2','Descricao Mouse 2','imagem1.jpg','60'),(20,'Mouse 3','Descricao Mouse 3','imagem1.jpg','200'),(21,'Teclado 1','Descricao Teclado 1','imagem1.jpg','30'),(22,'Teclado 2','Descricao Teclado 2','imagem1.jpg','60'),(23,'Teclado 3','Descricao Teclado 3','imagem1.jpg','200'),(24,'Capa 1','Descricao Capa 1','imagem1.jpg','10'),(25,'Capa 2','Descricao Capa 2','imagem1.jpg','20'),(26,'Capa 3','Descricao Capa 3','imagem1.jpg','50'),(27,'Carregador 1','Descricao Carregador 1','imagem1.jpg','20'),(28,'Carregador 2','Descricao Carregador 2','imagem1.jpg','50');
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_categoria`
--

DROP TABLE IF EXISTS `produto_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_produto`,`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_categoria`
--

LOCK TABLES `produto_categoria` WRITE;
/*!40000 ALTER TABLE `produto_categoria` DISABLE KEYS */;
INSERT INTO `produto_categoria` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,5,1),(6,6,1),(7,7,1),(8,8,1),(9,9,1),(10,1,5),(11,2,5),(12,3,5),(13,4,5),(14,5,5),(15,6,5),(16,7,6),(17,8,6),(18,9,6),(19,10,2),(20,11,2),(21,12,2),(22,13,2),(23,14,2),(24,15,2),(25,16,2),(26,17,2),(27,18,4),(28,19,4),(29,20,4),(30,21,4),(31,22,4),(32,23,4),(33,18,6),(34,19,6),(35,20,6),(36,21,6),(37,22,6),(38,23,6),(39,18,5),(40,19,5),(41,20,5),(42,21,5),(43,22,5),(44,23,5),(45,24,3),(46,25,3),(47,26,3),(48,27,3),(49,28,3),(50,24,4),(51,25,4),(52,26,4),(53,27,4),(54,28,4);
/*!40000 ALTER TABLE `produto_categoria` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-17 17:04:55
