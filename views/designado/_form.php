<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Designado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="designado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'funcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idCursado')->textInput() ?>

    <?= $form->field($model, 'idDocente')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
