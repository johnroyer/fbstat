-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2012 年 03 月 02 日 16:03
-- 伺服器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- 表的結構 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` varchar(60) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `created_time` int(20) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `link` varchar(2048) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `created_time` (`created_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `article_id` varchar(60) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `created_time` int(20) NOT NULL,
  `initial` varchar(100) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  PRIMARY KEY (`article_id`,`user_id`,`initial`),
  KEY `created_time` (`created_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `like`
--

CREATE TABLE IF NOT EXISTS `like` (
  `article_id` varchar(60) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `created_time` int(20) NOT NULL,
  PRIMARY KEY (`article_id`,`user_id`),
  KEY `created_time` (`created_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的結構 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(30) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
