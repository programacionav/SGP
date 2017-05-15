<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CursadoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cursado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idCursado') ?>

    <?= $form->field($model, 'fechaInicio') ?>

    <?= $form->field($model, 'fechaFin') ?>

    <?= $form->field($model, 'idMateria') ?>

    <?= $form->field($model, 'cuatrimestre') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
