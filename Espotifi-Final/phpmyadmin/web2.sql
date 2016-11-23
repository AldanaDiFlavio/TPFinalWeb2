-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2016 a las 19:35:57
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.24

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
  `codDueno` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `baneo` tinyint(1) NOT NULL,
  `path` varchar(100) NOT NULL,
  `codGenero` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cancion`
--

INSERT INTO `cancion` (`idCancion`, `titulo`, `album`, `artista`, `duracion`, `codDueno`, `fecha_creacion`, `baneo`, `path`, `codGenero`) VALUES
(1, 'mujer amante', 'magos, espadas y rosas', 'rata blanca', 4, 2, '2016-10-11', 0, 'canciones/mujer amante.mp3', 1),
(2, 'aire', 'warcry', 'warcry', 5, 2, '2016-10-15', 0, 'canciones/aire.mp3', 2),
(3, 'pura vida', 'carajo', 'carajo', 4, 1, '2016-10-11', 0, 'canciones/pura vida.mp3', 3),
(4, 'dias duros', 'magos, espadas y rosas', 'rata blanca', 4, 2, '2016-10-05', 0, 'canciones/dias duros.mp3', 3),
(5, 'opa', 'volve al ruido', 'lo cuco', 3, 0, '2016-10-11', 0, 'canciones/opa.mp3', 5),
(20, 'Hang Me, Oh Hang Me', 'soundtrack', 'lewys', 0, 1, '2016-11-16', 0, 'canciones/01 - Hang Me, Oh Hang Me.mp3', 3),
(21, 'The Storms Are On the Oce', 'soundtrack', 'inside lewys', 0, 1, '2016-11-20', 0, 'canciones/11 - The Storms Are On the Ocean.mp3', 2),
(24, '09 - The Shoals of Herring', 'dfs', 'sdfs', 0, 13, '2016-11-21', 0, 'canciones/09 - The Shoals of Herring.mp3', 1),
(25, 'The bird and the worm', 'Lies For The Liars', 'The Used', 0, 14, '2016-11-21', 0, 'canciones/The Used - The bird and the worm.mp3', 3),
(26, 'The Used - I Caught Fire (Vide', 'nose', 'Airbag', 0, 15, '2016-11-22', 0, 'canciones/The Used - I Caught Fire (Video).mp3', 2),
(27, 'The Used - The bird and the wo', '', '', 0, 15, '2016-11-22', 0, 'canciones/The Used - The bird and the worm.mp3', 1);

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
(111, 1),
(111, 4),
(113, 2),
(113, 5),
(114, 1),
(114, 2),
(114, 3),
(114, 4),
(114, 5),
(116, 2),
(116, 3),
(116, 15),
(117, 5),
(117, 16),
(117, 19),
(120, 3),
(121, 1),
(121, 3),
(126, 1),
(127, 2),
(133, 2),
(133, 3),
(133, 4),
(133, 5),
(134, 2),
(134, 3),
(134, 4),
(135, 1),
(135, 2),
(135, 20),
(136, 2),
(136, 3),
(137, 2),
(137, 3),
(138, 2),
(138, 3),
(138, 4),
(139, 1),
(139, 3),
(141, 1),
(141, 2),
(142, 2),
(143, 2),
(144, 1),
(153, 1),
(153, 2),
(153, 20),
(154, 2),
(155, 19),
(155, 20),
(156, 19),
(156, 20),
(157, 1),
(157, 3),
(157, 4),
(158, 1),
(158, 4),
(158, 21),
(159, 22),
(159, 23),
(160, 2),
(160, 23),
(161, 1),
(161, 23),
(164, 23),
(164, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncias`
--

CREATE TABLE `denuncias` (
  `codDenunciado` int(11) NOT NULL,
  `codDenunciador` int(11) NOT NULL,
  `codMotivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'solo yo'),
(2, 'privada'),
(3, 'publica');

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
-- Estructura de tabla para la tabla `motivo`
--

CREATE TABLE `motivo` (
  `idMotivo` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `motivo`
--

INSERT INTO `motivo` (`idMotivo`, `descripcion`) VALUES
(1, 'nombres inapropiados.'),
(2, 'copia playlist');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlist`
--

CREATE TABLE `playlist` (
  `idPlaylist` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL DEFAULT 'Mi nueva Playlist',
  `cantidad_reproducciones` int(11) DEFAULT '0',
  `cantidad_votos` int(11) DEFAULT '0',
  `fecha_creacion` date DEFAULT NULL,
  `baneo` tinyint(1) DEFAULT '0',
  `codEstado` int(11) NOT NULL DEFAULT '1',
  `codEsquema` int(11) NOT NULL,
  `codDueno` int(11) NOT NULL,
  `codGenero` int(11) NOT NULL DEFAULT '1',
  `colorFondo` varchar(30) NOT NULL DEFAULT 'FFFFFF',
  `colorLetras` varchar(30) NOT NULL DEFAULT '000000',
  `fotoPath` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `playlist`
--

INSERT INTO `playlist` (`idPlaylist`, `nombre`, `cantidad_reproducciones`, `cantidad_votos`, `fecha_creacion`, `baneo`, `codEstado`, `codEsquema`, `codDueno`, `codGenero`, `colorFondo`, `colorLetras`, `fotoPath`) VALUES
(116, 'warcry', 9, 1, '2016-11-13', 0, 1, 0, 1, 1, 'FFFFFF', '000000', 'fotos/14519712_1152678774770669_2827813726089628527_n.jpg'),
(117, 'warcry', 12, 3, '2016-11-13', 0, 2, 0, 1, 5, 'FFFFFF', '000000', 'fotos/100_2336.JPG'),
(135, 'pabliten', 33, 2, '2016-11-15', 1, 3, 0, 3, 1, 'FFFFFF', '000000', '0'),
(136, 'de hernan', 8, 2, '2016-11-15', 1, 3, 0, 6, 5, 'FFFFFF', '000000', '0'),
(144, 'Mi nueva Playlist', 10, 0, '2016-11-15', 0, 1, 0, 2, 1, 'FFFFFF', '000000', 'fotos/hqdefault.jpg'),
(150, 'Mi nueva Playlist', 1, 0, '2016-11-15', 0, 1, 0, 0, 1, 'FFFFFF', '000000', '0'),
(152, 'Mi nueva Playlist', 1, 0, '2016-11-15', 0, 1, 0, 0, 1, 'FFFFFF', '000000', '0'),
(153, 'solo yo', 7, 0, '2016-11-15', 1, 1, 0, 1, 1, 'FFFFFF', '000000', '0'),
(154, 'privadamatias', 19, 4, '2016-11-15', 0, 2, 0, 1, 1, 'FFFFFF', '000000', 'fotos/45395_10151313618832111_1556933549_n.jpg'),
(155, 'Lewys', 14, 2, '2016-11-16', 0, 3, 0, 1, 5, 'c0c0c0', '000000', 'fotos/14522847_1156791894359357_5133735398980398503_n.jpg'),
(156, 'soundtrack inside', 16, 1, '2016-11-16', 0, 3, 0, 2, 2, '004000', 'ffffff', '0'),
(157, 'Muse', 1, 0, '2016-11-17', 1, 3, 0, 8, 3, '00d9d9', '000000', 'fotos/544590_613690141991472_1038503787_n.jpg'),
(158, 'Rata blanca', 3, 2, '2016-11-20', 0, 3, 0, 11, 4, '000000', 'ff0000', 'fotos/BTTF-01.jpg'),
(159, 'Saurom', 1, 0, '2016-11-20', 0, 3, 0, 1, 2, 'FFFFFF', '000000', 'fotos/cover.jpg'),
(161, 'Mi nueva Playlist', 0, 0, '2016-11-21', 0, 1, 0, 12, 1, 'FFFFFF', '000000', 'fotos/s.jpg'),
(164, 'Mi nueva Playlist', 0, 0, '2016-11-21', 0, 1, 0, 13, 1, 'FFFFFF', '000000', 'fotos/hqdefault.jpg');

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
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sigue`
--

INSERT INTO `sigue` (`idUsuarioJefe`, `idUsuarioSeguidor`, `estado`) VALUES
(1, 2, 0),
(1, 3, 0),
(1, 8, 0),
(1, 11, 0),
(1, 12, 0),
(2, 1, 0),
(3, 1, 0),
(3, 2, 0),
(6, 1, 0),
(6, 2, 0),
(11, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `contrasena` varchar(55) NOT NULL,
  `email` varchar(30) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `coordenadas` varchar(100) NOT NULL,
  `administrador` varchar(10) NOT NULL DEFAULT 'false',
  `habilitado` varchar(10) NOT NULL DEFAULT 'false',
  `fecha_creacion` date NOT NULL,
  `denuncias` varchar(10) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `contrasena`, `email`, `ubicacion`, `pais`, `coordenadas`, `administrador`, `habilitado`, `fecha_creacion`, `denuncias`) VALUES
(1, 'matias', '202cb962ac59075b964b07152d234b70', 'matias@mail.com', '', '', '', 'false', 'true', '2016-11-13', '1'),
(2, 'federico', '202cb962ac59075b964b07152d234b70', 'federico@mail.com', '', '', '', 'false', 'false', '2016-11-13', '0'),
(3, 'pablo', '202cb962ac59075b964b07152d234b70', 'martinezmsms@gmail.com', 'Argentina', '', '', 'false', 'true', '2016-11-14', '0'),
(6, 'hernan', '202cb962ac59075b964b07152d234b70', 'martinezms@outlook.com', 'Argentina', '', '', 'false', 'true', '2016-11-15', '0'),
(7, 'florencia', '202cb962ac59075b964b07152d234b70', 'florencia@hotmail.com', 'Argentina', '', '', 'false', 'false', '2016-11-15', '0'),
(8, 'mariano', '202cb962ac59075b964b07152d234b70', 'marianoduran_haedo@hotmail.com', 'Argentina', '', '', 'false', 'true', '2016-11-17', '0'),
(9, 'marianos', '202cb962ac59075b964b07152d234b70', 'marianoduran_haedo@hotmail.com', 'Argentina', '', '', 'false', 'false', '2016-11-17', '0'),
(10, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'martinezmsms@gmail.com', '', '', '', 'true', 'true', '2016-11-17', 'false'),
(11, 'belen', '202cb962ac59075b964b07152d234b70', 'matias@gmail.com', 'Argentina', '', '', 'false', 'false', '2016-11-20', '0'),
(12, 'matiass', '202cb962ac59075b964b07152d234b70', 'matias@mail.com', 'Av. MaipÃº 3779, Ciudadela, Buenos Aires, Argentina', '', '', 'false', 'false', '2016-11-20', '0'),
(13, 'josefina', '202cb962ac59075b964b07152d234b70', 'jose@hotmail.com', 'Sta Juana de Arco 3789, B1702ACI Ciudadela, Buenos Aire', '', '(-34.6387201, -58.53910680000001)', 'false', 'true', '2016-11-21', '0'),
(14, 'aldu', 'c4ca4238a0b923820dcc509a6f75849b', 'aldanadiflavio@live.com.ar', 'ChaÃ±ar 2524, B1754JZB San Justo, Buenos Aires, Argentina', '', '', 'false', 'true', '2016-11-21', '0'),
(15, 'Aldana Tamara', '202cb962ac59075b964b07152d234b70', 'aldanadiflavio@live.com.ar', 'Pres. Juan Domingo PerÃ³n 1900, B1754AZD San Justo, Buenos Aires, Argentina', '', '(-34.665887, -58.57069100000001)', 'false', 'true', '2016-11-22', '0'),
(16, 'Sergio', 'c4ca4238a0b923820dcc509a6f75849b', 'sergio@hotmail.com', 'Ana MarÃ­a Janer 2190, B1785BWD Aldo Bonzi, Buenos Aires, Argentina', '', '(-34.7114565, -58.51083059999996)', 'false', 'true', '2016-11-22', '0'),
(17, 'hola', 'c4ca4238a0b923820dcc509a6f75849b', 'aldanadiflavio@hotmail.com', 'ChaÃ±ar 2524, B1754JZB San Justo, Buenos Aires, Argentina', '', '', 'false', 'true', '2016-11-22', '0'),
(18, 'asdasd', 'c4ca4238a0b923820dcc509a6f75849b', 'sergioroman_lmds@hotmail.com', 'H. Leiva 2300-2348, San Justo, Buenos Aires, Argentina', 'Argentina', '(-34.683452, -58.58036770000001)', 'false', 'false', '2016-11-22', '0'),
(19, 'sdfghjkl', 'c4ca4238a0b923820dcc509a6f75849b', 'asjkdhkasd@asdasd.com', 'Ocampo 1160, B1753AUZ Villa Luzuriaga, Buenos Aires, Argentina', 'Brasil', '', 'false', 'false', '0000-00-00', '2016-11-22'),
(20, 'mnsbxbsambx', 'c4ca4238a0b923820dcc509a6f75849b', 'asxdasdsdds@sadjkahsd.com', 'Corrientes 3833, B1712MOX Castelar, Buenos Aires, Argentina', 'Uruguay', '', 'false', 'false', '0000-00-00', '2016-11-22'),
(21, 'asdfghjkl', 'c4ca4238a0b923820dcc509a6f75849b', 'oikujyhnbgfv@dsfdsf.com', '12 de Octubre 646, B1704GKN Ramos MejÃ­a, Buenos Aires, Argentina', 'Chile', '', 'false', 'false', '0000-00-00', '2016-11-22'),
(22, 'asdasds', 'c4ca4238a0b923820dcc509a6f75849b', 'asadasd@sdkjhask.com', 'Pujol 2299-2399, B1765JQK Isidro Casanova, Buenos Aires, Argentina', 'Argentina', '(-34.6915233, -58.59069090000003)', 'false', 'false', '2016-11-22', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vota`
--

CREATE TABLE `vota` (
  `codPlaylist` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vota`
--

INSERT INTO `vota` (`codPlaylist`, `codUsuario`) VALUES
(111, 2),
(114, 2),
(116, 2),
(117, 2),
(117, 3),
(117, 8),
(135, 1),
(135, 2),
(136, 1),
(136, 2),
(154, 2),
(154, 3),
(154, 8),
(154, 11),
(155, 3),
(155, 8),
(156, 1),
(158, 1),
(158, 14);

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
-- Indices de la tabla `denuncias`
--
ALTER TABLE `denuncias`
  ADD PRIMARY KEY (`codDenunciado`,`codDenunciador`);

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
-- Indices de la tabla `motivo`
--
ALTER TABLE `motivo`
  ADD PRIMARY KEY (`idMotivo`);

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
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `nombre` (`nombre`);

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
  MODIFY `idCancion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `generocanciones`
--
ALTER TABLE `generocanciones`
  MODIFY `idGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `generoplaylist`
--
ALTER TABLE `generoplaylist`
  MODIFY `idGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `motivo`
--
ALTER TABLE `motivo`
  MODIFY `idMotivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `playlist`
--
ALTER TABLE `playlist`
  MODIFY `idPlaylist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
