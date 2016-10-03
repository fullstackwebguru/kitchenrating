<?php

use yii\db\Migration;

/**
 * Handles the creation for table `store`.
 */
class m161003_185755_create_product_store_table extends Migration
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

        $this->createTable('{{%store}}', [
            'id' => $this->primaryKey(11),
            'title' => $this->string(255)->notNull(),
        ],$tableOptions);

        $this->addForeignKey('fk-product-store_id-store-id', '{{%product}}', 'store_id', '{{%store}}', 'id', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-product-store_id-store-id');
        $this->dropTable('{{%store}}');
    }
}
