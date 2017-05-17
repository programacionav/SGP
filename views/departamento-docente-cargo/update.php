<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DepartamentoDocenteCargo */

$this->title = 'Update Departamento Docente Cargo: ' . $model->idDocente;
$this->params['breadcrumbs'][] = ['label' => 'Departamento Docente Cargos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idDocente, 'url' => ['view', 'idDocente' => $model->idDocente, 'idDepartamento' => $model->idDepartamento, 'idCargo' => $model->idCargo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="departamento-docente-cargo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
