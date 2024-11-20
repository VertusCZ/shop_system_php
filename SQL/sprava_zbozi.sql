-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 08. dub 2020, 11:36
-- Verze serveru: 10.4.11-MariaDB
-- Verze PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `sprava_zbozi`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `kategorie`
--

CREATE TABLE `kategorie` (
  `ID_KA` int(11) NOT NULL,
  `nazev` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `popis` varchar(80) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `kategorie`
--

INSERT INTO `kategorie` (`ID_KA`, `nazev`, `popis`) VALUES
(1, 'procesor', ''),
(2, 'grafická karta', ''),
(3, 'základní deska', ''),
(4, 'paměti RAM', ''),
(5, 'disk', 'uložiště pro data'),
(6, 'skříň', ''),
(7, 'zdroj', ''),
(9, 'zvuková karta', ''),
(10, 'siťová karta', ''),
(24, 'chladič', 'tepelný výměník pro výměnu tepla'),
(25, 'mechanika', 'periferní zařízení na ukládání dat na optické disky');

-- --------------------------------------------------------

--
-- Struktura tabulky `kategorie_urceni`
--

CREATE TABLE `kategorie_urceni` (
  `ID_KAU` int(11) NOT NULL,
  `nazev` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `rozmery` int(11) NOT NULL,
  `spotreba` int(11) NOT NULL,
  `pamet` int(11) NOT NULL,
  `vykon` int(11) NOT NULL,
  `frekvence` int(11) NOT NULL,
  `socket` int(11) NOT NULL,
  `typ_pameti` int(11) NOT NULL,
  `cteni` int(11) NOT NULL,
  `zapis` int(11) NOT NULL,
  `hmotnost` int(11) NOT NULL,
  `format` int(11) NOT NULL,
  `konectory` int(11) NOT NULL,
  `pokrocile_parametry` int(11) NOT NULL,
  `funkce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `kategorie_urceni`
--

INSERT INTO `kategorie_urceni` (`ID_KAU`, `nazev`, `rozmery`, `spotreba`, `pamet`, `vykon`, `frekvence`, `socket`, `typ_pameti`, `cteni`, `zapis`, `hmotnost`, `format`, `konectory`, `pokrocile_parametry`, `funkce`) VALUES
(1, 'procesor', 1, 1, 0, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 1),
(2, 'grafická karta', 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1),
(3, 'zakladní deska', 1, 1, 0, 1, 0, 1, 1, 0, 0, 1, 1, 1, 1, 1),
(4, 'paměti RAM', 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 0, 0, 1, 1),
(5, 'disk', 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1),
(6, 'skříň', 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0),
(7, 'zdroj', 1, 1, 0, 1, 0, 0, 0, 0, 0, 1, 1, 0, 1, 1),
(8, 'chladič', 1, 1, 0, 1, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0),
(9, 'zvuková karta', 1, 1, 0, 1, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1),
(10, 'síťová karta', 1, 1, 0, 1, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel` (
  `ID_UZ` int(11) NOT NULL,
  `jmeno` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `login` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(40) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`ID_UZ`, `jmeno`, `prijmeni`, `login`, `heslo`) VALUES
(1, 'Jan', 'Drga', 'jan', '849b28dcbe2c37b2c60d994e5dbd4b21535d0701');

-- --------------------------------------------------------

--
-- Struktura tabulky `vyrobce`
--

CREATE TABLE `vyrobce` (
  `ID_VY` int(11) NOT NULL,
  `jmeno` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `cele_jmeno` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `stat` varchar(20) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `vyrobce`
--

INSERT INTO `vyrobce` (`ID_VY`, `jmeno`, `cele_jmeno`, `stat`) VALUES
(1, 'Intel', 'Intel Corporation', 'USA'),
(2, 'MSI', 'Micro-Star International', 'Tchaj-wan'),
(3, 'AMD', 'Advanced Micro Devices', 'USA'),
(4, 'ASUS', 'AsusTek Computer Inc.', 'Tchaj-wan'),
(5, 'Kingston', 'Kingston Technology Corporation', 'USA'),
(6, 'Seasonic', 'Seasonic Electronics Co., Ltd.', 'Tchaj-wan'),
(7, 'Western Digital ', 'Western Digital Corporation', 'USA'),
(8, 'Seagate ', 'Seagate Technology PLC ', 'USA'),
(9, 'NZXT', 'NZXT, Inc.', 'USA'),
(10, 'Cooler Master', 'Cooler Master Co., Ltd.', 'Tchaj-wan'),
(11, 'Gigabyte ', 'Gigabyte Technology Co., Ltd.', 'Tchaj-wan'),
(12, 'Samsung', 'Samsung Electronics', 'South Korea'),
(15, 'Corsair', 'Corsair Components, Inc.', 'USA'),
(16, 'Crucial', 'Micron Technology, Inc.', 'USA'),
(17, 'Fractal Design', 'Fractal Design Corporation', 'Sweden'),
(18, 'Fortron', 'FSP Fortron', 'Tchaj-wan'),
(19, 'Zalman', 'Zalman Tech Co.', 'South Korea'),
(20, 'EVGA ', 'EVGA Corporation ', 'USA'),
(21, 'TP-LINK ', 'TP-LINK Technologies Co., Ltd.', 'China'),
(25, 'Creative', 'Creative Technology Ltd.', 'Singapur');

-- --------------------------------------------------------

--
-- Struktura tabulky `zbozi`
--

CREATE TABLE `zbozi` (
  `ID_ZB` int(11) NOT NULL,
  `nazev` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `modelove_oznaceni` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `rozmery` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `spotreba` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `pamet` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `vykon` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `frekvence` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `socket` varchar(30) COLLATE utf8_czech_ci DEFAULT NULL,
  `cipset` varchar(30) COLLATE utf8_czech_ci DEFAULT NULL,
  `typ_pameti` varchar(10) COLLATE utf8_czech_ci DEFAULT NULL,
  `cteni` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `zapis` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `hmotnost` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `format` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `konektory` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `pokrocile_parametry` text COLLATE utf8_czech_ci DEFAULT NULL,
  `funkce` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `ID_VY` int(11) NOT NULL,
  `ID_KA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `zbozi`
--

INSERT INTO `zbozi` (`ID_ZB`, `nazev`, `modelove_oznaceni`, `rozmery`, `spotreba`, `pamet`, `vykon`, `frekvence`, `socket`, `cipset`, `typ_pameti`, `cteni`, `zapis`, `hmotnost`, `format`, `konektory`, `pokrocile_parametry`, `funkce`, `ID_VY`, `ID_KA`) VALUES
(1, 'GTX 1060', ' 4719072470364', '', '400 W', '6 Gb', '', '', '', 'GeForce GTX 1060', 'GDDR5', '', '', '', '', '', '', '', 2, 2),
(2, 'i3', '  BO427m9', '', ' 65 W', '', '', ' 3,6 GHz ', ' Intel 1151 Coffee Lake', '', '', '', '', '', '', '', '', 'Integrované GPU', 1, 1),
(3, 'HyperX Fury', 'DE100c5', '', '', '16', '', '2,6', '', NULL, 'DDR4', '', '', '', '', '', '', ' Pasivní chladič, XMP, Unbuffered', 5, 4),
(4, 'Gaming pro carbon ac', '', '', '10 KW', '', '', '', ' AMD AM4', ' AMD B450', 'DDR4', '', '', '', ' ATX', '', '', '', 2, 3),
(5, 'i9', '', '', ' 95 W', '', '', ' 3,6 GHz', '	Intel 1151 Coffee Lake', '', '', '', '', '', '', '', '8 jader', ' Automatické přetaktování, Integrované GPU', 1, 1),
(6, 'i5', 'BO431e6d', '', '', '', '', ' 2,9 GHz', ' Intel 1151 Coffee Lake', '', '', '', '', '', '', '', '6 jader', '', 1, 1),
(7, 'i7', 'BO533e7b', '', '', '', '', ' 3 GHz', '', '', '', '', '', '', '', '', '', '', 1, 1),
(8, 'WD Blue 3D NAND', 'FW137d3c', '', ' 3,35 W', ' 500 GB', '', '', '', '', '', '560 Mb/s', '530 Mb/s', ' 37,4 g', ' 2,5', '', '', '', 7, 5),
(9, 'Meshify C White', 'CB321k5k', '', '', '', '', '', '', '', '', '', '', '', ' mATX', '', ' Cable management, Prachové filtry, Podpora SSD 2,5', '', 17, 6),
(10, 'Focus GX 650W Gold ', ' UE314gx65', '15x 8,6x 14', '', '', '650 W', '', '', '', '', '', '', '', '', ' CPU 8pin / 4+4pin, Molex 4pin, PCI-E 8pin / 6+2pi', '', '', 6, 7),
(11, 'TG-3468 ', 'TP651f', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ' Přenosová rychlost 1 000 Mb/s', 21, 10),
(12, 'Sound Blaster AUDIGY', '  HC137b', '', '', '1 GB', '', '', '', '', '', '', '', '', '', '', 'PCI Express x1', '', 25, 9),
(13, 'H510 ELITE bílá', 'cb1476a14', '21 x 46 x 42,8 cm', '', '', '', '', '', '', '', '', '', '', '', '', ' USB 3.0 (3.1 gen1), USB-C, Sluchátka, Mikrofon', '', 9, 6),
(14, 'Barracuda 120', 'FP650c2', '', '', '500 GB', '', '', '', '', 'SSD', '', '', '', '2,5', '', '', '', 8, 5),
(15, 'B450 GAMING X ', ' AG450m7', '', '', '', '', '', ' AMD AM4', ' AMD B450', ' DDR4', '', '', '', '', '', '', ' AMD CrossFireX, DUAL BIOS', 11, 3),
(16, 'VS450 White Certified ', 'UY006p2a', '15 x 8,6 x 14 cm', '450 W', '', '', '', '', '', '', '', '', '', '', '', '', '', 15, 7),
(17, 'S4 Plus ', ' CA069d7d2', '20,6 x 45,8 x 40', '', '', '', '', '', '', '', '', '', ' 3 700 g', 'ATX', '', ' Cable management', '', 19, 6),
(18, 'RYZEN 7 2700X ', '  BD750i2', '', '', '', '', ' 3,7 GHz', ' AMD AM4', '', '', '', '', '', '', '', '8 jader', '', 3, 1),
(19, 'MasterAir 2 ', '', '', ' 120 W', '', ' 3 000 ot/min', '', '', '', '', '', '', '', '', '', 'pro sockety 775/ 1150/ 1151/ 1155/ 1156/ AM2(+)/ AM3(+)/ FM1, FM2', '', 10, 24),
(20, ' HYPER M 700', '', '', '700W ', '', '', '', '', '', '', '', '', '', 'ATX ', '', 'certifikace 80PLUS BRONZE', '', 18, 7),
(21, 'DRW-24D5MT', 'GM694k4', '', '', '', '', '', '', '', '', '', '', '', ' DVD', '', '', 'podpora média M-Disc', 4, 25),
(22, 'PCE-AC55BT ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '802.11a/b/g/n/ac až 1167 Mbps', 'podpora bluetooth 4.0', 4, 10),
(23, 'SUPER XC ULTRA GAMING ', ' EV223b25', '', ' 175 W', '8 Gb', '', '', '', '', ' GDDR6', '', '', '', '', '', '', '', 20, 2),
(24, 'ROG STRIX GAMING', 'EC2080Ti5', '', '', '11 Gb', '', '', '', '', 'GDDR6', '', '', '', '', '', 'GeForce RTX2080Ti, Quad CrossFireX ', '', 4, 2),
(25, 'Ballistix Sport LT', '', '', '', '16 Gb', '', '', '', '', 'DDR4', '', '', '', '', '', 'propustnost 24 000 MB/s', '', 16, 4);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`ID_KA`);

--
-- Klíče pro tabulku `kategorie_urceni`
--
ALTER TABLE `kategorie_urceni`
  ADD PRIMARY KEY (`ID_KAU`);

--
-- Klíče pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`ID_UZ`);

--
-- Klíče pro tabulku `vyrobce`
--
ALTER TABLE `vyrobce`
  ADD PRIMARY KEY (`ID_VY`);

--
-- Klíče pro tabulku `zbozi`
--
ALTER TABLE `zbozi`
  ADD PRIMARY KEY (`ID_ZB`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `ID_KA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pro tabulku `kategorie_urceni`
--
ALTER TABLE `kategorie_urceni`
  MODIFY `ID_KAU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `ID_UZ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `vyrobce`
--
ALTER TABLE `vyrobce`
  MODIFY `ID_VY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pro tabulku `zbozi`
--
ALTER TABLE `zbozi`
  MODIFY `ID_ZB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
