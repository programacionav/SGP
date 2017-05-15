<?php

namespace app\controllers;

use Yii;
use app\models\Designado;
use app\models\DesignadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DesignadoController implements the CRUD actions for Designado model.
 */
class DesignadoController extends Controller
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
     * Lists all Designado models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DesignadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Designado model.
     * @param integer $idCursado
     * @param integer $idDocente
     * @return mixed
     */
    public function actionView($idCursado, $idDocente)
    {
        return $this->render('view', [
            'model' => $this->findModel($idCursado, $idDocente),
        ]);
    }

    /**
     * Creates a new Designado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Designado();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idCursado' => $model->idCursado, 'idDocente' => $model->idDocente]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Designado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idCursado
     * @param integer $idDocente
     * @return mixed
     */
    public function actionUpdate($idCursado, $idDocente)
    {
        $model = $this->findModel($idCursado, $idDocente);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idCursado' => $model->idCursado, 'idDocente' => $model->idDocente]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Designado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idCursado
     * @param integer $idDocente
     * @return mixed
     */
    public function actionDelete($idCursado, $idDocente)
    {
        $this->findModel($idCursado, $idDocente)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Designado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idCursado
     * @param integer $idDocente
     * @return Designado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idCursado, $idDocente)
    {
        if (($model = Designado::findOne(['idCursado' => $idCursado, 'idDocente' => $idDocente])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
