-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 12, 2024 at 06:15 AM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `createdAt`) VALUES
(1, 'Buku', 'AKTIF', '2024-03-08 23:00:29'),
(2, 'Pulpen', 'AKTIF', '2024-03-08 23:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`) VALUES
(1, 'Playgroup'),
(2, 'TK A'),
(3, 'TK B');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `statusID` int(11) DEFAULT NULL,
  `updateBy` int(11) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userID`, `productID`, `quantity`, `notes`, `statusID`, `updateBy`, `createdAt`) VALUES
(1, 5, 1, '11', 'Pinjam untuk 1 kelas', 5, NULL, '2024-03-11 03:02:57'),
(2, 5, 1, '11', '', 2, NULL, '2024-03-11 04:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `codeProduct` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `stock` varchar(255) DEFAULT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `status` enum('MENUNGGU','AKTIF','TIDAK_AKTIF') DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categoryID`, `codeProduct`, `name`, `image`, `description`, `stock`, `semester`, `status`, `createdBy`, `createdAt`) VALUES
(1, 1, 'BUKU01', 'BUKU BAHASA MANDARIN', '08032024164519_BUKU_BAHASA_MANDARIN.jpg', 'Buku ini mengandung pembelajaran bahasa mandarin', '10', NULL, 'AKTIF', 2, '2024-03-08 23:45:19'),
(2, 2, 'PUL01', 'PULPEN FASTER', '08032024182712_PULPEN_FASTER.jpg', 'Menulis cepat dengan pulpen faster', '26', NULL, 'AKTIF', 1, '2024-03-09 01:27:12'),
(3, 1, 'BUK02', 'BUKU PECINTA ALAM', '08032024184612_BUKU_PECINTA_ALAM.webp', 'Menghilangkan fikiran stres', '16', NULL, 'MENUNGGU', 2, '2024-03-09 01:46:12'),
(4, 2, 'PUL2829', 'PULPEN AJAIB', '12032024044331_PULPEN_AJAIB.jpg', 'Pulpen Ajaib banget ni', '25', 'Gasal', 'AKTIF', 1, '2024-03-12 11:43:31'),
(5, 1, 'BUK002', 'BUKU JEPANG', '12032024045044_BUKU_JEPANG.webp', 'Buku jepamg bagus nij', '15', 'Genap', 'MENUNGGU', 2, '2024-03-12 11:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'YAYASAN'),
(2, 'STAFF'),
(3, 'MURID');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `npsn` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `user_id`, `npsn`) VALUES
(1, 1, '08319819881');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Menunggu Persetujuan'),
(2, 'Peminjaman Disetujui'),
(3, 'Peminjaman Dikembalikan'),
(4, 'Peminjaman Tidak Diterima'),
(5, 'Peminjaman Dibatalkan');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nisn` varchar(25) DEFAULT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `user_id`, `nisn`, `class_id`) VALUES
(1, 2, '85849848', 1),
(2, 5, '', 3),
(3, 6, '123123123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `createdAt` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `status`, `createdAt`, `role_id`) VALUES
(1, 'Ujang Suragman', '085818189848', 'ujang@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'AKTIF', '2024-03-06 00:47:42', 1),
(2, 'Ujang Suratman', '085818189858', 'ujang2@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'AKTIF', '2024-03-06 00:49:18', 2),
(5, 'Ridwan Prayoga', '084588498840', 'ridwan@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'AKTIF', '2024-03-09 00:43:52', 3),
(6, 'Rusli', '085849489948', 'jawa@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'AKTIF', '2024-03-11 04:35:47', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
