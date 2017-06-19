<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Dedicacion;
use app\models\Docente;
use app\models\Cargo;
use app\models\Departamento;
use app\models\DepartamentoDocenteCargo;

/* @var $this yii\web\View */
/* @var $model app\models\Docente */
/* @var $model app\models\Dedicacion */

$this->title = $model['nombre'].' '.$model['apellido'];
$this->params['breadcrumbs'][] = ['label' => 'Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docente-view">

    <h1><?= Html::encode($model['nombre'].' '.$model['apellido']) ?></h1>

    <p>
	<?php
    $idRolActual=Yii::$app->user->identity->idRol;
    if ($idRolActual === 3) {
		echo Html::a('Modificar', ['update', 'id' => $model->idDocente], ['class' => 'btn btn-primary']);
		echo "	";
        echo Html::a('Borrar', ['delete', 'id' => $model->idDocente], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]); 
	}?>
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cuil',
            'nombre',
            'apellido',
            'mail',
			[
             'attribute' => 'idDedicacion',
             'label' => 'Dedicacion',
             'value'=> function ($model) {
						$itemDedicacion = ArrayHelper::map(Dedicacion::find()->all(),
							'idDedicacion',
							function($model) {
								return $model['descripcion'];
							}
							);
							return $itemDedicacion[$model->idDedicacion];
                      },
			],
        ],
    ])?>
	 
	<div class="col-md-6 ">
    <table id="w0" class="table table-striped table-bordered detail-view">
	<tr><td><h1>Departamentos asignados</h1></td></tr>
	<tr>
	<?php
	foreach ($model->departamentodocentecargos as $valor) {
		if($valor->idDocente==$model->idDocente){
			echo "<td>".$valor->idDepartamento0->nombre."</td></tr><tr>";
		}
	}?>
	</table>
	</div>
	
	<div class="col-md-6 ">
	<table id="w0" class="table table-striped table-bordered detail-view">
	<tr><td colspan="2"><h1>Cargos asignados</h1></td></tr>
	<tr>
	<?php
	foreach ($model->departamentodocentecargos as $valor) {
		if($valor->idDocente==$model->idDocente){
			echo "<td>".$valor->idCargo0->abreviatura."</td>";
			echo "<td>".$valor->idCargo0->descripcion."</td></tr><tr>";
		}
	}?>
	</table>
	</div>

</div>
