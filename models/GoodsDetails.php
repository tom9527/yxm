<?php
namespace app\models;

use yii\db\ActiveRecord;


class GoodsDetails  extends ActiveRecord
{
    public static function tableName()
    {
        return 'goodsdetails';
    }
   
}