<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "guide".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $author
 * @property string $slug
 * @property string $image_url
 * @property string $description
 * @property integer $status
 * @property string $color
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $category
 */

class Guide extends ActiveRecord
{
    const STATUS_DELETED = false;
    const STATUS_ACTIVE = true;

    public $temp_image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%guide}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['title', 'category_id', 'author', 'meta_keywords', 'meta_description'], 'required'],
            [['description','color','image_url'], 'string'],
            [['title', 'author', 'slug'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'boolean'],
            [['temp_image'], 'safe'],
            [['temp_image'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'title' => 'Title',
            'slug' => 'Slug',
            'author' => 'Author',
            'image_url' => 'Image',
            'temp_image' => 'Image',
            'description' => 'Description',
            'color' => 'Color',
            'status' => 'Status',
            'meta_keywords' => 'SEO Keywords',
            'meta_description' => 'SEO description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return url
     */
    public function getRoute()
    {
        return ['guide/slug', 'slug' => $this->slug];
    }
}
