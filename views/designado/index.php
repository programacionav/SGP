<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DesignadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Designados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="designado-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Designado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'funcion',
            'idCursado',
            'idDocente',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
