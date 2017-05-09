<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ObservacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Observacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="observacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Observacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idObservacion',
            'observacion',
            'idEstadoO',
            'idUsuario',
            'idPrograma',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
