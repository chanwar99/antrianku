<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class MerchantCategories extends ActiveRecord
{
    public static function tableName()
    {
        return 'merchant_categories';
    }

    public function getMerchant()
    {
        return $this->hasOne(Merchant::class, ['id' => 'merchant_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
