<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CargoDocenteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cargo Docentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargo-docente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cargo Docente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idDocente',
            'idCargo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
