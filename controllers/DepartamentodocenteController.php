<?php

namespace app\controllers;

use Yii;
use app\models\Departamentodocente;
use app\models\DepartamentodocenteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DepartamentodocenteController implements the CRUD actions for Departamentodocente model.
 */
class DepartamentodocenteController extends Controller
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
     * Lists all Departamentodocente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartamentodocenteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Departamentodocente model.
     * @param integer $idDocente
     * @param integer $idDepartamento
     * @return mixed
     */
    public function actionView($idDocente, $idDepartamento)
    {
        return $this->render('view', [
            'model' => $this->findModel($idDocente, $idDepartamento),
        ]);
    }

    /**
     * Creates a new Departamentodocente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Departamentodocente();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idDocente' => $model->idDocente, 'idDepartamento' => $model->idDepartamento]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Departamentodocente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idDocente
     * @param integer $idDepartamento
     * @return mixed
     */
    public function actionUpdate($idDocente, $idDepartamento)
    {
        $model = $this->findModel($idDocente, $idDepartamento);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idDocente' => $model->idDocente, 'idDepartamento' => $model->idDepartamento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Departamentodocente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idDocente
     * @param integer $idDepartamento
     * @return mixed
     */
    public function actionDelete($idDocente, $idDepartamento)
    {
        $this->findModel($idDocente, $idDepartamento)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Departamentodocente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idDocente
     * @param integer $idDepartamento
     * @return Departamentodocente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idDocente, $idDepartamento)
    {
        if (($model = Departamentodocente::findOne(['idDocente' => $idDocente, 'idDepartamento' => $idDepartamento])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
