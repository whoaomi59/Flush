-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-04-2025 a las 05:02:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `flush`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `Tipo` enum('Anal','Vaginal') NOT NULL,
  `contacto` varchar(40) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`id`, `nombre`, `Tipo`, `contacto`, `descripcion`) VALUES
(2, 'samanta', 'Vaginal', '302 7505807', 'HERMOSA NIÑA OPERADITA POCOS DÍAS EN TU CIUDAD! - 3027505807\r\nConmigo tendras momentos intimos inolvidables y llenos de placer!\r\n\r\nDispuesta a cumplir tus mas intimas fantasias y deseos sexuales...\r\n\r\n100% Higiénica de igual manera Exijo lo mismo de Ti para brindarte un mejor Servicio...\r\n\r\nTe ofrezco:\r\n\r\nPenetracion vaginal\r\n\r\nSexo oral (Solo para ti)\r\n\r\nLas poses que desees.\r\n\r\nMorbo.\r\n\r\nCaricias.\r\n\r\nFetiches.\r\n\r\nMasturbacion mutua.\r\n\r\nMasajes.\r\n\r\nBailes Eroticos.\r\n\r\nServicio garantizado.\r\n\r\nTengo Sitio.\r\n\r\nTodo Con Protección...\r\n\r\nNo Hago Salidas Sin Fines de Lucro.\r\n\r\nSolo para Caballeros con buen aseo, solventes y de buena presencia...');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `fk_multimedia` int(11) NOT NULL,
  `multimedia` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_multimedia` (`fk_multimedia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `fk_multimedia` FOREIGN KEY (`fk_multimedia`) REFERENCES `datos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
