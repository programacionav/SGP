<?php

use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use app\models\Materia;
use app\models\CursadoSearch;
use yii\grid\GridView;
use app\models\Usuario;
use app\models\Rol;
use app\models\Designado;
use app\models\Programa;
 
?>


<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,

			'columns' => [
				
				//'idCursado',
				['attribute'=>'idCursado','contentOptions'=>['style'=>'width:15px;'],  'label' => 'N°',  ],
				'fechaInicio',
				'fechaFin',
				'cuatrimestre',

				['attribute'=>'Materia',
				'value'=>function ($model){
						
					return $model->idMateria0->nombre;
					
				}
				
			],

			['class' => 'yii\grid\ActionColumn'
			,
			'contentOptions'=>['style'=>'width:250px;height:80px;'],
			'template' => '{ver}{view}{programa}',

			'buttons' => [
				'ver'=> function ($url, $model, $key) {
					return Html::a('Ver Cursado',['view','id'=>$model->idCursado ],['class'=>'btn btn-primary']);
				},

				'programa'=> function ($url, $model, $key) {

					$docenteACargo = Designado::findOne([
						'idCursado' => $model->idCursado,
						'funcion' => 'acargo',
					]);
					$usuario=yii::$app->user->identity;
					//si docente y funcion a cargo muestra boton de crear programa;
					//echo $usuario->idDocente0->idDocente;
					$programaCursado=Programa::findOne(['idCursado'=>$model->idCursado]);
					// echo $docenteACargo['idDocente'];
					// echo $usuario->idDocente0->idDocente;
					// echo "-";
					$fFin=date("Y",strtotime($model->fechaFin));
					$anioActual=date("Y");
					if($docenteACargo['idDocente'] == $usuario->idDocente0->idDocente && count($programaCursado)!=1/*&& ($fFin >=$anioActual)*/  ){
						return Html::a('Crear Programa',['programa/create','idCursado'=>$model->idCursado ],['class'=>'btn btn-primary']);
					}
				},
				'view'=> function ($url, $model, $key) {

					$programaCursado=Programa::findOne(['idCursado'=>$model->idCursado]);
					//echo count($programaCursado);

					$usuario=yii::$app->user->identity;
					if($usuario->idRol==1||$usuario->idRol==2||$usuario->idRol==3){
						if(count($programaCursado)==1){
							return Html::a('Ver Programa',['programa/view','id'=>$programaCursado->idPrograma ],['class'=>'btn btn-primary']);
						}
					}
				},

			]
		]
	],




]);?>

