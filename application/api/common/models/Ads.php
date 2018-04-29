<?php

namespace api\common\models;

class Ads extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{adspanner}}';
    }


    public static function find() {
        return new AdsQuery(get_called_class());
    }
}

class AdsQuery extends \api\components\db\ActiveQuery
{
}