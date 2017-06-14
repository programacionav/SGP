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
            //https://stackoverflow.com/questions/27565465/how-to-set-uniqueness-for-multiple-fields-in-activerecord-yii2
            [['idDepartamento'], 'unique', 'targetAttribute' => ['idDocente', 'idDepartamento'], 'message' => 'El docente ya tiene otro cargo en este Departamento'],
            [['idDepartamento'], 'unique', 'targetAttribute' => ['idDocente', 'idDepartamento', 'idCargo'], 'message' => 'nada'],
            [['idCargo'], 'unique', 'targetAttribute' => ['idDocente', 'idDepartamento', 'idCargo'], 'message' => 'El docente ya esta asignado a este departamento con este Cargo'],           
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
            'idDocente' => 'Docente',
            'idDepartamento' => 'Departamento',
            'idCargo' => 'Cargo',
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
