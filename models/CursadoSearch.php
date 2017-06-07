<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cursado;


/**
 * CursadoSearch represents the model behind the search form about `app\models\Cursado`.
 */
class CursadoSearch extends Cursado
{public $materia;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        		[['materia'], 'safe'],
                [[ 'cuatrimestre'],'string'],
            [['idCursado', 'idMateria'], 'integer'],
            [['fechaInicio', 'fechaFin'], 'safe'],
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
    	
    	
    	
   


        $query = Cursado::find();
        
        
       
        
        
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
            'idCursado' => $this->idCursado,
            'fechaInicio' => $this->fechaInicio,
            'fechaFin' => $this->fechaFin,
        	'idMateria'=>$this->idMateria,
             
            'cuatrimestre' => $this->cuatrimestre,
        ]);
       

        return $dataProvider;
    }
}
