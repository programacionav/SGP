<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Observacion */

$this->title = $model->idObservacion;
$this->params['breadcrumbs'][] = ['label' => 'Observacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="observacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idObservacion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idObservacion], [
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
            'idObservacion',
            'observacion',
            'idEstadoO',
            'idUsuario',
            'idPrograma',
        ],
    ]) ?>

</div>
