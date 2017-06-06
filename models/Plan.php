<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property integer $idPlan
 * @property integer $numOrd
 * @property integer $idCarrera
 *
 * @property Materia[] $materias
 * @property Carrera $idCarrera0
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numOrd', 'idCarrera'], 'required'],
            [['numOrd'], 'string'],
        		[['numOrd'],'unique',"message"=>'El número de ordenanza ya existe'],
        		[['idCarrera'], 'integer'],
            [['idCarrera'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::className(), 'targetAttribute' => ['idCarrera' => 'idCarrera']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPlan' => 'Id Plan',
            'numOrd' => 'Numero Ordenanza',
            'idCarrera' => 'Carrera',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterias()
    {
        return $this->hasMany(Materia::className(), ['idPlan' => 'idPlan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCarrera0()
    {
        return $this->hasOne(Carrera::className(), ['idCarrera' => 'idCarrera']);
    }
}
