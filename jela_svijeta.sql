-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2022 at 10:56 AM
-- Server version: 10.5.10-MariaDB-debug
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jela_svijeta`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_eng`
--

CREATE TABLE `category_eng` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_eng`
--

INSERT INTO `category_eng` (`id`, `title`, `slug`) VALUES
(1, 'Pearl Mall', 'lugarnica-Šarkanj'),
(2, 'Mayra Light', 'ulica-bana-jelačića'),
(3, 'Mauricio Glens', 'vukovarska-ulica'),
(4, 'Freda Causeway', 'ulica-kralja-tomislava'),
(5, 'Floy Corners', 'ulica-petra-petrovića-njegoša'),
(6, 'Larson Plaza', 'grobljanska-ulica');

-- --------------------------------------------------------

--
-- Table structure for table `category_fr`
--

CREATE TABLE `category_fr` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_fr`
--

INSERT INTO `category_fr` (`id`, `title`, `slug`) VALUES
(1, 'chemin Le Goff', 'lugarnica-Šarkanj'),
(2, 'chemin Raynaud', 'ulica-bana-jelačića'),
(3, 'avenue Dumont', 'vukovarska-ulica'),
(4, 'chemin Élise Seguin', 'ulica-kralja-tomislava'),
(5, 'rue Coulon', 'ulica-petra-petrovića-njegoša'),
(6, 'rue Pierre Dufour', 'grobljanska-ulica');

-- --------------------------------------------------------

--
-- Table structure for table `category_hr`
--

CREATE TABLE `category_hr` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_hr`
--

INSERT INTO `category_hr` (`id`, `title`, `slug`) VALUES
(1, 'Lugarnica Šarkanj', 'lugarnica-Šarkanj'),
(2, 'Ulica bana Jelačića', 'ulica-bana-jelačića'),
(3, 'Vukovarska ulica', 'vukovarska-ulica'),
(4, 'Ulica kralja Tomislava', 'ulica-kralja-tomislava'),
(5, 'Ulica Petra Petrovića Njegoša', 'ulica-petra-petrovića-njegoša'),
(6, 'Grobljanska ulica', 'grobljanska-ulica');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients_eng`
--

CREATE TABLE `ingredients_eng` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients_eng`
--

INSERT INTO `ingredients_eng` (`id`, `title`, `slug`) VALUES
(1, 'Norval Will DVM', 'filip-božić'),
(2, 'Mr. Darius Flatley IV', 'duje-mandžukić'),
(3, 'Shakira McLaughlin', 'benjamin-perković'),
(4, 'Eleonore Reilly', 'petra-abramović'),
(5, 'Mrs. Brisa Aufderhar', 'tina-adamić'),
(6, 'Katrine Torphy', 'alen-marković'),
(7, 'Lilyan Morar', 'antonela-franić'),
(8, 'Dominique Aufderhar', 'ivana-Čupić'),
(9, 'Dr. Gus Prohaska DDS', 'lovro-mlakar'),
(10, 'Mr. Savion Kertzmann', 'gabrijel-mlakar'),
(11, 'Mr. Damian Towne', 'antonio-Čupić'),
(12, 'Giovanny Ullrich', 'sara-marić');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients_fr`
--

CREATE TABLE `ingredients_fr` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients_fr`
--

INSERT INTO `ingredients_fr` (`id`, `title`, `slug`) VALUES
(1, 'Frédéric Noel-Bonneau', 'filip-božić'),
(2, 'Olivier-Nicolas Laroche', 'duje-mandžukić'),
(3, 'Margaud Morel', 'benjamin-perković'),
(4, 'Auguste Regnier', 'petra-abramović'),
(5, 'Zacharie Vaillant', 'tina-adamić'),
(6, 'Théodore Blanchard', 'alen-marković'),
(7, 'Chantal Roussel', 'antonela-franić'),
(8, 'Christine Gallet', 'ivana-Čupić'),
(9, 'Adrien Grenier-Rey', 'lovro-mlakar'),
(10, 'Jules-Emmanuel Riou', 'gabrijel-mlakar'),
(11, 'Chantal Carre', 'antonio-Čupić'),
(12, 'Guillaume Brun', 'sara-marić');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients_hr`
--

CREATE TABLE `ingredients_hr` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients_hr`
--

INSERT INTO `ingredients_hr` (`id`, `title`, `slug`) VALUES
(1, 'Filip Božić', 'filip-božić'),
(2, 'Duje Mandžukić', 'duje-mandžukić'),
(3, 'Benjamin Perković', 'benjamin-perković'),
(4, 'Petra Abramović', 'petra-abramović'),
(5, 'Tina Adamić', 'tina-adamić'),
(6, 'Alen Marković', 'alen-marković'),
(7, 'Antonela Franić', 'antonela-franić'),
(8, 'Ivana Čupić', 'ivana-Čupić'),
(9, 'Lovro Mlakar', 'lovro-mlakar'),
(10, 'Gabrijel Mlakar', 'gabrijel-mlakar'),
(11, 'Antonio Čupić', 'antonio-Čupić'),
(12, 'Sara Marić', 'sara-marić');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `lang` varchar(80) NOT NULL,
  `meals` varchar(80) NOT NULL,
  `category` varchar(80) NOT NULL,
  `tags` varchar(80) NOT NULL,
  `ingredients` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meals_category`
--

CREATE TABLE `meals_category` (
  `id` int(11) NOT NULL,
  `meals_id` int(11) NOT NULL,
  `category_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals_category`
--

INSERT INTO `meals_category` (`id`, `meals_id`, `category_id`) VALUES
(1, 2, '3'),
(2, 6, '5'),
(3, 5, '6'),
(5, 3, '1'),
(11, 4, '3'),
(12, 1, NULL),
(13, 8, '6'),
(14, 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meals_eng`
--

CREATE TABLE `meals_eng` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(80) NOT NULL DEFAULT 'created'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals_eng`
--

INSERT INTO `meals_eng` (`id`, `title`, `description`, `status`) VALUES
(1, 'Weimann', 'Lao People\'s Democratic Republic', 'created'),
(2, 'VonRueden', 'Mayotte', 'created'),
(3, 'Hermann', 'British Indian Ocean Territory (Chagos Archipelago)', 'created'),
(4, 'Berge', 'Guinea-Bissau', 'created'),
(5, 'Lowe', 'Thailand', 'created'),
(6, 'O\'Hara', 'Papua New Guinea', 'created'),
(7, 'Murray', 'Cook Islands', 'created'),
(8, 'Padberg', 'Kazakhstan', 'created'),
(9, 'Schumm', 'Bahamas', 'created'),
(10, 'DuBuque', 'Jersey', 'created');

-- --------------------------------------------------------

--
-- Table structure for table `meals_fr`
--

CREATE TABLE `meals_fr` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(80) NOT NULL DEFAULT 'created'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals_fr`
--

INSERT INTO `meals_fr` (`id`, `title`, `description`, `status`) VALUES
(1, 'Chauvin', 'Antilles néerlandaises', 'created'),
(2, 'Lesage', 'Ouzbékistan', 'created'),
(3, 'Ollivier', 'Grèce', 'created'),
(4, 'Fleury', 'Ouzbékistan', 'created'),
(5, 'Noel', 'Cap Vert', 'created'),
(6, 'Antoine', 'Seychelles', 'created'),
(7, 'Monnier', 'Samoa', 'created'),
(8, 'Delattre', 'Philippines', 'created'),
(9, 'Lelievre', 'Lettonie', 'created'),
(10, 'Leveque', 'Honduras', 'created');

-- --------------------------------------------------------

--
-- Table structure for table `meals_hr`
--

CREATE TABLE `meals_hr` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(80) NOT NULL DEFAULT 'created'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals_hr`
--

INSERT INTO `meals_hr` (`id`, `title`, `description`, `status`) VALUES
(1, 'Vinković', 'Izrael', 'created'),
(2, 'Marković', 'Obala Bjelokosti', 'created'),
(3, 'Ćorluka', 'Kanada', 'created'),
(4, 'Janković', 'Peru', 'created'),
(5, 'Tomić', 'Dominikanska Republika', 'created'),
(6, 'Bogdanić', 'Kolumbija', 'created'),
(7, 'Dragić', 'Indonezija', 'created'),
(8, 'Mlakar', 'Izrael', 'created'),
(9, 'Čupić', 'Farski Otoci', 'created'),
(10, 'Tomčić', 'Švedska', 'created');

-- --------------------------------------------------------

--
-- Table structure for table `meals_ingredients`
--

CREATE TABLE `meals_ingredients` (
  `id` int(11) NOT NULL,
  `meals_id` int(11) NOT NULL,
  `ingredients_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals_ingredients`
--

INSERT INTO `meals_ingredients` (`id`, `meals_id`, `ingredients_id`) VALUES
(1, 2, 3),
(2, 2, 4),
(3, 1, 2),
(4, 3, 3),
(5, 4, 2),
(6, 5, 3),
(7, 6, 1),
(8, 7, 4),
(9, 8, 4),
(10, 8, 2),
(11, 8, 3),
(12, 9, 1),
(13, 9, 5),
(14, 10, 5),
(15, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `meals_tags`
--

CREATE TABLE `meals_tags` (
  `id` int(11) NOT NULL,
  `meals_id` varchar(80) NOT NULL,
  `tags_id` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals_tags`
--

INSERT INTO `meals_tags` (`id`, `meals_id`, `tags_id`) VALUES
(1, '4', '1'),
(2, '1', '3'),
(3, '2', '5'),
(4, '3', '1'),
(5, '5', '2'),
(6, '1', '4'),
(7, '4', '2'),
(8, '4', '3'),
(9, '5', '3'),
(10, '7', '2'),
(11, '8', '2'),
(12, '9', '3'),
(13, '6', '3'),
(14, '10', '4'),
(15, '10', '5'),
(16, '10', '1'),
(17, '8', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tags_eng`
--

CREATE TABLE `tags_eng` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_eng`
--

INSERT INTO `tags_eng` (`id`, `title`, `slug`) VALUES
(1, 'Vandervort, Fahey and Reichel', 'market-abramović'),
(2, 'Lind Group', 'kamenorezački-obrt-ratković'),
(3, 'Bartell-Barton', 'market-ivan'),
(4, 'Lind and Sons', 'neretljak-security'),
(5, 'White Group', 'mesnica-branislav'),
(6, 'Kulas-Leffler', 'horvatinčić-d.o.o.'),
(7, 'Weimann Group', 'voćarna-Župan');

-- --------------------------------------------------------

--
-- Table structure for table `tags_fr`
--

CREATE TABLE `tags_fr` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_fr`
--

INSERT INTO `tags_fr` (`id`, `title`, `slug`) VALUES
(1, 'Carre', 'market-abramović'),
(2, 'Texier Clement SARL', 'kamenorezački-obrt-ratković'),
(3, 'Leleu', 'market-ivan'),
(4, 'Traore', 'neretljak-security'),
(5, 'Maurice Menard SARL', 'mesnica-branislav'),
(6, 'Martin', 'horvatinčić-d.o.o.'),
(7, 'Prevost SARL', 'voćarna-Župan');

-- --------------------------------------------------------

--
-- Table structure for table `tags_hr`
--

CREATE TABLE `tags_hr` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_hr`
--

INSERT INTO `tags_hr` (`id`, `title`, `slug`) VALUES
(1, 'Market Abramović', 'market-abramović'),
(2, 'Kamenorezački obrt Ratković', 'kamenorezački-obrt-ratković'),
(3, 'Market Ivan', 'market-ivan'),
(4, 'Neretljak Security', 'neretljak-security'),
(5, 'Mesnica Branislav', 'mesnica-branislav'),
(6, 'Horvatinčić d.o.o.', 'horvatinčić-d.o.o.'),
(7, 'Voćarna Župan', 'voćarna-Župan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_eng`
--
ALTER TABLE `category_eng`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_fr`
--
ALTER TABLE `category_fr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_hr`
--
ALTER TABLE `category_hr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients_eng`
--
ALTER TABLE `ingredients_eng`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients_fr`
--
ALTER TABLE `ingredients_fr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients_hr`
--
ALTER TABLE `ingredients_hr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals_category`
--
ALTER TABLE `meals_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals_eng`
--
ALTER TABLE `meals_eng`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals_fr`
--
ALTER TABLE `meals_fr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals_hr`
--
ALTER TABLE `meals_hr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals_ingredients`
--
ALTER TABLE `meals_ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals_tags`
--
ALTER TABLE `meals_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags_eng`
--
ALTER TABLE `tags_eng`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags_fr`
--
ALTER TABLE `tags_fr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags_hr`
--
ALTER TABLE `tags_hr`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_eng`
--
ALTER TABLE `category_eng`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category_fr`
--
ALTER TABLE `category_fr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category_hr`
--
ALTER TABLE `category_hr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ingredients_eng`
--
ALTER TABLE `ingredients_eng`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ingredients_fr`
--
ALTER TABLE `ingredients_fr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ingredients_hr`
--
ALTER TABLE `ingredients_hr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meals_category`
--
ALTER TABLE `meals_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `meals_eng`
--
ALTER TABLE `meals_eng`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `meals_fr`
--
ALTER TABLE `meals_fr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `meals_hr`
--
ALTER TABLE `meals_hr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `meals_ingredients`
--
ALTER TABLE `meals_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `meals_tags`
--
ALTER TABLE `meals_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tags_eng`
--
ALTER TABLE `tags_eng`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tags_fr`
--
ALTER TABLE `tags_fr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tags_hr`
--
ALTER TABLE `tags_hr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
