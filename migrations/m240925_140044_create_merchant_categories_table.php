<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%merchant_categories}}`.
 */
class m240925_140044_create_merchant_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%merchant_categories}}', [
            'merchant_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'PRIMARY KEY(merchant_id, category_id)',
        ]);

        $this->addForeignKey(
            'fk-merchant_categories-merchant_id',
            '{{%merchant_categories}}',
            'merchant_id',
            '{{%merchants}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-merchant_categories-category_id',
            '{{%merchant_categories}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-merchant_categories-merchant_id', '{{%merchant_categories}}');
        $this->dropForeignKey('fk-merchant_categories-category_id', '{{%merchant_categories}}');
        $this->dropTable('{{%merchant_categories}}');
    }
}
