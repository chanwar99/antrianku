<?php

use yii\db\Migration;

/**
 * Class m240926_050251_insert_initial_data
 */
class m240926_050251_insert_initial_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        // Insert data ke tabel merchants
        $this->batchInsert('merchants', ['id', 'name', 'location', 'category', 'created_at'], [
            [1, 'Merchant ABC', 'Jl. Sudirman No. 45', 'Retail', '2024-09-24 18:20:46'],
            [2, 'Merchant DFG', 'Jl. Aceh No. 01', 'Retail', '2024-09-24 18:21:02'],
            [3, 'Merchant XYZ', 'Jl. Melati No. 10', 'Food', '2024-09-24 18:25:00'],
        ]);

        // Insert data ke tabel services
        $this->batchInsert('services', ['id', 'merchant_id', 'name', 'description', 'price', 'created_at'], [
            [1, 1, 'Cuci Mobil', 'Layanan cuci mobil standar', 50000.00, '2024-09-24 18:21:11'],
            [2, 1, 'Cuci Motor', 'Layanan cuci motor matic', 20000.00, '2024-09-24 18:21:33'],
            [3, 2, 'Service HP', 'Layanan benerin hp', 500000.00, '2024-09-24 18:22:04'],
            [4, 2, 'Service Laptop', 'Layanan benerin laptop', 800000.00, '2024-09-24 18:22:41'],
            [5, 3, 'Makan Siang', 'Layanan makanan siang', 15000.00, '2024-09-24 18:30:00'],
            [6, 3, 'Minum Malam', 'Layanan minuman malam', 10000.00, '2024-09-24 18:31:00'],
        ]);

        // Insert data ke tabel users
        // $this->batchInsert('users', ['id', 'username', 'email', 'password', 'auth_token', 'created_at'], [
        //     [1, 'user1', 'user1@example.com', 'hashed_password_1', 'token_1', '2024-09-24 18:00:00'],
        //     [2, 'user2', 'user2@example.com', 'hashed_password_2', 'token_2', '2024-09-24 18:05:00'],
        // ]);

        // Insert data ke tabel queues
        // $this->batchInsert('queues', ['id', 'user_id', 'merchant_id', 'service_id', 'queue_number', 'queue_status', 'created_at'], [
        //     [1, 1, 1, 1, 1, 'waiting', '2024-09-24 18:35:00'],
        //     [2, 2, 2, 3, 2, 'waiting', '2024-09-24 18:36:00'],
        //     [3, 1, 3, 5, 3, 'waiting', '2024-09-24 18:37:00'],
        // ]);

        // Insert data ke tabel categories
        $this->batchInsert('categories', ['id', 'name'], [
            [1, 'Retail'],
            [2, 'Food'],
        ]);

        // Insert data ke tabel merchant_categories
        $this->batchInsert('merchant_categories', ['merchant_id', 'category_id'], [
            [1, 1],
            [2, 1],
            [3, 2],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // $this->delete('queues');
        $this->delete('services');
        $this->delete('merchants');
        // $this->delete('users');
        $this->delete('categories');
        $this->delete('merchant_categories');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240926_050251_insert_initial_data cannot be reverted.\n";

        return false;
    }
    */
}
