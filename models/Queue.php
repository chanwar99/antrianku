<?php
namespace app\models;

use yii\db\ActiveRecord;

class Queue extends ActiveRecord
{
    public static function tableName()
    {
        return 'queues';
    }

    public function getMerchant()
    {
        return $this->hasOne(Merchant::class, ['id' => 'merchant_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }
}