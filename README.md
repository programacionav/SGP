Sistema de Gestión de Programas: Aplicación Basada en Yii 2 Basic Application Template
================================

Se trata de una aplicación web para que los docente de la Facultad de Informática puedan gestionar los programas de las materias. Facilita el proceso de carga, validación y presentación de programas. Permite lograr trazabilidad y notificación de estados.



INSTALACIÓN
-----------
###Descargar el framework de http://www.yiiframework.com/download/

###Descomprimirlo en una carpeta pública del apache.

###Descargar los fuentes del presente repositorio y pisar el proyecto base.


BASE DE DATOS
-------------
Crear una Base de datos en base al archivo que esta en la carpeta /data del proyecto.

Editar el archivo `config/db.php` 

```php
return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host=localhost;dbname=dbname',
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
];
```
