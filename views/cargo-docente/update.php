<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CargoDocente */

$this->title = 'Update Cargo Docente: ' . $model->idDocente;
$this->params['breadcrumbs'][] = ['label' => 'Cargo Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idDocente, 'url' => ['view', 'idDocente' => $model->idDocente, 'idCargo' => $model->idCargo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cargo-docente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
