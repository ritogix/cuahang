-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 24, 2016 at 08:09 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cuahang`
--

-- --------------------------------------------------------

--
-- Table structure for table `mathang`
--

CREATE TABLE IF NOT EXISTS `mathang` (
  `MaMH` int(11) NOT NULL AUTO_INCREMENT,
  `TenMH` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaMH`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `mathang`
--

INSERT INTO `mathang` (`MaMH`, `TenMH`) VALUES
(1, 'Linh Kiện Điện Thoại'),
(2, 'Linh Kiện Máy Tính'),
(29, '123123'),
(30, '123123'),
(31, '123123'),
(32, '123123'),
(33, '123123'),
(34, 'Linh Kiện Điện Tử Có '),
(35, 'Linh Kiện Điện Tử Có '),
(38, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE IF NOT EXISTS `sanpham` (
  `MaSP` int(11) NOT NULL AUTO_INCREMENT,
  `TenSP` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Gia` float NOT NULL,
  `MaMH` int(11) NOT NULL,
  `TinhTrang` tinyint(1) NOT NULL,
  `Hinh` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MoTa` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaSP`),
  KEY `MaMH` (`MaMH`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `Gia`, `MaMH`, `TinhTrang`, `Hinh`, `MoTa`) VALUES
(3, 'Chuột Máy Tính', 100000, 2, 1, '', ''),
(12, 'd', 54, 1, 1, 'hinh-anh-hot-girl-xinh-nhu-bup-be-4.jpg', 'Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi Xinh Vãi '),
(13, 'Test', 100, 1, 0, '', ''),
(14, 'Test', 100, 1, 0, '', ''),
(15, 'Test', 100, 1, 0, '', ''),
(16, 'Test', 100, 1, 0, '', ''),
(17, 'Test', 100, 1, 0, '', ''),
(29, 'aaa', 123, 1, 1, '', ''),
(30, 'd', 1, 1, 1, '', ''),
(31, 'a', 2, 1, 1, 'images.jpg', ''),
(32, '2', 4, 1, 1, 'images.jpg', 'gf'),
(33, '', 0, 1, 1, '1476695_595651973821360_1599857098_n_copy.jpg', ''),
(34, '', 0, 1, 1, 'hinh-anh-hot-girl-xinh-nhu-bup-be-4.jpg', ''),
(35, '', 0, 1, 1, '', ''),
(36, '', 0, 1, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Password`, `Admin`) VALUES
(1, 'admin', 'a', 1),
(2, 'user', 'a', 0),
(3, 'a', 'a', 0),
(4, 'hieu', 'a', 0),
(5, 'user1', 'a', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaMH`) REFERENCES `mathang` (`MaMH`) ON DELETE CASCADE ON UPDATE CASCADE;
