<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category`.
 */
class m160923_122418_create_category_table extends Migration
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

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(11),
            'parent_id' => $this->integer(11),
            'title' => $this->string(255)->notNull(),
            'image_url' => $this->string(255),
            'rating' => $this->double(2)->notNull(),
            'num_rating' => $this->integer(11)->notNull(),
            'rank_option1' => $this->string(255),
            'rank_option2' => $this->string(255),
            'rank_option3' => $this->string(255),
            'popular' => $this->boolean()->notNull()->defaultValue(false),
            'slug' => $this->string(255),
            'meta_description' => $this->string(255),
            'meta_keywords' => $this->string(255),
            'status' => $this->boolean()->notNull()->defaultValue(true),
            'color' => $this->string(11),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->addForeignKey('fk-category-parent_id-category-id', '{{%category}}', 'parent_id', '{{%category}}', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}
