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
 *
 * @property Cambioestado[] $cambioestados
 * @property Observacion[] $observacions
 * @property Cursado $idCursado0
 */
class Programa extends \yii\db\ActiveRecord
{
    const ABIERTO = 1;
    const VALIDADO = 2 ;
    const PUBLICADO = 3;

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
            [['idCursado', 'orientacion', 'anioActual', 'programaAnalitico', 'propuestaMetodologica', 'condicionesAcredEvalu', 'horariosConsulta', 'bibliografia'], 'required'],
            [['idCursado'], 'integer'],
            [['anioActual'], 'safe'],
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
            'idPrograma' => 'Id Programa',
            'idCursado' => 'Id Cursado',
            'orientacion' => 'Orientacion',
            'anioActual' => 'Anio Actual',
            'programaAnalitico' => 'Programa Analitico',
            'propuestaMetodologica' => 'Propuesta Metodologica',
            'condicionesAcredEvalu' => 'Condiciones Acred Evalu',
            'horariosConsulta' => 'Horarios Consulta',
            'bibliografia' => 'Bibliografia',
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

    //Verifica estado de el programa. 
    public function getIsabierto()
    {
        return 
        Cambioestado::find()
            ->joinWith('cambioestados')
            ->where(['idPrograma' => $this->idPrograma,'idEstadoP' => CambioEstado::find()->where(['idPrograma'=>$this->idPrograma])->max('idEstadoP')])
            ->one()->idEstadoP == self::ABIERTO ? true : false;

            
    }
/*
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        
            $cambioEstado = new Cambioestado;

            $aData['Cambioestado']['idUsuario'] = 1;//Cambiar por usuario logueado 
            $aData['Cambioestado']['fecha'] = date('Y-m-d');
            $aData['Cambioestado']['idEstadoP'] = self::ABIERTO;
            $aData['Cambioestado']['idPrograma'] = $this->idPrograma;
            
            if($cambioEstado->load($aData) && $cambioEstado->save())
            {
                return true;
            }else{
                false;
            }
        
        
    }*/

    //Retorna ultimo programa de un cursado especifico
    public static function Lastprograma($idCursado)
    {
        if(Programa::find()->where(['idCursado'=>$idCursado])->count() > 0)
        {
            return Programa::find()
            ->where(['idPrograma' => Programa::find()->where(['idCursado'=>$idCursado])->max('idPrograma')])
            ->one();
        }
        else{
            $p = new Programa;
            $p->idCursado = $idCursado;
            $p->anioActual = date('Y');
            return $p;
        }
    }

}
