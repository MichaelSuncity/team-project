<?php

namespace frontend\controllers;

use Yii;
use common\models\ExpensesCategory;
use frontend\models\search\ExpensesCategorySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

/**
 * ExpensescategoryController implements the CRUD actions for ExpensesCategory model.
 */
class ExpensescategoryController extends Controller
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
                        'actions' => ['index', 'create', 'view', 'update', 'delete'],
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all ExpensesCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExpensesCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->query->byCurrentUser();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single ExpensesCategory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id == Yii::$app->user->id) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            throw new NotFoundHttpException();
        }
    }

    /**
     * Creates a new ExpensesCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ExpensesCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ExpensesCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id == Yii::$app->user->id) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
            } else {
                throw new NotFoundHttpException();
        }
    }

    /**
     * Deletes an existing ExpensesCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = ExpensesCategory::findOne($id);
        if ($model->user_id == Yii::$app->user->id) {
            $model->delete();
            return $this->redirect(['index']);
        }else{
            throw new NotFoundHttpException();
        }
    }

    /**
     * Finds the ExpensesCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExpensesCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExpensesCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
