<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_info`.
 */
class m161013_124221_create_product_info_table extends Migration
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

        $this->createTable('{{%product_info}}', [
            'id' => $this->primaryKey(11),
            'product_id' => $this->integer(11),
            'product_url' => $this->string(500),
            'store_id' => $this->integer(11)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->addForeignKey('fk-info-product_id-product-id', '{{%product_info}}', 'product_id', '{{%product}}', 'id', 'SET NULL');

        $this->addForeignKey('fk-product_info-store_id-store-id', '{{%product_info}}', 'store_id', '{{%store}}', 'id', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%product_info}}');
    }
}
