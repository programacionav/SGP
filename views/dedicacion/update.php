<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dedicacion */

$this->title = 'Modificar Dedicacion: ' . $model['descripcion'];
$this->params['breadcrumbs'][] = ['label' => 'Dedicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['descripcion'], 'url' => ['view', 'id' => $model->idDedicacion]];
$this->params['breadcrumbs'][] = 'Modificar Dedicacion';
?>
<div class="dedicacion-update">

    <h1><?= Html::encode($model['descripcion']) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
