<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Docente;

/* @var $this yii\web\View */
/* @var $model app\models\DepartamentoDocenteCargo */
$itemDocente = ArrayHelper::map(Docente::find()->all(),
'idDocente',
function($model) {
    return $model['nombre'].' '.$model['apellido'];
}
);
$this->title = 'Modificar Departamento y Cargo: ' . $itemDocente[$model->idDocente];
$this->params['breadcrumbs'][] = ['label' => 'Docentes', 'url' => ['docente/index']];
$this->params['breadcrumbs'][] = ['label' => 'Administrar departamento y cargo', 'url' => ['index', 'idDocente' => $model->idDocente]];
$this->params['breadcrumbs'][] = ['label' => $itemDocente[$model->idDocente], 'url' => ['view', 'idDocente' => $model->idDocente, 'idDepartamento' => $model->idDepartamento, 'idCargo' => $model->idCargo]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="departamento-docente-cargo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
