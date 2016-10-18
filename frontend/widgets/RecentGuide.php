<?php

namespace frontend\widgets;

use common\models\Guide;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class RecentGuide extends \yii\base\Widget
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
            $this->title = 'RECENTLY ADDED GUIDES';
        }

        if ($this->num === null) {
            $this->num = 6;
        }

        $this->guides = Guide::find()->orderBy(['created_at' => 'desc'])->limit($this->num)->all();
    }

    public function run()
    {
        $html = '<div class="single_sidebar recent_post">';
        $html .= '<h2 class="title">' . $this->title . '</h2>';
        $html .= '<ul>';

        foreach ($this->guides as $guide) {
            $html .= '<li>';
            $itemTemplate = '<a href="'. Url::toRoute($guide->getRoute()) .'" class="media">';
            $itemTemplate .= '<div class="media-left">';
            $itemTemplate .= '<img src="' . cloudinary_url($guide->image_url, array("width" => 62, "height" => 62, "crop" => "fill")) .'" class="file-preview-image">';
            $itemTemplate .= '</div>';
            $itemTemplate .= '<div class="media-body">';
            $itemTemplate .= '<h2>'. $guide->title . '</h2>';
            $itemTemplate .= '<span>read more >></span>';
            $itemTemplate .= '</div>';
            $itemTemplate .= '</a>';

            $html .= $itemTemplate;
            $html .= '</li>';
        }
        $html .= '</ul>';
        $html .= '</div>';
        return $html;
    }
}
