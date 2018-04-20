<?php

namespace api\common\models;

class Register extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{appointment}}';
    }


    public static function find() {
        return new RegisterQuery(get_called_class());
    }
}

class RegisterQuery extends \api\components\db\ActiveQuery
{
}