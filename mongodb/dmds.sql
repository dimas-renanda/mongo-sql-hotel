-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2022 at 08:22 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dmds`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `region_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_code`, `country_name`, `region_id`) VALUES
(1, 'INA', 'Indonesia', 3),
(2, 'SGP', 'Singapore', 3),
(3, 'AUS', 'Australia', 5),
(4, 'FRA', 'France', 1),
(5, 'CHN', 'China', 3),
(6, 'MYS', 'Malaysia', 3),
(7, 'BEL', 'Belgia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `country_origin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `gender`, `country_origin`) VALUES
(1, 'kelvin', 'kucluks', 'kelvinkucluks@gmail.com', '$2y$10$NACTJslxamDF65J1X736tuee8EBuDv7dHdU/6N21GscYUQzBcWBEi', '0851234567895456', 'Male', 'INA'),
(2, 'cobaa', 'akun', 'cobaakun@gmail.com', '$2y$10$OcygSo1z05w0GbeR34rtROMIMCZD.ybF2rAfkd6eN9bw5D0jagdKK', '081812345645', 'Male', 'INA'),
(3, 'dimas', 'renanda', 'dimasrenanda@gmail.com', '$2y$10$33YdnHd2/98yYY8fnLPEfetNmE2hGBJRV6uwd9j07nigiuNsnWkRm', '081812345645', 'Male', 'INA'),
(4, 'dimass2', 'renanda2', 'dimasrenanda2@gmail.com', '$2y$10$yTW68v8MlGOa1r7wmXOZve9jldXiG8s7SJxnqqznRA30cCN2Vl6ni', '081812345645', 'Female', 'INA'),
(5, 'drs', 'renanda', 'renanda@gmail.com', '$2y$10$33YdnHd2/98yYY8fnLPEfetNmE2hGBJRV6uwd9j07nigiuNsnWkRm', NULL, 'Male', 'SGP'),
(6, 'John', 'Doe', 'doe@gmail.com', '$2y$10$33YdnHd2/98yYY8fnLPEfetNmE2hGBJRV6uwd9j07nigiuNsnWkRm', NULL, 'Female', 'AUS'),
(7, 'hari', 'kucluk', 'harikucluk@gmail.com', '$2y$10$vpHOIG8/VXu4UtZvfJl1B.BBaLVXj5tmXyPp1WzGaU6cncvKRUL.O', '089967112020', 'Male', 'INA'),
(8, 'Steve', 'Roger', 'steveroger@gmail.com', '$2y$10$yqinblFn89qknTMYaInZCeEnivnl63FFle6lNELOLXtxkZ/04l5LK', '081812345645', 'Male', 'AUS'),
(9, 'Bruce', 'Banner', 'brucebanner@gmail.com', '$2y$10$g..4d1nMGNNsXdPdAssBDeb9CdHGVx76c2XjyTkgUlX/z6kBE.doi', '081812345645', 'Male', 'SGP'),
(10, 'Andrew', 'Yahut', 'andrewyahutser@gmail.com', '$2y$10$UwErXzgu/wXMO4HsMEvbkeoh6rabe1WosSu/pbN7llX6YK.YJlJHa', '087721403050', 'Male', 'SGP');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `region_id` int(11) NOT NULL,
  `region_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`region_id`, `region_name`) VALUES
(1, 'Europe'),
(2, 'Americas'),
(3, 'Asia'),
(4, 'Middle East and Africa'),
(5, 'Oceania');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
