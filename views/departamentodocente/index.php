<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartamentodocenteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departamentodocentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamentodocente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Departamentodocente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idDocente',
            'idDepartamento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
