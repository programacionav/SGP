DROP TABLE IF EXISTS cargoDocente;
DROP TABLE IF EXISTS departamentodocente;
CREATE TABLE IF NOT EXISTS departamentoDocenteCargo(
idDocente int(11) NOT NULL,
idDepartamento int(11) NOT NULL,
idCargo int(11) NOT NULL,

PRIMARY KEY(idDepartamento,idDocente,idCargo),
FOREIGN KEY(idDocente) REFERENCES docente(idDocente),
FOREIGN KEY(idDepartamento) REFERENCES departamento(idDepartamento),
FOREIGN KEY(idCargo) REFERENCES cargo(idCargo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
