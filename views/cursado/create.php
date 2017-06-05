<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Cursado */

$this->title = 'Nuevo Cursado';
$this->params['breadcrumbs'][] = ['label' => 'Cursados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

 echo $this->render('vistaMateria', [
         'model' => $model,//'idMateria'=>$model->idMateria
         'idMateria'=>$idMateria
    ]) ;
?>
<div class="cursado-create">

    <?php

        if(yii::$app->user->identity!=null){
            $usuario=yii::$app->user->identity;

            if($usuario->idRol==2){
               
                  echo  $this->render('_form', [
                'model' => $model,'idMateria'=>$idMateria
            ]) ;


            }else{
                echo "Ud. no tiene permiso para relizar la acción";
            }
        }else{
            echo "Debe loguerse";
        }
        ?>

        </div>
