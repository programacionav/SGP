<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Correlativa;

/**
 * CorrelativaSearch represents the model behind the search form about `app\models\Correlativa`.
 */
class CorrelativaSearch extends Correlativa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idMateria1', 'idMateria2'], 'integer'],
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
        $query = Correlativa::find();

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
            'idMateria1' => $this->idMateria1,
            'idMateria2' => $this->idMateria2,
        ]);

        return $dataProvider;
    }
}
