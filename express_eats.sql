-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2022 at 12:24 PM
-- Server version: 5.7.24
-- PHP Version: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `express_eats`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `avg_rate` (IN `id` INT)   SELECT AVG(rating) AS avg_rate FROM ulasan WHERE id_menu = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `detail_pesanan` (IN `id` INT)   SELECT * FROM detail_pesanan JOIN pesanan ON detail_pesanan.id_pesanan = pesanan.id_pesanan JOIN menu ON detail_pesanan.id_menu = menu.id_menu WHERE  pesanan.id_pesanan = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `menu_terjual` (IN `id` INT)   SELECT SUM(jumlah) AS terjual FROM detail_pesanan JOIN pesanan ON detail_pesanan.id_pesanan = pesanan.id_pesanan WHERE detail_pesanan.id_menu = id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(3) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `password`) VALUES
(1, 'Febri Sutomo', 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` int(3) UNSIGNED ZEROFILL NOT NULL,
  `id_pesanan` int(3) UNSIGNED ZEROFILL NOT NULL,
  `id_menu` int(3) UNSIGNED ZEROFILL NOT NULL,
  `jumlah` int(3) NOT NULL,
  `sub_total` int(20) NOT NULL,
  `catatan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail`, `id_pesanan`, `id_menu`, `jumlah`, `sub_total`, `catatan`) VALUES
(001, 002, 001, 2, 30000, 'Jangan terlalu pedas'),
(002, 002, 002, 1, 25000, 'Kuahnya dipisah, jangan pakai kecap'),
(003, 002, 006, 1, 17000, ''),
(004, 003, 005, 2, 14000, ''),
(005, 004, 003, 1, 13000, ''),
(006, 004, 006, 1, 14000, '');

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id_fav` int(3) UNSIGNED ZEROFILL NOT NULL,
  `id_menu` int(3) UNSIGNED ZEROFILL NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorit`
--

INSERT INTO `favorit` (`id_fav`, `id_menu`, `username`) VALUES
(039, 001, 'masterchef');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(3) UNSIGNED ZEROFILL NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `img_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `img_kategori`) VALUES
(001, 'Fast Food', 'fastfood.png'),
(002, 'Dessert', 'dessert.png'),
(003, 'Drinks', 'drink.png'),
(004, 'Healthy', 'vegetable.png'),
(005, 'Meals', 'meals.png');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(3) UNSIGNED ZEROFILL NOT NULL,
  `id_kategori` int(3) UNSIGNED ZEROFILL NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga_menu` int(25) NOT NULL,
  `desc_menu` varchar(200) NOT NULL,
  `img_menu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `id_kategori`, `nama_menu`, `harga_menu`, `desc_menu`, `img_menu`) VALUES
(001, 001, 'Papperoni Pizza', 15000, 'Sebuah pizza hangat dengan tambahan papperoni.', '60c77319bc345.jpg'),
(002, 005, 'Beef Steak', 25000, 'Steak daging sapi dengan porsi untuk satu atau dua orang yang ingin share', 'beef-steak.jpg'),
(003, 001, 'Pizza', 13000, 'Sebuah pizza reguler tanpa adanya bumbu tambahan', '60cdd0a1891d2.jpg'),
(004, 005, 'Dimsum', 11000, 'Makanan khas daerah bambu yang dibuat dengan kulit ragi tipis yang membungkus isi yang menarik', 'menu.jpg'),
(005, 005, 'Fried Cake', 7000, 'Roti yang renyah dan sehat tanpa adanya kalori, cocok untuk yang sedang menjalankan diet', 'menu.jpg'),
(006, 001, 'Burger Combo', 17000, 'Paket burger dengan pendamping minuman dengan tambahan bumbu khas kamu', 'menu.jpg'),
(007, 004, 'Lettuce Salad', 10000, 'Salad sehat dengan nutrisi tinggi dan tanpa danya bahan pengawet', 'menu.jpg'),
(008, 001, 'French Burger', 19000, 'Burger khas perancis yang sangat menggoda dengan bumbu rahasia menambah cita rasa', 'menu.jpg'),
(009, 004, 'Baked Asparagus', 15000, 'Asparagus goreng untuk menemani kamu santai , selain sehat juga tanpa ada bahan pengawt', 'menu.jpg'),
(010, 004, 'Green and Brown', 12000, 'Salad dengan campuran daging sapi untuk menambahkan kandungan protein ke dalam salad yang sehat', 'menu.jpg'),
(011, 003, 'Ice Lemon Tea', 3000, 'Es Teh Lemon segar', 'menu.jpg'),
(012, 004, 'as', 0, 's', 'menu.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `img_pengguna` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `nama`, `email`, `no_hp`, `alamat`, `img_pengguna`) VALUES
('adi_novanto', '12345', 'Adi Novanto', 'adi.novanto@mhs.unsoed.ac.id', '085123000344', 'Jl. Cemara no.5 Semarang', 'avatar1.jpg'),
('antoniNugroho', 'admin', 'Antoni Nugroho', 'antoninugroho@gmail.com', '082300011283', 'Jl. Pramuka no.13, Banyumas.', 'avatar2.jpg'),
('masterchef', '1234', 'Master Chef', 'masterchef@gmail.com', '081234625891', 'Jl. Jenderal Soedirman, no.45, Purwokerto', 'avatar3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(3) UNSIGNED ZEROFILL NOT NULL,
  `username` varchar(50) NOT NULL,
  `tgl_pemesanan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` int(25) NOT NULL,
  `metode_pembayaran` enum('tunai','non tunai') NOT NULL,
  `bukti_pembayaran` varchar(100) DEFAULT NULL,
  `status` enum('menunggu','diproses','diantar','selesai') NOT NULL DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `username`, `tgl_pemesanan`, `total`, `metode_pembayaran`, `bukti_pembayaran`, `status`) VALUES
(002, 'adi_novanto', '2021-06-16 21:42:20', 72000, 'non tunai', 'struk1.jpg', 'selesai'),
(003, 'antoniNugroho', '2021-01-06 22:21:00', 17000, 'non tunai', 'struk2.jpg', 'diantar'),
(004, 'masterchef', '2021-06-16 22:27:09', 27000, 'non tunai', 'struk3.jpg', 'menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(3) UNSIGNED ZEROFILL NOT NULL,
  `id_menu` int(3) UNSIGNED ZEROFILL NOT NULL,
  `username` varchar(50) NOT NULL,
  `rating` float NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `tgl_ulasan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_menu`, `username`, `rating`, `deskripsi`, `tgl_ulasan`) VALUES
(001, 001, 'adi_novanto', 5, 'Sangat enak!', '2020-12-09'),
(002, 002, 'antoniNugroho', 4, 'Enak tapi masih perlu beberapa bumbu.', '2020-12-11'),
(003, 001, 'masterchef', 4, 'Terlihat menarik dan enak tetapi masih kurang cita rasa', '2020-12-12');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_menu`
-- (See below for the actual view)
--
CREATE TABLE `vw_menu` (
`id_menu` int(3) unsigned zerofill
,`id_kategori` int(3) unsigned zerofill
,`nama_menu` varchar(100)
,`harga_menu` int(25)
,`desc_menu` varchar(200)
,`img_menu` varchar(100)
,`nama_kategori` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_pesanan`
-- (See below for the actual view)
--
CREATE TABLE `vw_pesanan` (
`id_pesanan` int(3) unsigned zerofill
,`username` varchar(50)
,`tgl_pemesanan` datetime
,`total` int(25)
,`metode_pembayaran` enum('tunai','non tunai')
,`bukti_pembayaran` varchar(100)
,`status` enum('menunggu','diproses','diantar','selesai')
,`nama` varchar(100)
,`alamat` varchar(100)
,`email` varchar(50)
,`no_hp` varchar(15)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_menu`
--
DROP TABLE IF EXISTS `vw_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_menu`  AS SELECT `menu`.`id_menu` AS `id_menu`, `menu`.`id_kategori` AS `id_kategori`, `menu`.`nama_menu` AS `nama_menu`, `menu`.`harga_menu` AS `harga_menu`, `menu`.`desc_menu` AS `desc_menu`, `menu`.`img_menu` AS `img_menu`, `kategori`.`nama_kategori` AS `nama_kategori` FROM (`menu` join `kategori` on((`menu`.`id_kategori` = `kategori`.`id_kategori`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_pesanan`
--
DROP TABLE IF EXISTS `vw_pesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_pesanan`  AS SELECT `pesanan`.`id_pesanan` AS `id_pesanan`, `pesanan`.`username` AS `username`, `pesanan`.`tgl_pemesanan` AS `tgl_pemesanan`, `pesanan`.`total` AS `total`, `pesanan`.`metode_pembayaran` AS `metode_pembayaran`, `pesanan`.`bukti_pembayaran` AS `bukti_pembayaran`, `pesanan`.`status` AS `status`, `pengguna`.`nama` AS `nama`, `pengguna`.`alamat` AS `alamat`, `pengguna`.`email` AS `email`, `pengguna`.`no_hp` AS `no_hp` FROM (`pesanan` join `pengguna` on((`pesanan`.`username` = `pengguna`.`username`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_pesanan` (`id_pesanan`,`id_menu`) USING BTREE;

--
-- Indexes for table `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id_fav`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id_fav` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
