-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-12-2022 a las 23:05:36
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

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
  `telefono` varchar(50) NOT NULL,
  `latitud` varchar(50) NOT NULL,
  `longitud` varchar(50) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comisarias`
--

INSERT INTO `comisarias` (`idComisaria`, `nombre`, `direccion`, `provincia`, `departamento`, `localidad`, `telefono`, `latitud`, `longitud`, `habilitado`, `eliminado`) VALUES
(1, 'Sexta', 'Av. virgen del valle 123', 'Catamarca', 'Capital', 'SFVC', '12312412', '12412', '21312312', 1, 0),
(2, 'Quinta', 'Av. virgen del valle 123', 'Catamarca', 'Capital', 'SFVC', '12312412', '23', '342', 0, 0),
(3, 'Cuarta', 'Rivadavia 123', 'Catamarca', 'Capital', 'SFVC', '+41241231', '5891347', '73642765', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_persona`
--

CREATE TABLE `ingreso_persona` (
  `id` int(11) NOT NULL,
  `fecha_hora_reg` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `subtipo` varchar(50) NOT NULL,
  `dispuesto_por` varchar(50) NOT NULL,
  `fecha_hora_ingreso` varchar(50) NOT NULL,
  `fecha_hora_egreso` varchar(50) DEFAULT NULL,
  `secuestro` varchar(10) NOT NULL,
  `elem_secuestrado` varchar(50) NOT NULL,
  `idComisaria` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingreso_persona`
--

INSERT INTO `ingreso_persona` (`id`, `fecha_hora_reg`, `tipo`, `subtipo`, `dispuesto_por`, `fecha_hora_ingreso`, `fecha_hora_egreso`, `secuestro`, `elem_secuestrado`, `idComisaria`, `idUsuario`, `eliminado`) VALUES
(21, '2022-12-02 12:05:35', 'ARREBATO', 'CONSUMADO', 'Santiago', '2022-12-17T19:12', '2022-12-06T18:04', 'No', 'nada', 2, 1, 0),
(22, '2022-12-02 12:24:22', 'SUSTRACCION DE MOTOCICLETA', 'INTERIOR DEL DOMICILIO', 'SANTIAGO ARMANDO', '2022-12-13T15:27', '2022-12-14T19:30', 'No', 'nada', 1, 1, 0),
(23, '2022-12-02 14:01:53', 'SUSTRACCION DE AUTOMOVIL', 'ELEMENTOS DEL INTERIOR', 'Carlos Aguirre ', '2023-01-05T17:05', '2022-12-20T17:20', 'Si', 'asdad', 1, 1, 0),
(24, '2022-12-02 14:18:10', 'SUSTRACCION DE AUTOMOVIL', 'ELEMENTOS DEL INTERIOR', 'Carlos Ahre', '2022-12-26T19:22', '2022-12-28T22:08', 'Si', 'nadanada', 1, 1, 1),
(25, '2022-12-02 14:42:42', 'SUSTRACCION DE AUTOMOVIL', 'SUSTRACCION DEL RODADO', 'Carlos Aguirre ', '2022-12-20T18:46', '2022-12-21T17:45', 'Si', 'nadanada', 2, 2, 0),
(26, '2022-12-07 12:11:33', 'SUSTRACCION DE MOTOCICLETA', 'USO DE ARMA BLANCA O DE FUEGO', 'Carlos Aguirre ', '2022-12-15T15:14', '', 'Si', 'Peine', 2, 1, 0),
(27, '2022-12-07 12:26:14', 'SUSTRACCION DE MOTOCICLETA', 'INTERIOR DEL DOMICILIO', 'juanjo', '2022-12-08T14:27', '2022-12-14T15:30', 'No', 'Peine', 1, 1, 1),
(28, '2022-12-07 12:31:05', 'DESORDEN', 'ARMAS BLANCAS', 'juanjo', '2022-12-14T15:33', '2022-12-22T15:33', 'Si', 'Peine', 1, 1, 1),
(29, '2022-12-07 16:38:31', 'SUSTRACCION DE MOTOCICLETA', 'INTERIOR DEL DOMICILIO', 'Carlos Aguirre ', '2022-12-24T20:42', NULL, 'Si', 'nadanada', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades_de_guardia`
--

CREATE TABLE `novedades_de_guardia` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idComisaria` int(11) NOT NULL,
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
  `demorados` int(11) NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `novedades_de_guardia`
--

INSERT INTO `novedades_de_guardia` (`id`, `idUsuario`, `idComisaria`, `fecha`, `turno`, `superior_de_turno`, `oficial_servicio`, `personas_de_guardia`, `motoristas`, `mov_funcionamiento`, `mov_fuera_de_servicio`, `detenidos_causa_federal`, `detenidos_justicia_ordinaria`, `arres_averiguacion_de_hecho`, `aprehendidos`, `arres_averiguacion_actividades`, `arres_info_codigo_de_faltas`, `demorados`, `eliminado`) VALUES
(7, 1, 1, '2022-10-12', 'VESPERTINO (14:00 - 22:00)', 'marcos', 'juan', 12, 4, '12', '3', 4, 4, 4, 4, 4, 4, 543, 0),
(8, 1, 1, '2022-10-07', 'MATUTINO (06:00 - 14:00)', 'asdasdasdasd', 'asdasdasd', 1, 1, '1', '1', 11, 1, 1, 111, 1, 1, 1111, 0),
(9, 1, 1, '2022-10-06', 'NOCTURNO (22:00 - 06:00)', 'julian', 'samira', 1, 32, '23', '3', 3, 43, 34, 3, 1, 0, 0, 0),
(10, 1, 1, '2022-10-06', 'NOCTURNO (22:00 - 06:00)', 'ramiro', 'samira', 1, 32, '23', '3', 3, 43, 34, 3, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades_de_relevancia`
--

CREATE TABLE `novedades_de_relevancia` (
  `id` int(11) NOT NULL,
  `fecha_reg_tabla` varchar(50) NOT NULL,
  `fecha_reg` varchar(50) NOT NULL,
  `hora_reg` varchar(20) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `subtipo` varchar(50) NOT NULL,
  `longitud` varchar(50) NOT NULL,
  `latitud` varchar(50) NOT NULL,
  `descripcion_lugar` varchar(60) NOT NULL,
  `sindicados` int(11) NOT NULL,
  `caracteristicas_hecho` varchar(250) NOT NULL,
  `movil` varchar(250) NOT NULL,
  `elemento_sustraido` varchar(250) NOT NULL,
  `hecho_consumado` varchar(50) NOT NULL,
  `elemento_utilizado` varchar(30) NOT NULL,
  `tipo_motocicleta` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `adelanto_circulacion` varchar(30) NOT NULL,
  `damnificado` varchar(250) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(30) NOT NULL,
  `denuncia` varchar(30) NOT NULL,
  `denunciante` varchar(250) NOT NULL,
  `unidad_judicial` varchar(60) NOT NULL,
  `comision_personal` varchar(30) NOT NULL,
  `medida_tomada` varchar(250) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  `idComisaria` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `novedades_de_relevancia`
--

INSERT INTO `novedades_de_relevancia` (`id`, `fecha_reg_tabla`, `fecha_reg`, `hora_reg`, `tipo`, `subtipo`, `longitud`, `latitud`, `descripcion_lugar`, `sindicados`, `caracteristicas_hecho`, `movil`, `elemento_sustraido`, `hecho_consumado`, `elemento_utilizado`, `tipo_motocicleta`, `color`, `adelanto_circulacion`, `damnificado`, `edad`, `sexo`, `denuncia`, `denunciante`, `unidad_judicial`, `comision_personal`, `medida_tomada`, `eliminado`, `idComisaria`, `idUsuario`) VALUES
(1, '2022/11/16', '2022-11-18', '1', 'ACOSO SEXUAL', 'ACOSO EN LA VIA PUBLICA', '28.47326', '-65.78756', '2', 3, '4', '5', '6', 'Consumado', 'Motocicleta', '110cc', '7', 'Si', '8', 9, 'Mujer', 'Si', '10', 'U.J. N° 1', 'Si', 'Detencion', 0, 2, 11),
(5, '2022/11/17', '2022-11-18', '14:35', 'ARREBATO', 'INTENTO', '-65.78874', '-28.47321', '1', 2, '3', '4', '5', 'Consumado', 'Motocicleta', '110cc', '6', 'Si', '7', 8, 'Hombre', 'Si', '9', 'U.J. N° 9', 'Si', 'Aprehension', 0, 2, 11),
(6, '2022/11/17', '2022-11-19', '02:45', 'ARREBATO', 'CONSUMADO', '-65.78756', '-28.47326', '1', 2, '3', '4', '5', 'Consumado', 'Motocicleta', '110cc', '6', 'Si', '7', 8, 'Mujer', 'Si', '9', 'U.J. N° 6', 'Si', 'Secuestros', 0, 2, 11),
(8, '2022/11/18', '2022-11-23', '02:45', 'ILICITO EN LA VIA PUBLICA', 'SUMINISTRO ELECTRICO/SEÑAL DE TELEFONIA/OTROS', '-65.79074', '-28.47294', '1', 2, '3', '4', '5', 'Consumado', 'Motocicleta', '110cc', '6', 'Si', '7', 8, 'No Binario', 'Si', '9', 'U.J. N° 7', 'Si', 'A.A.A', 0, 2, 11),
(9, '2022/11/18', '2022-11-14', '15:45', 'ARMAS', 'DETONACIONES', '-65.78214', '-28.47010', '1', 2, '3', '4', '5', 'Intento', 'Pie', 'null', 'null', 'No', '6', 7, 'Mujer', 'Si', '8', 'Fiscalia de instroduccion', 'No', 'Demora', 0, 2, 11),
(10, '2022/11/18', '2022-11-22', '09:40', 'SUSTRACCION DE AUTOMOVIL', 'SUSTRACCION DEL RODADO', '-65.78660', '-28.47729', '1', 2, '3', '4', '5', 'Consumado', 'Pie', 'null', 'null', 'No', '6', 7, 'Hombre', 'No', 'null', 'null', 'Si', 'Allanamiento', 0, 2, 11),
(11, '2022/11/18', '2022-11-23', '15:40', 'ACOSO SEXUAL', 'ACOSO EN LA VIA PUBLICA', '-65.78197', '-28.47388', '1', 2, '3', '4', '5', 'Intento', 'Motocicleta', 'No especifica', '6', 'No', '7', 8, 'No Binario', 'Si', '9', 'U.J. N° 6', 'Si', 'Registros', 0, 2, 11),
(12, '2022/11/18', '2022-11-23', '08:55', 'AMENAZAS', 'AMENAZAS CON ARMA BLANCA', '-65.77737', '-28.47653', '1', 2, '3', '4', '5', 'Consumado', 'Motocicleta', '110cc', '6', 'Si', '7', 8, 'Mujer', 'Si', '9', 'Unid. Violencia de genero', 'Si', 'Demora', 0, 2, 11),
(13, '2022/11/18', '2022-11-15', '03:45', 'EXHIBICIONES OBSENAS', 'EXHIBICION OBSENA EN LA VIA PUBLICA', '-65.78523', '-28.47314', '1', 2, '3', '4', '5', 'Consumado', 'Pie', 'null', 'null', 'No', '6', 7, 'Hombre', 'Si', '8', 'U.J. N° 7', 'Si', 'Aprehension', 0, 2, 11),
(14, '2022/11/18', '2022-11-22', '03:45', 'ILICITO CONTRA LA PROPIEDAD', 'COMERCIO', '-65.78960', '-28.47341', '1', 2, '3', '4', '5', 'Consumado', 'Motocicleta', '110cc', '6', 'Si', '7', 8, 'Mujer', 'Si', '9', 'U.J. N° 10', 'Si', 'A.A echo', 0, 2, 11),
(15, '2022/11/18', '2022-11-23', '03:45', 'ILICITO CONTRA LA PROPIEDAD', 'COMERCIO', '-65.79172', '-28.47071', '1', 2, '3', '4', '5', 'Consumado', 'Motocicleta', '110cc', '6', 'Si', '7', 8, 'Mujer', 'Si', '9', 'U.J. N° 9', 'Si', 'Detencion', 0, 2, 11),
(16, '2022/11/21', '2022-11-10', '03:45', 'ARREBATO', 'CONSUMADO', '-65.77739', '-28.47794', '1', 2, '3', '4', '5', 'Intento', 'Motocicleta', '125/150cc', '6', 'Si', '7', 8, 'No Binario', 'Si', '9', 'Fiscalia de instroduccion', 'Si', 'Aprehension', 0, 2, 11),
(17, '2022/11/22', '2022-11-30', '08:50', 'ACOSO SEXUAL', 'ACOSO EN LA VIA PUBLICA', '-65.77342', '-28.48456', '1', 2, '3', '4', '5', 'Consumado', 'Motocicleta', '110cc', '6', 'Si', '7', 8, 'Mujer', 'Si', '9', 'U.J. N° 10', 'Si', 'A.A echo', 0, 2, 11),
(18, '2022/11/22', '2022-11-18', '03:50', 'ABUSO SEXUAL', 'TENTATIVA DE ABUSO', '-65.78226', '-28.47309', '1', 2, '3', '4', '5', 'Intento', 'Motocicleta', 'Enduro', '6', 'Si', '7', 8, 'Hombre', 'Si', '9', 'Unid. Violencia de genero', 'Si', 'A.A echo', 0, 2, 11),
(19, '2022/11/22', '2022-11-10', '03:50', 'ARMAS', 'PORTACION DE ARMA DE FUEGO', '-65.77938', '-28.47394', '1', 2, '3', '4', '5', 'Intento', 'Motocicleta', '125/150cc', '6', 'Si', '7', 8, 'No Binario', 'Si', '9', 'U.J. N° 4', 'Si', 'A.A echo', 0, 2, 11),
(20, '2022/11/22', '2022-11-17', '18:45', 'ILICITO EN LA VIA PUBLICA', 'SUSTRACCION DE BICICLETA', '-65.78392', '-28.47294', '1', 2, '3', '4', '5', 'Consumado', 'Motocicleta', 'No especifica', '6', 'No', '7', 8, 'Mujer', 'Si', '9', 'U.J. N° 7', 'Si', 'Secuestros', 0, 2, 11),
(21, '2022/11/22', '2022-11-24', '16:45', 'ILICITO CONTRA LA PROPIEDAD', 'ASALTO CON ARMA BLANCA/ ELEMENTO CONTUNDENTE', '-65.79267', '-28.47255', '1', 2, '3', '4', '5', 'Intento', 'Motocicleta', 'No especifica', '6', 'Si', '7', 8, 'No Binario', 'Si', '9', 'U.J. N° 7', 'Si', 'Allanamiento', 0, 2, 11),
(22, '2022/11/24', '2022-11-26', '04:45', 'ABUSO SEXUAL', 'TENTATIVA DE ABUSO', '-65.78084', '-28.47458', '1', 2, '3', '4', '5', 'Consumado', 'Motocicleta', 'No especifica', '6', 'Si', '7', 8, 'Mujer', 'Si', '9', 'U.J. N° 11', 'Si', 'Detencion', 0, 2, 12),
(23, '2022/12/07', '2022-12-15', '01:10', 'ILICITO EN LA VIA PUBLICA', 'SUMINISTRO ELECTRICO/SEÑAL DE TELEFONIA/OTROS', '-65.78756', '-28.47326', '1', 2, '3', '4', '5', 'Consumado', 'Pie', 'null', 'null', 'Si', '6', 7, 'Masculino', 'Si', '8', 'U.J. N° 5', 'Si', 'Demora', 0, 2, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `idPersona` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `sexo` varchar(50) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `fechaRegistro` date DEFAULT NULL,
  `habilitado` int(11) DEFAULT NULL,
  `eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Estructura de tabla para la tabla `registro_secuestro`
--

CREATE TABLE `registro_secuestro` (
  `id` int(11) NOT NULL,
  `fecha_reg_tabla` varchar(50) NOT NULL,
  `fecha_reg` varchar(50) NOT NULL,
  `hora_reg` varchar(20) NOT NULL,
  `hecho` varchar(250) NOT NULL,
  `elemento_secuestrado` varchar(250) NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `idUsuario` int(11) NOT NULL,
  `idComisaria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro_secuestro`
--

INSERT INTO `registro_secuestro` (`id`, `fecha_reg_tabla`, `fecha_reg`, `hora_reg`, `hecho`, `elemento_secuestrado`, `eliminado`, `idUsuario`, `idComisaria`) VALUES
(1, '2022-05-29 18:18:18', '2022-12-12', '00:25', 'vamo newel', '123728uahs', 1, 11, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario-comisaria`
--

CREATE TABLE `usuario-comisaria` (
  `idUsuarioComisaria` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idComisaria` int(11) NOT NULL,
  `habilitado` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(15, 11, 2, 1, 0),
(18, 19, 3, 1, 0),
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
(60, 4, 1, 1, 0),
(61, 5, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `rol` int(11) NOT NULL,
  `habilitado` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(12, 'nahuelmolina_077', '12345678', 1, 1, 0, 12),
(13, 'nahuelmolina_05', '12345678', 0, 1, 0, 13),
(14, 'nahuelmolina_01', '12345678', 0, 1, 0, 14),
(15, 'nahuelmolina_99', '12345678', 0, 1, 0, 15),
(16, 'nahuelmolina_91', '12345678', 0, 1, 0, 16),
(17, 'nahuelmolina_60', '12345678', 0, 1, 0, 17),
(18, 'nahuelmolina_80', '12345678', 0, 1, 0, 18),
(19, 'nahuelmolina_96', '12345678', 0, 1, 0, 19),
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
-- Indices de la tabla `ingreso_persona`
--
ALTER TABLE `ingreso_persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idComisaria` (`idComisaria`),
  ADD KEY `idUsuario` (`idUsuario`);

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
  ADD KEY `idComisaria` (`idComisaria`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`idPersona`);

--
-- Indices de la tabla `registro_secuestro`
--
ALTER TABLE `registro_secuestro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`) USING BTREE,
  ADD KEY `idComisaria` (`idComisaria`) USING BTREE;

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
  MODIFY `idComisaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ingreso_persona`
--
ALTER TABLE `ingreso_persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `novedades_de_guardia`
--
ALTER TABLE `novedades_de_guardia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `novedades_de_relevancia`
--
ALTER TABLE `novedades_de_relevancia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `registro_secuestro`
--
ALTER TABLE `registro_secuestro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario-comisaria`
--
ALTER TABLE `usuario-comisaria`
  MODIFY `idUsuarioComisaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  ADD CONSTRAINT `novedades_de_relevancia_ibfk_3` FOREIGN KEY (`idComisaria`) REFERENCES `comisarias` (`idComisaria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `novedades_de_relevancia_ibfk_4` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_secuestro`
--
ALTER TABLE `registro_secuestro`
  ADD CONSTRAINT `registro_secuestro_ibfk_1` FOREIGN KEY (`idComisaria`) REFERENCES `comisarias` (`idComisaria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registro_secuestro_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario-comisaria`
--
ALTER TABLE `usuario-comisaria`
  ADD CONSTRAINT `idComisarias` FOREIGN KEY (`idComisaria`) REFERENCES `comisarias` (`idComisaria`),
  ADD CONSTRAINT `idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `idPersona` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
