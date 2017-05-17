<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dedicacion */

$this->title = $model->idDedicacion;
$this->params['breadcrumbs'][] = ['label' => 'Dedicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dedicacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idDedicacion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idDedicacion], [
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
            'idDedicacion',
            'descripcion',
        ],
    ]) ?>

</div>
