<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Materia;
use app\models\Plan;

use app\models\Correlativa;
use yii\base\Object;
/* @var $this yii\web\View */
/* @var $model app\models\Correlativa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="correlativa-form">

    <?php $form = ActiveForm::begin(); ?>

 
 <?= $form->field($model, 'idMateria1')->dropDownList(
      ArrayHelper::map($unPlan->materias,'idMateria','nombre')) ?>


 <?php 
 $array=array();
 
 $tabla = "<table class='table table-hover'>"
 		. " <tr><th>Materia</th><th>Tipo</th>";
 
 foreach ($unPlan->materias as $unaMateria ){ 
 if($unaMateria->idMateria != $model->idMateria1){
 	$correlativa= new Correlativa();
 	$correlativa->idMateria1=$model ->idMateria1;
 		$correlativa->idMateria2=$unaMateria ->idMateria;
 	array_push($array, $correlativa);
 	$posicion=count($array)-1;
 	
 	$tabla .= "<tr>".
       	'<td>'. $form->field($array[$posicion], 'idMateria2')->checkbox(['label'=>''])
 	    ->label($unaMateria->nombre).'</td>'. 
 	  
   '<td>'. $form->field($model, 'tipo')    ->radioList(array('label1'=>'Aprobado','label2'=>'Cursado'))
  
   
                                          ->label('')."</td>"
            		."</tr>";
 }
 
 }
 $tabla .= "</table>";
 echo $tabla;
 ?>
    
  
     		
   
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
