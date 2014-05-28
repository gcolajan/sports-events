-- phpMyAdmin SQL Dump
-- version 4.2.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2014 at 08:43 PM
-- Server version: 5.5.37-1
-- PHP Version: 5.5.12-2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
`contact_id` int(11) NOT NULL,
  `contact_nom` varchar(60) NOT NULL,
  `contact_role` varchar(120) NOT NULL,
  `contact_numero` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `ecoles`
--

CREATE TABLE IF NOT EXISTS `ecoles` (
`ecole_id` int(11) NOT NULL,
  `ecole_nom` varchar(255) NOT NULL,
  `ecole_couleur` varchar(7) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `equipes`
--

CREATE TABLE IF NOT EXISTS `equipes` (
`equipe_id` int(11) NOT NULL,
  `equipe_participation` int(11) NOT NULL,
  `equipe_nom` varchar(255) NOT NULL,
  `equipe_classement` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

-- --------------------------------------------------------

--
-- Table structure for table `lieux`
--

CREATE TABLE IF NOT EXISTS `lieux` (
`lieu_id` int(11) NOT NULL,
  `lieu_nom` varchar(255) NOT NULL,
  `lieu_adresse` text NOT NULL,
  `lieu_gmap` varchar(255) NOT NULL,
  `lieu_lat` double NOT NULL,
  `lieu_lg` double NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `matchs`
--

CREATE TABLE IF NOT EXISTS `matchs` (
`match_id` int(11) NOT NULL,
  `match_eq1` int(11) NOT NULL,
  `match_eq2` int(11) NOT NULL,
  `match_res1` int(11) NOT NULL,
  `match_res2` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`news_id` int(11) NOT NULL,
  `news_date` datetime NOT NULL,
  `news_public` tinyint(1) NOT NULL,
  `news_contenu` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `participations`
--

CREATE TABLE IF NOT EXISTS `participations` (
`p_id` int(11) NOT NULL,
  `p_ecole` int(11) NOT NULL,
  `p_sport` int(11) NOT NULL,
  `p_points` int(11) NOT NULL,
  `p_classement` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

-- --------------------------------------------------------

--
-- Table structure for table `planning_animations`
--

CREATE TABLE IF NOT EXISTS `planning_animations` (
`pa_id` int(11) NOT NULL,
  `pa_lieu` int(11) NOT NULL,
  `pa_horaire` datetime NOT NULL,
  `pa_duree` time NOT NULL,
  `pa_nom` varchar(255) NOT NULL,
  `pa_description` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `planning_sports`
--

CREATE TABLE IF NOT EXISTS `planning_sports` (
`ps_id` int(11) NOT NULL,
  `ps_lieu` int(11) NOT NULL,
  `ps_horaire` datetime NOT NULL,
  `ps_duree` time NOT NULL,
  `ps_sport` int(11) NOT NULL,
  `ps_description` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE IF NOT EXISTS `sports` (
`sport_id` int(11) NOT NULL,
  `sport_type` int(11) NOT NULL,
  `sport_nom` varchar(255) NOT NULL,
  `sport_showRes` tinyint(1) NOT NULL DEFAULT '1',
  `sport_showRank` tinyint(1) NOT NULL,
  `sport_typeRank` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `types_sports`
--

CREATE TABLE IF NOT EXISTS `types_sports` (
`ts_id` int(11) NOT NULL,
  `ts_type` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
 ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `ecoles`
--
ALTER TABLE `ecoles`
 ADD PRIMARY KEY (`ecole_id`);

--
-- Indexes for table `equipes`
--
ALTER TABLE `equipes`
 ADD PRIMARY KEY (`equipe_id`), ADD KEY `equipe_participation` (`equipe_participation`);

--
-- Indexes for table `lieux`
--
ALTER TABLE `lieux`
 ADD PRIMARY KEY (`lieu_id`);

--
-- Indexes for table `matchs`
--
ALTER TABLE `matchs`
 ADD PRIMARY KEY (`match_id`), ADD KEY `match_eq1` (`match_eq1`), ADD KEY `match_eq2` (`match_eq2`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `participations`
--
ALTER TABLE `participations`
 ADD PRIMARY KEY (`p_id`), ADD KEY `p_sport` (`p_sport`), ADD KEY `p_part` (`p_ecole`,`p_sport`), ADD KEY `p_ecole` (`p_ecole`);

--
-- Indexes for table `planning_animations`
--
ALTER TABLE `planning_animations`
 ADD PRIMARY KEY (`pa_id`), ADD KEY `pa_lieu` (`pa_lieu`,`pa_horaire`);

--
-- Indexes for table `planning_sports`
--
ALTER TABLE `planning_sports`
 ADD PRIMARY KEY (`ps_id`), ADD KEY `ps_sport` (`ps_sport`), ADD KEY `ps_lieu` (`ps_lieu`,`ps_horaire`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
 ADD PRIMARY KEY (`sport_id`), ADD KEY `sport_type` (`sport_type`), ADD KEY `sport_type_2` (`sport_type`);

--
-- Indexes for table `types_sports`
--
ALTER TABLE `types_sports`
 ADD PRIMARY KEY (`ts_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ecoles`
--
ALTER TABLE `ecoles`
MODIFY `ecole_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `equipes`
--
ALTER TABLE `equipes`
MODIFY `equipe_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `lieux`
--
ALTER TABLE `lieux`
MODIFY `lieu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `matchs`
--
ALTER TABLE `matchs`
MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `participations`
--
ALTER TABLE `participations`
MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `planning_animations`
--
ALTER TABLE `planning_animations`
MODIFY `pa_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `planning_sports`
--
ALTER TABLE `planning_sports`
MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
MODIFY `sport_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `types_sports`
--
ALTER TABLE `types_sports`
MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipes`
--
ALTER TABLE `equipes`
ADD CONSTRAINT `equipes_ibfk_1` FOREIGN KEY (`equipe_participation`) REFERENCES `participations` (`p_id`);

--
-- Constraints for table `matchs`
--
ALTER TABLE `matchs`
ADD CONSTRAINT `matchs_ibfk_1` FOREIGN KEY (`match_eq1`) REFERENCES `equipes` (`equipe_id`),
ADD CONSTRAINT `matchs_ibfk_2` FOREIGN KEY (`match_eq2`) REFERENCES `equipes` (`equipe_id`);

--
-- Constraints for table `participations`
--
ALTER TABLE `participations`
ADD CONSTRAINT `participations_ibfk_1` FOREIGN KEY (`p_ecole`) REFERENCES `ecoles` (`ecole_id`),
ADD CONSTRAINT `participations_ibfk_2` FOREIGN KEY (`p_sport`) REFERENCES `sports` (`sport_id`);

--
-- Constraints for table `planning_animations`
--
ALTER TABLE `planning_animations`
ADD CONSTRAINT `planning_animations_ibfk_1` FOREIGN KEY (`pa_lieu`) REFERENCES `lieux` (`lieu_id`);

--
-- Constraints for table `planning_sports`
--
ALTER TABLE `planning_sports`
ADD CONSTRAINT `planning_sports_ibfk_1` FOREIGN KEY (`ps_sport`) REFERENCES `sports` (`sport_id`),
ADD CONSTRAINT `planning_sports_ibfk_2` FOREIGN KEY (`ps_lieu`) REFERENCES `lieux` (`lieu_id`);

--
-- Constraints for table `sports`
--
ALTER TABLE `sports`
ADD CONSTRAINT `sports_ibfk_1` FOREIGN KEY (`sport_type`) REFERENCES `types_sports` (`ts_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
