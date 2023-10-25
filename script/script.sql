CREATE DATABASE IF NOT EXISTS `madrid` ;
USE `madrid` ; 





CREATE TABLE `administration` (
  `paimentID` int(11) NOT NULL,
  `chantierID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





CREATE TABLE `chantier` (
  `chantierID` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `ville` varchar(10) NOT NULL,
  `date` date DEFAULT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;








CREATE TABLE `paiment` (
  `paimentID` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;








ALTER TABLE `administration`
  ADD KEY `paimentID` (`paimentID`),
  ADD KEY `administration_ibfk_2` (`chantierID`);


ALTER TABLE `chantier`
  ADD PRIMARY KEY (`chantierID`);


ALTER TABLE `paiment`
  ADD PRIMARY KEY (`paimentID`);




ALTER TABLE `chantier`
  MODIFY `chantierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;


ALTER TABLE `paiment`
  MODIFY `paimentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;



ALTER TABLE `administration`
  ADD CONSTRAINT `administration_ibfk_1` FOREIGN KEY (`paimentID`) REFERENCES `paiment` (`paimentID`),
  ADD CONSTRAINT `administration_ibfk_2` FOREIGN KEY (`chantierID`) REFERENCES `chantier` (`chantierID`) ON DELETE CASCADE ON UPDATE CASCADE;


INSERT INTO `paiment` (`paimentID`, `nom`) VALUES
(1,'cheque'),
(2,'espece'),
(3,'enigne'),
(4,'par-carte'),
(5,'Bon d achat'),
(6,'Bitcoin'),
(7,'autres');
