<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class WidgetController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'search' => ['POST'],
                    'newsletter' => ['POST'],
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
        return 'ppost';
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
