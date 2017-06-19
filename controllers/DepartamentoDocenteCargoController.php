<?php

namespace app\controllers;

use Yii;
use app\models\DepartamentoDocenteCargo;
use app\models\DepartamentoDocenteCargoSearch;
use app\models\Usuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * DepartamentoDocenteCargoController implements the CRUD actions for DepartamentoDocenteCargo model.
 */
class DepartamentoDocenteCargoController extends Controller
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
          'access' => [
			'class' => AccessControl::className(),
			'only' => ['create','update','delete','index','view'],
			'rules' => [
				[
				'actions' => ['create','update','delete','index','view'],
				'allow' => true,
				'roles' => ['@'],
				'matchCallback' => function ($rule, $action) {
					$valid_roles = [Usuario::ROLE_SECRETARIO_ACADEMICO];
					return Usuario::roleInArray($valid_roles);
					//$this->redirect(['cuenta']);
					}  	
				],
					  
			],
				'denyCallback' => function ($rule, $action){
					return $this->redirect(['usuario/cuenta']);
				}  
			],
        ];
    }

    /**
     * Lists all DepartamentoDocenteCargo models.
     * @return mixed
     */
    public function actionIndex($idDocente)
    {
        $searchModel = new DepartamentoDocenteCargoSearch();
       // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search(['DepartamentoDocenteCargoSearch' => ['idDocente'=> $idDocente]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DepartamentoDocenteCargo model.
     * @param integer $idDocente
     * @param integer $idDepartamento
     * @param integer $idCargo
     * @return mixed
     */
    public function actionView($idDocente, $idDepartamento, $idCargo)
    {
        return $this->render('view', [
            'model' => $this->findModel($idDocente, $idDepartamento, $idCargo),
        ]);
    }

    /**
     * Creates a new DepartamentoDocenteCargo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idDocente)
    {
        $model = new DepartamentoDocenteCargo();
        $model->idDocente=$idDocente;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['docente/view', 'id' => $model->idDocente]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DepartamentoDocenteCargo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idDocente
     * @param integer $idDepartamento
     * @param integer $idCargo
     * @return mixed
     */
    public function actionUpdate($idDocente, $idDepartamento, $idCargo)
    {
        $model = $this->findModel($idDocente, $idDepartamento, $idCargo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idDocente' => $model->idDocente, 'idDepartamento' => $model->idDepartamento, 'idCargo' => $model->idCargo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DepartamentoDocenteCargo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idDocente
     * @param integer $idDepartamento
     * @param integer $idCargo
     * @return mixed
     */
    public function actionDelete($idDocente, $idDepartamento, $idCargo)
    {
        $this->findModel($idDocente, $idDepartamento, $idCargo)->delete();

        return $this->redirect(['index', 'idDocente' => $idDocente]);
    }

    /**
     * Finds the DepartamentoDocenteCargo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idDocente
     * @param integer $idDepartamento
     * @param integer $idCargo
     * @return DepartamentoDocenteCargo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idDocente, $idDepartamento, $idCargo)
    {
        if (($model = DepartamentoDocenteCargo::findOne(['idDocente' => $idDocente, 'idDepartamento' => $idDepartamento, 'idCargo' => $idCargo])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
