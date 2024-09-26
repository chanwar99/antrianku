<?php

namespace app\models;

use Yii;

class Service extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'services';
    }

    public function getMerchant()
    {
        return $this->hasOne(Merchant::class, ['id' => 'merchant_id']);
    }
}
