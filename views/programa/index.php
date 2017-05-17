<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProgramaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Programas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Programa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPrograma',
            'idCursado',
            'orientacion',
            'anioActual',
            'programaAnalitico:ntext',
            // 'propuestaMetodologica',
            // 'condicionesAcredEvalu',
            // 'horariosConsulta',
            // 'bibliografia',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
