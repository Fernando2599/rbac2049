-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 22, 2024 at 10:36 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rbac23b`
--

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `id` smallint(6) NOT NULL,
  `estado_nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `estado_valor` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id`, `estado_nombre`, `estado_valor`) VALUES
(1, 'Activo', 10),
(2, 'Pendiente', 5);

-- --------------------------------------------------------

--
-- Table structure for table `genero`
--

CREATE TABLE `genero` (
  `id` smallint(6) NOT NULL,
  `genero_nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `genero`
--

INSERT INTO `genero` (`id`, `genero_nombre`) VALUES
(1, 'masculino'),
(2, 'femenino');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1693618984),
('m130524_201442_init', 1693619006),
('m190124_110200_add_verification_token_column_to_user_table', 1693619007);

-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `apellido` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` datetime NOT NULL,
  `genero_id` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id` smallint(6) NOT NULL,
  `rol_nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `rol_valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `rol_nombre`, `rol_valor`) VALUES
(1, 'Usuario', 10),
(2, 'Admin', 20),
(7, 'SuperUsuario', 30),
(8, 'Cliente', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` smallint(6) NOT NULL,
  `tipo_usuario_nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_usuario_valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `tipo_usuario_nombre`, `tipo_usuario_valor`) VALUES
(1, 'Gratuito', 10),
(2, 'Pago', 30);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rol_id` smallint(6) NOT NULL DEFAULT '1',
  `estado_id` smallint(6) NOT NULL DEFAULT '1',
  `tipo_usuario_id` smallint(6) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `rol_id`, `estado_id`, `tipo_usuario_id`, `created_at`, `updated_at`, `verification_token`) VALUES
(10, 'rusell.iuit', 'oovQI6bZFLHEWtT4yPP4DtXYRm8a5wRK', '$2y$13$lFr1XGlUNQ/BC6NJcHWpyO9x5qQiigE0HstxyfEkLWBsBSAM/v6yC', NULL, 'rusell75@hotmail.com', 7, 1, 2, '2024-03-13 19:01:55', '2024-03-13 19:01:55', 'tQ7gFiu6KjPvhLIEYUBzjz1athvhO1_6_1710378115');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genero`
--
ALTER TABLE `genero`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genero_id_2` (`genero_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
