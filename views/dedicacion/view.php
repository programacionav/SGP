<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dedicacion */

$this->title = $model['descripcion'];
$this->params['breadcrumbs'][] = ['label' => 'Dedicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dedicacion-view">

    <h1><?= Html::encode($model['descripcion']) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->idDedicacion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->idDedicacion], [
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
            'descripcion',
        ],
    ]) ?>

</div>
