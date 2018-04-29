<?php

namespace api\common\models;

class Servicetype extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{services}}';
    }


    public static function find() {
        return new ServicetypeQuery(get_called_class());
    }
}

class ServicetypeQuery extends \api\components\db\ActiveQuery
{
}