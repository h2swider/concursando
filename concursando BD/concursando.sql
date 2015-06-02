
-- -----------------------------------------------------
-- Table `pais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pais` (
  `id_pais` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_pais`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NOT NULL,
  `f_alta` DATETIME NOT NULL ,
  `pass` VARCHAR(100) NOT NULL,
  `id_pais` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `f_nacimiento` DATETIME NOT NULL ,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `usuariocol_UNIQUE` (`email` ASC),
  INDEX `fk_usuario_pais1_idx` (`id_pais` ASC),
  CONSTRAINT `fk_usuario_pais1`
    FOREIGN KEY (`id_pais`)
    REFERENCES `pais` (`id_pais`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `concurso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `concurso` (
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
  INDEX `id_usuario_idx` (`id_usuario` ASC),
  CONSTRAINT `id_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuario` (`id_usuario`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tipo_pregunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tipo_pregunta` (
  `id_tipo_pregunta` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  `habilitado` CHAR(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`id_tipo_pregunta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pregunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pregunta` (
  `id_pregunta` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tipo_pregunta` TINYINT UNSIGNED NOT NULL,
  `id_concurso` INT UNSIGNED NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `habilitado` CHAR(1) NOT NULL DEFAULT 'S',
  `obligatorio` CHAR(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`id_pregunta`),
  INDEX `id_tipo_idx` (`id_tipo_pregunta` ASC),
  INDEX `id_concurso_idx` (`id_concurso` ASC),
  CONSTRAINT `id_tipo`
    FOREIGN KEY (`id_tipo_pregunta`)
    REFERENCES `tipo_pregunta` (`id_tipo_pregunta`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `id_concurso2`
    FOREIGN KEY (`id_concurso`)
    REFERENCES `concurso` (`id_usuario`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `opcion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opcion` (
  `id_opcion` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pregunta` INT UNSIGNED NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_opcion`),
  INDEX `id_pregunta_idx` (`id_pregunta` ASC),
  CONSTRAINT `id_pregunta_3`
    FOREIGN KEY (`id_pregunta`)
    REFERENCES `pregunta` (`id_concurso`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `concursante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `concursante` (
  `id_concursante` INT UNSIGNED NOT NULL,
  `f_alta` DATETIME NOT NULL,
  `ip` VARCHAR(45) NOT NULL,
  `navegador` TEXT NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_concursante`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `respuesta_texto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `respuesta_texto` (
  `id_respuesta` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pregunta` INT UNSIGNED NOT NULL,
  `texto` VARCHAR(255) NOT NULL,
  `id_concursante` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_respuesta`),
  INDEX `id_pregunta_idx` (`id_pregunta` ASC),
  INDEX `fk_respuesta_texto_concursante1_idx` (`id_concursante` ASC),
  CONSTRAINT `id_pregunta_2`
    FOREIGN KEY (`id_pregunta`)
    REFERENCES `pregunta` (`id_pregunta`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `id_concursante2`
    FOREIGN KEY (`id_concursante`)
    REFERENCES `concursante` (`id_concursante`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `respuesta_opcion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `respuesta_opcion` (
  `id_respuesta_opcion` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_opcion` INT UNSIGNED NOT NULL,
  `id_concursante` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_respuesta_opcion`),
  INDEX `id_opcion_idx` (`id_opcion` ASC),
  INDEX `fk_respuesta_opcion_concursante1_idx` (`id_concursante` ASC),
  CONSTRAINT `id_opcion`
    FOREIGN KEY (`id_opcion`)
    REFERENCES `opcion` (`id_opcion`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `id_concursante3`
    FOREIGN KEY (`id_concursante`)
    REFERENCES `concursante` (`id_concursante`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tipo_archivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tipo_archivo` (
  `id_tipo_archivo` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  `habilitado` CHAR(1) NOT NULL,
  PRIMARY KEY (`id_tipo_archivo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `archivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `archivo` (
  `id_archivo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tipo_archivo` TINYINT UNSIGNED NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_archivo`),
  INDEX `id_tipo_archivo_idx` (`id_tipo_archivo` ASC),
  CONSTRAINT `id_tipo_archivo`
    FOREIGN KEY (`id_tipo_archivo`)
    REFERENCES `tipo_archivo` (`id_tipo_archivo`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `respuesta_archivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `respuesta_archivo` (
  `id_respuesta_archivo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pregunta` INT UNSIGNED NOT NULL,
  `id_archivo` INT UNSIGNED NOT NULL,
  `id_concursante` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_respuesta_archivo`),
  INDEX `id_prega_idxa` (`id_pregunta` ASC),
  INDEX `id_arch_idxa` (`id_archivo` ASC),
  INDEX `fk_resp_archivo_concursante1_idxa` (`id_concursante` ASC),
  CONSTRAINT `id_preg`
    FOREIGN KEY (`id_pregunta`)
    REFERENCES `pregunta` (`id_pregunta`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `id_arch`
    FOREIGN KEY (`id_archivo`)
    REFERENCES `archivo` (`id_archivo`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `id_concur2`
    FOREIGN KEY (`id_concursante`)
    REFERENCES `concursante` (`id_concursante`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `archivo_concurso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `archivo_concurso` (
  `id_archivo_concurso` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_archivo` INT UNSIGNED NOT NULL,
  `id_concurso` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_archivo_concurso`),
  INDEX `id_archivo_idx` (`id_archivo` ASC),
  INDEX `id_concurso_idx` (`id_concurso` ASC),
  CONSTRAINT `id_archivo1`
    FOREIGN KEY (`id_archivo`)
    REFERENCES `archivo` (`id_archivo`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `id_concurso1`
    FOREIGN KEY (`id_concurso`)
    REFERENCES `concurso` (`id_concurso`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `verificado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `verificado` (
  `id_verificado` INT UNSIGNED NOT NULL,
  `f_verificado` DATETIME NOT NULL,
  `id_concursante` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_verificado`),
  INDEX `fk_verificado_concursante1_idx` (`id_concursante` ASC),
  CONSTRAINT `fk_verificado_concursante1`
    FOREIGN KEY (`id_concursante`)
    REFERENCES `concursante` (`id_concursante`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `estado` (
  `id_estado` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT primary key,
  `descripcion` varchar(45) NOT NULL,
  UNIQUE KEY `descripcion` (`descripcion`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS usuario_estado (
	`id_usuario_estado` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`fecha` datetime NOT NULL,
	`id_estado` TINYINT (4) UNSIGNED NOT NULL,
	`id_usuario` INT (10) UNSIGNED NOT NULL,
	FOREIGN KEY (id_estado) REFERENCES estado (id_estado),
	FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS concursante_estado (
	id_concursante_estado int unsigned not null auto_increment primary key,
    fecha datetime not null,
    id_estado tinyint unsigned not null,
    id_concursante int unsigned not null,
    FOREIGN KEY ( id_concursante ) references concursante (id_concursante),
    FOREIGN KEY ( id_estado ) references estado (id_estado)
)ENGINE = InnoDB;

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

/*
-- Query: 
-- Date: 2015-05-13 19:06
*/
INSERT INTO `tipo_archivo` (`id_tipo_archivo`,`descripcion`,`habilitado`) VALUES (1,'jpg','S');
INSERT INTO `tipo_archivo` (`id_tipo_archivo`,`descripcion`,`habilitado`) VALUES (2,'png','S');
INSERT INTO `tipo_archivo` (`id_tipo_archivo`,`descripcion`,`habilitado`) VALUES (3,'bmp','S');
INSERT INTO `tipo_archivo` (`id_tipo_archivo`,`descripcion`,`habilitado`) VALUES (4,'doc','S');
INSERT INTO `tipo_archivo` (`id_tipo_archivo`,`descripcion`,`habilitado`) VALUES (5,'pdf','S');

/*
-- Query: 
-- Date: 2015-05-13 19:05
*/
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (1,'Argentina');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (2,'Chile');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (3,'Uruguay');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (4 ,'Paraguay');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (5,'Bolivia');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (6,'Venezuela');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (7,'Colombia');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (8,'Mexico');
INSERT INTO `pais` (`id_pais`,`descripcion`) VALUES (9,'España');

/*
-- Query: 
-- Date: 2015-05-13 19:06
*/
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (1,'text','S');
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (2,'date','S');
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (3,'textarea','S');
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (4,'select','S');
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (5,'radio','S');
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (6,'check','S');
INSERT INTO `tipo_pregunta` (`id_tipo_pregunta`,`descripcion`,`habilitado`) VALUES (7,'foto','S');


insert into estado values (null, 'Pendiente');
insert into estado values (null, 'Habilitado');
insert into estado values (null, 'Eliminado');