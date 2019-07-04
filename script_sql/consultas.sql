
INSERT INTO `ad_opciones_usuarios` (`id`, `idad_usuario`, `codad_opcion`, `idad_logs`, `estado`) VALUES
(15, 10, 15, 11, 'AC'),
(16, 10, 16, 11, 'AC'),
(17, 10, 17, 11, 'AC'),
(18, 10, 18, 11, 'AC'),
(19, 10, 19, 11, 'AC'),
(20, 10, 20, 11, 'AC'),
(21, 10, 21, 11, 'AC');



INSERT INTO `ad_opciones_usuarios` (`id`, `idad_usuario`, `codad_opcion`, `idad_logs`, `estado`) VALUES
(30, 10, 11, 11, 'AC');




INSERT INTO `ad_opciones_usuarios` (`id`, `idad_usuario`, `codad_opcion`, `idad_logs`, `estado`) VALUES
(22, 10, 26, 11, 'AC'),
(23, 10, 27, 11, 'AC'),
(24, 10, 28, 11, 'AC'),
(25, 10, 29, 11, 'AC');


INSERT INTO `ad_opciones` (`codigo`, `codad_modulo`, `codad_opcion`, `opcion`, `descripcion`, `link`, `nivel`, `orden`, `estado`) VALUES
(26, 16, 26, 'REPORTE CONSULTAS', '', '', 1, 0, 'AC'),
(27, 16, 26, 'REPORTE INGRESOS', '', 'DDDDDD', 2, 1, 'AC'),
(28, 16, 26, 'REPORTE EGRESOS', '', 'DDDDDD', 2, 2, 'AC'),
(29, 16, 26, 'OTROS', '', 'DDDDDD', 2, 3, 'AC');



INSERT INTO `ad_opciones` (`codigo`, `codad_modulo`, `codad_opcion`, `opcion`, `descripcion`, `link`, `nivel`, `orden`, `estado`) VALUES
(22, 14, 21, 'CONTROL CUENTAS', '', '', 1, 0, 'AC'),
(23, 14, 21, 'REGISTRO CUENTAS', '', 'DDDDDD', 2, 1, 'AC'),
(24, 14, 21, 'MODIFICACION CUENTAS', '', 'DDDDDD', 2, 2, 'AC'),
(25, 14, 21, 'BAJA CUENTAS', '', 'DDDDDD', 2, 3, 'AC');




INSERT INTO `ad_opciones` (`codigo`, `codad_modulo`, `codad_opcion`, `opcion`, `descripcion`, `link`, `nivel`, `orden`, `estado`) VALUES
(15, 15, 15, 'REGISTRO CONTABLE', '', '', 1, 0, 'AC'),
(16, 15, 15, 'REGISTRO INGRESOS', '', 'DDDDDD', 2, 1, 'AC'),
(17, 15, 15, 'MODIFICACION INGRESOS', '', 'DDDDDD', 2, 2, 'AC'),
(18, 15, 15, 'REGISTRO EGRESOS', '', 'DDDDDD', 2, 3, 'AC'),
(19, 15, 15, 'MODIFICACION EGRESOS', '', 'DDDDDD', 2, 4, 'AC'),
(20, 15, 15, 'BORAR INGRESOS', '', 'DDDDDD', 2, 6, 'AC'),
(21, 15, 15, 'BORRAR EGRESOS', '', 'DDDDDD', 2, 7, 'AC');




CREATE TABLE IF NOT EXISTS `cb_cuentas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codcb_cuenta` int(11) DEFAULT NULL,
  `denominacion_cuenta` varchar(100) NOT NULL,
  `descripcion_cuenta` varchar(200) NOT NULL,  
  `nivel` int(11) NOT NULL,  
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) 





INSERT INTO `cb_cuentas` (`codad_entidad`,`codcb_cuenta`, `denominacion_cuenta`, `descripcion_cuenta`, `nivel`, `estado`) VALUES
(2,0, 'CUENTA 3', 'CUENTA 3', '0', 'AC'),
(2,0, 'CUENTA 4', 'CUENTA 4', '0', 'AC');



INSERT INTO `ad_usuarios` (`id`, `codad_entidad`, `codad_aplicacion`, `nombres`, `apellidos`, `nro_documento`, `tipo_documento`, `idad_logs`, `direccion`, `tel_cel`, `fecha_nacimiento`, `correo`, `cargo`, `login`, `clave`, `tipo_user`, `estado`) VALUES
(9, 2, 9, 'ORLANDO', 'QUISPE ARCANI', '1234567', 'CI', 10, 'EL ALTO', '78720504', '1985-11-09', 'orlando@gmail.com', 'GERENTE', 'ADMORLANDO.DSP', '952c4c39d5460b647fa9f7f4cf36fb13', 'ADMINISTRADOR', 'AC');



INSERT INTO `ad_usuarios` (`id`, `codad_entidad`, `codad_aplicacion`, `nombres`, `apellidos`, `nro_documento`, `tipo_documento`, `idad_logs`, `direccion`, `tel_cel`, `fecha_nacimiento`, `correo`, `cargo`, `login`, `clave`, `tipo_user`, `estado`) VALUES
(10, 2, 9, 'ORLANDO', 'QUISPE ARCANI', '1234567', 'CI', 10, 'EL ALTO', '78720504', '1985-11-09', 'orlando@gmail.com', 'TECNICO CONTABLE', 'OQUISPE.DSP', '952c4c39d5460b647fa9f7f4cf36fb13', 'TECNICO', 'AC');





INSERT INTO `ad_modulos` (`codigo`, `codad_aplicacion`, `descripcion`, `abreviatura`, `nombre`, `estado`) VALUES
(14, 9, 'REGISTRO CUENTAS', 'US', 'USUARIOS', 'AC'),
(15, 9, 'REGISTRO DE INGRESO Y SALIDAS', 'AP', 'APLICACIONES', 'AC'),
(16, 9, 'REPORTE CONSULTAS', 'IN', 'ENTORNO', 'AC');








