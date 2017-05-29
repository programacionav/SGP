<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Designado */
/* @var $form yii\widgets\ActiveForm */
use app\models\Docente;
use app\models\Departamento;
use app\models\Cursado;
?>

<div class="designado-form">

    <?php $form = ActiveForm::begin(); ?>
    <? $model->idCursado = $id_cursado; ?>
    <?= '<h3>Cursado N°'.$model->idCursado.'</h3>' ?>
    <?php $cursado = Cursado::find()->where(['idCursado' => $model->idCursado])->one();


    ?>
	  <?php
    /*
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

     echo $form->field($model_dpto,'idDepartamento')->dropdownList(
      $itemDptos,
      ['id'=>'idDepartamento']
     )->label("Departamento");

    // Nos va a servir cuando tengamos la relacion
    // $depto = Departamento::find()->where(['idDepartamento' => 1])->one();
    echo $form->field($model, 'idDocente')->widget(DepDrop::classname(), [
    'options'=>['id'=>'idDocente'],
    'pluginOptions'=>[
        'depends'=>['idDepartamento'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['subcat'])
    ]
    ]);
    */
     ?>

    <?php $funciones = ['acargo' => 'A Cargo','ayudante' => 'Ayudante']; ?>
    <?= $form->field($model, 'idDocente')->textInput(); ?>
    <?= $form->field($model, 'idCursado')->textInput(); ?>
    <?= $form->field($model, 'funcion')->dropdownList(
       $funciones,
       ['prompt'=>'Elija la funcion']); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
