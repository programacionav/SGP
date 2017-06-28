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
use app\models\Departamento;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CursadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Cursado', 'url' => ['index','CursadoSearch[idMateria]'=>$modelMateria->idMateria]];
$this->params['breadcrumbs'][] = $this->title;
//CursadoSearch[idMateria]='.$modelMateria->idMateria'

$usuario=yii::$app->user->identity;//usuario;
//$usuario=Yii::$app->user->getId();//usuario;

echo Html::a(Html::encode('Volver'), ['plan/view', 'id'=>$modelMateria->idPlan], ['class' => 'btn btn-default']);
echo "<br />";
echo "<br />";



echo $this->render('../materia/_view', [
	'model'=>$modelMateria,
]);//vista detallada de materia



if(isset($usuario)){
	$rol=$usuario->idRol;
	?>
	<div class="cursado-index">

		<?php
		$usuario=yii::$app->user->identity;//usuario;
	  $docenteDeUsuario = $usuario->idDocente0;
	  $departamentoDeDocente = Departamento::findOne([
	    'idDocente' =>$docenteDeUsuario->idDocente
	  ]);
		$departamentoDeMateria = $modelMateria->idDepartamento0;
		//echo "idDepDocUsuario: ".$departamentoDeDocente->idDepartamento;
		//	echo "idDepMateria: ".$departamentoDeMateria->idDepartamento;
		if($usuario->idRol==2 && $departamentoDeMateria->idDepartamento==$departamentoDeDocente->idDepartamento){//si director de departamento;
			echo Html::a('Crear Cursado', ['create','idMateria'=>$modelMateria->idMateria], ['class' => 'btn btn-success']);
		}?>
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,

			'columns' => [


				['attribute'=>'idCursado','contentOptions'=>['style'=>'width:15px;'],  'label' => 'N°',  ],
				'fechaInicio' ,
				'fechaFin',
				'cuatrimestre',



			['class' => 'yii\grid\ActionColumn'
			,
			'contentOptions'=>['style'=>'width:250px;height:80px;'],
			'template' => '{ver}    {view}   {programa}',

			'buttons' => [
				'ver'=> function ($url, $model, $key) {
					return Html::a('Ver Cursado',['view','id'=>$model->idCursado ],['class'=>'btn btn-info']);
				},

				'programa'=> function ($url, $model, $key) {

					$docenteACargo = Designado::findOne([
						'idCursado' => $model->idCursado,
						'funcion' => 'acargo',
					]);

					$usuario=yii::$app->user->identity;
					//si docente y funcion a cargo muestra boton de crear programa;

					$programaCursado=Programa::findOne(['idCursado'=>$model->idCursado]);


					if(($docenteACargo['idDocente'] == $usuario->idDocente0->idDocente) && (count($programaCursado)!=1)){
						return Html::a('Crear Programa',['programa/create','idCursado'=>$model->idCursado ],['class'=>'btn btn-success']);
					}
				},
				'view'=> function ($url, $model, $key) {

					$programaCursado=Programa::findOne(['idCursado'=>$model->idCursado]);
					//echo count($programaCursado);

					$usuario=yii::$app->user->identity;
					if($usuario->idRol==1){
						//echo $programaCursado->publicado()?"1":"0";
						if(count($programaCursado)==1 && ($programaCursado->publicado())){ //Docente común si esta publicado
							return Html::a('Ver Programa',['programa/view','id'=>$programaCursado->idPrograma ],['class'=>'btn btn-primary']);
						}
					}

				},

			]
		]
	],




]);

}

?>
</div>
