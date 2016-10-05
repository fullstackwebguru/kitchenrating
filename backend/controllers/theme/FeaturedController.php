<?php

namespace backend\controllers\theme;

use Yii;
use common\models\Category;
use common\models\Product;
use common\models\ProductImage;
use common\models\Store;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * FeaturedController implements the CRUD actions for Product model.
 */
class FeaturedController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (Yii::$app->request->isAjax && Yii::$app->request->post('hasEditable')) {
            $productId = Yii::$app->request->post('editableKey');
            $model = $this->findModel($productId);

            $out = ['output'=>'', 'message'=>''];
            $posted = current(Yii::$app->request->post('Product'));
            $post = ['Product' => $posted];

            if ($model->load($post) && $model->save()) {
                $out['message'] = '';
            } else {
                $out['message'] = 'Error in request';
            }

            echo Json::encode($out);
            return;
        } else {

            $categories = Category::find()->orderBy('title')->asArray()->all();
            $stores = Store::find()->orderBy('title')->asArray()->all();

            $searchModel = new ProductSearch();
            $searchModel->setFeatured();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'categories' => $categories,
                'stores' => $stores
            ]);
        }
    }

     /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $model->featured = false;

        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
