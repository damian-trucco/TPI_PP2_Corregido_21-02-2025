-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_urquiza_actualizada
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `DNI` int(11) NOT NULL,
  `Mail` varchar(45) DEFAULT NULL,
  `Domicilio` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos` (
  `ID_Alumno` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Documento` int(20) NOT NULL,
  `Domicilio` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `carrera_id` int(11) NOT NULL,
  PRIMARY KEY (`ID_Alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` VALUES (16,'Famian','Ortega',56165102,'Uspallata 5872','runero78@yahoo',1),(17,'Adolfo','Perez Esquivel',1541546,'Godoy 8547','psv862@gmail.com',3);
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumnosmaterias`
--

DROP TABLE IF EXISTS `alumnosmaterias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnosmaterias` (
  `ID_Alumno` int(11) NOT NULL,
  `ID_Materia` int(11) NOT NULL,
  PRIMARY KEY (`ID_Alumno`,`ID_Materia`),
  KEY `ID_Materia` (`ID_Materia`),
  CONSTRAINT `alumnosmaterias_ibfk_1` FOREIGN KEY (`ID_Alumno`) REFERENCES `alumnos` (`ID_Alumno`),
  CONSTRAINT `alumnosmaterias_ibfk_2` FOREIGN KEY (`ID_Materia`) REFERENCES `materias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnosmaterias`
--

LOCK TABLES `alumnosmaterias` WRITE;
/*!40000 ALTER TABLE `alumnosmaterias` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumnosmaterias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bedeles`
--

DROP TABLE IF EXISTS `bedeles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bedeles` (
  `ID_Bedel` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Legajo` varchar(45) NOT NULL,
  `Telefono` varchar(45) DEFAULT NULL,
  `Domicilio` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_Bedel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bedeles`
--

LOCK TABLES `bedeles` WRITE;
/*!40000 ALTER TABLE `bedeles` DISABLE KEYS */;
/*!40000 ALTER TABLE `bedeles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carreras`
--

DROP TABLE IF EXISTS `carreras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carreras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carreras`
--

LOCK TABLES `carreras` WRITE;
/*!40000 ALTER TABLE `carreras` DISABLE KEYS */;
INSERT INTO `carreras` VALUES (1,'Analista Funcional'),(2,'Desarrollador de Software'),(3,'Infraestructura en Tecnologia de la Información');
/*!40000 ALTER TABLE `carreras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comisiones` (
  `ID_Comision` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_Comision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comisiones`
--

LOCK TABLES `comisiones` WRITE;
/*!40000 ALTER TABLE `comisiones` DISABLE KEYS */;
/*!40000 ALTER TABLE `comisiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(50) NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clave` (`clave`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,'max_inscripciones',300);
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docentes`
--

DROP TABLE IF EXISTS `docentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `docentes` (
  `ID_Docente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Legajo` varchar(45) NOT NULL,
  `Domicilio` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_Docente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docentes`
--

LOCK TABLES `docentes` WRITE;
/*!40000 ALTER TABLE `docentes` DISABLE KEYS */;
/*!40000 ALTER TABLE `docentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscripciones`
--

DROP TABLE IF EXISTS `inscripciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `carrera_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carrera_id` (`carrera_id`),
  KEY `materia_id` (`materia_id`),
  CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`),
  CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscripciones`
--

LOCK TABLES `inscripciones` WRITE;
/*!40000 ALTER TABLE `inscripciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `inscripciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscripciones_materias`
--

DROP TABLE IF EXISTS `inscripciones_materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inscripciones_materias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Alumno` int(11) NOT NULL,
  `ID_Materia` int(11) NOT NULL,
  `fecha_inscripcion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `ID_Alumno` (`ID_Alumno`),
  KEY `ID_Materia` (`ID_Materia`),
  CONSTRAINT `inscripciones_materias_ibfk_1` FOREIGN KEY (`ID_Alumno`) REFERENCES `alumnos` (`ID_Alumno`),
  CONSTRAINT `inscripciones_materias_ibfk_2` FOREIGN KEY (`ID_Materia`) REFERENCES `materias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscripciones_materias`
--

LOCK TABLES `inscripciones_materias` WRITE;
/*!40000 ALTER TABLE `inscripciones_materias` DISABLE KEYS */;
INSERT INTO `inscripciones_materias` VALUES (1,16,1,'2025-02-22 14:03:54'),(2,16,2,'2025-02-22 14:03:54'),(3,16,3,'2025-02-22 14:03:54'),(4,16,1,'2025-02-22 14:12:00'),(5,16,2,'2025-02-22 14:12:00'),(6,16,3,'2025-02-22 14:12:00'),(7,16,1,'2025-02-22 14:30:08'),(8,16,2,'2025-02-22 14:30:08'),(9,16,3,'2025-02-22 14:30:08'),(10,16,1,'2025-02-22 14:31:06'),(11,16,2,'2025-02-22 14:31:06'),(12,16,3,'2025-02-22 14:31:06'),(13,16,1,'2025-02-22 14:32:41'),(14,16,2,'2025-02-22 14:32:41'),(15,16,3,'2025-02-22 14:32:41'),(16,17,1,'2025-02-22 14:33:28'),(17,17,2,'2025-02-22 14:33:28'),(18,17,3,'2025-02-22 14:33:28'),(19,17,1,'2025-02-22 14:37:07'),(20,17,2,'2025-02-22 14:37:07'),(21,17,3,'2025-02-22 14:37:07');
/*!40000 ALTER TABLE `inscripciones_materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `anio` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `carrera_id` (`carrera_id`),
  CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias`
--

LOCK TABLES `materias` WRITE;
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
INSERT INTO `materias` VALUES (1,1,'Comunicación 1',1),(2,1,'UDI 1',1),(3,1,'Matemática',1),(4,1,'Inglés Técnico 1',1),(5,1,'Psicosociología de las Organizaciones',1),(6,1,'Modelos de Negocios',1),(7,1,'Arquitectura de las Computadoras',1),(8,1,'Gestión de Software',1),(9,1,'Análisis de Sistemas Organizacionales',1),(10,1,'Problemáticas Socio Contemporáneas',2),(11,1,'UDI 2',2),(12,1,'Inglés Técnico 2',2),(13,1,'Estadística',2),(14,1,'Innovación y Desarrollo Emprendedor',2),(15,1,'Gestión de Software 2',2),(16,1,'Estrategias de Negocios',2),(17,1,'Desarrollo de Sistemas',2),(18,1,'Práctica Profesionalizante 1',2),(19,1,'Ética y Responsabilidad Social',3),(20,1,'Derecho y Legislación Laboral',3),(21,1,'Redes y Comunicaciones',3),(22,1,'Seguridad de los Sistemas',3),(23,1,'Bases de Datos',3),(24,1,'Sistema de Información Organizacional',3),(25,1,'Desarrollo de Sistemas Web',3),(26,1,'Práctica Profesionalizante 2',3),(27,2,'Comunicación 1',1),(28,2,'UDI 1',1),(29,2,'Matemática',1),(30,2,'Inglés Técnico 1',1),(31,2,'Administración',1),(32,2,'Tecnología de la Información',1),(33,2,'Lógica y Estructura de Datos',1),(34,2,'Ingeniería de Software 1',1),(35,2,'Sistemas Operativos',1),(36,2,'Problemáticas Socio Contemporáneas',2),(37,2,'UDI 2',2),(38,2,'Inglés Técnico 2',2),(39,2,'Estadística',2),(40,2,'Innovación y Desarrollo Emprendedor',2),(41,2,'Ingenieria de Software 2',2),(42,2,'Programación 1',2),(43,2,'Bases de Datos 1',2),(44,2,'Práctica Profesionalizante 1',2),(45,2,'Ética y Responsabilidad Social',3),(46,2,'Derecho y Legislación Laboral',3),(47,2,'Redes y Comunicaciones',3),(48,2,'Bases de Datos 2',3),(49,2,'Programación 2',3),(50,2,'Gestión de Proyectos de Software',3),(51,2,'Práctica Profesionalizante 2',3),(52,3,'Comunicación 1',1),(53,3,'UDI 1',1),(54,3,'Matemática',1),(55,3,'Inglés Técnico',1),(56,3,'Administración',1),(57,3,'Física Aplicada a las Tecnologías de la Información',1),(58,3,'Arquitectura de las Computadoras',1),(59,3,'Lógica y Programación',1),(60,3,'Infraestructura de Redes 1',1),(61,3,'Problemáticas Socio Contemporáneas',2),(62,3,'UDI 2',2),(63,3,'Estadística',2),(64,3,'Innovación y Desarrollo Emprendedor',2),(65,3,'Sistemas Operativos',2),(66,3,'Bases de Datos',2),(67,3,'Algoritmos y Estructura de Datos',2),(68,3,'Infraestructura de Redes 2',2),(69,3,'Práctica Profesionalizante 1',2),(70,3,'Ética y Responsabilidad Social',3),(71,3,'Derecho y Legislación Laboral',3),(72,3,'Administración de Bases de Datos',3),(73,3,'Seguridad de los Sistemas',3),(74,3,'Integridad y Migración de Datos',3),(75,3,'Administración de Sistemas Operativos y Redes',3),(76,3,'Práctica Profesionalizante 2',3);
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiascomisiones`
--

DROP TABLE IF EXISTS `materiascomisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materiascomisiones` (
  `ID_Materia` int(11) NOT NULL,
  `ID_Comision` int(11) NOT NULL,
  `CantidadHoras` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Materia`,`ID_Comision`),
  KEY `ID_Comision` (`ID_Comision`),
  CONSTRAINT `materiascomisiones_ibfk_1` FOREIGN KEY (`ID_Materia`) REFERENCES `materias` (`id`),
  CONSTRAINT `materiascomisiones_ibfk_2` FOREIGN KEY (`ID_Comision`) REFERENCES `comisiones` (`ID_Comision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiascomisiones`
--

LOCK TABLES `materiascomisiones` WRITE;
/*!40000 ALTER TABLE `materiascomisiones` DISABLE KEYS */;
/*!40000 ALTER TABLE `materiascomisiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiasprofesores`
--

DROP TABLE IF EXISTS `materiasprofesores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materiasprofesores` (
  `ID_Materia` int(11) NOT NULL,
  `ID_Profesor` int(11) NOT NULL,
  PRIMARY KEY (`ID_Materia`,`ID_Profesor`),
  KEY `ID_Profesor` (`ID_Profesor`),
  CONSTRAINT `materiasprofesores_ibfk_1` FOREIGN KEY (`ID_Materia`) REFERENCES `materias` (`id`),
  CONSTRAINT `materiasprofesores_ibfk_2` FOREIGN KEY (`ID_Profesor`) REFERENCES `docentes` (`ID_Docente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiasprofesores`
--

LOCK TABLES `materiasprofesores` WRITE;
/*!40000 ALTER TABLE `materiasprofesores` DISABLE KEYS */;
/*!40000 ALTER TABLE `materiasprofesores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesas`
--

DROP TABLE IF EXISTS `mesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesas` (
  `ID_Mesa` int(11) NOT NULL AUTO_INCREMENT,
  `FechaMesa` date NOT NULL,
  PRIMARY KEY (`ID_Mesa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesas`
--

LOCK TABLES `mesas` WRITE;
/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
/*!40000 ALTER TABLE `mesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesasalumnosmaterias`
--

DROP TABLE IF EXISTS `mesasalumnosmaterias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesasalumnosmaterias` (
  `ID_Mesa` int(11) NOT NULL,
  `ID_Alumno` int(11) NOT NULL,
  `ID_Materia` int(11) NOT NULL,
  PRIMARY KEY (`ID_Mesa`,`ID_Alumno`,`ID_Materia`),
  KEY `ID_Alumno` (`ID_Alumno`),
  KEY `ID_Materia` (`ID_Materia`),
  CONSTRAINT `mesasalumnosmaterias_ibfk_1` FOREIGN KEY (`ID_Mesa`) REFERENCES `mesas` (`ID_Mesa`),
  CONSTRAINT `mesasalumnosmaterias_ibfk_2` FOREIGN KEY (`ID_Alumno`) REFERENCES `alumnos` (`ID_Alumno`),
  CONSTRAINT `mesasalumnosmaterias_ibfk_3` FOREIGN KEY (`ID_Materia`) REFERENCES `materias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesasalumnosmaterias`
--

LOCK TABLES `mesasalumnosmaterias` WRITE;
/*!40000 ALTER TABLE `mesasalumnosmaterias` DISABLE KEYS */;
/*!40000 ALTER TABLE `mesasalumnosmaterias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesasmaterias`
--

DROP TABLE IF EXISTS `mesasmaterias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesasmaterias` (
  `ID_Mesa` int(11) NOT NULL,
  `ID_Materia` int(11) NOT NULL,
  PRIMARY KEY (`ID_Mesa`,`ID_Materia`),
  KEY `ID_Materia` (`ID_Materia`),
  CONSTRAINT `mesasmaterias_ibfk_1` FOREIGN KEY (`ID_Mesa`) REFERENCES `mesas` (`ID_Mesa`),
  CONSTRAINT `mesasmaterias_ibfk_2` FOREIGN KEY (`ID_Materia`) REFERENCES `materias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesasmaterias`
--

LOCK TABLES `mesasmaterias` WRITE;
/*!40000 ALTER TABLE `mesasmaterias` DISABLE KEYS */;
/*!40000 ALTER TABLE `mesasmaterias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesasprofesores`
--

DROP TABLE IF EXISTS `mesasprofesores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesasprofesores` (
  `ID_Mesa` int(11) NOT NULL,
  `ID_Profesor` int(11) NOT NULL,
  PRIMARY KEY (`ID_Mesa`,`ID_Profesor`),
  KEY `ID_Profesor` (`ID_Profesor`),
  CONSTRAINT `mesasprofesores_ibfk_1` FOREIGN KEY (`ID_Mesa`) REFERENCES `mesas` (`ID_Mesa`),
  CONSTRAINT `mesasprofesores_ibfk_2` FOREIGN KEY (`ID_Profesor`) REFERENCES `docentes` (`ID_Docente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesasprofesores`
--

LOCK TABLES `mesasprofesores` WRITE;
/*!40000 ALTER TABLE `mesasprofesores` DISABLE KEYS */;
/*!40000 ALTER TABLE `mesasprofesores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pre_inscripcion`
--

DROP TABLE IF EXISTS `pre_inscripcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pre_inscripcion` (
  `ID_pre_inscripcion` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Documento` int(20) NOT NULL,
  `Domicilio` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `carrera` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_pre_inscripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pre_inscripcion`
--

LOCK TABLES `pre_inscripcion` WRITE;
/*!40000 ALTER TABLE `pre_inscripcion` DISABLE KEYS */;
INSERT INTO `pre_inscripcion` VALUES (1,'Juan','Perez',21651561,'Larrea 1234','damian.trucco.1994@gmail.com',''),(2,'Pedro','Sanchez',1541546,'Virasoro 862','psv862@gmail.com','TÉCNICO SUPERIOR EN DESARROLLO DE SOFTWARE');
/*!40000 ALTER TABLE `pre_inscripcion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-22 13:05:37
