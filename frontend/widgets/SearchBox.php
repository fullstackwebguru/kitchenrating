<?php

namespace frontend\widgets;

use Yii;

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\assets\SearchBoxAsset;

class SearchBox extends \yii\base\Widget
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
        'banner',
        'top',
        'product'
    ];

    public function init()
    {
        parent::init();

        if ($this->type === null || !in_array($this->type, $this->acceptedType)) {
            $this->type = 'side';
        }

        $this->name = 'tw_search_' . $this->type;

        $this->actionUrl = ['/widget/search'];
    }

    public function run()
    {
        SearchBoxAsset::register($this->getView());

        $viewName= 'searchbox_' . $this->type;
        return $this->render($viewName, ['actionUrl' => $this->actionUrl, 'name' => $this->name]);
    }

    public function getViewPath() {
        return '@frontend/widgets/views/';
    }
}
