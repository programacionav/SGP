<?php

namespace app\controllers;

use Yii;
use app\models\Departamento;
use app\models\DepartamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Usuario;
use app\models\Docente;

/**
 * DepartamentoController implements the CRUD actions for Departamento model.
 */
class DepartamentoController extends Controller
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
     * Lists all Departamento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Departamento model.
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
     * Creates a new Departamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {  
       
        $model = new Departamento();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $usuarioDirector=Usuario::find()->where(['idDocente'=> $model->idDocente])->one();//buscar el usuario asociado al director
            if($usuarioDirector->idRol===2 || $usuarioDirector->idRol===3){ //verificar que el director elegido ya no sea director de otro departamento
                //Estoy en la parte de excepcion por ser director de otro departamento o de ser secretario academico
                return $this->render('create', ['model' => $model,'mensaje'=>'El director elegido no es válido']);//recargar el formulario e indicar que el director elegido no es valido
            }else{
                $usuarioDirector->idRol=2;//cambio rol
                $usuarioDirector->save();//guardo en la base de datos
                $model->save();
                return $this->redirect(['view', 'id' => $model->idDepartamento]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,'mensaje'=>''
            ]);
        }
    }

    /**
     * Updates an existing Departamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {   
        
        $model = $this->findModel($id);
        $directorAnterior=Usuario::find()->where(['idDocente'=>$model->idDocente ])->one();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $usuarioDirector=Usuario::find()->where(['idDocente'=>$model->idDocente ])->one(); //buscar el director nuevo
             if($usuarioDirector->idRol===2 || $usuarioDirector->idRol===3){
                return $this->render('update', ['model' => $model,'mensaje' => 'El director elegido no es valido']);//recargar el formulario e indicar que el director elegido no es valido
            }else{
                $usuarioDirector->idRol=2;
                $directorAnterior->idRol=1;
                $usuarioDirector->save(); //guardar en la base de datos
                $directorAnterior->save();
                $model->save();
                return $this->redirect(['view', 'id' => $model->idDepartamento]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,'mensaje'=>''
            ]);
        }
    }

    /**
     * Deletes an existing Departamento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
*/
    /**
     * Finds the Departamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Departamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Departamento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
