-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2015 at 11:13 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `expresswaycabs`
--

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE IF NOT EXISTS `availability` (
  `availability_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `car_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

CREATE TABLE IF NOT EXISTS `booking_detail` (
  `booking_no` int(11) NOT NULL,
  `passenger_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `no_of_pass` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_eid` varchar(30) CHARACTER SET utf8 NOT NULL,
  `customer_mno` varchar(10) CHARACTER SET utf8 NOT NULL,
  `car_no` varchar(10) CHARACTER SET utf8 NOT NULL,
  `status_no` int(11) NOT NULL,
  `time_of_booking` datetime NOT NULL,
  `date_of_dept` date NOT NULL,
  `time_of_dept` time NOT NULL,
  `route_id` int(11) NOT NULL,
  `retRoute_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_detail`
--

INSERT INTO `booking_detail` (`booking_no`, `passenger_name`, `no_of_pass`, `customer_id`, `customer_eid`, `customer_mno`, `car_no`, `status_no`, `time_of_booking`, `date_of_dept`, `time_of_dept`, `route_id`, `retRoute_id`) VALUES
(8, 'Sonal Himanshu', 2, 7, 'sonalhimanshu12@gmail.com', '9458623521', 'GA19MH5105', 2, '0000-00-00 00:00:00', '2015-05-15', '10:00:00', 6, 6),
(7, 'Sonal Himanshu', 2, 7, 'sonalhimanshu12@gmail.com', '9465896321', 'GA19MH5105', 2, '0000-00-00 00:00:00', '2015-05-15', '10:00:00', 6, 6),
(6, 'Sonal Himanshu', 1, 7, 'sonalhimanshu12@gmail.com', '8095914693', 'KA17AM5646', 2, '0000-00-00 00:00:00', '2015-05-07', '15:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `car_detail`
--

CREATE TABLE IF NOT EXISTS `car_detail` (
  `sp_id` int(11) NOT NULL,
  `car_type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `car_cap` int(10) NOT NULL,
  `seats_available` int(11) NOT NULL,
  `car_no` varchar(15) CHARACTER SET utf8 NOT NULL,
  `available` varchar(3) CHARACTER SET utf8 NOT NULL,
  `price_km` float NOT NULL,
  `waiting_hr` float NOT NULL,
  `car_pool` varchar(3) CHARACTER SET utf8 NOT NULL,
  `returning` varchar(3) CHARACTER SET utf8 NOT NULL,
  `date_unavailable` date NOT NULL,
  `rating` int(11) NOT NULL,
  `route_id` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_detail`
--

INSERT INTO `car_detail` (`sp_id`, `car_type`, `car_cap`, `seats_available`, `car_no`, `available`, `price_km`, `waiting_hr`, `car_pool`, `returning`, `date_unavailable`, `rating`, `route_id`) VALUES
(8, 'Mahindra Scorpio', 7, 7, 'KL65AL7003', 'yes', 12.1, 9, 'yes', 'yes', '0000-00-00', 0, '1'),
(8, 'Toyota Innova', 7, 7, 'KL10KR3298', 'yes', 12.1, 9, 'yes', 'yes', '0000-00-00', 0, '18'),
(8, 'Honda City', 4, 4, 'KL53PR3458', 'yes', 9.3, 5, 'no', 'yes', '0000-00-00', 0, '1'),
(8, 'Maruti Swift', 4, 4, 'KL30VA5843', 'yes', 9.3, 5, 'no', 'yes', '0000-00-00', 0, '17'),
(7, 'Toyota Innova', 7, 7, 'KA01LM4095', 'yes', 12.3, 10, 'yes', 'yes', '0000-00-00', 0, '1'),
(7, 'Hyundai Santro', 4, 4, 'KA09PK8392', 'yes', 9.4, 6, 'no', 'yes', '0000-00-00', 0, '6'),
(5, 'Honda Civic', 4, 4, 'KA17AM5646', 'yes', 9.1, 5, 'yes', 'yes', '0000-00-00', 0, '6'),
(5, 'Renault Duster', 7, 7, 'KA97LR3548', 'yes', 11.5, 7, 'yes', 'yes', '0000-00-00', 0, '6'),
(5, 'Hyundai Verna', 4, 4, 'KA32RO9900', 'yes', 9.1, 5, 'no', 'yes', '0000-00-00', 0, '1'),
(5, 'Toyota Innova', 7, 7, 'KA01PS0007', 'yes', 11.5, 7, 'no', 'yes', '0000-00-00', 0, '1'),
(6, 'Hyundai Santro', 4, 4, 'GA19MH5105', 'yes', 8.3, 4.6, 'yes', 'yes', '0000-00-00', 0, '6'),
(6, 'Honda Civic', 4, 4, 'GA01RS4325', 'yes', 8.3, 4.6, 'no', 'yes', '0000-00-00', 0, '6'),
(6, 'Toyota Innova', 7, 7, 'GA53HR2013', 'yes', 10.5, 5, 'yes', 'yes', '0000-00-00', 0, '1'),
(6, 'Hyundai Verna', 4, 4, 'GA31HT3141', 'yes', 8.3, 4.6, 'no', 'yes', '0000-00-00', 0, '18'),
(6, 'Toyota Innova', 7, 7, 'GA11BR1040', 'yes', 10.5, 5, 'yes', 'yes', '0000-00-00', 0, '6');

-- --------------------------------------------------------

--
-- Table structure for table `customer_detail`
--

CREATE TABLE IF NOT EXISTS `customer_detail` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `customer_DOB` date NOT NULL,
  `customer_gender` varchar(6) NOT NULL,
  `customer_eid` varchar(40) NOT NULL,
  `customer_pass` varbinary(30) NOT NULL,
  `customer_mno` varchar(10) NOT NULL,
  `customer_add` varchar(100) NOT NULL,
  `customer_city` varchar(20) NOT NULL,
  `customer_pin` varchar(6) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_detail`
--

INSERT INTO `customer_detail` (`customer_id`, `customer_name`, `customer_DOB`, `customer_gender`, `customer_eid`, `customer_pass`, `customer_mno`, `customer_add`, `customer_city`, `customer_pin`) VALUES
(6, 'Snehil', '1997-10-23', 'male', 'snehil@gmail.com', 0x61736466313233, '4561235874', 'hkjhjhlk', 'ughjkkjjk', '554466'),
(7, 'Sonal Himanshu', '1992-10-04', 'female', 'sonalhimanshu12@gmail.com', 0x65787072657373776179313233, '8095914693', 'Block A,\r\nAECS Layout', 'Bengaluru', '560037');

-- --------------------------------------------------------

--
-- Table structure for table `em_driver_detail`
--

CREATE TABLE IF NOT EXISTS `em_driver_detail` (
  `sp_id` int(11) NOT NULL,
  `em_name` varchar(30) NOT NULL,
  `em_id` int(11) NOT NULL,
  `em_lno` varchar(20) NOT NULL,
  `em_DOB` date NOT NULL,
  `em_mno` varchar(10) NOT NULL,
  `em_gender` varchar(6) NOT NULL,
  `car_no` varchar(10) NOT NULL,
  `aadhar` varchar(12) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `em_driver_detail`
--

INSERT INTO `em_driver_detail` (`sp_id`, `em_name`, `em_id`, `em_lno`, `em_DOB`, `em_mno`, `em_gender`, `car_no`, `aadhar`) VALUES
(7, 'Ramesh.S', 8, 'WT3421883345210', '1992-06-10', '9345012101', 'male', 'KA09PK8392', '413210013002'),
(7, 'Suresh.R', 7, 'DL4311210399563', '1986-10-26', '9430521011', 'male', 'KA01LM4095', '210331103599'),
(8, 'Shyam Gopal', 9, 'KS1031311149893', '1985-06-22', '8315032105', 'male', 'KL65AL7003', '411230032997'),
(8, 'Ram Manohar', 10, 'TL3242410389311', '1991-03-04', '9717320531', 'male', 'KL10KR3298', '430129981122'),
(8, 'Ganesh', 11, 'RP3310448330491', '1990-07-11', '8905943613', 'male', 'KL53PR3458', '791299143210'),
(8, 'Pankaj', 12, 'TW4321123456789', '1989-04-08', '8881343201', 'male', 'KL30VA5843', '561636524701'),
(5, 'Raghu', 13, 'KJ1236547895698', '1990-02-23', '9548623541', 'male', 'KA17AM5646', '456123658974'),
(5, 'Amar', 14, 'LK2136547856952', '1988-03-12', '8653214569', 'male', 'KA97LR3548', '523641789654'),
(5, 'David', 15, 'IP5469872358964', '1992-04-05', '8754692365', 'male', 'KA32RO9900', '256412365478'),
(5, 'Jose', 16, 'LT2145698359741', '1993-09-20', '7456921456', 'male', 'KA01PS0007', '632541897541'),
(6, 'Gaurav', 17, 'HN5461236987569', '1990-12-12', '7411523653', 'male', 'GA19MH5105', '421500325870'),
(6, 'Shankar', 18, 'UI7896548200365', '1989-04-12', '8854695642', 'male', 'GA01RS4325', '521436985647'),
(6, 'Shekhar.N', 19, 'TY0036547895621', '1990-10-02', '9564823658', 'male', 'GA53HR2013', '400325621478'),
(6, 'Dhananjay', 20, 'HG1236522333654', '1987-12-05', '8102568632', 'male', 'GA31HT3141', '623901458003'),
(6, 'Harish', 21, 'TR300126478952', '1991-10-06', '9532687541', 'male', 'GA11BR1040', '321065489547');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `cust_eid` int(11) NOT NULL,
  `cust_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `experience` varchar(150) CHARACTER SET utf8 NOT NULL,
  `complaints` varchar(150) CHARACTER SET utf8 NOT NULL,
  `questions` varchar(150) CHARACTER SET utf8 NOT NULL,
  `suggestions` varchar(150) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `route_id` int(11) NOT NULL,
  `from_city` varchar(30) NOT NULL,
  `from_city_lat` double NOT NULL,
  `from_city_long` double NOT NULL,
  `to_city` varchar(30) NOT NULL,
  `to_city_lat` double NOT NULL,
  `to_city_long` double NOT NULL,
  `retRoute_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`route_id`, `from_city`, `from_city_lat`, `from_city_long`, `to_city`, `to_city_lat`, `to_city_long`, `retRoute_id`) VALUES
(1, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Kochi, Kerala', 9.938611, 76.3204337, 1),
(2, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Belagavi, Karnataka', 15.8667131, 74.5084405, 2),
(3, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Chennai, Tamil Nadu', 13.0475604, 80.2089535, 3),
(4, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Mangalore, Karnataka', 12.9229922, 74.8520892, 4),
(5, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Hyderabad, Telangana', 17.4123487, 78.4080455, 5),
(6, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Panaji, Goa', 15.4831457, 73.8212075, 6),
(7, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Hampi, Karnataka', 15.3331898, 76.4633347, 7),
(8, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Davangere, Karnataka', 14.4625633, 75.9162998, 8),
(9, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Hubli, Karnataka', 15.3645986, 75.109148, 9),
(11, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Vellore, Tamil Nadu', 12.8993087, 79.1183423, 11),
(10, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Krishnagiri, Tamil Nadu', 12.5259035, 78.20558, 10),
(12, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Chitradurga, Karnataka', 14.226801, 76.4000763, 12),
(13, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Tumakuru, Karnataka', 13.3496581, 77.097609, 13),
(14, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Hassan, Karnataka', 13.0126213, 76.1039847, 14),
(15, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Belur, Karnataka', 13.1641124, 75.8656231, 15),
(16, 'Bengaluru, Karnataka', 12.9673898, 77.7165813, 'Mysuru, Karnataka', 12.3106458, 76.6356898, 16),
(17, 'Kochi, Kerala', 9.938611, 76.3204337, 'Belagavi, Karnataka', 15.8667131, 74.5084405, 17),
(18, 'Kochi, Kerala', 9.938611, 76.3204337, 'Chennai, Tamil Nadu', 13.0475604, 80.2089535, 18);

-- --------------------------------------------------------

--
-- Table structure for table `search_criteria`
--

CREATE TABLE IF NOT EXISTS `search_criteria` (
  `returning` varchar(3) NOT NULL,
  `carpooling` varchar(3) NOT NULL,
  `from_city` varchar(30) NOT NULL,
  `to_city` varchar(30) NOT NULL,
  `date_arr` date NOT NULL,
  `time_arr` time NOT NULL,
  `date_ret` date NOT NULL,
  `time_ret` time NOT NULL,
  `no_of_pass` int(11) NOT NULL,
  `customer_eid` varchar(30) NOT NULL,
  `route_id` int(11) NOT NULL,
  `status_no` int(11) NOT NULL,
  `search_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `search_criteria`
--

INSERT INTO `search_criteria` (`returning`, `carpooling`, `from_city`, `to_city`, `date_arr`, `time_arr`, `date_ret`, `time_ret`, `no_of_pass`, `customer_eid`, `route_id`, `status_no`, `search_id`) VALUES
('no', 'no', 'Bengaluru, Karnataka', 'Panaji, Goa', '2015-05-15', '10:00:00', '0000-00-00', '00:00:00', 2, 'sonalhimanshu12@gmail.com', 6, 2, 24),
('no', 'no', 'Bengaluru, Karnataka', 'Kochi, Kerala', '2015-05-07', '15:00:00', '0000-00-00', '00:00:00', 1, 'sonalhimanshu12@gmail.com', 1, 2, 23);

-- --------------------------------------------------------

--
-- Table structure for table `service_provider`
--

CREATE TABLE IF NOT EXISTS `service_provider` (
  `sp_id` int(11) NOT NULL,
  `sp_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sp_eid` varchar(30) CHARACTER SET utf8 NOT NULL,
  `sp_lno` varchar(30) CHARACTER SET utf8 NOT NULL,
  `sp_mno` varchar(10) CHARACTER SET utf8 NOT NULL,
  `sp_city` varchar(30) CHARACTER SET utf8 NOT NULL,
  `sp_no_of_cars` int(11) NOT NULL,
  `sp_ownname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sp_add` varchar(100) CHARACTER SET utf8 NOT NULL,
  `sp_pass` varchar(30) CHARACTER SET utf8 NOT NULL,
  `sp_no_of_drivers` int(11) NOT NULL,
  `sp_aadhar` varchar(12) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_provider`
--

INSERT INTO `service_provider` (`sp_id`, `sp_name`, `sp_eid`, `sp_lno`, `sp_mno`, `sp_city`, `sp_no_of_cars`, `sp_ownname`, `sp_add`, `sp_pass`, `sp_no_of_drivers`, `sp_aadhar`) VALUES
(8, 'Alpine Cabs', 'r.prateek@rediffmail.com', 'SWL1708973', '9430531045', 'Kochi, Kerala', 4, 'Prateek R', 'Coast Town', '890rptk', 4, '321021213311'),
(7, 'Radha Travels', 's.reddy@gmail.com', 'PAV9141101', '8095512009', 'Bengaluru, Karnataka', 2, 'Srinivas Reddy', 'Yelahanka', '123srinivas', 2, '441133001103'),
(6, 'Konkan Rides', 'g.thomas@gmail.com', 'APC7125321', '8713254312', 'Panaji, Goa', 5, 'George Thomas', 'Church Street', 'thomas321', 5, '331120011122'),
(5, 'Laxmi Travels', 'rsmanjunath@yahoo.com', 'SWL1834531', '9473020591', 'Bengaluru, Karnataka', 4, 'Manjunath R S', 'AECS Layout', 'qwerty123', 4, '432112213300');

-- --------------------------------------------------------

--
-- Table structure for table `status_detail_2`
--

CREATE TABLE IF NOT EXISTS `status_detail_2` (
  `route_id` int(11) NOT NULL,
  `status_no` int(11) NOT NULL,
  `car_no` varchar(10) CHARACTER SET utf8 NOT NULL,
  `booking_no` int(11) NOT NULL,
  `payment_id` int(3) NOT NULL,
  `payment_amount` float NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_detail_2`
--

INSERT INTO `status_detail_2` (`route_id`, `status_no`, `car_no`, `booking_no`, `payment_id`, `payment_amount`) VALUES
(1, 2, 'KA17AM5646', 6, 1, 0),
(6, 2, 'GA19MH5105', 8, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_detail_3`
--

CREATE TABLE IF NOT EXISTS `status_detail_3` (
  `route_id` int(11) NOT NULL,
  `status_no` int(11) NOT NULL,
  `car_no` varchar(10) CHARACTER SET utf8 NOT NULL,
  `booking_no` int(11) NOT NULL,
  `retRoute_id` int(11) NOT NULL,
  `payment_id` int(3) NOT NULL,
  `payment_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status_detail_4`
--

CREATE TABLE IF NOT EXISTS `status_detail_4` (
  `route_id` int(11) NOT NULL,
  `status_no` int(11) NOT NULL,
  `car_no` varchar(10) NOT NULL,
  `booking_no` int(11) NOT NULL,
  `payment_id` int(3) DEFAULT NULL,
  `payment_amount` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status_detail_5`
--

CREATE TABLE IF NOT EXISTS `status_detail_5` (
  `route_id` int(11) NOT NULL,
  `status_no` int(11) NOT NULL,
  `car_no` varchar(10) CHARACTER SET utf8 NOT NULL,
  `booking_no` int(11) NOT NULL,
  `retRoute_id` int(11) NOT NULL,
  `payment_id` int(3) NOT NULL,
  `payment_amount` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`availability_id`);

--
-- Indexes for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD PRIMARY KEY (`booking_no`), ADD KEY `book_fkey1` (`customer_id`,`customer_eid`,`customer_mno`), ADD KEY `book_fkey2` (`car_no`), ADD KEY `book_fkey3` (`route_id`);

--
-- Indexes for table `car_detail`
--
ALTER TABLE `car_detail`
  ADD PRIMARY KEY (`car_no`), ADD KEY `car_fkey1` (`sp_id`);

--
-- Indexes for table `customer_detail`
--
ALTER TABLE `customer_detail`
  ADD PRIMARY KEY (`customer_id`,`customer_eid`,`customer_mno`);

--
-- Indexes for table `em_driver_detail`
--
ALTER TABLE `em_driver_detail`
  ADD PRIMARY KEY (`em_id`,`em_lno`,`aadhar`,`em_mno`), ADD KEY `driver_fkey1` (`sp_id`), ADD KEY `driver_fkey2` (`car_no`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`cust_eid`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `search_criteria`
--
ALTER TABLE `search_criteria`
  ADD PRIMARY KEY (`search_id`);

--
-- Indexes for table `service_provider`
--
ALTER TABLE `service_provider`
  ADD PRIMARY KEY (`sp_id`,`sp_lno`,`sp_aadhar`,`sp_mno`,`sp_eid`);

--
-- Indexes for table `status_detail_2`
--
ALTER TABLE `status_detail_2`
  ADD PRIMARY KEY (`car_no`), ADD UNIQUE KEY `booking_no` (`booking_no`), ADD UNIQUE KEY `payment_id` (`payment_id`), ADD KEY `stat2_fkey1` (`booking_no`), ADD KEY `stat2_fkey2` (`car_no`), ADD KEY `stat2_fkey3` (`route_id`);

--
-- Indexes for table `status_detail_3`
--
ALTER TABLE `status_detail_3`
  ADD PRIMARY KEY (`car_no`);

--
-- Indexes for table `status_detail_4`
--
ALTER TABLE `status_detail_4`
  ADD KEY `stat4_fkey1` (`booking_no`), ADD KEY `stat4_fkey2` (`car_no`), ADD KEY `stat4_fkey3` (`route_id`);

--
-- Indexes for table `status_detail_5`
--
ALTER TABLE `status_detail_5`
  ADD PRIMARY KEY (`car_no`), ADD KEY `stat5_fkey1` (`booking_no`), ADD KEY `stat5_fkey2` (`car_no`), ADD KEY `stat5_fkey3` (`route_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `availability_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `booking_detail`
--
ALTER TABLE `booking_detail`
  MODIFY `booking_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `customer_detail`
--
ALTER TABLE `customer_detail`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `em_driver_detail`
--
ALTER TABLE `em_driver_detail`
  MODIFY `em_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `search_criteria`
--
ALTER TABLE `search_criteria`
  MODIFY `search_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `service_provider`
--
ALTER TABLE `service_provider`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `status_detail_2`
--
ALTER TABLE `status_detail_2`
  MODIFY `payment_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
