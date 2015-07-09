-- Pese a parecer exportado de algun cliente mysql
-- Todo el código de este archivo lo realice a mano
-- Los indices para optimizar busquedas
-- y los constraints con nombre personalizado e identificatorios no son la excepción.
-- En caso de cualquier duda,
-- lo invito a que me evalue o pregunte lo que crea pertinente


CREATE DATABASE IF NOT EXISTS `concursando` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `concursando`;

CREATE TABLE `pais` (
  `id_pais` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_pais`))
ENGINE = InnoDB;


CREATE TABLE `usuario` (
  `id_usuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NOT NULL,
  `f_alta` DATETIME NOT NULL ,
  `pass` VARCHAR(100) NOT NULL,
  `id_pais` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `f_nacimiento` DATETIME NOT NULL ,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `u_email_unique` (`email` ASC),
  INDEX `u_id_pais_index` (`id_pais` ASC),
  CONSTRAINT `u_id_pais_constraint`
    FOREIGN KEY (`id_pais`)
    REFERENCES `pais` (`id_pais`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


CREATE TABLE `concurso` (
  `id_concurso` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario` INT UNSIGNED NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `empresa` VARCHAR(45) NOT NULL,
  `f_inicio` DATETIME NOT NULL,
  `f_fin` DATETIME NOT NULL,
  `habilitado` CHAR(1) NOT NULL DEFAULT 'S',
  `f_creacion` DATETIME NOT NULL ,
  PRIMARY KEY (`id_concurso`),
  INDEX `c_id_usuario_index` (`id_usuario` ASC),
  CONSTRAINT `c_id_usuario_constraint`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuario` (`id_usuario`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


CREATE TABLE `tipo_pregunta` (
  `id_tipo_pregunta` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  `habilitado` CHAR(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`id_tipo_pregunta`))
ENGINE = InnoDB;


CREATE TABLE `pregunta` (
  `id_pregunta` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tipo_pregunta` TINYINT UNSIGNED NOT NULL,
  `id_concurso` INT UNSIGNED NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `habilitado` CHAR(1) NOT NULL DEFAULT 'S',
  `obligatorio` CHAR(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`id_pregunta`),
  INDEX `p_id_tipo_index` (`id_tipo_pregunta` ASC),
  INDEX `p_id_concurso_index` (`id_concurso` ASC),
  CONSTRAINT `p_id_tipo_constraint`
    FOREIGN KEY (`id_tipo_pregunta`)
    REFERENCES `tipo_pregunta` (`id_tipo_pregunta`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `p_id_concurso_constraint`
    FOREIGN KEY (`id_concurso`)
    REFERENCES `concurso` (`id_concurso`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


CREATE TABLE `opcion` (
  `id_opcion` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pregunta` INT UNSIGNED NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_opcion`),
  INDEX `o_id_pregunta_index` (`id_pregunta` ASC),
  CONSTRAINT `o_id_pregunta_constraint`
    FOREIGN KEY (`id_pregunta`)
    REFERENCES `pregunta` (`id_pregunta`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


CREATE TABLE `concursante` (
  `id_concursante` INT UNSIGNED NOT NULL,
  `id_concurso` INT UNSIGNED NOT NULL,
  `f_alta` DATETIME NOT NULL,
  `ip` VARCHAR(45) NOT NULL,
  `navegador` TEXT NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_concursante`),
  CONSTRAINT `c_id_concurso_constraint`
    FOREIGN KEY (`id_concurso`)
    REFERENCES `concurso` (`id_concurso`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;

CREATE TABLE `respuesta_texto` (
  `id_respuesta` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pregunta` INT UNSIGNED NOT NULL,
  `texto` VARCHAR(255) NOT NULL,
  `id_concursante` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_respuesta`),
  INDEX `rt_id_pregunta_index` (`id_pregunta` ASC),
  INDEX `rt_id_concursante_index` (`id_concursante` ASC),
  CONSTRAINT `rt_id_pregunta_constraint`
    FOREIGN KEY (`id_pregunta`)
    REFERENCES `pregunta` (`id_pregunta`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `rt_id_concursante_constraint`
    FOREIGN KEY (`id_concursante`)
    REFERENCES `concursante` (`id_concursante`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


CREATE TABLE `respuesta_opcion` (
  `id_respuesta_opcion` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_opcion` INT UNSIGNED NOT NULL,
  `id_concursante` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_respuesta_opcion`),
  INDEX `ro_id_opcion_index` (`id_opcion` ASC),
  INDEX `ro_id_concursante_index` (`id_concursante` ASC),
  CONSTRAINT `ro_id_opcion_constraint`
    FOREIGN KEY (`id_opcion`)
    REFERENCES `opcion` (`id_opcion`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `ro_id_concursante_constraint`
    FOREIGN KEY (`id_concursante`)
    REFERENCES `concursante` (`id_concursante`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


CREATE TABLE `tipo_archivo` (
  `id_tipo_archivo` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  `habilitado` CHAR(1) NOT NULL,
  PRIMARY KEY (`id_tipo_archivo`))
ENGINE = InnoDB;


CREATE TABLE `archivo` (
  `id_archivo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tipo_archivo` TINYINT UNSIGNED NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_archivo`),
  INDEX `a_id_tipo_index` (`id_tipo_archivo` ASC),
  CONSTRAINT `a_id_tipo_constraint`
    FOREIGN KEY (`id_tipo_archivo`)
    REFERENCES `tipo_archivo` (`id_tipo_archivo`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


CREATE TABLE `respuesta_archivo` (
  `id_respuesta_archivo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pregunta` INT UNSIGNED NOT NULL,
  `id_archivo` INT UNSIGNED NOT NULL,
  `id_concursante` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_respuesta_archivo`),
  INDEX `ra_id_pregunta_index` (`id_pregunta` ASC),
  INDEX `ra_id_archivo_index` (`id_archivo` ASC),
  INDEX `ra_id_concursante_index` (`id_concursante` ASC),
  CONSTRAINT `ra_id_pregunta_constraint`
    FOREIGN KEY (`id_pregunta`)
    REFERENCES `pregunta` (`id_pregunta`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `ra_id_archivo_constraint`
    FOREIGN KEY (`id_archivo`)
    REFERENCES `archivo` (`id_archivo`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `ra_id_concursante_constraint`
    FOREIGN KEY (`id_concursante`)
    REFERENCES `concursante` (`id_concursante`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


CREATE TABLE `archivo_concurso` (
  `id_archivo_concurso` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_archivo` INT UNSIGNED NOT NULL,
  `id_concurso` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_archivo_concurso`),
  INDEX `ac_id_archivo_index` (`id_archivo` ASC),
  INDEX `ac_id_concurso_indes` (`id_concurso` ASC),
  CONSTRAINT `ac_id_archivo_constraint`
    FOREIGN KEY (`id_archivo`)
    REFERENCES `archivo` (`id_archivo`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `ac_id_concurso_constraint`
    FOREIGN KEY (`id_concurso`)
    REFERENCES `concurso` (`id_concurso`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


CREATE TABLE `verificado` (
  `id_verificado` INT UNSIGNED NOT NULL,
  `f_verificado` DATETIME NOT NULL,
  `id_concursante` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_verificado`),
  INDEX `v_id_concursante_index` (`id_concursante` ASC),
  CONSTRAINT `v_id_concursante_constraint`
    FOREIGN KEY (`id_concursante`)
    REFERENCES `concursante` (`id_concursante`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


CREATE TABLE `estado` (
  `id_estado` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT primary key,
  `descripcion` varchar(45) NOT NULL,
   UNIQUE INDEX `e_descripcion_unique` (`descripcion`)
)ENGINE = InnoDB;


CREATE TABLE usuario_estado (
    `id_usuario_estado` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `fecha` datetime NOT NULL,
    `id_estado` TINYINT (4) UNSIGNED NOT NULL,
    `id_usuario` INT (10) UNSIGNED NOT NULL,
    CONSTRAINT `ue_id_estado_constraint`
	FOREIGN KEY (id_estado) REFERENCES estado (id_estado),
    CONSTRAINT `ue_id_usuario_constraint`
	FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
)ENGINE = InnoDB;


CREATE TABLE concursante_estado (
    id_concursante_estado int unsigned not null auto_increment primary key,
    fecha datetime not null,
    id_estado tinyint unsigned not null,
    id_concursante int unsigned not null,
    CONSTRAINT `ce_id_concursante_constraint`
        FOREIGN KEY ( id_concursante ) references concursante (id_concursante),
    CONSTRAINT `ce_id_estado_constraint`
        FOREIGN KEY ( id_estado ) references estado (id_estado)
)ENGINE = InnoDB;


CREATE TABLE `recupero` (
    `id_recupero` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `fecha` datetime NOT NULL,
    `id_usuario` int(10) unsigned NOT NULL,
    `tokken` varchar(45) NOT NULL,
    `habilitado` char(1) NOT NULL DEFAULT 'S',
    PRIMARY KEY (`id_recupero`),
    INDEX `r_id_usuario_index` (`id_usuario`),
    CONSTRAINT `r_id_usuario_constraint` 
        FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB;


INSERT INTO `tipo_archivo` (`id_tipo_archivo`,`descripcion`,`habilitado`) VALUES (1,'image/jpeg','S');
INSERT INTO `tipo_archivo` (`id_tipo_archivo`,`descripcion`,`habilitado`) VALUES (2,'image/png','S');
INSERT INTO `tipo_archivo` (`id_tipo_archivo`,`descripcion`,`habilitado`) VALUES (3,'image/bmp','S');
INSERT INTO `tipo_archivo` (`id_tipo_archivo`,`descripcion`,`habilitado`) VALUES (4,'text/doc','S');
INSERT INTO `tipo_archivo` (`id_tipo_archivo`,`descripcion`,`habilitado`) VALUES (5,'text/pdf','S');


INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (1,'Argentina');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (2,'Chile');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (3,'Uruguay');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (4 ,'Paraguay');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (5,'Bolivia');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (6,'Venezuela');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (7,'Colombia');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (8,'Mexico');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (9,'España');


INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (1,'text','S');
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (2,'date','S');
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (3,'textarea','S');
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (4,'select','S');
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (5,'radio','S');
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (6,'check','S');
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (7,'foto','S');


insert into estado values (1, 'Pendiente');
insert into estado values (2, 'Habilitado');
insert into estado values (3, 'Eliminado');