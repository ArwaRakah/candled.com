-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 09:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `candled`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `feedback`, `created_at`) VALUES
(1, 'layan', 'layan21@gmail.com', 'Great service!', '2023-05-21 20:38:14'),
(2, 'arwa', 'arwa21@gmail.com', 'Love the candles.', '2023-05-21 20:38:14'),
(3, 'arwa', 'arwa21@gmail.com', 'good', '2023-05-21 20:51:02'),
(4, 'fofo', 'fofo21@gmail.com', 'great', '2023-05-22 14:14:18'),
(5, 'arwa rakah', 'arwa@gmail.com', 'nice', '2023-05-23 09:14:55'),
(6, 'lolo', 'lolo@gmail.com', 'good good', '2023-05-23 10:20:39'),
(7, 'roro', 'roro@gmail.com', 'good', '2023-05-23 10:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'Honey candle', 150, 'honey_candle.jpeg'),
(2, 'White candle', 200, 'white_candle.jpeg'),
(3, 'Hot Bread candle', 100, 'hotBread_candle.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`) VALUES
(1, 'arwa', 'arwa21@gmail.com', 'arwa21', '$2y$10$/w8SDNdedWjLjswKuvPi9eBUeA5osoRdTvOO5rydpef2dF2RfZY22'),
(2, 'layan', 'layan21@gmail.com', 'layan21', '$2y$10$Y/9ylo2ZXXpvaohkUW5QruzcpzOFsTF9n4fxjUWcd80CBeoFmi1dO'),
(3, 'fatimah', 'fatimah21@gmail.com', 'fatimah21', '$2y$10$ih.J4wAqFNya34N2n6MyweyAxytLhKDeN5Lj2Z4ypvI0EES2a2x4S'),
(4, 'sarah', 'sarah21@gmail.com', 'sarah21', '$2y$10$1L7jYnHlJQgHJJ/9RtwJOufAeZxiiBhdJ.wbS5m5BOBjWiKLMnwhO'),
(5, 'rawan', 'rawan21@gmail.com', 'rawan21', '$2y$10$RydZa6ex2oiG25bThH633O7.nxXozRHYvs87.7ZENRVve9gwnhdEy'),
(6, 'amnah', 'amnah21@gmail.com', 'amnah21', '$2y$10$W4BY3l.dWTkLtBelWh7ijeMWPWm1z.UZwBmTI4CnGoi/hUBWd8u8S'),
(7, 'lara', 'lara21@gmail.com', 'lara21', '$2y$10$J922LxqQnhlGI1L2TNiEF.nfWCwsQ7uIDXghpAkyJR.PW2q3yZ90y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
