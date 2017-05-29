<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property integer $idRol
 * @property string $descripcion
 *
 * @property Usuario[] $usuarios
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idRol' => 'Id Rol',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idRol' => 'idRol']);
    }
/*
Tres funciones publicas que comprueban si el usuario logueado es Docente, Jefe de Departamento o Secretario Academico
Las puse en esta clase porque me parece mas intuitivo para llamarlas.
Sin embargo, no estoy seguro si esta es la forma mas eficiente, si lo que se quiere es
controlar las reglas de acceso. Me parece que en Yii se pueden configurar esas reglas en las vistas o controladores.

******* Ejemplo de Uso *******
use app\models\Rol;
...
if (Rol::esDocente()){
    echo "Es Docente";
}
*******************************

*/
    public function esDocente()
    {        
        $modelUsuario = new Usuario();        
        $modelUsuario = Usuario::findIdentity(Yii::$app->user->id);
        $modelRol = new Rol();
        $modelRol = Rol::findOne($modelUsuario->idRol);

        if ($modelRol->descripcion == "Docente"){
            return true;
        }else{
            return false;
        }
    }

        public function esJefeDpto()
    {        
        $modelUsuario = new Usuario();        
        $modelUsuario = Usuario::findIdentity(Yii::$app->user->id);
        $modelRol = new Rol();
        $modelRol = Rol::findOne($modelUsuario->idRol);

        if ($modelRol->descripcion == "DirectorDepartamento"){
            return true;
        }else{
            return false;
        }
    }

        public function esSecAcademico()
    {        
        $modelUsuario = new Usuario();        
        $modelUsuario = Usuario::findIdentity(Yii::$app->user->id);
        $modelRol = new Rol();
        $modelRol = Rol::findOne($modelUsuario->idRol);

        if ($modelRol->descripcion == "SecretariaAcademica"){
            return true;
        }else{
            return false;
        }
    }
}
