<?php

namespace backend\controllers\catalog;

use Yii;
use common\models\Category;
use common\models\Guide;
use backend\models\GuideSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;

use kartik\detail\DetailView;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\Url;

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
     * Detach image from Guide
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

        $image = UploadedFile::getInstanceByName('new_guide_image');
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
            'categories' => $categories,
        ]);
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
