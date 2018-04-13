<?php

namespace frontend\modules\danhmuc\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\danhmuc\models\Danhmuc;

/**
 * DanhmucSearch represents the model behind the search form about `frontend\modules\danhmuc\models\Danhmuc`.
 */
class DanhmucSearch extends Danhmuc
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'orders', 'create_by', 'update_by', 'level'], 'integer'],
            [['code', 'title', 'title_en', 'title_fr', 'description', 'body', 'slug', 'image_preset', 'image_url', 'image_title', 'image_alt', 'sorting_price', 'sorting_brand', 'sorting_res', 'sorting_channel', 'tags', 'create_time', 'update_time', 'seo_title', 'seo_keyword', 'seo_description'], 'safe'],
            [['publish', 'is_top'], 'boolean'],
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
        $query = Danhmuc::find();

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
            'parent_id' => $this->parent_id,
            'publish' => $this->publish,
            'is_top' => $this->is_top,
            'orders' => $this->orders,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
            'level' => $this->level,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'title_fr', $this->title_fr])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'image_preset', $this->image_preset])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', 'image_title', $this->image_title])
            ->andFilterWhere(['like', 'image_alt', $this->image_alt])
            ->andFilterWhere(['like', 'sorting_price', $this->sorting_price])
            ->andFilterWhere(['like', 'sorting_brand', $this->sorting_brand])
            ->andFilterWhere(['like', 'sorting_res', $this->sorting_res])
            ->andFilterWhere(['like', 'sorting_channel', $this->sorting_channel])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'create_time', $this->create_time])
            ->andFilterWhere(['like', 'update_time', $this->update_time])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_keyword', $this->seo_keyword])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description]);

        return $dataProvider;
    }
}
