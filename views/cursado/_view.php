<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider ;
use app\models\Materia;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CursadoSearch */

/* @var $this yii\web\View */
/* @var $model app\models\Cursado */

/*
 if(isset($_GET['id'])&&$_GET['id']!="")
 {$model->idMateria=$_GET['id'];}*/

$model->idMateria=1;
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
    <?= Html::a('Crear Cursado', ['create','idMateria'=>$model->idMateria], ['class' => 'btn btn-success']) ?>
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
        						
        						return Html::a('Ver',['view','id'=>$model->idCursado ],['class'=>'btn btn-primary']);
        						},
        						
        						'programa'=> function ($url, $model, $key) {
        		
        						return Html::a('Crear Programa',['programa/create','idCursado'=>$model->idCursado ],['class'=>'btn btn-primary']);
        						},
        						'view'=> function ($url, $model, $key) {
        						
        						return Html::a('Ver Programa',['programa/view','idCursado'=>$model->idCursado ],['class'=>'btn btn-primary']);
        						},
        						
        						]
        						]
        						],
        		
        		
        
    ]); ?>
   
</div>


