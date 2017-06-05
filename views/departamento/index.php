<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Facultad;

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
        <?= Html::a('Registrar nuevo Departamento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

          //  'idDepartamento',
            'nombre',
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
              'template' => '{view} {update}'
            ],
        ],
    ]); ?>
</div>
