-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: senati
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `detalle_pedido`
--

DROP TABLE IF EXISTS `detalle_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_pedido` (
  `id_detalle_pedido` varchar(8) NOT NULL,
  `id_pedido` varchar(8) NOT NULL,
  `id_producto` varchar(8) NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_detalle_pedido`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedido`
--

LOCK TABLES `detalle_pedido` WRITE;
/*!40000 ALTER TABLE `detalle_pedido` DISABLE KEYS */;
INSERT INTO `detalle_pedido` VALUES ('0122','PED001','PN001',1,17.00),('0459','PED004','PN002',1,15.50),('0538','PED008','PN003',1,16.00),('0833','PED006','PN002',1,15.50),('0879','PED004','PN012',1,5.50),('2526','PED004','PN003',1,16.00),('2629','PED008','PN002',1,15.50),('3099','PED007','PN012',1,5.50),('3129','PED004','PN011',1,6.00),('3219','PED005','PN005',1,17.50),('4291','PED005','PN003',1,16.00),('5038','PED004','PN020',1,7.50),('5282','PED007','PN021',1,6.00),('5491','PED002','PN003',1,16.00),('6464','PED007','PN003',1,16.00),('8090','PED006','PN003',1,16.00),('8456','PED004','PN004',1,16.00),('9108','PED003','PN003',1,16.00),('9177','PED004','PN001',1,17.00),('9523','PED002','PN002',1,15.50),('9877','PED005','PN002',1,15.50);
/*!40000 ALTER TABLE `detalle_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido` (
  `id_pedido` varchar(8) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES ('PED001','2024-11-25',17.00),('PED002','2024-11-25',31.50),('PED003','2024-11-25',16.00),('PED004','2024-11-25',83.50),('PED005','2024-11-25',49.00),('PED006','2024-11-25',31.50),('PED007','2024-11-26',27.50),('PED008','2024-11-27',31.50);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `id_producto` varchar(8) NOT NULL,
  `nombre_producto` varchar(30) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES ('PN001','Aji de Gallina','Delicioso ají de gallina con arroz blanco y papas',17.00,'IMG/aji1.png'),('PN002','Seco de Cordero','Cordero guisado con culantro acompañado de arroz y frijoles',15.50,'IMG/cordero2.webp'),('PN003','Lomo Saltado','Clásico lomo saltado con papas fritas y arroz',16.00,'IMG/lomo1.jpg'),('PN004','Arroz con Pato','Arroz verde acompañado de suculento pato guisado',16.00,'IMG/pato2.jpg'),('PN005','Anticuchos','Brochetas de corazón de res marinadas en ají panca',17.50,'IMG/anticucho1.webp'),('PN006','Carapulcra','Tradicional guiso de papa seca con cerdo y maní',16.50,'IMG/carapulcra1.jpg'),('PN007','Causa Limeña','Riquísima causa limeña rellena de pollo y mayonesa',19.00,'IMG/causa2.webp'),('PN008','Ceviche','Ceviche fresco de pescado con cancha y camote',18.00,'IMG/ceviche1.jpg'),('PN009','Papa Rellena','Papa rellena con carne, acompañada de ensalada criolla',17.50,'IMG/papa2.webp'),('PN010','Limonada','Refrescante limonada natural servida fría',5.00,'IMG/limonada2.jpg'),('PN011','Inka Kola','Clásica bebida peruana gaseosa',6.00,'IMG/inka1.jpg'),('PN012','Chicha Morada','Bebida tradicional hecha con maíz morado',5.50,'IMG/morada1.webp'),('PN013','Agua de Coco','Agua de coco natural y refrescante',7.00,'IMG/coco2.webp'),('PN014','Agua de Tamarindo','Refrescante agua de tamarindo tropical',5.50,'IMG/tamarindo1.jpg'),('PN015','Té Helado','Té frío con un toque de limón',5.00,'IMG/te1.webp'),('PN016','Helado de Lúcuma','Helado artesanal de lúcuma',8.00,'IMG/lucuma1.jpg'),('PN017','Crema Volteada','Postre tradicional de leche y caramelo',7.50,'IMG/crema1.jpg'),('PN018','Mazamorra Morada','Mazamorra hecha con maíz morado, frutas y especias',6.50,'IMG/mazamorra1.jpg'),('PN019','Brownie','Brownie de chocolate con trozos de nueces',7.00,'IMG/brownie2.jpg'),('PN020','Suspiro a la Limeña','Postre limeño a base de manjar blanco y merengue',7.50,'IMG/suspiro2.jpg'),('PN021','Arroz con Leche','Clásico arroz con leche aromatizado con canela',6.00,'IMG/arrozleche2.jpg');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-20  9:07:53
