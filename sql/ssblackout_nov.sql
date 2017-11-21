-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-11-2017 a las 17:34:33
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ssblackout`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbcabecerapresupuesto`
--

CREATE TABLE IF NOT EXISTS `dbcabecerapresupuesto` (
  `idcabecerapresupuesto` int(11) NOT NULL AUTO_INCREMENT,
  `refusuarios` int(11) NOT NULL,
  `refclientes` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(18,2) NOT NULL,
  `adelanto` decimal(18,2) DEFAULT NULL,
  `solicitante` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nrodocumento` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `refestados` int(11) NOT NULL,
  PRIMARY KEY (`idcabecerapresupuesto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `dbcabecerapresupuesto`
--

INSERT INTO `dbcabecerapresupuesto` (`idcabecerapresupuesto`, `refusuarios`, `refclientes`, `fecha`, `monto`, `adelanto`, `solicitante`, `nrodocumento`, `observaciones`, `refestados`) VALUES
(5, 1, 1, '2017-07-13', '4680.00', '0.00', 'Safar M', '31552466', '                        \n                        ', 1),
(6, 1, 1, '2017-07-13', '2460.00', '0.00', 'Claudio', '45123689', '                        \n                        ', 1),
(7, 1, 1, '2017-07-24', '3840.00', '0.00', 'juan', '31553434', '                        \n                        ', 3),
(8, 1, 1, '2017-11-10', '2328.00', '0.00', 'ricardo', '3165498', '                        \n                        ', 3),
(10, 1, 1, '2017-11-11', '3944.60', '0.00', 'marcos', '3156849', '                        \n                        ', 3),
(11, 1, 1, '2017-11-17', '13628.00', '0.00', 'Juan alberto', '3516849', '                        \n                        ', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbclientes`
--

CREATE TABLE IF NOT EXISTS `dbclientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombrecompleto` varchar(120) NOT NULL,
  `cuil` varchar(11) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `observaciones` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbclientes`
--

INSERT INTO `dbclientes` (`idcliente`, `nombrecompleto`, `cuil`, `dni`, `direccion`, `telefono`, `email`, `observaciones`) VALUES
(1, 'Cliente', '20315524661', '31552466', '76', '46598', '', ''),
(2, 'Jorge Orellana', '', '1656879', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbordenes`
--

CREATE TABLE IF NOT EXISTS `dbordenes` (
  `idorden` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `refventas` int(11) NOT NULL,
  `fechacrea` datetime DEFAULT NULL,
  `fechamodi` datetime DEFAULT NULL,
  `usuacrea` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuamodi` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `refestados` int(11) NOT NULL,
  `refsistemas` int(11) NOT NULL,
  `reftelas` int(11) NOT NULL,
  `refresiduos` int(11) NOT NULL,
  `roller` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `tramado` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `ancho` decimal(18,2) NOT NULL,
  `alto` decimal(18,2) NOT NULL,
  `reftelaopcional` int(11) DEFAULT NULL,
  `esdoble` bit(1) NOT NULL,
  `monto` decimal(18,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `caida` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mando` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idorden`),
  KEY `fk_dbordenes_tbestados1_idx` (`refestados`),
  KEY `fk_ordenes_dbventas_idx` (`refventas`),
  KEY `fk_ordenes_sistema_idx` (`refsistemas`),
  KEY `fk_ordenes_telas_idx` (`reftelas`),
  KEY `fk_ordenes_residuo_idx` (`refresiduos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `dbordenes`
--

INSERT INTO `dbordenes` (`idorden`, `numero`, `refventas`, `fechacrea`, `fechamodi`, `usuacrea`, `usuamodi`, `refestados`, `refsistemas`, `reftelas`, `refresiduos`, `roller`, `tramado`, `ancho`, `alto`, `reftelaopcional`, `esdoble`, `monto`, `cantidad`, `caida`, `mando`) VALUES
(2, 'ORD0000001', 7, '2017-07-24 05:45:12', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 1, 1, '33.00', 'Beige', '1.00', '2.00', 0, b'0', NULL, NULL, NULL, NULL),
(3, 'ORD0000001', 7, '2017-07-24 05:45:12', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 2, 1, 1, '35.00', 'Beige - Segunda Tela: Beige', '2.00', '2.00', 2, b'1', NULL, NULL, NULL, NULL),
(4, 'ORD0000004', 8, '2017-10-13 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 5, 3, 1, 1, '35.00', 'Beige', '1.00', '1.00', 0, b'0', '246.00', NULL, NULL, NULL),
(5, 'ORD0000005', 9, '2017-10-13 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 3, 2, 2, '35.00', 'Beige', '1.20', '1.50', 0, b'0', '698.00', NULL, NULL, NULL),
(6, 'ORD0000006', 10, '2017-11-10 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 1, 1, '32.00', 'Beige', '1.50', '1.00', 0, b'0', '900.00', NULL, NULL, NULL),
(7, 'ORD0000007', 10, '2017-11-10 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 1, 1, '32.00', 'Beige', '2.10', '1.00', 0, b'0', '1428.00', NULL, NULL, NULL),
(8, 'ORD0000008', 14, '2017-11-11 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 2, 1, '32.00', 'Beige', '1.15', '2.10', 0, b'0', '1092.50', 1, 'invertida', 'izquierda'),
(9, 'ORD0000009', 14, '2017-11-11 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 2, 1, '32.00', 'Beige', '1.95', '2.10', 0, b'0', '1852.50', 1, 'invertida', 'izquierda'),
(10, 'ORD0000010', 14, '2017-11-11 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 2, 1, '32.00', 'Beige', '1.02', '2.20', 0, b'0', '999.60', 1, 'invertida', 'izquierda'),
(11, 'ORD0000011', 16, '2017-11-17 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 1, 1, '32.00', 'Beige', '1.45', '1.60', 0, b'0', '5568.00', 5, 'invertida', 'derecha'),
(12, 'ORD0000012', 16, '2017-11-17 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 2, 1, '32.00', 'Beige', '1.30', '1.00', 0, b'0', '8060.00', 10, 'comun', 'izquierda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbordenessistematareas`
--

CREATE TABLE IF NOT EXISTS `dbordenessistematareas` (
  `idordenesistematarea` int(11) NOT NULL AUTO_INCREMENT,
  `refsistematareas` int(11) NOT NULL,
  `refordenes` int(11) NOT NULL,
  `cumplida` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`idordenesistematarea`),
  KEY `fk_ost_sistematarea_idx` (`refsistematareas`),
  KEY `fk_ost_ordenes_idx` (`refordenes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `dbordenessistematareas`
--

INSERT INTO `dbordenessistematareas` (`idordenesistematarea`, `refsistematareas`, `refordenes`, `cumplida`) VALUES
(1, 1, 2, b'1'),
(2, 1, 3, b'0'),
(5, 2, 2, b'1'),
(6, 1, 6, b'0'),
(7, 2, 6, b'0'),
(8, 3, 6, b'0'),
(9, 4, 6, b'0'),
(13, 1, 7, b'0'),
(14, 2, 7, b'0'),
(15, 3, 7, b'0'),
(16, 4, 7, b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpagos`
--

CREATE TABLE IF NOT EXISTS `dbpagos` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `refclientes` int(11) NOT NULL,
  `pago` decimal(18,2) NOT NULL,
  `fechapago` datetime NOT NULL,
  `observaciones` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idpago`),
  KEY `fk_pagos_clientes_idx` (`refclientes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpresupuestos`
--

CREATE TABLE IF NOT EXISTS `dbpresupuestos` (
  `idpresupuesto` int(11) NOT NULL AUTO_INCREMENT,
  `fechacrea` datetime DEFAULT NULL,
  `fechamodi` datetime DEFAULT NULL,
  `usuacrea` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuamodi` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `refestados` int(11) NOT NULL,
  `refsistemas` int(11) NOT NULL,
  `reftelas` int(11) NOT NULL,
  `refresiduos` int(11) NOT NULL,
  `roller` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `tramado` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `ancho` decimal(18,2) NOT NULL,
  `alto` decimal(18,2) NOT NULL,
  `reftelaopcional` int(11) DEFAULT NULL,
  `esdoble` bit(1) NOT NULL,
  `montofinal` decimal(18,2) NOT NULL,
  `refcabecerapresupuesto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `caida` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mando` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refclientes` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpresupuesto`),
  KEY `fk_presupuesto_cabecera_idx` (`refcabecerapresupuesto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `dbpresupuestos`
--

INSERT INTO `dbpresupuestos` (`idpresupuesto`, `fechacrea`, `fechamodi`, `usuacrea`, `usuamodi`, `refestados`, `refsistemas`, `reftelas`, `refresiduos`, `roller`, `tramado`, `ancho`, `alto`, `reftelaopcional`, `esdoble`, `montofinal`, `refcabecerapresupuesto`, `cantidad`, `caida`, `mando`, `refclientes`) VALUES
(3, '2017-07-13 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 2, 1, 1, '35.00', 'Beige - Segunda Tela: Beige', '3.00', '2.00', 2, b'1', '4680.00', 5, 1, NULL, NULL, NULL),
(4, '2017-07-13 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 2, 1, '33.00', 'Beige', '1.00', '2.00', 0, b'0', '3000.00', 5, 1, NULL, NULL, NULL),
(5, '2017-07-13 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 1, 1, '33.00', 'Beige', '3.00', '1.50', 0, b'0', '2460.00', 6, 1, NULL, NULL, NULL),
(6, '2017-07-13 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 2, 1, 1, '35.00', 'Beige - Segunda Tela: Beige', '3.00', '1.50', 2, b'1', '3810.00', 6, 1, NULL, NULL, NULL),
(7, '2017-07-24 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 1, 1, '33.00', 'Beige', '1.00', '2.00', 0, b'0', '880.00', 7, 1, NULL, NULL, NULL),
(8, '2017-07-24 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 2, 1, 1, '35.00', 'Beige - Segunda Tela: Beige', '2.00', '2.00', 2, b'1', '2960.00', 7, 1, NULL, NULL, NULL),
(9, '2017-11-10 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 1, 1, '32.00', 'Beige', '1.50', '1.00', 0, b'0', '900.00', 8, 1, NULL, NULL, NULL),
(10, '2017-11-10 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 1, 1, '32.00', 'Beige', '2.10', '1.00', 0, b'0', '1428.00', 8, 1, NULL, NULL, NULL),
(11, '2017-11-11 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 2, 1, '32.00', 'Beige', '1.15', '2.10', 0, b'0', '1092.50', 10, 1, 'invertida', 'izquierda', NULL),
(12, '2017-11-11 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 2, 1, '32.00', 'Beige', '1.95', '2.10', 0, b'0', '1852.50', 10, 1, 'invertida', 'izquierda', NULL),
(13, '2017-11-11 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 2, 1, '32.00', 'Beige', '1.02', '2.20', 0, b'0', '999.60', 10, 1, 'invertida', 'izquierda', NULL),
(14, '2017-11-17 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 1, 1, '32.00', 'Beige', '1.45', '1.60', 0, b'0', '5568.00', 11, 5, 'invertida', 'derecha', NULL),
(15, '2017-11-17 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 2, 1, '32.00', 'Beige', '1.30', '1.00', 0, b'0', '8060.00', 11, 10, 'comun', 'izquierda', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbproveedores`
--

CREATE TABLE IF NOT EXISTS `dbproveedores` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `cuit` varchar(11) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `observacionces` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idproveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbsistemas`
--

CREATE TABLE IF NOT EXISTS `dbsistemas` (
  `idsistema` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `refroller` int(11) NOT NULL,
  `desde` decimal(18,2) NOT NULL,
  `hasta` decimal(18,2) DEFAULT NULL,
  `preciocosto` decimal(18,2) NOT NULL,
  `preciocliente` decimal(18,2) NOT NULL,
  PRIMARY KEY (`idsistema`),
  KEY `fk_sistemas_roller_idx` (`refroller`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `dbsistemas`
--

INSERT INTO `dbsistemas` (`idsistema`, `nombre`, `refroller`, `desde`, `hasta`, `preciocosto`, `preciocliente`) VALUES
(1, 'Sistema 32', 2, '0.00', '2.00', '320.00', '380.00'),
(2, 'Sistema 38', 1, '2.01', '2.60', '400.00', '450.00'),
(3, 'Confeccion', 1, '900.00', '910.00', '50.00', '50.00'),
(4, 'Sistema 45', 3, '2.61', '3.70', '300.00', '510.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbsistematareas`
--

CREATE TABLE IF NOT EXISTS `dbsistematareas` (
  `idsistematarea` int(11) NOT NULL AUTO_INCREMENT,
  `refsistemas` int(11) NOT NULL,
  `reftipotarea` int(11) NOT NULL,
  PRIMARY KEY (`idsistematarea`),
  KEY `fk_st_sistemas_idx` (`refsistemas`),
  KEY `fk_st_tareas_idx` (`reftipotarea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `dbsistematareas`
--

INSERT INTO `dbsistematareas` (`idsistematarea`, `refsistemas`, `reftipotarea`) VALUES
(1, 1, 3),
(2, 1, 1),
(3, 1, 2),
(4, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbtelas`
--

CREATE TABLE IF NOT EXISTS `dbtelas` (
  `idtela` int(11) NOT NULL AUTO_INCREMENT,
  `tela` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `reftipotramados` int(11) NOT NULL,
  `ancho` decimal(10,2) NOT NULL,
  `alto` decimal(10,2) NOT NULL,
  `preciolista` decimal(18,2) NOT NULL,
  `preciocosto` decimal(18,2) NOT NULL,
  `preciocliente` decimal(18,2) NOT NULL,
  PRIMARY KEY (`idtela`),
  KEY `fk_telas_tramas_idx` (`reftipotramados`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbtelas`
--

INSERT INTO `dbtelas` (`idtela`, `tela`, `reftipotramados`, `ancho`, `alto`, `preciolista`, `preciocosto`, `preciocliente`) VALUES
(1, 'BlackOut', 1, '1800.00', '27000.00', '200.00', '280.00', '280.00'),
(2, 'Screen 5%', 1, '1800.00', '27000.00', '210.00', '300.00', '320.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbusuarios`
--

CREATE TABLE IF NOT EXISTS `dbusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `refroles` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecompleto` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `fk_dbusuarios_tbroles1_idx` (`refroles`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroles`, `email`, `nombrecompleto`) VALUES
(1, 'marcos', 'marcos', 1, 'msredhotero@msn.com', 'Saupurein Marcos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbventas`
--

CREATE TABLE IF NOT EXISTS `dbventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `cantidadtotal` int(11) DEFAULT NULL,
  `adelanto` decimal(18,2) DEFAULT NULL,
  `total` decimal(18,2) NOT NULL,
  `refclientes` int(11) NOT NULL,
  `reftipopago` int(11) NOT NULL,
  `observacion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cancelada` bit(1) DEFAULT NULL,
  `refpresupuesto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idventa`),
  KEY `fk_venta_cliente_idx` (`refclientes`),
  KEY `fk_ventas_tipopago_idx` (`reftipopago`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `dbventas`
--

INSERT INTO `dbventas` (`idventa`, `numero`, `fecha`, `cantidadtotal`, `adelanto`, `total`, `refclientes`, `reftipopago`, `observacion`, `cancelada`, `refpresupuesto`) VALUES
(7, 'CC00000001', '2017-07-24', NULL, '0.00', '3840.00', 1, 3, '                        \n                        ', b'0', 7),
(8, 'CC00000008', '2017-10-13', NULL, '0.00', '246.00', 1, 1, '', b'1', 0),
(9, 'CC00000009', '2017-10-13', NULL, '0.00', '698.00', 1, 1, '', b'0', 0),
(10, 'CC00000010', '2017-11-10', NULL, '0.00', '2328.00', 1, 1, '                        \n                        ', b'0', 8),
(14, 'CC00000011', '2017-11-11', 3, '0.00', '3944.60', 1, 1, '                        \n                        ', b'0', 10),
(16, 'CC00000016', '2017-11-17', 15, '0.00', '13628.00', 1, 1, '                        \n                        ', b'0', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `idfoto` int(11) NOT NULL AUTO_INCREMENT,
  `refproyecto` int(11) NOT NULL,
  `refuser` int(11) NOT NULL,
  `imagen` varchar(500) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `principal` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idfoto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predio_menu`
--

CREATE TABLE IF NOT EXISTS `predio_menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(1, '../index.php', 'icodashboard', 'Dashboard', 0, NULL, 'Empleado, Administrador, SuperAdmin'),
(3, '../ventas/', 'icoventas', 'Ventas', 2, NULL, 'Empleado, Administrador, SuperAdmin'),
(4, '../clientes/', 'icousuarios', 'Clientes', 6, NULL, 'Empleado, Administrador, SuperAdmin'),
(5, '../sistemas/', 'icoproductos', 'Sistemas', 2, NULL, 'Empleado, Administrador, SuperAdmin'),
(6, '../proveedores/', 'icocontratos', 'Proveedores', 12, NULL, 'Empleado, Administrador, SuperAdmin'),
(7, '../reportes/', 'icoreportes', 'Reportes', 16, NULL, 'Empleado, Administrador, SuperAdmin'),
(8, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Empleado, Administrador, SuperAdmin'),
(9, '../configuracion/', 'icoconfiguracion', 'Configuraciones', 14, NULL, 'Empleado, Administrador, SuperAdmin'),
(15, '../tipotramado/', 'icozonas', 'Tipo Tramado', 8, NULL, 'Empleado, Administrador, SuperAdmin'),
(16, '../usuarios/', 'icojugadores', 'Usuarios', 13, NULL, 'Empleado, Administrador, SuperAdmin'),
(17, '../residuos/', 'icoresiduo', 'Residuos', 5, NULL, 'Empleado, Administrador, SuperAdmin'),
(18, '../telas/', 'icozonas', 'Telas', 9, NULL, 'Empleado, Administrador, SuperAdmin'),
(19, '../roller/', 'icozonas', 'Roller', 10, NULL, 'Empleado, Administrador, SuperAdmin'),
(20, '../cotizador/', 'icocotizador', 'Cotizador', 1, NULL, 'Empleado, Administrador, SuperAdmin'),
(21, '../pagos/', 'icopagos', 'Pagos', 5, NULL, 'Administrador, SuperAdmin'),
(22, '../ordenes/', 'icoalquileres', 'Ordenes', 4, NULL, 'Administrador, SuperAdmin'),
(23, '../presupuestos/', 'icoalquileres', 'Presupuesto', 3, NULL, 'Administrador, SuperAdmin'),
(24, '../estadisticas/', 'icochart', 'Estadisticas', 15, NULL, 'Administrador, SuperAdmin'),
(25, '../tipotareas/', 'icoalquileres', 'Tareas', 17, NULL, 'Administrador, SuperAdmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbconfiguracion`
--

CREATE TABLE IF NOT EXISTS `tbconfiguracion` (
  `idconfiguracion` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(130) COLLATE utf8_spanish_ci NOT NULL,
  `cuit` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(220) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `localidad` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigopostal` varchar(6) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idconfiguracion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbconfiguracion`
--

INSERT INTO `tbconfiguracion` (`idconfiguracion`, `empresa`, `cuit`, `direccion`, `telefono`, `email`, `localidad`, `codigopostal`) VALUES
(1, 'BlackOut', '', '', '', '', 'Ensenada', '1925');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbestados`
--

CREATE TABLE IF NOT EXISTS `tbestados` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(29) NOT NULL,
  `icono` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbestados`
--

INSERT INTO `tbestados` (`idestado`, `estado`, `icono`) VALUES
(1, 'Cargado', NULL),
(2, 'En Curso', NULL),
(3, 'Finalizado', NULL),
(4, 'Finalizado - Incompleto', NULL),
(5, 'Cancelado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmeses`
--

CREATE TABLE IF NOT EXISTS `tbmeses` (
  `mes` int(11) NOT NULL,
  `nombremes` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`mes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbmeses`
--

INSERT INTO `tbmeses` (`mes`, `nombremes`) VALUES
(1, 'Enero'),
(2, 'Febrero'),
(3, 'Marzo'),
(4, 'Abril'),
(5, 'Mayo'),
(6, 'Junio'),
(7, 'Julio'),
(8, 'Agosto'),
(9, 'Septiembre'),
(10, 'Octubre'),
(11, 'Noviembre'),
(12, 'Diciembre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbresiduos`
--

CREATE TABLE IF NOT EXISTS `tbresiduos` (
  `idresiduo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `roller` decimal(6,2) NOT NULL,
  `telaancho` decimal(6,2) NOT NULL,
  `telaalto` decimal(6,2) NOT NULL,
  `zocalo` decimal(6,2) NOT NULL,
  PRIMARY KEY (`idresiduo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbresiduos`
--

INSERT INTO `tbresiduos` (`idresiduo`, `nombre`, `roller`, `telaancho`, `telaalto`, `zocalo`) VALUES
(1, 'Sistema Comun', '30.00', '35.00', '300.00', '35.00'),
(2, 'Confeccion', '0.00', '0.00', '-300.00', '200.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroles`
--

CREATE TABLE IF NOT EXISTS `tbroles` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbroles`
--

INSERT INTO `tbroles` (`idrol`, `descripcion`, `activo`) VALUES
(1, 'Administrador', b'1'),
(2, 'Empleado', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroller`
--

CREATE TABLE IF NOT EXISTS `tbroller` (
  `idroller` int(11) NOT NULL AUTO_INCREMENT,
  `diametro` decimal(6,2) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`idroller`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbroller`
--

INSERT INTO `tbroller` (`idroller`, `diametro`, `activo`) VALUES
(1, '38.00', b'1'),
(2, '32.00', b'1'),
(3, '45.00', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipopago`
--

CREATE TABLE IF NOT EXISTS `tbtipopago` (
  `idtipopago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) NOT NULL,
  PRIMARY KEY (`idtipopago`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbtipopago`
--

INSERT INTO `tbtipopago` (`idtipopago`, `descripcion`) VALUES
(1, 'Contado'),
(2, 'Tarjeta'),
(3, 'Debito'),
(4, 'Cheque'),
(5, 'Cuenta Corriente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipotarea`
--

CREATE TABLE IF NOT EXISTS `tbtipotarea` (
  `idtipotarea` int(11) NOT NULL AUTO_INCREMENT,
  `tarea` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `detalle` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idtipotarea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbtipotarea`
--

INSERT INTO `tbtipotarea` (`idtipotarea`, `tarea`, `valor`, `detalle`) VALUES
(1, 'Cortar Tela', 2, ''),
(2, 'Cortar Caños', 2, ''),
(3, 'Armar Codos', 3, ''),
(4, 'Armar Sistema', 10, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipotramados`
--

CREATE TABLE IF NOT EXISTS `tbtipotramados` (
  `idtipotramado` int(11) NOT NULL AUTO_INCREMENT,
  `tipotramado` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idtipotramado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbtipotramados`
--

INSERT INTO `tbtipotramados` (`idtipotramado`, `tipotramado`, `activo`) VALUES
(1, 'Beige', b'1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dbordenes`
--
ALTER TABLE `dbordenes`
  ADD CONSTRAINT `fk_dbordenes_tbestados1` FOREIGN KEY (`refestados`) REFERENCES `tbestados` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordenes_dbventas` FOREIGN KEY (`refventas`) REFERENCES `dbventas` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordenes_residuo` FOREIGN KEY (`refresiduos`) REFERENCES `tbresiduos` (`idresiduo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordenes_sistema` FOREIGN KEY (`refsistemas`) REFERENCES `dbsistemas` (`idsistema`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordenes_telas` FOREIGN KEY (`reftelas`) REFERENCES `dbtelas` (`idtela`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbordenessistematareas`
--
ALTER TABLE `dbordenessistematareas`
  ADD CONSTRAINT `fk_ost_ordenes` FOREIGN KEY (`refordenes`) REFERENCES `dbordenes` (`idorden`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ost_sistematarea` FOREIGN KEY (`refsistematareas`) REFERENCES `dbsistematareas` (`idsistematarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbpagos`
--
ALTER TABLE `dbpagos`
  ADD CONSTRAINT `fk_pagos_clientes` FOREIGN KEY (`refclientes`) REFERENCES `dbclientes` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbpresupuestos`
--
ALTER TABLE `dbpresupuestos`
  ADD CONSTRAINT `fk_presupuesto_cabecera` FOREIGN KEY (`refcabecerapresupuesto`) REFERENCES `dbcabecerapresupuesto` (`idcabecerapresupuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbsistemas`
--
ALTER TABLE `dbsistemas`
  ADD CONSTRAINT `fk_sistemas_roller` FOREIGN KEY (`refroller`) REFERENCES `tbroller` (`idroller`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbsistematareas`
--
ALTER TABLE `dbsistematareas`
  ADD CONSTRAINT `fk_st_sistemas` FOREIGN KEY (`refsistemas`) REFERENCES `dbsistemas` (`idsistema`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_st_tareas` FOREIGN KEY (`reftipotarea`) REFERENCES `tbtipotarea` (`idtipotarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbtelas`
--
ALTER TABLE `dbtelas`
  ADD CONSTRAINT `fk_telas_tramas` FOREIGN KEY (`reftipotramados`) REFERENCES `tbtipotramados` (`idtipotramado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbventas`
--
ALTER TABLE `dbventas`
  ADD CONSTRAINT `fk_ventas_tipopago` FOREIGN KEY (`reftipopago`) REFERENCES `tbtipopago` (`idtipopago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`refclientes`) REFERENCES `dbclientes` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
