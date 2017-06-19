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
    <?php $model->idCursado = $id_cursado; ?>
    <?php echo '<h3>Cursado N°'.$model->idCursado.'</h3>'; ?>
    <?php $cursado = Cursado::find()->where(['idCursado' => $model->idCursado])->one();
    

    ?>
	  <?php

        $itemDptos = Departamento::find() //obtengo un arreglo asociativo[index->titulo]
        ->select(['nombre'])  //de noticias donde: lo que esta dentro del option es el titulo
        ->indexBy('idDepartamento')       // y el value de los option es el id
        ->column();


        $item = Docente::find() //obtengo un arreglo asociativo[index->titulo]
        ->select(['nombre'])  //de noticias donde: lo que esta dentro del option es el titulo
        ->indexBy('idDocente')       // y el value de los option es el id
        ->column();

     $usuario=yii::$app->user->identity;//usuario;
     //$docente= $usuario->idDocente0;
     //print_r($docente);Departamento::findOne();
     $model_dpto->idDepartamento =2;
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

     ?>
     <?php
    
      $desigACargo = $cursado->designadoACargo;
      if(count($desigACargo)==0){
        $funciones = ['acargo' => 'A Cargo','ayudante' => 'Ayudante'];
      }else{
        $funciones = ['ayudante' => 'Ayudante'];
      }
      ?>

    <?php /* $form->field($model, 'idDocente')->textInput(); */?>
    <?= $form->field($model, 'funcion')->dropdownList(
    $funciones,
    ['prompt'=>'Elija la funcion']); ?>
    <?= $form->field($model, 'idCursado')->hiddeninput()->label(""); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
