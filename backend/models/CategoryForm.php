<?php
namespace backend\models;

use Yii;
use yii\base\Model;

use common\models\Category;

/**
 * Category form
 */
class CategoryForm extends Model
{
    public $title;

    private $_category;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // title, are required
            [['title'], 'required'],
        ];
    }
}
