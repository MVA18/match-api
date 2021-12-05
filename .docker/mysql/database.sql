-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Dec 05, 2021 at 09:01 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `match_database`
--
CREATE DATABASE IF NOT EXISTS `match_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `match_database`;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `pref` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `user_id`, `profile_id`, `pref`) VALUES
(40, 54, 55, 1),
(41, 54, 58, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_expire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `age`, `token`, `token_expire`) VALUES
(54, 'Fidel Dooley', 'myra36@gmail.com', '12345678', 'male', 26, '', NULL),
(55, 'TEST', 'myra36@gmail.com', '12345678', 'male', 26, '', NULL),
(56, 'Katarina Harvey', 'theodore18@hotmail.com', '12345678', 'female', 75, '', NULL),
(57, 'Katarina Harvey', 'theodore18@hotmail.com', '12345678', 'female', 75, '', NULL),
(58, 'Cleta Walter', 'efrain.feest@yahoo.com', '12345678', 'female', 56, '', NULL),
(59, 'Cleta Walter', 'efrain.feest@yahoo.com', '12345678', 'female', 56, '', NULL),
(60, 'Jordan Wiegand', 'tania.mcclure@botsford.com', '12345678', 'male', 92, '', NULL),
(61, 'Jordan Wiegand', 'tania.mcclure@botsford.com', '12345678', 'male', 92, '', NULL),
(62, 'Edythe Crooks', 'caleb.heller@baumbach.com', '12345678', 'female', 21, '', NULL),
(63, 'Edythe Crooks', 'caleb.heller@baumbach.com', '12345678', 'female', 21, '', NULL),
(64, 'Dr. Shanna Hackett III', 'turcotte.aniya@gmail.com', '12345678', 'female', 41, '', NULL),
(65, 'Dr. Shanna Hackett III', 'turcotte.aniya@gmail.com', '12345678', 'female', 41, '', NULL),
(66, 'Miss Aubrey Gottlieb', 'deion79@hotmail.com', '12345678', 'female', 24, '', NULL),
(67, 'Miss Aubrey Gottlieb', 'deion79@hotmail.com', '12345678', 'female', 24, '', NULL),
(68, 'Rahul Wuckert', 'heidenreich.brent@west.org', '12345678', 'male', 66, '', NULL),
(69, 'Rahul Wuckert', 'heidenreich.brent@west.org', '12345678', 'male', 66, '', NULL),
(70, 'Prof. Lilla Stehr', 'mraz.benny@abshire.com', '12345678', 'female', 37, '', NULL),
(71, 'Prof. Lilla Stehr', 'mraz.benny@abshire.com', '12345678', 'female', 37, '', NULL),
(72, 'Gabriella Schumm', 'lcarter@sipes.com', '12345678', 'female', 34, '', NULL),
(73, 'Gabriella Schumm', 'lcarter@sipes.com', '12345678', 'female', 34, '', NULL),
(74, 'Prof. Nickolas Auer Sr.', 'schumm.samir@gmail.com', '12345678', 'male', 28, '', NULL),
(75, 'Prof. Nickolas Auer Sr.', 'schumm.samir@gmail.com', '12345678', 'male', 28, '', NULL),
(76, 'Elise Stroman', 'bradley58@hotmail.com', '12345678', 'female', 36, '', NULL),
(77, 'Elise Stroman', 'bradley58@hotmail.com', '12345678', 'female', 36, '', NULL),
(78, 'Payton Ernser DVM', 'tremblay.abigail@howell.org', '12345678', 'male', 64, '', NULL),
(79, 'Payton Ernser DVM', 'tremblay.abigail@howell.org', '12345678', 'male', 64, '', NULL),
(80, 'Annetta Gerhold MD', 'aliza54@macejkovic.info', '12345678', 'female', 28, '', NULL),
(81, 'Annetta Gerhold MD', 'aliza54@macejkovic.info', '12345678', 'female', 28, '', NULL),
(82, 'Rosanna Marquardt', 'ynitzsche@mosciski.biz', '12345678', 'female', 51, '', NULL),
(83, 'Rosanna Marquardt', 'ynitzsche@mosciski.biz', '12345678', 'female', 51, '', NULL),
(84, 'Nathanial Denesik DVM', 'annamarie01@gulgowski.com', '12345678', 'male', 60, '', NULL),
(85, 'Nathanial Denesik DVM', 'annamarie01@gulgowski.com', '12345678', 'male', 60, '', NULL),
(86, 'Reyes Crist', 'kessler.robert@hauck.com', '12345678', 'male', 52, '', NULL),
(87, 'Reyes Crist', 'kessler.robert@hauck.com', '12345678', 'male', 52, '', NULL),
(88, 'Tom Medhurst', 'bauch.bruce@yahoo.com', '12345678', 'male', 92, '', NULL),
(89, 'Tom Medhurst', 'bauch.bruce@yahoo.com', '12345678', 'male', 92, '', NULL),
(90, 'Miss Pauline Adams PhD', 'jaskolski.shaina@veum.info', '12345678', 'female', 21, '', NULL),
(91, 'Miss Pauline Adams PhD', 'jaskolski.shaina@veum.info', '12345678', 'female', 21, '', NULL),
(92, 'Jonathan Mills', 'koconnell@hotmail.com', '12345678', 'male', 47, '', NULL),
(93, 'Jonathan Mills', 'koconnell@hotmail.com', '12345678', 'male', 47, '', NULL),
(94, 'Desiree Turcotte I', 'dangelo74@kuhic.info', '12345678', 'female', 72, '', NULL),
(95, 'Desiree Turcotte I', 'dangelo74@kuhic.info', '12345678', 'female', 72, '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
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
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;