CREATE TABLE IF NOT EXISTS facultad(
    idFacultad int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(50) NOT NULL,
    sigla varchar(10) NOT NULL,
    PRIMARY KEY(idFacultad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `departamento` ADD `idFacultad` INT(11) NOT NULL AFTER `idDocente`;

ALTER TABLE `departamento` ADD FOREIGN KEY(idFacultad) REFERENCES facultad(idFacultad) ON DELETE NO ACTION ON UPDATE NO ACTION;