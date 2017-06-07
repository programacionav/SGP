<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Facultad */

$this->title = 'Modificar Facultad: ' . $model['nombre'];
$this->params['breadcrumbs'][] = ['label' => 'Facultades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['nombre'], 'url' => ['view', 'id' => $model->idFacultad]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="facultad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
