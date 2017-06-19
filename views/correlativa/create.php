<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Correlativa */

$this->title = 'Correlativas';
//$this->params['breadcrumbs'][] = ['label' => 'Correlativas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="correlativa-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <h3><?php 

foreach ($unPlan->materias as $unaMateria)
{
	if($unaMateria->idMateria == $model->idMateria1){
	echo $unaMateria->nombre;	
	}
	
}?></h3>

    <?= $this->render('_form', [
        'model' => $model,'unPlan' =>$unPlan,'correlativas'=>$correlativas
    ]) ?>

</div>
