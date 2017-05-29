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
            [['idCursado', 'idMateria', 'cuatrimestre'], 'integer'],
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
        
        
        //$query->select(['materia.nombre','cursado.idMateria','cursado.cuatrimestre','cursado.fechaInicio','cursado.fechaFin','cursado.idCursado'])->from('cursado')->join('inner join','materia','materia.idMateria'>= 'cursado.idMateria');
        
        
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
        		
        	/*Array ( [0] => Array ( [nombre] => ELEMENTOS DE ÁLGEBRA [idMateria] => 1 [cuatrimestre] => 2 [fechaInicio] => 2017-12-10 [fechaFin] => 2018-02-12 [idCursado] => 1 ) [1] => Array ( [nombre] => ELEMENTOS DE ÁLGEBRA [idMateria] => 1 [cuatrimestre] => 2 [fechaInicio] => 0000-00-00 [fechaFin] => 0000-00-00 [idCursado] => 2 ) [2] => Array ( [nombre] => ELEMENTOS DE ÁLGEBRA [idMateria] => 1 [cuatrimestre] => 1 [fechaInicio] => 2017-05-16 [fechaFin] => 2017-05-03 [idCursado] => 3 ) [3] => Array ( [nombre] => ELEMENTOS DE ÁLGEBRA [idMateria] => 1 [cuatrimestre] => 1 [fechaInicio] => 2017-06-02 [fechaFin] => 2017-05-03 [idCursado] => 4 ) )
My Company
Home
About
Contact
Login
Home Cursados

*
*b\ActiveQuery Object ( [sql] => [on] => [joinWith] => [select] => Array ( [0] => materia.nombre [1] => cursado.idMateria [2] => cursado.cuatrimestre [3] => cursado.fechaInicio [4] => cursado.fechaFin [5] => cursado.idCursado ) [selectOption] => [distinct] => [from] => Array ( [0] => cursado ) [groupBy] => [join] => Array ( [0] => Array ( [0] => inner join [1] => materia [2] => ) ) [having] => [union] => [params] => Array ( ) [_events:yii\base\Component:private] => Array ( ) [_behaviors:yii\base\Component:private] => Array ( ) [where] => Array ( [cuatrimestre] => 1 ) [limit] => [offset] => [orderBy] => [indexBy] => [emulateExecution] => [modelClass] => app\models\Cursado [with] => [asArray] => [multiple] => [primaryModel] => [link] => [via] => [inverseOf] => )/
           */ //'idMateria' => $this->idMateria,
            'cuatrimestre' => $this->cuatrimestre,
        ]);
        print_r($query);

        return $dataProvider;
    }
}
