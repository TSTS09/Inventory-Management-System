-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 09:41 AM
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
-- Table structure for table `inventorymanagement`
--

CREATE TABLE `inventorymanagement` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `SKU` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `quantity_in_stock` int(11) DEFAULT NULL,
  `location_in_shop` varchar(255) DEFAULT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `barcode_number` varchar(255) DEFAULT NULL,
  `actions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventorytracking`
--

CREATE TABLE `inventorytracking` (
  `product_name` varchar(255) NOT NULL,
  `supplier_contact` varchar(255) NOT NULL,
  `date_last_restock` date NOT NULL,
  `next_supply_date` date NOT NULL,
  `countdown_till_next_supply` int(11) NOT NULL,
  `actions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` text DEFAULT NULL,
  `SKU` text DEFAULT NULL,
  `Category` text DEFAULT NULL,
  `QuantityInStock` int(11) DEFAULT NULL,
  `LocationInShop` text DEFAULT NULL,
  `ProductDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `ReportID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `AmountLeft` int(11) DEFAULT NULL,
  `Category` text DEFAULT NULL,
  `Location` text DEFAULT NULL,
  `LastSupplied` date DEFAULT NULL
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
  `roleid` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `roleid`, `first_name`, `last_name`, `company_name`, `phone_number`, `email`, `passwd`) VALUES
(2, 1, 'Tiffany', 'Degbotse', 'Chateau', '+233542618106', 'tiffanydegbotse123@gmail.com', '$2y$10$mKC0Q8UBsfpL9tVbhX9jLu.Kwe07yL/jQ/3rNfF/uct.3ZBJ0Gafy'),
(4, 2, 'Clifford', 'Nkansah', 'Ashesi', '0558579224', 'clifford@gmail.com', '$2y$10$vzCYEXOf3DpdaFsZ9jtU/uyhGrRXwpSzf1M8153C84rCE3nd9NmRq'),
(5, 1, 'Thierry', 'Johan', 'Ashesi', '0244789546', 'thierry@gmail.com', '$2y$10$2GMrQSiGxfeuXzYW1k9hnukPyG44AQidtrqJE6Nn8eFhpHQ7b/JMe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `inventorymanagement`
--
ALTER TABLE `inventorymanagement`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

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
-- AUTO_INCREMENT for table `inventorymanagement`
--
ALTER TABLE `inventorymanagement`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `roles` (`roleid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
