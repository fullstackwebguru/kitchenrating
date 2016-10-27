<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use common\models\Category;
use common\models\Page;

/**
 * Top10 controllers
 */
class Top10Controller extends Controller
{

    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionSlug($slug) 
    {
        $model = $this->findModelBySlug($slug);
        $pageModel = Page::findOne(['page_id'=>'top10']);

        return $this->render('view', [
            'model' => $model,
            'pageModel' => $pageModel
        ]);   
    }

    public function actionGenerate($id)
    {
        $posts = Yii::$app->request->post();

        if (isset($posts['rank_option1'])) {
            $post['rank_option1'] = $posts['rank_option1'];
            $post['rank_option2'] = $posts['rank_option2'];
            $post['rank_option3'] = $posts['rank_option3'];
        } else {
            $post['rank_option1'] = 50;
            $post['rank_option2'] = 50;
            $post['rank_option3'] = 50;
        }
        
        $model = $this->findModel($id);
        $products = $model->findTop10Products($post);
        foreach ($products as $i => $product) {
             $result[] = $product->rank;
        }

        return $this->renderPartial('_productList', [
            'products' => $products
        ]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelBySlug($slug)
    {
        if (($model = Category::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
