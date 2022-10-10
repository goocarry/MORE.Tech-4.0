<?php

use yii\db\Migration;

/**
 * Class m221008_073238_add_blog_tables
 */
class m221008_073238_add_blog_tables extends Migration
{
    /**
     * @inheritDoc
     */
    public function safeUp() : void
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blog_category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'photo' => $this->string(),
            'sort' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%blog_article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'photo' => $this->string(),
            'description' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'sort' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%blog_article_category}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('blog_article_category_category_index', 'blog_article_category', 'category_id');
        $this->addForeignKey('blog_article_category_category_foreign', 'blog_article_category', 'category_id', 'blog_category', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('blog_article_category_article_index', 'blog_article_category', 'article_id');
        $this->addForeignKey('blog_article_category_article_foreign', 'blog_article_category', 'article_id', 'blog_article', 'id', 'CASCADE', 'CASCADE');

        $this->createTable('{{%blog_comment}}', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'article_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('blog_comment_user_index', 'blog_comment', 'user_id');
        $this->addForeignKey('blog_comment_user_foreign', 'blog_comment', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('blog_comment_article_index', 'blog_comment', 'article_id');
        $this->addForeignKey('blog_comment_article_foreign', 'blog_comment', 'article_id', 'blog_article', 'id', 'CASCADE', 'CASCADE');

        $this->createTable('{{%blog_reaction}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'key' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%blog_user_reaction}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'comment_id' => $this->integer(),
            'reaction_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('blog_user_reaction_user_index', 'blog_user_reaction', 'user_id');
        $this->addForeignKey('blog_user_reaction_user_foreign', 'blog_user_reaction', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('blog_user_reaction_article_index', 'blog_user_reaction', 'article_id');
        $this->addForeignKey('blog_user_reaction_article_foreign', 'blog_user_reaction', 'article_id', 'blog_article', 'id', 'SET NULL', 'SET NULL');

        $this->createIndex('blog_user_reaction_comment_index', 'blog_user_reaction', 'comment_id');
        $this->addForeignKey('blog_user_reaction_comment_foreign', 'blog_user_reaction', 'comment_id', 'blog_comment', 'id', 'SET NULL', 'SET NULL');

        $this->createIndex('blog_user_reaction_reaction_index', 'blog_user_reaction', 'reaction_id');
        $this->addForeignKey('blog_user_reaction_reaction_foreign', 'blog_user_reaction', 'reaction_id', 'blog_reaction', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritDoc
     */
    public function safeDown() : void
    {
        $this->dropForeignKey('blog_user_reaction_reaction_foreign','blog_user_reaction');
        $this->dropIndex('blog_user_reaction_reaction_index','blog_user_reaction');

        $this->dropForeignKey('blog_user_reaction_comment_foreign','blog_user_reaction');
        $this->dropIndex('blog_user_reaction_comment_index','blog_user_reaction');

        $this->dropForeignKey('blog_user_reaction_article_foreign','blog_user_reaction');
        $this->dropIndex('blog_user_reaction_article_index','blog_user_reaction');

        $this->dropForeignKey('blog_user_reaction_user_foreign','blog_user_reaction');
        $this->dropIndex('blog_user_reaction_user_index','blog_user_reaction');
        
        $this->dropTable('{{%blog_user_reaction}}');

        $this->dropTable('{{%blog_reaction}}');

        $this->dropForeignKey('blog_comment_article_foreign','blog_comment');
        $this->dropIndex('blog_comment_article_index','blog_comment');

        $this->dropForeignKey('blog_comment_user_foreign','blog_comment');
        $this->dropIndex('blog_comment_user_index','blog_comment');

        $this->dropTable('{{%blog_comment}}');

        $this->dropForeignKey('blog_article_category_category_foreign', 'blog_article_category');
        $this->dropIndex('blog_article_category_category_index', 'blog_article_category');

        $this->dropForeignKey('blog_article_category_article_foreign', 'blog_article_category');
        $this->dropIndex('blog_article_category_article_index', 'blog_article_category');

        $this->dropTable('{{%blog_article_category}}');

        $this->dropTable('{{%blog_article}}');

        $this->dropTable('{{%blog_category}}');
    }
}
