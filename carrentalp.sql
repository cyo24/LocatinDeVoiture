-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 17 mai 2022 à 19:51
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `carrentalp`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `car_id` int(20) NOT NULL AUTO_INCREMENT,
  `car_name` varchar(50) NOT NULL,
  `car_nameplate` varchar(50) NOT NULL,
  `car_img` varchar(50) DEFAULT 'NA',
  `non_ac_price` float NOT NULL,
  `car_availability` varchar(10) NOT NULL,
  PRIMARY KEY (`car_id`),
  UNIQUE KEY `car_nameplate` (`car_nameplate`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `car_nameplate`, `car_img`, `non_ac_price`, `car_availability`) VALUES
(1, 'Audi A4', '9140TN140', 'assets/img/cars/audi-a4.jpg', 260, 'non'),
(2, 'Hyundai Creta', '8001TN166', 'assets/img/cars/creta.jpg', 120, 'oui'),
(3, 'BMW 6-Series', '4520TN180', 'assets/img/cars/bmw6.jpg', 300, 'oui'),
(4, 'Mercedes-Benz E-Class', '2510TN191', 'assets/img/cars/mcec.jpg', 300, 'oui'),
(6, 'Ford EcoSport', '2587TN140', 'assets/img/cars/ecosport.png', 130, 'oui'),
(8, 'Land Rover Range Rover Sport', '9669TN166', 'assets/img/cars/rangero.jpg', 260, 'oui'),
(9, 'MG Hector', '6666TN200', 'assets/img/cars/mghector.jpg', 120, 'oui'),
(10, 'Honda CR-V', '1997TN197', 'assets/img/cars/hondacr.jpg', 150, 'oui'),
(12, 'Toyota Fortuner', '1956TN198', 'assets/img/cars/Fortuner.png', 140, 'oui'),
(13, 'Hyundai Veloster', '5685TN201', 'assets/img/cars/hyundai0.png', 150, 'oui'),
(14, 'Jaguar XF', '8866TN186', 'assets/img/cars/jaguarxf.jpg', 290, 'oui'),
(15, 'Clio 5', '8754TN186', '../../assets/img/cars/clio 5.jpg', 110, 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `client_username` varchar(50) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_phone` varchar(15) NOT NULL,
  `client_email` varchar(25) NOT NULL,
  `client_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `client_password` varchar(20) NOT NULL,
  PRIMARY KEY (`client_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`client_username`, `client_name`, `client_phone`, `client_email`, `client_address`, `client_password`) VALUES
('harry', 'Harry Den', '9876543210', 'harryden@gmail.com', '2477  Harley Vincent Drive', 'password'),
('jenny', 'Jeniffer Washington', '7850000069', 'washjeni@gmail.com', '4139  Mesa Drive', 'jenny'),
('tom', 'Tommy Doee', '900696969', 'tom@gmail.com', '4645  Dawson Drive', 'password');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_username` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_email` varchar(25) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `customer_password` varchar(20) NOT NULL,
  PRIMARY KEY (`customer_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`customer_username`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_password`) VALUES
('ethan', 'Ethan Hawk', '69741111110', 'thisisethan@gmail.com', '4554  Rowes Lane', 'password'),
('james', 'James Washington', '0258786969', 'james@gmail.com', '2316  Mayo Street', 'password'),
('lucas', 'Lucas Rhoades', '7003658500', 'lucas@gmail.com', '2737  Fowler Avenue', 'password');

-- --------------------------------------------------------

--
-- Structure de la table `rentedcars`
--

DROP TABLE IF EXISTS `rentedcars`;
CREATE TABLE IF NOT EXISTS `rentedcars` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `customer_username` varchar(50) NOT NULL,
  `car_id` int(20) NOT NULL,
  `booking_date` date NOT NULL,
  `rent_start_date` date NOT NULL,
  `rent_end_date` date NOT NULL,
  `car_return_date` date DEFAULT NULL,
  `fare` double NOT NULL,
  `distance` double DEFAULT NULL,
  `no_of_days` int(50) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `return_status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_username` (`customer_username`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB AUTO_INCREMENT=574681267 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rentedcars`
--

INSERT INTO `rentedcars` (`id`, `customer_username`, `car_id`, `booking_date`, `rent_start_date`, `rent_end_date`, `car_return_date`, `fare`, `distance`, `no_of_days`, `total_amount`, `return_status`) VALUES
(574681246, 'james', 6, '2018-07-18', '2018-06-01', '2018-06-28', '2018-07-18', 15, 69, 27, 5035, 'R'),
(574681247, 'antonio', 3, '2018-07-18', '2018-07-19', '2018-07-22', '2018-07-20', 13, 421, 3, 5473, 'R'),
(574681248, 'ethan', 1, '2018-07-20', '2018-07-28', '2018-07-29', '2018-07-20', 10, 69, 1, 690, 'R'),
(574681249, 'james', 1, '2018-07-23', '2018-07-24', '2018-07-25', '2018-07-23', 10, 500, 1, 5000, 'R'),
(574681250, 'lucas', 3, '2018-07-23', '2018-07-23', '2018-07-24', '2018-07-23', 2600, NULL, 1, 2600, 'R'),
(574681251, 'james', 10, '2018-07-23', '2018-07-25', '2018-07-30', '2018-07-23', 10, 60, 2, 600, 'R'),
(574681252, 'christine', 11, '2018-07-23', '2018-07-23', '2018-07-23', '2018-07-23', 13, 200, 0, 2600, 'R'),
(574681253, 'christine', 6, '2018-07-23', '2018-07-23', '2018-08-03', '2018-07-23', 2600, NULL, 11, 28600, 'R'),
(574681254, 'ethan', 12, '2018-07-23', '2018-07-23', '2018-07-26', '2018-07-23', 3200, NULL, 3, 9600, 'R'),
(574681255, 'christine', 8, '2018-07-23', '2018-07-23', '2018-08-08', '2018-07-23', 2400, NULL, 16, 38400, 'R'),
(574681257, 'james', 7, '2018-08-11', '2018-08-13', '2018-08-17', NULL, 14, NULL, NULL, NULL, 'NR'),
(574681258, 'lucas', 3, '2021-03-24', '2021-03-24', '2021-03-25', '2021-03-24', 2600, NULL, 1, 2600, 'R'),
(574681259, 'lucas', 14, '2021-03-24', '2021-03-24', '2021-03-26', '2021-03-24', 6100, NULL, 2, 12200, 'R');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

DROP TABLE IF EXISTS `voitures`;
CREATE TABLE IF NOT EXISTS `voitures` (
  `id` int(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `matr` varchar(50) NOT NULL,
  `img` varchar(50) DEFAULT 'NA',
  `climrix` float NOT NULL,
  `nonclimprix` float NOT NULL,
  `acprixparj` float NOT NULL,
  `nonacprixparj` float NOT NULL,
  `car_availability` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
