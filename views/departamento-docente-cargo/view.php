<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Docente;
use app\models\Departamento;
use app\models\Cargo;

/* @var $this yii\web\View */
/* @var $model app\models\DepartamentoDocenteCargo */
$itemDocente = ArrayHelper::map(Docente::find()->all(),
'idDocente',
function($model) {
    return $model['nombre'].' '.$model['apellido'];
}
);

$this->title = $itemDocente[$model->idDocente];
$this->params['breadcrumbs'][] = ['label' => 'Docentes', 'url' => ['docente/index']];
$this->params['breadcrumbs'][] = ['label' => 'Administrar departamento y cargo', 'url' => ['index', 'idDocente' => $model->idDocente]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-docente-cargo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'idDocente' => $model->idDocente, 'idDepartamento' => $model->idDepartamento, 'idCargo' => $model->idCargo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'idDocente' => $model->idDocente, 'idDepartamento' => $model->idDepartamento, 'idCargo' => $model->idCargo], [
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
			[
               'attribute' => 'idDocente',
               'label' => 'Docente',
               'value' => function ($model) {
						$itemDocente = ArrayHelper::map(Docente::find()->all(),
							'idDocente',
							function($model) {
								return $model['nombre'].' '.$model['apellido'];
							}
							);
							return $itemDocente[$model->idDocente];
                      },
               ],
			[
               'attribute' => 'idDepartamento',
               'label' => 'Departamento',
               'value' => function ($model) {
						$itemDepartamento = ArrayHelper::map(Departamento::find()->all(),
							'idDocente',
							function($model) {
								return $model['nombre'];
							}
							);
							return $itemDepartamento[$model->idDepartamento];
                      },
               ],
			[
               'attribute' => 'idCargo',
               'label' => 'Cargo',
               'value' => function ($model) {
						$itemCargo = ArrayHelper::map(Cargo::find()->all(),
							'idCargo',
							function($model) {
								return $model['descripcion'];
							}
							);
							return $itemCargo[$model->idCargo];
                      },
               ],
        ],
    ]) ?>

</div>
