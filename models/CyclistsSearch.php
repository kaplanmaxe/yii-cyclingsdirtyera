<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cyclists;

/**
 * CyclistsSearch represents the model behind the search form about `app\models\Cyclists`.
 */
class CyclistsSearch extends Cyclists
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cyclist_id', 'cyclist_doper', 'cyclist_banned'], 'integer'],
            [['cyclist_name'], 'safe'],
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
        $query = Cyclists::find();

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
            'cyclist_id' => $this->cyclist_id,
            'cyclist_doper' => $this->cyclist_doper,
            'cyclist_banned' => $this->cyclist_banned,
        ]);

        $query->andFilterWhere(['like', 'cyclist_name', $this->cyclist_name]);

        return $dataProvider;
    }
}
