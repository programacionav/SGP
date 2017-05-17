<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Materia;

/* @var $this yii\web\View */
/* @var $model app\models\Cursado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cursado-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
      $item = Materia::find() //obtengo un arreglo asociativo[index->titulo]
        ->select(['Nombre'])  //de noticias donde: lo que esta dentro del option es el titulo
        ->indexBy('idMateria')       // y el value de los option es el id
        ->column();
     ?>
     <?= $form->field($model, 'idMateria')->dropdownList(
        $item,
    ['prompt'=>'Elija la noticia']
    ); ?>
    <?= $form->field($model, 'fechaInicio')->textInput() ?>

    <?= $form->field($model, 'fechaFin')->textInput() ?>

    <?= $form->field($model, 'idMateria')->textInput() ?>

    <?= $form->field($model, 'cuatrimestre')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
