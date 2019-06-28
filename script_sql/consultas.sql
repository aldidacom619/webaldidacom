
CREATE TABLE IF NOT EXISTS `cb_cuentas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codcb_cuenta` int(11) DEFAULT NULL,
  `denominacion_cuenta` varchar(100) NOT NULL,
  `descripcion_cuenta` varchar(200) NOT NULL,  
  `nivel` int(11) NOT NULL,  
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) 





INSERT INTO `cb_cuentas` (`codcb_cuenta`, `denominacion_cuenta`, `descripcion_cuenta`, `nivel`, `estado`) 
VALUES (0, 'CUENTA 1', 'CUENTA 1', '0', 'AC');
