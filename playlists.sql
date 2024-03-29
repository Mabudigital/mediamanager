-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 25, 2024 at 08:25 PM
-- Server version: 5.7.44
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediaman_rmm`
--

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `title`, `description`, `image`, `host`, `created_at`, `updated_at`) VALUES
(1, 'Victoria En Tu Crisis', NULL, 'uploads/image/Victoria En Tu Crisis.jpg', 'Pastora Elizabeth Guidini', '2022-02-09 11:56:35', '2022-02-09 11:56:35'),
(2, 'Biblikka', NULL, 'uploads/image/Biblikka.jpg', 'Dr. José R. Martínez-Villamil', '2022-02-09 12:00:27', '2022-02-09 12:00:27'),
(3, 'Dialogo y Cuidado Pastoral', NULL, 'uploads/image/Dialogo y Cuidado Pastoral.png', 'Pastor Jesús Rivera', '2022-02-09 12:02:14', '2022-02-09 12:02:14'),
(4, 'Directo Al Corazón', NULL, 'uploads/image/Directo_Al_Corazon.jpg', 'Pastor Jesús Manuel Torres', '2022-02-09 12:04:55', '2022-02-11 09:02:32'),
(5, 'La Canción De Tu Corazón', NULL, 'uploads/image/La Canción De Tu Corazón.jpg', 'Sheila Romero', '2022-02-09 12:06:24', '2022-02-09 12:06:24'),
(6, 'La Frape En Acción', NULL, 'uploads/image/La Frape En Acción.jpg', 'La Frape En Acción', '2022-02-09 12:07:00', '2022-02-09 12:07:00'),
(7, 'Latidos Del Corazón', NULL, 'uploads/image/Latidos Del Corazón.jpg', 'Pastor Mauricio Guidini', '2022-02-09 12:07:28', '2022-02-09 12:07:28'),
(8, 'Para Que Mi Gente Piense', NULL, 'uploads/image/Para Que Mi Gente Piense.jpg', 'Rolando Torres', '2022-02-09 12:09:45', '2022-02-09 12:09:45'),
(9, 'Pensando En Voz Alta', NULL, 'uploads/image/Pensando En Voz Alta.jpg', 'Pastor Jesús Rivera', '2022-02-09 12:11:07', '2022-02-09 12:11:07'),
(10, 'Reflexiones De Esperanza', NULL, 'uploads/image/Reflexiones De Esperanza.jpg', 'Pastor Mizraim Esquilín', '2022-02-09 12:11:38', '2022-02-09 12:11:38'),
(11, 'Solo Palabra', NULL, 'uploads/image/Solo Palabra.png', 'Pastora Marta Ramirez de Cruz', '2022-02-09 12:12:02', '2022-02-09 12:12:02'),
(12, 'Tiempo de refrigerio con Jesús', NULL, 'uploads/image/TiempoDeRefrigerio.jpg', 'Evangelista Maribel Rodríguez', '2022-02-09 12:13:21', '2022-02-23 16:26:36'),
(13, 'Tiempo De Sanación', NULL, 'uploads/image/Tiempo De Sanación.jpg', 'Pastor Moisés Román', '2022-02-09 12:13:52', '2022-02-09 12:13:52'),
(14, 'Jesús Manuel Torres', NULL, 'uploads/image/Jesús Manuel Torres.jpg', 'Pastor Jesús Manuel Torres', '2022-02-09 23:33:47', '2022-02-09 23:33:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
