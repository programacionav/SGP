<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CorrelativaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Correlativas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="correlativa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p> <?php
        $idRolActual=Yii::$app->user->identity->idRol;
        if ($idRolActual === 3) {
          echo Html::a('Nueva Correlativa', ['create'], ['class' => 'btn btn-success']);   
        }
          ?>
       
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idMateria1',
            'idMateria2',
        		'tipo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
