-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2016 a las 20:43:21
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `web2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncias_usuarios`
--

CREATE TABLE `denuncias_usuarios` (
  `usuario` varchar(15) NOT NULL,
  `usuario_denunciado` varchar(15) NOT NULL,
  `motivo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `denuncias_usuarios`
--

INSERT INTO `denuncias_usuarios` (`usuario`, `usuario_denunciado`, `motivo`) VALUES
('pgarcia', '', 'porque si'),
('pgarcia', 'matias', '132456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sigue`
--

CREATE TABLE `sigue` (
  `id` int(11) NOT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `siguiendo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sigue`
--

INSERT INTO `sigue` (`id`, `usuario`, `siguiendo`) VALUES
(43, 'pablo', 'pablo'),
(48, 'pablo', 'gaby'),
(53, 'pablo', 'pgarcia'),
(54, 'pablo', 'matias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` smallint(6) NOT NULL,
  `Nombre` varchar(15) NOT NULL,
  `Contrasena` varchar(55) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `Ubicacion` varchar(20) DEFAULT NULL,
  `Administrador` varchar(5) DEFAULT NULL,
  `Habilitado` varchar(5) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Denuncias` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `Nombre`, `Contrasena`, `email`, `Ubicacion`, `Administrador`, `Habilitado`, `Fecha`, `Denuncias`) VALUES
(1, 'gaby', '81dc9bdb52d04dc20036dbd8313ed055', 'pgarcia@grimoldi.com', 'Argentina', 'false', 'true', '2016-11-04 11:59:27', 0),
(1, 'matias', '81dc9bdb52d04dc20036dbd8313ed055', 'pgarcia@grimoldi.com', 'Argentina', 'false', 'true', '2016-11-04 11:59:41', 1),
(1, 'pablo', '81dc9bdb52d04dc20036dbd8313ed055', 'pgarcia@grimoldi.com', 'Argentina', 'true', 'true', '2016-11-02 15:16:11', 0),
(1, 'pgarcia', '81dc9bdb52d04dc20036dbd8313ed055', 'pgarcia@grimoldi.com', 'Argentina', 'false', 'true', '2016-11-04 11:59:11', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sigue`
--
ALTER TABLE `sigue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `siguiendo` (`siguiendo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sigue`
--
ALTER TABLE `sigue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sigue`
--
ALTER TABLE `sigue`
  ADD CONSTRAINT `sigue_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`Nombre`),
  ADD CONSTRAINT `sigue_ibfk_2` FOREIGN KEY (`siguiendo`) REFERENCES `usuarios` (`Nombre`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
