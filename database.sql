-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2021 at 06:17 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressId` int(10) NOT NULL,
  `customerId` int(10) NOT NULL,
  `homeName` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `landmark` varchar(50) NOT NULL,
  `code` int(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `customerId`, `homeName`, `street`, `landmark`, `code`, `city`, `state`) VALUES
(254, 154, 'I-345', 'resham bhavan L.H.Road surat', 'bus station', 395006, 'Varachha Road', 'Gujarat'),
(255, 154, 'I-345', 'resham bhavan L.H.Road surat', 'bus station', 395006, 'Varachha Road', 'Gujarat'),
(256, 155, 'I-345', 'resham bhavan L.H.Road surat', 'bus station', 395006, 'Varachha Road', 'Gujarat'),
(257, 155, 'I-345', 'resham bhavan L.H.Road surat', 'bus station', 395006, 'Varachha Road', 'Gujarat'),
(280, 166, 'hrkol', 'resham bhavan L.H.Road surat', 'bus station', 395006, 'Varachha Road', 'Gujarat'),
(281, 166, 'I-345', 'resham bhavan L.H.Road surat', 'bus station', 395006, 'Varachha Road', 'Gujarat'),
(282, 167, 'I-345', 'resham bhavan L.H.Road surat', 'bus station', 395006, 'Varachha Road', 'Gujarat'),
(283, 167, 'I-345', 'resham bhavan L.H.Road surat', 'bus station', 395006, 'Varachha Road', 'Gujarat'),
(320, 178, 'I-345', 'resham bhavan L.H.Road surat', 'bus station', 395006, 'Varachha Road', 'Gujarat'),
(321, 178, 'om puri', 'resham bhavan L.H.Road surat', 'bus station', 395006, 'surat', 'Gujarat');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(30) NOT NULL,
  `parentId` int(30) DEFAULT NULL,
  `pathIds` varchar(30) DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `descriprtion` varchar(255) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`, `parentId`, `pathIds`, `status`, `descriprtion`, `createdDate`) VALUES
(1, 'Home', 0, '1', 'Enabled', '', '2021-06-17 12:39:39'),
(2, 'BedRoom', 1, '1/2', 'Enabled', '', '2021-06-17 12:39:41'),
(4, 'Panel', 1, '1/4', 'Enabled', '', '2021-06-17 12:39:43'),
(5, 'Hall', 9, '1/2/9/5', 'Enabled', '', '2021-06-17 12:39:45'),
(9, 'TV', 2, '1/2/9', 'Disabled', '', '2021-06-17 12:40:08'),
(193, 'panel', 4, '1/4/193', 'Disabled', '', '2021-06-17 12:40:15'),
(350, 'table', 9, '1/2/9/350', 'Disabled', '', '2021-06-17 12:40:16'),
(367, 'bed', 2, '1/2/367', 'Enabled', '', '2021-06-17 12:37:54'),
(418, 'light', 0, '418', 'Enabled', '', '2021-07-05 04:12:31'),
(419, 'home', 418, '418/419', 'Enabled', '', '2021-07-05 04:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(10) NOT NULL,
  `shippingAddressId` int(11) DEFAULT NULL,
  `billingAddressId` int(11) DEFAULT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` int(10) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `shippingAddressId`, `billingAddressId`, `firstName`, `lastName`, `email`, `contact`, `dateOfBirth`, `gender`, `createdDate`, `updatedDate`) VALUES
(154, 254, 254, 'khushi', 'Dolariya', 'abc@gmail.com', 2147483647, '2021-07-04', 'female', '2021-06-17 07:49:33', '2021-06-17 07:50:43'),
(155, 256, 256, 'virali', 'Dolariya', 'abc@gmail.com', 2147483647, '2021-06-24', 'female', '2021-06-17 07:52:30', '2021-06-17 07:53:23'),
(166, 281, 280, 'khushi', 'Dolariya', 'abc@gmail.com', 2147483647, '2021-07-05', 'female', '2021-06-17 09:49:43', '2021-06-17 06:20:00'),
(167, 283, 282, 'Pavan', 'Dolariya', 'abc@gmail.com', 2147483647, '2021-06-29', 'female', '2021-06-28 03:38:32', '2021-06-28 06:06:44'),
(178, 321, 320, 'raju fca', 'panwala', 'abc@gmail.com', 2147483647, '2021-06-23', 'male', '2021-06-28 08:25:07', '2021-06-28 08:25:25'),
(189, NULL, NULL, 'Pavan cjshcjhcszm czsczzxzx', 'Dolariya', 'abc@gmail.com', 2147483647, '2021-07-01', 'male', '2021-07-02 05:54:27', NULL),
(190, NULL, NULL, 'Pavan cjshcjhcszm czsczzxzx', 'Dolariya', 'abc@gmail.com', 2147483647, '2021-07-01', 'male', '2021-07-02 05:54:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `methodId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `transactionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`methodId`, `name`, `description`, `status`, `createdDate`, `transactionId`) VALUES
(6, 'Credit ', 'credit card Payment', 'Enabled', '2021-06-11 12:52:26', 25617),
(7, 'Google Pay', 'Google Pay  payment', 'Disable', '2021-06-11 13:40:23', 135489),
(8, 'Credit card', 'very good product', 'Enabled', '2021-06-17 10:15:41', 215115241),
(9, 'Debit card', 'Debit card is easy way to payment', 'Enabled', '2021-06-17 10:18:08', 841351);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `pkd` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `expiryDate` date NOT NULL,
  `base` tinyint(30) DEFAULT NULL,
  `thumb` tinyint(30) DEFAULT NULL,
  `small` tinyint(30) DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `name`, `manufacturer`, `pkd`, `quantity`, `status`, `description`, `expiryDate`, `base`, `thumb`, `small`, `createdDate`, `updatedDate`) VALUES
(1, 'moong', 'ddfd', '2021-06-12', 2, 'Disabled', 'This is good for health ', '2021-07-06', 91, 90, 87, '2021-06-03 07:53:42', '2021-07-02 04:14:38'),
(42, 'Wheati', 'Asirvad', '2021-07-08', 10, 'Enabled', 'very good ', '2021-06-22', NULL, NULL, NULL, '2021-06-24 04:47:25', '2021-07-01 14:19:56'),
(53, 'Wheat', 'tata', '2021-06-05', 10, 'Enabled', 'good product', '2021-06-20', NULL, NULL, NULL, '2021-06-29 02:51:51', '2021-07-01 06:15:50'),
(54, 'Udad', 'tata', '2021-06-03', 2, 'Enabled', 'very good product', '2021-06-07', NULL, NULL, NULL, '2021-06-29 02:57:03', '2021-06-30 11:33:11'),
(56, 'Udad', 'tata', '2021-06-03', 2, 'Enabled', 'very good product', '2021-06-07', NULL, NULL, NULL, '2021-06-29 02:58:01', '2021-06-30 11:32:45'),
(58, 'Wheat', 'Asirvad', '2021-06-27', 10, 'Enabled', 'good', '2021-07-10', NULL, NULL, NULL, '2021-07-01 09:16:34', NULL),
(59, 'moth', 'ramdas pvt', '2021-07-11', 2, 'Disabled', 'good ', '2021-07-24', 98, 97, 96, '2021-07-02 04:17:56', '2021-07-02 07:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `productmedia`
--

CREATE TABLE `productmedia` (
  `mediaId` tinyint(10) NOT NULL,
  `productId` int(10) NOT NULL,
  `label` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `active` varchar(10) NOT NULL,
  `isGallery` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productmedia`
--

INSERT INTO `productmedia` (`mediaId`, `productId`, `label`, `image`, `active`, `isGallery`) VALUES
(87, 1, '1445404320-9211.jpg', 'media/catalog/product/1445404320-9211.jpg', '', '0'),
(90, 1, 'download.jpg', 'media/catalog/product/1445404320-9211.jpg', '', '0'),
(91, 1, '1445404320-9211.jpg', 'media/catalog/product/1445404320-9211.jpg', '', '0'),
(96, 59, '1445404320-9211.jpg', 'media/catalog/product/1445404320-9211.jpg', '', '0'),
(97, 59, '2112649307_d85684f1b1_b.jpg', 'media/catalog/product/1445404320-9211.jpg', '', '0'),
(98, 59, 'download5.jpg', 'media/catalog/product/1445404320-9211.jpg', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `methodId` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(10) NOT NULL,
  `discount` int(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`methodId`, `name`, `price`, `discount`, `status`, `createdDate`) VALUES
(1, 'Home delivery', 530, 20, 'Disabled', '2021-06-11 05:32:56'),
(2, 'office delivery', 1250, 50, 'Disabled', '2021-06-11 05:36:33'),
(7, 'Home delivery', 1285, 60, 'Disabled', '2021-06-11 05:59:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `address_to_customer` (`customerId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `productmedia`
--
ALTER TABLE `productmedia`
  ADD PRIMARY KEY (`mediaId`),
  ADD KEY `productId_to_productId` (`productId`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`methodId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `productmedia`
--
ALTER TABLE `productmedia`
  MODIFY `mediaId` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `methodId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_to_customer` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`);

--
-- Constraints for table `productmedia`
--
ALTER TABLE `productmedia`
  ADD CONSTRAINT `productId_to_productId` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
