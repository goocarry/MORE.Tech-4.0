<?php

namespace common\modules\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "blog_category".
 *
 * @property int $id
 * @property string $title
 * @property string|null $photo
 * @property int|null $sort
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property BlogArticleCategory[] $blogArticleCategories
 */
class BlogCategory extends \yii\db\ActiveRecord
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
        return 'blog_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['sort', 'created_at', 'updated_at'], 'integer'],
            [['title', 'photo'], 'string', 'max' => 255],
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
            'photo' => 'Photo',
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
        return $this->hasMany(BlogArticleCategory::class, ['category_id' => 'id']);
    }
}
