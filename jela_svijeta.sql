-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2022 at 12:54 PM
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
(1, 'Nellie Points', 'karanačka'),
(2, 'Estell Path', 'salaši'),
(3, 'Heloise Rapid', 'ulica-silvija-strahimira-kranjčevića'),
(4, 'Dario Hollow', 'ulica-kneza-domagoja'),
(5, 'Kemmer Run', 'ribarska-ulica'),
(6, 'Michele Knolls', 'ulica-svetog-ivana-nepomuka');

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
(1, 'rue Lucas Lefort', 'karanačka'),
(2, 'avenue de Charrier', 'salaši'),
(3, 'place Loiseau', 'ulica-silvija-strahimira-kranjčevića'),
(4, 'impasse Emmanuelle Reynaud', 'ulica-kneza-domagoja'),
(5, 'rue de Courtois', 'ribarska-ulica'),
(6, 'rue de Delattre', 'ulica-svetog-ivana-nepomuka');

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
(1, 'Karanačka', 'karanačka'),
(2, 'Salaši', 'salaši'),
(3, 'Ulica Silvija Strahimira Kranjčevića', 'ulica-silvija-strahimira-kranjčevića'),
(4, 'Ulica kneza Domagoja', 'ulica-kneza-domagoja'),
(5, 'Ribarska ulica', 'ribarska-ulica'),
(6, 'Ulica svetog Ivana Nepomuka', 'ulica-svetog-ivana-nepomuka');

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
(1, 'Ms. Alana Kling', 'tamara-ratković'),
(2, 'Elsie Wehner', 'emil-franić'),
(3, 'Laisha Streich', 'lana-babić'),
(4, 'Dr. Sid Streich', 'tamara-dragović'),
(5, 'Miss Elmira Hills', 'ilija-petrović'),
(6, 'Nadia Larkin', 'marijan-vincetić'),
(7, 'Deshaun Cronin', 'dunja-knežević'),
(8, 'Mrs. Patience Medhurst', 'petra-vlahović'),
(9, 'Dr. Cecelia Considine', 'dorijan-Župan'),
(10, 'Keith Satterfield I', 'viktorija-matić');

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
(1, 'Honoré Martin', 'tamara-ratković'),
(2, 'Catherine Leduc', 'emil-franić'),
(3, 'Noémi de Lagarde', 'lana-babić'),
(4, 'Olivie Joly', 'tamara-dragović'),
(5, 'Olivier Gauthier', 'ilija-petrović'),
(6, 'Claude Lagarde', 'marijan-vincetić'),
(7, 'Élise de la Pelletier', 'dunja-knežević'),
(8, 'Jacques Breton', 'petra-vlahović'),
(9, 'Nicolas Collet', 'dorijan-Župan'),
(10, 'Étienne Devaux', 'viktorija-matić');

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
(1, 'Tamara Ratković', 'tamara-ratković'),
(2, 'Emil Franić', 'emil-franić'),
(3, 'Lana Babić', 'lana-babić'),
(4, 'Tamara Dragović', 'tamara-dragović'),
(5, 'Ilija Petrović', 'ilija-petrović'),
(6, 'Marijan Vincetić', 'marijan-vincetić'),
(7, 'Dunja Knežević', 'dunja-knežević'),
(8, 'Petra Vlahović', 'petra-vlahović'),
(9, 'Dorijan Župan', 'dorijan-Župan'),
(10, 'Viktorija Matić', 'viktorija-matić');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `lang` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `lang`) VALUES
(1, 'hr'),
(2, 'eng'),
(3, 'fr');

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
(14, 9, NULL),
(16, 11, '6'),
(17, 12, '1'),
(18, 13, '3'),
(19, 14, '2'),
(20, 15, '2'),
(21, 16, '2'),
(22, 17, '3'),
(23, 18, '1'),
(24, 19, '2'),
(25, 20, '6'),
(26, 21, '5'),
(27, 22, '4'),
(28, 23, '4'),
(29, 24, '5'),
(30, 25, '6'),
(31, 26, '2'),
(32, 27, '3'),
(33, 28, '1'),
(34, 29, '2'),
(35, 30, '6'),
(36, 10, NULL);

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
(1, 'Conn', 'Comoros', 'created'),
(2, 'Feest', 'Japan', 'created'),
(3, 'Anderson', 'Seychelles', 'created'),
(4, 'Cronin', 'Central African Republic', 'created'),
(5, 'Macejkovic', 'Moldova', 'created'),
(6, 'Zulauf', 'Slovenia', 'created'),
(7, 'Powlowski', 'Antarctica (the territory South of 60 deg S)', 'created'),
(8, 'McCullough', 'Switzerland', 'created'),
(9, 'Hermiston', 'France', 'created'),
(10, 'Rowe', 'Macao', 'created'),
(11, 'Witting', 'Vietnam', 'created'),
(12, 'Oberbrunner', 'Qatar', 'created'),
(13, 'Klein', 'Cyprus', 'created'),
(14, 'Collins', 'Sri Lanka', 'created'),
(15, 'Stamm', 'Christmas Island', 'created'),
(16, 'Rowe', 'British Indian Ocean Territory (Chagos Archipelago)', 'created'),
(17, 'Armstrong', 'Guatemala', 'created'),
(18, 'Johns', 'Tajikistan', 'created'),
(19, 'Murray', 'Niger', 'created'),
(20, 'Thompson', 'Saudi Arabia', 'created'),
(21, 'Kovacek', 'Paraguay', 'created'),
(22, 'Wunsch', 'Iceland', 'created'),
(23, 'Swift', 'Trinidad and Tobago', 'created'),
(24, 'Stoltenberg', 'Iraq', 'created'),
(25, 'Turner', 'South Africa', 'created'),
(26, 'Hodkiewicz', 'Chad', 'created'),
(27, 'Morissette', 'Jersey', 'created'),
(28, 'Sawayn', 'Algeria', 'created'),
(29, 'Luettgen', 'Yemen', 'created'),
(30, 'Watsica', 'Equatorial Guinea', 'created');

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
(1, 'Fontaine', 'Nicaragua', 'created'),
(2, 'Rolland', 'Samoa', 'created'),
(3, 'Gimenez', 'Nauru', 'created'),
(4, 'Mercier', 'Norfolk (Îles)', 'created'),
(5, 'Chauvet', 'Pérou', 'created'),
(6, 'Roux', 'Tunisie', 'created'),
(7, 'Bouvet', 'São Tomé et Príncipe (Rép.)', 'created'),
(8, 'Lebreton', 'Égypte', 'created'),
(9, 'Rousset', 'Égypte', 'created'),
(10, 'Pons', 'Singapour', 'created'),
(11, 'Besson', 'Paraguay', 'created'),
(12, 'Mendes', 'Oman', 'created'),
(13, 'Lefort', 'Guadeloupe', 'created'),
(14, 'Barbier', 'Argentine', 'created'),
(15, 'Richard', 'Polynésie française', 'created'),
(16, 'Charrier', 'Slovaquie', 'created'),
(17, 'Coste', 'Cook (Îles)', 'created'),
(18, 'Fouquet', 'Lesotho', 'created'),
(19, 'Boutin', 'Vanuatu', 'created'),
(20, 'Vincent', 'Mauritanie', 'created'),
(21, 'Barre', 'Guyane', 'created'),
(22, 'Neveu', 'Tanzanie', 'created'),
(23, 'Besson', 'Mayotte', 'created'),
(24, 'Bouchet', 'Andorre', 'created'),
(25, 'Bertin', 'Jamaïque', 'created'),
(26, 'Guyot', 'Mali', 'created'),
(27, 'Tessier', 'Afghanistan', 'created'),
(28, 'Seguin', 'République tchèque', 'created'),
(29, 'Lagarde', 'Tanzanie', 'created'),
(30, 'Neveu', 'République centrafricaine', 'created');

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
(1, 'Raić-Sudar', 'Angola', 'created'),
(2, 'Tomčić', 'Mozambik', 'created'),
(3, 'Abramović', 'Mali', 'created'),
(4, 'Perić', 'Mađarska', 'created'),
(5, 'Nikolić', 'Saudijska Arabija', 'created'),
(6, 'Horvat', 'Bangladeš', 'created'),
(7, 'Vincetić', 'Paragvaj', 'created'),
(8, 'Pavić', 'Irska', 'created'),
(9, 'Dragić', 'Island', 'created'),
(10, 'Vincetić', 'Poljska', 'created'),
(11, 'Jurić', 'Dominikanska Republika', 'created'),
(12, 'Nikolić', 'San Marino', 'created'),
(13, 'Petrović', 'Albanija', 'created'),
(14, 'Horvat', 'Nigerija', 'created'),
(15, 'Vinković', 'Irska', 'created'),
(16, 'Perković', 'Sjeverna Koreja', 'created'),
(17, 'Antić', 'Grčka', 'created'),
(18, 'Filipović', 'Namibija', 'created'),
(19, 'Pavić', 'Malta', 'created'),
(20, 'Bogdanić', 'Gvatemala', 'created'),
(21, 'Blažević', 'Japan', 'created'),
(22, 'Ćorluka', 'Finska', 'created'),
(23, 'Knežević', 'Afganistan', 'created'),
(24, 'Vinković', 'Moldavija', 'created'),
(25, 'Vlahović', 'Dominikanska Republika', 'created'),
(26, 'Milić', 'Singapur', 'created'),
(27, 'Vuković', 'Paragvaj', 'created'),
(28, 'Abramović', 'Slovenija', 'created'),
(29, 'Brož', 'Estonija', 'created'),
(30, 'Abramović', 'Turska', 'created');

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
(15, 10, 2),
(16, 11, 1),
(17, 11, 2),
(18, 11, 8),
(19, 12, 4),
(20, 12, 7),
(21, 12, 2),
(22, 13, 2),
(23, 13, 4),
(24, 14, 1),
(25, 15, 6),
(26, 16, 7),
(27, 16, 8),
(28, 17, 3),
(29, 17, 1),
(30, 18, 5),
(31, 18, 2),
(32, 19, 2),
(33, 20, 2),
(34, 20, 5),
(35, 20, 7),
(36, 20, 9),
(37, 21, 9),
(38, 22, 10),
(39, 23, 1),
(40, 24, 3),
(41, 25, 5),
(42, 26, 1),
(43, 26, 6),
(44, 27, 4),
(45, 28, 7),
(46, 29, 10),
(47, 30, 1),
(48, 30, 2),
(49, 30, 3),
(50, 30, 4),
(51, 30, 5),
(52, 30, 6),
(53, 30, 7),
(54, 30, 8),
(55, 30, 9),
(56, 30, 10);

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
(17, '8', '4'),
(18, '11', '6'),
(19, '11', '4'),
(20, '12', '9'),
(21, '12', '10'),
(22, '13', '3'),
(23, '13', '7'),
(24, '14', '1'),
(25, '15', '1'),
(26, '15', '2'),
(27, '15', '3'),
(28, '15', '4'),
(29, '16', '3'),
(30, '16', '7'),
(31, '16', '8'),
(32, '17', '7'),
(33, '18', '9'),
(34, '19', '1'),
(35, '20', '5'),
(36, '20', '6'),
(37, '20', '7'),
(38, '21', '2'),
(39, '22', '2'),
(40, '22', '3'),
(41, '23', '2'),
(42, '23', '5'),
(43, '24', '2'),
(44, '24', '5'),
(45, '24', '7'),
(46, '25', '5'),
(47, '26', '4'),
(48, '27', '9'),
(49, '28', '9'),
(50, '28', '10'),
(51, '29', '1'),
(52, '29', '6'),
(53, '30', '10');

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
(1, 'Rath, Johnston and Kiehn', 'prijevoznički-obrt-marina'),
(2, 'McLaughlin-Boyer', 'dragić-security'),
(3, 'Weimann Ltd', 'turistička-agencija-novaković'),
(4, 'Koss, Windler and Braun', 'dragić-security'),
(5, 'Bradtke-Collier', 'horvatinčić-d.o.o.'),
(6, 'Prohaska-Jast', 'vuka-security'),
(7, 'Moen LLC', 'voćarna-antić'),
(8, 'Luettgen-Walsh', 'market-matko'),
(9, 'Connelly, Swift and Ernser', 'mesnica-srna'),
(10, 'Schumm-Casper', 'neretljak-d.o.o.');

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
(1, 'Aubert SAS', 'prijevoznički-obrt-marina'),
(2, 'Begue', 'dragić-security'),
(3, 'Buisson', 'turistička-agencija-novaković'),
(4, 'Klein', 'dragić-security'),
(5, 'Baudry', 'horvatinčić-d.o.o.'),
(6, 'Costa', 'vuka-security'),
(7, 'Nicolas', 'voćarna-antić'),
(8, 'Aubry', 'market-matko'),
(9, 'Grondin SAS', 'mesnica-srna'),
(10, 'Vallee Weber S.A.', 'neretljak-d.o.o.');

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
(1, 'Prijevoznički obrt Marina', 'prijevoznički-obrt-marina'),
(2, 'Dragić Security', 'dragić-security'),
(3, 'Turistička agencija Novaković', 'turistička-agencija-novaković'),
(4, 'Dragić Security', 'dragić-security'),
(5, 'Horvatinčić d.o.o.', 'horvatinčić-d.o.o.'),
(6, 'Vuka Security', 'vuka-security'),
(7, 'Voćarna Antić', 'voćarna-antić'),
(8, 'Market Matko', 'market-matko'),
(9, 'Mesnica Srna', 'mesnica-srna'),
(10, 'Neretljak d.o.o.', 'neretljak-d.o.o.');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ingredients_fr`
--
ALTER TABLE `ingredients_fr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ingredients_hr`
--
ALTER TABLE `ingredients_hr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meals_category`
--
ALTER TABLE `meals_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `meals_eng`
--
ALTER TABLE `meals_eng`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `meals_fr`
--
ALTER TABLE `meals_fr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `meals_hr`
--
ALTER TABLE `meals_hr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `meals_ingredients`
--
ALTER TABLE `meals_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `meals_tags`
--
ALTER TABLE `meals_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tags_eng`
--
ALTER TABLE `tags_eng`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tags_fr`
--
ALTER TABLE `tags_fr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tags_hr`
--
ALTER TABLE `tags_hr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
