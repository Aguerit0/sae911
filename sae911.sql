-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2022 a las 05:19:22
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sae911`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisarias`
--

CREATE TABLE `comisarias` (
  `idComisaria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `latitud` varchar(50) NOT NULL,
  `longitud` varchar(50) NOT NULL,
  `habilitado` varchar(1) NOT NULL,
  `eliminado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comisarias`
--

INSERT INTO `comisarias` (`idComisaria`, `nombre`, `direccion`, `provincia`, `departamento`, `localidad`, `telefono`, `latitud`, `longitud`, `habilitado`, `eliminado`) VALUES
(15, 'Comisaria 8va', 'Av. Belgrano 1023', 'Catamarca', 'Capital', 'San Fernando del Valle de Catamarca', '688699', '0', '0', '1', ''),
(16, 'Comisaria 10ma', 'Rivadavia', 'Catamarca', 'Capital', 'San Fernando del Valle de Catamarca', '001100', '1', '1', '1', ''),
(17, 'Comisaria 1ra', 'Av. VIRGEN DEL VALLE 1023', 'Catamarca', 'Capital', 'San Fernando del Valle de Catamarca', '9999999', '3', '4', '1', ''),
(18, 'Comisaria 3ra', 'Ilia 012', 'Catamarca', 'Capital', 'San Fernando del Valle de Catamarca', '992233', '2', '4', '1', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades_de_guardia`
--

CREATE TABLE `novedades_de_guardia` (
  `id` int(11) NOT NULL,
  `idUsuario` int(150) NOT NULL,
  `idComisaria` int(150) NOT NULL,
  `fecha` date NOT NULL,
  `turno` varchar(30) NOT NULL,
  `superior_de_turno` varchar(100) NOT NULL,
  `oficial_servicio` varchar(100) NOT NULL,
  `personas_de_guardia` int(11) NOT NULL,
  `motoristas` int(11) NOT NULL,
  `mov_funcionamiento` varchar(250) NOT NULL,
  `mov_fuera_de_servicio` varchar(250) NOT NULL,
  `detenidos_causa_federal` int(11) NOT NULL,
  `detenidos_justicia_ordinaria` int(11) NOT NULL,
  `arres_averiguacion_de_hecho` int(11) NOT NULL,
  `aprehendidos` int(11) NOT NULL,
  `arres_averiguacion_actividades` int(11) NOT NULL,
  `arres_info_codigo_de_faltas` int(11) NOT NULL,
  `demorados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `idPersona` int(150) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` int(150) NOT NULL,
  `sexo` varchar(25) NOT NULL,
  `dni` int(50) NOT NULL,
  `fechaRegistro` datetime(6) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idPersona`, `nombre`, `apellido`, `correo`, `telefono`, `sexo`, `dni`, `fechaRegistro`, `habilitado`, `eliminado`) VALUES
(1, 'Esteban', 'Agüero', 'cuentauniversdading@gmail.com', 688699, 'hombre', 43192391, '2022-10-13 12:30:57.000000', 1, 0),
(2, 'administrador', 'admin', 'administrador@gmail.com', 1, '', 0, '2022-10-20 12:32:50.000000', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(150) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `rol` int(3) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `idPersona` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `contraseña`, `rol`, `habilitado`, `idPersona`) VALUES
(1, 'eaguero', '1', 0, 1, 1),
(2, 'admin', 'admin', 0, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_comisaria`
--

CREATE TABLE `usuario_comisaria` (
  `idUsuarioComisaria` int(150) NOT NULL,
  `idUsuario` int(150) NOT NULL,
  `idComisaria` int(150) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comisarias`
--
ALTER TABLE `comisarias`
  ADD PRIMARY KEY (`idComisaria`);

--
-- Indices de la tabla `novedades_de_guardia`
--
ALTER TABLE `novedades_de_guardia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idComisaria` (`idComisaria`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`idPersona`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idPersona` (`idPersona`);

--
-- Indices de la tabla `usuario_comisaria`
--
ALTER TABLE `usuario_comisaria`
  ADD PRIMARY KEY (`idUsuarioComisaria`),
  ADD KEY `idComisaria` (`idComisaria`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comisarias`
--
ALTER TABLE `comisarias`
  MODIFY `idComisaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `novedades_de_guardia`
--
ALTER TABLE `novedades_de_guardia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idPersona` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_comisaria`
--
ALTER TABLE `usuario_comisaria`
  MODIFY `idUsuarioComisaria` int(150) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `novedades_de_guardia`
--
ALTER TABLE `novedades_de_guardia`
  ADD CONSTRAINT `novedades_de_guardia_ibfk_1` FOREIGN KEY (`idComisaria`) REFERENCES `comisarias` (`idComisaria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `novedades_de_guardia_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_comisaria`
--
ALTER TABLE `usuario_comisaria`
  ADD CONSTRAINT `usuario_comisaria_ibfk_1` FOREIGN KEY (`idComisaria`) REFERENCES `comisarias` (`idComisaria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_comisaria_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
