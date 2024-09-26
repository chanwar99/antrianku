<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%services}}`.
 */
class m240925_140042_create_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%services}}', [
            'id' => $this->primaryKey(),
            'merchant_id' => $this->integer()->defaultValue(null),
            'name' => $this->string(100)->notNull(),
            'description' => $this->text(),
            'price' => $this->decimal(10, 2)->defaultValue(null),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-services-merchant_id',
            '{{%services}}',
            'merchant_id',
            '{{%services}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-services-merchant_id', '{{%services}}');
        $this->dropTable('{{%services}}');
    }
}
