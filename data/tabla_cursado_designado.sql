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
funcion
)
