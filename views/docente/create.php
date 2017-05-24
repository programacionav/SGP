<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Docente */

$this->title = 'Crear Docente';
$this->params['breadcrumbs'][] = ['label' => 'Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUsuario' => $modelUsuario, //Agrego el modelo Usuario recibido de DocenteController al hacer render en action create
    ]) ?>

</div>
