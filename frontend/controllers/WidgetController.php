<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use common\models\Category;
use frontend\models\CategorySearch;

/**
 * Site controller
 */
class WidgetController extends Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'newsletter' => ['POST'],
                    'search' => ['POST']
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionSearch()
    {
        $searchModel = new CategorySearch(Yii::$app->request->post());
        $top10s = $searchModel->search([])->getModels();    

        return $this->renderPartial('_search', [
            'top10s' => $top10s
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionNewsletter()
    {
        return 'ppost';
    }
}
