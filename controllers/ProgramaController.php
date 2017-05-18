<?php

namespace app\controllers;

use Yii;
use app\models\Programa;
use app\models\ProgramaSearch;
use app\models\Cambioestado;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;


/**
 * ProgramaController implements the CRUD actions for Programa model.
 */
class ProgramaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        $exito = false;
        $queryParams = Yii::$app->request->queryParams;
        $idCursado = isset($queryParams['idCursado'])?$queryParams['idCursado']:3;//hardcode
        if(isset($queryParams['bLastPrograma'])){
          $model = Programa::lastprograma($idCursado);
          $model->idPrograma = null;
          $model->isNewRecord = true;
        }else{
          $model = new Programa();
          $model->idCursado = $idCursado;
        }
        $model->anioActual = date('Y');
        $postData = Yii::$app->request->post();
        if(count($postData) > 0){
          try{
            $transaction = Yii::$app->db->beginTransaction();
            if($model->load($postData) && $model->save()){
              $modelCambioEstado = new Cambioestado();
              $modelCambioEstado->idPrograma = $model->idPrograma;
              $modelCambioEstado->idUsuario = 1; //hardcode
              $modelCambioEstado->fecha = date("Y-m-d");
              $modelCambioEstado->idEstadoP = 1;//hardcode
              if($modelCambioEstado->save()){
                $exito = true;
                $transaction->commit();
              }else{
                throw new \Exception("Error al loguear el cambio de estado");
              }
            }else{
              throw new \Exception("Error al guardar el programa");
            }
          }catch(Exception $e){
            $transaction->rollBack();
          }
        }
        if($exito){
          return $this->redirect(['view', 'id' => $model->idPrograma]);
        }else{
          return $this->render('create', [
              'model' => $model,
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPrograma]);
        } else {
            return $this->render('update', [
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

  public function actionCambiarestado(){
    $exito = false;
    $postData = Yii::$app->request->get();
    $idEstado = isset($postData['idEstado'])?$postData['idEstado']:null;
    $idPrograma = isset($postData['idPrograma'])?$postData['idPrograma']:null;
    $modelCambioEstado = new Cambioestado();
    $modelCambioEstado->idPrograma = $idPrograma;
    $modelCambioEstado->idUsuario = 1; //hardcode
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
