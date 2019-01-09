<?php

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\base\Games;

/**
 * GamesSearch represents the model behind the search form of `common\models\base\Games`.
 */
class GamesSearch extends Games
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['game_name', 'game_description', 'game_path', 'img_landscape', 'img_icon', 'img_thumbnail', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Games::find();

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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'game_name', $this->game_name])
            ->andFilterWhere(['like', 'game_description', $this->game_description])
            ->andFilterWhere(['like', 'game_path', $this->game_path])
            ->andFilterWhere(['like', 'img_landscape', $this->img_landscape])
            ->andFilterWhere(['like', 'img_icon', $this->img_icon])
            ->andFilterWhere(['like', 'img_thumbnail', $this->img_thumbnail]);

        return $dataProvider;
    }
}
