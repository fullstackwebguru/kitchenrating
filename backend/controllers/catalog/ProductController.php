<?php

namespace backend\controllers\catalog;

use Yii;
use common\models\Category;
use common\models\Product;
use common\models\ProductImage;
use common\models\ProductInfo;
use common\models\Store;
use backend\models\ProductSearch;
use backend\models\ProductInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                    'deleteinfo' => ['POST'],
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
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'categories' => $categories,
                'stores' => $stores
            ]);
        }
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post('kvdelete')) {
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
            } else if (Yii::$app->request->post('hasEditable')) {
                $productId = Yii::$app->request->post('editableKey');
                $infoModel = ProductInfo::findOne($productId);

                $out = ['output'=>'', 'message'=>''];
                $posted = current(Yii::$app->request->post('ProductInfo'));
                $post = ['ProductInfo' => $posted];

                if ($infoModel->load($post) && $infoModel->save()) {
                    $out['message'] = '';
                } else {
                    $out['message'] = 'Error in request';
                }

                echo Json::encode($out);
                return;
            }
        }

        $categories = Category::find()->orderBy('title')->asArray()->all();
        $stores = Store::find()->orderBy('title')->asArray()->all();

        $searchModel = new ProductInfoSearch();
        $searchModel->base_product_id = $id;
        $dataProvider = $searchModel->search([]);

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
                'dataProvider' => $dataProvider,
                'viewMode' => $viewMode,
                'categories' => $categories,
                'stores' => $stores
            ]);
        }
    }

    /**
     * Add Product Info to product
     * @param integer $id
     * @return mixed
     */
    
    public function actionAddinfo($id) {

        $productModel = $this->findModel($id);
        $model = new ProductInfo();
        $model->product_id = $id;
        $stores = Store::find()->orderBy('title')->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $productModel->id]);
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_infoform', [
                        'model' => $model,
                        'stores' => $stores
            ]);
        } else {
            return $this->render('_infoform', [
                        'model' => $model,
                        'stores' => $stores
            ]);
        }
    }

    /**
     * Delete Product Info to product
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteinfo($id, $infoId) {
        $model = $this->findModel($id);
        ProductInfo::findOne($infoId)->delete();
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Detach Product Image  from Product
     * @param integer $id
     * @param integer $imageId
     * @return mixed
     */
    public function actionDetach($id, $imageId) {
        $model = $this->findModel($id);

        $imageModel = ProductImage::findOne($imageId);

        if ($imageModel) {
            $imageModel->delete();
        }

        $output = [];
        echo json_encode($output);
    }

    public function actionUpload($id)
    {
        $model = $this->findModel($id);

        $output = [];

        $allImages = [];
        $allImageConfig = [];

        $images = UploadedFile::getInstancesByName('temp_images');
        if ($images) {
            foreach($images as $image) {
                $ext = end((explode(".", $image->name)));
                $image_url = Yii::$app->security->generateRandomString().".{$ext}";
                $path = Yii::getAlias('@mainUpload') . '/'. $image_url;
                $image->saveAs($path);

                list($width, $height) = getimagesize($path);

                $productImage = new ProductImage();
                $productImage->product_id = $model->id;
                $productImage->image_url = $image_url;

                $productImage->save();

                $allImages[] = Yii::$app->imageCache->img('@mainUpload/' . $image_url, $width .'x' . $height, ['class' => 'file-preview-image']);
                $allImageConfig[] =[   
                        'caption' => 'Image',
                        'url' => Url::toRoute(['detach', 'id'=>$model->id, 'imageId' => $productImage->id])
                ];
            }
            
        }

        $output['initialPreview'] = $allImages;
        $output['initialPreviewConfig'] = $allImageConfig;    
        echo json_encode($output);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $categories = Category::find()->orderBy('title')->asArray()->all();
        $stores = Store::find()->orderBy('title')->asArray()->all();
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // $model->temp_images = UploadedFile::getInstance($model, 'temp_images');
            // $model->uploadImages();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
                'stores' => $stores
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $categories = Category::find()->orderBy('title')->asArray()->all();
        $stores = Store::find()->orderBy('title')->asArray()->all();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
        $this->findModel($id)->delete();

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
