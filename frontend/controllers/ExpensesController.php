<?php

namespace frontend\controllers;

use Yii;
use common\models\Expenses;
use frontend\models\search\ExpensesSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use common\models\ExpensesAttachmentsAddForm;

/**
 * ExpensesController implements the CRUD actions for Expenses model.
 */
class ExpensesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class, //ACF
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'view', 'update', 'delete', 'addattachment'],
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Expenses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExpensesSearch();


        $query = Expenses::find();
        if (!Yii::$app->user->can('admin')) {
                $query->andWhere(['user_id' => Yii::$app->user->id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'validatePage' => false,
                'pageSize'=> 20,
            ]
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Expenses model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id)
    {
        $model = Expenses::findOne($id);
        if ($model->user_id == Yii::$app->user->id) {
            return $this->render('view', [
            'model' => $model,
                'expensesAttachmentForm' => new ExpensesAttachmentsAddForm()
        ]);
        }  else {
            throw new NotFoundHttpException();
        }
    }

    /**
     * Creates a new Expenses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Expenses();
        
/*
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
*/
        if ($model->load(Yii::$app->request->post())) {
                
            $transaction = Yii::$app->db->beginTransaction();
            
            if ($model->save() && $model->doFlow()) {
                
                $transaction->commit();
                
                return $this->redirect(['view', 'id' => $model->id]);
                
            } else {
                
                $transaction->rollback();
                
                throw new \yii\base\ErrorException('Не удалось записать в базу данных.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        
    }

    /**
     * Updates an existing Expenses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = Expenses::findOne($id);
        if ($model->user_id == Yii::$app->user->id) {
/*
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
*/
            if ($model->load(Yii::$app->request->post())) {
                
                $transaction = Yii::$app->db->beginTransaction();

                if ($model->save() && $model->doFlow()) {

                    $transaction->commit();

                    return $this->redirect(['view', 'id' => $model->id]);

                } else {

                    $transaction->rollback();

                    throw new \yii\base\ErrorException('Не удалось записать в базу данных.');
                }
            }

            return $this->render('update', [
                'model' => $model,
                'expensesAttachmentForm' => new ExpensesAttachmentsAddForm()
            ]);
        } else {
            throw new NotFoundHttpException();
        }
    }

    /**
     * Deletes an existing Expenses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Expenses::findOne($id);
        if ($model->user_id == Yii::$app->user->id) {
            $model->delete();
            return $this->redirect(['index']);
        }else{
            throw new NotFoundHttpException();
        }
    }

    /**
     * Finds the Expenses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Expenses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expenses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //добавление файлов
    public function actionAddattachment()
    {
        $model = new ExpensesAttachmentsAddForm();
        $model->load(\Yii::$app->request->post());
        $model->attachment = UploadedFile::getInstance($model, 'attachment');
        if ($model->save()) {
            \Yii::$app->session->setFlash('success', "Файл добавлен");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить файл");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }
}
