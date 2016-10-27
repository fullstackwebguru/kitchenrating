<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $slug
 * @property string $image_url
 * @property integer $popular 
 * @property double $rating
 * @property integer $num_rating
 * @property integer $status
 * @property string $color
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property Product[] $products
 * @property Product[] $top10Products
 */

class Category extends ActiveRecord
{
    const STATUS_DELETED = false;
    const STATUS_ACTIVE = true;

    public $temp_image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
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
            [['parent_id','num_rating'], 'integer'],
            [['title','status','meta_keywords', 'meta_description'], 'required'],
            [['rating','rank_option1','rank_option2','rank_option3'],'required'],
            [['rating'], 'number', 'max' => 5],
            [['title', 'slug', 'color'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['status', 'popular'], 'boolean'],
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
            'parent_id' => 'Parent',
            'title' => 'Title',
            'slug' => 'Slug',
            'color' => 'Color',
            'status' => 'Status',
            'image_url' => 'Image',
            'temp_image' => 'Image',
            'rating' => 'Rating',
            'num_rating' => 'Num Rating',
            'rank_option1' => 'Ranking Option 1',
            'rank_option2' => 'Ranking Option 2',
            'rank_option3' => 'Ranking Option 3',
            'meta_keywords' => 'SEO Keywords',
            'meta_description' => 'SEO description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * Finds category by title
     *
     * @param string $title
     * @return static|null
     */
    public static function findByCategorytitle($title)
    {
        return static::findOne(['title' => $title, 'status' => self::STATUS_ACTIVE]);
    }

    public function findTop10Products($orderBy) {
        $orderSet[] = 'score DESC';
        foreach($orderBy as $key => $order) {
            $orderSet[] = $key .' DESC';
        }

        $orderByStr = implode(',', $orderSet);
        $query = $this->getProducts()->select(['*','(score*300 + rank_option1*' .$orderBy['rank_option1']. ' + rank_option2*' .$orderBy['rank_option1'] . ' + rank_option3*'. $orderBy['rank_option3'] . ') as rank'])->orderBy('rank DESC')->limit(10);

        return $query->all();
    }

    /**
     * @return url
     */
    public function getRoute()
    {
        return ['top10/slug', 'slug' => $this->slug];
    }
}
