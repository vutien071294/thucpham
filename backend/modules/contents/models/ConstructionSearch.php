<?php

namespace backend\modules\contents\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\contents\models\Construction;

/**
 * ConstructionSearch represents the model behind the search form about `backend\modules\contents\models\Construction`.
 */
class ConstructionSearch extends Construction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'create_time', 'create_by', 'update_time', 'update_by', 'cate_id', 'is_complete', 'is_hot', 'is_build'], 'integer'],
            [['title', 'address', 'url', 'description','contruction_type'], 'safe'],
            ['title', 'trim'],
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
        $query = Construction::find();

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

        if($this->title){

            $query->andFilterWhere(['like', 'title', $this->title]);
        }

        // if($this->contruction_type){
        //     var_dump($this->contruction_type);
        //     if($this->contruction_type = '1'){

        //         $query->andFilterWhere(['is_hot' => 1]);

        //     }else if($this->contruction_type = '2'){
        //         $this->contruction_type = '2';
        //         $query->andFilterWhere(['is_build' => 1]);

        //     }else if($this->contruction_type = '3'){

        //         $query->andFilterWhere(['is_complete' => 1]);

        //     }
        // }
        return $dataProvider;
    }
}
