<?php

namespace backend\controllers;

use app\models\Apple;
use app\models\AppleSearch;
use backend\models\AppleCreator;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AppleController implements the CRUD actions for Apple model.
 */
class AppleController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [   'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'create', 'update', 'view', 'fall-down', 'index', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'view', 'fall-down', 'index', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Apple models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AppleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Apple model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Apple model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $creator = new AppleCreator();
        $creator->generate();
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Apple model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {
            if (!$model->eat()) {
                $model->delete();
            } else {
                if (!$model->validate(null, false)) {
                    foreach ($model->getErrors() as $val) {
                        \Yii::$app->session->setFlash('error', $val[0]);
                        return $this->redirect('index');
                    }
                }
                $model->save();
            }
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Apple model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Apple model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionFallDown($id)
    {
        $model = $this->findModel($id);
        if($model->fall()) {
            $model->save();
        } else {
            if (!$model->validate(null, false)) {
                foreach ($model->getErrors() as $val) {
                    \Yii::$app->session->setFlash('error', $val[0]);
                }
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Apple model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Apple the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Apple::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
