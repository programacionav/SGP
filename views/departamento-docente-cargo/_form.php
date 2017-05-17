<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepartamentoDocenteCargo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departamento-docente-cargo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idDocente')->textInput() ?>

    <?= $form->field($model, 'idDepartamento')->textInput() ?>

    <?= $form->field($model, 'idCargo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
