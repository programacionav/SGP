<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estadoobservacion".
 *
 * @property integer $idEstadoO
 * @property string $descripcion
 *
 * @property Observacion[] $observacions
 */
class Estadoobservacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estadoobservacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEstadoO' => Yii::t('app', 'Id Estado O'),
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObservacions()
    {
        return $this->hasMany(Observacion::className(), ['idEstadoO' => 'idEstadoO']);
    }
}
