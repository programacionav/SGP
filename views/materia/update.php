<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Materia */

$this->title = 'Modificacion Materia ' ;
//$this->params['breadcrumbs'][] = ['label' => 'Materias', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idMateria, 'url' => ['view', 'id' => $model->idMateria]];
//$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="materia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
