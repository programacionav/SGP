<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Programa;

/**
 * ProgramaSearch represents the model behind the search form about `app\models\Programa`.
 */
class ProgramaSearch extends Programa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPrograma', 'idCursado'], 'integer'],
            [['orientacion', 'añoActual', 'programaAnalitico', 'propuestaMetodologica', 'condicionesAcredEvalu', 'horariosConsulta', 'bibliografia'], 'safe'],
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
        $query = Programa::find();

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
            'idPrograma' => $this->idPrograma,
            'idCursado' => $this->idCursado,
            'añoActual' => $this->añoActual,
        ]);

        $query->andFilterWhere(['like', 'orientacion', $this->orientacion])
            ->andFilterWhere(['like', 'programaAnalitico', $this->programaAnalitico])
            ->andFilterWhere(['like', 'propuestaMetodologica', $this->propuestaMetodologica])
            ->andFilterWhere(['like', 'condicionesAcredEvalu', $this->condicionesAcredEvalu])
            ->andFilterWhere(['like', 'horariosConsulta', $this->horariosConsulta])
            ->andFilterWhere(['like', 'bibliografia', $this->bibliografia]);

        return $dataProvider;
    }
}
