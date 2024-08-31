<?php

namespace app\models;

use Yii;

class OrderGood extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'order_good';
    }
    public function getOrder(){
        return $this->hasOne(OrderGood::class, ['id' => 'order_id']);
    }
    
}
