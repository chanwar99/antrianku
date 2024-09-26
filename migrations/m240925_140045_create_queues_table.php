<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%queues}}`.
 */
class m240925_140045_create_queues_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%queues}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->defaultValue(null),
            'merchant_id' => $this->integer()->defaultValue(null),
            'service_id' => $this->integer()->defaultValue(null),
            'queue_number' => $this->integer()->notNull(),
            'queue_status' => "ENUM('waiting','processing','completed') DEFAULT 'waiting'",
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-queues-user_id',
            '{{%queues}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-queues-merchant_id',
            '{{%queues}}',
            'merchant_id',
            '{{%merchants}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-queues-service_id',
            '{{%queues}}',
            'service_id',
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
        $this->dropForeignKey('fk-queues-user_id', '{{%queues}}');
        $this->dropForeignKey('fk-queues-merchant_id', '{{%queues}}');
        $this->dropForeignKey('fk-queues-service_id', '{{%queues}}');
        $this->dropTable('{{%queues}}');
    }
}
