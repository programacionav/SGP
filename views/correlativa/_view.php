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

 
 <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"> <?php
 
echo $Materia->nombre;
 //echo $correlativas[0]->idMateria10->nombre;
 ?>
  </div>
  <div class="panel-body">
    <p><?php $tabla = "<table class='table table-hover'>"
		. " <tr><th>Correlativas</th><th>Tipo</th>";
 
foreach ($correlativas as $unaCorrelativa){
	$modificarCorre=Html::a('Modificar', ['correlativa/update','idMateria1' => $unaCorrelativa->idMateria1,'idMateria2' => $unaCorrelativa->idMateria2,'idPlan' => $Materia->idPlan], ['class' => 'btn btn-primary']);
	$borrarCorre= Html::a('Desactivar', ['delete'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
	$tabla .= "<tr>".
			'<td>'.$unaCorrelativa->idMateria20->nombre.'</td>'.
			'<td>'.$unaCorrelativa->tipo.'</td>'.'<td>'.$modificarCorre.'</td>'.'<br>'.'<td>'.$borrarCorre.'</td>'
		
		.'</tr>';
	
}
 
$tabla .= "</table>";
echo $tabla;
?></p>
  </div>
 </div>
 </div>
 
 
 