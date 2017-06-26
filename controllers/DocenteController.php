<?php

namespace app\controllers;

use Yii;
use app\models\Docente;
use app\models\DocenteSearch;
use app\models\Usuario;
use app\models\Cargo;
use app\models\Departamento;
use app\models\DepartamentoDocenteCargo;
use app\models\Rol;
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
					'denyCallback' => function ($rule, $action){
						return $this->redirect(['usuario/cuenta']);
					}
            ],[
                'class' => AccessControl::className(),
                'only' => ['docdepto'],
                'rules' => [
                [
                'actions' => ['docdepto'],
                'allow' => true,
                'roles' => ['@'],
                'matchCallback' => function ($rule, $action) {
                    $valid_roles = [Usuario::ROLE_JEFE_DEPARTAMENTO];
                    return Usuario::roleInArray($valid_roles);
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

   public function actionDocdepto()
    {
        $searchModel = new DocenteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(Rol::findOne(Yii::$app->user->identity->idRol)->esJefeDpto()){
            $dataProvider = $searchModel->searchJefe(Yii::$app->request->queryParams);
        }
        return $this->render('docdepto', [
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
       
        if ($model->load(Yii::$app->request->post())  &&  $model->validate()) { //Compruebo si cargué por post y si se pudo guardar el docente
            $busquedaDocente=Docente::find()->where(['cuil'=>$model->cuil])->all();
            if(count($busquedaDocente)===0){
                $model->save();
                $modelUsuario->idDocente = $model->idDocente;
                $modelUsuario->idRol=1;//rol docente por defecto
                $modelUsuario->usuario = $model->cuil;
                $modelUsuario->clave = md5($model->cuil);
                $modelUsuario->estado=0;
               $modelUsuario->save();
               
                return $this->redirect(['view', 'id' => $model->idDocente]);
                 
            }else{
                  return $this->render('create', [
                'model' => $model,
                'modelUsuario' => $modelUsuario,
                'mensaje'=>'Este cuil ya se encuentra registrado' 
                ]);
             }
            
        }
        
        /**if ($modelUsuario->load(Yii::$app->request->post()) && $modelUsuario->save())
        { //Compruebo si se pudo cargar por post y guardar el usuario del Docente
				    return $this->redirect(['view', 'id' => $model->idDocente]);
			  }**/
        else
        {
            return $this->render('create', [
                'model' => $model,
                'modelUsuario' => $modelUsuario,
                'mensaje' => ''
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
        //Error de Usuario, en caso de que no exista
        if(!Usuario::find()->where(['idDocente'=>$id])->one()){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    $modelUsuario->idDocente = $model->idDocente;
                    $modelUsuario->idRol=1;//rol docente por defecto
                    $modelUsuario->usuario = $model->cuil;
                    $modelUsuario->clave = md5($model->cuil);
                    $modelUsuario->estado=0;
                    $modelUsuario->save();
                return $this->redirect(['view', 'id' => $model->idDocente]);
            } else {
                return $this->render('update', [
                    'model' => $model,'mensaje'=>'Advertencia: El docente no tiene usuario registrado<br>Será creado uno por defecto automaticamente al modificar el formulario'
                ]);
            }        
        }//Fin error de Usuario 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            	return $this->redirect(['view', 'id' => $model->idDocente]);
        } else {
            return $this->render('update', [
                'model' => $model, 'mensaje' => ""                
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
