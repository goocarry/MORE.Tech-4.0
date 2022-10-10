<?php

namespace common\modules\blog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\blog\models\BlogComment;

/**
 * BlogCommentSearch represents the model behind the search form of `common\modules\blog\models\BlogComment`.
 */
class BlogCommentSearch extends BlogComment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'article_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['text'], 'safe'],
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
        $query = BlogComment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'article_id' => $params['article_id'],
        ]);

        return $dataProvider;
    }
}
