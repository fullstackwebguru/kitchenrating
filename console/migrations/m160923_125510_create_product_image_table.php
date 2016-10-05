<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_image`.
 */
class m160923_125510_create_product_image_table extends Migration
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

        $this->createTable('{{%product_image}}', [
            'id' => $this->primaryKey(11),
            'product_id' => $this->integer(11),
            'image_url' => $this->string(255),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->addForeignKey('fk-image-product_id-product-id', '{{%product_image}}', 'product_id', '{{%product}}', 'id', 'SET NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%product_image}}');
    }
}
