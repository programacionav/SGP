<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CursadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cursados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursado-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cursado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idCursado',
            'fechaInicio',
            'fechaFin',
            'idMateria',
            'cuatrimestre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
