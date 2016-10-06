<?php

namespace frontend\widgets;

use Yii;

use yii\helpers\Html;
use yii\helpers\Url;

class NewsletterBox extends \yii\base\Widget
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
            $this->class = 'single_sidebar news_letter';
        }

        if ($this->type === null) {
            $this->type = 'side';
        }

        $this->actionUrl = ['/widget/newsletter'];
    }

    public function run()
    {
        if ($this->type == 'side') {
            $html = '<div class="' . $this->class . '">';
            $html .= '<h2>Newsletter</h2>';
            $html .= '<form action="' . Url::toRoute($this->actionUrl) .'" method="post">';
            $html .= '<input type="text" name="email" class="form-control" placeholder="type your email address">';
            $html .= '<button class="btn btn-default btn_common">SIGN UP NOW</button>';
            $html .= '</form>';
            $html .= '</div>';
        } else {
            $html = 'Message!!!';
        }
        return $html;
    }
}
