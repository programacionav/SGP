<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Designado */

$this->title = $model->idCursado;
$this->params['breadcrumbs'][] = ['label' => 'Designados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="designado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'idCursado' => $model->idCursado, 'idDocente' => $model->idDocente], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'idCursado' => $model->idCursado, 'idDocente' => $model->idDocente], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'funcion',
            'idCursado',
            'idDocente',
        ],
    ]) ?>

</div>
