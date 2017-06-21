<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cursado;
use app\models\Designado;


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
         print_r($dataProvider);

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
       
print_r($dataProvider);
        return $dataProvider;
    }

    public function searchCursados($params)
    { 
        
        $usuario=yii::$app->user->identity;
        //print_r($usuario);
        //print_r($usuario);
         //select('cursado.*, designado.funcion')
        //->joinWith([''])=>Yii::$app->user->identity->idDocente]);
    
         
      
        //---- 
      
        $docente = $usuario->idDocente0;
       //$cursados = $docente->getIdCursados();
       

        $query = $docente->getIdCursados();//Designado::find()->where(['idDocente'=>$docente['idDocente']]);
        /*$query = Designado::find()
        ->select('docente.idDocente,cursado.*')
        ->join('INNER JOIN','docente','designado.idDocente=docente.idDocente')
        ->join('INNER JOIN','cursado','cursado.idCursado=designado.idCursado')
        ->where('designado.idDocente='.$docente['idDocente']);
        */
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


/*-----------------------------------------aca--------------

        $cadena="";
$m=$dataProvider->getModels();
foreach($m as $cursado){
  $cadena.=$cursado['idCursado'].",";

//echo "idCursado: ".($cursado['idCursado']);
	//echo "idDocente: ".($cursado['idDocente']);
	}

    $queryCursado=Cursado::findAll([$cadena]);
    $resultadoCursado= new ActiveDataProvider([
            'query' => $queryCursado,
        ]);
   print_r($resultadoCursado);
   print_r($resultadoCursado);print_r($resultadoCursado);
    
   
            //$dataProviderC=Cursado::find()->where()
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
          
            return $dataProvider;
        }/*----aca-------
      
        // grid filtering conditions
        
        $query->andFilterWhere([
           'idCursado' => $this->idCursado,
            'fechaInicio' => $this->fechaInicio,
            'fechaFin' => $this->fechaFin,
        	'idMateria'=>$this->idMateria,
             'idCursado'=>4
            'cuatrimestre' => $this->cuatrimestre,
        ]);*/
       

        return $dataProvider;
    }
}
