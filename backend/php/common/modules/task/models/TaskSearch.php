<?php

namespace common\modules\task\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\task\models\Task;

/**
 * TaskSearch represents the model behind the search form of `common\modules\task\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'period', 'count', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'safe'],
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
        $query = Task::find()->select(['*', new \yii\db\Expression(
            "(SELECT count(*) FROM `task_progress` WHERE `task_progress`.`task_id` = `task`.`id` AND `task_progress`.`user_id` = :user_id) AS progress",
            [':user_id' => Yii::$app->user->id]
        )]);

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
            'task.id' => $this->id,
            'period' => $this->period,
            'count' => $this->count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
