<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;
use common\models\ProductImage;

class SuperController extends Controller
{
    public function actionInit()
    {
        $adminEmail = Yii::$app->params["adminEmail"] ? Yii::$app->params["adminEmail"] : "admin@kitchenrating.com";
        $supportEmail = Yii::$app->params["supportEmail"] ? Yii::$app->params["supportEmail"] : "support@kitchenrating.com";

        $user = User::findByUsername("admin");
        if (!$user) {
            $user = new User(); 
        }
        
        $user->username = "admin";
        $user->email = $adminEmail;
        $user->setPassword("qpwoei00");
        $user->generateAuthKey();
        $user->save(false);
        
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('admin');
        $auth->assign($authorRole, $user->getId());    

        $user = User::findByUsername("support");
        if (!$user) {
            $user = new User();    
        }
        
        $user->username = "support";
        $user->email = $supportEmail;
        $user->setPassword("qpwoei00");
        $user->generateAuthKey();
        $user->save(false);
        
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('catalogManager');
        $auth->assign($authorRole, $user->getId());    
        
    }

    public function actionImage() {
        $model = ProductImage::findOne(14);
        echo Yii::$app->imageCache->img('@mainUpload/' . $model->image_url, '130x130', ['class' => 'file-preview-image']);
    }
}
