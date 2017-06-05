<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dedicacion".
 *
 * @property integer $idDedicacion
 * @property string $descripcion
 *
 * @property Docente[] $docentes
 */
class Dedicacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dedicacion';
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
            'idDedicacion' => 'Id Dedicacion',
            'descripcion' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocentes()
    {
        return $this->hasMany(Docente::className(), ['idDedicacion' => 'idDedicacion']);
    }
}
