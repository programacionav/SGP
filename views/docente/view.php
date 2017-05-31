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
        <?= Html::a('Modificar', ['update', 'id' => $model->idDocente], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->idDocente], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
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
    <br>
	<big><b>Departamentos: </b></big>
    <br>
	<?php
    $itemDepartamentodocentecargo = ArrayHelper::map(DepartamentoDocenteCargo::find()->all(),
    'idDocente',
    function($model) {
		$itemDepartamento = ArrayHelper::map(Departamento::find()->all(),
		'idDepartamento',
		function($modelDepartamento) {
			//print_r ($modelDepartamento)
			echo "<br>".$modelDepartamento['nombre']."<br>";
		}
		);
    }
    );

	
     ?>
    <br>
	<big><b>Cargos: </b></big>
    <br>
	<?php
    $itemDepartamentodocentecargo = ArrayHelper::map(DepartamentoDocenteCargo::find()->all(),
    'idDocente',
    function($model) {
		$itemDepartamento = ArrayHelper::map(Cargo::find()->all(),
		'idCargo',
		function($modelCargo) {
			echo "<br>".$modelCargo['abreviatura'].' '.$modelCargo['descripcion']."<br>";
		}
		);
    }
    );
     ?>

</div>
