<?php
use yii\helpers\Html;
use app\models\Materia;
/* @var $this yii\web\View */
/* @var $model app\models\Cursado */

$this->title = 'Nuevo Cursado';
$this->params['breadcrumbs'][] = ['label' => 'Cursados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="cursado-create">

    <?php

    echo $this->render('../materia/_view', [
	     'model'=>$modelMateria,

            ]);


        if(yii::$app->user->identity!=null){
            $usuario=yii::$app->user->identity;

            if($usuario->idRol==2){

                  echo  $this->render('_form', [
                'model' => $model,'idMateria'=>Yii::$app->request->get('id'),
            ]) ;


            }else{
                echo "Ud. no tiene permiso para relizar la acción";
            }
        }else{
            echo "Debe loguerse";
        }
        ?>

        </div>
