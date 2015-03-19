-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 18 mrt 2015 om 11:45
-- Serverversie: 5.6.16
-- PHP-versie: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `oplossing_security_login`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(250) COLLATE utf8_bin NOT NULL,
  `password` varchar(250) COLLATE utf8_bin NOT NULL,
  `salt` varchar(250) COLLATE utf8_bin NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `salt`, `user_type`, `date`) VALUES
(1, 'test@test.be', '', '', 0, '0000-00-00 00:00:00'),
(10, 'test', 'test', '4956217375509500fae95f4.44531433', 1, '2015-03-18 11:15:05'),
(11, 'pascal@pascal.be', '53261d279230e83948c5fe807427b2db1345da10cdb5feb1962536d545db680296eb73cf3f2c4c7c91843467f69804b125cd6cb5dc3770fe81aef05b2af31a8a', '12076642255095041642bd4.15642516', 1, '2015-03-18 11:15:29'),
(12, 't@t.be', 'e3f6d340c21997455a4c4b8750f1d83246225702b40a5a2980a9ce299af632e0df0133cf76d16b8e2097bd7c86144349d96caa37bfc0d54673463a71b7e01c02', '107238765355095109502455.46678971', 1, '2015-03-18 11:18:49'),
(13, 'syntra@test.be', '6e9f9c8608265d0ea4af237445887585d0e309c47205a5319fec1358a83ec48c7ff07a5188cd64cf015b3b7f9078acea5563bcf3d2478ad2d791dd906f2b0fac', '183030779655095694b0fc38.32011334', 1, '2015-03-18 11:42:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
