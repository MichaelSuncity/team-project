<?php

namespace frontend\controllers;

use Yii;
use common\models\CashFlows;
use common\models\PaymentMethod;
use common\models\search\CashFlowsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\NotAcceptableHttpException;
use yii\filters\VerbFilter;

/**
 * CashFlowsController implements the CRUD actions for CashFlows model.
 */
class CashFlowsController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all CashFlows models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CashFlowsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->query->byCurrentUser(); 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'payments' => PaymentMethod::getPaymentMethod(),
        ]);
    }
    
    /**
     * Lists all CashFlows models.
     * @return mixed
     */
    public function actionPaymentMethod($payment_id)
    {
        $searchModel = new CashFlowsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->query->byPayment($payment_id)->byCurrentUser(); 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'payments' => PaymentMethod::getPaymentMethod(),
        ]);
    }

    /**
     * Displays a single CashFlows model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CashFlows model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
    public function actionCreate()
    {
        $model = new CashFlows();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    */

    /**
     * Updates an existing CashFlows model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CashFlows model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CashFlows model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CashFlows the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CashFlows::findOne($id)) !== null) {
            if ($model->user_id == Yii::$app->user->id) {
                return $model;
            } else {
                throw new NotAcceptableHttpException('У вас нет доступа к этой странице');
            }
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
