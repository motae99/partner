<?php

namespace api\common\models;

class Contactus extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{contactus}}';
    }


    public static function find() {
        return new ContactusQuery(get_called_class());
    }
}

class ContactusQuery extends \api\components\db\ActiveQuery
{
}