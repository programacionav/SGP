<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Carrera;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarreraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carreras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carrera-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nueva Carrera', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Nuevo Plan', ['plan/create'], ['class' => 'btn btn-success']) ?>
    </p>
     <?php
     
     $tabla = "<table class='table table-hover'>"
		. " <tr><th>Carreras</th>". " <th>Plan</th>";
     foreach ($model as $unaCarrera){
     	$tabla .= "<tr>".
     	'<td>'.$unaCarrera->nombre."</td>
		<td>";foreach ($unaCarrera->plans as $unPlan){
		$tabla.= Html::a(Html::encode($unPlan->numOrd), ['plan/view', 'id'=>$unPlan->idPlan]).'<br>';
     	}
		"</td>"."</tr>";
     	
     } 
     
     $tabla .= "</table>";
     echo $tabla;
     ?>
   
</div>
