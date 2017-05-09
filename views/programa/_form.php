<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Programa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="programa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idCursado')->textInput() ?>

    <?= $form->field($model, 'orientacion')->textInput(['maxlength' => true]) ?>

    <!-- $form->field($model, 'añoActual')->textInput(['maxlength' => true]) -->

    <?= $form->field($model, 'programaAnalitico')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'propuestaMetodologica')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'condicionesAcredEvalu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'horariosConsulta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bibliografia')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
