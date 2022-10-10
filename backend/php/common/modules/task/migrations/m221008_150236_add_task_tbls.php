<?php

use yii\db\Migration;

/**
 * Class m221008_150236_add_task_tbls
 */
class m221008_150236_add_task_tbls extends Migration
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
        
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'period' => $this->integer()->notNull(),
            'count' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%task_progress}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('task_progress_task_index', 'task_progress', 'task_id');
        $this->addForeignKey('task_progress_task_foreign', 'task_progress', 'task_id', 'task', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('task_progress_user_index', 'task_progress', 'user_id');
        $this->addForeignKey('task_progress_user_foreign', 'task_progress', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritDoc
     */
    public function safeDown() : void
    {
        $this->dropForeignKey('task_progress_user_foreign', 'task_progress');
        $this->dropIndex('task_progress_user_index', 'task_progress');

        $this->dropForeignKey('task_progress_task_foreign', 'task_progress');
        $this->dropIndex('task_progress_task_index', 'task_progress');

        $this->dropTable('{{%task_progress}}');

        $this->dropTable('{{%task}}');
    }
}
