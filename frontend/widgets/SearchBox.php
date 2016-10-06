<?php

namespace frontend\widgets;

use Yii;

use yii\helpers\Html;
use yii\helpers\Url;

class SearchBox extends \yii\base\Widget
{
    /**
     * @var array the options for rendering 
     */
    public $class;
    public $type;
    private $actionUrl;

    public function init()
    {
        parent::init();

        if ($this->class === null) {
            $this->class = 'single_sidebar sidebar_seach_box';
        }

        if ($this->type === null) {
            $this->type = 'side';
        }

        $this->actionUrl = ['/widget/search'];
    }

    public function run()
    {
        if ($this->type == 'side') {
            $html = '<div class="' . $this->class . '">';
            $html .= '<form action="' . Url::toRoute($this->actionUrl) .'" method="post">';
            $html .= '<div class="sidebar_search">';
            $html .= '<input placeholder="Search.." type="text" name="name">';
            $html .= '<button type="submit" name="ts"><i class="fa fa-search"></i></button>';
            $html .= '</div>';
            $html .= '</form>';

            $html .= '</div>';
        } else {
            $html = 'Message!!!';
        }
        return $html;
    }
}
