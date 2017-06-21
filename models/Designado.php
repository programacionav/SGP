<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "designado".
 *
 * @property string $funcion
 * @property integer $idCursado
 * @property integer $idDocente
 *
 * @property Cursado $idCursado0
 * @property Docente $idDocente0
 */
class Designado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'designado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //[['nombre'],'unique',"message"=>'El nombre de la carrera ya existe'],
            [['funcion', 'idCursado', 'idDocente'], 'required'],
            [['idCursado', 'idDocente'], 'integer'],
            [['idDocente'],'unique','targetAttribute'=>['idCursado','idDocente'],"message"=>'El docente ya fue asignado al cursado'],
            [['funcion'], 'string', 'max' => 100],
            [['idCursado'], 'exist', 'skipOnError' => true, 'targetClass' => Cursado::className(), 'targetAttribute' => ['idCursado' => 'idCursado']],
            [['idDocente'], 'exist', 'skipOnError' => true, 'targetClass' => Docente::className(), 'targetAttribute' => ['idDocente' => 'idDocente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'funcion' => 'Funcion',
            'idCursado' => 'Id Cursado',
            'idDocente' => 'Id Docente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCursado0()
    {
        return $this->hasOne(Cursado::className(), ['idCursado' => 'idCursado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDocente0()
    {
        return $this->hasOne(Docente::className(), ['idDocente' => 'idDocente']);
    }
    public function esACargo(){
      return $this->funcion == 'acargo';
    }
}
