<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Docente;
use app\models\Rol;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
	//Html::a('Nuevo usuario', ['create'], ['class' => 'btn btn-success'])?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
