<?php

namespace backend\controllers\catalog;

use Yii;
use common\models\Category;
use common\models\Guide;
use backend\models\GuideSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use kartik\detail\DetailView;

/**
 * GuideController implements the CRUD actions for Guide model.
 */
class GuideController extends Controller
{
    public $layout = 'catalog';
    
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
     * Lists all Guide models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (Yii::$app->request->isAjax && Yii::$app->request->post('hasEditable')) {
            $productId = Yii::$app->request->post('editableKey');
            $model = $this->findModel($productId);

            $out = ['output'=>'', 'message'=>''];
            $posted = current(Yii::$app->request->post('Guide'));
            $post = ['Guide' => $posted];

            if ($model->load($post) && $model->save()) {
                $out['message'] = '';
            } else {
                $out['message'] = 'Error in request';
            }

            echo Json::encode($out);
            return;
        } else {

            $categories = Category::find()->orderBy('title')->asArray()->all();

            $searchModel = new GuideSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Displays a single Guide model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && Yii::$app->request->post('kvdelete')) {
            $this->findModel($id)->delete();

            echo Json::encode([
                'success' => true,
                'messages' => [
                    'kv-detail-info' => 'The category # ' . $id . ' was successfully deleted. ' . 
                        Html::a('<i class="glyphicon glyphicon-hand-right"></i>  Click here', 
                            ['index'], ['class' => 'btn btn-sm btn-info']) . ' to proceed.'
                ]
            ]);
            return;
        }

        $categories = Category::find()->orderBy('title')->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            if (Yii::$app->request->get('viewMode') == 'edit') {
                $viewMode = DetailView::MODE_EDIT;    
            } else {
                $viewMode = DetailView::MODE_VIEW;
            }

            return $this->render('view', [
                'model' => $model,
                'viewMode' => $viewMode,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Creates a new Guide model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $categories = Category::find()->orderBy('title')->asArray()->all();
        $model = new Guide();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Updates an existing Guide model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $categories = Category::find()->orderBy('title')->asArray()->all();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Deletes an existing Guide model.
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
     * Finds the Guide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Guide the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Guide::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
