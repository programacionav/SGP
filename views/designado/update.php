<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Designado */

$this->title = 'Update Designado: ' . $model->idCursado;
$this->params['breadcrumbs'][] = ['label' => 'Designados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCursado, 'url' => ['view', 'idCursado' => $model->idCursado, 'idDocente' => $model->idDocente]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="designado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
