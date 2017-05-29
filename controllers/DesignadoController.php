<?php

namespace app\controllers;

use Yii;
use app\models\Designado;
use app\models\DesignadoSearch;
use app\models\Departamento;
use app\models\DepartamentoDocenteCargo;
use app\models\Docente;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
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
    public function actionCreate($idCursado)
    {
        $model = new Designado();
        $model_dpto = new Departamento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['cursado/view', 'id' => $model->idCursado]);
        } else {
            return $this->render('create', [
                'model_dpto' => $model_dpto,
                'model' => $model,
                'id_cursado' => $idCursado,
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

        return $this->redirect(['cursado/view','id' => $idCursado]);
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

    public function actionSubcat() {
      /* Esta accion Subcat es para obtener los docentes que pertenecen a un determinado Departamento**/
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $cat_id = $parents[0];
            $out = self::getSubCatList($cat_id);
            // the getSubCatList function will query the database based on the
            // cat_id and return an array like below:
            // [
            //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
            //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
            // ]

            echo Json::encode(['output'=>$out, 'selected'=>'']);
            return;
        }
    }
    echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    private function getSubCatList($idDepartamento){
      /**$itemDptos = Docente::find() //obtengo un arreglo asociativo[index->titulo]
      ->select(['nombre'])  //de noticias donde: lo que esta dentro del option es el titulo
      ->indexBy('idDocente')       // y el value de los option es el id
      ->column();
      $arreglo = false;
      foreach ($itemDptos as $indice => $dpto) {
        $arreglo[]= [$indice =>$dpto];
      }*/
      $dpto = Departamento::find()
      ->where(['idDepartamento' => $idDepartamento])
      ->one();
      //$idsDocentes = $dpto->getidDocentes();
      //$algo = get_class($idsDocentes);
      //print_r($dpto);
      $arreglo= array();
      $iterativo = $dpto->departamentodocentecargos;
      foreach ($iterativo as $depdocar) {
        array_push($arreglo,['id'=>$depdocar->idDocente0->idDocente,'name'=>$depdocar->idDocente0->apellido.', '.$depdocar->idDocente0->nombre]);
      }
      return $arreglo;

    }
}
