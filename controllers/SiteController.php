<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Usuario;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //return $this->render('index');
        return  $this->redirect(['site/login']);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin(){

        $mensaje="";
        if (!Yii::$app->user->isGuest) {
           // echo "Entro por aca"; exit();
            //return  $this->goHome();
            return  $this->redirect(['programa/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $usuario=Usuario::find()->where(['usuario'=> $model->username,'clave'=>$model->password])->one();
            if (isset($usuario)) {
               if ($usuario->estado===1) {
                   if ($model->login()) {
                    return $this->redirect(['programa/index']);
                   }
               }
               else {
                   $mensaje="<span style='color:red'>Esta cuenta se encuentra desactivada</span><br><br>";
               }
            }
            else {
                $mensaje="<span style='color:red'>Datos ingresados incorrectamente</span><br><br>";
                }
        }
        return $this->render('login', [
            'model' => $model,
            'mensaje' => $mensaje
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        //return  $this->redirect(['site/login']);
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
