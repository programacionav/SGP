<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Docente */

$this->title = 'Modificar Docente: ' . $model['nombre']." ".$model['apellido'];
$this->params['breadcrumbs'][] = ['label' => 'Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['nombre']." ".$model['apellido'], 'url' => ['view', 'id' => $model->idDocente]];
$this->params['breadcrumbs'][] = 'Modificar Docente';
?>
<div class="docente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUsuario' => $modelUsuario, //Agrego el modelo Usuario recibido de DocenteController al hacer render en action create
        'modelCargo' => $modelCargo,
        'modelDepartamento' => $modelDepartamento,
        'modelDepartamentoDocenteCargo' => $modelDepartamentoDocenteCargo,
    ]) ?>

</div>
