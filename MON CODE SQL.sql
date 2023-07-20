SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `satisfaction` varchar(50) NOT NULL,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `avis` (`id`, `name`, `email`, `satisfaction`, `comments`, `created_at`) VALUES
(1, 'kauz', 'alex2001pinault@gmail.com', 'Very Satisfied', 'asdsad', '2023-07-21 05:17:01'),
(2, 'kauz', 'alex2001pinault@gmail.com', 'Very Satisfied', 'asasas', '2023-07-21 05:19:01'),
(3, 'kauz', 'alex2001pinault@gmail.com', 'Dissatisfied', 'asdasdas', '2023-07-21 05:24:33'),
(4, 'kauz', 'alex2001pinault@gmail.com', 'Very Satisfied', 'asdasd', '2023-07-21 05:27:03'),
(5, 'kauz', 'alex2001pinault@gmail.com', 'Very Dissatisfied', 'asdasd', '2023-07-21 05:27:33');

CREATE TABLE `car_listing` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `year` int(11) NOT NULL,
  `km` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `car_listing` (`id`, `model`, `price`, `year`, `km`) VALUES
(1, 'Lamborghini', 250000.00, 2012, 58000),
(68, 'Ferrari', 150000.00, 2006, 120000);

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `path_image` varchar(255) DEFAULT NULL,
  `car_listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `images` (`id`, `path_image`, `car_listing_id`) VALUES
(51, '/images/lambo1.jpg', 1),
(52, '/images/lambo1.jpg', 1),
(53, '/images/lambo2.jpg', 1),
(54, '/images/PortofinoModelImage.jpg', 68);

CREATE TABLE `mechanic_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `mechanic_services` (`id`, `service_name`, `description`, `price`, `duration`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Changement de pneu', 'Changement de pneu, hiver, ete, tout temps....prix pneu compris', 400.00, 120, NULL, '2023-07-21 06:11:45', '2023-07-21 06:11:45'),
(2, 'Changement de pneu', 'Changement de pneu, hiver, ete, tout temps....prix pneu compris', 400.00, 120, NULL, '2023-07-21 06:11:48', '2023-07-21 06:11:48');

CREATE TABLE `opening_hours` (
  `id` int(11) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `opening_time` time NOT NULL,
  `closing_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `opening_hours` (`id`, `day_of_week`, `opening_time`, `closing_time`) VALUES
(1, 'Monday', '08:00:00', '17:00:00'),
(2, 'Tuesday', '08:00:00', '17:00:00'),
(3, 'Wednesday', '08:00:00', '17:00:00'),
(4, 'Thursday', '08:00:00', '17:00:00'),
(5, 'Friday', '08:00:00', '17:00:00'),
(6, 'Saturday', '09:00:00', '14:00:00'),
(7, 'Sunday', '00:00:00', '00:00:00');

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `text_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `email`, `username`, `password`, `is_admin`) VALUES
(19, 'vincentparrot@gmail.com', 'Vincent Parrot', '$2y$10$1gQC0ZaK4ZC3YOXDBN10x.OuG2WkN9VKp2MonrBc2ud2CJ0eFHNV6', 1);

ALTER TABLE `avis` ADD PRIMARY KEY (`id`);
ALTER TABLE `car_listing` ADD PRIMARY KEY (`id`);
ALTER TABLE `contact` ADD PRIMARY KEY (`id`);
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_ibfk_1` (`car_listing_id`) USING BTREE;
ALTER TABLE `mechanic_services` ADD PRIMARY KEY (`id`);
ALTER TABLE `opening_hours` ADD PRIMARY KEY (`id`);
ALTER TABLE `services` ADD PRIMARY KEY (`id`);
ALTER TABLE `users` ADD PRIMARY KEY (`id`);

ALTER TABLE `avis` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
ALTER TABLE `car_listing` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
ALTER TABLE `contact` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
ALTER TABLE `images` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
ALTER TABLE `mechanic_services` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `opening_hours` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
ALTER TABLE `services` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `images` ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`car_listing_id`) REFERENCES `car_listing` (`id`) ON DELETE CASCADE;
COMMIT;
