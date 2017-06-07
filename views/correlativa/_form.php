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

 
 <h3>
<?php 

foreach ($unPlan->materias as $unaMateria)
{
	if($unaMateria->idMateria == $model->idMateria1){
	echo $unaMateria->nombre;	
	}
	
}?></h3>

 <?= $form->field($model, 'idMateria2')->dropDownList(
       ArrayHelper::map($unPlan->materias,'idMateria','nombre')) ?>


 <?=$form->field($model, 'tipo')    ->radioList(array('Aprobado'=>'Aprobado','Cursado'=>'Cursado'))
  
   
                                          ->label('Tipo')?>
<?php

$tabla = "<table class='table table-hover'>"
		. " <tr><th>Correlativas</th><th>Tipo</th>";
foreach ($correlativas as $unaCorrelativa){
	$tabla .= "<tr>".
			'<td>'.$unaCorrelativa->idMateria20->nombre.'</td>'.
			'<td>'.$unaCorrelativa->tipo.'</td>'.'<br>'.
		
		'</tr>';
	
}
 
$tabla .= "</table>";
echo $tabla;
?>
     
    





 <?php /* $array=array();
 
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
 echo $tabla;*/
 ?>
    
  
     		
   
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?= Html::a('Salir', ['plan/view', 'id' => $unPlan->idPlan], ['class' => 'btn btn-primary']) ?>
 
    <?php ActiveForm::end(); ?>

</div>
