-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2022 a las 16:35:27
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
  `telefono` int(11) NOT NULL,
  `latitud` varchar(50) NOT NULL,
  `longitud` varchar(50) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `telefono` int(30) NOT NULL,
  `fechaRegistro` datetime(6) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `idComisaria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `novedades_de_guardia`
--
ALTER TABLE `novedades_de_guardia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idPersona` int(150) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(150) NOT NULL AUTO_INCREMENT;

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
