<?php

namespace app\controllers;

use Yii;
use app\models\CargoDocente;
use app\models\CargoDocenteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CargoDocenteController implements the CRUD actions for CargoDocente model.
 */
class CargoDocenteController extends Controller
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
     * Lists all CargoDocente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CargoDocenteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CargoDocente model.
     * @param integer $idDocente
     * @param integer $idCargo
     * @return mixed
     */
    public function actionView($idDocente, $idCargo)
    {
        return $this->render('view', [
            'model' => $this->findModel($idDocente, $idCargo),
        ]);
    }

    /**
     * Creates a new CargoDocente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CargoDocente();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idDocente' => $model->idDocente, 'idCargo' => $model->idCargo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CargoDocente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idDocente
     * @param integer $idCargo
     * @return mixed
     */
    public function actionUpdate($idDocente, $idCargo)
    {
        $model = $this->findModel($idDocente, $idCargo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idDocente' => $model->idDocente, 'idCargo' => $model->idCargo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CargoDocente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idDocente
     * @param integer $idCargo
     * @return mixed
     */
    public function actionDelete($idDocente, $idCargo)
    {
        $this->findModel($idDocente, $idCargo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CargoDocente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idDocente
     * @param integer $idCargo
     * @return CargoDocente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idDocente, $idCargo)
    {
        if (($model = CargoDocente::findOne(['idDocente' => $idDocente, 'idCargo' => $idCargo])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
