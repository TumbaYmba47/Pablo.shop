<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\Order;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;

class AdminController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'logout' => ['post', 'get'],
                ],
            ],
            ]
        );
    }


    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $dataProvider = new ActiveDataProvider([
                'query' => Order::find(),

            ]);
            $this->layout = 'AdminMain';
            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->goHome();
        }
    }

    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout = 'AdminMain';
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            return $this->goHome();
        }
    }

    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            $this->layout = 'AdminMain';
            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            return $this->goHome();
        }
    }


    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            return $this->goHome();
        }
    }


        public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->render('index');
        }

        $this->layout = 'AdminMain';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $dataProvider = new ActiveDataProvider(['query' => Order::find()]);
            return $this->render('index', compact('dataProvider'));
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

        public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
