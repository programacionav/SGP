<?php

namespace app\controllers;

use Yii;
use app\models\Docente;
use app\models\DocenteSearch;
use app\models\Usuario;
use app\models\Cargo;
use app\models\Departamento;
use app\models\DepartamentoDocenteCargo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * DocenteController implements the CRUD actions for Docente model.
 */
class DocenteController extends Controller
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
'only' => ['create','update','delete'],
'rules' => [
[
'actions' => ['create','update','delete'],
'allow' => true,
'roles' => ['@'],
'matchCallback' => function ($rule, $action) {
$valid_roles = [Usuario::ROLE_SECRETARIO_ACADEMICO];
return Usuario::roleInArray($valid_roles);
}
],
],
],
        ];
    }

    /**
     * Lists all Docente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocenteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Docente model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $modelCargo = new Cargo();
        $modelDepartamento = new Departamento();
        $modelDepartamentoDocenteCargo = new DepartamentoDocenteCargo();
        return $this->render('view', [
            'model' => $this->findModel($id),
                'modelCargo' => $modelCargo,
                'modelDepartamento' => $modelDepartamento,
                'modelDepartamentoDocenteCargo' => $modelDepartamentoDocenteCargo,
        ]);
    }

    /**
     * Creates a new Docente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Docente();
        $modelUsuario = new Usuario();

        if ($model->load(Yii::$app->request->post()) &&  $model->save()) { //Compruebo si cargué por post y si se pudo guardar el docente
            $modelUsuario->idDocente = $model->idDocente;
            //$modelUsuario->idRol "El idRol de Usuario lo carga por post del select correspondiente"
            $modelUsuario->usuario = $model->cuil;
            $modelUsuario->clave = $model->cuil;
        }if ($modelUsuario->load(Yii::$app->request->post()) && $modelUsuario->save())
        { //Compruebo si se pudo cargar por post y guardar el usuario del Docente
				    return $this->redirect(['view', 'id' => $model->idDocente]);
			  }else
        {
            return $this->render('create', [
                'model' => $model,
                'modelUsuario' => $modelUsuario,
            ]);
        }
    }

    /**
     * Updates an existing Docente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelUsuario = new Usuario();
        $modelCargo = new Cargo();
        $modelDepartamento = new Departamento();
        $modelDepartamentoDocenteCargo = new DepartamentoDocenteCargo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        }if ($modelUsuario->load(Yii::$app->request->post()) && $modelUsuario->save()){
            if ($modelDepartamentoDocenteCargo->load(Yii::$app->request->post()) && $modelDepartamentoDocenteCargo->save()){
            	return $this->redirect(['view', 'id' => $model->idDocente]);
        }} else {
            return $this->render('update', [
                'model' => $model,
                'modelUsuario' => $modelUsuario,
                'modelCargo' => $modelCargo,
                'modelDepartamento' => $modelDepartamento,
                'modelDepartamentoDocenteCargo' => $modelDepartamentoDocenteCargo,
            ]);
        }
    }

    /**
     * Deletes an existing Docente model.
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
     * Finds the Docente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Docente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Docente::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
