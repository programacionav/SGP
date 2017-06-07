<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Materia;
/* @var $this yii\web\View */
/* @var $model app\models\Plan */


$this->params['breadcrumbs'][] = ['label' => 'Plan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-view">
  
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
   <!--      <?= Html::a('Modificar', ['update', 'id' => $model->idPlan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->idPlan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        Google font-->
        <?= Html::a('Agregar Materia', ['materia/create', 'id' => $model->idPlan], ['class' => 'btn btn-primary']) ?>
        
    </p>

   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idPlan',
            'numOrd',
        		//'idCarrera',
        		[ 'attribute'=> 'idCarrera0.nombre',
        		'label'=>'Carrera',],
        		
        		
        		
        		
        ],
    		 
    		
    ]) ?>  
    <?php
     $tabla = "<table class='table table-hover'>"
		. " <tr><th>Codigo</th><th>Materia</th><th>Anio</th><th>Horas</th><th>Objetivos</th><th>Contenidos</th><th>Correlativas</th><th>Departamento</th><th>Area</th><th>Cursado</th>";
     foreach ($model->materias as $unaMateria){?>
     	<?php //$this->render('//materia/_view', [
     			//'model' => $unaMateria,
     	  //  ]) ?>
     	
     	<?php $tabla .= "<tr>".
       	'<td>'.$unaMateria->codigo."</td>".
       	'<td>'.$unaMateria->nombre."</td>".
     	'<td>'.$unaMateria->anio."</td>".
     	'<td>'.$unaMateria->hora."</td>".
     	'<td>'.$unaMateria->objetivo."</td>".
     	'<td>'.$unaMateria->contenidoMinimo."</td>".
     	'<td>'.Html::a('Agregar Correlativas', ['correlativa/create', 'idPlan' => $model->idPlan,'idMateria' => $unaMateria->idMateria], ['class' => 'btn btn-primary'])."</td>".
     	'<td>'.$unaMateria->idDepartamento0->nombre."</td>".
        '<td>'.$unaMateria->area."</td>".
        '<td>'.Html::a(Html::encode('ver'), ['cursado/index', 'CursadoSearch[idMateria]'=>$unaMateria->idMateria], ['class' => 'btn btn-primary']).'<br>'."</td>"
            		."</tr>";
     	
     } 
     
     $tabla .= "</table>";
     echo $tabla;
     ?>
     
</div>
