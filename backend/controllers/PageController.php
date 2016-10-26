<?php

namespace backend\controllers;

use Yii;
use common\models\Page;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
{
    public $layout = 'catalog';
    
    public function actionHome()
    {
        $model = $this->findModel('home');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('home', [
                'model' => $model
            ]);
        } else {
            return $this->render('home', [
                'model' => $model
            ]);
        }
    }

    public function actionView($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('view', [
                'model' => $model
            ]);
        } else {
            return $this->render('view', [
                'model' => $model
            ]);
        }
    }
    

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne(['page_id'=>$id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
