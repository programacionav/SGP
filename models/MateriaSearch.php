<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Materia;

/**
 * MateriaSearch represents the model behind the search form about `app\models\Materia`.
 */
class MateriaSearch extends Materia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'idMateria', 'idDepartamento', 'idPlan'], 'integer'],
            [['nombre', 'anio', 'hora', 'objetivo', 'contenidoMinimo'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Materia::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'codigo' => $this->codigo,
            'idMateria' => $this->idMateria,
            'idDepartamento' => $this->idDepartamento,
            'idPlan' => $this->idPlan,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'anio', $this->anio])
            ->andFilterWhere(['like', 'hora', $this->hora])
            ->andFilterWhere(['like', 'objetivo', $this->objetivo])
            ->andFilterWhere(['like', 'contenidoMinimo', $this->contenidoMinimo]);

        return $dataProvider;
    }
}
