<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Departamento */
// @var mensaje 

$this->title = 'Modificar Departamento: ' . $model['nombre'];
$this->params['breadcrumbs'][] = ['label' => 'Departamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['nombre'], 'url' => ['view', 'id' => $model->idDepartamento]];
$this->params['breadcrumbs'][] = 'Modificar Departamento';
?>
<div class="departamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'mensaje' => $mensaje
    ]) ?>

</div>
