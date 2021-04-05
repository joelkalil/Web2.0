CREATE DATABASE  IF NOT EXISTS `Suivi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `Suivi`;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(45) NOT NULL,
  `passe` varchar(45) NOT NULL,
  `statut` char(1) NOT NULL DEFAULT 'E' COMMENT 'E=Etudiant, P=Professeur',
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'tom','tom','P'),(2,'isa','isa','P'),(3,'pierre','pierre','E'),(4,'marie','marie','E'),(5,'henri','henri','E');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projets`
--

DROP TABLE IF EXISTS `projets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projets` (
  `idProjet` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique du projet',
  `nomProjet` varchar(100) NOT NULL COMMENT 'Nom du projet',
  `anneeScolaire` varchar(9) DEFAULT '2020-2021',
  `idResponsable` int(11) NOT NULL COMMENT 'Identifiant de l''utilisateur qui crée le projet',
  PRIMARY KEY (`idProjet`),
  KEY `fk_projets_1_idx` (`idResponsable`),
  CONSTRAINT `fk_projets_1` FOREIGN KEY (`idResponsable`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projets`
--

LOCK TABLES `projets` WRITE;
/*!40000 ALTER TABLE `projets` DISABLE KEYS */;
INSERT INTO `projets` VALUES (2,'Projet Hackathon 2021 LA2','2020-2021',2),(3,'LA PECHE','2020-2021',2),(4,'Dev POO LA2','2020-2021',2);
/*!40000 ALTER TABLE `projets` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `etapes`
--

DROP TABLE IF EXISTS `etapes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etapes` (
  `idEtape` int(11) NOT NULL AUTO_INCREMENT,
  `idProjet` int(11) NOT NULL,
  `descriptionEtape` varchar(100) NOT NULL,
  `dateFinEtape` date DEFAULT NULL,
  PRIMARY KEY (`idEtape`),
  KEY `fk_etapes_1_idx` (`idProjet`),
  CONSTRAINT `fk_etapes_1` FOREIGN KEY (`idProjet`) REFERENCES `projets` (`idProjet`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etapes`
--

LOCK TABLES `etapes` WRITE;
/*!40000 ALTER TABLE `etapes` DISABLE KEYS */;
INSERT INTO `etapes` VALUES (1,2,'Mockups','2021-03-31'),(2,2,'Spécifications fonctionnelles','2021-04-10'),(3,2,'Lot1','2021-04-30'),(4,2,'Lot 2','2021-05-15'),(5,2,'Présentation power point','2021-06-01'),(7,3,'C\'est super chouette','2021-02-03'),(8,3,'C\'est encore + cool','2021-10-02'),(9,4,'Cahier des charges','2021-04-01'),(10,4,'Spécifications fonctionnelles','2021-04-15'),(11,4,'Spécifications détaillées','2021-04-30'),(12,4,'Livrable code N°1','2021-05-15');
/*!40000 ALTER TABLE `etapes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contributions`
--

DROP TABLE IF EXISTS `contributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contributions` (
  `idEtape` int(11) NOT NULL COMMENT 'Identifiant de l''étape à laquelle correspond cette contribution',
  `idUser` int(11) NOT NULL COMMENT 'Identifiant de l''utilisateur qui crée la contribution',
  `dateContribution` date NOT NULL,
  `urlContribution` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUser`,`idEtape`),
  KEY `fk_contributions_1_idx` (`idEtape`),
  CONSTRAINT `fk_contributions_1` FOREIGN KEY (`idEtape`) REFERENCES `etapes` (`idEtape`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contributions_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contributions`
--

LOCK TABLES `contributions` WRITE;
/*!40000 ALTER TABLE `contributions` DISABLE KEYS */;
INSERT INTO `contributions` VALUES (1,3,'2021-03-20','Contrib Mockup Pierre'),(2,3,'2021-03-20','Contrib mockup pierre'),(3,3,'2021-03-20','Llot1 Pierre'),(5,3,'2021-03-20','pp pierre'),(7,3,'2021-03-20','qsdqdsqsd'),(8,3,'2021-03-20','qsdqsd'),(1,5,'2021-03-20','Contrib Henri Mockup'),(2,5,'2021-03-20','AA'),(3,5,'2021-03-20','BB'),(4,5,'2021-03-20','VV'),(5,5,'2021-03-20','DD'),(7,5,'2021-03-20','URL1'),(8,5,'2021-03-20','URL 2');
/*!40000 ALTER TABLE `contributions` ENABLE KEYS */;
UNLOCK TABLES;



/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-20 10:23:47
