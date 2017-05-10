-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2017 a las 01:28:36
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambioestado`
--

CREATE TABLE IF NOT EXISTS `cambioestado` (
  `idCambioEstado` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idEstadoP` int(11) NOT NULL,
  `idPrograma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE IF NOT EXISTS `cargo` (
  `idCargo` int(11) NOT NULL,
  `abreviatura` varchar(10) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargodocente`
--

CREATE TABLE IF NOT EXISTS `cargodocente` (
  `idDocente` int(11) NOT NULL,
  `idCargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE IF NOT EXISTS `carrera` (
  `idCarrera` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativa`
--

CREATE TABLE IF NOT EXISTS `correlativa` (
  `idMateria1` int(11) NOT NULL,
  `idMateria2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursado`
--

CREATE TABLE IF NOT EXISTS `cursado` (
  `idCursado` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `idMateria` int(11) DEFAULT NULL,
  `cuatrimestre` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cursado`
--

INSERT INTO `cursado` (`idCursado`, `fechaInicio`, `fechaFin`, `idMateria`, `cuatrimestre`) VALUES
(1, '2017-03-05', '2017-06-15', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dedicacion`
--

CREATE TABLE IF NOT EXISTS `dedicacion` (
  `idDedicacion` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `idDocente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentodocente`
--

CREATE TABLE IF NOT EXISTS `departamentodocente` (
  `idDocente` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `designado`
--

CREATE TABLE IF NOT EXISTS `designado` (
  `funcion` varchar(100) NOT NULL,
  `idCursado` int(11) NOT NULL,
  `idDocente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE IF NOT EXISTS `docente` (
  `idDocente` int(11) NOT NULL,
  `cuil` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `idDedicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoobservacion`
--

CREATE TABLE IF NOT EXISTS `estadoobservacion` (
  `idEstadoO` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadoobservacion`
--

INSERT INTO `estadoobservacion` (`idEstadoO`, `descripcion`) VALUES
(1, 'PRUEBA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoprograma`
--

CREATE TABLE IF NOT EXISTS `estadoprograma` (
  `idEstadoP` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE IF NOT EXISTS `materia` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `año` varchar(20) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `objetivo` varchar(700) NOT NULL,
  `contenidoMinimo` varchar(1500) NOT NULL,
  `idMateria` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idPlan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observacion`
--

CREATE TABLE IF NOT EXISTS `observacion` (
  `idObservacion` int(11) NOT NULL,
  `observacion` varchar(200) NOT NULL,
  `idEstadoO` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPrograma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
  `idPlan` int(11) NOT NULL,
  `numOrd` int(11) NOT NULL,
  `idCarrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE IF NOT EXISTS `programa` (
  `idPrograma` int(11) NOT NULL,
  `idCursado` int(11) NOT NULL,
  `orientacion` varchar(200) NOT NULL,
  `anioActual` year(4) NOT NULL,
  `programaAnalitico` text NOT NULL,
  `propuestaMetodologica` varchar(200) NOT NULL,
  `condicionesAcredEvalu` varchar(200) NOT NULL,
  `horariosConsulta` varchar(200) NOT NULL,
  `bibliografia` varchar(200) NOT NULL,
  `cuatrimestre` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`idPrograma`, `idCursado`, `orientacion`, `anioActual`, `programaAnalitico`, `propuestaMetodologica`, `condicionesAcredEvalu`, `horariosConsulta`, `bibliografia`, `cuatrimestre`) VALUES
(1, 1, 'educativo', 2015, 'Unidad 1:', 'asd', 'asd', '5', 'asd', 'Primero'),
(3, 1, 'ni idea', 2017, 'ni idea', 'ni idea', 'ni idea', '5', 'ni idea ', 'primero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `idRol` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL,
  `idDocente` int(11) NOT NULL,
  `idRol` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cambioestado`
--
ALTER TABLE `cambioestado`
  ADD PRIMARY KEY (`idCambioEstado`),
  ADD KEY `idPrograma` (`idPrograma`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `cambioestado_ibfk_3_idx` (`idEstadoP`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`idCargo`);

--
-- Indices de la tabla `cargodocente`
--
ALTER TABLE `cargodocente`
  ADD PRIMARY KEY (`idCargo`,`idDocente`),
  ADD KEY `idDocente` (`idDocente`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`idCarrera`);

--
-- Indices de la tabla `correlativa`
--
ALTER TABLE `correlativa`
  ADD PRIMARY KEY (`idMateria1`,`idMateria2`),
  ADD KEY `idMateria2` (`idMateria2`);

--
-- Indices de la tabla `cursado`
--
ALTER TABLE `cursado`
  ADD PRIMARY KEY (`idCursado`);

--
-- Indices de la tabla `dedicacion`
--
ALTER TABLE `dedicacion`
  ADD PRIMARY KEY (`idDedicacion`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`),
  ADD KEY `idDocente` (`idDocente`);

--
-- Indices de la tabla `departamentodocente`
--
ALTER TABLE `departamentodocente`
  ADD PRIMARY KEY (`idDepartamento`,`idDocente`),
  ADD KEY `idDocente` (`idDocente`);

--
-- Indices de la tabla `designado`
--
ALTER TABLE `designado`
  ADD PRIMARY KEY (`idDocente`,`idCursado`),
  ADD KEY `idCursado` (`idCursado`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`idDocente`),
  ADD KEY `idDedicacion` (`idDedicacion`);

--
-- Indices de la tabla `estadoobservacion`
--
ALTER TABLE `estadoobservacion`
  ADD PRIMARY KEY (`idEstadoO`);

--
-- Indices de la tabla `estadoprograma`
--
ALTER TABLE `estadoprograma`
  ADD PRIMARY KEY (`idEstadoP`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`idMateria`),
  ADD KEY `idPlan` (`idPlan`);

--
-- Indices de la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD PRIMARY KEY (`idObservacion`),
  ADD KEY `id_programa` (`idPrograma`),
  ADD KEY `estado` (`idEstadoO`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`idPlan`),
  ADD KEY `idCarrera` (`idCarrera`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`idPrograma`),
  ADD KEY `idCursado` (`idCursado`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idDocente` (`idDocente`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cambioestado`
--
ALTER TABLE `cambioestado`
  MODIFY `idCambioEstado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `idCargo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `idCarrera` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cursado`
--
ALTER TABLE `cursado`
  MODIFY `idCursado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `dedicacion`
--
ALTER TABLE `dedicacion`
  MODIFY `idDedicacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `idDocente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estadoobservacion`
--
ALTER TABLE `estadoobservacion`
  MODIFY `idEstadoO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `estadoprograma`
--
ALTER TABLE `estadoprograma`
  MODIFY `idEstadoP` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `idMateria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `observacion`
--
ALTER TABLE `observacion`
  MODIFY `idObservacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `plan`
--
ALTER TABLE `plan`
  MODIFY `idPlan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `idPrograma` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cambioestado`
--
ALTER TABLE `cambioestado`
  ADD CONSTRAINT `cambioestado_ibfk_1` FOREIGN KEY (`idPrograma`) REFERENCES `programa` (`idPrograma`),
  ADD CONSTRAINT `cambioestado_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `cambioestado_ibfk_3` FOREIGN KEY (`idEstadoP`) REFERENCES `estadoprograma` (`idEstadoP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cargodocente`
--
ALTER TABLE `cargodocente`
  ADD CONSTRAINT `cargodocente_ibfk_1` FOREIGN KEY (`idDocente`) REFERENCES `docente` (`idDocente`),
  ADD CONSTRAINT `cargodocente_ibfk_2` FOREIGN KEY (`idCargo`) REFERENCES `cargo` (`idCargo`);

--
-- Filtros para la tabla `correlativa`
--
ALTER TABLE `correlativa`
  ADD CONSTRAINT `correlativa_ibfk_1` FOREIGN KEY (`idMateria1`) REFERENCES `materia` (`idMateria`),
  ADD CONSTRAINT `correlativa_ibfk_2` FOREIGN KEY (`idMateria2`) REFERENCES `materia` (`idMateria`);

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `departamento_ibfk_1` FOREIGN KEY (`idDocente`) REFERENCES `docente` (`idDocente`);

--
-- Filtros para la tabla `departamentodocente`
--
ALTER TABLE `departamentodocente`
  ADD CONSTRAINT `departamentodocente_ibfk_1` FOREIGN KEY (`idDocente`) REFERENCES `docente` (`idDocente`),
  ADD CONSTRAINT `departamentodocente_ibfk_2` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`);

--
-- Filtros para la tabla `designado`
--
ALTER TABLE `designado`
  ADD CONSTRAINT `designado_ibfk_1` FOREIGN KEY (`idCursado`) REFERENCES `cursado` (`idCursado`),
  ADD CONSTRAINT `designado_ibfk_2` FOREIGN KEY (`idDocente`) REFERENCES `docente` (`idDocente`);

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`idDedicacion`) REFERENCES `dedicacion` (`idDedicacion`);

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`idPlan`) REFERENCES `plan` (`idPlan`);

--
-- Filtros para la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD CONSTRAINT `observacion_ibfk_1` FOREIGN KEY (`idPrograma`) REFERENCES `programa` (`idPrograma`),
  ADD CONSTRAINT `observacion_ibfk_2` FOREIGN KEY (`idEstadoO`) REFERENCES `estadoobservacion` (`idEstadoO`),
  ADD CONSTRAINT `observacion_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`idCarrera`) REFERENCES `carrera` (`idCarrera`);

--
-- Filtros para la tabla `programa`
--
ALTER TABLE `programa`
  ADD CONSTRAINT `programa_ibfk_2` FOREIGN KEY (`idCursado`) REFERENCES `cursado` (`idCursado`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idDocente`) REFERENCES `docente` (`idDocente`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
