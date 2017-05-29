<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materia".
 *
 * @property integer $codigo
 * @property string $nombre
 * @property string $anio
 * @property string $hora
 * @property string $objetivo
 * @property string $contenidoMinimo
 * @property integer $idMateria
 * @property integer $idDepartamento
 * @property integer $idPlan
 *
 * @property Correlativa[] $correlativas
 * @property Correlativa[] $correlativas0
 * @property Materia[] $idMateria2s
 * @property Materia[] $idMateria1s
 * @property Cursado[] $cursados
 * @property Plan $idPlan0
 * @property Departamento $idDepartamento0
 */
class Materia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'anio', 'hora', 'objetivo', 'contenidoMinimo', 'idDepartamento', 'idPlan'], 'required'],
            [['codigo', 'idDepartamento', 'idPlan'], 'integer'],
            [['nombre'], 'string', 'max' => 40],
            [['anio', 'hora'], 'string', 'max' => 20],
            [['objetivo'], 'string', 'max' => 700],
            [['contenidoMinimo'], 'string', 'max' => 1500],
            [['idPlan'], 'exist', 'skipOnError' => true, 'targetClass' => Plan::className(), 'targetAttribute' => ['idPlan' => 'idPlan']],
            [['idDepartamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['idDepartamento' => 'idDepartamento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'anio' => 'Anio',
            'hora' => ' Cantidad de Horas Semanales',
            'objetivo' => 'Objetivos',
            'contenidoMinimo' => 'Contenidos Minimos',
            'idMateria' => 'Id Materia',
            'idDepartamento' => 'Departamento',
            'idPlan' => 'Numero de Ordenanza del Plan',
        	'area'=>'Area',	
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorrelativas()
    {
        return $this->hasMany(Correlativa::className(), ['idMateria1' => 'idMateria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorrelativas0()
    {
        return $this->hasMany(Correlativa::className(), ['idMateria2' => 'idMateria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMateria2s()
    {
        return $this->hasMany(Materia::className(), ['idMateria' => 'idMateria2'])->viaTable('correlativa', ['idMateria1' => 'idMateria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMateria1s()
    {
        return $this->hasMany(Materia::className(), ['idMateria' => 'idMateria1'])->viaTable('correlativa', ['idMateria2' => 'idMateria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCursados()
    {
        return $this->hasMany(Cursado::className(), ['idMateria' => 'idMateria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPlan0()
    {
        return $this->hasOne(Plan::className(), ['idPlan' => 'idPlan']);
    }

    public function getIdDepartamento0()
    {
    	return $this->hasOne(Departamento::className(), ['idDepartamento' => 'idDepartamento']);


}}
