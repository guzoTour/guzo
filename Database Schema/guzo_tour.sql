-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 05:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guzo_tour`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `tour_id` int(10) NOT NULL,
  `region` varchar(50) NOT NULL,
  `direction` varchar(50) NOT NULL,
  `town` varchar(50) NOT NULL,
  `x_cordinate` double NOT NULL DEFAULT 38.7694859836311,
  `y_cordinate` double NOT NULL DEFAULT 8.995338660399943
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`tour_id`, `region`, `direction`, `town`, `x_cordinate`, `y_cordinate`) VALUES
(1, 'SNNP', 'North', 'bodity', 38.7694859836311, 8.995338660399943),
(2, 'AA', 'Center', 'AA', 38.7694859836311, 8.995338660399943),
(3, 'SNNPwfc', 'Center', 'honbo', 38.7694859836311, 8.995338660399943),
(4, 'SNNP', 'Center', 'sodo', 38.7694859836311, 8.995338660399943),
(5, 'Amhara', 'north', 'konbolcha', 38.7694859836311, 8.995338660399943),
(6, 'SNNP', 'East', 'hunbo', 38.7694859836311, 8.995338660399943),
(8, 'tigray', 'north', 'aksum', 38.7694859836311, 8.995338660399943),
(10, 'addis ababa', 'center', 'addis ababa', 38.7694859836311, 8.995338660399943),
(11, 'debub', 'south', 'Arbaminch', 38.7694859836311, 8.995338660399943);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `tour_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `piad` tinyint(1) NOT NULL,
  `Created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`tour_id`, `user_id`, `piad`, `Created_at`) VALUES
(1, 20, 1, '2022-05-11'),
(1, 38, 1, '2022-05-11'),
(1, 39, 1, '2022-05-11'),
(1, 40, 1, '2022-05-19'),
(2, 35, 1, '2022-05-11'),
(2, 38, 1, '2022-06-02'),
(2, 45, 1, '2022-06-06'),
(3, 48, 1, '2022-06-06'),
(4, 20, 1, '2022-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `review` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(5) NOT NULL,
  `tour_id` int(5) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `review`, `created_at`, `user_id`, `tour_id`, `rating`) VALUES
(1, 'sdeeeeeee ', '2022-05-17', 20, 3, 0),
(3, 'sogygehbdsucgyvcjkdwjvhj', '2022-06-05', 38, 1, 5),
(6, 'wedffewqef', '2022-06-05', 38, 3, 4),
(4, '4tgtghrethh', '2022-06-05', 38, 4, 0),
(5, '4tgtghrethh', '2022-06-05', 38, 6, 4),
(2, 'gvycyc', '2022-06-05', 40, 6, 5),
(7, 'best place ever', '2022-06-06', 45, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `tour_id` int(10) NOT NULL,
  `tour_name` varchar(30) NOT NULL,
  `duration` int(11) NOT NULL,
  `difficulty` varchar(5) NOT NULL DEFAULT 'easy',
  `group_size` int(5) NOT NULL,
  `price` double NOT NULL,
  `discount` double NOT NULL,
  `summary` mediumtext NOT NULL,
  `descriptions` longtext NOT NULL,
  `cover_image` text NOT NULL DEFAULT 'default-cover.jpg',
  `images` text NOT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `start_date` date DEFAULT current_timestamp(),
  `rating_quantity` int(11) NOT NULL DEFAULT 0,
  `rating` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`tour_id`, `tour_name`, `duration`, `difficulty`, `group_size`, `price`, `discount`, `summary`, `descriptions`, `cover_image`, `images`, `created_at`, `start_date`, `rating_quantity`, `rating`) VALUES
(1, 'Ajora', 6, 'easy', 45, 300.48, 12.3, 'It is a historical place where Emperor Menelik II resided and built his palace, when he came from Ankober and founded Addis Ababa. It is considered a sacred mountain and has many monasteries. \r\n\r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n', 'It is a historical place where Emperor Menelik II resided and built his palace, when he came from Ankober and founded Addis Ababa. It is considered a sacred mountain and has many monasteries.', 'default-cover.jpg', 'default.jpg', '2022-04-03', '2022-06-08', 1, 5),
(2, 'Entoto ', 5, 'easy', 200, 300.48, 12.3, 'It is a historical place where Emperor Menelik II resided and built his palace, when he came f\r\n \r\n', 'It is a historical place where Emperor Menelik II resided and built his palace, when he came from Ankober and founded Addis Ababa. It is considered a sacred mountain and has many monasteries.', 'default-cover.jpg', 'default.jpg', '2022-04-03', '2022-04-07', 1, 4),
(3, 'Lalibela', 50, 'easy', 20, 780.4, 12.3, 'It is a historical place where Emperor Menelik II resided and built his palace, when he came from Ankober and founded Addis Ababa. It is considered a sacred mountain and has many monasteries. Mount Entoto is also the location of a number of celebrated churches, including Saint Raguel and Saint Mary.[1]\r\n\r\nThe mountain is densely covered by eucalyptus trees that were imported from Australia during the reign of Menelik II, and mostly planted during Emperor Haile Selassie\'s reign. Thus, it is sometimes referred to as the \"lung of Addis Ababa\". The forest on the mountain is an important source of firewood for the city. It was also a source of building material in earlier times.\r\n\r\nThe Ethiopian Heritage Trust, a non-profit, non-governmental organization, is working actively to change part of the mountain to its old state, a natural park. Entoto Natural Park is the northeastern rim of Addis Abeba, on the southeastern slopes of Mt. Entoto, covering an area of 1,300 hectares. It is situated at an altitude of between 2,600 and 3,100 meters. Its annual average rainfall and temperature are 1200 mm and 14°C, respectively. The northern rim of the park serves as a watershed between the Abay (Blue Nile) and Awash rivers.', 'It is a historical place where Emperor Menelik II resided and built his palace, when he came from Ankober and founded Addis Ababa. It is considered a sacred mountain and has many monasteries.', 'default-cover.jpg', 'default.jpg', '2022-04-03', '2022-04-07', 2, 2),
(4, 'awash', 2, 'easy', 24, 1200.4, 12.3, ' \r\n', 'It is a historical place where Emperor Menelik II resided and built his palace, when he came from Ankober and founded Addis Ababa. It is considered a sacred mountain and has many monasteries.', 'default-cover.jpg', 'default.jpg', '2022-04-03', '2022-06-16', 1, 0),
(5, 'bodity', 44, 'easy', 67, 78.4, 12.3, '', 'It is a historical place where Emperor Menelik II resided and built his palace, when he came from Ankober and founded Addis Ababa. It is considered a sacred mountain and has many monasteries.', 'default-cover.jpg', 'default.jpg', '2022-04-03', '2022-04-07', 0, 0),
(6, 'Hawassa', 4, 'hard', 23, 89.9, 12.3, '', 'It is a historical place where Emperor Menelik II resided and built his palace, when he came from Ankober and founded Addis Ababa. It is considered a sacred mountain and has many monasteries.', 'default-cover.jpg', 'default.jpg', '2022-04-03', '2022-05-28', 2, 4.5),
(8, 'Aksum', 45, 'mediu', 12, 12432, 324, '32564yu357ehydgj', 'It is a historical place where Emperor Menelik II resided and built his palace, when he came from Ankober and founded Addis Ababa. It is considered a sacred mountain and has many monasteries.', 'default-cover.jpg', 'default.jpg', '2022-06-06', '2022-06-06', 0, 0),
(10, 'Andiet Park', 45, 'mediu', 20, 231589, 2134, 'sdfgvtkjrhlydtujyioy', 'It is a historical place where Emperor Menelik II resided and built his palace, when he came from Ankober and founded Addis Ababa. It is considered a sacred mountain and has many monasteries.', 'default-cover.jpg', 'default.jpg', '2022-06-06', '2022-06-06', 0, 0),
(11, 'Nech Sar', 23, 'mediu', 15, 7800, 500, 'Arbamich is amazing place to vist', 'It is a historical place where Emperor Menelik II resided and built his palace, when he came from Ankober and founded Addis Ababa. It is considered a sacred mountain and has many monasteries.', 'default-cover.jpg', 'default.jpg', '2022-06-07', '2022-06-07', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pw` varchar(150) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'user',
  `photo` varchar(50) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `email`, `pw`, `phone_number`, `role`, `photo`) VALUES
(20, 'bereket', 'alemu', 'samuel45', 'samuelnoah668@gmail.com', '$1$rasmusln$VRmqkC/fcX/jAQoS.7n2G1', '+2519450039393', 'user', 'user-9.jpg'),
(35, 'samuel', 'noah', 'yosi89', 'samuelnfoah668@gmail.com', '$1$rasmusln$VRmqkC/fcX/jAQoS.7n2G1', '+2519043548347', 'user', 'default.jpg'),
(36, 'selamu', 'dawit', 'selamudev', 'sol668@gmail.com', '$1$rasmusln$VRmqkC/fcX/jAQoS.7n2G1', '09047865', 'admin', 'user-17.jpg'),
(38, 'Tesu', 'kedird', 'tesu56', 'samuelnompihceah668@gmail.com', '$1$rasmusln$VRmqkC/fcX/jAQoS.7n2G1', '+2519043898948', 'user', 'default.jpg'),
(39, 'sami', 'noah', 'yo67', 'yordi@gmail.com', '$1$rasmusln$VRmqkC/fcX/jAQoS.7n2G1', '09450039393', 'admin', 'default.jpg'),
(40, 'mulualem', 'noah', 'mulu34', 'emu@gmail.com', '$1$rasmusln$VRmqkC/fcX/jAQoS.7n2G1', '0935941496', 'user', 'default.jpg'),
(42, 'yonata', 'tesfaye', 'yoni30', 'yonatantesfaye30@gmail.com', '$1$rasmusln$VRmqkC/fcX/jAQoS.7n2G1', '6875765', 'user', 'default.jpg'),
(44, 'yonas', 'sisay', 'yos', 'yonimelkamu357@gmail.com', '$1$rasmusln$VRmqkC/fcX/jAQoS.7n2G1', '028474737', 'user', 'default.jpg'),
(45, 'Abel', 'Alemayew', 'abu45', 'abel67@gmail.com', '$1$rasmusln$VRmqkC/fcX/jAQoS.7n2G1', '0934234565', 'user', 'default.jpg'),
(48, 'Markoss', 'Bassa', 'markosbassa', 'mark@gmail.com', '$1$rasmusln$VRmqkC/fcX/jAQoS.7n2G1', '0987654322', 'user', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`tour_id`,`user_id`),
  ADD KEY `For` (`tour_id`),
  ADD KEY `Fort` (`user_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`user_id`,`tour_id`),
  ADD UNIQUE KEY `1` (`id`),
  ADD KEY `Test` (`user_id`),
  ADD KEY `new` (`tour_id`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`tour_id`),
  ADD UNIQUE KEY `tour_name` (`tour_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`,`phone_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tour`
--
ALTER TABLE `tour`
  MODIFY `tour_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour` (`tour_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `tour is booked` FOREIGN KEY (`tour_id`) REFERENCES `tour` (`tour_id`),
  ADD CONSTRAINT `user books` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `new` FOREIGN KEY (`tour_id`) REFERENCES `tour` (`tour_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user has review` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
