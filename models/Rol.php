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

    ******* Ejemplo de Uso *******
    use app\models\Rol;
    ...
    if (Rol::esDocente()){
        
    }
    *******************************

    */
    public function esDocente()
    { 
        return ($this->idRol == 1);
    }

    public function esJefeDpto()
    {        
        return ($this->idRol == 2);
    }

    public function esSecAcademico()
    {        
        return ($this->idRol == 3);
    }
}
