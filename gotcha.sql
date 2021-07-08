-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 20, 2021 at 03:06 PM
-- Server version: 8.0.21
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gotcha`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `a_id` int NOT NULL,
  `a_username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `a_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `a_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `a_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`a_id`, `a_username`, `a_password`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_award`
--

CREATE TABLE `tbl_award` (
  `w_id` int NOT NULL,
  `w_qr` varchar(255) NOT NULL,
  `w_user_card` int NOT NULL,
  `w_shop` int NOT NULL,
  `w_point` int NOT NULL,
  `w_date` date NOT NULL,
  `w_time` time NOT NULL,
  `w_edate` date NOT NULL,
  `w_etime` time NOT NULL,
  `w_status` enum('1','2','0') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '1:created, 2:used, 0:cancel',
  `w_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `w_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `pk_id` int NOT NULL,
  `pk_shop_id` int NOT NULL,
  `pk_package` int NOT NULL,
  `pk_date` date NOT NULL,
  `pk_time` time NOT NULL,
  `pk_status` enum('1','2','0') NOT NULL DEFAULT '1' COMMENT '1:ยังไม่ได้ชำระเงิน, 2:ชำระเงินแล้ว, 0:ยกเลิก',
  `pk_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pk_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `pm_id` int NOT NULL,
  `pm_shop_id` int NOT NULL,
  `pm_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pm_tel` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pm_package` int NOT NULL,
  `pm_total` int NOT NULL,
  `pm_slip` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pm_note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pm_date` date NOT NULL,
  `pm_time` time NOT NULL,
  `pm_status` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `pm_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pm_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_point`
--

CREATE TABLE `tbl_point` (
  `p_id` int NOT NULL,
  `p_from` int NOT NULL COMMENT '1:shop_id, 2:card_id',
  `p_receive` int NOT NULL COMMENT '1:card_id, 2:card_id',
  `p_pay` int DEFAULT '0',
  `p_point` int NOT NULL,
  `p_type` enum('1','2') NOT NULL COMMENT '1:จากร้านค้า, 2:จากเพื่อน',
  `p_date` date NOT NULL,
  `p_time` time NOT NULL,
  `p_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_point_qr`
--

CREATE TABLE `tbl_point_qr` (
  `pq_id` int NOT NULL,
  `pq_qr` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pq_shop_id` int NOT NULL,
  `pq_pay` int NOT NULL,
  `pq_point` int NOT NULL,
  `pq_status` enum('1','2','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `pq_date` date NOT NULL,
  `pq_time` time NOT NULL,
  `pq_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pq_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promotion`
--

CREATE TABLE `tbl_promotion` (
  `p_id` int NOT NULL,
  `p_image` varchar(255) NOT NULL,
  `p_detail` text NOT NULL,
  `p_date` date NOT NULL,
  `p_time` time NOT NULL,
  `p_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop`
--

CREATE TABLE `tbl_shop` (
  `s_id` int NOT NULL,
  `s_line_user` varchar(255) NOT NULL,
  `s_line_img` varchar(255) DEFAULT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_email` varchar(100) NOT NULL,
  `s_tel` varchar(100) NOT NULL,
  `s_day` int NOT NULL,
  `s_month` varchar(50) NOT NULL,
  `s_year` int NOT NULL,
  `s_shop_name` varchar(255) NOT NULL,
  `s_shop_type` varchar(255) NOT NULL,
  `s_shop_branch` enum('1','2') NOT NULL,
  `s_shop_point` int NOT NULL,
  `s_shop_price` int NOT NULL,
  `s_shop_detail` text NOT NULL,
  `s_latitude` varchar(255) NOT NULL,
  `s_longitude` varchar(255) NOT NULL,
  `s_address_no` varchar(100) NOT NULL,
  `s_address_floor` varchar(100) NOT NULL,
  `s_address_company` varchar(255) NOT NULL,
  `s_address_detail` text NOT NULL,
  `s_card_style` int NOT NULL DEFAULT '1',
  `s_pin` varchar(10) DEFAULT NULL,
  `s_status` enum('0','1','2') NOT NULL DEFAULT '1',
  `s_date` date DEFAULT NULL,
  `s_pro` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1:Begin, 2:Premium, 3:Premium Plus',
  `s_expire` date NOT NULL,
  `s_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `s_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop_file`
--

CREATE TABLE `tbl_shop_file` (
  `sf_id` int NOT NULL,
  `sf_shop` int NOT NULL,
  `sf_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop_image`
--

CREATE TABLE `tbl_shop_image` (
  `si_id` int NOT NULL,
  `si_shop` int NOT NULL,
  `si_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `u_id` int NOT NULL,
  `u_line_user` varchar(255) NOT NULL,
  `u_line_img` varchar(255) DEFAULT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_tel` varchar(50) NOT NULL,
  `u_day` int NOT NULL,
  `u_month` varchar(20) NOT NULL,
  `u_year` varchar(11) NOT NULL,
  `u_date` date DEFAULT NULL,
  `u_pin` varchar(10) DEFAULT NULL,
  `u_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_card`
--

CREATE TABLE `tbl_user_card` (
  `uc_id` int NOT NULL,
  `uc_user_id` int NOT NULL,
  `uc_shop_id` int NOT NULL,
  `uc_point` int NOT NULL DEFAULT '0',
  `uc_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uc_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `tbl_award`
--
ALTER TABLE `tbl_award`
  ADD PRIMARY KEY (`w_id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`pk_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`pm_id`);

--
-- Indexes for table `tbl_point`
--
ALTER TABLE `tbl_point`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_point_qr`
--
ALTER TABLE `tbl_point_qr`
  ADD PRIMARY KEY (`pq_id`);

--
-- Indexes for table `tbl_promotion`
--
ALTER TABLE `tbl_promotion`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_shop`
--
ALTER TABLE `tbl_shop`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tbl_shop_file`
--
ALTER TABLE `tbl_shop_file`
  ADD PRIMARY KEY (`sf_id`);

--
-- Indexes for table `tbl_shop_image`
--
ALTER TABLE `tbl_shop_image`
  ADD PRIMARY KEY (`si_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `tbl_user_card`
--
ALTER TABLE `tbl_user_card`
  ADD PRIMARY KEY (`uc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `a_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_award`
--
ALTER TABLE `tbl_award`
  MODIFY `w_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `pk_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `pm_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_point`
--
ALTER TABLE `tbl_point`
  MODIFY `p_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_point_qr`
--
ALTER TABLE `tbl_point_qr`
  MODIFY `pq_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_promotion`
--
ALTER TABLE `tbl_promotion`
  MODIFY `p_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_shop`
--
ALTER TABLE `tbl_shop`
  MODIFY `s_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_shop_file`
--
ALTER TABLE `tbl_shop_file`
  MODIFY `sf_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_shop_image`
--
ALTER TABLE `tbl_shop_image`
  MODIFY `si_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `u_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_card`
--
ALTER TABLE `tbl_user_card`
  MODIFY `uc_id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
