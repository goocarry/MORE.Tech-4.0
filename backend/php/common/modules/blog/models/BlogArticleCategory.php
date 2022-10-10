<?php

namespace common\modules\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "blog_article_category".
 *
 * @property int $id
 * @property int $article_id
 * @property int $category_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property BlogArticle $article
 * @property BlogCategory $category
 */
class BlogArticleCategory extends \yii\db\ActiveRecord
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
        return 'blog_article_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'category_id'], 'required'],
            [['article_id', 'category_id', 'created_at', 'updated_at'], 'integer'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogArticle::class, 'targetAttribute' => ['article_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::class, 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Category ID',
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
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(BlogCategory::class, ['id' => 'category_id']);
    }
}
