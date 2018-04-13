<?php

namespace backend\modules\users\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\users\models\Agency;

/**
 * AgencySearch represents the model behind the search form about `backend\modules\users\models\Agency`.
 */
class AgencySearch extends Agency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'account_type', 'time', 'prepaid', 'postpaid', 'creation_time', 'creation_user', 'update_time', 'update_user'], 'integer'],
            [['account_name', 'account_code', 'contract'], 'safe'],
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
        $query = Agency::find();

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
        $query->andFilterWhere([
            'id' => $this->id
            ]);
        $query->andFilterWhere(['like', 'account_name', $this->account_name]);

        return $dataProvider;
    }
}
