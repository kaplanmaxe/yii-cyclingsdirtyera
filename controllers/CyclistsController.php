<?php

namespace app\controllers;

use Yii;
use app\models\Cyclists;
use app\models\CyclistsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\filters\AccessControl;

/**
 * CyclistsController implements the CRUD actions for Cyclists model.
 */
class CyclistsController extends Controller
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
                'only' => ['update','delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['delete'],
                        'roles' => ['?'],
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Cyclists models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CyclistsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $cyclist = Cyclists::find()->where(['cyclist_id'=>1])->one();
        $query = new Query();
        $test = $query->select(['*'])
              ->from('Cyclists')
              ->join('INNER JOIN', 'Doper_cyclists', 'Doper_cyclists.doper_cyclist_id=Cyclists.cyclist_id')
              ->where(['cyclist_id'=>4])->all();
        

        $cyclist_name = $cyclist->cyclist_name;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cyclist_name' => $cyclist_name
        ]);
    }

    /**
     * Displays a single Cyclists model.
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
     * Creates a new Cyclists model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cyclists();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cyclist_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cyclists model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cyclist_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cyclists model.
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
     * Finds the Cyclists model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cyclists the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cyclists::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
