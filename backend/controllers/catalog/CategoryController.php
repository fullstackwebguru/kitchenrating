<?php

namespace backend\controllers\catalog;

use Yii;
use kartik\grid\EditableColumnAction;
use common\models\Category;
use backend\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Html;
use kartik\detail\DetailView;

use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    public $layout = 'catalog';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create','view', 'update', 'delete' ,'detach', 'upload'],
                        'roles' => ['updateCatalog']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isAjax && Yii::$app->request->post('hasEditable')) {
            $categoryId = Yii::$app->request->post('editableKey');
            $model = $this->findModel($categoryId);

            $out = ['output'=>'', 'message'=>''];
            $posted = current(Yii::$app->request->post('Category'));
            $post = ['Category' => $posted];

            if ($model->load($post) && $model->save()) {
                $out['message'] = '';
            } else {
                $out['message'] = 'Error in request';
            }

            echo Json::encode($out);
            return;
        } else {
            $searchModel = new CategorySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]);
        }
    }

    /**
     * Detach image from Category
     * @param integer $id
     * @return mixed
     */
    public function actionDetach($id) {
        $model = $this->findModel($id);
        $output = [];
        \Cloudinary\Uploader::destroy($model->image_url);
        $model->image_url = '';
        $model->save();
        echo json_encode($output);
    }

    public function actionUpload($id)
    {
        $model = $this->findModel($id);

        $output = [];

        $image = UploadedFile::getInstanceByName('new_category_image');

        if ($image) {
            // $ext = end((explode(".", $image->name)));
            // $model->image_url = Yii::$app->security->generateRandomString().".{$ext}";
            // $path = Yii::getAlias('@mainUpload') . '/'. $model->image_url;
            // $image->saveAs($path);

            // $model->save();

            // $allImages[] = Yii::$app->imageCache->img('@mainUpload/' . $model->image_url, '200x150', ['class' => 'file-preview-image']);
            // $allImageConfig[] =[   
            //         'caption' => 'Current Image',
            //         'url' => Url::toRoute(['detach', 'id'=>$model->id])
            // ];

            $uploadResult = \Cloudinary\Uploader::upload($image->tempName);

            if (isset($uploadResult['public_id'])) {
                $image_url = $uploadResult['public_id'];
                $model->image_url = $image_url;

                $model->save();

                $allImages[] = '<img src="' . cloudinary_url($image_url, array("width" => 300, "height" => 450, "crop" => "fill")) .'" class="file-preview-image">';

                $allImageConfig[] =[   
                        'caption' => 'Image',
                        'frameAttr'=> [
                            'style' => 'height:150px; width:100px;',
                        ],
                        'url' => Url::toRoute(['detach', 'id'=>$model->id])
                ];
            }

            $output['initialPreview'] = $allImages;
            $output['initialPreviewConfig'] = $allImageConfig;
        }

        echo json_encode($output);
    }

    /**
     * Displays a single Category model.
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
                'viewMode' => $viewMode
            ]);
        }
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) ) {
            $image = UploadedFile::getInstance($model, 'temp_image');
            if ($image) {

                $ext = end((explode(".", $image->name)));
                $model->image_url = Yii::$app->security->generateRandomString().".{$ext}";
                $path = Yii::getAlias('@mainUpload') . '/'. $model->image_url;
                $image->saveAs($path);
            }
            
            if ($model->save())  {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', [
                'model' => $model,
                'viewMode' => DetailView::MODE_EDIT
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

