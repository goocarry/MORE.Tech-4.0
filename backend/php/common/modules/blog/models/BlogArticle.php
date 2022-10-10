<?php

namespace common\modules\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "blog_article".
 *
 * @property int $id
 * @property string $title
 * @property string|null $photo
 * @property string|null $description
 * @property int $user_id
 * @property int|null $sort
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property BlogArticleCategory[] $blogArticleCategories
 * @property BlogComment[] $blogComments
 * @property BlogUserReaction[] $blogUserReactions
 */
class BlogArticle extends \yii\db\ActiveRecord
{
    public $categories = [];

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
        return 'blog_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'user_id'], 'required'],
            [['description'], 'string'],
            [['user_id', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['title', 'photo'], 'string', 'max' => 255],
            ['categories', 'each', 'rule' => ['integer']],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        foreach ($this->categories as $key => $category) {
            $isSeted = BlogArticleCategory::find()->where(['article_id' => $this->id, 'category_id' => $category])->exists();
            if(!$isSeted){
                $model = new BlogArticleCategory();
                $model->article_id = $this->id;
                $model->category_id = $category;
                $model->save();
            }
        }

        BlogArticleCategory::deleteAll(['AND', 'article_id = :article_id', ['NOT IN', 'category_id', $this->categories]], [':article_id' => $this->id]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'photo' => 'Photo',
            'description' => 'Description',
            'user_id' => 'User ID',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[BlogArticleCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogArticleCategories()
    {
        return $this->hasMany(BlogArticleCategory::class, ['article_id' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(BlogCategory::class, ['id' => 'category_id'])
            ->viaTable(BlogArticleCategory::tableName(), ['article_id' => 'id']);
    }

    /**
     * Gets query for [[BlogComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogComments()
    {
        return $this->hasMany(BlogComment::class, ['article_id' => 'id']);
    }

    /**
     * Gets query for [[BlogUserReactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogUserReactions()
    {
        return $this->hasMany(BlogUserReaction::class, ['article_id' => 'id']);
    }
}
