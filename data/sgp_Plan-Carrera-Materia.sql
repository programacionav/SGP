
CREATE TABLE carrera(
idCarrera int NOT NULL auto_increment,
nombre varchar(20)NOT NULL,
PRIMARY KEY (idCarrera)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE plan(
idPlan int NOT NULL auto_increment,
numOrd int NOT NULL,
idCarrera int NOT NULL,
PRIMARY KEY (idPlan),
FOREIGN KEY (idCarrera) references carrera(idCarrera),
)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE materia(
codigo int NOT NULL,
nombre  varchar(40) NOT NULL,
año varchar(20) NOT NULL,
hora varchar(20) NOT NULL,
objetivo varchar(700) NOT NULL,
contenidoMinimo varchar(1500)NOT NULL,
idMateria int NOT NULL auto_increment,
idDepartamento int NOT NULL,
idPlan int NOT NULL,
PRIMARY KEY (idMateria),
FOREIGN KEY (idDepartamento) references departamento(idDepartamento),
FOREIGN KEY (idPlan) references plan(idPlan)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;



CREATE TABLE correlativa(
 idMateria1 int NOT NULL,
 idMateria2 int NOT NULL,

PRIMARY KEY (idMateria1,idMateria2),
FOREIGN KEY (idMateria1) references materia(idMateria),
FOREIGN KEY (idMateria2) references materia(idMateria),
);

