<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Facultad;
use app\models\Docente;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
         if (Yii::$app->user->identity->idRol===3) {
            echo Html::a('Nuevo departamento', ['create'], ['class' => 'btn btn-success']);
         }
          ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

          //  'idDepartamento',
            'nombre',
        [
            'attribute' => 'idDocente',
            'label' => 'Docente',
            'filter' => Docente::listaDeNombres(),
            'value' => function($model, $index, $dataColumn) {
                $nombreDocente = Docente::listaDeNombres();//Arreglo con todos los nombres de los Docentes
                return $nombreDocente[$model->idDocente];//retorna el nombre segun idDocente
            },
        ],
        [
            'attribute' => 'idFacultad',
            'label' => 'Facultad',
            'filter' => Facultad::listaDeNombres(),
            'value' => function($model, $index, $dataColumn) {
                $nombreFacultad = Facultad::listaDeNombres();//Arreglo con todos los nombres de las facultades
                return $nombreFacultad[$model->idFacultad];//retorna el nombre segun idFacultad
            },
        ],

            ['class' => 'yii\grid\ActionColumn',
              'template' => '{view} {update}',
              'buttons' => [
                  'update'=> function($url,$model){
                      $idRolActual=Yii::$app->user->identity->idRol;
                      if($idRolActual===3){
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                      $url, ['title' => Yii::t('app', 'lead-update'),]);
                      }
                  }
              ],
            ],
        ],
    ]); ?>
</div>
