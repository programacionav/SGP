<?php
use yii\helpers\Html;
$usuario=yii::$app->user->identity;//usuario;

$designados = $model->designados;
//print_r($designados);
if(count($designados) != 0){
    echo "<table class='table'>";
    echo "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Apellido</th>";
    echo "<th>Mail</th>";
    echo "<th>Cargo</th>";
    echo "<th>Acciones</th>";
    foreach ($designados as $designacion) {
    echo "<tr>";
    echo "<td>".$designacion->idDocente0->nombre."</td>";
    echo "<td>".$designacion->idDocente0->apellido."</td>";
    echo "<td>".$designacion->idDocente0->mail."</td>";
    echo "<td>".(($designacion->funcion == 'acargo')? "A cargo":"Ayudante")."</td>";
    echo "<td>";
    echo Html::a('Ver',['docente/view','id'=>$designacion->idDocente0->idDocente],['class' =>'btn btn-primary']);
    if(isset($usuario) && $usuario->idRol==2){
    echo Html::a('Desasignar', ['designado/delete', 'idCursado' => $designacion->idCursado0->idCursado, 'idDocente' => $designacion->idDocente0->idDocente], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Esta seguro que quiere desasignar al docente?',
            'method' => 'post',
        ],
    ]);
  }
    echo "</td>";
    //$salida.="<td>".$designacion->idDocente0-."</td>";
    echo "</tr>";
    }
    echo "</table>";
}

 ?>
