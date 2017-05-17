<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamento".
 *
 * @property integer $idDepartamento
 * @property string $nombre
 * @property integer $idDocente
 *
 * @property Docente $idDocente0
 * @property Departamentodocente[] $departamentodocentes
 * @property Docente[] $idDocentes
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
            [['nombre'], 'string', 'max' => 50],
            [['idDocente'], 'exist', 'skipOnError' => true, 'targetClass' => Docente::className(), 'targetAttribute' => ['idDocente' => 'idDocente']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDocente0()
    {
        return $this->hasOne(Docente::className(), ['idDocente' => 'idDocente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentodocentes()
    {
        return $this->hasMany(Departamentodocente::className(), ['idDepartamento' => 'idDepartamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDocentes()
    {
        return $this->hasMany(Docente::className(), ['idDocente' => 'idDocente'])->viaTable('departamentodocente', ['idDepartamento' => 'idDepartamento']);
    }
}
