<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dedicacion */

$this->title = 'Update Dedicacion: ' . $model->idDedicacion;
$this->params['breadcrumbs'][] = ['label' => 'Dedicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idDedicacion, 'url' => ['view', 'id' => $model->idDedicacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dedicacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
