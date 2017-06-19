<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamento".
 *
 * @property integer $idDepartamento
 * @property string $nombre
 * @property integer $idDocente
 * @property integer $idFacultad
 *
 * @property Facultad $idFacultad0
 * @property Departamentodocentecargo[] $departamentodocentecargos
 */
class Departamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamento';
    }

   //Funcion de Clase obtenida de la ejemplo 1 de la siguiente pagina
    //Fuente: https://amnah.net/2013/12/22/how-to-display-sort-and-filter-related-model-data-in-gridview/
    public static function listaDeNombres() {
        $modelos = static::find()->all();
        foreach ($modelos as $modelo) {
            $listaDeNombres[$modelo->idDepartamento] = $modelo->nombre;
        }
        return $listaDeNombres; //Devuelve un arreglo con los nombre de cada facultad y su indice corresponde con el idFacultad
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
	        [['nombre'], 'required'],
            [['idDocente'], 'required', 'message'=>'Ingrese el Director'],
            [['idDocente'], 'integer'],
            [['idFacultad'], 'required', 'message' => 'Ingrese la facultad'],
            [['idFacultad'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['nombre'], 'unique', 'message' => 'Este Departamento ya esta creado'], 
            [['idFacultad'], 'exist', 'skipOnError' => true, 'targetClass' => Facultad::className(), 'targetAttribute' => ['idFacultad' => 'idFacultad']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDepartamento' => 'Id Departamento',
            'nombre' => 'Nombre',
            'idDocente' => 'Id Docente',
            'idFacultad' => 'Id Facultad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFacultad0()//devuelve objeto
    {
        return $this->hasOne(Facultad::className(), ['idFacultad' => 'idFacultad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentodocentecargos()
    {
        return $this->hasMany(DepartamentoDocenteCargo::className(), ['idDepartamento' => 'idDepartamento']);
    }
}
