--
-- Base de datos: `web2`
--
CREATE DATABASE IF NOT EXISTS `web2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `web2`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancion`
--

DROP TABLE IF EXISTS `cancion`;
CREATE TABLE `cancion` (
  `idCancion` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `album` varchar(30) NOT NULL,
  `artista` varchar(30) NOT NULL,
  `duracion` int(11) NOT NULL,
  `codDueno` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `baneo` tinyint(1) NOT NULL,
  `path` varchar(50) NOT NULL,
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
(16, 'el vago', 'carajo', 'carajo', 0, 1, '2016-11-16', 0, 'canciones/el vago.mp3', 4),
(20, 'Hang Me, Oh Hang Me', 'soundtrack', 'lewys', 0, 1, '2016-11-16', 0, 'canciones/01 - Hang Me, Oh Hang Me.mp3', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

DROP TABLE IF EXISTS `contiene`;
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
(117, 3),
(117, 5),
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
(156, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncias`
--

DROP TABLE IF EXISTS `denuncias`;
CREATE TABLE `denuncias` (
  `codDenunciado` int(11) NOT NULL,
  `codDenunciador` int(11) NOT NULL,
  `codMotivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `denuncias`
--

INSERT INTO `denuncias` (`codDenunciado`, `codDenunciador`, `codMotivo`) VALUES
(2, 1, 1),
(3, 1, 0),
(6, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esquema`
--

DROP TABLE IF EXISTS `esquema`;
CREATE TABLE `esquema` (
  `idEsquema` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
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

DROP TABLE IF EXISTS `generocanciones`;
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

DROP TABLE IF EXISTS `generoplaylist`;
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

DROP TABLE IF EXISTS `playlist`;
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
(116, 'warcry', 1, 1, '2016-11-13', 0, 1, 0, 1, 1, 'FFFFFF', '000000', '0'),
(117, 'warcry', 5, 2, '2016-11-13', 0, 2, 0, 1, 5, 'FFFFFF', '000000', '0'),
(135, 'pabliten', 22, 2, '2016-11-15', 0, 3, 0, 3, 1, 'FFFFFF', '000000', '0'),
(136, 'de hernan', 7, 2, '2016-11-15', 0, 3, 0, 6, 5, 'FFFFFF', '000000', '0'),
(144, 'Mi nueva Playlist', 0, 0, '2016-11-15', 0, 1, 0, 2, 1, 'FFFFFF', '000000', '0'),
(150, 'Mi nueva Playlist', 1, 0, '2016-11-15', 0, 1, 0, 0, 1, 'FFFFFF', '000000', '0'),
(152, 'Mi nueva Playlist', 1, 0, '2016-11-15', 0, 1, 0, 0, 1, 'FFFFFF', '000000', '0'),
(153, 'solo yo', 0, 0, '2016-11-15', 0, 1, 0, 1, 1, 'FFFFFF', '000000', '0'),
(154, 'privadamatias', 5, 2, '2016-11-15', 0, 2, 0, 1, 1, 'FFFFFF', '000000', '0'),
(155, 'Lewys', 3, 1, '2016-11-16', 0, 3, 0, 1, 5, 'c0c0c0', '000000', 'fotos/4C6.jpg'),
(156, 'soundtrack inside', 6, 1, '2016-11-16', 0, 3, 0, 2, 2, '004000', 'ffffff', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporta`
--

DROP TABLE IF EXISTS `reporta`;
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

DROP TABLE IF EXISTS `sigue`;
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
(2, 1, 0),
(3, 1, 0),
(3, 2, 0),
(6, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `contrasena` varchar(55) NOT NULL,
  `email` varchar(30) NOT NULL,
  `ubicacion` varchar(55) NOT NULL,
  `administrador` varchar(10) NOT NULL DEFAULT 'false',
  `habilitado` varchar(10) NOT NULL DEFAULT 'false',
  `fecha_creacion` date NOT NULL,
  `denuncias` varchar(10) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `contrasena`, `email`, `ubicacion`, `administrador`, `habilitado`, `fecha_creacion`, `denuncias`) VALUES
(1, 'matias', '202cb962ac59075b964b07152d234b70', 'matias@mail.com', '', 'false', 'true', '2016-11-13', '1'),
(2, 'federico', '202cb962ac59075b964b07152d234b70', 'federico@mail.com', '', 'false', 'true', '2016-11-13', '0'),
(3, 'pablo', '202cb962ac59075b964b07152d234b70', 'martinezmsms@gmail.com', 'Argentina', 'false', 'true', '2016-11-14', '0'),
(6, 'hernan', '202cb962ac59075b964b07152d234b70', 'martinezms@outlook.com', 'Argentina', 'false', 'true', '2016-11-15', '0'),
(7, 'florencia', '202cb962ac59075b964b07152d234b70', 'florencia@hotmail.com', 'Argentina', 'false', 'false', '2016-11-15', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vota`
--

DROP TABLE IF EXISTS `vota`;
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
(135, 1),
(135, 2),
(136, 1),
(136, 2),
(154, 2),
(154, 3),
(155, 3),
(156, 1);

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
  MODIFY `idCancion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
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
-- AUTO_INCREMENT de la tabla `playlist`
--
ALTER TABLE `playlist`
  MODIFY `idPlaylist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
