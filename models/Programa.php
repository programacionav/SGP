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
    /*
        VALIDACION PARA PROGRAMA:
        1 - EL DOCENTE CREA EL PROGRAMA (En estado ABIERTO)(marco - listo)
        2 - EL EDITA EL PROGRAMA TODAS LAS VECES QUE QUIERA HASTA QUE TOQUE EL BOTON ENVIAR A REVISION(marco - listo)
        3 - EL PROGRAMA PASA A ESTADO REVISION Y EL DIRECTOR ACAD LO VE Y PUEDE OBSERVAR Y REENVIAR A ESTADO ABIERTO
        4 - EL DIRECTOR REENVIA A ABIERTO CON OBSERVICIONES (SOLO CON OBSERVACION)
        (SOLO LO PUEDE REABRIR SI TIENE OBSERVACIONES)
        5 - EL DOCENTE RECIBE OBSERVACIONES Y PUEDE PONER REALZIDO (PARA ENVIAR TIENEN QUE ESTAR LASOBSERVACIONES ENVIADAS)(marco - listo)
        6 - DIRECTOR ENVIA APROBANDO EL PROGRAMA AL SECT
        7 - EL SEC PUBLICA Y VE LOS PUBLICADOS Y LOS PENDIENTES DE PUBLICAR(leo)
    */

    const ABIERTO = 1;
    const APROBADO = 2 ;
    const PUBLICADO = 3;
    const REVISION = 4;
    const ayudante = "ayudante"; //lo hice aca para no tocar archivos que no son de nuestro grupo, me parece que deberia ir en el modelo designado,igualmente funciona.
    const acargo = "acargo";//lo hice aca para no tocar archivos que no son de nuestro grupo, me parece que deberia ir en el modelo designado,igualmente funciona.

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
            'anioActual' => 'Año Actual',
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
    public function isabierto()
    {
        if(Cambioestado::find()->where(['idPrograma'=>$this->idPrograma])->count()>0){
            return
            $this::find()
                ->joinWith('cambioestados')
                ->where(['cambioestado.idPrograma' => $this->idPrograma,'idEstadoP' => CambioEstado::find()->where(['cambioestado.idPrograma'=>$this->idPrograma])->max('idEstadoP')])
                ->one()->cambioestados[0]->idEstadoP == self::ABIERTO ? true : false;
        }
        else{
            return true;
        }
    }

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


    }

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

    public function getTitulo()
    {
        return "Nro cursado: ".$this->idCursado." - Año: ".$this->anioActual." - Materia: ".$this->idCursado0->idMateria0->nombre." - Cuatrimestre: ".$this->idCursado0->cuatrimestre;
    }

    //lo hice aca para no tocar archivos que no son de nuestro grupo, me parece que deberia ir en el modelo designado,igualmente funciona.
     public static function roleInArray($arr_role){
        foreach ( Yii::$app->user->identity->idDocente0->designados as $recorre2) {

  return in_array($recorre2->funcion , $arr_role);
}
}

public function existeObservacionRevison(){
  $observaciones = $this->observacions;
  foreach($observaciones as $observacion){
    if($observacion->idEstadoO == 1){
      $flag = true;
    }
  }
  $resultado = isset($flag);
  return $resultado;
}

  public function enRevision()
  {
     return $this->GetLastStatus() == self::REVISION;

  }
  public function abierto()
  {
     return $this->GetLastStatus() == self::ABIERTO;

  }
  public function publicado()
  {
     return $this->GetLastStatus() == self::PUBLICADO;

  }
  public function aprobado()
  {
     return $this->GetLastStatus() == self::APROBADO;

  }

  public function GetLastStatus()
  {
     return Cambioestado::find()->where(['idPrograma'=>$this->idPrograma])->max('idCambioEstado');
  }

}
