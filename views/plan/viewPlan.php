<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Materia;
/* @var $this yii\web\View */
/* @var $model app\models\Plan */


//$this->params['breadcrumbs'][] = ['label' => 'Plan', 'url' => ['index']];podemos cambiar por una vista parcial o volver a la de carreras
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-view">
   
       <h1><?= Html::encode('Plan') ?></h1>
    <h1><?= Html::encode($this->title) ?></h1>

    <p> <?php
        $idRolActual=Yii::$app->user->identity->idRol;
        if ($idRolActual === 3) {
        echo Html::a('Modificar Plan', ['update', 'id' => $model->idPlan], ['class' => 'btn btn-primary'])."&nbsp;&nbsp;" ;
       }
          ?>
      <!--    <?= Html::a('Desactivar', ['delete', 'id' => $model->idPlan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        Google font-->
         <?php
        $idRolActual=Yii::$app->user->identity->idRol;
        if ($idRolActual === 3) {
          echo Html::a('Agregar Materia', ['materia/create', 'id' => $model->idPlan], ['class' => 'btn btn-success']);   
        }
        
          ?>
        <?= Html::a('Volver', ['carrera/index'], ['class' => 'btn btn-danger']) ?>
        
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
    $mostrar="";
    if ($idRolActual === 3) {
    $mostrar.="<th>modificar</th>";}
     $tabla = "<table class='table table-hover'>"
		. " <tr><th>Codigo</th><th>Materia</th><th>Anio</th><th>Horas</th><th>Objetivos</th><th>Correlativas</th><th>Departamento</th><th>Area</th><th>Cursado</th>.$mostrar";
     foreach ($model->materias as $unaMateria){?>
     	<?php //$this->render('//materia/_view', [
     			//'model' => $unaMateria,
     	  //  ]) ?>
     	
     	<?php 
     	$corre="";
     	$modificarMateria="";
     	$idRolActual=Yii::$app->user->identity->idRol;
     	if ($idRolActual === 3) {
     		 $corre=Html::a('Agregar Correlativas', ['correlativa/create', 'idPlan' => $model->idPlan,'idMateria' => $unaMateria->idMateria], ['class' => 'btn btn-success'])."&nbsp;&nbsp;";
     		 $modificarMateria=Html::a('Modificar Materia ', ['materia/update','idMateria' => $unaMateria->idMateria,'idPlan' => $model->idPlan], ['class' => 'btn btn-primary']);
     		 
     	}
     	
     	$verCorre=Html::a('Ver Correlativas', ['correlativa/view', 'idMateria' => $unaMateria->idMateria], ['class' => 'btn btn-primary']);
       	$tabla .= "<tr>".
       	'<td>'.$unaMateria->codigo."</td>".
       	'<td>'.$unaMateria->nombre."</td>".
     	'<td>'.$unaMateria->anio."</td>".
     	'<td>'.$unaMateria->hora."</td>".
     	'<td>'.$unaMateria->objetivo."</td>".
     	
     	'<td>'.$corre."<br>".$verCorre.
        
        '</td>'.
        
     	'<td>'.$unaMateria->idDepartamento0->nombre."</td>".
        '<td>'.$unaMateria->area."</td>".
        '<td>'.Html::a(Html::encode('ver'), ['cursado/index', 'CursadoSearch[idMateria]'=>$unaMateria->idMateria], ['class' => 'btn btn-primary']).'<br>'."</td>"
          .'<td>'.$modificarMateria.
        
        '</td>'  		."</tr>";
     	
     } 
     
     $tabla .= "</table>";
     echo $tabla;
     ?>
     
</div>
