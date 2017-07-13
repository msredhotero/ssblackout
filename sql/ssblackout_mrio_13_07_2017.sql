-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-07-2017 a las 23:25:23
-- Versión del servidor: 5.1.36-community-log
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
  `nrodocuemnto` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idcabecerapresupuesto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `dbcabecerapresupuesto`
--

INSERT INTO `dbcabecerapresupuesto` (`idcabecerapresupuesto`, `refusuarios`, `refclientes`, `fecha`, `monto`, `adelanto`, `solicitante`, `nrodocuemnto`, `observaciones`) VALUES
(5, 1, 1, '2017-07-13', '4680.00', '0.00', 'Safar M', '31552466', '                        \n                        '),
(6, 1, 1, '2017-07-13', '2460.00', '0.00', 'Claudio', '45123689', '                        \n                        ');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbclientes`
--

INSERT INTO `dbclientes` (`idcliente`, `nombrecompleto`, `cuil`, `dni`, `direccion`, `telefono`, `email`, `observaciones`) VALUES
(1, 'Cliente', '20315524661', '31552466', '76', '46598', '', '');

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
  PRIMARY KEY (`idorden`),
  KEY `fk_dbordenes_tbestados1_idx` (`refestados`),
  KEY `fk_ordenes_dbventas_idx` (`refventas`),
  KEY `fk_ordenes_sistema_idx` (`refsistemas`),
  KEY `fk_ordenes_telas_idx` (`reftelas`),
  KEY `fk_ordenes_residuo_idx` (`refresiduos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbordenes`
--

INSERT INTO `dbordenes` (`idorden`, `numero`, `refventas`, `fechacrea`, `fechamodi`, `usuacrea`, `usuamodi`, `refestados`, `refsistemas`, `reftelas`, `refresiduos`, `roller`, `tramado`, `ancho`, `alto`, `reftelaopcional`, `esdoble`) VALUES
(1, 'ORD0000001', 4, '2016-12-27 00:00:00', '2016-12-28 00:00:00', 'Administrador', 'Administrador', 1, 2, 1, 1, '35.00', 'Beige - Beige', '210.00', '120.00', 2, b'1');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`idpresupuesto`),
  KEY `fk_presupuesto_cabecera_idx` (`refcabecerapresupuesto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `dbpresupuestos`
--

INSERT INTO `dbpresupuestos` (`idpresupuesto`, `fechacrea`, `fechamodi`, `usuacrea`, `usuamodi`, `refestados`, `refsistemas`, `reftelas`, `refresiduos`, `roller`, `tramado`, `ancho`, `alto`, `reftelaopcional`, `esdoble`, `montofinal`, `refcabecerapresupuesto`) VALUES
(3, '2017-07-13 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 2, 1, 1, '35.00', 'Beige - Segunda Tela: Beige', '3.00', '2.00', 2, b'1', '4680.00', 5),
(4, '2017-07-13 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 2, 1, '33.00', 'Beige', '1.00', '2.00', 0, b'0', '3000.00', 5),
(5, '2017-07-13 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 1, 1, 1, '33.00', 'Beige', '3.00', '1.50', 0, b'0', '2460.00', 6),
(6, '2017-07-13 00:00:00', '0000-00-00 00:00:00', 'Saupurein Marcos', '', 1, 2, 1, 1, '35.00', 'Beige - Segunda Tela: Beige', '3.00', '1.50', 2, b'1', '3810.00', 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbsistemas`
--

INSERT INTO `dbsistemas` (`idsistema`, `nombre`, `refroller`, `desde`, `hasta`, `preciocosto`, `preciocliente`) VALUES
(1, 'Sistema de 0 a 2 metros', 2, '0.00', '2.00', '320.00', '380.00'),
(2, 'Sistema de 2 a 3 metros', 1, '2.01', '3.00', '400.00', '430.00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbsistematareas`
--

INSERT INTO `dbsistematareas` (`idsistematarea`, `refsistemas`, `reftipotarea`) VALUES
(1, 1, 3);

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
(1, 'BlackOut 1%', 1, '1800.00', '27000.00', '200.00', '280.00', '280.00'),
(2, 'Screen 1%', 1, '1800.00', '27000.00', '210.00', '300.00', '320.00');

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
  `sistema` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tela` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `total` decimal(18,2) NOT NULL,
  `refclientes` int(11) NOT NULL,
  `reftipopago` int(11) NOT NULL,
  `cancelada` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idventa`),
  KEY `fk_venta_cliente_idx` (`refclientes`),
  KEY `fk_ventas_tipopago_idx` (`reftipopago`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `dbventas`
--

INSERT INTO `dbventas` (`idventa`, `numero`, `sistema`, `tela`, `total`, `refclientes`, `reftipopago`, `cancelada`) VALUES
(4, 'CC00000001', 'Sistema de 2 a 3 metros', 'BlackOut 1% - Screen 1%', '1496.20', 1, 3, b'0'),
(5, 'CC00000005', 'Sistema de 0 a 2 metros', '', '1800.00', 1, 1, b'0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(1, '../index.php', 'icodashboard', 'Dashboard', 0, NULL, 'Empleado, Administrador, SuperAdmin'),
(3, '../ventas/', 'icoventas', 'Ventas', 3, NULL, 'Empleado, Administrador, SuperAdmin'),
(4, '../clientes/', 'icousuarios', 'Clientes', 4, NULL, 'Empleado, Administrador, SuperAdmin'),
(5, '../sistemas/', 'icoproductos', 'Sistemas', 2, NULL, 'Empleado, Administrador, SuperAdmin'),
(6, '../proveedores/', 'icocontratos', 'Proveedores', 6, NULL, 'Empleado, Administrador, SuperAdmin'),
(7, '../reportes/', 'icoreportes', 'Reportes', 16, NULL, 'Empleado, Administrador, SuperAdmin'),
(8, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Empleado, Administrador, SuperAdmin'),
(9, '../configuraciones/', 'icoconfiguracion', 'Configuraciones', 7, NULL, 'Empleado, Administrador, SuperAdmin'),
(15, '../tipotramado/', 'icozonas', 'Tipo Tramado', 8, NULL, 'Empleado, Administrador, SuperAdmin'),
(16, '../usuarios/', 'icojugadores', 'Usuarios', 13, NULL, 'Empleado, Administrador, SuperAdmin'),
(17, '../residuos/', 'icoresiduo', 'Residuos', 5, NULL, 'Empleado, Administrador, SuperAdmin'),
(18, '../telas/', 'icozonas', 'Telas', 9, NULL, 'Empleado, Administrador, SuperAdmin'),
(19, '../roller/', 'icozonas', 'Roller', 10, NULL, 'Empleado, Administrador, SuperAdmin'),
(20, '../cotizador/', 'icocotizador', 'Cotizador', 1, NULL, 'Empleado, Administrador, SuperAdmin'),
(21, '../pagos/', 'icopagos', 'Pagos', 11, NULL, 'Administrador, SuperAdmin'),
(22, '../ordenes/', 'icoalquileres', 'Ordenes', 3, NULL, 'Administrador, SuperAdmin'),
(23, '../presupuestos/', 'icoalquileres', 'Presupuesto', 12, NULL, 'Administrador, SuperAdmin');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbresiduos`
--

INSERT INTO `tbresiduos` (`idresiduo`, `nombre`, `roller`, `telaancho`, `telaalto`, `zocalo`) VALUES
(1, 'Sistema Comun', '300.00', '300.00', '300.00', '200.00');

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
(1, '35.00', b'1'),
(2, '33.00', b'1'),
(3, '50.00', b'1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbtipotarea`
--

INSERT INTO `tbtipotarea` (`idtipotarea`, `tarea`, `valor`, `detalle`) VALUES
(1, 'Cortar Tela', 2, ''),
(2, 'Cortar Caños', 2, ''),
(3, 'Armar Codos', 3, '');

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
  ADD CONSTRAINT `fk_ost_sistematarea` FOREIGN KEY (`refsistematareas`) REFERENCES `dbsistematareas` (`idsistematarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ost_ordenes` FOREIGN KEY (`refordenes`) REFERENCES `dbordenes` (`idorden`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_st_tareas` FOREIGN KEY (`reftipotarea`) REFERENCES `tbtipotarea` (`idtipotarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_st_sistemas` FOREIGN KEY (`refsistemas`) REFERENCES `dbsistemas` (`idsistema`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbtelas`
--
ALTER TABLE `dbtelas`
  ADD CONSTRAINT `fk_telas_tramas` FOREIGN KEY (`reftipotramados`) REFERENCES `tbtipotramados` (`idtipotramado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbventas`
--
ALTER TABLE `dbventas`
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`refclientes`) REFERENCES `dbclientes` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas_tipopago` FOREIGN KEY (`reftipopago`) REFERENCES `tbtipopago` (`idtipopago`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
