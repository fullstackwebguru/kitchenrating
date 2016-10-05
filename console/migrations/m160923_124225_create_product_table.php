<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product`.
 */
class m160923_124225_create_product_table extends Migration
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

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(11),
            'category_id' => $this->integer(11)->notNull(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255),
            'description' => $this->text(),
            'product_url' => $this->string(255)->notNull(),
            'store_id' => $this->integer(11)->notNull(),
            'rating' => $this->double(2)->notNull(),
            'num_rating' => $this->integer(11)->notNull(),
            'color' => $this->string(11),
            'featured' => $this->boolean()->notNull()->defaultValue(false),
            'status' => $this->boolean()->notNull()->defaultValue(true),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->addForeignKey('fk-product-category_id-category-id', '{{%product}}', 'category_id', '{{%category}}', 'id', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%product}}');
    }
}

