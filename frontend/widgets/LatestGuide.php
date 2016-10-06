<?php

namespace frontend\widgets;

use common\models\Guide;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class LatestGuide extends \yii\base\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $title;

    public $num;

    /**
     * @var array the options for rendering 
     */

    private $guides;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = 'Latest Guides';
        }

        if ($this->num === null) {
            $this->num = 4;
        }

        $this->guides = Guide::find()->orderBy(['created_at' => 'desc'])->limit($this->num)->all();
    }

    public function run()
    {
        $html = '<div class="latest_guided_section">
                    <div class="latest_guided_box">
                        <div class="container">
                            <h2 class="section_title">'. $this->title .'</h2>
                        <div class="row">';
        

        foreach ($this->guides as $guide) {
            $html .= '<div class="col-xs-12 col-sm-3">
              <div class="single_guided_box">
                <a href="';
            $html .= Url::toRoute($guide->getRoute()) . '" class="img_thumb">';
            $html .= Yii::$app->imageCache->img('@mainUpload/' . $guide->image_url, '263x198', ['class' => 'file-preview-image']);
            $html .= '</a>';
            $html .= Html::a($guide->title, $guide->getRoute(), ['class' => 'guide_title']);
            $html .= '</div>
                    </div>';
        }
        $html .= '</div>
                    <div class="text-right">';
        $html .= Html::a('View more guides&nbsp;&nbsp;>>',['/guide'], ['class' => 'read_more_guide']);
        $html .= '</div>
                </div>
                </div>
                </div>';
        return $html;
    }
}
