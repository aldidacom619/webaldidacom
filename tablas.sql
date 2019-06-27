CREATE TABLE `AD#APLICACIONES` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) NOT NULL,
  `abreviatura` varchar(20) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;



CREATE TABLE `AD#ACCIONES` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) NOT NULL,
  `abreviatura` varchar(20) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;



CREATE TABLE `AD$LOGS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ad$usuario` int(11),
  `cod_ad#accion` int(11),
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;



CREATE TABLE `AD#OPCIONES` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ad#opcion` int(11),
  `opcion` varchar(20) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `nivel` int(11) NOT NULL,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;


CREATE TABLE `AD$USUARIOS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ad#aplicacion` int(11),
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `nro_documento` varchar(30) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `id_ad$logs` int(11),
  `direccion` varchar(250) NOT NULL,
  `tel_cel` varchar(50) NOT NULL,
  `fecha_nacimiento` date,
  `correo` varchar(100) NOT NULL,
  `cargo` varchar(250) NOT NULL,
  `login` varchar(50) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `tipo_user` varchar(250) NOT NULL,  
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

CREATE TABLE `AD$OPCIONES_USUARIOS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ad$usuario` int(11),
  `cod_ad#opcion` int(11),
  `id_ad$logs` int(11), 
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;