<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Departamentodocente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departamentodocente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idDocente')->textInput() ?>

    <?= $form->field($model, 'idDepartamento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
