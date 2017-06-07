<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FacultadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Facultades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facultad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nueva facultad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'nombre',
            'sigla',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
