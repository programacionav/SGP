<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "programa".
 *
 * @property integer $idPrograma
 * @property integer $idCursado
 * @property string $orientacion
 * @property string $añoActual
 * @property string $programaAnalitico
 * @property string $propuestaMetodologica
 * @property string $condicionesAcredEvalu
 * @property string $horariosConsulta
 * @property string $bibliografia
 *
 * @property Cambioestado[] $cambioestados
 * @property Observacion[] $observacions
 * @property Cursado $idCursado0
 */
class Programa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'programa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCursado', 'orientacion', 'añoActual', 'programaAnalitico', 'propuestaMetodologica', 'condicionesAcredEvalu', 'horariosConsulta', 'bibliografia'], 'required'],
            [['idCursado'], 'integer'],
            [['añoActual'], 'safe'],
            [['programaAnalitico'], 'string'],
            [['orientacion', 'propuestaMetodologica', 'condicionesAcredEvalu', 'horariosConsulta', 'bibliografia'], 'string', 'max' => 200],
            [['idCursado'], 'exist', 'skipOnError' => true, 'targetClass' => Cursado::className(), 'targetAttribute' => ['idCursado' => 'idCursado']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPrograma' => Yii::t('app', 'Id Programa'),
            'idCursado' => Yii::t('app', 'Id Cursado'),
            'orientacion' => Yii::t('app', 'Orientacion'),
            'añoActual' => Yii::t('app', 'Año Actual'),
            'programaAnalitico' => Yii::t('app', 'Programa Analitico'),
            'propuestaMetodologica' => Yii::t('app', 'Propuesta Metodologica'),
            'condicionesAcredEvalu' => Yii::t('app', 'Condiciones Acred Evalu'),
            'horariosConsulta' => Yii::t('app', 'Horarios Consulta'),
            'bibliografia' => Yii::t('app', 'Bibliografia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCambioestados()
    {
        return $this->hasMany(Cambioestado::className(), ['idPrograma' => 'idPrograma']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObservacions()
    {
        return $this->hasMany(Observacion::className(), ['idPrograma' => 'idPrograma']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCursado0()
    {
        return $this->hasOne(Cursado::className(), ['idCursado' => 'idCursado']);
    }
}
