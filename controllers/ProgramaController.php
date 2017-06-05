<?php

namespace app\controllers;

use Yii;
use app\models\Programa;
use app\models\Observacion;
use app\models\Cambioestado;
use app\models\Rol;

use app\models\ProgramaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;


/**
 * ProgramaController implements the CRUD actions for Programa model.
 */
class ProgramaController extends Controller
{
    /**
     * @inheritdoc
     */
     //YA LO CONFIGURE PARA QUE LOS "AYUDANTES" NO PUEDAN INGRESAR A LAS ACCIONES QUE NO LES CORRESPONDEN
    public function behaviors()
    {
        return [
            'access' => [
 'class' => AccessControl::className(),
 'only' => ['create','update','delete'],
 'rules' => [
 [
 'actions' => ['create','update','delete'],
 'allow' => true,
'roles' => ['@'],
'matchCallback' => function ($rule, $action) {
 $valid_roles = [Programa::acargo];
return Programa::roleInArray($valid_roles);
 }
 ],
 ],
 ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Programa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProgramaSearch();

        if(Rol::findOne(Yii::$app->user->identity->idRol)->esDocente()){
          $dataProvider = $searchModel->searchDocente(Yii::$app->request->queryParams);
        }
        if(Rol::findOne(Yii::$app->user->identity->idRol)->esJefeDpto()){
            $dataProvider = $searchModel->searchJefe(Yii::$app->request->queryParams);
        }

        if(Rol::findOne(Yii::$app->user->identity->idRol)->esSecAcademico()){
            $dataProvider = $searchModel->searchSecAcademico(Yii::$app->request->queryParams);
        }
        /*NOTA todos los roles pueden ver los programas publicados de todas las materias. 
        Ademas todos los roles pueden filtrar por carrera, materia, año, cuatrimestre y cursado para ver programas de cualquier materia y cualquier carrera.*/        
        //$query->joinWith(['cambioestados','idCursado0.idMateria0.idDepartamento0', 'idCursado0.idMateria0.idPlan0.idCarrera0']);

        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Programa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Programa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
         $model = new Programa();
        //$model->idCursado = $_GET['idCursado']; Descomentar esto cuando este listo
        $model->anioActual = date('Y');
        $model->idCursado = 5;

        if(isset(Yii::$app->request->post()['Programa'])){
            if($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->idPrograma]);
            }
            else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => isset($_GET['bLastPrograma']) ? Programa::lastprograma($model->idCursado) : $model,
            ]);
        }
    }


    /**
     * Updates an existing Programa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $destino = null;
        $model = $this->findModel($id);
        if(Yii::$app->user->identity->idRol == 1){
            $destino = 'update';
        }else{
            $destino = 'view';
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPrograma]);
        } else {
            return $this->render($destino, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Programa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->isabierto())
        {
            //boorrar observaciones de programa
            $oObservaciones = Observacion::find()->where(['idPrograma'=>$id])->all();
            foreach($oObservaciones as $obser)
            {
              $obser->delete();
            }


            //borrar estados de programa
            $oCambiosEstados = Cambioestado::find()->where(['idPrograma'=>$id])->all();
            foreach($oCambiosEstados as $est)
            {
              $est->delete();
            }


            //Si el programa se encuentra abierto puede borrarse
            $this->findModel($id)->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Programa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Programa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Programa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


public function actionReport($id) {
    // get your HTML raw content without any layouts or scripts
    $pdf = new Pdf([
        'mode' => Pdf::MODE_BLANK, // leaner size using standard fonts
        'content' => $this->renderPartial('pdf',[
            'model' => $this->findModel($id),
        ]),
        'options' => [
            'title' => 'Programa',
            'subject' => ''
        ],
        'methods' => [
            'SetHeader' => [],
            'SetFooter' => [],
        ]
    ]);
    return $pdf->render();
}

//ES UNA PRUEBA, PERDON SI ALGUIEN LO IBA A HACER, NO ME AGUANTE!
    public function actionCambioestadoob($id){
        $estadoAAsignar = null;
if(Rol::findOne(Yii::$app->user->identity->idRol)->esDocente()){
  $estadoAAsignar = 2;
}else{
  $estadoAAsignar = 3;  

}
         $modelOb = Observacion::findOne($id);
         $modelOb->idEstadoO = $estadoAAsignar;//aca como abajo,tiene que cambiar el idEstado segun el Rol logueado.
        if($modelOb->save(false)){
          return $this->redirect(['view',
        'id' => $modelOb->idPrograma,
    ]);
        }
          
        
    }



  public function actionCambiarestado(){
      if(Rol::findOne(Yii::$app->user->identity->idRol)->esJefeDpto()){
  $estadoPrograma = 2;
}elseif(Rol::findOne(Yii::$app->user->identity->idRol)->esSecAcademico()){
  $estadoPrograma = 3;  

}elseif(Rol::findOne(Yii::$app->user->identity->idRol)->esDocente()){
    $estadoPrograma = 4; 
}
    $exito = false;
    $postData = Yii::$app->request->get();
    $idEstado = $estadoPrograma; //detectar estado dependiendo del rol, cambiame esto man!
    $idPrograma = isset($postData['idPrograma'])?$postData['idPrograma']:null;
    $modelCambioEstado = new Cambioestado();
    $modelCambioEstado->idPrograma = $idPrograma;
    $modelCambioEstado->idUsuario = Yii::$app->user->identity->id; //hardcode
    $modelCambioEstado->fecha = date("Y-m-d");
    $modelCambioEstado->idEstadoP = $idEstado;
    if($modelCambioEstado->save()){
      $exito = true;
    }
    return $this->redirect(['view',
        'id' => $idPrograma,
    ]);
  }

}
