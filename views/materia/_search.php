<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MateriaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'anio') ?>

    <?= $form->field($model, 'hora') ?>

    <?= $form->field($model, 'objetivo') ?>

    <?php // echo $form->field($model, 'contenidoMinimo') ?>

    <?php // echo $form->field($model, 'idMateria') ?>

    <?php // echo $form->field($model, 'idDepartamento') ?>

    <?php // echo $form->field($model, 'idPlan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
