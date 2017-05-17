<?php
use yii\helpers\Html;
 ?>
<div class="col-md-6 "> <h3><?php echo Html::encode($model->numOrd);
?></h3>
 <?php echo Html::encode(['view', 'id'=>$model->id]); 
 ?> <hr></hr> </div>