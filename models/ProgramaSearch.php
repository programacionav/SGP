<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Programa;
use app\models\Rol;
use app\models\DepartamentoDocenteCargo;

/**
 * ProgramaSearch represents the model behind the search form about `app\models\Programa`.
 */
class ProgramaSearch extends Programa
{

    public $idMateria;
    public $idEstadoP;
    public $cuatrimestre;
    public $idCarrera;
    public $idPlan;
    public $idDepartamento;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPrograma', 'idCursado' , 'idMateria', 'idEstadoP', 'idCarrera', 'idPlan', 'idDepartamento'], 'integer'],
            [['orientacion', 'anioActual', 'programaAnalitico', 'propuestaMetodologica', 'condicionesAcredEvalu', 'horariosConsulta', 'bibliografia', 'cuatrimestre'], 'safe'],
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
    /*public function search($params)
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
            'programa.idPrograma' => $this->idPrograma,
            'programa.idCursado' => $this->idCursado,
            'programa.anioActual' => $this->anioActual,
            'materia.codigo' => $this->idMateria,
            'cambioestado.idEstadoP' => $this->idEstadoP,
            'carrera.idCarrera' => $this->idCarrera,
            'departamento.idDepartamento' => $this->idDepartamento,
            'plan.idPlan' => $this->idPlan,
        ]);

        $query->andFilterWhere(['like', 'orientacion', $this->orientacion])
            ->andFilterWhere(['like', 'programaAnalitico', $this->programaAnalitico])
            ->andFilterWhere(['like', 'propuestaMetodologica', $this->propuestaMetodologica])
            ->andFilterWhere(['like', 'condicionesAcredEvalu', $this->condicionesAcredEvalu])
            ->andFilterWhere(['like', 'horariosConsulta', $this->horariosConsulta])
            ->andFilterWhere(['like', 'bibliografia', $this->bibliografia])
            ->andFilterWhere(['like', 'bibliografia', $this->bibliografia])
            ->andFilterWhere(['like', 'cursado.cuatrimestre', $this->cuatrimestre]);

        return $dataProvider;
    }*/

    public function searchDocente($params)
    {
        /*
        Si es docente filtro por los programas que esten a su cargo y los que sean de su departamento siempre y cuando esten publicados. Ordenado por año materia cuatrimestre (descripcion) y cursado
        */
        $query = Programa::find();

        // add conditions that should always apply here
        $query->joinWith(['cambioestados','idCursado0.idMateria0.idDepartamento0', 'idCursado0.idMateria0.idPlan0.idCarrera0','idCursado0.designadoACargo']);

        //PENDIENTE VALIDAR EL DEPARTAMENTO DEL DOCENTE Y LOS PROGRAMAS PUBLICADOS
          //  $query->andFilterWhere(['materia.idDepartamento'=>DepartamentoDocenteCargo::find()->where(['idDocente'=>Yii::$app->user->identity->id])->one()->idDepartamento]);            

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->andFilterWhere(['designado.idDocente'=>Yii::$app->user->identity->id]);
        // grid filtering conditions
        $query->andFilterWhere([
            'programa.idPrograma' => $this->idPrograma,
            'programa.idCursado' => $this->idCursado,
            'programa.anioActual' => $this->anioActual,
            'materia.codigo' => $this->idMateria,
            'cambioestado.idEstadoP' => $this->idEstadoP,
            'carrera.idCarrera' => $this->idCarrera,
            'departamento.idDepartamento' => $this->idDepartamento,
            'plan.idPlan' => $this->idPlan,
        ]);

        $query->andFilterWhere(['like', 'orientacion', $this->orientacion])
            ->andFilterWhere(['like', 'programaAnalitico', $this->programaAnalitico])
            ->andFilterWhere(['like', 'propuestaMetodologica', $this->propuestaMetodologica])
            ->andFilterWhere(['like', 'condicionesAcredEvalu', $this->condicionesAcredEvalu])
            ->andFilterWhere(['like', 'horariosConsulta', $this->horariosConsulta])
            ->andFilterWhere(['like', 'bibliografia', $this->bibliografia])
            ->andFilterWhere(['like', 'bibliografia', $this->bibliografia])
            ->andFilterWhere(['like', 'cursado.cuatrimestre', $this->cuatrimestre]);

        return $dataProvider;
    }

    public function searchJefe($params)
    {
        /*Si es jefedpto filtro por su departameto y ordeno por año materia cuatrimestre y cursado, este no puede ver los programas de otros dptos. Ordenado por año materia cuatrimestre (descripcion) y cursado*/
        $query = Programa::find();

        // add conditions that should always apply here
        $query->joinWith(['cambioestados','idCursado0.idMateria0.idDepartamento0']);

        //PENDIENTE VALIDAR EL DEPARTAMENTO DEL DOCENTE 

        $query->andFilterWhere(['materia.idDepartamento'=>DepartamentoDocenteCargo::find()->where(['idDocente'=>Yii::$app->user->identity->id])->one()->idDepartamento]);            

        //Busco ultimo estado del programa y verifico que este en revision
        $query->andFilterWhere(['cambioestado.idEstadoP' => Cambioestado::find()->where(['idPrograma'=>$this->idPrograma])->max('idEstadoP')]);


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
            'programa.idPrograma' => $this->idPrograma,
            'programa.idCursado' => $this->idCursado,
            'programa.anioActual' => $this->anioActual,
            'materia.codigo' => $this->idMateria,
            //'cambioestado.idEstadoP' => $this->idEstadoP,
            'carrera.idCarrera' => $this->idCarrera,
            'departamento.idDepartamento' => $this->idDepartamento,
            'plan.idPlan' => $this->idPlan,
        ]);

        $query->andFilterWhere(['like', 'orientacion', $this->orientacion])
            ->andFilterWhere(['like', 'programaAnalitico', $this->programaAnalitico])
            ->andFilterWhere(['like', 'propuestaMetodologica', $this->propuestaMetodologica])
            ->andFilterWhere(['like', 'condicionesAcredEvalu', $this->condicionesAcredEvalu])
            ->andFilterWhere(['like', 'horariosConsulta', $this->horariosConsulta])
            ->andFilterWhere(['like', 'bibliografia', $this->bibliografia])
            ->andFilterWhere(['like', 'bibliografia', $this->bibliografia])
            ->andFilterWhere(['like', 'cursado.cuatrimestre', $this->cuatrimestre]);

        return $dataProvider;
    }

    public function searchSecAcademico($params)
    {
        /*Si es sec academico filtro los programas publicados ordenados por año, carrera, materia, cuatrimestre (descripcion) y crusado. (Este no puede ver otros programas que no esten publicados, pero si ve aquellos que esten pendientes de publicar por el.)*/
        $query = Programa::find();

        // add conditions that should always apply here
        $query->joinWith(['cambioestados']);

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
            'programa.idPrograma' => $this->idPrograma,
            'programa.idCursado' => $this->idCursado,
            'programa.anioActual' => $this->anioActual,
            'materia.codigo' => $this->idMateria,
            'cambioestado.idEstadoP' => self::PUBLICADO,
            'carrera.idCarrera' => $this->idCarrera,
            'departamento.idDepartamento' => $this->idDepartamento,
            'plan.idPlan' => $this->idPlan,
        ]);

        $query->andFilterWhere(['like', 'orientacion', $this->orientacion])
            ->andFilterWhere(['like', 'programaAnalitico', $this->programaAnalitico])
            ->andFilterWhere(['like', 'propuestaMetodologica', $this->propuestaMetodologica])
            ->andFilterWhere(['like', 'condicionesAcredEvalu', $this->condicionesAcredEvalu])
            ->andFilterWhere(['like', 'horariosConsulta', $this->horariosConsulta])
            ->andFilterWhere(['like', 'bibliografia', $this->bibliografia])
            ->andFilterWhere(['like', 'bibliografia', $this->bibliografia])
            ->andFilterWhere(['like', 'cursado.cuatrimestre', $this->cuatrimestre]);

        return $dataProvider;
    }
}