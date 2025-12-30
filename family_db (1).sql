-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2025 at 08:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `family_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `street_address` varchar(200) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state_county` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `contact_type` enum('Primary','Secondary','Work','Other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `person_id`, `email`, `phone`, `contact_type`) VALUES
(1, 1, 'john.mwangi@gmail.com', '+254712345001', 'Primary'),
(2, 2, 'mary.wanjiku@gmail.com', '+254712345002', 'Primary'),
(3, 3, 'peter.kamau@gmail.com', '+254712345003', 'Primary'),
(4, 4, 'grace.muthoni@gmail.com', '+254712345004', 'Primary'),
(5, 5, 'james.kariuki@gmail.com', '+254712345005', 'Primary'),
(6, 6, 'lucy.nyambura@gmail.com', '+254712345006', 'Primary'),
(7, 7, 'samuel.gachau@gmail.com', '+254712345007', 'Primary'),
(8, 8, 'ann.wairimu@gmail.com', '+254712345008', 'Primary'),
(9, 9, 'david.mutua@gmail.com', '+254712345009', 'Primary'),
(10, 10, 'jane.kavindu@gmail.com', '+254712345010', 'Primary'),
(11, 11, 'paul.kiprono@gmail.com', '+254712345011', 'Primary'),
(12, 12, 'rose.chebet@gmail.com', '+254712345012', 'Primary'),
(13, 13, 'michael.ochieng@gmail.com', '+254712345013', 'Primary'),
(14, 14, 'dorcas.achieng@gmail.com', '+254712345014', 'Primary'),
(15, 15, 'brian.otieno@gmail.com', '+254712345015', 'Primary'),
(16, 16, 'nancy.anyango@gmail.com', '+254712345016', 'Primary'),
(17, 17, 'joseph.barasa@gmail.com', '+254712345017', 'Primary'),
(18, 18, 'beatrice.namulya@gmail.com', '+254712345018', 'Primary'),
(19, 19, 'kevin.wekesa@gmail.com', '+254712345019', 'Primary'),
(20, 20, 'mercy.naliaka@gmail.com', '+254712345020', 'Primary'),
(21, 21, 'andrew.mutiso@gmail.com', '+254712345021', 'Primary'),
(22, 22, 'faith.mwende@gmail.com', '+254712345022', 'Primary'),
(23, 23, 'dennis.kiptoo@gmail.com', '+254712345023', 'Primary'),
(24, 24, 'alice.jepkosgei@gmail.com', '+254712345024', 'Primary'),
(25, 25, 'charles.mandela@gmail.com', '+254712345025', 'Primary'),
(26, 26, 'lydia.atieno@gmail.com', '+254712345026', 'Primary'),
(27, 27, 'victor.mulei@gmail.com', '+254712345027', 'Primary'),
(28, 28, 'joy.nthoki@gmail.com', '+254712345028', 'Primary'),
(29, 29, 'stephen.maina@gmail.com', '+254712345029', 'Primary'),
(30, 30, 'eunice.wambui@gmail.com', '+254712345030', 'Primary'),
(31, 31, 'eric.njoroge@gmail.com', '+254712345031', 'Primary'),
(32, 32, 'susan.wanjiru@gmail.com', '+254712345032', 'Primary'),
(33, 33, 'henry.moses@gmail.com', '+254712345033', 'Primary'),
(34, 34, 'teresa.wangari@gmail.com', '+254712345034', 'Primary'),
(35, 35, 'kelvin.karanja@gmail.com', '+254712345035', 'Primary'),
(36, 36, 'agnes.mbithe@gmail.com', '+254712345036', 'Primary'),
(37, 37, 'isaac.mugo@gmail.com', '+254712345037', 'Primary'),
(38, 38, 'ruth.makena@gmail.com', '+254712345038', 'Primary'),
(39, 39, 'joel.mburu@gmail.com', '+254712345039', 'Primary'),
(40, 40, 'linda.wangeci@gmail.com', '+254712345040', 'Primary'),
(41, 41, 'martin.githinji@gmail.com', '+254712345041', 'Primary'),
(42, 42, 'purity.kendi@gmail.com', '+254712345042', 'Primary'),
(43, 43, 'alex.mworia@gmail.com', '+254712345043', 'Primary'),
(44, 44, 'janet.kanini@gmail.com', '+254712345044', 'Primary'),
(45, 45, 'nelson.muchiri@gmail.com', '+254712345045', 'Primary'),
(46, 46, 'phoebe.wacera@gmail.com', '+254712345046', 'Primary'),
(47, 47, 'hassan.ali@gmail.com', '+254712345047', 'Primary'),
(48, 48, 'amina.mohamed@gmail.com', '+254712345048', 'Primary'),
(49, 49, 'salim.bakari@gmail.com', '+254712345049', 'Primary'),
(50, 50, 'zainab.hassan@gmail.com', '+254712345050', 'Primary'),
(51, 51, 'abdi.ahmed@yahoo.com', '+254722345051', 'Secondary'),
(52, 52, 'faduma.nur@yahoo.com', '+254722345052', 'Secondary'),
(53, 53, 'mohamed.ismail@yahoo.com', '+254722345053', 'Secondary'),
(54, 54, 'sahra.yusuf@yahoo.com', '+254722345054', 'Secondary'),
(55, 55, 'omar.sheikh@company.co.ke', '+254733345055', 'Work'),
(56, 56, 'halima.said@company.co.ke', '+254733345056', 'Work'),
(57, 57, 'farah.abdullahi@yahoo.com', '+254722345057', 'Secondary'),
(58, 58, 'hodan.warsame@yahoo.com', '+254722345058', 'Secondary'),
(59, 59, 'yusuf.dualeh@gmail.com', '+254712345059', 'Primary'),
(60, 60, 'rahma.adan@gmail.com', '+254712345060', 'Primary'),
(61, 61, 'ibrahim.noor@gmail.com', '+254712345061', 'Primary'),
(62, 62, 'khadija.ali@gmail.com', '+254712345062', 'Primary'),
(63, 63, 'suleiman.haji@gmail.com', '+254712345063', 'Primary'),
(64, 64, 'mariam.abdalla@gmail.com', '+254712345064', 'Primary'),
(65, 65, 'rashid.salim@gmail.com', '+254712345065', 'Primary'),
(66, 66, 'nasma.juma@gmail.com', '+254712345066', 'Primary'),
(67, 67, 'bilal.hamisi@gmail.com', '+254712345067', 'Primary'),
(68, 68, 'asha.fatuma@gmail.com', '+254712345068', 'Primary'),
(69, 69, 'ali.kassim@gmail.com', '+254712345069', 'Primary'),
(70, 70, 'saida.binti@gmail.com', '+254712345070', 'Primary'),
(71, 71, 'mustafa.sharif@gmail.com', '+254712345071', 'Primary'),
(72, 72, 'rukia.omar@gmail.com', '+254712345072', 'Primary'),
(73, 73, 'hamza.suleiman@gmail.com', '+254712345073', 'Primary'),
(74, 74, 'nuru.said@gmail.com', '+254712345074', 'Primary'),
(75, 75, 'abubakar.jibril@gmail.com', '+254712345075', 'Primary'),
(76, 76, 'zahra.hussein@gmail.com', '+254712345076', 'Primary'),
(77, 77, 'sharif.abdi@gmail.com', '+254712345077', 'Primary'),
(78, 78, 'layla.noor@gmail.com', '+254712345078', 'Primary'),
(79, 79, 'idris.farah@gmail.com', '+254712345079', 'Primary'),
(80, 80, 'samira.mohamud@gmail.com', '+254712345080', 'Primary'),
(81, 81, 'anwar.abdalla@gmail.com', '+254712345081', 'Primary'),
(82, 82, 'muna.hassan@gmail.com', '+254712345082', 'Primary'),
(83, 83, 'khalid.salat@gmail.com', '+254712345083', 'Primary'),
(84, 84, 'hibo.ali@gmail.com', '+254712345084', 'Primary'),
(85, 85, 'nasir.isse@gmail.com', '+254712345085', 'Primary'),
(86, 86, 'sofia.adan@gmail.com', '+254712345086', 'Primary'),
(87, 87, 'abdul.rahman@gmail.com', '+254712345087', 'Primary'),
(88, 88, 'zulekha.said@gmail.com', '+254712345088', 'Primary'),
(89, 89, 'jamal.hussein@gmail.com', '+254712345089', 'Primary'),
(90, 90, 'nadia.salim@gmail.com', '+254712345090', 'Primary'),
(91, 91, 'imran.kassim@gmail.com', '+254712345091', 'Primary'),
(92, 92, 'safiya.bakari@gmail.com', '+254712345092', 'Primary'),
(93, 93, 'gorgeous@email.com', '0733333333', 'Work');

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `family_id` int(11) NOT NULL,
  `family_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`family_id`, `family_name`, `description`, `created_date`) VALUES
(1, 'Alexxander Isaak', NULL, '2025-12-29'),
(2, 'Randa Rousy', NULL, '2025-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `person_id` int(11) NOT NULL,
  `family_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_death` date DEFAULT NULL,
  `place_of_birth` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`person_id`, `family_id`, `first_name`, `last_name`, `gender`, `date_of_birth`, `date_of_death`, `place_of_birth`) VALUES
(1, 1, 'John', 'Mwangi', 'Male', '1968-03-12', NULL, 'Nyeri'),
(2, 1, 'Mary', 'Wanjiku', 'Female', '1972-06-21', NULL, 'Nyeri'),
(3, 1, 'Peter', 'Kamau', 'Male', '1990-01-15', NULL, 'Nyeri'),
(4, 1, 'Grace', 'Muthoni', 'Female', '1994-09-10', NULL, 'Nyeri'),
(5, 1, 'James', 'Kariuki', 'Male', '1988-11-08', NULL, 'Murang\'a'),
(6, 1, 'Lucy', 'Nyambura', 'Female', '1992-04-19', NULL, 'Murang\'a'),
(7, 1, 'Samuel', 'Gachau', 'Male', '1975-07-22', NULL, 'Kiambu'),
(8, 1, 'Ann', 'Wairimu', 'Female', '1979-02-14', NULL, 'Kiambu'),
(9, 1, 'David', 'Mutua', 'Male', '1996-05-30', NULL, 'Machakos'),
(10, 1, 'Jane', 'Kavindu', 'Female', '1999-12-11', NULL, 'Machakos'),
(11, 1, 'Paul', 'Kiprono', 'Male', '1985-08-17', NULL, 'Kericho'),
(12, 1, 'Rose', 'Chebet', 'Female', '1989-10-05', NULL, 'Kericho'),
(13, 1, 'Michael', 'Ochieng', 'Male', '1970-01-25', NULL, 'Kisumu'),
(14, 1, 'Dorcas', 'Achieng', 'Female', '1973-03-16', NULL, 'Kisumu'),
(15, 1, 'Brian', 'Otieno', 'Male', '1997-06-09', NULL, 'Kisumu'),
(16, 1, 'Nancy', 'Anyango', 'Female', '2000-09-27', NULL, 'Kisumu'),
(17, 1, 'Joseph', 'Barasa', 'Male', '1982-02-12', NULL, 'Kakamega'),
(18, 1, 'Beatrice', 'Namulya', 'Female', '1986-07-03', NULL, 'Kakamega'),
(19, 1, 'Kevin', 'Wekesa', 'Male', '2001-11-14', NULL, 'Bungoma'),
(20, 1, 'Mercy', 'Naliaka', 'Female', '2003-04-26', NULL, 'Bungoma'),
(21, 1, 'Andrew', 'Mutiso', 'Male', '1993-08-01', NULL, 'Kitui'),
(22, 1, 'Faith', 'Mwende', 'Female', '1995-12-18', NULL, 'Kitui'),
(23, 1, 'Dennis', 'Kiptoo', 'Male', '1991-09-07', NULL, 'Bomet'),
(24, 1, 'Alice', 'Jepkosgei', 'Female', '1994-03-29', NULL, 'Bomet'),
(25, 1, 'Charles', 'Mandela', 'Male', '1980-05-13', NULL, 'Busia'),
(26, 1, 'Lydia', 'Atieno', 'Female', '1984-06-20', NULL, 'Busia'),
(27, 1, 'Victor', 'Mulei', 'Male', '2002-01-09', NULL, 'Makueni'),
(28, 1, 'Joy', 'Nthoki', 'Female', '2004-10-31', NULL, 'Makueni'),
(29, 1, 'Stephen', 'Maina', 'Male', '1976-11-23', NULL, 'Laikipia'),
(30, 1, 'Eunice', 'Wambui', 'Female', '1981-02-08', NULL, 'Laikipia'),
(31, 1, 'Eric', 'Njoroge', 'Male', '1998-07-14', NULL, 'Nakuru'),
(32, 1, 'Susan', 'Wanjiru', 'Female', '2000-05-19', NULL, 'Nakuru'),
(33, 1, 'Henry', 'Moses', 'Male', '1966-12-01', NULL, 'Nyandarua'),
(34, 1, 'Teresa', 'Wangari', 'Female', '1970-01-17', NULL, 'Nyandarua'),
(35, 1, 'Kelvin', 'Karanja', 'Male', '1992-04-22', NULL, 'Naivasha'),
(36, 1, 'Agnes', 'Mbithe', 'Female', '1996-06-15', NULL, 'Naivasha'),
(37, 1, 'Isaac', 'Mugo', 'Male', '1983-08-09', NULL, 'Embu'),
(38, 1, 'Ruth', 'Makena', 'Female', '1987-11-04', NULL, 'Embu'),
(39, 1, 'Joel', 'Mburu', 'Male', '1999-03-27', NULL, 'Thika'),
(40, 1, 'Linda', 'Wangeci', 'Female', '2002-07-08', NULL, 'Thika'),
(41, 1, 'Martin', 'Githinji', 'Male', '1990-10-14', NULL, 'Meru'),
(42, 1, 'Purity', 'Kendi', 'Female', '1994-01-30', NULL, 'Meru'),
(43, 1, 'Alex', 'Mworia', 'Male', '1986-05-25', NULL, 'Chuka'),
(44, 1, 'Janet', 'Kanini', 'Female', '1989-09-16', NULL, 'Chuka'),
(45, 1, 'Nelson', 'Muchiri', 'Male', '2001-12-05', NULL, 'Nyeri'),
(46, 1, 'Phoebe', 'Wacera', 'Female', '2003-02-19', NULL, 'Nyeri'),
(47, 2, 'Hassan', 'Ali', 'Male', '1969-04-11', NULL, 'Mombasa'),
(48, 2, 'Amina', 'Mohamed', 'Female', '1973-07-24', NULL, 'Mombasa'),
(49, 2, 'Salim', 'Bakari', 'Male', '1991-02-18', NULL, 'Mombasa'),
(50, 2, 'Zainab', 'Hassan', 'Female', '1995-10-09', NULL, 'Mombasa'),
(51, 2, 'Abdi', 'Ahmed', 'Male', '1984-06-15', NULL, 'Garissa'),
(52, 2, 'Faduma', 'Nur', 'Female', '1988-12-21', NULL, 'Garissa'),
(53, 2, 'Mohamed', 'Ismail', 'Male', '1998-03-07', NULL, 'Garissa'),
(54, 2, 'Sahra', 'Yusuf', 'Female', '2001-08-26', NULL, 'Garissa'),
(55, 2, 'Omar', 'Sheikh', 'Male', '1975-01-13', NULL, 'Lamu'),
(56, 2, 'Halima', 'Said', 'Female', '1979-09-05', NULL, 'Lamu'),
(57, 2, 'Farah', 'Abdullahi', 'Male', '1993-11-29', NULL, 'Wajir'),
(58, 2, 'Hodan', 'Warsame', 'Female', '1997-04-17', NULL, 'Wajir'),
(59, 2, 'Yusuf', 'Dualeh', 'Male', '1981-02-04', NULL, 'Mandera'),
(60, 2, 'Rahma', 'Adan', 'Female', '1986-05-22', NULL, 'Mandera'),
(61, 2, 'Ibrahim', 'Noor', 'Male', '1999-07-11', NULL, 'Mandera'),
(62, 2, 'Khadija', 'Ali', 'Female', '2002-10-03', NULL, 'Mandera'),
(63, 2, 'Suleiman', 'Haji', 'Male', '1967-06-08', NULL, 'Malindi'),
(64, 2, 'Mariam', 'Abdalla', 'Female', '1971-01-27', NULL, 'Malindi'),
(65, 2, 'Rashid', 'Salim', 'Male', '1989-03-14', NULL, 'Kilifi'),
(66, 2, 'Nasma', 'Juma', 'Female', '1992-12-19', NULL, 'Kilifi'),
(67, 2, 'Bilal', 'Hamisi', 'Male', '1996-09-25', NULL, 'Tana River'),
(68, 2, 'Asha', 'Fatuma', 'Female', '1999-04-02', NULL, 'Tana River'),
(69, 2, 'Ali', 'Kassim', 'Male', '1983-08-16', NULL, 'Kwale'),
(70, 2, 'Saida', 'Binti', 'Female', '1987-11-06', NULL, 'Kwale'),
(71, 2, 'Mustafa', 'Sharif', 'Male', '1978-02-28', NULL, 'Mombasa'),
(72, 2, 'Rukia', 'Omar', 'Female', '1981-07-12', NULL, 'Mombasa'),
(73, 2, 'Hamza', 'Suleiman', 'Male', '2000-05-18', NULL, 'Likoni'),
(74, 2, 'Nuru', 'Said', 'Female', '2003-09-30', NULL, 'Likoni'),
(75, 2, 'Abubakar', 'Jibril', 'Male', '1994-12-04', NULL, 'Isiolo'),
(76, 2, 'Zahra', 'Hussein', 'Female', '1998-01-20', NULL, 'Isiolo'),
(77, 2, 'Sharif', 'Abdi', 'Male', '1985-10-08', NULL, 'Marsabit'),
(78, 2, 'Layla', 'Noor', 'Female', '1989-06-13', NULL, 'Marsabit'),
(79, 2, 'Idris', 'Farah', 'Male', '1997-03-02', NULL, 'Mandera'),
(80, 2, 'Samira', 'Mohamud', 'Female', '2001-11-15', NULL, 'Mandera'),
(81, 2, 'Anwar', 'Abdalla', 'Male', '1974-04-29', NULL, 'Lamu'),
(82, 2, 'Muna', 'Hassan', 'Female', '1978-08-21', NULL, 'Lamu'),
(83, 2, 'Khalid', 'Salat', 'Male', '1990-02-10', NULL, 'Garissa'),
(84, 2, 'Hibo', 'Ali', 'Female', '1993-07-07', NULL, 'Garissa'),
(85, 2, 'Nasir', 'Isse', 'Male', '2002-06-24', NULL, 'Wajir'),
(86, 2, 'Sofia', 'Adan', 'Female', '2004-09-01', NULL, 'Wajir'),
(87, 2, 'Abdul', 'Rahman', 'Male', '1982-01-18', NULL, 'Mombasa'),
(88, 2, 'Zulekha', 'Said', 'Female', '1986-05-09', NULL, 'Mombasa'),
(89, 2, 'Jamal', 'Hussein', 'Male', '1995-10-28', NULL, 'Kilifi'),
(90, 2, 'Nadia', 'Salim', 'Female', '1999-02-06', NULL, 'Kilifi'),
(91, 2, 'Imran', 'Kassim', 'Male', '2003-12-14', NULL, 'Kwale'),
(92, 2, 'Safiya', 'Bakari', 'Female', '2005-03-22', NULL, 'Kwale'),
(93, 2, 'Gorgeous', 'Kinoti', 'Male', '2019-08-16', '0000-00-00', 'kiamaina');

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE `relationships` (
  `relationship_id` int(11) NOT NULL,
  `person_id_1` int(11) NOT NULL,
  `person_id_2` int(11) NOT NULL,
  `relationship_type` enum('Parent-Child','Spouse','Sibling','Other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `relationships`
--
DELIMITER $$
CREATE TRIGGER `prevent_self_relationship` BEFORE INSERT ON `relationships` FOR EACH ROW BEGIN
    IF NEW.person_id_1 = NEW.person_id_2 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'A person cannot have a relationship with themselves.';
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`family_id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`),
  ADD KEY `family_id` (`family_id`);

--
-- Indexes for table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`relationship_id`),
  ADD UNIQUE KEY `person_id_1` (`person_id_1`,`person_id_2`,`relationship_type`),
  ADD KEY `person_id_2` (`person_id_2`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `families`
--
ALTER TABLE `families`
  MODIFY `family_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `relationship_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE;

--
-- Constraints for table `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `persons_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`family_id`) ON DELETE CASCADE;

--
-- Constraints for table `relationships`
--
ALTER TABLE `relationships`
  ADD CONSTRAINT `relationships_ibfk_1` FOREIGN KEY (`person_id_1`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relationships_ibfk_2` FOREIGN KEY (`person_id_2`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
