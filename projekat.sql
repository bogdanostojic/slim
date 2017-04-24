-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2017 at 12:05 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekat`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(24) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slika` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `password`, `id`, `created_at`, `updated_at`, `slika`) VALUES
('Danijela', 'danijela@hotmail.com', '$2y$10$Hcbiodq3eByBkQEAYB9FquwL2T55ovGbq/XO6./LuXvYGhARApCx.', 20, '2017-02-25 19:01:50', '2017-02-25 19:01:50', NULL),
('Jovan', 'jovan@gmail.com', '$2y$10$lMal3bsZcoHfiW0LtmE.n.nJSvziGfHSKyN3bfBsUBRkZfnhEJ7Py', 21, '2017-02-25 19:10:37', '2017-02-26 11:00:54', NULL),
('Nikola', 'nikola@gmail.com', '$2y$10$t1zBIlJhPffSePcQvEG2MezVZ1NZh2lbriyUsh73QFT8OyJ85ASfK', 22, '2017-02-26 11:02:08', '2017-02-26 11:02:31', NULL),
('Milica', 'milica@gmail.com', '$2y$10$ZN3zO7cuazsNovgu/tCxdOYMk3vICTWC8rlM76VYA.y2oYlvcOfHq', 23, '2017-02-26 11:03:24', '2017-02-26 11:03:24', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
