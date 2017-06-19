<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Plan;


?><!-- te genera una vista parcial materias -->
   <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"> 
 <?= Html::encode($model['nombre']) ?>
  </div>
  <div class="panel-body">
    <p>
  <?php
     $tabla = "<table class='table table-hover'>"
		. " <tr><th>Codigo</th><th>Departamento</th><th>Anio</th><th></th>";
       	$tabla .= "<tr>".
       	'<td>'.$model->codigo."</td>".
       	'<td>'.$model->idDepartamento0->nombre."</td>".
     	'<td>'.$model->anio."</td>".
     	
        //'<td>'.$model->idDepartamento0->nombre."</td>".
        
        '<td>'.Html::a(Html::encode('ver mas...'), ['materia/view', 'id'=>$model->idMateria]).'<br>'."</td>"
            		."</tr>";
     	
     
     
     $tabla .= "</table>";
     echo $tabla;
     ?>
    
    </p>
  </div>
 </div>
 
 
     