-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 11:31 AM
-- Server version: 10.2.10-MariaDB
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
-- Database: `omsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fullname` varchar(500) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `phone`, `fullname`, `password`) VALUES
(1, 'eliazino', '090009998878', 'Akin Elias', '5b5ff50b8ac6a9b2aa72cc26a90130a8a083d9b87336eb09b106783fe9ef483d');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(12) NOT NULL,
  `username` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fullname` varchar(500) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `phone`, `fullname`, `password`) VALUES
(2, 'eliazino', '090009998878', 'Akin Elias', '5b5ff50b8ac6a9b2aa72cc26a90130a8a083d9b87336eb09b106783fe9ef483d');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `minquantity` int(11) NOT NULL,
  `maxquantity` int(11) NOT NULL,
  `totalsale` int(11) DEFAULT 0,
  `image` varchar(200) DEFAULT NULL,
  `descr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `price`, `minquantity`, `maxquantity`, `totalsale`, `image`, `descr`) VALUES
(1, 'Porridge with beans', 1000, 1, 3, 0, 'uploads/2020_12_01_08_55_26article-0-014CFA7D000004B0-420_468x501.jpg', 'It\'s palm oil and allergen safe'),
(2, 'Jollof Rice with Chiken', 1200, 1, 12, 0, 'uploads/2020_12_01_09_36_36image18(1).jpg', 'favorite restaurant with a full package of fresh, delicious, tasty, and nutritious range of pastries and African intercontinental meals'),
(3, 'Fried Rice with Chiken', 1100, 1, 12, 0, 'uploads/2020_12_01_09_39_30image18(2).jpg', 'favorite restaurant with a full package of fresh, delicious, tasty, and nutritious range of pastries and African intercontinental meals'),
(4, 'Poundo and Vegetables', 1100, 1, 12, 0, 'uploads/2020_12_01_09_40_39image18(9).jpg', 'favorite restaurant with a full package of fresh, delicious, tasty, and nutritious range of pastries and African intercontinental meals'),
(5, 'Plantain Meal', 800, 1, 12, 0, 'uploads/2020_12_01_09_41_11image18(3).jpg', 'favorite restaurant with a full package of fresh, delicious, tasty, and nutritious range of pastries and African intercontinental meals'),
(6, 'Plantain and Egg meal with sauce', 2000, 1, 12, 0, 'uploads/2020_12_01_09_41_55image18.jpg', 'favorite restaurant with a full package of fresh, delicious, tasty, and nutritious range of pastries and African intercontinental meals'),
(7, 'Amala and Assorted', 2090, 1, 12, 0, 'uploads/2020_12_01_09_42_35image18.png', 'favorite restaurant with a full package of fresh, delicious, tasty, and nutritious range of pastries and African intercontinental meals'),
(8, 'Vegetable Assorted', 1050, 1, 12, 0, 'uploads/2020_12_01_09_43_10image18(7).jpg', 'favorite restaurant with a full package of fresh, delicious, tasty, and nutritious range of pastries and African intercontinental meals'),
(9, 'Fried Chicken ', 1150, 1, 12, 0, 'uploads/2020_12_01_09_43_46image18(8).jpg', 'favorite restaurant with a full package of fresh, delicious, tasty, and nutritious range of pastries and African intercontinental meals');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `menuID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `attendant` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `username`, `date`, `menuID`, `quantity`, `status`, `attendant`) VALUES
(1, 'eliazino', '02/12/2020 09:12:01', 2, 2, 1, NULL),
(2, 'eliazino', '02/12/2020 09:12:01', 5, 1, -1, NULL),
(3, 'eliazino', '02/12/2020 09:12:01', 7, 2, 0, NULL),
(4, 'eliazino', '02/12/2020 09:12:01', 8, 4, 0, NULL),
(5, 'eliazino', '02/12/2020 09:12:08', 5, 1, 0, NULL),
(6, 'eliazino', '02/12/2020 09:12:08', 8, 4, 0, NULL),
(7, 'eliazino', '02/12/2020 09:12:13', 8, 4, 0, NULL),
(8, 'eliazino', '02/12/2020 09:14:15', 2, 1, 0, NULL),
(9, 'eliazino', '02/12/2020 09:14:15', 8, 2, 0, NULL),
(10, 'eliazino', '02/12/2020 09:16:04', 8, 2, 0, NULL),
(11, 'eliazino', '02/12/2020 09:16:04', 9, 1, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
