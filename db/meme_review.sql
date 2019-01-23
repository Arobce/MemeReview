-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2019 at 07:57 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meme_review`
--

-- --------------------------------------------------------

--
-- Table structure for table `meme`
--

CREATE TABLE `meme` (
  `meme_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meme`
--

INSERT INTO `meme` (`meme_id`, `name`, `user_id`, `url`, `likes`, `dislikes`) VALUES
(1, 'AMERICAAAA!!!!', 3, 'assets\\MemesForApis\\meme1.jpg', 20, 5),
(2, 'Yup..', 3, 'assets\\MemesForApis\\meme2.jpg', 985, 16),
(3, 'Really was like that', 4, 'assets\\MemesForApis\\meme3.jpg', 586, 39),
(4, 'What happened here?', 4, 'assets\\MemesForApis\\meme4.jpg', 1003, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image_url`) VALUES
(3, 'Manish Wagle', 'manish@gmail.com', 'password', 'https://avatars0.githubusercontent.com/u/26758701?s=460&v=4'),
(4, 'Sumitra Adhikari', 'sumitra@gmail.com', 'password', 'https://www.hellomagazine.com/imagenes/celebrities/2017080241160/megan-fox-rare-photo-sons/0-214-285/megan-t.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meme`
--
ALTER TABLE `meme`
  ADD PRIMARY KEY (`meme_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meme`
--
ALTER TABLE `meme`
  MODIFY `meme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meme`
--
ALTER TABLE `meme`
  ADD CONSTRAINT `meme_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
