<?php

namespace common\modules\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "blog_comment".
 *
 * @property int $id
 * @property string $text
 * @property int $article_id
 * @property int $user_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property BlogArticle $article
 * @property BlogUserReaction[] $blogUserReactions
 * @property User $user
 */
class BlogComment extends \yii\db\ActiveRecord
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
        return 'blog_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'article_id', 'user_id'], 'required'],
            [['text'], 'string'],
            [['article_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogArticle::class, 'targetAttribute' => ['article_id' => 'id']],
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
            'text' => 'Text',
            'article_id' => 'Article ID',
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
     * Gets query for [[BlogUserReactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogUserReactions()
    {
        return $this->hasMany(BlogUserReaction::class, ['comment_id' => 'id']);
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
}
