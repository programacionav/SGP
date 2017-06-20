<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Cambioestado;
use app\models\Materia;
use app\models\Estadoprograma;
use app\models\Departamento;
use app\models\Carrera;
use app\models\Usuario;
use app\models\Plan;
use app\models\Rol;
use app\models\DepartamentoDocenteCargo;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ProgramaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Programas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programa-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php
    if(Rol::findOne(Yii::$app->user->identity->idRol)->esJefeDpto())
    {
        $aEstado = Estadoprograma::find()->where('idEstadoP <> 1')->asArray()->all();
    }

    if(Rol::findOne(Yii::$app->user->identity->idRol)->esDocente())
    {
        $aEstado = Estadoprograma::find()->where('idEstadoP <> 2')->asArray()->all();
    }

    if(Rol::findOne(Yii::$app->user->identity->idRol)->esSecAcademico())
    {
        $aEstado = Estadoprograma::find()->where('idEstadoP = 2 OR idEstadoP = 3')->asArray()->all();
    }

    $aDepto = Departamento::find()->asArray()->all();

    if(Rol::findOne(Yii::$app->user->identity->idRol)->esDocente() || Rol::findOne(Yii::$app->user->identity->idRol)->esJefeDpto()){

            if(DepartamentoDocenteCargo::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente])->count()>0)
            {

                $aDepto = Departamento::find()->where(['idDepartamento'=>DepartamentoDocenteCargo::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente])->one()->idDepartamento])->asArray()->all();
            }
    }
    
    $aMateria = Materia::find()->asArray()->all();

    if(Rol::findOne(Yii::$app->user->identity->idRol)->esDocente() || Rol::findOne(Yii::$app->user->identity->idRol)->esJefeDpto()){

        if(DepartamentoDocenteCargo::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente])->count()>0)
        {
            $aMateria = Materia::find()->where(['idDepartamento'=>DepartamentoDocenteCargo::find()->where(['idDocente'=>Usuario::find()->where(['idUsuario'=>Yii::$app->user->identity->id])->one()->idDocente])->one()->idDepartamento])->asArray()->all();
        }            

    }

    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Carrera',
                'attribute' => 'idCarrera',
                'value' => function ($data){
                    return $data->idCursado0->idMateria0->idPlan0->idCarrera0->nombre;
                },
                'filter'=>ArrayHelper::map(Carrera::find()->asArray()->all(), 'idCarrera', 'nombre'),
            ],
            [
                'label' => 'Plan',
                'attribute' => 'idPlan',
                'value' => function ($data){
                    return $data->idCursado0->idMateria0->idPlan0->numOrd;
                },
                'filter'=>ArrayHelper::map(Plan::find()->asArray()->all(), 'idPlan', 'numOrd'),
            ],
            [
                'label' => 'Departamento',
                'attribute' => 'idDepartamento',
                'value' => function ($data){
                    return $data->idCursado0->idMateria0->idDepartamento0->nombre;
                },
                'filter'=>ArrayHelper::map($aDepto, 'idDepartamento', 'nombre'),
            ],
            [
                'label' => 'Nro Cursado',
                'attribute' => 'idCursado',
                'value' => function ($data){
                    return $data->idCursado;
                }
            ],
            'anioActual',
            [
                'label' => 'Materia',
                'attribute' => 'idMateria',
                'value' => function ($data){
                    return $data->idCursado0->idMateria0->nombre;
                },
                'filter'=>ArrayHelper::map($aMateria, 'codigo', 'nombre'),
            ],
            [
                'label' => 'Cuatrimestre',
                'attribute' => 'cuatrimestre',
                'value' => function ($data){
                    return $data->idCursado0->cuatrimestre;
                },
            ],
            [
                'label' => 'Estado',
                'attribute' => 'idEstadoP',
                'value' => function ($data){
                    return Cambioestado::find()->where(['idCambioEstado'=> Cambioestado::find()->where(['idPrograma'=> $data->idPrograma])->max('idCambioEstado')])->one()->idEstadoP0->descripcion ;
                },
                'filter'=>false,
                //'filter'=>ArrayHelper::map($aEstado, 'idEstadoP', 'descripcion'),
            ],

            //'programaAnalitico:ntext',
            // 'propuestaMetodologica',
            // 'condicionesAcredEvalu',
            // 'horariosConsulta',
            // 'bibliografia',

           ['class' => 'yii\grid\ActionColumn', 'template' => '{view} '],
        ],
    ]); ?>
</div>
