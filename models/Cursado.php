<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cursado".
 *
 * @property integer $idCursado
 * @property string $fechaInicio
 * @property string $fechaFin
 * @property integer $idMateria
 * @property integer $cuatrimestre
 *
 * @property Materia $idMateria0
 * @property Designado[] $designados
 * @property Docente[] $idDocentes
 * @property Programa[] $programas
 */
class Cursado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cursado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechaInicio', 'fechaFin'], 'required'],
            [['fechaInicio', 'fechaFin'], 'safe'],
            [['idMateria'], 'integer'],
<<<<<<< HEAD
            [['cuatrimestre'], 'string', 'max' => 30],

=======
            [['cuatrimestre'],'string'],          
>>>>>>> 7bb4f9d222367f2aa21e3816df8a8a63e30e903a
['fechaFin', 'compare', 'compareAttribute' => 'fechaInicio', 'operator' => '>', 'message'=>'La Fecha Fin debe ser mayor a Fecha Inicio'],

            [['idMateria'], 'exist', 'skipOnError' => true, 'targetClass' => Materia::className(), 'targetAttribute' => ['idMateria' => 'idMateria']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCursado' => 'Id Cursado',
            'fechaInicio' => 'Fecha Inicio',
            'fechaFin' => 'Fecha Fin',
            'idMateria' => 'Id Materia',
            'cuatrimestre' => 'Cuatrimestre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMateria0()
    {
        return $this->hasOne(Materia::className(), ['idMateria' => 'idMateria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignados()
    {
        return $this->hasMany(Designado::className(), ['idCursado' => 'idCursado']);
    }

    public function getDesignadoACargo()
    {
        return $this->hasOne(Designado::className(), ['idCursado' => 'idCursado'])->where([Designado::tableName().'.funcion'=>'acargo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDocentes()
    {
        return $this->hasMany(Docente::className(), ['idDocente' => 'idDocente'])->viaTable('designado', ['idCursado' => 'idCursado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramas()
    {
        return $this->hasMany(Programa::className(), ['idCursado' => 'idCursado']);
    }
}
