<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamento".
 *
 * @property integer $idDepartamento
 * @property string $nombre
 * @property integer $idDocente
 * @property integer $idFacultad
 *
 * @property Facultad $idFacultad0
 * @property Departamentodocentecargo[] $departamentodocentecargos
 */
class Departamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
	        [['nombre'], 'required'],
            [['idDocente'], 'required', 'message'=>'Ingrese el Director'],
            [['idDocente'], 'integer'],
            [['idFacultad'], 'required', 'message' => 'Ingrese la facultad'],
            [['idFacultad'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['idFacultad'], 'exist', 'skipOnError' => true, 'targetClass' => Facultad::className(), 'targetAttribute' => ['idFacultad' => 'idFacultad']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDepartamento' => 'Id Departamento',
            'nombre' => 'Nombre',
            'idDocente' => 'Id Docente',
            'idFacultad' => 'Id Facultad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFacultad0()//devuelve objeto
    {
        return $this->hasOne(Facultad::className(), ['idFacultad' => 'idFacultad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentodocentecargos()
    {
<<<<<<< HEAD
        return $this->hasMany(Docente::className(), ['idDocente' => 'idDocente'])->viaTable('departamentoDocenteCargo', ['idDepartamento' => 'idDepartamento']);
=======
        return $this->hasMany(Departamentodocentecargo::className(), ['idDepartamento' => 'idDepartamento']);
>>>>>>> b7d67d82573e5d7b7cee834c0b69f14e617a786f
    }
}
