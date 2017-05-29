<?php

use yii\helpers\Html;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CursadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="cursado-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_view', [
        'model' => $model,
    ]) ?>
</div>
