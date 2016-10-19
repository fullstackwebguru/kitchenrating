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
 * @property string $sku
 * @property string $slug
 * @property string $description
 * @property double $rating
 * @property integer $store_id
 * @property integer $num_rating
 * @property double $score
 * @property integer $rank_option1
 * @property integer $rank_option2
 * @property integer $rank_option3
 * @property integer $status
 * @property string $color
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $featured
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $category
 * @property Store $store
 * @property ProductImage[] $productImages
 * @property ProductInfo[] $productInfos
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
            [['category_id', 'num_rating'], 'integer'],
            [['title', 'category_id', 'store_id', 'product_url', 'rating','num_rating', 'sku', 'meta_keywords', 'meta_description' ], 'required'],
            [['rank_option1', 'rank_option2', 'rank_option3', 'score'], 'required'],
            [['description','color','product_url',], 'string'],
            [['rating'], 'number', 'max' => 5],
            [['score'], 'number', 'max' => 10],
            [['title', 'sku', 'slug'], 'string', 'max' => 255],
            [['rank_option1', 'rank_option2', 'rank_option3'], 'integer', 'min' => 0 ,  'max' => 10],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_id' => 'id']],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['status', 'featured'], 'boolean'],
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
            'sku' => 'SKU',
            'slug' => 'Slug',
            'description' => 'Description',
            'store_id' => 'Store',
            'product_url' => 'Product Url',
            'rating' => 'Rating',
            'num_rating' => 'Num Rating',
            'score' => 'Score',
            'rank_option1' => 'Ranking Option 1',
            'rank_option2' => 'Ranking Option 2',
            'rank_option3' => 'Ranking Option 3',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductInfos()
    {
        return $this->hasMany(ProductInfo::className(), ['product_id' => 'id']);
    }

    public function getMainImage()
    {
        if ($this->productImages && count($this->productImages)) {
            return $this->productImages[0];
        } else {
            return '';
        }
    }

    /**
     * @return rank in category
     */
    public function getDefaultRank() {
        $connection = Yii::$app->getDb();
        $result = $connection->createCommand(' SELECT rs.rank FROM (
            SELECT p.*, @curRank:= @curRank + 1 AS rank 
            FROM ' . self::tableName() . ' p, (SELECT @curRank:= 0) r  
            WHERE p.category_id = :category_id 
            ORDER BY p.score DESC, p.rank_option1 DESC, p.rank_option2 DESC, p.rank_option3 DESC
        ) as rs 
        WHERE rs.id = :product_id', 
        [
            ':category_id' => $this->category_id,
            ':product_id' => $this->id
        ])->queryAll();

        return $result[0]['rank'];
    }

    /**
     * @return products
     */
    public static function findFeaturedProducts()
    {
        return static::find(['featured' => true]);
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
    // 
    
    /**
     * @return url
     */
    
    public function getRoute()
    {
        return ['product/slug', 'slug' => $this->slug];
    }
}
