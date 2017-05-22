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
