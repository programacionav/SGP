<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Programa */

$this->title = 'Update Programa: ' . $model->idPrograma;
$this->params['breadcrumbs'][] = ['label' => 'Programas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPrograma, 'url' => ['view', 'id' => $model->idPrograma]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="programa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
