<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocenteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Docentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        $idRolActual=Yii::$app->user->identity->idRol;
        if ($idRolActual === 3) {
          echo Html::a('Nuevo docente', ['create'], ['class' => 'btn btn-success']);   
        }
          ?>
    </p>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

           // 'idDocente',
            'cuil',
            'nombre',
            'apellido',
            'mail',
            // 'idDedicacion',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {create} {indexDDC}',
            'buttons' => [
                  'update' => function ($url, $model) {//los datos del docente solo los puede modificar el secretario
                      $idRolActual=Yii::$app->user->identity->idRol;
                                 if($idRolActual === 3){
                                       return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                      $url, ['title' => Yii::t('app', 'lead-update'),]);
                                 }
                               
            },
             'delete' => function ($url, $model) {//los datos del docente solo los puede modificar el secretario
                 $idRolActual=Yii::$app->user->identity->idRol;
                 if($idRolActual === 3){
                          return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'lead-delete'),
                ]);
              }
            },
                'create' => function($url,$model,$key){//HAY QUE MODIFICAR QUE ENVIO DEPENDIENDO SI ES SECRETARIO O JEFE DPTO
                    $idRolActual=Yii::$app->user->identity->idRol;
                    if($idRolActual === 3 || $idRolActual ===2){//momentaneo,solo lo hago para que se muestre
                        return Html::a('<span class="glyphicon glyphicon-plus-sign"></span>',
                                    ['departamento-docente-cargo/create','idDocente'=>$model->idDocente] , [
                                    'title' => Yii::t('app', 'Anexar departamento y cargo'),]);
                    }
                    if($idRolActual===2){
                      //derrollar esto en una tarea distinta
                    }               
                },
                'indexDDC'=> function($url,$model,$key){ //HAY QUE MODIFICAR QUE ENVIO DEPENDIENDO SI ES SECRETARIO O JEFE DPTO
                    $idRolActual=Yii::$app->user->identity->idRol;
                    if($idRolActual === 3 || $idRolActual ===2){//momentaneo
                        return Html::a('<span class="glyphicon glyphicon-share-alt"></span>',
                         ['departamento-docente-cargo/index','idDocente'=>$model->idDocente] ,
                         ['title' => Yii::t('app','Modificar o eliminar departamento y cargo'),]);
                    }    
                    if ($idRolActual===2) {
                         //derrollar esto en una tarea distinta
                    }
                }
            ]
          ]
        ],       
    ]); 
    
    ?>
</div>
