<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

use common\models\Page;
use common\models\Product;
use common\models\Category;
use common\models\Guide;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => ['yii\web\ErrorAction']
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $model = $this->findModel('home');

        $featuredProducts = Product::find()->where(['featured' => true])->all();
        $popularTop10 = Category::find()->where(['popular' => true])->all();
        $guides = Guide::find()->orderBy(['created_at' => 'desc'])->limit(4)->all();

        return $this->render('index', [
            'featuredProducts' => $featuredProducts,
            'popularTop10' => $popularTop10,
            'guides' => $guides,
            'model' => $model
        ]);
    }

    /**
     * Displays static pages page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $model = $this->findModel('about');
        return $this->render('page', [
            'model' => $model
        ]);
    }

    public function actionPolicy()
    {
        $model = $this->findModel('privacy');
        return $this->render('page', [
            'model' => $model
        ]);
    }

    public function actionDisclaimer()
    {
        $model = $this->findModel('disclaimer');
        return $this->render('page', [
            'model' => $model
        ]);
    }

    public function actionTos()
    {
        $model = $this->findModel('tos');
        return $this->render('page', [
            'model' => $model
        ]);
    }

    public function actionContact()
    {
        $model = $this->findModel('contact');
        return $this->render('page', [
            'model' => $model
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
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
