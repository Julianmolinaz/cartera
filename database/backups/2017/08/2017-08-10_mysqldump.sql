-- MySQL dump 10.13  Distrib 5.7.18, for macos10.12 (x86_64)
--
-- Host: localhost    Database: g
-- ------------------------------------------------------
-- Server version	5.7.18

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
-- Table structure for table `anuladas`
--

DROP TABLE IF EXISTS `anuladas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anuladas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) unsigned NOT NULL,
  `factura_id` int(11) NOT NULL,
  `credito_id` int(10) unsigned NOT NULL,
  `num_fact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` double NOT NULL,
  `pagos` longtext COLLATE utf8_unicode_ci,
  `motivo_anulacion` text COLLATE utf8_unicode_ci,
  `user_anula` int(10) unsigned NOT NULL,
  `user_create_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `anuladas_cliente_id_foreign` (`cliente_id`),
  KEY `anuladas_credito_id_foreign` (`credito_id`),
  KEY `anuladas_user_anula_foreign` (`user_anula`),
  KEY `anuladas_user_create_id_foreign` (`user_create_id`),
  CONSTRAINT `anuladas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `anuladas_credito_id_foreign` FOREIGN KEY (`credito_id`) REFERENCES `creditos` (`id`),
  CONSTRAINT `anuladas_user_anula_foreign` FOREIGN KEY (`user_anula`) REFERENCES `users` (`id`),
  CONSTRAINT `anuladas_user_create_id_foreign` FOREIGN KEY (`user_create_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuladas`
--

LOCK TABLES `anuladas` WRITE;
/*!40000 ALTER TABLE `anuladas` DISABLE KEYS */;
INSERT INTO `anuladas` VALUES (1,70,37,53,'45','10-08-2017',82100,'[ ID=55,CONCEPTO=Cuota Parcial,ABONO=82100,DEBE=0,ESTADO=Ok,DESDE=2017-09-02,HASTA=2017-09-17,ABONO PAGO ID=53] ** Factura creada: 2017-08-10 10:19:53 por Pablo Adrian Gonzalez Salazar **','prueba',2,2,'2017-08-10 22:46:50','2017-08-10 22:46:50');
/*!40000 ALTER TABLE `anuladas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auditorias`
--

DROP TABLE IF EXISTS `auditorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auditorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `concepto` enum('Sanciones') COLLATE utf8_unicode_ci NOT NULL,
  `clave_ini` mediumint(9) DEFAULT NULL,
  `clave_fin` mediumint(9) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auditorias`
--

LOCK TABLES `auditorias` WRITE;
/*!40000 ALTER TABLE `auditorias` DISABLE KEYS */;
INSERT INTO `auditorias` VALUES (51,'Sanciones',1,1,'2017-08-01 21:50:01','2017-08-01 21:50:01'),(52,'Sanciones',1,1,'2017-08-02 01:01:01','2017-08-02 01:01:01'),(53,'Sanciones',1,1,'2017-08-03 01:01:01','2017-08-03 01:01:01'),(54,'Sanciones',1,1,'2017-08-04 01:01:01','2017-08-04 01:01:01');
/*!40000 ALTER TABLE `auditorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_busquedas`
--

DROP TABLE IF EXISTS `call_busquedas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `call_busquedas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `busqueda` enum('Hoy','Morosos','Todos','Antes','Agenda') COLLATE utf8_unicode_ci DEFAULT NULL,
  `rango_ini` date DEFAULT NULL,
  `rango_fin` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `call_busquedas_user_id_foreign` (`user_id`),
  CONSTRAINT `call_busquedas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_busquedas`
--

LOCK TABLES `call_busquedas` WRITE;
/*!40000 ALTER TABLE `call_busquedas` DISABLE KEYS */;
INSERT INTO `call_busquedas` VALUES (4,8,'Todos',NULL,NULL,'2017-08-01 09:09:04','2017-08-02 09:52:42'),(5,2,'Todos',NULL,NULL,'2017-08-03 19:08:11','2017-08-10 15:45:25'),(6,17,'Todos',NULL,NULL,'2017-08-04 11:18:39','2017-08-04 14:48:06'),(7,20,'Todos',NULL,NULL,'2017-08-04 15:12:51','2017-08-04 15:12:51');
/*!40000 ALTER TABLE `call_busquedas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carteras`
--

DROP TABLE IF EXISTS `carteras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carteras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `carteras_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carteras`
--

LOCK TABLES `carteras` WRITE;
/*!40000 ALTER TABLE `carteras` DISABLE KEYS */;
INSERT INTO `carteras` VALUES (6,'NEGOCIOS GORA','Activo','2017-04-16 18:45:52','2017-08-01 08:36:40'),(10,'DANILO','Activo','2017-04-18 08:55:26','2017-08-01 08:36:27'),(11,'MICHEL','Activo','2017-08-01 08:36:51','2017-08-01 08:36:51');
/*!40000 ALTER TABLE `carteras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `barrio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `municipio_id` int(10) unsigned NOT NULL,
  `movil` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fijo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `placa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ocupacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_actividad` enum('Dependiente','Independiente') COLLATE utf8_unicode_ci NOT NULL,
  `codeudor_id` int(10) unsigned DEFAULT NULL,
  `numero_de_creditos` int(11) DEFAULT NULL,
  `user_create_id` int(10) unsigned NOT NULL,
  `user_update_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_num_doc_unique` (`num_doc`),
  KEY `clientes_municipio_id_foreign` (`municipio_id`),
  KEY `clientes_codeudor_id_foreign` (`codeudor_id`),
  KEY `clientes_user_create_id_foreign` (`user_create_id`),
  KEY `clientes_user_update_id_foreign` (`user_update_id`),
  CONSTRAINT `clientes_codeudor_id_foreign` FOREIGN KEY (`codeudor_id`) REFERENCES `codeudores` (`id`),
  CONSTRAINT `clientes_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`),
  CONSTRAINT `clientes_user_create_id_foreign` FOREIGN KEY (`user_create_id`) REFERENCES `users` (`id`),
  CONSTRAINT `clientes_user_update_id_foreign` FOREIGN KEY (`user_update_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (30,'LUIS EDUARDO GARCIA BAñOL ','1087492477','28-08-1995','CALLE 11E 12-121','KENNEDY',1,'3205786000','','luiseduardogarcia51@gmail.com','ZTB20','ASALARIADO','OPERADORA AVICOLA','Dependiente',100,NULL,11,11,'2017-08-01 09:22:57','2017-08-01 09:22:57'),(31,'LAYNIKER RENTERIA AYALA','1088296249','01-02-1992','TORRE I2 APARTAMENTO 404','SALAMANCA',1,'3127668881','','2aynik@hotmail.com','SSO04C','ASALARIADO','INDUSTRIAS OM','Dependiente',105,NULL,11,11,'2017-08-01 09:35:11','2017-08-05 13:35:24'),(32,'LAURA XIMENA HERNANDEZ ALVAREZ','1089747144','01-01-1990','NISA 1 BLO 4 APTO 3B','NISA',1,'3212298410','','','','ASALARIADO','BANCO FINANDINA','Dependiente',101,1,8,8,'2017-08-01 10:29:21','2017-08-01 10:40:15'),(33,'JHON JAIRO ESPINOSA','1088271243','30-08-1989','FUTURO BAJO CASA 2','EL PROGRESO',1,'3052340382','','','XZY70D','OPERARIO ASEO ','TECNISERVICIOS VANES LTDA','Dependiente',100,NULL,13,13,'2017-08-01 10:59:50','2017-08-01 10:59:50'),(34,'ORLANDO OROZCO CASTAñEDA ','75096817','22-03-1979','CALLE 34 -19 153','DELIERAS',3,'3108811016','','','','DECORADOR','FLOREZ OLGUITA','Dependiente',100,1,13,10,'2017-08-01 14:13:16','2017-08-04 15:20:01'),(35,'ROBINSON ALEJANDRO GAñAN GAñAN ','3102998184','26-05-1996','VERDA TACON ','TACON',3,'3102998184','','','','COCHERO','MINA MANANTIAL','Dependiente',100,NULL,13,13,'2017-08-01 14:39:36','2017-08-01 14:39:36'),(36,'SANDRA TATIANA GARCIA GARCIA','24336053','15-10-1984','CARRERA 25A 53A 14 TERCER PISO ','ARBOLEDA',3,'3002331098','','','','PENSIONADA ','','Independiente',100,NULL,11,11,'2017-08-01 18:00:06','2017-08-01 18:00:06'),(37,'DAGSENOVER ANTONIO CORREA GRAJALES','1088346535','16-11-1997','MANZANA 3 CASA 11','JAIME PARDO LEAL',1,'3143347447','','','AME02B','ESTUDIANTE','','Independiente',102,1,11,10,'2017-08-02 08:52:06','2017-08-02 19:36:24'),(38,'ANGY LISED LOPEZ QUINTERO ','1004626671','28-01-2017','MANZANA 5 CASA 15 SECTOR D','PARQUE INDUSTRIAL',1,'3219652699','','lizita_0128@hotmail.com','','AUXILIAR DE VENTAS','TENDENCIA ARTESANAL ','Dependiente',103,1,13,10,'2017-08-02 09:30:31','2017-08-04 15:35:48'),(39,'RICARDO BEDOYA MEJíA ','10030911','09-06-1980','VEREDA 3 PUERTAS - FRENTE A LA ESTACIóN DE POLICIíA ','EL PORVENIR',1,'3137480827','','','BKAU13A','MENSAJERO','PARE PUBLICIDAD ','Dependiente',100,1,13,10,'2017-08-02 10:13:55','2017-08-04 19:34:07'),(40,'JULIAN DAVID CARMONA RINCON','1088028813','15-12-1996','MANZANA 1 CASA 2 ','QUINTAS DE ARAGON ',2,'3194941432','3503320','juliancarmona803@gmail.com','HBR69','VENDEDOR','DIEZTRO','Dependiente',100,NULL,11,11,'2017-08-02 10:55:47','2017-08-02 10:55:47'),(41,'GUILLERMO LEON CASTRO OSPINA','10088764','12-03-1956','CALLE 3E 2-25','ALFONSO LÓPEZ',1,'3122078744','3160576','','','VIGILANTE','SEGURIDAD ATLAS','Dependiente',100,1,8,8,'2017-08-02 11:29:21','2017-08-02 12:21:12'),(42,'YERSON ALBERTO GONZALEZ GONZALES','1055916931','19-12-1988','CALLE 17 NUMERO 34-37 ','CARMEN',3,'3117723394','','YASON-198812@HOTMAIL.COM','','ALMACENISTA','REHAU','Dependiente',100,NULL,11,11,'2017-08-02 12:04:11','2017-08-02 12:04:11'),(43,'BLANCA MIRYAM BUITRAGO VARGAS','42008899','13-06-1975','CALLE 64 21-24','EL DIAMANTE CAPILLA',1,'3148770416','3243126','','','EMPLEADA','ALMACEN STOP','Dependiente',100,1,8,8,'2017-08-02 12:41:14','2017-08-02 12:48:57'),(44,'MARIBEL MONSALVE CAñAS','434822124','09-12-1972','CRA 7 NUMERO 35-68','LA CRUZ',1069,'3118562278','','','EIM66C','AGRICULTURA','','Independiente',100,1,11,10,'2017-08-02 14:22:51','2017-08-04 16:00:08'),(45,'LEIDY ANDREA RAMIREZ RIVERA','1060587582','19-05-1986','CARRERA 7D NUMERO 25-15','POPULAR',1069,'3147251520','','','SYF89A','RECAUDADORA','CONCESION PACIFICO TRES SAS','Dependiente',100,1,11,11,'2017-08-02 15:36:56','2017-08-04 14:25:09'),(46,'JHON EDGAR CASTRO VALENCIA','1093215213','26-12-1987','CALLE 36 NUMERO 12-03 APTO 301 PISO 3','EL TRIUNFO',1003,'3207662495','3661051','castro1919@hotmail.com','SPR74','CORDINADOR','PANIFICADORA SANTA CATALINA SAS','Dependiente',100,1,11,10,'2017-08-02 15:43:46','2017-08-04 15:23:47'),(47,'LAURA CRISTINA OSSA QUINTERO ','1088317219','30-04-1994','CRA 4 N° 67-10','EL PLUMON ',1,'3188928689','','','GIX32B','AGENTE CALL CENTER','BECALL OUTSOURCING ','Dependiente',100,1,13,10,'2017-08-02 18:02:34','2017-08-04 15:31:40'),(48,'JERSSON BERRIO TORO','18518978','05-02-1982','VEREDA EL COFRE FINCA EL ENCANTO ','VEREDA EL COFRE ',2,'3132963540','','','ODW95B','AYUDANTE','INGEMETALES','Dependiente',100,1,11,10,'2017-08-02 18:05:11','2017-08-04 19:37:28'),(49,'EDWIN ANDRES PAYAN GOMEZ','18610338','12-02-1982','BLOQUE 41 APARTAMENTO 41','MIRADOR LLANO GRANDE',1,'3133448270','','payangomeze@gmail.com','DBS25C','JEFE DE BODEGA','MEDSURG SAS','Dependiente',100,1,11,10,'2017-08-02 18:21:05','2017-08-02 19:31:46'),(50,'JOSE WALTER PEREZ RIVAS','9870428','05-06-1981','TRANSVERSAL 2 CASA 12 ','LA BADEA',2,'3506925841','','','VXP13D','AYUDANTE','INTECHOS','Dependiente',100,NULL,11,11,'2017-08-02 18:31:00','2017-08-02 18:31:00'),(51,'JUAN CARLOS MARIN AGUDELO','1088292793','01-08-1991','MZ 6 CASA 24','HACIENDA CUBA',1,'3207272349','3441382','','','PENSIONADO','','Independiente',100,1,10,10,'2017-08-02 19:41:31','2017-08-02 19:50:21'),(52,'ALEX FABIAN AGUDELO CARDONA','18398837','26-05-1979','CARRERA 9 NUMERO 10-160 TORRE 15 APTO 501 MITACA','LA POPA ',2,'3172181906','3158464','alexagud7@gmail.com','WWB49A','DIAGONANTE ','IMPEC','Dependiente',100,1,11,10,'2017-08-03 09:33:31','2017-08-04 19:32:36'),(53,'ANGELA MARCELA HERNANDEZ PATIñO ','1088312236','02-10-1993','MANZANA 14 CASA 11 ','PADRE VALENCIA CUBA',1,'3137518972','','marcela.0904@gmail.com','','PSICOLOGA','CLINICA LOS ROSALES ','Dependiente',100,NULL,11,11,'2017-08-03 10:10:14','2017-08-03 10:10:14'),(54,'JORGE FERNANDO GRAJALES TABORDA ','18513952','20-11-1976','MANZANA 3 CASA 31','SECTOR D PARQUE INDUSTRIAL',1,'3117200280','','fergraja17@outlook.es','GLR16D','AGRICULTOR','','Independiente',100,1,11,10,'2017-08-03 12:34:53','2017-08-04 15:57:44'),(55,'ARNOBI DE JESUS BECERRA GARCIA ','1059695504','11-09-1986','VEREDA EL TOBOYO BUENA VISTA CERCA DE LA CRUZ ','BUENA VISTA',876,'3508321141','','','PJS54B','MACHINERO','COMPAñIA MINERA LEMUS ORTIZ SAS','Dependiente',100,NULL,11,11,'2017-08-03 12:43:55','2017-08-03 12:43:55'),(56,'CLAUDIA PATRICIA VELEZ LONDOñO','24645784','02-02-1974','CALLE 42 NUMERO 25A-14 ','VELEZ',3,'3113864521','','velezclaudia12@gmail.com','','OPERARIA','ASEAR DISTRIBUCIONES ','Dependiente',100,1,11,10,'2017-08-03 12:51:47','2017-08-04 15:15:00'),(57,'EDNA LUCENA ROTAVISKY MOLINA','30337556','12-03-1972','CALLE 45 NUMERO 19-38','SAENZ',3,'3104508013','8825628','ednal94@hotmail.com','','DIRECTORA','SOLUCIONES PROPIEDAD RAIZ ','Dependiente',104,NULL,11,11,'2017-08-03 14:16:12','2017-08-03 14:16:12'),(58,'JORGE LUIS ROMERO GARCIA','1088240543','17-07-1986','MANZANA B CASA 10 ','CESAR NADE ',1,'3206299600','3316164','jorgeluisromero20149@gmail.com','LZN37B','COMERCIO AL POR MENOR','','Independiente',100,1,11,10,'2017-08-03 15:39:26','2017-08-04 19:30:34'),(59,'ROSA MARIA PULGARIN VARGAS ','1002798409','27-10-1995','VEREDA LAS JUNTAS CERCA A LA TIENDA CASA FUCSIA','VEREDA LAS JUNTAS',709,'3146271802','','','QIT65C','AUXILIAR DE TRANSITO','EL CONDOR','Dependiente',100,NULL,11,11,'2017-08-03 15:48:27','2017-08-03 15:48:27'),(60,'ARISTOBULO GARCIA','10083588','27-05-1957','CARRERA 26 NUMERO 67-27','CENTRO',1,'3225109775','','aristobulogarcia78@hotmail.com','SPG24C','RESANADOR','ANDINOS ASOCIADOS','Dependiente',100,1,11,10,'2017-08-03 18:18:09','2017-08-04 19:29:26'),(61,'ALEJANDRA OCAMPO NARVAEZ','1112788779','19-12-1996','MANZANA 7 CASA 23 ','BLOQUE DE LOS LAGOS',277,'3163281622','','alejandranarvaez1996@hotmail.com','YDD70','CONSTRUCTORA','CONSTRUCTORA CARTAGO SAS','Dependiente',100,NULL,11,11,'2017-08-04 10:29:49','2017-08-04 10:29:49'),(62,'NELSON DE JESUS CASTAñO MEJIA ','15930095','10-02-1974','CALLE 38B N° 10A-39A','ALAMOS',1069,'3118804862','','','OBX45C','OFICIOS VARIOS','SUGRES SAS','Dependiente',100,NULL,11,11,'2017-08-04 10:42:28','2017-08-04 10:42:28'),(63,'JEISSON ANDRES JIMENEZ ATEHORTUA','1004518401','07-04-1989','MANZANA 15 CASA 17','LA GRACIELA',2,'3122922462','','','IDC673','VIGILANTE','SEGURIDAD NACIONAL LTDA','Dependiente',100,NULL,11,11,'2017-08-04 11:34:58','2017-08-04 11:34:58'),(64,'ARISTIDES DE JESUS MARTINEZ SOTO','75060358','20-08-1982','VEREDA SAN JOSE ','SECTOR LA CULATA ',578,'3117055240','','','HDL13','GUADAñERO','','Independiente',100,1,11,11,'2017-08-04 14:30:57','2017-08-04 14:41:21'),(65,'NICOLAS CHAVARRIAGA CRUZ','1058229673','29-07-1992','LA QUEBRADA 40 CERCA AL LLANO','QUEBRADA 40',654,'3127698876','','','ZOB54A','MOLINIAR','MOLINO EL PANTANO ','Dependiente',100,1,11,10,'2017-08-04 15:00:49','2017-08-04 16:12:28'),(66,'MICHEL DAVID ZAPATA CORTES ','1225089018','16-02-1997','MANZANA 7 CASA 16 ','VILLA ELSA CUBA',1,'3137213579','','michael.70pupi@gmail.com','QST27A','COMERCIANTE','PLAZA DE MERCADO LA 41','Dependiente',100,1,11,10,'2017-08-04 15:32:27','2017-08-04 19:36:48'),(67,'YEIMY ALEXANDRA OSPINA AGUDELO','1088287780','18-02-1991','CRA 15A  N° 56-28','SANTA TERESITA',2,'3108296901','','alexandraospina2@gmail.com','DAZ69G','HADA TAT','SUPER DE ALIMENTOS ','Dependiente',100,NULL,11,11,'2017-08-04 16:02:55','2017-08-04 16:02:55'),(68,'ROBINSON ALEJANDRO GIRALDO RESTREPO','1088825432','16-11-1997','CRA 32C N° 80-14 ','LIBERTADOR CUBA',1,'3003566606','','','ISF283','CONDUCTOR','','Independiente',100,1,11,10,'2017-08-04 16:11:38','2017-08-04 19:34:56'),(69,'SENEIDA OCAMPO','25042482','10-09-1960','VILLA MARGORI GUAMAL AL LADO DE LA IGLESIA','VILLA MARGORI',1069,'3005175385','','','GVA67E','VENDEDORA','','Independiente',100,NULL,11,11,'2017-08-04 17:06:08','2017-08-04 17:06:08'),(70,'SORANY OSPINA REYES','1088241700','27-03-1986','MANZANA 2 CASA 29A','ALTOS DE LA CAPILLA',2,'3148818824','','soranyo327@gmail.com','RQW39D','AUXILIAR CONTABLE','COOTRARIS LTDA','Dependiente',100,1,11,10,'2017-08-04 17:11:45','2017-08-04 19:35:59'),(71,'DANILO VANEGAS ARRUBLAS ','1011443','23-07-2017','MANZANA 2 CASA 7 ','CINAI 2',1,'3005118886','','','','OPERARIO MAQUINARIA ','INDUSTRIAS O M ','Dependiente',100,NULL,13,13,'2017-08-04 18:24:00','2017-08-04 18:24:00'),(72,'IVAN DE JESUS TABARES ','10115161','07-06-1964','CARRERA 13 48-46','LOS NARANJOS ',2,'3193891639','','','SRK92','TéCNICO CELULARES ','','Independiente',100,1,13,10,'2017-08-04 18:28:01','2017-08-04 19:27:56'),(73,'SOCRATES CASTILLO ESTRADA ','1088328773','11-09-1995','CONJUNTOS ALTAVISTA BLOQUE 5 APARTAMENTO 402','ALTAVISTA ',1,'3104234605','','','SXU32','COORDINADOR LOGISTICO ','INSERM ALRE  S A','Dependiente',100,NULL,13,13,'2017-08-04 18:30:51','2017-08-04 18:30:51'),(74,'ALEXANDER HERNANDEZ OSPINA ','94042487','24-09-1984','MANZANA 12 CASA 10','LA SULTANA',2,'3102374658','','alex.macuto60@gmail.com','XZT32D','SUPERVISOR','SICTE','Dependiente',100,NULL,11,11,'2017-08-04 18:43:47','2017-08-04 18:43:47'),(75,'ABELARDO TABARES SANTAFE','9976537','13-06-1982','CRA 44 N°11A- 20 BLOQUE 6 APTO 203','ESTAMBUL ',3,'3134352658','','','','MULTISERVICIO','','Independiente',100,NULL,11,11,'2017-08-05 13:51:12','2017-08-05 13:51:12'),(76,'JAIRO ANTONIO ROJAS OSORIO','10124076','09-02-1966','TORRE 1A APTO 403','CIUDADELA SALAMANCA',1,'3136242516','3196499192','','N/A','COMERCIANTE','VENTA DE CELULARES','Independiente',100,NULL,20,20,'2017-08-05 14:10:12','2017-08-05 14:10:12'),(77,'YEINER MACHADO ARAGON','1088273938','30-04-1989','MANZANA 9 CASA 33','DORADO 1 CUBA',1,'3217594126','3129015','mahecho@gmail.com','NNL74B','GESTOR DOCUMENTAL','ARMADA NACIONAL ','Dependiente',100,NULL,11,11,'2017-08-05 14:10:41','2017-08-05 14:10:41');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codeudores`
--

DROP TABLE IF EXISTS `codeudores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codeudores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codeudor` enum('si','no') COLLATE utf8_unicode_ci NOT NULL,
  `nombrec` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_docc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `movilc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fijoc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codeudores`
--

LOCK TABLES `codeudores` WRITE;
/*!40000 ALTER TABLE `codeudores` DISABLE KEYS */;
INSERT INTO `codeudores` VALUES (100,'no','','','','',NULL,NULL),(101,'si','MARTHA CECILIA ALVAREZ HENAO','24765954','3212298410','','2017-08-01 10:29:21','2017-08-01 10:29:21'),(102,'si','ALCIDES ANTONIO CORREA TREJOS','10115538','3117515360','','2017-08-02 08:52:06','2017-08-02 08:52:06'),(103,'si','BRAYAN HOYOS OSPINA','1088315136','3143755763','3446007','2017-08-03 12:22:22','2017-08-03 12:22:22'),(104,'si','JOSE ROMAN ROTAVISKY MOLINA','75080397','3209082369','8825528','2017-08-03 14:16:12','2017-08-03 14:16:12'),(105,'si','DANILO VANEGAS ARRUBLAS','10144438','3005118886','','2017-08-05 13:35:24','2017-08-05 13:35:24');
/*!40000 ALTER TABLE `codeudores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creditos`
--

DROP TABLE IF EXISTS `creditos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creditos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `precredito_id` int(10) unsigned NOT NULL,
  `cuotas_faltantes` int(11) NOT NULL,
  `saldo` double DEFAULT NULL,
  `saldo_favor` double DEFAULT NULL,
  `estado` enum('Al dia','Mora','Prejuridico','Juridico','Refinanciacion','Cancelado') COLLATE utf8_unicode_ci NOT NULL,
  `rendimiento` double NOT NULL,
  `valor_credito` double NOT NULL,
  `castigada` enum('Si','No') COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_create_id` int(10) unsigned NOT NULL,
  `user_update_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `creditos_precredito_id_foreign` (`precredito_id`),
  KEY `creditos_user_create_id_foreign` (`user_create_id`),
  KEY `creditos_user_update_id_foreign` (`user_update_id`),
  CONSTRAINT `creditos_precredito_id_foreign` FOREIGN KEY (`precredito_id`) REFERENCES `precreditos` (`id`),
  CONSTRAINT `creditos_user_create_id_foreign` FOREIGN KEY (`user_create_id`) REFERENCES `users` (`id`),
  CONSTRAINT `creditos_user_update_id_foreign` FOREIGN KEY (`user_update_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditos`
--

LOCK TABLES `creditos` WRITE;
/*!40000 ALTER TABLE `creditos` DISABLE KEYS */;
INSERT INTO `creditos` VALUES (31,29,20,7000000,NULL,'Al dia',0,7000000,'No',8,8,'2017-08-01 10:40:15','2017-08-01 10:40:15'),(32,38,30,3600000,NULL,'Al dia',1500000,3600000,'No',8,8,'2017-08-02 12:21:12','2017-08-02 12:21:12'),(33,40,16,680000,NULL,'Al dia',360000,640000,'No',8,8,'2017-08-02 12:48:57','2017-08-02 12:51:43'),(34,46,16,841600,0,'Al dia',316100,841600,'No',10,10,'2017-08-02 19:31:46','2017-08-02 19:33:15'),(35,34,16,417600,NULL,'Al dia',156900,417600,'No',10,10,'2017-08-02 19:36:24','2017-08-02 19:36:24'),(36,48,2,360000,NULL,'Al dia',60000,360000,'No',10,10,'2017-08-02 19:50:21','2017-08-02 19:50:21'),(37,42,20,894000,NULL,'Al dia',368200,894000,'No',11,11,'2017-08-04 14:25:09','2017-08-04 14:25:09'),(38,61,12,413500,NULL,'Mora',150000,450000,'No',11,1,'2017-08-04 14:41:21','2017-08-07 03:27:16'),(39,53,20,680000,NULL,'Al dia',280000,680000,'No',10,10,'2017-08-04 15:15:00','2017-08-04 15:15:00'),(40,31,12,750000,NULL,'Al dia',250000,750000,'No',10,10,'2017-08-04 15:20:01','2017-08-04 15:20:01'),(41,43,10,894000,NULL,'Al dia',368500,894000,'No',10,10,'2017-08-04 15:23:47','2017-08-04 15:23:47'),(42,44,6,533400,0,'Al dia',122700,533400,'Si',10,2,'2017-08-04 15:31:40','2017-08-10 22:14:35'),(43,35,8,575200,NULL,'Al dia',164500,575200,'No',10,10,'2017-08-04 15:35:48','2017-08-04 15:35:48'),(44,51,20,742000,NULL,'Al dia',305600,742000,'No',10,10,'2017-08-04 15:57:44','2017-08-04 15:57:44'),(45,41,8,576000,NULL,'Al dia',165000,576000,'No',10,10,'2017-08-04 16:00:08','2017-08-04 16:00:08'),(46,62,10,790000,NULL,'Al dia',264200,790000,'No',10,10,'2017-08-04 16:12:28','2017-08-04 16:12:28'),(47,69,20,919000,NULL,'Al dia',378600,919000,'No',10,10,'2017-08-04 19:27:56','2017-08-04 19:27:56'),(48,57,12,661200,NULL,'Al dia',220800,661200,'No',10,10,'2017-08-04 19:29:26','2017-08-04 19:29:26'),(49,55,20,894000,NULL,'Al dia',368500,894000,'No',10,10,'2017-08-04 19:30:34','2017-08-04 19:30:34'),(50,49,5,775500,NULL,'Al dia',270200,810600,'No',10,10,'2017-08-04 19:32:36','2017-08-09 04:40:15'),(51,36,4,155800,NULL,'Al dia',26100,155800,'No',10,10,'2017-08-04 19:34:07','2017-08-04 19:34:07'),(52,65,20,1474000,NULL,'Al dia',607540,1474000,'No',10,10,'2017-08-04 19:34:56','2017-08-04 19:34:56'),(53,67,7,628400,NULL,'Al dia',208200,728400,'No',10,10,'2017-08-04 19:35:59','2017-08-10 22:46:50'),(54,63,11,696400,0,'Al dia',254000,760800,'No',10,2,'2017-08-04 19:36:48','2017-08-08 13:34:10'),(55,45,20,894000,NULL,'Al dia',368500,894000,'No',10,10,'2017-08-04 19:37:28','2017-08-04 19:37:28');
/*!40000 ALTER TABLE `creditos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `criterios`
--

DROP TABLE IF EXISTS `criterios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criterios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `criterio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criterios`
--

LOCK TABLES `criterios` WRITE;
/*!40000 ALTER TABLE `criterios` DISABLE KEYS */;
INSERT INTO `criterios` VALUES (1,'Mora','',NULL,'2017-06-29 07:40:31'),(2,'Prejuridico','',NULL,NULL),(14,'Juridico','Estado juridico','2017-06-29 07:45:26','2017-06-29 07:45:26'),(15,'ACUERDO DE PAGO','','2017-08-01 08:41:46','2017-08-01 08:41:46');
/*!40000 ALTER TABLE `criterios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `egresos`
--

DROP TABLE IF EXISTS `egresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `egresos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comprobante_egreso` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `concepto` enum('Gastos','Compras','Prestamos','Pago a Proveedores') COLLATE utf8_unicode_ci NOT NULL,
  `valor` double NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `cartera_id` int(10) unsigned NOT NULL,
  `user_create_id` int(10) unsigned NOT NULL,
  `user_update_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `egresos_cartera_id_foreign` (`cartera_id`),
  KEY `egresos_user_create_id_foreign` (`user_create_id`),
  KEY `egresos_user_update_id_foreign` (`user_update_id`),
  CONSTRAINT `egresos_cartera_id_foreign` FOREIGN KEY (`cartera_id`) REFERENCES `carteras` (`id`),
  CONSTRAINT `egresos_user_create_id_foreign` FOREIGN KEY (`user_create_id`) REFERENCES `users` (`id`),
  CONSTRAINT `egresos_user_update_id_foreign` FOREIGN KEY (`user_update_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `egresos`
--

LOCK TABLES `egresos` WRITE;
/*!40000 ALTER TABLE `egresos` DISABLE KEYS */;
/*!40000 ALTER TABLE `egresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `est_datacreditos`
--

DROP TABLE IF EXISTS `est_datacreditos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `est_datacreditos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `criterio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `puntaje` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `est_datacreditos`
--

LOCK TABLES `est_datacreditos` WRITE;
/*!40000 ALTER TABLE `est_datacreditos` DISABLE KEYS */;
INSERT INTO `est_datacreditos` VALUES (1,'E',5),(2,'A',4),(3,'B',3),(4,'C',2),(5,'7',2),(6,'P',0),(7,'Otros',1);
/*!40000 ALTER TABLE `est_datacreditos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `est_laborales`
--

DROP TABLE IF EXISTS `est_laborales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `est_laborales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `criterio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `puntaje` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `est_laborales`
--

LOCK TABLES `est_laborales` WRITE;
/*!40000 ALTER TABLE `est_laborales` DISABLE KEYS */;
INSERT INTO `est_laborales` VALUES (1,'Dependiente mayor de dos (2) años',5),(2,'Dependiente mayor de un (1) año',4),(3,'Dependiente menor o igual a un (1) año',3),(4,'Dependiente menor de 6 meses',2),(5,'Independiente mayor de tres (3) años sin Cámara',4),(6,'Independiente mayor de tres (3) años con Cámara',5),(7,'Independiente mayor de un (1) año',3),(8,'Independiente menor de un (1) año',2);
/*!40000 ALTER TABLE `est_laborales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `est_referencias`
--

DROP TABLE IF EXISTS `est_referencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `est_referencias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `criterio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `puntaje` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `est_referencias`
--

LOCK TABLES `est_referencias` WRITE;
/*!40000 ALTER TABLE `est_referencias` DISABLE KEYS */;
INSERT INTO `est_referencias` VALUES (1,'Validacion cuatro (4) referencias',5),(2,'Validacion tres (3) referencias',4),(3,'Validacion dos (2) referencias',3),(4,'Dos (2) referencias inconsistentes',1),(5,'Una (1) referencia inconsistente',2),(6,'Referencias no favorables',0);
/*!40000 ALTER TABLE `est_referencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `est_viviendas`
--

DROP TABLE IF EXISTS `est_viviendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `est_viviendas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `criterio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `puntaje` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `est_viviendas`
--

LOCK TABLES `est_viviendas` WRITE;
/*!40000 ALTER TABLE `est_viviendas` DISABLE KEYS */;
INSERT INTO `est_viviendas` VALUES (1,'Mayor a tres (3) años familiar o propia',5),(2,'Mayor a tres (3) años alquilada',5),(3,'Mayor a dos (2) años',4),(4,'Menor a dos (2) años',3),(5,'Menor a un (1) año',2),(6,'Menor a cuatro (4) meses',1);
/*!40000 ALTER TABLE `est_viviendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudios`
--

DROP TABLE IF EXISTS `estudios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) unsigned DEFAULT NULL,
  `codeudor_id` int(10) unsigned DEFAULT NULL,
  `funcionario_id` int(10) unsigned NOT NULL,
  `estDatacredito_id` int(10) unsigned NOT NULL,
  `estLaboral_id` int(10) unsigned NOT NULL,
  `estVivienda_id` int(10) unsigned NOT NULL,
  `estReferencia_id` int(10) unsigned NOT NULL,
  `cal_asesor` double NOT NULL,
  `cal_estudio` double NOT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_create_id` int(10) unsigned NOT NULL,
  `user_update_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estudios_cliente_id_foreign` (`cliente_id`),
  KEY `estudios_codeudor_id_foreign` (`codeudor_id`),
  KEY `estudios_funcionario_id_foreign` (`funcionario_id`),
  KEY `estudios_estdatacredito_id_foreign` (`estDatacredito_id`),
  KEY `estudios_estlaboral_id_foreign` (`estLaboral_id`),
  KEY `estudios_estvivienda_id_foreign` (`estVivienda_id`),
  KEY `estudios_estreferencia_id_foreign` (`estReferencia_id`),
  KEY `estudios_user_create_id_foreign` (`user_create_id`),
  KEY `estudios_user_update_id_foreign` (`user_update_id`),
  CONSTRAINT `estudios_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `estudios_codeudor_id_foreign` FOREIGN KEY (`codeudor_id`) REFERENCES `codeudores` (`id`),
  CONSTRAINT `estudios_estdatacredito_id_foreign` FOREIGN KEY (`estDatacredito_id`) REFERENCES `est_datacreditos` (`id`),
  CONSTRAINT `estudios_estlaboral_id_foreign` FOREIGN KEY (`estLaboral_id`) REFERENCES `est_laborales` (`id`),
  CONSTRAINT `estudios_estreferencia_id_foreign` FOREIGN KEY (`estReferencia_id`) REFERENCES `est_referencias` (`id`),
  CONSTRAINT `estudios_estvivienda_id_foreign` FOREIGN KEY (`estVivienda_id`) REFERENCES `est_viviendas` (`id`),
  CONSTRAINT `estudios_funcionario_id_foreign` FOREIGN KEY (`funcionario_id`) REFERENCES `users` (`id`),
  CONSTRAINT `estudios_user_create_id_foreign` FOREIGN KEY (`user_create_id`) REFERENCES `users` (`id`),
  CONSTRAINT `estudios_user_update_id_foreign` FOREIGN KEY (`user_update_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudios`
--

LOCK TABLES `estudios` WRITE;
/*!40000 ALTER TABLE `estudios` DISABLE KEYS */;
INSERT INTO `estudios` VALUES (25,31,NULL,11,4,3,6,2,4,2.75,'',11,11,'2017-08-01 10:05:01','2017-08-01 10:05:01'),(26,NULL,102,11,4,1,1,2,5,3.6,'',11,11,'2017-08-02 09:15:40','2017-08-02 09:15:40'),(27,37,NULL,11,5,7,1,2,5,3.3,'Al cliente se le solicita codeudor por que no tiene experiencia crediticia',11,11,'2017-08-02 09:16:32','2017-08-02 09:17:51'),(28,40,NULL,11,4,3,2,1,5,3.5,'',11,11,'2017-08-02 11:03:28','2017-08-02 11:03:28'),(29,41,NULL,8,3,1,3,2,3,3.6,'Cliente, que se encuentra en JURIDICO, con el radicado número 2017-327-00, en el Juzgado 6 civil municipal de Pereira',8,8,'2017-08-02 11:44:53','2017-08-02 11:44:53'),(30,42,NULL,11,3,2,1,1,5,4.05,'',11,11,'2017-08-02 12:11:13','2017-08-02 12:11:13'),(31,43,NULL,8,3,2,2,1,3,3.75,'',8,8,'2017-08-02 12:47:01','2017-08-02 12:47:01'),(32,44,NULL,11,4,5,2,1,5,3.65,'',11,11,'2017-08-02 14:55:13','2017-08-02 14:55:13'),(33,46,NULL,11,4,1,1,1,5,3.8,'',11,11,'2017-08-02 15:46:33','2017-08-02 15:46:33'),(34,45,NULL,11,4,1,2,1,5,3.8,'',11,11,'2017-08-02 15:47:10','2017-08-02 15:47:10'),(35,48,NULL,11,4,3,1,1,5,3.5,'',11,11,'2017-08-02 18:08:13','2017-08-02 18:08:13'),(36,49,NULL,11,2,2,4,1,5,4.25,'',11,11,'2017-08-02 18:23:25','2017-08-02 18:23:25'),(37,50,NULL,11,6,8,6,6,4,1,'',11,11,'2017-08-02 18:34:11','2017-08-02 18:34:11'),(38,51,NULL,8,2,1,1,1,5,4.6,'HA REPETIDO VARIOS CREDITOS Y ESTA EN EL SISTEMA ANTERIOR',10,10,'2017-08-02 19:50:04','2017-08-02 19:50:04'),(39,52,NULL,11,2,1,1,1,5,4.6,'',11,11,'2017-08-03 09:36:08','2017-08-03 09:36:08'),(40,53,NULL,11,1,3,1,1,5,4.7,'',11,11,'2017-08-03 10:24:18','2017-08-03 10:24:18'),(41,NULL,103,10,4,3,1,1,4,3.35,'',11,11,'2017-08-03 12:23:58','2017-08-03 12:23:58'),(42,54,NULL,11,2,5,4,1,4,4.1,'',11,11,'2017-08-03 12:37:43','2017-08-03 12:37:43'),(43,55,NULL,11,4,3,1,1,5,3.5,'',11,11,'2017-08-03 12:46:29','2017-08-03 12:46:29'),(44,56,NULL,11,1,3,5,2,5,4.2,'',11,11,'2017-08-03 12:53:49','2017-08-03 12:53:49'),(45,39,NULL,11,1,1,1,2,5,4.8,'',11,11,'2017-08-03 12:56:39','2017-08-03 12:56:39'),(46,57,NULL,11,6,1,1,2,5,2.8,'',11,11,'2017-08-03 14:19:29','2017-08-03 14:19:29'),(47,NULL,104,11,4,3,1,6,5,2.5,'',11,11,'2017-08-03 14:20:19','2017-08-03 14:20:19'),(48,58,NULL,11,1,7,1,1,5,4.7,'',11,11,'2017-08-03 15:44:56','2017-08-03 15:44:56'),(49,59,NULL,11,4,3,1,1,5,3.5,'',11,11,'2017-08-03 15:55:03','2017-08-03 15:55:23'),(50,61,NULL,11,4,8,4,6,5,2.15,'',11,11,'2017-08-04 10:33:20','2017-08-04 10:33:20'),(51,63,NULL,11,3,2,2,1,5,4.05,'',11,11,'2017-08-04 11:38:04','2017-08-04 11:38:04'),(52,62,NULL,11,4,1,3,1,5,3.7,'',11,11,'2017-08-04 11:42:43','2017-08-04 11:42:43'),(53,34,NULL,11,1,1,1,2,5,4.8,'',11,11,'2017-08-04 11:57:26','2017-08-04 11:57:26'),(54,64,NULL,11,2,7,1,2,5,4.1,'',11,11,'2017-08-04 14:40:38','2017-08-04 14:40:38'),(55,65,NULL,11,3,1,1,1,5,4.2,'',11,11,'2017-08-04 15:02:16','2017-08-04 15:02:16'),(56,66,NULL,11,3,1,4,1,5,4,'',11,11,'2017-08-04 15:34:52','2017-08-04 15:34:52'),(57,66,NULL,11,3,1,4,1,5,4,'',11,11,'2017-08-04 15:34:53','2017-08-04 15:34:53'),(58,38,NULL,11,4,3,4,2,4,2.95,'',11,11,'2017-08-04 15:39:07','2017-08-04 15:39:07'),(59,67,NULL,11,1,3,3,1,5,4.6,'',11,11,'2017-08-04 16:04:28','2017-08-04 16:04:28'),(60,68,NULL,11,4,2,1,1,4,3.5,'',11,11,'2017-08-04 16:13:12','2017-08-04 16:13:46'),(61,70,NULL,11,2,1,1,1,4,4.45,'',11,11,'2017-08-04 17:22:14','2017-08-04 17:22:14'),(62,69,NULL,11,4,5,1,1,5,3.65,'',11,11,'2017-08-05 10:24:49','2017-08-05 10:24:49'),(63,73,NULL,11,4,2,3,1,5,3.55,'',11,11,'2017-08-05 12:54:38','2017-08-05 12:54:38'),(64,NULL,105,11,1,1,1,2,5,4.8,'',11,11,'2017-08-05 13:35:45','2017-08-05 13:35:45'),(65,75,NULL,11,4,7,2,6,5,2.5,'',11,11,'2017-08-05 13:56:11','2017-08-05 13:56:11'),(66,77,NULL,11,4,1,1,3,5,3.4,'',11,11,'2017-08-05 14:15:39','2017-08-05 14:15:39'),(67,76,NULL,20,3,1,1,3,5,3.8,'',20,20,'2017-08-05 14:29:10','2017-08-05 14:29:10');
/*!40000 ALTER TABLE `estudios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extras`
--

DROP TABLE IF EXISTS `extras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `concepto` enum('Prejuridico','Juridico','Multa','Descuento') COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('Ok','Debe','Finalizado') COLLATE utf8_unicode_ci NOT NULL,
  `valor` double NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `credito_id` int(10) unsigned NOT NULL,
  `user_create_id` int(10) unsigned NOT NULL,
  `user_update_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `extras_credito_id_foreign` (`credito_id`),
  KEY `extras_user_create_id_foreign` (`user_create_id`),
  KEY `extras_user_update_id_foreign` (`user_update_id`),
  CONSTRAINT `extras_credito_id_foreign` FOREIGN KEY (`credito_id`) REFERENCES `creditos` (`id`),
  CONSTRAINT `extras_user_create_id_foreign` FOREIGN KEY (`user_create_id`) REFERENCES `users` (`id`),
  CONSTRAINT `extras_user_update_id_foreign` FOREIGN KEY (`user_update_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extras`
--

LOCK TABLES `extras` WRITE;
/*!40000 ALTER TABLE `extras` DISABLE KEYS */;
INSERT INTO `extras` VALUES (10,'02-08-2017','Juridico','Debe',40000,'Se le anexa 40000, porque el sistema no deja cuotas impares, y el cliente quedo de cancelar 17 cuotas quincenales y estan registrada 16, equivalente a 8 meses',33,8,8,'2017-08-02 12:51:43','2017-08-02 12:51:43'),(11,'08-08-2017','Multa','Finalizado',0,'',50,2,2,'2017-08-09 04:38:06','2017-08-09 04:38:18'),(12,'08-08-2017','Multa','Debe',100000,'',50,2,2,'2017-08-09 04:40:15','2017-08-09 04:40:15');
/*!40000 ALTER TABLE `extras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `credito_id` int(10) unsigned DEFAULT NULL,
  `num_fact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` double NOT NULL,
  `tipo` enum('Efectivo','Consignacion') COLLATE utf8_unicode_ci NOT NULL,
  `fecha_proximo_pago` date NOT NULL,
  `user_create_id` int(10) unsigned NOT NULL,
  `user_update_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facturas_credito_id_foreign` (`credito_id`),
  KEY `facturas_user_create_id_foreign` (`user_create_id`),
  KEY `facturas_user_update_id_foreign` (`user_update_id`),
  CONSTRAINT `facturas_credito_id_foreign` FOREIGN KEY (`credito_id`) REFERENCES `creditos` (`id`),
  CONSTRAINT `facturas_user_create_id_foreign` FOREIGN KEY (`user_create_id`) REFERENCES `users` (`id`),
  CONSTRAINT `facturas_user_update_id_foreign` FOREIGN KEY (`user_update_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
INSERT INTO `facturas` VALUES (30,54,'21357','02-08-2017',64400,'Efectivo','2017-09-01',10,10,'2017-08-05 15:00:28','2017-08-05 15:00:28'),(31,38,'1111','06-07-2017',37500,'Consignacion','2017-08-18',2,2,'2017-08-07 03:27:16','2017-08-07 03:27:16'),(32,53,'2222','06-07-2017',100000,'Efectivo','2017-09-17',2,2,'2017-08-07 03:27:57','2017-08-07 03:27:57'),(33,50,'3333','06-08-2018',135100,'Efectivo','2017-09-27',8,8,'2017-08-07 03:30:03','2017-08-07 03:30:03'),(36,NULL,'4433','08-08-2017',155000,'Efectivo','0000-00-00',2,2,'2017-08-08 14:53:51','2017-08-08 14:53:51');
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fecha_cobros`
--

DROP TABLE IF EXISTS `fecha_cobros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fecha_cobros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `credito_id` int(10) unsigned NOT NULL,
  `fecha_pago` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fecha_cobros_credito_id_foreign` (`credito_id`),
  CONSTRAINT `fecha_cobros_credito_id_foreign` FOREIGN KEY (`credito_id`) REFERENCES `creditos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fecha_cobros`
--

LOCK TABLES `fecha_cobros` WRITE;
/*!40000 ALTER TABLE `fecha_cobros` DISABLE KEYS */;
INSERT INTO `fecha_cobros` VALUES (31,31,'2017-08-26','2017-08-01 10:40:15','2017-08-01 10:40:15'),(32,32,'2017-08-15','2017-08-02 12:21:12','2017-08-02 12:21:12'),(33,33,'2017-08-16','2017-08-02 12:48:57','2017-08-02 12:48:57'),(34,34,'2017-08-17','2017-08-02 19:31:46','2017-08-02 19:31:46'),(35,35,'2017-08-18','2017-08-02 19:36:24','2017-08-02 19:36:24'),(36,36,'2017-08-29','2017-08-02 19:50:21','2017-08-02 19:50:21'),(37,37,'2017-08-17','2017-08-04 14:25:09','2017-08-04 14:25:09'),(38,38,'2017-08-18','2017-08-04 14:41:21','2017-08-07 03:27:16'),(39,39,'2017-08-16','2017-08-04 15:15:00','2017-08-04 15:15:00'),(40,40,'2017-08-16','2017-08-04 15:20:01','2017-08-04 15:20:01'),(41,41,'2017-09-05','2017-08-04 15:23:47','2017-08-04 15:23:47'),(42,42,'2017-08-20','2017-08-04 15:31:40','2017-08-04 15:31:40'),(43,43,'2017-08-18','2017-08-04 15:35:48','2017-08-04 15:35:48'),(44,44,'2017-08-15','2017-08-04 15:57:44','2017-08-04 15:57:44'),(45,45,'2017-08-17','2017-08-04 16:00:08','2017-08-04 16:00:08'),(46,46,'2017-08-18','2017-08-04 16:12:28','2017-08-04 16:12:28'),(47,47,'2017-08-16','2017-08-04 19:27:56','2017-08-04 19:27:56'),(48,48,'2017-08-17','2017-08-04 19:29:26','2017-08-04 19:29:26'),(49,49,'2017-08-17','2017-08-04 19:30:34','2017-08-04 19:30:34'),(50,50,'2017-09-27','2017-08-04 19:32:36','2017-08-07 03:30:03'),(51,51,'2017-08-17','2017-08-04 19:34:07','2017-08-04 19:34:07'),(52,52,'2017-08-16','2017-08-04 19:34:56','2017-08-04 19:34:56'),(53,53,'2017-09-17','2017-08-04 19:35:59','2017-08-07 03:27:57'),(54,54,'2017-09-01','2017-08-04 19:36:48','2017-08-05 15:00:28'),(55,55,'2017-08-18','2017-08-04 19:37:28','2017-08-04 19:37:28');
/*!40000 ALTER TABLE `fecha_cobros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `llamadas`
--

DROP TABLE IF EXISTS `llamadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `llamadas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `credito_id` int(10) unsigned NOT NULL,
  `criterio_id` int(10) unsigned NOT NULL,
  `agenda` date DEFAULT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci,
  `user_create_id` int(10) unsigned NOT NULL,
  `user_update_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `llamadas_credito_id_foreign` (`credito_id`),
  KEY `llamadas_criterio_id_foreign` (`criterio_id`),
  KEY `llamadas_user_create_id_foreign` (`user_create_id`),
  KEY `llamadas_user_update_id_foreign` (`user_update_id`),
  CONSTRAINT `llamadas_credito_id_foreign` FOREIGN KEY (`credito_id`) REFERENCES `creditos` (`id`),
  CONSTRAINT `llamadas_criterio_id_foreign` FOREIGN KEY (`criterio_id`) REFERENCES `criterios` (`id`),
  CONSTRAINT `llamadas_user_create_id_foreign` FOREIGN KEY (`user_create_id`) REFERENCES `users` (`id`),
  CONSTRAINT `llamadas_user_update_id_foreign` FOREIGN KEY (`user_update_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `llamadas`
--

LOCK TABLES `llamadas` WRITE;
/*!40000 ALTER TABLE `llamadas` DISABLE KEYS */;
INSERT INTO `llamadas` VALUES (2,31,1,'2017-08-30','La señora Martha que es la mamá de la clienta, se esta haciendo responsable de la obligación',8,8,'2017-08-02 09:51:41','2017-08-02 09:51:41');
/*!40000 ALTER TABLE `llamadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_07_22_204628_create_puntos_table',1),('2014_10_12_000000_create_users_table',2),('2014_10_12_100000_create_password_resets_table',2),('2017_04_02_143959_create_carteras_table',2),('2017_04_02_234020_create_municipios_table',2),('2017_04_02_234519_create_codeudores_table',2),('2017_04_02_234520_create_clientes_table',2),('2017_04_04_103813_create_productos_table',2),('2017_04_04_103813_create_variables_table',2),('2017_04_04_103814_create_precreditos_table',2),('2017_04_14_142110_create_est_laborales_table',2),('2017_04_14_142111_create_est_datacreditos_table',2),('2017_04_14_142223_create_est_viviendas_table',2),('2017_04_14_142318_create_est_referencias_table',2),('2017_04_14_142320_create_estudios_table',2),('2017_04_15_144546_create_creditos_table',2),('2017_04_25_205253_create_facturas_table',2),('2017_04_25_205321_create_pagos_table',2),('2017_04_25_205338_create_extras_table',2),('2017_04_25_215338_create_sanciones_table',2),('2017_05_26_172437_create_criterios_table',2),('2017_05_26_172645_create_llamadas_table',2),('2017_05_30_110902_create_fecha_cobros_table',2),('2017_06_01_142425_create_auditorias_table',2),('2017_06_08_085427_create_egresos_table',2),('2017_06_23_155415_create_call_busquedas_table',2),('2017_07_17_201204_create_anuladas_table',2),('2017_06_14_142501_create_otros_pagos_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipios`
--

DROP TABLE IF EXISTS `municipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `departamento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1217 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipios`
--

LOCK TABLES `municipios` WRITE;
/*!40000 ALTER TABLE `municipios` DISABLE KEYS */;
INSERT INTO `municipios` VALUES (1,'Pereira','Risaralda'),(2,'Dosquebradas','Risaralda'),(3,'Manizales','Caldas'),(4,'Armenia','Quindio'),(100,'',''),(101,'ABEJORRAL','ANTIOQUIA'),(102,'ABREGO','NORTE DE SANTANDER'),(103,'ABRIAQUI','ANTIOQUIA'),(104,'ACACIAS','META'),(105,'ACANDI','CHOCÓ'),(106,'ACEVEDO','HUILA'),(107,'ACHI','BOLÍVAR'),(108,'AGRADO','HUILA'),(109,'AGUA DE DIOS','CUNDINAMARCA'),(110,'AGUACHICA','CESAR'),(111,'AGUADA','SANTANDER'),(112,'AGUADAS','CALDAS'),(113,'AGUAZUL','CASANARE'),(114,'AGUSTIN CODAZZI','CESAR'),(115,'AIPE','HUILA'),(116,'ALBAN','CUNDINAMARCA'),(117,'ALBAN','NARIÑO'),(118,'ALBANIA','CAQUETÁ'),(119,'ALBANIA','LA GUAJIRA'),(120,'ALBANIA','SANTANDER'),(121,'ALCALA','VALLE DEL CAUCA'),(122,'ALDANA','NARIÑO'),(123,'ALEJANDRIA','ANTIOQUIA'),(124,'ALGARROBO','MAGDALENA'),(125,'ALGECIRAS','HUILA'),(126,'ALMAGUER','CAUCA'),(127,'ALMEIDA','BOYACÁ'),(128,'ALPUJARRA','TOLIMA'),(129,'ALTAMIRA','HUILA'),(130,'ALTO BAUDO','CHOCÓ'),(131,'ALTOS DEL ROSARIO','BOLÍVAR'),(132,'ALVARADO','TOLIMA'),(133,'AMAGA','ANTIOQUIA'),(134,'AMALFI','ANTIOQUIA'),(135,'AMBALEMA','TOLIMA'),(136,'ANAPOIMA','CUNDINAMARCA'),(137,'ANCUYA','NARIÑO'),(138,'ANDALUCIA','VALLE DEL CAUCA'),(139,'ANDES','ANTIOQUIA'),(140,'ANGELOPOLIS','ANTIOQUIA'),(141,'ANGOSTURA','ANTIOQUIA'),(142,'ANOLAIMA','CUNDINAMARCA'),(143,'ANORI','ANTIOQUIA'),(144,'ANSERMA','CALDAS'),(145,'ANSERMANUEVO','VALLE DEL CAUCA'),(146,'ANZA','ANTIOQUIA'),(147,'ANZOATEGUI','TOLIMA'),(148,'APARTADO','ANTIOQUIA'),(149,'APIA','RISARALDA'),(150,'APULO','CUNDINAMARCA'),(151,'AQUITANIA','BOYACÁ'),(152,'ARACATACA','MAGDALENA'),(153,'ARANZAZU','CALDAS'),(154,'ARATOCA','SANTANDER'),(155,'ARAUCA','ARAUCA'),(156,'ARAUQUITA','ARAUCA'),(157,'ARBELAEZ','CUNDINAMARCA'),(158,'ARBOLEDA','NARIÑO'),(159,'ARBOLEDAS','NORTE DE SANTANDER'),(160,'ARBOLETES','ANTIOQUIA'),(161,'ARCABUCO','BOYACÁ'),(162,'ARENAL','BOLÍVAR'),(163,'ARGELIA','CAUCA'),(164,'ARGELIA','VALLE DEL CAUCA'),(165,'ARGELIA','ANTIOQUIA'),(166,'ARIGUANI','MAGDALENA'),(167,'ARJONA','BOLÍVAR'),(168,'ARMENIA','QUINDIO'),(169,'ARMERO','TOLIMA'),(170,'ARROYOHONDO','BOLÍVAR'),(171,'ASTREA','CESAR'),(172,'ATACO','TOLIMA'),(173,'ATRATO','CHOCÓ'),(174,'AYAPEL','CÓRDOBA'),(175,'BAGADO','CHOCÓ'),(176,'BAHIA SOLANO','CHOCÓ'),(177,'BAJO BAUDO','CHOCÓ'),(178,'BALBOA','CAUCA'),(179,'BALBOA','RISARALDA'),(180,'BARANOA','ATLÁNTICO'),(181,'BARAYA','HUILA'),(182,'BARBACOAS','NARIÑO'),(183,'BARBOSA','SANTANDER'),(184,'BARBOSA','ANTIOQUIA'),(185,'BARICHARA','SANTANDER'),(186,'BARRANCA DE UPIA','META'),(187,'BARRANCABERMEJA','SANTANDER'),(188,'BARRANCAS','LA GUAJIRA'),(189,'BARRANCO DE LOBA','BOLÍVAR'),(190,'BARRANCO MINAS','GUAINÍA'),(191,'BARRANQUILLA','ATLÁNTICO'),(192,'BECERRIL','CESAR'),(193,'BELALCAZAR','CALDAS'),(194,'BELEN','NARIÑO'),(195,'BELEN','BOYACÁ'),(196,'BELEN DE LOS ANDAQUIES','CAQUETÁ'),(197,'BELEN DE UMBRIA','RISARALDA'),(198,'BELLO','ANTIOQUIA'),(199,'BELMIRA','ANTIOQUIA'),(200,'BELTRAN','CUNDINAMARCA'),(201,'BERBEO','BOYACÁ'),(202,'BETANIA','ANTIOQUIA'),(203,'BETEITIVA','BOYACÁ'),(204,'BETULIA','SANTANDER'),(205,'BETULIA','ANTIOQUIA'),(206,'BITUIMA','CUNDINAMARCA'),(207,'BOAVITA','BOYACÁ'),(208,'BOCHALEMA','NORTE DE SANTANDER'),(209,'BOGOTA D.C.','BOGOTÁ'),(210,'BOJACA','CUNDINAMARCA'),(211,'BOJAYA','CHOCÓ'),(212,'BOLIVAR','CAUCA'),(213,'BOLIVAR','SANTANDER'),(214,'BOLIVAR','VALLE DEL CAUCA'),(215,'BOSCONIA','CESAR'),(216,'BOYACA','BOYACÁ'),(217,'BOYACABRICEÑO','BOYACÁ'),(218,'BRICEÑO','ANTIOQUIA'),(219,'BUCARAMANGA','SANTANDER'),(220,'BUCARASICA','NORTE DE SANTANDER'),(221,'BUENAVENTURA','VALLE DEL CAUCA'),(222,'BUENAVISTA','CÓRDOBA'),(223,'BUENAVISTA','SUCRE'),(224,'BUENAVISTA','QUINDIO'),(225,'BUENAVISTA','BOYACÁ'),(226,'BUENOS AIRES','CAUCA'),(227,'BUESACO','NARIÑO'),(228,'BUGALAGRANDE','VALLE DEL CAUCA'),(229,'BURITICA','ANTIOQUIA'),(230,'BUSBANZA','BOYACÁ'),(231,'CABRERA','CUNDINAMARCA'),(232,'CABRERA','SANTANDER'),(233,'CABUYARO','META'),(234,'CACAHUAL','GUAINÍA'),(235,'CACERES','ANTIOQUIA'),(236,'CACHIPAY','CUNDINAMARCA'),(237,'CACHIRA','NORTE DE SANTANDER'),(238,'CACOTA','NORTE DE SANTANDER'),(239,'CAICEDO','ANTIOQUIA'),(240,'CAICEDONIA','VALLE DEL CAUCA'),(241,'CAIMITO','SUCRE'),(242,'CAJAMARCA','TOLIMA'),(243,'CAJIBIO','CAUCA'),(244,'CAJICA','CUNDINAMARCA'),(245,'CALAMAR','GUAVIARE'),(246,'CALAMAR','BOLÍVAR'),(247,'CALARCA','QUINDIO'),(248,'CALDAS','ANTIOQUIA'),(249,'CALDAS','BOYACÁ'),(250,'CALDONO','CAUCA'),(251,'CALI','VALLE DEL CAUCA'),(252,'CALIFORNIA','SANTANDER'),(253,'CALIMA','VALLE DEL CAUCA'),(254,'CALOTO','CAUCA'),(255,'CAMPAMENTO','ANTIOQUIA'),(256,'CAMPO DE LA CRUZ','ATLÁNTICO'),(257,'CAMPOALEGRE','HUILA'),(258,'CAMPOHERMOSO','BOYACÁ'),(259,'CANALETE','CÓRDOBA'),(260,'CAÑASGORDAS','ANTIOQUIA'),(261,'CANDELARIA','VALLE DEL CAUCA'),(262,'CANDELARIA','ATLÁNTICO'),(263,'CANTAGALLO','BOLÍVAR'),(264,'CAPARRAPI','CUNDINAMARCA'),(265,'CAPITANEJO','SANTANDER'),(266,'CAQUEZA','CUNDINAMARCA'),(267,'CARACOLI','ANTIOQUIA'),(268,'CARAMANTA','ANTIOQUIA'),(269,'CARCASI','SANTANDER'),(270,'CAREPA','ANTIOQUIA'),(271,'CARMEN DE APICALA','TOLIMA'),(272,'CARMEN DE CARUPA','CUNDINAMARCA'),(273,'CARMEN DEL DARIEN','CHOCÓ'),(274,'CAROLINA','ANTIOQUIA'),(275,'CARTAGENA','BOLÍVAR'),(276,'CARTAGENA DEL CHAIRA','CAQUETÁ'),(277,'CARTAGO','VALLE DEL CAUCA'),(278,'CARURU','VAUPÉS'),(279,'CASABIANCA','TOLIMA'),(280,'CASTILLA LA NUEVA','META'),(281,'CAUCASIA','ANTIOQUIA'),(282,'CEPITA','SANTANDER'),(283,'CERETE','CÓRDOBA'),(284,'CERINZA','BOYACÁ'),(285,'CERRITO','SANTANDER'),(286,'CERRO SAN ANTONIO','MAGDALENA'),(287,'CERTEGUI','CHOCÓ'),(288,'CESARVALLEDUPAR','CESAR'),(289,'CHACHAGsI','NARIÑO'),(290,'CHAGUANI','CUNDINAMARCA'),(291,'CHALAN','SUCRE'),(292,'CHAMEZA','CASANARE'),(293,'CHAPARRAL','TOLIMA'),(294,'CHARALA','SANTANDER'),(295,'CHARTA','SANTANDER'),(296,'CHIA','CUNDINAMARCA'),(297,'CHIBOLO','MAGDALENA'),(298,'CHIGORODO','ANTIOQUIA'),(299,'CHIMA','CÓRDOBA'),(300,'CHIMA','SANTANDER'),(301,'CHIMICHAGUA','CESAR'),(302,'CHINACOTA','NORTE DE SANTANDER'),(303,'CHINAVITA','BOYACÁ'),(304,'CHINCHINA','CALDAS'),(305,'CHINU','CÓRDOBA'),(306,'CHIPAQUE','CUNDINAMARCA'),(307,'CHIPATA','SANTANDER'),(308,'CHIQUINQUIRA','BOYACÁ'),(309,'CHIQUIZA','BOYACÁ'),(310,'CHIRIGUANA','CESAR'),(311,'CHISCAS','BOYACÁ'),(312,'CHITA','BOYACÁ'),(313,'CHITAGA','NORTE DE SANTANDER'),(314,'CHITARAQUE','BOYACÁ'),(315,'CHIVATA','BOYACÁ'),(316,'CHIVOR','BOYACÁ'),(317,'CHOACHI','CUNDINAMARCA'),(318,'CHOCONTA','CUNDINAMARCA'),(319,'CICUCO','BOLÍVAR'),(320,'CIENAGA','MAGDALENA'),(321,'CIENAGA DE ORO','CÓRDOBA'),(322,'CIENEGA','BOYACÁ'),(323,'CIMITARRA','SANTANDER'),(324,'CIRCASIA','QUINDIO'),(325,'CISNEROS','ANTIOQUIA'),(326,'CIUDAD BOLIVAR','ANTIOQUIA'),(327,'CLEMENCIA','BOLÍVAR'),(328,'COCORNA','ANTIOQUIA'),(329,'COELLO','TOLIMA'),(330,'COGUA','CUNDINAMARCA'),(331,'COLOMBIA','HUILA'),(332,'COLON','NARIÑO'),(333,'COLON','PUTUMAYO'),(334,'COLOSO','SUCRE'),(335,'COMBITA','BOYACÁ'),(336,'CONCEPCION','SANTANDER'),(337,'CONCEPCION','ANTIOQUIA'),(338,'CONCORDIA','MAGDALENA'),(339,'CONCORDIA','ANTIOQUIA'),(340,'CONDOTO','CHOCÓ'),(341,'CONFINES','SANTANDER'),(342,'CONSACA','NARIÑO'),(343,'CONTADERO','NARIÑO'),(344,'CONTRATACION','SANTANDER'),(345,'CONVENCION','NORTE DE SANTANDER'),(346,'COPACABANA','ANTIOQUIA'),(347,'COPER','BOYACÁ'),(348,'CORDOBA','NARIÑO'),(349,'CORDOBA','QUINDIO'),(350,'CORDOBA','BOLÍVAR'),(351,'CORINTO','CAUCA'),(352,'COROMORO','SANTANDER'),(353,'COROZAL','SUCRE'),(354,'CORRALES','BOYACÁ'),(355,'COTA','CUNDINAMARCA'),(356,'COTORRA','CÓRDOBA'),(357,'COVARACHIA','BOYACÁ'),(358,'COVEÑAS','SUCRE'),(359,'COYAIMA','TOLIMA'),(360,'CRAVO NORTE','ARAUCA'),(361,'CUASPUD','NARIÑO'),(362,'CUBARA','BOYACÁ'),(363,'CUBARRAL','META'),(364,'CUCAITA','BOYACÁ'),(365,'CUCUNUBA','CUNDINAMARCA'),(366,'CUCUTA','NORTE DE SANTANDER'),(367,'CUCUTILLA','NORTE DE SANTANDER'),(368,'CUITIVA','BOYACÁ'),(369,'CUMARAL','META'),(370,'CUMARIBO','VICHADA'),(371,'CUMBAL','NARIÑO'),(372,'CUMBITARA','NARIÑO'),(373,'CUNDAY','TOLIMA'),(374,'CURILLO','CAQUETÁ'),(375,'CURITI','SANTANDER'),(376,'CURUMANI','CESAR'),(377,'DABEIBA','ANTIOQUIA'),(378,'DAGUA','VALLE DEL CAUCA'),(379,'DIBULLA','LA GUAJIRA'),(380,'DISTRACCION','LA GUAJIRA'),(381,'DOLORES','TOLIMA'),(382,'DON MATIAS','ANTIOQUIA'),(383,'DUITAMA','BOYACÁ'),(384,'DURANIA','NORTE DE SANTANDER'),(385,'EBEJICO','ANTIOQUIA'),(386,'EL AGUILA','VALLE DEL CAUCA'),(387,'EL BAGRE','ANTIOQUIA'),(388,'EL BANCO','MAGDALENA'),(389,'EL CAIRO','VALLE DEL CAUCA'),(390,'EL CALVARIO','META'),(391,'EL CANTON DEL SAN PABLO','CHOCÓ'),(392,'EL CARMEN','NORTE DE SANTANDER'),(393,'EL CARMEN DE ATRATO','CHOCÓ'),(394,'EL CARMEN DE BOLIVAR','BOLÍVAR'),(395,'EL CARMEN DE CHUCURI','SANTANDER'),(396,'EL CARMEN DE VIBORAL','ANTIOQUIA'),(397,'EL CASTILLO','META'),(398,'EL CERRITO','VALLE DEL CAUCA'),(399,'EL CHARCO','NARIÑO'),(400,'EL COCUY','BOYACÁ'),(401,'EL COLEGIO','CUNDINAMARCA'),(402,'EL COPEY','CESAR'),(403,'EL DONCELLO','CAQUETÁ'),(404,'EL DORADO','META'),(405,'EL DOVIO','VALLE DEL CAUCA'),(406,'EL ENCANTO','AMAZONAS'),(407,'EL ESPINO','BOYACÁ'),(408,'EL GUACAMAYO','SANTANDER'),(409,'EL GUAMO','BOLÍVAR'),(410,'EL LITORAL DEL SAN JUAN','CHOCÓ'),(411,'EL MOLINO','LA GUAJIRA'),(412,'EL PASO','CESAR'),(413,'EL PAUJIL','CAQUETÁ'),(414,'EL PEÑOL','NARIÑO'),(415,'EL PEÑON','CUNDINAMARCA'),(416,'EL PEÑON','SANTANDER'),(417,'EL PEÑON','BOLÍVAR'),(418,'EL PIÑON','MAGDALENA'),(419,'EL PLAYON','SANTANDER'),(420,'EL RETEN','MAGDALENA'),(421,'EL RETORNO','GUAVIARE'),(422,'EL ROBLE','SUCRE'),(423,'EL ROSAL','CUNDINAMARCA'),(424,'EL ROSARIO','NARIÑO'),(425,'EL SANTUARIO','ANTIOQUIA'),(426,'EL TABLON DE GOMEZ','NARIÑO'),(427,'EL TAMBO','CAUCA'),(428,'EL TAMBO','NARIÑO'),(429,'EL TARRA','NORTE DE SANTANDER'),(430,'EL ZULIA','NORTE DE SANTANDER'),(431,'ELIAS','HUILA'),(432,'ENCINO','SANTANDER'),(433,'ENCISO','SANTANDER'),(434,'ENTRERRIOS','ANTIOQUIA'),(435,'ENVIGADO','ANTIOQUIA'),(436,'ESPINAL','TOLIMA'),(437,'FACATATIVA','CUNDINAMARCA'),(438,'FALAN','TOLIMA'),(439,'FILADELFIA','CALDAS'),(440,'FILANDIA','QUINDIO'),(441,'FIRAVITOBA','BOYACÁ'),(442,'FLANDES','TOLIMA'),(443,'FLORENCIA','CAQUETÁ'),(444,'FLORENCIA','CAUCA'),(445,'FLORESTA','BOYACÁ'),(446,'FLORIAN','SANTANDER'),(447,'FLORIDA','VALLE DEL CAUCA'),(448,'FLORIDABLANCA','SANTANDER'),(449,'FOMEQUE','CUNDINAMARCA'),(450,'FONSECA','LA GUAJIRA'),(451,'FORTUL','ARAUCA'),(452,'FOSCA','CUNDINAMARCA'),(453,'FRANCISCO PIZARRO','NARIÑO'),(454,'FREDONIA','ANTIOQUIA'),(455,'FRESNO','TOLIMA'),(456,'FRONTINO','ANTIOQUIA'),(457,'FUENTE DE ORO','META'),(458,'FUNDACION','MAGDALENA'),(459,'FUNES','NARIÑO'),(460,'FUNZA','CUNDINAMARCA'),(461,'FUQUENE','CUNDINAMARCA'),(462,'FUSAGASUGA','CUNDINAMARCA'),(463,'GACHALA','CUNDINAMARCA'),(464,'GACHANCIPA','CUNDINAMARCA'),(465,'GACHANTIVA','BOYACÁ'),(466,'GACHETA','CUNDINAMARCA'),(467,'GALAN','SANTANDER'),(468,'GALAPA','ATLÁNTICO'),(469,'GALERAS','SUCRE'),(470,'GAMA','CUNDINAMARCA'),(471,'GAMARRA','CESAR'),(472,'GAMBITA','SANTANDER'),(473,'GAMEZA','BOYACÁ'),(474,'GARAGOA','BOYACÁ'),(475,'GARZON','HUILA'),(476,'GENOVA','QUINDIO'),(477,'GIGANTE','HUILA'),(478,'GINEBRA','VALLE DEL CAUCA'),(479,'GIRALDO','ANTIOQUIA'),(480,'GIRARDOT','CUNDINAMARCA'),(481,'GIRARDOTA','ANTIOQUIA'),(482,'GIRON','SANTANDER'),(483,'GOMEZ PLATA','ANTIOQUIA'),(484,'GONZALEZ','CESAR'),(485,'GRAMALOTE','NORTE DE SANTANDER'),(486,'GRANADA','CUNDINAMARCA'),(487,'GRANADA','META'),(488,'GRANADA','ANTIOQUIA'),(489,'GsEPSA','SANTANDER'),(490,'GsICAN','BOYACÁ'),(491,'GUACA','SANTANDER'),(492,'GUACAMAYAS','BOYACÁ'),(493,'GUACARI','VALLE DEL CAUCA'),(494,'GUACHENE','CAUCA'),(495,'GUACHETA','CUNDINAMARCA'),(496,'GUACHUCAL','NARIÑO'),(497,'GUADALAJARA DE BUGA','VALLE DEL CAUCA'),(498,'GUADALUPE','HUILA'),(499,'GUADALUPE','SANTANDER'),(500,'GUADALUPE','ANTIOQUIA'),(501,'GUADUAS','CUNDINAMARCA'),(502,'GUAITARILLA','NARIÑO'),(503,'GUALMATAN','NARIÑO'),(504,'GUAMAL','MAGDALENA'),(505,'GUAMAL','META'),(506,'GUAMO','TOLIMA'),(507,'GUAPI','CAUCA'),(508,'GUAPOTA','SANTANDER'),(509,'GUARANDA','SUCRE'),(510,'GUARNE','ANTIOQUIA'),(511,'GUASCA','CUNDINAMARCA'),(512,'GUATAPE','ANTIOQUIA'),(513,'GUATAQUI','CUNDINAMARCA'),(514,'GUATAVITA','CUNDINAMARCA'),(515,'GUATEQUE','BOYACÁ'),(516,'GUATICA','RISARALDA'),(517,'GUAVATA','SANTANDER'),(518,'GUAYABAL DE SIQUIMA','CUNDINAMARCA'),(519,'GUAYABETAL','CUNDINAMARCA'),(520,'GUAYATA','BOYACÁ'),(521,'GUTIERREZ','CUNDINAMARCA'),(522,'HACARI','NORTE DE SANTANDER'),(523,'HATILLO DE LOBA','BOLÍVAR'),(524,'HATO','SANTANDER'),(525,'HATO COROZAL','CASANARE'),(526,'HATONUEVO','LA GUAJIRA'),(527,'HELICONIA','ANTIOQUIA'),(528,'HERRAN','NORTE DE SANTANDER'),(529,'HERVEO','TOLIMA'),(530,'HISPANIA','ANTIOQUIA'),(531,'HOBO','HUILA'),(532,'HONDA','TOLIMA'),(533,'IBAGUE','TOLIMA'),(534,'ICONONZO','TOLIMA'),(535,'ILES','NARIÑO'),(536,'IMUES','NARIÑO'),(537,'INIRIDA','AMAZONAS'),(538,'INZA','CAUCA'),(539,'IPIALES','NARIÑO'),(540,'IQUIRA','HUILA'),(541,'ISNOS','HUILA'),(542,'ISTMINA','CHOCÓ'),(543,'ITAGUI','ANTIOQUIA'),(544,'ITUANGO','ANTIOQUIA'),(545,'IZA','BOYACÁ'),(546,'JAMBALO','CAUCA'),(547,'JAMUNDI','VALLE DEL CAUCA'),(548,'JARDIN','ANTIOQUIA'),(549,'JENESANO','BOYACÁ'),(550,'JERICO','ANTIOQUIA'),(551,'JERICO','BOYACÁ'),(552,'JERUSALEN','CUNDINAMARCA'),(553,'JESUS MARIA','SANTANDER'),(554,'JORDAN','SANTANDER'),(555,'JUAN DE ACOSTA','ATLÁNTICO'),(556,'JUNIN','CUNDINAMARCA'),(557,'JURADO','CHOCÓ'),(558,'LA APARTADA','CÓRDOBA'),(559,'LA ARGENTINA','HUILA'),(560,'LA BELLEZA','SANTANDER'),(561,'LA CALERA','CUNDINAMARCA'),(562,'LA CAPILLA','BOYACÁ'),(563,'LA CEJA','ANTIOQUIA'),(564,'LA CELIA','RISARALDA'),(565,'LA CHORRERA','AMAZONAS'),(566,'LA CRUZ','NARIÑO'),(567,'LA CUMBRE','VALLE DEL CAUCA'),(568,'LA DORADA','CALDAS'),(569,'LA ESPERANZA','NORTE DE SANTANDER'),(570,'LA ESTRELLA','ANTIOQUIA'),(571,'LA FLORIDA','NARIÑO'),(572,'LA GLORIA','CESAR'),(573,'LA GUADALUPE','GUAINÍA'),(574,'LA JAGUA DE IBIRICO','CESAR'),(575,'LA JAGUA DEL PILAR','LA GUAJIRA'),(576,'LA LLANADA','NARIÑO'),(577,'LA MACARENA','META'),(578,'LA MERCED','CALDAS'),(579,'LA MESA','CUNDINAMARCA'),(580,'LA MONTAÑITA','CAQUETÁ'),(581,'LA PALMA','CUNDINAMARCA'),(582,'LA PAZ','CESAR'),(583,'LA PAZ','SANTANDER'),(584,'LA PEDRERA','AMAZONAS'),(585,'LA PEÑA','CUNDINAMARCA'),(586,'LA PINTADA','ANTIOQUIA'),(587,'LA PLATA','HUILA'),(588,'LA PLAYA','NORTE DE SANTANDER'),(589,'LA PRIMAVERA','VICHADA'),(590,'LA SALINA','CASANARE'),(591,'LA SIERRA','CAUCA'),(592,'LA TEBAIDA','QUINDIO'),(593,'LA TOLA','NARIÑO'),(594,'LA UNION','NARIÑO'),(595,'LA UNION','SUCRE'),(596,'LA UNION','VALLE DEL CAUCA'),(597,'LA UNION','ANTIOQUIA'),(598,'LA UVITA','BOYACÁ'),(599,'LA VEGA','CAUCA'),(600,'LA VEGA','CUNDINAMARCA'),(601,'LA VICTORIA','VALLE DEL CAUCA'),(602,'LA VICTORIA','AMAZONAS'),(603,'LA VICTORIA','BOYACÁ'),(604,'LA VIRGINIA','RISARALDA'),(605,'LABATECA','NORTE DE SANTANDER'),(606,'LABRANZAGRANDE','BOYACÁ'),(607,'LANDAZURI','SANTANDER'),(608,'LEBRIJA','SANTANDER'),(609,'LEGUIZAMO','PUTUMAYO'),(610,'LEIVA','NARIÑO'),(611,'LEJANIAS','META'),(612,'LENGUAZAQUE','CUNDINAMARCA'),(613,'LERIDA','TOLIMA'),(614,'LETICIA','AMAZONAS'),(615,'LIBANO','TOLIMA'),(616,'LIBORINA','ANTIOQUIA'),(617,'LINARES','NARIÑO'),(618,'LLORO','CHOCÓ'),(619,'LOPEZ','CAUCA'),(620,'LORICA','CÓRDOBA'),(621,'LOS ANDES','NARIÑO'),(622,'LOS CORDOBAS','CÓRDOBA'),(623,'LOS PALMITOS','SUCRE'),(624,'LOS PATIOS','NORTE DE SANTANDER'),(625,'LOS SANTOS','SANTANDER'),(626,'LOURDES','NORTE DE SANTANDER'),(627,'LURUACO','ATLÁNTICO'),(628,'MACANAL','BOYACÁ'),(629,'MACARAVITA','SANTANDER'),(630,'MACEO','ANTIOQUIA'),(631,'MACHETA','CUNDINAMARCA'),(632,'MADRID','CUNDINAMARCA'),(633,'MAGANGUE','BOLÍVAR'),(634,'MAGsI','NARIÑO'),(635,'MAHATES','BOLÍVAR'),(636,'MAICAO','LA GUAJIRA'),(637,'MAJAGUAL','SUCRE'),(638,'MALAGA','SANTANDER'),(639,'MALAMBO','ATLÁNTICO'),(640,'MALLAMA','NARIÑO'),(641,'MANATI','ATLÁNTICO'),(642,'MANAURE','CESAR'),(643,'MANAURE','LA GUAJIRA'),(644,'MANI','CASANARE'),(645,'MANTA','CUNDINAMARCA'),(646,'MANZANARES','CALDAS'),(647,'MAPIRIPAN','META'),(648,'MAPIRIPANA','GUAINÍA'),(649,'MARGARITA','BOLÍVAR'),(650,'MARIA LA BAJA','BOLÍVAR'),(651,'MARINILLA','ANTIOQUIA'),(652,'MARIPI','BOYACÁ'),(653,'MARIQUITA','TOLIMA'),(654,'MARMATO','CALDAS'),(655,'MARQUETALIA','CALDAS'),(656,'MARSELLA','RISARALDA'),(657,'MARULANDA','CALDAS'),(658,'MATANZA','SANTANDER'),(659,'MEDELLIN','ANTIOQUIA'),(660,'MEDINA','CUNDINAMARCA'),(661,'MEDIO ATRATO','CHOCÓ'),(662,'MEDIO BAUDO','CHOCÓ'),(663,'MEDIO SAN JUAN','CHOCÓ'),(664,'MELGAR','TOLIMA'),(665,'MERCADERES','CAUCA'),(666,'MESETAS','META'),(667,'MILAN','CAQUETÁ'),(668,'MIRAFLORES','GUAVIARE'),(669,'MIRAFLORES','BOYACÁ'),(670,'MIRANDA','CAUCA'),(671,'MIRITI  PARANAS','AMAZONAS'),(672,'MISTRATO','RISARALDA'),(673,'MITU','VAUPÉS'),(674,'MOCOA','PUTUMAYO'),(675,'MOGOTES','SANTANDER'),(676,'MOLAGAVITA','SANTANDER'),(677,'MOMIL','CÓRDOBA'),(678,'MOMPOS','BOLÍVAR'),(679,'MONGUA','BOYACÁ'),(680,'MONGUI','BOYACÁ'),(681,'MONIQUIRA','BOYACÁ'),(682,'MOÑITOS','CÓRDOBA'),(683,'MONTEBELLO','ANTIOQUIA'),(684,'MONTECRISTO','BOLÍVAR'),(685,'MONTELIBANO','CÓRDOBA'),(686,'MONTENEGRO','QUINDIO'),(687,'MONTERIA','CÓRDOBA'),(688,'MONTERREY','CASANARE'),(689,'MORALES','CAUCA'),(690,'MORALES','BOLÍVAR'),(691,'MORELIA','CAQUETÁ'),(692,'MORICHAL','GUAINÍA'),(693,'MORROA','SUCRE'),(694,'MOSQUERA','CUNDINAMARCA'),(695,'MOSQUERA','NARIÑO'),(696,'MOTAVITA','BOYACÁ'),(697,'MURILLO','TOLIMA'),(698,'MURINDO','ANTIOQUIA'),(699,'MUTATA','ANTIOQUIA'),(700,'MUTISCUA','NORTE DE SANTANDER'),(701,'MUZO','BOYACÁ'),(702,'NARIÑO','CUNDINAMARCA'),(703,'NARIÑO','NARIÑO'),(704,'NARIÑO','ANTIOQUIA'),(705,'NATAGA','HUILA'),(706,'NATAGAIMA','TOLIMA'),(707,'NECHI','ANTIOQUIA'),(708,'NECOCLI','ANTIOQUIA'),(709,'NEIRA','CALDAS'),(710,'NEIVA','HUILA'),(711,'NEMOCON','CUNDINAMARCA'),(712,'NILO','CUNDINAMARCA'),(713,'NIMAIMA','CUNDINAMARCA'),(714,'NOBSA','BOYACÁ'),(715,'NOCAIMA','CUNDINAMARCA'),(716,'NORCASIA','CALDAS'),(717,'NOROSI','BOLÍVAR'),(718,'NOVITA','CHOCÓ'),(719,'NUEVA GRANADA','MAGDALENA'),(720,'NUEVO COLON','BOYACÁ'),(721,'NUNCHIA','CASANARE'),(722,'NUQUI','CHOCÓ'),(723,'OBANDO','VALLE DEL CAUCA'),(724,'OCAMONTE','SANTANDER'),(725,'OCAÑA','NORTE DE SANTANDER'),(726,'OIBA','SANTANDER'),(727,'OICATA','BOYACÁ'),(728,'OLAYA','ANTIOQUIA'),(729,'OLAYA HERRERA','NARIÑO'),(730,'ONZAGA','SANTANDER'),(731,'OPORAPA','HUILA'),(732,'ORITO','PUTUMAYO'),(733,'OROCUE','CASANARE'),(734,'ORTEGA','TOLIMA'),(735,'OSPINA','NARIÑO'),(736,'OTANCHE','BOYACÁ'),(737,'OVEJAS','SUCRE'),(738,'PACHAVITA','BOYACÁ'),(739,'PACHO','CUNDINAMARCA'),(740,'PACOA','VAUPÉS'),(741,'PACORA','CALDAS'),(742,'PADILLA','CAUCA'),(743,'PAEZ','CAUCA'),(744,'PAEZ','BOYACÁ'),(745,'PAICOL','HUILA'),(746,'PAILITAS','CESAR'),(747,'PAIME','CUNDINAMARCA'),(748,'PAIPA','BOYACÁ'),(749,'PAJARITO','BOYACÁ'),(750,'PALERMO','HUILA'),(751,'PALESTINA','HUILA'),(752,'PALESTINA','CALDAS'),(753,'PALMAR','SANTANDER'),(754,'PALMAR DE VARELA','ATLÁNTICO'),(755,'PALMAS DEL SOCORRO','SANTANDER'),(756,'PALMIRA','VALLE DEL CAUCA'),(757,'PALMITO','SUCRE'),(758,'PALOCABILDO','TOLIMA'),(759,'PAMPLONA','NORTE DE SANTANDER'),(760,'PAMPLONITA','NORTE DE SANTANDER'),(761,'PANA PANA','GUAINÍA'),(762,'PANDI','CUNDINAMARCA'),(763,'PANQUEBA','BOYACÁ'),(764,'PAPUNAUA','VAUPÉS'),(765,'PARAMO','SANTANDER'),(766,'PARATEBUENO','CUNDINAMARCA'),(767,'PASCA','CUNDINAMARCA'),(768,'PASTO','NARIÑO'),(769,'PATIA','CAUCA'),(770,'PAUNA','BOYACÁ'),(771,'PAYA','BOYACÁ'),(772,'PAZ DE ARIPORO','CASANARE'),(773,'PAZ DE RIO','BOYACÁ'),(774,'PEDRAZA','MAGDALENA'),(775,'PEÐOL','ANTIOQUIA'),(776,'PELAYA','CESAR'),(777,'PENSILVANIA','CALDAS'),(778,'PEQUE','ANTIOQUIA'),(779,'PESCA','BOYACÁ'),(780,'PIAMONTES','CAUCA'),(781,'PIEDECUESTA','SANTANDER'),(782,'PIEDRAS','TOLIMA'),(783,'PIENDAMO','CAUCA'),(784,'PIJAO','QUINDIO'),(785,'PIJIÑO DEL CARMEN','MAGDALENA'),(786,'PINCHOTE','SANTANDER'),(787,'PINILLOS','BOLÍVAR'),(788,'PIOJO','ATLÁNTICO'),(789,'PISBA','BOYACÁ'),(790,'PITAL','HUILA'),(791,'PITALITO','HUILA'),(792,'PIVIJAY','MAGDALENA'),(793,'PLANADAS','TOLIMA'),(794,'PLANETA RICA','CÓRDOBA'),(795,'PLATO','MAGDALENA'),(796,'POLICARPA','NARIÑO'),(797,'POLONUEVO','ATLÁNTICO'),(798,'PONEDERA','ATLÁNTICO'),(799,'POPAYAN','CAUCA'),(800,'PORE','CASANARE'),(801,'POTOSI','NARIÑO'),(802,'PRADERA','VALLE DEL CAUCA'),(803,'PRADO','TOLIMA'),(804,'PROVIDENCIA','NARIÑO'),(805,'PROVIDENCIA','SAN ANDRÉS Y PROVIDENCIA'),(806,'PUEBLO BELLO','CESAR'),(807,'PUEBLO NUEVO','CÓRDOBA'),(808,'PUEBLO RICO','RISARALDA'),(809,'PUEBLORRICO','ANTIOQUIA'),(810,'PUEBLOVIEJO','MAGDALENA'),(811,'PUENTE NACIONAL','SANTANDER'),(812,'PUERRES','NARIÑO'),(813,'PUERTO ALEGRIA','AMAZONAS'),(814,'PUERTO ARICA','AMAZONAS'),(815,'PUERTO ASIS','PUTUMAYO'),(816,'PUERTO BERRIO','ANTIOQUIA'),(817,'PUERTO BOYACA','BOYACÁ'),(818,'PUERTO CAICEDO','PUTUMAYO'),(819,'PUERTO CARREÑO','VICHADA'),(820,'PUERTO COLOMBIA','GUAINÍA'),(821,'PUERTO COLOMBIA','ATLÁNTICO'),(822,'PUERTO CONCORDIA','META'),(823,'PUERTO ESCONDIDO','CÓRDOBA'),(824,'PUERTO GAITAN','META'),(825,'PUERTO GUZMAN','PUTUMAYO'),(826,'PUERTO LIBERTADOR','CÓRDOBA'),(827,'PUERTO LLERAS','META'),(828,'PUERTO LOPEZ','META'),(829,'PUERTO NARE','ANTIOQUIA'),(830,'PUERTO NARIÑO','AMAZONAS'),(831,'PUERTO PARRA','SANTANDER'),(832,'PUERTO RICO','CAQUETÁ'),(833,'PUERTO RICO','META'),(834,'PUERTO RONDON','ARAUCA'),(835,'PUERTO SALGAR','CUNDINAMARCA'),(836,'PUERTO SANTANDER','NORTE DE SANTANDER'),(837,'PUERTO SANTANDER','AMAZONAS'),(838,'PUERTO TEJADA','CAUCA'),(839,'PUERTO TRIUNFO','ANTIOQUIA'),(840,'PUERTO WILCHES','SANTANDER'),(841,'PULI','CUNDINAMARCA'),(842,'PUPIALES','NARIÑO'),(843,'PURACE','CAUCA'),(844,'PURIFICACION','TOLIMA'),(845,'PURISIMA','CÓRDOBA'),(846,'QUEBRADANEGRA','CUNDINAMARCA'),(847,'QUETAME','CUNDINAMARCA'),(848,'QUIBDO','CHOCÓ'),(849,'QUIMBAYA','QUINDIO'),(850,'QUINCHIA','RISARALDA'),(851,'QUIPAMA','BOYACÁ'),(852,'QUIPILE','CUNDINAMARCA'),(853,'RAGONVALIA','NORTE DE SANTANDER'),(854,'RAMIRIQUI','BOYACÁ'),(855,'RAQUIRA','BOYACÁ'),(856,'RECETOR','CASANARE'),(857,'REGIDOR','BOLÍVAR'),(858,'REMEDIOS','ANTIOQUIA'),(859,'REMOLINO','MAGDALENA'),(860,'REPELON','ATLÁNTICO'),(861,'RESTREPO','META'),(862,'RESTREPO','VALLE DEL CAUCA'),(863,'RETIRO','ANTIOQUIA'),(864,'RICAURTE','CUNDINAMARCA'),(865,'RICAURTE','NARIÑO'),(866,'RIO DE ORO','CESAR'),(867,'RIO IRO','CHOCÓ'),(868,'RIO QUITO','CHOCÓ'),(869,'RIO VIEJO','BOLÍVAR'),(870,'RIOBLANCO','TOLIMA'),(871,'RIOFRIO','VALLE DEL CAUCA'),(872,'RIOHACHA','LA GUAJIRA'),(873,'RIONEGRO','SANTANDER'),(874,'RIONEGRO','ANTIOQUIA'),(875,'RIOSUCIO','CHOCÓ'),(876,'RIOSUCIO','CALDAS'),(877,'RISARALDA','CALDAS'),(878,'RIVERA','HUILA'),(879,'ROBERTO PAYAN','NARIÑO'),(880,'ROLDANILLO','VALLE DEL CAUCA'),(881,'RONCESVALLES','TOLIMA'),(882,'RONDON','BOYACÁ'),(883,'ROSAS','CAUCA'),(884,'ROVIRA','TOLIMA'),(885,'SABANA DE TORRES','SANTANDER'),(886,'SABANAGRANDE','ATLÁNTICO'),(887,'SABANALARGA','CASANARE'),(888,'SABANALARGA','ANTIOQUIA'),(889,'SABANALARGA','ATLÁNTICO'),(890,'SABANAS DE SAN ANGEL','MAGDALENA'),(891,'SABANETA','ANTIOQUIA'),(892,'SABOYA','BOYACÁ'),(893,'SACAMA','CASANARE'),(894,'SACHICA','BOYACÁ'),(895,'SAHAGUN','CÓRDOBA'),(896,'SALADOBLANCO','HUILA'),(897,'SALAMINA','MAGDALENA'),(898,'SALAMINA','CALDAS'),(899,'SALAZAR','NORTE DE SANTANDER'),(900,'SALDAÑA','TOLIMA'),(901,'SALENTO','QUINDIO'),(902,'SALGAR','ANTIOQUIA'),(903,'SAMACA','BOYACÁ'),(904,'SAMANA','CALDAS'),(905,'SAMANIEGO','NARIÑO'),(906,'SAMPUES','SUCRE'),(907,'SAN AGUSTIN','HUILA'),(908,'SAN ALBERTO','CESAR'),(909,'SAN ANDRES','SAN ANDRÉS Y PROVIDENCIA'),(910,'SAN ANDRES','SANTANDER'),(911,'SAN ANDRES DE CUERQUIA','ANTIOQUIA'),(912,'SAN ANDRES DE TUMACO','NARIÑO'),(913,'SAN ANDRES SOTAVENTO','CÓRDOBA'),(914,'SAN ANTERO','CÓRDOBA'),(915,'SAN ANTONIO','TOLIMA'),(916,'SAN ANTONIO DEL TEQUENDAMA','CUNDINAMARCA'),(917,'SAN BENITO','SANTANDER'),(918,'SAN BENITO ABAD','SUCRE'),(919,'SAN BERNARDO','CUNDINAMARCA'),(920,'SAN BERNARDO','NARIÑO'),(921,'SAN BERNARDO DEL VIENTO','CÓRDOBA'),(922,'SAN CALIXTO','NORTE DE SANTANDER'),(923,'SAN CARLOS','CÓRDOBA'),(924,'SAN CARLOS','ANTIOQUIA'),(925,'SAN CARLOS DE GUAROA','META'),(926,'SAN CAYETANO','CUNDINAMARCA'),(927,'SAN CAYETANO','NORTE DE SANTANDER'),(928,'SAN CRISTOBAL','BOLÍVAR'),(929,'SAN DIEGO','CESAR'),(930,'SAN EDUARDO','BOYACÁ'),(931,'SAN ESTANISLAO','BOLÍVAR'),(932,'SAN FELIPE','GUAINÍA'),(933,'SAN FERNANDO','BOLÍVAR'),(934,'SAN FRANCISCO','CUNDINAMARCA'),(935,'SAN FRANCISCO','PUTUMAYO'),(936,'SAN FRANCISCO','ANTIOQUIA'),(937,'SAN GIL','SANTANDER'),(938,'SAN JACINTO','BOLÍVAR'),(939,'SAN JACINTO DEL CAUCA','BOLÍVAR'),(940,'SAN JERONIMO','ANTIOQUIA'),(941,'SAN JOAQUIN','SANTANDER'),(942,'SAN JOSE','CALDAS'),(943,'SAN JOSE DE LA MONTAÑA','ANTIOQUIA'),(944,'SAN JOSE DE MIRANDA','SANTANDER'),(945,'SAN JOSE DE PARE','BOYACÁ'),(946,'SAN JOSE DEL FRAGUA','CAQUETÁ'),(947,'SAN JOSE DEL GUAVIARE','GUAVIARE'),(948,'SAN JOSE DEL PALMAR','CHOCÓ'),(949,'SAN JUAN DE ARAMA','META'),(950,'SAN JUAN DE BETULIA','SUCRE'),(951,'SAN JUAN DE RIO SECO','CUNDINAMARCA'),(952,'SAN JUAN DE URABA','ANTIOQUIA'),(953,'SAN JUAN DEL CESAR','LA GUAJIRA'),(954,'SAN JUAN NEPOMUCENO','BOLÍVAR'),(955,'SAN JUANITO','META'),(956,'SAN LORENZO','NARIÑO'),(957,'SAN LUIS','TOLIMA'),(958,'SAN LUIS','ANTIOQUIA'),(959,'SAN LUIS DE GACENO','BOYACÁ'),(960,'SAN LUIS DE PALENQUE','CASANARE'),(961,'SAN LUIS DE SINCE','SUCRE'),(962,'SAN MARCOS','SUCRE'),(963,'SAN MARTIN','CESAR'),(964,'SAN MARTIN','META'),(965,'SAN MARTIN DE LOBA','BOLÍVAR'),(966,'SAN MATEO','BOYACÁ'),(967,'SAN MIGUEL','PUTUMAYO'),(968,'SAN MIGUEL','SANTANDER'),(969,'SAN MIGUEL DE SEMA','BOYACÁ'),(970,'SAN ONOFRE','SUCRE'),(971,'SAN PABLO','NARIÑO'),(972,'SAN PABLO','BOLÍVAR'),(973,'SAN PABLO DE BORBUR','BOYACÁ'),(974,'SAN PEDRO','SUCRE'),(975,'SAN PEDRO','VALLE DEL CAUCA'),(976,'SAN PEDRO','ANTIOQUIA'),(977,'SAN PEDRO DE CARTAGO','NARIÑO'),(978,'SAN PEDRO DE URABA','ANTIOQUIA'),(979,'SAN PELAYO','CÓRDOBA'),(980,'SAN RAFAEL','ANTIOQUIA'),(981,'SAN ROQUE','ANTIOQUIA'),(982,'SAN SEBASTIAN','CAUCA'),(983,'SAN SEBASTIAN DE BUENAVISTA','MAGDALENA'),(984,'SAN VICENTE','ANTIOQUIA'),(985,'SAN VICENTE DE CHUCURI','SANTANDER'),(986,'SAN VICENTE DEL CAGUAN','CAQUETÁ'),(987,'SAN ZENON','MAGDALENA'),(988,'SANDONA','NARIÑO'),(989,'SANTA ANA','MAGDALENA'),(990,'SANTA BARBARA','NARIÑO'),(991,'SANTA BARBARA','SANTANDER'),(992,'SANTA BARBARA','ANTIOQUIA'),(993,'SANTA BARBARA DE PINTO','MAGDALENA'),(994,'SANTA CATALINA','BOLÍVAR'),(995,'SANTA HELENA DEL OPON','SANTANDER'),(996,'SANTA ISABEL','TOLIMA'),(997,'SANTA LUCIA','ATLÁNTICO'),(998,'SANTA MARIA','BOYACÁ'),(999,'SANTA MARIA','HUILA'),(1000,'SANTA MARTA','MAGDALENA'),(1001,'SANTA ROSA','CAUCA'),(1002,'SANTA ROSA','BOLÍVAR'),(1003,'SANTA ROSA DE CABAL','RISARALDA'),(1004,'SANTA ROSA DE OSOS','ANTIOQUIA'),(1005,'SANTA ROSA DE VITERBO','BOYACÁ'),(1006,'SANTA ROSA DEL SUR','BOLÍVAR'),(1007,'SANTA ROSALIA','VICHADA'),(1008,'SANTA SOFIA','BOYACÁ'),(1009,'SANTACRUZ','NARIÑO'),(1010,'SANTAFE DE ANTIOQUIA','ANTIOQUIA'),(1011,'SANTANA','BOYACÁ'),(1012,'SANTANDER DE QUILICHAO','CAUCA'),(1013,'SANTIAGO','NORTE DE SANTANDER'),(1014,'SANTIAGO','PUTUMAYO'),(1015,'SANTIAGO DE TOLU','SUCRE'),(1016,'SANTO DOMINGO','ANTIOQUIA'),(1017,'SANTO TOMAS','ATLÁNTICO'),(1018,'SANTUARIO','RISARALDA'),(1019,'SAPUYES','NARIÑO'),(1020,'SARAVENA','ARAUCA'),(1021,'SARDINATA','NORTE DE SANTANDER'),(1022,'SASAIMA','CUNDINAMARCA'),(1023,'SATIVANORTE','BOYACÁ'),(1024,'SATIVASUR','BOYACÁ'),(1025,'SEGOVIA','ANTIOQUIA'),(1026,'SESQUILE','CUNDINAMARCA'),(1027,'SEVILLA','VALLE DEL CAUCA'),(1028,'SIACHOQUE','BOYACÁ'),(1029,'SIBATE','CUNDINAMARCA'),(1030,'SIBUNDOY','PUTUMAYO'),(1031,'SILOS','NORTE DE SANTANDER'),(1032,'SILVANIA','CUNDINAMARCA'),(1033,'SILVIA','CAUCA'),(1034,'SIMACOTA','SANTANDER'),(1035,'SIMIJACA','CUNDINAMARCA'),(1036,'SIMITI','BOLÍVAR'),(1037,'SINCELEJO','SUCRE'),(1038,'SIPI','CHOCÓ'),(1039,'SITIONUEVO','MAGDALENA'),(1040,'SOACHA','CUNDINAMARCA'),(1041,'SOATA','BOYACÁ'),(1042,'SOCHA','BOYACÁ'),(1043,'SOCORRO','SANTANDER'),(1044,'SOCOTA','BOYACÁ'),(1045,'SOGAMOSO','BOYACÁ'),(1046,'SOLANO','CAQUETÁ'),(1047,'SOLEDAD','ATLÁNTICO'),(1048,'SOLITA','CAQUETÁ'),(1049,'SOMONDOCO','BOYACÁ'),(1050,'SONSON','ANTIOQUIA'),(1051,'SOPETRAN','ANTIOQUIA'),(1052,'SOPLAVIENTO','BOLÍVAR'),(1053,'SOPO','CUNDINAMARCA'),(1054,'SORA','BOYACÁ'),(1055,'SORACA','BOYACÁ'),(1056,'SOTAQUIRA','BOYACÁ'),(1057,'SOTARA','CAUCA'),(1058,'SUAITA','SANTANDER'),(1059,'SUAN','ATLÁNTICO'),(1060,'SUAREZ','CAUCA'),(1061,'SUAREZ','TOLIMA'),(1062,'SUAZA','HUILA'),(1063,'SUBACHOQUE','CUNDINAMARCA'),(1064,'SUCRE','CAUCA'),(1065,'SUCRE','SANTANDER'),(1066,'SUCRE','SUCRE'),(1067,'SUESCA','CUNDINAMARCA'),(1068,'SUPATA','CUNDINAMARCA'),(1069,'SUPIA','CALDAS'),(1070,'SURATA','SANTANDER'),(1071,'SUSA','CUNDINAMARCA'),(1072,'SUSACON','BOYACÁ'),(1073,'SUTAMARCHAN','BOYACÁ'),(1074,'SUTATAUSA','CUNDINAMARCA'),(1075,'SUTATENZA','BOYACÁ'),(1076,'TABIO','CUNDINAMARCA'),(1077,'TADO','CHOCÓ'),(1078,'TALAIGUA NUEVO','BOLÍVAR'),(1079,'TAMALAMEQUE','CESAR'),(1080,'TAMARA','CASANARE'),(1081,'TAME','ARAUCA'),(1082,'TAMESIS','ANTIOQUIA'),(1083,'TAMINANGO','NARIÑO'),(1084,'TANGUA','NARIÑO'),(1085,'TARAIRA','VAUPÉS'),(1086,'TARAPACA','AMAZONAS'),(1087,'TARAZA','ANTIOQUIA'),(1088,'TARQUI','HUILA'),(1089,'TARSO','ANTIOQUIA'),(1090,'TASCO','BOYACÁ'),(1091,'TAURAMENA','CASANARE'),(1092,'TAUSA','CUNDINAMARCA'),(1093,'TELLO','HUILA'),(1094,'TENA','CUNDINAMARCA'),(1095,'TENERIFE','MAGDALENA'),(1096,'TENJO','CUNDINAMARCA'),(1097,'TENZA','BOYACÁ'),(1098,'TEORAMA','NORTE DE SANTANDER'),(1099,'TERUEL','HUILA'),(1100,'TESALIA','HUILA'),(1101,'TIBACUY','CUNDINAMARCA'),(1102,'TIBANA','BOYACÁ'),(1103,'TIBASOSA','BOYACÁ'),(1104,'TIBIRITA','CUNDINAMARCA'),(1105,'TIBU','NORTE DE SANTANDER'),(1106,'TIERRALTA','CÓRDOBA'),(1107,'TIMANA','HUILA'),(1108,'TIMBIO','CAUCA'),(1109,'TIMBIQUI','CAUCA'),(1110,'TINJACA','BOYACÁ'),(1111,'TIPACOQUE','BOYACÁ'),(1112,'TIQUISIO','BOLÍVAR'),(1113,'TITIRIBI','ANTIOQUIA'),(1114,'TOCA','BOYACÁ'),(1115,'TOCAIMA','CUNDINAMARCA'),(1116,'TOCANCIPA','CUNDINAMARCA'),(1117,'TOGsI','BOYACÁ'),(1118,'TOLEDO','NORTE DE SANTANDER'),(1119,'TOLEDO','ANTIOQUIA'),(1120,'TOLU VIEJO','SUCRE'),(1121,'TONA','SANTANDER'),(1122,'TOPAGA','BOYACÁ'),(1123,'TOPAIPI','CUNDINAMARCA'),(1124,'TORIBIO','CAUCA'),(1125,'TORO','VALLE DEL CAUCA'),(1126,'TOTA','BOYACÁ'),(1127,'TOTORO','CAUCA'),(1128,'TRINIDAD','CASANARE'),(1129,'TRUJILLO','VALLE DEL CAUCA'),(1130,'TUBARA','ATLÁNTICO'),(1131,'TULUA','VALLE DEL CAUCA'),(1132,'TUNJA','BOYACÁ'),(1133,'TUNUNGUA','BOYACÁ'),(1134,'TUQUERRES','NARIÑO'),(1135,'TURBACO','BOLÍVAR'),(1136,'TURBANA','BOLÍVAR'),(1137,'TURBO','ANTIOQUIA'),(1138,'TURMEQUE','BOYACÁ'),(1139,'TUTA','BOYACÁ'),(1140,'TUTAZA','BOYACÁ'),(1141,'UBALA','CUNDINAMARCA'),(1142,'UBAQUE','CUNDINAMARCA'),(1143,'ULLOA','VALLE DEL CAUCA'),(1144,'UMBITA','BOYACÁ'),(1145,'UNE','CUNDINAMARCA'),(1146,'UNGUIA','CHOCÓ'),(1147,'UNION PANAMERICANA','CHOCÓ'),(1148,'URAMITA','ANTIOQUIA'),(1149,'URIBE','META'),(1150,'URIBIA','LA GUAJIRA'),(1151,'URRAO','ANTIOQUIA'),(1152,'URUMITA','LA GUAJIRA'),(1153,'USIACURI','ATLÁNTICO'),(1154,'UTICA','CUNDINAMARCA'),(1155,'VALDIVIA','ANTIOQUIA'),(1156,'VALENCIA','CÓRDOBA'),(1157,'VALLE DE SAN JOSE','SANTANDER'),(1158,'VALLE DE SAN JUAN','TOLIMA'),(1159,'VALLE DEL GUAMUEZ','PUTUMAYO'),(1160,'VALPARAISO','CAQUETÁ'),(1161,'VALPARAISO','ANTIOQUIA'),(1162,'VEGACHI','ANTIOQUIA'),(1163,'VELEZ','SANTANDER'),(1164,'VENADILLO','TOLIMA'),(1165,'VENECIA','CUNDINAMARCA'),(1166,'VENECIA','ANTIOQUIA'),(1167,'VENTAQUEMADA','BOYACÁ'),(1168,'VERGARA','CUNDINAMARCA'),(1169,'VERSALLES','VALLE DEL CAUCA'),(1170,'VETAS','SANTANDER'),(1171,'VIANI','CUNDINAMARCA'),(1172,'VICTORIA','CALDAS'),(1173,'VIGIA DEL FUERTE','ANTIOQUIA'),(1174,'VIJES','VALLE DEL CAUCA'),(1175,'VILLA CARO','NORTE DE SANTANDER'),(1176,'VILLA DE LEYVA','BOYACÁ'),(1177,'VILLA DE SAN DIEGO DE UBATE','CUNDINAMARCA'),(1178,'VILLA DEL ROSARIO','NORTE DE SANTANDER'),(1179,'VILLA RICA','CAUCA'),(1180,'VILLAGARZON','PUTUMAYO'),(1181,'VILLAGOMEZ','CUNDINAMARCA'),(1182,'VILLAHERMOSA','TOLIMA'),(1183,'VILLAMARIA','CALDAS'),(1184,'VILLANUEVA','CASANARE'),(1185,'VILLANUEVA','LA GUAJIRA'),(1186,'VILLANUEVA','SANTANDER'),(1187,'VILLANUEVA','BOLÍVAR'),(1188,'VILLAPINZON','CUNDINAMARCA'),(1189,'VILLARRICA','TOLIMA'),(1190,'VILLAVICENCIO','META'),(1191,'VILLAVIEJA','HUILA'),(1192,'VILLETA','CUNDINAMARCA'),(1193,'VIOTA','CUNDINAMARCA'),(1194,'VIRACACHA','BOYACÁ'),(1195,'VISTAHERMOSA','META'),(1196,'VITERBO','CALDAS'),(1197,'YACOPI','CUNDINAMARCA'),(1198,'YACUANQUER','NARIÑO'),(1199,'YAGUARA','HUILA'),(1200,'YALI','ANTIOQUIA'),(1201,'YARUMAL','ANTIOQUIA'),(1202,'YAVARATE','VAUPÉS'),(1203,'YOLOMBO','ANTIOQUIA'),(1204,'YONDO','ANTIOQUIA'),(1205,'YOPAL','CASANARE'),(1206,'YOTOCO','VALLE DEL CAUCA'),(1207,'YUMBO','VALLE DEL CAUCA'),(1208,'ZAMBRANOV','BOLÍVAR'),(1209,'ZAPATOCA','SANTANDER'),(1210,'ZAPAYAN','MAGDALENA'),(1211,'ZARAGOZA','ANTIOQUIA'),(1212,'ZARZAL','VALLE DEL CAUCA'),(1213,'ZETAQUIRA','BOYACÁ'),(1214,'ZIPACON','CUNDINAMARCA'),(1215,'ZIPAQUIRA','CUNDINAMARCA'),(1216,'ZONA BANANERA','MAGDALENA');
/*!40000 ALTER TABLE `municipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otros_pagos`
--

DROP TABLE IF EXISTS `otros_pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otros_pagos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `factura_id` int(10) unsigned NOT NULL,
  `cartera_id` int(10) unsigned NOT NULL,
  `fecha_factura` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `concepto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor_unitario` double NOT NULL,
  `cantidad` double NOT NULL,
  `subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `otros_pagos_factura_id_foreign` (`factura_id`),
  KEY `otros_pagos_cartera_id_foreign` (`cartera_id`),
  CONSTRAINT `otros_pagos_cartera_id_foreign` FOREIGN KEY (`cartera_id`) REFERENCES `carteras` (`id`),
  CONSTRAINT `otros_pagos_factura_id_foreign` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otros_pagos`
--

LOCK TABLES `otros_pagos` WRITE;
/*!40000 ALTER TABLE `otros_pagos` DISABLE KEYS */;
INSERT INTO `otros_pagos` VALUES (1,36,10,'08-08-2017','prueba',20000,4,80000,'2017-08-08 14:53:51','2017-08-08 14:53:51'),(2,36,10,'08-08-2017','prueba 2',25000,3,75000,'2017-08-08 14:53:51','2017-08-08 14:53:51');
/*!40000 ALTER TABLE `otros_pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `factura_id` int(10) unsigned NOT NULL,
  `credito_id` int(10) unsigned NOT NULL,
  `concepto` enum('Cuota','Cuota Parcial','Mora','Prejuridico','Juridico','Saldo a Favor') COLLATE utf8_unicode_ci NOT NULL,
  `abono` double NOT NULL,
  `debe` double NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `estado` enum('Debe','Ok','Finalizado') COLLATE utf8_unicode_ci NOT NULL,
  `pago_desde` date DEFAULT NULL,
  `pago_hasta` date DEFAULT NULL,
  `abono_pago_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pagos_factura_id_foreign` (`factura_id`),
  KEY `pagos_credito_id_foreign` (`credito_id`),
  CONSTRAINT `pagos_credito_id_foreign` FOREIGN KEY (`credito_id`) REFERENCES `creditos` (`id`),
  CONSTRAINT `pagos_factura_id_foreign` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (48,30,54,'Cuota',63400,0,NULL,'Ok','2017-08-01','2017-08-16',NULL,'2017-08-05 15:00:28','2017-08-05 15:00:28'),(49,30,54,'Cuota Parcial',1000,62400,NULL,'Debe','2017-08-16','2017-09-01',NULL,'2017-08-05 15:00:28','2017-08-05 15:00:28'),(50,31,38,'Mora',1000,0,NULL,'Ok',NULL,NULL,NULL,'2017-08-07 03:27:16','2017-08-07 03:27:16'),(51,31,38,'Cuota Parcial',36500,1000,NULL,'Debe','2017-07-18','2017-08-03',NULL,'2017-08-07 03:27:16','2017-08-07 03:27:16'),(52,32,53,'Cuota',91050,0,NULL,'Ok','2017-08-17','2017-09-02',NULL,'2017-08-07 03:27:57','2017-08-07 03:27:57'),(53,32,53,'Cuota Parcial',8950,82100,NULL,'Debe','2017-09-02','2017-09-17',NULL,'2017-08-07 03:27:57','2017-08-10 22:46:50'),(54,33,50,'Cuota',135100,0,NULL,'Ok','2017-08-27','2017-09-27',NULL,'2017-08-07 03:30:03','2017-08-07 03:30:03');
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `precreditos`
--

DROP TABLE IF EXISTS `precreditos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `precreditos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `num_fact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cartera_id` int(10) unsigned NOT NULL,
  `funcionario_id` int(10) unsigned NOT NULL,
  `cliente_id` int(10) unsigned NOT NULL,
  `producto_id` int(10) unsigned NOT NULL,
  `vlr_fin` double NOT NULL,
  `periodo` enum('Quincenal','Mensual') COLLATE utf8_unicode_ci NOT NULL,
  `meses` int(11) NOT NULL,
  `cuotas` int(11) NOT NULL,
  `vlr_cuota` double NOT NULL,
  `p_fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `s_fecha` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estudio` enum('Tipico','Domicilio','Sin estudio') COLLATE utf8_unicode_ci NOT NULL,
  `cuota_inicial` double DEFAULT NULL,
  `aprobado` enum('Si','No','En estudio','Desistio') COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci,
  `user_create_id` int(10) unsigned NOT NULL,
  `user_update_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `precreditos_num_fact_unique` (`num_fact`),
  KEY `precreditos_cartera_id_foreign` (`cartera_id`),
  KEY `precreditos_funcionario_id_foreign` (`funcionario_id`),
  KEY `precreditos_cliente_id_foreign` (`cliente_id`),
  KEY `precreditos_producto_id_foreign` (`producto_id`),
  KEY `precreditos_user_create_id_foreign` (`user_create_id`),
  KEY `precreditos_user_update_id_foreign` (`user_update_id`),
  CONSTRAINT `precreditos_cartera_id_foreign` FOREIGN KEY (`cartera_id`) REFERENCES `carteras` (`id`),
  CONSTRAINT `precreditos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `precreditos_funcionario_id_foreign` FOREIGN KEY (`funcionario_id`) REFERENCES `users` (`id`),
  CONSTRAINT `precreditos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  CONSTRAINT `precreditos_user_create_id_foreign` FOREIGN KEY (`user_create_id`) REFERENCES `users` (`id`),
  CONSTRAINT `precreditos_user_update_id_foreign` FOREIGN KEY (`user_update_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precreditos`
--

LOCK TABLES `precreditos` WRITE;
/*!40000 ALTER TABLE `precreditos` DISABLE KEYS */;
INSERT INTO `precreditos` VALUES (27,'10874924771','01-08-2017',6,11,30,2,360700,'Quincenal',5,10,54150,'1','16','Tipico',50000,'En estudio','El numero de factura es el numero de la cedula',11,11,'2017-08-01 09:28:46','2017-08-01 09:28:46'),(28,'1088296249','01-08-2017',6,11,31,2,410660,'Quincenal',2,4,123200,'3','18','Tipico',0,'No','El cliente es tipo c y no se le da el credito por que tiene un data credito muy bajo, lleva muy poco tiempo en la casa donde vive.',11,11,'2017-08-01 09:37:04','2017-08-01 10:10:25'),(29,'1089747144','01-08-2017',11,8,32,7,7000000,'Mensual',20,20,350000,'26','','Tipico',0,'Si','Cliente que se encuentra en Juridico, se realiza acuerdo de pago el 17 de mayo de 2.017, para cancelar 17 cuotas de $350.000, mas dos cuotas extraordinarias de 1.000.000 en julio 25 y Diciembre 25, adicional a esto da una inicial de $500.000, para un pago total de $8.450.000',8,8,'2017-08-01 10:39:33','2017-08-01 10:40:09'),(30,'1088271243','01-08-2017',6,13,33,3,320500,'Quincenal',4,8,56100,'2','17','Tipico',200000,'En estudio','La solicitud la hizo Diana Álvarez de cardisel.',13,13,'2017-08-01 11:04:27','2017-08-01 11:04:27'),(31,'75096817','01-08-2017',6,13,34,4,500000,'Quincenal',6,12,62500,'1','16','Tipico',0,'Si','La solicitud del crédito la hizo Diana tigo',13,10,'2017-08-01 14:42:36','2017-08-04 15:19:58'),(32,'1007651998','01-08-2017',6,13,35,4,610000,'Quincenal',7,14,67600,'2','17','Tipico',0,'En estudio','la solicitud la hizo Juan Carlos carreño de celuiris ',13,13,'2017-08-01 14:50:46','2017-08-01 14:50:46'),(33,'24336053','01-08-2017',6,11,36,4,600000,'Quincenal',6,12,75000,'1','16','Tipico',0,'No','A la cliente se le pidio codeudor , por que es tipo c , pensionada sin casa propia ni camara de comercio en su negocio. El credito es de Yordan manizales ',11,11,'2017-08-01 18:04:39','2017-08-01 18:06:12'),(34,'1088346535','02-08-2017',6,11,37,2,260700,'Quincenal',8,16,26100,'3','18','Tipico',150000,'Si','Se le solicita codeudor porque no cuenta con experiencia crediticia- y trajo codeudor. ',11,10,'2017-08-02 09:14:15','2017-08-02 19:36:14'),(35,'1004626671','02-08-2017',6,13,38,2,410700,'Quincenal',4,8,71900,'3','18','Tipico',0,'Si','',13,10,'2017-08-02 09:31:31','2017-08-04 15:35:46'),(36,'10030911','02-08-2017',6,13,39,1,129700,'Quincenal',2,4,38950,'2','17','Sin estudio',0,'Si','Ya es cliente',13,10,'2017-08-02 10:15:00','2017-08-04 19:34:05'),(37,'1088028813','02-08-2017',6,11,40,2,330700,'Quincenal',5,10,61700,'5','20','Tipico',80000,'En estudio','Se le solicita al cliente codeudor porque el data credito es muy bajito y el puntaje no le alcanza. Le disminuye por el data crédito tipo C , lleva poco en el empleo y la casa de alquilada. ',11,11,'2017-08-02 11:02:58','2017-08-02 11:02:58'),(38,'10088764','01-08-2017',11,8,41,7,2100000,'Quincenal',15,30,120000,'15','30','Sin estudio',0,'Si','Cliente que se encuentra en proceso Juridico la demanda quedo en firme, se negocio con el abogado del cliente, pero el cliente incumplio,',8,8,'2017-08-02 11:36:22','2017-08-02 12:19:38'),(39,'1055916931','02-08-2017',6,11,42,4,500000,'Quincenal',10,20,30600,'1','16','Tipico',0,'En estudio','La solicitud la hizo Yordan de Manizales ',11,11,'2017-08-02 12:10:16','2017-08-02 12:10:16'),(40,'42008899','02-08-2017',6,8,43,2,280000,'Quincenal',8,16,40000,'1','16','Sin estudio',0,'Si','Cliente se encontraba en la cartera antigua, se pasa al programa GOFIN 3000, con el acuerdo de pago que realizo, de cancelar 40.000 por 17 quincenas, se encuentra radicada en el juzgado OCTAVO  de Pereira',8,8,'2017-08-02 12:46:20','2017-08-02 12:48:39'),(41,'43482124','02-08-2017',6,11,44,2,411000,'Quincenal',4,8,72000,'2','17','Tipico',0,'Si','La solicitud la hizo Yurani supia',11,10,'2017-08-02 14:24:15','2017-08-04 16:00:00'),(42,'1060587582','02-08-2017',6,11,45,3,525800,'Quincenal',10,20,44700,'2','17','Tipico',0,'Si','La solicitud la hizo Yurani supia',11,11,'2017-08-02 15:38:42','2017-08-04 14:24:43'),(43,'1093215213','02-08-2017',6,11,46,3,525500,'Mensual',10,10,89400,'5','','Tipico',0,'Si','La solicitud la hizo Lorena CDA EJE CAFETERO',11,10,'2017-08-02 15:45:41','2017-08-04 15:23:45'),(44,'1088317219','02-08-2017',10,13,47,2,410700,'Quincenal',3,6,88900,'5','20','Sin estudio',0,'Si','Ya es cliente',13,2,'2017-08-02 18:03:34','2017-08-10 22:14:35'),(45,'18518978','02-08-2017',6,11,48,3,525500,'Quincenal',10,20,44700,'3','18','Tipico',0,'Si','La solicitud la hizo lorena cda eje cafetero',11,10,'2017-08-02 18:07:53','2017-08-04 19:37:24'),(46,'18610338','02-08-2017',6,11,49,3,525500,'Quincenal',8,16,52550,'2','17','Tipico',0,'Si','La solicitud la hizo lorena cda eje cafetero',11,10,'2017-08-02 18:22:15','2017-08-02 19:34:34'),(47,'9870428','02-08-2017',6,11,50,2,301300,'Quincenal',8,16,30150,'2','17','Tipico',0,'En estudio','La solicitud la hizo Diana de Cardisel. Se le solicita codeudor al cliente por que esta reportado en data credito.',11,11,'2017-08-02 18:33:25','2017-08-02 18:33:25'),(48,'1088292793','01-08-2017',6,8,51,7,300000,'Mensual',2,2,180000,'29','','Sin estudio',0,'Si','',10,10,'2017-08-02 19:44:34','2017-08-02 19:44:51'),(49,'18398837','03-08-2017',6,11,52,3,540400,'Mensual',6,6,135100,'27','','Sin estudio',0,'Si','Ya el cliente BB de gora',11,10,'2017-08-03 09:34:36','2017-08-04 19:32:33'),(50,'1088312236','03-08-2017',6,11,53,5,400000,'Mensual',4,4,140000,'2','','Tipico',0,'En estudio','La solicitud la hizo Nathalia Motocascos Pereira',11,11,'2017-08-03 10:11:58','2017-08-03 10:11:58'),(51,'18513952','03-08-2017',6,13,54,3,436400,'Quincenal',10,20,37100,'15','30','Sin estudio',0,'Si','Ya es cliente BB gora',11,10,'2017-08-03 12:36:20','2017-08-04 15:57:40'),(52,'1059695504','03-08-2017',6,11,55,3,525800,'Quincenal',5,10,79000,'3','18','Tipico',0,'En estudio','La solicitud la hizo Yurani supia',11,11,'2017-08-03 12:45:48','2017-08-03 12:45:48'),(53,'24645784','03-08-2017',6,11,56,4,400000,'Quincenal',10,20,34000,'1','16','Tipico',100000,'Si','La solicitud la hizo Yordan de manizales ',11,10,'2017-08-03 12:53:19','2017-08-04 15:14:57'),(54,'30337556','02-03-2017',6,11,57,4,600000,'Quincenal',6,12,75000,'1','16','Tipico',0,'En estudio','La solicitud la hizo yordan la señora anexo codeudor por que esta reportada. ',11,11,'2017-08-03 14:18:15','2017-08-03 14:18:15'),(55,'1088240543','03-08-2017',6,11,58,3,525500,'Quincenal',10,20,44700,'2','17','Tipico',0,'Si','La solicitud la hizo Lorena del cda eje cafetero',11,10,'2017-08-03 15:44:15','2017-08-04 19:30:32'),(56,'1002798409','03-08-2017',6,11,59,3,531000,'Quincenal',4,8,92950,'2','17','Tipico',0,'En estudio','La solicitud la hizo Yurani supia',11,11,'2017-08-03 15:54:28','2017-08-03 15:54:28'),(57,'10083588','03-08-2017',6,11,60,3,440400,'Quincenal',6,12,55100,'2','17','Sin estudio',100000,'Si','Ya es cliente de gora',11,10,'2017-08-03 18:19:18','2017-08-04 19:29:24'),(58,'1112788779','04-08-2017',6,11,61,3,525450,'Quincenal',5,10,78900,'2','17','Tipico',0,'En estudio','La solicitud la realiza andrea del cda CARTAGO, se NIEGA el credito porque al llamar a la mama a referenciar tiene cerca a su hija y le dice que ella esta desempleada , me da el nombre de la empresa pero no es, informacion falsa. ',11,11,'2017-08-04 10:32:26','2017-08-04 10:32:26'),(59,'15930095','04-08-2017',6,11,62,3,321800,'Quincenal',6,12,40250,'3','18','Tipico',0,'En estudio','La solicitud la hizo Yurani supia. ',11,11,'2017-08-04 10:43:34','2017-08-04 10:43:34'),(60,'1004518401','04-08-2017',6,11,63,3,866200,'Quincenal',10,20,73700,'13','28','Tipico',0,'En estudio','La solicitud la hizo Lorena cda eje cafetero',11,11,'2017-08-04 11:36:00','2017-08-04 11:36:00'),(61,'75060358','04-07-2017',6,11,64,2,300000,'Quincenal',6,12,37500,'3','18','Tipico',0,'Si','La solicitud la hizo Yurani supia',11,11,'2017-08-04 14:39:34','2017-08-04 14:41:18'),(62,'1058229673','04-08-2017',6,11,65,3,525800,'Quincenal',5,10,79000,'3','18','Tipico',0,'Si','La solicitud la hizo yurani supia ',11,10,'2017-08-04 15:01:38','2017-08-04 16:12:24'),(63,'1225089018','22-07-2017',6,11,66,3,506800,'Quincenal',6,12,63400,'1','16','Tipico',0,'Si','EL SALDO DEL CLIENTE ES CON MIL PESOS MAS PORQUE CAMBIE FECHA DE SOLICITUD Y NO CREO LA SANCIÓN',11,2,'2017-08-04 15:33:25','2017-08-08 13:34:10'),(64,'1088287780','04-08-2017',6,11,67,1,114800,'Quincenal',3,6,24900,'3','18','Tipico',0,'En estudio','La solicitud la hizo lorena cda eje cafetero',11,11,'2017-08-04 16:04:02','2017-08-04 16:04:02'),(65,'1088825432','04-08-2017',6,11,68,3,866460,'Quincenal',10,20,73700,'1','16','Tipico',0,'Si','La solicitud la hizo lorena cda eje cafetero',11,10,'2017-08-04 16:12:25','2017-08-04 19:34:54'),(66,'25042482','04-08-2017',6,11,69,2,307000,'Quincenal',3,6,66500,'4','19','Tipico',0,'En estudio','La solicitud la hizo Yurani supia',11,11,'2017-08-04 17:07:23','2017-08-04 17:07:23'),(67,'1088241700','28-07-2017',6,11,70,3,520200,'Quincenal',4,8,91050,'2','17','Tipico',0,'Si','La solicitud la hizo cardisel',11,10,'2017-08-04 17:13:31','2017-08-04 19:35:57'),(68,'1014443','04-08-2017',6,13,71,2,410660,'Quincenal',2,4,123200,'3','18','Tipico',0,'En estudio','Codeudor de Layniker Renteria Ayala ',13,13,'2017-08-04 18:26:15','2017-08-04 18:26:15'),(69,'10115161','04-08-2017',6,13,72,3,540400,'Quincenal',10,20,45950,'1','16','Sin estudio',0,'Si','',13,10,'2017-08-04 18:28:50','2017-08-04 19:27:54'),(70,'1088328773','04-08-2017',6,13,73,3,540400,'Quincenal',5,10,81100,'3','18','Tipico',0,'En estudio','',13,13,'2017-08-04 18:31:42','2017-08-04 18:31:42'),(71,'9976537','05-08-2017',6,11,75,4,640000,'Quincenal',6,12,80000,'1','16','Tipico',0,'En estudio','',11,11,'2017-08-05 13:55:09','2017-08-05 13:55:09'),(72,'1088273938','05-08-2017',6,11,77,2,821320,'Quincenal',10,20,69850,'3','18','Tipico',0,'En estudio','Al cliente se le solicita codeudor por que no esta reportado pero el data credito es muy bajito y hay una referencia que no me quizo dar informacion y otra no me contesto. Se llama al cliente para pedir otras referencias pero no contesta',11,11,'2017-08-05 14:15:20','2017-08-05 14:15:20'),(73,'10124076','05-08-2017',10,20,76,7,750000,'Quincenal',5,10,112550,'10','25','Sin estudio',0,'Si','',20,10,'2017-08-05 14:41:35','2017-08-05 15:26:18');
/*!40000 ALTER TABLE `precreditos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'R.T.M','REVISION TENICOMECANICA','2017-07-23 22:41:23','2017-07-24 07:20:16'),(2,'SOAT','VENTA DE SOAT A CREDITO','2017-07-24 07:19:33','2017-07-24 07:21:15'),(3,'SOAT R.T.M.','VENTA DE SOAT Y REVISION A CREDITO','2017-07-24 07:21:53','2017-07-24 07:22:13'),(4,'CELULAR','VENTA DE CELULARES A CREDITO','2017-07-24 07:22:40','2017-07-24 07:22:52'),(5,'CASCO','VENTA DE CASCO A CREDITO','2017-07-24 07:23:36','2017-07-24 07:23:52'),(6,'ACCESORIOS','VENTA DE ACCESORIOS A CREDITO','2017-07-24 07:25:28','2017-07-24 07:25:53'),(7,'LIBRE INVERSION','CREDITOS PARA LIBRE INVERSION','2017-07-24 07:26:37','2017-07-24 07:26:54'),(8,'MOTOCICLETA','MONTO MAXIMO $2.000.000','2017-08-01 08:37:55','2017-08-01 08:39:38'),(9,'LICENCIAS DE CONDUCCIÒN','CRÉDITO PARA LICENCIAS DE CONDUCCIÓN','2017-08-01 08:40:24','2017-08-03 12:31:18');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puntos`
--

DROP TABLE IF EXISTS `puntos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puntos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puntos`
--

LOCK TABLES `puntos` WRITE;
/*!40000 ALTER TABLE `puntos` DISABLE KEYS */;
INSERT INTO `puntos` VALUES (1,'LA 18 PEREIRA','Activo','Cl. 18 #11-56, Pereira, Risaralda','PRINCIPAL',NULL,NULL);
/*!40000 ALTER TABLE `puntos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sanciones`
--

DROP TABLE IF EXISTS `sanciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sanciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `credito_id` int(10) unsigned NOT NULL,
  `valor` double NOT NULL,
  `estado` enum('Ok','Debe','Exonerada') COLLATE utf8_unicode_ci NOT NULL,
  `pago_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sanciones_credito_id_foreign` (`credito_id`),
  CONSTRAINT `sanciones_credito_id_foreign` FOREIGN KEY (`credito_id`) REFERENCES `creditos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sanciones`
--

LOCK TABLES `sanciones` WRITE;
/*!40000 ALTER TABLE `sanciones` DISABLE KEYS */;
INSERT INTO `sanciones` VALUES (100,38,1000,'Ok',50,'2017-08-05 01:01:01','2017-08-07 03:27:16');
/*!40000 ALTER TABLE `sanciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activo',
  `rol` enum('Administrador','Asesor','Recaudador','Call') COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `punto_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_punto_id_foreign` (`punto_id`),
  CONSTRAINT `users_punto_id_foreign` FOREIGN KEY (`punto_id`) REFERENCES `puntos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Sistema','Activo','Administrador','sistema@mail.com','123',1,NULL,NULL,NULL),(2,'Pablo Adrian Gonzalez Salazar','Activo','Administrador','etereosum@gmail.com','$2y$10$nwLnCoAfY6upK7C8210yO..t9GgCJPvEltKOAYd0SgZD/dFcZPcp2',1,'dMHYSF9jDVyqFnhpYuW635Jmq3xrKePVwMBzuh16oNsEf8814BL2yWGnycDw','2017-04-06 04:01:27','2017-08-07 03:29:22'),(8,'JOHAND GÓMEZ RAMÍREZ','Activo','Administrador','negociosgorapereira@hotmail.com','$2y$10$IOFoCH/xkEgPaBqhasDsYekOAQgKMxoEBKxUlsuGbdenEQFOZpqIC',1,'51Y5KO99kWjVq1DSAcsQTjokE9jHwEmIb4zZ1fmRdP3Jfq1p3iEuQDfXwbjL','2017-08-01 08:33:28','2017-08-07 03:29:17'),(9,'JEISI JULIANA CORREA VALENZUELA','Activo','Asesor','goranegocios@gmail.com','$2y$10$hoFT0cpvDlP2kB31f/pUAOTLt5sYQ1PJXHds0ItOeA9Zc8dOa59Py',1,NULL,'2017-08-01 08:46:47','2017-08-01 09:04:57'),(10,'CLAUDIA YANETH LEAL MORENO','Activo','Administrador','clau8403@hotmail.com','$2y$10$KD4oPnLO5sqxwor96x8u6uqJNfh/Zyb3yBDKyPbLkWeAA3hK8EpLa',1,'UE5xAyQikDHeFAl8m53ysM0X9Noo4oBgZymAnLCIijPiIvvWwQFcZBFm9qs1','2017-08-01 08:50:07','2017-08-04 19:39:40'),(11,'DANIELA ANDREA GALVIS VALENCIA','Activo','Asesor','danygalvis@hotmail.com','$2y$10$wVYF8lLbhWf17Tr0lcrdc.XVdSdDrqpOE0/GHH.4/h5hveyxeYD8a',1,'sB8jiN0OywvIZP0A551cjUwiLN5yqJEAiMpgnWrbb7suZi9LGKWajMMtxCgf','2017-08-01 08:54:20','2017-08-01 10:11:38'),(13,'Valentina Martínez Quintero','Activo','Asesor','valenmq30@hotmail.com','$2y$10$eMcDVx5PUDeoyjMYA9DmU.r50kf56vK.0Gw4B74gsJfMRsXVxoDuG',1,'8Uw7VKCxB86zICiX17nmE4967XWVH60UfO6ewskAwyUcbXkSoVIrRmsuQcRT','2017-08-01 10:52:26','2017-08-04 18:32:11'),(15,'YUDY LORENA CARDONA GONZALES','Activo','Asesor','lorena199052@gmail.com','$2y$10$5.2oeXCs5LHtqCHD5HiWz.Nehur6lfk3JQYNp7EoHH6R5sAOeqAKK',1,NULL,'2017-08-04 10:27:12','2017-08-04 10:27:12'),(16,'HECTOR FABIO GOMEZ RAMIREZ','Activo','Asesor','HEFAGORASO@YAHOO.ES','$2y$10$ohq3qmFSdEP9/k1B4gXWCu2QgfH.vQVBEOz1v7NIn4ycyHKooePuG',1,NULL,'2017-08-04 10:31:41','2017-08-04 10:31:59'),(17,'MICHEL GOMEZ ALTAMIRANO','Activo','Asesor','michel.gomezalt@gmail.com','$2y$10$ivVZoqd/NgxBcerAY.cWxuNIiaWb3aHbBwu0l1At1mN1S1UJfiDoi',1,'zg0k6SVgnAAOWbJsaal68V6Y5LIMwc2GiSDd64Y9rhikNmaSY5OyLQngm1ii','2017-08-04 10:38:39','2017-08-04 15:03:50'),(20,'DANILO LOPEZ','Activo','Asesor','jlopezra64@hotmail.com','$2y$10$En4vjUm2zDkd7iR4F8Lq4uUpBImyF.z03cf5vrk4X62GOZfbTea..',1,NULL,'2017-08-04 11:11:27','2017-08-04 11:27:37');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variables`
--

DROP TABLE IF EXISTS `variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meses_min` int(11) NOT NULL,
  `meses_max` int(11) NOT NULL,
  `vlr_dia_sancion` int(11) NOT NULL,
  `vlr_estudio_tipico` int(11) NOT NULL,
  `vlr_estudio_domicilio` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variables`
--

LOCK TABLES `variables` WRITE;
/*!40000 ALTER TABLE `variables` DISABLE KEYS */;
INSERT INTO `variables` VALUES (1,2,36,1000,8000,15000,NULL,'2017-08-02 11:34:18');
/*!40000 ALTER TABLE `variables` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-10 22:01:48
