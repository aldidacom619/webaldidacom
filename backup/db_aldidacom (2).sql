-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-06-2019 a las 18:20:14
-- Versión del servidor: 5.5.20
-- Versión de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_aldidacom`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_acciones`
--

CREATE TABLE IF NOT EXISTS `ad_acciones` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) NOT NULL,
  `abreviatura` varchar(20) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `ad_acciones`
--

INSERT INTO `ad_acciones` (`codigo`, `descripcion`, `abreviatura`, `nombre`, `estado`) VALUES
(8, 'REGISTRO DE USUARIOS', 'RU', 'REGISTRO USUARIO', 'AC'),
(9, 'MODIFIACION DE USUARIOS', 'MU', 'MODIFICAR USUARIOS', 'AC'),
(10, 'AGREGAR ROLES', 'AR', 'AGREGAR ROLES', 'AC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_aplicaciones`
--

CREATE TABLE IF NOT EXISTS `ad_aplicaciones` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) NOT NULL,
  `abreviatura` varchar(20) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `ad_aplicaciones`
--

INSERT INTO `ad_aplicaciones` (`codigo`, `descripcion`, `abreviatura`, `nombre`, `estado`) VALUES
(8, 'APLICACION PRINCIPAL', 'ADMIN', 'ADMINISTRACION', 'AC'),
(9, 'SISTEMA CONTABILIDAD', 'SC', 'SISTEMA CONTABLE', 'AC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_entidades`
--

CREATE TABLE IF NOT EXISTS `ad_entidades` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion` varchar(100) NOT NULL,
  `descripcion_entidad` varchar(200) NOT NULL,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ad_entidades`
--

INSERT INTO `ad_entidades` (`codigo`, `denominacion`, `descripcion_entidad`, `estado`) VALUES
(1, 'ALDIDACOM', 'ADMINISTRACION CENTRAL', 'AC'),
(2, 'DEFENSORIA', 'DEFENSORIA DEL PUEBLO', 'AC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_logs`
--

CREATE TABLE IF NOT EXISTS `ad_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idad_usuario` int(11) DEFAULT NULL,
  `codad_accion` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `ad_logs`
--

INSERT INTO `ad_logs` (`id`, `idad_usuario`, `codad_accion`, `fecha`) VALUES
(8, NULL, 8, '2019-06-16 18:30:00'),
(9, NULL, 9, '2019-06-16 18:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_modulos`
--

CREATE TABLE IF NOT EXISTS `ad_modulos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codad_aplicacion` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `abreviatura` varchar(20) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `ad_modulos`
--

INSERT INTO `ad_modulos` (`codigo`, `codad_aplicacion`, `descripcion`, `abreviatura`, `nombre`, `estado`) VALUES
(10, 8, 'ADMINISTRACION DE USUARIOS', 'US', 'USUARIOS', 'AC'),
(11, 8, 'ADMINISTRACION DE APLICACIONES', 'AP', 'APLICACIONES', 'AC'),
(12, 8, 'OPCIONES ENTORNO', 'IN', 'ENTORNO', 'AC'),
(13, 13, 'CONTROL DE PAGOS', 'CP', 'CONTROL DE PAGOS', 'AC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_opciones`
--

CREATE TABLE IF NOT EXISTS `ad_opciones` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codad_modulo` int(11) NOT NULL,
  `codad_opcion` int(11) DEFAULT NULL,
  `opcion` varchar(20) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `nivel` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `ad_opciones`
--

INSERT INTO `ad_opciones` (`codigo`, `codad_modulo`, `codad_opcion`, `opcion`, `descripcion`, `link`, `nivel`, `orden`, `estado`) VALUES
(8, 11, 8, 'APLICACIONES', '', '', 1, 0, 'AC'),
(9, 11, 8, 'REGISTRO APLICACIÓN', '', 'DDDDDD', 2, 1, 'AC'),
(10, 11, 8, 'MODIFICAR APLICACIÓN', '', 'DDDDD', 2, 2, 'AC'),
(11, 12, 11, 'INICIO', 'INCIO', '', 0, 1, 'AC'),
(12, 10, 12, 'USUARIOS', '', '', 1, 1, 'AC'),
(13, 10, 12, 'REGISTRO USUARIO', '', '', 2, 1, 'AC'),
(14, 13, 8, 'CONTROL PAGOS', '', '', 2, 3, 'AC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_opciones_usuarios`
--

CREATE TABLE IF NOT EXISTS `ad_opciones_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idad_usuario` int(11) DEFAULT NULL,
  `codad_opcion` int(11) DEFAULT NULL,
  `idad_logs` int(11) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `ad_opciones_usuarios`
--

INSERT INTO `ad_opciones_usuarios` (`id`, `idad_usuario`, `codad_opcion`, `idad_logs`, `estado`) VALUES
(8, 8, 8, 9, 'AC'),
(9, 8, 9, 9, 'AC'),
(10, 8, 10, 9, 'AC'),
(11, 8, 11, 9, 'AC'),
(12, 8, 12, 9, 'AC'),
(13, 8, 13, 9, 'AC'),
(14, 8, 14, 9, 'AC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_usuarios`
--

CREATE TABLE IF NOT EXISTS `ad_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codad_entidad` int(11) NOT NULL,
  `codad_aplicacion` int(11) DEFAULT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `nro_documento` varchar(30) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `idad_logs` int(11) DEFAULT NULL,
  `direccion` varchar(250) NOT NULL,
  `tel_cel` varchar(50) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `cargo` varchar(250) NOT NULL,
  `login` varchar(50) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `tipo_user` varchar(250) NOT NULL,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `ad_usuarios`
--

INSERT INTO `ad_usuarios` (`id`, `codad_entidad`, `codad_aplicacion`, `nombres`, `apellidos`, `nro_documento`, `tipo_documento`, `idad_logs`, `direccion`, `tel_cel`, `fecha_nacimiento`, `correo`, `cargo`, `login`, `clave`, `tipo_user`, `estado`) VALUES
(8, 1, 8, 'DIEGO', 'DAZA ALCARAZ', '6703132', 'CI', 8, 'HEROINAS', '78720504', '1989-11-26', 'aldidacom@gmail.com', 'GERENTE', 'ddaza.admin', '952c4c39d5460b647fa9f7f4cf36fb13', 'SUPER ADMINISTRADOR', 'AC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cb_cuentas`
--

CREATE TABLE IF NOT EXISTS `cb_cuentas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codad_entidad` int(11) NOT NULL,
  `codcb_cuenta` int(11) DEFAULT NULL,
  `denominacion_cuenta` varchar(100) NOT NULL,
  `descripcion_cuenta` varchar(200) NOT NULL,
  `nivel` int(11) NOT NULL,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `cb_cuentas`
--

INSERT INTO `cb_cuentas` (`codigo`, `codad_entidad`, `codcb_cuenta`, `denominacion_cuenta`, `descripcion_cuenta`, `nivel`, `estado`) VALUES
(1, 2, 0, 'CUENTA 1', 'CUENTA 1', 0, 'AC'),
(2, 2, 0, 'CUENTA 2', 'CUENTA 2', 0, 'AC'),
(3, 2, 0, 'CUENTA 3', 'CUENTA 3', 0, 'AC'),
(4, 2, 0, 'CUENTA 4', 'CUENTA 4', 0, 'AC');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
