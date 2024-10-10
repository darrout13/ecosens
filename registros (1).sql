-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2024 a las 01:14:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `correo` varchar(70) NOT NULL,
  `telefono` bigint(10) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `fech_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`id_usuario`, `nombres`, `apellidos`, `correo`, `telefono`, `usuario`, `contraseña`, `fech_registro`) VALUES
(0, 'Luis Daniel', 'Alvarez', 'luis01@gmail.com', 3254896325, 'LUISDA', 'Luis01', '2024-04-06'),
(27, 'Esteban ', 'Jinete ', 'davidesteban@gmail.com', 3015697542, 'ESTEBANOFF', 'Soyotaku_1', '2024-03-23'),
(29, 'Anders Enrique', 'Muñoz Pua', 'aemunoz1@unibarranquilla.edu.co', 3045390596, 'aemunoz', 'daniel', '2024-04-02'),
(31, 'Carolay ', 'Muñoz ', 'carolaymppuma@gmail.com', 3024289297, 'Coraline', 'Gine_01', '2024-04-02'),
(33, 'Andres', 'Alvarez', 'pumu12@gmail.com', 32569874520, 'MENDEZANDRES', 'Soyanders_5', '2024-04-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mediciones_gases`
--

CREATE TABLE `mediciones_gases` (
  `CO` decimal(5,2) NOT NULL,
  `Alcohol` decimal(5,2) NOT NULL,
  `CO2` decimal(5,2) NOT NULL,
  `Toluen` decimal(5,2) NOT NULL,
  `NH4` decimal(5,2) NOT NULL,
  `Aceton` decimal(5,2) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mediciones_gases`
--

INSERT INTO `mediciones_gases` (`CO`, `Alcohol`, `CO2`, `Toluen`, `NH4`, `Aceton`, `fecha`, `id_usuario`) VALUES
(3.93, 1.32, 402.84, 0.55, 4.32, 0.47, '2024-09-22 20:26:08', 0),
(3.98, 1.34, 402.87, 0.55, 4.35, 0.47, '2024-09-22 20:26:12', 0),
(3.93, 1.32, 402.84, 0.55, 4.32, 0.47, '2024-09-22 20:26:15', 0),
(3.79, 1.28, 402.77, 0.53, 4.22, 0.45, '2024-09-22 20:26:19', 0),
(4.04, 1.35, 402.90, 0.56, 4.40, 0.48, '2024-09-22 20:26:22', 0),
(3.70, 1.26, 402.72, 0.52, 4.16, 0.44, '2024-09-22 20:26:25', 0),
(4.04, 1.35, 402.90, 0.56, 4.40, 0.48, '2024-09-22 20:26:29', 0),
(3.84, 1.30, 402.79, 0.54, 4.26, 0.46, '2024-09-22 20:26:33', 0),
(3.74, 1.27, 402.74, 0.53, 4.19, 0.45, '2024-09-22 20:26:36', 0),
(4.05, 1.35, 402.90, 0.56, 4.40, 0.48, '2024-09-22 20:26:40', 0),
(6.13, 1.89, 403.92, 0.81, 5.71, 0.68, '2024-09-22 21:05:56', 0),
(5.77, 1.80, 403.75, 0.77, 5.50, 0.65, '2024-09-22 21:06:00', 0),
(6.09, 1.88, 403.90, 0.80, 5.69, 0.68, '2024-09-22 21:06:03', 0),
(6.13, 1.89, 403.92, 0.81, 5.71, 0.68, '2024-09-22 21:06:06', 0),
(6.05, 1.87, 403.88, 0.80, 5.66, 0.67, '2024-09-22 21:06:10', 0),
(6.29, 1.93, 404.00, 0.83, 5.80, 0.70, '2024-09-22 21:06:13', 0),
(6.22, 1.91, 403.96, 0.82, 5.76, 0.69, '2024-09-22 21:06:17', 0),
(6.16, 1.90, 403.93, 0.81, 5.73, 0.68, '2024-09-22 21:06:21', 0),
(6.28, 1.93, 403.99, 0.82, 5.79, 0.69, '2024-09-22 21:06:41', 0),
(5.96, 1.85, 403.84, 0.79, 5.61, 0.67, '2024-09-22 21:06:44', 0),
(5.64, 1.77, 403.69, 0.75, 5.42, 0.63, '2024-09-22 21:06:48', 0),
(6.19, 1.91, 403.95, 0.81, 5.74, 0.69, '2024-09-22 21:07:00', 0),
(5.91, 1.84, 403.82, 0.78, 5.58, 0.66, '2024-09-22 21:07:03', 0),
(6.03, 1.87, 403.88, 0.80, 5.65, 0.67, '2024-09-22 21:07:07', 0),
(0.00, 0.00, 400.00, 0.00, 0.00, 0.00, '2024-09-22 21:33:21', 0),
(0.00, 0.00, 400.00, 0.00, 0.00, 0.00, '2024-09-22 21:33:26', 0),
(0.00, 0.00, 400.00, 0.00, 0.00, 0.00, '2024-09-22 21:33:32', 0),
(0.00, 0.00, 400.00, 0.00, 0.00, 0.00, '2024-09-22 21:33:49', 0),
(3.84, 1.30, 2.79, 0.54, 4.26, 0.46, '2024-09-23 20:31:26', 0),
(3.82, 1.29, 2.78, 0.53, 4.24, 0.45, '2024-09-23 20:31:30', 0),
(3.71, 1.26, 2.72, 0.52, 4.17, 0.44, '2024-09-23 20:31:34', 0),
(3.88, 1.31, 2.81, 0.54, 4.28, 0.46, '2024-09-23 20:31:39', 0),
(4.07, 1.36, 2.91, 0.57, 4.42, 0.48, '2024-09-23 20:31:45', 0),
(3.84, 1.30, 2.79, 0.54, 4.26, 0.46, '2024-09-23 20:31:48', 0),
(3.70, 1.26, 2.72, 0.52, 4.16, 0.44, '2024-09-23 20:31:53', 0),
(3.88, 1.31, 2.81, 0.54, 4.28, 0.46, '2024-09-23 20:31:56', 0),
(3.95, 1.33, 2.85, 0.55, 4.33, 0.47, '2024-09-23 20:32:02', 0),
(3.86, 1.30, 2.80, 0.54, 4.27, 0.46, '2024-09-23 20:36:25', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mediciones_nacional`
--

CREATE TABLE `mediciones_nacional` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `temperatura2` int(2) NOT NULL,
  `humedad2` int(3) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mediciones_nacional`
--

INSERT INTO `mediciones_nacional` (`id`, `fecha`, `temperatura2`, `humedad2`, `id_usuario`) VALUES
(1, '2024-09-16 18:26:51', 31, 79, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mediciones_temperatura_humedad`
--

CREATE TABLE `mediciones_temperatura_humedad` (
  `Id_medicion` int(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `temperatura` int(2) NOT NULL,
  `humedad` int(3) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mediciones_temperatura_humedad`
--

INSERT INTO `mediciones_temperatura_humedad` (`Id_medicion`, `fecha`, `temperatura`, `humedad`, `id_usuario`) VALUES
(1, '2024-04-17 01:32:01', 27, 83, 0),
(2, '2024-04-17 01:32:31', 27, 83, 0),
(3, '2024-04-17 01:32:36', 27, 83, 0),
(4, '2024-04-17 01:32:40', 27, 83, 0),
(5, '2024-04-17 01:32:45', 27, 83, 0),
(6, '2024-04-17 01:32:51', 27, 83, 0),
(7, '2024-04-17 01:32:55', 27, 83, 0),
(8, '2024-04-17 08:10:27', 29, 75, 0),
(9, '2024-04-17 08:48:38', 28, 83, 0),
(10, '2024-09-22 20:24:52', 30, 81, 0),
(11, '2024-09-22 20:24:56', 30, 81, 0),
(12, '2024-09-22 20:25:06', 30, 81, 0),
(13, '2024-09-22 20:25:08', 30, 81, 0),
(14, '2024-09-22 20:25:11', 30, 81, 0),
(15, '2024-09-22 20:25:15', 30, 81, 0),
(16, '2024-09-22 20:25:18', 30, 81, 0),
(17, '2024-09-22 20:25:22', 30, 81, 0),
(18, '2024-09-22 20:26:08', 30, 81, 0),
(19, '2024-09-22 20:26:12', 30, 81, 0),
(20, '2024-09-22 20:26:15', 30, 81, 0),
(21, '2024-09-22 20:26:19', 30, 81, 0),
(22, '2024-09-22 20:26:22', 30, 81, 0),
(23, '2024-09-22 20:26:25', 30, 81, 0),
(24, '2024-09-22 20:26:29', 30, 81, 0),
(25, '2024-09-22 20:26:33', 30, 81, 0),
(26, '2024-09-22 20:26:36', 30, 81, 0),
(27, '2024-09-22 20:26:40', 30, 81, 0),
(28, '2024-09-22 21:05:56', 30, 82, 0),
(29, '2024-09-22 21:06:00', 30, 82, 0),
(30, '2024-09-22 21:06:03', 30, 82, 0),
(31, '2024-09-22 21:06:06', 30, 82, 0),
(32, '2024-09-22 21:06:10', 30, 82, 0),
(33, '2024-09-22 21:06:13', 30, 82, 0),
(34, '2024-09-22 21:06:17', 30, 82, 0),
(35, '2024-09-22 21:06:21', 30, 82, 0),
(36, '2024-09-22 21:06:41', 30, 82, 0),
(37, '2024-09-22 21:06:44', 30, 82, 0),
(38, '2024-09-22 21:06:48', 30, 82, 0),
(39, '2024-09-22 21:07:00', 30, 82, 0),
(40, '2024-09-22 21:07:03', 30, 82, 0),
(41, '2024-09-22 21:07:07', 30, 82, 0),
(42, '2024-09-22 21:33:14', 30, 81, 0),
(43, '2024-09-22 21:33:17', 30, 82, 0),
(44, '2024-09-22 21:33:21', 30, 81, 0),
(45, '2024-09-22 21:33:26', 30, 81, 0),
(46, '2024-09-22 21:33:32', 30, 81, 0),
(47, '2024-09-22 21:33:49', 30, 81, 0),
(48, '2024-09-22 21:33:53', 30, 82, 0),
(49, '2024-09-22 21:33:57', 30, 81, 0),
(50, '2024-09-22 21:34:04', 30, 81, 0),
(51, '2024-09-22 21:34:07', 30, 82, 0),
(52, '2024-09-22 21:34:16', 30, 81, 0),
(53, '2024-09-22 21:34:28', 30, 81, 0),
(54, '2024-09-22 21:34:44', 30, 81, 0),
(55, '2024-09-22 21:34:48', 30, 81, 0),
(56, '2024-09-22 21:34:52', 30, 81, 0),
(57, '2024-09-22 21:34:58', 30, 82, 0),
(58, '2024-09-22 21:38:43', 30, 81, 0),
(59, '2024-09-22 21:38:47', 30, 81, 0),
(60, '2024-09-22 21:38:52', 30, 81, 0),
(61, '2024-09-22 21:38:56', 30, 81, 0),
(62, '2024-09-22 21:38:59', 30, 81, 0),
(63, '2024-09-23 20:31:26', 32, 73, 0),
(64, '2024-09-23 20:31:30', 32, 73, 0),
(65, '2024-09-23 20:31:34', 32, 73, 0),
(66, '2024-09-23 20:31:39', 32, 73, 0),
(67, '2024-09-23 20:31:45', 32, 73, 0),
(68, '2024-09-23 20:31:48', 32, 73, 0),
(69, '2024-09-23 20:31:53', 32, 73, 0),
(70, '2024-09-23 20:31:56', 32, 73, 0),
(71, '2024-09-23 20:32:02', 32, 73, 0),
(72, '2024-09-23 20:36:25', 32, 73, 0),
(73, '2024-09-24 11:10:34', 34, 70, 0),
(74, '2024-09-24 11:10:43', 34, 70, 0),
(75, '2024-09-24 11:10:46', 34, 70, 0),
(76, '2024-09-24 11:10:50', 34, 71, 0),
(77, '2024-09-24 11:10:54', 34, 71, 0),
(78, '2024-09-24 11:10:58', 34, 71, 0),
(79, '2024-09-24 11:11:01', 34, 71, 0),
(80, '2024-09-24 11:19:24', 34, 70, 0),
(81, '2024-09-24 11:19:27', 34, 70, 0),
(82, '2024-09-24 11:32:37', 34, 70, 0),
(83, '2024-09-24 11:32:40', 34, 70, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicion_calidad_aire`
--

CREATE TABLE `medicion_calidad_aire` (
  `id_calidad_aire` int(11) NOT NULL,
  `m_fecha_calidad_aire` datetime DEFAULT NULL,
  `valor_aire` int(11) NOT NULL,
  `valor_convertido_aire` varchar(4) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicion_calidad_aire`
--

INSERT INTO `medicion_calidad_aire` (`id_calidad_aire`, `m_fecha_calidad_aire`, `valor_aire`, `valor_convertido_aire`, `id_usuario`) VALUES
(246, '2024-04-16 14:54:35', 402, '0.24', 29),
(247, '2024-04-16 14:54:39', 406, '0.98', 29),
(248, '2024-04-16 14:54:43', 406, '1.02', 29),
(249, '2024-04-16 14:54:47', 406, '0.93', 29),
(250, '2024-04-16 15:32:20', 480, '12.8', 29),
(252, '2024-04-16 15:32:31', 413, '2.15', 29),
(253, '2024-04-16 15:32:36', 401, '0.21', 29),
(254, '2024-04-16 15:32:40', 401, '0.17', 29),
(255, '2024-04-16 15:49:57', 403, '0.45', 29),
(256, '2024-04-16 15:50:01', 407, '1.16', 29),
(257, '2024-04-10 19:35:46', 455, '1.23', 0),
(258, '2024-04-10 19:35:46', 455, '1.23', 0),
(259, '2024-09-22 20:24:52', 403, '0.08', 29),
(328, '2024-09-24 11:11:01', 400, '0', 29),
(329, '2024-09-24 11:19:24', 400, '0', 29);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `mediciones_gases`
--
ALTER TABLE `mediciones_gases`
  ADD PRIMARY KEY (`id_usuario`,`fecha`);

--
-- Indices de la tabla `mediciones_nacional`
--
ALTER TABLE `mediciones_nacional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nacional_usuario` (`id_usuario`);

--
-- Indices de la tabla `mediciones_temperatura_humedad`
--
ALTER TABLE `mediciones_temperatura_humedad`
  ADD PRIMARY KEY (`Id_medicion`),
  ADD KEY `fk_temperatura_usuario` (`id_usuario`);

--
-- Indices de la tabla `medicion_calidad_aire`
--
ALTER TABLE `medicion_calidad_aire`
  ADD PRIMARY KEY (`id_calidad_aire`),
  ADD KEY `fk_usuario_calidad_aire` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `mediciones_nacional`
--
ALTER TABLE `mediciones_nacional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mediciones_temperatura_humedad`
--
ALTER TABLE `mediciones_temperatura_humedad`
  MODIFY `Id_medicion` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `medicion_calidad_aire`
--
ALTER TABLE `medicion_calidad_aire`
  MODIFY `id_calidad_aire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mediciones_gases`
--
ALTER TABLE `mediciones_gases`
  ADD CONSTRAINT `fk_gases_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `datos` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mediciones_nacional`
--
ALTER TABLE `mediciones_nacional`
  ADD CONSTRAINT `fk_nacional_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `datos` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mediciones_temperatura_humedad`
--
ALTER TABLE `mediciones_temperatura_humedad`
  ADD CONSTRAINT `fk_temperatura_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `datos` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicion_calidad_aire`
--
ALTER TABLE `medicion_calidad_aire`
  ADD CONSTRAINT `fk_calidad_aire_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `datos` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_calidad_aire` FOREIGN KEY (`id_usuario`) REFERENCES `datos` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
