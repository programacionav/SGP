ALTER TABLE departamento DROP FOREIGN KEY departamento_ibfk_3;
ALTER TABLE `departamento` DROP `idDocente`;

RENAME TABLE  `departamentoDocenteCargo` TO  `departamentodocentecargo`
