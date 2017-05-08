<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cargo".
 *
 * @property integer $idCargo
 * @property string $abreviatura
 * @property string $descripcion
 *
 * @property Cargodocente[] $cargodocentes
 * @property Docente[] $idDocentes
 */
class Cargo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cargo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['abreviatura', 'descripcion'], 'required'],
            [['abreviatura'], 'string', 'max' => 10],
            [['descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCargo' => 'Id Cargo',
            'abreviatura' => 'Abreviatura',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargodocentes()
    {
        return $this->hasMany(Cargodocente::className(), ['idCargo' => 'idCargo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDocentes()
    {
        return $this->hasMany(Docente::className(), ['idDocente' => 'idDocente'])->viaTable('cargodocente', ['idCargo' => 'idCargo']);
    }
}
