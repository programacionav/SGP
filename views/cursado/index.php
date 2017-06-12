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

$this->params['breadcrumbs'][] = ['label' => 'Cursado', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



$anioActual=date("Y");//Año actual
$anioCursado=date("Y", strtotime($model->fechaFin));//Año de cursado
$mesCursado=date("m", strtotime($model->fechaFin));
$mesActual = date("m"); // Mes actual
Programa::find(['idCursado'=>$model->idCursado])->one();
//$modelMateria=Materia::find(['idMateria'=>(Yii::$app->request->get('id'))])->one();

$usuario=yii::$app->user->identity;//usuario;
//$usuario=Yii::$app->user->getId();//usuario;



//print_r($model);
echo $this->render('../materia/_view', [
	'model'=>$modelMateria,

]);


if(isset($usuario)){
	$rol=$usuario->idRol;


	?>
	<div class="cursado-index">

		<?php
		if($usuario->idRol==2){
			echo Html::a('Crear Cursado', ['create','idMateria'=>$modelMateria->idMateria], ['class' => 'btn btn-success']);
		}?>
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,

			'columns' => [
				['class' => 'yii\grid\SerialColumn'],

				'idCursado',['attribute'=>'anio',
				'value'=>function ($model){

					return
					date("Y", strtotime($model->fechaInicio));

				}
			],
			['attribute'=>'cuatrimestre',
			'value'=>function ($model){
				if($model->cuatrimestre=='1'){
					return 'primero';
				}else{
					return 'segundo';
				}
			}
		],





		['class' => 'yii\grid\ActionColumn'
		,
		'template' => '{ver}{view}{programa}',

		'buttons' => [

			'ver'=> function ($url, $model, $key) {


				return Html::a('Ver Cursado',['view','id'=>$model->idCursado ],['class'=>'btn btn-primary']);
			},

			'view'=> function ($url, $model, $key) {


				//echo $model->idCursado;
				//select * from designado where idCursado= $model->idCursado AND funcion='funcion' => 'a cargo';
				$docenteACargo = Designado::findOne([
					'idCursado' => $model->idCursado,
					'funcion' => 'acargo',
				]);

				print_r($docenteACargo);
				$usuario=yii::$app->user->identity;
				//si docente y funcion a cargo o es secretario academico muestr boton de ver cursado;
				if($usuario->idRol==1||$usuario->idRol==3){
					return Html::a('Ver Programa',['view','id'=>$model->idCursado ],['class'=>'btn btn-primary']);
				}
			},

			'programa'=> function ($url, $model, $key) {

				$docenteACargo = Designado::findOne([
					'idCursado' => $model->idCursado,
					'funcion' => 'acargo',
				]);
				$usuario=yii::$app->user->identity;
				//si docente y funcion a cargo muestra boton de crear programa;
				//echo $usuario->idDocente0->idDocente;
				$fFin=date("Y",strtotime($model->fechaFin));
				$anioActual=date("Y");
				if($docenteACargo['idDocente'] == $usuario->idDocente0->idDocente /*&& ($fFin >=$anioActual)*/ ){
					return Html::a('Crear Programa',['programa/create','idCursado'=>$model->idCursado ],['class'=>'btn btn-primary']);
				}
			},
			'view'=> function ($url, $model, $key) {

				$programaCursado=Programa::find(['idCursado'=>$model->idCursado])->one();
				//echo count($programaCursado);


				$usuario=yii::$app->user->identity;
				if($usuario->idRol==1||$usuario->idRol==2||$usuario->idRol==3){

					if(count($programaCursado)==1){
						return Html::a('Ver Programa',['programa/view','idCursado'=>$model->idCursado ],['class'=>'btn btn-primary']);
					}
				}
			},

		]
	]
],




]);

}else{echo "Debe loguearse";}?></div>
