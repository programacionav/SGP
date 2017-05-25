<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Cambioestado;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ProgramaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Programas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Nro Cursado',
                'attribute' => 'idCursado',
                'value' => function ($data){
                    return $data->idCursado;
                }
            ],
            'anioActual',
            [
                'label' => 'Materia',
                'attribute' => 'idMateria',
                'value' => function ($data){
                    return $data->idCursado0->idMateria0->nombre;
                }
            ],
            [
                'label' => 'Cuatrimestre',
                'attribute' => 'cuatrimestre',
                'value' => function ($data){
                    return $data->idCursado0->cuatrimestre;
                }
            ],
            [
                'label' => 'Estado',
                'attribute' => 'idEstadoP',
                'value' => function ($data){
                    return Cambioestado::find()->where(['idCambioEstado'=> Cambioestado::find()->where(['idPrograma'=> $data->idPrograma])->max('idCambioEstado')])->one()->idEstadoP0->descripcion ;
                }
            ],
            
            //'programaAnalitico:ntext',
            // 'propuestaMetodologica',
            // 'condicionesAcredEvalu',
            // 'horariosConsulta',
            // 'bibliografia',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
