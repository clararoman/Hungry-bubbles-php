-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2020 at 02:12 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hungrybubbles`
--

-- --------------------------------------------------------

--
-- Table structure for table `ball`
--

CREATE TABLE `ball` (
  `name` varchar(30) NOT NULL,
  `img` varchar(100) NOT NULL,
  `cost` int(11) NOT NULL,
  `isBought` int(11) NOT NULL DEFAULT '0',
  `itemId` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ball`
--

INSERT INTO `ball` (`name`, `img`, `cost`, `isBought`, `itemId`, `stock`) VALUES
('Sofia Ball', 'sofiaball.png', 100, 0, 4, 1),
('Clara Ball', 'claraball.png', 100, 0, 5, 1),
('Doggo Ball', 'doggoBall.png', 50, 0, 6, 1),
('Cat Ball', 'catball.png', 50, 0, 7, 3),
('Snus Ball', 'snusball.png', 200, 0, 8, 3),
('Coffee Ball', 'coffeeball.png', 50, 0, 9, 2),
('Candy Ball', 'candyball.png', 50, 0, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `filename` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`filename`, `date`) VALUES
('Oli.jpg', '2019-09-01 16:28:28'),
('Oli.jpg', '2019-09-01 16:28:52'),
('Oli.jpg', '2019-09-01 16:28:55'),
('Oli_2.jpg', '2019-09-01 16:29:02'),
('Oli_3.jpg', '2019-09-01 16:41:45'),
('Oli_4.jpg', '2019-09-01 16:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(11) NOT NULL,
  `playerId` int(11) NOT NULL,
  `itemId` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `playerId`, `itemId`) VALUES
(2, 1, '2'),
(3, 1, '3'),
(6, 1, '1'),
(7, 1, '2'),
(8, 1, '2'),
(9, 1, '2'),
(10, 1, '1'),
(11, 1, '1'),
(12, 2, '4'),
(13, 2, '5'),
(14, 2, '6'),
(15, 2, '4'),
(16, 2, '4'),
(17, 2, '8'),
(18, 2, '5'),
(19, 2, '5'),
(21, 5, '5'),
(22, 5, '4'),
(23, 5, '4'),
(24, 5, '5'),
(25, 5, '5'),
(26, 5, '4'),
(27, 5, '5'),
(28, 5, '5'),
(29, 5, '4'),
(30, 5, '4'),
(31, 5, '4'),
(32, 5, '5'),
(33, 5, '5'),
(34, 5, '5'),
(35, 5, '6'),
(36, 5, '6'),
(37, 5, '6'),
(38, 5, '9');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `money` int(11) NOT NULL DEFAULT '0',
  `permission` int(30) NOT NULL,
  `playerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `image`, `money`, `permission`, `playerId`) VALUES
('clara', 'clara', 'Oli_4.jpg', 0, 1, 1),
('sofia', 'sofia', '10', 0, 1, 2),
('user1', 'user1', '', 0, 3, 3),
('user2', 'user2', '', 0, 3, 4),
('anna', 'anna', '', 0, 2, 5),
('elin', 'elin', '', 0, 2, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`playerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `playerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
