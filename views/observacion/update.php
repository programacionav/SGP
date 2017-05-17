<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Observacion */

$this->title = 'Update Observacion: ' . $model->idObservacion;
$this->params['breadcrumbs'][] = ['label' => 'Observacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idObservacion, 'url' => ['view', 'id' => $model->idObservacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="observacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
