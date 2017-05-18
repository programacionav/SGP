<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Designado */
/* @var $form yii\widgets\ActiveForm */
use app\models\Docente;
use app\models\Departamento;
?>

<div class="designado-form">

    <?php $form = ActiveForm::begin(); ?>
	  <?php
        $itemDptos = Departamento::find() //obtengo un arreglo asociativo[index->titulo]
        ->select(['nombre'])  //de noticias donde: lo que esta dentro del option es el titulo
        ->indexBy('idDepartamento')       // y el value de los option es el id
        ->column();


        $item = Docente::find() //obtengo un arreglo asociativo[index->titulo]
        ->select(['nombre'])  //de noticias donde: lo que esta dentro del option es el titulo
        ->indexBy('idDocente')       // y el value de los option es el id
        ->column();

        $item2= Docente::find() //obtengo un arreglo asociativo[index->titulo]
        ->select(['apellido'])  //de noticias donde: lo que esta dentro del option es el titulo
        ->indexBy('idDocente')       // y el value de los option es el id
        ->column();

        foreach ($item as $indice => $nombre) {
          $item3[$indice] = (($item2[$indice].", ".$nombre));
        }
        print_r($item3);
     ?>
     <?= $form->field($model, 'idDocente')->dropdownList(
        $itemDptos,
        ['prompt'=>'Elija Departamento'])->label("Departamento");
      ?>
     <?= $form->field($model, 'idDocente')->dropdownList(
        $item3,
        ['prompt'=>'Elija docente'])->label("Docente");
      ?>
      
    <?php $funciones = ['acargo' => 'A Cargo','ayudante' => 'Ayudante']; ?>

    <?= $form->field($model, 'funcion')->dropdownList(
       $funciones,
       ['prompt'=>'Elija la funcion']); ?>

    <?= $form->field($model, 'idCursado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
