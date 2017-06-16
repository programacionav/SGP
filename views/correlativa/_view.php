<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Materia;
use app\models\Plan;
use app\models\Correlativa;
use yii\base\Object;



?>

<div class="correlativa-form">

    <?php $form = ActiveForm::begin(); ?>

 
 
 <?php

 foreach ($unPlan->materias as $unaMateria)
 {
 	if($unaMateria->idMateria == $model->idMateria1){
 		echo $unaMateria->nombre;
 	}
 }

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
 
<?php 

	
?><br>

</div>