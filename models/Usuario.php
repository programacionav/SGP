<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $idUsuario
 * @property integer $idDocente
 * @property integer $idRol
 * @property string $usuario
 * @property string $clave
 *
 * @property Cambioestado[] $cambioestados
 * @property Observacion[] $observacions
 * @property Docente $idDocente0
 * @property Rol $idRol0
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idDocente', 'idRol', 'usuario', 'clave'], 'required'],
            [['idDocente', 'idRol'], 'integer'],
            [['usuario'], 'string', 'max' => 50],
            [['clave'], 'string', 'max' => 100],
            [['idDocente'], 'exist', 'skipOnError' => true, 'targetClass' => Docente::className(), 'targetAttribute' => ['idDocente' => 'idDocente']],
            [['idRol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['idRol' => 'idRol']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'idDocente' => 'Id Docente',
            'idRol' => 'Id Rol',
            'usuario' => 'Usuario',
            'clave' => 'Clave',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCambioestados()
    {
        return $this->hasMany(Cambioestado::className(), ['idUsuario' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObservacions()
    {
        return $this->hasMany(Observacion::className(), ['idUsuario' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDocente0()
    {
        return $this->hasOne(Docente::className(), ['idDocente' => 'idDocente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRol0()
    {
        return $this->hasOne(Rol::className(), ['idRol' => 'idRol']);
    }
}
