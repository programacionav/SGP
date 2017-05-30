<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facultad".
 *
 * @property integer $idFacultad
 * @property string $nombre
 * @property string $sigla
 *
 * @property Departamento[] $departamentos
 */
class Facultad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'facultad';
    }

    //Funcion de Clase obtenida de la ejemplo 1 de la siguiente pagina
    //Fuente: https://amnah.net/2013/12/22/how-to-display-sort-and-filter-related-model-data-in-gridview/
    public static function listaDeNombres() {
        $modelos = static::find()->all();
        foreach ($modelos as $modelo) {
            $listaDeNombres[$modelo->idFacultad] = $modelo->nombre;
        }
        return $listaDeNombres; //Devuelve un arreglo con los nombre de cada facultad y su indice corresponde con el idFacultad
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'sigla'], 'required'],
            [['nombre'], 'string', 'max' => 50],
            [['sigla'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFacultad' => 'Id Facultad',
            'nombre' => 'Nombre',
            'sigla' => 'Sigla',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentos()
    {
        return $this->hasMany(Departamento::className(), ['idFacultad' => 'idFacultad']);
    }
}
