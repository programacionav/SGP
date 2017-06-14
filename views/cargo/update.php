<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cargo */

$this->title = 'Modificar Cargo: ' . $model['descripcion'];
$this->params['breadcrumbs'][] = ['label' => 'Cargos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['descripcion'], 'url' => ['view', 'id' => $model->idCargo]];
$this->params['breadcrumbs'][] = 'Modificar Cargo';
?>
<div class="cargo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
