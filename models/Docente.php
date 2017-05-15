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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuil', 'nombre', 'apellido', 'mail', 'idDedicacion'], 'required'],
            [['idDedicacion'], 'integer'],
            [['cuil'], 'string', 'max' => 20],
            [['nombre', 'apellido'], 'string', 'max' => 50],
            [['mail'], 'string', 'max' => 100],
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
    public function getCargodocentes()
    {
        return $this->hasMany(Cargodocente::className(), ['idDocente' => 'idDocente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCargos()
    {
        return $this->hasMany(Cargo::className(), ['idCargo' => 'idCargo'])->viaTable('cargodocente', ['idDocente' => 'idDocente']);
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
    public function getDepartamentodocentes()
    {
        return $this->hasMany(Departamentodocente::className(), ['idDocente' => 'idDocente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDepartamentos()
    {
        return $this->hasMany(Departamento::className(), ['idDepartamento' => 'idDepartamento'])->viaTable('departamentodocente', ['idDocente' => 'idDocente']);
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
