-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2023 at 06:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight`
--

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `airline_name` varchar(50) NOT NULL,
  `contact_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`airline_name`, `contact_no`) VALUES
('Biman Bangladesh', 1711612124),
('Novoair', 1309616466),
('US Bangla', 1309612124);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `origin` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `passport_no` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `food` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `flight_id` varchar(40) NOT NULL,
  `NID` int(17) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  `booking_date` date NOT NULL,
  `price` int(11) NOT NULL,
  `origin` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `flight_id`, `NID`, `name`, `email`, `booking_date`, `price`, `origin`, `destination`) VALUES
(10, '', 333333, 'Adib', 'adib.orpo@gmail.com', '2023-08-01', 5000, 'Dhaka', 'Chittagong'),
(14, 'BB2', 55557777, 'Adib', 'adib.orpo@gmail.com', '2023-08-18', 69000, 'Dhaka', 'Sirajgonj'),
(15, 'NV30', 9999999, 'Adib', 'adib.orpo@gmail.com', '2023-08-30', 6969, 'Chittagong', 'Sirajgonj'),
(16, 'BB25', 777777, 'Adib', 'adib.orpo@gmail.com', '2023-08-25', 9900, 'Chittagong', 'Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_type` varchar(50) NOT NULL,
  `fare` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_type`, `fare`) VALUES
('Business', 5000),
('Economy', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `flight_id` int(11) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `departure_date` date NOT NULL,
  `arrival_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flights_origin_destination`
--

CREATE TABLE `flights_origin_destination` (
  `origin` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `flight_name` varchar(100) NOT NULL,
  `flight_id` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights_origin_destination`
--

INSERT INTO `flights_origin_destination` (`origin`, `destination`, `date`, `flight_name`, `flight_id`, `price`) VALUES
('Dhaka', 'Chittagong', '2023-08-25', 'US Bangla', 'UB1', 4500),
('Dhaka', 'Sirajgonj', '2023-08-26', 'Biman Bangladesh', 'BB1', 3300),
('Chittagong', 'Dhaka', '2023-08-27', 'Novoair', 'NV1', 2500),
('Sirajgonj', 'Chittagong', '2023-08-30', 'US Bangla', 'UB2', 2500),
('Dhaka', 'Sirajgonj', '2023-08-18', 'Biman Bangladesh', 'BB2', 69000),
('Chittagong', 'Sirajgonj', '2023-08-30', 'Novoair', 'NV30', 6969),
('Chittagong', 'Dhaka', '2023-08-25', 'Biman Bangladesh', 'BB25', 9900),
('Chittagong', 'Dhaka', '2023-08-25', 'Novoair', 'NV25', 9500);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_name`, `price`) VALUES
('beef', 150),
('chicken', 100),
('vegetables', 80);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `passport_no` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `luggage_rate` int(11) NOT NULL,
  `food_price` int(11) NOT NULL,
  `fare` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`name`, `date_of_birth`, `email`, `phone`, `password`, `user_id`) VALUES
('', '0000-00-00', '', 0, '0000', 'admin'),
('popi', '2023-08-04', 'popi@lala.com', 1356987454, 'wdvcc', 'poop'),
('gyygyg', '2023-08-07', 'cddgdgd@vhnvnh', 1758741314, '9876', 'poopo'),
('Adib', '2023-08-01', 'adib.reza@g.bracu.ac.bd', 2147483647, '9949494', 'poopy'),
('Sakib', '2023-08-19', 'sakib@gmail.com', 171169, '12345', 'saaakib');

-- --------------------------------------------------------

--
-- Table structure for table `seat_bookings`
--

CREATE TABLE `seat_bookings` (
  `passenger_id` int(11) NOT NULL,
  `passenger_name` varchar(255) NOT NULL,
  `row` int(11) NOT NULL,
  `seat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seat_bookings`
--

INSERT INTO `seat_bookings` (`passenger_id`, `passenger_name`, `row`, `seat`) VALUES
(0, 'YOUR_NAME', 4, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`airline_name`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`passport_no`),
  ADD KEY `class` (`class`),
  ADD KEY `food` (`food`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_type`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flight_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_name`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`passport_no`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `seat_bookings`
--
ALTER TABLE `seat_bookings`
  ADD PRIMARY KEY (`passenger_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`passport_no`) REFERENCES `register` (`user_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`class`) REFERENCES `class` (`class_type`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`food`) REFERENCES `food` (`food_name`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`passport_no`) REFERENCES `booking` (`passport_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
