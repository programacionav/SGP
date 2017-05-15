<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estadoprograma".
 *
 * @property integer $idEstadoP
 * @property string $descripcion
 *
 * @property Cambioestado[] $cambioestados
 */
class Estadoprograma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estadoprograma';
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
            'idEstadoP' => Yii::t('app', 'Id Estado P'),
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCambioestados()
    {
        return $this->hasMany(Cambioestado::className(), ['idEstadoP' => 'idEstadoP']);
    }
}
