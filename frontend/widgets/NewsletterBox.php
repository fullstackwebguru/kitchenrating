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
    public $name;
    private $actionUrl;

    private $acceptedType = [
        'side',
        'footer',
    ];

    public function init()
    {
        parent::init();

        if ($this->type === null || !in_array($this->type, $this->acceptedType)) {
            $this->type = 'side';
        }

        $this->name = 'tw_newsletter_' . $this->type;

        $this->actionUrl = ['/widget/newsletter'];
    }

    public function run()
    {
        $viewName= 'newsletter_' . $this->type;
        return $this->render($viewName, ['actionUrl' => $this->actionUrl, 'name' => $this->name]);

        // if ($this->type == 'side') {
        //     $html = '<div class="' . $this->class . '">';
        //     $html .= '<h2>Newsletter</h2>';
        //     $html .= '<form action="' . Url::toRoute($this->actionUrl) .'" method="post">';
        //     $html .= '<input type="text" name="email" class="form-control" placeholder="type your email address">';
        //     $html .= '<button class="btn btn-default btn_common">SIGN UP NOW</button>';
        //     $html .= '</form>';
        //     $html .= '</div>';
        // } else {
        //     $html = 'Message!!!';
        // }
        // return $html;
    }

    public function getViewPath() {
        return '@frontend/widgets/views/';
    }
}
