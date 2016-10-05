<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property double $rating
 * @property integer $store_id
 * @property integer $num_rating
 * @property integer $status
 * @property string $color
 * @property integer $featured
 * @property integer $popular
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $category
 * @property Store $store
 * @property ProductImage[] $productImages
 */

class Product extends ActiveRecord
{
    const STATUS_DELETED = false;
    const STATUS_ACTIVE = true;

    public $temp_images;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
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
                'slugAttribute' => 'slug'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'num_rating'], 'integer'],
            [['title', 'category_id', 'store_id', 'product_url', 'rating','num_rating'], 'required'],
            [['description','color','product_url',], 'string'],
            [['rating'], 'number'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_id' => 'id']],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['status', 'popular', 'featured'], 'boolean'],
            // /[['temp_images'], 'file','skipOnEmpty' => true, 'extensions'=>'jpg, gif, png'],
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
            'description' => 'Description',
            'store_id' => 'Store',
            'product_url' => 'Product Url',
            'rating' => 'Rating',
            'num_rating' => 'Num Rating',
            'color' => 'Color',
            'status' => 'Status',
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
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    // public function uploadImages() {
    //     if ($this->validate()) {
    //         foreach($this->temp_images as $image) {
    //             $ext = end((explode(".", $image->name)));
    //             $image_url = Yii::$app->security->generateRandomString().".{$ext}";
    //             $path = Yii::getAlias('@mainUpload') . '/'. $image_url;
    //             $image->saveAs($path);

    //             $productImage = new ProductImage();
    //             $productImage->product_id = $this->id;
    //             $productImage->image_url = $image_url;

    //             $productImage->save();
    //         }
    //         return true;
    //     }
    //     return false;
    // }
}
