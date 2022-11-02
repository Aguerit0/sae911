-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2022 a las 21:59:55
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdsae911`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisarias`
--

CREATE TABLE `comisarias` (
  `idComisaria` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `latitud` varchar(50) NOT NULL,
  `longitud` varchar(50) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8_general_mysql500_ci;

--
-- Volcado de datos para la tabla `comisarias`
--

INSERT INTO `comisarias` (`idComisaria`, `nombre`, `direccion`, `provincia`, `departamento`, `localidad`, `telefono`, `latitud`, `longitud`, `habilitado`, `eliminado`) VALUES
(1, 'Sexta', 'Av. virgen del valle 123', 'Catamarca', 'Capital', 'SFVC', '12312412', '12412', '21312312', 1, 0),
(2, 'quinta', 'Av. virgen del valle 123', 'Catamarca', 'Capital', 'SFVC', '12312412', '23', '342', 0, 0),
(3, 'Cuarta', 'Rivadavia 123', 'Catamarca', 'Capital', 'SFVC', '+41241231', '5891347', '73642765', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades_de_guardia`
--

CREATE TABLE `novedades_de_guardia` (
  `id` int NOT NULL,
  `idUsuario` int NOT NULL,
  `idComisaria` int NOT NULL,
  `fecha` date NOT NULL,
  `turno` varchar(30) NOT NULL,
  `superior_de_turno` varchar(100) NOT NULL,
  `oficial_servicio` varchar(100) NOT NULL,
  `personas_de_guardia` int NOT NULL,
  `motoristas` int NOT NULL,
  `mov_funcionamiento` varchar(250) NOT NULL,
  `mov_fuera_de_servicio` varchar(250) NOT NULL,
  `detenidos_causa_federal` int NOT NULL,
  `detenidos_justicia_ordinaria` int NOT NULL,
  `arres_averiguacion_de_hecho` int NOT NULL,
  `aprehendidos` int NOT NULL,
  `arres_averiguacion_actividades` int NOT NULL,
  `arres_info_codigo_de_faltas` int NOT NULL,
  `demorados` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `novedades_de_guardia`
--

INSERT INTO `novedades_de_guardia` (`id`, `idUsuario`, `idComisaria`, `fecha`, `turno`, `superior_de_turno`, `oficial_servicio`, `personas_de_guardia`, `motoristas`, `mov_funcionamiento`, `mov_fuera_de_servicio`, `detenidos_causa_federal`, `detenidos_justicia_ordinaria`, `arres_averiguacion_de_hecho`, `aprehendidos`, `arres_averiguacion_actividades`, `arres_info_codigo_de_faltas`, `demorados`) VALUES
(7, 1, 1, '2022-10-12', 'VESPERTINO (14:00 - 22:00)', 'marcos', 'juan', 12, 4, '12', '3', 4, 4, 4, 4, 4, 4, 543),
(8, 1, 1, '2022-10-07', 'MATUTINO (06:00 - 14:00)', 'asdasdasdasd', 'asdasdasd', 1, 1, '1', '1', 11, 1, 1, 111, 1, 1, 1111),
(9, 1, 1, '2022-10-06', 'NOCTURNO (22:00 - 06:00)', 'julian', 'samira', 1, 32, '23', '3', 3, 43, 34, 3, 1, 0, 0),
(10, 1, 1, '2022-10-06', 'NOCTURNO (22:00 - 06:00)', 'ramiro', 'samira', 1, 32, '23', '3', 3, 43, 34, 3, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `idPersona` int NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `sexo` varchar(50) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `fechaRegistro` date DEFAULT NULL,
  `habilitado` int DEFAULT NULL,
  `borrado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idPersona`, `nombre`, `apellido`, `correo`, `telefono`, `sexo`, `dni`, `fechaRegistro`, `habilitado`, `borrado`) VALUES
(1, 'Orel', 'Cottell', 'ocottell0@columbia.edu', '215-863-3768', 'Female', '118.23.68.2', '2022-03-28', 1, 0),
(2, 'Page', 'Gonsalvez', 'pgonsalvez1@craigslist.org', '579-118-6702', 'Male', '247.245.233.210', '2021-12-13', 0, 0),
(3, 'Giovanni', 'Beton', 'gbeton2@addtoany.com', '487-842-4891', 'Male', '47.126.189.2', '2021-11-20', 1, 0),
(4, 'Abby', 'Bails', 'abails3@mlb.com', '949-666-6211', 'Male', '163.112.223.54', '2021-12-04', 0, 0),
(5, 'Cornelius', 'Jaze', 'cjaze4@tiny.cc', '402-809-9089', 'Male', '80.49.230.2', '2022-01-23', 0, 0),
(6, 'Alistair', 'MacKill', 'amackill5@blinklist.com', '167-226-7939', 'Male', '18.108.20.14', '2021-11-17', 0, 0),
(7, 'Ozzie', 'Wildgoose', 'owildgoose6@facebook.com', '353-250-3043', 'Male', '54.236.62.18', '2022-08-03', 1, 0),
(8, 'Evangelia', 'Clemmens', 'eclemmens7@twitter.com', '982-823-0278', 'Female', '205.139.235.66', '2021-12-18', 0, 0),
(9, 'Lucais', 'Foskew', 'lfoskew8@multiply.com', '241-670-9743', 'Male', '15.250.167.191', '2022-06-19', 0, 0),
(10, 'Sher', 'Gallear', 'sgallear9@ebay.com', '828-437-5364', 'Female', '1.214.113.246', '2022-10-16', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario-comisaria`
--

CREATE TABLE `usuario-comisaria` (
  `idUsuarioComisaria` int NOT NULL,
  `idUsuario` int NOT NULL,
  `idComisaria` int NOT NULL,
  `habilitado` int NOT NULL,
  `eliminado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `rol` int NOT NULL,
  `habilitado` int NOT NULL,
  `borrado` int NOT NULL,
  `idPersona` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `contraseña`, `rol`, `habilitado`, `borrado`, `idPersona`) VALUES
(1, 'kbrauninger0', 'FPFXNlVp', 1, 0, 0, 1),
(2, 'tantill1', 'WlegYddi', 1, 0, 0, 2),
(3, 'ssamweyes2', 'XRpWBo', 1, 0, 0, 3),
(4, 'khallwell3', 'VIfKLGfO', 0, 0, 0, 4),
(5, 'svero4', '1tbo2v4zswE', 1, 1, 0, 5),
(6, 'dprosch5', 'hT3iSUVFoMzS', 1, 0, 0, 6),
(7, 'tmcaw6', 'itDte93Fov', 1, 0, 0, 7),
(8, 'bpittam7', 'BeayqLDUofC6', 0, 1, 0, 8),
(9, 'clorne8', 'ghFTIK1Cm0D5', 1, 1, 0, 9),
(10, 'bglidden9', 'oY7rgmJ43', 0, 1, 0, 10);

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
-- Indices de la tabla `usuario-comisaria`
--
ALTER TABLE `usuario-comisaria`
  ADD PRIMARY KEY (`idUsuarioComisaria`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idComisarias` (`idComisaria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idPersona` (`idPersona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comisarias`
--
ALTER TABLE `comisarias`
  MODIFY `idComisaria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `novedades_de_guardia`
--
ALTER TABLE `novedades_de_guardia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idPersona` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario-comisaria`
--
ALTER TABLE `usuario-comisaria`
  MODIFY `idUsuarioComisaria` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- Filtros para la tabla `usuario-comisaria`
--
ALTER TABLE `usuario-comisaria`
  ADD CONSTRAINT `idComisarias` FOREIGN KEY (`idComisaria`) REFERENCES `comisarias` (`idComisaria`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `idPersona` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
