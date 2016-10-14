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
    }

    public function getViewPath() {
        return '@frontend/widgets/views/';
    }
}
