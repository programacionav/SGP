<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Docente;

/**
 * DocenteSearch represents the model behind the search form about `app\models\Docente`.
 */
class DocenteSearch extends Docente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idDocente', 'idDedicacion'], 'integer'],
            [['cuil', 'nombre', 'apellido', 'mail'], 'safe'],
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
        $query = Docente::find();

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
            'idDocente' => $this->idDocente,
            'idDedicacion' => $this->idDedicacion,
        ]);

        $query->andFilterWhere(['like', 'cuil', $this->cuil])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'mail', $this->mail]);

        return $dataProvider;
    }
}
