<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carrera".
 *
 * @property integer $idCarrera
 * @property string $nombre
 *
 * @property Plan[] $plans
 */
class Carrera extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carrera';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCarrera' => 'Id Carrera',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::className(), ['idCarrera' => 'idCarrera']);
    }
}
