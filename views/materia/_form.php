<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Plan;
use app\models\Departamento;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Materia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hora')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'objetivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contenidoMinimo')->textInput(['maxlength' => true]) ?>
    
       
    <?= $form->field($model, 'idDepartamento')->dropDownList(
      ArrayHelper::map(Departamento::find()->all(), 'idDepartamento','nombre')) ?>
      
        <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>
    
    
 <?= $form->field($model, 'idPlan')->dropDownList(
      ArrayHelper::map(Plan::find()->all(), 'idPlan','numOrd')) ?>
       <div class="form-group">
     
</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
