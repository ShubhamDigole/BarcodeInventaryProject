-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2019 at 12:19 PM
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
(14, 0, 'Brandy', '1');

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
(4, '2019-02-25', 70, 0, 70, 70, 60, 'Cash'),
(5, '2019-02-25', 70, 0, 70, 70, 60, 'Cash'),
(6, '2019-02-25', 20, 0, 20, 20, 15, 'Cash'),
(7, '2019-02-25', 20, 0, 20, 20, 15, 'Cash'),
(8, '2019-02-26', 423, 0, 423, 423, 387, 'Cash'),
(9, '2019-02-26', 235, 0, 235, 235, 215, 'Cash'),
(10, '2019-02-26', 140, 0, 140, 140, 120, 'Cash'),
(11, '2019-02-26', 70, 0, 70, 70, 60, 'Cash'),
(12, '2019-02-26', 0, 0, 0, 0, 60, 'Card'),
(13, '2019-02-26', 0, 0, 0, 0, 0, 'Card'),
(14, '2019-02-26', 94, 0, 94, 94, 86, 'Cash'),
(15, '2019-02-26', 141, 0, 141, 141, 129, 'Cash'),
(16, '2019-02-26', 94, 0, 94, 94, 86, 'Cash'),
(17, '2019-02-26', 500, 0, 500, 500, 400, 'Cash'),
(18, '2019-02-26', 4500, 0, 4500, 4500, 3600, 'Cash'),
(19, '2019-02-26', 500, 0, 500, 500, 400, 'Cash'),
(20, '2019-02-26', 0, 0, 0, 0, 0, 'Cash'),
(21, '2019-02-26', 500, 0, 500, 500, 400, 'Cash'),
(22, '2019-02-26', 2000, 0, 2000, 2000, 1600, 'Cash');

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
(1, 21, 'computer keyboard', 500, 1, '2019-02-26', 96),
(2, 22, 'computer keyboard', 500, 1, '2019-02-26', 95),
(3, 22, 'computer keyboard', 500, 1, '2019-02-26', 95),
(4, 22, 'computer keyboard', 500, 1, '2019-02-26', 95),
(5, 22, 'computer keyboard', 500, 1, '2019-02-26', 95);

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
(23, 2, 21, '123456', 'Mc Dowells 90 ml ', 90, 100, 301, 202, '2019-02-25', '1'),
(24, 11, 21, '234567', 'Mc Dowells 180 ml ', 180, 190, 164, 30, '2019-02-20', '1'),
(25, 7, 14, '8906060989205', 'book', 90, 110, 178, 20, '2019-02-26', '1'),
(26, 7, 14, '8901030697265', 'Rin BAr', 15, 20, 97, 0, '2019-02-24', '1'),
(27, 2, 14, '8901023003622', 'cinthol', 30, 35, 98, 0, '2019-02-24', '1'),
(28, 7, 14, '8904058700375', 'laxman rekha', 12, 15, 99, 0, '2019-02-24', '1'),
(29, 2, 14, '8901030670183', 'vim bar ', 43, 47, 995, 110, '2019-02-24', '1'),
(30, 2, 14, '8901468110015', 'pitambari', 40, 42, 100, 0, '2019-02-24', '1'),
(31, 7, 14, '8901810558731', 'abhiyan agarbatti', 60, 70, 0, 0, '2019-02-24', '1'),
(32, 2, 1, '9789385966378', 'neet guide', 100, 110, 100, 0, '2019-02-24', '1'),
(33, 2, 20, '4895199503700', 'computer keyboard', 400, 500, 95, 0, '2019-02-26', '1');

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
(1, 23, '0000-00-00', 'Mc Dowells 90 ml ', 100),
(2, 29, '0000-00-00', 'vim bar ', 110),
(3, 23, '0000-00-00', 'Mc Dowells 90 ml ', 100),
(4, 25, '0000-00-00', 'book', 100),
(5, 24, '0000-00-00', 'Mc Dowells 180 ml ', 100),
(6, 23, '2019-02-26', 'Mc Dowells 90 ml ', 100);

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
(8, 'Shubham', 'shubham@gmail.com', '$2y$08$1xnfcVTVLIuTBbgMI69WZOC7.x.fK7w.OwfmXJUrfVb9PGO55xgjW', 'Admin', '2019-02-06', '2019-02-26 12:02:26', ''),
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
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `stock_record`
--
ALTER TABLE `stock_record`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
