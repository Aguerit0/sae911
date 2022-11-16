-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-11-2022 a las 16:11:37
-- Versión del servidor: 8.0.26
-- Versión de PHP: 7.4.19

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `novedades_de_relevancia`
--

CREATE TABLE `novedades_de_relevancia` (
  `id` int NOT NULL,
  `fecha_reg` varchar(50) NOT NULL,
  `fecha_reg_tabla` varchar(50) NOT NULL,
  `hora_tabla` varchar(20) NOT NULL,
  `lugar` varchar(60) NOT NULL,
  `sindicatos` int NOT NULL,
  `caracteristicas_hecho` varchar(250) NOT NULL,
  `elemento_utilizado` varchar(30) NOT NULL,
  `movil` varchar(250) NOT NULL,
  `elemento_sustraido` varchar(250) NOT NULL,
  `hecho_consumado` varchar(50) NOT NULL,
  `tipo_motocicleta` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `adelanto_circulacion` varchar(30) NOT NULL,
  `damnificado` varchar(250) NOT NULL,
  `edad` int NOT NULL,
  `sexo` varchar(30) NOT NULL,
  `denunciante` varchar(250) NOT NULL,
  `denuncia` varchar(30) NOT NULL,
  `unidad_judicial` varchar(60) NOT NULL,
  `comision_personal` varchar(30) NOT NULL,
  `medida_tomada` varchar(50) NOT NULL,
  `id_tipo` int NOT NULL,
  `id_subtipo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `eliminado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idPersona`, `nombre`, `apellido`, `correo`, `telefono`, `sexo`, `dni`, `fechaRegistro`, `habilitado`, `eliminado`) VALUES
(1, 'Orel', 'Cottell', 'ocottell0@columbia.edu', '215-863-3768', '1', '118.23.68.2', '2022-03-28', 1, 0),
(2, 'Page', 'Gonsalvez', 'pgonsalvez1@craigslist.org', '579-118-6702', '2', '247.245.233.210', '2021-12-13', 0, 0),
(3, 'Giovanni', 'Beton', 'gbeton2@addtoany.com', '487-842-4891', '3', '47.126.189.2', '2021-11-20', 1, 0),
(4, 'Abby', 'Bails', 'abails3@mlb.com', '949-666-6211', '3', '163.112.223.54', '2021-12-04', 0, 0),
(5, 'Cornelius', 'Jaze', 'cjaze4@tiny.cc', '402-809-9089', '2', '80.49.230.2', '2022-01-23', 0, 0),
(6, 'Alistair', 'MacKill', 'amackill5@blinklist.com', '167-226-7939', '1', '18.108.20.14', '2021-11-17', 0, 0),
(7, 'Ozzie', 'Wildgoose', 'owildgoose6@facebook.com', '353-250-3043', '3', '54.236.62.18', '2022-08-03', 1, 0),
(8, 'Evangelia', 'Clemmens', 'eclemmens7@twitter.com', '982-823-0278', '1', '205.139.235.66', '2021-12-18', 0, 0),
(9, 'Lucais', 'Foskew', 'lfoskew8@multiply.com', '241-670-9743', '2', '15.250.167.191', '2022-06-19', 0, 0),
(10, 'Sher', 'Gallear', 'sgallear9@ebay.com', '828-437-5364', '2', '1.214.113.246', '2022-10-16', 0, 0),
(11, 'Enzo Nahuel', 'Molina', 'naxu.01.xf@gmail.com', '3834959234', '1', '42047517', '2001-11-22', 1, 0),
(12, 'Enzo Nahuel', 'Molina', 'naxu.01.xf@gmail.com', '3834959234', '1', '42047520', '2001-11-22', 1, 0),
(13, 'Enzo Nahuel', 'Molina', 'naxu.01.xf@gmail.com', '3834959234', '1', '42047510', '2001-11-22', 1, 0),
(14, 'Enzo Nahuel', 'Molina', 'naxu.01.xf@gmail.com', '3834959234', '1', '42047512', '2001-11-22', 1, 0),
(15, 'Enzo Nahuel', 'Molina', 'naxu.01.xf@gmail.com', '3834959234', '1', '42047599', '2002-11-22', 1, 0),
(16, 'Enzo Nahuel', 'Molina', 'naxu.01.xf@gmail.com', '3834959234', '1', '42047591', '2022-11-02', 1, 0),
(17, 'Enzo Nahuel', 'Molina', 'naxu.01.xf@gmail.com', '3834959234', '1', '42047560', '2022-11-02', 1, 0),
(18, 'Enzo Nahuel', 'Molina', 'naxu.01.xf@gmail.com', '3834959234', '1', '42047580', '2022-11-02', 1, 0),
(19, 'Enzo Nahuel', 'Molina', 'naxu.01.xf@gmail.com', '3834959234', '1', '42047523', '2022-11-03', 1, 0),
(20, 'Enzo Nahuel', 'Molina', 'naxu.01.xf@gmail.com', '3834959234', '1', '42047530', '2022-11-03', 1, 0),
(21, 'Enzo Nahuel', 'Molina', 'naxu.01.xf@gmail.com', '3834959234', '1', '42047502', '2022-11-03', 1, 0),
(22, 'relleno', 'relleno', 'relleno@gmail.com', '3834998877', '1', '99887766', '2022-11-07', 1, 0),
(23, 'Enzo Nahuel', 'Molina', 'naxu.01.xf@gmail.comm', '3834959234', '1', '42047566', '2022-11-07', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtipo_relevancia`
--

CREATE TABLE `subtipo_relevancia` (
  `id_subtipo` int NOT NULL,
  `subtipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `subtipo_relevancia`
--

INSERT INTO `subtipo_relevancia` (`id_subtipo`, `subtipo`) VALUES
(1, 'VIA PUBLICA'),
(2, 'USO DE ARMA BLANCA O DE FUEGO'),
(3, 'INTERIOR DEL DOMICILIO'),
(4, 'INTENTO'),
(5, 'SUSTRACCION DEL RODADO'),
(6, 'ELEMENTOS DEL INTERIOR'),
(7, 'SUSTRACCION DE RUEDAS'),
(8, 'COMERCIO'),
(9, 'CASA PARTICULAR'),
(10, 'ENTIDAD PUBLICA'),
(11, 'ASALTO CON ARMA BLANCA/ ELEMENTO CONTUNDENTE'),
(12, 'ASALTO CON ARMA DE FUEGO'),
(13, 'OBRA EN CONSTRUCCION'),
(14, 'TOMA DE REHENES'),
(15, 'INTENTO'),
(16, 'CONSUMADO'),
(17, 'SUMINISTRO ELECTRICO/SEÑAL DE TELEFONIA/OTROS'),
(18, 'ASALTO CON ARMA BLANCA/ ELEMENTO CONTUNDENTE'),
(19, 'ASALTO CON ARMA DE FUEGO'),
(20, 'SUSTRACCION DE BICICLETA'),
(21, 'VIVIENDA'),
(22, 'VIA PUBLICA'),
(23, 'CON ARMAS DE FUEGO'),
(24, 'ARMAS BLANCAS'),
(25, 'PELEA DE GRUPOS ANTAGONICOS'),
(26, 'PDISCUSION ENTRE VECINOS'),
(27, 'ABUSO SEXUAL'),
(28, 'TENTATIVA DE ABUSO'),
(29, 'ACOSO EN LA VIA PUBLICA'),
(30, 'AMENAZA DE BOMBA'),
(31, 'AMENAZA VERBAL'),
(32, 'AMENAZAS CON ARMA BLANCA'),
(33, 'AMENAZAS CON ARMA DE FUEGO'),
(34, 'DETONACIONES'),
(35, 'PORTACION DE ARMA BLANCA'),
(36, 'PORTACION DE ARMA DE FUEGO'),
(37, 'USO INDEBIDO HONDA/AIRECOMPRIMIDO'),
(38, 'EXIBICION OBSENA EN LA VIA PUBLICA'),
(39, 'VIOLENCIA DE GENERO EN DOMICILIO'),
(40, 'VIOLENCIA DE GENERO EN LA VIA PUBLICA'),
(41, 'VIOLENCIA INTRAFAMILIAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_relevancia`
--

CREATE TABLE `tipo_relevancia` (
  `id_tipo` int NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_relevancia`
--

INSERT INTO `tipo_relevancia` (`id_tipo`, `tipo`) VALUES
(1, 'SUSTRACCION DE MOTOCICLETA'),
(2, 'SUSTRACCION DE AUTOMOVIL'),
(3, 'ILICITO CONTRA LA PROPIEDAD'),
(4, 'ARREBATO'),
(5, 'ILICITO EN LA VIA PUBLICA'),
(6, 'DESORDEN'),
(7, 'ABUSO SEXUAL'),
(8, 'ACOSO SEXUAL'),
(9, 'AMENAZAS'),
(10, 'ARMAS'),
(11, 'EXHIBICIONES OBSENAS'),
(12, 'VIOLENCIA FAMILIAR Y DE GENERO');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario-comisaria`
--

INSERT INTO `usuario-comisaria` (`idUsuarioComisaria`, `idUsuario`, `idComisaria`, `habilitado`, `eliminado`) VALUES
(1, 1, 3, 1, 0),
(2, 1, 3, 1, 0),
(3, 1, 3, 1, 0),
(4, 1, 3, 1, 0),
(5, 1, 2, 1, 0),
(6, 1, 1, 1, 0),
(7, 1, 2, 1, 0),
(8, 1, 1, 1, 0),
(9, 1, 1, 1, 0),
(10, 1, 2, 1, 0),
(11, 1, 1, 1, 0),
(12, 1, 2, 1, 0),
(13, 1, 3, 1, 0),
(14, 11, 1, 1, 0),
(15, 11, 2, 1, 0),
(16, 11, 3, 1, 0),
(17, 11, 2, 1, 0),
(18, 19, 2, 1, 0),
(19, 20, 2, 1, 0),
(20, 18, 3, 1, 0),
(21, 2, 2, 1, 0),
(24, 14, 2, 1, 0),
(25, 14, 3, 1, 0),
(26, 14, 1, 1, 0),
(27, 14, 3, 1, 0),
(28, 14, 3, 1, 0),
(29, 14, 3, 1, 0),
(30, 14, 1, 1, 0),
(31, 14, 3, 1, 0),
(32, 14, 1, 1, 0),
(33, 12, 2, 1, 0),
(34, 13, 1, 1, 0),
(35, 13, 2, 1, 0),
(36, 13, 3, 1, 0),
(37, 14, 2, 1, 0),
(38, 14, 3, 1, 0),
(39, 14, 3, 1, 0),
(40, 14, 1, 1, 0),
(41, 14, 1, 1, 0),
(42, 14, 3, 1, 0),
(43, 14, 1, 1, 0),
(44, 14, 2, 1, 0),
(45, 14, 3, 1, 0),
(46, 14, 2, 1, 0),
(47, 14, 1, 1, 0),
(48, 14, 3, 1, 0),
(49, 14, 2, 1, 0),
(50, 14, 1, 1, 0),
(51, 14, 2, 1, 0),
(52, 14, 3, 1, 0),
(53, 2, 1, 1, 0),
(54, 2, 3, 1, 0),
(55, 14, 2, 1, 0),
(56, 3, 2, 1, 0),
(57, 3, 1, 1, 0),
(58, 3, 3, 1, 0),
(59, 4, 2, 1, 0),
(60, 4, 1, 1, 0);

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
  `eliminado` int NOT NULL,
  `idPersona` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `contraseña`, `rol`, `habilitado`, `eliminado`, `idPersona`) VALUES
(1, 'kbrauninger0', 'FPFXNlVp', 1, 0, 0, 1),
(2, 'tantill1', 'WlegYddi', 1, 0, 0, 2),
(3, 'ssamweyes2', 'XRpWBo', 1, 0, 0, 3),
(4, 'khallwell3', 'VIfKLGfO', 0, 0, 0, 4),
(5, 'svero4', '1tbo2v4zswE', 1, 1, 0, 5),
(6, 'dprosch5', 'hT3iSUVFoMzS', 1, 0, 0, 6),
(7, 'tmcaw6', 'itDte93Fov', 1, 0, 0, 7),
(8, 'bpittam7', 'BeayqLDUofC6', 0, 1, 0, 8),
(9, 'clorne8', 'ghFTIK1Cm0D5', 1, 1, 0, 9),
(10, 'bglidden9', 'oY7rgmJ43', 0, 1, 0, 10),
(11, 'nahuelmolina_07', '12345678', 1, 1, 0, 11),
(12, 'nahuelmolina_077', '12345678', 0, 1, 0, 12),
(13, 'nahuelmolina_05', '12345678', 0, 1, 0, 13),
(14, 'nahuelmolina_01', '12345678', 0, 1, 0, 14),
(15, 'nahuelmolina_99', '12345678', 0, 1, 0, 15),
(16, 'nahuelmolina_91', '12345678', 0, 1, 0, 16),
(17, 'nahuelmolina_60', '12345678', 0, 1, 0, 17),
(18, 'nahuelmolina_80', '12345678', 0, 1, 0, 18),
(19, 'nahuelmolina_23', '12345678', 0, 1, 0, 19),
(20, 'nahuelmolina_30', '12345678', 0, 1, 0, 20),
(21, 'nahuelmolina_02', '12345678', 0, 1, 0, 21),
(22, 'nahuelmolina_55', '12345678', 0, 1, 0, 22),
(23, 'nahuelmolina_66', '12345678', 0, 1, 0, 23);

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
-- Indices de la tabla `novedades_de_relevancia`
--
ALTER TABLE `novedades_de_relevancia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_subtipo` (`id_subtipo`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`idPersona`);

--
-- Indices de la tabla `subtipo_relevancia`
--
ALTER TABLE `subtipo_relevancia`
  ADD PRIMARY KEY (`id_subtipo`);

--
-- Indices de la tabla `tipo_relevancia`
--
ALTER TABLE `tipo_relevancia`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuario-comisaria`
--
ALTER TABLE `usuario-comisaria`
  ADD PRIMARY KEY (`idUsuarioComisaria`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idComisaria` (`idComisaria`) USING BTREE;

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
-- AUTO_INCREMENT de la tabla `novedades_de_relevancia`
--
ALTER TABLE `novedades_de_relevancia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idPersona` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `subtipo_relevancia`
--
ALTER TABLE `subtipo_relevancia`
  MODIFY `id_subtipo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `tipo_relevancia`
--
ALTER TABLE `tipo_relevancia`
  MODIFY `id_tipo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuario-comisaria`
--
ALTER TABLE `usuario-comisaria`
  MODIFY `idUsuarioComisaria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
-- Filtros para la tabla `novedades_de_relevancia`
--
ALTER TABLE `novedades_de_relevancia`
  ADD CONSTRAINT `novedades_de_relevancia_ibfk_1` FOREIGN KEY (`id_subtipo`) REFERENCES `subtipo_relevancia` (`id_subtipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `novedades_de_relevancia_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_relevancia` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

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
