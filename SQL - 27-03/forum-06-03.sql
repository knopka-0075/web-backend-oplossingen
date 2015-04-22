-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 27 mrt 2015 om 14:57
-- Serverversie: 5.6.20
-- PHP-versie: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `forum-06-03`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cadeaukeuze`
--

CREATE TABLE IF NOT EXISTS `cadeaukeuze` (
`keuze_id` int(11) NOT NULL,
  `gebruiker_id` int(11) NOT NULL,
  `cadeau_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Gegevens worden geëxporteerd voor tabel `cadeaukeuze`
--

INSERT INTO `cadeaukeuze` (`keuze_id`, `gebruiker_id`, `cadeau_id`) VALUES
(3, 5, 3),
(20, 16, 3),
(22, 18, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cadeaus`
--

CREATE TABLE IF NOT EXISTS `cadeaus` (
`cadeau_id` int(11) NOT NULL,
  `cadeau` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden geëxporteerd voor tabel `cadeaus`
--

INSERT INTO `cadeaus` (`cadeau_id`, `cadeau`) VALUES
(1, 'smartphone'),
(2, 'tablet'),
(3, 'laptop');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE IF NOT EXISTS `gebruikers` (
`gebruiker_id` int(11) NOT NULL,
  `gebruiker_naam` varchar(30) NOT NULL,
  `gebruiker_voornaam` varchar(20) NOT NULL,
  `gebruiker_achternaam` varchar(30) NOT NULL,
  `gebruiker_type` varchar(15) NOT NULL,
  `gebruiker_email` varchar(40) NOT NULL,
  `gebruiker_wachtwoord` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`gebruiker_id`, `gebruiker_naam`, `gebruiker_voornaam`, `gebruiker_achternaam`, `gebruiker_type`, `gebruiker_email`, `gebruiker_wachtwoord`) VALUES
(1, 'leemans_floor', 'Floor', 'Leemans', 'webmaster', 'demolink@mail.be', '26d01f0b3dcd7cbddb2de08c3a95a740'),
(3, 'gebruikersnaam1', 'Voornaam 1', 'Achternaam 2', 'gebruiker', 'voornaam.achternaam@mail.be', '11d937dd708d40ec077d26d66f6c4c98'),
(4, 'gebruikersnaam2', 'Voornaam 2', 'Achternaam 2', 'gebruiker', 'email@email.be', 'de8ec5047540099dc9c8f854b494bd74'),
(5, 'gebruikersnaam2', 'Voornaam 2', 'Achternaam 2', 'gebruiker', 'email@email.be', 'de8ec5047540099dc9c8f854b494bd74'),
(6, 'mies_leemans', 'Mies', 'Leemans', 'gebruiker', 'miesleemans@hotmail.com', '26d01f0b3dcd7cbddb2de08c3a95a740'),
(9, 'leonieswart', 'Leonie', 'Swart', 'gebruiker', 'leonie-swart@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(15, 'floorleemans', 'Floor', 'Leemans', 'gebruiker', 'floorleemans@hotmail.com', '701f33b8d1366cde9cb3822256a62c01'),
(16, 'webmaster', 'Web', 'Master', 'webmaster', 'webmaster@demolink.be', '50a9c7dbf0fa09e8969978317dca12e8'),
(18, 'zonnetje', 'zee', 'zee', 'gebruiker', 'zon@zee.be', 'b1974a613f9d3a189fe36fc914e14497');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `cadeaukeuze`
--
ALTER TABLE `cadeaukeuze`
 ADD PRIMARY KEY (`keuze_id`);

--
-- Indexen voor tabel `cadeaus`
--
ALTER TABLE `cadeaus`
 ADD PRIMARY KEY (`cadeau_id`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
 ADD PRIMARY KEY (`gebruiker_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `cadeaukeuze`
--
ALTER TABLE `cadeaukeuze`
MODIFY `keuze_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT voor een tabel `cadeaus`
--
ALTER TABLE `cadeaus`
MODIFY `cadeau_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
MODIFY `gebruiker_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
