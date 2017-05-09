<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cambioestado".
 *
 * @property integer $idCambioEstado
 * @property integer $idUsuario
 * @property string $fecha
 * @property integer $idEstadoP
 * @property integer $idPrograma
 *
 * @property Estadoprograma $idEstadoP0
 * @property Programa $idPrograma0
 * @property Usuario $idUsuario0
 */
class Cambioestado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cambioestado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUsuario', 'fecha', 'idEstadoP', 'idPrograma'], 'required'],
            [['idUsuario', 'idEstadoP', 'idPrograma'], 'integer'],
            [['fecha'], 'safe'],
            [['idEstadoP'], 'exist', 'skipOnError' => true, 'targetClass' => Estadoprograma::className(), 'targetAttribute' => ['idEstadoP' => 'idEstadoP']],
            [['idPrograma'], 'exist', 'skipOnError' => true, 'targetClass' => Programa::className(), 'targetAttribute' => ['idPrograma' => 'idPrograma']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCambioEstado' => Yii::t('app', 'Id Cambio Estado'),
            'idUsuario' => Yii::t('app', 'Id Usuario'),
            'fecha' => Yii::t('app', 'Fecha'),
            'idEstadoP' => Yii::t('app', 'Id Estado P'),
            'idPrograma' => Yii::t('app', 'Id Programa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstadoP0()
    {
        return $this->hasOne(Estadoprograma::className(), ['idEstadoP' => 'idEstadoP']);
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
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }
}
