<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Cambiar Contraseña';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['usuario'], 'url' => ['view', 'id' => $model->idUsuario]];
$this->params['breadcrumbs'][] = 'Cambiar Contraseña';
?>
<div class="usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
