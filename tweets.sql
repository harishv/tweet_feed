-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 203.124.112.56
-- Generation Time: Mar 25, 2013 at 01:28 PM
-- Server version: 5.0.96
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `tweetfeed`
--

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

DROP TABLE IF EXISTS `tweets`;
CREATE TABLE `tweets` (
  `id` int(11) NOT NULL auto_increment,
  `tweet_str_id` varchar(255) NOT NULL,
  `tweet_msg` text NOT NULL,
  `user_id_twitted` int(11) NOT NULL,
  `user_name_twitted` varchar(255) NOT NULL,
  `user_profile_pic` varchar(255) NOT NULL,
  `favourites` text NOT NULL,
  `retweeted` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
