<?php

namespace common\modules\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "blog_reaction".
 *
 * @property int $id
 * @property string $title
 * @property string $key
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property BlogUserReaction[] $blogUserReactions
 */
class BlogReaction extends \yii\db\ActiveRecord
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
        return 'blog_reaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'key'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['title', 'key'], 'string', 'max' => 255],
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
            'key' => 'Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[BlogUserReactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogUserReactions()
    {
        return $this->hasMany(BlogUserReaction::class, ['reaction_id' => 'id']);
    }
}
