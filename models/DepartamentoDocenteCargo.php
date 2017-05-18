<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamentodocentecargo".
 *
 * @property integer $idDocente
 * @property integer $idDepartamento
 * @property integer $idCargo
 *
 * @property Docente $idDocente0
 * @property Departamento $idDepartamento0
 * @property Cargo $idCargo0
 */
class DepartamentoDocenteCargo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamentodocentecargo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idDocente', 'idDepartamento', 'idCargo'], 'required'],
            [['idDocente', 'idDepartamento', 'idCargo'], 'integer'],
            [['idDocente'], 'exist', 'skipOnError' => true, 'targetClass' => Docente::className(), 'targetAttribute' => ['idDocente' => 'idDocente']],
            [['idDepartamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['idDepartamento' => 'idDepartamento']],
            [['idCargo'], 'exist', 'skipOnError' => true, 'targetClass' => Cargo::className(), 'targetAttribute' => ['idCargo' => 'idCargo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDocente' => 'Id Docente',
            'idDepartamento' => 'Id Departamento',
            'idCargo' => 'Id Cargo',
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
    public function getIdDepartamento0()
    {
        return $this->hasOne(Departamento::className(), ['idDepartamento' => 'idDepartamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCargo0()
    {
        return $this->hasOne(Cargo::className(), ['idCargo' => 'idCargo']);
    }
}
