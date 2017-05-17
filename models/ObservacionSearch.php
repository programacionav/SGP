<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Observacion;

/**
 * ObservacionSearch represents the model behind the search form about `app\models\Observacion`.
 */
class ObservacionSearch extends Observacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idObservacion', 'idEstadoO', 'idUsuario', 'idPrograma'], 'integer'],
            [['observacion'], 'safe'],
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
        $query = Observacion::find();

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
            'idObservacion' => $this->idObservacion,
            'idEstadoO' => $this->idEstadoO,
            'idUsuario' => $this->idUsuario,
            'idPrograma' => $this->idPrograma,
        ]);

        $query->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }
}
