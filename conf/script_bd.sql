CREATE DATABASE physiclation;
USE physiclation;

CREATE TABLE `USER`(
	`idUser` INT NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    `email` VARCHAR(320) NOT NULL,
    `senha` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`idUser`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `SIMULATION`(
	`IdSimulation` INT NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    `linkImagem` VARCHAR(1000) NOT NULL,
    `link` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`IdSimulation`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

# POSSUEM CHAVES ESTRANGEIRAS
CREATE TABLE `TYPE_SIMULATION`(
	`IdType` INT NOT NULL,
    `idSimulation` INT NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`IdType`),
    FOREIGN KEY (`idSimulation`) REFERENCES `SIMULATION` (`idSimulation`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `FAV_SIMULATION` (
	`idSimulation` INT NOT NULL,
    `idUser` INT NOT NULL,
    FOREIGN KEY (`idSimulation`) REFERENCES `SIMULATION` (`idSimulation`),
	FOREIGN KEY (`idUser`) REFERENCES `USER` (`idUser`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `SIMULATION_ERROR` (
	`idError` INT NOT NULL,
    `idUser` INT NOT NULL,
    `idSimulation` INT NOT NULL,
    `descript` varchar (5000),
    PRIMARY KEY(`idError`),
     FOREIGN KEY (`idSimulation`) REFERENCES `SIMULATION` (`idSimulation`),
	FOREIGN KEY (`idUser`) REFERENCES `USER` (`idUser`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

