-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 07:23 AM
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
-- Database: `finalproject_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `customerName` varchar(50) NOT NULL,
  `telephoneNumber` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `customerName`, `telephoneNumber`, `email`, `address`) VALUES
(1, 'DNA oil', '08114567891', 'dnaoil@gmail.com', 'Jl. Raya Perintis Kemerdekaan Desa Sukamulya'),
(2, 'Gaul Motor', '08114567892', 'gaulmotor@gmail.com', 'Jl. RH Didi Sukardi No. 171'),
(3, 'Aconk Motor', '08114567893', 'aconkmotor@gmail.com', 'Jl. Gunung Cupu No. 35');

-- --------------------------------------------------------

--
-- Stand-in structure for view `customer_orders_view`
-- (See below for the actual view)
--
CREATE TABLE `customer_orders_view` (
`customerID` int(11)
,`customerName` varchar(50)
,`id` int(11)
,`orderDate` date
);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(11) NOT NULL,
  `locationID` int(11) NOT NULL,
  `employeeName` varchar(50) NOT NULL,
  `employeePhone` varchar(50) NOT NULL,
  `employeeAddress` tinytext NOT NULL,
  `employeeDivision` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `locationID`, `employeeName`, `employeePhone`, `employeeAddress`, `employeeDivision`, `password`) VALUES
(1, 1, 'John Doe', '081812345678', 'Jl.Gading Boulevard', 'Sales', '636Nxq'),
(2, 2, 'Jim Doe', '081812345679', 'Jl.Bandeng', 'Sales', '26tTW9'),
(3, 3, 'Jane Doe', '081812345670', 'Jl.Siliwangi', 'Sales', '7Bc3d3'),
(4, 1, 'Joan Doe', '081812345671', 'Jl.Dewi Sartika', 'Management', 'tqM726');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `invoiceDue` date NOT NULL,
  `paidStatus` enum('Unpaid','Paid') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceID`, `orderID`, `amount`, `invoiceDue`, `paidStatus`) VALUES
(1, 1, 2460000, '2023-09-10', 'Paid'),
(2, 2, 1750000, '2023-09-20', 'Unpaid'),
(3, 3, 1925000, '2023-09-18', 'Paid'),
(4, 4, 4206000, '2023-09-29', 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locationID` int(11) NOT NULL,
  `locationName` varchar(50) NOT NULL,
  `locationAddress` tinytext NOT NULL,
  `locationContact` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationID`, `locationName`, `locationAddress`, `locationContact`, `capacity`) VALUES
(1, 'Bandung', 'Jl. Sirna Rasa No. 11', '022123456', 10000),
(2, 'Sukabumi', 'Jl. Asalaja', '022123457', 19000),
(3, 'Tasikmalaya', 'Jl. Tersrah No.4', '022123458', 8700);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `priceForEach` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`orderID`, `productID`, `qty`, `priceForEach`) VALUES
(1, 1, 20, 123000),
(2, 3, 50, 35000),
(3, 2, 25, 77000),
(4, 1, 12, 77000),
(4, 4, 42, 123000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `orderTotalPrice` double NOT NULL,
  `orderStatus` enum('Ongoing','Finished','Cancelled') DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customerID`, `employeeID`, `orderDate`, `orderTotalPrice`, `orderStatus`, `notes`) VALUES
(1, 3, 2, '2023-07-12', 2460000, 'Ongoing', ''),
(2, 2, 1, '2023-07-14', 1750000, 'Cancelled', 'Customer found another supplier'),
(3, 2, 1, '2023-07-18', 1925000, 'Finished', 'Please separate products'),
(4, 1, 3, '2023-07-23', 4206000, 'Ongoing', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `paymentDate` date NOT NULL,
  `paymentType` enum('Cash','Credit') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `invoiceID`, `amount`, `paymentDate`, `paymentType`) VALUES
(10, 1, 2460000, '2023-09-08', 'Credit'),
(11, 2, 1000000, '2023-07-15', 'Cash'),
(12, 3, 1925000, '2023-07-18', 'Credit'),
(13, 4, 1500000, '2023-07-28', 'Cash'),
(14, 4, 1000000, '2023-08-10', 'Cash');

-- --------------------------------------------------------

--
-- Stand-in structure for view `payment_value_`
-- (See below for the actual view)
--
CREATE TABLE `payment_value_` (
`paymentID` int(11)
,`amount` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `sellingPrice` int(11) NOT NULL,
  `productType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `supplierID`, `productName`, `stock`, `sellingPrice`, `productType`) VALUES
(1, 1, 'Repsol GXR Platinum SAE', 1152, 123000, '4-wheel'),
(2, 1, 'Repsol CVTF NS-2 12x1L', 384, 77000, '4-wheel'),
(3, 2, 'Federal Ultratec 20W50 24x0.8L', 4800, 35000, '2-wheel'),
(4, 2, 'Federal Racing Matic 10W-40 6x1', 480, 65000, '2-wheel');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder`
--

CREATE TABLE `purchaseorder` (
  `id` int(11) NOT NULL,
  `locationID` int(50) NOT NULL,
  `purchaseDate` date NOT NULL,
  `totalPrice` int(50) NOT NULL,
  `expectedArrival` date NOT NULL,
  `purchaseStatus` enum('Ongoing','Finished','Cancelled') DEFAULT 'Ongoing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchaseorder`
--

INSERT INTO `purchaseorder` (`id`, `locationID`, `purchaseDate`, `totalPrice`, `expectedArrival`, `purchaseStatus`) VALUES
(1, 1, '2023-07-19', 4620000, '2023-08-18', 'Finished'),
(2, 2, '2023-08-04', 6545000, '2023-09-03', 'Ongoing'),
(3, 2, '2023-09-20', 6583000, '2023-10-20', 'Ongoing'),
(4, 3, '2023-12-29', 18006, '2024-02-27', 'Ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorderdetails`
--

CREATE TABLE `purchaseorderdetails` (
  `purchaseOrderID` int(50) NOT NULL,
  `productID` int(50) NOT NULL,
  `qty` int(50) NOT NULL,
  `priceForEach` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchaseorderdetails`
--

INSERT INTO `purchaseorderdetails` (`purchaseOrderID`, `productID`, `qty`, `priceForEach`) VALUES
(1, 2, 60, 77000),
(2, 2, 85, 77000),
(3, 1, 100, 35000),
(3, 3, 90, 35000),
(4, 1, 3, 1002),
(4, 3, 1, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(50) NOT NULL,
  `supplierAddress` tinytext NOT NULL,
  `supplierContact` varchar(50) NOT NULL,
  `paymentTerms` varchar(50) NOT NULL,
  `additionalInformation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `supplierName`, `supplierAddress`, `supplierContact`, `paymentTerms`, `additionalInformation`) VALUES
(1, 'PT.Pacific Lubritama Indonesia', 'Jl.Kapuk Kamal Raya No.23 B', '08114567894', '60', '4-wheel supplier'),
(2, 'PT.Federal Indonesia', 'Jl.Federal No.14', '08114567895', '60', '2-wheel supplier');

-- --------------------------------------------------------

--
-- Table structure for table `temp_order`
--

CREATE TABLE `temp_order` (
  `id` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `priceForEach` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_purchase`
--

CREATE TABLE `temp_purchase` (
  `id` int(11) NOT NULL,
  `purchaseOrderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `priceForEach` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `customer_orders_view`
--
DROP TABLE IF EXISTS `customer_orders_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `customer_orders_view`  AS SELECT `c`.`customerID` AS `customerID`, `c`.`customerName` AS `customerName`, `o`.`id` AS `id`, `o`.`orderDate` AS `orderDate` FROM (`customer` `c` join `orders` `o` on(`c`.`customerID` = `o`.`customerID`)) WHERE `c`.`customerID` = 3 ;

-- --------------------------------------------------------

--
-- Structure for view `payment_value_`
--
DROP TABLE IF EXISTS `payment_value_`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `payment_value_`  AS SELECT `payment`.`paymentID` AS `paymentID`, `payment`.`amount` AS `amount` FROM `payment` WHERE `payment`.`amount` > 1000000 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`),
  ADD KEY `locationID` (`locationID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`orderID`,`productID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employeeID` (`employeeID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `invoiceID` (`invoiceID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `supplierID` (`supplierID`);

--
-- Indexes for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locationID` (`locationID`);

--
-- Indexes for table `purchaseorderdetails`
--
ALTER TABLE `purchaseorderdetails`
  ADD PRIMARY KEY (`purchaseOrderID`,`productID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `temp_order`
--
ALTER TABLE `temp_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_order` (`productID`);

--
-- Indexes for table `temp_purchase`
--
ALTER TABLE `temp_purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temp_product` (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_order`
--
ALTER TABLE `temp_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_purchase`
--
ALTER TABLE `temp_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`locationID`) REFERENCES `location` (`locationID`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`id`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`invoiceID`) REFERENCES `invoice` (`invoiceID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`);

--
-- Constraints for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  ADD CONSTRAINT `purchaseorder_ibfk_1` FOREIGN KEY (`locationID`) REFERENCES `location` (`locationID`);

--
-- Constraints for table `purchaseorderdetails`
--
ALTER TABLE `purchaseorderdetails`
  ADD CONSTRAINT `purchaseorderdetails_ibfk_1` FOREIGN KEY (`purchaseOrderID`) REFERENCES `purchaseorder` (`id`),
  ADD CONSTRAINT `purchaseorderdetails_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `temp_order`
--
ALTER TABLE `temp_order`
  ADD CONSTRAINT `product_order` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `temp_purchase`
--
ALTER TABLE `temp_purchase`
  ADD CONSTRAINT `temp_product` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
