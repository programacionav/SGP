<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Facultad;
use app\models\Docente;

/* @var $this yii\web\View */
/* @var $model app\models\Departamento */

$this->title ='Departamento de '. $model['nombre'];
$this->params['breadcrumbs'][] = ['label' => 'Departamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-view">

    <h1>Departamento de <?= Html::encode($model['nombre']) ?></h1>

    <p>
	<?php
    $idRolActual=Yii::$app->user->identity->idRol;
    if ($idRolActual === 3) {
		echo Html::a('Modificar', ['update', 'id' => $model->idDepartamento], ['class' => 'btn btn-primary']);
		echo "	";
        echo Html::a('Borrar', ['delete', 'id' => $model->idDepartamento], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de borrar este Departamento?',
                'method' => 'post',
            ],
        ]);
	} ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            [
             'attribute' => 'idDocente',
             'label' => 'Director de Departamento',
             'value'=> function ($model) {
						$itemDocente = ArrayHelper::map(Docente::find()->all(),
							'idDocente',
							function($model) {
								return $model['nombre'];
							}
							);
							return $itemDocente[$model->idDocente];
                      },
			],
			[
             'attribute' => 'idFacultad',
             'label' => 'Facultad',
             'value'=> function ($model) {
						$item = ArrayHelper::map(Facultad::find()->all(),
							'idFacultad',
							function($model) {
								return $model['nombre'];
							}
							);
							return $item[$model->idFacultad];
                      },
			],
        ],
    ]) ?>

</div>
