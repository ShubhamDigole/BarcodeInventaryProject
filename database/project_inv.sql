-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2019 at 02:35 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `bid` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`bid`, `brand_name`, `status`) VALUES
(1, 'Imperial Blue', '1'),
(14, 'Royal Stag', '1'),
(20, 'Magic Moment', '1'),
(21, 'Mc Dowells', '1'),
(23, 'Carlsburg', '1'),
(24, 'Signature', '1'),
(25, 'Royal Challenge', '1'),
(26, 'VAT 69', '1'),
(27, 'Master Blend', '1'),
(28, 'Officers Choice', '1'),
(29, 'Old Monk', '1'),
(30, 'Bagpiper', '1'),
(31, 'Blenders Pride', '1'),
(32, 'Imperial Red', '1'),
(33, 'Directors Special', '1'),
(34, 'Goa Gin', '1'),
(35, 'White Mischef', '1'),
(36, 'Smirnoff', '1'),
(37, 'Antiquity', '1'),
(38, 'Heineken', '1'),
(39, 'Doctor', '1'),
(40, 'Black & White', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(11) NOT NULL,
  `parent_cat` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `parent_cat`, `category_name`, `status`) VALUES
(2, 0, 'Rum', '1'),
(7, 3, 'Wine', '1'),
(9, 4, 'Scotch', '1'),
(11, 0, 'whisky', '1'),
(12, 0, 'Beer', '1'),
(13, 0, 'Vodka', '1'),
(14, 0, 'Brandy', '1'),
(15, 0, 'abcd', '1');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_no` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `sub_total` double NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `paid` double NOT NULL,
  `sell_total` double NOT NULL,
  `payment_type` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `order_date`, `sub_total`, `discount`, `net_total`, `paid`, `sell_total`, `payment_type`) VALUES
(256, '2019-03-08', 930, 0, 930, 930, 720, 'Cash'),
(257, '2019-03-11', 330, 0, 330, 330, 260, 'Cash'),
(258, '2019-03-11', 150, 0, 150, 150, 120, 'Cash'),
(259, '2019-03-11', 150, 0, 150, 150, 120, 'Cash'),
(260, '2019-03-11', 150, 0, 150, 150, 120, 'Cash'),
(261, '2019-03-11', 150, 0, 150, 150, 120, 'Cash'),
(262, '2019-03-11', 300, 0, 300, 300, 240, 'Cash'),
(263, '2019-03-11', 180, 0, 180, 180, 140, 'Cash'),
(264, '2019-03-11', 30, 0, 30, 30, 20, 'Cash'),
(265, '2019-03-11', 30, 0, 30, 30, 20, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `sdate` date NOT NULL,
  `code` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_no`, `product_name`, `price`, `qty`, `sdate`, `code`) VALUES
(549, 256, 'test', 30, 6, '2019-03-08', 15),
(550, 256, 'bookvl', 150, 5, '2019-03-08', 58),
(551, 256, 'test2', 130, 0, '2019-03-08', 0),
(552, 256, '', 0, 0, '2019-03-08', 0),
(553, 257, 'test', 30, 1, '2019-03-11', 14),
(554, 257, 'bookvl', 150, 2, '2019-03-11', 56),
(555, 257, '', 0, 0, '2019-03-11', 0),
(556, 258, 'bookvl', 150, 1, '2019-03-11', 55),
(557, 258, '', 0, 0, '2019-03-11', 0),
(558, 259, 'bookvl', 150, 1, '2019-03-11', 54),
(559, 259, '', 0, 0, '2019-03-11', 0),
(560, 260, 'bookvl', 150, 1, '2019-03-11', 53),
(561, 260, '', 0, 0, '2019-03-11', 0),
(562, 261, 'bookvl', 150, 1, '2019-03-11', 52),
(563, 261, '', 0, 0, '2019-03-11', 0),
(564, 262, 'bookvl', 150, 2, '2019-03-11', 50),
(565, 263, 'test', 30, 1, '2019-03-11', 13),
(566, 263, 'bookvl', 150, 1, '2019-03-11', 49),
(567, 264, 'test', 30, 1, '2019-03-11', 12),
(568, 265, 'test', 30, 1, '2019-03-11', 11);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `code_id` varchar(25) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` double NOT NULL,
  `productsell` int(7) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `stock_shop` int(10) NOT NULL,
  `added_date` date NOT NULL,
  `p_status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `cid`, `bid`, `code_id`, `product_name`, `product_price`, `productsell`, `product_stock`, `stock_shop`, `added_date`, `p_status`) VALUES
(37, 2, 1, '1233567890123', 'test', 20, 30, 176, 11, '2019-03-01', '1'),
(38, 7, 14, '12345678', 'test2', 20, 130, 40, 0, '2019-03-01', '1'),
(39, 2, 14, '55665', 'sdsad', 50, 100, 10, 10, '2019-03-03', '1'),
(40, 2, 14, '12345674', 'sada', 12, 23, 150, 50, '2019-03-05', '1'),
(41, 2, 32, '9788184929683', 'bookvl', 120, 150, 110, 49, '2019-03-05', '1');

-- --------------------------------------------------------

--
-- Table structure for table `stock_record`
--

CREATE TABLE `stock_record` (
  `id` int(10) NOT NULL,
  `pid` int(13) NOT NULL,
  `added_date` date NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `stock` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_record`
--

INSERT INTO `stock_record` (`id`, `pid`, `added_date`, `product_name`, `stock`) VALUES
(1, 37, '2019-03-02', 'test', 100),
(2, 37, '2019-03-03', 'test', 50),
(3, 41, '2019-03-04', 'bookvl', 100),
(4, 40, '2019-03-06', 'sada', 100);

-- --------------------------------------------------------

--
-- Table structure for table `stock_report`
--

CREATE TABLE `stock_report` (
  `id` int(12) NOT NULL,
  `pid` int(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_stock` int(5) NOT NULL,
  `stock_shop` int(5) NOT NULL,
  `t_date` date NOT NULL,
  `yproduct_stock` int(5) NOT NULL,
  `ystock_shop` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_report`
--

INSERT INTO `stock_report` (`id`, `pid`, `product_name`, `product_stock`, `stock_shop`, `t_date`, `yproduct_stock`, `ystock_shop`) VALUES
(57, 41, 'bookvl', 110, 58, '2019-03-08', 0, 0),
(58, 40, 'sada', 150, 50, '2019-03-08', 0, 0),
(59, 39, 'sdsad', 10, 10, '2019-03-08', 0, 0),
(60, 37, 'test', 176, 15, '2019-03-08', 0, 0),
(61, 38, 'test2', 40, 0, '2019-03-08', 0, 0),
(97, 37, 'test', 176, 15, '2019-03-09', 0, 0),
(98, 38, 'test2', 40, 0, '2019-03-09', 0, 0),
(99, 39, 'sdsad', 10, 10, '2019-03-09', 0, 0),
(100, 40, 'sada', 150, 50, '2019-03-09', 0, 0),
(101, 41, 'bookvl', 110, 58, '2019-03-09', 0, 0),
(107, 37, 'test', 176, 15, '2019-03-10', 0, 0),
(108, 38, 'test2', 40, 0, '2019-03-10', 0, 0),
(109, 39, 'sdsad', 10, 10, '2019-03-10', 0, 0),
(110, 40, 'sada', 150, 50, '2019-03-10', 0, 0),
(111, 41, 'bookvl', 110, 58, '2019-03-10', 0, 0),
(122, 37, 'test', 176, 14, '2019-03-11', 0, 0),
(123, 38, 'test2', 40, 0, '2019-03-11', 40, 0),
(124, 39, 'sdsad', 10, 10, '2019-03-11', 10, 10),
(125, 40, 'sada', 150, 50, '2019-03-11', 150, 50),
(126, 41, 'bookvl', 110, 56, '2019-03-11', 110, 58);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `usertype` enum('Admin','Other') NOT NULL,
  `register_date` date NOT NULL,
  `last_login` datetime NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES
(8, 'Shubham', 'shubham@gmail.com', '$2y$08$1xnfcVTVLIuTBbgMI69WZOC7.x.fK7w.OwfmXJUrfVb9PGO55xgjW', 'Admin', '2019-02-06', '2019-03-11 09:03:18', ''),
(9, 'krish', 'shubhamdigole@gmail.com', '$2y$08$E/g.Jmbx6Y6rCzu6sNHLDejrjpvMw9l6ocIHQP6XnPz6nFHuA1dmG', 'Other', '2019-02-10', '2019-02-16 06:02:41', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `brand_name` (`brand_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_no`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD UNIQUE KEY `code_id` (`code_id`),
  ADD KEY `cid` (`cid`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `stock_record`
--
ALTER TABLE `stock_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `stock_report`
--
ALTER TABLE `stock_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=569;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `stock_record`
--
ALTER TABLE `stock_record`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_report`
--
ALTER TABLE `stock_report`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_ibfk_1` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `categories` (`cid`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `brands` (`bid`);

--
-- Constraints for table `stock_record`
--
ALTER TABLE `stock_record`
  ADD CONSTRAINT `stock_record_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
