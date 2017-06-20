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

            ['class' => 'yii\grid\ActionColumn',
		     'template' => '{view} {update} {desactivarUsuario} {activarUsuario} {cambiarPermisos}',
			 'buttons' => [
				 'cambiarPermisos'=> function($url,$model){
					 $idRolActual=Yii::$app->user->identity->idRol;
					 if ($idRolActual === 3) {
						 if ($model->idRol===1) {
							return Html::a('<span class="glyphicon glyphicon-user"></span>', 
						  ['usuario/cambiar-a-secretario','idUsuario'=>$model->idUsuario], [
                            'title' => Yii::t('app', 'Dar permisos de secretario académico'),
                ]);
						 }
						  
					 }
				 },
				 'desactivarUsuario'=> function ($url, $model) {//los datos del docente solo los puede modificar el secretario
                 $idRolActual=Yii::$app->user->identity->idRol;
                 if($idRolActual === 3){
						if ($model->estado==1) {
                          return Html::a('<span class="glyphicon glyphicon-remove"></span>', 
						  ['usuario/desactivar-usuario','id'=>$model->idUsuario], [
                            'title' => Yii::t('app', 'Desactivar cuenta'),
                ]);
				}
              }
            },
				 'activarUsuario'=> function($url,$model){
					 $idRolActual=Yii::$app->user->identity->idRol;
					 if ($idRolActual === 3) {
						if ($model->estado==0) {
						  return Html::a('<span class="glyphicon glyphicon-ok"></span>',
                                      ['usuario/activar-usuario','id'=>$model->idUsuario],
									   ['title' => Yii::t('app', 'Activar cuenta'),]);
						}
					 }
					 
				 }
			 ],
        ],
	  ]
    ]); ?>
</div>
