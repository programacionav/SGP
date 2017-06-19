<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "docente".
 *
 * @property integer $idDocente
 * @property string $cuil
 * @property string $nombre
 * @property string $apellido
 * @property string $mail
 * @property integer $idDedicacion
 *
 * @property Cargodocente[] $cargodocentes
 * @property Cargo[] $idCargos
 * @property Departamento[] $departamentos
 * @property Departamentodocente[] $departamentodocentes
 * @property Departamento[] $idDepartamentos
 * @property Designado[] $designados
 * @property Cursado[] $idCursados
 * @property Dedicacion $idDedicacion0
 * @property Usuario[] $usuarios
 */
class Docente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'docente';
    }

   //Funcion de Clase obtenida de la ejemplo 1 de la siguiente pagina
    //Fuente: https://amnah.net/2013/12/22/how-to-display-sort-and-filter-related-model-data-in-gridview/
    public static function listaDeNombres() {
        $modelos = static::find()->all();
        foreach ($modelos as $modelo) {
            $listaDeNombres[$modelo->idDocente] = $modelo->nombre;
        }
        return $listaDeNombres; //Devuelve un arreglo con los nombre de cada facultad y su indice corresponde con el idFacultad
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuil', 'nombre', 'apellido', 'mail'], 'required'],
			      [['idDedicacion'], 'required', 'message'=>'Ingrese la dedicacion'],
            [['idDedicacion'], 'integer'],
            [['cuil'], 'number'],
            [['nombre', 'apellido'], 'string', 'max' => 50],
            [['mail'], 'string', 'max' => 100],
			['mail','email'],
            [['idDedicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Dedicacion::className(), 'targetAttribute' => ['idDedicacion' => 'idDedicacion']],
			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDocente' => 'Id Docente',
            'cuil' => 'Cuil',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'mail' => 'Mail',
            'idDedicacion' => 'Id Dedicacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentos()
    {
        return $this->hasMany(Departamento::className(), ['idDocente' => 'idDocente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentodocentecargos()
    {
        return $this->hasMany(Departamentodocentecargo::className(), ['idDocente' => 'idDocente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignados()
    {
        return $this->hasMany(Designado::className(), ['idDocente' => 'idDocente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCursados()
    {
        return $this->hasMany(Cursado::className(), ['idCursado' => 'idCursado'])->viaTable('designado', ['idDocente' => 'idDocente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDedicacion0()
    {
        return $this->hasOne(Dedicacion::className(), ['idDedicacion' => 'idDedicacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idDocente' => 'idDocente']);
    }
}
