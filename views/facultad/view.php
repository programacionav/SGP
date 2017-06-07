<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Facultad */

$this->title = $model['nombre'];
$this->params['breadcrumbs'][] = ['label' => 'Facultades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facultad-view">

    <h1><?= Html::encode($model['nombre']) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->idFacultad], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->idFacultad], [
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
            'sigla',
            'nombre',
        ],
    ]) ?>

</div>
