-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2023 at 05:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectgarage`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_listing`
--

CREATE TABLE `car_listing` (
  `id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `year` int(11) NOT NULL,
  `km` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_listing`
--

INSERT INTO `car_listing` (`id`, `price`, `year`, `km`, `image_id`) VALUES
(25, 2.00, 2, 2, NULL),
(26, 3.00, 3, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `image_path`) VALUES
(35, 'images/wny2EGL.jpg'),
(36, 'images/il_fullxfull.3449896728_mwly.avif');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `text_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`) VALUES
(1, 'alex2001pinault@gmail.com', 'kauz', '$2y$10$fwat4Js8uoHWpF.pYWxCBO9gRJ9M/uKPHHEUO1qVq0fNR//PW051C', ''),
(2, 'alex2001pinault@gmail.com', 'kauz', '$2y$10$r.mbEtx37P6twPhNNdpxXu3L.CAmapiDPBhJD7J51fku1OaKgLJcu', ''),
(3, 'alex20021pinault@gmail.com', 'kauz2', '$2y$10$swYHjgjnMqbmJSqcKGx.k.KEFZStx3KdwIjKeggAz/Hy830AQUuNm', ''),
(4, 'alex200221pinault@gmail.com', 'Zauk', '$2y$10$7m4JmEcWj/jlxtrBbbyGhu8t0nJrSsbmN2oLVIUAatbzi6qzRPa3S', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_listing`
--
ALTER TABLE `car_listing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_image` (`image_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_listing`
--
ALTER TABLE `car_listing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_listing`
--
ALTER TABLE `car_listing`
  ADD CONSTRAINT `fk_image` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
