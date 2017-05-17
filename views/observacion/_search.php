<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ObservacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="observacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idObservacion') ?>

    <?= $form->field($model, 'observacion') ?>

    <?= $form->field($model, 'idEstadoO') ?>

    <?= $form->field($model, 'idUsuario') ?>

    <?= $form->field($model, 'idPrograma') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
