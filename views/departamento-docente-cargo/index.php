<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Docente;
use app\models\Departamento;
use app\models\Cargo;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartamentoDocenteCargoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrar departamento y cargo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-docente-cargo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            
                [
               'attribute' => 'idDocente',
               'label' => 'Docente',
               'filter' => Docente::listaDeNombres(),
               'value' => function($model, $index, $dataColumn) {
                 $nombreDocente = Docente::listaDeNombres();//Arreglo con todos los nombres de las facultades
                 return $nombreDocente[$model->idDocente];//retorna el nombre segun idFacultad
                 },
               ],
                [
               'attribute' => 'idDepartamento',
               'label' => 'Departamento',
               'filter' => Departamento::listaDeNombres(),
               'value' => function($model, $index, $dataColumn) {
                 $nombreDepartamento = Departamento::listaDeNombres();//Arreglo con todos los nombres de las facultades
                 return $nombreDepartamento[$model->idDepartamento];//retorna el nombre segun idFacultad
                 },
               ],
            [
               'attribute' => 'idCargo',
               'label' => 'Cargo',
               'filter' => Cargo::listaDeNombres(),
               'value' => function($model, $index, $dataColumn) {
                 $nombreCargo = Cargo::listaDeNombres();//Arreglo con todos los nombres de las facultades
                 return $nombreCargo[$model->idCargo];//retorna el nombre segun idFacultad
                 },
               ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
