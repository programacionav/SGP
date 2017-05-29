CREATE TABLE IF NOT EXISTS dedicacion(
idDedicacion int(11) NOT NULL AUTO_INCREMENT,
descripcion varchar(50) NOT NULL,

PRIMARY KEY(idDedicacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS cargo(
idCargo int(11) NOT NULL AUTO_INCREMENT,
abreviatura varchar(10) NOT NULL,
descripcion varchar(50) NOT NULL,

PRIMARY KEY(idCargo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE IF NOT EXISTS docente(
  idDocente int(11)  NOT NULL AUTO_INCREMENT,
  cuil varchar(20) NOT NULL,
  nombre varchar(50) NOT NULL,
  apellido varchar(50) NOT NULL,
  idDedicacion int(11) NOT NULL,

  PRIMARY KEY(idDocente),
  FOREIGN KEY(idDedicacion) REFERENCES dedicacion(idDedicacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS cargoDocente(
idDocente int(11) NOT NULL,
idCargo int(11) NOT NULL,

PRIMARY KEY(idCargo,idDocente),
FOREIGN KEY(idDocente) REFERENCES docente(idDocente),
FOREIGN KEY(idCargo) REFERENCES cargo(idCargo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS departamento(
idDepartamento int(11) NOT NULL AUTO_INCREMENT,
nombre varchar(50) NOT NULL,
idDocente int(11) NOT NULL,/*id del jefe de departamento*/

PRIMARY KEY(idDepartamento),
FOREIGN KEY(idDocente) REFERENCES docente(idDocente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





CREATE TABLE IF NOT EXISTS departamentoDocente(
idDocente int(11) NOT NULL,
idDepartamento int(11) NOT NULL,

PRIMARY KEY(idDepartamento,idDocente),
FOREIGN KEY(idDocente) REFERENCES docente(idDocente),
FOREIGN KEY(idDepartamento) REFERENCES departamento(idDepartamento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS rol(
  idRol int(11) NOT NULL AUTO_INCREMENT,
  descripcion varchar(50) NOT NULL,

  PRIMARY KEY(idRol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS usuario(
 idUsuario int(11) NOT NULL AUTO_INCREMENT,
 idDocente int(11) NOT NULL,
 idRol int(11) NOT NULL,
 usuario varchar(50) NOT NULL,
 clave varchar(100) NOT NULL,

 PRIMARY KEY(idUsuario),
 FOREIGN KEY(idDocente) REFERENCES docente(idDocente),/*relacion 1 a 1*/
 FOREIGN KEY(idRol) REFERENCES rol(idRol)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
