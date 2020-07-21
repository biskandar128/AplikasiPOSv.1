-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2020 at 02:18 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktifitas_details`
--

CREATE TABLE `aktifitas_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_aktivitas` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktifitas` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_aktifitas` date NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aktifitas_details`
--

INSERT INTO `aktifitas_details` (`id`, `kd_aktivitas`, `aktifitas`, `tgl_aktifitas`, `total_biaya`, `created_at`, `updated_at`) VALUES
(17, 'AKT000000003', 'Bayar Listrik PLN', '2020-04-02', 1000, '2020-04-02 05:42:50', '2020-04-02 05:42:50');

-- --------------------------------------------------------

--
-- Table structure for table `aktifitas_detail_temps`
--

CREATE TABLE `aktifitas_detail_temps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_aktivitas` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktifitas` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_aktifitas` date NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_aktivitas` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_aktifitas` date NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`id`, `kd_aktivitas`, `tgl_aktifitas`, `total_biaya`, `created_at`, `updated_at`) VALUES
(3, 'AKT000000003', '2020-04-02', 1000, '2020-04-02 05:42:55', '2020-04-02 05:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gudangs`
--

CREATE TABLE `gudangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_gudang` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_supplier` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_barang` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_supplier` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jual` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `stok_out` int(11) NOT NULL,
  `status_harga` enum('Harga Tidak Aktif','Harga Aktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gudangs`
--

INSERT INTO `gudangs` (`id`, `kd_gudang`, `kd_supplier`, `kd_barang`, `harga_supplier`, `harga_jual`, `stok`, `stok_out`, `status_harga`, `created_at`, `updated_at`) VALUES
(10, 'GD000001', 'SUP000000001', 'G00258', '1000', '15000', 106, 6, 'Harga Tidak Aktif', '2020-05-29 09:35:36', '2020-05-31 07:14:54'),
(11, 'GD000002', 'SUP000000001', 'G00258', '1500', '2000', 94, 6, 'Harga Aktif', '2020-05-29 10:11:16', '2020-05-31 07:12:00'),
(12, 'GD000003', 'SUP000000002', 'G00259', '2000', '2500', 99, 1, 'Harga Tidak Aktif', '2020-05-29 10:12:31', '2020-05-29 11:41:07'),
(13, 'GD000004', 'SUP000000002', 'G00259', '2500', '3000', 104, 7, 'Harga Aktif', '2020-05-29 10:20:25', '2020-05-31 05:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_barang` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_jenis` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `kd_barang`, `nama_barang`, `kd_jenis`, `berat`, `created_at`, `updated_at`) VALUES
(1, 'G00258', 'Asus Zenfone 3 ZE520KL', 'JB000001', 1000, '2020-03-24 21:41:57', '2020-05-30 11:39:06'),
(2, 'G00259', 'Asus Zenfone 3 ZE552KL', 'JB000001', 500, '2020-03-24 21:42:04', '2020-05-30 11:32:09'),
(3, 'G00260', 'Baju Muslim Anak', 'Z0288', 200, '2020-03-30 19:56:21', '2020-03-30 19:56:21'),
(5, 'G00261', 'Baju Muslim Pria', 'Z0289', 500, '2020-03-31 05:25:39', '2020-03-31 05:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_items`
--

CREATE TABLE `jenis_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_jenis` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_items`
--

INSERT INTO `jenis_items` (`id`, `kd_jenis`, `jenis_barang`, `created_at`, `updated_at`) VALUES
(4, 'JB000001', 'Elektronik', '2020-04-04 15:05:56', '2020-04-04 15:05:56'),
(6, 'JB000002', 'Pakaian Muslim', '2020-05-30 11:32:20', '2020-05-30 11:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_stoks`
--

CREATE TABLE `laporan_stoks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_barang` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_awal` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_masuk` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_keluar` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_akhir` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_stoks`
--

INSERT INTO `laporan_stoks` (`id`, `kd_barang`, `nama_barang`, `harga_beli`, `stok_awal`, `stok_masuk`, `stok_keluar`, `stok_akhir`, `tgl`, `created_at`, `updated_at`) VALUES
(48, 'G00258', 'Asus Zenfone 3 ZE520KL', '1000', '0', '100', '4', '96', '2020-05-29', '2020-05-29 09:35:36', '2020-05-29 11:07:27'),
(49, 'G00258', 'Asus Zenfone 3 ZE520KL', '1500', '0', '100', '0', '100', '2020-05-29', '2020-05-29 10:11:16', '2020-05-29 10:11:16'),
(50, 'G00259', 'Asus Zenfone 3 ZE552KL', '2000', '0', '100', '0', '100', '2020-05-29', '2020-05-29 10:12:31', '2020-05-29 10:12:31'),
(51, 'G00259', 'Asus Zenfone 3 ZE552KL', '2500', '0', '100', '2', '98', '2020-05-29', '2020-05-29 10:20:25', '2020-05-29 11:20:29'),
(52, 'G00258', 'Asus Zenfone 3 ZE520KL', '1000', '96', '0', '1', '95', '2020-06-01', '2020-05-29 11:11:21', '2020-05-29 11:11:21'),
(53, 'G00258', 'Asus Zenfone 3 ZE520KL', '1500', '100', '0', '1', '99', '2020-06-02', '2020-05-29 11:19:19', '2020-05-29 11:19:19'),
(54, 'G00259', 'Asus Zenfone 3 ZE552KL', '2500', '98', '0', '2', '96', '2020-07-02', '2020-05-29 11:21:18', '2020-05-29 11:21:18'),
(55, 'G00259', 'Asus Zenfone 3 ZE552KL', '2500', '96', '4', '1', '99', '2020-06-03', '2020-05-29 11:22:51', '2020-05-29 11:29:24'),
(56, 'G00258', 'Asus Zenfone 3 ZE520KL', '1500', '99', '0', '1', '98', '2020-06-03', '2020-05-29 11:23:40', '2020-05-29 11:23:40'),
(57, 'G00258', 'Asus Zenfone 3 ZE520KL', '1000', '95', '3', '0', '98', '2020-06-03', '2020-05-29 11:25:37', '2020-05-29 11:25:37'),
(58, 'G00259', 'Asus Zenfone 3 ZE552KL', '2500', '99', '2', '0', '101', '2020-06-04', '2020-05-29 11:31:20', '2020-05-29 11:31:20'),
(59, 'G00258', 'Asus Zenfone 3 ZE520KL', '1000', '98', '0', '1', '97', '2020-07-01', '2020-05-29 11:33:56', '2020-05-29 11:33:56'),
(60, 'G00259', 'Asus Zenfone 3 ZE552KL', '2000', '100', '0', '1', '99', '2020-07-02', '2020-05-29 11:35:50', '2020-05-29 11:35:50'),
(61, 'G00258', 'Asus Zenfone 3 ZE520KL', '1500', '98', '0', '1', '97', '2020-08-01', '2020-05-29 11:41:30', '2020-05-29 11:41:30'),
(62, 'G00259', 'Asus Zenfone 3 ZE552KL', '2500', '101', '0', '1', '100', '2020-08-01', '2020-05-29 11:42:01', '2020-05-29 11:42:01'),
(63, 'G00258', 'Asus Zenfone 3 ZE520KL', '1500', '97', '0', '1', '96', '2020-08-02', '2020-05-29 11:42:28', '2020-05-29 11:42:28'),
(64, 'G00259', 'Asus Zenfone 3 ZE552KL', '2500', '100', '0', '1', '99', '2020-08-02', '2020-05-29 11:42:50', '2020-05-29 11:42:50'),
(65, 'G00259', 'Asus Zenfone 3 ZE552KL', '2500', '99', '5', '0', '104', '2020-08-03', '2020-05-29 11:44:22', '2020-05-29 11:44:22'),
(66, 'G00258', 'Asus Zenfone 3 ZE520KL', '1500', '96', '0', '0', '96', '2020-05-30', '2020-05-30 12:03:23', '2020-05-30 12:03:39'),
(67, 'G00259', 'Asus Zenfone 3 ZE552KL', '2500', '104', '0', '0', '104', '2020-05-30', '2020-05-30 12:37:20', '2020-05-30 12:37:29'),
(68, 'G00258', 'Asus Zenfone 3 ZE520KL', '1500', '96', '0', '2', '94', '2020-05-31', '2020-05-31 02:11:08', '2020-05-31 07:12:00'),
(69, 'G00258', 'Asus Zenfone 3 ZE520KL', '1000', '97', '9', '0', '106', '2020-05-31', '2020-05-31 03:00:59', '2020-05-31 07:14:54'),
(70, 'G00259', 'Asus Zenfone 3 ZE552KL', '2500', '104', '0', '0', '104', '2020-05-31', '2020-05-31 04:08:39', '2020-05-31 05:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(107, '2014_10_12_000000_create_users_table', 1),
(108, '2014_10_12_100000_create_password_resets_table', 1),
(109, '2019_08_19_000000_create_failed_jobs_table', 1),
(110, '2020_02_26_040714_create_suppliers_table', 1),
(111, '2020_02_26_041211_create_items_table', 1),
(112, '2020_02_26_041806_create_jenis_items_table', 1),
(113, '2020_02_26_042001_create_transaksis_table', 1),
(114, '2020_02_29_143027_create_transaksi_temps_table', 1),
(115, '2020_03_04_025543_create_transaksi_details_table', 1),
(116, '2020_03_07_092056_create_gudangs_table', 1),
(117, '2020_03_07_100657_create_supplier_users_table', 1),
(118, '2020_03_12_115354_create_laporan_stoks_table', 1),
(119, '2020_03_20_100102_create_return_barangs_table', 1),
(120, '2020_03_25_030910_create_return_barang_details_table', 1),
(121, '2020_04_02_030239_create_aktivitas_table', 2),
(122, '2020_04_02_102132_create_aktifitas_details_table', 2),
(123, '2020_04_02_103338_create_aktifitas_detail_temps_table', 2),
(124, '2020_05_30_061814_add_roles_to_users_table', 3),
(125, '2020_05_30_062357_add_username_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_barangs`
--

CREATE TABLE `return_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_return` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_return` date NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_return` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_return` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_barangs`
--

INSERT INTO `return_barangs` (`id`, `kd_return`, `tgl_return`, `nama`, `alasan_return`, `alamat_return`, `total`, `created_at`, `updated_at`) VALUES
(9, 'RTRN000001', '2020-05-31', 'Bayu Iskandar', 'Barang rusak', 'Bogor', 15000, '2020-05-31 03:01:01', '2020-05-31 03:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `return_barang_details`
--

CREATE TABLE `return_barang_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_return` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_transaksi` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_gudang` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_barang_details`
--

INSERT INTO `return_barang_details` (`id`, `kd_return`, `kd_transaksi`, `kd_gudang`, `qty`, `sub_total`, `created_at`, `updated_at`) VALUES
(1, 'RTRN001', 'TRS000000001', 'GD000001', 3, 4500, '2020-03-24 21:47:07', '2020-03-24 21:47:07'),
(2, 'RTRN002', 'TRS000000002', 'GD000003', 1, 2700, '2020-03-28 17:32:55', '2020-03-28 17:32:55'),
(3, 'RTRN003', 'TRS000000004', 'GD000003', 2, 5400, '2020-03-29 20:31:06', '2020-03-29 20:31:06'),
(4, 'RTRN004', 'TRS000000005', 'GD000005', 4, 4800, '2020-03-30 20:42:47', '2020-03-30 20:42:47'),
(5, 'RTRN005', 'TRS000000005', 'GD000004', 2, 4200, '2020-04-04 00:56:49', '2020-04-04 00:56:49'),
(6, 'RTRN006', 'TRS000000015', 'GD000004', 5, 10500, '2020-04-06 10:07:19', '2020-04-06 10:07:19'),
(7, 'RTRN007', 'TRS000000016', 'GD000005', 4, 4800, '2020-04-09 04:10:38', '2020-04-09 04:10:38'),
(8, 'RTRN000001', 'TRS000000001', 'GD000001', 1, 15000, '2020-05-31 03:00:59', '2020-05-31 03:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_supplier` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_supplier` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_barang` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `tgl_barang_datang` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `kd_supplier`, `nama_supplier`, `kd_barang`, `qty`, `harga_beli`, `tgl_barang_datang`, `created_at`, `updated_at`) VALUES
(2, '10021', 'PT. ASKI', 'G00258', 30, 1100, '2020-03-25', '2020-03-24 21:43:34', '2020-04-05 14:07:25'),
(3, '10021', 'PT. ASKI', 'G00259', 15, 2500, '2020-03-25', '2020-03-24 21:43:50', '2020-03-24 21:43:50'),
(4, '10021', 'PT. ASKI', 'G00258', 15, 1000, '2020-03-27', '2020-03-26 19:36:03', '2020-03-26 19:36:03'),
(6, '1021', 'PT.ASKI', 'G00259', 10, 2000, '2020-03-31', NULL, NULL),
(7, '10021', 'PT. ASKI', 'G00260', 30, 900, '2020-03-31', '2020-03-30 19:56:51', '2020-03-31 00:14:37'),
(8, '10021', 'PT. ASKI', 'G00258', 30, 1000, '2020-04-01', '2020-03-31 19:25:12', '2020-03-31 19:25:12'),
(9, 'SUP000000001', 'PT. ASKI', 'G00258', 100, 1000, '2020-04-09', '2020-04-09 03:41:13', '2020-04-09 03:41:13'),
(10, 'SUP000000002', 'PT. Asus Indonesia', 'G00259', 150, 2000, '2020-04-09', '2020-04-09 04:05:21', '2020-04-09 04:05:21'),
(11, 'SUP000000001', 'PT. ASKI', 'G00258', 1000, 1000, '2020-05-29', '2020-05-29 08:40:42', '2020-05-29 08:40:42'),
(12, 'SUP000000001', 'PT. ASKI', 'G00258', 1000, 1500, '2020-05-29', '2020-05-29 08:41:01', '2020-05-29 08:41:01'),
(13, 'SUP000000002', 'PT. Asus Indonesia', 'G00259', 1000, 2000, '2020-05-29', '2020-05-29 08:41:22', '2020-05-29 08:41:22'),
(14, 'SUP000000002', 'PT. Asus Indonesia', 'G00259', 1000, 25000, '2020-05-29', '2020-05-29 08:41:40', '2020-05-29 08:41:40'),
(15, 'SUP000000001', 'PT. ASKI', 'G00258', 100, 1000, '2020-05-29', '2020-05-29 09:35:36', '2020-05-29 09:35:36'),
(16, 'SUP000000001', 'PT. ASKI', 'G00258', 100, 1500, '2020-05-29', '2020-05-29 10:11:16', '2020-05-29 10:11:16'),
(17, 'SUP000000002', 'PT. Asus Indonesia', 'G00259', 100, 2000, '2020-05-29', '2020-05-29 10:12:31', '2020-05-29 10:12:31'),
(18, 'SUP000000002', 'PT. Asus Indonesia', 'G00259', 100, 2500, '2020-05-29', '2020-05-29 10:20:25', '2020-05-29 10:20:25'),
(19, 'SUP000000001', 'PT. ASKI', 'G00258', 3, 1000, '2020-06-03', '2020-05-29 11:25:37', '2020-05-29 11:25:37'),
(20, 'SUP000000002', 'PT. Asus Indonesia', 'G00259', 4, 2500, '2020-06-03', '2020-05-29 11:29:24', '2020-05-29 11:29:24'),
(21, 'SUP000000002', 'PT. Asus Indonesia', 'G00259', 2, 2500, '2020-06-04', '2020-05-29 11:31:20', '2020-05-29 11:31:20'),
(22, 'SUP000000002', 'PT. Asus Indonesia', 'G00259', 5, 2500, '2020-08-03', '2020-05-29 11:44:22', '2020-05-29 11:44:22'),
(23, 'SUP000000001', 'PT. ASKIq', 'G00258', 7, 1000, '2020-05-31', '2020-05-31 03:37:34', '2020-05-31 03:37:34'),
(24, 'SUP000000001', 'PT. ASKIq', 'G00258', 1, 1000, '2020-05-31', '2020-05-31 07:14:54', '2020-05-31 07:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_users`
--

CREATE TABLE `supplier_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_supplier` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_supplier` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_users`
--

INSERT INTO `supplier_users` (`id`, `kd_supplier`, `nama_supplier`, `email`, `created_at`, `updated_at`) VALUES
(15, 'SUP000000001', 'PT. ASKIq', 'hambalitubagus@gmail.com', '2020-04-04 11:43:18', '2020-05-30 12:04:28'),
(16, 'SUP000000002', 'PT. Asus Indonesia', 'hambalitubagus@gmail.com', '2020-04-04 12:01:01', '2020-04-05 12:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_transaksi` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_gudang` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `kd_transaksi`, `kd_gudang`, `tgl_transaksi`, `qty`, `sub_total`, `created_at`, `updated_at`) VALUES
(70, 'TRS000000002', 'GD000001', '2020-06-01', 1, 15000, '2020-05-29 11:11:21', '2020-05-29 11:11:21'),
(71, 'TRS000000003', 'GD000002', '2020-06-02', 1, 2000, '2020-05-29 11:19:19', '2020-05-29 11:19:19'),
(72, 'TRS000000004', 'GD000004', '2020-05-29', 2, 6000, '2020-05-29 11:20:29', '2020-05-29 11:20:29'),
(73, 'TRS000000005', 'GD000004', '2020-07-02', 2, 6000, '2020-05-29 11:21:18', '2020-05-29 11:21:18'),
(74, 'TRS000000006', 'GD000004', '2020-06-03', 1, 3000, '2020-05-29 11:22:51', '2020-05-29 11:22:51'),
(75, 'TRS000000007', 'GD000002', '2020-06-03', 1, 2000, '2020-05-29 11:23:40', '2020-05-29 11:23:40'),
(76, 'TRS000000008', 'GD000001', '2020-07-01', 1, 15000, '2020-05-29 11:33:56', '2020-05-29 11:33:56'),
(77, 'TRS000000009', 'GD000003', '2020-07-02', 1, 2500, '2020-05-29 11:35:50', '2020-05-29 11:35:50'),
(78, 'TRS000000010', 'GD000002', '2020-08-01', 1, 2000, '2020-05-29 11:41:30', '2020-05-29 11:41:30'),
(79, 'TRS000000011', 'GD000004', '2020-08-01', 1, 3000, '2020-05-29 11:42:01', '2020-05-29 11:42:01'),
(80, 'TRS000000012', 'GD000002', '2020-08-02', 1, 2000, '2020-05-29 11:42:28', '2020-05-29 11:42:28'),
(81, 'TRS000000013', 'GD000004', '2020-08-02', 1, 3000, '2020-05-29 11:42:50', '2020-05-29 11:42:50'),
(84, 'TRS000000014', 'GD000002', '2020-05-31', 1, 2000, '2020-05-31 02:11:08', '2020-05-31 02:11:08'),
(90, 'TRS000000015', 'GD000002', '2020-05-31', 1, 2000, '2020-05-31 07:11:19', '2020-05-31 07:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_details`
--

CREATE TABLE `transaksi_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_transaksi` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_details`
--

INSERT INTO `transaksi_details` (`id`, `kd_transaksi`, `tgl_transaksi`, `total`, `created_at`, `updated_at`) VALUES
(40, 'TRS000000001', '2020-05-29', 0, '2020-05-29 11:08:04', '2020-05-31 03:00:59'),
(41, 'TRS000000002', '2020-06-01', 15000, '2020-05-29 11:11:40', '2020-05-29 11:11:40'),
(42, 'TRS000000003', '2020-06-02', 2000, '2020-05-29 11:19:39', '2020-05-29 11:19:39'),
(43, 'TRS000000004', '2020-05-29', 6000, '2020-05-29 11:20:40', '2020-05-29 11:20:40'),
(44, 'TRS000000005', '2020-05-29', 6000, '2020-05-29 11:21:25', '2020-05-29 11:21:25'),
(45, 'TRS000000006', '2020-06-03', 3000, '2020-05-29 11:22:58', '2020-05-29 11:22:58'),
(46, 'TRS000000007', '2020-06-03', 2000, '2020-05-29 11:24:48', '2020-05-29 11:24:48'),
(47, 'TRS000000008', '2020-07-01', 15000, '2020-05-29 11:34:14', '2020-05-29 11:34:14'),
(48, 'TRS000000009', '2020-07-02', 2500, '2020-05-29 11:36:04', '2020-05-29 11:36:04'),
(49, 'TRS000000010', '2020-08-01', 2000, '2020-05-29 11:41:43', '2020-05-29 11:41:43'),
(50, 'TRS000000011', '2020-08-01', 3000, '2020-05-29 11:42:11', '2020-05-29 11:42:11'),
(51, 'TRS000000012', '2020-08-02', 2000, '2020-05-29 11:42:39', '2020-05-29 11:42:39'),
(52, 'TRS000000013', '2020-08-02', 3000, '2020-05-29 11:43:13', '2020-05-29 11:43:13'),
(53, 'TRS000000014', '2020-05-31', 2000, '2020-05-31 02:11:16', '2020-05-31 02:11:16'),
(54, 'TRS000000015', '2020-05-31', 2000, '2020-05-31 07:11:44', '2020-05-31 07:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_temps`
--

CREATE TABLE `transaksi_temps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_transaksi` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_barang` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hak` enum('admin','kasir') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `roles` enum('ADMIN','USER') COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `hak`, `remember_token`, `created_at`, `updated_at`, `roles`, `username`) VALUES
(1, 'Bayu Iskandar', 'biskandar128@gmail.com', NULL, '$2y$10$FeKTMdF3Jejzxgz40dThy.rS2FcHJ8NV2HOP5ZobGvxlzG5ltb2Ga', 'admin', '7Wfje3OiTsWw4fUAz7OfY2BtvAGtfSfGj3udnyPNoAcqzxUP6Ks3doznPdIt', '2020-05-29 23:46:57', '2020-05-29 23:46:57', 'ADMIN', 'biskandar'),
(2, 'Hambali Tubagus', 'hambalitubagus@gmail.com', NULL, '$2y$10$s1PL4ldMdVtrnmAy4ysrTuqhY5unK9Ptsp0RjrhrnudgakNbAdtla', 'admin', 's65oM7dubxvfTpyXpyseMoiA3hd9DSutbXJBwNP8H4umXZYQvje8HNrF4r6B', '2020-05-30 06:02:09', '2020-05-30 06:02:09', 'USER', 'hambalitubagus'),
(3, 'Agus Supriadi', 'agussupri@gmail.com', NULL, '$2y$10$E00N6kAab7MLQhsiaeMtJedXB9TxPjALMLuztren8KNtpOXL7eNqC', 'admin', NULL, '2020-05-31 07:06:15', '2020-05-31 07:06:15', 'USER', 'agussupri');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktifitas_details`
--
ALTER TABLE `aktifitas_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aktifitas_detail_temps`
--
ALTER TABLE `aktifitas_detail_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aktivitas_kd_aktivitas_unique` (`kd_aktivitas`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gudangs`
--
ALTER TABLE `gudangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gudangs_kd_gudang_unique` (`kd_gudang`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `items_kd_barang_unique` (`kd_barang`);

--
-- Indexes for table `jenis_items`
--
ALTER TABLE `jenis_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jenis_items_kd_jenis_unique` (`kd_jenis`);

--
-- Indexes for table `laporan_stoks`
--
ALTER TABLE `laporan_stoks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `return_barangs`
--
ALTER TABLE `return_barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `return_barangs_kd_return_unique` (`kd_return`);

--
-- Indexes for table `return_barang_details`
--
ALTER TABLE `return_barang_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_users`
--
ALTER TABLE `supplier_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_users_kd_supplier_unique` (`kd_supplier`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_details`
--
ALTER TABLE `transaksi_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksi_details_kd_transaksi_unique` (`kd_transaksi`);

--
-- Indexes for table `transaksi_temps`
--
ALTER TABLE `transaksi_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktifitas_details`
--
ALTER TABLE `aktifitas_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `aktifitas_detail_temps`
--
ALTER TABLE `aktifitas_detail_temps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gudangs`
--
ALTER TABLE `gudangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_items`
--
ALTER TABLE `jenis_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laporan_stoks`
--
ALTER TABLE `laporan_stoks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `return_barangs`
--
ALTER TABLE `return_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `return_barang_details`
--
ALTER TABLE `return_barang_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `supplier_users`
--
ALTER TABLE `supplier_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `transaksi_details`
--
ALTER TABLE `transaksi_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `transaksi_temps`
--
ALTER TABLE `transaksi_temps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
