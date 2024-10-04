-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- 생성 시간: 24-05-21 13:08
-- 서버 버전: 10.11.6-MariaDB-0+deb12u1
-- PHP 버전: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `embedded`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `sensor`
--

CREATE TABLE `sensor` (
  `serial_no` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `temp` float NOT NULL,
  `humidity` float NOT NULL,
  `moisture` int(11) NOT NULL DEFAULT 0,
  `illumination` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `sensor`
--

INSERT INTO `sensor` (`serial_no`, `date`, `temp`, `humidity`, `moisture`, `illumination`) VALUES
(1, '2024-05-21 12:41:02', 23, 47, 0, 433),
(2, '2024-05-21 12:41:13', 23, 47, 0, 432),
(3, '2024-05-21 12:44:37', 23, 47, 0, 425),
(4, '2024-05-21 12:44:47', 23, 47, 0, 426),
(5, '2024-05-21 12:45:31', 23.2, 46.9, 0, 427),
(6, '2024-05-21 12:45:41', 23.2, 46.8, 0, 427),
(7, '2024-05-21 12:45:51', 23.2, 46.9, 0, 429);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`serial_no`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `sensor`
--
ALTER TABLE `sensor`
  MODIFY `serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
