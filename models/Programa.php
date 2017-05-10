<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "programa".
 *
 * @property integer $idPrograma
 * @property integer $idCursado
 * @property string $orientacion
 * @property string $anioActual
 * @property string $programaAnalitico
 * @property string $propuestaMetodologica
 * @property string $condicionesAcredEvalu
 * @property string $horariosConsulta
 * @property string $bibliografia
 * @property string $cuatrimestre
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
            [['idCursado', 'orientacion', 'anioActual', 'programaAnalitico', 'propuestaMetodologica', 'condicionesAcredEvalu', 'horariosConsulta', 'bibliografia', 'cuatrimestre'], 'required'],
            [['idCursado'], 'integer'],
            [['anioActual'], 'safe'],
            [['programaAnalitico'], 'string'],
            [['orientacion', 'propuestaMetodologica', 'condicionesAcredEvalu', 'horariosConsulta', 'bibliografia'], 'string', 'max' => 200],
            [['cuatrimestre'], 'string', 'max' => 50],
            [['idCursado'], 'exist', 'skipOnError' => true, 'targetClass' => Cursado::className(), 'targetAttribute' => ['idCursado' => 'idCursado']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPrograma' => 'Id Programa',
            'idCursado' => 'Id Cursado',
            'orientacion' => 'Orientacion',
            'anioActual' => 'Anio Actual',
            'programaAnalitico' => 'Programa Analitico',
            'propuestaMetodologica' => 'Propuesta Metodologica',
            'condicionesAcredEvalu' => 'Condiciones Acred Evalu',
            'horariosConsulta' => 'Horarios Consulta',
            'bibliografia' => 'Bibliografia',
            'cuatrimestre' => 'Cuatrimestre',
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
