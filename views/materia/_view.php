<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Plan;


?><!-- te genera una vista parcial materias -->
 
  <?php
     $tabla = "<table class='table table-hover'>"
		. " <tr><th>Codigo</th><th>Materia</th><th>Anio</th>";
       	$tabla .= "<tr>".
       	'<td>'.$model->codigo."</td>".
       	'<td>'.$model->nombre."</td>".
     	'<td>'.$model->anio."</td>".
     	
        //'<td>'.$model->idDepartamento0->nombre."</td>".
        
        '<td>'.Html::a(Html::encode('ver mas...'), ['materia/view', 'id'=>$model->idMateria]).'<br>'."</td>"
            		."</tr>";
     	
     
     
     $tabla .= "</table>";
     echo $tabla;
     ?>
    
    
     