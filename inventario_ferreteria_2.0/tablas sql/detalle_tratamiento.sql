-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-09-2020 a las 05:18:00
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_dentista`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_tratamiento`
--

CREATE TABLE `detalle_tratamiento` (
  `id_detalle_tratamiento` int(11) NOT NULL,
  `precio_unitario` decimal(11,2) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `id_tratamiento` int(11) NOT NULL,
  `id_pieza` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_pago` int(11) NOT NULL,
  `estado_pago` varchar(20) NOT NULL,
  `realizado` varchar(5) NOT NULL,
  `fecha_detalle` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_tratamiento`
--

INSERT INTO `detalle_tratamiento` (`id_detalle_tratamiento`, `precio_unitario`, `id_cuenta`, `id_tratamiento`, `id_pieza`, `id_medico`, `id_pago`, `estado_pago`, `realizado`, `fecha_detalle`) VALUES
(46, '20.00', 19, 2, 2, 1, 15, 'Pagado', 'si', '2020-09-09'),
(47, '13.50', 19, 1, 3, 1, 16, 'Pagado', 'si', '2020-09-09'),
(48, '20.00', 19, 2, 3, 3, 16, 'Pagado', 'si', '2020-09-09'),
(49, '34.80', 19, 4, 2, 1, 19, 'Pagado', 'si', '2020-09-09'),
(50, '13.50', 19, 1, 1, 1, 17, 'Pagado', 'si', '2020-09-08'),
(51, '34.80', 19, 4, 2, 1, 18, 'Pagado', 'si', '2020-09-22'),
(52, '13.50', 19, 1, 1, 1, 0, 'Debe', 'si', '2020-09-15'),
(53, '20.00', 19, 2, 2, 1, 23, 'Pagado', 'si', '2020-09-09'),
(54, '20.00', 20, 2, 1, 1, 24, 'Pagado', 'si', '2020-09-09'),
(55, '13.50', 20, 1, 2, 1, 28, 'Pagado', 'no', '2020-09-22'),
(57, '20.00', 21, 2, 3, 3, 30, 'Pagado', 'si', '2020-09-09'),
(58, '20.00', 21, 2, 2, 1, 30, 'Pagado', 'si', '2020-09-16'),
(59, '20.00', 21, 2, 2, 1, 30, 'Pagado', 'no', '2020-09-15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_tratamiento`
--
ALTER TABLE `detalle_tratamiento`
  ADD PRIMARY KEY (`id_detalle_tratamiento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_tratamiento`
--
ALTER TABLE `detalle_tratamiento`
  MODIFY `id_detalle_tratamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
