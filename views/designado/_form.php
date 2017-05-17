<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Designado */
/* @var $form yii\widgets\ActiveForm */
use app\models\Docente;
?>

<div class="designado-form">

    <?php $form = ActiveForm::begin(); ?>
	  <?php
      $item = Docente::find() //obtengo un arreglo asociativo[index->titulo]
        ->select(['Nombre'])  //de noticias donde: lo que esta dentro del option es el titulo
        ->indexBy('idDocente')       // y el value de los option es el id
        ->column();
     ?>
     <?= $form->field($model, 'idDocente')->dropdownList(
        $item,
    ['prompt'=>'Elija la docente']
    ); ?>

    <?= $form->field($model, 'funcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idCursado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
