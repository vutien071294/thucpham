<?php

namespace backend\modules\product\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\product\models\Products;
use backend\components\ComponentBase;

/**
 * ProductsSearch represents the model behind the search form about `backend\modules\product\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['id', 'is_new', 'is_promotion', 'is_seller', 'is_hot', 'is_stock', 'categories_id', 'create_by', 'update_time'], 'integer'],
            [['code', 'title_en', 'title_fr', 'description', 'description_en', 'description_fr', 'desc', 'desc_en', 'desc_fr', 'body', 'body_en', 'body_fr', 'body2', 'body2_en', 'body2_fr', 'body3', 'body3_en', 'body3_fr', 'image_preset', 'image_url', 'image_title', 'image_alt', 'warranty', 'slug', 'tags', 'seo_title', 'seo_keyword', 'seo_description', 'sub_categories_id', 'create_time', 'update_by', 'hightlight'], 'safe'],
            [['list_price', 'input_price', 'sell_price', 'orders'], 'number'],
            [['publish', 'show_price'], 'boolean'],

            [['search_text'], 'safe'],
            [['search_text'], 'trim'],
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
        $query = Products::find();

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
        $query->andFilterWhere([
            'id' => $this->id,
            'is_new' => $this->is_new,
            'is_promotion' => $this->is_promotion,
            'is_seller' => $this->is_seller,
            'is_hot' => $this->is_hot,
            'is_stock' => $this->is_stock,
            'list_price' => $this->list_price,
            'input_price' => $this->input_price,
            'sell_price' => $this->sell_price,
            'orders' => $this->orders,
            'publish' => $this->publish,
            'show_price' => $this->show_price,
            'categories_id' => $this->categories_id,
            'create_by' => $this->create_by,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'title_fr', $this->title_fr])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'description_en', $this->description_en])
            ->andFilterWhere(['like', 'description_fr', $this->description_fr])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'desc_en', $this->desc_en])
            ->andFilterWhere(['like', 'desc_fr', $this->desc_fr])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'body_en', $this->body_en])
            ->andFilterWhere(['like', 'body_fr', $this->body_fr])
            ->andFilterWhere(['like', 'body2', $this->body2])
            ->andFilterWhere(['like', 'body2_en', $this->body2_en])
            ->andFilterWhere(['like', 'body2_fr', $this->body2_fr])
            ->andFilterWhere(['like', 'body3', $this->body3])
            ->andFilterWhere(['like', 'body3_en', $this->body3_en])
            ->andFilterWhere(['like', 'body3_fr', $this->body3_fr])
            ->andFilterWhere(['like', 'image_preset', $this->image_preset])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', 'image_title', $this->image_title])
            ->andFilterWhere(['like', 'image_alt', $this->image_alt])
            ->andFilterWhere(['like', 'warranty', $this->warranty])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_keyword', $this->seo_keyword])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'sub_categories_id', $this->sub_categories_id])
            ->andFilterWhere(['like', 'create_time', $this->create_time])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'hightlight', $this->hightlight]);

            if ($this->search_text) {
            $arr = array();
            $arr_id = array();
            $components = new ComponentBase();
            $search_text_end = strtoupper($components->convert_vi_to_en($this->search_text));
            // convert dữ liệu lấy ra từ db thành chữ hoa không dấu
            $data = Products::find()->select('id, code, title')->all();
            
            foreach ($data as $key => $value) {
                $temp = array();
                array_push($temp, $value->id);
                array_push($temp, strtoupper($components->convert_vi_to_en(trim($value->code))));
                array_push($temp, strtoupper($components->convert_vi_to_en(trim($value->title))));
                array_push($arr, $temp);
            }
            foreach ($arr as $key => $value) {
                if (strpos($value[1], $search_text_end) !== false) {
                    array_push($arr_id, $value[0]);
                }else{
                    if (strpos($value[2], $search_text_end) !== false) {
                        array_push($arr_id, $value[0]);
                    }
                }
            }
            array_values($arr_id);
            if ($arr_id) {
                $query->andFilterWhere([
                    'or',
                    ['IN', 'id', $arr_id],
                    ['IN', 'id', $arr_id],
                ]);
            }else{
                $query->andFilterWhere([
                    'id' => 0,
                ]);
            }
        }
        return $dataProvider;
    }
}
