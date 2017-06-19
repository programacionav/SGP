<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Materia */

//$this->title = $model->idMateria;
//$this->params['breadcrumbs'][] = ['label' => 'Materias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materia-view">
 <h1><?= Html::encode($model['nombre']) ?></h1>
    <h1><?= Html::encode($this->title) ?></h1>

    <p> <?php
        $idRolActual=Yii::$app->user->identity->idRol;
        if ($idRolActual === 3) {
          echo Html::a('Salir', ['plan/view', 'id' => $model->idPlan0->idPlan], ['class' => 'btn btn-danger'])."&nbsp;&nbsp;";
/*   echo Html::a('Eliminar', ['delete', 'id' => $model->idMateria], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro que desea desactivar la materia?',
                'method' => 'post',
            ],
        ]);*/
        }
          ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'nombre',
            'anio',
            'hora',
            'objetivo',
            'contenidoMinimo',
        		//[ 'attribute'=> 'correlativas',
        		//'label'=>'Correlativa',],
        		
            //'idMateria',
            //'idDepartamento',
        		[ 'attribute'=> 'idDepartamento0.nombre',
        		'label'=>'Departamento'],
            'idPlan',
        ],
    ]) ?>

</div>
