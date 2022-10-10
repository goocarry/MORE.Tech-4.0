<?php

namespace common\modules\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\User;
use common\modules\blog\models\BlogArticle;
use common\modules\blog\models\BlogComment;
use common\modules\blog\models\BlogReaction;

/**
 * This is the model class for table "blog_user_reaction".
 *
 * @property int $id
 * @property int|null $article_id
 * @property int|null $comment_id
 * @property int $reaction_id
 * @property int $user_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property BlogArticle $article
 * @property BlogComment $comment
 * @property BlogReaction $reaction
 * @property User $user
 */
class BlogUserReaction extends \yii\db\ActiveRecord
{
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
        return 'blog_user_reaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'comment_id', 'reaction_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['reaction_id', 'user_id'], 'required'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogArticle::class, 'targetAttribute' => ['article_id' => 'id']],
            [['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogComment::class, 'targetAttribute' => ['comment_id' => 'id']],
            [['reaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogReaction::class, 'targetAttribute' => ['reaction_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'comment_id' => 'Comment ID',
            'reaction_id' => 'Reaction ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(BlogArticle::class, ['id' => 'article_id']);
    }

    /**
     * Gets query for [[Comment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasOne(BlogComment::class, ['id' => 'comment_id']);
    }

    /**
     * Gets query for [[Reaction]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReaction()
    {
        return $this->hasOne(BlogReaction::class, ['id' => 'reaction_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @param bool $insert новая ли запись
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        
        if ($insert) {
            $UserReactionsObservable = new \common\modules\task\services\UserReactionsObservable();
            $tasks = \common\modules\task\models\Task::find()->all();
            foreach ($tasks as $task) {
                $UserReactionsObservable->attach($task);
            }
            $UserReactionsObservable->userReacted($this);
        }
    }
}
