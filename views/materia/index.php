<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MateriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
     <?php
        $idRolActual=Yii::$app->user->identity->idRol;
        if ($idRolActual === 3) {
          echo Html::a('Nueva Materia', ['create'], ['class' => 'btn btn-success']);
          
        }
          ?>
        
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo',
            'nombre',
            'anio',
            'hora',
            'objetivo',
            'contenidoMinimo',
            // 'idMateria',
            //'idDepartamento',
            // 'idPlan',
            'area',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
