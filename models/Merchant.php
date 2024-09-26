<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Merchant extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'merchants';
    }

    public function getMerchantCategories()
    {
        return $this->hasMany(MerchantCategories::class, ['merchant_id' => 'id']);
    }

    public function getServices()
    {
        return $this->hasMany(Service::class, ['merchant_id' => 'id']);
    }


}
