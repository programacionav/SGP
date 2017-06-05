<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CursadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cursados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursado-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cursado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
    		'dataProvider'=>$dataProvider,
    		'itemView'=>'_view',


    ])?>

</div>
