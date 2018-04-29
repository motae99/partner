<?php

namespace api\common\models;

class Services extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{servicerequest}}';
    }


    public static function find() {
        return new ServicesQuery(get_called_class());
    }
}

class ServicesQuery extends \api\components\db\ActiveQuery
{
}