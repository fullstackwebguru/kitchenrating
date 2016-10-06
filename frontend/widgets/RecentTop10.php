<?php

namespace frontend\widgets;

use common\models\Category;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class RecentTop10 extends \yii\base\Widget
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
    private $categories;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = 'See more Top 10 items';
        }

        if ($this->num === null) {
            $this->num = 5;
        }

        $this->categories = Category::find()->orderBy(['created_at' => 'desc'])->limit($this->num)->all();
    }

    public function run()
    {

        $html = '<div class="text-left more_10_items_list">';
        $html .= '<h2 class="section_title">' . $this->title . '</h2>';
        $html .= '<div class="product_list_1">';

        foreach ($this->categories as $category) {
            $itemTemplate = '<div class="product_list_1_single">';
            $itemTemplate .= '<div class="product_list_1_single_in">';

            $itemTemplate .= '<a href="'. Url::toRoute($category->getRoute()) .'" class="product_list_1_img">';
            $itemTemplate .= Yii::$app->imageCache->img('@mainUpload/' . $category->image_url, '249x194');
            $itemTemplate .= '</a>';

            $itemTemplate .= '<a href="'. Url::toRoute($category->getRoute()) .'" class="title">' . $category->title . '</a>';

            $itemTemplate .= '</div>';
            $itemTemplate .= '</div>';

            $html .= $itemTemplate;
        }
        $html .= '<div class="clearfix"></div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}
