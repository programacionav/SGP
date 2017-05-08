CREATE TABLE cursado(
idCursado int(11) NOT NULL AUTO_INCREMENT,
fechaInicio Date NOT null,
fechaFin Date NOT NULL,
idMateria int(11),
cuatrimestre int(1),
PRIMARY KEY(idCursado),
FOREIGN KEY(idMateria) REFERENCES materia(idMateria)
)
CREATE TABLE designado(
funcion varChar(100) NOT NULL,
idCursado int(11)NOT NULL,
idDocente int(11)NOT NULL,
PRIMARY KEY(idDocente, idCursado),
FOREIGN KEY(idCursado)REFERENCES cursado(idCursado),
FOREIGN KEY(idDocente) REFERENCES docente(idDocente)
)
