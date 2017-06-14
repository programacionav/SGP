<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cargo".
 *
 * @property integer $idCargo
 * @property string $abreviatura
 * @property string $descripcion
 *
 * @property Cargodocente[] $cargodocentes
 * @property Docente[] $idDocentes
 */
class Cargo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cargo';
    }



       //Funcion de Clase obtenida de la ejemplo 1 de la siguiente pagina
    //Fuente: https://amnah.net/2013/12/22/how-to-display-sort-and-filter-related-model-data-in-gridview/
    public static function listaDeNombres() {
        $modelos = static::find()->all();
        foreach ($modelos as $modelo) {
            $listaDeNombres[$modelo->idCargo] = $modelo->descripcion;
        }
        return $listaDeNombres; //Devuelve un arreglo con los nombre de cada facultad y su indice corresponde con el idFacultad
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['abreviatura', 'descripcion'], 'required'],
            [['abreviatura'], 'string', 'max' => 10],
            [['descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCargo' => 'Id Cargo',
            'abreviatura' => 'Abreviatura',
            'descripcion' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargodocentes()
    {
        return $this->hasMany(Cargodocente::className(), ['idCargo' => 'idCargo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDocentes()
    {
        return $this->hasMany(Docente::className(), ['idDocente' => 'idDocente'])->viaTable('cargodocente', ['idCargo' => 'idCargo']);
    }
}
