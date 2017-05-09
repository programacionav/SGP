<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Programa */

$this->title = $model->idPrograma;
$this->params['breadcrumbs'][] = ['label' => 'Programas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idPrograma], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idPrograma], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPrograma',
            'idCursado',
            'orientacion',
            'añoActual',
            'programaAnalitico:ntext',
            'propuestaMetodologica',
            'condicionesAcredEvalu',
            'horariosConsulta',
            'bibliografia',
        ],
    ]) ?>

</div>
