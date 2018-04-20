<?php

namespace api\common\models;

class Drugs extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{drugs}}';
    }

    public function fields()
    {
        return [
            'id',
            'product_name',
            'no',
            'description',
            'quantity',
            'price',
        ];
    }


    public static function find() {
        return new DrugsQuery(get_called_class());
    }
}

class DrugsQuery extends \api\components\db\ActiveQuery
{
}