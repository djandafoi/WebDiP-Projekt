-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 09, 2019 at 11:00 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.15-1+0~20190209065041.16+jessie~1.gbp3ad8c0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2018x057`
--

-- --------------------------------------------------------

--
-- Table structure for table `Administrator_odobrava_zahtjev`
--

CREATE TABLE `Administrator_odobrava_zahtjev` (
  `status` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `Vrijeme_obrade` datetime NOT NULL,
  `zahtjevi_idzahtjevi` int(11) NOT NULL,
  `korisnik_idkorisnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `Administrator_odobrava_zahtjev`
--

INSERT INTO `Administrator_odobrava_zahtjev` (`status`, `Vrijeme_obrade`, `zahtjevi_idzahtjevi`, `korisnik_idkorisnik`) VALUES
('Odobreno', '2019-04-09 07:09:09', 1, 1),
('Odbijeno', '2019-04-09 11:05:03', 2, 1),
('Odobreno', '2019-04-08 09:10:37', 3, 2),
('Odbijeno', '2019-04-09 16:13:11', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE `dnevnik` (
  `id_korisnika` int(11) DEFAULT NULL,
  `kor_ime` varchar(45) COLLATE latin2_croatian_ci DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `tip` text COLLATE latin2_croatian_ci,
  `upit` text COLLATE latin2_croatian_ci,
  `radnja` text COLLATE latin2_croatian_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`id_korisnika`, `kor_ime`, `datum`, `tip`, `upit`, `radnja`) VALUES
(1, 'djanda', '2019-04-09', 'Ne znam', 'Čega', 'Radi da');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija_licence`
--

CREATE TABLE `kategorija_licence` (
  `idkategorija_licence` int(11) NOT NULL,
  `naziv` varchar(45) COLLATE latin2_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `kategorija_licence`
--

INSERT INTO `kategorija_licence` (`idkategorija_licence`, `naziv`) VALUES
(1, 'Operacijski sustavi'),
(2, 'Foto'),
(3, 'Baze podataka'),
(4, 'Uređivači teksta'),
(5, 'Antivirusi'),
(6, 'Cloud'),
(7, 'Internet'),
(8, 'Blockchain'),
(9, 'Audio'),
(10, 'Video');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idkorisnik` int(11) NOT NULL,
  `ime` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `prezime` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `korisnicko_ime` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `lozinka` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `email` text COLLATE latin2_croatian_ci NOT NULL,
  `datum_vrijeme_uvjeta` datetime DEFAULT NULL,
  `Uloge_idUloge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idkorisnik`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `email`, `datum_vrijeme_uvjeta`, `Uloge_idUloge`) VALUES
(1, 'Dominik', 'Janda', 'djanda', 'admin', 'djanda@foi.hr', '2019-03-27 00:00:00', 1),
(2, 'Stiven', 'Drvoderić', 'sdrvoderi', 'woodstriker', 'sdrvoderi@foi.hr', '2019-04-01 00:00:00', 1),
(3, 'Karlo', 'Hajdinjak', 'khajdinja', 'spiledota', 'khajdinja@foi.hr', '2019-04-02 00:00:00', 2),
(4, 'Jura', 'Križanec', 'jurkrizan', 'lolfort', 'jurkrizan@foi.hr', '2019-04-04 00:00:00', 2),
(5, 'Andreja', 'Jurišić', 'ajurisic', 'foifoifoi', 'ajurisic@foi.hr', '2019-04-17 00:00:00', 2),
(6, 'Domagoj', 'Grundler', 'dgrundler', 'dvelitre', 'dgrundler@foi.hr', '2019-04-08 00:00:00', 3),
(7, 'Matija', 'Ivanić', 'mivanic', 'csgopro1', 'mivanic@foi.hr', '2019-04-07 00:00:00', 3),
(8, 'Ivan Fran', 'Hodak', 'ihodak', 'marvelheroj', 'ihodak@foi.hr', '2019-04-06 00:00:00', 3),
(9, 'Ivan', 'Šiser', 'isiser', 'champion', 'isiser@foi.hr', '2019-04-05 00:00:00', 3),
(10, 'Robert', 'Sudec', 'rsudec', 'razbijaccasa', 'rsudec@foi.hr', '2019-04-04 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_ima_licence`
--

CREATE TABLE `korisnik_ima_licence` (
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL,
  `korisnik_idkorisnik` int(11) NOT NULL,
  `licence_idlicence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `korisnik_ima_licence`
--

INSERT INTO `korisnik_ima_licence` (`datum`, `vrijeme`, `korisnik_idkorisnik`, `licence_idlicence`) VALUES
('2019-04-09', '08:11:24', 1, 4),
('2019-04-08', '05:00:00', 1, 1),
('2019-04-03', '09:31:35', 6, 3),
('2019-04-10', '04:13:08', 7, 5),
('2019-04-03', '04:12:11', 8, 7),
('2019-04-15', '02:11:12', 9, 2),
('2019-04-17', '00:14:44', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `licence`
--

CREATE TABLE `licence` (
  `idlicence` int(11) NOT NULL,
  `kategorija` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `naziv` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `opis` text COLLATE latin2_croatian_ci NOT NULL,
  `slika` text COLLATE latin2_croatian_ci NOT NULL,
  `kategorija_licence_idkategorija_licence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `licence`
--

INSERT INTO `licence` (`idlicence`, `kategorija`, `naziv`, `opis`, `slika`, `kategorija_licence_idkategorija_licence`) VALUES
(1, '', 'Office 365', 'Microsoft Office ', '', 4),
(2, '', 'Windows 7', 'Microsoft Windows 7 operacijski sustav ', '', 1),
(3, '', 'Windows 8', 'Microsoft Windows 8 operacijski sustav', '', 1),
(4, '', 'Windows 10', 'Microsoft Windows 10 operacijski sustav', '', 1),
(5, '', 'Photoshop', 'Adobe Photoshop', '', 2),
(6, '', 'Premier Pro', 'Adobe Premier Pro', '', 10),
(7, '', 'Avast Antivirus', 'Avast Antivirus', '', 5),
(8, '', 'Nod32', 'ESET Nod32 antivirus', '', 5),
(9, '', 'DbForge', 'Devart DbForge alat za uređivanje baze podataka', '', 3),
(10, '', 'Office 2010', 'Microsoft Office 2010', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `licence_ima_trgovina`
--

CREATE TABLE `licence_ima_trgovina` (
  `licence_idlicence` int(11) NOT NULL,
  `trgovina_idtrgovina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `licence_ima_trgovina`
--

INSERT INTO `licence_ima_trgovina` (`licence_idlicence`, `trgovina_idtrgovina`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 4),
(6, 4),
(7, 5),
(8, 2),
(9, 3),
(10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `moderator_kategorije`
--

CREATE TABLE `moderator_kategorije` (
  `korisnik_idkorisnik` int(11) NOT NULL,
  `kategorija_licence_idkategorija_licence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `moderator_kategorije`
--

INSERT INTO `moderator_kategorije` (`korisnik_idkorisnik`, `kategorija_licence_idkategorija_licence`) VALUES
(3, 1),
(3, 2),
(4, 4),
(4, 3),
(5, 5),
(5, 6),
(5, 7),
(3, 8),
(4, 9),
(10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `moderator_kupnja_licence`
--

CREATE TABLE `moderator_kupnja_licence` (
  `količina` int(11) NOT NULL,
  `iznos` double NOT NULL,
  `datum_valjanosti` date NOT NULL,
  `korisnik_idkorisnik` int(11) NOT NULL,
  `licence_idlicence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `moderator_kupnja_licence`
--

INSERT INTO `moderator_kupnja_licence` (`količina`, `iznos`, `datum_valjanosti`, `korisnik_idkorisnik`, `licence_idlicence`) VALUES
(3, 55, '2019-04-30', 2, 1),
(66, 800, '2019-04-29', 3, 6),
(44, 33333, '2019-07-18', 4, 5),
(222, 12412, '2019-04-02', 3, 7),
(55, 123123, '2019-10-10', 9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `trgovina`
--

CREATE TABLE `trgovina` (
  `idtrgovina` int(11) NOT NULL,
  `naziv` varchar(45) COLLATE latin2_croatian_ci DEFAULT NULL,
  `adresa` varchar(45) COLLATE latin2_croatian_ci DEFAULT NULL,
  `grad` varchar(45) COLLATE latin2_croatian_ci DEFAULT NULL,
  `država` varchar(45) COLLATE latin2_croatian_ci DEFAULT NULL,
  `email` varchar(45) COLLATE latin2_croatian_ci DEFAULT NULL,
  `telefon` varchar(45) COLLATE latin2_croatian_ci DEFAULT NULL,
  `web_stranica` varchar(45) COLLATE latin2_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `trgovina`
--

INSERT INTO `trgovina` (`idtrgovina`, `naziv`, `adresa`, `grad`, `država`, `email`, `telefon`, `web_stranica`) VALUES
(1, 'Microsoft', 'Horvatova 82', 'Zagreb', 'Hrvatska', NULL, '0800 300 300 ', 'https://www.microsoft.com/hr-hr/'),
(2, 'ESET', 'Einsteinova 24', 'Bratislava', 'Slovačka', 'ondrasik@eset.sk', '+421 (2) 322 44 111', 'www.eset.com/int'),
(3, 'devart', '2230/4 Na Žertvách St.', 'Prag', 'Republika Češka', 'sales@devart.com', NULL, 'https://www.devart.com/'),
(4, 'Adobe', '345 Park Avenue', 'San Jose', 'California', NULL, '408-536-6000', 'https://www.adobe.com/'),
(5, 'Avast', 'Pikrtova 1737/1A', 'Prag', 'Republika Češka', NULL, NULL, 'https://www.avast.com');

-- --------------------------------------------------------

--
-- Table structure for table `Uloge`
--

CREATE TABLE `Uloge` (
  `idUloge` int(11) NOT NULL,
  `naziv` varchar(45) COLLATE latin2_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `Uloge`
--

INSERT INTO `Uloge` (`idUloge`, `naziv`) VALUES
(1, 'Administrator'),
(2, 'Moderator'),
(3, 'Registrirani korisnik'),
(4, 'Neregistrirani korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `zahtjevi`
--

CREATE TABLE `zahtjevi` (
  `idzahtjevi` int(11) NOT NULL,
  `količina` int(11) NOT NULL,
  `iznos` decimal(10,0) NOT NULL,
  `datum` date NOT NULL,
  `korisnik_idkorisnik1` int(11) NOT NULL,
  `kategorija_licence_idkategorija_licence1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `zahtjevi`
--

INSERT INTO `zahtjevi` (`idzahtjevi`, `količina`, `iznos`, `datum`, `korisnik_idkorisnik1`, `kategorija_licence_idkategorija_licence1`) VALUES
(1, 2, '99', '2019-04-24', 1, 1),
(2, 3, '45', '2019-04-10', 2, 3),
(3, 5, '3333', '2019-04-09', 3, 4),
(4, 23, '800', '2019-04-12', 5, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Administrator_odobrava_zahtjev`
--
ALTER TABLE `Administrator_odobrava_zahtjev`
  ADD KEY `fk_Administrator_odobrava_zahtjev_zahtjevi1_idx` (`zahtjevi_idzahtjevi`),
  ADD KEY `fk_Administrator_odobrava_zahtjev_korisnik1_idx` (`korisnik_idkorisnik`);

--
-- Indexes for table `kategorija_licence`
--
ALTER TABLE `kategorija_licence`
  ADD PRIMARY KEY (`idkategorija_licence`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idkorisnik`),
  ADD KEY `fk_korisnik_Uloge_idx` (`Uloge_idUloge`);

--
-- Indexes for table `korisnik_ima_licence`
--
ALTER TABLE `korisnik_ima_licence`
  ADD KEY `fk_korisnik_has_licence_korisnik1_idx` (`korisnik_idkorisnik`),
  ADD KEY `fk_korisnik_has_licence_licence1_idx` (`licence_idlicence`);

--
-- Indexes for table `licence`
--
ALTER TABLE `licence`
  ADD PRIMARY KEY (`idlicence`),
  ADD KEY `fk_licence_kategorija_licence1_idx` (`kategorija_licence_idkategorija_licence`);

--
-- Indexes for table `licence_ima_trgovina`
--
ALTER TABLE `licence_ima_trgovina`
  ADD KEY `fk_licence_has_trgovina_licence1_idx` (`licence_idlicence`),
  ADD KEY `fk_licence_has_trgovina_trgovina1_idx` (`trgovina_idtrgovina`);

--
-- Indexes for table `moderator_kategorije`
--
ALTER TABLE `moderator_kategorije`
  ADD KEY `fk_moderator_kategorije_korisnik1_idx` (`korisnik_idkorisnik`),
  ADD KEY `fk_moderator_kategorije_kategorija_licence1_idx` (`kategorija_licence_idkategorija_licence`);

--
-- Indexes for table `moderator_kupnja_licence`
--
ALTER TABLE `moderator_kupnja_licence`
  ADD KEY `fk_moderator_kupnja_licence_korisnik1_idx` (`korisnik_idkorisnik`),
  ADD KEY `fk_moderator_kupnja_licence_licence1_idx` (`licence_idlicence`);

--
-- Indexes for table `trgovina`
--
ALTER TABLE `trgovina`
  ADD PRIMARY KEY (`idtrgovina`);

--
-- Indexes for table `Uloge`
--
ALTER TABLE `Uloge`
  ADD PRIMARY KEY (`idUloge`);

--
-- Indexes for table `zahtjevi`
--
ALTER TABLE `zahtjevi`
  ADD PRIMARY KEY (`idzahtjevi`),
  ADD KEY `fk_zahtjevi_korisnik1_idx` (`korisnik_idkorisnik1`),
  ADD KEY `fk_zahtjevi_kategorija_licence1_idx` (`kategorija_licence_idkategorija_licence1`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorija_licence`
--
ALTER TABLE `kategorija_licence`
  MODIFY `idkategorija_licence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `idkorisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `licence`
--
ALTER TABLE `licence`
  MODIFY `idlicence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Uloge`
--
ALTER TABLE `Uloge`
  MODIFY `idUloge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `zahtjevi`
--
ALTER TABLE `zahtjevi`
  MODIFY `idzahtjevi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Administrator_odobrava_zahtjev`
--
ALTER TABLE `Administrator_odobrava_zahtjev`
  ADD CONSTRAINT `fk_Administrator_odobrava_zahtjev_zahtjevi1` FOREIGN KEY (`zahtjevi_idzahtjevi`) REFERENCES `zahtjevi` (`idzahtjevi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Administrator_odobrava_zahtjev_korisnik1` FOREIGN KEY (`korisnik_idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_Uloge` FOREIGN KEY (`Uloge_idUloge`) REFERENCES `Uloge` (`idUloge`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik_ima_licence`
--
ALTER TABLE `korisnik_ima_licence`
  ADD CONSTRAINT `fk_korisnik_has_licence_korisnik1` FOREIGN KEY (`korisnik_idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korisnik_has_licence_licence1` FOREIGN KEY (`licence_idlicence`) REFERENCES `licence` (`idlicence`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `licence`
--
ALTER TABLE `licence`
  ADD CONSTRAINT `fk_licence_kategorija_licence1` FOREIGN KEY (`kategorija_licence_idkategorija_licence`) REFERENCES `kategorija_licence` (`idkategorija_licence`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `licence_ima_trgovina`
--
ALTER TABLE `licence_ima_trgovina`
  ADD CONSTRAINT `fk_licence_has_trgovina_licence1` FOREIGN KEY (`licence_idlicence`) REFERENCES `licence` (`idlicence`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_licence_has_trgovina_trgovina1` FOREIGN KEY (`trgovina_idtrgovina`) REFERENCES `trgovina` (`idtrgovina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `moderator_kategorije`
--
ALTER TABLE `moderator_kategorije`
  ADD CONSTRAINT `fk_moderator_kategorije_korisnik1` FOREIGN KEY (`korisnik_idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_moderator_kategorije_kategorija_licence1` FOREIGN KEY (`kategorija_licence_idkategorija_licence`) REFERENCES `kategorija_licence` (`idkategorija_licence`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `moderator_kupnja_licence`
--
ALTER TABLE `moderator_kupnja_licence`
  ADD CONSTRAINT `fk_moderator_kupnja_licence_korisnik1` FOREIGN KEY (`korisnik_idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_moderator_kupnja_licence_licence1` FOREIGN KEY (`licence_idlicence`) REFERENCES `licence` (`idlicence`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `zahtjevi`
--
ALTER TABLE `zahtjevi`
  ADD CONSTRAINT `fk_zahtjevi_korisnik1` FOREIGN KEY (`korisnik_idkorisnik1`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zahtjevi_kategorija_licence1` FOREIGN KEY (`kategorija_licence_idkategorija_licence1`) REFERENCES `kategorija_licence` (`idkategorija_licence`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
