<?php

namespace app\controllers;

use Yii;
use app\models\Correlativa;
use app\models\CorrelativaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Materia;
use app\models\Plan;

/**
 * CorrelativaController implements the CRUD actions for Correlativa model.
 */
class CorrelativaController extends Controller
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
     * Lists all Correlativa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CorrelativaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Correlativa model.
     * @param integer $idMateria1
     * @param integer $idMateria2
     * @return mixed
     */
    public function actionView($idMateria1, $idMateria2)
    {
        return $this->render('view', [
            'model' => $this->findModel($idMateria1, $idMateria2),
        ]);
    }

    /**
     * Creates a new Correlativa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idPlan,$idMateria)
    {
    	
    	$unPlan=Plan::findOne(['idPlan' => $idPlan]);
    	
        $model = new Correlativa();
        $model->idMateria1=$idMateria;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['materia/create', 'idMateria1' => $model->idMateria1, 'idMateria2' => $model->idMateria2]);
        } else {
        	
            return $this->render('create', [
            	
                'model' => $model,'unPlan' =>$unPlan
            		
            ]);
        }
    }

    /**
     * Updates an existing Correlativa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idMateria1
     * @param integer $idMateria2
     * @return mixed
     */
    public function actionUpdate($idMateria1, $idMateria2)
    {
        $model = $this->findModel($idMateria1, $idMateria2);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idMateria1' => $model->idMateria1, 'idMateria2' => $model->idMateria2]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Correlativa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idMateria1
     * @param integer $idMateria2
     * @return mixed
     */
    public function actionDelete($idMateria1, $idMateria2)
    {
        $this->findModel($idMateria1, $idMateria2)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Correlativa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idMateria1
     * @param integer $idMateria2
     * @return Correlativa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idMateria1, $idMateria2)
    {
        if (($model = Correlativa::findOne(['idMateria1' => $idMateria1, 'idMateria2' => $idMateria2])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
