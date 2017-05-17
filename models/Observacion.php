<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "observacion".
 *
 * @property integer $idObservacion
 * @property string $observacion
 * @property integer $idEstadoO
 * @property integer $idUsuario
 * @property integer $idPrograma
 *
 * @property Programa $idPrograma0
 * @property Estadoobservacion $idEstadoO0
 * @property Usuario $idUsuario0
 */
class Observacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'observacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['observacion', 'idEstadoO', 'idUsuario', 'idPrograma'], 'required'],
            [['idEstadoO', 'idUsuario', 'idPrograma'], 'integer'],
            [['observacion'], 'string', 'max' => 200],
            [['idPrograma'], 'exist', 'skipOnError' => true, 'targetClass' => Programa::className(), 'targetAttribute' => ['idPrograma' => 'idPrograma']],
            [['idEstadoO'], 'exist', 'skipOnError' => true, 'targetClass' => Estadoobservacion::className(), 'targetAttribute' => ['idEstadoO' => 'idEstadoO']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idObservacion' => Yii::t('app', 'Id Observacion'),
            'observacion' => Yii::t('app', 'Observacion'),
            'idEstadoO' => Yii::t('app', 'Id Estado O'),
            'idUsuario' => Yii::t('app', 'Id Usuario'),
            'idPrograma' => Yii::t('app', 'Id Programa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPrograma0()
    {
        return $this->hasOne(Programa::className(), ['idPrograma' => 'idPrograma']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstadoO0()
    {
        return $this->hasOne(Estadoobservacion::className(), ['idEstadoO' => 'idEstadoO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }
}
