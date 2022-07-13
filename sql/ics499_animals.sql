-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 07:26 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ics499_animals`
--

-- --------------------------------------------------------

--
-- Table structure for table `custom_words`
--

CREATE TABLE `custom_words` (
  `Id` int(50) NOT NULL AUTO_INCREMENT,
  `word` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `total_plays` int(10) NOT NULL,
  `winning_plays` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `preference_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `value` varchar(100) NOT NULL,
  `comments` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `puzzle_words`
--

CREATE TABLE `puzzle_words` (
  `word` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `total_plays` int(10) NOT NULL,
  `winning_plays` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping table for 'custom_words'
--

INSERT INTO puzzle_words (word, date, time, total_plays, winning_plays) VALUES
('bad', '2022-07-04', '08:00:00', 0, 0),
('get', '2022-07-07', '08:00:00', 0, 0),
('ant', '2022-07-10', '08:00:00', 0, 0),
('dog', '2022-07-13', '08:00:00', 0, 0),
('flu', '2022-07-16', '08:00:00', 0, 0),
('hay', '2022-07-19', '08:00:00', 0, 0),
('sun', '2022-07-22', '08:00:00', 0, 0),
('fix', '2022-07-25', '08:00:00', 0, 0),
('cut', '2022-07-28', '08:00:00', 0, 0),
('eye', '2022-07-31', '08:00:00', 0, 0),
('fine', '2022-07-05', '08:00:00', 0, 0),
('late', '2022-07-08', '08:00:00', 0, 0),
('duck', '2022-07-11', '08:00:00', 0, 0),
('wrap', '2022-07-14', '08:00:00', 0, 0),
('cold', '2022-07-17', '08:00:00', 0, 0),
('flex', '2022-07-20', '08:00:00', 0, 0),
('half', '2022-07-23', '08:00:00', 0, 0),
('open', '2022-07-26', '08:00:00', 0, 0),
('fuss', '2022-07-29', '08:00:00', 0, 0),
('mole', '2022-08-01', '08:00:00', 0, 0),
('ankle', '2022-07-06', '08:00:00', 0, 0),
('blind', '2022-07-09', '08:00:00', 0, 0),
('block', '2022-07-12', '08:00:00', 0, 0),
('south', '2022-07-15', '08:00:00', 0, 0),
('relax', '2022-07-18', '08:00:00', 0, 0),
('pitch', '2022-07-21', '08:00:00', 0, 0),
('index', '2022-07-24', '08:00:00', 0, 0),
('reign', '2022-07-27', '08:00:00', 0, 0),
('quota', '2022-07-30', '08:00:00', 0, 0),
('muggy', '2022-08-02', '08:00:00', 0, 0),
('అప్పచ్చి', '2022-07-04', '20:00:00', 0, 0),
('కలువ', '2022-07-07', '20:00:00', 0, 0),
('అత్తయ్య', '2022-07-10', '20:00:00', 0, 0),
('పుల్లయ్య', '2022-07-13', '20:00:00', 0, 0),
('గుంటూరు', '2022-07-16', '20:00:00', 0, 0),
('మునగ', '2022-07-19', '20:00:00', 0, 0),
('మురుకు', '2022-07-22', '20:00:00', 0, 0),
('వాణిశ్రీ', '2022-07-25', '20:00:00', 0, 0),
('మద్రాసు', '2022-07-28', '20:00:00', 0, 0),
('వార్తలు', '2022-07-31', '20:00:00', 0, 0),
('దొండకాయ', '2022-07-05', '20:00:00', 0, 0),
('గణపతి', '2022-07-08', '20:00:00', 0, 0),
('తింగరోడు', '2022-07-11', '20:00:00', 0, 0),
('సుప్పనాతి', '2022-07-14', '20:00:00', 0, 0),
('చాడీకత్తె', '2022-07-17', '20:00:00', 0, 0),
('నాడీకేంద్రం', '2022-07-20', '20:00:00', 0, 0),
('పాడుగోల', '2022-07-23', '20:00:00', 0, 0),
('మొండిసంత', '2022-07-26', '20:00:00', 0, 0),
('పైత్యకారి', '2022-07-29', '20:00:00', 0, 0),
('ఆనందము', '2022-08-01', '20:00:00', 0, 0),
('మిరపకాయ', '2022-07-06', '20:00:00', 0, 0),
('విశాఖపట్నం', '2022-07-09', '20:00:00', 0, 0),
('హైదరాబాద్', '2022-07-12', '20:00:00', 0, 0),
('అనాసపండు', '2022-07-15', '20:00:00', 0, 0),
('ఆనందమయి', '2022-07-18', '20:00:00', 0, 0),
('జాస్తిశివయ్య', '2022-07-21', '20:00:00', 0, 0),
('దమ్ముబిర్యాని', '2022-07-24', '20:00:00', 0, 0),
('బెల్లంగవ్వలు', '2022-07-27', '20:00:00', 0, 0),
('పూతరేకులు', '2022-07-30', '20:00:00', 0, 0),
('చెన్నపట్నము', '2022-08-02', '20:00:00', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `custom_words`
--
ALTER TABLE `custom_words`
  ADD PRIMARY KEY (`word`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`preference_id`);

--
-- Indexes for table `puzzle_words`
--
ALTER TABLE `puzzle_words`
  ADD PRIMARY KEY (`word`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
