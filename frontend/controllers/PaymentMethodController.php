<?php

namespace frontend\controllers;

use Yii;
use frontend\models\OperationForm;
use frontend\models\TransferForm;
use common\models\PaymentMethod;
use common\models\CashFlows;
use common\models\search\PaymentMethodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\NotAcceptableHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentMethodController implements the CRUD actions for PaymentMethod model.
 */
class PaymentMethodController extends Controller
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
     * Lists all PaymentMethod models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentMethodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->query->byCurrentUser();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PaymentMethod model.
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
     * Creates a new PaymentMethod model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PaymentMethod();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PaymentMethod model.
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
     * Deletes an existing PaymentMethod model.
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
    * @param integer $id
    */
    public function actionOperation($id)
    {
        $model = new OperationForm($this->findModel($id));
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $cashFlows = new CashFlows([
                'title' => $model->title,
                'date' => $model->date,
                'payment_id' => +$model->id,
                'type' => +$model->operation,
                'user_id' => yii::$app->user->identity->getId(),
            ]);
            
            $sum = +$model->sum;
            
            if ($cashFlows->type === CashFlows::TYPE_WITHDRAW)
                $cashFlows->sum = -$sum;
            else
                $cashFlows->sum = $sum;
            $cashFlows->save();
            
            return $this->redirect(['index']);
        }

        return $this->render('OperationForm', [
            'model' => $model,
        ]);
    }
    
    /**
    * @param integer $id
    */
    public function actionTransfer($id)
    {
        $model = new TransferForm($this->findModel($id));
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $data = [
                'title' => $model->title,
                'date' => $model->date,
                'type' => CashFlows::TYPE_TRANSFER,
                'user_id' => yii::$app->user->identity->getId(),
            ];
            
            $recipient = +$model->recipient;
            $sender = +$model->id;
            $sum = +$model->sum;
            
            $transaction = Yii::$app->db->beginTransaction();
            
            $cashFlows = new CashFlows(yii\helpers\ArrayHelper::merge(

                $data,
                [
                    'payment_id' => $recipient,
                    'sum' => $sum,
                ]
            ));

            $success = $cashFlows->save();

            $cashFlows = new CashFlows(yii\helpers\ArrayHelper::merge(

                $data,
                [
                    'payment_id' => $sender,
                    'sum' => -$sum,
                ]
            ));
            
            if ($cashFlows->save() && $success) {
                
                $transaction->commit();
                
                return $this->redirect(['index']);
                
            } else {
                
                $transaction->rollback();
                
                throw new \yii\base\ErrorException('Не удалось записать в базу данных.');
            }
        }

        return $this->render('transferForm', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the PaymentMethod model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaymentMethod the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaymentMethod::findOne($id)) !== null) {
            if ($model->user_id == Yii::$app->user->id) {
                return $model;
            } else {
                throw new NotAcceptableHttpException('У вас нет доступа к этой странице');
            }
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
