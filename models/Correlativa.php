<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "correlativa".
 *
 * @property integer $idMateria1
 * @property integer $idMateria2
 *
 * @property Materia $idMateria10
 * @property Materia $idMateria20
 */
class Correlativa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'correlativa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idMateria1', 'idMateria2'], 'required'],
            [['idMateria1', 'idMateria2'], 'integer'],
        	[['tipo'], 'string'],
            [['idMateria1'], 'exist', 'skipOnError' => true, 'targetClass' => Materia::className(), 'targetAttribute' => ['idMateria1' => 'idMateria']],
            [['idMateria2'], 'exist', 'skipOnError' => true, 'targetClass' => Materia::className(), 'targetAttribute' => ['idMateria2' => 'idMateria']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMateria1' => 'Materia',
            'idMateria2' => 'Correlativa',
        		'tipo'=>'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMateria10()
    {
        return $this->hasOne(Materia::className(), ['idMateria' => 'idMateria1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMateria20()
    {
        return $this->hasOne(Materia::className(), ['idMateria' => 'idMateria2']);
    }
}
