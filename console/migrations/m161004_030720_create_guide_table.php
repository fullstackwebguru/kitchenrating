<?php

use yii\db\Migration;

/**
 * Handles the creation for table `guide`.
 */
class m161004_030720_create_guide_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%guide}}', [
            'id' => $this->primaryKey(11),
            'category_id' => $this->integer(11)->notNull(),
            'title' => $this->string(255)->notNull(),
            'author' => $this->string(255)->notNull(),
            'slug' => $this->string(255),
            'description' => $this->text(),
            'image_url' => $this->string(255),
            'color' => $this->string(11),
            'meta_description' => $this->string(255),
            'meta_keywords' => $this->string(255),
            'status' => $this->boolean()->notNull()->defaultValue(true),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->addForeignKey('fk-guide-category_id-category-id', '{{%guide}}', 'category_id', '{{%category}}', 'id', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('guide');
    }
}
