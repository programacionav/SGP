<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider ;
use app\models\Materia;

use app\models\Usuario;
use app\models\Rol;

use app\models\Programa;
use app\models\Designado;
use app\models\Cursado;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CursadoSearch */
/* @var $model app\models\Cursado */

/*
 if(isset($_GET['id'])&&$_GET['id']!="")
 {$model->idMateria=$_GET['id'];}*/
$usuario=yii::$app->user->identity;
//print_r($usuario);

$funcionDocente=Designado::find()->where('idDocente'==$usuario->idDocente)->all();

/*echo count($funcionDocente);
foreach($funcionDocente as $docente =>$elem){
	echo $elem['idCursado'].".,.,.,.,.,";
}*/
//print_r($funcionDocente);
$model->idMateria=1;

//$resultado=Cursado::find()->where('idMateria'==$model->idMateria);
if($usuario){
$usuario=yii::$app->user->identity;



$dataProvider = new ActiveDataProvider([
		'query' => $model::find()->where(['idMateria'=>$model->idMateria]),
		'pagination' => [
				'pageSize' => 5,
		],
]);
$mat=Materia::find()->where(['idMateria'=>$model->idMateria])->one();

?>
<div class="cursado-index">


       </p>


    </p>
		<?php
		if($rol == 2 ){
				echo Html::a('Crear Cursado', ['create','idMateria'=>$model->idMateria], ['class' => 'btn btn-success']);
		}
		?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
        				'template' => '{ver}{programa}{view}',

        				'buttons' => [

        						'ver'=> function ($url, $model, $key) {
<<<<<<< HEAD

        						return Html::a('Ver',['view','id'=>$model->idCursado ],['class'=>'btn btn-primary']);
        						},

        						'programa'=> function ($url, $model, $key) {

=======
									//echo $model->idCursado;
		//select * from designado where idCursado= $model->idCursado AND funcion='funcion' => 'a cargo';
						$docenteACargo = Designado::findOne([
    					'idCursado' => $model->idCursado,
    					'funcion' => 'a cargo',
						]);	

									$usuario=yii::$app->user->identity;
//si docente y funcion a cargo o es secretario academico muestr boton de ver cursado;
        						if($usuario->idRol==1||$usuario->idRol==3){
        						return Html::a('Ver',['view','id'=>$model->idCursado ],['class'=>'btn btn-primary']);
								}
								},
        						
        						'programa'=> function ($url, $model, $key) {
									$docenteACargo = Designado::findOne([
    					'idCursado' => $model->idCursado,
    					'funcion' => 'a cargo',
						]);	
        						$usuario=yii::$app->user->identity;
//si docente y funcion a cargo muestra boton de crear programa;
									if($usuario->idRol==1&&$docenteACargo['funcion']=='a cargo'){
>>>>>>> filtros
        						return Html::a('Crear Programa',['programa/create','idCursado'=>$model->idCursado ],['class'=>'btn btn-primary']);
        						}},
        						'view'=> function ($url, $model, $key) {
<<<<<<< HEAD

        						return Html::a('Ver Programa',['programa/view','idCursado'=>$model->idCursado ],['class'=>'btn btn-primary']);
=======
        							$usuario=yii::$app->user->identity;
									if($usuario->idRol==1||$usuario->idRol==2||$usuario->idRol==3){
        						return Html::a('Ver Programa',['programa/view','idCursado'=>$model->idCursado ],['class'=>'btn btn-primary']);}
>>>>>>> filtros
        						},

        						]
        						]
        						],
<<<<<<< HEAD
=======
        		
        		
        
    ]); 
	
	}?>
   
</div>
>>>>>>> filtros



    ]); ?>

</div>
