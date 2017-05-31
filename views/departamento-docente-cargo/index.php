<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartamentoDocenteCargoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departamento Docente Cargos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-docente-cargo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Departamento Docente Cargo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idDocente',
            'idDepartamento',
            'idCargo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
