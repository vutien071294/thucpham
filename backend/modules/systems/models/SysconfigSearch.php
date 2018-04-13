<?php

namespace backend\modules\systems\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\systems\models\Sysconfig;
use backend\components\ComponentBase;

/**
 * SysconfigSearch represents the model behind the search form about `backend\modules\systems\models\Sysconfig`.
 */
class SysconfigSearch extends Sysconfig
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creation_time', 'creation_user', 'update_time', 'update_user'], 'integer'],
            [['code', 'name', 'value', 'decription','search_text'], 'safe'],
            ['search_text', 'trim'],
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
        $query = Sysconfig::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>['creation_time'=>SORT_DESC],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if ($this->search_text) 
        {
            $arr = array();
            $arr_id = array();
            $components = new ComponentBase();
            $search_text_convert = $components->convert_vi_to_en($this->search_text);
            $data_sysconfig = Sysconfig::find()->select('id, name')->all();
            foreach ($data_sysconfig as $key => $value) {
                $temp = array();
                array_push($temp, $value['id']);
                array_push($temp, $components->convert_vi_to_en(trim($value['name'])));
                array_push($arr, $temp);
            }
            foreach ($arr as $key => $value) {
                if (stripos($value[1], $search_text_convert) !== false) {
                    array_push($arr_id, $value[0]);
                }
            }
            $query->andFilterWhere(['ilike', 'code', $this->search_text])
            ->orFilterWhere(['IN', 'id',$arr_id]);
        }

        return $dataProvider;
    }
}
