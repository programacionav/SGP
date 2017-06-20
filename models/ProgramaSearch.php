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



    public function searchDocente($params)
    {
        $query = Programa::find();

        // add conditions that should always apply here
        $query->joinWith(['idCursado0.idMateria0']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if(Designado::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente])->count()>0)
        {
            $query->joinWith(['idCursado0.idMateria0']);
            //
            $query->andWhere('( 
                materia.idDepartamento IN (SELECT idDepartamento FROM departamentodocentecargo WHERE idDocente = '.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.')
                AND (
                        (SELECT idEstadoP FROM cambioestado 
                        WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)
                        ) IN (1,4)
                    )
                AND (
                        (SELECT idUsuario FROM cambioestado 
                        WHERE idCambioEstado = (SELECT min(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)
                        ) IN ('.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.')
                    )
                ) ');
        }
        else{
            $query->andWhere('(SELECT idEstadoP FROM cambioestado WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)) IN (3)');
        }        

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
    }

    public function searchJefe($params)
    {
        $query = Programa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->joinWith(['idCursado0.idMateria0']);

        if(Designado::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente])->count()>0)
        {
            //
            $query->andWhere('( 
                materia.idDepartamento IN (SELECT idDepartamento FROM departamentodocentecargo WHERE idDocente = '.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.')
                AND (
                        (SELECT idEstadoP FROM cambioestado 
                        WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)
                        ) IN (1,4)
                    )
                AND (
                        (SELECT idUsuario FROM cambioestado 
                        WHERE idCambioEstado = (SELECT min(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)
                        ) IN ('.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.')
                    )
                ) ');

                $query->orWhere('(SELECT idEstadoP FROM cambioestado WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)) IN (2,3)');  

        }
        else{
            

            $query->andFilterWhere(['materia.idDepartamento'=>DepartamentoDocenteCargo::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente])->one()->idDepartamento]);            

            $query->andWhere('(SELECT idEstadoP FROM cambioestado WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado)) IN (2,3,4)');   
        }


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
        $query = Programa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);        

        $this->load($params);

        if(Designado::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente])->count()>0)
        {
            $query->joinWith(['idCursado0.idMateria0']);
            //
            $query->andWhere('( 
                materia.idDepartamento IN (SELECT idDepartamento FROM departamentodocentecargo WHERE idDocente = '.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.')
                AND (
                        (SELECT idEstadoP FROM cambioestado 
                        WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)
                        ) IN (1,4)
                    )
                AND (
                        (SELECT idUsuario FROM cambioestado 
                        WHERE idCambioEstado = (SELECT min(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)
                        ) IN ('.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.')
                    )
                ) ');

                $query->orWhere('(SELECT idEstadoP FROM cambioestado WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)) IN (2,3)');  

        }
        else{
            $query->andWhere('(SELECT idEstadoP FROM cambioestado WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)) IN (2,3)');
        }        

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
            //'cambioestado.idEstadoP' => self::PUBLICADO,
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