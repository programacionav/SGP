<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CargoDocente */

$this->title = $model->idDocente;
$this->params['breadcrumbs'][] = ['label' => 'Cargo Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargo-docente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idDocente' => $model->idDocente, 'idCargo' => $model->idCargo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idDocente' => $model->idDocente, 'idCargo' => $model->idCargo], [
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
            'idDocente',
            'idCargo',
        ],
    ]) ?>

</div>
