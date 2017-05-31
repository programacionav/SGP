<?php

namespace app\controllers;

use Yii;
use app\models\Observacion;
use app\models\ObservacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ObservacionController implements the CRUD actions for Observacion model.
 */
class ObservacionController extends Controller
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
     * Lists all Observacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ObservacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Observacion model.
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
     * Creates a new Observacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        $model = new Observacion();
        $model->idPrograma = $id;
        $model->idEstadoO = 1;
        $model->idUsuario = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idObservacion]);
        } else {
            return $this->render('../programa/view', [
                'modelOb' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Observacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idObservacion]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Observacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Observacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Observacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Observacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAbmobservacion(){
      $postData = Yii::$app->request->post();
      $action = isset($postData['action'])?$postData['action']:null;
      $exito = false;
      $errors = [];
      switch($action){
        case 'insert':
          $observacion = isset($postData['observacion'])?$postData['observacion']:null;
          $idPrograma = isset($postData['idPrograma'])?$postData['idPrograma']:null;
          $idUsuario = Yii::$app->user->identity->id;
          $idEstadoO = 1;
          $model = new Observacion();
          $model->observacion = $observacion;
          $model->idUsuario = $idUsuario;
          $model->idPrograma = $idPrograma;
          $model->idEstadoO = $idEstadoO;
          if($model->save()){
            $exito = true;
          }else{
            $errors[] = 'Ocurrio un error al crear la observación';
          }
          break;
        case 'update':
          break;
        case 'delete';
          break;
      }
      echo json_encode(['success' => $exito,'errors' => $errors]);
    }
}
