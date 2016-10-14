<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use common\models\Category;

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
        return $this->render('view', [
            'model' => $model
        ]);   
    }

    public function actionGenerate($id)
    {
        $post['quality_level'] = Yii::$app->request->post('quality_level',0);
        $post['trust_level'] = Yii::$app->request->post('trust_level',0);
        $post['price_level'] = Yii::$app->request->post('price_level',0);
        arsort($post);
        $model = $this->findModel($id);
        $products = $model->findTop10Products($post)->all();
        foreach ($products as $i => $product) {
            $result[] = $product;
        }

        return $this->renderPartial('_productList', [
            'products' => $result
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
