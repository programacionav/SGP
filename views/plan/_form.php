<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Carrera;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Plan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numOrd')->textInput() ?>
   
  <?= $form->field($model, 'idCarrera')->dropDownList(
      ArrayHelper::map(Carrera::find()->all(), 'idCarrera', 'nombre')) ?>
   <div class="form-group">
   <?= Html::a('Nueva Carrera', ['carrera/create'], ['class' => 'btn btn-success']) ?>
</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear Plan' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])."&nbsp;&nbsp;"."&nbsp;&nbsp;" ?>
         <?= Html::a('Salir', ['carrera/index'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
