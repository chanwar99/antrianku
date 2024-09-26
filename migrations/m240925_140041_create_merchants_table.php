<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%merchants}}`.
 */
class m240925_140041_create_merchants_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%merchants}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'location' => $this->string(255)->defaultValue(null),
            'category' => $this->string(50)->defaultValue(null),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%merchants}}');
    }
}
