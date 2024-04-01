/*
MySQL Data Transfer
Source Host: localhost
Source Database: deposito
Target Host: localhost
Target Database: deposito
Date: 21/06/2020 10:05:54 p.m.
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for comisaria
-- ----------------------------
CREATE TABLE `comisaria` (
  `codcomi` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`codcomi`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Table structure for infraccion
-- ----------------------------
CREATE TABLE `infraccion` (
  `codinfra` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `codigo` varchar(3) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`codinfra`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Table structure for internamiento
-- ----------------------------
CREATE TABLE `internamiento` (
  `num` char(15) COLLATE latin1_general_ci NOT NULL,
  `codcomi` int(3) DEFAULT NULL,
  `codinfra` int(3) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `placa` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `clase` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `color` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `papeleta` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `pnp` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `chofer` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `marca` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `motor` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `horaing` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `obs` text COLLATE latin1_general_ci,
  `estado` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `espago` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Table structure for inventario
-- ----------------------------
CREATE TABLE `inventario` (
  `idinv` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `num` char(11) COLLATE latin1_general_ci DEFAULT NULL,
  `fgd` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `fcd` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `fp` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `vi` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `lp` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `lu` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `llan` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `vas` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `ee` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `cha` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `ante` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `paracho` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `llanre` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `tab` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `chapa` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `radio` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `ence` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `piso` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `mani` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `cenice` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `parasol` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `ei` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `code` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `gata` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `llaru` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `ador` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `bate` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `radiador` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `arranca` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `alterna` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `carbu` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `puri` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `distri` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `bobi` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `ta` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `bujia` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `vca` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`idinv`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Table structure for salida
-- ----------------------------
CREATE TABLE `salida` (
  `num` char(15) COLLATE latin1_general_ci NOT NULL,
  `monto` double(6,2) DEFAULT NULL,
  `nombrepag` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `dni` char(8) COLLATE latin1_general_ci DEFAULT NULL,
  `recibo` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Table structure for tb_empleado
-- ----------------------------
CREATE TABLE `tb_empleado` (
  `idemp` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `apellidos` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `direccion` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `telefijo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `estado` char(15) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`idemp`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Table structure for tb_usuario
-- ----------------------------
CREATE TABLE `tb_usuario` (
  `idusuario` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `idemp` int(4) NOT NULL,
  `usuario` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `clave` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `tipo` char(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `comisaria` VALUES ('1', 'COMISARIA SANFERNANDO');
INSERT INTO `comisaria` VALUES ('3', 'COMISARIA CALLERIA');
INSERT INTO `comisaria` VALUES ('10', 'COMISARIA MANANTAY');
INSERT INTO `comisaria` VALUES ('11', ' COM. CAMPO VERDE');
INSERT INTO `comisaria` VALUES ('12', 'COMISARIA HOYADA');
INSERT INTO `infraccion` VALUES ('1', 'SIN EL USO CORRECTO DEL CASCO', 'L02');
INSERT INTO `infraccion` VALUES ('18', 'ESTACIONARSE EN UN LUGAR PROHIBIDO', 'T06');
INSERT INTO `infraccion` VALUES ('10', 'SIN TARJETA DE PROPIEDAD', 'T20');
INSERT INTO `infraccion` VALUES ('12', 'POR BORRACHO', 'M02');
INSERT INTO `infraccion` VALUES ('14', 'OTRA VEZ', 'L01');
INSERT INTO `infraccion` VALUES ('17', 'USO DEL CELULAR MIENTRAS CONDUCE VEHICULO', 'G12');
INSERT INTO `internamiento` VALUES ('20200000001', '1', '1', '2020-01-11', 'NG-45596', 'motocicleta', 'rojo', '057345-18', 'juan carlos trigoso', 'juan', 'honda', '125', '10:00:00', 'tambien se paso la roja', 'buena', 'sc');
INSERT INTO `inventario` VALUES ('22', '20200000001', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'si', '', '');
INSERT INTO `salida` VALUES ('20200000002', '600.00', 'FRANCISCA MEDINA DE TRIGOSO', '00040181', '005-29837654', '2020-06-22');
INSERT INTO `tb_empleado` VALUES ('18', 'DIEGO ANDRE', 'ZAGACETA ALVARADO', 'JR TARAPACA 234', '', '', 'ACTIVO');
INSERT INTO `tb_empleado` VALUES ('25', 'ARTURIN', 'TORRES RENGIFO', 'POR AHI 345', '950065470', 'KOZUKE44@GMAIL.COM', 'ACTIVO');
INSERT INTO `tb_usuario` VALUES ('13', '18', 'ADMIN', '1234', 'ADMINISTRADOR');
INSERT INTO `tb_usuario` VALUES ('18', '25', 'ATORRES', '12345', 'OPERADOR');
