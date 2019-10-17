-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 17, 2019 at 12:34 PM
-- Server version: 10.4.7-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile_shop`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`roxo`@`localhost` PROCEDURE `add_cart` (IN `cid` INT(225), IN `mid` INT(225))  NO SQL
INSERT INTO cart (c_id,m_id) VALUES (cid,mid)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_email` ()  NO SQL
SELECT email, sec_question from credentials$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fetch_cred` ()  NO SQL
SELECT email,pass FROM credentials$$

CREATE DEFINER=`roxo`@`localhost` PROCEDURE `fetch_mobiles_brand` ()  NO SQL
SELECT mobile_data.*, mobile_brands.b_Name  FROM mobile_data INNER JOIN mobile_brands on mobile_data.b_id = mobile_brands.b_id$$

CREATE DEFINER=`roxo`@`localhost` PROCEDURE `get_cartid` (IN `mid` BIGINT(255), IN `cid` BIGINT(255))  NO SQL
SELECT cart_id from cart WHERE m_id=mid and c_id = cid$$

CREATE DEFINER=`roxo`@`localhost` PROCEDURE `get_cid_seca_secq` (IN `mail` VARCHAR(50))  NO SQL
SELECT c_id, sec_ans, sec_question from credentials where email = mail$$

CREATE DEFINER=`roxo`@`localhost` PROCEDURE `get_pid` (IN `mobname` VARCHAR(50))  NO SQL
SELECT m_id FROM mobile_data WHERE mobile_name = mobname$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_cred` (IN `mail` VARCHAR(50), IN `pas` VARCHAR(100), IN `quest` VARCHAR(50), IN `ans` TEXT)  NO SQL
INSERT INTO credentials(email,pass,sec_question,sec_ans) VALUES(mail,pas,quest,ans)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_cred` (IN `pas` VARCHAR(32), IN `cid` INT(50), IN `mail` VARCHAR(30))  NO SQL
UPDATE credentials SET pass=pas, email = mail WHERE c_id=cid$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` bigint(200) NOT NULL,
  `c_id` bigint(225) NOT NULL,
  `m_id` bigint(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `c_id` bigint(225) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sec_question` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sec_ans` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`c_id`, `email`, `pass`, `sec_question`, `sec_ans`) VALUES
(1, 'admin', 'd9b1d7db4cd6e70935368a1efb10e377', 'What is your birtplace ?', '0a54604fc68b24496d40f02ff5f806ba'),
(2, '123@123', 'd9b1d7db4cd6e70935368a1efb10e377', 'What is your pet name ?', '202cb962ac59075b964b07152d234b70'),
(3, 'paras@gmail', 'd9b1d7db4cd6e70935368a1efb10e377', 'What is your mother\'s birthplace ?', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_brands`
--

CREATE TABLE `mobile_brands` (
  `b_id` bigint(225) NOT NULL,
  `b_Name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_brands`
--

INSERT INTO `mobile_brands` (`b_id`, `b_Name`) VALUES
(6, 'Apple'),
(10, 'Blackberry'),
(7, 'HTC'),
(9, 'LG'),
(5, 'Nokia'),
(8, 'One Plus'),
(4, 'Oppo'),
(1, 'Samsung'),
(3, 'Vivo'),
(2, 'Xiaomi');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_data`
--

CREATE TABLE `mobile_data` (
  `m_id` bigint(225) NOT NULL,
  `mobile_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b_id` bigint(225) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `man_date` date NOT NULL,
  `warranty` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mrp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` bigint(50) NOT NULL,
  `discount` int(50) NOT NULL,
  `pic` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_data`
--

INSERT INTO `mobile_data` (`m_id`, `mobile_name`, `b_id`, `description`, `man_date`, `warranty`, `mrp`, `stock`, `discount`, `pic`) VALUES
(1, 'Galaxy J6', 1, 'Samsung Galaxy J6 smartphone has a Super AMOLED display. It measures 149.3 mm x 70.2 mm x 8.2 mm and weighs 154 grams. The screen has a resolution of 720 x 1480 pixels and 294 ppi pixel density. It has an aspect ratio of 18.5:9 and screen-to-body ratio of 76.28 %. On camera front, the buyers get a 8 MP Front Camera and on the rear, there\'s an 13 MP camera with features like Digital Zoom, Auto Flash, Face detection, Touch to focus. It is backed by a 3000 mAh battery. Connectivity features in the smartphone include WiFi, Bluetooth, GPS,s', '2019-10-03', '12', '10,199', 13, 10, 'nothing'),
(8, 'IPhone X', 6, 'The iPhone X was intended to showcase what Apple considered the technology of the future. Using a glass and stainless-steel form factor and \"bezel-less\" design, shrinking the bezels, and not having a \"chin\", unlike many Android phones. It was the first iPhone to use an OLED screen. The home button was replaced with a new type of authentication called Face ID, which used sensors to scan the user\'s face to unlock the device. This face-recognition capability also enabled emojis to be animated following the user\'s expression (Animoji). With a bezel-less design, iPhone user interaction changed significantly, using gestures to navigate the operating system rather than the home button used in all previous iPhones. At the time of its November 2017 launch, its price tag of $999 USD also made it the most expensive iPhone ever, with even higher prices internationally due to additional local sales and import taxes.', '2018-06-06', '12', '80,000', 20, 15, 'try'),
(11, 'V30 Plus', 9, 'The LG V30 Plus features a large 6.0-inch display with a resolution of 1440 x 2880 pixels. It comes with a P-OLED type display technology protected by Corning Gorilla Glass v5. The smartphone is driven by two quad-core Kyro 280 processors - 2.45GHz   1.9GHz, assisted by 4GB RAM and Adreno 540 graphics card. The handset runs on Android v7.1.2 (Nougat) operating system. A fingerprint sensor has been embedded at the rear to unlock the device quickly.', '2019-10-21', '10', '90,000', 9, 10, 'try'),
(12, '7.1', 5, 'Nokia 7.1 smartphone has a IPS LCD display. It measures 149.7 mm x 71.1 mm x 7.9 mm and weighs 160 grams. The screen has a resolution of 1080 x 2244 pixels and 426 ppi pixel density. It has an aspect ratio of 19:9 and screen-to-body ratio of 80.65 %. On camera front, the buyers get a 8 MP Front Camera and on the rear, there\'s an 12 MP   5 MP camera with features like Digital Zoom, Auto Flash, Face detection, Touch to focus. It is backed by a 3060 mAh battery. Connectivity features in the smartphone include WiFi, Bluetooth, GPS, Volte, NFC and more.', '2019-10-01', '12', '80,000', 18, 12, 'try'),
(13, '123', 10, '123', '2019-10-22', '123', '123', 121, 123, 'try');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` bigint(225) NOT NULL,
  `cart_id` bigint(225) NOT NULL,
  `c_id` bigint(225) NOT NULL,
  `m_id` bigint(225) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `cart_id`, `c_id`, `m_id`, `date`) VALUES
(4, 51, 2, 1, '2019-10-09 16:27:17'),
(5, 52, 2, 1, '2019-10-09 16:41:59'),
(6, 47, 3, 1, '2019-10-11 18:55:43'),
(7, 53, 2, 1, '2019-10-15 23:37:36'),
(8, 54, 3, 1, '2019-10-17 12:16:07'),
(9, 55, 3, 11, '2019-10-17 12:16:07'),
(11, 54, 3, 1, '2019-10-17 12:16:22'),
(12, 55, 3, 11, '2019-10-17 12:16:22'),
(14, 56, 3, 1, '2019-10-17 12:19:58'),
(15, 57, 3, 1, '2019-10-17 12:20:47'),
(16, 58, 3, 12, '2019-10-17 12:21:35'),
(17, 59, 3, 13, '2019-10-17 12:21:35'),
(19, 58, 3, 12, '2019-10-17 12:22:33'),
(20, 59, 3, 13, '2019-10-17 12:22:33'),
(22, 58, 3, 12, '2019-10-17 12:22:43'),
(23, 59, 3, 13, '2019-10-17 12:22:43'),
(25, 58, 3, 12, '2019-10-17 12:22:51'),
(26, 59, 3, 13, '2019-10-17 12:22:51'),
(28, 58, 3, 12, '2019-10-17 12:24:39'),
(29, 59, 3, 13, '2019-10-17 12:24:39'),
(31, 58, 3, 12, '2019-10-17 12:25:16'),
(32, 59, 3, 13, '2019-10-17 12:25:16'),
(34, 58, 3, 12, '2019-10-17 12:25:25'),
(35, 59, 3, 13, '2019-10-17 12:25:25'),
(37, 58, 3, 12, '2019-10-17 12:27:37'),
(38, 59, 3, 13, '2019-10-17 12:27:37'),
(40, 62, 3, 11, '2019-10-17 12:28:25'),
(41, 63, 3, 12, '2019-10-17 12:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE `suggestion` (
  `sug_id` bigint(225) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suggestion` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suggestion`
--

INSERT INTO `suggestion` (`sug_id`, `email`, `subject`, `suggestion`) VALUES
(1, 'paras@gmail', 'check1', 'check2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `mobile_brands`
--
ALTER TABLE `mobile_brands`
  ADD PRIMARY KEY (`b_id`),
  ADD UNIQUE KEY `b_Name` (`b_Name`);

--
-- Indexes for table `mobile_data`
--
ALTER TABLE `mobile_data`
  ADD PRIMARY KEY (`m_id`),
  ADD UNIQUE KEY `mobile_name` (`mobile_name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`sug_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `c_id` bigint(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mobile_brands`
--
ALTER TABLE `mobile_brands`
  MODIFY `b_id` bigint(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mobile_data`
--
ALTER TABLE `mobile_data`
  MODIFY `m_id` bigint(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` bigint(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `sug_id` bigint(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
