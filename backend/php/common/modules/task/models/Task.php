<?php

namespace common\modules\task\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\modules\blog\models\BlogUserReaction;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $title
 * @property int $period
 * @property int $count
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property TaskProgress[] $taskProgresses
 */
class Task extends \yii\db\ActiveRecord
{
    public $progress;

    public function fields() {
        return [
            'id',
            'title',
            'period',
            'count',
            'created_at',
            'updated_at',
            //PHP callback
            'progress' => function($model) {
                // return $model->progress;
                return $model->getTaskProgressesByUser(Yii::$app->user->id)->count();
            }
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'period', 'count'], 'required'],
            [['period', 'count', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['progress'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'period' => 'Period',
            'count' => 'Count',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'progress' => 'Progress',
        ];
    }

    /**
     * @param BlogUserReaction $model
     */
    public function onUserReact(BlogUserReaction $model)
    {
        // if (!empty($model->article_id)) {
        // }
        // if (!empty($model->comment_id)) {
        // }
        $userProgress = $this->getTaskProgressesByUser($model->user_id)->count();
        if ($this->count > $userProgress) {
            // create new progress
            $taskProgress = new TaskProgress();
            $taskProgress->user_id = $model->user_id;
            $taskProgress->task_id = $this->id;
            $taskProgress->save();
        } else {
            // task fully complated
            // TODO: Make Transaction
        }
    }

    /**
     * Gets query for [[TaskProgresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskProgresses()
    {
        return $this->hasMany(TaskProgress::class, ['task_id' => 'id']);
    }

    public function getTaskProgressesByUser($user_id)
    {
        // add date between codition
        return $this->hasMany(TaskProgress::class, ['task_id' => 'id'])->where(['user_id' => $user_id]);
    }
}
