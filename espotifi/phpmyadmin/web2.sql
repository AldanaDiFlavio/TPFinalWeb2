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
CREATE TABLE IF NOT EXISTS `cancion` (
  `idCancion` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) NOT NULL,
  `album` varchar(30) NOT NULL,
  `artista` varchar(30) NOT NULL,
  `duracion` int(11) NOT NULL,
  `iDdueño` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `baneo` tinyint(1) NOT NULL,
  `path` varchar(50) NOT NULL,
  PRIMARY KEY (`idCancion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cancion`
--

INSERT INTO `cancion` (`idCancion`, `titulo`, `album`, `artista`, `duracion`, `iDdueño`, `fecha_creacion`, `baneo`, `path`) VALUES
(1, 'mujer amante', 'magos, espadas y rosas', 'rata blanca', 4, 2, '2016-10-11', 0, ''),
(2, 'aire', 'warcry', 'warcry', 5, 2, '2016-10-15', 0, ''),
(3, 'pura vida', 'carajo', 'carajo', 4, 1, '2016-10-11', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

DROP TABLE IF EXISTS `contiene`;
CREATE TABLE IF NOT EXISTS `contiene` (
  `codPlaylist` int(11) NOT NULL,
  `codCancion` int(11) NOT NULL,
  PRIMARY KEY (`codPlaylist`,`codCancion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contiene`
--

INSERT INTO `contiene` (`codPlaylist`, `codCancion`) VALUES
(0, 10),
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(7, 3),
(8, 1),
(8, 3),
(9, 1),
(10, 2),
(12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esquema`
--

DROP TABLE IF EXISTS `esquema`;
CREATE TABLE IF NOT EXISTS `esquema` (
  `idEsquema` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `idEstado` int(11) NOT NULL,
  `descripcion` varchar(15) NOT NULL,
  PRIMARY KEY (`idEstado`)
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
-- Estructura de tabla para la tabla `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `idGenero` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`idGenero`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`idGenero`, `descripcion`, `tipo`) VALUES
(1, 'dias de lluvia', 0),
(2, 'pop', 1),
(3, 'rock', 1),
(4, 'fiesta pop', 0),
(5, 'metal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pertenece`
--

DROP TABLE IF EXISTS `pertenece`;
CREATE TABLE IF NOT EXISTS `pertenece` (
  `codElemento` int(11) NOT NULL,
  `codGenero` int(11) NOT NULL,
  PRIMARY KEY (`codElemento`,`codGenero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pertenece`
--

INSERT INTO `pertenece` (`codElemento`, `codGenero`) VALUES
(3, 1),
(6, 3),
(6, 5),
(9, 4),
(10, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlist`
--

DROP TABLE IF EXISTS `playlist`;
CREATE TABLE IF NOT EXISTS `playlist` (
  `idPlaylist` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `cantidad_reproducciones` int(11) DEFAULT '0',
  `cantidad_votos` int(11) DEFAULT '0',
  `fecha_creacion` date DEFAULT NULL,
  `baneo` tinyint(1) DEFAULT '0',
  `codEstado` int(11) NOT NULL DEFAULT '3',
  `codEsquema` int(11) NOT NULL,
  `codDueno` int(11) NOT NULL,
  PRIMARY KEY (`idPlaylist`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `playlist`
--

INSERT INTO `playlist` (`idPlaylist`, `nombre`, `cantidad_reproducciones`, `cantidad_votos`, `fecha_creacion`, `baneo`, `codEstado`, `codEsquema`, `codDueno`) VALUES
(1, 'nuevo', 0, 45, '2016-10-22', 0, 3, 0, 1),
(2, 'rock', 0, 52, '2016-10-22', 0, 3, 1, 2),
(3, 'pop', 0, 77, '2016-10-22', 0, 3, 1, 1),
(4, 'asd', 0, 12, '2016-10-22', 0, 1, 3, 1),
(5, 'electro', 0, 0, '2016-10-22', 0, 0, 0, 1),
(6, 'heavy', 0, 34, '2016-10-22', 0, 1, 0, 1),
(7, 'trash', 0, 0, '2016-10-24', 0, 2, 0, 0),
(8, 'power', 0, 66, '2016-10-24', 0, 1, 2, 0),
(9, 'super playlist', 0, 1, '2016-10-24', 0, 2, 2, 0),
(10, 'prueba', 0, 22, '2016-10-24', 0, 3, 3, 0),
(11, 'mi playlist', 0, 0, '2016-10-25', 0, 3, 0, 0),
(12, 'jorgito', 0, 0, '2016-10-25', 0, 1, 0, 0),
(13, 'asdfasdfasdf', 0, 0, '2016-10-25', 0, 3, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporta`
--

DROP TABLE IF EXISTS `reporta`;
CREATE TABLE IF NOT EXISTS `reporta` (
  `codElemento` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(30) NOT NULL,
  PRIMARY KEY (`codElemento`,`codUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sigue`
--

DROP TABLE IF EXISTS `sigue`;
CREATE TABLE IF NOT EXISTS `sigue` (
  `idUsuarioJefe` int(11) NOT NULL,
  `idUsuarioSeguidor` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`idUsuarioJefe`,`idUsuarioSeguidor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `nombre` varchar(20) NOT NULL,
  `contrasena` varchar(55) NOT NULL,
  `email` varchar(30) NOT NULL,
  `locacion` varchar(55) NOT NULL,
  `administrador` tinyint(1) NOT NULL DEFAULT '0',
  `habilitado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_creacion` date NOT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vota`
--

DROP TABLE IF EXISTS `vota`;
CREATE TABLE IF NOT EXISTS `vota` (
  `codPlaylist` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  PRIMARY KEY (`codPlaylist`,`codUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

