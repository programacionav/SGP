<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DepartamentoDocenteCargo */

$this->title = 'Asignar departamento y cargo al docente';
$this->params['breadcrumbs'][] = ['label' => 'Docentes', 'url' => ['docente/index']];
$this->params['breadcrumbs'][] = ['label' => 'Administrar departamento y cargo', 'url' => ['index', 'idDocente' => $model->idDocente]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-docente-cargo-create">

    <h1>Asignar departamento y cargo al docente </h1>

    <?= $this->render('_form', [
        'model' => $model 
    ]) ?>

</div>
