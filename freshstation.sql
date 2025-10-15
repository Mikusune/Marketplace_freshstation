-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2025 at 03:03 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freshstation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `nama_admin` varchar(120) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tgl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `Title`, `Deskripsi`, `foto`, `tgl`) VALUES
(2, 'Rental Mobil Bulanan di Jakarta', '<h1 style=\"text-align:center\">Rental Mobil Bulanan Jakarta</h1>\r\n\r\n<p style=\"text-align:justify\">Rental Mobil Bulanan di Jakarta. Armada lengkap terawat. Supir Ramah &amp; Profesional, Bisa Lepas Kunci. Asikrentcars&nbsp;atau Asikrentcars&nbsp; merupakan salah satu perusahaan layanan transportasi profesional yang menyediakan jasa penyewaan kendaraan serta layanan pengemudi di Jakarta.&nbsp;Selain sebagai penyedia jasa sewa kendaraan,&nbsp;kami juga menawarkan kerja sama yang saling menguntungkan, yaitu membuka penitipan kendaraan untuk disewakan. Anda bisa mendapatkan penghasilan bersih setiap bulan tanpa melakukan apa-apa, cukup dengan menitipkan kendaraan anda di tempat kami untuk digunakan sebagai kendaraan rental. Untuk info lebih detail silahkan hubungi kami.</p>\r\n\r\n<p>RENTAL MOBIL HARIAN, RENTAL MOBIL MINGGUAN, RENTAL MOBIL BULANAN, RENTAL MOBIL SEJABODETABEK.</p>\r\n\r\n<p><strong>Rental Mobil Lepas Kunci</strong></p>\r\n\r\n<p>Bebas pergi ke mana pun dan bebas atur waktu perjalanan Anda dengan&nbsp;sewa mobil bulanan di jakarta. Tenang saja, keamanan Anda tetap terjaga dengan jaminan kondisi mobil prima dan asuransi perjalanan. Pilih paket rental 12 jam atau perday 18 jam dengan opsi tambahan waktu atau trip keluar kota sesuai keperluan Anda.</p>\r\n\r\n<p><strong>Rental Mobil dengan Pengemudi</strong></p>\r\n\r\n<p>Ingin duduk santai menikmati perjalanan tanpa harus menyetir mobil sendiri. Manfaatkan sewa mobil dengan layanan pengemudi dari Asikrentcars&nbsp;. Layanan ini sudah termasuk sewa mobil, layanan pengemudi, asuransi perjalanan, biaya bensin, tol, dan parkir. Pengemudi andal kami akan menjemput dan mengantarkan Anda sampai ke tujuan dengan mengedepankan ketepatan waktu juga layanan yang ramah dan profesional. Pilih paket sesuai kebutuhan Anda: 12 jam atau 18 jam.</p>\r\n\r\n<p><strong>Hubungi : </strong>+62 813-81945880</p>\r\n', 'f781188e0b6d381443b74993fe8acc8e.jpg', '2020-07-08'),
(3, 'Sewa Mobil di Jakarta Dengan Supir', '<h1 style=\"text-align:center\">Sewa Mobil Jakarta Dengan Supir</h1>\r\n\r\n<p>RENTAL MOBIL HARIAN, RENTAL MOBIL MINGGUAN, RENTAL MOBIL BULANAN, RENTAL MOBIL SEJABODETABEK.</p>\r\n\r\n<ul>\r\n	<li><strong>Rental Mobil Lepas Kunci</strong>&nbsp;Bebas pergi ke mana pun dan bebas atur waktu perjalanan Anda dengan&nbsp;rental mobil jakarta timur. Tenang saja, keamanan Anda tetap terjaga dengan jaminan kondisi mobil prima dan asuransi perjalanan. Pilih paket rental 12 jam atau perday 18 jam dengan opsi tambahan waktu atau trip keluar kota sesuai keperluan Anda.</li>\r\n	<li><strong>Rental Mobil dengan Pengemudi</strong>&nbsp;Ingin duduk santai menikmati perjalanan tanpa harus menyetir mobil sendiri. Manfaatkan Asikrentcars&nbsp;dengan layanan pengemudi dari Asikrentcars. Layanan ini sudah termasuk sewa mobil, layanan pengemudi, asuransi perjalanan, biaya bensin, tol, dan parkir. Pengemudi andal kami akan menjemput dan mengantarkan Anda sampai ke tujuan dengan mengedepankan ketepatan waktu juga layanan yang ramah dan profesional. Pilih paket sesuai kebutuhan Anda: 12 jam atau 18 jam.</li>\r\n</ul>\r\n\r\n<p><strong>Hubungi : +62 813-8194-5880</strong></p>\r\n\r\n<p>Berikut jenis mobil yang kami sewakan adalah:</p>\r\n\r\n<ol>\r\n	<li><strong>Mobil keluarga MPV</strong>&nbsp;Toyota Innova Reborn, Kijang Innova Luxury, Toyota Avanza, Daihatsu Xenia, Honda Mobilio, Suzuki Ertiga, Suzuki APV, Daihatsu Grandmax, Daihatsu Luxio, Nissan Grand Livina,</li>\r\n	<li><strong>Mobil City Car</strong>&nbsp;Honda Jazz, Toyota Yaris, Honda Brio, Suzuki Swift.</li>\r\n	<li><strong>Mobil Sedan</strong>&nbsp;Honda City, Toyota Vios, dan Corolla</li>\r\n	<li><strong>Mobil Premium</strong>&nbsp;Toyota Alphard, Vellfire, Toyota Camry, BMW, Mercedes Benz (Mercy)</li>\r\n	<li><strong>Mobil SUV</strong>&nbsp;Mitsubishi Pajero Sport, Toyota Fortuner, Lexus, Range Rover, Honda HR-V dan CR-V</li>\r\n	<li><strong>Mobil Pariwisata &nbsp;</strong>Hiace, Isuzu Elf, Bus 3/4 (medium), HDD maupun SHD dengan kapasitas 20-60 penumpang.</li>\r\n</ol>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp;Segera hubungi kami untuk mendapatkan informasi mengenai sewa mobil murah dengan Asikrentcars, berkualitas dan terlengkap kami siap melayani anda 24 jam.</p>\r\n\r\n<p>RENTAL MOBIL DENGAN PENGEMUDI</p>\r\n\r\n<p>Ingin duduk santai menikmati perjalanan tanpa harus menyetir mobil sendiri. Manfaatkan sewa mobil dengan layanan pengemudi dari Asikrentcars. Layanan ini sudah termasuk sewa mobil, layanan pengemudi, asuransi perjalanan, biaya bensin, tol, dan parkir. Pengemudi andal kami akan menjemput dan mengantarkan Anda sampai ke tujuan dengan mengedepankan ketepatan waktu juga layanan yang ramah dan profesional. Pilih paket sesuai kebutuhan Anda: 12 jam atau 24 jam.</p>\r\n', '2b12b40099f83ab6e1f9f5c147a38995.jpg', '2020-07-08'),
(4, 'ps5 pro akan keluar', '<p style=\"text-align:center\">Ps 5Pro&nbsp;</p>\r\n', '9c3653339b0e85ecb9cf762faf4283e5.jpeg', '2024-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'admin', NULL, '2025-02-06 06:02:13', 0),
(2, '::1', 'admin', NULL, '2025-02-06 06:03:34', 0),
(3, '::1', 'admin', NULL, '2025-02-06 06:05:00', 0),
(4, '::1', 'admin@gmail.com', NULL, '2025-02-06 06:30:56', 0),
(5, '::1', 'admin', NULL, '2025-02-06 16:24:54', 0),
(6, '::1', 'Admin123', NULL, '2025-02-06 16:35:27', 0),
(7, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 16:35:49', 1),
(8, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:01:26', 1),
(9, '::1', 'admin', NULL, '2025-02-06 17:02:52', 0),
(10, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:03:06', 1),
(11, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:05:10', 1),
(12, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:09:27', 1),
(13, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:10:00', 1),
(14, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:18:43', 1),
(15, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:34:15', 1),
(16, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:43:48', 1),
(17, '::1', 'Admin123', NULL, '2025-02-06 17:47:39', 0),
(18, '::1', 'Admin123', NULL, '2025-02-06 17:47:48', 0),
(19, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:47:59', 1),
(20, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:51:30', 1),
(21, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:51:56', 1),
(22, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 20:34:56', 1),
(23, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 21:21:18', 1),
(24, '::1', 'Admin123', NULL, '2025-02-07 13:30:50', 0),
(25, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-07 13:30:58', 1),
(26, '::1', 'Admin123', NULL, '2025-02-08 06:39:24', 0),
(27, '::1', 'Admin123', NULL, '2025-02-08 06:39:32', 0),
(28, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-08 06:39:41', 1),
(29, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-08 07:43:58', 1),
(30, '::1', 'Admin123', NULL, '2025-02-08 08:58:13', 0),
(31, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-08 08:58:20', 1),
(32, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-09 06:20:21', 1),
(33, '::1', 'admin', NULL, '2025-04-02 07:34:42', 0),
(34, '::1', 'admin', NULL, '2025-04-02 07:34:47', 0),
(35, '::1', 'admin', NULL, '2025-04-02 07:37:35', 0),
(36, '::1', 'admin', NULL, '2025-04-02 07:37:37', 0),
(37, '::1', 'admin', NULL, '2025-04-02 07:38:57', 0),
(38, '::1', 'admin', NULL, '2025-04-02 07:39:00', 0),
(39, '::1', 'admin', NULL, '2025-04-02 07:39:10', 0),
(40, '::1', 'admin', NULL, '2025-04-02 07:39:16', 0),
(41, '::1', 'admin', NULL, '2025-04-02 07:39:18', 0),
(42, '::1', 'admin', NULL, '2025-04-02 07:39:21', 0),
(43, '::1', 'Admin123', NULL, '2025-04-02 07:39:28', 0),
(44, '::1', 'mury', NULL, '2025-04-02 07:39:35', 0),
(45, '::1', 'mury', NULL, '2025-04-02 07:39:37', 0),
(46, '::1', 'Admin123', NULL, '2025-04-02 07:40:00', 0),
(47, '::1', 'Admin123', NULL, '2025-04-02 07:40:05', 0),
(48, '::1', 'Admin123', NULL, '2025-04-02 07:40:10', 0),
(49, '::1', 'Admin123', NULL, '2025-04-02 07:40:18', 0),
(50, '::1', 'Admin123', NULL, '2025-04-02 07:40:23', 0),
(51, '::1', 'Admin123', NULL, '2025-04-02 07:40:26', 0),
(52, '::1', 'Admin123', NULL, '2025-04-02 07:40:31', 0),
(53, '::1', 'Admin123', NULL, '2025-04-02 07:40:36', 0),
(54, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:41:33', 0),
(55, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:53:26', 0),
(56, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:53:33', 0),
(57, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:53:38', 0),
(58, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:53:43', 0),
(59, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:53:50', 0),
(60, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:53:57', 0),
(61, '::1', 'admin', NULL, '2025-04-02 07:56:07', 0),
(62, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:56:55', 0),
(63, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:57:03', 0),
(64, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:57:12', 0),
(65, '::1', 'Admin123', NULL, '2025-04-02 07:58:21', 0),
(66, '::1', 'Admin123', NULL, '2025-04-02 07:58:40', 0),
(67, '::1', 'Admin123', NULL, '2025-04-02 07:58:48', 0),
(68, '::1', 'admin', NULL, '2025-04-02 08:06:23', 0),
(69, '::1', 'admin123', NULL, '2025-04-02 08:07:07', 0),
(70, '::1', 'mury', 3, '2025-04-02 08:07:48', 0),
(71, '::1', 'admin@admin.com', 3, '2025-04-02 08:08:30', 1),
(72, '::1', 'admin@admin.com', 3, '2025-04-02 17:04:11', 1),
(73, '::1', 'admin@admin.com', 3, '2025-04-03 07:37:59', 1),
(74, '::1', 'admin@admin.com', 3, '2025-04-03 12:52:35', 1),
(75, '::1', 'admin@admin.com', 3, '2025-04-03 18:07:40', 1),
(76, '::1', 'admin@admin.com', 3, '2025-04-04 00:17:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hashedValidator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int NOT NULL,
  `nama` varchar(120) NOT NULL,
  `nama_rental` varchar(120) NOT NULL,
  `username` varchar(120) NOT NULL,
  `alamat` varchar(120) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `no_ktp` varchar(50) NOT NULL,
  `password` varchar(120) NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `nama_rental`, `username`, `alamat`, `gender`, `no_telp`, `no_ktp`, `password`, `role_id`) VALUES
(6, 'Admin', '', 'admin', 'admin', 'Laki-laki', '000', '000', '21232f297a57a5a743894a0e4a801fc3', 1),
(22, 'Spartan Playstation', 'Spartan Playstation', 'spartan', 'Jl. H. Gari, Pesanggrahan, Kec. Pesanggrahan, Kota Jakarta Selatan', 'Laki-laki', '085715863901', '3098876782146782', '202cb962ac59075b964b07152d234b70', 3),
(23, 'Rental Arafah', 'Rental Arafah Playstation', 'arafah', 'Jl. Keadilan Raya No.411, Bakti Jaya, Kec. Sukmajaya, Kota Depok, Jawa Barat 16417', 'Laki-laki', '089545464623', '3467812364784443003', '202cb962ac59075b964b07152d234b70', 3),
(25, 'efra', '', 'efra', 'jalan dongkal', 'Laki-laki', '0787756387562', '3871249634342', '202cb962ac59075b964b07152d234b70', 2),
(26, 'seva', '', 'seva', 'jalan kapitan', 'Laki-laki', '087657526622', '37867867873', '202cb962ac59075b964b07152d234b70', 2),
(27, 'alzora', '', 'alzora', 'jalan jatijajar', 'Laki-laki', '089565432230', '30087677866899', '202cb962ac59075b964b07152d234b70', 2),
(28, 'mury', '', 'mury', 'jalan saudara rt 04 rw 010 no 11a', 'Laki-laki', '089530807615', '39089073444', '202cb962ac59075b964b07152d234b70', 2),
(29, 'mikusune', '', 'miku', 'jalan kemang', 'Perempuan', '087655433324', '39078978964', '202cb962ac59075b964b07152d234b70', 2),
(30, 'tri', '', 'tri', 'DEPOK', 'Laki-laki', '089530987654', '3993837255264', '202cb962ac59075b964b07152d234b70', 2),
(31, 'R.A Gaming', 'R.A Gaming', 'ragaming', 'Jl. Merdeka No.22, Depok Timur, Abadijaya, Kec. Sukmajaya, Kota Depok, Jawa Barat 16417', 'Laki-laki', '0811826577', '21783467836278163891798', '202cb962ac59075b964b07152d234b70', 3);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int NOT NULL,
  `nama_produk` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_type` varchar(120) NOT NULL,
  `brand` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `berat` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(50) NOT NULL,
  `harga` int NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` varchar(5000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `nama_produk`, `kode_type`, `brand`, `berat`, `status`, `harga`, `gambar`, `deskripsi`) VALUES
(35, 'daging sapi potong', 'dg', 'lokal', '1kg', '1', 120000, '1743730319_f81201622943133ff00c.jpg', '-'),
(36, 'apel fuji', 'buh', 'lokal', '1kg', '1', 12000, '1743747986_47cf038f7f9f19b94179.jpeg', '-'),
(37, 'ikan tenggiri', 'ikn', 'lokal', '1kg', '1', 70000, '1743748032_f2595aeee45014954c93.jpeg', '-');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_mess` int NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Telp` varchar(255) NOT NULL,
  `Pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_mess`, `Nama`, `Email`, `Telp`, `Pesan`) VALUES
(1, 'Ahmad Subadri', 'ahmadsubadri08@gmail.com', '085268929843', 'Pelayananya sangat nyaman, dan kendaraanya juga nyaman untuk digunakan berkendara di dalam atauoun luar kota'),
(3, 'efra', 'efradwi@gmail.com', '097652356723', 'kurang murah'),
(4, 'mury', 'trimuryanto78@gmail.com', '089530807615', 'mantap');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1738816392, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id_payment` int NOT NULL,
  `nama_payment` varchar(120) NOT NULL,
  `key_payment` varchar(120) NOT NULL,
  `atas_nama` varchar(120) DEFAULT NULL,
  `nama_rental` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id_payment`, `nama_payment`, `key_payment`, `atas_nama`, `nama_rental`) VALUES
(2, 'Bank BRI', '42367482374', 'Mang Group', 'Jaya Rental'),
(3, 'Bank Kai', '123', NULL, 'Murah Rental'),
(6, 'nro', 'ljk', NULL, 'Murah Rental'),
(7, 'jkjk', '899', 'fdsfs', 'Murah Rental'),
(8, 'Paypal', 'mang@mangkok.com', 'Mang Group', 'Jaya Rental'),
(9, 'BANK BRI', '478657865432656', 'Sejahtera Travel', 'Sejahtera Travel'),
(10, 'DANA', '08115656777', 'Sejahtera Travel', 'Sejahtera Travel'),
(11, 'OVO', '08115656777', 'Sejahtera Travel', 'Sejahtera Travel'),
(12, 'BANK BNI', '2367489773', 'Sejahtera Travel', 'Sejahtera Travel'),
(13, 'BANK MANDIRI', '3493439897432', 'Sejahtera Travel', 'Sejahtera Travel'),
(14, 'BANK BRI', '324349897689743', 'Permata Rental', 'Permata Rental'),
(15, 'BANK BNI', '2487539893', 'Permata Rental', 'Permata Rental'),
(16, 'BANK BRI', '47254587854765', 'Putra Riau Travel', 'Putra Riau Travel'),
(17, 'BANK BNI', '5247698584', 'Putra Riau Travel', 'Putra Riau Travel'),
(18, 'BANK MANDIRI', '4373487899322', 'Putra Riau Travel', 'Putra Riau Travel'),
(19, 'Bank BCA', '23678216478623', 'Efra Dwi', 'Spartan Playstation');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id_rental` int NOT NULL,
  `id_customer` int NOT NULL,
  `tanggal_rental` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status_rental` varchar(50) NOT NULL,
  `status_pengembalian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_rental` int NOT NULL,
  `id_customer` int NOT NULL,
  `id_ps` int NOT NULL,
  `nama_rental` varchar(120) NOT NULL,
  `tanggal_rental` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `harga` int NOT NULL,
  `denda` int NOT NULL,
  `total_denda` varchar(120) NOT NULL DEFAULT '0',
  `tanggal_pengembalian` date NOT NULL,
  `status_pengembalian` varchar(50) NOT NULL,
  `status_rental` varchar(50) NOT NULL,
  `bukti_pembayaran` varchar(130) NOT NULL,
  `status_pembayaran` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_rental`, `id_customer`, `id_ps`, `nama_rental`, `tanggal_rental`, `tanggal_kembali`, `harga`, `denda`, `total_denda`, `tanggal_pengembalian`, `status_pengembalian`, `status_rental`, `bukti_pembayaran`, `status_pembayaran`) VALUES
(10, 9, 17, 'Sejahtera Travel', '2020-06-08', '2020-06-12', 800000, 100000, '58604166.666667', '2022-01-19', 'Kembali', 'Selesai', '009.PNG', 1),
(15, 20, 9, 'Putra Riau Travel', '2022-01-09', '2022-01-12', 300000, 45000, '90000', '2022-01-14', 'Kembali', 'Selesai', 'Bukti_Pembayaran_Contoh.jpg', 1),
(17, 21, 20, 'Spartan Playstation', '2024-06-15', '2024-06-16', 50000, 5000, '0', '2024-06-16', 'Kembali', 'Selesai', 'WhatsApp-Image-2023-04-16-at-13_05_52.jpeg', 1),
(18, 28, 21, 'Spartan Playstation', '2024-06-18', '2024-06-19', 75000, 8000, '0', '2024-06-19', 'Belum Kembali', 'Belum Selesai', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id_type` int NOT NULL,
  `kode_type` varchar(10) NOT NULL,
  `nama_type` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id_type`, `kode_type`, `nama_type`, `img`) VALUES
(7, 'dg', 'Daging dan ayam', 'daging.jpg'),
(8, 'sy', 'Sayur-mayur', 'sayur.jpeg'),
(9, 'buh', 'Buah-buahan', 'category-thumb-1.jpg'),
(10, 'ikn', 'Ikan dan makanan laut', 'seafood.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reset_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin123', '', NULL, NULL, NULL, '1', NULL, 1, 1, NULL, NULL, NULL),
(2, 'trimuryanto78@gmail.com', 'Admin123', '$2y$10$yD7x5MxpaI.V7gFSazKOxeN6sEpsJB4fcYKt1mkoB1rrYmXfqVCCO', NULL, NULL, NULL, 'f534909c3c4413e2530956a05aa4e129', NULL, NULL, 1, 0, '2025-02-06 16:29:40', '2025-02-09 06:20:21', NULL),
(3, 'admin@admin.com', 'mury', '$2y$10$AhNf4icyKpVaZhnQDxJJdesC5BdtTFWGK5sFkAHHe6teq0yhSbYRe', NULL, NULL, NULL, '435b263f2b96a9285f82709e0a4e7b2d', '1', NULL, 1, 0, '2025-04-02 08:05:53', '2025-04-02 08:05:53', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_mess`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id_rental`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_rental`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_mess` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id_rental` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_rental` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
