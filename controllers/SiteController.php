<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Cyclists;
use app\models\Results;
use app\models\DoperCyclists;

class SiteController extends Controller
{
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

    public function actionIndex()
    {
        $data = $this->getTableData();
        return $this->render('index', [
                'data' => $data
            ]);
    }

    public function getTableData() {
        $year = (isset($_GET['year'])) ? $_GET['year'] : 1999;
        $results = Results::getTourResults($year);
        for ($i=0;$i<count($results);$i++) {
            $id = $results[$i]['result_cyclist_id'];
            $name = Cyclists::getCyclistName($id);
            $doper = Cyclists::getCyclistDoper($id);
            $ban_types = DoperCyclists::getDopingDetails($id);
            $bans = "";
            foreach ($ban_types as $key=>$val) {
                //Add comma after each ban after the first one
                if ($key>0) {
                    $bans .= ", ";
                }
                $bans .= $ban_types[$key]['banTypes']['ban_type_desc'];
            }
            $results[$i]['dq'] = Results::resultDQ($id,$year);
            if ($ban_types) {
                if ($ban_types[0]['doper_cyclist_ban_length']!=99) {
                    $results[$i]['ban_length'] = $ban_types[0]['doper_cyclist_ban_length'] . " months";
                }
                //If ban length is 99 it stands for life
                else {
                    $results[$i]['ban_length'] = "Life";
                }
            }
            else {
                $results[$i]['ban_length'] = null;
            }
            $results[$i]['bans'] = $bans;
            $results[$i]['doper'] = $doper;
            $results[$i]['name'] = $name;
        }
        return $results;
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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

    public function actionAbout()
    {
        return $this->render('about');
    }
}
