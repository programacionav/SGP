<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DepartamentoDocenteCargo */

$this->title = $model->idDocente;
$this->params['breadcrumbs'][] = ['label' => 'Departamento Docente Cargos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-docente-cargo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idDocente' => $model->idDocente, 'idDepartamento' => $model->idDepartamento, 'idCargo' => $model->idCargo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idDocente' => $model->idDocente, 'idDepartamento' => $model->idDepartamento, 'idCargo' => $model->idCargo], [
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
            'idDepartamento',
            'idCargo',
        ],
    ]) ?>

</div>
