-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time:  3 май 2017 в 07:51
-- Версия на сървъра: 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taxi`
--

-- --------------------------------------------------------

--
-- Структура на таблица `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `street_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `entrance` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `address`
--

INSERT INTO `address` (`id`, `street_id`, `number`, `entrance`) VALUES
(2, 2, 20, 'В'),
(1, 2, 43, 'Б'),
(3, 3, 122, 'Д');

-- --------------------------------------------------------

--
-- Структура на таблица `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `area`
--

INSERT INTO `area` (`id`, `city_id`, `name`) VALUES
(1, 1, 'Дружба'),
(3, 2, 'Кайсиева градина'),
(2, 2, 'Цветен Квартал');

-- --------------------------------------------------------

--
-- Структура на таблица `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `car_model_id` int(11) NOT NULL,
  `car_type_id` int(11) NOT NULL,
  `car_fuel_id` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `power` int(4) NOT NULL,
  `engine` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `car`
--

INSERT INTO `car` (`id`, `car_model_id`, `car_type_id`, `car_fuel_id`, `year`, `power`, `engine`) VALUES
(1, 1, 1, 1, 1995, 190, 2.6),
(3, 2, 2, 2, 2000, 100, 1.4),
(4, 5, 3, 2, 1990, 80, 1.3);

-- --------------------------------------------------------

--
-- Структура на таблица `car_brand`
--

CREATE TABLE `car_brand` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `car_brand`
--

INSERT INTO `car_brand` (`id`, `name`) VALUES
(3, 'BMW'),
(5, 'Ferari'),
(2, 'Ford'),
(4, 'Nisan'),
(1, 'Opel'),
(6, 'Subaro');

-- --------------------------------------------------------

--
-- Структура на таблица `car_fuel`
--

CREATE TABLE `car_fuel` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `car_fuel`
--

INSERT INTO `car_fuel` (`id`, `name`) VALUES
(1, 'Дизел'),
(2, 'Бензин');

-- --------------------------------------------------------

--
-- Структура на таблица `car_model`
--

CREATE TABLE `car_model` (
  `id` int(11) NOT NULL,
  `car_brand_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `car_model`
--

INSERT INTO `car_model` (`id`, `car_brand_id`, `name`) VALUES
(5, 1, 'Cadet'),
(1, 1, 'Omega'),
(2, 1, 'Vectra'),
(3, 2, 'Fiesta'),
(4, 2, 'Mondeo'),
(6, 5, 'Testerosa');

-- --------------------------------------------------------

--
-- Структура на таблица `car_register`
--

CREATE TABLE `car_register` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `car_register`
--

INSERT INTO `car_register` (`id`, `car_id`, `city_id`, `name`) VALUES
(1, 1, 1, '8182'),
(3, 3, 2, '3333'),
(4, 4, 1, '1234'),
(5, 3, 2, '1231');

-- --------------------------------------------------------

--
-- Структура на таблица `car_type`
--

CREATE TABLE `car_type` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `car_type`
--

INSERT INTO `car_type` (`id`, `name`) VALUES
(3, '4x4'),
(1, 'Кабрио'),
(2, 'Комби');

-- --------------------------------------------------------

--
-- Структура на таблица `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `identificator` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `city`
--

INSERT INTO `city` (`id`, `name`, `identificator`) VALUES
(1, 'Плевен', 'ЕН'),
(2, 'Варна', 'В'),
(3, 'София', 'С');

-- --------------------------------------------------------

--
-- Структура на таблица `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `company`
--

INSERT INTO `company` (`id`, `name`, `description`) VALUES
(1, 'Triumf Taxi', ''),
(2, 'Lasia', '');

-- --------------------------------------------------------

--
-- Структура на таблица `company2city`
--

CREATE TABLE `company2city` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `company2city`
--

INSERT INTO `company2city` (`id`, `user_id`, `city_id`, `company_id`) VALUES
(1, 1, 2, 2);

-- --------------------------------------------------------

--
-- Структура на таблица `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `from_address_id` int(11) NOT NULL,
  `to_address_id` int(11) NOT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `request`
--

INSERT INTO `request` (`id`, `from_address_id`, `to_address_id`, `from_user_id`, `to_user_id`, `client_id`, `date_created`) VALUES
(1, 1, 3, 2, 1, 3, '0000-00-00 00:00:00'),
(2, 1, 3, 2, 2, 3, '2016-08-28 18:08:28'),
(3, 1, 1, 0, 0, 0, '2016-09-01 02:56:32'),
(4, 1, 1, 0, 0, 0, '2016-09-01 02:57:09'),
(5, 1, 1, NULL, NULL, 0, '2016-09-01 03:01:16'),
(6, 1, 1, NULL, 9, 3, '2016-09-01 03:01:48'),
(7, 1, 1, NULL, NULL, NULL, '2016-09-01 03:02:22'),
(8, 1, 1, NULL, 9, 4, '2016-09-01 03:03:52'),
(9, 1, 1, NULL, NULL, 3, '2016-09-01 03:24:44'),
(10, 2, 2, NULL, 9, 12, '2016-09-01 03:33:36'),
(11, 1, 1, NULL, NULL, 3, '2016-09-01 03:38:44');

-- --------------------------------------------------------

--
-- Структура на таблица `street`
--

CREATE TABLE `street` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `street`
--

INSERT INTO `street` (`id`, `area_id`, `name`) VALUES
(1, 1, 'Дружба'),
(2, 2, 'Ружа'),
(3, 3, 'Кайсиева градина');

-- --------------------------------------------------------

--
-- Структура на таблица `taxi_driver`
--

CREATE TABLE `taxi_driver` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company2city_id` int(11) NOT NULL,
  `car_register_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `taxi_driver`
--

INSERT INTO `taxi_driver` (`id`, `user_id`, `company2city_id`, `car_register_id`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура на таблица `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `user`
--

INSERT INTO `user` (`id`, `user_type_id`, `name`, `email`, `date_created`, `password`) VALUES
(1, 2, 'Шишо Бакшишо', 'shisho@taxidrive.dev', '2016-08-19 20:43:53', '527ed6a651b3a2c9522530d7c8c5e61f'),
(2, 2, 'Михаил Петков', 'mihail@taxidrive.dev', '2016-08-28 14:44:36', '527ed6a651b3a2c9522530d7c8c5e61f'),
(3, 4, 'Атанаска Атанасова', 'cordinator@taxidrive.dev', '2016-08-28 18:05:48', 'b537a06cf3bcb33206237d7149c27bc3'),
(4, 4, 'Тихомир Маринов', 'client1@taxidrive.dev', '2016-08-28 18:06:36', 'c8837b23ff8aaa8a2dde915473ce0991'),
(5, 2, 'Test Taxi', 'test_axi@testtaxi.testtaxi', '2016-09-01 02:16:43', '527ed6a651b3a2c9522530d7c8c5e61f'),
(6, 2, 'Test Taxi2', 'testtaxi@testtaxi.testtaxi', '2016-09-01 02:23:10', '527ed6a651b3a2c9522530d7c8c5e61f'),
(8, 2, 'test taxi 3', 'testtaxi2@testtaxi.testtaxi', '2016-09-01 02:24:36', '527ed6a651b3a2c9522530d7c8c5e61f'),
(9, 2, 'Test Taxi 4', 'taxidrive3@taxidrive.taxi', '2016-09-01 02:35:59', '527ed6a651b3a2c9522530d7c8c5e61f'),
(10, 2, 'tsadasdasdefsdf', 'taxidrive3@taxidrive.taxii', '2016-09-01 02:37:04', '0673e9b372036948533523b1ab9a6e21'),
(11, 3, 'dasdasd', 'cordinatortaxi@taxi.taxi', '2016-09-01 02:48:12', '527ed6a651b3a2c9522530d7c8c5e61f'),
(12, 4, 'petkov', 'testclient@client.client', '2016-09-01 03:14:25', '527ed6a651b3a2c9522530d7c8c5e61f'),
(13, 1, 'Администратор', 'testadmin@adminn.admin', '2016-09-01 03:17:37', '527ed6a651b3a2c9522530d7c8c5e61f');

-- --------------------------------------------------------

--
-- Структура на таблица `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'Администратор'),
(3, 'Диспечер'),
(4, 'Клиент'),
(2, 'Таксиметров шофьор');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `street_id` (`street_id`,`number`,`entrance`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city_id` (`city_id`,`name`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `car_model_id` (`car_model_id`,`car_type_id`,`car_fuel_id`,`year`,`power`,`engine`);

--
-- Indexes for table `car_brand`
--
ALTER TABLE `car_brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `car_fuel`
--
ALTER TABLE `car_fuel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_model`
--
ALTER TABLE `car_model`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `car_brand_id` (`car_brand_id`,`name`);

--
-- Indexes for table `car_register`
--
ALTER TABLE `car_register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city_id` (`city_id`,`name`);

--
-- Indexes for table `car_type`
--
ALTER TABLE `car_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `identificator` (`identificator`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `company2city`
--
ALTER TABLE `company2city`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city_id` (`city_id`,`company_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `street`
--
ALTER TABLE `street`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `area_id` (`area_id`,`name`);

--
-- Indexes for table `taxi_driver`
--
ALTER TABLE `taxi_driver`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`company2city_id`,`car_register_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `car_brand`
--
ALTER TABLE `car_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `car_fuel`
--
ALTER TABLE `car_fuel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `car_model`
--
ALTER TABLE `car_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `car_register`
--
ALTER TABLE `car_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `car_type`
--
ALTER TABLE `car_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `company2city`
--
ALTER TABLE `company2city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `street`
--
ALTER TABLE `street`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `taxi_driver`
--
ALTER TABLE `taxi_driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
