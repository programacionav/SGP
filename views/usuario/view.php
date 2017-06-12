<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Docente;
use app\models\Rol;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model['usuario'];
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->idUsuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->idUsuario], [
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
             'value'=> function ($model) {
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
             'attribute' => 'idRol',
             'label' => 'Rol',
             'value'=> function ($model) {
						$itemRol = ArrayHelper::map(Rol::find()->all(),
							'idRol',
							function($model) {
								return $model['descripcion'];
							}
							);
							return $itemRol[$model->idRol];
				},
			],
            'usuario',
            'clave',
        ],
    ]) ?>

</div>
