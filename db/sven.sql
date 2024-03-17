-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2024 at 12:34 PM
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
-- Database: `sven`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryid` int(11) NOT NULL,
  `categoryname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryid`, `categoryname`) VALUES
(1, 'Antibiotics'),
(2, 'Pain Relievers'),
(3, 'Vitamins and Supplements'),
(4, 'Antipyretics'),
(5, 'Antiseptics'),
(6, 'Antifungals'),
(7, 'Anti-Inflammatory Drugs'),
(8, 'Antiemetics'),
(9, 'Antivirals'),
(10, 'Decongestants'),
(11, 'Laxatives'),
(12, 'Cough and Cold Medications'),
(13, 'Antihistamines'),
(14, 'Cardiovascular Medications'),
(15, 'Hormones'),
(16, 'Muscle Relaxants'),
(17, 'Analgesics'),
(18, 'Respiratory Medications'),
(19, 'Gastrointestinal Medications'),
(20, 'Dermatologicals');

-- --------------------------------------------------------

--
-- Table structure for table `inventorytracking`
--

CREATE TABLE `inventorytracking` (
  `product_id` int(11) NOT NULL,
  `supplier_contact` varchar(255) NOT NULL,
  `date_last_restock` date NOT NULL,
  `next_supply_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `SKU` varchar(255) NOT NULL,
  `Category` int(11) NOT NULL,
  `QuantityInStock` int(11) NOT NULL,
  `LocationInShop` varchar(255) NOT NULL,
  `ProductDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `SKU`, `Category`, `QuantityInStock`, `LocationInShop`, `ProductDescription`) VALUES
(2, 'Vitamin C', '678', 1, 7, 'Aisle 7', 'headache'),
(6, 'Imelda Murray', 'In in placeat conse', 1, 645, 'Pariatur Lorem quis', 'Maiores et porro exc'),
(7, 'Vitamin W', '675', 2, 8, 'Aisle 8', 'malaria'),
(25, 'Vitamin W', '876', 1, 9, 'aisle 10', ''),
(26, 'Vitamin W', '890', 1, 8, '2', 'yeah');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `ReportID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `AmountLeft` int(11) NOT NULL,
  `LastSupplied` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleid` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleid`, `role_name`) VALUES
(1, 'Pharmacist'),
(2, 'Inventory Manager'),
(3, 'Assistant Manager'),
(4, 'Pharmacy Operations Coordinator'),
(5, 'Pharmacy IT Specialist');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `roleid`, `first_name`, `last_name`, `company_name`, `phone_number`, `email`, `password`) VALUES
(3, 1, 'Tiffany', 'Degbotse', 'Ashesi', '0546728654', 'tiffanydegbotse123@gmail.com', '$2y$10$xMB8.e2IRyZWB9FktgWYrefKpFlP3dVLdHuFRzjwnLPtW3lzocCdC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `inventorytracking`
--
ALTER TABLE `inventorytracking`
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `category` (`Category`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `roleid` (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventorytracking`
--
ALTER TABLE `inventorytracking`
  ADD CONSTRAINT `inventorytracking_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`PRODUCTID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`categoryid`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`PRODUCTID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `roles` (`roleid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
