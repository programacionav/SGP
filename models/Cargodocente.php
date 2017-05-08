<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cargodocente".
 *
 * @property integer $idDocente
 * @property integer $idCargo
 *
 * @property Docente $idDocente0
 * @property Cargo $idCargo0
 */
class Cargodocente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cargodocente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idDocente', 'idCargo'], 'required'],
            [['idDocente', 'idCargo'], 'integer'],
            [['idDocente'], 'exist', 'skipOnError' => true, 'targetClass' => Docente::className(), 'targetAttribute' => ['idDocente' => 'idDocente']],
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
    public function getIdCargo0()
    {
        return $this->hasOne(Cargo::className(), ['idCargo' => 'idCargo']);
    }
}
