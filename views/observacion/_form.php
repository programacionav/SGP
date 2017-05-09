<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Observacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="observacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idEstadoO')->textInput() ?>

    <?= $form->field($model, 'idUsuario')->textInput() ?>

    <?= $form->field($model, 'idPrograma')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
