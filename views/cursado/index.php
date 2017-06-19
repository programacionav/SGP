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

/* @var $this yii\web\View */
/* @var $searchModel app\models\CursadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



//echo Yii::$app->controller->action->id;

$this->params['breadcrumbs'][] = ['label' => 'Cursado', 'url' => ['index','CursadoSearch[idMateria]'=>$modelMateria->idMateria]];
$this->params['breadcrumbs'][] = $this->title;
//CursadoSearch[idMateria]='.$modelMateria->idMateria'


$anioActual=date("Y");//Año actual
$anioCursado=date("Y", strtotime($model->fechaFin));//Año de cursado
$mesCursado=date("m", strtotime($model->fechaFin));
$mesActual = date("m"); // Mes actual
$programaCursado=Programa::find(['idCursado'=>$model->idCursado])->one();//obtiene el programa que tenga como idCursado;

//Programa::find(['idCursado'=>$model->idCursado])->one();
//$modelMateria=Materia::find(['idMateria'=>(Yii::$app->request->get('id'))])->one();
$usuario=yii::$app->user->identity;//usuario;
//$usuario=Yii::$app->user->getId();//usuario;



//print_r($model);
echo $this->render('../materia/_view', [
	'model'=>$modelMateria,
]);//vista detallada de materia



if(isset($usuario)){
	$rol=$usuario->idRol;
	?>
	<div class="cursado-index">

		<?php
		if($usuario->idRol==2){//si director de departamento;
			echo Html::a('Crear Cursado', ['create','idMateria'=>$modelMateria->idMateria], ['class' => 'btn btn-success']);
		}?>
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],
				//'idCursado',
				['attribute'=>'idCursado','contentOptions'=>['style'=>'width:15px;'],  'label' => 'N°',  ],
				'fechaInicio',
				'fechaFin',



				'cuatrimestre',

				/*['attribute'=>'anio',
				*'value'=>function ($model){

				*	return
				*	date("Y", strtotime($model->fechaInicio));

				*	}
			],*/






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
					echo $docenteACargo['idDocente'];
					echo $usuario->idDocente0->idDocente;
					echo "-";
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




]);

}?></div>
