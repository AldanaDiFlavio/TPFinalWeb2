-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2016 a las 21:35:33
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

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
-- Estructura de tabla para la tabla `cancion`
--

CREATE TABLE `cancion` (
  `idCancion` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `album` varchar(30) NOT NULL,
  `artista` varchar(30) NOT NULL,
  `duracion` int(11) NOT NULL,
  `iDdueño` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `baneo` tinyint(1) NOT NULL,
  `path` varchar(50) NOT NULL,
  `codGenero` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cancion`
--

INSERT INTO `cancion` (`idCancion`, `titulo`, `album`, `artista`, `duracion`, `iDdueño`, `fecha_creacion`, `baneo`, `path`, `codGenero`) VALUES
(1, 'mujer amante', 'magos, espadas y rosas', 'rata blanca', 4, 2, '2016-10-11', 0, 'canciones/mujer amante.mp3', 1),
(2, 'aire', 'warcry', 'warcry', 5, 2, '2016-10-15', 0, 'canciones/aire.mp3', 2),
(3, 'pura vida', 'carajo', 'carajo', 4, 1, '2016-10-11', 0, 'canciones/pura vida.mp3', 3),
(4, 'dias duros', 'magos, espadas y rosas', 'rata blanca', 4, 2, '2016-10-05', 0, 'canciones/dias duros.mp3', 3),
(5, 'opa', 'volve al ruido', 'lo cuco', 3, 0, '2016-10-11', 0, 'canciones/opa.mp3', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

CREATE TABLE `contiene` (
  `codPlaylist` int(11) NOT NULL,
  `codCancion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contiene`
--

INSERT INTO `contiene` (`codPlaylist`, `codCancion`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(2, 3),
(2, 5),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(6, 3),
(7, 1),
(7, 2),
(7, 3),
(8, 1),
(8, 2),
(8, 4),
(9, 1),
(10, 2),
(10, 3),
(12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esquema`
--

CREATE TABLE `esquema` (
  `idEsquema` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idEstado` int(11) NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idEstado`, `descripcion`) VALUES
(1, 'publica'),
(2, 'privada'),
(3, 'soloyo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generocanciones`
--

CREATE TABLE `generocanciones` (
  `idGenero` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `generocanciones`
--

INSERT INTO `generocanciones` (`idGenero`, `descripcion`) VALUES
(1, 'ninguno'),
(2, 'pop'),
(3, 'rock'),
(4, 'progresivo'),
(5, 'metal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generoplaylist`
--

CREATE TABLE `generoplaylist` (
  `idGenero` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `generoplaylist`
--

INSERT INTO `generoplaylist` (`idGenero`, `descripcion`) VALUES
(1, 'ninguno'),
(2, 'fiesta loca'),
(3, 'fiesta pop'),
(4, 'metal extremo'),
(5, 'bizarro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlist`
--

CREATE TABLE `playlist` (
  `idPlaylist` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `cantidad_reproducciones` int(11) DEFAULT '0',
  `cantidad_votos` int(11) DEFAULT '0',
  `fecha_creacion` date DEFAULT NULL,
  `baneo` tinyint(1) DEFAULT '0',
  `codEstado` int(11) NOT NULL DEFAULT '3',
  `codEsquema` int(11) NOT NULL,
  `codDueno` int(11) NOT NULL,
  `codGenero` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `playlist`
--

INSERT INTO `playlist` (`idPlaylist`, `nombre`, `cantidad_reproducciones`, `cantidad_votos`, `fecha_creacion`, `baneo`, `codEstado`, `codEsquema`, `codDueno`, `codGenero`) VALUES
(1, 'nuevo', 0, 45, '2016-10-22', 0, 1, 0, 1, 1),
(2, 'rock', 0, 52, '2016-10-22', 0, 1, 1, 2, 1),
(3, 'pop', 0, 15, '2016-10-22', 0, 3, 1, 1, 1),
(4, 'asd', 0, 12, '2016-10-22', 0, 1, 3, 1, 1),
(5, 'electro', 0, 0, '2016-10-22', 0, 0, 0, 1, 1),
(6, 'heavy', 0, 34, '2016-10-22', 0, 1, 0, 1, 1),
(7, 'trash', 0, 1230, '2016-10-24', 0, 2, 0, 0, 1),
(8, 'power', 0, 66, '2016-10-24', 0, 1, 2, 0, 1),
(9, 'super playlist', 0, 1, '2016-10-24', 0, 2, 2, 0, 1),
(10, 'prueba', 0, 22, '2016-10-24', 0, 3, 3, 0, 1),
(11, 'mi playlist', 0, 0, '2016-10-25', 0, 3, 0, 0, 1),
(12, 'jorgito', 0, 0, '2016-10-25', 0, 1, 0, 0, 1),
(13, 'asdfasdfasdf', 0, 0, '2016-10-25', 0, 3, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporta`
--

CREATE TABLE `reporta` (
  `codElemento` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sigue`
--

CREATE TABLE `sigue` (
  `idUsuarioJefe` int(11) NOT NULL,
  `idUsuarioSeguidor` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(20) NOT NULL,
  `contrasena` varchar(55) NOT NULL,
  `email` varchar(30) NOT NULL,
  `locacion` varchar(55) NOT NULL,
  `administrador` tinyint(1) NOT NULL DEFAULT '0',
  `habilitado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vota`
--

CREATE TABLE `vota` (
  `codPlaylist` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cancion`
--
ALTER TABLE `cancion`
  ADD PRIMARY KEY (`idCancion`);

--
-- Indices de la tabla `contiene`
--
ALTER TABLE `contiene`
  ADD PRIMARY KEY (`codPlaylist`,`codCancion`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `generocanciones`
--
ALTER TABLE `generocanciones`
  ADD PRIMARY KEY (`idGenero`);

--
-- Indices de la tabla `generoplaylist`
--
ALTER TABLE `generoplaylist`
  ADD PRIMARY KEY (`idGenero`);

--
-- Indices de la tabla `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`idPlaylist`);

--
-- Indices de la tabla `reporta`
--
ALTER TABLE `reporta`
  ADD PRIMARY KEY (`codElemento`,`codUsuario`);

--
-- Indices de la tabla `sigue`
--
ALTER TABLE `sigue`
  ADD PRIMARY KEY (`idUsuarioJefe`,`idUsuarioSeguidor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `vota`
--
ALTER TABLE `vota`
  ADD PRIMARY KEY (`codPlaylist`,`codUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cancion`
--
ALTER TABLE `cancion`
  MODIFY `idCancion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `generocanciones`
--
ALTER TABLE `generocanciones`
  MODIFY `idGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `generoplaylist`
--
ALTER TABLE `generoplaylist`
  MODIFY `idGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `playlist`
--
ALTER TABLE `playlist`
  MODIFY `idPlaylist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
