-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 02:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(10) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used'),
(20, 'Ferrari'),
(21, 'Birds');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(7, 'Aaron', 'Bechtel', 'bechtel.aaron22@gmail.com', '$2y$10$md4cZMSsVj0GJ7PO1jKI.urasDscqPMEIqYEwjGSr4PyfZV8XWYZm', '1', NULL),
(11, 'Admin', 'User', 'admin@cse340.net', '$2y$10$BOPMEyLMYIoAJ/k.840IauGNyUKXecCeD/9ng0mXVXOAoM2ngxmo6', '3', NULL),
(14, 'Test', 'User', 'test.user@testmail.org', '$2y$10$7VhnnXoZhpVr72y7VplmIeUCXscdR5RipOEsFbgLT/Jk5C207GkPW', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(45, 1, 'jeep-wrangler.jpg', '/phpmotors/images/vehicles/jeep-wrangler.jpg', '2023-11-30 23:18:17', 1),
(46, 1, 'jeep-wrangler-tn.jpg', '/phpmotors/images/vehicles/jeep-wrangler-tn.jpg', '2023-11-30 23:18:17', 1),
(47, 2, 'ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt.jpg', '2023-11-30 23:18:47', 1),
(48, 2, 'ford-modelt-tn.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '2023-11-30 23:18:47', 1),
(49, 3, 'lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve.jpg', '2023-11-30 23:35:34', 1),
(50, 3, 'lambo-Adve-tn.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '2023-11-30 23:35:34', 1),
(51, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2023-11-30 23:35:56', 1),
(52, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2023-11-30 23:35:56', 1),
(53, 4, 'monster2.jpg', '/phpmotors/images/vehicles/monster2.jpg', '2023-11-30 23:36:17', 0),
(54, 4, 'monster2-tn.jpg', '/phpmotors/images/vehicles/monster2-tn.jpg', '2023-11-30 23:36:17', 0),
(55, 5, 'ms.jpg', '/phpmotors/images/vehicles/ms.jpg', '2023-11-30 23:36:34', 1),
(56, 5, 'ms-tn.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '2023-11-30 23:36:34', 1),
(57, 5, 'ms2.jpg', '/phpmotors/images/vehicles/ms2.jpg', '2023-11-30 23:36:46', 0),
(58, 5, 'ms2-tn.jpg', '/phpmotors/images/vehicles/ms2-tn.jpg', '2023-11-30 23:36:46', 0),
(59, 6, 'bat.jpg', '/phpmotors/images/vehicles/bat.jpg', '2023-11-30 23:36:55', 1),
(60, 6, 'bat-tn.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '2023-11-30 23:36:55', 1),
(61, 7, 'mm.jpg', '/phpmotors/images/vehicles/mm.jpg', '2023-11-30 23:37:06', 1),
(62, 7, 'mm-tn.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '2023-11-30 23:37:06', 1),
(63, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2023-11-30 23:37:15', 1),
(64, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2023-11-30 23:37:15', 1),
(65, 9, 'crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic.jpg', '2023-11-30 23:37:32', 1),
(66, 9, 'crown-vic-tn.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '2023-11-30 23:37:32', 1),
(67, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2023-11-30 23:37:40', 1),
(68, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2023-11-30 23:37:40', 1),
(69, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2023-11-30 23:38:05', 1),
(70, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2023-11-30 23:38:05', 1),
(71, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2023-11-30 23:38:20', 1),
(72, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2023-11-30 23:38:20', 1),
(73, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2023-11-30 23:38:28', 1),
(74, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2023-11-30 23:38:29', 1),
(75, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2023-11-30 23:38:39', 1),
(76, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2023-11-30 23:38:39', 1),
(77, 24, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2023-11-30 23:40:37', 1),
(78, 24, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2023-11-30 23:40:37', 1),
(79, 24, 'delorean2bcynot.jpg', '/phpmotors/images/vehicles/delorean2bcynot.jpg', '2023-11-30 23:40:51', 0),
(80, 24, 'delorean2bcynot-tn.jpg', '/phpmotors/images/vehicles/delorean2bcynot-tn.jpg', '2023-11-30 23:40:51', 0),
(81, 25, 'chickens.png', '/phpmotors/images/vehicles/chickens.png', '2023-11-30 23:41:03', 1),
(82, 25, 'chickens-tn.png', '/phpmotors/images/vehicles/chickens-tn.png', '2023-11-30 23:41:03', 1),
(83, 15, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2023-11-30 23:42:36', 1),
(84, 15, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2023-11-30 23:42:36', 1),
(85, 23, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2023-12-01 00:09:32', 1),
(86, 23, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2023-12-01 00:09:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,2) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/phpmotors/images/vehicles/jeep-wrangler.jpg', '/phpmotors/images/vehicles/jeep-wrangler-tn.jpg', 28045.00, 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/phpmotors/images/vehicles/ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', 30000.00, 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicles/lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', 417650.00, 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', 150000.00, 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/vehicles/ms.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', 100.00, 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/vehicles/bat.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', 65000.00, 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mm.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', 10000.00, 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', 50000.00, 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', 10000.00, 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', 25000.00, 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', 75195.00, 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', 58800.00, 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', 1000000.00, 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month.', '/phpmotors/images/vehicles/fbi.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', 20000.00, 1, 'Green', 1),
(15, 'Dog', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', 35000.00, 1, 'Brown', 2),
(23, 'Superfast', 'Car', 'A superfast car!', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', 10000000.00, 1, 'red', 20),
(24, 'DMC', 'Delorean', 'The super-fast, time-skipping, mind-boggling car of the century (or past centuries, lol)!', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', 0.01, 1, 'time-travel blue', 3),
(25, 'Chicken', 'Nugget', 'I need to eat dinner soon.', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', 0.02, 10, 'golden-rod', 21);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(22, 'chicken nuggies', '2023-11-29 09:24:34', 25, 11),
(23, 'Who ya gonna call? Ghost Busters!', '2023-11-29 10:22:52', 14, 11),
(24, 'Roobiie-roobie-rooOOOOOOOO!!!!!!\r\nLike, ZOINKS, Scoob!', '2023-11-29 10:23:55', 7, 11),
(25, 'I don&#039;t get paid enough for this...', '2023-11-29 10:24:38', 23, 11),
(26, 'VROOM', '2023-11-29 10:24:54', 4, 11),
(27, 'A classic beauty', '2023-11-29 10:25:14', 9, 11),
(28, 'GI Joe would love this', '2023-11-29 10:25:35', 12, 11),
(29, 'WEE OOO WEE OOO WEE OO', '2023-11-29 10:26:01', 8, 11),
(30, 'DANANANANANDANANANANA- BAT-MAAAAAAAN', '2023-11-29 10:26:31', 6, 11),
(31, 'I hate this', '2023-11-29 10:26:50', 24, 11),
(32, 'oooooOOOOOOOooOOOOOOOooOOOOO', '2023-11-29 10:27:05', 10, 11),
(33, 'cool beans', '2023-11-29 10:27:21', 11, 11),
(34, 'Weird, ancient technology.', '2023-11-29 10:28:00', 2, 7),
(35, 'Choo-choo goes the airplane, because why not.', '2023-11-29 10:28:23', 13, 7),
(36, 'This is definitely within my budget...', '2023-11-29 10:28:46', 3, 7),
(37, 'a fake review', '2023-12-01 00:19:04', 23, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
