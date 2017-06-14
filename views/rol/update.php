<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rol */

$this->title = 'Modificar Rol: ' . $model['descripcion'];
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['descripcion'], 'url' => ['view', 'id' => $model->idRol]];
$this->params['breadcrumbs'][] = 'Modificar Rol';
?>
<div class="rol-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
