/*
Navicat MySQL Data Transfer

Source Server         : Concursando2
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : concursando2

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2015-05-21 00:03:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for recupero
-- ----------------------------
DROP TABLE IF EXISTS `recupero`;
CREATE TABLE `recupero` (
  `id_recupero` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `tokken` varchar(45) NOT NULL,
  `habilitado` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`id_recupero`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `recupero_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1;
