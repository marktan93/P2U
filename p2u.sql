-- phpMyAdmin SQL Dump
-- version 4.0.10.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2015 at 08:20 PM
-- Server version: 5.5.40-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shocksco_p2u`
--

-- --------------------------------------------------------

--
-- Table structure for table `card_rules`
--

CREATE TABLE IF NOT EXISTS `card_rules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `purchase_amount` double NOT NULL COMMENT 'every purchase ',
  `points_rewarded` int(11) NOT NULL,
  `start_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `due_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `card_rules`
--

INSERT INTO `card_rules` (`id`, `user_id`, `purchase_amount`, `points_rewarded`, `start_date`, `due_date`, `last_update`) VALUES
(5, 10, 100, 10, '2015-02-15 16:00:00', '2015-02-27 16:00:00', '2015-02-15 23:53:44'),
(6, 11, 100, 5, '2015-02-23 16:00:00', '2015-02-27 16:00:00', '2015-02-24 07:43:26'),
(7, 11, 50, 5, '2015-02-28 16:00:00', '2015-03-30 16:00:00', '2015-02-24 07:43:41'),
(9, 2, 5, 1, '2015-02-28 16:00:00', '2015-03-30 16:00:00', '2015-03-01 16:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `age` varchar(3) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `password`, `gender`, `fullname`, `age`, `contact`, `address`, `last_update`) VALUES
(1, 'jasonsozai', '12345', 'female', 'sozaisozais', '40', '1231212312', 'chow kit gay loyu', '2015-02-13 19:46:49'),
(2, 'jasonlcly', '7287dbc9c3e99b098f3c4e0b27c5d7c61e03a9c5', 'male', 'Tan Leong Choon ', '20', '0166348552', 'Wangsa Metroview', '2015-02-13 22:46:23'),
(3, 'csmtcy', 'dec7dd342a499dfd4d283d872ccf598d8a7b6039', 'male', 'mtcy', '22', '0718496434', 'wangsa maju metroview', '2015-02-15 20:33:00'),
(4, 'aaaaaa', '8cb2237d0679ca88db6464eac60da96345513964', 'male', 'hahahhaha', '12', '4444444', 'Rafsanjani', '2015-02-15 23:06:06'),
(5, 'mark1993', '7287dbc9c3e99b098f3c4e0b27c5d7c61e03a9c5', 'male', 'Tan Ching Yong ', '21', '01245376451', 'Wangsa Metroview', '2015-02-15 23:39:53'),
(6, 'jasontan', '7287dbc9c3e99b098f3c4e0b27c5d7c61e03a9c5', 'male', 'ajajaja', '21', '0164578451', 'katakana', '2015-02-16 00:42:07'),
(7, 'leongchoon', '7287dbc9c3e99b098f3c4e0b27c5d7c61e03a9c5', 'male', 'Ching yongg ', '20', '0166348552', 'chow kit ', '2015-02-24 08:16:10'),
(8, 'killertan', '7287dbc9c3e99b098f3c4e0b27c5d7c61e03a9c5', 'male', 'Tan Kok Heng', '21', '0166348552', 'Jalan Ipoh', '2015-06-15 12:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user_id` int(10) unsigned NOT NULL,
  `to_user_id` int(10) unsigned NOT NULL,
  `admin_notify` tinyint(1) NOT NULL DEFAULT '0',
  `merchant_notify` tinyint(1) NOT NULL DEFAULT '0',
  `content` varchar(255) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `from_user_id` (`from_user_id`,`to_user_id`),
  KEY `to_user_id` (`to_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user_id`, `to_user_id`, `admin_notify`, `merchant_notify`, `content`, `last_update`) VALUES
(1, 2, 2, 1, 1, 'hi admin', '2015-02-13 19:58:57'),
(2, 1, 2, 1, 1, 'wat ?', '2015-02-13 19:59:08'),
(3, 2, 2, 1, 1, 'shit', '2015-02-13 19:59:13'),
(4, 11, 11, 1, 1, 'hi', '2015-02-24 07:50:59'),
(5, 1, 11, 1, 1, 'hi', '2015-02-24 07:51:09'),
(6, 1, 11, 1, 1, 'hello', '2015-02-24 07:51:18'),
(7, 1, 11, 1, 1, 'jason', '2015-02-24 07:51:23'),
(8, 1, 2, 1, 1, 'zzz', '2015-03-04 19:35:04'),
(9, 1, 7, 1, 0, 'adfsf', '2015-03-04 19:35:08'),
(10, 1, 2, 1, 1, 'hihi', '2015-06-22 06:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` enum('packaging','ready','delivered') NOT NULL DEFAULT 'packaging',
  `receive_mode` enum('delivery','onpick') NOT NULL,
  `tracking_code` varchar(50) NOT NULL,
  `courier_service` enum('poslaju','skynet','gdex','') NOT NULL DEFAULT '',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `user_id`, `status`, `receive_mode`, `tracking_code`, `courier_service`, `last_update`) VALUES
(1, 1, 2, 'ready', 'onpick', 'AJSHDJKASD12312', 'poslaju', '2015-02-13 19:51:28'),
(3, 2, 2, 'delivered', 'delivery', 'ASDDA12313', 'poslaju', '2015-02-24 08:03:02'),
(12, 7, 2, 'packaging', 'onpick', '', '', '2015-02-24 08:25:21'),
(13, 7, 11, 'packaging', 'onpick', '', '', '2015-02-24 08:28:03'),
(14, 7, 2, 'packaging', 'onpick', '', '', '2015-02-24 08:28:03'),
(15, 2, 11, 'packaging', 'onpick', '', '', '2015-02-24 10:54:53'),
(16, 8, 2, 'packaging', 'onpick', '', '', '2015-06-15 12:32:00'),
(17, 8, 2, 'packaging', 'onpick', '', '', '2015-06-15 12:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `points` int(10) unsigned NOT NULL,
  `redeem_status` tinyint(1) NOT NULL DEFAULT '0',
  `due_date` timestamp NULL DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `subscription_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `user_id`, `points`, `redeem_status`, `due_date`, `last_update`) VALUES
(1, 2, 10, 0, '2015-03-24 08:07:19', '2015-02-24 08:07:19'),
(2, 2, 10, 1, '2015-02-28 08:07:53', '2015-02-24 08:07:53'),
(3, 2, 11, 0, '2015-04-01 16:23:42', '2015-03-01 16:23:42'),
(4, 2, 1, 0, '2015-04-02 09:26:27', '2015-03-02 09:26:27'),
(5, 2, 1, 0, '2015-04-02 09:26:55', '2015-03-02 09:26:55'),
(6, 2, 1, 0, '2015-04-02 09:30:12', '2015-03-02 09:30:12'),
(7, 2, 1, 0, '2015-04-02 09:38:48', '2015-03-02 09:38:48'),
(8, 2, 1, 0, '2015-04-02 09:39:22', '2015-03-02 09:39:22'),
(9, 2, 1, 0, '2015-04-02 09:39:50', '2015-03-02 09:39:50'),
(10, 2, 1, 0, '2015-04-02 09:41:25', '2015-03-02 09:41:25'),
(11, 2, 8, 0, '2015-04-02 13:44:01', '2015-03-02 13:44:01'),
(12, 2, 11, 0, '2015-04-02 15:10:27', '2015-03-02 15:10:27'),
(13, 2, 11, 0, '2015-04-02 15:10:27', '2015-03-02 15:10:27'),
(14, 2, 11, 0, '2015-04-02 15:10:46', '2015-03-02 15:10:46'),
(15, 2, 7, 0, '2015-04-02 15:18:44', '2015-03-02 15:18:44'),
(16, 2, 1, 0, '2015-04-02 15:31:29', '2015-03-02 15:31:29'),
(17, 2, 1, 0, '2015-04-02 16:44:26', '2015-03-02 16:44:26'),
(18, 2, 2, 0, '2015-04-02 17:22:03', '2015-03-02 17:22:03'),
(19, 2, 2, 0, '2015-04-02 17:32:32', '2015-03-02 17:32:32'),
(20, 2, 1, 0, '2015-04-02 18:41:51', '2015-03-02 18:41:51'),
(21, 2, 1, 0, '2015-04-02 19:45:53', '2015-03-02 19:45:53'),
(22, 2, 6, 0, '2015-04-02 19:50:48', '2015-03-02 19:50:48'),
(23, 2, 3, 0, '2015-04-02 19:54:01', '2015-03-02 19:54:01'),
(24, 2, 2, 0, '2015-04-02 20:00:52', '2015-03-02 20:00:52'),
(25, 2, 3, 0, '2015-04-02 20:05:37', '2015-03-02 20:05:37'),
(26, 2, 2, 0, '2015-04-02 20:06:45', '2015-03-02 20:06:45'),
(27, 2, 2, 0, '2015-04-02 20:08:18', '2015-03-02 20:08:18'),
(28, 2, 2, 0, '2015-04-02 20:10:27', '2015-03-02 20:10:27'),
(29, 2, 3, 0, '2015-04-02 20:13:18', '2015-03-02 20:13:18'),
(30, 2, 1, 0, '2015-04-02 20:15:00', '2015-03-02 20:15:00'),
(31, 2, 2, 0, '2015-04-02 20:16:37', '2015-03-02 20:16:37'),
(32, 2, 5, 0, '2015-04-02 20:19:58', '2015-03-02 20:19:58'),
(33, 2, 1, 0, '2015-04-02 20:41:48', '2015-03-02 20:41:48'),
(34, 2, 4, 0, '2015-04-02 20:43:51', '2015-03-02 20:43:51'),
(35, 2, 6, 0, '2015-04-02 20:44:58', '2015-03-02 20:44:58'),
(36, 2, 1, 0, '2015-04-02 20:48:15', '2015-03-02 20:48:15'),
(37, 2, 1, 0, '2015-04-02 20:50:35', '2015-03-02 20:50:35'),
(38, 2, 1, 0, '2015-04-03 01:23:58', '2015-03-03 01:23:58'),
(39, 2, 1, 0, '2015-04-03 01:30:28', '2015-03-03 01:30:28'),
(40, 2, 1, 0, '2015-04-03 01:32:27', '2015-03-03 01:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `cost_points` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `receive_mode` enum('delivery','onpick') NOT NULL,
  `activation` tinyint(1) NOT NULL DEFAULT '1',
  `start_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `due_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `product_name`, `image`, `cost_points`, `balance`, `receive_mode`, `activation`, `start_date`, `due_date`, `last_update`) VALUES
(1, 2, 'Recycled Light Bulb Oil Lamp', '54dcea8c90a22.jpg', 100, 29, 'onpick', 1, '2015-02-12 16:00:00', '2015-10-21 16:00:00', '2015-02-12 18:01:48'),
(6, 7, 'Door Anywhere', '54e12b7ec545a.png', 10, 10, 'onpick', 1, '2015-02-15 16:00:00', '2015-02-27 16:00:00', '2015-02-15 23:27:58'),
(7, 7, 'Memory Bread', '54e12b917195c.jpg', 20, 30, 'onpick', 1, '2015-02-15 16:00:00', '2015-02-27 16:00:00', '2015-02-15 23:28:17'),
(8, 8, 'Cute Choco', '54e12cabd02ae.png', 30, 100, 'onpick', 1, '2015-02-17 16:00:00', '2015-02-27 16:00:00', '2015-02-15 23:32:59'),
(9, 8, 'Dark Chocolate', '54e12cbed3868.jpg', 50, 10, 'delivery', 1, '2015-02-15 16:00:00', '2015-02-20 16:00:00', '2015-02-15 23:33:18'),
(10, 9, 'Men Connection', '54e12d9f413ef.jpg', 100, 5, 'delivery', 1, '2015-02-14 16:00:00', '2015-02-27 16:00:00', '2015-02-15 23:37:03'),
(11, 10, 'Young ginger', '54e131719a8ec.jpg', 20, 30, 'delivery', 1, '2015-02-15 16:00:00', '2015-02-27 16:00:00', '2015-02-15 23:53:21'),
(12, 11, 'Watch', '54ec2c7eedb72.jpg', 50, 8, 'onpick', 1, '2015-02-23 16:00:00', '2015-02-27 16:00:00', '2015-02-24 07:47:11'),
(13, 11, 'Box', '54ec2cd83ab19.jpg', 100, 5, 'delivery', 1, '2015-02-23 16:00:00', '2015-02-27 16:00:00', '2015-02-24 07:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_lines`
--

CREATE TABLE IF NOT EXISTS `product_lines` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) unsigned NOT NULL,
  `product_vendor_id` int(11) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`order_id`),
  KEY `product_id` (`product_vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `product_lines`
--

INSERT INTO `product_lines` (`id`, `order_id`, `product_vendor_id`, `quantity`, `last_update`) VALUES
(1, 1, 2, 1, '2015-02-13 19:48:09'),
(3, 3, 1, 1, '2015-02-13 22:52:33'),
(13, 12, 2, 2, '2015-02-24 08:25:21'),
(14, 13, 1, 1, '2015-02-24 08:28:03'),
(15, 14, 2, 1, '2015-02-24 08:28:03'),
(16, 15, 21, 1, '2015-02-24 10:54:53'),
(17, 16, 1, 1, '2015-06-15 12:32:00'),
(18, 17, 1, 2, '2015-06-15 12:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_vendor`
--

CREATE TABLE IF NOT EXISTS `product_vendor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `vendor_id` int(10) unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`,`vendor_id`),
  KEY `vendor_id` (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `product_vendor`
--

INSERT INTO `product_vendor` (`id`, `product_id`, `vendor_id`, `last_update`) VALUES
(1, 1, 1, '2015-02-12 18:01:48'),
(2, 1, 2, '2015-02-12 18:01:48'),
(12, 6, 10, '2015-02-15 23:27:58'),
(13, 7, 10, '2015-02-15 23:28:17'),
(14, 8, 11, '2015-02-15 23:32:59'),
(15, 9, 12, '2015-02-15 23:33:18'),
(16, 10, 13, '2015-02-15 23:37:03'),
(17, 11, 14, '2015-02-15 23:53:21'),
(21, 12, 15, '2015-02-24 07:48:03'),
(22, 13, 17, '2015-02-24 07:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) NOT NULL,
  `service_duration` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT '0',
  `cost` double NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `service_duration`, `discount`, `cost`, `last_update`) VALUES
(1, 'Basic', 1, 0, 12000, '2014-12-20 21:13:21'),
(2, 'Economy', 5, 10, 54000, '2014-12-20 21:13:21'),
(3, 'Premium', 8, 20, 76800, '2014-12-20 21:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `service_lines`
--

CREATE TABLE IF NOT EXISTS `service_lines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  `service_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'user freeze or terminate service status',
  `payment_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'to check whether user paid for the services or not',
  `reminder` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'remind before expired',
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`service_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `service_lines`
--

INSERT INTO `service_lines` (`id`, `user_id`, `service_id`, `service_status`, `payment_status`, `reminder`, `expiry_date`, `last_update`) VALUES
(1, 2, 1, 1, 1, 0, '2016-02-12 17:55:24', '2015-02-12 17:55:24'),
(8, 7, 2, 1, 1, 0, '2020-02-15 23:26:04', '2015-02-15 23:26:04'),
(9, 8, 3, 1, 1, 0, '2023-02-15 23:31:10', '2015-02-15 23:31:10'),
(10, 9, 2, 1, 1, 0, '2020-02-15 23:35:35', '2015-02-15 23:35:35'),
(11, 10, 1, 1, 1, 0, '2016-02-15 23:50:02', '2015-02-15 23:50:02'),
(12, 11, 1, 1, 1, 0, '2016-02-24 07:38:48', '2015-02-24 07:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `customer_id` int(11) unsigned NOT NULL,
  `points` int(11) unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Like a customer card' AUTO_INCREMENT=20 ;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `customer_id`, `points`, `last_update`) VALUES
(1, 2, 1, 200, '2014-02-11 19:47:10'),
(2, 2, 2, 700, '2015-03-03 22:46:40'),
(5, 2, 3, 500, '2015-03-17 20:38:07'),
(6, 2, 4, 200, '2015-04-14 23:37:09'),
(7, 7, 5, 0, '2015-02-15 23:40:18'),
(8, 8, 5, 0, '2015-02-15 23:40:28'),
(9, 2, 5, 200, '2015-02-15 23:40:39'),
(10, 9, 3, 0, '2015-02-17 11:46:06'),
(11, 9, 6, 0, '2015-02-19 03:59:16'),
(12, 2, 7, 710, '2015-02-24 08:17:44'),
(16, 11, 2, 150, '2015-02-24 10:19:03'),
(17, 7, 2, 0, '2015-03-12 00:48:43'),
(18, 2, 8, 700, '2015-06-15 12:27:05'),
(19, 7, 8, 0, '2015-06-15 12:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_paypal`
--

CREATE TABLE IF NOT EXISTS `transaction_paypal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_line_id` int(11) unsigned NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`service_line_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `transaction_paypal`
--

INSERT INTO `transaction_paypal` (`id`, `service_line_id`, `payment_id`, `hash`, `status`, `last_update`) VALUES
(1, 1, 'PAY-06834027J6632330KKTOORPI', 'b28a2191047e21f01f25015ec75e81eb', 1, '2015-02-12 17:54:05'),
(8, 8, 'PAY-6CU73345CS497741RKTQSVZQ', '94531c61be9a21bbcd3da89dae4790a3', 1, '2015-02-15 23:25:27'),
(9, 9, 'PAY-6PG405469P1019113KTQSYGI', '5ac5d14611d56c082c76093a57537287', 1, '2015-02-15 23:30:33'),
(10, 10, 'PAY-9DB913077T567212UKTQS2FQ', '40b957fd04baa09e34cd00a6d6ea9662', 1, '2015-02-15 23:34:46'),
(11, 11, 'PAY-6L887775MW206654PKTQTA6Q', '339fab64fb7a16968b4b43cb4277142e', 1, '2015-02-15 23:49:14'),
(12, 12, 'PAY-0L864691XR474380MKTWCUUY', 'd29a6b5e46bd8a943b17a925681ab878', 1, '2015-02-24 07:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `role` enum('admin','merchant') NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `salt`, `role`, `last_update`) VALUES
(1, 'admin@7shocks.com', '38a6a8ac8ff638d9a19c576794e151e666726462', '60e80e6ece5d09695c6f7e9c80425694f73c8253', 'admin', '2015-01-30 04:40:40'),
(2, 'mtcy_9012@hotmail.com', '38a6a8ac8ff638d9a19c576794e151e666726462', '60e80e6ece5d09695c6f7e9c80425694f73c8253', 'merchant', '2015-02-12 17:37:07'),
(7, 'jasonlcl@hotmail.com', '593ffb05381a57447b7186129d6fa51f7481fa8d', '4622f26f4bfa6b2b9343676a087335459a5fffa3', 'merchant', '2015-02-15 23:24:02'),
(8, 'jasonlcly3000@gmail.com', '81bfdb1d0baf5db3a7cc3e9e32555f5e454429ac', 'a5cf894dde742aacb1095b07343c54c5167b9cfe', 'merchant', '2015-02-15 23:29:10'),
(9, 'jasonlcly2000@gmail.com', '6297c512846a2f63965124e5ed1213a64c3227a2', 'd6fa82c2cc01a6bf996e1973fe42b9bc08d2ceb5', 'merchant', '2015-02-15 23:33:54'),
(10, 'jasonlcly5000@gmail.com', '7e0e4616ac4acec24672143d80f11d530d706c24', '528892672a393b247f0e3a2f0ddeec48d9b9b5bd', 'merchant', '2015-02-15 23:47:49'),
(11, 'jasonlcly1993@gmail.com', 'ab5d36b1f1c0f95de0233f92f6a96c9483156686', '1af5eef15449a00856cfb3f2ca407cc4145a4e24', 'merchant', '2015-02-24 07:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int(10) unsigned NOT NULL,
  `icno` varchar(15) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `ic_img` varchar(50) NOT NULL,
  `security_question` int(11) NOT NULL,
  `security_answer` varchar(50) NOT NULL,
  `acc_activation` tinyint(1) NOT NULL DEFAULT '0',
  `company_name` varchar(50) NOT NULL,
  `company_reg_no` varchar(50) NOT NULL,
  `company_logo` varchar(50) NOT NULL,
  `company_verification` tinyint(1) NOT NULL DEFAULT '0',
  `company_code` varchar(50) NOT NULL,
  `website` varchar(100) NOT NULL,
  `card_initial_points` int(11) NOT NULL,
  `card_img` varchar(50) NOT NULL,
  `card_name` varchar(50) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `icno`, `fullname`, `contact`, `ic_img`, `security_question`, `security_answer`, `acc_activation`, `company_name`, `company_reg_no`, `company_logo`, `company_verification`, `company_code`, `website`, `card_initial_points`, `card_img`, `card_name`, `last_update`) VALUES
(1, '', 'admin', '', '', 0, '', 1, '', '', '', 1, '', '', 0, '', '', '2015-01-30 04:42:04'),
(2, '930401-02-3049', 'Tan Chong Yong', '017-7123123', '54ec595849c0e.jpg', 1, 'licky', 1, 'BrainWired', 'WB-12123123', '54ec594fb8847.jpg', 1, 'WB-1298', 'http://www.wiredbrain.com', 501, '559392941ba52.png', 'sdfsfd', '2015-02-12 17:37:07'),
(7, '923032-63-2330', 'Tan Leong Choon', '016-6348552', '54e12ac62ca0c.png', 1, 'nancy', 1, 'Doraemon', 'asdfsdf-1', '54e12ac61a63e.jpg', 1, 'asdfdsf', 'www.doraemon.com.my', 0, '54e12b355373c.png', 'DORAEMON', '2015-02-15 23:24:02'),
(8, '123213-21-3213', 'Lee Yik Yang', '016-6348552', '54e12c028cc70.png', 1, 'boy', 1, 'EZpoop', 'asdfsadf-1', '54e12c0288dc2.png', 1, 'asdfsd', 'www.poop.com.my', 0, '54e12c639861f.png', 'EZpoop', '2015-02-15 23:29:10'),
(9, '123123-31-2213', 'Leong Kok Hon', '016-6348552', '54e12d07e1a60.png', 1, 'girl', 1, 'FCUK', 'sdasdsad-1', '54e12d078e745.png', 1, 'wqeqwe', 'www.fcuk.com.my', 0, '54e12d6810ed5.png', 'FCUK', '2015-02-15 23:33:54'),
(10, '123213-21-3213', 'Phua Chu Kang', '032-2323232', '54e1306266caa.png', 1, 'Killerbee', 1, 'Ginger', 'asdfdsafs-2', '54e13062597b6.jpg', 1, 'sdffsadf', 'www.ginger.com.my', 100, '54e130fa71cee.png', 'GINGER EVERYWHERE', '2015-02-15 23:47:49'),
(11, '931232-11-2353', 'Leong Choon', '012-2131231', '54ec292c343e6.jpg', 1, 'donny', 1, 'PlayBoy', 'p123', '54ec292c1a6c9.png', 1, 'P123', 'www.playboy.com', 200, '54ec2b4828a7d.png', 'PlayBoy', '2015-02-24 07:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='multiple vendors available' AUTO_INCREMENT=19 ;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `user_id`, `name`, `last_update`) VALUES
(1, 2, 'Wangsa maju', '2015-02-12 18:01:33'),
(2, 2, 'Genting Klang', '2015-02-12 18:01:37'),
(3, 2, 'Melati Utama', '2015-02-12 18:01:43'),
(10, 7, 'Wangsa Maju', '2015-02-15 23:27:48'),
(11, 8, 'Space', '2015-02-15 23:32:51'),
(12, 8, 'Longkang', '2015-02-15 23:32:55'),
(13, 9, 'Genting', '2015-02-15 23:37:00'),
(14, 10, 'Chow Kit', '2015-02-15 23:53:17'),
(15, 11, 'Wangsa Maju', '2015-02-24 07:45:27'),
(17, 11, 'Genting Klang', '2015-02-24 07:47:56'),
(18, 2, 'fsdfsdf', '2015-07-01 07:12:36');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card_rules`
--
ALTER TABLE `card_rules`
  ADD CONSTRAINT `card_rules_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_lines`
--
ALTER TABLE `product_lines`
  ADD CONSTRAINT `product_lines_ibfk_3` FOREIGN KEY (`product_vendor_id`) REFERENCES `product_vendor` (`id`),
  ADD CONSTRAINT `product_lines_ibfk_4` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_vendor`
--
ALTER TABLE `product_vendor`
  ADD CONSTRAINT `product_vendor_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_vendor_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`);

--
-- Constraints for table `service_lines`
--
ALTER TABLE `service_lines`
  ADD CONSTRAINT `service_lines_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `service_lines_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `transaction_paypal`
--
ALTER TABLE `transaction_paypal`
  ADD CONSTRAINT `transaction_paypal_ibfk_1` FOREIGN KEY (`service_line_id`) REFERENCES `service_lines` (`id`);

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
