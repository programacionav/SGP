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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        //Si es a cargo le muestro los abiertos y en revision que haya creado el como docente
        //Si es a cargo o no lo es le muestro ademas los publicados
        $query->joinWith(['idCursado0.idMateria0']);
        if(Designado::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente,'funcion'=>'acargo'])->count()>0)
        {            
            $query->andWhere('( 
                materia.idDepartamento IN (SELECT idDepartamento FROM departamentodocentecargo WHERE idDocente = '.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.')
                AND (
                        (SELECT idEstadoP FROM cambioestado 
                        WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)
                        ) IN (1,4)
                    )
                OR (
                        (SELECT idUsuario FROM cambioestado 
                        WHERE idCambioEstado = (SELECT min(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)
                        ) IN ('.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.')
                    )
                )
                OR 
                (
                    (SELECT idEstadoP FROM cambioestado 
                        WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)
                        ) IN (3)
                )
                 ');
        }
        else{

            $query->andWhere('
                (SELECT idEstadoP FROM cambioestado WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)) IN (3)
                AND 
                materia.idDepartamento IN (SELECT idDepartamento FROM departamentodocentecargo WHERE idDocente = '.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.')');
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
            'materia.idDepartamento' => $this->idDepartamento,
        ]);

        if((isset($this->idCarrera) && is_numeric($this->idCarrera)) || isset($this->idPlan) && is_numeric($this->idPlan))
        {
            $query->joinWith(['idCursado0.idMateria0.idPlan0.idCarrera0']);

            $query->andFilterWhere([            
                'carrera.idCarrera' => $this->idCarrera,
                'plan.idPlan' => $this->idPlan,     
            ]);
        }
        

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
        //Si es a cargo le muestro los abiertos y en revision que haya creado el como docente
        //Si es a cargo o no lo es, le muestro ademas los que esten en revision y/o aprobado que sean de su dpto y los que 

        $query = Programa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->joinWith(['idCursado0.idMateria0']);

        if(Designado::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente,'funcion'=>'acargo'])->count()>0)
        {
            
            $query->andWhere('( 
                materia.idDepartamento IN (SELECT idDepartamento FROM departamentodocentecargo WHERE idDocente = '.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.')
                AND (
                        (SELECT idEstadoP FROM cambioestado 
                        WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)
                        ) IN (1,4)
                    )
                OR (
                        (SELECT idUsuario FROM cambioestado 
                        WHERE idCambioEstado = (SELECT min(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)
                        ) IN ('.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.')
                    )
                ) ');

                $query->orWhere('(SELECT idEstadoP FROM cambioestado WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)) IN (2,3)
                    AND materia.idDepartamento IN (SELECT idDepartamento FROM departamento WHERE idDocente = '.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.')');  

        }
        else{
            if(DepartamentoDocenteCargo::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente])->count()>0)
            {
                $query->andFilterWhere(['materia.idDepartamento'=>DepartamentoDocenteCargo::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente])->one()->idDepartamento]);    
            }
            
            $query->orWhere('((SELECT idEstadoP FROM cambioestado WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)) IN (2,4)
                    AND materia.idDepartamento IN (SELECT idDepartamento FROM departamento WHERE idDocente = '.Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente.'))
                OR (
                    (SELECT idEstadoP FROM cambioestado WHERE idCambioEstado = (SELECT max(idCambioEstado) FROM cambioestado WHERE cambioestado.idPrograma = programa.idPrograma)) IN (3)
                )');  
        }


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        

        $query->andFilterWhere([
            'programa.idPrograma' => $this->idPrograma,
            'programa.idCursado' => $this->idCursado,
            'programa.anioActual' => $this->anioActual,
            'materia.codigo' => $this->idMateria,
            'cambioestado.idEstadoP' => $this->idEstadoP,
            'carrera.idCarrera' => $this->idCarrera,
            'materia.idDepartamento' => $this->idDepartamento,
        ]);

        if((isset($this->idCarrera) && is_numeric($this->idCarrera)) || isset($this->idPlan) && is_numeric($this->idPlan))
        {
            $query->joinWith(['idCursado0.idMateria0.idPlan0.idCarrera0']);

            $query->andFilterWhere([            
                'carrera.idCarrera' => $this->idCarrera,
                'plan.idPlan' => $this->idPlan,     
            ]);
        }

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
        //Si es a cargo le muestro los abiertos y en revision que haya creado el como docente
        //Si es a cargo o no lo es le muestro ademas los publicos y los aprobados 

        $query = Programa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);        

        $this->load($params);

        if(Designado::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente,'funcion'=>'acargo'])->count()>0)
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
            
            'cambioestado.idEstadoP' => $this->idEstadoP,
            'carrera.idCarrera' => $this->idCarrera,
            
        ]);

        if((isset($this->idCarrera) && is_numeric($this->idCarrera)) || isset($this->idPlan) && is_numeric($this->idPlan) || isset($this->idDepartamento) && is_numeric($this->idDepartamento)  || isset($this->idMateria) && is_numeric($this->idMateria) || isset($this->cuatrimestre) && is_numeric($this->cuatrimestre))
        {
            $query->joinWith(['idCursado0.idMateria0.idPlan0.idCarrera0']);

            $query->andFilterWhere([            
                'carrera.idCarrera' => $this->idCarrera,
                'plan.idPlan' => $this->idPlan, 
                'materia.idDepartamento' => $this->idDepartamento,
                'materia.codigo' => $this->idMateria,
            ]);

            $query->andFilterWhere(['like', 'cursado.cuatrimestre', $this->cuatrimestre]);
        }

        $query->andFilterWhere(['like', 'orientacion', $this->orientacion])
            ->andFilterWhere(['like', 'programaAnalitico', $this->programaAnalitico])
            ->andFilterWhere(['like', 'propuestaMetodologica', $this->propuestaMetodologica])
            ->andFilterWhere(['like', 'condicionesAcredEvalu', $this->condicionesAcredEvalu])
            ->andFilterWhere(['like', 'horariosConsulta', $this->horariosConsulta])
            ->andFilterWhere(['like', 'bibliografia', $this->bibliografia])
            ->andFilterWhere(['like', 'bibliografia', $this->bibliografia]);

        return $dataProvider;
    }
}