-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 28-03-2022 a las 00:12:00
-- Versión del servidor: 5.6.41
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cafeteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`, `fecha`) VALUES
(1, 'Bebida', '2022-03-27 02:46:48'),
(2, 'Postres', '2022-03-27 02:46:48'),
(3, 'Frutos', '2022-03-27 18:53:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `producto` varchar(50) NOT NULL,
  `referencia` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `peso` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0-> no activo 1-> activo',
  `fecha_ingreso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `producto`, `referencia`, `precio`, `peso`, `id_categoria`, `stock`, `status`, `fecha_ingreso`) VALUES
(1, 'Capuchino', 'Bebida de cafeina', '3500.00', 2, 1, 93, '1', '2022-03-27 02:53:43'),
(2, 'Pastel de Pollo', 'Cualquier cosa', '1700.00', 10, 2, 35, '1', '2022-03-27 19:56:24'),
(3, 'Crohasan', 'Cualquier cosa', '2000.00', 8, 2, 7, '1', '2022-03-27 20:12:16'),
(5, 'Chocolate caliente', 'Cualquier cosa', '3500.00', 10, 1, 59, '1', '2022-03-27 20:14:23'),
(6, 'Almendras', 'Cualquier cosa', '1000.00', 15, 3, 24, '1', '2022-03-27 18:53:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha_ingreso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_producto`, `cantidad`, `total`, `fecha_ingreso`) VALUES
(1, 5, 9, '31500.00', '2022-03-27 18:31:23'),
(2, 2, 4, '6800.00', '2022-03-27 18:33:01'),
(3, 3, 1, '2000.00', '2022-03-27 18:33:04'),
(4, 1, 1, '3500.00', '2022-03-27 18:33:07'),
(5, 5, 1, '3500.00', '2022-03-27 18:33:11'),
(6, 1, 5, '17500.00', '2022-03-27 18:34:06'),
(7, 3, 1, '2000.00', '2022-03-27 18:59:45'),
(8, 1, 1, '3500.00', '2022-03-27 18:59:49'),
(9, 6, 1, '1000.00', '2022-03-27 18:59:54'),
(10, 2, 1, '1700.00', '2022-03-27 18:59:58'),
(11, 3, 1, '2000.00', '2022-03-27 19:04:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
