<?php
namespace app\models;

use yii\db\ActiveRecord;


class Goods  extends ActiveRecord
{
    public static function tableName()
    {
        return 'goods';
    }
    public function attributeLabels(){
    	return [
    	
    	'proImage'=>'商品图片',
    	'proName'=>'产品名称',
    	'createTime'=>'创建时间',
    	'lowPrice'=>'最低价格',
    	'highPrice'=>'最高价格',
    	'recommend'=>'推荐',
    	'mlowPrice'=>'公司最低价格',
    	'mhighPrice'=>'公司最高价格',
    	'remarks'=>'备注',
    	'proDesc'=>'产品简介',
    	'reserveNum'=>'预约数',
    	'code' => '审核结果',
    	];
    }

    /*public function rules(){
        return [
          ['id','integer'],
          ['title','string','length'=>[0,5]]
        ];
    }*/
}
