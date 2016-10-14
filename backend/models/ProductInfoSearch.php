<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductInfo;

/**
 * ProductInfoSearch represents the model behind the search form about `common\models\ProductInfo`.
 */
class ProductInfoSearch extends ProductInfo
{

    public $base_product_id = '';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'store_id', 'product_id'], 'integer'],
            [['product_url'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProductInfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // 
        $where = [
            'id' => $this->id,
            'product_id' => $this->base_product_id,
            'store_id' => $this->store_id,
        ];

        $query->andFilterWhere($where);

        return $dataProvider;
    }
}
