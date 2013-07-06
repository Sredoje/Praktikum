-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2013 at 09:12 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cisajt`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `id_hotel` int(250) NOT NULL AUTO_INCREMENT,
  `ime` varchar(250) NOT NULL,
  `tekst` varchar(250) NOT NULL,
  `slika1` varchar(250) NOT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id_hotel`, `ime`, `tekst`, `slika1`) VALUES
(1, 'President Hotel in Prague', 'Strategically located in the heart of Prague and to the right of the Vltava River . The Hotel President is privileged to offer one of the best views of the Castle.', 'img/hotel1.jpg'),
(2, 'Srelehotel', 'srele hotel2', 'img/hotel1.jpg'),
(47, 'ovo je novi hotel', 'ssgdfgdgsdfsdfgdfgdfgh', ''),
(48, 'ovo je sredoje hotel', 'sdfsdgsdfsdgsdfsdgsdfsdgsdfsdg', ''),
(49, 'dhndhfasfasdgfsdgdsfgsdf', 'fdhgdfdfgdfhdfgsdgdfhgdfgh', 'volvo1.jpg'),
(50, 'Ninzda hotel', 'Ovo je jebeni ninzda hotel', ''),
(51, 'Ninzda hotelsdfsdf', 'Ovo je jebeni ninzda hotel', 'volvo2.jpg'),
(52, 'ganzi2 hotel', 'ovo je ganzi 2 hotel', ''),
(53, 'ganzi5', 'ovo je hotel ganzija 5', ''),
(54, 'ganzi6', 'ganzi6ganzi6ganzi6', ''),
(55, 'pakey6', 'asdgfsdhgasdfdshasdfgdfhasdgdfh', ''),
(62, 'Bosdke hotelll', 'Bosdke hotelllBosdke hotelllBosdke hotelll', 's4.png'),
(63, 'boske hotel 2', 'boske hotel 2boske hotel 2boske hotel 2boske hotel 2boske hotel 2', 's5.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(250) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `uloga` int(250) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `uloga`) VALUES
(1, 'admin', 'admin', 1),
(2, 'sredoje', 'srelepass', 2),
(3, 'ninzda', 'ninzdapass', 2),
(4, 'peki', 'pekipass', 2),
(5, 'sredoje', 'cutovic', 2),
(6, 'sredoje', 'cutovic', 2),
(7, 'sredoje', 'sdgsdfghdfh', 2),
(8, 'peki', 'pekiana', 2),
(9, 'ninzda', 'nindza', 2),
(24, 'sredoje', 'sredoje', 2),
(25, 'sredoje', 'srelesrele', 2),
(26, 'sredoje', 'sredoje', 2),
(27, 'sredoje', 'sredoje', 2),
(28, 'sredoje', 'srele', 2),
(29, 'sredoje', 'sredoje', 2),
(30, 'sredoje', 'ninzda', 2),
(31, 'sredoje', 'sredoje', 2),
(32, 'sredoje', 'srele', 2),
(33, 'sredoje', 'sredoje', 2),
(34, 'boske', 'dukanic', 2),
(35, 'boske2', 'sredoje2', 2),
(36, 'nindza', 'nindza', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_hotel`
--

CREATE TABLE IF NOT EXISTS `users_hotel` (
  `id_user` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_hotel`
--

INSERT INTO `users_hotel` (`id_user`, `id_hotel`) VALUES
(3, 4),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 45),
(2, 46),
(2, 47),
(2, 48),
(2, 49),
(2, 50),
(2, 51),
(2, 52),
(2, 53),
(2, 54),
(2, 55),
(2, 0),
(2, 0),
(2, 0),
(2, 0),
(2, 63);
